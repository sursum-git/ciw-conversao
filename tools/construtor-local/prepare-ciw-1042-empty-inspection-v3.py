"""Prepare execution of the completed official v3, with the correct ledger relationship."""
from pathlib import Path
import hashlib
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/batch1042-fixture-inspector-v3'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(b/'FixtureInspector.p')=='5bd4eb7f7c65f294f96d0e61f26efad246f05b89e1d981ba98ca5e6bc4edee28'
source=Path(__file__).with_name('prepare-ciw-1042-empty-inspection.py').read_text()
source=source.replace('batch1042-fixture-inspector-v2','batch1042-fixture-inspector-v3').replace('inspector-v2','inspector-v3')
source=source.replace('422a40106069ba3b5ca59843ee12ef818b2f5e829c87f7b71545009866b9ed74',sha(b/'FixtureInspector.p'))
source=source.replace('f93a2aac0c828aac4dcbf975b6a9ecbe2d40a16ff13ab1355c06d5f7a6bedc8e',sha(b/'FixtureInspector.r')).replace('F93A2AAC0C828AAC4DCBF975B6A9ECBE2D40A16FF13AB1355C06D5F7A6BEDC8E',sha(b/'FixtureInspector.r').upper())
source=source.replace("(b/'compile-stderr.log').read_bytes()==b''","(b/'compile-process.log').read_bytes()==b''")
source=source.replace('wrapperReportedFailure=True,wrapperExitCodeUnconfirmed=True','wrapperReportedFailure=False,wrapperExitCodeUnconfirmed=False')
source=source.replace('sourceAndRcodeRemoteHashesMatched=True,downloadOnlySession=85774','rcodeHashWillBeVerifiedOnExecution=True,compileAndDownloadSession=79322')
source=source.replace('$proof.rows.Count -ne 13','$proof.rows.Count -ne 12 -or $proof.indirectLedgerJoinEmptyItems -ne $true -or $proof.ledgerGlobalScan -ne $false')
source=source.replace('13fixedtable','12fixedtable').replace('13table','12table')
exec(compile(source,__file__,'exec'))
