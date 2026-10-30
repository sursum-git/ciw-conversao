"""Verificação offline e delimitada da auditoria. Não executa fontes legadas."""
from pathlib import Path
import hashlib
import json
import re
import xml.etree.ElementTree as ET

ROOT = Path(__file__).resolve().parents[3]
OUT = ROOT / '.runtime/ciw-completion-20261028/container-item-action-audit'
HERE = Path(__file__).resolve().parent
MOTOR = Path('D:/opencode/motor-progress/v2/sursum-api/programs')
BUILDER = Path('D:/opencode/construtor-pg/integrations/ciw-container-painel')
def sha(path): return hashlib.sha256(path.read_bytes()).hexdigest()
def txt(path): return path.read_bytes().decode('utf-8', errors='replace')
checks = []
def check(name, value):
    checks.append({'name': name, 'pass': bool(value)})
    assert value, name
gridpath = ROOT / 'sources/scriptcase/containers/grid_itens_container/grid_itens_container_grid.class.php'
grid = txt(gridpath)
def event(source, name):
    start = source.index('/*----- Scriptcase Locale: Event ' + name + ' ------*/')
    end = source.index('/*----- END - Scriptcase Locale: Event ' + name + ' ------*/', start)
    return source[start:end]
def blank(name):
    path = ROOT / 'sources/scriptcase/ciw-completion-next19c-20261028' / name / 'index.php'
    source = txt(path)
    start = source.index("$_SESSION['scriptcase']['" + name + "']['contr_erro'] = 'on';", source.index('function controle()'))
    end = source.index("$_SESSION['scriptcase']['" + name + "']['contr_erro'] = 'off';", start)
    return path, source[start:end]
createpath, create = blank('bl_criar_itens_container')
backpath, back = blank('bl_voltar_selecao_ped_importacao')
check('blank_create_event_reads_current_order_and_echoes', 'proc_compra_id_corrente' in create and 'echo "proc.compra:"' in create)
check('blank_create_no_active_business_sql', re.search(r'\b(insert|update|delete|select)\b', create, re.I) is None)
check('blank_back_redirects_orders_parent_without_arguments', "SC_dir_app_name('grid_procs_compra')" in back and '"","_parent"' in back)
check('blank_back_no_active_business_sql', re.search(r'\b(insert|update|delete|select)\b', back, re.I) is None)
init = event(grid, 'onScriptinit')
record = event(grid, 'onRecord')
check('grid_select_six_physical_columns', 'SELECT item_container_id, item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico, container_id from ' in grid)
check('grid_parent_scope_session', 'where (container_id = ' in grid and "$_SESSION['container_corrente']" in grid)
check('grid_default_currency_dollar', "$moeda = 'Dolar';" in init)
check('grid_current_calculation_uses_shared_legacy_call', 'calcularCustoGeralItem($containerID' in init and "'tributado'" in init)
check('grid_four_release_visibility_fields', all('NM_cmp_hidden["'+f+'"]' in init for f in ['vl_custo_real','vl_unit','vl_merc','vl_desp']))
mapping = {'tot_custo':'vl_merc_prev','vl_rat_desp':'vl_desp_prev','vl_custo_final':'vl_total_prev','vl_unitario_previsto':'vl_unit_prev','vl_merc':'vl_merc_real','vl_desp':'vl_desp_real','vl_desconto':'vl_desc_item','vl_desc_container':'vl_desc_container','vl_custo_real':'vl_total_real','vl_unit':'vl_unit_real','qt_saldo':'qt_saldo'}
check('grid_eleven_derived_field_assignments', all(re.search(r'\$this->'+k+r'\s*=\s*\$aValoresItem\[\$i\]\["'+v+r'"\]', record) for k,v in mapping.items()))
check('grid_links_maintenance_purchase_and_selection', 'link_form_itens_container' in grid and 'link_form_itens_proc_compra_edit' in grid and "SC_dir_app_name('control_selec_proc_compra')" in grid)
check('versions_named_button_has_no_action', '"SC_btn_1", ";", ";"' in grid and 'function SC_btn_1()' in grid)
maintenance = json.loads((BUILDER/'itens-1.0.1-builder-draft-candidate.json').read_bytes())
cost = json.loads((BUILDER/'custo-itens-builder-draft.json').read_bytes())
source = json.loads((BUILDER/'cost-api-source.json').read_bytes())
check('maintenance_pk_and_fixed_context', maintenance['entityDraft']['fields'][0]['code']=='item_container_id' and maintenance['programDraft']['contextFields'][0]['field']=='container_id')
check('cost_all_eleven_derived_fields_exist', set(mapping.values()) <= {f['code'] for f in cost['entityDraft']['fields']})
check('metadata_no_direct_row_navigation', cost['programDraft']['rowLinks']==[] and maintenance['programDraft']['rowLinks']==[])
# Deliberately test the observed limitation, not claim that this is the desired behavior.
check('metadata_all_cost_operations_fixed_real', len(source['operations'])==8 and all(o['bodyTemplate']['moeda']=='real' for o in source['operations']))
costservice = txt(MOTOR/'ContainersCustoReadService.p')
crud = txt(MOTOR/'ContainersItensCrudService.p')
batch = txt(MOTOR/'ContainersItensBatchService.p')
check('cost_api_supports_both_currencies', 'cCurrency<>"real" AND cCurrency<>"dolar"' in costservice)
check('cost_projection_does_not_read_release_flag', 'log_liberar_custo_realizado' not in costservice)
check('crud_closed_eleven_writable_fields', 'INITIAL "qt_alocada,qt_confirm_emb,qt_recbto_fisico,log_rec_doc_prazo_emb,observacao,cod_tipo_calculo,perc_custo,log_calc_icms,log_calc_ipi,perc_icms,perc_ipi"' in crud)
check('crud_ownership_and_integrity_guards', all(s in crud for s in ['.container_id=', 'Snapshots de custo vinculados', 'Vinculo comercial impede', 'Descontos vinculados']))
check('crud_single_balance_root_and_pending_audit', 'RUN VALUE(balancePath)' in crud and 'poResponse:Add("committed",NOT nestedValue)' in crud and 'pendingChanges' in crud)
check('batch_reuses_maintenance_and_balance', 'RUN VALUE(balancePath)' in batch and 'RUN VALUE(servicePath)' in batch and "poResponse:Add('committed',TRUE)" in batch)
receipts = [
 '.runtime/container-items-20261017/runtime-read-evidence.json',
 '.runtime/container-items-20261017/items-final-cleanup-verification.json',
 '.runtime/container-items-20261017/items-confirmed-logs.json',
 '.runtime/container-items-20261017/panel-header-publication-receipt.json',
 '.runtime/container-allocation-batch-20261026/final-verification.json',
 '.runtime/container-allocation-batch-20261026/exercise/physical-audit-reconciled.json',
 '.runtime/container-allocation-batch-20261026/published-definitions.json',
 '.runtime/container-allocation-batch-20261026/official-compile-verification.json',
 '.runtime/container-allocation-batch-20261026/publication-manifest.json',
]
cleanup=json.loads((ROOT/receipts[1]).read_bytes())
final=json.loads((ROOT/receipts[4]).read_bytes())
physical=json.loads((ROOT/receipts[5]).read_bytes())
published=json.loads((ROOT/receipts[6]).read_bytes())
check('historical_individual_cleanup_confirmed', cleanup['success'] is True and cleanup['readOnlyFinalInspection'] is True)
check('historical_batch_completed_cleaned', final['success'] is True and final['state']=='COMPLETED_CLEANED' and final['allOwnRecordsAbsent'] is True and final['logsPreserved'] is True)
check('historical_full_physical_images_reconciled', physical['success'] is True and type(physical['fullImages']) is int and physical['fullImages']==10)
check('historical_batch_native_publication_success', published['success'] is True)
junit=ET.parse(OUT/'metadata-existing.xml').getroot()
cases=list(junit.iter('testcase'))
check('real_builder_existing_metadata_test_9_271', len(cases)==9 and sum(int(c.attrib.get('assertions','0')) for c in cases)==271 and not list(junit.iter('failure')) and not list(junit.iter('error')))
paths=[gridpath,createpath,backpath,
 ROOT/'sources/scriptcase/containers/grid_itens_container/index.php',
 ROOT/'sources/scriptcase/containers/grid_itens_container/grid_itens_container_lookup.class.php',
 ROOT/'sources/scriptcase/containers/bl_chama_grid_itens_container/index.php',
 ROOT/'sources/scriptcase/containers/form_itens_container/form_itens_container_apl.php',
 ROOT/'sources/scriptcase/containers/grid_itens_proc_compra_selecao/index.php',
 ROOT/'sources/scriptcase/containers/control_selec_proc_compra/control_selec_proc_compra_apl.php',
 ROOT/'integration-src/ciw-inventory/ciw-completion-next19c-20261028-source-manifest.json']
paths += [MOTOR/n for n in ['ContainersItensCrud.p','ContainersItensCrudService.p','ContainersItensRuntime.p','ContainersItensFinanceiroService.p','ContainersItensOptionsService.p','ContainersItensBatchService.p','ContainersAllocationBalance.p','ContainersPainelReadService.p','ContainersCustoRead.p','ContainersCustoReadService.p','ContainersCustoCalculator.p','ContainersProcessosService.p']]
paths += [BUILDER/n for n in ['itens-1.0.1-builder-draft-candidate.json','itens-api-source-candidate.json','custo-itens-builder-draft.json','cost-api-source.json','custo-resumo-builder-draft.json','custo-rastro-builder-draft.json','painel-1.0.8-builder-draft-candidate.json','tests/ContainerItemsMetadataTest.php']]
paths += [Path('D:/opencode/construtor-pg/backend/src/Runtime')/n for n in ['RuntimeContainerAudit.php','RuntimeContainerAllocationAudit.php','RuntimeApiEntityActionService.php']]
paths += [ROOT/n for n in receipts]
def pin(p): return {'path':p.as_posix(),'sha256':sha(p),'bytes':p.stat().st_size}
result={'success':True,'mode':'OFFLINE_SOURCE_ACTION_AUDIT','businessWrites':0,'networkCalls':0,'inventoryWrites':0,'checks':checks,'realBuilder':{'tests':9,'assertions':271},'evidence':[pin(p) for p in paths], 'limitations':['No fresh PASOE/native export collected','Historical receipts are historical, not current runtime rcode attestation','No product changes; no full-source Converted assertion']}
OUT.mkdir(parents=True,exist_ok=True)
(OUT/'verification.json').write_text(json.dumps(result,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
print(json.dumps({'success':True,'checks':len(checks),'pinnedEvidence':len(paths),'builderTests':9,'builderAssertions':271}))
