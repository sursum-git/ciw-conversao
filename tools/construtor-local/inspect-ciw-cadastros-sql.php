<?php
// Apenas metadados SQL. Nenhum valor de parametro, senha humana ou dado de cadastro.
require 'D:/opencode/construtor-pg/backend/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv('D:/opencode/construtor-pg/backend/.env');
try{
 // Verificacao explicita ANTES de ler a configuracao tecnica/abrir PDO.
 (new App\Ciw\CiwSqlTunnelOwnership())->assertOwned();
 $cfg=(new App\Ciw\CiwSqlConnectionConfiguration())->resolve();
 $db=new PDO('odbc:Driver={ODBC Driver 17 for SQL Server};Server=127.0.0.1,19933;Database=ticontrole;Encrypt=no;',$cfg['username'],$cfg['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_TIMEOUT=>8]);unset($cfg);
 $result=['scope'=>'schema_only','writes'=>false];
 $result['columns']=$db->query("SELECT TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,IS_NULLABLE,COLUMN_DEFAULT,COLUMNPROPERTY(OBJECT_ID(TABLE_SCHEMA+'.'+TABLE_NAME),COLUMN_NAME,'IsIdentity') AS IS_IDENTITY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('tipos_valor','empresas_imposto') ORDER BY TABLE_NAME,ORDINAL_POSITION")->fetchAll(PDO::FETCH_ASSOC);
 $result['indexes']=$db->query("SELECT t.name AS TABLE_NAME,i.name AS INDEX_NAME,i.is_unique,i.is_primary_key,c.name AS COLUMN_NAME,ic.key_ordinal FROM sys.tables t JOIN sys.indexes i ON i.object_id=t.object_id JOIN sys.index_columns ic ON ic.object_id=i.object_id AND ic.index_id=i.index_id JOIN sys.columns c ON c.object_id=ic.object_id AND c.column_id=ic.column_id WHERE t.name IN ('tipos_valor','empresas_imposto') AND ic.key_ordinal>0 ORDER BY t.name,i.name,ic.key_ordinal")->fetchAll(PDO::FETCH_ASSOC);
 $result['references']=$db->query("SELECT t.name AS TABLE_NAME,c.name AS COLUMN_NAME FROM sys.tables t JOIN sys.columns c ON c.object_id=t.object_id WHERE c.name IN ('tipo_valor_id','empresa_imposto_id') ORDER BY c.name,t.name")->fetchAll(PDO::FETCH_ASSOC);
 $result['triggers']=$db->query("SELECT t.name AS TABLE_NAME,tr.name AS TRIGGER_NAME FROM sys.tables t JOIN sys.triggers tr ON tr.parent_id=t.object_id WHERE t.name IN ('tipos_valor','empresas_imposto')")->fetchAll(PDO::FETCH_ASSOC);
 file_put_contents('D:/opencode/conversao-sc/integration-src/ciw-cadastros/schema/sql-cadastros.json',json_encode($result,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
 echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_PARTIAL_OUTPUT_ON_ERROR)."\n";
}catch(Throwable){fwrite(STDERR,"CIW_SQL_SCHEMA_UNAVAILABLE: detalhe privado omitido.\n");exit(1);}
