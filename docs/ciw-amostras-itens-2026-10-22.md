# Amostras dos itens dos processos de compra MED

**Estado prevalente: publicado e validado, cenário operacional encerrado e limpo.** As propostas abaixo foram autorizadas e executadas. Acesse Processos de Compra MED → Itens → sexta aba **Envios de amostras** ou ação da linha. Formato Amostra continua em Especificações, usando o writer de itens existente. Não houve cópia de fórmulas financeiras/fiscais/custos nem mudança das bibliotecas Kendo.

Publicações: `ciw.proc-compra-amostras`/op1018/1.0.0 e `ciw.proc-compra-itens`/op1014/1.0.1. Pai cd0108/1.0.2 preservado. op1015–1017 estavam ocupados. Fonte existente `motor_progress_ciw_cadastros`:67→73operações; acrescentadas somente read/get/create/update/delete/opcoes_representante de `proc_compra_amostras`. Mesma rota POST `/SursumPrograms/ciw-cadastros`. JSONs canônicos em `D:/opencode/construtor-pg/integrations/ciw-purchase-samples`; draft de itens atualizado também no diretório anterior.

`PurchaseSamplesApi/Service` é o único writer de envios; `PurchaseSampleSnapshot.i` registra os cinco campos físicos e dono real. DTO8 inclui proc_compra_id, row_stamp e representante_nome. Leitura reutiliza `CiwErpReadService`. PHP compartilha somente transporte e seleção de perfil em `RuntimePurchaseContextAudit/Payload`; regras e schemas permanecem próprios. Contextos proc/item obrigatórios, MED real, locks NO-WAIT, transação raiz e rollback. Data nula e campo oculto preservados. Ator vem da sessão autenticada, sem aceitar usuário/imagens enviados pelo navegador.

Opções de representante incluem ativos e valores históricos somente dos envios do item, rotulados para manutenção. Novo envio/troca para inativo é recusado; conservar o histórico para alterar a data é permitido. A unicidade física representante/item permanece ativa e foi confirmada em rejeição operacional com rollback.

Logs: formulário=recordEvents; consulta=Logs Exclusão somente main delete. Eventos agregam no item/processo; filtros fecham tenant/tela/recurso/evento/handler nativo. UI mostrou usuário e anterior/atual; exclusão mostrou dados anteriores e Atual=Ausente, sem botão recursivo. Auditoria nova completa; sem retroatividade.

## Validação efetivamente concluída

- Build8 oficial `.42`/OpenEdge12.2:10entradas sem erro,84checks por cada uma das quatro combinações cultura/codepage, NUM-DBS0. PHP canônico719tests4802assertions PASS. Revisão independente semP1/P2 remanescente. Nove artefatos p/r/include publicados137 via111 com backup/hash; recarga oficial somente MED ocioso da `sursum-api/med9911`, sem alterar instância/rota/auth/PROPATH.
- Runtime nativo: paginação, filtro e get dos dois envios, lookup, contexto/negativas reais; UI sexta aba, ação da linha, inteiros, Logs e Logs Exclusão conferidos. Nenhum frontend paralelo.
- Autorizações call_e5bff363d9964d4f959449b0e40b8ea5 aplicadas: somente sequência nova, cenário novo e quatro grants CRUD `proc_compra_amostras_progress` para `tadeu.parreiras`, preservando acessos/sessões LDAP. Auditoria read já existia.
- Sequência `espec.seq_envios_amostras_repres` criada após reconferir95sequências/referência única/quatro registros/MAX4 e ensaio scratch com loader oficial. INITIAL/CURRENT4 na implantação, incremento1/semciclo/min0/max2147483647; APIs consumiram5e6. **Não reaplicar DF, reduzir contador, resetar ou usar MAX+1.** O contador pode avançar por uso normal.
- Cenário `SC_TEST_PROC_AMOSTRAS_20261022`: processo1682, item3204, envios5e6, todos novos/IDsAPIgerados; previsão financeira falsa. Sem títulos/containers/NF/estoque; representantes só leitura. Formato alterado pelo writer existente. Treze etapas confirmadas, dez logs preservados (dois processo/três item/cinco envios), ator técnico **admin**. Stamp antigo409 sem efeito. Inclusão com código ERP alfanumérico e update com representante duplicado foram recusados; leituras novas reconciliaram ausência/inalteração antes de tentativas corrigidas distintas. Nenhum POST desconhecido repetido.
- Limpeza pelas APIs. Probe físico12.2 final por IDs congelados, independente de o pai existir: zero pai/item/envios/ledger próprios. Quatro envios preexistentes idênticos nos cinco campos e representantes idênticos nos três campos de referência. Logs/sequência preservados. **Cenário encerrado: não repetir fixtures.**

Evidências privadas `.runtime/purchase-samples-20261022/`: official-compile-verification, canonical-manifest, sequence-applied, active-manifest, metadata-publication, access/applied, exercise/confirmed-*, physical-before/after, final-verification e ui-deletion-log.png. Sem credenciais na memória. Anexos binários e controlador independente `ctrl_envios_repres_amostra`, sem vínculo comprovado neste fluxo, continuam fora deste recorte.

## Análise original e propostas executadas

O fluxo será integrado ao cadastro de itens existente. O formulário Scriptcase `form_itens_proc_compra_amostra` exibe apenas Pedido, Item e Formato Amostra, mas grava `itens_proc_compra` e executa as mesmas regras financeiras/fiscais do formulário completo. Por isso, a edição de formato reutilizará a API de itens e seu snapshot de46campos; não haverá outro writer nem cópia de fórmulas.

A consulta `grid_PUB_envios_amostras_repres` e seu formulário `form_PUB_envios_amostras_repres` formarão uma aba **Envios de amostras** do item salvo, com o frontend nativo por JSON. Contexto obrigatório: item selecionado e processo MED real, validados no backend. O representante será pesquisado em `ems2cad.repres` (`cod-rep`, `nome-abrev`, `ind-situacao=1`), mesma origem comum do legado. Representantes e itens existentes não serão alterados por esse cadastro.

Dicionário oficial OpenEdge12.2/.42 conferido em22/10: `espec.envios_amostras_repres` tem5campos físicos: `envio_amostra_repres_id`, `item_proc_compra_id`, `cod_rep`, `dt_envio`, `apont_amostra_id`. O último não aparece no formulário legado; será preservado nas alterações e incluído nas imagens de auditoria, sem editor que permita mudar seu vínculo. Não há triggers cadastrados. A chave do envio é referenciada somente nessa tabela. O formulário não tem eventos de negócio adicionais; não se acrescentará recálculo financeiro a uma alteração de envio.

Consulta, detalhe, inclusão, alteração e exclusão usarão recurso fixo `proc_compra_amostras`, mesma fonte `motor_progress_ciw_cadastros` e rota existente. Reutilizar leitor/paginação/filtros, parser de auditoria, identidade de sessão e classes nativas de transação/log. Writer específico valida apenas contexto, campos, representante e concorrência, com locks de processo/item/envio e rollback. Snapshot completo dos5campos, usuário autenticado, sem aceitar ator/imagens do navegador. Logs por registro e **Logs Exclusão** somente para exclusões principais, com anterior/atual visíveis e agregação no item/processo.

## Proposta de identidade persistente

O inventário completo das95sequências não contém sequência de envios. `seq_apont_amostra` pertence ao apontamento de amostras, outra identidade, e não será usada. O maior ID físico de envio encontrado é4. Propõe-se criar somente `seq_envios_amostras_repres` em `espec`, incremento1, sem ciclo, limitada a2147483647, iniciada acima dos IDs físicos e identidades de auditoria já usados, reconferidos imediatamente antes da aplicação. Nenhum contador existente será reiniciado, reduzido ou alterado. Sem MAX+1 na API, sem inserir identidade informada pelo navegador. A aplicação do schema depende da autorização específica do usuário.

## Proposta de teste operacional e acesso

Novo cenário, sem repetir fixtures concluídas: um processo e um item novos com identidades geradas pelas APIs, `log_considerar_previsao=false`, e dois envios novos, marcador `SC_TEST_PROC_AMOSTRAS_20261022`. Ler somente representantes existentes; validar formato, CRUD dos envios, conflitos e auditoria; remover os registros novos ao terminar, preservando logs e sequências. Não associar títulos, containers, notas nem estoque. Esse cenário e a limpeza precisam de autorização própria.

Acesso proposto para `tadeu.parreiras`: somente consulta/inclusão/alteração/exclusão de `proc_compra_amostras_progress`. Permissões anteriores de processos/itens e leitura de logs já existem e não precisam ser ampliadas. A concessão das quatro novas permissões precisa de autorização própria.

## Estado

Este estado original foi superado pela publicação e validação descritas no início do documento. Fontes em `sources/scriptcase/purchase-samples/`, manifesto em `integration-src/purchase-samples/source-manifest.json`, evidências privadas em `.runtime/purchase-samples-20261022/`. Anexos binários e o controle independente de envios em lote continuam separados deste fluxo contextual.
