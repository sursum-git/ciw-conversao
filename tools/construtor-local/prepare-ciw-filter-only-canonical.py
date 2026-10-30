"""Exact seven-file integration of the frozen native navigation capability."""
from pathlib import Path
import base64,hashlib,json,os,sys

ROOT=Path(__file__).resolve().parents[2]
STATE=ROOT/'.runtime/ciw-completion-20261028/filter-only-canonical-integration'
CANDIDATE=ROOT/'integration-src/ciw-completion-20261028/container-item-navigation-filter-only'
CANONICAL=Path('D:/opencode/construtor-pg').resolve()
FREEZE='e2787dfe2f59cb5fd393c75f6db00fab308b93874c2a11317acb188d97bb3b8a'
NATIVE='e8cfe513d69acf9805ffdac30ba1a5afb3ca71f84e51bb0aed81b97ea18b03d6'
FILES=['backend/src/Builder/ProgramBuilderService.php','src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudEngine.js','src/crud-engine/CrudKendoFormRenderer.js','public/metadata/schemas/crud-definition-v1.schema.json','docs/paridade-demo-producao.md']
load=lambda p:json.loads(p.read_bytes())
digest=lambda b:hashlib.sha256(b).hexdigest()
sha=lambda p:digest(p.read_bytes())
def write_new(path,value):
    path.parent.mkdir(parents=True,exist_ok=True)
    with path.open('xb') as stream:stream.write((json.dumps(value,ensure_ascii=False,indent=2)+'\n').encode())

def exact_patch(before,patch,candidate):
    assert digest(before)==patch['baselineSha256']
    offset=0;parts=[]
    for edit in patch['edits']:
        start,end=edit['start'],edit['end']
        assert offset<=start<=end<=len(before)
        assert before[start:end]==base64.b64decode(edit['beforeBase64'],validate=True)
        parts.extend([before[offset:start],base64.b64decode(edit['afterBase64'],validate=True)])
        offset=end
    parts.append(before[offset:]);after=b''.join(parts)
    assert after==candidate and digest(after)==patch['candidateSha256']
    for unchanged in patch['unchangedByteRanges']:
        start,newstart,size=unchanged['baselineStart'],unchanged['candidateStart'],unchanged['bytes']
        assert before[start:start+size]==after[newstart:newstart+size]
        assert digest(before[start:start+size])==unchanged['sha256']
    return after

def inputs():
    manifest_path=CANDIDATE/'frozen-v1/manifest.json';assert sha(manifest_path)==FREEZE
    manifest=load(manifest_path)
    pinned={str(Path(x['path']).resolve()):x['sha256'] for x in manifest['files']}
    native=ROOT/'.runtime/ciw-completion-20261028/build13-native-metadata-verification/runtime-read-proof.json'
    assert sha(native)==NATIVE
    assert load(native)['success'] and load(native)['readOnly']
    result=[]
    for relative in FILES:
        target=(CANONICAL/relative).resolve();assert target.is_relative_to(CANONICAL)
        patch_path=CANDIDATE/'patches'/(relative.replace('/','__')+'.bytepatch.json')
        candidate_path=CANDIDATE/'candidate'/relative
        for path in [patch_path,candidate_path]:assert sha(path)==pinned[str(path.resolve())]
        patch=load(patch_path);assert patch['relative']==relative and Path(patch['canonical']).resolve()==target
        before=target.read_bytes();after=exact_patch(before,patch,candidate_path.read_bytes())
        result.append(dict(relative=relative,target=str(target),baselineSha256=digest(before),candidateSha256=digest(after),patchPath=str(patch_path),patchSha256=sha(patch_path),candidatePath=str(candidate_path),candidateFileSha256=sha(candidate_path),hunks=len(patch['edits'])))
    return manifest_path,native,result

def prepare():
    assert not STATE.exists(),'PRESERVE_EXISTING_PREPARATION'
    manifest,native,files=inputs()
    plan=dict(state='PREPARED_ROOT_REVIEW_COMPOSITION13_REQUIRED',toolSha256=sha(Path(__file__)),candidateManifest=dict(path=str(manifest),sha256=FREEZE),native13Proof=dict(path=str(native),sha256=NATIVE),files=files,canonicalSources=6,documentation=1,businessWrites=False,apiAbiChanged=False,ablChanged=False,replay='No automatic replay; inspect partial journal and restore only exact owned bytes if required.')
    write_new(STATE/'plan.json',plan)
    print(json.dumps(dict(success=True,prepared=True,files=7,planSha256=sha(STATE/'plan.json'),canonicalWrites=False)))

def apply():
    plan_path=STATE/'plan.json';plan=load(plan_path);release=load(STATE/'manager-release.json')
    assert release['success'] and release['purpose']=='FILTER_ONLY_CURRENT13_CANONICAL'
    assert release['canonicalPlanSha256']==sha(plan_path) and release['canonicalToolSha256']==sha(Path(__file__))==plan['toolSha256']
    assert release['candidateManifestSha256']==FREEZE and release['native13ProofSha256']==NATIVE
    proof=Path(release['localCompositionProof']['path']).resolve()
    assert proof.is_relative_to((ROOT/'.runtime').resolve()) and sha(proof)==release['localCompositionProof']['sha256'] and load(proof)['success']
    assert not (STATE/'attempt.json').exists(),'NO_REPLAY'
    _,_,current=inputs();assert current==plan['files'],'WHOLE_CURRENT_BASELINES_REQUIRED'
    prepared=[]
    for index,row in enumerate(current):
        target=Path(row['target']);before=target.read_bytes();after=exact_patch(before,load(Path(row['patchPath'])),Path(row['candidatePath']).read_bytes())
        backup=STATE/'backups'/f'{index}-{target.name}.before';backup.parent.mkdir(parents=True,exist_ok=True);backup.write_bytes(before)
        assert backup.read_bytes()==before
        prepared.append((row,target,before,after,str(backup)))
    journal=dict(state='STARTED',canonicalPlanSha256=sha(plan_path),managerReleaseSha256=sha(STATE/'manager-release.json'),written=[],businessWrites=False)
    write_new(STATE/'attempt.json',journal)
    for row,target,before,after,backup in prepared:
        assert target.read_bytes()==before,'CONCURRENT_CHANGE_NO_OVERWRITE'
        temporary=target.with_name(target.name+'.ciw-filter-only.pending')
        with temporary.open('xb') as stream:stream.write(after)
        assert temporary.read_bytes()==after
        assert target.read_bytes()==before,'CONCURRENT_CHANGE_NO_OVERWRITE'
        os.replace(temporary,target)
        assert target.read_bytes()==after
        journal['written'].append(dict(**row,backup=backup))
        (STATE/'attempt.json').write_bytes((json.dumps(journal,ensure_ascii=False,indent=2)+'\n').encode())
    journal['state']='COMPLETED'
    (STATE/'attempt.json').write_bytes((json.dumps(journal,ensure_ascii=False,indent=2)+'\n').encode())
    write_new(STATE/'canonical-manifest.json',dict(success=True,files=journal['written'],canonicalPlanSha256=sha(plan_path),managerReleaseSha256=sha(STATE/'manager-release.json'),businessWrites=False,apiAbiChanged=False,ablChanged=False,metadataPublished=False))
    print('PASS exact filterOnly canonical integration:6sources+1doc; backups and journal retained; metadata NOT published')

if __name__=='__main__':
    assert sys.argv[1:] in [['--prepare'],['--apply-reviewed']]
    prepare() if sys.argv[1:] == ['--prepare'] else apply()
