<?php
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
use App\Ciw\{CiwSqlConnectionConfiguration,PdoCiwSqlGrantReader,CiwColoracoesPolicy};
try{
 $_SERVER['CIW_SQL_TUNNEL_STATE_FILE']='D:/opencode/conversao-sc/.runtime/ciw-authz-sql-20261019/private/tunnel-state.json';
 $r=new PdoCiwSqlGrantReader(new CiwSqlConnectionConfiguration('D:/opencode/conversao-sc/.runtime/ciw-authz-sql-20261019/private/sql-connection.json'));
 $p=new CiwColoracoesPolicy();$out=['businessWrites'=>false,'driver'=>'ODBC17','transport'=>'verified_ssh','actions'=>[]];
 foreach(['read','get','create','update','delete','export','print'] as $action){$rows=$r->read('thiago.cassimiro',$p->applicationFor($action));$out['actions'][$action]=$rows['active']&&$p->allows($action,$rows['grants']);}
 if(in_array(false,$out['actions'],true))throw new RuntimeException();
 file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-authz-sql-20261019/sql-preflight.json',json_encode($out,JSON_PRETTY_PRINT));
 echo "PASS: 7 decisoes SQL reais, apenas SELECT; nenhuma acao de negocio executada.\n";
}catch(Throwable){fwrite(STDERR,"CIW_SQL_PREFLIGHT_FAILED: detalhes privados omitidos.\n");exit(1);}
