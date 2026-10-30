<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeImportDiscountReadIntegrationTest extends TestCase
{
 private static function definition(bool $ledger):array {
  $resource=$ledger?'import_descontos_lancamentos':'import_descontos_geral';$m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$resource.'-builder-draft.json'),true);$fields=[];foreach($m['entityDraft']['fields']as $f)$fields[$f['code']]=['code'=>$f['code'],'dataType'=>$f['dataType'],'jsonPath'=>$f['code'],'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>$resource],'requestContextFields'=>$ledger?['desconto_importacao_id']:[]];$g=$e;$g['bodyTemplate']['operation']='get';return ['entityCode'=>$m['entityDraft']['code'],'primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private static function row(bool $ledger):array {
  $d=self::definition($ledger);$row=[];foreach($d['fields']as $c=>$f)$row[$c]=match($f['dataType']){'integer'=>1,'decimal'=>null,'boolean'=>null,'date'=>'2024-02-03',default=>' RAW '};$row['desconto_importacao_id']=1;
  if($ledger){$row['cta_corren_desconto_id']=1001;$row['container_id']=601;$row['data']=null;$row['record_key']='{"desconto_importacao_id":1,"cta_corren_desconto_id":1001}';}
  else{$row['vl_utiliz']=0;$row['vl_utiliz_detalhe']=null;$row['vl_saldo']=100;$row['record_key']='{"desconto_importacao_id":1}';}return $row;
 }
 private function invoke(string $method,bool $ledger,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>1]];});$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($s,$method))->invoke($s,self::definition($ledger),$payload);
 }
 public function testRealGlobalReadAndGetKeepExplicitNullAndZeroSemantics():void {
  $row=self::row(false);$read=$this->invoke('readCiwErpPage',false,$row,['take'=>1],function($sent){self::assertArrayNotHasKey('desconto_importacao_id',$sent);self::assertArrayNotHasKey('empresa_id',$sent);});self::assertSame($row,$read['data'][0]);$get=$this->invoke('get',false,$row,['id'=>$row['record_key'],'record_key'=>$row['record_key']]);self::assertSame($row,$get);self::assertNull($get['vl_utiliz_detalhe']);self::assertSame(0,$get['vl_utiliz']);
 }
 public function testRealLedgerReadGetForwardOwnerAndMapPhysicalDate():void {
  $row=self::row(true);$context=['desconto_importacao_id'=>1];$inspect=static fn($sent)=>self::assertSame(1,$sent['desconto_importacao_id']);$read=$this->invoke('readCiwErpPage',true,$row,['take'=>1,'context'=>$context],$inspect);self::assertSame($row,$read['data'][0]);$get=$this->invoke('get',true,$row,['id'=>$row['record_key'],'record_key'=>$row['record_key'],'context'=>$context],$inspect);self::assertSame($row,$get);self::assertSame('2024-02-03',$get['cod_usuario']);self::assertNull($get['data']);
 }
 private function assertClosedStatus(int $status,callable $run):void {try{$run();self::fail('Expected closed status '.$status);}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 public function testLedgerReadRejectsWrongOwnerBeforeMapping():void {$row=self::row(true);$row['desconto_importacao_id']=2;$this->assertClosedStatus(502,fn()=>$this->invoke('readCiwErpPage',true,$row,['take'=>1,'context'=>['desconto_importacao_id'=>1]]));}
 public function testLedgerGetRejectsWrongOwner():void {$row=self::row(true);$row['desconto_importacao_id']=2;$this->assertClosedStatus(502,fn()=>$this->invoke('get',true,$row,['id'=>$row['record_key'],'context'=>['desconto_importacao_id'=>1]]));}
 public function testGetRejectsReturnedKeyNotMatchingPhysicalRow():void {$row=self::row(true);$row['record_key']='{"desconto_importacao_id":1,"cta_corren_desconto_id":999}';$this->assertClosedStatus(502,fn()=>$this->invoke('get',true,$row,['id'=>$row['record_key'],'context'=>['desconto_importacao_id'=>1]]));}
 public function testGetRejectsPhysicalIdentityStringBeforeCast():void {$row=self::row(true);$row['cta_corren_desconto_id']='1001';$this->assertClosedStatus(502,fn()=>$this->invoke('get',true,$row,['id'=>$row['record_key'],'context'=>['desconto_importacao_id'=>1]]));}
 public function testGetRequiresSuccessfulUpstreamBody():void {$row=self::row(false);$this->assertClosedStatus(502,fn()=>$this->invoke('get',false,$row,['id'=>$row['record_key']],success:false));}
 public function testAliasDifferenceIsRejectedBeforeNetworkForBothViews():void {
  foreach([false,true]as $ledger){$row=self::row($ledger);$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);try{(new \ReflectionMethod($s,'get'))->invoke($s,self::definition($ledger),['id'=>$row['record_key'],'record_key'=>$row['record_key'].' ','context'=>$ledger?['desconto_importacao_id'=>1]:[]]);self::fail('Conflicting raw alias was accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}}
 }
 public function testGlobalContextAndMissingLedgerContextFailBeforeNetwork():void {
  foreach([[false,['desconto_importacao_id'=>1]],[true,[]]]as[$ledger,$context]){$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);try{(new \ReflectionMethod($s,'readCiwErpPage'))->invoke($s,self::definition($ledger),['take'=>1,'context'=>$context]);self::fail('Invalid query context accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}}
 }
 public function testCurrentNamesUseRealServerFilterSortAndMapping():void {
  foreach(['item_codigo_erp_atual','item_descricao_atual','fornecedor_nome_abrev_atual','motivo_descricao_atual']as $field){$row=self::row(false);$row[$field]='Atual ç';$filter=['field'=>$field,'operator'=>'eq','value'=>'Atual ç'];$sort=[['field'=>$field,'dir'=>'asc']];$read=$this->invoke('readCiwErpPage',false,$row,['take'=>1,'filter'=>$filter,'sort'=>$sort],function($sent)use($filter,$sort){self::assertSame($filter,$sent['filter']);self::assertSame($sort,$sent['sort']);});self::assertSame($row,$read['data'][0]);}
 }
 public function testMissingCurrentNamesRemainNullAndKeepRawIds():void {
  $row=self::row(false);foreach(['item_codigo_erp_atual','item_descricao_atual','fornecedor_nome_abrev_atual','motivo_descricao_atual']as $field)$row[$field]=null;$get=$this->invoke('get',false,$row,['id'=>$row['record_key'],'record_key'=>$row['record_key']]);self::assertSame($row,$get);self::assertSame(1,$get['item_container_id']);self::assertSame(1,$get['fornecedor_id']);self::assertSame(1,$get['motivo_desconto_id']);
 }
 public function testGetRejectsDifferentReturnedPhysicalRecord():void {$row=self::row(false);$row['desconto_importacao_id']=2;$row['record_key']='{"desconto_importacao_id":2}';$this->assertClosedStatus(502,fn()=>$this->invoke('get',false,$row,['id'=>'{"desconto_importacao_id":1}']));}
}
