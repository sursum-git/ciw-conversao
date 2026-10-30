// OpenEdge 12.8 DEVELOPMENT diagnostic only. No official or deployable r-code.
const fs=require('node:fs'),path=require('node:path');
const pkg=__dirname,privateRoot=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history');
const dir=path.join(privateRoot,'local-diagnostic'),programs=path.join(dir,'sursum-api/programs'),tests=path.join(dir,'tests'),includes=path.join(dir,'sursum-api/includes');
for(const d of [dir,programs,tests,includes])fs.mkdirSync(d,{recursive:true});
const sources=[];
for(const f of ['ContainersVersionService.p','CiwErpReadService.p','CiwCadastrosCrud.p']){fs.copyFileSync(path.join(privateRoot,'stage',f),path.join(programs,f));sources.push('sursum-api/programs/'+f);}
for(const f of ['ContainersVersionHistoryService.p','ContainersVersionHistoryApi.p']){fs.copyFileSync(path.join(pkg,'abl',f),path.join(programs,f));sources.push('sursum-api/programs/'+f);}
if(fs.existsSync(path.join(pkg,'abl/ContainersVersionAuxHistoryService.p')))for(const f of ['ContainersVersionAuxHistoryService.p','ContainersVersionAuxHistoryApi.p']){fs.copyFileSync(path.join(pkg,'abl',f),path.join(programs,f));sources.push('sursum-api/programs/'+f);}
fs.copyFileSync(path.join(pkg,'includes/ContainersVersionHistoryTable.i'),path.join(includes,'ContainersVersionHistoryTable.i'));
if(fs.existsSync(path.join(pkg,'includes/ContainersVersionAuxHistoryTables.i')))fs.copyFileSync(path.join(pkg,'includes/ContainersVersionAuxHistoryTables.i'),path.join(includes,'ContainersVersionAuxHistoryTables.i'));
for(const f of ['ContainersVersionHistoryTest.p','ContainersVersionHistoryTestTables.i'])fs.copyFileSync(path.join(pkg,'tests/abl',f),path.join(tests,f));
for(const f of ['ContainersVersionTest.p','ContainersVersionFixture.p','ContainersVersionTestTables.i'])fs.copyFileSync('D:/opencode/motor-progress/v2/tests/abl/container-panel/'+f,path.join(tests,f));
sources.push('tests/ContainersVersionFixture.p','tests/ContainersVersionTest.p','tests/ContainersVersionHistoryTest.p');
if(fs.existsSync(path.join(pkg,'tests/abl/ContainersVersionAuxHistoryTest.p'))){fs.copyFileSync(path.join(pkg,'tests/abl/ContainersVersionAuxHistoryTest.p'),path.join(tests,'ContainersVersionAuxHistoryTest.p'));sources.push('tests/ContainersVersionAuxHistoryTest.p');}
const abl=s=>s.replaceAll('\\','/');
fs.writeFileSync(path.join(dir,'CompileDiagnostic.p'),`BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE files AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
PROPATH='${abl(dir)},${abl(programs)},${abl(tests)},D:/opencode/motor-progress/v2,' + PROPATH.
files='${sources.join(',')}'.
OUTPUT TO 'compile.log'.
PUT UNFORMATTED 'DEVELOPMENT ONLY OpenEdge=' PROVERSION ' NUMDBS=' NUM-DBS SKIP.
DO n=1 TO NUM-ENTRIES(files):
 COMPILE VALUE(ENTRY(n,files)) SAVE NO-ERROR.
 PUT UNFORMATTED ENTRY(n,files) ' ERROR=' COMPILER:ERROR SKIP.
 IF COMPILER:ERROR OR ERROR-STATUS:ERROR THEN failed=TRUE.
 DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END.
END.
PUT UNFORMATTED (IF failed THEN 'FAIL' ELSE 'PASS') SKIP.
OUTPUT CLOSE.
QUIT.
`);
fs.writeFileSync(path.join(dir,'RunDiagnostic.p'),`BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH='${abl(dir)},${abl(programs)},${abl(tests)},D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN tests/ContainersVersionHistoryTest.r.
${fs.existsSync(path.join(pkg,'tests/abl/ContainersVersionAuxHistoryTest.p'))?'RUN tests/ContainersVersionAuxHistoryTest.r.':''}
RUN tests/ContainersVersionTest.r.
QUIT.
`);
console.log(JSON.stringify({status:'DEVELOPMENT_STAGE_ONLY',dir,sources:sources.length}));
