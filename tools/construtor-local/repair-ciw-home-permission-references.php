<?php

declare(strict_types=1);

$root = dirname(__DIR__, 2);
$state = $root . '/.runtime/ciw-menu-access-20261030';
$backend = 'D:/opencode/construtor-pg/backend';

require $backend . '/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend . '/.env');

$kernel = new App\Kernel('dev', false);
$kernel->boot();
$entityManager = $kernel->getContainer()->get('doctrine')->getManager();
$connection = $entityManager->getConnection();
$flags = JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

$require = static function (bool $condition, string $message): void {
    if (!$condition) {
        throw new RuntimeException($message);
    }
};

if (!is_dir($state) && !mkdir($state, 0700, true) && !is_dir($state)) {
    throw new RuntimeException('Nao foi possivel criar o estado privado da correcao');
}

$controller = $kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
$builder = (new ReflectionProperty($controller, 'builder'))->getValue($controller);
$integrity = (new ReflectionProperty($builder, 'integrity'))->getValue($builder);
$home = $entityManager->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId' => 'home']);
$require($home !== null, 'Definicao da pagina inicial nao localizada');

$protectedState = static function () use ($connection, $home, $flags): string {
    return hash('sha256', json_encode([
        $connection->fetchAllAssociative('SELECT id,tenant_id,username,status,groups,permissions,auth_source FROM auth_user ORDER BY id'),
        $connection->fetchAllAssociative('SELECT id,permission_overrides FROM auth_user_subscriber ORDER BY id'),
        $connection->fetchAllAssociative('SELECT id,definition FROM screen_definition WHERE id<>? ORDER BY id', [$home->getId()]),
    ], $flags));
};

$entityManager->wrapInTransaction(function ($entityManager) use ($home, $integrity, $protectedState, $require, $state, $flags): void {
    $entityManager->lock($home, Doctrine\DBAL\LockMode::PESSIMISTIC_WRITE);
    $entityManager->refresh($home);
    $integrity->assertScreen($home);

    $guard = $protectedState();
    $before = $home->getDefinition();
    $after = $before;
    $added = [];

    foreach ($before['programs'] ?? [] as $program) {
        if (($program['moduleId'] ?? '') !== 'ciw') {
            continue;
        }

        $permission = $program['permission'] ?? '';
        $require((bool) preg_match('/^[a-z0-9_]+\\.read$/D', $permission), 'Referencia de leitura CIW invalida');
        if (!array_key_exists($permission, $after['permissions'] ?? [])) {
            $after['permissions'][$permission] = $permission;
            $added[] = $permission;
        }
    }

    $require($added !== [], 'Nao ha referencias CIW ausentes para reparar');
    $backup = fopen($state . '/home-references-before.json', 'x');
    $require($backup !== false, 'Backup desta revisao ja existe');
    fwrite($backup, json_encode($before, $flags | JSON_PRETTY_PRINT));
    fclose($backup);

    $home->setDefinition($after);
    $integrity->signScreen($home, ['source' => 'ciw-home-permission-references-repair-20261030']);
    $entityManager->flush();
    $integrity->assertScreen($home);
    $require($protectedState() === $guard, 'Usuarios, permissoes ou outras telas foram alterados');

    file_put_contents($state . '/home-references-fixed.json', json_encode([
        'screenId' => 'home',
        'permissionReferencesAdded' => count($added),
        'permissions' => $added,
        'nativeIntegrityValidated' => true,
        'otherDefinitionsAndAccessesPreserved' => true,
        'fixedAt' => date(DATE_ATOM),
    ], $flags | JSON_PRETTY_PRINT));

    echo 'PASS: ' . count($added) . " referencias CIW declaradas e assinadas; nenhum acesso foi concedido.\\n";
});
