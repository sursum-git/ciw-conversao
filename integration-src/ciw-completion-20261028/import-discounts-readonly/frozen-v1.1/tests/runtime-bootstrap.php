<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=getenv('CIW_DISCOUNTS_STAGING_DIR') ?: 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/import-discounts-readonly/stage';
$guard=dirname(__DIR__).'/php/RuntimeImportDiscountRead.php';
if (is_file($guard)) { require $guard; }
require $stage.'/RuntimeCiwErpQuery.php';
require $stage.'/RuntimeApiEntityActionService.php';
