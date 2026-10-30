<?php
namespace App\Tests\Runtime;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeHttpException};
use PHPUnit\Framework\TestCase;
final class RuntimeItemCostManualReadTest extends TestCase {
 private function body():array{return json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/item-cost-manual/local/manual-read-actual.json'),true,512,JSON_THROW_ON_ERROR);}
 private function invoke(string$op,array$body,array&$sent,array&$logs,array$payload=[],array$override=[]):array{
  $r=new \ReflectionClass(RuntimeApiEntityActionService::class);$s=$r->newInstanceWithoutConstructor();
  $client=$this->createStub(RuntimeExternalJsonClient::class);$client->method('request')->willReturnCallback(static function($url,$method,$headers,$data)use(&$sent,$body){$sent[]=$data;return['status'=>200,'body'=>$body];});$r->getProperty('externalJsonClient')->setValue($s,$client);
  $tx=$this->createStub(RuntimeTransactionService::class);$tx->method('log')->willReturnCallback(static function($event,$message=null,$before=[],$after=[],$metadata=[])use(&$logs){$logs[]=[$event,$before,$after,$metadata];});$r->getProperty('transactions')->setValue($s,$tx);
  $fields=[];foreach(require dirname(__DIR__).'/php/RuntimeItemCostManualSchema.php'as$name=>$type)$fields[$name]=['code'=>$name,'dataType'=>match($type['type']){'id','integer'=>'integer','decimal'=>'decimal','date'=>'date','datetime'=>'datetime',default=>'string'},'jsonPath'=>$name,'collection'=>false];
  $endpoint=['url'=>'https://192.168.0.111:9911/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','requestContextFields'=>[],'bodyTemplate'=>['resource'=>'item_custos_manual','operation'=>$op]];
  $d=['entityCode'=>'item_custos_manual_progress','primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$endpoint,'detailEndpoint'=>$endpoint,'detailResponse'=>['itemPath'=>'data']]];
  $d=array_replace_recursive($d,$override);
  return$r->getMethod($op==='read'?'readCiwErpPage':'get')->invoke($s,$d,$payload);
 }
 public function testActualCentralReadAndGetPreserveAllRawPhysicalFields():void{
  $body=$this->body();$sent=[];$logs=[];$r=$this->invoke('read',$body,$sent,$logs);self::assertCount(2,$r['data']);self::assertSame(2,$r['total']);self::assertNull($r['data'][0]['qt_estoque']);self::assertSame('  <raw>  ',$r['data'][0]['memoria_calculo']);self::assertSame('2026-10-28T12:34:56.789',$r['data'][0]['dt_hr_custo']);self::assertCount(24,$r['data'][0]);self::assertSame([['resource'=>'item_custos_manual','operation'=>'read','skip'=>0,'take'=>50]],$sent);self::assertCount(1,$logs);self::assertSame([],$logs[0][1]);self::assertSame([],$logs[0][2]);
  $row=$body['data'][0];$sent=[];$logs=[];$get=$this->invoke('get',['success'=>true,'data'=>$row],$sent,$logs,['id'=>$row['record_key'],'record_key'=>$row['record_key']]);self::assertSame($r['data'][0],$get);self::assertSame(['resource'=>'item_custos_manual','operation'=>'get','id'=>$row['record_key'],'record_key'=>$row['record_key']],$sent[0]);self::assertSame('item_custos_manual_progress.api.get',$logs[0][0]);
 }
 public function testCrossTypePartialOrForgedReadProofNeverReachesMapperOrSuccessLog():void{
  foreach(['type','missing','field','key','id','duplicate','total','audit']as$case){$b=$this->body();if($case==='type')$b['data'][0]['cod_tipo_custo']=2;elseif($case==='missing')unset($b['data'][0]['memoria_calculo']);elseif($case==='field')$b['data'][0]['company_id']=2;elseif($case==='key')$b['data'][0]['record_key']='{"item_custo_id":5}';elseif($case==='id')$b['data'][0]['item_custo_id']='1';elseif($case==='duplicate')$b['data'][1]=$b['data'][0];elseif($case==='total')$b['total']=50001;else$b['audit']=['source'=>'fake'];$sent=[];$logs=[];try{$this->invoke('read',$b,$sent,$logs);self::fail($case);}catch(RuntimeHttpException$e){self::assertSame(502,$e->getStatusCode());}self::assertSame([],$logs,$case);}
 }
 public function testGetRequiresFixedBindingAndUnambiguousCanonicalAliasesBeforeTransport():void{
  $body=$this->body();$row=$body['data'][0];foreach(['alias','numeric','extra','missing','context','binding']as$case){$payload=['id'=>$row['record_key']];$override=[];if($case==='alias')$payload['record_key']='{"item_custo_id":5}';elseif($case==='numeric')$payload['id']=1;elseif($case==='extra')$payload['id']='{"item_custo_id":1,"other":2}';elseif($case==='missing')$payload=[];elseif($case==='context')$payload['context']=['container_id'=>123];else$override=['apiSource'=>['detailEndpoint'=>['bodyTemplate'=>['resource'=>'other']]]];$sent=[];$logs=[];try{$this->invoke('get',['success'=>true,'data'=>$row],$sent,$logs,$payload,$override);self::fail($case);}catch(RuntimeHttpException$e){self::assertSame(422,$e->getStatusCode(),$case);}self::assertSame([],$sent,$case);self::assertSame([],$logs,$case);}
 }
 public function testGetRejectsOtherKeyAndNonManualBodyAfterTransport():void{
  $row=$this->body()['data'][0];foreach(['key','type','partial','success']as$case){$b=['success'=>true,'data'=>$row];if($case==='key'){$b['data']['item_custo_id']=5;$b['data']['record_key']='{"item_custo_id":5}';}elseif($case==='type')$b['data']['cod_tipo_custo']=3;elseif($case==='partial')unset($b['data']['caminho_arquivo']);else$b['success']=false;$sent=[];$logs=[];try{$this->invoke('get',$b,$sent,$logs,['id'=>$row['record_key']]);self::fail($case);}catch(RuntimeHttpException$e){self::assertSame(502,$e->getStatusCode());}self::assertCount(1,$sent);self::assertSame([],$logs);}
 }
}
