const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');const dir=__dirname,pkg=path.resolve(dir,'..'),base=path.join(pkg,'frozen-v1.3'),target='D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionHistoryService.p';
const sha=b=>crypto.createHash('sha256').update(b).digest('hex');const original=fs.readFileSync(target,'utf8');if(sha(Buffer.from(original))!==sha(fs.readFileSync(path.join(base,'abl/ContainersVersionHistoryService.p'))))throw Error('Integrated service drift; re-audit required');fs.writeFileSync(path.join(dir,'ContainersVersionHistoryService.baseline.p'),original);
let test=fs.readFileSync(path.join(base,'tests/abl/ContainersVersionHistoryTest.p'),'utf8');test=test.replace('DEFINE VARIABLE ht AS HANDLE EXTENT 8 NO-UNDO.','DEFINE TEMP-TABLE brokenMaster NO-UNDO FIELD unrelated AS INTEGER.\nDEFINE VARIABLE savedMaster AS HANDLE NO-UNDO.\nDEFINE VARIABLE ht AS HANDLE EXTENT 8 NO-UNDO.');
const anchor="RUN Parse('~{\"operation\":\"read\",\"container_id\":456,\"versao_id\":1003}'). RUN Invoke. RUN Code(404).";
if(test.split(anchor).length!==2)throw Error('Missing parent regression anchor drift');test=test.replace(anchor,anchor+`
RUN Parse('~{"operation":"read","container_id":1,"versao_id":1001}'). RUN Invoke. RUN Code(404).
RUN Check(responseValue:GetJsonObject('error'):GetCharacter('code')='VERSION_HISTORY_PARENT','missing physical parent is 404, not configuration').
RUN Check(NOT responseValue:Has('data'),'missing parent has no partial data').
savedMaster=hb[1]. hb[1]=BUFFER brokenMaster:HANDLE.
RUN Parse('~{"operation":"read","container_id":123,"versao_id":1001}'). RUN Invoke. RUN Code(503).
hb[1]=savedMaster.
`);fs.writeFileSync(path.join(dir,'ContainersVersionHistoryTest.p'),test);
const local=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history/bugfix-parent-local'),programs=path.join(local,'sursum-api/programs'),tests=path.join(local,'tests');for(const d of[programs,tests])fs.mkdirSync(d,{recursive:true});
for(const f of['ContainersVersionService.p','CiwErpReadService.p'])fs.copyFileSync('D:/opencode/motor-progress/v2/sursum-api/programs/'+f,path.join(programs,f));fs.copyFileSync(path.join(dir,'ContainersVersionHistoryService.baseline.p'),path.join(programs,'ContainersVersionHistoryService.p'));fs.copyFileSync(path.join(dir,'ContainersVersionHistoryTest.p'),path.join(tests,'ContainersVersionHistoryTest.p'));fs.copyFileSync(path.join(base,'tests/abl/ContainersVersionHistoryTestTables.i'),path.join(tests,'ContainersVersionHistoryTestTables.i'));
const root=local.replaceAll('\\','/');fs.writeFileSync(path.join(local,'Compile.p'),`DEFINE VARIABLE files AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
files='sursum-api/programs/ContainersVersionService.p,sursum-api/programs/CiwErpReadService.p,sursum-api/programs/ContainersVersionHistoryService.p,tests/ContainersVersionHistoryTest.p'. OUTPUT TO 'compile.log'.
DO n=1 TO NUM-ENTRIES(files): COMPILE VALUE(ENTRY(n,files)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(n,files) ' ERROR=' COMPILER:ERROR SKIP. DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. END.
OUTPUT CLOSE. QUIT.
`);fs.writeFileSync(path.join(local,'Run.p'),`PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN tests/ContainersVersionHistoryTest.r.
QUIT.
`);fs.writeFileSync(path.join(dir,'baseline.json'),JSON.stringify({target,baselineSha256:sha(Buffer.from(original)),local,scope:'service + TT test only; no canonical changes'},null,2)+'\n');console.log(JSON.stringify({local,baselineSha256:sha(Buffer.from(original))}));
