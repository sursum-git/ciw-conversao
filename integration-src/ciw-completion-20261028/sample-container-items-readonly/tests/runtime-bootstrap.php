<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=getenv('CIW_SAMPLE_ITEMS_STAGE') ?: 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/sample-container-items-readonly/stage';
if(is_file(dirname(__DIR__).'/php/RuntimeSampleContainerItemsRead.php')) require dirname(__DIR__).'/php/RuntimeSampleContainerItemsRead.php';
if(is_file($stage.'/RuntimeCiwErpQuery.php')) require $stage.'/RuntimeCiwErpQuery.php';
if(is_file($stage.'/RuntimeApiEntityActionService.php')) require $stage.'/RuntimeApiEntityActionService.php';
