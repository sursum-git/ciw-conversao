/* Shared physical image plus resolved owner; no business formulas. */
FUNCTION SampleFields RETURNS CHARACTER():
 RETURN 'envio_amostra_repres_id,item_proc_compra_id,cod_rep,dt_envio,apont_amostra_id'.
END FUNCTION.
FUNCTION SampleId RETURNS INTEGER(o AS JsonObject,n AS CHARACTER):
 DEFINE VARIABLE rawValue AS CHARACTER NO-UNDO. DEFINE VARIABLE k AS INTEGER NO-UNDO.
 IF NOT o:Has(n) THEN UNDO, THROW NEW Progress.Lang.AppError('Identidade obrigatoria.',1).
 IF o:GetType(n)=JsonDataType:STRING THEN rawValue=o:GetCharacter(n).
 ELSE IF o:GetType(n)=JsonDataType:NUMBER THEN rawValue=STRING(o:GetJsonText(n)).
 ELSE UNDO, THROW NEW Progress.Lang.AppError('Identidade inteira obrigatoria.',1).
 IF LENGTH(rawValue)<1 OR LENGTH(rawValue)>10 OR SUBSTRING(rawValue,1,1)='0' THEN UNDO, THROW NEW Progress.Lang.AppError('Identidade positiva invalida.',1).
 DO k=1 TO LENGTH(rawValue): IF INDEX('0123456789',SUBSTRING(rawValue,k,1))=0 THEN UNDO, THROW NEW Progress.Lang.AppError('Identidade inteira invalida.',1). END.
 IF DECIMAL(rawValue)>2147483647 THEN UNDO, THROW NEW Progress.Lang.AppError('Identidade fora da faixa.',1).
 RETURN INTEGER(rawValue).
END FUNCTION.
FUNCTION SampleSnapshot RETURNS JsonObject(h AS HANDLE,pid AS INTEGER):
 DEFINE VARIABLE o AS JsonObject NO-UNDO. DEFINE VARIABLE f AS HANDLE NO-UNDO. DEFINE VARIABLE k AS INTEGER NO-UNDO.
 o=NEW JsonObject().
 DO k=1 TO NUM-ENTRIES(SampleFields()):
  f=h:BUFFER-FIELD(ENTRY(k,SampleFields())).
  IF f:BUFFER-VALUE=? THEN o:AddNull(f:NAME).
  ELSE IF f:DATA-TYPE='DATE' THEN o:Add(f:NAME,ISO-DATE(DATE(f:BUFFER-VALUE))).
  ELSE IF f:DATA-TYPE='INTEGER' THEN o:Add(f:NAME,INTEGER(f:BUFFER-VALUE)).
  ELSE UNDO, THROW NEW Progress.Lang.AppError('Schema de envios inesperado.',1).
 END.
 o:Add('proc_compra_id',pid). RETURN o.
END FUNCTION.
FUNCTION SampleStamp RETURNS CHARACTER(o AS JsonObject):
 DEFINE VARIABLE textValue AS LONGCHAR NO-UNDO.
 DEFINE VARIABLE hashValue AS CHARACTER NO-UNDO.
 o:Write(textValue,FALSE). hashValue=HEX-ENCODE(MESSAGE-DIGEST('SHA-256',textValue)). RETURN CAPS(hashValue).
END FUNCTION.
FUNCTION SampleData RETURNS JsonObject(h AS HANDLE,pid AS INTEGER,repName AS CHARACTER):
 DEFINE VARIABLE o AS JsonObject NO-UNDO.
 o=SampleSnapshot(h,pid). o:Add('row_stamp',SampleStamp(o)). o:Add('representante_nome',IF repName=? THEN '' ELSE repName). RETURN o.
END FUNCTION.
