'use strict';
const fs=require('fs'),path=require('path'),vm=require('vm'),assert=require('assert/strict');
const repo='D:/opencode/construtor-pg',state=process.argv[2];
const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:'http://127.0.0.1:8090/production/app.html',origin:'http://127.0.0.1:8090'}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js','src/crud-engine/CrudKendoGridRenderer.js','src/crud-engine/CrudEngine.js'])vm.runInContext(fs.readFileSync(path.join(repo,file),'utf8'),scope,{filename:file});
let checks=0;
const definitions={};
for(const code of ['op1033','op1034']){
 const d=new scope.PageDefinitionNormalizer().normalize(JSON.parse(fs.readFileSync(path.join(state,code+'-preview.json'),'utf8')));
 definitions[d.screenId]=d;
 new scope.CrudDefinitionValidator().validate(d);++checks;
 assert.equal(d.permissions.read,(code==='op1033'?'container_calculos_impostos_med_progress':'container_despesa_memoria_med_progress')+'.read');
 for(const op of ['create','edit','delete'])assert.equal(d.permissions[op],false);++checks;
 assert.equal(d.contextFields[0].field,'container_id');assert.equal(d.contextFields[0].required,true);++checks;
 const pk=d.dataModel.primaryKey,engine=Object.create(scope.CrudEngine.prototype);
 engine.definition=d;engine.options={contextValues:{container_id:'100',[pk]:'11'}};engine.initializeNavigationContext();
 assert.equal(engine.contextValues[pk],11,'selected legacy identity must reach native context');++checks;
 const filters=engine.withContextFilters([]);assert.ok(filters.some(x=>x.field===pk&&x.value===11));++checks;
 engine.options={contextValues:{container_id:'100'}};assert.throws(()=>engine.initializeNavigationContext());++checks;
 for(const field of Object.values(d.dataModel.fields)){assert.equal(field.readonly,true);++checks;}
 if(code==='op1034'){
  const renderer=Object.create(scope.CrudKendoGridRenderer.prototype),link=d.grid.rowLinks[0];
  assert.equal(renderer.buildRowLinkHtml(link,{container_id:100,link_calculo_id:null}),'');++checks;
  const html=renderer.buildRowLinkHtml(link,{container_id:100,link_calculo_id:11});
  assert.ok(html.includes('context__container_id=100')&&html.includes('context__calc_imp_container_id=11'));++checks;
 }
}
const parentPatch=JSON.parse(fs.readFileSync(path.join(__dirname,'../patches/parent-navigation.json'),'utf8'));
const sourceLinks=[parentPatch.patches[0].operations[0].value,definitions['ciw.container-despesa-memoria-med'].grid.rowLinks[0]];
for(const link of sourceLinks){
 const renderer=Object.create(scope.CrudKendoGridRenderer.prototype);
 const html=renderer.buildRowLinkHtml(link,{container_id:100,despesa_container_id:21,link_calculo_id:11});
 const target=new URL(html.match(/href="([^"]+)"/)[1].replaceAll('&amp;','&'),'http://localhost/');
 const engine=Object.create(scope.CrudEngine.prototype);engine.definition=definitions[target.searchParams.get('screenId')];
 engine.options={contextValues:Object.fromEntries([...target.searchParams].filter(([k])=>k.startsWith('context__')).map(([k,v])=>[k.slice(9),v]))};
 engine.initializeNavigationContext();const pk=engine.definition.dataModel.primaryKey;
 assert.equal(engine.contextValues[pk],pk==='despesa_container_id'?21:11);++checks;
 assert.ok(engine.withContextFilters([]).some(f=>f.field===pk&&f.value===engine.contextValues[pk]));++checks;
}
console.log('PASS native JS metadata and NULL link checks='+checks);
