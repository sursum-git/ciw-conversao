# Anexos dos processos de compra — plano

> Execução inline por `superpowers:executing-plans`, com revisão final independente. Não delegar implementação.

**Objetivo:** converter consulta/formulário de anexos gerais do processo MED, reaproveitando o fluxo dos anexos dos itens.
**Arquitetura:** um writer ABL/snapshot/contexto compartilhados, dois adaptadores de recursos fixos; transporte/armazenamento/editor nativos existentes e perfil PHP fechado por entidade.
**Spec:** docs/superpowers/specs/2026-10-23-ciw-purchase-order-attachments.md.

**Checkpoint23/10:** COMPLETED_CLEANED.17/17etapas autorizadas,4grantsaplicados,11logs preservados,4registros/3arquivosnovoslimpos;4727anexosanteriores e4065entradasdediretóriopreservados. SemDDL; gatesencerrados. Evidências .runtime/purchase-order-attachments-20261023/final-verification.json. Não repetir implantação,concessões oucenário.

## Restrições globais

Canônicos sujos preservados; candidatos neste workspace com baseline/hash/backup antes de integração. Sem reset/commit/push. Compilação12.2 no42/publicação137via111/PASOE sursum-api/med9911, sem fallback. Include IMA sem cache. Nenhuma fórmula fiscal/financeira nova. Nenhuma senha/token em fontes/memórias. Nova identidade usa a sequência de anexos já criada, nunca MAX+1/reseed. Aprovações encerradas não cobrem concessões/cenários novos.

## 1. Núcleo ABL compartilhado e fronteiras fixas

- [x] Congelar baseline dos consumidores atuais; criar candidatos `PurchaseAttachmentsService.p`, adaptador `PurchaseOrderAttachmentsApi.p` e compatibilidade `PurchaseItemAttachmentsService.p`. Compartilhar validação de processo MED com a include de itens.
- [x] Teste RED: contexto processo cria item0, lista gerais e itens do processo, não aceita flag de escopo/client item, preserva vínculo em update/delete, recusa órfão/divergência, outro processo, stamp antigo e transação externa. API antiga continua recusando item ausente/zero.
- [x] Implementar uma única persistência/snapshot/stamp/leitura/tipos e callbacks fixos para sequência existente, recursos `proc_compra_anexos` e `proc_compra_documentos`.
- [x] Executar suíte nova e regressões de anexos de itens/amostras/leitor em quatro combinações cultura/codepage no12.2, conferir COMPILER:ERROR e manifestos.

## 2. Transporte, auditoria e SQL existentes

- [x] Testes RED de perfil parent-only e DTO item0/nulo/positivo, ator/imagens completas, projeções imutáveis, multipart/download e contexto conflitante; manter perfil antigo estrito.
- [x] Ampliar perfis fechados e gates Builder/FileContext/cliente sem duplicar broker/coordenador. `RuntimePurchaseAttachmentAudit` compartilha schema/inspeção por perfil; nenhum caminho livre de arquivo.
- [x] Testar SQL em SQLite real e guardas PostgreSQL: dois emissores registrados, mesmo registro auditado, item0 nunca agregado a outro item; tenant/recurso/evento/handler/status/tipos permanecem obrigatórios; Logs Exclusão só main delete.
- [x] Rodar PHP pertinente e completo após integração, JS nativo; revisão independente dos deltas e correções RED/GREEN.

## 3. Metadados, publicação e validação

- [x] Consultar catálogo real, escolher código livre e preparar filho1.0.0 + pai1.0.3 com aba Anexos e link; preservar item1.0.2/amostras/anexos de itens,79operações anteriores, Home e demais definições.
- [x] Preparar proposta concreta de quatro grants `proc_compra_documentos_progress` para tadeu.parreiras e novo cenário marcado com1pai/1item/2anexos e até3arquivos sintéticos; pedir somente os consentimentos novos após testes preparatórios.
- [x] Integrar sob hashes/backups, publicar fontes/.r12.2 coerentes e atualizar apenas MED ocioso quando necessário; registrar seis operações novas e publicar pelo Builder nativo.
- [x] Validar leitura real, metadados/UI e auditoria; executar somente cenário explicitamente autorizado, limpeza física independente por IDs/hashes próprios, logs preservados.
- [x] Atualizar inventário e quatro memórias, fechar gates e distinguir evidências preparatórias versus operacionais.

## Foco da revisão

Contexto de item ausente não pode abrir fluxo antigo; nova API nunca aceita parâmetro livre de escopo. Item ligado a outro processo ou ausente não dá acesso a arquivo. Mesmo anexo alterado por duas telas deve conservar histórico e dono. Item0/nulo não pode vazar para logs de outro item. Commit incerto não permite apagar objeto nem repetir POST. Arquivos anteriores e as sequências existentes não podem ser limpos/resetados por ferramentas de implantação/teste.
