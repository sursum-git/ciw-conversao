const fs=require('fs'),vm=require('vm'),path=require('path'),assert=require('assert/strict');
const state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/comparison-after11';
const canonical='D:/opencode/construtor-pg';
const Ajv=require('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020').default;
const schema=new Ajv({strict:false,allErrors:true,validateFormats:false}).compile(JSON.parse(fs.readFileSync(canonical+'/public/metadata/schemas/crud-definition-v1.schema.json','utf8')));
const sandbox={window:{},console,jQuery:{}};vm.createContext(sandbox);
for(const file of ['crud-engine/CrudUtils.js','page-engine/PageDefinitionNormalizer.js','crud-engine/CrudDefinitionValidator.js','crud-engine/CrudFilterRenderer.js'])vm.runInContext(fs.readFileSync(canonical+'/src/'+file,'utf8'),sandbox,{filename:file});
const results=[];
for(const currency of ['real','dolar']){
 const def=JSON.parse(fs.readFileSync(state+'/native-'+currency+'.json','utf8'));
 const hydrated=JSON.parse(JSON.stringify(def));hydrated.permissions=Object.fromEntries(Object.keys(hydrated.permissions).map(k=>[k,false]));
 assert.equal(schema(hydrated),true,JSON.stringify(schema.errors));assert.equal(new sandbox.window.CrudDefinitionValidator().validate(def),true);
 const normalized=new sandbox.window.PageDefinitionNormalizer().normalize(def);
 const renderer=new sandbox.window.CrudFilterRenderer({definition:normalized});
 const numeric=[];
 for(const filter of normalized.filter.fields){if(['decimal','number'].includes(def.dataModel.fields[filter.field].type))numeric.push({field:filter.field,builderType:filter.type,rendererType:renderer.getFilterDataType(filter),operator:filter.operator});}
 assert.equal(numeric.length,12);assert.ok(numeric.every(f=>f.rendererType==='decimal'&&f.operator==='eq'),'Candidate205e numeric filters must be functional');
 assert.equal(def.crud.grid.columns.length,14);assert.equal(def.permissions.create,false);assert.equal(def.permissions.edit,false);assert.equal(def.permissions.delete,false);
 results.push({currency,structuralSchemaValid:true,nativeValidatorValid:true,columns:14,numericFilters:numeric,numericFiltersFunctional:numeric.every(f=>['decimal','number'].includes(f.rendererType)&&f.operator==='eq')});
}
fs.writeFileSync(state+'/native-validation.json',JSON.stringify({schemaAndNativeStructurePassed:true,schemaPermissions:'Boolean snapshot of native ACL hydration; raw drafts unchanged; no grant proof',renderedBrowser:false,canonicalLibrariesChanged:false,publicationHeld:true,results},null,2)+'\n');
console.log('PASS 2 AJV schemas + 2 native validators. Numeric filter functionality is reported separately; no browser/publication.');
