from pathlib import Path
import json,hashlib
D=Path(__file__).resolve().parent;W=D.parents[2];F=D.parent/'supplier-discounts-readonly/frozen-v1';I=D.parent/'container-supplier-discounts-integer-range-v2'
sha=lambda b:hashlib.sha256(b).hexdigest()
base=json.loads((D/'baselines.json').read_text());plan=json.loads((F/'patches/patch-plan.json').read_text());root=json.loads(Path(base['canonical13Manifest']).read_text())
assert root['success'] is True
for row in root['files']:assert sha(Path(row['target']).read_bytes())==row['sha256'],row['target']
proof=[]
for row in base['files']:
 rel=row['relative'];before=(D/'baseline'/rel).read_bytes();assert sha(before)==row['baselineSha256'];assert Path(row['canonical']).read_bytes()==before
 frozen=next(x for x in plan['files']if Path(x['target']).name==Path(rel).name);old=(F/frozen['baselineFile']).read_bytes();edits=[]
 if Path(rel).name=='RuntimeImportDiscountRead.php':
  after=(I/'candidate/backend/src/Runtime/RuntimeImportDiscountRead.php').read_bytes();assert sha(after)==base['helperCandidateSha256']
 elif Path(rel).name=='RuntimeCiwErpQuery.php':
  anchor=b'private const RESOURCES=[';assert before.count(anchor)==1;after=before.replace(anchor,anchor+b"'descontos_importacao_fornecedor_progress'=>'import_descontos_fornecedor',");edits.append({'kind':'exact literal registry prefix','anchorSha256':sha(anchor),'priorRegistryBytesPreserved':True})
 else:
  changes=[]
  for h in frozen['hunks']:
   a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);at=h['oldOffset'];assert old[at:at+len(a)]==a
   if a:
    assert before.count(a)==1,(rel,'old byte block not unique');offset=before.index(a);kind='unique old byte block'
   else:
    left=old[max(0,at-120):at];right=old[at:at+120];anchor=left+right;assert before.count(anchor)==1,(rel,'exact surrounding anchor not unique');offset=before.index(anchor)+len(left);kind='exact 120-byte surrounding anchor'
   changes.append((offset,a,b));edits.append({'kind':kind,'originalFrozenOffset':at,'current13Offset':offset,'oldSha256':sha(a),'newSha256':sha(b)})
  after=before
  for offset,a,b in sorted(changes,reverse=True):assert after[offset:offset+len(a)]==a;after=after[:offset]+b+after[offset+len(a):]
  if old==before:assert after==(F/frozen['candidateFile']).read_bytes()
 if Path(rel).name=='RuntimeApiEntityActionService.php':
  anchor=b"        if (RuntimeImportDiscountRead::supports($definition)) {\r\n            foreach ($body['data'] as $row) { RuntimeImportDiscountRead::assertRow($definition,$row,$query); }"
  assert after.count(anchor)==1
  replacement=b"        if (RuntimeImportDiscountRead::supports($definition)) {\r\n            if (RuntimeImportDiscountRead::isSupplier($definition) && isset($body['error'])) { throw new RuntimeHttpException('CIW_ERP_RESPONSE_INVALID','Resposta da consulta ERP MED invalida.',502); }\r\n            foreach ($body['data'] as $row) { RuntimeImportDiscountRead::assertRow($definition,$row,$query); }"
  after=after.replace(anchor,replacement);edits.append({'kind':'supplier-only read error envelope closure','rootReviewRequired':True,'legacyResourcesBehaviorUnchanged':True})
 (D/'candidate'/rel).write_bytes(after)
 proof.append({'relative':rel,'baselineSha256':sha(before),'candidateSha256':sha(after),'frozenOriginalBaselineEqual':old==before,'rebaseEdits':edits,'fuzzyMatching':False})
(D/'composition-proof.json').write_text(json.dumps({'success':True,'canonical13PreservedOutsideExactEdits':True,'current13ManifestSha256':sha(Path(base['canonical13Manifest']).read_bytes()),'files':proof,'networkExecuted':False,'canonicalWrites':False},indent=2)+'\n')
print(json.dumps({'composedShared':len(proof),'newAbl':2,'helperSha256':base['helperCandidateSha256']}))
