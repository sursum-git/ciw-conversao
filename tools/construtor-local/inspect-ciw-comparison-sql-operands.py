"""SQLColumns only for nine pinned operands; no query, DDL, DML or business values."""
from pathlib import Path
import sys,json,getpass,hashlib,base64
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
request=R/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/sql-operand-metadata-request-v1.json'
assert sha(request)=='c7900f2c631ae446ebe8beeefa45fd1c29c35da2aa52e2b70e89cbb1e17ca448'
spec=json.loads(request.read_text());assert len(spec['columns'])==9 and spec['policy']['metadataOnly'] and not spec['policy']['sqlExecute']
for item in spec['schemas']+[spec['sourceContract']]:assert sha(R/item['path'])==item['sha256']
target=S/'sql-comparison-operand-metadata-v1.json';assert not target.exists()
source=(R/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text();php=source.split("php=r'''",1)[1].split("'''",1)[0];php=php[:php.index("$out=['profile'")]
payload=base64.b64encode(json.dumps(spec['columns']).encode()).decode()
php+="$columns=json_decode(base64_decode('"+payload+"'),true);\n"+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');set_error_handler(function(){return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);$started=microtime(true);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'metadataOnly'=>true,'sqlExecuted'=>false,'businessReads'=>false,'businessWrites'=>false,'columns'=>[]];
if($db){foreach($columns as$entry){
 $rs=odbc_columns($db,null,$entry['schema'],$entry['table'],$entry['column']);$matches=[];$rows=0;
 if(!$rs)throw new RuntimeException('SQLColumns unavailable');
 while(($row=odbc_fetch_array($rs))!==false){
  if(++$rows>500||microtime(true)-$started>10)throw new RuntimeException('Metadata bounds exceeded');
  $row=array_change_key_case($row,CASE_UPPER);
  if(strcasecmp($row['TABLE_SCHEM']??$row['TABLE_OWNER']??'',$entry['schema'])!==0||strcasecmp($row['TABLE_NAME']??'',$entry['table'])!==0||strcasecmp($row['COLUMN_NAME']??'',$entry['column'])!==0)continue;
  $matches[]=['schema'=>$entry['schema'],'table'=>$entry['table'],'column'=>$entry['column'],'dataType'=>$row['TYPE_NAME']??null,'sqlType'=>$row['DATA_TYPE']??null,'precision'=>$row['COLUMN_SIZE']??$row['PRECISION']??null,'scale'=>$row['DECIMAL_DIGITS']??$row['SCALE']??null];
 }
 odbc_free_result($rs);if(count($matches)!==1)throw new RuntimeException('One exact column required');$result['columns'][]=$matches[0];
}odbc_close($db);}
$result['durationMs']=(int)round((microtime(true)-$started)*1000);if(count($result['columns'])!==9||$result['durationMs']>10000)throw new RuntimeException('Metadata incomplete');
restore_error_handler();unset($values,$cfg,$data,$raw,$db);echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'metadataOnly'=>true,'sqlExecuted'=>false,'businessWrites'=>false]);}
'''
assert 'odbc_exec(' not in php and 'odbc_prepare(' not in php and 'odbc_execute(' not in php
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=35);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed SQLColumns inspection failed'
 result=json.loads(raw);result['requestSha256']=sha(request);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
