<?php
// Sair encerra a propria sessao; nao depende de permissao de negocio.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/home-logout-20261020';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/applied.json'),'Correcao ja registrada');if(!is_dir($state))mkdir($state,0700,true);
$controller=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$home=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>'home']);
$protected=function()use($db,$flags,$home){return hash('sha256',json_encode([
 $db->fetchAllAssociative('SELECT id,permissions,groups,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,permission_overrides FROM auth_user_subscriber ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,definition FROM screen_definition WHERE id<>? ORDER BY id',[$home->getId()])
],$flags));};
$request=new Symfony\Component\HttpFoundation\Request();$request->headers->set('X-Runtime-Groups','usuario-sem-permissoes');$stack=new Symfony\Component\HttpFoundation\RequestStack();$stack->push($request);$resolver=new App\Runtime\PermissionResolver($stack);
$logoutItems=fn($d)=>array_values(array_filter($d['layout']['appbar']['userMenu']['items'],fn($i)=>($i['action']??$i['id']??'')==='logout'));
$em->wrapInTransaction(function($em)use($home,$integrity,$protected,$require,$state,$flags,$resolver,$logoutItems){
 $em->lock($home,Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);$em->refresh($home);$integrity->assertScreen($home);$guard=$protected();$before=$home->getDefinition();$after=$before;
 $require(count($logoutItems($resolver->applyDefinitionPermissions($before)))===0,'Falha nao reproduzida');$changed=[];
 foreach($after['layout']['appbar']['userMenu']['items']as $index=>&$item){
  if(($item['action']??$item['id']??'')!=='logout')continue;
  $require(($item['permission']??'')==='user.logout'&&!isset($item['url'])&&$item['label']==='Sair','Acao sair divergente');unset($item['permission']);$changed[]=$index;
 }unset($item);
 $require(count($changed)===1,'Mais de uma acao sair');$check=$after;$check['layout']['appbar']['userMenu']['items'][$changed[0]]['permission']='user.logout';$require($check===$before,'Delta fora da visibilidade de Sair');
 $require(count($logoutItems($resolver->applyDefinitionPermissions($after)))===1,'Sair continua oculto');
 $f=fopen($state.'/home-before.json','x');$require($f!==false,'Backup existente');fwrite($f,json_encode($before,$flags|JSON_PRETTY_PRINT));fclose($f);
 $home->setDefinition($after);$integrity->signScreen($home,['source'=>'home-logout-visibility-fix-20261020']);$em->flush();$integrity->assertScreen($home);$require($protected()===$guard,'Outros acessos alterados');
});
file_put_contents($state.'/applied.json',json_encode(['logoutVisibleWithoutBusinessPermissions'=>true,'existingLogoutActionPreserved'=>true,'accessGrantsChanged'=>false,'nativeIntegrityValidated'=>true,'fixedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
echo "PASS: Sair visivel sem permissoes de negocio; acao nativa preservada, Home assinada e nenhum acesso concedido.\n";
