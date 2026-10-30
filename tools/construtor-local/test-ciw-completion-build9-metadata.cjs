'use strict';
// Closed offline helper tests. Importing publisher does not open a session.
const assert=require('node:assert/strict'),fs=require('node:fs'),path=require('node:path');
const prep=require('./prepare-ciw-completion-build9-metadata.cjs'),pub=require('./publish-ciw-completion-build9-metadata.cjs');
const root=path.resolve(__dirname,'../..'),pkg=path.join(root,'integration-src/ciw-completion-20261028/container-nf-available-readonly'),read=p=>JSON.parse(fs.readFileSync(p,'utf8'));
const addition=read(path.join(pkg,'metadata/source-addition.json')),exported=read(addition.baselinePath),before=exported.apiSource??exported,ops=addition.operations.map(x=>x.value),prior=structuredClone(before);let checks=0;
function test(f){f();checks++;}
test(()=>assert.equal(prep.appendOperations(before,ops).operations.length,6));test(()=>assert.deepEqual(before,prior));
test(()=>assert.deepEqual(prep.appendOperations(before,ops).operations.slice(0,4),before.operations));
test(()=>{const out=prep.appendOperations(before,ops);out.operations[0].name='mutated';assert.deepEqual(before,prior);});
test(()=>assert.deepEqual(pub.invariantSource(prep.appendOperations(before,ops)),pub.invariantSource(before)));
for(const change of [x=>x[0].type='custom',x=>x[1].type='get',x=>x[1].code=x[0].code,x=>x[0].path='/not-allowed',x=>x[0].method='DELETE',x=>x[0].bodyTemplate.resource='other',x=>x[0].requestContextFields=[]])test(()=>{const wrong=structuredClone(ops);change(wrong);assert.throws(()=>prep.appendOperations(before,wrong));});
const nav=read(path.join(pkg,'metadata/parent-navigation-delta.json')),parent=read(nav.baselinePath),snapshot=structuredClone(parent),draft=prep.parentDraft(parent,nav.appendRowLink),current=parent.versions.find(x=>x.status==='published').builderConfig;
test(()=>assert.deepEqual(parent,snapshot));test(()=>assert.equal(draft.version,'1.0.3'));test(()=>assert.deepEqual(draft.rowLinks.slice(0,-1),current.rowLinks));test(()=>assert.deepEqual(draft.rowLinks.at(-1),nav.appendRowLink));
test(()=>{const a=structuredClone(current),b=structuredClone(draft);for(const key of ['version','rowLinks','changeSummary']){delete a[key];delete b[key];}assert.deepEqual(b,a);});
test(()=>{const dto=structuredClone(parent);dto.versions[0].governance={grant:'dynamic'};assert.deepEqual(prep.programContract(dto),prep.programContract(parent));});
test(()=>{const dto=structuredClone(parent);dto.versions[0].builderConfig.version='changed';assert.notDeepEqual(prep.programContract(dto),prep.programContract(parent));});
test(()=>{const j={phases:[]},started=pub.sourceTransition(j,'request-started');assert.equal(started.sourceStatus,'request-started');assert.equal(j.sourceStatus,undefined);assert.equal(pub.sourceTransition(pub.sourceTransition(started,'request-returned'),'verified').sourceStatus,'verified');});
for(const [j,s]of [[{},'verified'],[{},'request-returned'],[{sourceStatus:'verified'},'request-started'],[{},'unknown']])test(()=>assert.throws(()=>pub.sourceTransition(j,s)));
test(()=>assert.equal(fs.existsSync(path.join(root,'.runtime/ciw-completion-20261028/build9-v2-metadata-publication-preparation/publication-started.json')),false));
console.log(JSON.stringify({success:true,checks,networkExecuted:false,businessWrites:false,publicationExecuted:false}));
