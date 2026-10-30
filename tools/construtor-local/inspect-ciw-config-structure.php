<?php
// Somente parsing de dados; nao inclui/executa a configuracao Scriptcase.
$raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
$result=['phpVersion'=>PHP_VERSION,'pdoDrivers'=>PDO::getAvailableDrivers(),'serializedMarkers'=>preg_match_all('/a:\d+:\{/',$raw),'jsonMarkers'=>substr_count($raw,'{"')];
$data=null;
if(preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE)){
 $data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
 if(!is_array($data))$data=null;
}
if($data===null){
 $clean=preg_replace('/^\s*<\?php\s*\/\*/','',$raw);
 $clean=preg_replace('/\*\/\s*(?:\?>)?\s*$/','',$clean);
 $candidate=json_decode(trim($clean),true);if(is_array($candidate))$data=$candidate;
}
$result['parsed']=is_array($data);$result['rootKeys']=is_array($data)?array_slice(array_keys($data),0,30):[];
$found=[];
$walk=function($node,$path=[], $depth=0)use(&$walk,&$found){
 if(!is_array($node)||$depth>7)return;
 foreach($node as $k=>$v){
  $next=array_merge($path,[(string)$k]);
  if(is_array($v)&&in_array(strtolower((string)$k),['ticontrole','ticontrole2','espec','especw'],true)){
   $safe=['path'=>$next,'keys'=>array_keys($v)];
   foreach($v as $field=>$value){
    if(preg_match('/^(VAL_HOST|VAL_BASE|VAL_TYPE|dbms|sgbd|type|server|host|database|database_name|db|port|dsn|nm_tipo|nm_servidor|nm_banco)$/i',(string)$field)&&is_string($value)&&strlen($value)<120&&!preg_match('/[;=\r\n]|password|pwd|secret/i',$value))$safe[$field]=$value;
   }
   $found[]=$safe;
  }
  if(is_array($v))$walk($v,$next,$depth+1);
 }
};
if(is_array($data))$walk($data);
$result['selectedConnections']=$found;
echo json_encode($result);
