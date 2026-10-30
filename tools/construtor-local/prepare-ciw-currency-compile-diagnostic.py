"""Fresh compiler-only diagnostic; preserve original failed proof and never run the probe."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028/daily-currency-login-sync';old=R/'integration-src/ciw-completion-20261028/daily-currency-login-sync/probes';B=S/'compile-diagnostic-v1'
assert not B.exists();B.mkdir()
compileSource=(old/'Compile.p').read_text(encoding='utf-8')
needle="DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'COMPILER_CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END."
assert compileSource.count(needle)==1
compileSource=compileSource.replace(needle,"DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'COMPILER_CODE=' ERROR-STATUS:GET-NUMBER(n) ' MESSAGE=' ERROR-STATUS:GET-MESSAGE(n) SKIP. END.")
(B/'Compile.p').write_text(compileSource,encoding='utf-8')
ps=(old/'RunProbe122.ps1').read_text(encoding='utf-8');needle="$compiled=Get-Content -LiteralPath 'compile.log' -Raw";assert ps.count(needle)==1
ps=ps.split(needle)[0]+"Write-Output 'Compiler diagnostic finished; inspect compile.log; probe NOT run'\n"
oldStage='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-currency-dictionary-ro';stage='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-currency-compile-diagnostic-v1'
assert ps.count(oldStage)==1;ps=ps.replace(oldStage,stage);(B/'RunCompileDiagnostic.ps1').write_text(ps,encoding='utf-8')
files=[(B/'Compile.p','Compile.p'),(B/'RunCompileDiagnostic.ps1','RunCompileDiagnostic.ps1'),(old/'v1.1/CurrencyDictionaryReadonlyProbe.p','CurrencyDictionaryReadonlyProbe.p'),(old/'CurrencyDictionaryTable.i','CurrencyDictionaryTable.i'),(S/'dictionary-probe-v1.1/root-dictionary-connections.json','root-dictionary-connections.json')]
plan=dict(server='compiler',directories=[stage],uploads=[dict(local=str(p.relative_to(R)),remote=stage+'/'+n)for p,n in files],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+stage+'/RunCompileDiagnostic.ps1 -ConnectionsFile '+stage+'/root-dictionary-connections.json'],downloads=[dict(local=str((B/n).relative_to(R)),remote=stage+'/'+n)for n in ['compile.log','compile-process.log']])
(B/'remote-plan.json').write_text(json.dumps(plan,indent=2)+'\n');(B/'manifest.json').write_text(json.dumps(dict(compileOnly=True,probeRun=False,businessReads=False,businessWrites=False,files=[dict(path=str(p),sha256=hashlib.sha256(p.read_bytes()).hexdigest())for p,n in files]),indent=2)+'\n')
print('PreparedfreshcompileONLY diagnostics with vendor error text; no probe or business call')
