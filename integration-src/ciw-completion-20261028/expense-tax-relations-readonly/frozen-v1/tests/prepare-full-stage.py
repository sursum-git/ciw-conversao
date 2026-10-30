from pathlib import Path
import hashlib,json
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1];STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly';B=STATE/'full-stage';C=Path('D:/opencode/construtor-pg/backend');OLD=W/'.runtime/ciw-completion-20261028/official-build9'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
rows=[]
assert sha(C/'src/Runtime/RuntimeApiEntityActionService.php')=='399cf18a00bca42875c2a35c648eaa4021029b4e3473b872b16f2e62865c96d2'
for src in (C/'src').rglob('*'):
 if src.is_file():
  rel=src.relative_to(C/'src');cp(src,B/'backend-stage/backend/src'/rel);rows.append({'path':rel.as_posix(),'baselineSha256':sha(src),'stageSha256':sha(src)})
for name in ['RuntimeApiEntityActionService.php','RuntimeCiwErpQuery.php']:
 dest=B/'backend-stage/backend/src/Runtime'/name;cp(STATE/'php-local'/name,dest)
 for row in rows:
  if row['path']=='Runtime/'+name:row['stageSha256']=sha(dest)
cp(ROOT/'php/RuntimeExpenseTaxRelationsRead.php',B/'backend-stage/backend/src/Runtime/RuntimeExpenseTaxRelationsRead.php')
rows.append({'path':'Runtime/RuntimeExpenseTaxRelationsRead.php','baselineSha256':None,'stageSha256':sha(B/'backend-stage/backend/src/Runtime/RuntimeExpenseTaxRelationsRead.php')})
for tree in ['php-tests','test-inputs']:
 for src in (OLD/tree).rglob('*'):
  if not src.is_file():continue
  dest=B/tree/src.relative_to(OLD/tree);data=src.read_bytes()
  if src.suffix=='.php':data=data.replace(OLD.as_posix().encode(),B.as_posix().encode())
  dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
bootstrap=(OLD/'php-bootstrap.php').read_bytes().replace(OLD.as_posix().encode(),B.as_posix().encode());(B/'php-bootstrap.php').write_bytes(bootstrap)
config=f'''<?xml version="1.0" encoding="UTF-8"?><phpunit bootstrap="{B.as_posix()}/php-bootstrap.php" cacheResult="false"><testsuites><testsuite name="ExpenseTaxGlobalFullStage"><directory>{C.as_posix()}/tests</directory><directory>{B.as_posix()}/php-tests</directory><directory>{ROOT.as_posix()}/tests</directory></testsuite></testsuites></phpunit>'''
(B/'phpunit.xml').write_text(config,encoding='utf-8');(B/'php-source-manifest.json').write_text(json.dumps(rows,indent=2)+'\n',encoding='utf-8');print(json.dumps({'files':len(rows),'phpFiles':len(list((B/'backend-stage/backend/src').rglob('*.php'))),'stage':str(B),'nf1053Preserved':True}))
