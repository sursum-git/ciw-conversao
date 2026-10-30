"""Freeze official12.2 delta: missing-parent handling only; no connection."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];old=r/'.runtime/ciw-completion-20261028/official-build3';b=r/'.runtime/ciw-completion-20261028/official-build4';assert not b.exists();p=b/'package';(p/'sursum-api/programs').mkdir(parents=True);(p/'sursum-api/includes').mkdir()
f=r/'integration-src/ciw-completion-20261028/container-version-history/frozen-v1.4';sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert sha(f/'manifest.json')=='c45c4a17a4b44266a3fb663f81bafd7520d574dfb12322e3b2b7ac8345ff4b91'
for x in load(f/'manifest.json')['files']:assert sha(f/x['path'])==x['sha256']
service=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionHistoryService.p');assert sha(service)=='32e81cdfa54c1494d573a83fb9977302fc9da6720b8bf7a8a638e7fff4a05a19'
assert load(r/'.runtime/ciw-completion-20261028/container-version-history/manager-review-final-v1.4.json')['remainingP1P2']==[]
for source,dest in [(f/'abl/ContainersVersionHistoryService.p',p/'sursum-api/programs/ContainersVersionHistoryService.p'),(f/'includes/ContainersVersionHistoryTable.i',p/'sursum-api/includes/ContainersVersionHistoryTable.i'),(f/'tests/abl/ContainersVersionHistoryTest.p',p/'ContainersVersionHistoryTest.p'),(f/'tests/abl/ContainersVersionHistoryTestTables.i',p/'ContainersVersionHistoryTestTables.i')]:shutil.copyfile(source,dest)
for name in ['ContainersVersionService.r','CiwErpReadService.r']:
 source=old/'compiled122/sursum-api/programs'/name;shutil.copyfile(source,p/'sursum-api/programs'/name)
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build4'
propath=remote+','+remote+'/sursum-api/includes,'+remote+'/sursum-api/programs,'
(p/'Compile.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE entries AS CHARACTER NO-UNDO INITIAL "sursum-api/programs/ContainersVersionHistoryService.p,ContainersVersionHistoryTest.p".
PROPATH="PROPATH_VALUE" + PROPATH.
OUTPUT TO "compile.log". PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS SKIP.
IF NUM-DBS<>0 THEN DO: PUT UNFORMATTED "FAIL DB" SKIP. OUTPUT CLOSE. QUIT. END.
DO n=1 TO 2:
 COMPILE VALUE(ENTRY(n,entries)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(n,entries) " COMPILER:ERROR=" COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. PUT UNFORMATTED "FAIL COMPILE" SKIP. OUTPUT CLOSE. QUIT. END.
END. PUT UNFORMATTED "PASS COMPILE ALL" SKIP. OUTPUT CLOSE. QUIT.
'''.replace('PROPATH_VALUE',propath))
(p/'Regression.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH="PROPATH_VALUE" + PROPATH.
IF NUM-DBS<>0 THEN UNDO,THROW NEW Progress.Lang.AppError("DB forbidden",1).
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN ContainersVersionHistoryTest.p.
QUIT.
'''.replace('PROPATH_VALUE',propath))
oldps=(old/'package/compile122.ps1').read_text();prefix=oldps[:oldps.index("Run-Avm @('-b'")].replace('codex-ciw-completion-20261028-build3','codex-ciw-completion-20261028-build4')
ps=prefix+'''Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'
$log=Get-Content -LiteralPath compile.log -Raw
if($log -notmatch 'OpenEdge 12[.]2 NUMDBS=0' -or $log -notmatch 'PASS COMPILE ALL' -or $log -match 'FAIL'){throw 'Compile unconfirmed'}
foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){
Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','Regression.p','-T',$PWD.Path) ('process-'+$cp+'-'+$culture+'.log')
$proof=Get-Content -LiteralPath container-version-history-tests.log -Raw
if($proof -notmatch 'PASS 32 NUMDBS=0' -or $proof -match 'FAIL'){throw 'History regression failed'}
Copy-Item -LiteralPath container-version-history-tests.log -Destination ('history-'+$cp+'-'+$culture+'.log')
}}
Write-Output 'Official12.2 parent404 delta complete; inspect2compiles/4logs'
}catch{Write-Output $_.Exception.Message;exit1}
'''.replace('exit1','exit 1');(p/'compile122.ps1').write_text(ps)
files=[dict(file=str(x.relative_to(r)),relative=str(x.relative_to(p)).replace('\\','/'),sha256=sha(x))for x in p.rglob('*')if x.is_file()]
manifest=dict(success=True,state='PREPARED_NOT_EXECUTED',baselineServiceSha256=sha(service),candidateServiceSha256=sha(f/'abl/ContainersVersionHistoryService.p'),files=files,checksPerCombination=32,combinations=4,productionDelta=['sursum-api/programs/ContainersVersionHistoryService.p','sursum-api/programs/ContainersVersionHistoryService.r'],abiChanged=False)
(b/'build-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n')
downloads=['compile.log','compile-process.log','sursum-api/programs/ContainersVersionHistoryService.r']+[f'history-{cp}-{culture}.log'for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN']]
plan=dict(server='compiler',directories=[remote,remote+'/sursum-api',remote+'/sursum-api/programs',remote+'/sursum-api/includes'],uploads=[dict(local=x['file'],remote=remote+'/'+x['relative'])for x in files],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((b/'compiled122'/n).relative_to(r)),remote=remote+'/'+n)for n in downloads]);(b/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('PASS prepared officialbuild4:2compiles,32checksx4,2production artifacts,ABI unchanged')
