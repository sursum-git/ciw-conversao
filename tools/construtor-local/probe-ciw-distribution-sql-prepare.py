"""Prepare only six frozen legacy SELECTs; never executes or fetches a statement."""
from pathlib import Path
import sys,json,getpass,hashlib,base64,re
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
sys.path.insert(0,str(R/'.runtime/ssh-deps'))
import paramiko
fixture=R/'integration-src/ciw-completion-20261028/cost-distribution-readonly/sql-prepare-aliases-v1.json'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert sha(fixture)=='8d6a0f96a38f3a44a01b3899301352ad5c456209afd6ded4289c8546fdb0b5db'
data=json.loads(fixture.read_text());assert data['policy']['prepareOnly'] and not data['policy']['executeAllowed']
assert sha(R/data['source']['path'])==data['source']['sha256']
cases=data['queries'] if 'queries' in data else data['cases'];assert len(cases)==6
for row in cases:
 assert row['execute'] is False and re.match(r'^\s*SELECT\b',row['query'],re.I)
 assert not re.search(r'\b(?:INSERT|UPDATE|DELETE|CREATE|ALTER|DROP|EXECUTE)\b',row['query'],re.I)
 assert hashlib.sha256(row['query'].encode()).hexdigest()==row['querySha256']
target=S/'sql-distribution-prepare-only-v2.json';assert not target.exists()
source=(R/'tools/construtor-local/diagnose-ciw-legacy-sql-profile.py').read_text()
php=source.split("php=r'''",1)[1].split("'''",1)[0];php=php[:php.index("$out=['profile'")]
payload=base64.b64encode(json.dumps([{'case':x['case'],'query':x['query'],'querySha256':x['querySha256']} for x in cases]).encode()).decode()
php+="$cases=json_decode(base64_decode('"+payload+"'),true);\n"+r'''
putenv('ODBCINI=/etc/odbc.ini');putenv('LANG=en_US');set_error_handler(function(){return true;});
$db=odbc_connect($values['VAL_HOST'],$values['VAL_USER'],$values['VAL_PASS']);
$result=['success'=>(bool)$db,'connected'=>(bool)$db,'prepareOnly'=>true,'statementExecuted'=>false,'statementFetched'=>false,'businessWrites'=>false,'businessReads'=>false,'globalConfigChanged'=>false,'checks'=>[]];
if($db){foreach($cases as$case){
 $statement=odbc_prepare($db,$case['query']);$entry=['case'=>$case['case'],'querySha256'=>$case['querySha256'],'prepared'=>(bool)$statement,'executed'=>false];
 if($statement)odbc_free_result($statement);
 else{$state=odbc_error($db);$error=odbc_errormsg($db);foreach($values as$privateValue)if(is_string($privateValue)&&$privateValue!=='')$error=str_replace($privateValue,'[private-value-omitted]',$error);$entry['sqlState']=is_string($state)&&preg_match('/^[A-Z0-9]{1,5}$/',$state)?$state:null;$entry['redactedDiagnostic']=$error;}
 $result['checks'][]=$entry;
}odbc_close($db);}
restore_error_handler();unset($values,$cfg,$data,$raw,$db,$cases,$case,$error,$privateValue);echo json_encode($result,JSON_INVALID_UTF8_SUBSTITUTE);
}catch(Throwable $failure){echo json_encode(['success'=>false,'exceptionClass'=>get_class($failure),'statementExecuted'=>false,'businessWrites'=>false]);}
'''
assert 'odbc_exec(' not in php and 'odbc_execute(' not in php and 'odbc_fetch' not in php
c=paramiko.SSHClient();c.load_host_keys(str(Path.home()/'.ssh/known_hosts'));c.set_missing_host_key_policy(paramiko.RejectPolicy());password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 c.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=c.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read();assert out.channel.recv_exit_status()==0,'Closed PREPARE-only probe failed'
 result=json.loads(raw);result['fixtureSha256']=sha(fixture);target.write_text(json.dumps(result,indent=2)+'\n');summary={k:v for k,v in result.items() if k!='checks'};summary['checks']=[{k:v for k,v in row.items() if k!='redactedDiagnostic'} for row in result.get('checks',[])];print(json.dumps(summary))
finally:password=None;c.close()
