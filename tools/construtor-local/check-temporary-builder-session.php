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
