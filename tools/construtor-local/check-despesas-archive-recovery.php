<?php
// Guarda somente leitura: comprova que a única diferença assinada é o status
// arquivado pela publicação oficial de cd0093. Não modifica nem reassina dados.
$backend='D:/opencode/construtor-pg/backend';
require $backend.'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$application=new Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
$command=$application->find('app:integrity:check');
if($command instanceof Symfony\Component\Console\Command\LazyCommand){$command=$command->getCommand();}
$integrity=(new ReflectionProperty($command,'integrity'))->getValue($command);
$em=$kernel->getContainer()->get('doctrine')->getManager();
$old=$em->find(App\Entity\BuilderProgramVersion::class,5);
$next=$em->find(App\Entity\BuilderProgramVersion::class,7);
if(!$old || !$next || $old->getProgramCode()!=='cd0093' || $old->getVersion()!=='1.0.0' || $old->getStatus()!=='archived'
 || $next->getProgramCode()!=='cd0093' || $next->getVersion()!=='1.0.1' || $next->getStatus()!=='published'){
 throw new RuntimeException('Estado inesperado: recuperação cancelada.');
}
$previous=clone $old;$previous->setStatus('published');
$integrity->assertProgramVersion($previous);
$screen=$em->getRepository(App\Entity\ScreenDefinition::class)->findOneBy(['screenId'=>'ciw.empresas-despesa']);
if(!$screen || $screen->getVersion()!=='1.0.1'){throw new RuntimeException('Tela efetiva não corresponde à sucessora.');}
$integrity->assertProgramVersion($next);$integrity->assertScreen($screen);
$invalid=array_values(array_filter($integrity->verifyAll(),fn($r)=>($r['status']??'')!=='valid'));
if(count($invalid)!==1 || ($invalid[0]['tableName']??'')!=='builder_program_version' || (int)($invalid[0]['recordId']??0)!==5){
 throw new RuntimeException('Inconsistências adicionais: recuperação cancelada.');
}
echo "PASS: assinatura anterior de cd0093#5 válida com status published; única diferença é archived; sucessora7 publicada e íntegra.\n";
