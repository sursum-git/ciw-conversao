# Comparações históricas BRL/USD — candidato retido

Produto preparado para op1040/op1041, ainda sem integração, compilação oficial, publicação, concessões ou classificação de origem como convertida. O snapshot congelado é evidência revisável, não autorização de ativação.

`ContainersVersionComparisonApi.p` fixa dez buffers espec e duas moedas no servidor. `ContainersVersionComparisonService.p` reutiliza `ContainersVersionService::consultar`; o materializador usa o mesmo lookup atual e um projector financeiro somente leitura. O leitor ERP existente mantém filtros, ordenação, página máxima 200 e chave completa CID/VID/item histórico. Snapshot mais lookup compartilham o teto de 50 mil leituras ERP e a janela externa de dez segundos. Não há nova fórmula de geração, collector financeiro, cache IMA ou persistência.

PHP valida bindings, contexto, tipos, shape, ownership e aliases antes de mapear. Chaves têm nomes comparados como conjunto, com a string opaca preservada integralmente no GET. As duas telas JSON reutilizam o CRUD nativo; 14 colunas e quatro operações list/detail, somente leitura. Os links de navegação são propostas aditivas no pai atual, sem substituir autenticação ou configuração.

Evidência local: oito compilações de diagnóstico OpenEdge 12.8/NUMDBS0; sete suítes novas com 377 checks em cada combinação UTF8/ISO8859-1 × AMERICAN/EUROPEAN; onze regressões afetadas com 495 checks por combinação. Total: 3.488 checks/72 logs TT. PHP completo 899 testes/5.988 asserções, usando as classes candidatas reais e linha sintética produzida pelo serviço central TT. Dois drafts/registry quatro operações normalizados pelo Builder real; dois schemas AJV e dois validadores nativos passaram estruturalmente. Não houve browser ou rede.

O diagnóstico amplo de dependências executou 47 compilações locais: 44 passaram, três wrappers físicos existentes exigiram espec/parametros_ima e não são compilações oficiais. O harness fechado de oito fontes deste produto passou sem DB. Nenhuma dependência física foi substituída para simular sucesso.

Limites de integração obrigatórios:

- Os vetores SQL e o metadata físico resolveram os pontos de escala conhecidos, sem provar todos os valores físicos, overflow, empates de arredondamento ou efeitos do otimizador. A validação física final pertence ao root.
- O consultar central exige pp-container existente; o SQL original não o une. Não declarar equivalência para versão órfã e não copiar collector ou relaxar writers.
- O Builder ainda produz filtros decimais text/contains; o gerente prepara correção central separada. O recibo nativo registra essa falha funcional, embora o schema estrutural passe. Não publicar os drafts assim.
- Quantidades BRL raw driver text versus n2 têm diferença de apresentação declarada; nenhuma alegação de igualdade exata de padding. PK ASC é extensão estável de paginação, pois a ordem inicial da fonte é vazia.
- Revalidar hashes canônicos e export atual da fonte/pai antes da composição. Não aplicar snapshots inteiros ou sobrescrever hunks de op1055. Root centraliza 12.2/.42 e PASOE sursum-api/MED.

`tests/prepare-local.ps1` prepara somente diagnóstico 12.8 e `tests/run-local-*.ps1` exercitam TTs sem conexão. A fixture SQL é fechada e foi executada somente pelo root; não há executor SQL neste pacote. `shared-byte-plan.json` e manifesto congelado são os mapas de integração por hash; não aplicar automaticamente.
