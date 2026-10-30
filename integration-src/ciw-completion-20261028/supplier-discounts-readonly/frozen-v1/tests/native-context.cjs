'use strict';
const fs=require('node:fs'),path=require('node:path'),vm=require('node:vm'),crypto=require('node:crypto'),assert=require('node:assert/strict');
const repo='D:/opencode/construtor-pg',root='D:/opencode/conversao-sc',domain=path.join(root,'integration-src/ciw-completion-20261028/supplier-discounts-readonly'),out=path.join(root,'.runtime/ciw-completion-20261028/supplier-discounts-readonly');
const sha=p=>crypto.createHash('sha256').update(fs.readFileSync(p)).digest('hex');
const scope={console,URL,URLSearchParams,window:null,jQuery:()=>{},location:{href:'file:///isolated-supplier-context',origin:'null'}};scope.window=scope;vm.createContext(scope);
const files=['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudEngine.js'];for(const file of files)vm.runInContext(fs.readFileSync(path.join(repo,file),'utf8'),scope);
let checks=0;const check=(condition,message)=>{checks++;assert.ok(condition,message);};
const raw=JSON.parse(fs.readFileSync(path.join(out,'native-preview.json'),'utf8')),definition=new scope.PageDefinitionNormalizer().normalize(raw);new scope.CrudDefinitionValidator().validate(definition);checks++;
const Ajv=require(path.join(root,'.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020')).default;
const schemaFile=path.join(repo,'public/metadata/schemas/crud-definition-v1.schema.json'),validate=new Ajv({strict:false,allErrors:true,validateFormats:false}).compile(JSON.parse(fs.readFileSync(schemaFile,'utf8')));
const effective=structuredClone(definition);effective.permissions=Object.fromEntries(Object.keys(effective.permissions).map(key=>[key,key==='read']));
check(validate(effective),JSON.stringify(validate.errors));
check(definition.dataModel.fields.fornecedor_id.type==='integer','Supplier type must remain integer');
check(definition.contextFields.length===1&&definition.contextFields[0].required&&definition.contextFields[0].filter,'Supplier context must remain required');
check(definition.permissions.create===false&&definition.permissions.edit===false&&definition.permissions.delete===false,'No writer');
const source=JSON.parse(fs.readFileSync(path.join(domain,'SOURCE_PROOF.json'),'utf8')),visible=definition.crud.grid.columns.filter(x=>x.visible!==false&&!x.hidden).map(x=>x.field);
check(JSON.stringify(visible.slice(0,15))===JSON.stringify(source.activeSql.outerProjections),'Source15 projected fields and order');
check(!visible.includes('desconto_importacao_id')&&definition.dataModel.primaryKey==='record_key','Physical identity hidden, multiplicity preserved');
check(definition.dataModel.fields.arquivo.type==='text','File is text without download');
const init=value=>{const engine=Object.create(scope.CrudEngine.prototype);engine.definition=definition;engine.options={contextValues:value===undefined?{}:{fornecedor_id:value}};engine.initializeNavigationContext();return engine.contextValues.fornecedor_id;};
for(const value of [7,'7',2147483647,'2147483647'])check(init(value)===Number(value),'Existing positive context');
const gates=[];
for(const value of [0,'0',-9,'-9',-2147483648,'-2147483648']){
 let code;try{init(value);}catch(error){code=error.payload?.error?.code;}
 check(code==='CRUD_CONTEXT_INVALID','Expected current native signed-context RED');gates.push({value,currentNativeError:code,apiAcceptsSignedInteger:true});
}
for(const value of [undefined,null,1.5,true,2147483648,-2147483649]){let rejected=false;try{init(value);}catch{rejected=true;}check(rejected,'Invalid/missing native context must remain rejected');}
const numericFilters=definition.crud.filters?.fields??definition.crud.filterFields??[];
const report={success:true,checks,realNativeValidator:true,ajv2020:true,permissionResolution:'SYNTHETIC_READONLY_FOR_SCHEMA_ONLY_NO_GRANT',networkExecuted:false,nativeState:'HELD_SIGNED_INTEGER_CONTEXT',apiContextType:'integer',positiveContextPreserved:true,currentNativeGate:gates,decimalFilterGate:'Builder72c6 maps decimal filter fields to text/contains; separate central decimal companion required before numeric native parity',numericFilterShape:numericFilters,files:[...files,'public/metadata/schemas/crud-definition-v1.schema.json'].map(file=>({path:path.join(repo,file),sha256:sha(path.join(repo,file))}))};
fs.writeFileSync(path.join(out,'native-context-proof.json'),JSON.stringify(report,null,2)+'\n');console.log(JSON.stringify({success:true,checks,state:report.nativeState,networkExecuted:false}));
