'use strict';
const fs=require('fs'),assert=require('assert/strict'),path=require('path');
const root='D:/opencode/conversao-sc',state=root+'/.runtime/ciw-completion-20261028',pkg=root+'/integration-src/ciw-completion-20261028/native-batch-snapshot-schema';
const Ajv=require(state+'/schema-snapshot-ajv/node_modules/ajv/dist/2020'),formats=require(state+'/schema-snapshot-ajv/node_modules/ajv-formats');
const read=p=>JSON.parse(fs.readFileSync(p,'utf8')),clone=v=>structuredClone(v);
function compile(schema){const ajv=new Ajv({strict:false,allErrors:true,validateFormats:true});formats(ajv);return ajv.compile(schema);}
const before=compile(read('D:/opencode/construtor-pg/public/metadata/schemas/crud-definition-v1.schema.json')),after=compile(read(pkg+'/crud-definition-v1.schema.json'));
const example=read(root+'/integration-src/ciw-completion-20261028/native-batch-snapshot-example/examples/batch-snapshot.crud.json');
assert.equal(before(example),false);const red=clone(before.errors);assert(red.some(e=>e.keyword==='additionalProperties'&&e.params.additionalProperty==='snapshot'));
assert.equal(after(example),true,JSON.stringify(after.errors));let checks=2;
// Runtime resolves permission strings to booleans before serving definitions.
// Exercise that actual resolver with an empty test RequestStack; no auth/DB.
const php="require 'D:/opencode/construtor-pg/backend/vendor/autoload.php'; $d=json_decode(file_get_contents($argv[1]),true,512,JSON_THROW_ON_ERROR); $r=new App\\Runtime\\PermissionResolver(new Symfony\\Component\\HttpFoundation\\RequestStack()); echo json_encode($r->applyDefinitionPermissions($d),JSON_THROW_ON_ERROR);";
const full=JSON.parse(require('child_process').execFileSync('C:/php-8.4.3/php.exe',['-r',php,state+'/container-expense-batch/bridge/native-preview.json'],{encoding:'utf8'}));
assert.equal(after(full),true,JSON.stringify(after.errors));++checks;
function reject(change){const d=clone(example);change(d.crud.grid.editing);assert.equal(after(d),false,'Malformed snapshot accepted');++checks;}
reject(e=>e.snapshot.extra=true);reject(e=>e.snapshot.originalFields=[]);reject(e=>e.snapshot.contextFields=[]);reject(e=>e.snapshot.originalFields=Array(65).fill(0).map((_,i)=>'field'+i));reject(e=>e.snapshot.originalFields=['vl_prev','vl_prev']);reject(e=>e.snapshot.originalFields=[42]);reject(e=>e.snapshot.originalFields=['x;SQL']);reject(e=>delete e.snapshot.contextFields);reject(e=>e.mode='form');reject(e=>e.other=true);
const old=clone(example);delete old.crud.grid.editing.snapshot;old.crud.grid.editing.mode='form';assert.equal(before(old),true,JSON.stringify(before.errors));assert.equal(after(old),true,JSON.stringify(after.errors));++checks;
const report={success:true,ajvVersion:require(state+'/schema-snapshot-ajv/node_modules/ajv/package.json').version,checks,baselineRed:red,candidateFullBuilderDefinitionPass:true,permissionsResolvedByActualPermissionResolver:true,candidateExamplePass:true,unknownKeysRejected:true,wrongModeRejected:true,legacyWithoutSnapshotPass:true,canonicalWrites:false,existingFieldCrossReferences:'Shared JS validator remains responsible; full JSON Schema has no data-key reference extension'};
fs.mkdirSync(state+'/native-batch-snapshot-schema',{recursive:true});fs.writeFileSync(state+'/native-batch-snapshot-schema/verification.json',JSON.stringify(report,null,2));console.log('PASS AJV2020 schema RED→GREEN checks='+checks);
