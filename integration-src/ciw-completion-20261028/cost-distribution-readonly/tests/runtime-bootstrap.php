<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=getenv('CIW_DISTRIBUTION_STAGE') ?: 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/cost-distribution-readonly/stage';
$guard=dirname(__DIR__).'/php/RuntimeCostDistributionRead.php';
if (is_file($guard)) require $guard;
require $stage.'/RuntimeCiwErpQuery.php';
require $stage.'/RuntimeApiEntityActionService.php';
