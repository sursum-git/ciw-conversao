<?php
// Somente Home local: um link para a consulta pai, assinatura nativa e baseline concorrente.
declare(strict_types=1);
$root=dirname(__DIR__,2);$state=$root.'/.runtime/purchase-payments-20261022';$backend='D:/opencode/construtor-pg/backend';
if(!in_array('--prepare',$argv,true)&&!in_array('--apply',$argv,true))throw new RuntimeException('Usar --prepare ou --apply; nenhuma ação sem modo explícito.');
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;$json=fn($v)=>json_encode($v,$flags);$check=function($ok,$message){if(!$ok)throw new RuntimeException($message);};
$repo=$em->getRepository(App\Entity\ScreenDefinition::class);$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$links=json_decode(file_get_contents($root.'/integration-src/purchase-payments/metadata/home-links.json'),true,flags:JSON_THROW_ON_ERROR);$check(count($links)===1,'Home aceita somente consulta pai');$link=$links[0];
$check($link['code']==='cd0107'&&$link['screenId']==='ciw.processos-compra-financeiro-med'&&$link['permission']==='procs_compra_financeiro_med_progress.read','Link fora do recorte');
$home=$repo->findOneBy(['screenId'=>'home','status'=>'published']);$target=$repo->findOneBy(['screenId'=>$link['screenId'],'status'=>'published']);$check($home&&$target,'Home/consulta pai publicada ausente');$integrity->assertScreen($home);$integrity->assertScreen($target);
$definition=$target->getDefinition();$check($definition['program']['id']===$link['code']&&$definition['program']['permission']===$link['permission'],'Referência publicada divergente');foreach($definition['contextFields']??[] as $field)$check(empty($field['required']),'Pai exige contexto');
$append=function(array $before)use($link,$check):array{
 foreach($before['programs'] as $existing)$check(($existing['id']??null)!==$link['id']&&($existing['screenId']??null)!==$link['screenId'],'Link pai já existe; não repetir');
 $before['programs'][]=$link;$groups=0;foreach($before['navigation']['groups'] as &$group)if(($group['id']??null)==='ciw-consultas'&&($group['moduleId']??null)==='ciw'){$group['items'][]=['programId'=>$link['id'],'title'=>$link['title']];$groups++;}unset($group);$check($groups===1,'Grupo CIW Consultas ausente/ambíguo');return $before;
};
$permissionHash=fn()=>hash('sha256',$json([$db->fetchAllAssociative('SELECT id,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),$db->fetchAllAssociative('SELECT id,enabled,permission_overrides FROM auth_user_subscriber ORDER BY id')]));
$check(!file_exists($state.'/home-link-publication.json'),'Home já aplicada; não repetir');
if(in_array('--prepare',$argv,true)){
 $check(!file_exists($state.'/home-link-baseline.json'),'Baseline existe; preservar revisão');$before=$home->getDefinition();$candidate=$append($before);
 file_put_contents($state.'/home-link-before.json',$json($before));file_put_contents($state.'/home-link-candidate.json',$json($candidate));file_put_contents($state.'/home-link-baseline.json',$json(['id'=>$home->getId(),'version'=>$home->getVersion(),'sha256'=>hash('sha256',$json($before)),'permissionHash'=>$permissionHash()]));echo "PASS: candidato Home preparado, sem alterar catálogo.\n";exit;
}
$baseline=json_decode(file_get_contents($state.'/home-link-baseline.json'),true,flags:JSON_THROW_ON_ERROR);$before=json_decode(file_get_contents($state.'/home-link-before.json'),true,flags:JSON_THROW_ON_ERROR);$candidate=json_decode(file_get_contents($state.'/home-link-candidate.json'),true,flags:JSON_THROW_ON_ERROR);$check($candidate===$append($before),'Delta Home fora do recorte');
$publication=json_decode(file_get_contents($state.'/publication-processos-compra-financeiro-med.json'),true,flags:JSON_THROW_ON_ERROR);$check($publication['published']===true&&$publication['programCode']===$link['code'],'Publicação pai ausente');
$db->beginTransaction();try{
 $db->executeQuery('SELECT id FROM screen_definition WHERE id=? FOR UPDATE',[$baseline['id']]);$em->refresh($home);$integrity->assertScreen($home);$check($home->getId()===$baseline['id']&&$home->getVersion()===$baseline['version']&&hash('sha256',$json($home->getDefinition()))===$baseline['sha256'],'Home mudou; rever baseline');$check($permissionHash()===$baseline['permissionHash'],'Acessos mudaram; rever baseline');
 $home->setDefinition($candidate);$integrity->signScreen($home,['source'=>'purchase-payments-20261022','reason'=>'Somente atalho da consulta financeira dos processos MED.']);$em->flush();$integrity->assertScreen($home);$check($permissionHash()===$baseline['permissionHash'],'Acessos alterados');$db->commit();
 file_put_contents($state.'/home-link-publication.json',$json(['published'=>true,'links'=>$links,'beforeSha256'=>$baseline['sha256'],'afterSha256'=>hash('sha256',$json($candidate)),'permissionsUnchanged'=>true,'otherMenusPreserved'=>true,'integrityValidated'=>true]));echo "PASS: somente link pai publicado na Home.\n";
}catch(Throwable $e){if($db->isTransactionActive())$db->rollBack();throw $e;}
