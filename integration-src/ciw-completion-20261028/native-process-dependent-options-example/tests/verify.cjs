const fs=require('fs'),path=require('path'),assert=require('assert/strict'),crypto=require('crypto');
const {pathToFileURL}=require('url');
const {chromium}=require('D:/opencode/construtor-pg/node_modules/playwright');
const Ajv=require('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/schema-snapshot-ajv/node_modules/ajv/dist/2020').default;
const root=path.resolve(__dirname,'..'),state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/native-process-dependent-options-example',repo='D:/opencode/construtor-pg';
const read=p=>JSON.parse(fs.readFileSync(p,'utf8').replace(/^\uFEFF/,'')),sha=p=>crypto.createHash('sha256').update(fs.readFileSync(p)).digest('hex');let checks=0;
function check(value,label){checks++;assert.ok(value,label);}
(async()=>{
 const definition=read(root+'/candidates/examples/processamento-opcoes-dependentes.process.json'),js=fs.readFileSync(root+'/candidates/src/examples/process-dependent-options-example.js','utf8');
 check(JSON.stringify(JSON.parse(js.match(/const definition = (.*);\r?\n/)[1]))===JSON.stringify(definition),'static JS/JSON same definition');
 const schema=read('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2-test-inputs/native/public/metadata/schemas/process-definition-v1.schema.json');
 const validate=new Ajv({strict:false,allErrors:true,validateFormats:false}).compile(schema);check(validate(definition),'full process schema '+JSON.stringify(validate.errors));
 for(const p of read(root+'/patches/patch-plan.json').textAndBytePatches){
  check(sha(p.target)===p.baselineSha256,'canonical baseline moved '+p.target);let candidate;
  if(p.kind==='text'){let text=fs.readFileSync(p.target,'utf8').replace(/^\uFEFF/,'').replace(/\r\n/g,'\n');for(const c of p.changes){check(text.split(c.old).length===2,'unique catalog anchor');text=text.replace(c.old,c.new);}candidate=Buffer.from(text,'utf8');}
  else {const before=fs.readFileSync(p.target),insert=Buffer.from(p.insertHex,'hex');candidate=Buffer.concat([before.subarray(0,p.insertAtByte),insert,before.subarray(p.insertAtByte)]);check(Buffer.concat([candidate.subarray(0,p.insertAtByte),candidate.subarray(p.insertAtByte+insert.length)]).equals(before),'matrix legacy bytes changed');}
  check(candidate.equals(fs.readFileSync(p.candidatePath)),'candidate not exact additive patch');check(sha(p.candidatePath)===p.candidateSha256,'candidate hash moved');
 }
 for(const file of ['examples/pages/processamento-opcoes-dependentes.html','examples/processamento-opcoes-dependentes.process.json','src/examples/process-dependent-options-example.js'])check(!fs.existsSync(path.join(repo,file)),'new example collides with canonical');
 check(!/\bfetch\s*\(|new\s+XMLHttpRequest|\.ajax\s*\(/.test(js),'example client performs HTTP');
 check(js.includes('dataset.exampleId !== "processamento-opcoes-dependentes"')&&js.includes('/\\/production\\//'),'example client missing production guard');
 const browser=await chromium.launch({headless:true,channel:'msedge'});
 try {
  const page=await browser.newPage({viewport:{width:1280,height:1000}}),errors=[],http=[],xhr=[];
  page.on('pageerror',e=>errors.push(e.message));page.on('request',r=>{if(/^https?:/.test(r.url()))http.push(r.url());if(['xhr','fetch'].includes(r.resourceType()))xhr.push(r.url());});
  await page.route(/^https?:/,r=>r.abort());
  await page.goto(pathToFileURL(state+'/stage/examples/pages/processamento-opcoes-dependentes.html').href);
  await page.waitForFunction(()=>window.processDependentOptionsExample);await page.evaluate(()=>processDependentOptionsExample.ready);
  const result=await page.evaluate(async()=>{
   const {engine:e,calls}=processDependentOptionsExample;
   const opening=calls.process.length,initial=calls.options[0],first=e.fieldWidgets.despesa_ids.dataSource.data().map(x=>x.value);
   const contextReadonly=e.fieldWidgets.container_id.element.prop('readonly')||e.fieldWidgets.container_id.element.prop('disabled');
   e.fieldWidgets.despesa_ids.value([101]);e.fieldWidgets.ordem_direcao.value('asc');e.fieldWidgets.ordem_direcao.trigger('change');const loadingBlocked=await e.execute();
   e.fieldWidgets.ordem_direcao.value('desc');e.fieldWidgets.ordem_direcao.trigger('change');await e.optionsPromise;await new Promise(resolve=>setTimeout(resolve,170));
   const final=e.fieldWidgets.despesa_ids.dataSource.data().map(x=>x.value),loading=e.optionsLoading;
   const cancel=e.execute();await Promise.resolve();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Cancelar').trigger('click');await cancel;const cancelCount=calls.process.length;
   const apply=e.execute();await Promise.resolve();$('.crud-confirm-content button').filter((_,b)=>$(b).text()==='Confirmar exemplo').trigger('click');await apply;
   return{opening,initial,first,contextReadonly,loadingBlocked,final,loading,cancelCount,processCount:calls.process.length,payload:calls.process[0],status:document.getElementById('dependent-options-status').textContent,output:document.getElementById('dependent-options-payload').textContent,culture:kendo.culture().name};
  });
  check(result.opening===0,'opening executed process');check(result.contextReadonly===true,'context editable');
  check(JSON.stringify(result.initial)===JSON.stringify({context:{container_id:900001},parameters:{ordem_campo:'ordem',ordem_direcao:'asc'}}),'initial parameters/context');
  check(JSON.stringify(result.first)==='[102,101,103]','default options order');check(result.loadingBlocked===false,'executed while options loading');
  check(JSON.stringify(result.final)==='[103,101,102]'&&!result.loading,'stale response replaced newer desc');
  check(result.cancelCount===0,'cancel executed process');check(result.processCount===1,'confirmation executed wrong count');
  check(result.payload.context.container_id===900001&&result.payload.parameters.container_id===900001&&result.payload.parameters.ordem_direcao==='desc'&&JSON.stringify(result.payload.parameters.despesa_ids)==='[101]','actual native process payload');
  check(result.status.includes('somente na memória')&&result.output.includes('900001'),'local output missing');check(result.culture==='pt-BR','culture');
  check(http.length===0&&xhr.length===0,'network/fetch/XHR attempted');check(errors.length===0,'page errors '+JSON.stringify(errors));
  await page.screenshot({path:state+'/example-desktop.png',fullPage:true});
  await page.setViewportSize({width:390,height:900});await page.screenshot({path:state+'/example-mobile.png',fullPage:true});
  check(await page.locator('h1').first().innerText()==='Processamento com opções dependentes','responsive title missing');
 } finally {await browser.close();}
 fs.writeFileSync(state+'/verification.json',JSON.stringify({success:true,checks,canonicalChanged:false,businessExecuted:false,productionClientChanged:false,httpRequests:0,xhrRequests:0,nativeProcessEngine:true,fullAjvSchema:true,localFilePage:true},null,2));
 console.log('PASS native local example/AJV/exact patches/async/context/confirmation/no network checks='+checks);
})().catch(e=>{console.error(e);process.exitCode=1;});
