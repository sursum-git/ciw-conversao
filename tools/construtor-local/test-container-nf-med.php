<?php
declare(strict_types=1);

// Runs through SSH stdin. Credentials exist only in this process.
$backend = '/var/www/clients/client1/web7/web/extranet/backend';
require $backend . '/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend . '/.env');
$kernel = new App\Kernel($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod', false);
$kernel->boot();
$container = $kernel->getContainer();
$em = $container->get('doctrine')->getManager();
$application = new Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
$command = $application->find('app:subscriber:create');
if ($command instanceof Symfony\Component\Console\Command\LazyCommand) {
    $command = $command->getCommand();
}
$integrity = (new ReflectionProperty($command, 'integrity'))->getValue($command);
$username = 'ciw-publish-' . bin2hex(random_bytes(6));
$password = bin2hex(random_bytes(24)) . 'aA1!';
$db = $em->getConnection();
$baseline = $db->fetchOne("SELECT md5(string_agg(to_jsonb(s)::text,',' ORDER BY code)) FROM auth_subscriber s");
$user = (new App\Entity\AuthUser())
    ->setTenantId('default')->setUsername($username)
    ->setDisplayName('Publicação temporária CIW')
    ->setStatus('active')->setGroups([])
    ->setPermissions(['admin.read' => true, 'admin.write' => true, 'container_nfs_progress.read' => true, 'container_nfs_progress.process' => true, 'container_nfs_disponiveis_med_progress.read' => true, 'container_nfs_disponiveis_med_progress.process' => true])
    ->setAuthSource('local')->setPasswordHash(password_hash($password, PASSWORD_DEFAULT))
    ->setForcePasswordChange(false);
$link = (new App\Entity\AuthUserSubscriber())
    ->setUserTenantId('default')->setUsername($username)
    ->setSubscriberCode('default')->setDefaultSubscriber(true)->setEnabled(true)
    ->setPermissionOverrides([])->setMetadata(['source' => 'temporary-ciw-publication']);
$login = null;
try {
    $em->persist($user);
    $em->persist($link);
    $em->flush();
    $integrity->signAuthUserSubscriber($link, ['source' => 'temporary-ciw-publication']);
    $em->flush();
    $curl = curl_init('https://iol.imatextil.com.br/extranet/api/auth/login');
    curl_setopt_array($curl, [
        CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode([
            'username' => $username, 'password' => $password,
            'tenantId' => 'default', 'remember' => false,
        ], JSON_THROW_ON_ERROR),
    ]);
    $raw = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $login = is_string($raw) ? json_decode($raw, true) : null;
    $password = null;
    $raw = null;
    if ($status !== 200 || !($login['authenticated'] ?? false)) {
        $code = $login['error']['code'] ?? 'LOGIN_FAILED';
        if (!is_string($code) || !preg_match('/^[A-Z0-9_]{1,100}$/', $code)) {
            $code = 'LOGIN_FAILED';
        }
        throw new RuntimeException('Temporary login: HTTP ' . $status . ' ' . $code);
    }
    $curl = curl_init('https://iol.imatextil.com.br/extranet/api/admin/program-builder/bootstrap');
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $login['token'],
            'X-Runtime-Auth-Token: ' . $login['token'],
            'X-Runtime-Tenant-Id: ' . $login['tenantId'],
            'X-Runtime-User-Id: ' . $login['user']['id'],
            'X-Runtime-Session-Id: ' . $login['session']['sessionId'],
        ],
    ]);
    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $bootstrap = is_string($response) ? json_decode($response, true) : null;
    if ($status !== 200 || !is_array($bootstrap) || isset($bootstrap['error'])) {
        throw new RuntimeException('Builder bootstrap HTTP ' . $status);
    }
    echo "Sessão autenticada de teste confirmada.\n";
    $request = static function (string $url, array $payload, array $headers): array {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 45, CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_THROW_ON_ERROR),
        ]);
        $raw = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $body = is_string($raw) ? json_decode($raw, true) : null;
        if (!is_array($body)) {
            throw new RuntimeException('HTTP response uncertain: ' . $status);
        }
        return ['status' => $status, 'body' => $body];
    };
    $checks = 0;
    $check = static function (bool $ok, string $message) use (&$checks): void {
        if (!$ok) {
            throw new RuntimeException('FAIL: ' . $message);
        }
        $checks++;
    };
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $login['token'],
        'X-Runtime-Auth-Token: ' . $login['token'],
        'X-Runtime-Tenant-Id: ' . $login['tenantId'],
        'X-Runtime-User-Id: ' . $login['user']['id'],
        'X-Runtime-Session-Id: ' . $login['session']['sessionId'],
    ];
    foreach ([
        'ciw.container-nfs' => ['desassociar_nfs', 'nfLinkSnapshot'],
        'ciw.container-nfs-disponiveis-med' => ['associar_nfs', 'nfLinkSnapshot'],
    ] as $screenId => $ids) {
        $screen = $em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId' => $screenId, 'status' => 'published']);
        $check($screen !== null, 'published screen required');
        $integrity->assertScreen($screen);
        foreach ($ids as $id) {
            $endpoint = $em->getRepository(App\Entity\RuntimeEndpoint::class)->findOneBy(['screenId' => $screenId, 'endpointId' => $id]);
            $check($endpoint !== null && $endpoint->isEnabled(), 'enabled signed endpoint required');
            $integrity->assertEndpoint($endpoint);
        }
    }
    echo "Assinaturas de duas telas e quatro endpoints verificadas.\n";
    $financial = $em->getRepository(App\Entity\BuilderApiSource::class)->findOneBy(['code' => 'motor_progress_container_financeiro']);
    $integrity->assertApiSource($financial);
    $pasoeHeaders = ['Content-Type: application/json',
        'X-Sursum-User: ' . $username, 'X-Session-Id: ' . $login['session']['sessionId']];
    foreach ($financial->getMetadata()['authHeaders'] as $key => $value) {
        $pasoeHeaders[] = $key . ': ' . $value;
    }
    $pasoe = static fn (string $route, array $payload): array =>
        $request('http://127.0.0.1:19910/med/web/SursumPrograms/' . $route, $payload, $pasoeHeaders)['body'];
    $runtime = static fn (string $screen, string $action, array $payload): array =>
        $request('https://iol.imatextil.com.br/extranet/api/runtime/screens/' . $screen . '/endpoints/' . $action, $payload, $headers);
    $cid = random_int(2147010000, 2147020000);
    $tag = 'CIW_NF_' . bin2hex(random_bytes(8));
    $receipt = ['container_id' => $cid, 'marker' => $tag, 'checks' => 0, 'cleanup' => false];
    $creationAttempted = false;
    $note = ['documento' => 'T' . bin2hex(random_bytes(4)), 'serie' => 'T', 'estab' => '505',
        'nat_operacao' => '31201', 'cod_emitente' => 26715];
    $readParent = static fn (): array => $pasoe('containers-painel', [
        'resource' => 'painel', 'operation' => 'get', 'container_id' => $cid, 'id' => $cid,
    ]);
    $snapshot = static function () use ($runtime, $cid, $check): array {
        $response = $runtime('ciw.container-nfs', 'nfLinkSnapshot', ['context' => ['container_id' => $cid]]);
        $check($response['status'] === 200 && is_array($response['body']['data'] ?? null), 'snapshot runtime response');
        $check(is_string($response['body']['nf_stamp'] ?? null), 'snapshot returns nf_stamp');
        return $response['body'];
    };
    $process = static fn (string $action, string $stamp, array $notes): array =>
        $runtime($action === 'associar_nfs' ? 'ciw.container-nfs-disponiveis-med' : 'ciw.container-nfs',
            $action, ['context' => ['container_id' => $cid],
                'parameters' => ['nfs' => $notes, 'expected_nf_stamp' => $stamp]]);
    $homeBefore = $db->fetchOne("SELECT md5(string_agg(definition::jsonb::text,',' ORDER BY version)) FROM screen_definition WHERE screen_id='home' AND status='published'");
    try {
        $before = $readParent();
        $check(($before['error']['status'] ?? null) === 404, 'fresh container ID must not exist');
        $creationAttempted = true;
        $created = $pasoe('containers-cabecalho', [
            'resource' => 'containers', 'operation' => 'create', 'container_id' => $cid,
            'values' => ['narrativa' => $tag, 'cod_estabel' => '505', 'cod_emit_forn' => 26715,
                'situacao_container_id' => 7, 'ordem_busca_dolar_compra' => '2',
                'ordem_busca_dolar_di' => '4', 'cod_tipo_proj_dolar' => 1,
                'vl_dolar_compra' => 5, 'vl_dolar_di' => 5, 'vl_proj_dolar' => 0, 'vl_dolar_venda' => 5,
                'log_gerar_saldo_a_pagar' => false, 'log_gerar_distr_custo' => false,
                'log_liberar_custo_realizado' => false],
        ]);
        $check(($created['success'] ?? null) === true && ($created['audit']['recordId'] ?? null) === $cid, 'new marked container created');
        $check(($readParent()['data']['narrativa'] ?? null) === $tag, 'ownership marker matches');
        file_put_contents(__DIR__ . '/med-test-receipt.json', json_encode($receipt, JSON_PRETTY_PRINT));
        $initial = $snapshot();
        $check(count($initial['data']) === 0, 'new container starts without links');
        $invalid = $note;
        unset($invalid['nat_operacao']);
        $rejected = $process('associar_nfs', $initial['nf_stamp'], [$invalid]);
        $check($rejected['status'] === 422, 'incomplete key rejected before write');
        $associated = $process('associar_nfs', $initial['nf_stamp'], [$note]);
        $receipt['associationResponse'] = $associated;
        file_put_contents(__DIR__ . '/med-test-receipt.json', json_encode($receipt, JSON_PRETTY_PRINT));
        echo 'Association HTTP ' . $associated['status'] . ' code '
            . ($associated['body']['error']['code'] ?? 'none') . "\n";
        $check($associated['status'] === 200 && ($associated['body']['status'] ?? null) === 'succeeded',
            'association through published runtime endpoint');
        $check(($associated['body']['audit']['available'] ?? null) === true, 'association audit available');
        $linked = $snapshot();
        $check(count($linked['data']) === 1 && $linked['nf_stamp'] !== $initial['nf_stamp'], 'association changes link and stamp');
        $stale = $process('desassociar_nfs', $initial['nf_stamp'], [$note]);
        $check($stale['status'] === 409, 'stale stamp rejects with conflict');
        $check($snapshot()['nf_stamp'] === $linked['nf_stamp'], 'conflict preserves links');
        $wrong = $note;
        $wrong['nat_operacao'] = 'DIFFERENT';
        $missing = $process('desassociar_nfs', $linked['nf_stamp'], [$wrong]);
        $check($missing['status'] >= 400, 'different nature cannot delete link');
        $check($snapshot()['nf_stamp'] === $linked['nf_stamp'], 'full-key mismatch preserves links');
        $removed = $process('desassociar_nfs', $linked['nf_stamp'], [$note]);
        $check($removed['status'] === 200 && ($removed['body']['audit']['available'] ?? null) === true, 'disassociation audited');
        $empty = $snapshot();
        $check(count($empty['data']) === 0 && $empty['nf_stamp'] === $initial['nf_stamp'], 'links removed');
        $receipt['checks'] = $checks;
        $receipt['operations'] = 'association, disassociation, full key, stale stamp, audit';
        echo "Fluxo MED concluído: " . $checks . " verificações.\n";
    } finally {
        if ($creationAttempted) {
            $parent = $readParent();
            if (($parent['success'] ?? null) === true) {
                if (($parent['data']['narrativa'] ?? null) !== $tag) {
                    throw new RuntimeException('Cleanup refused: container ownership mismatch.');
                }
                $links = $pasoe('containers-financeiro', ['resource' => 'nfs', 'operation' => 'read', 'container_id' => $cid]);
                if (($links['success'] ?? null) !== true || !is_array($links['data'] ?? null)) {
                    throw new RuntimeException('Cleanup links could not be inspected.');
                }
                if ($links['data']) {
                    if (count($links['data']) !== 1) {
                        throw new RuntimeException('Cleanup refused: unexpected links.');
                    }
                    foreach ($note as $key => $value) {
                        if (($links['data'][0][$key] ?? null) !== $value) {
                            throw new RuntimeException('Cleanup refused: unexpected link identity.');
                        }
                    }
                    $clean = $pasoe('containers-processos', ['resource' => 'nfs', 'operation' => 'desassociar',
                        'container_id' => $cid, 'expected_nf_stamp' => $links['nf_stamp'], 'nfs' => [$note]]);
                    if (($clean['success'] ?? null) !== true || ($clean['committed'] ?? null) !== true) {
                        throw new RuntimeException('Owned link cleanup not confirmed.');
                    }
                }
                $deleted = $pasoe('containers-cabecalho', ['resource' => 'containers', 'operation' => 'delete',
                    'container_id' => $cid, 'id' => $cid]);
                if (($deleted['success'] ?? null) !== true || ($readParent()['error']['status'] ?? null) !== 404) {
                    throw new RuntimeException('Owned container cleanup not confirmed.');
                }
            } elseif (($parent['error']['status'] ?? null) !== 404) {
                throw new RuntimeException('Container state uncertain during cleanup.');
            }
            $receipt['cleanup'] = true;
            echo "Container de teste e vínculos removidos; auditoria preservada.\n";
        }
        $homeAfter = $db->fetchOne("SELECT md5(string_agg(definition::jsonb::text,',' ORDER BY version)) FROM screen_definition WHERE screen_id='home' AND status='published'");
        $check($homeBefore === $homeAfter, 'Home preserved');
        file_put_contents(__DIR__ . '/med-test-receipt.json', json_encode($receipt, JSON_PRETTY_PRINT));
    }
} finally {
    $user->setStatus('inactive')->setPermissions([])->setPasswordHash(password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT));
    $link->setEnabled(false);
    $em->flush();
    $integrity->signAuthUserSubscriber($link, ['source' => 'temporary-ciw-deactivation']);
    $em->flush();
    if (isset($login['session']['sessionId'])) {
        $db->executeStatement("UPDATE runtime_user_session SET status='revoked', revoked_at=NOW(), revoke_reason='Temporary CIW publication completed' WHERE session_id=:session", ['session' => $login['session']['sessionId']]);
    }
    $after = $db->fetchOne("SELECT md5(string_agg(to_jsonb(s)::text,',' ORDER BY code)) FROM auth_subscriber s");
    if ($after !== $baseline) {
        throw new RuntimeException('Subscriber baseline changed.');
    }
    $disabled = $db->fetchOne("SELECT count(*) FROM auth_user u JOIN auth_user_subscriber l ON l.username=u.normalized_username AND l.user_tenant_id=u.tenant_id WHERE u.normalized_username=:username AND u.status='inactive' AND l.enabled=false", ['username' => $username]);
    if ((int) $disabled !== 1) {
        throw new RuntimeException('Account deactivation not confirmed.');
    }
    echo "Conta temporária e vínculo desativados; assinantes conferidos.\n";
}
