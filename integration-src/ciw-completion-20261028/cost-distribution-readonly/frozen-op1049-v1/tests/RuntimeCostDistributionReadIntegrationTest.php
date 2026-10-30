<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeCostDistributionReadIntegrationTest extends TestCase
{
 private static function definition():array {
  $m=json_decode(file_get_contents(dirname(__DIR__).'/metadata/custo_distribuicao_itens_aptos-builder-draft.json'),true);$fields=[];
  foreach($m['entityDraft']['fields'] as $f)$fields[$f['code']]=['code'=>$f['code'],'dataType'=>$f['dataType'],'jsonPath'=>$f['code'],'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>'custo_distribuicao_itens_aptos'],'requestContextFields'=>[]];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>$m['entityDraft']['code'],'primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private static function row():array {
  $r=[];foreach(self::definition()['fields'] as $c=>$f)$r[$c]=$f['dataType']==='integer'?1:' RAW ';$r['record_key']='{"item_container":1}';$r['descricao']=null;$r['fornec_pi_nome_abrev_atual']='Atual ç';$r['fornec_nome_abrev_atual']=null;return $r;
 }
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>1]];});
  $s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return (new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 public function testRealReadGetKeepNullsIdsAndCurrentLabels():void {
  $r=self::row();$read=$this->invoke('readCiwErpPage',$r,['take'=>1],function($sent){self::assertSame('custo_distribuicao_itens_aptos',$sent['resource']);self::assertArrayNotHasKey('empresa_id',$sent);self::assertArrayNotHasKey('container_id',$sent);});self::assertSame($r,$read['data'][0]);$get=$this->invoke('get',$r,['id'=>$r['record_key'],'record_key'=>$r['record_key']]);self::assertSame($r,$get);self::assertNull($get['descricao']);self::assertSame(1,$get['item_container']);
 }
 public function testRealNativeFilterSortBeforeTransportMapping():void {
  foreach(['codigo_erp','descricao','fornec_pi_nome_abrev_atual','fornec_nome_abrev_atual'] as $field){$r=self::row();$r[$field]='Atual ç';$filter=['field'=>$field,'operator'=>'eq','value'=>'Atual ç'];$sort=[['field'=>$field,'dir'=>'asc']];$read=$this->invoke('readCiwErpPage',$r,['take'=>1,'filter'=>$filter,'sort'=>$sort],function($sent)use($filter,$sort){self::assertSame($filter,$sent['filter']);self::assertSame($sort,$sent['sort']);});self::assertSame($r,$read['data'][0]);}
 }
 public function testWrongPhysicalKeyRejectedBeforeCast():void {$r=self::row();$r['item_container']='1';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']]));}
 public function testReturnedKeyMustMatchPhysicalAndRequestedKey():void {$r=self::row();$r['record_key']='{"item_container":2}';$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']]));$r['item_container']=2;$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>'{"item_container":1}']));}
 public function testGetNeedsSuccessfulBody():void {$r=self::row();$this->closed(502,fn()=>$this->invoke('get',$r,['id'=>$r['record_key']],success:false));}
 public function testContextAndAliasesFailBeforeNetwork():void {
  foreach([['context'=>['empresa_id'=>5]],['id'=>'{"item_container":1}','record_key'=>'{"item_container":1} '],['id'=>'{"item_container":1}','record'=>['record_key'=>'{"item_container":2}']]] as $p){$client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);$method=isset($p['id'])?'get':'readCiwErpPage';$this->closed(422,fn()=>(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$p));}
 }
 public function testReadRejectsMalformedRecordKey():void {$r=self::row();$r['record_key']='{"item_container":1,"extra":0}';$this->closed(502,fn()=>$this->invoke('readCiwErpPage',$r,['take'=>1]));}
}
