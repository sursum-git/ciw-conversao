# Testes e reexecução sem alterar freeze

Resultados finais em `.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2/final-local-v1`: FULL903/6005,278 classes App100%stage,410 arquivos atuais13 (Builder e helper apenas de overlay),31 testes Node/AJV/protótipos. O PHP inclui885 testes canônicos e18 desta frente. RED causal nativo/helper/Builder e RED do rename genérico estão preservados no diretório pai de recibos.

Não rodar prepare-candidate.py, prepare-final-stage.py ou seal.py sobre esta entrega congelada. verify.py é somente leitura. Para review independente, preparar saída NOVA e nunca sobrescrever os recibos finais:

```powershell
$py='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe'
$node='C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe'
$domain='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/container-supplier-discounts-integer-range-v2'
$review='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-supplier-discounts-integer-range-v2/independent-review-NEW'
& $py "$domain/verify.py"
& $py "$domain/replay-prepare.py" --out $review
$env:RANGE_RECEIPTS=$review
$env:NAV_RECEIPTS=$review
& C:/php-8.4.3/php.exe D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --configuration "$review/phpunit.xml" --do-not-cache-result --log-junit "$review/php-full.xml"
& $node --test "$domain/tests/*.test.cjs"
```

O script de replay só copia arquivos locais; não executa os testes automaticamente. O estágio fica byteigual ao final13 capturado, sem repuxar fontes canônicas mutáveis. Os testes escrevem apenas na nova saída de review. PHP deve preceder Node para produzir os quatro drafts reais de teste.

O stub de repositório/módulo/permissão serve somente ao teste do Builder. Entity normalization, validateExternalDraft, geração de definição, normalizadores, Validator, Engine, Grid/Form e ApiRequestContext são implementações reais. Não há mock de produção. HTTP/DOM dos testes são sintéticos; não há DB, sessão real, grant ou chamada Progress. Os22 testes filterOnly são cópias de harness com nova raiz de candidato/recibos, sem alterar o predecessor.

AJV2020 padrão valida schema completo; resolução das permissões é sintética. Relações entre propriedades (min<=max, referência/tipo/nãoPK do campo) são responsabilidade adicional do Builder/JS executável, não uma prova inexistente de JSONSchema dinâmico. Nenhuma validação visual de widget Kendo publicado é alegada.
