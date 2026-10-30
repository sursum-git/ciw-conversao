"""Keep the failed probe unchanged and add compiler diagnostics in fresh staging."""
from pathlib import Path
source=Path(__file__).with_name('prepare-ciw-currency-trigger-search.py').read_text()
source=source.replace('currency-trigger-search-v1','currency-trigger-search-v2')
source=source.replace("compile='''OUTPUT", "compile='''DEFINE VARIABLE compileMessage AS INTEGER NO-UNDO.\nOUTPUT")
source=source.replace('PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.', 'PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.\nDO compileMessage=1 TO ERROR-STATUS:NUM-MESSAGES:\n PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(compileMessage) SKIP.\nEND.')
exec(compile(source,__file__,'exec'))
