"""Keep credential-free sources of published auxiliary screens in canonical builder."""
from pathlib import Path
import hashlib,json,shutil
r=Path(__file__).resolve().parents[2];b=r/'.runtime/ciw-completion-20261028/official-build5-v6';p=r/'integration-src/ciw-completion-20261028/container-version-history/frozen-aux-v1.1/metadata';dest=Path('D:/opencode/construtor-pg/integrations/ciw-completion-20261028-wave2-aux')
assert json.loads((b/'metadata-publication.json').read_text())['success'] and not dest.exists()
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
sources=list(p.glob('*-builder-draft.json'))+[p/'api-source-additions.json',b/'op1005-parent-draft.json'];assert len(sources)==6
def check(v):
 if isinstance(v,dict):
  for k,x in v.items():
   if k=='authHeaders':assert not x
   check(x)
 elif isinstance(v,list):
  for x in v:check(x)
for source in sources:check(json.loads(source.read_text(encoding='utf-8-sig')))
dest.mkdir(parents=True);receipts=[]
for source in sources:
 target=dest/source.name;shutil.copyfile(source,target);assert sha(source)==sha(target);receipts.append(dict(source=str(source),target=str(target),sha256=sha(target)))
(dest/'README.md').write_text('''# Consultas históricas CIW — onda2

Fontes dos metadados publicados em 28/10/2026 pelo Builder oficial: op1036 pagamentos, op1037 NFs, op1038 descontos e op1039 despesas da versão, todos1.0.0. Pai op1005/ciw.container-versoes-custo1.0.2, cinco links. Fonte compartilhada132operações, preservadas124anteriores. Não reaplicar estes JSONs por importação cega.

Consultas somente leitura de snapshot persistido, com container_id e versao_id obrigatórios. Integração usa os coletores centrais, não recalcula valores históricos. Compilação oficial OpenEdge12.2/.42, publicação137 e validação sursum-api/MED9911. Detalhes positivos em pagamentos/NFs/despesas; descontos vazios nas duas versões reais verificadas, detalhe coberto em TT.

Nomes atuais de itens/fornecedores/despesas e comparações BRL/USD continuam em incrementos separados. As quatro novas permissões humanas de leitura aguardam autorização; as três leituras da onda1 já estão autorizadas e aplicadas. Manutenção em lote1042: API publicada e leitura/negativas validadas, mas tela/fonte específica ainda não publicadas, teste de escrita depende de novo cenário autorizado e limpeza comprovada.

Recibos privados e memória de retomada no workspace D:/opencode/conversao-sc; nenhum cabeçalho secreto é armazenado nestes exemplos. A produção usa metadados assinados por screenId/endpointId e nunca carrega mocks ou JSON de exemplo.
''',encoding='utf-8')
(b/'canonical-metadata-manifest.json').write_text(json.dumps(dict(success=True,files=receipts,alreadyPublished=True,noSecrets=True,noBusinessWrites=True),indent=2)+'\n')
print('PASS6credential-free published metadata sources archived in canonical builder; no re-publication')
