"""Classificacao revisavel do inventario CIW, sem executar programas de negocio."""
import collections
import datetime
import html
import importlib.util
import json
from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[2]
OUT = ROOT / 'integration-src/ciw-inventory'
PHASES = {
    0: ('Manter conversão entregue', 'Regressões das telas existentes; ações pendentes ficam em suas fases próprias.'),
    1: ('Cadastros e parâmetros', 'Converter cadastros compartilhados; permissões CIW ficaram para a última etapa por instrução de20/10.'),
    2: ('Referências ERP e câmbio', 'Consultas de fornecedores, itens, títulos, notas, representantes e cotações; serviços centrais de leitura.'),
    3: ('Pedidos de importação e alocação', 'Mestre, itens, controles, despesas do pedido, seleção e alocação em containers.'),
    4: ('Manutenção do container e fiscal', 'Cabeçalho, despesas individuais/lote, impostos e sinalização de custo desatualizado.'),
    5: ('Financeiro, descontos e contas correntes', 'Associações, créditos, rateios, saldos e estornos compensatórios.'),
    6: ('Custos, versões e distribuição', 'Concluir serviços reutilizáveis; simulação, snapshots, distribuição e fechamento transacional.'),
    7: ('Anexos e documentos', 'Transporte autenticado de arquivos, vínculo por registro e preservação do acervo legado.'),
    8: ('Amostras e desenhos', 'Cadastros especializados, envios, anexos e controles de amostras.'),
    9: ('Visões operacionais e sinalizadores', 'Painéis consolidados, planilhas, vendas e acompanhamento, após as fontes dependentes.'),
    10: ('Triagem de alternativas, históricos e testes', 'Confirmar uso e equivalência. Sem conversão ou exclusão automática dessas variantes.'),
    11: ('Permissões CIW — etapa final', 'Concluir integração e validação humana das permissões após as demais conversões; preservar os controles atuais.'),
}
DOMAIN_TASKS = {
    'Cadastros e parâmetros compartilhados': 'Converter campos, chaves, lookups e bloqueios de dependência; parâmetros IMA por include sem cache.',
    'Pedidos de importação e alocação': 'Implementar contexto do pedido, empresa/fornecedor, saldos de itens e vínculo da alocação; reler saldos ao confirmar.',
    'Containers e navegação contextual': 'Preservar container_id e retorno; separar consulta, manutenção e comandos associados.',
    'Despesas e fiscal do container': 'Integrar bases fiscais, despesas calculadas/manuais e marcação de versão desatualizada pela rotina fiscal central.',
    'Financeiro e contas correntes': 'Preservar chaves financeiras, moedas, saldo por fornecedor/item/título e estornos compensatórios; integrar auditoria.',
    'Descontos e créditos': 'Implementar motivos, valores por moeda, utilização de créditos e reversões sem duplicar regras de custo.',
    'Custos, versões e simulações': 'Preservar previsto/realizado, moedas e vínculos item/versão; reutilizar coleta, matemática e persistência de versões.',
    'Distribuição de custos': 'Usar empresa do container e serviço central; validar delta persistível, ledger e rollback do conjunto.',
    'Cotações e referências ERP': 'Criar leitura ABL tipada com contexto ERP autorizado e origem de cotação explícita; não aceitar banco/tabela do navegador.',
    'Anexos e documentos': 'Faltam bytes, upload/download autorizado e consistência do vínculo; não apagar arquivos legados compartilhados automaticamente.',
    'Amostras e desenhos': 'Converter vínculos de desenho/amostra, envio a representante e controles relacionados; conferir regras dos eventos.',
    'Visões operacionais e sinalizadores': 'Identificar os indicadores, filtros, totais e ações ativas; compor sobre APIs dos domínios já convertidos.',
}


def is_variant(name):
    return bool(re.search(r'(?:_bkp|_old|_restore)$', name, re.I) or
                name.startswith(('bl_teste', 'bl_tst_', 'blank')))


def technical_type(entry):
    name = entry['name']
    low = name.lower()
    if low.startswith(('app_login', 'ctrl_login')):
        return 'Autenticação'
    if low == 'menu' or low.startswith('menu_'):
        return 'Menu'
    if low.startswith(('ctrl_', 'contr_', 'control_')):
        return 'Controle de parâmetros/ação'
    if entry['technical_type'] == 'consulta':
        return 'Consulta/grade'
    if entry['technical_type'] == 'formulario_multi_registro' or low.endswith('_multi_reg'):
        return 'Formulário em lote'
    if entry['technical_type'] == 'formulario_ou_controle':
        return 'Formulário individual'
    if low.startswith('bl_'):
        return 'Blank: ação, serviço ou navegação'
    return 'Página especial/blank'


def family_phase(name):
    low = name.lower()
    if is_variant(name):
        return 'Alternativas históricas e testes', 10
    if low in {'grid_containers','form_containers','bl_painel_container','form_pub_pp_container','bl_pp_container','cons_ped_container'}:
        return 'Alternativas de containers a confirmar', 10
    if low.startswith(('app_login','ctrl_login')) or low in {'bl_tela_login','bl_timeout','bl_permissoes','bl_getprogusuario'}:
        return 'Identidade e permissões', 1
    if any(t in low for t in ('log_', 'logs', 'transacoes')) or low in {'bl_log_db','bl_getgerarlogusuariocorrente','ctrl_tipo_log','cons_itens_log','form_sc_log','grid_sc_log'}:
        return 'Logs e auditoria', 1
    if 'anexos' in low:
        return 'Anexos e documentos', 7
    if any(t in low for t in ('amostra','desenho','envios_repres')):
        return 'Amostras e desenhos', 8
    if low in {'grid_pub_coloracoes','form_pub_coloracoes','grid_tipos_anexo','form_tipos_anexo',
               'form_motivos_desconto','grid_motivos_desconto','cons_tipos_versao_custo','form_tipos_versao_custo',
               'grid_situacoes_container','form_situacoes_container','form_tipos_valor','grid_tipos_valor',
               'grid_despesas','form_despesas','grid_empresas','form_empresas','grid_empresas_despesa','form_empresas_despesa',
               'grid_despesas_impostos','form_despesas_impostos','grid_empresas_imposto','form_empresas_imposto',
               'form_im_param','cons_im_param'}:
        return 'Cadastros e parâmetros compartilhados', 1
    if any(t in low for t in ('cotacao','cotacoes')) or low in {'bl_atu_dolar_dia','bl_pegar_dolar','bl_getcpstbs','bl_getcotacaoems2'}:
        return 'Cotações e referências ERP', 2
    if low in {'cons_fornecedor','cons_fornecedor_estrangeiro','cons_itens','cons_representante_ativos',
               'cons_tit_ap','cons_nota_fiscal','bl_getmovtoestoqpordata','bl_sincr_cotacao'}:
        return 'Cotações e referências ERP', 2
    if low.startswith('cons_item_container_custo') or low == 'grid_itens_container_comparacao':
        return 'Custos, versões e simulações', 6
    if low == 'bl_funcoes_rateio_despesas_item':
        return 'Despesas e fiscal do container', 4
    if low in {'cons_item_qt_imp','cons_item_qt_imp_union','cons_itens_compra_alocado','form_cons_fornec_imp'}:
        return 'Pedidos de importação e alocação', 3
    if any(t in low for t in ('desconto','_desc_')) or low == 'ctrl_desc_canc_media':
        return 'Descontos e créditos', 5
    if any(t in low for t in ('cta_corren','ctacorren','ctacorrente','cta_fornec','conta_corrente','pagto','pgtos','tit_ap')):
        return 'Financeiro e contas correntes', 5
    if any(t in low for t in ('distr_custo','distribuir_custo','distr_item','saldo_inicial_distr')):
        return 'Distribuição de custos', 6
    if any(t in low for t in ('sinaliz','planilha','selec_vendas','vendas_container')) or low in {'bl_cons_controle_importacao','menu_ctrl_importacao','bl_resumo','cons_pedidos_por_item_ref_container'}:
        return 'Visões operacionais e sinalizadores', 9
    if any(t in low for t in ('proc_compra','procs_compra','ped_importacao','itens_controle','controles_proc')):
        return 'Pedidos de importação e alocação', 3
    if low in {'control_selec_proc_compra','grid_itens_proc_compra_selecao','bl_criar_itens_container','form_itens_container'}:
        return 'Pedidos de importação e alocação', 3
    if any(t in low for t in ('custo','custos','media_custo','medias_custo','rastreabilidade','resumo_container')):
        return 'Custos, versões e simulações', 6
    if any(t in low for t in ('imposto','sincripi','calcs_imp','despesas_container','selec_despesas')):
        return 'Despesas e fiscal do container', 4
    if any(t in low for t in ('container','selecao_nf','selecionado_nf','docum_est_importacao')):
        return 'Containers e navegação contextual', 4
    if low in {'bl_list','bl_processando','menu'}:
        return 'Navegação e utilitários transversais', 1
    raise ValueError('Programa sem família: ' + name)


def pattern(name, family, typ):
    low = name.lower()
    if 'históricas' in family or 'Alternativas de' in family:
        return 'Comparar com fluxo vigente; decidir reaproveitamento após confirmar uso.'
    if family == 'Identidade e permissões':
        return 'Reutilizar autenticação do construtor e resolver identidade/perfil IMA no servidor.'
    if family == 'Logs e auditoria':
        return 'Reutilizar auditoria/transações existentes; histórico legado exige contrato próprio de consulta.'
    if family == 'Anexos e documentos':
        return 'Componente declarativo de arquivo + upload/download autenticado + API de vínculo.'
    if typ == 'Menu' or low.startswith(('bl_ponte_','bl_chama_','bl_voltar_','bl_selecao_','bl_seleciona_')):
        return 'Ação declarativa de navegação/contexto; não criar tela intermediária sem necessidade.'
    if typ == 'Controle de parâmetros/ação':
        return 'Formulário de parâmetros + seleção/preview + comando explícito ProcessEngine.'
    if low.startswith('bl_'):
        return 'Extrair evento ativo para serviço ABL reutilizável; ProcessEngine para escrita e motor existente para leitura.'
    if typ == 'Consulta/grade':
        return 'CRUD de leitura por JSON/API ABL; manter filtros, totais, detalhe e contexto; separar ações de escrita.'
    if typ == 'Formulário em lote':
        return 'Grade editável batch existente + uma transação ABL + conflitos e auditoria por registro.'
    if typ == 'Formulário individual':
        return 'Formulário CRUD existente + API ABL com regras, locks, dependências e auditoria.'
    return 'Inspecionar evento de entrada e compor com os motores existentes; sem frontend paralelo.'


def main():
    remote = json.loads((OUT/'remote-inventory.json').read_text(encoding='utf-8'))
    evidence = json.loads((OUT/'builder-evidence.json').read_text(encoding='utf-8'))
    scope_path = OUT/'conversion-scope.json'
    scope_policy = json.loads(scope_path.read_text(encoding='utf-8')) if scope_path.exists() else {}
    spec = importlib.util.spec_from_file_location('local_review', Path(__file__).with_name('build-ciw-inventory-report.py'))
    previous = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(previous)
    known = {n: (f,s,p,r) for f,s,p,r,names in previous.GROUPS for n in names.split()}
    mapping = {}
    for names, screen in [
        ('grid_empresas form_empresas','ciw.empresas'),('grid_despesas form_despesas','ciw.despesas'),
        ('grid_empresas_despesa form_empresas_despesa','ciw.empresas-despesa'),('form_tipos_anexo','ciw.tipos-anexo'),
        ('grid_pp_container','ciw.containers'),('bl_ponte_painel_container menu_container form_pp_container','ciw.container-painel'),
        ('grid_itens_container','ciw.container-itens'),('grid_despesas_container','ciw.container-despesas'),
        ('form_anexos_container','ciw.container-anexos'),('cons_versoes_item_custo_container','ciw.container-versoes-custo'),
        ('cons_tit_ap_associados_container','ciw.container-pagamentos'),('cons_docum_est_importacao','ciw.container-nfs'),
        ('bl_resumo_container','ciw.container-resumo'),('grid_itens_container_comparacao','ciw.container-comparativos'),
        ('bl_rastreabilidade_dolar','ciw.container-rastro-dolar')]:
        mapping.update({n: screen for n in names.split()})
    cadastro_path = OUT/'cadastros-validation.json'
    cadastros = json.loads(cadastro_path.read_text(encoding='utf-8')) if cadastro_path.exists() else {'resources': []}
    for extra_name in ['parametros-impostos-validation.json', 'cotacoes-validation.json']:
        extra_path = OUT/extra_name
        if extra_path.exists():
            cadastros['resources'] += json.loads(extra_path.read_text(encoding='utf-8'))['resources']
    cadastro_apps = {name: row for row in cadastros['resources'] for name in row['applications']}
    mapping.update({name: row['screenId'] for name,row in cadastro_apps.items()})
    consultas_path = OUT/'fornecedores-validation.json'
    consultas = json.loads(consultas_path.read_text(encoding='utf-8'))['resources'] if consultas_path.exists() else []
    referencias_path = OUT/'referencias-validation.json'
    if referencias_path.exists():
        consultas += json.loads(referencias_path.read_text(encoding='utf-8'))['resources']
    erp_path = OUT/'erp-consultas-validation.json'
    if erp_path.exists():
        consultas += json.loads(erp_path.read_text(encoding='utf-8'))['resources']
    consulta_apps = {name: row for row in consultas for name in row['applications']}
    mapping.update({name: row['screenId'] for name,row in consulta_apps.items()})
    purchases_path = OUT/'purchase-orders-validation.json'
    purchase_apps = json.loads(purchases_path.read_text(encoding='utf-8'))['applications'] if purchases_path.exists() else {}
    mapping.update({name: row['screenId'] for name,row in purchase_apps.items()})
    screens = {p['screenId']:p for p in evidence['programs']}
    rows = []
    apps = {e['name']:e for e in remote['entries'] if e['application_candidate']}
    incoming = collections.defaultdict(set)
    for n,e in apps.items():
        for ref in e.get('application_references_candidates',[]):
            if ref in apps and ref != n:
                incoming[ref].add(n)
    for name,entry in apps.items():
        typ = technical_type(entry)
        family, phase = family_phase(name)
        state = 'Não convertido identificado'
        bucket = 'Pendente'
        remaining = pattern(name,family,typ)
        if family in DOMAIN_TASKS:
            remaining = DOMAIN_TASKS[family] + ' ' + remaining
        confidence = 'Tipo técnico por arquivos; família e sequência propostas por nome/estrutura, eventos ainda por revisar.'
        dest = mapping.get(name,'')
        if name in known:
            _,old_state,_,old_remaining = known[name]
            remaining = old_remaining
            confidence = 'Revisão funcional anterior + inventário remoto; catálogo atual consultado quando há destino.'
            if old_state == 'Convertido':
                state,bucket,phase = 'Convertido — CRUD/lote', 'Convertido',0
            elif old_state == 'Leitura convertida':
                state,bucket,phase = 'Convertido — leitura', 'Convertido',0
            elif dest:
                state,bucket = 'Parcial — leitura publicada; ações pendentes','Parcial'
            else:
                state = 'Preparado — sem fluxo publicado' if 'preparad' in old_state.lower() else 'Pendente'
                bucket = 'Preparado' if state.startswith('Preparado') else 'Pendente'
        if name == 'bl_ponte_painel_container':
            state,bucket,phase,remaining = 'Convertido — navegação','Convertido',0,'Link contextual consulta → painel entregue.'
        if name == 'bl_resumo_container':
            state,bucket,phase,remaining = 'Convertido — leitura','Convertido',0,'Resumo publicado; cálculos em serviços centrais. Processos continuam separados.'
        if name == 'menu_container':
            panel = screens.get('ciw.container-painel',{})
            remaining = 'Painel '+str(panel.get('version',''))+' com '+str(len(panel.get('tabs',[])))+' abas no catálogo; confirmar cobertura funcional das ações, manutenção e arquivos antes de declarar conversão integral.'
        if name == 'grid_itens_container':
            remaining = 'Leitura e alocação/manutenção individual ciw.container-itens1.0.1 publicadas; custos calculados em serviços centrais. Fluxos globais de pedidos e seleções em lote continuam separados.'
        if name == 'form_itens_container':
            state,bucket = 'Convertido — CRUD individual de alocação','Convertido'
            phase,dest = 0,'ciw.container-itens'
            remaining = 'CRUD publicado1.0.1, saldo/locks/fiscal/financeiro/auditoria e teste real limpo. Fluxos globais de pedidos e seleção em lote não se confundem com este formulário.'
            confidence = 'docs/painel-container-itens.md e context/RETOMADA_2026-10-16.md; catálogo atual1.0.1; publicação12.2 e teste de negócio em registros novos encerrado/limpo.'
        if name == 'form_despesas_container':
            state,bucket = 'Convertido — CRUD individual de despesa','Convertido'
            phase,dest = 0,'ciw.container-despesas'
            remaining = 'Manutenção individual publicada e testada. Edição em lote e seleção de despesas padrão continuam com análise própria.'
        if name == 'form_pp_container':
            state,bucket = 'Parcial — cabeçalho CRUD e comandos publicados','Parcial'
            remaining = 'Painel1.0.6 com cabeçalho e comandos nativos;14abas. Conferir fluxos descendentes de pagamentos/NFs/distribuição/anexos antes de declarar conversão integral do painel.'
        if name in {'grid_pub_coloracoes','form_pub_coloracoes'}:
            state,bucket = 'Parcial — API de consulta, sem tela/CRUD','Parcial'
            remaining = 'API manual de Colorações publicada; criar tela por JSON e implementar escrita quando aplicável.'
        if name in cadastro_apps:
            published = cadastro_apps[name]
            assert published['runtimeCrudValidated'] and published['auditValidated']
            if name.startswith('form_'):
                state,bucket,phase = 'Convertido — CRUD/lote e auditoria validados','Convertido',0
                remaining = 'Tela publicada pelo Builder; CRUD, conflito, rollback e limpeza comprovados no PASOE real. Conferência visual ainda pendente; integração adicional de permissões ficou para o final.'
            else:
                state,bucket = 'Parcial — consulta absorvida na tela publicada','Parcial'
                remaining = 'Campos da consulta presentes no cadastro publicado; falta conferir apresentação, filtros e navegação do legado antes de declarar equivalência integral.'
            confidence = published.get('evidence','docs/ciw-cadastros-validacao-2026-10-20.md; compilação12.2/.42,60checks/cultura,8checks/codepage; CRUD real limpo e auditoria28eventos/4cadastros; sem novos grants CIW.')
            if published.get('resource') == 'hist_cotacoes_bc':
                if name.startswith('form_'):
                    state = 'Convertido — CRUD manual e auditoria validados'
                    remaining = 'CRUD manual e limpeza validados no PASOE; serie9999/rollback somente em TTs. Conferencia visual e permissoes adicionais pendentes. Atualizacao automatica BC e processo separado.'
                else:
                    remaining = 'Consulta absorvida com oito campos, filtros e ordenacao configurados; read/get/filtro/paginacao validados por API. Processo Buscar cotacao BC publicado separadamente; conferencia visual/agrupamento legado pendentes.' if published.get('automaticBcProcessConverted') else 'Consulta absorvida com oito campos, filtros e ordenacao configurados; read/get/filtro/paginacao validados por API. Conferencia visual/agrupamento legado e botao automatico BC continuam pendentes.'
            if published.get('resource') == 'despesas_impostos':
                remaining = 'Manutenção absorvida na coleção impostos de Empresas por despesa; chave física tripla, referências e rollback validados no PASOE, testes novos removidos. Consulta global/filtros e conferência visual continuam pendentes.'
                if name.startswith('form_'):state='Convertido — manutenção absorvida e validada'
        if name == 'grid_tipos_anexo':
            state,bucket = 'Cobertura relacionada — conferir equivalência','Relacionada'
            dest = 'ciw.tipos-anexo'
            remaining = 'Entidade já convertida em grade editável; conferir campos, filtros e ações desta consulta antes de absorver.'
        if name == 'bl_atu_dolar_dia':
            bc = json.loads((OUT/'cotacoes-validation.json').read_text(encoding='utf-8')).get('automaticProcess', {}) if (OUT/'cotacoes-validation.json').exists() else {}
            if bc.get('published') and bc.get('runtimeDefinitionValidated'):
                state,bucket,dest = 'Parcial — processo BC publicado e cliente real validado','Parcial',bc['screenId']
                remaining = 'Cliente PHP consultado no BC real com TLS; gravacao automatica/auditoria validadas em TTs, sem inserir cotacao operacional para demonstracao. Conferencia visual e validacao de persistencia automatica no banco real continuam delimitadas.'
                confidence = bc['evidence']
        if name in consulta_apps:
            published = consulta_apps[name]
            assert published['runtimeReadValidated']
            state,bucket,phase = 'Convertido — consulta somente leitura validada','Convertido',0
            remaining = 'Campos e predicado legado preservados; leitura/detalhe/filtros/paginação validados no PASOE e runtime. Conferência visual pendente; permissões CIW ao final.'
            confidence = published['evidence']
            remaining = published.get('remaining', remaining)
            if published.get('contextualActionsPending'):
                state,bucket,phase = 'Parcial — consulta MED publicada; seletor contextual pendente','Parcial',2
                if published.get('purchaseContextPublished'):
                    state = 'Parcial — consulta e seletor de compra MED publicados'
        if is_variant(name):
            state,bucket,phase = 'Variante/teste — uso a confirmar','Triagem',10
            remaining = 'Revisar uso e diferenças para o fluxo atual; não converter nem excluir automaticamente.'
        elif family.startswith('Alternativas de'):
            state,bucket = 'Alternativa — uso e equivalência a confirmar','Triagem'
        if family in {'Identidade e permissões','Logs e auditoria'} and name not in known:
            state = 'Pendente — adaptar à infraestrutura existente'
        if name == 'bl_tela_login':
            state,bucket = 'Parcial — login Progress validado; autorização positiva pendente','Parcial'
            remaining = 'Login real tasilpar validado. Integração SQL e vínculo explícito tcassimiro/thiago.cassimiro publicados; faltam login humano integrado e logout. Permissões ficaram para a etapa final por instrução de20/10.'
            confidence = 'docs/integracao-ciw-autorizacao-sql-validacao.md; não confundir teste técnico PASOE com login humano no construtor.'
        if family == 'Identidade e permissões' and scope_policy.get('priority_override',{}).get('permissions_integration') == 'deferred_to_final_stage':
            phase = 11
        if name in {'form_tipos_valor','grid_tipos_valor','form_empresas_imposto','grid_empresas_imposto'}:
            remaining = 'Origem principal especw aponta a espec/111; tabelas declaradas ausentes no dicionário ABL; ODBC legado não conectou. Confirmar uso/origem sem inventar schema. Demais cadastros continuam.'
        if name in purchase_apps:
            published = purchase_apps[name]
            assert published['runtimeReadValidated'] and published['visualValidated']
            state,bucket = published['state'],published.get('stateGroup','Parcial')
            if bucket == 'Convertido':
                assert published['runtimeCrudOperationalValidated'] and published['auditValidated']
                phase = 0
            remaining,confidence = published['remaining'],published['evidence']
        if dest:
            assert dest in screens and screens[dest]['runtimeHttpStatus']==200, dest
        rows.append(dict(name=name, technical_type=typ, family=family, phase=phase,
            phase_title=PHASES[phase][0], state=state, state_group=bucket, remaining=remaining,
            target_screen=dest, target_version=screens[dest]['version'] if dest else '',
            primary_tables=entry.get('primary_tables',[]),
            references=sorted(set(entry.get('application_references_candidates',[]))&set(apps)-{name}),
            inbound_references=sorted(incoming[name]), evidence=confidence,
            source_files=entry.get('signatures',[])))
    assert len(rows)==len(apps)==len({r['name'] for r in rows})
    assert set(known)<=set(apps), 'Há fontes locais ausentes do servidor: revisar antes de concluir.'
    rows.sort(key=lambda r:(r['family'],r['technical_type'],r['phase'],r['name']))
    counts = {key:dict(collections.Counter(r[key] for r in rows)) for key in ('technical_type','family','state_group','phase')}
    report = dict(scope='CIW; IOL excluído', collected_at=remote['collected_at'],
        inventory_complete=remote['listing_complete'], functional_audit_complete=False,
        application_count=len(rows), infrastructure=[e['name'] for e in remote['entries'] if not e['application_candidate']],
        catalog_checked_at=evidence['at'], catalog_program_count=len(screens),
        note='Inventário técnico completo da raiz publicada; equivalência funcional integral dos 262 programas não foi validada. Ausência de conversão significa nenhuma evidência no catálogo/documentação analisados.',
        execution_scope=scope_policy,
        counts=counts, phases={str(k):{'title':v[0],'purpose':v[1]} for k,v in PHASES.items()}, entries=rows)
    (OUT/'inventory-reviewed.json').write_text(json.dumps(report,ensure_ascii=False,indent=2),encoding='utf-8')
    render(report,evidence)
    lines = ['INVENTÁRIO CIW — 16/10/2026',
             '262 aplicações; 263 diretórios; _lib é infraestrutura; IOL excluído.',
             report['note'], '', 'ORDEM PROPOSTA']
    for item in scope_policy.get('temporarily_deferred_menu_items',[]):
        lines.insert(3,'FORA DO ESCOPO POR ENQUANTO: '+item['label']+' — menu '+item['menu_section']+'. '+item['guard'])
    lines += [str(k)+' — '+v[0]+': '+v[1] for k,v in PHASES.items()]
    lines += ['', 'LISTA POR TIPO FUNCIONAL', 'Fase | Programa | Tipo técnico | Estado | Destino | O que falta']
    last = None
    for row in rows:
        if row['family'] != last:
            lines += ['', row['family'].upper()]
            last = row['family']
        lines.append(' | '.join(str(row[k]) for k in ('phase','name','technical_type','state','target_screen','remaining')))
    (OUT/'inventory-ciw.txt').write_text('\n'.join(lines)+'\n',encoding='utf-8')
    print(json.dumps({k:report[k] for k in ('application_count','inventory_complete','catalog_program_count','counts')},ensure_ascii=False))


def render(report,evidence):
    esc = html.escape
    data = json.dumps(report,ensure_ascii=False).replace('<','\\u003c')
    overview = ''.join('<tr><td>'+esc(k)+'</td><td>'+str(v)+'</td></tr>' for k,v in sorted(report['counts']['technical_type'].items()))
    phases = ''.join('<tr><td>'+str(k)+'</td><td>'+esc(title)+'</td><td>'+str(report['counts']['phase'].get(k,0))+'</td><td>'+esc(purpose)+'</td></tr>' for k,(title,purpose) in PHASES.items())
    runtime_rows = ''.join('<tr><td>'+esc(p['code'])+'</td><td>'+esc(p['title'])+'</td><td>'+esc(p['screenId'])+'</td><td>'+esc(p['version'] or '')+'</td><td>'+('CRUD/lote' if any(p['permissions'].get(k) for k in ('create','edit','delete')) else 'Somente leitura')+'</td></tr>' for p in evidence['programs'])
    body = '''<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Inventário CIW — 262 aplicações</title>
<style>:root{font-family:Segoe UI,system-ui,sans-serif;color:#203449;background:#f3f6fa}*{box-sizing:border-box}body{margin:0}main{max-width:1700px;margin:auto;padding:32px}h1{font-size:32px;margin:0 0 10px}h2{margin-top:32px;font-size:22px}p{line-height:1.6}.muted{color:#5d7085}.cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}.card,section{background:white;border:1px solid #dce5ee;border-radius:12px;padding:20px}.card strong{display:block;font-size:32px;color:#075985}.note{padding:16px;border-left:4px solid #0284c7;background:#e8f4fc}.filters{display:flex;gap:12px;flex-wrap:wrap;margin:16px 0}input,select,button{font:inherit;padding:10px;border:1px solid #bfcedd;border-radius:6px;background:white}input{min-width:280px;flex:1}.scroll{overflow:auto}table{border-collapse:collapse;width:100%;font-size:14px}th,td{padding:12px 10px;border-bottom:1px solid #e0e7ef;text-align:left;vertical-align:top}th{color:#3d5268;background:#edf3f8}#programs th{position:sticky;top:0}td.name{font-family:Consolas,monospace;font-size:13px;overflow-wrap:anywhere;min-width:210px}.tag{display:inline-block;padding:3px 7px;border-radius:5px;background:#e8edf4;font-size:12px}.Convertido{background:#d9f4e4;color:#125331}.Parcial,.Preparado,.Relacionada{background:#fff0c9;color:#725000}.Pendente{background:#e5effe;color:#174d9b}.Triagem{background:#eee9f4;color:#624178}details{margin-top:8px}summary{cursor:pointer;color:#276082}.group td{font-size:16px;font-weight:600;background:#e6eef6;padding-top:18px}a{color:#075985}.two{display:grid;grid-template-columns:1fr 2fr;gap:20px}@media(max-width:900px){main{padding:16px}.cards{grid-template-columns:repeat(2,1fr)}.two{grid-template-columns:1fr}}@media print{body{background:white}main{padding:0}.filters,button{display:none}section{border:0;padding:0}table{font-size:10px}th,td{padding:5px}details{display:none}.cards{display:flex;gap:20px}.card{padding:8px}.card strong{font-size:22px}}</style></head><body><main>
<p class="muted">CONVERSÃO SCRIPTCASE · CIW · 16/10/2026</p><h1>Inventário completo do CIW</h1><p>Aplicações da raiz publicada no servidor 192.168.0.170, cruzadas com o catálogo atual do construtor. IOL fora deste escopo.</p>
<div class="cards"><div class="card"><strong>262</strong>aplicações inventariadas</div><div class="card"><strong>16</strong>telas CIW no construtor</div><div class="card"><strong>0</strong>erros de coleta</div><div class="card"><strong>1</strong>diretório de infraestrutura (_lib)</div></div>
<p class="note"><b>Cobertura:</b> listagem completa dos diretórios e leitura integral dos fontes principais, com hashes. A classificação funcional dos programas novos é uma proposta baseada em estrutura e nomes. Não comprova equivalência de todos os eventos. Estados de conversão combinam revisão anterior e metadados atuais; nenhuma operação de negócio ou PHP legado foi executado.</p>
<div class="two"><section><h2>Tipos técnicos</h2><table><thead><tr><th>Tipo</th><th>Quantidade</th></tr></thead><tbody>__OVERVIEW__</tbody></table><p class="muted">Blank descreve a implementação Scriptcase: pode ser navegação, consulta, processo ou helper. A solução de conversão está indicada por programa.</p></section><section><h2>Ordem proposta de conversão</h2><table><thead><tr><th>Fase</th><th>Frente</th><th>Apps</th><th>Dependência / objetivo</th></tr></thead><tbody>__PHASES__</tbody></table></section></div>
<section style="margin-top:24px"><h2>Lista por tipo funcional e programa</h2><p>Uma linha por aplicação. Use os filtros para separar convertidos, parciais, preparados e pendentes. A fase 10 é triagem; não implica converter ou eliminar backups/testes. As fases agrupam dependências, não estimam esforço nem datas.</p>
<div class="filters"><input id="search" aria-label="Pesquisar" placeholder="Programa, tabela, pendência ou destino…"><select id="family" aria-label="Família"><option value="">Todas as famílias</option></select><select id="state" aria-label="Estado"><option value="">Todos os estados</option></select><select id="phase" aria-label="Fase"><option value="">Todas as fases</option></select><select id="sort" aria-label="Ordenação"><option value="family">Agrupar por tipo funcional</option><option value="phase">Ordenar por fase</option><option value="technical_type">Agrupar por tipo técnico</option></select><button id="print">Imprimir / salvar PDF</button></div><p id="count" class="muted"></p>
<div class="scroll"><table id="programs"><thead><tr><th>Fase</th><th>Programa / tipo técnico</th><th>Estado e destino</th><th>O que falta / como converter</th></tr></thead><tbody id="rows"></tbody></table></div></section>
<section style="margin-top:24px"><h2>Conversões presentes no catálogo atual</h2><p>16 telas não equivalem a 16 aplicações Scriptcase: consulta e formulário podem ser consolidados; algumas ações legadas foram absorvidas em navegação. Quatro telas têm escrita habilitada; doze têm leitura. Isso não representa validação de negócio executada nesta coleta.</p><div class="scroll"><table><thead><tr><th>Programa</th><th>Título</th><th>Tela</th><th>Versão</th><th>Modo</th></tr></thead><tbody>__RUNTIME__</tbody></table></div></section>
<p class="muted">Fontes de evidência: remote-inventory.json (nomes, tipos, tabelas e hashes), builder-evidence.json (catálogo/runtime), inventory-reviewed.json (classificação por programa), contextos e inventários funcionais anteriores. Referências estáticas não comprovam utilização em produção; ausência delas não comprova desuso.</p></main>
<script id="inventory-data" type="application/json">__DATA__</script><script>
const data=JSON.parse(document.getElementById('inventory-data').textContent);const byId=id=>document.getElementById(id);const escapeHtml=s=>String(s??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
for(const [id,key]of [['family','family'],['state','state_group']])for(const v of [...new Set(data.entries.map(r=>r[key]))].sort((a,b)=>a.localeCompare(b,'pt-BR'))){const o=document.createElement('option');o.value=v;o.textContent=v;byId(id).append(o)}
for(const [k,v]of Object.entries(data.phases)){const o=document.createElement('option');o.value=k;o.textContent=k+' · '+v.title;byId('phase').append(o)}
function render(){const q=byId('search').value.toLocaleLowerCase('pt-BR');const rows=data.entries.filter(r=>(!byId('family').value||r.family===byId('family').value)&&(!byId('state').value||r.state_group===byId('state').value)&&(!byId('phase').value||String(r.phase)===byId('phase').value)&&(!q||[r.name,r.family,r.technical_type,r.state,r.remaining,r.target_screen,...r.primary_tables].join(' ').toLocaleLowerCase('pt-BR').includes(q)));const key=byId('sort').value;rows.sort((a,b)=>key==='phase'?(a.phase-b.phase||a.family.localeCompare(b.family,'pt-BR')||a.name.localeCompare(b.name)):(String(a[key]).localeCompare(String(b[key]),'pt-BR')||a.phase-b.phase||a.name.localeCompare(b.name)));let last=null;const output=[];for(const r of rows){const g=key==='phase'?r.phase+' · '+r.phase_title:r[key];if(g!==last){output.push('<tr class="group"><td colspan="4">'+escapeHtml(g)+'</td></tr>');last=g}output.push('<tr><td>'+r.phase+'</td><td class="name">'+escapeHtml(r.name)+'<p class="muted">'+escapeHtml(r.technical_type)+'</p></td><td><span class="tag '+r.state_group+'">'+escapeHtml(r.state)+'</span>'+(r.target_screen?'<p>'+escapeHtml(r.target_screen)+'<br><small>Versão '+escapeHtml(r.target_version)+'</small></p>':'')+'</td><td>'+escapeHtml(r.remaining)+'<details><summary>Evidências e dependências</summary><p>'+escapeHtml(r.evidence)+'</p><p>Tabela declarada: '+escapeHtml(r.primary_tables.join(', ')||'Não identificada / não aplicável')+'</p><p>Referências de entrada (estáticas): '+escapeHtml(r.inbound_references.join(', ')||'Nenhuma identificada')+'</p><p>Destinos candidatos: '+escapeHtml(r.references.join(', ')||'Nenhum identificado')+'</p></details></td></tr>')}byId('rows').innerHTML=output.join('');byId('count').textContent=rows.length+' de '+data.application_count+' aplicações.'}
for(const id of ['search','family','state','phase','sort'])byId(id).addEventListener(id==='search'?'input':'change',render);byId('print').addEventListener('click',()=>window.print());render();
</script></body></html>'''
    for item in report.get('execution_scope',{}).get('temporarily_deferred_menu_items',[]):
        notice='<p class="note"><b>Escopo aprovado:</b> seguir a ordem, deixando por enquanto de fora '+esc(item['label'])+' (menu '+esc(item['menu_section'])+'). '+esc(item['target_resolution'])+'</p>'
        body=body.replace('<div class="two">',notice+'<div class="two">',1)
    total=len(evidence['programs'])
    writable=sum(bool(p.get('permissions',{}).get('create') or p.get('permissions',{}).get('edit') or p.get('permissions',{}).get('delete')) for p in evidence['programs'])
    body=body.replace('<strong>16</strong>telas CIW', '<strong>'+str(total)+'</strong>telas CIW')
    body=body.replace('16 telas não equivalem a 16 aplicações Scriptcase',str(total)+' telas não equivalem ao mesmo número de aplicações Scriptcase')
    body=body.replace('Quatro telas têm escrita habilitada; doze têm leitura.',str(writable)+' telas têm escrita habilitada nos metadados; '+str(total-writable)+' têm leitura.')
    body=body.replace('__OVERVIEW__',overview).replace('__PHASES__',phases).replace('__RUNTIME__',runtime_rows).replace('__DATA__',data)
    (OUT/'inventory-ciw.html').write_text(body,encoding='utf-8')


if __name__=='__main__':
    main()
