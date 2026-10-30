'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-header-current');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){c.assert.ok(!c.fs.existsSync(dir),'Inspect prior export before replay');c.fs.mkdirSync(dir);await c.session(async({api})=>{
 const program=await api('/programs/op1000'),entity=await api('/entities/containers_progress');c.assert.equal(program.program.screenId,'ciw.containers');c.assert.equal(entity.entity.code,'containers_progress');
 const code=entity.entity.apiSourceCode;c.assert.match(code,/^motor_progress_[a-z_]+$/);const source=await api('/api-sources/'+code);
 for(const[name,data]of[['op1000-program.json',program],['containers-entity.json',entity],['source-current.json',source]])c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(data),null,2)+'\n');
 c.fs.writeFileSync(c.path.join(dir,'sanitization.json'),JSON.stringify({success:true,allNestedAuthHeadersOmitted:true,sourceCode:code,catalogWrites:false,businessWrites:false,doNotReplaceActualAuthenticationFromSanitizedDto:true},null,2)+'\n');console.log('PASS existing header program/entity/source readonly exports; nested auth omitted');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
