# Itens do painel e alocação — auditoria de fonte17/10/2026

Somente leitura dos PHP/dicionários locais; sem executar PHP, rede, sequência ou negócio. Não altera produto. Linhas referem-se às cópias em sources/scriptcase/containers. Contrato ABL final pertence à coordenação; propostas abaixo não são APIs publicadas.

## Fluxo ativo e elegibilidade

grid_itens_container/grid_itens_container_grid.class.php:4588/4620 abre form_itens_container;4842 abre form_itens_proc_compra para o item do pedido;6610/7140 abre control_selec_proc_compra. Esse controle seleciona pedidos e redireciona à grid de seleção em control_selec_proc_compra_apl.php:1758–1766.

**Seleção original é global, sem igualdade obrigatória de empresa ou fornecedor ao container.** Lookup do controle:2319 e2899 seleciona procs_compra LEFT JOIN itens_proc_compra LEFT JOIN itens_container, GROUP BY pedido, HAVING SUM(comprada)>COALESCE(SUM(alocada),0). Não tem WHERE fornecedor/empresa. A grid_itens_proc_compra_selecao/index.php:5912 filtra somente proc_compra_id IN procs_selecao_corrente e codigo_erp diferente de vazio. Não acrescentar restrição same-company/same-supplier sem decisão de negócio. O rateio explicitamente aceita fornecedor do container diferente do pedido, mudando apenas histórico (form_itens_container_apl.php:7983–7988).

Fornecedor do item deriva do JOIN itens_proc_compra.proc_compra_id→procs_compra.fornecedor_id (form_itens_container_apl.php:8573–8583). Empresa do pedido está em procs_compra.empresa_id, mas não participa de guarda de igualdade ao pai no fluxo de seleção. Contexto do container deve ser fixado/validado pelo backend, preservando acesso/autoria existentes.

## Manutenção dos itens do container

Fonte F=form_itens_container/form_itens_container_apl.php; template T=form_itens_container/form_itens_container_form0.php.

UI padrão: F820–822 tem insert off, update/delete on. Portanto criação normal ocorre pela alocação; existir INSERT gerado não justifica expor create genérico. T1109–1125 mostra item_proc_compra_id como hidden+label/lookup; T1156–1188 oculta container_id. Embora SQL gerado aceite ambos, preservar pai/item do pedido como contexto imutável na nova edição.

Allowlist de11campos de manutenção evidenciada no UPDATE F4876/4906, retiradas as duas FKs:

| Campo | Dicionário físico |
|---|---|
| qt_alocada,qt_confirm_emb,qt_recbto_fisico | DECIMAL2 |
| log_rec_doc_prazo_emb,log_calc_icms,log_calc_ipi | LOGICAL |
| perc_custo,perc_icms,perc_ipi | DECIMAL2 |
| cod_tipo_calculo | INTEGER |
| observacao | CHARACTER |

item_container_id é PK; container_id/item_proc_compra_id são referências imutáveis na API proposta. preco_liquida_ima existe no dicionário, porém não é escrito pelo formulário auditado; não incluir automaticamente na manutenção. qt_disponivel é derivado, md_anexo/md_desc_item são detalhes, não colunas dessa gravação.

Disponível: F8638–8679 e8816–8828 leem qt_comprada do item do pedido e SUM(qt_alocada) em TODOS os containers. Load F4398–4402/F6398–6406 guarda quantidade anterior em sessão e exibe disponível. BeforeUpdate F4540–4560 compara ROUND2(nova)−ROUND2(anterior); incremento positivo maior que ROUND2(disponível) falha, redução não entra nessa guarda. A API deve obter antes/saldo do banco sob lock do item do pedido, nunca confiar no saldo/anterior enviado pelo browser. Não foi encontrada nesses eventos uma relação obrigatória embarcada<=alocada ou recebida<=embarcada, nem política de negativos além da validação numérica gerada (F2646). Limites adicionais precisam de decisão explícita.

## Eventos e efeitos reais

| Operação | Evidência ativa | Efeitos depois da linha |
|---|---|---|
| INSERT direto, UI desabilitada | F5371–5375 | sincronizarImpostos; despesas calculadas; stale1; rateio fornecedor |
| UPDATE | F5394–5412 | impostos; calculadas; rateio; stale se qt_alocada ou qt_confirm_emb mudam; sincroniza diferença embarcada no ledger tipo10 |
| DELETE/desalocar | F4578;4584–4637;5437–5445 | before completo; bloqueia descontos; remove item; impostos/calculadas; rateio remanescentes; estorna item tipo6; re-rateia pedido tipo4; stale1 |
| Alocação de selecionados | seleção/index.php:6757–6765 | inclui itens; impostos/calculadas; estorna rateio de pagamentos do pedido; rateia fornecedor nos itens do container |

DELETE físico F5289–5310 usa PK do item. Antes o registro é guardado por getRegItemContainer (F11266–11290 devolve objeto único), e after usa esse snapshot para não perder o item do pedido. Eventos usam container_corrente da sessão em pontos diferentes do container_id da linha; conversão deve usar um pai validado único.

O evento DELETE auditado bloqueia descontos_importacao.item_container_id; **não contém guarda específica de custos ou vínculos comerciais**, nem DELETE explícito em anexos/despesas por item. A coordenação determinou agora guards novos de custos/descontos/comercial. Registrar como nova proteção de integridade, não como paridade encontrada nesse evento. Definir também tratamento de despesas exclusivas/IPI, anexos e distribuição gerenciada antes de liberar exclusão; não inventar cascade de registros/arquivos.

Stale F16074–16084 grava log_versao_custo_desatualizada e timestamp quando1. A edição só compara duas quantidades; mudança de IPI/ICMS/custo não aparece nessa comparação. Alocação via SQL direto não chama o onAfterInsert do formulário e não há setStale explícito no onFinish6757–6765. Política final de invalidação deve ser fechada conscientemente.

## Alocar: sem quantidade confiada à sessão

G=grid_itens_proc_compra_selecao/index.php; classe grid correspondente.

Classe3778–3780 calcula comprada−SUMalocada e salva lista_qt_disponivel por item na sessão. Botão G6677/6714–6744 recebe índices da página e inclui os que tinham saldo positivo na sessão. OnFinish G6757 chama criarItensContainer.

G11637–11672, por item selecionado: lê SUMalocada atual; verifica par container/item do pedido em G9210–9218; usa qt_comprada da seleção salva, calcula saldo; se par inexistente, INSERT de apenas item_container_id=seq_itens_container.NEXTVAL,container_id,item_proc_compra_id,qt_alocada=saldo. Demais campos usam defaults físicos. Par já existente é ignorado, retorno apenas avisa existência; não soma nem substitui sua quantidade.

Riscos demonstráveis: comprada vem de sessão antiga; gate positivo só na página; nenhum lock impede dois containers consumirem o mesmo saldo; se saldo caiu depois da seleção, helper pode incluir0/negativo. Nova API deve reler comprado/SUM sob lock do item do pedido e fechar lote atomicamente; decisão de falhar/ignorar já alocado e saldo zerado deve ser explícita. O lookup agregado do controle ainda multiplica comprada pelo JOIN quando um item tem várias alocações: exemplo100 alocado40+60 soma comprada200/alocada100 e mantém pedido falso elegível. Não usar essa soma duplicada como limite financeiro.

## Pedido global, fora do CRUD solicitado

form_itens_proc_compra_apl.php é dependência de navegação, não deve virar CRUD global nesta etapa. UPDATE valida comprada>=SUMalocada (8854–8871), DELETE chama previsão antes e bloqueia enquanto há itens_container (8902–8903,8926–9009). INSERT/UPDATE geram previsão negociado×comprada e rateio de antecipações (10037–10040,10086–10095). UPDATE percorre TODOS os containers do item e recalcula fiscal/rateios (10098–10106), além de certificação15274–15303. Escopo multi-container exige outra transação/serviço, não efeito implícito de editar o item do painel.

Campos gravados no pedido (SQL9771) são45, incluindo cadastro/preços, quantidades, datas, avaliações, ind_distr_custo e item_estacao; dt_item_certificacao tem atualização adicional separada. Não confundir esse formulário com os11campos do item alocado.

## Dependências, schema, logs e contrato sugerido

Dicionários completos já disponíveis: itens_container (15campos, PK item_container_id e índices container/itemProc; sem índice único do par), itens_proc_compra,procs_compra,descontos_importacao,cta_corren_fornec_imp,empresas,títulos/valores EMS5,anexos,despesas e custos/versões. Os quatro dicionários centrais consultados têm triggers de tabela/campo vazios nas cópias; não desabilitar triggers no runtime nem extrapolar isso para outro banco. Seq_itens_container é nome evidenciado no INSERT; existência/disponibilidade runtime não foi sondada nesta auditoria.

Descendente ativo ausente: grid_descontos_importacao_itens, iframe T2158–2189. form_anexos_container existe, iframe T1942–1961, contextualizado ao item. Retorno do formulário de pedido para grid_itens_proc_compra (10163) aponta app ausente; fora do escopo global atual. Schemas ainda não encontrados: pagtos_proc_compra,transacoes e formatos_amostra. coloracoes tem dicionário fora da subpasta container-panel. Certificação dt_item_certificacao já existe em itens_proc_compra como DATE apesar da string timestamp enviada pelo helper.

F4517–4529 e6174–6270 preparam key/old/new e sc_log; LogDb e transacoes são rastreamento legado, não prova de commit. DELETE F5446–5450 faz COMMIT explícito antes da rotina genérica de rollback: não copiar essa fronteira. Reutilizar unidade transacional ABL raiz, before/after de item+mestre+filhos e audit somente póscommit, pending em composição; não criar logs confirmados dentro de callbacks.

Proposta para fechar com coordenação: read/get/update/delete sempre container_id positivo; get/update/delete exigem item pertencente ao pai. UPDATE values fechado nos11campos; contexto imutável. Opções de pedidos/itens podem ser globais conforme fonte, sem igualdade inventada de empresa/fornecedor. Alocar recebe IDs de itens do pedido, nunca saldo/custo do navegador; quantidade é o disponível atual, como botão original. Mudança de quantidade parcial ocorre pela manutenção posterior. IDs obtidos de sequência fixa em runtime, sem MAX global. Serviços fiscais e financeiros separados/reutilizáveis, transação raiz única, locks determinísticos por itemProc e pai. Não foi implementado produto.

Detalhes financeiros para delegação: docs/containers-itens-rateios-financeiros-inventario.md.
