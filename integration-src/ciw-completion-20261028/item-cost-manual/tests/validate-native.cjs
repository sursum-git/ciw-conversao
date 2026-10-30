const fs=require('fs'),path=require('path'),vm=require('vm'),assert=require('assert/strict');
const repo='D:/opencode/construtor-pg',state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/item-cost-manual';
const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{},location:{href:'http://127.0.0.1:8090/production/app.html',origin:'http://127.0.0.1:8090'}};scope.window=scope;vm.createContext(scope);
for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js'])vm.runInContext(fs.readFileSync(path.join(repo,file),'utf8'),scope);
const d=new scope.PageDefinitionNormalizer().normalize(JSON.parse(fs.readFileSync(state+'/native-preview.json','utf8')));new scope.CrudDefinitionValidator().validate(d);let checks=1;
assert.equal(d.dataModel.primaryKey,'record_key');checks++;assert.equal(Object.keys(d.dataModel.fields).length,24);checks++;
for(const op of ['create','edit','delete']){assert.equal(d.permissions[op],false);checks++;}
for(const field of Object.values(d.dataModel.fields)){assert.equal(field.readonly,true);checks++;}
assert.equal(d.contextFields.length,0);checks++;
const Ajv=require('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020').default;
const ajv=new Ajv({strict:false,allErrors:true,validateFormats:false}),schema=JSON.parse(fs.readFileSync(repo+'/public/metadata/schemas/crud-definition-v1.schema.json','utf8')),validate=ajv.compile(schema),rendered=structuredClone(d);
rendered.permissions=Object.fromEntries(Object.keys(rendered.permissions).map(name=>[name,false]));assert.equal(validate(rendered),true,JSON.stringify(validate.errors));checks++;
fs.writeFileSync(state+'/native-validation.json',JSON.stringify({success:true,checks,validator:'native+AJV2020',readonly:true,physicalFields:23,writes:false},null,2));console.log('PASS native metadata/readonly/schema checks='+checks);
