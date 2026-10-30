"""Fixed16-artifact payment delta and one additive route. No business/JMX/auth."""
from pathlib import Path
from datetime import datetime,timezone
import hashlib,json,os,re,shutil,sys

SCOPE='container-payments-20261017'
STAGE_NAME='codex-container-payments-20261017'
EXISTING=('ContainersItensFinanceiroService','ContainersItensRuntime','ContainersPainelFinanceReadService','ContainersItensCrudService')
NEW=('ContainersPagamentosCrud','ContainersPagamentosCrudService','ContainersPagamentosRuntime')
PROGRAMS=EXISTING+NEW
TARGETS=frozenset('sursum-api/programs/'+n+e for n in PROGRAMS for e in ('.p','.r'))|{'sursum-api/includes/ContainerPaymentIdentity.i','sursum-api/includes/ContainerMaintenanceEffects.i'}
TESTS=frozenset(('ContainerMaintenanceEffectsTest.p','ContainersItensCrudTest.p','ContainersItensFinanceiroTest.p','ContainersItensCompositionTest.p','ContainersPainelFinanceReadTest.p','ContainersPagamentosCrudTest.p','ContainersPagamentosBoundaryTest.p','ContainersPagamentosCompositionTest.p'))
BRIDGE='ContainersPagamentosBridgeTest.p'
BRIDGE_PREFIX='containers-pagamentos-bridge-tests-'
ADDITION={'route':'/SursumPrograms/containers-pagamentos','method':'POST','program':'sursum-api/programs/ContainersPagamentosCrud.p'}
CULTURES=('AMERICAN','EUROPEAN')
HASH=re.compile(r'^[0-9a-f]{64}$')

def sha(p):return hashlib.sha256(p.read_bytes()).hexdigest()
def require(ok,message):
    if not ok:raise ValueError(message)

def validate(stage,root):
    require(stage.name==STAGE_NAME,'Unexpected staging directory')
    plan=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
    require(plan.get('scope')==SCOPE and set(plan.get('targets',{}))==TARGETS and set(plan.get('baseline',{}))==TARGETS,'Unexpected16-artifact scope')
    require(set(plan.get('tests',{}))==TESTS,'Eight current connected regression suites required')
    for prefix in plan['tests'].values():require(re.fullmatch(r'[a-z][a-z0-9-]*-',prefix),'Invalid fixed evidence prefix')
    names={'coherent-compile.log','bridge-nodb-run.log'}|{prefix+c+'.log' for prefix in plan['tests'].values() for c in CULTURES}|{BRIDGE_PREFIX+c+'.log' for c in CULTURES}
    require(set(plan.get('evidence',{}))==names,'Exact culture evidence required')
    for name,digest in plan['evidence'].items():require(isinstance(digest,str) and HASH.fullmatch(digest) and sha(stage/name)==digest,'Evidence drift: '+name)
    proof=(stage/'coherent-compile.log').read_text(encoding='utf-8-sig')
    require(proof.startswith('OpenEdge 12.2') and proof.rstrip().endswith('PASS SUITE') and 'PASS COMPILE' in proof and not re.search(r'FAIL|COMPILER:ERROR=yes',proof),'Fresh coherent12.2 proof required')
    compiled=re.findall(r'^(\S+\.(?:p|cls)) COMPILER:ERROR=no$',proof,re.M)
    require(isinstance(plan.get('compiledSources'),int) and plan['compiledSources']>=81 and len(compiled)==len(set(compiled))==plan['compiledSources'] and all(n+'.p' in compiled for n in PROGRAMS) and BRIDGE in compiled,'All base73 and payment/bridge/helper sources must compile')
    require(isinstance(plan.get('suitesPerCulture'),int) and plan['suitesPerCulture']>=40,'All base36 and payment/helper tests required')
    require(plan.get('noDbSuitesPerCulture')==1,'Mandatory separate noDB bridge suite required')
    bridge=(stage/'bridge-nodb-run.log').read_text(encoding='utf-8-sig')
    require(bridge.startswith('OpenEdge 12.2') and 'Connected databases=0' in bridge and bridge.rstrip().endswith('PASS BRIDGE NO DB') and 'FAIL' not in bridge,'Bridge must run in a separate12.2 AVM without databases')
    for culture in CULTURES:
        ran=re.findall(r'^PASS (\S+\.p) '+culture+'$',proof,re.M)
        require(len(ran)==len(set(ran))==plan['suitesPerCulture'] and TESTS.issubset(ran) and BRIDGE not in ran,'Coherent suite set incomplete or unsafe connected bridge: '+culture)
        require('PASS '+BRIDGE+' '+culture in bridge,'Separate noDB bridge culture missing')
        bridge_checks=(stage/(BRIDGE_PREFIX+culture+'.log')).read_text(encoding='utf-8-sig');bridge_count=re.search(r'PASS:?\s*(\d+)\s+checks',bridge_checks)
        require('FAIL' not in bridge_checks and bridge_count and int(bridge_count.group(1))==5,'Bridge requires exactly5checks without skip')
        for prefix in plan['tests'].values():
            text=(stage/(prefix+culture+'.log')).read_text(encoding='utf-8-sig');count=re.search(r'PASS:?\s*(\d+)\s+checks',text)
            require('FAIL' not in text and count and int(count.group(1))>0,'Invalid regression evidence: '+prefix+culture)
    for relative,entry in plan['targets'].items():
        require(set(entry)=={'file','sha256'} and entry['file']==Path(relative).name and HASH.fullmatch(entry['sha256']),'Invalid artifact record')
        incoming=stage/entry['file'];target=root/relative;before=plan['baseline'][relative]
        require(incoming.is_file() and not incoming.is_symlink() and sha(incoming)==entry['sha256'],'Staged artifact changed')
        require(root.resolve() in target.resolve().parents and not target.is_symlink(),'Target escaped root')
        existing=any(relative=='sursum-api/programs/'+n+e for n in EXISTING for e in ('.p','.r'))
        if existing:require(isinstance(before,str) and HASH.fullmatch(before) and target.is_file() and sha(target)==before,'Published baseline changed: '+relative)
        else:require(before is None and not target.exists(),'New target occupied: '+relative)
    catalog=root/'conf-web-handler/program-routes.json';before=catalog.read_bytes();routes=json.loads(before.decode('utf-8-sig'))
    require(isinstance(routes.get('routes'),list) and not any(x.get('route')==ADDITION['route'] for x in routes['routes']),'New payment route occupied')
    routes['routes'].append(ADDITION);after=(json.dumps(routes,ensure_ascii=False,indent=2)+'\n').encode('utf-8')
    return plan,before,after

def publish(stage):
    require(stage==Path('/tmp')/STAGE_NAME,'Fixed runtime staging path required')
    root=Path('/mnt/datasul/ERP/sursum');plan,before,after=validate(stage,root)
    lock=stage/'publication.lock'
    with lock.open('x') as handle:handle.write(str(os.getpid()))
    backup=stage/('backup-'+datetime.now(timezone.utc).strftime('%Y%m%dT%H%M%S%fZ'))
    temps={};written=[];catalog_written=False;catalog_temp=None;conflicts=[];catalog=root/'conf-web-handler/program-routes.json'
    try:
        validate(stage,root);backup.mkdir();shutil.copy2(stage/'manifest.json',backup/'manifest.json');(backup/'program-routes.json').write_bytes(before)
        for relative,entry in plan['targets'].items():
            target=root/relative;baseline=plan['baseline'][relative]
            require((sha(target) if target.is_file() else None)==baseline,'Concurrent target change before backup')
            if baseline is not None:
                shutil.copy2(target,backup/entry['file']);require(sha(backup/entry['file'])==baseline,'Backup mismatch')
            temp=target.with_name(target.name+'.container-payments-new')
            with temp.open('xb') as handle:temps[relative]=temp;handle.write((stage/entry['file']).read_bytes());handle.flush();os.fsync(handle.fileno())
            os.chmod(temp,(target.stat().st_mode&0o777) if target.exists() else 0o644);require(sha(temp)==entry['sha256'],'Transfer mismatch')
        for relative in sorted(TARGETS):
            target=root/relative;require((sha(target) if target.is_file() else None)==plan['baseline'][relative],'Concurrent artifact change')
            os.replace(temps[relative],target);written.append(relative);require(sha(target)==plan['targets'][relative]['sha256'],'Published mismatch')
        require(catalog.read_bytes()==before,'Concurrent catalog change; prior routes will not be overwritten')
        candidate=catalog.with_name(catalog.name+'.container-payments-new')
        with candidate.open('xb') as handle:catalog_temp=candidate;handle.write(after);handle.flush();os.fsync(handle.fileno())
        os.chmod(candidate,catalog.stat().st_mode&0o777);os.replace(candidate,catalog);catalog_written=True
        require(catalog.read_bytes()==after,'Route catalog mismatch')
        for relative in TARGETS:require(sha(root/relative)==plan['targets'][relative]['sha256'],'Final artifact mismatch')
        active={'publishedAt':datetime.now(timezone.utc).isoformat(),'instance':'sursum-api','context':'med','backup':str(backup),'artifacts':{r:e['sha256'] for r,e in plan['targets'].items()},'catalogSha256':sha(catalog),'addedRoutes':[ADDITION],'businessWrites':False,'authChanged':False,'schemaChanged':False,'triggerChanged':False,'compiledSources':plan['compiledSources'],'suitesPerCulture':plan['suitesPerCulture'],'noDbSuitesPerCulture':1,'bridgeChecksPerCulture':5,'checksPerCulture':plan['checksPerCulture']}
        (stage/'active-manifest.json').write_text(json.dumps(active,indent=2)+'\n',encoding='utf-8')
    except Exception:
        if catalog_written:
            if catalog.read_bytes()==after:
                restore=catalog.with_name(catalog.name+'.container-payments-restore')
                try:
                    with restore.open('xb') as handle:handle.write(before);handle.flush();os.fsync(handle.fileno())
                    os.chmod(restore,catalog.stat().st_mode&0o777);os.replace(restore,catalog)
                except Exception:conflicts.append('program-routes.json')
            else:conflicts.append('program-routes.json')
        for relative in reversed(written):
            target=root/relative;entry=plan['targets'][relative]
            if not target.is_file() or sha(target)!=entry['sha256']:conflicts.append(relative);continue
            if plan['baseline'][relative] is None:target.unlink()
            else:
                restore=target.with_name(target.name+'.container-payments-restore')
                try:
                    with restore.open('xb') as handle:handle.write((backup/entry['file']).read_bytes());handle.flush();os.fsync(handle.fileno())
                    os.chmod(restore,target.stat().st_mode&0o777);require(sha(restore)==plan['baseline'][relative],'Restore mismatch');os.replace(restore,target)
                except Exception:conflicts.append(relative)
        if conflicts:print('Rollback preserved concurrent/failed targets; inspect '+str(backup)+': '+','.join(conflicts),file=sys.stderr)
        raise
    finally:
        for temp in list(temps.values())+([catalog_temp] if catalog_temp else []):
            if temp.exists():temp.unlink()
        lock.unlink()
    print('PASS:16 guarded artifacts +1additive payment route; no auth/schema/trigger/JMX/business mutation. Backup '+str(backup))

if __name__=='__main__':
    if len(sys.argv)!=2:raise SystemExit('Usage: publish-container-payments.py /tmp/'+STAGE_NAME)
    publish(Path(sys.argv[1]).resolve())
