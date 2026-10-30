# Review local: paginação NF1053

Estado: candidato isolado; oficial12.2, integração, PASOE e metadata ainda pertencem ao root. Nenhuma publicação, API Progress, SQL, grant, DDL ou escrita de negócio executada aqui.

O conjunto completo deixa de ser transferido ao PHP para recorte local. `AvailableNfs` continua selecionando no mesmo banco/parent MED e excluindo pelo documento somente; `NfRow`, `NfKey` e seu alias byte exato continuam únicos. O JSON original é conservado no CLOB privado da TT e devolvido pelo leitor; não se acrescenta `record_key`. O mesmo parser ERP calcula filtro/ordem/página/total. Sem frontend novo, mudança Kendo ou mapper fiscal duplicado.

Os 50 mil contam leituras de ORIGEM ERP (links+docum-est), inclusive excluídas; a TT é derivada dessas linhas. Invariantes executáveis: `TTrows <= sourceReads <= 50000`, `totalMatched <= TTrows`; a varredura de resultados TT também recusa além50mil. Não se somam novamente as visitas à TT para reduzir artificialmente a capacidade. O prazo externo10s envolve coleta, projeção e TODO o RUN do leitor. A prova sintética usa outer1s/inner10s e pausa2s no reader: deve recusar por timeout sem page/total. Essa prova demonstra abrangência do bloco, sem prometer interrupção instantânea de uma chamada bloqueada da AVM.

Limites de resposta: take1..200, skip0..100000, envelope fechado com total após filtro. Fonte excedida ou timeout recusam503 sem dados parciais. Página além do total é vazia, com total preservado. GET conserva contexto e alias exato e encontra posições acima200. NO-LOCK não cria snapshot entre páginas; alterações concorrentes podem mudar total/posição. SQLcollation ainda não foi comprovada; o gate existente permanece. IMA e associação/desassociação seguem fora deste escopo.

Dois pontos foram encontrados por RED e limitados ao novo recurso: LONGCHAR do parser precisa UTF-8 mesmo na sessãoISO8859-1; literal CHARACTER precisa escapar tilde antes de QUOTER. O comparador RAW de aliases de campos já usado pelo1055 também se aplica ao novo recurso. `FilterExpr` e os demais parsers permanecem únicos, sem alteração global silenciosa.

Metadados: proposta sobre a fonte financeira4ops, append2/list+detail, totalPath=total somente no novo read. Preserva autenticação em memória e quatro predecessoras; nunca substituir o DTO sanitizado inteiro. A ordem default inclui documento/série/natureza e nf_key desempata no servidor. Exportação já é disabled no Builder real; permanece indisponível e take1000 recusa422. Navegação vem do cabeçalho op1000, inclusive sem filhos. Revalidar export atual/fonte/pai antes de publicar se houver mudança posterior.

Validação local esperada no manifesto congelado: TT nas quatro combinações UTF8/ISO8859-1 × AMERICAN/EUROPEAN, NUMDBS0, incluindo regressões1055(49), ERP(47), financeiras(231), aliases(18), origem(39) e timeout(2). Native/AJV23; replay dos cinco DTOs nativos pela fronteira PHP real; FULL STAGE990/7119 com277 App definitions 100%staged. O checker lê os recibos efetivos antes de afirmar GREEN.

Comandos de testes sobre preparação própria (nunca sobrescrever recibos frozen):

```powershell
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/python.exe' integration-src/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/tests/run-abl.py
& 'C:/Users/user/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/bin/node.exe' integration-src/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/tests/native-pages.cjs
& C:/php-8.4.3/php.exe D:/opencode/construtor-pg/backend/vendor/phpunit/phpunit/phpunit --configuration .runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/full-stage/phpunit.xml --do-not-cache-result --log-junit .runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/full-stage/php-full.xml
```

A suíte completa contém todas as fontesApp canônicas11, os demais companions anteriores e1055. A classe histórica11 testes de Runtime NF fullset/local é explicitamente excluída somente dessa composição: seu contrato foi substituído por13 testes do Runtime paginado, incluindo negativos e perfil NF antigo. Original, hash e motivo ficam no composition-proof; não se apaga o histórico. Os demais testes NF de origem e Builder continuam na suíte.

Root deve compilar em12.2 e validar os cinco containers com páginas/total, GET e aliases, mantendo metadata retida até provar volume real sem truncamento. Testes locais12.8 não substituem esse gate.
