"""Local, read-only verification of composed build8. Remote12.2 is a separate root gate."""
from pathlib import Path
import json,hashlib,re,sys
R=Path('D:/opencode/conversao-sc');S=R/'.runtime/ciw-completion-20261028';B=S/'official-build8';LOCAL=S/'local-diagnostic-build8'
read=lambda p:json.loads(Path(p).read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(Path(p).read_bytes()).hexdigest();digest=lambda b:hashlib.sha256(b).hexdigest()
bm=read(B/'build-manifest.json');assert len(bm['tests'])==21 and bm['checksPerCombination']==1166 and bm['testLogs']==84 and len(bm['compileEntries'])==74
for package in bm['packages']:
 root=Path(package['path']);assert sha(root/'manifest.json')==package['manifestSha256']
 for file in read(root/'manifest.json')['files']:assert sha(root/file['path'])==file['sha256']
for x in read(B/'source-manifest.json'):assert sha(R/x['file'])==x['sha256'],x['file']
for x in read(B/'integration-plan.json')['files']:
 target=Path(x['target']);assert (sha(target)if target.exists()else None)==x['baselineSha256'];assert sha(x['candidate'])==x['candidateSha256']
for x in read(B/'dependency-snapshots.json'):assert sha(x['target'])==x['sha256'] and sha(x['stage'])==x['sha256']
assert read(B/'include-closure.json')['success'] and not read(B/'include-closure.json')['missing']
proof=read(B/'composition-proof.json');integration=read(B/'integration-plan.json')['files'];composed=[]
for name in sorted({x['file']for x in proof['hunks']}):
 entry=next(x for x in integration if Path(x['target']).name==name);base=Path(entry['target']).read_bytes();stage=Path(entry['candidate']).read_bytes();lines=base.splitlines(keepends=True);hunks=sorted([x for x in proof['hunks']if x['file']==name],key=lambda x:x['baseLineStart']);base_cursor=0;cursor=0;checked=[]
 for i,h in enumerate(hunks):
  start,end=h['baseLineStart']-1,h['baseLineEndExclusive']-1;prefix=b''.join(lines[base_cursor:start]);assert stage[cursor:cursor+len(prefix)]==prefix,(name,'outside prefix');cursor+=len(prefix);assert digest(b''.join(lines[start:end]))==h['oldSha256']
  nextstart=hunks[i+1]['baseLineStart']-1 if i+1<len(hunks)else len(lines);nextprefix=b''.join(lines[end:nextstart]);positions=[]
  if nextprefix:
   p=stage.find(nextprefix,cursor)
   while p>=0:
    if digest(stage[cursor:p])==h['newSha256']:positions.append(p)
    p=stage.find(nextprefix,p+1)
  else:
   for p in range(cursor,len(stage)+1):
    if digest(stage[cursor:p])==h['newSha256']:positions.append(p)
  assert len(positions)==1,(name,'unique reviewed replacement hash',start,end);p=positions[0];checked.append({'baseLineStart':start+1,'baseLineEndExclusive':end+1,'newBytes':p-cursor,'newSha256':h['newSha256']});cursor=p;base_cursor=end
 assert stage[cursor:]==b''.join(lines[base_cursor:]),(name,'outside suffix');composed.append({'file':name,'allOutsideBytesPreserved':True,'hunks':checked,'baselineLoneLf':len(re.findall(b'(?<!\r)\n',base)),'candidateLoneLf':len(re.findall(b'(?<!\r)\n',stage))})
assert sum(x['expectedChecks']for x in bm['tests'])==1166
compile=(LOCAL/'compile.log').read_text(encoding='utf-8-sig');assert compile.startswith('OpenEdge 12.8 NUM-DBS=0');assert 'COMPILER:ERROR=yes'not in compile;assert len(re.findall('COMPILER:ERROR=no',compile))==71;assert 'PASS COMPILE ALL'in compile
logs=[]
for t in bm['tests']:
 assert sha(B/'package'/t['name'])==next(x['sourceSha256']for x in read(B/'test-list.json')if x['name']==t['name'])
 for cp in ['UTF-8','ISO8859-1']:
  for culture in ['AMERICAN','EUROPEAN']:
   p=LOCAL/(t['name'][:-2]+'-'+cp+'-'+culture+'.log');text=p.read_text(encoding='utf-8-sig');assert re.search(r'PASS[^\r\n]*?\b'+str(t['expectedChecks'])+r'\b',text),(p,text);assert 'FAIL'not in text
   process=LOCAL/('process-'+t['name']+'-'+cp+'-'+culture+'.log');raw=process.read_text(encoding='utf-8-sig');assert not re.search(r'\*\*|error|exception|16063',raw,re.I),(process,raw);logs.append({'path':str(p),'sha256':sha(p),'checks':t['expectedChecks']})
assert len(logs)==84 and sum(x['checks']for x in logs)==4664
php=(B/'php-full.xml').read_text(encoding='utf-8');assert 'tests="952" assertions="6351" errors="0" failures="0"'in php
loader=read(B/'php-stage-loader-proof.json');assert loader['success'] and len(loader['proof'])==15
metadata=(B/'metadata-builder.xml').read_text(encoding='utf-8');open_issue='errors="1"'in metadata
if not open_issue:
 assert re.search(r'tests="2" assertions="41" errors="0" failures="0"',metadata);assert read(B/'native-validation.json')['success'];assert len(read(B/'native-validation.json')['results'])==3
 assert read(B/'schema-validation.json')['success'] and read(B/'schema-validation.json')['checks']==7
 assert 'checks=19'in(B/'native-selection.log').read_text(encoding='utf-8-sig')
 companion=read(B/'normalization-companion-proof.json');assert companion['reverseReconstructsStageExactly'] and len(companion['exactAnchors'])==4 and not companion['ablChanged'];assert sha(companion['manifestPath'])==companion['manifestSha256'];assert sha(B/'backend-stage/backend/src/Builder/ProgramBuilderService.php')==companion['candidateStageSha256'];assert companion['newTests']==8
else:assert 'ENTITY_API_OPTIONS_PARAMETERS'in metadata or 'Parametro exige enum escalar fechado'in metadata;assert read(B/'native-validation-readonly.json')['success']
cad=read(B/'metadata/cadastros-source-additions.json');assert sha(cad['baselinePath'])==cad['baselineSha256'] and cad['before']==140 and cad['after']==144;assert [x['value']['type']for x in cad['operations']]==['list','detail','list','detail']
proc=read(B/'metadata/process-source-additions.json');assert sha(proc['target'])==proc['baselineSha256'] and proc['expectedOperationCount']==6 and proc['resultOperationCount']==8;assert [x['value']['type']for x in proc['operations']]==['list','custom']
parent=read(B/'metadata/parent-navigation.json');assert sha(parent['target'])==parent['baselineSha256'] and parent['baselineVersion']=='1.0.3'
for e in read(B/'example-integration-plan.json')['files']:assert sha(e['candidate'])==e['candidateSha256'];assert (sha(e['target'])if Path(e['target']).exists()else None)==e['baselineSha256']
result={'status':'LOCAL_PREPARED_P1_METADATA1047_OPEN'if open_issue else'LOCAL_READY_REQUIRES_MANAGER_REVIEW','state':'PREPARED','localVersion':'12.8 development only','compilesLocal':71,'compilesPlannedOfficial':74,'sourceFiles':110,'suites':21,'checksPerCombination':1166,'combinations':4,'testLogs':84,'totalTtChecks':4664,'testNumDbs':0,'compileOfficialNumDbs':1,'phpTests':952,'phpAssertions':6351,'stagedPhpClassesAndDescriptors':15,'metadataReadonlyNativeScreens':2,'metadataAllNativeScreens':3 if not open_issue else 2,'metadataBuilderTests':2,'metadataBuilderAssertions':41 if not open_issue else 37,'closedSchemaChecks':7 if not open_issue else 0,'nativeProcessChecks':19 if not open_issue else 0,'metadataAllNewOperationTypes':True,'metadata1047OpenP1':open_issue,'composition':composed,'formatOnlyDeltasIgnored':proof['formatOnlyDeltasIgnored'],'canonicalWrites':False,'remoteExecuted':False,'grants':False,'published':False}
(B/'local-verification.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print(json.dumps({k:v for k,v in result.items()if k not in ['composition','formatOnlyDeltasIgnored']}))
if open_issue and '--allow-open-p1'not in sys.argv:sys.exit(2)
