from pathlib import Path
import json,hashlib,re
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build6-v2';D=S/'local-diagnostic-build6-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
b=load(B/'build-manifest.json');i=load(B/'integration-plan.json');sources=load(B/'source-manifest.json')
for e in sources:assert sha(R/e['file'])==e['sha256']
for e in i['files']:
 assert sha(Path(e['candidate']))==e['candidateSha256'];t=Path(e['target']);assert (sha(t) if t.exists() else None)==e['baselineSha256'],str(t)
logs=[]
for t in b['tests']:
 for cp in ['UTF-8','ISO8859-1']:
  for culture in ['AMERICAN','EUROPEAN']:
   p=D/(t['name'][:-2]+'-'+cp+'-'+culture+'.log');s=p.read_text(encoding='utf-8-sig');n=re.search(r'PASS\s*:?\s*(\d+)',s) or re.search(r'PASS.*checks=(\d+)',s)
   assert n and int(n.group(1))==t['expectedChecks'],str(p);assert 'FAIL' not in s
   logs.append({'path':str(p.relative_to(R)),'sha256':sha(p),'checks':int(n.group(1))})
compile=(D/'compile.log').read_text();assert 'PASS COMPILE ALL' in compile and 'COMPILER:ERROR=yes' not in compile
count=len(re.findall(r'COMPILER:ERROR=no',compile));assert count==len(b['compileEntries'])-3
assert 'OK (885 tests, 5841 assertions)' in (B/'review/php-full.log').read_text()
bindings=load(B/'review/php-class-bindings.json')
for name in ['RuntimeContainerAudit','RuntimeContainerTaxAudit','RuntimeApiEntityActionService']:assert '/official-build6-v2/backend-stage/' in bindings['App\\Runtime\\'+name].replace('\\','/')
review={'success':True,'status':'RELEASE_ROOT_OFFICIAL_COMPILATION_ONLY','buildManifestSha256':sha(B/'build-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),'sourceManifestSha256':sha(B/'source-manifest.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'sourceFilesVerified':len(sources),'integrationFilesVerified':len(i['files']),'officialCompileEntries':len(b['compileEntries']),'compileDatabaseConnections':1,'testDatabaseConnections':0,'localDevelopmentCompiles':count,'localExcludedStaticImaWrappers':['ContainersCustoRead.p','ContainersDespesasBatchApi.p','ContainersProcessos.p'],'testLogs':len(logs),'checksPerCombination':b['checksPerCombination'],'totalTtChecks':sum(e['checks'] for e in logs),'localLogs':logs,'fullPhp':[885,5841],'remainingP1P2':[],'canonicalWrites':False,'remoteExecuted':False,'metadataBatch1042Excluded':True,'discountsGeneralExcluded':True,'limits':['Local52compiles development12.8 only; all55must compile official12.2 including3physical wrappers','Positive new-record writer1043 separately authorized','Deploy API/Service10handles as coherent pairs/helper; never mix8and10','Exact PHP copies only; never replace source auth using sanitized DTO','Local diagnostic final guard false error from undefined LASTEXITCODE after all56PASS; fixed outside immutable package;56logs individually verified']}
(B/'manager-review-final.json').write_text(json.dumps(review,indent=2)+'\n')
print(json.dumps({k:review[k] for k in ['success','buildManifestSha256','remotePlanSha256','sourceManifestSha256','integrationPlanSha256','sourceFilesVerified','integrationFilesVerified','officialCompileEntries','testLogs','checksPerCombination','totalTtChecks','localDevelopmentCompiles','fullPhp']}))
