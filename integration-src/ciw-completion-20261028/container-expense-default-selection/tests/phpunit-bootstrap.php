<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-expense-default-selection';
if(is_file($state.'/native/backend/src/Builder/ProgramBuilderService.php'))require $state.'/native/backend/src/Builder/ProgramBuilderService.php';
foreach(['RuntimeContainerAudit','RuntimeApiEntityActionService']as$class)if(is_file($state.'/php/'.$class.'.php'))require $state.'/php/'.$class.'.php';
require dirname(__DIR__).'/php/RuntimeContainerExpenseDefaultsAudit.php';
require 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only/frozen-v1/php/RuntimeContainerTaxAudit.php';
