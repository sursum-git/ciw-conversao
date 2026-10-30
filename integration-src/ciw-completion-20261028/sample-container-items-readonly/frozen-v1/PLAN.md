# Consulta global de itens em containers de amostra — implementação

> Execução inline autorizada pelo gerente; aplicar executing-plans e TDD. Pacote isolado, sem alteração canônica, rede ou publicação.

**Goal:** op1052 somente leitura para cons_item_container_amostra, com os quatro campos comprovados e identidade completa.
**Architecture:** três buffers fixos espec (itens_container, itens_proc_compra, pp-container), coletor único de INNER JOIN/predicados originais, CiwErpReadService para filtros/sort/página/GET. PHP só protege contrato/identidade; frontend nativo por JSON.
**Tech stack:** ABL compatível12.2, PHP Runtime/Builder existentes, metadados JSON.
**Spec:** pedido do gerente e fonte index1160/3630, grid562/815, lookup vazio; prova em source-proof.json.

## Contratos e decisões

- Global; sem filtro MED, container selecionado, envio, desenho, writer ou regra financeira.
- Exigir pp-container.situacao_container_id=3 E situacao=3; NULL excluído explicitamente. INNER JOIN por container_id e item_proc_compra_id; PK item_container_id.
- Campos item_container_id, codigo_erp, descricao, container_id; record_key técnico JSON com PK física inteira. Strings/NULL preservados, sem trim/normalização.
- DefaultSort container_id ASC comprovado pelo grupo; desempate PK do leitor é extensão determinística declarada, sem afirmar ordem legada entre empates.
- NOLOCK; orçamento global50mil/10s incluindo joins; falha fechada sem resultado parcial, página≤200. Leitor central não replica coleta/regras.
- Operações exatas read/get; contexto vazio, aliases id/record_key coerentes. Novas permissões apenas no catálogo de metadados, sem concessões.
- Candidatos4shared com baselines/hash; rebase após integração7 obrigatório. Build7 e freezes anteriores imutáveis.

## Tarefas

- [ ] Provar fonte, filtros, schemas/PK, ausência de equivalência contextual; gerar fixtures fiéis e teste TT primeiro, observar RED por implementação ausente.
- [ ] Implementar Collector/ReadService/ReadApi/Table; testar predicados independentes/NULL/joins/sem MED, chave, filtros/sort/página>200, orçamento e schema vazio inválido.
- [ ] Preparar guard PHP e4shared em cópias por byte; testes reais readCiwErpPage/GET/aliases antes de transporte; JSON readonly/Builder/validador nativo.
- [ ] Executar quatro combinações UTF8/ISO×AMERICAN/EUROPEAN locais sem DB e PHP; registrar limites/publicação12.2 pelo root.
- [ ] Congelar snapshot por hashes após rebase liberado; entregar revisão independente ao gerente, sem encerrar conversão publicada por candidato.
