<?php
namespace App\Tests\Runtime;
use App\Entity\{RuntimeTransaction,RuntimeTransactionLog};
use App\Repository\BuilderEntityRepository;
use App\Runtime\{RuntimeApiEntityActionService,RuntimeExternalJsonClient,RuntimeTransactionService,RuntimeExecutionContext,RuntimeEntityDefinitionResolver,RuntimeEnvironmentIdentityResolver,PermissionResolver,RuntimeHttpException};
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
final class RuntimeContainerTaxOnlyProcessTest extends TestCase {
 private function body():array{return json_decode(file_get_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only/local/tax-only-process-success.json'),true,512,JSON_THROW_ON_ERROR);}
 private function invoke(array $body,array &$sent,array &$logs,array $payload=[],bool $allowed=true,string $actor='test-actor',array $operationOverride=[]):array{
  $em=$this->createStub(EntityManagerInterface::class);$em->method('persist')->willReturnCallback(static function($row)use(&$logs){if($row instanceof RuntimeTransactionLog)$logs[]=$row;});
  $perms=$this->createStub(PermissionResolver::class);$perms->method('hasPermission')->willReturn($allowed);
  $tx=new RuntimeTransactionService($em,$perms,new RuntimeExecutionContext(),$this->createStub(RuntimeEntityDefinitionResolver::class),$this->createStub(RuntimeEnvironmentIdentityResolver::class));
  (new \ReflectionProperty($tx,'current'))->setValue($tx,(new RuntimeTransaction())->setTenantId('default')->setRequestContext(['actor'=>['source'=>'authenticated-session','version'=>1,'username'=>$actor]]));
  $client=$this->createStub(RuntimeExternalJsonClient::class);$client->method('request')->willReturnCallback(static function($url,$method,$headers,$data)use(&$sent,$body){$sent[]=$data;if(($body['__transportFailure']??false)===true)throw new RuntimeHttpException('CONTAINER_PROCESS_BUSY','Container em uso.',409);return['status'=>200,'body'=>$body];});
  $service=new RuntimeApiEntityActionService($this->createStub(BuilderEntityRepository::class),$tx,$client,$perms);
  $op=array_replace(['code'=>'calcular_impostos','type'=>'custom','allowProcess'=>true,'method'=>'POST','path'=>'http://127.0.0.1:19910/med/web/SursumPrograms/containers-processos','requestContextFields'=>['container_id'],'bodyTemplate'=>['resource'=>'impostos','operation'=>'calcular_impostos'],'itemPath'=>'data'],$operationOverride);
  $d=['entityCode'=>'container_processos_progress','primaryKey'=>'container_id','apiBinding'=>['sourceCode'=>'motor_progress_container_processos'],'apiSource'=>['responseContract'=>'sursum-programs','authHeaders'=>[],'operations'=>[$op]],'contextFields'=>[['field'=>'container_id','required'=>true,'readonly'=>true]],'fields'=>['container_id'=>['code'=>'container_id','label'=>'Container','dataType'=>'integer','required'=>true]]];
  return(new \ReflectionMethod($service,'process'))->invoke($service,$d,['operation'=>'process','allowProcess'=>true,'permissionPrefix'=>'container_calcular_impostos_progress','contextFields'=>[['field'=>'container_id']],'processOptions'=>['operationCode'=>'calcular_impostos','parameterFields'=>[]]],$payload+['context'=>['container_id'=>123],'parameters'=>[]]);
 }
 public function testActualTtFiscalResponseImportsFullAuditAndTrustedActor():void{
  $sent=[];$logs=[];$result=$this->invoke($this->body(),$sent,$logs);
  self::assertTrue($result['audit']['available']??false);
  self::assertSame([['resource'=>'impostos','operation'=>'calcular_impostos','container_id'=>123]],$sent);
  $events=array_values(array_filter($logs,fn($r)=>$r->getMetadata()['audit']['available']??false));self::assertCount(3,$events);
  self::assertSame($this->body()['audit']['before'],$events[0]->getBeforeData());
  self::assertSame('test-actor',$events[1]->getMetadata()['actor']['username']);
  self::assertSame('calcs_imp_container',$events[1]->getMetadata()['audit']['resource']);
  self::assertCount(14,$events[2]->getAfterData());
 }
 public function testContextPermissionsIdentityAndFixedBindingFailBeforeTransport():void{
  foreach(['context','divergent','extra','actor','permission','binding','host']as$case){$sent=[];$logs=[];
   $payload=match($case){'context'=>['context'=>[]],'divergent'=>['parameters'=>['container_id'=>124]],'extra'=>['parameters'=>['percentual'=>99]],default=>[]};
   $override=match($case){'binding'=>['bodyTemplate'=>['resource'=>'custos','operation'=>'fechar']],'host'=>['path'=>'http://other/med/web/SursumPrograms/containers-processos'],default=>[]};
   try{$this->invoke($this->body(),$sent,$logs,$payload,$case!=='permission',$case==='actor'?'':'test-actor',$override);self::fail($case);}catch(RuntimeHttpException$e){self::assertContains($e->getStatusCode(),[401,403,422],$case);}
   self::assertSame([],$sent,$case);
  }
 }
 public function testCommittedIncompleteCrossContextActorAndItemEffectsCannotFabricateAudit():void{
  foreach(['missing','actor','owner','partial','item','master','pending']as$case){$b=$this->body();$sent=[];$logs=[];
   switch($case){case'missing':unset($b['audit']);break;case'actor':$b['audit']['actor']['login']='other';break;case'owner':$b['audit']['changes'][0]['after']['container_id']=124;break;case'partial':unset($b['audit']['changes'][0]['after']['usuario_id']);break;case'item':$b['audit']['changes'][0]['resource']='itens_container';break;case'master':$b['audit']['after']['cod_estabel']='101';break;case'pending':$b['audit']['source']='progress-transaction-pending';break;}
   $r=$this->invoke($b,$sent,$logs);self::assertFalse($r['audit']['available']??true,$case);self::assertStringContainsString('Nao repita',$r['result']['message'],$case);
   foreach($logs as$log){self::assertSame([],$log->getBeforeData(),$case);self::assertSame([],$log->getAfterData(),$case);}self::assertCount(1,$sent);
  }
 }
 public function testCommitAndRefusalAndMalformedPresentation():void{
  foreach(['commit','refused','presentation','postcommit']as$case){$b=$this->body();$sent=[];$logs=[];
   if($case==='commit')unset($b['committed']);elseif($case==='refused'){$b['committed']=false;$b['success']=false;$b['error']=['code'=>'BUSY','status'=>409];}elseif($case==='postcommit'){$b['success']=false;$b['error']=['code'=>'OUTPUT_FAILED'];}else$b['data']=['type'=>'script','script'=>'bad'];
   try{$r=$this->invoke($b,$sent,$logs);self::assertContains($case,['presentation','postcommit']);self::assertStringContainsString('Nao repita',$r['result']['message']);}catch(RuntimeHttpException$e){self::assertContains($case,['commit','refused']);self::assertContains($e->getStatusCode(),[422,502]);}
   self::assertCount(1,$sent);
  }
 }
 public function testTransportConflictKeeps409AndOnlyTechnicalLog():void{
  $sent=[];$logs=[];try{$this->invoke(['__transportFailure'=>true],$sent,$logs);self::fail('Conflict must propagate');}catch(RuntimeHttpException$e){self::assertSame(409,$e->getStatusCode());}
  self::assertCount(1,$sent);self::assertCount(1,$logs);self::assertSame([],$logs[0]->getBeforeData());self::assertSame([],$logs[0]->getAfterData());
 }
}
