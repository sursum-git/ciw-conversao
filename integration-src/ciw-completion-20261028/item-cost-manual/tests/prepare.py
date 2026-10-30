from pathlib import Path
import json,hashlib,difflib,re,sys
root=Path(__file__).resolve().parents[1];w=root.parents[2];motor=Path('D:/opencode/motor-progress/v2');front=Path('D:/opencode/construtor-pg')
red='--red'in sys.argv;state=w/'.runtime/ciw-completion-20261028/item-cost-manual';stage=state/('red'if red else'local');stage.mkdir(parents=True,exist_ok=True)
(root/'patches').mkdir(exist_ok=True);(root/'php').mkdir(exist_ok=True)
schema=json.loads((w/'integration-src/container-panel/schema/espec/schema-item_custos.json').read_text(encoding='utf-8-sig'));fields=','.join(f['name']for f in schema['fields']);plans=[]
def patch(target,relative,changes):
 before=target.read_text(encoding='utf-8-sig');after=before
 for a,b in changes:assert after.count(a)==1,(target,a);after=after.replace(a,b)
 out=stage/relative;out.parent.mkdir(parents=True,exist_ok=True);out.write_text(before if red else after,encoding='utf-8')
 if not red:
  (root/'patches'/(target.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=target.as_posix(),tofile=target.as_posix())),encoding='utf-8')
  plans.append({'target':target.as_posix(),'baselineSha256':hashlib.sha256(target.read_bytes()).hexdigest(),'candidateRuntimePath':out.as_posix(),'changes':[{'old':a,'new':b}for a,b in changes]})
reader=motor/'sursum-api/programs/CiwErpReadService.p'
patch(reader,'sursum-api/programs/CiwErpReadService.p',[
 (" CASE pcResource:\n"," CASE pcResource:\n  WHEN 'item_custos_manual' THEN ASSIGN cFieldList='"+fields+"' cAliasList=cFieldList cKeyList='item_custo_id' baseWhere=b:NAME + '.cod_tipo_custo = 1'.\n"),
 ("   WHEN 'LOGICAL' THEN o:Add(nameValue,LOGICAL(f:BUFFER-VALUE)).","   WHEN 'LOGICAL' THEN o:Add(nameValue,LOGICAL(f:BUFFER-VALUE)).\n   WHEN 'DATETIME' THEN DO: IF pcResource<>'item_custos_manual' THEN RUN Fail('CIW_ERP_SCHEMA_INVALID',503). o:Add(nameValue,ISO-DATE(DATETIME(f:BUFFER-VALUE))). END."),
 ("  totalValue=totalValue + 1.\n","  totalValue=totalValue + 1.\n  IF pcResource='item_custos_manual' AND totalValue>50000 THEN RUN Fail('CIW_ERP_QUERY_LIMIT',503).\n")])
patch(motor/'sursum-api/programs/CiwCadastrosCrud.p','sursum-api/programs/CiwCadastrosCrud.p',[
 (' CASE cResource:\n',''' CASE cResource:
  WHEN "item_custos_manual" THEN DO:
   IF cOperation<>"read" AND cOperation<>"get" THEN DO: RUN ErrorResponse("CIW_ERP_READ_ONLY",405). RETURN. END.
   cService=SEARCH("sursum-api/programs/CiwErpReadService.r").
   IF cService=? THEN UNDO,THROW NEW Progress.Lang.AppError("Leitor de custos manuais indisponivel",1).
   CREATE BUFFER hData FOR TABLE "espec.item_custos" BUFFER-NAME "bCiwManualItemCosts".
   cleanRequest=CAST(poRequest:Clone(),JsonObject). cleanRequest:Remove("resource").
   RUN VALUE(cService)(hData,"item_custos_manual","",cleanRequest,OUTPUT poResponse). RETURN.
  END.
''')])
query=front/'backend/src/Runtime/RuntimeCiwErpQuery.php'
patch(query,'php/RuntimeCiwErpQuery.php',[
 ("private const RESOURCES=[","private const RESOURCES=['item_custos_manual_progress'=>'item_custos_manual',"),
 ("['proc_compra_sinalizadores_med_progress','proc_compra_quantidades_med_progress'","['item_custos_manual_progress','proc_compra_sinalizadores_med_progress','proc_compra_quantidades_med_progress'")])
action=front/'backend/src/Runtime/RuntimeApiEntityActionService.php'
patch(action,'php/RuntimeApiEntityActionService.php',[
 ("        $containerFiscalKey = match ($definition['entityCode'] ?? null) {","        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::readResponse($body); }\n        $containerFiscalKey = match ($definition['entityCode'] ?? null) {"),
 ("        $id = $this->extractRecordId($definition, $payload);\n        if (RuntimeImportDiscountRead::supports($definition))", "        $id = $this->extractRecordId($definition, $payload);\n        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getRequest($definition,$payload,$id); }\n        if (RuntimeImportDiscountRead::supports($definition))"),
 ("            $mapped = $this->enrichRows($definition, [$this->mapItem($definition, $item)])[0] ?? [];","            if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getResponse($response['body'],$item,$id); }\n            $mapped = $this->enrichRows($definition, [$this->mapItem($definition, $item)])[0] ?? [];")])
php_fields={f['name']:{'type':{'integer':'integer','decimal':'decimal','character':'string','date':'date','datetime':'datetime'}[f['type']],'nullable':True}for f in schema['fields']}
php_fields['item_custo_id']={'type':'id'};php_fields['cod_tipo_custo']={'type':'integer'};php_fields['record_key']={'type':'string','maxLength':2048}
php_schema='['+','.join(repr(k)+'=>['+','.join(repr(kk)+'=>'+('true'if vv is True else'false'if vv is False else repr(vv))for kk,vv in v.items())+']'for k,v in php_fields.items())+']'
(root/'php/RuntimeItemCostManualSchema.php').write_text('<?php\nreturn '+php_schema+';\n',encoding='utf-8')
# Current reader dependencies and existing meaningful suites, no physical DB handles.
regressions={}
if not red:
 for name,source in [('CiwErpReadTest.p','tests/abl/ciw-erp-consultas/CiwErpReadTest.p'),('PurchaseItemsReadTest.p','tests/abl/purchase-items/PurchaseItemsReadTest.p'),('CiwMedCompanyContext.p','sursum-api/programs/CiwMedCompanyContext.p')]:
  text=(motor/source).read_text(encoding='utf-8-sig')
  # The standalone legacy test terminates the AVM; the local composition only returns.
  if name=='CiwErpReadTest.p':text=text.replace('OUTPUT CLOSE. QUIT.','OUTPUT CLOSE. RETURN.')
  (stage/name).write_text(text,encoding='utf-8');regressions[name]=text
 (stage/'CiwErpReadService.p').write_text('{sursum-api/programs/CiwErpReadService.p}\n',encoding='utf-8')
pending=re.findall(r'\{(sursum-api/[^\s{}]+\.i)',reader.read_text(encoding='utf-8-sig')+'\n'+'\n'.join(regressions.values()));seen=set()
while pending:
 name=pending.pop()
 if name in seen:continue
 seen.add(name);p=motor/name;out=stage/name;text=p.read_text(encoding='utf-8-sig');out.parent.mkdir(parents=True,exist_ok=True);out.write_text(text,encoding='utf-8');pending.extend(re.findall(r'\{(sursum-api/[^\s{}]+\.i)',text))
fixture='\n'.join('FIELD '+f['name']+' AS '+f['type'].upper()+((' DECIMALS '+str(f['decimals']))if f['type']=='decimal'else'')for f in schema['fields'])
(stage/'ItemCostManualReadTest.p').write_text((root/'tests/ItemCostManualReadTest.p').read_text().replace('/* PHYSICAL_SCHEMA */',fixture),encoding='utf-8')
programs=['sursum-api/programs/CiwErpReadService.p','ItemCostManualReadTest.p']
if not red:programs+=list(regressions)+['CiwErpReadService.p']
(stage/'Compile.p').write_text('''DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES("'''+','.join(programs)+'''"): COMPILE VALUE(ENTRY(k,"'''+','.join(programs)+'''")) SAVE NO-ERROR.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED 'PASS COMPILE' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(stage/'Execute.p').write_text("BLOCK-LEVEL ON ERROR UNDO, THROW. OUTPUT TO 'execution.log'. DO ON ERROR UNDO, THROW: RUN ItemCostManualReadTest.r. "+(''if red else'RUN CiwErpReadTest.r. RUN PurchaseItemsReadTest.r. ')+"PUT UNFORMATTED 'PASS EXECUTE NUMDBS=' NUM-DBS SKIP. CATCH e AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. END CATCH. END. OUTPUT CLOSE. QUIT.\n",encoding='utf-8')
if not red:(root/'patches/patch-plan.json').write_text(json.dumps({'textPatches':plans},indent=2)+'\n',encoding='utf-8')
print('Prepared readonly item costs candidate; no physical DB, writer or canonical mutation')
