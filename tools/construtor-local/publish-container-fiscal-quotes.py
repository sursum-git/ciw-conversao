"""Closed nine-file fiscal quotation delta. Run only on the approved runtime.

No routes, configuration, auth, schema, trigger, JMX or business operations.
The caller owns the quiet load window and any later idle-session refresh.
"""
from pathlib import Path
from datetime import datetime, timezone
import hashlib, json, os, re, shutil, sys

STAGE_NAME = 'codex-container-fiscal-quotes-20261017'
SCOPE = 'container-fiscal-quotes-20261017'
PROGRAMS = ('ContainersCabecalhoRuntime', 'ContainersCustoCalculator', 'ContainersCustoRead', 'ContainersCustoReadService')
TARGETS = frozenset('sursum-api/programs/' + n + e for n in PROGRAMS for e in ('.p', '.r')) | {'sursum-api/includes/ContainerCustoBoundary.i'}
CULTURES = ('AMERICAN', 'EUROPEAN')
FOCAL = {
    'ContainersCabecalhoRuntimeTest': ('containers-cabecalho-runtime-tests-', 47),
    'ContainersCustoCalculatorTest': ('containers-custo-tests-', 116),
    'ContainersCustoReadTest': ('containers-custo-read-tests-', 204),
    'ContainersCustoBoundaryTest': ('container-custo-boundary-tests-', 57),
}
HASH = re.compile(r'^[0-9a-f]{64}$')

def sha(path):
    return hashlib.sha256(path.read_bytes()).hexdigest()

def require(ok, message):
    if not ok:
        raise ValueError(message)

def validate(stage, root):
    require(stage.name == STAGE_NAME, 'Unexpected staging directory')
    plan = json.loads((stage / 'manifest.json').read_text(encoding='utf-8-sig'))
    require(plan.get('scope') == SCOPE and set(plan.get('targets', {})) == TARGETS and set(plan.get('baseline', {})) == TARGETS, 'Unexpected publication scope')
    evidence = {'coherent-compile.log'} | {prefix + c + '.log' for prefix, _ in FOCAL.values() for c in CULTURES}
    require(set(plan.get('evidence', {})) == evidence, 'Exact compile/culture evidence required')
    for name, digest in plan['evidence'].items():
        require(isinstance(digest, str) and HASH.fullmatch(digest) and sha(stage / name) == digest, 'Evidence hash mismatch: ' + name)
    proof = (stage / 'coherent-compile.log').read_text(encoding='utf-8-sig')
    require(re.search(r'^OpenEdge 12\.2(?:\s|$)', proof) and 'PASS COMPILE' in proof and proof.rstrip().endswith('PASS SUITE') and not re.search(r'FAIL|COMPILER:ERROR=yes', proof), 'Successful OpenEdge12.2 proof required')
    compiled = re.findall(r'^([^\s]+\.(?:p|cls)) COMPILER:ERROR=no$', proof, re.M)
    require(len(compiled) == 73 and len(set(compiled)) == 73 and all(n + '.p' in compiled for n in PROGRAMS), 'Coherent73-source compilation required')
    for culture in CULTURES:
        tests = re.findall(r'^PASS ([^\s]+\.p) ' + culture + r'$', proof, re.M)
        require(len(tests) == 36 and len(set(tests)) == 36 and all(n + '.p' in tests for n in FOCAL), 'Coherent36-suite proof required: ' + culture)
        for _, (prefix, minimum) in FOCAL.items():
            content = (stage / (prefix + culture + '.log')).read_text(encoding='utf-8-sig')
            count = re.search(r'PASS:?\s*(\d+)\s+checks', content)
            require('FAIL' not in content and count and int(count.group(1)) >= minimum, 'Fiscal regression evidence incomplete: ' + prefix + culture)
    for relative, record in plan['targets'].items():
        require(set(record) == {'file', 'sha256'} and record['file'] == Path(relative).name and isinstance(record['sha256'], str) and HASH.fullmatch(record['sha256']), 'Invalid staged artifact record')
        incoming = stage / record['file']; target = root / relative; baseline = plan['baseline'][relative]
        require(not incoming.is_symlink() and incoming.is_file() and sha(incoming) == record['sha256'], 'Staged artifact changed: ' + relative)
        require(isinstance(baseline, str) and HASH.fullmatch(baseline) and not target.is_symlink() and target.is_file() and sha(target) == baseline, 'Baseline changed: ' + relative)
        require(root.resolve() in target.resolve().parents, 'Target escaped publication root')
    return plan

def publish(stage):
    require(stage == Path('/tmp') / STAGE_NAME, 'Fixed runtime staging path required')
    root = Path('/mnt/datasul/ERP/sursum')
    plan = validate(stage, root)
    # A local exclusive marker rejects parallel invocations of this same delta.
    lock = stage / 'publication.lock'
    with lock.open('x', encoding='utf-8') as handle:
        handle.write(str(os.getpid()))
    backup = stage / ('backup-' + datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%S%fZ'))
    temps = {}; written = []; conflicts = []
    try:
        validate(stage, root)
        backup.mkdir()
        shutil.copy2(stage / 'manifest.json', backup / 'manifest.json')
        for relative, record in plan['targets'].items():
            target = root / relative
            require(sha(target) == plan['baseline'][relative], 'Concurrent change before backup: ' + relative)
            shutil.copy2(target, backup / record['file'])
            require(sha(backup / record['file']) == plan['baseline'][relative], 'Backup mismatch')
            temp = target.with_name(target.name + '.fiscal-quotes-new')
            # Exclusive creation prevents adopting/deleting another invocation's file.
            with temp.open('xb') as handle:
                temps[relative] = temp
                handle.write((stage / record['file']).read_bytes())
                handle.flush(); os.fsync(handle.fileno())
            os.chmod(temp, target.stat().st_mode & 0o777)
            require(sha(temp) == record['sha256'], 'Transfer mismatch')
        for relative in sorted(TARGETS):
            target = root / relative
            require(sha(target) == plan['baseline'][relative], 'Concurrent change before replacement: ' + relative)
            os.replace(temps[relative], target); written.append(relative)
            require(sha(target) == plan['targets'][relative]['sha256'], 'Published mismatch')
        for relative in TARGETS:
            require(sha(root / relative) == plan['targets'][relative]['sha256'], 'Final verification mismatch')
        active = {'publishedAt':datetime.now(timezone.utc).isoformat(), 'instance':'sursum-api', 'context':'med', 'backup':str(backup), 'artifacts':{r:v['sha256'] for r,v in plan['targets'].items()}, 'routesChanged':False, 'authChanged':False, 'schemaChanged':False, 'triggerChanged':False, 'businessWrites':False, 'compiledSources':73, 'suitesPerCulture':36}
        (stage / 'active-manifest.json').write_text(json.dumps(active, indent=2) + '\n', encoding='utf-8')
    except Exception:
        for relative in reversed(written):
            target = root / relative; record = plan['targets'][relative]
            if not target.is_file() or sha(target) != record['sha256']:
                conflicts.append(relative); continue
            restore = target.with_name(target.name + '.fiscal-quotes-restore')
            try:
                with restore.open('xb') as handle:
                    handle.write((backup / record['file']).read_bytes()); handle.flush(); os.fsync(handle.fileno())
                os.chmod(restore, target.stat().st_mode & 0o777)
                require(sha(restore) == plan['baseline'][relative], 'Restore mismatch')
                os.replace(restore, target)
            except Exception:
                conflicts.append(relative)
        if conflicts:
            print('Rollback preserved concurrent/failed targets; inspect backup: ' + str(backup) + '; ' + ', '.join(conflicts), file=sys.stderr)
        raise
    finally:
        for temp in temps.values():
            if temp.exists(): temp.unlink()
        lock.unlink()
    print('PASS:9 guarded fiscal quotation artifacts; no routes/auth/schema/trigger/JMX changes. Backup ' + str(backup))

if __name__ == '__main__':
    if len(sys.argv) != 2:
        raise SystemExit('Usage: publish-container-fiscal-quotes.py /tmp/' + STAGE_NAME)
    publish(Path(sys.argv[1]).resolve())
