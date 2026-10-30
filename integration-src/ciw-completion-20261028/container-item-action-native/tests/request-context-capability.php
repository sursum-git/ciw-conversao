<?php
declare(strict_types=1);
require 'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeHttpException.php';
require 'D:/opencode/construtor-pg/backend/src/Runtime/ApiRequestContext.php';
use App\Runtime\ApiRequestContext;
use App\Runtime\RuntimeHttpException;
$checks=0;
$definition=['fields'=>['container_id'=>['dataType'=>'integer'],'moeda'=>['dataType'=>'string']]];
$endpoint=['method'=>'POST','requestContextFields'=>['container_id'],'bodyTemplate'=>['moeda'=>'real']];
if(ApiRequestContext::resolve($definition,$endpoint,['context'=>['container_id'=>12]])!==['container_id'=>12])throw new RuntimeException('Integer parent context failed');$checks++;
foreach([
 [$endpoint,['context'=>['container_id'=>12,'moeda'=>'dolar']]],
 [array_replace($endpoint,['requestContextFields'=>['container_id','moeda']]),['context'=>['container_id'=>12,'moeda'=>'dolar']]]
]as[$operation,$payload]){
 try{ApiRequestContext::resolve($definition,$operation,$payload);throw new RuntimeException('String query choice unexpectedly accepted');}
 catch(RuntimeHttpException $error){if($error->getStatusCode()!==422||$error->getErrorCode()!=='ENTITY_API_CONTEXT_INVALID')throw $error;$checks++;}
}
echo json_encode(['success'=>true,'checks'=>$checks,'realCanonicalHelper'=>true,'networkExecuted'=>false,'businessWrites'=>false],JSON_THROW_ON_ERROR),PHP_EOL;
