<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$state='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-tax-only';
if(is_file($state.'/php/RuntimeContainerAudit.php'))require $state.'/php/RuntimeContainerAudit.php';
if(is_file(dirname(__DIR__).'/php/RuntimeContainerTaxAudit.php'))require dirname(__DIR__).'/php/RuntimeContainerTaxAudit.php';
if(is_file($state.'/php/RuntimeApiEntityActionService.php'))require $state.'/php/RuntimeApiEntityActionService.php';
