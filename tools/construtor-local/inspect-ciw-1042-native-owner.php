<?php
// Native owner lookup only. No grants, locks, catalog or business writes.
$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
try {
 $dir=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/batch1042-metadata';
 $before=$dir.'/parent-before.json';$output=$dir.'/native-owner-proof.json';
 if(is_file($output)||hash_file('sha256',$before)!=='e68c75152c1874c4e1d2bbbf37447b53fcf06697aa9f97d29d6f58f691652316')throw new RuntimeException('Fresh pinned parent required');
 $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
 $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
 $governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
 $version=(new ReflectionMethod($governance,'findStandardProgramVersionByEntity'))->invoke($governance,'container_despesas_progress');
 if(!$version||$version->getProgramCode()!=='op1003'||$version->getId()!==120||$version->getVersion()!=='1.0.4'||$version->getStatus()!=='published')throw new RuntimeException('Native owner changed');
 $proof=['success'=>true,'readOnly'=>true,'resolver'=>'findStandardProgramVersionByEntity','parentBaselineSha256'=>hash_file('sha256',$before),'owners'=>['container_despesas_progress'=>['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus()]]];
 file_put_contents($output,json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);
 echo "PASS1042 native parent owner op1003/v120/1.0.4; no grant or write\n";
}finally{$kernel->shutdown();}
