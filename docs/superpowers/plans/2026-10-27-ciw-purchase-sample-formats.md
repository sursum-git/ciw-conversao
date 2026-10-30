# Formatos de amostra Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Converter a consulta/manutenção de Formatos de amostra, ligada aos itens, com identidade durável e auditoria existente.

**Architecture:** Wrapper estável de seis parâmetros → núcleo CRUD único com provider privado de identidade; definição e bindings fixos. PHP amplia somente contratos fechados de auditoria. JSON nativo adiciona cadastro global e navegação dos itens.

**Tech Stack:** ABL12.2, PHP8.4/Symfony, metadados JSON/Kendo existentes.

**Spec:** docs/superpowers/specs/2026-10-27-ciw-purchase-sample-formats.md

## Global Constraints

- Reutilizar frontend, transações, logs, snapshots e dependências existentes.
- .42 compila12.2; .137 recebe; validar somente sursum-api/med9911.
- Não alterar dados/DDL/permissões humanas antes de consentimento específico.
- Controles pendência final; preservar todas as mudanças concorrentes.

## Review Focus

- Não reutilizar ID de formato excluído; falha de provider/collision não cria registro.
- Impedir exclusão referenciada em itens de qualquer empresa.
- AliasPK nativo deve coincidir com id; original completo protege concorrência.
- Restrições ASCII/40caracteres para novos valores, sem impedir snapshots históricos.
- Não perder oito abas/Logs/operações anteriores nem ampliar contexto silenciosamente.

### Task1: CRUD/identidade/contrato

- [x] Preservar baselines; teste TT RED do recurso e da identidade sem reutilização; teste PHP RED do importador de logs.
- [x] Extrair núcleo sem duplicar código, manter assinatura antiga, provider fixo para Formatos, definição/bindings/dependência e regras declarativas.
- [x] Compilar e rodar novos testes e regressões em quatro combinações oficiais.
- [x] Ampliar contrato PHP fechado e validar usuário/imagens/lotes/fontes forjadas.

### Task2: Metadados, revisão e publicação

- [x] Consultar catálogo atual e preparar CRUD nativo e navegação dos itens; oito abas preservadas.
- [x] Validar previews PHP/JS e fazer uma revisão final independente.
- [x] Integrar por hashes/backups, publicar compilados e validar leituras/negativas no PASOE real.
- [x] Publicar fonte/entidade/telas pela governança nativa, preservando operações/entidades/Logs existentes.

### Task3: Autorizações e verificação operacional

- [x] Preparar somente sequência dedicada, quatro permissões e cenário novo limitado; solicitar aprovação depois do resultado revisável.
- [x] Com autorização, criar só a sequência prevista, aplicar só permissões previstas, testar apenas registros novos autorizados e limpar pelos IDs/imagens.
- [x] Validar UI e logs com usuário/antes/depois, atualizar inventário e quatro memórias.

Estado27/10: publicação e leituras concluídas; três autorizações específicas pendentes. Não executar DDL, grants humanos ou cenário por autorização antiga. UI: nove abas dos itens e negação esperada do cadastro sem novo grant; imagem em recibo privado. Quatro memórias atualizadas.

Conclusão27/10: três autorizações recebidas e consumidas; sequência81→84,quatro permissões,noveeventosformatos/14negócio com usuário/imagens físicas. Cenário COMPLETED_CLEANED; UI Logs/LogsExclusão e quatro memórias finais atualizadas; revisão operacional independente semP1/P2. Nenhuma publicação de produção repetida nem código alterado durante teste.
