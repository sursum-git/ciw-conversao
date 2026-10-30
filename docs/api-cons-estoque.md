# Consulta de estoque por JSON

Programa `http-api/api_cons_estoque.p`, no mesmo contrato de entrada e saída `JsonObject` da consulta de notas fiscais.

Fluxo: JSON → `EstoqueJsonParser.p` → `EstoqueUsuarioEscopo.p` → `esbo/clienteSaldoPV.p` → `esbo/boSaldoPV.p` → JSON da resposta. Não cria pesquisa nem grava resultados em `wp` ou tabelas filhas. O PHP pode persistir os arrays no outro banco após receber sucesso.

## Chamada

`POST https://192.168.0.111:9911/med/web/SursumPrograms/consulta-estoque`

Cabeçalho `Content-Type: application/json`. Enviar o objeto diretamente, sem envelope `parameters` ou nome de programa:

```json
{
  "login": "tasilpar",
  "empresa": "5",
  "pesquisaItem": "175182",
  "buscarPE": true,
  "buscarPI": true,
  "consultaReferencias": true,
  "minimoMT": 2,
  "selecaoReferenciasAtiva": true,
  "selecoes": [
    {"tipo": "REF", "codigo": "A01"}
  ]
}
```

`pesquisaItem` aceita a sintaxe da BO para código ou descrição. Para a listagem principal, omitir `consultaReferencias` ou enviar `false`; para filtros internos por referência, enviar `true`. A API preserva o cálculo da BO, inclusive a decisão de não reproduzir o saldo complementar do PHP sem os filtros originais.

## Parâmetros

Todos os campos de `ttFiltroSaldoPV`, da include `esbo/boSaldoPV.i`, são aceitos na raiz **exceto `tipoUsuario` e `representante`**. Estes são resolvidos por leitura `NO-LOCK` de `espec.user-web` e, para tipo 2, `ems2cad.repres`, seguindo o cadastro usado pela API de notas. Usuário ausente, tipo desconhecido ou representante tipo 2 inválido retornam erro. Login é obrigatório; aliases `usuario`, `userName`, `requestUser` também são aceitos, desde que não divirjam. O PHP deve informar o login do usuário que autenticou: este campo não autentica uma pessoa.

Campos omitidos conservam os valores iniciais da include, incluindo empresa `5`, itens e famílias de `""` até `"zzzzzzzzzzzzzz"`, grupos 50 a 60, PE/PI e exibição de ambos habilitados, mínimos zero e limites decimais opcionais desconhecidos. Número zero e texto vazio recebidos são valores explícitos, não são substituídos por defaults.

- Textos JSON para campos `CHARACTER`; códigos mantêm zeros à esquerda.
- Números JSON para `INTEGER` e `DECIMAL`; inteiros não aceitam fração nem expoente. Decimais usam ponto, independentemente da cultura da sessão ABL.
- Booleanos JSON `true`/`false` para `LOGICAL`; strings e 0/1 são recusados.
- `null` somente em `gramaturaIni/Fim`, `pesoLiquidoIni/Fim`, `maximoKG/MT`, para limite aberto.
- Campos desconhecidos ou mal tipados retornam erro, inclusive dentro de `selecoes`.

`selecoes` é opcional e contém objetos com `tipo`, `codigo`, `codigo2`, `numero`, correspondentes a `ttSelecaoSaldoPV`. Tipos: `ITEM`, `REF`, `ESTAB`, `LOCAL`, `CONTAINER`, `LIQUIDACAO`, `PRECO`, `CONTAINER_A_DEFINIR`. Para `LOCAL`, codigo=estabelecimento e codigo2=depósito; para containers, usar numero. Os indicadores `selecaoItensAtiva`, `selecaoReferenciasAtiva`, `selecaoEstabsAtiva`, `selecaoLocaisAtiva`, `selecaoContainersAtiva` continuam explícitos. Lista ativa vazia significa nenhum resultado. Seleções especiais seguem `usarSelecoesEspeciais` e o contrato da BO.

As validações e a normalização de oportunidade ficam no cliente existente: ao menos uma origem; oportunidade exige PE; quando válida, usa elegibilidade PE e tabela 1, preservando os demais filtros. Não é criada consulta complementar sem filtros.

## Resposta

```json
{
  "success": true,
  "totalItens": 0,
  "totalSaldos": 0,
  "itens": [],
  "saldos": []
}
```

`itens` contém todos os campos de `ttItensSaldoPV`: código, descrição, família, unidade, gramatura, peso e totais `qtFisicaPE`, `qtDisponivelPI`, `qtSaldoPE`, `qtSaldoPI`. `saldos` contém todos os campos de `ttSaldoPV`, incluindo origem, estabelecimento, container, código/referência, linha de origem e componentes do saldo. Campos desconhecidos ABL saem como `null`; quantidades como números, sem formatação monetária. Os dois arrays representam níveis diferentes; não somar seus totais entre si. O retorno é integral, sem paginação ou truncamento implícito.

Consulta válida sem resultados tem `success:true` e arrays vazios. Erro tem `success:false`, `error`, contadores zero e arrays vazios, sem resultados parciais. A convenção do roteador e da referência retorna HTTP 200 para esses erros de negócio; JSON malformado ou falha de roteamento tem o status HTTP do handler. O PHP deve verificar ambos HTTP e `success` antes de gravar no seu banco.

Requisitos de runtime: bancos lógicos `espec`, `ems2med`, `ems2cad`; dependências BO/cliente e include canônica `sursum-api/includes/parametros_ima.i`. Não altera schema, autenticação ou configuração global do PROPATH.

## Validação e publicação em 21/10/2026

OpenEdge 12.2 no `.42`: três programas novos compilados contra schema real; 52 verificações da API, 105 da BO e 62 do cliente em cada cultura AMERICAN/EUROPEAN. A suíte JSON cobre código/descrição, decimais, null permitido/proibido, referência, mínimo, lista ativa vazia, erros sem dados parciais, aliases, contexto tipo 2 e permissões de container exclusivo. Dados sintéticos exclusivamente em banco de teste isolado e desfeitos ao concluir.

Fontes e compilados publicados no `.137`, caminhos `esapi/estoque/` e `http-api/`, com cópia no checkout canônico do motor. Cadastro de rota mesclado preservando entradas existentes; BO original, boSaldoPV/include e cliente publicados anteriormente preservados. Sem restart, alteração de schema ou publicação de fixtures.

PASOE real `sursum-api/med:9911`, login `tasilpar`: consulta por código 175182 retornou PE 50 e PI 18200; referência A01 retornou PE -1 e PI 11200; modo referência com mínimo 2 retornou três linhas. Consulta vazia e seis entradas inválidas retornaram o contrato esperado, assim como null opcional. Estes valores são o retrato da validação, não garantias sobre o estoque futuro. Não foi reproduzido o complemento PHP sem filtros.

Evidências privadas em `.runtime/estoque-json-20261021/`: logs e XREFs oficiais, `official/verification.json`, `publish-receipt.json`, `pasoe-results.json`, `pasoe-additional.json` e `final-verification.json`. Revisão independente dos fontes não encontrou bloqueador remanescente.
