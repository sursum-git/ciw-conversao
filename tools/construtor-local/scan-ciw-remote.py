"""Somente leitura: roda no servidor via python3 -, nunca executa PHP."""
import datetime
import hashlib
import json
import os
import re

BASE = '/var/www/clients/client1/web2/web/ciw'
entries, errors = [], []
directory_names = {n for n in os.listdir(BASE) if os.path.isdir(os.path.join(BASE, n))}
for app in sorted(os.listdir(BASE)):
    path = os.path.join(BASE, app)
    if not os.path.isdir(path) or app.startswith('.'):
        continue
    try:
        names = sorted(os.listdir(path))
        is_app = not app.startswith('_') and ('index.php' in names or app + '.php' in names)
        row = dict(name=app, application_candidate=is_app,
                   technical_type='infraestrutura_ou_diretorio_sem_entrada', evidence=[])
        if is_app:
            row['technical_type'] = 'blank_ou_pagina_revisar'
            if app + '_grid.class.php' in names:
                row['technical_type'] = 'consulta'
                row['evidence'].append(app + '_grid.class.php')
            elif app + '_apl.php' in names:
                row['technical_type'] = 'formulario_ou_controle'
                row['evidence'].append(app + '_apl.php')
            elif app.startswith('menu_'):
                row['technical_type'] = 'menu_por_nome_revisar'
            elif app.startswith('bl_'):
                row['technical_type'] = 'blank_por_nome_revisar'
            row['core_files'] = [n for n in names if n in
                ('index.php', app + '.php', app + '_apl.php', app + '_grid.class.php')]
            signatures, refs, tables, primary_tables = [], set(), set(), set()
            for name in row['core_files']:
                with open(os.path.join(path, name), 'rb') as source:
                    data = source.read()
                text = data.decode('utf-8', errors='replace')
                grid = re.search(r'var\s+\$Grid_editavel\s*=\s*(true|false)', text)
                if grid and grid.group(1) == 'true':
                    row['technical_type'] = 'formulario_multi_registro'
                # Somente identificadores; nao exporta trechos de fonte/configuracao.
                refs.update(re.findall(r'\.\./([A-Za-z][A-Za-z0-9_]+)/', text))
                refs.update(set(re.findall(r'''["']([A-Za-z][A-Za-z0-9_]+)["']''', text)) & directory_names)
                for literal in re.findall(r'''\$this->nm_tabela\s*=\s*("(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*')''', text):
                    table_name = literal[1:-1].replace('\\"', '"').replace("\\'", "'")
                    if re.fullmatch(r'[A-Za-z0-9_."-]+', table_name):
                        primary_tables.add(table_name)
                for table in re.findall(r'(?:FROM|JOIN|INTO|UPDATE)\s+((?:PUB\.)?[A-Za-z_][A-Za-z0-9_-]*)', text, re.I):
                    if table.upper() not in ('SET', 'WHERE', 'SELECT'):
                        tables.add(table.lower())
                signatures.append(dict(file=name, bytes=len(data),
                                       sha256=hashlib.sha256(data).hexdigest()))
            row['signatures'] = signatures
            row['application_references_candidates'] = sorted(refs - {'_lib', app})
            row['table_tokens_candidates'] = sorted(tables)
            row['primary_tables'] = sorted(primary_tables)
        entries.append(row)
    except (OSError, IOError) as exc:
        errors.append(dict(application=app, error_type=type(exc).__name__))
print(json.dumps(dict(scope='ciw', host='192.168.0.170', root=BASE,
    collected_at=datetime.datetime.now(datetime.timezone.utc).isoformat(),
    coverage='diretorios imediatos e leitura integral dos fontes principais; sem executar PHP',
    listing_complete=not errors, entries=entries, errors=errors), ensure_ascii=False))
