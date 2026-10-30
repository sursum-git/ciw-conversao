"""Read-only build7 verification. Records evidence only; never invokes remote tools."""
from pathlib import Path
import hashlib,json,re,difflib
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build7';LOCAL=S/'local-diagnostic-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
def save(p,o):p.write_text(json.dumps(o,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
bm=load(B/'build-manifest.json');integration=load(B/'integration-plan.json');proof=load(B/'composition-proof.json');localLogs=[]
for p in bm['packages']:
 root=Path(p['path']);assert sha(root/'manifest.json')==p['manifestSha256']
 for f in load(root/'manifest.json')['files']:assert sha(root/f['path'])==f['sha256']
for f in load(B/'source-manifest.json'):assert sha(R/f['file'])==f['sha256']
for f in integration['files']:
 target=Path(f['target']);assert (sha(target) if target.exists() else None)==f['baselineSha256'];assert sha(Path(f['candidate']))==f['candidateSha256']
 if f['baselineSha256'] is not None:
  old=target.read_bytes().splitlines(keepends=True);new=Path(f['candidate']).read_bytes().splitlines(keepends=True)
  actual={(i,j) for op,i,j,x,y in difflib.SequenceMatcher(None,old,new,autojunk=False).get_opcodes() if op!='equal'}
  expected={(h['baseLineStart']-1,h['baseLineEndExclusive']-1) for h in proof['hunks'] if h['file']==target.name};assert actual==expected,(target.name,actual,expected)
compiled=(LOCAL/'compile.log').read_text(encoding='utf-8-sig');assert 'PASS COMPILE ALL' in compiled and 'NUM-DBS=0' in compiled and 'ERROR=yes' not in compiled;assert compiled.count('COMPILER:ERROR=no')==65
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  total=0
  for t in bm['tests']:
   p=LOCAL/(t['name'][:-2]+'-'+cp+'-'+culture+'.log');text=p.read_text(encoding='utf-8-sig');assert 'FAIL' not in text
   match=re.search(r'PASS\s*:?\s*(\d+)\b',text) or re.search(r'checks\s*[=:]\s*(\d+)\b',text,re.I);assert match and int(match.group(1))==t['expectedChecks'],(p.name,text[:90]);total+=int(match.group(1));localLogs.append({'file':str(p.relative_to(R)),'sha256':sha(p),'checks':t['expectedChecks']})
  assert total==1030
assert len(localLogs)==72
php=(B/'php-full.xml').read_text(encoding='utf-8');assert re.search(r'tests="910" assertions="5974" errors="0" failures="0"',php)
meta=(B/'metadata-builder.xml').read_text(encoding='utf-8');assert re.search(r'tests="1" assertions="21" errors="0" failures="0"',meta)
assert load(B/'native-validation.json')['status']=='PASS';assert len(load(B/'php-stage-loader-proof.json'))==9
source=load(B/'metadata/source-additions.json');assert sha(R/source['baselinePath'])==source['baselineSha256'];old=load(R/source['baselinePath']);assert len(old['operations'])==132
new=old['operations']+[x['value'] for x in source['operations']];assert len(new)==140 and new[:132]==old['operations'];assert len({x['code'] for x in new})==140
assert len(bm['compileEntries'])==68 and len(integration['files'])==19 and len(proof['hunks'])==8
remote=load(B/'remote-plan.json');assert len(remote['uploads'])==99;assert bm['compileDatabaseConnections']==1 and bm['testDatabaseConnections']==0
for f in (B/'backend-stage').rglob('*.php'):assert '1047' not in f.name and '1051' not in f.name
files=[]
for folder in ['package','backend-stage','metadata','php-tests']:
 for p in sorted((B/folder).rglob('*')):
  if p.is_file():files.append({'file':str(p.relative_to(B)),'sha256':sha(p)})
for name in ['build-manifest.json','source-manifest.json','integration-plan.json','remote-plan.json','composition-proof.json','php-bootstrap.php','verify-stage-loader.php','CombinedMetadataTest.php','validate-native.cjs']:
 p=B/name;files.append({'file':name,'sha256':sha(p)})
result={'success':True,'status':'LOCAL_READY_REQUIRES_MANAGER_REVIEW_THEN_ROOT_OFFICIAL12_2','compileEntriesOfficial':68,'localDevelopmentCompileEntries':65,'localExcludedPhysicalWrappers':['ContainersCustoRead.p','ContainersDespesasBatchApi.p','ContainersProcessos.p'],'ttSuites':18,'testLogs':72,'checksPerCombination':1030,'ttChecksTotal':4120,'numdbsLocal':0,'phpTests':910,'phpAssertions':5974,'phpIncrementalOver885':{'tests':25,'assertions':133},'metadataBuilderTests':1,'metadataBuilderAssertions':21,'nativeScreens':4,'sourceOperationsBefore':132,'sourceOperationsAfter':140,'exactByteCompositionHunks':8,'allStable6OutsideHunksPreserved':True,'inputPackagesVerified':3,'localLogs':localLogs,'files':files,'generatorSha256':sha(R/'tools/construtor-local/prepare-ciw-completion-build7.py'),'verifierSha256':sha(Path(__file__)),'canonicalWrites':False,'remoteExecuted':False,'businessWrites':False,'publicationAllowed':False,'excluded':['1047','1051','writers','grants','DDL'],'gates':['manager independent composition release','root official12.2 with1espec schema connection','72 TT proof logs NUMDBS0','same MED PASOE and native runtime','fresh actual API source auth preserve when applying8 additive operations']}
save(B/'local-review-manifest.json',result)
print(json.dumps({k:v for k,v in result.items() if k not in ['files','localLogs']},ensure_ascii=False))
print('manifestSha256='+sha(B/'local-review-manifest.json'))
