from pathlib import Path
import json,hashlib,copy
root=Path(__file__).resolve().parents[1];w=root.parents[2];out=root/'metadata';out.mkdir(exist_ok=True)
def write(name,value):(out/name).write_text(json.dumps(value,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
before=w/'.runtime/ciw-completion-20261028/source-132-current-after6.json';source=json.loads(before.read_text(encoding='utf-8-sig'));assert len(source['operations'])==132
operations=[{'code':'item_custos_manual_'+op,'name':'Custos manuais dos itens — '+op,'type':'list'if op=='read'else'detail','method':'POST','path':source['baseUrl'].rstrip('/')+'/SursumPrograms/ciw-cadastros','headers':[],'queryParams':[],'requestContextFields':[],'bodyTemplate':{'resource':'item_custos_manual','operation':op},('itemsPath'if op=='read'else'itemPath'):'data',**({'totalPath':'total'}if op=='read'else{})}for op in ['read','get']]
assert not(set(o['code']for o in operations)&set(o['code']for o in source['operations']))
preview=copy.deepcopy(source);preview['operations'].extend(operations);write('api-source-preview.json',preview)
write('source-addition.json',{'target':before.as_posix(),'baselineSha256':hashlib.sha256(before.read_bytes()).hexdigest(),'sourceCode':source['code'],'expectedOperationCount':132,'resultOperationCount':134,'preserveGlobalAuthentication':True,'rootCompositionRequired':True,'operations':[{'op':'add','path':'/operations/-','value':o}for o in operations]})
schema=json.loads((w/'integration-src/container-panel/schema/espec/schema-item_custos.json').read_text(encoding='utf-8-sig'));fields=[]
labels={'item_custo_id':'ID Custo','it_codigo':'Item','dt_hr_custo':'Data/hora do custo','vl_unit_novo':'Valor unitario novo','dt_referencia':'Data de referencia','caminho_arquivo':'Arquivo (referencia)','cod_tipo_custo':'Tipo de custo','memoria_calculo':'Memoria persistida','cod_usuario':'Usuario registrado','cod_situacao':'Situacao','qt_estoque':'Quantidade estoque','qt_estoque_selecionado':'Estoque selecionado'}
columns=['item_custo_id','it_codigo','dt_hr_custo','cod_tipo_custo','vl_unit_novo','cod_situacao','dt_referencia','caminho_arquivo','media_custo_id']
filters=['item_custo_id','it_codigo','cod_situacao','vl_unit_novo','dt_referencia','cod_usuario']
for f in schema['fields']:
 code=f['name'];kind={'integer':'integer','decimal':'decimal','character':'string','date':'date','datetime':'datetime'}[f['type']]
 options={'readonly':True,'writable':False}
 if code=='memoria_calculo':options['editor']='textarea'
 item={'code':code,'label':labels.get(code,code),'dataType':kind,'primaryKey':False,'required':False,'readonlyField':True,'apiJsonPath':code,'apiWritePath':code,'apiShowInGrid':code in columns,'apiShowInForm':True,'apiShowInFilter':code in filters,'position':len(fields)*10+10,'options':options}
 if kind=='string':item['length']=int(f['format'][2:-1])
 fields.append(item)
fields.append({'code':'record_key','label':'Identidade da consulta','dataType':'string','length':2048,'primaryKey':True,'required':True,'readonlyField':True,'apiJsonPath':'record_key','apiWritePath':'record_key','apiShowInGrid':False,'apiShowInForm':False,'apiShowInFilter':False,'position':240,'options':{'readonly':True,'writable':False}})
program={
 'programCode':'op1051','programTitle':'Custos manuais dos itens','module':'operacional','pageType':'crud',
 'builderEntityCode':'item_custos_manual_progress','screenId':'ciw.item-custos-manuais','version':'1.0.0',
 'subtitle':'Consulta global de custos tipo1; manutencao ainda indisponivel.','permissionPrefix':'item_custos_manual_progress',
 'programOrigin':'standard','ownerScope':'system','allowCreate':False,'allowUpdate':False,'allowDelete':False,
 'contextFields':[],'rowLinks':[],'changeSummary':'Consulta readonly completa do subconjunto tipo1 de cons_item_custos; sem habilitar os escritores legados divergentes.',
 'crudOptions':{'pageSize':50,'defaultSort':[{'field':'item_custo_id','dir':'desc'}],'gridFields':[{'field':x}for x in columns],'filterFields':filters},
 'formOptions':{'mode':'popup','tabs':[
  {'id':'custo','title':'Custo manual','sections':[{'id':'dados','title':'Dados persistidos','columns':2,'fields':[f['code']for f in fields if f['code']not in ['record_key','memoria_calculo']]}]},
  {'id':'memoria','title':'Memoria persistida','sections':[{'id':'memoria','title':'Texto original','columns':1,'fields':['memoria_calculo']}]}]}}
write('builder-draft.json',{'entityDraft':{'code':'item_custos_manual_progress','name':'Custos manuais dos itens (global)','entityType':'api','createPhysicalTable':False,'structureType':'main','structureModuleCode':'operacional','structureBaseNumber':1051,'apiSourceCode':source['code'],'apiListOperationCode':'item_custos_manual_read','apiDetailOperationCode':'item_custos_manual_get','fields':fields},'programDraft':program})
print('Prepared op1051 readonly metadata and source132+2 exact additive proposal')
