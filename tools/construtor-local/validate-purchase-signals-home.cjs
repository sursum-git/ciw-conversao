const fs=require('node:fs'),vm=require('node:vm'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const state='D:/opencode/conversao-sc/.runtime/purchase-pending-integration-20261028';
const read=n=>JSON.parse(fs.readFileSync(state+'/'+n,'utf8'));
const before=read('metadata-home-before.json'),candidate=read('metadata-home-candidate.json');
const ids=['ciw-sinalizadores-importacao-med','ciw-sinalizadores-importacao'];
const links=candidate.programs.filter(p=>ids.includes(p.id));assert.equal(links.length,2);
// Referências de permissões são resolvidas pelo runtime; não são grants.
if(!links.every(p=>candidate.permissions[p.permission]===p.permission)){
 const backup=state+'/metadata-home-candidate-without-references.json';assert.ok(!fs.existsSync(backup));fs.copyFileSync(state+'/metadata-home-candidate.json',backup);
 for(const p of links){assert.ok(!(p.permission in before.permissions));candidate.permissions[p.permission]=p.permission;}
 fs.writeFileSync(state+'/metadata-home-candidate.json',JSON.stringify(candidate));
}
const restored=structuredClone(candidate);restored.programs=restored.programs.filter(p=>!ids.includes(p.id));
for(const g of restored.navigation.groups)g.items=g.items.filter(i=>!ids.includes(i.programId));
for(const p of links)delete restored.permissions[p.permission];assert.deepEqual(restored,before);
assert.deepEqual(links.map(p=>p.permission),['proc_compra_sinalizadores_med_progress.read','sinalizadores_importacao_progress.read']);
const window={location:{origin:'http://127.0.0.1:8765',href:'http://127.0.0.1:8765/production/home.html'}};
const c=vm.createContext({window,console,URL});
for(const file of ['src/crud-engine/CrudUtils.js','src/home-engine/HomeDefinitionValidator.js'])vm.runInContext(fs.readFileSync('D:/opencode/construtor-pg/'+file,'utf8'),c,{filename:file});
const validate=d=>{try{new window.HomeDefinitionValidator().validate(d);return [];}catch(e){return e.payload?.error?.details?.errors??[String(e)];}};
const baselineErrors=validate(before),candidateErrors=validate(candidate);assert.deepEqual(candidateErrors,baselineErrors,'Delta não pode introduzir erros no Home existente');
const isolated={...structuredClone(candidate),programs:links,permissions:Object.fromEntries(links.map(p=>[p.permission,p.permission])),navigation:{...candidate.navigation,groups:[{id:'ciw-compras',title:'Compras',moduleId:'ciw',items:links.map(p=>({programId:p.id,title:p.title}))}]}};
isolated.layout.initialProgramId=links[0].id;
// Referências de appbar/módulos preexistentes continuam necessárias na projeção.
isolated.permissions={...candidate.permissions};assert.deepEqual(validate(isolated),[],'Dois atalhos devem ser válidos no validador nativo');
const sha=crypto.createHash('sha256').update(JSON.stringify(candidate)).digest('hex');
const baseline=read('metadata-home-baseline.json');baseline.candidateSha256=sha;fs.writeFileSync(state+'/metadata-home-baseline.json',JSON.stringify(baseline));
fs.writeFileSync(state+'/metadata-home-validation.json',JSON.stringify({success:true,candidateSha256:sha,links:2,permissionReferences:2,otherMenusPreserved:true,nativeNewLinksValid:true,baselineExistingValidationIssues:baselineErrors,noNewValidationIssues:true,businessWrites:false},null,2));
console.log('PASS: dois atalhos/referências válidos; demais menus idênticos; nenhuma nova falha de validação.');
