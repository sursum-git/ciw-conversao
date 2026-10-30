<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$stage='D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/expense-tax-relations-readonly/php-'.(getenv('CIW_RELATIONS_RED')?'red':'local').'/';
spl_autoload_register(static function(string$class)use($stage):void{if(str_starts_with($class,'App\\Runtime\\')){$file=$stage.substr($class,strrpos($class,'\\')+1).'.php';if(is_file($file))require$file;}},true,true);
