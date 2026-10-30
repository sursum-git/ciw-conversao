<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$payload=json_decode(stream_get_contents(STDIN),true,512,JSON_THROW_ON_ERROR);
try{$resolved=App\Runtime\ApiRequestContext::resolve(['fields'=>['proc_compra_id'=>['dataType'=>'integer'],'item_proc_compra_id'=>['dataType'=>'integer']]],['method'=>'POST','requestContextFields'=>['proc_compra_id']],$payload);echo json_encode(['success'=>true,'context'=>$resolved],JSON_THROW_ON_ERROR);}
catch(App\Runtime\RuntimeHttpException $error){echo json_encode(['success'=>false,'code'=>$error->getErrorCode(),'status'=>$error->getStatusCode()],JSON_THROW_ON_ERROR);}
