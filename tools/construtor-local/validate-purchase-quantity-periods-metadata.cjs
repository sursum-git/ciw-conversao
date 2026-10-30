'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm'),state=c.path.join(c.root,'.runtime/purchase-quantity-periods-20261028'),meta=c.path.join(c.root,'integration-src/purchase-quantity-periods/metadata');
const draft=c.readJson(c.path.join(meta,'quantidades-importadas-periodo-med-builder-draft.json'));
c.assert.equal(draft.entityDraft.fields.length,21);c.assert.equal(draft.entityDraft.fields.filter(x=>x.primaryKey).length,1);c.assert.equal(draft.entityDraft.fields[0].code,'record_key');
for(const field of draft.entityDraft.fields){c.assert.equal(field.readonlyField,true);c.assert.equal(field.options.writable,false);if(field.dataType==='integer')c.assert.equal(field.options.decimals,0);}
for(const name of ['allowCreate','allowUpdate','allowDelete'])c.assert.equal(draft.programDraft[name],false);
c.assert.deepEqual(draft.programDraft.contextFields,[]);c.assert.deepEqual(draft.programDraft.rowLinks,[]);
c.assert.deepEqual(draft.programDraft.crudOptions.filterFields.slice(0,3),['dt_registro','dt_recebimento','dt_prev_chegada']);
const operations=c.readJson(c.path.join(meta,'api-source-additions.json')).operations;c.assert.equal(operations.length,2);
for(const operation of operations){c.assert.ok(['read','get'].includes(operation.bodyTemplate.operation));c.assert.equal(operation.bodyTemplate.resource,'proc_compra_quantidades_periodo_med');c.assert.deepEqual(operation.requestContextFields,[]);}
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
new scope.CrudDefinitionValidator().validate(c.readJson(c.path.join(state,'global-metadata-preview.json')));
c.fs.writeFileSync(c.path.join(state,'metadata-js-validation.json'),JSON.stringify({success:true,candidateOnly:true,published:false,fields:21,projectionFields:17,operations:2,dateFilters:3,readOnly:true,ambiguousRecordLinks:false,businessWrites:false},null,2)+'\n');
console.log('PASS native metadata PHP/JS candidate21fields,3datefilters,2read/get,no ambiguous record links;not published');
