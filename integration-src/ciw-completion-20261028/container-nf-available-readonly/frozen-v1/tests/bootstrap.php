<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$package=dirname(__DIR__);
if(is_file($package.'/php/RuntimeContainerNfAvailableRead.php'))require $package.'/php/RuntimeContainerNfAvailableRead.php';
$stage=getenv('NF_AVAILABLE_RED')==='1'?'red':'local';
require 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly/'.$stage.'/php/RuntimeApiEntityActionService.php';
require 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-nf-available-readonly/'.$stage.'/php/ProgramBuilderService.php';
