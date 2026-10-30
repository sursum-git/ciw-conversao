from pathlib import Path
import json,hashlib,shutil,re,difflib
root=Path(__file__).resolve().parents[1];w=root.parents[2];repo=Path('D:/opencode/construtor-pg');state=w/'.runtime/ciw-completion-20261028/native-process-dependent-options-example';stage=state/'stage';stage.mkdir(parents=True,exist_ok=True)
sha=lambda p:hashlib.sha256(p.read_bytes()).hexdigest()
selection=w/'.runtime/ciw-completion-20261028/container-expense-default-selection/frozen-v1.2-test-inputs'
raw=json.loads((w/'.runtime/ciw-completion-20261028/container-expense-default-selection/native-preview.json').read_text(encoding='utf-8-sig'))
raw['screenId']='demo.process-dependent-options';raw['program'].update({'id':'demo-process-dependent-options','entity':'demo_dependent_options','title':'Prioridades fictícias','subtitle':'Exemplo local; nenhuma regra comercial é executada.','permission':'read'});raw['permissions']={'read':True,'process':True}
raw['dataSource']['api']={'process':{'endpointId':'process','method':'POST'},'options.despesa_ids':{'endpointId':'options.despesa_ids','method':'POST'}}
raw['process']['actions']['process']['confirmation']={'message':'Confirmar a seleção somente nesta demonstração local?','confirmText':'Confirmar exemplo'}
raw['process']['actions']['process']['label']='Confirmar exemplo'
def trim(value):
 if isinstance(value,dict):return {k:trim(v)for k,v in value.items()if k!='technicalProperties'}
 if isinstance(value,list):return [trim(v)for v in value]
 return value
raw=trim(raw)
out=root/'candidates';(out/'src/examples').mkdir(parents=True,exist_ok=True)
(out/'examples/processamento-opcoes-dependentes.process.json').write_text(json.dumps(raw,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
template=(root/'tests/example-template.js').read_text(encoding='utf-8');assert template.count('/* STATIC_DEFINITION */')==1
(out/'src/examples/process-dependent-options-example.js').write_text(template.replace('/* STATIC_DEFINITION */',json.dumps(raw,ensure_ascii=False,separators=(',',':'))),encoding='utf-8')
for p in out.rglob('*'):
 if p.is_file():dest=stage/p.relative_to(out);dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(p,dest)
html=(out/'examples/pages/processamento-opcoes-dependentes.html').read_text(encoding='utf-8')
assets=re.findall(r'(?:src|href)="../../([^"#]+)"',html)
for name in assets:
 if name.startswith('src/examples/'):continue
 origin=selection/'native'/name
 if not origin.exists():origin=repo/name
 dest=stage/name;dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(origin,dest)
# Copy only explicitly referenced local CSS dependencies. No network nor server needed.
queue=[stage/name for name in assets if name.endswith('.css')];seen=set()
while queue:
 p=queue.pop()
 if p in seen:continue
 seen.add(p)
 for match in re.findall(r'url\([\'\"]?([^\)\'\"]+)',p.read_text(encoding='utf-8-sig')):
  if match.startswith(('data:','http:','https:','#')):continue
  dest=(p.parent/match.split('?',1)[0].split('#',1)[0]).resolve()
  if not dest.is_relative_to(stage.resolve()):continue
  origin=repo/dest.relative_to(stage.resolve())
  if origin.is_file():dest.parent.mkdir(parents=True,exist_ok=True);shutil.copy2(origin,dest)
  if dest.suffix=='.css'and dest.exists():queue.append(dest)
plans=[];patches=root/'patches';patches.mkdir(exist_ok=True)
p=repo/'src/examples/examples-catalog.js';before=p.read_text(encoding='utf-8-sig');anchor='      id: "processamento-parametros",';assert before.count(anchor)==1
old='    {\n'+anchor;new='''    {
      id: "processamento-opcoes-dependentes",
      category: "Processamento",
      title: "Opções dependentes de parâmetros",
      summary: "Dois enums fechados recarregam a seleção; contexto protegido, resposta antiga descartada e confirmação nativa.",
      page: pagePath + "processamento-opcoes-dependentes.html"
    },
'''+old;assert before.count(old)==1;after=before.replace(old,new)
physical=p.read_bytes();newline=b'\r\n'if b'\r\n'in physical else b'\n';oldbytes=old.encode().replace(b'\n',newline);assert physical.count(oldbytes)==1;position=physical.index(oldbytes);insert=new[:-len(old)].encode().replace(b'\n',newline)
dest=state/'catalog-preview.js';dest.write_bytes(physical[:position]+insert+physical[position:]);(patches/'examples-catalog.js.patch').write_text(''.join(difflib.unified_diff(before.splitlines(True),after.splitlines(True),fromfile=p.as_posix(),tofile=p.as_posix())),encoding='utf-8')
plans.append({'target':p.as_posix(),'baselineSha256':sha(p),'candidatePath':dest.as_posix(),'candidateSha256':sha(dest),'kind':'byteInsertion','encoding':'utf8-preserved','insertAtByte':position,'insertHex':insert.hex(),'oldContentUnchanged':True,'changes':[{'old':old,'new':new}]})
p=repo/'docs/paridade-demo-producao.md';before=p.read_bytes();anchor=b'| --- | --- | --- | --- | --- | --- | --- |';assert before.count(anchor)==1
position=before.index(b'\n',before.index(anchor))+1
line='| 2026-10-28 | Processo com opções dependentes opt-in | examples/pages/processamento-opcoes-dependentes.html, examples/processamento-opcoes-dependentes.process.json, src/examples/process-dependent-options-example.js | Mesmo ProcessEngine, Builder e schemas1047; produção por screenId/endpointId, sem cliente fictício | pendente | Revisar/integrar extensão process-only1047 e este exemplo; preservar autenticação/permissões reais | Dois enums fechados, contexto obrigatório readonly, geração assíncrona e confirmação nativa. Sem flag, contratos legados preservados. Skill ausente após busca; checklist da matriz aplicado diretamente. |\r\n'.encode('cp1252')
after=before[:position]+line+before[position:];dest=state/'paridade-demo-producao-preview.md';dest.write_bytes(after)
plans.append({'target':p.as_posix(),'baselineSha256':sha(p),'candidatePath':dest.as_posix(),'candidateSha256':sha(dest),'kind':'byteInsertion','encoding':'cp1252-preserved','insertAtByte':position,'insertHex':line.hex(),'oldContentUnchanged':True})
(patches/'patch-plan.json').write_text(json.dumps({'textAndBytePatches':plans},indent=2)+'\n',encoding='utf-8')
(state/'asset-manifest.json').write_text(json.dumps([{'path':p.relative_to(stage).as_posix(),'sha256':sha(p)}for p in sorted(stage.rglob('*'))if p.is_file()],indent=2)+'\n',encoding='utf-8')
print('PASS separate example staged; two exact patches, no canonical changes')
