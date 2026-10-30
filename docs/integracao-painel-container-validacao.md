# Painel do Container — implementação em andamento

## Painel de containers — comandos publicados em16/10/2026

**Estado atual do painel; substitui descrições históricas readonly abaixo.** Painel ciw.container-painel/op1001/1.0.4 com14abas, cabeçalho update/delete e Despesas/op1003/1.0.1 CRUD individual. Processos nativos **op1015/ciw.container-gerar-versao**, **op1016/ciw.container-fechar-custos**, **op1017/ciw.container-sincronizar-impostos**, todos1.0.0. op1012 já estava ocupado por iol.inicial-gerencial e foi preservado. Três fontes novas motor_progress_container_cabecalho/despesas/processos; JSONs publicados pelos endpoints oficiais Builder/governança. Não repetir creates nem reimportar drafts antigos.

Reutilização mantida: Collector/Calculator/Distribuição/Version/Inputs/Close/Fiscal em serviços separados; wrappers sem cópia de fórmulas. NAT-OPERACAO-IMP corrigido, padrão vazio, NO-LOCK/sem cache; distribuição pela empresa do container. Snapshot sob lock e audit confirmado somente após commit raiz; PHP importa contrato fechado para transação/log existentes, autoria da sessão autenticada, eventos mestre/filhos vinculados ao container. Cabeçalho29campos e despesas6campos usam values.<campo>; processos/contexto permanecem na raiz. Despesas respeitam eco inalterado de campos derivados no formulário completo e recalculam no serviço.

**Publicado/validado:** lote principal60artefatos+3rotas .runtime/container-commands-publish-20261016/active-manifest.json; delta ativo de header/trigger .runtime/container-delete-compat-publish-20261016/active-manifest.json (prevalece nos arquivos sobrepostos). Compile real OpenEdge12.2/.42 final em .runtime/container-commands-compiled-20261016-v5/:62fontes sem erro,30suítes,2167checks em cada cultura AMERICAN/EUROPEAN. PHP462testes/2674asserções; root e revisão independente27testes/414asserções do delta. Metadados8/392, smokes contexto/confirmação/Logs/flag sessão passaram. PASOE13fronteiras novas,27custos,25financeiro e PHP11consultas passaram.

**Negócio real testado com autorização específica do usuário:** SOMENTE novo container2147000100/tagSC_TEST_CMD_20261016_A, ERP sintéticoZTSC161026. Cabeçalho, despesa individual create/update/delete, sincronização fiscal, versão2358 e custo6144 confirmados. Logs73eventos confirmados após limpeza, usuário Administrador/admin, valores1→2 na despesa, filhos/versão/custo e exclusões com snapshot anterior. UI confirmou14abas, três formulários, cancelamento Kendo e Logs contextual/Anterior/Atual. Exclusão bloqueou custos antes da limpeza. Nenhum container/nota/estoque existente foi alterado.

**Limpeza concluída:** .runtime/container-commands-20261016/command-cleanup-verification.json confirmou12tabelas, zero registros restantes do teste e2393containers. Testes consumiram IDs reais; não restaurar/reiniciar sequências. Transação1624 preserva a exclusão do master/versão/5auxiliares. Os quatro tipos de snapshots auxiliares são removidos/auditados antes das versões; PHP só aceita essesDELETEs com versão excluída no mesmo envelope/CID. Getter/contexto/runtime não recebem tabelas, programas, conexões ou políticas do navegador.

**Dependência legada resolvida:** trigger original /mnt/datasul/ERP/especificos/ems2/ima/estrg/tdpp001.p cadastrado no banco com barra invertida. Mesmo código compilado12.2 em sursum-api/legacy-triggers/tdpp001.p/r; dois aliases literais estrg\tdpp001.p/r no diretório LOCAL /dados/pasoe/sursum-api/webapps/med/WEB-INF/openedge já presente no PROPATH. CIFS não aceita esses nomes; tentativa no compartilhamento foi restaurada antes da publicação local. Sem alterar schema/definição de trigger/PROPATH/autenticação e sem desabilitar trigger. Preserva bloqueios de situação3/pedidos. OEJMX oficial recarregou apenas sessões med11/12/13 ociosas, resposta success salva. Não repetir refresh por rotina.

Sincronização canônica: .runtime/container-commands-canonical-20261016/verification.json e context-verification.json; arquivos publicados em motor-progress/v2/sursum-api, testes em tests/abl/container-panel, JSONs e teste em construtor-pg/integrations/ciw-container-painel. Core PHP/JS e testes no construtor-pg; ProcessDefinitionValidator aceita apenas booleano currentUser.forcePasswordChange, mantendo bloqueio de segredos. Preserve diffs dos demais chats e do painel IOL.

Guia da entrega: [manutenção/processos e logs](D:/opencode/conversao-sc/docs/painel-container-comandos.md). Origem Scriptcase continua root@192.168.0.170:22, /var/www/clients/client1/web2/web/ciw; cópias em sources/scriptcase/containers/<aplicação>/, fluxo grid_pp_container→bl_ponte_painel_container→menu_container→form_pp_container. Credenciais não estão nesta memória.

**Continuidade fora desta entrega:** manutenção/alocação de itens, associações de pagamentos/NFs, distribuição manual e anexos binários. Não declarar conversão integral do menu. Usuário excluiu temporariamente do escopo geral CIW o programa rotulado conta corrente fornecedor; preservar registro específico em PROJECT_CONTEXT.md, sem inferir exclusão de todo financeiro. Sem commit/push/schema/reseed/reassinatura.


Pedido: implementar a proposta aprovada do menu e seus programas no contexto do container. Não considerar o painel completo pela existência das primeiras abas. Nenhuma escrita de negócio foi executada nesta etapa de leitura.

## Estado atual —16/10/2026, após correção de NAT-OPERACAO-IMP

- Consulta ciw.containers/op1000/1.0.2 preservada. **Painel ciw.container-painel/op1001/1.0.3 com11abas nativas readonly**: Dados, Resumo, Itens, Custos dos Itens, Despesas, Anexos, Versões Custo, Pagamentos, Notas Fiscais, Comparativos e Rastro do Dólar Médio. op1008/op1009 criados/publicados pelo Builder oficial, não repetir plano de create. UI332526 confirmou os dados nas duas novas abas.
- Include central getListaNatOperNotaMae() usa **NAT-OPERACAO-IMP**, padrão vazio do PHP; valor real31201M,31206,31207. Leitura NO-LOCK sem cache, nenhuma alteração na im-param. Os quatro consumidores publicados da include foram recompilados12.2, publicados com backup/hash e ativados em med. Lote específico734checks por cultura. Manifestos NAT em `.runtime/nat-operacao-imp-publish-20261016/`.
- Custo continua centralizado em Collector/Calculator/Totals/Adapter. Histórico opcional vl_unit_prev/vl_unit_realiz desconhecido agora permanece JSONnull; D() continua estrito nos campos obrigatórios, sem fórmulas duplicadas/zero presumido. Coletor atualizado publicado como dois artefatos; **manifesto ativo de custo `.runtime/container-null-history-publish-20261016/active-manifest.json`**. Backup `/tmp/codex-container-null-history-20261016/backup-20261016T185616Z`.
- Nova compilação real12.2.12/.42: **52fontes sem erro,24suites,1962checks por cultura** AMERICAN/EUROPEAN. Diretório `.runtime/container-panel-coherent-compiled-20261016-v2/`, validation-summary.json e logs. Inclui versões186, driver34, histórico ausente7, Inputs/Close175, fiscal128, despesas128 e os demais helpers/rules. Escritas privadas não foram publicadas/habilitadas por essa compilação; não há sequências reais consumidas.
- PASOE27checks de custos (quatro recursos,BRL/USD,read/get,auth/contexto/validações), financeiro25 e PHP11telas passaram.2393containers preservados. Origem/cotação/erros de dados incompletos explícitos. Containers332526 e333426 calculáveis;331126sem itens,331626denominador zero,200019itemcompra órfão não recebem zeros fabricados. Evidências sob `.runtime/construtor-pg/` nos arquivos container-cost-pasoe-evidence.json, container-finance-pasoe-evidence.json e container-panel-runtime-evidence.json.
- Ativação por OEJMX oficial, somente agente med identificado e sessões IDLE. Para novo coletor, sessões8/9/10 com terminateResult=success em resposta salva. Sem reinício da instância, mudança de autenticação/PROPATH/rotas ou outra aplicação. Tentativa NAT anterior retornou erro apenas no parser da pós-condição; APIs provaram ativação, não repetir aquela operação por seu exitcode. Helper agora salva resposta bruta antes de verificar formato.
- **26arquivos canônicos sincronizados** (metadados11abas/fontes e testes de consulta de custos), verificando baselines/hashes e preservando demais diffs: `.runtime/container-panel-canonical-current-20261016/verification.json`. Include canônica corrigida em sincronização própria; CRLF/LF diferencia hash bruto sem diferença de conteúdo normalizado.
- Restam manutenção/filhos/processos, integração pública e auditoria PHP completa das mudanças filhas, fechamento/associações, distribuição manual e anexos binários. Abas Anexos/Versões ainda são consultas. Core ProcessEngine já integrado sob autorização específica, sem execução fiscal. A conversão completa continua em andamento; não confundir testesTT/compilação privada com publicação funcional.

### Parâmetro e regras confirmadas

Getter PHP antigo buscava nat_operacao_nf_mae com padrão vazio; usuário confirmou a chave física NAT-OPERACAO-IMP. Não há lista literal de fallback. Distribuição usa a empresa do container, substituindo empresa2 fixa. Custos/versões/fechamento mantêm coleta/cálculo/persistência separados e reutilizáveis.

Retomada e pendências detalhadas em `context/RETOMADA_2026-10-16.md`. Manifests antigos conservados como histórico; os estados desta seção prevalecem.

## Histórico das etapas anteriores

Os registros seguintes descrevem as entregas parciais e os candidatos de cada etapa; o estado atual está acima.

### Primeira publicação em16/10/2026

- Consulta ciw.containers/op1000 versão1.0.1 possui rowLink para ciw.container-painel, passando context__container_id.
- Painel ciw.container-painel/op1001 versão1.0.0 abre diretamente formulário incorporado por get, sem grade intermediária. Dados e quatro abas vinculadas:
  - ciw.container-itens/op1002:22campos persistidos/lookups, cálculos ainda não integrados;
  - ciw.container-despesas/op1003:20campos, incluindo empresa derivada e distribuição;
  - ciw.container-anexos/op1004:8campos de metadados, sem download/upload nesta versão;
  - ciw.container-versoes-custo/op1005:23campos de versões existentes.
- Fonte motor_progress_container_painel,10operações read/get via POST /SursumPrograms/containers-painel, X-Containers-Token server-side já existente. Configuração autenticada de containers reutilizada sem expor credencial. Todos os programas readonly.
- Wrapper ContainersPainelRead.p, serviço ContainersPainelReadService.p. Compilados no OpenEdge12.2.12/.42;347verificações em cada AMERICAN/EUROPEAN. Publicados somente seus quatro .p/.r e rota mesclada, em sursum-api/med, sem reinício. Manifesto .runtime/container-panel-publish-20261016/active-manifest.json; backup /tmp/codex-container-panel-read-20261016/backup-20261016T163555Z.
- PASOE real:46checks read/get/auth/IDs/recusa de escrita/filhos de outro container. Amostras331126,1525,331626,332526,200019; o último possui1item,50despesas,1anexo,9versões. Registro mestre completo confirmado; conjunto2393containers preservado.
- PHP real: cinco telas, contexto obrigatório antesHTTP, detalhe correspondente, escopo pai/filho e OR conflitante recusados; quatro telas anteriores e consulta preservadas. Evidências privadas .runtime/construtor-pg/container-panel-{pasoe,runtime}-evidence.json. Cadastro via builder/governança/locks/testes/aprovação, grants revogados: .runtime/construtor-pg/container-panel-publicacao.json.
- UI nativa: consulta1.0.1→Painel331126 e abaDespesas com5linhas confirmados. Demais cliques/retorno continuam sendo conferidos.

## Extensões genéricas do construtor

formOptions fechado permite tabs fields/linkedPage, modo embedded, PK contextual obrigatória e returnScreenId. get envia contexto validado; RuntimeApiEntityActionService usa ApiRequestContext para encaminhar só requestContextFields registrados e recusa resposta fora do contexto. O campo é restrito a POST e até8identificadores lowercase integer existentes na entidade. Nenhum filtro livre vai ao Progress.

Modo embedded trata atualização, exclusão e falha de releitura após commit sem depender de gridRenderer. Voltar preserva filtros/página/pageSize/sort/group por estado validado da aba, TTL30min/uso único, sem URL livre ou dependência de cache. Guides canônicos docs/crud-formulario-contextual.md e docs/crud-consultas-config.md.

Validação root desta base:379testesPHP/2104asserções sem avisos e oito smokes Edge; logs .runtime/container-panel-core-20261016/verification.log e .runtime/container-panel-frontend-final.log. Revisão independente identificou/corrigiu inconsistência save/runtime, pós-salvar sem grade e perda de filtros ao retornar.

Delta posterior em preparação, ainda sem republicar consulta: rowLinks.position=start/end (defaultend) para tornar Painel visível antes dos dados; cópia1.0.2. Booleanos grade/mobile em Sim/Não, raw/batch preservados. Agente verificou381testes/2113asserções e smokes; root deve conferir antes de publicar1.0.2.

## Financeiro publicado e validado — complemento16/10/2026

- Consulta `ciw.containers` agora está na versão1.0.2: Painel no início da linha, após Ações. Publicação oficial em `.runtime/construtor-pg/container-query-1.0.2-publicacao.json`.
- Painel `ciw.container-painel` versão1.0.1 possui sete abas: Dados, Itens, Despesas, Anexos, Versões Custo, Pagamentos e Notas Fiscais. Novas telas `ciw.container-pagamentos/op1006` e `ciw.container-nfs/op1007` estão publicadas na1.0.1, com títulos corrigidos por nova versão oficial.
- Fonte `motor_progress_container_financeiro`, quatro operações read/get na nova rota `/SursumPrograms/containers-financeiro`. Wrapper `ContainersPainelFinanceRead.p`, serviço e include `ContainerFinancePolicy.i` publicados com backup `/tmp/codex-container-finance-read-20261016/backup-20261016T170939Z`; manifesto `.runtime/container-panel-finance-publish-20261016/active-manifest.json`. Nenhuma mudança em autenticação, configuração existente, schema ou reinício.
- Compilação OpenEdge12.2.12/.42 sem erros. Financeiro139checks/cultura, política10; PASOE25verificações reais: autenticação, read/get, filhos de outro pai, inputs e escritas recusados, mestre preservado. Amostras1525/200019/331126/332526/333426, inclusive empresas1/5 e conexão IMA readonly temporária. Container332526 retornou2pagamentos/1NF.
- PHP real: sete telas contextuais com read/get, obrigatório antesHTTP, isolamento, readonly e consultas anteriores preservadas. Evidência privada `container-panel-runtime-evidence.json`, `container-finance-pasoe-evidence.json`. CUA confirmou abas Pagamentos e Notas Fiscais no container332526,2/1linhas, datas/inteiros/Sim corretos.
- Baseline canônico estável e revalidado pelo root:381testesPHP/2113asserções; smoke Edge position start passou. O candidato de processos ficou isolado após rejeição automática, em `docs/revisao-processos-api-builder.md`; autorização específica solicitada, ainda sem aplicar.
- Usuário confirmou bloquear exclusão enquanto existirem pagamentos ou custos dos itens. Regra deve ser verificada antes de estorno/cascade; não preservar vínculos órfãos do legado.

## Serviços preparados, ainda sem publicação

- FinanceRead: ContainersPainelFinanceReadService.p,139checks/cultura no12.8auxiliar. Pagamentos e NFs; contexto derivado, PKs hash estáveis, chaves reais/deduplicação NF, órfãos explícitos. Wrapper/policy e compilação12.2 pendentes.
- ContainersPagamentoTotalsService.p: helper privado sem rota,27checks/cultura12.8. Regra de total de pagamentos difere dos filtros da grade; ambiguidades de título/valor recusadas.
- ContainersCustoCalculator.p: núcleo puro, última revisão79checks/cultura12.8. Collector ContainersCustoReadService.p:25handles fixos,67checks/cultura12.8, calc_v1, dados/reconciliação ERP e avisos. Ambos precisam compilar12.2 após últimas mudanças. A revisão anterior de77checks compilou12.2, mas NÃO usar seu .r antigo para publicar a revisão atual.
- Fiscal/CRUD cabeçalho/ProcessEngine externo ainda em implementação. Nenhuma operação de manutenção foi habilitada.

Compilação12.2 adicional dos serviços de escrita em `.runtime/container-panel-write-compiled-20261016/`: fiscal73checks/cultura e cabeçalho94checks/cultura, sem erros. Apenas temp-tables; serviços ainda não publicados. Provider concreto fiscal/delete continua em integração. Lote de custos readonly compilou núcleo79/coletor95/fronteira52checks/cultura12.2; revisão independente encontrou reconciliações ERP/vazio a corrigir antes de publicar, portanto seus compilados anteriores não comprovam o código após essas correções.

## Infraestrutura adicional confirmada

Broker de produção .111:espec10012,EMS2CAD10033,EMS2MED10031,EMS2IMA10030,EMS510032. Dicionários reais em integration-src/container-panel/schema/, inclusive subpastas por banco. PF ativo sursum-api/med conecta EMS2MED e EMS5/espec, mas não EMS2IMA. Integração de leitura IMA deve usar conexão temporária fixa readonly com cleanup ou configuração autorizada, sem escolher banco pelo navegador, trocar instância ou alterar PROPATH/autenticação.

Policy IMA sempre por include original sursum-api/includes/parametros_ima.i, sem cache. Não persistir senhas SSH em arquivos. Ferramentas pedem entrada protegida; known_hosts validado. Nenhum commit/push, reseed, reassinatura ou mudança de schema.

Inventários: containers-painel-consultas-inventario.md, containers-painel-regras-inventario.md, containers-painel-financeiro-read.md; proposta original proposta-conversao-painel-containers.md. Fonte adicional de custo cons_itens_container_simul_calc ainda deve ser obtida/analisada antes de sua manutenção.
