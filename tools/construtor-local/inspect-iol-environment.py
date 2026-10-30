"""Verifica versao/conexoes e exporta somente dicionarios fixos IOL."""
from pathlib import Path
import getpass
import json
import sys
import base64

ROOT = Path(__file__).resolve().parents[2]
sys.path.insert(0, str(ROOT / '.runtime/ssh-deps'))
import paramiko

password = getpass.getpass('Credencial protegida para compilador/PASOE: ')
dest = ROOT / 'integration-src/iol-pagina-inicial-gerencial/schema'
dest.mkdir(parents=True, exist_ok=True)
stage = 'C:/Users/tadeu.parreiras/codex-iol-gerencial-20261016'
sources = {'espec': ['user-web','usuarios_grupos','cm-hierarquia','cm-ext-repres','fats_repres','transacoes','metas_repres','metas_gerencial','metas_geral','peds_web','im-param'],
           'ems2cad': ['repres'], 'ems2med': ['ped-venda','ped-repre','nota-fiscal','natur-oper','devol-cli','docum-est'], 'ems5':['dia_calend_glob']}
abl = ['BLOCK-LEVEL ON ERROR UNDO, THROW.', 'USING Progress.Json.ObjectModel.*.',
       'DEFINE VARIABLE rows AS JsonArray NO-UNDO.', 'DEFINE VARIABLE item AS JsonObject NO-UNDO.',
       'DEFINE VARIABLE cols AS JsonArray NO-UNDO.', 'DEFINE VARIABLE fld AS JsonObject NO-UNDO.',
       'rows = NEW JsonArray().']
for db, names in sources.items():
    for name in names:
        abl += [f'FOR FIRST {db}._File NO-LOCK WHERE {db}._File._File-Name = "{name}":',
                ' item = NEW JsonObject().', f' item:Add("table", "{db}.{name}").', ' cols = NEW JsonArray().',
                f' FOR EACH {db}._Field NO-LOCK WHERE {db}._Field._File-recid = RECID({db}._File) BY {db}._Field._Order:',
                '  fld = NEW JsonObject().', f'  fld:Add("name", {db}._Field._Field-Name).',
                f'  fld:Add("type", {db}._Field._Data-Type).', f'  fld:Add("format", {db}._Field._Format).',
                f'  fld:Add("extent", {db}._Field._Extent).', '  cols:Add(fld).', ' END.',
                ' item:Add("fields",cols).', ' rows:Add(item).', 'END.']
abl += ['rows:WriteFile("iol-schema.json",TRUE).', 'OUTPUT TO "iol-schema-pass.log".',
        'PUT UNFORMATTED PROVERSION SKIP "PASS schema readonly" SKIP.', 'OUTPUT CLOSE.', 'QUIT.']

def connect(host, user):
    cli = paramiko.SSHClient()
    cli.load_host_keys(str(Path.home()/'.ssh/known_hosts'))
    cli.set_missing_host_key_policy(paramiko.RejectPolicy())
    cli.connect(host, username=user, password=password, look_for_keys=False, allow_agent=False, timeout=15)
    return cli

for host,user in [('192.168.0.42','tadeu.parreiras'),('192.168.0.111','root')]:
    cli = None
    try:
        cli = connect(host,user)
        if host.endswith('.42'):
            with cli.open_sftp() as sftp:
                try: sftp.mkdir(stage)
                except OSError: pass
                with sftp.open(stage+'/ExportIolSchema.p','w') as file: file.write('\n'.join(abl))
            args=''
            for db,port in [('espec',10012),('ems2cad',10033),('ems2med',10031),('ems5',10032)]:
                args += f' -db {db} -H 192.168.0.111 -S {port} -N TCP -ld {db}'
            ps = f"Set-Location -LiteralPath '{stage}'; & 'C:/Progress_12/OE/bin/_progres.exe' -b -cpinternal UTF-8 -cpstream UTF-8{args} -p ExportIolSchema.p *> schema-process.log"
            cmd='powershell -NoProfile -EncodedCommand '+base64.b64encode(ps.encode('utf-16le')).decode()
            _,out,err=cli.exec_command(cmd,timeout=150)
            out.read(); err.read()
            with cli.open_sftp() as sftp:
                for name in ['iol-schema.json','iol-schema-pass.log','schema-process.log']:
                    sftp.get(stage+'/'+name, str(dest/name))
            print(host+': schema export concluido; logs locais em schema/.')
        else:
            _,out,err=cli.exec_command("test -d /dados/pasoe/sursum-api && /usr/dlc12/bin/showcfg /usr/dlc12/progress.cfg | head -n 8",timeout=20)
            # Retain only the read-only operational success, never license/customer output.
            out.read(); err.read()
            print(host+': autenticacao PASOE confirmada.')
    except Exception as e:
        print(host+': '+type(e).__name__+'; operacao nao concluida.')
    finally:
        if cli: cli.close()
password = None
