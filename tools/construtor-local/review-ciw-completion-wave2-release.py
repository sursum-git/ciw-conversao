"""Release only pinned staging artifacts for root inspection; never publishes."""
from pathlib import Path
import json,hashlib,re,xml.etree.ElementTree as ET,sys
ROOT=Path('D:/opencode/conversao-sc');STATE=ROOT/'.runtime/ciw-completion-20261028';LABEL=sys.argv[1] if len(sys.argv)>1 else '5-v6';BUILD=STATE/('official-build'+LABEL)
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
manifest=load(BUILD/'build-manifest.json');plan=load(BUILD/'remote-plan.json');integration=load(BUILD/'integration-plan.json')
assert sha(BUILD/'remote-plan.json')==manifest['remotePlanSha256']
assert sha(BUILD/'integration-plan.json')==manifest['integrationPlanSha256']
sources=load(BUILD/'source-manifest.json')
for row in sources:assert sha(ROOT/row['file'])==row['sha256'],row['file']
for entry in integration['files']:
    assert sha(Path(entry['candidate']))==entry['candidateSha256']
    target=Path(entry['target'])
    if entry['baselineSha256'] is None:assert not target.exists(),str(target)
    else:assert sha(target)==entry['baselineSha256'],str(target)
for target,expected in manifest['baselines'].items():assert sha(Path(target))==expected,target
assert manifest['preservedHistoryParentFixSha256']=='1b72391027820a110e3041ea60d33fe701ef04f63b749753d96f6f88df5c3407'
assert len(manifest['compileEntries'])==43 and manifest['testLogs']==40 and manifest['checksPerCombination']==683
assert manifest['compileDatabaseConnections']==1 and manifest['testDatabaseConnections']==0
runner=(BUILD/'package/compile122.ps1').read_text();regression=(BUILD/'package/Regression.p').read_text()
assert runner.count("'-db'")==1 and "'-db','espec','-H','192.168.0.111','-S','10012','-N','TCP','-ld','espec'" in runner
assert runner.count("'-param',($culture+")==10
assert regression.count('NUM-DBS<>0')==2
assert set(plan)=={'server','directories','uploads','commands','downloads'} and plan['server']=='compiler'
assert all('official-build'+LABEL in u['local'] and '/package/' in u['local'].replace('\\','/') for u in plan['uploads'])
assert all('codex-ciw-completion-20261028-build'+LABEL+'/' in u['remote'] for u in plan['uploads'])
assert len(plan['commands'])==1 and plan['commands'][0].endswith('/compile122.ps1')
assert integration['onlyRouteAddition']['operations']==[{'op':'add','path':'/routes/-','value':{'route':'/SursumPrograms/containers-despesas-lote','method':'POST','program':'sursum-api/programs/ContainersDespesasBatchApi.p'}}]
diag=STATE/('local-diagnostic-build'+LABEL);compile_log=(diag/'compile.log').read_text()
assert 'OpenEdge 12.8 NUM-DBS=0' in compile_log and compile_log.count('COMPILER:ERROR=no')==41 and 'COMPILER:ERROR=yes' not in compile_log
proofs=[]
for test in manifest['tests']:
    for cp in ['UTF-8','ISO8859-1']:
        for culture in ['AMERICAN','EUROPEAN']:
            f=diag/(test['name'][:-2]+'-'+cp+'-'+culture+'.log');value=f.read_text()
            assert re.search(r'(?:PASS\s+|PASS fiscal checks=)'+str(test['expectedChecks'])+r'\b',value),(str(f),value)
            assert 'FAIL' not in value
            proofs.append({'path':str(f.relative_to(ROOT)),'sha256':sha(f),'checks':test['expectedChecks']})
php_proof=STATE/'official-build5-v5'
if LABEL!='5-v5':
    repair=load(BUILD/'harness-only-repair-proof.json');assert repair['success'] and repair['all16IntegrationCandidateBytesIdentical']
    previous=load(php_proof/'integration-plan.json')
    assert [(x['target'],x['candidateSha256']) for x in previous['files']]==[(x['target'],x['candidateSha256']) for x in integration['files']]
    assert "PROVERSION BEGINS '12.2'" in (BUILD/'package/Compile.p').read_text()
    assert "CIW_COMPILE_NETLIB" in runner and "Test-Path -LiteralPath" in runner
    assert "gui/netlib/OpenEdge.Net.pl" in runner and "tty/netlib/OpenEdge.Net.pl" in runner
xml=ET.parse(php_proof/'review/php-full.xml').getroot();suite=next(iter(xml))
assert (int(suite.attrib['tests']),int(suite.attrib['assertions']),int(suite.attrib['failures']),int(suite.attrib['errors']))==(885,5841,0,0)
bindings=load(php_proof/'review/php-class-bindings.json');assert len(bindings)==4
assert all('official-build5-v5/backend-stage/' in p.replace('\\','/') for p in bindings.values())
report={'success':True,'status':'LOCAL_REVIEW_GREEN_RELEASE_FOR_ROOT_OFFICIAL_COMPILATION_ONLY','reviewer':'ciw_completion_manager',
 'buildManifestSha256':sha(BUILD/'build-manifest.json'),'remotePlanSha256':sha(BUILD/'remote-plan.json'),
 'sourceManifestSha256':sha(BUILD/'source-manifest.json'),'integrationPlanSha256':sha(BUILD/'integration-plan.json'),
 'sourceFilesVerified':len(sources),'integrationFilesVerified':len(integration['files']),'productionCompileEntriesOfficial':43,
 'officialCompileSchemaConnections':1,'officialCompilePending':True,'localDevelopmentCompileEntries':41,
 'localExcludedStaticImaWrappers':['ContainersCustoRead.p','ContainersDespesasBatchApi.p'],
 'localTtChecksPerCombination':683,'localCombinations':4,'localTtLogs':proofs,'testDatabaseConnections':0,
 'combinedPhp':{'tests':885,'assertions':5841,'failures':0,'errors':0,'allFourStageClassesConfirmed':bindings,'proofBuild':str(php_proof),'allCandidateBytesIdenticalVerified':True,'junitSha256':sha(php_proof/'review/php-full.xml')},
 'incrementalCompositionProof':{'realRuntimeBatchChecks':42,'realBuilder':True,'nativeSaveBatchChecks':16,'realKendoChecks':8,'auxPhp':[6,41],'previousBatchPhp':[28,478]},
 'remainingP1P2':[],'canonicalWrites':False,'networkExecuted':False,'businessWrites':False,'publicationAllowed':False,
 'gates':['Root must inspect pinned hashes and compile43units in OpenEdge12.2 on42 with espec schema connection, never execute production in compile AVM.',
          'Run40TTAVMs without any-db and validate683checks in each4combinations; local12.8 is diagnostic only.',
          'Integrate/publish coherent fixed wrappers/services/readers/dispatcher/route; same sursum-api/med only.',
          'Validate public authenticated wrapper read/get/rejections in PASOE; local wiring is structural, not real HTTP proof.',
          'No positive writer PASOE/business scenario, access grants or DDL authorized by this release. Prepare a fresh concrete scenario separately.',
          'Readonly aux is raw persisted data; current lookup fields and historical BRL/USD comparisons remain separate pending deltas.']}
(BUILD/'manager-review-final.json').write_text(json.dumps(report,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print(json.dumps({k:report[k] for k in ['success','buildManifestSha256','remotePlanSha256','sourceManifestSha256','integrationPlanSha256','sourceFilesVerified','integrationFilesVerified','remainingP1P2']}))
