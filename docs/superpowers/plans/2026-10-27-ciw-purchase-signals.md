# Purchase contextual signals Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Execução inline, uma revisão final independente.

**Goal:** Publicar Alertas do processo MED usando as quatro regras reais, componentes reutilizáveis e navegação/auditoria existentes.

**Architecture:** API de buffers fixos→serviço de composição→avaliador único de regras; leitor compartilhado para página/get. JSON nativo acrescenta uma aba sem mudar writers.

**Tech Stack:** ABL12.2, PHP/Builder nativo, JSON/Kendo existentes.

**Spec:** docs/superpowers/specs/2026-10-27-ciw-purchase-signals.md

## Global Constraints

- Contexto obrigatório do processo MED; quatro regras, somente leitura, sem parâmetros de relógio/SQL/empresa vindos do usuário.
- Preservar > da regra4 e condição de recebimentoSO/LD da regra3.
- Sem fórmulas fiscais/financeiras novas, DDL, grants humanos ou escrita operacional implícita. Controles final.
- .42/OE12.2,share137via111,sursum-api/med9911. Preservar fontes/conjuntos de metadados existentes porhash.

## Review Focus

- Fronteiras de datas, desconhecidos, anos bissextos, dias negativos e diferença de >/>=.
- Chavecomposta não permite cruzar contexto/empresa; GETcomalias igual, demaiscampos recusados.
- Qualquer vínculo de pagamento suprime regra4, sem alterar títulos/ledger.
- Nenhum alerta para processo fechado/suspenso; configuração ausente não vira padrão silencioso.
- Noveabas/Logs/writers/operações anteriores preservados; textos corrompidos existentes não regravados.

### Task1 — Serviço reutilizável e contratos

- [x] Preservar baselines e ledger; escrever testesTT de regras/coleção e observar RED por ausência.
- [x] Implementar avaliador, coletor e API fixos; estender catálogo do leitor e dispatcher sem duplicar parser.
- [x] Compilar12.2 e testar quatro combinações; regressão do leitor e contexto existente.

### Task2 — Metadados e publicação

- [x] Preparar entidade/tela readonly op1027/ciw.proc-compra-alertas e pai1.0.7/dezabas, preservando nove anteriores.
- [x] Validar previewsPHP/JS, suítePHP pertinente e revisão única independente.
- [x] Integrar porhash/backups, publicar p/r pertinentes, validar PASOE read/get/negativas.
- [x] Cadastrar duas operações103→105 e publicar metadados pela governança nativa, preservando anteriores.

### Task3 — Interface e memória

- [x] Validar runtime/links/Logs preservados; pedir somente read novo se necessário para tadeu.
- [x] Aplicar apenas read autorizado e conferir UI da consulta. Nenhum efeito de negócio ocorreu.
- [x] Atualizar inventário e quatro memórias, distinguindo esta entrega do painel global/regra5/cadastro de configurações; Controles final.

Estado27/10:PUBLISHED_READONLY_AWAITING_ACCESS; runtime/metadados publicados, PASOE e nativoGREEN, pai1.0.7/dezabas/Logs confirmado na UI; novatela recusa sessãoLDAPporreadausente. Pergunta readespecífica enviada, semresposta/grant. Controlesfinal; painelglobal/regra5/cadastroconfiguração fora do recorte. Quatromemórias atualizadas, abaagente19fechada/abasusuário1/2preservadas.

Conclusão27/10: COMPLETED_READONLY; read específica autorizada/aplicada/verificada e autorização consumida. Correção adicional de UMA LINHA no renderer recebeu autorização humana própria, testeRED/GREEN e UI menu standalone/aba embutida/regressãoIDnumérico passaram. Bloqueioauto-reviewanterior resolvido por essaautorização, semcontorno. Quatro memórias finais atualizadas, abas temporárias encerradas e duasabas originaispreservadas. Controlesfinal.
