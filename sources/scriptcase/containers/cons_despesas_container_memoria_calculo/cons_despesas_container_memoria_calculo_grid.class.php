<?php
class cons_despesas_container_memoria_calculo_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $Rows_span;
   var $nm_grid_slides_linha;
   var $Nm_bloco_aberto;
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
   var $vl_real;
   var $memoria_calculo;

function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   $this->NM_cor_embutida();
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid();
       $this->nm_fim_grid();
   } 
   else 
   { 
    if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=1>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['cons_despesas_container_memoria_calculo'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['save_grid']);
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
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
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'];
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
   $nm_tem_quebra,
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det,
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("pt_br");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['mostra_edit'] = "N";
   }
   $nm_tem_quebra = 0;
   $this->Nm_bloco_aberto = false;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("cons_despesas_container_memoria_calculo", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
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
   $this->nmgp_botoes['rows'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['SC_btn_0'] = "on";
   $this->nmgp_botoes['SC_btn_1'] = "on";
   $this->nmgp_botoes['SC_btn_2'] = "on";
   $this->nmgp_botoes['bt_log'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_resumo'])) 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "muda_qt_linhas";
   } 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_despesas_container_memoria_calculo'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['cons_despesas_container_memoria_calculo'];

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
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "cons_despesas_container_memoria_calculo_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new cons_despesas_container_memoria_calculo_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid'] = 30;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid'] = 1 ;  
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['rows'];  
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['rows']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
       if (!empty($nmgp_quant_colunas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid'] = $nmgp_quant_colunas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_lin_grid'] * $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid']; 
   $this->nm_grid_slides_linha = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_col_grid'];
   $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin * $this->nm_grid_slides_linha; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "q_log_custo") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_select'] = array(); 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "_NM_SC_") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_select'] = array(); 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "q_log_custo") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra'] = array(); 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "_NM_SC_") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!$GLOBALS['nm_restore_grid_save'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['prim_cons'] || !empty($nmgp_parms)) )  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'] = " where (despesa_container_id = " . $_SESSION['despesa_container_corrente'] . ")";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'] = "";
   }   
   $GLOBALS['nm_restore_grid_save'] = false;
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'];
   $this->Tot->$Gb_geral();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral'][1];
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = 0; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'];
   }
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT memoria_calculo from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order    = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->memoria_calculo = $this->rs_grid->fields[0] ;  
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->memoria_calculo = $this->rs_grid->fields[0] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'] && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['word_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['print_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - Despesas do Container :: PDF</TITLE>
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['pivot_charts']) : 0;
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
               cons_despesas_container_memoria_calculo_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               cons_despesas_container_memoria_calculo_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               cons_despesas_container_memoria_calculo_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               cons_despesas_container_memoria_calculo_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               cons_despesas_container_memoria_calculo_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE html>\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Despesas do Container</TITLE>\r\n");
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'] && !$this->Ini->sc_export_ajax)
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_despesas_container_memoria_calculo_jquery_4662.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_despesas_container_memoria_calculo_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"cons_despesas_container_memoria_calculo_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida']) {  
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida']) { 
           $nm_saida->saida("            <script>\r\n");
           $nm_saida->saida("                $(document).ready(function(){\r\n");
           $nm_saida->saida("                    bootstrapMobile();\r\n");
           $nm_saida->saida("                });\r\n");
           $nm_saida->saida("            </script>\r\n");
           }
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid']) . ";\r\n");
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
           $nm_saida->saida("        let cells = $(\".sc-ui-grid-header-row-cons_despesas_container_memoria_calculo-1\").find(\"td\");\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    function scSetFixedHeadersCss(baseTop)\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let rows, cols, i, j, thisTop;\r\n");
           $nm_saida->saida("        rows = $(\".sc-ui-grid-header-row-cons_despesas_container_memoria_calculo-1\");\r\n");
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
           $nm_saida->saida("   return;\r\n");
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
           $nm_saida->saida("   var gridHeaders = $(\".sc-ui-grid-header-row-cons_despesas_container_memoria_calculo-1\"), headerDisplayed = true;\r\n");
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
           $nm_saida->saida("   tableOriginal = document.getElementById(\"sc-ui-grid-body-808b930f\");\r\n");
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ancor_save']);
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word']) {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
       }
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_despesas_container_memoria_calculo_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_cons_despesas_container_memoria_calculo_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_cons_despesas_container_memoria_calculo_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("    " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'])
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".cons_despesas_container_memoria_calculo_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .cons_despesas_container_memoria_calculo_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".cons_despesas_container_memoria_calculo_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida    = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['css_body_embutida'] : "";
   $this->css_remove_margin     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['link_info']['remove_margin']))     ? "margin: 0;" : "";
   $this->css_remove_border     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['link_info']['remove_border']))     ? "border-width: 0;" : "";
   $this->css_remove_background = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['link_info']['remove_background'])) ? "background-color: transparent; background-image: none;" : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_slide\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
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
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
          $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
          $vertical_center = '';
           $nm_saida->saida("  <body id=\"grid_slide\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $remove_background . $vertical_center . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" && !$this->Print_All && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "q_log_custo")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "_NM_SC_")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . $this->css_remove_border . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'])
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   {
       $this->arr_buttons = array_merge($this->arr_buttons, $this->Ini->arr_buttons_usr);
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_despesas_container_memoria_calculo']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['cons_despesas_container_memoria_calculo']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_despesas_container_memoria_calculo']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['cons_despesas_container_memoria_calculo']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida']) ? "cons_despesas_container_memoria_calculo_" : "";
   $this->css_sep = " ";
   $this->css_memoria_calculo_label = $compl_css_emb . "css_memoria_calculo_label";
   $this->css_memoria_calculo_grid_line = $compl_css_emb . "css_memoria_calculo_grid_line";
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Despesas do Container - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'] && $nm_refresch_cab_rod)
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Despesas do Container - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_head', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida(" </TR>\r\n");
 }
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ordem_label'] == 'desc') {
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
            case "vl_real":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
        }
        return 'asc';
    }

// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_tem_quebra,
           $nm_saida;
   $fecha_tr               = "</tr>";
   $this->Ini->qual_linha  = "par";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['memoria_calculo'])) ? $this->New_label['memoria_calculo'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['labels']['memoria_calculo'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['cons_despesas_container_memoria_calculo']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_cons_despesas_container_memoria_calculo#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-size:12px;color:#000000;\" colspan = \"1\" align=\"center\">\r\n");
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
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_cons_despesas_container_memoria_calculo#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       $nm_id_aplicacao = " id=\"apl_cons_despesas_container_memoria_calculo#?#1\"";
   } 
   $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf") ? "padding: 0px !important;" : "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\" width=\"100%\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert'] )
{
}
else
{
   $nm_saida->saida("    <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-808b930f\" align=\"center\" width=\"100%\">\r\n");
}
if (($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] )
{
    if ($this->pdf_all_cab == "S") {
    $nm_saida->saida("              <thead>\r\n");
        $this->cabecalho();
    $nm_saida->saida("              </thead>\r\n");
    }
    else {
        $this->cabecalho();
    }
}
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Page_break_PDF'] = array();
       }
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   $this->nm_contr_album = 0;
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->NM_field_color = array();
          $this->NM_field_style = array();
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['doc_word'] && !$this->Ini->sc_export_ajax)
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
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  cons_despesas_container_memoria_calculo_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->memoria_calculo = $this->rs_grid->fields[0] ;  
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['rows_emb']++;
          $this->sc_proc_grid = true;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'])
          {
              if (($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0) && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_grid'])
              { 
                 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "q_log_custo" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "_NM_SC_") 
                 { } 
                 elseif ($this->pdf_label_group == "S") 
                 {
                     $this->label_grid($linhas);
                 } 
                 $nm_houve_quebra = "N";
             } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['final']; 
          $this->Ini->cor_link_dados = ($this->Ini->cor_link_dados == $this->css_scGridFieldOddLink) ? $this->css_scGridFieldEvenLink : $this->css_scGridFieldOddLink; 
          $this->Ini->qual_linha   = ($this->Ini->qual_linha == "par") ? "impar" : "par";
          if ("impar" == $this->Ini->qual_linha)
          {
              $this->css_line_back = $this->css_scGridFieldOddVert;
          }
          else
          {
              $this->css_line_back = $this->css_scGridFieldEvenVert;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
          }
   if (!$this->NM_flag_antigo)
   {
       $nm_contr_percentual = 100 / $this->nm_grid_slides_linha; 
       if ($this->nm_contr_album != 0 && $this->nm_contr_album % $this->nm_grid_slides_linha == 0)
       {
           $this->SC_ancora = $this->SC_seq_page;
$nm_saida->saida("      </tr></table></td></tr>\r\n");
$nm_saida->saida("<tr><td style=\"padding: 0px\"><table align=\"center\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\">\r\n");
$nm_saida->saida("<tr id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
       }
       elseif ($this->nm_contr_album == 0)
       {
           $this->SC_ancora = $this->SC_seq_page;
$nm_saida->saida("      <tr><td style=\"padding: 0px\"><table align=\"center\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\">\r\n");
$nm_saida->saida("<tr id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
       }
       $this->nm_contr_album++; 
       $this->Nm_bloco_aberto = true; 
   } 
$nm_saida->saida("   <td style=\"padding: 0px; vertical-align: top;\" width=\"" . $nm_contr_percentual . "%\">\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq']) { 
$nm_saida->saida("     &nbsp;\r\n");
 } 
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq']) { 
$nm_saida->saida("     \r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
$nm_saida->saida(" $Cod_Btn\r\n");
 } 
$nm_saida->saida("    <table width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr valign=\"top\"><td style=\"padding: 0px\" width=\"100%\" height=\"\">\r\n");
 if(!isset($this->Ini->nm_hidden_blocos[0]) || $this->Ini->nm_hidden_blocos[0] != "off")
 {
     $Img_tit_blk_i = "";
     $Img_tit_blk_f = "";
     $Collapse_blk  = "";
     if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf")
     {
         $Img_tit_blk_i = "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td class=\"" . $this->css_scGridBlockAlign . " css_blk_0\" style=\"border-width: 0px; padding: 0px; width: 100%;@STYBLK@\">";
         $Img_tit_blk_f = "</td></tr></table>";
     }
$nm_saida->saida("  <TABLE class=\"" . $this->css_scGridTabela . "\"  style=\"border-collapse:collapse;\" cellspacing=0px cellpadding=0px align=\"center\" id=\"cons_despesas_container_memoria_calculo_hidden_bloco_0_" . $this->nm_contr_album . "\" width=\"100%\" style=\"height: 100%\">\r\n");
$nm_saida->saida("   <TR>\r\n");
$nm_saida->saida("    <TD  style=\"border-width: 0px; border-style: none; \" height=\"\" valign=\"top\" width=\"100%\">\r\n");
$nm_saida->saida("     <TABLE style=\"padding: 0px; spacing: 0px; border-width: 0px; border-collapse:collapse;\" width=\"100%\">\r\n");
$nm_saida->saida("      <TR>\r\n");
$nm_saida->saida("     <TD class=\"" . $this->css_line_back . $this->css_sep . $this->css_memoria_calculo_grid_line . "\"  style=\"" . $this->Css_Cmp['css_memoria_calculo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\" width=\"100%\"  HEIGHT=\"0px\">\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->memoria_calculo));
              $conteudo_original = NM_encode_input(sc_strip_script($this->memoria_calculo));
          }
          else {
              $conteudo = sc_strip_script($this->memoria_calculo); 
              $conteudo_original = sc_strip_script($this->memoria_calculo); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if (isset($this->NM_cmp_hidden['memoria_calculo']) && $this->NM_cmp_hidden['memoria_calculo'] == "off")
          {
              $conteudo = "&nbsp;";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
$nm_saida->saida("     <span id=\"id_sc_field_memoria_calculo_" . $this->SC_seq_page . "\"><span >" . $conteudo . "</span></span>\r\n");
$nm_saida->saida("    </TD>\r\n");
$nm_saida->saida("   </tr></table></td>\r\n");
$nm_saida->saida("    </tr></table>\r\n");
 }
$nm_saida->saida("    </td></tr></table></td>\r\n");
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   $this->NM_Fecha_bloco("fim");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
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
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao']       = "igual" ; 
   } 
 }
 function NM_Fecha_bloco($opc="ok")
 {
   global $nm_saida;
   $nm_contr_percentual = 100 / $this->nm_grid_slides_linha; 
   $this->nm_contr_album = $this->nm_contr_album % $this->nm_grid_slides_linha;
   if ($this->nm_contr_album != 0 && $this->nm_contr_album != $this->nm_grid_slides_linha)
   {
       while ($this->nm_contr_album < $this->nm_grid_slides_linha)
       {
          $nm_saida->saida("  <td style=\"padding: 0px; vertical-align: top;\" width=\"" .  $nm_contr_percentual . "%\">\r\n");
          $nm_saida->saida("    <TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"  align=\"center\"  width=\"100%\">\r\n");
          $nm_saida->saida("      <TR>\r\n");
          $nm_saida->saida("        <TD>&nbsp;\r\n");
          $nm_saida->saida("        </TD>\r\n");
          $nm_saida->saida("      </TR>\r\n");
          $nm_saida->saida("    </TABLE>\r\n");
          $nm_saida->saida("  </td>\r\n");
          $this->nm_contr_album++;
       }
   }
   $this->nm_contr_album = 0;
   if ($this->Nm_bloco_aberto)
   {
       $this->Nm_bloco_aberto = false;
       if ($opc != "fim")
       {
           $nm_saida->saida("     </tr></table></td></tr>\r\n");
       }
       else
       {
           $nm_saida->saida("     </tr></table></td>\r\n");
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
        $this->NM_Fecha_bloco();
        $this->Ini->nm_cont_lin = ($nm_parms == "pagina") ? 0 : 1;
        if ($this->Print_All)
        {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['print_navigator'] == "Netscape")
            {
                $nm_saida->saida("</TABLE></TD></TR>\r\n");
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
                $nm_saida->saida("<TR><TD style=\"padding: 0px\"><TABLE width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\">\r\n");
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
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
   $nm_saida->saida("    <TABLE align=\"center\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\">\r\n");
   $nm_saida->saida("     <TR> \r\n");
    }
 }
 function quebra_geral_q_log_custo_top() 
 {
 }
 function quebra_geral_q_log_custo_bot() 
 {
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "q_log_custo" || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "_NM_SC_")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid&nm_all_modules=grid&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=4&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=pt_br&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=cons_despesas_container_memoria_calculo&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Gb_Free_cmp']))
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_xls_conf('xls', '$Xls_mod_export', '','N');", "nm_gp_xls_conf('xls', '$Xls_mod_export', '','N');", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Gb_Free_cmp']))
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_xml_conf('tag','N','$Xml_mod_export','');", "nm_gp_xml_conf('tag','N','$Xml_mod_export','');", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Gb_Free_cmp']))
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_csv_conf('1','1','1','N','$Csv_mod_export','');", "nm_gp_csv_conf('1','1','1','N','$Csv_mod_export','');", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=pt_br&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
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
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_sel_groupby_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Groupby_hide']))
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnGroupByShow('" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
          }
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "q_log_custo" && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['SC_Ind_Groupby'] != "_NM_SC_")
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
          if (is_file("cons_despesas_container_memoria_calculo_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_despesas_container_memoria_calculo_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_psq'])
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->Embutida_iframe && !$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("cons_despesas_container_memoria_calculo_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("cons_despesas_container_memoria_calculo_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
   }
   function nmgp_barra_bot()
   {
       if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot_mobile();
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE></TD>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_despesas_container_memoria_calculo', $(document).innerHeight())\",50);\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"cons_despesas_container_memoria_calculo\"/>\r\n");
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
   $nm_saida->saida("                     action=\"cons_despesas_container_memoria_calculo_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"cons_despesas_container_memoria_calculo_iframe_prt.php\" \r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
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
   $nm_saida->saida("   function SC_btn_0() \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function SC_btn_1() \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function SC_btn_2() \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function sc_btn_bt_log()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.F4.target = \"_blank\";\r\n");
   $nm_saida->saida("       document.F4.rec.value = \"\";\r\n");
   $nm_saida->saida("       document.F4.nm_call_php.value = \"bt_log\";\r\n");
   $nm_saida->saida("       document.F4.nmgp_opcao.value = \"formphp\" ;\r\n");
   $nm_saida->saida("       document.F4.submit() ;\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['ajax_nav'])
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['cons_despesas_container_memoria_calculo_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_despesas_container_memoria_calculo@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"cons_despesas_container_memoria_calculo_iframe.php\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               document.Fprint.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("           document.Fexport.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "cons_despesas_container_memoria_calculo/cons_despesas_container_memoria_calculo_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"cons_despesas_container_memoria_calculo_export_ctrl.php\";\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['cons_despesas_container_memoria_calculo']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"cons_despesas_container_memoria_calculo_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('cons_despesas_container_memoria_calculo')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('cons_despesas_container_memoria_calculo', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valor= 1;
    $dataCotacao = '';
    $campoRetorno = '"vl-dolar-venda"';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno,
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){
        $aUltCotacao = getDadosUltCotacao();
        if(is_array($aUltCotacao)){
            $vlCotacaoHoje = $aUltCotacao['valor'];
            $dataCotacao   = $aUltCotacao['data'];
        }else{
            $vlCotacaoHoje = 0;
        }

        if($vlCotacaoHoje <> 0){
            $valor = $vlCotacaoHoje;
        }
    }
    if($valor == 0){$valor = 1; }
    $retorno = array('valor' => $valor,'data'=>$dataCotacao);
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $sinal = '';
    $cotacao = 0;
    $histOrigem = '';
    $histDolarSaldo = '';
    $aReg = $this->buscarCamposContainer($containerId,
        'ordem_busca_dolar_compra, ordem_busca_dolar_di,cod_tipo_proj_dolar,vl_proj_dolar,
                "vl-dolar-compra" as vl_dolar_compra,vl_dolar_di');
    if(is_array($aReg)){
        $ordemDolarCompra = $aReg[0]['ordem_busca_dolar_compra'];
        $ordemDolarDi     = $aReg[0]['ordem_busca_dolar_di'];
        $tipoProjDolar    = $aReg[0]['cod_tipo_proj_dolar'];
        $vlProjDolar      = $aReg[0]['vl_proj_dolar'];
        $descProjDolar    = $this->getDescTipoProjDolar($tipoProjDolar);
        $vlDolarCompra    =  $aReg[0]['vl_dolar_compra'];
        $vlDolarDi        =  $aReg[0]['vl_dolar_di'];
    }else{
        $ordemDolarCompra = 99;
        $ordemDolarDi     = 99;
        $tipoProjDolar    = 0;
        $vlProjDolar      = 0;
        $descProjDolar    = '';
        $vlDolarCompra    =  0;
        $vlDolarDi        =  0;

    }
    switch ($tipoDolar){
        case 'compra':
            $ordem = $ordemDolarCompra;
            break;
        case 'di':
            $ordem = $ordemDolarDi;
            break;
    }
    $aOrdem = explode(',',$ordem);
    $histOrigemCompleto = '';
    if(is_array($aOrdem)){
        $tam = count($aOrdem);
        for($i=0;$i<$tam;$i++){
            $numOrdem = $aOrdem[$i];
            if($numOrdem == 3 and $logDesprezaDolarMedio == true){
                continue;
            }
            switch($numOrdem){
                case 1: 
                    $aCotacao = getDadosUltCotacao();
                    if(is_array($aCotacao)){
                        $cotacao = $aCotacao['valor'];
                        $data    = $aCotacao['data'];
                        $data    = $this->nm_conv_data_db($data,'aaaa-mm-dd','dd/mm/aaaa');
                    }else{
                        $cotacao = 0;
                        $data = '';
                    }

                    $cotacao = str_replace(',','.',$cotacao);
                    switch ($tipoProjDolar){
                        case 2:
                            $cotacao += $vlProjDolar;
                            $sinal = '';
                            break;
                        case 3:
                            $cotacao *= (1 + $vlProjDolar/100);
                            $sinal = '%';
                            break;
                    }

                    $histOrigem = "<h2>Última Cotação Em $data - Prioridade $i - Projeção:$descProjDolar - Acrescimo: $vlProjDolar $sinal ";
                    break;
                case 2: 
                    $cotacao = $vlDolarCompra;
                    $histOrigem = "<h2>Dólar compra - Prioridade $i";
                    break;

                case 3: 
                    $aDolarMedio = $this->buscarDolarMedio($containerId);
                    $cotacao     = $aDolarMedio['dolar_medio'];
                    $cotacaoSaldo = $aDolarMedio['cotacao_saldo'];
                    $histDolarSaldo = $aDolarMedio['hist_dolar']."<h2>Cotação:$cotacaoSaldo</h2>";
                    $histOrigem = "<h2>Dólar Médio - Prioridade $i";
                    break;
                case 4: 
                    $cotacao = $vlDolarDi;
                    $histOrigem = "<h2>Dólar DI - Prioridade $i";
                    break;
            }
            if($cotacao == 0 or $cotacao == 1 or $cotacao == ''){
                $histOrigemCompleto .= $histOrigem." - Não Informado/Encontrado</h2>$histDolarSaldo";
            }else{
                $histOrigemCompleto .= $histOrigem." - Encontrado - Cotação: $cotacao</h2>$histDolarSaldo";
                break;
            }
        }
    }else{
        $cotacao = 1;
        $histOrigemCompleto = "<h2>Ordem de Busca do Dólar não configurada para o container.
                        <br>Paridade 1 assumida.</h2>";
    }
    $aRetorno = array('cotacao' => $cotacao,'hist_origem' => $histOrigemCompleto);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ', " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
        $estab = substr($estab,0,1);
        $aRetornoEmpresa  = $this->retornoSimplesTb01('pub.empresas','empresa_id',"cod_emp_ems2 = $estab",'espec');
        if(is_array($aRetornoEmpresa)){
            $empresa = $aRetornoEmpresa[0]['empresa_id'];
        }
    }
    return $empresa;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $data = '2015-01-01';
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ic, pub.itens_proc_compra ip ,pub.procs_compra p ',
        'min(p.dt_registro) as data',
        " ic.item_proc_compra_id = ip.item_proc_compra_id and ip.proc_compra_id = p.proc_compra_id 
								  and ic.container_id = $containerId",'espec');
    if(is_array($aRetorno))	{
        $data = $aRetorno[0]['data'];
    }
    else{
    }
    if($data ==''){
        $data = '2005-01-01';
    }

    return $data;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetornoContainer = $this->retornoSimplesTb01('pub."pp-container"','"cod-estabel"',
        " \"nr-container\" = $containerId ",'espec');
    if(is_array($aRetornoContainer)){
        $estab = $aRetornoContainer[0]['"cod-estabel"'];
        $estab = substr($estab,0,1);
    }
    else{
        $estab = 0;
    }
    $aRetornoEmpresa = $this->retornoSimplesTb01(" pub.empresas ", " cod_emp_ems2 , cod_emp_ems5, empresa_id",
        " cod_emp_ems2 = $estab", 'espec');
    if(is_array($aRetornoEmpresa)){
        switch($sistema){
            case 'ems2':
                $retorno = $aRetornoEmpresa[0]['cod_emp_ems2'];
                break;
            case 'ems5':
                $retorno = $aRetornoEmpresa[0]['cod_emp_ems5'];
                break;
            case 'importacao':
                $retorno = $aRetornoEmpresa[0]['empresa_id'];
                break;

        }

    }
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $log = 0;
    $aSitContainer = $this->buscarSituacoesContainer($container);
    if(is_array ($aSitContainer)){
        $sitContainer = $aSitContainer['situacao_container_id'];
        $logGerarDistrSit = $this->buscarSitDistrSituacaoContainer($sitContainer);
        $logGerarDistrContainer = $this->buscarSitDistrCustoContainer($container);
        if($logGerarDistrContainer == 1 and $logGerarDistrSit == 1){
            $log = 1;
        }
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
$dolarMedio = 0;
$log = '';
$aDolar = $this->buscarDolar($container,'compra',true);
$vlCotacaoSaldo = $aDolar['cotacao'];
$histDolar      = $aDolar['hist_origem'];
$log     = "<h1>Inicio</h1>";
$log    .= "<h1>Container:$container - Cotacao Saldo:" . $this->formatarNumero($vlCotacaoSaldo,5);
    $log    .= "<h2>Hist: $histDolar</h2>";

    $totCustoPrevDolar = $this->buscarTotCustoPrevDolarContainer($container);

    $log .= "<h1>Total Previsto em Dolar ->". $this->formatarNumero($totCustoPrevDolar)." </h1>";


    $vlTotPagoDolar     = buscarTotPagoContainer($container,'dolar');
    $vlTotPagoReal      = buscarTotPagoContainer($container);
    $log.= "<h1>Dólar Pago:". $this->formatarNumero($vlTotPagoDolar) ."</h1>";
    if($vlTotPagoDolar > 0 and $vlTotPagoReal > 0){
    $vlMediaPgtos			= $vlTotPagoReal / $vlTotPagoDolar;
    $log.="<h1>Media Pagtos: vl.tot.pago em real(".$this->formatarNumero($vlTotPagoReal)
        ."  ) / vl.tot.pago em dolar(". $this->formatarNumero($vlTotPagoDolar)  .")  -> ".
        $this->formatarNumero($vlMediaPgtos,5)  ."</h1>";
    }
    else{
    $vlMediaPgtos = 0;
    $log .="<h1>Media Pagtos: Valor pago em Real Ou em Dolar zerado  ->0</h1>";
    }
    
    
    $aTotDescontoCreditosUtiliz      = buscarDescontosCreditosUtiliz($container);
    $vlDescontoCredUtilizREAL        = $aTotDescontoCreditosUtiliz[0]['tot_real_utiliz'];
    $vlDescontoCredUtilizDOLAR       = $aTotDescontoCreditosUtiliz[0]['tot_dolar_utiliz'];
    $log .= "<h1>Valor Desconto Cred. Utilizado em REAL:". $this->formatarNumero($vlDescontoCredUtilizREAL) ."</h1>";
    $log .= "<h1>Valor Desconto Cred. Utilizado em DOLAR:". $this->formatarNumero($vlDescontoCredUtilizDOLAR) ."</h1>";

    


    if($vlDescontoCredUtilizREAL == 0){
		$log .= "<h1>Valor Desconto Cred. Utilizado em REAL igual a zero</h1>";
		if($vlMediaPgtos > 0){
		$log.="<h1>Valor Desconcto Cred. Utilizado em REAL maior que zero</h1>";
		$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * $vlMediaPgtos;
		$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
			$this->formatarNumero($vlDescontoCredUtilizDOLAR)  .") * Vl.media Pagtos(".
			$this->formatarNumero($vlMediaPgtos,5) .") -> ".
			$this->formatarNumero($vlDescontoCredUtilizREAL)  ."</h1>";
		}
		else{
			if($vlCotacaoSaldo > 0){
			$log.="<h1>Valor cotacao saldo maior que zero e media de pagamento igual a zero</h1>";
			$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * $vlCotacaoSaldo;
			$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
				$this->formatarNumero($vlDescontoCredUtilizDOLAR) .") * Vl.cotacao Saldo(".
				$this->formatarNumero($vlCotacaoSaldo,5).") ->". $this->formatarNumero($vlDescontoCredUtilizREAL)." </h1>";
			}
			else{
			$log.="<h1>Valor cotacao igual a zero e media de pagamento igual a zero</h1>";
			$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * 1;
			$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
				$this->formatarNumero($vlDescontoCredUtilizDOLAR)
				.") * 1 -> ".
				$this->formatarNumero($vlDescontoCredUtilizREAL)
				."</h1>";
			}
		}
    }
    $aTotDescontoUtiliz 				  = buscarDescontosUtiliz($container);
    $vlDescontoUtilizDOLAR 		 	  	  = $aTotDescontoUtiliz[0]['tot_dolar'];
    $vlDescontoUtilizREAL   			  = $aTotDescontoUtiliz[0]['tot_real'];
    $log.="<h1>Desconto Utilizado em DOLAR(".
        $this->formatarNumero($vlDescontoUtilizDOLAR)."</h1>";
    $log.="<h1>Desconto Utilizado em REAL(".$this->formatarNumero($vlDescontoUtilizREAL)."</h1>";

    

    if($vlDescontoUtilizREAL == 0){
    $log.="<h1>Desconto Utilizado em REAL igual a zero</h1>";
        if($vlMediaPgtos > 0){
        $log.="<h1>Vl. Media de Pagtos maior que zero</h1>";
        $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * $vlMediaPgtos;
        $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR(".
            $this->formatarNumero($vlDescontoUtilizDOLAR) .") * vl.Media Pagtos( ".
            $this->formatarNumero($vlMediaPgtos,5) .") -> ".
            $this->formatarNumero($vlDescontoUtilizREAL)  ."</h1>";
        }
        else{
        $log.="<h1>Vl.Média de Pagtos igual a zero</h1>";
            if($vlCotacaoSaldo > 0){
            $log.="<h1>Vl.Cotacao de saldo Maior que zero</h1>";
            $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * $vlCotacaoSaldo;
            $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR( ".
                $this->formatarNumero($vlDescontoUtilizDOLAR) .") * vl.Cotacao Saldo(". $this->formatarNumero($vlCotacaoSaldo)  .") ->".
                $this->formatarNumero($vlDescontoUtilizREAL)  ."</h1>";
            }
            else{
            $log .= "<h1>Vl.Cotacao igual a zero</h1>" ;
            $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * 1;
            $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR(".
                $this->formatarNumero($vlDescontoUtilizDOLAR) .") * 1 -> ".$this->formatarNumero($vlDescontoUtilizREAL) ."</h1>";

            }
        }
    }


    if($logSaldoNeg == true){
        $vlProforma   =	$this->buscarTotCustoPrevDolarContainer($container,'proforma');
        $vlNegociado  =	$this->buscarTotCustoPrevDolarContainer($container,'negociado');
        $vlSaldoNeg   = $vlNegociado - $vlProforma;
        $log.="<h1>Vou agregar o valor do saldo Negociado($vlSaldoNeg) ao TotCustoPrevDolar - vl.proforma: $vlProforma 
        - vlNegociado: $vlNegociado</h1>";
        if($vlSaldoNeg > 0){
            $log.="<h1>Valor negociado maior que zero - Valor Negociado: $vlSaldoNeg</h1>";
            $totCustoPrevDolar += $vlSaldoNeg;
        }else{
            $log.="<h1>Valor negociado menor igual a zero</h1>";
        }
    }
    $vlSaldoDOLAR =  $totCustoPrevDolar
    - $vlDescontoCredUtilizDOLAR
    - $vlDescontoUtilizDOLAR
    - $vlTotPagoDolar;
    $log .= "<h1>Vl.Saldo Dolar = Tot.Custo Prev.Dolar(".
        $this->formatarNumero($totCustoPrevDolar)." - Vl.Desconto Cred.Utiliz.Dolar(".$this->formatarNumero($vlDescontoCredUtilizDOLAR)."(
        - Vl.Desconto Utiliz.Dolar(".$this->formatarNumero($vlDescontoUtilizDOLAR).") - Vl.Tot.Pago.Dolar(". $this->formatarNumero($vlTotPagoDolar).") ->".
        $this->formatarNumero($vlSaldoDOLAR)."</h1>";


    if($vlSaldoDOLAR > 0){
    $log .= "<h1>Vl.Saldo Em Dolar maior que zero</h1>";
    $vlSaldoREAL  =  $vlSaldoDOLAR * $vlCotacaoSaldo;

    $log .= "<h1>Vl.Saldo Em Real = vl. Saldo em Dolar(".
        $this->formatarNumero($vlSaldoDOLAR) .") * vl.cotacao saldo(".
        $this->formatarNumero($vlCotacaoSaldo) .") -> ".$this->formatarNumero($vlSaldoREAL)." </h1>";
    $vlTotalREAL  =  $vlTotPagoReal + $vlDescontoCredUtilizREAL  + $vlDescontoUtilizREAL +   $vlSaldoREAL;
    $log.="<h1>vl.total real = vl.tot.pago real(".
        $this->formatarNumero($vlTotPagoReal). ") + vl.desc.cred.utiliz. em Real(".
        $this->formatarNumero($vlDescontoCredUtilizREAL).")
        + vl.desc.utiliz. em Real(".
        $this->formatarNumero($vlDescontoUtilizREAL).") ->". $this->formatarNumero($vlTotalREAL)."</h1>";
    }
    else{
    $log .= "<h1>O Saldo em dolar está zerado</h1>";
    $vlTotalREAL  =  $vlTotPagoReal + $vlDescontoCredUtilizREAL  + $vlDescontoUtilizREAL;
    $log.="<h1> vl.Total em Real = vl.tot.pago real(".
        $this->formatarNumero($vlTotPagoReal)." ) + vl.desconto Cred. Utiliz. em Real(".
        $this->formatarNumero($vlDescontoCredUtilizREAL).") +
        vl.desconto utiliz. em REAL(".
        $this->formatarNumero($vlDescontoUtilizREAL) .") ->". $this->formatarNumero($vlTotalREAL)."</h1>";
    }
    if($vlTotalREAL > 0 and  $totCustoPrevDolar > 0 ){

        if($vlSaldoDOLAR < 0){
            $totCustoPrevDolar -= $vlSaldoDOLAR;
            $log .="<h1>Acrescimo do valor $vlSaldoDOLAR ao custo previsto do container em Dólar 
                    devido ao valor registrado ser maior que o valor negociado</h1>";
        }
        $log .="<h1>Total em Real e Custo Previsto Prev.Dolar  maiores que zero</h1>";
        $dolarMedio   =  round($vlTotalREAL / $totCustoPrevDolar,5);
        $log .="<h1>Dolar Médio = vl.total em real(".
            $this->formatarNumero($vlTotalREAL) .") / tot.custo.previsto dolar(".
            $this->formatarNumero($totCustoPrevDolar) .")->".$this->formatarNumero($dolarMedio,5)."</h1>";
        }
        else{
        $dolarMedio   =  0;
        $log .="<h1>Total em Real e Custo Previsto Prev.Dolar  iguais a  zero. Dolar Médio zerado</h1>";
        }

        if($dolarMedio == 0 or $dolarMedio == ''){
        $dolarMedio = 1;
        $log .="<h1>Dolar médio igual a zero ou igual a branco, dolar medio igualado a o valor 1</h1>";
        }
        $retorno = array('dolar_medio' => $dolarMedio, 'cotacao_saldo' => $vlCotacaoSaldo,
        'hist_dolar' => $histDolar,'log' => $log);
        return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " update \"pp-container\" set dt_prev_embarque = '$dtPrevEmbarque' 
			where \"nr-container\" = $containerID ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = '';
    switch($tipoProj)
    {
        case 2:
            $retorno = 'Acréscimo Monetário';
            break;
        case 3:
            $retorno = 'Acréscimo %';
            break;
        default:
            $retorno = 'Sem Acrescimo de Projeção';
    }
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($iSit == 1){
        $ultAlt = " , dt_hr_ult_alt_versao_custo = now() ";
    } else{
        $ultAlt = '';
    }
    $cmd = "update pub.\"pp-container\" set log_versao_custo_desatualizada = $iSit $ultAlt 
           where \"nr-container\" = $containerParam ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = $this->getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaContainer = '';
    $tipo     = "multi"; 
    $tabela   = " pub.\"pp-container\" ";
    $campos   = " \"nr-container\" as nr_container ";
    $condicao = "  situacao = 1 and ordem_busca_dolar_compra = 1 ";
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aRet)){
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $container = $aRet[$i]['nr_container'] ;
            $listaContainer = $this->util_incr_valor($listaContainer,$container);
        }
    }
    return $listaContainer;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesaLogImpostoOuCalc($despesaId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.despesas','log_imposto,log_calculada,perc_calculo,log_vl_prod_base_calculo'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno)){
        $logImposto   = $aRetorno[0]["log_imposto"];
        $logCalculada = $aRetorno[0]["log_calculada"];
        $percCalculo  = $aRetorno[0]["perc_calculo"];
        $logVlProdBaseCalculo = $aRetorno[0]["log_vl_prod_base_calculo"];
    }else{
        $logImposto   = 0;
        $logCalculada = 0;
        $percCalculo  = 0;
        $logVlProdBaseCalculo = 0;
    }
    $retorno = array('log_imposto' => $logImposto,'log_calculada' => $logCalculada, 'perc_calculo' => $percCalculo,
                    'log_vl_prod_base_calculo' => $logVlProdBaseCalculo);
    return $retorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesaDescr($despesaId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = '';
    $aRetorno = $this->retornoSimplesTb01('pub.despesas','descricao'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["descricao"];
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesasImposto($imposto_id,$empresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.despesas_impostos", "despesa_id", " empresa_id = $empresa and imposto_id = $imposto_id","espec");
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $campoChave = 'despesa_id';
    $tabela   = "despesas";
        $condFiltroCompl = '';
        if($campos == ''){
            $aCampos = $this->getCpsTbSessao('espec',$tabela);
            $campos = $aCampos['campos'];
        }
        if($id <> 0){
            $condicao = "$campoChave = $id";
        } else{
            $condicao = '1 = 1 ';
        }

        if($filtroCompl <> ''){
            $condicao = $this->util_incr_valor($condFiltroCompl,$filtroCompl,' AND ',true);
        }

        $tabela   = "pub.$tabela";
        $tipo     = "unico"; 
        $conexao  = "espec";
        $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
        return $aRet;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getIdsRelacDespCalculadas($despesa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $lista = '';
    $tabela   = " pub.relacs_desp_calculada ";
    $campos   = " despesa_id_base ";
    $condicao = "  despesa_id = $despesa ";
     $aRet      = $this->retornoMultReg($tabela,$campos,$condicao);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $idDespBase = $aRet[$i]['despesa_id_base'];
            $lista = $this->util_incr_valor($lista,$idDespBase);
        }        
    }
    return $lista;    

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarDespesaContainer($container_id,
                               $despId,
                               $vl_prev,
                               $calc_imp_container_id=0,
                               $vl_negociado=0,
                               $vl_proforma=0,
                               $idCtaCorrenCustoDistr=0,
                               $memoriaCalculo='',
                               $percCalc=0,
                               $itemContainerId=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($percCalc <> 0){
        $logManual = 0;
    }else{
        $logManual = 1;
    }
    $cmd = " insert into pub.despesas_container
     (despesa_container_id,despesa_id,container_id,vl_prev,calc_imp_container_id,vl_negociado,vl_proforma,
     cta_corren_custo_distr_id,memoria_calculo,perc_calc,log_manual,item_container_id) 
     values(pub.seq_despesas_container.NEXTVAL,$despId,$container_id,'$vl_prev',$calc_imp_container_id,$vl_negociado,
     $vl_proforma,$idCtaCorrenCustoDistr,'$memoriaCalculo','$percCalc',$logManual,$itemContainerId) ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = array();
    $lAchou = 0;
    $aDesp = $this->buscarDespesaLogImpostoOuCalc($despesaId);
    $logCalculada           = $aDesp['log_calculada'];
    $percCalculo            = $aDesp['perc_calculo'];
    $logVlProdBaseCalculo   = $aDesp['log_vl_prod_base_calculo'];
    $vlDespTrib         = 0;
    $vlDespProforma     = 0;
    $vlDespNegociado    = 0;
    $vlItensTrib        = 0;
    $vlItensProforma    = 0;
    $vlItensNegociado   = 0;
    $memoriaCalculo     = '';
    $totTrib            =  0;
    $totProforma        =  0;
    $totNegociado       =  0;
    if($logVlProdBaseCalculo == 1 ){
        $vlItensTrib      = $aVlItens['vl_tributado'];
        $vlItensProforma  = $aVlItens['vl_proforma'];
        $vlItensNegociado = $aVlItens['vl_negociado'];
        $vlItensTribNeg   = $aVlItens['vl_trib_neg'];
        $vlItensNegociado += $vlItensTribNeg;


    }



    if($logCalculada == 1 ){
        $logManual          = $this->verificarDespesaContainerManual($containerId,$despesaId);
        if($logManual == 0){
            
            $memVls           = "<h2>Valores dos itens:</h2><h2>Tributado:$vlItensTrib - Proforma:$vlItensProforma -
                            Negociado:$vlItensNegociado</h2>";
            $aValsDesp        = $this->calcBaseDespCalculada($containerId,$despesaId);
            if(is_array($aValsDesp)){
                $vlDespTrib       = $aValsDesp['vl_prev']      ;
                $vlDespProforma   = $aValsDesp['vl_proforma']  ;
                $vlDespNegociado  = $aValsDesp['vl_negociado'] ;
            }


            $memoriaCalculo   = $this->util_incr_valor($memoriaCalculo,$memVls,"<br>") ;
            $memoriaCalculo   = $this->util_incr_valor($memoriaCalculo,$histOrigemDolar,"<br>") ;
            $memoriaCalculo   = $this->util_incr_valor($memoriaCalculo,$aValsDesp['memoria_calculo'],"<br>") ;
            $totTrib          =  ($vlItensTrib      + $vlDespTrib)       * $percCalculo / 100 ;
            $totProforma      =  ($vlItensProforma  + $vlDespProforma)   * $percCalculo / 100 ;
            $totNegociado     =  ($vlItensNegociado  + $vlDespNegociado) * $percCalculo / 100 ;
            $aRetorno = array(
                'hist_origem_dolar' => $histOrigemDolar,
                'vl_itens_trib' => $vlItensTrib,
                'vl_itens_proforma' => $vlItensProforma,
                'vl_itens_negociado' => $vlItensNegociado,
                'vl_desp_trib' => $vlDespTrib,
                'vl_desp_proforma' => $vlDespProforma,
                'vl_desp_negociado' => $vlDespNegociado,
                'vl_tot_trib' =>$totTrib,
                'vl_tot_proforma' => $totProforma,
                'vl_tot_Negociado' => $totNegociado,
                'memoria_calculo' => $memoriaCalculo );
            $lAchou = 1;
            if($logGravarValores == true){
                $this->sincrDespesaContainer($containerId,$despesaId,$totTrib,
                    0,$totNegociado,$totProforma,0,$memoriaCalculo,$percCalculo);
            }
        }
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aDolar = $this->buscarDolar($containerParam,'compra');
    $cotacao          = $aDolar['cotacao'];
    $histOrigem       = $aDolar['hist_origem'];
    $aVlItens = $this->buscarTotCustosPrevRealContainer($containerParam,$aDolar);
    if($listaDespesas == ''){
        $listaDespesas = $this->getIdsDespesasCalcContainer($containerParam);
    }
    if($listaDespesas <> ''){
        $aListaDespesas = explode(',',$listaDespesas);
        if(is_array($aListaDespesas)){
            $tam = count($aListaDespesas);
            for($i=0;$i<$tam;$i++){
                $despesaId = $aListaDespesas[$i];
                $this->calcDespesaCalculada($containerParam,$despesaId,$aVlItens,true,$histOrigem);
            }
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $lista    = '';
    $tabela   = " pub.despesas_container ";
    $campos   = " despesa_id ";
    $condicao = " log_manual = 0 and container_id = $container";
    $aRet     = $this->getDados('multi',$tabela,$campos,$condicao,"espec");
    if(is_array($aRet)){
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aRet[$i]['despesa_id'];
            $lista = $this->util_incr_valor($lista,$despesaId,',');
        }
    }
    return $lista;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaId = $this->getIdsRelacDespCalculadas($despesaId);
    $totPrev = 0;
    $totProforma = 0;
    $totNegociado = 0;
    $aLista = explode(',',$listaId);
    $html = '<table border="1"><tr><td>Codigo</td><td>descricao</td><td>Vl.Prev.</td><td>Vl.Proforma</td>
            <td>Vl.Negociado</td></tr>';
    if(is_array($aLista) and $aLista[0] <> ''){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $despesaIDRelac  = $aLista[$i];
            $descrDesp = $this->buscarDespesaDescr($despesaIDRelac);
            $aValores        = $this->getValoresDespContainer($containerId,$despesaIDRelac);
            if(is_array($aValores)){
                $vlPrev          = $aValores[0]['vl_prev'];
                $vlProforma      = $aValores[0]['vl_proforma'];
                $vlNegociado     = $aValores[0]['vl_negociado'];
                if($vlNegociado == 0){
                    $vlNegociado = $vlPrev;
                }

            }else{
                $vlPrev          = 0;
                $vlProforma      = 0;
                $vlNegociado     = 0;
            }

            $totPrev         += $vlPrev;
            $totProforma     += $vlProforma;
            $totNegociado    += $vlNegociado;
            $linha = "<tr><td>$despesaIDRelac</td><td>$descrDesp</td><td>$vlPrev</td><td>$vlProforma</td>
                    <td>$vlNegociado</td></tr>";
            $html = $this->util_incr_valor($html,$linha,'');
        }
    }
    $linha = "<tr><td></td><td>TOTAL</td><td>$totPrev</td><td>$totProforma</td><td>$totNegociado</td></tr>";

    $html = $this->util_incr_valor($html,$linha,'');

    $html = $this->util_incr_valor($html,'</table>','');

    $aRetorno = array('vl_prev' => $totPrev,'vl_proforma' => $totProforma,'vl_negociado' => $totNegociado,
        'memoria_calculo' => $html);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $empresa  = $this->buscarEmpContainer($containerId);
    $aRetorno = $this->buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId 	= $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao 	= $aRetorno[$i]['emp_desp.vl_padrao'];
            $percCalculo    = $aRetorno[$i]['desp.perc_calculo'];
            $this->sincrDespesaContainer($containerId,$despesaId,$valorPadrao,0,0,
                0,0,'',$percCalculo);
            
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = "update pub.despesas_container set 
            vl_prev = '$vlPrev', 
            vl_negociado = $vlNegociado,
            calc_imp_container_id = $calcImpId, 
            vl_proforma = $vlProforma, 
            cta_corren_custo_distr_id = $idCtaCorrenDistr, 
            perc_calc = '$percCalc',
            memoria_calculo = '$memoriaCalculo' 
            where container_id = $containerId 
            and despesa_id = $despesaId
            and  item_container_id = $itemContainerId";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = "update pub.despesas_container set vl_prev = '$vlPrev', vl_negociado = $vlNegociado,
             vl_proforma = $vlProforma
            where despesa_container_id = $despesaContainerId";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = '';
    if($campos <> ''){
        $cmd = "update pub.despesas_container set $campos where despesa_id = $despesaId and container_id = $containerId";
        
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
      
    }else{
        $retorno = 'Campos não informados';
    }
    return $retorno;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $id = $this->buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId);
    if($id <> 0) {
        $cmd = "delete from pub.despesas_container where  despesa_container_id = $id ";
        
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
      
    }
    return $id;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['cod_usuario_corrente'])) {$_SESSION['cod_usuario_corrente'] = "";}
if (!isset($this->sc_temp_cod_usuario_corrente)) {$this->sc_temp_cod_usuario_corrente = (isset($_SESSION['cod_usuario_corrente'])) ? $_SESSION['cod_usuario_corrente'] : "";}
  
    if($usuario_id == 0){
        if(isset($this->sc_temp_cod_usuario_corrente) && $this->sc_temp_cod_usuario_corrente != ''){
            $usuario_id = $this->sc_temp_cod_usuario_corrente;
        }
    }

    $cmd = "insert into pub.calcs_imp_container(calc_imp_container_id,dt_hr_calculo,usuario_id,desc_memoria_calc, container_id) values(pub.seq_calcs_imp_container.NEXTVAL,now(),$usuario_id,'',$container_id)";
    
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
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_container ", " max(calc_imp_container_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) {$_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.calcs_imp_container', 'desc_memoria_calc',"calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $mem_calc = $aRetorno[0]['desc_memoria_calc'].$mem_calc;
    }

    $cmd = "update pub.calcs_imp_container set desc_memoria_calc = '$mem_calc'  where calc_imp_container_id = $calc_id ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
     
    $condicao = "container_id = $container_id and despesa_id = $imposto";

    
    if(is_array($aVlImposto)){
        $vlImposto 			= $aVlImposto['tributado'];
        $vlImpostoProforma   = $aVlImposto['proforma'];
        $vlImpostoNegociado	= $aVlImposto['negociado'];
    }
    else{
        $vlImposto 			= 0;
        $vlImpostoProforma   = 0;
        $vlImpostoNegociado	= 0;

    }

    $this->sincrDespesaContainer($container_id,$imposto,$vlImposto,$novoCalculo,$vlImpostoNegociado,$vlImpostoProforma);
    

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $despesaId = $this->buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $vlDespesa= 0;
    $dolarImp = 0;
    $vlPrev   = 0;
    $vlImp    = 0;
    $descrImposto = $this->buscarDespesaDescr($imposto);
    $mem_calc = "<h1>Cálculo Imposto: $descrImposto <h1>";

    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = $this->buscarEmpContainer($container_id);
    }

    $vlTribItens = $this->buscarTotCustoPrevDolarContainer($container_id,'tributado');
    $vlTribItensProforma  =	$this->buscarTotCustoPrevDolarContainer($container_id,'proforma');
    $vlTribItensNegociado =	$this->buscarTotCustoPrevDolarContainer($container_id,'negociado');
    $vlTribNegItens = $this->buscarTotCustoPrevDolarContainer($container_id,'trib_neg');

    $vlTribItensNegociado += $vlTribNegItens;

    $aDolar = $this->buscarDolar($container_id,'di');

    $dolarImp = $aDolar['cotacao'];
    $mem_calc .= $aDolar['hist_origem'];

    

    $mem_calc .= "<h2> Valor tributado dos itens em dolar:".number_format($vlTribItens,2, ',', '.')."<h2>";
    $vlTribItens = $vlTribItens * $dolarImp;
    $mem_calc .= "<h2> Valor tributado dos itens em real:".number_format($vlTribItens,2, ',', '.')."<h2>";

    $mem_calc .= "<h2> Valor tributado dos itens em dolar - PROFORMA:".number_format($vlTribItensProforma,2, ',', '.')."<h2>";
    $vlTribItensProforma = $vlTribItensProforma * $dolarImp;
    $mem_calc .= "<h2> Valor tributado dos itens em real - PROFORMA:".number_format($vlTribItensProforma,2, ',', '.')."<h2>";

    $mem_calc .= "<h2> Valor tributado dos itens em dolar - NEGOCIADO:".number_format($vlTribItensNegociado,2, ',', '.')."<h2>";
    $vlTribItensNegociado = $vlTribItensNegociado * $dolarImp;
    $mem_calc .= "<h2> Valor tributado dos itens em real - NEGOCIADO:".number_format($vlTribItensNegociado,2, ',', '.')."<h2>";
    $mem_calc .= "<h2> Valor DIF tributado - negociado(quando tributado maior) dos itens em dolar:".number_format($vlTribNegItens,2, ',', '.')."<h2>";


    $aDespesas   =  $this->buscarDespesasImposto($imposto,$empresa);
    if(is_array($aDespesas)){
        for($i=0;$i < count($aDespesas);$i++){
            $despesaImp = $aDespesas[$i]['despesa_id'];
            $aValor = $this->retornoSimplesTb01(" pub.despesas_container ",
                " sum(vl_prev) as tot_vl_prev, sum(vl_base_imp) as tot_vl_base_imp",
                " container_id = $container_id and despesa_id = ".$despesaImp,
                "espec");
            if(is_array($aValor)){
                $vlDespBaseImp = $aValor[0]['tot_vl_base_imp'];
                $vlPrev		 = $aValor[0]['tot_vl_prev'];
                if( $vlDespBaseImp <> 0 and $vlDespBaseImp <> ''){
                    $valor = $vlDespBaseImp;
                }
                else{
                    $valor = $vlPrev;
                }
                if($valor == ''){
                    $valor = 0;
                }
            }
            else{
                $valor = 0;
            }

            $logImposto = $this->buscarDespesaLogImpostoOuCalc($despesaImp);
            
            if($lSemCalcImposto == false){
                $vlDespesa += $valor;
            }
            else{
                $vlDespesa += $vlImp;
            }
            $descrDespesa = $this->buscarDespesaDescr($despesaImp);
            $mem_calc .= "<h2> Despesa :$descrDespesa ($despesaImp ) - ".number_format($valor,2, ',', '.')."<h2>";
        }
    }
    $vlImposto = ($vlDespesa + $vlTribItens) * $percentual / 100;
    $mem_calc .= "<h2>(Despesas:".number_format($vlDespesa, 2, ',', '.')." + itens:".number_format($vlTribItens,2, ',', '.').") * perc:$percentual / 100</h2>";
    $mem_calc .= "<h2>Valor Final Imposto:".number_format($vlImposto, 2, ',', '.')."</h2><hr>";
    $this->incrementarMenCalcImpContainer($novoCalculo,$mem_calc);
    $vlImpostoProforma  = ($vlDespesa + $vlTribItensProforma) * $percentual / 100;
    $vlImpostoNegociado = ($vlDespesa + $vlTribItensNegociado) * $percentual / 100;
    $aRetorno = array('tributado' => $vlImposto, 'negociado' => $vlImpostoNegociado, 'proforma' => $vlImpostoProforma);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vl_desp = 0;
    $log = '';
    $empresa = $this->buscarEmpContainer($container);
    $aRetorno = $this->retornoMultReg('pub.empresas_despesa',
        'percentual_custo, despesa_custo_id, despesa_id, percentual ',
        " empresa_id = $empresa and despesa_custo_id <> 0","espec");
    if(is_array($aRetorno)){
        $tam = count($aRetorno);
        for($i=0;$i < $tam; $i++){
            $despesaId 			= $aRetorno[$i]['despesa_id'];
            $percentual 		= $aRetorno[$i]['percentual'];
            $percentualCusto 	= $aRetorno[$i]['percentual_custo'];
            $despesaCustoId 	= $aRetorno[$i]['despesa_custo_id'];
            $aRetorno2 = $this->retornoSimplesTb01('pub.despesas_container',
                'vl_prev,vl_negociado,vl_proforma',
                " container_id = $container and despesa_id = $despesaId","espec");

            if(is_array($aRetorno2)){
                $vlPrev      = $aRetorno2[0]['vl_prev'];
                $vlNegociado = $aRetorno2[0]['vl_negociado'];
                $vlProforma  = $aRetorno2[0]['vl_proforma'];
                $vlDesp = $vlPrev / $percentual * $percentualCusto;
                $vlDespNegociado = $vlNegociado / $percentual * $percentualCusto;
                $vlDespProforma  = $vlProforma / $percentual  * $percentualCusto;
            }
            else{
                $vlDesp          = 0;
                $vlDespNegociado = 0;
                $vlDespProforma  = 0;
                $vlPrev          = 0;
                $vlNegociado     = 0;
                $vlProforma      = 0;
            }
            $descDespesaImposto = $this->buscarDespesaDescr($despesaId);
            $descDespesa = $this->buscarDespesaDescr($despesaId);
            $log .= "<h2>Gerado valor  de ". number_format($vlDesp,2,',','.') ." para 
                despesa:$despesaCustoId - $descDespesa referente ao	percentual de ".
                number_format($percentualCusto,2,",",".") ." % nao recuperavel do imposto $descDespesaImposto tributado em ". number_format($percentual,2,",",".") ." % (valor: ".
                number_format($vlPrev,2,",",".").") </h2>";
            $aRetorno = array('tributado' => $vlDesp,'negociado' => $vlDespNegociado, 'proforma' => $vlDespProforma);
            $this->atualizarCalculoImpContainer($idCalculo,$container,
                $despesaCustoId,$aRetorno);
        }
    }
    else{
        $log = "<h2>não foram encontradas despesas geradas de percentuais de custo de impostos</h2>";


    }
    $this->incrementarMenCalcImpContainer($idCalculo,$log);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    if($idCalculo == ''){
        $novoCalculo = $this->criarCalculoImpContainer($container_id);
    }
    else{
        $novoCalculo = 	$idCalculo;
    }


    $empresa     = $this->buscarEmpContainer($container_id);
    $aImpostos    = $this->buscarImpostosEmpresa($empresa);
    if(is_array($aImpostos)){
        for($i=0;$i < count($aImpostos);$i++){
            $imposto = $aImpostos[$i]['pub.despesas.despesa_id'];
            $percentual = $aImpostos[$i]['pub.empresas_despesa.percentual'];
            $logCalcImposto = $this->verificarCalcImpContainer($container_id,$novoCalculo,$imposto);
            if($logCalcImposto != 1){
                $aVlImposto = $this->calcularImpostoContainer($container_id,
                    $imposto,
                    $percentual,
                    $novoCalculo,
                    $empresa);

                $this->atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto);
            }
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vlTot = 0;

    $tabelas = 'pub.despesas_container desp_container, 
                pub.empresas_despesa desp_empresa,
                pub.empresas empresas,
                pub.despesas desp,
                pub."pp-container" container';
    $campos = 'sum(vl_prev) as tot';
    $condicao = "desp_container.container_id = $containerId 
                and  substring(container.\"cod-estabel\",1,1) = empresas.cod_emp_ems2
                and  empresas.empresa_id = desp_empresa.empresa_id
                and  desp_container.despesa_id = desp_empresa.despesa_id
                and desp.despesa_id = desp_empresa.despesa_id
                and  desp_empresa.log_custo = 1
                and container.\"nr-container\" = desp_container.container_id
                ";

    $aRetorno = $this->retornoSimplesTb01($tabelas,
        $campos,
        $condicao,
        "espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->Ini->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $totDif   = 0.00;


    $tipo     = "multi"; 
    $tabela   = " pub.despesas_container desp, pub.empresas_despesa  emp_desp ";
    $campos   = " emp_desp.log_custo as log_custo, desp.vl_prev as vl_prev, desp.vl_negociado as vl_negociado,
                  desp.despesa_container_id as despesa_container_id
                  ";
    switch($nivel){
        case 'container':
            $condNivel = " and desp.container_id = $idParam and desp.item_container_id = 0";
            break;
        case 'item':
            $condNivel = " and desp.item_container_id = $idParam ";
            break;
        default:
            $condNivel = '';

    }
    $condicao = " desp.despesa_id = emp_desp.despesa_id
                  and emp_desp.empresa_id = 2 $condNivel ";
    $conexao  = "espec";


    $aDados = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i<$tam;$i++){
            $logCusto       = $aDados[$i]['log_custo'];
            $vlPrev         = $aDados[$i]['vl_prev'];
            $vlNegociado    = $aDados[$i]['vl_negociado'];
            $despesaContainerId = $aDados[$i]['despesa_container_id'];

            if($logCusto == 1 and $vlNegociado <> 0 and $vlNegociado > $vlPrev){
                $totDif += $vlNegociado - $vlPrev;
            }
        }
    }
    return $totDif;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo = $this->getCpTipoVlDespContainer($tipo);
    $tipo     = "unico"; 
    $tabela   = " pub.despesas_container desp_container, 
                pub.empresas_despesa desp_empresa,
                pub.empresas empresas,
                pub.despesas desp,
                pub.\"pp-container\" container ";
    $campo   = "sum($campo) as valor ";
    $condicao = "  item_container_id = $itemContainerId
                and  substring(container.\"cod-estabel\",1,1) = empresas.cod_emp_ems2
                and  empresas.empresa_id = desp_empresa.empresa_id
                and  desp_container.despesa_id = desp_empresa.despesa_id
                and desp.despesa_id = desp_empresa.despesa_id
                and  desp_empresa.log_custo = 1                
                and container.\"nr-container\" = desp_container.container_id";
    $conexao  = "espec";
    $aTotal = $this->getDados($tipo,$tabela,$campo,$condicao,$conexao);
    if(is_array($aTotal)){
        $vl = $aTotal[0]['valor'];
    }
    return $vl;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo = $this->getCpTipoVlDespContainer($tipo);
    $tipo     = "unico"; 
    $tabela   = 'pub.despesas_container desp_container, 
                pub.empresas_despesa desp_empresa,
                pub.empresas empresas,
                pub.despesas desp,
                pub."pp-container" container';
    $campo   = "sum($campo) as valor ";
    $condicao = " desp_container.container_id = $containerParam 
                and item_container_id = 0 
                and  substring(container.\"cod-estabel\",1,1) = empresas.cod_emp_ems2
                and  empresas.empresa_id = desp_empresa.empresa_id
                and  desp_container.despesa_id = desp_empresa.despesa_id
                and desp.despesa_id = desp_empresa.despesa_id                           
                and container.\"nr-container\" = desp_container.container_id
                and desp_empresa.log_custo = 1";
    $conexao  = "espec";
    $aTotal = $this->getDados($tipo,$tabela,$campo,$condicao,$conexao);
    if(is_array($aTotal)){
        $vl = $aTotal[0]['valor'];
    }
    return $vl;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $campo = 'vl_prev';
    switch ($tipo){
        case 'tributado':
            $campo = "vl_prev";
            break;
        case 'proforma':
            $campo = 'vl_proforma';
            break;
        case 'proforma':
            $campo = 'vl_proforma';
            break;
    }
    return $campo;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $despesaIpi = $this->getIdDespesaIPI();
    $empresa    = $this->buscarEmpERPContainer($container,'importacao');
    $log        = $this->validarDespIPIEmpresa($despesaIpi,$empresa);
    $memoria    = '';
    if($log == true){
        $memoria = "<h1>1-Despesa de IPI cadastrada para o estabelecimento do Container </h1>";
        $aVls = $this->buscarTotCustosPrevRealContainer($container);

        $aItens = $this->buscarIDItensContainer($container,
                                  'item_container_id,log_calc_ipi,perc_ipi');
        $aVlBase        = $this->calcBaseDespesaContainer($container,$despesaIpi,$empresa);
        if(is_array($aItens)){
            $memoria = $this->util_incr_valor($memoria,
                '<h1>2-Itens Encontrados para o Container</h1>','');
            $tam = count($aItens);
            for($i=0;$i<$tam;$i++){
                $itemContainerId = $aItens[$i]['item_container_id'];
                $aVlImposto = $this->calcularIpiItemContainer($container,
                                                       $itemContainerId,
                                                       $despesaIpi,
                                                       $aVls,
                                                       $aVlBase);
                $vlIpiTrib      = $aVlImposto['vl_tributado'];
                $vlIpiPro       = $aVlImposto['vl_proforma'];
                $vlIpiNeg       = $aVlImposto['vl_negociado'];
                $memoria    = $this->util_incr_valor($memoria,$aVlImposto['memoria'],'',true);
                $aItensIpi[] = array('item_container_id'=> $itemContainerId,
                    'vl_tributado' => $vlIpiTrib,
                    'vl_proforma'  => $vlIpiPro,
                    'vl_negociado' => $vlIpiNeg,
                    'memoria'      => $memoria,
                    'despesa_id'   => $despesaIpi,
                    'container'    => $container,
                    'perc_ipi'     => 0);
            }
            $aRetorno = array('log_calc_imp'=> true,'memoria'=>$memoria,'itens_ipi'=>$aItensIpi);

        }else{
            $memoria = $this->util_incr_valor($memoria,
                '<h1>2-Itens NÃO Encontrados para o Container</h1>','');
            $aRetorno = array('log_calc_imp'=> false,'memoria'=>$memoria,'itens_ipi' =>'');

        }
    }else{

        $memoria = "<h1>1-Despesa de IPI Não cadastrada para o estabelecimento do Container </h1>";
        $aRetorno = array('log_calc_imp'=> false,'memoria'=>$memoria,'itens_ipi' =>'');

    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRet = $this->calcularIpiItensContainer($container);
    $logCalculado = $aRet['log_calc_imp'];
    if($logCalculado == true){
        $memoriaCalculo = $aRet['memoria'];
        $aItens = $aRet['itens_ipi'];
        if(is_array($aItens)){
            $tam = count($aItens);
            for($i=0;$i<$tam;$i++){
                $itemContainerId = $aItens[$i]['item_container_id'];
                $vlTrib          = $aItens[$i]['vl_tributado'];
                $vlPro           = $aItens[$i]['vl_proforma'];
                $vlNeg           = $aItens[$i]['vl_negociado'];
                $despesaId       = $aItens[$i]['despesa_id'];
                $percIpi         = $aItens[$i]['perc_ipi'];
                if($vlTrib + $vlNeg + $vlPro > 0){
                    $this->sincrDespesaContainer($container,$despesaId,$vlTrib,0,$vlNeg,$vlPro,0,
                        $memoriaCalculo,$percIpi,$itemContainerId);
                }

            }
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $itemDescr       = $this->getDescrItemContainer($itemContainerId);
    $aRegItem = $this->getRegItemContainer($itemContainerId,'log_calc_ipi,perc_ipi');
    if(is_array($aRegItem)){
        $logCalcIpi      = $aRegItem['log_calc_ipi'];
        $percIpi         = $aRegItem['perc_ipi'];
    }else{
        $logCalcIpi      = 0;
        $percIpi         = 0;
    }
    if($container==0){
        $container = $this->getContainerItemContainer($itemContainerId);
    }
    if($despesaIpi == 0){
        $despesaIpi = $this->getIdDespesaIPI();
    }
    $empresa    = $this->buscarEmpERPContainer($container,'importacao');

    $logDespEmp   = $this->validarDespIPIEmpresa($despesaIpi,$empresa);
    if($logDespEmp == true){
        if($logCalcIpi == 1){
            if(!is_array($aVls)){
                $aVls = $this->buscarTotCustosPrevRealContainer($container);
            }
            $vlTotItensTrib     = $aVls['vl_tributado'];
            $vlTotItensPro      = $aVls['vl_proforma'];
            $vlTotItensNeg      = $aVls['vl_negociado'];

            $aVlsItem = $this->buscarTotCustosPrevRealContainer($container,'',$itemContainerId);
            $vlItemTrib = $aVlsItem['vl_tributado'];
            $vlItemPro = $aVlsItem['vl_proforma'];
            $vlItemNeg = $aVlsItem['vl_negociado'];

            $fatorTrib      = $vlItemTrib / $vlTotItensTrib;
            $fatorPro       = $vlItemPro  / $vlTotItensPro;
            $fatorNeg       = $vlItemNeg  / $vlTotItensNeg;

            if($aVlBase == ''){
                $aVlBase        = $this->calcBaseDespesaContainer($container,$despesaIpi,$empresa);
            }
            $vlDespTrib     = round($aVlBase['vl_tributado'],2);
            $vlDespPro      = round($aVlBase['vl_proforma'],2);
            $vlDespNeg      = round($aVlBase['vl_negociado'],2);
            $memoria        = $aVlBase['memoria'];

            $vlIpiTrib      = round(($vlItemTrib  + ($vlDespTrib   * $fatorTrib)) * $percIpi / 100,2);
            $vlIpiPro       = round(($vlItemPro   +  ($vlDespPro   * $fatorPro))  * $percIpi / 100,2);
            $vlIpiNeg       = round(($vlItemNeg   +  ($vlDespNeg   * $fatorNeg))  * $percIpi / 100,2);


            $memoria     = $this->util_incr_valor($memoria,"<h1>% IPI: $percIpi </h1>",'');
            $memoria     = $this->util_incr_valor($memoria,
                "<h1>vl.Item $itemContainerId -> Trib.: $vlItemTrib - Prof.:$vlItemPro - Neg.:$vlItemNeg  </h1>",
                '');
            $memoria     = $this->util_incr_valor($memoria,
                "<h1>Vl.IPI Trib: $vlIpiTrib -> Base: $vlDespTrib - Fator:$fatorTrib  </h1>",
                '');
            $memoria     = $this->util_incr_valor($memoria,
                "<h1>Vl.IPI Proforma: $vlIpiPro -> Base: $vlDespPro - Fator:$fatorPro  </h1>",
                '');
            $memoria     = $this->util_incr_valor($memoria,
                "<h1>Vl.IPI Negociado: $vlIpiNeg -> Base: $vlDespNeg - Fator:$fatorNeg  </h1>",
                '');
            $aRetorno    = array('item_container_id' => $itemContainerId,
                'vl_tributado' => $vlIpiTrib,
                'vl_proforma'  => $vlIpiPro,
                'vl_negociado' => $vlIpiNeg,
                'memoria'      => $memoria,
                'despesa_id'   => $despesaIpi,
                'container'    => $container,
                'perc_ipi'    => $percIpi);
        }
        else{ 
            $memoria ="<h1>Item $itemContainerId - $itemDescr está marcado para não calcular IPI</h1>";
            $aRetorno = array('item_container_id' => $itemContainerId,
                'vl_tributado' => 0,
                'vl_proforma'  => 0,
                'vl_negociado' => 0,
                'memoria'      => $memoria,
                'despesa_id'   => $despesaIpi,
                'container'    => $container,
                'perc_ipi'    => 0);
        }
    }else{ 
        $aRetorno = array('item_container_id' => $itemContainerId,
            'vl_tributado' => 0,
            'vl_proforma'  => 0,
            'vl_negociado' => 0,
            'memoria'      => "<h1>Despesa IPI não cadastrada para a empresa do Container do item $itemContainerId - $itemDescr </h1> ",
            'despesa_id'   => $despesaIpi,
            'container'    => $container,
            'perc_ipi'    => 0);
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $memoriaBaseCalc = '<h1>Despesas da Base De calculo:</h1><table border="1"><tr><td>Imposto</td>
<td>Vl.Trib</td><td>Vl.Proforma</td><td>Vl.Neg</td></tr>';
    if($empresa ==0){
        $empresa    = $this->buscarEmpERPContainer($container,'importacao');
    }
    $aDespesas = $this->buscarDespesasImposto($despesaId,$empresa);
    $totVlTrib = 0;
    $totVlNeg  = 0;
    $totVlPro  = 0;

    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despBaseCalc =$aDespesas[$i]['despesa_id'];
            $descrDesp    = $this->buscarDespesaDescr($despBaseCalc);
            $aDespBaseCalc = $this->getDadosDespContainer($container,$despBaseCalc);
            if(is_array($aDespBaseCalc)){
                $vlTributado         = $aDespBaseCalc[0]['vl_prev'];
                $vlBaseImposto  = $aDespBaseCalc[0]['vl_base_imp'];
                $vlNegociado    = $aDespBaseCalc[0]['vl_negociado'];
                $vlProforma     = $aDespBaseCalc[0]['vl_proforma'];
            }else{
                $vlTributado         = 0;
                $vlBaseImposto  = 0;
                $vlNegociado    = 0;
                $vlProforma     = 0;
            }

            if($vlBaseImposto <> 0 and $vlBaseImposto <> '' ){
                $vlTributado = $vlBaseImposto;
            }
            $totVlTrib += $vlTributado;
            $totVlNeg  += $vlNegociado;
            $totVlPro  += $vlProforma;
            $incremento = "<tr><td>$descrDesp</td><td>$vlTributado</td><td>$vlProforma</td><td>$vlNegociado</td></tr>";
            $memoriaBaseCalc = $this->util_incr_valor($memoriaBaseCalc,$incremento,'');
        }
    }
    $memoriaBaseCalc .= "<tr><td>TOTAL</td><td>$totVlTrib</td><td>$totVlPro</td><td>$totVlNeg</td></tr>";
    $memoriaBaseCalc .= "</table>";
    $aRetorno = array('vl_tributado' => $totVlTrib,'vl_proforma' => $totVlPro,
                      'vl_negociado' => $totVlNeg, 'memoria'=>$memoriaBaseCalc);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = $this->getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarDespesaProcCompra($proc_compra_id, $despesa_id, $valor, $calc_id = 0 )
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.despesas_proc_compra(despesa_proc_compra_id,proc_compra_id, despesa_id,vl_prev,calc_imp_proc_compra_id) 
	        values(pub.seq_despesas_proc_compra.NEXTVAL, 
			       $proc_compra_id,
			       $despesa_id,
				   $valor,
				   $calc_id)";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarDespesasProcCompra($proc_compra_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $empresa  = buscarEmpProcCompra($proc_compra_id);
    $aRetorno = $this->buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId = $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao = $aRetorno[$i]['emp_desp.vl_padrao'];
            $this->criarDespesaProcCompra($proc_compra_id, $despesaId, $valorPadrao);
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularImpostosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $novoCalculo = $this->criarCalculoImpProcCompra();

    $empresa     = buscarEmpProcCompra($procCompraIdParam);
    $aImpostos    = $this->buscarImpostosEmpresa($empresa);
    if(is_array($aImpostos)){
        for($i=0;$i < count($aImpostos);$i++){
            $imposto = $aImpostos[$i]['pub.despesas.despesa_id'];
            $percentual = $aImpostos[$i]['pub.empresas_despesa.percentual'];
            $logCalcImposto = $this->verificarCalcImpProcCompra($procCompraIdParam,$novoCalculo,$imposto);
            if($logCalcImposto != 1){
                $vlImposto = $this->calcularImposto($procCompraIdParam,
                                             $imposto,
                                             $percentual,
                                             $novoCalculo,
                                             $empresa);
                $this->atualizarCalculoImposto($novoCalculo,$procCompraIdParam,	$imposto,$vlImposto);
            }
        }
    }


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularImposto($proc_compra_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = buscarEmpProcCompra($proc_compra_id);
    }

    $vlTribItens = buscarVlTribItens($proc_compra_id);
    $aDespesas   =  $this->buscarDespesasImposto($imposto,$empresa);
    if(is_array($aDespesas)){
        for($i=0;$i < count($aDespesas);$i++){
            $despesaImp = $aDespesas[$i]['despesa_id'];
            $aValor = $this->retornoSimplesTb01(" pub.despesas_proc_compra ", " sum(vl_prev) as tot_vl_prev",
                                         " proc_compra_id = $proc_compra_id and despesa_id = ".$despesaImp,"espec");
            if(is_array($aValor)){
                $valor = $aValor[$i]['tot_vl_prev'];
                if($valor == ''){
                    $valor = 0;
                }

            }
            else{
                $valor = 0;
            }
            $aLogImposto = $this->buscarDespesaLogImpostoOuCalc($despesaImp);
            $logImposto = $aLogImposto['log_imposto'];

            if($logImposto == 1){
                $logCalcImposto = $this->verificarCalcImpProcCompra($proc_compra_id,$novoCalculo,$despesaImp);
                if($logCalcImposto != 1){
                    $lSemCalcImposto = true;
                    $perc  = $this->buscarImpostoPerc($despesaImp,$empresa);
                    $vlImp = $this->calcularImposto($proc_compra_id,$despesaImp,$perc,$novoCalculo,$empresa);
                    $this->atualizarCalculoImposto($novoCalculo,$proc_compra_id,$imposto,$vlImp);
                }
            }
            if($lSemCalcImposto == false){
                $vlImposto += $valor;
            }
            else{
                $vlImposto += $vlImp;
            }
        }
    }
    $vlImposto = ($vlImposto + $vlTribItens) * $percentual / 100;
    return $vlImposto;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarCalculoImpProcCompra($usuario_id = 0 )
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['cod_usuario_corrente'])) {$_SESSION['cod_usuario_corrente'] = "";}
if (!isset($this->sc_temp_cod_usuario_corrente)) {$this->sc_temp_cod_usuario_corrente = (isset($_SESSION['cod_usuario_corrente'])) ? $_SESSION['cod_usuario_corrente'] : "";}
  
    if($usuario_id == 0){
        if(isset($this->sc_temp_cod_usuario_corrente) && $this->sc_temp_cod_usuario_corrente != ''){
            $usuario_id = $this->sc_temp_cod_usuario_corrente;
        }
    }

    $cmd = "insert into pub.calcs_imp_proc_compra(calc_imp_proc_compra_id,dt_hr_calculo,usuario_id) values(pub.seq_calcs_imp_proc_compra.NEXTVAL,now(),$usuario_id)";
    
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
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_proc_compra ", " max(calc_imp_proc_compra_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) {$_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarCalcImpProcCompra($proc_compra_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra','despesa_proc_compra_id',
                                   " proc_compra_id = $proc_compra_id and despesa_id = $despesa and
								     calc_imp_proc_compra_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;



$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarCalculoImposto($novoCalculo,$proc_compra_id,	$imposto,$vlImposto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $condicao = "proc_compra_id = $proc_compra_id and despesa_id = $imposto";
    $tabela   = 'pub.despesas_proc_compra';
    $aRetorno = $this->retornoSimplesTb01($tabela,
                                   'despesa_id',
                                   $condicao);
    if(is_array($aRetorno)){
        $cmd = "update $tabela set calc_imp_proc_compra_id = $novoCalculo, vl_prev = $vlImposto
   		  where $condicao ";
        
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
      
    }
    else{
        $this->criarDespesaProcCompra($proc_compra_id,$imposto, $vlImposto, $novoCalculo );
    }
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotDespesasProcCompra($procCompraID)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $vlTot = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra', 'sum(vl_prev) as tot'," proc_compra_id = $procCompraID ","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarcodEmpresa($codigo,$sistOrigem,$sistDestino)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela = "pub.empresas"; 
    $codEmpresa = '';
    switch($sistOrigem){
        case 'ems2':
            $condicao = " cod_emp_ems2 = '".substr($codigo,0,1)."'";
            break;
        case 'ems5':
            $condicao = " cod_emp_ems5 = '$codigo'";
            break;
        case 'importacao':
            $condicao = " empresa_id   = '$codigo'";
            break;
    }
    switch($sistDestino){
        case 'ems2':
            $campo = " cod_emp_ems2";
            break;
        case 'ems5':
            $campo = "cod_emp_ems5";
            break;
        case 'importacao':
            $campo = "empresa_id";
            break;
    }

    $aEmpresa = $this->retornoSimplesTb01($tabela,$campo,$condicao,'espec');
    if(is_array($aEmpresa)){
        $codEmpresa = $aEmpresa[0]["$campo"];
    }
    return $codEmpresa	;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getEstabEms5($estab)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    switch (substr($estab,0,1)){
        case '1':
        case '100':

            $retorno = '101';
            break;
        case '5':
        case '500':
            $retorno = '501';
            break;
        default:
            $retorno = $estab;
    }
    return $retorno;



$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesasEmp($empresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = array();

    $aRetorno = $this->retornoMultReg('pub.empresas_despesa emp_desp INNER JOIN pub.despesas desp
                               ON emp_desp.despesa_id = desp.despesa_id',
        'emp_desp.despesa_id, emp_desp.vl_padrao, desp.perc_calculo',
        " emp_desp.log_ativo = 1 and desp.log_imposto = 0
							  and emp_desp.empresa_id = $empresa","espec");

    return $aRetorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarImpostosEmpresa($empresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id, pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 
        and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 
        and pub.empresas_despesa.empresa_id = $empresa and pub.despesas.log_calc_por_item = 0","espec");
    return $aRetorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarImpostoPerc($despesa,$empresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $perc = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id,pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 									and pub.empresas_despesa.empresa_id = $empresa 
								    and pub.empresas_despesa.despesa_id = $despesa",
        "espec");
    if(is_array($aRetorno)){
        $perc = $aRetorno[0]['pub.empresas_despesa.percentual'];
    }
    return $perc;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarImpostoPercCusto($despesaID,$empresa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $perc = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.empresas_despesa, pub.despesas",
        "pub.empresas_despesa.percentual_custo as perc_custo",
        " pub.despesas.log_imposto = 1 and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 									and pub.empresas_despesa.empresa_id = $empresa 
								    and pub.empresas_despesa.despesa_id = $despesaID",
        "espec");
    if(is_array($aRetorno)){
        $perc = $aRetorno[0]['perc_custo'];
    }
    return $perc;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosEmpresaDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
        $tabela   = "empresas_despesa";
        $campoChave = "empresa_despesa_id";
        if($campos == ''){
            $aCampos = $this->getCpsTbSessao('espec',$tabela);
            $campos = $aCampos['campos'];
        }
        if($id <> 0){
            $condicao = "$campoChave = $id";
        } else{
            $condicao = '1 = 1 ';
        }

        if($filtroCompl <> ''){
            $condicao = $this->util_incr_valor($condicao,$filtroCompl,' AND ',true);
        }

        $tabela   = "pub.$tabela";
        $tipo     = "unico"; 
        $conexao  = "espec";
        $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
        return $aRet;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDescFornecedor($fornecedor)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = array();
    $lAchou  = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.fornecedor', 'nom_abrev,cdn_fornecedor', "cdn_fornecedor = $fornecedor", 'ems5');
    if(is_array($aRetorno)){
        $retorno = $aRetorno[0]['nom_abrev']."(".$aRetorno[0]['cdn_fornecedor'].")" ;
        $lAchou = 1;
    }
    if($lAchou == 0){
        $retorno = '';
    }
    return $retorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarNomeAbrevFornecedor($fornecedor)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = array();
    $lAchou = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.fornecedor', 'nom_abrev', "cdn_fornecedor = $fornecedor", 'ems5');
    if(is_array($aRetorno)){
        $retorno = $aRetorno[0]['nom_abrev'];
        $lAchou = 1;
    }
    if($lAchou == 0){
        $retorno = '';
    }
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela   = "itens_container";
    $condFiltroCompl = '';
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',$tabela);
        $campos = $aCampos['campos'];
    }
    if($itemContainer <> 0){
        $condicao = "item_container_id = $itemContainer";
    } else{
        $condicao = '1 = 1 ';
    }

    if($filtroCompl <> ''){
        $condicao = $this->util_incr_valor($condFiltroCompl,$filtroCompl,' AND ',true);
    }

    $tabela   = "pub.$tabela";
    $tipo     = "unico"; 
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aRet[0];


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $tabela = "pub.itens_container";
    $campos = "item_proc_compra_id";
    $condicao = "item_container_id = $itemContainerID";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aValores)){
        $itemProcCompra = $aValores[0]['item_proc_compra_id'];
    }
    else{
        $itemProcCompra = 0;
    }
    $fornec = buscarFornecItemProcCompra($itemProcCompra);
    return $fornec;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $procCompraId = 0;
    $tabela = "pub.itens_container";
    $campos = "item_proc_compra_id";
    $condicao = "item_container_id = $itemContainerID";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aValores)){
        $itemProcCompra = $aValores[0]['item_proc_compra_id'];
        $procCompraId = buscarProcCompraItem($itemProcCompra);
    }
    return $procCompraId;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $logExiste = false;
    $tipo     = "unico"; 
    $tabela   = " pub.itens_container ";
    $campos   = " count(item_container_id) as qt ";
    $condicao = " container_id = $containerParam ";
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aRet)){
        $qt = $aRet[0]['qt'];
        if( $qt <> 0 and $qt <> ''){
            $logExiste = true;
        }
    }
    return $logExiste;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $contAloc = 0;
    $logItensExistente = false;
    if(is_array($aItens)){
        $tot = count($aItens);
        for($x = 0; $x < $tot; $x++){
            $itemID           = $aItens[$x]['ID'];
            $qtAlocada        = buscarQtAlocItemProc($itemID);
            $logJaSelecionado = buscarItemAlocado($container_id,$itemID);
            $qtComprada       = $aItens[$x]['qt_comprada'];
            $qtDisponivel     = $qtComprada - $qtAlocada;
            if($logJaSelecionado == false){
                $cmd = "insert into pub.itens_container(item_container_id,container_id,item_proc_compra_id,qt_alocada)
                     values(pub.seq_itens_container.NEXTVAL, $container_id,$itemID,$qtDisponivel) ";
                
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
      
            }
            else{
                $logItensExistente = true;
            }
        }
    }
    return $logItensExistente;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $condItem = '';
    if($item <> ''){
        $condItem = " and item_container_id = $item";
    }
    $vlCampo = '';
    switch($tipo){
        case 'tributado':
            $vlCampo = 'pub.itens_proc_compra.vl_base_tributacao';
            $cond = '';
            break;
        case 'proforma':
            $vlCampo = 'pub.itens_proc_compra.vl_custo_dolar';
            $cond = '';
            break;
        case 'negociado':
            $vlCampo = 'pub.itens_proc_compra.vl_negociado';
            $cond = '';
            break;
        case 'trib_neg':
            $vlCampo = "(pub.itens_proc_compra.vl_base_tributacao - pub.itens_proc_compra.vl_negociado)";
            $cond = " and pub.itens_proc_compra.vl_base_tributacao > pub.itens_proc_compra.vl_negociado ";
         break;
    }
    $valor = 0;
    $tabelas  =  "pub.itens_proc_compra, pub.itens_container, pub.procs_compra";
    $campos   =  "sum($vlCampo * pub.itens_container.qt_alocada 
                  ) as tot_alocado,
				  sum($vlCampo * pub.itens_container.qt_confirm_emb 
                  ) as tot_emb
				 ";
    $condicao = " pub.itens_container.container_id = $containerId 
                  and pub.itens_container.item_proc_compra_id =  pub.itens_proc_compra.item_proc_compra_id 
                  and pub.procs_compra.proc_compra_id =  pub.itens_proc_compra.proc_compra_id $condItem $cond" ;
    $aRetorno = $this->retornoSimplesTb01($tabelas, $campos,$condicao,"espec");
    if(is_array($aRetorno)){

        $vlAlocado = $aRetorno[0]['tot_alocado'];
        $vlEmb     = $aRetorno[0]['tot_emb'];
        if($vlEmb == 0){
            $valor = $vlAlocado;
        }
        else{
            $valor = $vlEmb;
        }
    }
    return $valor;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valorEmReal = 0;
    $valorEmDOLAR = $this->buscarTotCustoPrevDolarContainer($containerId,$tipo,$item);
    if($aCotacao == ''){
        if($tipo == 'tributado'){
            $aCotacao     = $this->buscarDolar($containerId,'di');
        }else{
            $aCotacao     = $this->buscarDolar($containerId,'compra');
        }
    }
    $cotacao      = $aCotacao['cotacao'];
    if($cotacao == 0 or $cotacao == ''){
        $cotacao = 1;
    }
    if(is_numeric($valorEmDOLAR) and is_numeric($cotacao)){
        $valorEmReal = $valorEmDOLAR * $cotacao;
    }else{
        $valorEmReal = $valorEmDOLAR;
    }
    return $valorEmReal;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aCustoItens                    	 = array();
    $lAchou                              = false;
    $vlPagoItens                	     = buscarTotPagoContainer($containerId);
    $aPondItens             	         = $this->buscarValoresItensNFImp($containerId);
    $listaNatOperNfMae                   = $this->getListaNatOperNotaMae();
    if(is_array($aPondItens)){
        $qtItens   = count($aPondItens);
    }else{
        $qtItens = 0;
    }
    $vlTotNFMae         	             = 0;
    $vlDesp      		                 = 0;

    $vlPgRatItem                     	 = 0;
    $percRateio							 = 0;

    if(is_array($aPondItens) and $qtItens > 0)  {
        for($i = 0; $i < $qtItens ;$i++){
            $natOperacao = $aPondItens[$i]['nat_operacao'] ;
            $valorMercad = $aPondItens[$i]['vl_mercad'];

            if(strpos($listaNatOperNfMae,$natOperacao)){
                $vlTotNFMae +=  $valorMercad;
            }
            
        }

        for($i = 0; $i < $qtItens; $i++){
            $natOperacao = $aPondItens[$i]['nat_operacao'] ;
            $valorMercad = $aPondItens[$i]['vl_mercad'];
            $itCodigo    = $aPondItens[$i]['item'];
            $valorDesp   = $aPondItens[$i]['vl_despesa'];

            if($i > 0){
                $itCodigoAnt = $aPondItens[$i - 1]['item'];
            }
            else{
                $itCodigoAnt    = $aPondItens[$i]['item'];
            }

            if($itCodigoAnt != $itCodigo){

                $aCustoItens[]      = array(	'item' => $itCodigoAnt,
                    'vl_custo' => $vlPgRatItem,
                    'vl_desp' => $vlDesp,
                    'perc_rateio' => $percRateio,
                    'vl_nota_mae' => $vlTotNFMae);
                $lAchou = true;
                $vlDesp             = 0;
                $vlPgRatItem        = 0;
            }
            if($i == $qtItens - 1  and $itCodigoAnt == $itCodigo){
                $aCustoItens[]      = array('item' => $itCodigoAnt,
                    'vl_custo' => $vlPgRatItem,
                    'vl_desp' => $vlDesp,
                    'perc_rateio' => $percRateio,
                    'vl_nota_mae' => $vlTotNFMae);
                $lAchou = true;
                $vlDesp             = 0;
                $vlPgRatItem        = 0;
            }

            if(strpos($listaNatOperNfMae,$natOperacao)){
                $percRateio  	=  $valorMercad / $vlTotNFMae;
                $vlPgRatItem 	=  $percRateio * $vlPagoItens;
                $vlDesp       +=  $valorDesp;
            }
            
            else{
                $vlDesp        += $valorMercad;
            }
            if($qtItens == 1){
                $aCustoItens[] = array('item' => $itCodigo,
                    'vl_custo' => $vlPgRatItem,
                    'vl_desp' => $vlDesp,
                    'perc_rateio' => 100,
                    'vl_nota_mae' => $vlTotNFMae );
                $lAchou = true;
            }
        }
    }
    if($lAchou == false){
        $aCustoItens = '';
    }
    return $aCustoItens;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aValores   = array();
    $vl_merc_prev          = 0;
    $vl_desp_prev          = 0;
    $vl_total_prev         = 0;
    $vl_desp_real          = 0;
    $vl_merc_real          = 0;
    $vl_desc_item          = 0;
    $vl_total_real         = 0;
    $vl_desc_container     = 0;
    $aItens = $this->calcularCustoGeralItem($containerId,'','',$moeda);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i =0;$i < $tam;$i++){
            $vl_merc_prev          += $aItens[$i]['vl_merc_prev'];
            $vl_desp_prev          += $aItens[$i]['vl_desp_prev'];
            $vl_total_prev         += $aItens[$i]['vl_total_prev'];
            $vl_desp_real          += $aItens[$i]['vl_desp_real'];
            $vl_merc_real          += $aItens[$i]['vl_merc_real'];
            $vl_desc_item          += $aItens[$i]['vl_desc_item'];
            $vl_total_real         += $aItens[$i]['vl_total_real'];
            $vl_desc_container     += $aItens[$i]['vl_desc_container'];
        }
    }
    $aValores[] = array("vl_desp_prev" => $vl_desp_prev ,
        "vl_total_prev"=> $vl_total_prev,
        "vl_desp_real" => $vl_desp_real,
        "vl_total_real"=> $vl_total_real );

    return $aValores;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $aRetorno                               = array();
    $lAchou                                 = false;
    $retornoVlRatDespSemDistrCusto          = 0;
    $retornoVlRatDesp                       = 0;
    $retornoVlUnitarioPrevisto              = 0;
    $retornoVlUnitarioPrevistoSemDistrCusto = 0;

    
    $retornoVlDesp                          =  0;
    $retornoVlMerc                          =  0;
    $retornoVlDesconto                      =  0;
    $retornoVlDescContainer                 =  0;
    $retornoVlCustoReal                     =  0;
    $retornoVlDespSemDistrCusto             =  0;
    


    $aTotDescontoCreditosUtiliz      = buscarDescontosCreditosUtiliz($container);
    if(is_array($aTotDescontoCreditosUtiliz)){
        $vlDescontoCredUtilizREAL        = $aTotDescontoCreditosUtiliz[0]['tot_real_utiliz'];
        $vlDescontoCredUtilizDOLAR       = $aTotDescontoCreditosUtiliz[0]['tot_dolar_utiliz'];
    }else{
        $vlDescontoCredUtilizREAL        = 0;
        $vlDescontoCredUtilizDOLAR       = 0;
    }



    if($totDespesas ==''){
        $totDespesas = $this->getTotDespContainerRatItem($container,$tipoCusto);
        
    }

    if($totCustoPrevDolar ==''){
        $totCustoPrevDolar = $this->buscarTotCustoPrevDolarContainer($container,$tipoCusto);
    }
    $aItens                = $this->buscarIDItensContainer($container);

    if($logBuscarCustoReal == true){
        $aItensReal         = $this->buscarCustoRealItens($container);
    }
    else{
        $aItensReal = '';
    }
    if($tipoCusto == 'negociado'){
        $aDolarMedio = $this->buscarDolarMedio($container,'negociado');
    }else{
        $aDolarMedio = $this->buscarDolarMedio($container,'proforma');
    }
    if(is_array($aDolarMedio)){
        $vlCotacaoMediaDolar = $aDolarMedio['dolar_medio'];
        $vlCotacaoSaldo      = $aDolarMedio['cotacao_saldo'];
        $histDolarMedio      = $aDolarMedio['hist_dolar'];
    }else{
        $vlCotacaoMediaDolar = 0;
        $vlCotacaoSaldo      = 0;
        $histDolarMedio      = '';
    }


    
    



    
    if(is_array($aItens)){
        $tam = count($aItens);
        for($j=0;$j < $tam; $j++){

            

            $itemContainerID  			= $aItens[$j]['item_container_id'];

            if($logBuscarDespSemDistrCusto){
                $vlDistrParaItem  = getTotalDistrParaItemContainer($itemContainerID);
                $vlDistrPorItem   = 0 ; 
                $vlDistrSaldo     =  ($vlDistrPorItem + $vlDistrParaItem) *-1;
            }else{
                $vlDistrSaldo = 0;
            }

            $aTotDescontoUtiliz 		= buscarDescontosUtiliz($container,$itemContainerID);
            $vlDescontoUtilizDOLAR      = $aTotDescontoUtiliz[0]['tot_dolar'];
            $vlDescontoUtilizREAL       = $aTotDescontoUtiliz[0]['tot_real'];


            $itemProcCompraID 			= $aItens[$j]['item_proc_compra_id'];
            $qtAlocada        			= $aItens[$j]['qt_alocada'];
            $qtConfirmEmb      			= $aItens[$j]['qt_confirm_emb'];
            $qtRecbtoFisico      		= $aItens[$j]['qt_recbto_fisico'];
            $vlItemProcCompra 			= buscarVlItemProcCompra($itemProcCompraID,$tipoCusto);

            
            if($qtConfirmEmb == 0){
                $vlTotCustoDolar   = ($vlItemProcCompra * $qtAlocada) - $vlDescontoUtilizDOLAR;
            }
            else{
                $vlTotCustoDolar   	= ($vlItemProcCompra * $qtConfirmEmb) - $vlDescontoUtilizDOLAR;
            }

            
            if($vlTotCustoDolar > 0 && $totCustoPrevDolar  > 0 ){
                
                $percPondPrev			= $vlTotCustoDolar / $totCustoPrevDolar;
                if($totDespesas > 0){
                    $retornoVlRatDespSemDistrCusto =  $percPondPrev  * $totDespesas;
                    $retornoVlRatDesp               = $percPondPrev  * $totDespesas  + $vlDistrSaldo;
                }
                else{
                    $retornoVlRatDesp 	= 0;
                    $retornoVlRatDespSemDistrCusto =  $vlDistrSaldo;
                }

                
                $vlDespItem = $this->getTotDespItemContainer($itemContainerID,$tipoCusto);


                $retornoVlRatDesp += $vlDespItem;
                $retornoVlRatDespSemDistrCusto += $vlDespItem;

            }
            else{
                $percPondPrev		            = 0;
                $retornoVlRatDesp               = 0;
                $retornoVlRatDespSemDistrCusto  = 0;
            }


            


            
            if( $moeda == 'dolar'){
                $retornoTotCusto       =  $vlTotCustoDolar  ;
                $retornoVlRatDesp   = $retornoVlRatDesp / $vlCotacaoMediaDolar;
                $retornoVlRatDespSemDistrCusto = $retornoVlRatDespSemDistrCusto / $vlCotacaoMediaDolar;
            }
            else{
                $retornoTotCusto    = $vlTotCustoDolar * $vlCotacaoMediaDolar  ;

            }
            $retornoVlCustoFinal              =  $retornoTotCusto + $retornoVlRatDesp;
            $retornoVlCustoFinalSemDistrCusto =  $retornoTotCusto + $retornoVlRatDespSemDistrCusto;



            if($retornoVlCustoFinal <> 0 and $qtAlocada <> 0){
                if($qtConfirmEmb == 0){
                    $retornoVlUnitarioPrevisto = $retornoVlCustoFinal / $qtAlocada ;
                    $retornoVlUnitarioPrevistoSemDistrCusto = $retornoVlCustoFinalSemDistrCusto / $qtAlocada ;
                }
                else{
                    $retornoVlUnitarioPrevisto = $retornoVlCustoFinal / $qtConfirmEmb ;
                    $retornoVlUnitarioPrevistoSemDistrCusto = $retornoVlCustoFinalSemDistrCusto / $qtConfirmEmb ;
                }
            }


            


            $codItem                = buscarCodItemERP($itemProcCompraID);

            

            $retornoVlMerc          = 0 ;
            $retornoVlDesp          = 0 ;
            $retornoVlDesconto      = 0 ;
            $base                   = 0 ;
            $retornoVlCustoReal     = 0 ;
            $retornoVlDescContainer = 0 ;

            if(is_array($aItensReal)){
                for($i=0;$i < count($aItensReal );$i++){
                    $itCodigo        = $aItensReal[$i]['item'];
                    $vlCustoItem     = $aItensReal[$i]['vl_custo'];
                    $vlCustoItem     -= $vlDescontoUtilizREAL;
                    $vlDesp          	= $aItensReal[$i]['vl_desp'];
                    $percRateio     	= $aItensReal[$i]['perc_rateio'];
                    $vlNotaMae	    	= $aItensReal[$i]['vl_nota_mae'];

                    if( $itCodigo == $codItem){
                        if($moeda == 'dolar'){
                            $fator = $vlCotacaoMediaDolar;
                        }
                        else{
                            $fator = 1;
                        }
                        $retornoVlMerc          = $vlCustoItem / $fator ;
                        $retornoVlDesp          = $vlDesp / $fator ;
                        $retornoVlDesconto      = $vlDescontoUtilizREAL / $fator;
                        $retornoVlDescContainer = $vlDescontoCredUtilizREAL * $percRateio / $fator;
                        $base                   = $retornoVlMerc + $retornoVlDesp
                            - $retornoVlDesconto + $retornoVlDescContainer;
                        $retornoVlCustoReal     = $base;

                    }
                }
            }
            if($base > 0 and $qtConfirmEmb > 0){
                $retornoVlUnit = $base / $qtConfirmEmb;
            }
            else{
                $retornoVlUnit = 0;
            }


            if($qtRecbtoFisico == 0){
                $retornoQtSaldo = $qtConfirmEmb - $qtAlocada;
            }
            else{
                $retornoQtSaldo = $qtRecbtoFisico - $qtAlocada;
            }

            $aRetorno[] = array("item_container_id" => $itemContainerID ,
                "vl_desp_prev"           => $retornoVlRatDesp,
                "vl_desp_prev_sem_distr_custo" => $retornoVlRatDespSemDistrCusto,
                "vl_merc_prev"           => $retornoTotCusto,
                "vl_total_prev"          => $retornoVlCustoFinal,
                "vl_total_prev_sem_distr_custo" => $retornoVlCustoFinalSemDistrCusto,
                "vl_unit_prev"           => $retornoVlUnitarioPrevisto,
                "vl_unit_prev_sem_distr_custo" => $retornoVlUnitarioPrevistoSemDistrCusto,
                "vl_desp_real"           => $retornoVlDesp,
                "vl_merc_real"           => $retornoVlMerc,
                "vl_desc_item"           => $retornoVlDesconto,
                "vl_desc_container"      => $retornoVlDescContainer,
                "vl_total_real"          => $retornoVlCustoReal,
                "vl_unit_real"           => $retornoVlUnit,
                "qt_saldo"               => $retornoQtSaldo,
                "dolar_medio"            => $vlCotacaoMediaDolar,
                "cotacao_saldo"          => $vlCotacaoSaldo,
                "hist_dolar"             => $histDolarMedio );
            $lAchou = true;
        }
    }
    if($lAchou == false){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " update pub.item_container_custos set item_custo_id = $item_custo_id
			where item_container_custo_id = $item_container_custos_id";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = false;
    $aItens = $this->buscarIDItensContainer($container);
    $tam = count($aItens);
    if(is_array($aItens) and $tam > 0){
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $codErp = buscarCodItemERP($itemProcCompraId);
            if($codErp == ''){
                $retorno = true;
                break;
            }
        }
    }
    return $retorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $descricao = '';
    $tipo     = "unico"; 
    $tabela   = " pub.itens_container item_container, pub.itens_proc_compra item_pedido ";
    $campos   = " descricao, codigo_erp ";
    $condicao = "  item_container_id = $itemContainerId 
    and item_container.item_proc_compra_id = item_pedido.item_proc_compra_id ";
    $conexao  = "espec";
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aReg)){
        $descricao = $aReg[0]['descricao']  ;
        $codErp    = $aReg[0]['codigo_erp']   ;
        if($codErp <> ''){
            $descricao .= " ($codErp)";
        }
    }
    return $descricao;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaContainers = '';
    $aDados = $this->getDados('multi','pub.itens_container item','distinct container_id as container_id ',
                        "item_proc_compra_id = $itemPedImp","espec",
                        " pub.container  container on  container.container_id = item.container_id ");
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $container = $aDados[$i]['container_id'];
            $listaContainers = $this->util_incr_valor($listaContainers,$container,',');
        }
    }
    return $listaContainers;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Vou Chamar a funcao getRegitemContainer(itemContainer)',"Sim($itemContainerParam)",__FUNCTION__);
    $aRegItem = $this->buscarDadositemContainer($itemContainerParam);
    $aRegItem = $aRegItem[0];
    $data = date('Y-m-d');
    if(is_array($aRegItem)){
        inserirLogDb('Encontrou o item do container ?',"sim($itemContainerParam)",__FUNCTION__);
        incrNivelCorrenteLogDb();
        $qtAlocada = $aRegItem['qt_alocada'];
        inserirLogDb('qt.alocada',$qtAlocada,__FUNCTION__);
        $qtConfirmEmb = $aRegItem['qt_confirm_emb'];
        inserirLogDb('qt.confirm.emb.',$qtConfirmEmb,__FUNCTION__);
        $itemProcCompraId = $aRegItem['item_proc_compra_id'];
        inserirLogDb('item.proc.compra',$itemProcCompraId,__FUNCTION__);
        $containerId      = $aRegItem['container_id'];
        inserirLogDb('container',$containerId,__FUNCTION__);
        $vlNegociado = buscarVlItemProcCompra($itemProcCompraId,'negociado');
        inserirLogDb('vl.negociado - funcao buscarVlItemProcCompra(item do pedido,tipo=negociado) ',
            "$vlNegociado($itemProcCompraId)",__FUNCTION__);
        decrNivelCorrenteLogDb();
        if($qtConfirmEmb > 0){
            $qtDif =  $qtConfirmEmb - $qtAlocada;
            inserirLogDb('qt.Dif = qt.confirm.emb  - qt.alocada',"$qtDif = $qtConfirmEmb - $qtAlocada", __FUNCTION__);
            if($qtDif <> 0){
                inserirLogDb('qt.dif diferente de zero?','sim',__FUNCTION__);
                inserirLogDb('vou chamar a funcao getSomasCtaCorrenFornec(tipoMovto,tem quebra?,num.titulo,item pedido,item container',
                    "sim (10,sim,0,0,$itemContainerParam)",__FUNCTION__);
                $aRealCtaCorrenFornec10 = getSomasCtaCorrenFornec(10,true,
                    0,0,$itemContainerParam);
                if(is_array($aRealCtaCorrenFornec10)){
                    $vlRealCtaCorrenFornec10 = $aRealCtaCorrenFornec10[0]['valor'];
                }else{
                    $vlRealCtaCorrenFornec10 = 0;
                }
                inserirLogDb("Valor ja lancado no conta corrente fornecedor para o item do container($itemContainerParam) 
                tipo lancto: qt.confirm.emb.",$vlRealCtaCorrenFornec10,  __FUNCTION__);

                $vlRealCtaCorrenFornec3 = 0;
                
                $vlRealCtaCorrenFornec = $vlRealCtaCorrenFornec3 + $vlRealCtaCorrenFornec10;

                inserirLogDb(" TOTAL  ja lancado no conta corrente fornecedor para o item do container($itemContainerParam) 
                ",$vlRealCtaCorrenFornec,  __FUNCTION__);

                $vlDif = $qtDif * $vlNegociado;
                inserirLogDb('vl.dif = qt.dif * vl.negociado',"$vlDif = $qtDif * $vlNegociado",__FUNCTION__);
                $vlSaldo = $vlDif - $vlRealCtaCorrenFornec;
                $vlSaldo = round($vlSaldo,2);
                inserirLogDb('vl.saldo = vl.dif - vl. ja lancado no conta corrente fornecedor',
                    "$vlSaldo = $vlDif - $vlRealCtaCorrenFornec",__FUNCTION__);
                if($vlSaldo <> 0){
                    inserirLogDb('valor saldo zerado?','nao',__FUNCTION__);
                    $fornec = buscarFornecItemProcCompra($itemProcCompraId);

                    inserirLogDb('fornecedor do container - funcao buscarFornecItemProcCompra(itemProccompraId)',"$fornec(itemProcCompra:$itemProcCompraId)",__FUNCTION__);
                    $transacao = iniciarTransacao(__FUNCTION__);
                    inserirLogDb('inicio transacao',$transacao,__FUNCTION__);
                    criarRegCtaCorrenFornec($fornec,$data,$itemProcCompraId,
                        "Confirmacao de Qt. Embarcada($qtConfirmEmb)",10,
                        $vlSaldo,2,0,$itemContainerParam);
                    inserirLogDb('Final Transacao - apos funcao criarRegCtaCorrenFornec',__FUNCTION__,__FUNCTION__);
                    finalizarTransacao($transacao);
                }else{
                    inserirLogDb('valor saldo zerado?','SIM - lancamento nao sera gerado',__FUNCTION__);
                }
            }else{
                inserirLogDb('qt.dif diferente de zero?','NAO - lancamento na conta corrente fornecedor nao sera gerando',__FUNCTION__);
            }
        }
    }else{
        inserirLogDb('Item do Container Encontrado?',"item( $itemContainerParam ) nao encontrado");
    }
    inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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
                echo "<h1>id não numerico: $idChave <br> id: $idReg <br> descrição: $desc <br> $data </h1>";
            }
        }


        $this->dadoslog->MoveNext();
    }
    $this->dadoslog->Close();
}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
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
                        "<a target='_blank' href='../cons_log_apl/cons_log_apl.php?apl_corrente=$aplCorrente'>Log's Aplicação Corrente</a>",
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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarValoresNFs($estab,$documento,$serie,$natOperacao,$codEmitente)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela 	= 'pub."docum-est"';
    $campos 	= '"despesa-nota","valor-mercad"';
    $condicao 	= "\"cod-estabel\" = '$estab' and \"nro-docto\" = '$documento'
				and \"serie-docto\" = '$serie' and \"nat-operacao\" = '$natOperacao' 
				and \"cod-emitente\" = '$codEmitente' ";
    if($estab == '1'){
        $aRetorno 	= $this->retornoSimplesTb01($tabela,$campos,$condicao,"ems2ima");
    }
    else{
        $aRetorno 	= $this->retornoSimplesTb01($tabela,$campos,$condicao,"ems2med");
    }
    return $aRetorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarNfAssociadasContainer($nrContainer)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.nfs_container","documento, serie, estab, nat_operacao, cod_emitente", "container_id = $nrContainer",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01("pub.nfs_container",
        "documento, serie, estab, nat_operacao, cod_emitente",
        "container_id = $nrContainer and substring(nat_operacao,1,1) ='3'",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDtEmisNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $data = '2001-01-01';
    $aRetorno = $this->buscarNotaMaeContainer($nrContainer);
    if(is_array($aRetorno)){
        $estab     = $aRetorno[0]['estab'];
        $documento = $aRetorno[0]['documento'];
        $serie     = $aRetorno[0]['serie'];
        if($estab == '1'){
            $conexao = 'ems2ima';
        }
        else{
            $conexao = 'ems2med';
        }
        $aNota = $this->retornoSimplesTb01('pub."nota-fiscal"','"dt-emis-nota" as dt_emis_nota',
            " \"cod-estabel\" = '$estab' and serie = '$serie'
									and \"nr-nota-fis\" = '$documento' " , $conexao);
        if(is_array($aNota)){
            $data = $aNota[0]['dt_emis_nota'];
        }
    }
    return $data;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarQtRecContainer($containerId,$item)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aNfMae =  $this->buscarNotaMaeContainer($containerId);
    if(is_array($aNfMae)){
        $documento 	 = $aNfMae[0]['documento'];
        $serie 		 = $aNfMae[0]['serie'];
        $estab 		 = $aNfMae[0]['estab'];
        $natOperacao = $aNfMae[0]['nat_operacao'];
        $codEmitente = $aNfMae[0]['cod_emitente'];
        switch($estab){
            case '1':
                $conexao = "ems2ima";
                break;
            case '5':
                $conexao = "ems2med";
            default:
                $conexao = "ems2med";
        }
        $aTotaisItens = $this->retornoMultReg("pub.\"item-doc-est\"",
            "sum(quantidade) as quant",
            "  \"nro-docto\" = '$documento' and \"nat-operacao\" ='$natOperacao' and  \"serie-docto\" = '$serie'
		and \"cod-emitente\" = $codEmitente and \"it-codigo\" = '$item' ",$conexao);
        return $aTotaisItens;

    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarNfsPorEmbarque($nrEmbarque)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    




$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespesasRealizadas($containerId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    

    $totDespesa  = 0;
    $aNFs = $this->buscarNfAssociadasContainer($containerId);
    if(is_array($aNFs)){
        for($i = 0; $i < count($aNFs); $i++){
            $estab 		= $aNFs[$i]['estab'];
            $serie 		= $aNFs[$i]['serie'];
            $documento 	= $aNFs[$i]['documento'];
            $natOperacao	= $aNFs[$i]['nat_operacao'];
            $codEmitente	= $aNFs[$i]['cod_emitente'];
            $tabela   = 'pub."docum-est"';
            $campos   = 'sum("despesa-nota") as totdesp, sum("valor-mercad") as totmercad';
            $condicao =  " \"nro-docto\" = '$documento' and \"cod-emitente\" = $codEmitente and \"nat-operacao\" = '$natOperacao' 
			and \"serie-docto\" = '$serie' and \"cod-estabel\" = '$estab' ";
            switch($estab){
                case '1':
                    $conexao = "ems2ima";
                    break;
                case '5':
                    $conexao = "ems2med";
                default:
                    $conexao = "ems2med";
            }
            $aTotDesp = $this->retornoSimplesTb01($tabela,$campos,$condicao,$conexao);
            if(is_array($aTotDesp)){
                $vlDespesa = $aTotDesp[0]['totdesp'];
                $vlMercad  = $aTotDesp[0]['totmercad'];
                $totDespesa += $vlDespesa ;
                $listaNatOperNFMae = $this->getListaNatOperNotaMae();
                if(strpos($listaNatOperNFMae, $natOperacao) === false){
                    $totDespesa += $vlMercad;
                }

                
            }
        }
    }
    return $totDespesa;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarValoresItensNFImp($containerId,$item = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $aRetorno = array();
    $lAchou = 0;
    $aNFs = $this->buscarNfAssociadasContainer($containerId);
    $codEmitente = 0;
    $estab = '';
    $listaChaveBusca = '';
    if(is_array($aNFs)){
        for($y = 0; $y < count($aNFs); $y++){

            $serie 		= $aNFs[$y]['serie'];
            $documento 	= $aNFs[$y]['documento'];
            $natOperacao	= $aNFs[$y]['nat_operacao'];

            if($codEmitente == 0){
                $codEmitente	= $aNFs[$y]['cod_emitente'];
            }
            if($estab == ''  or $estab == 0){
                $estab 		= $aNFs[$y]['estab'];
            }
            $comum = "'$serie$documento$natOperacao'";
            if($listaChaveBusca == ''){
                $listaChaveBusca	 = $comum;
            }
            else{
                $listaChaveBusca .= ','.$comum;
            }
        }
        $tabela   = 'pub."item-doc-est"';
        $campos   = '  "it-codigo", "nat-operacao",sum(quantidade) as qt, sum(to_number(pro_element("despesas"|1|1))) as totdesp, sum(to_number(pro_element("preco-total"|1|1))) as totmercad';
        $condicao =  " \"serie-docto\" + \"nro-docto\" +  \"nat-operacao\" in 
					($listaChaveBusca) and \"cod-emitente\" = $codEmitente " ;
        if($item != ''){
            $condicao .= " and \"it-codigo\" = '$item' ";
        }
        $condicao .= "group by \"it-codigo\", \"nat-operacao\" order by \"it-codigo\" ";

        switch($estab){
            case '1':
                $conexao = "ems2ima";
                break;
            case '5':
                $conexao = "ems2med";
            default:
                $conexao = "ems2med";
        }
        $aTotDesp = $this->retornoMultReg($tabela,$campos,$condicao,$conexao);
        if(is_array($aTotDesp)){
            for($x = 0; $x < count($aTotDesp);$x++ ){
                $vlMercad  	   = $aTotDesp[$x]['totmercad'];
                $itemNat 	   = $aTotDesp[$x]['"it-codigo"'];
                $quant         = $aTotDesp[$x]['qt'];
                $natOperacaoIt = $aTotDesp[$x]['"nat-operacao"'];
                $vlDespesa 	   = $aTotDesp[$x]['totdesp'];
                $aCOFINS = $this->buscarCustoCOFINSNFMae($containerId,$itemNat);
                $aPIS	 = $this->buscarCustoPISNFMae($containerId,$itemNat);

                if(is_array($aCOFINS)){
                    $vlDespCOFINS = $aCOFINS[0]['vl_desp'];
                    $vlCOFINS	  = $aCOFINS[0]['vl_cofins'];
                    $natOperacaoCOFINS  = $aCOFINS[0]['nat_operacao'];
                }
                else{
                    $vlDespCOFINS = 0;
                    $vlCOFINS = 0;
                    $natOperacaoCOFINS  = '';
                }

                if(is_array($aPIS)){
                    $vlDespPIS = $aPIS[0]['vl_desp'];
                    $vlPIS	  = $aPIS[0]['vl_pis'];
                    $natOperacaoPIS  = $aPIS[0]['nat_operacao'];
                }
                else{
                    $vlDespPIS = 0;
                    $vlPIS = 0;
                    $natOperacaoPIS = '';
                }
                if($natOperacaoCOFINS == $natOperacaoIt ){
                    $vlDespesa = $vlDespesa - $vlCOFINS  + $vlDespCOFINS;
                }
                if($natOperacaoPIS == $natOperacaoIt ){
                    $vlDespesa = $vlDespesa - $vlPIS  + $vlDespPIS;
                }
                $aRetorno[]  = array('item' => $itemNat, 'vl_mercad' => $vlMercad, 'vl_despesa' => $vlDespesa,
                    'nat_operacao' => $natOperacaoIt,'quant'=> $quant );
                $lAchou = '';
            }
        }
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDespRealizadasItens($containerId,$item='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vlTotDesp = 0;
    $aRetorno = array();
    $lAchou = 0;
    $aItens = $this->buscarValoresItensNFImp($containerId,$item);
    $qtItens = count($aItens);
    if(is_array($aItens)){
        for($i = 0;$i < $qtItens;$i++){
            $natOperacao = $aItens[$i]['nat_operacao'];
            $vlMercad    = $aItens[$i]['vl_mercad'];
            $vlDespesa   = $aItens[$i]['vl_despesa'];
            $itCodigo	= $aItens[$i]['item'];
            if($i > 0){  $itCodigoAnt = $aItens[$i - 1]['item'];}
            else{$itCodigoAnt	= $aItens[$i]['item'];}
            if($itCodigoAnt != $itCodigo){
                $aRetorno[] = array('item' => $itCodigoAnt, 'vl_despesa' => $vlTotDesp);
                $vlTotDesp = 0;
            }
            $listaNatOperacaoNFMae = $this->getListaNatOperNotaMae();
            if(strpos($listaNatOperacaoNFMae,$natOperacao) === false){
                $vlTotDesp += $vlMercad;
            }
            
            $vlTotDesp += $vlDespesa;
            if($qtItens == 1){
                $aRetorno[] = array('item' => $itCodigo, 'vl_despesa' => $vlTotDesp);
                $lAchou = 1;
            }
        }
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCustoCOFINSNFMae($container,$item='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $aNota = $this->buscarNotaMaeContainer($container);
    $codDespesa = $this->buscarParametroIma('cod_despesa_cofins');
    $aRetorno = array();
    $lAchou = 0;
    if (is_array($aNota)){
        $docum = $aNota[0]["documento"];
        $serie = $aNota[0]["serie"];
        $estab = $aNota[0]["estab"];
        $natOperacao = $aNota[0]["nat_operacao"];
        $codEmitente = $aNota[0]["cod_emitente"];
        $codEmpresa = $this->buscarcodEmpresa($estab,'ems2','importacao');
        $percCusto  = $this->buscarImpostoPercCusto($codDespesa,$codEmpresa);
        if($estab == '1'){
            $conexao = 'ems2ima';
        }
        else{
            $conexao = 'ems2med';
        }
        $tabela = 'pub."item-doc-est"';
        $campos = " \"nat-operacao\" as nat_operacao ,sum(\"val-cofins\" / \"val-aliq-cofins\" * $percCusto ) as valor_desp, sum(\"val-cofins\") as val_cofins ";
        $condicao = " \"nro-docto\" = '$docum' and \"serie-docto\" = '$serie' and \"nat-operacao\" = '$natOperacao'
		and \"cod-emitente\" = $codEmitente ";
        if($item <> ''){
            $condicao  .= " and \"it-codigo\" = '$item'";
        }
        $condicao .= " group by \"nat-operacao\" ";

        $aCofins = $this->retornoSimplesTb01($tabela,$campos,$condicao,$conexao);
        if(is_array($aCofins)){
            $vlDesp 		= $aCofins[0]['valor_desp'];
            $vlCofins	= $aCofins[0]['val_cofins'];
            $natOper    	= $aCofins[0]['nat_operacao'];

            $aRetorno[] 	= array('nat_operacao' => $natOper ,'vl_desp' => $vlDesp, 'vl_cofins' =>  $vlCofins );
            $lAchou         = 1;
        }
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarCustoPISNFMae($container, $item = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    
    $aNota = $this->buscarNotaMaeContainer($container);
    $codDespesa = $this->buscarParametroIma('cod_despesa_pis');
    $aRetorno = array();
    $lAchou = 0;
    if (is_array($aNota)){
        $docum = $aNota[0]["documento"];
        $serie = $aNota[0]["serie"];
        $estab = $aNota[0]["estab"];
        $natOperacao = $aNota[0]["nat_operacao"];
        $codEmitente = $aNota[0]["cod_emitente"];
        $codEmpresa = $this->buscarcodEmpresa($estab,'ems2','importacao');
        $percCusto  = $this->buscarImpostoPercCusto($codDespesa,$codEmpresa);
        if($estab == '1'){
            $conexao = 'ems2ima';
        }
        else{
            $conexao = 'ems2med';
        }
        $tabela = 'pub."item-doc-est"';
        $campos = "\"nat-operacao\" as nat_operacao, sum(\"valor-pis\" / \"val-aliq-pis\" * $percCusto ) as valor_desp, sum(\"valor-pis\") as valor_pis";
        $condicao = " \"nro-docto\" = '$docum' and \"serie-docto\" = '$serie' and \"nat-operacao\" = '$natOperacao'
		and \"cod-emitente\" = $codEmitente";
        if($item <> ''){
            $condicao  .= " and \"it-codigo\" = '$item'";
        }
        $condicao .= " group by \"nat-operacao\" ";
        $aPis = $this->retornoSimplesTb01($tabela,$campos,$condicao,$conexao);
        if(is_array($aPis)){
            $vlDesp 	= $aPis[0]['valor_desp'];
            $vlPis  	= $aPis[0]['valor_pis'];
            $natOper    = $aPis[0]['nat_operacao'];

            $aRetorno[] = array('nat_operacao' => $natOper  ,  'vl_desp' => $vlDesp, 'vl_pis' =>  $vlPis);
            $lAchou = 1;
        }
    }
    if($lAchou == 0){
        $aRetorno = '';
    }
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotTribContainer($container,$tipo='tributado')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = 0;
    switch ($tipo)
    {
        case 'tributado':
            $campoValor = 'desp_cont.vl_prev' ;
            break;
        case 'proforma':
            $campoValor = 'desp_cont.vl_proforma' ;
            break;
        case 'negociado':
            $campoValor = 'desp_cont.vl_negociado' ;
            break;

    }

    $tabela = "pub.despesas_container desp_cont";
    $campos = "sum($campoValor) as vl_trib";
    $condicao = "desp_cont.despesa_id in(
select desp.despesa_id from pub.despesas desp
where desp.log_imposto = 1
union
select desp.despesa_id from pub.despesas desp
where desp.despesa_id in
(select emp_desp.despesa_custo_id  from pub.empresas_despesa emp_desp
 where emp_desp.despesa_custo_id <> 0)) and
 desp_cont.container_id = $container";
    $aTotal = $this->retornoSimplesTb01($tabela,$campos,$condicao,'espec');
    if($aTotal <> ''){
        $retorno = $aTotal[0]['vl_trib'];
    }
    return $retorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotDifImp($container, $tipo,$tipoComp)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $vlTipo = $this->buscarTotTribContainer($container,$tipo);
    $vlTipoComp = $this->buscarTotTribContainer($container,$tipoComp);
    $vlSaldoDistr = $vlTipo - $vlTipoComp;
    return $vlSaldoDistr;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTitAssociadosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaIdTitulos = '';
    $aRetorno = $this->retornoMultReg('pub.pagtos_proc_compra','num_id_tit_ap',
        " proc_compra_id = $procCompraIdParam ","espec" );
    if(is_array($aRetorno)){
        for($i =0;$i < count($aRetorno);$i++){
            if($listaIdTitulos == ''){
                $listaIdTitulos = $aRetorno[$i]['num_id_tit_ap'];
            }
            else{
                $listaIdTitulos .= ','.$aRetorno[$i]['num_id_tit_ap'];
            }
        }
    }
    return $listaIdTitulos;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarVlTotPagtoProcCompra($procCompraId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompraId);
    $codEstab     = buscarEmpERPProcCompra($procCompraId,'ems5');
    $codEstab     += 1 ;
    $valor = buscarTotPagoLista($codEstab,$listaTitulos,'dolar');
    return $valor;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarVlPgtoAssocContainer($procCompra,$container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valor = 0;
    $listaTitulosASomar = '';
    $listaTitulosAssocProcCompra = $this->buscarTitAssociadosProcCompra($procCompra);
    $aTitulosProcCompra = explode(",",$listaTitulosAssocProcCompra);
    $listaTitulosAssocContainer = buscarTitAssociadosContainer($container);
    $aTitulosContainer = explode(",",$listaTitulosAssocContainer);
    $qtProcCompra = count($aTitulosProcCompra);
    $qtContainer  = count($aTitulosContainer);

    for($i=0;$i<$qtProcCompra;$i++){
        for($j=0;$j<$qtContainer;$j++){
            if($aTitulosProcCompra[$i] = $aTitulosContainer[$j]){
                $listaTitulosASomar = $this->util_incr_valor($listaTitulosASomar,
                    $aTitulosContainer[$j]);
                break;
            }
        }
    }
    $codEmpresa = buscarEmpERPProcCompra($procCompra,'ems5');
    $codEstab = $codEmpresa + 1;
    $valor = buscarTotPagoLista($codEstab,$listaTitulosASomar,'dolar');
    return $valor;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function preencherCondPgtoProcCompra($condicaoTitAP)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['dt_reg_proc_compra_corrente'])) {$_SESSION['dt_reg_proc_compra_corrente'] = "";}
if (!isset($this->sc_temp_dt_reg_proc_compra_corrente)) {$this->sc_temp_dt_reg_proc_compra_corrente = (isset($_SESSION['dt_reg_proc_compra_corrente'])) ? $_SESSION['dt_reg_proc_compra_corrente'] : "";}
if (!isset($_SESSION['empresa_proc_compra_corrente_ems5'])) {$_SESSION['empresa_proc_compra_corrente_ems5'] = "";}
if (!isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) {$this->sc_temp_empresa_proc_compra_corrente_ems5 = (isset($_SESSION['empresa_proc_compra_corrente_ems5'])) ? $_SESSION['empresa_proc_compra_corrente_ems5'] : "";}
if (!isset($_SESSION['fornecedor_proc_compra_corrente'])) {$_SESSION['fornecedor_proc_compra_corrente'] = "";}
if (!isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$this->sc_temp_fornecedor_proc_compra_corrente = (isset($_SESSION['fornecedor_proc_compra_corrente'])) ? $_SESSION['fornecedor_proc_compra_corrente'] : "";}
  

    

    if($this->sc_temp_fornecedor_proc_compra_corrente != ''){
        if($condicaoTitAP != '') 	  $operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador." cdn_fornecedor =". $this->sc_temp_fornecedor_proc_compra_corrente;
    }

    if($this->sc_temp_empresa_proc_compra_corrente_ems5 != ''){
        if($condicaoTitAP != '') 	  $operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador."  cod_empresa =". $this->sc_temp_empresa_proc_compra_corrente_ems5;

    }
    if($this->sc_temp_dt_reg_proc_compra_corrente != ''){
        if($condicaoTitAP != '') $operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador."   dat_emis_docto >= '".$this->sc_temp_dt_reg_proc_compra_corrente."'" ;
    }
    return $condicaoTitAP;

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
if (isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) {$_SESSION['empresa_proc_compra_corrente_ems5'] = $this->sc_temp_empresa_proc_compra_corrente_ems5;}
if (isset($this->sc_temp_dt_reg_proc_compra_corrente)) {$_SESSION['dt_reg_proc_compra_corrente'] = $this->sc_temp_dt_reg_proc_compra_corrente;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function existTitProcCompra($numIdTitAp,$procCompraId=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($procCompraId <> 0){
        $condProcCompra = " and proc_compra_id = $procCompraId ";
    }else{
        $condProcCompra = "";
    }

    $tipo     = "unico"; 
    $tabela   = " pub.pagtos_proc_compra ";
    $campos   = " num_id_tit_ap ";
    $condicao = "  num_id_tit_ap = $numIdTitAp $condProcCompra";
    $aTit = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTit)){
        $logExiste = true;
    } else{
        $logExiste = false;
    }
    return $logExiste;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarNecesAtualizPgtoPedido($numIdTitAp)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $logAtualizar = true;
    $container = getcontainerPagto($numIdTitAp);
    if($container <> 0){
        $logExisteItens = $this->existItensContainer($container);
        if($logExisteItens == true){
            $logAtualizar = false;
        }
    }
    return $logAtualizar;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getProcCompraPgto($numIdTitAp)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $procCompraId = 0;
    $tipo     = "unico"; 
    $tabela   = " pub.pagtos_proc_compra ";
    $campos   = " proc_compra_id ";
    $condicao = "  num_id_tit_ap = $numIdTitAp ";
    $conexao  = "espec";
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aReg)){
        $procCompraId = $aReg[0]['proc_compra_id'];
    }
    return $procCompraId;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function desassociarTituloPedido($numIdTitAp,$procCompraId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_proc_compra where num_id_tit_ap = $numIdTitAp 
            and  proc_compra_id = $procCompraId ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function associarTituloPedido($numIdTitAp,$proCompraId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_proc_compra(num_id_tit_ap,proc_compra_id) 
            values($numIdTitAp, $proCompraId ) ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getTitAssocSoPedido($fornecedor,$tipoReg)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    switch ($tipoReg){
        case 'sumarizado':
            $tipo = 'unico';
            $campos = "";
            break;
        case 'detalhado':
            $tipo = 'multi';
            $campos = '';
            break;
    }
    $this->getDados($tipo,'pagtos_proc_compra',$campos);


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getListaTitAssocPedido()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['fornecedor_proc_compra_corrente'])) {$_SESSION['fornecedor_proc_compra_corrente'] = "";}
if (!isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$this->sc_temp_fornecedor_proc_compra_corrente = (isset($_SESSION['fornecedor_proc_compra_corrente'])) ? $_SESSION['fornecedor_proc_compra_corrente'] : "";}
   
      $filtroCompl = '';
      $lista = '';
      if(isset($this->sc_temp_fornecedor_proc_compra_corrente) and $this->sc_temp_fornecedor_proc_compra_corrente <> '' ){
        $filtroCompl = $this->util_incr_valor($filtroCompl," fornecedor_id = $this->sc_temp_fornecedor_proc_compra_corrente ",
            " AND");
      }

      $condicao = "pagtos_pedido.proc_compra_id = pedido.proc_compra_id ";
      $condicao = $this->util_incr_valor($condicao,$filtroCompl," AND ") ;



    $aDados = $this->getDados('multi','pub.pagtos_proc_compra pagtos_pedido, pub.procs_compra pedido',
        'num_id_tit_ap',$condicao,'espec');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $titulo = $aDados[$i]['num_id_tit_ap'];
            $lista = $this->util_incr_valor($lista,$titulo);
        }
    }
    return $lista;

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='sysprogress',$logOdbc=true)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_despesas_container_memoria_calculo']['inicio']);
}

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarVlMoeda($numIdTitAp,$codEstab='',$moeda='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $valor = 0;
    switch($moeda){
        case 'dolar': 
            $finalidade = 'dolar';
            break;
        default:
            $finalidade = 'corrente';
    }
    $condicao = " vl_tit.cod_finalid_econ = '$finalidade' and vl_tit.num_id_tit_ap = $numIdTitAp        " ;
    if($codEstab<> ''){
        $condicao .= " and vl_tit.cod_estab = '$codEstab' ";
    }
    $aRetorno = $this->retornoSimplesTb01(
        'pub.val_tit_ap vl_tit','vl_tit.val_origin_tit_ap as val_origin_tit_ap,
        vl_tit.val_pagto_tit_ap as val_pagto_tit_ap, tit.cod_espec_docto as cod_espec_docto',
        $condicao,
        'ems5','inner join pub.tit_ap tit on tit.num_id_tit_ap = vl_tit.num_id_tit_ap
         and tit.cod_estab = vl_tit.cod_estab');
    if(is_array($aRetorno) and $numIdTitAp != 0){
        $codEspecDocto = $valor = $aRetorno[0]['cod_espec_docto'];
        $especsAdiant  = $this->getEspecsAdiant();
        $especsTit      = $this->getEspecsTit();
        if(strstr($especsAdiant,$codEspecDocto) <> false){ 
            $valor = $aRetorno[0]['val_origin_tit_ap'];
        }
        if(strstr($especsTit,$codEspecDocto) <> false){ 
            $valor = $aRetorno[0]['val_pagto_tit_ap'];
        }
        if($valor == 0){ 
            $valor = $aRetorno[0]['val_pagto_tit_ap'];
            if($valor == 0){ 
                $valor = $aRetorno[0]['val_origin_tit_ap'];
            }
        }
    }
    return $valor;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getEspecsAdiant()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_adiant_importacao");
    if ($param == '') {
        $especs = "'AF'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getEspecsTit()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_tit_importacao");
    if ($param == '') {
        $especs = "'DI'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDadosTitulo($numTitAp,$codEstab='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $condicao = " num_id_tit_ap = $numTitAp  ";
    if($codEstab <> ''){
        $condicao .= " and cod_estab = '$codEstab'";
    }
    $tabela = 'pub.tit_ap';
    $campo  = 'cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela,dat_emis_docto,
	dat_vencto_tit_ap,dat_liquidac_tit_ap,cod_estab';

    return $this->retornoSimplesTb01($tabela,$campo,$condicao,"ems5");


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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
    echo "Erro de Acesso função buscarvlSequenciaEspec. Messagem=". $this->seq_erro  ;
	}
	elseif (empty($this->seq )){
}
	else{
    $valor = $this->seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

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
    echo "Erro de Acesso função buscarvlSequenciaEspec. Messagem=". $this->seq_erro  ;
	}
	elseif (empty($this->seq )){
}
	else{
    $valor = $this->seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    return preg_replace(
        array("/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/",
            "/(ç)/",
            "/(Ç)/"),
        explode(" ","a A e E i I o O u U n N c C"),$texto
    );


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoCusto($containerParam,$tipoVersao,$descricao)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    if(isset($this->sc_temp_usr_login)){
        $login = $this->sc_temp_usr_login;
    }else{
        $login = ''; 
    }
    $cmd = "insert into pub.versoes_item_custo_container(versao_id,ind_sit_versao,tipo_versao_id,descricao,
          container_id,dt_hr_versao,cod_usuario)
           values(pub.seq_versao_item_container_custo.NEXTVAL,2,$tipoVersao,'$descricao',$containerParam,now(),'$login')";
    
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
      
    $id = $this->buscarVlSequenciaEspec('seq_versao_item_container_custo',
        'versoes_item_custo_container');
    $this->gravarVersaoCusto($id);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gerarAutVersaoCusto($containerParam,$descComplementar)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $aReg = $this->getUltVersao();
    if(is_array($aReg)){
        $tipoVersao  =  $aReg[0]['tipo_versao_id'];
        $versaoId    =  $aReg[0]['versao_id'];
        $descricao   =  "Versão gerada automaticamente a partir da versão $versaoId $descComplementar";
        $this->inserirVersaoCusto($containerParam,$tipoVersao,$descricao);
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getUltVersao()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container) ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosVersaoCusto($id,$campos='',$filtroCompl)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $campoChave = "versao_id";
    $tabela   = "versoes_item_custo_container";
    $condFiltroCompl = '';
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',$tabela);
        $campos = $aCampos['campos'];
    }
    if($campoChave <> 0){
        $condicao = "$campoChave = $id";
    } else{
        $condicao = '1 = 1 ';
    }

    if($filtroCompl <> ''){
        $condicao = $this->util_incr_valor($condicao,$filtroCompl,' AND ',true);
    }

    $tabela   = "pub.$tabela";
    $tipo     = "unico"; 
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aRet;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoCusto($versaoId,$logSincrImpostos=1,$logDespCalc=1)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $container = $this->buscarContainerVersaoCusto($versaoId);
    $versaoIncompleta = $this->verificarVersaoCustoIncompleta();
    if($versaoIncompleta <> $versaoId and $versaoIncompleta <> 0){
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Problema:Já existe um outro processo de custo incompleto.<br>
						  É necessário excluir ou reprocessar a versão de Custo: $versaoIncompleta";
;
    }
    else{
        if($logSincrImpostos == 1){
            $this->sincronizarImpostos ($container); 
        }
        if($logDespCalc == 1){
            $this->atuDespsCalcContainer($container);
        }

        $this->gravarVersaoCustoDadosContainer($versaoId,$container);
        $this->gravarVersaoItemContainerCustoDespesas($versaoId,$container);
        $this->gravarVersaoItemContainerCustoDescontos($versaoId,$container);
        $logGerarDistrCusto = $this->verificarGeracaoDistrCusto($container);
        $this->gravarVersaoItemContainerCusto($versaoId,$container,$logGerarDistrCusto);
        $this->gravarVersaoCustoNfs($versaoId,$container);
        $this->gravarVersaoPagtos($versaoId,$container);
        $this->completarVersaoCusto($versaoId);

        $this->setCustoContainerDesatualiz($container,0);


    }
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function completarVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = "update pub.versoes_item_custo_container set ind_sit_versao = 2
			where versao_id = $versaoId";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoCustoDadosContainer($versaoId,$container='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $descSitContainer = '';
    if($container == ''){
        $container = $this->buscarContainerVersaoCusto($versaoId);
    }
    $aContainer = $this->buscarCamposContainer ($container,'log_gerar_saldo_a_pagar,log_gerar_distr_custo,situacao_container_id');
    if(is_array ($aContainer)){
        $logGerarSaldoAPagar = $aContainer[0]['log_gerar_saldo_a_pagar'];
        $logGerarDistrCusto  = $aContainer[0]['log_gerar_distr_custo'];
        $situacaoContainerId = $aContainer[0]['situacao_container_id'];
        $aSituacao = $this->buscarSitDistrSituacaoContainer ($situacaoContainerId,'descricao,log_gerar_distr_custo');
        $percCustoFixo = $this->buscarPercCustoContainer ($container);
        if(is_array ($aSituacao)){
            $descricao = $aSituacao[0]['descricao'];
            $logDistrSituacao = $aSituacao[0]['log_gerar_distr_custo'];
            if($logDistrSituacao == 0){
                $descDistrSit = "Marcado para Não Distribuir Custo";
            }
            else{
                $descDistrSit = "Marcado para Distribuir Custo";
            }
            $descSitContainer = "$descricao($descDistrSit)";
        }
    }else{
        $logGerarSaldoAPagar = 0;
        $logGerarDistrCusto  = 0;
        $situacaoContainerId = 0;
        $descSitContainer    = '';
        $percCustoFixo = 0;
    }
    $aDolar             = $this->buscarDolar($container,'compra');
    if(is_array($aDolar)){
        $vlDolarCompra = $aDolar['cotacao'];
        $histDolar     = $aDolar['hist_origem'];
    }

    $aValores      		= buscarDescontosCreditosUtiliz($container);
    if(is_array($aValores)){
        $vlDescontoEmReal	= $aValores[0]['tot_real_utiliz'];
        $vlDescontoEmDolar	= $aValores[0]['tot_dolar_utiliz'];
    }
    else{
        $vlDescontoEmReal	= 0;
        $vlDescontoEmDolar	= 0;
    }
    if($vlDescontoEmReal == ''){
        $vlDescontoEmReal = 0;
    }
    if($vlDescontoEmDolar == ''){
        $vlDescontoEmDolar = 0;
    }

    $cmd = " update pub.versoes_item_custo_container set vl_dolar_compra ='$vlDolarCompra' ,
			vl_desconto_utiliz_real = '$vlDescontoEmReal', vl_desconto_utiliz_dolar = '$vlDescontoEmDolar',
			log_gerar_saldo_a_pagar = $logGerarSaldoAPagar, log_gerar_distr_custo = $logGerarDistrCusto,
			situacao_container_id = $situacaoContainerId, desc_sit_container = '$descSitContainer',
			perc_fixo_container = $percCustoFixo, hist_dolar = '$histDolar'			
			where versao_id = $versaoId";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarContainerVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'container_id';
    $condicao = "versao_id = $versaoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $container;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function verificarVersaoCustoIncompleta()
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $versaoId = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'versao_id';
    $condicao = " ind_sit_versao = 1";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $versaoId;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDespesas($versaoId,$container='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($container == ''){
        $container = $this->buscarContainerVersaoCusto($versaoId);
    }
    $logCusto = 0;
    $empresa = $this->buscarEmpContainer($container);
    $tabela   = 'pub.despesas_container desp, pub.empresas_despesa emp_desp';
    $campos     = 'sum(vl_prev) as vl_prev, sum(vl_negociado) as vl_negociado, sum(vl_proforma) as vl_proforma,
    sum(vl_base_imp) as vl_base_imp, desp.despesa_id as despesa_id,calc_imp_container_id, emp_desp.log_custo as log_custo';
    $condicao = " container_id = $container and desp.despesa_id = emp_desp.despesa_id and emp_desp.empresa_id = $empresa
    group by desp.despesa_id,calc_imp_container_id, emp_desp.log_custo";
    $aRetorno = $this->retornoMultReg($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $tam = count($aRetorno);
        for($i=0;$i < $tam;$i++){
            $despesaId 			= $aRetorno[$i]['despesa_id'];
            $vlPrev    			= $aRetorno[$i]['vl_prev'];
            $vlNegociado		= $aRetorno[$i]['vl_negociado'];
            $vlProforma  		= $aRetorno[$i]['vl_proforma'];
            $vlBaseImp  		= $aRetorno[$i]['vl_base_imp'];
            $calcImpContainerId = $aRetorno[$i]['calc_imp_container_id'];
            $logCusto			= $aRetorno[$i]['log_custo'];

            if($vlPrev == ''){
                $vlPrev = 0;
            }
            if($calcImpContainerId == ''){
                $calcImpContainerId = 0;
            }
            $this->inserirVersaoItemContainerCustoDespesas($versaoId,$despesaId,$vlPrev,$vlNegociado,$vlProforma,
                $vlBaseImp, $calcImpContainerId,$logCusto);
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDespesas($versaoId,$despesaId,$vlPrev,$vlNegociado,$vlProforma,$vlBaseImp,$calcImpContainerId,$logCusto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_despesas(versao_id, 
			despesa_id, vl_prev, calc_imp_container_id,log_custo,vl_negociado,vl_proforma,vl_base_imp)
			values($versaoId,$despesaId,$vlPrev,$calcImpContainerId,$logCusto,$vlNegociado,$vlProforma,$vlBaseImp) ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCusto($versaoId,$container='',$logGerarDistrCusto=false)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $logNovaVersao = false;
    if($container == ''){
        $container = $this->buscarContainerVersaoCusto($versaoId);
    }
    $aValoresReal = $this->calcularCustoGeralItem($container,
        '',
        '',
        'real',
        'negociado',
        true,
        false);


    $aValoresDolar = $this->calcularCustoGeralItem($container,
        '',
        '',
        'dolar',
        'negociado',
        true,
        false);


    $aDolarMedio   = $this->buscarDolarMedio($container);
    $vlDolarMedio  = $aDolarMedio['dolar_medio'];
    if($logGerarDistrCusto) {

        $vlDistr     = $this->getVlDespADistribuir('container',$container);


        $aContainerDistr = getVlDistrContainer($container);
        $vlContainerDistr = $aContainerDistr['vl_saldo'];
    }else{
        $vlDistr          = 0;
        $vlContainerDistr = 0;
    }
    if(is_array($aValoresReal)){
        $tam = count($aValoresReal);
        for($i=0;$i< $tam;$i++){
            $itemContainerId 	= $aValoresReal[$i]['item_container_id'];
            if($itemContainerId == ''){
                $itemContainerId = 0;
            }
            $aItem 		= $this->buscarDadositemContainer($itemContainerId);
            if(is_array($aItem)){
                $qtAlocada = $aItem[0]['qt_alocada'];
                $qtEmb = $aItem[0]['qt_confirm_emb'];
                $qtRecbtoFisico = $aItem[0]['qt_recbto_fisico'];
                $itemProcCompraId = $aItem[0]['item_proc_compra_id'];
                $itCodigo 	= buscarCodItemERP($itemProcCompraId);
            }
            else{
                $qtAlocada 		= 0;
                $qtEmb			= 0;
                $qtRecboFisico  = 0;
                $itCodigo		= '';
                $itemProcCompraId = 0;
            }
            $aRetorno = retornarCampoItemProcCompra ( $itemProcCompraId , 'vl_negociado' );
            $vlNegociado = 0;
            if ( is_array ( $aRetorno ) ) {
                $vlNegociado = $aRetorno[ 0 ][ 'vl_negociado' ];
            }

            $REALvlDespPrev      	      = $aValoresReal[$i]['vl_desp_prev'] ;
            $REALvlDespPrevSemDistrCusto  = $aValoresReal[$i]['vl_desp_prev_sem_distr_custo'];
            $REALvlTotalPrev	 	      = $aValoresReal[$i]['vl_total_prev'];
            $REALvlDespReal		 	      = $aValoresReal[$i]['vl_desp_real'];
            $REALvlTotalReal	 	      = $aValoresReal[$i]['vl_total_real'];
            $REALvlMercPrev		 	      = $aValoresReal[$i]['vl_merc_prev'];
            $REALvlUnitPrev		 	      = $aValoresReal[$i]['vl_unit_prev'];
            $REALvlMercReal		 	      = $aValoresReal[$i]['vl_merc_real'];
            $REALvlDescItem		 	      = $aValoresReal[$i]['vl_desc_item'];
            $REALvlDescContainer	      = $aValoresReal[$i]['vl_desc_container'];
            $REALvlUnitReal			      = $aValoresReal[$i]['vl_unit_real'];
            $qtSaldo				      = $aValoresReal[$i]['qt_saldo'];
            $DOLARvlDespPrev      	      = $aValoresDolar[$i]['vl_desp_prev'];
            $DOLARvlDespPrevSemDistrCusto = $aValoresDolar[$i]['vl_desp_prev_sem_distr_custo'];
            $DOLARvlTotalPrev	 	      = $aValoresDolar[$i]['vl_total_prev'];
            $DOLARvlDespReal	 	      = $aValoresDolar[$i]['vl_desp_real'];
            $DOLARvlTotalReal	 	      = $aValoresDolar[$i]['vl_total_real'];
            $DOLARvlMercPrev	 	      = $aValoresDolar[$i]['vl_merc_prev'];
            $DOLARvlUnitPrev	 	      = $aValoresDolar[$i]['vl_unit_prev'];
            $DOLARvlMercReal	 	      = $aValoresDolar[$i]['vl_merc_real'];
            $DOLARvlDescItem	 	      = $aValoresDolar[$i]['vl_desc_item'];
            $DOLARvlDescContainer	      = $aValoresDolar[$i]['vl_desc_container'];
            $DOLARvlUnitReal		      = $aValoresDolar[$i]['vl_unit_real'];

            
            if($logGerarDistrCusto){
                if($vlDistr >0){
                    $aItem = getVlDistrContainer('',$itemContainerId);
                    $vlItem = $aItem['vl_saldo'];

                    $vlPondItem = $this->execOperMat('divisao',$vlItem, $vlContainerDistr)  ;
                    $vlDistrItem = $vlDistr * $vlPondItem;


                }
                else{
                    $vlDistrItem = 0;
                    $vlItem = 0;
                    $vlPondItem = 0;
                }

                $vlDistrExclusivoItem   = $this->getVlDespADistribuir('item',$itemContainerId);
                $vlDistrItem   += $vlDistrExclusivoItem;

                
                $vlDistrAnt = $this->buscarTotDistrItemCustoContainer($itemContainerId);
                $vlDistrItem = $vlDistrItem - $vlDistrAnt;
            }else{
                $vlDistrItem = 0;
            }


            $id = $this->inserirVersaoItemContainerCusto(
                $versaoId,
                $itemContainerId,
                $itCodigo,
                $REALvlDespPrev,
                $REALvlMercPrev,
                $REALvlMercReal,
                $qtAlocada,
                $qtEmb,
                $qtRecbtoFisico,
                $REALvlDespReal,
                $REALvlUnitPrev,
                $REALvlUnitReal,
                $DOLARvlDespPrev,
                $DOLARvlMercPrev,
                $DOLARvlMercReal,
                $DOLARvlDespReal,
                $DOLARvlDescItem,
                $DOLARvlUnitPrev,
                $DOLARvlUnitReal,
                $vlDistrItem,$vlNegociado,$REALvlDespPrevSemDistrCusto,
                $DOLARvlDespPrevSemDistrCusto);
            $vlDistrItem = round($vlDistrItem,2);
            if($logGerarDistrCusto == 1 and $vlDistrItem <> 0){
                $distrCustoID = criarRegDistrCusto($id,0,'Vl.Distribuição de Custo Automático',
                    3,$vlDistrItem);
                criarDespesaDistrCusto($distrCustoID,$vlDistrItem,$itemContainerId);
                
                $logNovaVersao = true;
            }
            else{
                $logNovaVersao = false;
            }
        }
    }
    if($logNovaVersao ==true){
        $this->gerarAutVersaoCusto($container ,' - Distribuição de Custo gerada na versão do custo');
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCusto($versaoId,
                                         $itemContainerId,
                                         $itCodigo,
                                         $REALvlDespPrev,
                                         $REALvlMercPrev,
                                         $REALvlMercReal,
                                         $qtAlocada,
                                         $qtEmb,
                                         $qtRecbtoFisico,
                                         $REALvlDespReal,
                                         $REALvlUnitPrev,
                                         $REALvlUnitReal,
                                         $DOLARvlDespPrev,
                                         $DOLARvlMercPrev,
                                         $DOLARvlMercReal,
                                         $DOLARvlDespReal,
                                         $DOLARvlDescItem,
                                         $DOLARvlUnitPrev,
                                         $DOLARvlUnitReal,
                                         $vlDistr,
                                         $vlNegociado,
                                         $vlDespPrevRealSemDistrCusto,
                                         $vlDespPrevDolarSemDistrCusto)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custos
	(item_container_custo_id,
	versao_id,
	item_container_id,
	it_codigo,
	vl_desp_prev_real,
	vl_custo_prev_real,
	vl_pago_real,
	qt_alocada,
	qt_confirm_emb,
	qt_recebto_fisico,
	vl_desp_realiz_real,
	vl_unit_prev, 
	vl_unit_realiz,
	vl_desp_prev_dolar, 
	vl_custo_prev_dolar,
	vl_pago_dolar,
	vl_desp_realiz_dolar,
	vl_desconto_utiliz_dolar,
    vl_unit_prev_dolar,
	vl_unit_realiz_dolar,
	vl_custo_distribuido,
	vl_negociado,
	vl_desp_prev_real_sem_distr_cust,
	vl_desp_prev_dolar_sem_distr_cus)values
	(pub.seq_item_container_custos.NEXTVAL,
	 $versaoId,
	 $itemContainerId,
	'$itCodigo',
	'$REALvlDespPrev',
	'$REALvlMercPrev',
	'$REALvlMercReal',
	'$qtAlocada',
	'$qtEmb',
	'$qtRecbtoFisico',
	'$REALvlDespReal',
	'$REALvlUnitPrev',
	'$REALvlUnitReal',
	'$DOLARvlDespPrev',
	'$DOLARvlMercPrev',
	'$DOLARvlMercReal',
	'$DOLARvlDespReal',
	'$DOLARvlDescItem',	
	'$DOLARvlUnitPrev',
	'$DOLARvlUnitReal',
	'$vlDistr',
	'$vlNegociado',
	'$vlDespPrevRealSemDistrCusto',
	'$vlDespPrevDolarSemDistrCusto')";
    
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
      
    $id = $this->buscarVlSequenciaEspec('seq_item_container_custos','item_container_custos');
    return $id;
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoCustoNfs($versaoId,$container='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($container == ''){
        $containerId = $this->buscarContainerVersaoCusto($versaoId);
    }
    $tabela   = 'pub.nfs_container';
    $campo     = 'documento,serie,estab,nat_operacao,cod_emitente,container_id';
    $condicao = " container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $documento 			= $aRetorno[0]['documento'];
        $serie    			= $aRetorno[0]['serie'];
        $natOperacao		= $aRetorno[0]['nat_operacao'];
        $codEmitente		= $aRetorno[0]['cod_emitente'];
        $estab				= $aRetorno[0]['estab'];
        $aRetorno2 = $this->buscarValoresNFs($estab,$documento,$serie,$natOperacao,$codEmitente);
        if(is_array($aRetorno2)){
            $vlMercadoria = $aRetorno2[0]['"valor-mercad"'];
            $vlDespesa    = $aRetorno2[0]['"despesa-nota"'];
        }
        else{
            $vlMercadoria = 0;
            $vlDespesa    = 0;
        }
        $this->inserirVersaoCustoNfs($versaoId,$documento,$serie,$natOperacao,$codEmitente,$vlMercadoria,$vlDespesa);
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoCustoNfs($versao,$documento,$serie,$natOperacao,$codEmitente,$vlMercadoria,$vlDespesa)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_nfs(versao_id, documento, serie, nat_operacao,cod_emitente,vl_mercadoria,
			vl_despesa)
			values($versao,'$documento','$serie','$natOperacao',$codEmitente,'$vlMercadoria','$vlDespesa') ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoPagtos($versaoId,$container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($container == ''){
        $containerId = $this->buscarContainerVersaoCusto($versaoId);
    }
    
    $tabela   = 'pub.pagtos_container';
    $campo     = 'num_id_tit_ap';
    $condicao = " container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $tam				= count($aRetorno);
        for($i=0;$i < $tam;$i++){
            $numIdTitAp			= $aRetorno[$i]['num_id_tit_ap'];
            $vlReal				= $this->buscarVlMoeda($numIdTitAp);
            $vlDolar			= $this->buscarVlMoeda($numIdTitAp,'','dolar');
            $this->inserirVersaoCustoPagtos($versaoId,$numIdTitAp,$vlReal,$vlDolar);
        }
    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoCustoPagtos($versao,$numIdTitAp,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_pgtos(versao_id,num_id_tit_ap,vl_real,vl_dolar)
			values($versao,$numIdTitAp,'$vlReal','$vlDolar') ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarContainerVersao($versaoId)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela 	= 'pub.versoes_item_custo_container';
    $campo  	= 'container_id';
    $condicao	= "versao_id = $versaoId";
    $aRetorno   = $this->retornoSimplesTb01($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $container = $aRetorno[0][$campo];
    }
    return $container;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarDadosUltVersaoCustoContainer($container,$itemContainerId='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $tabela = 'pub.item_container_custos  ';
    $campos =  'item_custo_id,vl_unit_prev,vl_unit_realiz,qt_confirm_emb, 
    qt_alocada,qt_recebto_fisico,item_container_custo_id,vl_custo_distribuido, vl_negociado';
    $condicao = " versao_id = (select max(versao.versao_id) as ult
 				from  pub.versoes_item_custo_container versao 
 				where versao.container_id = $container  )";
    if($itemContainerId <> ''){
        $condicao .= " and item_container_id = $itemContainerId";
    }
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRetorno;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDataUltVersaoCustoContainer($containerParam)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $dtHrVersao = "";
    $tipo     = "unico"; 
    $tabela   = " versoes_item_custo_container versao ";
    $campos   = " dt_hr_versao ";
    $condicao = "  container_id = $containerParam and  
    versao_id = select max(versao.versao_id) as ult
 				from  pub.versoes_item_custo_container versao2 
 				where versao.container_id =  versao2.container_id )";
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aRet)){
        $dtHrVersao = $aRet[0]['dt_hr_versao'];
    }
    return $dtHrVersao;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarUltVersaoCustoContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $versao = 0;
    $tabela = 'pub.versoes_item_custo_container';
    $campos =  'select max(versao.versao_id) as ult';
    $condicao = " versao.container_id = $container ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $versao = $aRetorno[0]['ult'];
    }
    return $versao;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function getDadosVersaoCorrenteContainer($container)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container
                where container_id = $container)
                ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;


$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function buscarTotDistrItemCustoContainer($itemContainer)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  

    $tot = 0;
    $tabela = 'pub.item_container_custos';
    $campos =  'sum(vl_custo_distribuido) as tot';
    $condicao = " item_container_id = $itemContainer ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $tot = $aRetorno[0]['tot'];
    }
    return $tot;

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDescontos($versaoId,$container='')
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    if($container == ''){
        $container = $this->buscarContainerVersaoCusto($versaoId);
    }
    
    $tabela    = 'pub.descontos_importacao di , pub.itens_container ic';
    $campo     = 'desconto_importacao_id, vl_real_autorizado, vl_dolar_autorizado';
    $condicao  = " di.log_credito = 0 and  di.item_container_id = ic.item_container_id
				and  ic.container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $tam = count($aRetorno);
        for($i=0;$i < $tam;$i++){
            $descontoId 		= $aRetorno[$i]['desconto_importacao_id'];
            $vlReal    			= $aRetorno[$i]['vl_real_autorizado'];
            $vlDolar		    = $aRetorno[$i]['vl_dolar_autorizado'];
            if($vlReal == ''){
                $vlReal = 0;
            }
            if($vlDolar == ''){
                $vlDolar = 0;
            }
            $this->inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar);
        }

    }
    

    $tabela    = 'pub.descontos_importacao di , pub.cta_corren_desconto cc';
    $campo     = 'di.desconto_importacao_id as desconto_importacao_id, vl_real_autorizado, vl_dolar_autorizado, valor_utilizado,
 vl_real_autorizado /  vl_dolar_autorizado *  valor_utilizado as valor_utilizado_real';
    $condicao  = " di.log_credito = 1 and  di.desconto_importacao_id = cc.desconto_importacao_id and  cc.container_id = $container";
    $aRetorno2 = $this->retornoMultReg($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno2)){
        $tam = count($aRetorno2);
        for($i=0;$i < $tam;$i++){
            $descontoId 		= $aRetorno2[$i]['desconto_importacao_id'];
            $vlReal    			= $aRetorno2[$i]['valor_utilizado_real'];
            $vlDolar		    = $aRetorno2[$i]['valor_utilizado'];
            if($vlReal == ''){
                $vlReal = 0;
            }
            if($vlDolar == ''){
                $vlDolar = 0;
            }
            $this->inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar);
        }

    }

$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_descontos(versao_id, 
			desconto_importacao_id, vl_autoriz_real,vl_autoriz_dolar)values($versaoId,$descontoId,$vlReal,$vlDolar) ";
    
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
      
$_SESSION['scriptcase']['cons_despesas_container_memoria_calculo']['contr_erro'] = 'off';
}
}
?>
