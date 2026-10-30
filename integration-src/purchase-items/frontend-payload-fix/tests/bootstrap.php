<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class): void {
    if ($class === 'App\\Runtime\\RuntimeApiEntityActionService') {
        require dirname(__DIR__).'/src/Runtime/RuntimeApiEntityActionService.php';
    }
}, true, true);
