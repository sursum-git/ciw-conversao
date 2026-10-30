"""Read-only legacy SQL equality probe: fixed synthetic literals, no business writes."""
from pathlib import Path
import ast, getpass, json, sys
r=Path(__file__).resolve().parents[2];sys.path.insert(0,str(r/'.runtime/ssh-deps'));import paramiko
tree=ast.parse((r/'tools/construtor-local/inspect-ciw-odbc-cadastros.py').read_text())
node=next(n for n in tree.body if isinstance(n,ast.Assign)and any(isinstance(t,ast.Name)and t.id=='PHP'for t in n.targets))
php=ast.literal_eval(node.value).split("$result['connected']=true;")[0]+r'''
$result['connected']=true;$result['checks']=[];
$queries=[
 'case'=>"SELECT CAST('ABC' AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2 UNION SELECT CAST('abc' AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2",
 'padding'=>"SELECT CAST('A' AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2 UNION SELECT CAST('A ' AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2",
 'numeric'=>"SELECT CAST(1.0 AS DECIMAL(10,2)) AS v FROM pub.empresas WHERE empresa_id=2 UNION SELECT CAST(1.00 AS DECIMAL(10,2)) AS v FROM pub.empresas WHERE empresa_id=2",
 'nulls'=>"SELECT CAST(NULL AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2 UNION SELECT CAST(NULL AS VARCHAR(10)) AS v FROM pub.empresas WHERE empresa_id=2"
];
foreach($queries as $name=>$sql){$rs=@odbc_exec($db,$sql);$entry=['success'=>(bool)$rs];if($rs){$count=0;while(odbc_fetch_row($rs))$count++;$entry['rows']=$count;odbc_free_result($rs);}else{$entry['sqlState']=odbc_error($db);}$result['checks'][$name]=$entry;}
odbc_close($db);unset($db,$queries,$sql);echo json_encode($result);
'''
ssh=paramiko.SSHClient();ssh.load_host_keys(str(Path.home()/'.ssh/known_hosts'));ssh.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH CIW (somente memoria): ')
try:
 ssh.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15);password=None
 inp,out,err=ssh.exec_command('php',timeout=75);inp.write(php);inp.flush();inp.channel.shutdown_write();raw=out.read();err.read()
 if out.channel.recv_exit_status()!=0:raise RuntimeError('Probe SQL indisponivel; detalhes privados omitidos')
 value=json.loads(raw);value['businessWrites']=False
 target=r/'.runtime/purchase-quantity-periods-20261028/sql-union-equality.json';assert not target.exists();target.write_text(json.dumps(value,indent=2)+'\n')
 print(json.dumps({'connected':value.get('connected',False),'failureCategory':value.get('failureCategory'),'checks':value.get('checks',{}),'businessWrites':False}))
finally:password=None;ssh.close()
