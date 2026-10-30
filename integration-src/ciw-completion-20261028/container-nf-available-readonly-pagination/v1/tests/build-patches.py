from pathlib import Path
import hashlib,json,difflib
P=Path(__file__).resolve().parents[1];S=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1')
patches=[]
def sha(b):return hashlib.sha256(b).hexdigest()
def begin(rel):
 global relative,base,data,changes
 relative=rel;source=S/'baseline11'/rel
 if not source.exists():source=S/'baseline'/rel
 base=source.read_bytes();data=base;changes=[]
def edit(old,new):
 global data
 raw=old.encode();count=data.count(raw)
 if count!=1:
  raw=raw.replace(b'\n',b'\r\n');assert data.count(raw)==1,(relative,old[:120],count)
  new=new.replace('\n','\r\n')
 replaced=new.encode();data=data.replace(raw,replaced,1);changes.append({'oldBytesHex':raw.hex(),'newBytesHex':replaced.hex()})
def end():
 out=S/'candidates'/relative;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(data)
 reverse=data
 for change in reversed(changes):
  a=bytes.fromhex(change['oldBytesHex']);b=bytes.fromhex(change['newBytesHex']);assert reverse.count(b)==1;reverse=reverse.replace(b,a,1)
 assert reverse==base
 patches.append({'relative':relative,'baselineSha256':sha(base),'candidateSha256':sha(data),'changes':changes,'reverseByteExact':True})
 dest=P/'patches'/(Path(relative).name+'.patch');dest.parent.mkdir(parents=True,exist_ok=True)
 dest.write_text(''.join(difflib.unified_diff(base.decode('utf8').splitlines(True),data.decode('utf8').splitlines(True),fromfile='baseline/'+relative,tofile='candidate/'+relative)),encoding='utf8',newline='')

begin('sursum-api/programs/ContainersPainelFinanceReadService.p')
edit('DEFINE VARIABLE iNfStatus AS INTEGER NO-UNDO.\n','''DEFINE VARIABLE iNfStatus AS INTEGER NO-UNDO.
/* Internal projection comes only from NfRow. The original JSON is the output;
   typed columns exist solely for the shared reader's filter/order/page engine. */
DEFINE TEMP-TABLE ttNfPage NO-UNDO
 FIELD container_id AS INTEGER FIELD nf_key AS CHARACTER CASE-SENSITIVE
 FIELD documento_localizado AS LOGICAL FIELD estab AS CHARACTER FIELD documento AS CHARACTER
 FIELD serie AS CHARACTER FIELD cod_emitente AS INTEGER FIELD nat_operacao AS CHARACTER
 FIELD especie AS INTEGER FIELD dt_emissao AS DATE FIELD dt_trans AS DATE
 FIELD tot_valor AS DECIMAL DECIMALS 10 FIELD despesa_nota AS DECIMAL DECIMALS 10
 FIELD valor_embal AS DECIMAL DECIMALS 10 FIELD valor_frete AS DECIMAL DECIMALS 10
 FIELD valor_mercad AS DECIMAL DECIMALS 10 FIELD valor_outras AS DECIMAL DECIMALS 10
 FIELD valor_seguro AS DECIMAL DECIMALS 10 FIELD nf_original_json AS CLOB
 INDEX pk IS PRIMARY UNIQUE nf_key.
DEFINE VARIABLE joNfPageResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE iNfPageRows AS INTEGER NO-UNDO.
''')
edit('  RETURN cName="operation" OR cName="resource" OR cName="container_id" OR cName="id"\n', '''  RETURN (cResource="nfs-disponiveis" AND cOperation="read"
    AND (cName="skip" OR cName="take" OR cName="filter" OR cName="sort"))
    OR cName="operation" OR cName="resource" OR cName="container_id" OR cName="id"
''')
edit('    IF countRows>200 THEN RUN NfFail("CONTAINER_NF_CANDIDATE_LIMIT",503).\n    RUN NfRow(TRUE,OUTPUT joRow). RUN AcceptRow(joRow).\n','    RUN NfRow(TRUE,OUTPUT joRow). RUN AcceptRow(joRow).\n')
edit('  hDocuments:QUERY-CLOSE(). finished=TRUE.\n','''  hDocuments:QUERY-CLOSE().
  /* One outer deadline includes collection AND the common reader. Its own
     deadline cannot extend this request to collection10 + reader10 seconds. */
  IF cOperation="read" THEN RUN NfPage.
  finished=TRUE.
''')
edit('PROCEDURE OpenQuery:\n','''PROCEDURE KeepNfPage:
 DEFINE INPUT PARAMETER originalRow AS JsonObject NO-UNDO.
 DEFINE VARIABLE fieldsValue AS CHARACTER EXTENT NO-UNDO.
 DEFINE VARIABLE k AS INTEGER NO-UNDO.
 DEFINE VARIABLE f AS HANDLE NO-UNDO.
 DEFINE VARIABLE dateText AS CHARACTER NO-UNDO.
 DEFINE VARIABLE serialized AS LONGCHAR NO-UNDO.
 CREATE ttNfPage. iNfPageRows=iNfPageRows + 1. fieldsValue=originalRow:GetNames().
 DO k=1 TO EXTENT(fieldsValue):
  f=BUFFER ttNfPage:HANDLE:BUFFER-FIELD(fieldsValue[k]).
  IF originalRow:IsNull(fieldsValue[k]) THEN f:BUFFER-VALUE=?.
  ELSE CASE f:DATA-TYPE:
   WHEN "CHARACTER" THEN f:BUFFER-VALUE=originalRow:GetCharacter(fieldsValue[k]).
   WHEN "INTEGER" THEN f:BUFFER-VALUE=originalRow:GetInteger(fieldsValue[k]).
   WHEN "DECIMAL" THEN f:BUFFER-VALUE=originalRow:GetDecimal(fieldsValue[k]).
   WHEN "LOGICAL" THEN f:BUFFER-VALUE=originalRow:GetLogical(fieldsValue[k]).
   WHEN "DATE" THEN DO:
    dateText=originalRow:GetCharacter(fieldsValue[k]).
    f:BUFFER-VALUE=DATE(INTEGER(SUBSTRING(dateText,6,2)),INTEGER(SUBSTRING(dateText,9,2)),INTEGER(SUBSTRING(dateText,1,4))).
   END.
   OTHERWISE RUN NfFail("CONTAINER_NF_PROJECTION_INVALID",503).
  END CASE.
 END.
 originalRow:Write(serialized,FALSE). COPY-LOB FROM serialized TO ttNfPage.nf_original_json.
 RELEASE ttNfPage. DELETE OBJECT originalRow.
END PROCEDURE.
PROCEDURE NfPage:
 DEFINE VARIABLE queryValue AS JsonObject NO-UNDO.
 DEFINE VARIABLE readerPath AS CHARACTER NO-UNDO.
 IF iNfPageRows>iNfReads OR iNfReads>50000 THEN RUN NfFail("CONTAINER_NF_SOURCE_LIMIT",503).
 queryValue=CAST(poRequest:Clone(),JsonObject).
 queryValue:Remove("resource"). queryValue:Remove("container_id").
 readerPath=SEARCH("sursum-api/programs/CiwErpReadService.r").
 IF readerPath=? THEN RUN NfFail("CONTAINER_NF_READER_REQUIRED",503).
 RUN VALUE(readerPath)(INPUT BUFFER ttNfPage:HANDLE,INPUT "container_nfs_disponiveis",INPUT "",INPUT queryValue,OUTPUT joNfPageResponse).
 DELETE OBJECT queryValue.
 IF NOT joNfPageResponse:GetLogical("success") THEN DO:
  IF joNfPageResponse:GetJsonObject("error"):GetCharacter("code")="CIW_ERP_QUERY_TIMEOUT" THEN RUN NfFail("CONTAINER_NF_QUERY_TIMEOUT",503).
  RUN NfFail(joNfPageResponse:GetJsonObject("error"):GetCharacter("code"),joNfPageResponse:GetJsonObject("error"):GetInteger("status")).
 END.
 IF joNfPageResponse:GetInteger("total")>iNfPageRows THEN RUN NfFail("CONTAINER_NF_PROJECTION_INVALID",503).
END PROCEDURE.
PROCEDURE OpenQuery:
''')
edit('  IF cOperation="read" THEN jaRows:Add(poRow).\n','''  IF cResource="nfs-disponiveis" AND cOperation="read" THEN RUN KeepNfPage(poRow).
  ELSE IF cOperation="read" THEN jaRows:Add(poRow).
''')
edit('  ELSE DO: poResponse:Add("success",TRUE). poResponse:Add("data",jaRows). END.\n','''  ELSE IF cResource="nfs-disponiveis" THEN DO:
    DELETE OBJECT poResponse. poResponse=joNfPageResponse.
  END.
  ELSE DO: poResponse:Add("success",TRUE). poResponse:Add("data",jaRows). END.
''')
end()

begin('sursum-api/programs/CiwErpReadService.p')
edit(" IF pcResource='despesas_impostos_geral' AND NOT COMPARE(nameValue,'=',ENTRY(n,cAliasList),'RAW') THEN RUN Fail('CIW_ERP_FIELD_INVALID',422).\n", " IF (pcResource='despesas_impostos_geral' OR pcResource='container_nfs_disponiveis') AND NOT COMPARE(nameValue,'=',ENTRY(n,cAliasList),'RAW') THEN RUN Fail('CIW_ERP_FIELD_INVALID',422).\n")
edit("   RETURN QUOTER(TextChecked(o:GetCharacter(nameValue))).\n",'''   IF pcResource='container_nfs_disponiveis' THEN
    RETURN QUOTER(REPLACE(TextChecked(o:GetCharacter(nameValue)),CHR(126),CHR(126) + CHR(126))).
   RETURN QUOTER(TextChecked(o:GetCharacter(nameValue))).
''')
edit(" IF pcResource='procs_compra_med' THEN RETURN PurchaseOrderData(b).\n",''' IF pcResource='container_nfs_disponiveis' THEN DO:
  /* This private fixed TT is supplied by the Finance service only. Return
     its NfRow JSON verbatim; do not rebuild the NF mapper or opaque key. */
  FIX-CODEPAGE(lc)='UTF-8'. lc=b:BUFFER-FIELD('nf_original_json'):BUFFER-VALUE.
  IF NOT VALID-OBJECT(parser) THEN parser=NEW ObjectModelParser().
  RETURN CAST(parser:Parse(lc),JsonObject).
 END.
 IF pcResource='procs_compra_med' THEN RETURN PurchaseOrderData(b).
''')
edit(" CASE pcResource:\n",''' CASE pcResource:
  WHEN 'container_nfs_disponiveis' THEN ASSIGN cFieldList='container_id,nf_key,documento_localizado,estab,documento,serie,cod_emitente,nat_operacao,especie,dt_emissao,dt_trans,tot_valor,despesa_nota,valor_embal,valor_frete,valor_mercad,valor_outras,valor_seguro' cAliasList=cFieldList cKeyList='nf_key' baseWhere='TRUE'.
''')
edit(" op=poRequest:GetCharacter('operation'). IF LOOKUP(op,'read,get')=0 THEN RUN Fail('CIW_ERP_READ_ONLY',405).\n",''' op=poRequest:GetCharacter('operation'). IF LOOKUP(op,'read,get')=0 THEN RUN Fail('CIW_ERP_READ_ONLY',405).
 IF pcResource='container_nfs_disponiveis' AND op<>'read' THEN RUN Fail('CIW_ERP_READ_ONLY',405).
''')
edit(" DO i=1 TO NUM-ENTRIES(cKeyList):\n  fieldName=ENTRY(i,cKeyList). IF NOT ordered:Has(fieldName)",''' IF pcResource='container_nfs_disponiveis' AND orderText='' THEN
  orderText=' BY ' + b:NAME + '.documento BY ' + b:NAME + '.serie BY ' + b:NAME + '.nat_operacao'.
 DO i=1 TO NUM-ENTRIES(cKeyList):
  fieldName=ENTRY(i,cKeyList). IF NOT ordered:Has(fieldName)''')
edit(" ELSE item:GetCharacter('record_key').", " ELSE IF pcResource='container_nfs_disponiveis' THEN item:GetCharacter('nf_key') ELSE item:GetCharacter('record_key').")
edit("  totalValue=totalValue + 1.\n",'''  totalValue=totalValue + 1.
  IF pcResource='container_nfs_disponiveis' AND totalValue>50000 THEN RUN Fail('CONTAINER_NF_SOURCE_LIMIT',503).
''')
end()

begin('php/RuntimeCiwErpQuery.php')
edit("private const RESOURCES=[", "private const RESOURCES=['container_nfs_disponiveis_med_progress'=>'nfs-disponiveis',")
edit("return match($d['entityCode']??'') {", "return match($d['entityCode']??'') {'container_nfs_disponiveis_med_progress'=>'nf_key',")
edit('''        if (RuntimeSampleContainerItemsRead::supports($d)) {''','''        $nfAvailable=RuntimeContainerNfAvailableRead::supports($d);
        if ($nfAvailable) {
            $context=RuntimeContainerNfAvailableRead::request($d,$endpoint,$payload,'read');
            unset($payload['context']);
        } elseif (RuntimeSampleContainerItemsRead::supports($d)) {''')
edit("        if(!self::supports($d)||($d['primaryKey']??null)!==self::primaryKey($d)||", "        if(!$nfAvailable && (!self::supports($d)||($d['primaryKey']??null)!==self::primaryKey($d)||")
edit("($url['port']??null)===9911))self::invalid();", "($url['port']??null)===9911)))self::invalid();")
end()

begin('php/RuntimeContainerNfAvailableRead.php')
edit('''   // Native export requests at least 1000; the upstream set is still capped at 200.
   foreach(['take','pageSize']as$bound)if(isset($payload[$bound])&&(!is_int($payload[$bound])||$payload[$bound]<1))self::fail(422);''','''   // Page/filter/sort validation is shared with RuntimeCiwErpQuery.
   foreach(['take','pageSize']as$bound)if(isset($payload[$bound])&&(!is_int($payload[$bound])||$payload[$bound]<1||$payload[$bound]>200))self::fail(422);''')
edit(''' public static function response(array $body,mixed $data,array $context,?string $id=null):void''',''' public static function pageResponse(array $body,array $query):void
 {
  if(!RuntimeProgressAuditSchema::exact($body,['success','data','total'])||$body['success']!==true||!is_int($body['total'])||$body['total']<0||$body['total']>50000
   ||!is_array($body['data'])||!array_is_list($body['data'])||count($body['data'])!==min($query['take'],max(0,$body['total']-$query['skip'])))self::fail();
  $seen=[];foreach($body['data']as$row){self::row($row,$query,null);if(isset($seen[$row['nf_key']]))self::fail();$seen[$row['nf_key']]=true;}
 }
 public static function response(array $body,mixed $data,array $context,?string $id=null):void''')
end()

begin('php/RuntimeApiEntityActionService.php')
edit('''        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::readResponse($body); }''','''        if (RuntimeContainerNfAvailableRead::supports($definition)) { RuntimeContainerNfAvailableRead::pageResponse($body,$query); }
        if (RuntimeItemCostManualRead::supports($definition)) { RuntimeItemCostManualRead::readResponse($body); }''')
edit('''            $valid=$containerFiscalKey !== null ?''','''            $valid=RuntimeContainerNfAvailableRead::supports($definition) ? true : ($containerFiscalKey !== null ?''')
edit("is_string($row['record_key'] ?? null) && $row['record_key']!==''));", "is_string($row['record_key'] ?? null) && $row['record_key']!=='')));")
end()

(P/'patches/patch-plan.json').write_text(json.dumps({'textPatches':patches,'productionFiles':5,'canonicalWrites':False,'preservesFrozen1055':True},indent=2)+'\n',encoding='utf8')
print(json.dumps([{'relative':p['relative'],'hunks':len(p['changes']),'baseline':p['baselineSha256'],'candidate':p['candidateSha256']}for p in patches]))
