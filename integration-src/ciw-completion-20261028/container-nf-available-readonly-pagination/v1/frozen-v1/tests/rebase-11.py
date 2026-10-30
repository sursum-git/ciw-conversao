from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');P=Path(__file__).resolve().parents[1]
S=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1'
official=W/'.runtime/ciw-completion-20261028/official-build11/canonical-manifest.json'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
receipt=json.loads(official.read_text());assert receipt['success']
for row in receipt['files']:assert sha(Path(row['target']))==row['sha256'],row['target']
refs={Path(row['target']).name:row for row in receipt['files']}
plan=S/'pre-rebase11-patch-plan.json'
if not plan.exists():plan.write_bytes((P/'patches/patch-plan.json').read_bytes())
old_baselines=S/'pre-rebase11-baselines.json'
if not old_baselines.exists():old_baselines.write_bytes((S/'baselines.json').read_bytes())
rows=[]
for rel in ['sursum-api/programs/CiwErpReadService.p','php/RuntimeCiwErpQuery.php','php/RuntimeApiEntityActionService.php']:
 row=refs[Path(rel).name];out=S/'baseline11'/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(Path(row['target']).read_bytes())
 rows.append({'relative':rel,'oldBaselineSha256':sha(S/'baseline'/rel),'baseline11Sha256':sha(out),'officialSource':row['target']})
(S/'rebase11.json').write_text(json.dumps({'success':True,'officialManifestSha256':sha(official),'files':rows,'canonicalWrites':False,'frozen1055Preserved':True},indent=2)+'\n',encoding='utf8')
print(json.dumps({'rebasedBaselines':3,'officialManifestSha256':sha(official),'canonicalWrites':False}))
