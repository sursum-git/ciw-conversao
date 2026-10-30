<?php
// Somente a sessao cuja prova autenticada foi obtida no navegador. Sem tokens.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv('D:/opencode/construtor-pg/backend/.env');
$kernel=new App\Kernel('dev',false);$kernel->boot();
$root='D:/opencode/conversao-sc/.runtime/ciw-auth-20261017/';
$proof=json_decode(file_get_contents($root.'browser-session-proof.json'),true,512,JSON_THROW_ON_ERROR);
if(($proof['authenticated']??false)!==true||($proof['source']??'')!=='ima-user-web'||($proof['username']??'')!=='tasilpar')throw new RuntimeException('Prova invalida');
$em=$kernel->getContainer()->get('doctrine')->getManager();
$items=$em->getRepository(App\Entity\RuntimeUserSession::class)->findBy(['tenantId'=>'default','userId'=>'tasilpar'],['enteredAt'=>'DESC'],20);
$selected=null;
foreach($items as $session)if(hash_equals($proof['sessionSha256'],hash('sha256',$session->getSessionId()))){$selected=$session;break;}
if(!$selected)throw new RuntimeException('Sessao nao corresponde');
$properties=$selected->getSessionProperties();$auth=$properties['authentication']??[];
if($selected->getStatus()!=='active'||($auth['provider']??'')!=='ima-user-web'||($auth['type']??'')!=='ima-user-web'||isset($properties['impersonation']))throw new RuntimeException('Origem/status incorretos');
$result=['username'=>'tasilpar','tenant'=>'default','sessionId'=>$selected->getSessionId(),'sessionSha256'=>$proof['sessionSha256'],'provider'=>$auth['provider'],'type'=>$auth['type'],'status'=>$selected->getStatus(),'enteredAt'=>$selected->getEnteredAt()->format(DATE_ATOM),'verifiedAt'=>gmdate(DATE_ATOM),'realBrowserSessionVerified'=>true,'progressUsersModified'=>false];
file_put_contents($root.'verified-real-session.json',json_encode($result,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
echo "PASS: sessao real tasilpar/default ativa, provider/type ima-user-web, sem impersonacao; hash confere com navegador autenticado\n";
