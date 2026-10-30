"""Inspect known preserved trigger deployment and aliases, read-only, no re-publication."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight';b=s/'cleanup-runtime';b.mkdir(exist_ok=True);stage='/tmp/ciw-completion-20261028-cleanup-ro'
old=json.loads((r/'.runtime/container-delete-compat-publish-20261016/active-manifest.json').read_text());assert len(old['artifacts'])==8 and len(old['aliases'])==2
for rel,digest in old['artifacts'].items():
 if rel.endswith('.p'):assert hashlib.sha256((Path('D:/opencode/motor-progress/v2')/rel).read_bytes()).hexdigest()==digest
script='''from pathlib import Path
import hashlib,json,subprocess
root=Path('/mnt/datasul/ERP/sursum');stage=Path(STAGE)
assert '192.168.0.137' in subprocess.check_output(['findmnt','-n','-o','SOURCE','-T',str(root)],universal_newlines=True)
approved=ARTIFACTS;aliases=ALIASES
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
artifacts={rel:{'sha256':sha(root/rel),'matchesPreservedDeployment':sha(root/rel)==digest}for rel,digest in approved.items()}
aliasProof={}
for name,dest in aliases.items():
 p=Path(name);target=Path(dest);aliasProof[name]={'isSymlink':p.is_symlink(),'resolvedExpected':str(p.resolve())==str(target),'sha256':sha(p) if p.is_file() else None}
 assert p.is_symlink() and str(p.resolve())==str(target) and p.is_file(),'Preserved trigger alias changed'
 assert sha(p)==approved[str(target.relative_to(root))]
assert all(x['matchesPreservedDeployment']for x in artifacts.values()),'Runtime artifacts diverged'
props=Path('/dados/pasoe/sursum-api/conf/openedge.properties').read_text()
lines=[line for line in props.splitlines() if 'PROPATH' in line.upper()]
(stage/'propath-diagnostic.json').write_text(json.dumps({'propathLines':lines,'artifactsVerified':True,'aliasesVerified':True},indent=2))
med=[line for line in lines if line.startswith('PROPATH=') and '${CATALINA_BASE}/webapps/med/WEB-INF/openedge' in line]
if not(len(med)==1 and med[0].split('=',1)[1].split(',')[0]=='${CATALINA_BASE}/webapps/med/WEB-INF/openedge'):
 print('PROPATH_FORMAT_UNCLASSIFIED:8artifact hashes/2aliases matched; inspect diagnostic before claiming closure');raise SystemExit(0)
out={'success':True,'instance':'sursum-api','context':'med','artifacts':artifacts,'aliases':aliasProof,'preservedMedSearchDirectoryFirst':True,'triggerDefinitionChanged':False,'triggersExecuted':False,'businessWrites':False,'currentDeletionExecuted':False,'evidence':'Current exact8artifact hashes and2MEDaliases match preserved16Oct deployment; latest prior authorized cleanup26Oct; never disable or bypass'}
(stage/'cleanup-runtime-proof.json').write_text(json.dumps(out,indent=2));print('PASS8preserved trigger/header artifact hashes and2MEDaliases; no runtime mutation or trigger execution')
'''.replace('STAGE',repr(stage)).replace('ARTIFACTS',repr(old['artifacts'])).replace('ALIASES',repr(old['aliases']))
(b/'inspect.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((b/'inspect.py').relative_to(r)),remote=stage+'/inspect.py')],commands=['python3 '+stage+'/inspect.py'],downloads=[dict(local=str((b/'cleanup-runtime-proof.json').relative_to(r)),remote=stage+'/cleanup-runtime-proof.json',optional=True),dict(local=str((b/'propath-diagnostic.json').relative_to(r)),remote=stage+'/propath-diagnostic.json')]);(b/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared readonly inspection of known preserved8artifacts/2aliases only')
