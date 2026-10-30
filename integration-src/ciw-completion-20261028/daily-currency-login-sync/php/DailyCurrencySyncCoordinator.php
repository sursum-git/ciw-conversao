<?php
namespace App\Ciw;
use App\Runtime\{RuntimeHttpException,RuntimeProgressAuditSchema};
/** Backend-owned ports only. No route, date, quote, actor or callback comes from metadata/browser. */
final class DailyCurrencySyncCoordinator
{
 private readonly \Closure $readStatus;
 private readonly \Closure $apply;
 private readonly ?\Closure $inspectAudit;
 public function __construct(private readonly BancoCentralSgsClient $client,callable $readStatus,callable $apply,?callable $inspectAudit=null){$this->readStatus=\Closure::fromCallable($readStatus);$this->apply=\Closure::fromCallable($apply);$this->inspectAudit=$inspectAudit===null?null:\Closure::fromCallable($inspectAudit);}
 private static function fail(string $code,int $status=422):never{throw new RuntimeHttpException($code,'Sincronização diária não confirmada. Consulte a transação antes de repetir.',$status);}
 private static function number(mixed $value):bool{return (is_int($value)||is_float($value))&&is_finite((float)$value);}
 public function synchronize(array $parameters,string $actor,\DateTimeImmutable $now):array {
  if($parameters!==['serie'=>1]||$actor===''||strlen($actor)>128||trim($actor)!==$actor||preg_match('/[\x00-\x1F\x7F]/',$actor))self::fail('DAILY_CURRENCY_REQUEST_INVALID');
  $now=$now->setTimezone(new \DateTimeZone('America/Sao_Paulo'));$runDate=$now->format('Y-m-d');
  $status=($this->readStatus)($runDate);
  if(!RuntimeProgressAuditSchema::exact($status,['success','completed','run_date','serie','erp_ready','history'])||$status['success']!==true||$status['completed']!==true||$status['run_date']!==$runDate||$status['serie']!==1||!is_bool($status['erp_ready']))self::fail('DAILY_CURRENCY_STATUS_INVALID',502);
  $history=$status['history'];
  if($history!==null&&!self::history($history,$runDate))self::fail('DAILY_CURRENCY_STATUS_INVALID',502);
  if($history!==null&&$history['valor']!==null&&(float)$history['valor']!==0.0)return self::receipt('already-current',$runDate,null,$history['valor'],false,false);
  if((int)$now->format('N')>=6)return self::receipt('not-available',$runDate,null,0,true,false);
  if(!$status['erp_ready'])self::fail('DAILY_CURRENCY_ERP_UNPROVEN',503);
  $quote=$this->client->fetchLatestDollar();
  if(!RuntimeProgressAuditSchema::exact($quote,['serie','data','valor','nome_serie'])||$quote['serie']!==1||!RuntimeProgressAuditSchema::date($quote['data'])||$quote['data']>$runDate||!self::number($quote['valor'])||$quote['valor']<=0||!is_string($quote['nome_serie'])||$quote['nome_serie']==='')self::fail('DAILY_CURRENCY_PROVIDER_INVALID',502);
  // Root decision: daily history/ERP use run_date. BC date is separate evidence;
  // existing force-append import-bc continues to use its observation date.
  $request=['serie'=>1,'run_date'=>$runDate,'observed_date'=>$quote['data'],'valor'=>$quote['valor'],'provider_name'=>$quote['nome_serie'],'expected_history_id'=>$history['hist_cotacao_bc_id']??null,'actor'=>['login'=>$actor]];
  try{$response=($this->apply)($request);}catch(\Throwable){self::fail('DAILY_CURRENCY_COMMIT_UNCONFIRMED',502);}
  if(($response['committed']??null)===true){
   if(($response['success']??null)!==true||!self::confirmation($response['confirmation']??null,$request))self::fail('DAILY_CURRENCY_COMMIT_UNCONFIRMED',502);
   // Audit completeness belongs to the shared participant schemas. Until the
   // EMS schemas/inspector exist, no arrays-only heuristic claims completeness.
   $valid=false;if($this->inspectAudit!==null)try{$valid=($this->inspectAudit)($response['audit']??null,$response['confirmation'])===true;}catch(\Throwable){$valid=false;}
   $result=self::receipt($valid?'synchronized':'synchronized-audit-unavailable',$runDate,$quote['data'],$quote['valor'],true,true);$result['auditAvailable']=$valid;$result['audit']=$valid?$response['audit']:null;return $result;
  }
  if(RuntimeProgressAuditSchema::exact($response,['success','committed','state','run_date','serie','actor','expected_history_id','history'])&&$response['success']===true&&$response['committed']===false&&$response['state']==='already-current'&&$response['run_date']===$runDate&&$response['serie']===1&&$response['actor']===$request['actor']&&$response['expected_history_id']===$request['expected_history_id']&&self::history($response['history'],$runDate)&&$response['history']['valor']!==null&&(float)$response['history']['valor']!==0.0)return self::receipt('already-current',$runDate,$quote['data'],$response['history']['valor'],true,false);
  if(($response['success']??null)===false&&in_array($response['error']['status']??null,[409,422,503],true))self::fail('DAILY_CURRENCY_APPLY_REJECTED',$response['error']['status']);
  self::fail('DAILY_CURRENCY_COMMIT_UNCONFIRMED',502);
 }
 private static function history(mixed $value,string $runDate):bool{return RuntimeProgressAuditSchema::exact($value,['hist_cotacao_bc_id','data','serie','valor','log_ok','log_manual'])&&RuntimeProgressAuditSchema::id($value['hist_cotacao_bc_id'])&&$value['data']===$runDate&&$value['serie']===1&&($value['valor']===null||self::number($value['valor']))&&in_array($value['log_ok'],[null,true,false],true)&&in_array($value['log_manual'],[null,true,false],true)&&($value['log_ok']===true||$value['log_manual']===true);}
 private static function receipt(string $state,string $runDate,?string $observedDate,int|float $value,bool $attempted,bool $committed):array{return ['state'=>$state,'run_date'=>$runDate,'observed_date'=>$observedDate,'valor'=>$value,'attempted'=>$attempted,'committed'=>$committed,'auditAvailable'=>false,'audit'=>null];}
 private static function confirmation(mixed $value,array $request):bool{return RuntimeProgressAuditSchema::exact($value,['version','resource','operation','serie','actor','run_date','observed_date','valor','hist_cotacao_bc_id','expected_history_id'])&&$value['version']===1&&$value['resource']==='daily_currency_sync'&&$value['operation']==='synchronize'&&$value['serie']===1&&RuntimeProgressAuditSchema::exact($value['actor'],['login'])&&$value['actor']===$request['actor']&&$value['run_date']===$request['run_date']&&$value['observed_date']===$request['observed_date']&&self::number($value['valor'])&&(float)$value['valor']===(float)$request['valor']&&RuntimeProgressAuditSchema::id($value['hist_cotacao_bc_id'])&&$value['hist_cotacao_bc_id']!==$request['expected_history_id']&&$value['expected_history_id']===$request['expected_history_id'];}
}
