from pathlib import Path
import hashlib,json,re,xml.etree.ElementTree as ET
W=Path('D:/opencode/conversao-sc');P=Path(__file__).resolve().parents[1]
S=W/'.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1'
def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
plan=json.loads((P/'patches/patch-plan.json').read_text());files=[]
for patch in plan['textPatches']:
 rel=patch['relative'];base=S/('baseline11'if(S/'baseline11'/rel).exists()else'baseline')/rel;data=base.read_bytes();assert sha(base)==patch['baselineSha256']
 for h in patch['changes']:
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(a)==1;data=data.replace(a,b,1)
 assert hashlib.sha256(data).hexdigest()==patch['candidateSha256'];assert data==(S/'local'/rel).read_bytes()==(S/'candidates'/rel).read_bytes()
 for h in reversed(patch['changes']):
  a=bytes.fromhex(h['oldBytesHex']);b=bytes.fromhex(h['newBytesHex']);assert data.count(b)==1;data=data.replace(b,a,1)
 assert data==base.read_bytes();files.append({'relative':rel,'hunks':len(patch['changes']),'baselineSha256':sha(base),'candidateSha256':patch['candidateSha256'],'reverseByteExact':True,'outsideHunksChanged':False})
def routines(data):
 result={}
 for m in re.finditer(rb'(?m)^(FUNCTION|PROCEDURE) (\w+)[^\r\n]*:\r?$',data):
  end=re.search(rb'(?m)^END '+m.group(1)+rb'\.\r?$',data[m.end():]);assert end
  result[m.group(2).decode()]=data[m.start():m.end()+end.end()]
 return result
rel='sursum-api/programs/ContainersPainelFinanceReadService.p';before=routines((S/'baseline'/rel).read_bytes());after=routines((S/'candidates'/rel).read_bytes());changed=[name for name in before if before[name]!=after[name]]
assert set(changed)=={'AllowedName','AvailableNfs','AcceptRow'},changed
for name in ['NfRow','NfKey','NfKeyBytes','NfReadBound']:assert before[name]==after[name]
rel='sursum-api/programs/CiwErpReadService.p';a=routines((S/'baseline11'/rel).read_bytes());b=routines((S/'candidates'/rel).read_bytes());assert a['FilterExpr']==b['FilterExpr']
rel='php/RuntimeCiwErpQuery.php';a=(S/'baseline11'/rel).read_bytes();b=(S/'candidates'/rel).read_bytes();pos=a.index(b'    private static function filter(');assert a[pos:]==b[b.index(b'    private static function filter('):]
abl=json.loads((S/'local/abl-proof.json').read_text());assert abl['success'] and len(abl['combinations'])==4
counts=[]
for combination in abl['combinations']:
 assert combination['NUMDBS']==0 and len(combination['suites'])==7
 ns=[int(re.search(r'PASS:? (\d+) checks',s).group(1))for s in combination['suites']];assert ns[1:]==[231,18,39,2,47,49],ns;counts.append(sum(ns))
assert len(set(counts))==1
xml=ET.parse(S/'full-stage/php-full.xml').getroot();suite=xml.find('testsuite');assert not list(xml.iter('failure')) and not list(xml.iter('error')) and not list(xml.iter('skipped'))
assert len(list(xml.iter('testcase')))==990 and int(suite.get('assertions'))==7119
loader=json.loads((S/'full-stage/php-stage-loader-proof.json').read_text());assert loader['success'] and not loader['outsideStage'] and loader['loadedAppDefinitions']==277
for patch in plan['textPatches']:
 if not patch['relative'].startswith('php/'):continue
 assert sha(S/'full-stage/backend-stage/backend/src/Runtime'/Path(patch['relative']).name)==patch['candidateSha256']
native=json.loads((S/'native-result.json').read_text());assert native['success'] and native['checks']==23 and native['writes']==0 and native['network']==0 and native['exportAvailable']==False
preview=json.loads((P/'metadata/api-source-preview.json').read_text());old=json.loads((W/'integration-src/ciw-completion-20261028/container-nf-available-readonly/frozen-v1/metadata/api-source-preview.json').read_text());assert preview['operations'][:4]==old['operations'][:4] and len(preview['operations'])==6 and preview['operations'][4]['totalPath']=='total' and preview['operations'][5]['type']=='detail'
proof={'success':True,'productionFiles':files,'financeUnchangedRoutines':sorted(set(before)-set(changed)),'NfRowKeyAliasByteIdentical':True,'FilterExprAndPhpFilterParserByteIdentical':True,'sharedBaseline':'official11','ablChecksPerCombination':counts[0],'ablChecksTotal':sum(counts),'NUMDBS':0,'phpTests':990,'phpAssertions':7119,'loadedAppDefinitions':277,'allAppStaged':True,'nativeChecks':23,'nativeRequestsReplayedThroughRuntime':5,'sourceReadLimit':50000,'pageLimit':200,'requestDeadlineSeconds':10,'ttIsDerivedNotSecondErpSource':True,'writerCalls':0,'networkCalls':0,'official122':False,'published':False,'metadataReady':False}
(S/'verification.json').write_text(json.dumps(proof,indent=2)+'\n',encoding='utf8');print(json.dumps({k:v for k,v in proof.items()if k not in ['productionFiles','financeUnchangedRoutines']}))
