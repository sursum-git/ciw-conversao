"""Read-only source check of the PHP Ideal Loja block; no credentials/source dump."""
from pathlib import Path
from datetime import datetime,timezone
import getpass,sys,json,hashlib
ROOT=Path(__file__).resolve().parents[2];sys.path.insert(0,str(ROOT/'.runtime/ssh-deps'))
import paramiko
cli=paramiko.SSHClient();cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'));cli.set_missing_host_key_policy(paramiko.RejectPolicy())
password=getpass.getpass('Senha SSH Scriptcase IOL: ')
cli.connect('192.168.0.170',username='root',password=password,look_for_keys=False,allow_agent=False,timeout=15)
password=None
try:
 remote='/var/www/clients/client1/web2/web/iol/bl_pag_ini_ger/index.php'
 with cli.open_sftp() as sf:
  with sf.open(remote,'rb') as stream:data=stream.read()
 text=data.decode('utf-8',errors='replace');lines=text.splitlines()
 start=text.index('<span class="meta-label">% Ideal</span>');block=text[start:start+600]
 result={'at':datetime.now(timezone.utc).isoformat(),'host':'192.168.0.170','path':remote,
  'sha256':hashlib.sha256(data).hexdigest(),
  'sameAsLocalSource':data==(ROOT/'sources/scriptcase/iol/bl_pag_ini_ger/index.php').read_bytes(),
  'formulaPresent':'$percMetaIdeal = round($metaIdeal / $metaVendedores * 100, 0);' in text,
  'idealTextHardcodedZero':'<span class="meta-value">0%</span>' in block,
  'idealBarHardcodedZero':'style="width: 0%"' in block,
  'usesCalculatedValueInIdealCard':'$percMetaIdeal' in block,
  'formulaLine':next(i+1 for i,l in enumerate(lines) if '$metaIdeal = $metaVendedores / $qtDiasMes * $qtDias;' in l),
  'idealCardLine':next(i+1 for i,l in enumerate(lines) if '<span class="meta-label">% Ideal</span>' in l)}
 if not result['formulaPresent'] or not result['idealTextHardcodedZero'] or not result['idealBarHardcodedZero'] or result['usesCalculatedValueInIdealCard']:
  raise RuntimeError('Live source differs from diagnosis; inspect targeted code')
 state=ROOT/'.runtime/iol-ideal-20261019';state.mkdir(exist_ok=True)
 (state/'php-source-verification.json').write_text(json.dumps(result,indent=2))
 print(json.dumps(result,indent=2))
finally:cli.close()
