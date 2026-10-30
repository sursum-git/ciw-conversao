<?php
// Publicacao delimitada da Home: somente menu CIW; baseline, transacao e assinatura nativa.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-menu-20261020';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
$read=fn($p)=>json_decode(file_get_contents($p),true,flags:JSON_THROW_ON_ERROR);
$baseline=$read($state.'/baseline.json');$before=$read($state.'/home-before.json');$candidate=$read($state.'/home-candidate.json');$patch=$read($root.'/integration-src/ciw-menu/home-menu.json');
$require=function(bool $ok,string $message):void{if(!$ok)throw new RuntimeException($message);};
$require(!file_exists($state.'/publication.json'),'Publicacao ja registrada; nao repetir');
$expected=$before;$expected['navigation']['modules'][]=$patch['module'];
$expected['navigation']['groups']=array_merge($expected['navigation']['groups'],$patch['groups']);$expected['programs']=array_merge($expected['programs'],$patch['programs']);
$require($candidate===$expected,'Delta fora do menu CIW');
$require($patch['module']===['id'=>'ciw','title'=>'CIW']&&count($patch['programs'])===13&&count($patch['groups'])===3,'Escopo do modulo divergente');
$ids=array_column($patch['programs'],'id');$require(count(array_unique($ids))===13,'Links duplicados');
$require(!preg_match('/conta\s+corrente\s+fornecedor/iu',json_encode($patch,$flags)),'Programa excluido encontrado');
$require(count(array_intersect($ids,array_column($before['programs'],'id')))===0,'Colisao de programa Home');
$require(count(array_intersect(array_column($patch['groups'],'id'),array_column($before['navigation']['groups'],'id')))===0,'Colisao de grupo Home');
$repo=$em->getRepository(App\Entity\ScreenDefinition::class);
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$permissionsHash=function()use($db,$flags):string{
 return hash('sha256',json_encode([
  $db->fetchAllAssociative('SELECT id, status, groups, permissions, auth_source FROM auth_user ORDER BY id'),
  $db->fetchAllAssociative('SELECT id, enabled, permission_overrides FROM auth_user_subscriber ORDER BY id'),
  $db->fetchAllAssociative('SELECT id FROM program_change_grant ORDER BY id')
 ],$flags));
};
$db->beginTransaction();
try{
 $db->executeQuery('SELECT id FROM screen_definition WHERE id = ? FOR UPDATE',[$baseline['id']]);
 $home=$repo->findOneBy(['screenId'=>'home']);$em->refresh($home);
 $require($home->getId()===$baseline['id']&&$home->getVersion()===$baseline['version']&&$home->getStatus()==='published','Home concorrente');
 $integrity->assertScreen($home);
 $require(hash('sha256',json_encode($home->getDefinition(),$flags))===$baseline['sha256'],'Baseline Home divergente');
 $permBefore=$permissionsHash();
 foreach($patch['programs'] as $p){
  $target=$repo->findOneBy(['screenId'=>$p['screenId'],'status'=>'published']);$require($target!==null,'Tela nao publicada');$integrity->assertScreen($target);
  $d=$target->getDefinition();$require($target->getPageType()===$p['type']&&$d['program']['id']===$p['code']&&$d['program']['permission']===$p['permission'],'Referencia de programa divergente');
  foreach(($d['contextFields']??[]) as $c)$require(empty($c['required']),'Link direto exige contexto');
 }
 foreach($patch['groups'] as $g){
  $require($g['moduleId']==='ciw','Grupo fora do CIW');
  foreach($g['items'] as $item)$require(in_array($item['programId'],$ids,true),'Link sem programa');
 }
 $home->setDefinition($candidate);$integrity->signScreen($home,['source'=>'ciw-menu-20261020','reason'=>'Organizacao do modulo CIW autorizada; permissoes mantidas e Conta corrente fornecedor excluido.']);
 $em->flush();$integrity->assertScreen($home);
 $require($permissionsHash()===$permBefore,'Permissoes alteradas durante publicacao');
 $db->commit();
 $receipt=['screenId'=>'home','screenRecordId'=>$home->getId(),'module'=>'ciw','directLinks'=>13,'groups'=>array_map(fn($g)=>['id'=>$g['id'],'title'=>$g['title'],'entries'=>count($g['items'])],$patch['groups']),
 'beforeSha256'=>$baseline['sha256'],'afterSha256'=>hash('sha256',json_encode($candidate,$flags)),'permissionsHash'=>$permBefore,'permissionsUnchanged'=>true,'otherMenusPreserved'=>true,'integrityValidated'=>true,'published'=>true,'publishedAt'=>date(DATE_ATOM)];
 file_put_contents($state.'/publication.json',json_encode($receipt,$flags|JSON_PRETTY_PRINT));
 echo 'PASS: modulo CIW,3grupos,13links publicados; demais menus e permissoes preservados, integridade valida.'.PHP_EOL;
}catch(Throwable $e){if($db->isTransactionActive())$db->rollBack();throw $e;}
