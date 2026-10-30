<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
spl_autoload_register(static function(string $class):void {
 if(in_array($class,['App\\Ciw\\DailyCurrencySyncCoordinator','App\\Ciw\\DailyCurrencySyncAudit'],true))require dirname(__DIR__).'/php/'.substr($class,strrpos($class,'\\')+1).'.php';
 if($class==='App\\Runtime\\RuntimeCiwCotacaoAudit')require dirname(__DIR__).'/candidate-exact/RuntimeCiwCotacaoAudit.php';
},true,true);
