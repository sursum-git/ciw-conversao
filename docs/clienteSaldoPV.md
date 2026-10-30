# Cliente ABL da boSaldoPV

Programa: `esbo/clienteSaldoPV.p`. Contrato reutilizado:
`esbo/boSaldoPV.i`. Recebe duas temp-tables, chama a BO persistente, devolve
resultados e libera a instância em sucesso ou erro. Não escreve dados comerciais
e não refaz consultas complementares sem os filtros originais do chamador.

## Assinatura e exemplo

```progress
{esbo/boSaldoPV.i}
DEFINE VARIABLE lSucesso AS LOGICAL NO-UNDO.
DEFINE VARIABLE cMensagem AS CHARACTER NO-UNDO.

CREATE ttFiltroSaldoPV.
ASSIGN ttFiltroSaldoPV.empresa = "5"
       ttFiltroSaldoPV.login = "tasilpar"
       ttFiltroSaldoPV.tipoUsuario = 4
       ttFiltroSaldoPV.pesquisaItem = "175182"
       ttFiltroSaldoPV.buscarPE = YES
       ttFiltroSaldoPV.buscarPI = YES
       ttFiltroSaldoPV.selecaoEstabsAtiva = YES.

CREATE ttSelecaoSaldoPV.
ASSIGN ttSelecaoSaldoPV.tipo = "ESTAB"
       ttSelecaoSaldoPV.codigo = "5".

RUN esbo/clienteSaldoPV.p(
    INPUT TABLE ttFiltroSaldoPV,
    INPUT TABLE ttSelecaoSaldoPV,
    OUTPUT TABLE ttItensSaldoPV,
    OUTPUT TABLE ttSaldoPV,
    OUTPUT lSucesso,
    OUTPUT cMensagem).

/* lSucesso=YES pode retornar tabelas vazias: consulta valida sem saldo.
   lSucesso=NO retorna mensagem e ambas as tabelas vazias.
   Consumir as tabelas na interface do programa chamador. */
```

É necessário exatamente um registro em `ttFiltroSaldoPV`. Criar a linha aplica
os INITIALs da include: empresa5, ambas as origens, intervalos de item/família
de vazio até14z, grupos50..60, mínimos0 e demais parâmetros já documentados da BO.
Login, tipo de usuário e representante devem ser os do contexto do chamador.

`ttSelecaoSaldoPV` pode estar vazia; recebe conjuntos ITEM, REF, ESTAB, LOCAL,
CONTAINER e seleções especiais conforme o contrato existente. Ativar o indicador
do conjunto em `ttFiltroSaldoPV`. Uma seleção ativa vazia continua significando
nenhum registro, não ausência de filtro.

Os resultados de `ttItensSaldoPV` são os totais por item; `ttSaldoPV` contém as
linhas/componentes e a granularidade solicitada. Não há TT de parâmetros textual
nem montagem de SQL: os critérios são os campos tipados da include.

## Tratamento do cliente

- Sem PE nem PI, retorna sucessoNO/mensagem e tabelas vazias.
- Oportunidade (`soLiquidacao=YES`) sem PE também é rejeitada.
- Oportunidade válida usa somente PE para elegibilidade e tabela de liquidação1.
  `tabelaPrecoFiltro` permanece independente. `exibirAmbosSaldos` continua
  controlando a exibição das duas origens segundo os filtros recebidos pela BO.
- Demais validações são delegadas à BO. Falhas da BO são convertidas em statusNO
  e mensagem, com saídas vazias; nenhum resultado anterior é reaproveitado.
- A normalização ocorre em cópia local. As entradas são preservadas também
  quando o chamador usa `BY-REFERENCE`.
- A instância persistente da BO é liberada em `FINALLY`; não fica compartilhada
  entre chamadas.

Para o detalhe, definir `consultaReferencias=YES` e os critérios desejados.
Ao simular especificamente o link Consultar do PHP, o chamador deve remover a
REF herdada da lista, pois o link PHP a descarta. Uma seleção REF explicitamente
enviada ao cliente é respeitada; ele não a limpa automaticamente.

O programa requer os bancos lógicos `ems2med` e `espec` e o PROPATH da instalação
que já atende a boSaldoPV. Não abre conexões, troca empresa operacional ou
autentica usuários por conta própria. A include de parâmetros IMA e os cálculos
continuam centralizados na BO, sem cache adicional.

## Validação e implantação

Compilação oficial OpenEdge12.2/.42 contra schema real aprovada. Suite do cliente:
62 checks por cultura AMERICAN/EUROPEAN; regressão da BO:105 por cultura. As18
tabelas sintéticas ficaram vazias após cada suite/cultura. Testes incluem REF sem
complemento PHP, detalhe/mínimo, oportunidade/normalização de tabela, entrada por
referência, isolamento de saídas, erros e ausência de instâncias persistentes.
Revisão independente sem bloqueador.

Publicado em21/10/2026 às11:33 BRT, somente `clienteSaldoPV.p` e `.r`, em
`\\192.168.0.137\erp\especificos\ems2\ima\esbo`. Publicação conferida por hash;
boSaldoPV.p/.i/.r e boSaldo.p original preservadas. A include não foi alterada.

Recibos privados em `.runtime/bo-saldo-cliente-20261021/compiled122/verification.json`
e `publish-receipt.json`. Não publicar os testes, DF, loaders ou runners.
Cinco chamadas reais do cliente foram executadas no12.2/.42 com leiturasNO-LOCK
dos bancos111, login tasilpar/tipo4: consulta normal50/18200, REF A01 com somentePE
-1/11200 (sem complemento PHP), detalhe com mínimo2 e3linhas, oportunidade
normalizada com resultado vazio e rejeição de oportunidade semPE. As cinco
passaram; hashes do cliente/BO executados correspondem aos recibos publicados.
Evidências `live/bo-resultados.json` e `final-verification.json` na pasta privada.
Integração/validação por um consumidor PASOE `sursum-api/med` permanece pendente;
o contrato entregue aqui é a chamada ABL por temp-tables.
