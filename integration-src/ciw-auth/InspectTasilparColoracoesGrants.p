/* Leitura restrita as permissoes da conta indicada; nunca acessa senha. */
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE members AS INTEGER NO-UNDO.
DEFINE VARIABLE grants AS INTEGER NO-UNDO.
DEFINE VARIABLE accessGrants AS INTEGER NO-UNDO.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE apps AS JsonArray NO-UNDO.
DEFINE VARIABLE item AS JsonObject NO-UNDO.
DEFINE VARIABLE appName AS CHARACTER NO-UNDO.
DEFINE VARIABLE appIndex AS INTEGER NO-UNDO.
FOR EACH espec.usuarios_grupos NO-LOCK WHERE CAPS(espec.usuarios_grupos.login_usuario)="TASILPAR":
 members=members + 1.
END.
apps=NEW JsonArray().
DO appIndex=1 TO 2:
 appName=ENTRY(appIndex,"grid_pub_coloracoes,form_pub_coloracoes").
 grants=0. accessGrants=0.
 FOR EACH espec.usuarios_grupos NO-LOCK WHERE CAPS(espec.usuarios_grupos.login_usuario)="TASILPAR":
  FOR EACH espec.grupos_aplicacoes NO-LOCK
   WHERE espec.grupos_aplicacoes.cod_grupo=espec.usuarios_grupos.cod_grupo
   AND espec.grupos_aplicacoes.nome_aplicacao=appName:
   grants=grants + 1.
   IF espec.grupos_aplicacoes.acesso_permitido="Y" THEN accessGrants=accessGrants + 1.
  END.
 END.
 item=NEW JsonObject(). item:Add("application",appName).
 item:Add("grantRows",grants). item:Add("accessY",accessGrants).
 apps:Add(item).
END.
result=NEW JsonObject().
result:Add("compiler",PROVERSION).
result:Add("username","tasilpar"). result:Add("membershipRows",members).
result:Add("applications",apps).
result:Add("writes",FALSE).
result:WriteFile("tasilpar-coloracoes-grants.json",TRUE).
QUIT.
