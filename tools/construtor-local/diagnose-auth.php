<?php
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$em=$kernel->getContainer()->get('doctrine')->getManager();
foreach($em->getRepository(App\Entity\AuthProviderConfig::class)->findAll() as $provider){
 $settings=$provider->getConfig();
 echo json_encode(['provider'=>$provider->getCode(),'type'=>$provider->getType(),'enabled'=>$provider->isEnabled(),
  'settings'=>array_intersect_key($settings,array_flip(['host','port','encryption','baseDn','usernameAttribute','userDnPattern']))],JSON_UNESCAPED_SLASHES).PHP_EOL;
}
$user=$em->getRepository(App\Entity\AuthUser::class)->findOneBy(['tenantId'=>'default','username'=>'tadeu.parreiras']);
echo json_encode(['userExists'=>$user!==null,'authSource'=>$user?->getAuthSource(),'ldapExtension'=>extension_loaded('ldap')]).PHP_EOL;
