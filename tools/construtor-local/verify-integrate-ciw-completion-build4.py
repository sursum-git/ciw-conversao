"""Verify official fix evidence, integrate one source, prepare guarded2file publish."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];old=r/'.runtime/ciw-completion-20261028/official-build3';b=r/'.runtime/ciw-completion-20261028/official-build4';sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));save=lambda n,v:(b/n).write_text(json.dumps(v,indent=2)+'\n')
assert not(b/'canonical-manifest.json').exists(),'Already integrated'
m=load(b/'build-manifest.json')
for x in m['files']:assert sha(r/x['file'])==x['sha256']
log=(b/'compiled122/compile.log').read_text();assert log.startswith('OpenEdge 12.2 NUMDBS=0') and log.count('COMPILER:ERROR=no')==2 and log.rstrip().endswith('PASS COMPILE ALL') and 'FAIL'not in log
assert not(b/'compiled122/compile-process.log').read_text().strip()
checks=[]
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  p=b/f'compiled122/history-{cp}-{culture}.log';assert p.read_text().strip()=='PASS 32 NUMDBS=0';checks.append(dict(file=str(p.relative_to(r)),sha256=sha(p)))
source=b/'package/sursum-api/programs/ContainersVersionHistoryService.p';compiled=b/'compiled122/sursum-api/programs/ContainersVersionHistoryService.r';assert compiled.stat().st_size>0 and sha(source)==m['candidateServiceSha256']
files=[dict(relative='sursum-api/programs/'+p.name,file=p.name,source=str(p.relative_to(r)),sha256=sha(p))for p in [source,compiled]]
save('official-compile-verification.json',dict(success=True,version='12.2',compileEntries=2,testLogs=4,testsPerCombination=32,totalChecks=128,files=files,checks=checks,databaseConnections=0,abiChanged=False))
review=r/'.runtime/ciw-completion-20261028/container-version-history/manager-review-final-v1.4.json';assert load(review)['success'] and load(review)['remainingP1P2']==[];save('review-final.json',dict(success=True,reviewSha256=sha(review),remainingP1P2=[]))
target=Path('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionHistoryService.p');assert sha(target)==m['baselineServiceSha256'];shutil.copy2(target,b/'canonical-service-before.p');shutil.copyfile(source,target);assert sha(target)==sha(source)
save('canonical-manifest.json',dict(success=True,target=str(target),before=m['baselineServiceSha256'],sha256=sha(target),businessWrites=False))
stage='/tmp/ciw-completion-20261028-parent404';before=load(old/'active-manifest.json')['targets'];targets={x['relative']:dict(file=x['file'],sha256=x['sha256'],before=before[x['relative']]['sha256'])for x in files};save('publication-manifest.json',dict(success=True,targets=targets,businessWrites=False))
script=(old/'publish-runtime.py').read_text().replace('ciw-completion-20261028-wave1','ciw-completion-20261028-parent404').replace("proof['testsPerCombination']==384","proof['testsPerCombination']==32").replace("len(approved)==15 and len(m['targets'])==15","len(approved)==2 and len(m['targets'])==2").replace('.completion-wave1-tmp','.completion-parent404-tmp').replace('PASS15 reviewed','PASS2 reviewed');(b/'publish-runtime.py').write_text(script)
(b/'refresh-runtime.py').write_text((old/'refresh-runtime.py').read_text().replace('ciw-completion-20261028-wave1','ciw-completion-20261028-parent404'))
uploads=[dict(local=x['source'],remote=stage+'/'+x['file'])for x in files]
for name in ['official-compile-verification.json','publication-manifest.json','review-final.json','publish-runtime.py','refresh-runtime.py']:uploads.append(dict(local=str((b/name).relative_to(r)),remote=stage+'/'+name))
save('publish-plan.json',dict(server='runtime',directories=[stage],uploads=uploads,commands=['python3 '+stage+'/publish-runtime.py'],downloads=[dict(local=str((b/'active-manifest.json').relative_to(r)),remote=stage+'/active-manifest.json')]))
save('refresh-plan.json',dict(server='runtime',commands=['python3 '+stage+'/refresh-runtime.py'],downloads=[dict(local=str((b/n).relative_to(r)),remote=stage+'/'+n)for n in ['jmx-inspection.json','med-session-refresh.json']]))
print('PASS official128checks/2compiles;onecanonicalsource integrated;twoartifact guardedpublication prepared')
