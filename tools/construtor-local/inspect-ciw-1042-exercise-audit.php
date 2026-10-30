<?php
// Closed read-only audit bridge. Input/output pipes only; never emits credentials.
ini_set('display_errors','0');ini_set('log_errors','0');
try {
 $root=dirname(__DIR__,2);$b='D:/opencode/construtor-pg/backend';require $b.'/vendor/autoload.php';
 $input=json_decode(stream_get_contents(STDIN,1048577),true,512,JSON_THROW_ON_ERROR);
 if(!is_array($input)||!in_array($input['mode']??null,['header','cursor','native'],true))throw new RuntimeException('CLOSED_MODE_REQUIRED');
 if($input['mode']==='header'){
  if(array_diff(array_keys($input),['mode','operation','body','actor'])||!in_array($input['operation']??null,['create','delete'],true)||($input['actor']??null)!=='admin')throw new RuntimeException('HEADER_SCOPE');
  $body=$input['body'];$op=$input['operation'];
  if(($body['success']??null)!==true||($body['audit']['actor']['login']??null)!==$input['actor'])throw new RuntimeException('CONFIRMED_ACTOR_REQUIRED');
  $definition=['entityCode'=>'container_painel_progress','primaryKey'=>'container_id','apiBinding'=>['sourceCode'=>'motor_progress_container_cabecalho'],'apiSource'=>['responseContract'=>'sursum-programs']];
  $endpoint=['method'=>'POST','url'=>'http://127.0.0.1:19910/med/web/SursumPrograms/containers-cabecalho','bodyTemplate'=>['resource'=>'containers','operation'=>$op]];
  $audit=App\Runtime\RuntimeContainerAudit::inspect($definition,$endpoint,$body,$op,2147000110,2147000110);
  if(($audit['metadata']['available']??null)!==true)throw new RuntimeException('FULL_NATIVE_HEADER_AUDIT_REQUIRED');
  $main=App\Runtime\RuntimeContainerAudit::confirmedFiscalEvent(['resource'=>'containers','operation'=>$op,'recordId'=>2147000110,'before'=>$audit['before'],'after'=>$audit['after']]);
  if($main===null)throw new RuntimeException('FULL_TYPED_HEADER_IMAGE_REQUIRED');
  $confirmed=[];foreach($audit['events']as$event){$m=$event['metadata'];$typed=App\Runtime\RuntimeContainerAudit::confirmedFiscalEvent(['resource'=>$m['resource'],'operation'=>$m['operation'],'recordId'=>$m['recordId'],'before'=>$event['before'],'after'=>$event['after']]);if($typed===null)throw new RuntimeException('FULL_TYPED_CHILD_IMAGE_REQUIRED');$confirmed[]=$typed;}
  $audit=['before'=>$main['before'],'after'=>$main['after'],'metadata'=>$main['metadata'],'events'=>$confirmed];
  foreach(array_merge([['before'=>$audit['before'],'after'=>$audit['after']]],$audit['events'])as$event)foreach(['before','after']as$key)if($event[$key]!==[]&&isset($event[$key]['narrativa'])&&$event[$key]['narrativa']!=='CIW-1042-VALIDACAO-20261028-2147000110')throw new RuntimeException('MARKER_MISMATCH');
  echo json_encode(['success'=>true,'kind'=>'progress-direct-header-audit','audit'=>$audit,'postgresLogClaimed'=>false],JSON_THROW_ON_ERROR);exit;
 }
 (new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$kernel=new App\Kernel('dev',false);$kernel->boot();$db=$kernel->getContainer()->get('doctrine')->getConnection();
 if($input['mode']==='cursor'){
  if(array_keys($input)!==['mode'])throw new RuntimeException('CURSOR_SHAPE');
  echo json_encode(['success'=>true,'cursor'=>(int)$db->fetchOne('SELECT COALESCE(MAX(id),0) FROM runtime_transaction')],JSON_THROW_ON_ERROR);exit;
 }
 if(array_diff(array_keys($input),['mode','sessionId','minId','actor'])||!is_string($input['sessionId']??null)||strlen($input['sessionId'])<1||strlen($input['sessionId'])>160||!is_int($input['minId']??null)||$input['minId']<0||($input['actor']??null)!=='admin')throw new RuntimeException('AUDIT_SCOPE');
 $transactions=$db->fetchAllAssociative("SELECT id,screen_id,endpoint_id,status,request_context FROM runtime_transaction WHERE id>? AND session_id=? AND screen_id IN ('ciw.container-despesas','ciw.container-despesas-lote') ORDER BY id LIMIT 26",[$input['minId'],$input['sessionId']]);
 if(count($transactions)>25)throw new RuntimeException('AUDIT_BUDGET');$output=[];$events=[];$seen=[];$logCount=0;
 foreach($transactions as$t){
  $context=is_string($t['request_context'])?json_decode($t['request_context'],true,512,JSON_THROW_ON_ERROR):$t['request_context'];$actor=$context['actor']??[];
  if(($actor['source']??null)!=='authenticated-session'||($actor['version']??null)!==1||($actor['username']??null)!==$input['actor'])throw new RuntimeException('AUTHENTICATED_NATIVE_ACTOR_REQUIRED');
  $output[]=['id'=>(int)$t['id'],'screen'=>$t['screen_id'],'endpoint'=>$t['endpoint_id'],'status'=>$t['status'],'actor'=>$actor['username']];
  $logs=$db->fetchAllAssociative('SELECT event_type,metadata,before_data,after_data FROM runtime_transaction_log WHERE transaction_id=? ORDER BY id LIMIT 201',[$t['id']]);$logCount+=count($logs);if($logCount>200)throw new RuntimeException('AUDIT_LOG_BUDGET');
  foreach($logs as$l){
   $meta=is_string($l['metadata'])?json_decode($l['metadata'],true,512,JSON_THROW_ON_ERROR):$l['metadata'];$before=is_string($l['before_data'])?json_decode($l['before_data'],true,512,JSON_THROW_ON_ERROR):$l['before_data'];$after=is_string($l['after_data'])?json_decode($l['after_data'],true,512,JSON_THROW_ON_ERROR):$l['after_data'];
   if(str_contains($l['event_type'],'audit_unavailable')||str_contains($l['event_type'],'audit.unavailable')||str_contains($l['event_type'],'presentation_unavailable'))throw new RuntimeException('CONFIRMED_OPERATION_AUDIT_UNAVAILABLE_NO_RETRY');
   $audit=$meta['audit']??null;if(!is_array($audit)||($audit['available']??null)!==true)continue;
   if(($audit['source']??null)!=='progress-transaction'||($audit['version']??null)!==1||($audit['containerId']??null)!==2147000110||!in_array($audit['resource']??null,['containers','despesas_container','calcs_imp_container'],true))throw new RuntimeException('EVENT_OUTSIDE_AUTHORIZED_FIXTURE');
   $event=App\Runtime\RuntimeContainerAudit::confirmedFiscalEvent(['resource'=>$audit['resource'],'operation'=>$audit['operation']??null,'recordId'=>$audit['recordId']??null,'before'=>$before,'after'=>$after]);
   if($event===null||($event['metadata']['containerId']??null)!==2147000110)throw new RuntimeException('FULL_TYPED_EVENT_REQUIRED');
   $digest=hash('sha256',json_encode($event,JSON_THROW_ON_ERROR));if(!isset($seen[$digest])){$events[]=$event;$seen[$digest]=true;}
  }
 }
 echo json_encode(['success'=>true,'kind'=>'native-postgres-confirmed-audit','transactions'=>$output,'events'=>$events,'businessWrites'=>false],JSON_THROW_ON_ERROR);
}catch(Throwable $error){fwrite(STDERR,"CIW1042_AUDIT_BRIDGE_FAILED_NO_RETRY\n");exit(1);}
