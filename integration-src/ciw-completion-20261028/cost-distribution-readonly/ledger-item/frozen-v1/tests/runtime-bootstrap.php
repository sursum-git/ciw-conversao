<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/cost-distribution-readonly/ledger-stage';
$guard=dirname(__DIR__).'/php/RuntimeCostDistributionLedgerRead.php';if(is_file($guard))require $guard;
require $stage.'/RuntimeCiwErpQuery.php';require $stage.'/RuntimeApiEntityActionService.php';
