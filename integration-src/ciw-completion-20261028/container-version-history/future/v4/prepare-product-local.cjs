const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');const dest=__dirname,pkg=path.resolve(dest,'../..'),privateRoot=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history'),local=path.join(privateRoot,'future-v4-product-local');const programs=path.join(local,'sursum-api/programs'),includes=path.join(local,'sursum-api/includes'),tests=path.join(local,'tests');for(const d of[programs,includes,tests])fs.mkdirSync(d,{recursive:true});
const files=[];for(const f of fs.readdirSync(path.join(dest,'abl'))){fs.copyFileSync(path.join(dest,'abl',f),path.join(programs,f));files.push('sursum-api/programs/'+f);}for(const f of fs.readdirSync(path.join(dest,'includes')))fs.copyFileSync(path.join(dest,'includes',f),path.join(includes,f));for(const f of fs.readdirSync(path.join(dest,'tests')))if(f.endsWith('.p')||f.endsWith('.i')){fs.copyFileSync(path.join(dest,'tests',f),path.join(tests,f));if(f.endsWith('.p'))files.push('tests/'+f);}
const baselines=JSON.parse(fs.readFileSync(path.join(pkg,'frozen-aux-v1.1/baselines.json'),'utf8')).baselines;
for(const f of['ContainersVersionService.p','CiwErpReadService.p']){let s=fs.readFileSync(path.join(privateRoot,f==='ContainersVersionService.p'?'incremental-aux-local/sursum-api/programs':'incremental-aux-stage',f),'utf8');const expected=f==='ContainersVersionService.p'?JSON.parse(fs.readFileSync(path.join(pkg,'frozen-aux-v1.1/manifest.json'),'utf8')).dependency.sha256:baselines.find(b=>b.target.endsWith('/'+f)).candidateSha256;if(crypto.createHash('sha256').update(s).digest('hex')!==expected)throw Error('Historical fixture dependency drift '+f);if(f==='CiwErpReadService.p'){for(const [resource,field]of[['container_versoes_historico_med','item_descricao_atual'],['container_versao_nfs_historico_med','emitente_nome_abrev_atual'],['container_versao_despesas_historico_med','despesa_descricao_atual']]){const re=new RegExp("(WHEN '"+resource+"' THEN ASSIGN\\s+cFieldList=')([^']+)(')");if(!re.test(s))throw Error('Reader fixture anchor missing');s=s.replace(re,'$1$2,'+field+'$3');}}fs.writeFileSync(path.join(programs,f),s);files.push('sursum-api/programs/'+f);}
const root=local.replaceAll('\\','/');fs.writeFileSync(path.join(local,'Compile.p'),`DEFINE VARIABLE files AS CHARACTER NO-UNDO.
DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE j AS INTEGER NO-UNDO.
PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
files='${files.join(',')}'. OUTPUT TO 'compile.log'.
DO n=1 TO NUM-ENTRIES(files): COMPILE VALUE(ENTRY(n,files)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(n,files) ' ERROR=' COMPILER:ERROR SKIP. DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. END.
OUTPUT CLOSE. QUIT.
`);fs.writeFileSync(path.join(local,'Run.p'),`PROPATH='${root},${root}/tests,D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=SESSION:PARAMETER.
RUN tests/ContainersVersionHistoryLabelsTest.r.
RUN tests/ContainersVersionHistoryTest.r.
RUN tests/ContainersVersionAuxHistoryTest.r.
QUIT.
`);console.log(JSON.stringify({futureLocal:local,sources:files.length,sharedPatchesCreated:0}));
