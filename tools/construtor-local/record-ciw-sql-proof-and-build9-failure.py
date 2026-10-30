"""Record new SQL evidence and failed, unpublished build9 without erasing history."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
receipt=S/'memory-sql-proof-build9-failure.json';assert not receipt.exists()
connection=load(S/'sql-fixed-odbcini-process-v1.json');assert connection['connected'] and not connection['sqlExecuted']
literal=load(S/'sql-fixed-literal-parity-v1.json');aggregate=load(S/'sql-fixed-aggregate-parity-v1.json')
assert literal['success'] and aggregate['success'] and len(literal['checks'])==8 and len(aggregate['checks'])==9
assert not literal['businessWrites'] and not aggregate['businessWrites']
failure=S/'official-build9/compiled122/compile.log';assert 'FAIL COMPILE' in failure.read_text() and 'JsonProgramWebHandler.cls COMPILER:ERROR=yes' in failure.read_text()
note='''

Checkpoint seguinte: o lote9 do seletor de NFs NÃO foi publicado. A tentativa oficial24676 falhou na classe estável JsonProgramWebHandler.cls, linha151 (247/198), antes das suítes TT. Logs recuperados por51303. O reader novo não introduz dependência estática nessa classe; preservar seus fontes e artefatos. Gerente prepara pacote9-v2 em estágio novo, excluindo só essa compilação alheia e mantendo o produto1053 idêntico. Não repetir24676 nem usar seus artefatos como compilação aprovada. FULLPHP9 passou968 testes/6529 asserções; ainda falta oficial12.2 válida, integração e publicação9.

A conexão SQL de leitura foi comprovada no servidor170 com ODBCINI=/etc/odbc.ini somente no processo PHP de diagnóstico. Nenhuma configuração global mudou. O erro1201 significava No Host Name; o driver não recebia ODBCINI. A porta10112 e o driver64bit estão presentes. Não atribuir esse erro à VPN. Recibos sql-fixed-odbcini-process-v1, sql-fixed-literal-parity-v1 e sql-fixed-aggregate-parity-v1.json. Dezessete SELECTs de constantes passaram/recusaram conforme documentado, sem projetar dados comerciais ou executar DML. Divisões porzero recusadas; SUMvazio/allNULL resultaNULL; COALESCE resulta0; UNION deduplica e ALL preserva duas linhas. NULLaritmético satisfaz IS NULL no SQL embora o fetchODBC exponha0; não confundir transporte com semântica SQL. UNIONdata+vazio retorna CHARACTER e formatoMM/DD/YYYY. Esses fatos permitem avançar1040/41/48; ainda faltam absorção no produto e decisões específicas. Não executar INSERT de vetor31 sem cenário autorizado; gate1054mantido.

Reconciliação de cinco consultas de cadastros aplicada só em remaining/evidence, preservando estados/destinos/contagens; recibo cadastro-query-reconciliation-applied.json. Lookup grid_despesas_impostos coletado e sanitizado, hash0338ba51658129c761e0bcb4164e88f02fb4319bfc5d47396a6ea1a31e610b26; lookup do formulário ausente, sem fallback. Próxima descoberta1055 consulta global não substitui a manutenção existente por empresa/despesa. Controles permanece FINAL; objetivo global ATIVO.
'''
targets=[R/'context/PROJECT_CONTEXT.md',R/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
changes=[]
backup=S/'memory-sql-proof-build9-failure-backups';assert not backup.exists();backup.mkdir()
for n,p in enumerate(targets):
 raw=p.read_bytes();text=raw.decode('utf-8-sig');end=text.index('<!-- END CIW_COMPLETION_GOAL_20261028 -->');saved=backup/str(n);saved.write_bytes(raw)
 assert p.read_bytes()==raw;p.write_bytes((text[:end]+note+text[end:]).encode('utf-8'));changes.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=sha(p),backup=str(saved)))
detail=R/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=detail.read_text();marker='## Build8 publicado e validado — seleção de despesas e duas consultas';assert marker in text
detail.write_text(text.replace(marker,marker+note,1),encoding='utf-8')
active_file=S/'ROOT_ACTIVE.json';active=load(active_file);active['officialBuild9']='FAILED24676_UNRELATED_STABLE_HANDLER247198_NO_TT_NO_CANONICAL_NO_PUBLICATION_V2PREPARING';active['sqlProfile']='CONNECTED_PROCESSLOCAL_ODBCINI_ONLY_17LITERAL_PROOFS_NO_DML_GATES_PARTIAL';active['reconciliation']='13ORIGINS_EVIDENCE_ONLY_STATES_COUNTS_TARGETS_PRESERVED';active_file.write_text(json.dumps(active,indent=2)+'\n')
receipt.write_text(json.dumps(dict(success=True,changes=changes,proofs={str(p.relative_to(S)):sha(p) for p in [S/'sql-fixed-odbcini-process-v1.json',S/'sql-fixed-literal-parity-v1.json',S/'sql-fixed-aggregate-parity-v1.json',failure]},businessWrites=False,globalConfigChanged=False),indent=2)+'\n')
print('PASS memory updated: SQL process-local proof,17literal cases, failed unpublished9 and fresh-v2 continuation')
