# Sinalizadores e reconciliação das pendências de compras MED

Estado em 28/10/2026: **COMPLETED_ACCESS_UI**. Três telas compiladas em OpenEdge 12.2, publicadas no PASOE `sursum-api/med/9911` e validadas no runtime e na sessão LDAP. As quatro permissões específicas foram autorizadas, aplicadas e verificadas para `tadeu.parreiras`; nenhuma configuração real foi alterada.

| Tela | Programa / versão | Entidade | Comportamento |
|---|---|---|---|
| `ciw.sinalizadores-importacao-med` | op1031 / 1.0.0 | `proc_compra_sinalizadores_med_progress` | Resumo das cinco regras, incluindo contagens zero; somente leitura; nove campos. |
| `ciw.alertas-importacao-med` | op1032 / 1.0.0 | `proc_compra_sinalizados_med_progress` | Detalhes da regra selecionada; `sinaliz_imp_id` obrigatório; somente leitura; dezenove campos. |
| `ciw.sinalizadores-importacao` | cd0110 / 1.0.0 | `sinalizadores_importacao_progress` | Configuração dos cinco IDs existentes; read/get/update; cinco campos; inclusão/exclusão/lote recusados. |

A fonte existente `motor_progress_ciw_cadastros` passou de 111 para 118 operações, preservando as 111 anteriores. O pai `ciw.processos-compra-med/cd0108/1.0.8` foi preservado integralmente, com onze abas e seus contratos de Logs. Nenhum frontend paralelo foi criado e nenhuma biblioteca Kendo foi alterada.

## Regras e reuso

`PurchaseSignalsCollector.p` e `PurchaseSignalsTable.i` extraem uma única coleta compartilhada. A consulta contextual publicada mantém assinatura, campos e paginação; o painel global reutiliza esse coletor uma vez por processo, sem recoletar por página. `PurchaseSignalRules.p` continua sendo o único avaliador das regras 1–4. O orçamento restante e o início da consulta são parâmetros privados do coletor, fora do JSON do cliente: o limite global de 50 mil verificações/10 segundos é verificado dentro da varredura, com falha fechada e sem dados parciais.

`PurchaseSignalContainerRules.p` contém a regra 5: container em situação 1, sem embarque real, com embarque previsto entre hoje e hoje mais os dias configurados, inclusive nas duas pontas. O relógio é interno. A composição MED usa o contexto de empresa existente e o prefixo 5 de `cod-estabel`, conforme o painel canônico. A chave do detalhe inclui regra/tipo/processo/item/container; os campos de link para destinos não aplicáveis permanecem NULL, ocultando os links pelo renderer existente. As manutenções abrem os cadastros nativos já publicados.

Não há nova fórmula fiscal, financeira, de custo ou de versão de container. Não foi introduzido cache de parâmetros IMA. Nenhum dado de configuração foi regravado para corrigir textos históricos.

## Configuração e auditoria

`PurchaseSignalConfigApi.p` fixa `espec.sinalizadores_importacao`. O serviço privado permite read/get/update e restringe get/update aos IDs 1–5. Criar ou apagar uma regra executável não é uma ação desta tela; create/delete/batch retornam 405. Nenhuma sequência ou DDL foi criada.

A persistência reutiliza `CiwCadastroCoreService`: transação raiz, lock exclusivo NO-WAIT, concorrência por imagem original completa e cinco campos físicos antes/depois. O wrapper recusa update dentro de transação externa. Nome e título novos são obrigatórios; dias novos aceitam inteiro 0–9999. Os comprimentos de nome/título/descrição são 100/300/600 caracteres, conforme os validadores do formulário legado; os formatos x(50)/x(150)/x(300) do dicionário não são limites físicos de CHARACTER. Imagens originais e NULLs históricos são preservados.

`RuntimeCiwCadastroAudit` e `RuntimeApiEntityActionService` reutilizam a auditoria autenticada nativa. A atribuição do usuário vem da sessão, sem aceitar ator no payload ou na resposta. `ScreenDefinitionService` injeta Logs no formulário autorizado; para esta tela em modo form/popup, o modo padrão é `transactions`, confirmado habilitado na definição nativa. O botão Logs foi aberto na sessão LDAP: transações filtradas pela tela/registro, com nome e código do usuário. Dois atalhos assinados foram integrados ao grupo CIW/Compras da Home para reconhecer as novas telas no catálogo de auditoria existente; demais telas, menus e acessos preservados. Nenhuma política foi relaxada. **Os cinco sinalizadores reais não foram editados em testes.**

## Validação efetivamente realizada

- Build oficial 3 no `.42`, OpenEdge 12.2: 28 entradas compiladas, 298 verificações em cada combinação UTF-8/ISO8859-1 × AMERICAN/EUROPEAN, 36 logs PASS e testes NUM-DBS 0.
- Revisão independente da integração: 37 hashes conferidos, nenhum P1/P2 aberto no escopo revisado. Os achados de contexto obrigatório, orçamento global, modo do Builder, limites/obrigatoriedade e raiz transacional foram corrigidos antes do build final.
- Suíte PHP completa: 885 testes/5.841 asserções. Verificações adicionais dos candidatos: auditoria PHP 25, transporte PHP 33 e metadados/links JS 11; previews PHP e validação JS nativos das três telas passaram.
- Integração de 21 arquivos canônicos por hash/backup. Publicados 19 artefatos oficiais no compartilhamento `.137` via `.111`; nenhuma fixture ou `.r` local 12.8 publicada. Recarga somente das sessões MED ociosas 123/124/125, no mesmo PID 3856625.
- PASOE real: resumo com cinco regras/nove campos, contagens iguais aos detalhes de dezenove campos, configuração com cinco campos, treze negativas, links NULL corretos, contrato contextual e dois recursos anteriores preservados. Observação do momento: regras 1–5 com 0/0/20/842/1 alertas; essas contagens não são invariantes e não provam ocorrência real de todas as regras.
- Runtime nativo: read/get das três telas, contexto da regra e contagens conferidos; paginação depois de 200 com dados/totais iguais ao PASOE na regra4, observada com842 linhas. Fonte118/111 anteriores e pai1.0.8/onze abas idênticos. Logs de configuração habilitados em modo transactions. Um primeiro harness supunha get.data; foi corrigido somente para aceitar a linha direta retornada pelo runtime, sem alteração do produto.

Persistência, concorrência e auditoria da configuração foram exercitadas somente por 40 verificações TT em cada uma das quatro combinações oficiais. Não houve gravação comercial, DDL, limpeza operacional ou alteração dos cinco sinalizadores reais. As únicas concessões humanas foram as quatro especificamente autorizadas para `tadeu.parreiras`, com integridade e quatro snapshots LDAP conferidos; autorização consumida, não repetir.

## Reconciliação do inventário e limites

O inventário geral possuía estados históricos falsamente pendentes. Foram reconciliados com `purchase-orders-validation.json`, `container-allocation-validation.json` e as evidências prevalentes de cada entrega, preservando os outros programas e os totais não relacionados a estado. Formatos, documentos, despesas, resumo, impostos e alocação não foram reconvertidos nem tiveram testes operacionais repetidos. As oito origens das três novas telas estão **Convertidas no escopo MED**, com acesso e interface validados; as outras 254 entradas foram preservadas nesta finalização.

As pontes `bl_selecao_pagto_proc_compra` e `bl_selecionado_pagto_proc_compra` apenas preparam sessão/filtros e redirecionam para `cons_tit_ap`; suas entradas não invocam writer. A navegação MED é absorvida por `ciw.proc-compra-pagamentos/op1013/1.0.1` existente. As diferenças ficam explícitas: opções atuais excluem vínculos globais e a consulta mantém histórico real; não se declara igualdade SQL linha a linha nem cobertura multiempresa.

`ctrl_envios_repres_amostra` apenas guarda data e abre representantes; os eventos de seleção/finalização disponíveis estão vazios. **Não foi declarado convertido um lote operacional sem comando comprovado.** A consulta de representantes EMS5 já publicada é reutilizável; o writer contextual de amostras usa EMS2, sem equivalência automática de códigos entre os cadastros.

Os sete campos de `cons_procs_compra` estão cobertos pelo pai MED existente; a origem sem filtro de empresa e seu chamador de conta corrente continuam fora do recorte MED. A variante `form_proc_compra` usa a manutenção MED existente, sem copiar a cascata de exclusão legada divergente. Essas ressalvas permanecem no inventário, sem declarar paridade multiempresa. `Controles` continua como **pendência final por determinação do usuário**, sem origem/vínculo presumido e sem nova DDL.

## Evidências e retomada

Recibos privados em `.runtime/purchase-pending-integration-20261028/`: `canonical-manifest.json`, `official-compile-verification.json`, `review-final.json`, `php-full.xml`, `active-manifest.json`, `med-session-refresh.json`, `pasoe-read-proof.json`, `native-read-proof.json` e `metadata-publication.json`. Não repetir integração/publicação/recarga concluídas. Nunca copiar conteúdo privado de credenciais para fontes ou memória.

Candidatos e revisões em `integration-src/purchase-pending-20261028/{signals-global,signal-config,sample-batch}`; manifesto das quatro fontes novas de pagamentos em `integration-src/ciw-inventory/purchase-payment-bridges-20261028-source-manifest.json`. Backups e relatório da reconciliação documental ficam em `.runtime/purchase-pending-manager-20261028/documentation-baseline/` e `inventory-reconciliation.json`.

Conclusão de acesso/UI: resposta `call_5bbe345fbb8b4d83a529a45427934401` autorizou três permissões de consulta e a edição da configuração. Exatamente quatro aplicadas, demais acessos e sessões LDAP244/246/249/368 preservados; autorização consumida. UI validou resumo, detalhes de itens/containers, links, configuração, abertura/cancelamento da edição e Logs com usuário. Não atualizaram-se os cinco sinalizadores reais. Evidências `access/{applied,verified}.json`, `ui-verification.json`, `metadata-home-publication.json` e imagens `ui-ldap-*.jpg`.

O validador nativo confirmou os dois novos atalhos isolados e ausência de novas falhas; o Home bruto já tinha dez erros de metadados fora do delta (tipo master_detail e referências antigas), registrados sem correção ampla em `metadata-home-validation.json`. Não declarar que o Home inteiro passou. Nenhum código de política/Kendo foi modificado.

Túnel vigente: sessão95725, `127.0.0.1:19910` para loopback9910 da mesma instância MED, helper `med-runtime-tunnel.py`, keepalive e três reconexões limitadas. Antigos89611/82324 encerrados. Sem alteração de rota, VPN, firewall ou servidor. Temporárias28/29 encerradas; abas do usuário1/2/26 preservadas. Quatro memórias atualizadas. Este recorte não tem trabalho obrigatório restante; Controles final, lote de amostras sem writer comprovado e multiempresa continuam como limites explícitos acima.
