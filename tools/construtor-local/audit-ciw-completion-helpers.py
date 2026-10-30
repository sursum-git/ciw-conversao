"""Source-only triage; never executes legacy PHP or changes the global inventory."""
import hashlib
import json
from pathlib import Path

ROOT = Path('D:/opencode/conversao-sc')
SOURCE = ROOT / 'sources/scriptcase/ciw-completion-helpers-20261028'
STATE = ROOT / '.runtime/ciw-completion-20261028'
diagnostics = {
    'bl_buscarCotacaoVendaContainer': (5278, 5281, 'Consulta de cotacao de container literal e var_dump.'),
    'bl_funcoes_rateio_despesas_item': (4924, 4930, 'Rateio/helper com container e item literais; nao e comando contextual publico.'),
    'bl_getCotacaoEms2': (5294, 5296, 'Consulta com moeda/data literais e var_dump.'),
    'bl_getCpsTbs': (4924, 4927, 'Introspeccao de campos de tabela literal e var_dump.'),
    'bl_getMovtoEstoqPorData': (4924, 4927, 'Consulta de estoque com item/data literais e var_dump.'),
    'bl_lib_container': (5294, 5297, 'Chamadas de biblioteca com container literal.'),
    'bl_pegar_dolar': (5294, 5301, 'Diagnostico de horario e busca BC com var_dump.'),
    'bl_sincrIpiItensContainer': (5294, 5296, 'Writer de IPI executado com container literal; nunca rodar como teste.'),
}
active = {
    'bl_calcular_impostos_container': {
        'lines': [5098, 5113],
        'classification': 'active-functionality-gap',
        'event': 'criarCalculoImpContainer -> calcularImpostosContainer -> gerarDespImpostoContainer -> grid_despesas_container',
        'gap': 'Comando somente tributos. Sincronizar publicado tambem executa IpiPlan; nao ha equivalencia automatica.',
        'reuse': 'ContainersImpostosService TaxPlan/PersistPlan, com operacao explicita e auditoria; nenhuma formula copiada.',
        'evidence': ['sources/scriptcase/containers/grid_despesas_container/index.php:584', 'D:/opencode/motor-progress/v2/sursum-api/programs/ContainersImpostosService.p:481'],
    },
    'bl_criar_despesas_container': {
        'lines': [5298, 5313],
        'classification': 'contextual-command-gap-current-usage-unproven',
        'event': 'criarDespesasContainer(container_corrente) -> sincronizarImpostos -> grid_despesas_container',
        'gap': 'Defaults de todos vinculos ativos nao impostos da empresa. Inbound registrado SOMENTE grid_despesas_container_bkp: provar chamador atual antes de declarar conversao ativa. Nao presumir igualdade com selecao cons_selec_despesas que tem subset e calculadas antes de impostos.',
        'reuse': 'Core de despesas e calculo fiscal centrais. Separar defaults de toda empresa da selecao, compartilhando primitivas e persistencia.',
        'evidence': ['sources/scriptcase/ciw-completion-helpers-20261028/bl_criar_despesas_container/index.php:6719', 'sources/scriptcase/ciw-completion-helpers-20261028/bl_criar_despesas_container/index.php:8274'],
    },
    'bl_sincr_cotacao': {
        'lines': [5278, 5299],
        'classification': 'active-login-flow-gap',
        'event': 'sincrCotacaoDia -> vl_dolar_hoje em sessao -> menu_ctrl_importacao',
        'gap': 'Busca apenas quando getVlCotacaoHoje retorna zero; atualizacao tambem chama atualizarCotacaoEms. cd0104 publicado e busca forcada que acrescenta observacao, nao sincronizacao automatica de login.',
        'reuse': 'Cliente BC e servico central de cotacoes publicados; provar fronteira ERP e decisao de efeito no login antes de ligar escritor automatico.',
        'evidence': ['sources/scriptcase/auth-path-20261019/ctrl_login_html/ctrl_login_html_apl.php:2265', 'sources/scriptcase/ciw-completion-helpers-20261028/bl_sincr_cotacao/index.php:5754', 'sources/scriptcase/ciw-completion-helpers-20261028/bl_sincr_cotacao/index.php:5769', 'docs/ciw-banco-central-client-2026-10-21.md:33'],
    },
}
rows = []
inventory_path = ROOT / 'integration-src/ciw-inventory/inventory-reviewed.json'
inventory = {e['name']: e for e in json.loads(inventory_path.read_text(encoding='utf-8-sig'))['entries']}
for app in sorted(set(diagnostics) | set(active)):
    path = SOURCE / app / 'index.php'
    entry = {'application': app, 'source': path.relative_to(ROOT).as_posix(), 'sourceSha256': hashlib.sha256(path.read_bytes()).hexdigest()}
    entry['recordedInboundReferences'] = inventory[app]['inbound_references']
    entry['recordedOutboundReferences'] = inventory[app]['references']
    if app in diagnostics:
        first, last, event = diagnostics[app]
        entry.update(classification='diagnostic-entrypoint-needs-usage-triage', lines=[first,last], event=event,
                     disposition='Nao converter, excluir ou executar automaticamente. Provar menu/chamador ativo e parametrizacao; biblioteca copiada nao e evento ativo.')
    else:
        entry.update(active[app])
    rows.append(entry)
out = {'success': True, 'applications': rows, 'behaviorGaps': len(active), 'activeCallerProvenGaps': 2, 'currentUsageUnprovenGaps': 1, 'diagnosticEntrypointsAwaitingUsage': len(diagnostics),
       'inventoryBaselineSha256': hashlib.sha256(inventory_path.read_bytes()).hexdigest(),
       'globalInventoryChanged': False, 'executedLegacyPhp': False, 'businessWrites': False,
       'limits': ['Referencias sao leitura estatica de fontes sanitizados; nao provam trafego em producao.', 'Nenhuma origem foi marcada Convertido por este relatorio.', 'Helpers repetidos em outras classes nao tornam os eventos equivalentes.']}
(STATE / 'helper-triage-proposal.json').write_text(json.dumps(out, indent=2, ensure_ascii=False) + '\n', encoding='utf-8')
print(json.dumps({'success': True, 'applications': len(rows), 'behaviorGaps': len(active), 'activeCallerProven': 2, 'currentUsageUnproven': 1, 'diagnosticUsageTriage': len(diagnostics), 'inventoryChanged': False}))
