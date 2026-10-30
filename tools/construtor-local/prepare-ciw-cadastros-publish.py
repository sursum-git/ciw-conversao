"""Gera manifesto/transferencias; apenas hash do token, nenhum segredo no lote."""
from pathlib import Path
import json,hashlib
ROOT=Path(__file__).resolve().parents[2];P=ROOT/'.runtime/ciw-cadastros-20261020';STAGE='/tmp/ciw-cadastros-20261020'
pub=P/'publish';pub.mkdir(exist_ok=True);targets={};uploads=[]
for name in ['CiwCadastroCrudService','CiwCadastroDefinition','CiwCadastrosCrud']:
 for ext in ['.p','.r']:
  f=ROOT/'integration-src/ciw-cadastros'/(name+ext) if ext=='.p' else P/'compiled'/(name+ext)
  rel='sursum-api/programs/'+name+ext;targets[rel]={'file':f.name,'sha256':hashlib.sha256(f.read_bytes()).hexdigest()};uploads.append({'local':f.relative_to(ROOT).as_posix(),'remote':STAGE+'/'+f.name})
f=pub/'ciw-cadastros-api.json';targets['sursum-conf/'+f.name]={'file':f.name,'sha256':hashlib.sha256(f.read_bytes()).hexdigest()};uploads.append({'local':f.relative_to(ROOT).as_posix(),'remote':STAGE+'/'+f.name})
(pub/'manifest.json').write_text(json.dumps({'targets':targets},indent=2))
for f in [pub/'manifest.json',ROOT/'tools/construtor-local/publish-ciw-cadastros.py',P/'compile/compile-ciw-cadastros.log',P/'compile/ciw-cadastro-tests-AMERICAN.log',P/'compile/ciw-cadastro-tests-EUROPEAN.log']:uploads.append({'local':f.relative_to(ROOT).as_posix(),'remote':STAGE+'/'+f.name})
plan={'server':'runtime','directories':[STAGE],'uploads':uploads,'commands':['python3 '+STAGE+'/publish-ciw-cadastros.py'],'downloads':[{'remote':STAGE+'/active-manifest.json','local':(pub/'active-manifest.json').relative_to(ROOT).as_posix()},{'remote':'/mnt/datasul/ERP/sursum/conf-web-handler/program-routes.json','local':(pub/'routes-after.json').relative_to(ROOT).as_posix()}]}
(pub/'plan.json').write_text(json.dumps(plan,indent=2));print('Lote de publicacao preparado, sem credencial reutilizavel no staging.')
