# boSaldoPV

Versão independente derivada da análise de `esbo/boSaldo.p` do ERP, organizada
nas três etapas solicitadas. Preserva a BO e a include originais.
Revisão de20/10: regras confrontadas com os helpers PHP da aplicação IOL
`cons_item_estoque_unificado` no `.170`, lidos sem executar o PHP remoto.

## Arquivos de produto

- `esbo/boSaldoPV.p`: BO persistente de consulta, sem escrita em tabelas físicas.
- `esbo/boSaldoPV.i`: contrato das quatro temp-tables de entrada/resultado.
- O `.r` publicável deve ser compilado no OpenEdge **12.2/.42** contra o schema real.

O módulo usa `ems2med` e `espec` explicitamente. `empresa` aceita prefixo 5 e
seleciona os locais MED configurados; não troca bancos/aliases da sessão.
Não cria rota HTTP, sessão, permissão ou autenticação. O chamador deve fornecer
login/representante e escopo confiáveis. Não é substituto binário de `boSaldo.p`.

## Processamento

1. `selecionarItens`: limpa resultados, valida entrada e consulta `ems2med.item`
   por faixas inclusivas de item/família/peso, código/descrição e unidade. Lê
   `espec.item-ext.gramatura`. Exige extensão e grupo de estoque entre50 e60
   por padrão, conforme o INNER JOIN e predicado do PHP. A faixa de grupos também
   é parametrizável. Preenche `ttItensSaldoPV` sem buscar saldos.
2. `preencherSaldos`: percorre os candidatos, coleta PE/PI em `ttSaldoPV`, obtém
   componentes de pedidos, notas e web, calcula saldo líquido e atualiza totais
   dos itens. Não remove candidatos por quantidade.
3. `filtrarSaldos`: classifica as linhas por mínimo/máximo e origem selecionada.
   Com `exibirAmbosSaldos=YES` (padrão), uma origem selecionada precisa aprovar o item;
   para o item elegível, conserva as duas origens e soma seus saldos reais para exibição,
   inclusive linhas abaixo do mínimo. Com `NO`, mantém a filtragem anterior por origem
   e os totais somente das linhas aprovadas. `qtSaldoItem` contém o total qualificado
   repetido; `qtSaldoVenda` preserva a linha real. `aprovadoQuantidade` considera também
   a seleção de origem; uma origem não selecionada não aprova o item.

`exec` executa essas etapas em ordem. Também é possível chamá-las separadamente
para inspecionar a TT intermediária. A etapa 2 exige etapa 1; etapa 3 exige etapa 2.
Reconfigurar parâmetros/seleções invalida resultados anteriores. Falha em qualquer
etapa pública limpa todos os resultados. `getEtapa` retorna 0, 1, 2 ou 3.

## Entrada

`setParametros(INPUT TABLE ttFiltroSaldoPV)` recebe **exatamente uma linha**.
Item e família usam faixas inclusivas de `""` a `"zzzzzzzzzzzzzz"` por padrão.
Fim explicitamente vazio é convertido para esse máximo dentro da BO; não representa
infinito textual. Um máximo maior pode ser enviado explicitamente. Limites numéricos
`?` continuam abertos.
Mínimos KG/MT são conhecidos, não negativos; máximos `?` são ilimitados.
Faixas invertidas, flags desconhecidas e múltiplas/zero linhas são rejeitados.
Família significa `item.fm-codigo`, não família gerencial da extensão.
Na seleção, item informado usa intervalo direto pelo índice `codigo`; sem item,
família informada usa `fam-ge`; sem ambos, mantém o acesso por `grupo`. Os limites
de item/família não usam `OR` no WHERE. A inclusão na TT é compartilhada pelos caminhos
`FOR EACH`, preservando todos os demais filtros. Pesquisa formada somente por códigos
numéricos usa uma TT deduplicada e igualdade pelo índice `codigo`. Índices conferidos por XREF12.2,
sem `USE-INDEX` forçado.

`pesquisaItem` reproduz o campo Item da página: `175182` é código exato,
`175182,175183` é uma lista; `CAMBRAIA` pesquisa a descrição; `BRANCO CAMBRAIA`
exige ambas as palavras, em qualquer ordem. Grupos separados por vírgula usam OR,
inclusive mistura de códigos e descrição. Zeros à esquerda são preservados. Os curingas
SQL LIKE `%` e `_` são traduzidos para pesquisa ABL em memória, sem construir SQL.
Vazio não restringe; grupo vazio entre vírgulas reproduz o termo aberto do PHP.
O campo anterior `itemContem` permanece como trecho literal do código. Se ambos
forem enviados, seus filtros são combinados por AND.

`exibirAmbosSaldos=YES` retorna PE e PI como a grade. `buscarPE`/`buscarPI` determinam
quais origens tornam o item elegível. Exemplo: somente PE com mínimo79 não retorna um
item cujo PE é78, mesmo que tenha PI; se o PE aprovar, ambos os saldos serão exibidos.
`exibirAmbosSaldos=NO` mantém a coleta/filtragem anterior de somente origens selecionadas.
Ambos os modos respeitam os demais filtros e permissões, inclusive supressão PE em
`containerADefinir=1`. Os saldos adicionais não concedem elegibilidade.
`tipoUsuario` vem do chamador confiável:3/4 correspondem aos tipos com acesso
geral do PHP e desconsideram o mínimo. Os máximos são extensão deste contrato.
`tabelaPreco` é a tabela selecionada para liquidação; `tabelaPrecoFiltro` é a
tabela de elegibilidade dos itens. Valor0 no segundo campo reutiliza a primeira.

`setSelecoes(INPUT TABLE ttSelecaoSaldoPV)` recebe seleções esparsas:

| tipo | codigo | codigo2 | numero |
|---|---|---|---|
| ITEM | item | vazio | 0 |
| REF | referência | vazio | 0 |
| ESTAB | estabelecimento | vazio | 0 |
| LOCAL | estabelecimento | depósito | 0 |
| CONTAINER | vazio | vazio | número do container |
| PRECO | item elegível na tabela escolhida | vazio | 0 |
| LIQUIDACAO | item elegível | referência ou `*` para todas | 0 |
| CONTAINER_A_DEFINIR | vazio | vazio | container previamente resolvido |

Flags `selecao*Ativa` distinguem ausência de filtro de seleção ativa vazia.
Seleção ativa vazia não abre a consulta. PRECO, LIQUIDACAO e
CONTAINER_A_DEFINIR são overrides opcionais, somente quando
`usarSelecoesEspeciais=YES`. No modo padrão a própria BO resolve esses critérios:
preços ativos em `controle_preco`; liquidações em `liquida-ima` ou
`controle_preco`, conforme parâmetro IMA; containers a definir por
`log_rota_indefinida=YES`, origem1 e situação1. `containerADefinir=1` suprime PE.
O modo de override preserva o uso de conjuntos explicitamente resolvidos pelo
chamador, inclusive conjunto vazio; não é necessário para o processamento padrão.

`estabADefinir`:0=todos,1=container com rota indefinida,2=demais containers.
PI usa o estabelecimento do cabeçalho `pp-container.cod-estabel`, inclusive na
seleção explícita. Não usa `pp-it-container.cod_estab_definido` para esses filtros.

PE usa estabelecimentos explícitos com todos os depósitos, como a função PHP.
Sem esse filtro, usa locais explícitos ou todos os locais da empresa.
`getRegsLocaisPorEmpresa` não restringe data, grupo ou usuário: a BO não inventa
esses filtros. Pares duplicados não multiplicam a coleta física. Isso é seleção
de estoque; autorização do chamador pertence à aplicação consumidora.

### Pedidos web

`considerarWeb=YES` usa por padrão `situacoesCarrinho=1,8,9` e
`situacoesNaoIntegradas=2,5`, valores confirmados nos helpers reais.
O chamador pode substituir as listas, sem espaços, ou informar `NENHUMA` para
um conjunto deliberadamente vazio. Elas devem conter inteiros positivos e ser
disjuntas; nenhum estado é inferido a partir de `<>4`. Quando `considerarWeb=NO`, a saída
não inclui esses descontos e **não representa o saldo completo do portal**.

PE restringe web ao estabelecimento e container0. PI detalhado usa o container
exato; PI por item usa todos os containers diferentes de0. O helper PHP ignora
estabelecimento nesses dois modos PI, inclusive quando ele é informado na chamada;
essa assimetria foi mantida e coberta por testes.

## Cálculo e granularidade

PE: `qtFisica - qtPedidos - qtNFAberta - qtCarrinho - qtNaoIntegrada`.
PI: `qtDisponibilizada - qtVendida - qtCarrinho - qtNaoIntegrada`, sendo
`qtDisponibilizada = qt-pedida * perc-dsp-venda / 100`.
Carrinho do login é informativo; não é somado de volta. Cada componente permanece
na TT de saldos para conferência. Estado web jamais entra em dois componentes.

PE só coleta linhas físicas positivas e com referência igual ao lote.
Pedidos ERP: PE, itens situação 1/4, estabelecimento da linha, sem filtro extra
de situação de cabeçalho. Notas: faturada[1], sem cancelamento/confirmação,
chave estabelecimento+série+número e exclusão das naturezas vinculadas.
PI considera containers situação 1 e quantidade disponibilizada positiva;
exclusivos exigem permissão quando há representante positivo. Representante0/não
informado não acrescenta essa restrição, como o PHP. Tipos3/4, se pertencentes ao
grupo5, excluem containers com `log-1=YES`, salvo os containers considerados no
filtro a definir. Essa exceção não ignora a permissão de representante positivo.
Login, tipo e representante devem ser derivados do contexto confiável do chamador.

O saldo é detalhado por referência quando `porReferencia`, mínimo positivo ou
máximo configurado; PI também detalha quando há filtro de estabelecimento a
definir. Sem detalhamento, referência de saída é vazia. PE agrega por
estabelecimento/item/referência. PI por item agrega containers por estabelecimento;
PI detalhado preserva container e identidade da linha física em `linhaOrigem`
(ROWID textual temporário, não identidade persistente para gravação).
Duas linhas PI de30 não viram60 antes de um mínimo40. Os mínimos são aplicados
por linha e origem; o item sobrevive quando há aprovação e total válido.
PE e PI não se compensam para atingir o mínimo. Unidades do helper:KG e M/MT;
outras, inclusive MTS, usam mínimo0.

No PE por item, a seleção de referências restringe físico/pedidos/NF, mas web
considera todas as referências do item/estabelecimento/container, preservando a
chamada PHP com `codRefer=''`. No nível por referência, web usa a referência exata.

### Diferenças deliberadas e paridade pendente

- PE agrega linhas físicas por chave lógica para descontar reservas uma vez.
  O PHP de nível 2 sem depósito fechado não agrupa, podendo repetir descontos
  em múltiplos depósitos. A BO não reproduz essa repetição.
- Não usa sentinela `*` para representar todos os saldos; usa referência vazia
  no resultado agregado e flag de detalhamento.
- A extensão de item é obrigatória, nunca é criada durante a consulta, e falha real de leitura
  não é tratada como extensão ausente.
- Não há teto arbitrário de 99.999/99.999.999; máximo aberto é `?`.
- O PHP substitui o saldo de cada linha pelo total filtrado do item. A BO oferece
  esse valor em `qtSaldoItem` e mantém o saldo real em `qtSaldoVenda`, evitando
  que consumidores multipliquem totais repetidos por número de linhas.
- Não reproduz o bug de sobrescrever `qt_minima` de todos os itens pelo mínimo do
  último item processado; a verificação final usa a unidade do próprio item.
- Foi preservado o efeito literal do filtro tabela1/ERP: `getPrecoTbERP` sempre
  retorna array e o chamador usa `is_array`, portanto elegibilidade não depende de
  `log_achou`. Com parâmetro `buscar_preco_tb_erp=0`, consulta `controle_preco`.
- Foi preservado o filtro de liquidação vazio: o PHP omite o predicado quando
  nenhuma liquidação é encontrada. Um override explícito vazio continua restritivo.
- `itemContem` continua sendo pesquisa literal por código. Faixas, ITEM e demais
  propriedades são tipadas. O global `gerarFiltroTermo`, chamado na busca textual
  livre por descrição do PHP, foi localizado posteriormente no aplicativo
  `ctrl_filtro_estoq_unificado` durante a comparação real da página em20/10.
  Essa pesquisa agora está implementada em `pesquisaItem`; `itemContem` mantém seu
  contrato anterior. Não aceitar fragmentos SQL. A comparação histórica de quatro
  itens na página versus zero na BO foi corrigida neste novo parâmetro.

As regras principais de PI, web, preços, liquidação, grupos e mínimos foram
confrontadas; não declarar paridade integral de todo o payload PHP em virtude das
diferenças deliberadas e da busca textual acima. Parâmetros IMA são lidos pela
include canônica `sursum-api/includes/parametros_ima.i`, direta NO-LOCK e sem cache.

## Exemplo de chamada (consulta sem descontos web)

```abl
{esbo/boSaldoPV.i}
DEFINE VARIABLE hBo AS HANDLE NO-UNDO.

CREATE ttFiltroSaldoPV.
ASSIGN ttFiltroSaldoPV.empresa = "5"
       ttFiltroSaldoPV.itemIni = "EXEMPLO"
       ttFiltroSaldoPV.itemFim = "EXEMPLO"
       ttFiltroSaldoPV.buscarPE = YES
       ttFiltroSaldoPV.buscarPI = NO
       ttFiltroSaldoPV.considerarWeb = NO
       ttFiltroSaldoPV.exibirAmbosSaldos = YES
       ttFiltroSaldoPV.minimoKG = 10.

RUN esbo/boSaldoPV.p PERSISTENT SET hBo.
RUN iniciar IN hBo.
RUN setParametros IN hBo(INPUT TABLE ttFiltroSaldoPV).
RUN setSelecoes IN hBo(INPUT TABLE ttSelecaoSaldoPV).
RUN selecionarItens IN hBo.
/* RUN getTTItens aqui permite inspecionar os candidatos. */
RUN preencherSaldos IN hBo.
/* RUN getTTSaldo aqui permite inspecionar os componentes antes do minimo. */
RUN filtrarSaldos IN hBo.
RUN getTTItens IN hBo(OUTPUT TABLE ttItensSaldoPV).
RUN getTTSaldo IN hBo(OUTPUT TABLE ttSaldoPV).
DELETE PROCEDURE hBo.
```

Em produção, liberar o handle também em caso de erro. Para considerar web,
habilitar o flag; os defaults agora correspondem aos helpers confirmados.
O programa não preenche preços de saída; o encapsulador PHP original também
desabilita essa busca. Seleção por preço usa o conjunto PRECO descrito acima.

## Verificação e publicação

Testes em `BoSaldoPVTest.p` e `tests/`: banco sintético físico de18 tabelas,
sem dados comerciais, rollback e conferência independente de limpeza por cultura.
Nunca publicar fixture, DF, loader, runner ou testes na pasta ERP.
`CompileSaldoPV.p` somente compila contra o schema real, sem executar a BO.

Publicação inicial em20/10/2026 às10:48 BRT: `.p/.i/.r` copiados para
`\\192.168.0.137\erp\especificos\ems2\ima\esbo`, hashes conferidos e
`boSaldo.p` original preservada. OpenEdge12.2/.42: fonte compilado sem erro
contra schema real e42 checks aprovados em cada cultura AMERICAN/EUROPEAN,
14 tabelas sintéticas vazias ao final de ambas. Revisão independente dos deltas
sem bloqueador adicional; correções de erro parcial e estados com espaço
reproduzidas em RED e confirmadas em GREEN.

Esta revisão altera a estrutura das TTs: **recompilar chamadores** e liberar
instâncias persistentes antigas antes de consumir o novo contrato. O getter de
critérios chama-se `getTTParametros` para não colidir com a função da include IMA.
**Revisão PHP publicada em20/10/2026 às11:21 BRT**, substituindo os três arquivos
da versão inicial após guarda de hashes e backup. A original `boSaldo.p` foi
preservada. OpenEdge12.2/.42:69 checks em cada cultura,18 tabelas sintéticas
vazias após ambas e compilação sem erro contra schema real. Cinco casos locais
executaram o `filtrarPorQt` PHP original com dados sintéticos. Revisão independente
confirmou o delta de identidade das linhas PI e separação de tabelas de preço.

Recibos de compilação/publicação ficam em `.runtime/bo-saldo-20261020/`.
Revisão de intervalos:81 checks por cultura em12.2/.42,18 tabelas sintéticas vazias,
compilação contra esquema real e XREF dos três caminhos. Comparação somente da etapa1
em dados reais NO-LOCK: oito cenários, quatro rodadas alternadas, zero diferenças
nos itens/campos retornados. Descartada primeira rodada para as medianas. A alternativa
final melhorou sete cenários; sem filtros passou de1392ms para1470ms. Não prometer
ganho universal. Comparações detalhadas em `docs/boSaldoPV-plano-consulta.md`.

Revisão de pesquisa/apresentação publicada em20/10/2026 às20:47BRT, somente `.p/.i/.r`
da boSaldoPV, com backup e guarda de hashes; original preservada.95 checks por cultura
AMERICAN/EUROPEAN no12.2/.42,18 tabelas sintéticas vazias, fonte contra esquema real e
XREF aprovado. Nova estrutura da TT exige recompilar chamadores e liberar instâncias
persistentes antigas. Configurar `pesquisaItem` com o conteúdo do campo Item da página.
Comparação real repetida com `tasilpar`/tipo4:14/14 cenários iguais em itens e saldos
PE/PI exibidos, incluindo CAMBRAIA e seleção de apenas uma origem. Vazio da grade
normalizado para zero, precisão de duas casas. Não é prova de paridade de preços ou
todo payloadPHP. Ver [relatório](../../docs/boSaldoPV-comparacao-pagina.md).

Consulte `compiled122-page-parity/verification.json` e `publish-page-parity-receipt.json` para o
estado desta revisão; recibos anteriores são históricos. Teste local12.8 não é prova
de publicação/validação PASOE12.2. Recompilar chamadores para incorporar novos INITIALs;
chamadores que ainda enviam fim vazio recebem a normalização interna.
O consumidor PASOE ainda precisa ser integrado e validado em `sursum-api/med`.

## Filtros internos por referência — 20/10/2026

Novo `consultaReferencias=YES` reproduz o detalhe aberto por Consultar:
detalha PE/PI e aplica mínimo por linha, inclusive para usuários 3/4; mínimo zero
preserva negativos. Retorna somente origens selecionadas. `porReferencia=YES`
sozinho continua sendo apenas a granularidade do fluxo anterior. Filtros REF,
ESTAB, LOCAL e CONTAINER usam os parâmetros/seleções existentes. O link PHP
não herda REF da lista; filtros explícitos do consumidor continuam possíveis.
Ver [contrato, exemplo e comparação](../../docs/boSaldoPV-filtros-referencias.md).

Publicado às21:19BRT: 105 checks/cultura12.2, quatro cenários reais de referências
iguais à página e regressão dos14casos anteriores da lista. Recibo vigente desta
revisão: `publish-detail-filters-receipt.json`; compilação
`compiled122-detail-filters-final/verification.json`. Nova TT exige recompilar
chamadores/liberar handles antigos. Preços e payload integral não comparados;
PASOE continua pendente de consumidor integrado.

## Programa cliente por temp-tables

`esbo/clienteSaldoPV.p` recebe `ttFiltroSaldoPV` e `ttSelecaoSaldoPV`, retorna
`ttItensSaldoPV`, `ttSaldoPV`, sucessoLOGICAL e mensagemCHARACTER. O cliente
trata origem obrigatória e oportunidade, normaliza oportunidade para PE/tabela1
em cópia local, delega a consulta e libera a BO persistente. Não reproduz o
complemento PHP sem filtros. A BO/include existentes não foram modificadas.

Ver [assinatura e exemplo completo](../../docs/clienteSaldoPV.md).

## API JSON sem persistência WP — 21/10/2026

`http-api/api_cons_estoque.p`: POST `/SursumPrograms/consulta-estoque`,
entrada/saída `JsonObject`, filtros na raiz e `selecoes` opcional. Resolve contexto
do usuário no cadastro, chama `clienteSaldoPV` e retorna `itens` e `saldos` na
resposta. Não grava WP. A BO e o cliente permanecem com os hashes anteriores.

Ver [contrato e exemplo JSON](../../docs/api-cons-estoque.md). Esta integração
substitui a pendência histórica de consumidor PASOE registrada acima.
