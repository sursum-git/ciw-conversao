"""Prepare read-only inspection for the four proposed NF reader runtime artifacts."""
from pathlib import Path
import json
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/runtime-build9-v2'
assert not B.exists();B.mkdir()
stage='/tmp/ciw-completion-20261028-wave6'
rels=['sursum-api/programs/'+name+ext for name in ['ContainersPainelFinanceReadService','ContainersPainelFinanceRead'] for ext in ['.p','.r']]
source=(R/'tools/construtor-local/prepare-ciw-completion-build8-runtime.py').read_text()
script=source.split("script='''",1)[1].split("'''.replace('STAGE'",1)[0]
script=script.replace('STAGE',repr(stage)).replace('RELS',repr(rels)).replace('PASS19runtime','PASS4runtime')
(B/'inspect-runtime.py').write_text(script)
plan=dict(server='runtime',directories=[stage],uploads=[dict(local=str((B/'inspect-runtime.py').relative_to(R)),remote=stage+'/inspect-runtime.py')],commands=['python3 '+stage+'/inspect-runtime.py'],downloads=[dict(local=str((B/'runtime-before.json').relative_to(R)),remote=stage+'/runtime-before.json')])
(B/'inspect-runtime-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
print('Prepared four target hashes and vendor transport/session inspection; no mutation')
