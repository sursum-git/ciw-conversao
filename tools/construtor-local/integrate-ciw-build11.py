"""Reuse guarded atomic integration for exactly five approved 1055 files."""
from pathlib import Path
source=Path(__file__).with_name('integrate-ciw-completion-build9.py').read_text()
source=source.replace('official-build9','official-build11').replace('ciw-build9-tmp','ciw-build11-tmp')
source=source.replace('f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86','4a51bdd4de366fde34c6ff91635b6127aaf48f8cdce0057577d3ef1ef12ff2fa')
source=source.replace('bc69edbbed5fd6a5b462567347719312bcf79d033e57751a4cf4a7d116107ccf','58c68d304e81db0c5f4cf2b49eae5d38e70ea7cf3e5fff3e4af1882525106a1a')
source=source.replace("proof['totalChecks']==1080","proof['totalChecks']==384").replace("len(plan['files'])==4","len(plan['files'])==5")
source=source.replace('PASS four canonical','PASS five canonical')
exec(compile(source,__file__,'exec'))
