<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class): void {
    if (!str_starts_with($class,'App\\Runtime\\')) { return; }
    $path=dirname(__DIR__).'/src/Runtime/'.substr($class,strlen('App\\Runtime\\')).'.php';
    if (is_file($path)) { require $path; }
},true,true);
