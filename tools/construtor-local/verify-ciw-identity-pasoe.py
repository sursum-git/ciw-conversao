"""Valida entrada backend PASOE real; nao equivale a login humano no construtor."""
from pathlib import Path
import json,urllib.request,urllib.error
ROOT=Path(__file__).resolve().parents[2];P=ROOT/'.runtime/ciw-authz-sql-20261019'
cfg=json.loads((P/'private/identity-connection.json').read_text())
base=cfg['url'];headers={'Content-Type':'application/json','X-CiwAccess-Token':cfg['token'],'X-Sursum-User':'tcassimiro','X-Session-Id':'ciw-technical-validation','X-Sursum-Auth-Source':'ima-user-web'}
tests=[('active',{}, {'operation':'identify'},None),('token',{'X-CiwAccess-Token':'x'*64},{'operation':'identify'},401),('local',{'X-Sursum-Auth-Source':'local'},{'operation':'identify'},403),('unknown',{'X-Sursum-User':'CIW_NONEXISTENT_TEST_USER_20261019'},{'operation':'identify'},403),('body',{}, {'operation':'identify','login':'admin'},400),('old_acl',{}, {'operation':'authorize','resource':'cadastros.coloracoes','action':'read'},403)]
proof=[]
for name,changes,body,expected in tests:
 url=base.replace('ciw-identity','ciw-access') if name=='old_acl' else base
 request=urllib.request.Request(url,data=json.dumps(body).encode(),headers=headers|changes,method='POST')
 try:
  with urllib.request.urlopen(request,timeout=12) as response:status=response.status;data=json.load(response)
 except urllib.error.HTTPError as response:status=response.code;data=json.load(response)
 actual=data.get('error',{}).get('status',status) if data.get('success') is not True else None
 passed=actual==expected
 if name=='active':passed=passed and data.get('success') is True and data.get('data',[{}])[0].get('login','').lower()=='tcassimiro'
 proof.append({'case':name,'httpStatus':status,'decisionStatus':actual,'passed':passed})
out={'scope':'backend_identity_preflight_not_human_login','businessWrites':False,'cases':proof}
(P/'pasoe-identity-evidence.json').write_text(json.dumps(out,indent=2));print(json.dumps(out))
if not all(c['passed'] for c in proof):raise SystemExit(1)
