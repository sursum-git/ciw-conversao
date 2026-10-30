<?php
namespace App\Tests\Runtime;
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService};
use PHPUnit\Framework\TestCase;
final class RuntimeContainerVersionLabelsIntegrationTest extends TestCase
{
 private function cases():array {
  $root=dirname(__DIR__,2);$out=[];
  foreach(json_decode(file_get_contents(dirname(__DIR__).'/metadata/field-additions.json'),true)['additions']as $a){
   $main=$a['field']['code']==='item_descricao_atual';$resource=$main?'container_versoes_historico_med':substr($a['entity'],0,-9);
   $base=json_decode(file_get_contents($root.'/'.($main?'frozen-v1.4/metadata/history-builder-draft.json':'frozen-aux-v1.1/metadata/'.$resource.'-builder-draft.json')),true);
   $fields=[];$row=[];foreach([...$base['entityDraft']['fields'],$a['field']]as $f){$c=$f['code'];$fields[$c]=['code'=>$c,'dataType'=>$f['dataType'],'jsonPath'=>$c,'collection'=>false];$row[$c]=$f['dataType']==='integer'?7:($f['dataType']==='decimal'?null:'RAW');}
   $row['container_id']=123;$row['versao_id']=1001;$keyFields=$main?'container_id,versao_id,item_container_custo_id':($a['field']['code']==='emitente_nome_abrev_atual'?'container_id,versao_id,documento,serie,estab,nat_operacao,cod_emitente':'container_id,versao_id,despesa_id');$key=[];foreach(explode(',',$keyFields)as $c)$key[$c]=$row[$c];$row['record_key']=json_encode($key);
   $e=['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','headers'=>[],'queryParams'=>[],'bodyTemplate'=>['operation'=>'read','resource'=>$resource],'requestContextFields'=>['container_id','versao_id']];$g=$e;$g['bodyTemplate']['operation']='get';
   $d=['entityCode'=>$a['entity'],'primaryKey'=>'record_key','fields'=>$fields,'apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'listEndpoint'=>$e,'detailEndpoint'=>$g,'detailResponse'=>['itemPath'=>'data']]];
   $out[]=[$d,$row,$a['field']['code']];
  }return $out;
 }
 private function invoke(string $method,array $d,array $row,array $payload,?array $expectedFilter=null):array {
  $client=$this->createMock(RuntimeExternalJsonClient::class);$client->expects(self::once())->method('request')->willReturnCallback(function($url,$verb,$headers,$sent)use($method,$row,$expectedFilter){self::assertSame(123,$sent['container_id']);self::assertSame(1001,$sent['versao_id']);if($expectedFilter!==null)self::assertSame($expectedFilter,$sent['filter']);return ['status'=>200,'body'=>['success'=>true,'data'=>$method==='get'?$row:[$row],'total'=>1]];});
  $service=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$this->createStub(RuntimeTransactionService::class),$client);return(new \ReflectionMethod($service,$method))->invoke($service,$d,$payload);
 }
 public function testCurrentLabelsReadGetAndFilteringKeepRawIdentity():void {
  foreach($this->cases()as[$d,$row,$field]){$row[$field]='Descrição atual ç';$filter=['field'=>$field,'operator'=>'eq','value'=>$row[$field]];$payload=['context'=>['container_id'=>123,'versao_id'=>1001],'take'=>1,'filter'=>$filter];$read=$this->invoke('readCiwErpPage',$d,$row,$payload,$filter);self::assertSame($row,$read['data'][0]);$get=$this->invoke('get',$d,$row,['context'=>$payload['context'],'id'=>$row['record_key'],'record_key'=>$row['record_key']]);self::assertSame($row,$get);}
 }
 public function testMissingCurrentLabelsRemainNullInReadAndGet():void {
  foreach($this->cases()as[$d,$row,$field]){$row[$field]=null;$context=['container_id'=>123,'versao_id'=>1001];$read=$this->invoke('readCiwErpPage',$d,$row,['context'=>$context,'take'=>1]);self::assertSame($row,$read['data'][0]);$get=$this->invoke('get',$d,$row,['context'=>$context,'id'=>$row['record_key'],'record_key'=>$row['record_key']]);self::assertSame($row,$get);}
 }
}
