"""Record canonical decimal-filter correction and its actual-canonical tests."""
from pathlib import Path
import hashlib,json,shutil,xml.etree.ElementTree as ET
root=Path(__file__).resolve().parents[2]
state=root/'.runtime/ciw-completion-20261028'
out=state/'builder-decimal-filters-v2/canonical-integration'
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
canonical=Path('D:/opencode/construtor-pg/backend/src/Builder/ProgramBuilderService.php')
assert sha(canonical)=='205ebd14329f8e8896d07c07716939db8a12d58345fecf76cab5252f4e0694a7'
proof=load(out/'native-verification.json')
assert proof['success'] and proof['checks']==16 and proof['canonicalChanged']
for name,tests,assertions in [('green.xml',2,26),('regression.xml',24,48)]:
    xml=ET.parse(out/name).getroot();suite=xml.find('testsuite')
    assert len(list(xml.iter('testcase')))==tests and suite.get('assertions')==str(assertions)
    assert not list(xml.iter('failure')) and not list(xml.iter('error'))
old='Builder decimal-v2 candidato205e continua revisado, NÃO integrado, canônico72c6 preservado enquanto houver pins1042.'
new='Builder decimal-v2 integrado pontualmente: canônico205ebd14..., backup72c6 e bytepatch reversível em builder-decimal-filters-v2/canonical-integration. Testes contra o canônico real passaram2/26+24/48 e16checks nativos; normalização numérica do dataModel e tipos não decimais preservados. Nenhuma tela existente foi regenerada e nenhuma biblioteca Kendo/renderer foi alterada. O pin Builder72 deve ser retirado somente do harness1042 que não executa autoria; manifests históricos de publicadores permanecem imutáveis. Próximos previews1053 devem validar filtros numéricos e comparar o pai inteiro.'
paths=[root/'context/PROJECT_CONTEXT.md',root/'context/RETOMADA_2026-10-16.md',Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'),Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),root/'context/CIW_COMPLETION_GOAL_2026-10-28.md']
backup=out/'context-backup';backup.mkdir();files=[]
for i,p in enumerate(paths):
    text=p.read_text(encoding='utf-8-sig');assert text.count(old)==1
    shutil.copy2(p,backup/(str(i)+'-'+p.name));before=sha(p)
    p.write_text(text.replace(old,new,1),encoding='utf-8')
    files.append(dict(path=str(p),before=before,after=sha(p)))
work=load(state/'ROOT_ACTIVE.json');work['decimalFilters']='V2_CANONICAL205E_ONEPATCH_BACKUP72C6_TESTS2_26_REG24_48_NATIVE16_NO_METADATA_REGEN'
(state/'ROOT_ACTIVE.json').write_text(json.dumps(work,indent=2)+'\n')
(out/'integration-verification.json').write_text(json.dumps(dict(success=True,canonicalSha256=sha(canonical),newTests=2,newAssertions=26,regressionTests=24,regressionAssertions=48,nativeChecks=16,metadataRegenerated=False,kendoChanged=False,rendererChanged=False,files=files),indent=2)+'\n')
print('PASS actual-canonical decimal fix verification/memory; metadata unchanged')
