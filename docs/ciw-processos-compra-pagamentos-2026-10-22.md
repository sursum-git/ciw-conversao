# Pagamentos de processos de compra — MED

Estado em 22/10/2026: **publicado e validado no Builder e no PASOE real**. Consulta, seletor contextual, associação múltipla, estornos e logs nativos validados. Cenário autorizado integralmente removido; títulos originais inalterados.

## Acesso publicado

Home: **CIW → Consultas ERP → Processos de compra — Financeiro (MED)**. Na linha do processo, **Pagamentos** abre os vínculos daquele processo. **Incluir** seleciona até 100 títulos pelo MultiSelect nativo. **Excluir** desvincula um pagamento e estorna seu rateio; o título do ERP permanece intacto.

| Tela | Código / versão | Builder / aprovação |
|---|---|---|
| `ciw.processos-compra-financeiro-med` | `cd0107 / 1.0.0` | `56 / 55` |
| `ciw.proc-compra-pagamentos` | `op1013 / 1.0.1` | `58 / 57` |

O código proposto `op1008` já pertencia a custos de itens; foi escolhido `op1013` após conferir o catálogo. Esta lista financeira não é o cadastro completo de processos de compra. MED explícita; seleção empresarial/IMA e permissões gerais CIW ficam em etapas separadas.

## Reutilização e transação

`PurchasePaymentsApi.p` adapta recursos fechados no dispatcher autenticado `CiwCadastrosCrud.p`. `PurchasePaymentsService.p` resolve processo, fornecedor, empresa, data mínima, títulos elegíveis e locks. O navegador não escolhe banco, tabela, SQL, programa, fornecedor ou usuário.

O financeiro compartilhado `ContainersItensFinanceiroService.p` recebe `order-associate/order-disassociate`, reutilizando **AllocateOrder, AddPlan, BalanceValue e PersistPlans**. `ContainersItensRuntime.p` compõe callbacks e **ContainersPagamentoTotalsService.p** para moeda/totais. Não há fórmulas copiadas para PHP, metadados ou frontend. Include IMA Progress: leitura direta NO-LOCK, sem cache.

Associação direta ao processo preserva a independência da opção de previsão do legado. Títulos devem ser antecipados, não estornados, do fornecedor/empresa do processo e respeitar a data inicial quando existente. Ambiguidade e vínculos existentes são recusados. Lote atômico: qualquer falha desfaz todos os vínculos e lançamentos. Desvinculação estorna apenas o saldo tipo 4 do título escolhido.

Opções: candidatos limitados, uma passagem pelos vínculos EMS5, revalidação física. Limite de 1.000 opções e prazo de 10 segundos; excesso/timeout gera erro, nunca sucesso parcial. Locks e exclusão mútua do writer preservados.

## Contrato

Fonte existente **motor_progress_ciw_cadastros**, mesmo POST `/SursumPrograms/ciw-cadastros`, mesma `sursum-api/med`. Sete operações aditivas: `procs_compra_financeiro_med_read/get`, `proc_compra_pagamentos_read/get/create/delete`, `proc_compra_titulos_disponiveis`. Operações anteriores preservadas.

Endpoint nativo do construtor, exemplo ilustrativo:

```json
{"record":{"titulos":[456,789]},"context":{"proc_compra_id":123}}
```

Contrato resultante no Progress:

```json
{"resource":"proc_compra_pagamentos","operation":"create","proc_compra_id":123,"values":{"titulos":[456,789]}}
```

Não executar exemplos contra registros existentes. Campo JSON `titulos`: **apiWritePath=values.titulos**, **apiJsonPath=titulos**, `options.api.collection.itemType=integer`. Não enviar `values` como corpo do endpoint nativo do frontend. Versão 1.0.1 corrige esse mapeamento; tentativa rejeitada anterior preservada nos recibos.

Contexto `proc_compra_id` obrigatório, inteiro, readonly. Chave opaca `pagamento_key=p_SHA256`, 66 caracteres, pela include de identidade existente. Edição indisponível. Inteiros sem casas; valores monetários com duas casas. Frontend e Kendo preservados.

## Logs

Após commit, ABL retorna `source=progress-transaction`, ator e imagens de cada vínculo/lançamento tipo 4. **RuntimePurchasePaymentAudit.php** confere o contrato e o ator contra a sessão autenticada e importa para transação/log nativos.

Imagem do vínculo com 18 campos: processo, título, estabelecimento, fornecedor, moeda, datas, valores e demais campos. Inclusão: anterior vazio/atual completo. Desvinculação: anterior completo/atual vazio. Rateio e estorno também têm imagens/usuário.

Botão **Logs** do formulário usa `recordEvents`: localiza eventos de cada vínculo, inclusive o segundo da mesma inclusão múltipla. Formulário do processo agrega vínculos e rateios. Viewer aceita chave textual; backend mantém conversão numérica e hashes somente nas duas telas de pagamentos autorizadas, com escopo tenant/tela/processo/vínculo. Sem botão Logs recursivo no viewer.

## Publicação e validação

- **OpenEdge 12.2/.42:** 13 fontes compilados sem erro; **210 checks por combinação** AMERICAN/EUROPEAN × UTF-8/ISO8859-1, sem banco nos testes. Inclui regressões financeiras, writer, leitores e moeda/totais. 12.8 local apenas diagnóstico.
- **Seis pares p/r 12.2** publicados no .137 via .111, backup/hashes e dependências antes do dispatcher. Recarga somente de sessões MED ociosas da `sursum-api`, sem restart/fallback.
- **PHP canônico 641 testes / 3.987 assertivas PASS**, lint PASS. Revisão independente de transação/locks/auditoria/escopo sem defeito prioritário remanescente.
- PASOE/runtime: read/get/opções, contextos inválidos recusados, duas definições validadas nativamente, Home com somente o link pai novo. Edge isolado: grade, navegação contextual, MultiSelect real, contexto readonly.
- Cenário operacional autorizado somente processo novo `2147000104`, itens novos `2147000201/2147000202`, marcador `SC_TEST_PAGTO_PROC_20261022`; dois títulos existentes apenas lidos. Inclusão confirmou dois vínculos/quatro lançamentos. Logs dos dois vínculos e do processo pai mostraram usuário e imagens anterior/atual. Duas desvinculações produziram quatro lançamentos inversos; as oito imagens físicas coincidiram com os logs e os saldos zeraram por item/título. Limpeza commitada e conferência independente: zero processo/itens/vínculos/lançamentos próprios, títulos originais inalterados. Inclusão 29160; estornos 29228 e 29232. Logs nativos preservados.

Sem alteração de schema, autenticação, token, rotas, PROPATH global, permissões humanas ou Kendo. Sem commit/push/reseed. Sessões humanas preservadas.

## Fontes e continuidade

Scriptcase: `root@192.168.0.170:22`, `/var/www/clients/client1/web2/web/ciw/cons_tit_ap/`. Análise em `sources/scriptcase/phase2/cons_tit_ap/`; associação/desvinculação, `gerarRateioAntecipPedImp` e contexto no `index.php`. PHP legado não executado.

Snapshots finais em `integration-src/purchase-payments/`. Canônicos: `D:/opencode/motor-progress/v2/sursum-api/programs/`, testes `tests/abl/purchase-payments/`; PHP `D:/opencode/construtor-pg/backend/src/Runtime/` e testes correspondentes; JSON `D:/opencode/construtor-pg/integrations/ciw-purchase-payments/`.

Recibos privados **.runtime/purchase-payments-20261022/**: compilação oficial, manifests e deltas, publicações Builder/Home, provas runtime/UI, regressão `ui-record-events/string-context/`, cenário `fixture-v2/`. Não copiar dados comerciais, conexão ou credenciais para fontes/memória. Tentativas possuem guarda contra replay: não repetir ações para refazer recibos. Preservar tentativas rejeitadas.

Inventário `cons_tit_ap` permanece parcial: consulta independente e seletor de compra MED publicados; outros chamadores/origens exigem conferência antes de equivalência integral. Cadastro completo do processo e permissões CIW gerais estão fora deste recorte.
