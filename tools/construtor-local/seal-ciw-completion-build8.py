"""Seal already verified local build8; never compile, integrate, or publish."""
from pathlib import Path
import hashlib,json,xml.etree.ElementTree as ET

R=Path('D:/opencode/conversao-sc')
B=R/'.runtime/ciw-completion-20261028/official-build8'
L=R/'.runtime/ciw-completion-20261028/local-diagnostic-build8'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest()
def junit_counts(file):
    root=ET.parse(file).getroot()
    # PHPUnit13 leaves totals off testsuites. Direct child suites aggregate
    # their descendants, including classes with both cases and data providers.
    suites=[root] if root.tag=='testsuite' else root.findall('testsuite')
    assert suites,('JUnit contains no top-level suites',file)
    totals={key:sum(int(s.attrib[key]) for s in suites) for key in ['tests','assertions','errors','failures']}
    assert totals['tests']==len(list(root.iter('testcase'))),('JUnit test total mismatch',file)
    return totals
out=B/'local-review-manifest.json'
assert not out.exists(),'Immutable review already sealed; do not regenerate'
verification=read(B/'local-verification.json')
assert verification['status']=='LOCAL_READY_REQUIRES_MANAGER_REVIEW'
assert verification['metadata1047OpenP1'] is False
assert verification['testLogs']==84 and verification['totalTtChecks']==4664
for name in ['php-full.xml','metadata-builder.xml']:
    totals=junit_counts(B/name)
    assert totals['errors']==0 and totals['failures']==0,name
assert read(B/'native-validation.json')['success']
assert len(read(B/'native-validation.json')['results'])==3
bm=read(B/'build-manifest.json')
assert len(bm['compileEntries'])==74 and bm['checksPerCombination']==1166
assert len(read(B/'source-manifest.json'))==110
files=[]
for folder in ['package','backend-stage','metadata','php-tests','test-inputs','example-stage','pre-normalization-companion']:
    for p in sorted((B/folder).rglob('*')):
        if p.is_file():files.append({'file':p.relative_to(B).as_posix(),'sha256':sha(p)})
for p in sorted(B.iterdir()):
    if p.is_file():files.append({'file':p.name,'sha256':sha(p)})
logs=[]
for test in bm['tests']:
    for cp in ['UTF-8','ISO8859-1']:
        for culture in ['AMERICAN','EUROPEAN']:
            for prefix in ['', 'process-']:
                # Process output name retains the .p before the codepage.
                name=(test['name'][:-2] if not prefix else test['name'])+'-'+cp+'-'+culture+'.log'
                p=L/(prefix+name)
                assert p.is_file(),p
                logs.append({'file':str(p.relative_to(R)),'sha256':sha(p)})
for name in ['compile.log','compile-process.log']:
    p=L/name
    if p.exists():logs.append({'file':str(p.relative_to(R)),'sha256':sha(p)})
tools=[]
for name in ['prepare','finalize','verify','seal','compose']:
    suffix='-normalizer' if name=='compose' else ''
    p=R/('tools/construtor-local/'+name+'-ciw-completion-build8'+suffix+'.py')
    tools.append({'file':str(p.relative_to(R)),'sha256':sha(p)})
result={
    'success':True,'state':'LOCAL_READY_REQUIRES_MANAGER_REVIEW_THEN_ROOT_OFFICIAL12_2',
    'verification':verification,'buildManifestSha256':sha(B/'build-manifest.json'),
    'files':files,'localEvidence':logs,'tools':tools,
    'externalTestInputs':[{'file':str(R/'.runtime/ciw-completion-20261028/item-cost-manual/frozen-v1-test-inputs/local/manual-read-actual.json'),'sha256':sha(R/'.runtime/ciw-completion-20261028/item-cost-manual/frozen-v1-test-inputs/local/manual-read-actual.json')}],
    'official12_2Executed':False,'canonicalWrites':False,'businessWrites':False,
    'grants':False,'publicationAllowed':False,
    'gates':['manager release of exact composed bytes','root official12.2:74compiles/1espec schema','84TTlogs/4664checks/NUMDBS0','sameMED PASOE and native runtime','preserve actual API authentication in memory','separate human access/process authorization']
}
out.write_text(json.dumps(result,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
print(json.dumps({'manifest':str(out),'sha256':sha(out),'files':len(files),'evidence':len(logs),'state':result['state']}))
