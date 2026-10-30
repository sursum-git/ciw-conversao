<?php
class cons_planilha_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $Rows_span;
   var $NM_colspan;
   var $rs_grid;
   var $nm_grid_ini;
   var $nm_grid_sem_reg;
   var $nm_prim_linha;
   var $Rec_ini;
   var $Rec_fim;
   var $nmgp_reg_start;
   var $nmgp_reg_inicial;
   var $nmgp_reg_final;
   var $SC_seq_register;
   var $SC_seq_page;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $NM_raiz_img; 
   var $NM_opcao; 
   var $NM_flag_antigo; 
   var $sc_actionbar_states = array(
   );
   var $sc_actionbar_disabled = array(
   );
   var $sc_actionbar_hidden = array(
   );
   var $nm_campos_cab = array();
   var $NM_cmp_hidden   = array();
   var $nmgp_botoes     = array();
   var $nm_btn_exist    = array();
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array();
   var $Cmps_ord_def    = array();
   var $nmgp_label_quebras = array();
   var $nmgp_prim_pag_pdf;
   var $Campos_Mens_erro;
   var $Print_All;
   var $NM_field_over;
   var $NM_field_click;
   var $progress_fp;
   var $progress_tot;
   var $progress_now;
   var $progress_lim_tot;
   var $progress_lim_now;
   var $progress_lim_qtd;
   var $progress_grid;
   var $progress_pdf;
   var $progress_res;
   var $progress_graf;
   var $count_ger;
   var $pc_dt_registro;
   var $pc_fornecedor_id;
   var $pc_proc_compra_id;
   var $pc_cod_situacao;
   var $pc_cod_proc_fornec;
   var $pc_qt_dias_translado;
   var $pc_observacao;
   var $pc_dt_limite;
   var $pc_log_facilid_contato_fornec;
   var $ipc_item_proc_compra_id;
   var $ipc_descricao;
   var $ipc_codigo_erp;
   var $ipc_qt_dias_producao;
   var $ipc_unid_medida;
   var $ipc_qt_comprada;
   var $ipc_vl_custo_dolar;
   var $ipc_vl_base_tributacao;
   var $ipc_rolo;
   var $ipc_largura;
   var $ipc_peso;
   var $ipc_composicao;
   var $ipc_dt_prev_envio_desenhos;
   var $ipc_dt_real_envio_desenhos;
   var $ipc_log_aprov_so_ld;
   var $ipc_dt_prev_aprov_so_ld;
   var $ipc_dt_real_aprov_so_ld;
   var $ipc_coloracao_id;
   var $ipc_dt_maxima_producao;
   var $ipc_dt_mostruario;
   var $ipc_log_mostruario;
   var $ipc_formato_amostra_id;
   var $ipc_observacao;
   var $ipc_dt_cheg_amostras_emb;
   var $ipc_dt_prev_recbto_so_ld;
   var $ipc_dt_real_recbto_so_ld;
   var $ipc_vl_cubagem;
   var $ipc_dt_recbto_laudo;
   var $ipc_dt_recbto_embalagem;
   var $ipc_ind_producao_no_prazo;
   var $ipc_ind_relat_semanal_producao;
   var $ipc_ind_laudo_antes_embarque;
   var $ipc_ind_qualid_emb;
   var $ipc_ind_prod_conf_pi;
   var $ipc_ind_rec_amostra_antes_emb;
   var $ipc_ind_qt_conf_proforma;
   var $ipc_ind_tamanho_pecas_correto;
   var $ipc_dt_termino_producao;
   var $sc_field_2;
   var $sc_field_4;
   var $c_situacao;
   var $c_exclusivo;
   var $c_cod_armador;
   var $c_log_pagto_final;
   var $c_cod_agente_cargas;
   var $c_ind_dt_prev_chegada;
   var $c_dt_prev_embarque;
   var $c_dt_real_embarque;
   var $c_situacao_container_id;
   var $c_ind_dt_embarque;
   var $c_medidas_container;
   var $sc_field_7;
   var $sc_field_8;
   var $sc_field_5;
   var $sc_field_6;
   var $ic_log_rec_doc_prazo_emb;
   var $ic_qt_recbto_fisico;
   var $ic_qt_confirm_emb;
   var $ic_qt_alocada;
   var $ic_observacao;
   var $pc_empresa_id;
   var $pc_qt_container;
   var $look_pc_cod_situacao;
   var $look_pc_log_facilid_contato_fornec;
   var $look_ipc_log_mostruario;
   var $look_ipc_ind_producao_no_prazo;
   var $look_ipc_ind_relat_semanal_producao;
   var $look_ipc_ind_laudo_antes_embarque;
   var $look_ipc_ind_qualid_emb;
   var $look_ipc_ind_prod_conf_pi;
   var $look_ipc_ind_rec_amostra_antes_emb;
   var $look_ipc_ind_qt_conf_proforma;
   var $look_ipc_ind_tamanho_pecas_correto;
   var $look_c_situacao;
   var $look_c_exclusivo;
   var $look_c_ind_dt_prev_chegada;
   var $look_c_ind_dt_embarque;
   var $look_ic_log_rec_doc_prazo_emb;

function actionBar_isValidState($buttonName, $buttonState)
{
    switch ($buttonName) {
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateDisable($buttonName)
{
    if (isset($this->sc_actionbar_disabled[$buttonName]) && $this->sc_actionbar_disabled[$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide($buttonName)
{
    if (isset($this->sc_actionbar_hidden[$buttonName]) && $this->sc_actionbar_hidden[$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
}

//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
      {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
       { 
           include_once($this->Ini->path_embutida . "cons_planilha/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
           include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new cons_planilha_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
      }
    if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=1>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['cons_planilha'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['save_grid']);
       $this->grid();
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_bot();
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
    }
       if (strpos(" " . $this->Ini->SC_module_export, "resume") !== false)
       { 
           $Gera_res = true;
       } 
       else 
       { 
           $Gera_res = false;
       } 
       if (strpos(" " . $this->Ini->SC_module_export, "chart") !== false)
       { 
           $Gera_graf = true;
       } 
       else 
       { 
           $Gera_graf = false;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new cons_planilha_grafico();
               $this->Graf->Db     = $this->Db;
               $this->Graf->Erro   = $this->Erro;
               $this->Graf->Ini    = $this->Ini;
               $this->Graf->Lookup = $this->Lookup;
               $this->Graf->monta_grafico();
               exit;
           }
           elseif ($Gera_res || $Gera_graf)
           {
               $this->Res->monta_html_ini_pdf();
               $this->Res->monta_resumo();
               $this->Res->monta_html_fim_pdf();
           }
       } 
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'];
 }
 function resume($linhas = 0)
 {
    $this->Lin_impressas = 0;
    $this->Lin_final     = FALSE;
    $this->grid($linhas);
 }
//--- 
 function inicializa()
 {
   global $nm_saida, $NM_run_iframe,
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det,
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("pt_br");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_planilha/cons_planilha_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Lig_Md5'] = array();
   }
       $this->Tem_tab_vert = false;
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['mostra_edit'] = "N";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("cons_planilha", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['filter'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['export'] = "on";
   $this->nmgp_botoes['goto'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['navpage'] = "on";
   $this->nmgp_botoes['rows'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['gridsavesession'] = "on";
   $this->Cmps_ord_def['pc_cod_situacao'] = " desc";
   $this->Cmps_ord_def["pc.cod_situacao"] = "";
   $this->Cmps_ord_def['pc_cod_proc_fornec'] = " asc";
   $this->Cmps_ord_def["pc.cod_proc_fornec"] = "";
   $this->Cmps_ord_def['pc_qt_dias_translado'] = " desc";
   $this->Cmps_ord_def["pc.qt_dias_translado"] = "";
   $this->Cmps_ord_def['pc_empresa_id'] = " desc";
   $this->Cmps_ord_def["pc.empresa_id"] = "";
   $this->Cmps_ord_def['pc_qt_container'] = " desc";
   $this->Cmps_ord_def["pc.qt_container"] = "";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo'])) 
   { 
       $this->Proc_link_res            = true;
       $this->nmgp_botoes['filter']    = 'off';
       $this->nmgp_botoes['groupby']   = 'off';
       $this->nmgp_botoes['dynsearch'] = 'off';
       $this->nmgp_botoes['qsearch']   = 'off';
       $this->nmgp_botoes['gridsave']  = 'off';
       $this->nmgp_botoes['exit']      = 'off';
   } 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->pc_cod_proc_fornec = (isset($Busca_temp['pc_cod_proc_fornec'])) ? $Busca_temp['pc_cod_proc_fornec'] : ""; 
       $tmp_pos = (is_string($this->pc_cod_proc_fornec)) ? strpos($this->pc_cod_proc_fornec, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->pc_cod_proc_fornec))
       {
           $this->pc_cod_proc_fornec = substr($this->pc_cod_proc_fornec, 0, $tmp_pos);
       }
       $this->sc_field_4 = (isset($Busca_temp['sc_field_4'])) ? $Busca_temp['sc_field_4'] : ""; 
       $tmp_pos = (is_string($this->sc_field_4)) ? strpos($this->sc_field_4, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->sc_field_4))
       {
           $this->sc_field_4 = substr($this->sc_field_4, 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "muda_qt_linhas";
   } 
   $this->New_label['ipc_vl_custo_dolar'] = "" . $this->Ini->Nm_lang['lang_itens_proc_compra_fld_vl_custo_dolar'] . "";

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_planilha'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_planilha'];

           $this->nmgp_botoes['first']     = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['back']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['last']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['forward']   = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['summary']   = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
           $this->nmgp_botoes['qsearch']   = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
           $this->nmgp_botoes['dynsearch'] = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
           $this->nmgp_botoes['filter']    = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
           $this->nmgp_botoes['sel_col']   = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
           $this->nmgp_botoes['sort_col']  = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
           $this->nmgp_botoes['goto']      = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
           $this->nmgp_botoes['qtline']    = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
           $this->nmgp_botoes['navpage']   = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
           $this->nmgp_botoes['pdf']       = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
           $this->nmgp_botoes['xls']       = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
           $this->nmgp_botoes['xml']       = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
           $this->nmgp_botoes['json']      = $tmpDashboardButtons['grid_json']      ? 'on' : 'off';
           $this->nmgp_botoes['csv']       = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
           $this->nmgp_botoes['rtf']       = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
           $this->nmgp_botoes['word']      = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
           $this->nmgp_botoes['doc']       = $tmpDashboardButtons['grid_doc']       ? 'on' : 'off';
           $this->nmgp_botoes['print']     = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
           $this->nmgp_botoes['new']       = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
           $this->nmgp_botoes['img']       = $tmpDashboardButtons['img']            ? 'on' : 'off';
           $this->nmgp_botoes['html']      = $tmpDashboardButtons['html']           ? 'on' : 'off';
           $this->nmgp_botoes['reload']    = $tmpDashboardButtons['grid_reload']    ? 'on' : 'off';
           if (isset($tmpDashboardButtons['grid_rows'])) {$this->nmgp_botoes['rows'] = $tmpDashboardButtons['grid_rows'] ? 'on' : 'off';}
       }
   }

   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "cons_planilha/cons_planilha_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "cons_planilha_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_pdf'] != "pdf")  
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
       } 
       else 
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = "pdf";
       } 
   } 
   else 
   { 
       $this->nm_location = $_SESSION['scriptcase']['contr_link_emb'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new cons_planilha_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] = 30;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['rows'];  
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['rows']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!$GLOBALS['nm_restore_grid_save'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['prim_cons'] || !empty($nmgp_parms)) )  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'] = "";
   }   
   $GLOBALS['nm_restore_grid_save'] = false;
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1] ;  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['contr_array_resumo'] = "NAO";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['using_summary_cache']);
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = 0; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'];
   }
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT str_replace (convert(char(10),pc.dt_registro,102), '.', '-') + ' ' + convert(char(8),pc.dt_registro,20) as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, str_replace (convert(char(10),pc.dt_limite,102), '.', '-') + ' ' + convert(char(8),pc.dt_limite,20) as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, str_replace (convert(char(10),ipc.dt_prev_envio_desenhos,102), '.', '-') + ' ' + convert(char(8),ipc.dt_prev_envio_desenhos,20) as ipc_dt_prev_envio_desenhos, str_replace (convert(char(10),ipc.dt_real_envio_desenhos,102), '.', '-') + ' ' + convert(char(8),ipc.dt_real_envio_desenhos,20) as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, str_replace (convert(char(10),ipc.dt_prev_aprov_so_ld,102), '.', '-') + ' ' + convert(char(8),ipc.dt_prev_aprov_so_ld,20) as ipc_dt_prev_aprov_so_ld, str_replace (convert(char(10),ipc.dt_real_aprov_so_ld,102), '.', '-') + ' ' + convert(char(8),ipc.dt_real_aprov_so_ld,20) as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, str_replace (convert(char(10),ipc.dt_maxima_producao,102), '.', '-') + ' ' + convert(char(8),ipc.dt_maxima_producao,20) as ipc_dt_maxima_producao, str_replace (convert(char(10),ipc.dt_mostruario,102), '.', '-') + ' ' + convert(char(8),ipc.dt_mostruario,20) as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, str_replace (convert(char(10),ipc.dt_cheg_amostras_emb,102), '.', '-') + ' ' + convert(char(8),ipc.dt_cheg_amostras_emb,20) as ipc_dt_cheg_amostras_emb, str_replace (convert(char(10),ipc.dt_prev_recbto_so_ld,102), '.', '-') + ' ' + convert(char(8),ipc.dt_prev_recbto_so_ld,20) as ipc_dt_prev_recbto_so_ld, str_replace (convert(char(10),ipc.dt_real_recbto_so_ld,102), '.', '-') + ' ' + convert(char(8),ipc.dt_real_recbto_so_ld,20) as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, str_replace (convert(char(10),ipc.dt_recbto_laudo,102), '.', '-') + ' ' + convert(char(8),ipc.dt_recbto_laudo,20) as ipc_dt_recbto_laudo, str_replace (convert(char(10),ipc.dt_recbto_embalagem,102), '.', '-') + ' ' + convert(char(8),ipc.dt_recbto_embalagem,20) as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, str_replace (convert(char(10),ipc.dt_termino_producao,102), '.', '-') + ' ' + convert(char(8),ipc.dt_termino_producao,20) as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, str_replace (convert(char(10),c.dt_prev_embarque,102), '.', '-') + ' ' + convert(char(8),c.dt_prev_embarque,20) as c_dt_prev_embarque, str_replace (convert(char(10),c.dt_real_embarque,102), '.', '-') + ' ' + convert(char(8),c.dt_real_embarque,20) as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, str_replace (convert(char(10),c.\"dt-recebimento\",102), '.', '-') + ' ' + convert(char(8),c.\"dt-recebimento\",20) as sc_field_5, str_replace (convert(char(10),c.\"dt-prev-chegada\",102), '.', '-') + ' ' + convert(char(8),c.\"dt-prev-chegada\",20) as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT pc.dt_registro as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, pc.dt_limite as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, ipc.dt_prev_envio_desenhos as ipc_dt_prev_envio_desenhos, ipc.dt_real_envio_desenhos as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, ipc.dt_prev_aprov_so_ld as ipc_dt_prev_aprov_so_ld, ipc.dt_real_aprov_so_ld as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, ipc.dt_maxima_producao as ipc_dt_maxima_producao, ipc.dt_mostruario as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, ipc.dt_cheg_amostras_emb as ipc_dt_cheg_amostras_emb, ipc.dt_prev_recbto_so_ld as ipc_dt_prev_recbto_so_ld, ipc.dt_real_recbto_so_ld as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, ipc.dt_recbto_laudo as ipc_dt_recbto_laudo, ipc.dt_recbto_embalagem as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, ipc.dt_termino_producao as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, c.dt_prev_embarque as c_dt_prev_embarque, c.dt_real_embarque as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, c.\"dt-recebimento\" as sc_field_5, c.\"dt-prev-chegada\" as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT convert(char(23),pc.dt_registro,121) as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, convert(char(23),pc.dt_limite,121) as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, convert(char(23),ipc.dt_prev_envio_desenhos,121) as ipc_dt_prev_envio_desenhos, convert(char(23),ipc.dt_real_envio_desenhos,121) as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, convert(char(23),ipc.dt_prev_aprov_so_ld,121) as ipc_dt_prev_aprov_so_ld, convert(char(23),ipc.dt_real_aprov_so_ld,121) as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, convert(char(23),ipc.dt_maxima_producao,121) as ipc_dt_maxima_producao, convert(char(23),ipc.dt_mostruario,121) as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, convert(char(23),ipc.dt_cheg_amostras_emb,121) as ipc_dt_cheg_amostras_emb, convert(char(23),ipc.dt_prev_recbto_so_ld,121) as ipc_dt_prev_recbto_so_ld, convert(char(23),ipc.dt_real_recbto_so_ld,121) as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, convert(char(23),ipc.dt_recbto_laudo,121) as ipc_dt_recbto_laudo, convert(char(23),ipc.dt_recbto_embalagem,121) as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, convert(char(23),ipc.dt_termino_producao,121) as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, convert(char(23),c.dt_prev_embarque,121) as c_dt_prev_embarque, convert(char(23),c.dt_real_embarque,121) as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, convert(char(23),c.\"dt-recebimento\",121) as sc_field_5, convert(char(23),c.\"dt-prev-chegada\",121) as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT pc.dt_registro as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, pc.dt_limite as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, ipc.dt_prev_envio_desenhos as ipc_dt_prev_envio_desenhos, ipc.dt_real_envio_desenhos as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, ipc.dt_prev_aprov_so_ld as ipc_dt_prev_aprov_so_ld, ipc.dt_real_aprov_so_ld as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, ipc.dt_maxima_producao as ipc_dt_maxima_producao, ipc.dt_mostruario as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, ipc.dt_cheg_amostras_emb as ipc_dt_cheg_amostras_emb, ipc.dt_prev_recbto_so_ld as ipc_dt_prev_recbto_so_ld, ipc.dt_real_recbto_so_ld as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, ipc.dt_recbto_laudo as ipc_dt_recbto_laudo, ipc.dt_recbto_embalagem as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, ipc.dt_termino_producao as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, c.dt_prev_embarque as c_dt_prev_embarque, c.dt_real_embarque as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, c.\"dt-recebimento\" as sc_field_5, c.\"dt-prev-chegada\" as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT EXTEND(pc.dt_registro, YEAR TO DAY) as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, EXTEND(pc.dt_limite, YEAR TO DAY) as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, EXTEND(ipc.dt_prev_envio_desenhos, YEAR TO DAY) as ipc_dt_prev_envio_desenhos, EXTEND(ipc.dt_real_envio_desenhos, YEAR TO DAY) as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, EXTEND(ipc.dt_prev_aprov_so_ld, YEAR TO DAY) as ipc_dt_prev_aprov_so_ld, EXTEND(ipc.dt_real_aprov_so_ld, YEAR TO DAY) as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, EXTEND(ipc.dt_maxima_producao, YEAR TO DAY) as ipc_dt_maxima_producao, EXTEND(ipc.dt_mostruario, YEAR TO DAY) as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, EXTEND(ipc.dt_cheg_amostras_emb, YEAR TO DAY) as ipc_dt_cheg_amostras_emb, EXTEND(ipc.dt_prev_recbto_so_ld, YEAR TO DAY) as ipc_dt_prev_recbto_so_ld, EXTEND(ipc.dt_real_recbto_so_ld, YEAR TO DAY) as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, EXTEND(ipc.dt_recbto_laudo, YEAR TO DAY) as ipc_dt_recbto_laudo, EXTEND(ipc.dt_recbto_embalagem, YEAR TO DAY) as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, EXTEND(ipc.dt_termino_producao, YEAR TO DAY) as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, EXTEND(c.dt_prev_embarque, YEAR TO DAY) as c_dt_prev_embarque, EXTEND(c.dt_real_embarque, YEAR TO DAY) as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, EXTEND(c.\"dt-recebimento\", YEAR TO DAY) as sc_field_5, EXTEND(c.\"dt-prev-chegada\", YEAR TO DAY) as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT pc.dt_registro as pc_dt_registro, pc.fornecedor_id as pc_fornecedor_id, pc.proc_compra_id as pc_proc_compra_id, pc.cod_situacao as pc_cod_situacao, pc.cod_proc_fornec as pc_cod_proc_fornec, pc.qt_dias_translado as pc_qt_dias_translado, pc.observacao as pc_observacao, pc.dt_limite as pc_dt_limite, pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec, ipc.item_proc_compra_id as ipc_item_proc_compra_id, ipc.descricao as ipc_descricao, ipc.codigo_erp as ipc_codigo_erp, ipc.qt_dias_producao as ipc_qt_dias_producao, ipc.unid_medida as ipc_unid_medida, ipc.qt_comprada as ipc_qt_comprada, ipc.vl_custo_dolar as ipc_vl_custo_dolar, ipc.vl_base_tributacao as ipc_vl_base_tributacao, ipc.rolo as ipc_rolo, ipc.largura as ipc_largura, ipc.peso as ipc_peso, ipc.composicao as ipc_composicao, ipc.dt_prev_envio_desenhos as ipc_dt_prev_envio_desenhos, ipc.dt_real_envio_desenhos as ipc_dt_real_envio_desenhos, ipc.log_aprov_so_ld as ipc_log_aprov_so_ld, ipc.dt_prev_aprov_so_ld as ipc_dt_prev_aprov_so_ld, ipc.dt_real_aprov_so_ld as ipc_dt_real_aprov_so_ld, ipc.coloracao_id as ipc_coloracao_id, ipc.dt_maxima_producao as ipc_dt_maxima_producao, ipc.dt_mostruario as ipc_dt_mostruario, ipc.log_mostruario as ipc_log_mostruario, ipc.formato_amostra_id as ipc_formato_amostra_id, ipc.observacao as ipc_observacao, ipc.dt_cheg_amostras_emb as ipc_dt_cheg_amostras_emb, ipc.dt_prev_recbto_so_ld as ipc_dt_prev_recbto_so_ld, ipc.dt_real_recbto_so_ld as ipc_dt_real_recbto_so_ld, ipc.vl_cubagem as ipc_vl_cubagem, ipc.dt_recbto_laudo as ipc_dt_recbto_laudo, ipc.dt_recbto_embalagem as ipc_dt_recbto_embalagem, ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo, ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao, ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque, ipc.ind_qualid_emb as ipc_ind_qualid_emb, ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi, ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb, ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma, ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto, ipc.dt_termino_producao as ipc_dt_termino_producao, c.\"cod-emit-forn\" as sc_field_2, c.\"nr-container\" as sc_field_4, c.situacao as c_situacao, c.exclusivo as c_exclusivo, c.cod_armador as c_cod_armador, c.log_pagto_final as c_log_pagto_final, c.cod_agente_cargas as c_cod_agente_cargas, c.ind_dt_prev_chegada as c_ind_dt_prev_chegada, c.dt_prev_embarque as c_dt_prev_embarque, c.dt_real_embarque as c_dt_real_embarque, c.situacao_container_id as c_situacao_container_id, c.ind_dt_embarque as c_ind_dt_embarque, c.medidas_container as c_medidas_container, c.\"vl-dolar-venda\" as sc_field_7, c.\"vl-dolar-compra\" as sc_field_8, c.\"dt-recebimento\" as sc_field_5, c.\"dt-prev-chegada\" as sc_field_6, ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb, ic.qt_recbto_fisico as ic_qt_recbto_fisico, ic.qt_confirm_emb as ic_qt_confirm_emb, ic.qt_alocada as ic_qt_alocada, ic.observacao as ic_observacao, pc.empresa_id as pc_empresa_id, pc.qt_container as pc_qt_container from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order    = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   if (substr(trim($nmgp_order_by), -1) == ",")
   {
       $nmgp_order_by = " " . substr(trim($nmgp_order_by), 0, -1);
   }
   if (trim($nmgp_order_by) == "order by")
   {
       $nmgp_order_by = "";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
   }  
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->force_toolbar = true;
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
   else 
   { 
       $this->pc_dt_registro = $this->rs_grid->fields[0] ;  
       $this->pc_fornecedor_id = $this->rs_grid->fields[1] ;  
       $this->pc_fornecedor_id = (string)$this->pc_fornecedor_id;
       $this->pc_proc_compra_id = $this->rs_grid->fields[2] ;  
       $this->pc_proc_compra_id = (string)$this->pc_proc_compra_id;
       $this->pc_cod_situacao = $this->rs_grid->fields[3] ;  
       $this->pc_cod_situacao = (string)$this->pc_cod_situacao;
       $this->pc_cod_proc_fornec = $this->rs_grid->fields[4] ;  
       $this->pc_qt_dias_translado = $this->rs_grid->fields[5] ;  
       $this->pc_qt_dias_translado = (string)$this->pc_qt_dias_translado;
       $this->pc_observacao = $this->rs_grid->fields[6] ;  
       $this->pc_dt_limite = $this->rs_grid->fields[7] ;  
       $this->pc_log_facilid_contato_fornec = $this->rs_grid->fields[8] ;  
       $this->pc_log_facilid_contato_fornec = (string)$this->pc_log_facilid_contato_fornec;
       $this->ipc_item_proc_compra_id = $this->rs_grid->fields[9] ;  
       $this->ipc_item_proc_compra_id = (string)$this->ipc_item_proc_compra_id;
       $this->ipc_descricao = $this->rs_grid->fields[10] ;  
       $this->ipc_codigo_erp = $this->rs_grid->fields[11] ;  
       $this->ipc_qt_dias_producao = $this->rs_grid->fields[12] ;  
       $this->ipc_qt_dias_producao = (string)$this->ipc_qt_dias_producao;
       $this->ipc_unid_medida = $this->rs_grid->fields[13] ;  
       $this->ipc_qt_comprada = $this->rs_grid->fields[14] ;  
       $this->ipc_qt_comprada =  str_replace(",", ".", $this->ipc_qt_comprada);
       $this->ipc_qt_comprada = (string)$this->ipc_qt_comprada;
       $this->ipc_vl_custo_dolar = $this->rs_grid->fields[15] ;  
       $this->ipc_vl_custo_dolar =  str_replace(",", ".", $this->ipc_vl_custo_dolar);
       $this->ipc_vl_custo_dolar = (string)$this->ipc_vl_custo_dolar;
       $this->ipc_vl_base_tributacao = $this->rs_grid->fields[16] ;  
       $this->ipc_vl_base_tributacao =  str_replace(",", ".", $this->ipc_vl_base_tributacao);
       $this->ipc_vl_base_tributacao = (string)$this->ipc_vl_base_tributacao;
       $this->ipc_rolo = $this->rs_grid->fields[17] ;  
       $this->ipc_largura = $this->rs_grid->fields[18] ;  
       $this->ipc_peso = $this->rs_grid->fields[19] ;  
       $this->ipc_composicao = $this->rs_grid->fields[20] ;  
       $this->ipc_dt_prev_envio_desenhos = $this->rs_grid->fields[21] ;  
       $this->ipc_dt_real_envio_desenhos = $this->rs_grid->fields[22] ;  
       $this->ipc_log_aprov_so_ld = $this->rs_grid->fields[23] ;  
       $this->ipc_log_aprov_so_ld = (string)$this->ipc_log_aprov_so_ld;
       $this->ipc_dt_prev_aprov_so_ld = $this->rs_grid->fields[24] ;  
       $this->ipc_dt_real_aprov_so_ld = $this->rs_grid->fields[25] ;  
       $this->ipc_coloracao_id = $this->rs_grid->fields[26] ;  
       $this->ipc_coloracao_id = (string)$this->ipc_coloracao_id;
       $this->ipc_dt_maxima_producao = $this->rs_grid->fields[27] ;  
       $this->ipc_dt_mostruario = $this->rs_grid->fields[28] ;  
       $this->ipc_log_mostruario = $this->rs_grid->fields[29] ;  
       $this->ipc_log_mostruario = (string)$this->ipc_log_mostruario;
       $this->ipc_formato_amostra_id = $this->rs_grid->fields[30] ;  
       $this->ipc_formato_amostra_id = (string)$this->ipc_formato_amostra_id;
       $this->ipc_observacao = $this->rs_grid->fields[31] ;  
       $this->ipc_dt_cheg_amostras_emb = $this->rs_grid->fields[32] ;  
       $this->ipc_dt_prev_recbto_so_ld = $this->rs_grid->fields[33] ;  
       $this->ipc_dt_real_recbto_so_ld = $this->rs_grid->fields[34] ;  
       $this->ipc_vl_cubagem = $this->rs_grid->fields[35] ;  
       $this->ipc_vl_cubagem = (string)$this->ipc_vl_cubagem;
       $this->ipc_dt_recbto_laudo = $this->rs_grid->fields[36] ;  
       $this->ipc_dt_recbto_embalagem = $this->rs_grid->fields[37] ;  
       $this->ipc_ind_producao_no_prazo = $this->rs_grid->fields[38] ;  
       $this->ipc_ind_producao_no_prazo = (string)$this->ipc_ind_producao_no_prazo;
       $this->ipc_ind_relat_semanal_producao = $this->rs_grid->fields[39] ;  
       $this->ipc_ind_relat_semanal_producao = (string)$this->ipc_ind_relat_semanal_producao;
       $this->ipc_ind_laudo_antes_embarque = $this->rs_grid->fields[40] ;  
       $this->ipc_ind_laudo_antes_embarque = (string)$this->ipc_ind_laudo_antes_embarque;
       $this->ipc_ind_qualid_emb = $this->rs_grid->fields[41] ;  
       $this->ipc_ind_qualid_emb = (string)$this->ipc_ind_qualid_emb;
       $this->ipc_ind_prod_conf_pi = $this->rs_grid->fields[42] ;  
       $this->ipc_ind_prod_conf_pi = (string)$this->ipc_ind_prod_conf_pi;
       $this->ipc_ind_rec_amostra_antes_emb = $this->rs_grid->fields[43] ;  
       $this->ipc_ind_rec_amostra_antes_emb = (string)$this->ipc_ind_rec_amostra_antes_emb;
       $this->ipc_ind_qt_conf_proforma = $this->rs_grid->fields[44] ;  
       $this->ipc_ind_qt_conf_proforma = (string)$this->ipc_ind_qt_conf_proforma;
       $this->ipc_ind_tamanho_pecas_correto = $this->rs_grid->fields[45] ;  
       $this->ipc_ind_tamanho_pecas_correto = (string)$this->ipc_ind_tamanho_pecas_correto;
       $this->ipc_dt_termino_producao = $this->rs_grid->fields[46] ;  
       $this->sc_field_2 = $this->rs_grid->fields[47] ;  
       $this->sc_field_2 = (string)$this->sc_field_2;
       $this->sc_field_4 = $this->rs_grid->fields[48] ;  
       $this->sc_field_4 = (string)$this->sc_field_4;
       $this->c_situacao = $this->rs_grid->fields[49] ;  
       $this->c_situacao = (string)$this->c_situacao;
       $this->c_exclusivo = $this->rs_grid->fields[50] ;  
       $this->c_exclusivo = (string)$this->c_exclusivo;
       $this->c_cod_armador = $this->rs_grid->fields[51] ;  
       $this->c_cod_armador = (string)$this->c_cod_armador;
       $this->c_log_pagto_final = $this->rs_grid->fields[52] ;  
       $this->c_log_pagto_final = (string)$this->c_log_pagto_final;
       $this->c_cod_agente_cargas = $this->rs_grid->fields[53] ;  
       $this->c_cod_agente_cargas = (string)$this->c_cod_agente_cargas;
       $this->c_ind_dt_prev_chegada = $this->rs_grid->fields[54] ;  
       $this->c_ind_dt_prev_chegada = (string)$this->c_ind_dt_prev_chegada;
       $this->c_dt_prev_embarque = $this->rs_grid->fields[55] ;  
       $this->c_dt_real_embarque = $this->rs_grid->fields[56] ;  
       $this->c_situacao_container_id = $this->rs_grid->fields[57] ;  
       $this->c_situacao_container_id = (string)$this->c_situacao_container_id;
       $this->c_ind_dt_embarque = $this->rs_grid->fields[58] ;  
       $this->c_ind_dt_embarque = (string)$this->c_ind_dt_embarque;
       $this->c_medidas_container = $this->rs_grid->fields[59] ;  
       $this->sc_field_7 = $this->rs_grid->fields[60] ;  
       $this->sc_field_7 =  str_replace(",", ".", $this->sc_field_7);
       $this->sc_field_7 = (string)$this->sc_field_7;
       $this->sc_field_8 = $this->rs_grid->fields[61] ;  
       $this->sc_field_8 =  str_replace(",", ".", $this->sc_field_8);
       $this->sc_field_8 = (string)$this->sc_field_8;
       $this->sc_field_5 = $this->rs_grid->fields[62] ;  
       $this->sc_field_6 = $this->rs_grid->fields[63] ;  
       $this->ic_log_rec_doc_prazo_emb = $this->rs_grid->fields[64] ;  
       $this->ic_log_rec_doc_prazo_emb = (string)$this->ic_log_rec_doc_prazo_emb;
       $this->ic_qt_recbto_fisico = $this->rs_grid->fields[65] ;  
       $this->ic_qt_recbto_fisico =  str_replace(",", ".", $this->ic_qt_recbto_fisico);
       $this->ic_qt_recbto_fisico = (string)$this->ic_qt_recbto_fisico;
       $this->ic_qt_confirm_emb = $this->rs_grid->fields[66] ;  
       $this->ic_qt_confirm_emb =  str_replace(",", ".", $this->ic_qt_confirm_emb);
       $this->ic_qt_confirm_emb = (string)$this->ic_qt_confirm_emb;
       $this->ic_qt_alocada = $this->rs_grid->fields[67] ;  
       $this->ic_qt_alocada =  str_replace(",", ".", $this->ic_qt_alocada);
       $this->ic_qt_alocada = (string)$this->ic_qt_alocada;
       $this->ic_observacao = $this->rs_grid->fields[68] ;  
       $this->pc_empresa_id = $this->rs_grid->fields[69] ;  
       $this->pc_empresa_id = (string)$this->pc_empresa_id;
       $this->pc_qt_container = $this->rs_grid->fields[70] ;  
       $this->pc_qt_container = (string)$this->pc_qt_container;
       $GLOBALS["pc_fornecedor_id"] = $this->rs_grid->fields[1] ;  
       $GLOBALS["pc_fornecedor_id"] = (string)$GLOBALS["pc_fornecedor_id"] ;
       $GLOBALS["ipc_coloracao_id"] = $this->rs_grid->fields[26] ;  
       $GLOBALS["ipc_coloracao_id"] = (string)$GLOBALS["ipc_coloracao_id"] ;
       $GLOBALS["ipc_formato_amostra_id"] = $this->rs_grid->fields[30] ;  
       $GLOBALS["ipc_formato_amostra_id"] = (string)$GLOBALS["ipc_formato_amostra_id"] ;
       $GLOBALS["sc_field_2"] = $this->rs_grid->fields[47] ;  
       $GLOBALS["sc_field_2"] = (string)$GLOBALS["sc_field_2"] ;
       $GLOBALS["c_cod_armador"] = $this->rs_grid->fields[51] ;  
       $GLOBALS["c_cod_armador"] = (string)$GLOBALS["c_cod_armador"] ;
       $GLOBALS["c_cod_agente_cargas"] = $this->rs_grid->fields[53] ;  
       $GLOBALS["c_cod_agente_cargas"] = (string)$GLOBALS["c_cod_agente_cargas"] ;
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->pc_dt_registro = $this->rs_grid->fields[0] ;  
           $this->pc_fornecedor_id = $this->rs_grid->fields[1] ;  
           $this->pc_proc_compra_id = $this->rs_grid->fields[2] ;  
           $this->pc_cod_situacao = $this->rs_grid->fields[3] ;  
           $this->pc_cod_proc_fornec = $this->rs_grid->fields[4] ;  
           $this->pc_qt_dias_translado = $this->rs_grid->fields[5] ;  
           $this->pc_observacao = $this->rs_grid->fields[6] ;  
           $this->pc_dt_limite = $this->rs_grid->fields[7] ;  
           $this->pc_log_facilid_contato_fornec = $this->rs_grid->fields[8] ;  
           $this->ipc_item_proc_compra_id = $this->rs_grid->fields[9] ;  
           $this->ipc_descricao = $this->rs_grid->fields[10] ;  
           $this->ipc_codigo_erp = $this->rs_grid->fields[11] ;  
           $this->ipc_qt_dias_producao = $this->rs_grid->fields[12] ;  
           $this->ipc_unid_medida = $this->rs_grid->fields[13] ;  
           $this->ipc_qt_comprada = $this->rs_grid->fields[14] ;  
           $this->ipc_vl_custo_dolar = $this->rs_grid->fields[15] ;  
           $this->ipc_vl_base_tributacao = $this->rs_grid->fields[16] ;  
           $this->ipc_rolo = $this->rs_grid->fields[17] ;  
           $this->ipc_largura = $this->rs_grid->fields[18] ;  
           $this->ipc_peso = $this->rs_grid->fields[19] ;  
           $this->ipc_composicao = $this->rs_grid->fields[20] ;  
           $this->ipc_dt_prev_envio_desenhos = $this->rs_grid->fields[21] ;  
           $this->ipc_dt_real_envio_desenhos = $this->rs_grid->fields[22] ;  
           $this->ipc_log_aprov_so_ld = $this->rs_grid->fields[23] ;  
           $this->ipc_dt_prev_aprov_so_ld = $this->rs_grid->fields[24] ;  
           $this->ipc_dt_real_aprov_so_ld = $this->rs_grid->fields[25] ;  
           $this->ipc_coloracao_id = $this->rs_grid->fields[26] ;  
           $this->ipc_dt_maxima_producao = $this->rs_grid->fields[27] ;  
           $this->ipc_dt_mostruario = $this->rs_grid->fields[28] ;  
           $this->ipc_log_mostruario = $this->rs_grid->fields[29] ;  
           $this->ipc_formato_amostra_id = $this->rs_grid->fields[30] ;  
           $this->ipc_observacao = $this->rs_grid->fields[31] ;  
           $this->ipc_dt_cheg_amostras_emb = $this->rs_grid->fields[32] ;  
           $this->ipc_dt_prev_recbto_so_ld = $this->rs_grid->fields[33] ;  
           $this->ipc_dt_real_recbto_so_ld = $this->rs_grid->fields[34] ;  
           $this->ipc_vl_cubagem = $this->rs_grid->fields[35] ;  
           $this->ipc_dt_recbto_laudo = $this->rs_grid->fields[36] ;  
           $this->ipc_dt_recbto_embalagem = $this->rs_grid->fields[37] ;  
           $this->ipc_ind_producao_no_prazo = $this->rs_grid->fields[38] ;  
           $this->ipc_ind_relat_semanal_producao = $this->rs_grid->fields[39] ;  
           $this->ipc_ind_laudo_antes_embarque = $this->rs_grid->fields[40] ;  
           $this->ipc_ind_qualid_emb = $this->rs_grid->fields[41] ;  
           $this->ipc_ind_prod_conf_pi = $this->rs_grid->fields[42] ;  
           $this->ipc_ind_rec_amostra_antes_emb = $this->rs_grid->fields[43] ;  
           $this->ipc_ind_qt_conf_proforma = $this->rs_grid->fields[44] ;  
           $this->ipc_ind_tamanho_pecas_correto = $this->rs_grid->fields[45] ;  
           $this->ipc_dt_termino_producao = $this->rs_grid->fields[46] ;  
           $this->sc_field_2 = $this->rs_grid->fields[47] ;  
           $this->sc_field_4 = $this->rs_grid->fields[48] ;  
           $this->c_situacao = $this->rs_grid->fields[49] ;  
           $this->c_exclusivo = $this->rs_grid->fields[50] ;  
           $this->c_cod_armador = $this->rs_grid->fields[51] ;  
           $this->c_log_pagto_final = $this->rs_grid->fields[52] ;  
           $this->c_cod_agente_cargas = $this->rs_grid->fields[53] ;  
           $this->c_ind_dt_prev_chegada = $this->rs_grid->fields[54] ;  
           $this->c_dt_prev_embarque = $this->rs_grid->fields[55] ;  
           $this->c_dt_real_embarque = $this->rs_grid->fields[56] ;  
           $this->c_situacao_container_id = $this->rs_grid->fields[57] ;  
           $this->c_ind_dt_embarque = $this->rs_grid->fields[58] ;  
           $this->c_medidas_container = $this->rs_grid->fields[59] ;  
           $this->sc_field_7 = $this->rs_grid->fields[60] ;  
           $this->sc_field_8 = $this->rs_grid->fields[61] ;  
           $this->sc_field_5 = $this->rs_grid->fields[62] ;  
           $this->sc_field_6 = $this->rs_grid->fields[63] ;  
           $this->ic_log_rec_doc_prazo_emb = $this->rs_grid->fields[64] ;  
           $this->ic_qt_recbto_fisico = $this->rs_grid->fields[65] ;  
           $this->ic_qt_confirm_emb = $this->rs_grid->fields[66] ;  
           $this->ic_qt_alocada = $this->rs_grid->fields[67] ;  
           $this->ic_observacao = $this->rs_grid->fields[68] ;  
           $this->pc_empresa_id = $this->rs_grid->fields[69] ;  
           $this->pc_qt_container = $this->rs_grid->fields[70] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'] && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_planilha']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['word_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_planilha']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['print_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: PDF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
?>
                    <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, user-scalable=no">
                    <meta name="mobile-web-app-capable" content="yes">
                    <meta name="apple-mobile-web-app-capable" content="yes">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <link rel="apple-touch-icon"   sizes="57x57" href="">
                    <link rel="apple-touch-icon"   sizes="60x60" href="">
                    <link rel="apple-touch-icon"   sizes="72x72" href="">
                    <link rel="apple-touch-icon"   sizes="76x76" href="">
                    <link rel="apple-touch-icon" sizes="114x114" href="">
                    <link rel="apple-touch-icon" sizes="120x120" href="">
                    <link rel="apple-touch-icon" sizes="144x144" href="">
                    <link rel="apple-touch-icon" sizes="152x152" href="">
                    <link rel="apple-touch-icon" sizes="180x180" href="">
                    <link rel="icon" type="image/png" sizes="192x192" href="">
                    <link rel="icon" type="image/png"   sizes="32x32" href="">
                    <link rel="icon" type="image/png"   sizes="96x96" href="">
                    <link rel="icon" type="image/png"   sizes="16x16" href="">
                    <meta name="msapplication-TileColor" content="#FFFFFF">
                    <meta name="msapplication-TileImage" content="">
                    <meta name="theme-color" content="#FFFFFF">
                    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
                    <link rel="shortcut icon" href=""><?php
           }
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php 
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
 ?> 
 <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
 <?php 
 } 
 ?> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
 <SCRIPT LANGUAGE="Javascript" SRC="<?php echo $this->Ini->path_js; ?>/nm_gauge.js"></SCRIPT>
</HEAD>
<BODY scrolling="no">
<table class="scGridTabela" style="padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;"><tr class="scGridFieldOddVert"><td>
<?php echo $this->Ini->Nm_lang['lang_pdff_gnrt']; ?>...<br>
<?php
           $this->progress_grid    = $this->rs_grid->RecordCount();
           $this->progress_pdf     = 0;
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['pivot_charts']) : 0;
           $this->progress_graf    = 0;
           $this->progress_tot     = 0;
           $this->progress_now     = 0;
           $this->progress_lim_tot = 0;
           $this->progress_lim_now = 0;
           if (-1 < $this->progress_grid)
           {
               $this->progress_lim_qtd = (250 < $this->progress_grid) ? 250 : $this->progress_grid;
               $this->progress_lim_tot = floor($this->progress_grid / $this->progress_lim_qtd);
               $this->progress_pdf     = floor($this->progress_grid * 0.25) + 1;
               $this->progress_tot     = $this->progress_grid + $this->progress_pdf + $this->progress_res + $this->progress_graf;
               $str_pbfile             = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
               $this->progress_fp      = fopen($str_pbfile, 'w');
               cons_planilha_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               cons_planilha_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               cons_planilha_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               cons_planilha_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               cons_planilha_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE html>\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - </TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
$nm_saida->saida("                        <meta name=\"viewport\" content=\"minimal-ui, width=300, initial-scale=1, maximum-scale=1, user-scalable=no\">\r\n");
$nm_saida->saida("                        <meta name=\"mobile-web-app-capable\" content=\"yes\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\r\n");
$nm_saida->saida("                        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileColor\" content=\"#FFFFFF\" >\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileImage\" content=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"theme-color\" content=\"#FFFFFF\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#FFFFFF\">\r\n");
$nm_saida->saida("                        <link rel=\"shortcut icon\" href=\"\">\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && !$this->Ini->sc_export_ajax)
       { 
           $nm_saida->saida("   <form name=\"form_ajax_redir_1\" method=\"post\" style=\"display: none\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <form name=\"form_ajax_redir_2\" method=\"post\" style=\"display: none\"> \r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $confirmButtonClass = '';
           $cancelButtonClass  = '';
           $confirmButtonText  = $this->Ini->Nm_lang['lang_btns_cfrm'];
           $cancelButtonText   = $this->Ini->Nm_lang['lang_btns_cncl'];
           $confirmButtonFA    = '';
           $cancelButtonFA     = '';
           $confirmButtonFAPos = '';
           $cancelButtonFAPos  = '';
           if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
               $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
           }
           if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
               $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
           }
           if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
               $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
           }
           if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
               $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
           }
           if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
               $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
           }
           if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
               $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
           }
           if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
               $confirmButtonFAPos = 'text_right';
           }
           if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
               $cancelButtonFAPos = 'text_right';
           }
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var scSweetAlertConfirmButton = \"" . $confirmButtonClass . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertCancelButton = \"" . $cancelButtonClass . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertConfirmButtonText = \"" . $confirmButtonText . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertCancelButtonText = \"" . $cancelButtonText . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertConfirmButtonFA = \"" . $confirmButtonFA . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertCancelButtonFA = \"" . $cancelButtonFA . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertConfirmButtonFAPos = \"" . $confirmButtonFAPos . "\";\r\n");
           $nm_saida->saida("     var scSweetAlertCancelButtonFAPos = \"" . $cancelButtonFAPos . "\";\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_planilha_jquery_3847.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_planilha_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_planilha_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data   = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'grid', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => true, 
                   'scrollUpPosition' => 'R', 
                   'toolbarOrientation' => 'H', 
                   'mobilePanes' => 'true', 
                   'navigationBarButtons' => unserialize('a:5:{i:0;s:14:"sys_format_ini";i:1;s:14:"sys_format_ret";i:2;s:15:"sys_format_rows";i:3;s:14:"sys_format_ava";i:4;s:14:"sys_format_fim";}'), 
                   'langs' => [ 
                       'lang_refined_search' => html_entity_decode($this->Ini->Nm_lang['lang_refined_search'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_summary_search_button' => html_entity_decode($this->Ini->Nm_lang['lang_summary_search_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_details_button' => html_entity_decode($this->Ini->Nm_lang['lang_details_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                   ], 
               ]); ?> 
        <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
        <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
        <script type="text/javascript" src="../_lib/lib/js/nm_mobile.js"></script>
        <link rel='stylesheet' href='../_lib/lib/css/nm_mobile.css' type='text/css'/>
          <?php }
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_sweetalert.css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/sweetalert/sweetalert2.all.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/sweetalert/polyfill.min.js\"></script>\r\n");
           $nm_saida->saida("<script type=\"text/javascript\" src=\"../_lib/lib/js/frameControl.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("      if (!window.Promise)\r\n");
           $nm_saida->saida("      {\r\n");
           $nm_saida->saida("          var head = document.getElementsByTagName('head')[0];\r\n");
           $nm_saida->saida("          var js = document.createElement(\"script\");\r\n");
           $nm_saida->saida("          js.src = \"../_lib/lib/js/bluebird.min.js\";\r\n");
           $nm_saida->saida("          head.appendChild(js);\r\n");
           $nm_saida->saida("      }\r\n");
           $nm_saida->saida("      $(\"#TB_iframeContent\").ready(function(){\r\n");
           $nm_saida->saida("         jQuery(document).bind('keydown.thickbox', function(e) {\r\n");
           $nm_saida->saida("            var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("            if (keyPressed == 27) { \r\n");
           $nm_saida->saida("                tb_remove();\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("         })\r\n");
           $nm_saida->saida("      })\r\n");
           $nm_saida->saida("      var Iframe_Open_Name = \"\";\r\n");
           $nm_saida->saida("      if (window.self !== window.top) {\r\n");
           $nm_saida->saida("          iframes = window.top.document.getElementsByTagName('iframe');\r\n");
           $nm_saida->saida("          for (i = 0; i < iframes.length; i++) {\r\n");
           $nm_saida->saida("               iframe = iframes[i];\r\n");
           $nm_saida->saida("               if (iframe.contentWindow === window.self) {\r\n");
           $nm_saida->saida("                  Iframe_Open_Name = iframe.getAttribute('name');\r\n");
           $nm_saida->saida("                  break;\r\n");
           $nm_saida->saida("               }\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("      }\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/css/ui.dropdownchecklist.standalone.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/js/ui.dropdownchecklist.js\"></script>\r\n");
           $nm_saida->saida("        <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("          var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("          var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("          var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("        </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("<style>\r\n");
           $nm_saida->saida(".scButton_default.sc-actb {\r\n");
           $nm_saida->saida("    padding: 4px 7px;\r\n");
           $nm_saida->saida("    white-space: nowrap;\r\n");
           $nm_saida->saida("    animation-delay: 0s;\r\n");
           $nm_saida->saida("    animation-duration: 0s;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".scButton_default.sc-actb:hover {\r\n");
           $nm_saida->saida("    padding: 4px 7px !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-fa { padding: 5px !important;font-size: 17px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i {  }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i:hover {  }\r\n");
           $nm_saida->saida(".sc-actionbar-fa i:active {  }\r\n");
           $nm_saida->saida(".sc-actionbar-btn { text-decoration: none !important;padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-img { padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-txt { padding: 5px !important; }\r\n");
           $nm_saida->saida(".sc-actionbar-fa.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-btn.disabled .scButton_default.sc-actb {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-btn.disabled {\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-img.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-txt.disabled {\r\n");
           $nm_saida->saida("    cursor: not-allowed !important;\r\n");
           $nm_saida->saida("    opacity: 0.44 !important;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-button-hidden {\r\n");
           $nm_saida->saida("    display: none;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida(".sc-actionbar-txt:hover {  }\r\n");
           $nm_saida->saida(".sc-actionbar-txt:active {  }\r\n");
           $nm_saida->saida("</style>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("function actionBar_displayState(buttonName, buttonState, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    let stateHtml, buttonId, stateHint;\r\n");
           $nm_saida->saida("    stateHint = actionBar_getStateHint(buttonName, buttonState);\r\n");
           $nm_saida->saida("    stateConfirm = actionBar_getStateConfirm(buttonName, buttonState);\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    $(\"#\" + buttonId).html(stateHtml).data(\"actionbarState\", buttonState).data(\"actionbarConfirm\", stateConfirm);\r\n");
           $nm_saida->saida("    if (\"\" == stateHint) {\r\n");
           $nm_saida->saida("        if (\"undefined\" != typeof document.querySelector(\"#\" + buttonId)._tippy) {\r\n");
           $nm_saida->saida("            document.querySelector(\"#\" + buttonId)._tippy.disable();\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        if (\"undefined\" == typeof document.querySelector(\"#\" + buttonId)._tippy) {\r\n");
           $nm_saida->saida("            tippy(\"#\" + buttonId, {\r\n");
           $nm_saida->saida("                content: stateHint,\r\n");
           $nm_saida->saida("                theme: \"light\"\r\n");
           $nm_saida->saida("            });\r\n");
           $nm_saida->saida("        } else {\r\n");
           $nm_saida->saida("            document.querySelector(\"#\" + buttonId)._tippy.enable();\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        document.querySelector(\"#\" + buttonId)._tippy.setContent(stateHint);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_getStateHint(buttonName, buttonState)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_getStateConfirm(buttonName, buttonState)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    switch (buttonName) {\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_disable(buttonName, disableButton, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if (disableButton) {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).addClass(\"disabled\").on(\"mouseover\", function() { $(this).css(\"cursor\", \"not-allowed\"); });\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).removeClass(\"disabled\").on(\"mouseover\", function() { $(this).css(\"cursor\", \"pointer\"); });\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_hide(buttonName, hideButton, buttonRow)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if (hideButton) {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).hide();\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        $(\"#sc-actionbar-actbtn_\" + buttonName + buttonRow).show();\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_linkSubmit5(link_selector, apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor, confirm)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if ($(\"#\" + link_selector).hasClass(\"disabled\")) {\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    if ('' != confirm) {\r\n");
           $nm_saida->saida("        scJs_confirm(confirm, function() { nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor); }, function() {});\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function actionBar_linkSubmit6(link_selector, apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor, confirm)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    if ($(\"#\" + link_selector).hasClass(\"disabled\")) {\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    if ('' != confirm) {\r\n");
           $nm_saida->saida("        scJs_confirm(confirm, function() { nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor); }, function() {});\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("</script>\r\n");
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $tippyThemeInfo['file'] . "\" />\r\n");
}
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light-border.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/material.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/translucent.css\" />\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/popper.min.js\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/tippy-bundle.umd.min.js\"></script>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("function scAddTippyGridLabel()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("$(function() {\r\n");
           $nm_saida->saida("    scAddTippyGridLabel();\r\n");
           $nm_saida->saida("});\r\n");
           $nm_saida->saida("</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/bluebird.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
        $Fix_Bar_top_height = 0;

        if ($this->Fix_bar_top) {
               $Fix_Bar_top_height  = "((typeof(getAppData) != 'undefined' && getAppData().improvements) && $('#sc_grid_toobar_top').outerHeight()) ? 0 : $('#sc_grid_toobar_top').outerHeight()";
        }           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("var scFixCol_left = 0, scFixCol_list = [], scFixCol_selectedFields = [];\r\n");
           $nm_saida->saida("function scFixCol()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var i;\r\n");
           $nm_saida->saida("    scFixCol_left = 0;\r\n");
           $nm_saida->saida("    scFixCol_list = [];\r\n");
           $nm_saida->saida("    scFixCol_addFieldColumns();\r\n");
           $nm_saida->saida("    for (i = 0; i < scFixCol_list.length; i++) {\r\n");
           $nm_saida->saida("        scFixCol_fix(scFixCol_list[i].type, scFixCol_list[i].name);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_clear()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    let colList;\r\n");
           $nm_saida->saida("    scFixCol_selectedFields = [];\r\n");
           $nm_saida->saida("    colList = $(\".sc-col-op,.sc-col-fld\");\r\n");
           $nm_saida->saida("    colList.css({\r\n");
           $nm_saida->saida("        \"position\": \"static\",\r\n");
           $nm_saida->saida("        \"left\": \"auto\"\r\n");
           $nm_saida->saida("    }).removeClass(\"sc-col-is-fixed\");\r\n");
           $nm_saida->saida("    colList.filter(\".sc-header-fixed\").css({\r\n");
           $nm_saida->saida("        \"position\": \"sticky\"\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_addFieldColumns()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var i;\r\n");
           $nm_saida->saida("    for (i = 0; i < scFixCol_selectedFields.length; i++) {\r\n");
           $nm_saida->saida("        scFixCol_list.push({\"type\": \"fld\", \"name\": scFixCol_selectedFields[i]});\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_fix(type, columnName)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var columnCells = $(\".sc-col-\" + type + \"-\" + columnName), thisWidth = 0;\r\n");
           $nm_saida->saida("    if (columnCells.length) {\r\n");
           $nm_saida->saida("        thisWidth = columnCells[0].offsetWidth;\r\n");
           $nm_saida->saida("        columnCells.css({\r\n");
           $nm_saida->saida("            'position': 'sticky',\r\n");
           $nm_saida->saida("            'left': scFixCol_left,\r\n");
           $nm_saida->saida("            'z-index': 3\r\n");
           $nm_saida->saida("        }).addClass(\"sc-col-is-fixed\");\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    scFixCol_left += thisWidth;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_fixTop()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var columnCells = $(\".sc-col-title\");\r\n");
           $nm_saida->saida("    if (!document._toolbarHeightFix) {\r\n");
           $nm_saida->saida("        document._toolbarHeightFix = " . $Fix_Bar_top_height . ";\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    var css_properties = {\r\n");
           $nm_saida->saida("        'position': 'sticky',\r\n");
           $nm_saida->saida("        'z-index': 4\r\n");
           $nm_saida->saida("    };\r\n");
           $nm_saida->saida("    if (typeof(getAppData) != 'undefined') {\r\n");
           $nm_saida->saida("        if (!getAppData().improvements) {\r\n");
           $nm_saida->saida("            css_properties.top = document._toolbarHeightFix;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        css_properties.top = document._toolbarHeightFix;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    columnCells.css(css_properties);\r\n");
           $nm_saida->saida("    columnCells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("    columnCells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_clickColumn(columnId)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var action;\r\n");
           $nm_saida->saida("    action = scFixCol_fixColumns(columnId, \"click\");\r\n");
           $nm_saida->saida("    scFixCol_saveConfig(columnId, action);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_fixColumns(columnId, fixAction)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    var action = \"\";\r\n");
           $nm_saida->saida("    if (\"click\" == fixAction) {\r\n");
           $nm_saida->saida("        action = scFixCol_setControlState(columnId);\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        scFixCol_resetControlState(columnId);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    scFixCol_clear();\r\n");
           $nm_saida->saida("    scFixCol_addFixedCells();\r\n");
           $nm_saida->saida("    scFixCol();\r\n");
           $nm_saida->saida("    scFixCol_fixTop();\r\n");
           $nm_saida->saida("    return action;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_setControlState(columnId)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    let i, fixColLength, action;\r\n");
           $nm_saida->saida("    if ($(\"#sc-fld-fix-col-\" + columnId).hasClass(\"sc-op-fix-col-notfixed\")) {\r\n");
           $nm_saida->saida("        action = \"on\";\r\n");
           $nm_saida->saida("        for (i = 0; i <= columnId; i++) {\r\n");
           $nm_saida->saida("            $(\".sc-op-fix-col-\" + i).removeClass(\"sc-op-fix-col-notfixed\").addClass(\"sc-op-fix-col-fixed\");\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    } else {\r\n");
           $nm_saida->saida("        action = \"off\";\r\n");
           $nm_saida->saida("        fixColLength = $(\".sc-op-fix-col\").length;\r\n");
           $nm_saida->saida("        for (i = columnId; i < fixColLength; i++) {\r\n");
           $nm_saida->saida("            $(\".sc-op-fix-col-\" + i).removeClass(\"sc-op-fix-col-fixed\").addClass(\"sc-op-fix-col-notfixed\");\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    return action;\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_resetControlState(columnId)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    let i;\r\n");
           $nm_saida->saida("    $(\".sc-op-fix-col\").addClass(\"sc-op-fix-col-notfixed\").removeClass(\"sc-op-fix-col-fixed\");\r\n");
           $nm_saida->saida("    if (\"\" == columnId) {\r\n");
           $nm_saida->saida("        return;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    for (i = 0; i <= columnId; i++) {\r\n");
           $nm_saida->saida("        $(\".sc-op-fix-col-\" + i).removeClass(\"sc-op-fix-col-notfixed\").addClass(\"sc-op-fix-col-fixed\");\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_addFixedCells()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    selectedFields = $(\".sc-ui-grid-header-row-cons_planilha-1 .sc-op-fix-col.sc-op-fix-col-fixed\");\r\n");
           $nm_saida->saida("    for (i = 0; i < selectedFields.length; i++) {\r\n");
           $nm_saida->saida("        scFixCol_selectedFields.push($(selectedFields[i]).attr(\"id\").substr(15));\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_saveConfig(index, action)\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    $.ajax({\r\n");
           $nm_saida->saida("        url: \"index.php\",\r\n");
           $nm_saida->saida("        dataType: \"json\",\r\n");
           $nm_saida->saida("        method: \"POST\",\r\n");
           $nm_saida->saida("        data: {\r\n");
           $nm_saida->saida("            script_case_init: \"" . $this->Ini->sc_page . "\",\r\n");
           $nm_saida->saida("            nmgp_opcao: \"ajax_fixed_columns_grid_save\",\r\n");
           $nm_saida->saida("            fixed_index: index,\r\n");
           $nm_saida->saida("            fixed_action: action\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    }).done(function(data, textStatus, jqXHR) {\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_loadState()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    $.ajax({\r\n");
           $nm_saida->saida("        url: \"index.php\",\r\n");
           $nm_saida->saida("        dataType: \"json\",\r\n");
           $nm_saida->saida("        method: \"POST\",\r\n");
           $nm_saida->saida("        data: {\r\n");
           $nm_saida->saida("            script_case_init: \"" . $this->Ini->sc_page . "\",\r\n");
           $nm_saida->saida("            nmgp_opcao: \"ajax_fixed_columns_grid_load\"\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    }).done(function(data, textStatus, jqXHR) {\r\n");
           $nm_saida->saida("        if (typeof data.status !== undefined && \"ok\" == data.status) {\r\n");
           $nm_saida->saida("            scFixCol_fixColumns(data.last_index, \"load\");\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_addClickControl()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    $(\".sc-op-fix-col\").on(\"click\", function() {\r\n");
           $nm_saida->saida("        scFixCol_clickColumn($(this).attr(\"data-fixcolid\"));\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("$(function()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    scFixCol();\r\n");
           $nm_saida->saida("    scFixCol_addClickControl();\r\n");
           $nm_saida->saida("    scFixCol_loadState();\r\n");
           $nm_saida->saida("    $(window).on('resize', function() {\r\n");
           $nm_saida->saida("        scFixCol_loadState();\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("});\r\n");
           $nm_saida->saida("</script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida']) { 
           $nm_saida->saida("            <script>\r\n");
           $nm_saida->saida("                $(document).ready(function(){\r\n");
           $nm_saida->saida("                    bootstrapMobile();\r\n");
           $nm_saida->saida("                });\r\n");
           $nm_saida->saida("            </script>\r\n");
           }
           $fixColNotFixedVisivility = $_SESSION['scriptcase']['proc_mobile'] ? 'visible' : 'hidden';
           $fixColNotFixedOpacity = $_SESSION['scriptcase']['proc_mobile'] ? '1' : '1';
           $nm_saida->saida("    <style type=\"text/css\">\r\n");
           $nm_saida->saida("        .sc-col-actions {\r\n");
           $nm_saida->saida("            text-align: center !important;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        .sc-op-fix-col {\r\n");
           $nm_saida->saida("            padding: 0 2px;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        .sc-op-fix-col:hover {\r\n");
           $nm_saida->saida("            cursor: pointer;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        .sc-op-fix-col-notfixed {\r\n");
           $nm_saida->saida("            visibility: " . $fixColNotFixedVisivility . ";\r\n");
           $nm_saida->saida("            opacity: 0.5;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        .scGridLabelFont:hover .sc-op-fix-col-notfixed {\r\n");
           $nm_saida->saida("            visibility: visible;\r\n");
           $nm_saida->saida("            opacity: " . $fixColNotFixedOpacity . ";\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
           { 
               $nm_saida->saida("   function sc_session_redir(url_redir)\r\n");
               $nm_saida->saida("   {\r\n");
           $nm_saida->saida("       if (typeof(sc_session_redir_mobile) === typeof(function(){})) { sc_session_redir_mobile(url_redir); }\r\n");
               $nm_saida->saida("       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           window.parent.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("       else\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.close();\r\n");
               $nm_saida->saida("               window.opener.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("           else\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.location = url_redir;\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("   }\r\n");
           }
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("   var SC_Link_View   = false;\r\n");
           $nm_saida->saida("   var SC_Proc_Mobile = false;\r\n");
           if ($this->Ini->SC_Link_View) {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           if ($_SESSION['scriptcase']['proc_mobile']) {
               $nm_saida->saida("   SC_Proc_Mobile = true;\r\n");
           }
           $nm_saida->saida("   var Qsearch_ok = true;\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] != "on")
           {
               $nm_saida->saida("   Qsearch_ok = false;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid']) . ";\r\n");
           }
           $gridWidthCorrection = '';
           if (false !== strpos($this->Ini->grid_table_width, 'calc')) {
               $gridWidthCalc = substr($this->Ini->grid_table_width, strpos($this->Ini->grid_table_width, '(') + 1);
               $gridWidthCalc = substr($gridWidthCalc, 0, strpos($gridWidthCalc, ')'));
               $gridWidthParts = explode(' ', $gridWidthCalc);
               if (3 == count($gridWidthParts) && 'px' == substr($gridWidthParts[2], -2)) {
                   $gridWidthParts[2] = substr($gridWidthParts[2], 0, -2) / 2;
                   $gridWidthCorrection = $gridWidthParts[1] . ' ' . $gridWidthParts[2];
               }
           }
           $Fix_Bar_top_height  = ($this->Fix_bar_top) ? "(\$('#sc_grid_toobar_top').outerHeight()) ? \$('#sc_grid_toobar_top').outerHeight() : 0" : 0;
           $nm_saida->saida("    function scFixZindexCornerCells()\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let cells = $(\".sc-ui-grid-header-row-cons_planilha-1\").find(\"td\");\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    function scSetFixedHeadersCss(baseTop)\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let rows, cols, i, j, thisTop;\r\n");
           $nm_saida->saida("        rows = $(\".sc-ui-grid-header-row-cons_planilha-1\");\r\n");
           $nm_saida->saida("        thisTop = baseTop;\r\n");
           $nm_saida->saida("        for (i = 0; i < rows.length; i++) {\r\n");
           $nm_saida->saida("            cols = $(rows[i]).find(\"td\").filter(\".scGridLabelFont\");\r\n");
           $nm_saida->saida("            for (j = 0; j < cols.length; j++) {\r\n");
           $nm_saida->saida("                $(cols[j]).css({\r\n");
           $nm_saida->saida("                    \"position\": \"sticky\",\r\n");
           $nm_saida->saida("                    \"top\": thisTop + \"px\",\r\n");
           $nm_saida->saida("                    \"z-index\": 4\r\n");
           $nm_saida->saida("                }).addClass(\"sc-header-fixed\");\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("            thisTop += $(rows[i]).height();\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        scFixZindexCornerCells();\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    $(function() {\r\n");
           $nm_saida->saida("        if (document._toolbarHeightFix == undefined) {\r\n");
           $nm_saida->saida("            document._toolbarHeightFix = " . $Fix_Bar_top_height . ";\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        var hVal = document._toolbarHeightFix;\r\n");
           $nm_saida->saida("        if (typeof(getAppData) != 'undefined') {\r\n");
           $nm_saida->saida("            if (getAppData().improvements) {\r\n");
           $nm_saida->saida("                hVal = 0;\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        scSetFixedHeadersCss(hVal);\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("  function scSetFixedHeaders() {\r\n");
           $nm_saida->saida("   return;alert(2);\r\n");
           $nm_saida->saida("   var divScroll, gridHeaders, headerPlaceholder;\r\n");
           $nm_saida->saida("   gridHeaders = scGetHeaderRow();\r\n");
           $nm_saida->saida("   headerPlaceholder = $(\"#sc-id-fixedheaders-placeholder\");\r\n");
           $nm_saida->saida("   if (!gridHeaders) {\r\n");
           $nm_saida->saida("     headerPlaceholder.hide();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   else {\r\n");
           $nm_saida->saida("    scSetFixedHeadersContents(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("    scSetFixedHeadersSize(gridHeaders);\r\n");
           $nm_saida->saida("    scSetFixedHeadersPosition(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("    if (scIsHeaderVisible(gridHeaders)) {\r\n");
           $nm_saida->saida("     headerPlaceholder.hide();\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    else {\r\n");
           $nm_saida->saida("     headerPlaceholder.show();\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersPosition(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   if(gridHeaders)\r\n");
           $nm_saida->saida("   {\r\n");
           $nm_saida->saida("       headerPlaceholder.css({\"top\": 0" . $gridWidthCorrection . ", \"left\": (Math.floor(gridHeaders.offset().left) - $(document).scrollLeft()" . $gridWidthCorrection . ") + \"px\"});\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scIsHeaderVisible(gridHeaders) {\r\n");
           $nm_saida->saida("   if (typeof(scIsHeaderVisibleMobile) === typeof(function(){})) { return scIsHeaderVisibleMobile(gridHeaders); }\r\n");
           $nm_saida->saida("   return gridHeaders.offset().top > $(document).scrollTop();\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scGetHeaderRow() {\r\n");
           $nm_saida->saida("   var gridHeaders = $(\".sc-ui-grid-header-row-cons_planilha-1\"), headerDisplayed = true;\r\n");
           $nm_saida->saida("   if (!gridHeaders.length) {\r\n");
           $nm_saida->saida("    headerDisplayed = false;\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   else {\r\n");
           $nm_saida->saida("    if (!gridHeaders.filter(\":visible\").length) {\r\n");
           $nm_saida->saida("     headerDisplayed = false;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   if (!headerDisplayed) {\r\n");
           $nm_saida->saida("    gridHeaders = $(\".sc-ui-grid-header-row\").filter(\":visible\");\r\n");
           $nm_saida->saida("    if (gridHeaders.length) {\r\n");
           $nm_saida->saida("     gridHeaders = $(gridHeaders[0]);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    else {\r\n");
           $nm_saida->saida("     gridHeaders = false;\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   return gridHeaders;\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersContents(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   var i, htmlContent;\r\n");
           $nm_saida->saida("   htmlContent = \"<table id=\\\"sc-id-fixed-headers\\\" class=\\\"scGridTabela\\\">\";\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    htmlContent += \"<tr class=\\\"scGridLabel\\\" id=\\\"sc-id-fixed-headers-row-\" + i + \"\\\">\" + $(gridHeaders[i]).html() + \"</tr>\";\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   htmlContent += \"</table>\";\r\n");
           $nm_saida->saida("   headerPlaceholder.html(htmlContent);\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersSize(gridHeaders) {\r\n");
           $nm_saida->saida("   var i, j, headerColumns, gridColumns, cellHeight, cellWidth, tableOriginal, tableHeaders;\r\n");
           $nm_saida->saida("   tableOriginal = document.getElementById(\"sc-ui-grid-body-34e74778\");\r\n");
           $nm_saida->saida("   tableHeaders = document.getElementById(\"sc-id-fixed-headers\");\r\n");
           $nm_saida->saida("    tableWidth = $(tableOriginal).outerWidth();\r\n");
           $nm_saida->saida("   $(tableHeaders).css(\"width\", tableWidth);\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    headerColumns = $(\"#sc-id-fixed-headers-row-\" + i).find(\"td\");\r\n");
           $nm_saida->saida("    gridColumns = $(gridHeaders[i]).find(\"td\");\r\n");
           $nm_saida->saida("    for (j = 0; j < gridColumns.length; j++) {\r\n");
           $nm_saida->saida("     if (window.getComputedStyle(gridColumns[j])) {\r\n");
           $nm_saida->saida("      cellWidth = window.getComputedStyle(gridColumns[j]).width;\r\n");
           $nm_saida->saida("      cellHeight = window.getComputedStyle(gridColumns[j]).height;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else {\r\n");
           $nm_saida->saida("      cellWidth = $(gridColumns[j]).width() + \"px\";\r\n");
           $nm_saida->saida("      cellHeight = $(gridColumns[j]).height() + \"px\";\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $(headerColumns[j]).css({\r\n");
           $nm_saida->saida("      \"width\": cellWidth,\r\n");
           $nm_saida->saida("      \"height\": cellHeight\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     NM_btn_disable();\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     \$('#SC_fast_search_top').keyup(function(e) {\r\n");
               $nm_saida->saida("       scQuickSearchKeyUp('top', e);\r\n");
               $nm_saida->saida("     });\r\n");
           }
           $nm_saida->saida("     $('#id_F0_top').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#id_F0_bot').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").mouseup(function(event){\r\n");
           $nm_saida->saida("          event.preventDefault();\r\n");
           $nm_saida->saida("          if(event.target !== event.currentTarget) return;\r\n");
           $nm_saida->saida("          if($(this).find(\"a\").prop('href') != '')\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              $(this).find(\"a\").click();\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("          else\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              eval($(this).find(\"a\").prop('onclick'));\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("   \$(window).on('load', function() {\r\n");
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ancor_save']);
           }
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     scQuickSearchKeyUp('top', null);\r\n");
           }
           $nm_saida->saida("   });\r\n");
           $nm_saida->saida("   function scQuickSearchSubmit_top() {\r\n");
           $nm_saida->saida("     document.F0_top.nmgp_opcao.value = 'fast_search';\r\n");
           $nm_saida->saida("     document.F0_top.submit();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scQuickSearchKeyUp(sPos, e) {\r\n");
           $nm_saida->saida("     if (null != e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("         if ('top' == sPos) nm_gp_submit_qsearch('top');\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       else\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("           $('#SC_fast_search_submit_top').show();\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_groupby_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnGroupByHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#sel_groupby_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_groupby_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_sel_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnSelCamposHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#selcmp_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_sel_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
$nm_saida->saida("function ajax_check_file(img_name, field , i , p, p_cache){\r\n");
$nm_saida->saida("    $(document).ready(function(){\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+'> img').attr('src', '" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+' > a > img').attr('src', '" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("        $('#id_sc_field_'+ field +'_'+i+' > span > a > img').attr('src', '" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("    var rs =$.ajax({\r\n");
$nm_saida->saida("                type: \"POST\",\r\n");
$nm_saida->saida("                url: 'index.php?script_case_init=" . $this->Ini->sc_page . "',\r\n");
$nm_saida->saida("                async: true,\r\n");
$nm_saida->saida("                data: 'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + img_name +'&rsargs='+ field + '&p='+ p + '&p_cache='+ p_cache,\r\n");
$nm_saida->saida("            }).done(function (rs) {\r\n");
$nm_saida->saida("                    if(rs.indexOf('</span>') != -1){\r\n");
$nm_saida->saida("                        rs = rs.substr(rs.indexOf('</span>')  + 7);\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                    if (rs != 0) {\r\n");
$nm_saida->saida("                        rs = rs.trim();\r\n");
$nm_saida->saida("                        rs_split = rs.split('_@@NM@@_');\r\n");
$nm_saida->saida("                        rs_orig = rs_split[0];\r\n");
$nm_saida->saida("                        rs = rs_split[1];\r\n");
$nm_saida->saida("                        if($('#id_sc_field_'+ field +'_'+i+'  > a > img').length != 0){\r\n");
$nm_saida->saida("                            $('#id_sc_field_'+ field +'_'+i+'  > a > img').attr('src', rs);\r\n");
$nm_saida->saida("                            $('#id_sc_field_'+ field +'_'+i+'> img').attr('src', rs);\r\n");
$nm_saida->saida("                            var __tmp = $('#id_sc_field_'+ field +'_'+i+'  > a').attr('href').split(\"',\")\r\n");
$nm_saida->saida("                            __tmp[0] = \"javascript:nm_mostra_img('\" + rs_orig;\r\n");
$nm_saida->saida("                            $('#id_sc_field_'+ field +'_'+i+'  > a').attr('href',__tmp.join(\"',\"));\r\n");
$nm_saida->saida("                        }else{\r\n");
$nm_saida->saida("                            if($('#id_sc_field_'+ field +'_'+i+' > a').length > 0 && ($('#id_sc_field_'+ field +'_'+i+' > a').attr('href')).indexOf('@SC_par@') != -1){\r\n");
$nm_saida->saida("                                var __file_doc = $('#id_sc_field_'+ field +'_'+i+' > a').attr('href').split('@SC_par@');\r\n");
$nm_saida->saida("                                var ___file_doc = __file_doc[3].split(\"'\");\r\n");
$nm_saida->saida("                                ___file_doc[0] = rs;\r\n");
$nm_saida->saida("                                __file_doc[3] = ___file_doc.join(\"'\");\r\n");
$nm_saida->saida("                                $('#id_sc_field_'+ field +'_'+i+'  > a').attr('href', __file_doc.join('@SC_par@') );\r\n");
$nm_saida->saida("                            }\r\n");
$nm_saida->saida("                            else{\r\n");
$nm_saida->saida("                                if($('#id_sc_field_'+field+'_'+i+' > span > a').length > 0){\r\n");
$nm_saida->saida("                                    var __tmp = $('#id_sc_field_'+field+'_'+i+' > span > a').attr('href').split(\"',\");\r\n");
$nm_saida->saida("                                    if(__tmp[0].indexOf('nm_mostra_img') != -1){\r\n");
$nm_saida->saida("                                        __tmp[0] = \"javascript:nm_mostra_img('\" + rs_orig;\r\n");
$nm_saida->saida("                                    } else{\r\n");
$nm_saida->saida("                                        var __file_doc = __tmp[0].split('@SC_par@');\r\n");
$nm_saida->saida("                                        var ___file_doc = __file_doc[3].split(\"'\");\r\n");
$nm_saida->saida("                                        ___file_doc[0] = rs;\r\n");
$nm_saida->saida("                                        __file_doc[3] = ___file_doc.join(\"'\");\r\n");
$nm_saida->saida("                                        __tmp[0] = __file_doc.join('@SC_par@');\r\n");
$nm_saida->saida("                                        $('#id_sc_field_'+field+'_'+i+' > span > a').attr('href', __tmp.join(\"',\"));\r\n");
$nm_saida->saida("                                        //__tmp[1] = \"'\"+rs_orig+\"')\";\r\n");
$nm_saida->saida("                                    }\r\n");
$nm_saida->saida("                                    $('#id_sc_field_'+field+'_'+i+' > span > a').attr('href',__tmp.join(\"',\"));\r\n");
$nm_saida->saida("                                }\r\n");
$nm_saida->saida("                                $('#id_sc_field_'+ field +'_'+i+' > img').attr('src', rs);\r\n");
$nm_saida->saida("                                $('#id_sc_field_'+ field +'_'+i+' > a > img').attr('src', rs);\r\n");
$nm_saida->saida("                                $('#id_sc_field_'+ field +'_'+i+' > span > a > img').attr('src', rs);\r\n");
$nm_saida->saida("                            }\r\n");
$nm_saida->saida("                        }\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                });\r\n");
$nm_saida->saida("    });\r\n");
$nm_saida->saida("}\r\n");
           $nm_saida->saida("   function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_order_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           if ($_SESSION['scriptcase']['proc_mobile']) { 
               $nm_saida->saida("         //return;\r\n");
           }
           else {
               $nm_saida->saida("         scBtnOrderCamposHide(sPos);\r\n");
               $nm_saida->saida("         $(\"#ordcmp_\" + sPos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("         return;\r\n");
           }
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_order_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).addClass('selected');\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = '';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     }).mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': '0px'\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup, bForce) {\r\n");
           $nm_saida->saida("     if (bForce || 'over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("       $('#sc_btgp_btn_' + sGroup).removeClass('selected');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
       } 
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida(".sc-badge-pill {\r\n");
       $nm_saida->saida("    padding-right: 0.6em;\r\n");
       $nm_saida->saida("    padding-left: 0.6em;\r\n");
       $nm_saida->saida("    border-radius: 10rem;\r\n");
       $nm_saida->saida("    font-size: 85%;\r\n");
       $nm_saida->saida("    font-weight: bold;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-blue {\r\n");
       $nm_saida->saida("        background-color: #dbeafe;\r\n");
       $nm_saida->saida("        color: #1e40af;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-brown {\r\n");
       $nm_saida->saida("    background-color: #ffe4b5;\r\n");
       $nm_saida->saida("    color: #a52a2a;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-cyan {\r\n");
       $nm_saida->saida("    background-color: #afeeee;\r\n");
       $nm_saida->saida("    color: #008b8b;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-gray {\r\n");
       $nm_saida->saida("        background-color: #f3f4f6;\r\n");
       $nm_saida->saida("        color: #1f2937;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-green {\r\n");
       $nm_saida->saida("        background-color: #dcfce7;\r\n");
       $nm_saida->saida("        color: #166534;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-orange {\r\n");
       $nm_saida->saida("        background-color: #ffe5b4;\r\n");
       $nm_saida->saida("        color: #ff8c00;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-pink {\r\n");
       $nm_saida->saida("    background-color: #fddde6;\r\n");
       $nm_saida->saida("    color: #ff1493;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-purple {\r\n");
       $nm_saida->saida("    background-color: #f5e7ff;\r\n");
       $nm_saida->saida("    color: #60289a;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-red {\r\n");
       $nm_saida->saida("        background-color: #fee2e2;\r\n");
       $nm_saida->saida("        color: #991b1b;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-yellow {\r\n");
       $nm_saida->saida("        background-color: #fef9c3;\r\n");
       $nm_saida->saida("        color: #854d0e;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word']) {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
       }
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_planilha_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
       {
           $this->NM_field_over  = 0;
           $this->NM_field_click = 0;
           $Css_sub_cons = array();
           if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           else 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           if (is_file($this->Ini->path_css . $NM_css_file))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (is_file($this->Ini->path_css . $NM_css_dir))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (!empty($Css_sub_cons))
           {
               $Css_sub_cons = array_unique($Css_sub_cons);
               foreach ($Css_sub_cons as $Cada_css_sub)
               {
                   if (is_file($this->Ini->path_css . $Cada_css_sub))
                   {
                       $compl_css = str_replace(".", "_", $Cada_css_sub);
                       $temp_css  = explode("/", $compl_css);
                       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
                       $NM_css_attr = file($this->Ini->path_css . $Cada_css_sub);
                       foreach ($NM_css_attr as $NM_line_css)
                       {
                           $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                           if ($write_css) {@fwrite($NM_css, "    ." .  $compl_css . "_" . substr(trim($NM_line_css), 1) . "\r\n");}
                       }
                   }
               }
           }
       }
       if ($write_css) {@fclose($NM_css);}
           $this->NM_css_val_embed .= "win";
           $this->NM_css_ajx_embed .= "ult_set";
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->str_google_fonts . "\" />\r\n");
 } 
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       elseif ($this->NM_opcao == "print" || $this->Print_All)
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_planilha_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['num_css'] . '.css');
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("  </style>\r\n");
       }
       else
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_cons_planilha_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_planilha/cons_planilha_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("    " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert'])
  {
   $nm_saida->saida("      thead { display: table-header-group !important; }\r\n");
   $nm_saida->saida("      tfoot { display: table-row-group !important; }\r\n");
   $nm_saida->saida("      table td, table tr, td, tr, table { page-break-inside: avoid !important; }\r\n");
   $nm_saida->saida("      #summary_body > td { padding: 0px !important; }\r\n");
  }
           $nm_saida->saida("  </style>\r\n");
       }
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_planilha/cons_planilha_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".cons_planilha_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .cons_planilha_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".cons_planilha_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida    = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['css_body_embutida'] : "";
   $this->css_remove_margin     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['link_info']['remove_margin']))     ? "margin: 0;" : "";
   $this->css_remove_border     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['link_info']['remove_border']))     ? "border-width: 0;" : "";
   $this->css_remove_background = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['link_info']['remove_background'])) ? "background-color: transparent; background-image: none;" : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
           $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $this->Tab_width . ">\r\n");
           $nm_saida->saida("     <TR>\r\n");
           $nm_saida->saida("       <TD>\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $nm_saida->saida("       </TD>\r\n");
           $nm_saida->saida("     </TR>\r\n");
           $nm_saida->saida("   </TABLE>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     $(\"#Bprint_print\").addClass(\"disabled\").prop(\"disabled\", true);\r\n");
           $nm_saida->saida("     $(function() {\r\n");
           $nm_saida->saida("         $(\"#Bprint_print\").removeClass(\"disabled\").prop(\"disabled\", false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     function prit_web_page()\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("        if ($(\"#Bprint_print\").prop(\"disabled\")) {\r\n");
           $nm_saida->saida("            return;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
           $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
           $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
           $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
           $nm_saida->saida("        window.print();\r\n");
           $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("  </script>\r\n");
       }
       else
       {
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
          $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
          $vertical_center = '';
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $remove_background . $vertical_center . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && !$this->Print_All && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . $this->css_remove_border . "\">\r\n");
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_planilha']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_planilha']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_planilha']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_planilha']) . "_";
           } 
       }
   }
   $temp_css  = explode("/", $compl_css);
   if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
   $this->css_scGridPage           = $compl_css . "scGridPage";
   $this->css_scGridPageLink       = $compl_css . "scGridPageLink";
   $this->css_scGridToolbar        = $compl_css . "scGridToolbar";
   $this->css_scGridToolbarPadd    = $compl_css . "scGridToolbarPadding";
   $this->css_css_toolbar_obj      = $compl_css . "css_toolbar_obj";
   $this->css_scGridHeader         = $compl_css . "scGridHeader";
   $this->css_scGridHeaderFont     = $compl_css . "scGridHeaderFont";
   $this->css_scGridFooter         = $compl_css . "scGridFooter";
   $this->css_scGridFooterFont     = $compl_css . "scGridFooterFont";
   $this->css_scGridBlock          = $compl_css . "scGridBlock";
   $this->css_scGridBlockFont      = $compl_css . "scGridBlockFont";
   $this->css_scGridBlockAlign     = $compl_css . "scGridBlockAlign";
   $this->css_scGridTotal          = $compl_css . "scGridTotal";
   $this->css_scGridTotalFont      = $compl_css . "scGridTotalFont";
   $this->css_scGridSubtotal       = $compl_css . "scGridSubtotal";
   $this->css_scGridSubtotalFont   = $compl_css . "scGridSubtotalFont";
   $this->css_scGridFieldEven      = $compl_css . "scGridFieldEven";
   $this->css_scGridFieldEvenFont  = $compl_css . "scGridFieldEvenFont";
   $this->css_scGridFieldEvenVert  = $compl_css . "scGridFieldEvenVert";
   $this->css_scGridFieldEvenLink  = $compl_css . "scGridFieldEvenLink";
   $this->css_scGridFieldOdd       = $compl_css . "scGridFieldOdd";
   $this->css_scGridFieldOddFont   = $compl_css . "scGridFieldOddFont";
   $this->css_scGridFieldOddVert   = $compl_css . "scGridFieldOddVert";
   $this->css_scGridFieldOddLink   = $compl_css . "scGridFieldOddLink";
   $this->css_scGridFieldClick     = $compl_css . "scGridFieldClick";
   $this->css_scGridFieldOver      = $compl_css . "scGridFieldOver";
   $this->css_scGridLabel          = $compl_css . "scGridLabel";
   $this->css_scGridLabelVert      = $compl_css . "scGridLabelVert";
   $this->css_scGridLabelFont      = $compl_css . "scGridLabelFont";
   $this->css_scGridLabelLink      = $compl_css . "scGridLabelLink";
   $this->css_scGroupLabeldOdd     = $compl_css . "scGridLabelOddFont";
   $this->css_scGroupLabelEven     = $compl_css . "scGridLabelEvenFont";
   $this->css_scGridTabela         = $compl_css . "scGridTabela";
   $this->css_scGridTabelaTd       = $compl_css . "scGridTabelaTd";
   $this->css_scGridBlockBg        = $compl_css . "scGridBlockBg";
   $this->css_scGridBlockLineBg    = $compl_css . "scGridBlockLineBg";
   $this->css_scGridBlockSpaceBg   = $compl_css . "scGridBlockSpaceBg";
   $this->css_scGridLabelNowrap    = "";
   $this->css_scAppDivMoldura      = $compl_css . "scAppDivMoldura";
   $this->css_scAppDivHeader       = $compl_css . "scAppDivHeader";
   $this->css_scAppDivHeaderText   = $compl_css . "scAppDivHeaderText";
   $this->css_scAppDivContent      = $compl_css . "scAppDivContent";
   $this->css_scAppDivContentText  = $compl_css . "scAppDivContentText";
   $this->css_scAppDivToolbar      = $compl_css . "scAppDivToolbar";
   $this->css_scAppDivToolbarInput = $compl_css . "scAppDivToolbarInput";
   $this->css_scGridFilterDynResult = $compl_css . "scGridFilterDynResult";
   $this->css_scGridFilterDynField = $compl_css . "scGridFilterDynField";
   $this->css_scGridFilterDynValue = $compl_css . "scGridFilterDynValue";
   $this->css_inherit_bg           = "scInheritBg";

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida']) ? "cons_planilha_" : "";
   $this->css_sep = " ";
   $this->css_pc_dt_registro_label = $compl_css_emb . "css_pc_dt_registro_label";
   $this->css_pc_dt_registro_grid_line = $compl_css_emb . "css_pc_dt_registro_grid_line";
   $this->css_pc_fornecedor_id_label = $compl_css_emb . "css_pc_fornecedor_id_label";
   $this->css_pc_fornecedor_id_grid_line = $compl_css_emb . "css_pc_fornecedor_id_grid_line";
   $this->css_pc_proc_compra_id_label = $compl_css_emb . "css_pc_proc_compra_id_label";
   $this->css_pc_proc_compra_id_grid_line = $compl_css_emb . "css_pc_proc_compra_id_grid_line";
   $this->css_pc_cod_situacao_label = $compl_css_emb . "css_pc_cod_situacao_label";
   $this->css_pc_cod_situacao_grid_line = $compl_css_emb . "css_pc_cod_situacao_grid_line";
   $this->css_pc_cod_proc_fornec_label = $compl_css_emb . "css_pc_cod_proc_fornec_label";
   $this->css_pc_cod_proc_fornec_grid_line = $compl_css_emb . "css_pc_cod_proc_fornec_grid_line";
   $this->css_pc_qt_dias_translado_label = $compl_css_emb . "css_pc_qt_dias_translado_label";
   $this->css_pc_qt_dias_translado_grid_line = $compl_css_emb . "css_pc_qt_dias_translado_grid_line";
   $this->css_pc_observacao_label = $compl_css_emb . "css_pc_observacao_label";
   $this->css_pc_observacao_grid_line = $compl_css_emb . "css_pc_observacao_grid_line";
   $this->css_pc_dt_limite_label = $compl_css_emb . "css_pc_dt_limite_label";
   $this->css_pc_dt_limite_grid_line = $compl_css_emb . "css_pc_dt_limite_grid_line";
   $this->css_pc_log_facilid_contato_fornec_label = $compl_css_emb . "css_pc_log_facilid_contato_fornec_label";
   $this->css_pc_log_facilid_contato_fornec_grid_line = $compl_css_emb . "css_pc_log_facilid_contato_fornec_grid_line";
   $this->css_ipc_item_proc_compra_id_label = $compl_css_emb . "css_ipc_item_proc_compra_id_label";
   $this->css_ipc_item_proc_compra_id_grid_line = $compl_css_emb . "css_ipc_item_proc_compra_id_grid_line";
   $this->css_ipc_descricao_label = $compl_css_emb . "css_ipc_descricao_label";
   $this->css_ipc_descricao_grid_line = $compl_css_emb . "css_ipc_descricao_grid_line";
   $this->css_ipc_codigo_erp_label = $compl_css_emb . "css_ipc_codigo_erp_label";
   $this->css_ipc_codigo_erp_grid_line = $compl_css_emb . "css_ipc_codigo_erp_grid_line";
   $this->css_ipc_qt_dias_producao_label = $compl_css_emb . "css_ipc_qt_dias_producao_label";
   $this->css_ipc_qt_dias_producao_grid_line = $compl_css_emb . "css_ipc_qt_dias_producao_grid_line";
   $this->css_ipc_unid_medida_label = $compl_css_emb . "css_ipc_unid_medida_label";
   $this->css_ipc_unid_medida_grid_line = $compl_css_emb . "css_ipc_unid_medida_grid_line";
   $this->css_ipc_qt_comprada_label = $compl_css_emb . "css_ipc_qt_comprada_label";
   $this->css_ipc_qt_comprada_grid_line = $compl_css_emb . "css_ipc_qt_comprada_grid_line";
   $this->css_ipc_vl_custo_dolar_label = $compl_css_emb . "css_ipc_vl_custo_dolar_label";
   $this->css_ipc_vl_custo_dolar_grid_line = $compl_css_emb . "css_ipc_vl_custo_dolar_grid_line";
   $this->css_ipc_vl_base_tributacao_label = $compl_css_emb . "css_ipc_vl_base_tributacao_label";
   $this->css_ipc_vl_base_tributacao_grid_line = $compl_css_emb . "css_ipc_vl_base_tributacao_grid_line";
   $this->css_ipc_rolo_label = $compl_css_emb . "css_ipc_rolo_label";
   $this->css_ipc_rolo_grid_line = $compl_css_emb . "css_ipc_rolo_grid_line";
   $this->css_ipc_largura_label = $compl_css_emb . "css_ipc_largura_label";
   $this->css_ipc_largura_grid_line = $compl_css_emb . "css_ipc_largura_grid_line";
   $this->css_ipc_peso_label = $compl_css_emb . "css_ipc_peso_label";
   $this->css_ipc_peso_grid_line = $compl_css_emb . "css_ipc_peso_grid_line";
   $this->css_ipc_composicao_label = $compl_css_emb . "css_ipc_composicao_label";
   $this->css_ipc_composicao_grid_line = $compl_css_emb . "css_ipc_composicao_grid_line";
   $this->css_ipc_dt_prev_envio_desenhos_label = $compl_css_emb . "css_ipc_dt_prev_envio_desenhos_label";
   $this->css_ipc_dt_prev_envio_desenhos_grid_line = $compl_css_emb . "css_ipc_dt_prev_envio_desenhos_grid_line";
   $this->css_ipc_dt_real_envio_desenhos_label = $compl_css_emb . "css_ipc_dt_real_envio_desenhos_label";
   $this->css_ipc_dt_real_envio_desenhos_grid_line = $compl_css_emb . "css_ipc_dt_real_envio_desenhos_grid_line";
   $this->css_ipc_log_aprov_so_ld_label = $compl_css_emb . "css_ipc_log_aprov_so_ld_label";
   $this->css_ipc_log_aprov_so_ld_grid_line = $compl_css_emb . "css_ipc_log_aprov_so_ld_grid_line";
   $this->css_ipc_dt_prev_aprov_so_ld_label = $compl_css_emb . "css_ipc_dt_prev_aprov_so_ld_label";
   $this->css_ipc_dt_prev_aprov_so_ld_grid_line = $compl_css_emb . "css_ipc_dt_prev_aprov_so_ld_grid_line";
   $this->css_ipc_dt_real_aprov_so_ld_label = $compl_css_emb . "css_ipc_dt_real_aprov_so_ld_label";
   $this->css_ipc_dt_real_aprov_so_ld_grid_line = $compl_css_emb . "css_ipc_dt_real_aprov_so_ld_grid_line";
   $this->css_ipc_coloracao_id_label = $compl_css_emb . "css_ipc_coloracao_id_label";
   $this->css_ipc_coloracao_id_grid_line = $compl_css_emb . "css_ipc_coloracao_id_grid_line";
   $this->css_ipc_dt_maxima_producao_label = $compl_css_emb . "css_ipc_dt_maxima_producao_label";
   $this->css_ipc_dt_maxima_producao_grid_line = $compl_css_emb . "css_ipc_dt_maxima_producao_grid_line";
   $this->css_ipc_dt_mostruario_label = $compl_css_emb . "css_ipc_dt_mostruario_label";
   $this->css_ipc_dt_mostruario_grid_line = $compl_css_emb . "css_ipc_dt_mostruario_grid_line";
   $this->css_ipc_log_mostruario_label = $compl_css_emb . "css_ipc_log_mostruario_label";
   $this->css_ipc_log_mostruario_grid_line = $compl_css_emb . "css_ipc_log_mostruario_grid_line";
   $this->css_ipc_formato_amostra_id_label = $compl_css_emb . "css_ipc_formato_amostra_id_label";
   $this->css_ipc_formato_amostra_id_grid_line = $compl_css_emb . "css_ipc_formato_amostra_id_grid_line";
   $this->css_ipc_observacao_label = $compl_css_emb . "css_ipc_observacao_label";
   $this->css_ipc_observacao_grid_line = $compl_css_emb . "css_ipc_observacao_grid_line";
   $this->css_ipc_dt_cheg_amostras_emb_label = $compl_css_emb . "css_ipc_dt_cheg_amostras_emb_label";
   $this->css_ipc_dt_cheg_amostras_emb_grid_line = $compl_css_emb . "css_ipc_dt_cheg_amostras_emb_grid_line";
   $this->css_ipc_dt_prev_recbto_so_ld_label = $compl_css_emb . "css_ipc_dt_prev_recbto_so_ld_label";
   $this->css_ipc_dt_prev_recbto_so_ld_grid_line = $compl_css_emb . "css_ipc_dt_prev_recbto_so_ld_grid_line";
   $this->css_ipc_dt_real_recbto_so_ld_label = $compl_css_emb . "css_ipc_dt_real_recbto_so_ld_label";
   $this->css_ipc_dt_real_recbto_so_ld_grid_line = $compl_css_emb . "css_ipc_dt_real_recbto_so_ld_grid_line";
   $this->css_ipc_vl_cubagem_label = $compl_css_emb . "css_ipc_vl_cubagem_label";
   $this->css_ipc_vl_cubagem_grid_line = $compl_css_emb . "css_ipc_vl_cubagem_grid_line";
   $this->css_ipc_dt_recbto_laudo_label = $compl_css_emb . "css_ipc_dt_recbto_laudo_label";
   $this->css_ipc_dt_recbto_laudo_grid_line = $compl_css_emb . "css_ipc_dt_recbto_laudo_grid_line";
   $this->css_ipc_dt_recbto_embalagem_label = $compl_css_emb . "css_ipc_dt_recbto_embalagem_label";
   $this->css_ipc_dt_recbto_embalagem_grid_line = $compl_css_emb . "css_ipc_dt_recbto_embalagem_grid_line";
   $this->css_ipc_ind_producao_no_prazo_label = $compl_css_emb . "css_ipc_ind_producao_no_prazo_label";
   $this->css_ipc_ind_producao_no_prazo_grid_line = $compl_css_emb . "css_ipc_ind_producao_no_prazo_grid_line";
   $this->css_ipc_ind_relat_semanal_producao_label = $compl_css_emb . "css_ipc_ind_relat_semanal_producao_label";
   $this->css_ipc_ind_relat_semanal_producao_grid_line = $compl_css_emb . "css_ipc_ind_relat_semanal_producao_grid_line";
   $this->css_ipc_ind_laudo_antes_embarque_label = $compl_css_emb . "css_ipc_ind_laudo_antes_embarque_label";
   $this->css_ipc_ind_laudo_antes_embarque_grid_line = $compl_css_emb . "css_ipc_ind_laudo_antes_embarque_grid_line";
   $this->css_ipc_ind_qualid_emb_label = $compl_css_emb . "css_ipc_ind_qualid_emb_label";
   $this->css_ipc_ind_qualid_emb_grid_line = $compl_css_emb . "css_ipc_ind_qualid_emb_grid_line";
   $this->css_ipc_ind_prod_conf_pi_label = $compl_css_emb . "css_ipc_ind_prod_conf_pi_label";
   $this->css_ipc_ind_prod_conf_pi_grid_line = $compl_css_emb . "css_ipc_ind_prod_conf_pi_grid_line";
   $this->css_ipc_ind_rec_amostra_antes_emb_label = $compl_css_emb . "css_ipc_ind_rec_amostra_antes_emb_label";
   $this->css_ipc_ind_rec_amostra_antes_emb_grid_line = $compl_css_emb . "css_ipc_ind_rec_amostra_antes_emb_grid_line";
   $this->css_ipc_ind_qt_conf_proforma_label = $compl_css_emb . "css_ipc_ind_qt_conf_proforma_label";
   $this->css_ipc_ind_qt_conf_proforma_grid_line = $compl_css_emb . "css_ipc_ind_qt_conf_proforma_grid_line";
   $this->css_ipc_ind_tamanho_pecas_correto_label = $compl_css_emb . "css_ipc_ind_tamanho_pecas_correto_label";
   $this->css_ipc_ind_tamanho_pecas_correto_grid_line = $compl_css_emb . "css_ipc_ind_tamanho_pecas_correto_grid_line";
   $this->css_ipc_dt_termino_producao_label = $compl_css_emb . "css_ipc_dt_termino_producao_label";
   $this->css_ipc_dt_termino_producao_grid_line = $compl_css_emb . "css_ipc_dt_termino_producao_grid_line";
   $this->css_sc_field_2_label = $compl_css_emb . "css_sc_field_2_label";
   $this->css_sc_field_2_grid_line = $compl_css_emb . "css_sc_field_2_grid_line";
   $this->css_sc_field_4_label = $compl_css_emb . "css_sc_field_4_label";
   $this->css_sc_field_4_grid_line = $compl_css_emb . "css_sc_field_4_grid_line";
   $this->css_c_situacao_label = $compl_css_emb . "css_c_situacao_label";
   $this->css_c_situacao_grid_line = $compl_css_emb . "css_c_situacao_grid_line";
   $this->css_c_exclusivo_label = $compl_css_emb . "css_c_exclusivo_label";
   $this->css_c_exclusivo_grid_line = $compl_css_emb . "css_c_exclusivo_grid_line";
   $this->css_c_cod_armador_label = $compl_css_emb . "css_c_cod_armador_label";
   $this->css_c_cod_armador_grid_line = $compl_css_emb . "css_c_cod_armador_grid_line";
   $this->css_c_log_pagto_final_label = $compl_css_emb . "css_c_log_pagto_final_label";
   $this->css_c_log_pagto_final_grid_line = $compl_css_emb . "css_c_log_pagto_final_grid_line";
   $this->css_c_cod_agente_cargas_label = $compl_css_emb . "css_c_cod_agente_cargas_label";
   $this->css_c_cod_agente_cargas_grid_line = $compl_css_emb . "css_c_cod_agente_cargas_grid_line";
   $this->css_c_ind_dt_prev_chegada_label = $compl_css_emb . "css_c_ind_dt_prev_chegada_label";
   $this->css_c_ind_dt_prev_chegada_grid_line = $compl_css_emb . "css_c_ind_dt_prev_chegada_grid_line";
   $this->css_c_dt_prev_embarque_label = $compl_css_emb . "css_c_dt_prev_embarque_label";
   $this->css_c_dt_prev_embarque_grid_line = $compl_css_emb . "css_c_dt_prev_embarque_grid_line";
   $this->css_c_dt_real_embarque_label = $compl_css_emb . "css_c_dt_real_embarque_label";
   $this->css_c_dt_real_embarque_grid_line = $compl_css_emb . "css_c_dt_real_embarque_grid_line";
   $this->css_c_situacao_container_id_label = $compl_css_emb . "css_c_situacao_container_id_label";
   $this->css_c_situacao_container_id_grid_line = $compl_css_emb . "css_c_situacao_container_id_grid_line";
   $this->css_c_ind_dt_embarque_label = $compl_css_emb . "css_c_ind_dt_embarque_label";
   $this->css_c_ind_dt_embarque_grid_line = $compl_css_emb . "css_c_ind_dt_embarque_grid_line";
   $this->css_c_medidas_container_label = $compl_css_emb . "css_c_medidas_container_label";
   $this->css_c_medidas_container_grid_line = $compl_css_emb . "css_c_medidas_container_grid_line";
   $this->css_sc_field_7_label = $compl_css_emb . "css_sc_field_7_label";
   $this->css_sc_field_7_grid_line = $compl_css_emb . "css_sc_field_7_grid_line";
   $this->css_sc_field_8_label = $compl_css_emb . "css_sc_field_8_label";
   $this->css_sc_field_8_grid_line = $compl_css_emb . "css_sc_field_8_grid_line";
   $this->css_sc_field_5_label = $compl_css_emb . "css_sc_field_5_label";
   $this->css_sc_field_5_grid_line = $compl_css_emb . "css_sc_field_5_grid_line";
   $this->css_sc_field_6_label = $compl_css_emb . "css_sc_field_6_label";
   $this->css_sc_field_6_grid_line = $compl_css_emb . "css_sc_field_6_grid_line";
   $this->css_ic_log_rec_doc_prazo_emb_label = $compl_css_emb . "css_ic_log_rec_doc_prazo_emb_label";
   $this->css_ic_log_rec_doc_prazo_emb_grid_line = $compl_css_emb . "css_ic_log_rec_doc_prazo_emb_grid_line";
   $this->css_ic_qt_recbto_fisico_label = $compl_css_emb . "css_ic_qt_recbto_fisico_label";
   $this->css_ic_qt_recbto_fisico_grid_line = $compl_css_emb . "css_ic_qt_recbto_fisico_grid_line";
   $this->css_ic_qt_confirm_emb_label = $compl_css_emb . "css_ic_qt_confirm_emb_label";
   $this->css_ic_qt_confirm_emb_grid_line = $compl_css_emb . "css_ic_qt_confirm_emb_grid_line";
   $this->css_ic_qt_alocada_label = $compl_css_emb . "css_ic_qt_alocada_label";
   $this->css_ic_qt_alocada_grid_line = $compl_css_emb . "css_ic_qt_alocada_grid_line";
   $this->css_ic_observacao_label = $compl_css_emb . "css_ic_observacao_label";
   $this->css_ic_observacao_grid_line = $compl_css_emb . "css_ic_observacao_grid_line";
   $this->css_pc_empresa_id_label = $compl_css_emb . "css_pc_empresa_id_label";
   $this->css_pc_empresa_id_grid_line = $compl_css_emb . "css_pc_empresa_id_grid_line";
   $this->css_pc_qt_container_label = $compl_css_emb . "css_pc_qt_container_label";
   $this->css_pc_qt_container_grid_line = $compl_css_emb . "css_pc_qt_container_grid_line";
 }  
 function cabecalho()
 {
     if($_SESSION['scriptcase']['proc_mobile'] && method_exists($this, 'cabecalho_mobile'))
     {
         $this->cabecalho_mobile();
     }
     else if(method_exists($this, 'cabecalho_normal'))
     {
         $this->cabecalho_normal();
     }
 }
// 
//----- 
 function cabecalho_normal()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['cab']))
   {
       return; 
   }
   if ($this->Ini->Embutida_iframe) {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_head\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert']) 
     {
         if($this->Tem_tab_vert)
         {
           $nm_saida->saida("   <TD colspan=\"2\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
         else{
           $nm_saida->saida("   <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
     }
     else{
           $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     }
   } 
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("#lin1_col1 { padding-left:1px; padding-top:0px;  height:9px; overflow:hidden; text-align:left;color:black;}			 \r\n");
   $nm_saida->saida("#lin1_col2 { padding-right:1px; padding-top:0px; height:9px; text-align:left; overflow:hidden;   font-size:12px; font-weight:normal;color:black;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div width=\"100%\" >	\r\n");
   $nm_saida->saida(" <div class=\"" . $this->css_scGridHeader . "\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
   $nm_saida->saida(" <!--<div style=\"height:15px; border-width:0px 0px 1px 0px;  border-style: solid; border-color:#ddd; display: block\">-->\r\n");
   $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
   $nm_saida->saida("    	<tr>\r\n");
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span> - </span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
 }
// 
//----- 
 function cabecalho_mobile()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['cab']))
   {
       return; 
   }
   if ($this->Ini->Embutida_iframe) {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_head\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert']) 
     {
         if($this->Tem_tab_vert)
         {
           $nm_saida->saida("   <TD colspan=\"2\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
         else{
           $nm_saida->saida("   <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
         }
     }
     else{
           $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     }
   } 
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("#lin1_col1 { padding-left:1px; padding-top:0px;  height:9px; overflow:hidden; text-align:left;color:black;}			 \r\n");
   $nm_saida->saida("#lin1_col2 { padding-right:1px; padding-top:0px; height:9px; text-align:left; overflow:hidden;   font-size:12px; font-weight:normal;color:black;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div width=\"100%\" >	\r\n");
   $nm_saida->saida(" <div class=\"" . $this->css_scGridHeader . "\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
   $nm_saida->saida(" <!--<div style=\"height:15px; border-width:0px 0px 1px 0px;  border-style: solid; border-color:#ddd; display: block\">-->\r\n");
   $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
   $nm_saida->saida("    	<tr>\r\n");
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span> - </span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
 }
// 
 function label_grid($linhas = 0)
 {
   global 
           $nm_saida;
   static $nm_seq_titulos   = 0; 
   $contr_embutida = false;
   $salva_htm_emb  = "";
   $this->grid_fixed_column_no = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_label'])
   { 
       $this->New_label['ipc_vl_custo_dolar'] = "" . $this->Ini->Nm_lang['lang_itens_proc_compra_fld_vl_custo_dolar'] . "";
   } 
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_label'])
      { 
          if (!isset($_SESSION['scriptcase']['saida_var']) || !$_SESSION['scriptcase']['saida_var']) 
          { 
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $contr_embutida = true;
          } 
          else 
          { 
              $salva_htm_emb = $_SESSION['scriptcase']['saida_html'];
              $_SESSION['scriptcase']['saida_html'] = "";
          } 
      } 
   $nm_saida->saida("    <TR id=\"tit_cons_planilha__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-cons_planilha-" . $tmp_header_row . "\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_qt_container_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
       $this->grid_fixed_column_no++;
   } 
   $this->SC_label_rightActionBar();
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_label'])
     { 
         if (isset($_SESSION['scriptcase']['saida_var']) && $_SESSION['scriptcase']['saida_var'])
         { 
             $Cod_Html = $_SESSION['scriptcase']['saida_html'];
             $pos_tag = strpos($Cod_Html, "<TD ");
             $Cod_Html = substr($Cod_Html, $pos_tag);
             $pos      = 0;
             $pos_tag  = false;
             $pos_tmp  = true; 
             $tmp      = $Cod_Html;
             while ($pos_tmp)
             {
                $pos = strpos($tmp, "</TR>", $pos);
                if ($pos !== false)
                {
                    $pos_tag = $pos;
                    $pos += 4;
                }
                else
                {
                    $pos_tmp = false;
                }
             }
             $Cod_Html = substr($Cod_Html, 0, $pos_tag);
             $Nm_temp = explode("</TD>", $Cod_Html);
             $css_emb = "<style type=\"text/css\">";
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_planilha/cons_planilha_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".cons_planilha_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .cons_planilha_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".cons_planilha_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cols_emb'] = count($Nm_temp) - 1;
             if ($contr_embutida) 
             { 
                 $_SESSION['scriptcase']['saida_var']  = false;
                 $nm_saida->saida($Cod_Html);
             } 
             else 
             { 
                 $_SESSION['scriptcase']['saida_html'] = $salva_htm_emb . $Cod_Html;
             } 
         } 
     } 
     $NM_seq_lab = 1;
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_pc_dt_registro()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_dt_registro'])) ? $this->New_label['pc_dt_registro'] : "Dt.Registro Ped.Compra";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_dt_registro']) || $this->NM_cmp_hidden['pc_dt_registro'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_dt_registro_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_dt_registro_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_fornecedor_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_fornecedor_id'])) ? $this->New_label['pc_fornecedor_id'] : "Fornecedor Ped.Compra";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_fornecedor_id']) || $this->NM_cmp_hidden['pc_fornecedor_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_fornecedor_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_fornecedor_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_proc_compra_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_proc_compra_id'])) ? $this->New_label['pc_proc_compra_id'] : "ID Ped.Compra";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_proc_compra_id']) || $this->NM_cmp_hidden['pc_proc_compra_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_proc_compra_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_proc_compra_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_cod_situacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_cod_situacao'])) ? $this->New_label['pc_cod_situacao'] : "Situação Ped.Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_cod_situacao']) || $this->NM_cmp_hidden['pc_cod_situacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_cod_situacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_cod_situacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "pc_cod_situacao";
        if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
            $NM_cmp_class = "pc.cod_situacao";
        }
        elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
            $NM_cmp_class = "pc.cod_situacao";
        }
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pc_cod_situacao_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pc_cod_situacao_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_cod_proc_fornec()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_cod_proc_fornec'])) ? $this->New_label['pc_cod_proc_fornec'] : "Nro. Ped. Importação Fornecedor";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_cod_proc_fornec']) || $this->NM_cmp_hidden['pc_cod_proc_fornec'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_cod_proc_fornec_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_cod_proc_fornec_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $NM_cmp_class = "pc_cod_proc_fornec";
        if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
            $NM_cmp_class = "pc.cod_proc_fornec";
        }
        elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
            $NM_cmp_class = "pc.cod_proc_fornec";
        }
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pc_cod_proc_fornec_label . "\" style=\"display: flex; white-space: pre-line\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: pre-line\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pc_cod_proc_fornec_label . "\" style=\"display: flex; flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_qt_dias_translado()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_qt_dias_translado'])) ? $this->New_label['pc_qt_dias_translado'] : "Qt Dias Translado";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_qt_dias_translado']) || $this->NM_cmp_hidden['pc_qt_dias_translado'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_qt_dias_translado_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_qt_dias_translado_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "pc_qt_dias_translado";
        if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
            $NM_cmp_class = "pc.qt_dias_translado";
        }
        elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
            $NM_cmp_class = "pc.qt_dias_translado";
        }
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pc_qt_dias_translado_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pc_qt_dias_translado_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_observacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_observacao'])) ? $this->New_label['pc_observacao'] : "Observação Ped.Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_observacao']) || $this->NM_cmp_hidden['pc_observacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_observacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_observacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_dt_limite()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_dt_limite'])) ? $this->New_label['pc_dt_limite'] : "Dt.Limite Ped.Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_dt_limite']) || $this->NM_cmp_hidden['pc_dt_limite'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_dt_limite_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_dt_limite_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_log_facilid_contato_fornec()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_log_facilid_contato_fornec'])) ? $this->New_label['pc_log_facilid_contato_fornec'] : "Facilidade de Contato com Fornecedor?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_log_facilid_contato_fornec']) || $this->NM_cmp_hidden['pc_log_facilid_contato_fornec'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_log_facilid_contato_fornec_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_log_facilid_contato_fornec_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_item_proc_compra_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_item_proc_compra_id'])) ? $this->New_label['ipc_item_proc_compra_id'] : "ID Item Ped.Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_item_proc_compra_id']) || $this->NM_cmp_hidden['ipc_item_proc_compra_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_item_proc_compra_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_item_proc_compra_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_descricao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_descricao'])) ? $this->New_label['ipc_descricao'] : "Descrição Item";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_descricao']) || $this->NM_cmp_hidden['ipc_descricao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_descricao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_descricao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_codigo_erp()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_codigo_erp'])) ? $this->New_label['ipc_codigo_erp'] : "Código Datasul";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_codigo_erp']) || $this->NM_cmp_hidden['ipc_codigo_erp'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_codigo_erp_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_codigo_erp_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_qt_dias_producao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_qt_dias_producao'])) ? $this->New_label['ipc_qt_dias_producao'] : "Qt Dias Produção";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_qt_dias_producao']) || $this->NM_cmp_hidden['ipc_qt_dias_producao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_qt_dias_producao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_qt_dias_producao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_unid_medida()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_unid_medida'])) ? $this->New_label['ipc_unid_medida'] : "Unid.Medida";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_unid_medida']) || $this->NM_cmp_hidden['ipc_unid_medida'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_unid_medida_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_unid_medida_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_qt_comprada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_qt_comprada'])) ? $this->New_label['ipc_qt_comprada'] : "Qt.Comprada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_qt_comprada']) || $this->NM_cmp_hidden['ipc_qt_comprada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_qt_comprada_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_qt_comprada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_vl_custo_dolar()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_vl_custo_dolar'])) ? $this->New_label['ipc_vl_custo_dolar'] : "" . $this->Ini->Nm_lang['lang_itens_proc_compra_fld_vl_custo_dolar'] . "";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_vl_custo_dolar']) || $this->NM_cmp_hidden['ipc_vl_custo_dolar'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_vl_custo_dolar_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_vl_custo_dolar_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_vl_base_tributacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_vl_base_tributacao'])) ? $this->New_label['ipc_vl_base_tributacao'] : "Vl.Base Tributação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_vl_base_tributacao']) || $this->NM_cmp_hidden['ipc_vl_base_tributacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_vl_base_tributacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_vl_base_tributacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_rolo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_rolo'])) ? $this->New_label['ipc_rolo'] : "Tam. Rolo";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_rolo']) || $this->NM_cmp_hidden['ipc_rolo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_rolo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_rolo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_largura()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_largura'])) ? $this->New_label['ipc_largura'] : "Largura";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_largura']) || $this->NM_cmp_hidden['ipc_largura'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_largura_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_largura_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_peso()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_peso'])) ? $this->New_label['ipc_peso'] : "Peso";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_peso']) || $this->NM_cmp_hidden['ipc_peso'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_peso_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_peso_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_composicao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_composicao'])) ? $this->New_label['ipc_composicao'] : "Composição";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_composicao']) || $this->NM_cmp_hidden['ipc_composicao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_composicao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_composicao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_prev_envio_desenhos()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_prev_envio_desenhos'])) ? $this->New_label['ipc_dt_prev_envio_desenhos'] : "Dt.Prev. Envio Desenhos";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_prev_envio_desenhos']) || $this->NM_cmp_hidden['ipc_dt_prev_envio_desenhos'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_prev_envio_desenhos_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_prev_envio_desenhos_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_real_envio_desenhos()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_real_envio_desenhos'])) ? $this->New_label['ipc_dt_real_envio_desenhos'] : "Dt.Real Envio Desenhos";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_real_envio_desenhos']) || $this->NM_cmp_hidden['ipc_dt_real_envio_desenhos'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_real_envio_desenhos_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_real_envio_desenhos_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_log_aprov_so_ld()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_log_aprov_so_ld'])) ? $this->New_label['ipc_log_aprov_so_ld'] : "Aprova Strike Offs e Lab Dips?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_log_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_log_aprov_so_ld'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_log_aprov_so_ld_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_log_aprov_so_ld_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_prev_aprov_so_ld()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_prev_aprov_so_ld'])) ? $this->New_label['ipc_dt_prev_aprov_so_ld'] : "Dt.Prev. Aprovação strik Offs e Lab Dips";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_prev_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_dt_prev_aprov_so_ld'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_prev_aprov_so_ld_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_prev_aprov_so_ld_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_real_aprov_so_ld()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_real_aprov_so_ld'])) ? $this->New_label['ipc_dt_real_aprov_so_ld'] : "Dt.Real Aprov. Strik Offs e Lab Dips";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_real_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_dt_real_aprov_so_ld'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_real_aprov_so_ld_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_real_aprov_so_ld_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_coloracao_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_coloracao_id'])) ? $this->New_label['ipc_coloracao_id'] : "Coloração";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_coloracao_id']) || $this->NM_cmp_hidden['ipc_coloracao_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_coloracao_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_coloracao_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_maxima_producao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_maxima_producao'])) ? $this->New_label['ipc_dt_maxima_producao'] : "Dt.Máxima Produção";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_maxima_producao']) || $this->NM_cmp_hidden['ipc_dt_maxima_producao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_maxima_producao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_maxima_producao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_mostruario()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_mostruario'])) ? $this->New_label['ipc_dt_mostruario'] : "Dt.Mostruário";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_mostruario']) || $this->NM_cmp_hidden['ipc_dt_mostruario'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_mostruario_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_mostruario_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_log_mostruario()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_log_mostruario'])) ? $this->New_label['ipc_log_mostruario'] : "Controla Data Mostruário?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_log_mostruario']) || $this->NM_cmp_hidden['ipc_log_mostruario'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_log_mostruario_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_log_mostruario_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_formato_amostra_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_formato_amostra_id'])) ? $this->New_label['ipc_formato_amostra_id'] : "Formato Amostra ";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_formato_amostra_id']) || $this->NM_cmp_hidden['ipc_formato_amostra_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_formato_amostra_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_formato_amostra_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_observacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_observacao'])) ? $this->New_label['ipc_observacao'] : "Observação Item Ped. importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_observacao']) || $this->NM_cmp_hidden['ipc_observacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_observacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_observacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_cheg_amostras_emb()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_cheg_amostras_emb'])) ? $this->New_label['ipc_dt_cheg_amostras_emb'] : "Dt.Cheg. Amostras Emb.";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_cheg_amostras_emb']) || $this->NM_cmp_hidden['ipc_dt_cheg_amostras_emb'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_cheg_amostras_emb_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_cheg_amostras_emb_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_prev_recbto_so_ld()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_prev_recbto_so_ld'])) ? $this->New_label['ipc_dt_prev_recbto_so_ld'] : "Dt.Prev. Recbto Striks Offs e Labs Deps";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_prev_recbto_so_ld']) || $this->NM_cmp_hidden['ipc_dt_prev_recbto_so_ld'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_prev_recbto_so_ld_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_prev_recbto_so_ld_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_real_recbto_so_ld()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_real_recbto_so_ld'])) ? $this->New_label['ipc_dt_real_recbto_so_ld'] : "Dt.Real Recbto Striks Offs e Lab Deps";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_real_recbto_so_ld']) || $this->NM_cmp_hidden['ipc_dt_real_recbto_so_ld'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_real_recbto_so_ld_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_real_recbto_so_ld_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_vl_cubagem()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_vl_cubagem'])) ? $this->New_label['ipc_vl_cubagem'] : "Vl.Cubagem";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_vl_cubagem']) || $this->NM_cmp_hidden['ipc_vl_cubagem'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_vl_cubagem_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_vl_cubagem_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_recbto_laudo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_recbto_laudo'])) ? $this->New_label['ipc_dt_recbto_laudo'] : "Dt.Recbto.Laudo";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_recbto_laudo']) || $this->NM_cmp_hidden['ipc_dt_recbto_laudo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_recbto_laudo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_recbto_laudo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_recbto_embalagem()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_recbto_embalagem'])) ? $this->New_label['ipc_dt_recbto_embalagem'] : "Dt.Recbto.Embalagem";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_recbto_embalagem']) || $this->NM_cmp_hidden['ipc_dt_recbto_embalagem'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_recbto_embalagem_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_recbto_embalagem_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_producao_no_prazo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_producao_no_prazo'])) ? $this->New_label['ipc_ind_producao_no_prazo'] : "Produção No Prazo?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_producao_no_prazo']) || $this->NM_cmp_hidden['ipc_ind_producao_no_prazo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_producao_no_prazo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_producao_no_prazo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_relat_semanal_producao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_relat_semanal_producao'])) ? $this->New_label['ipc_ind_relat_semanal_producao'] : "Relat.Semanal Produção?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_relat_semanal_producao']) || $this->NM_cmp_hidden['ipc_ind_relat_semanal_producao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_relat_semanal_producao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_relat_semanal_producao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_laudo_antes_embarque()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_laudo_antes_embarque'])) ? $this->New_label['ipc_ind_laudo_antes_embarque'] : "Laudo Antes Embarque?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_laudo_antes_embarque']) || $this->NM_cmp_hidden['ipc_ind_laudo_antes_embarque'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_laudo_antes_embarque_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_laudo_antes_embarque_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_qualid_emb()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_qualid_emb'])) ? $this->New_label['ipc_ind_qualid_emb'] : "Recbto da  Embalagem Conforme  nossa qualidade padrão ?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_qualid_emb']) || $this->NM_cmp_hidden['ipc_ind_qualid_emb'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_qualid_emb_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_qualid_emb_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_prod_conf_pi()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_prod_conf_pi'])) ? $this->New_label['ipc_ind_prod_conf_pi'] : "Produção Conforme PL(Laudo)?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_prod_conf_pi']) || $this->NM_cmp_hidden['ipc_ind_prod_conf_pi'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_prod_conf_pi_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_prod_conf_pi_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_rec_amostra_antes_emb()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_rec_amostra_antes_emb'])) ? $this->New_label['ipc_ind_rec_amostra_antes_emb'] : "Recbto Amostras Antes do Embarque?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_rec_amostra_antes_emb']) || $this->NM_cmp_hidden['ipc_ind_rec_amostra_antes_emb'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_rec_amostra_antes_emb_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_rec_amostra_antes_emb_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_qt_conf_proforma()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_qt_conf_proforma'])) ? $this->New_label['ipc_ind_qt_conf_proforma'] : "Quantidade Conforme Pró-forma ?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_qt_conf_proforma']) || $this->NM_cmp_hidden['ipc_ind_qt_conf_proforma'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_qt_conf_proforma_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_qt_conf_proforma_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_ind_tamanho_pecas_correto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_ind_tamanho_pecas_correto'])) ? $this->New_label['ipc_ind_tamanho_pecas_correto'] : "Tamanho de Peças De acordo com o Solicitado?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_ind_tamanho_pecas_correto']) || $this->NM_cmp_hidden['ipc_ind_tamanho_pecas_correto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_ind_tamanho_pecas_correto_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_ind_tamanho_pecas_correto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ipc_dt_termino_producao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ipc_dt_termino_producao'])) ? $this->New_label['ipc_dt_termino_producao'] : "Dt.Termino Produção";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ipc_dt_termino_producao']) || $this->NM_cmp_hidden['ipc_dt_termino_producao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ipc_dt_termino_producao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ipc_dt_termino_producao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "Emitente Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_2']) || $this->NM_cmp_hidden['sc_field_2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_2_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_2_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_4()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "Nro. Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_4']) || $this->NM_cmp_hidden['sc_field_4'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_4_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_4_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_situacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_situacao'])) ? $this->New_label['c_situacao'] : "Situação Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_situacao']) || $this->NM_cmp_hidden['c_situacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_situacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_situacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_exclusivo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_exclusivo'])) ? $this->New_label['c_exclusivo'] : "Exclusivo?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_exclusivo']) || $this->NM_cmp_hidden['c_exclusivo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_exclusivo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_exclusivo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_cod_armador()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_cod_armador'])) ? $this->New_label['c_cod_armador'] : "Armador";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_cod_armador']) || $this->NM_cmp_hidden['c_cod_armador'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_cod_armador_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_cod_armador_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_log_pagto_final()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_log_pagto_final'])) ? $this->New_label['c_log_pagto_final'] : "Log Pagto Final";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_log_pagto_final']) || $this->NM_cmp_hidden['c_log_pagto_final'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_log_pagto_final_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_log_pagto_final_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_cod_agente_cargas()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_cod_agente_cargas'])) ? $this->New_label['c_cod_agente_cargas'] : "Agente Cargas";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_cod_agente_cargas']) || $this->NM_cmp_hidden['c_cod_agente_cargas'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_cod_agente_cargas_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_cod_agente_cargas_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_ind_dt_prev_chegada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_ind_dt_prev_chegada'])) ? $this->New_label['c_ind_dt_prev_chegada'] : "Sit. Dt.Prev. Chegada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_ind_dt_prev_chegada']) || $this->NM_cmp_hidden['c_ind_dt_prev_chegada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_ind_dt_prev_chegada_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_ind_dt_prev_chegada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_dt_prev_embarque()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_dt_prev_embarque'])) ? $this->New_label['c_dt_prev_embarque'] : "Dt.Prev.Embarque";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_dt_prev_embarque']) || $this->NM_cmp_hidden['c_dt_prev_embarque'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_dt_prev_embarque_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_dt_prev_embarque_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_dt_real_embarque()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_dt_real_embarque'])) ? $this->New_label['c_dt_real_embarque'] : "Dt.Real Embarque";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_dt_real_embarque']) || $this->NM_cmp_hidden['c_dt_real_embarque'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_dt_real_embarque_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_dt_real_embarque_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_situacao_container_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_situacao_container_id'])) ? $this->New_label['c_situacao_container_id'] : "Sit.Acomp. Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_situacao_container_id']) || $this->NM_cmp_hidden['c_situacao_container_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_situacao_container_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_situacao_container_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_ind_dt_embarque()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_ind_dt_embarque'])) ? $this->New_label['c_ind_dt_embarque'] : "Sit. Dt.Embarque";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_ind_dt_embarque']) || $this->NM_cmp_hidden['c_ind_dt_embarque'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_ind_dt_embarque_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_ind_dt_embarque_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_c_medidas_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['c_medidas_container'])) ? $this->New_label['c_medidas_container'] : "Medidas Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['c_medidas_container']) || $this->NM_cmp_hidden['c_medidas_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_c_medidas_container_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_c_medidas_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_7()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "Vl. Dolar Venda";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_7']) || $this->NM_cmp_hidden['sc_field_7'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_7_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_7_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_8()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "Vl. Dolar Compra";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_8']) || $this->NM_cmp_hidden['sc_field_8'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_8_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_8_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_5()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "Dt.Recebimento";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_5']) || $this->NM_cmp_hidden['sc_field_5'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_5_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_5_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_sc_field_6()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "Dt.Prev.Chegada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sc_field_6']) || $this->NM_cmp_hidden['sc_field_6'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sc_field_6_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sc_field_6_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ic_log_rec_doc_prazo_emb()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ic_log_rec_doc_prazo_emb'])) ? $this->New_label['ic_log_rec_doc_prazo_emb'] : "Documentação Recebida Até 2 dias após Embarque?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ic_log_rec_doc_prazo_emb']) || $this->NM_cmp_hidden['ic_log_rec_doc_prazo_emb'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ic_log_rec_doc_prazo_emb_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ic_log_rec_doc_prazo_emb_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ic_qt_recbto_fisico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ic_qt_recbto_fisico'])) ? $this->New_label['ic_qt_recbto_fisico'] : "Qt.Recbto Fisico";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ic_qt_recbto_fisico']) || $this->NM_cmp_hidden['ic_qt_recbto_fisico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ic_qt_recbto_fisico_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ic_qt_recbto_fisico_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ic_qt_confirm_emb()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ic_qt_confirm_emb'])) ? $this->New_label['ic_qt_confirm_emb'] : "Qt.Confirm.Embarque";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ic_qt_confirm_emb']) || $this->NM_cmp_hidden['ic_qt_confirm_emb'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ic_qt_confirm_emb_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ic_qt_confirm_emb_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ic_qt_alocada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ic_qt_alocada'])) ? $this->New_label['ic_qt_alocada'] : "Qt.Alocada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ic_qt_alocada']) || $this->NM_cmp_hidden['ic_qt_alocada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ic_qt_alocada_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ic_qt_alocada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ic_observacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ic_observacao'])) ? $this->New_label['ic_observacao'] : "Observação Item Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['ic_observacao']) || $this->NM_cmp_hidden['ic_observacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_ic_observacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ic_observacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_empresa_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_empresa_id'])) ? $this->New_label['pc_empresa_id'] : "Empresa Id";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_empresa_id']) || $this->NM_cmp_hidden['pc_empresa_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_empresa_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_empresa_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "pc_empresa_id";
        if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
            $NM_cmp_class = "pc.empresa_id";
        }
        elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
            $NM_cmp_class = "pc.empresa_id";
        }
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pc_empresa_id_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pc_empresa_id_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_pc_qt_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pc_qt_container'])) ? $this->New_label['pc_qt_container'] : "Qt Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pc_qt_container']) || $this->NM_cmp_hidden['pc_qt_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pc_qt_container_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pc_qt_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $NM_cmp_class = "pc_qt_container";
        if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
            $NM_cmp_class = "pc.qt_container";
        }
        elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
            $NM_cmp_class = "pc.qt_container";
        }
        $fieldSortRule = $this->scGetColumnOrderRule($NM_cmp_class);
        $fieldSortIcon = $this->scGetColumnOrderIcon($NM_cmp_class, $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pc_qt_container_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pc_qt_container_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';
        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
    } else {
        $label_final = $label_fieldName;
    }
   $nm_saida->saida("" . $label_final . "\r\n");
   $nm_saida->saida("</TD>\r\n");
   } 
 }
function SC_label_rightActionBar()
{
        global $nm_saida;
}
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ordem_label'] == 'desc') {
                $sortRule = 'desc';
            } else {
                $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule, $skipUnusedClass = false)
    {
        $unusedClass = $skipUnusedClass ? '' : ' sc-grid-order-icon-unused';        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "pc_fornecedor_id":
                return true;
            case "pc_proc_compra_id":
                return true;
            case "pc_cod_situacao":
                return true;
            case "pc_qt_dias_translado":
                return true;
            case "ipc_item_proc_compra_id":
                return true;
            case "ipc_qt_dias_producao":
                return true;
            case "ipc_qt_comprada":
                return true;
            case "ipc_vl_custo_dolar":
                return true;
            case "ipc_vl_base_tributacao":
                return true;
            case "ipc_log_aprov_so_ld":
                return true;
            case "ipc_coloracao_id":
                return true;
            case "ipc_formato_amostra_id":
                return true;
            case "ipc_vl_cubagem":
                return true;
            case "ipc_ind_producao_no_prazo":
                return true;
            case "ipc_ind_relat_semanal_producao":
                return true;
            case "ipc_ind_laudo_antes_embarque":
                return true;
            case "ipc_ind_qualid_emb":
                return true;
            case "ipc_ind_prod_conf_pi":
                return true;
            case "ipc_ind_rec_amostra_antes_emb":
                return true;
            case "ipc_ind_qt_conf_proforma":
                return true;
            case "ipc_ind_tamanho_pecas_correto":
                return true;
            case "sc_field_2":
                return true;
            case "sc_field_4":
                return true;
            case "c_situacao":
                return true;
            case "c_cod_armador":
                return true;
            case "c_cod_agente_cargas":
                return true;
            case "c_ind_dt_prev_chegada":
                return true;
            case "c_situacao_container_id":
                return true;
            case "c_ind_dt_embarque":
                return true;
            case "sc_field_7":
                return true;
            case "sc_field_8":
                return true;
            case "ic_log_rec_doc_prazo_emb":
                return true;
            case "ic_qt_recbto_fisico":
                return true;
            case "ic_qt_confirm_emb":
                return true;
            case "ic_qt_alocada":
                return true;
            case "pc_empresa_id":
                return true;
            case "pc_qt_container":
                return true;
            case "pc_cotacao_prevista":
                return true;
            case "ipc_proc_compra_id":
                return true;
            case "ic_container_id":
                return true;
            case "ic_item_proc_compra_id":
                return true;
            case "ic_item_container_id":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "pc_dt_registro":
                return 'desc';
            case "pc_fornecedor_id":
                return 'desc';
            case "pc_proc_compra_id":
                return 'desc';
            case "pc_cod_situacao":
                return 'desc';
            case "pc_qt_dias_translado":
                return 'desc';
            case "pc_dt_limite":
                return 'desc';
            case "ipc_item_proc_compra_id":
                return 'desc';
            case "ipc_qt_dias_producao":
                return 'desc';
            case "ipc_qt_comprada":
                return 'desc';
            case "ipc_vl_custo_dolar":
                return 'desc';
            case "ipc_vl_base_tributacao":
                return 'desc';
            case "ipc_dt_prev_envio_desenhos":
                return 'desc';
            case "ipc_dt_real_envio_desenhos":
                return 'desc';
            case "ipc_dt_prev_aprov_so_ld":
                return 'desc';
            case "ipc_dt_real_aprov_so_ld":
                return 'desc';
            case "ipc_coloracao_id":
                return 'desc';
            case "ipc_dt_maxima_producao":
                return 'desc';
            case "ipc_dt_mostruario":
                return 'desc';
            case "ipc_formato_amostra_id":
                return 'desc';
            case "ipc_dt_cheg_amostras_emb":
                return 'desc';
            case "ipc_dt_prev_recbto_so_ld":
                return 'desc';
            case "ipc_dt_real_recbto_so_ld":
                return 'desc';
            case "ipc_vl_cubagem":
                return 'desc';
            case "ipc_dt_recbto_laudo":
                return 'desc';
            case "ipc_dt_recbto_embalagem":
                return 'desc';
            case "ipc_ind_producao_no_prazo":
                return 'desc';
            case "ipc_ind_relat_semanal_producao":
                return 'desc';
            case "ipc_ind_laudo_antes_embarque":
                return 'desc';
            case "ipc_ind_qualid_emb":
                return 'desc';
            case "ipc_ind_prod_conf_pi":
                return 'desc';
            case "ipc_ind_rec_amostra_antes_emb":
                return 'desc';
            case "ipc_ind_qt_conf_proforma":
                return 'desc';
            case "ipc_ind_tamanho_pecas_correto":
                return 'desc';
            case "ipc_dt_termino_producao":
                return 'desc';
            case "sc_field_2":
                return 'desc';
            case "sc_field_4":
                return 'desc';
            case "c_situacao":
                return 'desc';
            case "c_cod_armador":
                return 'desc';
            case "c_cod_agente_cargas":
                return 'desc';
            case "c_ind_dt_prev_chegada":
                return 'desc';
            case "c_dt_prev_embarque":
                return 'desc';
            case "c_dt_real_embarque":
                return 'desc';
            case "c_situacao_container_id":
                return 'desc';
            case "c_ind_dt_embarque":
                return 'desc';
            case "sc_field_7":
                return 'desc';
            case "sc_field_8":
                return 'desc';
            case "sc_field_5":
                return 'desc';
            case "sc_field_6":
                return 'desc';
            case "ic_qt_recbto_fisico":
                return 'desc';
            case "ic_qt_confirm_emb":
                return 'desc';
            case "ic_qt_alocada":
                return 'desc';
            case "pc_empresa_id":
                return 'desc';
            case "pc_qt_container":
                return 'desc';
            case "pc_cotacao_prevista":
                return 'desc';
            case "ipc_proc_compra_id":
                return 'desc';
            case "ic_container_id":
                return 'desc';
            case "ic_item_proc_compra_id":
                return 'desc';
            case "ic_item_container_id":
                return 'desc';
            case "sc_field_3":
                return 'desc';
        }
        return 'asc';
    }

// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida;
   $fecha_tr               = "</tr>";
   $this->Ini->qual_linha  = "par";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ini_cor_grid']);
       }
   }
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $this->SC_ancora = "";
   $this->Rows_span = 1;
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->nm_prim_linha  = true; 
   $this->Ini->nm_cont_lin = 0; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['pc_dt_registro'])) ? $this->New_label['pc_dt_registro'] : "Dt.Registro Ped.Compra";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_dt_registro'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_fornecedor_id'])) ? $this->New_label['pc_fornecedor_id'] : "Fornecedor Ped.Compra";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_fornecedor_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_proc_compra_id'])) ? $this->New_label['pc_proc_compra_id'] : "ID Ped.Compra";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_proc_compra_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_cod_situacao'])) ? $this->New_label['pc_cod_situacao'] : "Situação Ped.Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_cod_situacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_cod_proc_fornec'])) ? $this->New_label['pc_cod_proc_fornec'] : "Nro. Ped. Importação Fornecedor";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_cod_proc_fornec'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_qt_dias_translado'])) ? $this->New_label['pc_qt_dias_translado'] : "Qt Dias Translado";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_qt_dias_translado'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_observacao'])) ? $this->New_label['pc_observacao'] : "Observação Ped.Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_observacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_dt_limite'])) ? $this->New_label['pc_dt_limite'] : "Dt.Limite Ped.Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_dt_limite'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_log_facilid_contato_fornec'])) ? $this->New_label['pc_log_facilid_contato_fornec'] : "Facilidade de Contato com Fornecedor?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_log_facilid_contato_fornec'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_item_proc_compra_id'])) ? $this->New_label['ipc_item_proc_compra_id'] : "ID Item Ped.Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_item_proc_compra_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_descricao'])) ? $this->New_label['ipc_descricao'] : "Descrição Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_descricao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_codigo_erp'])) ? $this->New_label['ipc_codigo_erp'] : "Código Datasul";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_codigo_erp'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_qt_dias_producao'])) ? $this->New_label['ipc_qt_dias_producao'] : "Qt Dias Produção";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_qt_dias_producao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_unid_medida'])) ? $this->New_label['ipc_unid_medida'] : "Unid.Medida";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_unid_medida'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_qt_comprada'])) ? $this->New_label['ipc_qt_comprada'] : "Qt.Comprada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_qt_comprada'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_vl_custo_dolar'])) ? $this->New_label['ipc_vl_custo_dolar'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_vl_custo_dolar'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_vl_base_tributacao'])) ? $this->New_label['ipc_vl_base_tributacao'] : "Vl.Base Tributação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_vl_base_tributacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_rolo'])) ? $this->New_label['ipc_rolo'] : "Tam. Rolo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_rolo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_largura'])) ? $this->New_label['ipc_largura'] : "Largura";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_largura'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_peso'])) ? $this->New_label['ipc_peso'] : "Peso";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_peso'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_composicao'])) ? $this->New_label['ipc_composicao'] : "Composição";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_composicao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_prev_envio_desenhos'])) ? $this->New_label['ipc_dt_prev_envio_desenhos'] : "Dt.Prev. Envio Desenhos";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_prev_envio_desenhos'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_real_envio_desenhos'])) ? $this->New_label['ipc_dt_real_envio_desenhos'] : "Dt.Real Envio Desenhos";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_real_envio_desenhos'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_log_aprov_so_ld'])) ? $this->New_label['ipc_log_aprov_so_ld'] : "Aprova Strike Offs e Lab Dips?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_log_aprov_so_ld'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_prev_aprov_so_ld'])) ? $this->New_label['ipc_dt_prev_aprov_so_ld'] : "Dt.Prev. Aprovação strik Offs e Lab Dips";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_prev_aprov_so_ld'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_real_aprov_so_ld'])) ? $this->New_label['ipc_dt_real_aprov_so_ld'] : "Dt.Real Aprov. Strik Offs e Lab Dips";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_real_aprov_so_ld'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_coloracao_id'])) ? $this->New_label['ipc_coloracao_id'] : "Coloração";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_coloracao_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_maxima_producao'])) ? $this->New_label['ipc_dt_maxima_producao'] : "Dt.Máxima Produção";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_maxima_producao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_mostruario'])) ? $this->New_label['ipc_dt_mostruario'] : "Dt.Mostruário";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_mostruario'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_log_mostruario'])) ? $this->New_label['ipc_log_mostruario'] : "Controla Data Mostruário?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_log_mostruario'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_formato_amostra_id'])) ? $this->New_label['ipc_formato_amostra_id'] : "Formato Amostra ";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_formato_amostra_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_observacao'])) ? $this->New_label['ipc_observacao'] : "Observação Item Ped. importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_observacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_cheg_amostras_emb'])) ? $this->New_label['ipc_dt_cheg_amostras_emb'] : "Dt.Cheg. Amostras Emb.";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_cheg_amostras_emb'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_prev_recbto_so_ld'])) ? $this->New_label['ipc_dt_prev_recbto_so_ld'] : "Dt.Prev. Recbto Striks Offs e Labs Deps";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_prev_recbto_so_ld'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_real_recbto_so_ld'])) ? $this->New_label['ipc_dt_real_recbto_so_ld'] : "Dt.Real Recbto Striks Offs e Lab Deps";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_real_recbto_so_ld'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_vl_cubagem'])) ? $this->New_label['ipc_vl_cubagem'] : "Vl.Cubagem";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_vl_cubagem'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_recbto_laudo'])) ? $this->New_label['ipc_dt_recbto_laudo'] : "Dt.Recbto.Laudo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_recbto_laudo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_recbto_embalagem'])) ? $this->New_label['ipc_dt_recbto_embalagem'] : "Dt.Recbto.Embalagem";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_recbto_embalagem'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_producao_no_prazo'])) ? $this->New_label['ipc_ind_producao_no_prazo'] : "Produção No Prazo?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_producao_no_prazo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_relat_semanal_producao'])) ? $this->New_label['ipc_ind_relat_semanal_producao'] : "Relat.Semanal Produção?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_relat_semanal_producao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_laudo_antes_embarque'])) ? $this->New_label['ipc_ind_laudo_antes_embarque'] : "Laudo Antes Embarque?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_laudo_antes_embarque'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_qualid_emb'])) ? $this->New_label['ipc_ind_qualid_emb'] : "Recbto da  Embalagem Conforme  nossa qualidade padrão ?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_qualid_emb'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_prod_conf_pi'])) ? $this->New_label['ipc_ind_prod_conf_pi'] : "Produção Conforme PL(Laudo)?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_prod_conf_pi'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_rec_amostra_antes_emb'])) ? $this->New_label['ipc_ind_rec_amostra_antes_emb'] : "Recbto Amostras Antes do Embarque?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_rec_amostra_antes_emb'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_qt_conf_proforma'])) ? $this->New_label['ipc_ind_qt_conf_proforma'] : "Quantidade Conforme Pró-forma ?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_qt_conf_proforma'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_ind_tamanho_pecas_correto'])) ? $this->New_label['ipc_ind_tamanho_pecas_correto'] : "Tamanho de Peças De acordo com o Solicitado?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_ind_tamanho_pecas_correto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ipc_dt_termino_producao'])) ? $this->New_label['ipc_dt_termino_producao'] : "Dt.Termino Produção";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ipc_dt_termino_producao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "Emitente Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "Nro. Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_4'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_situacao'])) ? $this->New_label['c_situacao'] : "Situação Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_situacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_exclusivo'])) ? $this->New_label['c_exclusivo'] : "Exclusivo?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_exclusivo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_cod_armador'])) ? $this->New_label['c_cod_armador'] : "Armador";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_cod_armador'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_log_pagto_final'])) ? $this->New_label['c_log_pagto_final'] : "Log Pagto Final";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_log_pagto_final'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_cod_agente_cargas'])) ? $this->New_label['c_cod_agente_cargas'] : "Agente Cargas";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_cod_agente_cargas'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_ind_dt_prev_chegada'])) ? $this->New_label['c_ind_dt_prev_chegada'] : "Sit. Dt.Prev. Chegada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_ind_dt_prev_chegada'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_dt_prev_embarque'])) ? $this->New_label['c_dt_prev_embarque'] : "Dt.Prev.Embarque";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_dt_prev_embarque'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_dt_real_embarque'])) ? $this->New_label['c_dt_real_embarque'] : "Dt.Real Embarque";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_dt_real_embarque'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_situacao_container_id'])) ? $this->New_label['c_situacao_container_id'] : "Sit.Acomp. Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_situacao_container_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_ind_dt_embarque'])) ? $this->New_label['c_ind_dt_embarque'] : "Sit. Dt.Embarque";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_ind_dt_embarque'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['c_medidas_container'])) ? $this->New_label['c_medidas_container'] : "Medidas Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['c_medidas_container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "Vl. Dolar Venda";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_7'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "Vl. Dolar Compra";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_8'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "Dt.Recebimento";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_5'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "Dt.Prev.Chegada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['sc_field_6'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ic_log_rec_doc_prazo_emb'])) ? $this->New_label['ic_log_rec_doc_prazo_emb'] : "Documentação Recebida Até 2 dias após Embarque?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ic_log_rec_doc_prazo_emb'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ic_qt_recbto_fisico'])) ? $this->New_label['ic_qt_recbto_fisico'] : "Qt.Recbto Fisico";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ic_qt_recbto_fisico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ic_qt_confirm_emb'])) ? $this->New_label['ic_qt_confirm_emb'] : "Qt.Confirm.Embarque";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ic_qt_confirm_emb'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ic_qt_alocada'])) ? $this->New_label['ic_qt_alocada'] : "Qt.Alocada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ic_qt_alocada'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ic_observacao'])) ? $this->New_label['ic_observacao'] : "Observação Item Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['ic_observacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_empresa_id'])) ? $this->New_label['pc_empresa_id'] : "Empresa Id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_empresa_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pc_qt_container'])) ? $this->New_label['pc_qt_container'] : "Qt Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['labels']['pc_qt_container'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_planilha']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_cons_planilha#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-size:12px;color:#000000;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "\r\n");
               $nm_saida->saida("  </td></tr>\r\n");
               $nm_saida->saida("  </table></td></tr></table>\r\n");
               $this->Lin_final = $this->rs_grid->EOF;
               if ($this->Lin_final)
               {
                   $this->rs_grid->Close();
               }
           }
       }
       else
       {
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;color:#000000;\">\r\n");
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_cons_planilha#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       $nm_id_aplicacao = " id=\"apl_cons_planilha#?#1\"";
   } 
   $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf") ? "padding: 0px !important;" : "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\" width=\"100%\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf']) { 
    if ($this->pdf_all_cab != "S") {
        $this->cabecalho();
    }
    $nm_saida->saida("              <thead>\r\n");
    if ($this->pdf_all_cab == "S") {
        $this->cabecalho();
    }
    if ($this->pdf_all_label == "S") {
        $this->label_grid();
    }
}
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-34e74778\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Page_break_PDF'] = array();
       }
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['doc_word'] && !$this->Ini->sc_export_ajax)
          {
              $nm_prog_barr++;
              $Mens_bar = $this->Ini->Nm_lang['lang_othr_prcs'];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                  $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->pb->setProgressbarMessage($Mens_bar . ": " . $nm_prog_barr . $PB_tot);
              $this->pb->addSteps(1);
          }
          if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
          {
              $nm_prog_barr++;
              $Mens_bar = $this->Ini->Nm_lang['lang_othr_prcs'];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                  $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->pb->setProgressbarMessage($Mens_bar . ": " . $nm_prog_barr . $PB_tot);
              $this->pb->addSteps(1);
          }
          //---------- Gauge ----------
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  cons_planilha_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->pc_dt_registro = $this->rs_grid->fields[0] ;  
          $this->pc_fornecedor_id = $this->rs_grid->fields[1] ;  
          $this->pc_fornecedor_id = (string)$this->pc_fornecedor_id;
          $this->pc_proc_compra_id = $this->rs_grid->fields[2] ;  
          $this->pc_proc_compra_id = (string)$this->pc_proc_compra_id;
          $this->pc_cod_situacao = $this->rs_grid->fields[3] ;  
          $this->pc_cod_situacao = (string)$this->pc_cod_situacao;
          $this->pc_cod_proc_fornec = $this->rs_grid->fields[4] ;  
          $this->pc_qt_dias_translado = $this->rs_grid->fields[5] ;  
          $this->pc_qt_dias_translado = (string)$this->pc_qt_dias_translado;
          $this->pc_observacao = $this->rs_grid->fields[6] ;  
          $this->pc_dt_limite = $this->rs_grid->fields[7] ;  
          $this->pc_log_facilid_contato_fornec = $this->rs_grid->fields[8] ;  
          $this->pc_log_facilid_contato_fornec = (string)$this->pc_log_facilid_contato_fornec;
          $this->ipc_item_proc_compra_id = $this->rs_grid->fields[9] ;  
          $this->ipc_item_proc_compra_id = (string)$this->ipc_item_proc_compra_id;
          $this->ipc_descricao = $this->rs_grid->fields[10] ;  
          $this->ipc_codigo_erp = $this->rs_grid->fields[11] ;  
          $this->ipc_qt_dias_producao = $this->rs_grid->fields[12] ;  
          $this->ipc_qt_dias_producao = (string)$this->ipc_qt_dias_producao;
          $this->ipc_unid_medida = $this->rs_grid->fields[13] ;  
          $this->ipc_qt_comprada = $this->rs_grid->fields[14] ;  
          $this->ipc_qt_comprada =  str_replace(",", ".", $this->ipc_qt_comprada);
          $this->ipc_qt_comprada = (string)$this->ipc_qt_comprada;
          $this->ipc_vl_custo_dolar = $this->rs_grid->fields[15] ;  
          $this->ipc_vl_custo_dolar =  str_replace(",", ".", $this->ipc_vl_custo_dolar);
          $this->ipc_vl_custo_dolar = (string)$this->ipc_vl_custo_dolar;
          $this->ipc_vl_base_tributacao = $this->rs_grid->fields[16] ;  
          $this->ipc_vl_base_tributacao =  str_replace(",", ".", $this->ipc_vl_base_tributacao);
          $this->ipc_vl_base_tributacao = (string)$this->ipc_vl_base_tributacao;
          $this->ipc_rolo = $this->rs_grid->fields[17] ;  
          $this->ipc_largura = $this->rs_grid->fields[18] ;  
          $this->ipc_peso = $this->rs_grid->fields[19] ;  
          $this->ipc_composicao = $this->rs_grid->fields[20] ;  
          $this->ipc_dt_prev_envio_desenhos = $this->rs_grid->fields[21] ;  
          $this->ipc_dt_real_envio_desenhos = $this->rs_grid->fields[22] ;  
          $this->ipc_log_aprov_so_ld = $this->rs_grid->fields[23] ;  
          $this->ipc_log_aprov_so_ld = (string)$this->ipc_log_aprov_so_ld;
          $this->ipc_dt_prev_aprov_so_ld = $this->rs_grid->fields[24] ;  
          $this->ipc_dt_real_aprov_so_ld = $this->rs_grid->fields[25] ;  
          $this->ipc_coloracao_id = $this->rs_grid->fields[26] ;  
          $this->ipc_coloracao_id = (string)$this->ipc_coloracao_id;
          $this->ipc_dt_maxima_producao = $this->rs_grid->fields[27] ;  
          $this->ipc_dt_mostruario = $this->rs_grid->fields[28] ;  
          $this->ipc_log_mostruario = $this->rs_grid->fields[29] ;  
          $this->ipc_log_mostruario = (string)$this->ipc_log_mostruario;
          $this->ipc_formato_amostra_id = $this->rs_grid->fields[30] ;  
          $this->ipc_formato_amostra_id = (string)$this->ipc_formato_amostra_id;
          $this->ipc_observacao = $this->rs_grid->fields[31] ;  
          $this->ipc_dt_cheg_amostras_emb = $this->rs_grid->fields[32] ;  
          $this->ipc_dt_prev_recbto_so_ld = $this->rs_grid->fields[33] ;  
          $this->ipc_dt_real_recbto_so_ld = $this->rs_grid->fields[34] ;  
          $this->ipc_vl_cubagem = $this->rs_grid->fields[35] ;  
          $this->ipc_vl_cubagem = (string)$this->ipc_vl_cubagem;
          $this->ipc_dt_recbto_laudo = $this->rs_grid->fields[36] ;  
          $this->ipc_dt_recbto_embalagem = $this->rs_grid->fields[37] ;  
          $this->ipc_ind_producao_no_prazo = $this->rs_grid->fields[38] ;  
          $this->ipc_ind_producao_no_prazo = (string)$this->ipc_ind_producao_no_prazo;
          $this->ipc_ind_relat_semanal_producao = $this->rs_grid->fields[39] ;  
          $this->ipc_ind_relat_semanal_producao = (string)$this->ipc_ind_relat_semanal_producao;
          $this->ipc_ind_laudo_antes_embarque = $this->rs_grid->fields[40] ;  
          $this->ipc_ind_laudo_antes_embarque = (string)$this->ipc_ind_laudo_antes_embarque;
          $this->ipc_ind_qualid_emb = $this->rs_grid->fields[41] ;  
          $this->ipc_ind_qualid_emb = (string)$this->ipc_ind_qualid_emb;
          $this->ipc_ind_prod_conf_pi = $this->rs_grid->fields[42] ;  
          $this->ipc_ind_prod_conf_pi = (string)$this->ipc_ind_prod_conf_pi;
          $this->ipc_ind_rec_amostra_antes_emb = $this->rs_grid->fields[43] ;  
          $this->ipc_ind_rec_amostra_antes_emb = (string)$this->ipc_ind_rec_amostra_antes_emb;
          $this->ipc_ind_qt_conf_proforma = $this->rs_grid->fields[44] ;  
          $this->ipc_ind_qt_conf_proforma = (string)$this->ipc_ind_qt_conf_proforma;
          $this->ipc_ind_tamanho_pecas_correto = $this->rs_grid->fields[45] ;  
          $this->ipc_ind_tamanho_pecas_correto = (string)$this->ipc_ind_tamanho_pecas_correto;
          $this->ipc_dt_termino_producao = $this->rs_grid->fields[46] ;  
          $this->sc_field_2 = $this->rs_grid->fields[47] ;  
          $this->sc_field_2 = (string)$this->sc_field_2;
          $this->sc_field_4 = $this->rs_grid->fields[48] ;  
          $this->sc_field_4 = (string)$this->sc_field_4;
          $this->c_situacao = $this->rs_grid->fields[49] ;  
          $this->c_situacao = (string)$this->c_situacao;
          $this->c_exclusivo = $this->rs_grid->fields[50] ;  
          $this->c_exclusivo = (string)$this->c_exclusivo;
          $this->c_cod_armador = $this->rs_grid->fields[51] ;  
          $this->c_cod_armador = (string)$this->c_cod_armador;
          $this->c_log_pagto_final = $this->rs_grid->fields[52] ;  
          $this->c_log_pagto_final = (string)$this->c_log_pagto_final;
          $this->c_cod_agente_cargas = $this->rs_grid->fields[53] ;  
          $this->c_cod_agente_cargas = (string)$this->c_cod_agente_cargas;
          $this->c_ind_dt_prev_chegada = $this->rs_grid->fields[54] ;  
          $this->c_ind_dt_prev_chegada = (string)$this->c_ind_dt_prev_chegada;
          $this->c_dt_prev_embarque = $this->rs_grid->fields[55] ;  
          $this->c_dt_real_embarque = $this->rs_grid->fields[56] ;  
          $this->c_situacao_container_id = $this->rs_grid->fields[57] ;  
          $this->c_situacao_container_id = (string)$this->c_situacao_container_id;
          $this->c_ind_dt_embarque = $this->rs_grid->fields[58] ;  
          $this->c_ind_dt_embarque = (string)$this->c_ind_dt_embarque;
          $this->c_medidas_container = $this->rs_grid->fields[59] ;  
          $this->sc_field_7 = $this->rs_grid->fields[60] ;  
          $this->sc_field_7 =  str_replace(",", ".", $this->sc_field_7);
          $this->sc_field_7 = (string)$this->sc_field_7;
          $this->sc_field_8 = $this->rs_grid->fields[61] ;  
          $this->sc_field_8 =  str_replace(",", ".", $this->sc_field_8);
          $this->sc_field_8 = (string)$this->sc_field_8;
          $this->sc_field_5 = $this->rs_grid->fields[62] ;  
          $this->sc_field_6 = $this->rs_grid->fields[63] ;  
          $this->ic_log_rec_doc_prazo_emb = $this->rs_grid->fields[64] ;  
          $this->ic_log_rec_doc_prazo_emb = (string)$this->ic_log_rec_doc_prazo_emb;
          $this->ic_qt_recbto_fisico = $this->rs_grid->fields[65] ;  
          $this->ic_qt_recbto_fisico =  str_replace(",", ".", $this->ic_qt_recbto_fisico);
          $this->ic_qt_recbto_fisico = (string)$this->ic_qt_recbto_fisico;
          $this->ic_qt_confirm_emb = $this->rs_grid->fields[66] ;  
          $this->ic_qt_confirm_emb =  str_replace(",", ".", $this->ic_qt_confirm_emb);
          $this->ic_qt_confirm_emb = (string)$this->ic_qt_confirm_emb;
          $this->ic_qt_alocada = $this->rs_grid->fields[67] ;  
          $this->ic_qt_alocada =  str_replace(",", ".", $this->ic_qt_alocada);
          $this->ic_qt_alocada = (string)$this->ic_qt_alocada;
          $this->ic_observacao = $this->rs_grid->fields[68] ;  
          $this->pc_empresa_id = $this->rs_grid->fields[69] ;  
          $this->pc_empresa_id = (string)$this->pc_empresa_id;
          $this->pc_qt_container = $this->rs_grid->fields[70] ;  
          $this->pc_qt_container = (string)$this->pc_qt_container;
          $GLOBALS["pc_fornecedor_id"] = $this->rs_grid->fields[1] ;  
          $GLOBALS["pc_fornecedor_id"] = (string)$GLOBALS["pc_fornecedor_id"];
          $GLOBALS["ipc_coloracao_id"] = $this->rs_grid->fields[26] ;  
          $GLOBALS["ipc_coloracao_id"] = (string)$GLOBALS["ipc_coloracao_id"];
          $GLOBALS["ipc_formato_amostra_id"] = $this->rs_grid->fields[30] ;  
          $GLOBALS["ipc_formato_amostra_id"] = (string)$GLOBALS["ipc_formato_amostra_id"];
          $GLOBALS["sc_field_2"] = $this->rs_grid->fields[47] ;  
          $GLOBALS["sc_field_2"] = (string)$GLOBALS["sc_field_2"];
          $GLOBALS["c_cod_armador"] = $this->rs_grid->fields[51] ;  
          $GLOBALS["c_cod_armador"] = (string)$GLOBALS["c_cod_armador"];
          $GLOBALS["c_cod_agente_cargas"] = $this->rs_grid->fields[53] ;  
          $GLOBALS["c_cod_agente_cargas"] = (string)$GLOBALS["c_cod_agente_cargas"];
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['rows_emb']++;
          $this->sc_proc_grid = true;
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              if ($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0)
              { 
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid']) {
                      $this->label_grid($linhas);
                  } 
                  $nm_houve_quebra = "N";
              } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['final']; 
          $this->Ini->cor_link_dados = ($this->Ini->cor_link_dados == $this->css_scGridFieldOddLink) ? $this->css_scGridFieldEvenLink : $this->css_scGridFieldOddLink; 
          $this->Ini->qual_linha   = ($this->Ini->qual_linha == "par") ? "impar" : "par";
          if ("impar" == $this->Ini->qual_linha)
          {
              $this->css_line_back = $this->css_scGridFieldOdd;
              $this->css_line_fonf = $this->css_scGridFieldOddFont;
          }
          else
          {
              $this->css_line_back = $this->css_scGridFieldEven;
              $this->css_line_fonf = $this->css_scGridFieldEvenFont;
          }
          $NM_destaque = " onmouseover=\"over_tr(this, '" . $this->css_line_back . "');\" onmouseout=\"out_tr(this, '" . $this->css_line_back . "');\" onclick=\"click_tr(this, '" . $this->css_line_back . "');\"";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "pc_dt_registro")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "pc_dt_limite")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_prev_envio_desenhos")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_real_envio_desenhos")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_prev_aprov_so_ld")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_real_aprov_so_ld")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_maxima_producao")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_mostruario")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_cheg_amostras_emb")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_prev_recbto_so_ld")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_real_recbto_so_ld")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_recbto_laudo")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_recbto_embalagem")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ipc_dt_termino_producao")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "c_dt_prev_embarque")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "c_dt_real_embarque")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "sc_field_5")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "sc_field_6")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "sc_field_3")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
          }
    $dataActionbarPos = 'left';
          $this->grid_fixed_column_no = 0;
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"  style=\"page-break-inside: avoid;\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_pc_qt_container_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
              $this->grid_fixed_column_no++;
          } 
   $this->SC_grid_rightActionBar();
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
      $this->Lin_final = $this->rs_grid->EOF;
      if ($this->Lin_final)
      {
         $this->rs_grid->Close();
      }
   } 
   else
   {
      $this->rs_grid->Close();
   }
   if ($this->rs_grid->EOF) 
   { 
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao']       = "igual" ; 
   } 
 }
function SC_grid_rightActionBar()
{
        global $nm_saida;
    $dataActionbarPos = 'right';
}
 function NM_grid_pc_dt_registro()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_dt_registro']) || $this->NM_cmp_hidden['pc_dt_registro'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_dt_registro)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_dt_registro)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_dt_registro_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_dt_registro_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_dt_registro_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_fornecedor_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_fornecedor_id']) || $this->NM_cmp_hidden['pc_fornecedor_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_fornecedor_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_fornecedor_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_pc_fornecedor_id($conteudo , $this->pc_fornecedor_id) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_fornecedor_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_fornecedor_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_fornecedor_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_proc_compra_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_proc_compra_id']) || $this->NM_cmp_hidden['pc_proc_compra_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_proc_compra_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_proc_compra_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_proc_compra_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_proc_compra_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_proc_compra_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_cod_situacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_cod_situacao']) || $this->NM_cmp_hidden['pc_cod_situacao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_cod_situacao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_cod_situacao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_pc_cod_situacao($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_cod_situacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_cod_situacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_cod_situacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_cod_proc_fornec()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_cod_proc_fornec']) || $this->NM_cmp_hidden['pc_cod_proc_fornec'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->pc_cod_proc_fornec));
              $conteudo_original = NM_encode_input(sc_strip_script($this->pc_cod_proc_fornec));
          }
          else {
              $conteudo = sc_strip_script($this->pc_cod_proc_fornec); 
              $conteudo_original = sc_strip_script($this->pc_cod_proc_fornec); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_cod_proc_fornec_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_cod_proc_fornec_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_cod_proc_fornec_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_qt_dias_translado()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_qt_dias_translado']) || $this->NM_cmp_hidden['pc_qt_dias_translado'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_qt_dias_translado)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_qt_dias_translado)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_qt_dias_translado_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_qt_dias_translado_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_qt_dias_translado_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_observacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_observacao']) || $this->NM_cmp_hidden['pc_observacao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->pc_observacao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->pc_observacao));
          }
          else {
              $conteudo = sc_strip_script($this->pc_observacao); 
              $conteudo_original = sc_strip_script($this->pc_observacao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_observacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_observacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_observacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_dt_limite()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_dt_limite']) || $this->NM_cmp_hidden['pc_dt_limite'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_dt_limite)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_dt_limite)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_dt_limite_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_dt_limite_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_dt_limite_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_log_facilid_contato_fornec()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_log_facilid_contato_fornec']) || $this->NM_cmp_hidden['pc_log_facilid_contato_fornec'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->pc_log_facilid_contato_fornec));
              $conteudo_original = NM_encode_input(sc_strip_script($this->pc_log_facilid_contato_fornec));
          }
          else {
              $conteudo = sc_strip_script($this->pc_log_facilid_contato_fornec); 
              $conteudo_original = sc_strip_script($this->pc_log_facilid_contato_fornec); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_pc_log_facilid_contato_fornec($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_log_facilid_contato_fornec_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_log_facilid_contato_fornec_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_log_facilid_contato_fornec_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_item_proc_compra_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_item_proc_compra_id']) || $this->NM_cmp_hidden['ipc_item_proc_compra_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_item_proc_compra_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_item_proc_compra_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_item_proc_compra_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_item_proc_compra_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_item_proc_compra_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_descricao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_descricao']) || $this->NM_cmp_hidden['ipc_descricao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_descricao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_descricao));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_descricao); 
              $conteudo_original = sc_strip_script($this->ipc_descricao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_descricao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_descricao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_descricao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_codigo_erp()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_codigo_erp']) || $this->NM_cmp_hidden['ipc_codigo_erp'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_codigo_erp));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_codigo_erp));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_codigo_erp); 
              $conteudo_original = sc_strip_script($this->ipc_codigo_erp); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_codigo_erp_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_codigo_erp_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_codigo_erp_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_qt_dias_producao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_qt_dias_producao']) || $this->NM_cmp_hidden['ipc_qt_dias_producao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_qt_dias_producao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_qt_dias_producao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_qt_dias_producao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_qt_dias_producao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_qt_dias_producao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_unid_medida()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_unid_medida']) || $this->NM_cmp_hidden['ipc_unid_medida'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_unid_medida));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_unid_medida));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_unid_medida); 
              $conteudo_original = sc_strip_script($this->ipc_unid_medida); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_unid_medida_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_unid_medida_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_unid_medida_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_qt_comprada()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_qt_comprada']) || $this->NM_cmp_hidden['ipc_qt_comprada'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_qt_comprada)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_qt_comprada)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_qt_comprada_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_qt_comprada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_qt_comprada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_vl_custo_dolar()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_vl_custo_dolar']) || $this->NM_cmp_hidden['ipc_vl_custo_dolar'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_vl_custo_dolar)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_vl_custo_dolar)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_vl_custo_dolar_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_vl_custo_dolar_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_vl_custo_dolar_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_vl_base_tributacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_vl_base_tributacao']) || $this->NM_cmp_hidden['ipc_vl_base_tributacao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_vl_base_tributacao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_vl_base_tributacao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_vl_base_tributacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_vl_base_tributacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_vl_base_tributacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_rolo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_rolo']) || $this->NM_cmp_hidden['ipc_rolo'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_rolo));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_rolo));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_rolo); 
              $conteudo_original = sc_strip_script($this->ipc_rolo); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_rolo_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_rolo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_rolo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_largura()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_largura']) || $this->NM_cmp_hidden['ipc_largura'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_largura));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_largura));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_largura); 
              $conteudo_original = sc_strip_script($this->ipc_largura); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_largura_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_largura_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_largura_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_peso()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_peso']) || $this->NM_cmp_hidden['ipc_peso'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_peso));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_peso));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_peso); 
              $conteudo_original = sc_strip_script($this->ipc_peso); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_peso_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_peso_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_peso_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_composicao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_composicao']) || $this->NM_cmp_hidden['ipc_composicao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_composicao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_composicao));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_composicao); 
              $conteudo_original = sc_strip_script($this->ipc_composicao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_composicao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_composicao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_composicao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_prev_envio_desenhos()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_prev_envio_desenhos']) || $this->NM_cmp_hidden['ipc_dt_prev_envio_desenhos'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_prev_envio_desenhos)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_prev_envio_desenhos)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_prev_envio_desenhos_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_prev_envio_desenhos_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_prev_envio_desenhos_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_real_envio_desenhos()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_real_envio_desenhos']) || $this->NM_cmp_hidden['ipc_dt_real_envio_desenhos'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_real_envio_desenhos)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_real_envio_desenhos)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_real_envio_desenhos_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_real_envio_desenhos_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_real_envio_desenhos_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_log_aprov_so_ld()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_log_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_log_aprov_so_ld'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_log_aprov_so_ld)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_log_aprov_so_ld)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_log_aprov_so_ld_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_log_aprov_so_ld_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_log_aprov_so_ld_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_prev_aprov_so_ld()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_prev_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_dt_prev_aprov_so_ld'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_prev_aprov_so_ld)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_prev_aprov_so_ld)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_prev_aprov_so_ld_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_prev_aprov_so_ld_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_prev_aprov_so_ld_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_real_aprov_so_ld()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_real_aprov_so_ld']) || $this->NM_cmp_hidden['ipc_dt_real_aprov_so_ld'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_real_aprov_so_ld)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_real_aprov_so_ld)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_real_aprov_so_ld_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_real_aprov_so_ld_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_real_aprov_so_ld_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_coloracao_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_coloracao_id']) || $this->NM_cmp_hidden['ipc_coloracao_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_coloracao_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_coloracao_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_coloracao_id($conteudo , $this->ipc_coloracao_id) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_coloracao_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_coloracao_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_coloracao_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_maxima_producao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_maxima_producao']) || $this->NM_cmp_hidden['ipc_dt_maxima_producao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_maxima_producao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_maxima_producao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_maxima_producao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_maxima_producao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_maxima_producao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_mostruario()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_mostruario']) || $this->NM_cmp_hidden['ipc_dt_mostruario'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_mostruario)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_mostruario)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_mostruario_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_mostruario_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_mostruario_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_log_mostruario()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_log_mostruario']) || $this->NM_cmp_hidden['ipc_log_mostruario'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_log_mostruario));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_log_mostruario));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_log_mostruario); 
              $conteudo_original = sc_strip_script($this->ipc_log_mostruario); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_log_mostruario($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_log_mostruario_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_log_mostruario_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_log_mostruario_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_formato_amostra_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_formato_amostra_id']) || $this->NM_cmp_hidden['ipc_formato_amostra_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_formato_amostra_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_formato_amostra_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_formato_amostra_id($conteudo , $this->ipc_formato_amostra_id) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_formato_amostra_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_formato_amostra_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_formato_amostra_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_observacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_observacao']) || $this->NM_cmp_hidden['ipc_observacao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ipc_observacao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_observacao));
          }
          else {
              $conteudo = sc_strip_script($this->ipc_observacao); 
              $conteudo_original = sc_strip_script($this->ipc_observacao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_observacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_observacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_observacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_cheg_amostras_emb()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_cheg_amostras_emb']) || $this->NM_cmp_hidden['ipc_dt_cheg_amostras_emb'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_cheg_amostras_emb)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_cheg_amostras_emb)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_cheg_amostras_emb_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_cheg_amostras_emb_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_cheg_amostras_emb_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_prev_recbto_so_ld()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_prev_recbto_so_ld']) || $this->NM_cmp_hidden['ipc_dt_prev_recbto_so_ld'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_prev_recbto_so_ld)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_prev_recbto_so_ld)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_prev_recbto_so_ld_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_prev_recbto_so_ld_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_prev_recbto_so_ld_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_real_recbto_so_ld()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_real_recbto_so_ld']) || $this->NM_cmp_hidden['ipc_dt_real_recbto_so_ld'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_real_recbto_so_ld)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_real_recbto_so_ld)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_real_recbto_so_ld_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_real_recbto_so_ld_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_real_recbto_so_ld_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_vl_cubagem()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_vl_cubagem']) || $this->NM_cmp_hidden['ipc_vl_cubagem'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_vl_cubagem)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_vl_cubagem)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_vl_cubagem_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_vl_cubagem_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_vl_cubagem_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_recbto_laudo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_recbto_laudo']) || $this->NM_cmp_hidden['ipc_dt_recbto_laudo'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_recbto_laudo)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_recbto_laudo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_recbto_laudo_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_recbto_laudo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_recbto_laudo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_recbto_embalagem()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_recbto_embalagem']) || $this->NM_cmp_hidden['ipc_dt_recbto_embalagem'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_recbto_embalagem)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_recbto_embalagem)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_recbto_embalagem_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_recbto_embalagem_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_recbto_embalagem_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_producao_no_prazo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_producao_no_prazo']) || $this->NM_cmp_hidden['ipc_ind_producao_no_prazo'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_producao_no_prazo)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_producao_no_prazo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_producao_no_prazo($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_producao_no_prazo_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_producao_no_prazo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_producao_no_prazo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_relat_semanal_producao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_relat_semanal_producao']) || $this->NM_cmp_hidden['ipc_ind_relat_semanal_producao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_relat_semanal_producao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_relat_semanal_producao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_relat_semanal_producao($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_relat_semanal_producao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_relat_semanal_producao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_relat_semanal_producao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_laudo_antes_embarque()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_laudo_antes_embarque']) || $this->NM_cmp_hidden['ipc_ind_laudo_antes_embarque'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_laudo_antes_embarque)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_laudo_antes_embarque)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_laudo_antes_embarque($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_laudo_antes_embarque_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_laudo_antes_embarque_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_laudo_antes_embarque_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_qualid_emb()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_qualid_emb']) || $this->NM_cmp_hidden['ipc_ind_qualid_emb'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_qualid_emb)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_qualid_emb)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_qualid_emb($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_qualid_emb_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_qualid_emb_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_qualid_emb_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_prod_conf_pi()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_prod_conf_pi']) || $this->NM_cmp_hidden['ipc_ind_prod_conf_pi'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_prod_conf_pi)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_prod_conf_pi)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_prod_conf_pi($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_prod_conf_pi_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_prod_conf_pi_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_prod_conf_pi_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_rec_amostra_antes_emb()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_rec_amostra_antes_emb']) || $this->NM_cmp_hidden['ipc_ind_rec_amostra_antes_emb'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_rec_amostra_antes_emb)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_rec_amostra_antes_emb)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_rec_amostra_antes_emb($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_rec_amostra_antes_emb_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_rec_amostra_antes_emb_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_rec_amostra_antes_emb_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_qt_conf_proforma()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_qt_conf_proforma']) || $this->NM_cmp_hidden['ipc_ind_qt_conf_proforma'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_qt_conf_proforma)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_qt_conf_proforma)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_qt_conf_proforma($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_qt_conf_proforma_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_qt_conf_proforma_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_qt_conf_proforma_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_ind_tamanho_pecas_correto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_ind_tamanho_pecas_correto']) || $this->NM_cmp_hidden['ipc_ind_tamanho_pecas_correto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_ind_tamanho_pecas_correto)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_ind_tamanho_pecas_correto)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ipc_ind_tamanho_pecas_correto($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_ind_tamanho_pecas_correto_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_ind_tamanho_pecas_correto_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_ind_tamanho_pecas_correto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ipc_dt_termino_producao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ipc_dt_termino_producao']) || $this->NM_cmp_hidden['ipc_dt_termino_producao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ipc_dt_termino_producao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ipc_dt_termino_producao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ipc_dt_termino_producao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ipc_dt_termino_producao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ipc_dt_termino_producao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_2']) || $this->NM_cmp_hidden['sc_field_2'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_2)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_2)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_sc_field_2($conteudo , $this->sc_field_2) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_2_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_2_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_4()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_4']) || $this->NM_cmp_hidden['sc_field_4'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_4)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_4)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_4_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_4_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_4_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_situacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_situacao']) || $this->NM_cmp_hidden['c_situacao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_situacao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_situacao)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_situacao($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_situacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_situacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_situacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_exclusivo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_exclusivo']) || $this->NM_cmp_hidden['c_exclusivo'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->c_exclusivo));
              $conteudo_original = NM_encode_input(sc_strip_script($this->c_exclusivo));
          }
          else {
              $conteudo = sc_strip_script($this->c_exclusivo); 
              $conteudo_original = sc_strip_script($this->c_exclusivo); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_exclusivo($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_exclusivo_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_exclusivo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_exclusivo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_cod_armador()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_cod_armador']) || $this->NM_cmp_hidden['c_cod_armador'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_cod_armador)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_cod_armador)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_cod_armador($conteudo , $this->c_cod_armador) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_cod_armador_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_cod_armador_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_cod_armador_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_log_pagto_final()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_log_pagto_final']) || $this->NM_cmp_hidden['c_log_pagto_final'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->c_log_pagto_final));
              $conteudo_original = NM_encode_input(sc_strip_script($this->c_log_pagto_final));
          }
          else {
              $conteudo = sc_strip_script($this->c_log_pagto_final); 
              $conteudo_original = sc_strip_script($this->c_log_pagto_final); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_log_pagto_final_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_log_pagto_final_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_log_pagto_final_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_cod_agente_cargas()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_cod_agente_cargas']) || $this->NM_cmp_hidden['c_cod_agente_cargas'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_cod_agente_cargas)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_cod_agente_cargas)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_cod_agente_cargas($conteudo , $this->c_cod_agente_cargas) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_cod_agente_cargas_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_cod_agente_cargas_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_cod_agente_cargas_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_ind_dt_prev_chegada()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_ind_dt_prev_chegada']) || $this->NM_cmp_hidden['c_ind_dt_prev_chegada'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_ind_dt_prev_chegada)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_ind_dt_prev_chegada)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_ind_dt_prev_chegada($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_ind_dt_prev_chegada_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_ind_dt_prev_chegada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_ind_dt_prev_chegada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_dt_prev_embarque()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_dt_prev_embarque']) || $this->NM_cmp_hidden['c_dt_prev_embarque'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_dt_prev_embarque)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_dt_prev_embarque)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_dt_prev_embarque_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_dt_prev_embarque_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_dt_prev_embarque_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_dt_real_embarque()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_dt_real_embarque']) || $this->NM_cmp_hidden['c_dt_real_embarque'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_dt_real_embarque)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_dt_real_embarque)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_dt_real_embarque_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_dt_real_embarque_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_dt_real_embarque_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_situacao_container_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_situacao_container_id']) || $this->NM_cmp_hidden['c_situacao_container_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_situacao_container_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_situacao_container_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_situacao_container_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_situacao_container_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_situacao_container_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_ind_dt_embarque()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_ind_dt_embarque']) || $this->NM_cmp_hidden['c_ind_dt_embarque'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->c_ind_dt_embarque)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->c_ind_dt_embarque)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_c_ind_dt_embarque($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_ind_dt_embarque_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_ind_dt_embarque_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_ind_dt_embarque_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_c_medidas_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['c_medidas_container']) || $this->NM_cmp_hidden['c_medidas_container'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->c_medidas_container));
              $conteudo_original = NM_encode_input(sc_strip_script($this->c_medidas_container));
          }
          else {
              $conteudo = sc_strip_script($this->c_medidas_container); 
              $conteudo_original = sc_strip_script($this->c_medidas_container); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_c_medidas_container_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_c_medidas_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_c_medidas_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_7()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_7']) || $this->NM_cmp_hidden['sc_field_7'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_7)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_7)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_7_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_7_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_7_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_8()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_8']) || $this->NM_cmp_hidden['sc_field_8'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_8)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_8)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "5", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_8_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_8_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_8_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_5()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_5']) || $this->NM_cmp_hidden['sc_field_5'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_5)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_5)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_5_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_5_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_5_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sc_field_6()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sc_field_6']) || $this->NM_cmp_hidden['sc_field_6'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sc_field_6)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sc_field_6)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sc_field_6_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sc_field_6_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sc_field_6_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ic_log_rec_doc_prazo_emb()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ic_log_rec_doc_prazo_emb']) || $this->NM_cmp_hidden['ic_log_rec_doc_prazo_emb'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ic_log_rec_doc_prazo_emb)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ic_log_rec_doc_prazo_emb)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_ic_log_rec_doc_prazo_emb($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ic_log_rec_doc_prazo_emb_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ic_log_rec_doc_prazo_emb_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ic_log_rec_doc_prazo_emb_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ic_qt_recbto_fisico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ic_qt_recbto_fisico']) || $this->NM_cmp_hidden['ic_qt_recbto_fisico'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ic_qt_recbto_fisico)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ic_qt_recbto_fisico)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ic_qt_recbto_fisico_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ic_qt_recbto_fisico_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ic_qt_recbto_fisico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ic_qt_confirm_emb()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ic_qt_confirm_emb']) || $this->NM_cmp_hidden['ic_qt_confirm_emb'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ic_qt_confirm_emb)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ic_qt_confirm_emb)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ic_qt_confirm_emb_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ic_qt_confirm_emb_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ic_qt_confirm_emb_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ic_qt_alocada()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ic_qt_alocada']) || $this->NM_cmp_hidden['ic_qt_alocada'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ic_qt_alocada)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->ic_qt_alocada)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ic_qt_alocada_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ic_qt_alocada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ic_qt_alocada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ic_observacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ic_observacao']) || $this->NM_cmp_hidden['ic_observacao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->ic_observacao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->ic_observacao));
          }
          else {
              $conteudo = sc_strip_script($this->ic_observacao); 
              $conteudo_original = sc_strip_script($this->ic_observacao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_ic_observacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_ic_observacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ic_observacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_empresa_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_empresa_id']) || $this->NM_cmp_hidden['pc_empresa_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_empresa_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_empresa_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_empresa_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_empresa_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_empresa_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pc_qt_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pc_qt_container']) || $this->NM_cmp_hidden['pc_qt_container'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pc_qt_container)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->pc_qt_container)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_pc_qt_container_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_pc_qt_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pc_qt_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 71;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
   }
 }
 function nm_quebra_pagina($nm_parms)
 {
    global $nm_saida;
    if ($this->nmgp_prim_pag_pdf && $nm_parms == "pagina")
    {
        $this->nmgp_prim_pag_pdf = false;
        return;
    }
    $this->Ini->nm_cont_lin++;
    if (($this->Ini->nm_limite_lin > 0 && $this->Ini->nm_cont_lin > $this->Ini->nm_limite_lin) || $nm_parms == "pagina" || $nm_parms == "resumo" || $nm_parms == "total")
    {
        $nm_saida->saida("</TABLE></TD></TR>\r\n");
        $this->Ini->nm_cont_lin = ($nm_parms == "pagina") ? 0 : 1;
        if ($this->Print_All)
        {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['print_navigator'] == "Netscape")
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
            else
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" class=\"scGridBorder\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
        }
        else
        {
            $nm_saida->saida("</table><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div><table width='100%' cellspacing=0 cellpadding=0>\r\n");
        }
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\" width=\"100%\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] && $nm_parms != "resumo" && $nm_parms != "pagina" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida_grid'])
        {
            $this->nm_inicio_pag = 0;
        }
    }
 }
 function quebra_geral_sc_free_total_top() 
 {
   global $nm_saida; 
 }
 function quebra_geral_sc_free_total_bot() 
 {
 }
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nmgp_barra_top_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][2] : "";
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;display:none;\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = " selected='selected'";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"scQuickSearchSubmit_top();\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '';document.F0_top.nmgp_opcao.value='fast_search';document.F0_top.submit();\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("          </span>");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $UseAlias =  "N";
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
              $UseAlias =  "N";
          }
          else
          {
              $UseAlias =  "S";
          }
              $this->nm_btn_exist['sort_col'][] = "ordcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Gb_Free_cmp']))
          {
              $Tem_csv_res = "n";
          }
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '1', '$Csv_mod_export');", "nm_gp_move('csv', '1', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_1";
              $nm_saida->saida("          <img id=\"NM_sep_1\" class=\"NM_toolbar_sep\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
          }
        }
          if (is_file("cons_planilha_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_planilha_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '');", "nm_gp_move('busca', '0', '');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
      $this->NM_calc_span();
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_bottom) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot {\r\n");
$nm_saida->saida("        /*display: block;\r\n");
$nm_saida->saida("        width: 100%;*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            bottom: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 6;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 1px 0px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-bottom: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        } */\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_bot_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'];
              $this->nm_btn_exist['goto'][] = "brec_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "document.F0_bot.nmgp_opcao.value='muda_rec_linhas';document.F0_bot.rec.value = ((document.F0_bot.rec.value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; document.F0_bot.submit();", "document.F0_bot.nmgp_opcao.value='muda_rec_linhas';document.F0_bot.rec.value = ((document.F0_bot.rec.value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; document.F0_bot.submit();", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ($Reg_Page != 'all') ? ceil($this->nmgp_reg_inicial / $Reg_Page) : 1;
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"document.F0_bot.nmgp_opcao.value='muda_qt_linhas';document.F0_bot.submit();\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '30') ? " selected" : "";
              $nm_saida->saida("           <option value=\"30\" " . $obj_sel . ">30</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '100') ? " selected" : "";
              $nm_saida->saida("           <option value=\"100\" " . $obj_sel . ">100</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] == '200') ? " selected" : "";
              $nm_saida->saida("           <option value=\"200\" " . $obj_sel . ">200</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['first'][] = "first_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['back'][] = "back_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
              $Link_ini   = 1;
              if ($Page_Atu > $Max_link)
              {
                  $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
              }
              elseif ($Page_Atu > $Mid_link)
              {
                  $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
              }
              if (($Qtd_Pages - $Link_ini) < $Max_link)
              {
                  $Link_ini = ($Qtd_Pages - $Max_link) + 1;
              }
              if ($Link_ini < 1)
              {
                  $Link_ini = 1;
              }
              for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
              {
                  $rec = (($Link_ini - 1) * $Reg_Page) + 1;
                  if ($Link_ini == $Page_Atu)
                  {
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ");\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['rows'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->count_ger."</span>", $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->nmgp_reg_final."</span>", $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", "<span class='sm_counter_total'>".$this->count_ger."</span>", $nm_sumario);
              $nm_saida->saida("           <span class=\"summary_indicator " . $this->css_css_toolbar_obj . "\" style=\"border:0px;\"><span class='sm_counter'>" . $nm_sumario . "</span></span>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("cons_planilha_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_planilha_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['fast_search'][2] : "";
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;display:none;\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = " selected='selected'";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"scQuickSearchSubmit_top();\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '';document.F0_top.nmgp_opcao.value='fast_search';document.F0_top.submit();\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("          </span>");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Gb_Free_cmp']))
          {
              $Tem_csv_res = "n";
          }
          $Csv_mod_export = "grid";
          if ($Tem_csv_res == "n")
          {
              $Csv_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '1', '$Csv_mod_export');", "nm_gp_move('csv', '1', '$Csv_mod_export');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['group_2'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_2_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_2_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_top')", "scBtnGrpShow('group_2_top')", "sc_btgp_btn_group_2_top", "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['filter'] == "on"  && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_pesq_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
           $this->nm_btn_exist['filter'][] = "pesq_top";
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpesquisa", "nm_gp_move('busca', '0', 'grid');", "nm_gp_move('busca', '0', 'grid');", "pesq_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
           $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_selcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $UseAlias =  "N";
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
              $UseAlias =  "N";
          }
          else
          {
              $UseAlias =  "S";
          }
          $nm_saida->saida("            <div id=\"div_ordcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['sort_col'][] = "ordcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_planilha/cons_planilha_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_res_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
                  $NM_Gbtn = true;
          }
        }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
          if (is_file("cons_planilha_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_planilha_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '');", "nm_gp_move('busca', '0', '');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn  = false;
      $NM_Gbtn = false;
      $this->NM_calc_span();
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_bottom) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot {\r\n");
$nm_saida->saida("        /*display: block;\r\n");
$nm_saida->saida("        width: 100%;*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            bottom: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 6;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 1px 0px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_bot .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-bottom: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        } */\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr id=\"sc_grid_toobar_bot_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['first'][] = "first_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini');", "nm_gp_submit_rec('ini');", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['back'][] = "back_bot";
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "disabled", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "nm_gp_submit_rec('" . $this->Rec_ini . "');", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['rows'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->count_ger."</span>", $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", "<span class='sm_counter_final'>".$this->nmgp_reg_final."</span>", $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", "<span class='sm_counter_total'>".$this->count_ger."</span>", $nm_sumario);
              $nm_saida->saida("           <span class=\"summary_indicator " . $this->css_css_toolbar_obj . "\" style=\"border:0px;\"><span class='sm_counter'>" . $nm_sumario . "</span></span>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("cons_planilha_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_planilha_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top()
   {
       if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_mobile();
           $this->nmgp_embbed_placeholder_top();
       }
       if (!isset($_SESSION['scriptcase']['proc_mobile']) || !$_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_normal();
           $this->nmgp_embbed_placeholder_top();
       }
   }
   function nmgp_barra_bot()
   {
       if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot_mobile();
       }
       if (!isset($_SESSION['scriptcase']['proc_mobile']) || !$_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot_normal();
       }
   }
   function nmgp_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['embutida'])
   { 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']))
       {
           $temp = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               $temp[] = $NM_aplic;
           }
           $temp = array_unique($temp);
           foreach ($temp as $NM_aplic)
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ajax_nav'])
               { 
                   $this->Ini->Arr_result['setArr'][] = array('var' => ' NM_tab_' . $NM_aplic, 'value' => '');
               } 
               $nm_saida->saida("   NM_tab_" . $NM_aplic . " = new Array();\r\n");
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               foreach ($resto as $NM_ind => $NM_quebra)
               {
                   foreach ($NM_quebra as $NM_nivel => $NM_tipo)
                   {
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['ajax_nav'])
                       { 
                           $this->Ini->Arr_result['setVar'][] = array('var' => ' NM_tab_' . $NM_aplic . '[' . $NM_ind . ']', 'value' => $NM_tipo . $NM_nivel);
                       } 
                       $nm_saida->saida("   NM_tab_" . $NM_aplic . "[" . $NM_ind . "] = '" . $NM_tipo . $NM_nivel . "';\r\n");
                   }
               }
           }
       }
   }
   $nm_saida->saida("   function NM_liga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = parseInt (Obj[tbody].substr(3));\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = parseInt (Obj[ind].substr(3));\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if (Nivel == Nv && Tp == 'top')\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if (((Nivel + 1) == Nv && Tp == 'top') || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='';\r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_apaga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = Obj[tbody].substr(3);\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = Obj[ind].substr(3);\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if ((Nivel == Nv && Tp == 'top') || Nv < Nivel)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if ((Nivel != Nv) || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='none';\r\n");
   $nm_saida->saida("               if (Tp == 'top')\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   document.getElementById('b_open_' + Apl + '_' + ind).style.display='';\r\n");
   $nm_saida->saida("                   document.getElementById('b_close_' + Apl + '_' + ind).style.display='none';\r\n");
   $nm_saida->saida("               } \r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   NM_obj_ant = '';\r\n");
   $nm_saida->saida("   function NM_apaga_div_lig(obj_nome)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      if (NM_obj_ant != '')\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_obj_ant.style.display='none';\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      obj = document.getElementById(obj_nome);\r\n");
   $nm_saida->saida("      NM_obj_ant = obj;\r\n");
   $nm_saida->saida("      ind_time = setTimeout(\"obj.style.display='none'\", 300);\r\n");
   $nm_saida->saida("      return ind_time;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_btn_disable()\r\n");
   $nm_saida->saida("   {\r\n");
   foreach ($this->nm_btn_disabled as $cod_btn => $st_btn) {
      if (isset($this->nm_btn_exist[$cod_btn]) && $st_btn == 'on') {
         foreach ($this->nm_btn_exist[$cod_btn] as $cada_id) {
       $nm_saida->saida("     $('#" . $cada_id . "').prop('onclick', null).off('click').addClass('disabled').removeAttr('href');\r\n");
       $nm_saida->saida("     $('#div_" . $cada_id . "').addClass('disabled');\r\n");
         }
      }
   }
   $nm_saida->saida("   }\r\n");
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   if (@is_file($str_pbfile) && $flag_apaga_pdf_log)
   {
      @unlink($str_pbfile);
   }
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      window.onload = function() {\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_planilha', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   $nm_saida->saida("   </HTML>\r\n");
 }
//--- 
//--- 
 function form_navegacao()
 {
   global
   $nm_saida, $nm_url_saida;
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   $nm_saida->saida("   <form name=\"F3\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_chave\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_ordem\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"cons_planilha\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parm_acum\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F5\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"cons_planilha_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fexport\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tp_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tot_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_line\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_col\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_dados\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_label_csv\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_tag\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_format\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("        action=\"./\" \r\n");
   $nm_saida->saida("        target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("  <form name=\"Fpdf\" method=\"post\" target=\"_self\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_tp_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_create_charts\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"chart_level\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"page_break_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_cab\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_label\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_label_group\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.action = \"cons_planilha_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fdoc_word.submit();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var obj_tr      = \"\";\r\n");
   $nm_saida->saida("   var css_tr      = \"\";\r\n");
   $nm_saida->saida("   var field_over  = " . $this->NM_field_over . ";\r\n");
   $nm_saida->saida("   var field_click = " . $this->NM_field_click . ";\r\n");
   $nm_saida->saida("   function over_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldOver . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function out_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = class_obj;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function click_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_click != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr != \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr.className = css_tr;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr     = '';\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj_tr        = obj;\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldClick . "';\r\n");
   $nm_saida->saida("   }\r\n");
   if ($this->Rec_ini == 0)
   {
       $nm_saida->saida("   nm_gp_ini = \"ini\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_ini = \"\";\r\n");
   }
   $nm_saida->saida("   nm_gp_rec_ini = \"" . $this->Rec_ini . "\";\r\n");
   $nm_saida->saida("   nm_gp_rec_fim = \"" . $this->Rec_fim . "\";\r\n");
   $nm_saida->saida("   function nm_gp_submit_rec(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (nm_gp_ini == \"ini\" && (campo == \"ini\" || campo == nm_gp_rec_ini)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      if (nm_gp_fim == \"fim\" && (campo == \"fim\" || campo == nm_gp_rec_fim)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      document.F4.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F4.rec.value = campo ;\r\n");
   $nm_saida->saida("      document.F4.nmgp_opcao.value = \"rec\" ;\r\n");
   $nm_saida->saida("      document.F4.submit() ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target           = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_ordem.value = campo ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value = \"ordem\" ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value = \"SC_null\";\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("      document.F3.submit() ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      if (ancor != null) {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_open_export(arq_export) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      window.location = arq_export;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_parms.value = \"SC_null\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_orig_pesq.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_url_saida.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_opcao.value = x; \r\n");
   $nm_saida->saida("       document.F3.nmgp_outra_jan.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.target = \"_self\"; \r\n");
   $nm_saida->saida("       if (y == 1) \r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.target = \"_blank\"; \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"busca\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.nmgp_orig_pesq.value = z; \r\n");
   $nm_saida->saida("           z = '';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (z != null && z != '') \r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.F3.nmgp_tipo_pdf.value = z; \r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (\"xls\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   if (!extension_loaded("zip"))
   {
       $nm_saida->saida("           alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
       $nm_saida->saida("           return false;\r\n");
   } 
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"xml\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   $nm_saida->saida("       }\r\n");
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['cons_planilha_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_planilha@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_opcao.value = \"pdf\";\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms.value = \"" . $Md5_pdf . "\";\r\n");
   $nm_saida->saida("           document.Fpdf.sc_tp_pdf.value = z;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_create_charts.value = crt;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.chart_level.value = chart_level;\r\n");
   $nm_saida->saida("           document.Fpdf.page_break_pdf.value = page_break_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fpdf.use_pass_pdf.value = use_pass_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_cab.value = pdf_all_cab;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_label.value = pdf_all_label;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_label_group.value = pdf_label_group;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_zip.value = pdf_zip;\r\n");
   $nm_saida->saida("           document.Fpdf.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\";\r\n");
   $nm_saida->saida("           if (\"S\" == ajax)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               $('#TB_window').remove();\r\n");
   $nm_saida->saida("               $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"cons_planilha_iframe.php\";\r\n");
   $nm_saida->saida("               document.Fpdf.submit();\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if ((x == 'igual' || x == 'edit') && NM_ancor_ult_lig != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("                ajax_save_ancor(\"F3\", NM_ancor_ult_lig);\r\n");
   $nm_saida->saida("                NM_ancor_ult_lig = \"\";\r\n");
   $nm_saida->saida("            } else {\r\n");
   $nm_saida->saida("                document.F3.submit() ;\r\n");
   $nm_saida->saida("            } \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.target = \"_blank\"; \r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"csv\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_line.value = delim_line;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_col.value = delim_col;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_dados.value = delim_dados;\r\n");
   $nm_saida->saida("           document.Fexport.nm_label_csv.value = label_csv;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.target = \"_blank\"; \r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_planilha_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_planilha/cons_planilha_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_planilha_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"cons_planilha_export_ctrl.php\";\r\n");
   $nm_saida->saida("       document.Fexport.submit() ;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       tb_show(\"\", imagem, \"\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo2 + \"?nmgp_parms=\" + campo1, \"_self\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['cons_planilha']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
          $nm_saida->saida("          else\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = null;\r\n");
          $nm_saida->saida("          }\r\n");
      $nm_saida->saida("          if (Obj_Form.value != document.Fpesq.nm_ret_psq.value)\r\n");
      $nm_saida->saida("          {\r\n");
      $nm_saida->saida("              Obj_Form.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              if (Obj_Form != Obj_Form1 && Obj_Form1)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form1.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              if (null != Obj_Readonly)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Readonly.innerHTML = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['js_apos_busca'] . "();\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
     else
     {
      $nm_saida->saida("              if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
      $nm_saida->saida("          }\r\n");
      $nm_saida->saida("      }\r\n");
   }
   $nm_saida->saida("      document.F5.action = \"cons_planilha_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_planilha']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('cons_planilha')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_planilha', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
