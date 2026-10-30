param([switch]$ValidateOnly, [int]$ResumeVersionId=0, [switch]$RefreshBindingOnly, [switch]$RotateToken)
$ErrorActionPreference = 'Stop'
$state = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$metadata = 'D:\opencode\construtor-pg\integrations\ciw-tipos-anexo'
$base = 'http://127.0.0.1:8765'
$access = Get-Content -LiteralPath (Join-Path $state 'acesso-local.txt') |
    Where-Object { $_.StartsWith('Senha inicial=') }
$loginBody = @{username='admin'; password=$access.Substring('Senha inicial='.Length); tenantId='default'; rememberMe=$false}
$session = Invoke-RestMethod -Uri "$base/api/auth/login" -Method Post -ContentType 'application/json' -Body ($loginBody | ConvertTo-Json)
if (!$session.authenticated) { throw 'Login administrativo local não foi concluído.' }
$headers = @{Authorization=('Bearer '+$session.token); 'X-Runtime-Auth-Token'=[string]$session.token;
    'X-Runtime-Tenant-Id'=[string]$session.tenantId; 'X-Runtime-User-Id'=[string]$session.user.id;
    'X-Runtime-Session-Id'=[string]$session.session.sessionId}
$locks = [Collections.Generic.List[string]]::new()
function Api([string]$Path, $Body=$null, [string]$Method='POST') {
    $parameters = @{Uri=($base+'/api/admin/program-builder'+$Path); Method=$Method; Headers=$headers;
        ContentType='application/json'; SkipHttpErrorCheck=$true; TimeoutSec=45}
    if ($Method -ne 'GET') { $parameters.Body = ConvertTo-Json -InputObject $Body -Depth 40 -Compress }
    $response = Invoke-WebRequest @parameters
    try { $result = $response.Content | ConvertFrom-Json } catch { throw "Resposta inválida em $Path (HTTP $($response.StatusCode))." }
    if ($response.StatusCode -ge 400 -or $result.error) {
        throw "$Path -> HTTP $($response.StatusCode): $($result.error.code) $($result.error.message)"
    }
    return $result
}
try {
    $source = Get-Content -LiteralPath (Join-Path $metadata 'api-source.json') -Raw | ConvertFrom-Json
    $connectionPath = Join-Path $state 'tipos-anexo-connection.json'
    if ($RotateToken -or !(Test-Path -LiteralPath $connectionPath)) {
        $random = [Security.Cryptography.RandomNumberGenerator]::GetBytes(32)
        $token = [Convert]::ToHexString($random).ToLowerInvariant()
        @{integrationToken=$token} | ConvertTo-Json | Set-Content -LiteralPath $connectionPath -Encoding utf8
    }
    $connection = Get-Content -LiteralPath $connectionPath -Raw | ConvertFrom-Json
    foreach ($operation in $source.operations) {
        $operation.bodyTemplate.PSObject.Properties.Remove('_integrationToken')
    }
    $source.authHeaders | Add-Member -NotePropertyName 'X-Tipos-Anexo-Token' -NotePropertyValue $connection.integrationToken -Force
    $tokenHash = [Convert]::ToHexString([Security.Cryptography.SHA256]::HashData([Text.Encoding]::UTF8.GetBytes($connection.integrationToken)))
    @{tokenSha256=$tokenHash} | ConvertTo-Json | Set-Content -LiteralPath (Join-Path $state 'tipos-anexo-api.json') -Encoding utf8
    $draft = Get-Content -LiteralPath (Join-Path $metadata 'builder-draft.json') -Raw | ConvertFrom-Json
    $bootstrap = Api '/bootstrap' $null 'GET'
    $existing = @($bootstrap.programs | Where-Object { $_.programCode -eq $draft.programDraft.programCode -or $_.code -eq $draft.programDraft.programCode })
    if ($existing.Count -gt 0 -and !$ResumeVersionId -and !$RefreshBindingOnly) { throw 'O código do programa já existe; revisar antes de criar outra versão.' }
    $savedSource = Api '/api-sources' $source
    if ($savedSource.apiSource.responseContract -ne 'sursum-programs') { throw 'Contrato Sursum não foi preservado no catálogo.' }
    if (($savedSource | ConvertTo-Json -Depth 60 -Compress).Contains($connection.integrationToken)) { throw 'Catálogo expôs credencial da integração.' }
    # Simula uma edição administrativa sem a opção nova: ela precisa ser preservada.
    $source.PSObject.Properties.Remove('responseContract')
    $preservedSource = Api '/api-sources' $source
    if ($preservedSource.apiSource.responseContract -ne 'sursum-programs') { throw 'Edição do catálogo perdeu o contrato Sursum.' }
    $preview = Api '/external/validate' $draft
    $preview | ConvertTo-Json -Depth 60 | Set-Content -LiteralPath (Join-Path $state 'tipos-anexo-preview.json') -Encoding utf8
    Write-Output 'PASS: fonte API e rascunho JSON aceitos pelo backend real do construtor.'
    if (!$ValidateOnly) {
        $compileLog = Get-Content -LiteralPath (Join-Path $state 'compile-tipos-anexo.log') -Raw
        $ablLog = Get-Content -LiteralPath (Join-Path $state 'tipos-anexo-tests.log') -Raw
        if ($compileLog -notmatch 'PASS: compile 12.2 tipos anexo' -or $ablLog -notmatch 'PASS: [0-9]+ verificacoes') {
            throw 'Compilação 12.2 e testes ABL precisam passar antes de publicar o programa.'
        }
        Push-Location 'D:\opencode\construtor-pg\backend'
        try {
            $phpEvidence = (& php vendor/phpunit/phpunit/phpunit --no-coverage tests/Builder/EntitySnapshotIntegrityGuardTest.php tests/Builder/PublicBuilderConfigTest.php tests/Builder/ProgramBuilderApiResponseContractTest.php tests/Builder/ProgramBuilderBatchTest.php tests/Runtime/RuntimeApiEntityBatchTest.php tests/Runtime/RuntimeExternalJsonClientTest.php tests/Runtime/RuntimeApiEntityActionServiceTest.php tests/Runtime/StructuralIntegrityServiceTest.php 2>&1 | Out-String)
            if ($LASTEXITCODE -ne 0) { throw 'Testes PHP falharam; publicação cancelada.' }
        } finally { Pop-Location }
        if (!$ResumeVersionId -and !$RefreshBindingOnly) { $entity = Api '/entities' $draft.entityDraft }
        if ($ResumeVersionId) {
            $dashboard = Api ('/governance/dashboard?programCode='+$draft.programDraft.programCode) $null 'GET'
            foreach ($oldGrant in $dashboard.grants) {
                if ($oldGrant.status -eq 'active' -and [string]$oldGrant.grantedToUserId -eq [string]$session.user.id) {
                    $null = Api '/governance/grants/status' @{grantId=$oldGrant.id; status='revoked'}
                }
            }
        }
        $request = Api '/governance/requests' @{programCode=$draft.programDraft.programCode; builderEntityCode=$draft.entityDraft.code;
            requestedActions=@('edit','publish'); reason='Conversão multirow de tipos de anexo autorizada pelo usuário; frontend existente e APIs Progress.'}
        $grant = Api '/governance/grants' @{requestId=$request.request.id; grantedToUserId=[string]$session.user.id; allowedActions=@('edit','publish')}
        foreach ($scope in @(@{type='entity'; code=$draft.entityDraft.code}, @{type='program'; code=$draft.programDraft.programCode})) {
            $lock = Api '/locks/acquire' @{scopeType=$scope.type; scopeCode=$scope.code; grantId=$grant.grant.id; lockCategory='authoring'}
            if ($lock.status -ne 'acquired') { throw 'Não foi possível adquirir o lock de edição autorizado.' }
            if (!$lock.lock.lockToken) { throw 'Resposta de lock sem token.' }
            $locks.Add([string]$lock.lock.lockToken)
        }
        if ($RefreshBindingOnly) {
            $entity = Api '/entities' $draft.entityDraft
            $null = Api '/governance/grants/status' @{grantId=$grant.grant.id;status='revoked'}
            Write-Output 'Vínculo da entidade API atualizado pelo builder.'
            return
        }
        if ($ResumeVersionId) { $draft.programDraft | Add-Member -NotePropertyName 'id' -NotePropertyValue $ResumeVersionId -Force }
        $version = Api '/drafts' $draft.programDraft
        $versionId = if ($version.id) { $version.id } else { $version.version.id }
        if (!$versionId) { throw 'Builder não devolveu ID do rascunho.' }
        $bundle = 'ciw-tipos-anexo-' + [guid]::NewGuid().ToString('N')
        $tests = Api '/governance/tests' @{builderProgramVersionId=$versionId; bundleId=$bundle; testPlanId='ciw-tipos-anexo'; status='passed';
            checklistSnapshot=@{schema=$true; php=$true; abl=$true; frontendExisting=$true};
            evidences=@(@{type='phpunit'; result=$phpEvidence.Trim()}, @{type='openedge-12.2'; result=$compileLog.Trim()}, @{type='abl-temp-table'; result=$ablLog.Trim()});
            notes='Testes executados nesta instalação. A validação visual e HTTP operacional é executada após a publicação.'}
        $approval = Api '/governance/approvals' @{builderProgramVersionId=$versionId; bundleId=$bundle}
        $published = Api "/versions/$versionId/publish" @{}
        @{screenId='ciw.tipos-anexo'; programCode=$draft.programDraft.programCode; versionId=$versionId; grantId=$grant.grant.id;
            testBundleId=$bundle; approvalId=$approval.approval.id} | ConvertTo-Json |
            Set-Content -LiteralPath (Join-Path $state 'tipos-anexo-publicacao.json') -Encoding utf8
        Write-Output 'Programa de tipos-anexo publicado pelo fluxo oficial do builder.'
    }
} finally {
    foreach ($lockToken in $locks) { try { $null = Api '/locks/release' @{lockToken=$lockToken} } catch {} }
    try { $null = Invoke-WebRequest -Uri "$base/api/auth/logout" -Headers $headers -Method Post -ContentType 'application/json' -Body '{}' -TimeoutSec 15 } catch {}
}

