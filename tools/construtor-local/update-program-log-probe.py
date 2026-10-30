import hashlib,json,os,shutil,sys
from pathlib import Path
stage=Path(sys.argv[1])
published=Path('/tmp/codex-program-log-20261015/manifest.json')
root=Path('/mnt/datasul/ERP/sursum/sursum-api/programs')
old=json.loads(published.read_text(encoding='utf-8-sig'))
new=json.loads((stage/'manifest.json').read_text(encoding='utf-8-sig'))
for name in ['ProgramLogProbe.p','ProgramLogProbe.r']:
    rel='sursum-api/programs/'+name
    assert hashlib.sha256((root/name).read_bytes()).hexdigest()==old['new'][rel],name
    assert hashlib.sha256((stage/name).read_bytes()).hexdigest()==new[name],name
for name in ['ProgramLogProbe.p','ProgramLogProbe.r']:
    tmp=root/(name+'.probe-new');shutil.copyfile(stage/name,tmp);os.chmod(tmp,0o644);os.replace(tmp,root/name)
    old['new']['sursum-api/programs/'+name]=new[name]
published.write_text(json.dumps(old,indent=2)+'\n',encoding='utf-8')
print('PASS: somente fixture temporaria atualizada com diagnostico; hashes de remocao atualizados.')
