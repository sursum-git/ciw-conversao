<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class): void {
    if ($class === 'App\\Runtime\\RuntimeEntityActionService') {
        require dirname(__DIR__).'/src/Runtime/RuntimeEntityActionService.php';
    }
}, true, true);
