"""Credential only in getpass/memory and anonymous stdin pipe."""
from pathlib import Path
import getpass,json,subprocess,sys
r=Path(__file__).resolve().parents[2];assert sys.argv[1:]and sys.argv[1]in ['setup','resume-setup','maintain','resume-maintain','finish-maintain','verify','cleanup','final']
password=getpass.getpass('Senha LDAP tadeu.parreiras (somente memoria): ')
payload=json.dumps(dict(username='tadeu.parreiras',password=password));password=None
result=subprocess.run(['node',str(r/'tools/construtor-local/exercise-purchase-sample-formats.cjs'),sys.argv[1]],input=payload,text=True,cwd=r);payload=None
raise SystemExit(result.returncode)
