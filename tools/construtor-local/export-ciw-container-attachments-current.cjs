'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/container-attachments-current');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){c.fs.mkdirSync(dir,{recursive:true});await c.session(async({api})=>{
 const program=await api('/programs/op1004'),entity=await api('/entities/container_anexos_progress');c.assert.equal(program.program.screenId,'ciw.container-anexos');c.assert.equal(entity.entity.code,'container_anexos_progress');
 const code=entity.entity.apiSourceCode;c.assert.equal(typeof code,'string');c.assert.match(code,/^motor_progress_[a-z_]+$/);const source=await api('/api-sources/'+code);
 for(const [name,data]of [['op1004-program.json',program],['container-anexos-entity.json',entity],['source-current.json',source]])c.fs.writeFileSync(c.path.join(dir,name),JSON.stringify(safe(data),null,2)+'\n');
 c.fs.writeFileSync(c.path.join(dir,'sanitization.json'),JSON.stringify({success:true,allNestedAuthHeadersOmitted:true,sourceCode:code,catalogWrites:false,businessWrites:false},null,2)+'\n');
 console.log('PASS readonly currentcontainerattachments program/entity/source exports;recursiveauth headers omitted');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
