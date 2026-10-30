from pathlib import Path
import hashlib,json
ROOT=Path(__file__).resolve().parents[1];FROZEN=ROOT if (ROOT/'manifest.json').exists()else ROOT/'frozen-v1'
manifest=json.loads((FROZEN/'manifest.json').read_text(encoding='utf-8'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
for row in manifest['files']:assert sha(FROZEN/row['path'])==row['sha256'],row['path']
plan=json.loads((FROZEN/'patches/patch-plan.json').read_text())
for row in plan['files']:
 old=(FROZEN/row['baselineFile']).read_bytes();new=(FROZEN/row['candidateFile']).read_bytes();assert hashlib.sha256(old).hexdigest()==row['baselineSha256'];actual=old
 for h in reversed(row['hunks']):
  offset=h['oldOffset'];before=bytes.fromhex(h['oldBytesHex']);after=bytes.fromhex(h['newBytesHex']);assert actual[offset:offset+len(before)]==before;actual=actual[:offset]+after+actual[offset+len(before):]
 assert actual==new
print(json.dumps({'success':True,'files':len(manifest['files']),'exactShared':len(plan['files']),'manifestSha256':sha(FROZEN/'manifest.json'),'canonicalWrites':False}))
