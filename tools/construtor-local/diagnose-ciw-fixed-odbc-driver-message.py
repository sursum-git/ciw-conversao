"""One diagnostic after fixed binding/driver/architecture proof; no SQL statement."""
from pathlib import Path
import sys,json,getpass,importlib.util
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
target=ROOT/'.runtime/ciw-completion-20261028/sql-fixed-driver-message-v1.json';assert not target.exists()
state=target.parent
for name in ['sql-fixed-dsn-transport-readonly-v1.json','sql-fixed-driver-readonly-v1.json','sql-fixed-broker-readonly-v1.json','sql-fixed-odbc-runtime-readonly-v1.json']:
 assert json.loads((state/name).read_text())['success']
# Reuse only the established in-memory credential/profile parser, not its connection/query runner.
source=(ROOT/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text()
php=source.split("php=r'''",1)[1].split("'''",1)[0]
php=php[:php.index("$out=['profile'")]+r'''
$warning='';set_error_handler(function($level,$message)use(&$warning){$warning.=' '.$message;return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);restore_error_handler();
$error=$warning.' '.odbc_errormsg();
foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);
$error=preg_replace('/\b(?:PWD|PASSWORD|UID|USER(?:NAME)?|TOKEN|SECRET)\s*=\s*[^;\s]+/i','$1=[private-value-omitted]',$error);
$out=['success'=>true,'fixedProfile'=>'ems206espPRO','connected'=>(bool)$db,'sqlExecuted'=>false,'businessReads'=>false,'businessWrites'=>false];
// Redacted diagnostic remains private; no configuration or credential values are retained.
$out['redactedDriverDiagnostic']=$error;
$out['numericCodes']=[];if(preg_match_all('/(?<![A-Za-z0-9])[-]?[0-9]{1,8}(?![A-Za-z0-9])/',$error,$codes))$out['numericCodes']=array_values(array_unique($codes[0]));
if($db)odbc_close($db);
unset($warning,$error,$privateValue,$values,$cfg,$data,$raw,$db);echo json_encode($out);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'sqlExecuted'=>false,'businessReads'=>false,'businessWrites'=>false]);}
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=65);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed driver diagnostic failed'
 result=json.loads(raw);assert result['sqlExecuted'] is False
 target.write_text(json.dumps(result,indent=2)+'\n')
 print(json.dumps({k:v for k,v in result.items() if k!='redactedDriverDiagnostic'}))
finally:password=None;c.close()
