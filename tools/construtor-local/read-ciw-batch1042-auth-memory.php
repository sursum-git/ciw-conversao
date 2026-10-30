<?php
// Child-process pipe only. Never run this helper directly or redirect its stdout.
// Its only consumer captures stdout in memory; there is no credential file output.
ini_set('display_errors','0');ini_set('log_errors','0');
try {
    if (($argv[1]??'')!=='--memory-pipe-only' || !in_array($argv[2]??'', ['existing','new'], true)) throw new RuntimeException('CLOSED_PIPE_REQUIRED');
    $backend='D:/opencode/construtor-pg/backend';require $backend.'/vendor/autoload.php';
    (new Symfony\Component\Dotenv\Dotenv())->bootEnv($backend.'/.env');
    $kernel=new App\Kernel('dev',false);$kernel->boot();
    $em=$kernel->getContainer()->get('doctrine')->getManager();
    $code=$argv[2]==='existing'?'motor_progress_container_despesas':'motor_progress_container_despesas_lote';
    $source=$em->getRepository(App\Entity\BuilderApiSource::class)->findOneBy(['code'=>$code]);
    if (!$source) throw new RuntimeException('SOURCE_REQUIRED');
    $controller=$kernel->getContainer()->get(App\Controller\ProgramBuilderController::class);
    $builder=(new ReflectionProperty($controller,'builder'))->getValue($controller);
    $integrity=(new ReflectionProperty($builder,'integrity'))->getValue($builder);
    $integrity->assertApiSource($source);
    $headers=$source->getMetadata()['authHeaders']??[];
    if (array_keys($headers)!==['X-Containers-Token'] || !is_string($headers['X-Containers-Token']) || $headers['X-Containers-Token']==='' || $headers['X-Containers-Token']==='********') throw new RuntimeException('REAL_HEADER_REQUIRED');
    echo json_encode(['code'=>$code,'authHeaders'=>$headers],JSON_THROW_ON_ERROR);
} catch (Throwable $error) { fwrite(STDERR,"BATCH1042_PRIVATE_AUTH_PIPE_FAILED\n");exit(1); }
