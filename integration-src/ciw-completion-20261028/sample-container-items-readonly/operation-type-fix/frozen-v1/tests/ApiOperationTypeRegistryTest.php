<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use PHPUnit\Framework\TestCase;
final class ApiOperationTypeRegistryTest extends TestCase
{
 private function normalize(array $operations):array {$r=new \ReflectionClass(ProgramBuilderService::class);return $r->getMethod('normalizeApiOperationsRegistry')->invoke($r->newInstanceWithoutConstructor(),$operations,'http://127.0.0.1:19910/med/web');}
 public function testSampleGetRemainsDetailWithSameReadGetBody():void {
  $source=json_decode(file_get_contents(dirname(__DIR__).'/metadata/api-source-additions.json'),true);$actual=$this->normalize($source['operations']);self::assertCount(2,$actual);self::assertSame('list',$actual[0]['type']);self::assertSame('detail',$actual[1]['type']);
  foreach($actual as $i=>$op){self::assertSame($source['operations'][$i]['bodyTemplate'],$op['bodyTemplate']);self::assertSame('POST',$op['method']);self::assertSame([],$op['requestContextFields']);self::assertSame('http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros',$op['path']);}
  self::assertSame('get',$actual[1]['bodyTemplate']['operation']);self::assertSame('item_container_amostra_get',$actual[1]['code']);
 }
 public function testUncorrectedGetTypeSilentlyNormalizesToCustom():void {
  $source=json_decode(file_get_contents(dirname(__DIR__).'/baseline-exact/api-source-additions.json'),true);self::assertSame('get',$source['operations'][1]['type']);$actual=$this->normalize($source['operations']);self::assertSame('custom',$actual[1]['type']);self::assertSame('get',$actual[1]['bodyTemplate']['operation']);
 }
 public function testSelectionOptionsAndProcessTypesRemainClosedAndPreserved():void {
  $path='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2/metadata/source-addition.json';$ops=array_column(json_decode(file_get_contents($path),true)['operations'],'value');$actual=$this->normalize($ops);self::assertSame(['list','custom'],array_column($actual,'type'));self::assertSame(['options','selecionar_despesas'],array_column(array_column($actual,'bodyTemplate'),'operation'));self::assertTrue($actual[1]['allowProcess']);foreach($actual as $i=>$op){self::assertSame($ops[$i]['bodyTemplate'],$op['bodyTemplate']);self::assertSame(['container_id'],$op['requestContextFields']);}
 }
}
