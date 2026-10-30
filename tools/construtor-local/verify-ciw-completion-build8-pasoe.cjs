'use strict';
// Root executes after official publication. No process, writer, fixture or arbitrary route.
const fs=require('node:fs'),path=require('node:path');
const root=path.resolve(__dirname,'../..'),state=path.join(root,'.runtime/ciw-completion-20261028/official-build8');
const manual={item_custo_id:'id',dt_hr_custo:'datetime',vl_unit_novo:'number',dt_referencia:'date',caminho_arquivo:'string',cod_tipo_custo:'type1',memoria_calculo:'string',it_codigo:'string',qt_estoque:'number',qt_nf_mae:'number',qt_etiq_container:'number',qt_etiq_branco:'number',qt_etiq_outros_container:'number',vl_unit_anterior:'number',cod_situacao:'integer',cod_usuario:'string',qt_estoque_selecionado:'number',it_codigo_media:'string',qt_estoque_media:'number',vl_unit_media:'number',vl_unit_container:'number',qt_container:'number',media_custo_id:'integer',record_key:'key'};
const resources={item_custos_manual:{pk:'item_custo_id',fields:manual},item_container_amostra:{pk:'item_container_id',fields:{item_container_id:'integer',codigo_erp:'string',descricao:'string',container_id:'integer',record_key:'key'}}};
function check(ok,code){if(!ok)throw Error(code);}
const exact=(value,keys)=>value&&typeof value==='object'&&!Array.isArray(value)&&JSON.stringify(Object.keys(value).sort())===JSON.stringify([...keys].sort());
const integer=value=>Number.isInteger(value)&&value>=-2147483648&&value<=2147483647;
function date(value){if(typeof value!=='string'||!/^\d{4}-\d{2}-\d{2}$/.test(value))return false;const d=new Date(value+'T00:00:00Z');return Number.isFinite(d.getTime())&&d.toISOString().slice(0,10)===value;}
function scalar(value,type){switch(type){case'id':return integer(value)&&value>0;case'integer':return integer(value);case'number':return typeof value==='number'&&Number.isFinite(value);case'string':return typeof value==='string';case'key':return typeof value==='string'&&value.length>0&&value.length<=2048;case'type1':return value===1;case'date':return date(value);case'datetime':return typeof value==='string'&&/^\d{4}-\d{2}-\d{2}T(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d(?:\.\d{3})?$/.test(value)&&date(value.slice(0,10));default:return false;}}
function rowShape(resource,row){
 const spec=resources[resource];check(spec&&exact(row,Object.keys(spec.fields)),'ROW_FIELDS_INVALID');
 for(const[field,type]of Object.entries(spec.fields)){
  const nullable=resource==='item_custos_manual'&&!['item_custo_id','cod_tipo_custo','record_key'].includes(field)||resource==='item_container_amostra'&&['codigo_erp','descricao'].includes(field);
  check(row[field]===null?nullable:scalar(row[field],type),'ROW_SCALAR_INVALID');
 }
 let key;try{key=JSON.parse(row.record_key);}catch{throw Error('KEY_JSON_INVALID');}
 check(exact(key,[spec.pk])&&integer(key[spec.pk])&&key[spec.pk]===row[spec.pk],'KEY_IDENTITY_INVALID');
}
function readShape(resource,response,take){check(response?.success===true&&!response.error&&!Object.hasOwn(response,'audit')&&!Object.hasOwn(response,'committed'),'READ_REJECTED');check(Array.isArray(response.data)&&Number.isInteger(response.total)&&response.total>=0&&response.total<=50000&&response.data.length<=take&&response.data.length<=response.total,'READ_SHAPE_INVALID');response.data.forEach(row=>rowShape(resource,row));}
function closed(response,status){check(response?.success===false&&response.error?.status===status&&!Object.hasOwn(response,'data'),'EXPECTED_CLOSED_'+status);}
function requestAllowed(resource,body){return Object.hasOwn(resources,resource)&&body&&['read','get'].includes(body.operation)&&!Object.hasOwn(body,'resource');}
async function run({call,save}){
 const results=[];
 for(const[resource,spec]of Object.entries(resources)){
  const first=await call(resource,{operation:'read',take:200,skip:0});readShape(resource,first,200);save(resource+'-rows-private.json',first);
  if(resource==='item_container_amostra')for(let i=1;i<first.data.length;i++)check(first.data[i-1].container_id<first.data[i].container_id||first.data[i-1].container_id===first.data[i].container_id&&first.data[i-1].item_container_id<=first.data[i].item_container_id,'SAMPLE_DEFAULT_SORT_INVALID');
  const entry={resource,total:first.total,read:true,get:false,paging:true,filters:false,aliases:false,requestNegatives:0,skipped:[]},row=first.data[0];
  const second=await call(resource,{operation:'read',take:1,skip:1});readShape(resource,second,1);if(first.data.length>1)check(JSON.stringify(second.data[0])===JSON.stringify(first.data[1]),'PAGING_CHANGED');
  const beyond=await call(resource,{operation:'read',take:200,skip:200});readShape(resource,beyond,200);
  const sort=await call(resource,{operation:'read',take:2,sort:[{field:spec.pk,dir:'desc'}]});readShape(resource,sort,2);if(sort.data.length>1)check(sort.data[0][spec.pk]>=sort.data[1][spec.pk],'EXPLICIT_SORT_INVALID');
  if(row){
   const detail=await call(resource,{operation:'get',id:row.record_key,record_key:row.record_key});check(detail?.success===true&&!detail.error,'GET_REJECTED');rowShape(resource,detail.data);check(JSON.stringify(detail.data)===JSON.stringify(row),'GET_ROW_CHANGED');entry.get=true;
   const filter={field:spec.pk,operator:'eq',value:row[spec.pk]},positive=await call(resource,{operation:'read',take:200,filter});readShape(resource,positive,200);check(positive.total===1&&positive.data.length===1&&JSON.stringify(positive.data[0])===JSON.stringify(row),'PK_FILTER_INVALID');
   const negative=await call(resource,{operation:'read',take:200,filter:{logic:'and',filters:[filter,{...filter,operator:'neq'}]}});readShape(resource,negative,200);check(negative.total===0&&negative.data.length===0,'CONTRADICTORY_FILTER_INVALID');entry.filters=true;
   closed(await call(resource,{operation:'get',id:row.record_key,record_key:row.record_key+' '}),422);
   for(const key of [{...JSON.parse(row.record_key),unexpected:0},{},{[spec.pk]:String(row[spec.pk])}])closed(await call(resource,{operation:'get',id:JSON.stringify(key)}),422);entry.aliases=true;
  }else entry.skipped.push('GET/positive-filter/aliases skipped: observed global dataset empty');
  const negatives=[{operation:'read',take:201},{operation:'read',take:'1'},{operation:'read',skip:-1},{operation:'read',table:'not_allowed'},{operation:'read',container_id:1},{operation:'read',empresa_id:5},{operation:'read',context:{container_id:1}},{operation:'read',filter:{field:'not_allowed',operator:'eq',value:1}},{operation:'read',sort:[{field:'not_allowed',dir:'asc'}]},{operation:'get',id:'{}'}];
  for(const body of negatives){closed(await call(resource,body),422);entry.requestNegatives++;}results.push(entry);
 }
 return{success:true,instance:'sursum-api',context:'med',officialPort:9911,tunnel:'19910 -> 9910 same MED',results,allPositiveGetsProved:results.every(x=>x.get),businessWrites:false,processRuns:false,fixtures:false,grants:false,catalogWrites:false};
}
async function main(){
 const read=p=>JSON.parse(fs.readFileSync(p,'utf8')),active=read(path.join(state,'active-manifest.json'));check(active.success===true&&active.medWebRestored===true,'BUILD8_ACTIVE_MED_RESTORED_REQUIRED');
 const cfg=read(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'));check(cfg.baseUrl==='http://127.0.0.1:19910/med/web'&&typeof cfg.integrationToken==='string'&&cfg.integrationToken.length>0,'FIXED_PRIVATE_MED_CONFIG_REQUIRED');
 const attempts=[];let stage='start';const save=(name,value)=>fs.writeFileSync(path.join(state,name),JSON.stringify(value,null,2)+'\n');
 async function call(resource,body,auth=true){
  check(requestAllowed(resource,body),'READ_GET_FIXED_RESOURCE_ONLY');stage=resource+':'+body.operation;
  const headers={'Content-Type':'application/json','X-Sursum-User':'admin'};if(auth)headers['X-Ciw-Cadastros-Token']=cfg.integrationToken;
  const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers,body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(45000)});check(response.status===200,'ROUTE_HTTP_INVALID');let data;try{data=await response.json();}catch{throw Error('ROUTE_JSON_INVALID');}
  attempts.push({stage,resource,operation:body.operation,success:data.success===true,errorCode:data.error?.code??null,errorStatus:data.error?.status??null});save('pasoe8-attempts.json',attempts);return data;
 }
 try{const receipt=await run({call,save});for(const resource of Object.keys(resources))closed(await call(resource,{operation:'read'},false),401);receipt.authDenied=2;save('pasoe-read-proof.json',receipt);console.log('PASS build8 fixed MED readonly; positive GETs '+receipt.results.filter(x=>x.get).length+'/2; see private proof for skips');}
 catch(error){const reason=/^[A-Z0-9_]+$/.test(error.message??'')?error.message:'CHECK_FAILED';save('pasoe8-failure.json',{success:false,stage,reason,businessWrites:false,processRuns:false});throw Error('BUILD8_PASOE_CHECK_FAILED_AT_'+stage+'_'+reason);}
 finally{cfg.integrationToken=undefined;}
}
module.exports={resources,rowShape,readShape,requestAllowed,run};
if(require.main===module)main().catch(error=>{console.error(error.message);process.exitCode=1;});
