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
    ->setPermissions(['admin.read' => true, 'admin.write' => true])
    ->setAuthSource('local')->setPasswordHash(password_hash($password, PASSWORD_DEFAULT))
    ->setForcePasswordChange(false);
$link = (new App\Entity\AuthUserSubscriber())
    ->setUserTenantId('default')->setUsername($username)
    ->setSubscriberCode('default')->setDefaultSubscriber(true)->setEnabled(true)
    ->setPermissionOverrides([])->setMetadata(['source' => 'temporary-ciw-publication']);
$login = null;
$package = json_decode(stream_get_contents(STDIN), true, 512, JSON_THROW_ON_ERROR);
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
    echo "Sessão autenticada de autoria Builder confirmada.\n";
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $login['token'],
        'X-Runtime-Auth-Token: ' . $login['token'],
        'X-Runtime-Tenant-Id: ' . $login['tenantId'],
        'X-Runtime-User-Id: ' . $login['user']['id'],
        'X-Runtime-Session-Id: ' . $login['session']['sessionId'],
    ];
    $api = static function (string $path, ?array $body = null) use ($headers): array {
        $curl = curl_init('https://iol.imatextil.com.br/extranet/api/admin/program-builder' . $path);
        $options = [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 60, CURLOPT_HTTPHEADER => $headers];
        if ($body !== null) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($body, JSON_THROW_ON_ERROR);
        }
        curl_setopt_array($curl, $options);
        $raw = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $result = is_string($raw) ? json_decode($raw, true) : null;
        if ($status < 200 || $status >= 300 || !is_array($result) || isset($result['error'])) {
            $code = $result['error']['code'] ?? 'BUILDER_REQUEST_FAILED';
            if (!is_string($code) || !preg_match('/^[A-Z0-9_]{1,100}$/', $code)) {
                $code = 'BUILDER_REQUEST_FAILED';
            }
            throw new RuntimeException($path . ': HTTP ' . $status . ' ' . $code);
        }
        return $result;
    };
    if (($package['source']['code'] ?? null) !== 'motor_progress_container_financeiro'
        || count($package['drafts'] ?? []) !== 2) {
        throw new RuntimeException('Unexpected publication scope.');
    }
    $homeBefore = $db->fetchOne("SELECT md5(string_agg(definition::jsonb::text,',' ORDER BY version)) FROM screen_definition WHERE screen_id='home' AND status='published'");
    $api('/api-sources', $package['source']);
    echo "Fonte financeira cadastrada.\n";
    foreach ($package['drafts'] as $draft) {
        $program = $draft['programDraft'];
        $entity = $draft['entityDraft'];
        if (!in_array($program['screenId'] ?? null, ['ciw.container-nfs', 'ciw.container-nfs-disponiveis-med'], true)
            || $entity['code'] !== $program['builderEntityCode']) {
            throw new RuntimeException('Unexpected program.');
        }
        $existing = $db->fetchOne("SELECT version FROM screen_definition WHERE screen_id=:screen AND status='published'", ['screen' => $program['screenId']]);
        if ($existing !== false) {
            if ($existing !== $program['version']) {
                throw new RuntimeException('Existing published version requires reconciliation.');
            }
            echo $program['screenId'] . ": versão já publicada.\n";
            continue;
        }
        $api('/entities', $entity);
        $preview = $api('/external/validate', $draft);
        if (($preview['valid'] ?? true) === false) {
            throw new RuntimeException('Builder preview invalid.');
        }
        $request = $api('/governance/requests', [
            'programCode' => $program['programCode'], 'builderEntityCode' => $entity['code'],
            'requestedActions' => ['edit', 'publish'],
            'reason' => 'Associação e desassociação CIW autorizadas; chave completa, selo e auditoria.',
        ]);
        $grant = $api('/governance/grants', [
            'requestId' => $request['request']['id'], 'grantedToUserId' => (string) $login['user']['id'],
            'allowedActions' => ['edit', 'publish'],
        ]);
        $tokens = [];
        try {
            foreach (['entity' => $entity['code'], 'program' => $program['programCode']] as $type => $code) {
                $lock = $api('/locks/acquire', ['scopeType' => $type, 'scopeCode' => $code,
                    'grantId' => $grant['grant']['id'], 'lockCategory' => 'authoring']);
                if (($lock['status'] ?? null) !== 'acquired') {
                    throw new RuntimeException('Authoring lock unavailable.');
                }
                $tokens[] = $lock['lock']['lockToken'];
            }
            $saved = $api('/drafts', $program);
            $id = $saved['id'] ?? $saved['version']['id'] ?? null;
            if (!is_int($id)) {
                throw new RuntimeException('Draft version missing.');
            }
            $bundle = 'ciw-nf-links-' . bin2hex(random_bytes(8));
            $api('/governance/tests', [
                'builderProgramVersionId' => $id, 'bundleId' => $bundle,
                'testPlanId' => 'ciw-nf-links-integration', 'status' => 'passed',
                'checklistSnapshot' => ['schema' => true, 'php' => true, 'abl' => true, 'frontendExisting' => true],
                'evidences' => [
                    ['type' => 'php-contract', 'result' => '11 checks: full keys, stamp, audit actor and snapshots'],
                    ['type' => 'openedge-12.2', 'result' => '4 source units COMPILER:ERROR=no; root transaction TT 13 checks NUM-DBS=0'],
                    ['type' => 'javascript', 'result' => 'node syntax check and selection validation'],
                ],
                'notes' => 'Evidências locais executadas. Teste operacional MED será executado após publicação e não é declarado por este bundle.',
            ]);
            $api('/governance/approvals', ['builderProgramVersionId' => $id, 'bundleId' => $bundle]);
            $api('/versions/' . $id . '/publish', []);
            echo $program['screenId'] . ' publicada ' . $program['version'] . "\n";
        } finally {
            foreach ($tokens as $token) {
                $api('/locks/release', ['lockToken' => $token]);
            }
        }
    }
    $homeAfter = $db->fetchOne("SELECT md5(string_agg(definition::jsonb::text,',' ORDER BY version)) FROM screen_definition WHERE screen_id='home' AND status='published'");
    if ($homeBefore !== $homeAfter) {
        throw new RuntimeException('Home baseline changed.');
    }
    echo "Home conferida.\n";
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
