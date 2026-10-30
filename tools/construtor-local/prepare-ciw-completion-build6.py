"""Immutable1043+history-current-labels package. Local only, no publication."""
from pathlib import Path
import hashlib,json,re,shutil,sys
R=Path('D:/opencode/conversao-sc');M=Path('D:/opencode/motor-progress/v2');F=Path('D:/opencode/construtor-pg')
S=R/'.runtime/ciw-completion-20261028';OLD=S/'official-build5-v6';B=S/('official-build'+(sys.argv[1] if len(sys.argv)>1 else '6'));P=B/'package';BACK=B/'backend-stage'
T=R/'integration-src/ciw-completion-20261028/container-tax-only/frozen-v1.1';L=R/'integration-src/ciw-completion-20261028/container-version-history/frozen-lookups-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
def save(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
def verify(p,h):
 assert sha(p/'manifest.json')==h
 m=load(p/'manifest.json')
 for e in m['files']:assert sha(p/e['path'])==e['sha256'],e['path']
 for e in m.get('receipts',[]):assert sha(R/e['path'])==e['sha256'],e['path']
 return m
tm=verify(T,'33335d72af2330126dbb5a8c2a5ba3c7eb6fda15251a5fbd79545a6afc2da17a')
lm=verify(L,'eb6ac43fb5d4dc7a5a1f2bc695a3a36e1a12d130c1c3712efc38df72ff2d25d6')
assert not B.exists(),'Never overwrite immutable build'
for e in load(OLD/'source-manifest.json'):assert sha(R/e['file'])==e['sha256']
for e in load(OLD/'canonical-manifest.json')['files']:assert sha(Path(e['target']))==e['sha256'],e['target']
shutil.copytree(OLD/'package',P,ignore=shutil.ignore_patterns('*.r','*.log'))
BACK.mkdir();integration=[];steps=[]
def put(target,value,expected=None):
 before=sha(target) if target.exists() else None
 if expected is not None:assert before==expected,str(target)
 dest=(P/target.relative_to(M)) if target.is_relative_to(M) else BACK/target.relative_to(F)
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(value)
 integration.append({'target':str(target),'baselineSha256':before,'candidate':str(dest),'candidateSha256':sha(dest)})
def anchors(raw,changes):
 for c in changes:
  a,b=c['old'].encode(),c['new'].encode()
  if raw.count(a)!=1 and raw.count(a.replace(b'\n',b'\r\n'))==1:a=a.replace(b'\n',b'\r\n');b=b.replace(b'\n',b'\r\n')
  assert raw.count(a)==1,'Nonunique exact anchor '+c['old'][:80]
  raw=raw.replace(a,b,1)
 return raw
for e in load(T/'patches/abl-plan.json')['textPatches']:
 target=Path(e['target']);put(target,anchors(target.read_bytes(),e['changes']),e['baselineSha256'])
for e in load(T/'patches/php-plan.json')['textPatches']:
 candidate=T/e['exactCandidate'];assert sha(candidate)==e['candidateSha256'];put(Path(e['target']),candidate.read_bytes(),e['baselineSha256'])
put(F/'backend/src/Runtime/RuntimeContainerTaxAudit.php',(T/'php/RuntimeContainerTaxAudit.php').read_bytes())
for e in lm['baselines']:
 target=Path(e['target']);candidate=(Path(lm['stage'])/target.name) if target.name=='CiwErpReadService.p' else L/'abl'/target.name
 assert sha(candidate)==e['candidateSha256'];put(target,candidate.read_bytes(),e['baselineSha256'])
put(M/'sursum-api/programs/ContainersVersionHistoryLabels.p',(L/'abl/ContainersVersionHistoryLabels.p').read_bytes())
for f in (L/'includes').glob('*.i'):put(M/'sursum-api/includes'/f.name,f.read_bytes())
for f in (L/'tests/abl').glob('*'):
 if f.is_file():(P/f.name).write_bytes(f.read_bytes())
# Recreate the reviewed fiscal TT suites from their actual canonical baseline;
# only test parser input is explicitly UTF8 for ISO test AVMs.
suite=(M/'tests/abl/container-panel/ContainersImpostosTest.p').read_text(encoding='utf-8-sig').replace('  RUN DistributionTests.','  RUN DistributionTests.\n  RUN TaxOnlyTests.').replace('  iExpenseCalls=iExpenseCalls + 1.','  iExpenseCalls=iExpenseCalls + 1.\n  IF iFailAt=-1 THEN STOP.')
suite+='\n'+(T/'tests/ContainersTaxOnlyTests.i').read_text(encoding='utf-8')
(P/'ContainersImpostosTest.p').write_text(suite,encoding='utf-8');(P/'ContainersImpostosService.p').write_text('{sursum-api/programs/ContainersImpostosService.p}\n',encoding='utf-8')
process=(M/'tests/abl/container-panel/ContainersProcessosFiscalTest.p').read_text(encoding='utf-8-sig')
process=process.replace('DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.','DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.\nDEFINE VARIABLE testUtf8 AS LONGCHAR NO-UNDO.').replace('RUN Fixture. RUN Invoke.','FIX-CODEPAGE(testUtf8)="UTF-8".\nRUN Fixture. RUN Invoke.',1).replace('o=CAST(parser:Parse(lc),JsonObject).','testUtf8=lc. o=CAST(parser:Parse(testUtf8),JsonObject).')
(P/'ContainersProcessosFiscalTest.p').write_text(process,encoding='utf-8')
process=process.replace('"sincronizar"','"calcular_impostos"').replace('OUTPUT TO VALUE("containers-processes-fiscal-tests-','RUN TaxOnlyRootTests.\nOUTPUT TO VALUE("containers-tax-only-root-tests-').replace('RUN Fixture. failQuotes=TRUE.','result:WriteFile("tax-only-process-success.json",TRUE).\nRUN Fixture. failQuotes=TRUE.')
(P/'ContainersTaxOnlyProcessTest.p').write_text(process+'\n'+(T/'tests/ContainersTaxOnlyProcessTests.i').read_text(encoding='utf-8'),encoding='utf-8')
(P/'ContainersProcessosService.p').write_text('{sursum-api/programs/ContainersProcessosService.p}\n',encoding='utf-8')
boundary=(M/'tests/abl/container-panel/ContainersProcessBoundaryTest.p').read_text(encoding='utf-8-sig')
old='policyValue=ContainerMaintenancePolicy("TT"). RUN Check(policyValue:GetInteger("despesa_distr_custo")=0,'
new='''requestValue=NEW JsonObject(). requestValue:Add("resource","impostos"). requestValue:Add("operation","calcular_impostos"). requestValue:Add("container_id",123).
RUN Check(ContainerProcessRequest(requestValue)=123,"new tax-only fixed operation accepted").
requestValue:Add("percentual",99). RUN RejectRequest. requestValue:Remove("percentual").
requestValue:Add("actor","forged"). RUN RejectRequest. requestValue:Remove("actor").
requestValue:Add("policy",NEW JsonObject()). RUN RejectRequest. requestValue:Remove("policy").
requestValue:Add("database","other"). RUN RejectRequest. requestValue:Remove("database").
requestValue:Add("Container_id",123). RUN RejectRequest. requestValue:Remove("Container_id").
requestValue:Set("resource","custos"). RUN RejectRequest.
'''+old
assert boundary.count(old)==1;(P/'ContainersProcessBoundaryTest.p').write_text(boundary.replace(old,new,1),encoding='utf-8')
for name in ['ContainersImpostosTest.p','ContainersProcessosFiscalTest.p','ContainersTaxOnlyProcessTest.p','ContainersProcessBoundaryTest.p']:
 assert (P/name).read_text(encoding='utf-8-sig')==(S/'container-tax-only/local'/name).read_text(encoding='utf-8-sig'),'Reviewed TT differs: '+name
# Resolve include/procedure closure with candidate preference, then current
# canonical source. No paths or programs from the mutable discounts package.
dirs=[M/'sursum-api/programs',M/'sursum-api/includes',M/'tests/abl/container-panel',M/'tests/abl/ciw-erp-consultas',M/'tests/abl/purchase-items']
done=set()
while True:
 pending=[p for p in P.rglob('*') if p.suffix in ['.p','.i'] and str(p) not in done]
 if not pending:break
 for p in pending:
  done.add(str(p));value=p.read_text(encoding='utf-8-sig');refs=re.findall(r'\{([^\s{}]+\.i)',value)
  if p.name!='CiwCadastrosCrud.p':refs+=re.findall(r'''["'](sursum-api/(?:programs|includes)/[^"'\r\n]+\.[pir])["']''',value)
  refs+=re.findall(r'''\bRUN\s+([A-Za-z][A-Za-z0-9_]+\.[pr])\b''',value,re.I)
  for ref in refs:
   ref=ref.replace('\\','/');ref=ref[:-2]+'.p' if ref.endswith('.r') else ref
   if (P/ref).exists():continue
   if ref.startswith('sursum-api/'):source=M/ref;assert source.exists(),ref;rel=ref
   else:
    matches=[d/ref for d in dirs if (d/ref).exists()];assert matches,ref;assert len({sha(p) for p in matches})==1,ref
    source=matches[0];rel=source.relative_to(M).as_posix() if source.is_relative_to(M/'sursum-api') else ref
   dest=P/rel;dest.parent.mkdir(parents=True,exist_ok=True)
   if not dest.exists():dest.write_bytes(source.read_bytes())
bm=load(OLD/'build-manifest.json');tests=bm['tests']
for e in tests:
 if e['name']=='ContainersVersionHistoryTest.p':e['expectedChecks']=38
 if e['name']=='ContainersVersionAuxHistoryTest.p':e['expectedChecks']=28
 if e['name']=='ContainersProcessBoundaryTest.p':e['expectedChecks']=32
tests += [{'name':'ContainersImpostosTest.p','output':'containers-impostos-tests-{culture}.log','expectedChecks':160},{'name':'ContainersProcessosFiscalTest.p','output':'containers-processes-fiscal-tests-{culture}.log','expectedChecks':11},{'name':'ContainersTaxOnlyProcessTest.p','output':'containers-tax-only-root-tests-{culture}.log','expectedChecks':16},{'name':'ImportDiscountsLabelsTest.p','output':'discount-labels-tests.log','expectedChecks':17}]
for test in tests:assert (P/test['name']).is_file(),'Missing exact test source '+test['name']
classes=[n for n in bm['compileEntries'] if n.endswith('.cls')]
entries=classes+sorted(p.relative_to(P).as_posix() for p in P.rglob('*.p') if p.name not in ['Compile.p','Regression.p'])
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build'+B.name.removeprefix('official-build')
compile=(OLD/'package/Compile.p').read_text(encoding='utf-8').replace('codex-ciw-completion-20261028-build5-v6',remote.split('/')[-1])
compile=re.sub(r'INITIAL "[^"]+"','INITIAL "'+','.join(entries)+'"',compile,count=1);(P/'Compile.p').write_text(compile,encoding='utf-8')
(P/'Regression.p').write_text((OLD/'package/Regression.p').read_text(encoding='utf-8').replace('codex-ciw-completion-20261028-build5-v6',remote.split('/')[-1]),encoding='utf-8')
ps=(OLD/'package/compile122.ps1').read_text(encoding='utf-8').split("foreach($cp in @('UTF-8','ISO8859-1'))")[0].replace('codex-ciw-completion-20261028-build5-v6',remote.split('/')[-1])
ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n";logs=[]
for e in tests:
 name=e['name'];origin="('"+e['output'].replace('{culture}',"'+$culture+'")+"')"
 ps+="Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',"+name+"'),'-p','Regression.p','-T',$PWD.Path) ('process-"+name+"-'+$cp+'-'+$culture+'.log')\n"
 ps+="$proof=Get-Content -LiteralPath "+origin+" -Raw;if($proof -notmatch 'PASS' -or $proof -match 'FAIL'){throw 'Assertion proof failed: "+name+"'}\nCopy-Item -LiteralPath "+origin+" -Destination ('"+name[:-2]+"-'+$cp+'-'+$culture+'.log')\n"
 logs += [name[:-2]+'-'+cp+'-'+culture+'.log' for cp in ['UTF-8','ISO8859-1'] for culture in ['AMERICAN','EUROPEAN']]
ps+="}}\nWrite-Output 'Official12.2 build6 TT executed; inspect hashes/compiler/assertions'\n} catch {Write-Output $_.Exception.Message;if(Test-Path compile.log){Get-Content compile.log -Raw};exit 1}\n"
(P/'compile122.ps1').write_text(ps,encoding='utf-8')
uploads=[{'local':str(p.relative_to(R)),'remote':remote+'/'+p.relative_to(P).as_posix()} for p in sorted(P.rglob('*')) if p.is_file()]
downloads=['compile.log','compile-process.log','net-library.txt']+[str(Path(n).with_suffix('.r')).replace('\\','/') for n in entries]+logs
save(B/'remote-plan.json',{'server':'compiler','directories':[remote]+[remote+'/'+p.relative_to(P).as_posix() for p in sorted(P.rglob('*')) if p.is_dir()],'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/compile122.ps1'],'downloads':[{'local':str((B/'compiled122'/n).relative_to(R)),'remote':remote+'/'+n,'optional':True} for n in downloads]})
save(B/'source-manifest.json',[{'file':u['local'],'sha256':sha(R/u['local'])} for u in uploads])
save(B/'integration-plan.json',{'success':True,'files':integration,'routeChanges':False,'metadataCandidates':[str(T/'metadata'),str(L/'metadata')],'metadataMustBeAppliedByDelta':True,'businessWrites':False,'canonicalWrites':False})
save(B/'build-manifest.json',{'state':'PREPARED_NOT_EXECUTED','packageManifests':{'taxOnly':sha(T/'manifest.json'),'lookups':sha(L/'manifest.json')},'compileEntries':entries,'productionDelta':[e['target'] for e in integration if Path(e['target']).is_relative_to(M)],'tests':tests,'checksPerCombination':sum(e['expectedChecks'] for e in tests),'testLogs':len(logs),'compileDatabaseConnections':1,'compileConnection':'espec .111 TCP10012, schema binding only; no production execution','testDatabaseConnections':0,'sourceManifestSha256':sha(B/'source-manifest.json'),'remotePlanSha256':sha(B/'remote-plan.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'canonicalWrites':False,'remoteExecuted':False,'publicationAllowed':False,'excludeFromMetadata':['unpublished1042 batch','mutable1045/1046 discounts'],'coherentDeployment':['helper + mainAPI10/mainService10 + auxAPI10/auxService10 + includes + Reader','tax-only fixed operation, shared audit and core preserve existing operations']})
print(json.dumps({'prepared':str(B),'compileEntries':len(entries),'sourceFiles':len(uploads),'testLogs':len(logs),'checksPerCombination':sum(e['expectedChecks'] for e in tests),'integrationFiles':len(integration),'remotePlanSha256':sha(B/'remote-plan.json'),'executedRemote':False}))
