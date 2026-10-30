"""Build reviewable deltas only. Never writes canonical files or publishes metadata."""
from pathlib import Path
import json,hashlib,difflib
root=Path(__file__).resolve().parents[1]
motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
def sha(p): return hashlib.sha256(p.read_bytes()).hexdigest()
def write(name,obj):
 p=root/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(obj,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
patches=[]
def patch(path,changes):
 old=path.read_text(encoding='utf-8-sig');new=old
 for c in changes:
  assert new.count(c['old'])==1,(str(path),c['old'][:80]);new=new.replace(c['old'],c['new'])
 filename=path.name+'.patch';p=root/'patches'/filename;p.parent.mkdir(parents=True,exist_ok=True)
 p.write_text(''.join(difflib.unified_diff(old.splitlines(True),new.splitlines(True),fromfile=str(path).replace('\\','/'),tofile=str(path).replace('\\','/'))),encoding='utf-8')
 patches.append(dict(target=str(path).replace('\\','/'),baselineSha256=sha(path),patch=filename,changes=changes))
reader=motor/'sursum-api/programs/CiwErpReadService.p'
old="proc_compra_despesas,proc_compra_resumo,proc_compra_alocacoes')>0 THEN DO: DELETE OBJECT k. RETURN o. END."
branches="""  WHEN 'container_calculos_impostos_med' THEN DO:
   IF pcCompany=? OR pcCompany='' THEN RUN Fail('CIW_ERP_COMPANY_UNAVAILABLE',503).
   ASSIGN cFieldList='calc_imp_container_id,container_id,dt_hr_calculo,data_calculo,usuario_id,memoria_calculo,desc_memoria_calc' cAliasList=cFieldList cKeyList='calc_imp_container_id' baseWhere=b:NAME + '.container_id = ' + NumText(DECIMAL(pcCompany)).
  END.
  WHEN 'container_despesa_memoria_med' THEN DO:
   IF pcCompany=? OR pcCompany='' THEN RUN Fail('CIW_ERP_COMPANY_UNAVAILABLE',503).
   ASSIGN cFieldList='despesa_container_id,container_id,calc_imp_container_id,memoria_calculo,link_calculo_id' cAliasList=cFieldList cKeyList='despesa_container_id' baseWhere=b:NAME + '.container_id = ' + NumText(DECIMAL(pcCompany)).
  END.
"""
patch(reader,[dict(old=old,new=old.replace("proc_compra_alocacoes'","proc_compra_alocacoes,container_calculos_impostos_med,container_despesa_memoria_med'")),dict(old="  WHEN 'proc_compra_alocacoes' THEN DO:",new=branches+"  WHEN 'proc_compra_alocacoes' THEN DO:"),dict(old="ELSE IF pcResource='proc_compra_alocacoes' THEN NumText(item:GetInteger('item_container_id'))",new="ELSE IF pcResource='container_calculos_impostos_med' THEN NumText(item:GetInteger('calc_imp_container_id')) ELSE IF pcResource='container_despesa_memoria_med' THEN NumText(item:GetInteger('despesa_container_id')) ELSE IF pcResource='proc_compra_alocacoes' THEN NumText(item:GetInteger('item_container_id'))")])
dispatch=motor/'sursum-api/programs/CiwCadastrosCrud.p'
branch='''  WHEN "container_calculos_impostos_med" OR WHEN "container_despesa_memoria_med" THEN DO:
   cService=SEARCH("sursum-api/programs/ContainerFiscalReadOnlyApi.r").
   IF cService=? THEN UNDO, THROW NEW Progress.Lang.AppError("Consulta fiscal readonly indisponivel.",1).
   RUN VALUE(cService)(poRequest,OUTPUT poResponse). RETURN.
  END.
'''
patch(dispatch,[dict(old=' CASE cResource:\n',new=' CASE cResource:\n'+branch)])
php=builder/'backend/src/Runtime/RuntimeCiwErpQuery.php'
patch(php,[dict(old="private const RESOURCES=[",new="private const RESOURCES=['container_calculos_impostos_med_progress'=>'container_calculos_impostos_med','container_despesa_memoria_med_progress'=>'container_despesa_memoria_med',"),dict(old="return match($d['entityCode']??'') {",new="return match($d['entityCode']??'') {'container_calculos_impostos_med_progress'=>'calc_imp_container_id','container_despesa_memoria_med_progress'=>'despesa_container_id',"),dict(old="        if (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {",new="""        if (in_array($d['entityCode']??null,['container_calculos_impostos_med_progress','container_despesa_memoria_med_progress'],true)) {
            $key=($d['entityCode']==='container_calculos_impostos_med_progress')?'calc_imp_container_id':'despesa_container_id';
            if (($endpoint['requestContextFields']??null)!==['container_id',$key]) { self::invalid(); }
            $context=ApiRequestContext::resolve($d,$endpoint,$payload);
            unset($payload['context']);
        } elseif (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {""")])
action=builder/'backend/src/Runtime/RuntimeApiEntityActionService.php'
patch(action,[dict(old="        foreach ($body['data'] as $row) {\n\n            $valid=RuntimePurchaseContextAudit::supports($definition) ?",new="""        $containerFiscalKey = match ($definition['entityCode'] ?? null) {
            'container_calculos_impostos_med_progress' => 'calc_imp_container_id',
            'container_despesa_memoria_med_progress' => 'despesa_container_id',
            default => null,
        };

        foreach ($body['data'] as $row) {

            $valid=$containerFiscalKey !== null ? is_array($row) && is_int($row['container_id'] ?? null) && is_int($row[$containerFiscalKey] ?? null) && $row[$containerFiscalKey] > 0 && $row[$containerFiscalKey] <= 2147483647 : (RuntimePurchaseContextAudit::supports($definition) ?"""),dict(old=": is_array($row) && is_string($row['record_key'] ?? null) && $row['record_key']!=='');",new=": is_array($row) && is_string($row['record_key'] ?? null) && $row['record_key']!==''));"),dict(old="        if (($definition['entityCode'] ?? null) === 'procs_compra_financeiro_med_progress') {",new="""        if ($containerFiscalKey !== null) {
            ApiRequestContext::assertRows($body['data'], ['container_id' => $query['container_id'], $containerFiscalKey => $query[$containerFiscalKey]]);
        }

        if (($definition['entityCode'] ?? null) === 'procs_compra_financeiro_med_progress') {""")])
write('patches/patch-plan.json',dict(textPatches=patches))
def field(code,label,kind,pk=False,length=None):
 f=dict(code=code,label=label,dataType=kind,primaryKey=pk,required=False,readonlyField=True,position=0,apiJsonPath=code,apiWritePath=code,apiShowInGrid=True,apiShowInForm=True,apiShowInFilter=True,options=dict(readonly=True,writable=False))
 if kind=='integer': f['options'].update(decimals=0,format='n0')
 if length: f['length']=length
 if code in ['desc_memoria_calc','memoria_calculo'] and kind=='string':f['options'].update(editor='textarea',rows=16)
 return f
def link(i,label,screen,pairs):return dict(id=i,label=label,screenId=screen,parameters=[dict(field=a,sourceField=b)for a,b in pairs],position='end')
specs=[('container_calculos_impostos_med','container_calculos_impostos_med_progress','op1033','ciw.container-calculos-impostos-med','Histórico de cálculos fiscais do container — MED',[
 field('calc_imp_container_id','Cálculo','integer',True),field('container_id','Container','integer'),field('dt_hr_calculo','Data e hora do cálculo','string',length=32),field('data_calculo','Data do cálculo','date'),field('usuario_id','Usuário legado','integer'),field('memoria_calculo','Referência numérica legada','integer'),field('desc_memoria_calc','Memória de cálculo fiscal','string',length=8000)]),
 ('container_despesa_memoria_med','container_despesa_memoria_med_progress','op1034','ciw.container-despesa-memoria-med','Memória de cálculo da despesa — MED',[
 field('despesa_container_id','Despesa do container','integer',True),field('container_id','Container','integer'),field('calc_imp_container_id','Cálculo fiscal associado','integer'),field('memoria_calculo','Memória própria da despesa','string',length=4000),field('link_calculo_id','Cálculo fiscal para navegação','integer')])]
operations=[]
for resource,entity,program,screen,title,fields in specs:
 for i,f in enumerate(fields):f['position']=i*10
 pk=fields[0]['code']
 for op in ['read','get']:
  endpoint=dict(code=resource+'_'+op,name=title+' — '+op,type='list'if op=='read'else'detail',method='POST',path='/SursumPrograms/ciw-cadastros',requestContextFields=['container_id',pk],bodyTemplate=dict(resource=resource,operation=op))
  endpoint.update(dict(itemsPath='data',totalPath='total')if op=='read'else dict(itemPath='data'));operations.append(endpoint)
 e=dict(code=entity,name=title,entityType='api',createPhysicalTable=False,structureModuleCode='operacional',structureType='main',structureBaseNumber=int(program[2:]),apiSourceCode='motor_progress_ciw_cadastros',apiListOperationCode=resource+'_read',apiDetailOperationCode=resource+'_get',apiCreateOperationCode='',apiUpdateOperationCode='',apiDeleteOperationCode='',fields=fields)
 links=[link('container','Painel do container','ciw.container-painel',[('container_id','container_id')])]
 if program=='op1034':links.insert(0,link('calculo','Memória fiscal associada','ciw.container-calculos-impostos-med',[('container_id','container_id'),('calc_imp_container_id','link_calculo_id')]))
 p=dict(programCode=program,programTitle=title,module='operacional',builderEntityCode=entity,pageType='crud',gridEditMode='form',screenId=screen,version='1.0.0',programOrigin='standard',ownerScope='system',allowCreate=False,allowUpdate=False,allowDelete=False,permissionPrefix=entity,subtitle='Memória persistida selecionada; consulta não executa recálculo.',rowLinks=links,contextFields=[dict(field=x,filter=True,createDefault=False,readonly=True,required=True)for x in ['container_id',pk]],crudOptions=dict(pageSize=50,defaultSort=[dict(field=pk,dir='desc')],gridFields=[dict(field=f['code'])for f in fields if f['code']!='link_calculo_id'],filterFields=[f['code']for f in fields if f['code']!='link_calculo_id']),formOptions=dict(mode='popup',tabs=[dict(id='memoria',title='Memória persistida',sections=[dict(id='dados',title='Consulta',columns=1,fields=[f['code']for f in fields if f['code']!='link_calculo_id'])])]))
 write('metadata/'+program+'-builder-draft.json',dict(entityDraft=e,programDraft=p))
write('metadata/api-source-additions.json',dict(sourceCode='motor_progress_ciw_cadastros',operations=operations))
source_before=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/source-118-before.json')
assert sha(source_before)=='2bbff65351a30f396a163ee3b2e60c6208e22ed5bbc95e719ac1732f9ec3a098','source118 baseline changed'
source=json.loads(source_before.read_text(encoding='utf-8-sig'))
assert source['code']=='motor_progress_ciw_cadastros' and len(source['operations'])==118
assert not set(o['code']for o in source['operations']) & set(o['code']for o in operations),'operation collision'
write('patches/source-operations.json',dict(kind='RFC6902-append-only',targetSourceCode=source['code'],baselinePath=str(source_before).replace('\\','/'),baselineSha256=sha(source_before),baselineOperations=118,resultOperations=122,operations=[dict(op='add',path='/operations/-',value=o)for o in operations],preserveAuthHeaders=True))
parent=builder/'integrations/ciw-container-painel/painel-1.0.8-builder-draft-candidate.json';pdata=json.loads(parent.read_text(encoding='utf-8-sig'))
assert 'tabs' in pdata['programDraft']['formOptions']
expense=builder/'integrations/ciw-container-painel/despesas-1.0.1-builder-draft-candidate.json'
parent_patches=[dict(target=str(expense).replace('\\','/'),baselineSha256=sha(expense),operations=[dict(op='add',path='/programDraft/rowLinks/-',value=link('memoria_calculo','Memória de cálculo','ciw.container-despesa-memoria-med',[('container_id','container_id'),('despesa_container_id','despesa_container_id')]))])]
write('patches/parent-navigation.json',dict(kind='RFC6902-append-only',versionPolicy='manager chooses next version after reconciling concurrent additions',patches=parent_patches))
print('Prepared',len(patches),'text patches, 2 readonly screens, source118+4 and append-only parent navigation')
