"""Snapshot legível da fila; não promove estados nem modifica o inventário."""
from pathlib import Path
import datetime
import hashlib
import json
import unicodedata

ROOT = Path(__file__).resolve().parents[2]
STATE = ROOT / '.runtime/ciw-completion-20261028'
OUT = ROOT / 'integration-src/ciw-completion-20261028/remaining-applications'
OUT.mkdir(parents=True, exist_ok=True)
read = lambda p: json.loads(p.read_text(encoding='utf-8-sig'))
sha = lambda p: hashlib.sha256(p.read_bytes()).hexdigest()
ledger = read(STATE / 'ledger.json')
entries = [e for e in ledger['entries'] if e['classification'] != 'recorded-complete-preserve']
assert len(entries) == 200 and ledger['applicationCount'] == 262

exercise_path = STATE / 'batch1042-exercise/state.json'
batch_status = 'cenário novo2147000110 autorizado e ainda não executado'
batch_steps = []
if exercise_path.exists():
    exercise = read(exercise_path)
    batch_steps = exercise.get('steps', [])
    if exercise.get('completed') is True and batch_steps[-1:] == ['verify-cleanup']:
        batch_status = 'cenário novo2147000110 executado pelo root, com verificação final de limpeza concluída e logs preservados'
    else:
        batch_status = f'cenário novo2147000110 em execução exclusiva pelo root, com {len(batch_steps)} etapas confirmadas; limpeza canônica obrigatória ainda pendente'

comparison_status = 'Comparações1040/41 candidatas revisadas com metadadosSQL reais absorvidos; oficial13-v2 parou antes da primeira compilação por cópias duplicadas de classes no staging. Companion13-v3 corrige somente o harness; API/telas dessas comparações ainda não publicadas.'
comparison_proof = STATE / 'build13-root-companions-v3/official-compile-verification.json'
comparison_canonical = STATE / 'build13-root-companions-v3/canonical-manifest.json'
if comparison_proof.exists() and comparison_canonical.exists():
    cp, cc = read(comparison_proof), read(comparison_canonical)
    if cp.get('success') is True and cp.get('compileCount') == 69 and cp.get('totalChecks') == 8020 and cc.get('success') is True and len(cc.get('files', [])) == 12:
        comparison_status = 'Comparações1040/41 compiladas oficialmente13-v3:69compilações/8.020checks TT semDB e12fontes canônicas integradas pelo root. Publicação runtime e metadados ainda não concluídos; companionruntime13-v4 em revisão. Nenhuma tela dessas comparações é declarada publicada nesta etapa.'
        active_path = STATE / 'runtime-build13-v4/active-manifest.json'
        pasoe_path = STATE / 'runtime-build13-v4/pasoe-read-proof.json'
        if active_path.exists() and pasoe_path.exists():
            ca, cr = read(active_path), read(pasoe_path)
            if ca.get('success') is True and len(ca.get('targets', {})) == 17 and cr.get('success') is True and cr.get('checks') == 87:
                comparison_status = 'Comparações1040/41:69compilações/8.020checks TT oficiais,12fontes canônicas e17artefatos runtime publicados. PASOE87checks aprovados nas duas moedas para consulta/detalhe/filtros/requisições de página; ambos os conjuntos observados tinham total1, portanto segunda página não-vazia ainda NÃO comprovada. Metadados/telas e acesso humano ainda pendentes. Exportação/impressão legadas também não estão cobertas por essa fatia somente leitura; não declarar equivalência integral nem promover as origens.'
                two_rows = STATE / 'build13-two-row-pagination/proof.json'
                if two_rows.exists():
                    paging = read(two_rows)
                    if paging.get('success') is True and paging.get('state') == 'PROVED' and paging.get('nonemptySecondPage') is True and paging.get('calls') == 8:
                        comparison_status = 'Comparações1040/41:69compilações/8.020checks TT oficiais,12fontes canônicas e17artefatos runtime publicados. PASOE87checks aprovados nas duas moedas; suplemento separado de8chamadas comprovou segunda página real com take1/total2 e GET da segunda linha, sem alegar conjunto acima de200. Metadados/telas e acesso humano ainda pendentes. Exportação/impressão legadas permanecem lacunas; não declarar equivalência integral nem promover as origens.'
                metadata_path = STATE / 'build13-metadata-publication-preparation/metadata-publication.json'
                if metadata_path.exists():
                    metadata = read(metadata_path)
                    if metadata.get('success') is True and metadata.get('cadastrosOperations') == 150 and len(metadata.get('published', [])) == 3:
                        comparison_status = comparison_status.replace('Metadados/telas e acesso humano ainda pendentes.', 'Duas telas1040/1041v1.0.0 e pai1005v1.0.3 já publicados87385, recibo3378023e…, fonte150preservando146/auth; validação nativa após publicação e acesso humano ainda pendentes.')
                        native_path = STATE / 'build13-native-metadata-verification/runtime-read-proof.json'
                        if native_path.exists():
                            native = read(native_path)
                            if native.get('success') is True and native.get('metadataPublicationSha256') == sha(metadata_path) and len(native.get('results', [])) == 2:
                                comparison_status = comparison_status.replace('validação nativa após publicação e acesso humano ainda pendentes.', 'validação nativa real concluída em17chamadas funcionais:duas telas/read/get/filtro decimal observado/contexto e segunda página total2; acesso humano ainda não concedido, sem prova visualLDAP.')

def plain(text):
    return unicodedata.normalize('NFKD', text).encode('ascii', 'ignore').decode().lower()

# Cada quantidade é de origens não encerradas, não de telas sem implementação.
notes = {
    'cadastros e parametros compartilhados': ('grid_despesas_impostos, grid_empresas_imposto, grid_tipos_valor', '1055 tela1.0.0 publicada, fonte146 preservando144; consulta/get/PK3/paginação/filtros nativos validados. API oficial7compiles/384checks e17checksPASOE; acesso humano1055 ainda não solicitado. Cinco consultas/filtros anteriores publicados. TiposValor/Empresas×Imposto têm origem física ainda não resolvida no perfil observado.'),
    'custos, versoes e simulacoes': ('cons_item_container_custos_comparacao_real, cons_item_container_custos_comparacao_dolar, form_item_custos_manual, form_item_custos', comparison_status+' Filtros decimais Builder205 já integrados. Histórico e quatro consultas filhas publicados; as quatro leituras AUX foram aplicadas/verificadas. Manual1051 só leitura. Demais formulários/médias exigem confronto próprio.'),
    'containers e navegacao contextual': ('bl_selecao_nf, bl_selecionado_nf, cons_docum_est_importacao, cons_pp_it_container', '1053 API e tela1.0.0 publicadas:42 compilações oficiais,5.704checks TT e43checks PASOE em cinco containers, incluindo conjuntos acima de200. Runtime nativo26checks em cinco contextos aprovou consulta/detalhe/filtro/paginação. Fonte financeira6 preserva4operações e auth; pai1000v1.0.3 tem sóversão/link. Acesso humano1053 ainda não concedido. Associação/desassociação e demais pontes continuam separadas.'),
    'despesas e fiscal do container': ('form_despesas_container_multi_reg, cons_selec_despesas, bl_calcular_impostos_container, bl_criar_despesas_container', 'Fiscal/memória e processos1043/1047 publicados, sem run operacional desses processos. 1042 API/tela publicadas e três acessos aprovados já aplicados/verificados; '+batch_status+'. ALL1044 depende de uso real.'),
    'descontos e creditos': ('cons_descontos_importacao, cons_desc_geral_fornec, form_descontos_importacao, form_cta_corren_desconto, ctrl_desc_canc_media', 'Consultas1045/1046 publicadas; acesso aplicado e verificado pelo root. Manutenção, estorno/cancelamento e outras consultas não estão encerrados por essa entrega.'),
    'distribuicao de custos': ('cons_distr_custo_geracao_saldo, grid_despesas_container_distr_custo, bl_distr_custo, bl_saldo_inicial_distr_custo', 'Consulta1049 e extrato por item1050 publicados. Extrato geral1048 ainda exige absorver UNION/NULL/ordem/identidade legadas; geração/movimentação e próprios formulários permanecem separados.'),
    'financeiro e contas correntes': ('cons_cta_corren_custo_distr, cons_cta_corren_res_ped, cons_tit_ap_associar_container, cons_tit_ap_associar_container_apos_di, cons_tit_ap_associar_pedido', 'Há serviços e consultas publicados, mas falta reconciliar cada origem e suas ações/contextos. A exclusão pontual do menu Conta corrente fornecedor não exclui toda a família.'),
    'cotacoes e referencias erp': ('bl_sincr_cotacao, bl_atu_dolar_dia, form_pp_container_cotacoes, bl_getCotacaoEms2', '1054 coordenador/adapters preparado e testado localmente; sem hooklogin/ativação. Gates de triggers, vetorEMS30/31, concorrência e wrapper físico permanecem. Outras pontes exigem rastreio próprio.'),
    'anexos e documentos': ('cons_anexos_container, form_anexos_container', 'Listagem/manutenção existente e candidato de download devem ser distinguidos. Download não ativado:146 referências MED observadas, zero arquivos físicos disponíveis; caminho/backup ainda não informado.'),
    'amostras e desenhos': ('ctrl_envios_repres_amostra, grid_desenhos, form_desenhos, grid_tipos_desenho, form_tipos_desenho', 'Consulta global de amostras1052 publicada. Envios por representante e desenhos/tipos ainda não encerrados; tabelas de desenhos não visíveis no escopo de esquema/perfil observado, sem DDL inventado.'),
    'pedidos de importacao e alocacao': ('cons_procs_compra, form_proc_compra, bl_criar_itens_container, grid_controles_proc_compra, form_itens_controle', 'Serviços principais de pedidos/alocação já entregues; origens restantes exigem confronto específico. Quatro aplicações de Controles ficam para o FINAL, por determinação do usuário.'),
    'visoes operacionais e sinalizadores': ('cons_planilha, bl_resumo, cons_pedidos_por_item_ref_container, menu_vendas_container', 'Sinalizadores MED entregues não encerram planilhas, visões globais ou seleção de vendas por semelhança.'),
    'logs e auditoria': ('cons_logs, cons_log_apl, cons_log_inc_alt, cons_itens_log, grid_sc_log', 'Auditoria nova já existe nos fluxos convertidos; consulta histórica e aplicações legadas de logs ainda precisam contrato/confronto próprios.'),
    'navegacao e utilitarios transversais': ('menu, bl_list, bl_processando', 'Reconciliar eventos, parâmetros e retornos das pontes. Não são necessariamente novas telas.'),
    'identidade e permissoes': ('app_login, ctrl_login_html, bl_getProgUsuario, bl_permissoes, bl_timeout', 'Autenticação existente preservada. Revisão geral e novos acessos ficam na etapa final; não repetir permissões já consumidas.'),
    'alternativas de containers a confirmar': ('bl_painel_container, bl_pp_container, grid_containers, form_PUB_pp_container, form_containers, cons_ped_container', 'Seis origens em triagem real de uso/diferenças. cons_ped_container só tem wrapper local; index principal comprovadamente ausente. Não excluir nem converter por nome.'),
    'alternativas historicas e testes': ('app_login_bkp, cons_cta_corren_custo_distr_bkp, cons_docum_est_importacao_old, grid_itens_container_old', '28 origens em triagem; sufixo antigo/bkp/teste não prova inatividade. Oito diagnósticos foram deliberadamente excluídos da coleta operacional.'),
}
families = []
all_names = {e['application'] for e in entries}
for family in sorted({e['family'] for e in entries}):
    rows = [e for e in entries if e['family'] == family]
    principal, status = notes[plain(family)]
    assert all(n.strip() in all_names for n in principal.split(','))
    families.append({'family': family, 'notClosedOrigins': len(rows), 'principalOrigins': principal.split(', '), 'status': status,
                     'origins': [{'application': e['application'], 'recordedState': e['recordedState'], 'classification': e['classification'], 'targetScreen': e['targetScreen']} for e in rows]})

snapshot = {'at': datetime.datetime.now(datetime.timezone.utc).isoformat(), 'inventorySha256': sha(ROOT / 'integration-src/ciw-inventory/inventory-reviewed.json'),
            'ledgerSha256': sha(STATE / 'ledger.json'), 'origins': 262, 'recordedConverted': 62, 'notClosed': 200,
            'notClosedDoesNotMeanNotImplemented': True, 'substantiveSources': 189, 'wrapperOnly': 1, 'withoutLocalPhp': 10,
            'freshHumanAuthorizations': {'aux4Reads': 'authorized, applied and verified by root; exact gates consumed', 'build7FourReads': 'authorized, applied and verified by root; exact gates consumed', 'batch1042ExactScenarioAndThreePermissions': 'metadata/native and exact3permissions applied+verified; '+batch_status},
            'batch1042ConfirmedSteps': batch_steps,
            'attachmentCorpus': {'observedMedReferences': 146, 'availableFiles': 0, 'backupPathConfirmed': False, 'furtherProbesAuthorizedByThisReport': False},
            'families': families, 'inventoryChanged': False, 'completionClaim': False}
comparison_publication = STATE / 'build13-metadata-publication-preparation/metadata-publication.json'
if comparison_publication.exists():
    native_path = STATE / 'build13-native-metadata-verification/runtime-read-proof.json'
    native_ok = native_path.exists() and read(native_path).get('success') is True and read(native_path).get('metadataPublicationSha256') == sha(comparison_publication)
    snapshot['comparisonPublicationEvidence'] = {'path': str(comparison_publication), 'sha256': sha(comparison_publication), 'nativePostPublicationPending': not native_ok, 'humanGrantApplied': False, 'originPromotion': False}
(OUT / 'remaining-current.json').write_text(json.dumps(snapshot, ensure_ascii=False, indent=2) + '\n', encoding='utf8')
lines = ['# Aplicações CIW ainda não encerradas', '', '**262 origens Scriptcase:62 registradas como Convertido e200 ainda não encerradas. Essas200 não equivalem a200 telas sem implementação.** Incluem consultas/partes já publicadas, candidatos, ações restantes, triagem, acessos e validação.', '',
         'A consulta1053 de NFs disponíveis MED está publicada1.0.0:42compilações/5.704checks oficiais,43checksPASOE e26checks nativos em cinco containers, comprovando conjuntos acima de200 sem truncamento. Fonte financeira4→6 e pai1000v1.0.3 preservam as operações existentes; acesso humano1053 ainda não concedido. O1055 global já tem API e tela1.0.0 publicadas:7compilações/384checks oficiais,17checksPASOE e consulta/get/PK3/paginação/filtros nativos validados; falta solicitar seu acesso humano.', '',
         'As quatro leituras AUX e quatro leituras do lote7 foram autorizadas, aplicadas e verificadas pelo root; seus gates foram consumidos. A1042 já tem metadados publicados e três permissões aplicadas/verificadas; '+batch_status+'. As três leituras do lote1 já foram consumidas e não devem ser repetidas.', '',
         '**Anexos:** o candidato de download existe, mas146 referências observadas apontam para arquivos fisicamente ausentes. Ainda não foi informado caminho/backup. Isso não significa que outras146 aplicações estejam faltando.', '',
         '| Família | Origens não encerradas | Principais aplicações Scriptcase | Situação real |', '|---|---:|---|---|']
for f in families:
    names = ', '.join('`'+n+'`' for n in f['principalOrigins'])
    lines.append(f"| {f['family']} | {f['notClosedOrigins']} | {names} | {f['status']} |")
lines += ['', 'Fonte disponível não comprova paridade. Não houve alteração de estado, destino, acesso ou inventário por este relatório. Controles permanece FINAL. Objetivo global continua ativo.', '',
          '# Relação completa das200 origens não encerradas', '', 'A lista abaixo é de pendências de encerramento, não uma declaração de ausência de implementação.']
for f in families:
    lines += ['', '## '+f['family']+f" ({f['notClosedOrigins']})", '', ', '.join('`'+e['application']+'`' for e in f['origins'])+'.']
(OUT / 'PENDENCIAS_ATUAIS.md').write_text('\n'.join(lines)+'\n', encoding='utf8')
print(json.dumps({'success': True, 'origins':262,'notClosed':200,'families':len(families),'markdownSha256':sha(OUT/'PENDENCIAS_ATUAIS.md'),'jsonSha256':sha(OUT/'remaining-current.json')}, ensure_ascii=False))
