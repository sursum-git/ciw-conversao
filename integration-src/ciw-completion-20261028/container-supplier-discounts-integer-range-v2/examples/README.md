# Exemplo nativo candidato

supplier-discounts-integer-range.json é byteigual à definição gerada pelo Builder real do draft1056 congelado com somente integerRange adicionado. Reutiliza PageDefinitionNormalizer/CrudEngine/grade/form nativos; não contém JavaScript, mock ou frontend paralelo. É exemplo PREPARADO, não programa publicado. Depende da integração backend1056 e de autenticação/permissões reais, não concedidas aqui.

Contexto de navegação fornecedor_id é obrigatório. Os testes usam0/-9/MIN/MAX sintéticos para provar transporte tipado; não afirmam que haja registros reais desses fornecedores. Arquivo é texto, opções de tipo são estáticas, e escrita/processo/arquivo remoto estão fora da capacidade. Não chamar endpoints deste exemplo para validar esta frente: a validação entregue é local sem rede/DB.

Matriz e contratos estão em REVIEW.md/PLAN.md. A definição completa foi validada por AJV2020 após resolução sintética apenas das permissões, além do normalizador e Validator reais. Essa prova de componentes não é execução DOM/widget Kendo publicado.
