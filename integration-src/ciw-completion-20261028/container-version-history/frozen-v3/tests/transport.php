<?php
declare(strict_types=1);
// Standalone read-only contract proof. The supplied class file is a staged proposal.
$root='D:/opencode/construtor-pg/backend/src/Runtime/';
require $root.'RuntimeHttpException.php';
require $root.'ApiRequestContext.php';
require $argv[1] ?? $root.'RuntimeCiwErpQuery.php';
use App\Runtime\{RuntimeCiwErpQuery,RuntimeHttpException,ApiRequestContext};
$checks=0;
function check(bool $condition,string $message): void {global $checks;if(!$condition)throw new RuntimeException($message);$checks++;}
function invalid(callable $call): void {try{$call();throw new RuntimeException('Invalid request accepted');}catch(RuntimeHttpException $e){check($e->getStatusCode()===422,'Expected 422');}}
$d=['entityCode'=>'container_versoes_historico_med_progress','primaryKey'=>'record_key','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs'],'fields'=>['container_id'=>['dataType'=>'integer'],'versao_id'=>['dataType'=>'integer'],'item_container_custo_id'=>['dataType'=>'integer'],'it_codigo'=>['dataType'=>'string'],'vl_unit_realiz'=>['dataType'=>'decimal'],'record_key'=>['dataType'=>'string']]];
$e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>'container_versoes_historico_med'],'requestContextFields'=>['container_id','versao_id']];
$context=['container_id'=>123,'versao_id'=>1001];
check(RuntimeCiwErpQuery::supports($d),'Historical entity is registered');
$q=RuntimeCiwErpQuery::prepare($d,$e,['context'=>$context,'skip'=>200,'take'=>200,'sort'=>[['field'=>'item_container_custo_id','dir'=>'desc']],'filter'=>['field'=>'vl_unit_realiz','operator'=>'isNull','value'=>true]]);
check($q===['skip'=>200,'take'=>200,'filter'=>['field'=>'vl_unit_realiz','operator'=>'isnull'],'sort'=>[['field'=>'item_container_custo_id','dir'=>'desc']],'container_id'=>123,'versao_id'=>1001],'Typed page, null filter, sort and both owners forwarded');
ApiRequestContext::assertRows([['container_id'=>123,'versao_id'=>1001]],$context);$checks++;
foreach([[],['context'=>['container_id'=>123]],['context'=>['versao_id'=>1001]],['context'=>$context,'take'=>201],['context'=>$context,'skip'=>-1],['context'=>$context,'operation'=>'update','take'=>0],['context'=>$context+['company_id'=>5]],['context'=>$context,'filter'=>['field'=>'versao_id','operator'=>'eq','value'=>1002]],['context'=>$context,'filter'=>['logic'=>'or','filters'=>[['field'=>'container_id','operator'=>'eq','value'=>123],['field'=>'versao_id','operator'=>'eq','value'=>1001]]]],['context'=>$context,'filter'=>['field'=>'it_codigo','operator'=>'eq','value'=>['sql'=>'select']]],['context'=>$context,'program'=>'arbitrary.p']] as $p)invalid(fn()=>RuntimeCiwErpQuery::prepare($d,$e,$p));
foreach(['source','resource','path','method','operation','context_order']as $variant){$dd=$d;$ee=$e;if($variant==='source')$dd['apiBinding']['sourceCode']='other';if($variant==='resource')$ee['bodyTemplate']['resource']='other';if($variant==='path')$ee['url']='https://other.example/api';if($variant==='method')$ee['method']='GET';if($variant==='operation')$ee['bodyTemplate']['operation']='update';if($variant==='context_order')$ee['requestContextFields']=['versao_id','container_id'];invalid(fn()=>RuntimeCiwErpQuery::prepare($dd,$ee,['context'=>$context]));}
try{ApiRequestContext::assertRows([['container_id'=>123,'versao_id'=>1002]],$context);throw new RuntimeException('Cross-version response accepted');}catch(RuntimeHttpException $x){check($x->getStatusCode()===502,'Response owner checked');}
echo json_encode(['status'=>'PASS','checks'=>$checks],JSON_PRETTY_PRINT).PHP_EOL;
