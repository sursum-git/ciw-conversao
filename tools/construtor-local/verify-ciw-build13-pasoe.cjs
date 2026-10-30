'use strict';
// ROOT ONLY. Fixed read/get route; no financial projection, writer or activation.
const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto'),assert=require('node:assert/strict');
const root=path.resolve(__dirname,'../..'),r=path.join(root,'.runtime/ciw-completion-20261028');
const build=path.join(r,'official-build13-v3'),state=path.join(r,'runtime-build13-v4'),proofDir=path.join(r,'build13-root-companions-v3');
const RELEASE='7694b83727c554f9503cbafff4294f33c6da2f02bf2770dc4cc217d219cab9e9',MANAGER='ae932cc8b6b95435bed8b580ddcd6191d49d8ab3ce349bc53c44d6f3a408de92';
const resources=['container_custos_comparacao_real','container_custos_comparacao_dolar'],HISTORY='container_versoes_historico_med',OLD='proc_compra_quantidades_periodo_med';
const IDS=['container_id','versao_id','item_container_custo_id','item_container_id'],KEYS=IDS.slice(0,3),NUMBERS=['qt_alocada','qt_confirm_emb','vl_custo_prev','vl_desp_prev','vl_tot_prev','vl_unit_prev','vl_desp_prev_sem_distr_custo','vl_tot_sem_distr_custo','vl_unit_sem_distr_custo','vl_desp_prev_perc_fixo','vl_tot_perc_fixo','vl_unit_perc_fixo'];
const FIELDS=[...IDS,'codigo_erp','descricao',...NUMBERS,'record_key'];
function check(ok,code){if(!ok){const e=new Error(code);e.code=code;throw e;}}
const exact=(value,fields)=>value&&typeof value==='object'&&!Array.isArray(value)&&Object.keys(value).length===fields.length&&Object.keys(value).every(k=>fields.includes(k));
const positive=x=>Number.isInteger(x)&&x>=1&&x<=2147483647;
function same(a,b,code){try{assert.deepStrictEqual(a,b);}catch{check(false,code);}}
function key(raw){check(typeof raw==='string'&&raw.length>0&&Buffer.byteLength(raw)<=2048,'OPAQUE_KEY_REQUIRED');let value;try{value=JSON.parse(raw);}catch{check(false,'KEY_JSON_REQUIRED');}check(exact(value,KEYS)&&KEYS.every(k=>positive(value[k])),'KEY_IDENTITY_INVALID');return value;}
function row(value,ctx){check(exact(value,FIELDS),'ROW_FIELDS_INVALID');check(IDS.every(k=>positive(value[k])),'ROW_IDS_INVALID');for(const k of ['codigo_erp','descricao'])check(value[k]===null||typeof value[k]==='string','ROW_LABEL_INVALID');for(const k of NUMBERS)check(value[k]===null||typeof value[k]==='number'&&Number.isFinite(value[k]),'ROW_NUMBER_INVALID');const id=key(value.record_key);check(KEYS.every(k=>id[k]===value[k]),'ROW_KEY_MISMATCH');check(value.container_id===ctx.container_id&&value.versao_id===ctx.versao_id,'ROW_OWNER_MISMATCH');}
function page(value,ctx,take,skip=0){check(exact(value,['success','data','total'])&&value.success===true&&Number.isInteger(value.total)&&value.total>=0&&value.total<=50000&&Array.isArray(value.data),'READ_SHAPE_INVALID');check(value.data.length===Math.min(take,Math.max(0,value.total-skip)),'PAGE_LENGTH_INVALID');value.data.forEach(v=>row(v,ctx));check(new Set(value.data.map(v=>v.record_key)).size===value.data.length,'PAGE_KEYS_DUPLICATED');}
function rejected(value,status,code){check(value?.success===false&&value.error?.status===status&&!Object.hasOwn(value,'data'),'EXPECTED_REJECTION_'+status);if(code)check(value.error.code===code,'EXPECTED_ERROR_CODE');}
function requestAllowed(resource,body){return [...resources,HISTORY,OLD].includes(resource)&&body&&typeof body==='object'&&!Array.isArray(body)&&['read','get'].includes(body.operation)&&!Object.hasOwn(body,'resource');}
const sha=file=>crypto.createHash('sha256').update(fs.readFileSync(file)).digest('hex'),read=file=>JSON.parse(fs.readFileSync(file,'utf8'));
function gates({active,official,releaseSha,managerSha,officialSha,targets,operations,drafts}){
 check(releaseSha===RELEASE&&managerSha===MANAGER,'FROZEN_RELEASE_PINS_REQUIRED');
 check(official.success===true&&official.version==='12.2'&&official.releaseSha256===RELEASE&&official.managerReleaseSha256===MANAGER&&official.compileCount===69&&official.totalChecks===8020&&official.testLogs===88&&official.downloadCount===269&&official.numDbsCompile===1&&official.numDbsTests===0,'OFFICIAL_69_88_8020_REQUIRED');
 check(active.success===true&&active.instance==='sursum-api'&&active.context==='med'&&active.medWebRestored===true&&active.imaWebUnchanged===true&&active.businessWrites===false&&active.releaseSha256===RELEASE&&active.officialProofSha256===officialSha,'ACTIVE13_MED_REQUIRED');
 check(exact(active.targets,targets)&&official.files.length===17&&new Set(official.files.map(x=>x.relative)).size===17,'ACTIVE17_TARGETS_REQUIRED');
 for(const x of official.files)check(targets.includes(x.relative)&&active.targets[x.relative].sha256===x.sha256,'ACTIVE_OFFICIAL_HASH_MISMATCH');
 check(operations.length===4&&drafts.length===2,'REAL_METADATA_REQUIRED');
 for(const [n,resource]of resources.entries()){
  const d=drafts[n];check(d.entityDraft.code===resource+'_progress'&&d.programDraft.programCode==='op'+(1040+n),'DRAFT_IDENTITY_INVALID');
  same(d.entityDraft.fields.map(x=>x.code).sort(),[...FIELDS].sort(),'DRAFT_FIELDS_CHANGED');
  for(const operation of ['read','get']){const x=operations.find(v=>v.code===resource+'_'+operation);check(x&&x.method==='POST'&&x.path==='/SursumPrograms/ciw-cadastros'&&x.type===(operation==='get'?'detail':'list'),'OPERATION_CONTRACT_INVALID');same(x.bodyTemplate,{resource,operation},'OPERATION_BODY_CHANGED');same(x.requestContextFields,['container_id','versao_id'],'OPERATION_CONTEXT_CHANGED');}
 }
}
async function run({call,nativeVersions,save}){
 //332526 is an observed parent seed only. Versions/row IDs always come from reads.
 const cid=332526,versions=await nativeVersions(cid);check(Array.isArray(versions.data),'NATIVE_VERSIONS_REQUIRED');save('native-versions-private.json',versions);
 const vids=[...new Set(versions.data.filter(x=>positive(x.versao_id)&&x.container_id===cid).map(x=>x.versao_id))].slice(0,10);
 check(vids.length>0,'NO_OBSERVED_NATIVE_VERSION');const attempts=[],results=[];let chosen;
 for(const vid of vids){
  const ctx={container_id:cid,versao_id:vid},history=await call(HISTORY,{operation:'read',...ctx,take:2,skip:0});check(history.success===true&&Array.isArray(history.data),'OLD_HISTORY_READ_FAILED');
  const pages=[];let usable=true;
  for(const resource of resources){const value=await call(resource,{operation:'read',...ctx,take:2,skip:0});if(value.success===false&&value.error?.status===422&&value.error?.code==='COMPARISON_ZERO_DIVISOR'){attempts.push({resource,domainRejection:'COMPARISON_ZERO_DIVISOR'});usable=false;continue;}page(value,ctx,2);pages.push({resource,value});if(value.total===0)usable=false;}
  if(usable&&pages.length===2){chosen={ctx,pages,history};break;}
 }
 check(chosen,'NO_POSITIVE_COMPARISON_DATA_OBSERVED');const {ctx,pages,history}=chosen;
 check(history.data.length>0,'NO_OBSERVED_HISTORY_ITEM');
 const hist=history.data[0];check(hist.container_id===ctx.container_id&&hist.versao_id===ctx.versao_id&&typeof hist.record_key==='string','OLD_HISTORY_OWNER_INVALID');
 const historyGet=await call(HISTORY,{operation:'get',...ctx,id:hist.record_key,record_key:hist.record_key});check(historyGet.success===true,'OLD_HISTORY_GET_FAILED');same(historyGet.data,hist,'OLD_HISTORY_GET_CHANGED');
 //CID1 is the previously observed missing-parent negative, never a positive ID.
 rejected(await call(HISTORY,{operation:'read',container_id:1,versao_id:ctx.versao_id,take:1}),404,'VERSION_HISTORY_PARENT');
 rejected(await call(HISTORY,{operation:'read',...ctx,read_require_master:false}),422);
 const old=await call(OLD,{operation:'read',take:1,skip:0});check(old.success===true&&Array.isArray(old.data),'OLD_RESOURCE_REGRESSION_FAILED');
 for(const {resource,value:first}of pages){
  save(resource+'-rows-private.json',first);const selected=first.data[0];row(selected,ctx);let filters=0;
  const detail=await call(resource,{operation:'get',...ctx,id:selected.record_key,record_key:selected.record_key});check(detail.success===true,'GET_FAILED');row(detail.data,ctx);check(detail.data.record_key===selected.record_key,'OPAQUE_KEY_CHANGED');same(detail.data,selected,'READ_GET_CHANGED');
  for(const [take,skip]of [[2,2],[2,Math.max(0,first.total-2)],[2,first.total]]){const next=await call(resource,{operation:'read',...ctx,take,skip});page(next,ctx,take,skip);check(next.total===first.total,'TOTAL_CHANGED');if(skip===2)check(!next.data.some(v=>first.data.some(w=>w.record_key===v.record_key)),'PAGE_OVERLAP');}
  for(const dir of ['asc','desc']){const sorted=await call(resource,{operation:'read',...ctx,take:2,sort:[{field:'item_container_custo_id',dir}]});page(sorted,ctx,2);check(sorted.total===first.total,'SORT_TOTAL_CHANGED');for(let n=1;n<sorted.data.length;n++)check(dir==='asc'?sorted.data[n-1].item_container_custo_id<sorted.data[n].item_container_custo_id:sorted.data[n-1].item_container_custo_id>sorted.data[n].item_container_custo_id,'SORT_ORDER_INVALID');}
  const eq={field:'item_container_custo_id',operator:'eq',value:selected.item_container_custo_id};
  const only=await call(resource,{operation:'read',...ctx,take:2,filter:eq});page(only,ctx,2);check(only.total===1,'IDENTITY_FILTER_NOT_UNIQUE');same(only.data[0],selected,'IDENTITY_FILTER_CHANGED');filters++;
  const empty=await call(resource,{operation:'read',...ctx,take:2,filter:{logic:'and',filters:[eq,{...eq,operator:'neq'}]}});page(empty,ctx,2);check(empty.total===0,'CONTRADICTORY_FILTER_NOT_EMPTY');filters++;
  for(const field of NUMBERS){const filtered=await call(resource,{operation:'read',...ctx,take:200,filter:{field,operator:'eq',value:selected[field]}});page(filtered,ctx,200);check(filtered.data.some(v=>v.record_key===selected.record_key),'OBSERVED_NUMBER_FILTER_MISSED_SELECTED');check(filtered.data.every(v=>v[field]===selected[field]),'OBSERVED_NUMBER_FILTER_CHANGED');filters++;}
  for(const field of ['codigo_erp','descricao']){const filtered=await call(resource,{operation:'read',...ctx,take:200,filter:{logic:'and',filters:[eq,{field,operator:'eq',value:selected[field]}]}});page(filtered,ctx,200);check(filtered.total===1,'LABEL_FILTER_MISSED_SELECTED');filters++;}
  rejected(await call(resource,{operation:'get',...ctx,id:selected.record_key,record_key:selected.record_key+' '}),422);
  for(const malformed of ['{}',JSON.stringify({...key(selected.record_key),extra:1}),JSON.stringify({...key(selected.record_key),item_container_custo_id:String(selected.item_container_custo_id)})])rejected(await call(resource,{operation:'get',...ctx,id:malformed}),422);
  rejected(await call(resource,{operation:'get',...ctx,container_id:1,id:selected.record_key,record_key:selected.record_key}),404);
  const other=vids.find(x=>x!==ctx.versao_id);if(other)rejected(await call(resource,{operation:'get',...ctx,versao_id:other,id:selected.record_key,record_key:selected.record_key}),404);
  const negatives=[{operation:'read'},{operation:'read',container_id:ctx.container_id},{operation:'read',...ctx,container_id:0},{operation:'read',...ctx,versao_id:String(ctx.versao_id)},{operation:'read',...ctx,take:201},{operation:'read',...ctx,skip:-1},{operation:'read',...ctx,table:'not_allowed'},{operation:'read',...ctx,read_require_master:false},{operation:'read',...ctx,context:{...ctx}},{operation:'read',...ctx,filter:{field:'not_allowed',operator:'eq',value:1}},{operation:'read',...ctx,sort:[{field:'item_container_custo_id ',dir:'asc'}]}];
  for(const body of negatives)rejected(await call(resource,body),422);
  rejected(await call(resource,{operation:'read',...ctx,take:1},false),401);
  results.push({resource,readGet:true,fields:19,keySetUnordered:true,opaqueIdentity:true,paging:true,sortBothDirections:true,observedValueFilters:filters,crossContainerRejected:true,crossObservedVersionRejected:!!other,privatePolicyRejected:true,requestNegatives:negatives.length,authDenied:true,total:first.total});
 }
 check(results.length===2&&results.every(x=>x.readGet&&x.crossContainerRejected&&x.privatePolicyRejected&&x.authDenied),'ALL_RESOURCE_GATES_REQUIRED');
 return{success:true,instance:'sursum-api',context:'med',officialPort:9911,results,observedVersionCandidates:vids.length,domainRejectedCandidates:attempts,oldHistoryReadGet:true,oldHistoryMissing404:true,oldHistoryPolicyRejected:true,oldResourceRead:true,financialFormulasDuplicated:false,financialExpectedValuesInvented:false,businessWrites:false,processRuns:false,catalogWrites:false,grants:false};
}
async function main(){
 const output=path.join(state,'pasoe-read-proof.json'),attempt=path.join(state,'pasoe13-attempt.json');check(!fs.existsSync(output)&&!fs.existsSync(attempt),'PRIOR_ATTEMPT_NO_REPLAY');
 const official=read(path.join(proofDir,'official-compile-verification.json')),active=read(path.join(state,'active-manifest.json'));
 gates({active,official,releaseSha:sha(path.join(build,'release.json')),managerSha:sha(path.join(build,'manager-release.json')),officialSha:sha(path.join(proofDir,'official-compile-verification.json')),targets:read(path.join(build,'runtime-targets.json')).targets.map(x=>x.relative),operations:read(path.join(build,'metadata/api-source-additions.json')).operations,drafts:resources.map(x=>read(path.join(build,'metadata',x+'-builder-draft.json')))});
 const cfg=read(path.join(root,'.runtime/ciw-cadastros-20261020/private/connection.json'));check(cfg.baseUrl==='http://127.0.0.1:19910/med/web'&&typeof cfg.integrationToken==='string'&&cfg.integrationToken.length>0,'FIXED_MED_CONFIG_REQUIRED');
 const raw=path.join(state,'pasoe13-private');fs.mkdirSync(raw,{recursive:true});let stage='STARTED',count=0;const startedAtUtc=new Date().toISOString(),attempts=[];
 const save=(name,value)=>{check(/^[a-z0-9_-]+[.]json$/i.test(name),'CLOSED_OUTPUT_NAME_REQUIRED');const text=JSON.stringify(value,null,2)+'\n';check(!text.includes(cfg.integrationToken),'CREDENTIAL_OUTPUT_REFUSED');fs.writeFileSync(path.join(raw,name),text,{flag:'wx'});};
 fs.writeFileSync(attempt,JSON.stringify({state:'STARTED',startedAtUtc,validatorSha256:sha(__filename),businessWrites:false},null,2)+'\n',{flag:'wx'});
 try{
  const c=require('./purchase-payments-builder-common.cjs');
  async function call(resource,body,auth=true){check(requestAllowed(resource,body)&&count<160,'FIXED_READ_GET_BOUND_REQUIRED');stage=resource+':'+body.operation;count++;
   const headers={'Content-Type':'application/json','X-Sursum-User':'admin'};if(auth)headers['X-Ciw-Cadastros-Token']=cfg.integrationToken;
   const response=await fetch(cfg.baseUrl+'/SursumPrograms/ciw-cadastros',{method:'POST',headers,body:JSON.stringify({resource,...body}),signal:AbortSignal.timeout(30000)});check(response.status===200,'FIXED_ROUTE_HTTP_STATUS');const value=await response.json();save('response-'+String(count).padStart(3,'0')+'-private.json',{resource,request:body,response:value});attempts.push({resource,operation:body.operation,success:value.success===true,status:value.error?.status??null,code:value.error?.code??null});return value;}
  const receipt=await c.session(async({runtime})=>run({call,save,nativeVersions:cid=>runtime('ciw.container-versoes-custo/endpoints/read',{take:200,skip:0,context:{container_id:cid}})}));
  receipt.activeManifestSha256=sha(path.join(state,'active-manifest.json'));receipt.officialProofSha256=sha(path.join(proofDir,'official-compile-verification.json'));receipt.validatorSha256=sha(__filename);receipt.checks=count;receipt.startedAtUtc=startedAtUtc;receipt.completedAtUtc=new Date().toISOString();
  save('attempts-private.json',attempts);fs.writeFileSync(output,JSON.stringify(receipt,null,2)+'\n',{flag:'wx'});fs.writeFileSync(attempt,JSON.stringify({state:'COMPLETED',startedAtUtc,completedAtUtc:receipt.completedAtUtc,checks:count,proofSha256:sha(output),businessWrites:false},null,2)+'\n');console.log('PASS readonly13 comparisons2/read-get/context/filters/paging/aliases/auth; checks='+count);
 }catch(error){fs.writeFileSync(path.join(state,'pasoe13-failure.json'),JSON.stringify({success:false,stage,checks:count,reason:error.code??'CHECK_FAILED',startedAtUtc,completedAtUtc:new Date().toISOString(),businessWrites:false},null,2)+'\n',{flag:'wx'});throw Error('BUILD13_READONLY_VALIDATION_FAILED');}
 finally{cfg.integrationToken=undefined;}
}
module.exports={resources,HISTORY,OLD,KEYS,IDS,NUMBERS,FIELDS,key,row,page,rejected,requestAllowed,gates,run,main};
if(require.main===module)main().catch(()=>{console.error('BUILD13_READONLY_FAILED; inspect private journal; no replay or business writes');process.exitCode=1;});
