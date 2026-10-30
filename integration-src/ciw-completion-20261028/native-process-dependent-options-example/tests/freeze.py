from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[1];w=root.parents[2];repo=Path('D:/opencode/construtor-pg');state=w/'.runtime/ciw-completion-20261028/native-process-dependent-options-example'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
v=read(state/'verification.json');assert v['success']and v['checks']==29 and v['httpRequests']==v['xhrRequests']==0
plans=read(root/'patches/patch-plan.json')['textAndBytePatches']
for p in plans:
 target=Path(p['target']);candidate=Path(p['candidatePath']);assert sha(target)==p['baselineSha256']and sha(candidate)==p['candidateSha256'];before=target.read_bytes();insert=bytes.fromhex(p['insertHex']);position=p['insertAtByte'];assert candidate.read_bytes()==before[:position]+insert+before[position:]
source=w/'.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2-test-inputs/native'
for name in ['src/process-engine/ProcessEngine.js','src/process-engine/ProcessDefinitionValidator.js']:
 assert sha(state/'stage'/name)==sha(source/name),'example uses different native engine'
assert not any('process-dependent-options-example.js'in p.read_text(encoding='utf-8-sig')for p in (repo/'production').rglob('*.html'))
bootstrap=(repo/'src/bootstrap/production-crud.js').read_text(encoding='utf-8-sig');assert 'if (!screenId)'in bootstrap and 'buildScreenDefinitionRequest(screenId'in bootstrap
proof=[]
for name in ['production/app.html','src/bootstrap/production-crud.js','src/crud-engine/CrudUtils.js','AGENTS.md','docs/paridade-demo-producao.md']:
 p=repo/name;proof.append({'path':p.as_posix(),'sha256':sha(p),'changed':False})
for name in ['example-desktop.png','example-mobile.png','verification.json','asset-manifest.json']:
 p=state/name;proof.append({'path':p.as_posix(),'sha256':sha(p)})
manifest={'package':'native-process-dependent-options-example','version':'1','status':'candidate-ready-example-parity-review','businessExecuted':False,'canonicalChanged':False,'productionMockAdded':False,'skillAvailability':'construtor-pg-demo-production-parity not installed; canonical documented checklist applied directly','requires1047ManifestSha256':'ed0cc7a801afe2e75d086d61a94972f6d6102514595f3a049689989619631dee',
 'testCommands':['C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe integration-src/ciw-completion-20261028/native-process-dependent-options-example/tests/prepare.py','C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe integration-src/ciw-completion-20261028/native-process-dependent-options-example/tests/verify.cjs'],'verification':v,'sharedPatches':plans,
 'newSources':[{'source':p.relative_to(root).as_posix(),'target':(repo/p.relative_to(root/'candidates')).as_posix(),'sha256':sha(p)}for p in sorted((root/'candidates').rglob('*'))if p.is_file()],
 'gates':['root review and hash-guarded integration','integrate approved1047 native extension before example; current canonical engine does not support dependent opt-in','preserve production screenId/endpointId and no example imports','no production publication/grants/business authorized here'],
 'proof':proof,'files':[{'path':p.relative_to(root).as_posix(),'sha256':sha(p)}for p in sorted(root.rglob('*'))if p.is_file()and p.name!='manifest.json'and'__pycache__'not in p.parts]}
(root/'manifest.json').write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8')
snapshot=state/'frozen-v1';assert not snapshot.exists();shutil.copytree(root,snapshot,ignore=shutil.ignore_patterns('__pycache__'))
inputs=state/'frozen-v1-test-inputs';assert not inputs.exists();inputs.mkdir();shutil.copytree(state/'stage',inputs/'stage')
for name in ['verification.json','asset-manifest.json','example-desktop.png','example-mobile.png','catalog-preview.js','paridade-demo-producao-preview.md']:shutil.copy2(state/name,inputs/name)
(state/'freeze-v1.json').write_text(json.dumps({'manifestSha256':sha(root/'manifest.json'),'candidateSnapshot':snapshot.as_posix(),'testInputsSnapshot':inputs.as_posix(),'testInputFiles':[{'path':p.relative_to(inputs).as_posix(),'sha256':sha(p)}for p in sorted(inputs.rglob('*'))if p.is_file()]},indent=2)+'\n',encoding='utf-8')
print('PASS example/parity frozen; manifest SHA256 '+sha(root/'manifest.json'))
