"""Prepare one bounded read-only, sanitized Scriptcase source collection."""
from pathlib import Path
import hashlib,json,re
root=Path(__file__).resolve().parents[2]
request=root/'.runtime/ciw-completion-20261028/next-source-request19c.json'
assert hashlib.sha256(request.read_bytes()).hexdigest()=='ca2c43999847c11c0614b678242c51973d5eadd8d358665a91c9b1829972765e'
apps=json.loads(request.read_text(encoding='utf-8-sig'))['applications']
assert len(apps)==19 and len(set(apps))==19 and all(re.fullmatch(r'[A-Za-z0-9_]+',name) for name in apps)
text=(root/'tools/construtor-local/inspect-ciw-completion-next20b-source.py').read_text(encoding='utf-8')
text=re.sub(r'^ apps=\[.*\]$',lambda _:' apps='+repr(apps),text,count=1,flags=re.M)
text=text.replace('ciw-completion-next20b-20261028','ciw-completion-next19c-20261028')
out=root/'tools/construtor-local/inspect-ciw-completion-next19c-source.py'
assert not out.exists()
out.write_text(text,encoding='utf-8')
print('Prepared exact19source allowlist; remote read only; sanitized in memory before saving')
