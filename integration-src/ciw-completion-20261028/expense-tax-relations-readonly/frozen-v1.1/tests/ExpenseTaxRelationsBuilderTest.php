<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderApiSource,BuilderModule};
use App\Repository\{BuilderApiSourceRepository,BuilderModuleRepository};
use App\Runtime\PermissionResolver;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class ExpenseTaxRelationsBuilderTest extends TestCase {
 private static function json(string$file):array{return json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$file),true,512,JSON_THROW_ON_ERROR);}
 private function builder():ProgramBuilderService{
  $s=self::json('api-source-preview.json');$r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($b,$s['operations'],$s['baseUrl']);$source=(new BuilderApiSource())->setCode($s['code'])->setName($s['name'])->setBaseUrl($s['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);$sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);$modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em];$args=[];foreach($r->getConstructor()->getParameters()as$a){$type=$a->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}return$r->newInstanceArgs($args);
 }
 public function testActualNormalizeAndValidateExternalDraftProduceOnlyTwoColumnsAndNullablePhysicalKeyComponents():void{
  $draft=self::json('builder-draft.json');$b=$this->builder();$n=(new \ReflectionMethod($b,'normalizeEntityPayload'))->invoke($b,$draft['entityDraft']);self::assertCount(4,$n['fields']);self::assertSame('despesas_impostos_geral_get',$n['apiBinding']['detailOperationCode']);foreach(array_slice($n['fields'],0,3)as$f){self::assertFalse($f['required']);self::assertFalse($f['primaryKey']);}
  $result=$b->validateExternalDraft($draft);self::assertTrue($result['readyToApply']);$d=$result['generatedDefinition'];self::assertSame('crud',$d['pageType']);self::assertSame('record_key',$d['dataModel']['primaryKey']);self::assertCount(4,$d['dataModel']['fields']);self::assertSame([],$d['contextFields']);self::assertSame(['despesa_id','imposto_id'],array_column($d['crud']['grid']['columns'],'field'));foreach(['create','edit','delete']as$p)self::assertFalse($d['permissions'][$p]);foreach(['create','update','delete']as$o)self::assertArrayNotHasKey($o,$d['dataSource']['api']);$again=$b->validateExternalDraft($result['normalizedDraft']);self::assertSame($d,$again['generatedDefinition']);file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/expense-tax-relations-readonly/native-preview.json',json_encode($d,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
 }
 public function testRealOperationRegistryPreservesAll144PredecessorsAndUsesDetailForGet():void{
  $r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$s=self::json('api-source-preview.json');$ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($b,$s['operations'],$s['baseUrl']);self::assertCount(146,$ops);self::assertSame(['list','detail'],array_column(array_slice($ops,-2),'type'));foreach($s['operations']as$i=>$o){self::assertSame($o['code'],$ops[$i]['code']);self::assertSame($o['bodyTemplate'],$ops[$i]['bodyTemplate']);}self::assertSame([],end($ops)['requestContextFields']);
 }
}
