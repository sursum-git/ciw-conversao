<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeCostDistributionLedgerKeyOrderIntegrationTest extends TestCase
{
 private static function row():array {return json_decode(file_get_contents(__DIR__.'/reader-row.json'),true,512,JSON_THROW_ON_ERROR);}
 private static function definition():array {
  $fields=[];foreach(self::row() as $code=>$value)$fields[$code]=['code'=>$code,'dataType'=>in_array($code,['cta_corren_custo_distr_id','item_container_id','item_container_custo_id','cod_tipo_movto'],true)?'integer':($code==='vl_lancto'?'decimal':($code==='data'?'date':'string')),'jsonPath'=>$code,'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'custo_distribuicao_lancamentos_item'],'requestContextFields'=>['item_container_id']];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>'custo_distribuicao_lancamentos_item_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>1]];});$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 public function testActualReaderProducedKeyPassesRealRuntimeReadAndGetUnchanged():void {
  $r=self::row();self::assertSame(['cta_corren_custo_distr_id','item_container_id'],array_keys(json_decode($r['record_key'],true)));self::assertNull($r['vl_lancto']);$ctx=['item_container_id'=>$r['item_container_id']];
  foreach(['readCiwErpPage','get'] as $method){$payload=['context'=>$ctx,'take'=>1];if($method==='get'){$payload=['context'=>$ctx,'id'=>$r['record_key'],'record_key'=>$r['record_key']];}
   try{$result=$this->invoke($method,$r,$payload,function($sent)use($r,$method){self::assertSame($r['item_container_id'],$sent['item_container_id']);if($method==='get'){self::assertSame($r['record_key'],$sent['id']);self::assertSame($r['record_key'],$sent['record_key']);}});}catch(RuntimeHttpException $error){self::fail('Actual reader-produced row rejected by runtime HTTP'.$error->getStatusCode());}self::assertSame($r,$method==='get'?$result:$result['data'][0]);}
 }
 public function testOwnerFirstKeyStillPassesWithoutReserializingOpaqueValue():void {
  $r=self::row();$r['record_key']=json_encode(['item_container_id'=>$r['item_container_id'],'cta_corren_custo_distr_id'=>$r['cta_corren_custo_distr_id']]);$get=$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>$r['item_container_id']]],fn($sent)=>self::assertSame($r['record_key'],$sent['id']));self::assertSame($r,$get);
 }
 public function testExtraAndMissingKeyFieldsRejectedByRealReadAndGet():void {
  foreach(['readCiwErpPage','get'] as $method)foreach(['extra','missing'] as $variant){$r=self::row();$key=json_decode($r['record_key'],true);if($variant==='extra')$key['unexpected']=0;else unset($key['item_container_id']);$r['record_key']=json_encode($key);$payload=['context'=>['item_container_id'=>1]];if($method==='get')$payload['id']=$r['record_key'];$this->closed(502,fn()=>$this->invoke($method,$r,$payload));}
 }
 public function testWrongOwnerRejectedEvenWithMatchingCompletePhysicalKey():void {
  foreach(['readCiwErpPage','get'] as $method){$r=self::row();$key=json_decode($r['record_key'],true);$key['item_container_id']=2;$r['item_container_id']=2;$r['record_key']=json_encode($key);$payload=['context'=>['item_container_id'=>1]];if($method==='get')$payload['id']=$r['record_key'];$this->closed(502,fn()=>$this->invoke($method,$r,$payload));}
 }
 public function testRawStringIdsAndKeyStringValuesRejectedBeforeCast():void {
  foreach(['cta_corren_custo_distr_id','item_container_id'] as $field){$r=self::row();$r[$field]=(string)$r[$field];$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]]));$r=self::row();$key=json_decode($r['record_key'],true);$key[$field]=(string)$key[$field];$r['record_key']=json_encode($key);$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]]));}
 }
 public function testGetRequiresExactRequestedOpaqueKeyAndSuccessfulBody():void {
  $r=self::row();$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key'],'context'=>['item_container_id'=>1]],success:false));$alternate=json_encode(['item_container_id'=>1,'cta_corren_custo_distr_id'=>$r['cta_corren_custo_distr_id']]);self::assertNotSame($alternate,$r['record_key']);$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$alternate,'context'=>['item_container_id'=>1]]));
 }
 public function testConflictingRawAliasesFailBeforeTransportEvenIfSameDecodedIdentity():void {
  $r=self::row();$alternate=json_encode(['item_container_id'=>1,'cta_corren_custo_distr_id'=>$r['cta_corren_custo_distr_id']]);
  foreach([['record_key'=>$alternate],['record'=>['record_key'=>$alternate]],['record_key'=>1]] as $extra){$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);$this->closed(422,fn()=>(new \ReflectionMethod($s,'get'))->invoke($s,self::definition(),['id'=>$r['record_key'],'context'=>['item_container_id'=>1]]+$extra));}
 }
}
