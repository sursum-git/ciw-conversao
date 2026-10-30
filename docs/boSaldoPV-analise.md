# boSaldoPV: mapeamento inicial — 19/10/2026

Estado atualizado em 20/10/2026: **boSaldoPV implementada e copiada ao .137**
em versão independente, conforme as três etapas determinadas pelo usuário.
Fonte/include em `integration-src/saldo-pv/esbo/`; `.p/.i/.r` em
`\\192.168.0.137\erp\especificos\ems2\ima\esbo`. Compilação contra schema real
e testes em banco sintético no OpenEdge12.2/.42: **42 checks em cada cultura**,
14 tabelas vazias após ambas. Original preservada por hash. Recibo privado
`.runtime/bo-saldo-20261020/publish-receipt.json`.

Contrato e diferenças efetivas: [README da nova BO](../integration-src/saldo-pv/README.md).
**Revisão prevalente às11:21 BRT:** helpers reais do IOL/.170 foram obtidos e
confrontados. Defaults web agora1/8/9 e2/5; preço, liquidação e containers a definir
resolvidos internamente; PI usa estabelecimento do cabeçalho, agrega por item no
nível correspondente e preserva linhas físicas no detalhado; mínimos seguem o
total por item/origem e exceção dos tipos3/4. Parâmetros IMA pela include canônica,
direta NO-LOCK/sem cache. TTs alteradas: recompilar chamadores. Validação oficial
agora **69 checks/cultura**,18 tabelas limpas e compilação real12.2 sem erro.
Recibo vigente `.runtime/bo-saldo-20261020/publish-php-receipt.json`, com backup da
versão anterior e hashes conferidos. A seção abaixo é histórica. Diferenças
deliberadas/limitação da busca textual permanecem documentadas no README;
não declarar paridade integral de todo o payload.
Nenhuma rota/consumidor integrado nesta entrega; **PASOE sursum-api/med pendente**.
A análise e os bloqueios abaixo descrevem a etapa histórica anterior.

## Escopo e origem

O ponto de entrada anexado chama-se `getFiltroEstoqUnicoItem`, embora o pedido
mencione `getFiltroEstoqueUnico`. A equivalência entre esses nomes não foi
verificada. O segundo anexo contém `buscarSaldoEstoque`, `buscarQtPedida` e
`buscarQtNFSemAtuEst`.

O objetivo é criar `esbo/boSaldoPV.p` preservando a BO original, substituir filtros
SQL por critérios tipados, consultas estáticas e tabelas temporárias intermediárias,
e documentar diferenças reais após ler a BO e seus includes/consumidores.
Contrato público e compatibilidade de assinatura dependem dessa leitura.

## Fluxo comprovado nos anexos

1. `getListaItensFiltroEstoqUnico` seleciona itens por família, item, unidade,
   gramatura, peso líquido, tabela de preço com saldo e empresa. Distingue ausência
   de filtro de filtro aplicado sem resultado. Neste último caso não consulta PE/PI.
2. Referências podem ser uma seleção múltipla. Não equivalem necessariamente a
   uma faixa contínua: a implementação ABL deve preservar seleções esparsas em TT.
3. Opção 1 consulta estoque físico PE; opção 2 consulta programação PI. A saída
   reúne itens distintos das duas origens, mantendo os saldos PE e PI separados.
   Sem opções, o PHP não executa esses ramos.
4. PE é suprimido quando `containerADefinir = 1`. O ramo chama explicitamente
   empresa `'5'`, independentemente da empresa usada na seleção inicial de itens.
5. PE aplica liquidação somente quando solicitada e usa nível 2 se a soma dos
   mínimos KG/MT for positiva; caso contrário, nível 1. Depois aplica `filtrarPorQt`
   sobre `qt_saldo_venda` e extrai os itens sobreviventes.
6. PI usa nível referência quando estabelecimento a definir é 1/2 ou há mínimo;
   nos demais casos usa item. Quando container a definir é 1, intersecta containers
   a definir e disponíveis; interseção vazia vira predicado container zero.
7. PI exige `(qt-pedida * perc-dsp-venda / 100) > 0` na seleção. A expressão ativa
   não subtrai `qt-vendida`; a expressão comentada não é regra executável.
8. PI aplica `filtarEstabADefinir` e depois `filtrarPorQt` sobre
   `qt_saldo_com_carrinho`. A semântica dessas funções ainda precisa ser coletada.

## Estoque físico: regras para a comparação

| Aspecto | Comportamento PHP comprovado |
|---|---|
| Saldo físico | Somente `qtidade-atu > 0` e `cod-refer = lote` |
| Locais | Estabelecimento explícito usa IN e substitui `getFiltroLocaisEstoque`; sem estabelecimento, usa locais configurados |
| Locais configurados | Cópia local de `getFiltroLocaisEstoque` monta OR de pares estabelecimento/depósito obtidos por `getRegsLocaisPorEmpresa` |
| Nível 1 | Soma por estabelecimento + item; referência de saída vazia |
| Nível 2 | Sem depósito fechado: devolve linhas físicas, sem GROUP BY; com depósito fechado: soma por estabelecimento + item + referência |
| Pedidos | Soma `ped-item.qt-pedida`, situações 1/4, cabeçalho PE, estabelecimento corrente, join por cliente abreviado + pedido cliente |
| Notas abertas | Soma `it-nota-fisc.qt-faturada[1]`, sem cancelamento e sem confirmação, chave estabelecimento + série + número |
| Exclusão fiscal | Exclui natureza da nota existente como `natur-oper.nat-vinculada` não vazia |
| Referências nos descontos | No nível 1 a seleção explícita de referências continua aplicada a pedidos/notas; no nível 2 também aplica referência corrente |
| Carrinho | Consulta geral e login corrente por item/referência, container zero e estabelecimento corrente |
| Não integrado | Consulta por item/referência, container zero e estabelecimento corrente |
| Fórmula | físico − pedidos − notas abertas − carrinho geral − não integrado |
| Carrinho do login | Informado separadamente; não é somado de volta ao saldo de venda |
| Campos | `qt_pedido` inclui notas abertas; `qt_disp` é saldo físico; container zero, moeda real e previsão vazia |
| Preços/dados de item | O encapsulador desabilita ambas as buscas, mas habilita carrinho |
| Sem resultado | PHP usa string vazia em alguns retornos; em ABL uma TT vazia é representação candidata, com adaptação explícita de contrato |

Pontos a decidir após comparação: não corrigir silenciosamente empresa fixa 5,
substituição de locais por estabelecimento explícito, nem repetição dos descontos
em múltiplas linhas físicas do nível 2. São comportamentos observáveis do legado,
não defeitos confirmados da BO. As variáveis de depósito fechado ainda são
calculadas no PHP; seus antigos OR de estabelecimento/depósito estão em comentário
e não compõem a condição ativa. O indicador ainda altera a agregação do nível 2.

## Estrutura ABL candidata

Entrada por TT reutilizável de critérios, respeitando a preferência vigente do
projeto; campos de intervalo para atributos ordenáveis e TT de seleções para
itens, referências, estabelecimentos e containers. Critérios sem resultado não
podem transformar-se em ausência de restrição.

Fases: selecionar itens elegíveis; resolver locais e containers; coletar PE/PI em
TTs separadas na granularidade exigida; coletar descontos por chave; calcular
saldos; aplicar mínimos por unidade conforme helper original; unir itens distintos.
Preservar estabelecimento nas chaves. Usar buffers próprios/NO-LOCK e nenhuma
escrita de negócio. Não antecipar predicados de quantidade antes da agregação sem
comprovar equivalência. Preços e regras compartilhadas devem reutilizar rotinas
existentes quando identificadas. Parâmetros IMA pela include `parametros_ima.i`,
leitura direta sem cache.

## Dependências ainda necessárias

- BO original `esbo/boSaldo.p`, includes, TTs e chamadores pertinentes.
- `getListaItensFiltroEstoqUnico`, `filtrarPorQt`, `getQtsPI`,
  `filtarEstabADefinir`, `getContainersADefinir`, `getListaContainersDisponiveis`.
- `getFiltroLiquidaIma`, `getQtCarrinho`, `getQtCarrinhoLoginCorrente`,
  `getQtNaoIntegrada`, `getRegsLocaisPorEmpresa`, `getDadosEmpresa`.
- Helpers de depósito fechado e, se a nova BO mantiver consulta direta com preços,
  `buscarPreco`, descrição do item e ordem da referência.

## Verificações previstas

Comparar PE/PI isolados e unidos; filtro ausente versus vazio; listas esparsas;
limites inclusivos de intervalos; mínimos KG/MT por unidade; estabelecimento e
depósito; referência/lote; múltiplas linhas físicas; cada desconto separadamente;
notas canceladas/confirmadas/natureza vinculada; container/estabelecimento a definir;
liquidação e mudança de granularidade. Usar somente dados novos de teste e limpar
ao terminar. Compilar oficialmente no OpenEdge 12.2/.42 e validar o consumidor
real no PASOE `sursum-api/med`; diagnóstico local 12.8 não substitui essas etapas.

## Bloqueio de acesso observado

Consulta SMB não autenticada negou acesso à pasta candidata; tentativa externa
posterior não encontrou o arquivo no caminho candidato
`\\192.168.0.137\erp\especificos\ems2\ima\esbo\boSaldo.p`. Isso não comprova o
caminho real da BO. SSH somente leitura, com hostkey obrigatória e BatchMode,
expirou para `.111` e `.170`. Necessário disponibilizar o fonte original e os
helpers ou restabelecer acesso protegido. Nenhuma credencial foi persistida.

### Nova tentativa — 20/10/2026

A porta SMB 445 do `.137` respondeu. A porta SSH 22 recusou conexão.
`net view` retornou erro de sistema 5 (acesso negado); leitura da raiz ERP pela
API de diretórios retornou nome de usuário ou senha incorretos (HRESULT
-2147023570). Portanto, as mensagens de caminho não encontrado do PowerShell
não comprovam ausência do compartilhamento ou da BO: o bloqueio atual
identificado é autenticação SMB. Nenhuma sessão SMB autenticada do `.137` foi
identificada pelo comando de consulta, que também não terminou com sucesso.
Nenhuma senha foi solicitada em texto, armazenada ou reutilizada de arquivos.
Necessário autenticar o compartilhamento por entrada protegida antes de localizar
o fonte e comprovar os parâmetros/divergências.

## Avaliação da BO real — 20/10/2026

Fonte confirmado: `\\192.168.0.137\erp\especificos\ems2\ima\esbo\boSaldo.p`,
23.875 bytes, SHA-256
`C539F69B1669E74077404A1CCB8A6090CACCB36BE76DAD4C7BA1FB8E9F632FFF`.
Cópia privada em `.runtime/bo-saldo-20261020/boSaldo.p`. Também lidos
`boSaldo.i`, `boWeb100.p`, `boPermisRepres.p`, `boRepres.p`, `BoConsParam.p`,
`esp/util.i`, `ImplboSaldo.p`, `boSaldo2.p/.i`, `implBoSaldo2.p` e
`boGetItemSaldoPreco.p`. Essas leituras não executaram as BOs nem consultaram
registros de negócio. Credencial usada somente em entrada protegida; não salva.

**Conclusão: a interface atual permite reaproveitar a estrutura de consulta,
mas não existe uma combinação de parâmetros que produza paridade com o PHP.**
Faltam critérios de seleção, dimensões do resultado e etapas de cálculo.

### Interface efetivamente disponível

Entrada persistente: `RUN esbo/boSaldo.p PERSISTENT SET hBoSaldo`, seguida de
`iniciarBos`. A consulta principal é:

```abl
RUN getSaldoItemRef IN hBoSaldo (
    INPUT pSaldoPorItem,  /* LOGICAL: YES=item; NO=item/ref exata */
    INPUT pBuscarPE,      /* LOGICAL */
    INPUT pBuscarPI,      /* LOGICAL */
    INPUT pConsiderarNeg, /* LOGICAL */
    INPUT pItem,          /* CHARACTER: um item exato */
    INPUT pRef,           /* CHARACTER: uma referencia exata */
    INPUT qtMin,          /* DECIMAL: minimo para a unidade do item */
    INPUT qtMax           /* DECIMAL: maximo para a unidade do item */
).
RUN getTTSaldo IN hBoSaldo (OUTPUT TABLE ttSaldo).
```

A include é `esbo/boSaldo.i`. `setFiltro` reconhece somente `it-codigo`,
`cod-refer`, `qt_min_kg`, `qt_max_kg`, `qt_min_mt` e `qt_max_mt`. Há setters
de login, carrinho, negativos, saldo por item e modo incremental; procedimentos
de locais e de pedidos são públicos, mas isso não os integra automaticamente
ao cálculo principal. `finalizarBos` encerra auxiliares; não deleta a própria
instância `hBoSaldo`, que deve ser liberada pelo chamador.

Para aproximar a **coleta bruta** do PE: buscar PE=YES, PI=NO,
considerar negativos=NO e escolher por item quando não há mínimo, por referência
quando há mínimo. Isso ainda NÃO produz o saldo de venda PHP, e negativos no
ramo por referência nem sequer respeitam o setter. Não usar essa chamada como
substituta equivalente em produção.

### Diferenças comprovadas e alterações necessárias

| Tema | Fonte atual | Alteração necessária |
|---|---|---|
| Orquestração | `getSaldoItemRef` (593–623) limpa TTs, carrega locais, coleta PE/PI e filtra quantidade; não chama procedimentos de pedidos/carrinho | Inserir coleta de descontos e cálculo líquido antes dos mínimos |
| Saldo de venda PE | Não existe campo/cálculo líquido | físico − pedidos PE − NF abertas − carrinho geral − não integrados; carrinho do login separado |
| Pedidos ERP | `getQtPedidosEmAberto` (492–523) exige cabeçalho situação 1 e item situação 1, referência exata e não filtra estabelecimento | Para equivalência do anexo, itens 1/4, tipo PE, estabelecimento da linha e seleção de referências; não acrescentar situação de cabeçalho sem evidência no PHP |
| Notas abertas | Não há consulta correspondente | Incluir quantidade faturada[1], sem cancelamento/confirmação, chave completa da nota e exclusão por natureza vinculada |
| Não integrados | `getQtPedidosNaoIntegrados` (526–568) percorre itens web, mas soma `ped-item.qt-pedida` nas três acumulações | Usar quantidade da linha web; confirmar estados/tipo/estabelecimento/container pelos helpers PHP antes de codificar |
| Separação PE/PI web | `pTipo` escolhe campo de saída, mas não restringe registros web por tipo/container; carrinho faz parte do total acumulado | Separar estados e origens conforme helpers, evitando dupla subtração |
| Acumulação dos pedidos | Helper ERP e helper web atribuem ao mesmo campo `qt_pedida_pe` quando modo incremental é NO | Guardar componentes separados e calcular explicitamente; ligar dois RUNs não basta |
| Modo por item | Saldo grava referência `'*'`; helpers de pedidos usam `cRef` e igualdade exata | Usar chave canônica única e agregar referências selecionadas; não procurar referência vazia como se significasse todas |
| Percentual PI | `getSaldoProgramado` (272–316) calcula `qt-pedida * perc-dsp-venda` | Aplicar `/ 100`, como no PHP; sem isso, percentual 50 e quantidade 100 geram 5000 em vez de 50 |
| Disponibilidade PI | Soma programado e vendido, sem cálculo líquido e sem o predicado PHP de quantidade disponibilizada positiva | Reproduzir `getQtsPI`, inclusive `qt_saldo_com_carrinho`, após obter sua implementação |
| Permissões de container | `LOOKUP(cListaPermContainer, STRING(nr-container))` (285/303) usa lista como elemento; código de representante da auxiliar não é configurado pela BO | Inverter argumentos do LOOKUP; configurar identidade/representante pela origem confiável e comparar escopo com o PHP |
| Chave/saída | `boSaldo.i`: chave única item+referência, sem estabelecimento/container | TT própria para PV com estabelecimento, item, referência, origem e granularidade necessária de container/linha; gerar lista distinta de itens no final |
| Locais | `getSaldoItemRef` limpa `ttEstabDepos` e recarrega todos os locais ativos via `boWeb100`; locais inseridos antes são perdidos | Receber locais/estabelecimentos explícitos e evitar que sejam substituídos; distinguir modo locais configurados de modo estabelecimento explícito do PHP |
| Repetição de consultas | `boWeb100.exec` cria linhas sem esvaziar sua `ttResult`; `ttEstabDepos` não tem índice único | Limpar resultado a cada execução e deduplicar pares; repetições/locais sobrepostos podem contar o mesmo saldo mais de uma vez |
| Saldo negativo | No nível item, negativos viram zero quando desabilitados; por referência, soma todos | Para PE do PHP, selecionar somente linhas físicas positivas em ambos os níveis |
| Granularidade PE | BO agrega todos os locais por item/ref; PHP preserva estabelecimento e, no nível 2 sem depósito fechado, linhas físicas | Preservar granularidade comprovada ou registrar mudança deliberada; não agregar antes de avaliar efeito dos descontos repetidos por linha |
| Mínimos | `filtrarQt` (367–389) compara PE bruto + PI bruto | Filtrar PE por saldo de venda e PI por saldo com carrinho, separadamente; depois unir itens |
| Estado de filtros | `limparTTs` não reinicia limites/lFiltroQt; setter liga o flag e não o desliga; máximo compara 99999 mas inicia 99999999 | Reinicializar critérios por execução e validar tipos/faixas; evitar dependência da consulta anterior |
| Auditoria de pedidos | `inserirTtPedsEmAberto` recebe `ptipoPed`, mas não atribui `ttPedidosEmAberto.tipoPed` | Preencher origem/tipo e manter componentes rastreáveis |
| Carrinho configurável | `lConsiderarCarrinho` é apenas atribuído, sem leitura no cálculo principal | Tornar flag efetivo e definir separadamente inclusão do geral e informação do login |
| Seleção inicial | Só item/ref exatos; sem família/unidade/gramatura/peso/tabela de preço/liquidação | Resolver candidatos por consultas estáticas e TTs; não usar SQL de entrada |
| A definir | Sem filtros efetivos de estabelecimento/container a definir; variáveis de intervalo de container não usadas | Aplicar regras do encapsulador antes e depois da coleta, conforme helper de cada estágio |

Os defeitos acima são conclusões de leitura do fonte, não reprodução em AVM.
Em particular, `ped-item` fora do laço pode estar indisponível ou carregar um
buffer de outra operação; não foi executado para provocar erro em produção.
Algumas leituras auxiliares também omitem NO-LOCK; a versão de consulta deverá
usar buffers próprios/NO-LOCK consistentemente.

### Contrato recomendado para boSaldoPV (proposta, ainda não implementada)

Preservar `boSaldo.p` e sua include para os consumidores existentes. A versão PV
deve ter include e TTs próprias, evitando quebrar assinaturas compiladas antigas.
O recebimento por TT é uma proposta para esta BO, alinhada à preferência recente
do projeto, e não uma característica da interface atual.

| Entrada proposta | Conteúdo e finalidade |
|---|---|
| `ttFiltroSaldoPV`, exatamente uma linha | Empresa/conexão lógica validada pelo chamador, login confiável, buscar PE/PI, considerar carrinho, KG/MT mínimos independentes, só liquidação, tabela de preço, estabelecimento/container a definir |
| Faixas tipadas nessa TT | Família/item, gramatura, peso líquido, estabelecimento e container quando aplicáveis; limites abertos explícitos e validação de faixa invertida |
| `ttSelecaoItem` e `ttSelecaoReferencia` | Valores exatos/esparsos sem expandir IN para intervalo contínuo |
| `ttLocalSaldoPV` | Pares estabelecimento/depósito para locais configurados; estabelecimento explícito precisa de modo próprio, pois no PHP não restringe depósito |
| `ttSelecaoContainer` | Interseção dos containers a definir e disponíveis; seleção ativa vazia deve retornar vazio, nunca abrir o filtro |
| Indicadores de seleção ativa | Diferenciar lista não informada de lista informada sem resultado |

A empresa não muda automaticamente os bancos conectados por receber um CHARACTER.
ABL deve usar a conexão/alias ou implementação estática apropriada. O PHP
encapsulador chama PE com empresa 5; manter ou generalizar isso exige decisão
explícita, sem misturar bancos IMA/MED.

Se o contrato permanecer no nível do encapsulador, a granularidade é derivada:
PE por referência quando houver mínimo; PI por referência quando houver mínimo
ou filtro de estabelecimento a definir 1/2. Se também precisar substituir chamadas
diretas de `buscarSaldoEstoque`, expor nível, buscar preço e buscar dados do item
separadamente. Para o encapsulador esses últimos dois são FALSE, mas seleção
por tabela de preço continua necessária.

Saídas: TT PE e TT PI separadas com cada componente de quantidade e chaves
completas; TT de itens distintos sobreviventes. O carrinho do login é informativo
no PE. Cálculo/seleção compartilhados devem ficar em rotinas reutilizáveis, sem
duplicar fórmulas. Parâmetros IMA em eventual API pela include obrigatória
`sursum-api/includes/parametros_ima.i`, direta NO-LOCK e sem cache.

### Limites desta avaliação e próximos passos técnicos

`ImplboSaldo.p` é apenas um esqueleto: a chamada de consulta está comentada.
`boGetItemSaldoPreco.p` também contém rotinas incompletas e não resolve a
orquestração. `boSaldo2.p` é voltada ao BOT e declara não tratar alocação PE nem
permissões PI; não substitui o fluxo PHP. Sua coleta PE marca existência sem
exigir saldo positivo, portanto também não serve como seleção equivalente.

Ainda faltam implementações PHP de `getQtsPI`, seleção de itens, mínimos,
carrinho, não integrados, liquidação e filtros a definir. O acesso disponibilizado
nesta etapa foi SMB no `.137`; não foi presumida autorização para reutilizar a
senha em outros serviços. Sem esses helpers, a parte PI e seus estados não podem
ser declarados equivalentes. A nova BO deve ser implementada após fechar essas
regras, com casos isolados para cada diferença e validação oficial 12.2/PASOE.

Nenhum teste de negócio, compilação, modificação remota, rota ou publicação foi
feito nesta avaliação. A BO original e os registros existentes foram preservados.
