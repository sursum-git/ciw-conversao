<?php
declare(strict_types=1);
// Standalone test against the patched staged production class, no mock transport.
require 'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeHttpException.php';
require 'D:/opencode/construtor-pg/backend/src/Runtime/ApiRequestContext.php';
require $argv[1].'/RuntimeCiwErpQuery.php';
use App\Runtime\{RuntimeCiwErpQuery,RuntimeHttpException,ApiRequestContext};
$checks=0;
function check(bool $condition,string $message): void { global $checks;++$checks;if(!$condition)throw new RuntimeException($message); }
function reject(callable $action,string $message,int $status=422): void {try{$action();}catch(RuntimeHttpException $e){check($e->getStatusCode()===$status,$message);return;}throw new RuntimeException('Accepted '.$message);}
foreach(['op1033','op1034'] as $program){
 $m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$program.'-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);
 $fields=[];foreach($m['entityDraft']['fields']as $field)$fields[$field['code']]=$field;
 $entity=$m['entityDraft']['code'];$resource=substr($entity,0,-9);$pk=$m['entityDraft']['fields'][0]['code'];
 $d=['entityCode'=>$entity,'primaryKey'=>$pk,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs'],'fields'=>$fields];
 $e=['url'=>'https://192.168.0.111:9911/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>$resource],'requestContextFields'=>['container_id',$pk]];
 check(RuntimeCiwErpQuery::supports($d),'new entity registered');
 $q=RuntimeCiwErpQuery::prepare($d,$e,['context'=>['container_id'=>'100',$pk=>'11'],'skip'=>200,'take'=>200,'sort'=>[['field'=>$pk,'dir'=>'desc']],'filter'=>['field'=>$pk,'operator'=>'eq','value'=>11]]);
 check($q['container_id']===100 && $q[$pk]===11 && $q['skip']===200 && $q['take']===200 && $q['filter']['value']===11,'context and server page forwarded');
 check(!isset($q['context'])&&$q['sort'][0]['field']===$pk,'nested context consumed');
 $detail=$e;$detail['bodyTemplate']['operation']='get';
 check(ApiRequestContext::resolve($d,$detail,['context'=>['container_id'=>100,$pk=>11]])===['container_id'=>100,$pk=>11],'native get retains mandatory contexts');
 reject(fn()=>RuntimeCiwErpQuery::prepare($d,$e,['context'=>['container_id'=>100]]),'selected identity required');
 ApiRequestContext::assertRows([[$pk=>11,'container_id'=>100]],['container_id'=>100]);check(true,'native response owner accepted');
 reject(fn()=>ApiRequestContext::assertRows([[$pk=>11,'container_id'=>200]],['container_id'=>100]),'response owner mismatch',502);
 foreach(['missing','fraction','exponent','leading-zero','too-large','company','sql','operation','take','conflict','context-or'] as $kind){
  $p=['context'=>['container_id'=>100,$pk=>11]];
  switch($kind){case'missing':$p=[];break;case'fraction':$p['context']['container_id']=1.5;break;case'exponent':$p['context']['container_id']='1e2';break;case'leading-zero':$p['context']['container_id']='0100';break;case'too-large':$p['context']['container_id']='2147483648';break;case'company':$p['context']['empresa_id']=2;break;case'sql':$p['sql']='SELECT other';break;case'operation':$p['writer']='delete';break;case'take':$p['take']=201;break;case'conflict':$p['filter']=['field'=>'container_id','operator'=>'eq','value'=>200];break;case'context-or':$p['filter']=['logic'=>'or','filters'=>[['field'=>'container_id','operator'=>'eq','value'=>100]]];}
  reject(fn()=>RuntimeCiwErpQuery::prepare($d,$e,$p),$entity.' '.$kind);
 }
 foreach(['resource','method','write','route','source','primaryKey','contextFields']as$kind){$badD=$d;$badE=$e;switch($kind){case'resource':$badE['bodyTemplate']['resource']='other';break;case'method':$badE['method']='GET';break;case'write':$badE['bodyTemplate']['operation']='update';break;case'route':$badE['url']='https://example.com/api';break;case'source':$badD['apiBinding']['sourceCode']='other';break;case'primaryKey':$badD['primaryKey']='other';break;case'contextFields':$badE['requestContextFields']=[];}
  reject(fn()=>RuntimeCiwErpQuery::prepare($badD,$badE,['context'=>['container_id'=>100,$pk=>11]]),$entity.' binding '.$kind);
 }
 check(!$m['programDraft']['allowCreate']&&!$m['programDraft']['allowUpdate']&&!$m['programDraft']['allowDelete'],'native screen readonly');
 check(count(array_filter($m['entityDraft']['fields'],fn($f)=>!$f['readonlyField']))===0,'all fields readonly');
 if($program==='op1033'){
  $q=RuntimeCiwErpQuery::prepare($d,$e,['context'=>['container_id'=>100,$pk=>11],'filter'=>['field'=>'data_calculo','operator'=>'between','value'=>['start'=>'2026-10-01','end'=>'2026-10-28']]]);
  check($q['filter']['filters'][0]['value']==='2026-10-01'&&$q['filter']['filters'][1]['value']==='2026-10-28','native period filter');
 }else{check($m['programDraft']['rowLinks'][0]['parameters'][1]['sourceField']==='link_calculo_id','fiscal priority uses nullable navigation field');}
}
echo 'PASS PHP fiscal routing checks='.$checks.PHP_EOL;
