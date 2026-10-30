# Lookup histórico v2 — candidato após build5

Somente três colunas atuais nos programas existentes1035/1037/1039, novos drafts
1.0.1. Nenhuma entidade/operação/link/permissão nova. Contexto, valores históricos,
chaves e demais configurações são preservados. Cadastro atual removido gera NULL
na descrição e preserva IDs originais. Reader delta tem somente três projeções e
parte do hash canônico33d24e2f, preservando aux e1042.

Os dois pares API/Service mudam juntos de8para10handles internos. Interface externa
JSON permanece igual. Publicar os pares com helper/includes/Reader coerentes.
O helper é compartilhado com o futuro pacote de descontos: código ERP atual sai
da MESMA query do item e motivo é um kind fixo adicional. A assinatura do helper
não mudou; os consumidores anteriores mantêm descrições iguais. Não publicar por
cima o helper antigo do frozen-lookups-v1. Descontos gerais não estão neste lote.

Metadados: publication-guards.json referencia os seis exports atuais sanitizados.
A comparação aplica recursivamente authHeaders=[] e ordena chaves; exclui o objeto
entity.apiSource para permitir appends independentes de operações. NUNCA enviar o
DTO sanitizado como replacement: anexar só o campo novo aos campos ACTUAIS, preservar
API/autenticação reais, e criar novo draft com builderConfig preservado. Os drafts
de programa não contêm fonte/autenticação. Nenhum grant foi feito.

Desenvolvimento12.8:10compiles/cp;17helper+38principal+28aux=83checks em CADA quatro
combinações UTF8/ISO8859-1×AMERICAN/EUROPEAN, NUMDBS0. O código ERP foi acrescentado
às fixtures conforme campo físico; não foram removidas asserções anteriores. PHP
real readCiwErpPage/get2testes/51asserções, transporte simulado, sem rede.

Orçamento global50mil/10s, página200, NO-LOCK, sem cache, sem IMA novo, sem fórmulas
financeiras ou mudança no VersionService central. Root revisa/compila12.2no42 e
publica sursum-api/med. Comparações BRL/USD seguem aguardando prova SQL e helper
de regras comum; não declarar as sete abas completamente convertidas.
