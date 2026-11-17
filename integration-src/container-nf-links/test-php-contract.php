<?php
namespace App\Runtime;

$checks = 0;
$check = static function (bool $ok, string $message) use (&$checks): void {
    if (!$ok) {
        throw new \RuntimeException('FAIL: ' . $message);
    }
    $checks++;
};
$note = ['documento' => 'NEW-TEST', 'serie' => 'A', 'estab' => '5', 'nat_operacao' => '31201', 'cod_emitente' => 77];
$parameters = ['nfs' => [$note], 'expected_nf_stamp' => str_repeat('A', 64)];
$check(RuntimeContainerNfLinkParameters::normalize($parameters) === $parameters, 'complete key preserved');
foreach ([
    ['nfs' => [$note, $note], 'expected_nf_stamp' => str_repeat('A', 64)],
    ['nfs' => [array_diff_key($note, ['nat_operacao' => true])], 'expected_nf_stamp' => str_repeat('A', 64)],
    ['nfs' => [$note], 'expected_nf_stamp' => 'stale-invalid-format'],
] as $invalid) {
    try {
        RuntimeContainerNfLinkParameters::normalize($invalid);
        $check(false, 'invalid request accepted');
    } catch (RuntimeHttpException $error) {
        $check(true, 'invalid request rejected');
    }
}
$operation = ['code' => 'associar_nfs', 'requestContextFields' => ['container_id'],
    'path' => '/SursumPrograms/containers-processos', 'bodyTemplate' => ['resource' => 'nfs', 'operation' => 'associar']];
$check(RuntimeContainerNfLinkParameters::isOperation($operation), 'closed operation accepted');
$operation['bodyTemplate']['operation'] = 'desassociar';
$check(!RuntimeContainerNfLinkParameters::isOperation($operation), 'mismatched operation rejected');
$request = $parameters + ['container_id' => 123];
$snapshot = ['container_id' => 123] + $note;
$identity = strtoupper(hash('sha256', implode(chr(1), [123, 'NEW-TEST', 'A', '5', '31201', 77])));
$body = ['success' => true, 'committed' => true, 'audit' => [
    'version' => 1, 'source' => 'progress-transaction', 'resource' => 'container_processes',
    'operation' => 'associar', 'recordId' => 123, 'container_id' => 123,
    'actor' => ['login' => 'test'], 'before' => ['container_id' => 123], 'after' => ['container_id' => 123],
    'changes' => [['resource' => 'nfs_container', 'operation' => 'create', 'recordId' => $identity, 'before' => [], 'after' => $snapshot]],
]];
$check(RuntimeContainerNfLinkAudit::inspect($body, $request, 'associar', 'test')['metadata']['available'], 'complete audit accepted');
$check(!RuntimeContainerNfLinkAudit::inspect($body, $request, 'associar', 'other')['metadata']['available'], 'forged actor rejected');
$changed = $body;
$changed['audit']['changes'][0]['after']['nat_operacao'] = 'different';
$check(!RuntimeContainerNfLinkAudit::inspect($changed, $request, 'associar', 'test')['metadata']['available'], 'wrong full key rejected');
$changed = $body;
$changed['committed'] = false;
$check(!RuntimeContainerNfLinkAudit::inspect($changed, $request, 'associar', 'test')['metadata']['available'], 'uncommitted audit rejected');
$changed = $body;
$changed['audit']['operation'] = 'desassociar';
$changed['audit']['changes'][0] = ['resource' => 'nfs_container', 'operation' => 'delete',
    'recordId' => $identity, 'before' => $snapshot, 'after' => []];
$check(RuntimeContainerNfLinkAudit::inspect($changed, $request, 'desassociar', 'test')['metadata']['available'], 'deletion image accepted');
echo 'PASS ' . $checks . " PHP contract checks\n";
