"""Private read-only reproduction against fixed physical tables; never publish."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/history-diagnostic1';b.mkdir()
remote='C:/Users/tadeu.parreiras/codex-ciw-history-diagnostic-20261028'
official='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build3'
files=[]
for name in ['ContainersVersionHistoryApi.p','ContainersVersionHistoryService.p']:
 source=(r/'.runtime/ciw-completion-20261028/official-build3/package/sursum-api/programs'/name).read_text()
 anchor=' CATCH e AS Progress.Lang.Error:\n'
 assert source.count(anchor)==1
 source=source.replace(anchor,anchor+'''  OUTPUT TO "diagnostic-errors.log" APPEND.
  DO diagnosticIndex=1 TO e:NumMessages: PUT UNFORMATTED e:GetMessage(diagnosticIndex) SKIP. END.
  PUT UNFORMATTED e:CallStack SKIP. OUTPUT CLOSE.
''').replace('DO ON ERROR UNDO, THROW:', 'DEFINE VARIABLE diagnosticIndex AS INTEGER NO-UNDO.\nDO ON ERROR UNDO, THROW:',1)
 p=b/name;p.write_text(source);files.append(p)
version=json.loads((r/'.runtime/ciw-completion-20261028/official-build3/parent-rows-private.json').read_text())['versions']['data'][0]['versao_id']
runner='''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE requestValue AS JsonObject NO-UNDO.
DEFINE VARIABLE responseValue AS JsonObject NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE entryValue AS CHARACTER NO-UNDO.
PROPATH="REMOTE,REMOTE/sursum-api/programs,OFFICIAL,OFFICIAL/sursum-api/includes," + PROPATH.
OUTPUT TO "diagnostic-compile.log".
DO n=1 TO 2:
 entryValue=ENTRY(n,"sursum-api/programs/ContainersVersionHistoryService.p,sursum-api/programs/ContainersVersionHistoryApi.p").
 COMPILE VALUE(entryValue) SAVE NO-ERROR.
 PUT UNFORMATTED entryValue " error=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO: DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END. OUTPUT CLOSE. QUIT. END.
END.
OUTPUT CLOSE.
requestValue=NEW JsonObject(). requestValue:Add("resource","container_versoes_historico_med"). requestValue:Add("operation","read"). requestValue:Add("container_id",332526). requestValue:Add("versao_id",VERSION). requestValue:Add("take",1).
RUN sursum-api/programs/ContainersVersionHistoryApi.p(requestValue,OUTPUT responseValue).
responseValue:WriteFile("diagnostic-response.json",TRUE).
OUTPUT TO "diagnostic-pass.log". PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS " read-only reproduced" SKIP. OUTPUT CLOSE.
QUIT.
'''.replace('REMOTE',remote).replace('OFFICIAL',official).replace('VERSION',str(version))
# Replacing VERSION must not change PROVERSION.
runner=runner.replace('PRO'+str(version),'PROVERSION')
(b/'Run.p').write_text(runner);files.append(b/'Run.p')
ps='''$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'REMOTE'
$env:DLC='C:/Progress_12/OE'
& C:/Progress_12/OE/bin/_progres.exe -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p Run.p *> diagnostic-process.log
if(!(Test-Path -LiteralPath diagnostic-pass.log)){Get-Content diagnostic-process.log -Raw;Get-Content diagnostic-compile.log -Raw;throw 'Diagnostic incomplete'}
Get-Content diagnostic-pass.log -Raw
'''.replace('REMOTE',remote)
(b/'run.ps1').write_text(ps);files.append(b/'run.ps1')
uploads=[dict(local=str(p.relative_to(r)),remote=remote+('/sursum-api/programs/' if p.name.startswith('Containers') else '/')+p.name)for p in files]
plan=dict(server='compiler',directories=[remote,remote+'/sursum-api',remote+'/sursum-api/programs'],uploads=uploads,commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/run.ps1'],downloads=[dict(local=str((b/n).relative_to(r)),remote=remote+'/'+n,optional=True)for n in ['diagnostic-errors.log','diagnostic-compile.log','diagnostic-response.json','diagnostic-pass.log','diagnostic-process.log']])
(b/'plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared fixed readonly physical reproduction; no shared/runtime writes')
