<?php
// Preparação somente leitura por padrão. Aplicação exige autorização humana específica ainda não recebida.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-completion-20261028/wave2-aux-access';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/applied.json'),'Aplicacao ja registrada');if(!is_dir($state))mkdir($state,0700,true);
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->findOneBy(['userTenantId'=>'default','username'=>'tadeu.parreiras','subscriberCode'=>'default']);$require($link&&$link->isEnabled(),'Vinculo ausente');
$controller=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$authController=$k->getContainer()->get(App\Controller\AuthController::class);$auth=(new ReflectionProperty($authController,'auth'))->getValue($authController);$resolve=new ReflectionMethod($auth,'resolveUserPermissionsForContext');
$add=['container_versao_pagtos_historico_med_progress.read'=>true,'container_versao_nfs_historico_med_progress.read'=>true,'container_versao_descontos_historico_med_progress.read'=>true,'container_versao_despesas_historico_med_progress.read'=>true];$screens=[];
foreach(['ciw.container-versao-pagamentos-historico','ciw.container-versao-nfs-historico','ciw.container-versao-descontos-historico','ciw.container-versao-despesas-historico']as $screenId){
 $screen=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>$screenId,'status'=>'published']);$require($screen!==null,'Tela de auditoria ausente');$integrity->assertScreen($screen);$screens[$screenId]=$screen;
}
if(($argv[1]??'prepare')==='prepare'){echo json_encode(['permissionsToAdd'=>array_keys($add)],$flags).PHP_EOL;exit;}

$authorization=json_decode(file_get_contents($state.'/authorization.json'),true,512,JSON_THROW_ON_ERROR);
$require(($argv[1]??'prepare')==='apply'&&$authorization['authorized']===true&&$authorization['consumed']===false&&$authorization['user']==='tadeu.parreiras'&&$authorization['permissions']===array_keys($add)&&is_string($authorization['humanApprovalReference']??null)&&strlen($authorization['humanApprovalReference'])>0,'Autorização específica pendente');
$attempt=fopen($state.'/apply-attempt.json','x');$require($attempt!==false,'Tentativa anterior: inspecionar antes de repetir');fwrite($attempt,json_encode(['at'=>date(DATE_ATOM),'permissions'=>array_keys($add),'outcome'=>'unknown_until_verified'],$flags));fclose($attempt);

$protected=function()use($db,$flags,$link){return hash('sha256',json_encode([
 $db->fetchAllAssociative('SELECT id,permissions,groups,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,permission_overrides FROM auth_user_subscriber WHERE id<>? ORDER BY id',[$link->getId()]),
 $db->fetchAllAssociative('SELECT id,definition FROM screen_definition ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,status,md5(session_properties::text) AS properties_digest FROM runtime_user_session ORDER BY id')
],$flags));};
$candidate=array_replace($link->getPermissionOverrides(),$add);ksort($candidate);
$request=new Symfony\Component\HttpFoundation\Request();$request->headers->set('X-Runtime-Groups','ciw-user');$request->headers->set('X-Runtime-Permissions',implode(',',array_keys(array_filter($candidate,fn($v)=>$v===true))));
$stack=new Symfony\Component\HttpFoundation\RequestStack();$stack->push($request);$permissions=new App\Runtime\PermissionResolver($stack);
foreach($screens as $screen){$require($permissions->canReadScreen($screen),'Tela indisponivel');$d=$permissions->applyDefinitionPermissions(array_replace($screen->getDefinition(),['screenId'=>$screen->getScreenId()]));$require(($d['permissions']['read']??false)===true,'Leitura de auditoria indisponivel');}
$require(!$permissions->hasPermission('containers_progress.create')&&!$permissions->hasPermission('admin')&&!$permissions->hasPermission('*'),'Acesso fora do escopo');
$backup=[];$ids=[];
$em->wrapInTransaction(function($em)use($db,$link,$integrity,$protected,$add,$require,$state,$flags,$resolve,$auth,&$backup,&$ids){
 $em->lock($link,Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);$em->refresh($link);$integrity->assertAuthUserSubscriber($link);$guard=$protected();$before=$link->getPermissionOverrides();
 $require(($before['despesas_progress.read']??false)===true,'Leitura ausente');foreach($add as $p=>$v)$require(!array_key_exists($p,$before),'Concessao concorrente');
 $expected=array_replace($before,$add);ksort($expected);$link->setPermissionOverrides($expected);$integrity->signAuthUserSubscriber($link,['source'=>'explicit-ciw-completion-wave2-aux-reads-20261028']);$em->flush();$integrity->assertAuthUserSubscriber($link);
 $rows=$db->fetchAllAssociative("SELECT id,permission_snapshot FROM runtime_user_session WHERE tenant_id='default' AND user_id='tadeu.parreiras' AND status='active' AND session_properties->'authentication'->>'provider'='ldap' ORDER BY id FOR UPDATE");
 foreach($rows as $row){
  $old=json_decode($row['permission_snapshot'],true,512,JSON_THROW_ON_ERROR);$require(($old['permissions']??null)===$before&&($old['user']['permissions']??null)===$before,'Snapshot concorrente');
  $user=new App\Auth\AuthenticatedUser('default','tadeu.parreiras','tadeu.parreiras',$old['user']['name']??'Tadeu Parreiras',$old['user']['email']??null,$old['groups']??[],$before,'ldap');
  $resolved=$resolve->invoke($auth,$user,['enabled'=>false]);$require($resolved->getPermissions()===$expected,'Resolucao divergente');$new=$old;$new['permissions']=$resolved->getPermissions();$new['user']['permissions']=$resolved->getPermissions();
  $count=$db->executeStatement('UPDATE runtime_user_session SET permission_snapshot=? WHERE id=? AND permission_snapshot::jsonb=CAST(? AS jsonb)',[json_encode($new,$flags),$row['id'],json_encode($old,$flags)]);$require($count===1,'Sessao concorrente');$backup[]=['id'=>$row['id'],'before'=>$old];$ids[]=$row['id'];
 }
 $require($protected()===$guard,'Outros acessos/metadados/auth alterados');
 $f=fopen($state.'/before.json','x');$require($f!==false,'Backup existente');fwrite($f,json_encode(['linkId'=>$link->getId(),'permissionOverrides'=>$before,'sessions'=>$backup],$flags|JSON_PRETTY_PRINT));fclose($f);
});
file_put_contents($state.'/applied.json',json_encode(['user'=>'tadeu.parreiras','tenant'=>'default','permissionsAdded'=>$add,'sessions'=>$ids,'nativeIntegrity'=>true,'otherAccessesPreserved'=>true,'businessWritesExecuted'=>false,'appliedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
$authorization['authorized']=false;$authorization['consumed']=true;$authorization['consumedAt']=date(DATE_ATOM);file_put_contents($state.'/authorization.json',json_encode($authorization,$flags|JSON_PRETTY_PRINT));
echo "PASS somente4reads autorizadas, assinatura e snapshotsLDAP preservados; gate consumido; sem gravação comercial.\n";
