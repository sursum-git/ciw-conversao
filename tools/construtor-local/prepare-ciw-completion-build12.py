"""Prepare a fresh official12 from the frozen NF pagination product. No network/writers."""
from pathlib import Path
import hashlib,json,re
W=Path('D:/opencode/conversao-sc');R=W/'.runtime/ciw-completion-20261028';B=R/'official-build12';P=B/'package'
M=Path('D:/opencode/motor-progress/v2');PHP=Path('D:/opencode/construtor-pg/backend')
S=W/'integration-src/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/frozen-v1'
F=R/'container-nf-available-readonly-pagination/v1/frozen-v1';STATE=F.parent;FULL=STATE/'full-stage'
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build12'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p):return json.loads(p.read_text(encoding='utf-8-sig'))
def out(p,d):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(d,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
assert not(B/'build-manifest.json').exists(),'Fresh stage only; preserve all earlier attempts'
assert sha(S/'manifest.json')=='460dba12bb2acfa3dab34f4572df9d9a3dafb65184bf45706967d6d4ce0b2cc8'
m=load(S/'manifest.json')
for group,base in [('sourceFiles',S),('runtimeFiles',F)]:
 for x in m[group]:assert sha(base/x['path'])==x['sha256'],x['path']
official=R/'official-build11/canonical-manifest.json'
for x in load(official)['files']:assert sha(Path(x['target']))==x['sha256']
integration=[]
for x in m['candidates']:
 target=M/x['relative']if x['relative'].startswith('sursum-api/')else PHP/'src/Runtime'/Path(x['relative']).name
 assert sha(target)==x['baselineSha256'];integration.append(dict(x,target=str(target),applyMode='byte-exact-anchors-only'))
changed=['sursum-api/programs/ContainersPainelFinanceReadService.p','sursum-api/programs/CiwErpReadService.p']
callers=[{'relative':p.relative_to(M).as_posix(),'sha256':sha(p)}for p in sorted((M/'sursum-api/programs').glob('*.p'))if any(s in p.read_bytes()for s in [b'CiwErpReadService',b'ContainersPainelFinanceReadService'])]
assert len(callers)==25
production=changed+[x['relative']for x in callers]+['sursum-api/programs/CiwMedCompanyContext.p'];assert len(set(production))==len(production)==28
suites=[('NfAvailablePageTest','nf-page',1040),('ContainersPainelFinanceReadTest','container-panel-finance-tests',231),('AvailableNfAliasTest','alias-strict',18),('ContainerNfAvailableTest','nf-available',39),('NfPageBudgetTest','nf-page-budget',2),('ExpenseTaxRelationsReadTest','expense-tax-relations',49),('CiwErpReadTest','erp-read',47)]
fixtures=['sursum-api/programs/NfPageBudgetFixture.p','sursum-api/programs/NfSlowReaderFixture.p']
entries=production+['ContainersPainelFinanceReadService.p','CiwErpReadService.p','CiwMedCompanyContext.p']+[n+'.p'for n,_,_ in suites]+fixtures;assert len(entries)==40
for rel in entries:cp(F/'candidates'/rel if rel in changed else M/rel if rel in production else F/'testinputs'/rel,P/rel)
cp(F/'testinputs/AvailableNfFixture.i',P/'AvailableNfFixture.i')
pending=list(P.rglob('*.p'));seen=set();includes=[]
while pending:
 src=pending.pop()
 for inc in re.findall(r'\{\s*(sursum-api/[^\s{}]+\.i)\s*\}',src.read_text(encoding='utf-8-sig')):
  if inc in seen:continue
  seen.add(inc);actual=M/inc;assert actual.is_file(),inc;cp(actual,P/inc);pending.append(P/inc);includes.append({'relative':inc,'canonicalPath':str(actual),'sha256':sha(actual)})
assert 'sursum-api/includes/parametros_ima.i'in seen and not any('JsonProgramWebHandler'in e for e in entries)
for name in ['Compile.p','Regression.p']:
 data=(R/'official-build11/package'/name).read_bytes().replace(b'20261028-build11',b'20261028-build12')
 if name=='Compile.p':data,n=re.subn(br'INITIAL "[^"]+"',('INITIAL "'+','.join(entries)+'"').encode(),data,count=1);assert n==1
 else:data=data.replace(b'SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).',b"PUT UNFORMATTED 'START TT NUMDBS=' NUM-DBS ' CP=' SESSION:CPINTERNAL SKIP.\nSESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).")
 (P/name).write_bytes(data)
base=(R/'official-build11/package/compile122.ps1').read_text(encoding='utf8')
ps=base[:base.index('foreach($cp')].replace('20261028-build11','20261028-build12')
ps=ps.replace("if(!$p.WaitForExit(35000)){throw 'AVM timeout; inspect before retry'}","if(!$p.WaitForExit(55000)){Show-Logs;throw 'AVM timeout; inspect owned process before retry'}")
ps=ps.replace("$p=[Diagnostics.Process]::Start($info);","$p=New-Object Diagnostics.Process;$p.StartInfo=$info;if(!$p.Start()){Show-Logs;throw 'AVM start unconfirmed'};")
ps=ps.replace("[Threading.Tasks.Task]::WaitAll", "$p.WaitForExit();$p.Refresh();if(!$p.HasExited){Show-Logs;throw 'AVM exit unconfirmed'}\n [Threading.Tasks.Task]::WaitAll")
ps=ps.replace("if($p.ExitCode -ne 0)", "if($null -eq $p.ExitCode -or $p.ExitCode -isnot [int]){Show-Logs;throw 'AVM ExitCode missing; fail closed'}\n if($p.ExitCode -ne 0)")
ps=ps.replace("function Run-Avm", "function Show-Logs {Get-ChildItem -LiteralPath $PSScriptRoot -Filter '*.log'|Sort-Object Name|ForEach-Object {Write-Output ('LOG '+$_.Name);Get-Content -LiteralPath $_.FullName}}\nfunction Run-Avm")
ps=ps.replace("$netLibrary=@(", "if(Test-Path -LiteralPath 'attempt-started.json'){throw 'Earlier attempt exists; require fresh directory, no automatic replay'}\n[IO.File]::WriteAllText((Join-Path $PSScriptRoot 'attempt-started.json'),'{\"stage\":\"official-build12\",\"business\":false}',[Text.UTF8Encoding]::new($false))\n$netLibrary=@(")
ps+="foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
for name,stem,count in suites:
 ps+=f"Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',{name}.p'),'-p','Regression.p','-T',$PWD.Path) ('process-{name}-'+$cp+'-'+$culture+'.log')\n"
 ps+=f"$proof=Get-Content -LiteralPath ('{stem}-'+$culture+'.log') -Raw;if($proof -notmatch 'PASS:? {count} checks' -or $proof -match 'FAIL'){{Write-Output $proof;Show-Logs;throw '{name} incomplete'}}\n"
 ps+=f"[IO.File]::WriteAllText((Join-Path $PSScriptRoot ('{name}-'+$cp+'-'+$culture+'.log')),$proof,[Text.UTF8Encoding]::new($false))\n"
 if name=='NfAvailablePageTest':
  for part in ['first','second','filtered','desc']:ps+=f"Copy-Item -LiteralPath 'nf-page-native-{part}.json' -Destination ('nf-page-native-{part}-'+$cp+'-'+$culture+'.json')\n"
ps+="}}\nWrite-Output 'PASS official12.2:40 compiles;28 TT logs;5704 checks;NUMDBS0;no business'\n}catch{Write-Output $_.Exception.Message;Show-Logs;exit 1}\n"
(P/'compile122.ps1').write_text(ps,encoding='utf8')
uploads=[{'local':str(p.relative_to(W)),'remote':REMOTE+'/'+p.relative_to(P).as_posix()}for p in sorted(P.rglob('*'))if p.is_file()];dirs={REMOTE}
for u in uploads:
 parent=u['remote'].rsplit('/',1)[0]
 while len(parent)>len(REMOTE):dirs.add(parent);parent=parent.rsplit('/',1)[0]
downloads=['compile.log','compile-process.log','net-library.txt','attempt-started.json']+[str(Path(e).with_suffix('.r')).replace('\\','/')for e in entries]
for cpv in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  for name,_,_ in suites:downloads += [f'{name}-{cpv}-{culture}.log',f'process-{name}-{cpv}-{culture}.log']
  downloads += [f'nf-page-native-{part}-{cpv}-{culture}.json'for part in ['first','second','filtered','desc']]
out(B/'remote-plan.json',{'server':'compiler','directories':sorted(dirs),'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+REMOTE+'/compile122.ps1'],'downloads':[{'remote':REMOTE+'/'+name,'local':str((B/'compiled122'/name).relative_to(W)),'optional':True}for name in downloads]})
out(B/'source-manifest.json',[{'file':u['local'],'remote':u['remote'],'sha256':sha(W/u['local'])}for u in uploads])
out(B/'closure-manifest.json',{'changedSources':changed,'unchangedDirectConsumers':callers,'includes':includes,'testOnlyFixtures':fixtures,'handlerExcluded':'JsonProgramWebHandler.cls stable/unaffected; known unrelated failure'})
php_rows=[]
for p in sorted((PHP/'src').rglob('*')):
 if p.is_file():rel=p.relative_to(PHP/'src');dest=B/'backend-stage/backend/src'/rel;cp(p,dest);php_rows.append({'path':rel.as_posix(),'baselineSha256':sha(p),'stageSha256':sha(dest)})
for x in integration:
 if x['relative'].startswith('php/'):
  name=Path(x['relative']).name;dest=B/'backend-stage/backend/src/Runtime'/name;cp(Path(x['frozenCandidatePath']),dest);next(row for row in php_rows if row['path']=='Runtime/'+name)['stageSha256']=sha(dest)
def translate(data):return data.replace(FULL.as_posix().encode(),B.as_posix().encode()).replace(STATE.as_posix().encode(),B.as_posix().encode())
for tree in ['php-tests','test-inputs','relations-state']:
 for p in (F/'full-stage'/tree).rglob('*'):
  if p.is_file():dest=B/tree/p.relative_to(F/'full-stage'/tree);dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(translate(p.read_bytes())if p.suffix=='.php'else p.read_bytes())
for p in (S/'tests').glob('*Test.php'):
 dest=B/'php-tests/nf-pagination/tests'/p.name;dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(translate(p.read_bytes()))
for p in (S/'metadata').glob('*.json'):cp(p,B/'metadata'/p.name);cp(p,B/'php-tests/nf-pagination/metadata'/p.name)
for p in (F/'testinputs').glob('*.json'):cp(p,B/'local'/p.name)
cp(F/'evidence/native-calls.json',B/'native-calls.json');cp(F/'full-stage/php-bootstrap.php',B/'php-bootstrap.php')
(B/'native-pages.cjs').write_bytes(translate((S/'tests/native-pages.cjs').read_bytes()).replace(b"pkg=path.resolve(__dirname,'..')",b'pkg=__dirname'))
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{B.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="Official12FullStage"><directory>{PHP.as_posix()}/tests</directory><directory>{B.as_posix()}/php-tests</directory><exclude>{B.as_posix()}/php-tests/nf/tests/RuntimeContainerNfAvailableReadTest.php</exclude></testsuite></testsuites></phpunit>'''
(B/'phpunit.xml').write_text(config,encoding='utf8');out(B/'php-source-manifest.json',php_rows)
out(B/'canonical-test-manifest.json',[{'path':str(p),'sha256':sha(p)}for p in sorted((PHP/'tests').rglob('*'))if p.is_file()])
allowlist=[rel+suffix for rel in ['sursum-api/programs/ContainersPainelFinanceReadService','sursum-api/programs/CiwErpReadService']for suffix in ['.p','.r']]
out(B/'integration-plan.json',{'rootOnly':True,'files':integration,'productionRuntimeAllowlist':allowlist,'neverPublishFixtures':fixtures,'unchangedSourcesNotToPublish':production[2:],'metadataHeldUntilPagedFiveContainerProof':True,'executed':False})
out(B/'build-manifest.json',{'state':'PREPARED_OFFLINE_REVIEW_PENDING','productManifestSha256':sha(S/'manifest.json'),'canonical11ManifestSha256':sha(official),'compileEntries':entries,'compileDB':1,'testDB':0,'combinations':4,'testLogs':28,'checks':5704,'tests':[{'name':n,'sourceLog':stem+'-{culture}.log','checks':count}for n,stem,count in suites],'sourceFiles':len(uploads),'includes':includes,'remotePlanSha256':sha(B/'remote-plan.json'),'sourceManifestSha256':sha(B/'source-manifest.json'),'integrationPlanSha256':sha(B/'integration-plan.json'),'productionAllowlist':allowlist,'canonicalIntegrationFiles':integration,'phpSourceFiles':len(php_rows),'expectedPhpTests':990,'expectedPhpAssertions':7119,'expectedLoadedAppDefinitions':277,'phpCandidateFiles':3,'totalProductCandidateFiles':5,'jsonFixtureComparisons':16,'officialExecuted':False,'noBusiness':True,'noNetwork':True,'logFailurePrintedBeforeThrow':True,'exitCodeNullRefused':True,'remoteAutomaticReplay':False})
print(json.dumps({'prepared':str(B),'uploads':len(uploads),'compiles':len(entries),'tests':28,'checks':5704,'phpSourceFiles':len(php_rows),'downloads':len(downloads),'networkExecuted':False}))
