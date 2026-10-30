"""One fixed legacy profile diagnostic; classifications only, no raw errors/secrets."""
from pathlib import Path
import getpass,json,sys,re
root=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(root/'.runtime/ssh-deps'))
import paramiko
php=r'''<?php
ini_set('display_errors','0');
try {
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))exit(2);
$data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
$cfg=$data['PROFILE']['ems206espPRO'];$values=[];
foreach(['VAL_HOST','VAL_USER','VAL_PASS']as$key){$v=$cfg[$key]??'';$values[$key]=is_string($v)&&strncmp($v,'enc_nm_enc_v1',13)===0?decode_string($v):$v;}
if($values['VAL_HOST']!=='espec_pro')exit(3);
$out=['profile'=>'ems206espPRO','dsn'=>'espec_pro','usernamePresent'=>is_string($values['VAL_USER'])&&$values['VAL_USER']!=='','passwordPresent'=>is_string($values['VAL_PASS'])&&$values['VAL_PASS']!=='','businessWrites'=>false];
$out['registeredDsnFound']=false;
foreach(['/etc/odbc.ini','/usr/local/etc/odbc.ini']as$file)if(is_file($file)){$ini=@parse_ini_file($file,true,INI_SCANNER_RAW);if(is_array($ini)&&isset($ini['espec_pro']))$out['registeredDsnFound']=true;}
$warning='';set_error_handler(function($level,$message)use(&$warning){$warning.=' '.$message;return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);restore_error_handler();
$error=$warning.' '.odbc_errormsg();$state=odbc_error();
$out['connected']=(bool)$db;$out['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{5}$/',$state)?$state:null;
$out['messageAvailable']=strlen(trim($error))>0;$out['categories']=[];
$patterns=['dsn_missing'=>'data source name not found|no default driver','library_load'=>'can.t open lib|could not be loaded|unable to load|file not found','license'=>'licen[cs]e|evaluation|expired','authentication'=>'authentication|authorization|password|invalid user','network'=>'timed out|connection refused|tcp\/ip|unable to connect|connection failure','encoding'=>'unicode|encoding|codepage','php_argument'=>'argument|typeerror|deprecated','driver_manager'=>'driver manager|unixodbc','progress_sql'=>'progress|openedge|datadirect'];
foreach($patterns as$key=>$pattern)if(preg_match('/'.$pattern.'/i',$error))$out['categories'][]=$key;
$known=['tcp','socket','connect','host','port','service','refused','timeout','server','name','resolve','data','source','specified','invalid','attribute','option','configuration','allocate','handle','environment','license','library','module','required','path','file','permission','denied','not','found','closed','terminated','reset','progress','datadirect','odbc','version','syntax','protocol','function','sequence','out','memory'];
$out['knownDiagnosticWords']=[];foreach($known as$word)if(preg_match('/\b'.preg_quote($word,'/').'\b/i',$error))$out['knownDiagnosticWords'][]=$word;
$out['warningStates']=[];if(preg_match_all('/\b(?:IM[0-9]{3}|HY[0-9]{3}|08[0-9]{3}|28[0-9]{3}|S[0-9]{4})\b/',$error,$matches))$out['warningStates']=array_values(array_unique($matches[0]));
$safeError=$error;foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$safeError=str_replace($privateValue,'[omitted]',$safeError);
$out['localizedCategories']=[];
$localized=['dsn_missing'=>'origem de dados|fonte de dados|data source|origen de datos','library_load'=>'carregar|biblioteca|módulo|modulo|load library','authentication'=>'autentica|autoriz|senha|contrase|usuário|usuario','network'=>'conexão|conexao|conexión|conexion|soquete|recusad|servidor|tcp|socket','encoding'=>'caractere|caracteres|codifica|conversão|conversao|translation|character|charset','license'=>'licença|licenca|licencia|licen[cs]e','environment'=>'ambiente|environment|odbcini|configura|configuration','memory'=>'memória|memoria|memory|alloc'];
foreach($localized as$key=>$pattern)if(preg_match('/'.$pattern.'/iu',$safeError))$out['localizedCategories'][]=$key;
$words=['sql','error','erro','estado','state','sqlstate','sqlconnect','sqldriverconnect','datadirect','odbc','lib','unixodbc','driver','manager','gerenciador','nome','origem','dados','encontrado','encontrada','não','nenhum','padrão','especificado','carregar','biblioteca','falha','senha','usuário','usuario','autenticação','conexão','conectar','host','servidor','fechado','soquete','protocolo','rede','recusada','expirou','timeout','tempo','limite','caractere','caracteres','codificação','conversão','licença','licenciado','memória','inválido','inválida','suportado','suportada','arquivo','módulo','diretório','permissão','negada','de','do','da','no','na','em','a','o','e'];
$out['mbLowerAvailable']=function_exists('mb_strtolower');
$out['warningUtf8Valid']=(bool)preg_match('//u',$safeError);
$out['technicalWordSequence']=[];if(preg_match_all('/[\p{L}_]+/u',$safeError,$tokens))foreach($tokens[0]as$token){$token=function_exists('mb_strtolower')?mb_strtolower($token,'UTF-8'):strtolower($token);if(in_array($token,$words,true))$out['technicalWordSequence'][]=$token;}
$out['standardWarningStates']=[];if(preg_match_all('/\b(?:01|02|07|08|21|22|23|24|25|28|40|42|44|HY|IM|S1)[A-Z0-9]{3}\b/',$safeError,$codes))$out['standardWarningStates']=array_values(array_unique($codes[0]));
unset($safeError,$privateValue,$tokens,$token,$codes);
if($db){$rs=@odbc_exec($db,'SELECT 1 AS literal_result FROM PUB.empresas WHERE empresa_id=2');$out['fixedLiteralRead']=(bool)$rs;if($rs)odbc_free_result($rs);odbc_close($db);}
unset($warning,$error,$state,$values,$cfg,$data,$raw,$db);echo json_encode($out);
} catch (Throwable $failure) {
 echo json_encode(['diagnosticFailed'=>true,'exceptionClass'=>get_class($failure),'diagnosticLine'=>$failure->getLine(),'businessWrites'=>false]);
}
'''
target=root/'.runtime/ciw-completion-20261028/sql-profile-diagnostic-v6.json'
assert not target.exists(),'Inspect existing diagnostic; do not replay'
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=client.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();stderr=err.read();code=out.channel.recv_exit_status()
 if code!=0:
  diagnostic=(raw+b' '+stderr).decode('utf-8',errors='replace').lower()
  result={'diagnosticFailed':True,'exitCode':code,'businessWrites':False,'fatalIndicators':[word for word in ['parse error','syntax error','fatal error','undefined function','uncaught','throwable','typeerror','mb_strtolower','odbc_connect','preg_match','unexpected','memory','timeout','segmentation fault','standard input code'] if word in diagnostic]}
 else: result=json.loads(raw)
 target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(result))
finally:
 password=None;client.close()
