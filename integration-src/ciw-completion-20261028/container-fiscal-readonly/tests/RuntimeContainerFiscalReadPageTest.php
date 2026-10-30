<?php
declare(strict_types=1);
// Executes the real private readCiwErpPage/requestEndpoint/mapItem path. Only HTTP
// transport and technical log sink are in-memory doubles; no network or database.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
require $argv[1].'/RuntimeCiwErpQuery.php';
require (($argv[2]??'')==='baseline'?'D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php':$argv[1].'/RuntimeApiEntityActionService.php');
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
final class FiscalReadTransport extends RuntimeExternalJsonClient {
 public array $response=[];public array $requests=[];
 public function __construct() {}
 public function request(string $url,string $method,array $headers,mixed $payload,int $timeoutSeconds,array $context=[]): array {
  $this->requests[]=[$url,$method,$headers,$payload,$timeoutSeconds,$context];return ['status'=>200,'body'=>$this->response];
 }
}
final class FiscalReadLogSink extends RuntimeTransactionService {
 public int $logs=0;public function __construct() {}
 public function log(string $eventType,?string $message=null,array $before=[],array $after=[],array $metadata=[]): void {
  if(!str_ends_with($eventType,'.api.read')||$before!==[]||$after!==[])throw new RuntimeException('Not a technical read log');++$this->logs;
 }
}
$checks=0;
function verify(bool $condition,string $message): void {global $checks;++$checks;if(!$condition)throw new RuntimeException($message);}
$reflection=new ReflectionClass(RuntimeApiEntityActionService::class);
$client=new FiscalReadTransport();$logs=new FiscalReadLogSink();$service=$reflection->newInstanceWithoutConstructor();
$reflection->getProperty('externalJsonClient')->setValue($service,$client);$reflection->getProperty('transactions')->setValue($service,$logs);
$read=$reflection->getMethod('readCiwErpPage');
foreach(['op1033','op1034']as$program){
 $m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$program.'-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);
 $entity=$m['entityDraft']['code'];$pk=$m['entityDraft']['fields'][0]['code'];$resource=substr($entity,0,-9);$fields=[];
 foreach($m['entityDraft']['fields']as$f)$fields[$f['code']]=$f+['jsonPath'=>$f['code'],'collection'=>false];
 $endpoint=['url'=>'https://192.168.0.111:9911/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>$resource],'requestContextFields'=>['container_id',$pk]];
 $d=['entityCode'=>$entity,'primaryKey'=>$pk,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','listEndpoint'=>$endpoint,'authHeaders'=>[]],'fields'=>$fields];
 $payload=['context'=>['container_id'=>100,$pk=>11]];
 // A convincing record_key must not bypass ownership checks in the real ERP path.
 foreach(['container','selected','missing-owner','missing-selected','typed-selected','typed-owner']as$kind){
  $row=['container_id'=>100,$pk=>11,'record_key'=>'looks-valid'];
  switch($kind){case'container':$row['container_id']=200;break;case'selected':$row[$pk]=12;break;case'missing-owner':unset($row['container_id']);break;case'missing-selected':unset($row[$pk]);break;case'typed-selected':$row[$pk]='11';break;case'typed-owner':$row['container_id']='100';}
  $client->response=['success'=>true,'data'=>[$row],'total'=>1];$prior=$logs->logs;
  try{$read->invoke($service,$d,$payload);throw new RuntimeException('Accepted crossed/malformed response '.$kind);}catch(RuntimeHttpException $e){verify($e->getStatusCode()===502,'cross/malformed response rejected: '.$kind);}
  verify($logs->logs===$prior,'invalid response never reaches success log');
 }
 // Physical readonly projection intentionally has no record_key.
 $row=['container_id'=>100,$pk=>11,'memoria_calculo'=>null];$client->response=['success'=>true,'data'=>[$row],'total'=>1];
 $prior=$logs->logs;$result=$read->invoke($service,$d,$payload);
 verify($result['total']===1&&$result['data'][0]['container_id']===100&&$result['data'][0][$pk]===11,'valid physical projection maps without fictitious record_key');
 verify($result['data'][0]['memoria_calculo']===null&&$logs->logs===$prior+1,'NULL preserved and technical log only');
 $request=$client->requests[array_key_last($client->requests)][3];
 verify($request['container_id']===100&&$request[$pk]===11&&$request['resource']===$resource&&$request['operation']==='read','real transport receives fixed selected context');
 $client->response=['success'=>true,'data'=>[],'total'=>0];$result=$read->invoke($service,$d,$payload);verify($result===['data'=>[],'total'=>0],'empty response accepted without widening context');
}
// Existing ERP fallback still requires its composite record_key.
$field=['code'=>'record_key','dataType'=>'string','jsonPath'=>'record_key','collection'=>false];
$d=['entityCode'=>'notas_fiscais_med_progress','primaryKey'=>'record_key','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>['url'=>'https://192.168.0.111:9911/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>'notas_fiscais_med']]],'fields'=>['record_key'=>$field]];
$client->response=['success'=>true,'data'=>[['record_key'=>'{"nota":"1"}']],'total'=>1];$prior=$logs->logs;$result=$read->invoke($service,$d,[]);
verify($result['data'][0]['record_key']==='{"nota":"1"}','existing composite projection preserved');verify($logs->logs===$prior+1,'existing technical read log preserved');
$client->response=['success'=>true,'data'=>[['container_id'=>100,'calc_imp_container_id'=>11]],'total'=>1];$prior=$logs->logs;
try{$read->invoke($service,$d,[]);throw new RuntimeException('Fiscal shape improperly enabled for existing entity');}catch(RuntimeHttpException $e){verify($e->getStatusCode()===502,'physical projection bypass limited to fixed fiscal entities');}
verify($logs->logs===$prior,'existing invalid row not logged as success');
echo 'PASS real ERP read path checks='.$checks.PHP_EOL;
