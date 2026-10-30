<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimePurchaseItemAudit};
use PHPUnit\Framework\TestCase;
final class NavigationRuntimeBoundaryTest extends TestCase {
 private function service(callable $request):RuntimeApiEntityActionService{$client=$this->createStub(RuntimeExternalJsonClient::class);$client->method('request')->willReturnCallback($request);return new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);}
 private function filters(string $parent,string $key):array{return[['field'=>$parent,'operator'=>'eq','value'=>12],['field'=>$key,'operator'=>'eq','value'=>34]];}
 public function testActualErpReadTransportsPkFilterBeforePagingAndPreservesFilteredTotal():void{
  $schema=(new \ReflectionClass(RuntimePurchaseItemAudit::class))->getConstant('MAIN')+['row_stamp'=>'stamp','qt_alocada'=>'decimal','qt_saldo'=>'decimal','calc_gm'=>['type'=>'decimal','nullable'=>true]];$row=[];$fields=[];
  foreach($schema as$name=>$rule){$rule=is_string($rule)?['type'=>$rule]:$rule;$row[$name]=($rule['nullable']??false)?null:match($rule['type']){'id'=>1,'integer'=>0,'decimal'=>0,'boolean'=>false,'stamp'=>str_repeat('A',64),'date','datetime'=>null,default=>''};$fields[$name]=['code'=>$name,'jsonPath'=>$name,'dataType'=>match($rule['type']){'id'=>'integer','stamp'=>'string',default=>$rule['type']},'collection'=>false];}
  $row['item_proc_compra_id']=34;$row['proc_compra_id']=12;
  $endpoint=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>'proc_compra_itens'],'requestContextFields'=>['proc_compra_id']];
  $definition=['entityCode'=>'proc_compra_itens_progress','primaryKey'=>'item_proc_compra_id','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','listEndpoint'=>$endpoint,'authHeaders'=>[]]];$calls=0;
  $service=$this->service(function($url,$method,$headers,$body)use(&$calls,$row){$calls++;self::assertSame(12,$body['proc_compra_id']);self::assertArrayNotHasKey('context',$body);self::assertArrayNotHasKey('item_proc_compra_id',$body);self::assertSame(['logic'=>'and','filters'=>$this->filters('proc_compra_id','item_proc_compra_id')],$body['filter']);self::assertSame(1,$body['take']);return['status'=>200,'body'=>['success'=>true,'data'=>$body['skip']===0?[$row]:[],'total'=>1]];});
  $method=new \ReflectionMethod($service,'readCiwErpPage');$first=$method->invoke($service,$definition,['take'=>1,'skip'=>0,'filters'=>$this->filters('proc_compra_id','item_proc_compra_id')]);self::assertSame(1,$first['total']);self::assertSame(34,$first['data'][0]['item_proc_compra_id']);$beyond=$method->invoke($service,$definition,['take'=>1,'skip'=>1,'filters'=>$this->filters('proc_compra_id','item_proc_compra_id')]);self::assertSame(['data'=>[],'total'=>1],$beyond);self::assertSame(2,$calls);
 }
 public function testActualContainerReadAppliesFixedPkBeforeNativePageAndTotalWithoutChangingParentOnlySourceAbi():void{
  $definition=['entityCode'=>'container_itens_progress','primaryKey'=>'item_container_id','fields'=>[],'apiSource'=>['listEndpoint'=>['url'=>'/closed/container-items','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>'itens'],'requestContextFields'=>['container_id']],'listResponse'=>['itemsPath'=>'data'],'authHeaders'=>[]]];foreach(['item_container_id','container_id']as$name)$definition['fields'][$name]=['code'=>$name,'jsonPath'=>$name,'dataType'=>'integer','collection'=>false];
  $service=$this->service(function($url,$method,$headers,$body){self::assertSame(['operation'=>'read','resource'=>'itens','container_id'=>12],$body);return['status'=>200,'body'=>['data'=>[['item_container_id'=>34,'container_id'=>12],['item_container_id'=>99,'container_id'=>12]]]];});$method=new \ReflectionMethod($service,'read');
  $first=$method->invoke($service,$definition,['take'=>1,'skip'=>0,'filters'=>$this->filters('container_id','item_container_id')]);self::assertSame(1,$first['total']);self::assertSame(34,$first['data'][0]['item_container_id']);$beyond=$method->invoke($service,$definition,['take'=>1,'skip'=>1,'filters'=>$this->filters('container_id','item_container_id')]);self::assertSame(['data'=>[],'total'=>1],$beyond);
 }
}
