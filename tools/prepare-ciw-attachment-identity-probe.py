"""Prepare only: bounded official 12.2 RO attachment identity probe for root."""
import hashlib
import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
STATE = ROOT / '.runtime/ciw-completion-20261028'
OLD = STATE / 'ledger-identity-readonly-probe/execution-v1.1'
OUT = STATE / 'attachment-identity-readonly-probe'
REMOTE = 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-attachment-identity-ro-v1'
OUT.mkdir(exist_ok=False)
source = (OLD / 'LedgerIdentityReadonlyProbe.p').read_text(encoding='utf-8-sig')
source = source.replace('No business program, amount, name or write.', 'Only MED identity and persisted basename; no business program or write.')
source = source.replace('DEFINE BUFFER bLedger FOR espec.cta_corren_custo_distr.', 'DEFINE BUFFER bLedger FOR espec.anexos_container.')
source = source.replace('DEFINE BUFFER bItem FOR espec.itens_container.', 'DEFINE BUFFER bItem FOR espec.pp-container.')
source = source.replace('DEFINE VARIABLE parentFound AS LOGICAL NO-UNDO.', 'DEFINE VARIABLE parentFound AS LOGICAL NO-UNDO.\nDEFINE VARIABLE referenceValue AS CHARACTER NO-UNDO.\nDEFINE VARIABLE safeReference AS LOGICAL NO-UNDO.')
source = source.replace('item_container_id cta_corren_custo_distr_id', 'container_id anexo_container_id caminho_arquivo')
source = source.replace('ownerValue=bLedger.item_container_id ledgerValue=bLedger.cta_corren_custo_distr_id.', 'ownerValue=bLedger.container_id ledgerValue=bLedger.anexo_container_id\n          referenceValue=bLedger.caminho_arquivo.')
source = source.replace('OR ledgerValue=? THEN NEXT.', 'OR ledgerValue=? OR ledgerValue<1 OR referenceValue=? OR referenceValue="" THEN NEXT.\n   safeReference=LENGTH(referenceValue,"RAW")<=255 AND referenceValue<>"." AND referenceValue<>".."\n     AND INDEX(referenceValue,"/")=0 AND INDEX(referenceValue,CHR(92))=0.\n   DO n=1 TO LENGTH(referenceValue):\n    IF ASC(SUBSTRING(referenceValue,n,1))<32 OR ASC(SUBSTRING(referenceValue,n,1))=127 THEN safeReference=FALSE.\n   END.\n   IF NOT safeReference THEN NEXT.')
source = source.replace('bItem.item_container_id=ownerValue NO-LOCK', 'bItem.nr-container=ownerValue AND bItem.cod-estabel BEGINS "5" NO-LOCK')
source = source.replace("pairValue:Add('item_container_id',ownerValue). pairValue:Add('cta_corren_custo_distr_id',ledgerValue).", "pairValue:Add('container_id',ownerValue). pairValue:Add('anexo_container_id',ledgerValue). pairValue:Add('basename',referenceValue).")
source = source.replace("ledger-identity-private.json", "attachment-identity-private.json")
(OUT / 'AttachmentIdentityReadonlyProbe.p').write_text(source, encoding='utf-8', newline='\n')
compile_source = (OLD / 'Compile.p').read_text(encoding='utf-8-sig').replace('LedgerIdentityReadonlyProbe', 'AttachmentIdentityReadonlyProbe')
(OUT / 'Compile.p').write_text(compile_source, encoding='utf-8', newline='\n')
ps = (OLD / 'RunProbe122.ps1').read_text(encoding='utf-8-sig')
ps = ps.replace('C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-ledger-identity-ro-v1_1', REMOTE)
ps = ps.replace('ledger-identity-private.json', 'attachment-identity-private.json').replace('LedgerIdentityReadonlyProbe', 'AttachmentIdentityReadonlyProbe')
ps = ps.replace("'cta_corren_custo_distr_id,item_container_id'", "'anexo_container_id,basename,container_id'")
ps = ps.replace("throw 'Identity-only output required'", "throw 'Closed identity/basename output required'")
ps = ps.replace('see private JSON', 'private identities/basenames saved; never print JSON')
(OUT / 'RunProbe122.ps1').write_text(ps, encoding='utf-8', newline='\r\n')
local = str(OUT.relative_to(ROOT)).replace('\\', '/')
uploads = ['Compile.p', 'AttachmentIdentityReadonlyProbe.p', 'RunProbe122.ps1']
downloads = ['compile.log', 'compile-process.log', 'probe-process.log', 'attachment-identity-private.json']
plan = {'server': 'compiler', 'directories': [REMOTE],
        'uploads': [{'local': local+'/'+name, 'remote': REMOTE+'/'+name} for name in uploads],
        'commands': ['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+REMOTE+'/RunProbe122.ps1'],
        'downloads': [{'local': local+'/results/'+name, 'remote': REMOTE+'/'+name} for name in downloads]}
(OUT / 'remote-execution-plan.json').write_text(json.dumps(plan, indent=2)+'\n', encoding='utf-8')
sha = lambda path: hashlib.sha256(path.read_bytes()).hexdigest()
manifest = {'status': 'PREPARED_NOT_EXECUTED', 'official122Required': True, 'maximumPairs': 5,
            'scanCap': 50000, 'timeoutSeconds': 10, 'fields': ['container_id', 'anexo_container_id', 'basename'],
            'parent': 'espec.pp-container existing nr-container with cod-estabel BEGINS 5',
            'tables': ['espec.anexos_container', 'espec.pp-container'],
            'noLock': True, 'numDbs': 1, 'partialResultsCleared': True,
            'businessProgramCalls': 0, 'canonicalChanges': False, 'remoteExecuted': False,
            'fileExistenceOrDownloadProven': False,
            'note': 'Only observed persisted safe basenames; root must privately prove broker root and file availability. Do not print result rows.',
            'files': [{'path': name, 'sha256': sha(OUT/name)} for name in uploads+['remote-execution-plan.json']]}
(OUT/'manifest.json').write_text(json.dumps(manifest, indent=2)+'\n', encoding='utf-8')
print(json.dumps({'prepared': True, 'manifestSha256': sha(OUT/'manifest.json'),
                  'planSha256': sha(OUT/'remote-execution-plan.json')}))
