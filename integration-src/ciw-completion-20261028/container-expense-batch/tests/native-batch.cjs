'use strict';
const fs=require('fs'),path=require('path'),vm=require('vm'),assert=require('assert/strict');
const native=process.argv[2],state=process.argv[3],repo='D:/opencode/construtor-pg';
const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:'http://localhost/app.html',origin:'http://localhost'}};scope.window=scope;vm.createContext(scope);
for(const rel of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoGridRenderer.js'])vm.runInContext(fs.readFileSync(path.join(fs.existsSync(path.join(native,rel))?native:repo,rel),'utf8'),scope,{filename:rel});
let checks=0;scope.CrudUtils.showMessage=()=>{};
(async()=>{
 const d=new scope.PageDefinitionNormalizer().normalize(JSON.parse(fs.readFileSync(path.join(state,'native-preview.json'),'utf8')));new scope.CrudDefinitionValidator().validate(d);++checks;
 const names=d.grid.editing.snapshot.originalFields;assert.equal(names.length,14);++checks;
 const before=Object.fromEntries(names.map(n=>[n,n==='memoria_calculo'?'Preservado':n==='log_manual'?true:n==='log_utilizado'?false:0]));Object.assign(before,{despesa_container_id:11,despesa_id:2,container_id:100});
 async function saved(definition,original,row,context){
  definition.permissions={read:true,create:false,edit:true,delete:true};definition.api.batch={url:'/batch',method:'POST'};
  const sent=[],r=new scope.CrudKendoGridRenderer({definition,httpClient:{request:async req=>{sent.push(req);return{};}},contextValues:context});
  r.grid={wrapper:{attr(){}},closeCell(){},dataSource:{data:()=>[row],cancelChanges(){},read:async()=>{}}};r.notifyBatchChange=()=>{};
  r.batchOriginals.set(String(row.despesa_container_id),r.batchOriginalValues(original));await r.saveBatch();return sent;
 }
 const sent=await saved(d,before,{...before,uid:'row-1',vl_prev:44},{container_id:100});assert.equal(sent.length,1);++checks;
 const payload=JSON.parse(JSON.stringify(sent[0].data));assert.deepEqual(payload.context,{container_id:100});++checks;assert.deepEqual(Object.keys(payload.changes[0].original).sort(),Array.from(names).sort());++checks;
 assert.deepEqual(Object.keys(payload.changes[0].data).sort(),['log_manual','vl_base_imp','vl_prev']);++checks;assert.equal(payload.changes[0].original.memoria_calculo,'Preservado');++checks;
 const missing=await saved(d,before,{...before,uid:'row-1',vl_prev:44},{});assert.equal(missing.length,0);++checks;
 const bad=JSON.parse(JSON.stringify(d));bad.grid.editing.snapshot.originalFields.push('unknown');assert.throws(()=>new scope.CrudDefinitionValidator().validate(bad));++checks;
 // Existing batch without opt-in retains editable-only original and {changes}.
 const old=JSON.parse(JSON.stringify(d));delete old.grid.editing.snapshot;
 const legacy=await saved(old,before,{...before,uid:'row-1',vl_prev:44},{container_id:999});const oldPayload=JSON.parse(JSON.stringify(legacy[0].data));assert.deepEqual(Object.keys(oldPayload),['changes']);++checks;assert.deepEqual(Object.keys(oldPayload.changes[0].original).sort(),['log_manual','vl_base_imp','vl_prev']);++checks;
 // Format catalog has the same disabled capability path and no extra context.
 const format={...old,dataModel:{primaryKey:'formato_amostra_id',fields:{formato_amostra_id:{type:'integer',editable:false},descricao:{type:'string',editable:true},log_inativo:{type:'boolean',editable:true}}}};
 const r=new scope.CrudKendoGridRenderer({definition:format,httpClient:{},contextValues:{container_id:999}});assert.deepEqual(JSON.parse(JSON.stringify(r.batchOriginalValues({formato_amostra_id:1,descricao:'A',log_inativo:false}))),{descricao:'A',log_inativo:false});++checks;
 // A confirmed write with unavailable presentation must resolve and clear the
 // actual native draft. A second Save cannot submit the same business change.
 let submissions=0,cancels=0;const row={...before,uid:'confirmed-row',vl_prev:77};
 const confirmed=new scope.CrudKendoGridRenderer({definition:d,httpClient:{request:async()=>{++submissions;return{committed:true,presentationAvailable:false,data:[],total:0};}},contextValues:{container_id:100}});
 confirmed.grid={wrapper:{attr(){}},closeCell(){},dataSource:{data:()=>[row],cancelChanges(){++cancels;Object.assign(row,before);},read:async()=>{}}};confirmed.notifyBatchChange=()=>{};confirmed.batchOriginals.set('11',confirmed.batchOriginalValues(before));
 assert.equal(await confirmed.saveBatch(),true);++checks;assert.equal(cancels,1);++checks;assert.equal(await confirmed.saveBatch(),false);++checks;assert.equal(submissions,1);++checks;
 console.log('PASS native real saveBatch context/fulloriginal and disabled legacy checks='+checks);
})().catch(e=>{console.error(e.payload?JSON.stringify(e.payload):e);process.exitCode=1;});
