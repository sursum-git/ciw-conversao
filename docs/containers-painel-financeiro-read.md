# Painel — consultas financeiras e totais privados

Fontes preparadas em 16/10/2026. Esta etapa implementa leitura e testes exclusivamente com temp-tables; não comprova publicação ou validação PASOE. A tarefa principal mantém o estado de compilação12.2 e publicação na memória do projeto.

## Consulta das abas

`integration-src/container-panel/ContainersPainelFinanceReadService.p` recebe, nesta ordem, dez INPUT HANDLEs fixos: `phContainer,phEmpresas,phItensContainer,phItensProcCompra,phProcsCompra,phPagtos,phTitAp,phValTitAp,phNfs,phDocumEst`; INPUT JsonObject `poPolicy`; INPUT JsonObject `poRequest`; OUTPUT JsonObject `poResponse`.

O wrapper fornece os buffers de espec/EMS5/EMS2 e escolhe a base EMS2 pelo contexto confirmado do container. O navegador nunca escolhe conexão ou tabela. O serviço não abre conexões. A conexão EMS2IMA e o respectivo runtime precisam ser confirmados pela tarefa principal antes de declarar consultas IMA disponíveis.

Política interna: `{"adiantamentos":["AF"],"titulos":["DI"]}`. O wrapper deve usar a include `sursum-api/includes/parametros_ima.i` para ler diretamente, sem cache e a cada request, `especs_adiant_importacao` e `especs_tit_importacao`, com os defaults legados AF/DI quando apropriados. A política é um argumento interno, distinto do JSON externo. Valores configurados devem virar arrays de códigos de1–3caracteres ASCII alfanuméricos/`_`/`-`, sem interpretar SQL, chamadas ou expressões. Configuração inválida deve falhar; não executar seu conteúdo como condição.

Request externo fechado: `operation`=`read` ou `get`, `resource`=`pagamentos` ou `nfs`, `container_id` positivo int32; `get` exige `id` string opaca. Aceita também o alias da PK específica se exatamente igual a id. `read` retorna `{"success":true,"data":[...]}` e `get` retorna `{"success":true,"data":{...}}`. Toda leitura confirma o pai antes de consultar filhos. Não aceita política, SQL, banco, filtros de fornecedor/empresa ou campos extras do cliente. Datas ISO, unknown→null, decimais JSON number, texto sem HTML.

Identidades estáveis, sem ROWID: `pagamento_key` é `p_` + SHA256 hexadecimal maiúsculo da composição com comprimento de cada componente (container, estabelecimento, num_id_tit_ap). `nf_key` é `nf_` + SHA256 de container/estabelecimento/série/documento/natureza/emitente. Para documento localizado usa os campos físicos reais de docum-est; para órfão usa os do vínculo. IDs não são decodificados em SQL/ABL: get compara apenas chaves geradas no conjunto elegível do pai. Comprimentos:66 e67caracteres.

Pagamentos retornam exatamente22campos: `container_id,pagamento_key,num_id_tit_ap,cod_estab,cod_empresa,cod_espec_docto,cod_ser_docto,cdn_fornecedor,cod_tit_ap,cod_parcela,dat_emis_docto,dat_vencto_tit_ap,cod_indic_econ,val_origin_tit_ap,valor_real,valor_dolar,valor_real_origem,valor_dolar_origem,valor_real_registros,valor_dolar_registros,data_inicio_filtro,data_inicio_origem`.

Parte dos IDs de `espec.pagtos_container` do container; exclui títulos estornados; aplica empresa EMS5 derivada de `empresas.cod_emp_ems2` pelo primeiro caractere do estabelecimento, fornecedores dos processos ligados aos itens (fallback fornecedor do pai), e emissão desde a menor `procs_compra.dt_registro` dos pedidos relacionados. Sem data conhecida usa2005-01-01, com `data_inicio_origem=padrao_2005`; com data usa `pedidos`. Não usa dt-compra do cabeçalho. A identidade EMS5 comprovadamente única é `(cod_estab,num_id_tit_ap)`, não apenas num_id_tit_ap.

Cada finalidade de `val_tit_ap` (`corrente`/`dolar`) é consultada pelo mesmo ID e estabelecimento. Espécies de adiantamento usam original, espécies de título usam pago; se pertencer às duas listas, título prevalece como nos dois ifs do legado. Zero usa pago e depois original; moeda sem linha retorna0 e origem `ausente`; unknown persistido permanece null. O serviço não confunde esses números com snapshots `pagtos_container.vl_pago_em_*`.

O legado seleciona o primeiro valor sem ORDER apesar de poder haver várias linhas por movimento/unidade/fluxo. A aba usa ordem estável por `num_id_movto_tit_ap,cod_unid_negoc,cod_tip_fluxo_financ`, não soma valores indevidamente e informa os counts `valor_*_registros`. Isso exige comparação autorizada com os casos ambíguos antes de alegar paridade. Outra correção intencional: fora das espécies configuradas usa fallback numérico, pois o PHP atribui equivocadamente o código textual da espécie à variável de valor.

NFs retornam exatamente18campos: `container_id,nf_key,estab,documento,serie,especie,cod_emitente,nat_operacao,dt_emissao,dt_trans,tot_valor,despesa_nota,valor_embal,valor_frete,valor_mercad,valor_outras,valor_seguro,documento_localizado`.

Lê vínculos `nfs_container` do pai, encontra `docum-est` pelas três chaves documento/série/estabelecimento, com natureza iniciada em3. Não restringe indevidamente emitente/natureza do vínculo, pois o wrapper original usa somente as três chaves. Múltiplos vínculos para o mesmo documento não duplicam sua linha, incluindo diferenças de caixa aceitas pela comparação Progress. Documento ausente é um órfão explícito: preserva identidade do vínculo e retorna null em campos sem origem, em vez de inventar valor zero. Ordenação estável pelas chaves físicas do vínculo e documento.

Todos os predicados são criados internamente. Strings físicas são escapadas como literais ABL, inclusive apóstrofo, aspas, tilde e controles; QUOTER isolado não protege o escape tilde numa condição ABL dinâmica.

## Totais privados para custo

`ContainersPagamentoTotalsService.p` é um helper interno, sem rota pública. ABI: INPUT HANDLEs `phContainer,phPagtos,phTitAp,phValTitAp`; INPUT JsonObject `poPolicy` no mesmo formato acima; INPUT INTEGER `piContainer`; OUTPUT JsonObject `poResponse`.

Sucesso:

```json
{"success":true,"data":{"container_id":71,"payments":{"real":199.44443,"dolar":25.125},"confirmed":true,"source":"linked-payment-totals"}}
```

O custo legado usa todos os IDs vinculados e a fórmula de espécie/finalidade de `buscarVlMoeda`; não usa os filtros de empresa/fornecedor/data/estorno da grade. Portanto, não somar a grade para alimentar o núcleo do custo. Os testes incluem um título ligado com empresa/fornecedor distintos, data antiga e estornado, provando essa separação.

Como a consulta legada sem estabelecimento pode selecionar título ou valor arbitrário, o helper não confirma totais quando há mais de um `tit_ap` para o ID ligado, ou mais de um `val_tit_ap` por estabelecimento/ID/finalidade. Retorna `CONTAINER_PAYMENT_AMBIGUOUS`422. Vínculo/título inexistente retorna `CONTAINER_PAYMENT_NOT_FOUND`422; valor financeiro unknown retorna `CONTAINER_PAYMENT_VALUE_UNKNOWN`422. Não devolve totais parciais como confirmados. Finalidade sem linha mantém o zero numérico do legado. Cada chamada relê os buffers NO-LOCK, sem cache.

## Evidência local auxiliar

- `ContainersPainelFinanceReadTest.p` + `CompileContainersPainelFinanceReadTests.p`:139verificações em cada formato AMERICAN/EUROPEAN.
- `ContainersPagamentoTotalsTest.p` + `CompileContainersPagamentoTotalsTests.p`:27verificações em cada formato AMERICAN/EUROPEAN.
- Compilador diagnóstico local OpenEdge12.8, `COMPILER:ERROR=no` nos quatro fontes. Testes RED observados com serviço ausente antes da implementação. Logs em `.runtime/container-panel-finance-local/` e `.runtime/container-payment-totals-local/`.
- Não publicar `.r`12.8. A tarefa principal deve compilar12.2 no `.42`, publicar somente os programas pertinentes e validar em sursum-api/med. Não foram executados PHPs legados, nem gravados registros de negócio nesta etapa.
