<?php
class cons_cta_corren_custo_distr_bkp_grid
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
   var $calc_saldo;
   var $id;
   var $data;
   var $historico;
   var $tipo_movto;
   var $valor;
   var $cod_proc_fornec_pedido;
   var $codigo_erp;
   var $descricao_item;
   var $container;
   var $situacao_container;
   var $sit_acomp_container;
   var $cod_emit_forn;
   var $fornec_pi;
   var $dt_registro_pedido;
   var $origem;
   var $id_origem;
   var $dt_prev_chegada;
   var $dt_recebto;
   var $look_tipo_movto;
   var $look_situacao_container;

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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total")
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
       { 
          include_once($this->Ini->path_embutida . "cons_cta_corren_custo_distr_bkp/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
          include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new cons_cta_corren_custo_distr_bkp_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
   } 
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
    if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=3>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['cons_cta_corren_custo_distr_bkp'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['save_grid']);
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("pt_br");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'] = array();
   }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5_cap']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5_cap'] as $Cod => $Parms) {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][$Cod] = $Parms;
           }
       }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] = "N";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("cons_cta_corren_custo_distr_bkp", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
   $this->nmgp_botoes['new']    = "on";
   $this->nmgp_botoes['insert'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['gridsavesession'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_resumo'])) 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->data = (isset($Busca_temp['data'])) ? $Busca_temp['data'] : ""; 
       $tmp_pos = (is_string($this->data)) ? strpos($this->data, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->data))
       {
           $this->data = substr($this->data, 0, $tmp_pos);
       }
       $data_2 = (isset($Busca_temp['data_input_2'])) ? $Busca_temp['data_input_2'] : ""; 
       $this->data_2 = $data_2; 
       $this->historico = (isset($Busca_temp['historico'])) ? $Busca_temp['historico'] : ""; 
       $tmp_pos = (is_string($this->historico)) ? strpos($this->historico, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->historico))
       {
           $this->historico = substr($this->historico, 0, $tmp_pos);
       }
       $historico_2 = (isset($Busca_temp['historico_input_2'])) ? $Busca_temp['historico_input_2'] : ""; 
       $this->historico_2 = $historico_2; 
       $this->valor = (isset($Busca_temp['valor'])) ? $Busca_temp['valor'] : ""; 
       $tmp_pos = (is_string($this->valor)) ? strpos($this->valor, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->valor))
       {
           $this->valor = substr($this->valor, 0, $tmp_pos);
       }
       $valor_2 = (isset($Busca_temp['valor_input_2'])) ? $Busca_temp['valor_input_2'] : ""; 
       $this->valor_2 = $valor_2; 
       $this->descricao_item = (isset($Busca_temp['descricao_item'])) ? $Busca_temp['descricao_item'] : ""; 
       $tmp_pos = (is_string($this->descricao_item)) ? strpos($this->descricao_item, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->descricao_item))
       {
           $this->descricao_item = substr($this->descricao_item, 0, $tmp_pos);
       }
       $this->codigo_erp = (isset($Busca_temp['codigo_erp'])) ? $Busca_temp['codigo_erp'] : ""; 
       $tmp_pos = (is_string($this->codigo_erp)) ? strpos($this->codigo_erp, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->codigo_erp))
       {
           $this->codigo_erp = substr($this->codigo_erp, 0, $tmp_pos);
       }
       $codigo_erp_2 = (isset($Busca_temp['codigo_erp_input_2'])) ? $Busca_temp['codigo_erp_input_2'] : ""; 
       $this->codigo_erp_2 = $codigo_erp_2; 
       $this->container = (isset($Busca_temp['container'])) ? $Busca_temp['container'] : ""; 
       $tmp_pos = (is_string($this->container)) ? strpos($this->container, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->container))
       {
           $this->container = substr($this->container, 0, $tmp_pos);
       }
       $container_2 = (isset($Busca_temp['container_input_2'])) ? $Busca_temp['container_input_2'] : ""; 
       $this->container_2 = $container_2; 
       $this->cod_emit_forn = (isset($Busca_temp['cod_emit_forn'])) ? $Busca_temp['cod_emit_forn'] : ""; 
       $tmp_pos = (is_string($this->cod_emit_forn)) ? strpos($this->cod_emit_forn, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->cod_emit_forn))
       {
           $this->cod_emit_forn = substr($this->cod_emit_forn, 0, $tmp_pos);
       }
       $cod_emit_forn_2 = (isset($Busca_temp['cod_emit_forn_input_2'])) ? $Busca_temp['cod_emit_forn_input_2'] : ""; 
       $this->cod_emit_forn_2 = $cod_emit_forn_2; 
       $this->fornec_pi = (isset($Busca_temp['fornec_pi'])) ? $Busca_temp['fornec_pi'] : ""; 
       $tmp_pos = (is_string($this->fornec_pi)) ? strpos($this->fornec_pi, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->fornec_pi))
       {
           $this->fornec_pi = substr($this->fornec_pi, 0, $tmp_pos);
       }
       $fornec_pi_2 = (isset($Busca_temp['fornec_pi_input_2'])) ? $Busca_temp['fornec_pi_input_2'] : ""; 
       $this->fornec_pi_2 = $fornec_pi_2; 
       $this->cod_proc_fornec_pedido = (isset($Busca_temp['cod_proc_fornec_pedido'])) ? $Busca_temp['cod_proc_fornec_pedido'] : ""; 
       $tmp_pos = (is_string($this->cod_proc_fornec_pedido)) ? strpos($this->cod_proc_fornec_pedido, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->cod_proc_fornec_pedido))
       {
           $this->cod_proc_fornec_pedido = substr($this->cod_proc_fornec_pedido, 0, $tmp_pos);
       }
       $cod_proc_fornec_pedido_2 = (isset($Busca_temp['cod_proc_fornec_pedido_input_2'])) ? $Busca_temp['cod_proc_fornec_pedido_input_2'] : ""; 
       $this->cod_proc_fornec_pedido_2 = $cod_proc_fornec_pedido_2; 
       $this->dt_prev_chegada = (isset($Busca_temp['dt_prev_chegada'])) ? $Busca_temp['dt_prev_chegada'] : ""; 
       $tmp_pos = (is_string($this->dt_prev_chegada)) ? strpos($this->dt_prev_chegada, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_prev_chegada))
       {
           $this->dt_prev_chegada = substr($this->dt_prev_chegada, 0, $tmp_pos);
       }
       $dt_prev_chegada_2 = (isset($Busca_temp['dt_prev_chegada_input_2'])) ? $Busca_temp['dt_prev_chegada_input_2'] : ""; 
       $this->dt_prev_chegada_2 = $dt_prev_chegada_2; 
       $this->dt_recebto = (isset($Busca_temp['dt_recebto'])) ? $Busca_temp['dt_recebto'] : ""; 
       $tmp_pos = (is_string($this->dt_recebto)) ? strpos($this->dt_recebto, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_recebto))
       {
           $this->dt_recebto = substr($this->dt_recebto, 0, $tmp_pos);
       }
       $dt_recebto_2 = (isset($Busca_temp['dt_recebto_input_2'])) ? $Busca_temp['dt_recebto_input_2'] : ""; 
       $this->dt_recebto_2 = $dt_recebto_2; 
       $this->dt_registro_pedido = (isset($Busca_temp['dt_registro_pedido'])) ? $Busca_temp['dt_registro_pedido'] : ""; 
       $tmp_pos = (is_string($this->dt_registro_pedido)) ? strpos($this->dt_registro_pedido, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_registro_pedido))
       {
           $this->dt_registro_pedido = substr($this->dt_registro_pedido, 0, $tmp_pos);
       }
       $dt_registro_pedido_2 = (isset($Busca_temp['dt_registro_pedido_input_2'])) ? $Busca_temp['dt_registro_pedido_input_2'] : ""; 
       $this->dt_registro_pedido_2 = $dt_registro_pedido_2; 
       $this->tipo_movto = (isset($Busca_temp['tipo_movto'])) ? $Busca_temp['tipo_movto'] : ""; 
       $tmp_pos = (is_string($this->tipo_movto)) ? strpos($this->tipo_movto, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->tipo_movto))
       {
           $this->tipo_movto = substr($this->tipo_movto, 0, $tmp_pos);
       }
       $this->situacao_container = (isset($Busca_temp['situacao_container'])) ? $Busca_temp['situacao_container'] : ""; 
       $tmp_pos = (is_string($this->situacao_container)) ? strpos($this->situacao_container, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->situacao_container))
       {
           $this->situacao_container = substr($this->situacao_container, 0, $tmp_pos);
       }
       $this->sit_acomp_container = (isset($Busca_temp['sit_acomp_container'])) ? $Busca_temp['sit_acomp_container'] : ""; 
       $tmp_pos = (is_string($this->sit_acomp_container)) ? strpos($this->sit_acomp_container, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->sit_acomp_container))
       {
           $this->sit_acomp_container = substr($this->sit_acomp_container, 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->data_2 = ""; 
       $this->dt_prev_chegada_2 = ""; 
       $this->dt_recebto_2 = ""; 
       $this->dt_registro_pedido_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "muda_qt_linhas";
   } 
       ob_start(); 
   $_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
if (!isset($_SESSION['data_saldo'])) {$_SESSION['data_saldo'] = "";}
if (!isset($this->sc_temp_data_saldo)) {$this->sc_temp_data_saldo = (isset($_SESSION['data_saldo'])) ? $_SESSION['data_saldo'] : "";}
if (!isset($_SESSION['sd_anterior'])) {$_SESSION['sd_anterior'] = "";}
if (!isset($this->sc_temp_sd_anterior)) {$this->sc_temp_sd_anterior = (isset($_SESSION['sd_anterior'])) ? $_SESSION['sd_anterior'] : "";}
   unset($_SESSION['sd_anterior']);
 unset($this->sc_temp_sd_anterior);
 unset($_SESSION['data_saldo']);
 unset($this->sc_temp_data_saldo);
;
$aSd = $this->calcularSaldoAnteriorDistrCusto($this->sc_where_atual );
$sd_anterior = $aSd['saldo'];
$data_saldo  = $aSd['data'];
 if (isset($sd_anterior)) {$this->sc_temp_sd_anterior = $sd_anterior;}
;
 if (isset($data_saldo)) {$this->sc_temp_data_saldo = $data_saldo;}
;
if (isset($this->sc_temp_sd_anterior)) {$_SESSION['sd_anterior'] = $this->sc_temp_sd_anterior;}
if (isset($this->sc_temp_data_saldo)) {$_SESSION['data_saldo'] = $this->sc_temp_data_saldo;}
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_cta_corren_custo_distr_bkp'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_cta_corren_custo_distr_bkp'];

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

   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['insert'] != '')
   {
       $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['insert'];
       $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['insert'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['update'] != '')
   {
       $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['update'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['delete'] != '')
   {
       $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_custo_distr']['delete'];
   }
   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "cons_cta_corren_custo_distr_bkp_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new cons_cta_corren_custo_distr_bkp_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] = 30;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['rows'];  
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['rows']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_total_geral']  = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral']);
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!$GLOBALS['nm_restore_grid_save'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['prim_cons'] || !empty($nmgp_parms)) )  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'] = "";
   }   
   $GLOBALS['nm_restore_grid_save'] = false;
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total") 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] == "all") 
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'];
           $this->Tot->$Gb_geral();
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1] ;  
           $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1];
       } 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total']);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total")
       { 
           $this->totaliza_php_sc_free_total() ; 
       } 
       else 
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'];
           $this->Tot->$Gb_geral();
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = 0; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'];
   }
//----- 
    if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT ID, str_replace (convert(char(10),DATA,102), '.', '-') + ' ' + convert(char(8),DATA,20), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT ID, DATA, HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT ID, convert(char(23),DATA,121), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT ID, DATA, HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
    elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT ID, EXTEND(DATA, YEAR TO DAY), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
   else 
   { 
       $nmgp_select = "SELECT ID, DATA, HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order    = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc']; 
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
   if (empty($nmgp_order_by))
   {
       $nmgp_order_by = " order by ID";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->id = $this->rs_grid->fields[0] ;  
       $this->id = (string)$this->id;
       $this->data = $this->rs_grid->fields[1] ;  
       $this->historico = $this->rs_grid->fields[2] ;  
       $this->tipo_movto = $this->rs_grid->fields[3] ;  
       $this->tipo_movto = (string)$this->tipo_movto;
       $this->valor = $this->rs_grid->fields[4] ;  
       $this->valor =  str_replace(",", ".", $this->valor);
       $this->valor = (string)$this->valor;
       $this->cod_proc_fornec_pedido = $this->rs_grid->fields[5] ;  
       $this->codigo_erp = $this->rs_grid->fields[6] ;  
       $this->descricao_item = $this->rs_grid->fields[7] ;  
       $this->container = $this->rs_grid->fields[8] ;  
       $this->container = (string)$this->container;
       $this->situacao_container = $this->rs_grid->fields[9] ;  
       $this->situacao_container = (string)$this->situacao_container;
       $this->sit_acomp_container = $this->rs_grid->fields[10] ;  
       $this->sit_acomp_container = (string)$this->sit_acomp_container;
       $this->cod_emit_forn = $this->rs_grid->fields[11] ;  
       $this->cod_emit_forn = (string)$this->cod_emit_forn;
       $this->fornec_pi = $this->rs_grid->fields[12] ;  
       $this->fornec_pi = (string)$this->fornec_pi;
       $this->dt_registro_pedido = $this->rs_grid->fields[13] ;  
       $this->origem = $this->rs_grid->fields[14] ;  
       $this->id_origem = $this->rs_grid->fields[15] ;  
       $this->id_origem = (string)$this->id_origem;
       $this->dt_prev_chegada = $this->rs_grid->fields[16] ;  
       $this->dt_recebto = $this->rs_grid->fields[17] ;  
       $GLOBALS["sit_acomp_container"] = $this->rs_grid->fields[10] ;  
       $GLOBALS["sit_acomp_container"] = (string)$GLOBALS["sit_acomp_container"] ;
       $GLOBALS["cod_emit_forn"] = $this->rs_grid->fields[11] ;  
       $GLOBALS["cod_emit_forn"] = (string)$GLOBALS["cod_emit_forn"] ;
       $GLOBALS["fornec_pi"] = $this->rs_grid->fields[12] ;  
       $GLOBALS["fornec_pi"] = (string)$GLOBALS["fornec_pi"] ;
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->id = $this->rs_grid->fields[0] ;  
           $this->data = $this->rs_grid->fields[1] ;  
           $this->historico = $this->rs_grid->fields[2] ;  
           $this->tipo_movto = $this->rs_grid->fields[3] ;  
           $this->valor = $this->rs_grid->fields[4] ;  
           $this->cod_proc_fornec_pedido = $this->rs_grid->fields[5] ;  
           $this->codigo_erp = $this->rs_grid->fields[6] ;  
           $this->descricao_item = $this->rs_grid->fields[7] ;  
           $this->container = $this->rs_grid->fields[8] ;  
           $this->situacao_container = $this->rs_grid->fields[9] ;  
           $this->sit_acomp_container = $this->rs_grid->fields[10] ;  
           $this->cod_emit_forn = $this->rs_grid->fields[11] ;  
           $this->fornec_pi = $this->rs_grid->fields[12] ;  
           $this->dt_registro_pedido = $this->rs_grid->fields[13] ;  
           $this->origem = $this->rs_grid->fields[14] ;  
           $this->id_origem = $this->rs_grid->fields[15] ;  
           $this->dt_prev_chegada = $this->rs_grid->fields[16] ;  
           $this->dt_recebto = $this->rs_grid->fields[17] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['print_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE html>\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Conta Corrente  - Distribuição de Custo - Saldo Anterior:" . $_SESSION['sd_anterior'] . "</TITLE>\r\n");
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'] && !$this->Ini->sc_export_ajax)
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_cta_corren_custo_distr_bkp_jquery_5070.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_cta_corren_custo_distr_bkp_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_cta_corren_custo_distr_bkp_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida']) {  
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
           $nm_saida->saida("    scFixCol_selectedFields = [\"0\"];\r\n");
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
           $nm_saida->saida("        for (i = 1; i <= columnId; i++) {\r\n");
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
           $nm_saida->saida("    for (i = 1; i <= columnId; i++) {\r\n");
           $nm_saida->saida("        $(\".sc-op-fix-col-\" + i).removeClass(\"sc-op-fix-col-notfixed\").addClass(\"sc-op-fix-col-fixed\");\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("function scFixCol_addFixedCells()\r\n");
           $nm_saida->saida("{\r\n");
           $nm_saida->saida("    selectedFields = $(\".sc-ui-grid-header-row-cons_cta_corren_custo_distr_bkp-1 .sc-op-fix-col.sc-op-fix-col-fixed\");\r\n");
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida']) { 
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
           $nm_saida->saida("        #sc-fld-fix-col-0 {\r\n");
           $nm_saida->saida("            display: none;\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("    </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid']) . ";\r\n");
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
           $nm_saida->saida("        let cells = $(\".sc-ui-grid-header-row-cons_cta_corren_custo_distr_bkp-1\").find(\"td\");\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    function scSetFixedHeadersCss(baseTop)\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let rows, cols, i, j, thisTop;\r\n");
           $nm_saida->saida("        rows = $(\".sc-ui-grid-header-row-cons_cta_corren_custo_distr_bkp-1\");\r\n");
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
           $nm_saida->saida("   var gridHeaders = $(\".sc-ui-grid-header-row-cons_cta_corren_custo_distr_bkp-1\"), headerDisplayed = true;\r\n");
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
           $nm_saida->saida("   tableOriginal = document.getElementById(\"sc-ui-grid-body-40ba01a7\");\r\n");
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ancor_save']);
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
           $nm_saida->saida("   function scBtnSaveGridShow(origem, embbed, pos, format, tipo) {\r\n");
     if (!$_SESSION['scriptcase']['proc_mobile']) { 
           $nm_saida->saida("     if(format == 'simplified')\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("       if($(\"#id_save_grid_div_\" + pos).parent().hasClass('scBtnGrpText'))\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("           id_parent_btn = $(\"#id_save_grid_div_\" + pos).closest('table').prev().attr('id');\r\n");
           $nm_saida->saida("           saveGrid = $(\"#id_div_save_grid_new_\" + pos).detach();\r\n");
           $nm_saida->saida("           $(\"#\" + id_parent_btn).append(saveGrid);\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       if(tipo == '')\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("         tipo = 'save';\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       if ($(\"#id_div_save_grid_new_\" + pos).css('display') != 'none') {\r\n");
               $nm_saida->saida("         $(\"#save_grid_\" + pos).removeClass(\"selected\");\r\n");
           $nm_saida->saida("         $(\"#id_div_save_grid_new_\" + pos).hide();\r\n");
               $nm_saida->saida("         return;\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("         if ($(\"#sc_id_save_grid_placeholder_\" + pos).css('display') != 'none') {\r\n");
               $nm_saida->saida("             $(\"#save_grid_\" + pos).removeClass(\"selected\");\r\n");
               $nm_saida->saida("             scBtnSaveGridHide(pos);\r\n");
               $nm_saida->saida("             return;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("       }\r\n");
     }
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"POST\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: \"cons_cta_corren_custo_distr_bkp_save_grid.php\",\r\n");
           $nm_saida->saida("       data: \"str_save_grid_option=\"+ tipo +\"&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . $this->Ini->sc_page . "&script_origem=\" + origem + \"&embbed_groupby=\" + embbed + \"&toolbar_pos=\" + pos + \"&format=\" + format\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("     if($(\"#id_div_save_grid_new_\" + pos).length > 0)\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("       str_width  = $(document).width();\r\n");
           $nm_saida->saida("       str_height = $(document).height();\r\n");
           $nm_saida->saida("       $(\"#id_div_save_grid_new_\" + pos).html(data);\r\n");
           $nm_saida->saida("       $(\"#id_div_save_grid_new_\" + pos).show();\r\n");
           $nm_saida->saida("       saveGridAdjustHeightWidth(pos, str_width, str_height);\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_save_grid_placeholder_\" + pos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
$nm_saida->saida("function scBtnSaveGridSessionResponse(opcao, parm, pos)\r\n");
$nm_saida->saida("{\r\n");
$nm_saida->saida("    $.ajax({\r\n");
$nm_saida->saida("      type: \"POST\",\r\n");
$nm_saida->saida("      url: \"cons_cta_corren_custo_distr_bkp_save_grid.php\",\r\n");
$nm_saida->saida("      data: \"ajax_ctrl=proc_ajax&script_case_init=" . $this->Ini->sc_page . "&Fsave_ok=\"+ opcao +\"&parm=\"+ parm +\"&toolbar_pos=\" + pos\r\n");
$nm_saida->saida("    })\r\n");
$nm_saida->saida("     .done(function(jsonReturn) {\r\n");
$nm_saida->saida("            var i, oResp;\r\n");
$nm_saida->saida("            Tst_integrid = jsonReturn.trim();\r\n");
$nm_saida->saida("            if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
$nm_saida->saida("             alert (jsonReturn);\r\n");
$nm_saida->saida("             return;\r\n");
$nm_saida->saida("            }\r\n");
$nm_saida->saida("            eval(\"oResp = \" + jsonReturn);\r\n");
$nm_saida->saida("            if (oResp[\"setHtml\"]) {\r\n");
$nm_saida->saida("                for (i = 0; i < oResp[\"setHtml\"].length; i++) {\r\n");
$nm_saida->saida("                    $(\"#\" + oResp[\"setHtml\"][i][\"field\"]).html(oResp[\"setHtml\"][i][\"value\"]);\r\n");
$nm_saida->saida("                }\r\n");
$nm_saida->saida("            }\r\n");
$nm_saida->saida("            if (oResp[\"setDisplay\"]) {\r\n");
$nm_saida->saida("                for (i = 0; i < oResp[\"setDisplay\"].length; i++) {\r\n");
$nm_saida->saida("                    $(\"#\" + oResp[\"setDisplay\"][i][\"field\"]).css(\"display\", oResp[\"setDisplay\"][i][\"value\"]);\r\n");
$nm_saida->saida("                }\r\n");
$nm_saida->saida("            }\r\n");
$nm_saida->saida("            if (oResp[\"Fsave_ok\"] && oResp[\"Fsave_ok\"] != '') {\r\n");
$nm_saida->saida("                  if(oResp[\"Fsave_ok\"] == 'save_conf_grid')\r\n");
$nm_saida->saida("                  {                    sweetAlertConfig = {\r\n");
$nm_saida->saida("                        customClass: {\r\n");
$nm_saida->saida("                            popup: 'scSweetAlertPopup',\r\n");
$nm_saida->saida("                            header: 'scSweetAlertHeader',\r\n");
$nm_saida->saida("                            content: 'scSweetAlertMessage',\r\n");
$nm_saida->saida("                            confirmButton: scSweetAlertConfirmButton,\r\n");
$nm_saida->saida("                            cancelButton: scSweetAlertCancelButton\r\n");
$nm_saida->saida("                        }\r\n");
$nm_saida->saida("                    };\r\n");
$nm_saida->saida("                    sweetAlertConfig['toast'] = true;\r\n");
$nm_saida->saida("                    sweetAlertConfig['showConfirmButton'] = false;\r\n");
$nm_saida->saida("                    sweetAlertConfig['showCancelButton'] = false;\r\n");
$nm_saida->saida("                    sweetAlertConfig['customClass']['popup'] = 'scToastPopup';\r\n");
$nm_saida->saida("                    sweetAlertConfig['customClass']['header'] = 'scToastHeader';\r\n");
$nm_saida->saida("                    sweetAlertConfig['customClass']['content'] = 'scToastMessage';\r\n");
$nm_saida->saida("                    sweetAlertConfig['timer'] = 3000;\r\n");
$nm_saida->saida("                    sweetAlertConfig[\"position\"] = \"top-end\";\r\n");
$nm_saida->saida("                    sweetAlertConfig[\"text\"] = \"" . $this->Ini->Nm_lang['lang_othr_savegrid_save_msge'] . "\";\r\n");
$nm_saida->saida("                    Swal.fire(sweetAlertConfig);                  }\r\n");
$nm_saida->saida("                  else if(oResp[\"Fsave_ok\"] == 'select_conf_grid')\r\n");
$nm_saida->saida("                  {\r\n");
$nm_saida->saida("                      nm_gp_move('igual', '0');\r\n");
$nm_saida->saida("                  }\r\n");
$nm_saida->saida("                  else if(oResp[\"Fsave_ok\"] == 'default')\r\n");
$nm_saida->saida("                  {\r\n");
$nm_saida->saida("                      nm_gp_move('igual', '0');\r\n");
$nm_saida->saida("                  }\r\n");
$nm_saida->saida("            }\r\n");
$nm_saida->saida("            if (oResp[\"toolbar_pos\"] && oResp[\"toolbar_pos\"] != '') {\r\n");
$nm_saida->saida("                $('#sc_btgp_div_grid_session_' + oResp[\"toolbar_pos\"]).hide();\r\n");
$nm_saida->saida("                $('#save_grid_session_' + oResp[\"toolbar_pos\"]).removeClass('selected');\r\n");
$nm_saida->saida("            }\r\n");
$nm_saida->saida("    });\r\n");
$nm_saida->saida("}\r\n");
$nm_saida->saida("function scBtnSaveGridSessionSave(pos){\r\n");
$nm_saida->saida("    scBtnSaveGridSessionResponse('save_conf_grid', 'session', pos);\r\n");
$nm_saida->saida("}\r\n");
$nm_saida->saida("function scBtnSaveGridSessionLoad(pos){\r\n");
$nm_saida->saida("    scBtnSaveGridSessionResponse('select_conf_grid', 'session', pos);\r\n");
$nm_saida->saida("}\r\n");
$nm_saida->saida("function scBtnSaveGridSessionReset(pos){\r\n");
$nm_saida->saida("    scBtnSaveGridSessionResponse('default', 'session', pos);\r\n");
$nm_saida->saida("}\r\n");
           $nm_saida->saida("   function saveGridAdjustHeightWidth(pos, str_width, str_height) {\r\n");
           $nm_saida->saida("       if(pos == 'bot')\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("           $('#id_div_save_grid_new_' + pos).css({bottom:$('#save_grid_' + pos).outerHeight()});\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       else {\r\n");
           $nm_saida->saida("           $('#id_div_save_grid_new_' + pos).css({top:$('#save_grid_' + pos).outerHeight()});\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       if(($('#save_grid_' + pos).offset().left + $('#id_div_save_grid_new_' + pos).outerWidth() +10) >= $(document).width())\r\n");
           $nm_saida->saida("       {\r\n");
           $nm_saida->saida("           $('#id_div_save_grid_new_' + pos).css('right', 0)\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("       else {\r\n");
           $nm_saida->saida("           $('#id_div_save_grid_new_' + pos).css('left', 0)\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSaveGridHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word']) {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
       }
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_cta_corren_custo_distr_bkp_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_cta_corren_custo_distr_bkp_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_cons_cta_corren_custo_distr_bkp_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("    " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert'])
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".cons_cta_corren_custo_distr_bkp_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .cons_cta_corren_custo_distr_bkp_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".cons_cta_corren_custo_distr_bkp_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida    = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['css_body_embutida'] : "";
   $this->css_remove_margin     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['link_info']['remove_margin']))     ? "margin: 0;" : "";
   $this->css_remove_border     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['link_info']['remove_border']))     ? "border-width: 0;" : "";
   $this->css_remove_background = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['link_info']['remove_background'])) ? "background-color: transparent; background-image: none;" : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] == "print")) 
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
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
          $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
          $vertical_center = '';
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $remove_background . $vertical_center . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && !$this->Print_All && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . $this->css_remove_border . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
       { 
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_A_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
       }
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_E_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_AL_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
        } 
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_cta_corren_custo_distr_bkp']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_cta_corren_custo_distr_bkp']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_cta_corren_custo_distr_bkp']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_cta_corren_custo_distr_bkp']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida']) ? "cons_cta_corren_custo_distr_bkp_" : "";
   $this->css_sep = " ";
   $this->css_id_label = $compl_css_emb . "css_id_label";
   $this->css_id_grid_line = $compl_css_emb . "css_id_grid_line";
   $this->css_data_label = $compl_css_emb . "css_data_label";
   $this->css_data_grid_line = $compl_css_emb . "css_data_grid_line";
   $this->css_historico_label = $compl_css_emb . "css_historico_label";
   $this->css_historico_grid_line = $compl_css_emb . "css_historico_grid_line";
   $this->css_tipo_movto_label = $compl_css_emb . "css_tipo_movto_label";
   $this->css_tipo_movto_grid_line = $compl_css_emb . "css_tipo_movto_grid_line";
   $this->css_valor_label = $compl_css_emb . "css_valor_label";
   $this->css_valor_grid_line = $compl_css_emb . "css_valor_grid_line";
   $this->css_calc_saldo_label = $compl_css_emb . "css_calc_saldo_label";
   $this->css_calc_saldo_grid_line = $compl_css_emb . "css_calc_saldo_grid_line";
   $this->css_cod_proc_fornec_pedido_label = $compl_css_emb . "css_cod_proc_fornec_pedido_label";
   $this->css_cod_proc_fornec_pedido_grid_line = $compl_css_emb . "css_cod_proc_fornec_pedido_grid_line";
   $this->css_codigo_erp_label = $compl_css_emb . "css_codigo_erp_label";
   $this->css_codigo_erp_grid_line = $compl_css_emb . "css_codigo_erp_grid_line";
   $this->css_descricao_item_label = $compl_css_emb . "css_descricao_item_label";
   $this->css_descricao_item_grid_line = $compl_css_emb . "css_descricao_item_grid_line";
   $this->css_container_label = $compl_css_emb . "css_container_label";
   $this->css_container_grid_line = $compl_css_emb . "css_container_grid_line";
   $this->css_situacao_container_label = $compl_css_emb . "css_situacao_container_label";
   $this->css_situacao_container_grid_line = $compl_css_emb . "css_situacao_container_grid_line";
   $this->css_sit_acomp_container_label = $compl_css_emb . "css_sit_acomp_container_label";
   $this->css_sit_acomp_container_grid_line = $compl_css_emb . "css_sit_acomp_container_grid_line";
   $this->css_cod_emit_forn_label = $compl_css_emb . "css_cod_emit_forn_label";
   $this->css_cod_emit_forn_grid_line = $compl_css_emb . "css_cod_emit_forn_grid_line";
   $this->css_fornec_pi_label = $compl_css_emb . "css_fornec_pi_label";
   $this->css_fornec_pi_grid_line = $compl_css_emb . "css_fornec_pi_grid_line";
   $this->css_dt_registro_pedido_label = $compl_css_emb . "css_dt_registro_pedido_label";
   $this->css_dt_registro_pedido_grid_line = $compl_css_emb . "css_dt_registro_pedido_grid_line";
   $this->css_origem_label = $compl_css_emb . "css_origem_label";
   $this->css_origem_grid_line = $compl_css_emb . "css_origem_grid_line";
   $this->css_id_origem_label = $compl_css_emb . "css_id_origem_label";
   $this->css_id_origem_grid_line = $compl_css_emb . "css_id_origem_grid_line";
   $this->css_dt_prev_chegada_label = $compl_css_emb . "css_dt_prev_chegada_label";
   $this->css_dt_prev_chegada_grid_line = $compl_css_emb . "css_dt_prev_chegada_grid_line";
   $this->css_dt_recebto_label = $compl_css_emb . "css_dt_recebto_label";
   $this->css_dt_recebto_grid_line = $compl_css_emb . "css_dt_recebto_grid_line";
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], 0, $trab_pos);
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
   $sc_data_cab1 = $this->nm_data->FormataSaida("j/n/Y @?#?@à@?#?@s G:i:s");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Conta Corrente  - Distribuição de Custo - Saldo Anterior:" . $_SESSION['sd_anterior'] . " - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'] && $nm_refresch_cab_rod)
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'], 0, $trab_pos);
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
   $sc_data_cab1 = $this->nm_data->FormataSaida("j/n/Y @?#?@à@?#?@s G:i:s");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Conta Corrente  - Distribuição de Custo - Saldo Anterior:" . $_SESSION['sd_anterior'] . " - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'] && $nm_refresch_cab_rod)
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
   $this->grid_fixed_column_no = 0;
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_label'])
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
   $nm_saida->saida("    <TR id=\"tit_cons_cta_corren_custo_distr_bkp__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-cons_cta_corren_custo_distr_bkp-" . $tmp_header_row . "\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_recebto_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf") {
       $classColFld = "";
       $classColTitle = "";
       $classColActions = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
           $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
           $classColTitle = " sc-col-title";
           $classColActions = " sc-col-actions";
       }
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . " sc-col-actionbar-left  " . $classColFld . $classColTitle . $classColActions . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_recebto_label'] . "\" >\r\n");
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("    .sc-col-actionbar-left {  }\r\n");
   $nm_saida->saida("    .sc-col-actionbar-left:hover {  }\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div style=\"display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline\">\r\n");
   $nm_saida->saida("    <div style=\"flex-grow: 1; text-align: center\">&nbsp;</div>\r\n");
   $nm_saida->saida("    <div style=\"display: flex; flex-wrap: nowrap; align-items: baseline\">\r\n");
   $nm_saida->saida("        <span class=\"sc-op-fix-col sc-op-fix-col-" . $this->grid_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->grid_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->grid_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>\r\n");
   $nm_saida->saida("    </div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("</TD>\r\n");
       $this->grid_fixed_column_no++;
} 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
       $this->grid_fixed_column_no++;
   } 
   $this->SC_label_rightActionBar();
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".cons_cta_corren_custo_distr_bkp_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .cons_cta_corren_custo_distr_bkp_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".cons_cta_corren_custo_distr_bkp_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cols_emb'] = count($Nm_temp) - 1;
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
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id'])) ? $this->New_label['id'] : "ID";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id']) || $this->NM_cmp_hidden['id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_data()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['data']) || $this->NM_cmp_hidden['data'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_data_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_data_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_historico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['historico']) || $this->NM_cmp_hidden['historico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_historico_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historico_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_tipo_movto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tipo_movto'])) ? $this->New_label['tipo_movto'] : "Tipo Movto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['tipo_movto']) || $this->NM_cmp_hidden['tipo_movto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_tipo_movto_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tipo_movto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_valor()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['valor'])) ? $this->New_label['valor'] : "Valor";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['valor']) || $this->NM_cmp_hidden['valor'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_valor_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_valor_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_calc_saldo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['calc_saldo'])) ? $this->New_label['calc_saldo'] : "Saldo";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['calc_saldo']) || $this->NM_cmp_hidden['calc_saldo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_calc_saldo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_calc_saldo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = 'left';
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
 function NM_label_cod_proc_fornec_pedido()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['cod_proc_fornec_pedido'])) ? $this->New_label['cod_proc_fornec_pedido'] : "Código Item Pedido Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['cod_proc_fornec_pedido']) || $this->NM_cmp_hidden['cod_proc_fornec_pedido'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_cod_proc_fornec_pedido_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_cod_proc_fornec_pedido_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_codigo_erp()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['codigo_erp'])) ? $this->New_label['codigo_erp'] : "Código ERP";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['codigo_erp']) || $this->NM_cmp_hidden['codigo_erp'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_codigo_erp_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_codigo_erp_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_descricao_item()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['descricao_item'])) ? $this->New_label['descricao_item'] : "Descrição Item";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['descricao_item']) || $this->NM_cmp_hidden['descricao_item'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_descricao_item_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_descricao_item_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['container']) || $this->NM_cmp_hidden['container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_container_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_situacao_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : "Situação Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['situacao_container']) || $this->NM_cmp_hidden['situacao_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_situacao_container_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_situacao_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_sit_acomp_container()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['sit_acomp_container'])) ? $this->New_label['sit_acomp_container'] : "Sit.Acomp. Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['sit_acomp_container']) || $this->NM_cmp_hidden['sit_acomp_container'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_sit_acomp_container_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_sit_acomp_container_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_cod_emit_forn()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['cod_emit_forn'])) ? $this->New_label['cod_emit_forn'] : "Fornecedor Container";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['cod_emit_forn']) || $this->NM_cmp_hidden['cod_emit_forn'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_cod_emit_forn_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_cod_emit_forn_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_fornec_pi()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['fornec_pi'])) ? $this->New_label['fornec_pi'] : "Fornecedor PI";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['fornec_pi']) || $this->NM_cmp_hidden['fornec_pi'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_fornec_pi_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_fornec_pi_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_dt_registro_pedido()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_registro_pedido'])) ? $this->New_label['dt_registro_pedido'] : "Dt.Registro Ped. Importação";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_registro_pedido']) || $this->NM_cmp_hidden['dt_registro_pedido'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_registro_pedido_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_registro_pedido_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_origem()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['origem'])) ? $this->New_label['origem'] : "Origem";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['origem']) || $this->NM_cmp_hidden['origem'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_origem_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_origem_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_id_origem()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['id_origem'])) ? $this->New_label['id_origem'] : "ID Origem";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['id_origem']) || $this->NM_cmp_hidden['id_origem'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_id_origem_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_id_origem_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_dt_prev_chegada()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt.Prev.Chegada";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_prev_chegada']) || $this->NM_cmp_hidden['dt_prev_chegada'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_prev_chegada_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_prev_chegada_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
 function NM_label_dt_recebto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_recebto'])) ? $this->New_label['dt_recebto'] : "Dt.Recbto";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_recebto']) || $this->NM_cmp_hidden['dt_recebto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_recebto_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_recebto_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
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
function SC_label_rightActionBar()
{
        global $nm_saida;
}
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_label'] == 'desc') {
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
            case "id":
                return true;
            case "tipo_movto":
                return true;
            case "valor":
                return true;
            case "calc_saldo":
                return true;
            case "container":
                return true;
            case "situacao_container":
                return true;
            case "sit_acomp_container":
                return true;
            case "cod_emit_forn":
                return true;
            case "fornec_pi":
                return true;
            case "id_origem":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id":
                return 'desc';
            case "data":
                return 'desc';
            case "tipo_movto":
                return 'desc';
            case "valor":
                return 'desc';
            case "container":
                return 'desc';
            case "situacao_container":
                return 'desc';
            case "sit_acomp_container":
                return 'desc';
            case "fornec_pi":
                return 'desc';
            case "id_origem":
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['id'])) ? $this->New_label['id'] : "ID";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['data'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['historico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tipo_movto'])) ? $this->New_label['tipo_movto'] : "Tipo Movto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['tipo_movto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['valor'])) ? $this->New_label['valor'] : "Valor";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['valor'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['calc_saldo'])) ? $this->New_label['calc_saldo'] : "Saldo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['calc_saldo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['cod_proc_fornec_pedido'])) ? $this->New_label['cod_proc_fornec_pedido'] : "Código Item Pedido Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['cod_proc_fornec_pedido'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['codigo_erp'])) ? $this->New_label['codigo_erp'] : "Código ERP";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['codigo_erp'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['descricao_item'])) ? $this->New_label['descricao_item'] : "Descrição Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['descricao_item'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : "Situação Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['situacao_container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['sit_acomp_container'])) ? $this->New_label['sit_acomp_container'] : "Sit.Acomp. Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['sit_acomp_container'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['cod_emit_forn'])) ? $this->New_label['cod_emit_forn'] : "Fornecedor Container";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['cod_emit_forn'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['fornec_pi'])) ? $this->New_label['fornec_pi'] : "Fornecedor PI";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['fornec_pi'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_registro_pedido'])) ? $this->New_label['dt_registro_pedido'] : "Dt.Registro Ped. Importação";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['dt_registro_pedido'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['origem'])) ? $this->New_label['origem'] : "Origem";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['origem'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['id_origem'])) ? $this->New_label['id_origem'] : "ID Origem";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['id_origem'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt.Prev.Chegada";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['dt_prev_chegada'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_recebto'])) ? $this->New_label['dt_recebto'] : "Dt.Recbto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['labels']['dt_recebto'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_cons_cta_corren_custo_distr_bkp#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cab_embutida'] != "S")
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
           if ($this->grid_emb_form_full)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_custo_distr']['lig_iframe_modal'] = "nmsc_iframe_liga_cons_cta_corren_custo_distr_bkp";
           }
           $nm_saida->saida(" <TR> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_EL_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_cons_cta_corren_custo_distr_bkp', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_cons_cta_corren_custo_distr_bkp', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_cons_cta_corren_custo_distr_bkp', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_DL_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               if (!$_SESSION['scriptcase']['proc_mobile']) {
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_D_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_cons_cta_corren_custo_distr_bkp#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_EL_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_cons_cta_corren_custo_distr_bkp#?#1\"";
   } 
   $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf") ? "padding: 0px !important;" : "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\" width=\"100%\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf']) { 
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-40ba01a7\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Page_break_PDF'] = array();
       }
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
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
          $this->Lin_impressas++;
          $this->id = $this->rs_grid->fields[0] ;  
          $this->id = (string)$this->id;
          $this->data = $this->rs_grid->fields[1] ;  
          $this->historico = $this->rs_grid->fields[2] ;  
          $this->tipo_movto = $this->rs_grid->fields[3] ;  
          $this->tipo_movto = (string)$this->tipo_movto;
          $this->valor = $this->rs_grid->fields[4] ;  
          $this->valor =  str_replace(",", ".", $this->valor);
          $this->valor = (string)$this->valor;
          $this->cod_proc_fornec_pedido = $this->rs_grid->fields[5] ;  
          $this->codigo_erp = $this->rs_grid->fields[6] ;  
          $this->descricao_item = $this->rs_grid->fields[7] ;  
          $this->container = $this->rs_grid->fields[8] ;  
          $this->container = (string)$this->container;
          $this->situacao_container = $this->rs_grid->fields[9] ;  
          $this->situacao_container = (string)$this->situacao_container;
          $this->sit_acomp_container = $this->rs_grid->fields[10] ;  
          $this->sit_acomp_container = (string)$this->sit_acomp_container;
          $this->cod_emit_forn = $this->rs_grid->fields[11] ;  
          $this->cod_emit_forn = (string)$this->cod_emit_forn;
          $this->fornec_pi = $this->rs_grid->fields[12] ;  
          $this->fornec_pi = (string)$this->fornec_pi;
          $this->dt_registro_pedido = $this->rs_grid->fields[13] ;  
          $this->origem = $this->rs_grid->fields[14] ;  
          $this->id_origem = $this->rs_grid->fields[15] ;  
          $this->id_origem = (string)$this->id_origem;
          $this->dt_prev_chegada = $this->rs_grid->fields[16] ;  
          $this->dt_recebto = $this->rs_grid->fields[17] ;  
          $GLOBALS["sit_acomp_container"] = $this->rs_grid->fields[10] ;  
          $GLOBALS["sit_acomp_container"] = (string)$GLOBALS["sit_acomp_container"];
          $GLOBALS["cod_emit_forn"] = $this->rs_grid->fields[11] ;  
          $GLOBALS["cod_emit_forn"] = (string)$GLOBALS["cod_emit_forn"];
          $GLOBALS["fornec_pi"] = $this->rs_grid->fields[12] ;  
          $GLOBALS["fornec_pi"] = (string)$GLOBALS["fornec_pi"];
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['rows_emb']++;
          $this->sc_proc_grid = true;
          $this->calc_saldo = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_acumalado'][$this->SC_seq_register]['calc_saldo'];
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              if ($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0)
              { 
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid']) {
                      $this->label_grid($linhas);
                  } 
                  $nm_houve_quebra = "N";
              } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "data")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "dt_registro_pedido")
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
              if ($temp == "dt_recebto")
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_dt_recebto_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] != "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_custo_distr']['lig_iframe_modal'] = "nmsc_iframe_liga_cons_cta_corren_custo_distr_bkp";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              $linkTarget = isset($this->Ini->sc_lig_target['A_@scinf__@scinf_form_cta_corren_custo_distr']) ? $this->Ini->sc_lig_target['A_@scinf__@scinf_form_cta_corren_custo_distr'] : (isset($this->Ini->sc_lig_target['A_@scinf_']) ? $this->Ini->sc_lig_target['A_@scinf_'] : null);
              if (isset($this->Ini->sc_lig_md5["form_cta_corren_custo_distr"]) && $this->Ini->sc_lig_md5["form_cta_corren_custo_distr"] == "S")
              {
                  $Parms_Edt  = "cta_corren_custo_distr_id*scin" . str_replace('"', "@aspasd@", $this->id) . "*scouttipo_movto_corrente*scin" . str_replace('"', "@aspasd@", $this->tipo_movto) . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'] && isset($linkTarget))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_border'] ? '1' : '0') . '*scoutremove_background*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_background'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "cta_corren_custo_distr_id*scin" . str_replace('"', "@aspasd@", $this->id) . "*scouttipo_movto_corrente*scin" . str_replace('"', "@aspasd@", $this->tipo_movto) . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "nm_gp_submit4('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_cta_corren_custo_distr', '" . $this->SC_ancora . "')", "nm_gp_submit4('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_cta_corren_custo_distr', '" . $this->SC_ancora . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("<td style=\"padding: 0px\">" . $Link_Edit . "</td>\r\n");
          $nm_saida->saida("</tr></table\r\n");
          $nm_saida->saida("></TD>\r\n");
 $this->grid_fixed_column_no++;} 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['mostra_edit'] == "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_custo_distr']['lig_iframe_modal'] = "nmsc_iframe_liga_cons_cta_corren_custo_distr_bkp";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              $linkTarget = isset($this->Ini->sc_lig_target['A_@scinf__@scinf_form_cta_corren_custo_distr']) ? $this->Ini->sc_lig_target['A_@scinf__@scinf_form_cta_corren_custo_distr'] : (isset($this->Ini->sc_lig_target['A_@scinf_']) ? $this->Ini->sc_lig_target['A_@scinf_'] : null);
              if (isset($this->Ini->sc_lig_md5["form_cta_corren_custo_distr"]) && $this->Ini->sc_lig_md5["form_cta_corren_custo_distr"] == "S")
              {
                  $Parms_Edt  = "cta_corren_custo_distr_id*scin" . str_replace('"', "@aspasd@", $this->id) . "*scouttipo_movto_corrente*scin" . str_replace('"', "@aspasd@", $this->tipo_movto) . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'] && isset($linkTarget))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_border'] ? '1' : '0') . '*scoutremove_background*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['remove_background'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "cta_corren_custo_distr_id*scin" . str_replace('"', "@aspasd@", $this->id) . "*scouttipo_movto_corrente*scin" . str_replace('"', "@aspasd@", $this->tipo_movto) . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "nm_gp_submit4('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_cta_corren_custo_distr', '" . $this->SC_ancora . "')", "nm_gp_submit4('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_cta_corren_custo_distr', '" . $this->SC_ancora . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("</tr></table>\r\n");
          $nm_saida->saida("</TD>\r\n");
 $this->grid_fixed_column_no++;} 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
              $this->grid_fixed_column_no++;
          } 
   $this->SC_grid_rightActionBar();
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
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
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_DL_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
       $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida(" </tr></table></td> </tr></table></td> </tr></table></td>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_D_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']       = "igual" ; 
   } 
 }
function SC_grid_rightActionBar()
{
        global $nm_saida;
    $dataActionbarPos = 'right';
}
 function NM_grid_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id']) || $this->NM_cmp_hidden['id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->id)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_data()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['data']) || $this->NM_cmp_hidden['data'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->data)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->data)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_data_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_data_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_data_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historico']) || $this->NM_cmp_hidden['historico'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->historico));
              $conteudo_original = NM_encode_input(sc_strip_script($this->historico));
          }
          else {
              $conteudo = sc_strip_script($this->historico); 
              $conteudo_original = sc_strip_script($this->historico); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_historico_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_historico_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tipo_movto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tipo_movto']) || $this->NM_cmp_hidden['tipo_movto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tipo_movto)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->tipo_movto)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_tipo_movto($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_tipo_movto_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_tipo_movto_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tipo_movto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_valor()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['valor']) || $this->NM_cmp_hidden['valor'] != "off") { 
          $nm_cor_num = ($this->valor < 0) ? "color:#FF3300;" : "";
          $conteudo = NM_encode_input(sc_strip_script($this->valor)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->valor)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_valor_grid_line . " " . $classColFld . "\"  style=\"" . $nm_cor_num . "" . $this->Css_Cmp['css_valor_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_valor_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_calc_saldo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['calc_saldo']) || $this->NM_cmp_hidden['calc_saldo'] != "off") { 
          $nm_cor_num = ($this->calc_saldo < 0) ? "color:#FF3300;" : "";
          $conteudo = NM_encode_input(sc_strip_script($this->calc_saldo)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->calc_saldo)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_calc_saldo_grid_line . " " . $classColFld . "\"  style=\"" . $nm_cor_num . "" . $this->Css_Cmp['css_calc_saldo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_calc_saldo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_cod_proc_fornec_pedido()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['cod_proc_fornec_pedido']) || $this->NM_cmp_hidden['cod_proc_fornec_pedido'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->cod_proc_fornec_pedido));
              $conteudo_original = NM_encode_input(sc_strip_script($this->cod_proc_fornec_pedido));
          }
          else {
              $conteudo = sc_strip_script($this->cod_proc_fornec_pedido); 
              $conteudo_original = sc_strip_script($this->cod_proc_fornec_pedido); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_cod_proc_fornec_pedido_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_cod_proc_fornec_pedido_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_cod_proc_fornec_pedido_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_codigo_erp()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['codigo_erp']) || $this->NM_cmp_hidden['codigo_erp'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->codigo_erp));
              $conteudo_original = NM_encode_input(sc_strip_script($this->codigo_erp));
          }
          else {
              $conteudo = sc_strip_script($this->codigo_erp); 
              $conteudo_original = sc_strip_script($this->codigo_erp); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_codigo_erp_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_codigo_erp_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_codigo_erp_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_descricao_item()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['descricao_item']) || $this->NM_cmp_hidden['descricao_item'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->descricao_item));
              $conteudo_original = NM_encode_input(sc_strip_script($this->descricao_item));
          }
          else {
              $conteudo = sc_strip_script($this->descricao_item); 
              $conteudo_original = sc_strip_script($this->descricao_item); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_descricao_item_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_descricao_item_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_descricao_item_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['container']) || $this->NM_cmp_hidden['container'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->container)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->container)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_container_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
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
          $this->Lookup->lookup_situacao_container($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_situacao_container_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_situacao_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_situacao_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_sit_acomp_container()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['sit_acomp_container']) || $this->NM_cmp_hidden['sit_acomp_container'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->sit_acomp_container)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->sit_acomp_container)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_sit_acomp_container($conteudo , $this->sit_acomp_container) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_sit_acomp_container_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_sit_acomp_container_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_sit_acomp_container_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_cod_emit_forn()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['cod_emit_forn']) || $this->NM_cmp_hidden['cod_emit_forn'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->cod_emit_forn)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->cod_emit_forn)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_cod_emit_forn($conteudo , $this->cod_emit_forn) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_cod_emit_forn_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_cod_emit_forn_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_cod_emit_forn_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_fornec_pi()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['fornec_pi']) || $this->NM_cmp_hidden['fornec_pi'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->fornec_pi)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->fornec_pi)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_fornec_pi($conteudo , $this->fornec_pi) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_fornec_pi_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_fornec_pi_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_fornec_pi_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_registro_pedido()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_registro_pedido']) || $this->NM_cmp_hidden['dt_registro_pedido'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_registro_pedido)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_registro_pedido)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_dt_registro_pedido_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_dt_registro_pedido_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_registro_pedido_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_origem()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['origem']) || $this->NM_cmp_hidden['origem'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->origem));
              $conteudo_original = NM_encode_input(sc_strip_script($this->origem));
          }
          else {
              $conteudo = sc_strip_script($this->origem); 
              $conteudo_original = sc_strip_script($this->origem); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_origem_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_origem_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_origem_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_id_origem()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['id_origem']) || $this->NM_cmp_hidden['id_origem'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->id_origem)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->id_origem)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_id_origem_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_id_origem_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_id_origem_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
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
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_dt_prev_chegada_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_dt_prev_chegada_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_prev_chegada_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_recebto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_recebto']) || $this->NM_cmp_hidden['dt_recebto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_recebto)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_recebto)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_dt_recebto_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_dt_recebto_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_recebto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 21;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_pdf'] == "pdf")
   {
       $this->NM_colspan--;
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
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['print_navigator'] == "Netscape")
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
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\" width=\"100%\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] && $nm_parms != "resumo" && $nm_parms != "pagina" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida_grid'])
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

   function totaliza_php_sc_free_total()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_total_geral'] == "OK")
      {
          return;
      }
      //----- 
      $seq_acum = 0;
      $this->calc_saldo = 0;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_acumalado'] = array();
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $nmgp_select = "SELECT ID, str_replace (convert(char(10),DATA,102), '.', '-') + ' ' + convert(char(8),DATA,20), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $nmgp_select = "SELECT ID, convert(char(23),DATA,121), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $nmgp_select = "SELECT ID, DATA, HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
         $nmgp_select = "SELECT ID, EXTEND(DATA, YEAR TO DAY), HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
      } 
      else 
      { 
         $nmgp_select = "SELECT ID, DATA, HISTORICO, TIPO_MOVTO, VALOR, COD_PROC_FORNEC_PEDIDO, CODIGO_ERP, DESCRICAO_ITEM, CONTAINER, SITUACAO_CONTAINER, SIT_ACOMP_CONTAINER, COD_EMIT_FORN, FORNEC_PI, DT_REGISTRO_PEDIDO, ORIGEM, ID_ORIGEM, DT_PREV_CHEGADA, DT_RECEBTO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp"; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'] ; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ordem_desc']; 
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
   if (empty($nmgp_order_by))
   {
       $nmgp_order_by = " order by ID";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['order_grid'] = $nmgp_order_by;
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
      if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
      { 
         $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1] = 0;
         return;
      }  
      $this->Res->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         $this->id = $this->rs_grid->fields[0] ;  
         $this->id = (string)$this->id;  
         $this->data = $this->rs_grid->fields[1] ;  
         $this->historico = $this->rs_grid->fields[2] ;  
         $this->tipo_movto = $this->rs_grid->fields[3] ;  
         $this->tipo_movto = (string)$this->tipo_movto;  
         $this->rs_grid->fields[4] =  str_replace(",", ".", $this->rs_grid->fields[4]);  
         $this->valor = $this->rs_grid->fields[4] ;  
         $this->valor = (string)$this->valor;  
         $this->cod_proc_fornec_pedido = $this->rs_grid->fields[5] ;  
         $this->codigo_erp = $this->rs_grid->fields[6] ;  
         $this->descricao_item = $this->rs_grid->fields[7] ;  
         $this->container = $this->rs_grid->fields[8] ;  
         $this->container = (string)$this->container;  
         $this->situacao_container = $this->rs_grid->fields[9] ;  
         $this->situacao_container = (string)$this->situacao_container;  
         $this->sit_acomp_container = $this->rs_grid->fields[10] ;  
         $this->sit_acomp_container = (string)$this->sit_acomp_container;  
         $this->cod_emit_forn = $this->rs_grid->fields[11] ;  
         $this->cod_emit_forn = (string)$this->cod_emit_forn;  
         $this->fornec_pi = $this->rs_grid->fields[12] ;  
         $this->fornec_pi = (string)$this->fornec_pi;  
         $this->dt_registro_pedido = $this->rs_grid->fields[13] ;  
         $this->origem = $this->rs_grid->fields[14] ;  
         $this->id_origem = $this->rs_grid->fields[15] ;  
         $this->id_origem = (string)$this->id_origem;  
         $this->dt_prev_chegada = $this->rs_grid->fields[16] ;  
         $this->dt_recebto = $this->rs_grid->fields[17] ;  
         $GLOBALS["sit_acomp_container"] = $this->rs_grid->fields[10] ;  
         $GLOBALS["cod_emit_forn"] = $this->rs_grid->fields[11] ;  
         $GLOBALS["fornec_pi"] = $this->rs_grid->fields[12] ;  
         $seq_acum++;
         $this->calc_saldo += $this->valor;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_acumalado'][$seq_acum]['calc_saldo'] = $this->calc_saldo;
         $this->calc_saldo = (strpos(strtolower($this->calc_saldo), "e")) ? (float)$this->calc_saldo : $this->calc_saldo; 
         $this->calc_saldo = (string)$this->calc_saldo;  
         $this->Lookup->lookup_tipo_movto($this->tipo_movto); 
         $this->Lookup->lookup_situacao_container($this->situacao_container); 
         $this->GB_sit_acomp_container = $this->sit_acomp_container;
         $this->Lookup->lookup_sit_acomp_container($this->GB_sit_acomp_container, $this->sit_acomp_container) ; 
         $this->GB_cod_emit_forn = $this->cod_emit_forn;
         $this->Lookup->lookup_cod_emit_forn($this->GB_cod_emit_forn, $this->cod_emit_forn) ; 
         $this->GB_fornec_pi = $this->fornec_pi;
         $this->Lookup->lookup_fornec_pi($this->GB_fornec_pi, $this->fornec_pi) ; 
         $this->Res->adiciona_registro();
         $this->rs_grid->MoveNext();
      }
      $this->Res->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral'][1] = $this->Res->array_total_geral[0];
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_total_geral'] = "OK";
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
      {
        if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['new'] == "on" && $this->nmgp_botoes['insert'] == "on" && !$this->grid_emb_form)
        {
           if ($this->grid_emb_form_full)
           {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_custo_distr']['lig_iframe_modal'] = "nmsc_iframe_liga_cons_cta_corren_custo_distr_bkp";
           }
           $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
           if (isset($this->Ini->sc_lig_md5["form_cta_corren_custo_distr"]) && $this->Ini->sc_lig_md5["form_cta_corren_custo_distr"] == "S") {
               $Parms_Lig  = "NM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "NM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
           }
         $this->nm_btn_exist['new'][] = "sc_b_new_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bnovo", "nm_gp_submit1('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_cta_corren_custo_distr'); return false;;", "nm_gp_submit1('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_cta_corren_custo_distr'); return false;;", "sc_b_new_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_pdf.php?nm_opc=pdf&nm_target=1&nm_cor=pb&papel=8&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid&nm_all_modules=grid&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=pt_br&conf_socor=N&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=cons_cta_corren_custo_distr_bkp&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=CO&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_xls_res = "n";
          }
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '1', '$Xls_mod_export');", "nm_gp_move('xls', '1', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_xml_res = "n";
          }
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '1', '$Xml_mod_export');", "nm_gp_move('xml', '1', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
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
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
      if ($this->nmgp_botoes['gridsave'] == "on" && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $save_grid_format = 'extended';
          if($_SESSION['scriptcase']['proc_mobile'])
          {
              $save_grid_format = 'extended';
          }
          if ($save_grid_format == 'simplified' && !$_SESSION['scriptcase']['proc_mobile'])
          {
          $nm_saida->saida("            <div id='id_save_grid_div_top' style='display:inline-block; position: relative;'>\r\n");
          }
              $this->nm_btn_exist['gridsave'][] = "save_grid_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgridsave", "scBtnSaveGridShow('cons', 'Y', 'top', 'extended', '');", "scBtnSaveGridShow('cons', 'Y', 'top', 'extended', '');", "save_grid_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          if ($save_grid_format == 'simplified' && !$_SESSION['scriptcase']['proc_mobile'])
          {
          $nm_saida->saida("              <div id='id_div_save_grid_new_top' style='display:none; position: absolute; z-index: 20'>\r\n");
          $nm_saida->saida("              </div>\r\n");
          $nm_saida->saida("            </div>\r\n");
          }
              $NM_btn = true;
      }
          if (is_file("cons_cta_corren_custo_distr_bkp_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
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
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '30') ? " selected" : "";
              $nm_saida->saida("           <option value=\"30\" " . $obj_sel . ">30</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '100') ? " selected" : "";
              $nm_saida->saida("           <option value=\"100\" " . $obj_sel . ">100</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] == '200') ? " selected" : "";
              $nm_saida->saida("           <option value=\"200\" " . $obj_sel . ">200</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
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
          if (is_file("cons_cta_corren_custo_distr_bkp_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <select id=\"cond_fast_search_f0_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;display:none;\" name=\"nmgp_cond_fast_search\" onChange=\"change_fast_top = 'CH';\">\r\n");
          $OPC_sel = " selected='selected'";
          $nm_saida->saida("           <option value=\"qp\"$OPC_sel>" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>\r\n");
          $nm_saida->saida("          </select>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\" class=\"" . $this->css_css_toolbar_obj . "\" style='position: relative; display: inline-block; vertical-align: inherit;'>\r\n");
          $nm_saida->saida("           <span>\r\n");
          $nm_saida->saida("             <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "_text\" style=\"border-width: 0px;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{maxLength: 255}\" placeholder=\"" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "\">&nbsp;\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconSearch . "\" id=\"SC_fast_search_submit_top\" class='css_toolbar_obj_qs_search_img' src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("             <img style=\"display: " . $stateSearchIconClose . "\" class='css_toolbar_obj_qs_search_img' id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = '__Clear_Fast__'; nm_gp_submit_qsearch('top');\">\r\n");
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_pdf.php?nm_opc=pdf&nm_target=1&nm_cor=pb&papel=8&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid&nm_all_modules=grid&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=pt_br&conf_socor=N&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=cons_cta_corren_custo_distr_bkp&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=CO&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_xls_res = "n";
          }
          $Xls_mod_export = "grid";
          if ($Tem_xls_res == "n")
          {
              $Xls_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xls'][] = "xls_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '1', '$Xls_mod_export');", "nm_gp_move('xls', '1', '$Xls_mod_export');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
          {
              $Tem_xml_res = "n";
          }
          $Xml_mod_export = "grid";
          if ($Tem_xml_res == "n")
          {
              $Xml_mod_export = "grid";
          }
          $nm_saida->saida("            <div id=\"div_xml_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['xml'][] = "xml_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '1', '$Xml_mod_export');", "nm_gp_move('xml', '1', '$Xml_mod_export');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Gb_Free_cmp']))
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
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
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
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_selcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['gridsave'] == "on" && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $save_grid_format = 'extended';
          if($_SESSION['scriptcase']['proc_mobile'])
          {
              $save_grid_format = 'extended';
          }
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_save_grid_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
          if ($save_grid_format == 'simplified' && !$_SESSION['scriptcase']['proc_mobile'])
          {
          $nm_saida->saida("            <div id='id_save_grid_div_top' style='display:inline-block; position: relative;'>\r\n");
          }
              $this->nm_btn_exist['gridsave'][] = "save_grid_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgridsave", "scBtnSaveGridShow('cons', 'Y', 'top', 'extended', '');", "scBtnSaveGridShow('cons', 'Y', 'top', 'extended', '');", "save_grid_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          if ($save_grid_format == 'simplified' && !$_SESSION['scriptcase']['proc_mobile'])
          {
          $nm_saida->saida("              <div id='id_div_save_grid_new_top' style='display:none; position: absolute; z-index: 20'>\r\n");
          $nm_saida->saida("              </div>\r\n");
          $nm_saida->saida("            </div>\r\n");
          }
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
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
          if (is_file("cons_cta_corren_custo_distr_bkp_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
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
        if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['new'] == "on" && $this->nmgp_botoes['insert'] == "on" && !$this->grid_emb_form)
        {
           if ($this->grid_emb_form_full)
           {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_custo_distr']['lig_iframe_modal'] = "nmsc_iframe_liga_cons_cta_corren_custo_distr_bkp";
           }
           $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
           if (isset($this->Ini->sc_lig_md5["form_cta_corren_custo_distr"]) && $this->Ini->sc_lig_md5["form_cta_corren_custo_distr"] == "S") {
               $Parms_Lig  = "NM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "NM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
           }
         $this->nm_btn_exist['new'][] = "sc_b_new_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bnovo", "nm_gp_submit1('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_cta_corren_custo_distr'); return false;;", "nm_gp_submit1('" .  $this->Ini->link_form_cta_corren_custo_distr . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_cta_corren_custo_distr'); return false;;", "sc_b_new_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("cons_cta_corren_custo_distr_bkp_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_export_email_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_cons_cta_corren_custo_distr_bkp\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_B_cons_cta_corren_custo_distr_bkp\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
      $nm_saida->saida("     </td></tr> \r\n");
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_cta_corren_custo_distr_bkp', $(document).innerHeight())\",50);\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"cons_cta_corren_custo_distr_bkp\"/>\r\n");
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
   $nm_saida->saida("                     action=\"cons_cta_corren_custo_distr_bkp_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"cons_cta_corren_custo_distr_bkp_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"PB\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"PB\"/>\r\n");
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
   $nm_saida->saida("        target=\"_blank\"> \r\n");
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
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
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
   $nm_saida->saida("   var tem_hint;\r\n");
   $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (nm_mens == \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = true;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
   $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
   $nm_saida->saida("           document.tooltip.document.close();\r\n");
   $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
   $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
   $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
   $nm_saida->saida("              elml = nm_obj;\r\n");
   $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
   $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              else\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_apaga_hint()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (!tem_hint)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = false;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
   $nm_saida->saida("       out_qsearch = $('#fast_search_f0_' + pos).val();\r\n");
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
   $nm_saida->saida("   function nm_gp_submit1(apl_lig, apl_saida, parms, target, apl_name) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      if (target != null) \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.target = target; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action               = apl_lig  ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_chave.value     = \"\" ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = \"edit_novo\" ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("         window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'new_tab') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("         window.open('','jan_sc','');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.submit() ;\r\n");
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
   $nm_saida->saida("   function nm_gp_submit4(apl_lig, apl_saida, parms, target, opc, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc == 'igual' || opc == 'novo') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = opc;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"igual\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value   = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value       = parms ;\r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'new_tab') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      parms = parms.replace(/@percent@/g, \"%\"); \r\n");
   $nm_saida->saida("      if (m_confirm != null && m_confirm != '') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          if (confirm(m_confirm))\r\n");
   $nm_saida->saida("          { }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("             return;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'modal' || target == 'modal_rpdf') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          par_modal = '?&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=cons_cta_corren_custo_distr_bkp';\r\n");
   $nm_saida->saida("          if (opc != null && opc != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_opcao=grid';\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          if (parms != null && parms != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_parms=' + parms;\r\n");
   $nm_saida->saida("          }\r\n");
   $Sc_parent = "";
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $Sc_parent = "parent.";
   }
   $nm_saida->saida("          if (target == 'modal') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'new_tab') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      document.F3.nmgp_outra_jan.value   = \"\" ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function addUrlParam(sUrl, sParam, sValue) {\r\n");
   $nm_saida->saida("           var baseUrl, urlParams = [], objParams = {}, tmp, i;\r\n");
   $nm_saida->saida("           tmp = sUrl.split(\"?\");\r\n");
   $nm_saida->saida("           baseUrl = tmp[0];\r\n");
   $nm_saida->saida("           if (tmp[1]) {\r\n");
   $nm_saida->saida("                   urlParams = tmp[1].split(\"&\");\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           for (i = 0; i < urlParams.length; i++) {\r\n");
   $nm_saida->saida("                   tmp = urlParams[i].split(\"=\");\r\n");
   $nm_saida->saida("                   objParams[ tmp[0] ] = tmp[1] ? tmp[1] : \"\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           objParams[sParam] = sValue;\r\n");
   $nm_saida->saida("           urlParams = [];\r\n");
   $nm_saida->saida("           for (tmp in objParams) {\r\n");
   $nm_saida->saida("                   urlParams.push(tmp + \"=\" + objParams[tmp]);\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           return baseUrl + \"?\" + urlParams.join(\"&\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   if ($_SESSION['scriptcase']['proc_mobile']) {
       $nm_saida->saida("   if (alt == '' || alt == 0) {\r\n");
       $nm_saida->saida("       alt = '440';\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   if (larg == '' || larg == 0) {\r\n");
       $nm_saida->saida("       larg = '630';\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   nm_gp_submit5(apl_lig, apl_saida, parms, 'modal', opc, alt, larg, m_confirm, apl_name, ancor); \r\n");
       $nm_saida->saida("   return;\r\n");
   }
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_cons_cta_corren_custo_distr_bkp');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_cons_cta_corren_custo_distr_bkp');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_cons_cta_corren_custo_distr_bkp');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_cons_cta_corren_custo_distr_bkp');} \r\n");
   $nm_saida->saida("      obj.style.height = (alt == parseInt(alt)) ? alt + 'px' : alt;\r\n");
   $nm_saida->saida("      obj.style.width  = (larg == parseInt(larg)) ? larg + 'px' : larg;\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cons_cta_corren_custo_distr_bkp_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.target = \"_blank\"; \r\n");
   $nm_saida->saida("               document.Fpdf.action=\"index.php\";\r\n");
   $nm_saida->saida("               document.Fpdf.nmgp_parms.value = \"\";\r\n");
   $nm_saida->saida("               document.Fpdf.page_break_pdf.value = \"_NO_\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               document.Fprint.action = \"cons_cta_corren_custo_distr_bkp_export_ctrl.php\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.target = \"_blank\"; \r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_cta_corren_custo_distr_bkp_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"cons_cta_corren_custo_distr_bkp_export_ctrl.php\";\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['cons_cta_corren_custo_distr_bkp']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"cons_cta_corren_custo_distr_bkp_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('cons_cta_corren_custo_distr_bkp')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_cta_corren_custo_distr_bkp', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
function criarRegDistrCusto($item_container_custo_id,$item_container_id,$historico,$cod_tipo_movto,$vl_lancto)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    if(!getParamDistrCusto()){
        $vl_lancto = 0;
        $this->historico .=" - Lançamento zerado devido a distribuição de custo estar desligada";
    }
    $login = getLoginCorrente();
    $cmd = "insert into pub.cta_corren_custo_distr(cta_corren_custo_distr_id,data,item_container_custo_id,item_container_id,historico,
            cod_tipo_movto,vl_lancto,login)
            values(pub.seq_cta_corren_custo_distr.NEXTVAL,CURDATE(),$item_container_custo_id,$item_container_id,'$this->historico',$cod_tipo_movto,$vl_lancto,'$login')";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    $novoId = buscarVlSequenciaEspec('seq_cta_corren_custo_distr','cta_corren_custo_distr');
    return $novoId;
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function buscarDadosCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $tabela = "pub.cta_corren_custo_distr";
    $campos = "data,item_container_custo_id,item_container_id,historico,cod_tipo_movto,vl_lancto";
    $condicao = "cta_corren_custo_distr_id = $id";
    $aRetorno = $this->retornoSimplesTb01 ($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function buscarContainerCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $this->container = 0;
    $aDados = $this->buscarDadosCtaCorrenCustoDistr ($this->id);
    if(is_array ($aDados)){
        $itemContainerId = $aDados[0]['item_container_id'];
        $aDadosItemContainer = buscarDadositemContainer ($itemContainerId);
        if(is_array ($aDadosItemContainer)){
            $this->container = $aDadosItemContainer[0]['container_id'];
        }
    }
    return $this->container;


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function criarDespesaDistrCusto($idCtaCorrenCustoDistr,$valor,$itemContainerId=0,$container=0)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $memoriaCalculo = '';

    $idDespesa = buscarDespesaDistrCusto();
    if($this->container == 0){
        $this->container = $this->buscarContainerCtaCorrenCustoDistr($idCtaCorrenCustoDistr);
    }
    if(!getParamDistrCusto()){
        $this->valor = 0;
        $memoriaCalculo = 'Valor do lançamento zerado devido a distr. custo estar desligada por parametro';
    }
    criarDespesaContainer(
        $this->container,
        $idDespesa,
        $this->valor,
        0,
        0,
        0,
        $idCtaCorrenCustoDistr,
        $memoriaCalculo,
        0,
        $itemContainerId
    );


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function atualizarVlDespesaDistrCusto($idCtaCorrenCustoDistr, $valor)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $logAtualizado = 0;
    $this->id = buscarDespesaContainerDistrCusto($idCtaCorrenCustoDistr);
    if($this->id <> 0){
        $logAtualizado = 1;
        atualizarVlDespesaContainerPorId($this->id,$this->valor);
    }
    return $logAtualizado;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function buscarSaldoAtualDistrCusto()
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $this->valor = 0;
    $tabela = "pub.cta_corren_custo_distr";
    $campo = "sum(vl_lancto) as saldo";
    $condicao = " 1=1 ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $this->valor = $aRetorno[0]['saldo'];
    }
    return $this->valor;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function calcularSaldoAnteriorDistrCusto($condicao)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $aRetorno = [];
    $dataInicio = '2001-01-01';
    $iCont = 0;
    $aCondicao = explode("where" ,$condicao);
    if(count($aCondicao) > 1 ){
        $cond = $aCondicao[1];
    }else{
        $cond = $aCondicao[0];
    }

    $condSubst = $cond;
    $condSubstTipoMovtoManual = $cond;
    $listaApelido ='TIPO_MOVTO,VALOR,COD_PROC_FORNEC_PEDIDO,CODIGO_ERP,DESCRICAO_ITEM,CONTAINER,
                    SITUACAO_CONTAINER,SIT_ACOMP_CONTAINER,COD_EMIT_FORN,FORNEC_PI,DT_REGISTRO_PEDIDO,
                    DT_PREV_CHEGADA,DT_RECBTO,ID';
    $listaCampos  ='cod_tipo_movto,vl_lancto,pc.cod_proc_fornec,ipc.codigo_erp,ipc.descricao,ic.container_id,
                     container.situacao,container.situacao_container_id,container."cod-emit-forn",pc.fornecedor_id,
                     pc.dt_registro,container."dt-prev-chegada",container."dt-recebimento",
                     custo_distr.cta_corren_custo_distr_id';
    $listaTipoMovtoManual ="cod_tipo_movto,vl_lancto,' ',' ',' ',versao.container_id,' ',' ',' ',' ',' ',' ',' ',
    custo_distr.cta_corren_custo_distr_id";
    $aListaApelido = explode(",",$listaApelido);
    $aListaCampos  = explode(',',$listaCampos);
    $aListaTipoMovtoManual = explode(',',$listaTipoMovtoManual);
    $qt = count($aListaApelido);
    for ($i = 0; $i < $qt ; $i++) {
        $condSubst = str_replace($aListaApelido[$i],$aListaCampos[$i],$condSubst);
        $condSubstTipoMovtoManual = str_replace($aListaApelido[$i],$aListaTipoMovtoManual[$i],$condSubstTipoMovtoManual);

    }
   
    $sql =
        "SELECT   
    data, sum(custo_distr.vl_lancto) as valor
    FROM 
    PUB.cta_corren_custo_distr custo_distr
    inner join pub.item_container_custos icc
    on custo_distr.item_container_custo_id = icc.item_container_custo_id
    inner join pub.itens_container ic
    on ic.item_container_id = icc.item_container_id	
    inner join pub.itens_proc_compra ipc
    on ipc.item_proc_compra_id = ic.item_proc_compra_id
    inner join pub.\"pp-container\" container
	on container.\"nr-container\" = ic.container_id
    inner join pub.procs_compra pc
    on pc.proc_compra_id = ipc.proc_compra_id
    where custo_distr.cod_tipo_movto = 3
    and $condSubst
    group by data
    union 
    SELECT  data,   sum(custo_distr.vl_lancto) as valor   
     FROM 
     PUB.cta_corren_custo_distr custo_distr
     inner join pub.itens_container ic
     on ic.item_container_id = custo_distr.item_container_id	
     inner join pub.itens_proc_compra ipc
     on ipc.item_proc_compra_id = ic.item_proc_compra_id
     inner join pub.\"pp-container\"  container
	 on container.\"nr-container\" = ic.container_id
     inner join pub.procs_compra pc
     on pc.proc_compra_id = ipc.proc_compra_id
     where custo_distr.cod_tipo_movto = 4
     and $condSubst
     group by data
     union 
     SELECT   data,   sum(custo_distr.vl_lancto) as valor
     FROM 
     PUB.cta_corren_custo_distr custo_distr
     inner join pub.itens_container ic on custo_distr.item_container_id = ic.item_container_id     
     where custo_distr.cod_tipo_movto = 2              
     and $condSubst
     group by data
     union 
     SELECT   data,   sum(custo_distr.vl_lancto) as valor
     FROM 
     PUB.cta_corren_custo_distr custo_distr
     inner join pub.item_container_custos icc on icc.item_container_custo_id = custo_distr.item_container_custo_id
     inner join pub.versoes_item_custo_container versao on versao.versao_id = icc.versao_id
     where custo_distr.cod_tipo_movto = 2    
     and $condSubstTipoMovtoManual
     group by data
     ";
    $total = 0;
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->distr = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->distr = false;
          $this->distr_erro = $this->Db->ErrorMsg();
      } 

    if ($this->distr  === false){
    echo "Access error. Message =". $this->distr_erro ;
    $aRetorno = '';
    }
    else
    {
        while (!$this->distr->EOF) {
            $this->data = $this->distr->fields[ 0 ];
            $valorSaldo = $this->distr->fields[ 1 ];
            if ( $iCont == 0 ) {
                $dataInicio = $this->data ;
            }
            $total += $valorSaldo;
            $iCont++;
            $this->distr->MoveNext ();
        }
        $this->distr->Close ();

        $saldoAtual = $this->buscarSaldoAtualDistrCusto ();
        $saldoAnterior = $saldoAtual - $total;
        $aRetorno = array('saldo' => $saldoAnterior , 'data' => $dataInicio);
    }
    return $aRetorno;
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getTotalDistrParaItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $vlTotal = 0;
    $tabela   = " pub.cta_corren_custo_distr ";
    $campos   = " sum(vl_lancto) as tot ";
    $condicao = "  item_container_id = $itemContainerId and cod_tipo_movto = 4";
    $aDados = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aDados)){
        $vlTotal = $aDados[0]['tot'];
    }
    return $vlTotal;


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getTotalDistrPorItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $vlTotal  = 0;
    $tabela   = " pub.cta_corren_custo_distr cta_corren,pub.item_container_custos custo  ";
    $campos   = " sum(vl_lancto) as tot ";
    $condicao = "  cta_corren.item_container_custo_id = custo.item_container_custo_id
                and cta_corren.cod_tipo_movto = 3
                and custo.item_container_id = $itemContainerId";
    $aDados= $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aDados)){
        $vlTotal = $aDados[0]['tot'];
    }
    return  $vlTotal;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getVlDistrContainer($containerParam, $itemContainerParam='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $vlTrib     = 0;
    $vlNeg      = 0;
    $totVlTrib  = 0;
    $totVlNeg   = 0;
    $totVlSaldo = 0;
    $tipo     = "multi"; 
    $tabela   = " pub.itens_proc_compra as item_ped, pub.itens_container item_container                
                  ";
    $campos   = " item_container.container_id           as container_id,
                  item_container.item_container_id      as item_container_id,
                  item_ped.item_proc_compra_id          as item_proc_compra_id,
                  item_ped.ind_distr_custo              as ind_distr_custo,
                  item_ped.vl_base_tributacao * item_container.qt_alocada as vl_trib_alocado, 
                  item_ped.vl_base_tributacao * item_container.qt_confirm_emb as vl_trib_confirm,
                  item_ped.vl_negociado * item_container.qt_alocada as vl_neg_alocado,
                  item_ped.vl_negociado * item_container.qt_confirm_emb as vl_neg_confirm";
    $condicao = " item_ped.item_proc_compra_id = item_container.item_proc_compra_id";
    if($itemContainerParam <> ''){
        $condicao.= " and item_container.item_container_id = $itemContainerParam ";
    }
    if($containerParam <> ''){
        $condicao.= " and item_container.container_id = $containerParam ";
    }
    $conexao  = "espec";
    $aDados = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i<$tam;$i++){
            $this->container          = $aDados[$i]['container_id'];
            $indDistrCusto      = $aDados[$i]['ind_distr_custo'];
            $itemContainerId    = $aDados[$i]['item_container_id'];
            $itemProcVendaId    = $aDados[$i]['item_proc_compra_id'];
            $vlTribAlocado      = $aDados[$i]['vl_trib_alocado'];
            $vlTribConfirm      = $aDados[$i]['vl_trib_confirm'];
            $vlNegAlocado       = $aDados[$i]['vl_neg_alocado'];
            $vlNegConfirm       = $aDados[$i]['vl_neg_confirm'];
            $logGeracaoCusto    = verificarGeracaoDistrCusto($this->container);
            if($logGeracaoCusto == 0){ 
                $vlTribAlocado      = 0;
                $vlTribConfirm      = 0;
                $vlNegAlocado       = 0;
                $vlNegConfirm       = 0;
                $vlSaldo            = 0;
                $vlTrib             = 0;
                $vlNeg              = 0;
            }else{
                if($indDistrCusto == 0){ 
                    $vlTribAlocado      = 0;
                    $vlTribConfirm      = 0;
                    $vlNegAlocado       = 0;
                    $vlNegConfirm       = 0;
                    $vlSaldo            = 0;
                    $vlTrib             = 0;
                    $vlNeg              = 0;
                }else{
                    if($vlTribConfirm == 0){
                        $vlTrib = $vlTribAlocado;
                        $vlNeg  = $vlNegAlocado;
                    }else{
                        $vlTrib = $vlTribConfirm;
                        $vlNeg  = $vlNegConfirm;
                    }
                    $vlSaldo  = $vlNeg - $vlTrib;
                    if($vlSaldo < 0){
                        $vlSaldo = 0;
                    }
                }
            }
            
            $totVlTrib   += $vlTrib;
            $totVlNeg    += $vlNeg;
            $totVlSaldo  += $vlSaldo;
        }
    }
    $aRetorno = array('vl_trib' => $totVlTrib,'vl_neg' => $totVlNeg,'vl_saldo'=> $totVlSaldo);
    return $aRetorno;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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
                    $listaCampos = util_incr_valor($listaCampos,$campoIncr);
                    $listaTipoCp = util_incr_valor($listaTipoCp,$tipo);
                    $listaExtentCp = util_incr_valor($listaExtentCp,$extensao);
                }


            }else{
                $listaCampos = util_incr_valor($listaCampos,$campo);
                $listaTipoCp = util_incr_valor($listaTipoCp,$tipo);
                $listaExtentCp = util_incr_valor($listaExtentCp,$extensao);
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

            $condicao = util_incr_valor($condicao,$incr," AND ");
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
        $condicao = util_incr_valor($condicao,$filtroCompl,' AND ',true);
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  

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
      $erro ="Erro de acesso retornoSimplesTB01.Conexão $conexao  Mensagem = " . $this->meus_dados_erro ;

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
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $base = getBase();
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


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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
                $valores = util_incr_valor($valores,$incr)  ;


            }
        }
    }else{
        $valores = $aDados;
    }

    $cmd = "update {$tabela} set $valores where $condicao ";
    return $cmd;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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
            $listaCampos = util_incr_valor($listaCampos, $campo);
            $listaTipoCp = util_incr_valor($listaTipoCp, $tipo);
            $listaTamanho = util_incr_valor($listaTamanho, $tamanho);
        }
        $aRetorno = array('campos' => $listaCampos, 'tipos' => $listaTipoCp,
            'extensoes' => '','tamanhos'=> $listaTamanho);
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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
    if(getLogSql() == 1){
        inserirLogDb('comando SQL - sql livre',$sql,__FUNCTION__);
    }
    if ($this->dados   === false){
    if(getLogSql() == 1){
        inserirLogDb('erro comando SQL - conexao:'.$conexao,$this->dados_erro ,__FUNCTION__);
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
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $aCampos = array_keys($aDados);
    $campos    = '';
    $vlCampos = '' ;
    if(is_array($aCampos)){
        $tam = count($aCampos);
        for($i=0;$i<$tam;$i++){
            $campos  = util_incr_valor($campos,$aCampos[$i]);
            if(getNumEmLista($cpsSemAspas,$i + 1)  == true){
                $incr = $aDados[$aCampos[$i]];
            }else{
                $incr = "'".$aDados[$aCampos[$i]]."'";
            }
            $vlCampos = util_incr_valor($vlCampos,$incr)  ;


        }
    }
    $cmd = "insert into {$tabela}({$campos})values({$vlCampos})";
    return $cmd;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['inicio']);
}

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
}
?>
