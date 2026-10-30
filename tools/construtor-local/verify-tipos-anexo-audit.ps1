$ErrorActionPreference='Stop'
$state=[IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..\..\.runtime\construtor-pg'))
$base='http://127.0.0.1:8765'
$access=Get-Content (Join-Path $state 'acesso-local.txt') | Where-Object { $_.StartsWith('Senha inicial=') }
$login=Invoke-RestMethod "$base/api/auth/login" -Method Post -ContentType application/json -Body (@{username='admin';password=$access.Substring(14);tenantId='default';rememberMe=$false}|ConvertTo-Json)
$headers=@{Authorization=('Bearer '+$login.token);'X-Runtime-Auth-Token'=$login.token;'X-Runtime-Tenant-Id'=$login.tenantId;'X-Runtime-User-Id'=[string]$login.user.id;'X-Runtime-Session-Id'=$login.session.sessionId}
try {
 $body=@{take=100;filter=@{logic='and';filters=@(@{field='event_type';operator='startswith';value='tipos_anexo_progress.api.batch'})};sort=@(@{field='created_at';dir='desc'})}|ConvertTo-Json -Depth 10
 $logs=Invoke-RestMethod "$base/api/runtime/screens/admin.logs-transacoes/endpoints/read" -Method Post -Headers $headers -ContentType application/json -Body $body
 $success=@($logs.data | Where-Object event_type -eq 'tipos_anexo_progress.api.batch')
 $failed=@($logs.data | Where-Object event_type -eq 'tipos_anexo_progress.api.batch.failed')
 if (!$success.Count -or !$failed.Count) { throw 'Auditoria de lote precisa conter sucesso e falha reais.' }
 $evidence=@{at=[DateTime]::UtcNow.ToString('o');successEvents=$success.Count;failedEvents=$failed.Count;successTransactionId=$success[0].transaction_id;failureTransactionId=$failed[0].transaction_id}
 $evidence|ConvertTo-Json|Set-Content (Join-Path $state 'tipos-anexo-audit-evidence.json') -Encoding utf8
 Write-Output ('PASS: auditoria PHP consultavel; '+$success.Count+' eventos de sucesso e '+$failed.Count+' de falha batch.')
} finally { $null=Invoke-RestMethod "$base/api/auth/logout" -Method Post -Headers $headers -ContentType application/json -Body '{}' }
