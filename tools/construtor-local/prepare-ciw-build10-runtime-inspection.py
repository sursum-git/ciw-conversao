"""Reuse read-only vendor inspection, narrowed to Service.p/r and a fresh stage."""
from pathlib import Path
source=Path(__file__).with_name('prepare-ciw-build9-runtime-inspection.py').read_text()
source=source.replace('runtime-build9-v2','runtime-build10').replace('wave6','wave7')
source=source.replace("['ContainersPainelFinanceReadService','ContainersPainelFinanceRead']","['ContainersPainelFinanceReadService']")
source=source.replace('PASS4runtime','PASS2runtime')
exec(compile(source,__file__,'exec'))
