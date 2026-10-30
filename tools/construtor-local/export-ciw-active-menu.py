"""Exporta em modo somente leitura as entradas do menu Scriptcase CIW.

O script usa SSH com chave de host conhecida e senha solicitada em terminal.
Ele não executa aplicações PHP e não altera banco, arquivos ou permissões.
"""
import getpass
import json
from pathlib import Path
import re
import sys

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

REMOTE = r'''
import json,re,subprocess
def sql(query):
    proc=subprocess.run(['mysql','--batch','--skip-column-names','-e',query],stdout=subprocess.PIPE,stderr=subprocess.PIPE,timeout=30)
    if proc.returncode:
        raise RuntimeError('mysql query failed')
    return proc.stdout.decode('utf-8',errors='replace')
try:
    schemas=sql("SELECT TABLE_SCHEMA FROM information_schema.TABLES WHERE TABLE_NAME='itens_menu' ORDER BY TABLE_SCHEMA").splitlines()
    rows=[]
    skipped=[]
    for schema in schemas:
        if not re.fullmatch('[A-Za-z0-9_]+',schema):
            continue
        query=("SELECT menu_id,descricao,link,cod_tipo_link,item_menu_id_pai FROM `"+schema+
               "`.itens_menu ORDER BY menu_id,item_menu_id_pai,descricao")
        try:
            result=sql(query)
        except RuntimeError:
            skipped.append(schema)
            continue
        for line in result.splitlines():
            values=line.split('\t')
            if len(values)==5:
                rows.append({'schema':schema,'menu_id':values[0],'descricao':values[1],
                             'link':values[2],'cod_tipo_link':values[3],'parent_id':values[4]})
    print(json.dumps({'rows':rows,'skippedSchemas':skipped},ensure_ascii=False))
except Exception as exc:
    print(json.dumps({'rows':[],'skippedSchemas':[],'errorType':type(exc).__name__},ensure_ascii=False))
'''


def main() -> None:
    output = ROOT / 'integration-src/ciw-inventory/active-menu-current.json'
    client = paramiko.SSHClient()
    client.load_host_keys(str(Path.home() / '.ssh/known_hosts'))
    client.set_missing_host_key_policy(paramiko.RejectPolicy())
    password = getpass.getpass('Senha SSH CIW (não será salva): ')
    try:
        client.connect('192.168.0.170', username='root', password=password,
                       look_for_keys=False, allow_agent=False, timeout=15)
        password = None
        stdin, stdout, stderr = client.exec_command('python3 -', timeout=90)
        stdin.write(REMOTE)
        stdin.flush()
        stdin.channel.shutdown_write()
        payload = stdout.read().decode('utf-8', errors='replace')
        stderr.read()
        if stdout.channel.recv_exit_status() != 0:
            raise RuntimeError('Leitura remota do menu falhou.')
        report = json.loads(payload)
        output.write_text(json.dumps(report, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
        print(json.dumps({'entries': len(report['rows']), 'skippedSchemas': report.get('skippedSchemas', []), 'output': str(output)}, ensure_ascii=False))
    finally:
        password = None
        client.close()


if __name__ == '__main__':
    main()
