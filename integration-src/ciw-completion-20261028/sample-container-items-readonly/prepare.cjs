const fs=require('fs'),path=require('path'),crypto=require('crypto');
const dir=__dirname,root=path.resolve(dir,'../../..'),local=path.join(root,'.runtime/ciw-completion-20261028/sample-container-items-readonly/local'),sha=b=>crypto.createHash('sha256').update(b).digest('hex');
for(const d of ['abl','includes','tests/abl','php','metadata','patches'])fs.mkdirSync(path.join(dir,d),{recursive:true});
for(const d of ['tests','sursum-api/programs','sursum-api/includes'])fs.mkdirSync(path.join(local,d),{recursive:true});
const schemas={allocation:'schema-itens_container.json',container:'schema-pp-container.json',purchase:'schema-itens_proc_compra.json'},evidence=[];let fixture='';
for(const [name,file] of Object.entries(schemas)){
 const p=path.join(root,'integration-src/container-panel/schema',file),b=fs.readFileSync(p),s=JSON.parse(b),key=s.indexes.find(x=>x.primary&&x.unique);
 if(!key)throw Error('Unique physical PK required');
 evidence.push({path:path.relative(root,p).replaceAll('\\','/'),sha256:sha(b),table:s.table,indexes:s.indexes});
 fixture+='DEFINE TEMP-TABLE '+name+'Source NO-UNDO\n'+s.fields.map(f=>' FIELD '+f.name+' AS '+f.type.toUpperCase()+(f.type==='decimal'?' DECIMALS '+f.decimals:'')+(f.extent?' EXTENT '+f.extent:'')).join('\n')+'\n INDEX pk IS UNIQUE PRIMARY '+key.fields.join(' ')+'.\n';
}
fs.writeFileSync(path.join(dir,'tests/abl/SampleContainerItemsFixtures.i'),fixture);
const fields={item_container_id:'INTEGER',codigo_erp:'CHARACTER',descricao:'CHARACTER',container_id:'INTEGER'};
fs.writeFileSync(path.join(dir,'includes/SampleContainerItemsTable.i'),'DEFINE TEMP-TABLE ttSampleContainerItems NO-UNDO\n'+Object.entries(fields).map(([f,t])=>' FIELD '+f+' AS '+t+' INITIAL ?').join('\n')+'\n INDEX pk IS UNIQUE PRIMARY item_container_id.\n');
const sourceDir=path.join(root,'sources/scriptcase/ciw-completion-next19c-20261028/cons_item_container_amostra'),sources=fs.readdirSync(sourceDir).map(f=>({path:path.relative(root,path.join(sourceDir,f)).replaceAll('\\','/'),sha256:sha(fs.readFileSync(path.join(sourceDir,f)))}));
fs.writeFileSync(path.join(dir,'source-proof.json'),JSON.stringify({scope:'GLOBAL source faithful, two header states both3; not equivalent to contextual container panel',sources,schemas:evidence,origin:{app:'cons_item_container_amostra',tables:'index.php:1160',predicate:'index.php:3630; grid.class.php:648',projection:'grid.class.php:815',defaultSort:'grid.class.php:562',lookup:'empty lookup class',columns:4,financialFormula:false},navigation:{externalCaller:'not found in sanitized local corpus by literal app-name search; no invented navigation or writer'},identity:{physicalPK:'itens_container.item_container_id',record_key:'JSON item_container_id',ties:'central reader PK tie is deterministic extension, not source guarantee'}},null,2)+'\n');
for(const f of fs.readdirSync(path.join(dir,'tests/abl')))fs.copyFileSync(path.join(dir,'tests/abl',f),path.join(local,'tests',f));
fs.copyFileSync(path.join(dir,'includes/SampleContainerItemsTable.i'),path.join(local,'sursum-api/includes/SampleContainerItemsTable.i'));
for(const f of fs.readdirSync(path.join(dir,'abl')))fs.copyFileSync(path.join(dir,'abl',f),path.join(local,'sursum-api/programs',f));
const stage=path.join(root,'.runtime/ciw-completion-20261028/sample-container-items-readonly/stage');
for(const f of ['CiwErpReadService.p','CiwCadastrosCrud.p'])if(fs.existsSync(path.join(stage,f)))fs.copyFileSync(path.join(stage,f),path.join(local,'sursum-api/programs',f));
const files=[...['CiwErpReadService.p','CiwCadastrosCrud.p'].filter(f=>fs.existsSync(path.join(local,'sursum-api/programs',f))).map(f=>'sursum-api/programs/'+f),...fs.readdirSync(path.join(dir,'abl')).map(f=>'sursum-api/programs/'+f),'tests/SampleContainerItemsTest.p'];
const pp=local.replaceAll('\\','/');
fs.writeFileSync(path.join(local,'Compile.p'),`DEFINE VARIABLE n AS INTEGER NO-UNDO. DEFINE VARIABLE j AS INTEGER NO-UNDO. DEFINE VARIABLE files AS CHARACTER NO-UNDO. PROPATH='${pp},${pp}/tests,D:/opencode/motor-progress/v2,' + PROPATH. files='${files.join(',')}'. OUTPUT TO 'compile.log'. DO n=1 TO NUM-ENTRIES(files): COMPILE VALUE(ENTRY(n,files)) SAVE NO-ERROR. PUT UNFORMATTED ENTRY(n,files) ' ERROR=' COMPILER:ERROR SKIP. DO j=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED ERROR-STATUS:GET-MESSAGE(j) SKIP. END. END. OUTPUT CLOSE. QUIT.\n`);
fs.writeFileSync(path.join(local,'Run.p'),`PROPATH='${pp},${pp}/tests,D:/opencode/motor-progress/v2,' + PROPATH. SESSION:NUMERIC-FORMAT=SESSION:PARAMETER. DO ON ERROR UNDO, LEAVE: RUN tests/SampleContainerItemsTest.r. CATCH e AS Progress.Lang.Error: OUTPUT TO 'sample-tests.log'. PUT UNFORMATTED 'FAIL ' e:GetMessage(1) SKIP. OUTPUT CLOSE. END CATCH. END. QUIT.\n`);
console.log(JSON.stringify({local,compileEntries:files.length,schemas:evidence.length}));
