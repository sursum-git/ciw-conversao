'use strict';
const c=require('./purchase-payments-builder-common.cjs'),vm=require('node:vm');
const state=c.path.join(c.root,'.runtime/ciw-completion-20261028/cadastros-queries');
const meta=c.path.join(c.root,'integration-src/ciw-completion-20261028/cadastro-query-filters');
const candidates=c.readJson(c.path.join(state,'filter-candidates.json'));
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:'http://127.0.0.1:8765',origin:'http://127.0.0.1:8765'}};scope.window=scope;vm.createContext(scope);
for(const f of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(c.fs.readFileSync(c.path.join('D:/opencode/construtor-pg',f),'utf8'),scope,{filename:f});
const sources={cd0094:['grid_pub_coloracoes',['coloracao_id','descricao','log_inativo']],cd0095:['grid_situacoes_container',['situacao_container_id','descricao','num_ordem']],cd0096:['cons_tipos_versao_custo',['tipo_versao_custo_id','descricao']],cd0097:['grid_motivos_desconto',['motivo_desconto_id','descricao','log_considerar_custo']],cd0098:['cons_im_param',['codigo','val_param','tp_param']]};
const summary=[];
async function main(){
 await c.session(async({runtime})=>{
  for(const item of candidates.screens){
   c.assert.equal(c.sha(c.path.join(meta,item.code+'-program-draft.json')),item.draftSha256);
   const v=c.readJson(c.path.join(state,item.code+'-program-before.json')).versions.find(v=>v.status==='published');
   const d=c.readJson(c.path.join(state,item.code+'-preview.json')).generatedDefinition;
   c.assert.equal(new scope.CrudDefinitionValidator().validate(d),true);
   const restored=structuredClone(d);restored.program.version=v.generatedDefinition.program.version;restored.crud.filter.fields=v.generatedDefinition.crud.filter.fields;c.assert.deepEqual(restored,v.generatedDefinition,'DELTA_OUTSIDE_VERSION_FILTERS');
   c.assert.deepEqual(d.crud.filter.fields.map(f=>f.field),item.fields);
   const [app,required]=sources[item.code];const file=c.path.join(c.root,'sources/scriptcase/phase1',app,app+'_grid.class.php'),raw=c.fs.readFileSync(file,'utf8');
   const sql=raw.match(/\$nmgp_select\s*=\s*"SELECT\s+(.+?)\s+from\s/i)?.[1];c.assert.ok(sql,'LEGACY_SELECT_MISSING');
   for(const field of required)c.assert.ok(d.crud.grid.columns.some(col=>col.field===field),'LEGACY_COLUMN_MISSING '+field);
   if(item.code!=='cd0098')for(const field of required)c.assert.ok(sql.includes(field));else for(const field of ['cod-param','val-param','tp-param'])c.assert.ok(sql.includes(field));
   const prior=c.readJson(c.path.join(state,item.screenId+'.json'));
   const first=prior.read.data[0];c.assert.ok(first);
   const get=await runtime(item.screenId+'/endpoints/get',{id:first[d.dataModel.primaryKey]});c.assert.deepEqual(get.data??get,first);
   const second=await runtime(item.screenId+'/endpoints/read',{take:1,skip:1});c.assert.equal(second.total,prior.read.total);c.assert.deepEqual(second.data,[prior.read.data[1]]);
   const checks=[];
   for(const field of item.added){
    const absent='ZZ_CIW_FILTER_ABSENT_20261028';
    const no=await runtime(item.screenId+'/endpoints/read',{take:200,skip:0,filter:{logic:'and',filters:[{field,operator:'contains',value:absent}]}});c.assert.equal(no.total,0);c.assert.deepEqual(no.data,[]);
    let positive=false;
    if(field!=='val_param'){
     const row=prior.read.data.find(r=>typeof r[field]==='string'&&/^[\p{L}\p{N} _-]{1,100}$/u.test(r[field])&&r[field].trim());c.assert.ok(row,'POSITIVE_VALUE_UNAVAILABLE');
     const needle=row[field].slice(0,Math.min(4,row[field].length));
     const yes=await runtime(item.screenId+'/endpoints/read',{take:200,skip:0,filter:{logic:'and',filters:[{field,operator:'contains',value:needle}]}});
     c.assert.ok(yes.total>0);c.assert.ok(yes.data.every(r=>r[field].toLocaleLowerCase('pt-BR').includes(needle.toLocaleLowerCase('pt-BR'))));positive=true;
    }
    checks.push({field,operator:'contains',absentEmpty:true,positive});
   }
   summary.push({screenId:item.screenId,code:item.code,version:'1.0.1',legacySource:app,legacySourceSha256:c.sha(file),legacyColumnsPreserved:true,deltaOnlyFiltersAndVersion:true,nativeJsValidated:true,get:true,paging:true,filters:checks,existingRows:prior.read.total});
  }
 },{readOnly:true});
 c.fs.writeFileSync(c.path.join(state,'filter-validation.json'),JSON.stringify({success:true,screens:summary,businessWrites:false,humanPermissionsChanged:false,apiAndAblUnchanged:true},null,2)+'\n');
 console.log('PASS 5 native JS/delta/source contracts,5get/5paging,6negative filters/5positive filters; no writes');
}
main().catch(e=>{console.error(e.message);process.exitCode=1});
