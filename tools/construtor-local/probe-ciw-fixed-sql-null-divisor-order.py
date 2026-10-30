"""Five new constant expressions for NULL/division evaluation order; fixed profile only."""
from pathlib import Path
R=Path(__file__).resolve().parents[2]
source=(R/'tools/construtor-local/probe-ciw-fixed-sql-aggregate-literals.py').read_text()
source=source.replace('sql-fixed-aggregate-parity-v1.json','sql-fixed-null-divisor-order-v1.json')
start=source.index(' $queries=[');end=source.index('\n foreach($queries',start)
queries=r'''
 $queries=[];
 $expressions=[
  'null_div_zero'=>$null.' / CAST(0 AS DECIMAL(20,2))',
  'null_div_zero_over_five'=>$null.' / (CAST(0 AS DECIMAL(20,2)) / CAST(5 AS DECIMAL(20,2)))',
  'null_div_one_over_zero'=>$null.' / (CAST(1 AS DECIMAL(20,2)) / CAST(0 AS DECIMAL(20,2)))',
  'one_plus_null_div_two_over_zero'=>'(CAST(1 AS DECIMAL(20,2)) + '.$null.') / ((CAST(1 AS DECIMAL(20,2)) + CAST(1 AS DECIMAL(20,2))) / CAST(0 AS DECIMAL(20,2)))',
  'one_plus_null_div_zero_over_five'=>'(CAST(1 AS DECIMAL(20,2)) + '.$null.') / ((CAST(1 AS DECIMAL(20,2)) + CAST(-1 AS DECIMAL(20,2))) / CAST(5 AS DECIMAL(20,2)))'
 ];
 foreach($expressions as$name=>$expression)$queries[$name]='SELECT '.$expression.' AS literal_result, CASE WHEN ('.$expression.') IS NULL THEN 1 ELSE 0 END AS result_is_null'.$anchor;
'''
source=source[:start]+queries+source[end:]
source=source.replace('echo json_encode($result);','echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);')
exec(compile(source,__file__,'exec'))
