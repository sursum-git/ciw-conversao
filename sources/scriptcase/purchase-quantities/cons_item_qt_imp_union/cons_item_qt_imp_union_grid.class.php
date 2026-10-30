<?php
class cons_item_qt_imp_union_grid
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
   var $NM_bg_tot;
   var $NM_bg_sub_tot;
   var $NM_cont_body; 
   var $NM_emb_tree_no; 
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
   var $sum_qt_rec_final;
   var $sum_vl_rec_final;
   var $sum_qt_comprada_final;
   var $sum_vl_comprada_final;
   var $desc_item_fornec_Old;
   var $arg_sum_desc_item_fornec;
   var $Label_desc_item_fornec;
   var $sc_proc_quebra_desc_item_fornec;
   var $count_desc_item_fornec;
   var $sum_desc_item_fornec_qt_rec_final;
   var $sum_desc_item_fornec_vl_rec_final;
   var $sum_desc_item_fornec_qt_comprada_final;
   var $sum_desc_item_fornec_vl_comprada_final;
   var $codigo_erp_Old;
   var $arg_sum_codigo_erp;
   var $Label_codigo_erp;
   var $sc_proc_quebra_codigo_erp;
   var $count_codigo_erp;
   var $sum_codigo_erp_qt_rec_final;
   var $sum_codigo_erp_vl_rec_final;
   var $sum_codigo_erp_qt_comprada_final;
   var $sum_codigo_erp_vl_comprada_final;
   var $dt_fim_prev_recbto;
   var $dt_fim_prev_recbto_2;
   var $dt_fim_recebimento;
   var $dt_fim_recebimento_2;
   var $dt_fim_registro;
   var $dt_fim_registro_2;
   var $dt_ini_prev_recbto;
   var $dt_ini_prev_recbto_2;
   var $dt_ini_recebimento;
   var $dt_ini_recebimento_2;
   var $dt_ini_registro;
   var $dt_ini_registro_2;
   var $filtro_situacao;
   var $cod_situacao;
   var $pedido_fornec;
   var $vl_negociado;
   var $qt_comprada;
   var $qt_confirmada_embarque;
   var $qt_recbto_fisico;
   var $qt_rec_final;
   var $vl_rec_final;
   var $qt_comprada_final;
   var $vl_comprada_final;
   var $nr_container;
   var $situacao_container;
   var $dt_registro;
   var $dt_recebimento;
   var $dt_prev_chegada;
   var $codigo_erp;
   var $desc_item_fornec;
   var $look_cod_situacao;

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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
      {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
       { 
           include_once($this->Ini->path_embutida . "cons_item_qt_imp_union/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
           include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new cons_item_qt_imp_union_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
      }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'])
       {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
       } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=1>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['cons_item_qt_imp_union'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['save_grid']);
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'] && (!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']))
       {
           $this->grid();
       }
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_bot();
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new cons_item_qt_imp_union_grafico();
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
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("pt_br");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['label_group'] : "N";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['all_cab'] : "S";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_pdf']['all_label'] : "S";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['mostra_edit'] = "N";
   }
   $this->sc_proc_quebra_desc_item_fornec = false;
   $this->sc_proc_quebra_codigo_erp = false;
   $this->NM_cont_body   = 0; 
   $this->NM_emb_tree_no = false; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'] = 0;
   }
   elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['emb_tree_no']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['emb_tree_no'])
   { 
       $this->NM_emb_tree_no = true; 
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("cons_item_qt_imp_union", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['xml'] = "on";
   $this->nmgp_botoes['json'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['rtf'] = "on";
   $this->nmgp_botoes['word'] = "on";
   $this->nmgp_botoes['doc'] = "on";
   $this->nmgp_botoes['export'] = "on";
   $this->nmgp_botoes['print'] = "on";
   $this->nmgp_botoes['html'] = "on";
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
   $this->Cmps_ord_def['COD_SITUACAO'] = " desc";
   $this->Cmps_ord_def['PEDIDO_FORNEC'] = " asc";
   $this->Cmps_ord_def['VL_NEGOCIADO'] = " desc";
   $this->Cmps_ord_def['QT_COMPRADA'] = " desc";
   $this->Cmps_ord_def['QT_CONFIRMADA_EMBARQUE'] = " desc";
   $this->Cmps_ord_def['QT_RECBTO_FISICO'] = " desc";
   $this->Cmps_ord_def['QT_REC_FINAL'] = " desc";
   $this->Cmps_ord_def['VL_REC_FINAL'] = " desc";
   $this->Cmps_ord_def['QT_COMPRADA_FINAL'] = " desc";
   $this->Cmps_ord_def['VL_COMPRADA_FINAL'] = " desc";
   $this->Cmps_ord_def['NR_CONTAINER'] = " asc";
   $this->Cmps_ord_def['SITUACAO_CONTAINER'] = " desc";
   $this->Cmps_ord_def['DT_REGISTRO'] = " desc";
   $this->Cmps_ord_def['DT_RECEBIMENTO'] = " desc";
   $this->Cmps_ord_def['DT_PREV_CHEGADA'] = " desc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo'])) 
   { 
       $this->Proc_link_res            = true;
       $this->nmgp_botoes['filter']    = 'off';
       $this->nmgp_botoes['groupby']   = 'off';
       $this->nmgp_botoes['dynsearch'] = 'off';
       $this->nmgp_botoes['qsearch']   = 'off';
       $this->nmgp_botoes['gridsave']  = 'off';
   } 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->dt_ini_registro = (isset($Busca_temp['dt_ini_registro'])) ? $Busca_temp['dt_ini_registro'] : ""; 
       $tmp_pos = (is_string($this->dt_ini_registro)) ? strpos($this->dt_ini_registro, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_ini_registro))
       {
           $this->dt_ini_registro = substr($this->dt_ini_registro, 0, $tmp_pos);
       }
       $this->dt_fim_registro = (isset($Busca_temp['dt_fim_registro'])) ? $Busca_temp['dt_fim_registro'] : ""; 
       $tmp_pos = (is_string($this->dt_fim_registro)) ? strpos($this->dt_fim_registro, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_fim_registro))
       {
           $this->dt_fim_registro = substr($this->dt_fim_registro, 0, $tmp_pos);
       }
       $this->dt_ini_prev_recbto = (isset($Busca_temp['dt_ini_prev_recbto'])) ? $Busca_temp['dt_ini_prev_recbto'] : ""; 
       $tmp_pos = (is_string($this->dt_ini_prev_recbto)) ? strpos($this->dt_ini_prev_recbto, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_ini_prev_recbto))
       {
           $this->dt_ini_prev_recbto = substr($this->dt_ini_prev_recbto, 0, $tmp_pos);
       }
       $this->dt_fim_prev_recbto = (isset($Busca_temp['dt_fim_prev_recbto'])) ? $Busca_temp['dt_fim_prev_recbto'] : ""; 
       $tmp_pos = (is_string($this->dt_fim_prev_recbto)) ? strpos($this->dt_fim_prev_recbto, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_fim_prev_recbto))
       {
           $this->dt_fim_prev_recbto = substr($this->dt_fim_prev_recbto, 0, $tmp_pos);
       }
       $this->dt_ini_recebimento = (isset($Busca_temp['dt_ini_recebimento'])) ? $Busca_temp['dt_ini_recebimento'] : ""; 
       $tmp_pos = (is_string($this->dt_ini_recebimento)) ? strpos($this->dt_ini_recebimento, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_ini_recebimento))
       {
           $this->dt_ini_recebimento = substr($this->dt_ini_recebimento, 0, $tmp_pos);
       }
       $this->dt_fim_recebimento = (isset($Busca_temp['dt_fim_recebimento'])) ? $Busca_temp['dt_fim_recebimento'] : ""; 
       $tmp_pos = (is_string($this->dt_fim_recebimento)) ? strpos($this->dt_fim_recebimento, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_fim_recebimento))
       {
           $this->dt_fim_recebimento = substr($this->dt_fim_recebimento, 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "muda_qt_linhas";
   } 
       ob_start(); 
   $_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
if (!isset($_SESSION['cond_container'])) {$_SESSION['cond_container'] = "";}
if (!isset($this->sc_temp_cond_container)) {$this->sc_temp_cond_container = (isset($_SESSION['cond_container'])) ? $_SESSION['cond_container'] : "";}
if (!isset($_SESSION['cond_pedido'])) {$_SESSION['cond_pedido'] = "";}
if (!isset($this->sc_temp_cond_pedido)) {$this->sc_temp_cond_pedido = (isset($_SESSION['cond_pedido'])) ? $_SESSION['cond_pedido'] : "";}
  $this->sc_temp_cond_pedido 		= '';
$this->sc_temp_cond_container 	= '';



$this->dt_ini_registro  = $this->limparVar($this->dt_ini_registro ,'_,--');
$this->dt_fim_registro  = $this->limparVar($this->dt_fim_registro ,'_,--');

$this->dt_ini_recebimento  = $this->limparVar($this->dt_ini_recebimento ,'_,--');
$this->dt_fim_recebimento  = $this->limparVar($this->dt_fim_recebimento ,'_,--');

$this->dt_ini_prev_recbto  = $this->limparVar($this->dt_ini_prev_recbto ,'_,--');
$this->dt_fim_prev_recbto  = $this->limparVar($this->dt_fim_prev_recbto ,'_,--');



$condPedido    = '';
$condContainer = '';



if($this->dt_ini_registro  <> ''){	
	$condAtu    = " dt_registro >= '$this->dt_ini_registro' and dt_registro <= '$this->dt_fim_registro'  ";
	$condPedido = $this->util_incr_valor($condPedido, $condAtu," and ");
	$condContainer = $this->util_incr_valor($condContainer, $condAtu," and ");
	
	
}

if($this->dt_ini_recebimento  <> ''){	
	$condAtu 		= " dt_recebimento >= '$this->dt_ini_recebimento' and dt_recebimento <= '$this->dt_fim_recebimento'  ";
	$condPedido 	= $this->util_incr_valor($condPedido," 1=0 "," and ");		
	$condContainer  = $this->util_incr_valor($condContainer, $condAtu," and ");	
}

if($this->dt_ini_prev_recbto  <> ''){			
 $qtDiasCalc =  $this->getQtDiasCalcPrevChegadaPedImp();	
 $condPedido 	= $this->util_incr_valor($condPedido," ((dt_termino_producao + $qtDiasCalc >= '$this->dt_ini_prev_recbto'
	 and dt_termino_producao <= '$this->dt_fim_prev_recbto') or (dt_prev_termino_producao  + $qtDiasCalc >= '$this->dt_ini_prev_recbto'
	 and dt_prev_termino_producao <= '$this->dt_fim_prev_recbto') )" ," and ");		
	$condAtu        = " \"dt-prev-chegada\" >= '$this->dt_ini_prev_recbto' and \"dt-prev-chegada\" <= '$this->dt_fim_prev_recbto'  ";
	$condContainer  = $this->util_incr_valor($condContainer, $condAtu," and ");		
	
}

$this->sc_temp_cond_pedido 		= " and $condPedido";
$this->sc_temp_cond_container 	= " and $condContainer";

if (isset($this->sc_temp_cond_pedido)) {$_SESSION['cond_pedido'] = $this->sc_temp_cond_pedido;}
if (isset($this->sc_temp_cond_container)) {$_SESSION['cond_container'] = $this->sc_temp_cond_container;}
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_item_qt_imp_union'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_item_qt_imp_union'];

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
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "cons_item_qt_imp_union/cons_item_qt_imp_union_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "cons_item_qt_imp_union_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new cons_item_qt_imp_union_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] = 100;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'] = array(); 
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_sql'] as $cmp_var => $resto)
           {
               foreach ($resto as $SC_Sql_col => $SC_Sql_order)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'][$cmp_var][$SC_Sql_col] = $SC_Sql_order;
               }
           }
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra']['desc_item_fornec']["DESC_ITEM_FORNEC"] = "asc"; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra']['codigo_erp']["CODIGO_ERP"] = "asc"; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   $this->sum_qt_rec_final = 0;
   $this->sum_vl_rec_final = 0;
   $this->sum_qt_comprada_final = 0;
   $this->sum_vl_comprada_final = 0;
   $this->arg_sum_desc_item_fornec = "";
   $this->count_desc_item_fornec = 0;
   $this->sum_desc_item_fornec_qt_rec_final = 0;
   $this->sum_desc_item_fornec_vl_rec_final = 0;
   $this->sum_desc_item_fornec_qt_comprada_final = 0;
   $this->sum_desc_item_fornec_vl_comprada_final = 0;
   $this->arg_sum_codigo_erp = "";
   $this->count_codigo_erp = 0;
   $this->sum_codigo_erp_qt_rec_final = 0;
   $this->sum_codigo_erp_vl_rec_final = 0;
   $this->sum_codigo_erp_qt_comprada_final = 0;
   $this->sum_codigo_erp_vl_comprada_final = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] ;  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['contr_array_resumo'] = "NAO";
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1];
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo'])) 
   { 
       $nmgp_select = "SELECT count(*) AS countTest from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
       $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq']; 
       if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'])) 
       { 
           $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo']; 
       } 
       else
       { 
           $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo'] . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $rt_grid = $this->Db->Execute($nmgp_select) ; 
       if ($rt_grid === false && !$rt_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit ; 
       }  
       $this->count_ger = $rt_grid->fields[0];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] = $rt_grid->fields[0];  
       
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'];
   }
//----- 
    if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, str_replace (convert(char(10),DT_REGISTRO,102), '.', '-') + ' ' + convert(char(8),DT_REGISTRO,20), str_replace (convert(char(10),DT_RECEBIMENTO,102), '.', '-') + ' ' + convert(char(8),DT_RECEBIMENTO,20), str_replace (convert(char(10),DT_PREV_CHEGADA,102), '.', '-') + ' ' + convert(char(8),DT_PREV_CHEGADA,20), CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, DT_REGISTRO, DT_RECEBIMENTO, DT_PREV_CHEGADA, CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, convert(char(23),DT_REGISTRO,121), convert(char(23),DT_RECEBIMENTO,121), convert(char(23),DT_PREV_CHEGADA,121), CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, DT_REGISTRO, DT_RECEBIMENTO, DT_PREV_CHEGADA, CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, EXTEND(DT_REGISTRO, YEAR TO DAY), EXTEND(DT_RECEBIMENTO, YEAR TO DAY), EXTEND(DT_PREV_CHEGADA, YEAR TO DAY), CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
   else 
   { 
       $nmgp_select = "SELECT COD_SITUACAO, PEDIDO_FORNEC, VL_NEGOCIADO, QT_COMPRADA, QT_CONFIRMADA_EMBARQUE, QT_RECBTO_FISICO, QT_REC_FINAL, VL_REC_FINAL, QT_COMPRADA_FINAL, VL_COMPRADA_FINAL, NR_CONTAINER, SITUACAO_CONTAINER, DT_REGISTRO, DT_RECEBIMENTO, DT_PREV_CHEGADA, CODIGO_ERP, DESC_ITEM_FORNEC from (select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3  " . $_SESSION['cond_pedido'] . " union  select  item_imp.vl_negociado as vl_negociado,ped_imp.cod_situacao as cod_situacao, item_imp.codigo_erp as codigo_erp, item_imp.descricao as desc_item_fornec, ped_imp.cod_proc_fornec as pedido_fornec, item_imp.qt_comprada as qt_comprada, coalesce(item_container.qt_confirm_emb,0) as qt_confirmada_embarque, coalesce(item_container.QT_RECBTO_FISICO,0) as qt_recbto_fisico, case coalesce(item_container.QT_RECBTO_FISICO,0) when 0 then coalesce(item_container.qt_confirm_emb,0) else coalesce(item_container.QT_RECBTO_FISICO,0)  end as qt_rec_final, case coalesce(item_container.QT_RECBTO_FISICO,0) * item_imp.vl_negociado when 0 then coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else coalesce(item_container.QT_RECBTO_FISICO,0)  * item_imp.vl_negociado  end as vl_rec_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) else qt_comprada end as qt_comprada_final, case when item_imp.qt_comprada < coalesce(item_container.qt_recbto_fisico,0) then   coalesce(item_container.qt_recbto_fisico,0) * item_imp.vl_negociado when item_imp.qt_comprada < coalesce(item_container.qt_confirm_emb,0)   then   coalesce(item_container.qt_confirm_emb,0) * item_imp.vl_negociado else qt_comprada * item_imp.vl_negociado end as vl_comprada_final, coalesce(container.\"nr-container\",'N�o Alocado') as nr_container, coalesce(container.situacao_container_id,100) as situacao_container, ped_imp.dt_registro as dt_registro, container.\"dt-recebimento\" as dt_recebimento, coalesce(container.\"dt-prev-chegada\",item_imp.dt_maxima_producao + 30 ) as dt_prev_chegada from pub.itens_proc_compra item_imp left outer join pub.procs_compra ped_imp on item_imp.proc_compra_id = ped_imp.proc_compra_id left outer join pub.itens_container item_container on item_container.item_proc_compra_id = item_imp.item_proc_compra_id left outer join pub.\"pp-container\" container on container.\"nr-container\" = item_container.container_id where ped_imp.cod_situacao <> 3 " . $_SESSION['cond_container'] . ") nm_sel_esp"; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq']; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo'])) 
   { 
       if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'])) 
       { 
           $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo']; 
       } 
       else
       { 
           $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_resumo'] . ")"; 
       } 
   } 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->cod_situacao = $this->rs_grid->fields[0] ;  
       $this->cod_situacao = (string)$this->cod_situacao;
       $this->pedido_fornec = $this->rs_grid->fields[1] ;  
       $this->vl_negociado = $this->rs_grid->fields[2] ;  
       $this->vl_negociado =  str_replace(",", ".", $this->vl_negociado);
       $this->vl_negociado = (string)$this->vl_negociado;
       $this->qt_comprada = $this->rs_grid->fields[3] ;  
       $this->qt_comprada =  str_replace(",", ".", $this->qt_comprada);
       $this->qt_comprada = (string)$this->qt_comprada;
       $this->qt_confirmada_embarque = $this->rs_grid->fields[4] ;  
       $this->qt_confirmada_embarque = (string)$this->qt_confirmada_embarque;
       $this->qt_recbto_fisico = $this->rs_grid->fields[5] ;  
       $this->qt_recbto_fisico = (string)$this->qt_recbto_fisico;
       $this->qt_rec_final = $this->rs_grid->fields[6] ;  
       $this->qt_rec_final = (string)$this->qt_rec_final;
       $this->vl_rec_final = $this->rs_grid->fields[7] ;  
       $this->vl_rec_final =  str_replace(",", ".", $this->vl_rec_final);
       $this->vl_rec_final = (string)$this->vl_rec_final;
       $this->qt_comprada_final = $this->rs_grid->fields[8] ;  
       $this->qt_comprada_final = (string)$this->qt_comprada_final;
       $this->vl_comprada_final = $this->rs_grid->fields[9] ;  
       $this->vl_comprada_final =  str_replace(",", ".", $this->vl_comprada_final);
       $this->vl_comprada_final = (string)$this->vl_comprada_final;
       $this->nr_container = $this->rs_grid->fields[10] ;  
       $this->situacao_container = $this->rs_grid->fields[11] ;  
       $this->situacao_container = (string)$this->situacao_container;
       $this->dt_registro = $this->rs_grid->fields[12] ;  
       $this->dt_recebimento = $this->rs_grid->fields[13] ;  
       $this->dt_prev_chegada = $this->rs_grid->fields[14] ;  
       $this->codigo_erp = $this->rs_grid->fields[15] ;  
       $this->desc_item_fornec = $this->rs_grid->fields[16] ;  
       if (!isset($this->desc_item_fornec)) { $this->desc_item_fornec = ""; }
       if (!isset($this->codigo_erp)) { $this->codigo_erp = ""; }
       $GLOBALS["situacao_container"] = $this->rs_grid->fields[11] ;  
       $GLOBALS["situacao_container"] = (string)$GLOBALS["situacao_container"] ;
       $GLOBALS["codigo_erp"] = $this->rs_grid->fields[15] ;  
       $this->look_cod_situacao = $this->cod_situacao; 
       $this->Lookup->lookup_cod_situacao($this->look_cod_situacao); 
       $this->arg_sum_codigo_erp = " = " . $this->Db->qstr($this->codigo_erp);
       $this->arg_sum_desc_item_fornec = " = " . $this->Db->qstr($this->desc_item_fornec);
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by") 
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp] : $cmp;
               $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
               $Cmp_Old    = $cmp . '_Old';
               $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
               $this->$Cmp_Old = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
           }
           $sql_where = "";
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
               if (!empty($Format_tst))
               {
                   $tmp = $this->$cmp;
                   if (!empty($tmp))
                   {
                       $sql = $this->Ini->Get_sql_date_groupby($sql, $Format_tst);
                   }
               }
               $cmp_qb     = $this->$cmp;
               $tmp        = "arg_sum_" . $cmp;
               $sql_where .= (!empty($sql_where)) ? " and " : "";
               $sql_where .= $sql . $this->$tmp;
               $tmp        = "quebra_" . $cmp . "_sc_free_group_by";
               $this->$tmp($cmp_qb, $sql_where, $cmp);
           }
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
       {
           $this->desc_item_fornec_Old = $this->desc_item_fornec ; 
           $this->quebra_desc_item_fornec_q_item($this->desc_item_fornec) ; 
           $this->codigo_erp_Old = $this->codigo_erp ; 
           $this->quebra_codigo_erp_q_item($this->desc_item_fornec, $this->codigo_erp) ; 
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->cod_situacao = $this->rs_grid->fields[0] ;  
           $this->pedido_fornec = $this->rs_grid->fields[1] ;  
           $this->vl_negociado = $this->rs_grid->fields[2] ;  
           $this->qt_comprada = $this->rs_grid->fields[3] ;  
           $this->qt_confirmada_embarque = $this->rs_grid->fields[4] ;  
           $this->qt_recbto_fisico = $this->rs_grid->fields[5] ;  
           $this->qt_rec_final = $this->rs_grid->fields[6] ;  
           $this->vl_rec_final = $this->rs_grid->fields[7] ;  
           $this->qt_comprada_final = $this->rs_grid->fields[8] ;  
           $this->vl_comprada_final = $this->rs_grid->fields[9] ;  
           $this->nr_container = $this->rs_grid->fields[10] ;  
           $this->situacao_container = $this->rs_grid->fields[11] ;  
           $this->dt_registro = $this->rs_grid->fields[12] ;  
           $this->dt_recebimento = $this->rs_grid->fields[13] ;  
           $this->dt_prev_chegada = $this->rs_grid->fields[14] ;  
           $this->codigo_erp = $this->rs_grid->fields[15] ;  
           $this->desc_item_fornec = $this->rs_grid->fields[16] ;  
           if (!isset($this->desc_item_fornec)) { $this->desc_item_fornec = ""; }
           if (!isset($this->codigo_erp)) { $this->codigo_erp = ""; }
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_item_qt_imp_union']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['word_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_item_qt_imp_union']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['print_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Quantidades Compradas x Recebidas por Item :: PDF</TITLE>
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
                    <meta name="msapplication-TileColor" content="">
                    <meta name="msapplication-TileImage" content="">
                    <meta name="theme-color" content="">
                    <meta name="apple-mobile-web-app-status-bar-style" content="">
                    <link rel="shortcut icon" href=""><?php
           }
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/grp__NM__ico__NM__favicon-16x16.png">
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pivot_charts']) : 0;
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
               cons_item_qt_imp_union_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               cons_item_qt_imp_union_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               cons_item_qt_imp_union_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               cons_item_qt_imp_union_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               cons_item_qt_imp_union_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Quantidades Compradas x Recebidas por Item</TITLE>\r\n");
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
$nm_saida->saida("                        <meta name=\"msapplication-TileColor\" content=\"\" >\r\n");
$nm_saida->saida("                        <meta name=\"msapplication-TileImage\" content=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"theme-color\" content=\"\">\r\n");
$nm_saida->saida("                        <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"\">\r\n");
$nm_saida->saida("                        <link rel=\"shortcut icon\" href=\"\">\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/grp__NM__ico__NM__favicon-16x16.png\">\r\n");
       }
       $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'] && !$this->Ini->sc_export_ajax)
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_item_qt_imp_union_jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_item_qt_imp_union_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_item_qt_imp_union_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery-3.6.0.min.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data   = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'grid', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => true, 
                   'scrollUpPosition' => 'A', 
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/viewerjs/viewer.css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/viewerjs/viewer.js\"></script>\r\n");
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
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var applicationKeys = '';\r\n");
           $nm_saida->saida("     var hotkeyList = '';\r\n");
           $nm_saida->saida("     function execHotKey(e, h) {\r\n");
           $nm_saida->saida("         var hotkey_fired = false\r\n");
           $nm_saida->saida("         switch (true) {\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("         if (hotkey_fired) {\r\n");
           $nm_saida->saida("             e.preventDefault();\r\n");
           $nm_saida->saida("             return false;\r\n");
           $nm_saida->saida("         } else {\r\n");
           $nm_saida->saida("             return true;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys.inc.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys_setup.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/css/ui.dropdownchecklist.standalone.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/dropdown_check_list/js/ui.dropdownchecklist.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2-4.0.6/css/select2.min.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2-4.0.6/js/select2.full.min.js\"></script>\r\n");
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
           $nm_saida->saida("function actionBar_linkSubmit6(link_obj, apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor, confirm)\r\n");
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
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light-border.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/material.css\"></script>\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/translucent.css\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/popper.min.js\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/tippy-bundle.umd.min.js\"></script>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/bluebird.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida']) { 
           $nm_saida->saida("            <script>\r\n");
           $nm_saida->saida("                $(document).ready(function(){\r\n");
           $nm_saida->saida("                    bootstrapMobile();\r\n");
           $nm_saida->saida("                });\r\n");
           $nm_saida->saida("            </script>\r\n");
           }
           $nm_saida->saida("   <style type=\"text/css\"> \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->Ini->Label_sort_asc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->arr_buttons['bgraf']['image'] . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont img[src\$='" . $this->arr_buttons['bconf_graf']['image'] . "']{opacity:1!important;} \r\n");
           $nm_saida->saida("     .scGridLabelFont img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida("     .scGridLabelFont:HOVER img{opacity:1;transition:all .2s;} \r\n");
           $nm_saida->saida("   </style> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid']) . ";\r\n");
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
           $nm_saida->saida("        let cells = $(\".sc-ui-grid-header-row-cons_item_qt_imp_union-1\").find(\"td\");\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    function scSetFixedHeadersCss(baseTop)\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let rows, cols, i, j, thisTop;\r\n");
           $nm_saida->saida("        rows = $(\".sc-ui-grid-header-row-cons_item_qt_imp_union-1\");\r\n");
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
           $nm_saida->saida("   var gridHeaders = $(\".sc-ui-grid-header-row-cons_item_qt_imp_union-1\"), headerDisplayed = true;\r\n");
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
           $nm_saida->saida("   tableOriginal = document.getElementById(\"sc-ui-grid-body-31a20064\");\r\n");
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
           $nm_saida->saida("  function SC_init_jquery(isScrollNav){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     NM_btn_disable();\r\n");
           $nm_saida->saida("    $(\"#fast_search_f0_top\").select2({\r\n");
           $nm_saida->saida("        containerCssClass: 'scGridQuickSearchDivResult',\r\n");
           $nm_saida->saida("        dropdownCssClass: 'scGridQuickSearchDivDropdown',\r\n");
           $nm_saida->saida("        placeholder: '" . $this->Ini->Nm_lang['lang_srch_all_fields'] . "',\r\n");
           $nm_saida->saida("    });\r\n");
           $nm_saida->saida("    $(\"#cond_fast_search_f0_top\").select2({\r\n");
           $nm_saida->saida("        containerCssClass: 'scGridQuickSearchDivResult',\r\n");
           $nm_saida->saida("        dropdownCssClass: 'scGridQuickSearchDivDropdown',\r\n");
           $nm_saida->saida("        minimumResultsForSearch: -1\r\n");
           $nm_saida->saida("    });\r\n");
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
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery(false);\r\n");
           $nm_saida->saida("   \$(window).on('load', function() {\r\n");
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ancor_save']);
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
       $nm_saida->saida("	background-color: #dbeafe;\r\n");
       $nm_saida->saida("	color: #1e40af;\r\n");
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
       $nm_saida->saida("	background-color: #f3f4f6;\r\n");
       $nm_saida->saida("	color: #1f2937;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-green {\r\n");
       $nm_saida->saida("	background-color: #dcfce7;\r\n");
       $nm_saida->saida("	color: #166534;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-orange {\r\n");
       $nm_saida->saida("	background-color: #ffe5b4;\r\n");
       $nm_saida->saida("	color: #ff8c00;\r\n");
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
       $nm_saida->saida("	background-color: #fee2e2;\r\n");
       $nm_saida->saida("	color: #991b1b;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".sc-b-yellow {\r\n");
       $nm_saida->saida("	background-color: #fef9c3;\r\n");
       $nm_saida->saida("	color: #854d0e;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word']) {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6.2/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
       }
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_item_qt_imp_union_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
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
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
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
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_item_qt_imp_union_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_cons_item_qt_imp_union_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert'])
  {
   $nm_saida->saida("      thead { display: table-header-group !important; }\r\n");
   $nm_saida->saida("      tfoot { display: table-row-group !important; }\r\n");
   $nm_saida->saida("      table td, table tr, td, tr, table { page-break-inside: avoid !important; }\r\n");
   $nm_saida->saida("      #summary_body > td { padding: 0px !important; }\r\n");
  }
           $nm_saida->saida("  </style>\r\n");
       }
       if (!empty($this->SC_Buf_onInit))
       { 
       $nm_saida->saida("" . $this->SC_Buf_onInit . "\r\n");
       } 
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".cons_item_qt_imp_union_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .cons_item_qt_imp_union_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".cons_item_qt_imp_union_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['css_body_embutida'] : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . $this->css_body_embutida . "\">\r\n");
           $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $this->Tab_width . ">\r\n");
           $nm_saida->saida("     <TR>\r\n");
           $nm_saida->saida("       <TD>\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $nm_saida->saida("       </TD>\r\n");
           $nm_saida->saida("     </TR>\r\n");
           $nm_saida->saida("   </TABLE>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery-3.6.0.min.js\"></script>\r\n");
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
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
          $vertical_center = 'display: flex; flex-direction: column; justify-content: flex-start; margin: 0px; min-height: 100vh;';
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $vertical_center . $css_body . $this->css_body_embutida . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'])
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . "Resumo Qt Compra x Recebida por Item" . "</H1></div>\r\n");
               } 
               else
               {
                   $groupByLabel = sprintf("Descr. Item Fornec.", "DESC_ITEM_FORNEC");
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">{$groupByLabel}</H1></div>\r\n");
               } 
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item")
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'])
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . "Resumo Qt Compra x Recebida por Item" . "</H1></div>\r\n");
               } 
               else
               {
                   $groupByLabel = sprintf("Descr. Item Fornec.", "DESC_ITEM_FORNEC");
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">{$groupByLabel}</H1></div>\r\n");
               } 
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['pdf_res'])
       {
           return;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_item_qt_imp_union']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_item_qt_imp_union']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_item_qt_imp_union']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_item_qt_imp_union']) . "_";
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
   $this->css_inherit_bg           = "scInheritBg";

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida']) ? "cons_item_qt_imp_union_" : "";
   $this->css_sep = " ";
   $this->css_cod_situacao_label = $compl_css_emb . "css_cod_situacao_label";
   $this->css_cod_situacao_grid_line = $compl_css_emb . "css_cod_situacao_grid_line";
   $this->css_pedido_fornec_label = $compl_css_emb . "css_pedido_fornec_label";
   $this->css_pedido_fornec_grid_line = $compl_css_emb . "css_pedido_fornec_grid_line";
   $this->css_vl_negociado_label = $compl_css_emb . "css_vl_negociado_label";
   $this->css_vl_negociado_grid_line = $compl_css_emb . "css_vl_negociado_grid_line";
   $this->css_qt_comprada_label = $compl_css_emb . "css_qt_comprada_label";
   $this->css_qt_comprada_grid_line = $compl_css_emb . "css_qt_comprada_grid_line";
   $this->css_qt_confirmada_embarque_label = $compl_css_emb . "css_qt_confirmada_embarque_label";
   $this->css_qt_confirmada_embarque_grid_line = $compl_css_emb . "css_qt_confirmada_embarque_grid_line";
   $this->css_qt_recbto_fisico_label = $compl_css_emb . "css_qt_recbto_fisico_label";
   $this->css_qt_recbto_fisico_grid_line = $compl_css_emb . "css_qt_recbto_fisico_grid_line";
   $this->css_qt_rec_final_label = $compl_css_emb . "css_qt_rec_final_label";
   $this->css_qt_rec_final_grid_line = $compl_css_emb . "css_qt_rec_final_grid_line";
   $this->css_vl_rec_final_label = $compl_css_emb . "css_vl_rec_final_label";
   $this->css_vl_rec_final_grid_line = $compl_css_emb . "css_vl_rec_final_grid_line";
   $this->css_qt_comprada_final_label = $compl_css_emb . "css_qt_comprada_final_label";
   $this->css_qt_comprada_final_grid_line = $compl_css_emb . "css_qt_comprada_final_grid_line";
   $this->css_vl_comprada_final_label = $compl_css_emb . "css_vl_comprada_final_label";
   $this->css_vl_comprada_final_grid_line = $compl_css_emb . "css_vl_comprada_final_grid_line";
   $this->css_nr_container_label = $compl_css_emb . "css_nr_container_label";
   $this->css_nr_container_grid_line = $compl_css_emb . "css_nr_container_grid_line";
   $this->css_situacao_container_label = $compl_css_emb . "css_situacao_container_label";
   $this->css_situacao_container_grid_line = $compl_css_emb . "css_situacao_container_grid_line";
   $this->css_dt_registro_label = $compl_css_emb . "css_dt_registro_label";
   $this->css_dt_registro_grid_line = $compl_css_emb . "css_dt_registro_grid_line";
   $this->css_dt_recebimento_label = $compl_css_emb . "css_dt_recebimento_label";
   $this->css_dt_recebimento_grid_line = $compl_css_emb . "css_dt_recebimento_grid_line";
   $this->css_dt_prev_chegada_label = $compl_css_emb . "css_dt_prev_chegada_label";
   $this->css_dt_prev_chegada_grid_line = $compl_css_emb . "css_dt_prev_chegada_grid_line";
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], 0, $trab_pos);
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
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
   $sc_data_cab1 = $this->nm_data->FormataSaida("j/n/Y @?#?@�@?#?@s G:i:s");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Quantidades Compradas x Recebidas por Item - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_head', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida(" </TR>\r\n");
 }
// 
//----- 
 function cabecalho_mobile()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cond_pesq'], 0, $trab_pos);
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
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
   $sc_data_cab1 = $this->nm_data->FormataSaida("j/n/Y @?#?@�@?#?@s G:i:s");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Quantidades Compradas x Recebidas por Item - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_head', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
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
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_label'])
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
   $nm_saida->saida("    <TR id=\"tit_cons_item_qt_imp_union__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-cons_item_qt_imp_union-" . $tmp_header_row . "\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_prev_chegada_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $this->SC_label_rightActionBar();
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".cons_item_qt_imp_union_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .cons_item_qt_imp_union_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".cons_item_qt_imp_union_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cols_emb'] = count($Nm_temp) - 1;
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
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_cod_situacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['cod_situacao'])) ? $this->New_label['cod_situacao'] : "Situa��o";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_cod_situacao_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_cod_situacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('COD_SITUACAO');
        $fieldSortIcon = $this->scGetColumnOrderIcon('COD_SITUACAO', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_cod_situacao_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_cod_situacao_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('COD_SITUACAO')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_pedido_fornec()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pedido_fornec'])) ? $this->New_label['pedido_fornec'] : "Pedido Fornec.";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_pedido_fornec_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pedido_fornec_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $fieldSortRule = $this->scGetColumnOrderRule('PEDIDO_FORNEC');
        $fieldSortIcon = $this->scGetColumnOrderIcon('PEDIDO_FORNEC', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_pedido_fornec_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_pedido_fornec_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('PEDIDO_FORNEC')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_vl_negociado()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_negociado'])) ? $this->New_label['vl_negociado'] : "Vl. Negociado";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_negociado_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_negociado_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('VL_NEGOCIADO');
        $fieldSortIcon = $this->scGetColumnOrderIcon('VL_NEGOCIADO', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_negociado_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_negociado_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('VL_NEGOCIADO')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_qt_comprada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['qt_comprada'])) ? $this->New_label['qt_comprada'] : "Qt.Comprada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_qt_comprada_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_qt_comprada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('QT_COMPRADA');
        $fieldSortIcon = $this->scGetColumnOrderIcon('QT_COMPRADA', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_qt_comprada_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_qt_comprada_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('QT_COMPRADA')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_qt_confirmada_embarque()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['qt_confirmada_embarque'])) ? $this->New_label['qt_confirmada_embarque'] : "Qt.Confirmada Embarque";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_qt_confirmada_embarque_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_qt_confirmada_embarque_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('QT_CONFIRMADA_EMBARQUE');
        $fieldSortIcon = $this->scGetColumnOrderIcon('QT_CONFIRMADA_EMBARQUE', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_qt_confirmada_embarque_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_qt_confirmada_embarque_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('QT_CONFIRMADA_EMBARQUE')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_qt_recbto_fisico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['qt_recbto_fisico'])) ? $this->New_label['qt_recbto_fisico'] : "Qt. Recbto. F�sico";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_qt_recbto_fisico_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_qt_recbto_fisico_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('QT_RECBTO_FISICO');
        $fieldSortIcon = $this->scGetColumnOrderIcon('QT_RECBTO_FISICO', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_qt_recbto_fisico_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_qt_recbto_fisico_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('QT_RECBTO_FISICO')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_qt_rec_final()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['qt_rec_final'])) ? $this->New_label['qt_rec_final'] : "Qt.Recbto.Final";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_qt_rec_final_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_qt_rec_final_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('QT_REC_FINAL');
        $fieldSortIcon = $this->scGetColumnOrderIcon('QT_REC_FINAL', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_qt_rec_final_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_qt_rec_final_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('QT_REC_FINAL')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_vl_rec_final()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_rec_final'])) ? $this->New_label['vl_rec_final'] : "Vl.Recbto.Final";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_rec_final_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_rec_final_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('VL_REC_FINAL');
        $fieldSortIcon = $this->scGetColumnOrderIcon('VL_REC_FINAL', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_rec_final_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_rec_final_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('VL_REC_FINAL')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_qt_comprada_final()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['qt_comprada_final'])) ? $this->New_label['qt_comprada_final'] : "Qt.Comprada Final";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_qt_comprada_final_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_qt_comprada_final_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('QT_COMPRADA_FINAL');
        $fieldSortIcon = $this->scGetColumnOrderIcon('QT_COMPRADA_FINAL', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_qt_comprada_final_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_qt_comprada_final_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('QT_COMPRADA_FINAL')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_vl_comprada_final()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_comprada_final'])) ? $this->New_label['vl_comprada_final'] : "Vl. Comprada Final";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_comprada_final_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_comprada_final_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('VL_COMPRADA_FINAL');
        $fieldSortIcon = $this->scGetColumnOrderIcon('VL_COMPRADA_FINAL', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_comprada_final_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_comprada_final_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('VL_COMPRADA_FINAL')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_nr_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['nr_container'])) ? $this->New_label['nr_container'] : "NR CONTAINER";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_nr_container_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_nr_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $fieldSortRule = $this->scGetColumnOrderRule('NR_CONTAINER');
        $fieldSortIcon = $this->scGetColumnOrderIcon('NR_CONTAINER', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_nr_container_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_nr_container_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('NR_CONTAINER')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_situacao_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : "Situa��o Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_situacao_container_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_situacao_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('SITUACAO_CONTAINER');
        $fieldSortIcon = $this->scGetColumnOrderIcon('SITUACAO_CONTAINER', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_situacao_container_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_situacao_container_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('SITUACAO_CONTAINER')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_dt_registro()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_registro'])) ? $this->New_label['dt_registro'] : "Dt. Registro";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_registro_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_registro_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('DT_REGISTRO');
        $fieldSortIcon = $this->scGetColumnOrderIcon('DT_REGISTRO', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_dt_registro_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_dt_registro_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('DT_REGISTRO')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_dt_recebimento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_recebimento'])) ? $this->New_label['dt_recebimento'] : "Dt. Recbto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_recebimento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_recebimento_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('DT_RECEBIMENTO');
        $fieldSortIcon = $this->scGetColumnOrderIcon('DT_RECEBIMENTO', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_dt_recebimento_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_dt_recebimento_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('DT_RECEBIMENTO')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
 function NM_label_dt_prev_chegada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt. Prev. Chegada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_prev_chegada_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_prev_chegada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('DT_PREV_CHEGADA');
        $fieldSortIcon = $this->scGetColumnOrderIcon('DT_PREV_CHEGADA', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_dt_prev_chegada_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_dt_prev_chegada_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('DT_PREV_CHEGADA')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";
        // controls
        $label_chart = '';
        $label_fixedColumn = '';
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ordem_label'] == 'desc') {
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
            case "cod_situacao":
                return true;
            case "vl_negociado":
                return true;
            case "qt_comprada":
                return true;
            case "qt_confirmada_embarque":
                return true;
            case "qt_recbto_fisico":
                return true;
            case "qt_rec_final":
                return true;
            case "vl_rec_final":
                return true;
            case "qt_comprada_final":
                return true;
            case "vl_comprada_final":
                return true;
            case "situacao_container":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "cod_situacao":
                return 'desc';
            case "vl_negociado":
                return 'desc';
            case "qt_comprada":
                return 'desc';
            case "qt_confirmada_embarque":
                return 'desc';
            case "qt_recbto_fisico":
                return 'desc';
            case "qt_rec_final":
                return 'desc';
            case "vl_rec_final":
                return 'desc';
            case "qt_comprada_final":
                return 'desc';
            case "vl_comprada_final":
                return 'desc';
            case "situacao_container":
                return 'desc';
            case "dt_registro":
                return 'desc';
            case "dt_recebimento":
                return 'desc';
            case "dt_prev_chegada":
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['cod_situacao'])) ? $this->New_label['cod_situacao'] : "Situa��o";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['cod_situacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pedido_fornec'])) ? $this->New_label['pedido_fornec'] : "Pedido Fornec.";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['pedido_fornec'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_negociado'])) ? $this->New_label['vl_negociado'] : "Vl. Negociado";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['vl_negociado'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['qt_comprada'])) ? $this->New_label['qt_comprada'] : "Qt.Comprada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['qt_comprada'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['qt_confirmada_embarque'])) ? $this->New_label['qt_confirmada_embarque'] : "Qt.Confirmada Embarque";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['qt_confirmada_embarque'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['qt_recbto_fisico'])) ? $this->New_label['qt_recbto_fisico'] : "Qt. Recbto. F�sico";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['qt_recbto_fisico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['qt_rec_final'])) ? $this->New_label['qt_rec_final'] : "Qt.Recbto.Final";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['qt_rec_final'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_rec_final'])) ? $this->New_label['vl_rec_final'] : "Vl.Recbto.Final";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['vl_rec_final'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['qt_comprada_final'])) ? $this->New_label['qt_comprada_final'] : "Qt.Comprada Final";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['qt_comprada_final'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_comprada_final'])) ? $this->New_label['vl_comprada_final'] : "Vl. Comprada Final";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['vl_comprada_final'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['nr_container'])) ? $this->New_label['nr_container'] : "NR CONTAINER";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['nr_container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : "Situa��o Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['situacao_container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_registro'])) ? $this->New_label['dt_registro'] : "Dt. Registro";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['dt_registro'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_recebimento'])) ? $this->New_label['dt_recebimento'] : "Dt. Recbto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['dt_recebimento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt. Prev. Chegada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['labels']['dt_prev_chegada'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_item_qt_imp_union']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_cons_item_qt_imp_union#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-size:12px;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
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
           $nm_saida->saida(" <TR> \r\n");
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_cons_item_qt_imp_union#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       $nm_id_aplicacao = " id=\"apl_cons_item_qt_imp_union#?#1\"";
   } 
   $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf") ? "padding: 0px !important;" : "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\" width=\"100%\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) { 
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-31a20064\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cab_embutida'] != "S" )
      { 
          $this->label_grid($linhas);
      } 
   } 
   elseif (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) 
   { 
      $this->label_grid($linhas);
   } 
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] = 0;
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_")
   {
       $NM_prim_qb = true;
   }
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $this->Break_pag_pdf['sc_free_group_by']['desc_item_fornec'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['desc_item_fornec'] = "N";
   $this->Break_pag_pdf['sc_free_group_by']['codigo_erp'] = "N";
   $this->Break_pag_prt['sc_free_group_by']['codigo_erp'] = "N";
   $this->Break_pag_pdf['q_item']['desc_item_fornec'] = "N";
   $this->Break_pag_prt['q_item']['desc_item_fornec'] = "N";
   $this->Break_pag_pdf['q_item']['codigo_erp'] = "N";
   $this->Break_pag_prt['q_item']['codigo_erp'] = "N";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Config_Page_break_PDF'] = "S";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF'] = array();
       }
   }
   $this->SC_top       = array();
   $this->SC_bot       = array();
   $this->SC_bot[]     = "desc_item_fornec"; 
   $this->SC_top[]     = "desc_item_fornec"; 
   $this->SC_bot[]     = "codigo_erp"; 
   $this->SC_top[]     = "codigo_erp"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       $Nivel_gb = 1;
       $this->Tab_Nv_tree = array();
       $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']);
       $this->Ult_qb_free = $this->Nivel_gbBot;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
       {
           if (!isset($this->Prim_cmp_gb))
           {
               $this->Prim_cmp_gb = $cmp;
           }
           $this->Tab_Nv_tree[$cmp] = $Nivel_gb;
           $Nivel_gb++;
           if (in_array($cmp, $this->SC_top))
           {
               $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
               $this->$tmp($cmp);
           }
       }
       $this->nmgp_prim_pag_pdf = false;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
   {
       if (isset($this->desc_item_fornec))
       {
           $this->quebra_desc_item_fornec_q_item_top(); 
       }
       if (isset($this->codigo_erp))
       {
           $this->quebra_codigo_erp_q_item_top(); 
       }
       $this->nmgp_prim_pag_pdf = false;
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && !$this->Ini->sc_export_ajax)
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
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  cons_item_qt_imp_union_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->cod_situacao = $this->rs_grid->fields[0] ;  
          $this->cod_situacao = (string)$this->cod_situacao;
          $this->pedido_fornec = $this->rs_grid->fields[1] ;  
          $this->vl_negociado = $this->rs_grid->fields[2] ;  
          $this->vl_negociado =  str_replace(",", ".", $this->vl_negociado);
          $this->vl_negociado = (string)$this->vl_negociado;
          $this->qt_comprada = $this->rs_grid->fields[3] ;  
          $this->qt_comprada =  str_replace(",", ".", $this->qt_comprada);
          $this->qt_comprada = (string)$this->qt_comprada;
          $this->qt_confirmada_embarque = $this->rs_grid->fields[4] ;  
          $this->qt_confirmada_embarque = (string)$this->qt_confirmada_embarque;
          $this->qt_recbto_fisico = $this->rs_grid->fields[5] ;  
          $this->qt_recbto_fisico = (string)$this->qt_recbto_fisico;
          $this->qt_rec_final = $this->rs_grid->fields[6] ;  
          $this->qt_rec_final = (string)$this->qt_rec_final;
          $this->vl_rec_final = $this->rs_grid->fields[7] ;  
          $this->vl_rec_final =  str_replace(",", ".", $this->vl_rec_final);
          $this->vl_rec_final = (string)$this->vl_rec_final;
          $this->qt_comprada_final = $this->rs_grid->fields[8] ;  
          $this->qt_comprada_final = (string)$this->qt_comprada_final;
          $this->vl_comprada_final = $this->rs_grid->fields[9] ;  
          $this->vl_comprada_final =  str_replace(",", ".", $this->vl_comprada_final);
          $this->vl_comprada_final = (string)$this->vl_comprada_final;
          $this->nr_container = $this->rs_grid->fields[10] ;  
          $this->situacao_container = $this->rs_grid->fields[11] ;  
          $this->situacao_container = (string)$this->situacao_container;
          $this->dt_registro = $this->rs_grid->fields[12] ;  
          $this->dt_recebimento = $this->rs_grid->fields[13] ;  
          $this->dt_prev_chegada = $this->rs_grid->fields[14] ;  
          $this->codigo_erp = $this->rs_grid->fields[15] ;  
          $this->desc_item_fornec = $this->rs_grid->fields[16] ;  
          if (!isset($this->desc_item_fornec)) { $this->desc_item_fornec = ""; }
          if (!isset($this->codigo_erp)) { $this->codigo_erp = ""; }
          $GLOBALS["situacao_container"] = $this->rs_grid->fields[11] ;  
          $GLOBALS["situacao_container"] = (string)$GLOBALS["situacao_container"];
          $GLOBALS["codigo_erp"] = $this->rs_grid->fields[15] ;  
          $this->look_cod_situacao = $this->cod_situacao; 
          $this->Lookup->lookup_cod_situacao($this->look_cod_situacao); 
          $this->arg_sum_codigo_erp = " = " . $this->Db->qstr($this->codigo_erp);
          $this->arg_sum_desc_item_fornec = " = " . $this->Db->qstr($this->desc_item_fornec);
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by") 
          {  
              $SC_arg_Gby = array();
              $SC_arg_Sql = array();
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
              {
                  $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp] : $cmp;
                  $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                  $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                  $SC_arg_Gby[$cmp] = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
              }
              $SC_lst_Gby = array();
              $gb_ok      = false;
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                  $SC_arg_Sql[$cmp] = $sql;
                  $Fun_GB  = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp] : $cmp;
                  if (!empty($Format_tst))
                  {
                      $temp = $this->$cmp;
                      if (!empty($temp))
                      {
                          $SC_arg_Sql[$cmp] = $this->Ini->Get_sql_date_groupby($sql, $Format_tst);
                      }
                  }
                  $temp = $cmp . "_Old";
                  if ($SC_arg_Gby[$cmp] != $this->$temp || $gb_ok)
                  {
                      $SC_lst_Gby[] = $cmp;
                      $gb_ok = true;
                  }
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']);
              krsort ($SC_lst_Gby);
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_bot))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                      $this->$tmp($cmp);
                      $this->Nivel_gbBot--;
                  }
                  $sql_where = "";
                  $cmp_qb     = $this->$cmp;
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $Col_Gb => $Sql)
                  {
                      $tmp        = "arg_sum_" . $Col_Gb;
                      $sql_where .= (!empty($sql_where)) ? " and " : "";
                      $sql_where .= $SC_arg_Sql[$Col_Gb] . $this->$tmp;
                      if ($Col_Gb == $cmp)
                      {
                          break;
                      }
                  }
                  $tmp  = "quebra_" . $cmp . "_sc_free_group_by";
                  $this->$tmp($cmp_qb, $sql_where, $cmp);
              }
              if (!empty($SC_lst_Gby))
              {
                  $cmp = $SC_lst_Gby[0];
                  if ($this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && $this->Break_pag_prt[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby']][$cmp] == "S")
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
                  elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF'][$cmp] == "S")
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']);
              ksort ($SC_lst_Gby);
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_top))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
                      $this->$tmp($cmp);
                  }
              }
              if (!empty($SC_lst_Gby))
              {
                  $nm_houve_quebra = "S";
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
                  {
                      $Cmp_orig   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_orig'][$cmp] : $cmp;
                      $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp);
                      $Cmp_Old   = $cmp . '_Old';
                      $TP_Time = (in_array($Cmp_orig, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
                      $this->$Cmp_Old = $this->Ini->Get_arg_groupby($TP_Time . $this->$Cmp_orig, $Format_tst); 
                  }
              }
          }  
          if ($this->desc_item_fornec !== $this->desc_item_fornec_Old && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
          {  
              if (isset($this->codigo_erp_Old))
              {
                 $this->quebra_codigo_erp_q_item_bot() ; 
              }
              if (isset($this->desc_item_fornec_Old))
              {
                 $this->quebra_desc_item_fornec_q_item_bot() ; 
              }
              if ($this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && $this->Break_pag_prt[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby']]['desc_item_fornec'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF']['desc_item_fornec'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              $this->codigo_erp_Old = $this->codigo_erp ; 
              $this->quebra_codigo_erp_q_item($this->desc_item_fornec, $this->codigo_erp) ; 
              $this->desc_item_fornec_Old = $this->desc_item_fornec ; 
              $this->quebra_desc_item_fornec_q_item($this->desc_item_fornec) ; 
              if (isset($this->desc_item_fornec_Old))
              {
                 $this->quebra_desc_item_fornec_q_item_top() ; 
              }
              if (isset($this->codigo_erp_Old))
              {
                 $this->quebra_codigo_erp_q_item_top() ; 
              }
              $nm_houve_quebra = "S";
          } 
          if ($this->codigo_erp !== $this->codigo_erp_Old && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item") 
          {  
              if (isset($this->codigo_erp_Old))
              {
                 $this->quebra_codigo_erp_q_item_bot() ; 
              }
              if ($this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['doc_word'] && $this->Break_pag_prt[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby']]['codigo_erp'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Page_break_PDF']['codigo_erp'] == "S")
              {
                  $this->nm_quebra_pagina("pagina"); 
              }
              $this->codigo_erp_Old = $this->codigo_erp ; 
              $this->quebra_codigo_erp_q_item($this->desc_item_fornec, $this->codigo_erp) ; 
              if (isset($this->codigo_erp_Old))
              {
                 $this->quebra_codigo_erp_q_item_top() ; 
              }
              $nm_houve_quebra = "S";
          } 
          $this->sc_proc_grid = true;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              if (($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0) && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
              { 
                 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_") 
                 { } 
                 elseif ($this->pdf_label_group == "S") 
                 {
                     if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid']) {
                         $this->label_grid($linhas);
                     } 
                 } 
                 $nm_houve_quebra = "N";
             } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "dt_registro")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "dt_recebimento")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "dt_prev_chegada")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "dt_fim_prev_recbto")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
              if ($temp == "dt_fim_recebimento")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
              if ($temp == "dt_fim_registro")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
              if ($temp == "dt_ini_prev_recbto")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
              if ($temp == "dt_ini_recebimento")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
              if ($temp == "dt_ini_registro")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", ""));
                  } 
              }
          }
    $dataActionbarPos = 'left';
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"  style=\"page-break-inside: avoid;\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_dt_prev_chegada_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
   $this->SC_grid_rightActionBar();
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
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
   if (!$this->rs_grid->EOF) 
   { 
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $nm_saida->saida("    </TBODY>");
       }
   } 
   if ($this->rs_grid->EOF) 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by")
       {
           $SC_lst_Gby = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $SC_lst_Gby[] = $cmp;
           }
           $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']);
           krsort ($SC_lst_Gby);
           foreach ($SC_lst_Gby as $Ind => $cmp)
           {
               if (in_array($cmp, $this->SC_bot))
               {
                   $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                   $this->$tmp($cmp);
                   $this->Nivel_gbBot--;
               }
           }
       }
       if (isset($this->codigo_erp_Old) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item")
       {
           $this->quebra_codigo_erp_q_item_bot() ; 
       }
       if (isset($this->desc_item_fornec_Old) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "q_item")
       {
           $this->quebra_desc_item_fornec_q_item_bot() ; 
       }
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] . "_bot";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao']       = "igual" ; 
   } 
 }
function SC_grid_rightActionBar()
{
	global $nm_saida;
    $dataActionbarPos = 'right';
}
 function NM_grid_cod_situacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off") { 
          $conteudo = trim(NM_encode_input(sc_strip_script($this->look_cod_situacao))); 
          $conteudo_original = trim(NM_encode_input(sc_strip_script($this->look_cod_situacao))); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'cod_situacao', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'cod_situacao', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_cod_situacao_grid_line . "\"  style=\"" . $this->Css_Cmp['css_cod_situacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_cod_situacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pedido_fornec()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->pedido_fornec));
              $conteudo_original = NM_encode_input(sc_strip_script($this->pedido_fornec));
          }
          else {
              $conteudo = sc_strip_script($this->pedido_fornec); 
              $conteudo_original = sc_strip_script($this->pedido_fornec); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'pedido_fornec', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'pedido_fornec', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pedido_fornec_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pedido_fornec_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pedido_fornec_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_negociado()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_negociado)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_negociado)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'vl_negociado', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'vl_negociado', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_vl_negociado_grid_line . "\"  style=\"" . $this->Css_Cmp['css_vl_negociado_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_negociado_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_qt_comprada()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->qt_comprada)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->qt_comprada)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'qt_comprada', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'qt_comprada', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_qt_comprada_grid_line . "\"  style=\"" . $this->Css_Cmp['css_qt_comprada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_qt_comprada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_qt_confirmada_embarque()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->qt_confirmada_embarque)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->qt_confirmada_embarque)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'qt_confirmada_embarque', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'qt_confirmada_embarque', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_qt_confirmada_embarque_grid_line . "\"  style=\"" . $this->Css_Cmp['css_qt_confirmada_embarque_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_qt_confirmada_embarque_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_qt_recbto_fisico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->qt_recbto_fisico)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->qt_recbto_fisico)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'qt_recbto_fisico', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'qt_recbto_fisico', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_qt_recbto_fisico_grid_line . "\"  style=\"" . $this->Css_Cmp['css_qt_recbto_fisico_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_qt_recbto_fisico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_qt_rec_final()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->qt_rec_final)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->qt_rec_final)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'qt_rec_final', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'qt_rec_final', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_qt_rec_final_grid_line . "\"  style=\"" . $this->Css_Cmp['css_qt_rec_final_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_qt_rec_final_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_rec_final()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_rec_final)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_rec_final)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'vl_rec_final', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'vl_rec_final', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_vl_rec_final_grid_line . "\"  style=\"" . $this->Css_Cmp['css_vl_rec_final_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_rec_final_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_qt_comprada_final()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->qt_comprada_final)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->qt_comprada_final)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'qt_comprada_final', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'qt_comprada_final', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_qt_comprada_final_grid_line . "\"  style=\"" . $this->Css_Cmp['css_qt_comprada_final_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_qt_comprada_final_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_comprada_final()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_comprada_final)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_comprada_final)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'vl_comprada_final', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'vl_comprada_final', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_vl_comprada_final_grid_line . "\"  style=\"" . $this->Css_Cmp['css_vl_comprada_final_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_comprada_final_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_nr_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->nr_container));
              $conteudo_original = NM_encode_input(sc_strip_script($this->nr_container));
          }
          else {
              $conteudo = sc_strip_script($this->nr_container); 
              $conteudo_original = sc_strip_script($this->nr_container); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'nr_container', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'nr_container', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_nr_container_grid_line . "\"  style=\"" . $this->Css_Cmp['css_nr_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_nr_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_situacao_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->situacao_container)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->situacao_container)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_situacao_container($conteudo , $this->situacao_container) ; 
          $str_tem_display = $conteudo;
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'situacao_container', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'situacao_container', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_situacao_container_grid_line . "\"  style=\"" . $this->Css_Cmp['css_situacao_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_situacao_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_registro()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_registro)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_registro)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'dt_registro', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'dt_registro', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_dt_registro_grid_line . "\"  style=\"" . $this->Css_Cmp['css_dt_registro_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_registro_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_recebimento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_recebimento)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_recebimento)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'dt_recebimento', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'dt_recebimento', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_dt_recebimento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_dt_recebimento_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_recebimento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_prev_chegada()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_prev_chegada)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_prev_chegada)); 
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
          if(!empty($str_tem_display) && $str_tem_display != '&nbsp;' && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && !empty($conteudo)) 
          { 
              $str_tem_display = $this->getFieldHighlight('quicksearch', 'dt_prev_chegada', $str_tem_display, $conteudo_original); 
              $str_tem_display = $this->getFieldHighlight('advanced_search', 'dt_prev_chegada', $str_tem_display, $conteudo_original); 
          } 
              $conteudo = $str_tem_display; 
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_dt_prev_chegada_grid_line . "\"  style=\"" . $this->Css_Cmp['css_dt_prev_chegada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_prev_chegada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 15;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
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
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['print_navigator'] == "Netscape")
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
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\" width=\"100%\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'])
        {
            $this->nm_inicio_pag = 0;
        }
    }
 }
 function quebra_desc_item_fornec_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_codigo_erp = false;
   $this->sc_proc_quebra_desc_item_fornec = true; 
   $this->Tot->quebra_desc_item_fornec_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_desc_item_fornec = $$Var_name_gb;
   $conteudo = $tot_desc_item_fornec[0] ;  
   $this->count_desc_item_fornec = $tot_desc_item_fornec[1];
   $this->sum_desc_item_fornec_qt_rec_final = $tot_desc_item_fornec[2];
   $this->sum_desc_item_fornec_vl_rec_final = $tot_desc_item_fornec[3];
   $this->sum_desc_item_fornec_qt_comprada_final = $tot_desc_item_fornec[4];
   $this->sum_desc_item_fornec_vl_comprada_final = $tot_desc_item_fornec[5];
   $Temp_cmp_quebra = array(); 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = NM_encode_input(sc_strip_script($this->desc_item_fornec)); 
   }
   else {
       $conteudo = sc_strip_script($this->desc_item_fornec); 
   }
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['desc_item_fornec']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['desc_item_fornec']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "Descr. Item Fornec."; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_desc_item_fornec = false; 
 } 
 function quebra_codigo_erp_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global $$Var_name_gb, $Desc_Gb_Ant;
   $this->sc_proc_quebra_desc_item_fornec = false;
   $this->sc_proc_quebra_codigo_erp = true; 
   $this->Tot->quebra_codigo_erp_sc_free_group_by($Cmp_qb, $Where_qb, $Cmp_Name);
   $tot_codigo_erp = $$Var_name_gb;
   $conteudo = $tot_codigo_erp[0] ;  
   $this->count_codigo_erp = $tot_codigo_erp[1];
   $this->sum_codigo_erp_qt_rec_final = $tot_codigo_erp[2];
   $this->sum_codigo_erp_vl_rec_final = $tot_codigo_erp[3];
   $this->sum_codigo_erp_qt_comprada_final = $tot_codigo_erp[4];
   $this->sum_codigo_erp_vl_comprada_final = $tot_codigo_erp[5];
   $Temp_cmp_quebra = array(); 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = NM_encode_input(sc_strip_script($this->codigo_erp)); 
   }
   else {
       $conteudo = sc_strip_script($this->codigo_erp); 
   }
   $this->Lookup->lookup_sc_free_group_by_codigo_erp($conteudo , $this->codigo_erp) ; 
   $Temp_cmp_quebra[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['codigo_erp']))
   {
       $Temp_cmp_quebra[0]['lab'] = $this->nmgp_label_quebras['codigo_erp']; 
   }
   else
   {
       $Temp_cmp_quebra[0]['lab'] = "C�digo ERP"; 
   }
   $this->$Cmps_Gb_Free = $Temp_cmp_quebra;
   $this->sc_proc_quebra_codigo_erp = false; 
 } 
 function quebra_desc_item_fornec_q_item($desc_item_fornec) 
 {
   global $tot_desc_item_fornec;
   $this->sc_proc_quebra_codigo_erp = false;
   $this->sc_proc_quebra_desc_item_fornec = true; 
   $this->Tot->quebra_desc_item_fornec_q_item($desc_item_fornec, $this->arg_sum_desc_item_fornec);
   $conteudo = $tot_desc_item_fornec[0] ;  
   $this->count_desc_item_fornec = $tot_desc_item_fornec[1];
   $this->sum_desc_item_fornec_qt_rec_final = $tot_desc_item_fornec[2];
   $this->sum_desc_item_fornec_vl_rec_final = $tot_desc_item_fornec[3];
   $this->sum_desc_item_fornec_qt_comprada_final = $tot_desc_item_fornec[4];
   $this->sum_desc_item_fornec_vl_comprada_final = $tot_desc_item_fornec[5];
   $this->campos_quebra_desc_item_fornec = array(); 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = NM_encode_input(sc_strip_script($this->desc_item_fornec)); 
   }
   else {
       $conteudo = sc_strip_script($this->desc_item_fornec); 
   }
   $this->campos_quebra_desc_item_fornec[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['desc_item_fornec']))
   {
       $this->campos_quebra_desc_item_fornec[0]['lab'] = $this->nmgp_label_quebras['desc_item_fornec']; 
   }
   else
   {
   $this->campos_quebra_desc_item_fornec[0]['lab'] = "Descr. Item Fornec."; 
   }
   $this->sc_proc_quebra_desc_item_fornec = false; 
 } 
 function quebra_codigo_erp_q_item($desc_item_fornec, $codigo_erp) 
 {
   global $tot_codigo_erp;
   $this->sc_proc_quebra_desc_item_fornec = false;
   $this->sc_proc_quebra_codigo_erp = true; 
   $this->Tot->quebra_codigo_erp_q_item($desc_item_fornec, $codigo_erp, $this->arg_sum_desc_item_fornec, $this->arg_sum_codigo_erp);
   $conteudo = $tot_codigo_erp[0] ;  
   $this->count_codigo_erp = $tot_codigo_erp[1];
   $this->sum_codigo_erp_qt_rec_final = $tot_codigo_erp[2];
   $this->sum_codigo_erp_vl_rec_final = $tot_codigo_erp[3];
   $this->sum_codigo_erp_qt_comprada_final = $tot_codigo_erp[4];
   $this->sum_codigo_erp_vl_comprada_final = $tot_codigo_erp[5];
   $this->campos_quebra_codigo_erp = array(); 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
       $conteudo = NM_encode_input(sc_strip_script($this->codigo_erp)); 
   }
   else {
       $conteudo = sc_strip_script($this->codigo_erp); 
   }
   $this->Lookup->lookup_q_item_codigo_erp($conteudo , $this->codigo_erp) ; 
   $this->campos_quebra_codigo_erp[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['codigo_erp']))
   {
       $this->campos_quebra_codigo_erp[0]['lab'] = $this->nmgp_label_quebras['codigo_erp']; 
   }
   else
   {
   $this->campos_quebra_codigo_erp[0]['lab'] = "C�digo ERP"; 
   }
   $this->sc_proc_quebra_codigo_erp = false; 
 } 
 function quebra_desc_item_fornec_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_desc_item_fornec = $$Var_name_gb;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_desc_item_fornec = 0; 
   $cont_quebra_desc_item_fornec++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $link_div   = "";
   $link_div_2 = "";
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $link_div  = "<table style=\"border-collapse: collapse\"><tr>";
       $link_div .= "<td style=\"padding: 0px\"><span align=\"left\">";
       $link_div .= "<img id=\"b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
       $link_div .= "<img id=\"b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
       $link_div .= "</span></td><td  class=\"scGridBlockFont\">";
       $link_div_2 = "</td></tr></table>";
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $this->NM_tbody_open = false;
           $nm_saida->saida("    </TBODY>");
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['desc_item_fornec']] = 'top';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
   }
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H2 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H2></div>";
   }
   $conteudo = $tot_desc_item_fornec[0] ;  
    $thisColspan = 2;
   $colspan = $this->NM_colspan;
   $this->Label_desc_item_fornec = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_desc_item_fornec .= "<tr>"; 
       $this->Label_desc_item_fornec .= "<td>" . $cada_campo['lab'] . "</td><td>:</td>";
       $this->Label_desc_item_fornec .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_desc_item_fornec .= "</tr>"; 
   } 
   $this->Label_desc_item_fornec .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . " align=\"\">\r\n");
   $nm_saida->saida("       " . $link_div . "\r\n");
   $nm_saida->saida("        " . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_desc_item_fornec . $nm_fecha_pdf_old . "\r\n");
   $nm_saida->saida("       " . $link_div_2 . "\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $nm_saida->saida("    </TBODY>");
       if ($this->Ult_qb_free == $this->Tab_Nv_tree['desc_item_fornec'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
           $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['desc_item_fornec']] = 'bot';
           $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
           $this->NM_tbody_open = true;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_desc_item_fornec_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_desc_item_fornec = $$Var_name_gb;
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   if ($this->Ult_qb_free != $this->Tab_Nv_tree['desc_item_fornec'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = true;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['desc_item_fornec']] = 'bot';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   $prim_lin_tit = true;
   $tit_lin_sumariza = "";
   $tit_lin_sumariza_orig = $tit_lin_sumariza;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
      $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
   $tit_lin_sumariza = "<font color='" . $this->NM_bg_sub_tot . "'>" . $tit_lin_sumariza_orig . "</font>";
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = false;
       $nm_saida->saida("    </TBODY>");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_codigo_erp_sc_free_group_by_top($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_codigo_erp = $$Var_name_gb;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
   static $cont_quebra_codigo_erp = 0; 
   $cont_quebra_codigo_erp++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $link_div   = "";
   $link_div_2 = "";
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $link_div  = "<table style=\"border-collapse: collapse\"><tr>";
       $link_div .= "<td style=\"padding: 0px\"><span align=\"left\">";
       $link_div .= "&nbsp;<img id=\"b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
       $link_div .= "<img id=\"b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
       $link_div .= "</span></td><td  class=\"scGridBlockFont\">";
       $link_div_2 = "</td></tr></table>";
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $this->NM_tbody_open = false;
           $nm_saida->saida("    </TBODY>");
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['codigo_erp']] = 'top';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
   }
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H3 style=\"font-size:0;padding:1px\">" .  $this->$Cmps_Gb_Free[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H3></div>";
   }
   $conteudo = $tot_codigo_erp[0] ;  
    $thisColspan = 2;
   $colspan = $this->NM_colspan;
   $this->Label_codigo_erp = "<table>"; 
   $Cmps_gb = $this->$Cmps_Gb_Free;
   foreach ($Cmps_gb as $cada_campo) 
   { 
       $this->Label_codigo_erp .= "<tr>"; 
       $this->Label_codigo_erp .= "<td>" . $cada_campo['lab'] . "</td><td>:</td>";
       $this->Label_codigo_erp .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_codigo_erp .= "</tr>"; 
   } 
   $this->Label_codigo_erp .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . " align=\"\">\r\n");
   $nm_saida->saida("       " . $link_div . "\r\n");
   $nm_saida->saida("        " . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_codigo_erp . $nm_fecha_pdf_old . "\r\n");
   $nm_saida->saida("       " . $link_div_2 . "\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $nm_saida->saida("    </TBODY>");
       if ($this->Ult_qb_free == $this->Tab_Nv_tree['codigo_erp'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
           $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['codigo_erp']] = 'bot';
           $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
           $this->NM_tbody_open = true;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_codigo_erp_sc_free_group_by_bot($Cmp_Name) 
 {
   $Var_name_gb  = "SC_tot_" . $Cmp_Name;
   $Cmps_Gb_Free = "campos_quebra_" . $Cmp_Name;
   $Desc_Gb_Ant  = $Cmp_Name . "_ant_desc";
   global 
          $Desc_Gb_Ant, 
          $nm_saida, $$Var_name_gb;
   $tot_codigo_erp = $$Var_name_gb;
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   if ($this->Ult_qb_free != $this->Tab_Nv_tree['codigo_erp'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = true;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body][$this->Tab_Nv_tree['codigo_erp']] = 'bot';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $Desc_Gb_Ant = $this->$Cmps_Gb_Free[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   $prim_lin_tit = true;
   $tit_lin_sumariza = "";
   $tit_lin_sumariza_orig = $tit_lin_sumariza;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
      $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
   $tit_lin_sumariza = "<font color='" . $this->NM_bg_sub_tot . "'>" . $tit_lin_sumariza_orig . "</font>";
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = false;
       $nm_saida->saida("    </TBODY>");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_desc_item_fornec_q_item_top() 
 { global
          $desc_item_fornec_ant_desc, 
          $nm_saida, $tot_desc_item_fornec;
   $desc_item_fornec_ant_desc = $this->campos_quebra_desc_item_fornec[0]['cmp'];
   static $cont_quebra_desc_item_fornec = 0; 
   $cont_quebra_desc_item_fornec++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $link_div   = "";
   $link_div_2 = "";
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $link_div  = "<table style=\"border-collapse: collapse\"><tr>";
       $link_div .= "<td style=\"padding: 0px\"><span align=\"left\">";
       $link_div .= "<img id=\"b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
       $link_div .= "<img id=\"b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
       $link_div .= "</span></td><td  class=\"scGridBlockFont\">";
       $link_div_2 = "</td></tr></table>";
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $this->NM_tbody_open = false;
           $nm_saida->saida("    </TBODY>");
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body]['1'] = 'top';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
   }
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H2 style=\"font-size:0;padding:1px\">" .  $this->campos_quebra_desc_item_fornec[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H2></div>";
   }
   $conteudo = $tot_desc_item_fornec[0] ;  
    $thisColspan = 2;
   $colspan = $this->NM_colspan;
   $this->Label_desc_item_fornec = "<table>"; 
   foreach ($this->campos_quebra_desc_item_fornec as $cada_campo) 
   { 
       $this->Label_desc_item_fornec .= "<tr>"; 
       $this->Label_desc_item_fornec .= "<td>" . $cada_campo['lab'] . "</td><td>:</td>";
       $this->Label_desc_item_fornec .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_desc_item_fornec .= "</tr>"; 
   } 
   $this->Label_desc_item_fornec .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . " align=\"\">\r\n");
   $nm_saida->saida("       " . $link_div . "\r\n");
   $nm_saida->saida("        " . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_desc_item_fornec . $nm_fecha_pdf_old . "\r\n");
   $nm_saida->saida("       " . $link_div_2 . "\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $nm_saida->saida("    </TBODY>");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_desc_item_fornec_q_item_bot() 
 { global 
          $desc_item_fornec_ant_desc, 
          $nm_saida, $tot_desc_item_fornec;
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = true;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body]['1'] = 'bot';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $desc_item_fornec_ant_desc = $this->campos_quebra_desc_item_fornec[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   $prim_lin_tit = true;
   $tit_lin_sumariza = "";
   $tit_lin_sumariza_orig = $tit_lin_sumariza;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_desc_item_fornec[$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
      $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
   $tit_lin_sumariza = "<font color='" . $this->NM_bg_sub_tot . "'>" . $tit_lin_sumariza_orig . "</font>";
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = false;
       $nm_saida->saida("    </TBODY>");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_codigo_erp_q_item_top() 
 { global
          $codigo_erp_ant_desc, 
          $nm_saida, $tot_codigo_erp;
   $codigo_erp_ant_desc = $this->campos_quebra_codigo_erp[0]['cmp'];
   static $cont_quebra_codigo_erp = 0; 
   $cont_quebra_codigo_erp++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $link_div   = "";
   $link_div_2 = "";
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $link_div  = "<table style=\"border-collapse: collapse\"><tr>";
       $link_div .= "<td style=\"padding: 0px\"><span align=\"left\">";
       $link_div .= "&nbsp;<img id=\"b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
       $link_div .= "<img id=\"b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_close_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_cons_item_qt_imp_union_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_cons_item_qt_imp_union, 'cons_item_qt_imp_union'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
       $link_div .= "</span></td><td  class=\"scGridBlockFont\">";
       $link_div_2 = "</td></tr></table>";
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $this->NM_tbody_open = false;
           $nm_saida->saida("    </TBODY>");
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body]['2'] = 'top';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
   }
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H3 style=\"font-size:0;padding:1px\">" .  $this->campos_quebra_codigo_erp[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H3></div>";
   }
   $conteudo = $tot_codigo_erp[0] ;  
    $thisColspan = 2;
   $colspan = $this->NM_colspan;
   $this->Label_codigo_erp = "<table>"; 
   foreach ($this->campos_quebra_codigo_erp as $cada_campo) 
   { 
       $this->Label_codigo_erp .= "<tr>"; 
       $this->Label_codigo_erp .= "<td>" . $cada_campo['lab'] . "</td><td>:</td>";
       $this->Label_codigo_erp .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_codigo_erp .= "</tr>"; 
   } 
   $this->Label_codigo_erp .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . " align=\"\">\r\n");
   $nm_saida->saida("       " . $link_div . "\r\n");
   $nm_saida->saida("        " . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_codigo_erp . $nm_fecha_pdf_old . "\r\n");
   $nm_saida->saida("       " . $link_div_2 . "\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp && !$this->Ini->Proc_print && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $nm_saida->saida("    </TBODY>");
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree']++;
       $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ind_tree'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['cons_item_qt_imp_union'][$this->NM_cont_body]['2'] = 'bot';
       $nm_saida->saida("    <TBODY id=\"tbody_cons_item_qt_imp_union_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
       $this->NM_tbody_open = true;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_codigo_erp_q_item_bot() 
 { global 
          $codigo_erp_ant_desc, 
          $nm_saida, $tot_codigo_erp;
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $codigo_erp_ant_desc = $this->campos_quebra_codigo_erp[0]['cmp'];
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   $prim_lin_tit = true;
   $tit_lin_sumariza = "";
   $tit_lin_sumariza_orig = $tit_lin_sumariza;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridSubtotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"   style=\"text-align: left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " >" . $tit_lin_sumariza_atu . "</TD>\r\n");
           $colspan = 0;
           $tit_lin_sumariza_atu = "&nbsp;";
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $tot_codigo_erp[$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]]; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
      $NM_css_field = ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_sub_tot";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . $NM_css_field . "\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
        $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
        $colspan++;
    }
   }
   if ($colspan > 0)
   {
      $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridSubtotalFont . "\"  style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
   $tit_lin_sumariza = "<font color='" . $this->NM_bg_sub_tot . "'>" . $tit_lin_sumariza_orig . "</font>";
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$this->NM_emb_tree_no)
   {
       $this->NM_tbody_open = false;
       $nm_saida->saida("    </TBODY>");
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_geral_sc_free_group_by_top() 
 {
   global $nm_saida; 
   if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
   {
       $nm_saida->saida("    </TBODY>");
   }
 }
 function quebra_geral_sc_free_group_by_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->Tot->quebra_geral_sc_free_group_by(); 
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      =  $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] . ")";
   $tit_lin_sumariza_orig =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] . ")";
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
  $prim_lin_tit = true;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $tit_lin_sumariza . "&nbsp;-&nbsp;" . $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_qt_rec_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_vl_rec_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_qt_comprada_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_vl_comprada_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
    $tit_lin_sumariza = "<span style='opacity: 0;'>" . $tit_lin_sumariza_orig . "</span>";
   }
 } 
 function quebra_geral_q_item_top() 
 {
   global $nm_saida; 
   if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
   {
       $nm_saida->saida("    </TBODY>");
   }
 }
 function quebra_geral_q_item_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->Tot->quebra_geral_q_item(); 
   $NM_cmp_tot['qt_rec_final']['S'] = 2;
   $NM_cmp_tot['vl_rec_final']['S'] = 3;
   $NM_cmp_tot['qt_comprada_final']['S'] = 4;
   $NM_cmp_tot['vl_comprada_final']['S'] = 5;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      =  $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] . ")";
   $tit_lin_sumariza_orig =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][1] . ")";
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
  $prim_lin_tit = true;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $tit_lin_sumariza . "&nbsp;-&nbsp;" . $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "cod_situacao" && (!isset($this->NM_cmp_hidden['cod_situacao']) || $this->NM_cmp_hidden['cod_situacao'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "pedido_fornec" && (!isset($this->NM_cmp_hidden['pedido_fornec']) || $this->NM_cmp_hidden['pedido_fornec'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "vl_negociado" && (!isset($this->NM_cmp_hidden['vl_negociado']) || $this->NM_cmp_hidden['vl_negociado'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_comprada" && (!isset($this->NM_cmp_hidden['qt_comprada']) || $this->NM_cmp_hidden['qt_comprada'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_confirmada_embarque" && (!isset($this->NM_cmp_hidden['qt_confirmada_embarque']) || $this->NM_cmp_hidden['qt_confirmada_embarque'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_recbto_fisico" && (!isset($this->NM_cmp_hidden['qt_recbto_fisico']) || $this->NM_cmp_hidden['qt_recbto_fisico'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "qt_rec_final" && (!isset($this->NM_cmp_hidden['qt_rec_final']) || $this->NM_cmp_hidden['qt_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['qt_rec_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_rec_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_qt_rec_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_rec_final" && (!isset($this->NM_cmp_hidden['vl_rec_final']) || $this->NM_cmp_hidden['vl_rec_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_rec_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['vl_rec_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_rec_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_vl_rec_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "qt_comprada_final" && (!isset($this->NM_cmp_hidden['qt_comprada_final']) || $this->NM_cmp_hidden['qt_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['qt_comprada_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_qt_comprada_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_qt_comprada_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "vl_comprada_final" && (!isset($this->NM_cmp_hidden['vl_comprada_final']) || $this->NM_cmp_hidden['vl_comprada_final'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['tot_geral'][$NM_cmp_tot['vl_comprada_final'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_vl_comprada_final_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_vl_comprada_final_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "nr_container" && (!isset($this->NM_cmp_hidden['nr_container']) || $this->NM_cmp_hidden['nr_container'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "situacao_container" && (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_registro" && (!isset($this->NM_cmp_hidden['dt_registro']) || $this->NM_cmp_hidden['dt_registro'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_recebimento" && (!isset($this->NM_cmp_hidden['dt_recebimento']) || $this->NM_cmp_hidden['dt_recebimento'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "dt_prev_chegada" && (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
    $tit_lin_sumariza = "<span style='opacity: 0;'>" . $tit_lin_sumariza_orig . "</span>";
   }
 } 
 function quebra_geral__NM_SC__top() 
 {
 }
 function quebra_geral__NM_SC__bot() 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
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
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <i id='SC_fast_search_dropdown_top' style='cursor: pointer;' class='fas fa-caret-down' onclick=\"nm_gp_open_qsearch_div('top');\"></i>\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '__Clear_Fast__'; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("<div id='id_qs_div_top' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>\r\n");
          $nm_saida->saida("                <div>\r\n");
          $nm_saida->saida("                    <span>\r\n");
          $nm_saida->saida("                      <p  class='scGridQuickSearchDivLabel'>" . $this->Ini->Nm_lang['lang_btns_clmn'] . "</span></p>\r\n");
          $OPC_cmp_sel = explode("_VLS_", $OPC_cmp);
          $nm_saida->saida("          <select multiple=multiple  id=\"fast_search_f0_top\" class=\"\" style=\"vertical-align: middle;\" name=\"nmgp_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['cod_situacao'] = (isset($this->New_label['cod_situacao'])) ? $this->New_label['cod_situacao'] : 'Situa��o'; 
          $SC_Label_atu['pedido_fornec'] = (isset($this->New_label['pedido_fornec'])) ? $this->New_label['pedido_fornec'] : 'Pedido Fornec.'; 
          $SC_Label_atu['vl_negociado'] = (isset($this->New_label['vl_negociado'])) ? $this->New_label['vl_negociado'] : 'Vl. Negociado'; 
          $SC_Label_atu['qt_comprada'] = (isset($this->New_label['qt_comprada'])) ? $this->New_label['qt_comprada'] : 'Qt.Comprada'; 
          $SC_Label_atu['qt_confirmada_embarque'] = (isset($this->New_label['qt_confirmada_embarque'])) ? $this->New_label['qt_confirmada_embarque'] : 'Qt.Confirmada Embarque'; 
          $SC_Label_atu['qt_recbto_fisico'] = (isset($this->New_label['qt_recbto_fisico'])) ? $this->New_label['qt_recbto_fisico'] : 'Qt. Recbto. F�sico'; 
          $SC_Label_atu['qt_rec_final'] = (isset($this->New_label['qt_rec_final'])) ? $this->New_label['qt_rec_final'] : 'Qt.Recbto.Final'; 
          $SC_Label_atu['vl_rec_final'] = (isset($this->New_label['vl_rec_final'])) ? $this->New_label['vl_rec_final'] : 'Vl.Recbto.Final'; 
          $SC_Label_atu['qt_comprada_final'] = (isset($this->New_label['qt_comprada_final'])) ? $this->New_label['qt_comprada_final'] : 'Qt.Comprada Final'; 
          $SC_Label_atu['vl_comprada_final'] = (isset($this->New_label['vl_comprada_final'])) ? $this->New_label['vl_comprada_final'] : 'Vl. Comprada Final'; 
          $SC_Label_atu['nr_container'] = (isset($this->New_label['nr_container'])) ? $this->New_label['nr_container'] : 'NR CONTAINER'; 
          $SC_Label_atu['situacao_container'] = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : 'Situa��o Container'; 
          $SC_Label_atu['dt_registro'] = (isset($this->New_label['dt_registro'])) ? $this->New_label['dt_registro'] : 'Dt. Registro'; 
          $SC_Label_atu['dt_recebimento'] = (isset($this->New_label['dt_recebimento'])) ? $this->New_label['dt_recebimento'] : 'Dt. Recbto'; 
          $SC_Label_atu['dt_prev_chegada'] = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : 'Dt. Prev. Chegada'; 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $cada_field)
          { 
                  if($cada_field == 'SC_all_Cmp')
                     continue;
              if ((!isset($this->NM_cmp_hidden[$cada_field]) || $this->NM_cmp_hidden[$cada_field] != "off") && isset($SC_Label_atu[$cada_field])) { 
                  $OPC_sel = (in_array($cada_field, $OPC_cmp_sel) || ($cada_field == 'SC_all_Cmp' && empty($OPC_cmp))) ? " selected" : "";
                  $nm_saida->saida("           <option value=\"" . $cada_field . "\"$OPC_sel>" . $SC_Label_atu[$cada_field] . "</option>\r\n");
               }
          } 
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("                    </span>\r\n");
          $nm_saida->saida("                    <span >\r\n");
          $nm_saida->saida("                      <p class='scGridQuickSearchDivLabel'>" . $this->Ini->Nm_lang['lang_quck_srchcond'] . "</span></p>\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"\" style=\"vertical-align: middle;display:\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = ("qp" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $OPC_sel = ("ii" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"ii\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>\r\n");
          $OPC_sel = ("eq" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"eq\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>\r\n");
          $OPC_sel = ("np" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"np\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("                    </span>\r\n");
          $nm_saida->saida("                </div>\r\n");
          $nm_saida->saida("                <div class='scGridQuickSearchDivToolbar'>\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('top');", "nm_gp_cancel_qsearch_div_store_temp('top');", "qs_cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('top');", "nm_gp_submit_qsearch('top');", "qs_search", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
          $nm_saida->saida("                </div>\r\n");
          $nm_saida->saida("             </div>\r\n");
          $nm_saida->saida("          </span>");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
      {
          $Tem_pdf_res = "s";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
      {
          $Tem_pdf_res = "n";
      }
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=8&lpapel=279&apapel=216&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume&nm_all_modules=grid,resume&nm_label_group=N&nm_all_cab=S&nm_all_label=S&nm_orient_grid=2&password=n&summary_export_columns=S&pdf_zip=N&origem=cons&language=pt_br&conf_socor=N&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=cons_item_qt_imp_union&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_cor=CO&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid,resume&nm_all_modules=grid,resume&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_xls_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=cons_item_qt_imp_union&nm_tp_xls=xlsx&nm_tot_xls=S&nm_res_cons=" . $Tem_xls_res . "&nm_ini_xls_res=grid,resume&nm_all_modules=grid,resume&password=n&summary_export_columns=S&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_xml_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "", "", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_xml.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_ini_xml_res=grid,resume&nm_all_modules=grid,resume&nm_xml_tag=tag&nm_xml_label=S&language=pt_br&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_csv_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "", "", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_csv.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_ini_csv_res=grid,resume&nm_all_modules=grid,resume&nm_delim_line=1&nm_delim_col=1&nm_delim_dados=1&nm_label_csv=N&language=pt_br&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_pdf_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_pdf_res = "n";
          }
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=RC&nm_cor=CO&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid,resume&nm_all_modules=grid,resume&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
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
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['filter'] == "on"  && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
           $this->nm_btn_exist['filter'][] = "pesq_top";
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpesquisa", "nm_gp_move('busca', '0', 'grid');", "nm_gp_move('busca', '0', 'grid');", "pesq_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $NM_btn = true;
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
        {
        }
          if (is_file("cons_item_qt_imp_union_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_item_qt_imp_union_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
        {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
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
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'];
              $this->nm_btn_exist['goto'][] = "brec_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav);", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ($Reg_Page != 'all') ? ceil($this->nmgp_reg_inicial / $Reg_Page) : 1;
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value);\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] == '100') ? " selected" : "";
              $nm_saida->saida("           <option value=\"100\" " . $obj_sel . ">100</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] == '200') ? " selected" : "";
              $nm_saida->saida("           <option value=\"200\" " . $obj_sel . ">200</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
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
          if (is_file("cons_item_qt_imp_union_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_item_qt_imp_union_help.txt"); 
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
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
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
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <i id='SC_fast_search_dropdown_top' style='cursor: pointer;' class='fas fa-caret-down' onclick=\"nm_gp_open_qsearch_div('top');\"></i>\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '__Clear_Fast__'; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("            </span>\r\n");
          $nm_saida->saida("<div id='id_qs_div_top' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>\r\n");
          $nm_saida->saida("                <div>\r\n");
          $nm_saida->saida("                    <span>\r\n");
          $nm_saida->saida("                      <p  class='scGridQuickSearchDivLabel'>" . $this->Ini->Nm_lang['lang_btns_clmn'] . "</span></p>\r\n");
          $OPC_cmp_sel = explode("_VLS_", $OPC_cmp);
          $nm_saida->saida("          <select multiple=multiple  id=\"fast_search_f0_top\" class=\"\" style=\"vertical-align: middle;\" name=\"nmgp_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['cod_situacao'] = (isset($this->New_label['cod_situacao'])) ? $this->New_label['cod_situacao'] : 'Situa��o'; 
          $SC_Label_atu['pedido_fornec'] = (isset($this->New_label['pedido_fornec'])) ? $this->New_label['pedido_fornec'] : 'Pedido Fornec.'; 
          $SC_Label_atu['vl_negociado'] = (isset($this->New_label['vl_negociado'])) ? $this->New_label['vl_negociado'] : 'Vl. Negociado'; 
          $SC_Label_atu['qt_comprada'] = (isset($this->New_label['qt_comprada'])) ? $this->New_label['qt_comprada'] : 'Qt.Comprada'; 
          $SC_Label_atu['qt_confirmada_embarque'] = (isset($this->New_label['qt_confirmada_embarque'])) ? $this->New_label['qt_confirmada_embarque'] : 'Qt.Confirmada Embarque'; 
          $SC_Label_atu['qt_recbto_fisico'] = (isset($this->New_label['qt_recbto_fisico'])) ? $this->New_label['qt_recbto_fisico'] : 'Qt. Recbto. F�sico'; 
          $SC_Label_atu['qt_rec_final'] = (isset($this->New_label['qt_rec_final'])) ? $this->New_label['qt_rec_final'] : 'Qt.Recbto.Final'; 
          $SC_Label_atu['vl_rec_final'] = (isset($this->New_label['vl_rec_final'])) ? $this->New_label['vl_rec_final'] : 'Vl.Recbto.Final'; 
          $SC_Label_atu['qt_comprada_final'] = (isset($this->New_label['qt_comprada_final'])) ? $this->New_label['qt_comprada_final'] : 'Qt.Comprada Final'; 
          $SC_Label_atu['vl_comprada_final'] = (isset($this->New_label['vl_comprada_final'])) ? $this->New_label['vl_comprada_final'] : 'Vl. Comprada Final'; 
          $SC_Label_atu['nr_container'] = (isset($this->New_label['nr_container'])) ? $this->New_label['nr_container'] : 'NR CONTAINER'; 
          $SC_Label_atu['situacao_container'] = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : 'Situa��o Container'; 
          $SC_Label_atu['dt_registro'] = (isset($this->New_label['dt_registro'])) ? $this->New_label['dt_registro'] : 'Dt. Registro'; 
          $SC_Label_atu['dt_recebimento'] = (isset($this->New_label['dt_recebimento'])) ? $this->New_label['dt_recebimento'] : 'Dt. Recbto'; 
          $SC_Label_atu['dt_prev_chegada'] = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : 'Dt. Prev. Chegada'; 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['field_order'] as $cada_field)
          { 
                  if($cada_field == 'SC_all_Cmp')
                     continue;
              if ((!isset($this->NM_cmp_hidden[$cada_field]) || $this->NM_cmp_hidden[$cada_field] != "off") && isset($SC_Label_atu[$cada_field])) { 
                  $OPC_sel = (in_array($cada_field, $OPC_cmp_sel) || ($cada_field == 'SC_all_Cmp' && empty($OPC_cmp))) ? " selected" : "";
                  $nm_saida->saida("           <option value=\"" . $cada_field . "\"$OPC_sel>" . $SC_Label_atu[$cada_field] . "</option>\r\n");
               }
          } 
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("                    </span>\r\n");
          $nm_saida->saida("                    <span >\r\n");
          $nm_saida->saida("                      <p class='scGridQuickSearchDivLabel'>" . $this->Ini->Nm_lang['lang_quck_srchcond'] . "</span></p>\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"\" style=\"vertical-align: middle;display:\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = ("qp" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $OPC_sel = ("ii" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"ii\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>\r\n");
          $OPC_sel = ("eq" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"eq\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>\r\n");
          $OPC_sel = ("np" == $OPC_arg) ? " selected='selected'" : "";
          $nm_saida->saida("           <option value=\"np\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("                    </span>\r\n");
          $nm_saida->saida("                </div>\r\n");
          $nm_saida->saida("                <div class='scGridQuickSearchDivToolbar'>\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('top');", "nm_gp_cancel_qsearch_div_store_temp('top');", "qs_cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('top');", "nm_gp_submit_qsearch('top');", "qs_search", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
          $nm_saida->saida("                </div>\r\n");
          $nm_saida->saida("             </div>\r\n");
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "_NM_SC_")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
      {
          $Tem_pdf_res = "s";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
      {
          $Tem_pdf_res = "n";
      }
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=8&lpapel=279&apapel=216&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume&nm_all_modules=grid,resume&nm_label_group=N&nm_all_cab=S&nm_all_label=S&nm_orient_grid=2&password=n&summary_export_columns=S&pdf_zip=N&origem=cons&language=pt_br&conf_socor=N&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=cons_item_qt_imp_union&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_cor=CO&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid,resume&nm_all_modules=grid,resume&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_xls_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=cons_item_qt_imp_union&nm_tp_xls=xlsx&nm_tot_xls=S&nm_res_cons=" . $Tem_xls_res . "&nm_ini_xls_res=grid,resume&nm_all_modules=grid,resume&password=n&summary_export_columns=S&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_xml_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "", "", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_xml.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_ini_xml_res=grid,resume&nm_all_modules=grid,resume&nm_xml_tag=tag&nm_xml_label=S&language=pt_br&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_csv_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_csv_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['csv'][] = "csv_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "", "", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_csv.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&password=n&nm_res_cons='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_ini_csv_res=grid,resume&nm_all_modules=grid,resume&nm_delim_line=1&nm_delim_col=1&nm_delim_dados=1&nm_label_csv=N&language=pt_br&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_pdf_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Gb_Free_cmp']))
          {
              $Tem_pdf_res = "n";
          }
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=RC&nm_cor=CO&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid,resume&nm_all_modules=grid,resume&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
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
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_sel_groupby_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $this->nm_btn_exist['groupby'][] = "sel_groupby_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
          }
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
        {
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
          if (is_file("cons_item_qt_imp_union_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_item_qt_imp_union_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['SC_Ind_Groupby'] != "_NM_SC_")
        {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
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
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("cons_item_qt_imp_union_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_item_qt_imp_union_help.txt"); 
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
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
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
    function getFieldHighlight($filter_type, $field, $str_value, $str_value_original='')
    {
        $str_html_ini = '<div class="highlight">';
        $str_html_fim = '</div>';

        if($filter_type == 'advanced_search')
        {
            if (
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]) &&
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond" ]) &&
                !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]) &&
                (
                    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'qp' ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'eq' ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'ii'
                )
            )
            {
                if($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'qp')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, $str_value) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            elseif(strcasecmp($vals, $str_value_original) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            else
                            {
                                $keywords = preg_quote($vals, '/');
                                $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], $str_value) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        elseif(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], $str_value_original) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        else
                        {
                            $keywords = preg_quote($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], '/');
                            $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                        }
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'eq')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, $str_value) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                            elseif(strcasecmp($vals, $str_value_original) == 0)
                            {
                                $str_value = $str_html_ini. $str_value .$str_html_fim;
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], $str_value) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                        elseif(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], $str_value_original) == 0)
                        {
                            $str_value = $str_html_ini. $str_value .$str_html_fim;
                        }
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field . "_cond"] == 'ii')
                {
                    if(is_array($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]))
                    {
                        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ] as $ind => $vals)
                        {
                            if(strcasecmp($vals, substr($str_value, 0, strlen($vals))) == 0)
                            {
                                $str_value = $str_html_ini. substr($str_value, 0, strlen($vals)) .$str_html_fim . substr($str_value, strlen($vals));
                            }
                        }
                    }
                    else
                    {
                        if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ], substr($str_value, 0, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]))) == 0)
                        {
                            $str_value = $str_html_ini. substr($str_value, 0, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ])) .$str_html_fim . substr($str_value, strlen($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campos_busca'][ $field ]));
                        }
                    }
                }
            }
        }
        elseif($filter_type == 'quicksearch')
        {
            if(
                isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0]) &&
                (
                    (
                    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0] == 'SC_all_Cmp' &&
                    in_array($field, array('cod_situacao', 'pedido_fornec', 'vl_negociado', 'qt_comprada', 'qt_confirmada_embarque', 'qt_recbto_fisico', 'qt_rec_final', 'vl_rec_final', 'qt_comprada_final', 'vl_comprada_final', 'nr_container', 'situacao_container', 'dt_registro', 'dt_recebimento', 'dt_prev_chegada'))
                    ) ||
                    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0] == $field ||
                    strpos($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0], $field . '_VLS_') !== false ||
                    strpos($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][0], '_VLS_' . $field) !== false
                )
            )
            {
                if($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][1] == 'qp')
                {
                    if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2], $str_value) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    elseif(!empty($str_value_original) && $str_value_original != '&nbsp;' && strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2], $str_value_original) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    else
                    {
                        $keywords = preg_quote($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2], '/');
                        $str_value = preg_replace('/'. $keywords .'/i', $str_html_ini . '$0' . $str_html_fim, $str_value);
                    }
                }
                elseif($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][1] == 'eq')
                {
                    if(strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2], $str_value) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                    elseif(!empty($str_value_original) && $str_value_original != '&nbsp;' && strcasecmp($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['fast_search'][2], $str_value_original) == 0)
                    {
                        $str_value = $str_html_ini. $str_value .$str_html_fim;
                    }
                }
            }
        }
        return $str_value;
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
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0, $opc="")
   {
      if (is_array($nm_apl_parms))
      {
          $tmp_parms = "";
          foreach ($nm_apl_parms as $par => $val)
          {
              $par = trim($par);
              $val = trim($val);
              $tmp_parms .= str_replace(".", "_", $par) . "?#?";
              if (substr($val, 0, 1) == "$")
              {
                  $tmp_parms .= $$val;
              }
              elseif (substr($val, 0, 1) == "{")
              {
                  $val        = substr($val, 1, -1);
                  $tmp_parms .= $this->$val;
              }
              elseif (substr($val, 0, 1) == "[")
              {
                  $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union'][substr($val, 1, -1)];
              }
              else
              {
                  $tmp_parms .= $val;
              }
              $tmp_parms .= "?@?";
          }
          $nm_apl_parms = $tmp_parms;
      }
      $target = (empty($nm_target)) ? "_self" : $nm_target;
      if (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../")
      {
          echo "<SCRIPT language=\"javascript\">";
          if (strtolower($target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
              echo "</SCRIPT>";
              return;
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
              echo "</SCRIPT>";
              exit;
          }
      }
      $dir = explode("/", $nm_apl_dest);
      if (count($dir) == 1)
      {
          $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
          $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
      }
      if ($nm_target == "modal")
      {
          if (!empty($nm_apl_parms))
          {
              $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
              $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
              $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
          }
          $par_modal = "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
           if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida_form_full']) || (isset($this->grid_emb_form_full) && $this->grid_emb_form_full))
           {
              $this->redir_modal = "$(function() { parent.tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
           else
           {
              $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
          return;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['iframe_print']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['iframe_print'] )
      {
          $target = "_parent";
      }
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
      <HTML>
      <HEAD>
      <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0," />
<?php
}
?>
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
      </HEAD>
      <link rel="shortcut icon" href="../_lib/img/grp__NM__ico__NM__favicon-16x16.png">
      <BODY>
   <?php
      }
   ?>
   <form name="Fredir" method="post" 
                     target="_self"> 
     <input type="hidden" name="nmgp_parms" value="<?php echo NM_encode_input($nm_apl_parms) ?>"/>
<?php
   if ($target == "_blank")
   {
?>
       <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
     <input type="hidden" name="nmgp_url_saida" value="<?php echo NM_encode_input($nm_apl_retorno) ?>">
     <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>"/> 
<?php
   }
?>
   </form> 
      <SCRIPT type="text/javascript">
          window.onload = function(){
             submit_Fredir();
          };
          function submit_Fredir()
          {
              document.Fredir.target = "<?php echo $target ?>"; 
              document.Fredir.action = "<?php echo $nm_apl_dest ?>";
              document.Fredir.submit();
          }
      </SCRIPT>
   <?php
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
      </BODY>
      </HTML>
   <?php
      }
      if ($target != "_blank")
      {
          exit;
      }
   }
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
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
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_item_qt_imp_union', $(document).innerHeight())\",50);\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"cons_item_qt_imp_union\"/>\r\n");
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
   $nm_saida->saida("                     action=\"cons_item_qt_imp_union_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"cons_item_qt_imp_union_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"CO\"/> \r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['ajax_nav'])
   {
       if ($this->Rec_ini == 0)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "ini");
       }
       else
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "");
       }
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_ini', 'value' => $this->Rec_ini);
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_fim', 'value' => $this->Rec_fim);
   }
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
   $nm_saida->saida("      nm_gp_submit_ajax(\"rec\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_open_qsearch_div(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {\r\n");
   $nm_saida->saida("            return nm_gp_open_qsearch_div_mobile(pos);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            var positioningV = 'top';\r\n");
   $nm_saida->saida("            var positioningH = 'left';\r\n");
   $nm_saida->saida("            if (pos == 'bot') {\r\n");
   $nm_saida->saida("                positioningV = 'bottom';\r\n");
   $nm_saida->saida("            }\r\n");
   $nm_saida->saida("            if ($('#quicksearchph_' + pos).offset().left + $('#id_qs_div_' + pos).width() > $(document).width()) {\r\n");
   $nm_saida->saida("                positioningH = 'right';\r\n");
   $nm_saida->saida("            }\r\n");
   $nm_saida->saida("            $('#id_qs_div_' + pos).css(positioningV, $('#quicksearchph_' + pos).outerHeight());\r\n");
   $nm_saida->saida("            $('#id_qs_div_' + pos).css(positioningH, '0px');\r\n");
   $nm_saida->saida("            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');\r\n");
   $nm_saida->saida("            nm_gp_open_qsearch_div_store_temp(pos);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        else\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        $('#id_qs_div_' + pos).toggle();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = \"\";\r\n");
   $nm_saida->saida("   function nm_gp_open_qsearch_div_store_temp(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        tmp_qs_arr_fields = [], tmp_qs_str_cond = \"\";\r\n");
   $nm_saida->saida("        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        else\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_cancel_qsearch_div_store_temp(pos)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("        $('#fast_search_f0_' + pos).val('');\r\n");
   $nm_saida->saida("        $(\"#fast_search_f0_\" + pos + \" option\").prop('selected', false);\r\n");
   $nm_saida->saida("        for(it=0; it<tmp_qs_arr_fields.length; it++)\r\n");
   $nm_saida->saida("        {\r\n");
   $nm_saida->saida("            $(\"#fast_search_f0_\" + pos + \" option[value='\"+ tmp_qs_arr_fields[it] +\"']\").prop('selected', true);\r\n");
   $nm_saida->saida("        }\r\n");
   $nm_saida->saida("        $(\"#fast_search_f0_\" + pos).change();\r\n");
   $nm_saida->saida("        tmp_qs_arr_fields = [];\r\n");
   $nm_saida->saida("        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);\r\n");
   $nm_saida->saida("        $('#cond_fast_search_f0_' + pos).change();\r\n");
   $nm_saida->saida("        tmp_qs_str_cond = \"\";\r\n");
   $nm_saida->saida("        nm_gp_open_qsearch_div(pos);\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_submit_qsearch(pos) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       var out_qsearch = \"\";\r\n");
   $nm_saida->saida("       var ver_ch = eval('change_fast_' + pos);\r\n");
   $nm_saida->saida("       if (document.getElementById('SC_fast_search_' + pos).value == '' && ver_ch == '')\r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           scJs_alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
   $nm_saida->saida("           document.getElementById('SC_fast_search_' + pos).focus();\r\n");
   $nm_saida->saida("           return false;\r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (document.getElementById('SC_fast_search_' + pos).value == '__Clear_Fast__')\r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.getElementById('SC_fast_search_' + pos).value = '';\r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       obj = document.getElementById('fast_search_f0_' + pos);\r\n");
   $nm_saida->saida("       if (!obj.length)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           out_qsearch = obj.options[obj.selectedIndex].value;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           for (iCheck = 0; iCheck < obj.length; iCheck++)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               if (obj.options[iCheck].selected)\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   out_qsearch += (out_qsearch != \"\") ? \"_VLS_\" : \"\";\r\n");
   $nm_saida->saida("                   out_qsearch += obj.options[iCheck].value;\r\n");
   $nm_saida->saida("               }\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if(out_qsearch == '')\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           out_qsearch = 'SC_all_Cmp';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + $('#cond_fast_search_f0_' + pos).val();\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + document.getElementById('SC_fast_search_' + pos).value;\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[+]/g, \"__NM_PLUS__\");\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[&]/g, \"__NM_AMP__\");\r\n");
   $nm_saida->saida("       out_qsearch = out_qsearch.replace(/[%]/g, \"__NM_PRC__\");\r\n");
   $nm_saida->saida("       ajax_navigate('fast_search', out_qsearch); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_ajax(opc, parm) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      return ajax_navigate(opc, parm); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"ordem\", campo); \r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['cons_item_qt_imp_union_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_item_qt_imp_union@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
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
   $nm_saida->saida("           document.Fpdf.script_case_session.value = \"" . session_id() . "\";\r\n");
   $nm_saida->saida("           if (\"S\" == ajax)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               $('#TB_window').remove();\r\n");
   $nm_saida->saida("               $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"cons_item_qt_imp_union_iframe.php\";\r\n");
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
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fprint.tp_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_tipo_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           if (password != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fprint.target = '_self';\r\n");
   $nm_saida->saida("               document.Fprint.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           document.Fprint.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("           document.Fexport.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_item_qt_imp_union/cons_item_qt_imp_union_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"cons_item_qt_imp_union_export_ctrl.php\";\r\n");
   $nm_saida->saida("       document.Fexport.submit() ;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       var image = new Image();\r\n");
   $nm_saida->saida("       image.src = imagem;\r\n");
   $nm_saida->saida("       var viewer = new Viewer(image, {\r\n");
   $nm_saida->saida("           navbar: false,\r\n");
   $nm_saida->saida("           hidden: function () {\r\n");
   $nm_saida->saida("               viewer.destroy();\r\n");
   $nm_saida->saida("           },\r\n");
   $nm_saida->saida("       });\r\n");
   $nm_saida->saida("       viewer.show();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo2 + \"?nmgp_parms=\" + campo1, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['cons_item_qt_imp_union']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"cons_item_qt_imp_union_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('cons_item_qt_imp_union')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_item_qt_imp_union', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   function process_hotkeys(hotkey)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("   return false;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   </script>\r\n");
 }
function buscarCodSistCtrlImportacao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return 18; 

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function buscarProgsSistema($sistema)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $tabelas = 'modulos m, programas s';
    $campos = 'p.codigo as codigo, p.cod_tipo_programa as cod_tipo_programa';
    $condicao = " m.cod_sistema = $sistema and m.cod_modulo = p.cod_modulo";
    $aRetorno = $this->retornoMultReg($tabelas, $campos, $condicao,"ticontrole");
    return $aRetorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function buscarProgsUsuario($login, $sistema)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $tabelas = 'modulos m, programas p, s_groups_apps ga';
    $campos = 'p.codigo as codigo, p.cod_tipo_programa as cod_tipo_programa,
	               ga.priv_access as acessar,
      			   ga.priv_insert as inserir,
      			   ga.priv_delete as excluir,
                   ga.priv_update as alterar,
      			   ga.priv_export as exportar,
                   ga.priv_print  as imprimir ';
    $condicao = " m.cod_sistema = $sistema 
					and m.cod_modulo = p.cod_modulo 
					and ga.cod_programa = p.cod_programa
					and ga.group_id in
					(
					 select group_id from s_users_groups
					 where login = '$login'
					
					)";
    $aRetorno = $this->retornoMultReg($tabelas, $campos, $condicao,"ticontrole");
    return $aRetorno;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getProgUsuario($login,$sistema,$codPrograma)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $tabelas = 'modulos m, programas p, s_groups_apps ga';
    $campos = 'top 1 p.codigo as codigo, p.cod_tipo_programa as cod_tipo_programa,
	               ga.priv_access as acessar,
      			   ga.priv_insert as inserir,
      			   ga.priv_delete as excluir,
                   ga.priv_update as alterar,
      			   ga.priv_export as exportar,
                   ga.priv_print  as imprimir ';
    $condicao = " m.cod_sistema = $sistema 
					and m.cod_modulo = p.cod_modulo 
					and ga.cod_programa = p.cod_programa
					and p.codigo = upper('$codPrograma')
					and ga.group_id in
					(
					 select group_id from s_users_groups
					 where login = '$login'
					
					)";
    $aRetorno = $this->retornoSimplesTb01($tabelas, $campos, $condicao,"tiControle");
    return $aRetorno[0];

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function verificarPermProg($login, $prog)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $tabelas = "s_groups_apps ga, s_users_groups ug, programas p ";
    $campos = " ga.cod_programa,
                    ga.priv_access as acessar,
      			    ga.priv_insert as inserir,
      			    ga.priv_delete as excluir,
                    ga.priv_update as alterar,
      			    ga.priv_export as exportar,
                    ga.priv_print  as imprimir,
					p.cod_tipo_programa as cod_tipo_programa";
    $condicao = " ug.group_id = ga.group_id and gu.login = '$login'
  					and   p.cod_programa = ga.cod_programa
  					and  ga.app_name = '$prog'";
    $aRetorno = $this->retornoMultReg($tabelas, $campos, $condicao);
    if (is_array($aRetorno)) {
        for ($i=0; $i < count($aRetorno); $i++) {
            $this->inserirLogDb("registro $i",$aRetorno[$i],__FUNCTION__);
            $tipoPrograma = $aRetorno[$i]['cod_tipo_programa'];
            $acessar = $aRetorno[$i]['acessar'];
            $inserir = $aRetorno[$i]['inserir'];
            $alterar = $aRetorno[$i]['alterar'];
            $excluir = $aRetorno[$i]['excluir'];
            $exportar = $aRetorno[$i]['exportar'];
            $imprimir = $aRetorno[$i]['imprimir'];
            if ($acessar == "Y") {

                switch ($tipoPrograma) {
                    case 1:
                        if ($inserir != 'Y') {
                            $this->nmgp_botoes["new"] = 'off';;
                            $this->nmgp_botoes["insert"] = 'off';;
                            $this->nmgp_botoes["copy"] = 'off';;
                        } else {
                            $this->nmgp_botoes["new"] = 'on';;
                            $this->nmgp_botoes["insert"] = 'on';;
                            $this->nmgp_botoes["copy"] = 'on';;
                        }
                        if ($alterar != 'Y') {
                            $this->nmgp_botoes["update"] = 'off';;
                        } else {
                            $this->nmgp_botoes["update"] = 'on';;
                        }
                        if ($excluir != 'Y') {
                            $this->nmgp_botoes["delete"] = 'off';;
                        } else {
                            $this->nmgp_botoes["delete"] = 'on';;
                        }
                        if ($exportar != 'Y') {
                            $this->nmgp_botoes["pdf"] = 'off';;
                        } else {
                            $this->nmgp_botoes["pdf"] = 'on';;
                        }
                        if ($imprimir != 'Y') {
                            $this->nmgp_botoes["print"] = 'off';;
                        } else {
                            $this->nmgp_botoes["print"] = 'on';;
                        }

                        break;
                    case 2:


                        break;
                    case 3:

                        break;
                    default:


                }
            } else {
                 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('acesso_bloqueado') . "/", $this->nm_location, "nome_prog?#?" . NM_encode_input($prog) . "?@?","_self", 440, 630, "ret_self");
 };
            }
        }


    }
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function aplicarPermissaoUsuario($login, $sistema)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $this->aplicarPermissaoUsuarioSC($login, $sistema);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function aplicarPermissaoUsuarioSC($login, $sistema)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aSegProg = $this->buscarProgsUsuario($login, $sistema);
    if (is_array($aSegProg)) {
        for ($i = 0; $i < count($aSegProg); $i++) {

            $programa = strtolower($aSegProg[$i]['codigo']);
            $acessar = $aSegProg[$i]['acessar'];
            $inserir = $aSegProg[$i]['inserir'];
            $alterar = $aSegProg[$i]['alterar'];
            $excluir = $aSegProg[$i]['excluir'];
            $exportar = $aSegProg[$i]['exportar'];
            $imprimir = $aSegProg[$i]['imprimir'];
            if ($acessar == 'Y') {
                $_SESSION['scriptcase']['sc_apl_seg'][$programa] = "on";;
            } else {
                $_SESSION['scriptcase']['sc_apl_seg'][$programa] = "off";;
            }
            $_SESSION['scriptcase']['sc_apl_conf'][$programa]['insert'] = $this->has_priv($inserir);
            $_SESSION['scriptcase']['sc_apl_conf'][$programa]['delete'] = $this->has_priv($excluir);
            $_SESSION['scriptcase']['sc_apl_conf'][$programa]['update'] = $this->has_priv($alterar);
            $export_permission = 'btn_display_' . $this->has_priv($exportar);
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['xls'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['xls'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'xls';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['word'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['word'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['word'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['word'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'word';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['pdf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['pdf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'pdf';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['xml'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['xml'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'xml';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['csv'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['csv'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'csv';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['rtf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['rtf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'rtf';
}
;
            $export_permission = 'btn_display_' . $this->has_priv($imprimir);
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['print'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['btn_display']['print'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['print'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa]['field_display']['print'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$programa][$export_permission] = 'print';
}
;
        }
    }
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function has_priv($valor)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return ($valor == 'Y' ? 'on' : 'off');

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function iniciarLogDb($apl,$usuarioLogId)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $usuario = $this->getUsuarioCorrente();
    $cmd = "insert into logs(aplicacao,login,dt_hr_inicio,usuario_log_id)
            values('$apl','$usuario',current_timestamp, '$usuarioLogId' ) ";
    $conBase = $this->conectarBase('log_db',$this->getUserLogDb(),$this->getAutLogDb());
    $aRet = $this->execAcaoPDO($cmd,$conBase,'cmd');
    if(isset($aRet['erro'])){
        if($aRet['erro'] <> ''){
            echo "<h1>{$aRet['erro']}</h1>";
        }
    }
    $id = $this->getUltIdTabela('logs');
    $this->setIdCorrenteLogDb($id);
    return $id;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUsuarioCorrente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
        return $this->getLoginCorrente();

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setIdCorrenteLogDb($id)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $_SESSION['log_db']['id_corrente'] = $id;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getIdCorrenteLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['id_corrente'])){
        $retorno = $_SESSION['log_db']['id_corrente'];
    }else{
        $retorno = -1;
    }
     return $retorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function habilitarLogSql($log)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    setVarSessao('log_db_sql',$log);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getLogSql()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->getVarSessao('log_db_sql');

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function inserirLogDb($titulo,$descricaoParam='',$funcao='',$id=0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($id == 0){
        $idLog = $this->getIdCorrenteLogDb();
    }else{
        $idLog = $id;
    }
    if($idLog > 0 ){
        if(is_array($titulo)){
            $titulo = print_r($titulo,true);
        }else{
            $titulo =  $this->tratarAspasSimples($titulo);
            $titulo = $this->retirarAcentoSimples($titulo);
        }
        if(is_array($descricaoParam) ){
            $descricaoParam = print_r($descricaoParam,true);
        }else{
            $descricaoParam = $this->tratarAspasSimples($descricaoParam);
        }
        $nivel = $this->getNivelCorrenteLogDb();
        $cmd = "insert into itens_log(log_id,nivel,funcao,titulo,descricao,dt_hr_reg)
            values($idLog,$nivel,'$funcao','$titulo','$descricaoParam',CURRENT_TIMESTAMP )";
        $aConBase = $this->conectarBase('log_db',$this->getUserLogDb(),$this->getAutLogDb());
        $erroConexao = $aConBase['erro'];
        if($erroConexao <> ''){
            echo "<h1>{$erroConexao}</h1>";
        }else{
            $aRet = $this->execAcaoPDO($cmd,$aConBase,'cmd');

            if(isset($aRet['erro'])){
                if($aRet['erro'] <> ''){
                    echo "<h1>{$aRet['erro']} - Comando: $cmd</h1>";
                    $cmd = $this->acertarAspasSimplesInsert($cmd);
                    echo "<h2>ap�s tratamento: $cmd</h2>";

                }
            }
        }
    }

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getGerarLogUsuarioCorrente($apl='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $usuario = strtolower($this->getLoginCorrente()) ;
    if($apl == ''){
        $apl= $this->Ini->nm_cod_apl;
    }
    $aReg = $this->getReg('log_db','usuario_log','cod_usuario',
        "'$usuario'",       'top 1 id as id',
        " dt_hr_inicial <= GETDATE() and dt_hr_final >= GETDATE()
                   and ( cod_programa = '$apl' or cod_programa = '' 
                   or cod_programa is null) order by id desc  ",false);
    if(is_array($aReg)){
        $id = $aReg[0]['id'];
        if($id == ''){
            $id = -1;
        }
    }else{
        $id = -1;
    }

    return $id;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function incrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] += 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function decrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] -= 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    if($_SESSION['log_db']['nivel_corrente'] < 1){
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $nivel = $_SESSION['log_db']['nivel_corrente'];
    }else{
        $nivel = 1;
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $nivel;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function zerarLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->setIdCorrenteLogDb(-1);
    $idUsuarioLog = $this->getGerarLogUsuarioCorrente($aplCorrente);
    if($idUsuarioLog >= 1){
        $this->iniciarLogDb($aplCorrente,$idUsuarioLog);
    }

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function excluirLogDb($idLog = 0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($idLog > 0){
        $filtroLog = " where id = $idLog";
        $filtroItensLog = " where log_id = $idLog";
    }else{
        $filtroLog = "";
        $filtroItensLog = "";
    }
    $cmd = "delete from logs $filtroLog";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_log_db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_log_db->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    $cmd = "delete from itens_log $filtroItensLog";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_log_db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_log_db->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function validarAltUsuarioLog($usuarioLog,$dtHrIni,$dtHrFim)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $msg = '';
    $aRegUsuarioLog = $this->getRegUsuarioLog($usuarioLog);
    if(is_array($aRegUsuarioLog)){
       $dtHrIniAtual = $aRegUsuarioLog[0]['dt_hr_inicial'];
       $dtHrFimAtual  = $aRegUsuarioLog[0]['dt_hr_final'];

    } else{
        $dtHrIniAtual = '';
        $dtHrFimAtual  = '';
    }
    $qtLogs = $this->getQtLogsUsuarioLg($usuarioLog);
    $agora = getAgora('Ymd H:i:su');
    if($qtLogs > 0){
        if(substr($agora,0,17) > substr($dtHrFim,0,17) and
            ! compararDtHoraForm($dtHrFim ,$dtHrFimAtual) ){
            $msg = "<h3>A data/hora final n�o pode ser menor que o hor�rio atual</h3>";
        }


        if(! compararDtHoraForm($dtHrIni,$dtHrIniAtual)){
            $msg .= "<h3>A data/hora inicial n�o pode ser alterada, pois existem registros de log associados</h3>";
        }
    }
    return $msg;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getQtItensLog($log)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
                   'itens_log',
    'log_id',$log,
    'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getQtLogsUsuarioLg($usuarioLog)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'logs',
        'usuario_log_id',$usuarioLog,
        'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getRegUsuarioLog($log)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'usuario_log',
        'id',$log,
        'id,dt_hr_inicial,dt_hr_final');
    return $aReg;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aRetorno       = array();
    $lAchou         = 0;
    $listaCampos    = '';
    $listaTipoCp    = '';
    $listaExtentCp  = '';

    $tabela   = "sysprogress.syscolumns_full  ";
    if($logMulti == true){
        $tabela = "$catalogo.$tabela";
        $conexao = "multi";
    }else{
        $conexao = $catalogo;

    }
    $campos   = " coltype as tipo_dado, 
                  width as tamanho, 
                  array_extent as extensao, 
                  col as campo,
                  scale as escala,
                  nullflag as log_nulo,
                  format as formato,
                  label  as label,
                  display_order as ordem,
                  owner as esquema,
                  valexp as valexp";
    $condicao = " tbl = '$tb'";
    $aResult = $this->retornoMultReg($tabela,$campos,$condicao,$conexao);
    if(is_array($aResult))	{
        $tam = count($aResult);
        for($i=0;$i<$tam;$i++){
            $campo       = $aResult[$i]['campo'];
            $campoSemAspas = $campo;
            if(stristr($campo,'-') <> false and stristr($campo,chr(34)) == false ) {
                $campo = "\"$campo\"";
            }
            $tipo        = $aResult[$i]['tipo_dado'];
            $extensao    = $aResult[$i]['extensao'];
            $esquema     = $aResult[$i]['esquema'];
            $tab         = '';
            $tabApelido  = '';
            if($logNomeTabela == true){
                $tabApelido = str_replace('-','_',$tb);
                if($logMulti == true){
                    $tab = "$catalogo.$esquema.$tb.";

                }
                else{
                    $tab = "$esquema.$tb.";
                }
                $campo = "$tab.$campo";
            }
            if($extensao > 0){
                for($x=1;$x <= $extensao;$x++){
                    if($tabApelido <> ''){
                        $campoIncr = "pro_element($campo|$x|$x) as {$tabApelido}_{$campoSemAspas}_{$x}";
                    }else{
                        $campoIncr = "pro_element($tab$campo|$x|$x) as {$campoSemAspas}_{$x}";
                    }
                    $listaCampos = $this->util_incr_valor($listaCampos,$campoIncr);
                    $listaTipoCp = $this->util_incr_valor($listaTipoCp,$tipo);
                    $listaExtentCp = $this->util_incr_valor($listaExtentCp,$extensao);
                }


            }else{
                $listaCampos = $this->util_incr_valor($listaCampos,$campo);
                $listaTipoCp = $this->util_incr_valor($listaTipoCp,$tipo);
                $listaExtentCp = $this->util_incr_valor($listaExtentCp,$extensao);
            }

        }
        $aRetorno = array('campos' => $listaCampos,'tipos' => $listaTipoCp,
            'extensoes' => $listaExtentCp);
        $lAchou = 1;
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    switch($conexao)
    {
        case 'ems5':
            $tipoConexao = 'progress';
            break;
        case 'espec':
            $tipoConexao = 'progress';
            break;
        case 'ems2ima':
            $tipoConexao = 'progress';
            break;
        case 'comum':
            $tipoConexao = 'progress';
            break;
        case 'ems2med':
            $tipoConexao = 'progress';
            break;
        case 'multi':
            $tipoConexao = 'progress';
            break;
        case 'cfsc':
            $tipoConexao = 'sql';
            break;
        case 'log_db':
            $tipoConexao = 'sql';
            break;
        case 'ticontrole':
            $tipoConexao = 'sql';
            break;
        default:
            $tipoConexao = 'progress';
    }
    return $tipoConexao;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $condicao = '';
    $tipoConexao = $this->getTipoConexao($conexao);
    if(strstr($camposChave,"," ) <> false){
        $camposChave = explode(',',$camposChave);
    }
    if(strstr($valoresCamposChave,"," ) <> false){
        $valoresCamposChave = explode(',',$valoresCamposChave);
    }
    if(is_array($camposChave)){
        $tam = count($camposChave);
        for($i=0;$i<$tam;$i++){
            $incr	  =  $camposChave[$i]. "=" . $valoresCamposChave[$i];

            $condicao = $this->util_incr_valor($condicao,$incr," AND ");
        }
        if($condicao == ''){
            $condicao = '1 = 1 ';
        }
    }else{
        if($camposChave <> '' and $valoresCamposChave <> ''){
            $condicao = " $camposChave = $valoresCamposChave ";
        }else{
            $condicao = "1 = 1 ";
        }
    }

    if($campos == '' and $tipoConexao == 'progress'){
        $aCampos = $this->getCpsTbSessao($conexao,$tabela);
        $campos = $aCampos['campos'];
    }
    

    if($filtroCompl <> ''){
        $condicao = $this->util_incr_valor($condicao,$filtroCompl,' AND ',true);
    }

    if(strstr($tabela,"-") <> false){
        $tabela = "\"$tabela\"";
    }
    if($tipoConexao == 'progress'){
        $tabela   = "pub.$tabela";
    }

    $tipo     = "unico"; 
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);

    return $aRet;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    switch($tipo)
    {
        case 'unico':
            $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,$conexao,$inner);
            break;
        case 'multi':
            $aRet = $this->retornoMultReg($tabela,$campos,$condicao,$conexao,$inner);
            break;
    }
    return $aRet;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $aRetorno = array();
    $lAchou   = 0;
    $txtArray = '';
    $txtComum = '';
    $tipoConexao = 'progress';
    $aCampos = explode(',',$campos);
    
    $campos  = str_replace("|",",",$campos);
    $sql = "select $campos from $tabela $inner where $condicao";
    $sql = str_replace('\n',' ',$sql);
    switch($conexao)
    {
        case 'ems5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 

            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Db->ErrorMsg();
      } 

            break;
        case 'ems2ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems2ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_ems2ima->ErrorMsg();
      } 

            break;
        case 'ems2med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems2med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_ems2med->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ticontrole2->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Ini->nm_db_ticontrole2->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Db->ErrorMsg();
      } 

    }

    if ($this->meus_dados  === false)
  {
      $erro ="Erro de acesso retornoSimplesTB01.Conex�o $conexao  Mensagem = " . $this->meus_dados_erro ;

  }
  elseif (empty($this->meus_dados ))
  {
  }
  else
  {

      for($i = 0; $i < count($aCampos);$i++)
      {
          $aApelido = explode(' as ', $aCampos[$i]);
          if(count($aApelido) > 1 ){
              $nomeCampo = ltrim(rtrim($aApelido[1]));
          }
          else{
              $nomeCampo = ltrim(rtrim($aApelido[0]));
          }

          
          $aRetorno[0][$nomeCampo] = $this->meus_dados[0][$i];
          $lAchou = 1;

	  }

      
  }
   if($lAchou == 0){
       $aRetorno = '';
   }
   return $aRetorno;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $iCont    = 0;
    $aRetorno = array();
    $lAchou   = 0;
    $txtArray = '';
    $txtComum = '';
    $tipoConexao = 'progress';
    $aCampos = explode(',',$campos);
    
    $campos  = str_replace("|",",",$campos);
    $sql = "select $campos from $tabela where $condicao";
    $sql = str_replace('\n',' ',$sql);
    switch($conexao)
    {
        case 'ems5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 


            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
      } 


            break;
        case 'ems2ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ems2ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ems2ima->ErrorMsg();
      } 

            break;
        case 'ems2med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ems2med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ems2med->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ticontrole2->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ticontrole2->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
      } 

    }


    if ($this->dados  === false){
    $erro =  "Erro de acesso. Mensagem = " . $this->dados_erro ;
    }
    else{
    while (!$this->dados->EOF){
        for($i = 0; $i < count($aCampos);$i++){
            $aApelido = explode(' as ', $aCampos[$i]);
            if(count($aApelido) > 1 ){
                $nomeCampo = ltrim(rtrim($aApelido[1]));
            }
            else{
                $nomeCampo = ltrim(rtrim($aApelido[0]));
            }
            
            $aRetorno[$iCont][$nomeCampo] =  $this->dados->fields[$i];
            $lAchou = 1;
        }
        $iCont++;
        
        $this->dados->MoveNext();
    }
    $this->dados->Close();
}
    if($lAchou == 0){
        $aRetorno = '';
    }
    $this->inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,__FUNCTION__);
    return $aRetorno;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    switch ($tipoBanco){
        case 'sql':
            $sql = "SELECT IDENT_CURRENT ('$tabela') AS Current_Identity";
            break;
    }
    switch ($banco){
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->id = array();
      if ($SCrx = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->id[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->id = false;
          $this->id_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->id = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->id[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->id = false;
          $this->id_erro = $this->Db->ErrorMsg();
      } 

    }

    if ($this->id  === false)
    {
        echo "Erro de acesso. Mensagem = " . $this->id_erro ;
        $this->id = 0;
    }
    elseif (empty($this->id ))
    {
        $this->id = 0;
    }
    else
    {
        $this->id = $this->id[0][0];
    }
    return $this->id;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aCon = $conexaoBase;
    if($aCon['erro']==''){
        $con = $aCon['conexao'];
        switch ($acao){
            case 'cmd':
                $resultado = $con->exec($cmd);
                break;
            default:
                $resultado = $con->query($cmd);
        }
        $erro = $con->errorInfo();
        $erro = strtolower($erro[2]) ;
    }else{
        $erro = $aCon['erro'];
        $resultado = '';
    }
    return array('comando'=>$cmd,'resultado'=>$resultado,'erro'=>$erro);


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $base = $this->getBase();
    $base = strtolower($base);
    switch ($conexaoSC){
        case 'especw':
            $retorno = $base =='producao'? 'espec_w_pro':'espec_w_tst';
            break;
        case 'medw':
            $retorno = $base =='producao'? 'med_w_pro':'med_w_tst';
            break;
        case 'med':
            $retorno = $base =='producao'? 'med_pro':'med_tst';
            break;
        case 'espec':
            $retorno = $base =='producao'? 'espec_pro':'espec_tst';
            break;
        case 'log_db':
            $retorno = $base =='producao'? 'log_portal':'log_portal_tst';
            break;
        default:
            $retorno = $conexaoSC;
    }
    return $retorno;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $erro = '';
    $con  = '';
    $odbc = $this->getODBCDireto($conexaoSC);
    if($logOdbc){
        $odbc = "odbc:".$odbc;
    }
    try {
        $con = new PDO($odbc, $usuario, $senha);
    }catch(PDOException $exception){
        $erro = strtolower($exception->getMessage()) ;
    }
    return array('conexao'=> $con,'erro'=>$erro);


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $tabelas     = '';
    $camposJoin  = '';
    $camposRet   = '';
    $aRetorno    = '';
    $retorno     = '';
    $aDadosTB = $this->retornoSimplesTb01('tabs_chave_estr t , conj_cp_chave_estr c',
        't.tabela_origem,t.tabela_estrangeira,c.cod_conj_cp_chave_estr' ,
        'c.apelido = $apelidoConj and c.cod_tab_chave_estr = t.cod_tab_chave_estr');

    if(is_array($aDadosTB))
    {
        $tabelas = $aDadosTB[0]['t.tabela_origem'].",". $aDadosTB[0]['t.tabela_estranjeira'];


        $aCamposJoin = $this->retornoSimplesTb01('cps_cj_chave_estr c',
            'c.campo_origem,c.campo_estranjeiro' ,
            'c.cod_conj_cp_chave_estr ='.$aDadosTB[0]['c.cod_conj_cp_chave_estr']);
        if(is_array($aCamposJoin))
        {
            for($i=0;$i < count($aCamposJoin);$i++)
            {
                $comum = $aCamposJoin[$i]['c.campo_origem']."=".$aCamposJoin[$i]['c.campo_estrangeiro'];
                if($camposJoin == '') $camposJoin = $comum;
                else $camposJoin .= ",".$comum;
            }
        }
        $aCamposRet = $this->retornoSimplesTb01('rets_cj_cp_chave_estr r, cps_ret_cj_cp_chave_estr c',
                'c.campo' ,
                'r.cod_conj_cp_chave_estr ='.$aDadosTB[0]['c.cod_conj_cp_chave_estr']).
            " and r.num_retorno = $numRetorno " ;
        if(is_array($aCamposRet))
        {
            for($i=0;$i < count($aCamposRet);$i++)
            {
                $comum = $aCamposRet[$i]['c.campo'];
                if($camposRet == '') $camposRet = $comum;
                else $camposRet .= ",".$comum;
            }
        }
        $aRetorno = $this->retornoSimplesTb01($tabelas, $camposRet , $camposJoin);
        $aLstCamposJoin = explode(",",$camposJoin);
        if(is_array($aRetorno))
        {
            for($i=0;$i < count($aLstCamposJoin);$i++)
            {
                $comum = $aRetorno[0][$aLstCamposJoin[$i]];
                if($retorno == '') $retorno = $comum;
                else $retorno .= "-".$comum;
            }
        }
    }
    return $retorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(! strstr(strtolower($tabela),'pub.') and $logPub == true){
        $tabela = "pub.{$tabela}";
    }else{
    }
    if(is_array($aDados)){
        $aCampos = array_keys($aDados);
        $valores    = '' ;

        if(is_array($aCampos)){
            $tam = count($aCampos);
            for($i=0;$i<$tam;$i++){
                if(getNumEmLista($cpsSemAspas,$i + 1)  == true){
                    $incr = $aDados[$aCampos[$i]];
                }else{
                    $incr = "'".$aDados[$aCampos[$i]]."'";
                }
                $incr = $aCampos[$i]." = ".$incr;
                $valores = $this->util_incr_valor($valores,$incr)  ;


            }
        }
    }else{
        $valores = $aDados;
    }

    $cmd = "update {$tabela} set $valores where $condicao ";
    return $cmd;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aJson = array();
    $tabelas = $tabParam;
    $tabelas = str_replace('\"','',$tabelas);
    $tabelas = str_replace('pub.','',$tabelas);
    $tabelas = str_replace(chr(34),'',$tabelas);
    $campos = str_replace(chr(34),'',$campos);
    $condicao = str_replace(chr(34),'',$condicao);
    $condicao = str_replace("\'",'',$condicao);
    switch ($formato){
        case 'json':
            $aJson['ttParam'] = array('tabelas'=>$tabelas,
                'campos'=> $campos,
                'condicao'=> $condicao,
                'inner'=>$inner);
            $retorno = json_encode($aJson);
            break;
        case 'queryParams':
            $retorno = array('tabelas'=>$tabelas,
                'campos'=> $campos,
                'condicao'=> $condicao,
                'inner'=>$inner) ;
    }

    return $retorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $listaCampos = '';
    $listaTipoCp = '';
    $listaTamanho = '';

    $tabela = " sys.columns c ";
    $campos = "    c.name as campo ,
                   t.Name as tipo_dado ,
                   c.max_length as tamanho ";

    $condicao = " c.object_id = OBJECT_ID('$tb')";
    $aResult = $this->retornoMultReg($tabela, $campos, $condicao, $conexao,'INNER JOIN 
               sys.types t ON c.user_type_id = t.user_type_id LEFT OUTER JOIN 
               sys.index_columns ic ON ic.object_id = c.object_id AND ic.column_id = c.column_id');
    if (is_array($aResult)) {
        $tam = count($aResult);
        for ($i = 0; $i < $tam; $i++) {
            $campo = $aResult[$i]['campo'];
            $campoSemAspas = $campo;
            if (stristr($campo, '-') <> false and stristr($campo, chr(34)) == false) {
                $campo = "\"$campo\"";
            }
            $tipo = $aResult[$i]['tipo_dado'];
            $tamanho = $aResult[$i]['tamanho'];
            $tab = '';
            $tabApelido = '';
            if ($logNomeTabela == true) {
                $tabApelido = str_replace('-', '_', $tb);
                $tab = "$tb";

                $campo = "$tab.$campo";
            }
            $listaCampos = $this->util_incr_valor($listaCampos, $campo);
            $listaTipoCp = $this->util_incr_valor($listaTipoCp, $tipo);
            $listaTamanho = $this->util_incr_valor($listaTamanho, $tamanho);
        }
        $aRetorno = array('campos' => $listaCampos, 'tipos' => $listaTipoCp,
            'extensoes' => '','tamanhos'=> $listaTamanho);
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($logSql == 1){
        echo "<h1>$sql</h1>";
    }
    $aCampos = explode(',', $campos);
    $iCont = 0;
    $aRetorno = array();
    $lAchou = false;
    switch ($conexao) {
        case 'ems5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 


            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case 'med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'geral':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_geral->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_geral->ErrorMsg();
      } 

            break;
        case 'dinamico':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Ini->nm_db_dinamico->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_dinamico->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
      } 

    }
    if($this->getLogSql() == 1){
        $this->inserirLogDb('comando SQL - sql livre',$sql,__FUNCTION__);
    }
    if ($this->dados   === false){
    if($this->getLogSql() == 1){
        $this->inserirLogDb('erro comando SQL - conexao:'.$conexao,$this->dados_erro ,__FUNCTION__);
        }
    echo "Erro de acesso. Mensagem = " . $this->dados_erro ;
    }else{
    while (!$this->dados->EOF) {
        for ($i = 0; $i < count($aCampos); $i++) {
            $aApelido = explode(' as ', $aCampos[$i]);
            if (count($aApelido) > 1) {
                $nomeCampo = ltrim(rtrim($aApelido[1]));
            } else {
                $nomeCampo = ltrim(rtrim($aApelido[0]));
            }
            if($logUTF8 == 1){
                $cp = utf8_encode($this->dados->fields[$i]);
            }
            else{
                $cp =$this->dados->fields[$i];
            }
            $aRetorno[$iCont][$nomeCampo] = $cp ;
            $lAchou = true;
        }
        $iCont++;
        
        $this->dados->MoveNext();
    }
    $this->dados->Close();
}
    if ($lAchou == false) {
        $aRetorno = '';
    }
	return $aRetorno;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aCampos = array_keys($aDados);
    $campos    = '';
    $vlCampos = '' ;
    if(is_array($aCampos)){
        $tam = count($aCampos);
        for($i=0;$i<$tam;$i++){
            $campos  = $this->util_incr_valor($campos,$aCampos[$i]);
            if(getNumEmLista($cpsSemAspas,$i + 1)  == true){
                $incr = $aDados[$aCampos[$i]];
            }else{
                $incr = "'".$aDados[$aCampos[$i]]."'";
            }
            $vlCampos = $this->util_incr_valor($vlCampos,$incr)  ;


        }
    }
    $cmd = "insert into {$tabela}({$campos})values({$vlCampos})";
    return $cmd;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $usuario = '';
    $aCon =$this->conectarBase($conexaoSC);
    $cmd = $this->convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas);
    $ret = $this->execAcaoPDO($cmd,$aCon,'cmd');
    $erro = $ret['erro'];
    $lock = strstr($erro,'failure getting record lock')? 1 : 0;
    if($lock == 1){
        $usuario = $this->getUsuarioLock($tabela,$conexaoSC);
        
    }
    return array('resultado'=> $ret,'erro'=>$erro,'lock'=>$lock,'usuario_lock'=>$usuario);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_item_qt_imp_union']['inicio']);
}

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aCon       = getDadosConexao($nomeBanco);
    $servidor   = $aCon['server'];
    $usuario    = $aCon['user'];
    $senha      = $aCon['password'];
    $conexao    = $this->conectarBase(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $usuario,
        $senha,
        false);
    return $conexao;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $tabela = str_replace(chr(34),"",$tabela);
    $aCon = $this->conectarBase($conexaoSC);
    $sql = " select \"_Connect-Name\" as usuario from pub.\"_lock\"
inner join pub.\"_file\" on pub.\"_file\".\"_file-number\" = pub.\"_lock\".\"_lock-table\"
inner join pub.\"_connect\" on \"_Connect-Usr\" = \"_Lock-usr\"
where pub.\"_file\".\"_file-name\" = '$tabela' with (NOLOCK)   ";
    $ret = $this->execAcaoPDO($sql,$aCon);
    if($ret['erro']<> ''){
        echo "<h1>{$ret['erro']}</h1>";
    }
    $reg = $ret['resultado']->fetch(PDO::FETCH_ASSOC);
    if(is_array($reg)) {
        $usuario = $reg['USUARIO'];
    }else{
        $usuario = '';
    }
    return $usuario;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $retorno = $variavel;
    $logIncrementar = false;
    if($logDesconsideraBranco == true){
        if($incremento <> '' and $incremento <> ''){
            $logIncrementar = true;
        }
    }else{
        $logIncrementar = true;
    }
    if($logIncrementar == true){
        if($variavel == ''){
            $retorno = $incremento;
        }
        else{
            $retorno .= $delimitador.$incremento;
        }
    }
    return $retorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $retorno = 0;
    $oDataIni = new DateTime($dtHrIni);
    $oDataFim = new DateTime($dtHrFim);

    $oDif     	= $oDataIni->diff($oDataFim);
    $anoDif		= $oDif->format("%Y");
    $mesDif		= $oDif->format("%M");
    $diaDif		= $oDif->format("%D");
    $horaDif	= $oDif->format("%H");
    $minutoDif	= $oDif->format("%I");
    $segundoDif	= $oDif->format("%S");

    $aRetorno = array('ano' => $anoDif, 'mes' => $mesDif, 'dia' => $diaDif,
        'hora' => $horaDif , 'minuto' => $minutoDif, 'segundo' => $segundoDif	);
    switch($tipoRetorno){
        case 'dia':
            $retorno = $oDif->days;
            break;
        case 'hora':
            $retorno = ($oDif->days * 24) + $horaDif + ($minutoDif / 60);
            break;
        case 'minuto':
            $retorno = ($oDif->days * 24 * 60) + ($horaDif * 60) + $minutoDif;
            break;
        default:
            $retorno = $aRetorno;
    }


    return $retorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.CURRVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->seq = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->seq[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->seq = false;
          $this->seq_erro = $this->Db->ErrorMsg();
      } 

    if ($this->seq  === false){
    echo "Erro de Acesso fun��o buscarvlSequenciaEspec. Messagem=". $this->seq_erro  ;
	}
	elseif (empty($this->seq )){
}
	else{
    $valor = $this->seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.NEXTVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->seq = array();
      if ($SCrx = $this->Ini->nm_db_especw->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->seq[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->seq = false;
          $this->seq_erro = $this->Ini->nm_db_especw->ErrorMsg();
      } 

    if ($this->seq  === false){
    echo "Erro de Acesso fun��o buscarvlSequenciaEspec. Messagem=". $this->seq_erro  ;
	}
	elseif (empty($this->seq )){
}
	else{
    $valor = $this->seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $logDif = false;
    if($lista1 <> '' and $lista2 <> ''){
        $aLista1 = explode($delimitador,$lista1);
        $tam1    = count($aLista1);
        $aLista2 = explode($delimitador,$lista2);
        $tam2    = count($aLista2);
        if($tam1 <> $tam2) {
            $logDif =true;
        }else{
            if(is_array($aLista1)){
                for($i=0;$i<$tam1;$i++){
                    $vlLista1 = $aLista1[$i];
                    $vlLista2 = $aLista2[$i];
                    if( $vlLista1 <> $vlLista2){
                        echo "<h1>lista 1: $vlLista1 - lista 2: $vlLista2 -> i: $i</h1>";
                        $logDif = true;
                        break;
                    }
                }
            }
        }
    }
    return $logDif;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return preg_replace(
        array("/(�|�|�|�|�)/",
            "/(�|�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�|�|�|�|�)/",
            "/(�|�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�|�|�|�)/",
            "/(�)/",
            "/(�)/",
            "/(�)/",
            "/(�)/"),
        explode(" ","a A e E i I o O u U n N c C"),$texto
    );


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $resultado = 0;
    switch ($operacao){
        case 'soma':
            $resultado = $this->tratarNumero($primeiroTermo) + $this->tratarNumero($segundoTermo);
            break;
        case 'subtracao':
            $resultado= $this->tratarNumero($primeiroTermo) - $this->tratarNumero($segundoTermo);
            break;
        case 'multiplicao':
            $resultado = $this->tratarNumero($primeiroTermo) * $this->tratarNumero($segundoTermo);
            break;
        case 'divisao':
            if($this->tratarNumero($segundoTermo) <> 0){
                $resultado = $this->tratarNumero($primeiroTermo) / $this->tratarNumero($segundoTermo);
            }
            break;
        case 'elevacao':
            $resultado = pow($this->tratarNumero($primeiroTermo),$this->tratarNumero($segundoTermo));
            break;
        case 'modulacao':
            if($this->tratarNumero($segundoTermo) <> 0){
                $resultado = $this->tratarNumero($primeiroTermo) % $this->tratarNumero($segundoTermo);
            }
            break;
        case 'raiz_quadrada':
            $resultado = sqrt($primeiroTermo);
            break;

    }
    return $resultado;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    str_replace(chr(13),'<br/>',$msg);
    if($msg <> ''){
        switch ($indTransformacao){
            case 1:
                $msg = utf8_encode($msg);
                break;
            case 2:
                $msg = utf8_decode($msg);
                break;
        }
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $msg;
;
    }
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $condicao = "  action in('insert','update','delete') and ( id_chave = 0
     or id_chave is null)";
    if($aplicacao <> ''){
        $condicao .= " and application =  '$aplicacao'";
    }
    $sql = "select id,description, inserted_date from sc_log
          where $condicao  ";

     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dadoslog = $this->Ini->nm_db_log_imp_mysql->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dadoslog = false;
          $this->dadoslog_erro = $this->Ini->nm_db_log_imp_mysql->ErrorMsg();
      } 

    if ($this->dadoslog  === false){
    echo "Erro acesso na busca do log=". $this->dadoslog_erro ;
    }
    else{
    while (!$this->dadoslog->EOF)
    {
        $idReg = $this->dadoslog->fields[0];
        $desc = $this->dadoslog->fields[1];
        $data = $this->dadoslog->fields[2];
        if($desc <> '' ){
            $aChave = explode('-->',$desc);
            $aNum   = explode(':',$aChave[1]);
            $idChave = str_replace('||','',$aNum[1]);
            if($idChave == ''){
                $idChave = 0;
            }
            if(is_numeric($idReg)){
                $cmd = "update sc_log set id_chave = $idChave where id = $idReg";
                
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_log_imp_mysql->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_log_imp_mysql->ErrorMsg());
             exit;
         }
         $rf->Close();
      
            }else{
                echo "<h1>id n�o numerico: $idChave <br> id: $idReg <br> descri��o: $desc <br> $data </h1>";
            }
        }


        $this->dadoslog->MoveNext();
    }
    $this->dadoslog->Close();
}
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
if (!isset($_SESSION['link_log'])) {$_SESSION['link_log'] = "";}
if (!isset($this->sc_temp_link_log)) {$this->sc_temp_link_log = (isset($_SESSION['link_log'])) ? $_SESSION['link_log'] : "";}
  
    $retorno = '';
    $aplCorrente = $this->Ini->nm_cod_apl;
    $aTipo = explode(',',$tipo);
    if(is_array($aTipo)){
        $tam = count($aTipo);
        for($i=0;$i<$tam;$i++){
            $tipoCorrente = $aTipo[$i];
            switch ($tipoCorrente){
                case 1:
                    if($idChave <> 0){
                        $retorno  = "|<a target='_blank' href='../cons_log_inc_alt/cons_log_inc_alt.php?apl_corrente=$aplCorrente&id_chave=$idChave'>Log's Registro Corrente</a>";
                    }
                    break;
                case 2:
                    $retorno = $this->util_incr_valor($retorno,
                        "<a target='_blank' href='../cons_log_apl/cons_log_apl.php?apl_corrente=$aplCorrente'>Log's Aplica��o Corrente</a>",
                        " | ");
                    break;
            }

        }
    }
    if(isset($this->sc_temp_link_log)){
         unset($_SESSION['link_log']);
 unset($this->sc_temp_link_log);
;
    }
    $link_log = $retorno;
     if (isset($link_log)) {$this->sc_temp_link_log = $link_log;}
;
    return "$retorno";
if (isset($this->sc_temp_link_log)) {$_SESSION['link_log'] = $this->sc_temp_link_log;}
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $programa = $this->getProgramaCorrenteLog();
    if($arquivo == ''){
        $arquivo = $this->getArqTransLog($programa);
    }
    $aDirLog =  $this->getDirCompletoArqsLog();
    $dir = $aDirLog['diretorio'];
    $separador = $aDirLog['separador'];
    $arquivo   = $dir.$separador.$arquivo;
    echo "nome arquivo: $arquivo - $log <br>";
    file_put_contents($arquivo,$log,FILE_APPEND); 

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if(isset($_SESSION['im_param'][$parametro])){
       $valor = $_SESSION['im_param'][$parametro];

    }else{
        $valor = '';
        $tabela = 'pub."im-param"';
        $campos = '"val-param"';
        $condicao = "\"cod-param\" = '$parametro'";
        $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
        if(is_array($aRetorno)){
            $valor = $aRetorno[0]['"val-param"'];

        }else{
            $valor = $vlPadrao;
        }
        $_SESSION['im_param'][$parametro] = $valor;
    }
    return $valor;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario($this->getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNomeVarLoginSessao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return "glo_usr_login";

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNomeVarPercParComis()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return "perc_participacao_comis";

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNomeVarTodosCliente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return "log_todos_cliente";

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getCamposUsuario()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return  'priv_admin,ativo,nome,email,"tp-usuario" as tp_usuario,usuario,
		"nome-ab-cli" as nome_ab_cli,login,usuario,log_pedido_on_line,
                 log_aprovador,id,perc_participacao_comis,log_todos_clientes';

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function validarLogin($login,$pswd)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $login = $this->retirarAcentoSimples($login);
    $erro = '';
    $slogin = $this->Db->qstr($login);
    $spswd  = $this->Db->qstr($pswd);
    $logSetarVariaveis = false;
    $campos = $this->getCamposUsuario();
    $slogin = str_replace("'","",$slogin);
    $spswd  = str_replace("'","",$spswd);

    $aUsuario = getDadosUserWeb($slogin,$campos," senha = '__OMITIDO_NA_COPIA_DE_ANALISE__' ");
    $vendLoja = 0;
    if(! is_array($aUsuario)){
        $this->Ini->NM_gera_log_insert("User", 'login Falhou', "Falhou a tentativa de logar com o login:$login");
        $erro = 'Informe um usu�rio e uma senha v�lida ';
    }else{
        $reg = $aUsuario[0];
        $ativo              = $reg['ativo'];
        if($ativo <> 1){
            $erro = "Usu�rio Inativo";
        }
    }
    return array('array'=>$aUsuario,'erro'=>$erro);
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getVarSessao($varParam,$logEscopoApl=false)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = getNomeVarSessaoComApl($varParam);
    }

    if(isset($_SESSION[$varParam])){
        $retParam =  $_SESSION[$varParam];
    }else{
        $retParam = '';
    }
    return $retParam;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function setarVarsLogin($aUsuario)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $vendLoja = 0;
    $reg = $aUsuario[0];
    $privAdmin          = $reg['priv_admin'];
    $usr_priv_admin     = ($privAdmin == 'Y') ? TRUE : FALSE;
    $usr_name           = $reg['nome'];
    $usr_email          = $reg['email'];
    $tipoUsuario        = $reg['tp_usuario'];
    $nomeAbCli          = $reg['nome_ab_cli'];
    $usr_login          = strtoupper($reg['login']);
    $usuario            = $reg['usuario'];
    $aprovador          = $reg['log_aprovador'];
    $idUsuario          = $reg['id'];
    $percPartComis      = $reg['perc_participacao_comis'];
    $logTodosCliente    = $reg['log_todos_clientes'];
    $nomeClienteIni     =  '';
    $nomeClienteFim     =  'zzzzzzzzzzzzzzzzz';
    $nomeRepresIni      = '';
    $nomeRepresFim      = 'zzzzzzzzzzzzzzzzzzzz';
    $prepostoIni        = '';
    $prepostoFim        = 'zzzzzzzzzzzzzzzzzzzz';
    $codRepIni		    = 0;
    $codRepFim		    = 99999;
    $aplicacaoPrincipal = 'container_ini_repres';

    switch($tipoUsuario)
    {
        case 1: 
            $nomeClienteIni  = $nomeAbCli;
            $nomeClienteFim  = $nomeAbCli;
            break;
        case 2: 
            $nomeRepresIni      = 	$usr_login;
            $nomeRepresFim      = 	$usr_login;
            $codRepIni          = buscarCodRep($usr_login);
            $codRepFim          = $codRepIni;
            $classe             = getClasseVendedor($codRepIni);

            if(strstr(getClasseVendInterno(), $classe) <> false) {
                $vendLoja = 1;
            }
            break;

        case 5: 
            $nomeRepresIni       = 	$usuario;
            $nomeRepresFim       = 	$usuario;
            $prepostoIni         = 	$usr_login;
            $prepostoFim         =  $usr_login;
            $codRepIni		  	 = buscarCodRep($usuario);
            $codRepFim		     = $codRepIni;
            break;
    }
    $lExistDb = sincrBdConsulta($idUsuario);

    $inicio_sessao = date('d-m-Y H:i:s');
    $nomeVarLogin = $this->getNomeVarLoginSessao();
    $_SESSION[$nomeVarLogin]            = $usr_login;
    $_SESSION['glo_usr_priv_admin']     = $usr_priv_admin;
    $_SESSION['glo_usr_name']           = $usr_name;
    $_SESSION['glo_usr_email']          = $usr_email;
    $_SESSION['glo_nomeClienteIni']     = $nomeClienteIni;
    $_SESSION['glo_nomeClienteFim']     = $nomeClienteFim;
    $_SESSION['glo_nomeRepresIni']      = $nomeRepresIni;
    $_SESSION['glo_nomeRepresFim']      = $nomeRepresFim;
    $_SESSION['glo_codRepIni']          = $codRepIni;
    $_SESSION['glo_codRepFim']          = $codRepFim;
    $_SESSION['glo_prepostoIni']        = $prepostoIni;
    $_SESSION['glo_prepostoFim']        = $prepostoFim;
    $_SESSION['glo_tipoUsuario']        = $tipoUsuario;
    $_SESSION['glo_aplicacaoPrincipal'] = $aplicacaoPrincipal;
    $_SESSION['glo_inicio_sessao']      = $inicio_sessao;
    $_SESSION['glo_aprovador']          = $aprovador;

    setVarSessao(getParamVendLoja(),$vendLoja);
    setVarSessao('id_usuario',$idUsuario);
    setVarSessao($this->getNomeVarPercParComis(),$percPartComis);
    setVarSessao($this->getNomeVarTodosCliente(),$logTodosCliente);




$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function logar($login,$pswd)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLogin($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
      $this->setarVarsLogin($aUsuario);
      $this->atualizarParametros();
    }

	return $erro;


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getNomeRepresSessao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $nomeRepresIni = $this->getVarSessao('glo_nomeRepresIni');
    if($nomeRepresIni == ''){
        $nomeRepresFim = 'zzzzzzzzzzzzzzzz';
    }else{
        $nomeRepresFim = $nomeRepresIni;
    }
    $aRetorno = array('nome_repres_ini' => $nomeRepresIni, 'nome_repres_fim' => $nomeRepresFim);
    return  $aRetorno;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function aplicarPermissoesSC($login)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  



    $sql = "SELECT 
		nome_aplicacao,
		acesso_permitido,
		insercao_permitida,
		exclusao_permitida,
		alteracao_permitida,
		exportacao_permitida,
		impressao_permitida
	      FROM PUB.grupos_aplicacoes
	      WHERE cod_grupo IN
	          (SELECT
		       cod_grupo
		   FROM
		       PUB.usuarios_grupos 
		   WHERE
		       login_usuario = '$login')
		       and (acesso_permitido ='Y' or insercao_permitida = 'Y' or 
		            exclusao_permitida = 'Y' or alteracao_permitida = 'Y' or 
		            exportacao_permitida = 'Y' or impressao_permitida = 'Y')";
    $aRegs = $this->getRegsSqlLivre($sql,
        'nome_aplicacao,
		        acesso_permitido,
		        insercao_permitida,
		        exclusao_permitida,
		        alteracao_permitida,
		        exportacao_permitida,
		        impressao_permitida',
        'espec') ;
    if(is_array($aRegs)){
        foreach ($aRegs as $prog) {
            $nomeAplicacao   	 = $prog['nome_aplicacao'];
            $acessoPermitido 	 = $prog['acesso_permitido'] ;
            $insercaoPermitida 	 = $prog['insercao_permitida'];
            $exclusaoPermitida 	 = $prog['exclusao_permitida'];
            $alteracaoPermitida	 = $prog['alteracao_permitida'];
            $exportacaoPermitida = $prog['exportacao_permitida'];
            $impressaoPermitida  = $prog['impressao_permitida'];

            if( $acessoPermitido == 'Y')
            {
                $_SESSION['scriptcase']['sc_apl_seg'][$nomeAplicacao] = "on";;
                $aApl[$nomeAplicacao] = '' ;
            }
            else
            {   if(!isset($aApl[$nomeAplicacao])){
                    $_SESSION['scriptcase']['sc_apl_seg'][$nomeAplicacao] = "off";;
                }else{
                    continue;
                }
            }

            $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['insert'] = $this->has_priv($insercaoPermitida);
            $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['delete'] = $this->has_priv($exclusaoPermitida);
            $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['update'] = $this->has_priv($alteracaoPermitida);
            $export_permission = 'btn_display_'. $this->has_priv($exportacaoPermitida);
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['xls'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['xls'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'xls';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['word'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['word'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['word'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['word'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'word';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['pdf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['pdf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'pdf';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['xml'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['xml'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'xml';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['csv'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['csv'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'csv';
}
;
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['rtf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['rtf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'rtf';
}
;
            $export_permission = 'btn_display_'. $this->has_priv($impressaoPermitida);
            if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['print'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['btn_display']['print'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['print'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao]['field_display']['print'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$nomeAplicacao][$export_permission] = 'print';
}
;
        }
        $this->Ini->NM_gera_log_insert("User", 'login', "Login OK");
    }
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function limparLogin($logLimparPerfilPai=false)
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
if (!isset($_SESSION['inicio_sessao'])) {$_SESSION['inicio_sessao'] = "";}
if (!isset($this->sc_temp_inicio_sessao)) {$this->sc_temp_inicio_sessao = (isset($_SESSION['inicio_sessao'])) ? $_SESSION['inicio_sessao'] : "";}
if (!isset($_SESSION['aplicacaoPrincipal'])) {$_SESSION['aplicacaoPrincipal'] = "";}
if (!isset($this->sc_temp_aplicacaoPrincipal)) {$this->sc_temp_aplicacaoPrincipal = (isset($_SESSION['aplicacaoPrincipal'])) ? $_SESSION['aplicacaoPrincipal'] : "";}
if (!isset($_SESSION['tipoUsuario'])) {$_SESSION['tipoUsuario'] = "";}
if (!isset($this->sc_temp_tipoUsuario)) {$this->sc_temp_tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";}
if (!isset($_SESSION['prepostoFim'])) {$_SESSION['prepostoFim'] = "";}
if (!isset($this->sc_temp_prepostoFim)) {$this->sc_temp_prepostoFim = (isset($_SESSION['prepostoFim'])) ? $_SESSION['prepostoFim'] : "";}
if (!isset($_SESSION['prepostoIni'])) {$_SESSION['prepostoIni'] = "";}
if (!isset($this->sc_temp_prepostoIni)) {$this->sc_temp_prepostoIni = (isset($_SESSION['prepostoIni'])) ? $_SESSION['prepostoIni'] : "";}
if (!isset($_SESSION['codRepFim'])) {$_SESSION['codRepFim'] = "";}
if (!isset($this->sc_temp_codRepFim)) {$this->sc_temp_codRepFim = (isset($_SESSION['codRepFim'])) ? $_SESSION['codRepFim'] : "";}
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
if (!isset($_SESSION['nomeRepresFim'])) {$_SESSION['nomeRepresFim'] = "";}
if (!isset($this->sc_temp_nomeRepresFim)) {$this->sc_temp_nomeRepresFim = (isset($_SESSION['nomeRepresFim'])) ? $_SESSION['nomeRepresFim'] : "";}
if (!isset($_SESSION['nomeRepresIni'])) {$_SESSION['nomeRepresIni'] = "";}
if (!isset($this->sc_temp_nomeRepresIni)) {$this->sc_temp_nomeRepresIni = (isset($_SESSION['nomeRepresIni'])) ? $_SESSION['nomeRepresIni'] : "";}
if (!isset($_SESSION['nomeClienteFim'])) {$_SESSION['nomeClienteFim'] = "";}
if (!isset($this->sc_temp_nomeClienteFim)) {$this->sc_temp_nomeClienteFim = (isset($_SESSION['nomeClienteFim'])) ? $_SESSION['nomeClienteFim'] : "";}
if (!isset($_SESSION['nomeClienteIni'])) {$_SESSION['nomeClienteIni'] = "";}
if (!isset($this->sc_temp_nomeClienteIni)) {$this->sc_temp_nomeClienteIni = (isset($_SESSION['nomeClienteIni'])) ? $_SESSION['nomeClienteIni'] : "";}
if (!isset($_SESSION['usr_name'])) {$_SESSION['usr_name'] = "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($_SESSION['usr_priv_admin'])) {$_SESSION['usr_priv_admin'] = "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($_SESSION['usr_email'])) {$_SESSION['usr_email'] = "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    if($logLimparPerfilPai){
        limparVarSessao('perfil_pai');
    }
    
    unset($_SESSION['scriptcase']['sc_apl_seg']);unset($_SESSION['scriptcase']['pass']);unset($_SESSION['usr_login']);
 unset($this->sc_temp_usr_login);
 unset($_SESSION['usr_email']);
 unset($this->sc_temp_usr_email);
 unset($_SESSION['usr_priv_admin']);
 unset($this->sc_temp_usr_priv_admin);
 unset($_SESSION['usr_name']);
 unset($this->sc_temp_usr_name);
 unset($_SESSION['nomeClienteIni']);
 unset($this->sc_temp_nomeClienteIni);
 unset($_SESSION['nomeClienteFim']);
 unset($this->sc_temp_nomeClienteFim);
 unset($_SESSION['nomeRepresIni']);
 unset($this->sc_temp_nomeRepresIni);
 unset($_SESSION['nomeRepresFim']);
 unset($this->sc_temp_nomeRepresFim);
 unset($_SESSION['codRepIni']);
 unset($this->sc_temp_codRepIni);
 unset($_SESSION['codRepFim']);
 unset($this->sc_temp_codRepFim);
 unset($_SESSION['prepostoIni']);
 unset($this->sc_temp_prepostoIni);
 unset($_SESSION['prepostoFim']);
 unset($this->sc_temp_prepostoFim);
 unset($_SESSION['tipoUsuario']);
 unset($this->sc_temp_tipoUsuario);
 unset($_SESSION['aplicacaoPrincipal']);
 unset($this->sc_temp_aplicacaoPrincipal);
 unset($_SESSION['inicio_sessao']);
 unset($this->sc_temp_inicio_sessao);
;
    $_SESSION['scriptcase']['sc_apl_conf']['ap_form_add_users']['start'] = 'new';

    $listaVar = "glo_usr_priv_admin,glo_usr_name,
    glo_usr_email,glo_nomeClienteIni,glo_nomeClienteFim,glo_nomeRepresIni,
    glo_nomeRepresFim,glo_codRepIni,glo_codRepFim,glo_prepostoIni,
    glo_prepostoFim,glo_tipoUsuario,glo_aplicacaoPrincipal,glo_inicio_sessao,id_usuario,lista_nom_repres_ger,lista_cod_repres_ger";
    $listaVar = $this->util_incr_valor($listaVar,$this->getNomeVarPercParComis()) ;
    $listaVar = $this->util_incr_valor($listaVar,$this->getNomeVarLoginSessao()) ;
    $listaVar = $this->util_incr_valor($listaVar,getParamVendLoja()) ;
    $listaVar = $this->util_incr_valor($listaVar,getNomeVarIndFinan()) ;
    $listaVar = $this->util_incr_valor($listaVar,'lista_cps_definida') ;
    $this->limparListaCpsSessao();
    limparVarSessao($listaVar);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_email)) {$_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_priv_admin)) {$_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) {$_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_nomeClienteIni)) {$_SESSION['nomeClienteIni'] = $this->sc_temp_nomeClienteIni;}
if (isset($this->sc_temp_nomeClienteFim)) {$_SESSION['nomeClienteFim'] = $this->sc_temp_nomeClienteFim;}
if (isset($this->sc_temp_nomeRepresIni)) {$_SESSION['nomeRepresIni'] = $this->sc_temp_nomeRepresIni;}
if (isset($this->sc_temp_nomeRepresFim)) {$_SESSION['nomeRepresFim'] = $this->sc_temp_nomeRepresFim;}
if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
if (isset($this->sc_temp_codRepFim)) {$_SESSION['codRepFim'] = $this->sc_temp_codRepFim;}
if (isset($this->sc_temp_prepostoIni)) {$_SESSION['prepostoIni'] = $this->sc_temp_prepostoIni;}
if (isset($this->sc_temp_prepostoFim)) {$_SESSION['prepostoFim'] = $this->sc_temp_prepostoFim;}
if (isset($this->sc_temp_tipoUsuario)) {$_SESSION['tipoUsuario'] = $this->sc_temp_tipoUsuario;}
if (isset($this->sc_temp_aplicacaoPrincipal)) {$_SESSION['aplicacaoPrincipal'] = $this->sc_temp_aplicacaoPrincipal;}
if (isset($this->sc_temp_inicio_sessao)) {$_SESSION['inicio_sessao'] = $this->sc_temp_inicio_sessao;}
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function inicioAplicacao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    if (isset($_SESSION['scriptcase']['sc_apl_conf']['ap_form_add_users']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['ap_form_add_users']);
}
;
    if (isset($_SESSION['scriptcase']['sc_apl_conf']['ap_retrieve_pswd']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['ap_retrieve_pswd']);
}
;
    $_SESSION['scriptcase']['sc_apl_conf']['ap_form_add_users']['start'] = 'new';
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getLoginCorrente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarLoginSessao());


$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getPercPartComisCorrente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarPercParComis());

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function getTodosClienteCorrente()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTodosCliente());

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function limparListaCpsSessao()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $aLista =$this->getVarSessao('lista_cps_definida');
    if(is_array($aLista)){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $variavel = $aLista[$i];
            unset($_SESSION[$variavel]);
        }
    }

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
function verifUsuarioCorrenteAdmin()
{
$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'on';
  
    $log= 0;

    $tipo = getTipoUsuarioCorrente();
    if($tipo <> 2 and $tipo <> 5){
        $log = 1;
    }
    return $log;

$_SESSION['scriptcase']['cons_item_qt_imp_union']['contr_erro'] = 'off';
}
}
?>
