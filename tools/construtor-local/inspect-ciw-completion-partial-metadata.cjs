'use strict';
const c=require('./purchase-payments-builder-common.cjs'),state=c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build3');
c.session(async({api})=>{
 const before=c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/source-118-before.json')),current=(await api('/api-sources/'+before.code)).apiSource;c.assert.equal(current.operations.length,124);
 for(const old of before.operations)c.assert.deepEqual(current.operations.find(x=>x.code===old.code),old);
 const additions=['container-fiscal-readonly','container-version-history/frozen-v1.3'].flatMap(p=>c.readJson(c.path.join(c.root,'integration-src/ciw-completion-20261028',p,'metadata/api-source-additions.json')).operations);
 for(const op of additions){const matches=current.operations.filter(x=>x.code===op.code);c.assert.equal(matches.length,1);c.assert.ok(c.compatibleOperation(matches[0],op,current.baseUrl));}
 const preflight=c.readJson(c.path.join(state,'metadata-preflight.json')),boot=await api('/bootstrap');
 for(const child of preflight.children){c.assert.ok(!boot.programs.some(p=>(p.programCode??p.code)===child.code));c.assert.ok(!boot.entities.some(e=>e.code===child.entity));}
 for(const parent of preflight.parents)c.assert.deepEqual(await api('/programs/'+parent.code),c.readJson(c.path.join(state,parent.code+'-program-before.json')));
 c.fs.writeFileSync(c.path.join(state,'metadata-partial-inspection.json'),JSON.stringify({success:true,sourceOnlyApplied:true,sourceOperations:124,previous118Preserved:true,sixAdditionsCompatible:true,childrenEntitiesAbsent:true,childrenProgramsAbsent:true,parentsUnchanged:true,businessWrites:false},null,2)+'\n');
 console.log('PASS partial inspected:source124only;3children absent;2parents unchanged;safe to resume metadata without source replay');
},{readOnly:true}).catch(e=>{console.error(e.message);process.exitCode=1});
