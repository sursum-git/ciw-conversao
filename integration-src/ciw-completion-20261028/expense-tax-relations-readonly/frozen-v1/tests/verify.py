from pathlib import Path
import hashlib,json,re,difflib,xml.etree.ElementTree as ET
ROOT=Path(__file__).resolve().parents[1];W=Path('D:/opencode/conversao-sc');STATE=W/'.runtime/ciw-completion-20261028/expense-tax-relations-readonly'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def load(p):return json.loads(p.read_text(encoding='utf-8-sig'))
def out(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
patches=load(ROOT/'patches/patch-plan.json')['textPatches'];proof=[]
for p in patches:
 target=Path(p['target']);assert sha(target)==p['baselineSha256'],'rebase required '+str(target)
 base=target.read_bytes();data=base
 for h in p['changes']:
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
 dest=STATE/'candidates'/p['relative'];assert data==dest.read_bytes();assert sha(dest)==p['candidateSha256']
 if p['relative'].startswith('php/'):
  assert data==(STATE/'full-stage/backend-stage/backend/src/Runtime'/Path(p['relative']).name).read_bytes(),'fullstage must use exact final candidate bytes'
 original=data
 for h in reversed(p['changes']):
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(b)==1;data=data.replace(b,a,1)
 assert data==base
 a=base.splitlines(keepends=True);b=original.splitlines(keepends=True);sm=difflib.SequenceMatcher(a=[x.rstrip(b'\r\n')for x in a],b=[x.rstrip(b'\r\n')for x in b],autojunk=False);eol=[]
 for tag,i,j,k,l in sm.get_opcodes():
  if tag=='equal':
   for m,n in zip(range(i,j),range(k,l)):
    if a[m]!=b[n]:eol.append([m+1,n+1])
 assert not eol,(p['relative'],eol)
 proof.append({'relative':p['relative'],'baselineSha256':p['baselineSha256'],'candidateSha256':p['candidateSha256'],'anchors':len(p['changes']),'reverseByteExact':True,'unchangedEolChanges':eol})
wrapper=(STATE/'candidates/sursum-api/programs/CiwCadastrosCrud.p').read_text();branch=wrapper.split('WHEN "despesas_impostos_geral" THEN DO:',1)[1].split('WHEN "item_custos_manual"',1)[0]
assert branch.index('cOperation<>"read" AND cOperation<>"get"')<branch.index('CREATE BUFFER')
for expected in ['FOR TABLE "espec.despesas_impostos"','cleanRequest:Remove("resource")','RUN VALUE(cService)(hData,"despesas_impostos_geral","",cleanRequest,OUTPUT poResponse). RETURN.']:assert expected in branch
reader=(STATE/'candidates/sursum-api/programs/CiwErpReadService.p').read_text();assert 'FIELD record_key AS CHARACTER CASE-SENSITIVE INDEX pk IS PRIMARY UNIQUE record_key'in reader
assert reader.index('IF CAN-FIND(ttRelationIdentity')<reader.index("IF op='get' OR totalValue>skipValue")
assert 'ROWID' not in reader.upper()
logs=[]
for cpv in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  p=STATE/'local'/f'test-{cpv}-{culture}.log';raw=p.read_text();assert'PASS 49 checks NUMDBS=0'in raw and f'PASS 47 checks {culture}'in raw and'FAIL'not in raw;logs.append({'path':str(p),'sha256':sha(p)})
assert'duplicate NULL PK outside page1 must refuse'in(STATE/'ambiguity-red.log').read_text()
assert'resource exists'in(STATE/'red/execution.log').read_text()
tree=ET.parse(STATE/'full-stage/php-full.xml');cases=tree.findall('.//testcase');assert len(cases)==986;assert sum(int(x.get('assertions',0))for x in cases)==7023
assert not any(tree.findall('.//'+tag)for tag in ['failure','error','skipped'])
loader=load(STATE/'full-stage/php-stage-loader-proof.json');assert loader['success']and not loader['outsideStage']and loader['loadedAppDefinitions']==277
for row in load(STATE/'full-stage/php-source-manifest.json'):
 assert sha(STATE/'full-stage/backend-stage/backend/src'/row['path'])==row['stageSha256']
 if row['baselineSha256']is not None:assert sha(Path('D:/opencode/construtor-pg/backend/src')/row['path'])==row['baselineSha256']
native=load(STATE/'native-result.json');assert native['success']and native['checks']==20 and native['writes']==native['network']==0
source=load(ROOT/'metadata/api-source-preview.json');assert len(source['operations'])==146
lookup=W/'sources/scriptcase/ciw-completion-expense-tax-lookups-20261028/grid_despesas_impostos/grid_despesas_impostos_lookup.class.php';assert sha(lookup)=='0338ba51658129c761e0bcb4164e88f02fb4319bfc5d47396a6ea1a31e610b26'
evidence=[W/'sources/scriptcase/phase1/grid_despesas_impostos/index.php',W/'sources/scriptcase/phase1/grid_despesas_impostos/grid_despesas_impostos_grid.class.php',lookup,W/'integration-src/despesas/schema/schema-despesas_impostos.json']
evidence+=list((W/'sources/scriptcase/phase1/form_despesas_impostos').glob('*.php'))
evidence+=list((W/'.runtime/ciw-completion-20261028/expense-tax-current').glob('*.json'))
out(ROOT/'source-evidence.json',{'status':'READONLY_PRODUCT_PREPARED_NOT_PUBLISHED','origin':'grid_despesas_impostos','projection':['despesa_id','imposto_id'],'physicalPk':['despesa_id','imposto_id','empresa_id'],'physicalInts':'nullable/signedInt32; zero preserved; no FK inferred','labels':['Despesa Id','Imposto Id'],'lookup':'actual collected class empty; no descriptions/options added','currentDifferentProduct':'cd0093/1.0.1 company/expense owned impostos collection','identityGate':'all bounded filtered rows checked before pagination; duplicate nullable PK409, no partial, no dedup/ROWID','usageGate':'no literal inbound observed is not inactivity proof; live menu/caller/usage unresolved before publishing','formRemaining':'create/update/delete not converted by this readonly product; legacy edit navigation omits/wrongly maps PK','sources':[{'path':str(p),'sha256':sha(p)}for p in evidence],'canonical9ReceiptSha256':load(STATE/'rebase-9-proof.json')['canonical9ReceiptSha256'],'networkExecuted':False,'businessWritten':False,'inventoryChanged':False})
out(STATE/'byte-proof.json',{'success':True,'patches':proof,'dispatcherWiringClosed':True,'abiUnchanged':True,'mapper':'existing RowJson and PHP mapItem reused; indexed temporary identity proof only','unmodified1053Preserved':True})
out(STATE/'verification.json',{'success':True,'tt':{'checks':384,'combinations':4,'NUMDBS':0,'new':49,'regression':47,'logs':logs},'phpFullStage':{'tests':986,'assertions':7023,'namedAppDefinitionsFromStage':277,'outsideStage':0},'native':native,'sharedPatches':4,'newPhpFiles':1,'official122':False,'usageMenuGate':False,'ambiguousNullCorpusParity':False,'noCanonicalWrites':True})
print(json.dumps({'success':True,'ttChecks':384,'phpTests':986,'phpAssertions':7023,'nativeChecks':20,'patches':4,'eolChanges':0,'official122':False}))
