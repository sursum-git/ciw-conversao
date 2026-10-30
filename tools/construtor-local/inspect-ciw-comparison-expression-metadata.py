"""Describe two frozen SQL expressions with WHERE1=0, never fetch business rows."""
from pathlib import Path
import sys,json,hashlib,base64,getpass,re
root=Path(__file__).resolve().parents[2]
sys.path.insert(0,str(root/'.runtime/ssh-deps'))
import paramiko
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
request=root/'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/sql-physical-expression-metadata-request-v1.json'
assert sha(request)=='ee2575ba7dd70217754520c2d61da0969d0f403d8cd8558b84ed26edd254ce71'
data=json.loads(request.read_text());assert len(data['cases'])==2
for proof in [data['sourceContract'],data['operandMetadataProof'],data['derivedProof']]:assert sha(root/proof['path'])==proof['sha256']
for row in data['cases']:
 assert sha(root/row['sourceGrid'])==row['sourceGridSha256'] and sha(root/row['sourceIndex'])==row['sourceIndexSha256']
 query=row['query'];assert hashlib.sha256(query.encode()).hexdigest()==row['querySha256']
 assert 'WHERE 1=0 AND (' in query and re.match(r'^SELECT ',query) and not re.search(r'\b(INSERT|UPDATE|DELETE|CREATE|ALTER|DROP)\b',query,re.I)
target=root/'.runtime/ciw-completion-20261028/sql-comparison-expression-metadata-v1.json';assert not target.exists()
source=(root/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text()
php=source.split("php=r'''",1)[1].split("'''",1)[0];php=php[:php.index("$out=['profile'")]
payload=base64.b64encode(json.dumps([dict(case=x['case'],query=x['query'],querySha256=x['querySha256'])for x in data['cases']]).encode()).decode()
php+="$cases=json_decode(base64_decode('"+payload+"'),true);\n"+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');$warnings=[];
set_error_handler(function($level,$message)use(&$warnings){$warnings[]=$message;return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'businessRowsProjected'=>false,'businessWrites'=>false,'globalConfigChanged'=>false,'checks'=>[]];
if($db){foreach($cases as$case){
 $warnings=[];$started=microtime(true);$rs=odbc_prepare($db,$case['query']);
 $entry=['case'=>$case['case'],'querySha256'=>$case['querySha256'],'prepared'=>(bool)$rs,'executed'=>false,'rowFetchAttempted'=>false,'businessRowsFetched'=>0,'closedFalsePredicate'=>true];
 if($rs){
  $count=odbc_num_fields($rs);
  if($count!==15){$entry['executed']=odbc_execute($rs);if(!$entry['executed'])$count=0;else $count=odbc_num_fields($rs);}
  $entry['columnMetadata']=[];
  for($i=1;$i<=$count;$i++)$entry['columnMetadata'][]=['name'=>odbc_field_name($rs,$i),'type'=>odbc_field_type($rs,$i),'precision'=>odbc_field_len($rs,$i),'scale'=>odbc_field_scale($rs,$i)];
  $entry['metadataComplete']=$count===15;
 }
 $entry['warningObserved']=count($warnings)>0;$entry['durationMs']=(int)round((microtime(true)-$started)*1000);
 if(!$rs||$entry['warningObserved']){
  $error=implode(' ',$warnings).' '.odbc_errormsg($db);foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);
  $state=odbc_error($db);$entry['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{1,5}$/',$state)?$state:null;$entry['redactedDiagnostic']=$error;
 }
 if($rs)odbc_free_result($rs);$result['checks'][]=$entry;
 if($entry['durationMs']>10000)throw new RuntimeException('Metadata timeout');
}odbc_close($db);}
restore_error_handler();unset($values,$cfg,$data,$raw,$db,$error,$warnings,$privateValue);echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'businessRowsProjected'=>false,'businessWrites'=>false]);}
'''
client=paramiko.SSHClient();client.load_host_keys(str(Path.home()/'.ssh/known_hosts'));client.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 client.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=client.exec_command('php',timeout=40);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0
 result=json.loads(raw);result['requestSha256']=sha(request);target.write_text(json.dumps(result,indent=2)+'\n')
 print(json.dumps(dict(success=result['success'],businessRowsProjected=False,businessWrites=False,checks=[dict(case=x['case'],prepared=x['prepared'],executed=x['executed'],metadataComplete=x.get('metadataComplete',False),columns=len(x.get('columnMetadata',[])),warning=x['warningObserved'])for x in result.get('checks',[])])))
finally:password=None;client.close()
