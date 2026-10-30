"""Sanitized exact13 source collection and one closed wrapper stat; no legacy PHP execution."""
from pathlib import Path
import hashlib,json,re
ROOT=Path(__file__).resolve().parents[2]
request=ROOT/'.runtime/ciw-completion-20261028/next-source-request13e.json'
assert hashlib.sha256(request.read_bytes()).hexdigest()=='b881c26e37ba5497481b4ec1915ffaa18adf95cc3539948aa913b32f49a7d173'
spec=json.loads(request.read_text(encoding='utf-8'));apps=spec['applications']
assert len(apps)==13 and len(set(apps))==13 and spec['readOnly']and not spec['executeLegacyPhp']and spec['sanitizeBeforePersist']
assert all(re.fullmatch('[A-Za-z0-9_]+',name)for name in apps)
assert not set(apps)&set(spec['excludeDiagnostics']+spec['deferControlesFinal'])
source=ROOT/'tools/construtor-local/inspect-ciw-completion-next19c-source.py';text=source.read_text(encoding='utf-8')
text,n=re.subn(r'^ apps=\[.*?\]$',lambda _:' apps='+repr(apps),text,flags=re.M);assert n==1
text=text.replace('ciw-completion-next19c-20261028','ciw-completion-next13e-20261028')
old="with tarfile.open(fileobj=__import__('sys').stdout.buffer,mode='w|gz') as archive:"
new="""statPath=base+'/cons_ped_container/index.php'
closedStat={'application':'cons_ped_container','file':'index.php','exists':os.path.lexists(statPath),'regular':os.path.isfile(statPath)and not os.path.islink(statPath),'symlink':os.path.islink(statPath)}
closedStat['bytes']=os.stat(statPath).st_size if closedStat['regular']else None
with tarfile.open(fileobj=__import__('sys').stdout.buffer,mode='w|gz',format=tarfile.PAX_FORMAT,pax_headers={'CIW.closedStat':json.dumps(closedStat)}) as archive:"""
assert text.count(old)==1;text=text.replace(old,new)
old="  with tarfile.open(fileobj=io.BytesIO(data),mode='r:gz') as archive:\n"
new=old+"   closedStat=json.loads(archive.pax_headers['CIW.closedStat'])\n   assert closedStat['application']=='cons_ped_container'and closedStat['file']=='index.php'\n   (ROOT/'.runtime/ciw-completion-20261028/source13e-closed-stat.json').write_text(json.dumps(closedStat,indent=2)+'\\n',encoding='utf-8')\n"
assert text.count(old)==1;text=text.replace(old,new)
old='senha|password|passwd|banco_pass';new='senha|password|passwd|authorization|bindpass|(?<![A-Za-z])pass(?![A-Za-z])|banco_pass';assert text.count(old)==1;text=text.replace(old,new)
assert not (ROOT/spec['outputSubdirectory']).exists()
exec(compile(text,str(source),'exec'),{'__file__':str(source),'__name__':'__main__'})
