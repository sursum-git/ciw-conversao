# Despesas dos processos de compra — plano

> Execução inline por executing-plans; implementação local, uma revisão independente final. Isolamento por candidatos e hashes, sem reset/worktree/commit de canônicos sujos.

**Objetivo:** consulta/formulário e geração das despesas MED com reutilização e auditoria completa.
**Arquitetura:** adaptador fixo, serviço único de CRUD/geração e snapshot; contexto de processo/leitor/identidade/transporte e logs existentes compartilhados. Telas CRUD/processo nativas por JSON, geração explícita confirmada e idempotente.
**Spec:** docs/superpowers/specs/2026-10-23-ciw-purchase-expenses.md.

## Restrições

Somente sursum-api/med9911,compilador42OE12.2/publicação137via111. Sem fórmulas financeiras novas, sem cache IMA, sem Kendo alterado. Geração só ausentes conforme aprovação humana. Nenhum grant/DDL/teste operacional coberto por aprovação antiga. Preservar fontes/publicações e dados humanos.

## 1 — Contrato e núcleo

- [x] Schema/seq/dependências e fontes regenerados conferidos.
- [x] Congelar baseline; RED TT para contextoMED/dono, CRUD/stamp/rollback/locks/identidade, geração ativa-nãoimposto/ausentes/valorespreservados/duasexecuções/atomicidade, semtransaçãoexterna.
- [x] Implementar núcleo único e adaptar leitor/dispatcher; wrappers fixos para sequência já existente.
- [x] Compilar12.2 e validar quatro culturas/codepages com regressões relevantes.

## 2 — PHP, logs e metadados

- [x] RED perfis de auditoria/ator/imagens/commit/transporte CRUD e processo, negativos de contexto, SQL do registro/agregado/LogsExclusão; implementar perfis fechados reutilizando classes nativas.
- [x] Catálogo real: códigos livres, filhoCRUD e comando explícito, pai1.0.4/abasDespesas+Gerardespesas,7total,preservando cincoanteriores; fonte85operações anteriores preservada.
- [x] PHP/JS/Builder completos e revisão final independente, corrigirP1/P2 comRED/GREEN.

## 3 — Publicação e prova real

- [x] Integrar/pacote coerente sobhash/backups, publicar/refreshsomenteMEDocioso, leitura real/metadados/interface.
- [x] Preparar proposta concreta de grants/cenário novo, pedir somente autorizações necessárias; executar somente escopo aprovado, limpar próprios dados e preservar logs.
- [x] Atualizar inventário e quatro memórias; fechar gates, registrar limites e estado efetivo.

## Fontes regenerados conferidos

Após a resposta humana, nova leitura do servidor recuperou index/APL completos (manifesto atualizado,11arquivos/43literais omitidos). Eventos onScriptinit/onRefresh chamam localHabilitarCampos; onAfterInsert/Update/Delete somente preencherIDLog. Não há recálculo automático. Lookup manual consulta TODAS as definições pub.despesas, sem exigir vínculo ativo de empresa; manter esse contrato, restringindo apenas a geração aos vínculos ativos não impostos. A tentativa de desabilitar vl_prev compara array com1 e não constitui validação efetiva; não introduzir bloqueio novo nem fórmula fiscal. Sequência fixa existente substitui MAX+1 inseguro do formulário. Evidência privada source-regenerated-verification.json.

Checkpoint final: COMPLETED_CLEANED. 11/11etapas reais,89eventos,6grants aplicados e4sessõesLDAP atualizadas;1processo/42despesas novos removidos e ausência física confirmada por IDs independentes. SemDDL. Não repetir cenários,publicação,concessões oucontador. Evidência .runtime/purchase-expenses-20261023/final-verification.json.
