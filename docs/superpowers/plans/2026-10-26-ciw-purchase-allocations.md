# Alocações dos itens de compra Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Publicar a consulta contextual de alocações dos itens MED.

**Architecture:** Adaptador fixo e serviço por buffers compõem PurchaseItemContext e CiwErpReadService; metadados JSON nativos adicionam aba/link ao cadastro de itens. Manter regras e auditoria dos writers existentes.

**Tech Stack:** ABL12.2, PHP/Symfony existente, JSON e Kendo local.

**Spec:** docs/superpowers/specs/2026-10-26-ciw-purchase-allocations.md

## Global Constraints

- Instância sursum-api/med HTTPS9911; .42 compila, .137 recebe artefatos.
- Sem frontend paralelo, Kendo editado, schema, negócio escrito ou grants humanos nesta etapa.
- Controles pendência final; logs existentes preservados.

## Review Focus

- Item de outro processo/empresa não pode ser exposto.
- Contexto ausente/fracionário e tentativa de escrita devem falhar.
- Container ausente, referência duplicada e estado desconhecido não podem produzir dado incorreto.
- Paginação/filtros/get devem manter o escopo mesmo contra filtro contraditório.
- Publicar sem perder abas/operações ou mudanças concorrentes.

### Task1: Serviço e contrato

- [x] Baselines e teste TT RED de contexto/consulta/readonly.
- [x] Implementar PurchaseItemAllocationsService.p e adaptador PurchaseItemAllocationsApi.p, ampliar dispatcher/leitor compartilhados apenas no recurso fechado.
- [x] Compilar e rodar testes + regressões em4combinações oficiais.

### Task2: Metadados e integração

- [x] Inspecionar catálogo somente leitura, escolher código livre e snapshot completo.
- [x] Preparar/validar entidade read/get e item8abas (7preservadas), logs/writers inalterados.
- [x] Revisão final única independente; corrigir defeitos comprovados RED/GREEN.
- [x] Integrar canônicos por hashes/backups; publicar artefatos e validar PASOE real somente leitura.
- [x] Cadastrar fonte/entidade/telas por governança nativa preservando operações existentes.

### Task3: Verificação e memória

- [x] Validar consulta/contexto/runtime e navegação UI nativa; solicitar permissão humana específica após resultado revisável.
- [x] Aplicar somente a consulta autorizada após “siga”; verificar quatro sessões LDAP, lista/detalhe e a aba contextual. Gate consumido/false.
- [x] Atualizar inventário e4memórias com estado real e pendências.
