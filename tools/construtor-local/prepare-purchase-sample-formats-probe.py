"""Read-only physical evidence, fixed new scenario only. Never published."""
from pathlib import Path
import json,sys
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-sample-formats-20261027';phase=sys.argv[1];assert phase in ['before','maintained','after']
folder=b/('physical-'+phase);assert not folder.exists();folder.mkdir()
pid=iid=0
for key,field in [('create-parent','proc_compra_id'),('create-item','item_proc_compra_id')]:
 p=b/'exercise'/('confirmed-'+key+'.json')
 if p.exists():
  v=json.loads(p.read_text());assert v['success']and v['tag']=='SC_TEST_PROC_FORMATOS_20261027';n=v['record'][field];assert type(n)is int and 0<n<=2147483647
  if field=='proc_compra_id':pid=n
  else:iid=n
code='''BLOCK-LEVEL ON ERROR UNDO, THROW.
USING Progress.Json.ObjectModel.*.
{sursum-api/includes/ContainerTransactionAudit.i}
DEFINE VARIABLE rootValue AS JsonObject NO-UNDO.
DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.
DEFINE VARIABLE imageValue AS JsonObject NO-UNDO.
DEFINE VARIABLE b AS HANDLE NO-UNDO.
DEFINE VARIABLE q AS HANDLE NO-UNDO.
PROCEDURE Rows:
 DEFINE INPUT PARAMETER tableName AS CHARACTER NO-UNDO.
 DEFINE INPUT PARAMETER predicate AS CHARACTER NO-UNDO.
 DEFINE OUTPUT PARAMETER rows AS JsonArray NO-UNDO.
 DO ON ERROR UNDO, THROW:
  CREATE BUFFER b FOR TABLE ('espec.' + tableName).
  CREATE QUERY q. q:SET-BUFFERS(b).
  IF NOT q:QUERY-PREPARE('FOR EACH ' + b:NAME + ' NO-LOCK WHERE ' + predicate) THEN UNDO, THROW NEW Progress.Lang.AppError('Fixed read query invalid',1).
  q:QUERY-OPEN(). q:GET-FIRST(NO-LOCK). rows=NEW JsonArray().
  DO WHILE NOT q:QUERY-OFF-END:
   IF rows:Length>=1000 THEN UNDO, THROW NEW Progress.Lang.AppError('Read limit',1).
   imageValue=ProcessSnapshot(b,0). imageValue:Remove('container_id'). rows:Add(imageValue). q:GET-NEXT(NO-LOCK).
  END.
  FINALLY:
   IF VALID-HANDLE(q) THEN DO: q:QUERY-CLOSE() NO-ERROR. DELETE OBJECT q NO-ERROR. END.
   IF VALID-HANDLE(b) THEN DELETE OBJECT b NO-ERROR.
  END FINALLY.
 END.
END PROCEDURE.
OUTPUT TO 'probe.log'.
DO STOP-AFTER 60 ON STOP UNDO, LEAVE ON ERROR UNDO, THROW:
 IF PROVERSION<>'12.2' OR NUM-DBS<>2 OR NOT CONNECTED('espec') OR NOT CONNECTED('ems2cad') THEN UNDO, THROW NEW Progress.Lang.AppError('Official12.2 espec/ems2cad only',1).
 rootValue=NEW JsonObject().
 RUN Rows('formatos_amostra','TRUE',OUTPUT rowsValue). rootValue:Add('formats',rowsValue).
 RUN Rows('procs_compra',"cod_proc_fornec='SC_TEST_PROC_FORMATOS_20261027' OR proc_compra_id=@PID@ AND @PID@>0",OUTPUT rowsValue). rootValue:Add('orders',rowsValue).
 RUN Rows('itens_proc_compra',"observacao='SC_TEST_PROC_FORMATOS_20261027' OR proc_compra_id=@PID@ AND @PID@>0 OR item_proc_compra_id=@IID@ AND @IID@>0",OUTPUT rowsValue). rootValue:Add('purchaseItems',rowsValue).
 RUN Rows('cta_corren_fornec_imp','item_proc_compra_id=@IID@ AND @IID@>0',OUTPUT rowsValue). rootValue:Add('ledger',rowsValue).
 RUN Rows('itens_container','item_proc_compra_id=@IID@ AND @IID@>0',OUTPUT rowsValue). rootValue:Add('allocations',rowsValue).
 RUN Rows('envios_amostras_repres','item_proc_compra_id=@IID@ AND @IID@>0',OUTPUT rowsValue). rootValue:Add('samples',rowsValue).
 FIND ems2cad.emitente WHERE ems2cad.emitente.cod-emitente=26715 NO-LOCK NO-ERROR.
 IF NOT AVAILABLE ems2cad.emitente THEN UNDO,THROW NEW Progress.Lang.AppError('Read-only supplier absent',1).
 imageValue=NEW JsonObject(). imageValue:Add('id',ems2cad.emitente.cod-emitente). imageValue:Add('nome_abrev',ems2cad.emitente.nome-abrev). imageValue:Add('nome_emit',ems2cad.emitente.nome-emit). rootValue:Add('supplier',imageValue).
 rootValue:Add('sequenceCurrent',DYNAMIC-CURRENT-VALUE('seq_formatos_amostra','espec')).
 rootValue:Add('success',TRUE). rootValue:Add('readOnly',TRUE). rootValue:Add('version',PROVERSION). rootValue:Add('phase','@PHASE@'). rootValue:Add('tag','SC_TEST_PROC_FORMATOS_20261027').
 rootValue:WriteFile('probe.json',TRUE). PUT UNFORMATTED 'PASS fixed read-only sample-format fixture probe' SKIP.
 CATCH err AS Progress.Lang.Error: PUT UNFORMATTED 'FAIL ' err:GetMessage(1) SKIP. END CATCH.
END.
OUTPUT CLOSE. QUIT.
'''.replace('@PID@',str(pid)).replace('@IID@',str(iid)).replace('@PHASE@',phase)
(folder/'FormatsProbe.p').write_text(code)
inc=folder/'sursum-api/includes';inc.mkdir(parents=True);(inc/'ContainerTransactionAudit.i').write_bytes((r/'integration-src/container-allocation-batch/abl/ContainerTransactionAudit.i').read_bytes())
(folder/'CompileProbe.p').write_text("OUTPUT TO 'compile.log'. COMPILE FormatsProbe.p SAVE NO-ERROR. PUT UNFORMATTED 'OpenEdge ' PROVERSION ' COMPILER:ERROR=' COMPILER:ERROR SKIP. IF COMPILER:ERROR THEN DO: DEFINE VARIABLE n AS INTEGER NO-UNDO. DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END. END. OUTPUT CLOSE. QUIT.\n")
remote='C:/Users/tadeu.parreiras/codex-formats-20261027-probe-'+phase
ps=f"""$ErrorActionPreference='Stop'
Set-Location -LiteralPath '{remote}'
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -db ems2cad -H 192.168.0.111 -S 10033 -N TCP -ld ems2cad -p CompileProbe.p *> compile-process.log
Get-Content -LiteralPath compile.log
if((Get-Content -LiteralPath compile.log -Raw) -notmatch 'COMPILER:ERROR=no'){{throw 'Probe compile failed'}}
& 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8 -db espec -H 192.168.0.111 -S 10012 -N TCP -ld espec -db ems2cad -H 192.168.0.111 -S 10033 -N TCP -ld ems2cad -p FormatsProbe.r *> probe-process.log
Get-Content -LiteralPath probe.log
if(!(Test-Path -LiteralPath probe.json)){{Get-Content -LiteralPath probe-process.log;throw 'Probe unconfirmed'}}
"""
(folder/'run.ps1').write_text(ps)
files=[p for p in folder.rglob('*')if p.is_file()]
plan=dict(server='compiler',directories=[remote,remote+'/sursum-api',remote+'/sursum-api/includes'],uploads=[dict(local=str(p.relative_to(r)),remote=remote+'/'+p.relative_to(folder).as_posix())for p in files],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/run.ps1'],downloads=[dict(local=str((folder/n).relative_to(r)),remote=remote+'/'+n,optional=True)for n in ['compile.log','compile-process.log','probe.json','probe.log','probe-process.log']]);(folder/'plan.json').write_text(json.dumps(plan,indent=2));print('Prepared fixed read-only probe '+phase)
