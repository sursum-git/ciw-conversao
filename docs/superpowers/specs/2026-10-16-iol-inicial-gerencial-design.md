# Conversão da página inicial gerencial IOL

Data: 16/10/2026. Estado: desenho aprovado pelo usuário com “ok.”; plano escrito para revisão; implementação e publicação pendentes.

## Objetivo e decisões aprovadas

Converter `https://imaonline.imatextil.com.br/iol/bl_pag_ini_ger/` em programa do construtor-pg, mantendo metas, indicadores, vendedores e atalhos. Usar frontend existente e metadados JSON; preservar Kendo/vendor. Não converter os programas de destino dos atalhos nesta entrega.

O usuário aprovou esse escopo e determinou que o login autenticado do construtor seja o mesmo login do IMA. Essa decisão não cria usuários nem atribui perfil gerencial ao admin local. A sessão autenticada é a única origem da identidade. Login sem correspondência IMA ativa ou perfil necessário recebe erro de acesso, sem fallback para visão geral.

## Evidência de origem

Fontes copiados por SFTP, sem executar PHP, para `sources/scriptcase/iol/bl_pag_ini_ger/`. Manifesto com SHA-256: `integration-src/iol-pagina-inicial-gerencial/source-manifest.json`. Evento ativo: `index.php:6184`, onExecute; helpers incorporados no mesmo arquivo. Inventário: `integration-src/iol-pagina-inicial-gerencial/levantamento.json`.

A abertura pelo navegador não confirmou sessão IMA e mostrou `Undefined variable: fatTotLiq` e `Undefined variable: metaQuinz`. Zeros e percentuais dessa abertura não são referência de validação. O novo programa deve distinguir ausência de dados, zero real, falha de consulta e acesso negado.

## Alternativas e escolha

1. **Estender AnalyticsEngine existente por capacidades declarativas reutilizáveis — escolhido.** Reutiliza dashboard/Kendo TileLayout, shell, autenticação, carregamento e gateway do construtor. Precisa de fonte API em tempo real e tipos fechados de cartão para esta composição.
2. CRUD somente leitura com abas: já cobre consultas API, mas troca a composição de painel por formulário/grade e prejudica a equivalência de uso.
3. CustomPage/iframe: o motor existe, mas exigiria uma página manual específica ou conservaria o PHP legado; não atende a conversão por metadados pretendida.

O AnalyticsEngine atual renderiza KPI e gráfico em dashboard. A fonte analytics atual aceita entidade/pipeline; não presumir que isso já resolve APIs externas com escopo por usuário. Implementar a extensão no motor canônico, sem criar outra entrada HTML/JS específica para o IOL.

## Fluxo e responsabilidades

`production/app.html?screenId=iol.inicial-gerencial` → AnalyticsEngine → endpoint runtime autorizado → operação de fonte API cadastrada → RuntimeExternalJsonClient → PASOE `sursum-api/med` → wrapper e serviços Progress somente leitura.

- **AnalyticsEngine e validador/schema:** cartões declarativos de indicador/progresso, lista ordenada de vendedores e links; bloco de metas recolhido inicialmente, com botão mostrar/ocultar e aria-expanded. Tema, números pt-BR, mobile e teardown seguem os componentes existentes.
- **Runtime analytics:** novo tipo fechado de dataset API registrado. Resolver fonte/operação no servidor; aceitar apenas leitura. Reutilizar transporte, segredos, contratos e auditoria existentes. Não receber URL, cabeçalhos, SQL ou credenciais do navegador. Não materializar ou compartilhar cache desse dataset entre usuários; usar execução live nesta entrega.
- **Identidade:** reutilizar a sessão autenticada e os cabeçalhos confiáveis do transporte Sursum. Conferir se o identificador encaminhado representa login; se for ID interno, resolver o login no backend antes do transporte. Nunca confundir ID PostgreSQL com usuário/representante Progress. Remover/recusar tentativa de substituir identidade pelo payload ou metadados.
- **Wrapper Progress:** validar token próprio da integração, operação, recurso e envelope; consumir identidade confiável do roteador; devolver contrato Sursum. Reutilizar log operacional existente, sem criar histórico paralelo.
- **Serviço de identidade/acesso:** localizar user-web ativo, tipo de usuário, grupo de vendedores, representante e hierarquia, por login. Escopos derivados exclusivamente no servidor.
- **Coletor e calculador:** coletar uma vez por solicitação e calcular em rotina reutilizável. Wrappers e cartões não repetem regras. Buffers/tabelas fixos e NO-LOCK. Parâmetros pela include `sursum-api/includes/parametros_ima.i`, leitura direta sem cache.

## Composição visual e navegação

Manter títulos e agrupamentos funcionais da origem:

- Meta de Faturamento: meta mensal/quinzenal, faturado líquido e percentual; valores ocultos inicialmente.
- Metas Loja: percentual vendido, percentual ideal e dias úteis restantes.
- Vendedores: nome abreviado e percentual, em ordem decrescente.
- Avaliação Gerencial e Pedidos Em Aberto: contagem e atalho.
- Tabelas de Preços: Estoque e Programado.
- Rastreamento de Pedidos, Novidades e Promoções, documentos PAC_/RNC, Materiais de Apoio e Item Certificação.

Links são declarados por identificador fechado, com destino HTTPS cadastrado no servidor para o host IMA. Nenhum destino é fornecido por consulta API, querystring ou campos dos registros. Links externos abrem com proteção de opener; não encaminhar sessão/token do construtor. Navegação ao legado pode exigir sua própria sessão e não cria SSO. Mostrar/ocultar é uma opção de apresentação, não substitui autorização.

## Contrato de leitura

Rota proposta: POST `/SursumPrograms/iol-inicial-gerencial`. Nome final sujeito a conferência de colisões no catálogo antes do cadastro, preservando rotas existentes.

Corpo fechado: `operation=read`, `resource=resumo|vendedores`. Data de referência é a data corrente do servidor na competência comercial; não aceitar representante, perfil, lista gerencial, estabelecimento, banco ou login do navegador. O backend repassa apenas filtros de apresentação permitidos depois de obter dados já autorizados. A API fornece data/competência usada no cálculo.

Sucesso: `success=true`, `data` como array de registros tipados. Falha: `success=false`, `error={code,message,status}`. Nenhum detalhe de conexão/consulta/credencial na resposta.

`resumo`: uma linha com `id`, `competencia`, `data_referencia`, `meta_mensal`, `meta_quinzenal`, `faturamento_liquido`, `percentual_meta`, `percentual_loja_vendido`, `percentual_loja_ideal`, `dias_uteis_mes`, `dias_uteis_passados`, `dias_uteis_restantes`, `pedidos_avaliacao`, `pedidos_abertos`.

`vendedores`: `representante_id`, `nome_abreviado`, `percentual_vendido`. Retornar somente campos necessários ao painel, com escopo equivalente ao perfil autorizado; não expor tabelas de usuários ou listas de permissões. Contagens e dias são inteiros; valores monetários são decimais; percentuais são números; desconhecidos não viram zero silenciosamente.

Erros fechados para identidade ausente/inválida, acesso negado, parâmetro/calendário inválido, consulta indisponível e dados inconsistentes. Falha não produz cartões com zero nem preserva números do usuário anterior.

## Regras a preservar

| Indicador | Regra confirmada no evento/helper ativo |
|---|---|
| Faturamento mensal | fats_repres ligado a transacoes com ind_sit_transacao=1, mês/ano corrente e estabelecimentos 5/505; faturamento menos devoluções; respeitar lista/representante do perfil |
| Meta mensal/quinzenal | metas_repres, metas_gerencial ou metas_geral conforme tipoUsuario e hierarquia; manter a escolha da origem |
| Meta loja | getMetasGerentes(11130,mês,ano) / 2 |
| Vendido loja | vendas MED do conjunto de vendedores; o evento ativo usa total de vendas sem subtrair devoluções nesse percentual |
| Percentual vendedor | (venda + descontoVenda - devolução - descontoDevolução) / meta × 100; arredondamento inteiro; ordem decrescente |
| Dias úteis | segunda a sexta e dia_calend_glob.log_dia_util=1 no calendário definido por calend_global; dia corrente integra dias passados |
| Meta ideal loja | proporção de dias úteis passados sobre dias úteis do mês; recusar calendário inconsistente/divisor inválido |
| Avaliação gerencial | peds_web.ind_sit_ped_web=8, com escopo de login/lista gerencial |
| Pedidos abertos | MED ped-venda com ped-repre; situação fora de 3/6; PE completo ou PI; excluir representante fulano; preservar cardinalidade do join legado |

As rotinas de notas/devoluções usam joins com representantes, naturezas, pedidos e regras entre empresas. A implementação deve seguir a cadeia efetivamente chamada (`getTotVendNfMes`/`getTotDevNfMes`, padrão por representante), conferir campos/índices físicos e registrar qualquer diferença necessária antes de publicar. Não trocar pela função alternativa sem ped-repre apenas por ser mais simples.

Não reproduzir warnings PHP. Inicializar saídas explicitamente e bloquear perfil não suportado. Não corrigir silenciosamente fórmulas de negócio ou ampliar escopo gerencial quando faltar configuração. A lista de vendedores do legado é global por grupo ativo: verificar autorização dessa visão no resolvedor do perfil, sem presumir que qualquer login a pode obter.

## Arquivos e limites da mudança

Conversão: fontes preservados; novos serviços/testes e metadados sob `integration-src/iol-pagina-inicial-gerencial/`; ferramentas de compilação/publicação/verificação em `tools/construtor-local/`; evidências privadas em `.runtime/`.

Construtor canônico: AnalyticsEngine, validação/schema e geração Builder de opções analytics, runtime analytics para dataset API registrado, transporte/identidade apenas onde houver necessidade comprovada, testes e documentação correspondentes. Atualizar exemplos pertinentes; seguir paridade demo/produção exigida pelo AGENTS canônico. Não editar kendo/vendor ou definições assinadas manualmente.

Motor canônico v2: wrapper, serviços reutilizáveis e testes específicos; catálogo mesclado pelo fluxo de publicação com backup/hashes. Novos identificadores e programa alocados pelo catálogo oficial, sem colisões/reseed. Não alterar schema de negócio, parâmetros existentes ou processos do painel de containers. Preservar todos os diffs anteriores.

## Validação e publicação

1. Testes de contrato do dataset API e identidade: tentativa de falsificar login/perfil/lista recusada; usuário não vinculado, inativo e sem permissão bloqueados. Demonstrar que dois usuários com escopos diferentes não compartilham dados/cache.
2. Fixtures ABL para perfis, hierarquia, ausência de dados, zero/negativo, metas, arredondamento, devoluções/descontos, cardinalidade de joins, calendário e contagens. Fórmulas comparadas com referências obtidas dos fontes ativos.
3. Compilação OpenEdge 12.2 no `.42`, com logs de COMPILER:ERROR e testes nas culturas AMERICAN/EUROPEAN. Nenhum .r 12.8 publicável.
4. Publicação restrita com manifesto, baseline/backup e hashes; validar na instância sursum-api/med no `.111`, sem fallback. APIs exclusivamente de leitura; não consumir sequências ou criar registros de negócio.
5. Conferência real de resultados para login IMA autorizado fornecido pela sessão do construtor. Admin local sem vínculo deve ter bloqueio validado, não ser usado para simular gerente. Referência somente leitura e competência registrada; não alegar equivalência usando abertura sem sessão do PHP.
6. Publicar metadados pelo Builder/governança, com permissões pertinentes, sem manipular assinaturas. Verificar no navegador mostrar/ocultar, atalhos, contagens, moeda/percentuais, ordenação de vendedores, mobile, tema e falhas, sem salvar preferências inadvertidamente.
7. Rodar regressões pertinentes do AnalyticsEngine, runtime/gateway e telas existentes afetadas. Atualizar contexto com estados separados de preparado, compilado, publicado e validado. Sem commit/push conforme decisão vigente do projeto.

## Dependências operacionais

Credencial do servidor Scriptcase foi usada por entrada protegida apenas para cópia. Acesso ao compilador `.42` e runtime `.111` precisa estar disponível por chave/sessão ou entrada protegida antes da fase remota; não supor que a credencial Scriptcase valha nos outros hosts. A especificação não altera autenticação, permissões de infraestrutura ou valores de parâmetros.

Critério de aceite: painel publicado no construtor com dados reais equivalentes para usuário autorizado, escopo isolado, indicadores e atalhos utilizáveis, e evidências de 12.2/PASOE/interface. Este documento e os fontes copiados não constituem entrega publicada.
