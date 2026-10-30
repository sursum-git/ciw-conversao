<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderEntity,BuilderField};
use App\Runtime\RuntimeHttpException;
use PHPUnit\Framework\TestCase;
final class IntegerContextRangeBuilderTest extends TestCase
{
 private function normalize(array $value,string $type='integer'):array {
  $entity=(new BuilderEntity())->setCode('range_example');$entity->addField((new BuilderField())->setCode('fornecedor_id')->setDataType($type));
  $r=new \ReflectionClass(ProgramBuilderService::class);return $r->getMethod('normalizeContextFields')->invoke($r->newInstanceWithoutConstructor(),$value,$entity);
 }
 private function invalid(array $value,string $type='integer'):void {try{$this->normalize($value,$type);self::fail('Expected invalid context');}catch(RuntimeHttpException $e){self::assertSame(422,$e->getStatusCode());self::assertContains($e->getErrorCode(),['BUILDER_CONTEXT_INVALID','BUILDER_DECLARATIVE_CONFIG_INVALID']);}}
 public function testFullRangeAndClosedSubrangesSurviveWithoutCoercion():void {
  foreach([[-2147483648,2147483647],[-5,12],[0,0],[-10,-1],[7,7],[2147483647,2147483647],[-2147483648,-2147483648]]as[$min,$max]){$value=[['field'=>'fornecedor_id','required'=>true,'filter'=>true,'readonly'=>true,'createDefault'=>false,'integerRange'=>['min'=>$min,'max'=>$max]]];self::assertSame($value,$this->normalize($value));}
 }
 public function testAbsentOptionPreservesOldNormalizedContract():void {
  foreach([[],[['field'=>'fornecedor_id']],[['field'=>'fornecedor_id','required'=>true,'filter'=>true,'readonly'=>false,'createDefault'=>true]]]as$value)self::assertSame($value,$this->normalize($value));
 }
 public function testRangeShapeTypeLimitsAndOrderingAreClosed():void {
  foreach([null,[],[0,10],['min'=>0],['max'=>10],['min'=>0,'max'=>10,'unknown'=>true],['min'=>'0','max'=>10],['min'=>false,'max'=>10],['min'=>0.5,'max'=>10],['min'=>0,'max'=>10.5],['min'=>-2147483649,'max'=>10],['min'=>0,'max'=>2147483648],['min'=>10,'max'=>0],['min'=>'-0','max'=>10]]as$range)$this->invalid([['field'=>'fornecedor_id','integerRange'=>$range]]);
 }
 public function testRangeRequiresExistingIntegerField():void {
  foreach(['string','decimal','boolean','date']as$type)$this->invalid([['field'=>'fornecedor_id','integerRange'=>['min'=>-1,'max'=>1]]],$type);
  $this->invalid([['field'=>'unknown','integerRange'=>['min'=>-1,'max'=>1]]]);
 }
 public function testOldClosedKeysAndDuplicateGuardRemain():void {
  $this->invalid([['field'=>'fornecedor_id','unknown'=>true]]);$this->invalid([['field'=>'fornecedor_id'],['field'=>'fornecedor_id','integerRange'=>['min'=>0,'max'=>10]]]);
 }
}
