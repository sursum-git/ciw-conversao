"""Record actual official13/canonical12/runtime17; metadata and PASOE remain separate."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];r=root/'.runtime/ciw-completion-20261028'
load=lambda p:json.loads(p.read_bytes())
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(r/'build13-root-companions-v3/official-compile-verification.json')
canonical=load(r/'build13-root-companions-v3/canonical-manifest.json')
active=load(r/'runtime-build13-v4/active-manifest.json')
attempt=load(r/'runtime-build13-v4/publication-attempt.json')
assert proof['success'] and (proof['compileCount'],proof['testLogs'],proof['totalChecks'],proof['downloadCount'])==(69,88,8020,269)
assert proof['numDbsCompile']==1 and proof['numDbsTests']==0
assert canonical['success'] and len(canonical['files'])==12
for row in canonical['files']:assert sha(Path(row['target']))==row['sha256']
assert active['success'] and len(active['targets'])==17 and active['medWebRestored'] and active['imaWebUnchanged']
assert not active['businessWrites'] and not active['routesChanged'] and attempt['success'] and attempt['failure'] is None
assert all(attempt['finalHashes'][name]==row['sha256'] for name,row in active['targets'].items())
assert len(attempt['written'])==17 and active['pauseDurationSeconds']==12.387
assert load(r/'batch1042-exercise/state.json')['completed'] and load(r/'batch1042-exercise/completion-proof.json')['cleanupVerified']
note='''<!-- BEGIN CIW13_RUNTIME_PUBLISHED -->
## Checkpoint16 — comparação de custos compilada e API publicada; telas ainda pendentes

Oficial13-v3 CONCLUÍDO, sessão5330 exit0/269downloads:69compilações OpenEdge12.2/.42 com1banco somente para esquema;22suítes/88logs/8.020checks em quatro combinações, testes com0bancos. Prova completa em .runtime/ciw-completion-20261028/build13-root-companions-v3/official-compile-verification.json. Não repetir compilação/verificadores de aplicação. Provas locais1005PHP/7903asserções/278Appstage e112checks adicionais de precisão12.8 são evidências separadas, sem reclassificá-las como oficiais. Releases13-v3: managerae932cc8..., child7694b837....

Integração canônica12arquivos concluída por hashes/hunks, backups e journal em build13-root-companions-v3/canonical-manifest.json. Novos baselines prevalecem sobre os anteriores da12: Reader8ecee3d8..., Dispatcher325746bf..., Labels bce8fc89..., VersionService ee3ae5fe..., Query ec83a005..., Action d5413e30..., mais quatroABL/include/helperPHP novos. Builder205 permanece canônico e não foi alterado. Não repetir apply; os arquivos e manifestos são a referência exata.

Runtime13-v4 PUBLICADO, sessão63878 exit0/doisrecibos:17artefatos no share137 e sursum-api/MED9911; include/dependências primeiro, dispatcher por último. PausaMED12,387s, WEBMED restaurado, IMA inalterado e sessões ociosas recarregadas. Sem transação/dado de negócio, rota, configuração ou grant humano alterado. Provas reais em runtime-build13-v4/active-manifest.json e publication-attempt.json. API nova ainda aguarda teste PASOE positivo/negativo; não afirmar que read/get passaram só porque a publicação passou.

Os dois programas1040/41 de comparação BRL/USD e seus links ainda NÃO têm metadados publicados. Fontecadastros permanece146, proposta150. Export fresco em build13-metadata-fresh (proof8cd74686...): paiop1005/ciw.container-versoes-custo1.0.2, versão107; entidadecontainer_versoes_custo_progress; owner real confirmado por findStandardProgramVersionByEntity. Gerente prepara companion dos drafts com correções fechadas de labelsmojibake e WHOLEpreview205 de todos os deltas, sem reescrever freeze ou ignorar campos. Nenhum acesso novo1040/41 concedido.

Reuso: uma projeção de operandos persistidos serve BRL/USD; não gera versões/custos. Coleta/snapshot central permanece único. Política privada permite apenas consultar versão específica sem mestre para reproduzir o SQL; defaults/callers antigos e writers preservam exigência de pai. A flag não é aceita no payloadHTTP. Orçamento50mil/prazo10s mantidos. Suplemento textual comprova domínio físicoUSD9/BRL6casas úteis, não operandos fictícios de13casas.

Falhas preservadas, sem replay:8794 falhou no mkdir antes de upload/comando/AVM;68212 entrou em12.2/esquema, mas parou na guardaSEARCH antes da primeira compilação de produto por cópias idênticas na raiz. Recovery49300 foi download-only.13-v3 removeu só duas duplicatas e reparou pastas/paths do harness, com produtos iguais. Publicação98400 foi cancelada durante getpass, ANTES de SSH.connect, sem upload: repr(set()) mudava apenas a ordem textual do conjunto17. Runtimev4 usa geração determinística, revisada em dois processos/hashseeds e SHAexato a301c645.... Não executar publicador/inspectorv3 nem o probeSEARCH preparado e não executado.

Próximos passos: teste PASOE13 somente read/get e regressões; depois metadados1040/41, WHOLEpreview/governança e validação nativa. Manter Builder205 até essa fase terminar. filterOnly e integerRange1056 são candidatos isolados, não integrados; etapas próprias posteriores, sem alterar Grid/Form para acomodar necessidade inventada de helper.1042 segue integralmente limpo,1053publicado/nativo26; não repetir testes/grants dessas entregas. Objetivo globalATIVO, ControlesFINAL; nenhuma credencial na memória e nenhum commit/push.
<!-- END CIW13_RUNTIME_PUBLISHED -->

'''
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),root/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
prepared=[]
for p in paths:
    before=p.read_bytes();text=before.decode('utf-8-sig');assert '<!-- BEGIN CIW13_RUNTIME_PUBLISHED -->' not in text
    assert '<!-- BEGIN CIW1042_COMPLETED -->' in text and '<!-- BEGIN CIW1042_LIVE_FIXTURE -->' not in text
    prepared.append((p,before))
backup=r/'memory-build13-runtime-backup';backup.mkdir();files=[]
for i,(p,before) in enumerate(prepared):
    shutil.copy2(p,backup/(str(i)+'-'+p.name));p.write_bytes(note.encode('utf8')+before);assert p.read_bytes().endswith(before)
    files.append(dict(path=str(p),before=hashlib.sha256(before).hexdigest(),after=sha(p)))
proofs=[r/'build13-root-companions-v3/official-compile-verification.json',r/'build13-root-companions-v3/canonical-manifest.json',r/'runtime-build13-v4/active-manifest.json',r/'runtime-build13-v4/publication-attempt.json']
(r/'memory-build13-runtime.json').write_bytes((json.dumps(dict(success=True,goal='ACTIVE',files=files,proofs=[dict(path=str(p),sha256=sha(p)) for p in proofs],pasoeReadValidated=False,metadataPublished=False),indent=2)+'\n').encode())
print('PASS checkpoint16: official69/8020,canonical12,runtime17 confirmed; PASOE/metadata pending; global ACTIVE')
