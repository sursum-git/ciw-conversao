<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeCiwErpQuery,RuntimeImportDiscountRead,RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class SupplierDiscountRuntimeTest extends TestCase
{
 private static function row():array {return json_decode(file_get_contents(__DIR__.'/reader-row.json'),true,512,JSON_THROW_ON_ERROR);}
 private static function definition():array {
  $fields=[];foreach(self::row()as $code=>$v)$fields[$code]=['code'=>$code,'dataType'=>in_array($code,['desconto_importacao_id','motivo_desconto_id','item_container_id','cod_tipo','fornecedor_id'],true)?'integer':(str_starts_with($code,'vl_')?'decimal':($code==='dt_autorizacao'?'date':($code==='log_credito'?'boolean':'string'))),'jsonPath'=>$code,'collection'=>false];
  $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['resource'=>'import_descontos_fornecedor','operation'=>'read'],'requestContextFields'=>['fornecedor_id']];$g=$e;$g['bodyTemplate']['operation']='get';
  return ['entityCode'=>'descontos_importacao_fornecedor_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
 }
 private function invoke(string $method,array $row,array $payload,?callable $inspect=null,bool $success=true):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$inspect,$success){if($inspect)$inspect($sent);return ['status'=>200,'body'=>['success'=>$success,'data'=>$method==='get'?$row:[$row],'total'=>($sent['skip']??0)+1]];});
  $s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($s,$method))->invoke($s,self::definition(),$payload);
 }
 private function closed(int $status,callable $run):void {try{$run();self::fail('Expected closed status');}catch(RuntimeHttpException $e){self::assertSame($status,$e->getStatusCode());}}
 private function noTransport(string $method,array $payload,?array $definition=null):void {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::never())->method('request');$s=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);$this->closed(422,fn()=>(new \ReflectionMethod($s,$method))->invoke($s,$definition??self::definition(),$payload));
 }
 public function testClosedSupplierResourceReusesExistingHelperAndReader():void {self::assertTrue(RuntimeImportDiscountRead::supports(self::definition()));self::assertTrue(RuntimeCiwErpQuery::supports(self::definition()));}
 public function testActualTtRowSurvivesRealRuntimeReadGetAndBalanceIsUnchanged():void {
  $r=self::row();foreach(['readCiwErpPage','get']as $method){$p=['context'=>['fornecedor_id'=>7],'take'=>1];if($method==='get')$p=['context'=>['fornecedor_id'=>7],'id'=>$r['record_key'],'record_key'=>$r['record_key']];$out=$this->invoke($method,$r,$p,function($sent)use($method,$r){self::assertSame(7,$sent['fornecedor_id']);self::assertSame('import_descontos_fornecedor',$sent['resource']);self::assertArrayNotHasKey('fornec_id',$sent);self::assertArrayNotHasKey('empresa_id',$sent);if($method==='get')self::assertSame($r['record_key'],$sent['id']);});self::assertSame($r,$method==='get'?$out:$out['data'][0]);}
  self::assertSame(90.0,$r['vl_saldo']);self::assertSame(' raw arquivo.pdf ',$r['arquivo']);
 }
 public function testObservedLegacyParameterHasExplicitNativeMappingAndSignedValues():void {
  $map=json_decode(file_get_contents(dirname(__DIR__,2).'/metadata/navigation-source-map.json'),true);self::assertSame('fornec_id',$map['legacyParameter']);self::assertSame('fornecedor_id',$map['nativeContextField']);
  foreach([0,-9,-2147483648,2147483647]as $value){$legacy=[$map['legacyParameter']=>$value];$r=self::row();$r['fornecedor_id']=$value;$context=[$map['nativeContextField']=>$legacy[$map['legacyParameter']]];
   foreach(['readCiwErpPage','get']as $method){$p=['context'=>$context,'take'=>1];if($method==='get')$p=['context'=>$context,'id'=>$r['record_key']];$out=$this->invoke($method,$r,$p,fn($sent)=>self::assertSame($value,$sent['fornecedor_id']));self::assertSame($value,($method==='get'?$out:$out['data'][0])['fornecedor_id']);}
  }
 }
 public function testNativeContextStringBecomesStrictSignedIntegerWithoutRelaxingFilterTypes():void {
  foreach(['0','-9','-2147483648','2147483647']as $raw){$r=self::row();$r['fornecedor_id']=(int)$raw;$out=$this->invoke('get',$r,['context'=>['fornecedor_id'=>$raw],'id'=>$r['record_key']],fn($sent)=>self::assertSame((int)$raw,$sent['fornecedor_id']));self::assertSame((int)$raw,$out['fornecedor_id']);}
 }
 public function testRequiredSignedContextRejectsNullFloatOverflowAndAliasesBeforeTransport():void {
  foreach([[],['fornecedor_id'=>null],['fornecedor_id'=>1.5],['fornecedor_id'=>true],['fornecedor_id'=>2147483648],['fornecedor_id'=>-2147483649],['fornecedor_id'=>'01'],['fornecedor_id'=>'-0'],['fornecedor_id'=>'+1'],['fornecedor_id'=>' 1'],['fornecedor_id'=>7,'empresa_id'=>5],['fornec_id'=>7]]as $context)$this->noTransport('readCiwErpPage',['context'=>$context]);
 }
 public function testSupplierFiltersMustBeConjunctiveEqualityAndConsistent():void {
  foreach([['field'=>'fornecedor_id','operator'=>'neq','value'=>7],['field'=>'fornecedor_id','operator'=>'eq','value'=>8],['logic'=>'or','filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>7],['field'=>'fornecedor_id','operator'=>'eq','value'=>8]]]]as $filter)$this->noTransport('readCiwErpPage',['context'=>['fornecedor_id'=>7],'filter'=>$filter]);
 }
 public function testExistingFinancialAndFileFiltersAndPageAreForwardedWithoutNewCalculation():void {
  foreach([['field'=>'vl_saldo','operator'=>'eq','value'=>90],['field'=>'arquivo','operator'=>'contains','value'=>'pdf']]as $filter){$r=self::row();$out=$this->invoke('readCiwErpPage',$r,['context'=>['fornecedor_id'=>7],'skip'=>200,'take'=>200,'filter'=>$filter],function($sent)use($filter){self::assertSame($filter,$sent['filter']);self::assertSame(200,$sent['skip']);self::assertSame(200,$sent['take']);});self::assertSame($r,$out['data'][0]);}
 }
 public function testRawAliasesWrongOwnerAndKeyTypesAreRejected():void {
  $r=self::row();$this->noTransport('get',['context'=>['fornecedor_id'=>7],'id'=>$r['record_key'],'record_key'=>$r['record_key'].' ']);
  foreach(['readCiwErpPage','get']as $method){$bad=$r;$bad['fornecedor_id']=8;$p=['context'=>['fornecedor_id'=>7],'take'=>1];if($method==='get')$p=['context'=>['fornecedor_id'=>7],'id'=>$r['record_key']];$this->closed(502,fn()=>$this->invoke($method,$bad,$p));}
  $r['desconto_importacao_id']='1';$this->closed(502,fn()=>$this->invoke('get',$r,['context'=>['fornecedor_id'=>7],'id'=>$r['record_key']]));
 }
 public function testFileAndFinancialNullsStayRawAndUntrustedShapesFailBeforeMapping():void {
  $r=self::row();$r['arquivo']=null;$r['vl_dolar_autorizado']=null;$r['vl_utiliz']=0;$r['vl_utiliz_detalhe']=null;$r['vl_saldo']=null;$out=$this->invoke('get',$r,['context'=>['fornecedor_id'=>7],'id'=>$r['record_key']]);self::assertSame($r,$out);
  foreach(['arquivo','vl_saldo','fornecedor_id']as $field){$bad=self::row();$bad[$field]=['not'=>'a scalar'];$this->closed(502,fn()=>$this->invoke('get',$bad,['context'=>['fornecedor_id'=>7],'id'=>$bad['record_key']]));}
 }
 public function testExistingGlobalAndLedgerPositiveContextContractsStayClosed():void {
  $d=self::definition();$d['entityCode']='descontos_importacao_geral_progress';$d['apiSource']['listEndpoint']['bodyTemplate']['resource']='import_descontos_geral';$d['apiSource']['listEndpoint']['requestContextFields']=[];$this->noTransport('readCiwErpPage',['context'=>['fornecedor_id'=>0]],$d);
  $d['entityCode']='descontos_importacao_lancamentos_progress';$d['apiSource']['listEndpoint']['bodyTemplate']['resource']='import_descontos_lancamentos';$d['apiSource']['listEndpoint']['requestContextFields']=['desconto_importacao_id'];$this->noTransport('readCiwErpPage',['context'=>['desconto_importacao_id'=>0]],$d);
 }
 public function testSignedSupplierFilterIsStrictAndCannotReplaceRequiredNavigationContext():void {
  foreach([0,-9,-2147483648,2147483647]as $value){$row=self::row();$row['fornecedor_id']=$value;$filter=['logic'=>'and','filters'=>[['field'=>'fornecedor_id','operator'=>'eq','value'=>$value],['field'=>'vl_saldo','operator'=>'eq','value'=>90]]];$out=$this->invoke('readCiwErpPage',$row,['context'=>['fornecedor_id'=>$value],'take'=>1,'filter'=>$filter],function($sent)use($filter,$value){self::assertSame($value,$sent['fornecedor_id']);self::assertSame($filter,$sent['filter']);});self::assertSame($value,$out['data'][0]['fornecedor_id']);}
  $this->noTransport('readCiwErpPage',['filter'=>['field'=>'fornecedor_id','operator'=>'eq','value'=>7]]);
  $this->noTransport('readCiwErpPage',['context'=>['fornecedor_id'=>7],'filter'=>['field'=>'fornecedor_id','operator'=>'eq','value'=>'7']]);
 }
 public function testSupplierGetKeepsFixedEndpointSourceContractAndIntegerField():void {
  foreach(['source','field','method','url','user','port','path','body','context']as $case){$d=self::definition();switch($case){case 'source':$d['apiBinding']['sourceCode']='other';break;case 'field':$d['fields']['fornecedor_id']['dataType']='string';break;case 'method':$d['apiSource']['detailEndpoint']['method']='GET';break;case 'url':$d['apiSource']['detailEndpoint']['url']='https://elsewhere.invalid/SursumPrograms/ciw-cadastros';break;case 'user':$d['apiSource']['detailEndpoint']['url']='http://user@127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros';break;case 'port':$d['apiSource']['detailEndpoint']['url']='http://127.0.0.1:12345/med/web/SursumPrograms/ciw-cadastros';break;case 'path':$d['apiSource']['detailEndpoint']['url'].='?sql=arbitrary';break;case 'body':$d['apiSource']['detailEndpoint']['bodyTemplate']['other']=true;break;case 'context':$d['apiSource']['detailEndpoint']['requestContextFields']=['fornec_id'];break;}$this->noTransport('get',['context'=>['fornecedor_id'=>7],'id'=>self::row()['record_key']],$d);}
 }
 public function testUntrustedSupplierRowShapeDatesAndScalarTypesFailBeforeMapping():void {
  foreach(['extra','missing','date','boolean','infinite','nullOwner']as $case){$r=self::row();switch($case){case 'extra':$r['invented']=true;break;case 'missing':unset($r['arquivo']);break;case 'date':$r['dt_autorizacao']='2026-02-31';break;case 'boolean':$r['log_credito']='false';break;case 'infinite':$r['vl_saldo']=INF;break;case 'nullOwner':$r['fornecedor_id']=null;break;}$this->closed(502,fn()=>$this->invoke('get',$r,['context'=>['fornecedor_id'=>7],'id'=>$r['record_key']]));}
 }
 public function testExactSignedRowsProducedByTtReaderSurviveRealReadAndGet():void {
  foreach(['zero','negative']as $kind){$row=json_decode(file_get_contents(__DIR__.'/reader-'.$kind.'-row.json'),true,512,JSON_THROW_ON_ERROR);self::assertSame($kind==='zero'?0:-9,$row['fornecedor_id']);self::assertSame($kind==='zero'?0:-1,$row['desconto_importacao_id']);foreach(['readCiwErpPage','get']as $method){$p=['context'=>['fornecedor_id'=>$row['fornecedor_id']],'take'=>1];if($method==='get')$p=['context'=>['fornecedor_id'=>$row['fornecedor_id']],'id'=>$row['record_key'],'record_key'=>$row['record_key']];$actual=$this->invoke($method,$row,$p,function($sent)use($row,$method){self::assertSame($row['fornecedor_id'],$sent['fornecedor_id']);if($method==='get')self::assertSame($row['record_key'],$sent['id']);});self::assertSame($row,$method==='get'?$actual:$actual['data'][0]);}}
 }
}
