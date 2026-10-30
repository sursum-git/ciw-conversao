"""Prepare fresh read-only hashes/vendor state for exactly four 1055 artifacts."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];d=r/'.runtime/ciw-completion-20261028/runtime-build11';d.mkdir()
old=r/'.runtime/ciw-completion-20261028/runtime-build10/inspect-runtime.py'
text=old.read_text().replace('wave7','wave8')
start=text.index('rels=');end=text.index('\nfor rel in rels:',start)
rels=['sursum-api/programs/'+name+suffix for name in ['CiwErpReadService','CiwCadastrosCrud']for suffix in ['.p','.r']]
text=text[:start]+'rels='+repr(rels)+text[end:]
text=text.replace('PASS2runtime','PASS4runtime')
(d/'inspect-runtime.py').write_text(text)
stage='/tmp/ciw-completion-20261028-wave8'
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((d/'inspect-runtime.py').relative_to(r)),remote=stage+'/inspect-runtime.py')],commands=['python3 '+stage+'/inspect-runtime.py'],downloads=[dict(local=str((d/'runtime-before.json').relative_to(r)),remote=stage+'/runtime-before.json')])
(d/'inspect-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared four exact runtime hashes and vendor state read-only inspection')
