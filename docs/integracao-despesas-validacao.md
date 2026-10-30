# Despesas e empresas por despesa

Conversão de `grid_despesas`, `form_despesas`, `grid_empresas_despesa` e
`form_empresas_despesa`, publicada em 15/10/2026. Os fontes originais estão em
`D:/opencode/conversao-sc/sources/scriptcase/despesas`. O frontend é o próprio
construtor-pg/Kendo, configurado por JSON, com PHP como intermediário das APIs
Progress. Não existe um frontend paralelo.

## Acesso e metadados

Abrir [Despesas](http://127.0.0.1:8765/production/app.html?screenId=ciw.despesas).
Os comandos Incluir/Alterar abrem o formulário individual. O link **Empresas**
da linha abre a consulta vinculada, já filtrada pela despesa; a inclusão nessa
tela preenche e bloqueia a despesa do contexto. O formulário da empresa usa
listas remotas de empresas, despesas de custo e impostos.

| Tela | Programa | Entidade | Versão |
|---|---|---|---|
| ciw.despesas | cd0092 | despesas_progress | 1.0.1 |
| ciw.empresas-despesa | cd0093 | empresas_despesa_progress | 1.0.1 |

JSONs canônicos:

- `D:/opencode/construtor-pg/integrations/ciw-despesas/{api-source,builder-draft}.json`
- `D:/opencode/construtor-pg/integrations/ciw-empresas-despesa/{api-source,builder-draft}.json`

Cópias/fontes de geração em `integration-src/despesas` e
`tools/construtor-local/build-despesas-metadata.ps1`, neste workspace.
`import-despesas.ps1` usa as APIs oficiais de fonte, entidade, rascunho,
governança, locks, testes, aprovação e publicação. A importação inicial já foi
concluída. Para uma alteração futura, preparar uma versão nova no JSON e usar
`-NewVersion`, ou retomar somente um rascunho com `-ResumeVersionId`.
`-RefreshBindingOnly` atualiza o vínculo da entidade, sem regenerar a definição
de uma tela já publicada. Não repetir a importação inicial sobre os códigos.

## API e substituição manual

Fonte cadastrada: `motor_progress_despesas`. Operações
`despesas_read/get/create/update/delete`,
`empresas_despesa_read/get/create/update/delete` e opções
`opcoes_despesas`, `opcoes_empresas`, `opcoes_impostos`, `opcoes_custo`.
Todas usam POST `/SursumPrograms/despesas`, com `resource` e `operation`
fixados no corpo do catálogo. Contrato `sursum-programs`: listas em `data:[]`,
registro em `data:{}`, exclusão em `data:true`; erros têm código/mensagem/status.

Para substituir uma operação por uma API manual: cadastrá-la nessa fonte ou
em uma nova fonte; atualizar os códigos de operações do vínculo da entidade;
salvar novamente a entidade, pois o vínculo guarda um snapshot; gerar e
publicar nova versão do programa quando houver alteração dos campos/da tela.
As listas de opções também são referenciadas pelos códigos do catálogo.
Não colocar URL, token ou código executável no JSON enviado ao navegador.

O PHP envia tanto `id` quanto o alias da chave em get/update/delete. O serviço
aceita o alias apenas se for igual ao id; inclusão não aceita chaves fornecidas.

Progress canônico:
`D:/opencode/motor-progress/v2/sursum-api/programs/DespesasCrud.p` e
`DespesasCrudService.p`. Wrapper autenticado por `X-Despesas-Token`; segredo
somente em `.runtime/construtor-pg/despesas-connection.json`, hash no PASOE em
`sursum-conf/despesas-api.json`. Buffers e tabelas são fixos no backend.

## Regras preservadas

- Despesas têm seleção múltipla de bases (`md_relacs_desp`), sincronizada em
  `relacs_desp_calculada`. Calculada controla a visibilidade dos campos de
  cálculo e bases; ocultar não apaga valores.
- Vínculos têm seleção múltipla de impostos (`impostos`), sincronizada em
  `despesas_impostos` pelo par empresa/despesa. Opções de imposto usam somente
  `log_imposto=1`; opções de custo usam `log_imposto=0`. A própria despesa é
  excluída das opções que não podem referenciá-la.
- Os INTEGER de flags continuam 0/1 e aparecem como Não/Sim. Inteiros não
  recebem casas decimais. Valores padrão são 0/false; limpar um numérico
  opcional resulta em zero; omitir preserva. `perc_custo` legado é preservado
  na alteração e não é aceito como entrada.
- O dicionário real define **perc_calculo=2, vl_padrao=2, percentual=2,
  percentual_custo=4 casas**. O formulário original aceitava quatro casas nos
  dois primeiros percentuais, mas o banco arredondava para duas. A nova tela
  usa a precisão física e a API recusa excesso antes de atribuir, sem mudar
  schema. Conversão de números independe de SESSION:NUMERIC-FORMAT.
- Percentual de custo e despesa de custo dependem um do outro. Não foi criada
  regra de percentual máximo100 nem reproduzida a função morta
  `localValidarValoresImposto`, que não é chamada pelo formulário original.
- Empresa e despesa do vínculo são imutáveis após inclusão, evitando deixar
  relações do par antigo órfãs. Duplicidade empresa+despesa é recusada.
- Exclusões verificam vínculos, despesas de compra/container, histórico de
  custo, referências de impostos e bases. Mudar a classificação imposto/não
  imposto é recusado se invalidar referências existentes de imposto/custo.

Registro principal e coleções são gravados em **uma transação Progress**,
com EXCLUSIVE-LOCK NOWAIT, validação estrita e rollback integral. `[]` limpa
a coleção; até100 IDs positivos distintos; null/tipos incorretos são recusados.
O contexto de navegação filtra e preenche a tela; permissões runtime continuam
responsáveis pelo acesso. Não há regra adicional inferida de ciclo indireto.

## Publicação e validação

Compilador OpenEdge12.2.12 no .42, runtime12.2.17 no .111,
instância **sursum-api/med**. Quatro fontes sem COMPILER:ERROR;156 verificações
ABL em cada formato AMERICAN/EUROPEAN; seis consultas de smoke somente leitura
com buffers reais. Compilados12.8 auxiliares não foram publicados.

Artefatos finais e logs em `.runtime/despesas-precision-compiled-20261015`.
Publicação em `/mnt/datasul/ERP/sursum/sursum-api/programs`, manifesto em
`.runtime/despesas-precision-publish-20261015/manifest.json`; backup remoto
`/tmp/codex-despesas-precision-20261015/backup-20261015T194950Z`.
O publicador exige hashes da publicação anterior antes de substituir.
Não houve reinício, mudança de schema ou de triggers.

Testes operacionais neste workspace:

- `verify-despesas.cjs`: CRUD real PHP→PASOE, seleção/limpeza de coleções,
  dependências, duplicidade, chaves imutáveis, rollback e precisão física.
- `verify-despesas-ui.cjs`: formulários Kendo, link contextual, opções remotas,
  inclusão de vínculo, seleções múltiplas e condições dos campos.
- `verify-despesas-identity.cjs --require-runtime`: monitor PASOE confirma
  usuário autenticado admin, agente, instância, PID e duração; valores de
  usuário forjados no navegador não substituem a identidade autenticada.
- `inspect-despesas-audit.php`: consulta registros de sucesso e falha nas
  transações PHP, sem imprimir payloads.

Os testes usam somente registros próprios novos e removem vínculos, coleções
e despesas ao terminar. Evidências e imagens ficam no runtime privado.
As51 despesas e50 vínculos anteriores são a referência de preservação.
Os cadastros de empresas e tipos de anexo não são alterados por esses testes.

Resultado final: CRUD HTTP e UI passaram; todas as seleções/condições foram
validadas, sem erros JavaScript. Limpeza comparou integralmente as51 despesas
e50 vínculos anteriores. Regressão visual de empresas passou com3 registros,
sem salvar; leitura de tipos de anexo confirmou20 registros. Monitor confirmou
admin/agent-3/sursum-api/PID/duração; auditoria registrou sucesso e falha.
`lint:container` passou; integridade final **1095 registros/0 inválidos**.
`despesas-release-evidence.json` confirma versões internas8 (cd0092) e7
(cd0093), ambas1.0.1, pela consulta oficial `getProgram` que verifica assinaturas.
Não houve commit/push ou mudanças nas bibliotecas Kendo/vendor/demos/mocks.

## Correção de publicação de versões

A validação encontrou um defeito pré-existente no construtor: publicar uma
segunda versão arquivava a anterior sem atualizar sua assinatura e retornava
409 depois de persistir a publicação nova. O fluxo agora verifica as versões
antes das mutações e assina o arquivamento oficial com a versão sucessora.
Regressões com StructuralIntegrityService real em memória passaram;
suíte completa263 testes/1255 asserções.

O incidente afetou exclusivamente `builder_program_version#5` (cd0093/1.0.0),
substituída pela versão#7/1.0.1. O guard
`check-despesas-archive-recovery.php`, somente leitura, comprovou a assinatura
completa anterior em clone com status published, sucessora/tela íntegras e
única divergência status archived. Somente depois foi usado o comando oficial
de reassinatura restrito ao registro5, com motivo registrado. A versão7 já
estava publicada e não foi republicada. Não reassinar registros sem diagnóstico.

Memória principal: `D:/opencode/conversao-sc/context/PROJECT_CONTEXT.md`.
