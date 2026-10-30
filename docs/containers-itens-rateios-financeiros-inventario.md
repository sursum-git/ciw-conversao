# Rateios financeiros acionados pelos itens — inventário17/10/2026

Somente leitura, preparado para portabilidade em serviço reutilizável. Fonte principal F=sources/scriptcase/containers/form_itens_container/form_itens_container_apl.php. Não publicar CRUD de conta corrente fornecedor por inferência: a tela continua temporariamente excluída; os efeitos financeiros dos itens existem independentemente dela.

## Callbacks efetivos do lifecycle

- Alocar: grid_itens_proc_compra_selecao/index.php6757–6765 chama estornarPgtosContainerPedImp e gerarRateioFornecAntecipsContainer após impostos/despesas calculadas.
- Editar: F5394–5412 chama gerarRateioFornecAntecipsContainer e sincrQtEmbarcadaCtaCorrenFornec.
- Desalocar/delete: F5437–5445 chama rateio dos remanescentes, estornarPagtosItemContainer e atuRatPagtoPedItemContainer (re-rateio do pedido), além de fiscal/stale.
- CRUD global pedido não faz parte do painel: excluir sua implementação desta etapa, preservando só os helpers que o lifecycle realmente exige.

As funções de rateio container/estorno e buscarVlMoeda do grid de seleção são textualmente equivalentes às do formulário, descontadas sessão/app/espaços. Mapeamento de referência F→grid/index: rateio7898→8070; estorno pedido7197→7369; estorno título7345→7517; saldo5 7877→8049; moeda9437→9710. O INSERT ledger usa Db no formulário e conexão especw no grid; não são transações compartilhadas provadas.

## Escrita canônica do ledger

F7112–7161 criarRegCtaCorrenFornec(fornecedor,data,itemPedido,historico,tipo,valor,acao,titulo=0,itemContainer=0): não insere quando valor=0. INSERT F7135–7139 em espec.cta_corren_fornec_imp com seq_cta_corren_fornec_imp.NEXTVAL,fornecedor_id,data,item_proc_compra_id,historico,cod_tipo_movto,vl_lancto,cod_acao,login,data_hora,num_id_tit_ap,item_container_id,transacao_id. Valor físico DECIMALS2; IDs INTEGER; data DATE/data_hora DATETIME. Schema já disponível. Autoria/transação hoje vêm de sessão, na API devem vir do runtime autenticado.

F7491–7555 getSomasCtaCorrenFornec agrupa fornecedor/título/itemPedido/itemContainer quando quebra=true e soma vl_lancto dos tipos e filtros explícitos. Não converter lookup ambíguo de título em FIRST arbitrário. Sem saldo não significa falha de DB ou fornecedor0 permitido.

## Tipo5 — rateio do pagamento do container

F7898–8027:

1. Container e item têm valor proforma USD. Helper F11410–11460 escolhe total embarcado se total embarcado nãozero, senão total alocado; preço proforma=itens_proc_compra.vl_custo_dolar. Esse fallback é por agregado consultado, inclusive item selecionado; não trocar por soma de fallback por linha sem conferir equivalência.
2. Lista de títulos dos vínculos pagtos_container (F17056). Para cada título, valor USD via buscarVlMoeda.
3. Para cada item atual, fornecedor do pedido é JOIN item→proc. Não exigir igualdade ao fornecedor do container: F7983–7988 só altera histórico.
4. Se proformaContainer×valorTitulo diferente de0: valorRateio=proformaItem/proformaContainer×valorTitulo; senão valorRateio0 (F7951–7955).
5. saldo5=SUM ledger tipo5 pelo fornecedorPedido/título/itemPedido/itemContainer (F7877–7887). diferença=ROUND(valorRateio+saldo5,2) (7964–7968).
6. Se diferença nãozero, cria tipo5 com valor=-diferença. Ação1 se diferença positiva; ação3 se negativa (7990–8012). Quando logEstorno=true, usa saldo5 como diferença.

É fórmula de alocação de fornecedor, não custo geral/versão. Não copiar calculadores de custo/fiscal; adaptar uma única rotina compartilhada pelos comandos item/alocar. Zero denominador aqui possui ramo explícito na fonte; não inferir o mesmo ramo para outro helper sem prova.

## Tipo4 — estorno/re-rateio do pedido

estornarPgtosContainerPedImp F7197–7223 percorre títulos associados ao container e chama estornarTitAssocPedImp F7345–7393. Se verifTitPedImp confirma associação do título ao pedido, agrupa saldo tipo4 do título e cria tipo4 com -saldo, ação1 (7373–7380).

atuRatPagtoPedItemContainer F7838–7852 deriva pedido do item e chama sincrRateioAntecipPedImp F7686–7749. Só processa se procs_compra.log_considerar_previsao=1; títulos vêm de pagtos_proc_compra. Por padrão verificarNecesAtualizPgtoPedido F9055–9067 impede re-rateio quando o título está associado a algum container que já possui itens. Forçar é argumento privado, defaultfalse; browser não escolhe.

gerarRateioAntecipPedImp F7750–7815: pesos são quantidade comprada×vl_negociado (buscarPonderacaoItensProcCompra); valor=USDtitulo×pesoItem/pesoPedido; saldo4=SUM pelo fornecedor/título/itemPedido (F7857–7872); diferença=ROUND(valor+saldo4,2). Se nãozero, novo tipo4=-diferença, ação1 se positiva e3 se negativa. Modo estorno usa saldo4 diretamente. A divisão pesoItem/pesoPedido F7771 não possui guarda zero: nova rotina precisa erro explícito/rollback, não retorno financeiro inventado.

Previsão tipo3 gerarVlPagarItemPedido F7600 e CRUD do pedido não são chamadas pelo lifecycle normal de alocar/editar/desalocar; não ampliar automaticamente escopo para geração de previsão global.

## Tipo6 — reversão do item desalocado

F7292–7343 estornarPagtosItemContainer agrupa SUM tipo5 do itemContainer (fornecedor,título,itemPedido,itemContainer), cria tipo6 com valor negativo desse saldo, ação3, preservando IDs (7300–7332). O snapshot anterior do item é necessário após DELETE.

Não confundir com estornarPagtosContainerSemItens F7225–7291, que agrega tipo6 e tem outra guarda; essa segunda rotina não é chamada diretamente pelo evento de exclusão auditado. Não somar tipos5/6 indiscriminadamente em todos os caminhos para “corrigir” sinais: cada origem tem tipos explícitos.

## Tipo10 — diferença embarcada

F11984–12060 sincrQtEmbarcadaCtaCorrenFornec:

- Relê item e usa qt_confirm_emb>0; diferençaQuantidade=confirmada−alocada, precisa nãozero.
- valorDif=diferençaQuantidade×preço negociado atual do pedido.
- saldo anterior=SUM tipo10 pelo itemContainer; a variável de saldo tipo3 é explicitamente0.
- delta=ROUND(valorDif−saldoTipo10,2), cria tipo10 se nãozero, com fornecedor do pedido, ação2 e itemContainer (12008–12047).
- Confirmada voltando a0 ou ficando igual à alocada não entra no ramo e não estorna automaticamente tipo10 anterior. Isso é decisão legada real a confirmar, não oportunidade de inventar estorno.

## Conversão monetária e dependências

F9437–9497 buscarVlMoeda faz JOIN EMS5.val_tit_ap→tit_ap por num_id_tit_ap/cod_estab, finalidade dolar/corrente. Consulta sem codEstab pode ser ambígua; valores devem vir do helper monetário central já existente, não nova cópia. ContainersPagamentoTotalsService.p já tem CurrencyValue e capture_rows privado por título; avaliar extração/reuso do mesmo núcleo para títulos de pedidos sem duplicar fórmula. A rotina nova não deve somar a grade filtrada de pagamentos. Espécies e política IMA continuam include direto NO-LOCK sem cache, sem seleção por navegador.

Schemas existentes: cta_corren_fornec_imp,procs_compra,itens_proc_compra,itens_container,pagtos_container,empresas,EMS5.tit_ap/val_tit_ap. Faltantes identificados: espec.pagtos_proc_compra; espec.transacoes caso se preserve ledger.transacao_id físico original. Helpers de LogsDb usam logs/itens_log/usuario_log_id no banco legado; substituir pela infraestrutura ApiExecutionRepository/manual audit já aprovada, sem presumir equivalência entre transacao_id SQL legado e executionId/log do runtime.

F12506–12562 iniciar/finalizarTransacao apenas INSERT/UPDATE em espec.transacoes com seq_transacao e horários; **não demonstram uma transação de banco abrangendo as duas conexões**. Evitar reproduzir sessões/IDs globais. O serviço ABL deve compor todas as mutações item/fiscal/financeiro em uma transação raiz real e emitir before/after só póscommit; nested apenas pending e erro obrigatório para UNDO ancestral.

Decisões a fechar antes do port: preservar os ramos de não estorno tipo10 e os tipos/ações acima; ambiguidade título→mais de um pedido/container sem FIRST; tratamento pesoPedido0; vínculo físico transacao_id sem nova tabela/seq inventada; locks globais por itemPedido/título/pedido para evitar rateio parcial entre containers. Lote deve falhar atomicamente quando um componente obrigatório não puder ser comprovado.
