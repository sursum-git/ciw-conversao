from pathlib import Path
import json,hashlib,copy
D=Path(__file__).resolve().parent
W=D.parents[2]
F=W/'.runtime/ciw-completion-20261028/container-item-action-native/current'
assert hashlib.sha256((F/'export-proof.json').read_bytes()).hexdigest()=='d4f647a3d11cbd2e35f1dcda1555e8b57bffd175d48ceb362ce9efb1affab1ee'
proof=json.loads((F/'export-proof.json').read_text())
for item in proof['files']:assert hashlib.sha256(Path(item['path']).read_bytes()).hexdigest()==item['sha256']
def link(id,label,screen,pairs):return{'id':id,'label':label,'screenId':screen,'parameters':[{'field':a,'sourceField':b}for a,b in pairs],'position':'start'}
order=link('item_pedido','Item do pedido','ciw.proc-compra-itens',[('proc_compra_id','proc_compra_id'),('item_proc_compra_id','item_proc_compra_id')])
maintenance=link('manutencao_item','Manutenção da alocação','ciw.container-itens',[('container_id','container_id'),('item_container_id','item_container_id')])
for code,entity,version,optional,links in [
 ('op1008','container_custo_itens_progress','1.0.1',None,[order,maintenance]),
 ('op1002','container_itens_progress','1.0.2','item_container_id',[order]),
 ('op1014','proc_compra_itens_progress','1.0.5','item_proc_compra_id',[]),
]:
 dto=json.loads((F/(code+'-program.json')).read_text(encoding='utf-8'));published=[v for v in dto['versions']if v['status']=='published'];assert len(published)==1
 before=published[0]['builderConfig'];after=copy.deepcopy(before);after['version']=version
 assert all(x['id']not in {row['id']for row in after.get('rowLinks',[])}for x in links)
 after['rowLinks']=[*after.get('rowLinks',[]),*copy.deepcopy(links)]
 if optional:
  assert not any(c['field']==optional for c in after['contextFields'])
  after['contextFields'].append({'field':optional,'filter':True,'createDefault':False,'readonly':True,'required':False,'filterOnly':True})
 after['changeSummary']='Navegação contextual para o item exato, sem encaminhar a seleção ao contexto externo; ações e permissões nativas preservadas.'
 entitydto=json.loads((F/(entity+'-entity.json')).read_text(encoding='utf-8'))['entity']
 for name,config in [('before',before),('candidate',after)]:
  out=D/'metadata'/name;out.mkdir(parents=True,exist_ok=True)
  (out/(code+'-program-draft.json')).write_text(json.dumps(config,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
  (out/(code+'-external-test-input.json')).write_text(json.dumps({'entityDraft':entitydto,'programDraft':config},ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print('Three current program deltas prepared; source/entity catalogs unchanged')
