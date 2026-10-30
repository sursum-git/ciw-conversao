"""Fixed SQL literal arithmetic using the legacy read profile; no business writes."""
from pathlib import Path
import ast,getpass,json,sys
r=Path(__file__).resolve().parents[2];sys.path.insert(0,str(r/'.runtime/ssh-deps'));import paramiko
tree=ast.parse((r/'tools/construtor-local/inspect-ciw-odbc-cadastros.py').read_text())
node=next(n for n in tree.body if isinstance(n,ast.Assign)and any(isinstance(t,ast.Name)and t.id=='PHP'for t in n.targets))
php=ast.literal_eval(node.value).split("$result['connected']=true;")[0].replace("['PROFILE']['especw']","['PROFILE']['ems206espPRO']").replace("'profile'=>'especw'","'profile'=>'ems206espPRO'")+r'''
$result['connected']=true;$result['checks']=[];
$queries=['one_div_zero'=>'1 / 0','zero_div_zero'=>'0 / 0','null_div_one'=>'CAST(NULL AS DECIMAL(10,2)) / 1','null_plus_one'=>'CAST(NULL AS DECIMAL(10,2)) + 1'];
foreach($queries as $name=>$expression){$rs=@odbc_exec($db,'SELECT '.$expression.' AS literal_result FROM PUB.empresas WHERE empresa_id=2');$entry=['success'=>(bool)$rs];if($rs){$rows=[];while($row=odbc_fetch_array($rs)){$rows[]=array_values($row)[0];if(count($rows)>1)break;}$entry['literalResults']=$rows;odbc_free_result($rs);}else{$state=odbc_error($db);$entry['sqlState']=preg_match('/^[A-Z0-9]{5}$/',$state)?$state:null;}$result['checks'][$name]=$entry;}
odbc_close($db);unset($db,$queries);echo json_encode($result);
'''
ssh=paramiko.SSHClient();ssh.load_host_keys(str(Path.home()/'.ssh/known_hosts'));ssh.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 ssh.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=ssh.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
 if out.channel.recv_exit_status()!=0:raise RuntimeError('Literal probe unavailable; private error omitted')
 result=json.loads(raw);result['businessWrites']=False
 target=r/'.runtime/ciw-completion-20261028/sql-literal-arithmetic.json';assert not target.exists();target.write_text(json.dumps(result,indent=2)+'\n')
 print(json.dumps(dict(connected=result.get('connected',False),failureCategory=result.get('failureCategory'),checks=result.get('checks',{}),businessWrites=False)))
finally:password=None;ssh.close()
