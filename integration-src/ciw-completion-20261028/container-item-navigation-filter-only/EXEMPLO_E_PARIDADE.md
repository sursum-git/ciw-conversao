# Exemplo nativo e paridade

`examples/ciw-container-itens-filter-only.json` é cópia byte exata da definição candidata1002 gerada pelo normalizeEntityPayload/validateExternalDraft reais. Usa os mesmos CrudEngine/renderers/normalizador/validator/schema que a produção; não contém catálogo de dados, cliente mock ou backend alternativo. É um exemplo de contrato, não uma tela publicada. A produção continuará carregando somente por screenId autorizado e endpointId, nunca por esse arquivo local.

| Superfície | Antes/sem flag | Com opt-in | Evidência local | Estado produção |
|---|---|---|---|---|
| Link da linha | Apenas pai/navegação não específica | Pai+PK validados no destino | buildRowLinkHtml e contextos reais | pendente root |
| Seleção da grade | Todos os itens do pai | PK exata fixa, mantida no clear/reset | withContextFilters/read datasource | pendente root |
| GET | Contexto integral | Pai somente; PK no id físico | fetchRecord+ApiRequestContext canônico | pendente root |
| Create/save/delete | Ações nativas atuais | Mesmas permissões/PK física; seletor sem default/contexto | defaults, save e delete reais com transporte sintético | sem negócio executado |
| Opções/download | Contexto da tela | Exclui apenas filterOnly ativo | callbacks reais e request traces sintéticos | pendente root |
| Batch | Snapshot/contexto atuais | Contexto externo só pai | saveBatch real, sem submissão comercial | snapshot protegido preservado |
| Export | take>=1000 existente | Mantém PK no filtro, sem contexto técnico | request real do exportador com HTTP sintético | limite200 ERP continua explícito |
| Logs/locks/navegação do form | Comportamento atual | Métodos sem alteração; registro físico preservado | comparação byte dos métodos e navegação de uma linha | sem novo cenário real |
| Processo | Contrato atual fechado | filterOnly recusado | AJV completo do1047 legado | inalterado |

Skill construtor-pg-demo-production-parity ausente após busca local, como já registrado no contexto do projeto. Checklist concreto da matriz canônica aplicado: nenhum arquivo demo canônico alterado; exemplo atualizado neste pacote; produção usa screenId/endpointId e não passa a carregar example/mock; patch documental separado, por baseline, permanece pendente de integração root.
