"""Record confirmed metadata/access outcomes without replaying any publisher."""
from pathlib import Path
import hashlib
import json
import re
import shutil

root = Path(__file__).resolve().parents[2]
state = root / '.runtime/ciw-completion-20261028'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
assert load(state / 'build11-metadata-publication-preparation/metadata-publication.json')['success']
assert load(state / 'build11-metadata-publication-preparation/runtime-read-proof.json')['success']
assert load(state / 'batch1042-metadata/metadata-publication.json')['success']
assert load(state / 'batch1042-metadata/native-read-proof.json')['batchesExecuted'] == 0
assert load(state / 'batch1042-access/verified.json')['authorizationConsumed'] is True
assert load(state / 'batch1042-fixture-inspector-v3/official-compile-verification.json')['success']
inspection = load(state / 'batch1042-fixture-inspector-v3/fixture-empty.json')
assert inspection['success'] and len(inspection['rows']) == 12
assert all(row['count'] == 0 for row in inspection['rows'])
assert inspection['indirectLedgerJoinEmptyItems'] and not inspection['ledgerGlobalScan']
backup = state / 'memory-metadata11-batch1042-backup'
backup.mkdir()
note = '''## Checkpoint12 — metadados de despesas/impostos e manutenção em lote publicados

Estado confirmado: a API1055 do build11 foi compilada no OpenEdge12.2/.42 (7 compilações, 384 verificações TT), integrada e publicada em sursum-api/MED9911 (4 artefatos; sessão97061). Os 17 testes PASOE passaram. Agora os metadados também estão publicados: op1055, `ciw.despesas-impostos-geral`, versão1.0.0, fonte `motor_progress_ciw_cadastros` ampliada de144 para146 operações. O runtime nativo validou definição, consulta, detalhe, filtros e paginação. Escopo global; PK nullable de três campos preservada. Nenhuma permissão funcional1055 nova foi concedida e nenhuma validação visual LDAP foi alegada. NÃO repetir esses publicadores ou a integração do build11.

A Manutenção rápida de despesas do container também está publicada: op1042/`ciw.container-despesas-lote`1.0.0 e pai op1003/`ciw.container-despesas`1.0.5, alterado somente em versão e link. A nova fonte `motor_progress_container_despesas_lote` contém list/detail/batch; autenticação real clonada apenas em memória, fonte anterior preservada. Consulta e detalhe positivos, contexto obrigatório e14 campos originais validados pelo runtime nativo. As três permissões read/edit/delete de1042 para `tadeu.parreiras` foram aplicadas e verificadas, preservando outros acessos; gate consumido. As oito consultas AUX/descontos/distribuição autorizadas anteriormente também estão aplicadas e consumidas. NÃO repetir concessões.

O cenário de negócio1042 está AUTORIZADO, ainda NÃO executado: somente container novo2147000110, marcador CIW-1042-VALIDACAO-20261028-2147000110, despesas novas das definições4/5, até22 despesas e4 memórias. Validar edição/exclusão em lote, conflito de imagem desatualizada e logs com usuário/antes/depois; limpar apenas registros próprios confirmados em auditoria, por rotinas canônicas, mantendo logs/triggers. Nenhum item, título, pagamento, nota, estoque, custo, versão ou registro existente poderá ser alterado. Harness em preparação pelo gerente, com passos fixos, manifesto de propriedade e recibos sem repetição de writes incertos.

Inspector readonly1042 v3 compilado oficialmente12.2/.42, sessão79322, fonte5bd4eb7f... e rcode42906502.... Inspeção vazia84215 concluída:12 tabelas diretas zeradas e junção indireta do ledger vazia porque não há itens; não é prova de contagem global do ledger. `cta_corren_fornec_imp` não tem campo físico container_id; nunca inventar esse filtro. Planos novos com timestamps reais preparados em `batch1042-fixture-inspector-v3/{empty-before-create,owned-before-cleanup,cleaned-after-cleanup}`. Executar cada um somente na fase correspondente. Hash de artefato/resultado e receipt UTC devem comprovar frescor, nunca mtime local. IDs lidos não são automaticamente próprios; propriedade exige auditoria completa confirmada. Tentativas v1/v2 falhas foram preservadas; não repetir compilações/inspeções anteriores.

Paginação1053 de notas fiscais está no candidato oficial12, ainda sem compilação/publicação remota. Reutiliza coleta e leitor ERP compartilhados, remove teto antigo de200 candidatos, preserva teto200 por página e orçamento total10s/50mil leituras de origem. Fonte/Reader/PHP devem preservar alterações do build11. Metadados de NFs permanecem retidos até validação real nos cinco containers. Comparações1040/41 congeladas aguardam revisão/oficial.1056 Descontos por fornecedor congelado aguarda companion integerRange int32; contexto assinado deve preservar0/negativos do Scriptcase. Builder decimal-v2 candidato205e revisado verde, ainda NÃO integrado; canônico72c6 preservado até resolver pins do harness1042. Nenhuma tela será regenerada automaticamente.

1054 cotação diária permanece retida: diagnóstico SEARCH encontrou4.r de triggers/0 fontes; não comprova fechamento de efeitos físicos. Anexos de containers `cons_anexos_container`/`form_anexos_container`:146 referências sem arquivo no acervo verificado, aguardando caminho/backup; não criar arquivos substitutos nem alegar download validado. Inventário completo: `integration-src/ciw-completion-20261028/remaining-applications/PENDENCIAS_ATUAIS.md` (262 origens,62 registradas Convertido,200 não encerradas; isso não significa200 telas sem implementação). Controles permanece como pendência FINAL. Objetivo global ATIVO; sem commit/push ou credenciais em memória.

'''
marker = '<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->\n\n' + note + '<!-- END CIW_COMPLETION_GOAL_20261028 -->'
paths = [root / 'context/PROJECT_CONTEXT.md', root / 'context/RETOMADA_2026-10-16.md', Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md')]
receipts = []
for i, p in enumerate(paths):
    before = p.read_bytes()
    text = before.decode('utf-8-sig')
    assert text.count('<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->') == 1
    shutil.copy2(p, backup / (str(i) + '-' + p.name))
    p.write_text(re.sub(r'<!-- BEGIN CIW_COMPLETION_GOAL_20261028 -->.*?<!-- END CIW_COMPLETION_GOAL_20261028 -->', lambda _: marker, text, count=1, flags=re.S), encoding='utf-8')
    receipts.append(dict(path=str(p), before=hashlib.sha256(before).hexdigest(), after=sha(p)))
p = root / 'context/CIW_COMPLETION_GOAL_2026-10-28.md'
text = p.read_text(encoding='utf-8-sig')
assert '## Checkpoint12 — metadados' not in text
shutil.copy2(p, backup / p.name)
first, rest = text.split('\n', 1)
p.write_text(first + '\n\n' + note + rest, encoding='utf-8')
work = load(state / 'ROOT_ACTIVE.json')
work.update(next='OFFICIAL12_REVIEW_COMPILE;1042_REVIEW_FIXED_SCENARIO;GLOBALACTIVE', metadata11='PUBLISHED_OP1055_V100_SOURCE146_NATIVE_READ_GET_FILTER_PAGING_GREEN_NO_HUMAN_GRANT', batch1042='METADATA_PUBLISHED_V100_PARENT1003V105_NATIVE_READ_GET_GREEN_BUSINESS_NOT_EXECUTED', batchFunctionalAccess='EXACT3_APPLIED_VERIFIED_CONSUMED', batchMetadata='PUBLISHED_5827_SOURCE3_PARENT_VERSION_AND_LINK_ONLY', batchFixtureInspector='V3OFFICIAL122_79322_EMPTY84215_12DIRECT_ZERO_EMPTYITEMLEDGERJOIN_FRESH3PLANS_PREPARED', decimalFilters='V2_205E_REVIEW_GREEN_NO_CANONICAL_KEEP72C6', officialBuild12='PREPARED_MANAGER_REVIEW_PENDING_NO_REMOTE_EXECUTION')
(state / 'ROOT_ACTIVE.json').write_text(json.dumps(work, indent=2) + '\n')
(state / 'memory-metadata11-batch1042.json').write_text(json.dumps(dict(success=True, goal='ACTIVE', files=receipts), indent=2) + '\n')
print('PASS metadata11/1042/access confirmed memory; scenario and official12 explicitly pending')
