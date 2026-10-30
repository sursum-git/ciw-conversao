$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest
$workspace = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '../../..'))
$artifactRoot = [IO.Path]::GetFullPath($PSScriptRoot)
if ($artifactRoot -ne (Join-Path $workspace 'integration-src/purchase-pending-20261028/sample-batch')) { throw 'Unexpected artifact directory.' }

function Hash-File([string]$Path) {
    return (Get-FileHash -LiteralPath $Path -Algorithm SHA256).Hash.ToLowerInvariant()
}
function Workspace-Path([string]$Path) { return Join-Path $workspace $Path }
function Read-Json([string]$Path) { return Get-Content -LiteralPath $Path -Raw | ConvertFrom-Json }
function Write-Artifact([string]$Name, $Value) {
    $target = [IO.Path]::GetFullPath((Join-Path $artifactRoot $Name))
    if (-not $target.StartsWith($artifactRoot + [IO.Path]::DirectorySeparatorChar)) { throw 'Output outside artifact root.' }
    [IO.File]::WriteAllText($target, ($Value | ConvertTo-Json -Depth 30) + [Environment]::NewLine, [Text.UTF8Encoding]::new($false))
}
function Excerpt([string]$Path, [int]$Start, [int]$End) {
    $full = Workspace-Path $Path
    $lines = [IO.File]::ReadAllLines($full)
    $excerptLines = @()
    for ($line = $Start; $line -le $End; $line++) { $excerptLines += [ordered]@{ line = $line; text = $lines[$line - 1] } }
    return [ordered]@{ path = $Path; sha256 = Hash-File $full; start = $Start; end = $End; lines = $excerptLines }
}

$controllerPath = 'sources/scriptcase/purchase-pending/ctrl_envios_repres_amostra/ctrl_envios_repres_amostra_apl.php'
$representativesPath = 'sources/scriptcase/purchase-pending/cons_representante_ativos/index.php'
$ordersPath = 'sources/scriptcase/purchase-pending/cons_procs_compra/index.php'
$controller = Get-Content -LiteralPath (Workspace-Path $controllerPath) -Raw
$representatives = Get-Content -LiteralPath (Workspace-Path $representativesPath) -Raw
$orders = Get-Content -LiteralPath (Workspace-Path $ordersPath) -Raw
$selectorStart = $representatives.IndexOf('function selecionar_repres()')
$selectorEnd = $representatives.IndexOf('function nm_conv_data_db(', $selectorStart)
if ($selectorStart -lt 0 -or $selectorEnd -le $selectorStart) { throw 'Selection function boundaries changed.' }
$selector = $representatives.Substring($selectorStart, $selectorEnd - $selectorStart)
$emptyEvents = [regex]::Matches($selector, "\['contr_erro'\] = 'on';\s*\`$_SESSION\['scriptcase'\]\['cons_representante_ativos'\]\['contr_erro'\] = 'off';")
if ($emptyEvents.Count -ne 2) { throw 'The per-row/final events no longer match the two empty blocks; review before reconciling.' }
if ($selector -match '(?i)\b(insert\s+into|update\s+pub\.|delete\s+from|envios_amostras_repres|cons_procs_compra)\b') { throw 'Unexpected business operation in selection function.' }
if (-not $controller.Contains("SC_dir_app_name('cons_representante_ativos')")) { throw 'Controller destination changed.' }
if (-not $controller.Contains('$data_envio_corrente = $this->dt_envio')) { throw 'Controller date session assignment changed.' }

$sourceProofs = @()
foreach ($manifestName in @('purchase-pending-source-manifest.json', 'purchase-batch-samples-source-manifest.json', 'purchase-payment-bridges-20261028-source-manifest.json')) {
    $manifestPath = Workspace-Path ('integration-src/ciw-inventory/' + $manifestName)
    $manifest = Read-Json $manifestPath
    foreach ($source in $manifest.files) {
        if ($source.application -notin @('ctrl_envios_repres_amostra','cons_representante_ativos','cons_procs_compra','bl_selecao_pagto_proc_compra','bl_selecionado_pagto_proc_compra')) { continue }
        $copyDirectory = if ($manifestName -eq 'purchase-payment-bridges-20261028-source-manifest.json') { 'purchase-payment-bridges-20261028' } else { 'purchase-pending' }
        $relative = 'sources/scriptcase/' + $copyDirectory + '/' + $source.application + '/' + $source.file
        $actual = Hash-File (Workspace-Path $relative)
        if ($actual -ne $source.copied_sha256) { throw ('Source hash changed: ' + $relative) }
        $sourceProofs += [ordered]@{ path = $relative; sha256 = $actual; remoteSha256 = $source.remote_sha256; manifest = 'integration-src/ciw-inventory/' + $manifestName; sensitiveLiteralsOmitted = $source.sensitive_literals_omitted }
    }
}

$canonicalPaths = @(
    'D:/opencode/construtor-pg/integrations/ciw-referencias/representantes_ativos-builder-draft.json',
    'D:/opencode/construtor-pg/integrations/ciw-purchase-quantities/processos-compra-med-builder-draft.json',
    'D:/opencode/construtor-pg/integrations/ciw-purchase-orders/api-source-additions.json',
    'D:/opencode/motor-progress/v2/sursum-api/programs/PurchaseSamplesApi.p',
    'D:/opencode/motor-progress/v2/sursum-api/programs/PurchaseSamplesService.p',
    'D:/opencode/motor-progress/v2/sursum-api/programs/PurchaseOrdersService.p',
    'D:/opencode/motor-progress/v2/sursum-api/programs/PurchasePaymentsService.p',
    'D:/opencode/construtor-pg/integrations/ciw-purchase-payments/proc-compra-pagamentos-builder-draft.json'
)
$canonicalProofs = @($canonicalPaths | ForEach-Object { [ordered]@{ path = $_; sha256 = Hash-File $_; action = 'read-only reference; no patch' } })
$parent = Read-Json $canonicalPaths[1]
$representativeDraft = Read-Json $canonicalPaths[0]
$expectedOrderFields = @('proc_compra_id','empresa_id','dt_registro','fornecedor_id','cod_proc_fornec','dt_limite','cod_situacao')
$parentFields = @($parent.entityDraft.fields | ForEach-Object { $_.code })
$missingFields = @($expectedOrderFields | Where-Object { $_ -notin $parentFields })
if ($missingFields.Count -ne 0) { throw ('Existing parent missing fields: ' + ($missingFields -join ',')) }
if ($parent.programDraft.screenId -ne 'ciw.processos-compra-med' -or $parent.programDraft.version -ne '1.0.8') { throw 'Expected MED parent metadata reference changed.' }
if ($representativeDraft.programDraft.screenId -ne 'ciw.representantes-ativos') { throw 'Representative metadata reference changed.' }
$allocationProof = Read-Json (Workspace-Path 'integration-src/ciw-inventory/container-allocation-validation.json')
if ($allocationProof.state -ne 'COMPLETED_CLEANED') { throw 'Allocation completion evidence changed.' }

$blankNames = @('bl_selecao_pagto_proc_compra','bl_selecionado_pagto_proc_compra')
$blankSources = @(Get-ChildItem -LiteralPath (Workspace-Path 'sources/scriptcase/purchase-payment-bridges-20261028') -Recurse -File | Where-Object { $_.Directory.Name -in $blankNames })
if ($blankSources.Count -ne 4) { throw 'Expected four reviewed payment bridge sources.' }
$bridgeProofs = @()
foreach ($bridgeName in $blankNames) {
    $bridgeRelative = 'sources/scriptcase/purchase-payment-bridges-20261028/' + $bridgeName + '/index.php'
    $bridgeText = Get-Content -LiteralPath (Workspace-Path $bridgeRelative) -Raw
    $entryStart = $bridgeText.IndexOf('header("X-Frame-Options: SAMEORIGIN");', $bridgeText.IndexOf('function controle()'))
    $entryEnd = $bridgeText.IndexOf('//---', $entryStart)
    if ($entryStart -lt 0 -or $entryEnd -le $entryStart) { throw ('Bridge entry boundaries changed: ' + $bridgeName) }
    $entryText = $bridgeText.Substring($entryStart, $entryEnd - $entryStart)
    if (-not $entryText.Contains("SC_dir_app_name('cons_tit_ap')")) { throw 'Bridge destination changed.' }
    if ($entryText -match '(?i)\b(insert\s+into|update\s+pub\.|delete\s+from|associarTituloPedido\(|desassociarTituloPedido\()') { throw 'Unexpected direct write in navigation bridge entry.' }
    $expectedCondition = if ($bridgeName -eq 'bl_selecao_pagto_proc_compra') { ' num_id_tit_ap not in ($listaIdTitulos) ' } else { ' num_id_tit_ap in ($listaIdTitulos) ' }
    if (-not $entryText.Contains($expectedCondition)) { throw 'Bridge membership condition changed.' }
    $bridgeProofs += [ordered]@{ application = $bridgeName; path = $bridgeRelative; directBusinessWriteInvoked = $false; membership = $expectedCondition; destination = 'cons_tit_ap'; filterHelper = 'preencherCondPgtoProcCompra'; titleIdsHelper = 'buscarTitAssociadosProcCompra'; processFromLegacySession = 'proc_compra_id_corrente'; safeExistingReplacement = 'ciw.proc-compra-pagamentos/op1013/1.0.1'; scope = 'MED navigation absorbed; not unrestricted multi-company or row-for-row legacy SQL parity' }
}

$evidence = [ordered]@{
    date = '2026-10-28'
    kind = 'source-review-and-reconciliation-only'
    productBehaviorImplemented = $false
    sourceHashesVerified = $sourceProofs
    canonicalReadOnlyReferences = $canonicalProofs
    findings = @(
        [ordered]@{ id = 'controller-session-only'; source = $controllerPath; lines = @(1757,1764); input = 'dt_envio'; sessionKey = 'data_envio_corrente'; nextApplication = 'cons_representante_ativos'; writerFound = $false; requiredDate = $true; legacyMaximum = 'today' },
        [ordered]@{ id = 'empty-representative-selection'; source = $representativesPath; lines = @(4424,4522); emptyEventBlocks = $emptyEvents.Count; writesFound = $false; orderSelectionFound = $false; confidence = 'direct source inspection; manifests verify analysis copies' },
        [ordered]@{ id = 'different-representative-catalogs'; legacy = 'EMS5 PUB.representante/cdn_repres/dat_desligto IS NULL'; contextualWriter = 'ems2cad.repres/cod-rep/ind-situacao=1'; automaticCodeMappingProved = $false; existingReadOnlyScreen = 'ciw.representantes-ativos/cd0102/1.0.0' },
        [ordered]@{ id = 'general-orders-no-write-no-selection'; table = 'pub.procs_compra'; originalWhere = ''; fields = $expectedOrderFields; allSevenFieldsInExistingMedParent = $true; allCompaniesParityProved = $false; requiredBusinessContext = @(); cataloguedInboundApplication = 'cons_cta_corren_fornec_imp_entregue'; inboundScope = 'supplier current account; outside scope' },
        [ordered]@{ id = 'allocation-already-completed'; applications = @('control_selec_proc_compra','grid_itens_proc_compra_selecao'); existingScreen = 'ciw.container-alocar-itens/op1025/1.0.0'; evidence = 'integration-src/ciw-inventory/container-allocation-validation.json'; state = 'COMPLETED_CLEANED'; reapply = $false },
        [ordered]@{ id = 'order-form-variant'; application = 'form_proc_compra'; caller = 'cons_proc_compra_sinaliz'; callerOperation = 'update only with proc_compra_id'; sourceFieldsCoveredByExistingMedParent = $true; exactBehaviorEquivalence = $false; dangerousDeletePredicate = 'DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = proc_compra_id'; supplierHelperBuildsSqlWithoutExecution = $true; proposedDisposition = 'reconcile MED navigation to existing parent; do not copy cascade or assert full equivalence' },
        [ordered]@{ id = 'payment-bridges-reviewed'; applications = $blankNames; localSanitizedSourceFiles = 4; sourceAbsenceResolved = $true; existingMedFlow = 'ciw.proc-compra-pagamentos/op1013/1.0.1'; bridgeProofs = $bridgeProofs; legacyFilters = @('title IDs IN/NOT IN current process links','supplier from session','EMS5 company from session','emission date >= process registration date'); currentSafeContract = @('mandatory real MED parent context','server derives supplier/company/date','available excludes any already-owned title globally','linked reads preserve actual links; no destructive legacy SQL copied','existing writer handles locks/concurrency/root rollback/native user and before-after logs'); exactRowForRowOrMultiCompanyParity = $false; legacyZeroSentinel = 'empty list uses0; not a real process/title ID or identity provider'; arbitraryDebugIdsNotPorted = $true }
    )
    excerpts = @(
        (Excerpt $controllerPath 1757 1764),
        (Excerpt $controllerPath 2508 2508),
        (Excerpt $representativesPath 4472 4494),
        (Excerpt 'sources/scriptcase/purchase-pending/cons_representante_ativos/cons_representante_ativos_grid.class.php' 878 878),
        (Excerpt $representativesPath 1188 1188),
        (Excerpt $representativesPath 3673 3673),
        (Excerpt 'sources/scriptcase/purchase-pending/cons_procs_compra/cons_procs_compra_grid.class.php' 999 999),
        (Excerpt $ordersPath 3862 3864),
        (Excerpt 'sources/scriptcase/purchases/form_proc_compra/form_proc_compra_apl.php' 5965 5981),
        (Excerpt 'sources/scriptcase/purchases/form_proc_compra/form_proc_compra_apl.php' 4091 4095),
        (Excerpt 'sources/scriptcase/purchase-signals/cons_proc_compra_sinaliz/cons_proc_compra_sinaliz_grid.class.php' 4064 4067),
        (Excerpt 'sources/scriptcase/purchase-payment-bridges-20261028/bl_selecao_pagto_proc_compra/index.php' 5113 5143),
        (Excerpt 'sources/scriptcase/purchase-payment-bridges-20261028/bl_selecionado_pagto_proc_compra/index.php' 5113 5140),
        (Excerpt 'sources/scriptcase/purchase-payment-bridges-20261028/bl_selecao_pagto_proc_compra/index.php' 5456 5475),
        (Excerpt 'sources/scriptcase/purchase-payment-bridges-20261028/bl_selecao_pagto_proc_compra/index.php' 5530 5548)
    )
    validation = [ordered]@{ localSourceReview = $true; hashVerification = $true; metadataFieldComparison = $true; legacyPhpExecuted = $false; productTestsAdded = $false; official122Compile = 'not applicable; no executable changed'; pasoeCurrentValidation = $false; historicalEvidenceOnly = $true; businessWrites = 0; ddlWrites = 0; grants = 0; canonicalMutations = 0 }
}
Write-Artifact 'evidence.json' $evidence

$inventoryPath = 'integration-src/ciw-inventory/inventory-reviewed.json'
$inventory = Read-Json (Workspace-Path $inventoryPath)
$updates = @(
    [ordered]@{ name = 'ctrl_envios_repres_amostra'; proposedStateGroup = 'Pendente'; reviewStatus = 'SOURCE_REVIEWED_NO_BUSINESS_COMMAND'; targetScreen = 'ciw.representantes-ativos'; targetVersion = '1.0.0'; remaining = 'Origem somente captura data e abre representantes; eventos selecionados vazios. Não há comando de lote comprovado. Não afirmar que lote de envios foi convertido.' },
    [ordered]@{ name = 'cons_representante_ativos'; proposedStateGroup = 'Convertido'; reviewStatus = 'EXISTING_READONLY_REUSED'; targetScreen = 'ciw.representantes-ativos'; targetVersion = '1.0.0'; remaining = 'Consulta EMS5 existente preservada; botão legado sem implementação não equivale ao writer EMS2 contextual de amostras.' },
    [ordered]@{ name = 'cons_procs_compra'; proposedStateGroup = 'Pendente'; reviewStatus = 'MED_FIELDS_COVERED_GENERAL_SCOPE_UNPROVED'; targetScreen = 'ciw.processos-compra-med'; targetVersion = '1.0.8'; remaining = 'Sete campos cobertos para consulta MED pelo pai existente. Legado sem filtro de empresa e chamador de conta corrente fora do recorte; não declarar equivalência multiempresa ou criar tela duplicada.' },
    [ordered]@{ name = 'control_selec_proc_compra'; proposedStateGroup = 'Convertido'; reviewStatus = 'COMPLETED_CLEANED_PREVIOUSLY'; targetScreen = 'ciw.container-alocar-itens'; targetVersion = '1.0.0'; remaining = 'Nenhum trabalho obrigatório neste fluxo; publicação, teste e limpeza já concluídos em26/10.' },
    [ordered]@{ name = 'grid_itens_proc_compra_selecao'; proposedStateGroup = 'Convertido'; reviewStatus = 'COMPLETED_CLEANED_PREVIOUSLY'; targetScreen = 'ciw.container-alocar-itens'; targetVersion = '1.0.0'; remaining = 'Nenhum trabalho obrigatório neste fluxo; publicação, teste e limpeza já concluídos em26/10.' },
    [ordered]@{ name = 'bl_selecao_pagto_proc_compra'; proposedStateGroup = 'Convertido'; reviewStatus = 'MED_NAVIGATION_ABSORBED_EXISTING'; targetScreen = 'ciw.proc-compra-pagamentos'; targetVersion = '1.0.1'; remaining = 'Fonte revisada: ponte somente sessão/filtrosNOTIN/redirecionamento. ParaMED a seleção está absorvida pelo Incluir/MultiSelect existente, contexto físico obrigatório e opções globalmente livres. Nenhum código/publicação novo; não declarar igualdadeSQLlinhaalinha nem ampliar empresa.' },
    [ordered]@{ name = 'bl_selecionado_pagto_proc_compra'; proposedStateGroup = 'Convertido'; reviewStatus = 'MED_NAVIGATION_ABSORBED_EXISTING'; targetScreen = 'ciw.proc-compra-pagamentos'; targetVersion = '1.0.1'; remaining = 'Fonte revisada: ponte somente sessão/filtrosIN/redirecionamento. ParaMED a consulta/retorno está absorvida pela grade/readget/delete existente. Nenhum writer é invocado na entrada do blank; não copiar bibliotecas financeiras nem limitar histórico por sessão antiga.' },
    [ordered]@{ name = 'form_proc_compra'; proposedStateGroup = 'Pendente'; reviewStatus = 'VARIANT_MED_MAINTENANCE_RECONCILIATION'; targetScreen = 'ciw.processos-compra-med'; targetVersion = '1.0.8'; remaining = 'Variante de manutenção chamada por sinalização. Campos MED cobertos pelo cadastro existente, mas cascata de exclusão e eventos diferem. Reconciliar navegação do painel de sinalização, preservando writer atual, sem portar predicado legado incorreto.' }
)
$proposals = @()
foreach ($update in $updates) {
    $entry = @($inventory.entries | Where-Object { $_.name -eq $update.name })
    if ($entry.Count -ne 1) { throw ('Inventory application not unique: ' + $update.name) }
    $proposals += [ordered]@{ application = $update.name; expected = [ordered]@{ state = $entry[0].state; state_group = $entry[0].state_group; target_screen = $entry[0].target_screen }; proposal = $update; evidence = 'integration-src/purchase-pending-20261028/sample-batch/evidence.json' }
}
Write-Artifact 'reconciliation-proposal.json' ([ordered]@{ date = '2026-10-28'; applyAutomatically = $false; target = $inventoryPath; baselineSHA256 = Hash-File (Workspace-Path $inventoryPath); patches = $proposals; globalLedgerModified = $false; controlsFinalUntouched = $true; quantityPeriodsOp1030Untouched = $true })

$outputs = @('brief.md','review.md','navigation-proposal.json','collect-evidence.ps1','evidence.json','reconciliation-proposal.json')
foreach ($optional in @('review-signal-config.json','review-signal-config-final.json','review-signal-config-probes.php','review-signals-global.json','evidence.before-payment-bridges.json','reconciliation-proposal.before-payment-bridges.json','integration-manifest.before-payment-bridges.json')) {
    if (Test-Path -LiteralPath (Join-Path $artifactRoot $optional)) { $outputs += $optional }
}
$artifacts = @($outputs | ForEach-Object { [ordered]@{ path = 'integration-src/purchase-pending-20261028/sample-batch/' + $_; sha256 = Hash-File (Join-Path $artifactRoot $_) } })
Write-Artifact 'integration-manifest.json' ([ordered]@{ date = '2026-10-28'; state = 'ANALYSIS_COMPLETE_RECONCILIATION_PROPOSED'; packageDirectory = 'integration-src/purchase-pending-20261028/sample-batch'; artifacts = $artifacts; executableCandidates = @(); canonicalPatches = @(); builderPublicationCandidates = @(); inventoryProposal = [ordered]@{ path = 'reconciliation-proposal.json'; target = $inventoryPath; baselineSHA256 = Hash-File (Workspace-Path $inventoryPath); applyAutomatically = $false }; compilation = 'not applicable; no executable changed'; publication = 'none'; businessWrites = 0; schemaMutations = 0; grants = 0; scopeLimitation = 'No implemented batch command in observed source; payment bridge body absence resolved forMED navigation only; all-company and exact legacy SQL row parity remain explicitly outside equivalence.' })
Write-Output ('Source review PASS: ' + $sourceProofs.Count + ' source hashes, 2 empty selector events, 7 existing MED fields; no product mutation.')
