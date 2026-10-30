'use strict';
const c=require('./purchase-payments-builder-common.cjs');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build7');
const safe=v=>Array.isArray(v)?v.map(safe):v&&typeof v==='object'?Object.fromEntries(Object.entries(v).map(([k,x])=>[k,k==='authHeaders'?[]:safe(x)])):v;
async function main(){await c.session(async({api})=>{
 const plan=c.readJson(c.path.join(state,'metadata/source-additions.json')),source=(await api('/api-sources/'+plan.sourceCode)).apiSource,before=c.readJson(c.path.join(state,'metadata-source-before.json')),boot=await api('/bootstrap');
 c.assert.equal(source.operations.length,140);for(const old of before.operations)c.assert.deepEqual(source.operations.find(x=>x.code===old.code),old);
 const results=plan.operations.map(x=>{const expected=x.value,actual=source.operations.find(x=>x.code===expected.code);c.assert.ok(actual);return{code:expected.code,compatible:c.compatibleOperation(actual,expected,source.baseUrl),type:{actual:actual.type,expected:expected.type},method:{actual:actual.method,expected:expected.method},pathEqual:c.operationPath(source.baseUrl,actual.path)===c.operationPath(source.baseUrl,expected.path),bodyEqual:JSON.stringify(actual.bodyTemplate)===JSON.stringify(expected.bodyTemplate),actualBodyKeys:Object.keys(actual.bodyTemplate??{}),expectedBodyKeys:Object.keys(expected.bodyTemplate??{}),context:{actual:actual.requestContextFields??[],expected:expected.requestContextFields??[]}};});
 for(const code of ['op1045','op1046','op1049','op1050'])c.assert.ok(!boot.programs.some(x=>(x.programCode??x.code)===code));
 c.fs.writeFileSync(c.path.join(state,'metadata-source-after-inspected.json'),JSON.stringify(safe(source),null,2)+'\n');
 c.fs.writeFileSync(c.path.join(state,'metadata-partial-inspection.json'),JSON.stringify({success:true,sourceOperations:140,previous132Preserved:true,noNewPrograms:true,results,businessWrites:false,humanPermissionsChanged:false},null,2)+'\n');console.log(JSON.stringify(results));
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
