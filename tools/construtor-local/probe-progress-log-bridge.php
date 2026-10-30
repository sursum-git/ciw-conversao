<?php
/**
 * Probe server-side do bridge. Recebe JSON privado pelo STDIN e nunca imprime headers/payload.
 * Input: backendPath, url, headers, requestHeaders, payload, screenId, programId, recordId.
 * A URL deve apontar somente para a fixture temporaria protegida de verificacao.
 */
$input = json_decode(stream_get_contents(STDIN), true, 512, JSON_THROW_ON_ERROR);
$backend = rtrim($input['backendPath'] ?? 'D:/opencode/construtor-pg/backend', '/\\');
require $backend . '/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend . '/.env');
$kernel = new App\Kernel($_SERVER['APP_ENV'] ?? 'dev', false);
$kernel->boot();
$container = $kernel->getContainer();
$controller = $container->get(App\Controller\RuntimeController::class);
$dispatcher = (new ReflectionProperty($controller, 'dispatcher'))->getValue($controller);
$transactions = (new ReflectionProperty($dispatcher, 'transactions'))->getValue($dispatcher);
$apiEntities = (new ReflectionProperty($dispatcher, 'apiEntities'))->getValue($dispatcher);
$client = (new ReflectionProperty($apiEntities, 'externalJsonClient'))->getValue($apiEntities);
if (($input['inspect'] ?? false) === true) {
    echo json_encode(['client' => $client::class, 'transactions' => $transactions::class,
        'clientSharesTransactions' => (new ReflectionProperty($client,'transactions'))->getValue($client) === $transactions,
        'transactionActorResolverConfigured' => (new ReflectionProperty($transactions, 'authenticatedSessions'))->getValue($transactions) !== null]) . PHP_EOL;
    exit(0);
}
$url = $input['url'] ?? '';
if (!preg_match('~/SursumPrograms/program-log-verificar\z~', $url)) {
    throw new RuntimeException('O probe aceita somente a fixture program-log-verificar.');
}
$request = Symfony\Component\HttpFoundation\Request::create('/probe-progress-log-bridge', 'POST');
foreach ($input['requestHeaders'] ?? [] as $name => $value) {
    $request->headers->set($name, $value);
}
$requestStack = $container->get('request_stack');
$requestStack->push($request);
$transaction = $transactions->begin($input['screenId'] ?? 'ciw.despesas', 'progress-log-probe', 'entity.api.crud', [
    'entityCode' => 'despesas_progress', 'programId' => $input['programId'] ?? 'cd0092', 'id' => $input['recordId'] ?? null,
]);
$errorCode = null;
try {
    $client->request($url, 'POST', $input['headers'] ?? [], $input['payload'] ?? [], 15, ['responseContract' => 'sursum-programs']);
    $transactions->success();
} catch (Throwable $error) {
    $errorCode = $error instanceof App\Runtime\RuntimeHttpException ? $error->getErrorCode() : 'PROBE_ERROR';
    $transactions->fail($error);
}
$manager = $container->get('doctrine')->getManager();
$logs = $manager->getRepository(App\Entity\RuntimeTransactionLog::class)->findBy(['transaction' => $transaction], ['id' => 'ASC']);
$result = ['transactionId' => $transaction->getId(), 'errorCode' => $errorCode, 'logs' => []];
foreach ($logs as $log) {
    $meta = $log->getMetadata();
    $result['logs'][] = ['eventType' => $log->getEventType(), 'executionId' => $meta['executionId'] ?? null,
        'eventId' => $meta['eventId'] ?? null, 'occurredAt' => $meta['occurredAt'] ?? null,
        'pasoeAgent' => $meta['pasoeAgent'] ?? null, 'pasoeInstance' => $meta['pasoeInstance'] ?? null,
        'currentUser' => $meta['currentUser'] ?? null, 'logCount' => $meta['logCount'] ?? null,
        'reason' => $meta['reason'] ?? null];
}
$transactions->clear();
$requestStack->pop();
$kernel->shutdown();
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
