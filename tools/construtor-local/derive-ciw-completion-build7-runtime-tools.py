"""Prepare build7-only inspection/publication generators; executes no remote command."""
from pathlib import Path
R=Path(__file__).resolve().parents[2]; T=R/'tools/construtor-local'
def one(value,old,new):
    assert value.count(old)==1,(old,value.count(old))
    return value.replace(old,new,1)
for kind in ['runtime','publication']:
    value=(T/f'prepare-ciw-completion-build6-{kind}.py').read_text()
    value=value.replace('official-build6-v2','official-build7').replace('ciw-completion-20261028-wave3','ciw-completion-20261028-wave4').replace('3616','4120').replace('21artifact','25artifact').replace('21runtime','25runtime').replace('21official','25official').replace('21reviewed','25reviewed').replace('21artifact','25artifact').replace('==21','==25').replace('targets=21','targets=25').replace("'targets':21","'targets':25").replace('completion-wave3-tmp','completion-wave4-tmp')
    if kind=='runtime':
        value=one(value,"rels=[x['relative']for x in proof['files']]",'''rels=[x['relative']for x in proof['files']]
assert len(set(rels))==25 and len({Path(x).name for x in rels})==25
for rel in rels:assert rel.startswith(('sursum-api/programs/','sursum-api/includes/')) and '..'not in rel
''')
        value=one(value,"rels=RELS;targets={rel:{'before':hashlib.sha256((root/rel).read_bytes()).hexdigest()if(root/rel).is_file()else None}for rel in rels}","rels=RELS\nfor rel in rels:assert not(root/rel).is_symlink() and (not(root/rel).exists()or(root/rel).is_file()),'Non-regular runtime target '+rel\ntargets={rel:{'before':hashlib.sha256((root/rel).read_bytes()).hexdigest()if(root/rel).is_file()else None}for rel in rels}")
    else:
        value=one(value,"targets={};uploads=[]",'''# The only replaced r-code files are pinned to the last actual publication.
priorReceipts={}
for folder in ['official-build5-v6','official-build6-v2']:
 receipt=load(b.parent/folder/'active-manifest.json');assert receipt['success'] and receipt.get('instance','sursum-api')=='sursum-api' and receipt.get('context','med')=='med'
 priorReceipts.update(receipt['targets'])
targets={};uploads=[]''')
        value=one(value," targets[x['relative']]=dict(file=x['file'],sha256=x['sha256'],before=prior);uploads.append(dict(local=x['source'],remote=stage+'/'+x['file']))",''' else:
  sourceRel=x['relative'][:-2]+'.p'
  sourceEntry=next(f for f in canonical['files']if f['target'].replace('\\\\','/').endswith('/'+sourceRel))
  if sourceEntry['before'] is None:assert prior is None,'New r-code already exists '+x['relative']
  else:assert prior==priorReceipts[x['relative']]['sha256'],'Prior published r-code diverged '+x['relative']
 targets[x['relative']]=dict(file=x['file'],sha256=x['sha256'],before=prior);uploads.append(dict(local=x['source'],remote=stage+'/'+x['file']))''')
        old="priority=['ContainerProcessBoundary','ContainersVersionAuxHistoryTables','ContainersVersionHistoryTable','ContainersVersionHistoryLabels','ContainersImpostosService','ContainersProcessosService','ContainersVersionHistoryService','ContainersVersionAuxHistoryService','CiwErpReadService','ContainersVersionHistoryApi','ContainersVersionAuxHistoryApi','ContainersProcessos']\norder=sorted(m['targets'],key=lambda rel:next(i for i,n in enumerate(priority)if n in rel))"
        new="""priority=['ImportDiscountsReadTables','CostDistributionEligibleTable','CostDistributionLedgerTable','ImportDiscountsCollector','CostDistributionEligibleCollector','CostDistributionLedgerCollector','ImportDiscountsReadService','CostDistributionEligibleReadService','CostDistributionLedgerReadService','ImportDiscountsReadApi','CostDistributionEligibleReadApi','CostDistributionLedgerReadApi','CiwErpReadService','CiwCadastrosCrud']
def priorityKey(rel):
 name=Path(rel).stem;assert name in priority,'Unreviewed artifact '+rel
 return(priority.index(name),{'.i':0,'.p':1,'.r':2}[Path(rel).suffix])
order=sorted(m['targets'],key=priorityKey)
assert len(order)==25 and [Path(x).stem for x in order[-2:]]==['CiwCadastrosCrud','CiwCadastrosCrud']"""
        value=one(value,old,new)
        value=one(value,"for rel,x in m['targets'].items():assert approved[rel]['sha256']==x['sha256']==sha(stage/x['file'])and sha(root/rel)==x['before'],'Hash/baseline diverged '+rel", "for rel,x in m['targets'].items():\n assert not(root/rel).is_symlink() and (not(root/rel).exists()or(root/rel).is_file()),'Non-regular target '+rel\n assert approved[rel]['sha256']==x['sha256']==sha(stage/x['file'])and sha(root/rel)==x['before'],'Hash/baseline diverged '+rel")
    (T/f'prepare-ciw-completion-build7-{kind}.py').write_text(value,encoding='utf-8')
print('Prepared build7-only generators. Run inspection generator first; publication generator requires fresh runtime-before receipt.')
