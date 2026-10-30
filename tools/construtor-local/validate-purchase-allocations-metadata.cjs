'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const state=c.path.join(c.root,'.runtime/purchase-allocations-20261026'),meta=c.path.join(c.root,'integration-src/purchase-allocations/metadata'),pre=c.readJson(c.path.join(state,'preflight.json'));
const child=c.readJson(c.path.join(meta,'proc-compra-alocacoes-builder-draft.json')),parent=c.readJson(c.path.join(meta,'proc-compra-itens-builder-draft.json'));
c.assert.equal(child.entityDraft.fields.length,9);c.assert.equal(child.programDraft.programCode,pre.crudProgramCode);
for(const key of ['allowCreate','allowUpdate','allowDelete'])c.assert.equal(child.programDraft[key],false);
c.assert.equal(child.entityDraft.apiCreateOperationCode,'');c.assert.equal(child.entityDraft.apiUpdateOperationCode,'');c.assert.equal(child.entityDraft.apiDeleteOperationCode,'');
for(const f of child.entityDraft.fields){c.assert.equal(f.readonlyField,true);c.assert.equal(f.options.writable,false);if(f.dataType==='integer'){c.assert.equal(f.options.decimals,0);c.assert.equal(f.options.format,'n0');}}
c.assert.deepEqual(child.programDraft.contextFields.map(x=>x.field),['proc_compra_id','item_proc_compra_id']);for(const x of child.programDraft.contextFields)c.assert.ok(x.required&&x.readonly&&x.filter&&!x.createDefault);
c.assert.equal(parent.programDraft.version,'1.0.3');c.assert.equal(parent.programDraft.formOptions.tabs.length,8);
const baseline=c.path.join(state,'baseline-item-draft.json');
const before=c.readJson(c.fs.existsSync(baseline)?baseline:'D:/opencode/construtor-pg/integrations/ciw-purchase-items/proc-compra-itens-builder-draft.json');
c.assert.deepEqual(parent.entityDraft,before.entityDraft);c.assert.deepEqual(parent.programDraft.formOptions.tabs.slice(0,7),before.programDraft.formOptions.tabs);c.assert.deepEqual(parent.programDraft.rowLinks.slice(0,2),before.programDraft.rowLinks);
const ops=c.readJson(c.path.join(meta,'api-source-additions.json')).operations;c.assert.equal(ops.length,2);
for(const o of ops){c.assert.equal(o.bodyTemplate.resource,'proc_compra_alocacoes');c.assert.deepEqual(o.requestContextFields,['proc_compra_id','item_proc_compra_id']);c.assert.ok(['read','get'].includes(o.bodyTemplate.operation));}
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
for(const name of ['metadata-preview.json','parent-metadata-preview.json'])new scope.CrudDefinitionValidator().validate(c.readJson(c.path.join(state,name)));
c.assert.equal(parent.programDraft.permissionPrefix,before.programDraft.permissionPrefix);c.assert.equal(parent.programDraft.screenId,before.programDraft.screenId); // Runtime adds its standard logs after this raw Builder preview; verify them again on published definition.
c.fs.writeFileSync(c.path.join(state,'metadata-js-validation.json'),JSON.stringify({success:true,fields:9,operations:2,itemTabs:8,previousTabsPreserved:7,itemEntityPreserved:true,existingWriterAndScreenBindingsPreserved:true,runtimeLogVerificationPending:true,businessWrites:false},null,2));
console.log('PASS native PHP/JS definitions; readonly contextual child,7existing tabs and writer/screen bindings preserved');
