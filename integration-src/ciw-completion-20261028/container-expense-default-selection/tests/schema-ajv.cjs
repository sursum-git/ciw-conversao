const fs=require('fs'),path=require('path'),assert=require('assert/strict');
const Ajv=require('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020').default;
const root='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection',repo='D:/opencode/construtor-pg/public/metadata/schemas';
const ajv=new Ajv({strict:false,allErrors:true,validateFormats:false}),red=process.argv.includes('--red'),dir=red?repo:root+'/native/public/metadata/schemas';
const schema=JSON.parse(fs.readFileSync(dir+'/process-definition-v1.schema.json','utf8'));
const validate=ajv.compile(schema),d=JSON.parse(fs.readFileSync(root+'/native-preview.json','utf8'));
if(red){assert.equal(validate(d),false);console.log('PASS expected RED canonical process schema does not admit native integer collection');process.exit(0);}
let checks=0;function valid(value,expected,label){checks++;assert.equal(validate(value),expected,label+' '+JSON.stringify(validate.errors));}
valid(d,true,'real generated selection definition');
const legacy=structuredClone(d);delete legacy.process.parameters.fields.find(f=>f.field==='despesa_ids').optionsSource.parameterFields;valid(legacy,true,'legacy no opt-in collection');
for(const [label,mutate]of Object.entries({unknown:f=>f.optionsSource.extra='bad',shape:f=>f.optionsSource.parameterFields='ordem_campo',empty:f=>f.optionsSource.parameterFields=[],duplicate:f=>f.optionsSource.parameterFields=['ordem_campo','ordem_campo'],extra:f=>f.optionsSource.parameterFields=['a','b','c'],context:f=>f.optionsSource.parameterFields=['context'],integer:f=>f.optionsSource.parameterFields=[1],endpoint:f=>f.optionsSource.endpointId='run',itemType:f=>f.itemType='string'})){
 const value=structuredClone(d);mutate(value.process.parameters.fields.find(f=>f.field==='despesa_ids'));valid(value,false,label);
}
const minimal={schemaVersion:'1.0',pageType:'process',program:{title:'Legacy'},process:{parameters:{fields:[{field:'x',label:'X',type:'integer'}]}}};valid(minimal,true,'legacy scalar process');
const crud=JSON.parse(fs.readFileSync(dir+'/crud-definition-v1.schema.json','utf8'));ajv.addSchema(crud);
const fullCrud=ajv.getSchema(crud.$id),actualCrud=JSON.parse(fs.readFileSync(root+'/native-crud-preview.json','utf8'));
// Runtime resolves permission names to booleans before exposing a CRUD screen.
actualCrud.permissions=Object.fromEntries(Object.keys(actualCrud.permissions).map(name=>[name,false]));checks++;assert.equal(fullCrud(actualCrud),true,JSON.stringify(fullCrud.errors));
const field=ajv.compile({$ref:crud.$id+'#/$defs/field'});
for(const [source,expected]of [[{endpointId:'options.selected',parameterFields:['ordem_campo','ordem_direcao']},true],[{endpointId:'options.selected'},true],[{endpointId:'options.selected',parameterFields:['context']},false],[{endpointId:'options.selected',parameterFields:['a','a']},false],[{endpointId:'options.selected',parameterFields:['a'],unknown:1},false]]){
 checks++;assert.equal(field({type:'integer',label:'Selected',optionsSource:source}),expected,JSON.stringify(field.errors));
}
fs.writeFileSync(root+'/schema-ajv-result.json',JSON.stringify({success:true,checks,ajv:'8.17.1',draft:'2020-12',generatedDefinition:true,legacy:true,canonicalChanged:false},null,2));
console.log('PASS AJV2020 complete schemas/generated selection/closed lookup/legacy checks='+checks);
