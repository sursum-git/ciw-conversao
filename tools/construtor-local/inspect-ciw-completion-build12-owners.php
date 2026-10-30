<?php
// Native readonly resolver. No authoring grant, lock, catalog or business write.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
try {
    $dir=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/build12-metadata-publication-preparation';
    $plan=json_decode(file_get_contents($dir.'/plan.json'),true,512,JSON_THROW_ON_ERROR);
    if(hash_file('sha256',$plan['parent']['baselinePath'])!==$plan['parent']['baselineSha256']||is_file($plan['nativeOwnerProof']['path']))throw new RuntimeException('Fresh pinned parent proof required');
    if($plan['parent']['programCode']!=='op1000'||$plan['parent']['entityCode']!=='containers_progress'||$plan['parent']['beforeVersion']!=='1.0.2')throw new RuntimeException('Closed parent contract required');
    $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
    $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
    $governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
    $version=(new ReflectionMethod($governance,'findStandardProgramVersionByEntity'))->invoke($governance,'containers_progress');
    if(!$version||$version->getProgramCode()!=='op1000'||$version->getVersion()!=='1.0.2'||$version->getStatus()!=='published')throw new RuntimeException('Native owner mismatch');
    $owner=['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus()];
    $proof=['success'=>true,'readOnly'=>true,'resolver'=>'findStandardProgramVersionByEntity','parentBaselineSha256'=>$plan['parent']['baselineSha256'],'owners'=>['containers_progress'=>$owner]];
    $handle=fopen($plan['nativeOwnerProof']['path'],'x');if($handle===false)throw new RuntimeException('Existing owner proof must be preserved');
    fwrite($handle,json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);fclose($handle);
    echo "PASS native owner readonly; no grant or policy change\n";
} finally {$kernel->shutdown();}
