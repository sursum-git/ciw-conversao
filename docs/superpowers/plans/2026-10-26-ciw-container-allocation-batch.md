# Alocação em lote de itens — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL superpowers:executing-plans, inline; uma revisão final fresca.

**Goal:** Seleção múltipla e alocação atômica reutilizando manutenção/fiscal/financeiro e logs.
**Architecture:** parâmetro coleção nativa/options cadastradas; adaptadorfixo, planejador/saldo/serviço raiz envolvendo singleCRUDnested, fold de efeitos e auditoria PHP fechada.
**Tech Stack:** ABL12.2/PHP8.4/ProcessEngine-Kendo existente.
**Spec:** docs/superpowers/specs/2026-10-26-ciw-container-allocation-batch.md

## Global Constraints

Até25itens/lote. Contexto container_id obrigatório. Quantidade calculada no servidor, par existente ignorado/relatado, novo semsaldo aborta tudo. Não restringir fornecedor/empresa por suposição. Controles pendênciafinal. SemDDL/Kendolib/frontendparalelo/reset/commits. Preservardirty porbaseline. Novos grants/teste somente após consentimento específico. SingleAPI existente preservada.

## Review Focus

- Rollback após segundo item ou após fiscal/financeiro; nenhum evento confirmado de nested.
- Lockordering, saldo de todos containers/duplicidades, plano inválido antes deIDs epar existente.
- Fold continuidade before/after e criação/atualização/exclusão do mesmo filho semefeitos órfãos.
- Coleções estritas/optionread contexto/rotas/limite, XSS, carregamento/out-of-order não habilita escrita.
- Ator confiável/committed/root e efeitos apenas selecionados, logs tenant/registro semvazamento eação exclusão sem falsosdeletes.

## Task1 — coleções/opções ProcessEngine nativas

- [x] RED PHP coleção autorizada vs JSON livre/IDs inválidos e geração dos endpoints/options nativos.
- [x] RED JS MultiSelect/leitura/validação, loadingfail/Cancel semenvio/contexto; implementar reutilizando APIs existentes, semtemplates.
- [x] GREEN regressões PHP/JS apropriadas e ledger.

## Task2 — alocação/efeitos ABL reutilizáveis

- [x] RED12.2 TT saldo/fold/atomicidade/singlecontract/rollback/25limite e planosantesdeIDs.
- [x] Extrair ContainersAllocationBalance.p e wrappers existentes em ContainerTransactionAudit.i; compor ContainersItensBatchService.p sobre singleCRUDnested.
- [x] Adaptador/options fixos, semduplicar fórmula, compilar4combinações e regressões pertinentes.

## Task3 — auditoria/metadados

- [x] RED closedprofile processo/sessão/IDs/compromisso/forgery e SQLlogs; implementar e GREEN.
- [x] JSON nativo de comando, fonte/opções/optins e link/aba no painel preservando tudoexistente; validarPHP/JS.

## Task4 — integração/implantação

- [x] Suítes completas e revisão final; integrar porhash/backup, publicar somente artefatos12.2, refreshMEDocioso.
- [x] Builder governado/endpointlink e leituras/negativos reais semoperação válida emexistentes.
- [x] Consentimentos concretos novaspermissões/cenário; se autorizado executar somente novosrecords/teste/limpeza/logs/UI.
- [x] Memórias4projetos/inventário/recibos/limites atualizados, gates encerrados eControlesfinal.

Estado final: COMPLETED_CLEANED. Duas permissões específicas aplicadas; cenário autorizado executado pela sessão LDAP, tx30058/30060; limpeza física independente confirmada e logs preservados. Gates consumidos/false; Controles continua pendência final.
