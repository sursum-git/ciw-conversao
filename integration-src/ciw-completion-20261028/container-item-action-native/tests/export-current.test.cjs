'use strict';
const test=require('node:test'),assert=require('node:assert/strict'),path=require('node:path'),{spawnSync}=require('node:child_process');
const tool=path.resolve(__dirname,'../../../..','tools/construtor-local/export-ciw-container-item-action-current.cjs');
const {safe,published,collect}=require(tool);
function fixture(){
 const docs={'/bootstrap':{programs:[{code:'cd0114',screenId:'ciw.proc-compra-itens'}]}};
 for(const[code,screen,entity,source]of[['op1008','ciw.container-custos-itens','container_custo_itens_progress','motor_progress_container_custos'],['op1002','ciw.container-itens','container_itens_progress','motor_progress_container_painel'],['cd0114','ciw.proc-compra-itens','proc_compra_itens_progress','motor_progress_ciw_cadastros']]){
  docs['/programs/'+code]={program:{code,screenId:screen},versions:[{status:'published',screenId:screen,builderEntityCode:entity,version:'1.0.1'}]};
  docs['/entities/'+entity]={entity:{code:entity,apiSourceCode:source}};
  docs['/api-sources/'+source]={apiSource:{code:source,authHeaders:{'X-Containers-Token':'PRIVATE_SENTINEL'},operations:[{headers:{Authorization:'PRIVATE_SENTINEL'},bodyTemplate:{token:'PRIVATE_SENTINEL'}}]}};
 }
 return docs;
}
test('all metadata GETs are fixed/derived; source auth never appears in output',async()=>{
 const docs=fixture(),before=JSON.stringify(docs),calls=[];
 const result=await collect(async p=>{calls.push(p);assert.ok(Object.hasOwn(docs,p));return docs[p];});
 assert.equal(result.metadataGets,10);assert.equal(calls.length,10);assert.equal(result.documents.length,9);assert.equal(result.bindings.length,3);assert.equal(result.sourceCodes[0],'motor_progress_container_custos');assert.ok(!JSON.stringify(result).includes('PRIVATE_SENTINEL'));assert.equal(JSON.stringify(docs),before);
});
test('recursive headers/token/URL credential and query sanitization',()=>{
 const value={authHeaders:{Authorization:'PRIVATE_SENTINEL'},nested:[{headers:{'X-Custom-Secret':'PRIVATE_SENTINEL'},password:'PRIVATE_SENTINEL',refreshToken:'PRIVATE_SENTINEL',url:'https://user:PRIVATE_SENTINEL@example.test/path?token=PRIVATE_SENTINEL'}]};
 const result=safe(value);assert.ok(!Object.hasOwn(result,'authHeaders'));assert.ok(!Object.hasOwn(result.nested[0],'headers'));assert.ok(!JSON.stringify(result).includes('PRIVATE_SENTINEL'));assert.equal(value.nested[0].password,'PRIVATE_SENTINEL');
});
test('target screen must resolve uniquely before programs/sources',async()=>{const docs=fixture();docs['/bootstrap'].programs.push(docs['/bootstrap'].programs[0]);await assert.rejects(collect(async p=>docs[p]),/UNIQUE_PURCHASE/);});
test('no published version or ambiguous published versions refuse',()=>{for(const versions of[[],[{status:'published'},{status:'published'}]])assert.throws(()=>published({program:{screenId:'s'},versions},'s'),/EXACTLY_ONE/);});
test('wrong program/entity/source binding fails closed',async()=>{
 for(const mutate of[d=>d['/programs/op1008'].program.code='op9999',d=>d['/entities/container_custo_itens_progress'].entity.code='other',d=>d['/api-sources/motor_progress_container_custos'].apiSource.code='other']){const docs=fixture();mutate(docs);await assert.rejects(collect(async p=>docs[p]),/MISMATCH/);}
});
test('source IDs are derived once, shared source is fetched once',async()=>{const docs=fixture();docs['/entities/container_itens_progress'].entity.apiSourceCode='motor_progress_container_custos';const calls=[];const result=await collect(async p=>{calls.push(p);return docs[p];});assert.equal(result.metadataGets,9);assert.equal(calls.filter(p=>p==='/api-sources/motor_progress_container_custos').length,1);});
test('unsafe derived program/entity/source code refuses before URL fetch',async()=>{for(const mutate of[d=>d['/bootstrap'].programs[0].code='../escape',d=>d['/programs/op1008'].versions[0].builderEntityCode='../escape',d=>d['/entities/container_custo_itens_progress'].entity.apiSourceCode='../escape']){const docs=fixture();mutate(docs);await assert.rejects(collect(async p=>{assert.ok(!p.includes('..'));return docs[p];}));}});
test('no execution flag refuses before authentication/file export',()=>{const child=spawnSync(process.execPath,[tool],{encoding:'utf8'});assert.equal(child.status,1);assert.match(child.stderr,/READONLY_METADATA_EXPORT_FAILED/);assert.equal(child.stdout,'');});
