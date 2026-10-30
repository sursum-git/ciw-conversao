# Pedido de venda: desconsiderar por usuario

Contrato corrigido conforme pedido de 19/10/2026. `FiltroTipoUsuarioPV.p` recebe somente o login e o **ROWID de `ems2med.ped-venda`**, le os cadastros e retorna `LOGICAL`:

- `TRUE`: desconsiderar o pedido (`NEXT` na consulta chamadora).
- `FALSE`: manter o pedido quanto a esta regra de usuario/representante.

Nao monta filtro textual, nao usa consulta dinamica e nao depende de outro programa/include. A excecao do grupo 16 foi retirada. Os antigos fontes de filtro dinamico foram removidos da pasta ativa; copia historica privada em `.runtime/pedido-venda-20261019/historico-dinamico/`.

## Uso na consulta estatica existente

```abl
DEFINE VARIABLE cUsuario AS CHARACTER NO-UNDO.
DEFINE VARIABLE lDesconsiderar AS LOGICAL NO-UNDO.

cUsuario = "login-do-usuario".

FOR EACH ems2med.ped-venda NO-LOCK:
    RUN FiltroTipoUsuarioPV.p (
        INPUT cUsuario,
        INPUT ROWID(ems2med.ped-venda),
        OUTPUT lDesconsiderar
    ).
    IF lDesconsiderar THEN NEXT.

    /* Continuar o processamento e os demais filtros da consulta existente. */
END.
```

Preservar as condicoes e a ordem de consulta do chamador. O exemplo mostra apenas a posicao da chamada. O programa deve estar no PROPATH. Buffers proprios preservam o pedido corrente do chamador.

## Origem dos dados e regras

O tipo vem de **`espec.user-web.tp-usuario`**, localizado por `user-web.Login`. `peds_web` nao possui esse campo no dicionario disponivel; o ROWID informado pelo usuario foi confirmado como pertencente a `ped-venda`.

| Tipo | Comportamento |
|---|---|
| 1 | Nao acrescenta restricao de representante, como no ramo original de ped-venda |
| 2 | Exige algum `ped-repre.nome-ab-rep` igual ao login |
| 5 | Exige algum representante igual a `user-web.usuario`, vinculo do preposto |
| 3 | Reconstroi lista e hierarquia conforme o login legado; aplica lista, faixa ou gerencia |
| 4 | Usa representantes cadastrados na restricao ativa 3, quando a lista nao e vazia |

Para o tipo 3, a hierarquia vem de `espec.cm-ext-repres.tp-aplic-comis`. Hierarquia 3 fornece a lista de dependentes diretos de `espec.cm-hierarquia`; restricao ativa 3 a substitui pelos representantes de `espec.repres_restr_cliente_usuario`. Essas listas tem prioridade sobre os ajustes posteriores de diretoria/restricao ativa 1, como no PHP.

Sem lista prioritaria, grupo 6 transforma hierarquia diferente de 3 em 1; restricao ativa 1 transforma em 1. Hierarquia efetiva 1 ou 4 usa a faixa geral do login legado, de vazio a `zzzzzzzzzzzzzzzzzzzz`, sem consultar grupo 16. Nas demais hierarquias, grupo 5 usa os dependentes gerenciais. Grupos sao verificados pelo codigo exato, sem a busca por substring do PHP.

O vinculo e `ped-repre.nr-pedido = ped-venda.nr-pedido` e **`ped-repre.nome-ab-rep = ped-venda.no-ab-reppri`**. Por determinacao do usuario em 19/10/2026, somente o representante principal participa da validacao. Um secundario permitido nao libera o pedido. Em ramos restritos, pedido sem principal correspondente permitido e desconsiderado. Os ramos sem restricao adicional preservam o comportamento livre da funcao original; os outros filtros de negocio continuam no chamador.

Detalhes do legado preservados: lista de gerencia sem dependentes equivale a nome vazio (`IN ('')` no PHP); restricao ativa 3 sem representantes cadastrados nao produz lista explicita, seguindo os fallbacks da funcao original. Os nomes e as listas sao obtidos sem cache a cada chamada.

Usuario ausente/inativo, tipo desconhecido/fora de 1 a 5, preposto sem vinculo ou pedido/ROWID inexistente retornam `TRUE`. Referencia de representante/dependente inconsistente gera erro; o chamador deve propagar/tratar o erro e nao continuar usando um resultado presumido.

Leituras de banco exclusivamente `NO-LOCK`. A unica tabela criada pelo programa e uma temp-table de nomes; nao ha escrita em tabelas fisicas.

## Verificacao e estado de entrega

**Restauracao em19/10/2026 as17:10BRT:** a pedido do usuario apos sobrescrita acidental, o fonte remoto foi restaurado com a mesma versao local verificada (SHA-256 `4829F1E787A82327794796FBF6445DB4C55869DE5FA9F5DB3FBDAF09A55046BF`). Fonte sobrescrito preservado em backup privado; caminho no recibo atual `.runtime/pedido-venda-source-copy-20261019/copy-receipt.json`. Nenhuma mudanca de logica ou novo compilado nesta restauracao.

Fonte **atualizado e conferido** em 19/10/2026 as 10:26 BRT: `\\192.168.0.137\erp\especificos\ems2\ima\esapi\FiltroTipoUsuarioPV.p`. Definicoes de parametros/variaveis alinhadas e filtro do principal aplicado. Copia SMB autenticada por entrada protegida; credencial nao persistida. SHA-256 remoto identico ao local: `4829F1E787A82327794796FBF6445DB4C55869DE5FA9F5DB3FBDAF09A55046BF`. Cabecalho que o usuario alterou no servidor foi preservado apos comparacao; backup privado do fonte anterior e recibo em `.runtime/pedido-venda-source-copy-20261019/`. O recibo atual e `copy-receipt.json`. Esse destino substitui a sugestao anterior de `sursum-api/programs` para este fonte; copia do `.p` nao equivale a compilacao12.2/publicacao de `.r` ou validacao PASOE.

Em 19/10/2026, programa completo e testes compilaram sem erro no **OpenEdge 12.8 local**. **37 cenarios em cada cultura AMERICAN/EUROPEAN**, executando o proprio programa sobre banco fisico sintetico isolado; registros de fixture removidos ao terminar. Testes cobrem principal versus secundario, principal desconhecido ou sem vinculo, preposto, gerencia, diretoria, hierarquia 3, listas prioritarias, ausencia de cadastros, alteracoes sem cache e pedido eliminado. Evidencia atual em `.runtime/pedido-venda-principal-20261019/{red,green}/`; RED confirmou que o secundario liberava o pedido antes da correcao.

`FixtureFiltroPV.df`, `CarregarFixtureFiltroPV.p`, `FiltroTipoUsuarioPVStaticTest.p` e `ValidarPVEstatica.p` sao somente instrumentos de teste: **nunca carregar/executar no ERP ou publicar no PASOE**. O runner exige uma unica conexao a banco sintetico cujo caminho contenha `pedido-venda-fixture`; aliases locais representam os tres bancos apenas na fixture. O schema sintetico verifica sintaxe e comportamento, nao substitui a compilacao contra o dicionario real. Evidencias em `.runtime/pedido-venda-20261019/{red,green}/`.

**Pendente:** compilacao oficial no OpenEdge 12.2/.42 contra os bancos reais, publicacao pertinente e validacao no consumidor em sursum-api/med. SSH por chave foi novamente recusado em 19/10/2026 (`Permission denied (publickey,password,keyboard-interactive)`). Nenhum `.r`12.8 foi salvo/publicado, nenhuma rota criada e nenhum banco real acessado/alterado nesta correcao.
