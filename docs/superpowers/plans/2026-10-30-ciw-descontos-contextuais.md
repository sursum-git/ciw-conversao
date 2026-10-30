# Descontos contextuais CIW Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Publicar o CRUD contextual de descontos por item de container e reconciliar a aplicação legada de pagamentos já absorvida.

**Architecture:** Um novo `ImportDiscountsCrudService` será a única fronteira de escrita de `descontos_importacao`. A leitura de saldos e lançamentos continuará em `ImportDiscountsCollector`/`ImportDiscountsReadService`; o frontend será uma definição JSON do construtor.

**Tech Stack:** OpenEdge ABL 12.2, PASOE `sursum-api/med`, PHP/Symfony do construtor e metadados JSON.

**Spec:** `docs/superpowers/specs/2026-10-30-ciw-descontos-contextuais-design.md`

## Global Constraints

- Nunca alterar registros existentes durante testes; usar somente registros novos marcados e removê-los ao final.
- Compilar em OpenEdge 12.2 no `.42`, publicar somente em `sursum-api/med` e validar no PASOE real.
- Não alterar bibliotecas Kendo nem criar frontend paralelo.
- Reutilizar o leitor/coletor de descontos existente; não duplicar cálculos de saldo, custo ou distribuição.

## Review Focus

- Contexto ausente ou alterado deve ser recusado antes de qualquer escrita.
- Desconto com lançamentos ou referências de custo não pode ser excluído.
- Concorrência deve recusar imagem desatualizada sem registrar auditoria parcial.
- Atores e imagens antes/depois retornados pelo Progress devem coincidir com a sessão autenticada.
- A reconciliação de pagamentos não deve conceder permissão ou duplicar uma tela.

---

### Task 1: Reconciliar pagamentos associados ao pedido

**Files:**
- Modify: `integration-src/ciw-inventory/menu-scope/menu-scope.json`
- Modify: `integration-src/ciw-inventory/menu-scope/MENU_E_CHAMADAS.md`
- Test: `tools/construtor-local/build-ciw-menu-scope.py`

- [ ] Escrever teste/checagem que compare os campos e predicados de `cons_tit_ap_associados_pedido` com `PurchasePaymentsService.p`.
- [ ] Executar a checagem em estado RED contra o status legado pendente.
- [ ] Atualizar a fonte de classificação do inventário para apontar `ciw.proc-compra-pagamentos` como equivalente absorvente, sem alterar permissões.
- [ ] Regenerar o escopo e conferir que somente essa origem muda de estado.

### Task 2: Contrato e testes ABL do writer contextual

**Files:**
- Create: `D:/opencode/motor-progress/v2/sursum-api/programs/ImportDiscountsCrudService.p`
- Create: `D:/opencode/motor-progress/v2/sursum-api/programs/ImportDiscountsCrudApi.p`
- Modify: `D:/opencode/motor-progress/v2/sursum-api/programs/CiwCadastrosCrud.p`
- Test: `D:/opencode/motor-progress/v2/tests/abl/import-discounts/ImportDiscountsCrudTest.p`

- [ ] Escrever testes RED para create/update/delete, contexto, bloqueio de dependência, concorrência e rollback.
- [ ] Executar os testes e confirmar falha pela ausência do serviço.
- [ ] Implementar o writer com locks, imagens auditáveis e reaproveitamento do coletor de leitura.
- [ ] Executar testes ABL e regressões de leitura de descontos.

### Task 3: Metadata, auditoria e publicação

**Files:**
- Create: `integration-src/import-discounts-contextual/metadata/import-descontos-contextual-builder-draft.json`
- Modify: `D:/opencode/construtor-pg/backend/src/Runtime/ScreenDefinitionService.php`
- Test: testes PHP de contrato/auditoria e preview do Builder.

- [ ] Escrever testes RED de contexto obrigatório, permissões e imagens de auditoria.
- [ ] Implementar o metadata JSON e o adaptador de auditoria restrito à nova entidade.
- [ ] Publicar o metadata após preview integral e conceder apenas permissões explicitamente autorizadas.
- [ ] Compilar/publicar/validar no PASOE e executar cenário novo com limpeza por manifesto.
