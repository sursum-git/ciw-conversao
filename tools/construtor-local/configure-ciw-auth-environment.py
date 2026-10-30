"""Configura apenas caminho privado; preserva bytes das demais variaveis."""
from pathlib import Path
import re
ROOT=Path(__file__).resolve().parents[2]
private=ROOT/'.runtime/ciw-auth-20261017'
target=Path('D:/opencode/construtor-pg/backend/.env.local')
original=target.read_bytes()
backup=private/'backend-env-before.bin'
if not backup.exists():backup.write_bytes(original)
line=b'CIW_AUTH_CONNECTION_FILE=D:/opencode/conversao-sc/.runtime/ciw-auth-20261017/connection.json'
pattern=rb'(?m)^CIW_AUTH_CONNECTION_FILE=[^\r\n]*'
updated=re.sub(pattern,lambda _:line,original) if re.search(pattern,original) else original.rstrip(b'\r\n')+b'\r\n'+line+b'\r\n'
if target.read_bytes()!=original:raise RuntimeError('Configuracao concorrente')
target.write_bytes(updated)
print('PASS: somente caminho privado CIW_AUTH_CONNECTION_FILE configurado')
