from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parent;w=root.parents[3]
state=w/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
receipt=json.loads((state/'verification-v1.1.json').read_text(encoding='utf-8'))
manifest={'package':'container-expense-batch-preflight/replay-actual-config','version':'1.1','status':'candidate-ready-central-TT-green-proposal-not-authorized',
 'businessExecuted':False,'numDbs':0,'canonicalFilesChanged':False,'frozenPreflightV1_1Changed':False,'officialCompileRequiredForReplay':True,
 'testCommand':'powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config/run.ps1',
 'receiptCommand':'python integration-src/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config/proposal.py',
 'localEvidence':{'openedge':'12.8','checks':150,'combinations':4,'codepages':['UTF-8','ISO8859-1'],'cultures':['AMERICAN','EUROPEAN'],'quoteFixtures':[1,7.123],'maxFiscalRows':5,'maxTotalExpenses':7,'maxMemories':4},
 'caps':{'fiscalRows':20,'totalExpenses':22,'memories':4},
 'gates':['root official12.2 replay compile if required; local12.8 is not official','human authorization of exact private proposal hash before any real mutation or grant','recheck CID absence/config/IMA/auth/context/real quote collector','cleanup fixed canonical API only; verified current trigger closure does not claim current deletion execution'],
 'verificationPath':(state/'verification-v1.1.json').as_posix(),'verificationSha256':sha(state/'verification-v1.1.json'),'proposalPath':receipt['proposalPath'],'proposalSha256':receipt['proposalSha256'],
 'captureSha256':receipt['inputs']['captureSha256'],'cleanupProofSha256':receipt['cleanupProofSha256'],'baselines':receipt['inputs']['baselines'],
 'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json']}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1.1';assert not snapshot.exists(),'immutable snapshot already exists'
shutil.copytree(root,snapshot)
(state/'freeze-v1.1.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'snapshot':snapshot.as_posix(),'proposalSha256':receipt['proposalSha256'],'verificationSha256':sha(state/'verification-v1.1.json')},indent=2)+'\n',encoding='utf-8')
print('PASS frozen manifest SHA256 '+sha(root/'manifest.json'))
