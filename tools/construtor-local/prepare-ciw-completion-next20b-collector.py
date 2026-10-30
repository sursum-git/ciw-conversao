"""Prepare a second one-time sanitized source cohort; no legacy PHP execution."""
from pathlib import Path
import hashlib,json,re
r=Path(__file__).resolve().parents[2];request=r/'.runtime/ciw-completion-20261028/next-source-request20b.json'
assert hashlib.sha256(request.read_bytes()).hexdigest()=='a48662a4733f0e227686fb6bc2ffef2a089e6414195b78fd579dff3e8ff7d366'
q=json.loads(request.read_text(encoding='cp1252'));apps=q['applications'];assert len(apps)==20 and len(set(apps))==20 and all(re.fullmatch(r'[A-Za-z0-9_]+',n)for n in apps)
text=(r/'tools/construtor-local/inspect-ciw-completion-next20-source.py').read_text()
text=re.sub(r'^ apps=\[.*\]$',lambda _: ' apps='+repr(apps),text,count=1,flags=re.M)
text=text.replace('ciw-completion-next20-20261028','ciw-completion-next20b-20261028')
text=text.replace('senha|password|passwd|token|secret|bindpw|bind_pw','senha|password|passwd|banco_pass|nm_db_pass|token|secret|bindpw|bind_pw|api[_-]?key|access[_-]?key|(?<![A-Za-z])pwd(?![A-Za-z])')
out=r/'tools/construtor-local/inspect-ciw-completion-next20b-source.py';assert not out.exists();out.write_text(text,encoding='utf-8')
print('Prepared exact20source allowlist; sanitized entirely in memory before saving; no execution of PHP')
