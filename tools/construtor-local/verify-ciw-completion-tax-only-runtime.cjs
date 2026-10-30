'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2/tax-only-metadata');
const scope={console,URL,window:null};scope.window=scope;vm.createContext(scope);
for(const file of ['src/crud-engine/CrudUtils.js','src/process-engine/ProcessDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const save=(n,v)=>c.fs.writeFileSync(c.path.join(dir,n),JSON.stringify(safe(v),null,2)+'\n');
async function main(){c.assert.ok(c.readJson(c.path.join(dir,'metadata-publication.json')).success);await c.session(async({api,runtime})=>{
 const screen=await runtime('ciw.container-calcular-impostos');c.assert.equal(new scope.ProcessDefinitionValidator().validate(screen),true);c.assert.equal(screen.pageType,'process');c.assert.equal(screen.program.version,'1.0.0');
 c.assert.deepEqual(screen.contextFields,[{field:'container_id',required:true,readonly:true}]);c.assert.equal(screen.process.parameters.fields.length,1);const field=screen.process.parameters.fields[0];c.assert.equal(field.type,'integer');c.assert.equal(field.readonly,true);c.assert.equal(field.required,true);c.assert.ok(screen.process.actions.process.confirmation.message);
 c.assert.deepEqual(screen.dataSource.api.process,{endpointId:'run',method:'POST',originalMethod:'POST'});
 const source=(await api('/api-sources/motor_progress_container_processos')).apiSource;c.assert.equal(source.operations.length,6);save('source-six-current.json',source);
 const parent=await api('/programs/op1003');save('op1003-after.json',parent);c.assert.equal(parent.versions.find(v=>v.status==='published').version,'1.0.3');
 for(const row of parent.versions)c.assert.ok(row.governance?.grant==null||row.governance.grant.status!=='active');
 for(const code of ['op1016','op1043']){const dto=await api('/programs/'+code);for(const row of dto.versions??[])c.assert.ok(row.governance?.grant==null||row.governance.grant.status!=='active');}
 save('runtime-proof.json',{success:true,nativeProcessValidator:true,requiredReadonlyIntegerContext:true,confirmation:true,sourceOperations:6,parentVersion:'1.0.3',temporaryGrantsRevoked:true,processExecuted:false,positiveOperationalTestPending:true,humanPermissionsChanged:false,permissions:{read:'container_calcular_impostos_progress.read',process:'container_calcular_impostos_progress.process'}});
 console.log('PASS1043nativeprocess/context/confirmation/source6/parent1.0.3;no execution or human grants');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
