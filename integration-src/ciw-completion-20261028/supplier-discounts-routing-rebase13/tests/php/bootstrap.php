<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$domain=dirname(__DIR__,2);$tree=getenv('ROUTING_TREE')?:'candidate';
require $domain.'/candidate/backend/src/Runtime/RuntimeImportDiscountRead.php';
foreach(['RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php']as$file)require $domain.'/'.$tree.'/backend/src/Runtime/'.$file;
