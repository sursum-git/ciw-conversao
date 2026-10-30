"""Record published API and failed validation honestly, before any metadata release."""
from pathlib import Path
import json,hashlib
R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028';B=S/'official-build9-v2';D=S/'runtime-build9-v2'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
receipt=S/'memory-build9-runtime-held.json';assert not receipt.exists()
proof=load(B/'official-compile-verification.json');assert proof['success'] and proof['compileCount']==23 and proof['totalChecks']==1080
active=load(D/'active-manifest.json');assert active['success'] and active['medWebRestored'] and active['imaWebUnchanged']
assert not (B/'pasoe-read-proof.json').exists()
prepare=load(S/'sql-distribution-prepare-only-v2.json');assert prepare['prepareOnly'] and not prepare['statementExecuted'] and len(prepare['checks'])==6
note='''

**Estado prevalente mais recente: API9-v2 publicada, metadados RETIDOS por falha real de validação.** Oficial85523CONCLUÍDO/exit0:23compilações12.2/.42,8logsTT/1080checks/NUMDBS0,4JSONs iguais à fixture. Release534e616a... e manager2e793c...; não repetir compilação. Integração4arquivosCONCLUÍDA porhash/backups: doisleitores ABL, ActionPHP399cf18a... ehelperPHP6015b42b.... Runtime82418CONCLUÍDO:4artefatosService/Read p+r, pausaMED8,477s, sessões142/143/144 refreshsamepid3856625, MEDrestaurado/IMAestado preservado. Recibos runtime-build9-v2/{active-manifest,publication-attempt}.json; activecopiadoEXATO paraofficial-build9-v2. Não repetir publicação.

Validação PASOE encontrouP2: GET novo recurso nfs-disponiveis com alias nf_key acrescido de espaço foi aceito; comparaçãoABL ignora espaços finais. Lista333426(104linhas) eGETpositivoigual PASS. Containers332526/331126/200019/1525 retornaram503CONTAINER_NF_QUERY_LIMIT; ainda distinguir causa200candidatos versus50mil/tempo ANTES mudarcap. Gerente prioriza companion1053 restrito ao novo recurso e testesTT diretos; não alterar comportamento de recursos antigos. LC(id) já tem teste, não afirmarbuglowercase semRED. Não há pasoe-read-proof.json aprovado nem metadado/permfuncional9. Não executar publishermetadata9. Registro de tentativas pasoe9-attempts.json; linhasprivadas nf-available-333426-rows-private.json, não buscar novamente antesfix. Próxima validação deve aproveitar identidades jáobservadas.

Metadados9-v2: ownerrealcontainers_progress=op1000/versionId16/1.0.2; wholepreviewreadonly tem exatamente versão1.0.2→1.0.3 e rowLinks/1 novo. Rootaprovou parent-preview-proof.json semignorarcaminhos; nada salvo emcatálogo. Ferramentas do gerente aguardam releaseapósPASOEverde. SQLPREPARE6queriessemexecuteCONCLUÍDO63281: branch3containerTRUE,ERP/FORNECfalse(código57);branch4container/ERPtrue,FORNECfalse60. JSONv1vazio porUTF8diagnóstico não éprova; v2corrigido JSON_INVALID_UTF8_SUBSTITUTE, statementExecuted/fetchedfalse. Fixture8d6a... e sql-distribution-prepare-only-v2.json. ObjetivoglobalATIVO/ControlesFINAL;1055futura descoberta global e1054adapter ainda candidatos, semescritaERP/hooklogin.
'''
targets=[R/'context/PROJECT_CONTEXT.md',R/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
backup=S/'memory-build9-runtime-held-backups';assert not backup.exists();backup.mkdir();changes=[]
for n,p in enumerate(targets):
 raw=p.read_bytes();text=raw.decode('utf-8-sig');marker='<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->';assert marker in text
 saved=backup/str(n);saved.write_bytes(raw);assert p.read_bytes()==raw;p.write_bytes(text.replace(marker,marker+note,1).encode('utf-8'));changes.append(dict(path=str(p),before=hashlib.sha256(raw).hexdigest(),after=sha(p),backup=str(saved)))
detail=R/'context/CIW_COMPLETION_GOAL_2026-10-28.md';text=detail.read_text();marker='## Build8 publicado e validado — seleção de despesas e duas consultas';assert marker in text;detail.write_text(text.replace(marker,marker+note,1),encoding='utf-8')
f=S/'ROOT_ACTIVE.json';a=load(f);a['officialBuild9']='V2COMPLETED85523_23COMPILES1080TT_CANONICAL4_PUBLISHED82418_RUNTIME4_MED_RESTORED8_477S';a['metadata9']='HELD_CONFIRMED_P2_NF_ALIAS_TRAILINGSPACE_AND_4LIMITS_UNCLASSIFIED_NO_PASOE_SUCCESS_PROOF';a['sqlPrepare1048']='V2COMPLETED63281_PREPARE6_NO_EXECUTE_RESULTS_RECORDED';a['next']='FIX1053_ALIAS_AND_DIAGNOSE_LIMITS_BEFORE_METADATA;1054_1055_CANDIDATES;GLOBALACTIVE';f.write_text(json.dumps(a,indent=2)+'\n')
receipt.write_text(json.dumps(dict(success=True,changes=changes,officialProofSha256=sha(B/'official-compile-verification.json'),activeSha256=sha(D/'active-manifest.json'),businessWrites=False,metadataPublished=False,knownValidationFinding=True),indent=2)+'\n')
print('PASS memory: API9 published, validationP2, metadata held, no replay; SQLPREPARE6 recorded')
