<?php
namespace App\Tests\Builder;
use App\Builder\ProgramBuilderService;
use App\Entity\{BuilderEntity,BuilderField};
use App\Runtime\RuntimeHttpException;
use PHPUnit\Framework\TestCase;
final class NativeLookupParametersTest extends TestCase {
 public function testClosedDependentLookupFieldsSurviveNormalization():void{
  $r=new \ReflectionClass(ProgramBuilderService::class);$value=['operationCode'=>'despesas_selecao_opcoes','valueField'=>'despesa_id','textField'=>'label','parameterFields'=>['ordem_campo','ordem_direcao']];
  self::assertSame($value,$r->getMethod('normalizeApiOptionsSource')->invoke($r->newInstanceWithoutConstructor(),$value));
 }
 public function testClosedEnumsRejectUnknownDuplicateOrOpenFields():void{
  $r=new \ReflectionClass(ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$base=['operationCode'=>'opts','valueField'=>'id','textField'=>'label'];
  foreach([[],['order','order'],['context'],['order','direction','extra'],['order',17]]as$bad){try{$r->getMethod('normalizeApiOptionsSource')->invoke($b,$base+['parameterFields'=>$bad]);self::fail('invalid dependency list');}catch(RuntimeHttpException$e){self::assertSame(422,$e->getStatusCode());}}
  foreach(['valid','readonly','open','missing','type','optionExtra','duplicateValue']as$case){
   $entity=(new BuilderEntity())->setCode('selected')->setName('Selected')->setEntityType('api')->setMetadata(['apiSource'=>['operations'=>[['code'=>'opts','type'=>'list']]]]);
   $options=['editor'=>'dropdown','options'=>[['value'=>'asc','text'=>'Crescente']]];
   if($case==='readonly')$options['readonly']=true;elseif($case==='open')unset($options['options']);elseif($case==='optionExtra')$options['options'][0]['script']='bad';elseif($case==='duplicateValue')$options['options'][]=$options['options'][0];
   if($case!=='missing')$entity->addField((new BuilderField())->setCode('order')->setLabel('Order')->setDataType($case==='type'?'integer':'string')->setOptions($options));
   try{$r->getMethod('validateApiOptionsOperation')->invoke($b,$entity,$base+['parameterFields'=>['order']]);self::assertSame('valid',$case);}catch(RuntimeHttpException$e){self::assertNotSame('valid',$case);self::assertSame(422,$e->getStatusCode());}
  }
 }
}
