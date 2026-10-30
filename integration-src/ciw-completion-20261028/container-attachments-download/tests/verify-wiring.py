from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/container-attachments-download';front=Path('D:/opencode/construtor-pg');motor=Path('D:/opencode/motor-progress/v2');checks=0
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def check(value,label):
 global checks
 checks+=1;assert value,label
baselines=[]
for e in read(root/'patches/patch-plan.json')['textPatches']:
 p=Path(e['target']);before=p.read_bytes();check(sha(p)==e['baselineSha256'],'canonical baseline moved '+p.name);after=before
 for change in e['changes']:
  a=bytes.fromhex(change['oldBytesHex']);b=bytes.fromhex(change['newBytesHex']);check(after.count(a)==1,'byte anchor unique '+p.name);after=after.replace(a,b)
 check(after==Path(e['candidateRuntimePath']).read_bytes(),'byte patch result '+p.name);check(hashlib.sha256(after).hexdigest()==e['candidateSha256'],'candidate SHA '+p.name)
 restored=after
 for change in reversed(e['changes']):
  a=bytes.fromhex(change['oldBytesHex']);b=bytes.fromhex(change['newBytesHex']);check(restored.count(b)==1,'reverse byte anchor unique '+p.name);restored=restored.replace(b,a)
 check(restored==before,'bytes outside anchors changed '+p.name)
 baselines.append({'target':p.as_posix(),'sha256':sha(p),'candidateSha256':e['candidateSha256'],'baselineBareLF':before.count(b'\n')-before.count(b'\r\n'),'candidateBareLF':after.count(b'\n')-after.count(b'\r\n')})
reader=(state/'local/sursum-api/programs/ContainersPainelReadService.p').read_text(encoding='utf-8-sig');before=(motor/'sursum-api/programs/ContainersPainelReadService.p').read_text(encoding='utf-8-sig')
check(re.findall(r'^DEFINE (?:INPUT|OUTPUT) PARAMETER.*$',reader,re.M)==re.findall(r'^DEFINE (?:INPUT|OUTPUT) PARAMETER.*$',before,re.M),'panel ABI changed')
check(reader.count('PROCEDURE AttachmentExtras:')==1,'metadata extras duplicated')
check(reader.index('CONTAINER_ATTACHMENT_MED_REQUIRED')<reader.index('  IF NOT VALID-HANDLE(hRows) THEN'),'MED not checked before child/reference')
check('cWhere = hRows:NAME + ".container_id = "'in reader and'IF cOperation = "get" THEN cWhere = cWhere + " AND "'in reader,'contextual PK lookup lost')
wrapper=motor/'sursum-api/programs/ContainersPainelRead.p';text=wrapper.read_text(encoding='utf-8-sig');check('HTTP_X_CONTAINERS_TOKEN'in text and'CREATE BUFFER hAnexos FOR TABLE "espec.anexos_container"'in text,'fixed authenticated wrapper missing')
for name in ['schema-anexos_container.json','schema-tipos_anexo.json','schema-pp-container.json']:
 p=w/'integration-src/container-panel/schema'/name;check(p.exists(),'physical schema missing '+name)
physical=read(w/'integration-src/container-panel/schema/schema-anexos_container.json');check(len(physical['fields'])==7 and physical['indexes'][0]['fields']==['anexo_container_id'],'attachment physical schema changed')
preview=read(root/'metadata/api-source-preview.json');addition=read(root/'metadata/source-addition.json');original=read(Path(addition['target']))['apiSource'];check(sha(Path(addition['target']))==addition['baselineSha256'],'source baseline moved')
check(preview['operations'][:10]==original['operations']and len(preview['operations'])==11,'existing source operations changed')
check(preview['operations'][-1]['type']=='detail'and preview['operations'][-1]['bodyTemplate']=={'resource':'anexos-arquivo','operation':'get'},'new reference operation type/binding')
check('authHeaders'not in preview and all(not o.get('headers')for o in preview['operations']),'sanitized authentication copied')
entityDelta=read(root/'metadata/entity-delta.json');entity=read(Path(entityDelta['target']))['entity'];draft=read(root/'metadata/builder-preview-input.json');check(sha(Path(entityDelta['target']))==entityDelta['baselineSha256'],'entity baseline moved')
check(draft['entityDraft']['fields'][:8]==entity['fields']and len(draft['entityDraft']['fields'])==9,'eight existing fields changed')
field=draft['entityDraft']['fields'][-1];check(field['code']=='caminho_arquivo'and field['options']=={'readonly':True,'writable':False,'editor':'file'},'file field not readonly')
programDelta=read(root/'metadata/program-delta.json');program=read(Path(programDelta['target']))['versions'][0]['builderConfig'];check(sha(Path(programDelta['target']))==programDelta['baselineSha256'],'program baseline moved')
check({k:v for k,v in draft['programDraft'].items()if k!='changeSummary'}=={k:v for k,v in program.items()if k!='changeSummary'},'program configuration changed beyond summary')
check(all(draft['programDraft'][n]is False for n in ['allowCreate','allowUpdate','allowDelete']),'writes enabled')
check(draft['programDraft']['programCode']=='op1004'and draft['programDraft']['screenId']=='ciw.container-anexos','new redundant program')
unchanged=[]
for name in ['Attachments/AttachmentStorageClient.php','Attachments/AttachmentStorageBroker.php','Attachments/AttachmentFilePolicy.php','Runtime/RuntimeFileTransferContext.php']:
 p=front/'backend/src'/name;check(not any(e['target']==p.as_posix()for e in read(root/'patches/patch-plan.json')['textPatches']),'storage policy/transporter changed');unchanged.append({'path':p.as_posix(),'sha256':sha(p)})
for name in ['src/crud-engine/CrudKendoFormRenderer.js','src/crud-engine/CrudHttpClient.js','kendo/js/kendo.all.min.js']:
 p=front/name;check(not any(e['target']==p.as_posix()for e in read(root/'patches/patch-plan.json')['textPatches']),'native frontend or Kendo changed');unchanged.append({'path':p.as_posix(),'sha256':sha(p)})
result={'success':True,'checks':checks,'canonicalChanged':False,'bytePreservation':baselines,'unchangedStorageAndFrontend':unchanged};(state/'wiring-result.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print('PASS exact bytes/baselines/ABI/reuse/live metadata wiring checks='+str(checks))
