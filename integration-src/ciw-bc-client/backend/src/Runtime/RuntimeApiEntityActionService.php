<?php

namespace App\Runtime;

use App\Entity\BuilderEntity;
use App\Auth\AuthenticatedSessionResolver;
use App\Repository\BuilderEntityRepository;

class RuntimeApiEntityActionService
{
    public function __construct(
        private readonly BuilderEntityRepository $entities,
        private readonly RuntimeTransactionService $transactions,
        private readonly RuntimeExternalJsonClient $externalJsonClient,
        private readonly ?PermissionResolver $permissions = null,
        private readonly ?AuthenticatedSessionResolver $authenticatedSessions = null,
        private readonly ?ApiCompanyContextResolver $companyContexts = null,
        private readonly ?ApiCompanyRequestAdapter $companyAdapter = null,
        private readonly ?ApiCompanyAuditClassifier $companyMetadata = null,
        private readonly ?\App\Ciw\BancoCentralSgsClient $bancoCentral = null,
    ) {
    }

    public function handle(string $screenId, string $endpointId, array $config, array $payload): array
    {
        $entityCode = trim((string) ($config['entityCode'] ?? $payload['entityCode'] ?? ''));
        $operation = trim((string) ($config['operation'] ?? $payload['operation'] ?? $endpointId));
        $definition = $this->resolveDefinition($entityCode);
        $revision = null;
        if (array_key_exists('apiCompany', $payload)) {
            $selection = $payload['apiCompany'];
            if (!is_array($selection) || array_keys($selection) !== ['selectionRevision'] || !is_int($selection['selectionRevision']) || $selection['selectionRevision'] < 1) {
                throw new RuntimeHttpException('API_COMPANY_SELECTION_INVALID', 'A revisao da empresa da API e invalida.', 422);
            }
            $revision = $selection['selectionRevision'];
            unset($payload['apiCompany']);
        }
        if (!empty($definition['apiCompanyContext'])) {
            if (!$this->companyContexts || !$this->companyAdapter) {
                throw new RuntimeHttpException('API_COMPANY_CONTEXT_UNAVAILABLE', 'O contexto empresarial da API nao esta disponivel.', 503);
            }
            $context = $this->companyContexts->forOperation($screenId, $entityCode, $operation, $revision);
            $definition['_apiCompanyOperation'] = $operation;
            if ($context) {
                $this->companyAdapter->assertNoConflictInInput($context, $payload);
                $definition['_apiCompanyContext'] = $context;
                $this->transactions->attachApiCompanyContext($context);
            } elseif (($definition['apiCompanyContext']['operations'][$operation]['mode'] ?? '') === 'shared') {
                $this->transactions->attachSharedApiCompanyContext($definition['apiCompanyContext']['moduleId'], (string)($definition['apiBinding']['sourceCode'] ?? ''));
            }
        }

        $result = match ($operation) {
            'read' => $this->read($definition, $payload),
            'get' => $this->get($definition, $payload),
            'create' => $this->create($definition, $payload),
            'update' => $this->update($definition, $payload),
            'delete' => $this->delete($definition, $payload),
            'batch' => $this->batch($definition, $config, $payload),
            'options' => $this->options($definition, $config, $payload),
            'process' => $this->process($definition, $config, $payload),
            default => throw new RuntimeHttpException('ENTITY_API_OPERATION_NOT_SUPPORTED', 'Entidade API suporta apenas read, get, create, update, delete e batch.', 422, [
                'entityCode' => $entityCode,
                'operation' => $operation,
                'screenId' => $screenId,
                'endpointId' => $endpointId,
            ]),
        };
        if (($context ?? null) instanceof ApiCompanyContext) {
            try {
                $this->companyContexts->forOperation($screenId, $entityCode, $operation, $revision);
            } catch (RuntimeHttpException $error) {
                if (in_array($operation, ['create','update','delete','batch','process'], true)) {
                    throw new RuntimeHttpException('API_COMPANY_RESULT_CONTEXT_CHANGED',
                        'A operacao foi concluida na empresa anterior, mas o contexto mudou. Recarregue os dados sem repetir a gravacao.', 409,
                        ['operationCompleted'=>true]);
                }
                throw $error;
            }
        }
        return $result;
    }

    private function process(array $definition, array $config, array $payload): array
    {
        $invalid = static function (string $message = 'Parametros do processo invalidos.'): never { throw new RuntimeHttpException('ENTITY_API_PROCESS_INVALID', $message, 422); };
        if (($config['allowProcess'] ?? false) !== true || ($config['operation'] ?? null) !== 'process') { throw new RuntimeHttpException('ENTITY_API_PROCESS_DISABLED', 'Execucao de processo nao habilitada neste endpoint publicado.', 403); }
        $prefix = trim((string) ($config['permissionPrefix'] ?? '')) ?: $definition['entityCode'];
        if (!$this->permissions?->hasPermission($prefix . '.process')) { throw new RuntimeHttpException('ENTITY_API_PROCESS_FORBIDDEN', 'Sem permissao para executar o processo.', 403); }
        $allowedEnvelope = ['parameters','context','runtime','entityCode','operation','actionId','programId','permissionPrefix','traceability','_runtime','_runtimeEndpoint'];
        if (array_diff(array_keys($payload), $allowedEnvelope)) { $invalid(); }
        $options = $config['processOptions'] ?? [];
        $operation = null;
        foreach ($definition['apiSource']['operations'] ?? [] as $candidate) { if (($candidate['code'] ?? null) === ($options['operationCode'] ?? null)) { $operation = $candidate; } }
        if (($definition['apiSource']['responseContract'] ?? null) !== 'sursum-programs' || !$operation || ($operation['allowProcess'] ?? false) !== true || ($operation['type'] ?? null) !== 'custom' || ($operation['method'] ?? null) !== 'POST' || !is_string($operation['path'] ?? null) || $operation['path'] === '') { $invalid('Processo exige operacao custom POST cadastrada.'); }
        $endpoint = $this->findOperation($definition, $operation['code']);
        $context = ApiRequestContext::resolve($definition, $endpoint, ['context' => $payload['context'] ?? []]);
        $contextCodes = $endpoint['requestContextFields']; $configured = array_column($config['contextFields'] ?? [], 'field');
        $expected = $contextCodes; sort($expected); sort($configured); if ($expected !== $configured) { $invalid('Contexto do processo nao configurado.'); }
        $names = $options['parameterFields'] ?? null;
        if (!is_array($names) || !array_is_list($names) || count($names) > 30 || count(array_unique($names, SORT_REGULAR)) !== count($names)) { $invalid(); }
        $parameters = $payload['parameters'] ?? [];
        if (!is_array($parameters) || $parameters !== [] && array_is_list($parameters) || array_diff(array_keys($parameters), array_merge($names, $contextCodes))) { $invalid(); }
        foreach ($context as $name => $value) {
            if (array_key_exists($name, $parameters) && (!(is_int($parameters[$name]) || is_string($parameters[$name])) || (string) $parameters[$name] !== (string) $value)) { $invalid('Parametro diverge do contexto fixo.'); }
        }
        $requestData = [];
        foreach ($names as $name) {
            if (!is_string($name) || !isset($definition['fields'][$name]) || in_array($name, ['operation','resource','context','parameters','runtime','_runtime'], true)) { $invalid(); }
            if (array_key_exists($name, $context)) { continue; }
            $field = $definition['fields'][$name];
            if (!array_key_exists($name, $parameters)) { if ($field['required']) { $invalid('Informe ' . $field['label'] . '.'); } continue; }
            $requestData[$name] = $this->normalizeProcessValue($field, $parameters[$name]);
        }
        $requestData += $context;
        if (RuntimeContainerAudit::supports($definition)) { $this->transactions->bindRecordId($context['container_id'] ?? null); }
        if (!is_array($endpoint['bodyTemplate'] ?? [] ) || ($endpoint['bodyTemplate'] ?? []) !== [] && array_is_list($endpoint['bodyTemplate']) || array_intersect(array_keys($endpoint['bodyTemplate'] ?? []), array_keys($requestData))) { $invalid('Parametros nao podem substituir o template estatico da operacao.'); }
        $started = microtime(true);
        $metadata = ['entityCode' => $definition['entityCode'], 'operationCode' => $operation['code'], 'context' => $context];
        if (RuntimeContainerAudit::resource($definition, $endpoint, (string) ($endpoint['bodyTemplate']['operation'] ?? '')) === 'container_processes') {
            $metadata['containerContext'] = ['version'=>1, 'source'=>'runtime-validated-context', 'containerId'=>$context['container_id']];
        }
        try {
            if (RuntimeCiwCotacaoAudit::supports($definition) && ($endpoint['bodyTemplate']['operation'] ?? null) === 'import-bc') {
                if (!RuntimeCiwCotacaoAudit::isImportEndpoint($definition, $endpoint) || $requestData !== ['serie'=>1] || !$this->bancoCentral) {
                    $invalid('A busca no Banco Central permite somente a serie 1, dolar americano de venda.');
                }
                // Apenas o cliente PHP confiavel fornece serie, data e valor; navegador nao os escolhe.
                $requestData = $this->bancoCentral->fetchLatestDollar();
            }
            $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'] ?? [], [], $requestData);
            if (($response['body']['success'] ?? true) === false || isset($response['body']['error'])) { throw new RuntimeHttpException('ENTITY_API_PROCESS_FAILED', 'A API recusou o processo.', 422); }
            try {
                $result = $this->validateProcessResult($this->extractByPath($response['body'], (string) (($operation['itemPath'] ?? null) ?: 'data')));
            } catch (RuntimeHttpException $error) {
                if (!RuntimeContainerAudit::supports($definition) && !RuntimeCiwCotacaoAudit::isImportEndpoint($definition, $endpoint)) { throw $error; }
                $result = ['type'=>'message','message'=>'Processo confirmado; resposta de apresentacao indisponivel. Nao repita o processo; consulte os logs da transacao.'];
            }
            $audit = null;
            if (RuntimeContainerAudit::supports($definition)) {
                $containerId = $context['container_id'] ?? null;
                $this->transactions->bindRecordId($containerId);
                $audit = RuntimeContainerAudit::inspect($definition, $endpoint, $response['body'], (string) ($endpoint['bodyTemplate']['operation'] ?? ''), $containerId, $containerId);
            }
            if (RuntimeCiwCotacaoAudit::isImportEndpoint($definition, $endpoint)) {
                $audit = RuntimeCiwCotacaoAudit::inspect($definition, $endpoint, $response['body'], 'import-bc', null);
                if ($audit['metadata']['available']) { $this->transactions->bindRecordId($audit['metadata']['recordId']); }
            }
            $this->transactions->log($definition['entityCode'] . '.api.process', 'Processo confirmado pela API externa.',
                before: $audit['before'] ?? [], after: $audit['after'] ?? [],
                metadata: $metadata + ['audit'=>$audit['metadata'] ?? ['available'=>false,'reason'=>'unsupported_contract'], 'durationMs' => (int) round((microtime(true)-$started)*1000), 'httpStatus' => $response['status']]);
            if ($audit !== null) {
                $this->emitContainerAuditEvents($definition, $audit);
                if (!$audit['metadata']['available']) {
                    $result = ['type'=>'message','message'=>'Processo confirmado, mas a auditoria completa ficou indisponivel. Nao repita o processo; consulte os logs da transacao.'];
                }
            }
            return ['ok' => true, 'status' => 'succeeded', 'result' => $result] + ($audit === null ? [] : ['audit'=>$audit['metadata']]);
        } catch (\Throwable $error) {
            $this->transactions->log($definition['entityCode'] . '.api.process.failed', 'Processo externo nao confirmado.', metadata: $metadata);
            throw $error;
        }
    }

    private function withContainerAuditNotice(array $result, array $definition, array $audit): array
    {
        if (RuntimeContainerAudit::supports($definition) && !$audit['metadata']['available']) {
            $result['effects'][] = ['action'=>'showMessage', 'type'=>'warning',
                'message'=>'Registro salvo, mas a auditoria completa ficou indisponivel. Nao repita a operacao; consulte os logs da transacao.'];
        }
        return $result;
    }

    private function emitContainerAuditEvents(array $definition, array $audit): void
    {
        if (!$audit['metadata']['available']) {
            $this->transactions->log($definition['entityCode'].'.api.audit.unavailable',
                'Operacao confirmada; auditoria completa indisponivel. Nao repita a operacao.', metadata: ['audit'=>$audit['metadata']]);
            return;
        }
        foreach ($audit['events'] as $event) {
            $this->transactions->log($definition['entityCode'].'.api.'.$event['metadata']['operation'], 'Efeito confirmado na transacao Progress.',
                before: $event['before'], after: $event['after'], metadata: ['entityCode'=>$definition['entityCode'], 'audit'=>$event['metadata']]);
        }
    }

    private function normalizeProcessValue(array $field, mixed $value): mixed
    {
        $invalid = static function (): never { throw new RuntimeHttpException('ENTITY_API_PROCESS_PARAMETER_INVALID', 'Tipo ou valor de parametro invalido.', 422); };
        if ($value === null) { if ($field['required']) { $invalid(); } return null; }
        switch ($field['dataType']) {
            case 'integer':
                if (!(is_int($value) || is_string($value)) || !preg_match('/\A-?(?:0|[1-9][0-9]{0,9})\z/', (string) $value) || (float) $value < -2147483648 || (float) $value > 2147483647) { $invalid(); }
                return (int) $value;
            case 'decimal': if (!(is_int($value) || is_float($value)) || !is_finite((float) $value)) { $invalid(); } return $value;
            case 'boolean': if (!is_bool($value)) { $invalid(); } return $value;
            case 'date':
                if (!is_string($value) || !preg_match('/\A([0-9]{4})-([0-9]{2})-([0-9]{2})\z/', $value, $parts) || !checkdate((int) $parts[2], (int) $parts[3], (int) $parts[1])) { $invalid(); } return $value;
            case 'datetime':
                if (!is_string($value) || !preg_match('/\A([0-9]{4})-([0-9]{2})-([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})(?:Z|[+-]([0-9]{2}):([0-9]{2}))?\z/', $value, $parts)
                    || !checkdate((int) $parts[2], (int) $parts[3], (int) $parts[1]) || (int) $parts[4] > 23 || (int) $parts[5] > 59 || (int) $parts[6] > 59
                    || isset($parts[7]) && ((int) $parts[7] > 23 || (int) $parts[8] > 59)) { $invalid(); }
                return $value;
            case 'string': case 'text':
                if (!is_string($value) || mb_strlen($value) > ($field['maxLength'] ?? 4000) || $field['required'] && trim($value) === '') { $invalid(); } return $value;
            default: $invalid();
        }
    }

    private function validateProcessResult(mixed $value): array
    {
        $invalid = static function (): never { throw new RuntimeHttpException('ENTITY_API_PROCESS_RESULT_INVALID', 'A API nao retornou um resultado fechado de mensagem ou grade.', 502); };
        if (!is_array($value) || array_is_list($value) || !in_array($value['type'] ?? null, ['message','grid'], true)) { $invalid(); }
        if (isset($value['message']) && (!is_string($value['message']) || mb_strlen($value['message']) > 4000) || isset($value['title']) && (!is_string($value['title']) || mb_strlen($value['title']) > 200)) { $invalid(); }
        if ($value['type'] === 'message') {
            if (array_diff(array_keys($value), ['type','message']) || !is_string($value['message'] ?? null) || trim($value['message']) === '') { $invalid(); } return $value;
        }
        if (array_diff(array_keys($value), ['type','message','title','columns','data']) || !is_array($value['columns'] ?? null) || !array_is_list($value['columns']) || !$value['columns'] || count($value['columns']) > 40 || !is_array($value['data'] ?? null) || !array_is_list($value['data']) || count($value['data']) > 5000) { $invalid(); }
        $fields = [];
        foreach ($value['columns'] as $column) {
            if (!is_array($column) || array_diff(array_keys($column), ['field','title']) || !is_string($column['field'] ?? null) || !preg_match('/\A[a-z][a-z0-9_]*\z/', $column['field']) || in_array($column['field'], ['constructor','prototype'], true) || isset($fields[$column['field']]) || !is_string($column['title'] ?? null) || mb_strlen($column['title']) > 200) { $invalid(); } $fields[$column['field']] = true;
        }
        foreach ($value['data'] as $row) {
            if (!is_array($row) || $row !== [] && array_is_list($row) || array_diff(array_keys($row), array_keys($fields))) { $invalid(); }
            foreach ($row as $cell) { if (!is_scalar($cell) && $cell !== null) { $invalid(); } }
        }
        return $value;
    }

    private function validateIntegerCollection(mixed $value, string $field): array
    {
        if (!is_array($value) || !array_is_list($value) || count($value) > 100) {
            throw new RuntimeHttpException('ENTITY_API_COLLECTION_INVALID', 'Informe uma lista de ate 100 IDs inteiros distintos para ' . $field . '.', 422);
        }
        $seen = [];
        foreach ($value as $id) {
            if (!is_int($id) || $id < 1 || $id > 2147483647 || isset($seen[$id])) {
                throw new RuntimeHttpException('ENTITY_API_COLLECTION_INVALID', 'IDs de ' . $field . ' devem ser inteiros positivos distintos (int32).', 422);
            }
            $seen[$id] = true;
        }
        return $value;
    }

    private function options(array $definition, array $config, array $payload): array
    {
        // Endpoint configuration selects the field. Browser input cannot select an operation or URL.
        $allowedContext = ['entityCode', 'operation', 'actionId', 'programId', 'permissionPrefix', 'traceability', '_runtime', '_runtimeEndpoint', 'id', 'context'];
        if (array_diff(array_keys($payload), $allowedContext)) {
            throw new RuntimeHttpException('ENTITY_API_OPTIONS_PAYLOAD_INVALID', 'Consulta de opcoes nao aceita parametros livres.', 422);
        }
        $field = $definition['fields'][$config['fieldCode'] ?? ''] ?? null;
        $source = $field['optionsSource'] ?? null;
        if (!is_array($source)) {
            throw new RuntimeHttpException('ENTITY_API_OPTIONS_NOT_CONFIGURED', 'Campo sem operacao de opcoes cadastrada.', 422);
        }
        $operationCode = (string) ($source['operationCode'] ?? '');
        $endpoint = $this->findOperation($definition, $operationCode);
        $operation = array_values(array_filter($definition['apiSource']['operations'] ?? [], static fn (array $op): bool => ($op['code'] ?? '') === $operationCode))[0] ?? [];
        if (!in_array($operation['type'] ?? 'custom', ['custom', 'list'], true)) {
            throw new RuntimeHttpException('ENTITY_API_OPTIONS_OPERATION_INVALID', 'Opcoes exigem operacao de consulta.', 422);
        }
        $context = ApiRequestContext::resolve($definition, $endpoint, $payload);
        $requestData = $context ?: null;
        if (array_key_exists('id', $payload)) {
            if (($source['excludeCurrent'] ?? false) !== true || !is_int($payload['id']) || $payload['id'] < 1 || $payload['id'] > 2147483647) {
                throw new RuntimeHttpException('ENTITY_API_OPTIONS_PAYLOAD_INVALID', 'ID de exclusao invalido.', 422);
            }
            $requestData = ['id' => $payload['id']] + $context;
        }
        $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'], [], $requestData);
        $items = $this->extractItems($response['body'], (string) ($operation['itemsPath'] ?? 'data'));
        $result = [];
        foreach ($items as $item) {
            $value = is_array($item) ? $this->extractByPath($item, $source['valueField']) : null;
            $text = is_array($item) ? $this->extractByPath($item, $source['textField']) : null;
            if (!is_int($value) || $value < 1 || $value > 2147483647 || ($text !== null && !is_string($text))) {
                throw new RuntimeHttpException('ENTITY_API_OPTIONS_RESPONSE_INVALID', 'A API retornou opcoes invalidas.', 422);
            }
            $option = ['value' => $value, 'text' => ($text ?? (string) $value)];
            foreach ($source['copyFields'] ?? [] as $target => $path) {
                $targetField = $definition['fields'][$target] ?? null;
                if (!$targetField || !$targetField['readonly'] || $targetField['primaryKey']) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_COPY_INVALID', 'Destino de apresentacao invalido.', 422); }
                $copy = $this->extractByPath($item, $path);
                if ($targetField['dataType'] === 'boolean') {
                    if (!in_array($copy, [0, 1, false, true], true)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_COPY_INVALID', 'Valor logico de apresentacao invalido.', 422); }
                    $copy = (bool) $copy;
                } elseif ($targetField['dataType'] === 'integer') {
                    if (!is_int($copy)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_COPY_INVALID', 'Inteiro de apresentacao invalido.', 422); }
                } elseif (!is_string($copy)) { throw new RuntimeHttpException('ENTITY_API_OPTIONS_COPY_INVALID', 'Texto de apresentacao invalido.', 422); }
                $option['fields'][$target] = $copy;
            }
            $result[] = $option;
        }
        return ['data' => $result];
    }

    private function read(array $definition, array $payload): array
    {
        $startedAt = microtime(true);
        $context = ApiRequestContext::resolve($definition, $definition['apiSource']['listEndpoint'], $payload);
        $response = $this->requestEndpoint($definition, $definition['apiSource']['listEndpoint'], $definition['apiSource']['authHeaders'], [], $context ?: null);
        $items = $this->extractItems($response['body'], (string) $definition['apiSource']['listResponse']['itemsPath']);
        $data = array_map(fn (mixed $item): array => $this->mapItem($definition, is_array($item) ? $item : []), $items);
        $data = $this->enrichRows($definition, $data);
        ApiRequestContext::assertRows($data, $context);
        $data = $this->applyFilter($data, $payload['filter'] ?? null);
        foreach ($payload['filters'] ?? [] as $filter) { $data = $this->applyFilter($data, $filter); }
        $data = $this->applySort($data, $payload['sort'] ?? []);
        $totalPath = (string) ($definition['apiSource']['listResponse']['totalPath'] ?? '');
        $total = $totalPath !== '' && $totalPath !== '$'
            ? (int) ($this->extractByPath($response['body'], $totalPath) ?? count($data))
            : count($data);
        $skip = max(0, (int) ($payload['skip'] ?? 0));
        $take = max(1, min(500, (int) ($payload['take'] ?? $payload['pageSize'] ?? 20)));
        $paged = array_slice($data, $skip, $take);

        $this->transactions->log($definition['entityCode'] . '.api.read', 'Consulta de entidade API executada.', metadata: [
            'entityCode' => $definition['entityCode'],
            'endpoint' => $definition['apiSource']['listEndpoint']['url'],
            'httpStatus' => $response['status'],
            'durationMs' => (int) round((microtime(true) - $startedAt) * 1000),
            'itemsCount' => count($paged),
            'total' => $total,
        ]);

        return [
            'data' => array_values($paged),
            'total' => $total,
        ];
    }

    private function get(array $definition, array $payload): array
    {
        $id = $this->extractRecordId($definition, $payload);
        $detailEndpoint = is_array($definition['apiSource']['detailEndpoint'] ?? null) ? $definition['apiSource']['detailEndpoint'] : null;
        if ($detailEndpoint) {
            $context = ApiRequestContext::resolve($definition, $detailEndpoint, $payload);
            $startedAt = microtime(true);
            $response = $this->requestEndpoint($definition, $detailEndpoint, $definition['apiSource']['authHeaders'], [
                'id' => $id,
                $definition['primaryKey'] => $id,
            ], $context ?: null);
            $path = (string) ($definition['apiSource']['detailResponse']['itemPath'] ?? '$');
            $item = $this->extractByPath($response['body'], $path);
            if (!is_array($item)) {
                throw new RuntimeHttpException('ENTITY_API_DETAIL_INVALID', 'Resposta da API externa nao retornou um objeto valido para detalhe.', 422, [
                    'entityCode' => $definition['entityCode'],
                    'itemPath' => $path,
                ]);
            }
            $mapped = $this->enrichRows($definition, [$this->mapItem($definition, $item)])[0] ?? [];
            ApiRequestContext::assertRows([$mapped], $context);
            $this->transactions->log($definition['entityCode'] . '.api.get', 'Detalhe de entidade API consultado.', after: $mapped, metadata: [
                'entityCode' => $definition['entityCode'],
                'endpoint' => $detailEndpoint['url'],
                'httpStatus' => $response['status'],
                'durationMs' => (int) round((microtime(true) - $startedAt) * 1000),
            ]);

            return $mapped;
        }

        if (is_array($payload['record'] ?? null)) {
            $record = $payload['record'];
            $record = $this->enrichRows($definition, [$record])[0] ?? $record;
            $this->transactions->log($definition['entityCode'] . '.api.get', 'Detalhe de entidade API reaproveitado da listagem.', after: $record, metadata: [
                'entityCode' => $definition['entityCode'],
                'source' => 'grid-record',
            ]);

            return $record;
        }

        throw new RuntimeHttpException('ENTITY_API_DETAIL_UNAVAILABLE', 'A entidade API nao possui endpoint de detalhe configurado.', 422, [
            'entityCode' => $definition['entityCode'],
        ]);
    }

    private function create(array $definition, array $payload): array
    {
        $endpoint = is_array($definition['apiSource']['createEndpoint'] ?? null) ? $definition['apiSource']['createEndpoint'] : null;
        if (!$endpoint) {
            throw new RuntimeHttpException('ENTITY_API_CREATE_UNAVAILABLE', 'A entidade API nao possui operacao de inclusao configurada.', 422, [
                'entityCode' => $definition['entityCode'],
            ]);
        }

        $record = $this->extractSubmittedRecord($payload);
        $requestPayload = $this->buildWritePayload($definition, $record, false);
        $writeContext = ApiRequestContext::resolve($definition, $endpoint, $payload);
        ApiRequestContext::assertRows([$record + $writeContext], $writeContext);
        $requestPayload = array_replace($requestPayload, $writeContext);
        $startedAt = microtime(true);
        $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'], [], $requestPayload);
        $saved = $this->extractWriteResponseRecord($definition, $response['body'], 'createResponse', $record);
        // Never correlate a create using the submitted key or a fallback record.
        $serverRecord = $this->extractWriteResponseRecord($definition, $response['body'], 'createResponse', []);
        $serverId = $serverRecord[$definition['primaryKey']] ?? null;
        $audit = $this->writeAuditSnapshot($definition, $endpoint, $response['body'], 'create', $serverId, $writeContext['container_id'] ?? null);
        $confirmedId = $audit['metadata']['recordId'] ?? $serverId;
        $this->transactions->bindRecordId(is_int($confirmedId) || is_string($confirmedId) ? $confirmedId : null);

        $this->transactions->log($definition['entityCode'] . '.api.create', 'Registro incluido em API externa.', before: $audit['before'], after: $audit['after'], metadata: [
            'audit' => $audit['metadata'],
            'entityCode' => $definition['entityCode'],
            'endpoint' => $endpoint['url'],
            'httpStatus' => $response['status'],
            'durationMs' => (int) round((microtime(true) - $startedAt) * 1000),
        ]);

        return $this->withContainerAuditNotice($saved, $definition, $audit);
    }

    private function update(array $definition, array $payload): array
    {
        $endpoint = is_array($definition['apiSource']['updateEndpoint'] ?? null) ? $definition['apiSource']['updateEndpoint'] : null;
        if (!$endpoint) {
            throw new RuntimeHttpException('ENTITY_API_UPDATE_UNAVAILABLE', 'A entidade API nao possui operacao de alteracao configurada.', 422, [
                'entityCode' => $definition['entityCode'],
            ]);
        }

        $record = $this->extractSubmittedRecord($payload);
        $id = $this->extractRecordId($definition, ['record' => $record] + $payload);
        $this->transactions->bindRecordId($id);
        $requestPayload = $this->buildWritePayload($definition, $record, true);
        $writeContext = ApiRequestContext::resolve($definition, $endpoint, $payload);
        ApiRequestContext::assertRows([$record + $writeContext], $writeContext);
        $requestPayload = array_replace($requestPayload, $writeContext);
        $startedAt = microtime(true);
        $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'], [
            'id' => $id,
            $definition['primaryKey'] => $id,
        ], $requestPayload);
        $saved = $this->extractWriteResponseRecord($definition, $response['body'], 'updateResponse', $record);
        $audit = $this->writeAuditSnapshot($definition, $endpoint, $response['body'], 'update', $id, $writeContext['container_id'] ?? null);

        $this->transactions->log($definition['entityCode'] . '.api.update', 'Registro alterado em API externa.', before: $audit['before'], after: $audit['after'], metadata: [
            'audit' => $audit['metadata'],
            'entityCode' => $definition['entityCode'],
            'endpoint' => $endpoint['url'],
            'httpStatus' => $response['status'],
            'durationMs' => (int) round((microtime(true) - $startedAt) * 1000),
        ]);

        return $this->withContainerAuditNotice($saved, $definition, $audit);
    }

    private function delete(array $definition, array $payload): array
    {
        $endpoint = is_array($definition['apiSource']['deleteEndpoint'] ?? null) ? $definition['apiSource']['deleteEndpoint'] : null;
        if (!$endpoint) {
            throw new RuntimeHttpException('ENTITY_API_DELETE_UNAVAILABLE', 'A entidade API nao possui operacao de exclusao configurada.', 422, [
                'entityCode' => $definition['entityCode'],
            ]);
        }

        $id = $this->extractRecordId($definition, $payload);
        $this->transactions->bindRecordId($id);
        $record = is_array($payload['record'] ?? null) ? $payload['record'] : [$definition['primaryKey'] => $id];
        $requestPayload = $this->buildWritePayload($definition, $record, true);
        $writeContext = ApiRequestContext::resolve($definition, $endpoint, $payload);
        ApiRequestContext::assertRows([$record + $writeContext], $writeContext);
        $requestPayload = array_replace($requestPayload, $writeContext);
        $startedAt = microtime(true);
        $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'], [
            'id' => $id,
            $definition['primaryKey'] => $id,
        ], $requestPayload);

        $audit = $this->writeAuditSnapshot($definition, $endpoint, $response['body'], 'delete', $id, $writeContext['container_id'] ?? null);
        $this->transactions->log($definition['entityCode'] . '.api.delete', 'Registro excluido em API externa.', before: $audit['before'], after: $audit['after'], metadata: [
            'audit' => $audit['metadata'],
            'entityCode' => $definition['entityCode'],
            'endpoint' => $endpoint['url'],
            'httpStatus' => $response['status'],
            'durationMs' => (int) round((microtime(true) - $startedAt) * 1000),
        ]);

        return $this->withContainerAuditNotice([
            'ok' => true,
            'deleted' => true,
            'id' => $id,
        ], $definition, $audit);
    }

    /** Optional server audit must never change an already committed CRUD result. */
    private function writeAuditSnapshot(array $definition, array $endpoint, array $body, string $operation, mixed $expectedId, mixed $expectedContainer = null): array
    {
        if (RuntimeCiwCotacaoAudit::supports($definition)) {
            $audit = RuntimeCiwCotacaoAudit::inspect($definition, $endpoint, $body, $operation, $expectedId);
            $this->emitContainerAuditEvents($definition, $audit);
            return $audit;
        }
        if (RuntimeCiwParametroAudit::supports($definition)) {
            $audit = RuntimeCiwParametroAudit::inspect($definition, $endpoint, $body, $operation, $expectedId);
            if (!$audit['metadata']['available']) {
                $this->transactions->log($definition['entityCode'] . '.api.audit.unavailable', 'Parametro confirmado; snapshot de auditoria indisponivel.', metadata: ['audit' => $audit['metadata']]);
            }
            return $audit;
        }
        if (RuntimeContainerAudit::supports($definition)) {
            $audit = RuntimeContainerAudit::inspect($definition, $endpoint, $body, $operation, $expectedId, $expectedContainer);
            $this->emitContainerAuditEvents($definition, $audit);
            return $audit;
        }
        $reason = 'not_provided';
        $audit = $body['audit'] ?? null;
        if (($definition['apiSource']['responseContract'] ?? 'generic') !== 'sursum-programs') {
            $reason = 'unsupported_contract';
        } elseif (array_key_exists('audit', $body)) {
            $reason = 'invalid';
            $resource = $this->trustedAuditResource($definition, $endpoint, $operation);
            $valid = is_array($audit) && ($audit['version'] ?? null) === 1
                && ($audit['source'] ?? null) === 'progress-transaction' && ($audit['operation'] ?? null) === $operation
                && $resource !== null && ($audit['resource'] ?? null) === $resource
                && is_int($audit['recordId'] ?? null) && $audit['recordId'] > 0 && $audit['recordId'] <= 2147483647
                && ($expectedId === null || (is_int($expectedId) || is_string($expectedId)) && (string) $expectedId === (string) $audit['recordId'])
                && is_array($audit['before'] ?? null) && is_array($audit['after'] ?? null)
                && ($audit['before'] === [] || !array_is_list($audit['before'])) && ($audit['after'] === [] || !array_is_list($audit['after']))
                && ($operation !== 'create' || $audit['before'] === []) && ($operation !== 'delete' || $audit['after'] === []);
            if ($valid) {
                $before = $this->mapConfirmedAuditSnapshot($definition, $audit['before'], $resource);
                $after = $this->mapConfirmedAuditSnapshot($definition, $audit['after'], $resource);
                $primaryKey = $definition['primaryKey'];
                $valid = $before !== null && $after !== null
                    && (!in_array($resource, ['empresas', 'tipos_anexo', 'coloracoes', 'situacoes_container', 'tipos_versao_custo', 'motivos_desconto'], true) || !array_diff(array_keys($audit), ['version', 'source', 'resource', 'operation', 'recordId', 'before', 'after']))
                    && ($operation === 'create' || ($before[$primaryKey] ?? null) === $audit['recordId'])
                    && ($operation === 'delete' || ($after[$primaryKey] ?? null) === $audit['recordId']);
                if ($valid) {
                    return ['before' => $before, 'after' => $after, 'metadata' => ['available' => true,
                        'version' => 1, 'source' => 'progress-transaction', 'resource' => $resource,
                        'operation' => $operation, 'recordId' => $audit['recordId']]];
                }
            }
            $this->transactions->log($definition['entityCode'] . '.api.audit.unavailable',
                'Snapshot de auditoria da API indisponivel.', metadata: ['reason' => 'invalid', 'operation' => $operation]);
        }
        return ['before' => [], 'after' => [], 'metadata' => ['available' => false, 'reason' => $reason]];
    }

    /** Resource identity comes from registered metadata, never from the response or browser. */
    private function trustedAuditResource(array $definition, array $endpoint, string $operation): ?string
    {
        if (RuntimeCiwCadastroAudit::supports($definition)) { return RuntimeCiwCadastroAudit::resource($definition, $endpoint, $operation); }
        if (RuntimeContainerAudit::supports($definition)) {
            return RuntimeContainerAudit::resource($definition, $endpoint, $operation);
        }
        $resource = $endpoint['bodyTemplate']['resource'] ?? null;
        $legacy = match ($definition['entityCode']) {
            'empresas_progress' => ['empresas', 'empresa_id', 'motor_progress_empresas', 'empresas'],
            'tipos_anexo_progress' => ['tipos_anexo', 'tipo_anexo_id', 'motor_progress_tipos_anexo', 'tipos-anexo'],
            default => null,
        };
        if (!$legacy) {
            return in_array($resource, ['despesas', 'empresas_despesa'], true) ? $resource : null;
        }
        if (!$legacy || $definition['primaryKey'] !== $legacy[1] || ($definition['apiBinding']['sourceCode'] ?? null) !== $legacy[2]
            || strtoupper((string) ($endpoint['method'] ?? '')) !== 'POST' || ($endpoint['bodyTemplate'] ?? null) !== ['operation' => $operation]) {
            return null;
        }
        $path = parse_url((string) ($endpoint['url'] ?? ''), PHP_URL_PATH);
        return in_array($path, ['/SursumPrograms/' . $legacy[3], '/med/web/SursumPrograms/' . $legacy[3]], true) ? $legacy[0] : null;
    }

    /** The two legacy APIs return complete, closed records, unlike presentation-only fields. */
    private function mapConfirmedAuditSnapshot(array $definition, array $snapshot, string $resource): ?array
    {
        if (RuntimeCiwCadastroAudit::supports($definition) && !RuntimeCiwCadastroAudit::validSnapshot($definition, $snapshot, $resource)) { return null; }
        $types = match ($resource) {
            'empresas' => ['empresa_id' => 'integer', 'nome' => 'string', 'cod_emp_ems2' => 'integer', 'cod_emp_ems5' => 'integer'],
            'tipos_anexo' => ['tipo_anexo_id' => 'integer', 'descricao' => 'string'],
            default => null,
        };
        if ($types && $snapshot !== []) {
            if (array_diff_key($snapshot, $types) || array_diff_key($types, $snapshot)) {
                return null;
            }
            foreach ($types as $code => $type) {
                $field = $definition['fields'][$code] ?? null;
                $value = $snapshot[$code];
                if (!$field || $field['dataType'] !== $type || $field['jsonPath'] !== $code
                    || ($value !== null && ($type === 'integer'
                        ? !is_int($value) || $value < -2147483648 || $value > 2147483647
                        : !is_string($value) || mb_strlen($value) > ($resource === 'empresas' ? 50 : 100)))) {
                    return null;
                }
            }
        }
        return $this->mapAuditSnapshot($definition, $snapshot);
    }

    /** Validate the entire batch before emitting any row-level confirmed event. */
    private function batchAuditSnapshots(array $definition, array $endpoint, array $body, array $changes): array
    {
        $unavailable = static fn (string $reason): array => ['rows' => [], 'metadata' => ['available' => false, 'reason' => $reason]];
        if (($definition['apiSource']['responseContract'] ?? 'generic') !== 'sursum-programs') {
            return $unavailable('unsupported_contract');
        }
        if (!array_key_exists('audit', $body)) {
            return $unavailable('not_provided');
        }
        $audit = $body['audit'];
        $resource = $this->trustedAuditResource($definition, $endpoint, 'batch');
        $results = $body['results'] ?? null;
        if (($resource !== 'tipos_anexo' && !(RuntimeCiwCadastroAudit::supports($definition) && $resource !== null)) || !is_array($audit) || array_diff(array_keys($audit), ['version', 'source', 'resource', 'operation', 'changes'])
            || ($audit['version'] ?? null) !== 1 || ($audit['source'] ?? null) !== 'progress-transaction'
            || ($audit['resource'] ?? null) !== $resource || ($audit['operation'] ?? null) !== 'batch'
            || !is_array($audit['changes'] ?? null) || !array_is_list($audit['changes']) || count($audit['changes']) !== count($changes)
            || !is_array($results) || !array_is_list($results) || count($results) !== count($changes)) {
            return $unavailable('invalid');
        }
        $requested = array_column($changes, null, 'clientId');
        $byClientId = [];
        $resultIds = [];
        foreach ($results as $result) {
            if (!is_array($result) || !is_string($result['clientId'] ?? null) || !isset($requested[$result['clientId']])
                || isset($byClientId[$result['clientId']]) || ($result['operation'] ?? null) !== $requested[$result['clientId']]['operation']
                || !is_int($result['id'] ?? null) || $result['id'] < 1 || $result['id'] > 2147483647 || isset($resultIds[$result['id']])
                || ($result['operation'] !== 'create' && $result['id'] !== $requested[$result['clientId']]['id'])) {
                return $unavailable('invalid');
            }
            $byClientId[$result['clientId']] = $result;
            $resultIds[$result['id']] = true;
        }
        $rows = [];
        foreach ($audit['changes'] as $change) {
            if (!is_array($change) || array_diff(array_keys($change), ['clientId', 'operation', 'recordId', 'before', 'after'])
                || !is_string($change['clientId'] ?? null) || !isset($byClientId[$change['clientId']]) || isset($rows[$change['clientId']])
                || ($change['operation'] ?? null) !== $byClientId[$change['clientId']]['operation']
                || ($change['recordId'] ?? null) !== $byClientId[$change['clientId']]['id']
                || !is_array($change['before'] ?? null) || !is_array($change['after'] ?? null)) {
                return $unavailable('invalid');
            }
            $operation = $change['operation'];
            $before = $this->mapConfirmedAuditSnapshot($definition, $change['before'], $resource);
            $after = $this->mapConfirmedAuditSnapshot($definition, $change['after'], $resource);
            if ($before === null || $after === null || ($operation === 'create' && $before !== []) || ($operation === 'delete' && $after !== [])
                || ($operation !== 'create' && ($before[$definition['primaryKey']] ?? null) !== $change['recordId'])
                || ($operation !== 'delete' && ($after[$definition['primaryKey']] ?? null) !== $change['recordId'])) {
                return $unavailable('invalid');
            }
            $rows[$change['clientId']] = ['before' => $before, 'after' => $after, 'metadata' => ['available' => true, 'version' => 1,
                'source' => 'progress-transaction', 'resource' => $resource, 'operation' => $operation, 'recordId' => $change['recordId']]];
        }
        // Preserve request order in the audit trail while accepting any response ordering.
        $ordered = [];
        foreach ($changes as $change) {
            $ordered[$change['clientId']] = $rows[$change['clientId']];
        }
        return ['rows' => $ordered, 'metadata' => ['available' => true, 'version' => 1, 'source' => 'progress-transaction',
            'resource' => $resource, 'operation' => 'batch', 'changesCount' => count($ordered)]];
    }

    /** Map only fields actually present; omitted fields are not null database values. */
    private function mapAuditSnapshot(array $definition, array $snapshot): ?array
    {
        $mapped = [];
        foreach ($definition['fields'] as $field) {
            $code = $field['code'];
            $path = (string) $field['jsonPath'];
            if (preg_match('/senha|password|token|authorization|api[_-]?key|secret|private[_-]?key|credential/i', $code . '.' . $path)) {
                continue;
            }
            $value = $snapshot;
            foreach (explode('.', $path) as $part) {
                if (!is_array($value) || !array_key_exists($part, $value)) {
                    continue 2;
                }
                $value = $value[$part];
            }
            if ($field['collection']) {
                if (!is_array($value) || !array_is_list($value) || count($value) > 100) { return null; }
                foreach ($value as $id) {
                    if (!is_int($id) || $id < 1 || $id > 2147483647) { return null; }
                }
            } elseif ($value !== null) {
                $valid = match ($field['dataType']) {
                    'integer' => is_int($value),
                    'decimal', 'number', 'currency' => is_int($value) || is_float($value),
                    'boolean' => is_bool($value) || $value === 0 || $value === 1,
                    default => is_string($value),
                };
                if (!$valid) { return null; }
            }
            $mapped[$code] = $value;
        }
        return $mapped;
    }
    private function batch(array $definition, array $config, array $payload): array
    {
        $session = $this->authenticatedSessions?->resolve();
        if (!$session || $session->getStatus() !== 'active') {
            throw new RuntimeHttpException('AUTH_REQUIRED', 'Uma sessao autenticada ativa e obrigatoria para salvar o lote.', 401);
        }
        $endpoint = $definition['apiSource']['batchEndpoint'] ?? null;
        if (!is_array($endpoint) || empty($endpoint['url']) || strtoupper((string) ($endpoint['method'] ?? '')) !== 'POST') {
            throw new RuntimeHttpException('ENTITY_API_BATCH_UNAVAILABLE', 'A entidade API nao possui operacao de lote POST configurada.', 422);
        }
        // Context comes exclusively from the signed endpoint, never from the browser.
        $allowedContext = ['entityCode', 'operation', 'actionId', 'programId', '_runtimeEndpoint'];
        if (array_diff(array_keys($payload), array_merge(['changes'], $allowedContext))) {
            throw new RuntimeHttpException('ENTITY_API_BATCH_INVALID', 'O lote possui propriedades desconhecidas.', 422);
        }
        foreach (['entityCode', 'operation', 'programId', 'actionId'] as $key) {
            if (array_key_exists($key, $payload) && ($payload[$key] !== ($config[$key] ?? ($key === 'actionId' ? 'batch' : null)))) {
                throw new RuntimeHttpException('ENTITY_API_BATCH_INVALID', 'Contexto do lote difere do endpoint publicado.', 422);
            }
        }
        $changes = $payload['changes'] ?? null;
        if (!is_array($changes) || !array_is_list($changes) || count($changes) < 1 || count($changes) > 100) {
            throw new RuntimeHttpException('ENTITY_API_BATCH_INVALID', 'Informe entre 1 e 100 alteracoes no lote.', 422);
        }
        $requestChanges = [];
        $clientIds = [];
        $recordIds = [];
        foreach ($changes as $index => $change) {
            $clientId = is_array($change) && is_string($change['clientId'] ?? null) ? $change['clientId'] : '';
            $line = $index + 1;
            $fail = static function (string $message) use ($line, $clientId): never {
                $reference = preg_match('/^[A-Za-z0-9_.:-]{1,160}$/D', $clientId) ? ' (' . $clientId . ')' : '';
                throw new RuntimeHttpException('ENTITY_API_BATCH_INVALID', 'Linha ' . $line . $reference . ': ' . $message, 422, ['line' => $line, 'clientId' => $reference !== '' ? $clientId : null]);
            };
            if (!is_array($change) || array_is_list($change) || array_diff(array_keys($change), ['operation', 'clientId', 'id', 'data', 'original'])) {
                $fail('Estrutura da alteracao invalida.');
            }
            $operation = $change['operation'] ?? null;
            if (!in_array($operation, ['create', 'update', 'delete'], true)) {
                $fail('Operacao invalida.');
            }
            if (!preg_match('/^[A-Za-z0-9_.:-]{1,160}$/D', $clientId) || isset($clientIds[$clientId])) {
                $fail('clientId invalido ou repetido.');
            }
            $clientIds[$clientId] = true;
            $allowKey = ['create' => 'allowCreate', 'update' => 'allowUpdate', 'delete' => 'allowDelete'][$operation];
            $suffix = $operation === 'update' ? 'edit' : $operation;
            $prefix = trim((string) ($config['permissionPrefix'] ?? '')) ?: $definition['entityCode'];
            if (($config[$allowKey] ?? false) !== true || !$this->permissions?->hasPermission($prefix . '.' . $suffix)) {
                throw new RuntimeHttpException('ENTITY_API_BATCH_FORBIDDEN', 'Linha ' . $line . ' (' . $clientId . '): sem permissao para ' . $operation . '.', 403, ['line' => $line, 'clientId' => $clientId]);
            }
            $mapped = ['operation' => $operation, 'clientId' => $clientId];
            if ($operation === 'create') {
                if (array_key_exists('id', $change) || array_key_exists('original', $change)) {
                    $fail('Inclusao nao aceita identificador nem estado original.');
                }
            } else {
                $id = $change['id'] ?? null;
                if (!is_int($id) || $id < 1 || $id > 2147483647 || isset($recordIds[$id])) {
                    $fail('Identificador deve ser inteiro positivo int32, sem repeticao no lote.');
                }
                $recordIds[$id] = true;
                $mapped['id'] = $id;
            }
            if ($operation === 'delete') {
                if (array_key_exists('data', $change)) {
                    $fail('Exclusao nao aceita dados de gravacao.');
                }
            } else {
                $data = $change['data'] ?? null;
                $mapped['data'] = $this->validateBatchRecord($definition, $data, false, $operation === 'create', $fail);
            }
            if ($operation !== 'create') {
                $original = $change['original'] ?? null;
                $mapped['original'] = $this->validateBatchRecord($definition, $original, true, false, $fail);
                foreach ($definition['fields'] as $field) {
                    if (!$field['primaryKey'] && !$field['readonly'] && !array_key_exists($field['code'], $original)) {
                        $fail('Informe o estado original dos campos editaveis para verificar concorrencia.');
                    }
                }
            }
            $requestChanges[] = $mapped;
        }

        // Static credentials/options may be merged; a template must never append changes.
        if (isset($endpoint['bodyTemplate']) && (!is_array($endpoint['bodyTemplate']) || array_is_list($endpoint['bodyTemplate']) && $endpoint['bodyTemplate'] !== [])) {
            throw new RuntimeHttpException('ENTITY_API_BATCH_UNAVAILABLE', 'Template do lote deve ser um objeto JSON.', 422);
        }
        unset($endpoint['bodyTemplate']['changes']);
        $startedAt = microtime(true);
        $metadata = ['entityCode' => $definition['entityCode'], 'changesCount' => count($requestChanges)];
        try {
            // One external request: atomicity and concurrency checks belong to the API transaction.
            $response = $this->requestEndpoint($definition, $endpoint, $definition['apiSource']['authHeaders'] ?? [], [], ['operation' => 'batch', 'changes' => $requestChanges]);
            $itemsPath = (string) ($definition['apiSource']['batchResponse']['itemsPath'] ?? $definition['apiSource']['listResponse']['itemsPath']);
            $items = $this->extractItems($response['body'], $itemsPath);
            $data = array_map(fn (mixed $item): array => $this->mapItem($definition, is_array($item) ? $item : []), $items);
            $result = ['data' => $data, 'total' => count($data)];
            if (is_array($response['body']['results'] ?? null)) {
                $result['results'] = $response['body']['results'];
            }
            $audit = $this->batchAuditSnapshots($definition, $endpoint, $response['body'], $requestChanges);
            foreach ($audit['rows'] as $clientId => $row) {
                $this->transactions->log($definition['entityCode'] . '.api.' . $row['metadata']['operation'], 'Alteracao do lote confirmada pela API externa.',
                    before: $row['before'], after: $row['after'], metadata: $metadata + ['clientId' => (string) $clientId, 'audit' => $row['metadata'], 'httpStatus' => $response['status']]);
            }
            $this->transactions->log($definition['entityCode'] . '.api.batch', 'Lote confirmado pela API externa.', metadata: $metadata + ['audit' => $audit['metadata'], 'httpStatus' => $response['status'], 'durationMs' => (int) round((microtime(true) - $startedAt) * 1000)]);
            return $result;
        } catch (\Throwable $error) {
            $this->transactions->log($definition['entityCode'] . '.api.batch.failed', 'Falha transacional ao salvar lote na API externa.', metadata: $metadata + ['audit' => ['available' => false, 'reason' => 'not_committed'], 'errorCode' => $error instanceof RuntimeHttpException ? $error->getErrorCode() : 'ENTITY_API_BATCH_FAILED', 'durationMs' => (int) round((microtime(true) - $startedAt) * 1000)]);
            throw $error;
        }
    }

    private function validateBatchRecord(array $definition, mixed $record, bool $original, bool $create, callable $fail): array
    {
        if (!is_array($record) || array_is_list($record) || $record === []) {
            $fail($original ? 'Estado original obrigatorio.' : 'Dados de gravacao obrigatorios.');
        }
        foreach ($record as $code => $value) {
            $field = $definition['fields'][$code] ?? null;
            if (!$field || $field['primaryKey'] || $field['readonly']) {
                $fail('Campo desconhecido ou nao editavel: ' . $code . '.');
            }
            if ($value === null && ($original || !$field['required'])) {
                continue;
            }
            $valid = match ($field['dataType']) {
                'integer' => is_int($value) && $value >= -2147483648 && $value <= 2147483647,
                'decimal', 'number', 'float' => (is_int($value) || is_float($value)) && is_finite((float) $value),
                'boolean' => is_bool($value),
                default => is_string($value),
            };
            if (!$valid || (is_string($value) && $field['maxLength'] !== null && mb_strlen($value) > (int) $field['maxLength'])) {
                $fail('Tipo ou tamanho invalido para ' . $code . '.');
            }
            if (!$original && $field['required'] && is_string($value) && trim($value) === '') {
                $fail('Campo obrigatorio: ' . $code . '.');
            }
        }
        if ($create) {
            foreach ($definition['fields'] as $field) {
                if (!$field['primaryKey'] && !$field['readonly'] && $field['required'] && !array_key_exists($field['code'], $record)) {
                    $fail('Campo obrigatorio: ' . $field['code'] . '.');
                }
            }
        }
        return $this->buildWritePayload($definition, $record, false);
    }

    private function resolveDefinition(string $entityCode): array
    {
        if ($entityCode === '') {
            throw new RuntimeHttpException('ENTITY_CODE_REQUIRED', 'Informe a entidade da operacao.', 422);
        }

        $entity = $this->entities->findOneBy(['code' => $entityCode]);
        if (!$entity instanceof BuilderEntity) {
            throw new RuntimeHttpException('ENTITY_METADATA_NOT_CONFIGURED', 'Entidade nao configurada no construtor.', 422, [
                'entityCode' => $entityCode,
            ]);
        }
        if ($this->companyContexts && !$this->companyMetadata) { throw new RuntimeHttpException('API_COMPANY_CONTEXT_UNAVAILABLE', 'Verificacao estrutural da API indisponivel.', 503); }
        $this->companyMetadata?->assertEntity($entity);
        if ($entity->getEntityType() !== 'api') {
            throw new RuntimeHttpException('ENTITY_NOT_API', 'A entidade informada nao e do tipo API.', 422, [
                'entityCode' => $entityCode,
                'entityType' => $entity->getEntityType(),
            ]);
        }

        $apiSource = is_array($entity->getMetadata()['apiSource'] ?? null) ? $entity->getMetadata()['apiSource'] : [];
        if (empty($apiSource['listEndpoint']['url']) || empty($apiSource['listResponse']['itemsPath'])) {
            throw new RuntimeHttpException('ENTITY_API_NOT_CONFIGURED', 'Entidade API sem configuracao minima de consulta.', 422, [
                'entityCode' => $entityCode,
            ]);
        }

        $fields = [];
        $primaryKey = '';
        foreach ($entity->getFields() as $field) {
            $options = $field->getOptions();
            $apiField = is_array($options['api'] ?? null) ? $options['api'] : [];
            $jsonPath = trim((string) ($apiField['jsonPath'] ?? ''));
            if ($jsonPath === '') {
                $jsonPath = $field->getCode();
            }
            $fields[$field->getCode()] = [
                'code' => $field->getCode(),
                'label' => $field->getLabel(),
                'dataType' => $field->getDataType(),
                'required' => $field->isRequired(),
                'maxLength' => $field->getLength() ?? ($options['maxLength'] ?? null),
                'primaryKey' => $field->isPrimaryKey(),
                'jsonPath' => $jsonPath,
                'writePath' => trim((string) ($apiField['writePath'] ?? $jsonPath)),
                'readonly' => ($options['readonly'] ?? false) === true || ($options['writable'] ?? true) === false,
                'lookupResolver' => $this->normalizeLookupResolver($apiField['lookupResolver'] ?? null),
                'collection' => $apiField['collection'] ?? null,
                'optionsSource' => $apiField['optionsSource'] ?? null,
            ];
            if ($field->isPrimaryKey()) {
                $primaryKey = $field->getCode();
            }
        }

        if ($primaryKey === '') {
            throw new RuntimeHttpException('ENTITY_API_PRIMARY_KEY_REQUIRED', 'Entidade API precisa definir um campo chave primaria para consulta de detalhe.', 422, [
                'entityCode' => $entityCode,
            ]);
        }

        return [
            'entityCode' => $entityCode,
            'primaryKey' => $primaryKey,
            'apiSource' => $apiSource,
            'apiBinding' => is_array($entity->getMetadata()['apiBinding'] ?? null) ? $entity->getMetadata()['apiBinding'] : [],
            ...(array_key_exists('apiCompanyContext', $entity->getMetadata())
                ? ['apiCompanyContext' => \App\Builder\ApiCompanyContextValidator::validateEntityConfig($entity->getMetadata()['apiCompanyContext'], 'api')] : []),
            'fields' => $fields,
        ];
    }

    private function requestEndpoint(array $definition, array $endpoint, array $authHeaders, array $tokens = [], mixed $requestData = null): array
    {
        $url = $this->replaceTokens((string) ($endpoint['url'] ?? ''), $tokens);
        $headers = $this->mergeHeaders($authHeaders, is_array($endpoint['headers'] ?? null) ? $endpoint['headers'] : []);
        $query = is_array($endpoint['queryParams'] ?? null) ? $endpoint['queryParams'] : [];
        if ($tokens) {
            foreach ($tokens as $key => $value) {
                $query[$key] = $query[$key] ?? $value;
            }
        }
        $method = strtoupper((string) ($endpoint['method'] ?? 'GET'));
        $bodyTemplate = $endpoint['bodyTemplate'] ?? null;
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'], true) && is_array($bodyTemplate)) {
            foreach ($tokens as $key => $value) {
                $bodyTemplate[$key] = $bodyTemplate[$key] ?? $value;
            }
        }
        $payload = null;
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            $payloadValue = $this->mergeRequestPayload($bodyTemplate, $requestData);
            $payload = $payloadValue;
        }

        if (!empty($definition['apiCompanyContext'])) {
            $context = $definition['_apiCompanyContext'] ?? null;
            $mapping = $this->companyEndpointMapping($definition, $endpoint, $context);
            if ($mapping !== null) {
                if (!$this->companyAdapter) { throw new \LogicException('Company adapter required.'); }
                $request = $this->companyAdapter->apply($context, $mapping, $endpoint, ['headers'=>$headers, 'query'=>$query, 'body'=>$payload]);
                $headers = $request['headers']; $query = $request['query']; $payload = $request['body'];
            }
        }
        if ($query) {
            $separator = str_contains($url, '?') ? '&' : '?';
            $url .= $separator . http_build_query($query);
        }
        return $this->externalJsonClient->request(
            $url,
            $method,
            $headers,
            $payload,
            max(1, (int) ($definition['apiSource']['timeoutSeconds'] ?? 20)),
            ['entityCode' => $definition['entityCode'], 'responseContract' => $definition['apiSource']['responseContract'] ?? 'generic']
        );
    }

    private function companyEndpointMapping(array $definition, array $endpoint, ?ApiCompanyContext $context): ?array
    {
        $identity = static function(array $value): array {
            $query = $value['queryParams'] ?? []; $headers = [];
            foreach ($value['headers'] ?? [] as $name=>$header) { $headers[strtolower((string)$name)] = $header; }
            ksort($query); ksort($headers);
            return [(string)($value['url'] ?? $value['path'] ?? ''), strtoupper($value['method'] ?? 'GET'), $value['bodyTemplate'] ?? null, $query, $headers];
        };
        $candidates = [];
        foreach (['listEndpoint'=>'read','detailEndpoint'=>'get','createEndpoint'=>'create','updateEndpoint'=>'update','deleteEndpoint'=>'delete','batchEndpoint'=>'batch'] as $key=>$operation) {
            if (is_array($definition['apiSource'][$key] ?? null) && $identity($endpoint) === $identity($definition['apiSource'][$key])) { $candidates[] = $operation; }
        }
        foreach ($definition['apiSource']['operations'] ?? [] as $operation) {
            if (is_array($operation) && $identity($endpoint) === $identity($operation)) { $candidates[] = $operation['code'] ?? ''; }
        }
        if (!$candidates) { throw new RuntimeHttpException('API_COMPANY_OPERATION_UNCONFIGURED', 'Chamada auxiliar sem contrato empresarial cadastrado.', 422); }
        if (isset($definition['apiCompanyContext']['adapter'])) {
            if (!$context) { throw new RuntimeHttpException('API_COMPANY_REQUIRED', 'Esta chamada exige empresa autorizada.', 422); }
            return $context->mapping;
        }
        $entries = [];
        foreach ($candidates as $candidate) {
            if (isset($definition['apiCompanyContext']['operations'][$candidate])) { $entries[] = $definition['apiCompanyContext']['operations'][$candidate]; }
        }
        if (!$entries) { throw new RuntimeHttpException('API_COMPANY_OPERATION_UNCONFIGURED', 'Operacao sem contrato empresarial cadastrado.', 422); }
        $mapping = null; $shared = null;
        foreach ($entries as $entry) {
            $isShared = $entry['mode'] === 'shared';
            if ($shared !== null && $shared !== $isShared) { throw new RuntimeHttpException('API_COMPANY_CONFIG_INVALID', 'Operacoes empresariais ambiguas na fonte.', 422); }
            $shared = $isShared;
            if ($isShared) { continue; }
            if (!$context) { throw new RuntimeHttpException('API_COMPANY_REQUIRED', 'Esta chamada auxiliar exige empresa autorizada.', 422); }
            $candidate = $context->adapters[$entry['adapter']] ?? null;
            if ($candidate === null && ($definition['apiCompanyContext']['operations'][$definition['_apiCompanyOperation']]['adapter'] ?? null) === $entry['adapter']) { $candidate = $context->mapping; }
            if (!is_array($candidate) || ($mapping !== null && $mapping !== $candidate)) { throw new RuntimeHttpException('API_COMPANY_CONFIG_INVALID', 'Mapeamento empresarial inconsistente.', 422); }
            $mapping = $candidate;
        }
        return $mapping;
    }

    private function mergeHeaders(array $authHeaders, array $endpointHeaders): array
    {
        $headers = [];
        foreach ([$authHeaders, $endpointHeaders] as $group) {
            foreach ($group as $key => $value) {
                $headers[(string) $key] = (string) $value;
            }
        }

        return $headers;
    }

    private function extractItems(array $body, string $itemsPath): array
    {
        $items = $this->extractByPath($body, $itemsPath);
        if (!is_array($items)) {
            throw new RuntimeHttpException('ENTITY_API_ITEMS_NOT_ARRAY', 'A API externa nao retornou um array no itemsPath configurado.', 422, [
                'itemsPath' => $itemsPath,
            ]);
        }

        return array_values($items);
    }

    private function extractByPath(mixed $value, string $path): mixed
    {
        if ($path === '' || $path === '$') {
            return $value;
        }

        return array_reduce(explode('.', $path), static function (mixed $current, string $part): mixed {
            if (!is_array($current) || !array_key_exists($part, $current)) {
                return null;
            }

            return $current[$part];
        }, $value);
    }

    private function mapItem(array $definition, array $item): array
    {
        $mapped = [];
        foreach ($definition['fields'] as $field) {
            $value = $this->extractByPath($item, (string) $field['jsonPath']);
            $mapped[$field['code']] = $field['collection'] ? $this->validateIntegerCollection($value, $field['code']) : $value;
        }

        return $mapped;
    }

    private function enrichRows(array $definition, array $rows): array
    {
        if ($rows === []) {
            return $rows;
        }

        $groups = [];
        foreach ($definition['fields'] as $field) {
            $resolver = is_array($field['lookupResolver'] ?? null) ? $field['lookupResolver'] : null;
            if (!$resolver) {
                continue;
            }
            $groupKey = json_encode([
                'operationCode' => $resolver['operationCode'],
                'sourceField' => $resolver['sourceField'],
                'mode' => $resolver['mode'],
                'requestParam' => $resolver['requestParam'],
                'responseItemsPath' => $resolver['responseItemsPath'],
                'responseItemPath' => $resolver['responseItemPath'],
                'matchField' => $resolver['matchField'],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if (!is_string($groupKey) || $groupKey === '') {
                continue;
            }
            if (!isset($groups[$groupKey])) {
                $groups[$groupKey] = [
                    'resolver' => $resolver,
                    'fields' => [],
                ];
            }
            $groups[$groupKey]['fields'][] = $field;
        }

        if ($groups === []) {
            return $rows;
        }

        $resolvedByGroup = [];
        foreach ($groups as $groupKey => $group) {
            $sourceField = (string) $group['resolver']['sourceField'];
            $values = [];
            foreach ($rows as $row) {
                $value = $row[$sourceField] ?? null;
                if ($value === null || $value === '') {
                    continue;
                }
                $values[(string) $value] = $value;
            }
            if ($values === []) {
                continue;
            }
            $resolvedByGroup[$groupKey] = $this->resolveLookupItems($definition, $group['resolver'], array_values($values));
        }

        if ($resolvedByGroup === []) {
            return $rows;
        }

        foreach ($rows as $rowIndex => $row) {
            foreach ($groups as $groupKey => $group) {
                $sourceValue = $row[$group['resolver']['sourceField']] ?? null;
                if ($sourceValue === null || $sourceValue === '') {
                    continue;
                }
                $resolvedItem = $resolvedByGroup[$groupKey][(string) $sourceValue] ?? null;
                if (!is_array($resolvedItem)) {
                    continue;
                }
                foreach ($group['fields'] as $field) {
                    $valuePath = (string) ($field['lookupResolver']['valuePath'] ?? '$');
                    $rows[$rowIndex][$field['code']] = $this->extractByPath($resolvedItem, $valuePath);
                }
            }
        }

        return $rows;
    }

    private function resolveLookupItems(array $definition, array $resolver, array $values): array
    {
        $operation = $this->findOperation($definition, (string) $resolver['operationCode']);
        $resolved = [];
        if ((string) $resolver['mode'] === 'per_value') {
            foreach ($values as $value) {
                $response = $this->requestEndpoint($definition, $operation, $definition['apiSource']['authHeaders'], [
                    (string) $resolver['requestParam'] => $value,
                ]);
                $item = $this->extractByPath($response['body'], (string) $resolver['responseItemPath']);
                $resolved[(string) $value] = is_array($item) ? $item : null;
            }

            return $resolved;
        }

        $response = $this->requestEndpoint($definition, $operation, $definition['apiSource']['authHeaders'], [], [
            (string) $resolver['requestParam'] => array_values($values),
        ]);
        $items = $this->extractByPath($response['body'], (string) $resolver['responseItemsPath']);
        if (!is_array($items)) {
            throw new RuntimeHttpException('ENTITY_API_LOOKUP_ITEMS_INVALID', 'A operacao de lookup nao retornou um array valido.', 422, [
                'entityCode' => $definition['entityCode'],
                'operationCode' => $resolver['operationCode'],
                'responseItemsPath' => $resolver['responseItemsPath'],
            ]);
        }

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }
            $matchValue = $this->extractByPath($item, (string) $resolver['matchField']);
            if ($matchValue === null || $matchValue === '') {
                continue;
            }
            $resolved[(string) $matchValue] = $item;
        }

        return $resolved;
    }

    private function findOperation(array $definition, string $operationCode): array
    {
        foreach ($definition['apiSource']['operations'] ?? [] as $operation) {
            if (is_array($operation) && (string) ($operation['code'] ?? '') === $operationCode) {
                return [
                    'url' => (string) ($operation['path'] ?? ''),
                    'method' => strtoupper((string) ($operation['method'] ?? 'GET')),
                    'headers' => is_array($operation['headers'] ?? null) ? $operation['headers'] : [],
                    'queryParams' => is_array($operation['queryParams'] ?? null) ? $operation['queryParams'] : [],
                    'bodyTemplate' => $operation['bodyTemplate'] ?? null,
                    'requestContextFields' => $operation['requestContextFields'] ?? [],
                ];
            }
        }

        throw new RuntimeHttpException('ENTITY_API_LOOKUP_OPERATION_NOT_FOUND', 'Operacao de lookup nao cadastrada para a entidade API.', 422, [
            'entityCode' => $definition['entityCode'],
            'operationCode' => $operationCode,
        ]);
    }

    private function normalizeLookupResolver(mixed $value): ?array
    {
        if (!is_array($value)) {
            return null;
        }
        $operationCode = trim((string) ($value['operationCode'] ?? ''));
        $sourceField = trim((string) ($value['sourceField'] ?? ''));
        $requestParam = trim((string) ($value['requestParam'] ?? ''));
        $mode = strtolower(trim((string) ($value['mode'] ?? 'batch')));
        $valuePath = trim((string) ($value['valuePath'] ?? '$'));
        $responseItemsPath = trim((string) ($value['responseItemsPath'] ?? ($value['itemsPath'] ?? '$')));
        $responseItemPath = trim((string) ($value['responseItemPath'] ?? ($value['itemPath'] ?? '$')));
        $matchField = trim((string) ($value['matchField'] ?? ''));
        if ($operationCode === '' || $sourceField === '' || $requestParam === '') {
            return null;
        }
        if (!in_array($mode, ['batch', 'per_value'], true)) {
            $mode = 'batch';
        }
        if ($mode === 'batch' && $matchField === '') {
            return null;
        }

        return [
            'operationCode' => $operationCode,
            'sourceField' => $sourceField,
            'requestParam' => $requestParam,
            'mode' => $mode,
            'valuePath' => $valuePath !== '' ? $valuePath : '$',
            'responseItemsPath' => $responseItemsPath !== '' ? $responseItemsPath : '$',
            'responseItemPath' => $responseItemPath !== '' ? $responseItemPath : '$',
            'matchField' => $matchField,
        ];
    }

    private function applySort(array $rows, mixed $sortConfig): array
    {
        $sorts = is_array($sortConfig) ? $sortConfig : [];
        if (!$sorts) {
            return $rows;
        }

        usort($rows, static function (array $left, array $right) use ($sorts): int {
            foreach ($sorts as $sort) {
                if (!is_array($sort)) {
                    continue;
                }
                $field = (string) ($sort['field'] ?? '');
                if ($field === '') {
                    continue;
                }
                $dir = strtolower((string) ($sort['dir'] ?? 'asc')) === 'desc' ? -1 : 1;
                $a = $left[$field] ?? null;
                $b = $right[$field] ?? null;
                if ($a == $b) {
                    continue;
                }
                return ($a <=> $b) * $dir;
            }

            return 0;
        });

        return $rows;
    }

    private function applyFilter(array $rows, mixed $filter): array
    {
        if (!is_array($filter)) {
            return $rows;
        }

        return array_values(array_filter($rows, fn (array $row): bool => $this->matchesFilter($row, $filter)));
    }

    private function matchesFilter(array $row, array $filter): bool
    {
        if (is_array($filter['filters'] ?? null)) {
            $logic = strtolower((string) ($filter['logic'] ?? 'and')) === 'or' ? 'or' : 'and';
            $results = array_map(fn (array $item): bool => $this->matchesFilter($row, $item), array_values($filter['filters']));
            return $logic === 'or' ? in_array(true, $results, true) : !in_array(false, $results, true);
        }

        $field = (string) ($filter['field'] ?? '');
        $operator = strtolower((string) ($filter['operator'] ?? 'eq'));
        $value = $filter['value'] ?? null;
        $current = $row[$field] ?? null;

        return match ($operator) {
            'contains' => str_contains(mb_strtolower((string) $current), mb_strtolower((string) $value)),
            'startswith' => str_starts_with(mb_strtolower((string) $current), mb_strtolower((string) $value)),
            'neq' => $current != $value,
            'gt' => $current > $value,
            'gte' => $current >= $value,
            'lt' => $current < $value,
            'lte' => $current <= $value,
            default => $current == $value,
        };
    }

    private function extractRecordId(array $definition, array $payload): string|int
    {
        foreach (['id', $definition['primaryKey']] as $field) {
            $value = $payload[$field] ?? (is_array($payload['record'] ?? null) ? ($payload['record'][$field] ?? null) : null);
            if (is_scalar($value) && $value !== '') {
                return is_int($value) ? $value : (string) $value;
            }
        }

        throw new RuntimeHttpException('ENTITY_API_ID_REQUIRED', 'Informe o identificador do registro para consultar o detalhe.', 422, [
            'entityCode' => $definition['entityCode'],
            'primaryKey' => $definition['primaryKey'],
        ]);
    }

    private function replaceTokens(string $value, array $tokens): string
    {
        return preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', static function (array $matches) use ($tokens): string {
            $key = (string) ($matches[1] ?? '');
            return isset($tokens[$key]) ? rawurlencode((string) $tokens[$key]) : '';
        }, $value) ?? $value;
    }

    private function extractSubmittedRecord(array $payload): array
    {
        $record = is_array($payload['record'] ?? null) ? $payload['record'] : $payload;
        unset($record['_runtime'], $record['_customCode'], $record['operation'], $record['entityCode'], $record['actionId'], $record['programId']);

        return is_array($record) ? $record : [];
    }

    private function buildWritePayload(array $definition, array $record, bool $includeReadonly): array
    {
        $payload = [];
        foreach ($definition['fields'] as $field) {
            if ($field['readonly'] && (!$includeReadonly || !$field['primaryKey'])) {
                continue;
            }
            $code = (string) $field['code'];
            if (!array_key_exists($code, $record)) {
                continue;
            }
            $writePath = trim((string) ($field['writePath'] ?? ''));
            if ($writePath === '') {
                $writePath = $code;
            }
            $value = $field['collection'] ? $this->validateIntegerCollection($record[$code], $code) : $record[$code];
            $this->setByPath($payload, $writePath, $value);
        }

        return $payload;
    }

    private function setByPath(array &$target, string $path, mixed $value): void
    {
        if ($path === '' || $path === '$') {
            return;
        }
        $parts = explode('.', $path);
        $current = &$target;
        foreach ($parts as $index => $part) {
            if ($index === count($parts) - 1) {
                $current[$part] = $value;
                return;
            }
            if (!isset($current[$part]) || !is_array($current[$part])) {
                $current[$part] = [];
            }
            $current = &$current[$part];
        }
    }

    private function mergeRequestPayload(mixed $template, mixed $requestData): mixed
    {
        if ($requestData === null) {
            return $template;
        }
        if ($template === null) {
            return $requestData;
        }
        if (is_array($template) && is_array($requestData)) {
            foreach ($requestData as $key => $value) {
                $template[$key] = is_array($value) && !array_is_list($value) && is_array($template[$key] ?? null)
                    ? $this->mergeRequestPayload($template[$key], $value) : $value;
            }
            return $template;
        }
        if (is_scalar($template)) {
            return $template;
        }

        return $requestData;
    }

    private function extractWriteResponseRecord(array $definition, array $body, string $responseKey, array $fallback): array
    {
        $responseConfig = is_array($definition['apiSource'][$responseKey] ?? null) ? $definition['apiSource'][$responseKey] : [];
        $itemPath = trim((string) ($responseConfig['itemPath'] ?? ''));
        if ($itemPath === '') {
            return $fallback;
        }
        $item = $this->extractByPath($body, $itemPath);
        if (!is_array($item)) {
            return $fallback;
        }

        return $this->mapItem($definition, $item);
    }
}
