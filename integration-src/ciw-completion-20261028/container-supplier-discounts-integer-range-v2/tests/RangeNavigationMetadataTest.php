<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderApiSource,BuilderModule};
use App\Repository\{BuilderApiSourceRepository,BuilderModuleRepository};
use App\Runtime\PermissionResolver;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class RangeNavigationMetadataTest extends TestCase {
 private static function json(string $file):array{return json_decode(file_get_contents($file),true,512,JSON_THROW_ON_ERROR);}
 private function builder():ProgramBuilderService{
  $dir='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-action-native/current';$r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$sources=[];
  foreach(glob($dir.'/source-*.json')as$file){$s=self::json($file)['apiSource'];$ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($b,$s['operations'],$s['baseUrl']);$sources[$s['code']]=(new BuilderApiSource())->setCode($s['code'])->setName($s['name'])->setBaseUrl($s['baseUrl'])->setMetadata(['responseContract'=>$s['responseContract'],'operations'=>$ops]);}
  $repo=$this->createStub(BuilderApiSourceRepository::class);$repo->method('findOneBy')->willReturnCallback(fn($criteria)=>$sources[$criteria['code']??'']??null);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$overrides=[BuilderApiSourceRepository::class=>$repo,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em];$args=[];foreach($r->getConstructor()->getParameters()as$a){$type=$a->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}return$r->newInstanceArgs($args);
 }
 public function testThreeActualDraftsNormalizeValidateAndPreserveEntitiesPermissionsAndOldLinks():void{
  $b=$this->builder();$root=dirname(__DIR__);$out=(getenv('NAV_RECEIPTS')?:'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2').'/generated';if(!is_dir($out))mkdir($out,0777,true);
  foreach(['op1008','op1002','op1014']as$code){$before=self::json($root.'/metadata/before/'.$code.'-external-test-input.json');$after=self::json($root.'/metadata/candidate/'.$code.'-external-test-input.json');self::assertSame($before['entityDraft'],$after['entityDraft']);$normalized=(new \ReflectionMethod($b,'normalizeEntityPayload'))->invoke($b,$after['entityDraft']);self::assertSame('api',$normalized['entityType']);
   $old=$b->validateExternalDraft($before);$new=$b->validateExternalDraft($after);self::assertTrue($new['readyToApply']);$def=$new['generatedDefinition'];self::assertSame($old['generatedDefinition']['permissions'],$def['permissions']);self::assertSame($old['generatedDefinition']['dataSource'],$def['dataSource']);self::assertSame($old['generatedDefinition']['dataModel'],$def['dataModel']);self::assertSame($old['generatedDefinition']['crud']['form'],$def['crud']['form']);self::assertSame($old['entityDraft'],$new['entityDraft']);
   $count=count($before['programDraft']['rowLinks']);self::assertSame($before['programDraft']['rowLinks'],array_slice($def['crud']['grid']['rowLinks'],0,$count));
   if($code!=='op1008'){$context=array_values(array_filter($def['contextFields'],fn($c)=>($c['filterOnly']??false)===true));self::assertCount(1,$context);self::assertFalse($context[0]['required']);self::assertFalse($context[0]['createDefault']);self::assertTrue($context[0]['readonly']);self::assertTrue($context[0]['filter']);}
   $again=$b->validateExternalDraft($new['normalizedDraft']);self::assertSame($def,$again['generatedDefinition']);
   foreach(['before'=>$old['generatedDefinition'],'candidate'=>$def]as$name=>$value)file_put_contents($out.'/'.$code.'-'.$name.'.json',json_encode($value,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
  }
 }
 public function testNoFlagCurrentDraftsAreIdenticalAcrossCanonical205AndNewCandidate():void{
  $root=dirname(__DIR__);$dir='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-navigation-filter-only/baseline205';self::assertDirectoryExists($dir);$b=$this->builder();
  foreach(['op1008','op1002','op1014']as$code){$definition=$b->validateExternalDraft(self::json($root.'/metadata/before/'.$code.'-external-test-input.json'))['generatedDefinition'];$file=$dir.'/'.$code.'.json';$serialized=json_encode($definition,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR);self::assertSame(file_get_contents($file),$serialized);}
 }
}
