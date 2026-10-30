<?php
declare(strict_types=1);
// Contrato em memória: executa os métodos privados canônicos, sem HTTP/DB/escrita de negócio.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root='D:/opencode/conversao-sc';
$draft=json_decode(file_get_contents($root.'/integration-src/purchase-payments/metadata/proc-compra-pagamentos-builder-draft.json'),true,flags:JSON_THROW_ON_ERROR);
$check=static function(bool $ok,string $message):void{if(!$ok)throw new RuntimeException($message);};
$fields=[];
foreach($draft['entityDraft']['fields'] as $field)$fields[$field['code']]=['code'=>$field['code'],'dataType'=>$field['dataType'],'readonly'=>$field['options']['readonly']??$field['readonlyField'],'primaryKey'=>$field['primaryKey'],'writePath'=>$field['apiWritePath'],'collection'=>($field['options']['api']['collection']['itemType']??null)==='integer'];
$endpoint=['method'=>'POST','requestContextFields'=>['proc_compra_id'],'bodyTemplate'=>['operation'=>'create','resource'=>'proc_compra_pagamentos']];
$definition=['fields'=>$fields];
$input=['record'=>['titulos'=>[1,2],'proc_compra_id'=>2147000104],'context'=>['proc_compra_id'=>2147000104]];
$class=new ReflectionClass(App\Runtime\RuntimeApiEntityActionService::class);$runtime=$class->newInstanceWithoutConstructor();
$record=$class->getMethod('extractSubmittedRecord')->invoke($runtime,$input);
$payload=$class->getMethod('buildWritePayload')->invoke($runtime,$definition,$record,false);
$context=App\Runtime\ApiRequestContext::resolve($definition,$endpoint,$input);App\Runtime\ApiRequestContext::assertRows([$record+$context],$context);
$payload=array_replace($payload,$context);
$actual=$class->getMethod('mergeRequestPayload')->invoke($runtime,$endpoint['bodyTemplate'],$payload);
$expected=['operation'=>'create','resource'=>'proc_compra_pagamentos','values'=>['titulos'=>[1,2]],'proc_compra_id'=>2147000104];
$check($actual===$expected,'buildWritePayload deve gerar values.titulos e proc_compra_id na raiz');
$check($fields['titulos']['writePath']==='values.titulos','JSON deve declarar apiWritePath values.titulos');
$check(!array_key_exists('proc_compra_id',$actual['values']),'Contexto do processo nao pode ficar aninhado em values');
file_put_contents($root.'/.runtime/purchase-payments-20261022/metadata-write-payload-contract.json',json_encode(['success'=>true,'checks'=>3,'canonicalPrivateMethods'=>['extractSubmittedRecord','buildWritePayload','mergeRequestPayload'],'canonicalContextResolver'=>true,'rootContext'=>true,'nestedIntegerCollection'=>true,'networkRequests'=>false,'databaseWrites'=>false,'businessWrites'=>false],JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT));
echo "PASS: JSON path e payload canônico values.titulos/contexto raiz, sem HTTP/DB.\n";
