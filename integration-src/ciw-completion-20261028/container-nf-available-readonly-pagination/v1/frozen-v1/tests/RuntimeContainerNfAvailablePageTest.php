<?php
namespace App\Tests\Runtime;
use App\Entity\{BuilderEntity,BuilderField};
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeContainerNfAvailablePageTest extends TestCase
{
 private static function row():array{return ['container_id'=>71,'nf_key'=>'nf_'.str_repeat('A',64),'documento_localizado'=>true,'estab'=>'501','documento'=>'000001','serie'=>'  A  ','cod_emitente'=>51,'nat_operacao'=>'3101','especie'=>21,'dt_emissao'=>'2026-10-28','dt_trans'=>null,'tot_valor'=>123.456789,'despesa_nota'=>null,'valor_embal'=>0,'valor_frete'=>1.234567,'valor_mercad'=>100,'valor_outras'=>0,'valor_seguro'=>null];}
 private static function endpoint(string $op):array{return ['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/containers-financeiro','method'=>'POST','bodyTemplate'=>['operation'=>$op,'resource'=>'nfs-disponiveis'],'requestContextFields'=>['container_id']];}
 private static function entity(?array $ep=null,string $source='motor_progress_container_financeiro',string $code='container_nfs_disponiveis_med_progress'):BuilderEntity{
  $e=(new BuilderEntity())->setCode($code)->setEntityType('api')->setMetadata(['apiBinding'=>['sourceCode'=>$source],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>['X-Containers-Token'=>'in-memory-test-only'],'listEndpoint'=>$ep??self::endpoint('read'),'detailEndpoint'=>$ep?array_replace($ep,['bodyTemplate'=>array_replace($ep['bodyTemplate'],['operation'=>'get'])]):self::endpoint('get'),'listResponse'=>['itemsPath'=>'data'],'detailResponse'=>['itemPath'=>'data']]]);
  foreach(self::row()as$k=>$v){$type=in_array($k,['container_id','cod_emitente','especie'],true)?'integer':($k==='documento_localizado'?'boolean':(str_starts_with($k,'dt_')?'date':(in_array($k,['nf_key','documento','serie','estab','nat_operacao'],true)?'string':'decimal')));$e->addField((new BuilderField())->setCode($k)->setLabel($k)->setDataType($type)->setRequired($k==='nf_key')->setPrimaryKey($k==='nf_key')->setOptions(['readonly'=>true,'writable'=>false,'api'=>['jsonPath'=>$k]]));}return $e;
 }
 private function service(array $body,array &$sent,array &$logs,?BuilderEntity $entity=null):RuntimeApiEntityActionService{
  $repo=$this->createStub(BuilderEntityRepository::class);$repo->method('findOneBy')->willReturn($entity??self::entity());$client=$this->createStub(RuntimeExternalJsonClient::class);$client->method('request')->willReturnCallback(static function($url,$method,$headers,$request)use(&$sent,$body){$sent[]=['url'=>$url,'method'=>$method,'headers'=>$headers,'body'=>$request];return ['status'=>200,'body'=>$body];});$tx=$this->createStub(RuntimeTransactionService::class);$tx->method('log')->willReturnCallback(static function(...$args)use(&$logs){$logs[]=$args;});return new RuntimeApiEntityActionService($repo,$tx,$client);
 }
 private function call(RuntimeApiEntityActionService $s,string $op,array $p,string $entity='container_nfs_disponiveis_med_progress'):array{return $s->handle('ciw.container-nfs-disponiveis-med',$op,['entityCode'=>$entity,'operation'=>$op],$p);}
 private static function payload():array{return ['id'=>self::row()['nf_key'],'context'=>['container_id'=>71]];}
 public function testServerPageAndTotalAreValidatedWithoutLocalSecondSlice():void{
  $sent=[];$logs=[];$p=['context'=>['container_id'=>71],'skip'=>400,'take'=>200,'page'=>3,'pageSize'=>200,'filter'=>['field'=>'documento','operator'=>'contains','value'=>'Z'],'sort'=>[['field'=>'documento','dir'=>'desc']]];
  $r=self::row();$r['documento']='Z';$result=$this->call($this->service(['success'=>true,'data'=>[$r],'total'=>401],$sent,$logs),'read',$p);
  self::assertSame(401,$result['total']);self::assertCount(1,$result['data']);self::assertSame('Z',$result['data'][0]['documento']);self::assertSame(['operation'=>'read','resource'=>'nfs-disponiveis','skip'=>400,'take'=>200,'filter'=>$p['filter'],'sort'=>$p['sort'],'container_id'=>71],$sent[0]['body']);
 }
 public function testPaginationInvalidTakeNeverReachesTransport():void{
  $sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>[],'total'=>0],$sent,$logs),'read',['context'=>['container_id'=>71],'take'=>201]);self::fail('Unbounded page accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}self::assertSame([],$sent);self::assertSame([],$logs);
 }
 public function testGetRejectsCrossKeyCrossOwnerAndExtraRawBeforeMapper():void{
  foreach(['nf_key'=>'nf_'.str_repeat('B',64),'container_id'=>72,'documento_localizado'=>false]as$k=>$v){$r=self::row();$r[$k]=$v;$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>$r],$sent,$logs),'get',self::payload());self::fail('IDOR accepted');}catch(RuntimeHttpException $e){self::assertSame(502,$e->getStatusCode());}self::assertSame([],$logs);}
 }
 public function testBadContextAliasesAndUnsupportedFieldsNeverReachTransport():void{
  $base=self::payload();$cases=[['id'=>$base['id']],['id'=>$base['id'],'context'=>['container_id'=>71,'supplier'=>51]],$base+['nf_key'=>'nf_'.str_repeat('B',64)],$base+['NF_KEY'=>$base['id']],$base+['record'=>['nf_key'=>'nf_'.str_repeat('B',64)]],$base+['record'=>['container_id'=>72]],$base+['actor'=>'forged'],$base+['database'=>'ems2ima'],['id'=>strtolower($base['id']),'context'=>['container_id'=>71]],['id'=>1,'context'=>['container_id'=>71]]];
  foreach($cases as$p){$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),'get',$p);self::fail('Invalid request accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}self::assertSame([],$sent);}
  foreach([['context'=>['container_id'=>0]],['context'=>['container_id'=>71],'id'=>$base['id']],['context'=>['container_id'=>71],'take'=>0],['context'=>['container_id'=>71],'filter'=>['field'=>'container_id','operator'=>'neq','value'=>71]]]as$p){$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>[]],$sent,$logs),'read',$p);self::fail('Invalid list accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}self::assertSame([],$sent);}
 }
 public function testWrongBindingMethodResourceContextAndDestinationNeverReachTransport():void{
  $cases=[];foreach(['method'=>'GET','requestContextFields'=>[],'url'=>'http://127.0.0.1:19910/ima/web/SursumPrograms/containers-financeiro','bodyTemplate'=>['operation'=>'read','resource'=>'nfs']]as$k=>$v){$ep=self::endpoint('read');$ep[$k]=$v;$cases[]=self::entity($ep);}$cases[]=self::entity(source:'other');
  foreach($cases as$e){$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>[]],$sent,$logs,$e),'read',['context'=>['container_id'=>71]]);self::fail('Invalid binding accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}self::assertSame([],$sent);}
 }
 public function testAllWritersOptionsProcessesAndDownloadFailClosed():void{
  foreach(['create','update','delete','batch','process','download','options']as$op){$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),$op,self::payload());self::fail('Writer accepted');}catch(RuntimeHttpException $e){self::assertSame(405,$e->getStatusCode());}self::assertSame([],$sent);}
 }
 public function testExistingLinkedNfProfileRemainsUnchangedAndContextual():void{
  $r=self::row();$r['estab']='101';$r['documento_localizado']=false;$ep=self::endpoint('read');$ep['bodyTemplate']['resource']='nfs';$entity=self::entity($ep,code:'container_nfs_progress');$sent=[];$logs=[];$result=$this->call($this->service(['success'=>true,'data'=>[$r]],$sent,$logs,$entity),'read',['context'=>['container_id'=>71]],'container_nfs_progress');self::assertSame('101',$result['data'][0]['estab']);self::assertFalse($result['data'][0]['documento_localizado']);self::assertSame('nfs',$sent[0]['body']['resource']);$sent=[];$logs=[];$get=$this->call($this->service(['success'=>true,'data'=>$r],$sent,$logs,$entity),'get',self::payload(),'container_nfs_progress');self::assertSame($result['data'][0],$get);self::assertSame('nfs',$sent[0]['body']['resource']);
 }
 public function testRawPageScopeShapeTypesAndDuplicateKeysFailBeforeMapperAndLog():void{
  foreach(['container_id'=>72,'estab'=>'101','documento_localizado'=>false,'nf_key'=>'nf_'.str_repeat('a',64),'nat_operacao'=>'1101','cod_emitente'=>'51','especie'=>1.5,'dt_emissao'=>'bad','valor_frete'=>'1.23']as$k=>$v){$r=self::row();$r[$k]=$v;$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>[$r],'total'=>1],$sent,$logs),'read',['context'=>['container_id'=>71]]);self::fail('Invalid raw page accepted: '.$k);}catch(RuntimeHttpException $e){self::assertSame(502,$e->getStatusCode());}self::assertSame([],$logs);}
  $r=self::row();$bad=[['success'=>true,'data'=>[$r,$r],'total'=>2],['success'=>true,'data'=>[$r+['hidden'=>1]],'total'=>1]];$r2=$r;unset($r2['serie']);$bad[]=['success'=>true,'data'=>[$r2],'total'=>1];foreach($bad as$b){$sent=[];$logs=[];try{$this->call($this->service($b,$sent,$logs),'read',['context'=>['container_id'=>71]]);self::fail('Malformed raw page accepted');}catch(RuntimeHttpException $e){self::assertSame(502,$e->getStatusCode());}self::assertSame([],$logs);}
 }
 public function testInconsistentTotalEnvelopeAndMissingPageFailClosed():void{
  $r=self::row();$bad=[['success'=>true,'data'=>[$r]],['success'=>true,'data'=>[$r],'total'=>'1'],['success'=>true,'data'=>[$r],'total'=>-1],['success'=>true,'data'=>[$r],'total'=>50001],['success'=>true,'data'=>[$r],'total'=>2],['success'=>true,'data'=>[$r],'total'=>1,'committed'=>true],['success'=>false,'data'=>[$r],'total'=>1],['success'=>true,'data'=>[],'total'=>1]];
  foreach($bad as$b){$sent=[];$logs=[];try{$this->call($this->service($b,$sent,$logs),'read',['context'=>['container_id'=>71]]);self::fail('Inconsistent envelope accepted');}catch(RuntimeHttpException $e){self::assertSame(502,$e->getStatusCode());}self::assertSame([],$logs);}
  $sent=[];$logs=[];$got=$this->call($this->service(['success'=>true,'data'=>[],'total'=>401],$sent,$logs),'read',['context'=>['container_id'=>71],'skip'=>600,'take'=>200]);self::assertSame(['data'=>[],'total'=>401],$got);
 }
 public function testClosedSharedQueryRejectsInvalidTypesUnknownsAndNoExportCoercion():void{
  $cases=[['take'=>1000],['take'=>'50'],['skip'=>-1],['skip'=>100001],['take'=>200,'pageSize'=>50],['take'=>20,'page'=>2,'skip'=>0],['sort'=>[['field'=>'nf_original_json','dir'=>'asc']]],['sort'=>[['field'=>'documento','dir'=>'ASC']]],['filter'=>['field'=>'nf_original_json','operator'=>'contains','value'=>'x']],['filter'=>['field'=>'documento','operator'=>'sql','value'=>'x']],['database'=>'ems2ima'],['group'=>[['field'=>'documento']]]];
  foreach($cases as$x){$sent=[];$logs=[];try{$this->call($this->service(['success'=>true,'data'=>[],'total'=>0],$sent,$logs),'read',['context'=>['container_id'=>71]]+$x);self::fail('Unclosed query accepted');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}self::assertSame([],$sent);}
 }
 public function testHeadersRemainMemoryOnlyAndGetBytesRemainUnchanged():void{
  $sent=[];$logs=[];$p=self::payload()+['nf_key'=>self::row()['nf_key']];$got=$this->call($this->service(['success'=>true,'data'=>self::row()],$sent,$logs),'get',$p);self::assertSame(self::row()['nf_key'],$got['nf_key']);self::assertSame(['operation'=>'get','resource'=>'nfs-disponiveis','id'=>self::row()['nf_key'],'nf_key'=>self::row()['nf_key'],'container_id'=>71],$sent[0]['body']);self::assertSame('in-memory-test-only',$sent[0]['headers']['X-Containers-Token']);self::assertStringNotContainsString('in-memory-test-only',json_encode($got));self::assertStringNotContainsString('in-memory-test-only',json_encode($logs));
 }
 public function testActualTwoAblPagesUseTheRealRuntimeReadPath():void{
  foreach([0=>'first',30=>'second']as$skip=>$part){$path='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/local/nf-page-native-'.$part.'.json';self::assertFileExists($path);$body=json_decode(file_get_contents($path),true,512,JSON_THROW_ON_ERROR);$sent=[];$logs=[];$got=$this->call($this->service($body,$sent,$logs),'read',['context'=>['container_id'=>71],'skip'=>$skip,'take'=>30]);self::assertSame(1001,$got['total']);self::assertCount(30,$got['data']);self::assertSame($body['data'][0]['nf_key'],$got['data'][0]['nf_key']);self::assertSame($skip,$sent[0]['body']['skip']);}
 }
 public function testRealNativePageFilterSortDtosPassActualRuntimeTransport():void{
  $state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1';self::assertFileExists($state.'/native-calls.json');$calls=json_decode(file_get_contents($state.'/native-calls.json'),true,512,JSON_THROW_ON_ERROR);$count=0;
  foreach($calls as$call){if($call['url']!=='/isolated-nf-read')continue;$p=$call['data'];$part=!empty($p['filter']['filters'])?'filtered':(($p['sort'][0]['dir']??null)==='desc'?'desc':(($p['skip']??0)===30?'second':'first'));$body=json_decode(file_get_contents($state.'/local/nf-page-native-'.$part.'.json'),true,512,JSON_THROW_ON_ERROR);$sent=[];$logs=[];$got=$this->call($this->service($body,$sent,$logs),'read',$p);self::assertSame($body['total'],$got['total']);self::assertSame($body['data'][0]['nf_key'],$got['data'][0]['nf_key']);self::assertCount(30,$got['data']);self::assertSame(71,$sent[0]['body']['container_id']);self::assertSame($p['skip'],$sent[0]['body']['skip']);self::assertSame(30,$sent[0]['body']['take']);$count++;}
  self::assertSame(5,$count);
 }
}
