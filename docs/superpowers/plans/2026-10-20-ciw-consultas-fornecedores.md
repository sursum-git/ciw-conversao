# CIW — consultas de fornecedores

Continuação da conversão autorizada pelo usuário, com permissões ao final e Conta corrente fornecedor excluído.

Escopo: cons_fornecedor e cons_fornecedor_estrangeiro. Origem confirmada: perfil comum → comum_pro → ems2cad/.111. Preservar os predicados independentes identific=2 e cod-gr-forn=2; estrangeiro não recebe filtro adicional identific. Projetar código, nome abreviado e nome; estrangeiro também data-implant em ISO. Consulta NO-LOCK, sem escrita. Usar frontend oficial por metadados, filtros/ordenação locais existentes, sem alterações Kendo.

1. Serviço de leitura compartilhado com handle confiável do wrapper; operações read/get e contrato fechado. Testes TT para subconjuntos diferentes, ordem, detalhe fora do subconjunto, tipos inválidos, null/data/acentos e recusa de escrita/SQL.
2. Estender wrapper autenticado ciw-cadastros com dois recursos fixos; preservar todos anteriores. Compilar12.2/.42 e executar os testes em duas culturas.
3. Publicar somente serviço/wrapper p/r com guarda de hash, backup e validação PASOE sursum-api/med. Registrar duas telas somente leitura pelo Builder, sem concessões legadas.
4. Validar definições e runtime read/get/recusa de escrita. Revisão independente final; atualizar inventário e memória. Conferência visual será registrada separadamente.

Decisão: avançar estas consultas da fase2 enquanto as duas origens de cadastros da fase1 continuam sem schema confirmado. Custo se incorreto: ajustar prioridade; nenhuma origem foi inventada nem cadastro descartado.

## Resultado

Etapas1–4 concluídas:12.2/.42 semerros,27checks/cultura,4artefatosp/rpublicados,2telasBuilder,validacaoPASOE/runtimecontraDB,canonicos/inventario/memoriaatualizados. Revisaoindependente inicialsembloqueador;falhaaliasencontradanaintegracao,RED/GREENcorrigidoerepublicado. Visualpendente. Detalhesemdocs/ciw-fornecedores-validacao-2026-10-20.md.
