"""Record verified metadata-only execution and current source coverage."""
from pathlib import Path
import json, hashlib

ROOT = Path(__file__).resolve().parents[2]
BASE = ROOT / '.runtime/ciw-completion-20261028'
PROBE = BASE / 'daily-currency-login-sync/dictionary-probe-v1.2'
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
proof = load(PROBE / 'currency-dictionary-private.json')
assert proof['completed'] and not proof['partial'] and proof['openEdge'] == '12.2'
assert proof['numDbs'] == 2 and not proof['businessReads'] and not proof['businessWrites']
assert proof['dictionaryReads'] <= 50000
assert 'PASS COMPILE' in (PROBE / 'compile.log').read_text()
assert [t['table'] for t in proof['tables']] == ['cotacao', 'cotac_parid']
assert next(f for f in proof['tables'][0]['fields'] if f['name']=='cotacao')['extent'] == 31
receipt = BASE / 'memory-post8-dictionary-v12.json'
assert not receipt.exists()
targets = [ROOT/'context/PROJECT_CONTEXT.md', ROOT/'context/RETOMADA_2026-10-16.md',
           Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),
           Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
changes=[]
for n,p in enumerate(targets):
    raw=p.read_bytes(); text=raw.decode('utf-8-sig')
    start=text.index('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->')
    end=text.index('<!-- END CIW_COMPLETION_GOAL_20261028 -->',start)
    block=text[start:end]
    assert '176fontessubstantivos' in block
    updated=block.replace('176fontessubstantivos','189fontessubstantivos/1wrapperincompleto/10semPHP')
    updated+='\nDict1054 v1.2 OFICIAL12.2/.42 CONCLUÍDO sessão27885:2DB/65leiturasdicionário/23ms/semnegócio. cotacao EXTENT31/DEC10;cotac_parid PK4/triggerspreservados. Campos reservados fields/triggers corrigidos só no probe. Não repetir49389/71472/27885. Adapter1054 ainda candidato, semhooklogin/escritaERP.\n\n'
    new=(text[:start]+updated+text[end:]).encode('utf-8')
    backup=BASE/'memory-post8-dictionary-v12-backups'/str(n)
    backup.parent.mkdir(parents=True,exist_ok=True);assert not backup.exists();backup.write_bytes(raw)
    assert p.read_bytes()==raw
    p.write_bytes(new)
    changes.append(dict(path=str(p),beforeSha256=hashlib.sha256(raw).hexdigest(),afterSha256=sha(p),backup=str(backup)))
detail=ROOT/'context/CIW_COMPLETION_GOAL_2026-10-28.md'
raw=detail.read_bytes();txt=raw.decode('utf-8')
marker='## Build8 publicado e validado — seleção de despesas e duas consultas'
note='\n\n**Checkpoint prevalente pós8/dictv1.2:** OpenEdge12.2/.42 compilação e leitura do dicionário CONCLUÍDAS sessão27885/exit0, completedtrue/partialfalse/NUMDBS2/65leituras/23ms, SEM leitura ou escrita de negócio. Prova daily-currency-login-sync/dictionary-probe-v1.2/{compile.log,currency-dictionary-private.json}. Diagnóstico71472 CONCLUÍDO: fields reservado; diagnóstico local confirmou triggers reservado; v1.2 renomeou só variáveis preservando JSON keys e guardas. Não repetir49389/71472/27885. comum.cotacao cotacaoDEC10 EXTENT31 e usuarioCHAR12 EXTENT31, PK mo-codigo+ano-periodo; ems5.cotac_parid DEC10/PK4 e triggers declarados preservados. Executor1054 pode preparar adapter/TT, sem hooklogin ou escritareal. Coleta13e já CONCLUÍDA; cobertura189substantivos/1wrapperincompleto/10semPHP,262/62/200 preservados. Reconciliação8 aplicada somente evidence/remaining de3origens, recibo build8-reconciliation-applied.json, sem promover estados.\n'
assert marker in txt;detail.write_bytes(txt.replace(marker,marker+note,1).encode('utf-8'))
active_file=BASE/'ROOT_ACTIVE.json';active=load(active_file)
active['dailyCurrencyDictionary']='COMPLETED122_V12_27885_65DICTREADS23MS_NUMDBS2_NO_BUSINESS'
active['reconciliation']='8ORIGINS_EVIDENCE_ONLY_STATES_COUNTS_TARGETS_PRESERVED'
active_file.write_text(json.dumps(active,indent=2)+'\n')
receipt.write_text(json.dumps(dict(success=True,changes=changes,dictionaryProofSha256=sha(PROBE/'currency-dictionary-private.json'),compileSha256=sha(PROBE/'compile.log'),session=27885,businessReads=False,businessWrites=False),indent=2)+'\n')
print('PASS four memory entrypoints, detail and active state updated; no executable canonical changed')
