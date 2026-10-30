# Purchase import quantities Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans inline, task-by-task. Uma revisão final independente.

**Goal:** Publicar a consulta MED de quantidades importadas, global e contextual, com regras reutilizáveis e navegação/auditoria existentes.

**Architecture:** API fixa→coletor readonly→avaliador puro único, leitor existente para filtros/chaves/páginas. JSON adiciona uma aba preservando as dez anteriores.

**Tech Stack:** ABL12.2, PHP/Builder nativo, JSON/Kendo existentes.

**Spec:** docs/superpowers/specs/2026-10-27-ciw-purchase-quantities.md

## Global Constraints

- MED explícita; read/get; sem SQL externo/cache/DDL/escrita operacional implícita.
- Preservar CASE com precedência e LEFT JOIN/orfandade; compra/preço nulos não viramzero.
- Compilar .42/12.2, publicar137via111, validar somente sursum-api/med9911.
- Frontend por metadados; preservar logs/writers/metadados existentes. Controlesfinal; union separado.

## Review Focus

- Física e confirmada ambas maiores que compra: física ganha mesmo menor que confirmada.
- Semalocação/múltiplas/orfandade/situações/nulos; não prometer rateio ou agregados deduplicados.
- Contexto opcional não permite fugir de MED nem recuperar chave de outro processo quando restrito.
- Dezabas/Logs/105operações anteriores preservadas; nenhuma mutação escondida.

### Task1 — Contrato e regra compartilhada

- [x] Preservar baselines/ledger e conferir fontes/schema relevantes.
- [x] TestesTT RED→GREEN do avaliador/coletor e regressões do leitor.
- [x] Implementar API/coletor/avaliador e ramos fixos do leitor/dispatcher.
- [x] Compilar12.2 e testar quatro combinações, inspecionando logs completos.

### Task2 — Metadados/publicação

- [x] Preparar op1028 e pai1.0.8/onzeabas, previewsPHP/JS e suítePHP pertinente.
- [x] Revisão final independente, integração porhash/backup e publicação p/r oficiais.
- [x] Validar PASOE read/get/global/contexto/negativas e publicar metadados nativos105→107.

### Task3 — Acesso/interface/memória

- [x] Conferir runtime nativo/Logs e solicitar exatamente duas reads novas após publicação concreta.
- [x] Aplicar somente as duas consultas autorizadas, validar UI e fechar abas temporárias.
- [x] Atualizar quatro memórias e inventário; base publicada, union separado e Controlesfinal.

Estado27/10: COMPLETED_READONLY. Duas leituras autorizadas pela resposta humana call_6d07d6bfc8cd4ad9881727e7711fba2f e aplicadas somente para tadeu.parreiras; quatro sessões LDAP/integridade/demais acessos conferidos, gate consumido. UI geral/contextual/detalhe/aba/links validada; abas usuário1/2 preservadas e agente23 encerrada. Correção adicional de transporte PHP registra as duas entidades no leitor tipado e valida contexto das linhas: paginação/filtro/sort reproduzidos RED e aprovados depois contra PASOE; revisão semP1/P2, PHP882/5821. Quatorze canônicos finais porhash/backup. Metadados e ABL não republicados durante correção. Quatro memórias/inventário atualizados. Não repetir concessões/publicadores/compilação. Union permanece separado; Controles pendência final.
