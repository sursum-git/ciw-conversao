"""Record completed build13 publication/read evidence; preserve all prior context bytes."""
from pathlib import Path
import hashlib,json,sys

assert sys.argv[1:]==['--record-verified-read-state']
root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-completion-20261028'
read=lambda p:json.loads(p.read_bytes())
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
publication_path=state/'build13-metadata-publication-preparation/metadata-publication.json'
native_path=state/'build13-native-metadata-verification/runtime-read-proof.json'
pasoe_path=state/'runtime-build13-v4/pasoe-read-proof.json'
supp_path=state/'build13-two-row-pagination/proof.json'
publication,native,pasoe,supp=map(read,[publication_path,native_path,pasoe_path,supp_path])
assert publication['success'] and publication['cadastrosOperations']==150 and publication['old146Preserved'] and publication['actualAuthenticationPreserved']
assert publication['businessWrites'] is False and publication['humanPermissionsChanged'] is False
assert [(x['program'],x['version'],x['versionId']) for x in publication['published']]==[('op1040','1.0.0',126),('op1041','1.0.0',127),('op1005','1.0.3',128)]
assert pasoe['success'] and pasoe['checks']==87 and [x['total'] for x in pasoe['results']]==[1,1]
assert supp['success'] and supp['state']=='PROVED' and supp['nonemptySecondPage'] and supp['calls']==8 and len(supp['results'])==2
assert native['success'] and native['readOnly'] and native['metadataPublicationSha256']==sha(publication_path) and len(native['results'])==2
assert all(x['readGet'] and x['nonemptySecondPage'] and x['fields']==19 and x['decimalFilterObservedValue'] for x in native['results'])
assert native['calls']==dict(functional=17,catalogGets=4,definitionGets=3,nativePosts=10,authenticationRequests=2,totalHttp=19)
assert native['businessWrites'] is False and native['catalogWrites'] is False and native['grants'] is False
assert native['uiVisualValidated'] is False and native['ldapValidated'] is False
assert sha(Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php'))=='205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7'
marker='<!-- BEGIN CIW13_READ_FINAL -->'
note=f'''{marker}
## Checkpoint17 — comparações históricas BRL/USD publicadas e validadas no runtime

O lote13 está publicado na API e no construtor. Metadados: op1040/ciw.container-custos-comparacao-real1.0.0 versão126, op1041/ciw.container-custos-comparacao-dolar1.0.0 versão127 e paiop1005/ciw.container-versoes-custo1.0.3 versão128. Fonte motor_progress_ciw_cadastros146→150, preservando exatamente as146operações e autenticação real em RAM. Definição inteira do pai comparada: somente versão e dois links novos, mantendo cinco anteriores;24correções fechadas de labels nos novos drafts. Três fases de autoria concluídas/liberadas, sem concessão funcional humana ou escrita de negócio. Publicação87385 exit0; recibo build13-metadata-publication-preparation/metadata-publication.json SHA{sha(publication_path)}. NÃO repetir publicador/grants/compilação/integração/runtimepublish.

PASOE13 real concluído:87chamadas para consulta/detalhe/filtros/ordem/contexto/autenticação e regressões; prova runtime-build13-v4/pasoe-read-proof.json. Seus dois conjuntos originais tinham total1. Complemento build13-pagination-complement/proof.json ficou INCONCLUSIVE com take2/critério3, preservado como tal. Sem novo scan, a versão333426/2347 já observada com dois itens foi validada em8chamadas separadas, ambas moedas, take1: páginas1/2 não vazias, distintas/ordenadas, detalhe da segunda igual e página após fim vazia. Prova build13-two-row-pagination/proof.json SHA{sha(supp_path)}. Não alegar conjunto maior que200 nesta comparação.

Runtime nativo real validou as duas telas e o pai em17chamadas funcionais mais2de autenticação: bindings normalizados,19campos, consulta/detalhe/chave opaca, filtro decimal com valor observado, contexto obrigatório e segunda página não vazia nas duas moedas. Recibo build13-native-metadata-verification/runtime-read-proof.json SHA{sha(native_path)}. O envelope PHP nativo é exatamente data/total; o validator faz adapter fechado para reaproveitar as regras de linhas/páginas PASOE, cujo envelope inclui success. GET é discriminado por record_key. Sem alegar validação visual/DOM ou login LDAP dessas telas. Os acessos humanos novos1040/41,1053 e1055 continuam pendentes para a etapa final.

Compilação oficial13-v3 mantém69fontes/88logs/8.020checks OE12.2/.42 semDB nos testes;12fontes canônicas e17artefatos runtime13-v4 já publicados em sursum-api/MED9911, MEDrestaurado/IMAinalterado. Evidências anteriores são preservadas, não reexecutadas/reclassificadas. Projeção persistida única compartilhada BRL/USD; não gera custos/versões nem aceita política privada pelo HTTP. Exportação/impressão legadas permanecem GAP separado em comparison-export-print-parity/LIMITS.json; não promover as duas origens como paridade integral só pela fatiaRO.

Próximo: compor filterOnly congelado sobre PHP canônico13 atual e fixtures13, testar uma vez e integrar por patches exatos antes de freshWHOLEpreviews/navegação real. Builder205 AINDA preservado; filterOnly e integerRange1056 ainda candidatos isolados, não integrados.1042concluído/limpo sem replay,1053/1055publicados. Anexoscontainers:146referências sem arquivo físico; aguarda caminho/backup, sem probes repetidos. Lista atual: integration-src/ciw-completion-20261028/remaining-applications/PENDENCIAS_ATUAIS.md. Objetivo global ATIVO, Controles FINAL; sem credenciais, commit ou push.
<!-- END CIW13_READ_FINAL -->

'''
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),root/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
prepared=[]
for path in paths:
    before=path.read_bytes()
    assert marker.encode() not in before and b'<!-- BEGIN CIW13_RUNTIME_PUBLISHED -->' in before
    prepared.append((path,before))
out=state/'memory-build13-read-final'
assert not out.exists()
out.mkdir()
files=[]
for index,(path,before) in enumerate(prepared):
    (out/f'{index}-{path.name}.before').write_bytes(before)
    path.write_bytes(note.encode('utf8')+before)
    assert path.read_bytes().endswith(before)
    files.append(dict(path=str(path),before=hashlib.sha256(before).hexdigest(),after=sha(path)))
active_path=state/'ROOT_ACTIVE.json'
before=active_path.read_bytes()
(out/'ROOT_ACTIVE.before.json').write_bytes(before)
active=json.loads(before)
active.update(runtime13='V4PUBLISHED17_MED_RESTORED_IMA_UNCHANGED_PASOE87_AND_SUPPLEMENT8_PROVED',metadata13='PUBLISHED1040V100_126_1041V100_127_PARENT1005V103_128_CADASTROS150_OLD146_AUTH_PRESERVED',native13='REAL_READ_GET_CONTEXT_PAGING_BOTH_CURRENCIES_PARENT_OLD5_LINKS_PRESERVED_NO_UI_LDAP_CLAIM',next='FILTERONLY_COMPOSE_CURRENT13_THEN_EXACT_CANONICAL_PATCHES_FRESH_WHOLE_PREVIEWS_AND_NATIVE;INTEGER_RANGE1056_SEPARATE;HUMAN_GRANTS_FINAL;CONTROLES_FINAL')
active_path.write_bytes((json.dumps(active,ensure_ascii=False,indent=2)+'\n').encode())
proof=dict(success=True,goal='ACTIVE',files=files,proofs=[dict(path=str(p),sha256=sha(p)) for p in [publication_path,native_path,pasoe_path,supp_path]],metadataPublished=True,nativeReadValidated=True,businessWrites=False,humanPermissionsChanged=False)
(out/'proof.json').write_bytes((json.dumps(proof,ensure_ascii=False,indent=2)+'\n').encode())
print('PASS checkpoint17: metadata2+parent, PASOE87+8, native read validated; prior context bytes preserved; global ACTIVE')
