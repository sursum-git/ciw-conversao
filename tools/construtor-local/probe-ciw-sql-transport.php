<?php
// Prova de transporte local: parametros somente por stdin; nenhum segredo salvo.
$cfg=json_decode(stream_get_contents(STDIN),true);
try {
 if($cfg['host']!=='192.168.0.170:1433'||strtolower($cfg['database'])!=='ticontrole')throw new RuntimeException();
 $transport='encrypted_certificate_validated';
 $dsn='odbc:Driver={ODBC Driver 17 for SQL Server};Server=tcp:192.168.0.170,1433;Database=ticontrole;Encrypt=yes;TrustServerCertificate=no';
 if(isset($cfg['transport'])&&$cfg['transport']==='ssh'){
  if(!is_int($cfg['port'])||$cfg['port']<1024||$cfg['port']>65535)throw new RuntimeException();
  $dsn='odbc:Driver={ODBC Driver 17 for SQL Server};Server=tcp:127.0.0.1,'.$cfg['port'].';Database=ticontrole;Encrypt=no';
  $transport='ssh_hostkey_verified_end_to_end';
 }
 $pdo=new PDO($dsn,$cfg['username'],$cfg['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_TIMEOUT=>8]);
 unset($cfg);
 $name=$pdo->query('SELECT DB_NAME()')->fetchColumn();
 echo json_encode(['connected'=>$name==='ticontrole','transport'=>$transport,'driver'=>'ODBC17','writes'=>false,'credentialsPersisted'=>false]);
} catch(PDOException $e) {unset($cfg);$flags=[];foreach(['certificate','certificado','handshake','timeout','TCP Provider','SSL Provider','reset','forcibly'] as $term)if(stripos($e->getMessage(),$term)!==false)$flags[]=$term;echo json_encode(['connected'=>false,'sqlstate'=>$e->getCode(),'nativeCode'=>isset($e->errorInfo[1])?$e->errorInfo[1]:null,'errorCategories'=>$flags,'rawErrorOmitted'=>true,'writes'=>false,'credentialsPersisted'=>false]);}
catch(Throwable $e){unset($cfg);echo json_encode(['connected'=>false,'error'=>'CONFIG_OR_RUNTIME_UNAVAILABLE','writes'=>false,'credentialsPersisted'=>false]);}
