"""Run the reviewed closed fixture, with only the proven one-row system anchor."""
from pathlib import Path
import hashlib

root = Path(__file__).resolve().parents[2]
fixture = root / 'integration-src/ciw-completion-20261028/container-cost-comparison-readonly/sql-source-derived-fixture-v2.json'
assert hashlib.sha256(fixture.read_bytes()).hexdigest() == '8c9e15ed6f87ca344d0c81d972facb2e5d5b81d19ef28f9cb91dd8c6ba5be903'
source = Path(__file__).with_name('probe-ciw-comparison-derived-sql.py').read_text()
source = source.replace('sql-source-derived-fixture-v1.json', 'sql-source-derived-fixture-v2.json')
source = source.replace('c9da5e858ce3128cf34c41d6e363ee32897603c2eb173afc7785c65d2896a8b5', '8c9e15ed6f87ca344d0c81d972facb2e5d5b81d19ef28f9cb91dd8c6ba5be903')
source = source.replace("not data['policy']['physicalTablesReferenced']", "data['policy']['businessTablesReferenced'] is False and data['policy']['onlyAllowedTable']=='SYSPROGRESS.SYSCALCTABLE'")
source = source.replace("for row in data['cases']:\n", "for row in data['cases']:\n assert not re.search(r'\\b(?:FROM|JOIN)\\s+(?!SYSPROGRESS\\.SYSCALCTABLE\\b|\\()',row['query'],re.I)\n")
source = source.replace('sql-comparison-source-derived-v1.json', 'sql-comparison-source-derived-v2.json')
exec(compile(source, __file__, 'exec'))
