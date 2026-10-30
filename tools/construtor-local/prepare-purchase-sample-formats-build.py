"""Prepare official12.2 isolated tests. No database or remote action on import."""
from pathlib import Path
import json,hashlib,sys,re
r=Path(__file__).resolve().parents[2];c=r/'integration-src/purchase-sample-formats';canonical=Path('D:/opencode/motor-progress/v2')
number=int(sys.argv[1]);red=len(sys.argv)>2 and sys.argv[2]=='red';s=r/f'.runtime/purchase-sample-formats-20261027/build{number}';package=s/'package';assert not s.exists();package.mkdir(parents=True)
names=['CiwCadastroCrudService.p','CiwCadastroDefinition.p','CiwCadastrosCrud.p']+([]if red else ['CiwCadastroCoreService.p','CiwCadastroSequenceIdentity.p'])
files={}
for n in names:files['sursum-api/programs/'+n]=(c/'abl'/n)if(c/'abl'/n).exists()else canonical/'sursum-api/programs'/n
for n in ['SampleFormatsCrudTest.p','SampleFormatsTestIdentity.p']:files[n]=c/'tests'/n
for n in ['CiwCadastroCrudTest.p','CiwCadastroDefinitionTest.p']:files[n]=(c/'tests'/n)if(c/'tests'/n).exists()else canonical/'tests/abl/ciw-cadastros'/n
for n in ['CiwCadastroCrudService.p','CiwCadastroDefinition.p']:files[n]=files['sursum-api/programs/'+n]
for n,src in files.items():p=package/n;p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes(src.read_bytes())
(package/'Regression.p').write_text("SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).\nRUN VALUE(ENTRY(2,SESSION:PARAMETER)).\nQUIT.\n",encoding='utf-8')
entries=[n for n in files if n.endswith('.p')]+['Regression.p']
(package/'Compile.p').write_text('''DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "'''+','.join(entries)+'''".
DEFINE VARIABLE k AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES(entries):
 COMPILE VALUE(ENTRY(k,entries)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(k,entries) ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END.
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
remote=f'C:/Users/tadeu.parreiras/codex-purchase-sample-formats-20261027-build{number}'
ps='''$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'REMOTE'
function Run-Avm([string[]]$Arguments,[string]$Log) {
 $info=New-Object Diagnostics.ProcessStartInfo
 $info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
 $info.Arguments=($Arguments|ForEach-Object {'"'+$_+'"'}) -join ' '
 $info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress_12/OE'
 $p=[Diagnostics.Process]::Start($info);$out=$p.StandardOutput.ReadToEndAsync();$err=$p.StandardError.ReadToEndAsync()
 if(!$p.WaitForExit(35000)){throw 'AVM timeout; inspect before retry'}
 [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $PSScriptRoot $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false))
 if($p.ExitCode -ne 0){throw 'AVM nonzero exit'};$p.Dispose()
}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'
$compile=Get-Content -LiteralPath 'compile.log' -Raw
if($compile -notmatch 'OpenEdge 12[.]2' -or $compile -notmatch 'PASS COMPILE ALL' -or $compile -match 'COMPILER:ERROR=(yes|true)'){throw 'Compile unconfirmed'}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','SampleFormatsCrudTest.r','-T',$PWD.Path) ('test-'+$cp+'-'+$culture+'-process.log')
 Copy-Item -LiteralPath ('formats-tests-'+$culture+'.log') -Destination ('formats-tests-'+$cp+'-'+$culture+'.log')
 foreach($suite in @(@{name='CiwCadastroCrudTest.p';prefix='ciw-cadastro-tests-';suffix=$culture},@{name='CiwCadastroDefinitionTest.p';prefix='ciw-cadastro-definition-';suffix=$cp})){
  Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+','+$suite.name),'-p','Regression.p','-T',$PWD.Path) ('regression-'+$suite.name+'-'+$cp+'-'+$culture+'-process.log')
  Copy-Item -LiteralPath ($suite.prefix+$suite.suffix+'.log') -Destination ($suite.prefix+$cp+'-'+$culture+'.log')
 }
}}
Write-Output 'Official12.2 package executed; inspect all compile and assertion logs'
'''.replace('REMOTE',remote)
(package/'compile122.ps1').write_text('try {\n'+ps+'\n} catch { Write-Output $_.Exception.Message; exit 1 }\n',encoding='utf-8')
downloads=['compile.log','compile-process.log']+[n[:-2]+'.r' for n in entries]+[prefix+cp+'-'+culture+'.log' for prefix in ['formats-tests-','ciw-cadastro-tests-','ciw-cadastro-definition-']for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN']]
dirs=[remote]+[remote+'/'+p.relative_to(package).as_posix()for p in sorted(package.rglob('*'))if p.is_dir()]
uploads=[dict(local=str(p.relative_to(r)),remote=remote+'/'+p.relative_to(package).as_posix())for p in package.rglob('*')if p.is_file()]
plan=dict(server='compiler',directories=dirs,uploads=uploads,commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((s/'compiled122'/n).relative_to(r)),remote=remote+'/'+n,optional=True)for n in downloads])
(s/'remote-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8');(s/'source-manifest.json').write_text(json.dumps([dict(file=u['local'],sha256=hashlib.sha256((r/u['local']).read_bytes()).hexdigest())for u in uploads],indent=2),encoding='utf-8')
print('Prepared fresh official build',number,'RED'if red else 'candidate',len(entries),'entries; no execution')
