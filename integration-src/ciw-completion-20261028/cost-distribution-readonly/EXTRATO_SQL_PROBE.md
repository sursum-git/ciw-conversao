# Probe delimitado solicitado ao root — op1048

Não executado neste pacote. Nenhuma conexão nova, tabela temporária SQL, DDL ou registro comercial deve ser criado. Usar o mesmo mecanismo SQL literal de leitura que o root já possui, com relação sintética de constantes, no máximo dez linhas por caso e timeout10s. Retornar somente caso/tipo/NULL/quantidade/valor sintético/código de erro; nenhum ID ou dado comercial.

Casos mínimos, sem pressupor o resultado no produto:

1. `SUM(v)` para conjunto vazio e para uma linha `CAST(NULL AS DECIMAL(20,2))`: confirmar tipo e NULL. Comparar `COALESCE(SUM(v),0)` e `CAST(100 AS DECIMAL(20,2))-SUM(v)`.
2. Duas linhas sintéticas de mesma data e mesmo agregado10 provenientes de dois ramos: comparar `UNION` com `UNION ALL`; repetir com agregado NULL e com agregados10/-10. Confirmar deduplicação do par data/valor, não de ID físico.
3. Data SQL com `''` nos ramos manuais versus data real: confirmar tipo resultante do UNION da projeção principal e do filtro por intervalo; não converter ausência de data em data mínima por palpite.
4. Empate de duas linhas sintéticas `id=0` com datas diferentes: a fonte principal ordena DATA/ID, mas o evento troca ambas datas por data_saldo. Registrar a ordem observada sem transformá-la em garantia SQL. O coletor de saldo anterior não possui ORDER BY e escolhe a data da primeira linha: exige decisão explícita para desempate determinístico antes de afirmar paridade.
5. Preparação sem execução de SELECT com filtros `container=123`, `codigo_erp='SYNTHETIC'` e `fornec_pi=456` em cada ramo: confirmar erro de alias esperado no terceiro ramo, que só tem custo_distr e ic, e no quarto, que só tem custo_distr/icc/versao. Não consultar dados reais para reproduzir a inconsistência.

Trechos exatos (fonte sanitizada next20/cons_cta_corren_custo_distr):

- `grid.class.php:607`: `calcularSaldoAnteriorDistrCusto($this->sc_where_atual)`; linha615 adiciona `OR ID=0` para preservar a linha de abertura fora dos filtros.
- `grid.class.php:7967–7980`: saldo atual é `SUM(vl_lancto)` de toda `pub.cta_corren_custo_distr`, sem WHERE restritivo nem COALESCE no SQL.
- `grid.class.php:7983–8016`: substituições literais de aliases do WHERE. `CODIGO_ERP→ipc.codigo_erp`, `CONTAINER→ic.container_id`, `FORNEC_PI→pc.fornecedor_id`; manual alternativo usa literais e `versao.container_id`.
- `grid.class.php:8019–8068`: quatro SELECTs com `GROUP BY data` unidos por UNION (não ALL). Ramos: tipo3 via snapshot/itens/compra/container/processo; tipo4 via item/compra/container/processo; tipo2 via item apenas; tipo2 via snapshot/versao apenas. Os dois ramos tipo2 podem alcançar o mesmo lançamento.
- `grid.class.php:8087–8102`: soma cada agregado retornado em PHP, toma a primeira data sem ORDER BY e calcula `saldoAtual-total`.
- `grid.class.php:5345–5354`: id0 recebe data_saldo e sd_anterior; `calc_saldo += valor` na sequência de exibição, antes da página visível.

O plano central `ContainersDistribuicaoCalculator.p` calcula rateio/delta/lançamento, não este extrato global. `ContainersCustoReadService` agrega somente tipo4 por item para custo; `ContainersDistribuicaoService.LoadPlan` agrega snapshots de versões anteriores. Não são substitutos semanticamente equivalentes deste UNION. Depois da prova, um único coletor/helper de extrato deve alimentar lista/detalhe/saldo; não copiar fórmulas de custo ou de rateio. Nenhum metadado definitivo op1048 é emitido antes destes gates.
