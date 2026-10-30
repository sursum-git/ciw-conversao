<?php
// Native read-only owner lookup; no grants, policy or metadata writes.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
try {
 $dir=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/build8-metadata-publication-preparation';
 $plan=json_decode(file_get_contents($dir.'/execution-plan-v1.2.json'),true,512,JSON_THROW_ON_ERROR);
 if(hash_file('sha256',$plan['parent']['baselinePath'])!==$plan['parent']['baselineSha256']||is_file($plan['nativeOwnerProof']['path']))throw new RuntimeException('Fresh pinned parent proof required');
 $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
 $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
 $governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
 $resolve=new ReflectionMethod($governance,'findStandardProgramVersionByEntity');
 $version=$resolve->invoke($governance,'container_despesas_progress');
 if(!$version||$version->getProgramCode()!=='op1003')throw new RuntimeException('Native owner mismatch');
 $owner=['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus()];
 $proof=['success'=>true,'readOnly'=>true,'resolver'=>'findStandardProgramVersionByEntity','parentBaselineSha256'=>$plan['parent']['baselineSha256'],'owners'=>['container_despesas_progress'=>$owner]];
 file_put_contents($plan['nativeOwnerProof']['path'],json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);
 echo "PASS native governance owner resolved readonly; no grants or policy change\n";
} finally {$kernel->shutdown();}
