# Despesas do container: inventário para escrita nativa

Inventário de16/10/2026. Fontes abaixo são locais em `sources/scriptcase/containers`; funções replicadas não comprovam chamada de evento. Não houve execução PHP nem escrita de negócio.

## Edição individual

Fonte `form_despesas_container/form_despesas_container_apl.php`.

| Evento | Fonte | Efeito ativo |
|---|---|---|
| Load | 3603–3608 | localLogManual e bloqueio dos botões update/delete para despesa de distribuição de custo |
| beforeInsert | 3843–3845 | ID por seq_despesas_container |
| beforeUpdate | 3862 | lê anterior por container/despesa; novo serviço precisa anterior físico inequívoco sob lock |
| Persistência update | 4084 | despesa_id,vl_prev,vl_base_imp,vl_negociado,log_manual,perc_calc; demais atributos técnicos são condicionais do gerado, não campos livres de navegador |
| Unicidade | 4044,4322 | recusa outra linha com mesmo container/despesa, sem considerar item_container_id; não assumir índice físico equivalente |
| afterInsert | 4611–4614 | sincronizar impostos → calculadas → reparação ampla de log → stale |
| afterUpdate | 4626–4648 | sincronizar → calculadas; compara vl_prev,vl_base_imp,perc_calc,vl_negociado e marca stale se diferiu |
| afterDelete | 4674–4679 | sincronizar → calculadas → stale; uma despesa fiscal apagada pode ser recriada |
| onChange despesa/manual | 5145,5251 | chama localLogManual |
| localLogManual | 5185–5247 | calculada permite editar manual; não manual zera previsto e libera percentual, usando default da definição quando percentual0; manual zera percentual e libera previsto |
| Parâmetro protegido | 11054 | buscarParametroIma('despesa_distr_custo'); consulta nova usa include direto sem cache |

`localLogManual` é regra de load/onChange, não evento beforeUpdate. O percentual gravado da linha não substitui silenciosamente o percentual do cadastro usado no cálculo fiscal/calculado. IPI, parcela não recuperável e percentual_custo pertencem ao serviço fiscal comprovado, sem matemática alternativa no CRUD.

O dicionário despesas_container contém14campos. Novos registros manuais são gerais (`item_container_id=0`), a menos que outro fluxo comprovado crie despesa de item; campos técnicos como calc_imp_container_id,cta_corren_custo_distr_id,memoria_calculo não são editáveis externamente. Defaults físicos: log_manual=true, log_utilizado=false e valores0.

## Manutenção rápida

Fonte `form_despesas_container_multi_reg/form_despesas_container_multi_reg_apl.php`.

| Evento | Fonte | Efeito ativo |
|---|---|---|
| beforeDeleteAll | 1431–1434 | marca stale |
| Linhas existentes | 1450aprox. | despesa_id é restaurado da sessão em alterar/excluir; navegador não altera referência no lote |
| Validação | 2293–2306 | log_manual=false e perc_calc=0 é erro; percentual persistido é relido no backend |
| Update físico | 3810–3868 | campos principais despesa_id,vl_prev,vl_base_imp,log_manual; atributos técnicos/percentual só se campos gerados condicionais mudaram |
| afterUpdateAll | 1553–1558 | sincronizar impostos → reparação log → stale; **não** chama calculadas |
| afterDeleteAll | 1563–1566 | somente stale; **não** chama impostos/calculadas |
| Commit conjunto | 1570 | erros desfazem conjunto |

InsertAll não possui código de regra de negócio após definir o flag em1542. Não se deve acrescentar recalculo genérico a um lote porque existe função replicada no mesmo arquivo. Operações de lote serão homogêneas, com contexto de um único container, IDs sem repetição e locks/snapshots antes da primeira alteração. Insert individual continua sendo o fluxo comprovado de inclusão com sequência.

## Seleção de despesas padrão

Fonte `cons_selec_despesas/index.php`.

Conclusão7397–7416 chama criarDespesasContainer → setLogUtilizado → calculadas selecionadas → sincronizar. `criarDespesasContainer`10705–10724 percorre TODOS os vínculos ativos da empresa cujo cadastro não é imposto (`buscarDespesasEmp`12048–12063), usando vl_padrao e perc_calculo. Sincroniza por container/despesa/item0; UPDATE10728 sobrescreve previsto/negociado/proforma/cálculo/distribuição/percentual/memória mesmo em linhas anteriores. INSERT10452 deriva log_manual por percentual zero. UPDATE preserva log_manual existente.

`setLogUtilizadoDespesaContainer`10800 marca somente IDs selecionados como1, sem limpar os outros. `atuDespsCalcContainer`10567 recebe lista das selecionadas calculadas; lista vazia significa fallback para todas as linhas não manuais do container. Lista não vazia restringe o cálculo; o serviço fiscal congelado não expõe esse filtro, portanto não há autorização para trocar subset por todas sem contrato interno específico. `calcDespesaCalculada`10489 respeita manual e usa perc_calculo da definição.

Esta ação pode sobrescrever valores de despesas não selecionadas e a ordem calculadas→impostos difere da edição individual. Deve ter operação explícita e teste próprio; não pode ser escondida dentro de create genérico.

## Contrato e segurança transacional propostos

Serviço novo `ContainersDespesasCrudService.p`:11buffers fixos iguais ao fiscal (`phContainer,phEmpresas,phItems,phPurchaseItems,phPurchases,phDefs,phLinks,phTaxBases,phRelations,phCalcs,phExpenses`) +phRuntime confiável, policy interno, request e response JSON. Policy contém actor autenticado/usuario_id e despesa_distr_custo resolvida por include sem cache. Runtime coleta cotações sob masterlock, usa sequências fixas e fila de log da classe existente; sem flush dentro da transação.

Requisição fechada, proposta para integração: individual create/update/delete/get com container_id obrigatório, id/alias despesa_container_id consistente, values tipados; batch_update/batch_delete com rows homogêneas, sem escolha de tabela/empresa/identidade pelo cliente. Campo container_id e chaves/flags técnicos não ficam em values. Empresa vem do prefixo do estabelecimento e mapping único. Não aceitar referência de despesa de outra empresa.

Transação raiz própria, bloqueio do mestre EXCLUSIVE-LOCK NO-WAIT, snapshots de todos filhos antes de alterar, callback fiscal dentro da mesma transação quando o evento exige. Falha posterior desfaz todas as linhas do lote e efeitos fiscais, sem audit confirmado. Snapshot final precisa ser relido após regras, porque delete pode recriar e update pode substituir valores. Audit/log só após commit; não reatribuir registros históricos de sc_log.

Pendência de contrato: seleção de defaults requer filtro interno exato de despesas calculadas para preservar subset e fallback vazio. Inclusão do lote gerado não comprova sequência/eventos próprios; não será equiparada ao create individual sem decisão explícita.
