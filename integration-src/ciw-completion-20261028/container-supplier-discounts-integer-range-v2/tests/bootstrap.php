<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
$root=dirname(__DIR__).'/'.(getenv('RANGE_TREE')?:'candidate');
require $root.'/backend/src/Builder/ProgramBuilderService.php';
require $root.'/backend/src/Runtime/RuntimeImportDiscountRead.php';
