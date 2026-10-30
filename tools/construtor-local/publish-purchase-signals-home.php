<?php
declare(strict_types=1);
// Dois atalhos CIW assinados; não concede permissões nem altera dados comerciais.
$root = dirname(__DIR__, 2);
$state = $root.'/.runtime/purchase-pending-integration-20261028';
$backend = 'D:/opencode/construtor-pg/backend';
$flags = JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
$json = static fn($value) => json_encode($value, $flags);
$read = static fn($file) => json_decode(file_get_contents($file), true, flags: JSON_THROW_ON_ERROR);
$check = static function ($ok, $message) { if (!$ok) throw new RuntimeException($message); };
$links = [
    ['id'=>'ciw-sinalizadores-importacao-med','code'=>'op1031','title'=>'Sinalizadores de importação — MED','subtitle'=>'Cinco regras e acesso aos registros sinalizados da MED.','type'=>'crud','screenId'=>'ciw.sinalizadores-importacao-med','moduleId'=>'ciw','permission'=>'proc_compra_sinalizadores_med_progress.read'],
    ['id'=>'ciw-sinalizadores-importacao','code'=>'cd0110','title'=>'Configuração dos sinalizadores','subtitle'=>'Parâmetros das cinco regras de sinalização da importação.','type'=>'crud','screenId'=>'ciw.sinalizadores-importacao','moduleId'=>'ciw','permission'=>'sinalizadores_importacao_progress.read'],
];
$check(in_array('--prepare', $argv, true) || in_array('--apply', $argv, true), 'Usar --prepare ou --apply');
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel = new App\Kernel('dev', false); $kernel->boot();
$em = $kernel->getContainer()->get('doctrine')->getManager(); $db = $em->getConnection();
$repo = $em->getRepository(App\Entity\ScreenDefinition::class);
$controller = $kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder = (new ReflectionProperty($controller, 'builder'))->getValue($controller);
$integrity = (new ReflectionProperty($builder, 'integrity'))->getValue($builder);
$home = $repo->findOneBy(['screenId'=>'home','status'=>'published']);
$check($home !== null, 'Home publicada ausente'); $integrity->assertScreen($home);
foreach ($links as $link) {
    $target = $repo->findOneBy(['screenId'=>$link['screenId'],'status'=>'published']);
    $check($target !== null, 'Destino publicado ausente'); $integrity->assertScreen($target);
    $definition = $target->getDefinition();
    $check($definition['program']['id'] === $link['code'] && $definition['program']['permission'] === $link['permission'], 'Destino divergente');
    foreach ($definition['contextFields'] ?? [] as $field) $check(empty($field['required']), 'Atalho exige contexto');
}
$append = static function (array $before) use ($links, $check): array {
    foreach ($links as $link) {
        foreach ($before['programs'] as $existing) $check(($existing['id']??null) !== $link['id'] && ($existing['screenId']??null) !== $link['screenId'], 'Atalho existente; não repetir');
        $before['programs'][] = $link;
        $check(!array_key_exists($link['permission'], $before['permissions']), 'Referência de permissão já existe');
        $before['permissions'][$link['permission']] = $link['permission'];
    }
    $matches = 0;
    foreach ($before['navigation']['groups'] as &$group) if (($group['id']??null) === 'ciw-compras') {
        $check(($group['moduleId']??null) === 'ciw', 'Grupo de outro módulo');
        foreach ($links as $link) $group['items'][] = ['programId'=>$link['id'],'title'=>$link['title']];
        $matches++;
    }
    unset($group); $check($matches === 1, 'Grupo CIW Compras ausente/ambíguo');
    return $before;
};
$accessHash = static fn() => hash('sha256', $json([
    $db->fetchAllAssociative('SELECT id,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),
    $db->fetchAllAssociative('SELECT id,enabled,permission_overrides FROM auth_user_subscriber ORDER BY id'),
]));
$screensHash = static function () use ($repo, $integrity, $json): string {
    $values = [];
    foreach ($repo->findBy(['status'=>'published'], ['screenId'=>'ASC']) as $screen) {
        if ($screen->getScreenId() === 'home') continue;
        $integrity->assertScreen($screen);
        $values[] = [$screen->getId(),$screen->getScreenId(),$screen->getVersion(),$screen->getDefinition()];
    }
    return hash('sha256', $json($values));
};
$check(!file_exists($state.'/metadata-home-publication.json'), 'Home já publicada; não repetir');
if (in_array('--prepare', $argv, true)) {
    $check(!file_exists($state.'/metadata-home-baseline.json'), 'Baseline existente; preservar');
    $before = $home->getDefinition(); $candidate = $append($before);
    file_put_contents($state.'/metadata-home-before.json', $json($before));
    file_put_contents($state.'/metadata-home-candidate.json', $json($candidate));
    file_put_contents($state.'/metadata-home-baseline.json', $json(['id'=>$home->getId(),'version'=>$home->getVersion(),'sha256'=>hash('sha256',$json($before)),'candidateSha256'=>hash('sha256',$json($candidate)),'permissionsHash'=>$accessHash(),'otherScreensHash'=>$screensHash()]));
    echo "PASS: dois atalhos preparados; sem escrita no catálogo.\n"; exit;
}
$publication = $read($state.'/metadata-publication.json');
$check($publication['success'] === true && count($publication['screens']) === 3, 'Publicação das telas ausente');
$baseline = $read($state.'/metadata-home-baseline.json');
$before = $read($state.'/metadata-home-before.json'); $candidate = $read($state.'/metadata-home-candidate.json');
$validation = $read($state.'/metadata-home-validation.json');
$check($candidate === $append($before) && $validation['success'] === true && $validation['candidateSha256'] === hash('sha256',$json($candidate)), 'Candidato não validado');
$db->beginTransaction();
try {
    $db->executeQuery('SELECT id FROM screen_definition WHERE id=? FOR UPDATE', [$baseline['id']]);
    $em->refresh($home); $integrity->assertScreen($home);
    $check($home->getId() === $baseline['id'] && $home->getVersion() === $baseline['version'] && hash('sha256',$json($home->getDefinition())) === $baseline['sha256'], 'Home mudou; rever baseline');
    $check($accessHash() === $baseline['permissionsHash'] && $screensHash() === $baseline['otherScreensHash'], 'Acessos/telas mudaram; rever baseline');
    $home->setDefinition($candidate);
    $integrity->signScreen($home, ['source'=>'purchase-pending-20261028','reason'=>'Dois atalhos CIW Compras para painel MED e configuração de sinalizadores; habilita pertencimento de módulo na auditoria existente.']);
    $em->flush(); $integrity->assertScreen($home);
    $check($accessHash() === $baseline['permissionsHash'] && $screensHash() === $baseline['otherScreensHash'], 'Acessos/outras telas alterados');
    $db->commit();
    file_put_contents($state.'/metadata-home-publication.json', $json(['published'=>true,'links'=>$links,'groupId'=>'ciw-compras','beforeSha256'=>$baseline['sha256'],'afterSha256'=>hash('sha256',$json($candidate)),'permissionsUnchanged'=>true,'otherScreensUnchanged'=>true,'otherMenusPreserved'=>true,'integrityValidated'=>true,'businessWrites'=>false]));
    echo "PASS: dois atalhos CIW assinados; acessos, demais menus e telas preservados.\n";
} catch (Throwable $error) { if ($db->isTransactionActive()) $db->rollBack(); throw $error; }
