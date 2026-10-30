"""Le perfis de origem do CIW: somente tipo/host/base, sem usuario ou senha."""
import getpass,json,sys
from pathlib import Path
R=Path(__file__).resolve().parents[2];sys.path.insert(0,str(R/'.runtime/ssh-deps'));import paramiko
PHP=r'''<?php
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))exit(2);
$data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
$result=[];
foreach(['comum','ems2med','ems5','especw','espec','ticontrole2'] as $name){
 $c=isset($data['PROFILE'][$name])?$data['PROFILE'][$name]:null;
 if(!is_array($c)){$result[$name]=['found'=>false];continue;}
 $out=['found'=>true];
 foreach(['VAL_TYPE','VAL_HOST','VAL_BASE'] as $key){
  $v=isset($c[$key])?$c[$key]:null;
  if(is_string($v)&&strncmp($v,'enc_nm_enc_v1',13)===0)$v=decode_string($v);
  if(is_string($v)&&strlen($v)<=160&&preg_match('/^[A-Za-z0-9_.:,\\\\ -]*$/',$v))$out[$key]=$v;
 }
 $result[$name]=$out;
}
$odbc=[];
foreach(['/etc/odbc.ini','/usr/local/etc/odbc.ini'] as $path){
 if(!is_file($path))continue;$ini=parse_ini_file($path,true,INI_SCANNER_RAW);
 foreach(['comum_pro','med_pro','ems5_pro','espec_pro','espec_w_pro'] as $dsn){
  if(!isset($ini[$dsn]))continue;$safe=[];
  foreach($ini[$dsn] as $key=>$value)if(in_array(strtolower($key),['hostname','portnumber','databasename','driver','host','port','database'],true))$safe[$key]=$value;
  $odbc[$dsn]=$safe;
 }
}
$result['odbc']=$odbc;
echo json_encode($result);
'''
s=paramiko.SSHClient();s.load_host_keys(str(Path.home()/'.ssh/known_hosts'));s.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 s.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=s.exec_command('php',timeout=30);inp.write(PHP);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
 if out.channel.recv_exit_status()!=0:raise RuntimeError('Metadados indisponiveis')
 result=json.loads(raw);(R/'.runtime/ciw-cadastros-20261020/source-profiles.json').write_text(json.dumps(result,indent=2));print(json.dumps(result))
finally:password=None;s.close()


