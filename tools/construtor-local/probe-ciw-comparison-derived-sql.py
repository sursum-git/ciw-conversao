"""Execute14 pinned synthetic SELECTs, observe results/errors without business rows or DML."""
from pathlib import Path
import sys,json,getpass,hashlib,base64,re
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
fixture=R/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/sql-source-derived-fixture-v1.json'
assert sha(fixture)=='c9da5e858ce3128cf34c41d6e363ee32897603c2eb173afc7785c65d2896a8b5'
data=json.loads(fixture.read_text());assert len(data['cases'])==14 and data['policy']['businessWrites'] is False and not data['policy']['physicalTablesReferenced']
for item in [data['metadataProof'],data['sourceContract']]:assert sha(R/item['path'])==item['sha256']
for row in data['cases']:
 assert re.match(r'^\s*SELECT\b',row['query'],re.I) and not re.search(r'\b(?:INSERT|DELETE|UPDATE|CREATE|ALTER|DROP|EXECUTE)\b',row['query'],re.I)
 assert hashlib.sha256(row['query'].encode()).hexdigest()==row['querySha256']
target=S/'sql-comparison-source-derived-v1.json';assert not target.exists()
source=(R/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text();php=source.split("php=r'''",1)[1].split("'''",1)[0];php=php[:php.index("$out=['profile'")]
payload=base64.b64encode(json.dumps([dict(case=x['case'],query=x['query'],querySha256=x['querySha256']) for x in data['cases']]).encode()).decode()
php+="$cases=json_decode(base64_decode('"+payload+"'),true);\n"+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');$warnings=[];
set_error_handler(function($level,$message)use(&$warnings){$warnings[]=$message;return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'syntheticOnly'=>true,'businessRowsProjected'=>false,'businessWrites'=>false,'globalConfigChanged'=>false,'checks'=>[]];
if($db){foreach($cases as$case){
 $warnings=[];$started=microtime(true);$rs=odbc_exec($db,$case['query']);
 $entry=['case'=>$case['case'],'querySha256'=>$case['querySha256'],'executed'=>(bool)$rs,'literalRows'=>[]];
 if($rs){
  $columns=[];for($i=1;$i<=odbc_num_fields($rs);$i++)$columns[]=['name'=>odbc_field_name($rs,$i),'type'=>odbc_field_type($rs,$i),'precision'=>odbc_field_len($rs,$i),'scale'=>function_exists('odbc_field_scale')?odbc_field_scale($rs,$i):null];$entry['columnMetadata']=$columns;
  while(($row=odbc_fetch_array($rs))!==false){$entry['literalRows'][]=$row;if(count($entry['literalRows'])>3||microtime(true)-$started>10)throw new RuntimeException('Synthetic bounds exceeded');}
 }
 $entry['warningObserved']=count($warnings)>0;$entry['durationMs']=(int)round((microtime(true)-$started)*1000);
 if(!$rs||$entry['warningObserved']){
  $error=implode(' ',$warnings).' '.odbc_errormsg($db);foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);
  $state=odbc_error($db);$entry['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{1,5}$/',$state)?$state:null;$entry['redactedDiagnostic']=$error;
 }
 if($rs)odbc_free_result($rs);$result['checks'][]=$entry;
 if($entry['durationMs']>10000)throw new RuntimeException('Synthetic timeout');
}odbc_close($db);}
restore_error_handler();unset($values,$cfg,$data,$raw,$db,$error,$warnings,$privateValue);echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'businessRowsProjected'=>false,'businessWrites'=>false]);}
'''
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed synthetic SQL fixture failed'
 result=json.loads(raw);result['fixtureSha256']=sha(fixture);target.write_text(json.dumps(result,indent=2)+'\n');print(json.dumps(dict(success=result['success'],businessWrites=False,businessRowsProjected=False,checks=[dict(case=x['case'],executed=x['executed'],rows=len(x['literalRows']),warning=x['warningObserved'],durationMs=x['durationMs']) for x in result.get('checks',[])])))
finally:password=None;c.close()
