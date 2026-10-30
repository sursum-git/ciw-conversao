<?php
namespace DailyCurrencyCandidate;
use App\Ciw\DailyCurrencySyncAudit;
use App\Runtime\RuntimeCiwCotacaoAudit;
use PHPUnit\Framework\TestCase;
final class DailyCurrencySyncAuditTest extends TestCase {
 private static function pair(bool $update=false):array {
  $local=rtrim(getenv('DAILY_CURRENCY_TEST_FIXTURES')?:__DIR__.'/fixtures','/\\').'/';
  $erp=json_decode(file_get_contents($local.'erp-'.($update?'update':'insert').'-actual.json'),true,512,JSON_THROW_ON_ERROR);
  $history=json_decode(file_get_contents($local.'history-actual.json'),true,512,JSON_THROW_ON_ERROR);
  $date=$history['after']['data'];$actor=['login'=>str_repeat('authenticated-user-',3).'ç'];
  $confirmation=['version'=>1,'resource'=>'daily_currency_sync','operation'=>'synchronize','serie'=>1,'actor'=>$actor,'run_date'=>$date,'observed_date'=>(new \DateTimeImmutable($date))->modify('-1 day')->format('Y-m-d'),'valor'=>5.12345,'hist_cotacao_bc_id'=>$history['recordId'],'expected_history_id'=>null];
  return [['version'=>1,'source'=>'progress-transaction','resource'=>'daily_currency_sync','operation'=>'synchronize','actor'=>$actor,'run_date'=>$confirmation['run_date'],'observed_date'=>$confirmation['observed_date'],'history'=>$history,'changes'=>$erp['changes']],$confirmation];
 }
 public function testActualTtImagesRoundTripAndAuthenticatedActorAreComplete():void {foreach([false,true]as$update){[$audit,$c]=self::pair($update);self::assertTrue(DailyCurrencySyncAudit::inspect($audit,$c));self::assertGreaterThan(12,strlen($audit['actor']['login']));}}
 public function testHistoryUsesTheExistingStrictSchema():void {[$audit,$c]=self::pair();$result=RuntimeCiwCotacaoAudit::inspectTransaction(['audit'=>$audit['history']],'import-bc',$c['hist_cotacao_bc_id']);self::assertTrue($result['metadata']['available']);$audit['history']['after']['row_stamp']='bad';self::assertFalse(DailyCurrencySyncAudit::inspect($audit,$c));}
 public function testMissingExtraOrCrossRequestImagesAreRejected():void {[$base,$c]=self::pair();$bad=[];
  $v=$base;unset($v['changes'][0]['after']['usuario']);$bad[]=$v;
  $v=$base;$v['changes'][0]['after']['unknown']=1;$bad[]=$v;
  $v=$base;array_pop($v['changes'][0]['after']['cotacao']);$bad[]=$v;
  $v=$base;$v['changes'][0]['after']['char-1']='changed';$bad[]=$v;
  $v=$base;$v['changes'][0]['after']['cotacao'][30]=7;$bad[]=$v;
  $v=$base;$v['changes'][1]['after']['cod_usuar_ult_atualiz']='request-user';$bad[]=$v;
  $v=$base;$v['changes'][1]['key']['dat_cotac_indic_econ']='2026-01-01';$bad[]=$v;
  $v=$base;$v['actor']=['login'=>'other'];$bad[]=$v;
  $v=$base;$v['history']['after']['data']=$c['observed_date'];$bad[]=$v;
  $v=$base;$v['changes']=[];$bad[]=$v;
  $v=$base;$v['source']='mock';$bad[]=$v;
  foreach($bad as$v)self::assertFalse(DailyCurrencySyncAudit::inspect($v,$c));
 }
 public function testUpdateRejectsDuplicateKeysAndUnrelatedFieldChanges():void {[$audit,$c]=self::pair(true);$audit['changes'][]=$audit['changes'][1];self::assertFalse(DailyCurrencySyncAudit::inspect($audit,$c));[$audit,$c]=self::pair(true);$audit['changes'][1]['after']['cod_usuar_ult_atualiz']='changed';self::assertFalse(DailyCurrencySyncAudit::inspect($audit,$c));}
 public function testOpaqueObjectKeyOrderCannotHideDuplicateIdentity():void {[$audit,$c]=self::pair(true);$duplicate=$audit['changes'][1];$duplicate['key']=array_reverse($duplicate['key'],true);$audit['changes'][]=$duplicate;self::assertFalse(DailyCurrencySyncAudit::inspect($audit,$c));}

 public function testCoordinatorSeparatesCompleteAuditFromConfirmedCommitWithBadAudit():void {
  [$audit,$c]=self::pair();
  foreach([false,true]as$badAudit){
   $calls=(object)['apply'=>0,'bc'=>0];
   $client=new class($c,$calls) extends \App\Ciw\BancoCentralSgsClient {public function __construct(private array $c,private object $calls){}public function fetchLatestDollar():array{$this->calls->bc++;return ['serie'=>1,'data'=>$this->c['observed_date'],'valor'=>$this->c['valor'],'nome_serie'=>'Existing BC client contract'];}};
   $status=['success'=>true,'completed'=>true,'run_date'=>$c['run_date'],'serie'=>1,'erp_ready'=>true,'history'=>null];
   $apply=static function(array $request)use($c,$audit,$badAudit,$calls):array{$calls->apply++;return ['success'=>true,'committed'=>true,'confirmation'=>$c,'audit'=>$badAudit?['version'=>1]:$audit];};
   $coordinator=new \App\Ciw\DailyCurrencySyncCoordinator($client,static fn()=>$status,$apply,[DailyCurrencySyncAudit::class,'inspect']);
   $result=$coordinator->synchronize(['serie'=>1],$c['actor']['login'],new \DateTimeImmutable($c['run_date'].'T12:00:00-03:00'));
   self::assertTrue($result['committed']);self::assertSame(!$badAudit,$result['auditAvailable']);self::assertSame($badAudit?'synchronized-audit-unavailable':'synchronized',$result['state']);self::assertSame(1,$calls->apply);self::assertSame(1,$calls->bc);
  }
 }

}
