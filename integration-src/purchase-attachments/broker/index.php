<?php
// Private bootstrap is deployed outside web/. It loads the shared PHP 7.2 classes
// and returns root/private/secret. No filesystem setting is accepted from HTTP.
$bootstrap=dirname(__DIR__,5).'/private/ciw-attachments/bootstrap.php';
try {
    if ($_SERVER['REQUEST_METHOD']!=='POST' || !is_file($bootstrap)) { throw new RuntimeException('Unavailable'); }
    $config=require $bootstrap;
    $broker=new \App\Attachments\AttachmentStorageBroker($config['root'],$config['private'],$config['secret']);
    $input=fopen('php://input','rb');
    try { $result=$broker->execute($_SERVER['HTTP_X_CIW_ENVELOPE']??'',$_SERVER['HTTP_X_CIW_SIGNATURE']??'',$input); }
    finally { if(is_resource($input)){fclose($input);} }
    header('Cache-Control: no-store');header('X-Content-Type-Options: nosniff');
    if (isset($result['path'])) {
        $file=fopen($result['path'],'rb');if(!$file){throw new RuntimeException('Unavailable');}
        header('Content-Type: application/octet-stream');header('Content-Length: '.$result['size']);header('X-Ciw-Sha256: '.$result['sha256']);
        header("Content-Disposition: attachment; filename=\"arquivo\"; filename*=UTF-8''".rawurlencode($result['fileName']));
        try { fpassthru($file); }finally{fclose($file);}exit;
    }
    $body=json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);if($body===false){throw new RuntimeException('Unavailable');}
    header('Content-Type: application/json; charset=UTF-8');header('Content-Length: '.strlen($body));echo $body;
} catch (Throwable $error) {
    http_response_code(422);$body='{"success":false,"error":"Attachment storage request rejected"}';
    header('Cache-Control: no-store');header('X-Content-Type-Options: nosniff');header('Content-Type: application/json');header('Content-Length: '.strlen($body));echo $body;
}
