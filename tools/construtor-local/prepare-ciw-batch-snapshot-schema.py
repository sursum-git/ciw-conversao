"""Minimal closed JSON Schema delta, independent from ABL package6."""
from pathlib import Path
import json,hashlib,difflib
R=Path('D:/opencode/conversao-sc');C=Path('D:/opencode/construtor-pg/public/metadata/schemas/crud-definition-v1.schema.json');O=R/'integration-src/ciw-completion-20261028/native-batch-snapshot-schema'
before=C.read_bytes();old=json.loads(before);d=json.loads(before)
editing=d['$defs']['grid']['properties']['editing']
assert list(editing['properties'])==['mode'] and editing['additionalProperties'] is False
names={'type':'array','minItems':1,'maxItems':64,'uniqueItems':True,'items':{'type':'string','minLength':1,'maxLength':128,'pattern':'^[A-Za-z_][A-Za-z0-9_.-]*$'}}
editing['properties']['snapshot']={'type':'object','properties':{'originalFields':names,'contextFields':names},'required':['originalFields','contextFields'],'additionalProperties':False}
editing['allOf']=[{'if':{'required':['snapshot']},'then':{'properties':{'mode':{'const':'batch'}}}}]
# Replace just the editing object byte range, leaving every other schema byte.
marker=b'"editing": {';start=before.index(marker)+len(b'"editing": ');depth=0;quoted=False;escape=False;end=None
for i in range(start,len(before)):
 c=before[i]
 if escape:escape=False;continue
 if quoted:
  if c==92:escape=True
  elif c==34:quoted=False
 elif c==34:quoted=True
 elif c==123:depth+=1
 elif c==125:
  depth-=1
  if depth==0:end=i+1;break
assert end and json.loads(before[start:end])==old['$defs']['grid']['properties']['editing']
value=json.dumps(editing,indent=2,ensure_ascii=False).replace('\n','\n        ').encode();after=before[:start]+value+before[end:]
assert json.loads(after)==d
O.mkdir(parents=True,exist_ok=True);p=O/'crud-definition-v1.schema.json';p.write_bytes(after)
(O/'schema.patch').write_text(''.join(difflib.unified_diff(before.decode().splitlines(True),after.decode().splitlines(True),fromfile=str(C),tofile=str(C))),encoding='utf-8')
sha=lambda b:hashlib.sha256(b).hexdigest()
m={'status':'CANDIDATE_ONLY_SCHEMA_P2','target':str(C),'baselineSha256':sha(before),'candidateSha256':sha(after),'delta':'only $defs.grid.properties.editing snapshot and conditional mode=batch','existingFieldCrossReference':'existing JS CrudDefinitionValidator checks all names against dataModel and mandatory readonly context; JSON Schema checks closed shape and identifier syntax','canonicalWrites':False,'files':[{'path':f.name,'sha256':sha(f.read_bytes())} for f in [p,O/'schema.patch']]}
(O/'manifest.json').write_text(json.dumps(m,indent=2)+'\n');print(json.dumps({'success':True,'manifestSha256':sha((O/'manifest.json').read_bytes())}))
