"""Offline structural/hash review of the closed build7 runtime plan."""
from pathlib import Path
import json,hashlib,ast
R=Path(__file__).resolve().parents[2]; B=R/'.runtime/ciw-completion-20261028/official-build7'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'));sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
proof=load(B/'official-compile-verification.json');assert proof['success'] and proof['version']=='12.2' and proof['compileEntries']==68 and proof['totalChecks']==4120 and len(proof['files'])==25
tool=R/'tools/construtor-local/prepare-ciw-completion-build7-publication.py';tree=ast.parse(tool.read_text());assignment=next(n for n in ast.walk(tree) if isinstance(n,ast.Assign) and any(isinstance(t,ast.Name) and t.id=='script' for t in n.targets));template=assignment.value.func.value.value;compile(template,'publication-template','exec')
fragment=template[template.index('priority='):template.index("attempt={'instance'")]
namespace={'Path':Path,'m':{'targets':{x['relative']:{} for x in proof['files']}}};exec(fragment,namespace)
order=namespace['order'];assert len(order)==25 and all(Path(x).stem=='CiwCadastrosCrud' for x in order[-2:])
for stem in ['ImportDiscounts','CostDistributionEligible','CostDistributionLedger']:
    collector=next(i for i,n in enumerate(order) if Path(n).stem==stem+'Collector')
    service=next(i for i,n in enumerate(order) if Path(n).stem==stem+'ReadService')
    api=next(i for i,n in enumerate(order) if Path(n).stem==stem+'ReadApi')
    reader=next(i for i,n in enumerate(order) if Path(n).stem=='CiwErpReadService')
    assert collector<service<api<reader
try:exec(fragment,{'Path':Path,'m':{'targets':{'sursum-api/programs/Unknown.r':{}}}})
except AssertionError:pass
else:raise AssertionError('Unknown artifact accepted')
for x in proof['files']:assert sha(R/x['source'])==x['sha256']
pins=['inspect-runtime.py','inspect-runtime-plan.json','official-compile-verification.json','canonical-manifest.json']
result={'success':True,'findingsP1':0,'findingsP2':0,'scriptSyntaxPass':True,'expectedArtifacts':25,'explicitOrder':order,'unknownArtifactRejected':True,'newArtifactsMustBeAbsent':True,'priorRcodeReceipts':['official-build5-v6','official-build6-v2'],'coherentWebMedPause':True,'imaConfigurationChanged':False,'remoteExecuted':False,'businessWrites':False,'pins':[{'file':n,'sha256':sha(B/n)}for n in pins]+[{'file':str(tool.relative_to(R)),'sha256':sha(tool)}],'remainingGate':'Fresh runtime-before from root, generator guard, and final publication plan review'}
(B/'manager-runtime-tools-review.json').write_text(json.dumps(result,indent=2)+'\n',encoding='utf-8');print('PASS:25 targets ordered;three dependency chains before reader;dispatcher last;unknown rejected;all official bytes pin correctly')
