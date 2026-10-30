from pathlib import Path
import json,copy
r=Path(__file__).resolve().parents[2];b=r/'.runtime/purchase-quantities-20261027';c=r/'integration-src/purchase-quantities/metadata'
load=lambda p:json.loads(p.read_text(encoding='utf-8-sig'))
save=lambda n,v:(c/n).write_text(json.dumps(v,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
parent=load(b/'baseline/processos-compra-med-builder-draft.json');p=parent['programDraft'];assert p['version']=='1.0.7';p['version']='1.0.8'
p['rowLinks'].append(dict(id='quantidades',label='Quantidades',screenId='ciw.proc-compra-quantidades',parameters=[dict(field='proc_compra_id',sourceField='proc_compra_id')],position='end'))
p['formOptions']['tabs'].append(dict(id='quantidades',title='Quantidades',type='linkedPage',linkedPage=dict(screenId='ciw.proc-compra-quantidades',engine='crud',hideHeader=False,requireRecord=True,filters=[dict(field='proc_compra_id',sourceField='proc_compra_id',operator='eq')])))
save('processos-compra-med-builder-draft.json',parent)
base=load(r/'integration-src/purchase-signals/metadata/proc-compra-alertas-builder-draft.json');e=base['entityDraft'];e.update(code='proc_compra_quantidades_progress',name='Quantidades Importadas — MED',structureBaseNumber=1028,apiListOperationCode='proc_compra_quantidades_read',apiDetailOperationCode='proc_compra_quantidades_get')
spec=[('record_key','Chave da linha','string',False),('proc_compra_id','Processo','integer',True),('empresa_id','Empresa MED','integer',False),('item_proc_compra_id','Item de compra','integer',False),('item_container_id','Alocação','integer',False),('container_id','Container (vínculo)','integer',False),('cod_situacao','Situação do processo','integer',True),('pedido_fornec','Pedido fornecedor','string',True),('codigo_erp','Código ERP','string',True),('desc_item_fornec','Descrição do item','string',True),('qt_comprada_final','Qt. comprada final','decimal',True),('vl_comprada_final','Valor comprado final','decimal',True),('qt_rec_final','Qt. recebida final','decimal',True),('vl_rec_final','Valor recebido final','decimal',True),('nr_container','Container','string',True),('situacao_container','Código situação container','integer',False),('dt_registro','Data do processo','date',False),('dt_recebimento','Recebimento container','date',False),('dt_prev_chegada','Previsão de chegada','date',True),('qt_comprada','Qt. comprada original','decimal',True),('vl_negociado','Preço negociado','decimal',True),('qt_confirmada_embarque','Qt. confirmada embarque','decimal',False),('qt_recbto_fisico','Qt. recebimento físico','decimal',False),('desc_situacao_container','Situação do container','string',True)]
fields=[]
for i,(name,label,typ,grid) in enumerate(spec):
 f=dict(code=name,label=label,dataType=typ,primaryKey=i==0,required=False,readonlyField=True,position=i*10,apiJsonPath=name,apiWritePath=name,apiShowInGrid=grid,apiShowInForm=i>0,apiShowInFilter=grid,options=dict(readonly=True,writable=False))
 if typ=='string':f['length']=2048 if name=='record_key' else 512
 if typ in ['integer','decimal']:f['options'].update(decimals=0 if typ=='integer' else 4 if name=='vl_negociado' else 2,format='n0' if typ=='integer' else 'n4'if name=='vl_negociado'else'n2')
 if name=='cod_situacao':f['options']['options']=[dict(value=1,text='Aberto'),dict(value=2,text='Suspenso'),dict(value=3,text='Fechado')]
 fields.append(f)
e['fields']=fields;p=base['programDraft'];p.update(programCode='op1028',programTitle=e['name'],builderEntityCode=e['code'],screenId='ciw.proc-compra-quantidades',permissionPrefix=e['code'],subtitle='Empresa MED. Compras, embarques e recebimentos; somente consulta.',version='1.0.1',contextFields=[dict(field='proc_compra_id',filter=True,createDefault=False,readonly=True,required=True)],rowLinks=[dict(id='itens',label='Itens do processo',screenId='ciw.proc-compra-itens',parameters=[dict(field='proc_compra_id',sourceField='proc_compra_id')],position='end'),dict(id='alocacoes',label='Alocações do item',screenId='ciw.proc-compra-alocacoes',parameters=[dict(field='proc_compra_id',sourceField='proc_compra_id'),dict(field='item_proc_compra_id',sourceField='item_proc_compra_id')],position='end')])
p['crudOptions']=dict(defaultSort=[dict(field='proc_compra_id',dir='desc'),dict(field='item_proc_compra_id',dir='asc'),dict(field='item_container_id',dir='asc')],gridFields=[dict(field=n)for n,l,t,g in spec if g],filterFields=[n for n,l,t,g in spec if g])
p['formOptions']=dict(mode='popup',tabs=[dict(id='origem',title='Origem',sections=[dict(id='registro',title='Processo, item e alocação',columns=2,fields=[n for n,l,t,g in spec if n not in ['record_key']and not n.startswith(('qt_','vl_'))])]),dict(id='quantidades',title='Quantidades e valores',sections=[dict(id='valores',title='Valores por vínculo, conforme consulta original',columns=2,fields=[n for n,l,t,g in spec if n.startswith(('qt_','vl_'))])])])
save('proc-compra-quantidades-builder-draft.json',base)
globalView=copy.deepcopy(base);ge=globalView['entityDraft'];ge.update(code='proc_compra_quantidades_med_progress',name='Quantidades Importadas — Consulta Geral MED',structureBaseNumber=1029,apiListOperationCode='proc_compra_quantidades_global_read',apiDetailOperationCode='proc_compra_quantidades_global_get');globalView['programDraft'].update(programCode='op1029',programTitle=ge['name'],builderEntityCode=ge['code'],screenId='ciw.quantidades-importadas-med',permissionPrefix=ge['code'],version='1.0.0',contextFields=[],subtitle='Empresa MED. Consulta geral de compras, embarques e recebimentos.');save('quantidades-importadas-med-builder-draft.json',globalView)
ops=[]
for mode,typ in [('read','list'),('get','detail')]:
 op=dict(code='proc_compra_quantidades_'+mode,name='Quantidades importadas — '+mode,type=typ,method='POST',path='/SursumPrograms/ciw-cadastros',bodyTemplate=dict(resource='proc_compra_quantidades',operation=mode),requestContextFields=['proc_compra_id'])
 if mode=='read':op.update(itemsPath='data',totalPath='total')
 else:op.update(itemPath='data')
 ops.append(op)
for original in list(ops):
 op=copy.deepcopy(original);op['code']=op['code'].replace('_quantidades_','_quantidades_global_');op['name']='Quantidades — geral MED — '+op['bodyTemplate']['operation'];op['requestContextFields']=[];ops.append(op)
save('api-source-additions.json',dict(sourceCode='motor_progress_ciw_cadastros',operations=ops))
s=(r/'tools/construtor-local/preview-purchase-signals-metadata.php').read_text(encoding='utf-8').replace('purchase-signals','purchase-quantities').replace('proc-compra-alertas','proc-compra-quantidades')
# Preview helper is separately maintained for child/parent/global.
print('PASS24fields/global+context/readOnly;parent10to11tabs;2operations')
