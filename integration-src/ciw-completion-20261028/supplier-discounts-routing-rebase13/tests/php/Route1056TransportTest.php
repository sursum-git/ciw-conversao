<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException,RuntimeCiwErpQuery,RuntimeImportDiscountRead};
use PHPUnit\Framework\TestCase;
final class Route1056TransportTest extends TestCase {
 private static function row():array{return json_decode(file_get_contents(__DIR__.'/reader-row.json'),true,512,JSON_THROW_ON_ERROR);}
 private static function definition():array {
  $fields=[];foreach(self::row()as$key=>$value)$fields[$key]=['code'=>$key,'jsonPath'=>$key,'collection'=>false,'dataType'=>match(true){in_array($key,['desconto_importacao_id','motivo_desconto_id','item_container_id','cod_tipo','fornecedor_id'],true)=>'integer',str_starts_with($key,'vl_')=>'decimal',$key==='dt_autorizacao'=>'date',$key==='log_credito'=>'boolean',default=>'string'}];
  $endpoint=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['resource'=>'import_descontos_fornecedor','operation'=>'read'],'requestContextFields'=>['fornecedor_id']];$get=$endpoint;$get['bodyTemplate']['operation']='get';return['entityCode'=>'descontos_importacao_fornecedor_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$endpoint,'detailEndpoint'=>$get,'detailResponse'=>['itemPath'=>'data']]];
 }
 private function call(string $method,array $payload,array $body,?callable $inspect=null,bool $transport=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects($transport?self::once():self::never())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($body,$inspect){self::assertSame('http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros',explode('?',$url,2)[0]);$query=[];parse_str(parse_url($url,PHP_URL_QUERY)??'',$query);self::assertSame(($sent['operation']??null)==='get'?['id'=>self::row()['record_key'],'record_key'=>self::row()['record_key']]:[],$query);self::assertSame('POST',$verb);self::assertSame([],$headers);if($inspect)$inspect($sent);return['status'=>200,'body'=>$body];});$service=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($service,$method))->invoke($service,self::definition(),$payload);
 }
 private function closed(int $status,callable $run,?string $code=null):void{try{$run();self::fail('Expected closed response');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());if($code!==null)self::assertSame($code,$e->getErrorCode());}}
 public function testExactNativeGridAndGetDtosPassSignedValuesThroughRealReadDispatcher():void {
  $input=json_decode(file_get_contents(dirname(__DIR__,2).'/test-inputs/signed-native-traces.json'),true,512,JSON_THROW_ON_ERROR);$observed=[];
  foreach($input['traces']as$trace){$row=self::row();$row['fornecedor_id']=$trace['supplier'];foreach(['read','get']as$method){$body=['success'=>true,'data'=>$method==='read'?[$row]:$row,'total'=>1];$out=$this->call($method,$trace[$method],$body,function($sent)use($trace,$method,&$observed){self::assertSame($trace['supplier'],$sent['fornecedor_id']);self::assertSame('import_descontos_fornecedor',$sent['resource']);self::assertSame($method,$sent['operation']);self::assertArrayNotHasKey('context',$sent);self::assertArrayNotHasKey('fornec_id',$sent);if($method==='read'){self::assertSame(['field'=>'fornecedor_id','operator'=>'eq','value'=>$trace['supplier']],$sent['filter']);self::assertSame(2,$sent['take']);}else self::assertSame(self::row()['record_key'],$sent['id']);$observed[]=['method'=>$method,'supplier'=>$trace['supplier'],'sent'=>$sent];});self::assertSame($row,$method==='read'?$out['data'][0]:$out);}}
  $dir=getenv('ROUTING_RECEIPTS');if($dir)file_put_contents($dir.'/native-routing-traces.json',json_encode(['success'=>true,'networkExecuted'=>false,'businessWrites'=>false,'requests'=>$observed],JSON_PRETTY_PRINT|JSON_PRESERVE_ZERO_FRACTION|JSON_THROW_ON_ERROR));
 }
 public function testAmbiguousSupplierCannotReachTransportAndGetCannotInferFilterOnlyContext():void {
  foreach([[],['filters'=>[]],['context'=>[],'filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0]]],['filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0],['field'=>'fornecedor_id','operator'=>'eq','value'=>-9]]],['filter'=>['logic'=>'or','filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0],['field'=>'fornecedor_id','operator'=>'eq','value'=>0]]]],['filters'=>[['field'=>'fornecedor_id','operator'=>'neq','value'=>0]]]]as$payload)$this->closed(422,fn()=>$this->call('read',$payload,[],transport:false));
  $this->closed(422,fn()=>$this->call('get',['id'=>self::row()['record_key'],'filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0]]],[],transport:false));
 }
 public function testAllReturnedRowsAreValidatedBeforeMappingAndPageContractIsHonest():void {
  $good=self::row();$good['fornecedor_id']=-9;$payload=['take'=>2,'filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>-9]]];$bad=$good;$bad['fornecedor_id']=0;
  $this->closed(502,fn()=>$this->call('read',$payload,['success'=>true,'data'=>[$good,$bad],'total'=>2]));
  foreach([['success'=>false,'data'=>[$good],'total'=>1],['success'=>true,'data'=>[$good],'total'=>0],['success'=>true,'data'=>[$good],'total'=>'1'],['success'=>true,'data'=>[$good],'total'=>1,'error'=>['code'=>'synthetic']]]as$body)$this->closed(502,fn()=>$this->call('read',$payload,$body));
  $empty=$this->call('read',$payload+['skip'=>2],['success'=>true,'data'=>[],'total'=>1],function($sent){self::assertSame(2,$sent['skip']);self::assertSame(-9,$sent['fornecedor_id']);});self::assertSame(['data'=>[],'total'=>1],$empty);
 }
 public function testRawShapeOwnerAliasesAndOpaqueIdentityStayClosedForReadAndGet():void {
  foreach(['read','get']as$method)foreach(['wrongOwner','stringOwner','nullOwner','key','extra','date','boolean']as$case){$row=self::row();$row['fornecedor_id']=0;switch($case){case'wrongOwner':$row['fornecedor_id']=-9;break;case'stringOwner':$row['fornecedor_id']='0';break;case'nullOwner':$row['fornecedor_id']=null;break;case'key':$row['record_key']='{"desconto_importacao_id":2}';break;case'extra':$row['unknown']=true;break;case'date':$row['dt_autorizacao']='2026-02-31';break;case'boolean':$row['log_credito']='true';break;}$payload=$method==='read'?['filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0]]]:['context'=>['fornecedor_id'=>0],'id'=>self::row()['record_key']];$this->closed(502,fn()=>$this->call($method,$payload,['success'=>true,'data'=>$method==='read'?[$row]:$row,'total'=>1]));}
  $this->closed(422,fn()=>$this->call('get',['context'=>['fornecedor_id'=>0],'id'=>self::row()['record_key'],'record_key'=>self::row()['record_key'].' '],[],transport:false));
 }
 public function testContradictoryReadErrorUsesExisting502CodeAndNullMatchesGetSemantics():void {
  $row=self::row();$row['fornecedor_id']=0;$read=['filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>0]]];
  foreach([[],false,['code'=>'synthetic']]as$error)$this->closed(502,fn()=>$this->call('read',$read,['success'=>true,'data'=>[$row],'total'=>1,'error'=>$error]),'CIW_ERP_RESPONSE_INVALID');
  self::assertSame($row,$this->call('read',$read,['success'=>true,'data'=>[$row],'total'=>1,'error'=>null])['data'][0]);
  self::assertSame($row,$this->call('get',['id'=>$row['record_key'],'context'=>['fornecedor_id'=>0]],['success'=>true,'data'=>$row,'error'=>null]));
 }
 public function testOnlyNewSupplierResourceIsAddedAndSignedHelperBytesArePinned():void {
  self::assertTrue(RuntimeCiwErpQuery::supports(self::definition()));self::assertTrue(RuntimeImportDiscountRead::isSupplier(self::definition()));$path=dirname(__DIR__,2).'/candidate/backend/src/Runtime/RuntimeImportDiscountRead.php';self::assertSame('d89428668214f8901cd02a32176200afa3433f645fddd3cf42cd749e8545893a',hash_file('sha256',$path));
 }
}
