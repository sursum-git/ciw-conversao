"""Bind the reviewed official verifier to the fresh23-entry harness companion."""
from pathlib import Path
source=Path(__file__).with_name('verify-ciw-completion-build9-official.py').read_text()
source=source.replace('official-build9','official-build9-v2')
source=source.replace('f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86','534e616a93a58357221052aee0c66ccda5f254a56c4d7d97db348ec9c928ce4a')
source=source.replace('f404c8506bcd246361beb5caf11502d0f5903770bfb26e1aeff4af54a224e0a4','2e793c238dc6acf2b7d9be1834d5e320301fd885e165f51c86cffd2683eb9adf')
source=source.replace('compileCount=24','compileCount=23').replace('24compiles','23compiles')
exec(compile(source,__file__,'exec'))
