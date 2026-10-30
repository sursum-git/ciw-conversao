# Descrições atuais no histórico — incremento separado

Acrescenta três colunas readonly: `item_descricao_atual`,
`emitente_nome_abrev_atual` e `despesa_descricao_atual`. Os IDs, chaves e valores
persistidos continuam presentes. Cadastro atual ausente, referência órfã ou texto
atual desconhecido produz NULL na nova coluna. Nenhuma fórmula foi acrescentada.

`schema-proof.json` registra hashes, tipos e chaves únicas dos quatro dicionários
disponíveis e hashes das três fontes Scriptcase. A consulta de item segue exatamente
o join atual alocação→item de compra. Emitente vem de EMS2CAD, sem filtro adicional de
fornecedor. Despesa vem de ESPEC. O helper único usa NO-LOCK; ignora somente erro565
de ausência, e propaga erros reais de consulta. Não consulta IMA nem introduz cache.

Os dois wrappers mantêm a interface externa JSON→JSON. A interface interna entre
cada API e seu Service recebe mais dois handles fixos. Publicar cada par e helper de
forma coerente: não misturar API nova com Service antigo. O serviço principal parte
de frozen-v1.4, preservando a correção missing-parent404; o auxiliar parte de
frozen-aux-v1.1. `baselines.json` identifica as cinco baselines/deltas. O patch do
Reader pressupõe o candidato auxiliar já integrado, ainda sujeito à conferência do
hash canônico antes de aplicar. Nenhum canônico foi alterado por este executor.

Há um relógio global de10s e teto global50mil: duas leituras dos pais, todos os
registros do snapshot único central e cada consulta PK do helper. A política privada
reduz o teto central para49998; o orçamento dos lookups continua a contagem total,
sem reiniciar por linha. O helper termina antes do Reader; portanto filtros,
ordenação e paginação operam também sobre as descrições atuais, até200por página.
Não foram alterados os caminhos de geração/exclusão do serviço central.

Validação local de desenvolvimento: OpenEdge12.8, dez compiles por código de página;
13checks helper+38principal+28auxiliar, repetidos em UTF8/ISO8859-1 e culturas
AMERICAN/EUROPEAN, NUMDBS0. Incluem remoção do cadastro, alteração entre requisições,
NULL, filtro global pela descrição e erro de lookup sem dados parciais. PHP real
readCiwErpPage/get:2testes/51asserções, com transporte simulado, três projeções,
filtros/contexto e descrições presentes/NULL. Nenhuma rede ou negócio foi executado.

O catálogo contém somente appends de três campos/colunas/filtros, sem novas entidades,
operações ou links. Antes da proposta final de publicação nativa, capturar export e
hash dos metadados op1035/op1037/op1039 após a integração auxiliar; criar novas
versões draft e preservar as configurações atuais. Esse gate de metadata e a revisão
independente são explícitos. Compilação12.2 no42, aliases reais, publicação
sursum-api/med e validação PASOE pertencem ao root.

Continuam pendentes as comparações históricas BRL/USD, aguardando prova SQL de NULL
e divisão por zero e definição do helper de regras compartilhado. Este incremento
não declara as sete abas do detalhe completamente convertidas.
