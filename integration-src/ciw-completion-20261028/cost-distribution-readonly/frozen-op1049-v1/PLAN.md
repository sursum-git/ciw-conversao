# Consultas de distribuição de custo

Recorte autorizado: op1049 itens aptos primeiro; op1048 extrato geral depende da prova delimitada dos agregados UNION e do evento de saldo. Os códigos foram reservados pelo root. Somente leitura; nenhum efeito comercial, grant, DDL ou alteração canônica.

1. Reconciliar três origens frescas com os recursos publicados. Registrar SQL, contexto, filtros, colunas, lookup e chamador; não confundir plano de rateio com consulta global de itens.
2. Testar RED a projeção dos itens aptos: quatro joins físicos, container.situacao<>3, ausência de filtros inventados; órfãos excluídos pelo INNER JOIN; nomes atuais via helper central. Limites compartilhados 50mil/10s e página200.
3. Implementar coletor fixo e wrapper/serviço RO, reutilizando CiwErpReadService para filtro/ordenação/paginação/get e ContainersVersionHistoryLabels para dois emitentes. Sem cálculo financeiro novo.
4. Propor patches aditivos de Reader/dispatcher/PHP e metadados nativos para op1049. Reader/Action mudarão na integração official6: congelar somente após rebase por hash, preservando todos os ramos. Não aplicar.
5. Validar TT em UTF8/ISO8859-1 × AMERICAN/EUROPEAN e chamadas PHP reais readCiwErpPage/GET, transporte mock. Manifesto, baselines e revisão para root compilar12.2/publicar.
6. Preparar probe SQL mínimo do extrato1048 e continuar a implementação somente a partir de comportamento comprovado; não fabricar saldo ou NULL. Ledger contextual é origem distinta e não fica convertido por similaridade.

Arquivos próprios: abl/CostDistributionEligible{Collector,ReadApi,ReadService}.p; includes/CostDistributionEligibleTable.i; tests/abl; php; metadata; patches; source-proof.json; scripts locais de preparação. Shared helper somente dependência imutável congelada no lookup-v2, SHA9bfe21dc6ff9d86105d7602d376a2adc3cc3b9fe61783a68f7d1cd03f9d100bb.
