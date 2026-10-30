"""Prepare nine fresh closed RO guards using already official12.2 rcode. No SSH/RUN."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-completion-20261028'
base=state/'batch1042-fixture-inspector-v3'
official=state/'batch1042-fixture-inspector-v4'
output=state/'batch1042-exercise/inspections'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
proof=read(official/'official-compile-verification.json')
assert proof['success'] and proof['version']=='12.2' and proof['numDbs']==0
artifact=official/'FixtureInspector.r';assert sha(artifact)==proof['rcodeSha256']
config=state/'container-expense-batch-preflight/official-v1.1/compiled122/ExpenseBatch1042ReadOnlyPreflight.r'
assert config.is_file() and config.stat().st_size>0
steps=['create-header','create-A','create-B','batch-update','concurrent-B','stale-batch','batch-delete','cleanup-header','verify-cleanup']
files=[];plans=[]
for step in steps:
 phase='empty' if step=='create-header' else 'cleaned' if step=='verify-cleanup' else 'owned'
 oldlabel={'empty':'empty-before-create','owned':'owned-before-cleanup','cleaned':'cleaned-after-cleanup'}[phase]
 local=output/step;local.mkdir(parents=True,exist_ok=False)
 remote='C:/Users/tadeu.parreiras/codex-ciw-1042-guard-'+step
 template=(base/oldlabel/'Inspect.ps1').read_text(encoding='utf-8')
 template=template.replace('C:/Users/tadeu.parreiras/codex-ciw-1042-v3-'+oldlabel,remote).replace(oldlabel,step).replace(sha(base/'FixtureInspector.r').upper(),sha(artifact).upper())
 needle="$rows=@{};foreach($row in $proof.rows)"
 assert template.count(needle)==1
 template=template.replace(needle,"if(@($proof.PSObject.Properties.Name) -notcontains 'calcSnapshots' -or @($proof.calcSnapshots).Count -gt 4){throw 'V4 full calculation snapshots required'}\n"+needle)
 # Existing timestamped fixture receipt remains a separate witness. Capture
 # current configuration in another AVM, same fixed spec DB, never a writer.
 extra=f'''
if(Test-Path -LiteralPath 'config-started.json'){{throw 'Configuration attempt already exists; never overwrite'}}
$expectedConfigHash='{sha(config).upper()}'
if((Get-FileHash -Algorithm SHA256 -LiteralPath ExpenseBatch1042ReadOnlyPreflight.r).Hash -ne $expectedConfigHash){{throw 'Official configuration rcode mismatch'}}
$configStarted=[DateTimeOffset]::UtcNow.ToString('o')
[IO.File]::WriteAllText((Join-Path $PWD.Path 'config-started.json'),(@{{phase='config';label='{step}';startedAt=$configStarted;businessWrites=$false}}|ConvertTo-Json))
$ci=New-Object Diagnostics.ProcessStartInfo
$ci.FileName='C:/Progress_12/OE/bin/_progres.exe';$ci.WorkingDirectory=$PWD.Path
$ci.Arguments='-b -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -cpinternal UTF-8 -cpstream UTF-8 -p ExpenseBatch1042ReadOnlyPreflight.r'
$ci.UseShellExecute=$false;$ci.CreateNoWindow=$true;$ci.WindowStyle=[Diagnostics.ProcessWindowStyle]::Hidden
$ci.EnvironmentVariables['DLC']='C:/Progress_12/OE';$ci.RedirectStandardOutput=$true;$ci.RedirectStandardError=$true
$cfgProcess=New-Object Diagnostics.Process;$cfgProcess.StartInfo=$ci
if(!$cfgProcess.Start()){{throw 'Configuration process start failed'}}
$cfgOut=$cfgProcess.StandardOutput.ReadToEndAsync();$cfgErr=$cfgProcess.StandardError.ReadToEndAsync()
if(!$cfgProcess.WaitForExit(35000)){{throw 'Configuration timeout; inspect process/outcome; no replay'}}
$cfgProcess.WaitForExit();$cfgProcess.Refresh()
[Threading.Tasks.Task]::WaitAll([Threading.Tasks.Task[]]@($cfgOut,$cfgErr))
[IO.File]::WriteAllText((Join-Path $PWD.Path 'config-process.log'),$cfgOut.Result+$cfgErr.Result)
if($null -eq $cfgProcess.ExitCode -or $cfgProcess.ExitCode -ne 0){{throw 'Configuration process exit unconfirmed'}}
$cfgProof=Get-Content -LiteralPath expense-batch-preflight.json -Raw|ConvertFrom-Json
if($cfgProof.completed -ne $true -or $cfgProof.num_dbs -ne 1 -or $cfgProof.openedge -notlike '12.2*' -or $cfgProof.company_id -ne 2){{throw 'Current configuration capture incomplete'}}
$cfgReceipt=@{{success=$true;phase='config';label='{step}';container_id=2147000110;startedAt=$configStarted;completedAt=[DateTimeOffset]::UtcNow.ToString('o');artifactSha256=$expectedConfigHash.ToLower();resultSha256=(Get-FileHash -Algorithm SHA256 -LiteralPath expense-batch-preflight.json).Hash.ToLower();businessWrites=$false}}
[IO.File]::WriteAllText((Join-Path $PWD.Path 'config-receipt.json'),($cfgReceipt|ConvertTo-Json))
Write-Output 'PASS fixed1042 {step}: fresh12counts+fullcalcs and currentconfiguration receipts; no business writes'
'''
 template+=extra
 script=local/'InspectAndConfig.ps1';script.write_text(template,encoding='utf-8')
 plan={'server':'compiler','directories':[remote],'uploads':[{'local':str(p.relative_to(root)),'remote':remote+'/'+name}for p,name in [(artifact,'FixtureInspector.r'),(config,'ExpenseBatch1042ReadOnlyPreflight.r'),(script,'InspectAndConfig.ps1')]],'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/InspectAndConfig.ps1'],'downloads':[{'local':str((local/name).relative_to(root)),'remote':remote+'/'+name}for name in ['fixture-'+phase+'.json','inspection-receipt.json','process.log','expense-batch-preflight.json','config-receipt.json','config-process.log']]}
 pf=local/'remote-plan.json';pf.write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
 for f in [script,pf]:files.append({'path':str(f),'sha256':sha(f)})
 plans.append({'step':step,'phase':phase,'plan':str(pf),'sha256':sha(pf)})
manifest={'success':True,'status':'ROOT_REVIEW_REQUIRED_NO_EXECUTION','plans':plans,'files':files,'officialInspector':{'path':str(artifact),'sha256':sha(artifact)},'officialConfig':{'path':str(config),'sha256':sha(config)},'scope':'only fixedCID2147000110; each fresh stage once;12directcounts+full6fieldcalcs; metadata-only configuration; no ownership adoption','networkExecuted':False,'businessWrites':False}
file=output/'guard-manifest.json';file.write_text(json.dumps(manifest,indent=2)+'\n',encoding='utf-8');print(json.dumps({'success':True,'steps':len(plans),'manifestSha256':sha(file),'createHeaderReadonlyPlanSha256':plans[0]['sha256']}))
