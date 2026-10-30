<?php
// Somente acrescentar o novo link CIW; assinatura nativa, baseline e grants preservados.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-bc-client-20261021';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$flags=JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
$json=fn($v)=>json_encode($v,$flags);$check=function($v,$message){if(!$v)throw new RuntimeException($message);};
$repo=$em->getRepository(App\Entity\ScreenDefinition::class);
$builder=(new ReflectionProperty($kernel->getContainer()->get(App\Controller\ProgramBuilderController::class),'builder'))->getValue($kernel->getContainer()->get(App\Controller\ProgramBuilderController::class));
$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
$home=$repo->findOneBy(['screenId'=>'home']);$target=$repo->findOneBy(['screenId'=>'ciw.cotacoes-bc-buscar','status'=>'published']);
$check($home&&$target&&$home->getStatus()==='published','Telas publicadas ausentes');$integrity->assertScreen($home);$integrity->assertScreen($target);
$d=$target->getDefinition();$check($d['program']['id']==='cd0104'&&$d['program']['permission']==='hist_cotacoes_bc_progress.read','Referencia divergente');
foreach($d['contextFields']??[] as $field)$check(empty($field['required']),'Link exige contexto');
$link=['id'=>'ciw-buscar-cotacao-bc','code'=>'cd0104','title'=>'Buscar cotação no Banco Central','subtitle'=>'Consulta oficial do dólar de venda e gravação automática no histórico','type'=>'process','screenId'=>'ciw.cotacoes-bc-buscar','moduleId'=>'ciw','permission'=>$d['program']['permission']];
$permissionHash=fn()=>hash('sha256',$json([
 $db->fetchAllAssociative('SELECT id,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),
 $db->fetchAllAssociative('SELECT id,enabled,permission_overrides FROM auth_user_subscriber ORDER BY id')
]));
if(in_array('--prepare',$argv,true)){
 $check(!file_exists($state.'/home-link-baseline.json'),'Baseline existente; nao substituir');
 $before=$home->getDefinition();$check(!in_array($link['id'],array_column($before['programs'],'id'),true),'Link ja existe');
 $candidate=$before;$candidate['programs'][]=$link;$groups=0;
 foreach($candidate['navigation']['groups'] as &$group){
  if(($group['moduleId']??null)==='ciw'&&in_array('ciw-parametros-ima',array_column($group['items']??[],'programId'),true)){
   $group['items'][]=['programId'=>$link['id'],'title'=>$link['title']];$groups++;
  }
 }unset($group);$check($groups===1,'Grupo CIW ambiguo/ausente');
 file_put_contents($state.'/home-link-before.json',$json($before));file_put_contents($state.'/home-link-candidate.json',$json($candidate));
 file_put_contents($state.'/home-link-baseline.json',$json(['id'=>$home->getId(),'version'=>$home->getVersion(),'sha256'=>hash('sha256',$json($before)),'permissionHash'=>$permissionHash()]));
 file_put_contents($root.'/integration-src/ciw-bc-client/metadata/home-link.json',$json($link));
 echo "PASS: link CIW preparado; nenhum menu ou acesso alterado.\n";exit;
}
$check(in_array('--apply',$argv,true),'Usar --prepare ou --apply');$check(!file_exists($state.'/home-link-publication.json'),'Ja aplicado; nao repetir');
$b=json_decode(file_get_contents($state.'/home-link-baseline.json'),true,flags:JSON_THROW_ON_ERROR);
$before=json_decode(file_get_contents($state.'/home-link-before.json'),true,flags:JSON_THROW_ON_ERROR);
$candidate=json_decode(file_get_contents($state.'/home-link-candidate.json'),true,flags:JSON_THROW_ON_ERROR);
$expected=$before;$expected['programs'][]=$link;
foreach($expected['navigation']['groups'] as &$group){if(($group['moduleId']??null)==='ciw'&&in_array('ciw-parametros-ima',array_column($group['items']??[],'programId'),true))$group['items'][]=['programId'=>$link['id'],'title'=>$link['title']];}unset($group);
$check($candidate===$expected,'Delta de Home fora do recorte');
$db->beginTransaction();
try{
 $db->executeQuery('SELECT id FROM screen_definition WHERE id=? FOR UPDATE',[$b['id']]);$em->refresh($home);$integrity->assertScreen($home);
 $check($home->getId()===$b['id']&&$home->getVersion()===$b['version']&&hash('sha256',$json($home->getDefinition()))===$b['sha256'],'Home mudou; preservar concorrencia');
 $check($permissionHash()===$b['permissionHash'],'Acessos mudaram; rever baseline');
 $home->setDefinition($candidate);$integrity->signScreen($home,['source'=>'ciw-bc-client-20261021','reason'=>'Acrescentar somente o link da conversao de cotacoes aprovada.']);$em->flush();$integrity->assertScreen($home);
 $check($permissionHash()===$b['permissionHash'],'Acessos alterados');$db->commit();
 file_put_contents($state.'/home-link-publication.json',$json(['published'=>true,'screenId'=>'home','link'=>$link,'beforeSha256'=>$b['sha256'],'afterSha256'=>hash('sha256',$json($candidate)),'permissionsUnchanged'=>true,'otherMenusPreserved'=>true,'integrityValidated'=>true]));
 echo "PASS: somente link Cotacoes BC publicado na Home CIW; acessos preservados.\n";
}catch(Throwable $e){if($db->isTransactionActive())$db->rollBack();throw $e;}
