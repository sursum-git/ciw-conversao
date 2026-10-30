const fs=require('fs'),vm=require('vm'),path=require('path'),assert=require('assert');const root=path.join(__dirname,'..'),src='D:/opencode/construtor-pg/src/crud-engine/';const w={};const ctx={window:w,jQuery(){},console,URL,URLSearchParams,Set,Map};vm.createContext(ctx);
for(const f of ['CrudUtils.js','PageDefinitionNormalizer.js','CrudDefinitionValidator.js','CrudKendoGridRenderer.js'])vm.runInContext(fs.readFileSync(src+(f==='PageDefinitionNormalizer.js'?'../page-engine/'+f:f),'utf8'),ctx,{filename:f});
let checks=0;for(const name of ['summary','detail']){const d=JSON.parse(fs.readFileSync(root+'/local-validation/'+name+'-metadata-preview.json','utf8'));const result=new w.CrudDefinitionValidator().validate(d);assert.equal(result,true,JSON.stringify(result));checks++;}
const draft=JSON.parse(fs.readFileSync(root+'/metadata/alertas-importacao-med-builder-draft.json','utf8'));const links=draft.programDraft.rowLinks;const renderer=Object.create(w.CrudKendoGridRenderer.prototype);
for(const [kind,row]of [['Processo',{link_proc_compra_id:10,link_container_id:null}],['Item',{link_proc_compra_id:10,link_container_id:null}],['Container',{link_proc_compra_id:null,link_container_id:10}]]){const p=renderer.buildRowLinkHtml(links[0],row),c=renderer.buildRowLinkHtml(links[1],row);assert.equal(p==='',kind==='Container');assert.equal(c==='',kind!=='Container');assert.ok((p||c).includes('context__'+(kind==='Container'?'container_id':'proc_compra_id')+'=10'));checks+=3;}
console.log('PASS native metadata and mixed links checks='+checks+' no DOM/HTTP');


