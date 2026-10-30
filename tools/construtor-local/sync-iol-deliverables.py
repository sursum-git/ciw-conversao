"""Sincroniza apenas entregaveis novos IOL; contextos existentes recebem secao anexada."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];src=root/'integration-src/iol-pagina-inicial-gerencial'
motor=Path('D:/opencode/motor-progress/v2');builder=Path('D:/opencode/construtor-pg')
state=root/'.runtime/iol-gerencial';manifest=[]
def newfile(source,dest):
 data=source.read_bytes()
 if dest.exists() and dest.read_bytes()!=data:raise SystemExit('Arquivo existente divergente: '+str(dest))
 dest.parent.mkdir(parents=True,exist_ok=True);dest.write_bytes(data)
 manifest.append({'path':str(dest),'sha256':hashlib.sha256(data).hexdigest()})
for name in ['IolInicialGerencial.p','IolGerencialIdentityService.p','IolGerencialCollector.p','IolGerencialCalculator.p','IolReadBuffers.i']:
 newfile(src/name,motor/'sursum-api/programs'/name)
for name in ['IolGerencialCalculatorTest.p','IolGerencialIdentityTest.p','IolInicialGerencialBoundaryTest.p','CompileIolGerencialTests.p','calculator-cases.json']:
 newfile(src/name,motor/'tests/abl/iol'/name)
for source in (src/'metadata').glob('*.json'):newfile(source,builder/'integrations/iol-inicial-gerencial/metadata'/source.name)
newfile(src/'contract.json',builder/'integrations/iol-inicial-gerencial/contract.json')
for p in [builder/'docs/continuidade-codex.md',motor/'context/PROJECT_CONTEXT.md']:
 old=p.read_bytes();text=old.decode('utf-8-sig');marker='## IOL inicial gerencial publicado em16/10/2026'
 if marker in text:continue
 addition='\n\n'+marker+'\n\nTela op1012/iol.inicial-gerencial1.0.0 no construtor local8765, login restrito tasilpar (mesmo IMA). Credencial temporaria somente em D:/opencode/conversao-sc/.runtime/iol-gerencial/acesso-local-tadeu.json; nao copiar valores. Fonte API motor_progress_iol_gerencial, resumo/vendedores live sem cache/materializacao. AnalyticsEngine existente com cartoes declarativos e10destinos legados. Sem frontend paralelo/Kendo/vendor.\n\nABL compilado OpenEdge12.2 no .42,14checks identidade/coleta +20calculador por cultura, boundary401; publicado sursum-api/med por lote versionado iol-gerencial-20261016-v3, compartilhamento137 via .111. Rota POST /SursumPrograms/iol-inicial-gerencial.20buffers NO-LOCK com restricoes por usuario, hierarquia vazia falha fechada; parametro calend_global direto pela include central sem cache. Loja agregada conserva regra legada; vendedor comum recebe somente indicador individual proprio.\n\nAceite real PHP/PASOE: resumo1linha,6vendedores para tasilpar, negacoes401/403/405/422; UI desktop/mobile390 sem overflow/erro JS e metas alternaveis. PHP459/2498, DI lint e integridade sem invalidos. Diffs anteriores preservados, sem commits/push/schema/reseed. Relatorio detalhado e limitacoes: D:/opencode/conversao-sc/docs/integracao-iol-inicial-gerencial-validacao.md; manifesto ativo .runtime/iol-gerencial/publish/active-manifest-v3.json nesse workspace. Nao refazer cadastros nem usar compilados antigos.\n'
 if p.read_bytes()!=old:raise SystemExit('Contexto mudou concorrentemente')
 p.write_bytes(old+addition.encode('utf-8'))
(state/'deliverables-sync-manifest.json').write_text(json.dumps(manifest,indent=2),encoding='utf-8')
print('Entregaveis IOL sincronizados: '+str(len(manifest))+' arquivos novos; contextos anexados sem substituir historico.')
