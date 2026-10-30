<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$mode=getenv('CIW_DECIMAL_MODE');
if(!in_array($mode,['baseline','candidate'],true))throw new RuntimeException('Closed test mode required');
require $mode==='candidate'?__DIR__.'/ProgramBuilderService.php':'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters-v2/ProgramBuilderService-baseline.php';
