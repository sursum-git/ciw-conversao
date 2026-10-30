"""Pass an authorized user's existing credential over a pipe, never disk/arguments."""
from pathlib import Path
import getpass, json, subprocess, sys
root=Path(__file__).resolve().parents[2]
assert sys.argv[1:] and sys.argv[1] in ['login-check','setup','prepare-items','allocate','verify','inspect','cleanup']
password=getpass.getpass('Senha LDAP tadeu.parreiras (somente memoria): ')
payload=json.dumps(dict(username='tadeu.parreiras',password=password));password=None
result=subprocess.run(['node',str(root/'tools/construtor-local/exercise-container-allocation.cjs'),sys.argv[1]],input=payload,text=True,cwd=root)
payload=None
raise SystemExit(result.returncode)
