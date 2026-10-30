<?php
// Diagnostico apenas SELECT. Credenciais configuradas ficam somente em memoria.
$result=['connection'=>'ticontrole2','businessWrites'=>false,'credentialsExported'=>false];
try {
 $raw=file_get_contents('/var/www/clients/client1/web2/web/ciw/_lib/conf/prod.config.php');
 if(!preg_match('/a:\d+:\{/',$raw,$m,PREG_OFFSET_CAPTURE))throw new RuntimeException('CONFIG_FORMAT');
 $data=@unserialize(substr($raw,$m[0][1]),['allowed_classes'=>false]);
 $cfg=$data['PROFILE']['ticontrole2'];
 // Biblioteca inspecionada: decodificador puro; inicializacao apenas de arrays.
 require_once '/var/www/clients/client1/web2/web/ciw/_lib/prod/lib/php/nm_ini_lib.php';
 foreach(['VAL_HOST','VAL_BASE','VAL_USER','VAL_PASS'] as $key){
  if(isset($cfg[$key])&&is_string($cfg[$key])&&strncmp($cfg[$key],'enc_nm_enc_v1',13)===0)$cfg[$key]=decode_string($cfg[$key]);
 }
 $host=isset($cfg['VAL_HOST'])?$cfg['VAL_HOST']:'';
 $base=isset($cfg['VAL_BASE'])?$cfg['VAL_BASE']:'';
 $type=isset($cfg['VAL_TYPE'])?$cfg['VAL_TYPE']:'';
 $result['databaseType']=$type;
 if(is_string($host)&&preg_match('/^[A-Za-z0-9_.:,\\\\ -]{1,120}$/',$host))$result['configuredHost']=$host;
 if(is_string($base)&&preg_match('/^[A-Za-z0-9_ -]{1,80}$/',$base))$result['configuredDatabase']=$base;
 if(!is_string($host)||!preg_match('/^(?:tcp:)?(192\.168\.0\.(?:70|170))(?::1433|,1433)?$/',$host,$target)||strtolower($base)!=='ticontrole')throw new RuntimeException('CONFIG_TARGET_REQUIRES_REVIEW');
 $pdo=new PDO('dblib:host='.$target[1].':1433;dbname=ticontrole;charset=UTF-8',$cfg['VAL_USER'],$cfg['VAL_PASS'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_TIMEOUT=>8]);
 unset($cfg,$data,$raw);
 $result['connected']=true;
 $result['schema']=$pdo->query("SELECT TABLE_NAME,COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME IN ('itens_menu','programas','modulos','s_groups_apps','s_users_groups','s_users') ORDER BY TABLE_NAME,ORDINAL_POSITION")->fetchAll(PDO::FETCH_ASSOC);
 $result['databaseName']=$pdo->query('SELECT DB_NAME()')->fetchColumn();
 $result['counts']=$pdo->query("SELECT 'itens_menu' AS objeto,COUNT(*) AS qt FROM itens_menu UNION ALL SELECT 'programas',COUNT(*) FROM programas UNION ALL SELECT 's_groups_apps',COUNT(*) FROM s_groups_apps UNION ALL SELECT 'tcassimiro_groups',COUNT(*) FROM s_users_groups WHERE LOWER(login)='tcassimiro'")->fetchAll(PDO::FETCH_ASSOC);
 $result['programCatalogColoracoes']=$pdo->query("SELECT TOP 30 codigo,titulo,descricao,cod_programa,cod_modulo,cod_tipo_programa FROM programas WHERE LOWER(codigo) LIKE '%color%' OR LOWER(titulo) LIKE '%colora%' OR LOWER(descricao) LIKE '%colora%' ORDER BY codigo")->fetchAll(PDO::FETCH_ASSOC);
 $menu=$pdo->query("SELECT TOP 20 menu_id,descricao,link,cod_tipo_link,item_menu_id_pai FROM dbo.itens_menu WHERE LOWER(descricao) LIKE '%colora%' ORDER BY menu_id")->fetchAll(PDO::FETCH_ASSOC);
 foreach($menu as &$row){$row['linkHasQuery']=strpos($row['link'],'?')!==false;$row['link']=explode('?',$row['link'],2)[0];}unset($row);
 $result['menuColoracoes']=$menu;
 $navigation=$pdo->query('SELECT TOP 60 menu_id,descricao,link,cod_tipo_link,item_menu_id_pai,cod_programa FROM itens_menu WHERE menu_id=1 ORDER BY cod_ordem,id')->fetchAll(PDO::FETCH_ASSOC);
 foreach($navigation as &$row){$row['linkHasQuery']=strpos($row['link'],'?')!==false;$row['link']=explode('?',$row['link'],2)[0];}unset($row);
 $result['menuOne']=$navigation;
 $hasApp=false;foreach($result['schema'] as $field)if(strtolower($field['TABLE_NAME'])==='s_groups_apps'&&strtolower($field['COLUMN_NAME'])==='app_name')$hasApp=true;
 $sql="SELECT TOP 30 ug.login,p.codigo,p.cod_programa,m.cod_sistema,ga.priv_access,ga.priv_insert,ga.priv_update,ga.priv_delete,ga.priv_export,ga.priv_print FROM programas p JOIN modulos m ON m.cod_modulo=p.cod_modulo JOIN s_groups_apps ga ON ga.cod_programa=p.cod_programa JOIN s_users_groups ug ON ug.group_id=ga.group_id WHERE LOWER(ug.login) IN (:login,:alternate) AND (LOWER(p.codigo) LIKE '%color%'".($hasApp?" OR LOWER(ga.app_name) LIKE '%color%'":"").") ORDER BY m.cod_sistema,p.codigo";
 $statement=$pdo->prepare($sql);$statement->execute(['login'=>'tcassimiro','alternate'=>'thiago.cassimiro']);
 $result['userColoracoes']=$statement->fetchAll(PDO::FETCH_ASSOC);
 $result['globalColoracoes']=$pdo->query("SELECT p.codigo,m.cod_sistema,COUNT(*) AS grantRows,SUM(CASE WHEN ga.priv_access='Y' THEN 1 ELSE 0 END) AS accessY FROM programas p JOIN modulos m ON m.cod_modulo=p.cod_modulo JOIN s_groups_apps ga ON ga.cod_programa=p.cod_programa WHERE LOWER(p.codigo) IN ('grid_pub_coloracoes','form_pub_coloracoes') GROUP BY p.codigo,m.cod_sistema")->fetchAll(PDO::FETCH_ASSOC);
 $columns=['login'];foreach($result['schema'] as $field)if(strtolower($field['TABLE_NAME'])==='s_users'&&in_array(strtolower($field['COLUMN_NAME']),['active','priv_admin','usuario_ad','usuario_progress','login_progress','usuario_web'],true))$columns[]='['.$field['COLUMN_NAME'].']';
 $result['selectedAccounts']=$pdo->query("SELECT ".implode(',',$columns)." FROM s_users WHERE LOWER(login) IN ('tcassimiro','thiago.cassimiro')")->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {$result['connected']=isset($pdo);$result['error']='SQL_ACCESS_FAILED';$result['sqlstate']=$e->getCode();}
catch(Throwable $e){$result['connected']=false;$result['error']=in_array($e->getMessage(),['CONFIG_FORMAT','CONFIG_TARGET_REQUIRES_REVIEW'],true)?$e->getMessage():'METADATA_UNAVAILABLE';}
echo json_encode($result,JSON_PARTIAL_OUTPUT_ON_ERROR);
