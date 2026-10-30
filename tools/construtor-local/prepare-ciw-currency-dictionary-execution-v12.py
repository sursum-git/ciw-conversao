"""Bind reviewed v1.2 dictionary-only probe to freshly proven fixed brokers."""
from pathlib import Path
import json
import hashlib

ROOT = Path(__file__).resolve().parents[2]
BASE = ROOT / '.runtime/ciw-completion-20261028/daily-currency-login-sync'
OUT = BASE / 'dictionary-probe-v1.2'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(OUT / 'manifest.json') == '74aa8dacce538c5e107d9af241a517197af9fdfc25ce6c7b041076e9e42fea77'
assert sha(OUT / 'manager-review.json') == '0437db89fd209b91bcd0ab77a8b3dd780038cf989c008bf89858e308a046fe1a'
manifest = load(OUT / 'manifest.json')
for item in manifest['changes']:
    assert sha(Path(item['baselinePath'])) == item['baselineSha256']
    assert sha(Path(item['candidatePath'])) == item['candidateSha256']
for item in manifest['evidence']:
    assert sha(Path(item['path'])) == item['sha256']
assert sha(OUT / 'remote-plan.json') == manifest['remotePlanSha256']
broker_file = BASE / 'dictionary-probe/current-brokers-readonly-v3.json'
observed = load(broker_file)
assert observed['success'] and not observed['businessReads']
actual = {x['databaseBasename']: x for x in observed['brokers']}
assert set(actual) == {'ems2cad', 'ems5'}
assert actual['ems2cad']['port'] == 10033 and actual['ems5']['port'] == 10032
descriptor = OUT / 'root-dictionary-connections.json'
execution = OUT / 'execution-plan-root-v1.json'
assert not descriptor.exists() and not execution.exists()
assert not (OUT / 'compile.log').exists()
bindings = [dict(database='ems2cad', host='192.168.0.111', logicalName='comum', port=10033),
            dict(database='ems5', host='192.168.0.111', logicalName='ems5', port=10032)]
descriptor.write_text(json.dumps(dict(approvedFor='daily-currency-login-sync-dictionary-only', connections=bindings), indent=2) + '\n')
plan = load(OUT / 'remote-plan.json')
assert plan['commands'] == [] and not plan['readyToExecute']
stage = plan['directories'][0]
assert stage == 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-currency-dictionary-ro-v1_2'
plan['uploads'].append(dict(local=str(descriptor.relative_to(ROOT)), remote=stage + '/root-dictionary-connections.json'))
plan['commands'] = ['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File ' + stage + '/RunProbe122.ps1 -ConnectionsFile ' + stage + '/root-dictionary-connections.json']
plan['readyToExecute'] = True
plan['state'] = 'ROOT_REVIEWED_DICTIONARY_READ_ONLY'
plan['rootBindingsEvidenceSha256'] = sha(broker_file)
execution.write_text(json.dumps(plan, indent=2) + '\n')
(OUT / 'root-preflight.json').write_text(json.dumps(dict(success=True, manifestSha256=sha(OUT/'manifest.json'), planSha256=sha(execution), brokerEvidenceSha256=sha(broker_file), numDbs=2, tables=['comum.cotacao', 'ems5.cotac_parid'], businessReads=False, businessWrites=False), indent=2) + '\n')
print('PASS v1.2 pins, two fixed brokers, fresh stage; dictionary-only execution ready')
