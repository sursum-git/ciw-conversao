"""Describe source availability without claiming functional parity or executing PHP."""
from pathlib import Path
import json,hashlib,re
R=Path('D:/opencode/conversao-sc'); S=R/'.runtime/ciw-completion-20261028'
ledger=json.loads((S/'ledger.json').read_text(encoding='utf-8-sig'))
rows=[]
for entry in ledger['entries']:
    if entry['classification']=='recorded-complete-preserve': continue
    files=sorted({p for folder in entry['sanitizedSourcePaths'] for p in Path(folder).glob('*.php')})
    substantive=[]; wrappers=[]
    for path in files:
        raw=path.read_bytes(); value=raw.decode('utf-8',errors='replace').strip()
        wrapper=bool(re.fullmatch(r'<\?php\s+include_once\s*\([^;]+\);\s*\?>',value,re.S))
        (wrappers if wrapper else substantive).append({'path':str(path.relative_to(R)),'sha256':hashlib.sha256(raw).hexdigest()})
    status='none' if not files else 'wrapper-only' if not substantive else 'substantive-source-present'
    rows.append({'application':entry['application'],'status':status,'substantive':substantive,'wrappers':wrappers})
counts={status:sum(r['status']==status for r in rows) for status in ['none','wrapper-only','substantive-source-present']}
out={'success':True,'ledgerSha256':hashlib.sha256((S/'ledger.json').read_bytes()).hexdigest(),'originsNotClosed':len(rows),'counts':counts,'limitations':['Substantive source presence does not prove completeness, active usage, event fidelity or API parity.','Wrapper-only means the local PHP contains only an include; its referenced implementation must be obtained or its absence explained.'],'entries':rows,'executedPhp':False,'inventoryChanged':False}
(S/'source-coverage.json').write_text(json.dumps(out,indent=2,ensure_ascii=False)+'\n',encoding='utf-8')
print(json.dumps({'counts':counts,'wrapperOnly':[r['application'] for r in rows if r['status']=='wrapper-only']},ensure_ascii=False))
