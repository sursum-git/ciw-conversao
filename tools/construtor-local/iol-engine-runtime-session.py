"""Bounded IOL v5 runtime session: readonly baseline/verify and guarded publication.
SSH password and integration token stay in memory. No credentials in process args/logs.
"""
from pathlib import Path
from datetime import datetime,timezone
import getpass,sys,json,hashlib,shutil,http.client
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
state=ROOT/'.runtime/iol-engine-20261019';src=ROOT/'integration-src/iol-pagina-inicial-gerencial'
compiled=state/'compiled122';publish=state/'publish';publish.mkdir(parents=True,exist_ok=True)
config=json.loads((ROOT/'.runtime/iol-gerencial/connection.json').read_text(encoding='utf-8-sig'))
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH runtime IOL: ')
cli.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
digest=lambda data:hashlib.sha256(data).hexdigest()
baseline=None
def api(body,actor='tasilpar',token=True):
 channel=cli.get_transport().open_channel('direct-tcpip',('127.0.0.1',9910),('127.0.0.1',0),timeout=15)
 channel.settimeout(25)
 conn=http.client.HTTPConnection('127.0.0.1',9910,timeout=25);conn.sock=channel
 headers={'Content-Type':'application/json'}
 if actor:headers['X-Sursum-User']=actor
 if token:headers['X-Iol-Gerencial-Token']=config['integrationToken']
 try:
  conn.request('POST','/med/web/SursumPrograms/iol-inicial-gerencial',json.dumps(body),headers)
  response=conn.getresponse();http_status=response.status;data=json.loads(response.read())
  return http_status,data
 finally:conn.close()
def metrics(data):
 values=data['data']
 return {'resumoRows':len(values['resumo']),'vendedoresRows':len(values['vendedores']),
  'dataSha256':digest(json.dumps(values,sort_keys=True,separators=(',',':'),ensure_ascii=False).encode())}
try:
 while True:
  print('Comando restrito: baseline / publish / verify / exit',flush=True)
  action=input().strip()
  if action=='exit':break
  if action=='baseline':
   http_status,data=api({'operation':'read','resource':'painel'})
   if http_status!=200 or data.get('success') is not True:raise RuntimeError('Baseline API failed: '+str(data.get('error',{}).get('code')))
   baseline=metrics(data);(state/'baseline-live.json').write_text(json.dumps({'at':datetime.now(timezone.utc).isoformat(),'user':'tasilpar',**baseline},indent=2))
   print('PASS baseline tasilpar; resumo='+str(baseline['resumoRows'])+' vendedores='+str(baseline['vendedoresRows']),flush=True)
  elif action=='publish':
   if baseline is None:raise RuntimeError('Readonly baseline required first')
   bound=json.loads((compiled/'compiled-source-hashes.json').read_text())
   for name,sha in bound.items():
    if digest((src/name).read_bytes())!=sha:raise RuntimeError('Source changed since compile: '+name)
   names=[n+'.'+e for n in ['IolInicialGerencial','IolGerencialIdentityService','IolGerencialCollector','IolGerencialCalculator','IolGerencialEnginePolicy'] for e in ['p','r']]
   names+=['IolReadBuffers.i','IolGerencialAggregate128.p','CompileIolGerencial128.p']
   manifest={'files':{}}
   for name in names:
    origin=compiled/name if name.endswith('.r') else src/name
    data=origin.read_bytes();(publish/name).write_bytes(data);manifest['files'][name]=digest(data)
   (publish/'manifest.json').write_text(json.dumps(manifest,indent=2))
   shutil.copyfile(ROOT/'.runtime/iol-gerencial/publish/active-manifest-v4.json',publish/'previous-active-manifest.json')
   extra=['compile-iol.log','iol-engine-parameter-install.log']+[p+'-'+c+'.log' for p in ['calculator','identity','boundary','engine-policy'] for c in ['AMERICAN','EUROPEAN']]
   for name in extra:shutil.copyfile(compiled/name,publish/name)
   stage='/tmp/codex-iol-engine-20261019'
   with cli.open_sftp() as sf:
    try:sf.mkdir(stage)
    except OSError:pass
    for name in names+extra+['manifest.json','previous-active-manifest.json']:sf.put(str(publish/name),stage+'/'+name)
    sf.put(str(ROOT/'tools/construtor-local/publish-iol-engine-v5.py'),stage+'/publish-iol-engine-v5.py')
   _,out,err=cli.exec_command('python3 /tmp/codex-iol-engine-20261019/publish-iol-engine-v5.py',timeout=90)
   output=out.read().decode();errors=err.read().decode();status=out.channel.recv_exit_status()
   print(output,flush=True)
   if status!=0:raise RuntimeError('Publish failed: '+errors)
   with cli.open_sftp() as sf:sf.get(stage+'/active-manifest-v5.json',str(publish/'active-manifest-v5.json'))
  elif action=='verify':
   http_status,data=api({'operation':'read','resource':'painel'})
   if http_status!=200 or data.get('success') is not True:raise RuntimeError('API verification failed: '+str(data.get('error',{}).get('code')))
   current=metrics(data)
   if current['resumoRows']!=1 or current['vendedoresRows']<1:raise RuntimeError('Missing datasets')
   if baseline and current['dataSha256']!=baseline['dataSha256']:raise RuntimeError('Live data differs; inspect concurrent business changes before claiming parity')
   checks=[]
   for label,body,actor,token,expected in [
    ('no-token',{'operation':'read','resource':'painel'},'tasilpar',False,401),
    ('no-identity',{'operation':'read','resource':'painel'},None,True,403),
    ('readonly',{'operation':'update','resource':'painel'},'tasilpar',True,405),
    ('engine-from-client-rejected',{'operation':'read','resource':'painel','engine':'12.8'},'tasilpar',True,422),
    ('identity-from-client-rejected',{'operation':'read','resource':'painel','login':'admin'},'tasilpar',True,422)]:
    _,negative=api(body,actor,token)
    if negative.get('success') is not False or negative.get('error',{}).get('status')!=expected:raise RuntimeError('Boundary failed: '+label)
    checks.append({'name':label,'status':expected})
   for resource in ['resumo','vendedores']:
    _,legacy=api({'operation':'read','resource':resource})
    if legacy.get('success') is not True or not isinstance(legacy.get('data'),list):raise RuntimeError('Legacy resource failed: '+resource)
   result={'at':datetime.now(timezone.utc).isoformat(),'user':'tasilpar','instance':'sursum-api/med','engine':'12.2','baselineEqual':baseline is not None,'checks':checks,**current}
   (state/'pasoe-verification.json').write_text(json.dumps(result,indent=2));print('PASS real PASOE tasilpar; baselineEqual='+str(result['baselineEqual'])+'; 5 boundaries; legacy resources; engine12.2',flush=True)
finally:
 cli.close();config=None;baseline=None
