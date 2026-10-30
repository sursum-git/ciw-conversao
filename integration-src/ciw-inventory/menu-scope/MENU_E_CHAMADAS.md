# Escopo de conversão CIW — menu e chamadas

Este documento separa o escopo operacional do inventário histórico. Ele começa nos menus conhecidos e segue chamadas entre aplicações; não transforma backups, testes ou alternativas não alcançadas em escopo de conversão.

## Base e limite

- Raiz: `menu_ctrl_importacao`.
- Fechamento transitivo das referências estáticas de aplicações Scriptcase.
- **Limite atual:** O SSH do servidor Scriptcase estava indisponível na geração; confirmar posteriormente as entradas ativas da tabela dinâmica itens_menu.

## Resumo

| Situação | Quantidade |
| --- | ---: |
| Convertido | 53 |
| Parcial | 13 |
| Preparado | 8 |
| Pendente | 78 |
| Triagem | 4 |
| Fora do escopo transitivo atual | 106 |
| Referências sem aplicação inventariada | 0 |

## Convertido

| Aplicação | Alcance | Tela atual | Situação |
| --- | --- | --- | --- |
| `bl_sinaliz` | nível 1 | `ciw.sinalizadores-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `cons_item_qt_imp` | nível 1 | `ciw.quantidades-importadas-med` | Convertido e validado readonly — geral MED e contextual |
| `form_motivos_desconto` | nível 1 | `ciw.motivos-desconto` | Convertido — CRUD/lote e auditoria validados |
| `form_tipos_anexo` | nível 1 | `ciw.tipos-anexo` | Convertido — CRUD/lote |
| `grid_PUB_sinalizadores_importacao` | nível 1 | `ciw.sinalizadores-importacao` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `grid_despesas` | nível 1 | `ciw.despesas` | Convertido — CRUD/lote |
| `grid_empresas` | nível 1 | `ciw.empresas` | Convertido — CRUD/lote |
| `grid_procs_compra` | nível 1 | `ciw.processos-compra-med` | Convertido — painel MED e fluxos contextuais publicados; Controles adiado |
| `bl_painel_proc_compra` | nível 2 | `ciw.processos-compra-med` | Convertido — painel MED e fluxos contextuais publicados; Controles adiado |
| `cons_fornecedor` | nível 2 | `ciw.fornecedores` | Convertido — consulta somente leitura validada |
| `cons_fornecedor_estrangeiro` | nível 2 | `ciw.fornecedores-estrangeiros` | Convertido — consulta somente leitura validada |
| `cons_itens_proc_compra_sinaliz` | nível 2 | `ciw.alertas-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `cons_proc_compra_sinaliz` | nível 2 | `ciw.alertas-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `form_PUB_sinalizadores_importacao` | nível 2 | `ciw.sinalizadores-importacao` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `form_despesas` | nível 2 | `ciw.despesas` | Convertido — CRUD/lote |
| `form_empresas` | nível 2 | `ciw.empresas` | Convertido — CRUD/lote |
| `form_hist_cotacoes_bc` | nível 2 | `ciw.cotacoes-bc` | Convertido — CRUD manual e auditoria validados |
| `form_pub_procs_compra` | nível 2 | `ciw.processos-compra-med` | Convertido — painel MED e fluxos contextuais publicados; Controles adiado |
| `grid_empresas_despesa` | nível 2 | `ciw.empresas-despesa` | Convertido — CRUD/lote |
| `bl_painel_proc_compra_sinaliz` | nível 3 | `ciw.alertas-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `bl_ponte_painel_container` | nível 3 | `ciw.container-painel` | Convertido — navegação |
| `form_empresas_despesa` | nível 3 | `ciw.empresas-despesa` | Convertido — CRUD/lote |
| `form_itens_proc_compra` | nível 3 | `ciw.proc-compra-itens` | Convertido — itens MED, amostras e anexos contextuais validados |
| `form_tipos_versao_custo` | nível 3 | `ciw.tipos-versao-custo` | Convertido — CRUD/lote e auditoria validados |
| `menu_proc_compra` | nível 3 | `ciw.processos-compra-med` | Convertido — painel MED e fluxos contextuais publicados; Controles adiado |
| `cons_tit_ap_associados_pedido` | nível 4 | `ciw.proc-compra-pagamentos` | Convertido — absorvido por Pagamentos do Processo de Compra — MED, com associação múltipla, estorno e auditoria publicados |
| `form_pub_coloracoes` | nível 4 | `ciw.coloracoes` | Convertido — CRUD/lote e auditoria validados |
| `form_pub_formatos_amostra` | nível 4 | `ciw.formatos-amostra` | Convertido — grade compartilhada, sequência, acesso, CRUD/auditoria e limpeza validados |
| `form_situacoes_container` | nível 4 | `ciw.situacoes-container` | Convertido — CRUD/lote e auditoria validados |
| `grid_PUB_envios_amostras_repres` | nível 4 | `ciw.proc-compra-amostras` | Convertido — amostras contextuais MED e auditoria validadas |
| `grid_anexos_proc_compra` | nível 4 | `ciw.proc-compra-documentos` | Convertido — anexos gerais MED publicados, validados e limpos |
| `grid_anexos_proc_compra_item` | nível 4 | `ciw.proc-compra-anexos` | Convertido — anexos contextuais MED com arquivos e auditoria validados |
| `grid_itens_proc_compra` | nível 4 | `ciw.proc-compra-itens` | Convertido — itens MED, amostras e anexos contextuais validados |
| `menu_proc_compra_sinaliz` | nível 4 | `ciw.alertas-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `bl_rastreabilidade_dolar` | nível 5 | `ciw.container-rastro-dolar` | Convertido — leitura |
| `bl_resumo_container` | nível 5 | `ciw.container-resumo` | Convertido — leitura |
| `bl_selecionado_pagto_proc_compra` | nível 5 | `ciw.proc-compra-pagamentos` | Convertido — navegação/consulta MED absorvida por tela nativa existente |
| `bl_sincronizar_impostos` | nível 5 | `ciw.container-sincronizar-impostos` | Convertido — comando fiscal central publicado e validado |
| `bl_voltar_selecao_ped_importacao_sinaliz` | nível 5 | `ciw.sinalizadores-importacao-med` | Convertido — publicado e validado em PASOE, runtime e sessão LDAP no escopo MED |
| `cons_itens_compra_alocado` | nível 5 | `ciw.proc-compra-alocacoes` | Convertido — consulta contextual MED publicada e validada |
| `cons_tit_ap_associar_pedido` | nível 5 | `ciw.proc-compra-pagamentos` | Convertido — absorvido pelo seletor contextual da tela Pagamentos do Processo de Compra — MED |
| `form_PUB_envios_amostras_repres` | nível 5 | `ciw.proc-compra-amostras` | Convertido — amostras contextuais MED e auditoria validadas |
| `form_anexos_proc_compra` | nível 5 | `ciw.proc-compra-documentos` | Convertido — anexos gerais MED publicados, validados e limpos |
| `form_anexos_proc_compra_item` | nível 5 | `ciw.proc-compra-anexos` | Convertido — anexos contextuais MED com arquivos e auditoria validados |
| `form_itens_proc_compra_amostra` | nível 5 | `ciw.proc-compra-itens` | Convertido — amostras contextuais MED e auditoria validadas |
| `grid_anexos_proc_compra_item_amostra` | nível 5 | `ciw.proc-compra-anexos` | Convertido — anexos contextuais MED com arquivos e auditoria validados |
| `grid_itens_container_comparacao` | nível 5 | `ciw.container-comparativos` | Convertido — leitura |
| `cons_itens` | nível 6 | `ciw.itens-erp` | Convertido — consulta somente leitura validada |
| `form_despesas_container` | nível 6 | `ciw.container-despesas` | Convertido — CRUD individual de despesa |
| `bl_selecao_pagto_proc_compra` | nível 7 | `ciw.proc-compra-pagamentos` | Convertido — navegação/consulta MED absorvida por tela nativa existente |
| `control_selec_proc_compra` | nível 7 | `ciw.container-alocar-itens` | Convertido — alocação MED publicada, validada e cenário limpo em26/10 |
| `form_itens_container` | nível 7 | `ciw.container-itens` | Convertido — CRUD individual de alocação |
| `grid_itens_proc_compra_selecao` | nível 8 | `ciw.container-alocar-itens` | Convertido — alocação MED publicada, validada e cenário limpo em26/10 |

## Parcial

| Aplicação | Alcance | Tela atual | Situação |
| --- | --- | --- | --- |
| `cons_hist_cotacoes_bc` | nível 1 | `ciw.cotacoes-bc` | Parcial — consulta absorvida na tela publicada |
| `cons_versoes_item_custo_container` | nível 1 | `ciw.container-versoes-custo` | Parcial — leitura publicada; ações pendentes |
| `bl_atu_dolar_dia` | nível 2 | `ciw.cotacoes-bc-buscar` | Parcial — processo BC publicado e cliente real validado |
| `bl_tela_login` | nível 2 | `—` | Parcial — login Progress validado; autorização positiva pendente |
| `grid_pp_container` | nível 2 | `ciw.containers` | Parcial — leitura publicada; ações pendentes |
| `form_pp_container` | nível 3 | `ciw.container-painel` | Parcial — cabeçalho CRUD e comandos publicados |
| `menu_container` | nível 4 | `ciw.container-painel` | Parcial — leitura publicada; ações pendentes |
| `cons_tit_ap_associados_container` | nível 5 | `ciw.container-pagamentos` | Parcial — leitura publicada; ações pendentes |
| `form_anexos_container` | nível 5 | `ciw.container-anexos` | Parcial — leitura publicada; ações pendentes |
| `grid_despesas_container` | nível 5 | `ciw.container-despesas` | Parcial — leitura publicada; ações pendentes |
| `cons_docum_est_importacao` | nível 6 | `ciw.container-nfs` | Parcial — leitura publicada; ações pendentes |
| `cons_tit_ap` | nível 6 | `ciw.titulos-pagar-med` | Parcial — consulta e seletor de compra MED publicados |
| `grid_itens_container` | nível 6 | `ciw.container-itens` | Parcial — leitura publicada; ações pendentes |

## Preparado

| Aplicação | Alcance | Tela atual | Situação |
| --- | --- | --- | --- |
| `form_versoes_item_custo_container` | nível 2 | `—` | Preparado — sem fluxo publicado |
| `bl_distribuir_custo_contr` | nível 6 | `—` | Preparado — sem fluxo publicado |
| `bl_item_custos` | nível 6 | `—` | Preparado — sem fluxo publicado |
| `ctrl_simul_distr_custo` | nível 6 | `—` | Preparado — sem fluxo publicado |
| `form_despesas_container_multi_reg` | nível 6 | `—` | Preparado — sem fluxo publicado |
| `contr_item_custos` | nível 7 | `—` | Preparado — sem fluxo publicado |
| `cons_itens_container_simul_calc` | nível 8 | `—` | Preparado — sem fluxo publicado |
| `bl_item_custos_gravacao` | nível 9 | `—` | Preparado — sem fluxo publicado |

## Pendente

| Aplicação | Alcance | Tela atual | Situação |
| --- | --- | --- | --- |
| `menu_ctrl_importacao` | menu | `—` | Não convertido identificado |
| `bl_chama_cons_item_custos` | nível 1 | `—` | Não convertido identificado |
| `bl_gerar_conta_corrente` | nível 1 | `—` | Não convertido identificado |
| `bl_ponte_descontos_importacao` | nível 1 | `—` | Não convertido identificado |
| `cons_cta_corren_custo_distr` | nível 1 | `—` | Não convertido identificado |
| `cons_cta_corren_res_ped` | nível 1 | `—` | Não convertido identificado |
| `cons_descontos_geral` | nível 1 | `—` | Não convertido identificado |
| `cons_distr_custo_geracao_saldo` | nível 1 | `—` | Não convertido identificado |
| `cons_logs` | nível 1 | `—` | Pendente — adaptar à infraestrutura existente |
| `cons_planilha` | nível 1 | `—` | Não convertido identificado |
| `cons_tit_ap_container` | nível 1 | `—` | Não convertido identificado |
| `ctrl_login_html` | nível 1 | `—` | Pendente — adaptar à infraestrutura existente |
| `menu` | nível 1 | `—` | Não convertido identificado |
| `bl_sincr_cotacao` | nível 2 | `—` | Não convertido identificado |
| `bl_timeout` | nível 2 | `—` | Pendente — adaptar à infraestrutura existente |
| `cons_cta_corren_fornec_imp_saldos` | nível 2 | `—` | Não convertido identificado |
| `cons_det_desconto_geral` | nível 2 | `—` | Não convertido identificado |
| `cons_det_versoes_item_custo_container` | nível 2 | `—` | Não convertido identificado |
| `cons_item_custos` | nível 2 | `—` | Não convertido identificado |
| `cons_itens_log` | nível 2 | `—` | Pendente — adaptar à infraestrutura existente |
| `cons_log_apl` | nível 2 | `—` | Pendente — adaptar à infraestrutura existente |
| `cons_log_inc_alt` | nível 2 | `—` | Pendente — adaptar à infraestrutura existente |
| `form_cta_corren_custo_distr` | nível 2 | `—` | Não convertido identificado |
| `grid_descontos_importacao` | nível 2 | `—` | Não convertido identificado |
| `app_login` | nível 3 | `—` | Pendente — adaptar à infraestrutura existente |
| `bl_selec_vendas_container` | nível 3 | `—` | Não convertido identificado |
| `bl_seleciona_form_item_custos` | nível 3 | `—` | Não convertido identificado |
| `cons_cta_corren_fornec_imp_embarcado` | nível 3 | `—` | Não convertido identificado |
| `cons_cta_corren_fornec_imp_entregue` | nível 3 | `—` | Não convertido identificado |
| `cons_cta_corren_fornec_imp_nao_embarcado` | nível 3 | `—` | Não convertido identificado |
| `cons_cta_corren_fornec_imp_tudo` | nível 3 | `—` | Não convertido identificado |
| `cons_desc_geral_fornec` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custo_descontos` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custo_despesas` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custo_nfs` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custo_pgtos` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custos` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custos_comparacao_dolar` | nível 3 | `—` | Não convertido identificado |
| `cons_item_container_custos_comparacao_real` | nível 3 | `—` | Não convertido identificado |
| `cons_itens_aptos_distr_custo` | nível 3 | `—` | Não convertido identificado |
| `form_descontos_importacao` | nível 3 | `—` | Não convertido identificado |
| `form_item_custos_manual` | nível 3 | `—` | Não convertido identificado |
| `form_medias_custo` | nível 3 | `—` | Não convertido identificado |
| `form_pp_container_cotacoes` | nível 3 | `—` | Não convertido identificado |
| `form_proc_compra` | nível 3 | `ciw.processos-compra-med` | Pendente de paridade da variante — manutenção MED reutilizada, cascata divergente não copiada |
| `grid_cta_corren_desconto` | nível 3 | `—` | Não convertido identificado |
| `bl_voltar_selecao_ped_importacao` | nível 4 | `—` | Não convertido identificado |
| `cons_calcs_imp_container` | nível 4 | `—` | Pendente |
| `cons_item_custos_det_media` | nível 4 | `—` | Não convertido identificado |
| `cons_itens_media_custo` | nível 4 | `—` | Não convertido identificado |
| `cons_procs_compra` | nível 4 | `ciw.processos-compra-med` | Pendente fora de MED — campos MED cobertos, equivalência multiempresa não comprovada |
| `ctrl_desc_canc_media` | nível 4 | `—` | Não convertido identificado |
| `form_cta_corren_desconto` | nível 4 | `—` | Não convertido identificado |
| `form_cta_corren_fornec_imp` | nível 4 | `—` | Não convertido identificado |
| `form_item_custos` | nível 4 | `—` | Não convertido identificado |
| `form_item_custos_container` | nível 4 | `—` | Não convertido identificado |
| `form_item_custos_media_cons` | nível 4 | `—` | Não convertido identificado |
| `menu_vendas_container` | nível 4 | `—` | Não convertido identificado |
| `bl_chama_grid_itens_container` | nível 5 | `—` | Pendente |
| `bl_ponte_versoes_item_custo_container` | nível 5 | `—` | Pendente |
| `bl_selecionado_nf` | nível 5 | `—` | Pendente |
| `bl_voltar_selecao_container` | nível 5 | `—` | Pendente |
| `cons_pp_container_filtro_fornecedor` | nível 5 | `—` | Pendente |
| `cons_pp_it_container` | nível 5 | `—` | Não convertido identificado |
| `form_itens_media_custo` | nível 5 | `—` | Não convertido identificado |
| `bl_calcular_impostos_container` | nível 6 | `—` | Não convertido identificado |
| `bl_chama_grid_itens_container_comparacao` | nível 6 | `—` | Não convertido identificado |
| `cons_despesas_container_memoria_calculo` | nível 6 | `—` | Pendente |
| `cons_pedidos_por_item_ref_container` | nível 6 | `—` | Não convertido identificado |
| `cons_selec_despesas` | nível 6 | `—` | Pendente |
| `cons_tit_ap_associar_container` | nível 6 | `—` | Pendente |
| `cons_tit_ap_associar_container_apos_di` | nível 6 | `—` | Pendente |
| `bl_selecao_nf` | nível 7 | `—` | Não convertido identificado |
| `bl_selecao_pagto_container` | nível 7 | `—` | Não convertido identificado |
| `bl_selecionado_pagto_container` | nível 7 | `—` | Não convertido identificado |
| `cons_cta_corren_distr_item_container` | nível 7 | `—` | Não convertido identificado |
| `grid_descontos_importacao_itens` | nível 8 | `—` | Não convertido identificado |
| `form_descontos_importacao_item` | nível 9 | `—` | Não convertido identificado |

## Triagem

| Aplicação | Alcance | Tela atual | Situação |
| --- | --- | --- | --- |
| `bl_pp_container` | nível 1 | `—` | Alternativa — uso e equivalência a confirmar |
| `blank` | nível 1 | `—` | Variante/teste — uso a confirmar |
| `grid_containers` | nível 2 | `—` | Alternativa — uso e equivalência a confirmar |
| `form_containers` | nível 3 | `—` | Alternativa — uso e equivalência a confirmar |

## Regra de leitura

`Convertido` significa que o inventário registra uma conversão publicada/validada para aquela origem ou fluxo absorvido. `Parcial` e `Preparado` continuam pendências; `Triagem` não é conversão e não deve entrar em uma contagem de telas entregues.
