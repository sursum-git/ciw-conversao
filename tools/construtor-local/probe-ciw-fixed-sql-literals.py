"""Closed literal parity checks through the proven fixed DSN, no business values/DML."""
from pathlib import Path
import sys,json,getpass
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-literal-parity-v1.json';assert not target.exists()
assert json.loads((target.parent/'sql-fixed-odbcini-process-v1.json').read_text())['connected']
source=(ROOT/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text()
php=source.split("php=r'''",1)[1].split("'''",1)[0]
php=php[:php.index("$out=['profile'")]+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');ini_set('display_errors','0');
set_error_handler(function(){return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);
$result=['success'=>(bool)$db,'profile'=>'ems206espPRO','fixedDsn'=>'espec_pro','fixedProcessOdbcIni'=>'/etc/odbc.ini','connected'=>(bool)$db,'checks'=>[],'businessWrites'=>false,'businessValuesProjected'=>false,'globalConfigChanged'=>false];
if($db){
 $anchor=' FROM PUB.empresas WHERE empresa_id=2';
 $queries=[
  'one_div_zero'=>'SELECT 1 / 0 AS literal_result'.$anchor,
  'zero_div_zero'=>'SELECT 0 / 0 AS literal_result'.$anchor,
  'null_div_one'=>'SELECT CAST(NULL AS DECIMAL(10,2)) / 1 AS literal_result'.$anchor,
  'null_plus_one'=>'SELECT CAST(NULL AS DECIMAL(10,2)) + 1 AS literal_result'.$anchor,
  'union_case'=>"SELECT CAST('ABC' AS VARCHAR(10)) AS v".$anchor." UNION SELECT CAST('abc' AS VARCHAR(10)) AS v".$anchor,
  'union_padding'=>"SELECT CAST('A' AS VARCHAR(10)) AS v".$anchor." UNION SELECT CAST('A ' AS VARCHAR(10)) AS v".$anchor,
  'union_numeric'=>'SELECT CAST(1.0 AS DECIMAL(10,2)) AS v'.$anchor.' UNION SELECT CAST(1.00 AS DECIMAL(10,2)) AS v'.$anchor,
  'union_nulls'=>'SELECT CAST(NULL AS VARCHAR(10)) AS v'.$anchor.' UNION SELECT CAST(NULL AS VARCHAR(10)) AS v'.$anchor
 ];
 foreach($queries as$name=>$sql){
  $rs=odbc_exec($db,$sql);$entry=['executed'=>(bool)$rs,'literalResults'=>[]];
  if($rs){while(($row=odbc_fetch_array($rs))!==false){$entry['literalResults'][]=array_values($row)[0];if(count($entry['literalResults'])>2)throw new RuntimeException('Fixed literal row bound exceeded');}}
  $error=odbc_errormsg($db);$state=odbc_error($db);
  foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);
  $entry['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{1,5}$/',$state)?$state:null;
  $entry['redactedDiagnostic']=$error;
  if($rs)odbc_free_result($rs);
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
 inp,out,err=c.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed literal probe failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n')
 summary={k:v for k,v in result.items() if k!='checks'};summary['checks']={k:{x:y for x,y in v.items() if x!='redactedDiagnostic'} for k,v in result.get('checks',{}).items()};print(json.dumps(summary))
finally:password=None;c.close()
