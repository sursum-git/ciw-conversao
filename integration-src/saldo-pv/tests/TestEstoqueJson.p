USING Progress.Json.ObjectModel.*.
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE req AS JsonObject NO-UNDO.
DEFINE VARIABLE res AS JsonObject NO-UNDO.
DEFINE VARIABLE arr AS JsonArray NO-UNDO.
DEFINE VARIABLE obj AS JsonObject NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "saldo-pv-fixture") = 0 THEN RETURN ERROR "Fixture obrigatoria".
OUTPUT TO VALUE("estoque-json-tests-" + SESSION:NUMERIC-FORMAT + ".log").
RUN check(SEARCH("http-api/api_cons_estoque.p") <> ?, "API implementada").
IF failed THEN DO: OUTPUT CLOSE. RETURN ERROR "API ausente". END.
DO TRANSACTION ON ERROR UNDO, THROW:
 CREATE espec.user-web.
 ASSIGN espec.user-web.Login = "SC_TEST_ESTOQUE" espec.user-web.tp-usuario = 4.
 CREATE ems2med.item.
 ASSIGN ems2med.item.it-codigo = "99000001" ems2med.item.desc-item = "TECIDO TESTE ALGODAO"
  ems2med.item.fm-codigo = "TESTE" ems2med.item.ge-codigo = 50 ems2med.item.un = "M"
  ems2med.item.peso-liquido = ?.
 CREATE espec.item-ext.
 ASSIGN espec.item-ext.it-codigo = "99000001" espec.item-ext.gramatura = 100.
 CREATE espec.locais_estoq_portal.
 ASSIGN espec.locais_estoq_portal.cod_empresa = "5" espec.locais_estoq_portal.cod_estab = "5"
  espec.locais_estoq_portal.cod_depos = "TJ" espec.locais_estoq_portal.dt_hora_inicio = NOW - 1000
  espec.locais_estoq_portal.dt_hora_fim = NOW + 1000.
 CREATE ems2med.saldo-estoq.
 ASSIGN ems2med.saldo-estoq.it-codigo = "99000001" ems2med.saldo-estoq.cod-estabel = "5"
  ems2med.saldo-estoq.cod-depos = "TJ" ems2med.saldo-estoq.cod-refer = "REF-A"
  ems2med.saldo-estoq.lote = "REF-A" ems2med.saldo-estoq.qtidade-atu = 12.5.
 CREATE espec.pp-container.
 ASSIGN espec.pp-container.nr-container = 991 espec.pp-container.situacao = 1
  espec.pp-container.cod-estabel = "5" espec.pp-container.exclusivo = NO.
 CREATE espec.pp-it-container.
 ASSIGN espec.pp-it-container.it-codigo = "99000001" espec.pp-it-container.nr-container = 991
  espec.pp-it-container.cod-refer = "REF-A" espec.pp-it-container.qt-pedida = 25.75
  espec.pp-it-container.perc-dsp-venda = 100 espec.pp-it-container.qt-vendida = 0.
 RELEASE espec.user-web.
 RELEASE ems2med.item.
 RELEASE espec.item-ext.
 RELEASE espec.locais_estoq_portal.
 RELEASE ems2med.saldo-estoq.
 RELEASE espec.pp-container.
 RELEASE espec.pp-it-container.
 RUN base.
 req:Add("pesquisaItem", "99000001").
 RUN callApi.
 res:WriteFile("estoque-json-primeiro.json",TRUE).
 RUN check(res:GetLogical("success") AND res:GetInteger("totalItens") = 1, "consulta por codigo").
 arr = res:GetJsonArray("itens"). obj = arr:GetJsonObject(1).
 RUN check(obj:GetDecimal("qtSaldoPE") = 12.5 AND obj:GetDecimal("qtSaldoPI") = 25.75, "saldos decimais PE PI").
 RUN check(obj:IsNull("pesoLiquido"), "desconhecido como null").
 RUN check(NOT res:Has("codWp") AND NOT res:Has("inserted"), "sem protocolo WP").
 RUN check(res:GetJsonArray("saldos"):Length = 2, "detalhes retornados na chamada").
 RUN base. req:Add("pesquisaItem", "TECIDO TESTE"). RUN callApi.
 RUN check(res:GetInteger("totalItens") = 1, "pesquisa descricao").
 RUN base. req:Add("pesquisaItem", "99000001"). req:Add("consultaReferencias", TRUE).
 req:Add("minimoMT", 20.5). RUN callApi.
 RUN check(res:GetJsonArray("saldos"):Length = 1, "minimo por referencia mesmo usuario4").
 RUN base. req:Add("pesquisaItem", "99000001"). req:Add("selecaoReferenciasAtiva", TRUE).
 arr = NEW JsonArray(). obj = NEW JsonObject(). obj:Add("tipo", "REF"). obj:Add("codigo", "REF-A"). arr:Add(obj).
 req:Add("selecoes", arr). RUN callApi.
 RUN check(res:GetInteger("totalItens") = 1, "selecao referencia").
 RUN base. req:Add("pesquisaItem", "99000001"). req:Add("selecaoReferenciasAtiva", TRUE).
 req:Add("selecoes", NEW JsonArray()). RUN callApi.
 RUN check(res:GetLogical("success") AND res:GetInteger("totalItens") = 0, "lista ativa vazia").
 RUN base. req:Add("pesquisaItem", "SEM-ITEM-TESTE"). RUN callApi.
 RUN check(res:GetLogical("success") AND res:GetInteger("totalItens") = 0, "vazio valido").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","grupoEstoqueIni":50.5}', "inteiro fracionario").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","grupoEstoqueIni":5e1}', "inteiro expoente").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","buscarPE":"true"}', "boolean texto").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","minimoMT":"1,5"}', "decimal texto").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","minimoMT":null}', "minimo nulo").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","tipoUsuario":4}', "tipo nao forjavel").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","representante":1}', "representante nao forjavel").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","pesquisaItme":"X"}', "filtro desconhecido").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","grupoEstoqueIni":50,"pesquisaItme":"X"}', "desconhecido apos handle valido").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","selecoes":[~{"tipo":"REF","numero":1.1}]}', "selecao mal tipada").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","selecoes":[~{"tipo":"INVALIDO"}]}', "tipo selecao invalido").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","selecoes":[~{"tipo":"REF","codigoInvalido":"X"}]}', "selecao desconhecida apos handle valido").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","buscarPE":false,"buscarPI":false}', "origem obrigatoria").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","buscarPE":false,"soLiquidacao":true}', "oportunidade exige PE").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","itemIni":"Z","itemFim":"A"}', "faixa invertida").
 RUN invalid('~{"login":"NAO_CADASTRADO_TESTE"}', "usuario inexistente").
 RUN invalid('~{}', "login obrigatorio").
 RUN base. req:Add("pesquisaItem", "99000001"). req:AddNull("maximoMT"). RUN callApi.
 res:WriteFile("estoque-json-null.json",TRUE).
 RUN check(res:GetLogical("success") AND res:GetInteger("totalItens") = 1, "null abre limite opcional").
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","usuario":"OUTRO"}', "aliases divergentes").
 /* Escopo tipo2: container exclusivo depende do representante do cadastro. */
 FIND FIRST espec.user-web WHERE espec.user-web.Login = "SC_TEST_ESTOQUE".
 ASSIGN espec.user-web.tp-usuario = 2 espec.user-web.nome-ab-cli = "REP-TESTE".
 RELEASE espec.user-web.
 RUN invalid('~{"login":"SC_TEST_ESTOQUE","pesquisaItem":"99000001"}', "tipo2 sem representante").
 CREATE ems2cad.repres.
 ASSIGN ems2cad.repres.nome-abrev = "REP-TESTE" ems2cad.repres.cod-rep = 901.
 RELEASE ems2cad.repres.
 FIND FIRST espec.pp-container WHERE espec.pp-container.nr-container = 991.
 espec.pp-container.exclusivo = YES.
 RELEASE espec.pp-container.
 RUN base. req:Add("pesquisaItem", "99000001"). RUN callApi.
 arr = res:GetJsonArray("itens"). obj = arr:GetJsonObject(1).
 RUN check(res:GetLogical("success") AND obj:GetDecimal("qtSaldoPI") = 0, "tipo2 restringe container sem permissao").
 CREATE espec.pp_container_permissao.
 ASSIGN espec.pp_container_permissao.nr_container = 991 espec.pp_container_permissao.cod_repres = 901.
 RELEASE espec.pp_container_permissao.
 RUN base. req:Add("pesquisaItem", "99000001"). RUN callApi.
 arr = res:GetJsonArray("itens"). obj = arr:GetJsonObject(1).
 RUN check(res:GetLogical("success") AND obj:GetDecimal("qtSaldoPI") = 25.75, "tipo2 representante resolvido e autorizado").
 UNDO, LEAVE.
END.
PUT UNFORMATTED (IF failed THEN "FAIL" ELSE "PASS") " checks=" n SKIP.
OUTPUT CLOSE.
IF failed THEN RETURN ERROR "FAIL estoque JSON".
PROCEDURE base:
 req = NEW JsonObject(). req:Add("login", "SC_TEST_ESTOQUE"). req:Add("considerarWeb", FALSE).
END PROCEDURE.
PROCEDURE callApi:
 RUN http-api/api_cons_estoque.p(req, OUTPUT res).
END PROCEDURE.
PROCEDURE invalid:
 DEFINE INPUT PARAMETER textJson AS LONGCHAR NO-UNDO.
 DEFINE INPUT PARAMETER labelText AS CHARACTER NO-UNDO.
 parser = NEW ObjectModelParser(). req = CAST(parser:Parse(textJson), JsonObject).
 RUN callApi.
 RUN check(NOT res:GetLogical("success") AND res:Has("error"), labelText).
 RUN check(res:GetJsonArray("itens"):Length = 0 AND res:GetJsonArray("saldos"):Length = 0, "erro sem dados parciais").
END PROCEDURE.
PROCEDURE check:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER labelText AS CHARACTER NO-UNDO.
 n = n + 1.
 IF ok <> TRUE OR ok = ? THEN DO: failed = TRUE. PUT UNFORMATTED "FAIL " labelText SKIP. END.
END PROCEDURE.
