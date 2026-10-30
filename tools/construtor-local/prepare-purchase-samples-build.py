"""Build a bounded official12.2 package; no SSH or business writes on import."""
from pathlib import Path
import hashlib
import json
import sys

root = Path(__file__).resolve().parents[2]
build_number = int(sys.argv[1]) if len(sys.argv)>1 else 1
assert 1 <= build_number <= 30
base = root / ('.runtime/purchase-samples-20261022/build' + str(build_number))
package = base / 'package'
assert not base.exists(), 'Fresh build directory required'
package.mkdir(parents=True)
candidate = root / 'integration-src/purchase-samples'
canonical = Path('D:/opencode/motor-progress/v2')
files = {}
for name in ['PurchaseSamplesApi.p', 'PurchaseSamplesService.p', 'CiwCadastrosCrud.p', 'CiwErpReadService.p']:
    files['sursum-api/programs/' + name] = candidate / 'abl' / name
files['sursum-api/includes/PurchaseSampleSnapshot.i'] = candidate / 'abl/PurchaseSampleSnapshot.i'
for name in ['PurchaseItemSnapshot.i', 'PurchaseOrderSnapshot.i', 'PurchaseItemValueRules.i', 'PurchaseItemsReadBuffer.i']:
    files['sursum-api/includes/' + name] = canonical / 'sursum-api/includes' / name
files['PurchaseSamplesTest.p'] = candidate / 'tests/PurchaseSamplesTest.p'
files['CiwMedCompanyContext.p'] = canonical / 'sursum-api/programs/CiwMedCompanyContext.p'
files['PurchaseItemsReadTest.p'] = canonical / 'tests/abl/purchase-items/PurchaseItemsReadTest.p'
files['CiwErpReadTest.p'] = canonical / 'tests/abl/ciw-erp-consultas/CiwErpReadTest.p'
for name, source in files.items():
    target = package / name
    target.parent.mkdir(parents=True, exist_ok=True)
    target.write_bytes(source.read_bytes())
(package / 'CiwErpReadService.p').write_text('''USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER h AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER resourceValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER companyValue AS CHARACTER NO-UNDO.
DEFINE INPUT PARAMETER requestValue AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER responseValue AS JsonObject NO-UNDO.
RUN sursum-api/programs/CiwErpReadService.p(h,resourceValue,companyValue,requestValue,OUTPUT responseValue).
''', encoding='utf-8')
(package / 'RunSampleRegression.p').write_text('''SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).
IF LOOKUP(ENTRY(2,SESSION:PARAMETER),'CiwErpReadTest.p,PurchaseItemsReadTest.p')=0 THEN QUIT.
RUN VALUE(ENTRY(2,SESSION:PARAMETER)).
QUIT.
''', encoding='utf-8')
compile_source = '''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "sursum-api/programs/PurchaseSamplesService.p,sursum-api/programs/PurchaseSamplesApi.p,sursum-api/programs/CiwErpReadService.p,sursum-api/programs/CiwCadastrosCrud.p,PurchaseSamplesTest.p,CiwMedCompanyContext.p,CiwErpReadService.p,CiwErpReadTest.p,PurchaseItemsReadTest.p,RunSampleRegression.p".
DEFINE VARIABLE nameValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE k AS INTEGER NO-UNDO.
OUTPUT TO 'compile.log'.
PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
DO k=1 TO NUM-ENTRIES(entries):
 nameValue=ENTRY(k,entries). COMPILE VALUE(nameValue) SAVE NO-ERROR.
 PUT UNFORMATTED nameValue ' COMPILER:ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR THEN DO: DO k=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(k) SKIP. END. OUTPUT CLOSE. QUIT. END.
END.
PUT UNFORMATTED 'PASS COMPILE ALL' SKIP. OUTPUT CLOSE. QUIT.
'''
(package / 'CompileSamples.p').write_text(compile_source, encoding='utf-8')
remote = 'C:/Users/tadeu.parreiras/codex-purchase-samples-20261022-build' + str(build_number)
ps = f'''$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
function Run-Avm([string[]]$Arguments,[string]$Log) {{
 $info=New-Object Diagnostics.ProcessStartInfo
 $info.FileName='C:/Progress_12/OE/bin/_progres.exe';$info.WorkingDirectory=$PWD.Path
 $info.Arguments=($Arguments|ForEach-Object {{'"'+$_+'"'}}) -join ' '
 $info.UseShellExecute=$false;$info.CreateNoWindow=$true;$info.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
 $info.RedirectStandardOutput=$true;$info.RedirectStandardError=$true;$info.EnvironmentVariables['DLC']='C:/Progress_12/OE'
 $process=[Diagnostics.Process]::Start($info);$out=$process.StandardOutput.ReadToEndAsync();$err=$process.StandardError.ReadToEndAsync()
 if(!$process.WaitForExit(35000)){{throw 'AVM timeout; inspect before retry'}}
 [Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($out,$err))
 [IO.File]::WriteAllText((Join-Path $PSScriptRoot $Log),$out.Result+$err.Result,[Text.UTF8Encoding]::new($false))
 if($process.ExitCode -ne 0){{throw 'AVM nonzero exit'}};$process.Dispose()
}}
Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','CompileSamples.p','-T',$PWD.Path) 'compile-process.log'
$compile=Get-Content -LiteralPath 'compile.log' -Raw
if($compile -notmatch 'OpenEdge 12[.]2' -or $compile -notmatch 'PASS COMPILE ALL' -or $compile -match 'COMPILER:ERROR=(yes|true)'){{throw 'Compile unconfirmed'}}
foreach($cp in @('UTF-8','ISO8859-1')){{foreach($culture in @('AMERICAN','EUROPEAN')){{
 $testFile='samples-tests-'+$culture+'.log'
 if(Test-Path -LiteralPath $testFile){{Remove-Item -LiteralPath $testFile}}
 Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','PurchaseSamplesTest.r','-T',$PWD.Path) ('tests-'+$cp+'-'+$culture+'-process.log')
 $test=Get-Content -LiteralPath ('samples-tests-'+$culture+'.log') -Raw
 if($test -notmatch 'PASS samples checks=' -or $test -match 'FAIL'){{throw 'Test suite unconfirmed'}}
 Copy-Item -LiteralPath ('samples-tests-'+$culture+'.log') -Destination ('samples-tests-'+$cp+'-'+$culture+'.log')
 foreach($suite in @(@{{name='CiwErpReadTest.p';prefix='erp-read-';checks=47}},@{{name='PurchaseItemsReadTest.p';prefix='purchase-item-read-';checks=9}})){{
  $file=$suite.prefix+$culture+'.log'
  if(Test-Path -LiteralPath $file){{Remove-Item -LiteralPath $file}}
  Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+','+$suite.name),'-p','RunSampleRegression.p','-T',$PWD.Path) ('regression-'+$suite.name+'-'+$cp+'-'+$culture+'-process.log')
  $body=Get-Content -LiteralPath $file -Raw
  if($body -notmatch ('PASS '+$suite.checks+' checks '+$culture) -or $body -match 'FAIL'){{throw 'Existing reader regression unconfirmed'}}
  Copy-Item -LiteralPath $file -Destination ($suite.prefix+$cp+'-'+$culture+'.log')
 }}
}}
}}
Write-Output 'PASS official12.2 build and four isolated test combinations'
'''
ps = "try {\n" + ps + "\n[IO.File]::WriteAllText((Join-Path $PSScriptRoot 'build-status.json'),'{\"success\":true}',[Text.UTF8Encoding]::new($false))\n} catch { Write-Output $_.Exception.Message; [IO.File]::WriteAllText((Join-Path $PSScriptRoot 'build-status.json'),'{\"success\":false}',[Text.UTF8Encoding]::new($false)); exit 0 }\n"
(package / 'compile122.ps1').write_text(ps, encoding='utf-8')
all_sources = sorted(package.rglob('*'))
uploads = [{'local': str(file.relative_to(root)), 'remote': remote + '/' + file.relative_to(package).as_posix()} for file in all_sources if file.is_file()]
directories = [remote, remote + '/sursum-api', remote + '/sursum-api/includes', remote + '/sursum-api/programs']
downloads = ['compile.log', 'compile-process.log', 'build-status.json']
downloads += ['samples-tests-' + culture + '.log' for culture in ['AMERICAN', 'EUROPEAN']]
downloads += ['tests-' + cp + '-' + culture + '-process.log' for cp in ['UTF-8', 'ISO8859-1'] for culture in ['AMERICAN', 'EUROPEAN']]
downloads += [name.replace('.p', '.r') for name in files if name.endswith('.p')]
downloads += ['samples-tests-' + cp + '-' + culture + '.log' for cp in ['UTF-8', 'ISO8859-1'] for culture in ['AMERICAN', 'EUROPEAN']]
downloads += [prefix + cp + '-' + culture + '.log' for prefix in ['erp-read-', 'purchase-item-read-'] for cp in ['UTF-8', 'ISO8859-1'] for culture in ['AMERICAN', 'EUROPEAN']]
plan = {'server': 'compiler', 'directories': directories, 'uploads': uploads,
        'commands': ['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File ' + remote + '/compile122.ps1'],
        'downloads': [{'local': str((base / 'compiled122' / name).relative_to(root)), 'remote': remote + '/' + name, 'optional': name not in ['compile.log','compile-process.log','build-status.json']} for name in downloads]}
(base / 'remote-plan.json').write_text(json.dumps(plan, indent=2), encoding='utf-8')
(base / 'source-manifest.json').write_text(json.dumps({'files': [{'file': x['local'], 'sha256': hashlib.sha256((root / x['local']).read_bytes()).hexdigest()} for x in uploads]}, indent=2), encoding='utf-8')
print('Prepared isolated official12.2 build' + str(build_number) + '; no execution or business writes; success requires compile/test logs and build-status')
