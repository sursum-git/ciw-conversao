from pathlib import Path
import json,hashlib,re,xml.etree.ElementTree as ET
ROOT=Path('D:/opencode/conversao-sc');DOMAIN=Path(__file__).resolve().parents[1];OUT=ROOT/'.runtime/ciw-completion-20261028/comparison-after11'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((DOMAIN/'shared-byte-plan.json').read_text());plans=plan['files']
for row in plans:
 old=(DOMAIN/row['baselineFile']).read_bytes();new=(DOMAIN/row['candidateFile']).read_bytes();assert hashlib.sha256(old).hexdigest()==row['baselineSha256'];actual=old
 for h in reversed(row['hunks']):
  start=h['baselineStartByte'];end=h['baselineEndByteExclusive'];assert actual[start:end]==bytes.fromhex(h['oldBytesHex']);actual=actual[:start]+bytes.fromhex(h['newBytesHex'])+actual[end:]
 assert actual==new and hashlib.sha256(new).hexdigest()==row['candidateSha256']
action=next(x for x in plans if x['target'].endswith('RuntimeApiEntityActionService.php'));assert action['bareLfPreservedInEqualSpans']==action['bareLfBaseline']==action['bareLfCandidate']==15
for name in ['CiwErpReadService.p','CiwCadastrosCrud.p','RuntimeCiwErpQuery.php']:assert b'despesas_impostos_geral'in(DOMAIN/'candidate-exact'/name).read_bytes()
assert (DOMAIN/'candidate-exact/RuntimeApiEntityActionService.php').read_bytes().count(b'RuntimeExpenseTaxRelationsRead::')==(DOMAIN/'baseline-exact/RuntimeApiEntityActionService.php').read_bytes().count(b'RuntimeExpenseTaxRelationsRead::')==8
logs=[]
for dirname,prefix,count in [('projection-local','projection',26),('rounding-local','rounding',21),('itemjoin-local','itemjoin',10),('materializer-local','materializer',14),('reader-local','reader',13),('sql-observed-local','sql-observed',274),('service-local','service',21)]:
 for cp in ['UTF-8','ISO8859-1']:
  for culture in ['AMERICAN','EUROPEAN']:
   p=OUT/dirname/f'{prefix}-{cp}-{culture}.log';assert re.search(r'PASS\s+'+str(count)+r'(?:\s|$)',p.read_text());logs.append({'path':str(p),'sha256':sha(p),'checks':count})
for suite in json.loads((DOMAIN/'tests/regression-list.json').read_text()):
 for cp in ['UTF-8','ISO8859-1']:
  for culture in ['AMERICAN','EUROPEAN']:
   p=OUT/'regression-local'/f"{suite['name'].removesuffix('.p')}-{cp}-{culture}.log";assert re.search(r'PASS\s+'+str(suite['expectedChecks'])+r'(?:\s|$)',p.read_text());logs.append({'path':str(p),'sha256':sha(p),'checks':suite['expectedChecks']})
assert len(logs)==76 and sum(x['checks']for x in logs)==3692
tree=ET.parse(OUT/'full-php/php-full.xml');cases=tree.findall('.//testcase');assert len(cases)==1001 and sum(int(x.attrib['assertions'])for x in cases)==7807;assert not tree.findall('.//failure')and not tree.findall('.//error')
loader=json.loads((OUT/'full-php/php-stage-loader-proof.json').read_text());assert loader['success']and not loader['outsideStage']
native=json.loads((OUT/'native-validation.json').read_text());assert all(x['numericFiltersFunctional']and len(x['numericFilters'])==12 for x in native['results'])
prep=ROOT/'.runtime/ciw-completion-20261028/official-build13-preparation';future=json.loads((prep/'source-manifest.json').read_text());assert future['expectedChecks']==3692 and future['expectedCompileCount']==39 and len(future['files'])==83
for row in future['files']:assert sha(prep/'package'/row['relative'])==row['sha256']
remote=json.loads((prep/'remote-plan.json').read_text());assert remote['commands']==[] and remote['sourceManifestSha256']==sha(prep/'source-manifest.json')
assert 'Compile.p ERROR=no'in(prep/'local-syntax/syntax.log').read_text()and'Regression.p ERROR=no'in(prep/'local-syntax/syntax.log').read_text()
receipts=[]
for name in ['sql-comparison-expression-metadata-v1.json','sql-comparison-operand-metadata-v1.json','sql-comparison-source-derived-v2.json']:
 p=ROOT/'.runtime/ciw-completion-20261028'/name;receipts.append({'path':str(p),'sha256':sha(p),'sqlExecutedByRootOnly':True})
proof={'success':True,'status':'PREPARED_HELD_AFTER12_ORPHAN_POLICY_AND_OFFICIAL','sharedFiles':5,'hunks':sum(len(x['hunks'])for x in plans),'outsideHunksExact':True,'action15IsolatedLfPreserved':True,'preserve1055':True,'localUniqueCompileFiles':18,'localCompileExecutions':26,'localVersion':'12.8','numDbs':0,'testSuites':19,'testLogs':76,'ttChecks':3692,'newChecksPerCombination':379,'regressionChecksPerCombination':544,'fullPhpTests':1001,'fullPhpAssertions':7807,'loadedAppDefinitions':loader['loadedAppDefinitions'],'privateBuilderSha256':'205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7','nativeNumericFiltersPerCurrency':12,'sqlRootReceipts':receipts,'logs':logs,'official13PreparedManifestSha256':sha(prep/'source-manifest.json'),'canonicalWrites':False,'networkExecuted':False,'businessWrites':False}
(OUT/'verification.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf-8');print(json.dumps({k:v for k,v in proof.items()if k not in ['logs','sqlRootReceipts']}))
