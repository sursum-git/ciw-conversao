from pathlib import Path
import hashlib,json,sys
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1];STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly'
def digest(b):return hashlib.sha256(b).hexdigest()
patches=[]
def patch(rel,changes):
 p=STATE/'baseline'/rel;data=p.read_bytes();before=data;hunks=[]
 for old,new in changes:
  a=old.encode();b=new.encode();assert data.count(a)==1,(rel,old);data=data.replace(a,b,1);hunks.append({'oldBytesHex':a.hex(),'newBytesHex':b.hex()})
 out=STATE/'candidates'/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(data)
 target='D:/opencode/construtor-pg/backend/src/Runtime/'+Path(rel).name if rel.startswith('php/') else 'D:/opencode/motor-progress/v2/'+rel
 patches.append({'target':target,'relative':rel,'baselineSha256':digest(before),'candidateSha256':digest(data),'preservesAllBytesOutsideAnchors':True,'changes':hunks})
patch('sursum-api/programs/CiwErpReadService.p',[
 ("DEFINE VARIABLE seen AS JsonObject NO-UNDO.","DEFINE VARIABLE seen AS JsonObject NO-UNDO.\r\nDEFINE TEMP-TABLE ttRelationIdentity NO-UNDO FIELD record_key AS CHARACTER CASE-SENSITIVE INDEX pk IS PRIMARY UNIQUE record_key."),
 (" IF n=0 THEN RUN Fail('CIW_ERP_FIELD_INVALID',422)."," IF n=0 THEN RUN Fail('CIW_ERP_FIELD_INVALID',422).\r\n IF pcResource='despesas_impostos_geral' AND NOT COMPARE(nameValue,'=',ENTRY(n,cAliasList),'RAW') THEN RUN Fail('CIW_ERP_FIELD_INVALID',422)."),
 ("   IF o:IsNull(nameValue) THEN RUN Fail('CIW_ERP_KEY_INVALID',409).\r\n   CASE f:DATA-TYPE:","   IF o:IsNull(nameValue) THEN DO:\r\n    IF pcResource<>'despesas_impostos_geral' THEN RUN Fail('CIW_ERP_KEY_INVALID',409).\r\n    k:AddNull(nameValue).\r\n   END.\r\n   ELSE CASE f:DATA-TYPE:"),
 (" CASE pcResource:\r\n  WHEN 'item_custos_manual'", " CASE pcResource:\r\n  WHEN 'despesas_impostos_geral' THEN ASSIGN cFieldList='despesa_id,imposto_id,empresa_id' cAliasList=cFieldList cKeyList=cFieldList baseWhere='TRUE'.\r\n  WHEN 'item_custos_manual'"),
 ("   IF keyObject:IsNull(fieldName) THEN RUN Fail('CIW_ERP_KEY_INVALID',422).", "   IF keyObject:IsNull(fieldName) AND pcResource<>'despesas_impostos_geral' THEN RUN Fail('CIW_ERP_KEY_INVALID',422)."),
 ("  IF pcResource='item_custos_manual' AND totalValue>50000 THEN RUN Fail('CIW_ERP_QUERY_LIMIT',503).", "  IF (pcResource='item_custos_manual' OR pcResource='despesas_impostos_geral') AND totalValue>50000 THEN RUN Fail('CIW_ERP_QUERY_LIMIT',503).")
 ,("  IF op='get' AND totalValue>1 THEN RUN Fail('CIW_ERP_KEY_AMBIGUOUS',409).", "  IF op='get' AND totalValue>1 THEN RUN Fail('CIW_ERP_KEY_AMBIGUOUS',409).\r\n  IF pcResource='despesas_impostos_geral' THEN DO:\r\n   /* UNKNOWN components permit duplicate UNIQUE index entries. Validate the\r\n      complete bounded result before accepting any page; never deduplicate. */\r\n   item=RowJson(). fieldName=item:GetCharacter('record_key'). DELETE OBJECT item.\r\n   IF CAN-FIND(ttRelationIdentity WHERE ttRelationIdentity.record_key=fieldName) THEN RUN Fail('CIW_ERP_KEY_AMBIGUOUS',409).\r\n   CREATE ttRelationIdentity. ttRelationIdentity.record_key=fieldName. RELEASE ttRelationIdentity.\r\n  END.")
])
if '--php' in sys.argv:
 for name in ['RuntimeApiEntityActionService.php','RuntimeCiwErpQuery.php']:
  p=STATE/'baseline/php'/name
  if not p.exists():
   p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes((STATE/'php-red'/name).read_bytes())
 patch('php/RuntimeCiwErpQuery.php',[
  ("private const RESOURCES=[", "private const RESOURCES=['despesas_impostos_geral_progress'=>'despesas_impostos_geral',"),
  ("        $context=[];", "        $context=[];\r\n        if (RuntimeExpenseTaxRelationsRead::supports($d)) { RuntimeExpenseTaxRelationsRead::readRequest($d,$endpoint,$payload); }")
 ])
 patch('php/RuntimeApiEntityActionService.php',[
  ("        $definition = $this->resolveDefinition($entityCode);", "        $definition = $this->resolveDefinition($entityCode);\r\n        if (RuntimeExpenseTaxRelationsRead::supports($definition)) { RuntimeExpenseTaxRelationsRead::operation($operation); }"),
  ("        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::readResponse($body); }", "        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::readResponse($body); }\r\n        if (RuntimeExpenseTaxRelationsRead::supports($definition)) { RuntimeExpenseTaxRelationsRead::readResponse($body); }"),
  ("        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getRequest($definition,$payload,$id); }", "        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getRequest($definition,$payload,$id); }\r\n        if (RuntimeExpenseTaxRelationsRead::supports($definition)) { RuntimeExpenseTaxRelationsRead::getRequest($definition,$payload,$id); }"),
  ("            if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getResponse($response['body'],$item,$id); }", "            if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::getResponse($response['body'],$item,$id); }\r\n            if (RuntimeExpenseTaxRelationsRead::supports($definition)) { RuntimeExpenseTaxRelationsRead::getResponse($response['body'],$item,$id); }")
 ])
 for name in ['RuntimeApiEntityActionService.php','RuntimeCiwErpQuery.php']:
  p=STATE/'php-local'/name;p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes((STATE/'candidates/php'/name).read_bytes())
 p=STATE/'php-local/RuntimeExpenseTaxRelationsRead.php';p.write_bytes((ROOT/'php'/p.name).read_bytes())
patch('sursum-api/programs/CiwCadastrosCrud.p',[
 (' CASE cResource:\r\n  WHEN "item_custos_manual" THEN DO:', ' CASE cResource:\r\n  WHEN "despesas_impostos_geral" THEN DO:\r\n   IF cOperation<>"read" AND cOperation<>"get" THEN DO: RUN ErrorResponse("CIW_ERP_READ_ONLY",405). RETURN. END.\r\n   cService=SEARCH("sursum-api/programs/CiwErpReadService.r").\r\n   IF cService=? THEN UNDO,THROW NEW Progress.Lang.AppError("Leitor de relacoes despesa/imposto indisponivel",1).\r\n   CREATE BUFFER hData FOR TABLE "espec.despesas_impostos" BUFFER-NAME "bCiwExpenseTaxRelations".\r\n   cleanRequest=CAST(poRequest:Clone(),JsonObject). cleanRequest:Remove("resource").\r\n   RUN VALUE(cService)(hData,"despesas_impostos_geral","",cleanRequest,OUTPUT poResponse). RETURN.\r\n  END.\r\n  WHEN "item_custos_manual" THEN DO:')
])
out=ROOT/'patches/patch-plan.json';out.parent.mkdir(parents=True,exist_ok=True);out.write_text(json.dumps({'textPatches':patches,'phpRebaseGate':'Action399cf18a canonical9 confirmed; preserve1053 and revalidate target hashes before integration','canonical9Receipt':'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/official-build9-v2/canonical-manifest.json'},indent=2)+'\n',encoding='utf-8')
print(json.dumps({'patches':len(patches),'reader':patches[0]['candidateSha256']}))
