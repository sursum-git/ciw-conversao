"""Root-only checkpoint15. Validates real receipts; never publishes or runs business."""
from pathlib import Path
import hashlib
import json
import shutil
import sys

ROOT = Path(__file__).resolve().parents[2]
STATE = ROOT / '.runtime/ciw-completion-20261028'
DOMAIN = STATE / 'build12-metadata-publication-preparation'
NATIVE = STATE / 'build12-native-metadata-verification-v2/runtime-read-proof.json'
load = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()


def main(preflight_only=False):
    publication = load(DOMAIN / 'metadata-publication.json')
    native = load(NATIVE)
    completion = load(STATE / 'batch1042-exercise/completion-proof.json')
    scenario = load(STATE / 'batch1042-exercise/state.json')
    assert publication['success'] and publication['financialOperations'] == 6
    assert publication['oldFourPreserved'] and publication['actualAuthenticationPreserved']
    actual = {p['program']: (p['version'], p['versionId']) for p in publication['published']}
    assert actual == {'op1053': ('1.0.0', 124), 'op1000': ('1.0.3', 125)}
    assert [d['path'] for d in publication['parentGeneratedDeltasExplicitlyReviewed']] == ['/program/version', '/crud/grid/rowLinks/1']
    assert publication['parentGeneratedWholeDefinitionReviewed']
    assert native['success'] and native['businessWrites'] is False
    assert all(native[field] is True for field in ['definitionValidated', 'read', 'get', 'paging', 'filter', 'context', 'sourceOldFourPreserved', 'sourceSixOperations'])
    assert native['decimalFilterMetadata'] == 7
    assert native['metadataPublicationSha256'] == sha(DOMAIN / 'metadata-publication.json')
    assert completion['success'] and completion['cleanupVerified'] and completion['twelveCountsZero']
    assert scenario['completed'] and scenario['pending'] is None and len(scenario['steps']) == 9
    assert all(row['deleted'] for rows in scenario['owned'].values() for row in rows.values())
    definition = load(DOMAIN / 'op1053-runtime.json')
    assert definition['program']['version'] == '1.0.0' and definition['dataModel']['primaryKey'] == 'nf_key'
    for field in ['tot_valor', 'despesa_nota', 'valor_embal', 'valor_frete', 'valor_mercad', 'valor_outras', 'valor_seguro']:
        filters = [f for f in definition['crud']['filter']['fields'] if f['field'] == field]
        assert len(filters) == 1 and filters[0]['type'] == 'decimal' and filters[0]['operator'] == 'eq'
    if preflight_only:
        print(json.dumps({'success': True, 'readOnlyPreflight': True, 'nativeChecks': native['checks'], 'nativeProofSha256': sha(NATIVE), 'publicationSha256': sha(DOMAIN / 'metadata-publication.json'), 'cleanupProofSha256': sha(STATE / 'batch1042-exercise/completion-proof.json'), 'filesChanged': False}))
        return
    note = '''<!-- BEGIN CIW1053_METADATA_PUBLISHED -->
## Checkpoint15 — consulta de notas disponíveis publicada

Publicação50945 concluída: op1053/`ciw.container-nfs-disponiveis-med`1.0.0, versão124; pai op1000/`ciw.containers`1.0.3, versão125. A fonte financeira passou de4 para6 operações, preservando integralmente as quatro anteriores e a autenticação real somente em memória. Definição inteira do pai comparada: apenas versão e um link contextual novos. Builder205 preservado; sete filtros monetários decimal/eq. Consulta de18campos, chave nf_key, read/get, contexto container obrigatório, paginação nativa; sem escrita ou exportação. Nenhuma permissão funcional humana1053 foi concedida e nenhuma validação visual LDAP dessa nova tela foi alegada.

Validação nativa real concluída após a publicação: definição, consulta, detalhe por nf_key, filtros, paginação e recusa de contexto inválido aprovados; recibo runtime-read-proof.json. Não confundir os testes locais de componente com tela visual publicada. A API12-v3 permanece oficialmente validada em12.2/.42:42compilações,5.704checks TT semDB e43checks PASOE nos cinco containers, incluindo conjuntos acima de200 sem truncamento. NÃO repetir compilação, integração, runtimepublish, publicador de metadados ou consultas já provadas.

Checkpoint14 continua prevalente para1042: nove passos autorizados concluídos, conflito409 específico sem efeitos, cancelamento real de grid com zero requisições de escrita e limpeza canônica comprovada por12contagens físicas zeradas, memórias vazias e404 dos registros próprios. Nenhum fixture1042 vivo; logs e triggers preservados. NÃO reexecutar o cenário, suas inspeções, grants ou metadados. Os textos históricos abaixo sobre1042 pendente e1053 não publicado são superados por estes checkpoints.

Próximas frentes: composição oficial13 das comparações1040/41 sobre canônicos12 com leitura privada de órfãos e ABI preservada; corrigir lacunas específicas de navegação/moeda/visibilidade de itens com frontend nativo e fontes atuais.1056 continua dependente de contexto int32 assinado;1054 conserva gates físicos de cotação/triggers. Anexos:146referências sem arquivo físico, aguardando caminho/backup, sem novos probes. Inventário262origens/62registradas Convertido/200não encerradas não significa200telas sem implementação. Objetivo global ATIVO; Controles FINAL. Acessos novos restantes ficam na etapa final; não ampliar grants por inferência. Sem commit/push ou credenciais na memória.
<!-- END CIW1053_METADATA_PUBLISHED -->

'''
    paths = [ROOT / 'context/PROJECT_CONTEXT.md', ROOT / 'context/RETOMADA_2026-10-16.md',
             Path('D:/opencode/construtor-pg/CONTEXTO_PROJETO.md'), Path('D:/opencode/motor-progress/v2/context/PROJECT_CONTEXT.md'),
             ROOT / 'context/CIW_COMPLETION_GOAL_2026-10-28.md']
    prepared = []
    for path in paths:
        before = path.read_bytes()
        text = before.decode('utf-8-sig')
        assert text.count('<!-- BEGIN CIW1042_COMPLETED -->') == 1
        assert '<!-- BEGIN CIW1042_LIVE_FIXTURE -->' not in text
        assert '<!-- BEGIN CIW1053_METADATA_PUBLISHED -->' not in text
        prepared.append((path, before, text))
    backup = STATE / 'memory-build12-metadata-published-backup'
    backup.mkdir()
    files = []
    for i, (path, before, text) in enumerate(prepared):
        shutil.copy2(path, backup / (str(i) + '-' + path.name))
        # Preserve existing context bytes exactly; Windows text I/O translates LF.
        path.write_bytes(note.encode('utf-8') + before)
        assert path.read_bytes().endswith(before)
        files.append({'path': str(path), 'before': hashlib.sha256(before).hexdigest(), 'after': sha(path)})
    active_path = STATE / 'ROOT_ACTIVE.json'
    shutil.copy2(active_path, backup / active_path.name)
    active = load(active_path)
    active.update(metadata1053='PUBLISHED_50945_OP1053V100_124_PARENT1000V103_125_FINANCE6_OLD4_AUTH_PRESERVED',
                  native1053='READ_GET_FILTER_PAGING_CONTEXT_7DECIMAL_GREEN_NO_HUMAN_GRANT',
                  batchScenario='COMPLETED9_STEPS_EXACT2147000110_CANONICAL_CLEANED12ZERO_LOGS_PRESERVED_NO_REPLAY',
                  next='OFFICIAL13_PREPARE_REVIEW;ITEM_ACTION_DELTA_CURRENT_EXPORTS;GLOBALACTIVE')
    active_path.write_text(json.dumps(active, indent=2) + '\n', encoding='utf-8')
    evidence = [DOMAIN / 'metadata-publication.json', NATIVE, STATE / 'batch1042-exercise/completion-proof.json']
    (STATE / 'memory-build12-metadata-published.json').write_text(json.dumps({'success': True, 'goal': 'ACTIVE', 'cleanup1042Preserved': True, 'human1053AccessGranted': False,
        'proofs': [{'path': str(p), 'sha256': sha(p)} for p in evidence], 'files': files}, indent=2) + '\n', encoding='utf-8')
    print('PASS checkpoint15: NF metadata/native confirmed, checkpoint14 cleanup preserved; global ACTIVE')


if __name__ == '__main__':
    assert sys.argv[1:] in [[], ['--preflight-only']]
    main(sys.argv[1:] == ['--preflight-only'])
