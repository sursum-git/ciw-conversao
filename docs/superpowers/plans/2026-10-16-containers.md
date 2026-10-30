# Consulta de containers e proposta do painel

Pedido autorizado: converter a consulta de containers usando o frontend existente por metadados e APIs Progress; apresentar uma proposta para os programas do primeiro botão. Não converter nem executar os processamentos do painel nesta entrega. Nenhum commit/push.

## Identificação pelos fontes

`grid_pp_container` tem título Container's e começa pelas ações Painel/Vendas. Painel passa `nr-container` como `container_id_corrente` e `container_corrente` à `bl_ponte_painel_container`, que abre `menu_container`. `grid_containers` é outra consulta simples de datas, cujo primeiro botão é Detalhes; `cons_pp_container_filtro_fornecedor` é uma consulta contextual de fornecedor, com Painel ao final. Foi solicitada confirmação opcional da URL; enquanto não houver correção, a evidência de código identifica `grid_pp_container` como alvo.

## Entrega da consulta

- Tela `ciw.containers`, programa `op1000`, módulo operacional já existente, entidade API `containers_progress`, versão1.0.0. Código livre confirmado no bootstrap oficial.
- Consulta e detalhe somente leitura de `espec.pp-container`:20campos da origem, sem alteração de tabelas nem importação de dados para PostgreSQL. PK pública `container_id` representa `nr-container`. Situação de acompanhamento vem de `espec.situacoes_container`; nomes de agente/armador de `ems2cad.emitente`.
- API nova `POST /SursumPrograms/containers-consulta`, operações fechadas read/get, token privado `X-Containers-Token`, configuração remota somente hash. Wrapper com buffers fixos; serviço testável por handles/temp-tables. Leitura NO-LOCK, sem SQL livre ou alteração dos registros. Router existente registra execução/identidade.
- Datas DATE são ISO/nullable; flags lógicas permanecem boolean; inteiros sem casas decimais e cotações com5casas, conforme dicionário real. Preservar lookup legado sem inventar regra para o valor2 de ind_dt_prev_chegada.
- Grade com12campos visíveis da origem,8ocultos configuráveis no Leiaute,11filtros e30linhas. Agrupar por situação ERP/acompanhamento; número como desempate estável. Formulário de visualização nativo, sem links para programas ainda não convertidos. Painel/Vendas/Novo Container e descendentes estão no documento de proposta.
- Gerador atual limita6colunas/5filtros/20linhas. Acrescentar opções declarativas genéricas e fechadas para consultas, validadas contra a entidade e preservadas no builder; defaults anteriores intactos. Suporte opcional a grupo inicial com precedência para preferências explícitas do usuário. Não alterar Kendo/vendor/demos/mocks.

## Verificação e publicação

- [x] Obter fontes e identificar consulta/caminho do primeiro botão.
- [x] Ler dicionário real de pp-container e situacoes_container no12.2/.42; chaves, tipos e escala conferidos. PF do runtime confirma ems2cad/espec; montagem137confirmada.
- [x] Serviço/testes ABL temp-table, RED/GREEN e ambas culturas:218verificações por cultura.
- [x] Opções de consulta no builder e testes PHP/frontend:339testes/2035asserções PHP e nove smokes finais Edge.
- [x] Compilar no12.2/.42; publicar apenas wrapper/serviço/configuração e nova rota mesclada, com backup/hash e rota por último.
- [x] Cadastrar fonte/entidade/programa por APIs oficiais, locks/governança/testes/aprovação/publicação.
- [x] Validar PASOE e PHP reais somente leitura, tipos/lookup/paginação/filtros, autenticação e recusa de escrita:2393registros preservados.
- [x] Verificar UI nativa,20colunas/8inicialmente ocultas,30linhas, agrupamentos, diálogo de leiaute cancelado, detalhe331126 e regressões das quatro telas anteriores. Nenhum leiaute do usuário foi salvo.
- [x] Registrar evidências sanitizadas, manifesto ativo, memória e proposta do painel. Guia docs/integracao-containers-validacao.md.

Root possui SSH/publicação/importação/validação operacional. Agentes independentes possuem serviço ABL/testes, opções genéricas/metadados e proposta documental. Preservar alterações anteriores dos três projetos. Artefatos12.8locais são exclusivamente teste isolado e nunca devem ser publicados.
