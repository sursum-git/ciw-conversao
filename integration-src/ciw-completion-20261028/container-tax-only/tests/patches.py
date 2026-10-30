# Executed by prepare.py, producing only staging copies and baseline patches.
def patch(relative,changes):
 target=canonical/relative;before=target.read_text(encoding='utf-8-sig');after=before
 for old,new in changes:
  assert after.count(old)==1,(relative,old)
  after=after.replace(old,new)
 p=root/'patches';p.mkdir(exist_ok=True)
 (p/(target.name+'.patch')).write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=str(target),tofile=str(target))),encoding='utf-8')
 patchPlans.append({'target':target.as_posix(),'baselineSha256':hashlib.sha256(target.read_bytes()).hexdigest(),'changes':[{'old':a,'new':b}for a,b in changes]})
 files[relative]=after
patchPlans=[]
patch('sursum-api/programs/ContainersImpostosService.p',[
 ('DEFINE VARIABLE lcMemory AS LONGCHAR NO-UNDO.','DEFINE VARIABLE lcMemory AS LONGCHAR NO-UNDO.\nDEFINE VARIABLE iTaxOnlyRows AS INTEGER NO-UNDO.\nDEFINE VARIABLE iTaxOnlyStarted AS INTEGER NO-UNDO.\nDEFINE VARIABLE lTaxOnlyCompleted AS LOGICAL NO-UNDO.'),
 (' IF hqBuffer:LOCKED THEN RUN Fail(',''' IF cOperation="calcular_impostos" AND NOT hq:QUERY-OFF-END THEN DO:
  iTaxOnlyRows=iTaxOnlyRows + 1.
  IF iTaxOnlyRows>50000 OR ETIME - iTaxOnlyStarted>10000 THEN RUN Fail("CONTAINER_TAX_LIMIT","Limite do comando fiscal excedido.",503).
 END.
 IF hqBuffer:LOCKED THEN RUN Fail('''),
 (' IF cOperation="sincronizar" THEN DO:\n  RUN NextCalculoId',' IF cOperation="sincronizar" OR cOperation="calcular_impostos" THEN DO:\n  RUN NextCalculoId'),
 (' IF cOperation<>"sincronizar" AND cOperation<>"atualizar_despesas_calculadas" THEN',' IF cOperation<>"sincronizar" AND cOperation<>"calcular_impostos" AND cOperation<>"atualizar_despesas_calculadas" THEN'),
 ('  RUN CheckInputs. RUN LoadState.\n  IF cOperation="sincronizar" THEN DO: RUN TaxPlan. RUN IpiPlan. END.\n  ELSE RUN CalculatedPlan.\n  RUN PersistPlan.','''  IF cOperation="calcular_impostos" THEN DO:
   iTaxOnlyStarted=ETIME.
   DO STOP-AFTER 10 ON STOP UNDO, LEAVE:
    RUN FiscalPlan. lTaxOnlyCompleted=TRUE.
   END.
   IF NOT lTaxOnlyCompleted THEN RUN Fail("CONTAINER_TAX_LIMIT","Tempo limite do comando fiscal excedido.",503).
  END.
  ELSE RUN FiscalPlan.'''),
 ('PROCEDURE BuildError:','''/* One shared planner/persister path. The new command deliberately skips IPI. */
PROCEDURE FiscalPlan:
 RUN CheckInputs. RUN LoadState.
 IF cOperation="sincronizar" THEN DO: RUN TaxPlan. RUN IpiPlan. END.
 ELSE IF cOperation="calcular_impostos" THEN RUN TaxPlan.
 ELSE RUN CalculatedPlan.
 RUN PersistPlan.
END PROCEDURE.
PROCEDURE BuildError:''')
])
patch('sursum-api/includes/ContainerProcessBoundary.i',[
 (' ELSE IF resourceValue<>"impostos" OR operationValue<>"sincronizar" THEN',' ELSE IF resourceValue<>"impostos" OR (operationValue<>"sincronizar" AND operationValue<>"calcular_impostos") THEN')
])
patch('sursum-api/programs/ContainersProcessosService.p',[
 ('  beforeValue=ProcessSnapshot(master,cid).','''  IF op="calcular_impostos" THEN DO:
   failureCode="CONTAINER_PROCESS_MED_REQUIRED". failureStatus=422.
   IF master:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE=? OR NOT STRING(master:BUFFER-FIELD("cod-estabel"):BUFFER-VALUE) BEGINS "5" THEN UNDO, THROW NEW Progress.Lang.AppError("Comando fiscal exige container MED sob lock.",1).
   failureCode="CONTAINER_PROCESS_BUSY". failureStatus=409.
  END.
  beforeValue=ProcessSnapshot(master,cid).'''),
 ('  IF op="sincronizar" THEN DO:','  IF op="sincronizar" OR op="calcular_impostos" THEN DO:'),
 (' poResponse=NEW JsonObject(). dataValue=NEW JsonObject(). dataValue:Add("type","message").',' poResponse=NEW JsonObject(). IF op="calcular_impostos" THEN poResponse:Add("committed",TRUE). dataValue=NEW JsonObject(). dataValue:Add("type","message").'),
 (' ELSE messageValue=messageValue + "impostos sincronizados; memoria "',' ELSE messageValue=messageValue + (IF op="calcular_impostos" THEN "impostos calculados; memoria " ELSE "impostos sincronizados; memoria ")')
])
patch('sursum-api/programs/ContainersProcessos.p',[
 (' hCollector[1]:BUFFER-RELEASE().',''' IF op="calcular_impostos" AND NOT cEstab BEGINS "5" THEN DO: RUN Fail("CONTAINER_PROCESS_MED_REQUIRED","Comando fiscal exige container MED.",422). RETURN. END.
 hCollector[1]:BUFFER-RELEASE().''')
])
(root/'patches/abl-plan.json').write_text(json.dumps({'textPatches':patchPlans},indent=2),encoding='utf-8')
