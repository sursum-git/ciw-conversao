"""Prepare op1055 official staging only. Never performs SSH or canonical writes."""
from pathlib import Path
import hashlib
import json
import re

W=Path('D:/opencode/conversao-sc'); R=W/'.runtime/ciw-completion-20261028'
B=R/'official-build11'; P=B/'package'; OLD=R/'official-build10-v2'
S=W/'integration-src/ciw-completion-20261028/expense-tax-relations-readonly/frozen-v1.1'
F=R/'expense-tax-relations-readonly/frozen-v1.1'; DOMAIN=F.parent
C=Path('D:/opencode/motor-progress/v2'); PHP=Path('D:/opencode/construtor-pg/backend')
REMOTE='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build11'
def sha(p): return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p): return json.loads(p.read_text(encoding='utf-8-sig'))
def out(p,d): p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(d,ensure_ascii=False,indent=2)+'\n',encoding='utf8')
def cp(a,b): b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
assert not (B/'build-manifest.json').exists(), 'Fresh stage only; preserve any earlier attempt'
assert sha(S/'manifest.json')=='1865e6c18f4fc8ecc26d8f7a697058c1c943d378f4a9e01c5d25c0e2021df79e'
m=load(S/'manifest.json')
for group,base in [('sourceFiles',S),('runtimeFiles',F),('evidence',None)]:
    for x in m[group]: assert sha(base/x['path'] if base else Path(x['path']))==x['sha256']
for x in m['candidateSources']: assert sha(Path(x['target']))==x['baselineSha256']
assert sha(C/'sursum-api/programs/ContainersPainelFinanceReadService.p')=='614795f3af80f29a51c467e8170f954540a76a8902034b9cf6186b1c328ac7b5'
assert not Path(m['newPhpFile']['target']).exists()
entries=['sursum-api/programs/CiwCadastrosCrud.p','sursum-api/programs/CiwErpReadService.p','sursum-api/programs/CiwMedCompanyContext.p','CiwErpReadService.p','CiwMedCompanyContext.p','ExpenseTaxRelationsReadTest.p','CiwErpReadTest.p']
for rel in entries:
    frozen=F/'testinputs'/rel
    cp(frozen if frozen.exists() else C/rel,P/rel)
# Include closure is resolved against the exact canonical project, never substituted.
pending=list(P.rglob('*.p'));includes=[];seen=set()
while pending:
    source=pending.pop()
    for inc in re.findall(r'\{\s*(sursum-api/[^\s{}]+\.i)\s*\}',source.read_text(encoding='utf-8-sig')):
        if inc in seen: continue
        seen.add(inc);actual=C/inc;assert actual.is_file(),inc
        cp(actual,P/inc);includes.append({'path':str(actual),'relative':inc,'sha256':sha(actual)});pending.append(P/inc)
for name in ['Compile.p','Regression.p']:
    data=(OLD/'package'/name).read_bytes().replace(b'codex-ciw-completion-20261028-build10-v2',b'codex-ciw-completion-20261028-build11')
    if name=='Compile.p':
        data,n=re.subn(br'INITIAL "[^"]+"',('INITIAL "'+','.join(entries)+'"').encode(),data,count=1);assert n==1
    (P/name).write_bytes(data)
base=(OLD/'package/compile122.ps1').read_text(encoding='utf8')
prefix=base[:base.index('foreach($cp')].replace('codex-ciw-completion-20261028-build10-v2','codex-ciw-completion-20261028-build11')
prefix=prefix.replace("if($p.ExitCode -ne 0){throw 'AVM nonzero exit'}", "if($p.ExitCode -ne 0){Write-Output ([IO.File]::ReadAllText((Join-Path $PSScriptRoot $Log)));Get-ChildItem -LiteralPath $PSScriptRoot -Filter '*.log'|ForEach-Object {Write-Output ('LOG '+$_.Name);Get-Content -LiteralPath $_.FullName};throw 'AVM nonzero exit'}")
prefix=prefix.replace("{throw 'Compilation unconfirmed'}", "{Get-Content -LiteralPath compile.log;throw 'Compilation unconfirmed'}")
ps=prefix+"foreach($cp in @('UTF-8','ISO8859-1')){foreach($culture in @('AMERICAN','EUROPEAN')){\n"
for suite,stem,count in [('ExpenseTaxRelationsReadTest','expense-tax-relations',49),('CiwErpReadTest','erp-read',47)]:
    ps+=f"Run-Avm @('-b','-cpinternal',$cp,'-cpstream','UTF-8','-param',($culture+',{suite}.p'),'-p','Regression.p','-T',$PWD.Path) ('process-{suite}-'+$cp+'-'+$culture+'.log')\n"
    ps+=f"$proof=Get-Content -LiteralPath ('{stem}-'+$culture+'.log') -Raw;if($proof -notmatch 'PASS {count} checks' -or $proof -match 'FAIL'){{Write-Output $proof;throw '{suite} incomplete'}}\n"
    ps+=f"[IO.File]::WriteAllText((Join-Path $PSScriptRoot ('{suite}-'+$cp+'-'+$culture+'.log')),$proof,[Text.UTF8Encoding]::new($false))\n"
ps+="}}\nWrite-Output 'PASS official12.2:7 compiles;8 TT logs;384 checks;NUMDBS0;no business'\n}catch{Write-Output $_.Exception.Message;Get-ChildItem -LiteralPath $PSScriptRoot -Filter '*.log'|ForEach-Object {Write-Output ('LOG '+$_.Name);Get-Content -LiteralPath $_.FullName};exit 1}\n"
(P/'compile122.ps1').write_text(ps,encoding='utf8')
uploads=[{'local':str(p.relative_to(W)),'remote':REMOTE+'/'+p.relative_to(P).as_posix()}for p in sorted(P.rglob('*'))if p.is_file()]
dirs={REMOTE}
for u in uploads:
    parent=u['remote'].rsplit('/',1)[0]
    while len(parent)>len(REMOTE):dirs.add(parent);parent=parent.rsplit('/',1)[0]
downloads=['compile.log','compile-process.log','net-library.txt']+[str(Path(e).with_suffix('.r')).replace('\\','/')for e in entries]
for cpv in ['UTF-8','ISO8859-1']:
    for culture in ['AMERICAN','EUROPEAN']:
        for suite in ['ExpenseTaxRelationsReadTest','CiwErpReadTest']:downloads += [f'{suite}-{cpv}-{culture}.log',f'process-{suite}-{cpv}-{culture}.log']
out(B/'remote-plan.json',{'server':'compiler','directories':sorted(dirs),'uploads':uploads,'commands':['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+REMOTE+'/compile122.ps1'],'downloads':[{'remote':REMOTE+'/'+n,'local':str((B/'compiled122'/n).relative_to(W)),'optional':True}for n in downloads]})
out(B/'source-manifest.json',[{'file':u['local'],'remote':u['remote'],'sha256':sha(W/u['local'])}for u in uploads])
# All PHP application classes come from one fresh composition of current canonical sources.
php_rows=[]
for p in sorted((PHP/'src').rglob('*')):
    if not p.is_file():continue
    rel=p.relative_to(PHP/'src');dest=B/'backend-stage/backend/src'/rel;cp(p,dest);php_rows.append({'path':rel.as_posix(),'baselineSha256':sha(p),'stageSha256':sha(dest)})
for x in m['candidateSources']:
    if not x['target'].endswith('.php'):continue
    rel=Path(x['target']).relative_to(PHP/'src');dest=B/'backend-stage/backend/src'/rel;cp(Path(x['frozenCandidatePath']),dest)
    next(row for row in php_rows if row['path']==rel.as_posix())['stageSha256']=sha(dest)
new=B/'backend-stage/backend/src/Runtime/RuntimeExpenseTaxRelationsRead.php';cp(S/'php/RuntimeExpenseTaxRelationsRead.php',new);php_rows.append({'path':'Runtime/RuntimeExpenseTaxRelationsRead.php','baselineSha256':None,'stageSha256':sha(new)})
oldfull=DOMAIN/'full-stage'
for tree in ['php-tests','test-inputs']:
    for p in (oldfull/tree).rglob('*'):
        if not p.is_file():continue
        dest=B/tree/p.relative_to(oldfull/tree);data=p.read_bytes()
        if p.suffix=='.php':data=data.replace(oldfull.as_posix().encode(),B.as_posix().encode())
        dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
for p in S.rglob('*'):
    if not p.is_file():continue
    dest=B/'php-tests/relations'/p.relative_to(S);data=p.read_bytes()
    if p.suffix=='.php':data=data.replace((DOMAIN/'native-preview.json').as_posix().encode(),(B/'native-preview.json').as_posix().encode())
    dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
bootstrap=(oldfull/'php-bootstrap.php').read_bytes();(B/'php-bootstrap.php').write_bytes(bootstrap)
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{B.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="Official11FullStage"><directory>{PHP.as_posix()}/tests</directory><directory>{B.as_posix()}/php-tests</directory></testsuite></testsuites></phpunit>'''
(B/'phpunit.xml').write_text(config,encoding='utf8');out(B/'php-source-manifest.json',php_rows)
out(B/'build-manifest.json',{'state':'PREPARED_OFFLINE_REVIEW_PENDING','productManifestSha256':sha(S/'manifest.json'),'productManagerReviewSha256':sha(DOMAIN/'manager-review/review-final.json'),'compileEntries':entries,'compileDB':1,'testDB':0,'combinations':4,'testLogs':8,'checks':384,'tests':[{'name':'ExpenseTaxRelationsReadTest','checks':49},{'name':'CiwErpReadTest','checks':47}],'sourceFiles':len(uploads),'includes':includes,'remotePlanSha256':sha(B/'remote-plan.json'),'sourceManifestSha256':sha(B/'source-manifest.json'),'productionAllowlist':['sursum-api/programs/CiwErpReadService.p','sursum-api/programs/CiwErpReadService.r','sursum-api/programs/CiwCadastrosCrud.p','sursum-api/programs/CiwCadastrosCrud.r'],'phpSourceFiles':len(php_rows),'canonicalIntegrationFiles':m['candidateSources']+[m['newPhpFile']],'financeServiceDependencySha256':sha(C/'sursum-api/programs/ContainersPainelFinanceReadService.p'),'officialExecuted':False,'noBusiness':True,'noHumanGrants':True,'logFailurePrintedBeforeExit':True})
print(json.dumps({'success':True,'prepared':str(B),'uploads':len(uploads),'compiles':7,'checks':384,'phpSources':len(php_rows)}))
