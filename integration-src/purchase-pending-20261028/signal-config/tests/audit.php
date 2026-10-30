<?php
declare(strict_types=1);
require $argv[1];
use App\Runtime\RuntimeCiwCadastroAudit as Audit;
$checks=0;
function check(bool $ok,string $why):void {global $checks;++$checks;if(!$ok){throw new RuntimeException($why);}}
$d=['entityCode'=>'sinalizadores_importacao_progress','primaryKey'=>'sinaliz_imp_id','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'fields'=>[]];
$types=['sinaliz_imp_id'=>'integer','nome'=>'string','titulo'=>'string','descricao'=>'string','qt_dias_alerta'=>'integer'];
foreach($types as $key=>$type){$d['fields'][$key]=['code'=>$key,'dataType'=>$type,'jsonPath'=>$key,'collection'=>false];}
$e=['method'=>'POST','url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/ciw-cadastros','bodyTemplate'=>['resource'=>'sinalizadores_importacao','operation'=>'update']];
check(Audit::supports($d),'signal config must use native audit');
check(Audit::resource($d,$e,'update')==='sinalizadores_importacao','fixed update binding');
foreach(['create','delete','batch','read'] as $op){$bad=$e;$bad['bodyTemplate']['operation']=$op;check(Audit::resource($d,$bad,$op)===null,'only update audited for config');}
foreach(['https://other.invalid/SursumPrograms/ciw-cadastros','https://192.168.0.111:9921/med/web/SursumPrograms/ciw-cadastros'] as $url){$bad=$e;$bad['url']=$url;check(Audit::resource($d,$bad,'update')===null,'fixed MED route');}
$row=['sinaliz_imp_id'=>1,'nome'=>'historico','titulo'=>'Titulo','descricao'=>'Descricao','qt_dias_alerta'=>10];
check(Audit::validSnapshot($d,$row,'sinalizadores_importacao'),'full five field image');
check(Audit::validSnapshot($d,[],'sinalizadores_importacao'),'empty snapshot semantics preserved');
foreach(['nome'=>100,'titulo'=>300,'descricao'=>600] as $key=>$limit){$v=$row;$v[$key]=str_repeat('a',$limit);check(Audit::validSnapshot($d,$v,'sinalizadores_importacao'),'field boundary');$v[$key].='x';check(!Audit::validSnapshot($d,$v,'sinalizadores_importacao'),'field overflow');}
foreach([array_diff_key($row,['nome'=>true]),$row+['secret'=>'synthetic'],array_replace($row,['qt_dias_alerta'=>'10']),array_replace($row,['sinaliz_imp_id'=>'1'])] as $v){check(!Audit::validSnapshot($d,$v,'sinalizadores_importacao'),'reject incomplete or mistyped image');}
$v=$row;$v['descricao']=null;check(Audit::validSnapshot($d,$v,'sinalizadores_importacao'),'preserve historical null');
$old=['entityCode'=>'formatos_amostra_progress','primaryKey'=>'formato_amostra_id','apiBinding'=>['sourceCode'=>'motor_progress_ciw_cadastros'],'fields'=>['formato_amostra_id'=>['dataType'=>'integer','jsonPath'=>'formato_amostra_id'],'descricao'=>['dataType'=>'string','jsonPath'=>'descricao'],'log_inativo'=>['dataType'=>'boolean','jsonPath'=>'log_inativo']]];
check(Audit::validSnapshot($old,['formato_amostra_id'=>14,'descricao'=>'Historico','log_inativo'=>false],'formatos_amostra'),'existing profile regression');
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
require dirname(__DIR__).'/php/RuntimeApiEntityActionService.php';
$d['apiSource']=['responseContract'=>'sursum-programs'];
$reflection=new ReflectionClass(App\Runtime\RuntimeApiEntityActionService::class);
$service=$reflection->newInstanceWithoutConstructor();
$transactions=(new ReflectionClass(App\Runtime\RuntimeTransactionService::class))->newInstanceWithoutConstructor();
(new ReflectionProperty($service,'transactions'))->setValue($service,$transactions);
$method=new ReflectionMethod($service,'writeAuditSnapshot');
$after=$row;$after['qt_dias_alerta']=12;
$audit=['version'=>1,'source'=>'progress-transaction','resource'=>'sinalizadores_importacao','operation'=>'update','recordId'=>1,'before'=>$row,'after'=>$after];
$proof=$method->invoke($service,$d,$e,['success'=>true,'audit'=>$audit],'update',1);
check($proof['metadata']['available']===true,'existing importer recognizes confirmed snapshot');
check($proof['before']===$row&&$proof['after']===$after,'complete before and after mapped');
$audit['actor']=['username'=>'forged'];
$proof=$method->invoke($service,$d,$e,['success'=>true,'audit'=>$audit],'update',1);
check($proof['metadata']['available']===false,'client supplied actor rejected');
echo "PASS signal-config audit checks=$checks\n";
