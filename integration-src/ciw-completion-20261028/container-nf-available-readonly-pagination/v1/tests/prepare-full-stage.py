from pathlib import Path
import hashlib,json
W=Path('D:/opencode/conversao-sc');P=Path(__file__).resolve().parents[1]
S=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1';B=S/'full-stage'
OLD=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly/full-stage'
FROZEN=W/'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1.1'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def cp(src,dest,rewrite=False):
 data=src.read_bytes()
 if rewrite:data=data.replace(OLD.as_posix().encode(),B.as_posix().encode())
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
assert sha(FROZEN/'manifest.json')=='1865e6c18f4fc8ecc26d8f7a697058c1c943d378f4a9e01c5d25c0e2021df79e'
for tree in ['backend-stage','php-tests','test-inputs']:
 for src in (OLD/tree).rglob('*'):
  if src.is_file():cp(src,B/tree/src.relative_to(OLD/tree),tree!='backend-stage')
cp(OLD/'php-bootstrap.php',B/'php-bootstrap.php',True)
plan=json.loads((P/'patches/patch-plan.json').read_text());composed=[]
for patch in plan['textPatches']:
 if not patch['relative'].startswith('php/'):continue
 dest=B/'backend-stage/backend/src/Runtime'/Path(patch['relative']).name
 before=dest.read_bytes();assert hashlib.sha256(before).hexdigest()==patch['baselineSha256'],dest.name;data=before
 for h in patch['changes']:
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1,(dest.name,'exact anchor count');data=data.replace(a,b,1)
 dest.write_bytes(data)
 composed.append({'file':dest.name,'predecessorSha256':hashlib.sha256(before).hexdigest(),'composedSha256':sha(dest),'exactAnchors':len(patch['changes']),'predecessorIncludes1055':dest.name in ['RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']})
# Copy relation regressions and redirect every generated receipt to this new stage.
relations=B/'php-tests/relations';newstate=B/'relations-state';oldstate=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly'
for src in (FROZEN/'tests').glob('*Test.php'):
 data=src.read_bytes().replace(oldstate.as_posix().encode(),newstate.as_posix().encode());dest=relations/'tests'/src.name;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
for src in (FROZEN/'metadata').glob('*.json'):cp(src,relations/'metadata'/src.name)
cp(oldstate/'local/expense-tax-relations-actual.json',newstate/'local/expense-tax-relations-actual.json')
canonical='D:/opencode/construtor-pg/backend/tests'
exclude=(B/'php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php').as_posix()
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{B.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="NfPaginationWith1055FullStage"><directory>{canonical}</directory><directory>{B.as_posix()}/php-tests</directory><exclude>{exclude}</exclude><directory>{P.as_posix()}/tests</directory></testsuite></testsuites></phpunit>'''
(B/'phpunit.xml').write_text(config,encoding='utf8')
rows=[{'path':src.relative_to(B/'backend-stage/backend/src').as_posix(),'sha256':sha(src)}for src in (B/'backend-stage/backend/src').rglob('*')if src.is_file()]
proof={'sourceFiles':rows,'phpFiles':len([x for x in rows if x['path'].endswith('.php')]),'composition':composed,'supersededTests':[{'path':exclude,'reason':'11 fullset/local pagination tests superseded by 13 actual Runtime paginated-boundary tests; originals preserved','originalSha256':sha(B/'php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php')}],'relationsManifestSha256':sha(FROZEN/'manifest.json'),'canonicalWrites':False,'frozenWrites':False}
(B/'composition-proof.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf8')
print(json.dumps({'stage':str(B),'phpFiles':proof['phpFiles'],'composedWith1055':True,'exactHunks':sum(x['exactAnchors']for x in composed)}))
