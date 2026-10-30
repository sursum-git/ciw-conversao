<?php
declare(strict_types=1);
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root=dirname(__DIR__,2);$base=$root.'/integration-src/purchase-pending-20261028';$state=$root.'/.runtime/purchase-pending-integration-20261028/metadata';
if(!is_dir($state))mkdir($state,0700,true);
$r=new ReflectionClass(App\Builder\ProgramBuilderService::class);$builder=$r->newInstanceWithoutConstructor();$invoke=fn(string $method,...$args)=>$r->getMethod($method)->invoke($builder,...$args);
foreach(['signals-global/sinalizadores-importacao-med','signals-global/alertas-importacao-med','signal-config/sinalizadores-importacao'] as $target){
 [$scope,$slug]=explode('/',$target);$meta=$base.'/'.$scope.'/metadata';
 $draft=json_decode(file_get_contents($meta.'/'.$slug.'-builder-draft.json'),true,flags:JSON_THROW_ON_ERROR);$d=$draft['entityDraft'];
 $ops=json_decode(file_get_contents($meta.'/api-source-additions.json'),true,flags:JSON_THROW_ON_ERROR)['operations'];$ops=$invoke('normalizeApiOperationsRegistry',$ops,'http://127.0.0.1:19910/med/web');
 $source=(new App\Entity\BuilderApiSource())->setCode('motor_progress_ciw_cadastros')->setName('Preview isolated')->setBaseUrl('http://127.0.0.1:19910/med/web')->setMetadata(['operations'=>$ops,'responseContract'=>'sursum-programs']);
 $binding=$invoke('resolveApiSourceBinding',$source,$d['apiListOperationCode'],$d['apiDetailOperationCode'],$d['apiCreateOperationCode']??'',$d['apiUpdateOperationCode']??'',$d['apiDeleteOperationCode']??'');
 $entity=(new App\Entity\BuilderEntity())->setCode($d['code'])->setName($d['name'])->setEntityType('api')->setMetadata(['apiSource'=>$binding]);
 foreach($d['fields'] as $v){
  $options=$v['options'];$options['api']=($options['api']??[])+['jsonPath'=>$v['apiJsonPath'],'writePath'=>$v['apiWritePath'],'showInGrid'=>$v['apiShowInGrid'],'showInForm'=>$v['apiShowInForm'],'showInFilter'=>$v['apiShowInFilter']];
  if(isset($options['options']))$options['options']=$invoke('normalizeOptionItems',$options['options'],$v['dataType']);
  $field=(new App\Entity\BuilderField())->setCode($v['code'])->setLabel($v['label'])->setDataType($v['dataType'])->setPrimaryKey($v['primaryKey'])->setRequired($v['primaryKey']||$v['required'])->setPosition($v['position'])->setOptions($options);
  if(isset($v['length']))$field->setLength($v['length']);if(isset($v['precision']))$field->setPrecisionValue($v['precision']);if(isset($v['scale']))$field->setScaleValue($v['scale']);$entity->addField($field);
 }
 $config=$draft['programDraft']+['_entity'=>$entity,'icon'=>'table','customizationPolicy'=>'standard','subscriberId'=>null,'baseProgramCode'=>null,'baseProgramVersionId'=>null,'upgradeFrozen'=>false,'frozenReason'=>null];
 $config['contextFields']=$invoke('normalizeContextFields',$config['contextFields'],$entity);$config['rowLinks']=$invoke('normalizeRowLinks',$config['rowLinks'],$entity);
 $config['crudOptions']=$invoke('normalizeCrudOptions',$config['crudOptions'],$entity,'crud');$config['formOptions']=$invoke('normalizeFormOptions',$config['formOptions'],$entity,'crud',$config['contextFields']);
 $definition=$invoke('generateCrudDefinition',$config);
 file_put_contents($state.'/'.$slug.'-definition.json',json_encode($definition,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
 file_put_contents($state.'/'.$slug.'-php-validation.json',json_encode(['success'=>true,'fields'=>count($d['fields']),'draftSha256'=>hash_file('sha256',$meta.'/'.$slug.'-builder-draft.json'),'operationsSha256'=>hash_file('sha256',$meta.'/api-source-additions.json'),'databaseWrites'=>false,'networkRequests'=>false],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
 echo 'PASS native Builder preview '.$slug.' fields='.count($d['fields']).PHP_EOL;
}
