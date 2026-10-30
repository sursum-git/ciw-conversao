<?php
// Diagnostico somente leitura; nao imprime payload, mensagens ou headers sensiveis.
$id=$argv[1]??'';
if(!preg_match('/\AEXE-[0-9]{8}-[0-9]{6}-[0-9]{6}\z/',$id)){exit(2);}
$ch=curl_init('http://127.0.0.1:19910/med/web/SursumDynamicQuery/executions/'.$id.'/events?limit=500');
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10]);
$raw=curl_exec($ch);$body=json_decode($raw,true);
echo json_encode(['httpStatus'=>curl_getinfo($ch,CURLINFO_HTTP_CODE),'contentType'=>curl_getinfo($ch,CURLINFO_CONTENT_TYPE),
 'jsonError'=>json_last_error_msg(),'utf8'=>mb_check_encoding($raw,'UTF-8'),'keys'=>is_array($body)?array_keys($body):[],
 'rows'=>is_array($body['data']??null)?count($body['data']):null]).PHP_EOL;
curl_close($ch);
