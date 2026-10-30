'use strict';
// Closed source and existing NF program; recursively omit authentication fields.
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-finance-current');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){c.assert.ok(!c.fs.existsSync(dir),'Inspect previous export before replay');c.fs.mkdirSync(dir);await c.session(async({api})=>{
 const program=await api('/programs/op1007'),entity=await api('/entities/container_nfs_progress');
 c.assert.equal(program.program.screenId,'ciw.container-nfs');c.assert.equal(entity.entity.code,'container_nfs_progress');c.assert.equal(entity.entity.apiSourceCode,'motor_progress_container_financeiro');
 const source=await api('/api-sources/motor_progress_container_financeiro');c.assert.equal(source.apiSource.code,'motor_progress_container_financeiro');
 for(const[name,data]of[['op1007-program.json',program],['container-nfs-entity.json',entity],['source-current.json',source]])c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(data),null,2)+'\n');
 c.fs.writeFileSync(c.path.join(dir,'sanitization.json'),JSON.stringify({success:true,allNestedAuthHeadersOmitted:true,catalogWrites:false,businessWrites:false,doNotApplySanitizedSourceOverAuthentication:true},null,2)+'\n');
 console.log('PASS readonly finance source and NF program/entity exports; nested auth omitted');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
