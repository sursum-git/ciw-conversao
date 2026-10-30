const fs=require('node:fs'),path=require('node:path');const dest=__dirname,pkg=path.resolve(dest,'../..'),base=path.join(pkg,'frozen-aux-v1.1'),mainBase=path.join(pkg,'frozen-v1.4');
const declarations=`DEFINE TEMP-TABLE v4Alloc NO-UNDO FIELD item_container_id AS INTEGER FIELD item_proc_compra_id AS INTEGER INDEX pk IS UNIQUE PRIMARY item_container_id.
DEFINE TEMP-TABLE v4Item NO-UNDO FIELD item_proc_compra_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS UNIQUE PRIMARY item_proc_compra_id.
DEFINE TEMP-TABLE v4Emitter NO-UNDO FIELD cod-emitente AS INTEGER FIELD nome-abrev AS CHARACTER INDEX pk IS UNIQUE PRIMARY cod-emitente.
DEFINE TEMP-TABLE v4Expense NO-UNDO FIELD despesa_id AS INTEGER FIELD descricao AS CHARACTER INDEX pk IS UNIQUE PRIMARY despesa_id.
`;
const fixture=`CREATE v4Alloc. ASSIGN v4Alloc.item_container_id=999 v4Alloc.item_proc_compra_id=321. RELEASE v4Alloc.
CREATE v4Item. ASSIGN v4Item.item_proc_compra_id=321 v4Item.descricao='CURRENT DESCRIPTION'. RELEASE v4Item.
CREATE v4Emitter. ASSIGN v4Emitter.cod-emitente=1234 v4Emitter.nome-abrev='CURRENT EMITTER'. RELEASE v4Emitter.
CREATE v4Expense. ASSIGN v4Expense.despesa_id=901 v4Expense.descricao='CURRENT EXPENSE'. RELEASE v4Expense.
`;
for(const [file,aux]of [['ContainersVersionHistoryTest.p',false],['ContainersVersionAuxHistoryTest.p',true]]){let s=fs.readFileSync(path.join(aux?base:mainBase,'tests/abl',file),'utf8').replaceAll('\r\n','\n');s=s.replace('{ContainersVersionHistoryTestTables.i}',declarations+'{ContainersVersionHistoryTestTables.i}');s=s.replace("pathValue=SEARCH('sursum-api/programs/"+(aux?'ContainersVersionAuxHistoryService':'ContainersVersionHistoryService')+".r').",fixture+"pathValue=SEARCH('sursum-api/programs/"+(aux?'ContainersVersionAuxHistoryService':'ContainersVersionHistoryService')+".r').");
 if(!aux){s=s.replace('hb[8],requestValue,OUTPUT responseValue','hb[8],INPUT BUFFER v4Alloc:HANDLE,INPUT BUFFER v4Item:HANDLE,requestValue,OUTPUT responseValue');s=s.replace("RUN Check(responseValue:GetLogical('success'),'read succeeds').","RUN Check(responseValue:GetLogical('success'),'read succeeds').\nRUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):GetCharacter('item_descricao_atual')='CURRENT DESCRIPTION','current label projected before reader').");s=s.replace('/* The trusted internal','/* The trusted internal');s=s.replace('/* The trusted internal ceiling',`FIND v4Alloc WHERE v4Alloc.item_container_id=999. DELETE v4Alloc.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"take":1}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('item_descricao_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('item_container_id')=999,'deleted current allocation preserves historical item and null label').
/* The trusted internal ceiling`);}
 else{s=s.replace('hb[8],resourceName,requestValue,OUTPUT responseValue','hb[8],resourceName,INPUT BUFFER v4Emitter:HANDLE,INPUT BUFFER v4Expense:HANDLE,requestValue,OUTPUT responseValue');s=s.replace("RUN Check(responseValue:GetJsonObject('data'):GetCharacter('estab')='1','NF get selects exact establishment').","RUN Check(responseValue:GetJsonObject('data'):GetCharacter('estab')='1','NF get selects exact establishment').\nRUN Check(responseValue:GetJsonObject('data'):GetCharacter('emitente_nome_abrev_atual')='CURRENT EMITTER','NF current name projected before reader').");s=s.replace("RUN Check(responseValue:GetJsonObject('data'):GetInteger('despesa_id')=901,'expense physical key get without nullable group flag').","RUN Check(responseValue:GetJsonObject('data'):GetInteger('despesa_id')=901,'expense physical key get without nullable group flag').\nRUN Check(responseValue:GetJsonObject('data'):GetCharacter('despesa_descricao_atual')='CURRENT EXPENSE','expense current description projected').");s=s.replace("resourceName='arbitrary'.",`FIND v4Emitter WHERE v4Emitter.cod-emitente=1234. DELETE v4Emitter.
resourceName='container_versao_nfs_historico_med'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('emitente_nome_abrev_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('cod_emitente')=1234,'deleted emitter preserves physical historical ID').
FIND v4Expense WHERE v4Expense.despesa_id=901. DELETE v4Expense.
resourceName='container_versao_despesas_historico_med'. RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke.
RUN Check(responseValue:GetJsonArray('data'):GetJsonObject(1):IsNull('despesa_descricao_atual') AND responseValue:GetJsonArray('data'):GetJsonObject(1):GetInteger('despesa_id')=901,'deleted expense label does not hide history').
resourceName='arbitrary'.`);}
 if(!aux){s=s.replace('DEFINE TEMP-TABLE v4Alloc','DEFINE VARIABLE currentItemHandle AS HANDLE NO-UNDO.\nDEFINE TEMP-TABLE v4Alloc');s=s.replace("pathValue=SEARCH('sursum-api/programs/ContainersVersionHistoryService.r').", "currentItemHandle=BUFFER v4Item:HANDLE.\npathValue=SEARCH('sursum-api/programs/ContainersVersionHistoryService.r').");s=s.replace('INPUT BUFFER v4Item:HANDLE,requestValue','currentItemHandle,requestValue');s=s.replace('FIND v4Alloc WHERE v4Alloc.item_container_id=999. DELETE v4Alloc.',`RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"filter":~{"field":"item_descricao_atual","operator":"eq","value":"CURRENT DESCRIPTION"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=205,'current description is available to global filter before pagination').
FIND v4Item WHERE v4Item.item_proc_compra_id=321. v4Item.descricao='UPDATED DESCRIPTION'. RELEASE v4Item.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001,"filter":~{"field":"item_descricao_atual","operator":"eq","value":"UPDATED DESCRIPTION"}}'). RUN Invoke.
RUN Check(responseValue:GetInteger('total')=205,'next request uses changed current description without a cache').
FIND v4Alloc WHERE v4Alloc.item_container_id=999. DELETE v4Alloc.`);s=s.replace('/* The trusted internal ceiling',`CREATE v4Alloc. ASSIGN v4Alloc.item_container_id=999 v4Alloc.item_proc_compra_id=321. RELEASE v4Alloc.
currentItemHandle=BUFFER brokenMaster:HANDLE.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(503).
RUN Check(NOT responseValue:Has('data'),'lookup query error returns no partial historical data').
currentItemHandle=BUFFER v4Item:HANDLE.
/* The trusted internal ceiling`);}
 fs.writeFileSync(path.join(dest,'tests',file),s);
}
fs.copyFileSync(path.join(base,'tests/abl/ContainersVersionHistoryTestTables.i'),path.join(dest,'tests/ContainersVersionHistoryTestTables.i'));
console.log(JSON.stringify({status:'FUTURE_PRODUCT_TT_PREPARED'}));
