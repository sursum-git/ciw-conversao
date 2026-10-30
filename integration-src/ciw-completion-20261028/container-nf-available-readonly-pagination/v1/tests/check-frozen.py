from pathlib import Path
import hashlib,json
P=Path(__file__).resolve().parents[1]
if (P/'frozen-v1/manifest.json').exists():P=P/'frozen-v1'
manifest=P/'manifest.json';m=json.loads(manifest.read_text());R=Path(m['runtimeRoot'])
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
for item in m['sourceFiles']:assert sha(P/item['path'])==item['sha256'],item['path']
for item in m['runtimeFiles']:assert sha(R/item['path'])==item['sha256'],item['path']
for item in m['candidates']:assert sha(Path(item['frozenCandidatePath']))==item['candidateSha256']
p=m['proof'];assert p['success'] and p['ablChecksTotal']==5704 and p['phpTests']==990 and p['phpAssertions']==7119 and p['nativeChecks']==23
assert m['gates']['official122']==False and m['gates']['runtimePublished']==False and m['gates']['metadataReady']==False
print(json.dumps({'candidateReady':True,'manifestSha256':sha(manifest),'productionFiles':len(m['candidates']),'sourceFiles':len(m['sourceFiles']),'runtimeFiles':len(m['runtimeFiles']),'TT':p['ablChecksTotal'],'php':[p['phpTests'],p['phpAssertions']],'native':p['nativeChecks'],'official122':False,'published':False}))
