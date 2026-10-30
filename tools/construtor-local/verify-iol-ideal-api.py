"""Read-only Ideal Loja verification; persist only calendar/indicator fields."""
from pathlib import Path
from datetime import datetime,timezone
from decimal import Decimal,ROUND_HALF_UP
import getpass,sys,json,http.client
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
config=json.loads((ROOT/'.runtime/iol-gerencial/connection.json').read_text(encoding='utf-8-sig'))
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH PASOE IOL: ')
cli.connect('192.168.0.111',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
try:
 channel=cli.get_transport().open_channel('direct-tcpip',('127.0.0.1',9910),('127.0.0.1',0),timeout=15);channel.settimeout(25)
 conn=http.client.HTTPConnection('127.0.0.1',9910,timeout=25);conn.sock=channel
 try:
  conn.request('POST','/med/web/SursumPrograms/iol-inicial-gerencial',json.dumps({'operation':'read','resource':'resumo'}),
   {'Content-Type':'application/json','X-Iol-Gerencial-Token':config['integrationToken'],'X-Sursum-User':'tasilpar'})
  response=conn.getresponse();data=json.loads(response.read())
 finally:conn.close()
 if data.get('success') is not True:raise RuntimeError('API failed: '+str(data.get('error',{}).get('code')))
 row=data['data'][0]
 fields=['competencia','data_referencia','percentual_loja_ideal','dias_uteis_mes','dias_uteis_passados','dias_uteis_restantes']
 result={'at':datetime.now(timezone.utc).isoformat(),'user':'tasilpar','instance':'sursum-api/med',**{f:row[f] for f in fields}}
 expected=int((Decimal(row['dias_uteis_passados'])/Decimal(row['dias_uteis_mes'])*100).quantize(Decimal('1'),rounding=ROUND_HALF_UP))
 result['calendarRatioRounded']=expected
 result['matchesCalendarRatio']=row['percentual_loja_ideal']==expected
 state=ROOT/'.runtime/iol-ideal-20261019';state.mkdir(exist_ok=True)
 (state/'api-verification.json').write_text(json.dumps(result,indent=2));print(json.dumps(result,indent=2))
finally:cli.close();config=None
