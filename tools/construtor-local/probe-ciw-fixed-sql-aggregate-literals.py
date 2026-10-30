"""Follow-up literal-only aggregate/type proof; no DDL, DML or business projection."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-aggregate-parity-v1.json';assert not target.exists()
assert json.loads((target.parent/'sql-fixed-literal-parity-v1.json').read_text())['connected']
source=(ROOT/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text()
php=source.split("php=r'''",1)[1].split("'''",1)[0]
php=php[:php.index("$out=['profile'")]+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');ini_set('display_errors','0');set_error_handler(function(){return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'checks'=>[],'businessWrites'=>false,'businessValuesProjected'=>false,'globalConfigChanged'=>false];
if($db){
 $anchor=' FROM PUB.empresas WHERE empresa_id=2';
 $date="CAST('2026-01-15' AS DATE)";$null='CAST(NULL AS DECIMAL(20,2))';
 $queries=[
  'null_arithmetic_isnull'=>'SELECT '.$null.' AS raw_null, '.$null.' / 1 AS divided, '.$null.' + 1 AS added, CASE WHEN ('.$null.' / 1) IS NULL THEN 1 ELSE 0 END AS divided_is_null, CASE WHEN ('.$null.' + 1) IS NULL THEN 1 ELSE 0 END AS added_is_null'.$anchor,
  'sum_empty'=>'SELECT SUM(CAST(10 AS DECIMAL(20,2))) AS sum_value, COALESCE(SUM(CAST(10 AS DECIMAL(20,2))),0) AS coalesced, CAST(100 AS DECIMAL(20,2))-SUM(CAST(10 AS DECIMAL(20,2))) AS difference'.$anchor.' AND 1=0',
  'sum_all_null'=>'SELECT SUM('.$null.') AS sum_value, COALESCE(SUM('.$null.'),0) AS coalesced, CAST(100 AS DECIMAL(20,2))-SUM('.$null.') AS difference'.$anchor,
  'union_date_equal'=>'SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor.' UNION SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor,
  'union_all_date_equal'=>'SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor.' UNION ALL SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor,
  'union_date_null'=>'SELECT '.$date.' AS datum, '.$null.' AS amount'.$anchor.' UNION SELECT '.$date.' AS datum, '.$null.' AS amount'.$anchor,
  'union_all_date_null'=>'SELECT '.$date.' AS datum, '.$null.' AS amount'.$anchor.' UNION ALL SELECT '.$date.' AS datum, '.$null.' AS amount'.$anchor,
  'union_date_signed'=>'SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor.' UNION SELECT '.$date.' AS datum, CAST(-10 AS DECIMAL(20,2)) AS amount'.$anchor,
  'union_date_empty'=>"SELECT '' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount".$anchor.' UNION SELECT '.$date.' AS datum, CAST(10 AS DECIMAL(20,2)) AS amount'.$anchor
 ];
 foreach($queries as$name=>$sql){
  $rs=odbc_exec($db,$sql);$entry=['executed'=>(bool)$rs,'literalRows'=>[]];
  if($rs){
   $types=[];for($i=1;$i<=odbc_num_fields($rs);$i++)$types[odbc_field_name($rs,$i)]=odbc_field_type($rs,$i);$entry['fieldTypes']=$types;
   while(($row=odbc_fetch_array($rs))!==false){$entry['literalRows'][]=$row;if(count($entry['literalRows'])>10)throw new RuntimeException('Fixed literal row bound exceeded');}
   odbc_free_result($rs);
  }else{
   $state=odbc_error($db);$error=odbc_errormsg($db);
   foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);
   $entry['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{1,5}$/',$state)?$state:null;$entry['redactedDiagnostic']=$error;
  }
  $result['checks'][$name]=$entry;
 }
 odbc_close($db);
}
restore_error_handler();unset($values,$cfg,$data,$raw,$db,$sql,$queries,$privateValue,$error);echo json_encode($result);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'businessWrites'=>false]);}
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed literal aggregate probe failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');summary={k:v for k,v in result.items() if k!='checks'};summary['checks']={k:{x:y for x,y in v.items() if x!='redactedDiagnostic'} for k,v in result.get('checks',{}).items()};print(json.dumps(summary))
finally:password=None;c.close()
