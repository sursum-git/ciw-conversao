from pathlib import Path
import json,hashlib,copy
root=Path(__file__).resolve().parents[1];w=root.parents[2];checks=0
def check(ok):
 global checks
 assert ok
 checks+=1
def read(path):return json.loads(path.read_text(encoding='utf-8'))
plan=read(root/'patches/abl-plan.json')
api=next(p for p in plan['textPatches']if p['target'].endswith('/ContainersProcessos.p'));text=Path(api['target']).read_text(encoding='utf-8-sig')
for c in api['changes']:text=text.replace(c['old'],c['new'])
check('loginValue=ContainerApiLogin().' in text)
check('{sursum-api/includes/parametros_ima.i}' in text and 'headerPolicy=ContainerMaintenancePolicy(loginValue).' in text)
check('cid=ContainerProcessRequest(poRequest).' in text and 'op="calcular_impostos" AND NOT cEstab BEGINS "5"' in text)
check('hFiscal[1]=hCollector[1]. DO n=1 TO 10: hFiscal[n + 1]=hHeader[n]. END.' in text)
check('RUN VALUE(servicePath)(hVersion,hFiscal,hClose,hVersionRuntime,hHeaderRuntime,headerPolicy,closePolicy,poRequest,OUTPUT poResponse).' in text)
source=read(root/'metadata/source-addition.json');before=read(Path(source['target']));preview=read(root/'metadata/api-source-preview.json')
check(hashlib.sha256(Path(source['target']).read_bytes()).hexdigest()==source['baselineSha256'])
check(preview['operations'][:-1]==before['operations'] and len(before['operations'])==5 and len(preview['operations'])==6)
check('authHeaders' not in preview and source['preserveGlobalAuthentication'] is True)
p=read(root/'metadata/parent-navigation.json');parent=read(Path(p['target']));config=copy.deepcopy(parent['versions'][int(p['targetPointer'].split('/')[2])]['builderConfig']);clone=copy.deepcopy(config)
check(hashlib.sha256(Path(p['target']).read_bytes()).hexdigest()==p['baselineSha256'])
clone['rowLinks'].append(p['operations'][0]['value'])
check(clone['rowLinks'][:-1]==config['rowLinks'] and any(x['id']=='memoria_calculo'for x in clone['rowLinks']))
clone['rowLinks'].pop();check(clone==config and p['baselineVersion']=='1.0.2' and p['applyToCloneForNewVersion'] is True)
check(read(root/'metadata/tax-only-builder-draft.json')['entityReference']=={'code':'container_processos_progress','preserveExisting':True,'createPhysicalTable':False})
print(f'PASS public wrapper wiring, source5 preserved, real parent1.0.2 and entity reuse checks={checks}; authenticated public API execution remains official gate')
