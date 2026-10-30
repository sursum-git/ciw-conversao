<?php
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false); $kernel->boot();
$em=$kernel->getContainer()->get('doctrine')->getManager();
$version=$em->find(App\Entity\BuilderProgramVersion::class,1);
$reflection=new ReflectionClass(App\Runtime\StructuralIntegrityService::class);
$service=$reflection->newInstanceWithoutConstructor();
$payload=$reflection->getMethod('programVersionPayload')->invoke($service,$version);
$canonical=$reflection->getMethod('canonicalJson');
$hash=hash('sha256',$canonical->invoke($service,$payload));
$stored=$em->getConnection()->fetchOne("SELECT payload_hash FROM system_record_integrity WHERE table_name='builder_program_version' AND record_id=1");
echo 'Current matches stored: '.($hash===$stored?'yes':'no').PHP_EOL;
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
$config=(new ReflectionMethod($builder,'normalizeBuilderPayload'))->invoke($builder,$version->getBuilderConfig());
$definition=(new ReflectionMethod($builder,'generateProgramDefinition'))->invoke($builder,$config);
$freshPayload=$payload;
$freshPayload['builderConfig']=(new ReflectionMethod($builder,'publicBuilderConfig'))->invoke($builder,$config);
$freshPayload['generatedDefinition']=$definition;
echo 'Regenerated matches stored: '.(hash('sha256',$canonical->invoke($service,$freshPayload))===$stored?'yes':'no').PHP_EOL;
$walk=function($a,$b,$path='')use(&$walk){
 if(is_array($a)&&is_array($b)){foreach(array_unique(array_merge(array_keys($a),array_keys($b)))as$key){$walk($a[$key]??null,$b[$key]??null,$path.'.'.$key);}return;}
 if($a!==$b) echo 'REGENERATED '.$path.' '.get_debug_type($a).' -> '.get_debug_type($b).' '.(is_scalar($a)?json_encode($a):'').' -> '.(is_scalar($b)?json_encode($b):'').PHP_EOL;
};
$walk($payload,$freshPayload);
foreach($payload as $key=>$value) {
 if(is_array($value)) { echo $key.': array '.count($value).PHP_EOL; continue; }
 echo $key.': '.json_encode($value,JSON_UNESCAPED_UNICODE).PHP_EOL;
}
$em->getConnection()->beginTransaction();
try {
 $copy=clone $version;
 (new ReflectionProperty($copy,'id'))->setValue($copy,null);
 $copy->setProgramCode('cd0998')->setVersion('diagnostic');
 $before=$reflection->getMethod('programVersionPayload')->invoke($service,$copy);
 $em->persist($copy);$em->flush();$em->refresh($copy);
 $after=$reflection->getMethod('programVersionPayload')->invoke($service,$copy);
 $compare=function($a,$b,$path='')use(&$compare){
  if(is_array($a)&&is_array($b)){foreach(array_unique(array_merge(array_keys($a),array_keys($b)))as$key){$compare($a[$key]??null,$b[$key]??null,$path.'.'.$key);}return;}
  if($a!==$b) echo 'CHANGED '.$path.' '.get_debug_type($a).' -> '.get_debug_type($b).PHP_EOL;
 };
 $compare($before,$after);
 echo 'Round-trip hash stable: '.(hash('sha256',$canonical->invoke($service,$before))===hash('sha256',$canonical->invoke($service,$after))?'yes':'no').PHP_EOL;
}finally{$em->getConnection()->rollBack();}
