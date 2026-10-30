# Página inicial gerencial IOL — conversão em16/10/2026

Tela publicada pelo Builder: **op1012 / iol.inicial-gerencial /1.0.0**.
Endereço: http://127.0.0.1:8765/production/app.html?screenId=iol.inicial-gerencial.
Login local restrito: **tasilpar**, identificador IOL corrigido pelo usuário. A credencial temporária está somente em `.runtime/iol-gerencial/acesso-local-tadeu.json` (nome histórico do arquivo). Não usar senha SSH como senha local.

## Entrega e contratos

Frontend existente `construtor-pg`, AnalyticsEngine e Kendo local, configurado pelos JSONs de `integration-src/iol-pagina-inicial-gerencial/metadata/`. Nenhum frontend paralelo ou alteração em bibliotecas de terceiros. Metas recolhidas inicialmente, indicadores da loja, vendedores ordenados, contagens, competência e10destinos HTTPS. São8links nas listas e2atalhos nos cartões de pedidos. Os destinos legados não foram convertidos nem receberam SSO.

Datasets `resumo` e `vendedores`, entidades `iol_gerencial_resumo_progress` e `iol_gerencial_vendedores_progress`, fonte `motor_progress_iol_gerencial`. Operações POST somente leitura, selecionadas no servidor. O runtime reconstrói a identidade da sessão. Envelope interno de rastreamento é ignorado pelo adaptador e nunca determina entidade/operação externas. Login extra no corpo é recusado.

API sem cache/materialização. Paginação interna de500linhas até o limite declarado, sem truncar silenciosamente na primeira página. Valores monetários são `decimal` com apresentação `c2`; percentuais têm escala0–100. Configuração de cartões/links tem vocabulário fechado, sem scripts/templates livres. Erro limpa os indicadores anteriores; destroy descarta respostas atrasadas.

ABL separado em IdentityService, Collector, Calculator puro e wrapper.20buffers fixos NO-LOCK: os18originais mais `restrs_clientes_usuario` e `repres_restr_cliente_usuario`. Perfil3/hierarquia3 usa dependentes; restrição ativa por representante substitui essa lista. Hierarquia/restrição vazia falha fechada. Perfil3/4 verificado sem escopo restritivo pode usar visão geral conforme legado. Usuário desconhecido/inativo não recebe acesso. Parâmetro `calend_global` lido diretamente a cada solicitação pela include central, sem cache.

Preservados: valor absoluto por componente no faturamento mensal; bases distintas da loja e vendedores; gross-up de desconto em uma rotina compartilhada pelo coletor; devolução arredondada após soma por vendedor; cardinalidade dos joins; estabelecimento/série/NF; calendário comercial e exclusões de pedidos. O calculador aplica os percentuais sem recálculo PHP/JS.

## Evidências observadas

- OpenEdge12.2 no compilador `.42`:7fontes sem `COMPILER:ERROR`;20checks do calculador e14de identidade/coleta por cultura, mais fronteira401 em AMERICAN/EUROPEAN. Logs privados em `.runtime/iol-gerencial/compiled/`. Vendedor comum recebe somente seu indicador individual; o agregado da loja conserva a regra legada.
- PASOE real **sursum-api/med**, `.111`, compartilhamento137 em `/mnt/datasul/ERP/sursum`. Publicação com hashes, backup e troca atômica da rota para lote versionado. Não reiniciou outras instâncias.
- Lote ativo: `sursum-api/programs/iol-gerencial-20261016-v3/`, manifesto `.runtime/iol-gerencial/publish/active-manifest-v3.json`. Backup da rota anterior: `/tmp/codex-iol-gerencial-20261016/backup-20261016T203322Z`. Versões anteriores preservadas; catálogo corrente foi mesclado sem perder rotas de conversões concorrentes.
- Fluxo autenticado PHP→PASOE com `tasilpar`: resumo1linha e vendedores6linhas, HTTP200. Tentativa de login no payload422, outra tela403 e materialização indisponível.
- Fronteira PASOE: token ausente/incorreto401, identidade ausente403, operação de escrita405, login no corpo/recurso inválido422. Nenhum teste escreveu negócio.
- Suíte PHP completa:459testes/2498asserções. DI lint passou; integridade1488registros/0inválidos no momento da verificação, sem reassinatura em lote.
- Smoke do dashboard: datasets deduplicados, mostrar/ocultar, moeda/percentual, XSS, links protegidos, erro,390px e resposta após destroy. Smokes anteriores Analytics demo, Builder analytics validator e render-gate passaram usando Edge e cópias de harness com caminhos locais corrigidos.
- UI publicada: login normal,2grupos,6vendedores,10destinos, competência2026-10, alternância das metas e moeda, sem erro JavaScript; desktop1366px e mobile390px sem overflow. Capturas privadas em `.runtime/iol-gerencial/panel-*.png`.

Sem comparação de valores com sessão legada autenticada: a abertura original não tinha sessão confirmada e mostrou warnings PHP. As fórmulas foram conferidas nos fontes ativos e por fixtures; o aceite operacional usou dados reais pelo painel novo. Não alegar reconciliação contábil independente. Não foram acionados atalhos legados durante testes.

## Segurança, revisão e continuidade

Revisão independente encontrou restrições por usuário omitidas, hierarquia vazia e limite500; correções receberam testes e recompilação/publicação pertinentes. As senhas não constam nos fontes/metadados públicos; fonte cadastrada retorna segredo mascarado, PASOE guarda somente SHA256 do token. Usuário novo tem apenas3permissões de leitura (tela e2fontes), sem grupos administrativos.

A revisão automática bloqueou um probe que exportaria snapshots comerciais ao staging do compilador. Esse probe não foi executado e foi removido; a validação ocorreu pelo fluxo autenticado normal, sem snapshots físicos naquele host.

Não alterar demos/mocks: a skill `construtor-pg-demo-production-parity` exigida pelo AGENTS não estava disponível. Exemplo reutilizável é o próprio pacote de metadados de produção; documentação da extensão no construtor. Preservados diffs concorrentes, rotas e registros anteriores; sem commit/push/schema/reseed. Evidências sem valores comerciais: `.runtime/iol-gerencial/{runtime-verification,boundary-verification,ui-verification}.json`.

## Apresentacao IOL ajustada em17/10/2026

Pedido do usuario: Meta de Faturamento deve abrir expandida e fonte dos cards menor. Publicado pelo Builder/governanca op1012/iol.inicial-gerencial1.0.1; unica mudanca funcional de metadado analytics e collapsed=false no grupo. Preview comparado integralmente contra definicao publicada anterior. Tipografia no tema proprio material-ima.css: titulos/textos/botoes de cards12px e valores20px (antes14/28px). Fonte canonicamente sincronizada; sem mudanca de API/calculos/permissoes/Kendo. Evidencia de publicacao privada .runtime/iol-gerencial/presentation-publication-1.0.1.json. Mantem tema vermelho institucional.

## Nomes dos vendedores em17/10/2026

Pedido do usuario: inicial de cada palavra maiuscula e demais minusculas. Publicado IOL/op1012 versao1.0.2 com labelCase=title no cartao de vendedores. Opcao declarativa reutilizavel da lista, validada como none|title no PHP/JS/schema; usa letras Unicode/acentos e escape de texto, sem alterar nomes armazenados ou API. Exemplo JOSE MARIA -> Jose Maria; JOSE com acento preserva acento. Metas permanecem abertas e tema/fonte reduzida preservados. Testes: PHP493/2848 e smoke frontend com nome acentuado e XSS passaram. Metadados/candidatos sincronizados com guards.
