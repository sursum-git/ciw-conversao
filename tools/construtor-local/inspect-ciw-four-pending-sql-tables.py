"""SQLTables metadata only, fixed four names, no free SQL or business rows."""
from pathlib import Path
import sys,json,getpass
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
target=S/'sql-four-pending-tables-metadata-v1.json';assert not target.exists()
source=(R/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text();php=source.split("php=r'''",1)[1].split("'''",1)[0];php=php[:php.index("$out=['profile'")]+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');set_error_handler(function(){return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);$started=microtime(true);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'scope'=>'espec_pro/PUB exact four table names under observed SQL profile','metadataOnly'=>true,'sqlExecuted'=>false,'businessReads'=>false,'businessWrites'=>false,'tables'=>[]];
if($db){foreach(['tipos_valor','empresas_imposto','desenhos','tipos_desenho'] as$name){
 $rs=odbc_tables($db,null,'PUB',$name,null);if(!$rs)throw new RuntimeException('SQLTables unavailable');$matches=[];$reads=0;
 while(($row=odbc_fetch_array($rs))!==false){
  if(++$reads>200||microtime(true)-$started>10)throw new RuntimeException('Metadata bounds exceeded');$row=array_change_key_case($row,CASE_UPPER);
  if(strcasecmp($row['TABLE_SCHEM']??$row['TABLE_OWNER']??'','PUB')!==0||strcasecmp($row['TABLE_NAME']??'',$name)!==0)continue;
  $matches[]=['schema'=>'PUB','table'=>$name,'type'=>$row['TABLE_TYPE']??null];
 }
 odbc_free_result($rs);$result['tables'][]=['schema'=>'PUB','table'=>$name,'exactMatches'=>$matches,'found'=>count($matches)>0];
}odbc_close($db);}
$result['durationMs']=(int)round((microtime(true)-$started)*1000);if(count($result['tables'])!==4||$result['durationMs']>10000)throw new RuntimeException('Incomplete metadata');
restore_error_handler();unset($values,$cfg,$data,$raw,$db);echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'metadataOnly'=>true,'sqlExecuted'=>false,'businessWrites'=>false]);}
'''
assert 'odbc_exec(' not in php and 'odbc_prepare(' not in php and 'odbc_execute(' not in php
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=35);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed table metadata inspection failed'
 result=json.loads(raw);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:password=None;c.close()
