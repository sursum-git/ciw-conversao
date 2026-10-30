'use strict';
const fs=require('fs'),path=require('path'),assert=require('assert/strict');
const {chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const repo='D:/opencode/construtor-pg',candidate='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/native-batch-snapshot-example',out='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/native-batch-snapshot-example';
fs.mkdirSync(out,{recursive:true});
(async()=>{const browser=await chromium.launch({headless:true,channel:'msedge'});try{
 const page=await browser.newPage(),errors=[],unexpected=[];
 page.on('pageerror',error=>errors.push(String(error)));
 page.on('console',message=>{if(message.type()==='error')console.error('BROWSER',message.text());});
 await page.route('**/*',async route=>{
  const req=route.request(),u=new URL(req.url());
  if(u.origin!=='http://127.0.0.1:18742'||req.method()!=='GET'){unexpected.push(req.method()+' '+u.origin);return route.abort();}
  const rel=decodeURIComponent(u.pathname).replace(/^\/+/,''),local=path.resolve(candidate,rel),canonical=path.resolve(repo,rel);
  if(!local.startsWith(path.resolve(candidate)+path.sep)||!canonical.startsWith(path.resolve(repo)+path.sep)){return route.abort();}
  const f=fs.existsSync(local)?local:canonical;
  if(!fs.existsSync(f)){return route.fulfill({status:404,body:''});}
  const type={'.html':'text/html','.js':'application/javascript','.css':'text/css','.json':'application/json','.woff2':'font/woff2'}[path.extname(f)]||'application/octet-stream';
  await route.fulfill({status:200,body:fs.readFileSync(f),contentType:type});
 });
 await page.goto('http://127.0.0.1:18742/examples/pages/batch-snapshot.html');
 try {await page.waitForFunction(()=>window.batchSnapshotExample,{},{timeout:8000});} catch(error) {console.error(errors);throw error;}await page.evaluate(()=>window.batchSnapshotExample.ready);
 const result=await page.evaluate(async()=>{
  const r=window.batchSnapshotExample.renderer,row=r.grid.dataSource.at(0),before=row.vl_prev;
  const readonly=!row.editable('despesa_container_id')&&!row.editable('despesa_id')&&!row.editable('container_id');
  row.set('vl_prev',1.25);const pending=r.collectBatchChanges().length===1;await r.discardBatch();
  const cancelled=r.collectBatchChanges().length===0&&!document.getElementById('batch-snapshot-payload').textContent;
  const fresh=r.grid.dataSource.at(0);fresh.set('vl_prev',1.25);const saved=await r.saveBatch();
  const payload=JSON.parse(document.getElementById('batch-snapshot-payload').textContent),cleared=r.collectBatchChanges().length===0,second=await r.saveBatch();
  return{before,readonly,pending,cancelled,saved,payload,cleared,second,status:document.getElementById('batch-snapshot-status').textContent};
 });
 assert.deepEqual(errors,[]);assert.deepEqual(unexpected,[]);assert.equal(result.readonly,true);assert.equal(result.pending,true);assert.equal(result.cancelled,true);assert.equal(result.saved,true);assert.equal(result.cleared,true);assert.equal(result.second,false);
 assert.deepEqual(result.payload.context,{container_id:900001});assert.equal(Object.keys(result.payload.changes[0].original).length,14);assert.deepEqual(Object.keys(result.payload.changes[0].data).sort(),['log_manual','vl_base_imp','vl_prev']);assert.match(result.status,/somente à memória/);
 await page.screenshot({path:path.join(out,'example.png'),fullPage:true});
 fs.writeFileSync(path.join(out,'verification.json'),JSON.stringify({success:true,checks:12,networkBusinessRequests:0,canonicalWrites:false,realSharedRenderer:true,result},null,2));
 console.log('PASS functional native snapshot example checks=12 businessRequests=0');
}finally{await browser.close();}})().catch(error=>{console.error(error);process.exitCode=1;});
