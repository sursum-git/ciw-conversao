"""Source navigation candidates only; never executes legacy PHP or closes origins."""
from pathlib import Path
import hashlib,json,re

R=Path(__file__).resolve().parents[2];S=R/'.runtime/ciw-completion-20261028'
ledger=json.loads((S/'ledger.json').read_text(encoding='utf-8-sig'))
names={e['application'] for e in ledger['entries']}
nav=re.compile(r'''SC_dir_app_name\s*\(\s*(['"])([A-Za-z_][A-Za-z0-9_]*)\1\s*\)''')
routes=re.compile(r'''(?:\.\./|/)([A-Za-z_][A-Za-z0-9_]*)/(?:index\.php|\1\.php)''')
edges=[];files=0;seen=set()
for e in ledger['entries']:
    for folder in e['sanitizedSourcePaths']:
        for p in sorted(Path(folder).glob('*.php')):
            key=(e['application'],str(p))
            if key in seen:continue
            seen.add(key);files+=1
            raw=p.read_bytes();text=raw.decode('utf-8',errors='replace')
            digest=hashlib.sha256(raw).hexdigest()
            for regex,kind in [(nav,'SC_dir_app_name literal'),(routes,'relative-route literal')]:
                for match in regex.finditer(text):
                    target=match.group(2 if regex is nav else 1)
                    if target not in names or target==e['application']:continue
                    edges.append({'caller':e['application'],'target':target,'kind':kind,
                                  'file':str(p.relative_to(R)),'line':text.count('\n',0,match.start())+1,
                                  'sha256':digest,'activeExecutionProven':False})
dedupe={(e['caller'],e['target'],e['file'],e['line'],e['kind']):e for e in edges}
edges=list(dedupe.values());targets={n:[] for n in names}
for e in edges:targets[e['target']].append(e)
triage=[]
for e in ledger['entries']:
    if e['classification']=='recorded-complete-preserve':continue
    inbound=targets[e['application']]
    triage.append({'application':e['application'],'recordedState':e['recordedState'],
                   'literalInboundCount':len(inbound),'literalCallers':sorted({x['caller'] for x in inbound}),
                   'menuLiteralCallers':sorted({x['caller'] for x in inbound if x['caller'].startswith('menu_')}),
                   'noInboundDoesNotProveUnused':True,'stateChanged':False})
out={'scope':'Static literal navigation candidates for follow-up event review',
     'ledgerSha256':hashlib.sha256((S/'ledger.json').read_bytes()).hexdigest(),'sourceFilesRead':files,
     'literalReferences':len(edges),'originsNotClosed':len(triage),'edges':edges,'triage':triage,
     'limitations':['Lexical match may be conditional, disabled or in comments; inspect the source event before treating as active.',
                    'Dynamic names/session dispatch and missing sources are not resolved. Zero literal inbound never proves unused.',
                    'Historical/alternative source names are never automatically excluded or converted.'],
     'legacyPhpExecuted':False,'inventoryChanged':False}
path=S/'navigation-literal-audit.json';path.write_text(json.dumps(out,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print(json.dumps({'sourceFilesRead':files,'literalReferences':len(edges),'notClosedWithInbound':sum(bool(x['literalInboundCount']) for x in triage),
                  'notClosedWithoutLiteralInbound':sum(not x['literalInboundCount'] for x in triage),'inventoryChanged':False}))
