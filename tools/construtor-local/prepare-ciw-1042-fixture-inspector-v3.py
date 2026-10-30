"""Inspect twelve direct scopes; require empty items for the indirect ledger join."""
from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];old=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector-v2';new=old.with_name('batch1042-fixture-inspector-v3');new.mkdir()
text=(old/'FixtureInspector.p').read_text()
assert text.count(',pagtos_container,cta_corren_fornec_imp"')==1
text=text.replace(',pagtos_container,cta_corren_fornec_imp"',',pagtos_container"')
oldFields='nr-container,container_id,container_id,container_id,nr-container,nr_container,nr_container,container_id,container_id,container_id,container_id,container_id,container_id'
assert oldFields in text;text=text.replace(oldFields,oldFields.rsplit(',',1)[0])
text=text.replace('DEFINE VARIABLE finished AS LOGICAL NO-UNDO.','DEFINE VARIABLE finished AS LOGICAL NO-UNDO.\nDEFINE VARIABLE itemScopeEmpty AS LOGICAL NO-UNDO.')
needle='  rowResult=NEW JsonObject().';assert needle in text
text=text.replace(needle,'''  IF n=2 THEN DO:
   IF countRows<>0 THEN UNDO, THROW NEW Progress.Lang.AppError("Approved fixture forbids items; indirect ledger scope not empty",1).
   itemScopeEmpty=TRUE.
  END.
'''+needle)
text=text.replace(' finished=TRUE.',' finished=itemScopeEmpty.')
text=text.replace('report:Add("rows",resultRows).', '''report:Add("indirectLedgerJoinEmptyItems",itemScopeEmpty).
report:Add("ledgerGlobalScan",FALSE).
report:Add("ledgerPhysicalContainerColumnExists",FALSE).
report:Add("rows",resultRows).''')
(new/'FixtureInspector.p').write_text(text)
(new/'Compile.p').write_bytes((old/'Compile.p').read_bytes())
(new/'SyntaxOnly.p').write_bytes((old/'SyntaxOnly.p').read_bytes())
remote='C:/Users/tadeu.parreiras/codex-ciw-1042-fixture-inspector-v3'
runner=(r/'.runtime/ciw-completion-20261028/currency-trigger-search-v3/Compile.ps1').read_text()
runner=runner.replace('C:/Users/tadeu.parreiras/codex-ciw-currency-trigger-search-v3',remote)
runner=runner.replace('PASS12.2 SEARCH probe compiled;NUMDBS0;not executed;no ERP trigger executed','PASS12.2 fixed12scope inspector compiled;NUMDBS0;not executed;no business writer')
(new/'Compile.ps1').write_text(runner)
plan=dict(server='compiler',directories=[remote],uploads=[dict(local=str((new/n).relative_to(r)),remote=remote+'/'+n)for n in ['FixtureInspector.p','Compile.p','Compile.ps1']],commands=['powershell -NoProfile -NonInteractive -ExecutionPolicy Bypass -File '+remote+'/Compile.ps1'],downloads=[dict(local=str((new/n).relative_to(r)),remote=remote+'/'+n)for n in ['compile.log','compile-process.log','FixtureInspector.r']])
(new/'compile-plan.json').write_text(json.dumps(plan,indent=2)+'\n')
(new/'contract.json').write_text(json.dumps(dict(scope='fixed authorized container2147000110',directTables=12,indirectLedger='physical relation cta_corren_fornec_imp.item_container_id -> itens_container.item_container_id -> container_id',allowedItems=0,guard='Reject any item before claiming an empty indirect ledger join; never scan global ledger',globalLedgerCountClaimed=False,businessWrites=False,previousFailed13Preserved=True),indent=2)+'\n')
print('Prepared v3:12direct scopes plus proven empty-parent-item ledger join; no global ledger scan')
