<?php
// Leitura delimitada: Home bruta para backup privado e resumo das telas CIW.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-menu-20261020';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();
$repo=$em->getRepository(App\Entity\ScreenDefinition::class);$home=$repo->findOneBy(['screenId'=>'home']);
if(!$home||$home->getStatus()!=='published'||$home->getPageType()!=='home')throw new RuntimeException('Home publicada ausente');
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$integrity->assertScreen($home);
$definition=$home->getDefinition();$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
if(!is_dir($state))mkdir($state,0700,true);
if(file_exists($state.'/home-before.json'))throw new RuntimeException('Baseline ja capturada; nao substituir');
file_put_contents($state.'/home-before.json',json_encode($definition,$flags|JSON_PRETTY_PRINT));
file_put_contents($state.'/baseline.json',json_encode(['id'=>$home->getId(),'version'=>$home->getVersion(),'sha256'=>hash('sha256',json_encode($definition,$flags))],$flags|JSON_PRETTY_PRINT));
$screens=[];
foreach($repo->findBy(['status'=>'published']) as $screen){
 if(!str_starts_with($screen->getScreenId(),'ciw.'))continue;
 $integrity->assertScreen($screen);$d=$screen->getDefinition();
 $screens[]=['screenId'=>$screen->getScreenId(),'pageType'=>$screen->getPageType(),'version'=>$screen->getVersion(),'program'=>$d['program']??[],
 'security'=>$d['security']??[],'permissions'=>$d['permissions']??[],
 'contextFields'=>$d['contextFields']??($d['crud']['contextFields']??[]),'tabs'=>array_map(fn($t)=>array_intersect_key($t,array_flip(['id','title','type','screenId','entity','context','contextFields'])),$d['crud']['form']['tabs']??[])];
}
file_put_contents($state.'/screens-summary.json',json_encode($screens,$flags|JSON_PRETTY_PRINT));
echo json_encode(['homeId'=>$home->getId(),'modules'=>$definition['navigation']['modules']??[],'screens'=>$screens],$flags|JSON_PRETTY_PRINT).PHP_EOL;
