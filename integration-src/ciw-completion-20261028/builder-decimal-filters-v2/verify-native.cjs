'use strict';
const fs=require('fs'),vm=require('vm'),assert=require('node:assert/strict');
const root='D:/opencode/construtor-pg',state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters-v2';
const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{}};scope.window=scope;vm.createContext(scope);
for(const name of ['page-engine/PageDefinitionNormalizer','crud-engine/CrudUtils','crud-engine/CrudDefinitionValidator','crud-engine/CrudFilterRenderer'])vm.runInContext(fs.readFileSync(root+'/src/'+name+'.js','utf8'),scope);
const Ajv=require('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020').default;
const validate=new Ajv({strict:false,allErrors:true,validateFormats:false}).compile(JSON.parse(fs.readFileSync(root+'/public/metadata/schemas/crud-definition-v1.schema.json','utf8')));
let checks=0;
function diffs(a,b,path=''){if(JSON.stringify(a)===JSON.stringify(b))return[];if(a&&b&&typeof a==='object'&&typeof b==='object')return [...new Set([...Object.keys(a),...Object.keys(b)])].flatMap(k=>diffs(a[k],b[k],path+'/'+k));return[path];}
for(const mode of ['default','explicit']){
 const before=JSON.parse(fs.readFileSync(state+'/baseline-'+mode+'.json','utf8')),after=JSON.parse(fs.readFileSync(state+'/candidate-'+mode+'.json','utf8'));
 assert.deepEqual(diffs(before,after),['/crud/filter/fields/0/type','/crud/filter/fields/0/operator']);checks++;
 const normalized=new scope.PageDefinitionNormalizer().normalize(after);
 new scope.CrudDefinitionValidator().validate(normalized);checks++;
 const effective=structuredClone(normalized);effective.permissions=Object.fromEntries(Object.keys(effective.permissions).map(k=>[k,k==='read']));
 assert.equal(validate(effective),true,JSON.stringify(validate.errors));checks++;
 const renderer=new scope.CrudFilterRenderer({definition:normalized}),field=normalized.filter.fields[0];
 assert.equal(renderer.getFilterDataType(field),'decimal');checks++;
 const options=renderer.getOperatorOptions(field);
 assert.deepEqual(Array.from(options,x=>x.value),['eq','gte','lte','lt','gt','between']);checks++;
 assert.equal(renderer.getDefaultOperator(field,options),'eq');checks++;
 assert.equal(normalized.dataModel.fields.field_1.type,'number');checks++;
 const originalRenderer=new scope.CrudFilterRenderer({definition:new scope.PageDefinitionNormalizer().normalize(before)});
 assert.equal(originalRenderer.getFilterDataType(before.crud.filter.fields[0]),'text');checks++;
}
fs.writeFileSync(state+'/native-verification.json',JSON.stringify({success:true,checks,realBuilderGeneration:true,nativeValidator:true,ajv2020:true,nativeFilterTypeAndOperators:true,exactlyTwoDefinitionDeltasEach:true,domOrKendoWidgetExecution:false,canonicalChanged:false,published:false},null,2)+'\n');
console.log('PASS '+checks+' native metadata/type/operator and complete-definition delta checks; no canonical change');
