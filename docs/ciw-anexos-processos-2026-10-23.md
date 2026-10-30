# Anexos gerais dos processos de compra MED

**Publicado, validado e cenário operacional encerrado/limpo em23/10.** Conversão de `grid_anexos_proc_compra` e `form_anexos_proc_compra`. Nova tela `ciw.proc-compra-documentos`/op1020/1.0.0; quinta aba **Anexos** e link na consulta do processo `ciw.processos-compra-med`/cd0108/1.0.3. As quatro abas anteriores e as definições de itens/anexos dos itens foram preservadas. Frontend nativo por JSON, sem alterações Kendo. Fonte existente com85operações,79anteriores preservadas e seis novas `proc_compra_documentos_{read,get,create,update,delete,opcoes_tipo}`.

## Fontes e comportamento

Scriptcase em `root@192.168.0.170:22`, `/var/www/clients/client1/web2/web/ciw/{grid_anexos_proc_compra,form_anexos_proc_compra}`. Nove arquivos sanitizados,29literais omitidos em `sources/scriptcase/purchase-order-attachments`; manifesto em `integration-src/purchase-order-attachments/source-manifest.json`. Nenhum PHP legado executado.

A consulta original inclui documentos gerais e de itens vinculados ao processo físico. A nova API exige somente o processo MED, cria anexos gerais com item0 e preserva o vínculo de item ao alterar um documento existente. Só permite documentos de itens existentes pertencentes ao processo selecionado. Não corrige órfãos, não move vínculos e não aceita parâmetros livres de escopo, tabela ou arquivo.

Tabela `espec.anexos_proc_compra`, sete campos físicos. DTO11 e auditoria8 (sete campos mais dono real) reutilizam o snapshot existente. `seq_anexos_proc_compra` já existente reutilizada, sem qualquer DDL/reset/reseed. Inclusão/substituição usam o mesmo upload autenticado, broker HTTPS, recibos e coordenador de arquivos já implantados. PDF, imagens raster, Office e ZIP até20MB; downloads históricos preservados. Nenhuma mudança no broker, chave, configuração de storage ou política de arquivos.

## Reutilização e logs

`PurchaseAttachmentsService.p` é o writer único para os adaptadores fixos `PurchaseItemAttachmentsApi.p` e `PurchaseOrderAttachmentsApi.p`; `PurchaseItemAttachmentsService.p` conserva a assinatura antiga como encaminhador. A API de itens continua exigindo processo e item positivos. `PurchaseOrderContext.i` compartilha a validação MED/processo com itens/amostras; `PurchaseAttachmentSnapshot.i` continua comum. Consumidor `PurchaseSamplesService.p` recompilado pela alteração da include. Leitura e despacho usam os serviços existentes. Não foram copiadas fórmulas fiscais, financeiras ou de custos.

PHP reutiliza os perfis, transporte, editor e armazenamento existentes. Logs registram o usuário autenticado e as imagens completas anterior/atual na transação. Anexo alterado pelas duas telas conserva histórico conjunto. Anexo geral item0/nulo aparece na agregação do processo, nunca na de um item. SQL permanece restrito por tenant, tela, recurso, evento, handler, status e IDs tipados. **Logs** pertence ao registro; **Logs Exclusão** na consulta filtra somente exclusões principais. Nenhuma reconstrução retroativa de dados anteriores.

## Validação concluída

- OpenEdge12.2/.42, build4:16entradas sem erro de compilador,141checks em cada uma das quatro combinações cultura/codepage, sem bancos conectados. Publicados14artefatos p/r/includes no137via111, com backups/hashes; refresh somente sessões MED62/63 ociosas em `sursum-api/med9911`.
- PHP canônico:792testes/5219asserções. Revisão independente semP1/P2. Metadados PHP e JS nativo validados.
- PASOE real: consulta/opções/contextos inválidos e regressões de itens/amostras passaram. Endpoint nativo autenticado confirmou leitura/get de documento histórico do processo MED3, sem download de bytes. Processo1679 não tem anexos; sua lista vazia não foi usada como prova de get/CRUD.
- Interface confirmou versão1.0.3, link e cinco abas. A sessão humana inicialmente recebeu recusa, pois os novos grants ainda aguardavam autorização. Após a resposta explícita, somente as quatro permissões de `proc_compra_documentos_progress` foram aplicadas para `tadeu.parreiras`, com assinatura nativa e atualização de suas quatro sessõesLDAP; demais acessos/metadados/auth preservados. A tela e o detalhe passaram na interface.

Durante a publicação, o validador genérico do Builder exigiu no pai os contextos de operações não vinculadas do catálogo compartilhado. Corrigido com RED/GREEN e revisão: validar os seis endpoints CRUD e as operações efetivamente referenciadas por `optionsSource`/`lookupResolver`. Processos mantêm a própria validação de contexto. Publicação do filho/registro de85operações foi reconciliada por recibos; somente o pai pendente foi retomado, sem repetir operações confirmadas.

## Cenário operacional autorizado, concluído e limpo

O usuário autorizou os quatro grants e o cenário `SC_TEST_PROC_DOCS_20261023` pela resposta `call_4487df1b096a431cbdeec60b262994b4`, itens0/1. **Não repetir a concessão nem o cenário.** Não houve DDL/reset/reseed; a sequência existente gerou os IDs5308/5309.

Foram executadas17etapas, com processo1684, item3206 e anexos5308(geral/item0)/5309(doitem), todos novos e gerados pelas APIs, previsão financeira desativada. Exatamente3objetos sintéticos PDF/ZIP/PDF. Downloads comSHA, metadados sem trocar referência/data, stamp antigo409 sem alteração, substituição porZIP e edição do anexo criado pelo item através da tela geral passaram. O histórico do mesmo registro uniu os dois emissores; anexo geral não apareceu nos logs do item. Nenhum título/container/NF/estoque associado.

Foram preservados11eventos com **ator técnico `admin`**, sendo7deanexos e2cada deitem/processo. Não atribuir o teste a tadeu. Imagens anteriores/atuais completas conferidas contra os registros retornados. Interface exibiu Administrador/admin e a descrição anterior/atual. Logs Exclusão exibiu somente deletes dos dois emissores, inclusive os2novos eventos63444/63464; detalhe mostrou8campos anteriores e Atual=Ausente, sem botãoLogs recursivo. Eventos de exclusão anteriores também foram preservados.

**Limpeza confirmada:** APIs removeram somente5308/5309,3206,1684. Probe físico oficial12.2 por IDs congelados confirmou0pai/item/anexos/ledger próprios e igualdade dos sete campos de TODOS4727anexos anteriores. Manifesto congelado conferiu tamanho/SHA/dono5005 dos3objetos novos; remoção SFTP exata autorizada confirmou ausência final. O PDF anterior à substituição permaneceu íntegro porSHA até cleanup. Baseline de4065entradas do diretório foi capturado **ANTES de qualquer upload** e permaneceu igual após excluir somente as3referências novas. Esse inventário é de metadados, não hash do conteúdo de todo o acervo. Logs preservados; arquivos e registros existentes não foram usados como alvos de mutação.

Evidências privadas `.runtime/purchase-order-attachments-20261023/{ACTIVE_WORK,final-verification,ui-final-verification,authorizations-used}.json`, `access/applied.json`, `exercise/confirmed-*.json`, `physical-{before,after}/physical-probe.json`, `storage-{baseline,frozen,cleanup}.json`, `ui-{update,deletion}-log.png`. Estado **COMPLETED_CLEANED**, gates de cenário/permissões false para impedir repetição; aprovações originais em authorizations-used.json.27canônicos continuam com hashes iguais; não reaplicar integração, publicações ou concessões confirmadas. Nenhuma senha/token nesta documentação.

Outros fluxos pendentes do processo, como despesas, controles, resumo, sinalizadores e outras origens, continuam separados; esta entrega cobre as duas aplicações de anexos gerais.
