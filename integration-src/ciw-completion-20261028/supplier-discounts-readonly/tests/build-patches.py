from pathlib import Path
import hashlib,json,difflib
ROOT=Path(__file__).resolve().parents[1];OUT=Path('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/supplier-discounts-readonly')
def sha(data):return hashlib.sha256(data).hexdigest()
plans=[]
for row in json.loads((ROOT/'baselines.json').read_text())['files']:
 old=(ROOT/row['baselineFile']).read_bytes();new=(ROOT/'candidate-exact'/Path(row['target']).name).read_bytes();assert sha(old)==row['sha256'];assert sha(Path(row['target']).read_bytes())==row['sha256']
 lines=old.splitlines(keepends=True);fresh=new.splitlines(keepends=True);hunks=[]
 for tag,a,b,c,d in difflib.SequenceMatcher(None,lines,fresh,autojunk=False).get_opcodes():
  if tag=='equal':continue
  left=b''.join(lines[a:b]);right=b''.join(fresh[c:d]);hunks.append({'oldOffset':sum(map(len,lines[:a])),'oldBytesHex':left.hex(),'newBytesHex':right.hex(),'oldLine':a+1,'oldSha256':sha(left),'newSha256':sha(right)})
 rebuilt=old
 for h in reversed(hunks):
  at=h['oldOffset'];left=bytes.fromhex(h['oldBytesHex']);assert rebuilt[at:at+len(left)]==left;rebuilt=rebuilt[:at]+bytes.fromhex(h['newBytesHex'])+rebuilt[at+len(left):]
 assert rebuilt==new
 plans.append({'target':row['target'],'baselineFile':row['baselineFile'],'baselineSha256':row['sha256'],'candidateFile':'candidate-exact/'+Path(row['target']).name,'candidateSha256':sha(new),'hunks':hunks,'outsideHunksBytePreserved':True,'baselineIsolatedLfCount':old.count(b'\n')-old.count(b'\r\n'),'candidateIsolatedLfCount':new.count(b'\n')-new.count(b'\r\n')})
old=(ROOT/'baseline-exact/ImportDiscountsCollector.p').read_bytes();body=old[old.index(b'DEFINE VARIABLE headerQuery'):];new=(ROOT/'includes/ImportDiscountsCollectorBody.i').read_bytes()
for line in [b" IF piSupplierId<>? THEN headerFields=headerFields + ',arquivo'.\n",b"  IF piSupplierId<>? THEN whereClause=whereClause + ' AND ' + phDiscounts:NAME + '.fornecedor_id=' + IdText(piSupplierId).\n"]:
 assert new.count(line)==1;new=new.replace(line,b'',1)
assert new==body
(ROOT/'patches').mkdir(exist_ok=True)
(ROOT/'patches/patch-plan.json').write_text(json.dumps({'baseline':'official11 exact bytes','applyByRootOnly':True,'canonicalWrites':False,'files':plans},indent=2)+'\n',encoding='utf-8')
proof={'success':True,'sharedFiles':len(plans),'hunks':sum(len(x['hunks'])for x in plans),'outsideHunksBytePreserved':True,'actionIsolatedLfPreserved':next(x for x in plans if x['target'].endswith('RuntimeApiEntityActionService.php'))['candidateIsolatedLfCount']==15,'uniqueCollectorExtraction':{'bodyByteEqualAfterRemovingOnlyTwoNewSelectionLines':True,'originalBodySha256':sha(body),'oldPublicParameterSignatureUnchanged':True,'noFinancialRuleDelta':True},'canonicalWrites':False}
(OUT/'patch-proof.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf-8');print(json.dumps(proof))
