from pathlib import Path
import json,hashlib
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-sample-formats-20261027';b=s/'build2';c=r/'integration-src/purchase-sample-formats';motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
text=(b/'compiled122/compile.log').read_text();assert 'OpenEdge 12.2' in text and 'PASS COMPILE ALL' in text and 'COMPILER:ERROR=yes' not in text
logs=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for prefix,phrase in [('formats-tests-','PASS formats checks=38'),('ciw-cadastro-tests-','PASS 60 checks'),('ciw-cadastro-definition-','PASS 10 checks')]:
   p=b/'compiled122'/(prefix+cp+'-'+culture+'.log');t=p.read_text(encoding='utf-8-sig');assert phrase in t and 'FAIL' not in t;logs.append(dict(file=str(p.relative_to(r)),sha256=sha(p)))
files=[];targets=[]
for n in ['CiwCadastroCrudService','CiwCadastroCoreService','CiwCadastroSequenceIdentity','CiwCadastroDefinition','CiwCadastrosCrud']:
 for ext in ['p','r']:
  rel='sursum-api/programs/'+n+'.'+ext;p=c/'abl'/(n+'.p')if ext=='p'else b/'compiled122'/rel
  if ext=='p':assert sha(p)==sha(b/'package'/rel)
  files.append(dict(relative=rel,file=p.name,source=str(p.relative_to(r)),sha256=sha(p)))
 targets.append((c/'abl'/(n+'.p'),motor/'sursum-api/programs'/(n+'.p')))
for n in ['SampleFormatsCrudTest.p','SampleFormatsTestIdentity.p']:targets.append((c/'tests'/n,motor/'tests/abl/ciw-sample-formats'/n))
targets.append((c/'tests/CiwCadastroDefinitionTest.p',motor/'tests/abl/ciw-cadastros/CiwCadastroDefinitionTest.p'))
for n in ['RuntimeCiwCadastroAudit.php','RuntimeApiEntityActionService.php']:targets.append((c/'php'/n,builder/'backend/src/Runtime'/n))
targets.append((c/'tests/RuntimeSampleFormatsAuditTest.php',builder/'backend/tests/Runtime/RuntimeSampleFormatsAuditTest.php'))
for p in (c/'metadata').glob('*.json'):targets.append((p,builder/'integrations/ciw-purchase-sample-formats'/p.name))
targets.append((c/'metadata/proc-compra-itens-builder-draft.json',builder/'integrations/ciw-purchase-items/proc-compra-itens-builder-draft.json'))
baselines={str(Path(x['target'])):x['sha256']for x in json.loads((s/'baseline-manifest.json').read_text())}
for p,t in targets:
 if str(t)in baselines:assert sha(t)==baselines[str(t)],'Canonical concurrent change '+str(t)
plan=dict(files=[dict(source=str(p),target=str(t),sha256=sha(p),beforeSha256=sha(t)if t.exists()else None)for p,t in targets])
if(s/'canonical-plan.json').exists():
 old=json.loads((s/'canonical-plan.json').read_text());assert {(x['target'],x['beforeSha256'])for x in old['files']}=={(x['target'],x['beforeSha256'])for x in plan['files']},'Do not reset existing guards'
(s/'canonical-plan.json').write_text(json.dumps(plan,indent=2),encoding='utf-8')
(s/'official-compile-verification.json').write_text(json.dumps(dict(success=True,version='12.2',build=2,compileEntries=12,testsPerCombination=108,newChecks=38,regressionChecks=70,combinations=4,files=files,testEvidence=logs,businessWrites=False),indent=2),encoding='utf-8')
print('PASS official12.2 build2/108checks x4;15canonical files/10runtime artifacts; baselines preserved')
