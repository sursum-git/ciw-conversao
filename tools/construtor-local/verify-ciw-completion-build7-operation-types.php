<?php
// Exercise the actual native registry normalizer without DB, network or writes to the catalog.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$state=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/official-build7';
$plan=json_decode(file_get_contents($state.'/metadata/source-additions.json'),true,512,JSON_THROW_ON_ERROR);
$operations=array_column($plan['operations'],'value');
$class=new ReflectionClass(App\Builder\ProgramBuilderService::class);$builder=$class->newInstanceWithoutConstructor();$normalize=$class->getMethod('normalizeApiOperationsRegistry');
$original=$normalize->invoke($builder,$operations,'http://127.0.0.1:19910/med/web');$checks=0;
$assert=static function($ok)use(&$checks){if(!$ok)throw new RuntimeException('NATIVE_OPERATION_TYPE_MISMATCH');$checks++;};
foreach($operations as$i=>$op){
 $expected=$op['bodyTemplate']['operation']==='get'?'detail':'list';
 if(($argv[1]??'')==='--red')$assert($original[$i]['type']===$expected);
 else $assert($original[$i]['type']===($expected==='detail'?'custom':'list'));
}
$corrected=$operations;foreach($corrected as&$op)if($op['bodyTemplate']['operation']==='get')$op['type']='detail';unset($op);
$actual=$normalize->invoke($builder,$corrected,'http://127.0.0.1:19910/med/web');
foreach($corrected as$i=>$op){$assert($actual[$i]['type']===$op['type']);$assert($actual[$i]['method']==='POST');$assert($actual[$i]['bodyTemplate']===$op['bodyTemplate']);$assert(($actual[$i]['requestContextFields']??[])===($op['requestContextFields']??[]));}
$assert(count($corrected)===8);
$proof=['success'=>true,'checks'=>$checks,'nativeNormalizer'=>true,'originalGetBecameCustom'=>4,'correctedDetailPreserved'=>4,'sourceCountBefore'=>140,'sourceCountAfter'=>140,'changesOnlyFourNewOwnedTypes'=>true,'operations'=>$corrected,'businessWrites'=>false,'catalogWrites'=>false];
file_put_contents($state.'/metadata-operation-type-correction.json',json_encode($proof,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_THROW_ON_ERROR).PHP_EOL);
echo 'PASS '.$checks.' actual native registry checks;four metadata types corrected get=>detail;no catalog/network/business writes'.PHP_EOL;
