'use strict';
// Prepared locally; execution performs ONLY fixed-route read/get calls on same MED.
const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-completion-20261028/official-build7');
const resources={
 import_descontos_geral:{key:['desconto_importacao_id'],pk:'desconto_importacao_id'},
 import_descontos_lancamentos:{key:['desconto_importacao_id','cta_corren_desconto_id'],pk:'cta_corren_desconto_id',owner:'desconto_importacao_id'},
 custo_distribuicao_itens_aptos:{key:['item_container'],pk:'item_container'},
 custo_distribuicao_lancamentos_item:{key:['item_container_id','cta_corren_custo_distr_id'],pk:'cta_corren_custo_distr_id',owner:'item_container_id'}
};
function check(ok,code){if(!ok)throw Error(code);}
function rowShape(resource,row,ctx={}){
 const spec=resources[resource];check(row&&typeof row==='object'&&!Array.isArray(row),'ROW_REQUIRED');
 check(typeof row.record_key==='string','FULL_KEY_REQUIRED');let key;
 try{key=JSON.parse(row.record_key);}catch{throw Error('KEY_JSON_REQUIRED');}
 check(JSON.stringify(Object.keys(key).sort())===JSON.stringify([...spec.key].sort()),'KEY_FIELDS_MISMATCH');
 for(const field of spec.key)check(Number.isInteger(row[field])&&Number.isInteger(key[field])&&key[field]===row[field]&&row[field]>=-2147483648&&row[field]<=2147483647,'KEY_IDENTITY_MISMATCH');
 if(spec.owner)check(row[spec.owner]===ctx[spec.owner],'ROW_OWNER_MISMATCH');
 if(resource==='import_descontos_lancamentos')check(row.cod_usuario===null||typeof row.cod_usuario==='string'&&/^\d{4}-\d{2}-\d{2}$/.test(row.cod_usuario),'PHYSICAL_DATE_NOT_ACTOR');
}
function readShape(resource,response,ctx,take){
 check(response.success===true&&!response.error,'READ_REJECTED');check(Array.isArray(response.data)&&Number.isInteger(response.total)&&response.total>=0&&response.data.length<=take,'READ_SHAPE_INVALID');
 response.data.forEach(row=>rowShape(resource,row,ctx));
}
function closed(response,status){check(response.success===false&&response.error?.status===status&&!Object.hasOwn(response,'data'),'EXPECTED_CLOSED_'+status);}
function requestAllowed(resource,body){return Object.hasOwn(resources,resource)&&body&&['read','get'].includes(body.operation)&&!Object.hasOwn(body,'resource');}
async function run({call,save}){
 const results=[],observed={};
 async function inspect(resource,ctx,initial){
  const s=resources[resource],read=initial??await call(resource,{operation:'read',...ctx,take:200,skip:0});readShape(resource,read,ctx,200);save(resource+'-rows-private.json',read);
  const row=read.data[0],entry={resource,total:read.total,read:true,context:!!s.owner,get:false,paging:true,positiveFilter:false,negativeFilter:false,aliasMismatch:false,crossOwner:false,skipped:[]};
  const page=await call(resource,{operation:'read',...ctx,take:1,skip:1});readShape(resource,page,ctx,1);
  const beyond=await call(resource,{operation:'read',...ctx,take:200,skip:200});readShape(resource,beyond,ctx,200);entry.pageBeyond200=true;
  if(row){
   const detail=await call(resource,{operation:'get',...ctx,id:row.record_key,record_key:row.record_key});check(detail.success===true&&!detail.error,'GET_REJECTED');rowShape(resource,detail.data,ctx);assert.deepEqual(detail.data,row,'READ_GET_CHANGED');entry.get=true;
   const filter={field:s.pk,operator:'eq',value:row[s.pk]},positive=await call(resource,{operation:'read',...ctx,take:200,filter});readShape(resource,positive,ctx,200);check(positive.total===1&&positive.data.length===1,'PK_FILTER_NOT_UNIQUE');assert.deepEqual(positive.data[0],row,'PK_FILTER_CHANGED');entry.positiveFilter=true;
   const negative=await call(resource,{operation:'read',...ctx,take:200,filter:{logic:'and',filters:[filter,{...filter,operator:'neq'}]}});readShape(resource,negative,ctx,200);check(negative.total===0&&negative.data.length===0,'CONTRADICTORY_FILTER_NOT_EMPTY');entry.negativeFilter=true;
   closed(await call(resource,{operation:'get',...ctx,id:row.record_key,record_key:row.record_key+' '}),422);entry.aliasMismatch=true;
   const extra={...JSON.parse(row.record_key),unexpected:0};closed(await call(resource,{operation:'get',...ctx,id:JSON.stringify(extra)}),422);
  }else entry.skipped.push('GET/positive-filter/aliases: selected dataset empty');
  const negatives=[{operation:'read',...ctx,take:201},{operation:'read',...ctx,table:'not-allowed'},{operation:'read',...ctx,filter:{field:'not_allowed',operator:'eq',value:1}}];
  if(s.owner)negatives.push({operation:'read'},{operation:'read',[s.owner]:0},{operation:'read',[s.owner]:String(ctx[s.owner])});
  else negatives.push({operation:'read',empresa_id:5},{operation:'read',container_id:1});
  for(const body of negatives)closed(await call(resource,body),422);entry.requestNegatives=negatives.length;
  results.push(entry);observed[resource]={read,row,ctx,entry};return observed[resource];
 }
 const discounts=await inspect('import_descontos_geral',{}),eligible=await inspect('custo_distribuicao_itens_aptos',{});
 for(const [resource,parent,parentField] of [['import_descontos_lancamentos',discounts,'desconto_importacao_id'],['custo_distribuicao_lancamentos_item',eligible,'item_container']]){
  const spec=resources[resource],candidates=parent.read.data.filter(row=>Number.isInteger(row[parentField])&&row[parentField]>0).slice(0,20);
  if(!candidates.length){
   closed(await call(resource,{operation:'read'}),422);closed(await call(resource,{operation:'read',[spec.owner]:0}),422);
   results.push({resource,read:false,get:false,contextMissingRejected:true,skipped:['No positive parent ID observed by its own global API; no invented context']});continue;
  }
  let selected,first;
  for(const candidate of candidates){const ctx={[spec.owner]:candidate[parentField]},page=await call(resource,{operation:'read',...ctx,take:200,skip:0});readShape(resource,page,ctx,200);const current={ctx,page};first??=current;if(page.data.length){selected=current;break;}}
  selected??=first;const child=await inspect(resource,selected.ctx,selected.page),other=candidates.find(row=>row[parentField]!==selected.ctx[spec.owner]);
  if(child.row&&other){closed(await call(resource,{operation:'get',[spec.owner]:other[parentField],id:child.row.record_key,record_key:child.row.record_key}),404);child.entry.crossOwner=true;}
  else child.entry.skipped.push('Cross-owner GET: need a row and second observed positive parent ID');
 }
 return {success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same MED',results,allPositiveGetsProved:results.every(x=>x.get===true),businessWrites:false,grants:false,catalogWrites:false,boundedContextCandidates:20};
}
async function main(){
 const read=p=>JSON.parse(fs.readFileSync(p,'utf8')),active=read(path.join(state,'active-manifest.json'));
 check(active.success===true&&active.medWebRestored===true,'BUILD7_ACTIVE_MED_RESTORED_REQUIRED');
 const cfg=read(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'));
 check(cfg.baseUrl==='http://127.0.0.1:19910/med/web'&&typeof cfg.integrationToken==='string'&&cfg.integrationToken.length>0,'FIXED_PRIVATE_MED_CONFIG_REQUIRED');
 const attempts=[];let stage='start';
 const save=(name,value)=>fs.writeFileSync(path.join(state,name),JSON.stringify(value,null,2)+'\n');
 async function call(resource,body,auth=true){
  check(requestAllowed(resource,body),'READ_GET_FIXED_RESOURCE_ONLY');stage=resource+':'+body.operation;
  const headers={'Content-Type':'application/json','X-Sursum-User':'admin'};if(auth)headers['X-Ciw-Cadastros-Token']=cfg.integrationToken;
  const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers,body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});
  check(response.status===200,'ROUTE_HTTP_'+response.status);let data;try{data=await response.json();}catch{throw Error('ROUTE_JSON_REQUIRED');}
  attempts.push({stage,resource,operation:body.operation,success:data.success===true,errorCode:data.error?.code??null,errorStatus:data.error?.status??null});save('pasoe7-attempts.json',attempts);return data;
 }
 try{const receipt=await run({call,save});for(const resource of Object.keys(resources))closed(await call(resource,{operation:'read'},false),401);receipt.authDenied=4;save('pasoe-read-proof.json',receipt);console.log('PASS build7 fixed MED readonly checks; positive GETs '+receipt.results.filter(x=>x.get).length+'/4; see private proof for skips');}
 catch(error){save('pasoe7-failure.json',{success:false,stage,reason:error.code??'CHECK_FAILED',businessWrites:false});throw Error('BUILD7_PASOE_CHECK_FAILED_AT_'+stage);}
 finally{cfg.integrationToken=undefined;}
}
module.exports={resources,rowShape,readShape,requestAllowed,run};
if(require.main===module)main().catch(error=>{console.error(error.message);process.exitCode=1;});
