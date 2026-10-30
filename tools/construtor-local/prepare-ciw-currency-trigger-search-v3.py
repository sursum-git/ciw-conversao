"""Use a variable argument for SEARCH on OE12.2, preserving the fixed four paths."""
from pathlib import Path
source=Path(__file__).with_name('prepare-ciw-currency-trigger-search.py').read_text()
source=source.replace('currency-trigger-search-v1','currency-trigger-search-v3')
source=source.replace('resolved=SEARCH(SUBSTRING(item,1,LENGTH(item)-1)+"r").','item=REPLACE(item,".p",".r").\n resolved=SEARCH(item).')
source=source.replace("compile='''OUTPUT", "compile='''DEFINE VARIABLE compileMessage AS INTEGER NO-UNDO.\nOUTPUT")
source=source.replace('PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.', 'PUT UNFORMATTED "ERROR=" COMPILER:ERROR SKIP.\nDO compileMessage=1 TO ERROR-STATUS:NUM-MESSAGES:\n PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(compileMessage) SKIP.\nEND.')
source=source.replace("$log=Get-Content -LiteralPath 'compile.log' -Raw", "$log=Get-Content -LiteralPath 'compile.log' -Raw\nWrite-Output $log")
exec(compile(source,__file__,'exec'))
