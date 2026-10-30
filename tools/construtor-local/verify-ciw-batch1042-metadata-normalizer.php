<?php
// Real native operation normalizer; no kernel, DB, network or catalog mutation.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root=dirname(__DIR__,2);$source=json_decode(file_get_contents($root.'/integration-src/ciw-completion-20261028/container-expense-batch/metadata/api-source.json'),true,512,JSON_THROW_ON_ERROR);
$class=new ReflectionClass(App\Builder\ProgramBuilderService::class);$builder=$class->newInstanceWithoutConstructor();$normalize=$class->getMethod('normalizeApiOperationsRegistry');
$actual=$normalize->invoke($builder,$source['operations'],$source['baseUrl']);$checks=0;
$assert=function($ok)use(&$checks){if(!$ok)throw new RuntimeException('NATIVE1042_NORMALIZER_FAILED');$checks++;};
$assert(count($actual)===3);
foreach($source['operations']as$i=>$op){$assert($actual[$i]['type']===$op['type']);$assert($actual[$i]['method']==='POST');$assert($actual[$i]['bodyTemplate']===$op['bodyTemplate']);$assert($actual[$i]['requestContextFields']===['container_id']);$assert(str_ends_with($actual[$i]['path'],'/SursumPrograms/containers-despesas-lote'));}
$assert($actual[1]['type']==='detail');$assert($actual[2]['type']==='batch');
$proof=['success'=>true,'checks'=>$checks,'nativeNormalizer'=>true,'types'=>array_column($actual,'type'),'network'=>false,'catalogWrites'=>false,'businessWrites'=>false];
file_put_contents($root.'/.runtime/ciw-completion-20261028/batch1042-metadata/normalizer-proof.json',json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);echo 'PASS '.$checks.' real native registry checks'.PHP_EOL;
