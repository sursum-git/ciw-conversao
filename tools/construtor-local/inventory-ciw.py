"""Inventaria CIW via SSH, sem executar PHP e sem armazenar credenciais.

Execute em terminal interativo; a senha e solicitada por getpass.
Somente nomes, assinaturas tecnicas e hashes sao gravados no inventario.
Tipos funcionais e estado de conversao precisam ser revisados separadamente.
"""
import argparse
import getpass
import json
from pathlib import Path
import sys

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

def main():
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('--output', type=Path,
                        default=ROOT / 'integration-src/ciw-inventory/remote-inventory.json')
    parser.add_argument('--key-auth', action='store_true')
    args = parser.parse_args()
    client = paramiko.SSHClient()
    client.load_host_keys(str(Path.home() / '.ssh/known_hosts'))
    client.set_missing_host_key_policy(paramiko.RejectPolicy())
    password = None if args.key_auth else getpass.getpass('Senha SSH CIW (nao sera salva): ')
    try:
        client.connect('192.168.0.170', username='root', password=password,
                       look_for_keys=args.key_auth, allow_agent=args.key_auth, timeout=15)
        password = None
        remote_scanner = Path(__file__).with_name('scan-ciw-remote.py').read_text(encoding='utf-8')
        stdin, stdout, stderr = client.exec_command('python3 -', timeout=180)
        stdin.write(remote_scanner)
        stdin.flush()
        stdin.channel.shutdown_write()
        payload = stdout.read().decode('utf-8')
        stderr.read()  # Nao copiar diagnostico remoto, que pode conter dados privados.
        exit_code = stdout.channel.recv_exit_status()
        if exit_code != 0:
            raise RuntimeError('Coleta remota falhou (codigo %s). Nenhum PHP executado.' % exit_code)
        report = json.loads(payload)
        args.output.parent.mkdir(parents=True, exist_ok=True)
        args.output.write_text(json.dumps(report, ensure_ascii=False, indent=2), encoding='utf-8')
        print('Inventario: %s aplicacoes, %s diretorios, %s erros.' % (
            sum(e['application_candidate'] for e in report['entries']),
            len(report['entries']), len(report['errors'])), flush=True)
        print('Salvo em: ' + str(args.output), flush=True)
    finally:
        password = None
        client.close()


if __name__ == '__main__':
    main()
