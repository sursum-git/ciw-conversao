<?php
// Somente leitura dos eventos dos registros de teste; nao imprime valores/sessoes.
$root=dirname(__DIR__,2);$state=$root.'/.runtime/ciw-keyed-20261020';$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();$db=$kernel->getContainer()->get('doctrine')->getConnection();
$proof=json_decode(file_get_contents($state.'/real-validation.json'),true,flags:JSON_THROW_ON_ERROR);
if(!$proof['cleanup'])throw new RuntimeException('Limpeza pendente');
$rows=$db->fetchAllAssociative('SELECT l.id,l.event_type,l.before_data,l.after_data,l.diff_data,l.metadata,t.request_context FROM runtime_transaction_log l JOIN runtime_transaction t ON t.id=l.transaction_id WHERE t.screen_id=? AND t.record_id=? ORDER BY l.id',['ciw.parametros-ima',$proof['parameterCode']]);
$counts=['create'=>0,'update'=>0,'delete'=>0];$ids=[];
foreach($rows as $row){
 if(str_contains(json_encode($row,JSON_THROW_ON_ERROR),$proof['marker'].'-valor'))throw new RuntimeException('Valor de parametro encontrado no journal');
 $op=substr($row['event_type'],strrpos($row['event_type'],'.')+1);
 if(!isset($counts[$op])||!str_starts_with($row['event_type'],'im_param_progress.api.'))continue;
 $meta=json_decode($row['metadata'],true,flags:JSON_THROW_ON_ERROR);$audit=$meta['audit']??[];
 if(($audit['available']??false)!==true||($audit['recordId']??null)!==$proof['parameterCode']||($audit['resource']??null)!=='im_param'||($audit['operation']??null)!==$op||($meta['actor']['source']??null)!=='authenticated-session')throw new RuntimeException('Auditoria textual invalida');
 foreach(['before_data','after_data'] as $field){$snapshot=json_decode($row[$field],true,flags:JSON_THROW_ON_ERROR);if(array_key_exists('val_param',$snapshot))throw new RuntimeException('Valor nao omitido');}
 $counts[$op]++;$ids[]=(int)$row['id'];
}
if($counts!==['create'=>1,'update'=>1,'delete'=>1])throw new RuntimeException('Eventos confirmados ausentes');
$base=$db->fetchOne("SELECT l.after_data->>'despesa_id' FROM runtime_transaction_log l WHERE l.event_type='despesas_progress.api.create' AND l.after_data->>'descricao'=? ORDER BY l.id DESC LIMIT 1",[$proof['marker'].'-Base']);
if(!$base)throw new RuntimeException('Base de teste nao identificada');
$links=$db->fetchAllAssociative("SELECT l.event_type,l.before_data,l.after_data,l.metadata FROM runtime_transaction_log l WHERE l.event_type IN ('empresas_despesa_progress.api.create','empresas_despesa_progress.api.update','empresas_despesa_progress.api.delete') AND (l.before_data->>'despesa_id'=? OR l.after_data->>'despesa_id'=?)",[(string)$base,(string)$base]);
$linkCounts=['create'=>0,'update'=>0,'delete'=>0];
foreach($links as $link){$op=substr($link['event_type'],strrpos($link['event_type'],'.')+1);$m=json_decode($link['metadata'],true,flags:JSON_THROW_ON_ERROR);
 if(($m['audit']['available']??false)!==true||($m['audit']['resource']??null)!=='empresas_despesa')throw new RuntimeException('Auditoria dos vinculos ausente');
 $linkCounts[$op]++;
}
if($linkCounts!==['create'=>2,'update'=>1,'delete'=>2])throw new RuntimeException('Eventos dos vinculos ausentes');
$proof['impostosAudit']=true;$proof['impostosAuditCounts']=$linkCounts;
$proof['parameterAuditCrud']=true;$proof['auditCounts']=$counts;$proof['auditLogIds']=$ids;
file_put_contents($state.'/real-validation.json',json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
echo "PASS:3eventos de parametros sem valores no journal e5eventos dos vinculos com colecao de impostos confirmada.\n";
