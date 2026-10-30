# Cálculo unitário final de item — fonte e contrato

Inventário16/10/2026, sem execução de PHP ou escrita. O cálculo será uma rotina pura reutilizável em simulação e fechamento; versões continuam rotina separada. Não se copiam fórmulas fiscais, de câmbio ou de custo geral para cada programa consumidor.

Fontes efetivamente chamadas:

- `cons_itens_container_simul_calc/cons_itens_container_simul_calc_grid.class.php:4011–4030`: chama calcularNovoCustoItem por linha e incrementa qt_erros de sessão. O contador da página não é gate confiável de todos os itens.
- Mesmo grid`:13301–13504`: corpo do cálculo unitário. O nome no PHP é calcularNovoCustoItem; a linha13301 de index.php é outra função.
- `bl_item_custos_gravacao/index.php:4929–5002`: verifica contador de sessão, recalcula cada item, mas transforma retorno ausente/campos vazios em0 e grava. A nova rotina precisa devolver erro estruturado e o writer deve recusar o conjunto inteiro antes de persistir.
- Writer`:8582–8788`: cópia da mesma matemática; nova simulação e fechamento devem chamar somente `ContainersItemCustoCalculator.p`.
- Writer`:8790–8847`: INSERT item_custos com tipo2/situação2, novo unitário, saldo ajustado, quantidade NF/etiquetas, anterior, unitário do container e quantidade container; depois associa item_container_custos ao custo criado. Sequência/autoria/data/escrita pertencem ao serviço transacional, não ao núcleo puro.

## Leituras necessárias e semântica

Referências abaixo em `cons_itens_container_simul_calc/index.php`, que contém as funções auxiliares replicadas usadas pelo corpo acima.

| Entrada | Fonte | Regra comprovada |
|---|---|---|
| Item ERP | 12971aprox. | código ERP do item do pedido associado; vazio gera erro |
| Custo anterior | 12938–12969 | maior ID entre custo tipo2 ligado a outro container e custo não tipo2; ordenação descendente resolve candidatos, não reusa custo do próprio container |
| Snapshot de custo | 17293–17310 | max versao_id do container e item_container_id exato; valores unitários previsto/realizado e quantidades são dessa versão |
| Desatualização | corpo de cálculo | flag do mestre; true ou contexto ausente gera erro |
| NF mãe | 17708–17717 | vínculo em nfs_container cuja natureza começa por3; regra difere da lista de naturezas usada no cálculo geral |
| Data NF mãe | 17719–17745 | nota-fiscal ERP correspondente a estabelecimento/documento/série; sem mãe usa data sentinela2001-01-01. Ausência de nota ERP apesar do vínculo não deve ser disfarçada de ausência de conexão |
| Movimento anterior | 10352–10364 | somente MED.movto-estoq, dt-trans estritamente menor que data de referência; qualquer registro confirma movimento anterior |
| Saldo anterior | 10366–10387 | MED antes da data, soma quantidade tipo-trans1; subtrai todos os demais tipos |
| Estoque atual | 10320–10350 | soma IMA estabelecimento1 + MED filtrado pelos locais de estoque configurados para empresa5; sem filtro configurado o PHP monta filtro vazio, não inventar local |
| Etiquetas | 9818–9831 | ob-etiqueta do item, situação3/4, quantidade diferente de0; agrupa container/item/situação/estabelecimento |
| Análise etiquetas | 9833–9866 | soma etiquetas do container e de outros; diferença=estoqueIMA+MED−etiquetasContainer−etiquetasOutros |
| Tipos que exigem NF | 15812–15821 | parâmetro tipo_versao_valida_nf, default explícito4,5; consulta IMA por include direto sem cache |

Se existem vários vínculos de mãe com datas diferentes, o PHP escolhe primeira linha sem ordenação. Essa ambiguidade não determina uma data financeira em silêncio; contrato puro deve recusá-la. Datas iguais são equivalentes para o cálculo, preservando aviso de múltiplos vínculos. Pertinência ao tipo de versão precisa ser exata, corrigindo o defeito strpos que perde posição0 e aceita substrings.

## Fórmula comprovada

`estoqueBruto=ima+med`. Com NF mãe: `etiquetasContainer=Σquantidade das situações3/4 do container`, `etiquetasOutros=Σdemais`, `diferença=estoqueBruto−etiquetasContainer−etiquetasOutros`; `estoqueAjustado=max(estoqueBruto−etiquetasContainer,0)`. Sem mãe, três quantidades de análise são0 e o estoque bruto não sofre essa subtração/clamp.

`quantidadeContainer = qt_confirm_emb` quando diferente de0, senão qt_alocada. `quantidadeNotaMae=qt_confirm_emb` quando diferente de0, senão0. Qt recebida física é carregada do snapshot, mas não entra na fórmula final; não trocar a base por ela.

`unitárioContainer=previsto` se priorizar previsto ou realizado não liberado; caso contrário, realizado quando diferente de0, com fallback explícito para previsto quando realizado0. `valorContainer=quantidadeContainer×unitárioContainer`; `valorEstoque=estoqueAjustado×unitárioAnterior`; `valorTotal=valorContainer+valorEstoque`; `quantidadePonderada=quantidadeContainer+estoqueAjustado`.

Quando total>0 e quantidadePonderada>0, unitárioNovo=ROUND(total/quantidadePonderada,2). O ramo else do PHP devolve0, a ser distinguido de ausência/erro e decidido no contrato de validação. Quando não existe movimento MED anterior, o resultado é substituído diretamente pelo unitárioContainer, **sem** ROUND2 nesse ramo. A rotina deve preservar essa precisão, evitando arredondar todo resultado indiscriminadamente.

Custo anterior ausente gera erro no PHP somente se há movimento anterior e saldo anterior>0. Ausência comprovada fora dessa condição usa unitárioAnterior0/origemID0, como ramo explícito, e precisa ficar registrada na memória. Não tratar falha de leitura/ERP desconectado como ausência de registro.

## Entrada pura proposta

Um JsonObject confirmado com container_id, política interna booleana de liberação/prioridade e lista tipada de tipos de versão que exigem NF; cabeçalho de versão com IDs e stale; lista de vínculos NF/datas confirmadas; todos os itens com IDs/códigoERP, custo anterior opcional confirmado, snapshot de custo da versão, estoque IMA/MED numérico, movimentos MED com data/tipo/quantidade e etiquetas com container/situação/quantidade.

O núcleo não consulta DB, HTTP, sessão nem parâmetros. O coletor central prepara e confirma os inputs completos e distingue ausência legítima de erro/conexão indisponível. O núcleo valida cada item e agrega todos os erros; qualquer erro bloqueia saída gravável de todo o conjunto. Writers não aceitam qt_erros de sessão nem resultados parciais com0. Precisam reler/validar o conjunto real do container sob seu protocolo transacional.

Contrato final e testes serão registrados em `ContainersItemCustoCalculator.md` depois da confirmação da integração. A criação/fechamento de versão usa serviço separado; a única rotina do custo unitário é compartilhada pelos consumidores.
