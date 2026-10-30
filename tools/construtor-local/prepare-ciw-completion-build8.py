"""Compose reviewed1047/1051/1052 locally over integrated7. Never performs network."""
from pathlib import Path
import json,hashlib,difflib,shutil,sys,re
R=Path('D:/opencode/conversao-sc');M=Path('D:/opencode/motor-progress/v2');F=Path('D:/opencode/construtor-pg');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build8';OLD=S/'official-build7'
SEL=S/'container-expense-default-selection/frozen-v1.2';REV=S/'container-version-history/review1047v1.2';MAN=S/'item-cost-manual/frozen-v1';SAMPLE=R/'integration-src/ciw-completion-20261028/sample-container-items-readonly/frozen-v1';TYPE=SAMPLE.parent/'operation-type-fix/frozen-v1';EX=S/'native-process-dependent-options-example/frozen-v1'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest()
digest=lambda b:hashlib.sha256(b).hexdigest()
def save(p,v):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
packages=[]
for p,h in [(SEL,'ed0cc7a801afe2e75d086d61a94972f6d6102514595f3a049689989619631dee'),(REV/'exact-action-fix','a355db0dc18d5e8fe790c6d50070e04d21ea99170cca789dd41e0e362c725238'),(SAMPLE,'cf8ffcdc871acf3ea3c11b643cffb4523f1255b1c354e18aa3ecba9472224f04'),(TYPE,'47685a7f0920b3e504e28eb4defc3e1eac14056dd98dede6a8d70bc4e24f6606'),(EX,'4876279c9a6b478b89c67f8b0cb0ef7c68ba9817e9789b5a1f68637caf4f04f3')]:
 assert sha(p/'manifest.json')==h,str(p)
 for x in read(p/'manifest.json')['files']:assert sha(p/x['path'])==x['sha256'],str(p/x['path'])
 packages.append({'path':str(p),'manifestSha256':h})
mm=read(MAN/'manifest.json');assert sha(MAN/'manifest.json')=='5cabfe5a1464ebbc242f0bd580daa0c4017fda40999e33a959e2e5f04d0c352d'
for x in mm['files']:assert sha(MAN/x['path'])==x['sha256']
packages.append({'path':str(MAN),'manifestSha256':sha(MAN/'manifest.json')})
for rel in ['container-expense-default-selection/freeze-v1.2.json','item-cost-manual/freeze-v1.json']:
 f=read(S/rel)
 for x in f['testInputFiles']:assert sha(Path(f['testInputsSnapshot'])/x['path'])==x['sha256']
keyfix=read(OLD/'canonical-keyfix-manifest.json');assert keyfix['success'] and keyfix['sha256']=='f2273437e55865d3ba66ea5fbea0e96d7aa01ea2bd7c6e0bc2bde906ae7e457c';assert sha(keyfix['target'])==keyfix['sha256']
selmaps=read(REV/'selection-exact-maps.json');manual=read(S/'item-cost-manual/manager-reviewed/review-inputs.json')['exactSharedCandidates'];sample=read(SAMPLE/'baselines.json')['baselines'];grouped={}
for items,kind in [(selmaps['shared'],'1047'),(manual,'1051'),(sample,'1052')]:
 for x in items:
  target=Path(x['target']);candidate=Path(x['candidatePath'])if kind=='1047'else Path(x['exactCandidate'])if kind=='1051'else SAMPLE/'candidate-exact'/target.name
  assert sha(target)==x['baselineSha256'];assert sha(candidate)==x['candidateSha256'];grouped.setdefault(target,[]).append({'kind':kind,'candidate':candidate,'sha256':x['candidateSha256']})
format_ignored=[]
def edits(base,value):
 old=base.splitlines(keepends=True);new=value.splitlines(keepends=True)
 return [(i,j,b''.join(new[x:y]))for op,i,j,x,y in difflib.SequenceMatcher(None,old,new,autojunk=False).get_opcodes()if op!='equal']
if '--analyze' in sys.argv:
 for target,values in grouped.items():
  if len(values)>1:print(target.name,json.dumps([{'kind':v['kind'],'edits':[(i,j,len(b),b[:85].decode('utf-8'))for i,j,b in edits(target.read_bytes(),v['candidate'].read_bytes())]}for v in values]))
 sys.exit(0)
assert not B.exists(),'Build8 stage already exists; never regenerate released inputs'
for x in read(OLD/'source-manifest.json'):assert sha(R/x['file'])==x['sha256']
for x in read(OLD/'canonical-manifest.json')['files']:
 assert sha(x['target'])==(keyfix['sha256']if str(Path(x['target']))==str(Path(keyfix['target']))else x['sha256']),str(x['target'])
P=B/'package';BACK=B/'backend-stage';shutil.copytree(OLD/'package',P,ignore=shutil.ignore_patterns('*.r','*.log'));BACK.mkdir();integration=[];composition=[]
def put(target,value,baseline=None):
 before=sha(target)if target.exists()else None
 if baseline is not None:assert before==baseline,str(target)
 dest=P/target.relative_to(M)if target.is_relative_to(M)else BACK/target.relative_to(F);dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(value)
 integration.append({'target':str(target),'baselineSha256':before,'candidate':str(dest),'candidateSha256':sha(dest)})
def merge(target,values):
 base=target.read_bytes();lines=base.splitlines(keepends=True);groups={}
 for v in values:
  for i,j,b in edits(base,v['candidate'].read_bytes()):
   old=b''.join(lines[i:j])
   if old.replace(b'\r\n',b'\n')==b.replace(b'\r\n',b'\n'):
    format_ignored.append({'file':target.name,'domain':v['kind'],'baseLineStart':i+1,'baseLineEndExclusive':j+1,'reason':'format-only normalization ignored; original7 bytes retained','baselineSha256':digest(old),'ignoredCandidateSha256':digest(b)});continue
   groups.setdefault((i,j),[]).append((v['kind'],b))
 changes=[]
 for (i,j),items in sorted(groups.items()):
  old=b''.join(lines[i:j]);vs=[x[1]for x in items]
  if len(vs)==1:new=vs[0];kind='single reviewed exact delta'
  elif i==j:new=b''.join(vs);kind='closed disjoint additions at same anchor'
  elif target.name=='RuntimeCiwErpQuery.php'and b'private const RESOURCES=['in old:
   head,tail=old.split(b'private const RESOURCES=[',1);prefix=head+b'private const RESOURCES=[';parts=[]
   for v in vs:assert v.startswith(prefix)and v.endswith(tail);parts.append(v[len(prefix):-len(tail)])
   new=prefix+b''.join(parts)+tail;kind='two disjoint new resource map entries'
  else:raise AssertionError(('Unreviewed overlapping replacement',target.name,i,j,[x[0]for x in items]))
  changes.append((i,j,new));composition.append({'file':target.name,'baseLineStart':i+1,'baseLineEndExclusive':j+1,'domains':[x[0]for x in items],'kind':kind,'oldSha256':digest(old),'newSha256':digest(new)})
 result=b'';cursor=0
 for i,j,new in changes:assert i>=cursor,('overlapping ranges',target.name,i,j,cursor);result+=b''.join(lines[cursor:i])+new;cursor=j
 result+=b''.join(lines[cursor:]);return result
for target,values in grouped.items():put(target,merge(target,values),sha(target))
for x in selmaps['newSources']:assert not Path(x['target']).exists();put(Path(x['target']),Path(x['candidatePath']).read_bytes())
for x in mm['newSources']:assert not Path(x['target']).exists();put(Path(x['target']),(MAN/x['source']).read_bytes())
for folder,targetdir in [('abl',M/'sursum-api/programs'),('includes',M/'sursum-api/includes'),('php',F/'backend/src/Runtime')]:
 for f in (SAMPLE/folder).glob('*'):
  if f.is_file():assert not (targetdir/f.name).exists();put(targetdir/f.name,f.read_bytes())
# Existing central tests/wrappers are replaced by the selected richer fixture, never added twice.
SELINPUT=S/'container-expense-default-selection/frozen-v1.2-test-inputs/local';MANINPUT=S/'item-cost-manual/frozen-v1-test-inputs/local'
for f in ['ContainersImpostosService.p','ContainersProcessosService.p','ContainersImpostosTest.p','ContainersSelectionRootTest.p']:(P/f).write_bytes((SELINPUT/f).read_bytes())
for f in ['SelectedExpenseDefaultsTests.i','SelectionRootTests.i']:(P/f).write_bytes((SEL/'tests'/f).read_bytes())
(P/'ItemCostManualReadTest.p').write_bytes((MANINPUT/'ItemCostManualReadTest.p').read_bytes())
for f in (SAMPLE/'tests/abl').glob('*'):(P/f.name).write_bytes(f.read_bytes())
assert sha(P/'sursum-api/programs/ContainersVersionHistoryLabels.p')=='9bfe21dc6ff9d86105d7602d376a2adc3cc3b9fe61783a68f7d1cd03f9d100bb'
bm=read(OLD/'build-manifest.json');tests=[]
for t in bm['tests']:tests.append({**t,'expectedChecks':222}if t['name']=='ContainersImpostosTest.p'else t)
tests += [{'name':'ContainersSelectionRootTest.p','output':'containers-selection-root-tests-{culture}.log','expectedChecks':15},{'name':'ItemCostManualReadTest.p','output':'item-manual-{culture}.log','expectedChecks':24},{'name':'SampleContainerItemsTest.p','output':'sample-tests.log','expectedChecks':35}]
assert len({t['name']for t in tests})==len(tests)==21;assert sum(t['expectedChecks']for t in tests)==1166
classes=[n for n in bm['compileEntries']if n.endswith('.cls')];entries=classes+sorted(p.relative_to(P).as_posix()for p in P.rglob('*.p')if p.name not in ['Compile.p','Regression.p']);assert len(entries)==74
oldremote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build7';remote=oldremote.replace('build7','build8')
compile=(OLD/'package/Compile.p').read_text(encoding='utf-8').replace(oldremote,remote);compile=re.sub(r'INITIAL "[^"]+"','INITIAL "'+','.join(entries)+'"',compile,count=1);(P/'Compile.p').write_text(compile,encoding='utf-8');(P/'Regression.p').write_text((OLD/'package/Regression.p').read_text(encoding='utf-8').replace(oldremote,remote),encoding='utf-8')
ps=(OLD/'package/compile122.ps1').read_text(encoding='utf-8').split("foreach($cp in @('UTF-8','ISO8859-1'))")[0].replace(oldremote,remote);ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n";logs=[]
for t in tests:
 name=t['name'];origin="('"+t['output'].replace('{culture}',"'+$culture+'")+"')"
 ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n"
 ps+="$proof=Get-Content -LiteralPath "+origin+" -Raw;if($proof -notmatch 'PASS' -or $proof -match 'FAIL'){throw 'Assertion proof failed: "+name+"'}\nCopy-Item -LiteralPath "+origin+" -Destination ('"+name[:-2]+"-'+$cp+'-'+$culture+'.log')\n"
 logs += [name[:-2]+'-'+cp+'-'+culture+'.log'for cp in ['UTF-8','ISO8859-1']for culture in ['AMERICAN','EUROPEAN']]
ps+="}}\nWrite-Output 'Official12.2 build8 TT executed; inspect84proofs/1166eachcombination'\n} catch {Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n";(P/'compile122.ps1').write_text(ps,encoding='utf-8')
# More frontend/metadata and PHP verification are appended by the staging finalizer.
save(B/'composition-proof.json',{'status':'EXACT_BYTE_HUNKS_COMPOSED','outsideHunks':'Stable7 byte slices, no newline normalization','hunks':composition,'formatOnlyDeltasIgnored':format_ignored})
save(B/'integration-plan.json',{'files':integration,'canonicalWrites':False,'catalogWrites':False,'grants':0})
save(B/'test-list.json',[{**t,'sourceSha256':sha(P/t['name'])}for t in tests])
save(B/'build-manifest.json',{'state':'PREPARED_NOT_EXECUTED_REQUIRES_MANAGER_REVIEW','packages':packages,'compileEntries':entries,'tests':tests,'checksPerCombination':1166,'testLogs':84,'compileDatabaseConnections':1,'testDatabaseConnections':0,'keyfixDependency':keyfix,'canonicalWrites':False,'remoteExecuted':False,'publicationAllowed':False,'excluded':['annex product','grants','DDL','positive business execution']})
print(json.dumps({'build':str(B),'compileEntries':len(entries),'sourceFilesBeforeHarnessManifest':len([p for p in P.rglob('*')if p.is_file()]),'tests':21,'checksPerCombination':1166,'logs':84,'integrationFiles':len(integration),'state':'PREPARED'}))
