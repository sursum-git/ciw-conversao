'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const dir=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build6-v2/tax-only-metadata');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
const contract=dto=>{const x=structuredClone(dto);for(const v of x.versions??[])delete v.governance;return x;};
async function main(){await c.session(async({api})=>{
 const sourceSix=process.argv.includes('--source-six');c.assert.equal(c.fs.existsSync(c.path.join(dir,'publication-started.json')),sourceSix);
 const source=(await api('/api-sources/motor_progress_container_processos')).apiSource,entity=await api('/entities/container_processos_progress'),parent=await api('/programs/op1003'),boot=await api('/bootstrap');
 c.assert.deepEqual(safe(source),c.readJson(c.path.join(dir,sourceSix?'source-six-after.json':'source-five-before.json')));c.assert.equal(source.operations.length,sourceSix?6:5);c.assert.deepEqual(safe(entity),c.readJson(c.path.join(dir,'entity-before.json')));
 c.assert.deepEqual(contract(parent),contract(c.readJson(c.path.join(dir,'op1003-before.json'))));c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)==='op1043'));
 const programs=[];for(const code of ['op1015','op1016','op1043','op1003']){const record=code==='op1003'?parent:await api('/programs/'+code);for(const v of record.versions??[])c.assert.ok(v.governance?.grant==null||v.governance.grant.status!=='active');programs.push({code,versions:record.versions?.length??0,noActiveGrant:true});}
 c.fs.writeFileSync(c.path.join(dir,sourceSix?'second-attempt-only-source-applied.json':'first-attempt-no-catalog-mutation.json'),JSON.stringify({success:true,sourceOperations:sourceSix?6:5,entityPreserved:true,parentVersion:'1.0.2',new1043Absent:true,programs,publicationNotStarted:!sourceSix,businessWrites:false,humanPermissionsChanged:false,cause:sourceSix?'Entity owner requires native resolved owner program and entity locks sharing same authoring grant.':'Only authoring governance DTO changed after acquiring own grants; compare version contract excluding governance only.'},null,2)+'\n');
 console.log('PASS inspectsource'+(sourceSix?6:5)+'/entity/parent1.0.2 preserved/new1043absent/noactivegrants');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
