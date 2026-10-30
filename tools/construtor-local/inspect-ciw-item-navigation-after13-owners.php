<?php
// Root-only exact native owner lookup; no grants, locks or catalog writes.
$backend='D:/opencode/construtor-pg/backend';
$dir=dirname(__DIR__,2).'/.runtime/ciw-completion-20261028/item-navigation-after13-fresh';
$output=$dir.'/native-governance-owners.json';
if(is_file($output))throw new RuntimeException('Preserve existing owner proof');
$raw=file_get_contents($dir.'/export-proof.json');
$proof=json_decode($raw,true,512,JSON_THROW_ON_ERROR);
if(($proof['success']??false)!==true||($proof['metadataGets']??0)!==6||count($proof['bindings']??[])!==3)throw new RuntimeException('Exact fresh export required');
foreach($proof['files'] as $file){if(hash_file('sha256',$file['path'])!==$file['sha256'])throw new RuntimeException('Export file changed');}
$expected=['op1008'=>'container_custo_itens_progress','op1002'=>'container_itens_progress','op1014'=>'proc_compra_itens_progress'];
foreach($proof['bindings'] as $binding){if(($expected[$binding['programCode']]??null)!==$binding['entityCode'])throw new RuntimeException('Closed target binding required');}
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
try{
 $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
 $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
 $governance=(new ReflectionProperty($builder,'governance'))->getValue($builder);
 $owners=[];
 foreach($proof['bindings'] as $binding){
  $version=(new ReflectionMethod($governance,'findStandardProgramVersionByEntity'))->invoke($governance,$binding['entityCode']);
  if(!$version)throw new RuntimeException('Native owner absent; inspect without inventing ownership');
  $owners[$binding['entityCode']]=['programCode'=>$version->getProgramCode(),'versionId'=>$version->getId(),'version'=>$version->getVersion(),'status'=>$version->getStatus(),'matchesTargetProgram'=>$version->getProgramCode()===$binding['programCode'],'matchesExportedVersion'=>$version->getId()===$binding['versionId']];
 }
 $out=['success'=>true,'readOnly'=>true,'resolver'=>'findStandardProgramVersionByEntity','exportProofSha256'=>hash('sha256',$raw),'owners'=>$owners,'catalogWrites'=>false,'businessWrites'=>false,'grantsChanged'=>false,'ownerMismatchRequiresExplicitReview'=>true];
 $handle=fopen($output,'x');if($handle===false)throw new RuntimeException('Preserve existing owner proof');
 fwrite($handle,json_encode($out,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL);fclose($handle);
 echo "PASS three observed native owners; no ownership assumption or catalog write\n";
}finally{$kernel->shutdown();}
