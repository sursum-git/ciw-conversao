"""Download existing compile diagnostics only; never replays the failed stage."""
from pathlib import Path
import json
R=Path(__file__).resolve().parents[2];B=R/'.runtime/ciw-completion-20261028/official-build9'
plan=json.loads((B/'remote-plan.json').read_text())
downloads=[x for x in plan['downloads'] if Path(x['remote']).name in ['compile.log','compile-process.log','net-library.txt']]
assert len(downloads)>=2
target=B/'inspect-compile-failure-plan.json';assert not target.exists()
target.write_text(json.dumps(dict(server='compiler',commands=[],downloads=downloads),indent=2)+'\n')
print('Prepared download-only diagnostics; no upload or remote command')
