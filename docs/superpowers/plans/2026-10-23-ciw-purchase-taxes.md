# Cálculo fiscal MED — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: superpowers:executing-plans, execução inline; uma revisão independente final.

**Goal:** comando fiscal dos processos MED com regras reutilizáveis e auditoria completa.

**Architecture:** adaptador fechado, coletor compartilhado de itens, aritmética fiscal comum com containers, planejador de dependências/persistência transacional e transporte/auditoria PHP existentes. Frontend JSON nativo.

**Tech Stack:** ABL12.2, PHP8.4/Symfony, ProcessEngine/Kendo existente.

**Spec:** docs/superpowers/specs/2026-10-23-ciw-purchase-taxes.md

## Global Constraints

Controles adiado à pendência final. Não reutilizar autorizações encerradas. Não alterar frontend/Kendo, schema, cadastros fiscais ou registros existentes. Publicação pertinente já autorizada pelo projeto; novo teste operacional/grant depende de consentimento específico. Preservar alterações canônicas existentes por baseline/hash e candidatos isolados; sem commit/push/reset.

## Review Focus

- Dependências múltiplas/diamante/ciclo, item tributável, arredondamento na persistência e percentual zero/ausente.
- MED/IDdecimal/contexto fechado, concorrência NO-WAIT e rollback após primeiro efeito, sem consumir ID em plano inválido.
- Ator/snapshots completos e vínculo calcId, eventos repetidos/forjados não viram logs confirmados.
- Consulta de logs agrega escritor fiscal registrado; não mistura itens/outros processos/tenants e não vira exclusão falsa.
- Nova aba abrir não executa; confirmação Cancelar não grava;194? não presumir contagem final de testes, obter dos resultados.

## Task1 — fonte/schema/baseline e RED

- [x] Inspecionar schema/configuração fiscal MED somente leitura e catálogo; registrar manifesto/baseline.
- [x] Testes TT novos: fórmula/dependências/null/ciclo/ambiguidade/MED/rollback/IDs/logs. Observar RED funcional oficial12.2.
- [x] Testes PHP novos de auditoria/processo/SQL; observar RED antes das alterações de produção.

## Task2 — núcleo reutilizável

- [x] Criar CiwTaxAmount.p puro; reaproveitar em ContainersImpostosService e no planejador fiscal.
- [x] Criar PurchaseItemAmounts.p, compartilhar coleta com PurchaseForecastTotals e impostos.
- [x] Extrair PurchaseExpenseInsert.i, usado por PurchaseExpensesService e PurchaseTaxesService; adaptar chamadas legadas com calcId0.
- [x] Criar PurchaseTaxesService/Api.p com buffers fixos/seqs; dispatcher fechado por calculate_taxes.
- [x] Rodar suíte nova e regressões pertinentes; testes de container quando alterar cálculo compartilhado.

## Task3 — auditoria/transporte/metadados

- [x] RuntimePurchaseTaxAudit.php reutiliza imagens existentes, valida pai+cálculo+efeitos e ator confiável.
- [x] Adaptar somente ponto de processo em RuntimeApiEntityActionService e predicado fechado de logs em RuntimeEntityActionService. Preservar geração/manutenção anteriores.
- [x] Metadados de ProcessEngine: operação fixa/contexto/sem parâmetros livres, dupla habilitação, confirmação, aba9 pai1.0.6; validar PHP/JS nativos.

## Task4 — integrar/publicar/validar

- [x] Compilar12.2 + testes4combinações e PHP completo; revisão independente final e correções necessárias.
- [x] Integrar porhash/backup, publicar artefatos pertinentes e refresh somenteMEDocioso. Validar leitura/regressões/negativos sem comando em registros existentes.
- [x] Publicar JSONs pelo Builder governado preservando94operações/8abas. Preparar consentimentos concretos para permissões e novo cenário isolado.
- [x] Após consentimento, executar somente cenário novo autorizado, comprovar logs/limpeza, UI e memória4projetos. Se consentimento não vier, manter gate fechado e estado explícito.

Arquivos candidatos em integration-src/purchase-taxes/{abl,tests,backend,metadata}; estado privado .runtime/purchase-taxes-20261023. Canônicos motor sursum-api/{programs,includes}/tests e construtor backend/src/Runtime,tests,integrations/ciw-purchase-taxes; draft pai em ciw-purchase-items. Revisar baseline antes de qualquer integração. Não reaplicar scripts de escopos antigos.

26/10: entrega concluída e cenário autorizado limpo; evidências em .runtime/purchase-taxes-20261023/completion-verification.json. UI direta/confirmaçãoCancelar/logs validados; nove abas conferidas por definição nativa. Sem validação visual específica da aba embutida nesta etapa.
