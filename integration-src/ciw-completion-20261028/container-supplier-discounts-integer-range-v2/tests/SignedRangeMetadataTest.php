<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderApiSource,BuilderModule};
use App\Repository\{BuilderApiSourceRepository,BuilderModuleRepository};
use App\Runtime\{PermissionResolver,RuntimeHttpException};
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class SignedRangeMetadataTest extends TestCase {
 private const BASE='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/';
 private static function json(string $file):array{return json_decode(file_get_contents($file),true,512,JSON_THROW_ON_ERROR);}
 private function builder():ProgramBuilderService {
  $r=new \ReflectionClass(ProgramBuilderService::class);$empty=$r->newInstanceWithoutConstructor();$current=self::json('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-action-native/current/source-motor_progress_ciw_cadastros.json')['apiSource'];
  $ops=$current['operations'];foreach(self::json(self::BASE.'supplier-discounts-readonly/frozen-v1/metadata/api-source-additions.json')['operations']as$op){self::assertNotContains($op['code'],array_column($ops,'code'));$ops[]=$op;}
  $ops=$r->getMethod('normalizeApiOperationsRegistry')->invoke($empty,$ops,$current['baseUrl']);self::assertCount(count($current['operations'])+2,$ops);self::assertSame(['list','detail'],array_column(array_slice($ops,-2),'type'));
  $source=(new BuilderApiSource())->setCode($current['code'])->setName($current['name'])->setBaseUrl($current['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);$sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em];$args=[];foreach($r->getConstructor()->getParameters()as$p){$type=$p->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}return$r->newInstanceArgs($args);
 }
 private static function draft():array{return self::json(self::BASE.'supplier-discounts-readonly/frozen-v1/metadata/supplier-builder-draft.json');}
 public function testRealEntityNormalizationAndExternalDraftAddOnlyClosedRange():void {
  $b=$this->builder();$draft=self::draft();$entity=(new \ReflectionMethod($b,'normalizeEntityPayload'))->invoke($b,$draft['entityDraft']);self::assertSame('api',$entity['entityType']);$before=$b->validateExternalDraft($draft);$draft['programDraft']['contextFields'][0]['integerRange']=['min'=>-2147483648,'max'=>2147483647];$after=$b->validateExternalDraft($draft);self::assertTrue($after['readyToApply']);$def=$after['generatedDefinition'];self::assertSame(['min'=>-2147483648,'max'=>2147483647],$def['contextFields'][0]['integerRange']);$without=$def;unset($without['contextFields'][0]['integerRange']);self::assertSame($before['generatedDefinition'],$without);self::assertSame($before['entityDraft'],$after['entityDraft']);self::assertCount(22,$def['dataModel']['fields']);self::assertSame('record_key',$def['dataModel']['primaryKey']);self::assertSame('text',$def['dataModel']['fields']['arquivo']['type']);foreach(['create','edit','delete']as$key)self::assertFalse($def['permissions'][$key]);self::assertSame($def,$b->validateExternalDraft($after['normalizedDraft'])['generatedDefinition']);
  $out=(getenv('RANGE_RECEIPTS')?:'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2').'/generated';if(!is_dir($out))mkdir($out,0777,true);foreach(['before'=>$before['generatedDefinition'],'candidate'=>$def,'external-test-input'=>$draft]as$key=>$value)file_put_contents($out.'/op1056-'.$key.'.json',json_encode($value,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
 }
 public function testRealExternalWriterAndProcessDraftsCannotUseSignedProfile():void {
  $b=$this->builder();foreach(['allowCreate','allowUpdate','allowDelete','pageType']as$key){$draft=self::draft();$draft['programDraft']['contextFields'][0]['integerRange']=['min'=>-2147483648,'max'=>2147483647];$draft['programDraft'][$key]=match($key){'pageType'=>'process','screenId'=>'other','programCode'=>'op1057',default=>true};try{$b->validateExternalDraft($draft);self::fail('Wrong profile accepted '.$key);}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());}}
 }
}
