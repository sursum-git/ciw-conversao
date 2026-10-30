# Amostras dos itens — plano de implementação

**Objetivo:** integrar formato e envios de amostras ao item de compra MED, com rotinas existentes e auditoria autenticada completa.

**Base funcional:** [análise e propostas](../../ciw-amostras-itens-2026-10-22.md). Continuação do mesmo frontend e contratos; não criar frontend ou writer de itens alternativo. Execução nesta sessão, preservando mudanças concorrentes por candidatos/hashes.

## Restrições

- OpenEdge12.2/.42, publicação137 e validação `sursum-api/med9911` obrigatórias.
- Formato usa `PurchaseItemsApi/Service`; envios não executam cálculos financeiros inexistentes no legado.
- Contexto `proc_compra_id,item_proc_compra_id` obrigatório e resolvido contra pai MED. Sem mover envio de item.
- Imagens completas5campos físicos e dono real do processo; ator da sessão autenticada; `row_stamp` obrigatório update/delete.
- IDs persistentes por sequência dedicada, somente após consentimento de schema. Sem MAX/fallback.
- Dados operacionais novos, grants e schema condicionados aos consentimentos específicos enviados; trabalho local/compilação e leituras continuam.
- Fontes canônicas motor-progress/v2 e construtor-pg; candidatos integration-src/purchase-samples; recibos privados .runtime/purchase-samples-20261022.

## 1. Serviço Progress contextual e testes

- [x] Criar testes com tabelas temporárias: CRUD, imagens, nulidade de data, quinto campo preservado, contexto trocado, representante inválido/inativo, stamp obsoleto, rollback, identidade que não se reutiliza, chave fora do item e campos extras recusados.
- [x] Implementar `PurchaseSamplesApi.p` como adaptador de buffers fixos e `PurchaseSamplesService.p` como único writer, incluindo snapshot compartilhado. Leitura reutiliza `CiwErpReadService.p`; sequência fixa como callback servidor.
- [x] Acrescentar somente recurso fechado `proc_compra_amostras` ao dispatcher e leitor; preservar demais recursos.
- [x] Compilar e executar testes oficialmente12.2 em culturas AMERICAN/EUROPEAN e codepagesUTF8/ISO8859-1; verificar log e resultados, não só exitcode.

## 2. Contratos PHP, metadados e auditoria

- [x] Testes RED/GREEN de binding fechado, payload nativo, aliases equivalentes, contextos contraditórios, imagens6comdono/DTO8, ator falso, commit inválido e recursos não autorizados.
- [x] Extrair somente a seleção de perfil de transporte contextual de compras para compartilhar itens e envios; manter regras/schemas próprios e parser escalar `RuntimeProgressAuditSchema`.
- [x] Integrar logs dos envios ao item/processo e escopo próprio de Logs Exclusão (tenant/tela/status/handler/evento/imagens/identidades); testesSQLite adversariais e SQLPostgreSQL.
- [x] Criar entidade/tela `proc_compra_amostras_progress`/`ciw.proc-compra-amostras`, programa op1018 confirmado livre (1015–1017 ocupados). Oito campos, editores inteirosn0 e datasISO, lookup representantes ativos, contexto readonly.
- [x] Publicar nova aba Envios de amostras no item existente por JSON. Manter campo Formato Amostra e API atuais, sem duplicação de regras.
- [x] Executar suítePHP completa, validaçãoJS nativa dos JSON e revisão independente das alterações antes de integrar canônicos.

## 3. Publicação e validação real

- [x] Conferir consentimentos de schema, cenário e quatro grants. Aplicar somente o que foi autorizado e registrar evidência; manter pendência explícita do que não foi.
- [x] Publicar fontes/r12.2/include aprovados com backup/hashes e recargaMED ociosa, sem mudar instância/rota/autenticação.
- [x] Registrar somente seis operações aditivas na fonte existente; publicar tela/aba pelo Builder preservando versões/abas anteriores.
- [x] Validar API/runtime/lookup/negativas reais e interface nativa. Teste operacional novo somente com aprovação, um processo/um item/dois envios próprios, limpeza completa e logs preservados.
- [x] Atualizar inventário e quatro memórias com estado efetivamente publicado/validado e limites reais. Não repetir cenários de itens/pagamentos já encerrados.

## Foco da revisão

Data nula e quinto campo não exibido devem sobreviver update; representante histórico inativo não deve impedir alterar somente a data; troca de contexto/aliases não pode escrever outro item; falha após criar não pode deixar envio parcial; logs de exclusão não podem misturar exclusões de item/financeiro e precisam preservar ator/dono real.
