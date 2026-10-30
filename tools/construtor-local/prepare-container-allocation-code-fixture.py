"""Prepare exactly the authorized synthetic ERP code on three new API-owned IDs."""
from pathlib import Path
import json, hashlib

root=Path(__file__).resolve().parents[2]
state=root/'.runtime/container-allocation-batch-20261026'
gate=json.loads((state/'authorizations.json').read_text())
assert gate['authorized'] and gate['scenarioAuthorized'] and gate['syntheticErp']=='ZTSC261026'
folder=state/'private-code-fixture'; assert not folder.exists(); folder.mkdir()
parent=json.loads((state/'exercise/confirmed-create-parent.json').read_text())
assert parent['success'] and parent['tag']=='SC_TEST_ALOC_LOTE_20261026'
pid=parent['record']['proc_compra_id']; assert type(pid) is int and pid>0
rows=[]
for label in ['A','B','C']:
    row=json.loads((state/('exercise/confirmed-create-item-'+label+'.json')).read_text())
    assert row['success'] and row['tag']==gate['tag']
    row=row['record']; assert row['proc_compra_id']==pid and row['codigo_erp']==''
    assert row['descricao']==gate['tag']+'/'+label and row['observacao']==row['descricao']
    assert type(row['item_proc_compra_id']) is int and row['item_proc_compra_id']>0
    rows.append(row)
assert len({x['item_proc_compra_id'] for x in rows})==3
manifest=dict(tag=gate['tag'],erp=gate['syntheticErp'],parentId=pid,items=rows)
(folder/'approved-new-items.json').write_text(json.dumps(manifest,indent=2))
code='''/* PRIVATE fixture. Only3newAPI-owned rows; no route, sequences or schema. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{sursum-api/includes/ContainerTransactionAudit.i}
DEFINE VARIABLE manifest AS JsonObject NO-UNDO. DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE inputText AS LONGCHAR NO-UNDO. DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE expected AS JsonObject NO-UNDO. DEFINE VARIABLE physical AS JsonObject NO-UNDO.
DEFINE VARIABLE changes AS JsonArray NO-UNDO. DEFINE VARIABLE changeValue AS JsonObject NO-UNDO.
DEFINE VARIABLE hParent AS HANDLE NO-UNDO. DEFINE VARIABLE hItem AS HANDLE EXTENT 3 NO-UNDO.
DEFINE VARIABLE hRefs AS HANDLE NO-UNDO. DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE itemId AS INTEGER NO-UNDO. DEFINE VARIABLE names AS CHARACTER EXTENT NO-UNDO.
DEFINE VARIABLE fieldName AS CHARACTER NO-UNDO. DEFINE VARIABLE committed AS LOGICAL NO-UNDO.
DEFINE VARIABLE matched AS LOGICAL NO-UNDO.
FUNCTION N RETURNS CHARACTER(v AS INTEGER): RETURN TRIM(STRING(v,'->>>>>>>>>9')). END FUNCTION.
PROCEDURE Require:
 DEFINE INPUT PARAMETER condition AS LOGICAL NO-UNDO. DEFINE INPUT PARAMETER messageValue AS CHARACTER NO-UNDO.
 IF condition<>TRUE OR condition=? THEN UNDO, THROW NEW Progress.Lang.AppError(messageValue,1).
END PROCEDURE.
FUNCTION FindLocked RETURNS LOGICAL(b AS HANDLE,predicate AS CHARACTER):
 DEFINE VARIABLE found AS LOGICAL NO-UNDO. DEFINE VARIABLE messageNo AS INTEGER NO-UNDO.
 found=b:FIND-FIRST('WHERE ' + predicate,EXCLUSIVE-LOCK,NO-WAIT) NO-ERROR.
 IF b:LOCKED THEN UNDO, THROW NEW Progress.Lang.AppError('Owned test row busy',1).
 DO messageNo=1 TO ERROR-STATUS:NUM-MESSAGES: IF ERROR-STATUS:GET-NUMBER(messageNo)<>565 THEN UNDO, THROW NEW Progress.Lang.AppError('Owned read failed',1). END.
 RETURN found.
END FUNCTION.
OUTPUT TO 'fixture.log'.
DO ON ERROR UNDO, THROW:
 RUN Require(PROVERSION='12.2' AND NUM-DBS=1 AND LDBNAME(1)='espec','Official12.2/espec only').
 RUN Require(SEARCH('fixture.json')=?,'Receipt exists; never replay').
 FIX-CODEPAGE(inputText)='UTF-8'. COPY-LOB FROM FILE 'approved-new-items.json' TO inputText.
 parser=NEW ObjectModelParser(). manifest=CAST(parser:Parse(inputText),JsonObject).
 RUN Require(manifest:GetCharacter('tag')='SC_TEST_ALOC_LOTE_20261026' AND manifest:GetCharacter('erp')='ZTSC261026' AND manifest:GetInteger('parentId')=@PID@,'Closed fixture scope mismatch').
 RUN Require(manifest:GetJsonArray('items'):Length=3,'Exactly3new API items required').
 CREATE BUFFER hParent FOR TABLE 'espec.procs_compra'. CREATE BUFFER hRefs FOR TABLE 'espec.itens_container'.
 changes=NEW JsonArray().
 DO TRANSACTION ON ERROR UNDO, THROW:
  RUN Require(FindLocked(hParent,'proc_compra_id=@PID@'),'Owned new parent missing').
  RUN Require(hParent:BUFFER-FIELD('cod_proc_fornec'):BUFFER-VALUE='SC_TEST_ALOC_LOTE_20261026' AND hParent:BUFFER-FIELD('observacao'):BUFFER-VALUE='SC_TEST_ALOC_LOTE_20261026' AND hParent:BUFFER-FIELD('empresa_id'):BUFFER-VALUE=2 AND hParent:BUFFER-FIELD('log_considerar_previsao'):BUFFER-VALUE=FALSE,'Parent ownership or forecast mismatch').
  DO n=1 TO 3:
   expected=manifest:GetJsonArray('items'):GetJsonObject(n). itemId=expected:GetInteger('item_proc_compra_id').
   RUN Require(itemId=INTEGER(ENTRY(n,'@IDS@')),'Only3exact API IDs allowed').
   CREATE BUFFER hItem[n] FOR TABLE 'espec.itens_proc_compra' BUFFER-NAME ('newFixtureItem' + N(n)).
   RUN Require(FindLocked(hItem[n],'item_proc_compra_id=' + N(itemId) + ' AND proc_compra_id=@PID@'),'Owned new item missing').
   matched=hRefs:FIND-FIRST('WHERE item_proc_compra_id=' + N(itemId),SHARE-LOCK,NO-WAIT) NO-ERROR.
   RUN Require(NOT matched AND NOT hRefs:LOCKED AND NOT ERROR-STATUS:ERROR,'Item already allocated or uncertain; stop fixture').
   physical=ProcessSnapshot(hItem[n],2147000107). names=physical:GetNames().
   DO k=1 TO EXTENT(names):
    fieldName=names[k]. IF fieldName='container_id' THEN NEXT.
    RUN Require(expected:Has(fieldName),'API snapshot lacks physical field ' + fieldName).
    RUN Require(physical:GetType(fieldName)=expected:GetType(fieldName),'Physical type differs ' + fieldName).
    IF physical:GetType(fieldName)=JsonDataType:NUMBER THEN RUN Require(physical:GetDecimal(fieldName)=expected:GetDecimal(fieldName),'Physical number differs ' + fieldName).
    ELSE RUN Require(COMPARE(STRING(physical:GetJsonText(fieldName)),'=',STRING(expected:GetJsonText(fieldName)),'RAW'),'Physical image differs ' + fieldName).
   END.
   RUN Require(hItem[n]:BUFFER-FIELD('codigo_erp'):BUFFER-VALUE='','Only blank new code may be prepared').
   changeValue=NEW JsonObject(). changeValue:Add('itemId',itemId). changeValue:Add('before',physical). changes:Add(changeValue).
  END.
  DO n=1 TO 3:
   hItem[n]:BUFFER-FIELD('codigo_erp'):BUFFER-VALUE='ZTSC261026'.
   RUN Require(hItem[n]:BUFFER-VALIDATE(),'New code refused by database').
   changes:GetJsonObject(n):Add('after',ProcessSnapshot(hItem[n],2147000107)).
  END.
 END.
 committed=TRUE. resultValue=NEW JsonObject(). resultValue:Add('success',TRUE). resultValue:Add('parentId',@PID@). resultValue:Add('erp','ZTSC261026'). resultValue:Add('changes',changes). resultValue:Add('fixtureOnly',TRUE). resultValue:Add('schemaChanged',FALSE). resultValue:WriteFile('fixture.json',TRUE).
 PUT UNFORMATTED 'PASS3newAPI-owned ERPcodes prepared after exact physical images; no sequences/schema' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL committed=' committed ' ' err:GetMessage(1) SKIP. END CATCH.
 FINALLY:
  DO n=1 TO 3: IF VALID-HANDLE(hItem[n]) THEN DELETE OBJECT hItem[n] NO-ERROR. END.
  IF VALID-HANDLE(hParent) THEN DELETE OBJECT hParent NO-ERROR. IF VALID-HANDLE(hRefs) THEN DELETE OBJECT hRefs NO-ERROR.
 END FINALLY.
END.
OUTPUT CLOSE. QUIT.
'''.replace('@PID@',str(pid)).replace('@IDS@',','.join(str(x['item_proc_compra_id']) for x in rows))
(folder/'PrepareNewCodes.p').write_text(code)
includes=folder/'sursum-api/includes';includes.mkdir(parents=True)
(includes/'ContainerTransactionAudit.i').write_bytes((root/'integration-src/container-allocation-batch/abl/ContainerTransactionAudit.i').read_bytes())
(folder/'CompileFixture.p').write_text("OUTPUT TO 'compile.log'. COMPILE PrepareNewCodes.p SAVE NO-ERROR. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' COMPILER:ERROR=' COMPILER:ERROR SKIP. IF COMPILER:ERROR THEN DO: DEFINE VARIABLE n AS INTEGER NO-UNDO. DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END. END. OUTPUT CLOSE. QUIT.\n")
remote='C:/Users/tadeu.parreiras/codex-allocation-20261026-private-codes'
ps=f"""$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
if(Test-Path -LiteralPath fixture.json){{throw 'Existing fixture receipt; inspect before replay'}}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileFixture.p *> compile-process.log
Get-Content -LiteralPath compile.log
if((Get-Content -LiteralPath compile.log -Raw) -notmatch 'COMPILER:ERROR=no'){{throw 'Private fixture compile failed'}}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p PrepareNewCodes.r *> fixture-process.log
Get-Content -LiteralPath fixture.log
if(!(Test-Path -LiteralPath fixture.json)){{Get-Content -LiteralPath fixture-process.log;throw 'Fixture unconfirmed; inspect, never replay automatically'}}
"""
(folder/'run.ps1').write_text(ps)
files=[p for p in folder.rglob('*')if p.is_file()]
plan=dict(server='compiler',directories=[remote,remote+'/sursum-api',remote+'/sursum-api/includes'],uploads=[dict(local=str(p.relative_to(root)),remote=remote+'/'+p.relative_to(folder).as_posix())for p in files],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/run.ps1'],downloads=[dict(local=str((folder/n).relative_to(root)),remote=remote+'/'+n,optional=True)for n in ['compile.log','compile-process.log','fixture.log','fixture-process.log','fixture.json']])
(folder/'plan.json').write_text(json.dumps(plan,indent=2))
print('Prepared private fixture for3new API IDs only; no execution yet')
