"""Private TT replay only, one compilation; consumes pinned official6 r-code."""
from pathlib import Path
import json,hashlib,shutil
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build6-v2';OLD=S/'container-expense-batch-preflight/replay-actual-config';O=S/'container-expense-batch-preflight/replay-after6-v1';P=O/'package'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert not O.exists(),'Immutable replay already exists'
manifest=load(B/'build-manifest.json');deps=[];baseRemote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build6-v2';remote='C:/Users/tadeu.parreiras/codex-ciw-1042-replay-after6-v1'
for name in manifest['compileEntries']:
 r=Path(name).with_suffix('.r');p=B/'compiled122'/r;assert p.exists(),str(p);deps.append({'path':r.as_posix(),'remote':baseRemote+'/'+r.as_posix(),'sha256':sha(p),'local':str(p.relative_to(R))})
P.mkdir(parents=True);source=(OLD/'local/Replay.p').read_text(encoding='utf-8-sig');assert source.count('RUN ContainersDespesasCrudService.p(')==1;source=source.replace('RUN ContainersDespesasCrudService.p(','RUN ContainersDespesasCrudService.r(',1);(P/'Replay.p').write_text(source,encoding='utf-8')
shutil.copyfile(OLD/'local/captured-config.json',P/'captured-config.json')
propath=remote+','+baseRemote+','+baseRemote+'/sursum-api/programs,'+baseRemote+'/sursum-api/includes,'
(P/'Compile.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH="'''+propath+'''" + PROPATH.
OUTPUT TO 'compile.log'. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
IF NOT PROVERSION BEGINS '12.2' OR NUM-DBS<>0 THEN DO: PUT UNFORMATTED 'FAIL runtime gate' SKIP. OUTPUT CLOSE. QUIT. END.
COMPILE Replay.p SAVE NO-ERROR.
PUT UNFORMATTED 'Replay.p COMPILER:ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN DO:
 DEFINE VARIABLE n AS INTEGER NO-UNDO.
 DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END.
 PUT UNFORMATTED 'FAIL COMPILE' SKIP. OUTPUT CLOSE. QUIT.
END.
PUT UNFORMATTED 'PASS COMPILE ONE TT NUM-DBS=' NUM-DBS SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
(P/'Execute.p').write_text('''BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH="'''+propath+'''" + PROPATH.
IF NOT PROVERSION BEGINS '12.2' OR NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Private TT runtime gate',1).
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN Replay.r.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Private TT connection changed',1).
OUTPUT TO 'execution.log'. PUT UNFORMATTED 'PASS EXECUTE OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP. OUTPUT CLOSE. QUIT.
''',encoding='utf-8')
ps=(B/'package/compile122.ps1').read_text(encoding='utf-8').split("$netLibrary=@(")[0].replace(baseRemote,remote)
ps+="Run-Avm @('-b','-cpinternal','UTF-8','-cpstream','UTF-8','-p','Compile.p','-T',$PWD.Path) 'compile-process.log'\n$proof=Get-Content compile.log -Raw;if($proof -notmatch 'PASS COMPILE ONE TT NUM-DBS=0' -or $proof -match 'FAIL'){throw 'TT compile failed'}\nforeach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',$culture,'-p','Execute.p','-T',$PWD.Path) ('process-'+$cp+'-'+$culture+'.log')\n$proof=Get-Content ('replay-'+$culture+'.log') -Raw;if($proof -notmatch 'PASS 150 checks NUMDBS=0' -or $proof -match 'FAIL'){throw 'TT150 failed'}\nCopy-Item ('replay-'+$culture+'.log') ('replay-'+$cp+'-'+$culture+'.log')\nCopy-Item ('replay-result-'+$culture+'.json') ('result-'+$cp+'-'+$culture+'.json')\nCopy-Item 'execution.log' ('execution-'+$cp+'-'+$culture+'.log')\n}}\nWrite-Output 'Private1042 replay150x4 done; no business connection'\n}catch{Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log};exit 1}\n"
(P/'replay122.ps1').write_text(ps,encoding='utf-8')
uploads=[{'local':str(p.relative_to(R)),'remote':remote+'/'+p.name} for p in sorted(P.iterdir())]
names=['compile.log','compile-process.log','Replay.r']+[prefix+cp+'-'+culture+ext for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN'] for prefix,ext in [('replay-','.log'),('execution-','.log'),('process-','.log'),('result-','.json')]]
plan={'server':'compiler','directories':[remote],'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/replay122.ps1'],'downloads':[{'local':str((O/'compiled122'/n).relative_to(R)),'remote':remote+'/'+n,'optional':True} for n in names]}
(O/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
proof={'status':'PREPARED_PRIVATE_TT_NOT_EXECUTED','oneCompile':'Replay.p','databaseConnections':0,'productionExecution':False,'productionRcodeReusedFromOfficial6':deps,'sourceInputs':[{'file':u['local'],'sha256':sha(R/u['local'])} for u in uploads],'expectedChecksPerCombination':150,'combinations':4,'capturedConfigurationSha256':sha(P/'captured-config.json'),'remotePlanSha256':sha(O/'remote-plan.json'),'canonicalWrites':False,'publicationAllowed':False,'gate':'Root must verify official6 compile proof and all dependency .r hashes before this private run; never deploy Replay/config to PASOE'}
(O/'manifest.json').write_text(json.dumps(proof,indent=2)+'\n');print(json.dumps({'success':True,'sourceFiles':len(uploads),'dependencies':len(deps),'manifestSha256':sha(O/'manifest.json'),'planSha256':sha(O/'remote-plan.json')}))
