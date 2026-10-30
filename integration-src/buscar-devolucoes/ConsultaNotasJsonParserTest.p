USING Progress.Json.ObjectModel.*.
BLOCK-LEVEL ON ERROR UNDO, THROW.
{esapi/consulta-notas/ttFiltroDevolucoes.i}
DEFINE VARIABLE p AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE jo AS JsonObject NO-UNDO.
DEFINE VARIABLE login AS CHARACTER NO-UNDO.
DEFINE VARIABLE pagina AS CHARACTER NO-UNDO.
DEFINE VARIABLE filtro AS CHARACTER NO-UNDO.
DEFINE VARIABLE checks AS INTEGER NO-UNDO.
DEFINE VARIABLE rejected AS LOGICAL NO-UNDO.
DEFINE VARIABLE payload AS LONGCHAR NO-UNDO.
p = NEW ObjectModelParser().
RUN good ('~{"usuario":" TESTE ","clienteIni":0,"dtEmisIni":"2024-02-29","extra":~{"clienteFim":"bad"~}~}').
FIND FIRST ttFiltroDevolucoes.
RUN assert (login = "TESTE" AND pagina = "consulta-notas-fiscais-wp", "metadata").
RUN assert (ttFiltroDevolucoes.cliente-de = 0 AND ttFiltroDevolucoes.cliente-ate = ?, "open range and zero").
RUN assert (ttFiltroDevolucoes.emissao-de = DATE(2,29,2024), "ISO leap day").
RUN bad ('~{"login":"T","clienteIni":1.5~}').
RUN bad ('~{"login":"T","clienteIni":"1"~}').
RUN bad ('~{"login":"T","clienteIni":true~}').
RUN bad ('~{"login":"T","clienteIni":null~}').
RUN bad ('~{"login":"T","clienteIni":2147483648~}').
RUN bad ('~{"login":"T","clienteIni":~{~}~}').
RUN bad ('~{"login":"T","nrPedidoIni":123~}').
RUN bad ('~{"login":"T","dtEmisIni":"2023-02-29"~}').
RUN bad ('~{"login":"T","dtEmisIni":"2024-2-29"~}').
RUN bad ('~{"login":"T","clienteIni":5,"clienteFim":4~}').
RUN bad ('~{"login":"T","dtEmisIni":"2024-03-01","dtEmisFim":"2024-02-29"~}').
RUN bad ('~{"login":"T","estabIni":"9","estabFim":"1"~}').
RUN bad ('~{"login":"T","pagina":false~}').
RUN bad ('~{"login":"T","filtro":[]~}').
RUN bad ('~{"login":"  "~}').
RUN good ('~{"login":"T","nrPedidoIni":"ABC-1","represIni":0,"filtro":"f"~}').
RUN assert (filtro = "f", "explicit filter").
RUN good ('~{"userName":"ALIAS"~}').
RUN assert (login = "ALIAS", "userName alias as reference API").
RUN bad ('~{"login":"T","dtEmisIni":"0000-01-01"~}').
RUN bad ('~{"login":"T","represIni":-2147483649~}').
RUN bad ('~{"login":"T","represIni":1.0~}').
RUN bad ('~{"login":"T","represIni":1e2~}').
RUN bad ('~{"login":"T","represIni":5,"represFim":4~}').
RUN bad ('~{"login":"T","nrNotaIni":"Z","nrNotaFim":"A"~}').
RUN bad ('~{"login":"T","nrPedidoIni":"Z","nrPedidoFim":"A"~}').
RUN bad ('~{"login":"T","empresa":[]~}').
RUN bad ('~{"extra":~{"login":"T"~}~}').
RUN good ('~{"login":"T","clienteFim":100,"represFim":7,"dtEmisFim":"2026-01-31"~}').
FIND FIRST ttFiltroDevolucoes.
RUN assert (ttFiltroDevolucoes.cliente-de = ? AND ttFiltroDevolucoes.cliente-ate = 100 AND ttFiltroDevolucoes.representante-de = ? AND ttFiltroDevolucoes.representante-ate = 7 AND ttFiltroDevolucoes.emissao-de = ? AND ttFiltroDevolucoes.emissao-ate = DATE(1,31,2026), "upper-only ranges remain open").
PUT UNFORMATTED "PASS parser checks=" checks SKIP.
PROCEDURE good:
 DEFINE INPUT PARAMETER c AS LONGCHAR NO-UNDO.
 jo = CAST(p:Parse(c),JsonObject).
 RUN esapi/consulta-notas/ConsultaNotasJsonParser.p(jo, OUTPUT TABLE ttFiltroDevolucoes, OUTPUT login, OUTPUT pagina, OUTPUT filtro).
END PROCEDURE.
PROCEDURE bad:
 DEFINE INPUT PARAMETER c AS LONGCHAR NO-UNDO.
 rejected = FALSE.
 DO ON ERROR UNDO, THROW:
  RUN good(c).
  CATCH e AS Progress.Lang.Error:
   rejected = TRUE.
  END CATCH.
 END.
 RUN assert(rejected,"reject " + STRING(c)).
END PROCEDURE.
PROCEDURE assert:
 DEFINE INPUT PARAMETER ok AS LOGICAL NO-UNDO.
 DEFINE INPUT PARAMETER msg AS CHARACTER NO-UNDO.
 IF ok <> TRUE OR ok = ? THEN UNDO, THROW NEW Progress.Lang.AppError(msg,0).
 checks = checks + 1.
END PROCEDURE.




