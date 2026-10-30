# Alocações dos itens de compra — MED

Converter `cons_itens_compra_alocado`, alcançada pelo campo Qt.Alocada em `grid_itens_proc_compra`. Consultar apenas as alocações do item do processo MED posicionado. Exibir identidade da alocação, container, quantidade, situação ERP e acompanhamento. Navegação contextual pelo item e acesso ao painel do container, sem criar outro frontend.

Usar entidade API somente leitura, contexto obrigatório `proc_compra_id` e `item_proc_compra_id`, checagens compartilhadas `PurchaseItemContext.i`, projeção por buffers fixos e paginação/filtro/ordenação pelo `CiwErpReadService`. Não recalcular nem persistir dados ao abrir. Manter writers e logs existentes (ator autenticado, imagens completas antes/depois); consulta não deve inventar transação.

Contrato fechado read/get; PK técnica `item_container_id`; nada de banco/tabela/SQL/empresa escolhidos pelo cliente. IDs estritos; dono validado antes da projeção; leitura NO-LOCK limitada. Sem DDL, concessão humana de acesso ou teste operacional de escrita nesta etapa. Compilar .42/OE12.2, publicar .137 via .111, validar sursum-api/med/9911. Controles continua como pendência final.

Decisão de implementação: projeto já define frontend/metadados/ABL/reutilização/auditoria; pedido reiterado de continuar autoriza este recorte contextual. Candidatos isolados neste workspace e baselines/hash/backups preservam os checkouts canônicos com alterações prévias.
