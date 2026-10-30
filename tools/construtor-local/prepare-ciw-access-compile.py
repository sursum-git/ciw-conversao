"""Prepara plano delimitado de compilacao/testes12.2; sem credenciais."""
import argparse
import hashlib
import json
from pathlib import Path

ROOT=Path(__file__).resolve().parents[2]
parser=argparse.ArgumentParser()
parser.add_argument('--phase',choices=['red','green'],required=True)
args=parser.parse_args()
stage=ROOT/'.runtime/ciw-access-20261016'/('compiled-'+args.phase)
stage.mkdir(parents=True,exist_ok=True)
remote='C:/Users/tadeu.parreiras/codex-ciw-access-20261016'
source=ROOT/'integration-src/ciw-access'
files=['CiwAccessServiceTest.p','RunCiwAccessTests.p','CompileCiwAccessTests.p','ReadCiwAccessSchema.p']
for name in ['CiwAccessService.p','CiwAccessRead.p','CiwAccessBoundaryTest.p','CiwAccessBoundary.p']:
 if (source/name).exists():files.append(name)
script="""$ErrorActionPreference='Stop'
$ProgressPreference='SilentlyContinue'
Set-Location -LiteralPath 'REMOTE'
if((Get-Location).Path.Replace('\\','/') -ne 'REMOTE'){throw 'Staging inesperado'}
$env:DLC='C:/Progress_12/OE'
foreach($name in @('compile-ciw-access.log','ciw-access-tests-AMERICAN.log','ciw-access-tests-EUROPEAN.log','ciw-access-boundary-AMERICAN.log','ciw-access-boundary-EUROPEAN.log')){
 if(Test-Path -LiteralPath $name){Remove-Item -LiteralPath $name}
}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p CompileCiwAccessTests.p *> compile-process.log
Get-Content -LiteralPath compile-ciw-access.log
foreach($name in @('ciw-access-tests-AMERICAN.log','ciw-access-tests-EUROPEAN.log','ciw-access-boundary-AMERICAN.log','ciw-access-boundary-EUROPEAN.log')){
 if(Test-Path -LiteralPath $name){Get-Content -LiteralPath $name}
}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p ReadCiwAccessSchema.p *> schema-process.log
""".replace('REMOTE',remote)
(stage/'compile.ps1').write_text(script,encoding='utf-8-sig')
uploads=[dict(local=str((source/f).relative_to(ROOT)).replace('\\','/'),remote=remote+'/'+f) for f in files]
uploads.append(dict(local=str((stage/'compile.ps1').relative_to(ROOT)).replace('\\','/'),remote=remote+'/compile.ps1'))
downloads=[dict(local=str((stage/n).relative_to(ROOT)).replace('\\','/'),remote=remote+'/'+n,optional=n.endswith('.r') or n.startswith('ciw-access-tests') or n.startswith('ciw-access-boundary')) for n in
 ['compile-ciw-access.log','compile-process.log','schema-process.log','ciw-access-tests-AMERICAN.log','ciw-access-tests-EUROPEAN.log','ciw-access-boundary-AMERICAN.log','ciw-access-boundary-EUROPEAN.log']+
 ['schema-ciw-'+t+'.json' for t in ['user-web','usuarios_grupos','grupos_aplicacoes']]+
 [f[:-2]+'.r' for f in files if f.endswith('.p')]]
plan=dict(server='compiler',directories=[remote],uploads=uploads,commands=['powershell -NoProfile -File '+remote+'/compile.ps1'],downloads=downloads)
for transfer in downloads:
 target=ROOT/transfer['local']
 if transfer['optional'] and target.exists():target.unlink()
(stage/'compile-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
(stage/'source-manifest.json').write_text(json.dumps({f:hashlib.sha256((source/f).read_bytes()).hexdigest() for f in files},indent=2),encoding='utf-8')
print(stage/'compile-plan.json')
