from pathlib import Path
import json,hashlib,copy
root=Path(__file__).resolve().parents[1];workspace=root.parents[2];state=workspace/'.runtime/ciw-completion-20261028/container-nf-available-readonly';current=workspace/'.runtime/ciw-completion-20261028/container-finance-current';out=root/'metadata';out.mkdir(exist_ok=True)
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda n,v:(out/n).write_text(json.dumps(v,indent=2,ensure_ascii=False)+'\n',encoding='utf8')
s=read(current/'source-current.json')['apiSource'];entity=read(current/'container-nfs-entity.json')['entity'];program=read(current/'op1007-program.json');published=next(v for v in program['versions']if v['status']=='published');reference=read(workspace/'integration-src/container-panel/metadata/nfs-1.0.1-builder-draft.json')
assert s['code']=='motor_progress_container_financeiro' and len(s['operations'])==4 and published['version']=='1.0.1'
assert [(f['code'],f['dataType'])for f in entity['fields']]==[(f['code'],f['dataType'])for f in reference['entityDraft']['fields']]
ops=[]
for operation,kind in [('read','list'),('get','detail')]:
 op={'code':'nfs_disponiveis_'+operation,'name':'NFs disponiveis MED — '+operation,'method':'POST','type':kind,'path':'/SursumPrograms/containers-financeiro','requestContextFields':['container_id'],'bodyTemplate':{'operation':operation,'resource':'nfs-disponiveis'}}
 op['itemsPath'if operation=='read'else'itemPath']='data';ops.append(op)
save('source-addition.json',{'sourceCode':s['code'],'baselinePath':(current/'source-current.json').as_posix(),'baselineSha256':hashlib.sha256((current/'source-current.json').read_bytes()).hexdigest(),'preserveExactlyExistingOperations':4,'applyMode':'append-only-specific-properties-never-replace-authentication','operations':[{'op':'append','path':'operations','value':op}for op in ops]})
source={k:s[k]for k in ['code','name','providerType','baseUrl','status','timeoutSeconds','responseContract']};source['operations']=copy.deepcopy(s['operations'])+ops
# This local preview is NOT a source replacement payload, and carries no headers.
def clear_headers(v):
 if isinstance(v,dict):return{k:clear_headers(x)for k,x in v.items()if k not in ['authHeaders','headers']}
 if isinstance(v,list):return[clear_headers(x)for x in v]
 return v
save('api-source-preview.json',clear_headers(source))
draft=copy.deepcopy(reference);d=draft['entityDraft'];p=draft['programDraft'];d.update(code='container_nfs_disponiveis_med_progress',name='NFs disponíveis para associação — MED',structureBaseNumber=1053,apiListOperationCode='nfs_disponiveis_read',apiDetailOperationCode='nfs_disponiveis_get')
for f in d['fields']:
 f['readonlyField']=True;f['options'].update(readonly=True,writable=False)
 f['apiShowInGrid']=f['code']not in ['container_id','nf_key','documento_localizado'];f['apiShowInFilter']=f['apiShowInGrid'];f['apiShowInForm']=True
p.update(programCode='op1053',programTitle='NFs disponíveis para associação — MED',builderEntityCode=d['code'],screenId='ciw.container-nfs-disponiveis-med',version='1.0.0',subtitle='Consulta de notas ainda disponíveis para este container',permissionPrefix=d['code'],allowCreate=False,allowUpdate=False,allowDelete=False,rowLinks=[],changeSummary='Consulta MED somente leitura da seleção legada; associação e desassociação permanecem separadas.')
p['contextFields']=[{'field':'container_id','filter':True,'createDefault':False,'readonly':True,'required':True}]
visible=[f['code']for f in d['fields']if f['apiShowInGrid']];p['crudOptions']={'pageSize':30,'gridFields':[{'field':name,'hidden':False,'width':155}for name in visible],'filterFields':visible,'defaultSort':[{'field':'documento','dir':'asc'},{'field':'serie','dir':'asc'}]}
save('builder-draft.json',draft)
headerPath=workspace/'.runtime/ciw-completion-20261028/container-header-current/op1000-program.json';header=read(headerPath);headerVersion=next(v for v in header['versions']if v['status']=='published');headerEntity=read(headerPath.parent/'containers-entity.json')['entity'];headerConfig=copy.deepcopy(headerVersion['builderConfig'])
assert header['program']['code']=='op1000' and header['program']['screenId']=='ciw.containers'
assert next(f for f in headerEntity['fields']if f['primaryKey'])['code']=='container_id'
link={'id':'nfs_disponiveis_med','label':'NFs disponíveis — MED','screenId':p['screenId'],'parameters':[{'field':'container_id','sourceField':'container_id'}],'position':'start'}
assert not any(x.get('id')==link['id']for x in headerConfig['rowLinks']);oldLinks=copy.deepcopy(headerConfig['rowLinks']);headerConfig['rowLinks'].append(link);headerConfig['version']='1.0.3';headerConfig['changeSummary']='Acrescenta acesso contextual à consulta MED de NFs disponíveis, inclusive sem notas ou despesas vinculadas.'
save('parent-navigation-delta.json',{'targetProgram':'op1000','targetScreenId':'ciw.containers','baselinePath':headerPath.as_posix(),'baselineSha256':hashlib.sha256(headerPath.read_bytes()).hexdigest(),'expectedPublishedVersion':headerVersion['version'],'candidateVersion':headerConfig['version'],'applyMode':'append-one-rowLink-to-current-builderConfig-preserve-other-properties','existingRowLinks':oldLinks,'appendRowLink':link,'newPermissionsGranted':False})
save('parent-builder-preview.json',{'programDraft':headerConfig,'previewOnly':True,'sourceReferenceProgram':'op1007','noEntityOrAuthenticationReplacement':True})
gate=out/'navigation-gate.json'
if gate.exists():gate.unlink()
print('Prepared op1053/native readonly18 and finance append2 over actual exported source4; no auth payload')
