# API de consulta de notas fiscais com WP

Publicada em 20/10/2026: POST `https://192.168.0.111:9911/med/web/SursumPrograms/consulta-notas-fiscais-wp`. Quatro testes HTTP reais aprovados (tres entradas invalidas e uma pesquisa vazia), commit conferido diretamente em espec.wp e limpeza por imagem completa. Mapeamento das linhas e rollback validados nas suites sinteticas oficiais 12.2.

Compilacao oficial OpenEdge 12.2.12 e suites completas descritas no README principal. Evidencias de publicacao e PASOE ficam em `.runtime/consulta-nf-api-20261020/`.

`api_cons_nota_fiscal_wp.p` recebe `INPUT JsonObject` e devolve `OUTPUT JsonObject`, seguindo o contrato da API de pedidos de venda. Auxiliares em `esapi/consulta-notas/`: `ConsultaNotasJsonParser.p`, `ConsultaNotasUsuarioEscopo.p`, `ConsultarNotasFiscais.p`, `ConsultaNotasWpWriter.p` e `ttFiltroDevolucoes.i`; saida em `esbo/boConsNotaFiscal.i`. O chamador real e suas BOs possuem dependencias adicionais documentadas no README principal.

```json
{
  "login": "USUARIO",
  "empresa": "MED",
  "estabIni": "5",
  "estabFim": "5",
  "clienteIni": 100,
  "clienteFim": 100,
  "nrNotaIni": "000001",
  "nrNotaFim": "999999",
  "nrPedidoIni": "CLIENTE-001",
  "nrPedidoFim": "CLIENTE-999",
  "represIni": 7,
  "represFim": 7,
  "dtEmisIni": "2026-01-01",
  "dtEmisFim": "2026-10-20"
}
```

`empresa` e obrigatoria: `IMA` ou `MED`. As seis faixas sao opcionais; limites omitidos sao abertos. Texto vazio abre o limite textual. Zero e um limite numerico real. `nrPedidoIni/Fim` filtra `nr-pedcli`, nao o numero interno do pedido. Os limites de representante sao inteiros de `cod-rep`. Datas usam texto ISO `YYYY-MM-DD` e sao construidas sem depender da cultura da sessao. Intervalos invertidos sao recusados. Numeros JSON fracionarios, com expoente, texto numerico, objetos, arrays, booleanos e null sao recusados nos filtros inteiros; nao ocorre arredondamento.

Somente propriedades da raiz sao consideradas. Uma propriedade desconhecida pode conter objetos sem que suas propriedades internas alterem os filtros. Um filtro reconhecido contendo objeto/array e recusado. Os filtros e metadados reconhecidos sao validados antes de qualquer consulta ou gravacao.

`login` e obrigatorio e aceita os aliases da referencia, nesta prioridade: `login`, `usuario`, `userName`, `requestUser`. Havendo uma propriedade de maior prioridade, seu valor e usado mesmo se vazio; login vazio e recusado. Os aliases presentes devem ser texto. O login recebido e metadado informado pelo consumidor; esta rotina nao comprova autenticacao. `pagina` e texto opcional, padrao `consulta-notas-fiscais-wp`. `filtro` e texto opcional; ausente ou vazio armazena a serializacao do JsonObject recebido.

Como na API de pedidos, usuario tipo 2 em `espec.user-web` restringe os dois limites ao representante cadastrado por `nome-ab-cli` (fallback Login), resolvido em `ems2cad.repres`. Representante inexistente gera erro. Usuario ausente/outros tipos mantem os filtros informados; isto preserva o comportamento da referencia e nao substitui autenticacao do consumidor. A BO e o chamador continuam reutilizaveis sem dependencia de login.

Rota POST `/SursumPrograms/consulta-notas-fiscais-wp`, contexto `sursum-api/med`, HTTPS 9911.

Sucesso, retornado somente depois do COMMIT:

```json
{"success":true,"codWp":"UUID-da-pesquisa","total":10,"inserted":10}
```

Erro:

```json
{"success":false,"error":"Descricao do erro"}
```

O retorno de erro nao inclui contagens nem identificador parcial. Nenhum codigo HTTP adicional e definido por estas procedures.

## Persistencia

`ConsultaNotasWpWriter.p` recebe `(INPUT TABLE tt-NF, INPUT CHARACTER login, pagina, filtro, OUTPUT CHARACTER codWp, OUTPUT INTEGER inserted)`. Grava um cabecalho em `espec.wp` com `tabela = 'wp_nota_fiscal'` e todas as linhas em `espec.wp_nota_fiscal`, dentro de uma unica transacao propria. Recusa `TRANSACTION = TRUE` para nao retornar sucesso antes de uma eventual transacao externa confirmar. A API tambem recusa transacao externa antes da consulta. Qualquer erro de linha desfaz o cabecalho e todos os filhos novos. Zero linhas gera uma pesquisa com cabecalho e `inserted = 0`. Pesquisas anteriores nunca sao apagadas.

`codWp` usa `GUID(GENERATE-UUID)` e verifica existencia tanto no cabecalho quanto nos filhos antes de criar. Os indices reais de `cod_wp` nao sao unicos: essa verificacao nao e uma garantia de exclusividade concorrente fornecida pelo banco; o identificador UUID evita a geracao previsivel por contador/horario/login.

Os 18 campos fisicos sao preenchidos explicitamente:

| Destino `wp_nota_fiscal` | Origem `tt-NF` |
| --- | --- |
| cod_wp | UUID novo |
| tipo_nota | tipo-nota |
| nr_nota_fis | nf |
| serie | serie |
| cod_emitente | cod-emitente |
| no_ab_reppri | nome-ab-reppri |
| cod_repres | cod-rep |
| dt_emis_nota | dt-emis-nota |
| vl_nota | vl-nota |
| nr_nota_fis_original | nf-original, conversao inteira estrita |
| nr_pedcli | nr-pedcli |
| vl_bruto | vl-bruto |
| vl_desconto | vl-desconto |
| preposto | preposto |
| cidade | cidade |
| estado | estado |
| cod_estabel | cod-estabel |
| desc_devol | descr-mot-dev |

`tipo-nota` deve ser um INTEGER conhecido e e copiado da origem; o writer nao inventa codigos por sinal ou categoria. `nf-original = ''` vira zero; conteudo desconhecido, alfanumerico, fracionario ou fora de INTEGER gera erro com rollback. Zeros iniciais sao permitidos na conversao inteira. A data gravada e a emissao explicita, e nao `data`/data de transacao da devolucao. Valores negativos sao preservados. A comissao nao possui destino nesta tabela.

## Validacao local auxiliar historica

OpenEdge 12.8 local compilou os tres fontes e os tres testes sem erro. Em cada cultura AMERICAN e EUROPEAN: parser 30 checks, writer 21 checks e API 7 checks; fixture vazia ao terminar. Evidencias privadas em `.runtime/api-wp-notas-20261020/validation.log`.

`ConsultaNotasJsonParserTest.p` testa tipos, datas, faixas, metadados, aliases e isolamento da raiz. `ConsultaNotasWpWriterTest.p` exige o banco sintetico privado `api-wp-notas-20261020/wpfixture`, testa todos os 18 campos, sinais, rollback integral apos linha valida, preservacao de pesquisa anterior, transacao externa, pesquisa vazia e limpeza por identificador pertencente ao teste. Os tipos numericos usados nos testes sao sentinelas de teste e nao convencoes reais.

`ConsultaNotasApiTest.p` exige a mesma fixture. Seu runner coloca um **chamador substituto exclusivo de teste** no PROPATH privado para verificar parser -> chamada -> writer -> resposta. Isso nao valida as consultas de negocio nem o chamador real; o chamador real possui sua propria suite. O substituto, runners, DB sintetico, DF e testes nunca devem ser publicados no ERP/PASOE. Nao executar estes testes apontando para bancos reais.



A verificacao oficial atual usa `tests/ValidarConsultaNotas.p` e `ConsultaNotasApiRealTest.p` com o chamador de producao; total 146 checks por cultura conforme README. O teste unitario anterior com substituto (7 checks) nao entra nesse total.
