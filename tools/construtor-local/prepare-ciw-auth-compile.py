"""Prepara compilacao/testes delimitados OpenEdge12.2, sem credenciais."""
import argparse,hashlib,json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
args=argparse.ArgumentParser()
args.add_argument('--stage',required=True)
args=args.parse_args()
if not args.stage.replace('-','').isalnum():raise ValueError('Stage invalido')
source=ROOT/'integration-src/ciw-auth'
stage=ROOT/'.runtime/ciw-auth-20261017'/args.stage
stage.mkdir(parents=True,exist_ok=True)
remote='C:/Users/tadeu.parreiras/codex-ciw-auth-20261017'
files=sorted(p.name for p in source.iterdir() if p.suffix in ('.p','.cls'))
logs=['ciw-auth-compile.log','compile-process.log','schema-process.log','ciw-auth-schema.json']+[prefix+c+'.log' for c in ['AMERICAN','EUROPEAN'] for prefix in ['ciw-auth-service-','ciw-auth-boundary-']]
script="""$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'REMOTE'
if((Get-Location).Path.Replace('\\','/') -ne 'REMOTE'){throw 'Staging inesperado'}
$env:DLC='C:/Progress_12/OE'
foreach($name in @('ciw-auth-compile.log','ciw-auth-service-AMERICAN.log','ciw-auth-service-EUROPEAN.log','ciw-auth-boundary-AMERICAN.log','ciw-auth-boundary-EUROPEAN.log')){
 if(Test-Path -LiteralPath $name){Remove-Item -LiteralPath $name}
}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p CompileCiwAuthentication.p *> compile-process.log
Get-Content -LiteralPath ciw-auth-compile.log
foreach($name in @('ciw-auth-service-AMERICAN.log','ciw-auth-service-EUROPEAN.log','ciw-auth-boundary-AMERICAN.log','ciw-auth-boundary-EUROPEAN.log')){
 if(Test-Path -LiteralPath $name){Get-Content -LiteralPath $name}
}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p ReadCiwAuthenticationSchema.p *> schema-process.log
""".replace('REMOTE',remote)
(stage/'compile.ps1').write_text(script,encoding='utf-8-sig')
uploads=[{'local':str((source/f).relative_to(ROOT)).replace('\\','/'),'remote':remote+'/'+f} for f in files]
uploads.append({'local':str((stage/'compile.ps1').relative_to(ROOT)).replace('\\','/'),'remote':remote+'/compile.ps1'})
names=logs+[Path(f).stem+'.r' for f in files]
downloads=[{'local':str((stage/f).relative_to(ROOT)).replace('\\','/'),'remote':remote+'/'+f,'optional':f.endswith('.r') or f.startswith(('ciw-auth-service-','ciw-auth-boundary-'))} for f in names]
for d in downloads:
 p=ROOT/d['local']
 if d['optional'] and p.exists():p.unlink()
(stage/'source-manifest.json').write_text(json.dumps({f:hashlib.sha256((source/f).read_bytes()).hexdigest() for f in files},indent=2),encoding='utf-8')
(stage/'compile-plan.json').write_text(json.dumps({'server':'compiler','directories':[remote],'uploads':uploads,'commands':['powershell -NoProfile -File '+remote+'/compile.ps1'],'downloads':downloads},indent=2),encoding='utf-8')
print(stage/'compile-plan.json')
