// Sela apenas evidências privadas e hashes; não conecta ao Builder nem ao PASOE.
const c=require('./purchase-payments-builder-common.cjs');
const filename=c.path.join(c.state,'builder-publication-gates.json');
c.assert.ok(!c.fs.existsSync(filename)||!c.readJson(filename).ready,'GATES_ALREADY_SEALED');
const mapping={officialCompile:'official-compile-verification.json',canonicalManifest:'canonical-manifest.json',activeManifest:'active-manifest.json',pasoeProof:'pasoe-read-proof.json',phpSuite:'php-canonical-full.log',phpCanonicalManifest:'php-canonical-manifest.json',metadataCanonicalManifest:'metadata-canonical-manifest.json',metadataPhp:'metadata-php-receipt.json',metadataJs:'metadata-js-receipt.json'};
const gate={ready:false,origin:'MED',officialVersion:'12.2',metadata:{}};
for(const [key,file] of Object.entries(mapping)){const absolute=c.path.join(c.state,file);gate[key]={path:file,sha256:c.fs.existsSync(absolute)?c.sha(absolute):null};}
for(const file of c.fs.readdirSync(c.meta).filter(x=>x.endsWith('.json')).sort())gate.metadata[file]=c.sha(c.path.join(c.meta,file));
if(process.argv.includes('--seal')){c.assert.ok(Object.values(mapping).every(file=>c.fs.existsSync(c.path.join(c.state,file))),'REQUIRED_EVIDENCE_MISSING');gate.ready=true;}
c.save('builder-publication-gates.json',gate);
if(gate.ready){try{require('./publish-purchase-payments-builder.cjs').guards();}catch(error){gate.ready=false;c.save('builder-publication-gates.json',gate);throw error;}}
console.log(gate.ready?'PASS: evidências seladas; nenhuma publicação executada.':'PREPARED: guardas ainda não seladas; nenhuma publicação executada.');
