<?php
// Read only operational counts; never select request/response bodies or commercial snapshots.
$backend='D:/opencode/construtor-pg/backend';require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');$kernel=new App\Kernel('dev',false);$kernel->boot();
$connection=$kernel->getContainer()->get('doctrine')->getConnection();
$sql=<<<'SQL'
SELECT t.id,t.status,s.user_id,
 count(l.id) FILTER (WHERE l.event_type='api.progress.execution') AS progress_executions,
 count(l.id) FILTER (WHERE l.event_type='iol_gerencial_resumo_progress.api.read') AS resumo_reads,
 count(l.id) FILTER (WHERE l.event_type='iol_gerencial_vendedores_progress.api.read') AS vendedores_reads
FROM runtime_transaction t JOIN runtime_user_session s ON s.session_id=t.session_id
LEFT JOIN runtime_transaction_log l ON l.transaction_id=t.id
WHERE t.id=(SELECT max(t2.id) FROM runtime_transaction t2 JOIN runtime_user_session s2 ON s2.session_id=t2.session_id
 WHERE t2.screen_id='iol.inicial-gerencial' AND t2.endpoint_id='analytics.query.run' AND s2.user_id='tasilpar' AND t2.status='succeeded')
GROUP BY t.id,t.status,s.user_id
SQL;
if(in_array('--inspect', $argv,true)){echo json_encode($connection->fetchAllAssociative("SELECT t.id,t.status,s.user_id,t.started_at,l.event_type,count(l.id) AS n FROM runtime_transaction t LEFT JOIN runtime_user_session s ON s.session_id=t.session_id LEFT JOIN runtime_transaction_log l ON l.transaction_id=t.id WHERE t.id IN (SELECT id FROM runtime_transaction WHERE screen_id='iol.inicial-gerencial' AND endpoint_id='analytics.query.run' ORDER BY id DESC LIMIT 4) GROUP BY t.id,t.status,s.user_id,t.started_at,l.event_type ORDER BY t.id DESC,l.event_type")).PHP_EOL;exit;}
$row=$connection->fetchAssociative($sql);
if(!$row || (int)$row['progress_executions']!==1 || (int)$row['resumo_reads']!==1 || (int)$row['vendedores_reads']!==1)throw new RuntimeException('Execucao unica nao comprovada: '.json_encode($row));
$evidence=['at'=>gmdate(DATE_ATOM),'transactionId'=>(int)$row['id'],'user'=>$row['user_id'],'status'=>$row['status'],'progressExecutions'=>(int)$row['progress_executions'],'resumoProjections'=>(int)$row['resumo_reads'],'vendedoresProjections'=>(int)$row['vendedores_reads']];
file_put_contents(dirname(__DIR__,2).'/.runtime/iol-gerencial/single-execution-verification.json',json_encode($evidence,JSON_PRETTY_PRINT));echo json_encode($evidence).PHP_EOL;
