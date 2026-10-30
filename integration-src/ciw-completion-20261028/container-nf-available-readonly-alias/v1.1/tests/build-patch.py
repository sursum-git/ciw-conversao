from pathlib import Path
import hashlib,json
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1];STATE=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-alias/v1.1'
rel='sursum-api/programs/ContainersPainelFinanceReadService.p';base=STATE/'baseline'/rel;data=base.read_bytes();original=data
def digest(b):return hashlib.sha256(b).hexdigest()
assert digest(data)=='09678e8fabe46c2fd35ea3bf814e587765490135533a034822236da2ed5c37cf'
hunks=[]
def change(old,new):
 global data
 a=old.encode();b=new.encode();assert data.count(a)==1,old;data=data.replace(a,b,1);hunks.append({'oldBytesHex':a.hex(),'newBytesHex':b.hex()})
change('FUNCTION NfDocumentHash RETURNS CHARACTER (pcValue AS CHARACTER):', '''/* Exact ASCII opaque-key bytes; invoked only by nfs-disponiveis guards.
   Hex text has no blank-padding/case ambiguity from ABL character comparison. */
FUNCTION NfKeyBytes RETURNS CHARACTER (pcValue AS CHARACTER):
 DEFINE VARIABLE bytesValue AS MEMPTR NO-UNDO.
 DEFINE VARIABLE hexValue AS CHARACTER NO-UNDO.
 DEFINE VARIABLE positionValue AS INTEGER NO-UNDO.
 IF pcValue=? THEN RETURN "".
 IF NOT ValidKey(pcValue) THEN RETURN "".
 IF LENGTH(pcValue,"RAW")<>67 THEN RETURN "".
 DO positionValue=1 TO 67: IF ASC(SUBSTRING(pcValue,positionValue,1))>127 THEN RETURN "". END.
 DO ON ERROR UNDO, THROW:
  SET-SIZE(bytesValue)=68.
  PUT-STRING(bytesValue,1)=pcValue.
  hexValue=HEX-ENCODE(GET-BYTES(bytesValue,1,67)).
  FINALLY: SET-SIZE(bytesValue)=0. END FINALLY.
 END.
 RETURN hexValue.
END FUNCTION.
FUNCTION NfDocumentHash RETURNS CHARACTER (pcValue AS CHARACTER):'''.replace('\n','\r\n'))
change(' IF ETIME - iNfStarted>=10000 OR iNfReads>=50000 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).',' IF ETIME - iNfStarted>=10000 THEN RUN NfFail("CONTAINER_NF_QUERY_TIMEOUT",503).\r\n IF iNfReads>=50000 THEN RUN NfFail("CONTAINER_NF_SOURCE_LIMIT",503).')
change('    IF countRows>200 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).','    IF countRows>200 THEN RUN NfFail("CONTAINER_NF_CANDIDATE_LIMIT",503).')
change(' IF NOT finished OR ETIME - iNfStarted>=10000 THEN RUN NfFail("CONTAINER_NF_QUERY_LIMIT",503).',' IF NOT finished OR ETIME - iNfStarted>=10000 THEN RUN NfFail("CONTAINER_NF_QUERY_TIMEOUT",503).')
change('      IF poRequest:GetCharacter(cKeyField)<>cId THEN DO: RUN Fail("CONTAINER_VALIDATION","Alias da chave conflitante.",422). RETURN. END.', '      IF cResource="nfs-disponiveis" AND NfKeyBytes(poRequest:GetCharacter(cKeyField))<>NfKeyBytes(cId) THEN DO: RUN Fail("CONTAINER_VALIDATION","Alias da chave conflitante.",422). RETURN. END.\r\n      IF poRequest:GetCharacter(cKeyField)<>cId THEN DO: RUN Fail("CONTAINER_VALIDATION","Alias da chave conflitante.",422). RETURN. END.')
out=STATE/'candidate'/rel;out.parent.mkdir(parents=True,exist_ok=True);out.write_bytes(data)
p={'target':'D:/opencode/motor-progress/v2/'+rel,'relative':rel,'baselineSha256':digest(original),'candidateSha256':digest(data),'changes':hunks,'applyMode':'byte-exact-sequential-anchors','scope':'Only nfs-disponiveis; no limits/front-end/other resource behavior changed'}
(ROOT/'patch-plan.json').write_text(json.dumps(p,indent=2)+'\n',encoding='utf-8');print(json.dumps({'hunks':len(hunks),'candidateSha256':p['candidateSha256']}))
