# Comparação causal: transporte1056

Nenhuma mudança de core foi feita. O root pediu comparar a decisão de exigir payload.context do próprio candidato1056 com a capacidade nativa existente. A origem exige seleção por fornecedor, mas não define o formato JSON da API nova.

| Alternativa | Delta necessário | Efeito/limite |
|---|---|---|
| A: contexto explícito em toda leitura | integerRange em Builder/normalizer/validator/Engine/schema, mais Grid read/export e possivelmente Form opções/download | Funciona, mas altera consumidores gerais para atender requisito introduzido no helper novo. Requer novas regras de encaminhamento e mais regressões, preservando semflag. Grid product change está pausado. |
| B: fornecedor1056 derivado de filtro fixo AND/eq | Mesma aceitação signed no contexto de navegação, mais alteração SOMENTE do helper privado1056 para READ aceitar o filtro já enviado nativamente | Menor fronteira: contexto opcional, se presente deve ser exato/consistente; OR/neq/conflito/ausência recusados. GET permanece com contexto obrigatório. Não muda Grid, fontes/URLs ou resolvedor positivo genérico. Reutiliza visitor e signedInteger existentes. Recomendação, sujeita decisão root. |
| C: filtro livre sem contexto fixo | Nenhuma capacidade signed de navegação | Não satisfaz:0/negativos já são bloqueados pelo Engine; filtro livre não garante vínculo do chamador e poderia ser limpo/trocado. Não adotada. |

O filtro de B nasce do fornecedor declarado em contextFields, que continua required/filter/readonly/createDefaultfalse. withContextFilters reaplica o valor da navegação e remove tentativa de substituição pelo usuário. O helper verifica novamente AND/eq e igualdade de todas as ocorrências, antes de coletar/paginar. Não basta aceitar o primeiro filtro e ignorar os demais. Sem contexto e sem igualdade positiva de seleção, falha; zero é valor válido e não pode ser confundido com ausência. Identificação de ausência deve usar sentinela NULL/booleano, nunca truthiness.

Se payload.context for enviado, ele só pode conter fornecedor_id signed válido e nãoNULL. Objeto vazio, contexto com campo extra, tipo errado, overflow ou representação ambígua falha; não cair silenciosamente para o filtro. Filtro em OR, operador diferente de eq, duplicatas divergentes ou divergência entre context e filtro falham. GET não passa a aceitar seleção apenas por filtro. Recursos1045/46, ApiRequestContext e seu padrão positivo permanecem iguais.

O draft1056 é somente read/get e arquivo é texto. É necessário provar a inexistência de optionsSource/editor file/download/process no exemplo real antes de decidir tocar Form/ProcessEngine; não ampliar consumidores hipotéticos. Na alternativa B, opções/downloads permanecem fora do escopo1056. Schema de processo deve rejeitar integerRange para evitar que o novo descritor seja aceito por um engine não preparado.

Planejamento final após decisão: cinco arquivos nativos (Builder, Normalizer, Validator, Engine, CRUDschema), mais companion isolado RuntimeImportDiscountRead1056; usar como predecessor os bytes filterOnly congelados e o helper1056 congelado, sem substituir canônicos ou congelados. Só seriam incluídos outros consumidores após prova de uso real e autorização root.
