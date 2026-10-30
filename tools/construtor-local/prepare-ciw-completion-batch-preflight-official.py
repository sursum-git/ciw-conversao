"""Prepare one closed configuration/dictionary read probe on official compiler; never publish."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight';f=s/'frozen-v1.1';b=s/'official-v1.1';b.mkdir();pkg=b/'package';pkg.mkdir()
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
review=load(s/'manager-review-v1.1.json');assert review['success'] and sha(f/'manifest.json')==review['manifestSha256']=='782caca750d07b52883db663d2bfe627005be99d6d1cb6ab8891f70708943e5d'
m=load(f/'manifest.json')
for x in m['files']:assert sha(f/x['path'])==x['sha256']
for x in m['dependencies']:assert sha(Path(x['path']))==x['sha256']
name='ExpenseBatch1042ReadOnlyPreflight';shutil.copyfile(f/f'abl/{name}.p',pkg/(name+'.p'));inc=pkg/'sursum-api/includes/parametros_ima.i';inc.parent.mkdir(parents=True);shutil.copyfile(Path(m['dependencies'][0]['path']),inc)
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-batch-preflight-v1-1'
compile='''BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH="REMOTE," + PROPATH.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
IF NOT PROVERSION BEGINS '12.2' OR NUM-DBS<>1 THEN DO: PUT UNFORMATTED 'FAIL VERSION/CONNECTION' SKIP. OUTPUT CLOSE. QUIT. END.
COMPILE ExpenseBatch1042ReadOnlyPreflight.p SAVE NO-ERROR.
PUT UNFORMATTED 'ExpenseBatch1042ReadOnlyPreflight.p COMPILER:ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO:
 DEFINE VARIABLE n AS INTEGER NO-UNDO. DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END.
 PUT UNFORMATTED 'FAIL COMPILE' SKIP.
END. ELSE PUT UNFORMATTED 'PASS COMPILE ALL' SKIP.
OUTPUT CLOSE. QUIT.
'''.replace('REMOTE',remote)
(pkg/'Compile.p').write_text(compile)
base=(r/'.runtime/ciw-completion-20261028/official-build5-v6/package/compile122.ps1').read_text()
prefix=base[:base.index('$netLibrary=@')].replace('codex-ciw-completion-20261028-build5-v6',Path(remote).name)
tail='''$netLibrary=''
Run-Avm @('-b','-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'
$proof=Get-Content -LiteralPath compile.log -Raw
if($proof -notmatch 'OpenEdge 12[.]2' -or $proof -notmatch 'COMPILER:ERROR=no' -or $proof -notmatch 'PASS COMPILE ALL' -or $proof -match 'FAIL'){throw 'Compilation unconfirmed'}
Run-Avm @('-b','-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec','-cpinternal','UTF-8','-cpstream','UTF-8','-p','ExpenseBatch1042ReadOnlyPreflight.r','-T',$PWD.Path) 'probe-process.log'
Write-Output 'Official12.2 config probe completed; inspect private report; no business rows/writer/trigger executed'
} catch {Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}
'''
(pkg/'compile122.ps1').write_text(prefix+tail)
files=list(pkg.rglob('*'));files=[p for p in files if p.is_file()]
manifest=dict(success=True,files=[dict(path=str(p.relative_to(r)),sha256=sha(p))for p in files],compileEntries=1,configurationOnly=True,codeReadOnlyNoLock=True,connectionReadOnlyRoleEnforced=False,includesUnchanged=True,neverPublish=True,businessWrites=False)
(b/'build-manifest.json').write_text(json.dumps(manifest,indent=2)+'\n')
dirs=[remote,remote+'/sursum-api',remote+'/sursum-api/includes']
plan=dict(server='compiler',directories=dirs,uploads=[dict(local=str(p.relative_to(r)),remote=remote+'/'+str(p.relative_to(pkg)).replace('\\','/'))for p in files],commands=['powershell -NoProfile -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],downloads=[dict(local=str((b/'compiled122'/name).relative_to(r)),remote=remote+'/'+name)for name in ['compile.log','compile-process.log','probe-process.log','expense-batch-preflight.json','ExpenseBatch1042ReadOnlyPreflight.r']])
(b/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared bounded config/dictionary probe: official12.2 compile1, separate read-only-by-code execution; never publish')
