"""Executa um plano delimitado de transferência/compilação/publicação de containers.
Credenciais são solicitadas no terminal e mantidas somente em memória.
"""
import argparse
import getpass
import json
from pathlib import Path
import sys

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

parser = argparse.ArgumentParser()
parser.add_argument('plan', type=Path)
args = parser.parse_args()
plan = json.loads(args.plan.read_text(encoding='utf-8-sig'))
hosts = {'compiler': ('192.168.0.42', 'tadeu.parreiras'),
         'runtime': ('192.168.0.111', 'root')}
host, user = hosts[plan['server']]
ssh = paramiko.SSHClient()
ssh.load_host_keys(str(Path.home() / '.ssh/known_hosts'))
ssh.set_missing_host_key_policy(paramiko.RejectPolicy())
password = getpass.getpass('Senha SSH ' + host + ': ')
ssh.connect(host, username=user, password=password, look_for_keys=False,
            allow_agent=False, timeout=15, auth_timeout=20, banner_timeout=20)
password = None
try:
    with ssh.open_sftp() as sftp:
        for directory in plan.get('directories', []):
            try:
                sftp.stat(directory)
            except FileNotFoundError:
                sftp.mkdir(directory)
        for transfer in plan.get('uploads', []):
            sftp.put(str(ROOT / transfer['local']), transfer['remote'])
    for command in plan.get('commands', []):
        _, stdout, stderr = ssh.exec_command(command, timeout=180)
        # Escoar ambos os canais, sem bloquear quando o compilador produz saída.
        channel = stdout.channel
        output = bytearray()
        errors = bytearray()
        import time
        deadline = time.monotonic() + 180
        while not channel.exit_status_ready() or channel.recv_ready() or channel.recv_stderr_ready():
            if channel.recv_ready():
                output.extend(channel.recv(65536))
            if channel.recv_stderr_ready():
                errors.extend(channel.recv_stderr(65536))
            if time.monotonic() > deadline:
                channel.close()
                raise TimeoutError('Comando remoto excedeu 180 segundos')
            time.sleep(.05)
        print(output.decode('utf-8', errors='replace'))
        if errors:
            print(errors.decode('utf-8', errors='replace'), file=sys.stderr)
        if channel.recv_exit_status() != 0:
            raise RuntimeError('Comando remoto falhou; consultar diagnóstico acima')
    with ssh.open_sftp() as sftp:
        for transfer in plan.get('downloads', []):
            destination = ROOT / transfer['local']
            destination.parent.mkdir(parents=True, exist_ok=True)
            try:
                sftp.get(transfer['remote'], str(destination))
            except FileNotFoundError:
                if transfer.get('optional') is not True:
                    raise
                print('Ausente (opcional, nao confirmado): ' + transfer['remote'])
                continue
            print('Recebido: ' + transfer['local'])
finally:
    ssh.close()
