# Associação de NFs do container Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Expor associação e desassociação atômica de NFs do container no motor Progress e no construtor.

**Architecture:** Um writer ABL novo opera somente `nfs_container`; o router de processos do container o chama com contexto autenticado. A consulta financeira atual é reaproveitada sem cópia de projeção ou filtros.

**Tech Stack:** OpenEdge ABL 12.2, PASOE `sursum-api/MED`, PHP do construtor e metadados JSON existentes.

**Spec:** `docs/superpowers/specs/2026-10-29-associacao-nfs-container-design.md`

## Global Constraints

- Compilar em OpenEdge 12.2 no `.42` e publicar somente em `sursum-api/MED`/9911.
- Manter chave completa de NF e logs de ator/imagens antes/depois.
- Não executar escrita operacional sem novo cenário de teste autorizado e limpeza canônica.
- Não duplicar a leitura financeira, fórmulas de custo ou regras de distribuição.

## Review Focus

- Associação duplicada deve falhar sem criar vínculo parcial.
- Desassociação com natureza/emitente divergentes deve falhar sem apagar outro vínculo.
- Stamp obsoleto deve gerar conflito sem alteração.
- Uma chave inválida no lote deve desfazer todo o lote.
- O ator de auditoria deve vir do contexto confiável, não do JSON do cliente.

---

### Task 1: Writer transacional de vínculos

**Files:**
- Create: `D:/opencode/motor-progress/v2/sursum-api/programs/ContainersNfsLinkService.p`
- Test: `D:/opencode/motor-progress/v2/tests/abl/containers-nfs-link/RunContainersNfsLinkTests.p`

- [ ] Escrever testes RED para associação, duplicidade, chave completa e rollback de lote.
- [ ] Compilar os testes no OpenEdge 12.2 e confirmar falha pela ausência do writer.
- [ ] Implementar o writer com buffers fixos, transação raiz, locks e snapshots.
- [ ] Recompilar e confirmar os testes verdes.

### Task 2: Roteamento e auditoria

**Files:**
- Modify: `D:/opencode/motor-progress/v2/sursum-api/programs/ContainersProcessos.p`
- Modify: `D:/opencode/motor-progress/v2/sursum-api/programs/ContainersProcessosService.p`
- Test: `D:/opencode/motor-progress/v2/tests/abl/containers-nfs-link/RunContainersNfsLinkTests.p`

- [ ] Escrever teste RED para operação fechada, ator confiável e propagação de snapshots.
- [ ] Integrar o writer como operação explícita de processos, preservando comandos existentes.
- [ ] Executar a suíte ABL e regressões do router.

### Task 3: Contrato do construtor e publicação

**Files:**
- Create: metadados de processo no diretório de integração CIW
- Modify: fonte API e pai do painel somente após preview integral

- [ ] Criar teste/preview RED de contrato para payload, confirmação e logs.
- [ ] Registrar a operação, publicar o metadado com locks/governança e validar leitura.
- [ ] Compilar 12.2, publicar no PASOE MED e testar recusas somente leitura.

### Task 4: Cenário operacional autorizado

- [ ] Solicitar autorização de um container e NFs novos, separados dos cenários concluídos.
- [ ] Executar associação, duplicidade, desassociação e conflito; conferir logs.
- [ ] Limpar somente os registros próprios por manifesto e preservar os logs.
