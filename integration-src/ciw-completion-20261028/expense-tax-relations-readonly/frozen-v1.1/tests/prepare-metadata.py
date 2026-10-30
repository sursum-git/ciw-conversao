from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1];STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def write(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
src=W/'.runtime/ciw-completion-20261028/expense-tax-current/sources-current.json'
assert sha(src)=='38c47d34491c42bbe24f683f74fef5e065aa8188c73378556176872fe68de5ee'
current=next(x['apiSource']for x in json.loads(src.read_text(encoding='utf-8-sig'))if x['apiSource']['code']=='motor_progress_ciw_cadastros')
assert len(current['operations'])==144
ops=[]
for op,t in [('read','list'),('get','detail')]:
 o={'code':'despesas_impostos_geral_'+op,'name':'Relacoes globais despesa/imposto - '+op,'type':t,'method':'POST','path':'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','headers':[],'queryParams':[],'requestContextFields':[],'bodyTemplate':{'resource':'despesas_impostos_geral','operation':op}}
 o.update({'itemsPath':'data','totalPath':'total'}if op=='read'else{'itemPath':'data'});ops.append(o)
preview={k:current[k]for k in ['code','name','baseUrl','responseContract']};preview['operations']=current['operations']+ops
write(ROOT/'metadata/api-source-preview.json',preview)
write(ROOT/'metadata/source-addition.json',{'target':str(src),'baselineSha256':sha(src),'sourceCode':current['code'],'expectedOperationCount':144,'resultOperationCount':146,'preserveGlobalAuthentication':True,'rootCompositionRequired':True,'replacementOfSanitizedSourceAllowed':False,'operations':[{'op':'add','path':'/operations/-','value':o}for o in ops]})
fields=[]
for i,(name,label)in enumerate([('despesa_id','Despesa Id'),('imposto_id','Imposto Id'),('empresa_id','Empresa Id')]):
 fields.append({'code':name,'label':label,'dataType':'integer','primaryKey':False,'required':False,'readonlyField':True,'apiJsonPath':name,'apiWritePath':name,'apiShowInGrid':name!='empresa_id','apiShowInForm':True,'apiShowInFilter':True,'position':(i+1)*10,'options':{'readonly':True,'writable':False}})
fields.append({'code':'record_key','label':'Identidade da relacao','dataType':'string','length':2048,'primaryKey':True,'required':True,'readonlyField':True,'apiJsonPath':'record_key','apiWritePath':'record_key','apiShowInGrid':False,'apiShowInForm':False,'apiShowInFilter':False,'position':40,'options':{'readonly':True,'writable':False}})
draft={'entityDraft':{'code':'despesas_impostos_geral_progress','name':'Relacoes globais despesa/imposto','entityType':'api','createPhysicalTable':False,'structureType':'main','structureModuleCode':'operacional','structureBaseNumber':1055,'apiSourceCode':current['code'],'apiListOperationCode':ops[0]['code'],'apiDetailOperationCode':ops[1]['code'],'fields':fields},'programDraft':{'programCode':'op1055','programTitle':'Relacoes de despesas e impostos','module':'operacional','pageType':'crud','builderEntityCode':'despesas_impostos_geral_progress','screenId':'ciw.despesas-impostos-geral','version':'1.0.0','subtitle':'Consulta global. Consulte a empresa no detalhe de cada relacao.','permissionPrefix':'despesas_impostos_geral_progress','programOrigin':'standard','ownerScope':'system','allowCreate':False,'allowUpdate':False,'allowDelete':False,'contextFields':[],'rowLinks':[],'changeSummary':'Consulta global readonly das relacoes fisicas; empresa preservada na identidade. O formulario de manutencao continua fora deste escopo.','crudOptions':{'columns':[{'field':'despesa_id'},{'field':'imposto_id'}],'filterFields':['despesa_id','imposto_id','empresa_id']},'formOptions':{'mode':'popup','tabs':[{'id':'relacao','title':'Relacao','sections':[{'id':'dados','title':'Identificacao','columns':2,'fields':['despesa_id','imposto_id','empresa_id']}]}]}}}
draft['programDraft']['crudOptions']['gridFields']=draft['programDraft']['crudOptions'].pop('columns')
draft['programDraft']['crudOptions']['pageSize']=50
draft['programDraft']['crudOptions']['defaultSort']=[{'field':'despesa_id','dir':'asc'},{'field':'imposto_id','dir':'asc'},{'field':'empresa_id','dir':'asc'}]
write(ROOT/'metadata/builder-draft.json',draft)
print(json.dumps({'sourceOperationsBefore':144,'after':146,'program':'op1055','physicalFields':3,'authReplacement':False}))
