<?php
declare(strict_types=1);
// Pure local Builder proof: no repository, HTTP, database or publication.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
[$script,$candidate,$output]=$argv;
$draft=json_decode(file_get_contents($candidate),true,512,JSON_THROW_ON_ERROR);
$directory=dirname($candidate);
$additions=json_decode(file_get_contents($directory.'/api-source-additions.json'),true,512,JSON_THROW_ON_ERROR);
$baseline=json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/source-118-before.json'),true,512,JSON_THROW_ON_ERROR);
$ops=array_merge($baseline['operations'],$additions['operations']);
if(count(array_unique(array_column($ops,'code')))!==count($ops))throw new RuntimeException('operation collision');
$r=new ReflectionClass(App\Builder\ProgramBuilderService::class);
$builder=$r->newInstanceWithoutConstructor();
$invoke=fn(string $method,...$args)=>$r->getMethod($method)->invoke($builder,...$args);
$ops=$invoke('normalizeApiOperationsRegistry',$ops,'http://127.0.0.1:19910/med/web');
$source=(new App\Entity\BuilderApiSource())->setCode('motor_progress_ciw_cadastros')->setName('Isolated preview')->setBaseUrl('http://127.0.0.1:19910/med/web')->setMetadata(['operations'=>$ops,'responseContract'=>'sursum-programs']);
$d=$draft['entityDraft'];
$binding=$invoke('resolveApiSourceBinding',$source,$d['apiListOperationCode'],$d['apiDetailOperationCode'],'','','');
$entity=(new App\Entity\BuilderEntity())->setCode($d['code'])->setName($d['name'])->setEntityType('api')->setMetadata(['apiSource'=>$binding]);
foreach($d['fields'] as $v){
 $options=$v['options'];
 $options['api']=['jsonPath'=>$v['apiJsonPath'],'writePath'=>$v['apiWritePath'],'showInGrid'=>$v['apiShowInGrid'],'showInForm'=>$v['apiShowInForm'],'showInFilter'=>$v['apiShowInFilter']];
 $f=(new App\Entity\BuilderField())->setCode($v['code'])->setLabel($v['label'])->setDataType($v['dataType'])->setPrimaryKey($v['primaryKey'])->setRequired($v['primaryKey']||$v['required'])->setPosition($v['position'])->setOptions($options);
 if(isset($v['length']))$f->setLength($v['length']);
 if(isset($v['decimals']))$f->setDecimalPlaces($v['decimals']);
 $entity->addField($f);
}
$config=$draft['programDraft']+['_entity'=>$entity,'icon'=>'table','customizationPolicy'=>'standard','subscriberId'=>null,'baseProgramCode'=>null,'baseProgramVersionId'=>null,'upgradeFrozen'=>false,'frozenReason'=>null];
$config['contextFields']=$invoke('normalizeContextFields',$config['contextFields']??[],$entity);
$config['rowLinks']=$invoke('normalizeRowLinks',$config['rowLinks']??[],$entity);
$config['crudOptions']=$invoke('normalizeCrudOptions',$config['crudOptions']??null,$entity,'crud');
$config['formOptions']=$invoke('normalizeFormOptions',$config['formOptions']??null,$entity,'crud',$config['contextFields']);
$generated=$invoke('generateCrudDefinition',$config);
file_put_contents($output,json_encode($generated,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
echo 'PASS native Builder '.$d['code'].' fields='.count($d['fields']).PHP_EOL;
