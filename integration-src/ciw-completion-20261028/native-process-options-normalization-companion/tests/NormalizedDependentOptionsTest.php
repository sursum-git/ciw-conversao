<?php
namespace Companion1047;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderModule,BuilderApiSource,BuilderEntity,BuilderProgramVersion};
use App\Repository\{BuilderModuleRepository,BuilderApiSourceRepository,BuilderEntityRepository,BuilderProgramVersionRepository};
use App\Runtime\{PermissionResolver,RuntimeHttpException};
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class NormalizedDependentOptionsTest extends TestCase
{
 private static function fixture():array{return json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2/metadata/selection-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);}
 private function builder(array $extra=[]):ProgramBuilderService{
  $source=json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2/metadata/api-source-preview.json'),true,512,JSON_THROW_ON_ERROR);$reflection=new \ReflectionClass(ProgramBuilderService::class);$uninitialized=$reflection->newInstanceWithoutConstructor();$ops=$reflection->getMethod('normalizeApiOperationsRegistry')->invoke($uninitialized,$source['operations'],$source['baseUrl']);
  $api=(new BuilderApiSource())->setCode($source['code'])->setName('Frozen readonly fixture')->setBaseUrl($source['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$ops]);
  $sources=$this->createStub(BuilderApiSourceRepository::class);$sources->method('findOneBy')->willReturn($api);
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);
  $em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');
  $overrides=array_replace([BuilderApiSourceRepository::class=>$sources,BuilderModuleRepository::class=>$modules,PermissionResolver::class=>$permissions,EntityManagerInterface::class=>$em],$extra);$args=[];foreach($reflection->getConstructor()->getParameters()as$arg){$type=$arg->getType()->getName();$args[]=$overrides[$type]??$this->createStub($type);}return $reflection->newInstanceArgs($args);
 }
 private function normalize(ProgramBuilderService $b,array $draft):array{return (new \ReflectionMethod($b,'normalizeEntityPayload'))->invoke($b,$draft['entityDraft']);}
 private function rejected(ProgramBuilderService $b,array $draft,string $code='ENTITY_API_OPTIONS_PARAMETERS'):void{
  try{$b->validateExternalDraft($draft);self::fail('Invalid dependent options accepted');}catch(RuntimeHttpException $e){self::assertSame($code,$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}
 }
 public function testRealEntityNormalizationPreservesReferencedStringDropdownEnums():void{
  $b=$this->builder();$d=self::fixture();$normalized=$this->normalize($b,$d);$fields=array_column($normalized['fields'],null,'code');
  foreach(['ordem_campo','ordem_direcao']as$name){$raw=array_values(array_filter($d['entityDraft']['fields'],fn($f)=>$f['code']===$name))[0];self::assertSame('string',$fields[$name]['dataType']);self::assertSame($raw['options']['options'],$fields[$name]['options']['options']??null,'Referenced string/dropdown enum lost by real normalizeEntityPayload');}
 }
 public function testPublicExternalValidationBuildsNormalizedProcessAndRoundtrips():void{
  $b=$this->builder();$result=$b->validateExternalDraft(self::fixture());self::assertTrue($result['readyToApply']);$def=$result['generatedDefinition'];$fields=array_column($def['process']['parameters']['fields'],null,'field');self::assertSame('dropdown',$fields['ordem_campo']['type']);self::assertCount(4,$fields['ordem_campo']['options']);self::assertCount(2,$fields['ordem_direcao']['options']);self::assertSame(['ordem_campo','ordem_direcao'],$fields['despesa_ids']['optionsSource']['parameterFields']);
  $again=$b->validateExternalDraft($result['normalizedDraft']);self::assertSame($result['generatedDefinition'],$again['generatedDefinition']);
  $state=getenv('CIW_OPTIONS_COMPANION_STATE');if($state)file_put_contents($state.'/normalized-process-preview.json',json_encode($def,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
 }
 public function testClosedListsRejectEmptyOverLimitWrongTypesExtraKeysAndDuplicates():void{
  foreach([[],array_fill(0,21,['value'=>'a','text'=>'A']),[['value'=>'a','text'=>'A','extra'=>'x']],[['value'=>1,'text'=>'A']],[['value'=>'a','text'=>1]],[['value'=>'a','text'=>'A'],['value'=>'a','text'=>'B']],[['value'=>'a']],['named'=>['value'=>'a','text'=>'A']]]as$items){$d=self::fixture();$d['entityDraft']['fields'][1]['options']['options']=$items;$this->rejected($this->builder(),$d);}
 }
 public function testUnknownReferenceNonStringAndNonDropdownRemainRejected():void{
  $d=self::fixture();$d['entityDraft']['fields'][3]['options']['api']['optionsSource']['parameterFields']=['missing'];$this->rejected($this->builder(),$d,'PROGRAM_PROCESS_OPTIONS_INVALID');
  foreach(['enum','integer']as$type){$d=self::fixture();$d['entityDraft']['fields'][1]['dataType']=$type;if($type==='integer'){$d['entityDraft']['fields'][1]['options']['options']=[['value'=>1,'text'=>'One']];}$this->rejected($this->builder(),$d,$type==='enum'?'PROGRAM_PROCESS_OPTIONS_INVALID':'ENTITY_API_OPTIONS_PARAMETERS');}
  $d=self::fixture();$d['entityDraft']['fields'][1]['options']['editor']='textarea';$this->rejected($this->builder(),$d);
  $d=self::fixture();$d['entityDraft']['fields'][1]['readonlyField']=true;$this->rejected($this->builder(),$d);
  $d=self::fixture();$d['entityDraft']['fields'][3]['options']['api']['optionsSource']['unknown']='x';$this->rejected($this->builder(),$d,'BUILDER_DECLARATIVE_CONFIG_INVALID');
 }
 public function testUnreferencedStringDropdownAndLegacyNormalizerAreUnchanged():void{
  $d=self::fixture();unset($d['entityDraft']['fields'][3]['options']['api']['optionsSource']['parameterFields']);$b=$this->builder();$normalized=$this->normalize($b,$d);$fields=array_column($normalized['fields'],null,'code');self::assertArrayNotHasKey('options',$fields['ordem_campo']['options']);self::assertArrayNotHasKey('options',$fields['ordem_direcao']['options']);
  $method=new \ReflectionMethod($b,'normalizeOptionItems');self::assertSame([],$method->invoke($b,[['value'=>'a','text'=>'A']],'string'));self::assertSame([['value'=>'a','text'=>'A']],$method->invoke($b,[['value'=>'a','text'=>' A ','extra'=>true]],'enum'));self::assertSame([['value'=>1,'text'=>'A']],$method->invoke($b,[['value'=>1,'text'=>'A']],'integer'));
 }
 public function testClosedEnumBoundaryOneAndTwentyPreservesStringsWithoutCoercion():void{
  foreach([1,20]as$count){$d=self::fixture();$items=[];for($i=0;$i<$count;$i++)$items[]=['value'=>'value-'.$i,'text'=>' Label '.$i.' '];$d['entityDraft']['fields'][1]['options']['options']=$items;$b=$this->builder();$config=$this->normalize($b,$d);$fields=array_column($config['fields'],null,'code');self::assertSame($items,$fields['ordem_campo']['options']['options']);self::assertTrue($b->validateExternalDraft($d)['readyToApply']);}
 }
 public function testCrudPublicValidationAndSaveRejectBeforePersisting():void{
  $b=$this->builder();$d=self::fixture();$d['programDraft']['pageType']='crud';$this->rejected($b,$d,'ENTITY_API_OPTIONS_PROCESS_ONLY');
  $config=$this->normalize($b,self::fixture());$entity=(new \ReflectionMethod($b,'buildTransientEntity'))->invoke($b,$config);$repo=$this->createStub(BuilderEntityRepository::class);$repo->method('findOneBy')->willReturn($entity);$b=$this->builder([BuilderEntityRepository::class=>$repo]);
  try{$b->saveDraft($d['programDraft']);self::fail('CRUD persisted with dependent options');}catch(RuntimeHttpException $e){self::assertSame('ENTITY_API_OPTIONS_PROCESS_ONLY',$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}
 }
 public function testStoredCrudPublishStillRejectsBeforeArchiveOrPersist():void{
  $version=(new BuilderProgramVersion())->setProgramCode('op1047')->setScreenId('ciw.container-selecionar-despesas')->setPageType('crud')->setStatus('draft')->setGeneratedDefinition(['dataModel'=>['fields'=>['ids'=>['optionsSource'=>['endpointId'=>'options.ids','parameterFields'=>['ordem_campo']]]]]]);$repo=$this->createMock(BuilderProgramVersionRepository::class);$repo->expects(self::once())->method('find')->with(1047)->willReturn($version);$repo->expects(self::never())->method('findByProgramCodeOrdered');$b=$this->builder([BuilderProgramVersionRepository::class=>$repo]);
  try{$b->publishVersion(1047);self::fail('Stored CRUD published');}catch(RuntimeHttpException $e){self::assertSame('ENTITY_API_OPTIONS_PROCESS_ONLY',$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}self::assertSame('draft',$version->getStatus());
 }
}
