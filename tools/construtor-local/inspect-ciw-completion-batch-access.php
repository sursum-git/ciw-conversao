<?php
declare(strict_types=1);
// Read-only: list only missing permissions needed by the new batch screen.
$root=dirname(__DIR__,2);$backend='D:/opencode/construtor-pg/backend';require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->findOneBy(['userTenantId'=>'default','username'=>'tadeu.parreiras','subscriberCode'=>'default']);
if(!$link||!$link->isEnabled())throw new RuntimeException('Named user unavailable');
$required=['container_despesas_lote_progress.read','container_despesas_lote_progress.edit','container_despesas_lote_progress.delete'];$permissions=$link->getPermissionOverrides();$missing=[];
foreach($required as $name)if(($permissions[$name]??false)!==true)$missing[]=$name;
$proof=['success'=>true,'user'=>'tadeu.parreiras','required'=>$required,'missing'=>$missing,'grantsApplied'=>false,'businessWrites'=>false];
file_put_contents($root.'/.runtime/ciw-completion-20261028/container-expense-batch-preflight/access-prerequisite.json',json_encode($proof,JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT));
echo 'PASS readonly batch access prerequisite; missing='.count($missing).'; no grant executed.'.PHP_EOL;
