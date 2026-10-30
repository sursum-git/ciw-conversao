from pathlib import Path
import json
r=Path(__file__).resolve().parents[2]
b=r/'.runtime/purchase-signals-20261027'
c=r/'integration-src/purchase-signals/metadata'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda n,v:(c/n).write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
parent=load(b/'baseline/processos-compra-med-builder-draft.json')
assert parent['programDraft']['version']=='1.0.6'
p=parent['programDraft'];p['version']='1.0.7'
p['rowLinks'].append(dict(id='alertas',label='Alertas',screenId='ciw.proc-compra-alertas',parameters=[dict(field='proc_compra_id',sourceField='proc_compra_id')],position='end'))
p['formOptions']['tabs'].append(dict(id='alertas',title='Alertas',type='linkedPage',linkedPage=dict(screenId='ciw.proc-compra-alertas',engine='crud',hideHeader=False,requireRecord=True,filters=[dict(field='proc_compra_id',sourceField='proc_compra_id',operator='eq')])))
save('processos-compra-med-builder-draft.json',parent)
base=load(r/'integration-src/purchase-allocations/metadata/proc-compra-alocacoes-builder-draft.json')
e=base['entityDraft'];e.update(code='proc_compra_alertas_progress',name='Alertas do Processo de Compra — MED',structureBaseNumber=1027,apiListOperationCode='proc_compra_alertas_read',apiDetailOperationCode='proc_compra_alertas_get')
spec=[('record_key','Chave do alerta','string',False),('sinaliz_imp_id','Regra','integer',True),('proc_compra_id','Processo','integer',False),('item_proc_compra_id','Item','integer',True),('tipo_registro','Origem','string',True),('nome_alerta','Alerta','string',True),('titulo_configurado','Título configurado','string',False),('descricao_alerta','Descrição configurada','string',False),('dias_alerta','Dias configurados','integer',True),('data_base','Data base','date',True),('data_alerta','Data do alerta','date',True),('data_consulta','Data da consulta','date',False),('cod_proc_fornec','Referência do processo','string',True),('fornecedor_id','Fornecedor','integer',False),('item_descricao','Descrição do item','string',True),('codigo_erp','Código ERP','string',True)]
fields=[]
for i,(name,label,typ,grid) in enumerate(spec):
 f=dict(code=name,label=label,dataType=typ,primaryKey=i==0,required=False,readonlyField=True,position=i*10,apiJsonPath=name,apiWritePath=name,apiShowInGrid=grid,apiShowInForm=i>0,apiShowInFilter=grid,options=dict(readonly=True,writable=False))
 if typ=='string':f['length']=2048 if name in ['record_key','descricao_alerta'] else 256
 if typ=='integer':f['options'].update(decimals=0,format='n0')
 fields.append(f)
e['fields']=fields
p=base['programDraft'];p.update(programCode='op1027',programTitle='Alertas do Processo de Compra — MED',builderEntityCode=e['code'],screenId='ciw.proc-compra-alertas',permissionPrefix=e['code'],subtitle='Empresa MED. Alertas do processo selecionado; consulta sem gravação.',version='1.0.0',contextFields=[dict(field='proc_compra_id',filter=True,createDefault=False,readonly=True,required=True)],rowLinks=[dict(id='itens',label='Itens do processo',screenId='ciw.proc-compra-itens',parameters=[dict(field='proc_compra_id',sourceField='proc_compra_id')],position='end')])
p['crudOptions']=dict(defaultSort=[dict(field='sinaliz_imp_id',dir='asc'),dict(field='item_proc_compra_id',dir='asc')],gridFields=[dict(field=n) for n,l,t,g in spec if g],filterFields=[n for n,l,t,g in spec if g])
p['formOptions']=dict(mode='popup',tabs=[dict(id='alerta',title='Alerta',sections=[dict(id='regra',title='Regra e registro',columns=2,fields=[n for n,l,t,g in spec if n!='record_key'])])])
save('proc-compra-alertas-builder-draft.json',base)
ops=[]
for mode,typ in [('read','list'),('get','detail')]:
 op=dict(code='proc_compra_alertas_'+mode,name='Alertas do processo — '+mode,type=typ,method='POST',path='/SursumPrograms/ciw-cadastros',bodyTemplate=dict(resource='proc_compra_alertas',operation=mode),requestContextFields=['proc_compra_id'])
 if mode=='read':op.update(itemsPath='data',totalPath='total')
 else:op.update(itemPath='data')
 ops.append(op)
save('api-source-additions.json',dict(sourceCode='motor_progress_ciw_cadastros',operations=ops))
s=(r/'tools/construtor-local/preview-purchase-allocations-metadata.php').read_text(encoding='utf-8')
s=s.replace('purchase-allocations','purchase-signals').replace('20261026','20261027').replace("$parent?'proc-compra-itens'","$parent?'processos-compra-med'").replace('proc-compra-alocacoes','proc-compra-alertas')
(r/'tools/construtor-local/preview-purchase-signals-metadata.php').write_text(s,encoding='utf-8')
print('PASS readonly metadata prepared; parent9to10tabs;16fields;2closed operations')
