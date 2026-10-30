<?php
namespace App\Tests\Runtime;
use App\Entity\{BuilderEntity,BuilderField};
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeExpenseTaxRelationsReadTest extends TestCase {
 private static function row(?int$d=7,?int$t=9,?int$e=1):array{return ['despesa_id'=>$d,'imposto_id'=>$t,'empresa_id'=>$e,'record_key'=>json_encode(['despesa_id'=>$d,'imposto_id'=>$t,'empresa_id'=>$e],JSON_THROW_ON_ERROR)];}
 private static function endpoint(string$op):array{return ['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['resource'=>'despesas_impostos_geral','operation'=>$op],'requestContextFields'=>[]];}
 private static function entity(?array$list=null,?array$get=null,string$source='motor_progress_ciw_cadastros'):BuilderEntity{
  $e=(new BuilderEntity())->setCode('despesas_impostos_geral_progress')->setEntityType('api')->setMetadata(['apiBinding'=>['sourceCode'=>$source],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>['X-Ciw-Cadastros-Token'=>'synthetic-in-memory-token-only'],'listEndpoint'=>$list??self::endpoint('read'),'detailEndpoint'=>$get??self::endpoint('get'),'listResponse'=>['itemsPath'=>'data'],'detailResponse'=>['itemPath'=>'data']]]);
  foreach(['despesa_id','imposto_id','empresa_id','record_key']as$n)$e->addField((new BuilderField())->setCode($n)->setLabel($n)->setDataType($n==='record_key'?'string':'integer')->setPrimaryKey($n==='record_key')->setRequired($n==='record_key')->setOptions(['readonly'=>true,'writable'=>false,'api'=>['jsonPath'=>$n]]));return$e;
 }
 private function service(array$body,array&$sent,array&$logs,?BuilderEntity$e=null):RuntimeApiEntityActionService{
  $repo=$this->createStub(BuilderEntityRepository::class);$repo->method('findOneBy')->willReturn($e??self::entity());$client=$this->createStub(RuntimeExternalJsonClient::class);$client->method('request')->willReturnCallback(static function($url,$method,$headers,$bodySent)use(&$sent,$body){$sent[]=['url'=>$url,'method'=>$method,'headers'=>$headers,'body'=>$bodySent];return['status'=>200,'body'=>$body];});$tx=$this->createStub(RuntimeTransactionService::class);$tx->method('log')->willReturnCallback(static function(...$args)use(&$logs){$logs[]=$args;});return new RuntimeApiEntityActionService($repo,$tx,$client);
 }
 private function call(RuntimeApiEntityActionService$s,string$op,array$p=[]):array{return$s->handle('ciw.despesas-impostos-geral',$op,['entityCode'=>'despesas_impostos_geral_progress','operation'=>$op],$p);}
 private function refused(callable$f,int$status):void{try{$f();self::fail('Expected refusal');}catch(RuntimeHttpException$e){self::assertSame($status,$e->getStatusCode());}}
 public function testRawMismatchCannotPassTheActualErpReadPath():void{
  $r=self::row();$r['empresa_id']=99;$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>[$r],'total'=>1],$sent,$logs),'read'),502);self::assertSame([],$logs);
 }
 public function testGlobalRowsKeepPairMultiplicityNullableZeroAndSignedPhysicalKeys():void{
  $rows=[self::row(),self::row(e:2),self::row(0,0,0),self::row(null,9,1),self::row(7,null,1),self::row(7,9,null),self::row(null,null,null),self::row(-2147483648,2147483647,-1)];$sent=[];$logs=[];$actual=$this->call($this->service(['success'=>true,'data'=>$rows,'total'=>8],$sent,$logs),'read',['take'=>50]);self::assertSame($rows,$actual['data']);self::assertSame(8,$actual['total']);self::assertSame(['resource'=>'despesas_impostos_geral','operation'=>'read','skip'=>0,'take'=>50],$sent[0]['body']);self::assertCount(1,$logs);self::assertStringNotContainsString('synthetic-in-memory-token-only',json_encode($actual));
 }
 public function testNativePagingFilterAndSortAreForwardedToTheOnlyReader():void{
  $sent=[];$logs=[];$actual=$this->call($this->service(['success'=>true,'data'=>[self::row(e:2)],'total'=>2],$sent,$logs),'read',['take'=>1,'skip'=>1,'sort'=>[['field'=>'empresa_id','dir'=>'desc']],'filter'=>['field'=>'despesa_id','operator'=>'eq','value'=>7]]);self::assertSame(2,$actual['total']);self::assertSame(['field'=>'despesa_id','operator'=>'eq','value'=>7],$sent[0]['body']['filter']);self::assertSame([['field'=>'empresa_id','dir'=>'desc']],$sent[0]['body']['sort']);
 }
 public function testAllMalformedRawRowsFailBeforeMappingAndSuccessLog():void{
  $rows=[];foreach(['despesa_id','imposto_id','empresa_id']as$f){$r=self::row();unset($r[$f]);$rows[]=$r;foreach(['7',true,7.5,2147483648]as$v){$r=self::row();$r[$f]=$v;$rows[]=$r;}}$r=self::row();$r['extra']=1;$rows[]=$r;$r=self::row();$r['record_key']='{"despesa_id":7,"imposto_id":9}';$rows[]=$r;
  foreach($rows as$r){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>[$r],'total'=>1],$sent,$logs),'read'),502);self::assertSame([],$logs);}
 }
 public function testDuplicateFullPhysicalKeyAndInvalidRawEnvelopeFailClosed():void{
  $cases=[['success'=>true,'data'=>[self::row(),self::row()],'total'=>2],['success'=>true,'data'=>[self::row()],'total'=>50001],['success'=>true,'data'=>[self::row()],'total'=>1,'audit'=>[]],['success'=>true,'data'=>[self::row()],'total'=>1,'committed'=>true],['success'=>true,'data'=>[self::row()],'total'=>1,'error'=>[]]];
  foreach($cases as$body){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service($body,$sent,$logs),'read'),502);self::assertSame([],$logs);}
 }
 public function testGetMatchesEveryNullableComponentAndDoesNotChoosePairFirst():void{
  foreach([self::row(),self::row(e:2),self::row(null,9,1),self::row(0,0,0),self::row(-1,-1,-1)]as$r){$sent=[];$logs=[];$get=$this->call($this->service(['success'=>true,'data'=>$r],$sent,$logs),'get',['id'=>$r['record_key'],'record_key'=>$r['record_key'],'record'=>$r]);self::assertSame($r,$get);self::assertSame(['resource'=>'despesas_impostos_geral','operation'=>'get','id'=>$r['record_key'],'record_key'=>$r['record_key']],$sent[0]['body']);}
 }
 public function testGetRejectsCrossCompanyKeyBeforeMapping():void{
  $sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>self::row(e:2)],$sent,$logs),'get',['id'=>self::row()['record_key']]),502);self::assertSame([],$logs);
 }
 public function testSubmittedAliasAndPhysicalEchoConflictsNeverReachTransport():void{
  $key=self::row()['record_key'];$cases=[['id'=>$key,'record_key'=>self::row(e:2)['record_key']],['id'=>$key,'empresa_id'=>2],['id'=>$key,'record'=>self::row(e:2)],['id'=>$key,'record'=>['id'=>self::row(e:2)['record_key']]],['id'=>$key,'context'=>['empresa_id'=>1]],['id'=>$key,'record'=>'wrong']];
  foreach($cases as$p){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),'get',$p),422);self::assertSame([],$sent);}
 }
 public function testMalformedOpaqueJsonKeysNeverReachTransport():void{
  foreach(['{"despesa_id":7,"imposto_id":9}','{"despesa_id":7,"imposto_id":9,"empresa_id":"1"}','{"despesa_id":7,"imposto_id":9,"empresa_id":1,"extra":1}','{"despesa_id":7,"imposto_id":9,"empresa_id":1,"empresa_id":2}',' {"despesa_id":7,"imposto_id":9,"empresa_id":1}','{"DESPESA_ID":7,"imposto_id":9,"empresa_id":1}']as$key){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),'get',['id'=>$key]),422);self::assertSame([],$sent);}
 }
 public function testWrongFixedBindingsAreRejectedOnReadAndGet():void{
  foreach(['read','get']as$op){foreach(['method'=>'GET','requestContextFields'=>['empresa_id'],'url'=>'http://127.0.0.1:19910/ima/web/SursumPrograms/ciw-cadastros','bodyTemplate'=>['resource'=>'despesas','operation'=>$op]]as$k=>$v){$endpoint=self::endpoint($op);$endpoint[$k]=$v;$e=self::entity($op==='read'?$endpoint:null,$op==='get'?$endpoint:null);$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>$op==='read'?[self::row()]:self::row(),'total'=>1],$sent,$logs,$e),$op,$op==='get'?['id'=>self::row()['record_key']]:[]),422);self::assertSame([],$sent);}}
 }
 public function testAllWritersAndTechnicalOperationsRefusedWithoutTransport():void{
  foreach(['create','update','delete','batch','process','options','download']as$op){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),$op,['id'=>self::row()['record_key']]),405);self::assertSame([],$sent);}
 }
 public function testGlobalReadRejectsInventedContextSqlAndUnboundedPage():void{
  foreach([['context'=>['empresa_id'=>1]],['sql'=>'SELECT *'],['take'=>201],['skip'=>100001],['sort'=>[['field'=>'Empresa_id','dir'=>'asc']]]]as$p){$sent=[];$logs=[];$this->refused(fn()=>$this->call($this->service(['success'=>true,'data'=>[self::row()],'total'=>1],$sent,$logs),'read',$p),422);self::assertSame([],$sent);}
 }
 public function testActualTtReaderRawRowsAreAcceptedByActualTransport():void{
  $path='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/expense-tax-relations-readonly/local/expense-tax-relations-actual.json';$body=json_decode(file_get_contents($path),true,512,JSON_THROW_ON_ERROR);$sent=[];$logs=[];$actual=$this->call($this->service($body,$sent,$logs),'read');self::assertSame(8,$actual['total']);self::assertSame($body['data'],$actual['data']);foreach($actual['data']as$r){$sent=[];$logs=[];self::assertSame($r,$this->call($this->service(['success'=>true,'data'=>$r],$sent,$logs),'get',['id'=>$r['record_key']]));}
 }
}
