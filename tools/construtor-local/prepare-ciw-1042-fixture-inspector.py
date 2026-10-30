"""Prepare fixed-CID read-only ownership/count inspection for the approved scenario."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector';b.mkdir()
remote='C:/Users/tadeu.parreiras/codex-ciw-1042-fixture-inspector-v1'
probe='''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE report AS JsonObject NO-UNDO.
DEFINE VARIABLE resultRows AS JsonArray NO-UNDO.
DEFINE VARIABLE rowResult AS JsonObject NO-UNDO.
DEFINE VARIABLE h AS HANDLE NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE f AS HANDLE NO-UNDO.
DEFINE VARIABLE tableNames AS CHARACTER NO-UNDO INITIAL "pp-container,itens_container,despesas_container,calcs_imp_container,pp-it-container,pp_container_permissao,pp_container_saldo_repres,nfs_container,cta_corren_desconto,anexos_container,versoes_item_custo_container,pagtos_container,cta_corren_fornec_imp".
DEFINE VARIABLE parentFields AS CHARACTER NO-UNDO INITIAL "nr-container,container_id,container_id,container_id,nr-container,nr_container,nr_container,container_id,container_id,container_id,container_id,container_id,container_id".
DEFINE VARIABLE marker AS CHARACTER NO-UNDO INITIAL "CIW-1042-VALIDACAO-20261028-2147000110".
DEFINE VARIABLE phaseName AS CHARACTER NO-UNDO.
DEFINE VARIABLE outputName AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE countRows AS INTEGER NO-UNDO.
DEFINE VARIABLE totalRows AS INTEGER NO-UNDO.
DEFINE VARIABLE started AS INTEGER NO-UNDO.
DEFINE VARIABLE masterOwned AS LOGICAL NO-UNDO.
DEFINE VARIABLE finished AS LOGICAL NO-UNDO.
phaseName=SESSION:PARAMETER.
IF LOOKUP(phaseName,"empty,owned,cleaned")=0 OR NUM-DBS<>1 OR NOT CONNECTED("espec") THEN QUIT.
outputName="fixture-"+phaseName+".json".
FILE-INFO:FILE-NAME=outputName.
IF FILE-INFO:FULL-PATHNAME<>? THEN QUIT.
ASSIGN report=NEW JsonObject() resultRows=NEW JsonArray() started=ETIME.
DO STOP-AFTER 10 ON STOP UNDO, LEAVE ON ERROR UNDO, THROW:
 DO n=1 TO NUM-ENTRIES(tableNames):
  CREATE BUFFER h FOR TABLE ("espec."+ENTRY(n,tableNames)) BUFFER-NAME ("b1042fixed"+STRING(n)).
  f=h:BUFFER-FIELD(ENTRY(n,parentFields)).
  IF f:DATA-TYPE<>"INTEGER" THEN UNDO, THROW NEW Progress.Lang.AppError("Unexpected fixture key type",1).
  CREATE QUERY q. q:SET-BUFFERS(h).
  IF NOT q:QUERY-PREPARE("FOR EACH "+h:NAME+" WHERE "+h:NAME+"."+f:NAME+"=2147000110 NO-LOCK") THEN UNDO, THROW NEW Progress.Lang.AppError("Closed fixture query rejected",1).
  q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK). countRows=0.
  DO WHILE NOT q:QUERY-OFF-END:
   ASSIGN countRows=countRows+1 totalRows=totalRows+1.
   IF totalRows>100 OR ETIME-started>10000 THEN UNDO, THROW NEW Progress.Lang.AppError("Fixture read budget exceeded",1).
   IF n=1 THEN masterOwned=COMPARE(h:BUFFER-FIELD("narrativa"):BUFFER-VALUE,"=",marker,"RAW").
   q:GET-NEXT(NO-LOCK).
  END.
  rowResult=NEW JsonObject(). rowResult:Add("table",ENTRY(n,tableNames)). rowResult:Add("count",countRows). resultRows:Add(rowResult).
  q:QUERY-CLOSE(). DELETE OBJECT q. DELETE OBJECT h.
 END.
 finished=TRUE.
 CATCH failure AS Progress.Lang.Error:
  report:Add("error","Closed fixture inspection failed; no business write").
 END CATCH.
 FINALLY:
  IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
  IF VALID-HANDLE(h) THEN DELETE OBJECT h NO-ERROR.
 END FINALLY.
END.
report:Add("success",finished AND ETIME-started<=10000).
report:Add("container_id",2147000110). report:Add("phase",phaseName). report:Add("numDbs",NUM-DBS).
report:Add("rows",resultRows). report:Add("markerExact",masterOwned).
report:Add("businessWrites",FALSE). report:Add("triggersExecuted",FALSE).
report:Add("readRows",totalRows). report:Add("durationMs",ETIME-started).
report:WriteFile(outputName,TRUE).
QUIT.
'''
compile='''DEFINE VARIABLE i AS INTEGER NO-UNDO.
OUTPUT TO "compile.log".
PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS SKIP.
IF NUM-DBS<>0 THEN QUIT.
COMPILE FixtureInspector.p SAVE NO-ERROR.
PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.
DO i=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(i) SKIP. END.
IF NOT COMPILER:ERROR THEN PUT UNFORMATTED "PASS COMPILE" SKIP.
OUTPUT CLOSE.
QUIT.
'''
runner=f'''$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
if(Test-Path -LiteralPath compile.log){{throw 'Fresh stage required'}}
$env:DLC='C:/Progress_12/OE'
$p=Start-Process -FilePath 'C:/Progress_12/OE/bin/_progres.exe' -ArgumentList @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p') -PassThru -WindowStyle Hidden -RedirectStandardOutput compile-stdout.log -RedirectStandardError compile-stderr.log
if(!$p.WaitForExit(25000)){{throw 'Compile timeout'}}
$log=Get-Content -LiteralPath compile.log -Raw;Write-Output $log
if($p.ExitCode -ne 0 -or $log -notmatch 'OpenEdge 12[.]2' -or $log -notmatch 'NUMDBS=0' -or $log -notmatch 'ERROR=no' -or $log -notmatch 'PASS COMPILE'){{throw 'Compile proof rejected'}}
'''
for name,text in [('FixtureInspector.p',probe),('Compile.p',compile),('Compile.ps1',runner)]: (b/name).write_text(text)
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((b/n).relative_to(r)),remote=remote+'/'+n)for n in ['FixtureInspector.p','Compile.p','Compile.ps1']],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/Compile.ps1'],downloads=[dict(local=str((b/n).relative_to(r)),remote=remote+'/'+n)for n in ['compile.log','compile-stdout.log','compile-stderr.log','FixtureInspector.r']])
(b/'compile-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared fixed2147000110 count/marker inspection across13 literal tables; no writer; compile first')
