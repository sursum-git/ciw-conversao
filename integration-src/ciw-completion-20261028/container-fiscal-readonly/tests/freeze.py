"""Emit a hash-frozen handoff after verify-all; never integrates canonical files."""
from pathlib import Path
import hashlib,json,datetime,re
root=Path(__file__).resolve().parents[1];workspace=Path('D:/opencode/conversao-sc')
state=workspace/'.runtime/ciw-completion-20261028/container-fiscal-readonly'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def write(p,d):p.write_text(json.dumps(d,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
def logtext(p):return p.read_text(encoding='utf-16'if p.read_bytes().startswith(b'\xff\xfe')else'utf-8-sig')
logs={n:logtext(state/n)for n in ['abl-local-final.log','php-routing-final.log','php-real-read-final.log','builder-preview-final.log','native-js-final.log']}
assert logs['abl-local-final.log'].count('PASS fiscal checks=41')==4
assert logs['abl-local-final.log'].count('PASS 47 checks')==4
assert logs['abl-local-final.log'].count('PASS 9 checks')==4
assert 'checks=56' in logs['php-routing-final.log'] and 'checks=30' in logs['native-js-final.log']
assert 'checks=36' in logs['php-real-read-final.log']
assert '118 preserved' in logs['builder-preview-final.log']
schema=[]
for table,required in [('calcs_imp_container',{'container_id':'integer','calc_imp_container_id':'integer','dt_hr_calculo':'datetime','usuario_id':'integer','memoria_calculo':'integer','desc_memoria_calc':'character'}),('despesas_container',{'container_id':'integer','despesa_container_id':'integer','calc_imp_container_id':'integer','memoria_calculo':'character'})]:
 p=workspace/'.runtime/ciw-completion-20261028/schema'/('schema-'+table+'.json');d=json.loads(p.read_text(encoding='utf-8-sig'))
 assert d['found'] and all({f['name']:f['type']for f in d['fields']}.get(n)==t for n,t in required.items())
 schema.append(dict(path=str(p).replace('\\','/'),sha256=sha(p),fields=len(d['fields']),indexes=len(d['indexes'])))
text=json.loads((root/'patches/patch-plan.json').read_text(encoding='utf-8'))['textPatches']
parents=json.loads((root/'patches/parent-navigation.json').read_text(encoding='utf-8'))['patches']
for p in text+parents:assert sha(Path(p['target']))==p['baselineSha256'],'baseline changed: '+p['target']
source=json.loads((root/'patches/source-operations.json').read_text(encoding='utf-8'));assert sha(Path(source['baselinePath']))==source['baselineSha256']
evidence=[]
for app,filename,lines in [('cons_calcs_imp_container','cons_calcs_imp_container_grid.class.php','608,750-770'),('cons_despesas_container_memoria_calculo','cons_despesas_container_memoria_calculo_grid.class.php','596,735-755'),('grid_despesas_container','grid_despesas_container_grid.class.php','3970-4000')]:
 p=workspace/'sources/scriptcase/containers'/app/filename;evidence.append(dict(path=str(p).replace('\\','/'),sha256=sha(p),lines=lines))
files=[dict(path=p.relative_to(root).as_posix(),sha256=sha(p),bytes=p.stat().st_size)for p in sorted(root.rglob('*'))if p.is_file() and p.name!='manifest.json']
manifest=dict(package='container-fiscal-readonly',freezeVersion=2,previousManifestSha256='eb7e4ebb519f894be76727aae5d45f4b82696420e511adb1b1ffc3235ebc8e22',status='candidate-ready-local',freezeUtc=datetime.datetime.now(datetime.timezone.utc).isoformat(),files=files,
 newCanonicalTargets=[dict(candidate='abl/'+n,target='D:/opencode/motor-progress/v2/sursum-api/programs/'+n)for n in ['ContainerFiscalReadOnlyApi.p','ContainerFiscalReadOnlyService.p']],
 signatures={'ContainerFiscalReadOnlyApi.p':'INPUT JsonObject, OUTPUT JsonObject','ContainerFiscalReadOnlyService.p':'INPUT HANDLE phContainers,phCalcs,phExpenses; INPUT JsonObject; OUTPUT JsonObject'},
 sharedBaselines=[{k:p[k]for k in ['target','baselineSha256']}for p in text+parents],sourceBaseline={k:source[k]for k in ['baselinePath','baselineSha256','baselineOperations','resultOperations']},schemaEvidence=schema,legacyEvidence=evidence,
 tests=dict(compiler='local OpenEdge12.8 only; not official12.2 proof',compiles=8,ablPerCombination=dict(fiscal=41,erpRegression=47,itemRegression=9),combinations=['UTF8/AMERICAN','UTF8/EUROPEAN','ISO8859-1/AMERICAN','ISO8859-1/EUROPEAN'],phpRoutingChecks=56,phpRealReadPathChecks=36,nativeJsChecks=30,nativeBuilderScreens=2,sourcePreviousOperationsPreserved=118,NUM_DBS=0),
 command='powershell -NoProfile -ExecutionPolicy Bypass -File integration-src/ciw-completion-20261028/container-fiscal-readonly/tests/verify-all.ps1',
 limits=dict(maxTake=200,maxSkip=100000,maxCollection=50000,maxCollectionMilliseconds=10000,stopAfterSeconds=10,normalSelectedCardinality='0/1; missing selected context record returns404',timeoutTest='guard reviewed; forced wall-clock expiration not exercised'),
 gates=['Manager review/rebase shared patches against current SHA256; merge only deltas','Official .42/OpenEdge12.2 compile and TT tests four encoding/culture combinations','Canonical integration and source118+4 preserve all existing operations/authHeaders','Publish approved official12.2 artifacts only to sursum-api/med; validate read/get/negatives in PASOE9911','Native publication and contextual UI/Logs validation; access grants require separately authorized scope'],
 operationalWrites=False,canonicalFilesModified=False,remoteCompilePerformed=False,published=False,grants=False,DDL=False,businessTests=False,
 limitations=['Intermediate expense memory link may appear even when no memory/calculation exists: explicit readonly extension, no literal visual-parity claim','No global container history endpoint/tab; both screens require selected legacy PK plus container','ISO DATETIME string preserves physical local value and milliseconds; no timezone invented','No full51k result/forced timeout assertion; tests confirm selected PK prevents unrelated history widening'])
write(root/'manifest.json',manifest)
receipt=dict(status='candidate-ready',freezeVersion=2,manifest=str(root/'manifest.json').replace('\\','/'),manifestSha256=sha(root/'manifest.json'),checks=manifest['tests'],closedReviewFindings=['P1 undeclared PK navigation context: real CrudEngine RED then GREEN; both contexts fixed in all layers','P2 ERP read response context: real readCiwErpPage/transport RED then GREEN; validate typed physical PK and assert container+selected PK before mapItem; valid no-record_key and existing generic path covered'],selfReview='No remaining confirmed P1/P2. Parent independent review and official deployment gates pending.',logHashes={n:sha(state/n)for n in logs})
write(state/'candidate-ready.json',receipt)
write(state/'candidate-ready-v2.json',receipt)
write(state/'manifest-v2.json',manifest)
print('candidate-ready manifest SHA256',receipt['manifestSha256'],'files',len(files))
