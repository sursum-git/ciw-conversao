# Pagamentos do container: associação e desvinculação

Inventário estático em17/10/2026. Nenhum PHP, consulta de negócio, sequência, rede ou escrita de produto foi executado. Escopo: as três consultas locais, seus eventos de seleção e funções replicadas em `index.php`/`*_grid.class.php`. As funções financeiras aqui descritas são as alcançadas pelos eventos ativos; presença de uma função na biblioteca não implica que o botão a execute.

Abreviações dos fontes, todos em `sources/scriptcase/containers/`:

- **A**: `cons_tit_ap_associar_container/index.php`; **AG**: sua `cons_tit_ap_associar_container_grid.class.php`.
- **D**: `cons_tit_ap_associados_container/index.php`; **DG**: sua `cons_tit_ap_associados_container_grid.class.php`.
- **P**: `cons_tit_ap_associar_container_apos_di/index.php`; **PG**: sua `cons_tit_ap_associar_container_apos_di_grid.class.php`.

## Eventos ativos e ordem dos efeitos

| Ação | Evidência e sequência exata |
|---|---|
| Associar antecipação | A7599–7620: para cada título marcado, `associarTituloContainer` → `iniciarTransacao`/`setTransacaoUniversal` → `estornarPgtosContainerPedImp` → `gerarRateioFornecAntecipsContainer` → `setCustoContainerDesatualiz(...,1)` → `finalizarTransacao` → `sincronizarImpostos`. INSERT ocorre antes do marcador de transação. |
| Associar título após DI/NF | P7600–7621: mesma sequência da antecipação; a diferença ativa está na seleção dos títulos, não na persistência ou no rateio. |
| Desassociar | D7640–7656: `iniciarTransacao`/`setTransacaoUniversal` → `estornarPagtosContainer(2,titulo,hist)` → `atuRatPagtoPedTitContainer(titulo,hist)` → `desassociarTituloContainer(titulo,CID)` → stale1 → `finalizarTransacao`. Não chama sincronização fiscal nem atualização de despesas calculadas neste evento. |

A/P selecionam dados da grade para `total_chked` e percorrem o array no término da ação; D faz o mesmo. Não há revalidação individual de elegibilidade dentro do INSERT/DELETE. A7612–7619 e P7613–7620 recalculam o conjunto completo de títulos vinculados ao container após cada INSERT, não apenas o título recém-selecionado. A7612/P7613 não usam os valores monetários exibidos para persistir a associação.

O botão de DG5418 se chama **Buscar Títulos Após NF** e encaminha para P. O nome da aplicação menciona DI. Não encontrei guard ativo exigindo que já exista DI/NF para abrir ou executar P.

## Elegibilidade real das consultas

Todas consultam EMS5 `PUB.tit_ap` (A1235, P1235, D1275). As seleções exibem estabelecimento, espécie, série, fornecedor, título, parcela, emissão, vencimento, indicador econômico, valor original, ID e empresa; por exemplo AG970–992. Vencimento é coluna/filtro opcional da grade, não precondição fixa da associação.

| Consulta | Predicado fixo | Filtro dinâmico |
|---|---|---|
| Antecipações | `log_tit_ap_estordo=0 AND substr(ind_tip_espec_docto,1,8)='antecipa'` (A6748/AG817). | AG556–565: exclui lista de títulos já associados e exige `cod_espec_docto IN getEspecsAdiant()`; chama `preencherCondPagtoContainer` sem segundo argumento. |
| Após DI/NF | `log_tit_ap_estordo=0 AND substr(ind_tip_espec_docto,1,8)<>'antecipa' AND log_sdo_tit_ap=0` (P6749/PG819). | PG557–566: mesma exclusão, espécies `getEspecsTit()` e mesma chamada com segundo argumento omitido. |
| Associados | `log_tit_ap_estordo=0` (D6790/DG817). | DG561–568: `num_id_tit_ap IN buscarTitAssociadosContainer(CID)` e `preencherCondPagtoContainer`. Não separa antecipação/título por espécie. |

`preencherCondPagtoContainer`, D17843–17904 (equivalentes A17735/P17736):

1. Fornecedores elegíveis são `DISTINCT procs_compra.fornecedor_id` dos itens atualmente alocados, pelo JOIN itens_container→itens_proc_compra→procs_compra (D13392–13404). Havendo lista, usa `cdn_fornecedor IN lista`. Sem lista, usa fornecedor do mestre da sessão, se preenchido. Logo títulos de fornecedor de qualquer pedido alocado podem ser associados, mesmo se diferente do fornecedor do mestre.
2. Usa `cod_empresa = empresa_container_corrente_ems5` quando preenchida. Origem dessa empresa: primeiro caractere de `pp-container.cod-estabel` → `empresas.cod_emp_ems2` → `cod_emp_ems5` (D16442–16475). API deve derivar do pai e exigir mapeamento único, sem aceitar empresa do navegador.
3. Usa `dat_emis_docto >= buscarDtRegContainer(CID)`. D16418–16440 consulta **MIN(procs_compra.dt_registro)** dos pedidos dos itens do container. Variável começa em2015-01-01; retorno vazio cai em2005-01-01. Não é data de compra do cabeçalho.
4. Existe ramo `$logPgtoPosDI=true` para emissão da NF mãe, mas nenhuma das três chamadas ativas passa true. Esse ramo ainda chama `buscarDtEmisNotaMaeContainer` sem `$this->`; não convertê-lo silenciosamente em regra ativa. P continua usando o registro dos pedidos.

`getEspecsAdiant`, D10821–10834, lê `especs_adiant_importacao`, default `'AF'`; `getEspecsTit`, D10836–10849, lê `especs_tit_importacao`, default `'DI'`. Nas APIs, reutilizar a include central `parametros_ima.i` sem cache e parsing interno, sem SQL livre recebido do cliente.

**Exclusão de títulos já associados:** `getListaTitAssocContainer`, D17995–18024 (A17887/P17888), junta pagtos_container a pp-container sem restringir CID, filtrando somente `pp-container.cod-emit-forn` pelo fornecedor do mestre quando preenchido. Portanto exclui títulos de todos os containers daquele fornecedor; sem fornecedor, de todos os containers. Isso não equivale a um índice único global por título, nem contempla necessariamente containers com outro fornecedor de mestre.

## Escritas e chaves físicas

`associarTituloContainer`, A17828–17845/D17936–17953: `INSERT pagtos_container(num_id_tit_ap,container_id)` somente. `desassociarTituloContainer`, A17847–17864/D17955–17972: DELETE por **ambas** as chaves. Não modifica EMS5 `tit_ap`/`val_tit_ap`, não altera fornecedor do título e não grava moeda ou valor exibido no vínculo.

Dicionário real `integration-src/container-panel/schema/schema-pagtos_container.json`:

- PK única composta `ind_pagtos_container(num_id_tit_ap,container_id)`; não há unicidade de num_id_tit_ap isolado. Nenhum trigger.
- Sete campos: `num_id_tit_ap`, `container_id`, `vl_pago_em_dolar`, `vl_pago_em_real`, `vl_aprop_em_dolar`, `vl_cotacao_dolar`, `dt_pagto`. Os quatro decimais têm DECIMALS2/default0; data default desconhecido/null. O INSERT legado deixa esses cinco campos nos defaults.
- Não existe sequência da associação: identidade natural é o par. Novo serviço deve fotografar os sete campos, inclusive o lado anterior da exclusão, sem preencher os cinco valores com números de ERP por inferência.

EMS5 `schema/ems5/schema-tit_ap.json`: `titap_token` é UNIQUE `(cod_estab,num_id_tit_ap)`; PK comercial `titap_id` é `(cod_estab,cdn_fornecedor,cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela)`. O ID numérico isolado não é único no dicionário. `pagtos_proc_compra` tem PK composta `(num_id_tit_ap,proc_compra_id)`, portanto o primeiro pedido retornado pelo legado pode ser ambíguo.

## Conta corrente: efeitos alcançados

**Associação — tipos4 e5.** `estornarPgtosContainerPedImp`, D8471–8497, percorre TODOS os títulos já vinculados ao container. `estornarTitAssocPedImp`, D8619–8667, verifica existência de qualquer tipo4 do título (D8454–8469), agrupa SUM4 pelo fornecedor/item de pedido/item de container e cria novo tipo4 de valor `−saldo`, ação1; o item de container da nova linha fica no default0. Não exige vínculo pagtos_proc_compra para reconhecer histórico tipo4.

`gerarRateioFornecAntecipsContainer`, D9172–9303, percorre TODOS os títulos e itens do container. Usa proforma global e de cada item, dólares do título e saldo anterior tipo5 por fornecedor do pedido/título/item de pedido/item de container (D9149–9169). Alvo=`proformaItem/proformaGlobal*USD`, com ramo explícito alvo0 quando produto global×USD=0. Delta=`ROUND(alvo+ROUND(saldo5,2),2)`; novo5=`−delta`, ação1 se delta>0, ação3 caso contrário; zero não gera movimento. Proforma usa soma embarcada se não zero, senão soma alocada, tanto no agregado global quanto na consulta individual (D12743–12795). Fornecedor diferente do mestre só muda o histórico (D9254–9263), não impede o rateio.

**Desassociação — novo tipo5 a partir de SUM5,6.** `estornarPagtosContainer`, D8669–8763, nível2 executa `getSomasCtaCorrenFornec('5,6',true,titulo)`, sem CID. Agrupa fornecedor/item do pedido/item de container e cria novo **tipo5**, ação3, valor `−SUM(5,6)` (D8730–8757). Não cria tipo6. O tipo6 entra somente no saldo histórico; a criação de tipo6 por exclusão de item é outro evento, D8566–8617, não chamado aqui. O agrupador D8765–8830 usa tabela cta_corren_fornec_imp; filtro opcional de fornecedor contém typo `fornec_id`, porém este caminho passa fornecedor0 e não ativa esse filtro.

**Rerateio do pedido antes de DELETE não é noop.** D9090–9112 `atuRatPagtoPedTitContainer` resolve primeiro pedido em pagtos_proc_compra (D10345–10359) e chama `sincrRateioAntecipPedImp(pedido,hist,TRUE)`. D8960–9022 respeita `procs_compra.log_considerar_previsao`; se habilitado, percorre **TODOS os títulos desse pedido** e TRUE sobrescreve `verificarNecesAtualizPgtoPedido`, mesmo que ainda estejam associados a containers com itens. Assim o rateio tipo4 ocorre antes de remover o vínculo; não aplicar a regra de elegibilidade usual de exclusão de item a este fluxo.

Tipo4 de pedido D9024–9089: peso=`qt_comprada*vl_negociado` por item sobre soma de todos os itens do pedido (D9965–9992); alvo=USD×peso/total; delta=`ROUND(alvo+SUM4(fornecedor,titulo,itemPedido),2)`; valor=`−delta`, ação1/3 conforme sinal. Item de container0. Inclui itens de pedido fora do container e títulos diferentes do que está sendo desvinculado. Divisor zero não tem proteção no PHP; conversão deve falhar explicitamente antes de writes, nunca inventar rateio.

Tipos7/8 não aparecem como criação neste encadeamento. Tipo9 existe na biblioteca `gerarRateioFornecContainer`, D9305–9359, para transferir saldos entre fornecedores; busca estática nas três aplicações encontra apenas a definição, sem chamada pelos eventos ativos. Não incluir9 no novo writer por proximidade da função. Tipo10 é sincronização de quantidade embarcada em outro ciclo, não efeito deste botão.

## Fiscal, versão e logs

Stale D16763–16790 grava `log_versao_custo_desatualizada=1` e `dt_hr_ult_alt_versao_custo=now()`. Não gera nova versão, não fecha custo e não atualiza item_custos.

Associação chama `sincronizarImpostos` após cada título: D14573–14586 cria cálculo, calcula impostos, gera despesas de impostos, registra evento User/sincImp e sincroniza IPI por item. Não chama explicitamente atualização de despesas calculadas. Desassociação não chama essa função. Reutilizar infraestrutura fiscal, mas decidir a composição exata; `CabecalhoRules.OnUpdate` atual faz sincronização **e** calculadas, portanto não é substituição de paridade exata sem decisão registrada.

D8389–8442 cria 13 campos do ledger via `seq_cta_corren_fornec_imp.NEXTVAL`, login de sessão, data/hora e transacao_id; suprime zero. `iniciarTransacao`/`finalizarTransacao`, D13407–13456, são INSERT/UPDATE de marcador `transacoes` via seq_transacao, não BEGIN/COMMIT SQL. `setTransacaoUniversal` D13457 em diante usa variável local e chamadas aninhadas resetam estado; não copiar esse estado de sessão para a nova API. A decisão existente no serviço convertido é transacao_id0, sem inserir ID PostgreSQL nesse campo.

Logs legados são diagnósticos opcionais via `zerarLogDb`/`inserirLogDb`, D11045–11060 e funções chamadas, além de User/sincImp. Não constituem snapshots estruturados de antes/depois do vínculo. Novo writer deve compor vínculo sete campos, mestre stale, ledger e efeitos fiscais sob uma única transação e só publicar auditoria confirmada após commit, com autoria autenticada. Nested retorna pendências e exige UNDO pelo chamador em falha.

## Reutilização e protocolo recomendado

`ContainersItensFinanceiroService.p` já possui a matemática central dos tipos4/5 e callbacks privados de moeda. Acrescentar operações privadas associate/disassociate nesse serviço permite compartilhar o plano/persistência. Não simular criação/exclusão de um item fictício: associação é domínio do vínculo, sem item-alvo. Associate compartilha estorno4+rateio5 após INSERT; disassociate precisa agregar SUM5,6 do título e forçar rateio4 do conjunto completo do pedido, preservando o fluxo atual create/update/delete de itens. O novo writer do vínculo continua separado.

`ContainersPagamentoTotalsService.p` fornece CurrencyValue e `capture_rows` com valores real/dólar por título. Reutilizar callbacks/adapter de links para container e pedido, sem copiar fórmulas ou aplicar filtros da grade aos totais vinculados. D10778–10819 confirma a regra cambial herdada, incluindo fallback pago/original; conversão já rejeita ambiguidades de FIRST. O grid convertido `ContainersPainelFinanceReadService.p` é referência de projeção/lookup e não escritor de ERP.

Proposta de serialização, ainda não executada: resolver título com contexto servidor e verificar que num_id_tit_ap legado não escolhe arbitrariamente estabelecimentos; mestre EXCLUSIVE NOWAIT e registro EMS5 tit_ap resolvido EXCLUSIVE NOWAIT como mutex, sem atribuição/CREATE/DELETE EMS5. SHARE permite duas associações concorrentes e não serve de mutex. Sob esse lock, reler links globalmente e conferir owner único antes do INSERT; PK composta não protege essa regra sozinha. Confirmar que conexão/credencial EMS5 suporta lock antes de adotar. Ordenar títulos envolvidos no rerateio forçado e pedidos/itens/ledger por PK; NOWAIT falha com rollback. Esse protocolo só serializa escritores cooperantes; não promete bloquear inserts por legado que não o respeita. Não há necessidade de alterar schema ou criar linha ERP.

## Pendências e diferenças que exigem decisão

1. Excluir título da consulta apenas por fornecedor do mestre permite diferenças de owner entre containers. Definir owner único global no protocolo sem alegar que há índice único existente.
2. Num_id_tit_ap e pedido associado podem ser ambíguos; rejeitar explicitamente em vez de reproduzir FIRST silencioso. Um título com histórico5/6 de item fora do pai exige prova de ownership antes de estorno global; não auditar um item estranho como filho do CID atual.
3. Preservar data mínima real dos pedidos em P, ou ativar emissão da NF mãe: ativação seria mudança de comportamento, não inferência do nome da tela.
4. Fiscal após associação e ausência após desassociação devem ser decisões explícitas, sobretudo se houver intenção de chamar OnUpdate completo e recalcular calculadas.
5. Batch legado executa por título e não demonstra atomicidade. Novo serviço deve declarar atomicidade do lote e fazer planejamento/validação antes das sequências.

Não faltam fontes dos eventos ou funções financeiras alcançadas: estão replicados nos seis arquivos principais locais. Includes gerados de sessão/erro e lookup estão referenciados, mas não são necessários para identificar as regras de negócio acima. Dicionários necessários de pagtos_container, pagtos_proc_compra, tit_ap, val_tit_ap, itens/pedidos, empresas e ledger já existem localmente. Nenhuma regra de alterar título EMS5, previsão global tipo3, transferência9 ou fechar versão foi inferida.

## Contrato de opções preparado em17/10/2026

`ContainersPainelFinanceReadService.p` passou a aceitar internamente `pagamentos-disponiveis`, mantendo os dez handles e policy/request/response existentes. Parâmetros9/10 de NF podem ser desconhecidos nesse recurso. O wrapper público financeiro continua responsável por seu gate original pagamentos/nfs; este inventário não declara publicação do novo recurso.

Request fechado: `{operation:'read'|'get',resource:'pagamentos-disponiveis',container_id,id?}`. Get usa num_id_tit_ap positivo em id; não aceita alias, modalidade, policy ou filtros do navegador. CompanyContext, SupplierDateContext, CurrencyValue e PaymentRow são reutilizados. A união reproduz os predicados ativos de antecipações e após DI/NF; modalidade de saída `adiantamento` ou `apos_di`. A linha contém os campos de PaymentRow e `value` INTEGER, `label` comercial com modalidade/estabelecimento/espécie/série/título/parcela/valores e `modalidade` STRING. Pagamento_key delega à include compartilhada `ContainerPaymentIdentity.i`; NFKey mantém sua implementação anterior.

**Read é lista de opções do formulário; get é prova estrita de seleção.** Read pode manter um título ligado ao próprio CID com prefixo `Já associado`, sob os mesmos filtros de empresa/fornecedor/data/espécie/flags; omite qualquer título ligado a outro CID. Get exclui vínculo de qualquer CID, inclusive o próprio, e devolve404 para um título inelegível. Essa convenção de read foi decisão expressa da conversão, para o formulário somente leitura mostrar a chave comercial após criação; não foi inferida do SQL legado. O comando deve validar conflito409 antes do get estrito.

Candidate elegível com mais de um registro tit_ap do mesmo ID global gera422 `CONTAINER_PAYMENT_AMBIGUOUS`, mesmo se a outra ocorrência está em empresa fora da seleção. Faz uma varredura global com projeção apenas de num_id_tit_ap, retendo no máximo5000 candidatos; não executa uma varredura ERP completa por candidato. Read com5001 linhas falha422 `CONTAINER_OPTIONS_LIMIT`, sem resultado parcial/truncado;5000 são devolvidas integralmente, por ID numérico. Não há buffer write, sequência ou escolha de tabela/SQL pelo cliente. O writer deve manter o mutex do título em buffer próprio durante a revalidação; leitura de opções sozinha não é mecanismo de serialização.

Diagnóstico local OpenEdge12.8:231 verificações em AMERICAN e EUROPEAN, incluindo regressões de pagamentos/NF, ambas as modalidades, escopo e flags desconhecidos, vínculos próprios/alheios, get estrito, duplicidade global do ID, limites5000/5001 e identidade compartilhada CID123/estab505/título7. Artefatos locais não foram publicados; root compila12.2 e publica o lote coerente.
