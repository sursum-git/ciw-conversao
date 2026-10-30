"""Atualiza evidencias publicas sanitizadas sem ler configuracoes privadas."""
import json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]
stage=ROOT/'.runtime/ciw-access-20261016/compiled-green'
required={
 'user-web':{'Login','ativo','id','usuario','tp-usuario'},
 'usuarios_grupos':{'login_usuario','cod_grupo'},
 'grupos_aplicacoes':{'cod_grupo','nome_aplicacao','acesso_permitido','insercao_permitida','alteracao_permitida','exclusao_permitida','exportacao_permitida','impressao_permitida'}
}
for table, fields in required.items():
 data=json.loads((stage/('schema-ciw-'+table+'.json')).read_text(encoding='utf-8-sig'))
 data['fields']=[f for f in data['fields'] if f['name'] in fields]
 data['evidence']='ReadCiwAccessSchema.p executado OpenEdge12.2 no .42; somente dicionario'
 (ROOT/'integration-src/ciw-access/schema'/('schema12.2-'+table+'.json')).write_text(json.dumps(data,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print('Tres dicionarios minimos12.2 registrados, sem registros de usuarios.')
