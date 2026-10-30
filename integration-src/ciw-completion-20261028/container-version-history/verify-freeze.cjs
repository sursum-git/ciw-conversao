const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');
const pkg=__dirname,version=process.argv[2]||'v3',root=path.join(pkg,'frozen-'+version),sha=b=>crypto.createHash('sha256').update(b).digest('hex');
const manifest=JSON.parse(fs.readFileSync(path.join(root,'manifest.json'),'utf8'));
const mismatches=manifest.files.filter(f=>sha(fs.readFileSync(path.join(root,f.path)))!==f.sha256).map(f=>f.path);
const baselines=JSON.parse(fs.readFileSync(path.join(root,'baselines.json'),'utf8')).baselines.map(b=>({target:b.target,baselineSha256:b.baselineSha256,currentSha256:sha(fs.readFileSync(b.target)),matchesOriginal:sha(fs.readFileSync(b.target))===b.baselineSha256}));
const receipt={status:mismatches.length?'FAIL':'FROZEN_HASHES_PASS',version,manifestSha256:sha(fs.readFileSync(path.join(root,'manifest.json'))),files:manifest.files.length,mismatches,baselines,executionScope:{canonicalWrites:false,remoteCompile:false,publication:false,grants:false,ddl:false,businessWrites:false},gates:manifest.remaining};
const privateRoot=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history');fs.writeFileSync(path.join(privateRoot,'verification-'+version+'.json'),JSON.stringify(receipt,null,2)+'\n');
console.log(JSON.stringify({status:receipt.status,version,files:receipt.files,manifestSha256:receipt.manifestSha256,canonicalBaselinesEqual:baselines.filter(b=>b.matchesOriginal).length,canonicalBaselinesTotal:baselines.length},null,2));if(mismatches.length)process.exitCode=1;
