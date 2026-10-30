from pathlib import Path
import hashlib,json,re,difflib
root=Path(__file__).resolve().parents[1];workspace=root.parents[2];state=workspace/'.runtime/ciw-completion-20261028/container-nf-available-readonly';plans=[]
def patch(relative,target,changes):
 before=(state/'baseline'/relative).read_bytes();after=before;steps=[]
 for old,new in changes:
  pattern=b'\r?\n'.join(re.escape(part.encode('utf8'))for part in old.split('\n'));matches=list(re.finditer(pattern,after));assert len(matches)==1,(relative,old)
  match=matches[0];segment=match.group();eol=b'\r\n'if b'\r\n'in segment or before.count(b'\r\n')>before.count(b'\n')/2 else b'\n';replacement=new.encode('utf8').replace(b'\n',eol)
  after=after[:match.start()]+replacement+after[match.end():];steps.append({'oldBytesHex':segment.hex(),'newBytesHex':replacement.hex(),'old':segment.decode('utf8'),'new':replacement.decode('utf8')})
 (root/'patches').mkdir(exist_ok=True);(root/'patches'/(Path(target).name+'.patch')).write_text(''.join(difflib.unified_diff(before.decode('utf8').splitlines(True),after.decode('utf8').splitlines(True),fromfile=target,tofile=target)),encoding='utf8',newline='')
 plans.append({'target':target,'relative':relative,'baselineSha256':hashlib.sha256(before).hexdigest(),'candidateSha256':hashlib.sha256(after).hexdigest(),'candidateRuntimePath':(state/'local'/relative).as_posix(),'preservesAllBytesOutsideAnchors':True,'applyMode':'byte-exact-sequential-anchors','changes':steps})
patch('sursum-api/programs/ContainersPainelFinanceRead.p','D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceRead.p',[
 (' IF cResource="nfs" THEN DO:',' IF cResource="nfs" OR cResource="nfs-disponiveis" THEN DO:'),
 ('  IF cEstab=? OR LENGTH(cEstab)=0 THEN DO: RUN Fail("CONTAINER_COMPANY_CONTEXT","Estabelecimento nao configurado.",422). RETURN. END.','  IF cResource="nfs-disponiveis" THEN\n   IF cEstab=? OR NOT cEstab BEGINS "5" THEN DO: RUN Fail("CONTAINER_NF_MED_REQUIRED","NFs disponiveis exigem container MED.",422). RETURN. END.\n  IF cEstab=? OR LENGTH(cEstab)=0 THEN DO: RUN Fail("CONTAINER_COMPANY_CONTEXT","Estabelecimento nao configurado.",422). RETURN. END.')])
nf_procedures='''/* Same NF row/key mapper as linked NFs; only this new read selection differs. */
FUNCTION NfDocumentHash RETURNS CHARACTER (pcValue AS CHARACTER):
 DEFINE VARIABLE hashValue AS CHARACTER NO-UNDO.
 hashValue=CAPS(HEX-ENCODE(MESSAGE-DIGEST("SHA-256",pcValue))).
 RETURN hashValue.
END FUNCTION.
FUNCTION NfDocumentAmbiguous RETURNS LOGICAL (pcValue AS CHARACTER):
 DEFINE VARIABLE k AS INTEGER NO-UNDO.
 IF pcValue=? OR LENGTH(pcValue)=0 THEN RETURN FALSE.
 /* A refusal gate, never a normalization or a substitute SQL collation. */
 IF INDEX(CHR(9) + CHR(10) + CHR(13) + " ",SUBSTRING(pcValue,1,1))>0
  OR INDEX(CHR(9) + CHR(10) + CHR(13) + " ",SUBSTRING(pcValue,LENGTH(pcValue),1))>0 THEN RETURN TRUE.
 DO k=1 TO LENGTH(pcValue): IF ASC(SUBSTRING(pcValue,k,1))>127 THEN RETURN TRUE. END.
 RETURN FALSE.
END FUNCTION.
PROCEDURE NfFail:
 DEFINE INPUT PARAMETER codeValue AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER statusValue AS INTEGER NO-UNDO.
 ASSIGN cNfError=codeValue iNfStatus=statusValue.
 UNDO, THROW NEW Progress.Lang.AppError("Available NF selection refused.",1).
END PROCEDURE.
PROCEDURE NfReadBound:
 IF ETIME - iNfStarted>=10000 OR iNfReads>=50000 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).
 iNfReads=iNfReads + 1.
END PROCEDURE.
PROCEDURE AvailableNfs:
 DEFINE VARIABLE supplierValue AS INTEGER NO-UNDO.
 DEFINE VARIABLE estabValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE cNfDocument AS CHARACTER NO-UNDO.
 DEFINE VARIABLE countRows AS INTEGER NO-UNDO.
 DEFINE VARIABLE hasExclusions AS LOGICAL NO-UNDO.
 DEFINE VARIABLE hasAmbiguousExclusions AS LOGICAL NO-UNDO.
 DEFINE VARIABLE excluded AS LOGICAL NO-UNDO.
 DEFINE VARIABLE documentHashValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE finished AS LOGICAL NO-UNDO.
 supplierValue=phContainer:BUFFER-FIELD("cod-emit-forn"):BUFFER-VALUE.
 estabValue=phContainer:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.
 IF supplierValue=? THEN RUN NfFail("CONTAINER_NF_SUPPLIER_REQUIRED",422).
 ASSIGN iNfStarted=ETIME iNfReads=0.
 DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
  RUN OpenQuery(hLinks,phNfs,phNfs:NAME + ".container_id=" + TRIM(STRING(iContainer)),"").
  DO WHILE NOT hLinks:QUERY-OFF-END:
   RUN NfReadBound.
   cNfDocument=phNfs:BUFFER-FIELD("documento"):BUFFER-VALUE.
   /* The source interpolates PHP NULL as an empty SQL string, with no TRIM. */
   IF cNfDocument=? THEN cNfDocument="".
   documentHashValue=NfDocumentHash(cNfDocument).
   IF NOT CAN-FIND(ttNfExcluded WHERE ttNfExcluded.documentHash=documentHashValue) THEN DO:
    CREATE ttNfExcluded. ASSIGN ttNfExcluded.documentHash=documentHashValue ttNfExcluded.documentValue=cNfDocument. RELEASE ttNfExcluded.
   END.
   IF NfDocumentAmbiguous(cNfDocument) THEN hasAmbiguousExclusions=TRUE.
   hasExclusions=TRUE. hLinks:GET-NEXT().
  END.
  hLinks:QUERY-CLOSE().
  cWhere=phDocumEst:NAME + ".cod-estabel=" + AblQuote(estabValue)
   + " AND " + phDocumEst:NAME + ".cod-emitente=" + TRIM(STRING(supplierValue))
   + " AND " + phDocumEst:NAME + ".nat-operacao BEGINS ~"3~""
   + " AND " + phDocumEst:NAME + ".idi-sit-nf-eletro=3".
  RUN OpenQuery(hDocuments,phDocumEst,cWhere,"BY " + phDocumEst:NAME + ".nro-docto BY " + phDocumEst:NAME + ".serie-docto BY " + phDocumEst:NAME + ".nat-operacao").
  DO WHILE NOT hDocuments:QUERY-OFF-END AND NOT lMatched:
   RUN NfReadBound.
   cNfDocument=phDocumEst:BUFFER-FIELD("nro-docto"):BUFFER-VALUE.
   excluded=FALSE.
   IF hasExclusions THEN DO:
    /* SQL <> any associated document excludes an unknown candidate value. */
    IF cNfDocument=? THEN excluded=TRUE.
    ELSE DO:
     documentHashValue=NfDocumentHash(cNfDocument).
     IF CAN-FIND(ttNfExcluded WHERE ttNfExcluded.documentHash=documentHashValue) THEN excluded=TRUE.
     ELSE IF hasAmbiguousExclusions OR NfDocumentAmbiguous(cNfDocument)
      OR CAN-FIND(ttNfExcluded WHERE ttNfExcluded.documentValue=cNfDocument) THEN RUN NfFail("CONTAINER_NF_COLLATION_UNPROVEN",422).
    END.
   END.
   IF NOT excluded THEN DO:
    countRows=countRows + 1.
    IF countRows>200 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).
    RUN NfRow(TRUE,OUTPUT joRow). RUN AcceptRow(joRow).
   END.
   hDocuments:GET-NEXT().
  END.
  hDocuments:QUERY-CLOSE(). finished=TRUE.
 END.
 IF NOT finished OR ETIME - iNfStarted>=10000 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).
END PROCEDURE.
'''
patch('sursum-api/programs/ContainersPainelFinanceReadService.p','D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceReadService.p',[
 ('DEFINE VARIABLE cOptionMessage AS CHARACTER NO-UNDO.','DEFINE VARIABLE cOptionMessage AS CHARACTER NO-UNDO.\nDEFINE TEMP-TABLE ttNfExcluded NO-UNDO FIELD documentValue AS CHARACTER FIELD documentHash AS CHARACTER CASE-SENSITIVE INDEX pk IS PRIMARY UNIQUE documentHash.\nDEFINE VARIABLE iNfStarted AS INTEGER NO-UNDO.\nDEFINE VARIABLE iNfReads AS INTEGER NO-UNDO.\nDEFINE VARIABLE cNfError AS CHARACTER NO-UNDO.\nDEFINE VARIABLE iNfStatus AS INTEGER NO-UNDO.'),
 ('PROCEDURE OpenQuery:',nf_procedures+'PROCEDURE OpenQuery:'),
 ('    WHEN "nfs" THEN cKeyField="nf_key".','    WHEN "nfs" THEN cKeyField="nf_key".\n    WHEN "nfs-disponiveis" THEN cKeyField="nf_key".'),
 ('    IF NOT ValidKey(cId) THEN DO: RUN Fail("CONTAINER_VALIDATION","Chave invalida.",422). RETURN. END.','    IF NOT ValidKey(cId) THEN DO: RUN Fail("CONTAINER_VALIDATION","Chave invalida.",422). RETURN. END.\n    IF cResource="nfs-disponiveis" AND cId<>("nf_" + CAPS(SUBSTRING(cId,4))) THEN DO: RUN Fail("CONTAINER_VALIDATION","Chave invalida.",422). RETURN. END.'),
 ('  IF NOT VALID-HANDLE(phEmpresas) THEN UNDO, THROW NEW Progress.Lang.AppError("Missing company buffer.",0).\n  RUN CompanyContext.\n  IF cCompany="" THEN DO: RUN Fail("CONTAINER_COMPANY_CONTEXT","Empresa do estabelecimento ausente ou ambigua.",422). RETURN. END.','  IF cResource="nfs-disponiveis" THEN DO:\n    cPrefix=phContainer:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE.\n    IF cPrefix=? OR NOT cPrefix BEGINS "5" THEN DO: RUN Fail("CONTAINER_NF_MED_REQUIRED","NFs disponiveis exigem container MED.",422). RETURN. END.\n  END.\n  ELSE DO:\n  IF NOT VALID-HANDLE(phEmpresas) THEN UNDO, THROW NEW Progress.Lang.AppError("Missing company buffer.",0).\n  RUN CompanyContext.\n  IF cCompany="" THEN DO: RUN Fail("CONTAINER_COMPANY_CONTEXT","Empresa do estabelecimento ausente ou ambigua.",422). RETURN. END.\n  END.'),
 ('    RUN OpenQuery(hLinks,phNfs,phNfs:NAME + ".container_id = " + TRIM(STRING(iContainer)),"BY " + phNfs:NAME + ".documento BY "','    IF cResource="nfs-disponiveis" THEN RUN AvailableNfs.\n    ELSE DO:\n    RUN OpenQuery(hLinks,phNfs,phNfs:NAME + ".container_id = " + TRIM(STRING(iContainer)),"BY " + phNfs:NAME + ".documento BY "'),
 ('      IF NOT lFound THEN DO: RUN NfRow(FALSE,OUTPUT joRow). RUN AcceptRow(joRow). END.\n      hLinks:GET-NEXT().\n    END.\n  END.','      IF NOT lFound THEN DO: RUN NfRow(FALSE,OUTPUT joRow). RUN AcceptRow(joRow). END.\n      hLinks:GET-NEXT().\n    END.\n    END.\n  END.'),
 ('    IF cResource="pagamentos-disponiveis" AND cOptionError<>"" THEN RUN Fail(cOptionError,cOptionMessage,422).','    IF cResource="nfs-disponiveis" AND cNfError<>"" THEN RUN Fail(cNfError,"Consulta de NFs disponiveis recusada; contexto ou limite invalido.",iNfStatus).\n    ELSE IF cResource="pagamentos-disponiveis" AND cOptionError<>"" THEN RUN Fail(cOptionError,cOptionMessage,422).')])
patch('php/RuntimeApiEntityActionService.php','D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php',[
 ('        $definition = $this->resolveDefinition($entityCode);','        $definition = $this->resolveDefinition($entityCode);\n        if (RuntimeContainerNfAvailableRead::supports($definition) && !in_array($operation,["read","get"],true)) { throw new RuntimeHttpException("CONTAINER_NF_READ_ONLY","NFs disponiveis permitem somente consulta.",405); }'),
 ('        $context = ApiRequestContext::resolve($definition, $definition[\'apiSource\'][\'listEndpoint\'], $payload);','        $context = RuntimeContainerNfAvailableRead::supports($definition) ? RuntimeContainerNfAvailableRead::request($definition,$definition[\'apiSource\'][\'listEndpoint\'],$payload,"read") : ApiRequestContext::resolve($definition, $definition[\'apiSource\'][\'listEndpoint\'], $payload);'),
 ('        $items = $this->extractItems($response[\'body\'], (string) $definition[\'apiSource\'][\'listResponse\'][\'itemsPath\']);','        if (RuntimeContainerNfAvailableRead::supports($definition)) { RuntimeContainerNfAvailableRead::response($response[\'body\'],$response[\'body\'][\'data\']??null,$context); }\n        $items = $this->extractItems($response[\'body\'], (string) $definition[\'apiSource\'][\'listResponse\'][\'itemsPath\']);'),
 ('        $id = $this->extractRecordId($definition, $payload);\n        if (RuntimeItemCostManualRead::supports($definition))','        $id = $this->extractRecordId($definition, $payload);\n        if (RuntimeContainerNfAvailableRead::supports($definition)) { RuntimeContainerNfAvailableRead::request($definition,$definition[\'apiSource\'][\'detailEndpoint\']??[],$payload,"get",$id); }\n        if (RuntimeItemCostManualRead::supports($definition))'),
 ('            $item = $this->extractByPath($response[\'body\'], $path);','            $item = $this->extractByPath($response[\'body\'], $path);\n            if (RuntimeContainerNfAvailableRead::supports($definition)) { RuntimeContainerNfAvailableRead::response($response[\'body\'],$item,$context,$id); }')])
(root/'patches/patch-plan.json').write_text(json.dumps({'textPatches':plans},indent=2)+'\n',encoding='utf8')
print('Prepared three byte-preserving shared patches; canonical files untouched')
