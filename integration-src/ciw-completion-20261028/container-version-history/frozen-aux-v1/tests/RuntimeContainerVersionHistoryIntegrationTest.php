<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeContainerVersionHistoryIntegrationTest extends TestCase
{
 private static function definition():array {
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'container_versoes_historico_med'],'requestContextFields'=>['container_id','versao_id']];$g=$e;$g['bodyTemplate']['operation']='get';
  $fields=[];foreach(['record_key'=>'string','container_id'=>'integer','versao_id'=>'integer','item_container_custo_id'=>'integer','vl_unit_realiz'=>'decimal','vl_desconto_utiliz_real'=>'string']as $code=>$type)$fields[$code]=['code'=>$code,'dataType'=>$type,'jsonPath'=>$code,'collection'=>false];
  return ['entityCode'=>'container_versoes_historico_med_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private static function row(int $version=1001):array{return ['record_key'=>'{"container_id":123,"versao_id":1001,"item_container_custo_id":2001}','container_id'=>123,'versao_id'=>$version,'item_container_custo_id'=>2001,'vl_unit_realiz'=>null,'vl_desconto_utiliz_real'=>' 1.234,50 original '];}
 private function invoke(string $method,array $payload,array $body,?callable $inspect=null,?array $definition=null):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($body,$inspect){if($inspect)$inspect($sent);return ['status'=>200,'body'=>$body];});
  $transactions=$this->createStub(RuntimeTransactionService::class);$service=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$transactions,$client);
  return (new \ReflectionMethod($service,$method))->invoke($service,$definition??self::definition(),$payload);
 }
 public function testRealReadCiwErpPageMapsFullContextNullAndHistoricalString():void {
  $row=self::row();$result=$this->invoke('readCiwErpPage',['context'=>['container_id'=>123,'versao_id'=>1001],'skip'=>200,'take'=>1],['success'=>true,'data'=>[$row],'total'=>201],function($sent){self::assertSame(123,$sent['container_id']);self::assertSame(1001,$sent['versao_id']);self::assertSame(200,$sent['skip']);});
  self::assertSame(['data'=>[$row],'total'=>201],$result);
 }
 public function testRealReadCiwErpPageRejectsCrossVersionBeforeMapping():void {
  $this->expectException(RuntimeHttpException::class);$this->invoke('readCiwErpPage',['context'=>['container_id'=>123,'versao_id'=>1001],'take'=>1],['success'=>true,'data'=>[self::row(1002)],'total'=>1]);
 }
 public function testRealGetMapsFullContextAndPreservesNullAndCharacterValue():void {
  $row=self::row();$result=$this->invoke('get',['context'=>['container_id'=>123,'versao_id'=>1001],'id'=>$row['record_key'],'record_key'=>$row['record_key']],['success'=>true,'data'=>$row],function($sent)use($row){self::assertSame($row['record_key'],$sent['id']);self::assertSame($row['record_key'],$sent['record_key']);self::assertSame(123,$sent['container_id']);self::assertSame(1001,$sent['versao_id']);});self::assertSame($row,$result);
 }
 public function testRealGetRejectsCrossVersionAfterMapping():void {
  $this->expectException(RuntimeHttpException::class);$this->invoke('get',['context'=>['container_id'=>123,'versao_id'=>1001],'id'=>self::row()['record_key']],['success'=>true,'data'=>self::row(1002)]);
 }
 public function testSubmittedGetAliasCannotBeSilentlyNormalized():void {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$service=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);
  $this->expectException(RuntimeHttpException::class);(new \ReflectionMethod($service,'get'))->invoke($service,self::definition(),['context'=>['container_id'=>123,'versao_id'=>1001],'id'=>self::row()['record_key'],'record_key'=>self::row()['record_key'].' ']);
 }
 public function testAuxiliaryViewsUseRealReadAndGetMappingWithRecordKeys():void {
  foreach(json_decode(file_get_contents(dirname(__DIR__).'/auxiliary-views.json'),true)as $view){
   $meta=json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$view['resource'].'-builder-draft.json'),true);$d=self::definition();$d['entityCode']=$view['entity'];$d['fields']=[];$row=[];
   foreach($meta['entityDraft']['fields']as $f){$code=$f['code'];$d['fields'][$code]=['code'=>$code,'dataType'=>$f['dataType'],'jsonPath'=>$code,'collection'=>false];$row[$code]=$f['dataType']==='integer'?7:($f['dataType']==='decimal'?null:'RAW');}
   $row['container_id']=123;$row['versao_id']=1001;$key=[];foreach(explode(',',$view['keys'])as $field)$key[$field]=$row[$field];$row['record_key']=json_encode($key);
   foreach(['listEndpoint','detailEndpoint']as $endpoint)$d['apiSource'][$endpoint]['bodyTemplate']['resource']=$view['resource'];
   $context=['container_id'=>123,'versao_id'=>1001];$read=$this->invoke('readCiwErpPage',['context'=>$context,'take'=>1],['success'=>true,'data'=>[$row],'total'=>1],null,$d);self::assertSame($row,$read['data'][0]);
   $get=$this->invoke('get',['context'=>$context,'id'=>$row['record_key'],'record_key'=>$row['record_key']],['success'=>true,'data'=>$row],null,$d);self::assertSame($row,$get);
   $wrong=$row;$wrong['versao_id']=1002;try{$this->invoke('readCiwErpPage',['context'=>$context,'take'=>1],['success'=>true,'data'=>[$wrong],'total'=>1],null,$d);self::fail('Cross-version auxiliary row accepted');}catch(RuntimeHttpException $e){self::assertSame(502,$e->getStatusCode());}
  }
 }
}

