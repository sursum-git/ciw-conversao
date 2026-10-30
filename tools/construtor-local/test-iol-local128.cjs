/* Uses an isolated local database, never a network or ERP database. No deployment. */
'use strict';
const fs=require('node:fs'),path=require('node:path'),cp=require('node:child_process'),crypto=require('node:crypto');
const root=path.resolve(__dirname,'../..'),src=path.join(root,'integration-src/iol-pagina-inicial-gerencial');
const job=path.join(root,'.runtime/iol-engine-20261019/local128full');
fs.mkdirSync(job,{recursive:true});fs.mkdirSync(path.join(job,'aggregate-fixture'),{recursive:true});
for(const f of fs.readdirSync(src))if(/\.(p|i|json)$/.test(f))fs.copyFileSync(path.join(src,f),path.join(job,f));
for(const f of fs.readdirSync(path.join(src,'tests128')))fs.copyFileSync(path.join(src,'tests128',f),path.join(job,f));
const include=path.join(job,'sursum-api/includes');fs.mkdirSync(include,{recursive:true});
fs.copyFileSync('D:/opencode/motor-progress/v2/sursum-api/includes/parametros_ima.i',path.join(include,'parametros_ima.i'));
const tables=JSON.parse(fs.readFileSync(path.join(src,'schema/iol-schema.json')));
tables.push({table:'espec.restrs_clientes_usuario',fields:[{name:'login',type:'character'},{name:'ind_segur_cli_ativo',type:'integer'},{name:'restrs_clientes_usuario_id',type:'integer'}]},
 {table:'espec.repres_restr_cliente_usuario',fields:[{name:'restr_cliente_usuario_id',type:'integer'},{name:'cod_repres',type:'integer'}]});
let df='';for(const t of tables){const n=t.table.split('.')[1];df+=`ADD TABLE "${n}"\n  AREA "Schema Area"\n`;for(const f of t.fields){df+=`ADD FIELD "${f.name}" OF "${n}" AS ${f.type}\n`;if(f.type==='decimal')df+='  DECIMALS 10\n';if(f.extent)df+=`  EXTENT ${f.extent}\n`;}}
df+='ADD INDEX "primario" ON "im-param"\n  UNIQUE\n  PRIMARY\n  INDEX-FIELD "cod-param" ASCENDING\n.\n';
fs.writeFileSync(path.join(job,'aggregate-fixture.df'),df);
const dfHash=crypto.createHash('sha256').update(df).digest('hex');
const db=path.join(job,'aggregate-fixture/espec'),stamp=path.join(job,'fixture-schema.sha256');
const exe='C:/Progress/OpenEdge/bin/_progres.exe';
function exec(file,args,log,allowed=[0]){const r=cp.spawnSync(file,args,{cwd:job,encoding:'utf8',timeout:90000});fs.writeFileSync(path.join(job,log),(r.stdout||'')+(r.stderr||''));if(r.error)throw r.error;if(!allowed.includes(r.status))throw Error(log+' exit='+r.status);}
if(!fs.existsSync(db+'.db')){
 exec('C:/Progress/OpenEdge/bin/prodb.exe',['aggregate-fixture/espec','C:/Progress/OpenEdge/empty8'],'create-fixture.log');
 exec(exe,['-b','-1','-db','aggregate-fixture/espec','-ld','espec','-p','LoadFixture.p','-cpinternal','UTF-8','-cpstream','UTF-8'],'load-fixture.log');
 if(fs.readFileSync(path.join(job,'load-fixture.log'),'utf8').trim())throw Error('Fixture load reported diagnostics');
 fs.writeFileSync(stamp,dfHash);
}else if(!fs.existsSync(stamp)||fs.readFileSync(stamp,'utf8')!==dfHash)throw Error('Existing fixture schema differs; refusing to overwrite database');
for(const f of fs.readdirSync(job))if(/\.r$/.test(f)||/^(aggregate128|engine-policy|identity|calculator|boundary|collector-parity|parameter-install)-.*\.log$/.test(f))fs.unlinkSync(path.join(job,f));
exec(exe,['-b','-1','-db','aggregate-fixture/espec','-ld','espec','-p','InstallIolEngineParameter.p','-cpinternal','UTF-8','-cpstream','UTF-8'],'parameter-no-confirmation.log',[0,2]);
if(!fs.readFileSync(path.join(job,'parameter-no-confirmation.log'),'utf8').includes('IOL_PARAMETER_INSTALL_CONFIRMATION_REQUIRED'))throw Error('Unconfirmed install was not rejected');
exec(exe,['-b','-1','-db','aggregate-fixture/espec','-ld','espec','-p','RunLocal128.p','-param','install-iol-engine-12.2','-cpinternal','UTF-8','-cpstream','UTF-8'],'local128-process.log');
const build=fs.readFileSync(path.join(job,'local128-build.log'),'utf8');
if(!build.includes('PASS LOCAL128')||build.includes('FAIL')||build.includes('error=yes'))throw Error(build);
if(!fs.readFileSync(path.join(job,'compile-iol128.log'),'utf8').includes('PASS COMPILE128'))throw Error('Future compiler helper failed');
const evidence={at:new Date().toISOString(),scope:'isolated local OE12.8 database; not PASOE; not publishable on OE12.2',schemaSha256:dfHash,tests:[]};
for(const culture of ['AMERICAN','EUROPEAN'])for(const prefix of ['aggregate128','engine-policy','identity','calculator','boundary','collector-parity','parameter-install']){
 const text=fs.readFileSync(path.join(job,`${prefix}-${culture}.log`),'utf8');if(!text.includes('PASS')||text.includes('FAIL'))throw Error(text);evidence.tests.push({culture,result:text.trim()});
}
fs.writeFileSync(path.join(job,'verification.json'),JSON.stringify(evidence,null,2));console.log(JSON.stringify(evidence,null,2));
