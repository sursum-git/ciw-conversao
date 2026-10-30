'use strict';
const fs=require('node:fs'),vm=require('node:vm'),path=require('node:path'),assert=require('node:assert/strict');
const state=path.resolve(__dirname,'../../.runtime/purchase-pending-integration-20261028/metadata');
const scope={console,URL,window:null,jQuery:()=>{throw Error('DOM_NOT_EXPECTED');},location:{href:'http://127.0.0.1:8765',origin:'http://127.0.0.1:8765'}};scope.window=scope;vm.createContext(scope);
for(const name of ['src/page-engine/PageDefinitionNormalizer.js','src/crud-engine/CrudUtils.js','src/crud-engine/CrudDefinitionValidator.js','src/crud-engine/CrudKendoFormRenderer.js'])vm.runInContext(fs.readFileSync(path.join('D:/opencode/construtor-pg',name),'utf8'),scope,{filename:name});
const checks=[];
for(const file of fs.readdirSync(state).filter(n=>n.endsWith('-definition.json'))){
 const d=JSON.parse(fs.readFileSync(path.join(state,file)));
 try{new scope.CrudDefinitionValidator().validate(d);checks.push({file,valid:true});}
 catch(e){checks.push({file,valid:false,errors:e.payload?.error?.details?.errors??[e.message]});}
}
const success=checks.length===3&&checks.every(x=>x.valid);fs.writeFileSync(path.join(state,'js-validation.json'),JSON.stringify({success,checks,businessWrites:false},null,2)+'\n');
assert.equal(success,true,JSON.stringify(checks));console.log('PASS native JS validators:3 candidate screens');
