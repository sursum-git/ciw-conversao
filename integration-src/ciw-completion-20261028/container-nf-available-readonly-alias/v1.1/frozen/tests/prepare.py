from pathlib import Path
import hashlib,json,sys
ROOT=Path(__file__).resolve().parents[1];W=Path('D:/opencode/conversao-sc');STATE=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-alias/v1.1';M=Path('D:/opencode/motor-progress/v2')
red='--red'in sys.argv;stage=STATE/('red'if red else'local');stage.mkdir(parents=True,exist_ok=True)
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
rel='sursum-api/programs/ContainersPainelFinanceReadService.p';source=M/rel
assert sha(source)=='09678e8fabe46c2fd35ea3bf814e587765490135533a034822236da2ed5c37cf'
base=STATE/'baseline'/rel
if not base.exists():cp(source,base)
assert base.read_bytes()==source.read_bytes()
cp(base,stage/rel)
if not red:
 p=json.loads((ROOT/'patch-plan.json').read_text());data=(stage/rel).read_bytes()
 for h in p['changes']:
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
 assert hashlib.sha256(data).hexdigest()==p['candidateSha256'];(stage/rel).write_bytes(data)
old=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly/frozen-v1/testinputs'
fixture=(old/'ContainerNfAvailableTest.p').read_bytes();first=fixture.index(b'DEFINE TEMP-TABLE ttMaster');last=fixture.index(b'DEFINE VARIABLE request')
(stage/'AvailableNfFixture.i').write_bytes(fixture[first:last])
for name in ['AvailableNfAliasTest.p','AvailableNfTimeoutTest.p','AvailableNfCompanionTest.p']:cp(ROOT/'tests'/name,stage/name)
prior=(old/'ContainerNfAvailableTest.p').read_bytes()
for old_code,new_code in [(b'RUN ErrorCode("CONTAINER_NF_QUERY_LIMIT",503). RUN Check(NOT response:Has("data"),"row cap',b'RUN ErrorCode("CONTAINER_NF_CANDIDATE_LIMIT",503). RUN Check(NOT response:Has("data"),"row cap'),(b'RUN ErrorCode("CONTAINER_NF_QUERY_LIMIT",503). RUN Check(NOT response:Has("data"),"physical scan cap',b'RUN ErrorCode("CONTAINER_NF_SOURCE_LIMIT",503). RUN Check(NOT response:Has("data"),"physical scan cap')]:
 assert prior.count(old_code)==1;prior=prior.replace(old_code,new_code,1)
(stage/'ContainerNfAvailableTest.p').write_bytes(prior)
cp(old/'ContainersPainelFinanceReadTest.p',stage/'ContainersPainelFinanceReadTest.p')
(stage/'ContainersPainelFinanceReadService.p').write_bytes(b'{sursum-api/programs/ContainersPainelFinanceReadService.p}\n')
cp(M/'sursum-api/includes/ContainerPaymentIdentity.i',stage/'sursum-api/includes/ContainerPaymentIdentity.i');cp(M/'sursum-api/includes/ContainerFinancePolicy.i',stage/'sursum-api/includes/ContainerFinancePolicy.i')
data=(stage/rel).read_bytes();assert data.count(b'>=10000')==2
(stage/'sursum-api/programs/FinanceTimeoutFixture.p').write_bytes(data.replace(b'>=10000',b'>=0'))
entries='sursum-api/programs/ContainersPainelFinanceReadService.p,sursum-api/programs/FinanceTimeoutFixture.p,ContainersPainelFinanceReadService.p,AvailableNfAliasTest.p,AvailableNfTimeoutTest.p,AvailableNfCompanionTest.p,ContainerNfAvailableTest.p,ContainersPainelFinanceReadTest.p'
(stage/'Compile.p').write_text('DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO.\nOUTPUT TO "compile.log". PUT UNFORMATTED "OpenEdge " PROVERSION " NUMDBS=" NUM-DBS SKIP.\nIF NUM-DBS<>0 THEN DO: PUT "FAIL NUMDBS". OUTPUT CLOSE. QUIT. END.\nDO n=1 TO NUM-ENTRIES("'+entries+'"): COMPILE VALUE(ENTRY(n,"'+entries+'")) SAVE NO-ERROR. IF COMPILER:ERROR THEN DO: DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. OUTPUT CLOSE. QUIT. END. END. PUT "PASS COMPILE". OUTPUT CLOSE. QUIT.\n',encoding='utf-8')
for name,run in [('Execute.p','RUN AvailableNfAliasTest.r.'),('TimeoutExecute.p','RUN AvailableNfTimeoutTest.r.'),('CauseExecute.p','RUN ContainerNfAvailableTest.r. RUN ContainersPainelFinanceReadTest.r.')]:
 (stage/name).write_text('OUTPUT TO "'+name+'.log". DO ON ERROR UNDO, THROW: IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError("Connected DB forbidden",1). '+run+' PUT UNFORMATTED "PASS EXECUTE NUMDBS=" NUM-DBS SKIP. CATCH e AS Progress.Lang.Error: PUT UNFORMATTED "FAIL " e:GetMessage(1) SKIP. END CATCH. END. OUTPUT CLOSE. QUIT.\n',encoding='utf-8')
proof={'mode':'red'if red else'green','baselineSha256':sha(base),'candidateSha256':sha(stage/rel),'old39TestSha256':sha(old/'ContainerNfAvailableTest.p'),'adjusted39TestSha256':sha(stage/'ContainerNfAvailableTest.p'),'old231ByteIdentical':(old/'ContainersPainelFinanceReadTest.p').read_bytes()==(stage/'ContainersPainelFinanceReadTest.p').read_bytes(),'timeoutFixture':'private test-only source copy; >=10000 replaced by >=0 exactly twice; never deploy','timeoutFixtureSha256':sha(stage/'sursum-api/programs/FinanceTimeoutFixture.p')}
(stage/'preparation-proof.json').write_text(json.dumps(proof,indent=2)+'\n');print(json.dumps(proof))
