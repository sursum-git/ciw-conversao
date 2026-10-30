<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeCiwErpQuery,RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeCiwComparisonReadIntegrationTest extends TestCase
{
 private static function row():array {return json_decode(file_get_contents(__DIR__.'/reader-row.json'),true,512,JSON_THROW_ON_ERROR);}
 private static function context():array {return ['container_id'=>123,'versao_id'=>7];}
 private static function definition(string $currency='real'):array {
  $fields=[];foreach(self::row() as $code=>$value)$fields[$code]=['code'=>$code,'dataType'=>in_array($code,['container_id','versao_id','item_container_custo_id','item_container_id'],true)?'integer':(in_array($code,['record_key','codigo_erp','descricao'],true)?'string':'decimal'),'jsonPath'=>$code,'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'container_custos_comparacao_'.$currency],'requestContextFields'=>['container_id','versao_id']];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>'container_custos_comparacao_'.$currency.'_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true,string $currency='real'):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>($sent['skip']??0)+1]];});
  $s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($s,$method))->invoke($s,self::definition($currency),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 private function noTransport(string $method,array $definition,array $payload):void {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);
  $this->closed(422,fn()=>(new \ReflectionMethod($s,$method))->invoke($s,$definition,$payload));
 }
 public function testBothFixedResourcesAreRecognized():void {foreach(['real','dolar'] as $currency)self::assertTrue(RuntimeCiwErpQuery::supports(self::definition($currency)));}
 public function testActualCentralTtRowPassesRealReadAndGetWithExactOpaqueKey():void {
  $r=self::row();self::assertSame(['container_id','versao_id','item_container_custo_id'],array_keys(json_decode($r['record_key'],true)));
  foreach(['real','dolar'] as $currency)foreach(['readCiwErpPage','get'] as $method){$p=['context'=>self::context(),'take'=>1];if($method==='get')$p=['context'=>self::context(),'id'=>$r['record_key'],'record_key'=>$r['record_key']];
   $out=$this->invoke($method,$r,$p,function($sent)use($r,$method,$currency){self::assertSame('container_custos_comparacao_'.$currency,$sent['resource']);self::assertSame(123,$sent['container_id']);self::assertSame(7,$sent['versao_id']);self::assertArrayNotHasKey('empresa_id',$sent);if($method==='get'){self::assertSame($r['record_key'],$sent['id']);self::assertSame($r['record_key'],$sent['record_key']);}},currency:$currency);
   self::assertSame($r,$method==='get'?$out:$out['data'][0]);
  }
 }
 public function testServerPagingFiltersAndSortUseOneExistingReader():void {
  $r=self::row();$filter=['field'=>'vl_unit_sem_distr_custo','operator'=>'gt','value'=>10];$sort=[['field'=>'codigo_erp','dir'=>'desc']];
  $out=$this->invoke('readCiwErpPage',$r,['context'=>self::context(),'skip'=>200,'take'=>200,'filter'=>$filter,'sort'=>$sort],function($sent)use($filter,$sort){self::assertSame(200,$sent['skip']);self::assertSame(200,$sent['take']);self::assertSame($filter,$sent['filter']);self::assertSame($sort,$sent['sort']);});self::assertSame($r,$out['data'][0]);
 }
 public function testNullsAndZeroRemainDifferentWithoutFinancialRecalculation():void {
  $r=self::row();foreach(['descricao','codigo_erp','qt_alocada','vl_custo_prev','vl_unit_sem_distr_custo'] as $field)$r[$field]=null;$r['vl_tot_prev']=0;
  foreach(['readCiwErpPage','get'] as $method){$p=['context'=>self::context(),'take'=>1];if($method==='get')$p=['context'=>self::context(),'id'=>$r['record_key']];$out=$this->invoke($method,$r,$p);$v=$method==='get'?$out:$out['data'][0];self::assertNull($v['vl_custo_prev']);self::assertSame(0,$v['vl_tot_prev']);self::assertNull($v['descricao']);}
 }
 public function testKeyFieldOrderIsASetAndOpaqueStringIsNeverReserialized():void {
  $r=self::row();$r['record_key']=json_encode(['item_container_custo_id'=>$r['item_container_custo_id'],'versao_id'=>7,'container_id'=>123]);$out=$this->invoke('get',$r,['context'=>self::context(),'id'=>$r['record_key']],fn($sent)=>self::assertSame($r['record_key'],$sent['id']));self::assertSame($r,$out);
 }
 public function testWrongContextRejectedBeforeMappingEvenWithCoherentKey():void {
  foreach(['container_id','versao_id'] as $field)foreach(['readCiwErpPage','get'] as $method){$r=self::row();$r[$field]++;$key=json_decode($r['record_key'],true);$key[$field]=$r[$field];$r['record_key']=json_encode($key);$p=['context'=>self::context(),'take'=>1];if($method==='get')$p=['context'=>self::context(),'id'=>$r['record_key']];$this->closed(502,fn()=>$this->invoke($method,$r,$p));}
 }
 public function testMissingExtraOrStringPhysicalIdentitiesAreRejected():void {
  foreach(['extra','missing','string'] as $variant){$r=self::row();$key=json_decode($r['record_key'],true);if($variant==='extra')$key['unexpected']=0;elseif($variant==='missing')unset($key['versao_id']);else$key['item_container_custo_id']=(string)$key['item_container_custo_id'];$r['record_key']=json_encode($key);$this->closed(502,fn()=>$this->invoke('readCiwErpPage',$r,['context'=>self::context(),'take'=>1]));}
  foreach(['container_id','versao_id','item_container_custo_id','item_container_id'] as $field){$r=self::row();$r[$field]=(string)$r[$field];$this->closed(502,fn()=>$this->invoke('get',$r,['context'=>self::context(),'id'=>$r['record_key']]));}
 }
 public function testMissingExtraOrStringFinancialFieldsAreRejected():void {
  foreach(['missing','private','numberString','boolean'] as $variant){$r=self::row();if($variant==='missing')unset($r['vl_unit_prev']);elseif($variant==='private')$r['_projection_error']='COMPARISON_ZERO_DIVISOR';elseif($variant==='numberString')$r['vl_tot_prev']='120';else$r['vl_tot_prev']=true;$this->closed(502,fn()=>$this->invoke('readCiwErpPage',$r,['context'=>self::context(),'take'=>1]));}
 }
 public function testGetResponseRequiresSuccessAndRequestedRawKey():void {
  $r=self::row();$p=['context'=>self::context(),'id'=>$r['record_key']];$this->closed(502,fn()=>$this->invoke('get',$r,$p,success:false));$r['record_key'].=' ';$this->closed(502,fn()=>$this->invoke('get',$r,$p));
 }
 public function testContextAndAliasConflictsFailBeforeTransport():void {
  $r=self::row();foreach([['context'=>['container_id'=>123]],['context'=>self::context()+['empresa_id'=>5]],['context'=>self::context(),'take'=>201],['context'=>self::context(),'filter'=>['field'=>'versao_id','operator'=>'eq','value'=>8]],['context'=>self::context(),'filter'=>['field'=>'_projection_error','operator'=>'isnull']]] as $p)$this->noTransport('readCiwErpPage',self::definition(),$p);
  foreach([['record_key'=>$r['record_key'].' '],['record'=>['record_key'=>'{}']],['record_key'=>1]] as $extra)$this->noTransport('get',self::definition(),['context'=>self::context(),'id'=>$r['record_key']]+$extra);
 }
 public function testFixedBindingsRejectContextCurrencyAndResourceOverrides():void {
  foreach(['source','response','fields','resource','bodyExtra'] as $variant){$d=self::definition();if($variant==='source')$d['apiBinding']['sourceCode']='alternate';elseif($variant==='response')$d['apiSource']['responseContract']='json';elseif($variant==='fields')$d['apiSource']['listEndpoint']['requestContextFields']=['versao_id','container_id'];elseif($variant==='resource')$d['apiSource']['listEndpoint']['bodyTemplate']['resource']='container_custos_comparacao_dolar';else$d['apiSource']['listEndpoint']['bodyTemplate']['currency']='dolar';$this->noTransport('readCiwErpPage',$d,['context'=>self::context()]);}
 }
 public function testGetBindingAndOperationAreCheckedBeforeTransport():void {
  foreach(['url','operation','method'] as $variant){$d=self::definition();if($variant==='url')$d['apiSource']['detailEndpoint']['url']='https://example.invalid/med/web/SursumPrograms/ciw-cadastros';elseif($variant==='operation')$d['apiSource']['detailEndpoint']['bodyTemplate']['operation']='read';else$d['apiSource']['detailEndpoint']['method']='GET';$this->noTransport('get',$d,['context'=>self::context(),'id'=>self::row()['record_key']]);}
 }
}
