from pathlib import Path
import json,hashlib,copy
root=Path(__file__).resolve().parents[1];w=root.parents[2];before=w/'.runtime/ciw-completion-20261028/container-attachments-current';out=root/'metadata';out.mkdir(exist_ok=True)
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
def write(name,value):(out/name).write_text(json.dumps(value,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
sourcePath=before/'source-current.json';source=read(sourcePath)['apiSource'];assert source['code']=='motor_progress_container_painel'and len(source['operations'])==10
op=copy.deepcopy(next(x for x in source['operations']if x['code']=='anexos_get'));op.update({'code':'anexos_arquivo_get','name':'Referencia autenticada do anexo do container MED','type':'detail','requestContextFields':['container_id'],'bodyTemplate':{'resource':'anexos-arquivo','operation':'get'},'itemPath':'data'});assert not op.get('headers')
preview={k:source[k]for k in ['code','name','baseUrl','responseContract','operations']};preview=copy.deepcopy(preview);preview['operations'].append(op);write('api-source-preview.json',preview)
write('source-addition.json',{'target':sourcePath.as_posix(),'baselineSha256':sha(sourcePath),'targetPointer':'/apiSource','sourceCode':source['code'],'preserveGlobalAuthentication':True,'neverWriteSanitizedDTO':True,'expectedOperationCount':10,'resultOperationCount':11,'operations':[{'op':'add','path':'/operations/-','value':op}]})
entityPath=before/'container-anexos-entity.json';entity=read(entityPath)['entity'];assert len(entity['fields'])==8 and entity['apiDetailOperationCode']=='anexos_get'
field={'code':'caminho_arquivo','label':'Arquivo','dataType':'string','primaryKey':False,'required':False,'readonlyField':True,'apiJsonPath':'caminho_arquivo','apiWritePath':'caminho_arquivo','apiShowInGrid':False,'apiShowInForm':True,'apiShowInFilter':False,'position':90,'options':{'readonly':True,'writable':False,'editor':'file'}}
write('entity-delta.json',{'target':entityPath.as_posix(),'baselineSha256':sha(entityPath),'targetPointer':'/entity','entityCode':entity['code'],'applyThroughNativeBuilder':True,'neverWriteSanitizedMetadataAuthentication':True,'operations':[{'op':'replace','path':'/apiDetailOperationCode','value':'anexos_arquivo_get'},{'op':'add','path':'/fields/-','value':field}],'resultFieldCount':9,'preserveAllEightFields':True})
draft=copy.deepcopy(entity);draft['apiDetailOperationCode']='anexos_arquivo_get';draft['fields'].append(field)
# Preview inputs include only native authoring properties. Do not copy sanitised nested auth.
keys=['code','name','entityType','structureType','structureModuleCode','structureBaseNumber','apiSourceCode','apiListOperationCode','apiDetailOperationCode','fields']
draft={k:draft[k]for k in keys};draft['createPhysicalTable']=False
programPath=before/'op1004-program.json';program=read(programPath);version=next(v for v in program['versions']if v['version']=='1.0.0');config=copy.deepcopy(version['builderConfig']);assert config['screenId']=='ciw.container-anexos'and all(config[n]is False for n in ['allowCreate','allowUpdate','allowDelete'])
config['changeSummary']='Download autenticado readonly; contexto MED e referencia recuperados no servidor.'
write('builder-preview-input.json',{'entityDraft':draft,'programDraft':config})
write('program-delta.json',{'target':programPath.as_posix(),'baselineSha256':sha(programPath),'targetPointer':'/versions/0/builderConfig','programCode':'op1004','baselineVersion':'1.0.0','createNewVersionThroughNativeBuilder':True,'newVersion':'root selects next available version','operations':[{'op':'replace','path':'/changeSummary','value':config['changeSummary']}],'preserveAllOtherConfig':True,'newFieldAutoAppearsInExistingDefaultForm':True,'noNewScreenOrCode':True})
print('Prepared live op1004/entity/source10+1 additive deltas, authentication never overwritten')
