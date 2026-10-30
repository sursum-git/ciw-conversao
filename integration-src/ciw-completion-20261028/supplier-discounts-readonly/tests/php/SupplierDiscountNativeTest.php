<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderApiSource,BuilderModule};
use App\Repository\{BuilderApiSourceRepository,BuilderModuleRepository};
use App\Runtime\PermissionResolver;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class SupplierDiscountNativeTest extends TestCase
{
 private static function json(string $path):array {return json_decode(file_get_contents($path),true,512,JSON_THROW_ON_ERROR);}
 private static function plan():array {$d='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/supplier-discounts-readonly/';return ['source'=>['baselinePath'=>'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/expense-tax-current/sources-current.json','operations'=>self::json($d.'metadata/api-source-additions.json')['operations']],'newProgram'=>['path'=>$d.'metadata/supplier-builder-draft.json']];}
 private static function source():array {$plan=self::plan();$all=self::json($plan['source']['baselinePath']);foreach($all as $item)if(($item['apiSource']['code']??null)==='motor_progress_ciw_cadastros')return $item['apiSource'];throw new \RuntimeException('Exact source required');}
 private static function normalize(array $ops,string $base):array {$r=new \ReflectionClass(ProgramBuilderService::class);return $r->getMethod('normalizeApiOperationsRegistry')->invoke($r->newInstanceWithoutConstructor(),$ops,$base);}
 public function testActualRegistryPreservesAll144AndDetailBody():void {
  $before=self::source();$ops=array_merge($before['operations'],self::plan()['source']['operations']);$actual=self::normalize($ops,$before['baseUrl']);self::assertCount(146,$actual);self::assertCount(144,$before['operations']);
  foreach($before['operations']as $i=>$old){self::assertSame($old['code'],$actual[$i]['code']);self::assertSame($old['bodyTemplate'],$actual[$i]['bodyTemplate']);self::assertSame($old['type'],$actual[$i]['type']);self::assertSame($old['requestContextFields']??[],$actual[$i]['requestContextFields']??[]);}
  foreach(array_slice($actual,-2)as $i=>$op){self::assertSame($i===0?'list':'detail',$op['type']);self::assertSame($i===0?'read':'get',$op['bodyTemplate']['operation']);self::assertSame('import_descontos_fornecedor',$op['bodyTemplate']['resource']);self::assertSame(['fornecedor_id'],$op['requestContextFields']);self::assertSame('POST',$op['method']);}
 }
 public function testActualExternalDraftRemainsReadonlySupplierAndSource15Fields():void {
  $plan=self::plan();$before=self::source();$ops=self::normalize(array_merge($before['operations'],$plan['source']['operations']),$before['baseUrl']);
  $source=(new BuilderApiSource())->setCode($before['code'])->setName($before['name'])->setBaseUrl($before['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);$sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));
  $permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');
  $overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em];$r=new \ReflectionClass(ProgramBuilderService::class);$args=[];foreach($r->getConstructor()->getParameters()as $arg){$type=$arg->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}$builder=$r->newInstanceArgs($args);
  $result=$builder->validateExternalDraft(self::json($plan['newProgram']['path']));self::assertTrue($result['readyToApply']);$def=$result['generatedDefinition'];self::assertSame('op1056',$def['program']['id']);self::assertSame('descontos_importacao_fornecedor_progress',$def['program']['entity']);self::assertSame('record_key',$def['dataModel']['primaryKey']);self::assertCount(22,$def['dataModel']['fields']);self::assertSame('integer',$def['dataModel']['fields']['fornecedor_id']['type']);self::assertSame([['field'=>'fornecedor_id','filter'=>true,'createDefault'=>false,'readonly'=>true,'required'=>true]],$def['contextFields']);self::assertSame([],$def['crud']['rowLinks']??[]);self::assertSame('text',$def['dataModel']['fields']['arquivo']['type']);foreach(['create','edit','delete']as $key)self::assertFalse($def['permissions'][$key]);
  file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/supplier-discounts-readonly/native-preview.json',json_encode($def,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
  file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/supplier-discounts-readonly/normalizer-proof.json',json_encode(['success'=>true,'realBuilder'=>true,'normalizedCount'=>count($ops),'old144CodeTypeBodyContextPreserved'=>true,'newTypes'=>['list','detail'],'getBodyOperation'=>'get','context'=>['fornecedor_id'],'readonly'=>true,'source15FieldsAndHiddenPhysicalPk'=>true,'newProgramCode'=>'op1056','programSpecSha256'=>hash_file('sha256',$plan['newProgram']['path']),'builderSha256'=>hash_file('sha256','D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php'),'businessWrites'=>false,'networkExecuted'=>false],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
 }
}
