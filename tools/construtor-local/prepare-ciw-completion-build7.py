"""Compose only immutable readonly1045/46/49/50 over official6. Never executes network."""
from pathlib import Path
import hashlib,json,difflib,shutil,re,sys
R=Path('D:/opencode/conversao-sc');M=Path('D:/opencode/motor-progress/v2');F=Path('D:/opencode/construtor-pg');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build7';OLD=S/'official-build6-v2'
D=R/'integration-src/ciw-completion-20261028/import-discounts-readonly/frozen-v1.2';E=R/'integration-src/ciw-completion-20261028/cost-distribution-readonly/frozen-op1049-v1';L=R/'integration-src/ciw-completion-20261028/cost-distribution-readonly/ledger-item/frozen-v1'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
def save(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
packages=[]
for p,h in [(D,'dbda7516d088f2a7504105576b3527d4a333a612128d498ab93e9641cd12eb68'),(E,'bb2cac82165aba527e411314ab1d490b372b1514a8355212b727ade12431badd'),(L,'b06964fb60247726f35c04bf3e19622aa951f792b099ea6694c906f89bac376d')]:
 assert sha(p/'manifest.json')==h
 m=load(p/'manifest.json')
 for e in m['files']:assert sha(p/e['path'])==e['sha256'],str(p/e['path'])
 packages.append({'path':str(p),'manifestSha256':h})
sets=[load(D/'baselines.json')['baselines']]
for code in [1049,1050]:sets.append(load(S/f'cost-distribution-readonly/manager-reviewed-{code}/manager-review.json')['exactSharedCandidates'])
def candidates(name):
 result=[]
 for n,items in enumerate(sets):
  e=next(e for e in items if Path(e['target']).name==name);target=Path(e['target']);assert sha(target)==e['baselineSha256']
  p=D/e['exactCandidate'] if n==0 else Path(e['exactCandidate']);assert sha(p)==e['candidateSha256'];result.append(p.read_bytes())
 return target,result
def edits(base,value):
 old=base.splitlines(keepends=True);new=value.splitlines(keepends=True)
 return [(i,j,b''.join(new[x:y])) for op,i,j,x,y in difflib.SequenceMatcher(None,old,new,autojunk=False).get_opcodes() if op!='equal']
if '--analyze' in sys.argv:
 for name in ['CiwErpReadService.p','CiwCadastrosCrud.p','RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']:
  target,values=candidates(name);base=target.read_bytes();print(name,[(i,j,len(v),v[:115]) for x in values for i,j,v in edits(base,x)])
 sys.exit(0)
assert not B.exists(),'Immutable build7 exists; do not overwrite'
for e in load(OLD/'source-manifest.json'):assert sha(R/e['file'])==e['sha256']
for e in load(OLD/'canonical-manifest.json')['files']:assert sha(Path(e['target']))==e['sha256'],e['target']
P=B/'package';BACK=B/'backend-stage';shutil.copytree(OLD/'package',P,ignore=shutil.ignore_patterns('*.r','*.log'));BACK.mkdir()
integration=[];composition=[]
def put(target,value,baseline=None):
 before=sha(target) if target.exists() else None
 if baseline is not None:assert before==baseline,str(target)
 dest=P/target.relative_to(M) if target.is_relative_to(M) else BACK/target.relative_to(F)
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(value)
 integration.append({'target':str(target),'baselineSha256':before,'candidate':str(dest),'candidateSha256':sha(dest)})
def merge(name,base,values):
 lines=base.splitlines(keepends=True);groups={}
 for value in values:
  for i,j,v in edits(base,value):groups.setdefault((i,j),[]).append(v)
 changes=[]
 for (i,j),vs in sorted(groups.items()):
  old=b''.join(lines[i:j])
  if i==j:new=b''.join(vs);kind='disjoint closed additions at same insertion point'
  elif name=='RuntimeCiwErpQuery.php' and b'private const RESOURCES=[' in old:
   head,tail=old.split(b'private const RESOURCES=[',1);prefix=head+b'private const RESOURCES=[';parts=[]
   for v in vs:assert v.startswith(prefix) and v.endswith(tail);parts.append(v[len(prefix):-len(tail)])
   new=prefix+b''.join(parts)+tail;kind='four disjoint resource-map entries'
  elif name=='RuntimeCiwErpQuery.php' and b'if (in_array' in old:
   tail=old.replace(b'        if (in_array',b'        } elseif (in_array',1);parts=[]
   for n,v in enumerate(vs):
    assert v.endswith(tail);part=v[:-len(tail)]
    if n:assert part.startswith(b'        if (');part=part.replace(b'        if (',b'        } elseif (',1)
    parts.append(part)
   new=b''.join(parts)+tail;kind='closed mutually exclusive context branches'
  elif name=='RuntimeApiEntityActionService.php' and b'$context = ApiRequestContext::resolve' in old:
   prefix,rest=old.split(b'$context = ',1);prefix+=b'$context = ';eol=b'\r\n' if rest.endswith(b'\r\n') else b'\n';expression=rest[:-len(eol)-1];parts=[]
   for v in vs:
    assert v.startswith(prefix) and v.endswith(b' : '+expression+b';'+eol);parts.append(v[len(prefix):-len(b' : '+expression+b';'+eol)])
   nested=expression
   for part in reversed(parts):nested=part+b' : ('+nested+b')'
   new=prefix+nested+b';'+eol;kind='explicit parenthesized GET-context alternatives'
  else:raise AssertionError(('Unreviewed replacement overlap',name,i,j))
  changes.append((i,j,new));composition.append({'file':name,'baseLineStart':i+1,'baseLineEndExclusive':j+1,'parts':len(vs),'kind':kind,'oldSha256':hashlib.sha256(old).hexdigest(),'newSha256':hashlib.sha256(new).hexdigest()})
 # Bytes outside the enumerated base ranges are copied verbatim, including mixed endings.
 result=b'';last=0
 for i,j,new in changes:assert i>=last;result+=b''.join(lines[last:i])+new;last=j
 return result+b''.join(lines[last:])
for name in ['CiwErpReadService.p','CiwCadastrosCrud.p','RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']:
 target,values=candidates(name);put(target,merge(name,target.read_bytes(),values),sha(target))
for pkg in [D,E,L]:
 for folder,destbase in [('abl',M/'sursum-api/programs'),('includes',M/'sursum-api/includes'),('php',F/'backend/src/Runtime')]:
  for f in sorted((pkg/folder).glob('*')):
   if f.is_file():assert not (destbase/f.name).exists(),'Unexpected production overwrite '+f.name;put(destbase/f.name,f.read_bytes())
 for f in (pkg/'tests/abl').glob('*'):
  if f.name=='ImportDiscountsLabelsTest.p':assert (P/f.name).read_bytes()==f.read_bytes(),'Shared17-check label suite changed';continue
  if f.is_file():assert not (P/f.name).exists(),'Test collision '+f.name;(P/f.name).write_bytes(f.read_bytes())
# Existing helpers stay byte-identical to official6. No old helper overlay is installed.
assert sha(P/'sursum-api/programs/ContainersVersionHistoryLabels.p')=='9bfe21dc6ff9d86105d7602d376a2adc3cc3b9fe61783a68f7d1cd03f9d100bb'
bm=load(OLD/'build-manifest.json');tests=bm['tests']+[
 {'name':'ImportDiscountsCollectorTest.p','output':'collector-tests.log','expectedChecks':18},
 {'name':'ImportDiscountsReadTest.p','output':'read-tests.log','expectedChecks':44},
 {'name':'CostDistributionEligibleTest.p','output':'eligible-tests.log','expectedChecks':33},
 {'name':'CostDistributionLedgerTest.p','output':'ledger-tests.log','expectedChecks':31}]
assert sum(t['expectedChecks'] for t in tests)==1030 and len(tests)==18
classes=[n for n in bm['compileEntries'] if n.endswith('.cls')]
entries=classes+sorted(p.relative_to(P).as_posix() for p in P.rglob('*.p') if p.name not in ['Compile.p','Regression.p'])
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build7'
oldremote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build6-v2'
compile=(OLD/'package/Compile.p').read_text(encoding='utf-8').replace(oldremote,remote)
compile=re.sub(r'INITIAL "[^"]+"','INITIAL "'+','.join(entries)+'"',compile,count=1);(P/'Compile.p').write_text(compile,encoding='utf-8')
(P/'Regression.p').write_text((OLD/'package/Regression.p').read_text(encoding='utf-8').replace(oldremote,remote),encoding='utf-8')
ps=(OLD/'package/compile122.ps1').read_text(encoding='utf-8').split("foreach($cp in @('UTF-8','ISO8859-1'))")[0].replace(oldremote,remote)
ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n";logs=[]
for t in tests:
 name=t['name'];origin="('"+t['output'].replace('{culture}',"'+$culture+'")+"')"
 ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n"
 ps+="$proof=Get-Content -LiteralPath "+origin+" -Raw;if($proof -notmatch 'PASS' -or $proof -match 'FAIL'){throw 'Assertion proof failed: "+name+"'}\nCopy-Item -LiteralPath "+origin+" -Destination ('"+name[:-2]+"-'+$cp+'-'+$culture+'.log')\n"
 logs += [name[:-2]+'-'+cp+'-'+culture+'.log' for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]
ps+="}}\nWrite-Output 'Official12.2 build7 readonly TT executed; inspect all proofs'\n} catch {Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n";(P/'compile122.ps1').write_text(ps,encoding='utf-8')
# Full backend suite loads composed classes first, plus current stable audit/batch/Builder.
for rel in ['Runtime/RuntimeContainerAudit.php','Runtime/RuntimeContainerTaxAudit.php','Runtime/RuntimeContainerExpenseBatch.php','Runtime/RuntimeProgressAuditSchema.php','Builder/ProgramBuilderService.php']:
 src=F/'backend/src'/rel;dest=BACK/'backend/src'/rel;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(src.read_bytes())
for pkg,key in [(D,'discounts'),(E,'eligible'),(L,'ledger')]:
 dest=B/'php-tests'/key;shutil.copytree(pkg/'metadata',dest/'metadata');(dest/'tests').mkdir()
 for f in (pkg/'tests').glob('*IntegrationTest.php'):shutil.copyfile(f,dest/'tests'/f.name)
bootstrap="<?php\nrequire 'D:/opencode/construtor-pg/backend/vendor/autoload.php';\nspl_autoload_register(static function(string $class):void { if(str_starts_with($class,'App\\\\')) { $file='"+str(BACK/'backend/src').replace('\\','/')+"/'.str_replace('\\\\','/',substr($class,4)).'.php';if(is_file($file))require $file;} },true,true);\n"
(B/'php-bootstrap.php').write_text(bootstrap,encoding='utf-8')
sourcePath=S/'source-132-current-after6.json';source=load(sourcePath);assert len(source['operations'])==132;ops=[]
for pkg in [D,E,L]:ops+=load(pkg/'metadata/api-source-additions.json')['operations']
assert len(ops)==8 and len({o['code'] for o in ops})==8 and not {o['code'] for o in ops}&{o['code'] for o in source['operations']}
save(B/'metadata/source-additions.json',{'sourceCode':source['code'],'baselinePath':str(sourcePath.relative_to(R)),'baselineSha256':sha(sourcePath),'baselineOperations':132,'proposedOperations':140,'preserveActualAuthentication':True,'operations':[{'op':'add','path':'/operations/-','value':o} for o in ops]})
for pkg in [D,E,L]:
 for f in (pkg/'metadata').glob('*-builder-draft.json'):
  value=load(f)
  if value['programDraft']['programCode']=='op1049':value['programDraft']['rowLinks'].append(load(L/'metadata/op1049-link-proposal.json')['newRowLink'])
  save(B/'metadata'/f.name,value)
save(B/'composition-proof.json',{'status':'EXACT_BYTE_HUNKS_COMPOSED','outsideHunks':'Original stable6 byte slices, no newline normalization','hunks':composition})
save(B/'integration-plan.json',{'files':integration,'metadataDeltaOnly':True,'sourceBefore':132,'sourceAfter':140,'grants':0,'writers':0,'routeChanges':False,'canonicalWrites':False})
uploads=[{'local':str(p.relative_to(R)),'remote':remote+'/'+p.relative_to(P).as_posix()} for p in sorted(P.rglob('*')) if p.is_file()]
downloads=['compile.log','compile-process.log','net-library.txt']+[str(Path(n).with_suffix('.r')).replace('\\','/') for n in entries]+logs
save(B/'remote-plan.json',{'server':'compiler','directories':[remote]+[remote+'/'+p.relative_to(P).as_posix() for p in sorted(P.rglob('*')) if p.is_dir()],'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],'downloads':[{'local':str((B/'compiled122'/n).relative_to(R)),'remote':remote+'/'+n,'optional':True} for n in downloads]})
save(B/'source-manifest.json',[{'file':u['local'],'sha256':sha(R/u['local'])} for u in uploads])
save(B/'build-manifest.json',{'state':'PREPARED_NOT_EXECUTED','packages':packages,'baseOfficial6SourceManifestSha256':sha(OLD/'source-manifest.json'),'compileEntries':entries,'tests':tests,'checksPerCombination':1030,'testLogs':72,'compileDatabaseConnections':1,'testDatabaseConnections':0,'newPrograms':9,'newIncludes':3,'newPhpHelpers':3,'integrationFiles':len(integration),'sourceManifestSha256':sha(B/'source-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'compositionProofSha256':sha(B/'composition-proof.json'),'canonicalWrites':False,'remoteExecuted':False,'publicationAllowed':False,'excluded':['1047 retained','1051','writers','grants','DDL'],'metadata':'readonly1045/46/49/50; append132→140; new1049draft link1050 only'})
print(json.dumps({'build':str(B),'compileEntries':len(entries),'sourceFiles':len(uploads),'testLogs':72,'checksPerCombination':1030,'integrationFiles':len(integration),'networkExecuted':False}))
