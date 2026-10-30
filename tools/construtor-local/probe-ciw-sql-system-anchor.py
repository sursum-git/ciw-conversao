"""Two fixed constants using documented one-row system relation; no business table."""
from pathlib import Path
R=Path(__file__).resolve().parents[2]
source=(R/'tools/construtor-local/probe-ciw-fixed-sql-aggregate-literals.py').read_text()
source=source.replace('sql-fixed-aggregate-parity-v1.json','sql-system-anchor-v1.json')
start=source.index(' $queries=[');end=source.index('\n foreach($queries',start)
queries=r'''
 $queries=[
  'system_one_row'=>'SELECT CAST(1 AS INTEGER) AS literal_value FROM SYSPROGRESS.SYSCALCTABLE',
  'derived_union_anchor'=>'SELECT d.literal_value FROM (SELECT CAST(1 AS INTEGER) AS literal_value FROM SYSPROGRESS.SYSCALCTABLE UNION ALL SELECT CAST(2 AS INTEGER) AS literal_value FROM SYSPROGRESS.SYSCALCTABLE) d ORDER BY d.literal_value'
 ];
'''
source=source[:start]+queries+source[end:]
source=source.replace('echo json_encode($result);','echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);')
exec(compile(source,__file__,'exec'))
