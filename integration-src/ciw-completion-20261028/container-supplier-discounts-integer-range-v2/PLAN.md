# Contexto inteiro assinado: plano executado e contrato

A alternativa B foi aprovada pelo root: cinco fontes nativas reutilizáveis e um helper privado1056. O domínio preserva o predecessor filterOnly e2787dfe e o freeze1056 ad6ae7a9. Nenhum canônico, catálogo, permissão, dado, ABL ou ambiente foi alterado.

## Causa e decisão

O SQL ativo de cons_desc_geral_fornec:828 compara descontos.fornecedor_id com a sessão fornec_id; o caller passa fornecedor_id físico. O schema INTEGER nullable/initial0 sem validação positiva comprova domínio int32 e zero inicial. Não comprova linhas reais0/-9/MIN existentes; esses são valores sintéticos de domínio nos testes. A seleção pública continua obrigatória e nãoNULL.

A Engine anterior só aceita integer positivo no contexto. A grade nativa já encaminha a seleção como filtro fixo, sem payload.context. O helper1056 congelado exigia contexto explícito até em READ, requisito introduzido no candidato novo, não pelo Scriptcase. A prova causal mostra que só mudar o descritor não fecha ambas as fronteiras. ALTERNATIVAS.md registra A/B/C; B evita ampliar Grid/Form.

## Perfil genérico do framework

contextFields[].integerRange={min,max} é opt-in, objeto fechado, inteiros int32 inclusivos, min<=max, sem coerção. O framework não conhece op1056, fornecedor ou entidade de descontos. Exige CRUD somente leitura (create/edit/delete=false), campo integer existente que NÃO seja a PK, required/filter/readonly=true e createDefault=false. Opções remotas, attachment/editorfile e processo são recusados nesta capacidade. Renomear programa/entidade/tela/campo para nomes neutros válidos continua funcionando. A utilização de negócio desta onda é apenas1056; outro backend continua precisando comprovar seu contrato assinado antes de usar a capacidade.

Sem integerRange, parser positivo e payloads antigos ficam iguais, inclusive comportamentos preexistentes fora do perfil. filterOnly mantém a fronteira especial já congelada. IntegerRange não admite filterOnly=true porque required=true e optional=false seriam contraditórios. O opt-in aceita número inteiro ou string decimal canônica; recusa NULL, booleano, array, float, espaços, sinal+, string -0, zeros à esquerda, expoente e overflow. Número JSON zero é zero.

Builder valida o perfil e preserva o objeto. Normalizer centraliza a checagem usada também por Validator e Engine. Schema2020 valida formas, tipos, limites e perfil readonly/sem consumidores não preparados. Comparação min<=max e relação dinâmica campo existente/integer/nãoPK são comprovadas pelos validadores executáveis; JSONSchema padrão não compara propriedades por nome dinâmico. Não há extensão AJV especial que esconda essa limitação.

## Helper privado1056 e transporte B

RuntimeImportDiscountRead::supplierContext altera somente a seleção do recurso fornecedor. READ deriva fornecedor de uma igualdade tipada e fixa em AND; todas as ocorrências precisam concordar. Contexto explícito é opcional para READ, mas se presente deve conter exatamente fornecedor_id válido e concordar com filtros. Ausência, OR/neq de fornecedor, duplicatas divergentes, extras ou contexto vazio/NULL/inválido falham422. Zero usa sentinela NULL de ausência, sem teste truthy. GET continua exigindo contexto explícito. Visitor/signedInteger, limites, chaves, mapper, agregação ABL e demais recursos são reutilizados; não há fórmula nova.

Grid/Form/ProcessEngine, ApiRequestContext e o contexto positivo geral NÃO mudam. A Engine encaminha GET assinado e withContextFilters mantém a seleção fixa; a grade inalterada manda o filtro antes da paginação. O draft1056 não tem optionsSource/file editor/download/process. O campo arquivo continua texto; não implementar download nesta frente.

## Provas locais e gates

RED causal precedeu implementação. RED adicional rejeitou rename genérico no primeiro perfil excessivamente específico; o candidato final removeu esses códigos. Testes finais:31 nativos/AJV/protótipos (22 regressões filterOnly) e FULLPHP903/6005 sobre410 fontes atuais13 com apenas Builder+helper de overlay;278 classes App carregadas no estágio. Normalização REAL da entidade e validateExternalDraft do draft congelado passam; definição inteira muda SOMENTE integerRange. Três drafts filterOnly e seus bytes sem flag preservados. Todos os testes são sintéticos, sem rede/DB/negócio.

Os patches nativos têm baseline FUTURO nos candidatos filterOnly; o helper tem baseline FUTURO no freeze1056. Não aplicá-los diretamente sobre canônicos205/13. Estágio PHP copia TODOsrc atual13, incluindo ComparisonRead e Action/Query13; não sobrepõe arquivos antigos1056. Esse full prova regressão e helper isolado, NÃO integração de roteamento1056. Root deve compor/rebasear por hunks as integrações Action/Query1056 sobre13 após review e validar o caminho real read/get antes da publicação. Nenhuma fonte/operação/metadado desta frente foi cadastrado. Não inferir PASOE, grants, linhas reais assinadas ou validação visual Kendo.
