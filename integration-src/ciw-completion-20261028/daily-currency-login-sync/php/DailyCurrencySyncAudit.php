<?php
namespace App\Ciw;
use App\Runtime\{RuntimeCiwCotacaoAudit,RuntimeProgressAuditSchema as S};
/** Closed transaction images. Does not grant a binding or claim trigger parity. */
final class DailyCurrencySyncAudit {
 private const ERP_FIELDS=[
 'comum.cotacao'=>[
  'mo-codigo'=>['type'=>'integer','extent'=>0],
  'ano-periodo'=>['type'=>'string','extent'=>0],
  'cotacao'=>['type'=>'decimal','extent'=>31],
  'cota-mensal'=>['type'=>'decimal','extent'=>0],
  'cota-media'=>['type'=>'decimal','extent'=>0],
  'usuario'=>['type'=>'string','extent'=>31],
  'char-1'=>['type'=>'string','extent'=>0],
  'char-2'=>['type'=>'string','extent'=>0],
  'dec-1'=>['type'=>'decimal','extent'=>0],
  'dec-2'=>['type'=>'decimal','extent'=>0],
  'int-1'=>['type'=>'integer','extent'=>0],
  'int-2'=>['type'=>'integer','extent'=>0],
  'log-1'=>['type'=>'boolean','extent'=>0],
  'log-2'=>['type'=>'boolean','extent'=>0],
  'data-1'=>['type'=>'date','extent'=>0],
  'data-2'=>['type'=>'date','extent'=>0],
  'var-periodo'=>['type'=>'decimal','extent'=>0],
  'check-sum'=>['type'=>'string','extent'=>0],
 ],
 'ems5.cotac_parid'=>[
  'cod_indic_econ_base'=>['type'=>'string','extent'=>0],
  'cod_indic_econ_idx'=>['type'=>'string','extent'=>0],
  'dat_cotac_indic_econ'=>['type'=>'date','extent'=>0],
  'val_cotac_indic_econ'=>['type'=>'decimal','extent'=>0],
  'ind_tip_cotac_parid'=>['type'=>'string','extent'=>0],
  'log_cotac_gerad_autom'=>['type'=>'boolean','extent'=>0],
  'cod_usuar_ult_atualiz'=>['type'=>'string','extent'=>0],
  'dat_ult_atualiz'=>['type'=>'date','extent'=>0],
  'hra_ult_atualiz'=>['type'=>'string','extent'=>0],
  'cod_livre_1'=>['type'=>'string','extent'=>0],
  'cod_livre_2'=>['type'=>'string','extent'=>0],
  'dat_livre_1'=>['type'=>'date','extent'=>0],
  'dat_livre_2'=>['type'=>'date','extent'=>0],
  'log_livre_1'=>['type'=>'boolean','extent'=>0],
  'log_livre_2'=>['type'=>'boolean','extent'=>0],
  'num_livre_1'=>['type'=>'integer','extent'=>0],
  'num_livre_2'=>['type'=>'integer','extent'=>0],
  'val_livre_1'=>['type'=>'decimal','extent'=>0],
  'val_livre_2'=>['type'=>'decimal','extent'=>0],
  'cdd_version'=>['type'=>'decimal','extent'=>0],
 ],
 ];
 public static function inspect(mixed $a,array $c):bool {
  if(!S::exact($c,['version','resource','operation','serie','actor','run_date','observed_date','valor','hist_cotacao_bc_id','expected_history_id'])||$c['version']!==1||$c['resource']!=='daily_currency_sync'||$c['operation']!=='synchronize'||$c['serie']!==1||!S::exact($c['actor'],['login'])||!is_string($c['actor']['login'])||$c['actor']['login']===''||!S::date($c['run_date'])||!S::date($c['observed_date'])||$c['observed_date']>$c['run_date']||!S::id($c['hist_cotacao_bc_id'])||!self::number($c['valor'])||$c['valor']<=0||$c['expected_history_id']!==null&&!S::id($c['expected_history_id']))return false;
  if(!S::exact($a,['version','source','resource','operation','actor','run_date','observed_date','history','changes'])||$a['version']!==1||$a['source']!=='progress-transaction'||$a['resource']!=='daily_currency_sync'||$a['operation']!=='synchronize'||$a['actor']!==$c['actor']||$a['run_date']!==$c['run_date']||$a['observed_date']!==$c['observed_date']||!is_array($a['history'])||!is_array($a['changes'])||!array_is_list($a['changes'])||count($a['changes'])<2||count($a['changes'])>50000)return false;
  $history=RuntimeCiwCotacaoAudit::inspectTransaction(['audit'=>$a['history']],'import-bc',$c['hist_cotacao_bc_id']);
  if(($history['metadata']['available']??false)!==true||$history['after']['data']!==$c['run_date']||!self::sameNumber($history['after']['valor'],$c['valor'])||$history['after']['nome_serie']!=='')return false;
  $seen=[];
  foreach($a['changes']as$index=>$change){
   if(!S::exact($change,['resource','operation','key','before','after'])||!is_array($change['key'])||!is_array($change['before'])||!is_array($change['after']))return false;
   $resource=$change['resource'];$op=$change['operation'];$key=$change['key'];$before=$change['before'];$after=$change['after'];
   if(!isset(self::ERP_FIELDS[$resource])||!self::row($after,$resource)||$op!=='create'&&!self::row($before,$resource)||$op==='create'&&$before!==[])return false;
   if($index===0){
    if($resource!=='comum.cotacao'||$op!=='update'||!S::exact($key,['mo-codigo','ano-periodo'])||$key['mo-codigo']!==3||$key['ano-periodo']!==str_replace('-','',substr($c['run_date'],0,7))||$after['mo-codigo']!==3||$after['ano-periodo']!==$key['ano-periodo'])return false;
    $b=$before;$v=$after;unset($b['cotacao'],$v['cotacao']);if(!S::same($b,$v))return false;
    $day=(int)substr($c['run_date'],8,2);
    foreach($after['cotacao']as$i=>$amount){$expected=$i+1<$day?$before['cotacao'][$i]:$c['valor'];if($amount===null||$expected===null){if($amount!==$expected)return false;}elseif(!self::sameNumber($amount,$expected))return false;}
   }else{
    if($resource!=='ems5.cotac_parid'||!in_array($op,['create','update'],true)||!S::exact($key,['cod_indic_econ_base','cod_indic_econ_idx','ind_tip_cotac_parid','dat_cotac_indic_econ'])||$key['cod_indic_econ_base']!=='real'||$key['cod_indic_econ_idx']!=='dolar'||!is_string($key['ind_tip_cotac_parid'])||$key['dat_cotac_indic_econ']!==$c['run_date']||!self::sameNumber($after['val_cotac_indic_econ'],$c['valor']))return false;
    foreach($key as$name=>$value)if($after[$name]!==$value)return false;
    $identity=json_encode([$key['cod_indic_econ_base'],$key['cod_indic_econ_idx'],$key['ind_tip_cotac_parid'],$key['dat_cotac_indic_econ']],JSON_THROW_ON_ERROR);if(isset($seen[$identity]))return false;$seen[$identity]=true;
    if($op==='create'){
     if(count($a['changes'])!==2||$key['ind_tip_cotac_parid']!=='venda'||$after['cod_usuar_ult_atualiz']!=='super'||$after['dat_ult_atualiz']!==$c['run_date']||!is_string($after['hra_ult_atualiz'])||preg_match('/\A(?:[01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]\z/',$after['hra_ult_atualiz'])!==1)return false;
    }else{$b=$before;$v=$after;unset($b['val_cotac_indic_econ'],$v['val_cotac_indic_econ']);if(!S::same($b,$v))return false;}
   }
  }
  return true;
 }
 private static function number(mixed $v):bool{return (is_int($v)||is_float($v))&&is_finite((float)$v);}
 private static function sameNumber(mixed $a,mixed $b):bool{return self::number($a)&&self::number($b)&&(float)$a===(float)$b;}
 private static function row(array $row,string $resource):bool {
  $schema=self::ERP_FIELDS[$resource];if(!S::exact($row,array_keys($schema)))return false;
  foreach($schema as$name=>$spec){$value=$row[$name];$rule=['type'=>$spec['type'],'nullable'=>true];
   if($spec['extent']>0){if(!is_array($value)||!array_is_list($value)||count($value)!==$spec['extent'])return false;foreach($value as$slot)if(!S::row(['v'=>$slot],['v'=>$rule]))return false;}
   elseif(!S::row(['v'=>$value],['v'=>$rule]))return false;
  }
  return true;
 }
}
