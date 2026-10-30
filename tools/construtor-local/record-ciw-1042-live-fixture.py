"""Mark the live authorized test fixture prominently until canonical cleanup is proved."""
from pathlib import Path
import json,shutil,hashlib
root=Path(__file__).resolve().parents[2];state=root/'.runtime/ciw-completion-20261028'
scenario=json.loads((state/'batch1042-exercise/state.json').read_text())
assert scenario['steps']==['create-header'] and scenario['pending'] is None
assert len(scenario['owned']['containers'])==1 and '2147000110' in scenario['owned']['containers']
note='''<!-- BEGIN CIW1042_LIVE_FIXTURE -->
## Estado prevalente — teste1042 em execução, limpeza obrigatória

O cenário expressamente autorizado já CRIOU e confirmou em auditoria somente o novo container2147000110, marcador CIW-1042-VALIDACAO-20261028-2147000110. O checkpoint13 abaixo antecede essa criação. A execução continua em passos fixos; o estado atual e todos os IDs/imagens próprios ficam em `.runtime/ciw-completion-20261028/batch1042-exercise/state.json`, com receipts `attempt-*`/`raw-response-*`/`audit-*`. Consultar esse estado antes de agir. Nunca repetir passo iniciado, adotar registro por GET ou limpar sem comparar a auditoria completa. Container e filhos próprios devem ser removidos pelas rotinas canônicas ao terminar, preservando logs e triggers. Release de execução atual é a revisão2 d09d761e...; runtimeclosure-v4 real confirmou38arquivos/doisaliases. Nenhuma autorização cobre registros existentes ou outros IDs de container. NÃO considerar o cenário encerrado antes da prova física final.
<!-- END CIW1042_LIVE_FIXTURE -->

'''
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),root/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
backup=state/'memory-1042-live-backup';backup.mkdir();receipts=[]
for i,p in enumerate(paths):
    text=p.read_text(encoding='utf-8-sig');assert '<!-- BEGIN CIW1042_LIVE_FIXTURE -->' not in text
    shutil.copy2(p,backup/(str(i)+'-'+p.name));p.write_text(note+text,encoding='utf-8')
    receipts.append(dict(path=str(p),sha256=hashlib.sha256(p.read_bytes()).hexdigest()))
(state/'memory-1042-live.json').write_text(json.dumps(dict(success=True,cleanupRequired=True,files=receipts),indent=2)+'\n')
print('PASS live fixture notice in all contexts; cleanup mandatory until verified')
