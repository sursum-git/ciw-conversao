"""Independent structural review of the five immutable filter candidates. No HTTP."""
import copy
import hashlib
import json
from pathlib import Path

ROOT = Path('D:/opencode/conversao-sc')
RECEIPTS = ROOT / '.runtime/ciw-completion-20261028/cadastros-queries'
CANDIDATES = ROOT / 'integration-src/ciw-completion-20261028/cadastro-query-filters'

def read(path):
    return json.loads(path.read_text(encoding='utf-8-sig'))

def sha(path):
    return hashlib.sha256(path.read_bytes()).hexdigest()

result = []
validation = read(RECEIPTS / 'filter-validation.json')
assert validation['success'] and not validation['businessWrites']
for code in range(94, 99):
    name = f'cd{code:04}'
    before = read(RECEIPTS / f'{name}-program-before.json')['versions'][0]
    preview = read(RECEIPTS / f'{name}-preview.json')
    candidate_path = CANDIDATES / f'{name}-program-draft.json'
    candidate = read(candidate_path)
    assert candidate == preview['builderConfig'], name + ': candidate/preview mismatch'
    old_definition = copy.deepcopy(before['generatedDefinition'])
    new_definition = copy.deepcopy(preview['generatedDefinition'])
    old_filters = old_definition['crud']['filter']['fields']
    new_filters = new_definition['crud']['filter']['fields']
    assert old_definition['program'].pop('version') == '1.0.0'
    assert new_definition['program'].pop('version') == '1.0.1'
    old_definition['crud']['filter']['fields'] = None
    new_definition['crud']['filter']['fields'] = None
    assert old_definition == new_definition, name + ': generated delta outside version/filter fields'
    old_builder = copy.deepcopy(before['builderConfig'])
    new_builder = copy.deepcopy(candidate)
    old_builder.pop('version')
    new_builder.pop('version')
    old_builder['crudOptions'] = None
    new_builder['crudOptions'] = None
    assert old_builder == new_builder, name + ': builder delta outside version/crudOptions'
    assert set(candidate['crudOptions']) == {'filterFields'}, name + ': extra CRUD option'
    assert len(candidate['crudOptions']['filterFields']) == len(set(candidate['crudOptions']['filterFields']))
    # Existing filters remain byte-for-byte; appended text filters are additive.
    assert new_filters[:len(old_filters)] == old_filters, name + ': existing filters changed'
    declared = preview['generatedDefinition']['dataModel']['fields']
    for field in candidate['crudOptions']['filterFields']:
        assert field in declared, name + ': unknown field ' + field
    added = candidate['crudOptions']['filterFields'][len(old_filters):]
    assert added == (['codigo', 'val_param'] if code == 98 else ['descricao']), name + ': incorrect addition'
    proof = next(p for p in validation['screens'] if p['code'] == name)
    assert all(proof[k] for k in ('legacyColumnsPreserved', 'deltaOnlyFiltersAndVersion', 'nativeJsValidated', 'get', 'paging'))
    result.append({'code': name, 'sha256': sha(candidate_path), 'generatedOnlyTwoPaths': True,
                   'builderOnlyVersionAndFilterFields': True, 'existingFiltersPreserved': True,
                   'addedFilters': added, 'p1p2': []})
out = {'success': True, 'reviewer': 'ciw_completion_manager', 'reviews': result,
       'limitations': ['Valor IMA: prova positiva no recibo raiz false; vazio/negativa validada. Nao alegar filtro positivo real de valor.',
                       'Esta revisao e estrutural/contratual; root valida publicacao e UI apos aplicar.'],
       'canonicalChanged': False, 'businessWrites': False}
(RECEIPTS / 'manager-review.json').write_text(json.dumps(out, ensure_ascii=False, indent=2) + '\n', encoding='utf-8')
print(json.dumps({'success': True, 'screens': len(result), 'p1p2': 0}))
