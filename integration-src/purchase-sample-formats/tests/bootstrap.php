<?php
require 'D:/opencode/construtor-pg/backend/tests/bootstrap.php';
foreach(['RuntimeCiwCadastroAudit','RuntimeApiEntityActionService']as $name){$p=dirname(__DIR__).'/php/'.$name.'.php';if(is_file($p))require $p;}
