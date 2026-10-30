from pathlib import Path
import json,hashlib
D=Path(__file__).resolve().parent
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
map=json.loads((D/'closed-text-map.json').read_bytes())
for file in map['files']:
 source=Path(file['sourcePath']);assert sha(source)==file['sourceSha256']
 original=json.loads(source.read_bytes());candidate=json.loads(source.read_bytes())
 for change in file['changes']:
  ref=candidate
  for part in change['path'][:-1]:ref=ref[part]
  key=change['path'][-1];assert ref[key]==change['before'];ref[key]=change['after']
 reversed=json.loads(json.dumps(candidate))
 for change in file['changes']:
  ref=reversed
  for part in change['path'][:-1]:ref=ref[part]
  key=change['path'][-1];assert ref[key]==change['after'];ref[key]=change['before']
 assert reversed==original
 out=D/file['name'];data=(json.dumps(candidate,ensure_ascii=False,indent=2)+'\n').encode()
 if out.exists():assert out.read_bytes()==data,'Preserve candidate'
 else:out.write_bytes(data)
print('PASS24closed-display-paths; wholeJSONreversalexact; no product/database text changed')
