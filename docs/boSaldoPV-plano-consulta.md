# Plano de seleção de itens da boSaldoPV — 20/10/2026

Nota de versão: os tempos abaixo pertencem à revisão de intervalos anterior.
A revisão publicada às20:47 acrescentou `pesquisaItem` (códigos exatos/listas com
índicecodigo ou termos da descrição) e apresentação de ambos os saldos. O XREF12.2
preservou os caminhos por item/família/grupo e confirmou o índice poritem da TT de
elegibilidade. Os tempos históricos não constituem benchmark desta nova revisão.
Ver [comparação atual](boSaldoPV-comparacao-pagina.md).

## Revisão com limites de14z e comparação de resultados

A pedido do usuário, os limites padrão de item e família passaram a `""` até
`"zzzzzzzzzzzzzz"`, inclusivos. A BO normaliza o fim explicitamente vazio para14z.
Isso é um limite real: códigos acima dele são excluídos por padrão, mas podem ser
consultados com fim explícito maior. Testes sintéticos cobrem ambos os casos.

Comparação no OpenEdge12.2/.42 contra dados reais ems2med/espec do .111, exclusivamente
NO-LOCK na etapa `selecionarItens`. Não foram buscados saldos nem alterados dados de
negócio. Os códigos e famílias usados como amostra permaneceram na memória do processo;
as evidências registram somente contagens, diferenças e tempos.

Foram comparadas a BO anterior, a troca simples dos quatro predicados por intervalos
diretos, uma alternativa OPEN QUERY e a implementação final com três FOR EACH estáticos.
Cada comparação teve oito cenários, quatro rodadas com ordem alternada. A primeira
rodada foi descartada no cálculo das medianas abaixo. As tabelas de itens foram
comparadas por chave e todos os campos: zero diferenças nas quatro rodadas de todos
os cenários das três comparações.

| Cenário | Itens | Anterior ms | Final ms |
|---|---:|---:|---:|
| Sem filtros opcionais | 4317 | 1392 | 1470 |
| Item exato | 1 | 11 | 1 |
| Família exata | 95 | 38 | 31 |
| Item e família exatos | 1 | 12 | 1 |
| Somente início de item | 4085 | 1268 | 1175 |
| Somente fim de família | 354 | 182 | 122 |
| Somente fim de item | 233 | 72 | 66 |
| Somente início de família | 4058 | 1303 | 1176 |

Mantida a implementação FOR EACH: melhora sete cenários medidos, com regressão de
aproximadamente5,6% sem filtros. A troca simples não melhorou família de forma consistente;
OPEN QUERY foi descartada porque piorou as consultas amplas. Os tempos são de três
rodadas medidas na rede .42→.111, sujeitos a cache/carga/resolução do relógio; não são
garantia de ganho em qualquer consulta ou no PASOE.

O XREF do fonte final confirma `codigo` no caminho com faixa de item, `fam-ge` com
faixa de família sem item e `grupo` sem ambos, todos sem WHOLE-INDEX nessa leitura.
Os outros filtros e a criação da TT ficam na rotina `_adicionarItem`, sem duplicar
regras de elegibilidade. Não foi usado USE-INDEX.

Validação oficial12.2:81 checks em cada cultura AMERICAN/EUROPEAN,18 tabelas sintéticas
vazias após ambas, compilação contra esquema real sem erros. Revisão independente do
delta sem defeitos concretos. Fonte final SHA-256
`7236b0ee4f23e40f59c1651b640cd7bf7b31e64866e7e161cf911f6b33ff2ed8`.
Evidências privadas: `benchmark-ranges/`, `benchmark-adaptive/`, `benchmark-foreach/`,
`benchmark-summary.json`, `compiled122-ranges/` e `publish-ranges-receipt.json` sob
`.runtime/bo-saldo-20261020/`. Publicação cobre somente os três arquivos da boSaldoPV;
a original é preservada. Validação PASOE continua pendente de consumidor integrado.

## Levantamento inicial, anterior à alteração

Diagnóstico por `COMPILE ... XREF ... LISTING ...` no OpenEdge 12.2 do servidor .42, conectado ao esquema real ems2med/espec do .111. As cinco variantes compilaram com `COMPILER:ERROR=no` e `ERROR-STATUS:ERROR=no`. Não foram executados os programas compilados nem publicada qualquer alteração.

Fonte analisado: `integration-src/saldo-pv/esbo/boSaldoPV.p`, SHA-256 `d5faa8e2b5d474d01afa3862cc7b4d0e02abd22abeb4e15332288bf4ef4785c0`.

| Variante somente para compilação | Índice de ems2med.item | WHOLE-INDEX nessa leitura |
|---|---|---|
| Consulta atual, filtros opcionais com OR e intervalo de grupo direto | grupo | Não |
| Mesma consulta, removendo OR somente dos quatro limites de item/família | codigo | Não |
| Predicado somente com intervalo direto de item | codigo | Não |
| Predicado somente com intervalo direto de família | fam-ge | Não |
| Predicado somente com intervalo direto de grupo | grupo | Não |

Na consulta atual, o compilador usa o intervalo do grupo para delimitar o acesso. Os filtros opcionais de item/família são avaliados como condições residuais, sem mudar esse caminho de acesso conforme os valores recebidos. Portanto, não há indicação de varredura do índice inteiro de item; uma pesquisa por item específico ainda pode examinar muitos candidatos do grupo.

A variante com todos os intervalos diretos escolheu codigo, mesmo mantendo o intervalo de grupo. Logo, substituir OR por limites amplos indiscriminadamente pode piorar consultas sem filtro de item. Um ajuste futuro deve escolher a consulta conforme os filtros efetivamente presentes e validar cada caminho, preservando os filtros de negócio.

Este teste identifica o plano estático, não mede tempo, quantidade de leituras ou plano dinâmico do PASOE. Não executou busca de saldos nem leu registros comerciais. Há outras ocorrências de WHOLE-INDEX no XREF, inclusive temp-tables, im-param e natur-oper; a conclusão acima se limita ao FOR EACH bItem da etapa selecionarItens.

Evidências privadas: `.runtime/bo-saldo-20261020/query-plan/`, arquivos `plans.log`, cinco `.xref`/`.listing` e `receipt.json`. Fontes das variantes são exclusivamente diagnósticos, sem defaults operacionais novos.
