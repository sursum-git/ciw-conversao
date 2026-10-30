<?php
declare(strict_types=1);
$root=__DIR__;
foreach(['php','patches','metadata'] as $dir){if(!is_dir("$root/$dir")){mkdir("$root/$dir",0777,true);}}
$path='D:/opencode/construtor-pg/backend/src/Runtime/RuntimeCiwCadastroAudit.php';
$before=file_get_contents($path);$after=$before;
$auditEdits=[];
$needle="  'formatos_amostra'=>";
$added="  'sinalizadores_importacao'=>['sinaliz_imp_id',['sinaliz_imp_id'=>'integer','nome'=>'string','titulo'=>'string','descricao'=>'string','qt_dias_alerta'=>'integer'],['nome'=>100,'titulo'=>300,'descricao'=>600]],\n";
$auditEdits[]=['find'=>$needle,'replace'=>$added.$needle];
$after=str_replace($needle,$added.$needle,$after,$count);if($count!==1){throw new RuntimeException('profile anchor');}
$needle="   \$body=\$endpoint['bodyTemplate']??null;";
$added="   if(\$name==='sinalizadores_importacao'&&\$operation!=='update')return null;\n";
$auditEdits[]=['find'=>$needle,'replace'=>$added.$needle];
$after=str_replace($needle,$added.$needle,$after,$count);if($count!==1){throw new RuntimeException('operation anchor');}
$needle="if(\$type==='string'&&(!is_string(\$value)||mb_strlen(\$value)>\$maxLength))return false;";
$replacement="if(\$type==='string'&&(!is_string(\$value)||mb_strlen(\$value)>(is_array(\$maxLength)?(\$maxLength[\$name]??0):\$maxLength)))return false;";
$auditEdits[]=['find'=>$needle,'replace'=>$replacement];
$after=str_replace($needle,$replacement,$after,$count);if($count!==1){throw new RuntimeException('length anchor');}
file_put_contents("$root/php/RuntimeCiwCadastroAudit.php",$after);
$patches=[['target'=>$path,'baselineSha256'=>hash('sha256',$before),'candidate'=>'php/RuntimeCiwCadastroAudit.php','candidateSha256'=>hash('sha256',$after),'replacements'=>[['find'=>"  'formatos_amostra'=>",'replace'=>$added]]]];
$dispatcher='D:/opencode/motor-progress/v2/sursum-api/programs/CiwCadastrosCrud.p';
$baseline=file_get_contents($dispatcher);
$anchor='  WHEN "formatos_amostra" THEN DO:';
$insert=<<<'ABL'
  WHEN "sinalizadores_importacao" THEN DO:
   cService=SEARCH("sursum-api/programs/PurchaseSignalConfigApi.r").
   IF cService=? THEN UNDO,THROW NEW Progress.Lang.AppError("Sinalizadores indisponiveis",0).
   RUN VALUE(cService)(INPUT poRequest,OUTPUT poResponse).
   RETURN.
  END.
ABL;
if(substr_count($baseline,$anchor)!==1){throw new RuntimeException('dispatcher anchor');}
$patches[]=['target'=>$dispatcher,'baselineSha256'=>hash('sha256',$baseline),'anchor'=>$anchor,'insertBefore'=>$insert."\n"];
$patches[0]['replacements']=$auditEdits;
$actionPath='D:/opencode/construtor-pg/backend/src/Runtime/RuntimeApiEntityActionService.php';
$actionBefore=file_get_contents($actionPath);
$find="['empresas', 'tipos_anexo', 'coloracoes', 'situacoes_container', 'tipos_versao_custo', 'motivos_desconto', 'formatos_amostra']";
$replace="['empresas', 'tipos_anexo', 'coloracoes', 'situacoes_container', 'tipos_versao_custo', 'motivos_desconto', 'formatos_amostra', 'sinalizadores_importacao']";
$actionAfter=str_replace($find,$replace,$actionBefore,$count);if($count!==1){throw new RuntimeException('closed snapshot envelope anchor');}
file_put_contents("$root/php/RuntimeApiEntityActionService.php",$actionAfter);
$patches[]=['target'=>$actionPath,'baselineSha256'=>hash('sha256',$actionBefore),'candidate'=>'php/RuntimeApiEntityActionService.php','candidateSha256'=>hash('sha256',$actionAfter),'replacements'=>[['find'=>$find,'replace'=>$replace]]];
file_put_contents("$root/patches/integration.json",json_encode(['status'=>'CANDIDATE_NOT_APPLIED','patches'=>$patches],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
$template=json_decode(file_get_contents('D:/opencode/conversao-sc/integration-src/purchase-sample-formats/metadata/formatos-amostra-builder-draft.json'),true,512,JSON_THROW_ON_ERROR);
$entity=&$template['entityDraft'];$program=&$template['programDraft'];
$entity['code']='sinalizadores_importacao_progress';$entity['name']='Sinalizadores de importação';$entity['structureBaseNumber']=110;
foreach(['List'=>'read','Detail'=>'get','Update'=>'update'] as $part=>$op){$entity['api'.$part.'OperationCode']='sinalizadores_importacao_'.$op;}
foreach(['Create','Delete','Batch'] as $part){unset($entity['api'.$part.'OperationCode']);}
$entity['fields']=[];
$fields=['sinaliz_imp_id'=>['Código','integer',null],'nome'=>['Nome','string',100],'titulo'=>['Título','string',300],'descricao'=>['Descrição','string',600],'qt_dias_alerta'=>['Dias para alerta','integer',null]];
$position=0;
foreach($fields as $code=>[$label,$type,$length]){
 $key=$code==='sinaliz_imp_id';$field=['code'=>$code,'label'=>$label,'dataType'=>$type,'primaryKey'=>$key,'required'=>false,'readonlyField'=>$key,'position'=>($position+=10),'apiJsonPath'=>$code,'apiWritePath'=>$code,'apiShowInGrid'=>true,'apiShowInForm'=>true,'apiShowInFilter'=>true,'options'=>['readonly'=>$key,'writable'=>!$key]];
 if($length!==null){$field['length']=$length;}if($type==='integer'){$field['options']+=['decimals'=>0,'format'=>'n0'];}if($code==='descricao'){$field['options']['editor']='textarea';}
 if(in_array($code,['nome','titulo'],true)){$field['required']=true;}
 if($code==='qt_dias_alerta'){$field['options']+=['min'=>0,'max'=>9999];}
 $entity['fields'][]=$field;
}
$program['programCode']='cd0110';$program['programTitle']='Sinalizadores de importação';$program['builderEntityCode']=$entity['code'];$program['screenId']='ciw.sinalizadores-importacao';$program['gridEditMode']='form';
$program['allowCreate']=false;$program['allowDelete']=false;$program['permissionPrefix']=$entity['code'];$program['subtitle']='Configuração das cinco regras de alerta de importação.';
$program['crudOptions']['defaultSort']=[['field'=>'sinaliz_imp_id','dir'=>'asc']];$program['crudOptions']['gridFields']=array_map(fn($f)=>['field'=>$f],array_keys($fields));$program['crudOptions']['filterFields']=array_keys($fields);
$program['formOptions']['tabs'][0]['sections'][0]=['id'=>'sinalizador','title'=>'Sinalizador','columns'=>2,'fields'=>array_keys($fields)];
file_put_contents("$root/metadata/sinalizadores-importacao-builder-draft.json",json_encode($template,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
$ops=[];foreach(['read'=>'list','get'=>'detail','update'=>'update'] as $op=>$type){$v=['code'=>'sinalizadores_importacao_'.$op,'name'=>'Sinalizadores de importação — '.$op,'type'=>$type,'method'=>'POST','path'=>'/SursumPrograms/ciw-cadastros','bodyTemplate'=>['operation'=>$op,'resource'=>'sinalizadores_importacao']];if($op==='read'){$v+=['itemsPath'=>'data','totalPath'=>'total'];}if($op==='get'){$v['itemPath']='data';}$ops[]=$v;}
file_put_contents("$root/metadata/api-source-additions.json",json_encode(['sourceCode'=>'motor_progress_ciw_cadastros','operations'=>$ops],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
echo "Prepared candidate only\n";
