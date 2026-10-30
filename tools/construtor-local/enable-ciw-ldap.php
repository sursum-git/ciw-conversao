<?php
// LDAP389 semTLS autorizado explicitamente pelo usuario; conta unica, sem grantsCIW.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-ldap-20261020';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
if(!extension_loaded('ldap'))throw new RuntimeException('Extensao LDAP deve estar carregada');
if(file_exists($state.'/activation.json'))throw new RuntimeException('Ativacao ja registrada; nao repetir');
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$provider=$em->getRepository(App\Entity\AuthProviderConfig::class)->findOneBy(['code'=>'ldap']);
if(!$provider||$provider->getType()!=='ldap'||$provider->isEnabled()||trim($provider->getConfig()['host']??'')!=='')throw new RuntimeException('Provedor divergente; nenhuma substituicao');
$integrity->assertAuthProvider($provider);
$userRepo=$em->getRepository(App\Entity\AuthUser::class);$linkRepo=$em->getRepository(App\Entity\AuthUserSubscriber::class);
if($userRepo->findOneByTenantAndUsername('default','tadeu.parreiras')||$linkRepo->findOneBy(['userTenantId'=>'default','username'=>'tadeu.parreiras']))throw new RuntimeException('Conta existente; nao substituir');
$subscriber=$em->getRepository(App\Entity\AuthSubscriber::class)->findOneBy(['code'=>'default','enabled'=>true]);
if(!$subscriber)throw new RuntimeException('Assinante Principal inativo');
$settings=['host'=>'192.168.0.61','port'=>389,'baseDn'=>'DC=ima,DC=com,DC=br','usernameAttribute'=>'sAMAccountName','userDnPattern'=>'IMA\\{username}','encryption'=>'none','displayNameAttribute'=>'displayName','emailAttribute'=>'mail','groupsAttribute'=>'memberOf','tenantId'=>'default','permissions'=>[]];
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE;
$othersHash=function()use($db,$flags):string{return hash('sha256',json_encode([
 $db->fetchAllAssociative("SELECT id,code,type,enabled,config FROM auth_provider_config WHERE code<>'ldap' ORDER BY id"),
 $db->fetchAllAssociative("SELECT id,tenant_id,username,status,groups,permissions,auth_source FROM auth_user WHERE normalized_username<>'tadeu.parreiras' ORDER BY id"),
 $db->fetchAllAssociative("SELECT id,enabled,permission_overrides FROM auth_user_subscriber WHERE username<>'tadeu.parreiras' ORDER BY id"),
 $db->fetchAllAssociative('SELECT id FROM program_change_grant ORDER BY id')],$flags));};
$backup=['providerId'=>$provider->getId(),'enabled'=>$provider->isEnabled(),'config'=>$provider->getConfig(),'name'=>$provider->getName(),'priority'=>$provider->getPriority(),'userExisted'=>false,'linkExisted'=>false];
$stream=fopen($state.'/activation-before.json','x');if(!$stream)throw new RuntimeException('Baseline existente');fwrite($stream,json_encode($backup,$flags|JSON_PRETTY_PRINT));fclose($stream);
$before=$othersHash();
$em->wrapInTransaction(function($em)use($provider,$settings,$integrity,$before,$othersHash){
 $provider->setConfig($settings)->setEnabled(true);$integrity->signAuthProvider($provider,['source'=>'ciw-ldap-389-user-authorized-20261020']);
 $user=(new App\Entity\AuthUser())->setTenantId('default')->setUsername('tadeu.parreiras')->setDisplayName('Tadeu Parreiras')->setPasswordHash(null)->setStatus('active')->setGroups([])->setPermissions([])->setAuthSource('ldap')->setForcePasswordChange(false);
 $link=(new App\Entity\AuthUserSubscriber())->setUserTenantId('default')->setUsername('tadeu.parreiras')->setSubscriberCode('default')->setDefaultSubscriber(true)->setEnabled(true)->setPermissionOverrides([])->setMetadata(['source'=>'ciw-ldap-389-user-authorized-20261020']);
 $em->persist($user);$em->persist($link);$em->flush();$integrity->signAuthUserSubscriber($link,['source'=>'ciw-ldap-389-user-authorized-20261020']);$em->flush();
 $integrity->assertAuthProvider($provider);$integrity->assertAuthUserSubscriber($link);
 if($othersHash()!==$before)throw new RuntimeException('Outros acessos divergentes; rollback');
});
file_put_contents($state.'/activation.json',json_encode(['enabled'=>true,'provider'=>'ldap','host'=>'192.168.0.61','port'=>389,'encryption'=>'none','username'=>'tadeu.parreiras','tenantId'=>'default','passwordStored'=>false,'businessGrantsAdded'=>false,'otherAccessesPreserved'=>true,'integrityValidated'=>true,'humanLoginValidated'=>false,'activatedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
echo "PASS: LDAP389 habilitado para tadeu.parreiras; sem senha local ou grantsCIW; demais acessos preservados.\n";
