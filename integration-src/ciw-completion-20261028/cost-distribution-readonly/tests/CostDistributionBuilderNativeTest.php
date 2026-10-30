<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderModule,BuilderApiSource};
use App\Repository\{BuilderModuleRepository,BuilderApiSourceRepository};
use App\Runtime\PermissionResolver;
use PHPUnit\Framework\TestCase;
final class CostDistributionBuilderNativeTest extends TestCase
{
 public function testActualBuilderNormalizesReadonlyDraftAndGeneratesNativeDefinition():void {
  $draft=json_decode(file_get_contents(dirname(__DIR__).'/metadata/custo_distribuicao_itens_aptos-builder-draft.json'),true);
  $ops=json_decode(file_get_contents(dirname(__DIR__).'/metadata/api-source-additions.json'),true)['operations'];
  $source=(new BuilderApiSource())->setCode('motor_progress_ciw_cadastros')->setName('Fixed CIW test')->setBaseUrl('https://example.invalid')->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);
  $sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));
  $permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);
  $overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions];$r=new \ReflectionClass(ProgramBuilderService::class);$args=[];
  foreach($r->getConstructor()->getParameters() as $p){$type=$p->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}
  $result=$r->newInstanceArgs($args)->validateExternalDraft($draft);
  self::assertTrue($result['readyToApply']);self::assertSame('crud',$result['generatedDefinition']['pageType']);self::assertSame('record_key',$result['generatedDefinition']['dataModel']['primaryKey']);self::assertFalse($result['generatedDefinition']['permissions']['edit']);
  file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/cost-distribution-readonly/native-preview.json',json_encode($result['generatedDefinition'],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
 }
}
