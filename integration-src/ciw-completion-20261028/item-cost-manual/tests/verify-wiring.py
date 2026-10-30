from pathlib import Path
import json,hashlib,re
root=Path(__file__).resolve().parents[1];w=root.parents[2];state=w/'.runtime/ciw-completion-20261028/item-cost-manual';sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();checks=0
def check(value,label):
 global checks
 checks+=1;assert value,label
plan=json.loads((root/'patches/patch-plan.json').read_text(encoding='utf-8-sig'))
for entry in plan['textPatches']:
 p=Path(entry['target']);check(sha(p)==entry['baselineSha256'],'shared physical baseline moved '+p.name);text=p.read_text(encoding='utf-8-sig')
 for c in entry['changes']:check(text.count(c['old'])==1,'patch anchor not unique '+p.name);text=text.replace(c['old'],c['new'])
 check(Path(entry['candidateRuntimePath']).read_text(encoding='utf-8-sig')==text,'candidate not patch result '+p.name)
reader=state/'local/sursum-api/programs/CiwErpReadService.p';before=Path(plan['textPatches'][0]['target']).read_text(encoding='utf-8-sig');after=reader.read_text(encoding='utf-8-sig')
check(re.findall(r'^DEFINE (?:INPUT|OUTPUT) PARAMETER.*$',before,re.M)==re.findall(r'^DEFINE (?:INPUT|OUTPUT) PARAMETER.*$',after,re.M),'shared reader ABI changed')
check("baseWhere=b:NAME + '.cod_tipo_custo = 1'"in after,'fixed type1 restriction missing')
check("pcResource='item_custos_manual' AND totalValue>50000"in after,'private50k limit missing')
schema=w/'integration-src/container-panel/schema/espec/schema-item_custos.json';physical=json.loads(schema.read_text(encoding='utf-8-sig'));check(len(physical['fields'])==23,'dictionary23 changed')
meta=json.loads((root/'metadata/builder-draft.json').read_text(encoding='utf-8-sig'));check(meta['programDraft']['programCode']=='op1051','reserved code differs');check(all(meta['programDraft'][n]is False for n in ['allowCreate','allowUpdate','allowDelete']),'writer offered')
check(all(f['readonlyField']is True for f in meta['entityDraft']['fields']),'editable field offered');check(not any(f['code']in['container_id','empresa_id']for f in meta['entityDraft']['fields']),'invented owner')
source=json.loads((root/'metadata/api-source-preview.json').read_text(encoding='utf-8-sig'));addition=json.loads((root/'metadata/source-addition.json').read_text(encoding='utf-8-sig'));baseline=Path(addition['target']);check(sha(baseline)==addition['baselineSha256'],'source baseline moved');old=json.loads(baseline.read_text(encoding='utf-8-sig'));check(source['operations'][:132]==old['operations']and len(source['operations'])==134,'old source operations changed')
check(set(source)==set(old),'global source fields changed');check(not any(op.get('headers')for op in source['operations'])and not source.get('authHeaders'),'credentials in candidate')
dispatch=(state/'local/sursum-api/programs/CiwCadastrosCrud.p').read_text(encoding='utf-8-sig');branch=dispatch.split('WHEN "item_custos_manual" THEN DO:',1)[1].split('\n  END.',1)[0];check('cOperation<>"read" AND cOperation<>"get"'in branch and'405'in branch,'dispatcher writer path not refused');check('espec.item_custos'in branch and'RUN VALUE(cService)(hData,"item_custos_manual","",cleanRequest,OUTPUT poResponse)'in branch,'fixed table/resource wiring')
result={'success':True,'checks':checks,'physicalSchemaPath':schema.as_posix(),'physicalSchemaSha256':sha(schema),'globalShared':True,'writes':False};(state/'wiring-result.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print('PASS exact patch/baseline/readonly wiring checks='+str(checks))
