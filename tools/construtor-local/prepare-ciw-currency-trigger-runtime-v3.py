"""Prepare execution for the successful SEARCH variable-argument companion."""
from pathlib import Path
source=Path(__file__).with_name('prepare-ciw-currency-trigger-runtime.py').read_text()
source=source.replace('currency-trigger-search-v1','currency-trigger-search-v3').replace('search-20261028-v1','search-20261028-v3')
exec(compile(source,__file__,'exec'))
