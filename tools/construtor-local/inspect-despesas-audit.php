<?php
// Consulta limitada da auditoria das duas telas desta conversão. Nenhum payload/segredo é impresso.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$db=$kernel->getContainer()->get('doctrine')->getConnection();
$screens=['ciw.despesas','ciw.empresas-despesa'];
$rows=$db->fetchAllAssociative('SELECT screen_id,endpoint_id,status,COUNT(*) AS total FROM runtime_transaction WHERE screen_id IN (?,?) GROUP BY screen_id,endpoint_id,status ORDER BY screen_id,endpoint_id,status',$screens);
$events=$db->fetchAllAssociative('SELECT l.event_type,COUNT(*) AS total FROM runtime_transaction_log l JOIN runtime_transaction t ON t.id=l.transaction_id WHERE t.screen_id IN (?,?) GROUP BY l.event_type ORDER BY l.event_type',$screens);
foreach($screens as $screen){
 $completed=array_filter($rows,fn($r)=>$r['screen_id']===$screen && $r['status']==='succeeded' && in_array($r['endpoint_id'],['create','update','delete'],true));
 $failed=array_filter($rows,fn($r)=>$r['screen_id']===$screen && $r['status']==='failed');
 if(!$completed || !$failed){fwrite(STDERR,"Auditoria incompleta em $screen\n");exit(1);}
}
$evidence=['at'=>gmdate('c'),'transactions'=>$rows,'events'=>$events];
file_put_contents(__DIR__.'/../../.runtime/construtor-pg/despesas-audit-evidence.json',json_encode($evidence,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
echo "PASS: auditoria das duas telas registra gravacoes e falhas; evidencia salva sem payloads.\n";
