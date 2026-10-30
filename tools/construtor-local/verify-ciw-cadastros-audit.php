<?php
// Somente leitura dos logs dos marcadores desta execucao; nao imprime dados ou sessoes.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-cadastros-20261020';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$db=$kernel->getContainer()->get('doctrine')->getConnection();
$evidence=json_decode(file_get_contents($state.'/real-crud-evidence.json'),true,flags:JSON_THROW_ON_ERROR);$proof=[];
foreach($evidence['resources'] as $resource){
 if(!$resource['cleaned'])throw new RuntimeException('Limpeza nao comprovada');
 $needle='%'.$resource['marker'].'%';
 $rows=$db->fetchAllAssociative('SELECT l.id,l.event_type,l.before_data,l.after_data,l.metadata,t.status FROM runtime_transaction_log l JOIN runtime_transaction t ON t.id=l.transaction_id WHERE t.screen_id=? AND (CAST(l.before_data AS TEXT) LIKE ? OR CAST(l.after_data AS TEXT) LIKE ?) ORDER BY l.id',[$resource['screenId'],$needle,$needle]);
 $counts=['create'=>0,'update'=>0,'delete'=>0];$ids=[];
 foreach($rows as $row){
  $op=substr($row['event_type'],strrpos($row['event_type'],'.')+1);if(!isset($counts[$op]))continue;
  $m=json_decode($row['metadata'],true,flags:JSON_THROW_ON_ERROR);$a=$m['audit']??[];
  if(($a['available']??false)!==true||($a['source']??null)!=='progress-transaction'||($a['resource']??null)!==$resource['resource']||($a['operation']??null)!==$op||$row['status']!=='succeeded'||($m['actor']['source']??null)!=='authenticated-session'||empty($m['actor']['userId'])||($m['actor']['username']??null)!=='admin')throw new RuntimeException('Auditoria confirmada invalida');
  $before=json_decode($row['before_data'],true,flags:JSON_THROW_ON_ERROR);$after=json_decode($row['after_data'],true,flags:JSON_THROW_ON_ERROR);
  if($op==='create'&&$before!==[]||$op==='delete'&&$after!==[]||$op==='update'&&(!$before||!$after))throw new RuntimeException('Snapshots invalidos');
  $counts[$op]++;$ids[]=(int)$row['id'];
 }
 if($counts!==['create'=>3,'update'=>1,'delete'=>3])throw new RuntimeException('Eventos esperados ausentes: '.$resource['resource']);
 $proof[]=['resource'=>$resource['resource'],'confirmedSnapshots'=>true,'trustedActor'=>true,'counts'=>$counts,'logIds'=>$ids];
}
if(count($proof)!==4)throw new RuntimeException('Lote incompleto');
file_put_contents($state.'/audit-evidence.json',json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
echo "PASS:4cadastros/28eventos confirmados, snapshots antes/depois e ator da sessao; consulta somente leitura.\n";
