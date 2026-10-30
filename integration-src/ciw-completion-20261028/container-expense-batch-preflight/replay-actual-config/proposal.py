"""Prepare an approval object. No transport, connection or writer exists here."""
from pathlib import Path
import hashlib,json
root=Path(__file__).resolve().parent;w=root.parents[3]
state=w/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/replay-actual-config'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
read=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
prereq=w/'.runtime/ciw-completion-20261028/official-build5-v6/batch-prerequisites/prerequisites-private.json'
cleanup=w/'.runtime/ciw-completion-20261028/container-expense-batch-preflight/cleanup-runtime/cleanup-runtime-proof.json'
p=read(prereq);c=read(cleanup)
assert p['success'] is True and p['sourceContainerUnchanged'] is True and p['authorized'] is False and p['businessWrites'] is False
assert c['success'] is True and c['triggerPreserved'] is True and c['triggerDefinitionChanged'] is False
assert len(c['artifactHashesVerified'])==8 and len(c['aliasesVerified'])==2 and c['medSearchDirectoryFirst'] is True
header=dict(p['header'])
assert header['log_gerar_saldo_a_pagar'] is False and header['log_gerar_distr_custo'] is False and header['log_liberar_custo_realizado'] is False
assert header['ordem_busca_dolar_compra']=='2' and header['ordem_busca_dolar_di']=='4' and header['vl_dolar_compra']==5 and header['vl_dolar_di']==5
canonical=Path('D:/opencode/motor-progress/v2/sursum-api/programs')
quote_sources={name:(canonical/name).read_text(encoding='utf-8-sig')for name in ['ContainersCabecalhoRuntime.p','ContainersCustoRead.p','ContainersCustoReadService.p','ContainersCustoCalculator.p']}
assert 'WHEN "2" THEN dRate=NumberValue(oContainer,"vl-dolar-compra").' in quote_sources['ContainersCustoCalculator.p']
assert 'WHEN "4" THEN dRate=NumberValue(oContainer,"vl_dolar_di").' in quote_sources['ContainersCustoCalculator.p']
assert 'IF dRate<>0 AND dRate<>1 THEN RETURN.' in quote_sources['ContainersCustoCalculator.p']
assert 'IF dtQuote=? THEN UNDO, THROW' in quote_sources['ContainersCustoReadService.p']
quote_proof={'kind':'static-source-proof-not-runtime-collector-execution','headerOrders':['2','4'],'headerPurchaseRate':5,'headerDIRate':5,'resultWhenCollectorPrerequisitesSatisfied':{'compra':5,'di':5},'sourceHashes':[{'path':(canonical/name).as_posix(),'sha256':sha(canonical/name)}for name in quote_sources],
 'requiredBeforeFirstHeaderCreation':['readonly validate current hist_cotacoes_bc latest-valid-series1: dated approved/manual nonzero/nonnegative quote and no divergent valid rates on selected latest date, using exact current collector criteria','verify deployed ContainersCustoRead/ReadService/Calculator and financial totals helper compiled closure plus espec/ems5 connections/auth allow the fiscal_inputs profile; zero items intentionally supported','recheck header orders2/4 and rates5/5/projection valid unchanged; real CollectCalculationInputs not executed by this proof']}
quote_path=state/'quote-static-proof-v1.1.json';quote_path.write_text(json.dumps(quote_proof,indent=2)+'\n',encoding='utf-8')
cid=2147000110;marker='CIW-1042-VALIDACAO-20261028-2147000110'
header['narrativa']=marker
body=lambda resource,operation,**kw:dict(resource=resource,operation=operation,**kw)
changes=lambda operation,a,b:[dict(operation=operation,clientId='CIW-1042-'+name,id={'bind':name+'.id'},original={'bind':name+'.original14'},**({'data':{'vl_prev':amount}}if operation=='update'else{}))for name,amount in [('A',a),('B',b)]]
steps=[
 {'name':'create_header','path':'/SursumPrograms/containers-cabecalho','body':body('containers','create',container_id=cid,values=header)},
 {'name':'create_A','path':'/SursumPrograms/containers-despesas','body':body('container-despesas','create',container_id=cid,values={'despesa_id':4,'vl_prev':1,'vl_base_imp':0,'log_manual':True})},
 {'name':'create_B','path':'/SursumPrograms/containers-despesas','body':body('container-despesas','create',container_id=cid,values={'despesa_id':5,'vl_prev':2,'vl_base_imp':0,'log_manual':True})},
 {'name':'batch_update','path':'/SursumPrograms/containers-despesas-lote','body':body('container-despesas-lote','batch',container_id=cid,changes=changes('update',1.01,2.02))},
 {'name':'concurrent_B','path':'/SursumPrograms/containers-despesas','body':body('container-despesas','update',container_id=cid,id={'bind':'B.id'},values={'vl_prev':2.03})},
 {'name':'stale_batch','expectedStatus':409,'path':'/SursumPrograms/containers-despesas-lote','body':body('container-despesas-lote','batch',container_id=cid,changes=changes('update',1.02,2.04)),'originalsVersion':'snapshot immediately after batch_update, before concurrent_B'},
 {'name':'batch_delete','path':'/SursumPrograms/containers-despesas-lote','body':body('container-despesas-lote','batch',container_id=cid,changes=changes('delete',0,0)),'originalsVersion':'fresh GET after stale refusal'},
 {'name':'cleanup_header','path':'/SursumPrograms/containers-cabecalho','body':body('containers','delete',container_id=cid)}
]
paths={x['path'] for x in steps};assert len(paths)==3
result={'kind':'prepared-authorization-object-not-executed','authorized':False,'businessWrites':False,'containerId':cid,'marker':marker,'companyId':2,'definitionIds':[4,5],
 'target':{'instance':'sursum-api','context':'med','apiBase':'https://192.168.0.111:9911/med/web','program':1042,'transport':'authenticated native runtime; no credential/header persisted'},
 'bindings':{'A.id':'positive server-assigned ID from create_A; definition4/container2147000110/item0/manualtrue; fresh fixed GET must match','B.id':'positive distinct server-assigned ID from create_B; definition5/container2147000110/item0/manualtrue; fresh fixed GET must match','A.original14':'full physical image from fixed native GET, never a user-supplied/free image','B.original14':'full physical image from fixed native GET, never a user-supplied/free image'},
 'runtimeEnvelope':{'batch':'{context:{container_id:2147000110},changes:[...]} signed program1042; fixed mapping produces listed ABL body; actor is session-only'},
 'caps':{'newMaster':1,'selectedExpenses':2,'fiscalExpenses':20,'allExpenses':22,'calculationMemories':4,'newExpenseIds':22,'newCalculationIds':4,'zeroItems':True,'fiscalAmounts':0,'maxSelectedAmountPerField':3,'maxPersistedSelectedAggregate':3.04,'aggregateExplanation':'A.vl_prev1.01+B.vl_prev2.03; failed1.02/2.04 never persisted'},
 'observedTT':{'maxFiscalExpenses':5,'maxAllExpenses':7,'maxMemories':4,'positiveQuotes':[1,7.123],'capturesActualQuotes':False,'checksPerCombination':150,'combinations':4},
 'guards':['recheck exact CID absent before create; no upsert/reuse','create marker exactly once; never copy children from source','IMA direct NOLOCK and config hashes unchanged; capture does not prove business quote collector','verify fixed routes/1042 signed version/session/MED plus existing header/expense preparation cleanup permissions before first mutation','all selected bindings must remain exact container/definitions/item0/manualtrue; stop if extra user records appear','check snapshots fourteen typed physical fields; original retained before concurrent_B','before each step read exact fixture cardinalities/mark and deny any table outside allowlist','confirmed/unknown commit: no retry; inspect exact keys','cleanup recheck CID+marker+all created IDs/subsets; use canonical header delete only; keep trigger intact','cleanup failure: retain exact IDs/report; never SQL-delete, disable trigger or alter PROPATH','after cleanup exact master/expense/memory keys absent; native audit/log retained'],
 'businessAllowlist':{'pp-container':{'key':cid,'requiredMarker':marker},'despesas_container':{'container_id':cid,'ids':'only returned newly-created IDs recorded before next step','max':22},'calcs_imp_container':{'container_id':cid,'ids':'only newly-returned/captured memory IDs, matching physical container_id AND recorded newly-created IDs','max':4,'cleanup':'ContainersCabecalhoRules.PlanDelete(9) by physical container_id; official schema has six fields including container_id'}},
 'forbiddenWrites':['itens_container','itens_proc_compra','procs_compra','financeiro/titulos/pagamentos','custos/versoes','cadastros/configuracoes/IMA','logs cleanup','preexisting user records'],
 'minimumMissingPermissionsOnly':['container_despesas_lote_progress.read','container_despesas_lote_progress.edit','container_despesas_lote_progress.delete'],
 'permissionGate':'root must enumerate exactly which of these are missing for named real operator; no grant/create/process/admin authorized by this file; preparation and cleanup use already-authorized identity',
 'cleanupEvidence':{'currentClosureVerified':True,'artifacts':8,'aliases':2,'actualDeletionExecuted':False,'triggerPreserved':True,'path':cleanup.as_posix(),'sha256':sha(cleanup)},
 'prerequisites':{'path':prereq.as_posix(),'sha256':sha(prereq),'historicalPendingFlags':'configRelationsStillPending superseded by official v1.1+central TT; cleanupTriggerStillPending superseded by current closure proof; no real deletion claimed'},
 'quoteStaticProof':{'path':quote_path.as_posix(),'sha256':sha(quote_path),'realCollectorExecuted':False,'beforeFirstCreationGate':quote_proof['requiredBeforeFirstHeaderCreation']},
 'steps':steps}
out=state/'proposal-private-v1.1.json';out.write_text(json.dumps(result,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
inputs=read(state/'inputs.json')
receipt={'status':'central-TT-green-proposal-prepared-no-business','inputs':inputs,'proposalPath':out.as_posix(),'proposalSha256':sha(out),'cleanupProofSha256':sha(cleanup),'businessWrites':False,'authorized':False,'resultHashes':[]}
for cp in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  q=state/'local'/f'result-{cp}-{culture}.json';d=read(q)
  assert d['success'] is True and d['num_dbs']==0 and d['checks']==150
  for run in d['runs']:
   assert run['maximumFiscalRows']<=20 and run['maximumExpenseRows']<=22 and run['maximumMemories']==4
  receipt['resultHashes'].append({'path':q.as_posix(),'sha256':sha(q),'checks':150,'maximumFiscalRows':max(x['maximumFiscalRows']for x in d['runs']),'maximumExpenseRows':max(x['maximumExpenseRows']for x in d['runs']),'maximumMemories':4})
(state/'verification-v1.1.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8')
print('PASS approval object prepared; proposal SHA256 '+sha(out))
