const c=require('./purchase-payments-builder-common.cjs');
const meta=c.path.join(c.root,'integration-src/purchase-items/metadata');
const d=c.readJson(c.path.join(meta,'proc-compra-itens-builder-draft.json'));
const f=Object.fromEntries(d.entityDraft.fields.map(x=>[x.code,x]));
c.assert.equal(d.programDraft.programCode,'op1014');c.assert.equal(d.entityDraft.fields.length,50);
c.assert.equal(d.programDraft.contextFields[0].field,'proc_compra_id');c.assert.equal(d.programDraft.contextFields[0].required,true);
for(const x of d.entityDraft.fields){if(x.dataType==='integer'){c.assert.equal(x.options.decimals,0);c.assert.equal(x.options.format,'n0');}}
for(const n of ['item_proc_compra_id','proc_compra_id','row_stamp','qt_alocada','qt_saldo','calc_gm'])c.assert.equal(f[n].readonlyField,true);
c.assert.equal(f.descricao.length,100);c.assert.equal(f.descricao.required,true);c.assert.equal(f.unid_medida.required,true);c.assert.equal(f.observacao.length,8000);c.assert.equal(f.vl_custo_dolar.scale,10);
for(const n of ['coloracao_id','formato_amostra_id','item_estacao'])c.assert.ok(f[n].options.api?.optionsSource?.operationCode);
const codes=d.programDraft.formOptions.tabs.flatMap(x=>(x.sections??[]).flatMap(s=>s.fields));c.assert.equal(new Set(codes).size,codes.length);
for(const x of d.entityDraft.fields.filter(x=>x.apiShowInForm))c.assert.ok(codes.includes(x.code),'Missing form field '+x.code);
c.assert.ok(!codes.includes('row_stamp'));
const parent=c.readJson(c.path.join(meta,'processos-compra-med-builder-draft.json'));
c.assert.equal(parent.programDraft.version,'1.0.2');const tabs=parent.programDraft.formOptions.tabs;c.assert.ok(tabs.some(x=>x.id==='pagamentos'));c.assert.equal(tabs.find(x=>x.id==='itens').linkedPage.screenId,'ciw.proc-compra-itens');c.assert.equal(tabs.find(x=>x.id==='itens').linkedPage.hideHeader,false);
const ops=c.readJson(c.path.join(meta,'api-source-additions.json')).operations;c.assert.equal(ops.length,8);
for(const op of ops){c.assert.equal(op.method,'POST');c.assert.equal(op.bodyTemplate.resource,'proc_compra_itens');c.assert.deepEqual(op.requestContextFields,['proc_compra_id']);}
const vm=require('node:vm'),scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:c.base,origin:c.base}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',file),'utf8'),scope,{filename:file});
const preview=c.readJson(c.path.join(c.root,'.runtime/purchase-items-20261022/metadata-preview.json'));new scope.CrudDefinitionValidator().validate(preview);
c.assert.equal(Object.keys(preview.dataModel.fields).length,50);c.assert.equal(preview.crud.form.tabs.length,5);
for(const name of ['coloracao_id','formato_amostra_id','item_estacao'])c.assert.equal(preview.dataModel.fields[name].optionsSource?.endpointId,'options.'+name);
const collected=scope.CrudKendoFormRenderer.prototype.collectValues.call({data:{item_proc_compra_id:1,proc_compra_id:2,row_stamp:'A'.repeat(64)},inputs:{},buildCustomCodeRuntimePayload:()=>({})});c.assert.equal(collected.row_stamp,'A'.repeat(64));c.assert.equal(collected.proc_compra_id,2);
c.fs.writeFileSync(c.path.join(c.root,'.runtime/purchase-items-20261022/metadata-js-validation.json'),JSON.stringify({success:true,fields:50,physicalFields:46,formTabs:5,operations:8,nativeValidator:true,hiddenStampCollected:true,mandatoryParent:true,businessWrites:false},null,2));
console.log('PASS: purchase item metadata50fields,closedcontext,integer editors,lookups and parent tabs.');
