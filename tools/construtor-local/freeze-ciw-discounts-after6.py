from pathlib import Path
import json,hashlib,shutil,difflib,copy,sys
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';ROOT=R/'integration-src/ciw-completion-20261028/import-discounts-readonly';OLD=ROOT/'frozen-v1';VERSION=sys.argv[1] if len(sys.argv)>1 else '1.2';NEW=ROOT/('frozen-v'+VERSION);ST=S/'import-discounts-readonly/rebase-after6-stage';LOCAL=S/'import-discounts-readonly/rebase-after6-local';SOURCE=S/'source-132-current-after6.json'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert not NEW.exists();m=load(OLD/'manifest.json');assert sha(OLD/'manifest.json')=='714587844c8e94c71234b090fa1068c3e2ea2dc07832439603f89fcd33748e83'
for e in m['files']:assert sha(OLD/e['path'])==e['sha256']
assert load(R/m['metadataBaseline']['path'])==load(SOURCE);assert len(load(SOURCE)['operations'])==132
assert 'OK (12 tests, 57 assertions)' in (ST/'php-incremental.log').read_text();assert 'OK (885 tests, 5841 assertions)' in (ST/'php-full.log').read_text()
for cp in ['UTF-8','ISO8859-1']:
 assert (LOCAL/('compile-'+cp+'.log')).read_text().count('ERROR=no')==9
 for culture in ['AMERICAN','EUROPEAN']:
  log=(LOCAL/('green-'+cp+'-'+culture+'.log')).read_text()
  for n in [18,44,17]:assert 'PASS '+str(n)+' NUMDBS=0' in log
shutil.copytree(OLD,NEW);exact=NEW/'candidate-exact';exact.mkdir();reb=load(ST/'rebase-proof.json');baselines=[]
for e in reb['changes']:
 t=Path(e['target']);assert sha(t)==e['baselineSha256'];p=ST/t.name;assert sha(p)==e['candidateSha256'];shutil.copyfile(p,exact/t.name)
 (NEW/'patches'/(t.name+'.patch')).write_text(''.join(difflib.unified_diff(t.read_text(encoding='utf-8-sig').replace('\r\n','\n').splitlines(True),p.read_text(encoding='utf-8-sig').replace('\r\n','\n').splitlines(True),fromfile=str(t),tofile=str(t))),encoding='utf-8')
 baselines.append({'target':str(t),'baselineSha256':e['baselineSha256'],'candidateSha256':e['candidateSha256'],'exactCandidate':'candidate-exact/'+t.name,'patch':'patches/'+t.name+'.patch','baselineKind':'Current stable integrated6, exact byte edits preserve tax1043/lookup/aux/batch'})
b=load(NEW/'baselines.json');b.update(status='POST_BUILD6_REBASED_EXACT_BYTES_NOT_APPLIED',baselines=baselines);(NEW/'baselines.json').write_text(json.dumps(b,indent=2)+'\n')
patch=load(NEW/'metadata/source-patch.json');patch.update(baselinePath=str(SOURCE.relative_to(R)).replace('\\','/'),baselineSha256=sha(SOURCE));(NEW/'metadata/source-patch.json').write_text(json.dumps(patch,ensure_ascii=False,indent=2)+'\n')
for p in list(NEW.glob('prepare*.cjs'))+[NEW/'freeze.cjs']:
 if p.exists():p.write_text("throw new Error('Immutable freeze. Use candidate-exact files and current baseline guards; never regenerate old stages.');\n",encoding='utf-8')
bootstrap=NEW/'tests/runtime-bootstrap.php';bootstrap.write_text(bootstrap.read_text().replace("'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/import-discounts-readonly/stage'","dirname(__DIR__).'/candidate-exact'"),encoding='utf-8')
m.update(version='discounts-v'+VERSION,status='FROZEN_REBASED_POST_BUILD6_NOT_PUBLISHED',stage=str(exact),localStage=str(LOCAL),baselines=baselines,predecessor={'path':str(OLD/'manifest.json'),'sha256':sha(OLD/'manifest.json'),'productAblPhpUnchangedExceptFourSharedRebases':True},newPhpFile=b['newPhpFile'])
m['metadataBaseline'].update(path=str(SOURCE.relative_to(R)).replace('\\','/'),sha256=sha(SOURCE));m['validation']['fullPhpTests']=885;m['validation']['fullPhpAssertions']=5841
for p in [ST/'php-incremental.xml',ST/'php-full.xml']+[LOCAL/('compile-'+cp+'.log') for cp in ['UTF-8','ISO8859-1']]+[LOCAL/('green-'+cp+'-'+culture+'.log') for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]:m['receipts'].append({'path':str(p.relative_to(R)).replace('\\','/'),'sha256':sha(p)})
m['files']=[{'path':p.relative_to(NEW).as_posix(),'sha256':sha(p)} for p in sorted(NEW.rglob('*')) if p.is_file() and p.name!='manifest.json'];(NEW/'manifest.json').write_text(json.dumps(m,ensure_ascii=False,indent=2)+'\n')
review={'success':True,'status':'REVIEW_PASS_POST6_OFFICIAL_PENDING','manifestSha256':sha(NEW/'manifest.json'),'filesVerified':len(m['files']),'baselineCount':4,'sourceBefore':132,'sourceAfter':136,'currentSourceGuardVerified':True,'oldFrozenPreserved':True,'localCompilesPerCodepage':9,'localChecksPerCombination':79,'localCombinations':4,'phpIncremental':[12,57],'phpFull':[885,5841],'remainingP1P2':[],'canonicalWrites':False,'businessWrites':False,'limits':['Root official12.2/coherent production+PHP deployment and readonly physical execution pending','Contextual item grids/bridge item0/all writers remain separate','No generic source DTO replacement or authentication persistence','Use exact candidates; normalized patch bytes are review only']};(ST/'manager-review-final.json').write_text(json.dumps(review,indent=2)+'\n');print(json.dumps({'success':True,'manifestSha256':sha(NEW/'manifest.json'),'files':len(m['files']),'canonicalWrites':False}))
