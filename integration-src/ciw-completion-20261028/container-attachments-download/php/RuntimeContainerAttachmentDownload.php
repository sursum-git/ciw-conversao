<?php
namespace App\Runtime;

/** Fixed readonly attachment profile. A browser filename is never a storage reference. */
final class RuntimeContainerAttachmentDownload
{
 public const ENTITY='container_anexos_progress';
 public const RESOURCE='anexos-arquivo';
 private const ROW=['anexo_container_id'=>'id','container_id'=>'id','item_container_id'=>['type'=>'integer','nullable'=>true],'descricao'=>['type'=>'string','nullable'=>true],'tipos_anexo_id'=>['type'=>'integer','nullable'=>true],'dt_hr_arquivo'=>'datetime','caminho_arquivo'=>['type'=>'string','nullable'=>true],'tem_arquivo'=>'boolean','tipo_anexo_descricao'=>['type'=>'string','nullable'=>true],'cod_estabel'=>'string'];
 public static function supports(array $d):bool{return ($d['entityCode']??null)===self::ENTITY;}
 public static function referenceProfile(array $d):bool{return self::supports($d)&&($d['apiSource']['detailEndpoint']['bodyTemplate']['resource']??null)===self::RESOURCE;}
 public static function binding(array $d):bool
 {
  $e=$d['apiSource']['detailEndpoint']??[];$u=parse_url((string)($e['url']??''));
  return self::supports($d)&&($d['primaryKey']??null)==='anexo_container_id'&&($d['apiBinding']['sourceCode']??null)==='motor_progress_container_painel'&&($d['apiSource']['responseContract']??null)==='sursum-programs'&&($d['apiSource']['detailResponse']['itemPath']??null)==='data'
   &&($e['method']??null)==='POST'&&($e['requestContextFields']??null)===['container_id']&&RuntimeProgressAuditSchema::exact($e['bodyTemplate']??null,['resource','operation'])&&$e['bodyTemplate']['resource']===self::RESOURCE&&$e['bodyTemplate']['operation']==='get'&&empty($e['queryParams'])
   &&is_array($u)&&!array_intersect(['user','pass','query','fragment'],array_keys($u))&&in_array($u['path']??null,['/SursumPrograms/containers-painel','/med/web/SursumPrograms/containers-painel'],true)
   &&(($u['scheme']??null)==='http'&&($u['host']??null)==='127.0.0.1'&&($u['port']??null)===19910||($u['scheme']??null)==='https'&&($u['host']??null)==='192.168.0.111'&&($u['port']??null)===9911);
 }
 public static function builderEnabled(\App\Entity\BuilderEntity $entity):bool
 {
  $keys=[];foreach($entity->getFields()as$field){if($field->isPrimaryKey())$keys[]=$field->getCode();}if($keys!==['anexo_container_id'])return false;
  $m=$entity->getMetadata();return self::binding(['entityCode'=>$entity->getCode(),'primaryKey'=>'anexo_container_id','apiSource'=>$m['apiSource']??[],'apiBinding'=>$m['apiBinding']??[]]);
 }
 public static function request(array $d,array $p,mixed $id):void
 {
  $no=static fn()=>new RuntimeHttpException('CONTAINER_ATTACHMENT_REQUEST_INVALID','Download exige contexto e identificador confirmados.',422);
  $allowed=['id','anexo_container_id','context','record','entityCode','operation','actionId','programId','permissionPrefix','traceability','_runtime','_runtimeEndpoint'];
  if(!self::binding($d)||!RuntimeProgressAuditSchema::id($id)||(!array_key_exists('id',$p)&&!array_key_exists('anexo_container_id',$p))||array_diff(array_keys($p),$allowed)||!RuntimeProgressAuditSchema::row($p['context']??null,['container_id'=>'id'])){throw $no();}
  foreach([$p,is_array($p['record']??null)?$p['record']:[]]as$submitted){
   foreach(['id','anexo_container_id']as$key){if(array_key_exists($key,$submitted)&&$submitted[$key]!==$id){throw $no();}}
   if(array_key_exists('container_id',$submitted)&&$submitted['container_id']!==$p['context']['container_id']){throw $no();}
  }
  if(array_key_exists('record',$p)&&(!is_array($p['record'])||array_diff(array_keys($p['record']),array_merge(array_keys(self::ROW),['id'])))){throw $no();}
 }
 public static function response(array $body,mixed $row,array $context,mixed $id):void
 {
  if(!RuntimeProgressAuditSchema::exact($body,['success','data'])||$body['success']!==true||!RuntimeProgressAuditSchema::row($row,self::ROW)||$row['anexo_container_id']!==$id||$row['container_id']!==($context['container_id']??null)||!str_starts_with($row['cod_estabel'],'5')||$row['tem_arquivo']!==($row['caminho_arquivo']!==null&&strlen(trim($row['caminho_arquivo'],' '))>0)){
   throw new RuntimeHttpException('CONTAINER_ATTACHMENT_RESPONSE_INVALID','Referencia de anexo invalida ou fora do contexto MED.',502);
  }
 }
 public static function owner(array $d,array $p,array $row,string $actor):string
 {
  $id=$p['id']??$p['anexo_container_id']??null;self::request($d,$p,$id);
  if(($row['anexo_container_id']??null)!==$id||($row['container_id']??null)!==$p['context']['container_id']||($row['tem_arquivo']??null)!==true||!is_string($row['caminho_arquivo']??null)||$row['caminho_arquivo']===''){
   throw new RuntimeHttpException('ATTACHMENT_NOT_FOUND','Arquivo nao informado neste registro.',404);
  }
  return hash('sha256',json_encode([$actor,self::ENTITY,$row['container_id'],$row['item_container_id'],$row['anexo_container_id']],JSON_THROW_ON_ERROR));
 }
}
