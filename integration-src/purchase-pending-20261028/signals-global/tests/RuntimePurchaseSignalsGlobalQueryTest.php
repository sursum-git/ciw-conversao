<?php
declare(strict_types=1);
require __DIR__.'/patched-RuntimeCiwErpQuery.php';
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
use App\Runtime\{RuntimeCiwErpQuery,RuntimeHttpException};
$checks=0;
function check(bool $v):void{global $checks;if(!$v)throw new RuntimeException('Query assertion');$checks++;}
function definition(bool $detail):array{return ['entityCode'=>$detail?'proc_compra_sinalizados_med_progress':'proc_compra_sinalizadores_med_progress','primaryKey'=>'record_key','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'apiSource'=>['responseContract'=>'sursum-programs'],'fields'=>['record_key'=>['dataType'=>'string'],'sinaliz_imp_id'=>['dataType'=>'integer'],'nome_alerta'=>['dataType'=>'string'],'data_base'=>['dataType'=>'date']]];}
function endpoint(bool $detail):array{return ['url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','method'=>'POST','bodyTemplate'=>['operation'=>'read','resource'=>$detail?'proc_compra_sinalizados':'proc_compra_sinalizadores'],'requestContextFields'=>$detail?['sinaliz_imp_id']:[]];}
foreach([false,true]as $detail){
 check(RuntimeCiwErpQuery::supports(definition($detail)));
 $p=['take'=>20,'skip'=>200,'sort'=>[['field'=>'nome_alerta','dir'=>'desc']],'filter'=>['field'=>'nome_alerta','operator'=>'contains','value'=>'ação']];if($detail)$p['context']=['sinaliz_imp_id'=>'5'];
 $q=RuntimeCiwErpQuery::prepare(definition($detail),endpoint($detail),$p);check($q['skip']===200);check($q['take']===20);check($q['filter']['value']==='ação');check($detail?($q['sinaliz_imp_id']===5):!isset($q['sinaliz_imp_id']));
 foreach(['context','fields','sql','clock','route','resource','writer','oversize','group','sortKey']as $kind){$e=endpoint($detail);$p=$detail?['context'=>['sinaliz_imp_id'=>1]]:[];switch($kind){case 'context':$p['context']=['proc_compra_id'=>10];break;case 'fields':$e['requestContextFields']=['proc_compra_id'];break;case 'sql':$p['sql']='SELECT other';break;case 'clock':$p['today']='2000-01-01';break;case 'route':$e['url']='https://other.example/api';break;case 'resource':$e['bodyTemplate']['resource']='other';break;case 'writer':$e['bodyTemplate']['operation']='delete';break;case 'oversize':$p['take']=201;break;case 'group':$p['group']=[['field'=>'nome_alerta']];break;case 'sortKey':$p['sort']=[['field'=>'record_key','dir'=>'asc']];}
  try{RuntimeCiwErpQuery::prepare(definition($detail),$e,$p);throw new RuntimeException('Unsafe query accepted '.$kind);}catch(RuntimeHttpException $x){check($x->getStatusCode()===422);}
 }
}
foreach([[],['sinaliz_imp_id'=>0],['sinaliz_imp_id'=>'01']]as $c){try{RuntimeCiwErpQuery::prepare(definition(true),endpoint(true),['context'=>$c]);throw new RuntimeException('Invalid rule context');}catch(RuntimeHttpException $x){check($x->getStatusCode()===422);}}
echo "PASS global PHP query checks=$checks no DB/HTTP\n";
