SELECT * FROM (
WITH expected_screens(screen_id) AS (
    VALUES ('ciw.alertas-importacao-med'),
    ('ciw.coloracoes'),
    ('ciw.container-alocar-itens'),
    ('ciw.container-anexos'),
    ('ciw.container-comparativos'),
    ('ciw.container-custos-itens'),
    ('ciw.container-despesas'),
    ('ciw.container-fechar-custos'),
    ('ciw.container-gerar-versao'),
    ('ciw.container-itens'),
    ('ciw.container-nfs'),
    ('ciw.container-pagamentos'),
    ('ciw.container-painel'),
    ('ciw.container-rastro-dolar'),
    ('ciw.container-resumo'),
    ('ciw.container-sincronizar-impostos'),
    ('ciw.container-versoes-custo'),
    ('ciw.containers'),
    ('ciw.cotacoes-bc'),
    ('ciw.despesas'),
    ('ciw.empresas'),
    ('ciw.empresas-despesa'),
    ('ciw.formatos-amostra'),
    ('ciw.fornecedores'),
    ('ciw.fornecedores-estrangeiros'),
    ('ciw.itens-erp'),
    ('ciw.motivos-desconto'),
    ('ciw.proc-compra-alertas'),
    ('ciw.proc-compra-alocacoes'),
    ('ciw.proc-compra-amostras'),
    ('ciw.proc-compra-anexos'),
    ('ciw.proc-compra-calcular-impostos'),
    ('ciw.proc-compra-despesas'),
    ('ciw.proc-compra-documentos'),
    ('ciw.proc-compra-gerar-despesas'),
    ('ciw.proc-compra-itens'),
    ('ciw.proc-compra-pagamentos'),
    ('ciw.proc-compra-quantidades'),
    ('ciw.proc-compra-resumo'),
    ('ciw.processos-compra-med'),
    ('ciw.quantidades-importadas-med'),
    ('ciw.sinalizadores-importacao'),
    ('ciw.sinalizadores-importacao-med'),
    ('ciw.situacoes-container'),
    ('ciw.tipos-anexo'),
    ('ciw.tipos-versao-custo')
), expected_sources(code) AS (
    VALUES ('motor_progress_ciw_cadastros'),
    ('motor_progress_container_alocacao'),
    ('motor_progress_container_cabecalho'),
    ('motor_progress_container_custos'),
    ('motor_progress_container_despesas'),
    ('motor_progress_container_financeiro'),
    ('motor_progress_container_itens'),
    ('motor_progress_container_pagamentos'),
    ('motor_progress_container_painel'),
    ('motor_progress_container_processos'),
    ('motor_progress_containers'),
    ('motor_progress_despesas'),
    ('motor_progress_empresas'),
    ('motor_progress_tipos_anexo')
), actual_screens AS (
    SELECT screen_id FROM screen_definition WHERE status='published' AND screen_id LIKE 'ciw.%'
), actual_sources AS (
    SELECT code FROM builder_api_source
)
SELECT
    (SELECT count(*) FROM expected_screens JOIN actual_screens USING (screen_id)) AS expected_screens_published,
    (SELECT count(*) FROM actual_screens WHERE screen_id NOT IN (SELECT screen_id FROM expected_screens)) AS ciw_screens_outside_scope,
    (SELECT count(*) FROM expected_sources JOIN actual_sources USING (code)) AS expected_sources_present,
    (SELECT md5(string_agg(definition::jsonb::text,',' ORDER BY version)) = '4d9a91eac77da29b42b11d41f38410b9'
     FROM screen_definition WHERE screen_id='home' AND status='published') AS home_matches_baseline,
    (SELECT md5(string_agg(to_jsonb(s)::text,',' ORDER BY code)) = '494b974da2e37ed576e9157af64275c6'
     FROM auth_subscriber s) AS subscribers_match_baseline
) AS verification;
