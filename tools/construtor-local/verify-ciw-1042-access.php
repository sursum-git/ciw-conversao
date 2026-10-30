<?php
declare(strict_types=1);
$state=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/batch1042-access';$b='D:/opencode/construtor-pg/backend';
require $b.'/vendor/autoload.php';(new Symfony\Component\Dotenv\Dotenv())->bootEnv($b.'/.env');$kernel=new App\Kernel('dev',false);$kernel->boot();$em=$kernel->getContainer()->get('doctrine')->getManager();$db=$em->getConnection();
$require=static function(bool $condition,string $message):void{if(!$condition)throw new RuntimeException($message);};
$read=static fn(string $name):array=>json_decode(file_get_contents($state.'/'.$name),true,512,JSON_THROW_ON_ERROR);
$before=$read('before.json');$applied=$read('applied.json');$gate=$read('authorization.json');
$add=['container_despesas_lote_progress.read'=>true,'container_despesas_lote_progress.edit'=>true,'container_despesas_lote_progress.delete'=>true];
$require($applied['permissionsAdded']===$add,'Unexpected grant');$require($gate['authorized']===false&&$gate['consumed']===true&&is_string($gate['humanApprovalReference']??null)&&strlen($gate['humanApprovalReference'])>0,'Authorization not consumed');
$link=$em->getRepository(App\Entity\AuthUserSubscriber::class)->find($before['linkId']);$require($link!==null&&$link->getUsername()==='tadeu.parreiras','Wrong account');
$controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);$builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);$integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);$integrity->assertAuthUserSubscriber($link);
$expected=$before['permissionOverrides'];foreach($add as $permission=>$value){$require(!array_key_exists($permission,$expected),'Grant existed before');$expected[$permission]=$value;}ksort($expected);$require($link->getPermissionOverrides()===$expected,'Other permissions changed');
foreach($applied['sessions'] as $id){$row=$db->fetchAssociative('SELECT tenant_id,user_id,permission_snapshot FROM runtime_user_session WHERE id=?',[$id]);$require($row!==false&&$row['tenant_id']==='default'&&$row['user_id']==='tadeu.parreiras','Wrong session');$snapshot=json_decode($row['permission_snapshot'],true,512,JSON_THROW_ON_ERROR);$require($snapshot['permissions']===$expected&&$snapshot['user']['permissions']===$expected,'Session permissions diverged');}
$proof=['success'=>true,'user'=>'tadeu.parreiras','addedOnly'=>array_keys($add),'sessionsVerified'=>count($applied['sessions']),'otherPermissionsPreserved'=>true,'nativeIntegrity'=>true,'authorizationConsumed'=>true,'businessWrites'=>false];file_put_contents($state.'/verified.json',json_encode($proof,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));echo "PASS exactly3permissions, native integrity, LDAP snapshots and otherpermissions verified; authorization consumed.\n";
