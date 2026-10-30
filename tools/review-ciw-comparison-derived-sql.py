"""Offline review of the fixed synthetic SQL fixture; never connects to a DB."""
import hashlib
import json
import pathlib
import re

ROOT = pathlib.Path(__file__).resolve().parents[1]
fixture_path = ROOT / 'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/sql-source-derived-fixture-v1.json'

def sha(path):
    return hashlib.sha256(path.read_bytes()).hexdigest()

def read(path):
    return json.loads(path.read_text(encoding='utf-8-sig'))

fixture = read(fixture_path)
contract_path = ROOT / fixture['sourceContract']['path']
metadata_path = ROOT / fixture['metadataProof']['path']
assert sha(contract_path) == fixture['sourceContract']['sha256']
assert sha(metadata_path) == fixture['metadataProof']['sha256']
contract, metadata = read(contract_path), read(metadata_path)
assert metadata['success'] and metadata['metadataOnly'] and not metadata['sqlExecuted']
assert metadata['requestSha256'] == fixture['metadataProof']['requestSha256']
types = {row['column']: (int(row['precision']), int(row['scale'])) for row in metadata['columns']}
assert len(types) == 9 and all(row['sqlType'] == '2' for row in metadata['columns'])
policy = fixture['policy']
assert policy['fixedDsn'] == 'espec_pro' and policy['processOnlyOdbcIni'] == '/etc/odbc.ini'
assert policy['rootApprovalRequiredBeforeExecution'] and not policy['candidateExecuted']
assert not any(policy[k] for k in ('physicalTablesReferenced','businessRowsProjected','businessWrites','ddl','freeSql','fallbackDsn'))
assert policy['maxCases'] == 14 and policy['maxRowsPerCase'] == 3 and policy['timeoutSecondsPerCase'] == 10
assert len(fixture['cases']) == 14 and len(fixture['caseMap']) == 14
reviewed = []
for case, case_map in zip(fixture['cases'], fixture['caseMap']):
    source = contract['currencies'][case['currency']]
    grid = ROOT / source['grid']
    assert sha(grid) == source['gridSha256'] == case['sourceGridSha256']
    assert case['sourceSelectLine'] == source['selectLine']
    projections = [row['literal'] for row in source['projections'] if row['ordinal'] >= 5]
    assert len(projections) == 10 and projections == case['sourceFinancialProjections']
    grid_text = grid.read_text(encoding='utf8')
    assert all(item in grid_text for item in projections)
    aliases = [re.split(r'\s+as\s+', item, flags=re.I)[-1] for item in projections]
    assert case['nullFlagMap'] == {f'n{i}': alias for i, alias in enumerate(aliases, 1)}
    rows, operand_map = case['syntheticRows'], case['physicalOperandMap']
    assert 2 <= len(rows) <= 3 and len(rows) == case['rowCount'] == case_map['rows']
    assert len({row['id'] for row in rows}) == len(rows)
    def cast(value, column):
        value = 'NULL' if value is None else value
        assert re.fullmatch(r'(?:NULL|-?\d+(?:\.\d+)?)', value)
        precision, scale = types[column]
        return f'CAST({value} AS NUMERIC({precision},{scale})) AS {column}'
    items, versions = [], []
    for row in rows:
        assert isinstance(row['id'], int) and 1 <= row['id'] <= 3
        items.append('SELECT ' + str(row['id']) + ' AS probe_case_id, ' + ', '.join(cast(row[key], operand_map[key]) for key in ('c','e','w','u')))
        versions.append('SELECT ' + str(row['id']) + ' AS probe_case_id, ' + cast(row['p'], operand_map['p']))
    expected = 'SELECT projected.*, ' + ', '.join(f'CASE WHEN projected.{alias} IS NULL THEN 1 ELSE 0 END AS n{i}' for i, alias in enumerate(aliases, 1))
    expected += ' FROM (\nSELECT item_custo.probe_case_id AS probe_case_id, ' + ', '.join(projections)
    expected += ' FROM (\n' + '\nUNION ALL\n'.join(items) + '\n) item_custo INNER JOIN (\n'
    expected += '\nUNION ALL\n'.join(versions) + '\n) versao ON versao.probe_case_id=item_custo.probe_case_id\n) projected ORDER BY projected.probe_case_id'
    assert case['query'] == expected
    assert not re.search(r'\b(?:INSERT|UPDATE|DELETE|CREATE|DROP|ALTER|GRANT|REVOKE|EXECUTE|CALL)\b|;|--|/\*', expected, flags=re.I)
    assert hashlib.sha256(expected.encode('utf8')).hexdigest() == case['querySha256'] == case_map['querySha256']
    assert case_map['case'] == case['case'] and not case['executeByCandidate']
    assert case['expectedOutcome'] == 'UNOBSERVED_ROOT_REVIEW_BEFORE_EXECUTION'
    reviewed.append({'case': case['case'], 'querySha256': case['querySha256'], 'syntheticRows': len(rows)})

receipt = {
    'success': True, 'scope': 'offline-fixed-fixture-review-only',
    'fixture': str(fixture_path.relative_to(ROOT)).replace('\\','/'), 'fixtureSha256': sha(fixture_path),
    'sourceContractSha256': sha(contract_path), 'metadataProofSha256': sha(metadata_path),
    'cases': reviewed, 'caseCount': len(reviewed), 'totalSyntheticRows': sum(row['syntheticRows'] for row in reviewed),
    'financialExpressionsVerbatim': True, 'castsMatchSqlColumnsPrecisionScale': True,
    'queriesReconstructedExactly': True, 'physicalTableReferences': False,
    'networkUsed': False, 'sqlExecuted': False, 'businessWrites': False,
    'findingsP1': [], 'findingsP2': [],
    'limits': ['Derived constants can be optimized; no claim of physical row evaluation equivalence.',
               'SQL syntax and outcomes remain unobserved until root executes this exact closed fixture.',
               'No production SQL, metadata or authentication configuration changed.'],
}
out = ROOT / '.runtime/ciw-completion-20261028/container-cost-comparison-readonly/sql-derived-manager-review.json'
out.parent.mkdir(parents=True, exist_ok=True)
out.write_text(json.dumps(receipt, ensure_ascii=False, indent=2) + '\n', encoding='utf8')
print(json.dumps({'success': True, 'cases': len(reviewed), 'rows': receipt['totalSyntheticRows'], 'reviewSha256': sha(out)}))
