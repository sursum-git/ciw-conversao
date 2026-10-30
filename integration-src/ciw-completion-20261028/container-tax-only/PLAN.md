# op1043 — cálculo somente de impostos

Especificação autorizada pelo root: origem `bl_calcular_impostos_container/index.php` 5098–5113, chamada pelo grid de despesas. Reutilizar exclusivamente `ContainersImpostosService.TaxPlan/PersistPlan`, preservando IPI, itens, despesas calculadas e cabeçalho. Processo explícito, contexto MED obrigatório, confirmação nativa e auditoria completa de usuário/imagens. Sem banco real, publicação ou alterações canônicas neste executor.

Arquitetura escolhida: nova operação fixa `impostos/calcular_impostos` na rota e entidade existentes de processos. Alternativa de copiar serviço/coletor descartada por duplicar regras; wrapper separado descartado porque bindings, identidade, política IMA direta e transação raiz já existem na composição de processos. ABI antiga preservada. Apenas nova operação recebe limite de 50 mil leituras/10 segundos e ownership MED sob lock.

Arquivos compartilhados propostos somente como patches por hash: ContainersImpostosService.p, ContainerProcessBoundary.i, ContainersProcessosService.p, ContainersProcessos.p, RuntimeContainerAudit.php e RuntimeApiEntityActionService.php. Novo helper PHP RuntimeContainerTaxAudit valida imagens físicas completas, ator e recursos fechados da nova operação. JSON op1043 reutiliza entidade/fonte atuais; operação de fonte e navegação são deltas aditivos, pai precisa baseline publicado atual.

- [x] TT RED: operação ausente no core atual, sem erro de harness.
- [x] TT GREEN: TaxPlan/PersistPlan únicos; IPI/itens/calculadas/cabeçalho preservados; rollback, originais internos de cotação obsoletos, limites e composição raiz.
- [x] ProcessEngine real e Runtime process real: contexto, permissão, payload fixo, confirmação/cancelamento, auditoria completa/ator e apresentação póscommit.
- [x] Regressões antigas, quatro charset/cultura sem banco, revisão, manifesto e freeze com baselines atuais.

Gate externo: root compila OE12.2/.42 e integra/publica em sursum-api/med após revisão. O executor não executa essas etapas. Op1044 e os freezes1042/fiscal estão fora deste pacote.

Estado: candidato local testado. Revisão e limitações em REVIEW.md; manifesto por hash e snapshot privado diferenciam esta preparação da integração/publicação.
