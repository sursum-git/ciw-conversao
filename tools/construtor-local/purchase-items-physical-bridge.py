"""Closed private OpenEdge12.2 read/cleanup preparation. Import never uses SSH.

Transport reuses containers-remote-task.py only after explicit human gates.
No production publication, schema change, password storage or automatic retry.
"""
import argparse
from collections import defaultdict
from datetime import datetime, timezone
from decimal import Decimal
import hashlib
import json
from pathlib import Path
import re
import subprocess
import sys
import uuid

ROOT = Path(__file__).resolve().parents[2]
PRIVATE = ROOT / '.runtime/purchase-items-20261022'
TEMPLATES = PRIVATE / 'physical-bridge'
TAG = 'SC_TEST_PROC_ITENS_20261022'
FIELDS = 'cta_corren_fornec_imp_id,fornecedor_id,data,item_proc_compra_id,historico,cod_tipo_movto,vl_lancto,cod_acao,login,data_hora,num_id_tit_ap,item_container_id,transacao_id'.split(',')
STAGES = 'create-header,create-a,create-b,associate,update-a,repeat-a,stale-a,delete-a,update-b,create-c,disable,unlink1,unlink2,delete-b,delete-c,delete-header'.split(',')
PHASES = {'preflight', 'inspect', 'prepare-cleanup', 'verify-final'} | {stage + suffix for stage in STAGES for suffix in ['-before', '-after']}


def require(value, reason):
    if not value:
        raise ValueError(reason)


def positive(value):
    return type(value) is int and 0 < value <= 2147483647


def read(file):
    return json.loads(Path(file).read_text(encoding='utf-8-sig'))


def write_new(file, value):
    with Path(file).open('x', encoding='utf-8', newline='\n') as stream:
        json.dump(value, stream, ensure_ascii=False, indent=2)
        stream.write('\n')


def sha(file):
    return hashlib.sha256(Path(file).read_bytes()).hexdigest()


def canonical_hash(value):
    # Exact same canonicalization as the executor; no network/credentials.
    result = subprocess.run(['node', '-e',
                             'let s="";process.stdin.on("data",d=>s+=d);process.stdin.on("end",()=>process.stdout.write(require(process.argv[1]).hash(JSON.parse(s))));',
                             str(ROOT / 'tools/construtor-local/exercise-purchase-items.cjs')],
                            input=json.dumps(value, ensure_ascii=False), text=True,
                            capture_output=True, check=True, timeout=10)
    require(re.fullmatch('[a-f0-9]{64}', result.stdout), 'CANONICAL_HASH_FAILED')
    return result.stdout


def validate_authorization(authorization, require_consent=True):
    require(authorization.get('authorized') is True or not require_consent, 'NEW_BUSINESS_AUTHORIZATION_PENDING')
    require(authorization.get('tag') == TAG, 'AUTHORIZATION_TAG')
    for field in ['newHeader', 'generatedItemIds']:
        require(authorization.get(field) is True, 'AUTHORIZATION_' + field)
    for field in ['allowExistingTitleWrites', 'allowContainerWrites']:
        require(authorization.get(field) is False, 'AUTHORIZATION_' + field)
    approval = authorization.get('humanApproval') or {}
    require(approval.get('source') == 'human-user-message', 'HUMAN_APPROVAL_SOURCE')
    require(not require_consent or isinstance(approval.get('reference'), str) and approval['reference'].strip(), 'HUMAN_APPROVAL_REFERENCE')
    require(isinstance(authorization.get('expectedActor'), str) and authorization['expectedActor'].strip(), 'AUTHENTICATED_ACTOR_REQUIRED')


def native_creations(evidence, authorization):
    """Only fresh scenario native CREATE images confer IDs; marker alone never does."""
    parent = None
    items = {}
    logs = {}
    actor = authorization['expectedActor']
    for receipt in evidence:
        require(receipt.get('tag') == TAG, 'FOREIGN_SCENARIO_RECEIPT')
        require(receipt.get('success') is True or receipt.get('validatedNativeEvents') is True, 'UNCONFIRMED_RECEIPT')
        for event in receipt.get('events', []):
            meta = event.get('meta', {}).get('audit', {})
            require(meta.get('available') is True and meta.get('source') == 'progress-transaction' and meta.get('version') == 1, 'NATIVE_CONFIRMATION_REQUIRED')
            require(event.get('actor_user_id') == actor and positive(int(event.get('id', 0))) and positive(int(event.get('transaction_id', 0))), 'NATIVE_ACTOR_OR_LOG_REQUIRED')
            if meta.get('operation') != 'create':
                continue
            require(event.get('before') in ({}, []), 'CREATE_BEFORE_NOT_EMPTY')
            row = event.get('after', {})
            resource = meta.get('resource')
            identity = meta.get('recordId')
            if resource == 'procs_compra':
                require(len(row) == 14 and row.get('proc_compra_id') == identity and positive(identity), 'EXACT_NEW_HEADER14')
                require(row.get('cod_proc_fornec') == TAG and row.get('observacao') == TAG, 'NEW_HEADER_MARKER')
                require(meta.get('procCompraId') == identity and meta.get('originProcCompraId') == identity, 'NEW_HEADER_OWNER_ORIGIN')
                if parent is not None:
                    require(parent == row, 'CONFLICTING_NEW_HEADER')
                parent = row
            elif resource == 'itens_proc_compra':
                require(len(row) == 46 and row.get('item_proc_compra_id') == identity and positive(identity), 'EXACT_NEW_ITEM46')
                require(row.get('codigo_erp') == '2147000107' and row.get('descricao') in {TAG + '/' + label for label in 'ABC'} and row.get('observacao') == row.get('descricao'), 'NEW_ITEM_MARKER')
                require(meta.get('procCompraId') == row.get('proc_compra_id') and meta.get('originProcCompraId') == row.get('proc_compra_id') and meta.get('originItemProcCompraId') == identity, 'NEW_ITEM_OWNER_ORIGIN')
                if identity in items:
                    require(items[identity] == row, 'CONFLICTING_NEW_ITEM')
                items[identity] = row
            elif resource == 'cta_corren_fornec_imp':
                key = row.get('cta_corren_fornec_imp_id')
                require(positive(key) and key == identity, 'LEDGER_NATIVE_CREATE_ID')
                proof = {'image': row, 'logId': int(event['id']), 'transactionId': int(event['transaction_id'])}
                if key in logs:
                    require(logs[key] == proof, 'CONFLICTING_NATIVE_LEDGER_CREATION')
                logs[key] = proof
    return parent, items, logs


def validate_request(request, authorization, evidence=(), require_consent=True):
    validate_authorization(authorization, require_consent)
    require(set(request) == {'phase', 'tag', 'proc_compra_id', 'itemIds', 'titleIds', 'notBefore'}, 'CLOSED_REQUEST_KEYS')
    require(request['tag'] == TAG and request['phase'] in PHASES, 'CLOSED_PHASE_TAG')
    titles = request['titleIds']
    require(type(titles) is list and len(titles) == 2 and all(map(positive, titles)) and len(set(titles)) == 2 and titles == authorization.get('titleIds'), 'EXACT_TWO_AUTHORIZED_TITLES')
    items = request['itemIds']
    require(type(items) is list and len(items) <= 3 and all(map(positive, items)) and len(set(items)) == len(items), 'GENERATED_ITEM_SCOPE')
    try:
        datetime.fromisoformat(request['notBefore'].replace('Z', '+00:00'))
    except (TypeError, ValueError, AttributeError):
        raise ValueError('VALID_REQUEST_TIMESTAMP_REQUIRED')
    pid = request['proc_compra_id']
    require(pid is None or positive(pid), 'NEW_PARENT_SCOPE')
    parent, known, _ = native_creations(evidence, authorization)
    if pid is not None:
        require(parent is not None and parent['proc_compra_id'] == pid, 'NATIVE_NEW_HEADER_CREATION_REQUIRED')
        for key in items:
            require(key in known and known[key]['proc_compra_id'] == pid, 'NATIVE_NEW_ITEM_CREATION_REQUIRED')
    else:
        require(not items and request['phase'] in {'preflight', 'create-header-before', 'inspect'}, 'PARENT_REQUIRED_FOR_ITEMS')


def collect_evidence(state):
    evidence = []
    confirmed_modes = set()
    for stage in STAGES:
        file = state / ('confirmed-' + stage + '.json')
        if file.exists():
            evidence.append(read(file)); confirmed_modes.add(stage)
    for stage in STAGES:
        file = state / ('observed-native-' + stage + '.json')
        if stage not in confirmed_modes and file.exists():
            evidence.append(read(file))
    return evidence


def normalize_snapshot(raw, request, config):
    require(raw.get('success') is True and str(raw.get('version', '')).startswith('12.2'), 'OFFICIAL12_2_READ_REQUIRED')
    companies = raw.get('companies')
    require(type(companies) is list and len(companies) == 1, 'UNIQUE_MED_COMPANY')
    company = companies[0]
    require(company.get('cod_emp_ems2') == 5 and company.get('empresa_id') == config['seed']['empresa_id'], 'MED_COMPANY_MAPPING')
    pid, own_ids = request['proc_compra_id'], request['itemIds']
    for key in ['orders', 'items', 'ledger', 'payment_links', 'container_links', 'allocations', 'commercial_allocations', 'attachments', 'expenses']:
        require(type(raw.get(key)) is list, 'COMPLETE_PHYSICAL_ARRAY_' + key)
    for key in ['container_links', 'allocations', 'commercial_allocations', 'attachments', 'expenses']:
        require(raw[key] == [], 'UNAUTHORIZED_COMMERCIAL_DEPENDENCY_' + key)
    ledger = []
    for row in raw['ledger']:
        require(set(row) == set(FIELDS), 'EXACT13_PHYSICAL_LEDGER')
        require(row['item_proc_compra_id'] in own_ids and row['item_container_id'] == 0, 'PHYSICAL_LEDGER_OWNERSHIP')
        require(row['cod_tipo_movto'] in [3, 4] and (row['num_id_tit_ap'] == 0 and row['cod_tipo_movto'] == 3 or row['num_id_tit_ap'] in request['titleIds']), 'CLOSED_LEDGER_KIND_TITLE')
        require(row['fornecedor_id'] == config['seed']['fornecedor_id'], 'LEDGER_SUPPLIER')
        ledger.append({**row, 'proc_compra_id': pid})
    for row in raw['items']:
        require(row.get('item_proc_compra_id') in own_ids and row.get('proc_compra_id') == pid and row.get('codigo_erp') == '2147000107' and row.get('descricao', '').startswith(TAG + '/'), 'CLOSED_PHYSICAL_ITEMS')
    for row in raw['orders']:
        require(row.get('cod_proc_fornec') == TAG and (pid is None or row.get('proc_compra_id') == pid), 'CLOSED_PHYSICAL_PARENT')
    for row in raw['payment_links']:
        require(pid is not None and row.get('proc_compra_id') == pid and row.get('num_id_tit_ap') in request['titleIds'], 'NO_FOREIGN_TITLE_LINK')
    snapshots = []
    require(len(raw.get('titles', [])) == 2 and [x.get('num_id_tit_ap') for x in raw['titles']] == request['titleIds'], 'EXACT_TWO_TITLE_IMAGES')
    for entry in raw['titles']:
        tid = entry['num_id_tit_ap']; rows = entry.get('title_rows', [])
        require(len(rows) == 1, 'TITLE_GLOBAL_UNIQUENESS')
        title = rows[0]
        require(title.get('num_id_tit_ap') == tid and title.get('cod_empresa') == str(company['cod_emp_ems5']) and title.get('cdn_fornecedor') == config['seed']['fornecedor_id'], 'TITLE_COMPANY_SUPPLIER')
        require(title.get('cod_estab') and title.get('log_tit_ap_estordo') is False and title.get('ind_tip_espec_docto', '').lower().startswith('antecipa'), 'TITLE_ANTICIPATION_ELIGIBILITY')
        require(isinstance(title.get('dat_emis_docto'), str) and title['dat_emis_docto'] >= config['seed']['dt_registro'], 'TITLE_ISSUE_DATE_ELIGIBILITY')
        values = entry.get('title_values', [])
        for currency in ['dolar', 'corrente']:
            candidates = [row for row in values if str(row.get('cod_finalid_econ', '')).lower() == currency]
            require(len(candidates) == 1, 'EXACT_DOLLAR_CURRENT_CURRENCIES')
            row = candidates[0]
            require(row.get('num_id_tit_ap') == tid and row.get('val_origin_tit_ap') is not None and Decimal(str(row['val_origin_tit_ap'])) > 0 and row.get('val_pagto_tit_ap') is not None and Decimal(str(row['val_pagto_tit_ap'])) >= 0, 'VALID_CURRENCY_VALUES')
        snapshots.append({'num_id_tit_ap': tid, 'titleMatches': 1, 'origin': 'MED', 'validCurrency': True, 'eligible': True,
                          'title': title, 'title_values': values, 'container_links': [],
                          'order_links': [r for r in raw['payment_links'] if r['num_id_tit_ap'] == tid],
                          'ledger_rows': [r for r in ledger if r['num_id_tit_ap'] == tid]})
    # The closed graph has no containers/allocations. No note/stock row is selected
    # or written. Do not describe this as a global note/stock database snapshot.
    graph = {key: raw[key] for key in ['container_links', 'allocations', 'commercial_allocations', 'attachments', 'expenses']}
    graph['notesStockScope'] = 'empty:no-item-container-or-commercial-allocation'
    digest = hashlib.sha256(json.dumps(graph, sort_keys=True, separators=(',', ':')).encode()).hexdigest()
    return {**request, 'source': 'official-openedge12.2', 'readOnly': True, 'success': True,
            'capturedAt': raw.get('capturedAt', datetime.now(timezone.utc).isoformat()),
            'supplierId': config['seed']['fornecedor_id'], 'titles': snapshots,
            'orders': raw['orders'], 'items': raw['items'], 'payment_links': raw['payment_links'],
            'ledger': ledger, 'untouchedCommercialSha256': digest,
            'commercialProofScope': graph}


def validate_cleanup(manifest, evidence, authorization, manifest_hash):
    validate_authorization(authorization)
    require(re.fullmatch('[a-f0-9]{64}', manifest_hash or '') and canonical_hash(manifest) == manifest_hash, 'EXACT_MANIFEST_SHA256')
    require(manifest.get('version') == 1 and manifest.get('tag') == TAG and manifest.get('source') == 'confirmed-native-audit-and-official-openedge12.2', 'NATIVE_PHYSICAL_MANIFEST_REQUIRED')
    require(manifest.get('broadDeleteAllowed') is False and manifest.get('deleteConfirmedLogs') is False, 'NO_BROAD_DELETE_OR_LOG_DELETE')
    parent, items, created = native_creations(evidence, authorization)
    require(parent is not None and parent['proc_compra_id'] == manifest.get('proc_compra_id'), 'CLEANUP_NEW_PARENT_PROVENANCE')
    require(manifest.get('itemIds') == list(items) and len(items) == 3, 'CLEANUP_THREE_GENERATED_ITEMS')
    require(manifest.get('titleIds') == authorization['titleIds'], 'CLEANUP_AUTHORIZED_TITLES')
    rows = manifest.get('physicalRows', []); owners = manifest.get('ownership', [])
    ids = manifest.get('ledgerIds', [])
    require(type(ids) is list and len(ids) == len(set(ids)) and all(map(positive, ids)), 'EXACT_UNIQUE_CLEANUP_IDS')
    require(len(rows) == len(ids) == len(owners) and sorted(r.get('cta_corren_fornec_imp_id') for r in rows) == ids, 'CLEANUP_COMPLETE_IMAGES')
    groups = defaultdict(Decimal); seen_logs = set()
    for row in rows:
        require(set(row) == set(FIELDS), 'EXACT13_CLEANUP_FIELDS')
        key = row['cta_corren_fornec_imp_id']; proof = created.get(key)
        require(proof is not None, 'CONFIRMED_NEW_LEDGER_LOG_REQUIRED')
        require({k: proof['image'].get(k) for k in FIELDS} == row and proof['image'].get('proc_compra_id') == parent['proc_compra_id'], 'CONFIRMED_LEDGER_IMAGE_OWNER')
        matches = [p for p in owners if p.get('ledgerId') == key]
        require(len(matches) == 1 and all(matches[0].get(k) == proof[k] for k in ['image', 'logId', 'transactionId']), 'EXCLUSIVE_NEW_TEST_LOG_IDS')
        require(proof['logId'] not in seen_logs, 'DUPLICATE_CREATION_LOG'); seen_logs.add(proof['logId'])
        require(row['item_proc_compra_id'] in items and row['item_container_id'] == 0 and row['fornecedor_id'] == parent['fornecedor_id'] and row['login'] == authorization['expectedActor'] and row['transacao_id'] == 0, 'CLEANUP_EXCLUSIVE_OWN_ROW')
        require(row['cod_tipo_movto'] in [3, 4] and (row['num_id_tit_ap'] == 0 and row['cod_tipo_movto'] == 3 or row['num_id_tit_ap'] in authorization['titleIds']), 'CLEANUP_CLOSED_TYPES_TITLES')
        group = tuple(row[k] for k in ['item_proc_compra_id', 'cod_tipo_movto', 'num_id_tit_ap', 'fornecedor_id', 'item_container_id'])
        groups[group] += Decimal(str(row['vl_lancto']))
    require(all(value == 0 for value in groups.values()), 'ALL_LEDGER_GROUPS_MUST_BE_ZERO')
    return parent, list(items)


def verify_artifacts(directory):
    manifest = read(directory / 'artifacts.json')
    for name, digest in manifest['files'].items():
        require(re.fullmatch('[A-Za-z0-9][A-Za-z0-9_.-]*', name) and sha(directory / name) == digest, 'FROZEN_ARTIFACT_HASH_MISMATCH')
    return manifest


def verify_readiness():
    readiness = read(TEMPLATES / 'readiness.json')
    require(readiness.get('enabled') is True and readiness.get('official122Compiled') is True
            and readiness.get('independentlyReviewed') is True, 'BRIDGE_UNAVAILABLE_PENDING_OFFICIAL12_2_REVIEW')
    package_file = TEMPLATES / 'package-manifest.json'
    require(package_file.exists(), 'PACKAGE_REVIEW_HASH_REQUIRED')
    package_hash = sha(package_file)
    require(readiness.get('packageSha256') == package_hash, 'READINESS_EXACT_REVIEWED_PACKAGE')
    package = read(package_file)
    required = {'tools/construtor-local/purchase-items-physical-bridge.py',
                'tools/construtor-local/exercise-purchase-items.cjs',
                'tools/construtor-local/containers-remote-task.py',
                'tools/construtor-local/purchase-items-metadata-common.cjs',
                'tools/construtor-local/purchase-payments-builder-common.cjs',
                'integration-src/purchase-items/metadata/proc-compra-itens-builder-draft.json',
                '.runtime/purchase-orders-20261022/qualified-pair/fixture/FixtureSupport.i'}
    required |= {'.runtime/purchase-items-20261022/physical-bridge/' + name for name in
                 ['adapter.cjs', 'PhysicalRead.p', 'CleanupLedger.p', 'CompileBridge.p', 'RunBridge.ps1.template']}
    require({entry['file'] for entry in package.get('files', [])} == required, 'COMPLETE_CLOSED_PACKAGE_FILES')
    for entry in package['files']:
        require(sha(ROOT / entry['file']) == entry['sha256'], 'REVIEWED_PACKAGE_SOURCE_CHANGED')
    proof = read(TEMPLATES / 'official-compile-verification.json')
    require(proof.get('success') is True and proof.get('version') == '12.2' and proof.get('compileOnly') is True
            and proof.get('databasesConnected') == 0 and proof.get('programsExecuted') is False, 'OFFICIAL_COMPILE_ONLY_PROOF_REQUIRED')
    for entry in proof['files']:
        name = entry['name']
        source = TEMPLATES / name if name in ['PhysicalRead.p', 'CleanupLedger.p', 'CompileBridge.p'] else TEMPLATES / 'compile-candidate' / name
        require(sha(source) == entry['sha256'], 'OFFICIAL_COMPILED_SOURCE_CHANGED')
    require(sha(TEMPLATES / 'compile-candidate/compile.log') == proof['logSha256'], 'OFFICIAL_COMPILE_LOG_CHANGED')
    review_file = TEMPLATES / 'independent-review.json'
    require(review_file.exists(), 'INDEPENDENT_REVIEW_PENDING')
    review = read(review_file)
    require(review.get('success') is True and review.get('reviewedPackageSha256') == package_hash
            and review.get('blockingFindings') == [] and isinstance(review.get('reference'), str)
            and review['reference'].strip(), 'EXACT_INDEPENDENT_REVIEW_REQUIRED')
    return package_hash


def prepare_probe(request, authorization, config, output, evidence=(), cleanup=None, require_consent=True):
    validate_request(request, authorization, evidence, require_consent)
    require(config.get('titleIds') == request['titleIds'] and positive(config.get('seed', {}).get('fornecedor_id')) and positive(config.get('seed', {}).get('empresa_id')), 'EXACT_PRIVATE_CONFIG')
    require(re.fullmatch(r'\d{4}-\d{2}-\d{2}', config['seed'].get('dt_registro', '')), 'REGISTRATION_DATE')
    output = Path(output); output.mkdir(parents=True, exist_ok=True)
    require(not list(output.iterdir()), 'FRESH_STAGE_DIRECTORY_REQUIRED')
    remote = 'C:/Users/tadeu.parreiras/codex-purchase-items-physical-20261022-' + uuid.uuid4().hex
    action = 'cleanup' if cleanup else 'probe'
    payload = {'request': request, 'seed': config['seed'], 'action': action, 'actor': authorization['expectedActor']}
    if cleanup:
        manifest, expected_hash = cleanup
        validate_cleanup(manifest, evidence, authorization, expected_hash)
        write_new(output / 'cleanup-manifest.json', manifest)
        payload['manifestSha256'] = expected_hash
        payload['manifestFileSha256'] = sha(output / 'cleanup-manifest.json')
        payload['approved_titles'] = config['approved_titles']
    write_new(output / 'request.json', payload)
    for name in ['PhysicalRead.p', 'CleanupLedger.p', 'CompileBridge.p']:
        (output / name).write_bytes((TEMPLATES / name).read_bytes())
    # Generic official-12.2 snapshot/equality helper only; no former scenario code.
    support = ROOT / '.runtime/purchase-orders-20261022/qualified-pair/fixture/FixtureSupport.i'
    (output / 'BridgeSupport.i').write_bytes(support.read_bytes())
    hashes = {file.name: sha(file) for file in output.iterdir() if file.is_file()}
    script = (TEMPLATES / 'RunBridge.ps1.template').read_text(encoding='utf-8').replace('__REMOTE__', remote).replace('__ACTION__', action).replace('__HASHES__', json.dumps(hashes, separators=(',', ':')))
    (output / 'RunBridge.ps1').write_text(script, encoding='utf-8', newline='\n')
    files = sorted(file.name for file in output.iterdir() if file.is_file())
    plan = {'server': 'compiler', 'directories': [remote],
            'uploads': [{'local': str((output / name).resolve().relative_to(ROOT)), 'remote': remote + '/' + name} for name in files],
            'commands': ['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File ' + remote + '/RunBridge.ps1'],
            'downloads': [{'local': str((output / name).resolve().relative_to(ROOT)), 'remote': remote + '/' + name, 'optional': name != 'bridge-result.json'} for name in ['bridge-result.json', 'remote-receipt.json', 'compile.log', 'avm-stdout.log', 'avm-stderr.log', 'compile-stdout.log', 'compile-stderr.log']]}
    write_new(output / 'remote-plan.json', plan)
    files.append('remote-plan.json')
    write_new(output / 'artifacts.json', {'version': 1, 'tag': TAG, 'action': action, 'official122Compiled': False, 'executed': False, 'remote': remote,
                                         'genericSnapshotSource': str(support.relative_to(ROOT)), 'genericSnapshotSourceSha256': sha(support),
                                         'files': {name: sha(output / name) for name in files}})
    return output


def execute_prepared(directory, authorization, execute=False):
    require(execute is True, 'EXPLICIT_EXECUTE_FLAG_REQUIRED')
    validate_authorization(authorization)
    # Deliberately unavailable at this checkpoint. Root must separately compile,
    # review and bind the prepared package before enabling any transport.
    verify_readiness()
    directory = Path(directory).resolve()
    require(directory.is_relative_to(TEMPLATES.resolve()), 'PRIVATE_BRIDGE_STAGE_REQUIRED')
    artifacts = verify_artifacts(directory)
    payload = read(directory / 'request.json')
    current = read(PRIVATE / 'authorization.json'); validate_authorization(current)
    require(current == authorization, 'AUTHORIZATION_CHANGED')
    if artifacts['action'] == 'cleanup':
        gate = read(TEMPLATES / 'cleanup-authorization.json')
        require(gate.get('authorized') is True and gate.get('tag') == TAG and gate.get('manifestSha256') == payload['manifestSha256'] and gate.get('humanApprovalReference') == authorization['humanApproval']['reference'], 'EXACT_ROOT_CLEANUP_GATE_PENDING')
        write_new(TEMPLATES / 'cleanup-write-started.json', {'tag': TAG, 'manifestSha256': payload['manifestSha256'], 'outcome': 'unknown-inspect-never-replay'})
    write_new(directory / 'transport-started.json', {'tag': TAG, 'outcome': 'unknown-no-automatic-retry', 'artifactsSha256': sha(directory / 'artifacts.json')})
    helper = ROOT / 'tools/construtor-local/containers-remote-task.py'
    # No shell, dynamic hostname or command text supplied by the caller.
    subprocess.run([sys.executable, str(helper), str(directory / 'remote-plan.json')], cwd=ROOT, check=True, timeout=210)
    verify_artifacts(directory)
    receipt = read(directory / 'remote-receipt.json')
    require(receipt.get('success') is True and receipt.get('compileVerified') is True and receipt.get('action') == artifacts['action'], 'REMOTE_RECEIPT_UNCONFIRMED')
    compile_log = (directory / 'compile.log').read_text(encoding='utf-8-sig')
    require('OpenEdge 12.2' in compile_log and 'PASS COMPILE BOTH' in compile_log and 'COMPILER:ERROR=yes' not in compile_log and 'COMPILER:ERROR=true' not in compile_log, 'OFFICIAL12_2_COMPILATION_PENDING')
    raw = read(directory / 'bridge-result.json')
    require(raw.get('success') is True and str(raw.get('version', '')).startswith('12.2'), 'OFFICIAL_AVM_RESULT_REQUIRED')
    return raw


def main():
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('action', choices=['prepare', 'probe', 'cleanup'])
    parser.add_argument('--request', type=Path, required=True)
    parser.add_argument('--execute-session', action='store_true')
    parser.add_argument('--manifest-sha256')
    parser.add_argument('--output', type=Path)
    args = parser.parse_args()
    authorization = read(PRIVATE / 'authorization.json')
    request = read(args.request); config = read(PRIVATE / 'exercise-config.json'); evidence = collect_evidence(PRIVATE / 'exercise')
    cleanup = None
    if args.action == 'cleanup':
        require(args.execute_session, 'EXPLICIT_EXECUTE_CLEANUP_REQUIRED')
        manifest = read(PRIVATE / 'exercise/cleanup-exact-ledger-manifest.json')
        cleanup = manifest, args.manifest_sha256
        baseline = read(PRIVATE / 'exercise/confirmed-preflight.json')
        config['approved_titles'] = baseline['physical']['titles']
        require(read(PRIVATE / 'exercise/confirmed-delete-header.json').get('success') is True and read(PRIVATE / 'exercise/confirmed-prepare-cleanup.json').get('manifestSha256') == args.manifest_sha256, 'API_TEARDOWN_AND_ROOT_MANIFEST_REQUIRED')
    destination = args.output or TEMPLATES / 'runs' / (request['phase'] + '-' + uuid.uuid4().hex)
    require(destination.resolve().is_relative_to(TEMPLATES.resolve()), 'PRIVATE_OUTPUT_ONLY')
    stage = prepare_probe(request, authorization, config, destination, evidence, cleanup, require_consent=args.action != 'prepare')
    if args.action == 'prepare':
        require(not args.execute_session, 'PREPARE_NEVER_EXECUTES');print('Prepared only; not compiled; not executed.');return
    raw = execute_prepared(stage, authorization, args.execute_session)
    if cleanup:
        require(raw.get('committed') is True and raw.get('manifestSha256') == args.manifest_sha256 and raw.get('removedLedgerIds') == cleanup[0]['ledgerIds'], 'EXACT_CLEANUP_COMMIT_REQUIRED')
        result = {**raw, 'source': 'official-openedge12.2', 'confirmedLogsPreserved': True, 'logPreservationScope': 'helper has no native-log connection; executor rechecks native logs in verify-final'}
        write_new(TEMPLATES / 'cleanup-proof.json', result)
    else:
        result = normalize_snapshot(raw, request, config)
        write_new(stage / 'normalized-snapshot.json', result)
    if args.output:
        print(str(stage))
    else:
        print('Confirmed private official12.2 evidence: ' + str(stage.relative_to(ROOT)))


if __name__ == '__main__':
    try:
        main()
    except Exception:
        print('Bridge not confirmed; inspect private receipts; never replay unknown cleanup.', file=sys.stderr)
        raise SystemExit(1)
