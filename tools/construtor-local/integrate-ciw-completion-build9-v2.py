"""Use the same four-file integration policy for immutable freshstage v2."""
from pathlib import Path
source=Path(__file__).with_name('integrate-ciw-completion-build9.py').read_text()
source=source.replace('official-build9','official-build9-v2')
source=source.replace('f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86','534e616a93a58357221052aee0c66ccda5f254a56c4d7d97db348ec9c928ce4a')
source=source.replace('bc69edbbed5fd6a5b462567347719312bcf79d033e57751a4cf4a7d116107ccf','65e516dab77630ee08f485786a930a6f03a9fba052a1012b29a836f716b9909e')
exec(compile(source,__file__,'exec'))
