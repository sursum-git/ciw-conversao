const fs=require('node:fs'),path=require('node:path');const base=__dirname,local=path.resolve(base,'../../../../../.runtime/ciw-completion-20261028/container-version-history/future-v4-local'),programs=path.join(local,'sursum-api/programs');fs.mkdirSync(programs,{recursive:true});fs.copyFileSync(path.join(base,'abl/ContainersVersionHistoryLabels.p'),path.join(programs,'ContainersVersionHistoryLabels.p'));fs.copyFileSync(path.join(base,'tests/ContainersVersionHistoryLabelsTest.p'),path.join(local,'LabelsTest.p'));
const root=local.replaceAll('\\','/');fs.writeFileSync(path.join(local,'Compile.p'),`DEFINE VARIABLE n AS INTEGER NO-UNDO.
PROPATH='${root},' + PROPATH.
OUTPUT TO 'compile.log'.
COMPILE sursum-api/programs/ContainersVersionHistoryLabels.p SAVE NO-ERROR.
PUT UNFORMATTED 'helper ERROR=' COMPILER:ERROR SKIP.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END.
COMPILE LabelsTest.p SAVE NO-ERROR.
PUT UNFORMATTED 'test ERROR=' COMPILER:ERROR SKIP.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(n) SKIP. END.
OUTPUT CLOSE.
QUIT.
`);fs.writeFileSync(path.join(local,'Run.p'),`PROPATH='${root},' + PROPATH.
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN LabelsTest.r.
QUIT.
`);console.log(JSON.stringify({futureLocal:local}));
