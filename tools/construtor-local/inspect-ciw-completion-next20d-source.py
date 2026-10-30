"""Reuse the sanitized collector with the reviewed exact20d source-only request."""
from pathlib import Path
import hashlib,json,re
ROOT=Path(__file__).resolve().parents[2]
request=ROOT/'.runtime/ciw-completion-20261028/next-source-request20d.json'
assert hashlib.sha256(request.read_bytes()).hexdigest()=='419dd04cad7b537fe5d48364befa81a8273beaabccbe03c52f7f6bbe66efb2be'
spec=json.loads(request.read_text(encoding='utf-8'))
apps=spec['activeApplications']+spec['historicalComparisons']
assert len(apps)==20 and len(set(apps))==20 and spec['remoteReadOnly']and spec['sanitizeSensitiveLiterals']
assert all(re.fullmatch('[A-Za-z0-9_]+',name)for name in apps)
source=ROOT/'tools/construtor-local/inspect-ciw-completion-next19c-source.py'
text=source.read_text(encoding='utf-8')
text,n=re.subn(r'^ apps=\[.*?\]$',lambda _: ' apps='+repr(apps),text,flags=re.M)
assert n==1
text=text.replace('ciw-completion-next19c-20261028','ciw-completion-next20d-20261028')
assert not (ROOT/'sources/scriptcase/ciw-completion-next20d-20261028').exists()
exec(compile(text,str(source),'exec'),{'__file__':str(source),'__name__':'__main__'})
