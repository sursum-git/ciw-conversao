# Manutenção rápida de despesas — op1042

Pacote isolado. Fiscalv2 permanece congelado. Não integrar canônicos, executar negócio, publicar, conceder acesso ou alterar DDL.

Origem `form_despesas_container_multi_reg_apl.php`: beforeDeleteAll1431/stale; referência despesa restaurada da sessão1459; validação2293 manual=false/percentualpersistido0; updateAll1553 sincronizar impostos e stale, sem calculadas; deleteAll1563 somente stale. Inclusão/defaults não pertencem a este pacote.

Reuso central: `ContainersDespesasCrudService.p` já implementa batch_update/batch_delete homogêneos, locks do mestre e de todas linhas ordenadas, snapshots antes de mutações, transação raiz e rollback dos efeitos. Não duplicar regras nem alterar esses eventos para imitar manutenção individual.

Seam privado aprovado pelo gerente: `poPolicy.batch_expected_before` opcional somente para batch_update/batch_delete. Wrapper público novo exige originais14campos físicos, validados/fechados, e constrói essa policy internamente. Core compara todas imagens físicas já locked antes de efeitos/IDs; stale409, malformed422. Chamadas internas antigas sem opt-in preservadas.

Arquivos preparados: include `ContainerExpenseBatchSnapshot.i` (schema14/comparação RAW/NULL reutilizada); `ContainersDespesasBatchService.p` (adaptador nativo/envelope, mesmas11buffers+runtime+policy); `ContainersDespesasBatchApi.p` (bindings fixos/identidade/parametros_ima.i); PHP `RuntimeContainerExpenseBatch.php` e patches fechados do Runtime; JSON op1042/fonte/pai. Patches shared sempre baselineSHA256.

- [x] RED/GREEN seam sob lock; TT originais completos e segunda linha obsoleta sem callback/contador/mutação.
- [x] Adaptador/policy privada; roteamento/read/get/batch fechados e DTO→14campos sem atributos inventados.
- [x] UI batch nativa, somente3editáveis e sem inclusão; lote homogêneo update OUdelete; contexto/snapshots comprovados.
- [x] Testes Runtime reais com transporte em memória, auditoria usuário/before-after e rollback; metadados nativos; manifesto e revisão.

Estado: candidato local, aguardando integração/revisão e compilação oficial pelo root. Nenhum canônico alterado. Evidências e gates estão em `REVIEW.md` e `manifest.json`.
