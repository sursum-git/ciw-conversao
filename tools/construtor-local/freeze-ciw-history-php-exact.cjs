// Reproduce precisely the two v1.1/v1.3 transforms, preserving mixed line endings.
const fs=require('node:fs'),path=require('node:path'),crypto=require('node:crypto');
const root='D:/opencode/conversao-sc/integration-src/ciw-completion-20261028/container-version-history';
const frozen=path.join(root,'frozen-v1.3'),output=path.join(root,'frozenphp-exact');
const baselines=JSON.parse(fs.readFileSync(path.join(frozen,'baselines.json'),'utf8')).baselines;
const sha=b=>crypto.createHash('sha256').update(b).digest('hex');
function one(s,a,b){if(s.split(a).length!==2&&s.split(a.replace(/\n/g,'\r\n')).length===2){a=a.replace(/\n/g,'\r\n');b=b.replace(/\n/g,'\r\n');}if(s.split(a).length!==2)throw Error('Missing/nonunique exact anchor');return s.replace(a,b);}
const transforms={
 'RuntimeCiwErpQuery.php':s=>{
  s=one(s,"private const RESOURCES=[","private const RESOURCES=['container_versoes_historico_med_progress'=>'container_versoes_historico_med',");
  return one(s,"if (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {","if (($d['entityCode']??null)==='container_versoes_historico_med_progress') {\n            if (($endpoint['requestContextFields']??null)!==['container_id','versao_id']) { self::invalid(); }\n            $context=ApiRequestContext::resolve($d,$endpoint,$payload);\n            unset($payload['context']);\n        } elseif (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {");
 },
 'RuntimeApiEntityActionService.php':s=>{
  s=one(s,"        if (($definition['entityCode'] ?? null) === 'proc_compra_sinalizados_med_progress') {","        if (($definition['entityCode'] ?? null) === 'container_versoes_historico_med_progress') {\n            ApiRequestContext::assertRows($body['data'], ['container_id' => $query['container_id'], 'versao_id' => $query['versao_id']]);\n        }\n\n        if (($definition['entityCode'] ?? null) === 'proc_compra_sinalizados_med_progress') {");
  return one(s,"        $id = $this->extractRecordId($definition, $payload);\n\n        $detailEndpoint", "        $id = $this->extractRecordId($definition, $payload);\n\n        if (($definition['entityCode'] ?? null) === 'container_versoes_historico_med_progress') {\n            foreach ([$payload, is_array($payload['record'] ?? null) ? $payload['record'] : []] as $submitted) {\n                foreach (['id','record_key'] as $alias) {\n                    if (array_key_exists($alias, $submitted) && (!is_string($submitted[$alias]) || !is_string($id) || $submitted[$alias] !== $id)) {\n                        throw new RuntimeHttpException('VERSION_HISTORY_KEY_INVALID', 'Identidade histórica conflitante.', 422);\n                    }\n                }\n            }\n        }\n\n        $detailEndpoint");
 }
};
if(fs.existsSync(output))throw Error('Refuse to replace frozenphp-exact');
const files=[];
for(const [name,transform]of Object.entries(transforms)){
 const b=baselines.find(x=>x.target.endsWith('/'+name)),original=fs.readFileSync(b.target);
 if(sha(original)!==b.baselineSha256)throw Error('Canonical baseline changed '+name);
 const updated=Buffer.from(transform(original.toString('utf8')),'utf8');
 if(sha(updated)!==b.candidateSha256)throw Error('Exact candidate mismatch '+name+' '+sha(updated));
 files.push({name,bytes:updated,sha256:sha(updated),baselineSha256:b.baselineSha256});
}
fs.mkdirSync(output);
for(const f of files)fs.writeFileSync(path.join(output,f.name),f.bytes);
const manifest={state:'FROZEN_EXACT_V1_3_PHP',sourceFreezeSha256:sha(fs.readFileSync(path.join(frozen,'manifest.json'))),files:files.map(({bytes,...f})=>f),canonicalChanged:false,auxiliaryEntitiesAdded:false};
fs.writeFileSync(path.join(output,'manifest.json'),JSON.stringify(manifest,null,2)+'\n');
console.log(JSON.stringify({output,files:manifest.files,manifestSha256:sha(fs.readFileSync(path.join(output,'manifest.json')))}));
