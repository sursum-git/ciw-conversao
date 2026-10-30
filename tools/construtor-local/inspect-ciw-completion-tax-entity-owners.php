<?php
// Read-only native governance owner resolution. Never changes policy or grants.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
$governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
$resolve=new ReflectionMethod($governance,'findStandardProgramVersionByEntity');
$owners=[];
foreach(['container_processos_progress','container_despesas_progress']as$entity){
 $version=$resolve->invoke($governance,$entity);
 if(!$version)throw new RuntimeException('Published standard owner missing');
 $owners[$entity]=['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus()];
}
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT;
file_put_contents(dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/official-build6-v2/tax-only-metadata/native-governance-owners.json',json_encode(['success'=>true,'owners'=>$owners,'readOnly'=>true],$flags).PHP_EOL);
echo json_encode(['success'=>true,'owners'=>$owners,'readOnly'=>true],$flags).PHP_EOL;
