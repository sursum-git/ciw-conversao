"""Freeze1043 v1.1: preserve every build5 branch, rebase PHP exact bytes only."""
from pathlib import Path
import copy,difflib,hashlib,json,shutil
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028/container-tax-only'
OLD=S/'frozen-v1';NEW=R/'integration-src/ciw-completion-20261028/container-tax-only/frozen-v1.1'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
assert not NEW.exists(),'Do not replace frozen candidate'
old=load(OLD/'manifest.json');assert sha(OLD/'manifest.json')=='b1235ab3d39a9c930abd12f7a05a9674cad4149ac9765169eb6d3b6b940ce5c3'
for e in old['files']:assert sha(OLD/e['path'])==e['sha256']
shutil.copytree(OLD,NEW);exact=NEW/'php-exact';exact.mkdir()
plan=load(OLD/'patches/php-plan.json');changes=[]
for p in plan['textPatches']:
 target=Path(p['target']);before=target.read_bytes();after=before
 for c in p['changes']:
  a,b=c['old'].encode(),c['new'].encode()
  if after.count(a)!=1 and after.count(a.replace(b'\n',b'\r\n'))==1:a=a.replace(b'\n',b'\r\n');b=b.replace(b'\n',b'\r\n')
  assert after.count(a)==1,'Absent/nonunique exact anchor '+target.name
  after=after.replace(a,b,1)
 dest=exact/target.name;dest.write_bytes(after)
 # Raw-byte replacements preserve every unrelated batch and auxiliary branch.
 p.update(baselineSha256=sha(target),candidateSha256=sha(dest),exactCandidate=dest.relative_to(NEW).as_posix())
 patch=NEW/'patches'/(target.name+'.patch')
 patch.write_text(''.join(difflib.unified_diff(before.decode('utf-8-sig').replace('\r\n','\n').splitlines(True),after.decode('utf-8-sig').replace('\r\n','\n').splitlines(True),fromfile=str(target),tofile=str(target))),encoding='utf-8')
 changes.append({'target':str(target),'baselineSha256':sha(target),'candidateSha256':sha(dest),'preservesOutsideAnchors':True})
(NEW/'patches/php-plan.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
bootstrap="<?php\nrequire 'D:/opencode/construtor-pg/backend/vendor/autoload.php';\nrequire dirname(__DIR__).'/php-exact/RuntimeContainerAudit.php';\nrequire dirname(__DIR__).'/php/RuntimeContainerTaxAudit.php';\nrequire dirname(__DIR__).'/php-exact/RuntimeApiEntityActionService.php';\n"
(NEW/'tests/phpunit-bootstrap.php').write_text(bootstrap,encoding='utf-8')
(NEW/'tests/prepare-php.py').write_text("raise SystemExit('Frozen exact PHP candidate. Never regenerate; verify manifest and use php-exact with baseline guards.')\n",encoding='utf-8')
updated=copy.deepcopy(old);updated['version']='1.1';updated['status']='FROZEN_REBASED_AFTER_BUILD5_CANDIDATE_NOT_APPLIED'
updated['predecessor']={'path':str(OLD/'manifest.json'),'sha256':sha(OLD/'manifest.json'),'productAblAndMetadataUnchanged':True}
updated['phpRebase']=changes
for e in updated['baselines']:
 match=next((p for p in plan['textPatches'] if p['target']==e['target']),None)
 if match:e['baselineSha256']=match['baselineSha256']
updated['files']=[{'path':p.relative_to(NEW).as_posix(),'sha256':sha(p),'bytes':p.stat().st_size} for p in sorted(NEW.rglob('*')) if p.is_file() and p.name!='manifest.json']
for e in old['files']:
 if e['path'].startswith(('metadata/','abl/')):assert sha(NEW/e['path'])==e['sha256'],e['path']
(NEW/'manifest.json').write_text(json.dumps(updated,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
out=S/'rebase-v1.1';out.mkdir();(out/'rebase-proof.json').write_text(json.dumps({'success':True,'manifest':str(NEW/'manifest.json'),'manifestSha256':sha(NEW/'manifest.json'),'phpRebase':changes,'originalFrozenPreserved':sha(OLD/'manifest.json')==updated['predecessor']['sha256'],'canonicalWrites':False,'parentMetadataStillRequiresRebaseAfter1042Publication':True},indent=2)+'\n',encoding='utf-8')
print(json.dumps({'success':True,'manifestSha256':sha(NEW/'manifest.json'),'files':len(updated['files']),'phpExact':2,'canonicalWrites':False}))
