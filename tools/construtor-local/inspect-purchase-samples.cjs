const c=require('./purchase-samples-metadata-common.cjs');
c.session(async({api,runtime})=>{
 const bootstrap=await api('/bootstrap'),source=(await api('/api-sources/motor_progress_ciw_cadastros')).apiSource;
 const item=await runtime('ciw.proc-compra-itens'),parent=await runtime('ciw.processos-compra-med');
 const used=new Set(bootstrap.programs.map(x=>x.programCode??x.code));
 c.assert.equal(source.responseContract,'sursum-programs');c.assert.equal(source.baseUrl,'http://127.0.0.1:19910/med/web');
 const programCode=Array.from({length:80},(_,i)=>'op'+(1015+i)).find(code=>!used.has(code));c.assert.ok(programCode,'NO_AVAILABLE_PROGRAM_CODE');c.assert.ok(!bootstrap.entities.some(x=>x.code==='proc_compra_amostras_progress'),'ENTITY_COLLISION');
 c.save('catalog-snapshot.json',{bootstrap,source:{code:source.code,baseUrl:source.baseUrl,responseContract:source.responseContract,operations:source.operations},item,parent});
 c.save('preflight.json',{success:true,programAvailable:true,programCode,sourceOperations:source.operations.length,itemVersion:item.program.version,parentVersion:parent.program.version,businessWrites:false});
 console.log('PASS read-only catalog: '+programCode+' available; existing source '+source.operations.length+' operations; item'+item.program.version);
}).catch(e=>{console.error(e.message);process.exitCode=1;});
