# op1050 — conta corrente de distribuição do item

Produto preparado isolado, não publicado e não Convertido. Fonte cons_cta_corren_distr_item_container: index:1160 tabela pub.cta_corren_custo_distr; index:3599 exige item_container_corrente no WHERE item_container_id; grid:833 seleciona oito campos. Classe de lookup vazia: nenhum nome, enum de movimento ou interpretação adicional é inventado.

Campos físicos mantidos: cta_corren_custo_distr_id, data, historico, vl_lancto, login, item_container_custo_id, item_container_id e cod_tipo_movto. Não inclui despesa_container_id, que é o nono campo físico ausente da origem. Preserva DATE/INTEGER/DECIMAL2/CHARACTER, NULL, zero, sinal e imagem original do login. Sem soma ou regra financeira. Não chama writer, calculador de custos, rateio ou versão.

Reutiliza CiwErpReadService para filtros/ordem/página200/GET. Uma coleta física fixa NOLOCK por owner fornece a projeção tipada; orçamento50mil/10s único inclui toda leitura e serviço. Contexto item_container_id inteiro positivo obrigatório; não existe empresa MED implícita. ChaveJSON carrega owner+PK física; getter em outro contexto retorna404. Como o SQL original não faz join com itens_container, owner sem lançamentos retorna lista vazia, sem inventar erro de existência do pai. Erros de esquema/limite/tempo não expõem dados parciais.

Chamador real ctrl_simul_distr_custo_js0.php:90 envia item_container_corrente. API nativa recebe o mesmo ID como item_container_id; fixtures comprovam encaminhamento obrigatório, data/NULL/sinal, filtro, ordenação e GET com contexto diferente. Nenhum link do simulador publicado foi alterado sem export. Há proposta adicional readonly do op1049 (item_container→item_container_id), gated pelo export efetivamente publicado ou composição prévia do root; não reescrever frozen-op1049-v1.

Testes de desenvolvimento12.8:6compiles por código de página;31checks TT×4 UTF8/ISO8859-1×AMERICAN/EUROPEAN, NUMDBS0; RED programa novo ausente antes de implementação. PHP real readCiwErpPage/GET6testes35asserções RED→GREEN, transporte mock, sem rede. Builder real1teste4asserções e PageDefinitionNormalizer/CrudDefinitionValidator PASS.

Patches são aditivos contra os quatro canônicos pós6 por hash, não aplicados. São propostas independentes das de1049 e descontos: root deve compor hunks e operações preservando ambos, ou rebasear após cada integração. Nenhum patch cumulativo antigo, nenhuma substituição de autenticação por DTO sanitizado. Fonte atual132 é baseline individual; append2 não presume ser a contagem final do lote composto. Permissão própria custo_distribuicao_lancamentos_item_progress.read, sem grant.

Root ainda precisa revisão independente, compilação12.2/.42 e validação real na mesma sursum-api/MED. Extrato geral1048 continua com gateSQL e não está coberto por esta projeção.
