<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderEntity,BuilderField};
use App\Runtime\RuntimeHttpException;
use PHPUnit\Framework\TestCase;
final class RangeFilterOnlyBuilderTest extends TestCase {
 private function entity(string $type='integer'):BuilderEntity{$entity=(new BuilderEntity())->setCode('scope');$entity->addField((new BuilderField())->setCode('item_id')->setLabel('Item')->setDataType($type));return $entity;}
 private function valid():array{return[['field'=>'item_id','filter'=>true,'createDefault'=>false,'readonly'=>true,'required'=>false,'filterOnly'=>true]];}
 private function normalize(array $input,string $page='crud',string $type='integer'):array{$b=(new \ReflectionClass(ProgramBuilderService::class))->newInstanceWithoutConstructor();return(new \ReflectionMethod($b,'normalizeContextFields'))->invoke($b,$input,$this->entity($type),$page);}
 public function testValidOptionalFilterOnlyIsPreserved():void{self::assertSame($this->valid(),$this->normalize($this->valid()));}
 public function testLegacyAndFalseEmitNoNewDescriptor():void{$old=[['field'=>'item_id','required'=>true]];self::assertSame($old,$this->normalize($old));$disabled=$old;$disabled[0]['filterOnly']=false;self::assertSame($old,$this->normalize($disabled));}
 public function testContradictionsUnknownTypesAndNonCrudAreRejected():void{foreach(['required'=>true,'filter'=>false,'readonly'=>false,'createDefault'=>true,'filterOnly'=>'true','unknown'=>true]as$key=>$value){$bad=$this->valid();$bad[0][$key]=$value;try{$this->normalize($bad);self::fail($key);}catch(RuntimeHttpException $error){self::assertSame(422,$error->getStatusCode());}}foreach([['process','integer'],['crud','string']]as[$page,$type]){try{$this->normalize($this->valid(),$page,$type);self::fail($page.$type);}catch(RuntimeHttpException $error){self::assertSame(422,$error->getStatusCode());}}}
}
