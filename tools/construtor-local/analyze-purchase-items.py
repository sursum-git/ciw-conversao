"""Extrai apenas rótulos, regras de campos e opções das cópias de análise."""
from pathlib import Path
import json,re
root=Path(__file__).resolve().parents[2]
src=root/'sources/scriptcase/purchase-items/form_itens_proc_compra'
apl=(src/'form_itens_proc_compra_apl.php').read_text(encoding='utf-8')
form=(src/'form_itens_proc_compra_form0.php').read_text(encoding='utf-8')
schema=json.loads((root/'integration-src/container-panel/schema/schema-itens_proc_compra.json').read_text(encoding='utf-8'))
labels=dict(re.findall(r"\$this->nm_new_label\['([^']+)'\]\s*=\s*\"([^\"]*)\"",form))
rules={}
for f in schema['fields']:
 n=f['name'];m=re.search(r'function ValidateField_'+re.escape(n)+r'\(.*?(?=\n\s*(?:function|} // ValidateField))',apl,re.S)
 text=m.group(0) if m else ''
 mx=re.search(r'NM_utf8_strlen\(\$this->'+re.escape(n)+r'\)\s*>\s*(\d+)',text)
 rules[n]={'label':labels.get(n,n),'required':bool(re.search(r'\$this->'+re.escape(n)+r'\s*==\s*""',text)),'maxLength':int(mx.group(1)) if mx else None}
options={}
for m in re.finditer(r'function Form_lookup_([A-Za-z0-9_]+)\(\)\s*\{(.*?)(?=\n\s*function |\Z)',apl,re.S):
 vals=re.findall(r'\$nmgp_def_dados\s*\.=\s*"([^"?]*)\?#\?([^"?]*)\?#\?([^"?]*)\?@\?"',m.group(2))
 if vals:options[m.group(1)]=[{'value':v,'text':t,'selected':selected=='S'} for t,v,selected in vals]
for m in re.finditer(r'<select[^>]*name=\\?"([^"\\]+)\\?"[^>]*>',form):
 section=form[m.end():];section=section[:section.find('</select>')]
 vals=re.findall(r'<option\s+value=[\\"\s]*([^"\\>\s]*).*?>([^<]*)</option>',section,re.S)
 if vals:options[m.group(1)]=[{'value':v,'text':t.strip()} for v,t in vals if '<?' not in t]
queries=sorted(set(re.findall(r'(SELECT[^"\n]{0,260}FROM PUB\.[^"\n]{0,160})',form,re.I)))
result={'fields':rules,'staticOptions':options,'lookupQueries':queries,'physicalFields':len(schema['fields']),'analysisOnly':True}
out=root/'integration-src/purchase-items/scriptcase-fields.json';out.write_text(json.dumps(result,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print(json.dumps(result,ensure_ascii=False))
