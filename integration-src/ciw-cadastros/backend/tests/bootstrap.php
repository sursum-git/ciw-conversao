<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $name):void{
 if(!str_starts_with($name,'App\\'))return;
 $file=dirname(__DIR__).'/src/'.str_replace('\\','/',substr($name,4)).'.php';
 if(is_file($file))require $file;
},true,true);
