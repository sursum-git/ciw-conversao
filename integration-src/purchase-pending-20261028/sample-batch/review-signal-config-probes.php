<?php
declare(strict_types=1);
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$reflection = new ReflectionClass(App\Builder\ProgramBuilderService::class);
$builder = $reflection->newInstanceWithoutConstructor();
$method = new ReflectionMethod($builder, 'normalizeGridEditMode');
$results = [];
foreach (['popup', 'form', 'batch'] as $value) {
    try {
        $results[$value] = ['accepted' => true, 'normalized' => $method->invoke($builder, $value)];
    } catch (Throwable $error) {
        $results[$value] = ['accepted' => false, 'class' => $error::class, 'message' => $error->getMessage()];
    }
}
if ($results['popup']['accepted'] || !$results['form']['accepted'] || !$results['batch']['accepted']) {
    throw new RuntimeException('Unexpected Builder edit-mode contract.');
}
$proof = ['readOnly' => true, 'builderModeContract' => $results];
if (isset($argv[1])) {
    $draft = json_decode(file_get_contents($argv[1]), true, 512, JSON_THROW_ON_ERROR);
    $mode = $draft['programDraft']['gridEditMode'];
    if ($method->invoke($builder, $mode) !== 'form' || $draft['programDraft']['formOptions']['mode'] !== 'popup') {
        throw new RuntimeException('Candidate must use form grid mode with popup form.');
    }
    $fields = array_column($draft['entityDraft']['fields'], null, 'code');
    if (!$fields['nome']['required'] || !$fields['titulo']['required'] || $fields['qt_dias_alerta']['options']['min'] !== 0 || $fields['qt_dias_alerta']['options']['max'] !== 9999) {
        throw new RuntimeException('Candidate required-field/day bounds are not the reviewed contract.');
    }
    $proof['candidateMetadata'] = ['sha256' => hash_file('sha256', $argv[1]), 'gridMode' => $mode, 'formMode' => 'popup', 'requiredNameAndTitle' => true, 'dayMinimum' => 0, 'dayMaximum' => 9999];
}
echo json_encode($proof, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), "\n";
