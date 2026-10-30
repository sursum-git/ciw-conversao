/* Entrada de recursos fechados CIW. Transporte autenticado pelo backend atual;
   integracao adicional das permissoes legadas ficou para o final por instrucao. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
DEFINE INPUT PARAMETER poRequest AS JsonObject NO-UNDO.
DEFINE OUTPUT PARAMETER poResponse AS JsonObject NO-UNDO.
DEFINE VARIABLE hData AS HANDLE NO-UNDO.
DEFINE VARIABLE hReference1 AS HANDLE NO-UNDO.
DEFINE VARIABLE hReference2 AS HANDLE NO-UNDO.
DEFINE VARIABLE cToken AS CHARACTER NO-UNDO.
DEFINE VARIABLE cConfig AS CHARACTER NO-UNDO.
DEFINE VARIABLE cService AS CHARACTER NO-UNDO.
DEFINE VARIABLE cDefinition AS CHARACTER NO-UNDO.
DEFINE VARIABLE cResource AS CHARACTER CASE-SENSITIVE NO-UNDO.
DEFINE VARIABLE cOperation AS CHARACTER NO-UNDO.
DEFINE VARIABLE cActor AS CHARACTER NO-UNDO.
DEFINE VARIABLE cSession AS CHARACTER NO-UNDO.
DEFINE VARIABLE lcConfig AS LONGCHAR NO-UNDO.
DEFINE VARIABLE parser AS ObjectModelParser NO-UNDO.
DEFINE VARIABLE cfg AS JsonObject NO-UNDO.
DEFINE VARIABLE policy AS JsonObject NO-UNDO.
DEFINE VARIABLE cleanRequest AS JsonObject NO-UNDO.
FUNCTION ValidHeader RETURNS LOGICAL (v AS CHARACTER):
 DEFINE VARIABLE n AS INTEGER NO-UNDO.
 IF v=? OR v="" OR LENGTH(v)>256 THEN RETURN FALSE.
 DO n = 1 TO LENGTH(v):
  IF ASC(SUBSTRING(v,n,1))<32 OR ASC(SUBSTRING(v,n,1))=127 THEN RETURN FALSE.
 END.
 RETURN TRUE.
END FUNCTION.
DO ON ERROR UNDO, THROW:
 cToken=WEB-CONTEXT:GET-CGI-VALUE("ENV","HTTP_X_CIW_CADASTROS_TOKEN") NO-ERROR.
 IF cToken=? THEN cToken="".
 IF LENGTH(cToken)<32 OR LENGTH(cToken)>128 THEN DO: RUN ErrorResponse("CIW_CADASTRO_AUTH_REQUIRED",401). RETURN. END.
 cConfig=SEARCH("sursum-conf/ciw-cadastros-api.json").
 cService=SEARCH("sursum-api/programs/CiwCadastroCrudService.r").
 cDefinition=SEARCH("sursum-api/programs/CiwCadastroDefinition.r").
 IF cConfig=? OR cService=? OR cDefinition=? THEN UNDO,THROW NEW Progress.Lang.AppError("Configuracao ausente",0).
 FIX-CODEPAGE(lcConfig)="UTF-8". COPY-LOB FROM FILE cConfig TO lcConfig.
 parser=NEW ObjectModelParser(). cfg=CAST(parser:Parse(lcConfig),JsonObject).
 IF CAPS(HEX-ENCODE(MESSAGE-DIGEST("SHA-256",cToken)))<>CAPS(cfg:GetCharacter("tokenSha256")) THEN DO: RUN ErrorResponse("CIW_CADASTRO_AUTH_REQUIRED",401). RETURN. END.
 IF NOT VALID-OBJECT(poRequest) THEN DO: RUN ErrorResponse("CIW_CADASTRO_VALIDATION",422). RETURN. END.
 IF NOT poRequest:Has("resource") OR poRequest:GetType("resource")<>JsonDataType:STRING OR NOT poRequest:Has("operation") OR poRequest:GetType("operation")<>JsonDataType:STRING THEN DO: RUN ErrorResponse("CIW_CADASTRO_VALIDATION",422). RETURN. END.
 cResource=poRequest:GetCharacter("resource"). cOperation=poRequest:GetCharacter("operation").
 IF NOT CONNECTED("espec") THEN UNDO,THROW NEW Progress.Lang.AppError("Banco indisponivel",0).
 IF LOOKUP(cOperation,"read,get")=0 THEN DO:
  cActor=WEB-CONTEXT:GET-CGI-VALUE("ENV","HTTP_X_SURSUM_USER") NO-ERROR.
  cSession=WEB-CONTEXT:GET-CGI-VALUE("ENV","HTTP_X_SESSION_ID") NO-ERROR.
  IF NOT ValidHeader(cActor) OR NOT ValidHeader(cSession) THEN DO: RUN ErrorResponse("CIW_CADASTRO_IDENTITY_REQUIRED",401). RETURN. END.
 END.
 CASE cResource:
  WHEN "fornecedores" OR WHEN "fornecedores_estrangeiros" THEN DO:
   cService=SEARCH("sursum-api/programs/CiwFornecedoresService.r").
   IF cService=? OR NOT CONNECTED("ems2cad") THEN UNDO,THROW NEW Progress.Lang.AppError("Consulta indisponivel",0).
   CREATE BUFFER hData FOR TABLE "ems2cad.emitente" BUFFER-NAME "bCiwFornecedor".
   cleanRequest=CAST(poRequest:Clone(),JsonObject). cleanRequest:Remove("resource").
   RUN VALUE(cService)(INPUT hData,INPUT cResource,INPUT cleanRequest,OUTPUT poResponse).
   RETURN.
  END.
  WHEN "im_param" THEN DO:
   cService=SEARCH("sursum-api/programs/CiwParametrosService.r").
   IF cService=? THEN UNDO,THROW NEW Progress.Lang.AppError("Editor indisponivel",0).
   CREATE BUFFER hData FOR TABLE "espec.im-param" BUFFER-NAME "bCiwParametro".
   cleanRequest=CAST(poRequest:Clone(),JsonObject). cleanRequest:Remove("resource").
   RUN VALUE(cService)(INPUT hData,INPUT cleanRequest,OUTPUT poResponse).
   RETURN.
  END.
  WHEN "coloracoes" THEN DO:
   CREATE BUFFER hData FOR TABLE "espec.coloracoes" BUFFER-NAME "bCiwColoracao".
   CREATE BUFFER hReference1 FOR TABLE "espec.itens_proc_compra" BUFFER-NAME "bCiwColoracaoItem".
  END.
  WHEN "situacoes_container" THEN DO:
   CREATE BUFFER hData FOR TABLE "espec.situacoes_container" BUFFER-NAME "bCiwSituacao".
   CREATE BUFFER hReference1 FOR TABLE "espec.pp-container" BUFFER-NAME "bCiwSituacaoContainer".
   CREATE BUFFER hReference2 FOR TABLE "espec.versoes_item_custo_container" BUFFER-NAME "bCiwSituacaoVersao".
  END.
  WHEN "tipos_versao_custo" THEN CREATE BUFFER hData FOR TABLE "espec.tipos_versao_custo" BUFFER-NAME "bCiwTipoVersao".
  WHEN "motivos_desconto" THEN DO:
   CREATE BUFFER hData FOR TABLE "espec.motivos_desconto" BUFFER-NAME "bCiwMotivo".
   CREATE BUFFER hReference1 FOR TABLE "espec.descontos_importacao" BUFFER-NAME "bCiwMotivoDesconto".
  END.
  OTHERWISE DO: RUN ErrorResponse("CIW_CADASTRO_RESOURCE_INVALID",422). RETURN. END.
 END CASE.
 RUN VALUE(cDefinition)(INPUT cResource,OUTPUT policy).
 cleanRequest=CAST(poRequest:Clone(),JsonObject). cleanRequest:Remove("resource").
 RUN VALUE(cService)(INPUT hData,INPUT hReference1,INPUT hReference2,INPUT policy,INPUT cleanRequest,OUTPUT poResponse).
 CATCH e AS Progress.Lang.Error:
  RUN ErrorResponse("CIW_CADASTRO_CONFIGURATION",503).
 END CATCH.
 FINALLY:
  IF VALID-HANDLE(hData) THEN DELETE OBJECT hData NO-ERROR.
  IF VALID-HANDLE(hReference1) THEN DELETE OBJECT hReference1 NO-ERROR.
  IF VALID-HANDLE(hReference2) THEN DELETE OBJECT hReference2 NO-ERROR.
  IF VALID-OBJECT(cfg) THEN DELETE OBJECT cfg.
  IF VALID-OBJECT(parser) THEN DELETE OBJECT parser.
  IF VALID-OBJECT(policy) THEN DELETE OBJECT policy.
  IF VALID-OBJECT(cleanRequest) THEN DELETE OBJECT cleanRequest.
 END FINALLY.
END.
PROCEDURE ErrorResponse:
 DEFINE INPUT PARAMETER c AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER s AS INTEGER NO-UNDO.
 DEFINE VARIABLE err AS JsonObject NO-UNDO.
 poResponse=NEW JsonObject(). err=NEW JsonObject(). err:Add("code",c). err:Add("status",s).
 err:Add("message","Solicitacao recusada ou cadastro indisponivel."). poResponse:Add("success",FALSE). poResponse:Add("error",err).
END PROCEDURE.
