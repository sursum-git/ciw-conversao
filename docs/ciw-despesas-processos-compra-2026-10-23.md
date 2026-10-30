# Despesas dos processos de compra MED

Estado em 23/10/2026: **publicado, validado e cenário de teste encerrado e limpo**.

No cadastro `ciw.processos-compra-med`, versão 1.0.4, o detalhe do processo tem duas novas abas: **Despesas** e **Gerar despesas**. As cinco abas anteriores foram preservadas. A primeira abre o CRUD `ciw.proc-compra-despesas`/op1021; a segunda abre o processo nativo `ciw.proc-compra-gerar-despesas`/op1022. As duas telas estão na versão 1.0.0. Não foi criado outro frontend nem alterada a biblioteca Kendo.

## Fontes Scriptcase recuperados

Servidor `192.168.0.170:22`, usuário `root`, raiz `/var/www/clients/client1/web2/web/ciw`:

- `grid_despesas_proc_compra`;
- `form_despesas_proc_compra`;
- `bl_criar_despesas_proc_compra`.

O usuário regenerou o formulário após a constatação de `index.php` e `form_despesas_proc_compra_apl.php` vazios. A nova coleta recuperou ambos completos. A cópia sanitizada está em `sources/scriptcase/purchase-expenses`; o manifesto está em `integration-src/purchase-expenses/source-manifest.json`. São 11 arquivos e 43 literais sensíveis omitidos. A análise não executou o PHP legado. A cópia anterior permanece somente como evidência privada.

O formulário permite escolher todas as definições de `pub.despesas`, sem exigir vínculo ativo da empresa. Seus eventos `onAfterInsert`, `onAfterUpdate` e `onAfterDelete` apenas chamam `preencherIDLog`. `onScriptinit` e `onRefresh` chamam `localHabilitarCampos`: essa função compara com `1` um retorno que é um array. Essa tentativa defeituosa de desabilitação não foi transformada em uma nova proibição de negócio. O formulário não executa recálculo fiscal ou financeiro automaticamente.

## Rotinas e contratos

Os fontes canônicos ABL ficam em `D:/opencode/motor-progress/v2/sursum-api`:

| Componente | Responsabilidade |
|---|---|
| `programs/PurchaseExpensesApi.p` | Buffers fixos de `espec` e sequência existente `seq_despesas_proc_compra`; nenhum nome de tabela ou sequência vem do navegador. |
| `programs/PurchaseExpensesService.p` | Writer único de manutenção e geração; transação raiz, bloqueios sem espera, rollback e concorrência por stamp. |
| `includes/PurchaseExpenseSnapshot.i` | Imagem física completa de cinco campos e DTO de sete campos. |
| `includes/PurchaseJsonContract.i` | Identidade estrita e hash compartilhados; as funções antigas de amostras mantêm wrappers compatíveis. |
| `includes/PurchaseOrderContext.i` | Processo/dono MED e bloqueios compartilhados. |
| `includes/PurchaseItemValueRules.i` | Precisão decimal validada antes de qualquer arredondamento. |
| `programs/CiwErpReadService.p` e `CiwCadastrosCrud.p` | Leitor e despacho existentes, ampliados para o recurso fechado de despesas. |

A tabela física `espec.despesas_proc_compra` tem `despesa_proc_compra_id`, `proc_compra_id`, `despesa_id`, `vl_prev` e `calc_imp_proc_compra_id`. Embora a FK do processo seja fisicamente DECIMAL com duas casas, a API exige identidade inteira positiva e nunca trunca uma fração para associá-la a outro processo. O DTO acrescenta `row_stamp` e `despesa_descricao`. O navegador edita somente `despesa_id` e `vl_prev`; o cálculo vinculado é preservado e auditado. Inteiros são apresentados sem casas e o valor previsto usa duas casas decimais.

Conforme decisão explícita do usuário, a geração inclui **somente despesas ausentes**, preservando integralmente os valores existentes. Seleciona os vínculos ativos da empresa do processo, cuja definição tenha `log_imposto=0`, e copia `vl_padrao`. Planeja e valida o lote antes de inserir; configurações ativas duplicadas são recusadas. Repetir a geração não duplica registros nem consome IDs quando nada está ausente. Não há cópia de fórmulas fiscais, financeiras ou de custos.

## Cadastro das APIs e navegação

A fonte nativa `motor_progress_ciw_cadastros` passou de 85 para 92 operações; as 85 anteriores foram preservadas. O catálogo operacional fica no backend do construtor. Os JSONs reproduzíveis estão em `D:/opencode/construtor-pg/integrations/ciw-purchase-expenses`.

Todas as operações usam POST `/SursumPrograms/ciw-cadastros`, recurso `proc_compra_despesas` e contexto obrigatório `proc_compra_id`:

| Operação cadastrada | Operação enviada ao Progress |
|---|---|
| `proc_compra_despesas_read` | `read` |
| `proc_compra_despesas_get` | `get` |
| `proc_compra_despesas_create` | `create` |
| `proc_compra_despesas_update` | `update` |
| `proc_compra_despesas_delete` | `delete` |
| `proc_compra_despesas_opcoes_despesa` | `options`, lookup `despesa` |
| `proc_compra_despesas_generate` | `generate` |

O comando usa o ProcessEngine existente, operação custom POST cadastrada, duas habilitações explícitas, contexto fixo, permissão própria e confirmação Kendo. **Abrir a aba não executa a geração.** No frontend, `dataSource.api.process.endpointId` é **`run`**, embora o nome da ação seja `process`; o backend envia `operation: generate` ao Progress.

O endereço oficial é a instância `sursum-api`, contexto `med`, HTTPS 9911. A fonte local e os testes HTTP usaram `http://127.0.0.1:19910/med/web`, túnel SSH para a porta 9910 da mesma instância. Nenhuma instância alternativa foi utilizada.

## Logs

`RuntimePurchaseExpenseAudit`, os perfis compartilhados `RuntimePurchaseContextAudit/Payload`, o transporte existente e os filtros SQL do construtor importam apenas envelopes de transações confirmadas, com usuário autenticado e dono tipado. O CRUD registra as cinco colunas físicas anteriores/atuais. A geração registra o processo e um evento de criação para cada nova despesa, na mesma transação do comando. Esses eventos aparecem também no histórico do processo, sem entrar no histórico de itens.

**Logs**, no detalhe de uma despesa existente, mostra seu histórico. **Logs Exclusão**, na consulta, mostra somente exclusões do CRUD. O detalhe do log mostra o usuário, a imagem anterior e `Atual = Ausente`, sem outro botão Logs recursivo. Valores anteriores de registros históricos não são reconstruídos retroativamente.

## Validação e encerramento

- Compilação oficial OpenEdge 12.2 no `.42`: 19 entradas e 177 verificações em cada uma das quatro combinações de cultura/codepage, sem banco nos testes TT.
- PHP canônico: 813 testes, 5.371 asserções; revisão independente sem P1/P2.
- Integração de 27 arquivos canônicos por hashes/backups; publicação de 13 artefatos no ERP `.137` via `.111`; refresh somente das sessões MED 64/65 confirmadas ociosas.
- Metadados e interface nativos, leitura/opções no PASOE e regressões de amostras/anexos conferidos. A interface confirmou o contexto readonly e a confirmação de geração, cancelada sem execução adicional.

O usuário autorizou seis permissões para `tadeu.parreiras`: read/create/edit/delete de `proc_compra_despesas_progress`, mais `op1022.read` e `op1022.process`. Foram aplicadas com integridade nativa e atualização de quatro sessões LDAP, preservando os demais acessos.

O cenário autorizado `SC_TEST_PROC_DESPESAS_20261023` concluiu 11 etapas: processo novo **1685**, previsão financeira desativada, despesas **567–608**, sem itens, títulos, containers, notas ou estoque associados. A despesa manual foi alterada de **12,34 para 99,99**; uma versão antiga foi recusada com 409. A geração criou somente as outras 41 despesas; a repetição não criou nenhuma e preservou o valor manual.

Foram preservados **89 eventos**, com **ator técnico `admin`**: 85 de despesas, dois comandos de geração e dois do processo. Não atribuir esse teste a `tadeu.parreiras`. Os cinco valores anteriores das 42 exclusões foram comparados com o manifesto congelado.

**Limpeza concluída:** as APIs removeram somente o processo novo e suas 42 despesas. Probe físico independente, oficial 12.2 e somente leitura, confirmou ausência do pai e dos IDs de despesas, mesmo sem depender da FK, além de zero itens do processo. A linha de base de despesas estava vazia e continuou vazia. A sequência existente passou de 566 para 608, sem DDL, reset ou reseed.

Incidente do executor de teste: uma chamada a `/endpoints/process` recebeu 404 `RUNTIME_ENDPOINT_NOT_FOUND` antes do despacho. A definição publicada e a despesa manual inalterada foram conferidas; o recibo foi preservado e a primeira execução real usou o endpoint nativo `run`. Os testes do executor cobrem esse contrato, inclusive o atributo informativo `originalMethod` acrescentado pelo runtime.

Evidências privadas em `.runtime/purchase-expenses-20261023`: `final-verification.json`, `ACTIVE_WORK.json`, `authorizations-used.json`, `access/applied.json`, `exercise/confirmed-*.json`, `physical-{before,after}/physical-probe.json`, manifestos de integração/publicação e capturas `ui-{update,deletion}-log.png`/`ui-generation-confirmation.png`.

Estado **COMPLETED_CLEANED**. Autorizações e gates encerrados. Não repetir publicação, concessões, cenário ou contador. Os logs de teste devem ser preservados. Nenhuma senha ou token faz parte desta documentação.
