"""Directory-only transport recovery; immutable official13 product plan is preserved."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parents[2]
base=root/'.runtime/ciw-completion-20261028/official-build13-v2'
out=root/'.runtime/ciw-completion-20261028/official-build13-transport-companion'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(base/'manager-release.json')=='b17b8fb9a84945021d470f08fbef39c978fbadaa0078b37bddbb158fb2ad69be'
assert sha(base/'remote-plan.json')=='4f0e967513cf01c23cccc498310efcd316dd3df5bc718a39995fd595eec90675'
assert not out.exists();out.mkdir()
plan=json.loads((base/'remote-plan.json').read_bytes())
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-v2'
assert plan['directories'][0]==remote
directories=[remote,remote+'/sursum-api',remote+'/sursum-api/includes',remote+'/sursum-api/programs',remote+'/sursum-api/sursum']
assert directories[:1]+directories[2:]==plan['directories']
script="""$ErrorActionPreference='Stop'
$stage='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-v2'
Set-Location -LiteralPath $stage
if(Test-Path -LiteralPath (Join-Path $stage 'transport-readiness.json')){throw 'Earlier transport inspection exists; inspect without replay'}
$attempt=Test-Path -LiteralPath (Join-Path $stage 'attempt-started.json')
$products=@(Get-ChildItem -LiteralPath $stage -Recurse -File | Where-Object {$_.Extension -in @('.p','.r','.i','.cls')})
$ok=(!$attempt -and $products.Count -eq 0)
$proof=[ordered]@{success=$ok;observedAtUtc=[DateTime]::UtcNow.ToString('o');stage=$stage;attemptStarted=$attempt;sourceOrRcodeCount=$products.Count;compileExecuted=$false;businessWrites=$false;directoriesCreatedOnly=$true}
[IO.File]::WriteAllText((Join-Path $stage 'transport-readiness.json'),($proof|ConvertTo-Json -Depth 8),[Text.UTF8Encoding]::new($false))
if(!$ok){throw 'Stage not empty or earlier compile attempt exists; stop without retry'}
Write-Output 'PASS transport readiness: no source/rcode or compile attempt; only private directories/inspection files'
"""
(out/'TransportReadiness.ps1').write_bytes(script.encode('utf8'))
def write(name,value):
    with (out/name).open('x',encoding='utf8') as f:json.dump(value,f,indent=2);f.write('\n')
write('readiness-plan.json',dict(server='compiler',directories=directories,
    uploads=[dict(local=str((out/'TransportReadiness.ps1').relative_to(root)),remote=remote+'/TransportReadiness.ps1')],
    commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/TransportReadiness.ps1'],
    downloads=[dict(remote=remote+'/transport-readiness.json',local=str((out/'transport-readiness.json').relative_to(root)))]))
transport=dict(plan);transport['directories']=directories
write('compile-plan.json',transport)
assert {k:v for k,v in transport.items() if k!='directories'}=={k:v for k,v in plan.items() if k!='directories'}
write('root-review.json',dict(success=True,originalPlanSha256=sha(base/'remote-plan.json'),managerReleaseSha256=sha(base/'manager-release.json'),
    onlyDelta='Add exact sursum-api parent directory before includes/programs/sursum children; no product/command/upload/download changes',
    previousFailure='8794 failed during SFTP mkdir loop before uploads/commands',
    readinessRequiredBeforeCompilation=True,businessWrites=False,compileExecuted=False,
    uploads=len(plan['uploads']),downloads=len(plan['downloads']),
    files=[dict(path=str(out/n),sha256=sha(out/n)) for n in ['TransportReadiness.ps1','readiness-plan.json','compile-plan.json']]))
print('PASS closed transport companion; originals immutable; readiness must precede compile')
