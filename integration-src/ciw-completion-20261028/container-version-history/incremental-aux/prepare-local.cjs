const fs=require('node:fs'),path=require('node:path');const dir=__dirname,pkg=path.resolve(dir,'..'),rootPrivate=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history'),stage=path.join(rootPrivate,'incremental-aux-stage'),local=path.join(rootPrivate,'incremental-aux-local'),programs=path.join(local,'sursum-api/programs'),tests=path.join(local,'tests'),includes=path.join(local,'sursum-api/includes');for(const d of[programs,tests,includes])fs.mkdirSync(d,{recursive:true});
const files=[];for(const f of['ContainersVersionAuxHistoryApi.p','ContainersVersionAuxHistoryService.p']){fs.copyFileSync(path.join(dir,'abl',f),path.join(programs,f));files.push('sursum-api/programs/'+f);}fs.copyFileSync(path.join(stage,'CiwErpReadService.p'),path.join(programs,'CiwErpReadService.p'));files.push('sursum-api/programs/CiwErpReadService.p');fs.copyFileSync('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionService.p',path.join(programs,'ContainersVersionService.p'));files.push('sursum-api/programs/ContainersVersionService.p');fs.copyFileSync(path.join(stage,'CiwCadastrosCrud.p'),path.join(programs,'CiwCadastrosCrud.p'));files.push('sursum-api/programs/CiwCadastrosCrud.p');
fs.copyFileSync(path.join(dir,'includes/ContainersVersionAuxHistoryTables.i'),path.join(includes,'ContainersVersionAuxHistoryTables.i'));for(const f of['ContainersVersionAuxHistoryTest.p','ContainersVersionHistoryTestTables.i'])fs.copyFileSync(path.join(dir,'tests/abl',f),path.join(tests,f));files.push('tests/ContainersVersionAuxHistoryTest.p');
const root=local.replaceAll('\\','/');fs.writeFileSync(path.join(local,'Compile.p'),`DEFINE VARIABLE files AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
files='${files.join(',')}'. OUTPUT TO 'compile.log'.
DO n=1 TO NUM-ENTRIES(files): COMPILE VALUE(ENTRY(n,files)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(n,files) ' ERROR=' COMPILER:ERROR SKIP. DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. END.
OUTPUT CLOSE. QUIT.
`);fs.writeFileSync(path.join(local,'Run.p'),`PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN tests/ContainersVersionAuxHistoryTest.r.
QUIT.
`);console.log(JSON.stringify({local,sources:files.length}));
