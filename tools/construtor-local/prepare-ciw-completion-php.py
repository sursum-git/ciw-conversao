"""Compõe somente deltas PHP revisados em staging; não altera canônicos."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2]
fiscal=r/'integration-src/ciw-completion-20261028/container-fiscal-readonly'
history=r/'integration-src/ciw-completion-20261028/container-version-history/frozen-v1.1'
out=r/'.runtime/ciw-completion-20261028/backend-package5';assert not out.exists()
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
def apply(value,patch):
 lines=patch.splitlines(keepends=True);i=0
 while i<len(lines):
  if not lines[i].startswith('@@ '):i+=1;continue
  i+=1;old=[];new=[]
  while i<len(lines) and not lines[i].startswith('@@ '):
   line=lines[i]
   if line.startswith(('diff ','--- ','+++ ')):break
   if line.startswith(' '):old.append(line[1:]);new.append(line[1:])
   elif line.startswith('-'):old.append(line[1:])
   elif line.startswith('+'):new.append(line[1:])
   elif not line.startswith('\\ No newline'):raise AssertionError('Invalid diff line')
   i+=1
  before=''.join(old);after=''.join(new);assert before and value.count(before)==1,'Ambiguous/absent hunk';value=value.replace(before,after,1)
 return value
assert sha(fiscal/'manifest.json')=='b847a16ad4406c6703490bb2fb7809dfea3fce5dc6012bc94e52e2fca7643173'
assert sha(history/'manifest.json')=='98e74bc5d224e71fcb8f2437421d6da2171a22feb65cd41a2adf76667e12d2f7'
for scope in [fiscal,history]:
 for f in load(scope/'manifest.json')['files']:assert sha(scope/f['path'])==f['sha256']
out.mkdir();proof=[]
for name in ['RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']:
 record=next(x for x in load(history/'baselines.json')['baselines'] if x['target'].endswith('/'+name));target=Path(record['target']);assert sha(target)==record['baselineSha256']
 exact=history.parent/'frozenphp-exact'
 assert sha(exact/'manifest.json')=='acd70ff5bcbef227226f623b57aef895c399b86aa2dc2eb9bc62bbccf676bde4'
 value=(exact/name).read_bytes().decode('utf-8-sig')
 def encode(s):return s.encode('utf-8')
 assert hashlib.sha256(encode(value)).hexdigest()==record['candidateSha256']
 patch=next(x for x in load(fiscal/'patches/patch-plan.json')['textPatches'] if x['target'].endswith('/'+name));assert patch['baselineSha256']==record['baselineSha256']
 for change in patch['changes']:
  before,after=change['old'],change['new']
  if name=='RuntimeCiwErpQuery.php' and before=="        if (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {":
   before="        if (($d['entityCode']??null)==='container_versoes_historico_med_progress') {"
   after=after.replace("} elseif (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {","} elseif (($d['entityCode']??null)==='container_versoes_historico_med_progress') {")
  if value.count(before)!=1 and value.count(before.replace('\n','\r\n'))==1:
   before=before.replace('\n','\r\n');after=after.replace('\n','\r\n')
  assert value.count(before)==1,'Combined PHP patch collision';value=value.replace(before,after,1)
 dest=out/name;dest.write_bytes(encode(value));proof.append(dict(target=str(target),baselineSha256=sha(target),candidate=str(dest),candidateSha256=sha(dest)))
(out/'manifest.json').write_text(json.dumps(dict(success=True,fiscalManifestSha256=sha(fiscal/'manifest.json'),historyManifestSha256=sha(history/'manifest.json'),files=proof,canonicalWrites=False,businessWrites=False),indent=2)+'\n',encoding='utf-8')
print('PASS2sharedPHP composed by baseline/hunks; canonical unchanged')
