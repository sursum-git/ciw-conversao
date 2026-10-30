# Consulta de containers convertida

Data:16/10/2026. Tela [ciw.containers](http://127.0.0.1:8765/production/app.html?screenId=ciw.containers), programa **op1000**, versão **1.0.0**, módulo **operacional**, entidade API **containers_progress**. A consulta e o detalhe nativo são somente leitura; os programas do Painel estão na [proposta de conversão](proposta-conversao-painel-containers.md).

## Origem e dados

Aplicação identificada pelos fontes: `grid_pp_container`, título Container's. Primeiro botão **Painel**, segundo **Vendas**. `grid_containers` é outra consulta de seis campos e não chama o painel; a consulta contextual de fornecedor também é outra aplicação. Foi solicitada confirmação opcional da URL; a evidência inequívoca da ordem/destino dos botões fundamenta a escolha de grid_pp_container.

Fontes copiados somente para análise de `/var/www/clients/client1/web2/web/ciw` no192.168.0.170 para `sources/scriptcase/containers/`. Não foram abertos programas de processamento do Scriptcase nem executadas suas escritas. Inventário detalhado em `integration-src/containers/scriptcase-analysis.json`.

Tabela real **espec.pp-container**, chave primária única `nr-container`/índice `indice1`. A chave pública JSON **container_id** representa esse número. Não confundir com `containers.container_id`. Dicionários reais em `integration-src/containers/schema-pp-container.json` e `schema-situacoes_container.json`, obtidos no12.2/.42.

Vinte campos físicos da consulta e três campos de apresentação. Hífens físicos viram underscore no JSON, exceto a chave acima. Cinco campos DATE são ISO `YYYY-MM-DD` ou null, flags `exclusivo`/`log_pagto_final` são boolean, `cod_estabel` e `nome_ab_forn` são texto. Cotações compra/venda possuem **5casas físicas**, embora o FORMAT legado mostre6. Inteiros continuam sem casas decimais.

Situação ERP mantém1Aberto/2Suspenso/3Fechado. Acompanhamento usa `espec.situacoes_container.descricao`, com “Não Informado” no ausente. Agente/armador usam **ems2cad.emitente**, `nome-abrev + '-' + nome-emit`, com códigos brutos separados. As conexões ems2cad/espec foram confirmadas nos PF do PASOE e exercitadas pela API real. O caso legado de `ind_dt_prev_chegada=2`, cujo PHP comparava vazio no segundo lookup, não foi reinterpretado como uma regra nova.

## API e publicação

`POST /med/web/SursumPrograms/containers-consulta`, pelo túnel local19910 da instância **sursum-api/med**. Corpo `{ "operation":"read" }` retorna `{success:true,data:[...]}`. Corpo `{ "operation":"get", "id":331126 }` retorna objeto em data. ID positivo int32; alias `container_id` pode acompanhar id se forem iguais. Falhas têm `{success:false,error:{code,message,status}}`. Nenhuma operação de escrita é aceita.

Wrapper **ContainersConsulta.p** usa buffers fixos de pp-container/situacoes_container/emitente e exige **ContainersConsultaService.r**. Token independente no header **X-Containers-Token**. Segredo somente no arquivo privado `.runtime/construtor-pg/containers-connection.json`; remoto `sursum-conf/containers-api.json` contém apenas SHA-256. Nunca copiar esses conteúdos para documentação. Catálogo do construtor mascara a credencial; navegador não a recebe.

Lista completa, NO-LOCK, ordenada por situação/acompanhamento/número; filtro, ordenação e paginação no PHP seguem o contrato existente das entidades API. Para2393registros foi validado o conjunto inteiro. Não foi implementada paginação remota nova nem SQL/ABL escolhido pelo navegador.

Compilação **OpenEdge12.2.12** no192.168.0.42:wrapper, serviço e teste com COMPILER:ERROR=no; **218verificações em cada AMERICAN/EUROPEAN**. Os testes12.8locais serviram apenas ao RED/GREEN e seus .r nunca foram publicados. Artefatos efetivamente publicados em `.runtime/containers-compiled-20261016/`. Runner/testes não foram publicados no PASOE.

Publicados somente wrapper/serviço `.p/.r`, hashconfig e nova rota mesclada no catálogo, em `/mnt/datasul/ERP/sursum`/compartilhamento137. Backup `/tmp/codex-containers-20261016/backup-20261016T151228Z`. Manifesto ativo **`.runtime/containers-publish-20261016/active-manifest.json`**. Sem reiniciar/recarregar instância, mudar autenticação, schema, PROPATH global ou outras rotas. Não repetir publicação inicial se os destinos já existirem: revisar manifesto/hash antes de qualquer substituição.

Fontes canônicos no motor-progress/v2, `sursum-api/programs/ContainersConsulta{,Service}.p`; testes em `tests/abl/containers/`. Ferramentas neste workspace: `compile-containers.ps1`, `publish-containers.py` e `containers-remote-task.py`. SSH pede senha no terminal e mantém somente em memória; usa known_hosts existente, sem aceitar chave nova automaticamente.

## Frontend por metadados

Metadados canônicos: `D:/opencode/construtor-pg/integrations/ciw-containers/{api-source,builder-draft}.json`; cópias de análise em `integration-src/containers/`. Fonte **motor_progress_containers**, operações read/get e contrato sursum-programs.

O gerador padrão tinha limite6colunas/5filtros/20linhas. O contrato genérico fechado **programDraft.crudOptions** acrescenta `pageSize`, `gridFields`, `filterFields`, `defaultSort` e `defaultGroup`, validados contra a entidade, persistidos/exportados e preservados ao editar. Não há patch direto de generatedDefinition, código livre no JSON ou frontend paralelo. Defaults anteriores ficam intactos quando a opção é omitida. Documentação canônica `docs/crud-consultas-config.md`.

Consulta configurada com **20colunas**, **12visíveis e8ocultas**, **11filtros**, **30linhas** e agrupamento inicial por situação/acompanhamento. Leiaute/preset do usuário, inclusive agrupamento vazio explícito, tem precedência; envelope padrão do backend não é confundido com preferência. Seletor de paginação inclui30. Formulário nativo de visualização mostra os23campos autorizados e Logs por registro. Não há botões de inclusão/alteração/exclusão ou link para um Painel ainda não convertido.

Fonte/entidade/programa cadastrados pelas APIs oficiais de builder, com locks, grant de edição/publicação, bundle de testes e aprovação. Versão interna **9**, aprovação **8**, grant **12** revogado ao concluir. Evidência privada `containers-publicacao.json`. Não reimportar op1000 como programa novo; futuras alterações usam nova versão pelo fluxo oficial. Nenhuma tabela interna foi alterada diretamente, nenhum seed/reassinatura foi executado.

## Validação

- PHP completo: **339testes/2035asserções**; nove smokes Edge finais do core/formatação/logs/edição em lote/páginas ligadas, além dos testes focais das opções novas.
- API PASOE real: **2393registros/23campos tipados**, detalhe igual à lista, token ausente/incorreto recusados, IDs inválidos/conflitantes recusados, inexistente404 e operações create/update/delete/batch recusadas.
- PHP/runtime real: metadados corretos e segredo oculto, filtros por número/situação e paginação sem sobreposição, detalhe e404 corretos. Leitura de Empresas/Tipos/Despesas/Empresas por despesa preservada. Hash do conjunto de containers igual antes/depois das verificações.
- Integridade após publicação: **1119registros/0inválidos**.
- Interface real: grade carregada com2393registros,30por página, agrupamentos nomeados e cotações com5casas. Detalhe do container331126 confirmou previsão de chegada15/01/2027, embarque01/12/2026, zero como0,00000 e flags Sim/Não. Nenhum deslocamento de DATE por fuso. Formulário somente leitura, Logs por registro e retorno à consulta conferidos.
- Monitor real confirmou execução EXE-20261016-044538-559411, usuário admin, instância sursum-api, agente agent-2, PID3856625 e duração780ms. Consultar pelo monitor PASOE e ID de execução, sem atribuir autoria da sessão atual a históricos antigos.

O renderer genérico foi ajustado para respeitar precisão numérica declarada (inteiros continuam sem casas), preservar datas sem horário no calendário local, apresentar booleanos em português no detalhe e usar o rótulo do dataModel em grupos cujo código não é uma coluna visível. Testes reais Kendo em UTC-3 cobrem esses casos. A seleção de colunas usa o menu nativo da grade; o diálogo Salvar novo leiaute recebe nome/default e não deve ser descrito como seletor de campos.

Evidências privadas em `.runtime/construtor-pg/containers-{pasoe,readonly}-evidence.json`; logs em `.runtime/containers-core-20261016/`. Testes `tools/construtor-local/verify-containers.cjs [--pasoe-only]` não criam registros de negócio; somente sessões próprias e auditoria técnica normal. Nenhum registro preexistente foi alterado ou excluído. Sem commit/push.

## Proposta dos programas do primeiro botão

O caminho ativo é **grid_pp_container → bl_ponte_painel_container → menu_container**, cuja entrada é **form_pp_container**. `bl_painel_container` é alternativo e não participa desse encadeamento. A proposta reúne Dados, Resumo, Itens, Despesas, Pagtos, NFs, Anexos, Versões de custo, cálculo de imposto, comparativos, rastro do dólar e retorno.

Recomendação: uma tela de container com contexto obrigatório e abas nativas; filhas por linkedPage/APIs, processamentos explícitos via ProcessEngine, auditoria transacional com usuário/anterior/atual nos serviços de escrita. O legado executa gravações ao abrir Atualizar Cálculo Imposto, e Dados pode reparar logs antigos na entrada; esses efeitos não devem ocorrer no carregamento de uma consulta. Anexos e cálculos possuem dependências próprias e precisam de validação antes de afirmar paridade. O documento de proposta enumera seis fases e os pontos que ainda exigem análise de fontes descendentes. Nada desse painel foi implementado nesta etapa.
