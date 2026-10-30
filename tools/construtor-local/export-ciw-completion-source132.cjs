'use strict';
const c=require('./purchase-payments-builder-common.cjs');
async function main(){await c.session(async({api})=>{
 const source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;c.assert.equal(source.operations.length,132);
 const safe=Object.fromEntries(['code','baseUrl','responseContract','operations'].map(k=>[k,structuredClone(source[k])]));
 for(const op of safe.operations){c.assert.equal(Object.keys(op.headers??{}).length,0);c.assert.equal(Object.keys(op.authHeaders??{}).length,0);}
 c.assert.deepEqual(safe,c.readJson(c.path.join(c.root,'.runtime/ciw-completion-20261028/official-build5-v6/source-132-after.json')));
 c.fs.writeFileSync(c.path.join(c.root,'.runtime/ciw-completion-20261028/source-132-current-after6.json'),JSON.stringify(safe,null,2)+'\n');console.log('PASS current sanitized source132 preserved; zero authheaders exported');
 },{readOnly:true});}
main().catch(e=>{console.error(e.message);process.exitCode=1});
