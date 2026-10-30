<?php
// Somente auditoria recente do teste; nao imprime payload, dados ou credenciais.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$db=$kernel->getContainer()->get('doctrine')->getConnection();
$rows=$db->fetchAllAssociative("SELECT l.id,l.transaction_id,l.event_type,l.metadata,l.before_data,l.after_data FROM runtime_transaction_log l JOIN runtime_transaction t ON t.id=l.transaction_id WHERE t.screen_id='ciw.despesas' AND t.record_id='1003' AND l.event_type='despesas_progress.api.update' ORDER BY l.id DESC LIMIT 2");
foreach($rows as &$row){foreach(['metadata','before_data','after_data'] as $key){$row[$key]=json_decode($row[$key],true);} $row['audit']=$row['metadata']['audit']??null;$row['actor']=$row['metadata']['actor']??null;$row['beforeKeys']=array_keys($row['before_data']);$row['afterKeys']=array_keys($row['after_data']);unset($row['metadata'],$row['before_data'],$row['after_data']);}
echo json_encode($rows,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE).PHP_EOL;
