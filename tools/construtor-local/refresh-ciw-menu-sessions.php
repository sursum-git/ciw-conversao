<?php
// Atualiza somente snapshots de leitura ja autorizados nas sessoes LDAP desta conta.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-menu-access-20261020';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');
$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/sessions-refreshed.json'),'Atualizacao ja registrada; nao repetir');
$plan=json_decode(file_get_contents($state.'/plan.json'),true,512,JSON_THROW_ON_ERROR);$grants=$plan['grants'];
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->find($plan['linkId']);
$require($link&&$link->isEnabled()&&$link->getUsername()==='tadeu.parreiras'&&$link->getUserTenantId()==='default'&&$link->getSubscriberCode()==='default'&&$link->getPermissionOverrides()===$grants,'Vinculo divergente');
$builderController=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($builderController,'builder'))->getValue($builderController);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);$integrity->assertAuthUserSubscriber($link);
$authController=$k->getContainer()->get(App\Controller\AuthController::class);$auth=(new ReflectionProperty($authController,'auth'))->getValue($authController);
$require($auth->listProviders()['subscriberSelection']['enabled']===false,'Modo assinante mudou');
$resolve=new ReflectionMethod($auth,'resolveUserPermissionsForContext');
$db->beginTransaction();
try{
 $rows=$db->fetchAllAssociative("SELECT id,permission_snapshot FROM runtime_user_session WHERE tenant_id='default' AND user_id='tadeu.parreiras' AND status='active' AND session_properties->'authentication'->>'provider'='ldap' ORDER BY id FOR UPDATE");
 $require(count($rows)>0,'Nenhuma sessao LDAP ativa');
 $protected=$db->fetchAllAssociative('SELECT id,status,md5(session_properties::text) AS properties_digest FROM runtime_user_session ORDER BY id');
 $backup=[];$updated=[];
 foreach($rows as $row){
  $before=json_decode($row['permission_snapshot'],true,512,JSON_THROW_ON_ERROR);
  $require(($before['permissions']??null)===[]&&($before['user']['permissions']??null)===[],'Snapshot ja possui permissoes; revisar antes de atualizar');
  $user=new App\Auth\AuthenticatedUser('default','tadeu.parreiras','tadeu.parreiras',$before['user']['name']??'Tadeu Parreiras',$before['user']['email']??null,$before['groups']??[],[],'ldap');
  $resolved=$resolve->invoke($auth,$user,['enabled'=>false]);$require($resolved->getPermissions()===$grants,'Login real nao resolveu os 28 acessos esperados');
  $after=$before;$after['permissions']=$resolved->getPermissions();$after['user']['permissions']=$resolved->getPermissions();
  $count=$db->executeStatement('UPDATE runtime_user_session SET permission_snapshot=? WHERE id=? AND permission_snapshot::jsonb=CAST(? AS jsonb)',[json_encode($after,$flags),$row['id'],json_encode($before,$flags)]);
  $require($count===1,'Snapshot concorrente');$backup[]=['id'=>$row['id'],'before'=>$before];$updated[]=$row['id'];
  $check=json_decode($db->fetchOne('SELECT permission_snapshot FROM runtime_user_session WHERE id=?',[$row['id']]),true,512,JSON_THROW_ON_ERROR);$require($check===$after,'Snapshot persistido divergente');
 }
 $require($db->fetchAllAssociative('SELECT id,status,md5(session_properties::text) AS properties_digest FROM runtime_user_session ORDER BY id')===$protected,'Propriedades de autenticacao/status alteradas');
 $stream=fopen($state.'/sessions-before.json','x');$require($stream!==false,'Backup ja existe');fwrite($stream,json_encode($backup,$flags|JSON_PRETTY_PRINT));fclose($stream);
 $db->commit();
 file_put_contents($state.'/sessions-refreshed.json',json_encode(['username'=>'tadeu.parreiras','tenant'=>'default','provider'=>'ldap','sessionRecordIds'=>$updated,'permissionCount'=>count($grants),'authPropertiesAndStatusPreserved'=>true,'nativeLoginResolverValidated'=>true,'appliedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
 echo 'PASS: '.count($updated)." sessoes LDAP atualizadas com28read autorizadas; autenticacao/status preservados.\n";
}catch(Throwable $e){if($db->isTransactionActive())$db->rollBack();throw $e;}
