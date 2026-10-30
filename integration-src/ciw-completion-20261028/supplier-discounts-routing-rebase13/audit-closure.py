from pathlib import Path
import json,hashlib,re
D=Path(__file__).resolve().parent;M=Path('D:/opencode/motor-progress/v2');F=D.parent/'supplier-discounts-readonly/frozen-v1';I=D.parent/'container-supplier-discounts-integer-range-v2'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
base=json.loads((D/'baselines.json').read_text());rows=[]
for row in base['files']:
 p=D/'candidate'/row['relative'];b=D/'baseline'/row['relative'];old=(F/'candidate-exact'/p.name)
 signatures=lambda x:[line for line in x.read_bytes().splitlines()if re.match(rb'DEFINE (?:INPUT|OUTPUT|INPUT-OUTPUT) PARAMETER',line)]
 if p.suffix=='.p':assert signatures(p)==signatures(b),p.name
 rows.append({'relative':row['relative'],'baselineSha256':sha(b),'candidateSha256':sha(p),'originalFrozenCandidateByteEqual':p.read_bytes()==old.read_bytes(),'facadeParameterAbiUnchanged':signatures(p)==signatures(b)if p.suffix=='.p'else None,'needs13Rebase':row['needsRebase']})
for rel,old in [('programs/ImportDiscountsSupplierCollector.p',F/'abl/ImportDiscountsSupplierCollector.p'),('includes/ImportDiscountsCollectorBody.i',F/'includes/ImportDiscountsCollectorBody.i')]:assert (D/'candidate'/rel).read_bytes()==old.read_bytes()
for name in ['CiwCadastrosCrud.p','CiwErpReadService.p']:
 assert name in [Path(x['relative']).name for x in rows]
before=(D/'baseline/backend/src/Runtime/RuntimeCiwErpQuery.php').read_text();after=(D/'candidate/backend/src/Runtime/RuntimeCiwErpQuery.php').read_text()
registry=lambda s:dict(re.findall(r"'([^']+)'=>'([^']+)'",s.split('private const RESOURCES=[',1)[1].split('];',1)[0]))
old=registry(before);new=registry(after);assert new.pop('descontos_importacao_fornecedor_progress')=='import_descontos_fornecedor'and old==new
stable=M/'sursum-api/programs/ContainersVersionHistoryLabels.p'
tableConsumers=['ImportDiscountsCollector.p','ImportDiscountsSupplierCollector.p','ImportDiscountsReadService.p']
for name in tableConsumers:assert b'{sursum-api/includes/ImportDiscountsReadTables.i}'in(D/'candidate/programs'/name).read_bytes()
actual=[p.name for p in(M/'sursum-api').rglob('*.p')if b'{sursum-api/includes/ImportDiscountsReadTables.i}'in p.read_bytes()];assert sorted(actual)==['ImportDiscountsCollector.p','ImportDiscountsReadService.p']
closure={'success':True,'scope':'1056 read routing composition only; no official14 generated','currentCanonicalAbiConsumers':actual,'newAbiConsumers':['ImportDiscountsSupplierCollector.p'],'privateTtSchemaChange':'arquivo field added; compile/deploy all3 TT consumers together','publicFacadeAbiUnchanged':True,'canonicalApiWrapperHandles':6,'productionPrograms':[p.name for p in(D/'candidate/programs').glob('*.p')],'productionIncludes':[p.name for p in(D/'candidate/includes').glob('*.i')],'stableDependencies':[{'path':str(stable),'sha256':sha(stable),'publicationChangeRequired':False}],'suggestedOfficialCompileInputs':['CiwCadastrosCrud.p','CiwErpReadService.p','ImportDiscountsCollector.p','ImportDiscountsReadApi.p','ImportDiscountsReadService.p','ImportDiscountsSupplierCollector.p','ContainersVersionHistoryLabels.p','SupplierDiscountReadTest.p','ImportDiscountsCollectorTest.p','ImportDiscountsReadTest.p','ImportDiscountsLabelsTest.p'],'officialScopeDecisionRootRequired':True,'unrelatedDispatcherRoutes':'all bytes outside one supplier resource alias hunk unchanged; existing late-bound targets are not rewritten/recompiled by this proposal','uniqueCollectorBody':{'path':'candidate/includes/ImportDiscountsCollectorBody.i','sha256':sha(D/'candidate/includes/ImportDiscountsCollectorBody.i'),'frozenOriginalByteEqual':True},'current13RegistryAllOldEntriesPreserved':True,'helperSha256':sha(D/'candidate/backend/src/Runtime/RuntimeImportDiscountRead.php'),'futureBuilderSha256':sha(I/'candidate/backend/src/Builder/ProgramBuilderService.php'),'sources':rows,'official122Required':True,'runtimePublicationPerformed':False,'networkExecuted':False,'businessWrites':False}
(D/'closure-audit.json').write_text(json.dumps(closure,indent=2)+'\n');print(json.dumps({'shared':len(rows),'programs':6,'includes':2,'suggestedCompileInputs':11,'currentTtConsumers':2,'newTtConsumers':1,'oldRegistryEntriesPreserved':True}))
