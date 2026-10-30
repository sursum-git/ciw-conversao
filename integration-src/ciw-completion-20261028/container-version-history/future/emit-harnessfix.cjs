const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');
const pkg=path.resolve(__dirname,'..'),source=path.join(pkg,'frozen-v1.1'),dest=path.join(pkg,'frozen-v1.2');
const sha=b=>crypto.createHash('sha256').update(b).digest('hex');
if(sha(fs.readFileSync(path.join(source,'manifest.json')))!=='98e74bc5d224e71fcb8f2437421d6da2171a22feb65cd41a2adf76667e12d2f7')throw Error('Frozen1.1 baseline changed');
if(fs.existsSync(dest))throw Error('Never overwrite frozen snapshot');fs.mkdirSync(dest);
const manifest=JSON.parse(fs.readFileSync(path.join(source,'manifest.json'),'utf8'));
for(const f of manifest.files){const from=path.join(source,f.path),to=path.join(dest,f.path);if(sha(fs.readFileSync(from))!==f.sha256)throw Error('Source file drift '+f.path);fs.mkdirSync(path.dirname(to),{recursive:true});fs.copyFileSync(from,to);}
const test='tests/abl/ContainersVersionHistoryTest.p',file=path.join(dest,test);let s=fs.readFileSync(file,'utf8');const anchor='parser=NEW ObjectModelParser(). textValue=keyValue. policyValue=CAST(parser:Parse(textValue),JsonObject).';if(s.split(anchor).length!==2)throw Error('Test anchor drift');s=s.replace(anchor,"FIX-CODEPAGE(textValue)='UTF-8'.\n"+anchor);fs.writeFileSync(file,s);
manifest.version='v1.2';manifest.harnessOnlyFix='FIX-CODEPAGE(textValue)=UTF-8 before ObjectModelParser; production files identical to frozen-v1.1';for(const f of manifest.files)f.sha256=sha(fs.readFileSync(path.join(dest,f.path)));
fs.writeFileSync(path.join(dest,'manifest.json'),JSON.stringify(manifest,null,2)+'\n');console.log(JSON.stringify({snapshot:dest,manifestSha256:sha(fs.readFileSync(path.join(dest,'manifest.json'))),onlyChangedFile:test},null,2));
