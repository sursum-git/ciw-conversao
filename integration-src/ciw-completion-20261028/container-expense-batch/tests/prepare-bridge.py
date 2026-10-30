from pathlib import Path
import json,hashlib,difflib
root=Path(__file__).resolve().parents[1];motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg');stage=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-batch/bridge');patchdir=root/'patches/bridge';patchdir.mkdir(parents=True,exist_ok=True)
def write(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
patches=[]
def patch(p,changes):
 before=p.read_text(encoding='utf-8-sig');after=before
 for a,b in changes:assert after.count(a)==1,(p,a[:100]);after=after.replace(a,b)
 (patchdir/(p.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(p),tofile=str(p))),encoding='utf-8')
 q=stage/p.name;q.parent.mkdir(parents=True,exist_ok=True);q.write_text(after,encoding='utf-8');patches.append(dict(target=str(p).replace('\\','/'),baselineSha256=hashlib.sha256(p.read_bytes()).hexdigest(),changes=[dict(old=a,new=b)for a,b in changes]))
fields=['despesa_container_id','despesa_id','vl_prev','container_id','calc_imp_container_id','vl_base_imp','vl_negociado','vl_proforma','cta_corren_custo_distr_id','log_utilizado','log_manual','perc_calc','memoria_calculo','item_container_id']
reader=motor/'sursum-api/programs/CiwErpReadService.p';text=reader.read_text(encoding='utf-8-sig')
oldline=next(l for l in text.splitlines()if "THEN DO: DELETE OBJECT k. RETURN o. END."in l)
branch="""  WHEN 'container_despesas_lote' THEN DO:
   IF pcCompany=? OR pcCompany='' THEN RUN Fail('CIW_ERP_COMPANY_UNAVAILABLE',503).
   ASSIGN cFieldList='FIELDS' cAliasList=cFieldList cKeyList='despesa_container_id' baseWhere=b:NAME + '.container_id = ' + NumText(DECIMAL(pcCompany)).
  END.
""".replace('FIELDS',','.join(fields))
patch(reader,[(oldline,oldline.replace("')>0 THEN DO:",",container_despesas_lote')>0 THEN DO:")),("  WHEN 'proc_compra_alocacoes' THEN DO:",branch+"  WHEN 'proc_compra_alocacoes' THEN DO:"),("ELSE IF pcResource='proc_compra_alocacoes' THEN NumText(item:GetInteger('item_container_id'))","ELSE IF pcResource='container_despesas_lote' THEN NumText(item:GetInteger('despesa_container_id')) ELSE IF pcResource='proc_compra_alocacoes' THEN NumText(item:GetInteger('item_container_id'))")])
action=builder/'backend/src/Runtime/RuntimeApiEntityActionService.php'
method='''    private function containerExpenseBatchRequest(array $definition,array $config,array $payload,string $operation):array
    {
        $actor='';
        if ($operation==='batch') {
            $session=$this->authenticatedSessions?->resolve();
            if (!$session || $session->getStatus()!=='active') { throw new RuntimeHttpException('AUTH_REQUIRED','Sessao ativa obrigatoria para o lote.',401); }
            $actor=$this->attachmentActor();
        }
        return RuntimeContainerExpenseBatch::run($definition,$config,$payload,$operation,$actor,
            fn(string $permission):bool=>$this->permissions?->hasPermission($permission) ?? false,
            fn(array $endpoint,array $request):array=>$this->requestEndpoint($definition,$endpoint,$definition['apiSource']['authHeaders'] ?? [],[],$request),
            fn(array $row):array=>$this->mapItem($definition,$row),
            fn(string $event,array $before,array $after,array $metadata)=>$this->transactions->log($definition['entityCode'].'.api.'.$event,'Operacao nativa de despesas do container.',before:$before,after:$after,metadata:['entityCode'=>$definition['entityCode']]+(($metadata['available']??false)===true ? ['audit'=>$metadata] : $metadata)));
    }

'''
patch(action,[("    private function read(array $definition, array $payload): array\n\n    {",method+"    private function read(array $definition, array $payload): array\n\n    {\n        if (RuntimeContainerExpenseBatch::supports($definition)) { return $this->containerExpenseBatchRequest($definition,[],$payload,'read'); }"),("    private function get(array $definition, array $payload): array\n\n    {","    private function get(array $definition, array $payload): array\n\n    {\n        if (RuntimeContainerExpenseBatch::supports($definition)) { return $this->containerExpenseBatchRequest($definition,[],$payload,'get'); }"),("    private function batch(array $definition, array $config, array $payload): array\n\n    {","    private function batch(array $definition, array $config, array $payload): array\n\n    {\n        if (RuntimeContainerExpenseBatch::supports($definition)) { return $this->containerExpenseBatchRequest($definition,$config,$payload,'batch'); }")])
write(patchdir/'patch-plan.json',dict(textPatches=patches))
api=(motor/'sursum-api/programs/ContainersDespesasCrud.p').read_text(encoding='utf-8-sig').replace('"container-despesas"','"container-despesas-lote"').replace('ContainersDespesasCrudService.r','ContainersDespesasBatchService.r')
api=api.replace('clean=CAST(poRequest:Clone(),JsonObject). clean:Remove("resource").','clean=CAST(poRequest:Clone(),JsonObject).')
dead=''' IF clean:Has("operation") THEN IF clean:GetType("operation")=JsonDataType:STRING THEN
  IF clean:GetCharacter("operation")="delete" AND clean:Has("values") THEN clean:Remove("values").
'''
assert api.count(dead)==1;api=api.replace(dead,'')
(root/'abl/ContainersDespesasBatchApi.p').write_text(api,encoding='utf-8')
route=motor/'conf-web-handler/program-routes.json';write(patchdir/'route-addition.json',dict(target=str(route).replace('\\','/'),baselineSha256=hashlib.sha256(route.read_bytes()).hexdigest(),operations=[dict(op='add',path='/routes/-',value=dict(route='/SursumPrograms/containers-despesas-lote',method='POST',program='sursum-api/programs/ContainersDespesasBatchApi.p'))]))
old=json.loads((builder/'integrations/ciw-container-painel/despesas-1.0.1-builder-draft-candidate.json').read_text(encoding='utf-8-sig'))
available={f['code']:f for f in old['entityDraft']['fields']};result=[]
for i,name in enumerate(fields):
 f=available[name];f['position']=i*10;f['readonlyField']=name not in ['vl_prev','vl_base_imp','log_manual'];f['options']['readonly']=f['readonlyField'];f['options']['writable']=not f['readonlyField'];f['apiShowInForm']=True;f['apiShowInGrid']=name in ['despesa_container_id','despesa_id','vl_prev','vl_base_imp','log_manual','perc_calc'];f['apiShowInFilter']=False;result.append(f)
e=dict(code='container_despesas_lote_progress',name='Manutencao rapida de despesas do container MED',entityType='api',createPhysicalTable=False,structureModuleCode='operacional',structureType='main',structureBaseNumber=1042,apiSourceCode='motor_progress_container_despesas_lote',apiListOperationCode='despesas_lote_read',apiDetailOperationCode='despesas_lote_get',apiBatchOperationCode='despesas_lote_batch',apiCreateOperationCode='',apiUpdateOperationCode='',apiDeleteOperationCode='',fields=result)
snapshot=dict(originalFields=fields,contextFields=['container_id'])
p=dict(programCode='op1042',programTitle='Manutencao rapida de despesas',module='operacional',builderEntityCode=e['code'],pageType='crud',gridEditMode='batch',screenId='ciw.container-despesas-lote',version='1.0.0',programOrigin='standard',ownerScope='system',allowCreate=False,allowUpdate=True,allowDelete=True,permissionPrefix=e['code'],subtitle='Salve alteracoes ou exclusoes em lotes separados. Container MED.',contextFields=[dict(field='container_id',filter=True,createDefault=False,readonly=True,required=True)],rowLinks=[],crudOptions=dict(pageSize=50,batchSnapshot=snapshot,gridFields=[dict(field=f['code'])for f in result if f['apiShowInGrid']],filterFields=[],defaultSort=[dict(field='despesa_container_id',dir='asc')]),formOptions=dict(mode='popup',tabs=[dict(id='despesa',title='Despesa',sections=[dict(id='dados',title='Valores persistidos',columns=2,fields=fields)])]))
write(root/'metadata/despesas-lote-builder-draft.json',dict(entityDraft=e,programDraft=p))
operations=[]
for op,typ in [('read','list'),('get','detail'),('batch','batch')]:
 o=dict(code='despesas_lote_'+op,name='Manutencao rapida — '+op,type=typ,method='POST',path='/SursumPrograms/containers-despesas-lote',requestContextFields=['container_id'],bodyTemplate=dict(resource='container-despesas-lote',operation=op))
 o.update(dict(itemsPath='data',**({'totalPath':'total'}if op=='read'else{}))if op!='get'else dict(itemPath='data'));operations.append(o)
write(root/'metadata/api-source.json',dict(providerType='generic',code='motor_progress_container_despesas_lote',name='Motor Progress — Manutencao rapida de despesas',status='active',baseUrl='http://127.0.0.1:19910/med/web',authMode='header_static',authHeaders={},timeoutSeconds=25,responseContract='sursum-programs',operations=operations))
parent=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/official-build3/op1003-program-after.json');current=json.loads(parent.read_text(encoding='utf-8-sig'));index=next(i for i,v in enumerate(current['versions'])if v['version']=='1.0.2');config=current['versions'][index]['builderConfig'];assert any(x['id']=='memoria_calculo'for x in config['rowLinks'])
write(patchdir/'parent-navigation.json',dict(target=str(parent).replace('\\','/'),baselineSha256=hashlib.sha256(parent.read_bytes()).hexdigest(),targetProgram='op1003',baselineVersion='1.0.2',targetPointer='/versions/'+str(index)+'/builderConfig',applyToCloneForNewVersion=True,preserveExistingVersion=True,operations=[dict(op='add',path='/rowLinks/-',value=dict(id='manutencao_lote',label='Manutencao rapida',screenId='ciw.container-despesas-lote',parameters=[dict(field='container_id',sourceField='container_id')],position='end'))]))
print('Prepared bridge source/read/get/batch/route/native op1042; auth remains runtime-only integration gate')
