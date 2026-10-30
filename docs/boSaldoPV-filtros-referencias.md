# Consulta por referências

O fluxo `cons_item_estoque_unificado -> bl_estoque -> cons_wp_estoq_unificado`
recalcula somente as origens selecionadas, por referência. O helper
`filtrarPorQtRef` remove cada linha abaixo do mínimo positivo da unidade,
inclusive para usuários 3/4. Mínimo zero preserva linhas negativas.
A lista inicial usa `filtrarPorQt`, com regra diferente por item e usuário.

Implementação: parâmetro `consultaReferencias`, padrão NO, reutiliza as três
etapas e os componentes de saldo existentes. Força detalhamento e filtra linhas
individuais na etapa 3. Não mantém origens não selecionadas. As seleções REF,
ESTAB, LOCAL e CONTAINER continuam disponíveis para filtros internos explícitos.
O chamador informa o código do item em `pesquisaItem`; ao reproduzir o link
Consultar, não deve copiar a seleção REF da lista inicial: o PHP a descarta.
Mínimos e origens são preservados. Máximos permanecem uma extensão da BO.

Validação prevista: regressão da lista, negativos com mínimo zero, mínimo por
referência mesmo para tipo 4, seleção REF e origens; compilação oficial 12.2;
comparação de referências/saldos reais com tasilpar. Preços e books ficam fora
desta comparação. A BO usa apenas temp-tables, sem criar protocolos MySQL.

Exemplo do detalhe, usando a mesma include e os setters existentes:

```progress
CREATE ttFiltroSaldoPV.
ASSIGN ttFiltroSaldoPV.login = "tasilpar"
       ttFiltroSaldoPV.tipoUsuario = 4
       ttFiltroSaldoPV.pesquisaItem = "175182"
       ttFiltroSaldoPV.consultaReferencias = YES
       ttFiltroSaldoPV.minimoMT = 2.
/* Preencher ESTAB/autorizacoes como na consulta inicial.
   Para filtro interno explicito: selecaoReferenciasAtiva=YES e selecao REF.
   Para reproduzir Consultar: nao transferir REF da lista inicial. */
RUN setParametros IN hBo(INPUT TABLE ttFiltroSaldoPV).
RUN setSelecoes IN hBo(INPUT TABLE ttSelecaoSaldoPV).
RUN exec IN hBo.
RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
```

Resultado confirmado em 20/10/2026, usuário informado tasilpar/tipo 4:

| Opções / mínimo MT | Linhas do detalhe na página e na BO |
|---|---|
| PE+PI / 0 | PE A01=-1; A02=1; LED=50; PI A01=11200; A02=7000 |
| PE / 0 | PE A01=-1; A02=1; LED=50 |
| PE+PI / 2 | PE LED=50; PI A01=11200; A02=7000 |
| PI / 12000 | Nenhuma linha |

As linhas PI são do container 1654. Comparação limitada a origem, referência,
container e saldo disponível; preços, Qt.Total PI antes do percentual e nome do
estabelecimento exibido não fazem parte da equivalência. A página exibe PI
"Infefinido", enquanto codEstab da BO representa o estabelecimento do cabeçalho
usado no filtro. Não confundir esses campos. Identidade da página foi informada
pelo usuário, pois ela não a exibe. Leituras foram feitas em instantes distintos.

Compilação oficial 12.2/.42 e 105 checks por cultura AMERICAN/EUROPEAN passaram;
18 tabelas sintéticas vazias ao final. Testes cobrem referência explícita,
negativos, limite inclusivo e duas linhas PI de mesma referência sem agregação.
Regressão real: 14 casos da lista contra a captura UI completa anterior também
coincidiram. Revisão independente sem bloqueador; lacuna de testes PI apontada
na revisão foi coberta antes da compilação final.

Publicado em 20/10/2026 às 21:19 BRT no `.137`, apenas boSaldoPV.p/.i/.r, com
backup/guarda de hashes, original preservada. Recompilar chamadores e liberar
handles persistentes antigos, pois a TT de critérios mudou. Recibo privado:
`.runtime/bo-saldo-20261020/publish-detail-filters-receipt.json`; compilação em
`compiled122-detail-filters-final/verification.json`; comparação em
`live-detail-tasilpar-final/comparison.json` dentro da mesma pasta privada.
A execução real foi cliente 12.2/.42 lendo bancos .111 NO-LOCK; integração e
validação do consumidor PASOE `sursum-api/med` permanecem pendentes.
