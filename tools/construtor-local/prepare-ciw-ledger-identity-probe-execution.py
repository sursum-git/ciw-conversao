"""Adapt the reviewed identity-only probe to the closed SSH helper and fresh staging."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];base=root/'.runtime/ciw-completion-20261028/ledger-identity-readonly-probe'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(base/'manifest.json')=='2c6e5b0b4db47efff65b3a344e8b62c85c0a356723cb5b380f9ddfa23a97d979'
manifest=json.loads((base/'manifest.json').read_text())
for entry in manifest['files']:assert sha(base/entry['path'])==entry['sha256']
out=base/'execution-v1.1';out.mkdir(exist_ok=True)
assert not(out/'remote-execution-plan.json').exists()and not(out/'RunProbe122.ps1').exists()
for name in ['Compile.p','LedgerIdentityReadonlyProbe.p']:
 if(out/name).exists():assert sha(out/name)==sha(base/name)
 else:shutil.copyfile(base/name,out/name)
script=(base/'RunProbe122.ps1').read_text()
separator="$PSScriptRoot.Replace('"+chr(92)+"','/')"
assert script.count(separator)==1
script=script.replace('codex-ciw-completion-20261028-ledger-identity-ro','codex-ciw-completion-20261028-ledger-identity-ro-v1_1')
(out/'RunProbe122.ps1').write_text(script,encoding='utf-8')
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-ledger-identity-ro-v1_1'
names=['Compile.p','LedgerIdentityReadonlyProbe.p','RunProbe122.ps1']
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((out/name).relative_to(root)),remote=remote+'/'+name)for name in names],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/RunProbe122.ps1'],downloads=[dict(local=str((out/'results'/name).relative_to(root)),remote=remote+'/'+name)for name in ['compile.log','compile-process.log','probe-process.log','ledger-identity-private.json']])
(out/'remote-execution-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
(out/'execution-manifest.json').write_text(json.dumps(dict(success=True,baseManifestSha256=sha(base/'manifest.json'),ablUnchanged=True,powershellOnlyFreshDirectoryChanged=True,powershellSeparatorOriginallyCorrect=True,files=[dict(file=name,sha256=sha(out/name))for name in names],executionPlanSha256=sha(out/'remote-execution-plan.json'),businessWrites=False,remoteExecuted=False),indent=2)+'\n')
print('Prepared3file private identity-only probe;ABL unchanged;fresh staging and structured SSH plan;no network execution')
