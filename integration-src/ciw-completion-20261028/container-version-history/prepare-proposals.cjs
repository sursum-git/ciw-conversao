// Generates hash-guarded proposals only. Never writes a canonical checkout.
const fs=require('node:fs'),path=require('node:path'),cp=require('node:child_process'),crypto=require('node:crypto');
const pkg=__dirname,stage=path.resolve(pkg,'../../../.runtime/ciw-completion-20261028/container-version-history/stage');
fs.mkdirSync(stage,{recursive:true});fs.mkdirSync(path.join(pkg,'patches'),{recursive:true});
const baselines=[];
const auxiliary=fs.existsSync(path.join(pkg,'auxiliary-views.json'))?JSON.parse(fs.readFileSync(path.join(pkg,'auxiliary-views.json'),'utf8')):[];
const historicalEntities=['container_versoes_historico_med_progress',...auxiliary.map(v=>v.entity)];
function proposal(target,name,transform){
 const original=fs.readFileSync(target,'utf8'),updated=transform(original);
 if(original===updated)throw Error('Empty proposal '+name);
 const before=path.join(stage,name+'.baseline'),after=path.join(stage,name);
 fs.writeFileSync(before,original);fs.writeFileSync(after,updated);
 let r=cp.spawnSync('git',['diff','--no-index','--no-ext-diff','--',before,after],{encoding:'utf8'});
 if(![0,1].includes(r.status))throw Error(r.stderr);
 let diff=r.stdout.split('\n');diff[0]='diff --git a/'+name+' b/'+name;
 diff=diff.map(l=>l.startsWith('--- ')?'--- a/'+name:l.startsWith('+++ ')?'+++ b/'+name:l);
 fs.writeFileSync(path.join(pkg,'patches',name+'.patch'),diff.join('\n'));
 baselines.push({target,baselineSha256:crypto.createHash('sha256').update(fs.readFileSync(target)).digest('hex'),candidateSha256:crypto.createHash('sha256').update(updated).digest('hex'),patch:'patches/'+name+'.patch'});
}
function one(s,a,b){if(s.split(a).length!==2&&s.split(a.replace(/\n/g,'\r\n')).length===2){a=a.replace(/\n/g,'\r\n');b=b.replace(/\n/g,'\r\n');}if(s.split(a).length!==2)throw Error('Baseline anchor absent/nonunique: '+a.slice(0,80));return s.replace(a,b);}
proposal('D:/opencode/construtor-pg/backend/src/Runtime/RuntimeCiwErpQuery.php','RuntimeCiwErpQuery.php',s=>{
 s=one(s,"private const RESOURCES=[","private const RESOURCES=['container_versoes_historico_med_progress'=>'container_versoes_historico_med',");
 s=one(s,"if (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {","if (($d['entityCode']??null)==='container_versoes_historico_med_progress') {\n            if (($endpoint['requestContextFields']??null)!==['container_id','versao_id']) { self::invalid(); }\n            $context=ApiRequestContext::resolve($d,$endpoint,$payload);\n            unset($payload['context']);\n        } elseif (($d['entityCode']??null)==='proc_compra_sinalizados_med_progress') {");
 if(auxiliary.length){s=one(s,"private const RESOURCES=[","private const RESOURCES=["+auxiliary.map(v=>"'"+v.entity+"'=>'"+v.resource+"',").join(''));s=one(s,"if (($d['entityCode']??null)==='container_versoes_historico_med_progress') {","if (in_array($d['entityCode']??null,["+historicalEntities.map(e=>"'"+e+"'").join(',')+"],true)) {");}
 return s;
});
proposal('D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php','RuntimeApiEntityActionService.php',s=>{
 s=one(s,"        if (($definition['entityCode'] ?? null) === 'proc_compra_sinalizados_med_progress') {","        if (($definition['entityCode'] ?? null) === 'container_versoes_historico_med_progress') {\n            ApiRequestContext::assertRows($body['data'], ['container_id' => $query['container_id'], 'versao_id' => $query['versao_id']]);\n        }\n\n        if (($definition['entityCode'] ?? null) === 'proc_compra_sinalizados_med_progress') {");
 s=one(s,"        $id = $this->extractRecordId($definition, $payload);\n\n        $detailEndpoint", "        $id = $this->extractRecordId($definition, $payload);\n\n        if (($definition['entityCode'] ?? null) === 'container_versoes_historico_med_progress') {\n            foreach ([$payload, is_array($payload['record'] ?? null) ? $payload['record'] : []] as $submitted) {\n                foreach (['id','record_key'] as $alias) {\n                    if (array_key_exists($alias, $submitted) && (!is_string($submitted[$alias]) || !is_string($id) || $submitted[$alias] !== $id)) {\n                        throw new RuntimeHttpException('VERSION_HISTORY_KEY_INVALID', 'Identidade histórica conflitante.', 422);\n                    }\n                }\n            }\n        }\n\n        $detailEndpoint");
 if(auxiliary.length)s=s.replaceAll("(($definition['entityCode'] ?? null) === 'container_versoes_historico_med_progress')","(in_array($definition['entityCode'] ?? null, ["+historicalEntities.map(e=>"'"+e+"'").join(',')+"], true))");
 return s;
});
proposal('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionService.p','ContainersVersionService.p',s=>{
 s=one(s,'DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.','DEFINE VARIABLE rowsValue AS JsonArray NO-UNDO.\n/* Read-only public projection shares this persisted-snapshot collector. */\nDEFINE VARIABLE readRows AS INTEGER NO-UNDO.\nDEFINE VARIABLE readMaxRows AS INTEGER NO-UNDO INITIAL 50000.\nDEFINE VARIABLE readStarted AS INTEGER NO-UNDO.\nDEFINE VARIABLE readComplete AS LOGICAL NO-UNDO.');
 s=one(s,'  failureCode="VERSION_NOT_FOUND".\n  IF NOT phMaster:FIND-FIRST', '  readStarted=ETIME.\n  failureCode="VERSION_CONFIGURATION".\n  /* Trusted private policy may only lower the ceiling; HTTP never supplies it. */\n  IF VALID-OBJECT(poPolicy) THEN IF poPolicy:Has("read_max_rows") THEN DO:\n   IF poPolicy:GetType("read_max_rows")<>JsonDataType:NUMBER THEN UNDO, THROW NEW Progress.Lang.AppError("Orcamento privado invalido.",1).\n   IF poPolicy:GetDecimal("read_max_rows")<1 OR poPolicy:GetDecimal("read_max_rows")>50000 OR poPolicy:GetDecimal("read_max_rows")<>TRUNCATE(poPolicy:GetDecimal("read_max_rows"),0) THEN UNDO, THROW NEW Progress.Lang.AppError("Orcamento privado invalido.",1).\n   readMaxRows=poPolicy:GetInteger("read_max_rows").\n  END.\n  DO STOP-AFTER 10 ON STOP UNDO, LEAVE:\n  failureCode="VERSION_NOT_FOUND".\n  IF NOT phMaster:FIND-FIRST');
 s=one(s,'   RUN FindVersion(NO-LOCK).\n   poResponse:Add("data",JsonRecord(phVersions,versionFields)).','   RUN FindVersion(NO-LOCK).\n   RUN CheckReadBudget.\n   poResponse:Add("data",JsonRecord(phVersions,versionFields)).');
 s=one(s,'  poResponse:Add("success",TRUE). RETURN.\n END.\n failureCode="VERSION_TRANSACTION_CONTEXT".','  readComplete=TRUE.\n  END.\n  IF NOT readComplete THEN DO: failureCode="VERSION_READ_TIMEOUT". UNDO, THROW NEW Progress.Lang.AppError("Consulta historica excedeu 10 segundos.",1). END.\n  poResponse:Add("success",TRUE). RETURN.\n END.\n failureCode="VERSION_TRANSACTION_CONTEXT".');
 s=one(s,'DO WHILE NOT queryValue:QUERY-OFF-END: resultValue:Add(JsonRecord(phVersions,versionFields)). queryValue:GET-NEXT(). END.','DO WHILE NOT queryValue:QUERY-OFF-END: RUN CheckReadBudget. resultValue:Add(JsonRecord(phVersions,versionFields)). queryValue:GET-NEXT(). END.');
 s=one(s,'DO WHILE NOT queryValue:QUERY-OFF-END: resultValue:Add(JsonRecord(bufferValue,fieldsValue)). queryValue:GET-NEXT(). END.','DO WHILE NOT queryValue:QUERY-OFF-END: RUN CheckReadBudget. resultValue:Add(JsonRecord(bufferValue,fieldsValue)). queryValue:GET-NEXT(). END.');
 s=one(s,'PROCEDURE ChildRows:','PROCEDURE CheckReadBudget:\n /* CaptureSnapshot is also used by writers: their path is unchanged. */\n IF NOT Exact(operationValue,"consultar") THEN RETURN.\n readRows=readRows + 1.\n IF readRows>readMaxRows THEN DO: failureCode="VERSION_READ_LIMIT". UNDO, THROW NEW Progress.Lang.AppError("Consulta historica excedeu orcamento de registros.",1). END.\n IF ETIME - readStarted>10000 THEN DO: failureCode="VERSION_READ_TIMEOUT". UNDO, THROW NEW Progress.Lang.AppError("Consulta historica excedeu 10 segundos.",1). END.\nEND PROCEDURE.\nPROCEDURE ChildRows:');
 s=one(s,'IF tableNo=1 THEN itemFields ELSE "versao_id," + childFields[tableNo]', 'IF tableNo=1 THEN itemFields + (IF Exact(operationValue,"consultar") THEN ",qt_embarcada,vl_desconto_utiliz_real" ELSE "") ELSE "versao_id," + childFields[tableNo]');
 s=one(s,'VERSION_CONFIGURATION,VERSION_CALLBACK_UNAVAILABLE,VERSION_DISTRIBUTION_UNSUPPORTED','VERSION_CONFIGURATION,VERSION_CALLBACK_UNAVAILABLE,VERSION_DISTRIBUTION_UNSUPPORTED,VERSION_READ_LIMIT,VERSION_READ_TIMEOUT');
 return s;
});
const schema=JSON.parse(fs.readFileSync(path.resolve(pkg,'../../container-panel/schema/espec/schema-item_container_custos.json'),'utf8'));
const central=fs.readFileSync('D:/opencode/motor-progress/v2/sursum-api/programs/ContainersVersionService.p','utf8');
const fields=central.match(/ itemFields="([^"]+)"/)[1].split(',').concat(['qt_embarcada','vl_desconto_utiliz_real']);
const typed=fields.map(name=>{const f=schema.fields.find(f=>f.name===name);if(!f)throw Error('Missing schema '+name);return f;});
fs.mkdirSync(path.join(pkg,'includes'),{recursive:true});
fs.writeFileSync(path.join(pkg,'includes','ContainersVersionHistoryTable.i'),'DEFINE TEMP-TABLE ttVersionHistory NO-UNDO\n FIELD container_id AS INTEGER\n'+typed.map(f=>' FIELD '+f.name+' AS '+f.type.toUpperCase()+(f.type==='decimal'?' DECIMALS 10':'')).join('\n')+'\n INDEX pk IS PRIMARY UNIQUE item_container_custo_id.\n');
proposal('D:/opencode/motor-progress/v2/sursum-api/programs/CiwErpReadService.p','CiwErpReadService.p',s=>one(s," CASE pcResource:\n"," CASE pcResource:\n  WHEN 'container_versoes_historico_med' THEN ASSIGN\n   cFieldList='container_id,"+fields.join(',')+"'\n   cAliasList=cFieldList cKeyList='container_id,versao_id,item_container_custo_id' baseWhere='TRUE'.\n"+auxiliary.map(v=>"  WHEN '"+v.resource+"' THEN ASSIGN cFieldList='container_id,"+v.fields+"' cAliasList=cFieldList cKeyList='"+v.keys+"' baseWhere='TRUE'.\n").join('')));
proposal('D:/opencode/motor-progress/v2/sursum-api/programs/CiwCadastrosCrud.p','CiwCadastrosCrud.p',s=>one(s,' CASE cResource:\n',' CASE cResource:\n  WHEN "container_versoes_historico_med" THEN DO:\n   cService=SEARCH("sursum-api/programs/ContainersVersionHistoryApi.r").\n   IF cService=? THEN UNDO, THROW NEW Progress.Lang.AppError("Historical version API unavailable",1).\n   RUN VALUE(cService)(poRequest,OUTPUT poResponse). RETURN.\n  END.\n'+(auxiliary.length?'  '+auxiliary.map(v=>'WHEN "'+v.resource+'"').join(' OR ')+' THEN DO:\n   cService=SEARCH("sursum-api/programs/ContainersVersionAuxHistoryApi.r").\n   IF cService=? THEN UNDO, THROW NEW Progress.Lang.AppError("Historical auxiliary API unavailable",1).\n   RUN VALUE(cService)(poRequest,OUTPUT poResponse). RETURN.\n  END.\n':'')));
fs.writeFileSync(path.join(pkg,'baselines.json'),JSON.stringify({status:'PROPOSED_NOT_APPLIED',baselines},null,2)+'\n');
console.log(JSON.stringify({status:'PROPOSALS_ONLY',proposals:baselines.length}));
