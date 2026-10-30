"""Private, read-only OpenEdge 12.2 evidence for the authorized new fixture."""
from pathlib import Path
import json, sys

root = Path(__file__).resolve().parents[2]
state = root / '.runtime/container-allocation-batch-20261026'
phase = sys.argv[1]
assert phase in ['before', 'allocated', 'after']
folder = state / ('physical-' + phase)
assert not folder.exists(), 'Fresh evidence directory required'
folder.mkdir()
ids = []
for file in sorted((state / 'exercise').glob('confirmed-create-item-*.json')):
    receipt = json.loads(file.read_text())
    assert receipt['success'] and receipt['tag'] == 'SC_TEST_ALOC_LOTE_20261026'
    value = receipt['record']['item_proc_compra_id']
    assert type(value) is int and 0 < value <= 2147483647
    ids.append(value)
assert len(ids) <= 3 and len(set(ids)) == len(ids)
code = '''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{sursum-api/includes/ContainerTransactionAudit.i}
DEFINE VARIABLE resultValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.
DEFINE VARIABLE b AS HANDLE NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
DEFINE VARIABLE purchaseIds AS CHARACTER NO-UNDO INITIAL '@IDS@'.
DEFINE VARIABLE indexValue AS INTEGER NO-UNDO.
PROCEDURE Rows:
 DEFINE INPUT PARAMETER tableName AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER predicate AS CHARACTER NO-UNDO.
 DEFINE OUTPUT PARAMETER rows AS JsonArray NO-UNDO.
 DEFINE VARIABLE countValue AS INTEGER NO-UNDO.
 DO ON ERROR UNDO, THROW:
  CREATE BUFFER b FOR TABLE ('espec.' + tableName).
  CREATE QUERY q. q:SET-BUFFERS(b).
  IF NOT q:QUERY-PREPARE('FOR EACH ' + b:NAME + ' NO-LOCK WHERE ' + predicate) THEN UNDO, THROW NEW Progress.Lang.AppError('Fixed read query invalid',1).
  q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK). rows=NEW JsonArray().
  DO WHILE NOT q:QUERY-OFF-END:
   countValue=countValue + 1. IF countValue>1000 THEN UNDO, THROW NEW Progress.Lang.AppError('Scoped probe row limit exceeded',1).
   rows:Add(ProcessSnapshot(b,2147000107)). q:GET-NEXT(NO-LOCK).
  END.
  FINALLY:
   IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
   IF VALID-HANDLE(b) THEN DELETE OBJECT b NO-ERROR.
  END FINALLY.
 END.
END PROCEDURE.
OUTPUT TO 'probe.log'.
DO STOP-AFTER 45 ON STOP UNDO, LEAVE ON ERROR UNDO, THROW:
 IF NUM-DBS<>1 OR LDBNAME(1)<>'espec' OR PROVERSION<>'12.2' THEN UNDO, THROW NEW Progress.Lang.AppError('Official12.2 connected only espec required',1).
 resultValue=NEW JsonObject().
 RUN Rows('pp-container','nr-container=2147000107',OUTPUT rowsValue). resultValue:Add('parents',rowsValue).
 RUN Rows('procs_compra',"cod_proc_fornec='SC_TEST_ALOC_LOTE_20261026'",OUTPUT rowsValue). resultValue:Add('orders',rowsValue).
 RUN Rows('itens_proc_compra',"codigo_erp='ZTSC261026' OR observacao BEGINS 'SC_TEST_ALOC_LOTE_20261026'",OUTPUT rowsValue). resultValue:Add('purchaseItems',rowsValue).
 RUN Rows('itens_container','container_id=2147000107',OUTPUT rowsValue). resultValue:Add('allocations',rowsValue).
 RUN Rows('despesas_container','container_id=2147000107',OUTPUT rowsValue). resultValue:Add('expenses',rowsValue).
 RUN Rows('calcs_imp_container','container_id=2147000107',OUTPUT rowsValue). resultValue:Add('calculations',rowsValue).
 RUN Rows('pagtos_container','container_id=2147000107',OUTPUT rowsValue). resultValue:Add('containerPayments',rowsValue).
 RUN Rows('versoes_item_custo_container','container_id=2147000107',OUTPUT rowsValue). resultValue:Add('versions',rowsValue).
 RUN Rows('pp-it-container','nr-container=2147000107',OUTPUT rowsValue). resultValue:Add('commercial',rowsValue).
 RUN Rows('item_custos',"it_codigo='ZTSC261026'",OUTPUT rowsValue). resultValue:Add('erpCosts',rowsValue).
 @LEDGER@
 resultValue:Add('readOnly',TRUE). resultValue:Add('success',TRUE). resultValue:Add('containerId',2147000107).
 resultValue:WriteFile('probe.json',TRUE). PUT UNFORMATTED 'PASS read-only new allocation fixture probe' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' err:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
'''
ledger = "RUN Rows('cta_corren_fornec_imp','" + ' OR '.join('item_proc_compra_id=' + str(v) for v in ids) + "',OUTPUT rowsValue). resultValue:Add('ledger',rowsValue)." if ids else "resultValue:Add('ledger',NEW JsonArray())."
code = code.replace('@IDS@', ','.join(map(str, ids))).replace('@LEDGER@', ledger)
(folder / 'AllocationProbe.p').write_text(code)
include = root / 'integration-src/container-allocation-batch/abl/ContainerTransactionAudit.i'
local_include = folder / 'sursum-api/includes'
local_include.mkdir(parents=True)
(local_include / include.name).write_bytes(include.read_bytes())
(folder / 'CompileProbe.p').write_text("OUTPUT TO 'compile.log'. COMPILE AllocationProbe.p SAVE NO-ERROR. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' COMPILER:ERROR=' COMPILER:ERROR SKIP. IF COMPILER:ERROR THEN DO: DEFINE VARIABLE n AS INTEGER NO-UNDO. DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END. END. OUTPUT CLOSE. QUIT.\n")
remote = 'C:/Users/tadeu.parreiras/codex-allocation-20261026-probe-' + phase
ps = f"""$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -p CompileProbe.p *> compile-process.log
Get-Content -LiteralPath compile.log
if((Get-Content -LiteralPath compile.log -Raw) -notmatch 'COMPILER:ERROR=no'){{throw 'Readonly probe compile failed'}}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -p AllocationProbe.r *> probe-process.log
Get-Content -LiteralPath probe.log
if(!(Test-Path -LiteralPath probe.json)){{Get-Content -LiteralPath probe-process.log;throw 'Readonly probe unconfirmed'}}
"""
(folder / 'run.ps1').write_text(ps)
files = [p for p in folder.rglob('*') if p.is_file()]
plan = dict(server='compiler', directories=[remote,remote+'/sursum-api',remote+'/sursum-api/includes'],
            uploads=[dict(local=str(p.relative_to(root)),remote=remote+'/'+p.relative_to(folder).as_posix()) for p in files],
            commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/run.ps1'],
            downloads=[dict(local=str((folder/n).relative_to(root)),remote=remote+'/'+n,optional=True) for n in ['compile.log','compile-process.log','probe.json','probe.log','probe-process.log']])
(folder/'plan.json').write_text(json.dumps(plan,indent=2))
print('Prepared fixed readonly allocation probe:', phase)
