"""Retrieve only existing outputs of failed10; no upload/command/replay."""
from pathlib import Path
import json
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build10'
plan=json.loads((B/'remote-plan.json').read_text());target=B/'inspect-failure-plan.json';assert not target.exists()
downloads=[x for x in plan['downloads'] if x['remote'].endswith(('.log','net-library.txt'))]
for row in downloads:row['optional']=True
assert len(downloads)>=2
target.write_text(json.dumps(dict(server='compiler',commands=[],downloads=downloads),indent=2)+'\n')
print('Prepared download-only compile/test diagnostics, no replay')
