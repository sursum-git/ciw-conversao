# Quantidades importadas por período — MED

Estado em28/10/2026: COMPLETED_READONLY. API e tela publicadas e validadas no PASOE, no runtime e na sessão LDAP de `tadeu.parreiras`. Consulta, filtro de datas e detalhe conferidos. Controles permanece pendência final.

Tela: [Quantidades importadas por período — MED](http://127.0.0.1:8765/production/app.html?screenId=ciw.quantidades-importadas-periodo-med), `op1030/1.0.0`, entidade `proc_compra_quantidades_periodo_med_progress`.21campos, três filtros de datas, read/get, sem contexto e sem links para um representante físico arbitrário. Fonte `motor_progress_ciw_cadastros`109→111operações, preservando109anteriores. Painel `ciw.processos-compra-med/cd0108/1.0.8` integralmente preservado, incluindo11abas e Logs.

## Origem e regras

Scriptcase `cons_item_qt_imp_union`, em `root@192.168.0.170:22:/var/www/clients/client1/web2/web/ciw/cons_item_qt_imp_union`. Cópia sanitizada em `D:/opencode/conversao-sc/sources/scriptcase/purchase-quantities/cons_item_qt_imp_union`. A própria classe grid reconstrói os filtros nas linhas590–643; helper de prazo nas12917–12923. A consulta base `cons_item_qt_imp` e suas duas views continuam concluídas.

Por determinação humana `call_77b2faee9f5b45839d2748051fa22dfb`, preservada a comparação assimétrica:

```text
término da produção + prazo >= início do período
E término da produção <= fim do período
```

Término real ou previsto são alternativas. Não se soma prazo no limite superior. Registro restringe ambas as partes. Recebimento elimina a parte de pedidos. Previsão usa a regra acima nos pedidos e a chegada bruta nos containers. Períodos ativos se combinam com AND por parte e UNION entre partes.

`getQtDiasCalcPrevChegadaPedImp()` da include existente `sursum-api/includes/parametros_ima.i` consulta `espec.im-param` diretamente NO-LOCK, sem cache. A chave `qt_dias_calc_cheg_ped` estava ausente na validação; aplicado o padrão60do helper, sem gravar parâmetros. A data exibida mantém a regra independente `COALESCE(container.dt-prev-chegada,item.dt_maxima_producao+30)`.

A união considera17valores de negócio tipados, sem IDs físicos na igualdade. NULL é distinto de zero/vazio. A chave SHA256 identifica a projeção; colisão com conteúdo divergente falha fechada. Não se escolhe arbitrariamente um processo/item para editar uma projeção com várias origens.

Limite conhecido: igualdade de strings com caixa/preenchimento diferentes não foi comprovada contra o UNION SQL legado. O probe literal na conexão antiga `especw` não conectou, sem executarSQL. Mantidos os valores brutos, sem inventar UPPER/TRIM. Testes comprovam duplicatas idênticas/tipos/NULL/exclusão dosIDs; não comprovam paridade universal de collation. Revisão registra esse limite semP1/P2confirmado.

## Reuso e contrato

`PurchaseImportQuantitiesCollector.p` e `PurchaseImportQuantitiesTable.i` centralizam a coleta NO-LOCK para a base e a variante. O serviço base virou adaptador compatível, mantendo24campos. `PurchaseImportQuantityRules.p` continua único avaliador de quantidades e valores; nenhuma fórmula fiscal, financeira ou de custo foi duplicada.

`PurchaseQuantityPeriodRules.p`, `PurchaseQuantityPeriodFilter.p`, `PurchaseQuantityPeriodsService.p`, `PurchaseQuantityPeriodsApi.p` e `PurchaseQuantityPeriodDates.i` separam regras, filtros, projeção, wrapper MED e datasISO. Leitor e dispatcher recebem somente ramos fixos. PHP `RuntimeCiwErpQuery` registra a nova entidade/recurso e exige contexto vazio, reutilizando o transporte existente.

Read/get apenas,200registros/página,50milcoletas/10s, falha fechada. Nenhum SQL, empresa, programa ou relógio arbitrário do cliente. Frontend do construtor por JSON; nenhum JS/Kendo alterado. Consultas mantêm logs técnicos; cadastros existentes mantêm usuário e valores anteriores/atuais. Nenhuma transação de negócio fictícia é criada para leitura.

## Evidência de entrega

- OpenEdge12.2 no `.42`, build9:19compiles,231checks em cada uma das quatro combinações de codepage/cultura;28logsPASS e testes comNUM-DBS0.
- Revisão independente semP1/P2confirmadas abertas. Campo de data em maiúsculas indevidamente ignorado foi reproduzidoREDbuild8 e corrigidoGREENbuild9.
-17canônicos integrados porhash/backup;18artefatos publicados `.137` via `.111`, dispatcher por último. Refresh somenteMEDociosas121/122; semfixtures/handlers/PROPATH/schema.
- PHP885testes/5841asserções, zero falhas/erros.
- PASOE real sursum-api/med/HTTPS9911:read/get21campos,trêsperíodos,skip200,11negativas,aliases,doisrecursosanteriores e snapshotbase1679preservados.
- Runtime nativo comparou estruturalmente dados/totais com PASOE emread/get,páginaapós200,sortdesc e filtroEntre.111operações/pai integral preservados. Primeiro probeEntre usou array incorreto422; corrigido sóharness para `{start,end}` nativo,GREEN.

Snapshot observado2911projeções contra2916linhasbase; previsãoNov2026=60. Contagens não são invariantes. Nenhuma escrita operacional, DDL ou limpeza realizada neste recorte somenteleitura.

Rede voltou sem alteração de rota/VPN/firewall. Manter túnel89611:127.0.0.1:19910→.111loopback9910da MESMAinstância sursum-api/med. Nunca9921fallback; não publicar.r12.8.

## Continuação

A resposta humana `call_96b46971b9a24e2083b3dd4d0a7704fa` autorizou somente `proc_compra_quantidades_periodo_med_progress.read` para `tadeu.parreiras`. Aplicada uma única concessão; integridade nativa, demais permissões e quatro snapshots LDAP244/246/249/368 conferidos. Autorização consumida, gate fechado; não reaplicar.

Na sessão LDAP real, a lista carregou2912projeções observadas. O filtro Previsão de chegada Entre01/11/2026–30/11/2026 retornou60linhas. Menu Visualizar e abas Origem/Quantidades e valores do detalhe somente leitura foram conferidos. Evidências privadas `ui-verification.json` e `ui-ldap-period-{filter,detail,final}.jpg`. Aba temporária25 fechada; abas do usuário1/2 preservadas. Sem trabalho obrigatório restante neste recorte, sem escrita operacional ou DDL. Não repetir compilação/publicação/concessão. Controles permanece pendência final.

Recibos privados em `D:/opencode/conversao-sc/.runtime/purchase-quantity-periods-20261028/`: `official-compile-verification.json`, `review-final.json`, `canonical-manifest.json`, `active-manifest.json`, `metadata-publication.json`, `med-session-refresh.json`, `pasoe-read-proof.json`, `native-read-proof.json`, `parameter-read-proof.json`, `php-full.xml`, `sql-union-equality.json`, `access/applied.json`, `access/verified.json`, `ui-verification.json`, `ui-ldap-period-final.jpg`, `memory-access-final-update.json`. Nunca copiar credenciais/conteúdos privados para documentação.
