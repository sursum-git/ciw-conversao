<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeCiwErpQuery,RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeSampleContainerItemsReadIntegrationTest extends TestCase
{
 private static function definition():array {
  $m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/item_container_amostra-builder-draft.json'),true);$fields=[];
  foreach($m['entityDraft']['fields'] as $f)$fields[$f['code']]=['code'=>$f['code'],'dataType'=>$f['dataType'],'jsonPath'=>$f['code'],'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'item_container_amostra'],'requestContextFields'=>[]];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>$m['entityDraft']['code'],'primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private static function row():array {return ['record_key'=>'{"item_container_id":1}','item_container_id'=>1,'codigo_erp'=>' CODE ç ','descricao'=>null,'container_id'=>210];}
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>($sent['skip']??0)+1]];});
  $s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return (new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 public function testGlobalSourceHasRealNativeErpBinding():void {self::assertTrue(RuntimeCiwErpQuery::supports(self::definition()));}
 public function testRealReadGetKeepNullRawTextAndIntegerIds():void {
  $r=self::row();$read=$this->invoke('readCiwErpPage',$r,['take'=>1],function($sent){self::assertSame('item_container_amostra',$sent['resource']);self::assertArrayNotHasKey('empresa_id',$sent);self::assertArrayNotHasKey('container_id',$sent);});self::assertSame($r,$read['data'][0]);$get=$this->invoke('get',$r,['id'=>$r['record_key'],'record_key'=>$r['record_key']]);self::assertSame($r,$get);self::assertNull($get['descricao']);self::assertSame(1,$get['item_container_id']);self::assertSame(210,$get['container_id']);
 }
 public function testRealNativeFilterSortAndPageAreSentToSingleReader():void {
  foreach(['codigo_erp','descricao','container_id','item_container_id'] as $field){$r=self::row();$value=in_array($field,['container_id','item_container_id'],true)?1:'Atual ç';$filter=['field'=>$field,'operator'=>'eq','value'=>$value];$sort=[['field'=>'container_id','dir'=>'asc']];$read=$this->invoke('readCiwErpPage',$r,['skip'=>200,'take'=>200,'filter'=>$filter,'sort'=>$sort],function($sent)use($filter,$sort){self::assertSame($filter,$sent['filter']);self::assertSame($sort,$sent['sort']);self::assertSame(200,$sent['skip']);self::assertSame(200,$sent['take']);});self::assertSame($r,$read['data'][0]);}
 }
 public function testPhysicalKeyRejectedBeforeMappingCanCast():void {$r=self::row();$r['item_container_id']='1';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']]));}
 public function testReturnedKeyMustMatchPhysicalAndRequestedKey():void {$r=self::row();$r['record_key']='{"item_container_id":2}';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']]));$r['item_container_id']=2;$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>'{"item_container_id":1}']));}
 public function testGetRequiresSuccessfulBody():void {$r=self::row();$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']],success:false));}
 public function testContextAndRawAliasesFailBeforeTransport():void {
  foreach([['context'=>['empresa_id'=>5]],['context'=>['container_id'=>210]],['id'=>'{"item_container_id":1}','record_key'=>'{"item_container_id":1} '],['id'=>'{"item_container_id":1}','record'=>['record_key'=>'{"item_container_id":2}']],['id'=>'{"item_container_id":"1"}']] as $p){$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);$method=isset($p['id'])?'get':'readCiwErpPage';$this->closed(422,fn()=>(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$p));}
 }
 public function testReadRejectsExtraKeyFieldsAndWrongContainerType():void {$r=self::row();$r['record_key']='{"item_container_id":1,"extra":0}';$this->closed(502,fn()=>$this->invoke('readCiwErpPage',$r,['take'=>1]));$r=self::row();$r['container_id']='210';$this->closed(502,fn()=>$this->invoke('readCiwErpPage',$r,['take'=>1]));}
}
