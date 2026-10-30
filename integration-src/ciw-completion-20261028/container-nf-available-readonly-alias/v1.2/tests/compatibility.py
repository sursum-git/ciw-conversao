from pathlib import Path
import json,hashlib
W=Path('D:/opencode/conversao-sc');ROOT=Path(__file__).resolve().parents[1];R=W/'.runtime/ciw-completion-20261028';STATE=R/'container-nf-available-readonly-alias/v1.2'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
old=R/'container-nf-available-readonly-alias/v1.1/frozen/candidate/sursum-api/programs/ContainersPainelFinanceReadService.p';new=STATE/'candidate/sursum-api/programs/ContainersPainelFinanceReadService.p'
assert sha(old)=='d7990991fd7e1d7675927c8cc4a0ecde7a4ffa8e2368e08b04b3f8361d1d238a'
a=b'hexValue=HEX-ENCODE(GET-BYTES(bytesValue,1,67)).';b=b'hexValue=SUBSTRING(HEX-ENCODE(bytesValue),1,134).'
assert old.read_bytes().count(a)==1 and old.read_bytes().replace(a,b,1)==new.read_bytes()
diag=R/'nf-keybytes-diagnostic-v3/diagnostic.json';proof=json.loads(diag.read_text(encoding='utf-8-sig'));assert proof['completed']and proof['equal']and proof['errors']==[]and proof['numDbs']==0 and proof['openEdge'].startswith('12.2')
incremental={'target':'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersPainelFinanceReadService.p','baselineSha256':sha(old),'candidateSha256':sha(new),'scope':'one compatibility expression only; use cumulative patch-plan.json for current production09678 baseline','changes':[{'oldBytesHex':a.hex(),'newBytesHex':b.hex()}]}
(ROOT/'incremental-from-v1.1.json').write_text(json.dumps(incremental,indent=2)+'\n',encoding='utf-8')
receipt={'success':True,'onlyProductionLineChanged':True,'baselineCandidateV1_1Sha256':sha(old),'candidateV1_2Sha256':sha(new),'rootSynthetic122Diagnostic':{'path':str(diag),'sha256':sha(diag),'completed':True,'equal':True,'errors':[],'numDbs':0},'expression':'SUBSTRING(HEX-ENCODE(bytesValue),1,134)','reason':'OE12.2 rejects RAW HEX-ENCODE12117; direct MEMPTR supported','capsValidKeyIdWrapperPhpUnchanged':True,'fullServiceOfficial122StillPending':True,'v1_1AndOfficial10Preserved':True}
(ROOT/'compatibility-proof.json').write_text(json.dumps(receipt,indent=2)+'\n',encoding='utf-8');print(json.dumps({'success':True,'candidateSha256':sha(new),'incrementalAnchors':1}))
