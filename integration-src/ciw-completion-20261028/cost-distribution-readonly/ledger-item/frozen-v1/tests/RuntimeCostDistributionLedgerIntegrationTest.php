<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeCostDistributionLedgerIntegrationTest extends TestCase
{
 private static function definition():array {
  $m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/custo_distribuicao_lancamentos_item-builder-draft.json'),true);$fields=[];foreach($m['entityDraft']['fields'] as $f)$fields[$f['code']]=['code'=>$f['code'],'dataType'=>$f['dataType'],'jsonPath'=>$f['code'],'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'custo_distribuicao_lancamentos_item'],'requestContextFields'=>['item_container_id']];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>$m['entityDraft']['code'],'primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private static function row():array {return ['record_key'=>'{"item_container_id":1,"cta_corren_custo_distr_id":7}','cta_corren_custo_distr_id'=>7,'data'=>null,'historico'=>' RAW ','vl_lancto'=>null,'login'=>null,'item_container_custo_id'=>77,'item_container_id'=>1,'cod_tipo_movto'=>null];}
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>1]];});$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 public function testActualReadGetMapOwnerDateNullsAndSignedAmounts():void {
  $r=self::row();$c=['item_container_id'=>1];$inspect=static function($sent){self::assertSame(1,$sent['item_container_id']);self::assertArrayNotHasKey('empresa_id',$sent);};$read=$this->invoke('readCiwErpPage',$r,['take'=>1,'context'=>$c],$inspect);self::assertSame($r,$read['data'][0]);$get=$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>$c],$inspect);self::assertSame($r,$get);self::assertNull($get['vl_lancto']);$r['vl_lancto']=-10;$r['data']='2026-10-28';$get=$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>$c]);self::assertSame(-10,$get['vl_lancto']);self::assertSame('2026-10-28',$get['data']);
 }
 public function testActualQueryForwardsNativeFilterSortAndOwner():void {$r=self::row();$f=['field'=>'vl_lancto','operator'=>'lt','value'=>0];$s=[['field'=>'data','dir'=>'desc']];$read=$this->invoke('readCiwErpPage',$r,['take'=>1,'context'=>['item_container_id'=>1],'filter'=>$f,'sort'=>$s],function($sent)use($f,$s){self::assertSame($f,$sent['filter']);self::assertSame($s,$sent['sort']);self::assertSame(1,$sent['item_container_id']);});self::assertSame($r,$read['data'][0]);}
 public function testReadGetRejectDifferentOwnerEvenIfPhysicalKeyValid():void {foreach(['readCiwErpPage','get'] as $method){$r=self::row();$r['item_container_id']=2;$r['record_key']='{"item_container_id":2,"cta_corren_custo_distr_id":7}';$p=['context'=>['item_container_id'=>1]];if($method==='get')$p['id']=$r['record_key'];$this->closed(502,fn()=>$this->invoke($method,$r,$p));}}
 public function testGetRejectsStringIdAndMalformedFullKey():void {$r=self::row();$r['cta_corren_custo_distr_id']='7';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]]));$r=self::row();$r['record_key']='{"cta_corren_custo_distr_id":7}';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]]));}
 public function testGetNeedsSuccessfulResponseAndExactRequestedKey():void {$r=self::row();$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]],success:false));$r['cta_corren_custo_distr_id']=8;$r['record_key']='{"item_container_id":1,"cta_corren_custo_distr_id":8}';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>'{"item_container_id":1,"cta_corren_custo_distr_id":7}','context'=>['item_container_id'=>1]]));}
 public function testRequiredContextAndConflictingAliasesFailBeforeNetwork():void {
  foreach([['take'=>1],['take'=>1,'context'=>['item_container_id'=>0]],['id'=>self::row()['record_key'],'record_key'=>self::row()['record_key'].' ','context'=>['item_container_id'=>1]]] as $p){$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);$method=isset($p['id'])?'get':'readCiwErpPage';$this->closed(422,fn()=>(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$p));}
 }
}
