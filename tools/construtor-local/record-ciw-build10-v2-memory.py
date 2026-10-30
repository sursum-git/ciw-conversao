"""Record the completed official companion and the remaining candidate-limit gate."""
from pathlib import Path
import json, hashlib, re, shutil

root = Path(__file__).resolve().parents[2]
state = root / '.runtime/ciw-completion-20261028'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
build = state / 'official-build10-v2'
runtime = state / 'runtime-build10'
official = load(build / 'official-compile-verification.json')
active = load(runtime / 'active-manifest.json')
diagnostic = load(runtime / 'pasoe-limit-diagnostic-proof.json')
assert official['success'] and official['totalChecks'] == 1160
assert active['success'] and active['medWebRestored'] and active['imaWebUnchanged'] and len(active['targets']) == 2
assert diagnostic['success'] and diagnostic['positiveGet'] and not diagnostic['metadataReady']
assert [x['limit'] for x in diagnostic['containers'] if not x['success']] == ['CONTAINER_NF_CANDIDATE_LIMIT'] * 4
canonical = load(build / 'canonical-manifest.json')
assert canonical['success'] and len(canonical['files']) == 1
assert sha(Path(canonical['files'][0]['target'])) == canonical['files'][0]['sha256']
backup = state / 'memory-build10-v2-backup'
backup.mkdir()
note = '''## Checkpoint 10-v2 — publicado; limite da consulta identificado

Este checkpoint prevalece sobre os estados históricos abaixo. Oficial11484 CONCLUÍDO/exit0: oito compilações OpenEdge12.2/.42, oito logs TT/1.160 verificações/NUMDBS0. Release5c8a489b... e manager26cebbed...; não repetir. Verificação oficial e integração de um único Service.p614795f3... concluídas, com baseline09678e8f... e backup. Runtime69021 CONCLUÍDO: somente Service.p/r, sursum-api/MED/9911 pelo share137; MED restaurado após8,173s, sessões145/146 recarregadas no mesmo pid3856625, estado IMA preservado. Sem rotas, autenticação, metadados ou negócio alterados. Recibos official-build10-v2/{official-compile-verification,canonical-manifest}.json e runtime-build10/{active-manifest,publication-attempt,manager-publication-review}.json. Não repetir publicação.

Diagnóstico PASOE CONCLUÍDO: GET positivo da chave já observada no container333426 e rejeição422 de alias com espaço final, alias lowercase e ID lowercase. Consulta333426 retorna104linhas. Os quatro containers332526/331126/200019/1525 atingem especificamente CONTAINER_NF_CANDIDATE_LIMIT(200), não source-limit50mil nem timeout10s. Prova runtime-build10/pasoe-limit-diagnostic-proof.json, metadataReady=false. Metadados1053 continuam RETIDOS; falta solução completa para volume sem truncar dados e validação final antes do catálogo. Gerente deve compor o próximo companion sobre614795, preservando onze recursos antigos. Tentativa10 original40264 falhou por HEX-ENCODE(RAW) incompatível12.2; não repetir nem usar seus artefatos. Correção10-v2 usa MEMPTRdireto/SUBSTRING134, comprovada isoladamente e no pacote oficial.

SQL1040/41: sessão95118 CONCLUÍDA, fixturev2 SHA8c9e15ed... e revisão b49917ee...,14SELECTs de constantes derivados com único systemanchor SYSPROGRESS.SYSCALCTABLE. Dez consultas executaram/24linhas sintéticas; quatro casos de divisor conhecido zero recusados. Resultados/nullflags/metadados em sql-comparison-source-derived-v2.json; executor deve absorver sem confundir fetchODBC0 com SQLNULL. V1 falhou apenas na sintaxe UNION sem FROM; preservar ambas as provas, não repetir. Sem dados comerciais/DML/configuração global. SQLTables34017 CONCLUÍDO: os quatro nomes PUB tipos_valor/empresas_imposto/desenhos/tipos_desenho não visíveis no perfil espec_pro observado; prova sql-four-pending-tables-metadata-v1.json, não conclui ausência universal. Processo usa ODBCINI=/etc/odbc.ini apenas no PHP filho; não alterar configuração global.

Objetivo GLOBAL ACTIVE. Controles FINAL. Três reads da resposta call_5111 já concedidas/verificadas anteriormente; não conceder novamente. Novos acessos ficam para o final. 1055 ainda candidato, deve rebasear Service sobre614795 antes do próximo pacote. 1054 congelado/retido sem hooklogin ou escritaERP; anexos container aguardam caminho/backup do acervo146ausentes, não repetir probes. Manter bibliotecas de negócio reutilizáveis e auditoria com usuário e valores anteriores/atuais. Sem segredos/DDL/commit/push.

'''
paths = [root/'context/PROJECT_CONTEXT.md', root/'context/RETOMADA_2026-10-16.md', Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
marker = '<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->\n\n' + note + '<!-- END CIW_COMPLETION_GOAL_20261028 -->'
receipts=[]
for i,path in enumerate(paths):
    before=path.read_bytes(); text=before.decode('utf-8-sig')
    assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->') == 1
    shutil.copy2(path,backup/(str(i)+'-'+path.name))
    updated=re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->',lambda _:marker,text,count=1,flags=re.S)
    path.write_text(updated,encoding='utf-8')
    receipts.append(dict(path=str(path),before=hashlib.sha256(before).hexdigest(),after=sha(path)))
detail=root/'context/CIW_COMPLETION_GOAL_2026-10-28.md'
text=detail.read_text(encoding='utf-8-sig'); assert '## Checkpoint 10-v2 — publicado;' not in text
shutil.copy2(detail,backup/detail.name)
line,rest=text.split('\n',1); detail.write_text(line+'\n\n'+note+rest,encoding='utf-8')
work=load(state/'ROOT_ACTIVE.json')
work.update(officialBuild10='V2COMPLETED11484_8COMPILES1160TT_CANONICAL1_RUNTIME2_69021_MEDRESTORED8.173S',metadata9='HELD_4CANDIDATE_LIMIT200_NO_FINALPROOF_ALIAS_FIXED_PASOE',sqlDerived1040='V2COMPLETED95118_14SYNTHETICSELECT_10EXECUTED4ZEROERROR_NO_DML',sqlTablesFour='COMPLETED34017_METADATAONLY_4NOTVISIBLE_OBSERVEDPROFILE',next='1053_SOLVE_CANDIDATE_LIMIT_BEFORE_METADATA;1055_REBASE614795;GLOBALACTIVE')
(state/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(state/'memory-build10-v2.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',files=receipts,businessWrites=False),indent=2)+'\n')
print('PASS four entrypoints and detailed memory updated; global goal remains ACTIVE; metadata held')
