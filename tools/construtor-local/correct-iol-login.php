<?php
// Correct only the task-owned local identity to the IOL login supplied by the user.
$backend='D:/opencode/construtor-pg/backend';require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();
$file=dirname(__DIR__,2).'/.runtime/iol-gerencial/acesso-local-tadeu.json';$access=json_decode(file_get_contents($file),true,512,JSON_THROW_ON_ERROR);
if($access['username']==='tasilpar'){echo "Login ja corrigido.\n";exit;}
$user=$em->getRepository(App\Entity\AuthUser::class)->findOneBy(['tenantId'=>'default','normalizedUsername'=>'tadeu.parreiras']);
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->findOneBy(['userTenantId'=>'default','username'=>'tadeu.parreiras','subscriberCode'=>'default']);
if(!$user || !$link || ($link->getMetadata()['source']??null)!=='iol-panel-user-authorized' || !password_verify($access['password'],$user->getPasswordHash()) || $em->getRepository(App\Entity\AuthUser::class)->findOneBy(['tenantId'=>'default','normalizedUsername'=>'tasilpar']))throw new RuntimeException('Identidade divergente; nenhuma alteracao.');
$application=new Symfony\Bundle\FrameworkBundle\Console\Application($kernel);$command=$application->find('app:subscriber:create');if($command instanceof Symfony\Component\Console\Command\LazyCommand)$command=$command->getCommand();
$integrity=(new ReflectionProperty($command,'integrity'))->getValue($command);
$em->wrapInTransaction(function($em)use($user,$link,$integrity){$user->setUsername('tasilpar');$link->setUsername('tasilpar');$integrity->signAuthUserSubscriber($link,['source'=>'iol-login-correction-user-authorized']);$em->flush();});
$access['username']='tasilpar';file_put_contents($file,json_encode($access,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
echo "Login local corrigido para tasilpar; senha e permissoes restritas preservadas.\n";
