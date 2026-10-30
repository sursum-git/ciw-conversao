<?php
declare(strict_types=1);
// Existing Builder normalizers/generator in memory. No repository, DB or HTTP.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root=dirname(__DIR__);$state=$argv[1];
$r=new ReflectionClass(App\Builder\ProgramBuilderService::class);$builder=$r->newInstanceWithoutConstructor();$invoke=fn(string $method,...$args)=>$r->getMethod($method)->invoke($builder,...$args);
$ops=json_decode(file_get_contents($root.'/metadata/api-source-additions.json'),true,512,JSON_THROW_ON_ERROR)['operations'];
$baseline=json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/source-118-before.json'),true,512,JSON_THROW_ON_ERROR);
if(count($baseline['operations'])!==118 || count(array_intersect(array_column($baseline['operations'],'code'),array_column($ops,'code')))!==0)throw new RuntimeException('source baseline/collision');
$merged=$baseline;$merged['operations']=array_merge($baseline['operations'],$ops);
if(array_slice($merged['operations'],0,118)!==$baseline['operations']||count($merged['operations'])!==122)throw new RuntimeException('previous operations changed');
file_put_contents($state.'/source-122-preview.json',json_encode($merged,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
$ops=$merged['operations'];
$ops=$invoke('normalizeApiOperationsRegistry',$ops,'http://127.0.0.1:19910/med/web');
$source=(new App\Entity\BuilderApiSource())->setCode('motor_progress_ciw_cadastros')->setName('Fonte existente — preview isolado')->setBaseUrl('http://127.0.0.1:19910/med/web')->setMetadata(['operations'=>$ops,'responseContract'=>'sursum-programs']);
foreach(['op1033','op1034']as$program){
 $draft=json_decode(file_get_contents($root.'/metadata/'.$program.'-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);$d=$draft['entityDraft'];
 $binding=$invoke('resolveApiSourceBinding',$source,$d['apiListOperationCode'],$d['apiDetailOperationCode'],'','','');
 $entity=(new App\Entity\BuilderEntity())->setCode($d['code'])->setName($d['name'])->setEntityType('api')->setMetadata(['apiSource'=>$binding]);
 foreach($d['fields']as$v){
  $options=$v['options'];$options['api']=['jsonPath'=>$v['apiJsonPath'],'writePath'=>$v['apiWritePath'],'showInGrid'=>$v['apiShowInGrid'],'showInForm'=>$v['apiShowInForm'],'showInFilter'=>$v['apiShowInFilter']];
  $field=(new App\Entity\BuilderField())->setCode($v['code'])->setLabel($v['label'])->setDataType($v['dataType'])->setPrimaryKey($v['primaryKey'])->setRequired($v['primaryKey']||$v['required'])->setPosition($v['position'])->setOptions($options);
  if(isset($v['length']))$field->setLength($v['length']);$entity->addField($field);
 }
 $config=$draft['programDraft']+['_entity'=>$entity,'icon'=>'table','customizationPolicy'=>'standard','subscriberId'=>null,'baseProgramCode'=>null,'baseProgramVersionId'=>null,'upgradeFrozen'=>false,'frozenReason'=>null];
 $config['contextFields']=$invoke('normalizeContextFields',$config['contextFields'],$entity);
 $config['rowLinks']=$invoke('normalizeRowLinks',$config['rowLinks'],$entity);
 $config['crudOptions']=$invoke('normalizeCrudOptions',$config['crudOptions'],$entity,'crud');
 $config['formOptions']=$invoke('normalizeFormOptions',$config['formOptions'],$entity,'crud',$config['contextFields']);
 $definition=$invoke('generateCrudDefinition',$config);
 file_put_contents($state.'/'.$program.'-preview.json',json_encode($definition,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
}
echo 'PASS native Builder previews 2 screens, source118+4 operations, 118 preserved, no DB/HTTP'.PHP_EOL;
