param([string]$Workspace = 'D:/opencode/conversao-sc')
$ErrorActionPreference = 'Stop'
$inventoryPath = Join-Path $Workspace 'integration-src/ciw-inventory/inventory-reviewed.json'
$catalogPath = Join-Path $Workspace '.runtime/ciw-completion-20261028/catalog-before.json'
$inventory = Get-Content -LiteralPath $inventoryPath -Raw | ConvertFrom-Json
$catalog = Get-Content -LiteralPath $catalogPath -Raw | ConvertFrom-Json
$output = Join-Path $Workspace '.runtime/ciw-completion-20261028'
New-Item -ItemType Directory -Path $output -Force | Out-Null
$sourceDirs = Get-ChildItem -LiteralPath (Join-Path $Workspace 'sources/scriptcase') -Directory -Recurse
$sources = @{}
foreach ($dir in $sourceDirs) { if (-not $sources.ContainsKey($dir.Name)) { $sources[$dir.Name] = @() }; $sources[$dir.Name] += $dir.FullName }
$assigned = @{
 'cons_im_param' = 'root-cadastros-parity'
 'cons_tipos_versao_custo' = 'root-cadastros-parity'
 'grid_motivos_desconto' = 'root-cadastros-parity'
 'grid_pub_coloracoes' = 'root-cadastros-parity'
 'grid_situacoes_container' = 'root-cadastros-parity'
 'cons_calcs_imp_container' = 'container-fiscal-readonly'
 'cons_despesas_container_memoria_calculo' = 'container-fiscal-readonly'
 'cons_versoes_item_custo_container' = 'container-version-history'
 'bl_ponte_versoes_item_custo_container' = 'container-version-history'
 'form_versoes_item_custo_container' = 'container-version-history'
 'cons_item_container_custo_pgtos' = 'container-version-history-aux'
 'cons_item_container_custo_nfs' = 'container-version-history-aux'
 'cons_item_container_custo_descontos' = 'container-version-history-aux'
 'cons_item_container_custo_despesas' = 'container-version-history-aux'
 'form_despesas_container_multi_reg' = 'container-expense-batch'
 'bl_calcular_impostos_container' = 'container-tax-only-reviewed-candidate'
 'bl_criar_despesas_container' = 'reserved-next-op1044'
 'cons_selec_despesas' = 'container-expense-default-selection'
 'cons_descontos_geral' = 'import-discounts-readonly'
 'cons_det_desconto_geral' = 'import-discounts-readonly'
 'grid_cta_corren_desconto' = 'import-discounts-readonly'
 'cons_cta_corren_custo_distr' = 'cost-distribution-readonly-op1048'
 'cons_itens_aptos_distr_custo' = 'cost-distribution-readonly-op1049'
 'cons_cta_corren_distr_item_container' = 'cost-distribution-readonly-op1050'
 'form_item_custos_manual' = 'manual-item-cost-readonly-op1051-writer-gated'
 'cons_item_container_amostra' = 'sample-container-items-readonly-op1052'
 'cons_docum_est_importacao' = 'container-nf-available-readonly-op1053-partial-writer-held'
 'bl_selecao_nf' = 'container-nf-available-readonly-op1053'
 'bl_sincr_cotacao' = 'daily-currency-login-sync-op1054-candidate-no-hook-activation'
 'cons_item_container_custos_comparacao_real' = 'container-cost-comparison-readonly-op1040-candidate'
 'cons_item_container_custos_comparacao_dolar' = 'container-cost-comparison-readonly-op1041-candidate'
 'grid_despesas_impostos' = 'expense-tax-relations-readonly-op1055-candidate'
 'cons_desc_geral_fornec' = 'supplier-discounts-readonly-op1056-candidate'
}
$final = @('grid_controles_proc_compra','form_controles_proc_compra','grid_itens_controle','form_itens_controle')
$rows = foreach ($entry in $inventory.entries) {
 $program = @($catalog.programs | Where-Object { $_.screenId -and $_.screenId -eq $entry.target_screen })
 $localPaths = @()
 if ($sources.ContainsKey($entry.name)) { $localPaths = @($sources[$entry.name]) }
 $classification = if ($entry.state_group -eq 'Convertido') { 'recorded-complete-preserve' } elseif ($final -contains $entry.name) { 'final-user-deferred' } elseif ($assigned.ContainsKey($entry.name)) { 'assigned-current-wave' } elseif ($entry.state_group -eq 'Triagem') { 'source-usage-triage-required' } elseif ($entry.state_group -eq 'Preparado') { 'candidate-not-published-verify-gap' } elseif ($entry.state_group -in @('Parcial','Relacionada')) { 'published-related-functional-gap-review' } else { 'active-backlog-verify-source' }
 [pscustomobject][ordered]@{ application=$entry.name; family=$entry.family; phase=$entry.phase; recordedState=$entry.state_group; classification=$classification; owner=if ($assigned.ContainsKey($entry.name)) {$assigned[$entry.name]} else {$null}; targetScreen=$entry.target_screen; targetVersionRecorded=$entry.target_version; catalogMatches=@($program | Select-Object code,screenId,publishedVersion,status); sanitizedSourcePaths=$localPaths; remainingRecorded=$entry.remaining; evidenceRecorded=$entry.evidence; completionAssertedByThisLedger=$false }
}
$reserved = 1033..1056 | ForEach-Object { 'op' + $_ }
$collisions = @($catalog.programs | Where-Object { $reserved -contains $_.code })
$freshCatalogPath = Join-Path $Workspace '.runtime/ciw-completion-20261028/expense-tax-current/catalog-current.json'
$candidateCodes = @('op1040','op1041','op1042','op1044','op1048','op1053','op1054','op1055','op1056')
$freshCatalogProof = $null
if (Test-Path -LiteralPath $freshCatalogPath) {
 $freshCatalog = Get-Content -LiteralPath $freshCatalogPath -Raw | ConvertFrom-Json
 $freshCatalogProof = [ordered]@{path=$freshCatalogPath;sha256=(Get-FileHash -LiteralPath $freshCatalogPath -Algorithm SHA256).Hash.ToLowerInvariant();programCount=@($freshCatalog.programs).Count;candidateCodes=$candidateCodes;candidateCodeCollisions=@($freshCatalog.programs | Where-Object {$candidateCodes -contains $_.code} | Select-Object code,screenId);scope='Current exported snapshot only; existing published wave codes are expected and are not collisions. Recheck live before publication.'}
}
$ledger = [ordered]@{
 generatedAt=(Get-Date).ToUniversalTime().ToString('o'); objective='Concluir todas as conversoes CIW em escopo; nenhum lote conclui o objetivo global'; inventoryBaselineSha256=(Get-FileHash -LiteralPath $inventoryPath -Algorithm SHA256).Hash.ToLowerInvariant(); catalogBaselineSha256=(Get-FileHash -LiteralPath $catalogPath -Algorithm SHA256).Hash.ToLowerInvariant(); applicationCount=@($rows).Count; rawStateCounts=$inventory.counts.state_group; deliveryCodeGroups=@{ 'container-fiscal-readonly'=@('op1033','op1034'); 'container-version-history'=@('op1035'); 'container-version-history-aux'=@('op1036','op1037','op1038','op1039'); 'container-expense-batch'=@('op1042'); 'reserved-next-tax-defaults'=@('op1043','op1044') }; codeCollisions=$collisions; guardrails=@('Nao alterar inventario global sem revisao root por hash','Nao tratar metadata semelhante como equivalencia de origem','Controles final por determinacao humana','Conta corrente fornecedor: exclusao pontual de menu; alvo ainda nao provado; nao excluir familia inteira','Historicos/alternativas exigem evidencia de uso e diferencas','Permissoes gerais ao final; nunca reaplicar gates consumidos','Canonicopatches por hash; root integra/compila12.2/publica MED'); entries=@($rows)
}
$ledger.catalogBaselineScope='Historical before snapshot; codeCollisions is only relative to that baseline, not a live catalog claim.'
$activePath = Join-Path $output 'ACTIVE_MANAGER.json'
if (Test-Path -LiteralPath $activePath) { $active = Get-Content -LiteralPath $activePath -Raw | ConvertFrom-Json; $ledger.currentWave = $active.currentWave; $ledger.activeExecutors = $active.activeExecutors; $ledger.currentEvidenceAt = $active.at }
$ledger.currentCatalogCandidateCodeProof=$freshCatalogProof
$ledger.ownerLabelScope='Owner labels include earlier deliveries for receipt tracking; only ACTIVE_MANAGER.activeExecutors names the two current executors.'
$ledger | ConvertTo-Json -Depth 14 | Set-Content -LiteralPath (Join-Path $output 'ledger.json') -Encoding utf8
$rows | Group-Object family | ForEach-Object { [ordered]@{ family=$_.Name; total=$_.Count; classifications=@($_.Group | Group-Object classification | ForEach-Object { [ordered]@{classification=$_.Name;count=$_.Count} }); sourceAvailable=@($_.Group | Where-Object { $_.sanitizedSourcePaths.Count -gt 0 }).Count; activeAssignments=@($_.Group | Where-Object {$_.owner} | ForEach-Object {$_.application}) } } | ConvertTo-Json -Depth 8 | Set-Content -LiteralPath (Join-Path $output 'family-summary.json') -Encoding utf8
[ordered]@{applicationCount=@($rows).Count;codeCollisionCount=$collisions.Count;families=@($rows | Group-Object family).Count;classifications=@($rows | Group-Object classification | ForEach-Object {@{classification=$_.Name;count=$_.Count}})} | ConvertTo-Json -Depth 5
