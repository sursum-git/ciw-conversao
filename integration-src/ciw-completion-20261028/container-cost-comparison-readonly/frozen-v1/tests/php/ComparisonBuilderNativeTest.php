<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderModule,BuilderApiSource};
use App\Repository\{BuilderModuleRepository,BuilderApiSourceRepository};
use App\Runtime\PermissionResolver;
use PHPUnit\Framework\TestCase;
final class ComparisonBuilderNativeTest extends TestCase
{
 private static function domain():string {return dirname(__DIR__,2);}
 private function builder(array $ops):ProgramBuilderService {
  $source=(new BuilderApiSource())->setCode('motor_progress_ciw_cadastros')->setName('Fixed CIW local metadata')->setBaseUrl('http://127.0.0.1:19910/med/web')->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);
  $sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($source);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));
  $permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);
  $overrides=[BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions];$r=new \ReflectionClass(ProgramBuilderService::class);$args=[];
  foreach($r->getConstructor()->getParameters() as $p){$type=$p->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}
  return $r->newInstanceArgs($args);
 }
 public function testActualRegistryKeepsAllFourListAndDetailOperationsAndBody():void {
  $ops=json_decode(file_get_contents(self::domain().'/metadata/api-source-additions.json'),true)['operations'];$r=new \ReflectionClass(ProgramBuilderService::class);
  $actual=$r->getMethod('normalizeApiOperationsRegistry')->invoke($r->newInstanceWithoutConstructor(),$ops,'http://127.0.0.1:19910/med/web');
  self::assertSame(['list','detail','list','detail'],array_column($actual,'type'));
  foreach($ops as $i=>$op){self::assertSame($op['bodyTemplate'],$actual[$i]['bodyTemplate']);self::assertSame(['container_id','versao_id'],$actual[$i]['requestContextFields']);self::assertSame('POST',$actual[$i]['method']);}
 }
 public function testBothRealNativeDraftsKeepReadonlyFourteenColumnsAndContext():void {
  $ops=json_decode(file_get_contents(self::domain().'/metadata/api-source-additions.json'),true)['operations'];$builder=$this->builder($ops);
  foreach(['real','dolar'] as $currency){$draft=json_decode(file_get_contents(self::domain().'/metadata/container_custos_comparacao_'.$currency.'-builder-draft.json'),true);$result=$builder->validateExternalDraft($draft);$def=$result['generatedDefinition'];
   self::assertTrue($result['readyToApply']);self::assertSame('crud',$def['pageType']);self::assertSame('record_key',$def['dataModel']['primaryKey']);self::assertFalse($def['permissions']['edit']);self::assertFalse($def['permissions']['create']);self::assertFalse($def['permissions']['delete']);
   self::assertCount(14,$def['crud']['grid']['columns']);self::assertSame(['codigo_erp','descricao','qt_alocada','qt_confirm_emb','vl_custo_prev','vl_desp_prev','vl_tot_prev','vl_unit_prev','vl_desp_prev_sem_distr_custo','vl_tot_sem_distr_custo','vl_unit_sem_distr_custo','vl_desp_prev_perc_fixo','vl_tot_perc_fixo','vl_unit_perc_fixo'],array_column($def['crud']['grid']['columns'],'field'));
   self::assertSame('n2',$def['dataModel']['fields']['vl_unit_prev']['format']);self::assertSame('n2',$def['dataModel']['fields']['qt_alocada']['format']);
   file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-cost-comparison-readonly/native-'.$currency.'.json',json_encode($def,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
  }
 }
}
