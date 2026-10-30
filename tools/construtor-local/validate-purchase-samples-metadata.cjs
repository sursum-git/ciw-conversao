const c=require('./purchase-samples-metadata-common.cjs'),vm=require('node:vm');
const sample=c.readJson(c.path.join(c.meta,'proc-compra-amostras-builder-draft.json')),item=c.readJson(c.path.join(c.meta,'proc-compra-itens-builder-draft.json'));
c.assert.equal(sample.entityDraft.fields.length,8);c.assert.equal(sample.programDraft.programCode,c.readJson(c.path.join(c.state,'preflight.json')).programCode);
c.assert.deepEqual(sample.programDraft.contextFields.map(x=>x.field),['proc_compra_id','item_proc_compra_id']);c.assert.ok(sample.programDraft.contextFields.every(x=>x.required&&x.readonly));
for(const f of sample.entityDraft.fields){if(f.dataType==='integer'){c.assert.equal(f.options.decimals,0);c.assert.equal(f.options.format,'n0');}c.assert.equal(!f.readonlyField,['cod_rep','dt_envio'].includes(f.code));}
c.assert.equal(sample.entityDraft.fields.find(x=>x.code==='apont_amostra_id').apiShowInForm,false);c.assert.equal(sample.entityDraft.fields.find(x=>x.code==='row_stamp').apiShowInForm,false);
c.assert.equal(item.programDraft.version,'1.0.1');c.assert.equal(item.programDraft.formOptions.tabs.length,6);const linked=item.programDraft.formOptions.tabs.find(x=>x.id==='envios_amostras').linkedPage;
c.assert.equal(linked.screenId,'ciw.proc-compra-amostras');c.assert.equal(linked.hideHeader,false);c.assert.equal(linked.requireRecord,true);c.assert.deepEqual(linked.filters.map(x=>x.field),['proc_compra_id','item_proc_compra_id']);
c.assert.ok(item.programDraft.formOptions.tabs.flatMap(x=>(x.sections??[]).flatMap(s=>s.fields)).includes('formato_amostra_id'));
const operations=c.readJson(c.path.join(c.meta,'api-source-additions.json')).operations;c.assert.equal(operations.length,6);for(const op of operations){c.assert.equal(op.bodyTemplate.resource,'proc_compra_amostras');c.assert.deepEqual(op.requestContextFields,['proc_compra_id','item_proc_compra_id']);}
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const name of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',name),'utf8'),scope,{filename:name});
for(const name of ['metadata-preview.json','item-metadata-preview.json']){const definition=c.readJson(c.path.join(c.state,name));new scope.CrudDefinitionValidator().validate(definition);}
const preview=c.readJson(c.path.join(c.state,'metadata-preview.json'));c.assert.equal(Object.keys(preview.dataModel.fields).length,8);c.assert.equal(preview.dataModel.fields.cod_rep.optionsSource.endpointId,'options.cod_rep');
c.save('metadata-js-validation.json',{success:true,fields:8,physicalFields:5,mandatoryOwners:2,integerEditors:true,itemTabs:6,formatWriterReused:true,nativeValidators:true,operations:6,businessWrites:false});
console.log('PASS native JSON validators:8fields,2owners,6operations,6item tabs,existing format field');
