# Reconciliação — custos, versões, distribuição e simulação

Em 29/10/2026, a evidência privada já existente de `container-commands-20261016` foi relida sem reexecutar nenhum cenário operacional. Ela corrige a classificação histórica de “Preparado” para o bloco abaixo: a implementação, os metadados, a publicação e o cenário de teste autorizado já existiam.

| Origem Scriptcase | Cobertura convertida | Evidência já concluída | Estado de conversão |
| --- | --- | --- | --- |
| `form_versoes_item_custo_container` | Geração e consulta de versões, snapshots e logs | `response-generate-version.json`, serviços `ContainersVersionService` e `ContainersVersionRuntime` | Convertida tecnicamente |
| `bl_item_custos` | Coleta e cálculo reutilizáveis de custos por item | `ContainersItemCustoInputsService` + `ContainersItemCustoCalculator` | Convertida tecnicamente |
| `bl_item_custos_gravacao` | Fechamento transacional dos custos por item | `response-close-costs.json`: versão 2358, custo 6144, com auditoria Progress | Convertida tecnicamente |
| `contr_item_custos` | Processo de fechamento, com validação prévia e logs | metadado `ciw.container-fechar-custos` / op1016 e cenário autorizado | Convertida tecnicamente |
| `cons_itens_container_simul_calc` | Simulação sem escrita sobre o mesmo coletor/calculador | `ContainersItemCustoInputsService` e `ContainersItemCustoCalculator` | Convertida tecnicamente |
| `bl_distribuir_custo_contr` | Plano e distribuição centralizada pela empresa do container | `ContainersDistribuicaoService` + `ContainersDistribuicaoCalculator` | Convertida tecnicamente |
| `ctrl_simul_distr_custo` | Simulação de distribuição pelo mesmo núcleo do gravador | serviços de distribuição e processo publicado | Convertida tecnicamente |
| `form_despesas_container_multi_reg` | Manutenção rápida em lote, concorrência e logs antes/depois | cenário CIW-1042 concluído e limpo; op1042 | Convertida tecnicamente |

Não se deve reexecutar os cenários históricos: os recibos contêm guards de execução única e as limpezas já foram comprovadas. Esta reconciliação não afirma paridade visual de impressões/exportações legadas nem cobre anexos físicos ausentes. Ela também não move `Controles`, que permanece pendência final.
