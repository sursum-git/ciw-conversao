<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=getenv('NF_PAGE_RED')==='1'?'red':'local';
$base='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly-pagination/v1/'.$stage.'/php/';
foreach(['RuntimeCiwErpQuery.php','RuntimeContainerNfAvailableRead.php','RuntimeApiEntityActionService.php','ProgramBuilderService.php']as$file)require $base.$file;
