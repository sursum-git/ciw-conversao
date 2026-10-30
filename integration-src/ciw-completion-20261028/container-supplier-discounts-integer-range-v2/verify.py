from pathlib import Path
import json,hashlib,base64,sys
D=Path(__file__).resolve().parent
sha=lambda b:hashlib.sha256(b).hexdigest()
M=D/'frozen-v1/manifest.json'
manifest=json.loads(M.read_text())
for row in manifest['files']:
 p=Path(row['path']);assert p.is_file() and sha(p.read_bytes())==row['sha256'],str(p)
for row in manifest['sharedFiles']+manifest['documentationFiles']:
 p=json.loads((D/row['bytePatch']).read_text());before=(D/'baseline'/row['relative']).read_bytes();after=(D/'candidate'/row['relative']).read_bytes()
 assert sha(before)==p['baselineSha256'] and sha(after)==p['candidateSha256']
 out=b'';cursor=0
 for h in p['hunks']:
  assert before[h['baselineStart']:h['baselineEnd']]==base64.b64decode(h['beforeBase64'])
  out+=before[cursor:h['baselineStart']]+base64.b64decode(h['afterBase64']);cursor=h['baselineEnd']
 out+=before[cursor:];assert out==after
 out=b'';cursor=0
 for h in p['hunks']:
  assert after[h['candidateStart']:h['candidateEnd']]==base64.b64decode(h['afterBase64'])
  out+=after[cursor:h['candidateStart']]+base64.b64decode(h['beforeBase64']);cursor=h['candidateEnd']
 out+=after[cursor:];assert out==before
 for span in p['unchangedRanges']:
  a=before[span['baselineStart']:span['baselineEnd']];b=after[span['candidateStart']:span['candidateEnd']]
  assert a==b and sha(a)==span['sha256']
assert (D/'baseline/src/crud-engine/CrudKendoGridRenderer.js').read_bytes()==(D/'candidate/src/crud-engine/CrudKendoGridRenderer.js').read_bytes()
assert (D/'baseline/src/crud-engine/CrudKendoFormRenderer.js').read_bytes()==(D/'candidate/src/crud-engine/CrudKendoFormRenderer.js').read_bytes()
print(json.dumps({'success':True,'pins':len(manifest['files']),'sourcePatches':len(manifest['sharedFiles']),'documentationPatches':len(manifest['documentationFiles']),'roundTripAndOutsideHunksExact':True,'noWrites':True,'manifestSha256':sha(M.read_bytes())}))
