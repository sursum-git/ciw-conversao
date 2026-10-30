# Auditoria dos filtros da consulta de estoque — 21/10/2026

Foram concluídas 56 consultas da lista, 9 consultas detalhadas e 2 validações
do formulário (67 verificações, incluindo a repetição de uma evidência).
Todos os campos visíveis do formulário foram exercitados. **A comparação real
com a BO foi concluída após o usuário restabelecer o acesso:** probe compilado
sem erro em OpenEdge 12.2/.42, execução NO-LOCK nos bancos reais .111, 67 retornos
conferidos. O hash do `.r` executado corresponde ao recibo publicado no `.137`.
As falhas de conexão da primeira tentativa permanecem como histórico.

| Grupo | Comparados | Iguais | Diferentes |
|---|---:|---:|---:|
| Lista, entradas válidas | 54 | 47 | 7 |
| Detalhe por referência | 9 | 9 | 0 |
| Validações de entrada | 4 | 0 | 4 |
| Total | 67 | 56 | 11 |

Os 56 registros da lista incluem dois intervalos invertidos, classificados na
linha de validações, somados às duas rejeições do formulário. A contagem inclui
repetições para evidência e para passagem ao detalhe; não representa 67
combinações distintas. A igualdade anterior de 14+4 cenários era válida para
aquela amostra, mas não cobria as divergências abaixo. Os 105 checks por cultura
anteriores também não provavam paridade completa com a página.

Contexto: login da página informado pelo usuário como `tasilpar`, sem identidade
visível na página; BO executada com login tasilpar/tipo 4/representante 0.
Empresa 5, itens 175182/400288 e conjunto CAMBRAIA. As consultas da página
geram protocolos de pesquisa; não foram alterados pedidos ou outros dados
comerciais. A BO e a publicação no `.137` não foram modificadas nesta auditoria.

A leitura posterior dos programas identificou as causas exatas: ver
[diagnóstico PHP versus Progress](boSaldoPV-causas-divergencias-2026-10-21.md).
O controlador força PE quando Oportunidade=Sim; a grade complementa saldos
conforme a existência dos arrays filtrados, com buscas que omitem os filtros
originais. Esses indicadores são globais ao conjunto e não são os checkboxes.

**Escopo definido posteriormente pelo usuário:** normalizar oportunidade e
tratar as validações de entrada é responsabilidade do cliente chamador, não da
BO. Portanto, as duas ocorrências de oportunidade e as quatro diferenças de
validação continuam na contagem histórica, mas não são defeitos a corrigir na
BO. Permanecem cinco ocorrências de saldo/apresentação no escopo da BO, incluindo
repetições. Ver a decisão registrada no diagnóstico de causas.

**Decisão final do usuário:** o complemento de saldo sem os filtros originais
foi considerado provável erro do PHP e deve ser desconsiderado, inclusive no
caso combinado com mínimo. As cinco ocorrências acima deixaram de ser pendências
de correção. Assim, as diferenças da matriz são aceitas pelo escopo definido;
os números da comparação permanecem inalterados, sem alegar igualdade literal.
Nenhuma modificação de produto foi necessária ou executada.

## Cobertura dos campos

| Campo / controle | Verificação realizada na página | Relação com a BO / estado |
|---|---|---|
| Item | Código 175182; CAMBRAIA (4 itens); BRANCO CAMBRAIA (1); lista de códigos; `_` e `%` | `pesquisaItem`. A UI removeu vírgula e `_` antes do envio; usar os valores capturados, não o texto pretendido, na comparação. |
| Referência | Vazio; A01; A01,A02; inexistente; combinação com PE/PI | `selecaoReferenciasAtiva` e seleção REF. Diferença na origem não selecionada, descrita abaixo. |
| Estabelecimento | ES; SC; ambos; nenhum marcado | ES retorna 175182, SC não. Nenhum marcado ainda retorna saldos. Para representar ausência de filtro, usar `selecaoEstabsAtiva=NO`; lista ativa vazia na BO significa nenhum. |
| Tabela de preço | Padrão, Rubi e Safira isoladas; vazio; Padrão+Rubi, Rubi+Safira e Padrão+Safira | Seleção isolada corresponde a `filtroTabelaPreco`/`tabelaPrecoFiltro`. Em CAMBRAIA, Safira isolada retorna 2 itens; Rubi, seleções combinadas ou vazia retornam 4. Não transformar múltiplas seleções em interseção automática de preços. Valores de preços não foram comparados. |
| Opções de saldo | PE+PI; PE; PI; nenhuma | A lista mostra os dois totais nas três opções válidas. Sem origem, a página impede envio; a BO retorna vazio (diferença de validação). |
| Unidade | Vazio, M, KG, UN | 175182 passa em M, falha em KG/UN; 400288 passa em KG. `unidade` na BO; nenhum item UN positivo foi selecionado nesta amostra. |
| Mínimo KG | 0 e 20 no 400288 | Tipo 4 mantém 19,60 na lista; detalhe com mínimo 20 fica vazio. `minimoKG` e `consultaReferencias`. |
| Mínimo MT | 0, 2, 50, 51, 7000, 11200, 11201, 20000 | Lista tipo 4 mantém o item. Detalhe filtra cada linha, inclusive tipo 4. Valores enviados registrados com a máscara. |
| Gramatura inicial/final | 100..100; 100,01..999; 0..99; 101..99 | Igualdade 100 mantém; fora do intervalo exclui; invertido retorna vazio na página, mas a BO rejeita. |
| Peso líquido inicial/final | 0,10000..1; 0,10001..100; 0..0; 2..1 | Primeiro mantém, dois seguintes excluem. A UI converteu tentativa de final `0.1` para `1`; não foi teste de igualdade no final 0,1. Intervalo invertido retorna vazio na página e erro na BO. |
| Oportunidade de estoque | Não/Sim; PE; PE+PI; PI; CAMBRAIA | Em Sim, 175182 foi excluído e CAMBRAIA ficou com 175100/175181/175183. A execução BO manteve 175182 via PI. Sim+somente PI é rejeitado na página e aceito na BO. |
| Exibe miniatura | Não/Sim | Não mudou itens/saldos da lista. É opção de apresentação/book; renderização do book não foi testada. |
| Ordenação do book | Crescente/Decrescente | Não mudou itens/saldos da lista. Ordem do documento gerado não foi validada. |
| Combinação | CAMBRAIA + A01 + ES + M + mínimo 2 + gramatura 100 + peso mínimo 0,1 + Rubi | Página retorna 175182, PE 50 e PI 11200. A BO retorna o mesmo item e PI, mas PE=-1. |

`clube_ima` estava oculto e não foi manipulado. “Recuperar Última Alocação” é
uma ação de fluxo, não filtro; não foi acionada. Gerar Book, cartelas, ficha,
Excel e configurações de colunas/quebras não foram tratados como testes de
saldo. Não afirmar validação dos documentos gerados.

## Diferenças confirmadas na execução real

1. **Referência na origem não selecionada.** Para 175182/A01, somente PE mostra
   PE=-1 e PI=18200 na página; somente PI mostra PE=50 e PI=11200.
   A seleção REF é aplicada no código da BO tanto à coleta PE quanto à PI
   (`boSaldoPV.p`, chamadas de `referenciaPermitida` em ambas), inclusive quando
   a segunda origem é coletada apenas para exibição. Portanto há diferença de
   regra confirmada: somente PE retornou PE=-1 e PI=11200 na BO; somente PI
   retornou PE=-1 e PI=11200 na BO. A página não restringe REF na origem não
   selecionada. O mesmo desvio apareceu nas repetições `det_ref_pe` (lista antes
   de abrir o detalhe) e `evidencia_ref_pe_final`.
2. **Validação de origens.** A página exige ao menos PE ou PI e exige PE quando
   Oportunidade=Sim. O validador da BO não impõe essas duas condições. Isso deve
   ser traduzido pelo chamador ou receber regra explicitamente definida.
3. **Intervalos invertidos.** Página retorna consulta vazia; BO retorna erro
   “Faixa de propriedades invertida”. São respostas diferentes a entrada inválida;
   não é evidência de erro no cálculo de saldo.
4. **Oportunidade + PI.** A página excluiu 175182 mesmo com PE+PI selecionados.
   Na BO, `carregarLiquidacao` restringe PE, enquanto o laço PI não aplica essa
   lista. A execução real confirmou a incompatibilidade: BO manteve 175182,
   com PE=0 e PI=18200; em CAMBRAIA retornou 4 itens, incluindo 175182, enquanto
   a página retornou 3. Antes de corrigir, revisar a regra completa do controlador
   PHP, não somente o helper de liquidação.
5. **Máscaras e defaults.** Não enviar à BO o texto anterior à máscara como se
   fosse o filtro usado no PHP. Lista de códigos virou `175182400288`; tentativa
   `CAMBR_IA BRAN%` virou `CAMBRIA BRAN%`. Fins de gramatura e peso têm máscara
   diferente dos inícios; `0.1` no peso final virou `1`.
6. **Referência combinada com mínimo/propriedades/preço.** O caso `combinado`
   retornou PE=50 na página e PE=-1 na BO; ambos retornaram PI=11200. Trata-se
   de uma diferença adicional da apresentação do saldo da lista quando uma
   origem não conserva saldo qualificado. Não alterar o cálculo por referência
   para corrigir essa apresentação sem uma regressão específica.

As sete ocorrências de diferença na lista foram `oportunidade`, `combinado`,
`ref_so_pe`, `ref_so_pi`, `oportunidade_cambraia`, `det_ref_pe` e
`evidencia_ref_pe_final`. As quatro diferenças de validação foram as faixas
invertidas de gramatura/peso, oportunidade com somente PI e ausência de origem.
Nos intervalos invertidos, o probe confirmou sinalização de erro pela BO;
`ERROR-STATUS:NUM-MESSAGES` veio vazio. Não inventar mensagem retornada nesta
execução: o texto do erro está no fonte, não foi capturado como mensagem aqui.

## Detalhe: resultados observados

Item 175182; PI no container 1654. Números abaixo são saldos disponíveis.

| Opção / mínimo MT | Linhas retornadas |
|---|---|
| PE+PI / 0 | PE LED=50, A01=-1, A02=1; PI A01=11200, A02=7000 |
| PE+PI / 2 | PE LED=50; PI A01=11200, A02=7000 |
| PE+PI / 50 | PE LED=50; PI A01=11200, A02=7000 |
| PE+PI / 51 | PI A01=11200, A02=7000 |
| PI / 7000 | PI A01=11200, A02=7000 |
| PI / 11200 | PI A01=11200 |
| PI / 11201 | Nenhuma linha |
| PE / 0, REF A01 na lista | PE LED=50, A01=-1, A02=1 (REF descartada pelo link) |
| Item400288, KG / 20 | Nenhuma linha (lista mantém PE=19,60 para tipo4) |

Os nove casos foram repetidos na BO e coincidiram em origem, referência,
container, multiplicidade de linhas e quantidade disponível. Ao reproduzir o link,
remover a seleção REF herdada da lista. Seleções REF explícitas em chamadas
diretas continuam sendo uma capacidade da BO.

## Evidências e retomada

Pasta privada `.runtime/bo-saldo-20261021-auditoria/`:

- `web-cases.json`: 56 consultas completas, parâmetros finais do formulário e resultados.
- `web-details.json`: 9 consultas detalhadas, linhas e texto visível.
- `web-invalid-inputs.json`: 2 validações de formulário com parâmetros.
- `referencia-apenas-pe.jpg`: evidência da referência A01 com PI total não filtrado.
- `bo-input-cases.json`: matriz preparada com 67 casos, incluindo detalhe e validações.
- `build-probe.py` e `run-bo-batch1.py`: probe somente leitura para executar no `.42`.
- `bo-batch1/bo-resultados.json`: 67 retornos reais da BO; `compile.log` confirma 12.2/error=no.
- `bo-batch1/receipt.json`: hash do `.r`, etapa remota, 67 casos e ausência de writes de negócio.
- `comparison.json` e `compare-results.py`: comparação reproduzível com resumo e diferenças.

O probe isola erros por caso para não perder resultados após um intervalo
inválido. Múltiplas tabelas são traduzidas como ausência de filtro de tabela;
seleção única usa a tabela escolhida. Seleção de estabelecimento vazia é traduzida
como ausência de filtro explícito, preservando locais padrão. Esses mapeamentos
precisam constar na análise final, pois enviar uma seleção ativa vazia muda a regra.

**Estado final:** auditoria concluída com divergências, sem correções ou nova
publicação de produto. Para compatibilização posterior, usar estas ocorrências
como regressões e preservar os nove detalhes já coincidentes. PASOE permanece
sem consumidor integrado; não houve teste PASOE nesta rodada. Faixas de
família/item, grupos, locais, containers e estados
web não expostos nesta página têm cobertura sintética anterior; não foram
comparados com UI inexistente nem com todos os seus valores possíveis.
