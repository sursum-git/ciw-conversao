<?php
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$db=$kernel->getContainer()->get('doctrine')->getConnection();
$transactions=$db->fetchAllAssociative('SELECT endpoint_id,status,COUNT(*) AS total FROM runtime_transaction WHERE screen_id = ? GROUP BY endpoint_id,status ORDER BY endpoint_id,status',['ciw.empresas']);
$events=$db->fetchAllAssociative('SELECT l.event_type,COUNT(*) AS total FROM runtime_transaction_log l JOIN runtime_transaction t ON t.id=l.transaction_id WHERE t.screen_id = ? GROUP BY l.event_type ORDER BY l.event_type',['ciw.empresas']);
$screens=$db->fetchAllAssociative('SELECT screen_id,status FROM screen_definition WHERE screen_id IN (?,?)',['admin.transacoes','admin.logs-transacoes']);
echo json_encode(['transactions'=>$transactions,'events'=>$events,'screens'=>$screens],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE).PHP_EOL;
