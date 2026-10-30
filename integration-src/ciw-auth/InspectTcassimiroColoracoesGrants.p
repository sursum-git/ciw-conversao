/* Leitura restrita as permissoes da conta indicada; nunca acessa senha. */
USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE members AS INTEGER NO-UNDO.
DEFINE VARIABLE userMatches AS INTEGER NO-UNDO.
DEFINE VARIABLE activeUsers AS INTEGER NO-UNDO.
DEFINE VARIABLE grants AS INTEGER NO-UNDO.
DEFINE VARIABLE accessGrants AS INTEGER NO-UNDO.
DEFINE VARIABLE globalGrants AS INTEGER NO-UNDO.
DEFINE VARIABLE catalog AS JsonArray NO-UNDO.
DEFINE VARIABLE result AS JsonObject NO-UNDO.
DEFINE VARIABLE apps AS JsonArray NO-UNDO.
DEFINE VARIABLE item AS JsonObject NO-UNDO.
DEFINE VARIABLE appName AS CHARACTER NO-UNDO.
DEFINE VARIABLE appIndex AS INTEGER NO-UNDO.
FOR EACH espec.user-web FIELDS(Login ativo) NO-LOCK WHERE CAPS(espec.user-web.Login)="TCASSIMIRO":
 userMatches=userMatches + 1.
 IF espec.user-web.ativo=TRUE THEN activeUsers=activeUsers + 1.
END.
FOR EACH espec.usuarios_grupos NO-LOCK WHERE CAPS(espec.usuarios_grupos.login_usuario)="TCASSIMIRO":
 members=members + 1.
END.
apps=NEW JsonArray().
DO appIndex=1 TO 2:
 appName=ENTRY(appIndex,"grid_pub_coloracoes,form_pub_coloracoes").
 grants=0. accessGrants=0.
 globalGrants=0.
 FOR EACH espec.grupos_aplicacoes FIELDS(nome_aplicacao) NO-LOCK WHERE espec.grupos_aplicacoes.nome_aplicacao=appName:
  globalGrants=globalGrants + 1.
 END.
 FOR EACH espec.usuarios_grupos NO-LOCK WHERE CAPS(espec.usuarios_grupos.login_usuario)="TCASSIMIRO":
  FOR EACH espec.grupos_aplicacoes NO-LOCK
   WHERE espec.grupos_aplicacoes.cod_grupo=espec.usuarios_grupos.cod_grupo
   AND espec.grupos_aplicacoes.nome_aplicacao=appName:
   grants=grants + 1.
   IF espec.grupos_aplicacoes.acesso_permitido="Y" THEN accessGrants=accessGrants + 1.
  END.
 END.
 item=NEW JsonObject(). item:Add("application",appName).
 item:Add("grantRows",grants). item:Add("accessY",accessGrants).
 item:Add("globalGrantRows",globalGrants).
 apps:Add(item).
END.
result=NEW JsonObject().
result:Add("compiler",PROVERSION).
result:Add("username","tcassimiro"). result:Add("membershipRows",members).
result:Add("userMatches",userMatches).
result:Add("activeUsers",activeUsers).
result:Add("applications",apps).
catalog=NEW JsonArray().
FOR EACH espec.grupos_aplicacoes FIELDS(nome_aplicacao) NO-LOCK
 WHERE INDEX(CAPS(espec.grupos_aplicacoes.nome_aplicacao),"COLOR")>0
 BREAK BY espec.grupos_aplicacoes.nome_aplicacao:
 IF FIRST-OF(espec.grupos_aplicacoes.nome_aplicacao) THEN DO:
  catalog:Add(espec.grupos_aplicacoes.nome_aplicacao).
  IF catalog:Length>=20 THEN LEAVE.
 END.
END.
result:Add("catalogColoracoes",catalog).
result:Add("writes",FALSE).
result:WriteFile("tcassimiro-coloracoes-grants.json",TRUE).
QUIT.


