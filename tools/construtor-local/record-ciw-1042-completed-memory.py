"""Checkpoint only after all fixed steps and physical canonical cleanup succeed."""
from pathlib import Path
import hashlib
import json
import re
import shutil

root = Path(__file__).resolve().parents[2]
state_dir = root / '.runtime/ciw-completion-20261028'
run = state_dir / 'batch1042-exercise'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
steps = ['create-header', 'create-A', 'create-B', 'batch-update', 'concurrent-B', 'stale-batch', 'batch-delete', 'cleanup-header', 'verify-cleanup']
scenario = load(run / 'state.json')
assert scenario['steps'] == steps and scenario['completed'] and scenario['pending'] is None
assert all(row['deleted'] and row['createdByAudit'] for rows in scenario['owned'].values() for row in rows.values())
clean = load(run / 'inspections/verify-cleanup/fixture-cleaned.json')
assert clean['success'] and clean['phase'] == 'cleaned' and clean['container_id'] == 2147000110
assert len(clean['rows']) == 12 and all(row['count'] == 0 for row in clean['rows'])
assert clean['calcSnapshots'] == [] and clean['indirectLedgerJoinEmptyItems'] and not clean['ledgerGlobalScan']
for step in steps:
    assert load(run / ('attempt-' + step + '.json'))['status'] == 'verified'
for step in ['create-A', 'create-B', 'batch-update', 'concurrent-B', 'batch-delete']:
    audit = load(run / ('audit-' + step + '.json'))
    assert audit['success'] and audit['events'] and any(t['status'] == 'succeeded' and t['actor'] == 'admin' for t in audit['transactions'])
stale = load(run / 'raw-response-stale-batch.json')
assert stale['status'] == 409 and stale['response']['error']['code'] == 'CONTAINER_EXPENSE_CHANGED'
assert load(run / 'audit-stale-batch.json')['events'] == []
cancel = load(run / 'ui-cancel-proof.json')
assert cancel['success'] and cancel['businessWriteRequests'] == 0 and cancel['snapshots14Equal']
assert cancel['userCanceledNativeGrid'] and cancel['drainClosed'] and not cancel['truncated']
proof_paths = [run/'state.json', run/'ui-cancel-proof.json', run/'raw-response-stale-batch.json', run/'audit-stale-batch.json', run/'inspections/verify-cleanup/fixture-cleaned.json']
proof_paths += [run/('attempt-'+s+'.json') for s in steps]
proof = dict(success=True, completed=True, containerId=2147000110, cleanupVerified=True, twelveCountsZero=True,
             ownedCounts={k:len(v) for k,v in scenario['owned'].items()}, nativeActor='admin',
             humanUserImpersonated=False, businessScenarioOnlyNewRecords=True, logsPreserved=True,
             proofs=[dict(path=str(p),sha256=sha(p)) for p in proof_paths])
proof_file = run/'completion-proof.json'
with proof_file.open('x', encoding='utf-8') as f:
    json.dump(proof,f,ensure_ascii=False,indent=2); f.write('\n')
note = '''<!-- BEGIN CIW1042_COMPLETED -->
## Checkpoint14 — manutenção rápida1042 validada e teste removido

O cenário CIW-1042-VALIDACAO-20261028-2147000110 foi CONCLUÍDO nos nove passos fixos, sem repetição de requisições. Inclusão dos dois registros próprios, alteração em lote, concorrência, recusa409 CONTAINER_EXPENSE_CHANGED sem efeitos confirmados e exclusão em lote passaram. Auditorias nativas confirmaram o usuário da sessão administrativa real admin e imagens anteriores/atuais; não foi simulada uma sessão LDAP de tadeu.parreiras. Cabeçalho foi preparado/removido pela API Progress canônica com auditoria Progress, sem alegar transação PostgreSQL para esse caller direto.

Cancelamento REAL no grid de produção também comprovado: comparação dos14campos de7linhas antes/depois, valores restaurados e zero requisições de escrita no intervalo CDP completamente drenado. O teste ficou limitado ao container novo2147000110 e filhos próprios identificados por auditoria completa. Limpeza canônica concluída, triggers mantidos:12contagens físicas zeradas, memórias vazias, junção indireta vazia por ausência de itens, cabeçalho e todas as despesas próprias retornam404. Logs preservados. NÃO executar novamente o cenário, suas inspeções ou concessões já consumidas. Não há fixture1042 vivo.

Provas privadas: .runtime/ciw-completion-20261028/batch1042-exercise/completion-proof.json, state.json completed=true/pending=null, nove attempt-* verified, auditorias/raw-responses e inspections/verify-cleanup. A prova não é de execução de outros processos fiscais nem de autorização de outros registros. As menções históricas abaixo a1042 ainda não executado ou limpeza pendente são superadas por este checkpoint. Fonte/tela1042 continuam publicadas e suas três permissões já foram aplicadas.

Objetivo global ATIVO. Próximo passo: publicar uma única vez o companion de metadados1053, releaseab37b22d..., sobre API12 já publicada/validada; depois validar runtime nativo. Comparações1040/41 seguem preparação13; demais origens ainda exigem confronto individual. Controles FINAL. Nenhum commit/push ou credencial em memória.
<!-- END CIW1042_COMPLETED -->

'''
paths = [root/'context/PROJECT_CONTEXT.md', root/'context/RETOMADA_2026-10-16.md',
         Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),
         root/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
backup = state_dir/'memory-1042-completed-backup'
backup.mkdir()
receipts = []
for i,p in enumerate(paths):
    before = p.read_bytes(); text = before.decode('utf-8-sig')
    assert text.count('<!-- BEGIN CIW1042_LIVE_FIXTURE -->') == 1
    assert '<!-- BEGIN CIW1042_COMPLETED -->' not in text
    shutil.copy2(p,backup/(str(i)+'-'+p.name))
    text = re.sub(r'<!-- BEGIN CIW1042_LIVE_FIXTURE -->.*?<!-- END CIW1042_LIVE_FIXTURE -->\s*','',text,count=1,flags=re.S)
    p.write_text(note+text,encoding='utf-8')
    receipts.append(dict(path=str(p),before=hashlib.sha256(before).hexdigest(),after=sha(p)))
work_file = state_dir/'ROOT_ACTIVE.json'
shutil.copy2(work_file,backup/work_file.name)
work = load(work_file)
work.update(batch1042='PUBLISHED_NATIVE_BATCH_UI_CANCEL_CONFLICT_DELETE_CLEANUP_VERIFIED',
            batchScenario='COMPLETED9_STEPS_EXACT2147000110_CANONICAL_CLEANED12ZERO_LOGS_PRESERVED_NO_REPLAY',
            batchFixtureInspector='V4OFFICIAL122_51573_FRESH9INSPECTIONS_COMPLETED_NO_REPLAY',
            next='METADATA1053_RELEASEAB37_EXECUTE_ONCE;COMPARISON13_PREPARE;GLOBALACTIVE', businessWrites=True)
work_file.write_text(json.dumps(work,indent=2)+'\n')
(state_dir/'memory-1042-completed.json').write_text(json.dumps(dict(success=True,goal='ACTIVE',cleanupVerified=True,proofSha256=sha(proof_file),files=receipts),indent=2)+'\n')
print('PASS checkpoint14: 9steps verified, canonical cleanup12zero, no live1042 fixture; global ACTIVE')
