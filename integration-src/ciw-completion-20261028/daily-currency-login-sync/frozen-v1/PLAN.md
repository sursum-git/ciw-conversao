# Daily currency login sync implementation plan

> Executar inline com superpowers:executing-plans; TDD antes do código e revisão por hashes. Não usar novo checkout/canônico.

**Goal:** preparar orquestração explícita diária reutilizável, mantendo histórico e efeitosERP na mesma transação quando a prova física permitir.

**Architecture:** collector de status único, clienteBC PHP existente, coordenador fechado e participante privado do writer histórico. Modo público continua root-only. Port de aplicação coordenada não significa adapterEMS físico publicado.

**Tech Stack:** PHP8.4/PHPUnit, ABL12.2 oficial pelo root, diagnósticoTT12.8, JSON nativoProcessEngine quando o contrato ficar completo.

**Spec:** DESIGN.md e decisões do gerente/root nesta tarefa.

## Tasks

- [x] Auditar origem/caller, clienteBC, writerhistórico e lacunaEMS; registrar datas distintas e gates físicos.
- [x] Preparar probe metadata2tabelas com limites/NOLOCK/STOP-AFTER e conexões fornecidas pelo root.
- [x] RED/GREEN coordenadorPHP: contrato fechado antes efeitos, cotação manual/hoje, zero/NULL, fim de semana, falhaBC, run_date diferente deobserved_date, resposta não confirmada/sem retry.
- [x] RED/GREEN collectorTT: maiorID hoje/aprovado-manual, flagsNULL, zero/NULL, duplicidade, dia errado/série errada,50k/10s.
- [x] Extrair participante privado único sem alterar ABI pública; executar107regressões atuais em quatro combinações e transação coordenada rollback/rejeição fora da raiz.
- [ ] Preparar root coordenadoTT e auditoria com ator/imagens/run_date/observed_date; gate anteshistórico se EMS não estiver provado.
- [ ] Após probe físico, decidir adapterEMS compartilhado e preservação literal do vetor com provaSQL; nenhum palpite.
- [x] Congelar incremento candidato/manifesto/patches por hashes8 atuais. Sem integração/publicação, grant, hooks ou negócio.
