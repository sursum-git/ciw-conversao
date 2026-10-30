from pathlib import Path
import hashlib,json,re,difflib
root=Path(__file__).resolve().parents[1];workspace=root.parents[2];state=workspace/'.runtime/ciw-completion-20261028/container-nf-available-readonly';stage=state/'local';h=lambda p:hashlib.sha256(p.read_bytes()).hexdigest();checks=0
def check(ok,label):
 global checks
 assert ok,label;checks+=1
plan=json.loads((root/'patches/patch-plan.json').read_text(encoding='utf8'));eolProof=[]
for p in plan['textPatches']:
 baseline=state/'baseline'/p['relative'];original=baseline.read_bytes();candidate=(stage/p['relative']).read_bytes();check(h(baseline)==p['baselineSha256'],'pinned baseline');check(h(Path(p['target']))==p['baselineSha256'],'canonical drift: rebase before integration');check(h(stage/p['relative'])==p['candidateSha256'],'candidate pinned hash');forward=original
 for step in p['changes']:
  old=bytes.fromhex(step['oldBytesHex']);new=bytes.fromhex(step['newBytesHex']);check(forward.count(old)==1,'unique byte anchor');forward=forward.replace(old,new)
 check(forward==candidate,'forward exact');backward=candidate
 for step in reversed(p['changes']):
  old=bytes.fromhex(step['oldBytesHex']);new=bytes.fromhex(step['newBytesHex']);check(backward.count(new)==1,'unique reverse anchor');backward=backward.replace(new,old)
 check(backward==original,'all bytes outside hunks preserved')
 a=original.splitlines(True);b=candidate.splitlines(True);eolChanges=[];ending=lambda line:line[len(line.rstrip(b'\r\n')):]
 for block in difflib.SequenceMatcher(a=[x.rstrip(b'\r\n')for x in a],b=[x.rstrip(b'\r\n')for x in b],autojunk=False).get_matching_blocks():
  for k in range(block.size):
   if ending(a[block.a+k])!=ending(b[block.b+k]):eolChanges.append([block.a+k+1,block.b+k+1])
 check(not eolChanges,'unchanged logical lines preserve their original EOL even inside hunks');eolProof.append({'target':p['target'],'baselineSha256':p['baselineSha256'],'candidateSha256':p['candidateSha256'],'unchangedLogicalLinesWithChangedEol':0,'exactReverse':True})
service=(stage/'sursum-api/programs/ContainersPainelFinanceReadService.p').read_bytes();before=(state/'baseline/sursum-api/programs/ContainersPainelFinanceReadService.p').read_bytes()
def routine(data,kind,name):return re.search(rb'(?m)^'+kind.encode()+rb' '+name.encode()+rb'\b.*?^END '+kind.encode()+rb'\.',data,re.S|re.M).group()
for kind,name in [('FUNCTION','NfKey'),('PROCEDURE','NfRow'),('PROCEDURE','AddField'),('PROCEDURE','AcceptRow'),('PROCEDURE','CompanyContext'),('PROCEDURE','AvailablePayments'),('PROCEDURE','PaymentRow'),('FUNCTION','PaymentKey'),('FUNCTION','AblQuote')]:check(routine(service,kind,name)==routine(before,kind,name),name+' remains unique and byteidentical')
check(len(re.findall(rb'DEFINE INPUT PARAMETER ph\w+ AS HANDLE',service.split(b'{sursum-api/includes/ContainerPaymentIdentity.i}')[0]))==10,'ten service handles unchanged')
check(b'NO-LOCK WHERE' in service and b'STOP-AFTER 10 ON STOP UNDO, LEAVE' in service and b'iNfReads>=50000' in service and b'countRows>200' in service,'bounded NOLOCK new reader')
newpart=routine(service,'PROCEDURE','AvailableNfs')
check(b'.idi-sit-nf-eletro=3' in newpart and b'.nat-operacao BEGINS' in newpart,'fixed status/nature filters')
check(b'phContainer:BUFFER-FIELD("cod-emit-forn")' in newpart and b'phContainer:BUFFER-FIELD("cod-estabel")' in newpart,'direct parent supplier/establishment')
check(b'phNfs:BUFFER-FIELD("serie")' not in newpart and b'phNfs:BUFFER-FIELD("cod_emitente")' not in newpart,'exclusion by document only')
check(b'RUN NfRow(TRUE,OUTPUT joRow). RUN AcceptRow(joRow).' in newpart,'shared row and opaque mapper')
check(b'TRIM(cNfDocument)' not in newpart and b'CAPS(cNfDocument)' not in newpart and b'CONTAINER_NF_COLLATION_UNPROVEN' in newpart,'no normalized document comparison')
wrapper=(stage/'sursum-api/programs/ContainersPainelFinanceRead.p').read_bytes();oldWrapper=(state/'baseline/sursum-api/programs/ContainersPainelFinanceRead.p').read_bytes()
check(wrapper.count(b'{sursum-api/includes/parametros_ima.i}')==1,'direct IMA include remains')
for name in [b'HTTP_X_CONTAINERS_TOKEN',b'tokenSha256',b'sursum-conf/containers-api.json'] :check(wrapper.count(name)==oldWrapper.count(name),'authentication unchanged')
start=wrapper.index(b' IF cResource="nfs" OR cResource="nfs-disponiveis" THEN DO:');end=wrapper.index(b'  CREATE BUFFER hDocumEst',start);branch=wrapper[start:end]
check(branch.index(b'CONTAINER_NF_MED_REQUIRED')<branch.index(b'CASE SUBSTRING(cEstab,1,1)'), 'MED guard precedes optional old IMA branch')
check(wrapper.count(b'INPUT hContainer, INPUT hEmpresas, INPUT hItensContainer, INPUT hItensProcCompra, INPUT hProcsCompra, INPUT hPagtos, INPUT hTitAp, INPUT hValTitAp, INPUT hNfs, INPUT hDocumEst')==1,'wrapper ABI10 preserves original call')
check(b'ERROR-STATUS:GET-NUMBER(iError)<>565' in wrapper and b'ERROR-STATUS:GET-NUMBER(k)<>565' in service,'parent absence565 distinguished from other DB errors')
action=(stage/'php/RuntimeApiEntityActionService.php').read_bytes();guard=action.index(b'RuntimeContainerNfAvailableRead::response($response[\'body\'],$response[\'body\'][\'data\']??null,$context)');extract=action.index(b'$items = $this->extractItems',guard);check(guard<extract,'raw list shape before extraction/mapper')
check(b'RuntimeContainerNfAvailableRead::response($response[\'body\'],$item,$context,$id)' in action,'get raw shape before mapper')
check(h(state/'baseline/php/RuntimeApiEntityActionService.php')=='41d2a8ff9377b7bd7a7df9106d2dc557a58f607153149c82ed2f64adc1ccfcc7','exact released Action8 baseline')
check(h(stage/'php/ProgramBuilderService.php')=='72c6dafbfa0e93196b443ec45cd6d7c743fddd6415719febd70a0965d1fe18ee','real released Builder8 pinned for tests')
check((stage/'ContainerNfAvailableTest.p').read_bytes()==(root/'tests/ContainerNfAvailableTest.p').read_bytes(),'actual TT test input pinned')
check((stage/'ContainersPainelFinanceReadTest.p').read_bytes()==(state/'baseline/ContainersPainelFinanceReadTest.p').read_bytes(),'financial regression input pinned')
for name in ['parametros_ima.i','ContainerFinancePolicy.i','ContainerPaymentIdentity.i']:
 rel=Path('sursum-api/includes')/name;check((stage/rel).read_bytes()==(state/'baseline'/rel).read_bytes(),'include bytes pinned: '+name)
add=json.loads((root/'metadata/source-addition.json').read_text(encoding='utf8'));check(h(Path(add['baselinePath']))==add['baselineSha256'],'actual live source export hash');source=json.loads(Path(add['baselinePath']).read_text(encoding='utf-8-sig'))['apiSource'];check(len(source['operations'])==4 and len(add['operations'])==2,'source4 append2');check([x['value']['type']for x in add['operations']]==['list','detail'],'native operation detail type');check('authHeaders'not in json.dumps(add) and 'headers'not in json.dumps(add),'no auth replacement payload')
parent=json.loads((root/'metadata/parent-navigation-delta.json').read_text(encoding='utf8'));check(parent['targetProgram']=='op1000' and h(Path(parent['baselinePath']))==parent['baselineSha256'],'current header baseline');preview=json.loads((root/'metadata/parent-builder-preview.json').read_text(encoding='utf8'))['programDraft'];check(preview['rowLinks'][:-1]==parent['existingRowLinks'],'existing header links unchanged');check(preview['rowLinks'][-1]['parameters']==[{'field':'container_id','sourceField':'container_id'}],'direct header context no child dependency')
draft=json.loads((root/'metadata/builder-draft.json').read_text(encoding='utf8'));check(draft['programDraft']['programCode']=='op1053' and draft['programDraft']['contextFields'][0]['required'] is True,'reserved code and context');check(len(draft['entityDraft']['fields'])==18 and len(draft['programDraft']['crudOptions']['gridFields'])==15,'same18 fields / real15 columns');check(all(f['readonlyField'] and f['options']['readonly'] and f['options']['writable'] is False for f in draft['entityDraft']['fields']),'readonly metadata all fields')
inputs=[]
for p in [workspace/'sources/scriptcase/ciw-completion-next19c-20261028/bl_selecao_nf/index.php',workspace/'sources/scriptcase/containers/bl_selecionado_nf/index.php',workspace/'sources/scriptcase/containers/cons_docum_est_importacao/index.php',workspace/'sources/scriptcase/containers/cons_docum_est_importacao/cons_docum_est_importacao_grid.class.php',workspace/'integration-src/container-panel/schema/schema-nfs_container.json',workspace/'integration-src/container-panel/schema/schema-pp-container.json',workspace/'integration-src/container-panel/schema/ems2med/schema-docum-est.json']:
 inputs.append({'path':p.as_posix(),'sha256':h(p)})
(root/'source-evidence.json').write_text(json.dumps({'status':'MED_AVAILABLE_NF_READONLY_CANDIDATE','files':inputs,'originScopePartial':True,'scope':'MED available read/get only; IMA and association/unassociation are not converted in this package.','realSourceAction':'bl_selecao_nf nominal desassociar opens available documents and enables Associar NF Importação','query':'nat-operacao begins3 AND header supplier AND header establishment AND idi-sit-nf-eletro=3; every document linked to this CID is excluded by document only.','nullProof':'Native PHP interpolation unit test plus explicit SQL three-valued truth model; no SQL/ODBC execution claimed.','collationGate':'422 if no exact-byte exclusion resolves a potential case/edge-space/Unicode comparison; no TRIM/case normalization for inclusion.','sql1040_1041_1048GatesChanged':False,'centralProjection':'NfRow/NfKey/AddField/AcceptRow unchanged byte-for-byte','inventoryChanged':False,'businessExecuted':False},indent=2,ensure_ascii=False)+'\n',encoding='utf8')
(state/'wiring-result.json').write_text(json.dumps({'success':True,'checks':checks,'bytePreserving':True,'canonicalChanged':False,'rebaseAction8':True,'sharedPrograms':2,'newPhpBoundary':1,'sharedPhpPatches':1,'sourceOperationsBefore':4,'sourceOperationsCandidate':6,'parentProgram':'op1000','originFullyConverted':False,'official122Validated':False},indent=2)+'\n',encoding='utf8')
(state/'eol-proof.json').write_text(json.dumps({'success':True,'files':eolProof,'eolOnlyChanges':0},indent=2)+'\n',encoding='utf8')
manifest=root/'manifest.json'
if manifest.exists():
 frozen=json.loads(manifest.read_text(encoding='utf8'))
 for item in frozen['sourceFiles']:assert h(root/item['path'])==item['sha256'],('Frozen source changed',item['path'])
 for item in frozen['candidateSources']:assert h(Path(item['frozenCandidatePath']))==item['candidateSha256'],('Frozen candidate changed',item['target'])
print('PASS byteguard/wiring/provenance checks='+str(checks)+'; no canonical changes')
