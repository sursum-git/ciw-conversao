# Purchase quantity periods Implementation Plan

> Execução inline com superpowers:executing-plans; revisão independente final.

**Goal:** Publicar cons_item_qt_imp_union MED preservando regra assimétrica aprovada e UNION.

**Architecture:** coletor único compartilhado → projeção/períodos separados → leitor existente; PHP transporte fechado, frontend JSON existente.

**Tech Stack:** ABL12.2/PASOE MED, PHP/Kendo existentes.

**Spec:** docs/superpowers/specs/2026-10-28-ciw-purchase-quantity-periods.md

- [x] TDD: regras de período, filtros, UNION e regressão base com TT sem DB.
- [x] Extrair coletor/esquema sem duplicar cálculo e implementar adaptadores/projeção/rota fixa.
- [x] Compilar e testar12.2 em quatro combinações, revisar e integrar porhash/backup.
- [x] Publicar artefatos oficiais/MED e validar API, transportePHP, metadados/runtime.
- [x] Validar UI, atualizar quatro memórias/inventário e aplicar somente nova read expressamente autorizada.

Não repetir grants/testes operacionais antigos. Sem DDL/escrita de negócio. Regra do limite final já respondida: preservar legado.
