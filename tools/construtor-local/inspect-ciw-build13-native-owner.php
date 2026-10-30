<?php
// Exact existing owner lookup only; no grants, locks, authoring or business writes.
$backend='D:/opencode/construtor-pg/backend';
$dir=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/build13-metadata-fresh';
$parent=$dir.'/op1005-current.json';$output=$dir.'/native-governance-owners.json';
$baseline='a22a3428b60bccd4c66bfb16845c04474c539e45bf4388936d08d4fed81536a7';
if(is_file($output)||hash_file('sha256',$parent)!==$baseline)throw new RuntimeException('Fresh exact parent required');
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
try {
    $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
    $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
    $governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
    $version=(new ReflectionMethod($governance,'findStandardProgramVersionByEntity'))->invoke($governance,'container_versoes_custo_progress');
    if(!$version||$version->getProgramCode()!=='op1005'||$version->getId()!==107||$version->getVersion()!=='1.0.2'||$version->getStatus()!=='published')throw new RuntimeException('Existing owner changed');
    $proof=['success'=>true,'readOnly'=>true,'resolver'=>'findStandardProgramVersionByEntity','parentBaselineSha256'=>$baseline,
        'owners'=>['container_versoes_custo_progress'=>['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus()]],
        'catalogWrites'=>false,'businessWrites'=>false];
    $handle=fopen($output,'x');if($handle===false)throw new RuntimeException('Existing proof must be preserved');
    fwrite($handle,json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);fclose($handle);
    echo "PASS native owner op1005/version107/1.0.2; no grants or writes\n";
}finally{$kernel->shutdown();}
