<?php
// Configura somente largura do menu da Home local, por metadados assinados.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/home-sidebar-width-20261020';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/home-configured.json'),'Configuracao ja aplicada; nao repetir');
$controller=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$home=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>'home']);
$protected=function()use($db,$flags,$home){return hash('sha256',json_encode([
 $db->fetchAllAssociative('SELECT id,permissions,groups,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,permission_overrides FROM auth_user_subscriber ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,definition FROM screen_definition WHERE id<>? ORDER BY id',[$home->getId()])
],$flags));};
$config=['width'=>320,'autoWidth'=>true,'maxWidth'=>480];
$em->wrapInTransaction(function($em)use($home,$integrity,$protected,$require,$state,$flags,$config){
 $em->lock($home,Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);$em->refresh($home);$integrity->assertScreen($home);$guard=$protected();$before=$home->getDefinition();$after=$before;
 foreach($config as $key=>$value){$require(!array_key_exists($key,$before['layout']['sidebar']),'Configuracao concorrente');$after['layout']['sidebar'][$key]=$value;}
 $check=$after;foreach(array_keys($config)as $key)unset($check['layout']['sidebar'][$key]);$require($check===$before,'Delta fora de largura do menu');
 $f=fopen($state.'/home-before.json','x');$require($f!==false,'Backup existente');fwrite($f,json_encode($before,$flags|JSON_PRETTY_PRINT));fclose($f);
 $home->setDefinition($after);$integrity->signScreen($home,['source'=>'home-sidebar-width-approved-20261020']);$em->flush();$integrity->assertScreen($home);$require($protected()===$guard,'Outros acessos/telas alterados');
});
file_put_contents($state.'/home-configured.json',json_encode(['screenId'=>'home','sidebar'=>$config,'nativeIntegrityValidated'=>true,'otherDefinitionsAndPermissionsPreserved'=>true,'configuredAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
echo "PASS: Home assinada com width320/autoWidth/maxWidth480; acessos e demais metadados preservados.\n";
