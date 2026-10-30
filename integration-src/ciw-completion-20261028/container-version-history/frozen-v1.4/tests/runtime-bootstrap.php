<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage=getenv('CIW_HISTORY_STAGING_DIR') ?: 'D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/container-version-history/stage';
require $stage.'/RuntimeCiwErpQuery.php';
require getenv('CIW_HISTORY_ACTION_FILE') ?: $stage.'/RuntimeApiEntityActionService.php';
