# Reconciliação delimitada

| Origem | Contrato comprovado | Cobertura existente | Lacuna |
|---|---|---|---|
| `bl_ponte_versoes_item_custo_container` | index.php:2711–2718 copia container_corrente para filtro_versao_item_custo_container e redireciona para a consulta | Contexto obrigatório container_id da aba Versões Custo no painel | Nenhum cálculo ou writer nessa ponte; não criar nova tela para ela |
| `cons_versoes_item_custo_container` | grid.class.php:950 seleciona versao_id,tipo_versao_id,dt_hr_versao,cod_usuario,descricao,ind_sit_versao,container_id; :531–540 aplica container; :679 ordena versão desc | op1005/ciw.container-versoes-custo, 23 campos readonly, read/get, contexto container_id e filtros versão/data/descrição/situação | grid.class.php:4316–4335 abre cons_det_versoes_item_custo_container com versao_id_corrente; rowLinks=[] no candidato canônico atual, API só retorna cabeçalho |
| `form_versoes_item_custo_container` | apl.php:3407–3420 bloqueia exclusão completa; :4008–4022 e :4341–4343 geram e persistem versão | Processos gerar-versão e fechar-custos já publicados; serviço central de versões é dono dos snapshots | Writer distinto de consultar; não reproduzir MAX+1 nem fórmulas legadas |

`ContainersPainelReadService.p:216–217` retorna cabeçalho de versões. Seu `get` não
retorna os itens persistidos. `ContainersCustoReadService.p:452–478` encontra somente
a última versão do container e junta dois valores unitários ao cálculo atual; isso
não comprova consulta arbitrária ao histórico. Não substituir histórico por recálculo.

`ContainersVersionService.p:169–181,446–481` já possui operação interna `consultar`
com validação versão/container e snapshot persistido dos cinco grupos de filhos.
Essa coleta deve ser reutilizada. Hoje seus loops de consulta não impõem orçamento;
o adaptador público exige limite dentro da varredura, falha fechada e nenhum parcial.

Schemas válidos lidos: `schema/schema-versoes_item_custo_container.json`,
`schema/espec/schema-item_container_custos.json`, `schema/espec/schema-item_container_custo_despesas.json`
e `schema/espec/schema-tipos_versao_custo.json`, sob integration-src/container-panel.
O arquivo alternativo `schema/schema-itens_container_custo.json` tem zero bytes e
nunca foi usado como evidência. A PK física do item é item_container_custo_id;
versao_id+item_container_id não é índice único. `vl_desconto_utiliz_real` é CHARACTER.

O root obteve o destino em `sources/scriptcase/ciw-completion-20261028/cons_det_versoes_item_custo_container`.
Seu grid:757 restringe versao_id; :906 seleciona 14 campos do cabeçalho já disponíveis
em op1005. As linhas101–203 embutem sete consultas. Os sete destinos foram recebidos
em `sources/scriptcase/ciw-completion-linked-20261028/<app>`, sem execução do PHP.

| Filha | Prova de origem | Estado deste candidato |
|---|---|---|
| cons_item_container_custos | grid:898 projeta25campos físicos; :419 ordena qt_embarcada desc; :747 filtra versão | Implementação incremental readonly op1035:25campos presentes, três campos centrais adicionais (memória e despesas sem distribuição), contexto completo container/versão, sem fórmula |
| cons_item_container_custos_comparacao_real | grid:793 expressões de totais, percentuais e unitários BRL; joins atuais com item/pedido | Fila: reconciliar com saída persistida e helper central; não copiar fórmulas |
| cons_item_container_custos_comparacao_dolar | grid:793 mesma apresentação em USD | Fila: reutilizar o mesmo avaliador da comparação BRL, nunca outro coletor |
| cons_item_container_custo_despesas | grid:870 SUM(vl_prev,vl_base_imp,vl_negociado), despesa/versão/log_custo | Fila: reconciliar agrupamento/cardinalidade/NULL antes de expor |
| cons_item_container_custo_nfs | grid:818 oito campos persistidos; estabelecimento compõe identidade; lookup nome-abrev atual por emitente | op1037 candidato readonly reutiliza snapshot.nfs/chave completa; nome atual ainda na fila |
| cons_item_container_custo_pgtos | grid:840 título e valores BRL/USD/versão; sem lookup | op1036 candidato readonly reutiliza snapshot.payments |
| cons_item_container_custo_descontos | grid:830 desconto/valores/versão; sem lookup | op1038 candidato readonly reutiliza snapshot.discounts |

Limite da primeira filha: o lookup `lookup.class.php:23–24` mostra ID mais descrição
ATUAL por itens_container→itens_proc_compra; o snapshot físico guarda o ID e código ERP.
O incremento inicial exibe o ID original. Ainda não reconcilia esse lookup atual,
o nome atual do emitente da NF, despesas agrupadas ou comparações BRL/USD;
não marcar a origem ou o cons_det completo como Convertido.
Moedas BRL/USD são valores persistidos distintos em colunas rotuladas, sem conversão
por cotação atual. `vl_desconto_utiliz_real` mantém o texto histórico bruto.

O probe oficial readonly do root de28/10 em `.runtime/ciw-completion-20261028/schema/`
confirmou item_container_custos31campos/3índices e cabeçalho22/2; nomes/tipos/extents
e índices iguais ao dicionário anterior. O probe atual não exportou decimais;
precisão visual mantém o dicionário histórico, sem alegar relitura desse atributo.
Não houve consulta remota por este executor, alteração canônica, publicação ou negócio.
