"""Copia fontes da pagina inicial gerencial, sem executar PHP legado."""
import getpass
import hashlib
import json
from pathlib import Path
import sys

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

client = paramiko.SSHClient()
client.load_host_keys(str(Path.home() / '.ssh/known_hosts'))
client.set_missing_host_key_policy(paramiko.RejectPolicy())
password = getpass.getpass('Senha SSH Scriptcase: ')
client.connect('192.168.0.170', username='root', password=password,
               look_for_keys=False, allow_agent=False, timeout=15)
password = None
base = '/var/www/clients/client1/web2/web/iol/bl_pag_ini_ger'
destination = ROOT / 'sources/scriptcase/iol/bl_pag_ini_ger'
destination.mkdir(parents=True, exist_ok=True)
files = []
try:
    with client.open_sftp() as sftp:
        for name in sftp.listdir(base):
            if '/' in name or '\\' in name or not name.endswith(('.php', '.html', '.css', '.js')):
                continue
            if name.endswith('.config.php'):
                continue
            target = destination / name
            sftp.get(base + '/' + name, str(target))
            files.append({'name': name, 'sha256': hashlib.sha256(target.read_bytes()).hexdigest()})
    manifest = ROOT / 'integration-src/iol-pagina-inicial-gerencial/source-manifest.json'
    manifest.write_text(json.dumps({'remote': base, 'files': files}, indent=2), encoding='utf-8')
    print('Copiados: ' + ', '.join(item['name'] for item in files))
finally:
    client.close()
