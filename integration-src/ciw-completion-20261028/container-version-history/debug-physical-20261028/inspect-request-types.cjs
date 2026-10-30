// Prints only request key TYPES from the named private proof; never values.
const fs=require('node:fs');const file='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/official-build3/pasoe-attempts-private.json';const found=[];
function shape(v){return Object.fromEntries(Object.entries(v).map(([k,value])=>[k,value===null?'null':Array.isArray(value)?'array':typeof value]));}
function visit(v){if(!v||typeof v!=='object')return;if(v.resource==='container_versoes_historico_med')found.push({outerTypes:shape(v),bodyTypes:v.body&&typeof v.body==='object'?shape(v.body):{},errorCode:v.error?.code??null});for(const value of Object.values(v))if(value&&typeof value==='object')visit(value);}
visit(JSON.parse(fs.readFileSync(file,'utf8')));console.log(JSON.stringify({requestShapes:found},null,2));
