"""Extract two exact functions into a synthetic no-DB official12.2 diagnostic."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/nf-keybytes-diagnostic-v3';assert not B.exists();B.mkdir()
source=R/'.runtime/ciw-completion-20261028/official-build10/package/sursum-api/programs/ContainersPainelFinanceReadService.p'
assert hashlib.sha256(source.read_bytes()).hexdigest()=='d7990991fd7e1d7675927c8cc4a0ecde7a4ffa8e2368e08b04b3f8361d1d238a'
text=source.read_text();functions=[]
for name in ['ValidKey','NfKeyBytes']:
 start=text.index('FUNCTION '+name+' ');end=text.index('END FUNCTION.',start)+len('END FUNCTION.');functions.append(text[start:end])
assert functions[1].count('HEX-ENCODE(GET-BYTES(bytesValue,1,67))')==1
functions[1]=functions[1].replace('HEX-ENCODE(GET-BYTES(bytesValue,1,67))','SUBSTRING(HEX-ENCODE(bytesValue),1,134)')
probe='''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE cResource AS CHARACTER NO-UNDO INITIAL "nfs-disponiveis".
DEFINE VARIABLE value1 AS CHARACTER NO-UNDO.
DEFINE VARIABLE value2 AS CHARACTER NO-UNDO.
DEFINE VARIABLE report AS JsonObject NO-UNDO.
DEFINE VARIABLE errors AS JsonArray NO-UNDO.
DEFINE VARIABLE detail AS JsonObject NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
'''+ '\n'.join(functions)+'''
report=NEW JsonObject(). errors=NEW JsonArray().
report:Add('openEdge',PROVERSION).
report:Add('numDbs',NUM-DBS).
IF NOT PROVERSION BEGINS '12.2' OR NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Environment invalid',1).
DO ON ERROR UNDO, THROW:
 value1=NfKeyBytes('nf_' + FILL('A',64)).
 value2=NfKeyBytes('nf_' + FILL('A',64)).
 report:Add('completed',TRUE).
 report:Add('first',value1).
 report:Add('second',value2).
 report:Add('equal',value1=value2).
 CATCH errorValue AS Progress.Lang.Error:
  report:Add('completed',FALSE).
  DO n=1 TO errorValue:NumMessages:
   detail=NEW JsonObject().
   detail:Add('number',errorValue:GetMessageNum(n)).
   detail:Add('message',errorValue:GetMessage(n)).
   errors:Add(detail).
  END.
 END CATCH.
END.
report:Add('errors',errors).
report:Add('businessReads',FALSE).
report:Add('businessWrites',FALSE).
report:WriteFile('diagnostic.json',TRUE).
QUIT.
'''
(B/'KeyByteProbe.p').write_text(probe)
(B/'CompileAndRun.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'.
PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
COMPILE 'KeyByteProbe.p' SAVE NO-ERROR.
PUT UNFORMATTED 'ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN DO:
 DO n=1 TO ERROR-STATUS:NUM-MESSAGES:
  PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP.
 END.
 OUTPUT CLOSE.
 QUIT.
END.
PUT UNFORMATTED 'PASS COMPILE' SKIP.
OUTPUT CLOSE.
RUN 'KeyByteProbe.r'.
QUIT.
''')
stage='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-keybyte-diagnostic-v3'
(B/'Run.ps1').write_text("$ErrorActionPreference='Stop'\nSet-Location -LiteralPath '"+stage+"'\nif(Test-Path -LiteralPath 'compile.log'){throw 'Fresh stage required'}\n$info=New-Object Diagnostics.ProcessStartInfo\n$info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path;$info.Arguments='-b -cpinternal UTF-8 -cpstream UTF-8 -p CompileAndRun.p'\n$info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress_12/OE'\n$process=[Diagnostics.Process]::Start($info);$out=$process.StandardOutput.ReadToEndAsync();$err=$process.StandardError.ReadToEndAsync();if(!$process.WaitForExit(20000)){throw 'Diagnostic timeout'}\n[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err));[IO.File]::WriteAllText((Join-Path $PWD.Path 'process.log'),$out.Result+$err.Result);if($process.ExitCode -ne 0){throw 'Diagnostic AVM failed'}\n")
plan=dict(server='compiler',directories=[stage],uploads=[dict(local=str((B/n).relative_to(R)),remote=stage+'/'+n) for n in ['KeyByteProbe.p','CompileAndRun.p','Run.ps1']],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+stage+'/Run.ps1'],downloads=[dict(local=str((B/n).relative_to(R)),remote=stage+'/'+n,optional=True) for n in ['compile.log','process.log','diagnostic.json']])
(B/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n');print('Prepared exact functions, synthetic ASCII only, NUMDBS0; no business programs')
