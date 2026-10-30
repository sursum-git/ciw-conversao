<?php
// Authorized local identity only. Never prints the generated password.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$container=$kernel->getContainer();$em=$container->get('doctrine')->getManager();
$username='tadeu.parreiras';
$file=dirname(__DIR__,2).'/.runtime/iol-gerencial/acesso-local-tadeu.json';
$permissions=['iol.inicial-gerencial.read'=>true,'iol_gerencial_resumo_progress.read'=>true,'iol_gerencial_vendedores_progress.read'=>true];
$existing=$em->getRepository(App\Entity\AuthUser::class)->findOneBy(['tenantId'=>'default','normalizedUsername'=>$username]);
if($existing){
 if($existing->getPermissions()!==$permissions || !is_file($file))throw new RuntimeException('Usuario ja existe; nenhuma credencial ou permissao foi substituida.');
 echo "Usuario IOL restrito ja provisionado; sem alteracao.\n";exit;
}
// Reuse the current container's integrity service through its already registered command.
$application=new Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
$command=$application->find('app:subscriber:create');
if($command instanceof Symfony\Component\Console\Command\LazyCommand)$command=$command->getCommand();
if(!$command instanceof App\Command\CreateSubscriberCommand)throw new RuntimeException('Servico de integridade indisponivel.');
$integrity=(new ReflectionProperty($command,'integrity'))->getValue($command);
$password=bin2hex(random_bytes(18)).'aA1!';
$stream=fopen($file,'x');if(!$stream)throw new RuntimeException('Arquivo privado ja existe.');
fwrite($stream,json_encode(['username'=>$username,'tenantId'=>'default','password'=>$password,'loginUrl'=>'http://127.0.0.1:8765/production/login.html','panelUrl'=>'http://127.0.0.1:8765/production/app.html?screenId=iol.inicial-gerencial'],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));fclose($stream);
try {
 $em->wrapInTransaction(function($em)use($username,$password,$permissions,$integrity){
  $user=(new App\Entity\AuthUser())->setTenantId('default')->setUsername($username)->setDisplayName('Tadeu Parreiras')->setPasswordHash(password_hash($password,PASSWORD_DEFAULT))->setStatus('active')->setGroups([])->setPermissions($permissions)->setAuthSource('local')->setForcePasswordChange(true);
  $link=(new App\Entity\AuthUserSubscriber())->setUserTenantId('default')->setUsername($username)->setSubscriberCode('default')->setDefaultSubscriber(true)->setEnabled(true)->setPermissionOverrides([])->setMetadata(['source'=>'iol-panel-user-authorized']);
  $em->persist($user);$em->persist($link);$em->flush();
  $integrity->signAuthUserSubscriber($link,['source'=>'iol-panel-user-authorized']);$em->flush();
 });
}catch(Throwable $error){unlink($file);throw $error;}
$password=null;
echo "Criado tadeu.parreiras: somente leitura do painel e suas duas fontes. Credencial em arquivo privado.\n";
