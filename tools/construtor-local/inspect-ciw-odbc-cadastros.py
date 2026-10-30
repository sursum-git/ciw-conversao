"""Catalogo ODBC da conexao principal legada; segredos permanecem em memoria."""
import getpass,json,sys
from pathlib import Path
R=Path(__file__).resolve().parents[2];sys.path.insert(0,str(R/'.runtime/ssh-deps'));import paramiko
PHP=r'''<?php
ini_set('display_errors','0');
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))exit(2);
$data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
$c=$data['PROFILE']['especw'];$result=['profile'=>'especw','keys'=>array_keys($c),'odbcAvailable'=>function_exists('odbc_connect')];
if(!$result['odbcAvailable']){echo json_encode($result);exit;}
$v=[];foreach(['VAL_HOST','VAL_USER','VAL_PASS'] as $key){$t=$c[$key]??'';$v[$key]=is_string($t)&&strncmp($t,'enc_nm_enc_v1',13)===0?decode_string($t):$t;}
$db=@odbc_connect($v['VAL_HOST'],$v['VAL_USER'],$v['VAL_PASS']);unset($v,$c,$data,$raw);
if(!$db){$result['connected']=false;$state=odbc_error();$result['sqlState']=preg_match('/^[A-Z0-9]{5}$/',$state)?$state:null;
 $error=strtolower(odbc_errormsg());$category='unclassified';
 foreach(['driver'=>['could not be loaded','can\'t open lib','unable to load','specified driver'],'authentication'=>['password','authentication','authorization'],'network'=>['connection refused','timed out','connection failure','tcp/ip']] as $name=>$matches){foreach($matches as $match)if(strpos($error,$match)!==false)$category=$name;}
 $result['failureCategory']=$category;unset($error);echo json_encode($result);exit;}
$result['connected']=true;$result['tables']=[];
$rs=@odbc_tables($db);if(!$rs){$result['catalogRead']=false;}else{
 $result['catalogRead']=true;while($row=odbc_fetch_array($rs)){
  $name=strtolower($row['TABLE_NAME']??'');
  if(strpos($name,'tipo')!==false&&strpos($name,'valor')!==false||strpos($name,'empresa')!==false&&strpos($name,'imposto')!==false){
   $safe=['name'=>$row['TABLE_NAME'],'schema'=>$row['TABLE_SCHEM']??null,'type'=>$row['TABLE_TYPE']??null,'columns'=>[]];
   $cols=@odbc_columns($db,null,$row['TABLE_SCHEM']??null,$row['TABLE_NAME'],'%');
   if($cols)while($col=odbc_fetch_array($cols))$safe['columns'][]=['name'=>$col['COLUMN_NAME'],'type'=>$col['TYPE_NAME'],'size'=>$col['COLUMN_SIZE'],'nullable'=>$col['NULLABLE']];
   $result['tables'][]=$safe;
  }
 }
}
odbc_close($db);echo json_encode($result);
'''
s=paramiko.SSHClient();s.load_host_keys(str(Path.home()/'.ssh/known_hosts'));s.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 s.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=s.exec_command('php',timeout=60);inp.write(PHP);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
 if out.channel.recv_exit_status()!=0:raise RuntimeError('Catalogo ODBC indisponivel')
 result=json.loads(raw);(R/'.runtime/ciw-cadastros-20261020/odbc-catalog.json').write_text(json.dumps(result,indent=2));print(json.dumps(result))
finally:password=None;s.close()
