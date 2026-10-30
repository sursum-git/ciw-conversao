# Itens dos processos de compra MED

O cadastro de processos de compra oferece a aba **Itens** na versão1.0.2. Ela abre a consulta e o formulário `ciw.proc-compra-itens` com o processo selecionado. O cadastro precisa estar salvo. O cabeçalho da consulta fica visível para acessar **Logs Exclusão**. A aba Pagamentos permanece disponível.

A tela usa o frontend existente do construtor e metadados JSON, com cinco abas: Principal, Especificações, Prazos e amostras, Avaliação e Observações. São46campos físicos, mais versão de concorrência, quantidade alocada, saldo e gramatura calculados. Inteiros usam zero casas decimais. As listas de colorações, formatos de amostra e estações são consultadas nas tabelas de referência pelo Progress.

## Backend compartilhado

`PurchaseItemsApi.p` adapta o contrato fixo e resolve o processo MED. `PurchaseItemsService.p` mantém o item na transação raiz. `PurchaseItemIdService.p` pede a identidade à sequência dedicada `seq_itens_proc_compra`, sem MAX+1. `ContainersItensRuntime.p` coordena os serviços existentes de impostos, despesas, custos e financeiro para os containers relacionados. `ContainersItensFinanceiroService.p` mantém obrigações e rateios por diferenças, preservando o histórico. As regras de valores/datas e o snapshot ficam nos includes compartilhados.

A redução de quantidade é recusada se ficar abaixo do total alocado. A exclusão é bloqueada quando há qualquer vínculo a container, mesmo com quantidade zero, ou dependências de anexos, amostras, liberações e pré-pedido. Um histórico financeiro de item já excluído só é desconsiderado se todos os grupos estiverem comprovadamente zerados; saldo órfão bloqueia a operação. Nenhum trigger é desativado.

## Contrato e substituição das APIs

A fonte existente `motor_progress_ciw_cadastros` recebeu oito operações de `proc_compra_itens`: read/get/create/update/delete e três consultas de opções. O corpo exige `proc_compra_id`; update/delete exigem ID e `row_stamp` da última leitura. O frontend não gera identidades. Campos calculados e identidade não entram nos valores escritos. O registro integral de operações está em `integration-src/purchase-items/metadata/api-source-additions.json`, e o contrato ABL em `purchase-items-contract.json` na mesma integração. A rota é `/SursumPrograms/ciw-cadastros`.

O PHP aceita o formato nativo do formulário, com campos na raiz, e o formato estruturado `record`/`context`. No detalhe, `id` e `item_proc_compra_id` precisam ser equivalentes. A normalização é específica desta entidade, recusa ambiguidades e preserva a validação de contexto, stamp, campos e usuário autenticado.

A implantação utiliza os canônicos `D:/opencode/motor-progress/v2` e `D:/opencode/construtor-pg`. Os JSON canônicos estão em `construtor-pg/integrations/ciw-purchase-items`. Alterações futuras passam pelo Builder e pela compilação/publicação oficial12.2; não substituir o cadastro completo da fonte por um exemplo. Preservar as operações de outras telas.

## Auditoria

O botão **Logs** do formulário consulta o registro e os efeitos relacionados, identificando o usuário autenticado e imagens anteriores/atuais completas. **Logs Exclusão**, na consulta, mostra somente a exclusão do item principal. A auditoria do processo pai também agrega os eventos de seus itens. O dono real do efeito financeiro/fiscal é registrado separadamente do item/processo que iniciou a transação.

O filtro distingue o handler da transação (`entity.api.crud`) da operação de negócio do evento (`delete`). A comparação mostra o registro antes da exclusão e o valor atual como ausente. O detalhe do log não repete o botão Logs.

Os eventos confirmados só são importados após confirmação de commit Progress e validação fechada das imagens. Se a gravação for confirmada e a auditoria vier inválida, o PHP sinaliza a limitação sem repetir a escrita. Os logs não são removidos na limpeza de testes.

## Estado validado e pendências

Publicados: op1014/1.0.0 e cd0108/1.0.2,17artefatos ABL no compartilhamento137 e recarga das sessõesMED ociosas da instância sursum-api/med. ABL12.2:30entradas compiladas,14suítes com371verificações emcada4combinações de cultura/codepage. PHP canônico:695testes/4696asserções. API e runtime reais: consulta, detalhe, paginação, stamp, lookups41/7/3 e rejeições de entradas inválidas passaram. Revisões independentes sem P1/P2 pendentes.

A sequência foi criada com autorização específica, após confirmar ausência entre94sequências. O contador iniciou em3200, acima das sete referências físicas conferidas. O teste gerou3201/3202/3203; excluir os itens não reutiliza essas identidades. Ver `ciw-itens-processo-sequencia-2026-10-22.md`. Não reaplicar o DF, reiniciar ou reduzir o contador.

**Teste operacional autorizado concluído e limpo:** somente processo novo1681 e itens novos3201/3202/3203, marcador `SC_TEST_PROC_ITENS_20261022`. As16etapas comprovaram CRUD, dois vínculos e estornos, recálculo financeiro por diferenças, repetição sem novos movimentos e rejeição409 de stamp antigo sem alteração. Foram21movimentos financeiros novos:12 removidos pelas próprias APIs e9 restantes zerados removidos por manifesto exato. A leitura física final OpenEdge12.2 confirmou zero processo/itens/vínculos/ledger próprios, os dois títulos com imagens completas inalteradas e49eventos nativos preservados. Nenhum container foi criado; efeitos fiscais sobre containers seguem comprovados nas suítes isoladas, sem ampliar o teste operacional.

Interface nativa conferida com `tadeu.parreiras`: contexto do processo, cinco abas, inteiros sem fração, Logs e Logs Exclusão com usuário e comparação anterior/atual. Com autorização específica foram adicionadas somente as oito permissões CRUD de processos MED e itens; a leitura de auditoria já existia. O teste técnico usou sua própria sessão `admin`, corretamente identificada nos logs. O formulário separado de amostras, Anexos e outras origens continuam etapas próprias.

Estado privado e evidências: `.runtime/purchase-items-20261022/ACTIVE_WORK.json`, `official-compile-verification.json`, `canonical-final-manifest.json`, `active-manifest.json`, `sequence-applied.json`, `runtime-metadata-verification.json`, `parent-header-fix-publication.json`, `exercise/confirmed-verify-final.json`, `physical-bridge/cleanup-proof.json`, `business-final-verification.json`, revisões e logs. Os recibos iniciais688testes/versão1.0.1 são históricos, superados pelos deltas de payload nativo, filtro de logs e cabeçalho. Gates do cenário encerrados; não repetir POST ou fixtures concluídas. Nunca incluir credenciais ou dados privados desses recibos na documentação pública.
