<?php
namespace DailyCurrencyCandidate;
use App\Ciw\{BancoCentralSgsClient,DailyCurrencySyncCoordinator};
use App\Runtime\RuntimeHttpException;
use PHPUnit\Framework\TestCase;
final class DailyCurrencySyncCoordinatorTest extends TestCase
{
 private function statusBody(?float $value=null,bool $row=false,bool $erp=true):array{return ['success'=>true,'completed'=>true,'run_date'=>'2026-10-28','serie'=>1,'erp_ready'=>$erp,'history'=>$row?['hist_cotacao_bc_id'=>11,'data'=>'2026-10-28','serie'=>1,'valor'=>$value,'log_ok'=>false,'log_manual'=>true]:null];}
 private function setupCoordinator(array $status,?array $response=null,bool $bcFails=false,bool $applyFails=false):array {
  $trace=(object)['events'=>[],'request'=>null];
  $client=new class($trace,$bcFails) extends BancoCentralSgsClient {public function __construct(private object $trace,private bool $fails){}public function fetchLatestDollar():array{$this->trace->events[]='bc';if($this->fails)throw new RuntimeHttpException('BCB_UNAVAILABLE','BC unavailable',502);return ['serie'=>1,'data'=>'2026-10-27','valor'=>5.12345,'nome_serie'=>'Dólar americano (venda) - diário'];}};
  $read=static function(string $date)use($trace,$status):array{$trace->events[]='status';return $status;};
  $apply=static function(array $request)use($trace,$response,$applyFails):array{$trace->events[]='apply';$trace->request=$request;if($applyFails)throw new \RuntimeException('transport interrupted');return $response??['success'=>true,'committed'=>true,'confirmation'=>self::confirmation($request['expected_history_id']),'audit'=>['version'=>1,'source'=>'progress-transaction','resource'=>'daily_currency_sync','operation'=>'synchronize','actor'=>['login'=>'test-user'],'run_date'=>'2026-10-28','observed_date'=>'2026-10-27','before'=>[],'after'=>[],'changes'=>[['resource'=>'hist_cotacoes_bc','operation'=>'create','recordId'=>12,'before'=>[],'after'=>['data'=>'2026-10-28','valor'=>5.12345]]]]];};
  return [new DailyCurrencySyncCoordinator($client,$read,$apply),$trace];
 }
 private function now():\DateTimeImmutable{return new \DateTimeImmutable('2026-10-28T12:00:00-03:00');}
 private static function confirmation(?int $expectedId=null):array{return ['version'=>1,'resource'=>'daily_currency_sync','operation'=>'synchronize','serie'=>1,'actor'=>['login'=>'test-user'],'run_date'=>'2026-10-28','observed_date'=>'2026-10-27','valor'=>5.12345,'hist_cotacao_bc_id'=>12,'expected_history_id'=>$expectedId];}
 private function rejected(callable $call,string $code):void{try{$call();self::fail('Expected rejection');}catch(RuntimeHttpException $error){self::assertSame($code,$error->getErrorCode());}}
 public function testManualTodaySkipsProviderAndApply():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(5.5,true));$result=$c->synchronize(['serie'=>1],'test-user',$this->now());self::assertSame(['status'],$trace->events);self::assertSame('already-current',$result['state']);self::assertFalse($result['attempted']);self::assertFalse($result['committed']);self::assertSame(5.5,$result['valor']);}
 public function testRunDateIsTodayAndObservedDateStaysSeparate():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(0.0,true));$result=$c->synchronize(['serie'=>1],'test-user',$this->now());self::assertSame(['status','bc','apply'],$trace->events);self::assertSame('2026-10-28',$trace->request['run_date']);self::assertSame('2026-10-27',$trace->request['observed_date']);self::assertSame(['login'=>'test-user'],$trace->request['actor']);self::assertSame(11,$trace->request['expected_history_id']);self::assertTrue($result['committed']);self::assertFalse($result['auditAvailable'],'Physical participant schemas are not yet proven; arrays do not prove audit completeness');}
 public function testNullApprovedTodayStillTriggersSingleAttempt():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(null,true));$c->synchronize(['serie'=>1],'test-user',$this->now());self::assertSame(['status','bc','apply'],$trace->events);}
 public function testForgedParametersAndActorFailBeforeStatus():void{foreach([['serie'=>'1'],['serie'=>2],['serie'=>1,'valor'=>5],['serie'=>1,'run_date'=>'2026-10-28'],[]]as$params){[$c,$trace]=$this->setupCoordinator($this->statusBody());$this->rejected(fn()=>$c->synchronize($params,'test-user',$this->now()),'DAILY_CURRENCY_REQUEST_INVALID');self::assertSame([],$trace->events);}[$c,$trace]=$this->setupCoordinator($this->statusBody());$this->rejected(fn()=>$c->synchronize(['serie'=>1],"bad\nactor",$this->now()),'DAILY_CURRENCY_REQUEST_INVALID');self::assertSame([],$trace->events);}
 public function testProviderFailureHasNoApplyOrHistoryWrite():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(),null,true);$this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'BCB_UNAVAILABLE');self::assertSame(['status','bc'],$trace->events);self::assertNull($trace->request);}
 public function testErpGateStopsBeforeProviderAndMutation():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(null,false,false));$this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_ERP_UNPROVEN');self::assertSame(['status'],$trace->events);}
 public function testAmbiguousTransportNeverRetriesProviderOrApply():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(),null,false,true);$this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_COMMIT_UNCONFIRMED');self::assertSame(['status','bc','apply'],$trace->events);}
 public function testConfirmedCommitWithBadAuditNeverBecomesRetryable():void{[$c,$trace]=$this->setupCoordinator($this->statusBody(),['success'=>true,'committed'=>true,'confirmation'=>self::confirmation()]);$result=$c->synchronize(['serie'=>1],'test-user',$this->now());self::assertTrue($result['committed']);self::assertFalse($result['auditAvailable']);self::assertSame('synchronized-audit-unavailable',$result['state']);self::assertSame(['status','bc','apply'],$trace->events);}
 public function testBareCommitAndCrossRequestConfirmationAreUnconfirmedWithoutRetry():void{
  $base=self::confirmation();$bad=[['success'=>true,'committed'=>true],['success'=>false,'committed'=>true,'confirmation'=>$base]];
  foreach(['run_date'=>'2026-10-27','observed_date'=>'2026-10-26','serie'=>2,'valor'=>7.0,'hist_cotacao_bc_id'=>'12','expected_history_id'=>99,'actor'=>['login'=>'other']]as$key=>$value)$bad[]=['success'=>true,'committed'=>true,'confirmation'=>array_replace($base,[$key=>$value])];
  $bad[]=['success'=>true,'committed'=>true,'confirmation'=>$base+['unexpected'=>1]];
  foreach($bad as$response){[$c,$trace]=$this->setupCoordinator($this->statusBody(),$response);$this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_COMMIT_UNCONFIRMED');self::assertSame(['status','bc','apply'],$trace->events);}
 }
 public function testRaceReplyMustProveCurrentHistoryAndRequestOwnership():void{
  $weak=['success'=>true,'committed'=>false,'state'=>'already-current','run_date'=>'2026-10-28','valor'=>8.0];
  [$c,$trace]=$this->setupCoordinator($this->statusBody(),$weak);
  $this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_COMMIT_UNCONFIRMED');
  self::assertSame(['status','bc','apply'],$trace->events);
  $valid=['success'=>true,'committed'=>false,'state'=>'already-current','run_date'=>'2026-10-28','serie'=>1,'actor'=>['login'=>'test-user'],'expected_history_id'=>null,'history'=>['hist_cotacao_bc_id'=>15,'data'=>'2026-10-28','serie'=>1,'valor'=>8.0,'log_ok'=>false,'log_manual'=>true]];
  [$c,$trace]=$this->setupCoordinator($this->statusBody(),$valid);$result=$c->synchronize(['serie'=>1],'test-user',$this->now());
  self::assertSame('already-current',$result['state']);self::assertSame(8.0,$result['valor']);self::assertFalse($result['committed']);self::assertTrue($result['attempted']);
  foreach(['actor'=>['login'=>'other'],'expected_history_id'=>99,'serie'=>2,'run_date'=>'2026-10-27','history'=>array_replace($valid['history'],['data'=>'2026-10-27']),'extra'=>true]as$key=>$value){
   [$c,$trace]=$this->setupCoordinator($this->statusBody(),array_replace($valid,[$key=>$value]));
   $this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_COMMIT_UNCONFIRMED');self::assertSame(['status','bc','apply'],$trace->events);
  }
 }
 public function testWeekendAndLocalCalendarSkipBcEvenWhenAttempted():void{
  $status=$this->statusBody();$status['run_date']='2026-10-31';[$c,$trace]=$this->setupCoordinator($status);
  $result=$c->synchronize(['serie'=>1],'test-user',new \DateTimeImmutable('2026-11-01T01:00:00Z'));
  self::assertSame(['status'],$trace->events);self::assertSame('2026-10-31',$result['run_date']);self::assertTrue($result['attempted']);self::assertFalse($result['committed']);self::assertSame('not-available',$result['state']);
 }
 public function testMalformedStatusStopsBeforeBcAndApply():void{
  $base=$this->statusBody(0.0,true);foreach(['serie'=>'1','completed'=>false,'run_date'=>'2026-10-27','erp_ready'=>1,'history'=>array_replace($base['history'],['hist_cotacao_bc_id'=>'11']),'extra'=>true]as$key=>$value){
   [$c,$trace]=$this->setupCoordinator(array_replace($base,[$key=>$value]));$this->rejected(fn()=>$c->synchronize(['serie'=>1],'test-user',$this->now()),'DAILY_CURRENCY_STATUS_INVALID');self::assertSame(['status'],$trace->events);
  }
 }

}
