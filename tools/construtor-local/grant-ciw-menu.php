<?php
// Liberacao de consulta CIW solicitada para uma unica conta; sem curingas/escrita.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-menu-access-20261020';
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
$hash=fn($v)=>hash('sha256',json_encode($v,$flags));
$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$user=$em->getRepository(App\Entity\AuthUser::class)->findOneByTenantAndUsername('default','tadeu.parreiras');
$require($user&&$user->getAuthSource()==='ldap'&&$user->getStatus()==='active','Conta LDAP ativa nao encontrada');
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->findOneBy(['userTenantId'=>'default','username'=>'tadeu.parreiras','subscriberCode'=>'default']);
$require($link&&$link->isEnabled(),'Vinculo Principal ativo nao encontrado');$integrity->assertAuthUserSubscriber($link);
$screens=$em->getRepository(App\Entity\ScreenDefinition::class)->createQueryBuilder('s')->where('s.screenId LIKE :prefix')->setParameter('prefix','ciw.%')->orderBy('s.screenId','ASC')->getQuery()->getResult();
$require(count($screens)===28,'Catalogo CIW mudou; revisar antes de liberar');
$grants=[];$catalog=[];
foreach($screens as $screen){
 $integrity->assertScreen($screen);$d=$screen->getDefinition();$p=$d['program']['permission']??'';
 $require($screen->getStatus()==='published'&&is_string($p)&&preg_match('/^[a-z0-9_]+\.read$/D',$p),'Tela fora do contrato de leitura: '.$screen->getScreenId());
 $require(!str_contains(strtolower(json_encode($d,$flags)),'conta corrente fornecedor'),'Programa excluido encontrado');
 $grants[$p]=true;$catalog[]=['screenId'=>$screen->getScreenId(),'permission'=>$p,'definitionSha256'=>$hash($d)];
}
ksort($grants);
$home=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>'home']);$integrity->assertScreen($home);
$homeDefinition=$home->getDefinition();$menu=array_values(array_filter($homeDefinition['programs'],fn($p)=>($p['moduleId']??null)==='ciw'));
$require(count($menu)===13,'Menu CIW mudou');foreach($menu as $p)$require(isset($grants[$p['permission']]),'Atalho sem permissao de leitura');
$otherHash=function()use($db,$hash,$link){return $hash([
 $db->fetchAllAssociative('SELECT id,tenant_id,username,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,code,type,enabled,config FROM auth_provider_config ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,enabled,permission_overrides,metadata FROM auth_user_subscriber WHERE id<>? ORDER BY id',[$link->getId()]),
 $db->fetchAllAssociative('SELECT id FROM program_change_grant ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,screen_id,definition FROM screen_definition ORDER BY id')
]);};
$mode=$argv[1]??'prepare';
if($mode==='prepare'){
 $require(!file_exists($state.'/plan.json'),'Plano ja existe; nao sobrescrever');if(!is_dir($state))mkdir($state,0700,true);
 $plan=['username'=>'tadeu.parreiras','tenant'=>'default','linkId'=>$link->getId(),'before'=>$link->getPermissionOverrides(),'otherHash'=>$otherHash(),'catalog'=>$catalog,'grants'=>$grants,'directLinks'=>13];
 file_put_contents($state.'/plan.json',json_encode($plan,$flags|JSON_PRETTY_PRINT));
 echo 'PREPARED: '.count($screens).' telas, '.count($grants)." permissoes read e 13 atalhos; nenhuma alteracao.\n";exit;
}
$plan=json_decode(file_get_contents($state.'/plan.json'),true,512,JSON_THROW_ON_ERROR);
$require($plan['catalog']===$catalog&&$plan['grants']===$grants&&$plan['linkId']===$link->getId(),'Plano divergente');
$expected=array_replace($plan['before'],$grants);
if($mode==='apply'){
 $require(!file_exists($state.'/applied.json'),'Aplicacao ja registrada; nao repetir');
 $em->wrapInTransaction(function($em)use($db,$link,$plan,$expected,$require,$otherHash,$integrity){
  $em->lock($link,Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);$em->refresh($link);
  $require($link->getPermissionOverrides()===$plan['before']&&$otherHash()===$plan['otherHash'],'Baseline concorrente');
  $link->setPermissionOverrides($expected);$integrity->signAuthUserSubscriber($link,['source'=>'explicit-ciw-menu-read-tadeu-20261020']);$em->flush();
  $integrity->assertAuthUserSubscriber($link);$require($otherHash()===$plan['otherHash'],'Outros acessos alterados; rollback');
 });
 file_put_contents($state.'/applied.json',json_encode(['username'=>'tadeu.parreiras','tenant'=>'default','readPermissions'=>array_keys($grants),'otherAccessesPreserved'=>true,'integrityValidated'=>true,'sessionsChanged'=>false,'appliedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
}else{$require(in_array($mode,['verify','check'],true),'Modo invalido');}
$require($link->getPermissionOverrides()===($mode==='check'?$plan['before']:$expected),'Permissoes persistidas divergentes');$integrity->assertAuthUserSubscriber($link);
$require($otherHash()===$plan['otherHash'],'Outros acessos divergentes');
// Resolver nativo em memoria: nenhum token/sessao humana e nenhum endpoint de negocio.
$request=new Symfony\Component\HttpFoundation\Request();$request->headers->set('X-Runtime-Permissions',implode(',',array_keys($grants)));$request->headers->set('X-Runtime-Groups','ciw-reader');
$stack=new Symfony\Component\HttpFoundation\RequestStack();$stack->push($request);$resolver=new App\Runtime\PermissionResolver($stack);
$filtered=$resolver->applyDefinitionPermissions($homeDefinition);
$visible=array_values(array_filter($filtered['programs'],fn($p)=>($p['moduleId']??null)==='ciw'));
$require(count($visible)===13&&count($filtered['programs'])===13,'Filtro Home nao restringiu aos 13 atalhos CIW');
foreach($screens as $screen){$require($resolver->canReadScreen($screen),'Tela negada: '.$screen->getScreenId());$d=$resolver->applyDefinitionPermissions($screen->getDefinition());foreach(['create','update','delete','execute','admin']as $action)$require(empty($d['permissions'][$action]),'Acao indevida: '.$action);}
foreach(array_keys($grants)as $p)foreach(['create','update','delete','execute']as $action)$require(!$resolver->hasPermission(substr($p,0,-4).$action),'Permissao indevida');
$require(!$resolver->hasPermission('admin')&&!$resolver->hasPermission('*'),'Acesso administrativo indevido');
if($mode==='check'){echo "PASS preflight: 28 leituras e 13 atalhos CIW; escrita/admin recusados. Nenhuma alteracao.\n";exit;}
file_put_contents($state.'/validation.json',json_encode(['persisted'=>true,'nativeIntegrity'=>true,'nativePermissionResolver'=>true,'readScreens'=>28,'visibleHomeLinks'=>13,'writePermissionsGranted'=>false,'otherAccessesPreserved'=>true,'humanReloginRequired'=>true],$flags|JSON_PRETTY_PRINT));
echo "PASS: vinculo assinado; 28 telas em consulta, 13 atalhos CIW; sem escrita/admin; demais acessos preservados. Novo login necessario.\n";
