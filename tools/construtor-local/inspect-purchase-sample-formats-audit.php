<?php
declare(strict_types=1);
$r=dirname(__DIR__,2);$b='D:/opencode/construtor-pg/backend';$state=$r.'/.runtime/purchase-sample-formats-20261027';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$kernel=new App\Kernel('dev',false);$kernel->boot();$db=$kernel->getContainer()->get('doctrine')->getManager()->getConnection();
$rows=$db->fetchAllAssociative("SELECT id, record_id FROM runtime_transaction WHERE entity_code='formatos_amostra_progress' OR screen_id='ciw.formatos-amostra'");
$logs=$db->fetchAllAssociative("SELECT id, metadata, before_data, after_data FROM runtime_transaction_log WHERE metadata->'audit'->>'resource'='formatos_amostra'");$max=0;
foreach($rows as $row){$id=$row['record_id'];if($id!==null&&preg_match('/^[0-9]{1,10}$/D',$id))$max=max($max,(int)$id);}
foreach($logs as $row){foreach(['metadata','before_data','after_data']as $field){$v=json_decode($row[$field],true,512,JSON_THROW_ON_ERROR);$id=$field==='metadata'?($v['audit']['recordId']??null):($v['formato_amostra_id']??null);if($id!==null){if(!is_int($id)||$id<1||$id>2147483647)throw new RuntimeException('Unexpected audit identity');$max=max($max,$id);}}}
if($max>=2147483646)throw new RuntimeException('No sequence range');
$proof=['success'=>true,'readOnly'=>true,'entity'=>'formatos_amostra_progress','highWatermark'=>$max,'transactionsChecked'=>count($rows),'auditEventsChecked'=>count($logs),'businessWrites'=>false,'at'=>date(DATE_ATOM)];
file_put_contents($state.'/audit-highwater.json',json_encode($proof,JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT));echo 'PASS audit highwater checked; no writes; max='.$max.PHP_EOL;
