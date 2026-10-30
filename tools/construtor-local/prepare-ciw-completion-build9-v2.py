"""Fresh immutable harness companion; do not change failed build9 or any product byte."""
from pathlib import Path
import hashlib
import json
import shutil

ROOT = Path('D:/opencode/conversao-sc')
OLD = ROOT / '.runtime/ciw-completion-20261028/official-build9'
NEW = ROOT / '.runtime/ciw-completion-20261028/official-build9-v2'
sha = lambda p: hashlib.sha256(Path(p).read_bytes()).hexdigest()
load = lambda p: json.loads(Path(p).read_text(encoding='utf-8-sig'))
assert not NEW.exists(), 'Fresh companion required; inspect existing state instead of replay'
assert sha(OLD / 'release.json') == 'f0921a0d398cc3e69ff2bc2874fd6179277e7d7b23d183eaccc90e69192dbc86'
assert sha(OLD / 'manager-release.json') == 'f404c8506bcd246361beb5caf11502d0f5903770bfb26e1aeff4af54a224e0a4'
prior = load(OLD / 'release.json')
for item in prior['files']:
    assert sha(OLD / item['path']) == item['sha256'], item['path']
NEW.mkdir()
for item in prior['files']:
    rel = item['path']
    if rel in ('prepare.py', 'verify.py'):
        continue
    target = NEW / rel
    target.parent.mkdir(parents=True, exist_ok=True)
    shutil.copyfile(OLD / rel, target)

def translate(value):
    if isinstance(value, list):
        return [translate(x) for x in value]
    if isinstance(value, dict):
        return {k: translate(v) for k, v in value.items()}
    if isinstance(value, str):
        return value.replace('official-build9/', 'official-build9-v2/').replace('official-build9\\', 'official-build9-v2\\').replace('20261028-build9/', '20261028-build9-v2/').replace('20261028-build9"', '20261028-build9-v2"').replace('20261028-build9\'', '20261028-build9-v2\'') if value != 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build9' else value + '-v2'
    return value

def write(name, value):
    (NEW / name).write_text(json.dumps(value, indent=2) + '\n', encoding='utf-8')

remote_before = 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build9'
remote_after = remote_before + '-v2'
for name in ('Compile.p', 'Regression.p', 'compile122.ps1'):
    path = NEW / 'package' / name
    data = path.read_bytes()
    updated = data.replace(remote_before.encode(), remote_after.encode())
    if name == 'Compile.p':
        assert updated.count(b'JsonProgramWebHandler.cls,') == 1
        updated = updated.replace(b'JsonProgramWebHandler.cls,', b'')
    path.write_bytes(updated)
for name in ('source-manifest.json', 'remote-plan.json', 'integration-plan.json'):
    value = translate(load(OLD / name))
    if name == 'source-manifest.json':
        for row in value:
            row['sha256'] = sha(ROOT / row['file'])
    if name == 'remote-plan.json':
        removed = [x for x in value['downloads'] if x['remote'].endswith('/JsonProgramWebHandler.r')]
        assert len(removed) == 1
        value['downloads'] = [x for x in value['downloads'] if x not in removed]
        assert all(remote_before + '/' not in x for x in value['commands'])
    write(name, value)
source = load(NEW / 'source-manifest.json')
for row in source:
    assert sha(ROOT / row['file']) == row['sha256']
manifest = load(OLD / 'build-manifest.json')
assert manifest['compileEntries'].count('JsonProgramWebHandler.cls') == 1
manifest['compileEntries'].remove('JsonProgramWebHandler.cls')
manifest['state'] = 'CANDIDATE_READY_HARNESS_COMPANION_ROOT_OFFICIAL122_PENDING'
for key, filename in [('sourceManifestSha256', 'source-manifest.json'), ('remotePlanSha256', 'remote-plan.json'), ('integrationPlanSha256', 'integration-plan.json')]:
    manifest[key] = sha(NEW / filename)
manifest['priorFailure'] = {'stage': str(OLD), 'releaseSha256': sha(OLD / 'release.json'), 'cause': 'Stable unrelated JsonProgramWebHandler.cls RETURN NO-ERROR syntax247/198; six earlier classes compiled; no TT or business ran.', 'removedCompileEntryOnly': 'JsonProgramWebHandler.cls', 'handlerSourceUnchangedNotPublished': True}
manifest['phpProofReuse'] = 'Original fullPHP968/6529 and Reflection276 from build9; all412 stagedsrc and all test PHP bytes identical. No PHP rerun or new execution claim.'
write('build-manifest.json', manifest)
verify = (OLD / 'verify.py').read_text()
start, end = verify.index("if '--seal' in sys.argv:"), verify.index("if (B/'release.json').exists():")
verify = verify[:start] + "if '--seal' in sys.argv: raise AssertionError('Companion immutable; no reseal or source regeneration')\n" + verify[end:]
verify = verify.replace('all 24 compilation records', 'all 23 compilation records')
(NEW / 'verify.py').write_text(verify, encoding='utf-8')
same = []
for folder in ('backend-stage', 'php-tests', 'test-inputs'):
    for path in sorted((OLD / folder).rglob('*')):
        if path.is_file():
            rel = path.relative_to(OLD)
            assert sha(path) == sha(NEW / rel), str(rel)
            same.append({'relative': rel.as_posix(), 'sha256': sha(path)})
for item in manifest['compileEntries']:
    if item in ('Compile.p', 'Regression.p', 'compile122.ps1'):
        continue
    assert (NEW / 'package' / item).read_bytes() == (OLD / 'package' / item).read_bytes(), item
write('harness-companion-proof.json', {'success': True, 'priorReleaseSha256': sha(OLD / 'release.json'), 'priorManagerReleaseSha256': sha(OLD / 'manager-release.json'), 'sameProductAndTestFiles': same, 'compileEntriesBefore': 24, 'compileEntriesAfter': 23, 'removedCompileEntryOnly': 'JsonProgramWebHandler.cls', 'newStage': remote_after, 'phpFullReusedPath': str(OLD / 'php-full.xml'), 'phpFullReusedSha256': sha(OLD / 'php-full.xml'), 'loaderProofReusedPath': str(OLD / 'php-stage-loader-proof.json'), 'loaderProofReusedSha256': sha(OLD / 'php-stage-loader-proof.json'), 'noPhpRerun': True, 'noProductionSourceChange': True, 'networkExecuted': False, 'canonicalChanged': False})
(NEW / 'REVIEW.md').write_text('Build9-v2: companion de harness; stage fresco. Exclui somente a entrada de compilação do handler estável não afetado e seu download .r. Não corrige, integra ou publica esse handler. Demais fontes de produção/testes/PHP permanecem byteidênticas ao build9. FULLPHP968/6529 e loader276 são provas reutilizadas do build9 por equivalência de hashes, sem nova execução. 23 compiles com1DB de schema; duas suites39+231 em4combinações/8logs/1080checks com0DB. Os 4JSONsTT oficiais devem coincidir integralmente com a fixture PHP anterior. Root executa uma vez após conferir release; preservar a falha9 e seus logs. Não rodar prepare antigo nem --seal.\n', encoding='utf-8')
files = [{'path': p.relative_to(NEW).as_posix(), 'sha256': sha(p)} for p in sorted(NEW.rglob('*')) if p.is_file()]
release = {'success': True, 'state': manifest['state'], 'priorFailedReleaseSha256': sha(OLD / 'release.json'), 'productFreezeSha256': manifest['productFreezeSha256'], 'buildManifestSha256': sha(NEW / 'build-manifest.json'), 'sourceManifestSha256': sha(NEW / 'source-manifest.json'), 'remotePlanSha256': sha(NEW / 'remote-plan.json'), 'integrationPlanSha256': sha(NEW / 'integration-plan.json'), 'files': files, 'phpReusedUnchanged': [968, 6529], 'officialExecuted': False}
write('release.json', release)
print(json.dumps({'success': True, 'releaseSha256': sha(NEW / 'release.json'), 'planSha256': sha(NEW / 'remote-plan.json'), 'files': len(files), 'sameProductTestFiles': len(same), 'compileEntries': len(manifest['compileEntries'])}))
