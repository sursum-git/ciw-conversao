"""Prepara leitura fixa do dicionário, sem ler registros comerciais ou aplicar DDL."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2]
b=r/'.runtime/ciw-completion-20261028/schema'
p=b/'package';assert not p.exists();p.mkdir(parents=True)
source='''USING Progress.Json.ObjectModel.*.
DEFINE VARIABLE tablesValue AS CHARACTER NO-UNDO INITIAL "desenhos,tipos_desenho,item_container_custos,versoes_item_custo_container,calcs_imp_container,despesas_container,itens_container,pp_container".
DEFINE VARIABLE k AS INTEGER NO-UNDO.
DEFINE VARIABLE nameValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE fileValue AS CHARACTER NO-UNDO.
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowValue AS JsonObject NO-UNDO.
DEFINE VARIABLE fieldsValue AS JsonArray NO-UNDO.
DEFINE VARIABLE indexesValue AS JsonArray NO-UNDO.
DEFINE VARIABLE triggersValue AS JsonArray NO-UNDO.
DEFINE VARIABLE referencesValue AS JsonArray NO-UNDO.
DEFINE VARIABLE indexFieldsValue AS JsonArray NO-UNDO.
DEFINE BUFFER relatedFile FOR espec._File.
DEFINE BUFFER indexField FOR espec._Field.
DO k=1 TO NUM-ENTRIES(tablesValue):
 nameValue=ENTRY(k,tablesValue).
 resultValue=NEW JsonObject().
 resultValue:Add("database","espec"). resultValue:Add("table",nameValue).
 FIND FIRST espec._File NO-LOCK WHERE espec._File._File-Name=nameValue NO-ERROR.
 resultValue:Add("found",AVAILABLE espec._File).
 IF AVAILABLE espec._File THEN DO:
  fieldsValue=NEW JsonArray(). indexesValue=NEW JsonArray(). triggersValue=NEW JsonArray(). referencesValue=NEW JsonArray().
  FOR EACH espec._Field NO-LOCK WHERE espec._Field._File-recid=RECID(espec._File) BY espec._Field._Order:
   rowValue=NEW JsonObject().
   rowValue:Add("name",espec._Field._Field-Name). rowValue:Add("type",espec._Field._Data-Type).
   rowValue:Add("format",espec._Field._Format). rowValue:Add("initial",espec._Field._Initial).
   rowValue:Add("mandatory",espec._Field._Mandatory). rowValue:Add("extent",espec._Field._Extent).
   rowValue:Add("validation",espec._Field._Valexp). fieldsValue:Add(rowValue).
  END.
  FOR EACH espec._Index NO-LOCK WHERE espec._Index._File-recid=RECID(espec._File):
   rowValue=NEW JsonObject(). indexFieldsValue=NEW JsonArray().
   rowValue:Add("name",espec._Index._Index-Name). rowValue:Add("unique",espec._Index._Unique).
   rowValue:Add("primary",RECID(espec._Index)=espec._File._Prime-Index).
   FOR EACH espec._Index-field NO-LOCK WHERE espec._Index-field._Index-recid=RECID(espec._Index) BY espec._Index-field._Index-Seq:
    FIND indexField NO-LOCK WHERE RECID(indexField)=espec._Index-field._Field-recid.
    indexFieldsValue:Add(indexField._Field-Name).
   END.
   rowValue:Add("fields",indexFieldsValue). indexesValue:Add(rowValue).
  END.
  FOR EACH espec._File-trig NO-LOCK WHERE espec._File-trig._File-recid=RECID(espec._File):
   rowValue=NEW JsonObject(). rowValue:Add("event",espec._File-trig._Event).
   rowValue:Add("procedure",espec._File-trig._Proc-Name). triggersValue:Add(rowValue).
  END.
  IF LOOKUP(nameValue,"desenhos,tipos_desenho")>0 THEN DO:
   FOR EACH espec._Field NO-LOCK WHERE espec._Field._Field-Name=(IF nameValue="desenhos" THEN "desenho_id" ELSE "tipo_desenho_id"):
    FIND relatedFile NO-LOCK WHERE RECID(relatedFile)=espec._Field._File-recid NO-ERROR.
    IF AVAILABLE relatedFile AND relatedFile._File-Number>0 AND relatedFile._File-Name<>nameValue THEN DO:
     rowValue=NEW JsonObject(). rowValue:Add("table",relatedFile._File-Name).
     rowValue:Add("field",espec._Field._Field-Name). referencesValue:Add(rowValue).
    END.
   END.
  END.
  resultValue:Add("fields",fieldsValue). resultValue:Add("indexes",indexesValue).
  resultValue:Add("triggers",triggersValue). resultValue:Add("references",referencesValue).
 END.
 fileValue = "schema-" + nameValue + ".json".
 resultValue:WriteFile(fileValue,TRUE).
END.
OUTPUT TO "schema-pass.log".
PUT UNFORMATTED "OpenEdge " PROVERSION " NUM-DBS=" NUM-DBS SKIP "PASS dictionary readonly " NUM-ENTRIES(tablesValue) SKIP.
OUTPUT CLOSE.
QUIT.
'''
(p/'ReadCiwCompletionSchema.p').write_text(source,encoding='utf-8')
remote='C:/Users/tadeu.parreiras/codex-ciw-completion-schema-20261028'
(p/'schema.ps1').write_text('''$ErrorActionPreference='Stop'
Set-Location -LiteralPath 'REMOTE'
$avm='C:/Progress_12/OE/bin/_progres.exe'
$env:DLC='C:/Progress_12/OE'
$env:PROPATH=$PWD.Path
& $avm -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p ReadCiwCompletionSchema.p *> schema-process.log
if(!(Test-Path -LiteralPath schema-pass.log)){Get-Content schema-process.log -Raw;throw 'Schema unconfirmed'}
$log=Get-Content schema-pass.log -Raw
if($log -notmatch 'OpenEdge 12[.]2' -or $log -notmatch 'PASS dictionary readonly 8'){throw 'Wrong version or incomplete schema'}
Write-Output $log
'''.replace('REMOTE',remote),encoding='utf-8')
names=['schema-'+t+'.json'for t in ['desenhos','tipos_desenho','item_container_custos','versoes_item_custo_container','calcs_imp_container','despesas_container','itens_container','pp_container']]+['schema-pass.log','schema-process.log']
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str(q.relative_to(r)),remote=remote+'/'+q.name)for q in p.iterdir()],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/schema.ps1'],downloads=[dict(local=str((b/n).relative_to(r)),remote=remote+'/'+n,optional=n!='schema-process.log')for n in names])
(b/'plan.json').write_text(json.dumps(plan,indent=2)+'\n',encoding='utf-8')
print('Prepared readonly dictionary for8tables; no records or schema writes')
