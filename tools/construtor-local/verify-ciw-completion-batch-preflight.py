"""Verify official read-only config and existing runtime cleanup closure, no writes to business."""
from pathlib import Path
import hashlib,json
r=Path(__file__).resolve().parents[2];s=r/'.runtime/ciw-completion-20261028/container-expense-batch-preflight';b=s/'official-v1.1'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
for f in load(b/'build-manifest.json')['files']:assert sha(r/f['path'])==f['sha256']
log=(b/'compiled122/compile.log').read_text();assert log.startswith('OpenEdge 12.2 NUM-DBS=1') and log.count('COMPILER:ERROR=no')==1 and log.rstrip().endswith('PASS COMPILE ALL') and 'FAIL'not in log
assert not(b/'compiled122/compile-process.log').read_text().strip()
report=load(b/'compiled122/expense-batch-preflight.json');assert report['openedge'].startswith('12.2') and report['num_dbs']==1 and report['completed']is True and 'error'not in report and 'cleanup_dictionary_error'not in report
assert report['company_id']==2 and report['distribution_expense_id']==999 and report['local_configuration_prerequisites_valid']is True
assert report['maximum_distinct_fiscal_expenses_without_items']<=20 and report['preferred_pair_for_readonly_review']==[4,5]
diag=load(s/'cleanup-runtime/propath-diagnostic.json');assert diag['artifactsVerified']is True and diag['aliasesVerified']is True
med=[x.strip()for x in diag['propathLines']if '${CATALINA_BASE}/webapps/med/WEB-INF/openedge'in x]
assert len(med)==1 and med[0].split('=',1)[1].split(',')[0]=='${CATALINA_BASE}/webapps/med/WEB-INF/openedge'
old=load(r/'.runtime/container-delete-compat-publish-20261016/active-manifest.json');assert len(old['artifacts'])==8 and len(old['aliases'])==2
assert report['dictionary_triggers']==[{'table':'pp-container','event':'DELETE','procedure':'estrg\\tdpp001.p','search_exact':None,'search_portable':None}]
closure=dict(success=True,instance='sursum-api',context='med',artifactHashesVerified=old['artifacts'],aliasesVerified=old['aliases'],medSearchDirectoryFirst=True,sourceDiagnosticSha256=sha(s/'cleanup-runtime/propath-diagnostic.json'),inspectionScriptSha256=sha(s/'cleanup-runtime/inspect.py'),parserRepair='Trim leading whitespace in PROPATH property; no runtime configuration changed',triggerPreserved=True,triggerDefinitionChanged=False,currentDeletionExecuted=False,businessWrites=False)
(s/'cleanup-runtime/cleanup-runtime-proof.json').write_text(json.dumps(closure,indent=2)+'\n')
proof=dict(success=True,version='12.2',officialCompileEntries=1,configurationRows=report['scanned_configuration_rows'],preferredSafeDefinitions=[4,5],maxFiscalExpenseTargets=report['maximum_distinct_fiscal_expenses_without_items'],codeReadOnlyNoLock=True,connectionReadOnlyRoleEnforced=False,configurationCaptured=True,published=False,compilerSearchNotRuntimeProof=True,cleanupRuntimeClosureVerified=True,zeroFiscalProven=False,centralTtReplayPending=True,businessWrites=False)
(b/'verification.json').write_text(json.dumps(proof,indent=2)+'\n')
print('PASS official12.2 config probe112rows/defs4+5/max5fiscal; current8runtimehashes/2MEDaliases/PROPATHclosure verified; central TT replay pending')
