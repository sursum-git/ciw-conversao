"""Bind reviewed metadata-only probe to the two freshly observed production brokers."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028/daily-currency-login-sync';B=S/'dictionary-probe-v1.1'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(B/'manifest.json')=='50cba9b4643ce5375304a88ffc9daafcbcafdb9c79ae0fe797ad76fb21b3cdfd'
m=load(B/'manifest.json');assert sha(Path(m['candidateSourcePath']))==m['candidateSourceSha256']
for item in m['sharedUnchanged']:assert sha(Path(item['path']))==item['sha256']
assert sha(B/'remote-plan.json')=='60b89d1bb5609be250a3e37cf62cb27829a0fc0817444c0a2e55866c79974f5c'
brokerFile=S/'dictionary-probe/current-brokers-readonly-v3.json';observed=load(brokerFile);assert observed['success']and not observed['businessReads']
actual={x['databaseBasename']:x for x in observed['brokers']};assert set(actual)=={'ems2cad','ems5'}and actual['ems2cad']['port']==10033 and actual['ems5']['port']==10032
connections=[dict(database='ems2cad',host='192.168.0.111',logicalName='comum',port=10033),dict(database='ems5',host='192.168.0.111',logicalName='ems5',port=10032)]
descriptor=B/'root-dictionary-connections.json';planFile=B/'execution-plan-root-v1.json';assert not descriptor.exists()and not planFile.exists()
descriptor.write_text(json.dumps(dict(approvedFor='daily-currency-login-sync-dictionary-only',connections=connections),indent=2)+'\n')
plan=load(B/'remote-plan.json');assert plan['commands']==[]and not plan['readyToExecute'];stage=plan['directories'][0]
assert stage=='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-currency-dictionary-ro'
assert not(S/'dictionary-probe/compile.log').exists()
plan['uploads'].append(dict(local=str(descriptor.relative_to(R)),remote=stage+'/root-dictionary-connections.json'))
plan['commands']=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+stage+'/RunProbe122.ps1 -ConnectionsFile '+stage+'/root-dictionary-connections.json']
plan['readyToExecute']=True;plan['state']='ROOT_REVIEWED_DICTIONARY_READ_ONLY';plan['rootBindingsEvidenceSha256']=sha(brokerFile)
planFile.write_text(json.dumps(plan,indent=2)+'\n')
(B/'root-preflight.json').write_text(json.dumps(dict(success=True,manifestSha256=sha(B/'manifest.json'),planSha256=sha(planFile),brokerEvidenceSha256=sha(brokerFile),numDbs=2,tables=['comum.cotacao','ems5.cotac_parid'],businessReads=False,businessWrites=False,credentialsInDescriptor=False),indent=2)+'\n')
print('PASS two current broker bindings fixed; metadata-only plan ready; no business-table access')
