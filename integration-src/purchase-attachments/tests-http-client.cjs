const fs=require('fs'),vm=require('vm'),assert=require('assert/strict');
class File extends Blob {constructor(parts,name,options){super(parts,options);this.name=name;}}
const calls=[];const sandbox={location:{href:'http://127.0.0.1:8765/production/app.html',search:'',protocol:'http:'},URL,URLSearchParams,FormData,File,Blob,crypto:require('crypto').webcrypto,fetch:async(url,options)=>{calls.push({url,options});return {ok:true,text:async()=>'{"ok":true}',blob:async()=>new Blob(['bytes']),headers:{get:()=>null}}}};sandbox.window=sandbox;
vm.runInNewContext(fs.readFileSync(__dirname+'/frontend/CrudHttpClient.js','utf8'),sandbox);
(async()=>{
 const client=new sandbox.CrudHttpClient({authToken:'private-test-token',userId:'test',sessionId:'session',tenantId:'t'});
 const file=new File(['%PDF-1.4'],'teste.pdf',{type:'application/pdf'});const url='/api/runtime/screens/ciw.proc-compra-anexos/endpoints/create';
 const token=client.registerFile('arquivo_upload',file,[url]);assert.match(token,/^local-file:[a-f0-9]{32}$/);assert.equal(calls.length,0,'Selecting a file must not upload');
 await client.request({url,method:'POST',data:{record:{arquivo_upload:token},context:{proc_compra_id:1,item_proc_compra_id:2}}});
 assert(calls[0].options.body instanceof FormData);assert.equal(calls[0].options.headers['Content-Type'],undefined);assert.equal(calls[0].options.headers['X-Runtime-Auth-Token'],'private-test-token');assert.equal(calls[0].options.body.get('arquivo_upload').name,'teste.pdf');assert.equal(JSON.parse(calls[0].options.body.get('payload')).record.arquivo_upload,token);
 await assert.rejects(()=>client.request({url:'/other',method:'POST',data:{record:{arquivo_upload:token}}}));assert.equal(calls.length,1,'Wrong endpoint must not upload');
 client.releaseFile(token);assert.equal(client.registeredFile(token),null);await assert.rejects(()=>client.request({url,method:'POST',data:{record:{arquivo_upload:token}}}));assert.equal(calls.length,1);
 await client.request({url:'/normal',method:'POST',data:{id:2}});assert.equal(calls[1].options.body,'{"id":2}');
 const blob=await client.download({url:'/api/runtime/screens/ciw.proc-compra-anexos/endpoints/download',data:{id:2}});assert.equal(await blob.text(),'bytes');assert.equal(calls[2].options.method,'POST');assert(!calls[2].url.includes('private-test-token'));
 console.log('PASS: native multipart selection, endpoint binding, cancellation, JSON compatibility and authenticated binary download');
})().catch(e=>{console.error(e);process.exitCode=1;});
