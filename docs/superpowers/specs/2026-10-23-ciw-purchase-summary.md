# Resumo do processo de compra MED

Converter bl_resumo_proc_compra usando somente metadados e API Progress. Contexto proc_compra_id obrigatório, validar dono MED, sem escolher banco/empresa pelo navegador. Mostrar custo previsto itens = SUM(cotacao_prevista * qt_comprada * vl_negociado), despesas base = SUM(vl_prev), custo despesas = qt_container * despesas base. SQL SUM ignora parcelas nulas; conjunto vazio resulta zero. Preservar precisão de cálculo e formatar moeda em duas casas na interface. Quantidade de containers e câmbio explicitam a regra. Sem impostos ou persistência ao abrir.

Núcleo reutilizável de coleta/cálculo separado do adaptador fixo de API; reutilizar contrato JSON, contexto MED e leitor limitado existentes. Testar apenas TT e leituras reais. Logs de usuário/imagens de manutenções existentes permanecem acessíveis pelo processo; consulta não inventa valores anteriores. Não conceder acessos nem executar cenários antigos.

Entregar tela contextual no detalhe e link da consulta do pai, preservando sete abas e 92 operações. Compilar OE12.2 .42, publicar no compartilhamento via .111, validar sursum-api/med e UI. Controles só após confirmar tabela/vínculo; cálculo de impostos separado e não executado neste recorte.
