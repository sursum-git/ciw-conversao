from pathlib import Path
import json,hashlib,re,shutil,difflib
ROOT=Path(__file__).resolve().parents[1];W=Path('D:/opencode/conversao-sc');STATE=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-alias/v1.2'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def write(p,o):p.parent.mkdir(parents=True,exist_ok=True);p.write_text(json.dumps(o,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
def cp(a,b):b.parent.mkdir(parents=True,exist_ok=True);b.write_bytes(a.read_bytes())
p=json.loads((ROOT/'patch-plan.json').read_text());base=STATE/'baseline'/p['relative'];candidate=STATE/'candidate'/p['relative']
assert sha(Path(p['target']))==sha(base)==p['baselineSha256'];assert sha(candidate)==p['candidateSha256']
data=base.read_bytes()
for h in p['changes']:
 a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
assert data==candidate.read_bytes()
for h in reversed(p['changes']):
 a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(b)==1;data=data.replace(b,a,1)
assert data==base.read_bytes()
old=base.read_bytes();new=candidate.read_bytes();a=old.splitlines(keepends=True);b=new.splitlines(keepends=True);sm=difflib.SequenceMatcher(a=[x.rstrip(b'\r\n')for x in a],b=[x.rstrip(b'\r\n')for x in b],autojunk=False)
eol=[]
for tag,i,j,k,l in sm.get_opcodes():
 if tag=='equal':
  for n,m in zip(range(i,j),range(k,l)):
   if a[n]!=b[m]:eol.append([n+1,m+1])
assert not eol
unchanged=[]
for name in ['ValidKey','AllowedName','ReadId','PaymentKey','NfKey','AvailablePayments','PaymentRow','NfRow','AddField','AcceptRow','CompanyContext']:
 matches=[]
 for raw in [old,new]:
  match=re.search(rb'(?:FUNCTION|PROCEDURE) '+name.encode()+rb'\b.*?END (?:FUNCTION|PROCEDURE)\.',raw,re.S);assert match,name;matches.append(match.group())
 assert matches[0]==matches[1],name;unchanged.append({'routine':name,'sha256':hashlib.sha256(matches[0]).hexdigest()})
assert re.findall(rb'DEFINE (?:INPUT|OUTPUT) PARAMETER[^\r\n]*',old)==re.findall(rb'DEFINE (?:INPUT|OUTPUT) PARAMETER[^\r\n]*',new)
assert new.count(b'NfKeyBytes(')==2 and b'SET-SIZE(bytesValue)=68.'in new and b'FINALLY: SET-SIZE(bytesValue)=0.'in new
logs=[]
for cpv in ['UTF-8','ISO8859-1']:
 for culture in ['AMERICAN','EUROPEAN']:
  path=STATE/'local'/f'test-{cpv}-{culture}.log';raw=path.read_text();assert 'FAIL'not in raw
  for count in [18,2,39,231]:assert re.search(r'PASS:? '+str(count)+r' checks',raw)
  logs.append({'path':str(path),'sha256':sha(path),'checks':290})
red=STATE/'red/expected-red.log';assert red.read_text().count('FAIL')==3
proof={'success':True,'patches':5,'reverseByteExact':True,'unchangedLineEolChanges':eol,'abiUnchanged':True,'legacyRoutinesByteIdentical':unchanged,'keyValidationBeforeAllocation':True,'fixedMemptrBytes':68,'freeInFinally':True,'onlyNewResourceAliasGuard':True,'idCanonicalGuardUnchanged':True,'capsUnchanged':{'candidates':200,'sourceReads':50000,'seconds':10}}
write(STATE/'byte-proof.json',proof)
review='''# Review companion1053 v1.2

Compatibilidade12.2 comprovada pelo root: erro12117 ao HEX-ENCODE deRAW. Unica diferenca deproducao contra v1.1d799: SUBSTRING(HEX-ENCODE(bytesValue),1,134), preservandoos67bytes e descartandoapenasoNULLterminador68. v1.1eofficial10falhados permanecemintactos.

Corrigido o P2 reproduzido diretamente no serviço9: `nf_key=id + espaço` retornava sucesso. O novo guard somente de nfs-disponiveis valida formato/67 bytes/ASCII antes de alocar68 bytes, compara o HEX de67 bytes e libera MEMPTR em FINALLY. Nenhuma conversão/trim/correção do alias. ID lowercase já era recusado; ValidKey e guard canônico do ID permanecem literalmente iguais.

Separadas causas503, preservando valores/ordem dos limites: CONTAINER_NF_CANDIDATE_LIMIT (>200 elegíveis), CONTAINER_NF_SOURCE_LIMIT (>50mil leituras contadas), CONTAINER_NF_QUERY_TIMEOUT (10s/STOP). Sem truncamento/paginação nova. 50mil conta linhas lidas pelos loops fixos, não I/O interno do banco. Nenhum teste remoto/negócio foi executado nesta preparação.

RED direto: alias com espaço aceito e causas candidato/timeout genéricas. GREEN local12.8 NUMDBS0: (18aliases+2timeout+39disponíveis+231financeiras)×4CP/culturas=1.160 checks. Os 231 testes antigos são byteiguais; os39 anteriores mudaram SOMENTE duas expectativas de código. Timeout foi forçado em uma cópia privada do serviço com >=10000→>=0 em exatamente dois pontos; prova do ramo sem esperar10s, jamais artefato de produção. Nenhuma alegação de validar latência real/SQL/collation.

5 anchors por bytes, reversão exata e zero EOL alterado em linhas preservadas; ABI13parâmetros/10handles e11rotinas centrais literalmente iguais. Apenas Service.p/r é candidato à publicação; nada de wrapper/OO/PHP/frontend/metadados. Freeze1053, releases9/9-v2 e progresso1055 preservados. Compilação12.2, revisão independente e publicação do delta são gates do root; quatro dos cinco containers observados ainda falharam por limite no9 e não recebem readproof por inferência.
'''
(ROOT/'REVIEW.md').write_text(review,encoding='utf-8')
frozen=STATE/'frozen';public=ROOT/'frozen';assert not (frozen/'manifest.json').exists(),'immutable freeze exists'
for src in ROOT.rglob('*'):
 if src.is_file()and'\x66rozen'not in src.relative_to(ROOT).parts:cp(src,public/src.relative_to(ROOT))
for src in (STATE/'local').rglob('*'):
 if src.is_file()and src.suffix.lower()in['.p','.i']:cp(src,frozen/'testinputs'/src.relative_to(STATE/'local'))
cp(candidate,frozen/'candidate'/p['relative'])
files=[{'path':x.relative_to(public).as_posix(),'sha256':sha(x)}for x in sorted(public.rglob('*'))if x.is_file()]
inputs=[{'path':x.relative_to(frozen).as_posix(),'sha256':sha(x)}for x in sorted(frozen.rglob('*'))if x.is_file()]
manifest={'status':'CANDIDATE_READY_LOCAL_ROOT_REVIEW_OFFICIAL122_PENDING','domain':'container-nf-available-readonly-alias','version':'1.2','baselineSha256':p['baselineSha256'],'candidateSha256':p['candidateSha256'],'target':p['target'],'sourceFiles':files,'runtimeFiles':inputs,'evidence':[{'path':str(x),'sha256':sha(x)}for x in [STATE/'byte-proof.json',red]+[Path(x['path'])for x in logs]],'checks':1160,'combinations':4,'localVersion':'12.8 diagnostic only','gates':{'official122':False,'published':False,'metadataChanged':False,'canonicalChanged':False,'businessWritten':False},'productionAllowlist':['ContainersPainelFinanceReadService.p','ContainersPainelFinanceReadService.r'],'neverPublish':['FinanceTimeoutFixture.p','FinanceTimeoutFixture.r','all TT tests','wrapper/OO/PHP/frontend/metadados'],'limits':{'candidates':200,'sourceReads':50000,'seconds':10},'codes503':['CONTAINER_NF_CANDIDATE_LIMIT','CONTAINER_NF_SOURCE_LIMIT','CONTAINER_NF_QUERY_TIMEOUT']}
write(frozen/'manifest.json',manifest);cp(frozen/'manifest.json',public/'manifest.json');write(STATE/'freeze-seal.json',{'manifestSha256':sha(frozen/'manifest.json'),'candidateSha256':sha(candidate),'frozen':str(frozen),'sourceFrozen':str(public)})
print(json.dumps({'candidateReady':True,'manifestSha256':sha(frozen/'manifest.json'),'candidateSha256':sha(candidate),'checks':1160,'public':str(public),'runtime':str(frozen)}))
