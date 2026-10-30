<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class):void {if(strncmp($class,'App\\',4)!==0)return;$file=dirname(__DIR__).'/src/'.str_replace('\\','/',substr($class,4)).'.php';if(is_file($file))require $file;},true,true);
