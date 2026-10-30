<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$domain=dirname(__DIR__,2);
require $domain.'/test-inputs/ProgramBuilderService205e.php';
if (is_file($domain.'/php/RuntimeCiwComparisonRead.php')) require $domain.'/php/RuntimeCiwComparisonRead.php';
require $domain.'/candidate-exact/RuntimeCiwErpQuery.php';
require $domain.'/candidate-exact/RuntimeApiEntityActionService.php';
