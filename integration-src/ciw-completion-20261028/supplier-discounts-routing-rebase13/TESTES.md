# Provas e reexecução isolada

20 testes focados/457asserções (read/get/Query/responseguards reais por Reflection; transporte fake apenas de teste). FULL1043/8524 sobre410 fontes ATUAIS13, quatro overlays e278App100%stage. Suíte inclui as120 regressões externas do harness13 mais885 canônicas,18 integerRange/filterOnly e20 desta frente. Cópias de testes13 só redirecionam paths locais; não escrevem em recibos antigos.

ABL diagnóstico12.8:7compiles/444checks/16logs/4combinações UTF-8 eISO8859-1 × american/european, NUMDBS0. Código dos4TTs é byteigual ao freezead6. Os32 novos+79regressões por combinação passaram contra Reader13 e Labels13 reais. Não são compilações oficiais12.2, teste com banco real ou rcode publicável.

Falha FULL de preparação preservada em full-stage-v1. full-stage-v2 contém exatamente as mesmas410 fontes de produto e apenas a fixture nativa NF faltante, em caminhos novos. Não reexecutar prepare-local.py/run-abl-local.py/compose.py sobre os recibos finais. Nenhum official14 ou plano SSH foi gerado.

Revisão independente somente leitura e replay PHP em NOVO diretório:

```powershell
$domain='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/supplier-discounts-routing-rebase13'
$py='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$review='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/supplier-discounts-routing-rebase13/manager-review-NEW'
& $py "$domain/verify.py"
& $py "$domain/replay-prepare.py" --out $review
$env:ROUTING_RECEIPTS=$review
$env:RANGE_RECEIPTS=$review
$env:NAV_RECEIPTS=$review
$env:CIW_OPTIONS_COMPANION_STATE=$review
& C:/php-8.4.3/php.exe D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --configuration "$review/phpunit.xml" --do-not-cache-result --log-junit "$review/php-full.xml"
```

O replay só prepara cópias e prova bytes dos produtos. Não executa teste, rede ou banco automaticamente. ApiRequestContext, Grid/Form/Process, permissões reais e520pins do predecessor não são modificados. Não chamar Progress/SSH/APIs para revisar este candidato.
