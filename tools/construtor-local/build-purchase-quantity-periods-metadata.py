from pathlib import Path
import copy, json
r=Path(__file__).resolve().parents[2];c=r/'integration-src/purchase-quantity-periods/metadata';c.mkdir(parents=True,exist_ok=True)
d=json.loads((r/'integration-src/purchase-quantities/metadata/quantidades-importadas-med-builder-draft.json').read_text(encoding='utf-8'))
projection='cod_situacao,pedido_fornec,vl_negociado,qt_comprada,qt_confirmada_embarque,qt_recbto_fisico,qt_rec_final,vl_rec_final,qt_comprada_final,vl_comprada_final,nr_container,situacao_container,dt_registro,dt_recebimento,dt_prev_chegada,codigo_erp,desc_item_fornec'.split(',')
keep=['record_key','row_key','empresa_id']+projection+['desc_situacao_container']
fields={f['code']:f for f in d['entityDraft']['fields']}
fields['row_key']=copy.deepcopy(fields['record_key']);fields['row_key'].update(code='row_key',label='Identidade da projeção',primaryKey=False,length=64,apiJsonPath='row_key',apiWritePath='row_key')
for i,n in enumerate(keep):
 f=fields[n];f['position']=i*10;f['apiShowInFilter']=n not in ['record_key','row_key','empresa_id'];f['apiShowInForm']=n not in ['record_key','row_key'];f['apiShowInGrid']=n not in ['record_key','row_key','empresa_id','situacao_container','qt_confirmada_embarque','qt_recbto_fisico'];f['primaryKey']=n=='record_key'
e=d['entityDraft'];e.update(code='proc_compra_quantidades_periodo_med_progress',name='Quantidades Importadas por Período — MED',structureBaseNumber=1030,apiListOperationCode='proc_compra_quantidades_periodo_read',apiDetailOperationCode='proc_compra_quantidades_periodo_get',fields=[fields[n]for n in keep])
p=d['programDraft'];p.update(programCode='op1030',screenId='ciw.quantidades-importadas-periodo-med',builderEntityCode=e['code'],permissionPrefix=e['code'],programTitle=e['name'],subtitle='MED. Regra de períodos original do Scriptcase. Para datas, use Igual ou Entre.',version='1.0.0',contextFields=[],rowLinks=[])
p['crudOptions'].update(defaultSort=[dict(field='pedido_fornec',dir='asc'),dict(field='codigo_erp',dir='asc')],gridFields=[dict(field=n)for n in keep if fields[n]['apiShowInGrid']],filterFields=['dt_registro','dt_recebimento','dt_prev_chegada','pedido_fornec','codigo_erp','desc_item_fornec','nr_container','cod_situacao'])
p['formOptions']['tabs'][0]['sections'][0].update(title='Projeção da consulta original — MED',fields=[n for n in keep if fields[n]['apiShowInForm']and not n.startswith(('qt_','vl_'))])
p['formOptions']['tabs'][1]['sections'][0].update(title='Quantidades e valores — linhas distintas da consulta original',fields=[n for n in keep if n.startswith(('qt_','vl_'))])
(c/'quantidades-importadas-periodo-med-builder-draft.json').write_text(json.dumps(d,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
ops=[]
for op,typ in [('read','list'),('get','detail')]:
 value=dict(code='proc_compra_quantidades_periodo_'+op,name='Quantidades por período MED — '+op,type=typ,method='POST',path='/SursumPrograms/ciw-cadastros',bodyTemplate=dict(resource='proc_compra_quantidades_periodo_med',operation=op),requestContextFields=[])
 value.update(dict(itemsPath='data',totalPath='total')if op=='read'else dict(itemPath='data'));ops.append(value)
(c/'api-source-additions.json').write_text(json.dumps(dict(sourceCode='motor_progress_ciw_cadastros',operations=ops),ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print('PASS candidate',len(keep),'fields,17originalprojection fields,2read/get operations,3datefilters,no physical record links')
