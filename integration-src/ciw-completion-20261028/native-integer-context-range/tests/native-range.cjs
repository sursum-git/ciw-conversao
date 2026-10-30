'use strict';
const fs=require('node:fs'),path=require('node:path'),vm=require('node:vm'),assert=require('node:assert/strict'),crypto=require('node:crypto');
const root='D:/opencode/conversao-sc',repo='D:/opencode/construtor-pg',domain=path.resolve(__dirname,'..'),out=path.join(root,'.runtime/ciw-completion-20261028/native-integer-context-range');
const sha=p=>crypto.createHash('sha256').update(fs.readFileSync(p)).digest('hex');
function scope(mode){const s={console,URL,URLSearchParams,window:null,jQuery:()=>{}};s.window=s;vm.createContext(s);for(const file of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudEngine.js']){const source=['CrudDefinitionValidator.js','CrudEngine.js'].includes(path.basename(file))?path.join(domain,mode,path.basename(file)):path.join(repo,file);vm.runInContext(fs.readFileSync(source,'utf8'),s);}return s;}
const s=scope('candidate-exact'),baseline=scope('baseline-exact');
const Ajv=require(path.join(root,'.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020')).default,validate=new Ajv({strict:false,allErrors:true,validateFormats:false}).compile(JSON.parse(fs.readFileSync(path.join(domain,'candidate-exact/crud-definition-v1.schema.json'),'utf8')));
const original=JSON.parse(fs.readFileSync(path.join(root,'.runtime/ciw-completion-20261028/supplier-discounts-readonly/native-preview.json'),'utf8'));
function definition(range,fieldType='integer'){const d=structuredClone(original);d.dataModel.fields.fornecedor_id.type=fieldType;d.contextFields=[{field:'fornecedor_id',required:true,filter:true,readonly:true,createDefault:false}];if(range!==undefined)d.contextFields[0].integerRange=range;d.permissions=Object.fromEntries(Object.keys(d.permissions).map(k=>[k,k==='read']));return d;}
function engine(target,d,value,missing=false){const e=Object.create(target.CrudEngine.prototype);e.definition=d;e.options={contextValues:missing?{}:{fornecedor_id:value}};e.initializeNavigationContext();return e.contextValues.fornecedor_id;}
const full={min:-2147483648,max:2147483647},red=[];const d=definition(full);
if(!validate(d))red.push('AJV_REJECTS_DECLARED_RANGE');try{new s.CrudDefinitionValidator().validate(new s.PageDefinitionNormalizer().normalize(d));}catch{red.push('VALIDATOR_REJECTS_DECLARED_RANGE');}try{if(engine(s,d,0)!==0)red.push('ENGINE_ZERO_CHANGED');}catch{red.push('ENGINE_REJECTS_ZERO_WITH_DECLARED_RANGE');}
if(red.length){fs.writeFileSync(path.join(out,'native-red.json'),JSON.stringify({expectedFailure:true,failures:red,networkExecuted:false},null,2)+'\n');console.error(red.join('\n'));process.exit(1);}
let checks=0;const check=(fn)=>{fn();checks++;};const rejected=(fn)=>{assert.throws(fn);checks++;};
for(const range of [full,{min:-5,max:12},{min:0,max:0},{min:-10,max:-1},{min:7,max:7},{min:2147483647,max:2147483647},{min:-2147483648,max:-2147483648}]){
 const current=definition(range);check(()=>assert.equal(validate(current),true));check(()=>new s.CrudDefinitionValidator().validate(new s.PageDefinitionNormalizer().normalize(current)));
 for(const value of [range.min,range.max,String(range.min),String(range.max)])check(()=>assert.equal(engine(s,current,value),Number(value)));
 if(range.min>-2147483648)rejected(()=>engine(s,current,range.min-1));if(range.max<2147483647)rejected(()=>engine(s,current,range.max+1));
}
for(const value of [0,'0',-9,'-9',-2147483648,'-2147483648',2147483647,'2147483647'])check(()=>assert.equal(engine(s,d,value),Number(value)));
for(const value of [1.5,true,false,null,undefined,[],[0],['0'],{},2147483648,-2147483649,'2147483648','-2147483649','-0','+1','01','-01',' 1','1 ','1.0','1e0','',NaN,Infinity])rejected(()=>engine(s,d,value));
rejected(()=>engine(s,d,undefined,true));
for(const range of [null,[],[0,10],{min:0},{max:10},{min:0,max:10,unknown:true},{min:'0',max:10},{min:false,max:10},{min:0.5,max:10},{min:0,max:10.5},{min:-2147483649,max:10},{min:0,max:2147483648},{min:'-0',max:10}]){
 const invalid=definition(range);check(()=>assert.equal(validate(invalid),false));rejected(()=>new s.CrudDefinitionValidator().validate(new s.PageDefinitionNormalizer().normalize(invalid)));rejected(()=>engine(s,invalid,0));rejected(()=>engine(s,invalid,undefined,true));
}
const inverted=definition({min:10,max:0});check(()=>assert.equal(validate(inverted),true)); // Standard JSON Schema does not compare dynamic properties.
rejected(()=>new s.CrudDefinitionValidator().validate(new s.PageDefinitionNormalizer().normalize(inverted)));rejected(()=>engine(s,inverted,5));
for(const type of ['string','number','boolean','date']){const invalid=definition(full,type);rejected(()=>new s.CrudDefinitionValidator().validate(new s.PageDefinitionNormalizer().normalize(invalid)));rejected(()=>engine(s,invalid,1));}
const noRange=definition(undefined);const defaultMatrix=[7,'7',2147483647,'2147483647',0,'0',-9,'-9',-2147483648,'-0',1.5,true,false,null,undefined,[],[7],{},'01','+1',' 1',2147483648];
const observe=(target,value)=>{try{return{accepted:true,value:engine(target,noRange,value)};}catch(error){return{accepted:false,code:error.payload?.error?.code};}};
for(const value of defaultMatrix)check(()=>assert.deepEqual(observe(s,value),observe(baseline,value)));
check(()=>assert.equal(observe(s,7).accepted,true));check(()=>assert.equal(observe(s,0).accepted,false));check(()=>assert.equal(observe(s,-9).accepted,false));
const schemaBefore=JSON.parse(fs.readFileSync(path.join(domain,'baseline-exact/crud-definition-v1.schema.json'),'utf8')),schemaAfter=JSON.parse(fs.readFileSync(path.join(domain,'candidate-exact/crud-definition-v1.schema.json'),'utf8'));delete schemaAfter.$defs.contextField.properties.integerRange;check(()=>assert.deepEqual(schemaAfter,schemaBefore));
const report={success:true,checks,realAjv2020:true,realValidator:true,realCrudEngine:true,fullInt32AndSubrange:true,defaultMatrixEquivalent:true,defaultCases:defaultMatrix.length,relationalSchemaLimit:'AJV shape/bounds; Builder/JSValidator/Engine enforce min<=max and integer field',networkExecuted:false,canonicalWrites:false,files:['ProgramBuilderService.php','crud-definition-v1.schema.json','CrudDefinitionValidator.js','CrudEngine.js'].map(name=>({path:'candidate-exact/'+name,sha256:sha(path.join(domain,'candidate-exact',name))}))};
fs.writeFileSync(path.join(out,'native-range-proof.json'),JSON.stringify(report,null,2)+'\n');console.log(JSON.stringify({success:true,checks,networkExecuted:false}));
