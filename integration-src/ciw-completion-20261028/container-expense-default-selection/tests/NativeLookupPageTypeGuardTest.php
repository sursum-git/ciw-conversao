<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderModule,BuilderProgramVersion};
use App\Repository\{BuilderEntityRepository,BuilderModuleRepository,BuilderProgramVersionRepository,ProgramRepository};
use App\Runtime\{PermissionResolver,RuntimeEnvironmentIdentityResolver,RuntimeHttpException};
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class NativeLookupPageTypeGuardTest extends TestCase {
 private function fixture():array {
  ob_start();try{require __DIR__.'/preview-native.php';}finally{ob_end_clean();}
  $modules=$this->createStub(BuilderModuleRepository::class);$modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));$r->getProperty('modules')->setValue($b,$modules);$r->getProperty('programs')->setValue($b,$this->createStub(ProgramRepository::class));
  $entities=$this->createStub(BuilderEntityRepository::class);$entities->method('findOneBy')->willReturn($entity);$r->getProperty('entities')->setValue($b,$entities);
  return[$b,$r,$entity,$draft['programDraft']];
 }
 public function testActualCrudDraftRejectsOptInBeforeAnyPersistence():void {
  [$b,$r,$entity,$program]=$this->fixture();$program['pageType']='crud';
  try{$r->getMethod('normalizeBuilderPayload')->invoke($b,$program,$entity);self::fail('CRUD with dependent options was accepted');}catch(RuntimeHttpException$e){self::assertSame('ENTITY_API_OPTIONS_PROCESS_ONLY',$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}
 }
 public function testPublicSaveDraftRejectsCrudFlagBeforePersistOrFlush():void {
  [$b,$r,$entity,$program]=$this->fixture();$program['pageType']='crud';
  $permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$r->getProperty('permissions')->setValue($b,$permissions);$r->getProperty('versions')->setValue($b,$this->createStub(BuilderProgramVersionRepository::class));
  $em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$r->getProperty('entityManager')->setValue($b,$em);
  try{$b->saveDraft($program);self::fail('Public draft persisted a CRUD dependency');}catch(RuntimeHttpException$e){self::assertSame('ENTITY_API_OPTIONS_PROCESS_ONLY',$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}
 }
 public function testProcessAndItsIntermediateCrudGenerationKeepSignedDependencies():void {
  [$b,$r,$entity,$program]=$this->fixture();$config=$r->getMethod('normalizeBuilderPayload')->invoke($b,$program,$entity);$d=$r->getMethod('generateProgramDefinition')->invoke($b,$config);
  self::assertSame('process',$d['pageType']);$fields=array_column($d['process']['parameters']['fields'],null,'field');self::assertSame(['ordem_campo','ordem_direcao'],$fields['despesa_ids']['optionsSource']['parameterFields']);
  $v=(new BuilderProgramVersion())->setPageType('process')->setBuilderEntityCode($entity->getCode());self::assertSame(['lookupParameterFields'=>['ordem_campo','ordem_direcao']],$r->getMethod('processLookupParameterConfig')->invoke($b,$v,'options.despesa_ids'));
 }
 public function testLegacyCrudWithoutOptInRemainsAccepted():void {
  [$b,$r,$entity,$program]=$this->fixture();foreach($entity->getFields()as$f){$o=$f->getOptions();unset($o['api']['optionsSource']['parameterFields']);$f->setOptions($o);}$program['pageType']='crud';
  $config=$r->getMethod('normalizeBuilderPayload')->invoke($b,$program,$entity);$d=$r->getMethod('generateProgramDefinition')->invoke($b,$config);self::assertSame('crud',$d['pageType']);self::assertArrayNotHasKey('parameterFields',$d['dataModel']['fields']['despesa_ids']['optionsSource']);
 }
 public function testPublicPublishRejectsPreviouslyStoredCrudFlagBeforeArchiveOrPersist():void {
  [$b,$r]=$this->fixture();$old=(new BuilderProgramVersion())->setProgramCode('op1047')->setPageType('crud')->setStatus('published');
  $version=(new BuilderProgramVersion())->setProgramCode('op1047')->setScreenId('ciw.test')->setPageType('crud')->setStatus('draft')->setGeneratedDefinition(['dataModel'=>['fields'=>['ids'=>['optionsSource'=>['endpointId'=>'options.ids','parameterFields'=>['ordem_campo']]]]]]);
  $versions=$this->createMock(BuilderProgramVersionRepository::class);$versions->expects(self::once())->method('find')->with(1047)->willReturn($version);$versions->expects(self::never())->method('findByProgramCodeOrdered');$r->getProperty('versions')->setValue($b,$versions);
  $em=$this->createMock(EntityManagerInterface::class);$em->expects(self::never())->method('persist');$em->expects(self::never())->method('flush');$r->getProperty('entityManager')->setValue($b,$em);
  $permissions=$this->createStub(PermissionResolver::class);$permissions->method('hasPermission')->willReturn(true);$r->getProperty('permissions')->setValue($b,$permissions);
  try{$b->publishVersion(1047);self::fail('Stored CRUD opt-in accepted at publication');}catch(RuntimeHttpException$e){self::assertSame('ENTITY_API_OPTIONS_PROCESS_ONLY',$e->getErrorCode());self::assertSame(422,$e->getStatusCode());}
  self::assertSame('published',$old->getStatus());self::assertSame('draft',$version->getStatus());
 }
}
