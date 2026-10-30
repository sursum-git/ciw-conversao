'use strict';
// Independent local review. No network, publication or commercial data.
const fs=require('node:fs'),vm=require('node:vm'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root='D:/opencode/conversao-sc',canonical='D:/opencode/construtor-pg';
const state=root+'/.runtime/ciw-completion-20261028/official-build3/';
const read=p=>JSON.parse(fs.readFileSync(p,'utf8').replace(/^\uFEFF/,''));
const hash=p=>crypto.createHash('sha256').update(fs.readFileSync(p)).digest('hex');
const scope={console,URL,URLSearchParams,jQuery:()=>{throw Error('No DOM expected');},location:{href:'http://localhost/app.html',origin:'http://localhost'}};scope.window=scope;
vm.createContext(scope);
for(const name of ['src/crud-engine/CrudUtils.js','src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js','src/crud-engine/CrudKendoGridRenderer.js','src/crud-engine/CrudEngine.js'])vm.runInContext(fs.readFileSync(canonical+'/'+name,'utf8'),scope,{filename:name});
const specs=[
 ['op1003','ciw.container-despesas','container-fiscal-readonly/local/op1034-preview.json','container_id','despesa_container_id'],
 ['op1005','ciw.container-versoes-custo','container-version-history/manager-preview-v1.json','container_id','versao_id']
];
const parents=[];
for(const [code,screen,childPath,...keys] of specs){
 const before=read(state+code+'-program-before.json').versions.filter(x=>x.status==='published').at(-1);
 const draft=read(state+code+'-parent-draft.json'),old=before.builderConfig,copy=structuredClone(draft);
 assert.equal(draft.screenId,screen);assert.equal(draft.builderEntityCode,old.builderEntityCode);
 assert.equal(draft.version,old.version.replace(/(\d+)$/,n=>String(Number(n)+1)));
 assert.equal(draft.rowLinks.length,(old.rowLinks||[]).length+1);
 assert.deepEqual(draft.rowLinks.slice(0,-1),old.rowLinks||[]);
 copy.version=old.version;copy.rowLinks=old.rowLinks;assert.deepEqual(copy,old,'Only version and one appended row link permitted');
 const raw=read(state+screen+'-runtime-before.json');
 const parent=new scope.PageDefinitionNormalizer().normalize(raw);
 const child=new scope.PageDefinitionNormalizer().normalize(read(root+'/.runtime/ciw-completion-20261028/'+childPath));
 new scope.CrudDefinitionValidator().validate(child);
 const link=draft.rowLinks.at(-1);assert.equal(link.screenId,child.screenId);
 assert.deepEqual(link.parameters.map(x=>x.field),keys);assert.deepEqual(link.parameters.map(x=>x.sourceField),keys);
 const sample={};keys.forEach((key,index)=>{assert.ok(parent.dataModel.fields[key]);assert.ok(child.contextFields.some(x=>x.field===key&&x.required&&x.readonly));sample[key]=100+index;});
 const renderer=Object.create(scope.CrudKendoGridRenderer.prototype),html=renderer.buildRowLinkHtml(link,sample);
 const url=new URL(html.match(/href="([^"]+)"/)[1].replaceAll('&amp;','&'),'http://localhost');
 assert.equal(url.searchParams.get('screenId'),child.screenId);
 const engine=Object.create(scope.CrudEngine.prototype);engine.definition=child;engine.options={contextValues:Object.fromEntries(keys.map(key=>[key,url.searchParams.get('context__'+key)]))};engine.initializeNavigationContext();
 keys.forEach(key=>assert.equal(engine.contextValues[key],sample[key]));
 assert.equal(child.permissions.create,false);assert.equal(child.permissions.edit,false);assert.equal(child.permissions.delete,false);
 parents.push({code,screen,draftSha256:hash(state+code+'-parent-draft.json'),baselineSha256:hash(state+code+'-program-before.json'),deltaOnlyVersionAndOneRowLink:true,previousBuilderConfigPreserved:true,nativeLinkToRequiredReadonlyContext:true,childScreen:child.screenId});
}
const scripts=['prepare-ciw-completion-metadata.cjs','publish-ciw-completion-wave1-metadata.cjs'].map(name=>({name,sha256:hash(root+'/tools/construtor-local/'+name)}));
const out={success:true,reviewer:'ciw_completion_manager',parents,scripts,remainingP1P2:[],publicationExecuted:false,businessWrites:false,scope:'Static publisher review and local native parent link/context proof. Root must satisfy parent404 official/PASOE gate and publication/runtime verification.'};
fs.writeFileSync(state+'manager-parent-metadata-review.json',JSON.stringify(out,null,2)+'\n');
console.log('PASS two exact parent deltas and native row links; publisher static review, no execution');
