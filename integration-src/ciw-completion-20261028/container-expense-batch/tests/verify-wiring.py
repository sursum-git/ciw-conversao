from pathlib import Path
import json
root=Path(__file__).resolve().parents[1];api=(root/'abl/ContainersDespesasBatchApi.p').read_text(encoding='utf-8');service=(root/'abl/ContainersDespesasBatchService.p').read_text(encoding='utf-8')
assert 'clean=CAST(poRequest:Clone(),JsonObject).' in api and 'clean:Remove("resource")' not in api
assert 'poRequest:GetCharacter("resource"),"<>","container-despesas-lote","RAW"' in api
assert "poRequest:GetCharacter('resource'),'<>','container-despesas-lote','RAW'" in service
assert 'clean:Has("values")' not in api and 'clean:GetCharacter("operation")="delete"' not in api
assert 'ContainerApiLogin()' in api and '{sursum-api/includes/ContainerApiIdentity.i}' in api
assert 'policy=ContainerMaintenancePolicy(loginValue)' in api and '{sursum-api/includes/parametros_ima.i}' in api
assert 'ContainersDespesasBatchService.r' in api and 'ContainersDespesasCrudService.r' not in api
assert 'RUN VALUE(servicePath)(h[1],h[2],h[3],h[4],h[5],h[6],h[7],h[8],h[9],h[10],h[11],runtime,policy,clean,OUTPUT poResponse)' in api
route=json.loads((root/'patches/bridge/route-addition.json').read_text(encoding='utf-8'))['operations'][0]['value'];assert route==dict(route='/SursumPrograms/containers-despesas-lote',method='POST',program='sursum-api/programs/ContainersDespesasBatchApi.p')
parent=json.loads((root/'patches/bridge/parent-navigation.json').read_text(encoding='utf-8'));before=json.loads(Path(parent['target']).read_text(encoding='utf-8-sig'));index=int(parent['targetPointer'].split('/')[2]);config=before['versions'][index]['builderConfig'];after=json.loads(json.dumps(config));after['rowLinks'].append(parent['operations'][0]['value']);assert after['rowLinks'][:-1]==config['rowLinks'] and any(x['id']=='memoria_calculo'for x in after['rowLinks']);assert {k:v for k,v in after.items()if k!='rowLinks'}=={k:v for k,v in config.items()if k!='rowLinks'};assert parent['baselineVersion']=='1.0.2' and parent['applyToCloneForNewVersion']
print('PASS public wrapper exact wiring and real op1003 1.0.2 parent preservation checks=12; real authenticated PASOE boundary remains official integration gate')
