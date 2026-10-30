const fs=require('node:fs'),path=require('node:path'),assert=require('node:assert/strict');
const pkg=path.resolve(__dirname,'..');let checks=0;function check(v,m){assert.ok(v,m);checks++;}
const history=JSON.parse(fs.readFileSync(path.join(pkg,'metadata/history-builder-draft.json'),'utf8'));
const fields=Object.fromEntries(history.entityDraft.fields.map(f=>[f.code,f]));
const legacy=fs.readFileSync(path.resolve(pkg,'../../../sources/scriptcase/ciw-completion-linked-20261028/cons_item_container_custos/cons_item_container_custos_grid.class.php'),'utf8');
const selected=legacy.match(/SELECT (item_container_custo_id[^"\r\n]+) from /)[1].split(',').map(s=>s.trim());
check(selected.length===25,'25 original physical columns');for(const f of selected)check(!!fields[f],f+' preserved');
check(fields.vl_desconto_utiliz_real.dataType==='string','original financial string retained');
check(fields.record_key.primaryKey&&fields.item_container_custo_id.dataType==='integer','complete key and typed identity');
check(history.programDraft.allowCreate===false&&history.programDraft.allowUpdate===false&&history.programDraft.allowDelete===false,'read-only native view');
check(history.programDraft.crudOptions.defaultSort[0].field==='qt_embarcada'&&history.programDraft.crudOptions.defaultSort[0].dir==='desc','legacy quantity sort');
check(history.programDraft.contextFields.map(f=>f.field).join(',')==='container_id,versao_id'&&history.programDraft.contextFields.every(f=>f.required),'both owner contexts required');
check(history.entityDraft.fields.every(f=>f.options.readonly&&f.options.writable===false),'all fields immutable');
check(!JSON.stringify(history).match(/javascript:|eval\(|<script|htmlTemplate/),'no executable markup');
const parent=JSON.parse(fs.readFileSync(path.join(pkg,'metadata/parent-patch.json'),'utf8'));
check(parent.operations[2].value.parameters.map(p=>p.field).join(',')==='container_id,versao_id','link forwards full ownership');
const privateRoot=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history');
const staged=fs.readFileSync(path.join(privateRoot,'stage/ContainersVersionService.p'),'utf8');
const old=fs.readFileSync('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionService.p','utf8');
check(staged.match(/ itemFields="([^"]+)"/)[1]===old.match(/ itemFields="([^"]+)"/)[1],'writer/audit item fields unchanged');
check(staged.slice(staged.indexOf('PROCEDURE PersistItem:'),staged.indexOf('PROCEDURE Fail:'))===old.slice(old.indexOf('PROCEDURE PersistItem:'),old.indexOf('PROCEDURE Fail:')),'persist writer body byte-for-byte unchanged');
check(staged.includes('readMaxRows AS INTEGER NO-UNDO INITIAL 50000')&&staged.includes('DO STOP-AFTER 10')&&staged.includes('IF NOT Exact(operationValue,"consultar") THEN RETURN.'),'bounded reads, writer budget bypass');
const currentSchemas=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/schema');
const schemaProof=[];
for(const [file,oldPath] of [['schema-item_container_custos.json','espec/schema-item_container_custos.json'],['schema-versoes_item_custo_container.json','schema-versoes_item_custo_container.json']]){
 const a=JSON.parse(fs.readFileSync(path.resolve(pkg,'../../container-panel/schema',oldPath),'utf8')),b=JSON.parse(fs.readFileSync(path.join(currentSchemas,file),'utf8'));
 const shape=s=>s.fields.map(f=>[f.name,f.type,f.extent]).sort((a,b)=>a[0].localeCompare(b[0]));
 assert.deepEqual(shape(a),shape(b));checks++;
 const indexes=s=>s.indexes.map(i=>[i.name,i.unique,i.primary,i.fields]).sort((a,b)=>a[0].localeCompare(b[0]));
 assert.deepEqual(indexes(a),indexes(b));checks++;
 schemaProof.push({table:b.table,fields:b.fields.length,indexes:b.indexes.length,nameTypeExtentAndIndexesEqual:true,decimalsCurrentProbe:'not exported; historical dictionary precision retained'});
}
const proof={status:'PASS',checks,legacyColumns:selected.length,schemaProof};
if(fs.existsSync(path.join(pkg,'auxiliary-views.json'))){
 const views=JSON.parse(fs.readFileSync(path.join(pkg,'auxiliary-views.json'),'utf8'));
 for(const view of views){const m=JSON.parse(fs.readFileSync(path.join(pkg,'metadata',view.resource+'-builder-draft.json'),'utf8'));const f=Object.fromEntries(m.entityDraft.fields.map(f=>[f.code,f]));
  check(f.record_key.primaryKey&&f.record_key.dataType==='string','aux record_key transport identity');for(const code of view.fields.split(','))check(!!f[code],'aux persisted field '+code);
  check(m.programDraft.allowCreate===false&&m.programDraft.allowUpdate===false&&m.programDraft.allowDelete===false,'aux readonly');check(m.programDraft.contextFields.map(f=>f.field).join(',')==='container_id,versao_id','aux both contexts');
 }
 const patch=JSON.parse(fs.readFileSync(path.join(pkg,'metadata/source-patch.json'),'utf8'));
 check(patch.operations.length===2+views.length*2&&new Set(patch.operations.map(o=>o.value.code)).size===patch.operations.length,'unique add-only operations');check(patch.operations.every(o=>o.op==='add'&&o.path==='/operations/-'),'source existing operations preserved by append');
 proof.auxiliaryViews=views.length;proof.checks=checks;
}
fs.writeFileSync(path.join(privateRoot,'metadata-schema-proof.json'),JSON.stringify(proof,null,2)+'\n');console.log(JSON.stringify(proof,null,2));
