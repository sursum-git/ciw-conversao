"""Gera lista HTML/JSON do CIW e cruza inventario remoto com revisao conhecida."""
from pathlib import Path
import collections
import html
import json
import re

ROOT = Path(__file__).resolve().parents[2]
OUT = ROOT / 'integration-src/ciw-inventory'
GROUPS = [
    ('Cadastro individual', 'Convertido', 0, 'Manter; validar regressao quando a base mudar.',
     'grid_empresas form_empresas grid_despesas form_despesas grid_empresas_despesa form_empresas_despesa'),
    ('Edicao em lote', 'Convertido', 0, 'Manter o lote transacional e auditoria por registro.', 'form_tipos_anexo'),
    ('Consulta principal', 'Parcial: consulta publicada', 1, 'Consulta pronta; concluir acoes de manutencao e Vendas.', 'grid_pp_container'),
    ('Painel e navegacao', 'Parcial: painel de leitura publicado', 1, 'Concluir comandos e demais recursos; absorver pontes em navegacao contextual.',
     'bl_ponte_painel_container menu_container'),
    ('Manutencao de container', 'Parcial: leitura publicada', 2, 'Habilitar escrita somente com regras fiscais, dependencias e auditoria integradas.', 'form_pp_container'),
    ('Itens contextuais', 'Parcial: leitura publicada', 3, 'Concluir custos calculados, alocacao e manutencao de itens.', 'grid_itens_container'),
    ('Despesas contextuais', 'Parcial: leitura publicada', 2, 'Integrar manutencao e comandos proprios.', 'grid_despesas_container'),
    ('Anexos', 'Parcial: metadados publicados', 6, 'Implementar upload/download autenticado e vinculo; preservar acervo compartilhado.', 'form_anexos_container'),
    ('Versoes de custo', 'Parcial: historico publicado', 5, 'Concluir geracao, distribuicao e validacao real dos servicos.', 'cons_versoes_item_custo_container'),
    ('Financeiro contextual', 'Parcial: leitura publicada', 4, 'Concluir associacao/desassociacao e regras de rateio.', 'cons_tit_ap_associados_container cons_docum_est_importacao'),
    ('Consulta calculada', 'Leitura convertida', 0, 'Manter calculo central; processos associados continuam separados.', 'grid_itens_container_comparacao bl_rastreabilidade_dolar'),
    ('Resumo calculado', 'Preparado; tela nao publicada no checkpoint', 1, 'Concluir validacao de custos e publicar pelo Builder.', 'bl_resumo_container'),
    ('Memoria de calculo', 'Pendente', 1, 'Criar detalhe de leitura contextual usando API e componentes existentes.', 'cons_calcs_imp_container cons_despesas_container_memoria_calculo'),
    ('Manutencao de despesas', 'Servicos preparados; fluxo nao entregue', 2, 'Preservar diferencas de regras entre edicao individual e lote.', 'form_despesas_container form_despesas_container_multi_reg'),
    ('Selecao de despesas padrao', 'Pendente', 3, 'Processo explicito de selecao e aplicacao; informar substituicao de valores.', 'cons_selec_despesas'),
    ('Selecao e alocacao de itens', 'Pendente', 3, 'Pesquisa, selecao, quantidades e confirmacao com validacao dos saldos no servidor.',
     'control_selec_proc_compra grid_itens_proc_compra_selecao form_itens_container form_itens_proc_compra'),
    ('Associacao financeira', 'Pendente', 4, 'Comandos transacionais de associar/desassociar com contexto e auditoria.',
     'cons_tit_ap_associar_container cons_tit_ap_associar_container_apos_di bl_selecionado_nf'),
    ('Processo fiscal', 'Servico preparado; fluxo nao entregue', 2, 'Acao explicita ProcessEngine chamando servico fiscal central.', 'bl_sincronizar_impostos'),
    ('Geracao de versoes', 'Servicos preparados; fluxo nao entregue', 5, 'Reutilizar VersionService, coleta e calculo; resolver regressao de realizado ausente.',
     'bl_item_custos form_versoes_item_custo_container'),
    ('Simulacao e fechamento', 'Calculador e servicos preparados; fluxo nao entregue', 5, 'Simular sem escrita; reler e validar todos os itens no fechamento transacional.',
     'contr_item_custos cons_itens_container_simul_calc bl_item_custos_gravacao'),
    ('Distribuicao de custo', 'Nucleo preparado; comandos manuais pendentes', 5, 'Simular plano e executar pelo servico central usando empresa do container.',
     'ctrl_simul_distr_custo bl_distribuir_custo_contr'),
    ('Parametros', 'Pendente', 2, 'CRUD administrativo com validacao por chave; consumo pela include IMA sem cache.', 'form_im_param'),
    ('Navegacao auxiliar', 'Absorcao proposta; equivalencia nao validada', 1, 'Substituir por acoes declarativas e contexto; conferir todos os destinos.',
     'bl_chama_grid_itens_container bl_ponte_versoes_item_custo_container bl_voltar_selecao_container'),
    ('Aplicacao alternativa', 'Pendente de confirmar uso e escopo', 7, 'Conferir menus e usuarios antes de converter, unificar ou retirar.',
     'grid_containers form_containers bl_painel_container cons_pp_container_filtro_fornecedor'),
]


def main():
    if (OUT / 'remote-inventory.json').exists() and (OUT / 'builder-evidence.json').exists():
        import runpy
        runpy.run_path(str(Path(__file__).with_name('classify-ciw.py')), run_name='__main__')
        return
    known = {}
    for family, status, order, remaining, names in GROUPS:
        for name in names.split():
            assert name not in known, name
            known[name] = dict(name=name, family=family, status=status,
                               order=order, remaining=remaining,
                               evidence='Fontes locais e context/RETOMADA_2026-10-16.md; estado documental, sem nova validacao runtime.')
    local = set()
    for p in (ROOT / 'sources/scriptcase').rglob('*.php'):
        if 'iol' in p.parts or 'shared' in p.parts:
            continue
        if p.name == 'index.php' or p.name.endswith(('_apl.php', '_grid.class.php')):
            local.add(re.sub(r'(_apl|_grid.class)\.php$', '', p.name)
                      if p.parent == ROOT / 'sources/scriptcase' else p.parent.name)
    assert local == set(known), {'missing': sorted(local-set(known)), 'extra': sorted(set(known)-local)}
    remote_path = OUT / 'remote-inventory.json'
    remote = json.loads(remote_path.read_text(encoding='utf-8')) if remote_path.exists() else None
    rows = list(known.values())
    if remote:
        for entry in remote['entries']:
            if entry['application_candidate'] and entry['name'] not in known:
                rows.append(dict(name=entry['name'], family=entry['technical_type'],
                    status='Nao cruzado: revisao funcional e de conversao pendente',
                    order=8, remaining='Analisar evento ativo, tabelas e dependencias antes de ordenar.',
                    evidence='Inventario SFTP; tipo tecnico preliminar.'))
        remote_names = {e['name'] for e in remote['entries'] if e['application_candidate']}
        for row in rows:
            row['present_remote'] = row['name'] in remote_names
    rows.sort(key=lambda r: (r['order'], r['family'], r['name']))
    report = dict(scope='CIW; IOL excluido', complete=bool(remote and remote['listing_complete']),
        remote_access='coletado' if remote else 'SSH recusou autenticacao; coleta completa pendente',
        local_application_count=len(local), row_count=len(rows),
        status_basis='Conversoes documentadas; fontes preparados nao equivalem a telas publicadas.',
        entries=rows)
    OUT.mkdir(parents=True, exist_ok=True)
    (OUT / 'inventory-reviewed.json').write_text(json.dumps(report, ensure_ascii=False, indent=2), encoding='utf-8')
    esc = html.escape
    warning = ('Inventario remoto coletado; classificacoes tecnicas novas exigem revisao funcional.'
               if report['complete'] else 'INCOMPLETO: apenas 48 aplicacoes CIW com fontes locais. Falta autenticar no servidor para listar todas as aplicacoes.')
    body = ['<!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Inventario CIW</title>',
        '<style>body{font:15px system-ui;margin:32px;color:#182534}h1{font-size:26px}.notice{background:#fff2cf;padding:16px}table{border-collapse:collapse;width:100%}th,td{text-align:left;border-bottom:1px solid #ddd;padding:10px;vertical-align:top}th{background:#edf2f7;position:sticky;top:0}input{padding:10px;width:450px;margin:18px 0}small{color:#526170}</style>',
        '<h1>Inventario de conversao CIW — 16/10/2026</h1>',
        '<p class="notice">'+esc(warning)+'</p>',
        '<p>Ordem 0: manter conversao existente. Ordens 1–6: sequencia proposta. Ordem 7: alternativas a avaliar. Ordem 8: triagem funcional pendente. A prioridade de novas aplicacoes sera revista apos o inventario completo.</p>',
        '<p><small>Estado baseado nos fontes e publicacoes documentadas. Nenhum PHP legado foi executado. IOL fora deste inventario.</small></p>',
        '<label>Filtrar: <input id="q" placeholder="Programa, tipo, estado ou pendencia"></label>',
        '<table><thead><tr><th>Ordem</th><th>Tipo</th><th>Programa</th><th>Estado</th><th>O que falta / encaminhamento</th></tr></thead><tbody>']
    for r in rows:
        body.append('<tr>'+''.join('<td>'+esc(str(r[k]))+'</td>' for k in ('order','family','name','status','remaining'))+'</tr>')
    body.append('</tbody></table><script>document.getElementById("q").addEventListener("input",function(){const q=this.value.toLocaleLowerCase();document.querySelectorAll("tbody tr").forEach(r=>r.hidden=!r.textContent.toLocaleLowerCase().includes(q))})</script></html>')
    (OUT / 'inventory-ciw.html').write_text('\n'.join(body), encoding='utf-8')
    print(json.dumps({'rows':len(rows),'complete':report['complete'],'counts':dict(collections.Counter(r['status'] for r in rows))},ensure_ascii=False))


if __name__ == '__main__':
    main()
