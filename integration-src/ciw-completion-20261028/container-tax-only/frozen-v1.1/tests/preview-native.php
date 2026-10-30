<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root=dirname(__DIR__);$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only';
$r=new ReflectionClass(App\Builder\ProgramBuilderService::class);$b=$r->newInstanceWithoutConstructor();$invoke=fn($name,...$args)=>$r->getMethod($name)->invoke($b,...$args);
$data=json_decode(file_get_contents($root.'/metadata/api-source-preview.json'),true,512,JSON_THROW_ON_ERROR);$operations=$invoke('normalizeApiOperationsRegistry',$data['operations'],$data['baseUrl']);
$source=(new App\Entity\BuilderApiSource())->setCode($data['code'])->setName($data['name'])->setBaseUrl($data['baseUrl'])->setMetadata(['responseContract'=>'sursum-programs','operations'=>$operations]);
$binding=$invoke('resolveApiSourceBinding',$source,'painel_read','painel_get');
$e=(new App\Entity\BuilderEntity())->setCode('container_processos_progress')->setName('Processos do container')->setEntityType('api')->setMetadata(['apiSource'=>$binding]);
$e->addField((new App\Entity\BuilderField())->setCode('container_id')->setLabel('Container MED')->setDataType('integer')->setPrimaryKey(true)->setRequired(true)->setPosition(10)->setOptions(['readonly'=>true,'writable'=>false,'api'=>['jsonPath'=>'container_id','writePath'=>'container_id','showInGrid'=>true,'showInForm'=>true,'showInFilter'=>true]]));
$draft=json_decode(file_get_contents($root.'/metadata/tax-only-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);
$c=$draft['programDraft']+['_entity'=>$e,'icon'=>'calculator','customizationPolicy'=>'standard','subscriberId'=>null,'baseProgramCode'=>null,'baseProgramVersionId'=>null,'upgradeFrozen'=>false,'frozenReason'=>null];
$c['contextFields']=$invoke('normalizeContextFields',$c['contextFields'],$e);$c['crudOptions']=null;$c['formOptions']=null;$c['rowLinks']=[];$c['processOptions']=$invoke('normalizeProcessOptions',$c['processOptions'],$e,$c['contextFields']);
$d=$invoke('generateProcessDefinition',$c);
if($d['pageType']!=='process'||$d['program']['id']!=='op1043'||count($d['process']['parameters']['fields'])!==1||$d['process']['parameters']['fields'][0]['readonly']!==true||!str_contains($d['process']['actions']['process']['confirmation']['message'],'Confirma'))throw new RuntimeException('Invalid process generation');
file_put_contents($state.'/native-preview.json',json_encode($d,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR));
echo 'PASS real native Builder op1043 process context/confirmation/entity reuse'.PHP_EOL;
