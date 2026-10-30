const fs=require('node:fs'),path=require('node:path');const pkg=__dirname;
const original=fs.readFileSync(path.join(pkg,'tests/abl/ContainersVersionHistoryTest.p'),'utf8');
let prefix=original.slice(0,original.indexOf("pathValue=SEARCH('sursum-api/programs/ContainersVersionHistoryService.r')."));
prefix=prefix.replace('DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.','DEFINE VARIABLE keyValue AS CHARACTER NO-UNDO.\nDEFINE VARIABLE resourceName AS CHARACTER CASE-SENSITIVE NO-UNDO.');
prefix=prefix.replace(" ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id'))."," IF i=6 THEN DO:\n  DO j=1 TO NUM-ENTRIES('versao_id,documento,serie,estab,nat_operacao,cod_emitente'): ht[i]:ADD-INDEX-FIELD('pk',ENTRY(j,'versao_id,documento,serie,estab,nat_operacao,cod_emitente')). END.\n END.\n ELSE ht[i]:ADD-INDEX-FIELD('pk',ENTRY(i,'nr-container,tipo_versao_custo_id,versao_id,item_container_custo_id,despesa_id,documento,num_id_tit_ap,desconto_importacao_id')).");
let procedures=original.slice(original.indexOf('PROCEDURE Parse:'));
procedures=procedures.replace('hb[8],requestValue,OUTPUT responseValue','hb[8],resourceName,requestValue,OUTPUT responseValue');
fs.writeFileSync(path.join(pkg,'tests/abl/ContainersVersionAuxHistoryTest.p'),prefix+`
pathValue=SEARCH('sursum-api/programs/ContainersVersionAuxHistoryService.r').
RUN Check(pathValue<>?,'aux history compiled service available').
hb[7]:BUFFER-CREATE(). hb[7]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[7]:BUFFER-FIELD('num_id_tit_ap'):BUFFER-VALUE=5001. hb[7]:BUFFER-FIELD('vl_real'):BUFFER-VALUE=?. hb[7]:BUFFER-FIELD('vl_dolar'):BUFFER-VALUE=0. hb[7]:BUFFER-RELEASE().
hb[8]:BUFFER-CREATE(). hb[8]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[8]:BUFFER-FIELD('desconto_importacao_id'):BUFFER-VALUE=6001. hb[8]:BUFFER-FIELD('vl_autoriz_real'):BUFFER-VALUE=12.34. hb[8]:BUFFER-FIELD('vl_autoriz_dolar'):BUFFER-VALUE=?. hb[8]:BUFFER-RELEASE().
DO i=1 TO 2:
 hb[6]:BUFFER-CREATE(). hb[6]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[6]:BUFFER-FIELD('documento'):BUFFER-VALUE='NF-SAME'. hb[6]:BUFFER-FIELD('serie'):BUFFER-VALUE='1'. hb[6]:BUFFER-FIELD('estab'):BUFFER-VALUE=STRING(i). hb[6]:BUFFER-FIELD('nat_operacao'):BUFFER-VALUE='3101'. hb[6]:BUFFER-FIELD('cod_emitente'):BUFFER-VALUE=1234. hb[6]:BUFFER-FIELD('vl_mercadoria'):BUFFER-VALUE=IF i=1 THEN ? ELSE 0. hb[6]:BUFFER-RELEASE().
END.
resourceName='container_versao_pagtos_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetLogical('success') AND responseValue:GetInteger('total')=1,'persisted payments row').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_real') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_dolar')=0,'payment null distinct from zero').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). requestValue:Add('record_key',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('num_id_tit_ap')=5001,'payment full-key get').
resourceName='container_versao_nfs_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=2,'same document across establishments remains two rows').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Check(INDEX(keyValue,'estab')>0 AND INDEX(keyValue,'nat_operacao')>0 AND INDEX(keyValue,'cod_emitente')>0,'NF full physical key retained').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetCharacter('estab')='1','NF get selects exact establishment').
requestValue:Add('record_key',keyValue + ' '). RUN Invoke. RUN Code(422).
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1002}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=0,'no NF from another version leaked').
resourceName='container_versao_descontos_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1 AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('desconto_importacao_id')=6001,'persisted discount identity').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_autoriz_dolar'),'discount unknown remains null').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetDecimal('vl_autoriz_real')=12.34,'discount detail value retained').
RUN Parse('~{"operation":"read","container_id":456,"versao_id":1001}'). RUN Invoke. RUN Code(404).
RUN Parse('~{"operation":"update","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(405).
DO i=1 TO 4:
 hb[5]:BUFFER-CREATE(). hb[5]:BUFFER-FIELD('versao_id'):BUFFER-VALUE=1001. hb[5]:BUFFER-FIELD('despesa_id'):BUFFER-VALUE=900 + i.
 hb[5]:BUFFER-FIELD('vl_prev'):BUFFER-VALUE=IF i=1 THEN 12.34 ELSE IF i=2 THEN 0 ELSE IF i=3 THEN -1 ELSE ?.
 hb[5]:BUFFER-FIELD('vl_base_imp'):BUFFER-VALUE=?. hb[5]:BUFFER-FIELD('vl_negociado'):BUFFER-VALUE=10. hb[5]:BUFFER-FIELD('log_custo'):BUFFER-VALUE=?. hb[5]:BUFFER-RELEASE().
END.
resourceName='container_versao_despesas_historico_med'.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=1,'expenses require positive known prior value').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetDecimal('vl_prev')=12.34,'singleton SQL SUM equals persisted value').
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('vl_base_imp') AND responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('log_custo'),'expense nulls and unknown group flag preserved').
keyValue=responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('record_key').
RUN Parse('~{"operation":"get","container_id":123,"versao_id":1001}'). requestValue:Add('id',keyValue). RUN Invoke.
RUN Check(responseValue:GetJsonObject('data'):GetInteger('despesa_id')=901,'expense physical key get without nullable group flag').
resourceName='arbitrary'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(422).
RUN Check(NUM-DBS=0 AND NOT TRANSACTION,'aux projections use TT only').
OUTPUT TO 'container-version-aux-history-tests.log'. PUT UNFORMATTED 'PASS ' checks ' NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
DO i=1 TO 8: DELETE OBJECT ht[i] NO-ERROR. END.
RETURN.
`+procedures);
console.log(JSON.stringify({status:'AUX_TEST_PREPARED'}));
