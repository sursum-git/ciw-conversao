from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/purchase-sample-formats-20261027';c=r/'integration-src/purchase-sample-formats';motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
assert not(s/'baseline-manifest.json').exists(),'Candidates already prepared; inspect before replay'
paths=[motor/'sursum-api/programs'/n for n in ['CiwCadastroCrudService.p','CiwCadastroDefinition.p','CiwCadastrosCrud.p']]+[builder/'backend/src/Runtime'/n for n in ['RuntimeCiwCadastroAudit.php','RuntimeApiEntityActionService.php']]+[builder/'integrations/ciw-purchase-items/proc-compra-itens-builder-draft.json']
manifest=[]
for p in paths:
 data=p.read_bytes();target=s/'baseline'/p.name;target.parent.mkdir(exist_ok=True);target.write_bytes(data);manifest.append(dict(target=str(p),sha256=hashlib.sha256(data).hexdigest(),backup=str(target)))
(s/'baseline-manifest.json').write_text(json.dumps(manifest,indent=2),encoding='utf-8')
def read(n):return(s/'baseline'/n).read_text(encoding='utf-8-sig')
def replace(text,needle,new):assert text.count(needle)==1,(needle[:100],text.count(needle));return text.replace(needle,new,1)
text=read('CiwCadastroCrudService.p')
text=replace(text,'DEFINE INPUT PARAMETER poDefinition AS JsonObject NO-UNDO.','DEFINE INPUT PARAMETER phIdentity AS HANDLE NO-UNDO.\nDEFINE INPUT PARAMETER poDefinition AS JsonObject NO-UNDO.')
text=replace(text,'FUNCTION ReadId RETURNS INTEGER (o AS JsonObject):','FUNCTION ReadNamedId RETURNS INTEGER (o AS JsonObject,keyName AS CHARACTER):')
start=text.index('FUNCTION ReadNamedId');end=text.index('END FUNCTION.',start)+len('END FUNCTION.')
part=text[start:end].replace('o:Has("id")','o:Has(keyName)').replace('o:IsNull("id")','o:IsNull(keyName)').replace('o:GetType("id")','o:GetType(keyName)').replace('o:GetCharacter("id")','o:GetCharacter(keyName)').replace('o:GetJsonText("id")','o:GetJsonText(keyName)')
text=text[:start]+part+'\nFUNCTION ReadId RETURNS INTEGER (o AS JsonObject): RETURN ReadNamedId(o,"id"). END FUNCTION.'+text[end:]
text=replace(text,' DEFINE VARIABLE numberValue AS DECIMAL NO-UNDO.',' DEFINE VARIABLE numberValue AS DECIMAL NO-UNDO.\n DEFINE VARIABLE allowedText AS CHARACTER NO-UNDO. DEFINE VARIABLE charIndex AS INTEGER NO-UNDO.')
needle='   WHEN "logical" THEN IF o:GetType(nameValue)<>JsonDataType:BOOLEAN THEN RUN Fail("CIW_CADASTRO_VALIDATION","Indicador deve ser verdadeiro ou falso.",422).'
assert needle in text
# Add the whitelist inside the existing CHARACTER branch after its length check.
needle='   WHEN "logical" THEN'
pos=text.index(needle);charEnd=text.rfind('   END.',0,pos);assert charEnd>text.index('PROCEDURE ValidateValues:')
text=text[:charEnd]+'''    IF NOT allRequired AND descriptor:Has("allowedCharacters") THEN DO:
     allowedText=descriptor:GetCharacter("allowedCharacters").
     DO charIndex=1 TO LENGTH(o:GetCharacter(nameValue)):
      IF INDEX(allowedText,SUBSTRING(o:GetCharacter(nameValue),charIndex,1))=0 THEN RUN Fail("CIW_CADASTRO_VALIDATION","Caracter nao permitido.",422).
     END.
    END.
'''+text[charEnd:]
text=replace(text,'"operation,id,original,changes," + cAllowed','"operation,id,original,changes," + cAllowed + (IF cKey="id" THEN "" ELSE "," + cKey)')
needle=' IF cOperation="read" THEN DO: RUN ReadAll. poResponse:Add("success",TRUE). RETURN. END.'
text=replace(text,needle,''' IF cKey<>"id" AND poRequest:Has(cKey) THEN DO:
  IF cOperation="create" THEN RUN Fail("CIW_CADASTRO_ID_IMMUTABLE","ID e gerado pelo servidor.",422).
  IF LOOKUP(cOperation,"get,update,delete")=0 THEN RUN Fail("CIW_CADASTRO_FIELD_INVALID","Alias indisponivel nesta operacao.",422).
  IF NOT poRequest:Has("id") OR ReadNamedId(poRequest,cKey)<>ReadId(poRequest) THEN RUN Fail("CIW_CADASTRO_ID_IMMUTABLE","Identidade divergente.",422).
 END.
'''+needle)
text=replace(text,'   joChange:Add("data",joValues).','   IF cKey<>"id" AND joValues:Has(cKey) THEN joValues:Remove(cKey).\n   joChange:Add("data",joValues).')
text=replace(text,'  IF CAN-FIND(FIRST ttChange WHERE ttChange.op="create") THEN DO:','  IF cResource="formatos_amostra" AND CAN-FIND(FIRST ttChange WHERE ttChange.op="create") AND NOT VALID-HANDLE(phIdentity) THEN RUN Fail("CIW_CADASTRO_CONFIGURATION","Provider de identidade obrigatorio.",503).\n  IF CAN-FIND(FIRST ttChange WHERE ttChange.op="create") AND NOT VALID-HANDLE(phIdentity) THEN DO:')
text=replace(text,'''    IF iNext>=2147483647 THEN RUN Fail("CIW_CADASTRO_ID_LIMIT","Limite de chaves atingido.",409).
    iNext = iNext + 1.''','''    IF VALID-HANDLE(phIdentity) THEN DO:
     iNext=?. RUN NextCadastroId IN phIdentity(cResource,OUTPUT iNext) NO-ERROR.
     IF ERROR-STATUS:ERROR OR ERROR-STATUS:NUM-MESSAGES>0 OR iNext=? OR iNext<1 THEN RUN Fail("CIW_CADASTRO_SEQUENCE","Identidade indisponivel.",503).
     lFound=hData:FIND-FIRST("WHERE " + hData:NAME + "." + cKey + " = " + TRIM(STRING(iNext)),EXCLUSIVE-LOCK,NO-WAIT) NO-ERROR.
     IF hData:LOCKED THEN RUN Fail("CIW_CADASTRO_BUSY","Identidade em uso.",409).
     IF FindFailed() THEN RUN Fail("CIW_CADASTRO_CONFIGURATION","Leitura de identidade indisponivel.",503).
     IF lFound THEN RUN Fail("CIW_CADASTRO_ID_COLLISION","Identidade ja utilizada; sequencia nao alterada automaticamente.",409).
    END.
    ELSE DO:
     IF iNext>=2147483647 THEN RUN Fail("CIW_CADASTRO_ID_LIMIT","Limite de chaves atingido.",409).
     iNext=iNext + 1.
    END.''')
text=replace(text,'     IF NOT joValues:Has(cName) THEN NEXT.','''     IF NOT joValues:Has(cName) THEN DO:
      IF ttChange.op="create" AND joField:Has("default") AND joField:GetCharacter("type")="logical" THEN hData:BUFFER-FIELD(cName):BUFFER-VALUE=joField:GetLogical("default").
      NEXT.
     END.''')
(c/'abl/CiwCadastroCoreService.p').write_text(text,encoding='utf-8')
definition=dict(resource='formatos_amostra',primaryKey='formato_amostra_id',fields=[dict(name='descricao',type='character',maxLength=40,allowedCharacters='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .,\r\n'),dict(name='log_inativo',type='logical',default=False)])
literal=json.dumps(definition,separators=(',',':')).replace('~','~~').replace('"','~"').replace('{','~{').replace('}','~}')
text=replace(read('CiwCadastroDefinition.p'),'CASE pcResource:','CASE pcResource:\n WHEN "formatos_amostra" THEN textValue="'+literal+'".')
(c/'abl/CiwCadastroDefinition.p').write_text(text,encoding='utf-8')
text=replace(read('CiwCadastrosCrud.p'),'  WHEN "coloracoes" THEN DO:','''  WHEN "formatos_amostra" THEN DO:
   CREATE BUFFER hData FOR TABLE "espec.formatos_amostra" BUFFER-NAME "bCiwFormatoAmostra".
   CREATE BUFFER hReference1 FOR TABLE "espec.itens_proc_compra" BUFFER-NAME "bCiwFormatoItem".
  END.
  WHEN "coloracoes" THEN DO:''')
(c/'abl/CiwCadastrosCrud.p').write_text(text,encoding='utf-8')
text=replace(read('RuntimeCiwCadastroAudit.php')," private const RESOURCES=["," private const RESOURCES=[\n  'formatos_amostra'=>['formato_amostra_id',['formato_amostra_id'=>'integer','descricao'=>'string','log_inativo'=>'boolean'],40],")
(c/'php/RuntimeCiwCadastroAudit.php').write_text(text,encoding='utf-8')
text=replace(read('RuntimeApiEntityActionService.php'),"['empresas', 'tipos_anexo', 'coloracoes', 'situacoes_container', 'tipos_versao_custo', 'motivos_desconto']","['empresas', 'tipos_anexo', 'coloracoes', 'situacoes_container', 'tipos_versao_custo', 'motivos_desconto', 'formatos_amostra']")
(c/'php/RuntimeApiEntityActionService.php').write_text(text,encoding='utf-8')
p=motor/'tests/abl/ciw-cadastros/CiwCadastroDefinitionTest.p';text=p.read_text().replace('coloracoes,situacoes_container,tipos_versao_custo,motivos_desconto','coloracoes,situacoes_container,tipos_versao_custo,motivos_desconto,formatos_amostra');(c/'tests/CiwCadastroDefinitionTest.p').write_text(text,encoding='utf-8')
print('Prepared shared-core candidates; stable6argument adapter, fixed identity, audit catalog; no canonical writes')
