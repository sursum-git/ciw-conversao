# Verificação e replay isolado

Resultados selados são evidência de execução local, não autorizam escrita/API nem devem ser sobrescritos. `frozen-v1/manifest.json` pina os inputs/candidatos e os recibos nos caminhos originais, que ficam imutáveis. Não executar prepare-* nem a configuração PHP full original após freeze.

Replay focado independente: criar uma pasta NOVA em `.runtime/ciw-completion-20261028/container-item-navigation-filter-only/manager-review-*`; definir `NAV_RECEIPTS` com seu caminho absoluto; executar os testes PHP abaixo com `--log-junit` dentro da pasta nova; depois os dois arquivos node `--test`. A variável muda somente o destino de generated/request traces. A comparação com o baseline205 lê os arquivos históricos; não usar NAV_TREE=baseline depois do freeze. Desfazer NAV_RECEIPTS ao terminar. Esses comandos não fazem HTTP/DB/negócio:

```powershell
$env:NAV_RECEIPTS='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-item-navigation-filter-only/manager-review-NOVO'
New-Item -ItemType Directory -Path $env:NAV_RECEIPTS -ErrorAction Stop | Out-Null
& C:/php-8.4.3/php.exe D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --no-configuration --do-not-cache-result --bootstrap integration-src/ciw-completion-20261028/container-item-navigation-filter-only/tests/bootstrap.php --log-junit "$env:NAV_RECEIPTS/focused.xml" integration-src/ciw-completion-20261028/container-item-navigation-filter-only/tests
& C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe --test integration-src/ciw-completion-20261028/container-item-navigation-filter-only/tests/native-filter-only.test.cjs integration-src/ciw-completion-20261028/container-item-navigation-filter-only/tests/native-boundaries.test.cjs
Remove-Item Env:NAV_RECEIPTS
```

FULL892/5916 foi executado com 409 fontes PHP no estágio separado, Builder candidato sobreposto e loader obrigatório:277 classes App carregadas do estágio, zero fora. Repetir FULL somente em estágio/receipts novos após mudança ou para composição root; nenhum teste desta frente acessa ERP/API real. O helper PHP canônico real em subprocesso é usado apenas para validar arrays sintéticos.

Os stubs HTTP/UI dos testes são exclusivamente harness local. O produto continua usando fonte registrada e runtime nativo. A exportação legada de ERP com take>=1000 permanece como limite explícito; a prova desta frente verifica preservação do filtro e ausência de contexto técnico, não sucesso remoto desse export.
