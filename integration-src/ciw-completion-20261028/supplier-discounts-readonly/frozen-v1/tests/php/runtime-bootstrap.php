<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$domain=dirname(__DIR__,2);
foreach(['RuntimeImportDiscountRead.php','RuntimeCiwErpQuery.php','RuntimeApiEntityActionService.php'] as $file)require $domain.'/candidate-exact/'.$file;
