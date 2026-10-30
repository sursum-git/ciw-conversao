<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderApiSource,BuilderModule};
use App\Repository\{BuilderApiSourceRepository,BuilderModuleRepository};
use App\Runtime\PermissionResolver;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class ContainerNfAvailablePageBuilderTest extends TestCase
{
 private static function json(string $file):array{return json_decode(file_get_contents(dirname(__DIR__).'/metadata/'.$file),true,512,JSON_THROW_ON_ERROR);}
 private function builder():ProgramBuilderService{
  $s=self::json('api-source-preview.json');$r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($b,$s['operations'],$s['baseUrl']);
  $source=(new BuilderApiSource())->setCode($s['code'])->setName($s['name'])->setBaseUrl($s['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);$sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);$modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em];$args=[];foreach($r->getConstructor()->getParameters()as$a){$type=$a->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}return$r->newInstanceArgs($args);
 }
 public function testNormalizeEntityPayloadAndValidateExternalDraftRealGenerateReadonly18():void{
  $draft=self::json('builder-draft.json');$b=$this->builder();$normalized=(new \ReflectionMethod($b,'normalizeEntityPayload'))->invoke($b,$draft['entityDraft']);self::assertCount(18,$normalized['fields']);self::assertSame('api',$normalized['entityType']);self::assertSame('nfs_disponiveis_get',$normalized['apiBinding']['detailOperationCode']??null);
  $result=$b->validateExternalDraft($draft);self::assertTrue($result['readyToApply']);$def=$result['generatedDefinition'];self::assertSame('crud',$def['pageType']);self::assertCount(18,$def['dataModel']['fields']);self::assertSame('nf_key',$def['dataModel']['primaryKey']);self::assertSame(false,$def['crud']['grid']['print']['enabled']);self::assertSame([],$def['crud']['grid']['print']['options']);self::assertSame([['field'=>'documento','dir'=>'asc'],['field'=>'serie','dir'=>'asc'],['field'=>'nat_operacao','dir'=>'asc']],$def['crud']['query']['defaultSort']);foreach(['create','edit','delete']as$p)self::assertFalse($def['permissions'][$p]);self::assertSame([['field'=>'container_id','filter'=>true,'createDefault'=>false,'readonly'=>true,'required'=>true]],$def['contextFields']);self::assertArrayNotHasKey('create',$def['dataSource']['api']);self::assertArrayNotHasKey('update',$def['dataSource']['api']);self::assertArrayNotHasKey('delete',$def['dataSource']['api']);
  $again=$b->validateExternalDraft($result['normalizedDraft']);self::assertSame($def,$again['generatedDefinition']);file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/native-preview.json',json_encode($def,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
 }
 public function testActualNormalizerPreservesOriginalFourAndBothAdditionTypesAndFixedBodies():void{
  $r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$s=self::json('api-source-preview.json');$ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($b,$s['operations'],$s['baseUrl']);self::assertCount(6,$ops);self::assertSame('total',$ops[4]['totalPath']);self::assertSame(['list','detail','list','detail','list','detail'],array_column($ops,'type'));foreach($ops as$i=>$op){self::assertSame($s['operations'][$i]['bodyTemplate'],$op['bodyTemplate']);self::assertSame(['container_id'],$op['requestContextFields']);}self::assertSame(['pagamentos_read','pagamentos_get','nfs_read','nfs_get'],array_column(array_slice($ops,0,4),'code'));
 }
}
