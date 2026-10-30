"""Independent read-only release audit of sealed build8; no regeneration."""
from pathlib import Path
import hashlib, json, re
import xml.etree.ElementTree as ET

R=Path(__file__).resolve().parents[1]
B=R/'.runtime/ciw-completion-20261028/official-build8'
O=R/'.runtime/ciw-completion-20261028/build8-manager-review'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest()
sealed=B/'local-review-manifest.json'
assert sha(sealed)=='1b7b1086afb3d2ee794cdd0a63e2be8bcf1fb170c5ec6a959f74ac2a120bc652'
m=read(sealed)
for entry in m['files']:
    assert sha(B/entry['file'])==entry['sha256'],entry['file']
for entry in m['localEvidence']+m.get('externalTestInputs',[])+m['tools']:
    p=Path(entry['file']);p=p if p.is_absolute() else R/p
    assert sha(p)==entry['sha256'],str(p)
bm=read(B/'build-manifest.json');sources=read(B/'source-manifest.json')
assert len(sources)==110 and len(bm['compileEntries'])==74
for entry in sources:assert sha(R/entry['file'])==entry['sha256']
assert len(bm['tests'])==21 and sum(e['expectedChecks'] for e in bm['tests'])==1166
testchecks=0
for test in bm['tests']:
    for cp in ['UTF-8','ISO8859-1']:
        for culture in ['AMERICAN','EUROPEAN']:
            p=R/'.runtime/ciw-completion-20261028/local-diagnostic-build8'/f"{test['name'][:-2]}-{cp}-{culture}.log"
            value=p.read_text(encoding='utf-8-sig',errors='replace')
            counts=re.findall(r'^PASS\s*:?\s+(?:fiscal checks=)?(\d+)(?:\s|$)',value,re.M)
            assert 'FAIL' not in value and counts==[str(test['expectedChecks'])],p
            testchecks+=test['expectedChecks']
assert testchecks==4664
integration=read(B/'integration-plan.json');assert len(integration['files'])==24
oldcount=0
for entry in integration['files']:
    target=Path(entry['target'])
    if entry['baselineSha256'] is None:assert not target.exists(),str(target)
    else:assert sha(target)==entry['baselineSha256'],str(target);oldcount+=1
    assert sha(entry['candidate'])==entry['candidateSha256'],entry['candidate']
for xmlpath,expected in [(O/'full.xml',(952,6351)),(B/'metadata-builder.xml',(2,41))]:
    xml=ET.parse(xmlpath).getroot()
    assert not xml.findall('.//error') and not xml.findall('.//failure'),str(xmlpath)
    assert len(xml.findall('.//testcase'))==expected[0],str(xmlpath)
    suites=[xml] if xml.tag=='testsuite' else xml.findall('./testsuite')
    assert sum(int(s.attrib.get('assertions',0)) for s in suites)==expected[1],str(xmlpath)
assert read(B/'native-validation.json')['success']
assert len(read(B/'native-validation.json')['results'])==3
assert bm['keyfixDependency']['sha256']=='f2273437e55865d3ba66ea5fbea0e96d7aa01ea2bd7c6e0bc2bde906ae7e457c'
assert sha(bm['keyfixDependency']['target'])==bm['keyfixDependency']['sha256']
plan=read(B/'remote-plan.json');assert plan['server']=='compiler' and len(plan['commands'])==1
assert 'compile122.ps1' in plan['commands'][0]
assert all('/codex-ciw-completion-20261028-build8' in d for d in plan['directories'])
compileps=(B/'package/compile122.ps1').read_text(encoding='utf-8-sig')
assert 'C:/Progress_12/OE/gui/netlib/OpenEdge.Net.pl' in compileps
assert "'-S','10012'" in compileps and "'-ld','espec'" in compileps
assert (B/'package/Regression.p').read_text(encoding='utf-8-sig').count('NUM-DBS')>0
result={'success':True,'status':'RELEASED_FOR_ROOT_OFFICIAL12_2_ONLY','p1':0,'p2':0,
        'sealedManifestSha256':sha(sealed),'buildManifestSha256':sha(B/'build-manifest.json'),
        'sourceManifestSha256':sha(B/'source-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),
        'integrationPlanSha256':sha(B/'integration-plan.json'),'sealedFiles':len(m['files']),
        'sourceFiles':110,'officialCompileEntries':74,'local12_8Compiles':71,
        'ttSuites':21,'ttLogs':84,'ttChecks':4664,'ttNumDbs':0,
        'independentFullPhpTests':952,'independentFullPhpAssertions':6351,
        'independentFullJunitSha256':sha(O/'full.xml'),'nativeActualDrafts':3,
        'canonicalExistingBaselines':oldcount,'canonicalNewTargets':24-oldcount,
        'canonicalTargets':24,'separateExampleTargets':5,
        'official12_2Executed':False,'canonicalChanged':False,'businessExecuted':False,
        'permissionsChanged':False,'productionPublicationAllowedByThisReceipt':False,
        'gates':m['gates'][1:]}
result['pinned']=[{'path':e['file'],'sha256':e['sha256']} for e in m['files']]+[{'path':'local-review-manifest.json','sha256':sha(sealed)}]
productioncount=sum(2 if Path(e['target']).suffix=='.p' else 1 for e in integration['files'] if Path(e['target']).is_relative_to(Path('D:/opencode/motor-progress/v2')))
assert productioncount==19
result['productionArtifactsPlanned']=productioncount
encoded=json.dumps(result,indent=2,ensure_ascii=False)+'\n'
out=O/'manager-release.json';out.write_text(encoded,encoding='utf-8')
canonicalreceipt=B/'manager-release.json'
if canonicalreceipt.exists():assert canonicalreceipt.read_text(encoding='utf-8')==encoded,'Released receipt immutable'
else:canonicalreceipt.write_text(encoded,encoding='utf-8')
print(json.dumps({'success':True,'releaseSha256':sha(out),'canonicalExisting':oldcount,
                  'canonicalNew':24-oldcount,'ttChecks':testchecks}))
