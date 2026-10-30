<?php
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-menu-access-20261020';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$k=new App\Kernel('dev',false);$k->boot();$em=$k->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;$require=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/home-references-fixed.json'),'Correcao ja registrada; nao repetir');
$controller=$k->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$home=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>'home']);
$protected=function()use($db,$flags,$home){return hash('sha256',json_encode([
 $db->fetchAllAssociative('SELECT id,tenant_id,username,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,permission_overrides FROM auth_user_subscriber ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,definition FROM screen_definition WHERE id<>? ORDER BY id',[$home->getId()])
],$flags));};
$em->wrapInTransaction(function($em)use($home,$integrity,$protected,$require,$state,$flags){
 $em->lock($home,Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);$em->refresh($home);$integrity->assertScreen($home);$guard=$protected();$before=$home->getDefinition();$after=$before;$added=[];
 foreach($before['programs'] as $program){
  if(($program['moduleId']??'')!=='ciw')continue;$permission=$program['permission'];
  $require(preg_match('/^[a-z0-9_]+\.read$/D',$permission)&&!array_key_exists($permission,$before['permissions']),'Referencia existente ou nao leitura');
  $after['permissions'][$permission]=$permission;$added[]=$permission;
 }
 $require(count($added)===13,'Escopo CIW divergente');
 $check=$after;foreach($added as $p)unset($check['permissions'][$p]);$require($check===$before,'Delta fora das referencias CIW');
 $backup=fopen($state.'/home-references-before.json','x');$require($backup!==false,'Backup ja existe');fwrite($backup,json_encode($before,$flags|JSON_PRETTY_PRINT));fclose($backup);
 $home->setDefinition($after);$integrity->signScreen($home,['source'=>'ciw-home-permission-references-fix-20261020']);$em->flush();$integrity->assertScreen($home);$require($protected()===$guard,'Outras telas/acessos alterados');
});
file_put_contents($state.'/home-references-fixed.json',json_encode(['screenId'=>'home','permissionReferencesAdded'=>13,'nativeIntegrityValidated'=>true,'otherDefinitionsAndAccessesPreserved'=>true,'fixedAt'=>date(DATE_ATOM)],$flags|JSON_PRETTY_PRINT));
echo "PASS: 13 referencias CIW declaradas e assinadas; sem nova concessao ou alteracao dos outros menus.\n";
