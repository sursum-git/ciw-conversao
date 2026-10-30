# Painel global de sinalizadores MED — candidato

Estado: **CANDIDATE_NOT_COMPILED_12_2_NOT_PUBLISHED**. Nenhum canônico, acesso, banco, DDL ou contexto global alterado por este executor. OpenEdge local 12.8 serve somente como verificação adicional; seus `.r` nunca são artefatos de publicação.

| Fonte Scriptcase | Evidência e lacuna | Candidato |
|---|---|---|
| bl_sinaliz/index.php:7673–7975 | Regras1–4 e contagem por listas; regra5 embarque entre hoje e hoje+prazo inclusive | Coletor comum extraído; resumo op1031 e detalhes op1032 |
| cons_proc_compra_sinaliz/index.php:3598; grid.class.php:708 | Lista de processos da regra4 via sessão SQL IN | Detalhes tipados da regra4, link para painel já publicado |
| cons_itens_proc_compra_sinaliz/index.php:5819; grid.class.php:714 | Lista dos itens das regras1–3 via sessão SQL IN | Detalhes com identidade do item e processo, link para painel existente |
| bl_painel_proc_compra_sinaliz/index.php:5100–5154 | Resolve dados do processo em sessão e redireciona menu | Contexto nativo por proc_compra_id, sem sessão SQL |
| menu_proc_compra_sinaliz/index.php:2565,2807–2817 | Itens, Pagtos e Anexos do processo | Painel ciw.processos-compra-med existente, com suas abas/permissões; sem nova manutenção |

Regras1–4 continuam somente em `PurchaseSignalRules.p`. O corpo de coleta de `PurchaseSignalsService.p` foi extraído para `PurchaseSignalsCollector.p` e `PurchaseSignalsTable.i`; o serviço contextual vira adaptador compatível. Contextual e global coletam uma vez por processo, antes de filtros/paginação. Não há execução de um coletor por página. O contador global soma os itens examinados pelo coletor, incluindo itens sem alerta, processos e containers. Limites de 50mil/10s falham sem resultado parcial; o serviço contextual preserva seus limites anteriores. O coletor recebe orçamento restante e início global como dois parâmetros privados fora do JSON, verificando-os a cada item; contextual passa50000/ETIME. Isso limita trabalho durante a coleta, não apenas o resultado depois dela.

Não há parâmetro IMA nesta regra; os prazos vêm de `espec.sinalizadores_importacao`, consulta NO-LOCK direta por chamada. Não há cache. Não há fórmula fiscal, custo, versão ou regra financeira nova. A regra4 preserva ausência de QUALQUER pagamento; não interpreta status/valor.

Decisões e diferenças explícitas:

- MED solicitado: processos via empresas.cod_emp_ems2=5; containers pelo primeiro caractere de cod-estabel='5', mesmo padrão de ContainersPainelReadService.p:262–275. CiwMedCompanyContext valida empresa MED única. O legado global não limita empresa; a nova restrição é intencional para esta entrega MED.
- Regra5: `situacao=1`, `dt_real_embarque=?`, previsão conhecida entre hoje e hoje+qt_dias_alerta, inclusive. `situacao_container_id` é acompanhamento e não substitui `situacao`. Embarque vencido não entra na janela. Não usar chegada/translado/prazo IMA nesta regra.
- Resumo tem cinco linhas, inclusive quantidade0; legado ocultava grupo vazio. É escolha de apresentação sem alterar associação de registros.
- Detalhes exigem contexto `sinaliz_imp_id` na tela nativa; seleção de registro é recalculada no servidor, não enviada como lista SQL de IDs. Contexto de processo arbitrário é recusado nesta API global.
- Regra5 exibe `data_base=dt_prev_embarque` e `data_alerta=hoje+prazo` (fim da janela); para regras1–4, data_alerta mantém o vencimento existente. O detalhe da regra5 não transforma previsão em atraso.
- Itens Containers não contém regra implementada no PHP estudado; não inventado um sexto grupo.
- A lista de itens mantém o item preciso sinalizado. O link do registro abre o painel do processo completo, não promete posicionar a edição no item.
- NO-LOCK não oferece snapshot transacional entre tabelas/processos, como os leitores anteriores. A extração remove a recoleta por página dentro da mesma consulta; não declara consistência de snapshot entre consultas.

Metadados: `ciw.sinalizadores-importacao-med/op1031/1.0.0` e `ciw.alertas-importacao-med/op1032/1.0.0`; entidades `proc_compra_sinalizadores_med_progress` e `proc_compra_sinalizados_med_progress`; recursos `proc_compra_sinalizadores` e `proc_compra_sinalizados`. Quatro operações na fonte existente, sem republicar operações anteriores. Frontend existente sem JS/Kendo alterados. Configuração de sinalizadores fica no pacote separado do gerente. Quantidades op1030 concluídas e Controles final ficam fora do recorte.

Chave resumo: JSON{sinaliz_imp_id}. Chave detalhe: JSON{sinaliz_imp_id,tipo_registro,proc_compra_id,item_proc_compra_id,container_id}; zeros de identidades não aplicáveis são internos. Campos de navegação `link_proc_compra_id`/`link_container_id` são NULL quando não aplicáveis, ocultando o link correspondente pela função existente `CrudKendoGridRenderer.buildRowLinkHtml` (1002–1012). Somente read/get; wrappers fixam seis buffers e TODAY.

## Integração a cargo do root

Aplicar patches com verificação exata baselineSHA256, reconciliando trabalho concorrente em vez de sobrescrever. Publicar `.i`, novos programas e adaptador contextual juntos; dispatcher por último. Compilar oficialmente em OpenEdge12.2/.42 contra schema real para API/dispatcher e testes TT NUM-DBS0 nas quatro combinações de cultura/codepage. Publicar somente o lote oficial em sursum-api/med/9911, sem fallback. Não usar `local-stage/*.r`.

Validar read/get resumo5linhas, regras1–5/detalhes, contexto regra, GET fora da regra, chaves/aliases divergentes, filtro/página200/skip200/ordenação, clock/SQL/empresa/tabela/programa externos e writers recusados. Regressões obrigatórias: alertas contextuais op1027, quantidades/prazos já publicados e leitor compartilhado. Backend PHP patches acrescentam catálogo fechado e assertRows do contexto, preservando transporte/fonte/rota fixos. Comparar dados+totais runtime e PASOE; provar UI nativa com contexto de resumo/detalhes e links mistos. Acesso humano só pelo fluxo autorizado do root; este pacote não aplica concessões.

Testes locais de preparação: executar `node prepare.cjs`, `node extract-collector.cjs`, `node tests/prepare-tests.cjs`, `node tests/prepare-php.cjs`, `php tests/preview-metadata.php summary`, `php tests/preview-metadata.php detail`, `php tests/RuntimePurchaseSignalsGlobalQueryTest.php`, `node tests/metadata-and-links.cjs`, `node tests/verify-generation.cjs`; usar caminhos relativos à raiz deste candidato. O harness de compilação usa cwd local-stage, PROPATH padrão da pasta e `tests/CompileAndRun.p`. Os geradores são ferramentas de preparação antes da integração: congelar manifesto e validar baselines antes de aplicar; não reexecutá-los sobre canônicos já integrados para recalcular baselines.
