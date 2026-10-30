<?php
// Analise estatica: todos os literais e comentarios sao removidos.
$result=[];
foreach(['nm_serialize.php','nm_ini_lib.php'] as $name){
 $text=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/'.$name);
 $safe='';
 foreach(token_get_all($text) as $token){
  if(!is_array($token)){$safe.=$token;continue;}
  if(in_array($token[0],[T_CONSTANT_ENCAPSED_STRING,T_ENCAPSED_AND_WHITESPACE,T_INLINE_HTML],true)){$safe.="'__LITERAL_REMOVIDO__'";continue;}
  if(in_array($token[0],[T_COMMENT,T_DOC_COMMENT],true))continue;
  $safe.=$token[1];
 }
 $result[$name]=$safe;
}
echo json_encode($result);
