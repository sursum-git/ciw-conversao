"""Copia somente fontes relevantes de aplicações Scriptcase para análise local.

Senha lida por getpass, nunca por argumento ou arquivo. Chave SSH deve estar
previamente cadastrada no known_hosts do usuário.
"""
import argparse
import getpass
from pathlib import Path
import re
import sys

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

parser = argparse.ArgumentParser()
parser.add_argument('apps', nargs='*')
parser.add_argument('--discover', action='store_true')
args = parser.parse_args()
for app in args.apps:
    if not re.fullmatch(r'[A-Za-z0-9_]+', app):
        parser.error('Nome de aplicação inválido')

ssh = paramiko.SSHClient()
ssh.load_host_keys(str(Path.home() / '.ssh/known_hosts'))
ssh.set_missing_host_key_policy(paramiko.RejectPolicy())
password = getpass.getpass('Senha SSH Scriptcase: ')
ssh.connect('192.168.0.170', username='root', password=password,
            look_for_keys=False, allow_agent=False, timeout=12)
password = None
base = '/var/www/clients/client1/web2/web/ciw'
try:
    if args.discover:
        command = ("find " + base + " -maxdepth 1 -type d -iname '*cont*' -printf '%f\\n'; "
                   "grep -l 'bl_ponte_painel_container' " + base + "/*/*_grid.class.php")
        _, stdout, stderr = ssh.exec_command(command, timeout=45)
        print(stdout.read().decode('utf-8', errors='replace'))
        errors = stderr.read().decode('utf-8', errors='replace')
        if errors:
            print(errors, file=sys.stderr)
    with ssh.open_sftp() as sftp:
        for app in args.apps:
            destination = ROOT / 'sources/scriptcase/containers' / app
            destination.mkdir(parents=True, exist_ok=True)
            copied = []
            for name in sftp.listdir(base + '/' + app):
                core = (name == 'index.php' or name == app + '.php' or
                        name == app + '_apl.php' or name == app + '_form0.php' or
                        name == app + '_js0.php' or name == app + '_sajax.php' or
                        name == app + '_sajax_js.php' or name.endswith('_grid.class.php') or
                        name.endswith('_det.class.php') or name.endswith('_lookup.class.php') or
                        name.endswith('_pesq.class.php'))
                if not core or '_mob_' in name or '_mobile_' in name:
                    continue
                sftp.get(base + '/' + app + '/' + name, str(destination / name))
                copied.append(name)
            print(app + ': ' + ', '.join(copied))
finally:
    ssh.close()
