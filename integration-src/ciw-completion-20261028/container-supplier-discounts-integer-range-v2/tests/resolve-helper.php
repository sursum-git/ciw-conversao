<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
require dirname(__DIR__).'/'.(getenv('RANGE_TREE')?:'candidate').'/backend/src/Runtime/RuntimeImportDiscountRead.php';
$input=json_decode(stream_get_contents(STDIN),true,512,JSON_THROW_ON_ERROR);$action=$input['action'];$payload=$input['payload'];
$d=['entityCode'=>'descontos_importacao_fornecedor_progress','primaryKey'=>'record_key','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs'],'fields'=>['fornecedor_id'=>['dataType'=>'integer']]];$endpoint=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','requestContextFields'=>['fornecedor_id'],'bodyTemplate'=>['operation'=>$action,'resource'=>'import_descontos_fornecedor']];
try{$context=App\Runtime\RuntimeImportDiscountRead::resolveContext($d,$endpoint,$payload);echo json_encode(['accepted'=>true,'context'=>$context],JSON_THROW_ON_ERROR);}catch(App\Runtime\RuntimeHttpException $error){echo json_encode(['accepted'=>false,'status'=>$error->getStatusCode(),'code'=>$error->getErrorCode()],JSON_THROW_ON_ERROR);}
