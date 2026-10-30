# Consulta de notas fiscais e devolucoes

Publicado em 20/10/2026 no ERP .137 e no checkout canonico motor-progress/v2. API validada no PASOE sursum-api/med, HTTPS 9911: tres rejeicoes sem gravacao e uma pesquisa vazia com commit fisico conferido. Cabecalho marcado removido apos comparar a imagem completa; nenhum registro de teste restante. Dados de linhas reais foram exercitados em fixture sintetica, sem criar notas/pedidos no ERP.

O chamador recebe uma linha de parametros, configura duas BOs persistentes por procedimentos e agrega os resultados em tt-NF. A API recebe JSON e persiste a pesquisa em espec.wp e espec.wp_nota_fiscal. Contrato JSON e mapeamento dos 18 campos: [README-API.md](README-API.md).

## Chamador reutilizavel

```progress
{esapi/consulta-notas/ttFiltroDevolucoes.i}
{esbo/boConsNotaFiscal.i}

CREATE ttFiltroDevolucoes.
ASSIGN ttFiltroDevolucoes.empresa = "MED"
       ttFiltroDevolucoes.estabel-de = "5"
       ttFiltroDevolucoes.estabel-ate = "505"
       ttFiltroDevolucoes.emissao-de = DATE(1,1,2026)
       ttFiltroDevolucoes.emissao-ate = TODAY.

RUN esapi/consulta-notas/ConsultarNotasFiscais.p
    (INPUT TABLE ttFiltroDevolucoes, OUTPUT TABLE tt-NF).
```

Exatamente um registro de parametros. Todos os limites sao inclusivos e independentes; ? abre limites numericos/datas e texto vazio abre limites CHARACTER. Zero e um limite real. Faixa invertida gera erro. A entrada permanece inalterada no chamador. Ao ampliar o schema de uma TT, recompilar os consumidores.

| Faixa de/ate | Tipo | Venda | Devolucao |
| --- | --- | --- | --- |
| estabel-de/ate | CHARACTER | nota-fiscal.cod-estabel | docum-est.cod-estabel |
| cliente-de/ate | INTEGER | nota-fiscal.cod-emitente | docum-est.cod-emitente |
| nota-de/ate | CHARACTER | nota-fiscal.nr-nota-fis | docum-est.nro-docto |
| pedido-de/ate | CHARACTER | nr-pedcli | nr-pedcli da venda original |
| representante-de/ate | INTEGER | cod-rep | cod-rep da venda original |
| emissao-de/ate | DATE | dt-emis-nota | dt-emissao |

Os intervalos textuais seguem a ordenacao do banco; conservar zeros iniciais. Pedido do filtro e o numero do cliente, enquanto tt-NF.nr-Pedido continua sendo o numero interno INTEGER. Estabelecimento 5 a 505 e uma faixa, nao uma lista.

## BOs

esbo/boConsNotaFiscal.p e esbo/boConsDevolucoes.p mantem estado escalar; nao recebem TT de filtros. Procedimentos comuns:

| Procedimento | Parametros |
| --- | --- |
| iniciarBo / limparContexto | limpa empresa, filtros e resultados |
| setEmpresa | CHARACTER IMA/MED |
| setIntervalEstab | um estabelecimento CHARACTER |
| setFaixaEstab | dois CHARACTER |
| setCliente / setIntervalCliente | um/dois INTEGER |
| setNotaFiscal / setIntervalNotaFiscal | um/dois CHARACTER |
| setIntervalPedido | dois CHARACTER de nr-pedcli |
| setIntervalCodRepres | dois INTEGER de cod-rep |
| setIntervalDtEmis | dois DATE |
| exec | OUTPUT TABLE tt-NF |
| finalizarBo | limpa e libera a instancia |

Na BO de notas foram preservados setNumeroPedido(INTEGER interno), setRepres(CHARACTER nome) e setTpNota(INTEGER especie); acrescentados setIntervalNrPedido e setIntervalNomeRepres para essas mesmas semanticas. Na BO de devolucoes setNumeroPedido recebe nr-pedcli CHARACTER e setRepres/setIntervalRepres recebem cod-rep INTEGER. O chamador comum usa os setters de faixa acima, evitando misturar tipos. Finalizar as instancias em FINALLY.

ConsultarNotasFiscais.p executa cada BO em ttParcial e acrescenta as linhas em tt-NF; a segunda consulta nao sobrescreve a primeira. Erros esvaziam o retorno e propagam a falha. BuscarDevolucoes.p continua disponivel como adaptador TT -> BO somente de devolucoes.

## Dados e regras

Include canonica esbo/boConsNotaFiscal.i ampliada de 14 para 21 campos, preservando ordem e tipos originais. Campos novos: tipo-nota, cod-emitente, cod-rep, nf-original, nr-pedcli, preposto e dt-emis-nota. references/esbo/boConsNotaFiscal.i e apenas o snapshot historico de 14 campos; nao e o contrato atual.

tipo-nota copia esp-docto da origem. A convencao existente foi conferida por contagens agregadas no banco: 20 para devolucoes e 22 para vendas nos registros amostrados. O writer nao classifica pelo sinal nem inventa codigos 1/2.

Devolucoes usam natureza tipo-compra=3/tp-rec-desp=1, nota original pela chave completa, primeiro pedido elegivel e motivos distintos. Preservados valor negativo e formula legada de desconto pela prioridade. data continua dt-trans; dt-emis-nota e a emissao de docum-est. Vendas excluem canceladas e situacao eletronica 4, exigem natureza de receita diferente de devolucao e pedido com ped-repre; desconto soma o trecho brasileiro de char-2 dos itens, conforme o PHP. Uma NF aparece uma vez mesmo com varios pedidos correspondentes. Preposto e comissao sao coletados por rotina compartilhada, pelo pedido interno/representante principal.

IMA usa ems2ima, estabelecimento 1, exclui emitente 10535. MED usa ems2med, exclui emitente 1; vendas restringem estabelecimentos 5/505 conforme legado e devolucoes aplicam a faixa informada. Todas as leituras sao NO-LOCK, com buffers proprios e consultas estaticas.

## Empacotamento e verificacao

```powershell
node integration-src/buscar-devolucoes/prepare-package.cjs .runtime/consulta-nf-package --tests
```

O manifesto de producao tem 21 fontes/includes; a compilacao gera 12 arquivos .r. BOs ficam em esbo, auxiliares em esapi/consulta-notas e API em http-api. Os caminhos RUN/includes sao explicitos. O script inclui testes somente com --tests e nunca lista fixtures no manifesto de publicacao.

OpenEdge 12.2.12 no .42: 12 programas compilados com SAVE contra schema real. Seis suites em banco sintetico exclusivo: devolucoes 55, integracao das BOs 16, parser 30, writer 21, escopo 7 e API com chamador real 17; total 146 checks em cada cultura AMERICAN/EUROPEAN, 13 tabelas vazias ao terminar. O teste da API exercita as duas consultas reais, escopo tipo2, mapeamento e rollback apos linha valida. Nao usa substituto do chamador. Evidencias privadas: .runtime/consulta-nf-api-20261020/official/.

IMA foi compilada usando alias de schema MED compativel, sem afirmar validacao do banco/instancia IMA. A validacao operacional desta entrega tem como alvo PASOE sursum-api/med, HTTPS 9911. Nunca publicar fixtures, DF, testes ou .r gerado no OpenEdge local 12.8.
