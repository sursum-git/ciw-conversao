from pathlib import Path
import json,hashlib,base64
D=Path(__file__).resolve().parent;M=D/'frozen-v1/manifest.json';m=json.loads(M.read_text());sha=lambda b:hashlib.sha256(b).hexdigest()
for row in m['files']:
 p=Path(row['path']);assert p.is_file() and sha(p.read_bytes())==row['sha256'],str(p)
for row in m['sharedFiles']:
 patch=json.loads((D/row['bytePatch']).read_text());before=(D/'baseline'/row['relative']).read_bytes();after=(D/'candidate'/row['relative']).read_bytes();assert sha(before)==row['baselineSha256'] and sha(after)==row['candidateSha256'];out=b'';cursor=0
 for h in patch['hunks']:
  assert before[h['baselineStart']:h['baselineEnd']]==base64.b64decode(h['beforeBase64']);out+=before[cursor:h['baselineStart']]+base64.b64decode(h['afterBase64']);cursor=h['baselineEnd']
 out+=before[cursor:];assert out==after;out=b'';cursor=0
 for h in patch['hunks']:
  assert after[h['candidateStart']:h['candidateEnd']]==base64.b64decode(h['afterBase64']);out+=after[cursor:h['candidateStart']]+base64.b64decode(h['beforeBase64']);cursor=h['candidateEnd']
 out+=after[cursor:];assert out==before
 for x in patch['unchangedRanges']:
  a=before[x['baselineStart']:x['baselineEnd']];b=after[x['candidateStart']:x['candidateEnd']];assert a==b and sha(a)==x['sha256']
for row in m['newProductionFiles']:assert sha((D/'candidate'/row['relative']).read_bytes())==row['sha256']
print(json.dumps({'success':True,'manifestSha256':sha(M.read_bytes()),'pins':len(m['files']),'sharedPatches':len(m['sharedFiles']),'newAblSources':len(m['newProductionFiles']),'roundTripAndOutsideHunksExact':True,'noWrites':True}))
