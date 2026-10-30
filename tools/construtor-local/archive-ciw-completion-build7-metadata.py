"""Archive applied readonly metadata with native detail types and no authentication material."""
from pathlib import Path
import hashlib,json,shutil
root=Path(__file__).resolve().parents[2];build=root/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
assert load(build/'metadata-publication.json')['success']and load(build/'runtime-read-proof.json')['success']and load(build/'pasoe-native-ledger-positive-proof.json')['positiveGetProved']
destination=Path('D:/opencode/construtor-pg/integrations/ciw-completion-20261028-wave3-readonly');assert not destination.exists();destination.mkdir()
drafts=list((build/'metadata').glob('*-builder-draft.json'));assert len(drafts)==4
for path in drafts:shutil.copyfile(path,destination/path.name)
operations=load(build/'metadata-operation-type-correction.json')['operations'];assert len(operations)==8
assert all(x['type']==('detail'if x['bodyTemplate']['operation']=='get'else'list')for x in operations)
addition=dict(state='ALREADY_PUBLISHED_REFERENCE_DO_NOT_REIMPORT',sourceCode='motor_progress_ciw_cadastros',preserveExistingAuthentication=True,previousOperations=132,publishedOperations=140,operations=operations)
(destination/'api-source-additions-native.json').write_text(json.dumps(addition,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
readme='''# Consultas CIW — descontos e distribuição

Metadados já publicados no construtor em 28/10/2026. Esta pasta é uma referência para manutenção; não reimportar como novos programas ou substituir a fonte global por estes oito registros. A fonte `motor_progress_ciw_cadastros` possui 140 operações e preserva as 132 anteriores e sua autenticação.

| Programa | Tela | Escopo |
| --- | --- | --- |
| op1045 | ciw.descontos-importacao-geral | Consulta global de descontos, conforme a origem Scriptcase |
| op1046 | ciw.descontos-importacao-lancamentos | Movimentos do desconto selecionado; exige desconto_importacao_id |
| op1049 | ciw.custo-distribuicao-itens-aptos | Consulta global dos itens com a condição de situação da origem |
| op1050 | ciw.custo-distribuicao-lancamentos-item | Movimentos do item selecionado; exige item_container_id |

As quatro telas estão em 1.0.0 e permitem apenas consulta. O link de op1049 fornece o contexto de op1050. A manutenção usa os drafts JSON e os serviços existentes; não há frontend paralelo ou fórmulas de custos duplicadas. As permissões do usuário final exigem autorização própria e não são concedidas pela importação dos metadados.

No cadastro da API, a operação de detalhe usa `type: detail`; o corpo da chamada ao Progress continua com `operation: get`. O tipo `get` não é aceito como classificação do catálogo nativo. O arquivo de adições inclui somente oito operações sem credenciais; preservar o cadastro atual e a autenticação ao fazer futuras alterações.

Validação: OpenEdge 12.2 no compilador .42, 68 compilações e 4.120 verificações em tabelas temporárias sem banco; publicação de 25 artefatos no PASOE sursum-api/MED/9911. O helper PHP do extrato recebeu uma correção de comparação das propriedades da chave JSON, mantendo campos, tipos, dono e chave opaca; 917 testes PHP e 6.018 asserções passaram. Lista, detalhe, filtros e contexto foram confirmados nas quatro APIs e no runtime nativo usando somente leitura de registros existentes. Nenhum registro de negócio foi criado ou alterado para estas provas.

Recibos técnicos e dados privados de validação ficam no workspace de conversão em `.runtime/ciw-completion-20261028/official-build7`; não contêm exemplos a serem publicados no PASOE. Memória de retomada: `D:/opencode/conversao-sc/context/CIW_COMPLETION_GOAL_2026-10-28.md`.
'''
(destination/'README.md').write_text(readme,encoding='utf-8')
files=[dict(path=str(path),sha256=sha(path))for path in sorted(destination.iterdir())]
(build/'canonical-metadata-manifest.json').write_text(json.dumps(dict(success=True,referenceOnly=True,alreadyPublished=True,files=files,credentialsIncluded=False,businessWrites=False),indent=2)+'\n')
print('PASS6reference files archived in canonicalbuilder;4applied drafts/native8ops;no credentials or reimport')
