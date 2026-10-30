<?php
class grid_descontos_importacao_grid
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
   var $fornecedor_id;
   var $desconto_importacao_id;
   var $motivo_desconto_id;
   var $descricao;
   var $log_credito;
   var $vl_dolar;
   var $vl_real;
   var $vl_cotacao_dolar;
   var $vl_real_autorizado;
   var $vl_dolar_autorizado;
   var $dt_autorizacao;
   var $arquivo;
   var $look_log_credito;

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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['grid_pesq'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['grid_pesq'] = array();
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
      {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
       { 
           include_once($this->Ini->path_embutida . "grid_descontos_importacao/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
           include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new grid_descontos_importacao_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
      }
    if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false) {
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pdf_res'])
       {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert'])
            {
            } 
            else
            {
                $this->cabecalho();
            } 
       } 
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert'])
            {
            } 
            else
            {
       $nm_saida->saida("                  <TR>\r\n");
       $nm_saida->saida("                  <TD id='sc_grid_content' style='padding: 0px;' colspan=3>\r\n");
            } 
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_descontos_importacao'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
       } 
       if (!$this->Proc_link_res && $nmgrp_apl_opcao != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print')
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_refresh'] = array();
           $this->html_dynamic_search();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['save_grid']);
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pdf_res'] && (!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']))
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['print_all'] && empty($this->nm_grid_sem_reg) && ($Gera_res || $Gera_graf) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           $this->Res->monta_html_ini_pdf();
           $this->Res->monta_resumo();
           $this->Res->monta_html_fim_pdf();
           if ($Gera_graf)
           {
               $this->grafico_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new grid_descontos_importacao_grafico();
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
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'];
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['orig_pesq'] = "grid";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed      = false;
   $this->nm_data         = new nm_data("pt_br");
   $this->pdf_label_group = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['label_group'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['label_group'] : "S";
   $this->pdf_all_cab     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['all_cab']))     ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['all_cab'] : "N";
   $this->pdf_all_label   = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['all_label']))   ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_pdf']['all_label'] : "N";
   $this->Fix_bar_top     = false;
   $this->Fix_bar_bottom  = false;
   $this->Grid_body       = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = explode(",", trim(substr($cada_css, 1, $Pos1 - 1)));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'])
       { 
           $this->Css_Cmp[$Tag[0]] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag[0]] = "";
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_add']))
   {
       $this->css_help_tooltip_faicon = isset($css_help_tooltip_faicon) && '' != trim($css_help_tooltip_faicon) ? trim($css_help_tooltip_faicon) : "fa fa-question-circle";
       $NM_func_dyn_add = "dynamic_search_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_add']['cmp'];
       $Lin_dyn_add = $this->$NM_func_dyn_add($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_add']['seq'], 'S');
       $this->Arr_result = array();
       $Temp = ob_get_clean();
       $this->Arr_result['dyn_add'][] = NM_charset_to_utf8($Lin_dyn_add);
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_add']);
       exit;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_ch_bi']))
   {
       $tmp_opc = $opc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_ch_bi']['opc'];
       $this->Ini->process_cond_bi($opc, $bi_dt1, $bi_dt2);
       $NM_func_dyn_ch_bi = "formata_bi_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_ch_bi']['cmp'];
       $this->$NM_func_dyn_ch_bi($tmp_opc, $bi_dt1, $bi_dt2, $opc);
       $this->Arr_result = array();
       $Temp = ob_get_clean();
       $this->Arr_result['dyn_ch_bi'][] = NM_charset_to_utf8($bi_dt1 . $bi_dt2);
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_ch_bi']);
       exit;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_aut_comp']))
   {
       $NM_func_aut_comp = "lookup_ajax_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_aut_comp']['cmp'];
       $parm = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
       $nmgp_def_dados = $this->$NM_func_aut_comp($parm);
       ob_end_clean();
       $count_aut_comp = 0;
       $resp_aut_comp  = array();
       foreach ($nmgp_def_dados as $Ind => $Lista)
       {
          if (is_array($Lista))
          {
              foreach ($Lista as $Cod => $Valor)
              {
                  if ($_GET['cod_desc'] == "S")
                  {
                      $Valor = $Cod . " - " . $Valor;
                  }
                  $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                  $count_aut_comp++;
              }
          }
          if ($count_aut_comp == $_GET['max_itens'])
          {
              break;
          }
       }
       $oJson = new Services_JSON();
       echo $oJson->encode($resp_aut_comp);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_aut_comp']);
       exit;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $this->Ini->Embutida_iframe)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'] = array();
   }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5_cap']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5_cap'] as $Cod => $Parms) {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][$Cod] = $Parms;
           }
       }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['force_toolbar']);
   } 
       $this->Tem_tab_vert = false;
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_edit'] == 'N'))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] = "N";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("grid_descontos_importacao", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
   $this->nmgp_botoes['dynsearch'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['gridsavesession'] = "on";
   $this->Cmps_ord_def['fornecedor_id'] = " desc";
   $this->Cmps_ord_def['desconto_importacao_id'] = " desc";
   $this->Cmps_ord_def['motivo_desconto_id'] = " desc";
   $this->Cmps_ord_def['descricao'] = " asc";
   $this->Cmps_ord_def['log_credito'] = " desc";
   $this->Cmps_ord_def['vl_dolar'] = " desc";
   $this->Cmps_ord_def['vl_real'] = " desc";
   $this->Cmps_ord_def['vl_real_autorizado'] = " desc";
   $this->Cmps_ord_def['dt_autorizacao'] = " desc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->Proc_link_res = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo'])) 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->fornecedor_id = (isset($Busca_temp['fornecedor_id'])) ? $Busca_temp['fornecedor_id'] : ""; 
       $tmp_pos = (is_string($this->fornecedor_id)) ? strpos($this->fornecedor_id, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->fornecedor_id))
       {
           $this->fornecedor_id = substr($this->fornecedor_id, 0, $tmp_pos);
       }
       $this->dt_autorizacao = (isset($Busca_temp['dt_autorizacao'])) ? $Busca_temp['dt_autorizacao'] : ""; 
       $tmp_pos = (is_string($this->dt_autorizacao)) ? strpos($this->dt_autorizacao, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dt_autorizacao))
       {
           $this->dt_autorizacao = substr($this->dt_autorizacao, 0, $tmp_pos);
       }
       $dt_autorizacao_2 = (isset($Busca_temp['dt_autorizacao_input_2'])) ? $Busca_temp['dt_autorizacao_input_2'] : ""; 
       $this->dt_autorizacao_2 = $dt_autorizacao_2; 
       $this->log_credito = (isset($Busca_temp['log_credito'])) ? $Busca_temp['log_credito'] : ""; 
       $tmp_pos = (is_string($this->log_credito)) ? strpos($this->log_credito, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->log_credito))
       {
           $this->log_credito = substr($this->log_credito, 0, $tmp_pos);
       }
       $this->desconto_importacao_id = (isset($Busca_temp['desconto_importacao_id'])) ? $Busca_temp['desconto_importacao_id'] : ""; 
       $tmp_pos = (is_string($this->desconto_importacao_id)) ? strpos($this->desconto_importacao_id, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->desconto_importacao_id))
       {
           $this->desconto_importacao_id = substr($this->desconto_importacao_id, 0, $tmp_pos);
       }
       $this->motivo_desconto_id = (isset($Busca_temp['motivo_desconto_id'])) ? $Busca_temp['motivo_desconto_id'] : ""; 
       $tmp_pos = (is_string($this->motivo_desconto_id)) ? strpos($this->motivo_desconto_id, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->motivo_desconto_id))
       {
           $this->motivo_desconto_id = substr($this->motivo_desconto_id, 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->dt_autorizacao_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "muda_qt_linhas";
   } 
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['insert'] != '')
   {
       $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['insert'];
       $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['insert'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['update'] != '')
   {
       $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['update'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['delete'] != '')
   {
       $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_descontos_importacao']['delete'];
   }

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_descontos_importacao'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_descontos_importacao'];

           if (!$tmpDashboardButtons['grid_navigate']) { 
               $this->nmgp_botoes['first']   = 'off';
               $this->nmgp_botoes['back']    = 'off';
               $this->nmgp_botoes['last']    = 'off';
               $this->nmgp_botoes['forward'] = 'off';
           }
           if (!$tmpDashboardButtons['grid_summary'])   { $this->nmgp_botoes['summary']   = 'off';}
           if (!$tmpDashboardButtons['grid_qsearch'])   { $this->nmgp_botoes['qsearch']   = 'off';}
           if (!$tmpDashboardButtons['grid_dynsearch']) { $this->nmgp_botoes['dynsearch'] = 'off';}
           if (!$tmpDashboardButtons['grid_filter'])    { $this->nmgp_botoes['filter']    = 'off';}
           if (!$tmpDashboardButtons['grid_sel_col'])   { $this->nmgp_botoes['sel_col']   = 'off';}
           if (!$tmpDashboardButtons['grid_sort_col'])  { $this->nmgp_botoes['sort_col']  = 'off';}
           if (!$tmpDashboardButtons['grid_goto'])      { $this->nmgp_botoes['goto']      = 'off';}
           if (!$tmpDashboardButtons['grid_lineqty'])   { $this->nmgp_botoes['qtline']    = 'off';}
           if (!$tmpDashboardButtons['grid_navpage'])   { $this->nmgp_botoes['navpage']   = 'off';}
           if (!$tmpDashboardButtons['grid_pdf'])       { $this->nmgp_botoes['pdf']       = 'off';}
           if (!$tmpDashboardButtons['grid_xls'])       { $this->nmgp_botoes['xls']       = 'off';}
           if (!$tmpDashboardButtons['grid_xml'])       { $this->nmgp_botoes['xml']       = 'off';}
           if (!$tmpDashboardButtons['grid_json'])      { $this->nmgp_botoes['json']      = 'off';}
           if (!$tmpDashboardButtons['grid_csv'])       { $this->nmgp_botoes['csv']       = 'off';}
           if (!$tmpDashboardButtons['grid_rtf'])       { $this->nmgp_botoes['rtf']       = 'off';}
           if (!$tmpDashboardButtons['grid_word'])      { $this->nmgp_botoes['word']      = 'off';}
           if (!$tmpDashboardButtons['grid_doc'])       { $this->nmgp_botoes['doc']       = 'off';}
           if (!$tmpDashboardButtons['grid_print'])     { $this->nmgp_botoes['print']     = 'off';}
           if (!$tmpDashboardButtons['new'])            { $this->nmgp_botoes['grid_new']  = 'off';}
           if (!$tmpDashboardButtons['img'])            { $this->nmgp_botoes['img']       = 'off';}
           if (!$tmpDashboardButtons['html'])           { $this->nmgp_botoes['html']      = 'off';}
           if (!$tmpDashboardButtons['grid_reload'])    { $this->nmgp_botoes['reload']    = 'off';}
           if (!$tmpDashboardButtons['sel_groupby'])    { $this->nmgp_botoes['groupby']   = 'off';}
           if (!isset($tmpDashboardButtons['grid_rows']) || !$tmpDashboardButtons['grid_rows']) { $this->nmgp_botoes['rows'] = 'off';}
       }
   }

   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "grid_descontos_importacao/grid_descontos_importacao_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "grid_descontos_importacao_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new grid_descontos_importacao_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] = 30;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['rows'];  
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['rows']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_label'] = "";  
   }   
   $All_dts_gb = array();
   $Change_order_gb_dt = false;
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       if (in_array($campo, $All_dts_gb)) { 
                           $Change_order_gb_dt = true;
                       } 
                       else { 
                           $Ordem_tem_quebra = true;
                       } 
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "ordem" || $Change_order_gb_dt)  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!$GLOBALS['nm_restore_grid_save'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['prim_cons'] || !empty($nmgp_parms)) )  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'] = " where (item_container_id = " . $_SESSION['item_container_id_corrente'] . ")";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'] = "";
   }   
   $GLOBALS['nm_restore_grid_save'] = false;
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1] ;  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['contr_array_resumo'] = "NAO";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['using_summary_cache']);
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = 0; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
   {
       $this->Ini->Qtd_reg_ajax_grid = $this->count_ger;
   }
   else
   {
       $this->Ini->Qtd_reg_ajax_grid = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'];
   }
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, str_replace (convert(char(10),dt_autorizacao,102), '.', '-') + ' ' + convert(char(8),dt_autorizacao,20), arquivo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, dt_autorizacao, arquivo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, convert(char(23),dt_autorizacao,121), arquivo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, dt_autorizacao, arquivo from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, EXTEND(dt_autorizacao, YEAR TO DAY), arquivo from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT fornecedor_id, desconto_importacao_id, motivo_desconto_id, descricao, log_credito, vl_dolar, vl_real, vl_cotacao_dolar, vl_real_autorizado, vl_dolar_autorizado, dt_autorizacao, arquivo from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order    = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->fornecedor_id = $this->rs_grid->fields[0] ;  
       $this->fornecedor_id = (string)$this->fornecedor_id;
       $this->desconto_importacao_id = $this->rs_grid->fields[1] ;  
       $this->desconto_importacao_id = (string)$this->desconto_importacao_id;
       $this->motivo_desconto_id = $this->rs_grid->fields[2] ;  
       $this->motivo_desconto_id = (string)$this->motivo_desconto_id;
       $this->descricao = $this->rs_grid->fields[3] ;  
       $this->log_credito = $this->rs_grid->fields[4] ;  
       $this->log_credito = (string)$this->log_credito;
       $this->vl_dolar = $this->rs_grid->fields[5] ;  
       $this->vl_dolar =  str_replace(",", ".", $this->vl_dolar);
       $this->vl_dolar = (string)$this->vl_dolar;
       $this->vl_real = $this->rs_grid->fields[6] ;  
       $this->vl_real =  str_replace(",", ".", $this->vl_real);
       $this->vl_real = (string)$this->vl_real;
       $this->vl_cotacao_dolar = $this->rs_grid->fields[7] ;  
       $this->vl_cotacao_dolar =  str_replace(",", ".", $this->vl_cotacao_dolar);
       $this->vl_cotacao_dolar = (string)$this->vl_cotacao_dolar;
       $this->vl_real_autorizado = $this->rs_grid->fields[8] ;  
       $this->vl_real_autorizado =  str_replace(",", ".", $this->vl_real_autorizado);
       $this->vl_real_autorizado = (string)$this->vl_real_autorizado;
       $this->vl_dolar_autorizado = $this->rs_grid->fields[9] ;  
       $this->vl_dolar_autorizado = (string)$this->vl_dolar_autorizado;
       $this->dt_autorizacao = $this->rs_grid->fields[10] ;  
       $this->arquivo = $this->rs_grid->fields[11] ;  
       $GLOBALS["motivo_desconto_id"] = $this->rs_grid->fields[2] ;  
       $GLOBALS["motivo_desconto_id"] = (string)$GLOBALS["motivo_desconto_id"] ;
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->fornecedor_id = $this->rs_grid->fields[0] ;  
           $this->desconto_importacao_id = $this->rs_grid->fields[1] ;  
           $this->motivo_desconto_id = $this->rs_grid->fields[2] ;  
           $this->descricao = $this->rs_grid->fields[3] ;  
           $this->log_credito = $this->rs_grid->fields[4] ;  
           $this->vl_dolar = $this->rs_grid->fields[5] ;  
           $this->vl_real = $this->rs_grid->fields[6] ;  
           $this->vl_cotacao_dolar = $this->rs_grid->fields[7] ;  
           $this->vl_real_autorizado = $this->rs_grid->fields[8] ;  
           $this->vl_dolar_autorizado = $this->rs_grid->fields[9] ;  
           $this->dt_autorizacao = $this->rs_grid->fields[10] ;  
           $this->arquivo = $this->rs_grid->fields[11] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'] && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['grid_descontos_importacao']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['word_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if ($this->Ini->Proc_print && $this->Ini->Export_html_zip  && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['grid_descontos_importacao']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['print_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - Descontos Item Container - ID:<?php echo $_SESSION['item_container_id_corrente'] ?> :: PDF</TITLE>
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pivot_charts']) : 0;
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
               grid_descontos_importacao_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               grid_descontos_importacao_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               grid_descontos_importacao_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               grid_descontos_importacao_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               grid_descontos_importacao_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE html>\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Descontos Item Container - ID:" . $_SESSION['item_container_id_corrente'] . "</TITLE>\r\n");
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $this->NM_opcao != "pdf") {
           $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'] && !$this->Ini->sc_export_ajax)
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_descontos_importacao_jquery_8158.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_descontos_importacao_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"grid_descontos_importacao_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida']) {  
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_filter . "_calendar.css\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_filter . "_calendar" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" />\r\n");
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
           $nm_saida->saida("    selectedFields = $(\".sc-ui-grid-header-row-grid_descontos_importacao-1 .sc-op-fix-col.sc-op-fix-col-fixed\");\r\n");
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida']) { 
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
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid']) . ";\r\n");
           }
           $nm_saida->saida("   var Dyn_Ini   = true;\r\n");
           $nm_saida->saida("   var nmdg_Form = \"Fdyn_search\";\r\n");
           if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
           {
               $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
               foreach ($Tb_err_js as $Lines)
               {
                   if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
                   {
                       $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
                   }
                   echo "   " . $Lines;
               }
           }
           $Msg_Inval = "Inv�lido";
           if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
           {
               $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           echo "   var SC_crit_inv = \"" . $Msg_Inval . "\";\r\n";
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
           $nm_saida->saida("        let cells = $(\".sc-ui-grid-header-row-grid_descontos_importacao-1\").find(\"td\");\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").css(\"z-index\", 5);\r\n");
           $nm_saida->saida("        cells.filter(\".sc-col-is-fixed\").filter(\".sc-col-actions\").css(\"z-index\", 6);\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("    function scSetFixedHeadersCss(baseTop)\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("        let rows, cols, i, j, thisTop;\r\n");
           $nm_saida->saida("        rows = $(\".sc-ui-grid-header-row-grid_descontos_importacao-1\");\r\n");
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
           $nm_saida->saida("   var gridHeaders = $(\".sc-ui-grid-header-row-grid_descontos_importacao-1\"), headerDisplayed = true;\r\n");
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
           $nm_saida->saida("   tableOriginal = document.getElementById(\"sc-ui-grid-body-1e2b5a89\");\r\n");
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
           $nm_saida->saida("     if (Dyn_Ini)\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("         Dyn_Ini = false;\r\n");
           if ($nmgrp_apl_opcao != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['grid_pesq']))
           { 
               $nm_saida->saida("         SC_carga_evt_jquery('all');\r\n");
           } 
           $nm_saida->saida("         scLoadScInput('input:text.sc-js-input');\r\n");
           $nm_saida->saida("     }\r\n");
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ancor_save']);
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
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word']) {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
       }
       $nm_saida->saida("<style type=\"text/css\">\r\n");
       $nm_saida->saida("</style>\r\n");
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'])
       {
           $write_css = true;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_descontos_importacao_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_descontos_importacao_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_grid_descontos_importacao_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf") {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       } 
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("    " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert'])
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $Pos1 = strpos($cada_css, "{");
           $Pos2 = strpos($cada_css, "}");
           if ($Pos1 !== false && $Pos2 !== false) {
               $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
               $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
               $cada_css = ".grid_descontos_importacao_" . substr(trim($Tag[0]), 1);
               if (isset($Tag[1])) {
                   $cada_css .= ", .grid_descontos_importacao_" . substr(trim($Tag[1]), 1);
               }
               $cada_css .= $Css;
           }
           else {
               $cada_css = ".grid_descontos_importacao_" . substr($cada_css, 1);
           }
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   $this->css_body_embutida    = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['css_body_embutida'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['css_body_embutida'] : "";
   $this->css_remove_margin     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['link_info']['remove_margin']))     ? "margin: 0;" : "";
   $this->css_remove_border     = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['link_info']['remove_border']))     ? "border-width: 0;" : "";
   $this->css_remove_background = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['link_info']['remove_background'])) ? "background-color: transparent; background-image: none;" : "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] == "print")) 
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
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
          $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
          $vertical_center = '';
           $nm_saida->saida("  <body id=\"grid_horizontal\" class=\"" . $this->css_scGridPage . " sc-app-grid\" " . $str_iframe_body . " style=\"" . $remove_margin . $remove_background . $vertical_center . $css_body . $this->css_body_embutida . $this->css_remove_margin . $this->css_remove_background . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" && !$this->Print_All && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['pdf_res'])
       {
           return;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['css_body_embutida'])) {
       $remove_border = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['css_body_embutida'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert'])
   {
   }
   else
   {
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\" style=\"" . (isset($remove_border) ? $remove_border : '') . $this->css_remove_border . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
       { 
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_A_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
       }
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_E_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_AL_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_descontos_importacao']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_descontos_importacao']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_descontos_importacao']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_descontos_importacao']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida']) ? "grid_descontos_importacao_" : "";
   $this->css_sep = " ";
   $this->css_fornecedor_id_label = $compl_css_emb . "css_fornecedor_id_label";
   $this->css_fornecedor_id_grid_line = $compl_css_emb . "css_fornecedor_id_grid_line";
   $this->css_desconto_importacao_id_label = $compl_css_emb . "css_desconto_importacao_id_label";
   $this->css_desconto_importacao_id_grid_line = $compl_css_emb . "css_desconto_importacao_id_grid_line";
   $this->css_motivo_desconto_id_label = $compl_css_emb . "css_motivo_desconto_id_label";
   $this->css_motivo_desconto_id_grid_line = $compl_css_emb . "css_motivo_desconto_id_grid_line";
   $this->css_descricao_label = $compl_css_emb . "css_descricao_label";
   $this->css_descricao_grid_line = $compl_css_emb . "css_descricao_grid_line";
   $this->css_log_credito_label = $compl_css_emb . "css_log_credito_label";
   $this->css_log_credito_grid_line = $compl_css_emb . "css_log_credito_grid_line";
   $this->css_vl_dolar_label = $compl_css_emb . "css_vl_dolar_label";
   $this->css_vl_dolar_grid_line = $compl_css_emb . "css_vl_dolar_grid_line";
   $this->css_vl_real_label = $compl_css_emb . "css_vl_real_label";
   $this->css_vl_real_grid_line = $compl_css_emb . "css_vl_real_grid_line";
   $this->css_vl_cotacao_dolar_label = $compl_css_emb . "css_vl_cotacao_dolar_label";
   $this->css_vl_cotacao_dolar_grid_line = $compl_css_emb . "css_vl_cotacao_dolar_grid_line";
   $this->css_vl_real_autorizado_label = $compl_css_emb . "css_vl_real_autorizado_label";
   $this->css_vl_real_autorizado_grid_line = $compl_css_emb . "css_vl_real_autorizado_grid_line";
   $this->css_vl_dolar_autorizado_label = $compl_css_emb . "css_vl_dolar_autorizado_label";
   $this->css_vl_dolar_autorizado_grid_line = $compl_css_emb . "css_vl_dolar_autorizado_grid_line";
   $this->css_dt_autorizacao_label = $compl_css_emb . "css_dt_autorizacao_label";
   $this->css_dt_autorizacao_grid_line = $compl_css_emb . "css_dt_autorizacao_grid_line";
   $this->css_arquivo_label = $compl_css_emb . "css_arquivo_label";
   $this->css_arquivo_grid_line = $compl_css_emb . "css_arquivo_grid_line";
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Descontos Item Container - ID:" . $_SESSION['item_container_id_corrente'] . " - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'] && $nm_refresch_cab_rod)
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf']) 
     { 
         $this->NM_calc_span();
           $nm_saida->saida("   <TD colspan=\"" . $this->NM_colspan . "\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
     } 
     else if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert']) 
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Descontos Item Container - ID:" . $_SESSION['item_container_id_corrente'] . " - " . $sc_data_cab1 . "</span></td>            \r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'] && $nm_refresch_cab_rod)
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['exibe_titulos']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_label'])
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
   $nm_saida->saida("    <TR id=\"tit_grid_descontos_importacao__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-grid_descontos_importacao-" . $tmp_header_row . "\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_arquivo_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf") {
       $classColFld = "";
       $classColTitle = "";
       $classColActions = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
           $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
           $classColTitle = " sc-col-title";
           $classColActions = " sc-col-actions";
       }
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . " sc-col-actionbar-left  " . $classColFld . $classColTitle . $classColActions . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_arquivo_label'] . "\" >\r\n");
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
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
       $this->grid_fixed_column_no++;
   } 
   $this->SC_label_rightActionBar();
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $Pos1 = strpos($cada_css, "{");
                 $Pos2 = strpos($cada_css, "}");
                 if ($Pos1 !== false && $Pos2 !== false) {
                     $Tag  = explode(",", trim(substr($cada_css, 0, $Pos1 - 1)));
                     $Css  = " " . substr($cada_css, $Pos1, $Pos2 - $Pos1 + 1);
                     $cada_css = ".grid_descontos_importacao_" . substr(trim($Tag[0]), 1);
                     if (isset($Tag[1])) {
                         $cada_css .= ", .grid_descontos_importacao_" . substr(trim($Tag[1]), 1);
                     }
                     $css_emb .= $cada_css . $Css;
                 }
                 else {
                       $css_emb .= ".grid_descontos_importacao_" . substr($cada_css, 1);
                 }
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cols_emb'] = count($Nm_temp) - 1;
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
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_fornecedor_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['fornecedor_id'])) ? $this->New_label['fornecedor_id'] : "Fornecedor";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['fornecedor_id']) || $this->NM_cmp_hidden['fornecedor_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_fornecedor_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_fornecedor_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('fornecedor_id');
        $fieldSortIcon = $this->scGetColumnOrderIcon('fornecedor_id', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_fornecedor_id_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_fornecedor_id_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('fornecedor_id')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_desconto_importacao_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['desconto_importacao_id'])) ? $this->New_label['desconto_importacao_id'] : "ID";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['desconto_importacao_id']) || $this->NM_cmp_hidden['desconto_importacao_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_desconto_importacao_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_desconto_importacao_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('desconto_importacao_id');
        $fieldSortIcon = $this->scGetColumnOrderIcon('desconto_importacao_id', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_desconto_importacao_id_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_desconto_importacao_id_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('desconto_importacao_id')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_motivo_desconto_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['motivo_desconto_id'])) ? $this->New_label['motivo_desconto_id'] : "Motivo Desconto Id";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['motivo_desconto_id']) || $this->NM_cmp_hidden['motivo_desconto_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_motivo_desconto_id_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_motivo_desconto_id_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('motivo_desconto_id');
        $fieldSortIcon = $this->scGetColumnOrderIcon('motivo_desconto_id', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_motivo_desconto_id_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_motivo_desconto_id_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('motivo_desconto_id')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_descricao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['descricao'])) ? $this->New_label['descricao'] : "Descrição";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['descricao']) || $this->NM_cmp_hidden['descricao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_descricao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_descricao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '';
        $fieldSortRule = $this->scGetColumnOrderRule('descricao');
        $fieldSortIcon = $this->scGetColumnOrderIcon('descricao', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_descricao_label . "\" style=\"display: flex; white-space: pre-line\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: pre-line\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_descricao_label . "\" style=\"display: flex; flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: pre-line" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('descricao')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_log_credito()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['log_credito'])) ? $this->New_label['log_credito'] : "Crédito?";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['log_credito']) || $this->NM_cmp_hidden['log_credito'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_log_credito_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_log_credito_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('log_credito');
        $fieldSortIcon = $this->scGetColumnOrderIcon('log_credito', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_log_credito_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_log_credito_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('log_credito')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_vl_dolar()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_dolar'])) ? $this->New_label['vl_dolar'] : "Vl. em Dólar";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_dolar']) || $this->NM_cmp_hidden['vl_dolar'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_dolar_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_dolar_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('vl_dolar');
        $fieldSortIcon = $this->scGetColumnOrderIcon('vl_dolar', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_dolar_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_dolar_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('vl_dolar')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_vl_real()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_real'])) ? $this->New_label['vl_real'] : "Vl. em Real";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_real']) || $this->NM_cmp_hidden['vl_real'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_real_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_real_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('vl_real');
        $fieldSortIcon = $this->scGetColumnOrderIcon('vl_real', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_real_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_real_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('vl_real')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_vl_cotacao_dolar()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_cotacao_dolar'])) ? $this->New_label['vl_cotacao_dolar'] : "Vl.Cotação Dolar";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_cotacao_dolar']) || $this->NM_cmp_hidden['vl_cotacao_dolar'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_cotacao_dolar_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_cotacao_dolar_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
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
 function NM_label_vl_real_autorizado()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_real_autorizado'])) ? $this->New_label['vl_real_autorizado'] : "Vl Real Autorizado";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_real_autorizado']) || $this->NM_cmp_hidden['vl_real_autorizado'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_real_autorizado_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_real_autorizado_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: right';
        $fieldSortRule = $this->scGetColumnOrderRule('vl_real_autorizado');
        $fieldSortIcon = $this->scGetColumnOrderIcon('vl_real_autorizado', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_vl_real_autorizado_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_vl_real_autorizado_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('vl_real_autorizado')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_vl_dolar_autorizado()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['vl_dolar_autorizado'])) ? $this->New_label['vl_dolar_autorizado'] : "";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['vl_dolar_autorizado']) || $this->NM_cmp_hidden['vl_dolar_autorizado'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_vl_dolar_autorizado_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_vl_dolar_autorizado_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
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
 function NM_label_dt_autorizacao()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['dt_autorizacao'])) ? $this->New_label['dt_autorizacao'] : "Dt Autorizacao";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['dt_autorizacao']) || $this->NM_cmp_hidden['dt_autorizacao'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_dt_autorizacao_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_dt_autorizacao_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
        // label & order
        $divLabelStyle = '; justify-content: center';
        $fieldSortRule = $this->scGetColumnOrderRule('dt_autorizacao');
        $fieldSortIcon = $this->scGetColumnOrderIcon('dt_autorizacao', $fieldSortRule);
        if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == 'right') {
            $this->Ini->Label_sort_pos = 'right_field';
        }
        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div class=\"" . $this->css_dt_autorizacao_label . "\" style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div class=\"" . $this->css_dt_autorizacao_label . "\" style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span></div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><span style=\"vertical-align: top;\">" . $fieldSortIcon . "</span><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_gp_submit2('dt_autorizacao')\" class=\"" . $this->css_scGridLabelLink . "\">". $label_labelContent . "</a>";
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
 function NM_label_arquivo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['arquivo'])) ? $this->New_label['arquivo'] : "Arquivos";
   $classColFld = "";
   $classColTitle = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
     $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
     $classColTitle = " sc-col-title";
   }
   if (!isset($this->NM_cmp_hidden['arquivo']) || $this->NM_cmp_hidden['arquivo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_inherit_bg . ' ' . $this->css_scGridLabelFont . $this->css_sep . $this->css_arquivo_label . " " . $classColFld . $classColTitle . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_arquivo_label'] . "\" >\r\n");
    $label_fieldName = nl2br($SC_Label);
    if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
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
function SC_label_rightActionBar()
{
        global $nm_saida;
}
    function scGetColumnOrderRule($fieldName)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_cmp'] == $fieldName) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ordem_label'] == 'desc') {
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
            case "fornecedor_id":
                return true;
            case "desconto_importacao_id":
                return true;
            case "motivo_desconto_id":
                return true;
            case "log_credito":
                return true;
            case "vl_dolar":
                return true;
            case "vl_real":
                return true;
            case "vl_cotacao_dolar":
                return true;
            case "vl_real_autorizado":
                return true;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "fornecedor_id":
                return 'desc';
            case "desconto_importacao_id":
                return 'desc';
            case "motivo_desconto_id":
                return 'desc';
            case "log_credito":
                return 'desc';
            case "vl_dolar":
                return 'desc';
            case "vl_real":
                return 'desc';
            case "vl_cotacao_dolar":
                return 'desc';
            case "vl_real_autorizado":
                return 'desc';
            case "dt_autorizacao":
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['fornecedor_id'])) ? $this->New_label['fornecedor_id'] : "Fornecedor";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['fornecedor_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['desconto_importacao_id'])) ? $this->New_label['desconto_importacao_id'] : "ID";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['desconto_importacao_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['motivo_desconto_id'])) ? $this->New_label['motivo_desconto_id'] : "Motivo Desconto Id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['motivo_desconto_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['descricao'])) ? $this->New_label['descricao'] : "Descrição";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['descricao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['log_credito'])) ? $this->New_label['log_credito'] : "Crédito?";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['log_credito'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_dolar'])) ? $this->New_label['vl_dolar'] : "Vl. em Dólar";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['vl_dolar'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_real'])) ? $this->New_label['vl_real'] : "Vl. em Real";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['vl_real'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_cotacao_dolar'])) ? $this->New_label['vl_cotacao_dolar'] : "Vl.Cotação Dolar";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['vl_cotacao_dolar'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_real_autorizado'])) ? $this->New_label['vl_real_autorizado'] : "Vl Real Autorizado";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['vl_real_autorizado'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['vl_dolar_autorizado'])) ? $this->New_label['vl_dolar_autorizado'] : "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['vl_dolar_autorizado'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['dt_autorizacao'])) ? $this->New_label['dt_autorizacao'] : "Dt Autorizacao";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['dt_autorizacao'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['arquivo'])) ? $this->New_label['arquivo'] : "Arquivos";
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['labels']['arquivo'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['grid_descontos_importacao']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_grid_descontos_importacao#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cab_embutida'] != "S")
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['lig_iframe_modal'] = "nmsc_iframe_liga_grid_descontos_importacao";
           }
           $nm_saida->saida(" <TR> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_EL_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;" . $this->css_body_embutida . "font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_grid_descontos_importacao', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_grid_descontos_importacao', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_grid_descontos_importacao', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_DL_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               if (!$_SESSION['scriptcase']['proc_mobile']) {
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_D_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               }
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_grid_descontos_importacao#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
{
}
else
{
       $nm_saida->saida("    <TR> \r\n");
}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_EL_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_grid_descontos_importacao#?#1\"";
   } 
   $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf") ? "padding: 0px !important;" : "";
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert'])
{
}
else
{
   $nm_saida->saida("  <TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;" . $TD_padding . $this->css_body_embutida . "\" width=\"100%\">\r\n");
}
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf']) { 
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf']) { 
 }else { 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-1e2b5a89\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
 }
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert']) { 
    $nm_saida->saida("</thead>\r\n");
 }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] && $this->pdf_all_label != "S" && $this->pdf_label_group != "S") 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = true;
   $this->Break_pag_pdf = array();
   $this->Break_pag_prt = array();
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Config_Page_break_PDF'] = "N";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Page_break_PDF']))
   {
       if (isset($this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby']]))
       {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp'] as $Cmp_gb => $resto)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Page_break_PDF'][$Cmp_gb] = $this->Break_pag_pdf['sc_free_group_by'][$Cmp_gb];
               }
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Page_break_PDF'] = $this->Break_pag_pdf[$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby']];
           }
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Page_break_PDF'] = array();
       }
   }
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $nm_prog_barr = 0;
   $PB_tot       = "/" . $this->count_ger;;
   $nm_houve_quebra = "N";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['doc_word'] && !$this->Ini->sc_export_ajax)
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
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  grid_descontos_importacao_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->fornecedor_id = $this->rs_grid->fields[0] ;  
          $this->fornecedor_id = (string)$this->fornecedor_id;
          $this->desconto_importacao_id = $this->rs_grid->fields[1] ;  
          $this->desconto_importacao_id = (string)$this->desconto_importacao_id;
          $this->motivo_desconto_id = $this->rs_grid->fields[2] ;  
          $this->motivo_desconto_id = (string)$this->motivo_desconto_id;
          $this->descricao = $this->rs_grid->fields[3] ;  
          $this->log_credito = $this->rs_grid->fields[4] ;  
          $this->log_credito = (string)$this->log_credito;
          $this->vl_dolar = $this->rs_grid->fields[5] ;  
          $this->vl_dolar =  str_replace(",", ".", $this->vl_dolar);
          $this->vl_dolar = (string)$this->vl_dolar;
          $this->vl_real = $this->rs_grid->fields[6] ;  
          $this->vl_real =  str_replace(",", ".", $this->vl_real);
          $this->vl_real = (string)$this->vl_real;
          $this->vl_cotacao_dolar = $this->rs_grid->fields[7] ;  
          $this->vl_cotacao_dolar =  str_replace(",", ".", $this->vl_cotacao_dolar);
          $this->vl_cotacao_dolar = (string)$this->vl_cotacao_dolar;
          $this->vl_real_autorizado = $this->rs_grid->fields[8] ;  
          $this->vl_real_autorizado =  str_replace(",", ".", $this->vl_real_autorizado);
          $this->vl_real_autorizado = (string)$this->vl_real_autorizado;
          $this->vl_dolar_autorizado = $this->rs_grid->fields[9] ;  
          $this->vl_dolar_autorizado = (string)$this->vl_dolar_autorizado;
          $this->dt_autorizacao = $this->rs_grid->fields[10] ;  
          $this->arquivo = $this->rs_grid->fields[11] ;  
          $GLOBALS["motivo_desconto_id"] = $this->rs_grid->fields[2] ;  
          $GLOBALS["motivo_desconto_id"] = (string)$GLOBALS["motivo_desconto_id"];
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final'] + 1; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['rows_emb']++;
          $this->sc_proc_grid = true;
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              if ($nm_houve_quebra == "S" || $this->nm_inicio_pag == 0)
              { 
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid']) {
                      $this->label_grid($linhas);
                  } 
                  $nm_houve_quebra = "N";
              } 
          } 
          $this->nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "dt_autorizacao")
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
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_arquivo_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . str_replace(array("'", '"'), array("\'", '\"'), $teste) . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] != "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['lig_iframe_modal'] = "nmsc_iframe_liga_grid_descontos_importacao";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              $linkTarget = isset($this->Ini->sc_lig_target['A_@scinf__@scinf_form_descontos_importacao']) ? $this->Ini->sc_lig_target['A_@scinf__@scinf_form_descontos_importacao'] : (isset($this->Ini->sc_lig_target['A_@scinf_']) ? $this->Ini->sc_lig_target['A_@scinf_'] : null);
              if (isset($this->Ini->sc_lig_md5["form_descontos_importacao"]) && $this->Ini->sc_lig_md5["form_descontos_importacao"] == "S")
              {
                  $Parms_Edt  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard'] && isset($linkTarget))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_border'] ? '1' : '0') . '*scoutremove_background*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_background'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "nm_gp_submit4('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_descontos_importacao', '" . $this->SC_ancora . "')", "nm_gp_submit4('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_descontos_importacao', '" . $this->SC_ancora . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("<td style=\"padding: 0px\">" . $Link_Edit . "</td>\r\n");
          $nm_saida->saida("</tr></table\r\n");
          $nm_saida->saida("></TD>\r\n");
 $this->grid_fixed_column_no++;} 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['mostra_edit'] == "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['lig_iframe_modal'] = "nmsc_iframe_liga_grid_descontos_importacao";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              $linkTarget = isset($this->Ini->sc_lig_target['A_@scinf__@scinf_form_descontos_importacao']) ? $this->Ini->sc_lig_target['A_@scinf__@scinf_form_descontos_importacao'] : (isset($this->Ini->sc_lig_target['A_@scinf_']) ? $this->Ini->sc_lig_target['A_@scinf_'] : null);
              if (isset($this->Ini->sc_lig_md5["form_descontos_importacao"]) && $this->Ini->sc_lig_md5["form_descontos_importacao"] == "S")
              {
                  $Parms_Edt  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard'] && isset($linkTarget))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $linkTarget . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_border'] ? '1' : '0') . '*scoutremove_background*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['remove_background'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "nm_gp_submit4('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_descontos_importacao', '" . $this->SC_ancora . "')", "nm_gp_submit4('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location',  '$Md5_Edt' , '". (isset($linkTarget) ? $linkTarget : '_self') . "', '', 'form_descontos_importacao', '" . $this->SC_ancora . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
          $nm_saida->saida("<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" class=\"sc-actionbar-button-container sc-actbtn-group-" . $dataActionbarPos . "_" . $this->SC_seq_page . "\"><tr>\r\n");
          $nm_saida->saida("</tr></table>\r\n");
          $nm_saida->saida("</TD>\r\n");
 $this->grid_fixed_column_no++;} 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
              $this->grid_fixed_column_no++;
          } 
   $this->SC_grid_rightActionBar();
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
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
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_DL_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
       $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida(" </tr></table></td> </tr></table></td> </tr></table></td>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_D_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       }
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao']       = "igual" ; 
   } 
 }
function SC_grid_rightActionBar()
{
        global $nm_saida;
    $dataActionbarPos = 'right';
}
 function NM_grid_fornecedor_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['fornecedor_id']) || $this->NM_cmp_hidden['fornecedor_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->fornecedor_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->fornecedor_id)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_fornecedor_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_fornecedor_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_fornecedor_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_desconto_importacao_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['desconto_importacao_id']) || $this->NM_cmp_hidden['desconto_importacao_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->desconto_importacao_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->desconto_importacao_id)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_desconto_importacao_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_desconto_importacao_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_desconto_importacao_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_motivo_desconto_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['motivo_desconto_id']) || $this->NM_cmp_hidden['motivo_desconto_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->motivo_desconto_id)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->motivo_desconto_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_motivo_desconto_id($conteudo , $this->motivo_desconto_id) ; 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_motivo_desconto_id_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_motivo_desconto_id_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_motivo_desconto_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_descricao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['descricao']) || $this->NM_cmp_hidden['descricao'] != "off") { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $conteudo = NM_encode_input(sc_strip_script($this->descricao));
              $conteudo_original = NM_encode_input(sc_strip_script($this->descricao));
          }
          else {
              $conteudo = sc_strip_script($this->descricao); 
              $conteudo_original = sc_strip_script($this->descricao); 
          }
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "";
          }
          else
          {
              $this->SC_nowrap = "";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_descricao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_descricao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_descricao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_log_credito()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['log_credito']) || $this->NM_cmp_hidden['log_credito'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->log_credito)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->log_credito)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_log_credito($conteudo); 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_log_credito_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_log_credito_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_log_credito_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_dolar()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_dolar']) || $this->NM_cmp_hidden['vl_dolar'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_dolar)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_dolar)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_vl_dolar_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_vl_dolar_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_dolar_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_real()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_real']) || $this->NM_cmp_hidden['vl_real'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_real)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_real)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_vl_real_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_vl_real_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_real_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_cotacao_dolar()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_cotacao_dolar']) || $this->NM_cmp_hidden['vl_cotacao_dolar'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_cotacao_dolar)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_cotacao_dolar)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_vl_cotacao_dolar_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_vl_cotacao_dolar_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_cotacao_dolar_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_real_autorizado()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_real_autorizado']) || $this->NM_cmp_hidden['vl_real_autorizado'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_real_autorizado)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_real_autorizado)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_vl_real_autorizado_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_vl_real_autorizado_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_real_autorizado_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_vl_dolar_autorizado()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['vl_dolar_autorizado']) || $this->NM_cmp_hidden['vl_dolar_autorizado'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->vl_dolar_autorizado)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->vl_dolar_autorizado)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_vl_dolar_autorizado_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_vl_dolar_autorizado_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_vl_dolar_autorizado_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_dt_autorizacao()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['dt_autorizacao']) || $this->NM_cmp_hidden['dt_autorizacao'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->dt_autorizacao)); 
          $conteudo_original = NM_encode_input(sc_strip_script($this->dt_autorizacao)); 
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_dt_autorizacao_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_dt_autorizacao_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_dt_autorizacao_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_arquivo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['arquivo']) || $this->NM_cmp_hidden['arquivo'] != "off") { 
          $conteudo = (string)$this->arquivo; 
          $conteudo_original = $conteudo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] != "pdf" && $conteudo != "&nbsp;") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sub_dir'][$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['seq_dir']]  = "";
              $nm_img_icone = "";
              $name_protect = base64_encode($this->arquivo);
              $Parms_img  = "nm_cod_doc?#?" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['seq_dir'] . "?@?nm_nome_doc?#?" . $name_protect . "?@?nm_cod_apl?#?grid_descontos_importacao";
              $Md5_Img    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_img);
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_img)] = $Parms_img;
              $conteudo = "$nm_img_icone<a href=\"javascript:nm_mostra_doc('" . $Md5_Img . "', '" . $this->Ini->path_link  . "grid_descontos_importacao/grid_descontos_importacao_doc.php')\" target=\"_self\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_arquivo_grid_line . "\">$conteudo</a>";  
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['seq_dir']++; 
          } 
          $str_tem_display = $conteudo;
          $classColFld = "";
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != 'print' && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != 'pdf') {
              $classColFld = " sc-col-fld sc-col-fld-" . $this->grid_fixed_column_no;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'])
          {
              $this->SC_nowrap = "NOWRAP";
          }
          else
          {
              $this->SC_nowrap = "NOWRAP";
          }
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_inherit_bg . ' ' . $this->css_line_fonf . $this->css_sep . $this->css_arquivo_grid_line . " " . $classColFld . "\"  style=\"" . $this->Css_Cmp['css_arquivo_grid_line'] . "\" " . $this->SC_nowrap . " align=\"\" valign=\"top\"   HEIGHT=\"0px\"><span id=\"id_sc_field_arquivo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 14;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_pdf'] == "pdf")
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
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['print_navigator'] == "Netscape")
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
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
        {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf']) { 
           }
           else
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert']) { 
                $nm_saida->saida("     <thead>\r\n");
               }
               $this->cabecalho();
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf_vert']) { 
                $nm_saida->saida("     </thead>\r\n");
               }
           }
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\" width=\"100%\"> \r\n");
        $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] && ($this->pdf_all_cab == "S" || $this->pdf_all_label == "S")) { 
            $nm_saida->saida(" <thead> \r\n");
            if ($this->pdf_all_cab == "S")
            {
                $this->cabecalho();
            }
            if ($this->pdf_all_label == "S" && $nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
            {
                $this->label_grid();
            }
            $nm_saida->saida(" </thead> \r\n");
        }
        if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] && $nm_parms != "resumo" && $nm_parms != "pagina" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
        {
            $this->label_grid();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['proc_pdf'] && $this->pdf_label_group != "S" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida_grid'])
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
// 
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        if ($nm_tipo == "xlsx")
        {
            $nm_tipo = "xls";
        }
        if ($nm_tipo == "docx")
        {
            $nm_tipo = "doc";
        }
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
      {
        if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['new'] == "on" && $this->nmgp_botoes['insert'] == "on" && !$this->grid_emb_form)
        {
           if ($this->grid_emb_form_full)
           {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['lig_iframe_modal'] = "nmsc_iframe_liga_grid_descontos_importacao";
           }
           $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
           if (isset($this->Ini->sc_lig_md5["form_descontos_importacao"]) && $this->Ini->sc_lig_md5["form_descontos_importacao"] == "S") {
               $Parms_Lig  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
           }
         $this->nm_btn_exist['new'][] = "sc_b_new_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bnovo", "nm_gp_submit1('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_descontos_importacao'); return false;;", "nm_gp_submit1('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_descontos_importacao'); return false;;", "sc_b_new_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
      {
          $Tem_pdf_res = "s";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
      {
          $Tem_pdf_res = "n";
      }
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume&nm_all_modules=grid,resume&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=pt_br&conf_socor=S&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=grid_descontos_importacao&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_pdf_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
          {
              $Tem_pdf_res = "n";
          }
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
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
      if ($this->nmgp_botoes['dynsearch'] == "on" && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
              $this->nm_btn_exist['dynsearch'][] = "dynamic_search_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "dynamic_search_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo'])) {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              else { 
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0');", "nm_gp_move('resumo', '0');", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              } 
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
          }
        }
          if (is_file("grid_descontos_importacao_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_descontos_importacao_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal'])
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
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '10') ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '20') ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '30') ? " selected" : "";
              $nm_saida->saida("           <option value=\"30\" " . $obj_sel . ">30</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '50') ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '100') ? " selected" : "";
              $nm_saida->saida("           <option value=\"100\" " . $obj_sel . ">100</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] == '200') ? " selected" : "";
              $nm_saida->saida("           <option value=\"200\" " . $obj_sel . ">200</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
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
          if (is_file("grid_descontos_importacao_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_descontos_importacao_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on" && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['fast_search'][2] : "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
      {
          $Tem_pdf_res = "s";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
      {
          $Tem_pdf_res = "n";
      }
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume&nm_all_modules=grid,resume&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=2&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=pt_br&conf_socor=S&script_case_init='__OMITIDO_NA_COPIA_DE_ANALISE__'&app_name=grid_descontos_importacao&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_word_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_word_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
          {
              $Tem_word_res = "n";
          }
          $nm_saida->saida("            <div id=\"div_word_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['word'][] = "word_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_word.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_cor=AM&nm_res_cons=" . $Tem_word_res . "&nm_ini_word_res=grid&nm_all_modules=grid,resume&password=n&origem=cons&language=pt_br&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xls_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xls_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_xml_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_xml_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $Tem_csv_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_csv_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_rtf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['rtf'][] = "rtf_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_rtf_conf();", "nm_gp_rtf_conf();", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
          {
              $Tem_pdf_res = "s";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Gb_Free_cmp']))
          {
              $Tem_pdf_res = "n";
          }
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=pt_br&nm_page='__OMITIDO_NA_COPIA_DE_ANALISE__'&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['dynsearch'] == "on" && !$this->grid_emb_form && !$this->NM_hidden_filters)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_dynamic_search_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['dynsearch'][] = "dynamic_search_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdynamicsearch", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); scrollToElement('#div_dyn_search'); }SC_carga_evt_jquery('all');", "dynamic_search_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_selcmp_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $this->nm_btn_exist['sel_col'][] = "selcmp_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnSelCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "scBtnOrderCamposShow('" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&use_alias=" . $UseAlias . "&embbed_groupby=Y&toolbar_pos=top', 'top');", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['SC_Ind_Groupby'] != "sc_free_total")
        {
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_res_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['summary'][] = "res_top";
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['where_resumo'])) {
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
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn)
          {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $NM_Gbtn = false;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          if ($NM_Gbtn) {
              $NM_btn  = true;
          }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
          if (is_file("grid_descontos_importacao_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_descontos_importacao_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_psq'])
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal'])
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
        if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['new'] == "on" && $this->nmgp_botoes['insert'] == "on" && !$this->grid_emb_form)
        {
           if ($this->grid_emb_form_full)
           {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['lig_iframe_modal'] = "nmsc_iframe_liga_grid_descontos_importacao";
           }
           $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
           if (isset($this->Ini->sc_lig_md5["form_descontos_importacao"]) && $this->Ini->sc_lig_md5["form_descontos_importacao"] == "S") {
               $Parms_Lig  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "desconto_importacao_id*scin" . str_replace('"', "@aspasd@", $this->desconto_importacao_id) . "*scoutitem_container_id_corrente*scin0*scoutNM_cancel_insert_new*scin1*scoutNM_cancel_return_new*scin1*scoutnmgp_opcao*scinnovo*scoutNM_btn_insert*scinS*scoutNM_btn_new*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
           }
         $this->nm_btn_exist['new'][] = "sc_b_new_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bnovo", "nm_gp_submit1('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_descontos_importacao'); return false;;", "nm_gp_submit1('" .  $this->Ini->link_form_descontos_importacao . "', '$this->nm_location', '$Md5_Lig', '_self', 'form_descontos_importacao'); return false;;", "sc_b_new_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
        }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_bot_table\" class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['forward'][] = "forward_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "nm_gp_submit_rec('" . $this->Rec_fim . "');", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']))
          {
              $this->nm_btn_exist['last'][] = "last_bot";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim');", "nm_gp_submit_rec('fim');", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if (is_file("grid_descontos_importacao_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("grid_descontos_importacao_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
   function html_dynamic_search()
   {
       global $nm_saida;
       $this->Dyn_search_seq = 0;
       $this->Dyn_search_str = "";
       $this->Dyn_search_dat = array();
       $this->NM_case_insensitive = true;
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['cond_pesq'];
           $pos = strrpos($tmp, "##*@@");
           if ($pos !== false)
           {
               $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
               $tmp    = substr($tmp, 0, $pos);
               $this->Dyn_search_str = str_replace("##*@@", " " . $and_or . " ", $tmp);
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['log_credito'] = (isset($this->New_label['log_credito'])) ? $this->New_label['log_credito'] : "Crédito?";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['fornecedor_id'] = (isset($this->New_label['fornecedor_id'])) ? $this->New_label['fornecedor_id'] : "Fornecedor";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['dt_autorizacao'] = (isset($this->New_label['dt_autorizacao'])) ? $this->New_label['dt_autorizacao'] : "Dt Autorizacao";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['motivo_desconto_id'] = (isset($this->New_label['motivo_desconto_id'])) ? $this->New_label['motivo_desconto_id'] : "Motivo Desconto Id";
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     var mens_select2_notfound  = '" . $this->Ini->Nm_lang['lang_autocomp_notfound'] . "';\r\n");
       $nm_saida->saida("     var mens_select2_searching = '" . $this->Ini->Nm_lang['lang_autocomp_searching'] . "';\r\n");
       $nm_saida->saida("     var mens_select2_disabled  = '" . $this->Ini->Nm_lang['lang_othr_filter_disabled'] . "';\r\n");
       $nm_saida->saida("   </script>\r\n");
       $nm_saida->saida("   <tr id=\"NM_Dynamic_Search\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("   <td  colspan=3 valign=\"top\"> \r\n");
   $_display = (empty($this->Dyn_search_str)?'none':'');
       $nm_saida->saida("   <span id='id_dyn_search_cmd_string' style=\"display:" . $_display . ";\"> \r\n");
       $nm_saida->saida("   <div class=\"" . $this->css_scAppDivMoldura . " \" style=\"display:flex;justify-content:space-between;\"> \r\n");
       $nm_saida->saida("    <div style='display:flex; gap:5px; align-items:center;'> \r\n");
       $nm_saida->saida("     <span class=\"" . $this->css_scAppDivHeaderText . "\" style='display:flex; align-items:center;'>\r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_exp))
             {
       $nm_saida->saida("                             <a id='a_id_dyn_search_cmd_string' href=\"#\" onclick=\"$('#id_dyn_search_cmd_string').hide();$('#div_dyn_search').show();\" style=\"text-decoration:none\">\r\n");
       $nm_saida->saida("                                     <img id='id_app_div_tree_img_exp' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_exp . "\" border=0 align='absmiddle' style='vertical-align: middle;'>\r\n");
       $nm_saida->saida("                             </a>\r\n");
             }
       $nm_saida->saida("             <i class='fa-solid fa-filter' style='margin-right: 5px;'></i>" . $this->Ini->Nm_lang['lang_othr_dynamicsearch_title_outside'] . ":\r\n");
       $nm_saida->saida("     </span>\r\n");
       $nm_saida->saida("     <span id='id_dyn_search_cmd_str' class=\"" . $this->css_scAppDivContentText . " scGridFilterDynResult\" style='white-space: pre-wrap;vertical-align: baseline;'>" . trim($this->Dyn_search_str) . "</span>\r\n");
       $nm_saida->saida("    </div> \r\n");
       $nm_saida->saida("   </div> \r\n");
       $nm_saida->saida("    </span> \r\n");
       $nm_saida->saida("   <div id=\"div_dyn_search\" style=\"display: none\" class=\"" . $this->css_scAppDivMoldura . "\"> \r\n");
       $nm_saida->saida("    <form id= \"id_Fdyn_search\" name=\"Fdyn_search\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_opcao\" value=\"dyn_search\"/> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"parm\" value=\"\"/> \r\n");
       $nm_saida->saida("    <table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\" cellspacing=0 cellpadding=0>\r\n");
       $nm_saida->saida("      <tr>\r\n");
       $nm_saida->saida("        <td class=\"" . $this->css_scAppDivHeader . " " . $this->css_scAppDivHeaderText . "\">\r\n");
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_col))
             {
       $nm_saida->saida("                             <a id=\"nm_close_dyn\" href=\"#\" onclick=\"$('#div_dyn_search').hide(); if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').show(); }\" style=\"text-decoration:none\">\r\n");
       $nm_saida->saida("                                     <img id='id_app_div_tree_img_col' src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->App_div_tree_img_col . "\" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'>\r\n");
       $nm_saida->saida("                             </a>\r\n");
             }
       $nm_saida->saida("            " . $this->Ini->Nm_lang['lang_othr_dynamicsearch_title'] . "\r\n");
       $nm_saida->saida("        </td>\r\n");
       $nm_saida->saida("      </tr>\r\n");
       $this->Cmps_select2 = array();
       $nm_saida->saida("      <tr>\r\n");
       $nm_saida->saida("        <td class=\"" . $this->css_scAppDivContent . " " . $this->css_scAppDivContentText . "\">\r\n");
       $nm_saida->saida("            <div id=\"table_dyn_search\">\r\n");
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search'] as $IX => $def)
           {
               $cmp = $def['cmp'];
               if ($cmp == "log_credito")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "log_credito";
                   $lin_obj = $this->dynamic_search_log_credito($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
               if ($cmp == "fornecedor_id")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "fornecedor_id";
                   $lin_obj = $this->dynamic_search_fornecedor_id($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
               if ($cmp == "dt_autorizacao")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "dt_autorizacao";
                   $lin_obj = $this->dynamic_search_dt_autorizacao($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
               if ($cmp == "motivo_desconto_id")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "motivo_desconto_id";
                   $lin_obj = $this->dynamic_search_motivo_desconto_id($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   $nm_saida->saida("" . $lin_obj . "\r\n");
               }
           }
       }
       $nm_saida->saida("                </div>\r\n");
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_out_cond']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_out_cond']))
       {
           $prim_out = true;
           $nm_saida->saida("              <div id='id_dyn_search_out_inside'>\r\n");
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_out_cond'] as $cada_out)
           {
               if (!$prim_out)
               {
                   $nm_saida->saida("              &nbsp;&nbsp;&nbsp;&nbsp;\r\n");
               }
               $nm_saida->saida("               " . $cada_out . "\r\n");
               $prim_out = false;
           }
           $nm_saida->saida("              </div>\r\n");
       }
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("    <tr>\r\n");
       $nm_saida->saida("        <td nowrap  class=\"" . $this->css_scAppDivToolbar . "\">\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdyn_addfields", "nm_show_dynamicsearch_fields(false); return false;", "nm_show_dynamicsearch_fields(false); return false;", "bdyn_addfields", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $nm_saida->saida("      <table id='id_dynamic_search_fields' class=\"SC_SubMenuApp\" style='display:none; position: absolute; border-collapse: collapse; z-index: 1000'> \r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div id='Add_field_log_credito' class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('log_credito', 'grid')\">\r\n");
       $nm_saida->saida("                  " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['log_credito'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div id='Add_field_fornecedor_id' class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('fornecedor_id', 'grid')\">\r\n");
       $nm_saida->saida("                  " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['fornecedor_id'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div id='Add_field_dt_autorizacao' class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('dt_autorizacao', 'grid')\">\r\n");
       $nm_saida->saida("                  " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['dt_autorizacao'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("        <tr>\r\n");
       $nm_saida->saida("            <td class='scBtnGrpBackground'>\r\n");
       $nm_saida->saida("                <div id='Add_field_motivo_desconto_id' class='scBtnGrpText' style='cursor: pointer;' onclick=\"ajax_add_dyn_search('motivo_desconto_id', 'grid')\">\r\n");
       $nm_saida->saida("                  " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['motivo_desconto_id'] . "\r\n");
       $nm_saida->saida("                </div>\r\n");
       $nm_saida->saida("            </td>\r\n");
       $nm_saida->saida("        </tr>\r\n");
       $nm_saida->saida("      </table> \r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bapply_appdiv", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "dyn_search", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdyn_clear", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "dyn_search_clear", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("      &nbsp;&nbsp;&nbsp;\r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_cancel_dyn_search();", "nm_cancel_dyn_search();", "dyn_cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdyn_remove", "if(!$('#dyn_search_clear').hasClass('disabled')){ $('#dyn_search_clear').click(); } if(!$('#dyn_search').hasClass('disabled')){ $('#dyn_search').click(); }else{ $('#dyn_cancel').click(); }", "if(!$('#dyn_search_clear').hasClass('disabled')){ $('#dyn_search_clear').click(); } if(!$('#dyn_search').hasClass('disabled')){ $('#dyn_search').click(); }else{ $('#dyn_cancel').click(); }", "bdyn_remove", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $nm_saida->saida("      $Cod_Btn \r\n");
       $nm_saida->saida("        </td>\r\n");
       $nm_saida->saida("    </tr>\r\n");
       $nm_saida->saida("    </table>\r\n");
       $nm_saida->saida("   </form>\r\n");
       $nm_saida->saida("   </div>\r\n");
       $nm_saida->saida("   </td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setValue'][] = array('field' => 'NM_Dynamic_Search', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           $_SESSION['scriptcase']['saida_html'] = "";
           $this->Ini->Arr_result['setValue'][] = array('field' => 'id_dyn_search_cmd_str', 'value' => NM_charset_to_utf8(trim($this->Dyn_search_str)));
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_clear']))
           { 
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_clear']);
               return;
           } 
           if(!empty($this->Dyn_search_str))
           {
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'id_dyn_search_cmd_string', 'value' => '');
           } 
           elseif(!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['new']['fields']) || !is_array($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['new']['fields']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['new']['fields']))
           {
               $this->Ini->Arr_result['setDisplay'][] = array('field' => 'id_dyn_search_cmd_string', 'value' => 'none');
           } 
           $this->Ini->Arr_result['setDisplay'][] = array('field' => 'div_dyn_search', 'value' => 'none');
       } 
       $nm_saida->saida("   </tr>\r\n");
       $this->JS_dynamic_search();
   }
   function dynamic_search_log_credito($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "eq";
       }
       if ($opc == 'bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_log_credito_" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "       <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['log_credito'] . " ";
       $lin_obj .= "       </div>";
       $lin_obj .= "      </div >";
       $lin_obj .= "      <div class='fixed_width_conditions '>";
       $lin_obj .= "       <select id='dyn_search_log_credito_cond_" . $ind . "' name='cond_dyn_search_log_credito_" . $ind . "' class=' " . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input  fixed_width_input100'>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_check_ret']['log_credito'] = array();
       $nmgp_def_dados  = ""; 
       $nmgp_def_dados .= "?#??#?N?@?"; 
       $nmgp_def_dados .= "Sim?#?1?#?N?@?";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_check_ret']['log_credito'][] = "1";
       $nmgp_def_dados .= "Não ?#?0?#?N?@?";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_check_ret']['log_credito'][] = "0";
       $lin_obj .= "    <SELECT class='" . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='height : auto;' id=\"dyn_search_log_credito_val_" . $ind . "\" name=\"val_dyn_search_log_credito_" . $ind . "[]\"  size=1 multiple onChange=\"buttonEnable_dyn('dyn_search'); buttonDisable_dyn('Save_frm_dyn'); buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $delimitador = "##@@";
       $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
       $nm_opcoes  = explode("?@?", $nm_opcoesx);
       $val = isset($val[0]) ? $val[0] : array();
       foreach ($nm_opcoes as $nm_opcao)
       {
          if (!empty($nm_opcao))
          {
             $temp_bug_list = explode("?#?", $nm_opcao);
             list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
             if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
             if (is_array($val) && !empty($val))
             {
                $log_credito_sel = "";
                foreach ($val as $Dados)
                {
                    $tmp_pos = (is_string($Dados)) ? strpos($Dados, "##@@") : false;
                    if ($tmp_pos !== false)
                    {
                        $Dados = substr($Dados, 0, $tmp_pos);
                    }
                    if ($Dados === $nm_opc_cod)
                    {
                        $log_credito_sel = " selected";
                        break;
                    }
                }
             }
             else
             {
                $log_credito_sel = ("S" == $nm_opc_sel) ? " selected" : "";
             }
             $lin_obj .= "       <OPTION value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\"" . $log_credito_sel . ">" . $nm_opc_val . "</OPTION>";
          }
       }
       $lin_obj .= "    </SELECT>";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' style='cursor:pointer' id='dyn_search_log_credito_close_" . $ind . "' class='dyn_search_close' title='". $this->Ini->Nm_lang['lang_usr_lang_del'] ."' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_log_credito_" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_log_credito_" . $ind . "'  id='dyn_search_enabled_log_credito_" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_fornecedor_id($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "eq";
       }
       if ($opc == 'bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_fornecedor_id_" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "       <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['fornecedor_id'] . " ";
       $lin_obj .= "       </div>";
       $lin_obj .= "      </div >";
       $lin_obj .= "      <div class='fixed_width_conditions '>";
       $lin_obj .= "       <select id='dyn_search_fornecedor_id_cond_" . $ind . "' name='cond_dyn_search_fornecedor_id_" . $ind . "' class=' " . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input  fixed_width_input100'>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj' id='dyn_search_fornecedor_id_val_" . $ind . "' name='val_dyn_search_fornecedor_id_" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search'); buttonDisable_dyn('Save_frm_dyn'); buttonDisable_dyn('SC_nmgp_save_name_dyn');\" value=\"" . NM_encode_input($val_cmp) . "\" size=8 alt=\"{datatype: 'decimal', maxLength: 8, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       if (isset($this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"]) && $this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"] == "S") {
           $Parms_Lig  = "nmgp_parms_ret*scinFdyn_search,val_dyn_search_fornecedor_id_" . $ind . ",cod-emitente*scoutnmgp_perm_edit*scinS*scout";
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Lig_Md5_cap'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig  = "nmgp_parms_ret*scinFdyn_search,val_dyn_search_fornecedor_id_" . $ind . ",cod-emitente*scoutnmgp_perm_edit*scinS*scout";
       }
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap_dyn('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap_dyn('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

       $lin_obj .= "&nbsp;" . $Cod_Btn;
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' style='cursor:pointer' id='dyn_search_fornecedor_id_close_" . $ind . "' class='dyn_search_close' title='". $this->Ini->Nm_lang['lang_usr_lang_del'] ."' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_fornecedor_id_" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_fornecedor_id_" . $ind . "'  id='dyn_search_enabled_fornecedor_id_" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_dt_autorizacao($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "ge";
       }
       if ($opc == 'bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_dt_autorizacao_" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "       <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['dt_autorizacao'] . " ";
       $lin_obj .= "       </div>";
       $lin_obj .= "      </div >";
       $lin_obj .= "      <div class='fixed_width_conditions '>";
       $lin_obj .= "       <select id='dyn_search_dt_autorizacao_cond_" . $ind . "' name='cond_dyn_search_dt_autorizacao_" . $ind . "' class=' " . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_change_bi(\"dt_autorizacao\", $ind)'>";
       $lin_obj .= "        <optgroup label=\"" . $this->Ini->Nm_lang['lang_srch_nrml'] . "\">";
       $selected = ($opc == "ge") ? " selected" : "";
       $lin_obj .= "        <option value='ge'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "bw") ? " selected" : "";
       $lin_obj .= "        <option value='bw'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_betw'] . "</option>";
       $selected = ($opc == "le") ? " selected" : "";
       $lin_obj .= "        <option value='le'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less_equl'] . "</option>";
       $selected = ($opc == "nu") ? " selected" : "";
       $lin_obj .= "        <option value='nu'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_null'] . "</option>";
       $selected = ($opc == "nn") ? " selected" : "";
       $lin_obj .= "        <option value='nn'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_nnul'] . "</option>";
       $lin_obj .= "        <optgroup label=\"" . $this->Ini->Nm_lang['lang_srch_spec'] . "\">";
       $selected = ($opc == "bi_HJ") ? " selected" : "";
       $lin_obj .= "        <option value='bi_HJ'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_tday'] . "</option>";
       $selected = ($opc == "bi_OT") ? " selected" : "";
       $lin_obj .= "        <option value='bi_OT'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_yest'] . "</option>";
       $selected = ($opc == "bi_U7") ? " selected" : "";
       $lin_obj .= "        <option value='bi_U7'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_lst7'] . "</option>";
       $selected = ($opc == "bi_last_30_dias") ? " selected" : "";
       $lin_obj .= "        <option value='bi_last_30_dias'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_last_30_dias'] . "</option>";
       $selected = ($opc == "bi_CY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_CY'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_year_today'] . "</option>";
       $selected = ($opc == "bi_LY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_LY'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_year'] . "</option>";
       $selected = ($opc == "bi_MM") ? " selected" : "";
       $lin_obj .= "        <option value='bi_MM'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_this_mnth'] . "</option>";
       $selected = ($opc == "bi_UM") ? " selected" : "";
       $lin_obj .= "        <option value='bi_UM'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_mnth'] . "</option>";
       $selected = ($opc == "bi_M3") ? " selected" : "";
       $lin_obj .= "        <option value='bi_M3'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_03mo'] . "</option>";
       $selected = ($opc == "bi_YY") ? " selected" : "";
       $lin_obj .= "        <option value='bi_YY'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_last_12mo'] . "</option>";
       $selected = ($opc == "bi_current_week_today") ? " selected" : "";
       $lin_obj .= "        <option value='bi_current_week_today'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_week_today'] . "</option>";
       $selected = ($opc == "bi_current_week") ? " selected" : "";
       $lin_obj .= "        <option value='bi_current_week'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_current_week'] . "</option>";
       $selected = ($opc == "bi_last_week") ? " selected" : "";
       $lin_obj .= "        <option value='bi_last_week'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_summary_last_week'] . "</option>";
       $selected = ($opc == "bi_este_mes_full") ? " selected" : "";
       $lin_obj .= "        <option value='bi_este_mes_full'" . $selected . ">" . $this->Ini->Nm_lang['lang_search_este_mes_full'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $Form_base          = "ddmmyyyy";
       $date_format_show   = "";
       $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
       $Lim   = strlen($Str_date);
       $Str   = "";
       $Ult   = "";
       $Arr_D = array();
       for ($I = 0; $I < $Lim; $I++)
       {
           $Char = substr($Str_date, $I, 1);
           if ($Char != $Ult && "" != $Str)
           {
               $Arr_D[] = $Str;
               $Str     = $Char;
           }
           else
           {
              $Str    .= $Char;
           }
           $Ult = $Char;
       }
       $Arr_D[] = $Str;
       $Prim = true;
       foreach ($Arr_D as $Cada_d)
       {
           if (strpos($Form_base, $Cada_d) !== false)
           {
               $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
               $date_format_show .= $Cada_d;
               $Prim = false;
           }
       }
       $Tmp_date = $Arr_D;
       $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
       $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
       $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
       $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
       $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
       $Place_holder = array('dd'=>'','mm'=>'','yyyy'=>'','hh'=>'','ii'=>'','ss'=>'');
       $display_bi = "";
       $display_nm = "";
       $bi_dt1     = "";
       $bi_dt2     = "";
       if (substr($opc, 0, 3) == "bi_")
       {
           $display_nm = "none";
           if ($opc != "bi_TP")
           {
               $tmp_opc = $opc;
               $this->Ini->process_cond_bi($tmp_opc, $bi_dt1, $bi_dt2);
               $this->formata_bi_dt_autorizacao($opc, $bi_dt1, $bi_dt2, $tmp_opc);
           }
       }
       else
       {
           $display_bi = "none";
       }
       $lin_obj .= "<SPAN id=\"ID_bi_dados_dt_autorizacao_" . $ind . "\" style=\"display:" . $display_bi . ";\">" . $bi_dt1 . $bi_dt2 . "</SPAN>";
       $lin_obj .= "<table id=\"ID_nm_dados_dt_autorizacao_" . $ind . "\" style=\"display:" . $display_nm . ";\" cellpadding=0 cellspacing=0>";
       $lin_obj .= "<tr><td nowrap>";
       $val_r = $this->Ini->dyn_convert_date($val[0]);
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_year_calendar' id='dyn_search_dt_autorizacao_ano_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_ano_" . $ind . "' placeholder=\"" . $Place_holder['yyyy'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=4  alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search'); buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_date_calendar' id='dyn_search_dt_autorizacao_mes_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_mes_" . $ind . "' placeholder=\"" . $Place_holder['mm'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_date_calendar' id='dyn_search_dt_autorizacao_dia_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_dia_" . $ind . "' placeholder=\"" . $Place_holder['dd'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "     <input type=\"hidden\" id=\"sc_dt_autorizacao_jq_" . $ind . "\">";
       $lin_obj .= "</td></tr></table>";
       if ($opc == "bw")
       {
           $display_in_2 = "'block'";
       }
       else
       {
           $display_in_2 = "none";
       }
       $lin_obj .= "       <span id=\"dyn_dt_autorizacao_in_2_" . $ind . "\" style=\"margin-top: .4rem; display:" . $display_in_2 . "\">";
       $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
       {
           $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $lin_obj .= "       <span style='margin: .4rem 0px; display:block;'></span>";
       $val_r = isset($val[1]) ? $this->Ini->dyn_convert_date($val[1]) : array();
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_year_calendar' id='dyn_search_dt_autorizacao_v2__ano_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_v2__ano_" . $ind . "' placeholder=\"" . $Place_holder['yyyy'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=4  alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search'); buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_date_calendar' id='dyn_search_dt_autorizacao_v2__mes_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_v2__mes_" . $ind . "' placeholder=\"" . $Place_holder['mm'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input " . $this->css_scAppDivToolbarInput . " css_toolbar_obj fixed_width_date_calendar' id='dyn_search_dt_autorizacao_v2__dia_val_" . $ind . "' name='val_dyn_search_dt_autorizacao_v2__dia_" . $ind . "' placeholder=\"" . $Place_holder['dd'] . "\" value=\"" . NM_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "     <input type=\"hidden\" id=\"sc_dt_autorizacao_v2__jq_" . $ind . "\">";
       $lin_obj .= "       </span>";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' style='cursor:pointer' id='dyn_search_dt_autorizacao_close_" . $ind . "' class='dyn_search_close' title='". $this->Ini->Nm_lang['lang_usr_lang_del'] ."' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_dt_autorizacao_" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_dt_autorizacao_" . $ind . "'  id='dyn_search_enabled_dt_autorizacao_" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne" || substr($opc, 0, 3) == "bi_") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_motivo_desconto_id($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "eq";
       }
       if ($opc == 'bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_motivo_desconto_id_" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "       <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_label']['motivo_desconto_id'] . " ";
       $lin_obj .= "       </div>";
       $lin_obj .= "      </div >";
       $lin_obj .= "      <div class='fixed_width_conditions '>";
       $lin_obj .= "       <select id='dyn_search_motivo_desconto_id_cond_" . $ind . "' name='cond_dyn_search_motivo_desconto_id_" . $ind . "' class=' " . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='vertical-align: middle; display: none'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input  fixed_width_input100'>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_check_ret']['motivo_desconto_id'] = array();
       $motivo_desconto_id_look = (is_string($motivo_desconto_id) ? substr($this->Db->qstr($motivo_desconto_id), 1, -1) : $motivo_desconto_id); 
       $nmgp_def_dados  = ""; 
       $nm_comando = "SELECT motivo_desconto_id, descricao  FROM PUB.motivos_desconto  ORDER BY descricao"; 
       if ($this->NM_case_insensitive)
       {
           if (isset($this->Ini->nm_bases_access) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
           {
               $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
           }
           else
           {
               $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
           }
           $nm_comando = str_replace("#lowerF#", ")", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "", $nm_comando);
           $nm_comando = str_replace("#lowerF#", "", $nm_comando);
       }
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
       { 
          while (!$rs->EOF) 
          { 
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['psq_check_ret']['motivo_desconto_id'][] = trim($rs->fields[0]);
             $nmgp_def_dados .= trim($rs->fields[1]) . "?#?"; 
             $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?"; 
             $rs->MoveNext(); 
          } 
          $rs->Close(); 
       } 
       else  
       {  
           if  ($ajax == 'N')
           {  
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit; 
           } 
           else
           {  
              echo $this->Db->ErrorMsg(); 
           } 
       } 
       $lin_obj .= "   <table style=\"padding: 0px; spacing: 0px; border-width: 0px;\"><tr><td>";
       $lin_obj .= "    <input id='dyn_search_motivo_desconto_id_val_" . $ind . "' name='val_dyn_search_motivo_desconto_id_" . $ind . "' type='hidden' value=''>";
       $lin_obj .= "    <SELECT class='" . $this->css_scAppDivToolbarInput . " css_toolbar_obj' style='height : auto;' id=\"dyn_search_motivo_desconto_id_val_" . $ind . "_orig\" name=\"val_dyn_search_motivo_desconto_id_" . $ind . "_orig\" size=7 multiple onDblClick=\"nm_add_sel_Dyn(event, 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'N');\">";
       $delimitador = "##@@";
       $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
       $nm_opcoes  = explode("?@?", $nm_opcoesx);
       $val = isset($val[0]) ? $val[0] : array();
       foreach ($nm_opcoes as $nm_opcao)
       {
          if (!empty($nm_opcao))
          {
             $temp_bug_list = explode("?#?", $nm_opcao);
             list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
             if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
             if (is_array($val) && !empty($val))
             {
                $motivo_desconto_id_sel = "";
                foreach ($val as $Dados)
                {
                    $tmp_pos = (is_string($Dados)) ? strpos($Dados, "##@@") : false;
                    if ($tmp_pos !== false)
                    {
                        $Dados = substr($Dados, 0, $tmp_pos);
                    }
                    if ($Dados === $nm_opc_cod)
                    {
                        $motivo_desconto_id_sel = " disabled =\"disabled\" style=\"color: #A0A0A0\"";
                        break;
                    }
                }
             }
             else
             {
                $motivo_desconto_id_sel = ("S" == $nm_opc_sel) ? " selected" : "";
             }
             $lin_obj .= "       <OPTION value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\"" . $motivo_desconto_id_sel . ">" . $nm_opc_val . "</OPTION>";
          }
       }
       $lin_obj .= "    </SELECT>";
       $lin_obj .= "   </td>";
       $lin_obj .= "   <td align=\"center\">";
       $lin_obj .= "   <div class='scBtnPassField'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all_Dyn('dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'N');", "nm_add_all_Dyn('dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'N');", "Bbpassfld_rightall", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

       $lin_obj .= "   </div>";
       $lin_obj .= "   <div class='scBtnPassField'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel_Dyn('Click', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'N');", "nm_add_sel_Dyn('Click', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'N');", "Bbpassfld_righ", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

       $lin_obj .= "   </div>";
       $lin_obj .= "   <div class='scBtnPassField'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel_Dyn('Click', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'N');", "nm_del_sel_Dyn('Click', 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'N');", "Bbpassfld_left", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

       $lin_obj .= "   </div>";
       $lin_obj .= "   <div class='scBtnPassField'>";
       $lin_obj .= nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all_Dyn('dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'N');", "nm_del_all_Dyn('dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'N');", "Bbpassfld_leftall", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

       $lin_obj .= "   </div>";
       $lin_obj .= "   </td>";
       $lin_obj .= "   <td>";
       $lin_obj .= "    <SELECT class='" . $this->css_scAppDivToolbarInput . "' style='height : auto;' id=\"dyn_search_motivo_desconto_id_val_" . $ind . "_dest\" name=\"val_dyn_search_motivo_desconto_id_" . $ind . "_dest\" size=7 multiple onDblClick=\"nm_del_sel_Dyn(event, 'dyn_search_motivo_desconto_id_val_" . $ind . "_dest', 'dyn_search_motivo_desconto_id_val_" . $ind . "_orig', 'N');\" onChange=\"buttonEnable_dyn('dyn_search'); buttonDisable_dyn('Save_frm_dyn'); buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
       $nm_opcoes  = explode("?@?", $nm_opcoesx);
       foreach ($nm_opcoes as $nm_opcao)
       {
          if (!empty($nm_opcao))
          {
             $temp_bug_list = explode("?#?", $nm_opcao);
             list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
             if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
             if (is_array($val) && !empty($val))
             {
                foreach ($val as $Dados)
                {
                    $tmp_pos = (is_string($Dados)) ? strpos($Dados, "##@@") : false;
                    if ($tmp_pos !== false)
                    {
                        $Dados = substr($Dados, 0, $tmp_pos);
                    }
                    if ($Dados === $nm_opc_cod)
                    {
                        $lin_obj .= "       <OPTION value=\"" . $nm_opc_cod . $delimitador . $nm_opc_val . "\">" . $nm_opc_val . "</OPTION>";
                    }
                }
             }
          }
       }
       $lin_obj .= "    </select>";
       $lin_obj .= "   </td></tr></table>";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' style='cursor:pointer' id='dyn_search_motivo_desconto_id_close_" . $ind . "' class='dyn_search_close' title='". $this->Ini->Nm_lang['lang_usr_lang_del'] ."' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_motivo_desconto_id_" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');buttonDisable_dyn('Save_frm_dyn');buttonDisable_dyn('SC_nmgp_save_name_dyn');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_motivo_desconto_id_" . $ind . "'  id='dyn_search_enabled_motivo_desconto_id_" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function formata_bi_dt_autorizacao($opc, &$bi_dt1, &$bi_dt2, $opc_bi)
   {
       $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
       $Str_date = str_replace("y", "Y", $Str_date);
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
       $date_format_show = "";
       foreach ($Arr_D as $Cada_d)
       {
           $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
           $date_format_show .= ($Cada_d == "d") ? substr($bi_dt1, 0, 2) : "";
           $date_format_show .= ($Cada_d == "m") ? substr($bi_dt1, 2, 2) : "";
           $date_format_show .= ($Cada_d == "Y") ? substr($bi_dt1, 4, 4) : "";
           $Prim = false;
       }
       $bi_dt1 = $date_format_show;
       $date_format_show = "";
       if ($opc_bi == "bw")
       {
           $Prim = true;
           $date_format_show = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
           foreach ($Arr_D as $Cada_d)
           {
               $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
               $date_format_show .= ($Cada_d == "d") ? substr($bi_dt2, 0, 2): "";
               $date_format_show .= ($Cada_d == "m") ? substr($bi_dt2, 2, 2) : "";
               $date_format_show .= ($Cada_d == "Y") ? substr($bi_dt2, 4, 4) : "";
               $Prim = false;
           }
       }
       $bi_dt2 = $date_format_show;
   }
   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function dynamicSearchStartHtmlRec($arr_arvore, $str_id)
   {
       global $nm_saida, $contUl;
       $str_filhos = '';
       if(isset($arr_arvore['fields']) && !empty($arr_arvore['fields']))
       {
           foreach($arr_arvore['fields'] as $chield)
           {
               $str_filhos .= "<li class='df-item' role='treeitem'>";
               if($chield['type'] == 'ul')
               {
                   $contUl++;
                   $str_filhos .= $this->dynamicSearchStartHtmlRec($chield, $str_id . $contUl);
               }
               else
               {
                   $bol_found = false;
                   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['old'] as $_tmp)
                   {
                       if($chield['field'] == 'dyn_search_'. $_tmp['cmp'] .'_' . $_tmp['seq'])
                       {
                           $def = $_tmp;
                           $bol_found = true;
                           break;
                       }
                   }
                   if(!$bol_found)
                   {
                       $def['opc'] = $chield['opc'];
                       $def['val'] = array(array());
                       $def['Res_chk'] = '';
                   }
                   if ($chield['name'] == "log_credito")
                   {
                       $this->Dyn_search_seq++;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "log_credito";
                       $str_filhos .= $this->dynamic_search_log_credito($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($chield['name'] == "fornecedor_id")
                   {
                       $this->Dyn_search_seq++;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "fornecedor_id";
                       $str_filhos .= $this->dynamic_search_fornecedor_id($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($chield['name'] == "dt_autorizacao")
                   {
                       $this->Dyn_search_seq++;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "dt_autorizacao";
                       $str_filhos .= $this->dynamic_search_dt_autorizacao($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($chield['name'] == "motivo_desconto_id")
                   {
                       $this->Dyn_search_seq++;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "motivo_desconto_id";
                       $str_filhos .= $this->dynamic_search_motivo_desconto_id($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
               }
               $str_filhos .= '</li>';
           }
       }
       $conditionAnd = (!isset($arr_arvore['condition']) || $arr_arvore['condition'] != 'OR')?'true':'false';
       $conditionOr = (isset($arr_arvore['condition']) && $arr_arvore['condition'] == 'OR')?'true':'false';
          $Cod_Btn_grp_ini = nmButtonGroupOutput($this->arr_buttons, "bdyn_and", 'ini');
       $Cod_Btn_and = nmButtonOutput($this->arr_buttons, "bdyn_and", "", "", "bdyn_and", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "data-role=togglebutton aria-value='AND' aria-pressed=" . $conditionAnd . "");
       $Cod_Btn_or = nmButtonOutput($this->arr_buttons, "bdyn_or", "", "", "bdyn_or", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "data-role=togglebutton aria-value='OR' aria-pressed=" . $conditionOr . "");
          $Cod_Btn_grp_end = nmButtonGroupOutput($this->arr_buttons, "bdyn_and_or", 'fim');
       $Cod_Btn = nmButtonOutput($this->arr_buttons, "bdyn_addfields_nested", "nm_show_dynamicsearch_fields_2(this); return false;", "nm_show_dynamicsearch_fields_2(this); return false;", "bdyn_addfields_nested", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
       $Cod_Btn_nested_add = nmButtonOutput($this->arr_buttons, "bdyn_nested_add", "addGroup(this);", "addGroup(this);", "bdyn_nested_add", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $enabled = 'S';
           $Cod_Btn_enable = '';
           $Cod_Btn_disable = '';
           $_str_js = '';
       $Cod_Btn_nested_remove = nmButtonOutput($this->arr_buttons, "bdyn_nested_remove", "clearDynamicFilter(this);", "clearDynamicFilter(this);", "bdyn_nested_remove", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
             $phpCode = '
       <div class="group">
            <div class="df-toolbar" role="toolbar" id="' . $str_id . '">
                <i class="fa-solid fa-grip-lines-vertical drag_handle"></i>
                <input type="hidden" class="dyn_nested_enabled" value="' . $enabled . '" />
                <span class="df-button-group" style="position:relative;" role="group" title="'. $this->Ini->Nm_lang['lang_othr_dynamicsearch_condition'] .'">
                    ' . $Cod_Btn_grp_ini . '
                        ' . $Cod_Btn_and . '
                        ' . $Cod_Btn_or . '
                    ' . $Cod_Btn_grp_end . '
                </span>
                ' . $Cod_Btn . '
                ' . $Cod_Btn_nested_add . '
                ' . $Cod_Btn_enable . '
                ' . $Cod_Btn_disable . '
                ' . $Cod_Btn_nested_remove . '
            </div>
            <script>$( document ).ready(function() { $("#' . $str_id . ' [aria-pressed=true]").addClass("selected"); '. $_str_js .' });</script>
            <ul class="df-lines" data-role="maincontent" role="group" id="ul_' . $str_id . '">' . $str_filhos . '</ul>
       </div>
';
      return $phpCode;
   }
   function dynamicSearchStartHtml()
   {
       global $nm_saida, $contUl;
       $nm_saida->saida("      <script>\r\n");
       $nm_saida->saida("    //==============================================\r\n");
       $nm_saida->saida("// Funções\r\n");
       $nm_saida->saida("//==============================================\r\n");
       $nm_saida->saida("function dynamicFilterToggleButton() {\r\n");
       $nm_saida->saida("    const dynamicFilterToggleButtons = document.querySelectorAll('[data-role=togglebutton]');\r\n");
       $nm_saida->saida("    dynamicFilterToggleButtons.forEach(button => {\r\n");
       $nm_saida->saida("        button.addEventListener('click', () => {\r\n");
       $nm_saida->saida("            const nextSibling = button.nextElementSibling;\r\n");
       $nm_saida->saida("            const previousSibling = button.previousElementSibling;\r\n");
       $nm_saida->saida("            if (nextSibling) {\r\n");
       $nm_saida->saida("                button.setAttribute('aria-pressed', 'true');\r\n");
       $nm_saida->saida("                button.classList.add('selected');\r\n");
       $nm_saida->saida("                nextSibling.setAttribute('aria-pressed', 'false');\r\n");
       $nm_saida->saida("                nextSibling.classList.remove('selected');\r\n");
       $nm_saida->saida("            } else {\r\n");
       $nm_saida->saida("                button.setAttribute('aria-pressed', 'true');\r\n");
       $nm_saida->saida("                button.classList.add('selected');\r\n");
       $nm_saida->saida("                previousSibling.setAttribute('aria-pressed', 'false');\r\n");
       $nm_saida->saida("                previousSibling.classList.remove('selected');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            if (typeof buttonEnable_dyn !== 'undefined' && typeof buttonEnable_dyn === 'function')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                buttonEnable_dyn('dyn_search');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            if ($('#id_dyn_descr_fly').length > 0 && typeof nm_proc_dyn_search !== 'undefined' && typeof nm_proc_dyn_search === 'function')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                nm_proc_dyn_search('id_Fdyn_search', 'dyn_search_descr');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            event.preventDefault();\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function changeFilterConditions() {\r\n");
       $nm_saida->saida("    const filtersConditions = document.querySelectorAll('[data-role=\"filter-conditions\"]');\r\n");
       $nm_saida->saida("    filtersConditions.forEach(filter => {\r\n");
       $nm_saida->saida("        filter.addEventListener('change', () => {\r\n");
       $nm_saida->saida("            const filterValue = filter.value;\r\n");
       $nm_saida->saida("            switch (filterValue) {\r\n");
       $nm_saida->saida("                case 'is equal to':\r\n");
       $nm_saida->saida("                case 'is not equal to':\r\n");
       $nm_saida->saida("                case 'is greater than or equal to':\r\n");
       $nm_saida->saida("                case 'is greater than':\r\n");
       $nm_saida->saida("                case 'is less than or equal to':\r\n");
       $nm_saida->saida("                case 'is less than':\r\n");
       $nm_saida->saida("                case 'starts with':\r\n");
       $nm_saida->saida("                case 'contains':\r\n");
       $nm_saida->saida("                case 'does not contain':\r\n");
       $nm_saida->saida("                case 'ends with':\r\n");
       $nm_saida->saida("                    filter.nextElementSibling.style.display = 'block';\r\n");
       $nm_saida->saida("                    break;\r\n");
       $nm_saida->saida("                default:\r\n");
       $nm_saida->saida("                    filter.nextElementSibling.style.display = 'none';\r\n");
       $nm_saida->saida("                    break;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function clearDynamicFilter(objFilter) {\r\n");
       $nm_saida->saida("    nm_dynamicsearch_backup();\r\n");
       $nm_saida->saida("    $('#ul_' + $(objFilter).parent().prop('id')).find('.dyn_search_field_close').each(function( index ) {\r\n");
       $nm_saida->saida("        $( this ).click();\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("    $('#ul_' + $(objFilter).parent().prop('id')).find('.dyn_search_close').each(function( index ) {\r\n");
       $nm_saida->saida("        $( this ).click();\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("    $(objFilter).parent().parent().parent().hide();\r\n");
       $nm_saida->saida("    event.preventDefault();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("var dynamicFilterCount =0;\r\n");
       $nm_saida->saida("function addGroup(objFilter) {\r\n");
       $nm_saida->saida("    if($(objFilter).parent().find('.dyn_nested_enabled').length >0 && $(objFilter).parent().find('.dyn_nested_enabled').val() == 'N') return;\r\n");
       $nm_saida->saida("    nm_dynamicsearch_backup();\r\n");
       $nm_saida->saida("    dynamicFilterCount++;\r\n");
       $nm_saida->saida("    strId = $(objFilter).parent().prop('id');\r\n");
       $nm_saida->saida("    cloneLine = $('#' + strId).clone( true ).prop('id', strId + dynamicFilterCount );\r\n");
       $nm_saida->saida("    cloneUl = $('#ul_' + strId).clone( true ).prop('id', 'ul_' + strId + dynamicFilterCount );\r\n");
       $nm_saida->saida("    cloneUl.empty();\r\n");
       $nm_saida->saida("    sub_li = $('<div class=\"group\" />').append(cloneLine).append(cloneUl);\r\n");
       $nm_saida->saida("    sub_li = $('<li class=df-item role=treeitem />').append(sub_li);\r\n");
       $nm_saida->saida("    $('#ul_' + strId).append(sub_li);\r\n");
       $nm_saida->saida("    dynamicFilterToggleButton();\r\n");
       $nm_saida->saida("    if (typeof ajusta_window_dynamic_search !== 'undefined' && typeof ajusta_window_dynamic_search === 'function')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        ajusta_window_dynamic_search();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    event.preventDefault();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function addExpression(templateId, Expression) {\r\n");
       $nm_saida->saida("    $('#ul_' + templateId).append(\"<li class='df-item' role='treeitem'>\" + Expression + \"</li>\");\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function addSubgroup(template_id) {\r\n");
       $nm_saida->saida("    const template = document.getElementById(template_id);\r\n");
       $nm_saida->saida("    const clone = template.content.cloneNode(true);\r\n");
       $nm_saida->saida("    const li = document.createElement('li');\r\n");
       $nm_saida->saida("    li.classList.add('df-item');\r\n");
       $nm_saida->saida("    li.setAttribute('role', 'treeitem');\r\n");
       $nm_saida->saida("    li.appendChild(clone);\r\n");
       $nm_saida->saida("    const ul = document.createElement('ul');\r\n");
       $nm_saida->saida("    ul.classList.add('df-lines');\r\n");
       $nm_saida->saida("    ul.setAttribute('data-role', 'subcontent');\r\n");
       $nm_saida->saida("    ul.setAttribute('role', 'group');\r\n");
       $nm_saida->saida("    ul.appendChild(li);\r\n");
       $nm_saida->saida("    event.target.offsetParent.parentElement.appendChild(ul);\r\n");
       $nm_saida->saida("    dynamicFilterToggleButton();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function addSubexpression(template_id) {\r\n");
       $nm_saida->saida("    const template = document.getElementById(template_id);\r\n");
       $nm_saida->saida("    const clone = template.content.cloneNode(true);\r\n");
       $nm_saida->saida("    const li = document.createElement('li');\r\n");
       $nm_saida->saida("    li.classList.add('df-item');\r\n");
       $nm_saida->saida("    li.setAttribute('role', 'treeitem');\r\n");
       $nm_saida->saida("    li.appendChild(clone);\r\n");
       $nm_saida->saida("    const createList = () => {\r\n");
       $nm_saida->saida("        const ul = document.createElement('ul');\r\n");
       $nm_saida->saida("        ul.classList.add('df-lines');\r\n");
       $nm_saida->saida("        ul.setAttribute('data-role', 'subcontent');\r\n");
       $nm_saida->saida("        ul.setAttribute('role', 'group');\r\n");
       $nm_saida->saida("        ul.appendChild(li);\r\n");
       $nm_saida->saida("        event.target.offsetParent.parentElement.appendChild(ul);\r\n");
       $nm_saida->saida("    };\r\n");
       $nm_saida->saida("    if (\r\n");
       $nm_saida->saida("        event.target.offsetParent.parentElement.parentElement.getAttribute('data-role') === 'maincontent' && event.target.offsetParent.nextElementSibling === null ||\r\n");
       $nm_saida->saida("        event.target.offsetParent.parentElement.parentElement.getAttribute('data-role') === 'subcontent' && event.target.offsetParent.nextElementSibling === null\r\n");
       $nm_saida->saida("    ) {\r\n");
       $nm_saida->saida("        createList();\r\n");
       $nm_saida->saida("    } else {\r\n");
       $nm_saida->saida("        event.target.offsetParent.nextElementSibling.appendChild(li);\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    //changeFilterConditions();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function init() {\r\n");
       $nm_saida->saida("    const mainContent = document.querySelector('.df-lines[data-role=\"maincontent\"]');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function get_json_dyn_search_and_or(Tab_obj_dyn_search)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    json_dyn_search = {};\r\n");
       $nm_saida->saida("    if($('#dynamicSearchStart').length > 0)\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        json_dyn_search = get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, { condition: '', type: 'ul',  enabled: 'S', fields: [] }, 'dynamicSearchStart');\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    else\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        json_dyn_search = get_json_dyn_search_and_or_old();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    return JSON.stringify(json_dyn_search);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function get_json_dyn_search_and_or_horizontal(Tab_obj_dyn_search)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    json_dyn_search_horizontal = [];\r\n");
       $nm_saida->saida("    get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, { condition: '', type: 'ul',  enabled: 'S', fields: [] }, 'dynamicSearchStart');\r\n");
       $nm_saida->saida("    return json_dyn_search_horizontal;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("var json_dyn_search_horizontal = [];\r\n");
       $nm_saida->saida("function get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, json_dyn_search_and_or, str_id)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    if($( \"#ul_\"+ str_id).parent().css('display')!='none')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        json_dyn_search_and_or.condition = $('#' + str_id + ' [aria-pressed=true]').attr('aria-value');\r\n");
       $nm_saida->saida("        json_dyn_search_and_or.enabled = 'S';\r\n");
       $nm_saida->saida("        if($('#' + str_id + ' .dyn_nested_enabled').length>0)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            json_dyn_search_and_or.enabled = $('#' + str_id + ' .dyn_nested_enabled').val();\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        $(\"#ul_\" + str_id + \" > li > div\").each(function (index, element) {\r\n");
       $nm_saida->saida("            if ($(this).parent().css('display') != 'none') {\r\n");
       $nm_saida->saida("                if ($(this).hasClass('group')) {\r\n");
       $nm_saida->saida("                    jsonNode = get_json_dyn_search_and_or_rec(Tab_obj_dyn_search,  {\r\n");
       $nm_saida->saida("                        condition: '',\r\n");
       $nm_saida->saida("                        type: 'ul',\r\n");
       $nm_saida->saida("                        enabled: 'S',\r\n");
       $nm_saida->saida("                        fields: []\r\n");
       $nm_saida->saida("                    }, $(this).find('.df-toolbar').prop('id'));\r\n");
       $nm_saida->saida("                    if (jsonNode.fields.length > 0) {\r\n");
       $nm_saida->saida("                        json_dyn_search_and_or.fields.push(jsonNode);\r\n");
       $nm_saida->saida("                    }\r\n");
       $nm_saida->saida("                } else {\r\n");
       $nm_saida->saida("                    str_enabled = 'S';\r\n");
       $nm_saida->saida("                    if($(this).find('.dyn_search_enabled').val() == 'N')\r\n");
       $nm_saida->saida("                    {\r\n");
       $nm_saida->saida("                        str_enabled = 'N';\r\n");
       $nm_saida->saida("                    }\r\n");
       $nm_saida->saida("                    json_dyn_search_horizontal.push($(this).find('.fixed_width_select select').attr('seq'));\r\n");
       $nm_saida->saida("                    json_dyn_search_and_or.fields.push({type: 'field', field: $(this).prop('id'), name: $(this).find('.fixed_width_select select').val(), opc: $(this).find('.fixed_width_conditions select').val(), enabled: str_enabled});\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    return json_dyn_search_and_or;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function get_json_dyn_search_and_or_old()\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    json_dyn_search_and_or = { condition: 'and', type: 'ul', fields: [] };\r\n");
       $nm_saida->saida("    $( \"#table_dyn_search > div\" ).each(function( index, element ) {\r\n");
       $nm_saida->saida("        if($(this).css('display') != 'none')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            json_dyn_search_and_or.fields.push( { type: 'field', field: $(this).prop('id') } );\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("    return json_dyn_search_and_or;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function disableNested(obj)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    if($(obj).parent().prop('id') == 'dynamicSearchStart')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $('#bdyn_sc_enabled').hide();\r\n");
       $nm_saida->saida("        $('#bdyn_sc_disabled').show();\r\n");
       $nm_saida->saida("		\r\n");
       $nm_saida->saida("		$('#id_dyn_search_cmd_str').html(mens_select2_disabled);\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    $('#ul_' + $(obj).parent().prop('id') + ' > li > div').each(function( index ) {\r\n");
       $nm_saida->saida("        if($(this).hasClass('group'))\r\n");
       $nm_saida->saida("		{\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').addClass('disabled');\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').attr('disabled', 'disabled');\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').prop('disabled', true);\r\n");
       $nm_saida->saida("			\r\n");
       $nm_saida->saida("			if($(this).find('.df-toolbar .dyn_nested_enabled').val()=='S')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				disableNested($(this).find('.df-toolbar .bdyn_nested_enabled'));\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		}\r\n");
       $nm_saida->saida("		else\r\n");
       $nm_saida->saida("		{\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').addClass('disabled');\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').attr('disabled', 'disabled');\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').prop('disabled', true);\r\n");
       $nm_saida->saida("			\r\n");
       $nm_saida->saida("			if($(this).find('.fixed_width_toolbar .dyn_search_enabled').val()=='S')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				disableFieldLine($(this).find('.fixed_width_toolbar .bdyn_field_enabled'));\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		}\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function enableNested(obj)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    if($(obj).parent().prop('id') == 'dynamicSearchStart')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $('#bdyn_sc_enabled').show();\r\n");
       $nm_saida->saida("        $('#bdyn_sc_disabled').hide();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    $('#ul_' + $(obj).parent().prop('id') + ' > li > div').each(function( index ) {\r\n");
       $nm_saida->saida("        if($(this).hasClass('group'))\r\n");
       $nm_saida->saida("		{\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').removeClass('disabled');\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').prop('disabled', false);\r\n");
       $nm_saida->saida("			$(this).find('.df-toolbar a').removeAttr('disabled');\r\n");
       $nm_saida->saida("			\r\n");
       $nm_saida->saida("			if($(this).find('.df-toolbar .dyn_nested_enabled').val()=='S')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				enableNested($(this).find('.df-toolbar .bdyn_nested_enabled'));\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		}\r\n");
       $nm_saida->saida("		else\r\n");
       $nm_saida->saida("		{\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').removeClass('disabled');\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').prop('disabled', false);\r\n");
       $nm_saida->saida("			$(this).find('.fixed_width_toolbar a').removeAttr('disabled');\r\n");
       $nm_saida->saida("			\r\n");
       $nm_saida->saida("			if($(this).find('.fixed_width_toolbar .dyn_search_enabled').val()=='S')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				enableFieldLine($(this).find('.fixed_width_toolbar .bdyn_field_enabled'));\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		}\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function disableFieldLine(obj)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("	{\r\n");
       $nm_saida->saida("		$(obj).parent().parent().addClass('disabled');\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.fixed_width_select, .fixed_width_conditions, .fixed_width_input').find('.df-toolbar, select, input, img, div, span').each(function( index ) {\r\n");
       $nm_saida->saida("			if($( this ).attr(\"sc-disabled\") != 'true')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				$( this ).attr('sc-disabled', 'true');\r\n");
       $nm_saida->saida("				$( this ).attr('disabled', 'disabled');\r\n");
       $nm_saida->saida("				$( this ).prop('disabled', true);\r\n");
       $nm_saida->saida("				$( this ).addClass('disabled');\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.ui-slider').each(function( index ) {\r\n");
       $nm_saida->saida("			$('#' + $(obj).parent().parent().prop('id').replace('dyn_search_', 'id_dyn_slider_')).slider({ disabled: true });\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.hasDatepicker').each(function( index ) {\r\n");
       $nm_saida->saida("			$(this).datepicker( \"option\", \"disabled\", true );\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("	}\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function enableFieldLine(obj)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("	{\r\n");
       $nm_saida->saida("		$(obj).parent().parent().removeClass('disabled');\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.fixed_width_select, .fixed_width_conditions, .fixed_width_input').find('select, input, img, div, span').each(function( index ) {\r\n");
       $nm_saida->saida("			if($( this ).attr(\"sc-disabled\") == 'true')\r\n");
       $nm_saida->saida("			{\r\n");
       $nm_saida->saida("				$( this ).attr('sc-disabled', '');\r\n");
       $nm_saida->saida("				$( this ).attr('disabled', '');\r\n");
       $nm_saida->saida("				$( this ).prop('disabled', false);\r\n");
       $nm_saida->saida("				$( this ).removeClass('disabled');\r\n");
       $nm_saida->saida("			}\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.ui-slider').each(function( index ) {\r\n");
       $nm_saida->saida("			$('#' + $(obj).parent().parent().prop('id').replace('dyn_search_', 'id_dyn_slider_')).slider({ disabled: false });\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("		$(obj).parent().parent().find('.hasDatepicker').each(function( index ) {\r\n");
       $nm_saida->saida("			$(this).datepicker( \"option\", \"disabled\", false );\r\n");
       $nm_saida->saida("		});\r\n");
       $nm_saida->saida("	}\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("//Destrói os sortables existentes\r\n");
       $nm_saida->saida("function destroyAllSortables() {\r\n");
       $nm_saida->saida("    $('*').each(function () {\r\n");
       $nm_saida->saida("        if ($(this).sortable(\"instance\")) {\r\n");
       $nm_saida->saida("            $(this).sortable(\"destroy\");\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("// Função para iniciar o drag and drop em elementos .df-item\r\n");
       $nm_saida->saida("function dfSortable() {\r\n");
       $nm_saida->saida("    $(\".df-lines\").sortable({\r\n");
       $nm_saida->saida("        handle: \".drag_handle\", // Usa o drag_handle como ponto de arrasto\r\n");
       $nm_saida->saida("        connectWith: \".df-lines\", // Conecta todas as listas df-lines\r\n");
       $nm_saida->saida("        placeholder: \"ui-state-highlight\",\r\n");
       $nm_saida->saida("        items: \".df-item\", // Define quais elementos serão arrastados\r\n");
       $nm_saida->saida("        tolerance: \"intersect\", // O item precisa sobrepor metade do item alvo para que o placeholder seja reposicionado\r\n");
       $nm_saida->saida("        axis: \"y\", // Restringe o movimento ao eixo vertical\r\n");
       $nm_saida->saida("        distance: 10, // Distância mínima em pixels para iniciar o arraste\r\n");
       $nm_saida->saida("        start: function (event, ui) {\r\n");
       $nm_saida->saida("            ui.placeholder.height(ui.helper.outerHeight()); // Ajusta o tamanho do placeholder\r\n");
       $nm_saida->saida("        },\r\n");
       $nm_saida->saida("        stop: function (event, ui) {\r\n");
       $nm_saida->saida("            if ($('#id_dyn_descr_fly').length > 0 && typeof nm_proc_dyn_search !== 'undefined' && typeof nm_proc_dyn_search === 'function')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("				buttonEnable_dyn('dyn_search');\r\n");
       $nm_saida->saida("                nm_proc_dyn_search('id_Fdyn_search', 'dyn_search_descr');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("    }).disableSelection();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function handleNewElement(mutationsList) {\r\n");
       $nm_saida->saida("    for (const mutation of mutationsList) {\r\n");
       $nm_saida->saida("        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {\r\n");
       $nm_saida->saida("            mutation.addedNodes.forEach(node => {\r\n");
       $nm_saida->saida("                if (node.nodeType === Node.ELEMENT_NODE) {\r\n");
       $nm_saida->saida("                    if (node.classList.contains('df-toolbar') || node.classList.contains('df-item')) {\r\n");
       $nm_saida->saida("                        reStartDragNDrop();\r\n");
       $nm_saida->saida("                    }\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            });\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function reStartDragNDrop()\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    destroyAllSortables();\r\n");
       $nm_saida->saida("    dfSortable();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function startDragNDrop()\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    // Configura o observer para monitorar mudanças no DOM\r\n");
       $nm_saida->saida("    const observer = new MutationObserver(handleNewElement);\r\n");
       $nm_saida->saida("    // Define a área de observação (body neste caso) e o tipo de mudanças que o observer deve observar\r\n");
       $nm_saida->saida("    observer.observe(document.body, {\r\n");
       $nm_saida->saida("        childList: true, // Observa adição e remoção de elementos filhos\r\n");
       $nm_saida->saida("        subtree: true // Observa também as mudanças nos elementos filhos do body\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("    dfSortable();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("//==============================================\r\n");
       $nm_saida->saida("// Init\r\n");
       $nm_saida->saida("//==============================================\r\n");
       $nm_saida->saida("window.addEventListener('DOMContentLoaded', () => {\r\n");
       $nm_saida->saida("    init();\r\n");
       $nm_saida->saida("    dynamicFilterToggleButton();\r\n");
       $nm_saida->saida("    startDragNDrop();\r\n");
       $nm_saida->saida("});\r\n");
       $nm_saida->saida("    $( document ).ready(function() {\r\n");
       $nm_saida->saida("        dynamicFilterToggleButton();\r\n");
       $nm_saida->saida("    });\r\n");
       $nm_saida->saida("</script>\r\n");
       $nm_saida->saida("<style>\r\n");
       $nm_saida->saida("    .df-container ul {\r\n");
       $nm_saida->saida("    margin: 0;\r\n");
       $nm_saida->saida("    padding: 0;\r\n");
       $nm_saida->saida("    list-style: none;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-toolbar {\r\n");
       $nm_saida->saida("    position: relative;\r\n");
       $nm_saida->saida("    width: fit-content;\r\n");
       $nm_saida->saida("    padding: 8px;\r\n");
       $nm_saida->saida("    flex-flow: row nowrap;\r\n");
       $nm_saida->saida("    justify-content: start;\r\n");
       $nm_saida->saida("    align-items: center;\r\n");
       $nm_saida->saida("    column-gap: .5rem;\r\n");
       $nm_saida->saida("    display: flex;\r\n");
       $nm_saida->saida("	z-index: 100;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-lines\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    list-style-type: none;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("/*==========================\r\n");
       $nm_saida->saida(" Workaround linhas guias\r\n");
       $nm_saida->saida("==========================*/\r\n");
       $nm_saida->saida("ul > li.df-item {\r\n");
       $nm_saida->saida("    position: relative;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul > li.df-item::before,\r\n");
       $nm_saida->saida("ul > li.df-item::after {\r\n");
       $nm_saida->saida("    content: '';\r\n");
       $nm_saida->saida("    position: absolute;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul > li.df-item::before {\r\n");
       $nm_saida->saida("    top: 30px;\r\n");
       $nm_saida->saida("    width: 8px;\r\n");
       $nm_saida->saida("    height: 0;\r\n");
       $nm_saida->saida("    border-top: 1px solid rgba(0, 0, 0, 0.08);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-item > div\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    margin: 8px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul > li.df-item:last-child::after {\r\n");
       $nm_saida->saida("    height: 40px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul > li.df-item::after {\r\n");
       $nm_saida->saida("    top: -23px;\r\n");
       $nm_saida->saida("    width: 0px;\r\n");
       $nm_saida->saida("    height: 100%;\r\n");
       $nm_saida->saida("    border-left: 1px solid rgba(0, 0, 0, 0.08);\r\n");
       $nm_saida->saida("    z-index: 2;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul > li.df-item::before, ul > li.df-item::after {\r\n");
       $nm_saida->saida("    content: '';\r\n");
       $nm_saida->saida("    position: absolute;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("ul.df-lines {\r\n");
       $nm_saida->saida("    padding-left: 15px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-ghost-button {\r\n");
       $nm_saida->saida("    border: 1px solid transparent;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-button-rounded {\r\n");
       $nm_saida->saida("    border-radius: 4px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-button-group {\r\n");
       $nm_saida->saida("    flex-flow: row nowrap;\r\n");
       $nm_saida->saida("    justify-content: center;\r\n");
       $nm_saida->saida("    align-items: center;\r\n");
       $nm_saida->saida("    column-gap: 0;\r\n");
       $nm_saida->saida("    display: flex;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-button-group > .df-button:first-child {\r\n");
       $nm_saida->saida("    border-radius: 4px 0 0 4px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-button-group > .df-button:last-child {\r\n");
       $nm_saida->saida("    border-left: none;\r\n");
       $nm_saida->saida("    border-radius: 0 4px 4px 0;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#dynamicSearchStart > #bdyn_nested_remove{\r\n");
       $nm_saida->saida("    display: none !important;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#dynamicSearchStart > .drag_handle{\r\n");
       $nm_saida->saida("    display: none !important;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".df-button:not(.df-ghost-button) {\r\n");
       $nm_saida->saida("    border: 1px solid rgba(0, 0, 0, 0.08);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .width-constrain {\r\n");
       $nm_saida->saida("    width: 100px;\r\n");
       $nm_saida->saida("    max-width: 100px;\r\n");
       $nm_saida->saida("    overflow: hidden;\r\n");
       $nm_saida->saida("    overflow-wrap: break-word;\r\n");
       $nm_saida->saida("    white-space: normal;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_select {\r\n");
       $nm_saida->saida("    width: 15rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_conditions {\r\n");
       $nm_saida->saida("    width: 10rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_input {\r\n");
       $nm_saida->saida("    width: 20rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_conditions_dt_comp {\r\n");
       $nm_saida->saida("    display: none;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_input100 > input, #ul_dynamicSearchStart .fixed_width_input100 > select, #ul_dynamicSearchStart .fixed_width_input100 > span  > span > input, #ul_dynamicSearchStart .fixed_width_input100 > span > input, #ul_dynamicSearchStart .fixed_width_input100 .ui-autocomplete-input{\r\n");
       $nm_saida->saida("    width: 100% !important;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide, #ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > span {\r\n");
       $nm_saida->saida("    display: flex;\r\n");
       $nm_saida->saida("    column-gap: 0.5rem;\r\n");
       $nm_saida->saida("    align-items: center;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span {\r\n");
       $nm_saida->saida("    display: flex;\r\n");
       $nm_saida->saida("    column-gap: 0.5rem;\r\n");
       $nm_saida->saida("    align-items: center;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > input\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    width: auto !important;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart select, #dynamicSearchStart select, #table_dyn_search select\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    width: 100%;\r\n");
       $nm_saida->saida("    white-space: nowrap;\r\n");
       $nm_saida->saida("    overflow: hidden;\r\n");
       $nm_saida->saida("    text-overflow: ellipsis;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_select_date {\r\n");
       $nm_saida->saida("    width: 6.35rem !important;\r\n");
       $nm_saida->saida("    margin-right: 0.4rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_date {\r\n");
       $nm_saida->saida("    width: 3.03rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_year {\r\n");
       $nm_saida->saida("    width: 4rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .fixed_width_date_calendar {\r\n");
       $nm_saida->saida("    width: 2.8rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart .dyn_search_field_close {\r\n");
       $nm_saida->saida("    margin-top: 9px;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".drag_handle {\r\n");
       $nm_saida->saida("    font-size: 1rem;\r\n");
       $nm_saida->saida("    color: gray;\r\n");
       $nm_saida->saida("    cursor: move;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart a[disabled] {\r\n");
       $nm_saida->saida("    pointer-events: none;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".modal__container\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    padding: 0.5rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".modal #id_dynamic_search_content\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    max-height: 78vh;\r\n");
       $nm_saida->saida("    overflow-y: auto;\r\n");
       $nm_saida->saida("    display: block;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".modal__content\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    margin:0px\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".bdyn_shortcut\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    margin-left:auto;\r\n");
       $nm_saida->saida("    display:flex;\r\n");
       $nm_saida->saida("    align-items:center;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("div:not(.alignTop) div.fixed_input_slide > span {\r\n");
       $nm_saida->saida("    width: 20rem;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("div:not(.alignTop) div.fixed_input_slide > span > span, div:not(.alignTop) div.fixed_input_slide > span > span > span {\r\n");
       $nm_saida->saida("    margin: 0 !important;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > input.css_toolbar_obj, #ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > span > input.css_toolbar_obj {\r\n");
       $nm_saida->saida("    width: 100px !important;\r\n");
       $nm_saida->saida("    box-sizing: border-box;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida(".fixed_width_toolbar {\r\n");
       $nm_saida->saida("    width: 7.5rem;\r\n");
       $nm_saida->saida("    display: flex;\r\n");
       $nm_saida->saida("    gap: .4rem;\r\n");
       $nm_saida->saida("    align-items: center;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</style>\r\n");
       if(!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['new'] = array('condition' => 'AND', 'type'=>'ul', 'fields'=>'array()');
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['old'] = array();
       }
       $contUl = 0;
       $dynamicSearchStartHtmlRec = $this->dynamicSearchStartHtmlRec($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search_and_or']['new'], 'dynamicSearchStart');
       $nm_saida->saida("       $dynamicSearchStartHtmlRec \r\n");
       $nm_saida->saida("       <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("           dynamicFilterCount = $contUl;\r\n");
       $nm_saida->saida("       </script>\r\n");
   }
   function JS_dynamic_search()
   {
       global $nm_saida;
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("     var Tot_obj_dyn_search = " . $this->Dyn_search_seq . ";\r\n");
       $nm_saida->saida("     Tab_obj_dyn_search = new Array();\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search = new Array();\r\n");
       $nm_saida->saida("     Dyn_desc_orig = '';\r\n");
       $nm_saida->saida("       $( document ).ready(function() {\r\n");
       $nm_saida->saida("         startAllJSComponents(true);\r\n");
       $nm_saida->saida("       });\r\n");
       foreach ($this->Dyn_search_dat as $seq => $cmp)
       {
           $nm_saida->saida("     Tab_obj_dyn_search[" . $seq . "] = '" . $cmp . "';\r\n");
       }
       $nm_saida->saida(" function sc_grid_descontos_importacao_valida_mes(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 12))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_mnth'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" function sc_grid_descontos_importacao_valida_dia(obj)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("     if (obj.value != \"\" && (obj.value < 1 || obj.value > 31))\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (confirm (Nm_erro['lang_jscr_ivdt'] +  \" \" + Nm_erro['lang_jscr_iday'] +  \" \" + Nm_erro['lang_jscr_wfix']))\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['dt_autorizacao_mes'] =  'sc_grid_descontos_importacao_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['dt_autorizacao_dia'] =  'sc_grid_descontos_importacao_valida_dia(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['dt_autorizacao_v2__mes'] =  'sc_grid_descontos_importacao_valida_mes(this)';\r\n");
       $nm_saida->saida("     Tab_evt_dyn_search['dt_autorizacao_v2__dia'] =  'sc_grid_descontos_importacao_valida_dia(this)';\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_obj_dyn_search', 'value' => '');
           $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_evt_dyn_search', 'value' => '');
           $this->Ini->Arr_result['setVar'][] = array('var' => 'Tot_obj_dyn_search', 'value' => $this->Dyn_search_seq);
           foreach ($this->Dyn_search_dat as $seq => $cmp)
           {
               $this->Ini->Arr_result['setVar'][] = array('var' => 'Tab_obj_dyn_search[' . $seq . ']', 'value' => $cmp);
           }
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['dt_autorizacao_mes']", 'value' => 'sc_grid_descontos_importacao_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['dt_autorizacao_dia']", 'value' => 'sc_grid_descontos_importacao_valida_dia(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['dt_autorizacao_v2__mes']", 'value' => 'sc_grid_descontos_importacao_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['dt_autorizacao_v2__dia']", 'value' => 'sc_grid_descontos_importacao_valida_dia(this)');
           $this->Ini->Arr_result['exec_JS'][] = array('function' => 'startAllJSComponents', 'parm' => 'true');
       } 
       $nm_saida->saida("     function startAllJSComponents(bol_force)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(bol_force) Dyn_Ini = true;\r\n");
       $nm_saida->saida("         SC_carga_evt_jquery('all');\r\n");
       $nm_saida->saida("         if(bol_force) Cmp_select2_ok = false;\r\n");
       $nm_saida->saida("         SC_select2_dyn();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var Cmp_select2_ok = false;\r\n");
       $nm_saida->saida("     function SC_select2_dyn()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if (Cmp_select2_ok) {\r\n");
       $nm_saida->saida("             return;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         fieldsDisabled = new Array();\r\n");
       $nm_saida->saida("         Cmp_select2_ok = true;\r\n");
       $nm_saida->saida("         for(it=0; it<fieldsDisabled.length; it++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             disableFieldLine($(fieldsDisabled[it]).find('.fixed_width_toolbar').find('.bdyn_field_enabled'));\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function ajax_replace_dyn_search_js(obj, seq)\r\n");
       $nm_saida->saida("     {\r\n");
$nm_saida->saida("         nm_dynamicsearch_backup();\r\n");
$nm_saida->saida("         Tab_obj_dyn_search[seq] = obj.value;\r\n");
       $nm_saida->saida("         htmlNew = $('#id_dyn_search_template_' + obj.value).html();\r\n");
       $nm_saida->saida("         htmlNew = htmlNew.replace(/\\__NMSEQ__/g, seq);\r\n");
       $nm_saida->saida("         $( htmlNew ).insertBefore( '#' + $(obj).parent().parent().prop('id') );\r\n");
       $nm_saida->saida("         $('#' + $(obj).parent().parent().prop('id')).remove();\r\n");
       $nm_saida->saida("         SC_carga_evt_jquery(seq);\r\n");
       $nm_saida->saida("         Cmp_select2_ok = false;\r\n");
       $nm_saida->saida("         SC_select2_dyn();\r\n");
       $nm_saida->saida("         scLoadScInput('input:text.sc-js-input');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function ajax_add_dyn_search_js(campo)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_dynamicsearch_backup();\r\n");
       $nm_saida->saida("         Tot_obj_dyn_search++;\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search[Tot_obj_dyn_search] = campo;\r\n");
       $nm_saida->saida("         htmlNew = $('#id_dyn_search_template_' + campo).html();\r\n");
       $nm_saida->saida("         htmlNew = htmlNew.replace(/\\__NMSEQ__/g, Tot_obj_dyn_search);\r\n");
       $nm_saida->saida("         $('#table_dyn_search').append(htmlNew);\r\n");
       $nm_saida->saida("         nm_hide_dynamicsearch_fields('id_dynamic_search_fields', true);\r\n");
       $nm_saida->saida("         SC_carga_evt_jquery(Tot_obj_dyn_search);\r\n");
       $nm_saida->saida("         Cmp_select2_ok = false;\r\n");
       $nm_saida->saida("         SC_select2_dyn();\r\n");
       $nm_saida->saida("         scLoadScInput('input:text.sc-js-input');\r\n");
       $nm_saida->saida("         Dyn_Have_Clear = false;\r\n");
       $nm_saida->saida("         buttonEnable_dyn('dyn_search_clear');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function SC_carga_evt_jquery(tp_carga)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 x   = 0;\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 cps = new Array();\r\n");
       $nm_saida->saida("                 cps[x] = tmp;\r\n");
       $nm_saida->saida("                 if (tmp == 'dt_autorizacao')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cps[x] = 'dt_autorizacao_dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'dt_autorizacao_mes';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'dt_autorizacao_v2__dia';\r\n");
       $nm_saida->saida("                     x++;\r\n");
       $nm_saida->saida("                     cps[x] = 'dt_autorizacao_v2__mes';\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 for (x = 0; x < cps.length ; x++)\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     cmp = cps[x];\r\n");
       $nm_saida->saida("                     if (Tab_evt_dyn_search[cmp])\r\n");
       $nm_saida->saida("                     {\r\n");
       $nm_saida->saida("                         eval (\"$('#dyn_search_\" + cmp + \"_val_\" + i + \"').bind('change', function() {\" + Tab_evt_dyn_search[cmp] + \"})\");\r\n");
       $nm_saida->saida("                     }\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 if (tmp == 'dt_autorizacao')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     var i_calendar = i;\r\n");
       $nm_saida->saida("                     $('#sc_dt_autorizacao_jq_' + i).datepicker({\r\n");
       $nm_saida->saida("                        beforeShow: function(input, inst) {\r\n");
       $nm_saida->saida("                          var_dt_ini  = document.getElementById('dyn_search_dt_autorizacao_dia_val_' + i_calendar).value + '/';\r\n");
       $nm_saida->saida("                          var_dt_ini += document.getElementById('dyn_search_dt_autorizacao_mes_val_' + i_calendar).value + '/';\r\n");
       $nm_saida->saida("                          var_dt_ini += document.getElementById('dyn_search_dt_autorizacao_ano_val_' + i_calendar).value;\r\n");
       $nm_saida->saida("                          document.getElementById('sc_dt_autorizacao_jq_' + i_calendar).value = var_dt_ini;\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        onClose: function(dateText, inst) {\r\n");
       $nm_saida->saida("                          aParts  = dateText.split(\"/\");\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_dia_val_' + i_calendar).value = aParts[0];\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_mes_val_' + i_calendar).value = aParts[1];\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_ano_val_' + i_calendar).value = aParts[2];\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        showWeek: true,\r\n");
       $nm_saida->saida("                        numberOfMonths: 1,\r\n");
       $nm_saida->saida("                        changeMonth: true,\r\n");
       $nm_saida->saida("                        changeYear: true,\r\n");
       $nm_saida->saida("                        yearRange: 'c-5:c+5',\r\n");
       $nm_saida->saida("                        dayNames: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        dayNamesMin: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        monthNames: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        monthNamesShort: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        weekHeader: \"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\r\n");
       $nm_saida->saida("                        firstDay: " . $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . "") . ",\r\n");
       $nm_saida->saida("                        dateFormat: \"" . $this->jqueryCalendarDtFormat("ddmmyyyy", "/") . "\",\r\n");
       $nm_saida->saida("                        showOtherMonths: true,\r\n");
       $nm_saida->saida("                        showOn: \"button\",\r\n");
       $nm_saida->saida("                        buttonImage: \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image'] . "\",\r\n");
       $nm_saida->saida("                        buttonImageOnly: true,\r\n");
       $nm_saida->saida("                        currentText: \"" . html_entity_decode($this->Ini->Nm_lang['lang_per_today'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\r\n");
       $nm_saida->saida("                        closeText: \"" . html_entity_decode($this->Ini->Nm_lang['lang_btns_mess_clse'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"\r\n");
       $nm_saida->saida("                     });\r\n");
       $nm_saida->saida("                     var i_calendar = i;\r\n");
       $nm_saida->saida("                     $('#sc_dt_autorizacao_v2__jq_' + i).datepicker({\r\n");
       $nm_saida->saida("                        beforeShow: function(input, inst) {\r\n");
       $nm_saida->saida("                          var_dt_ini  = document.getElementById('dyn_search_dt_autorizacao_v2__dia_val_' + i_calendar).value + '/';\r\n");
       $nm_saida->saida("                          var_dt_ini += document.getElementById('dyn_search_dt_autorizacao_v2__mes_val_' + i_calendar).value + '/';\r\n");
       $nm_saida->saida("                          var_dt_ini += document.getElementById('dyn_search_dt_autorizacao_v2__ano_val_' + i_calendar).value;\r\n");
       $nm_saida->saida("                          document.getElementById('sc_dt_autorizacao_v2__jq_' + i_calendar).value = var_dt_ini;\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        onClose: function(dateText, inst) {\r\n");
       $nm_saida->saida("                          aParts  = dateText.split(\"/\");\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_v2__dia_val_' + i_calendar).value = aParts[0];\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_v2__mes_val_' + i_calendar).value = aParts[1];\r\n");
       $nm_saida->saida("                          document.getElementById('dyn_search_dt_autorizacao_v2__ano_val_' + i_calendar).value = aParts[2];\r\n");
       $nm_saida->saida("                        },\r\n");
       $nm_saida->saida("                        showWeek: true,\r\n");
       $nm_saida->saida("                        numberOfMonths: 1,\r\n");
       $nm_saida->saida("                        changeMonth: true,\r\n");
       $nm_saida->saida("                        changeYear: true,\r\n");
       $nm_saida->saida("                        yearRange: 'c-5:c+5',\r\n");
       $nm_saida->saida("                        dayNames: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        dayNamesMin: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        monthNames: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        monthNamesShort: [\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"],\r\n");
       $nm_saida->saida("                        weekHeader: \"" . html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\r\n");
       $nm_saida->saida("                        firstDay: " . $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . "") . ",\r\n");
       $nm_saida->saida("                        dateFormat: \"" . $this->jqueryCalendarDtFormat("ddmmyyyy", "/") . "\",\r\n");
       $nm_saida->saida("                        showOtherMonths: true,\r\n");
       $nm_saida->saida("                        showOn: \"button\",\r\n");
       $nm_saida->saida("                        buttonImage: \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image'] . "\",\r\n");
       $nm_saida->saida("                        buttonImageOnly: true,\r\n");
       $nm_saida->saida("                        currentText: \"" . html_entity_decode($this->Ini->Nm_lang['lang_per_today'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\",\r\n");
       $nm_saida->saida("                        closeText: \"" . html_entity_decode($this->Ini->Nm_lang['lang_btns_mess_clse'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\"\r\n");
       $nm_saida->saida("                     });\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         for (i = 1; i <= Tot_obj_dyn_search; i++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 tmp = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 if (tmp == 'log_credito')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                      $(\"#dyn_search_log_credito_val_\" + i).keypress(function(e) {\r\n");
       $nm_saida->saida("                        if (e.keyCode == $.ui.keyCode.ENTER) {\r\n");
       $nm_saida->saida("                             $(\"#dyn_search\").click();\r\n");
       $nm_saida->saida("                            return false;\r\n");
       $nm_saida->saida("                        }\r\n");
       $nm_saida->saida("                      });\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (tmp == 'motivo_desconto_id')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                      $(\"#dyn_search_motivo_desconto_id_val_\" + i).keypress(function(e) {\r\n");
       $nm_saida->saida("                        if (e.keyCode == $.ui.keyCode.ENTER) {\r\n");
       $nm_saida->saida("                             $(\"#dyn_search\").click();\r\n");
       $nm_saida->saida("                            return false;\r\n");
       $nm_saida->saida("                        }\r\n");
       $nm_saida->saida("                      });\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var del_all = false;\r\n");
       $nm_saida->saida("     function del_dyn_search(field, ind, tp_del)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_dynamicsearch_backup();\r\n");
       $nm_saida->saida("         qtd_atv = 0;\r\n");
       $nm_saida->saida("         Cmp_compara = Tab_obj_dyn_search[ind];\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search[ind] = 'NMSC_Dyn_Null';\r\n");
       $nm_saida->saida("         for (idel = 1; idel <= Tot_obj_dyn_search; idel++) {\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[idel] != 'NMSC_Dyn_Null') {\r\n");
       $nm_saida->saida("                 qtd_atv++;\r\n");
       $nm_saida->saida("                  break;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         $('#' + field).hide();\r\n");
       $nm_saida->saida("         if (qtd_atv == 0) {\r\n");
       $nm_saida->saida("             buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_change_bi(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if(parm == 'bw') $('#dyn_search_'+ field +'_' + ind).addClass('alignTop');\r\n");
       $nm_saida->saida("        else $('#dyn_search_'+ field +'_' + ind).removeClass('alignTop');\r\n");
       $nm_saida->saida("        if (parm.substring(0, 3) == \"bi_\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"bi_TP\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#ID_bi_dados_' + field + '_' + ind).html('');\r\n");
       $nm_saida->saida("                $('#ID_bi_dados_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("                $('#ID_nm_dados_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                return;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            ajax_ch_bi_dyn_search(field, ind, parm, 'grid');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#ID_bi_dados_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#ID_nm_dados_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                $('#dyn_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("                return;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            $('#ID_nm_dados_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            if (parm == \"bw\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_' + field + '_in_2_' + ind).css('display','');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_change_bw(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if(parm == 'bw') $('#dyn_search_'+ field +'_' + ind).addClass('alignTop');\r\n");
       $nm_saida->saida("        else $('#dyn_search_'+ field +'_' + ind).removeClass('alignTop');\r\n");
       $nm_saida->saida("        if (parm == \"bw\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_in_2_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_in_2_' + ind).css('display','none');\r\n");
       $nm_saida->saida("            if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_search_' + field + '_' + ind+' .fixed_width_input_content').hide();\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                $('#dyn_search_' + field + '_' + ind+' .fixed_width_input_content').show();\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_hide_input(field, ind)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;\r\n");
       $nm_saida->saida("        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;\r\n");
       $nm_saida->saida("        if (parm == \"nu\" || parm == \"nn\" || parm == \"ep\" || parm == \"ne\")\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','none');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            $('#dyn_' + field + '_' + ind).css('display','');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var bol_backup  = false;\r\n");
       $nm_saida->saida("     var backup_tot  = 0;\r\n");
       $nm_saida->saida("     var backup_tab  = new Array();\r\n");
       $nm_saida->saida("     var backup_html = '';\r\n");
       $nm_saida->saida("     var backup_desc = '';\r\n");
       $nm_saida->saida("     function nm_dynamicsearch_backup()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(!nm_dynamicsearch_getChange())\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             backup_tot = Tot_obj_dyn_search;\r\n");
       $nm_saida->saida("             backup_tab = Tab_obj_dyn_search;\r\n");
       $nm_saida->saida("             $('[type=text], textarea').each(function(){ this.defaultValue = this.value; });\r\n");
       $nm_saida->saida("             $('[type=checkbox], [type=radio]').each(function(){ this.defaultChecked = this.checked; });\r\n");
       $nm_saida->saida("             $('select option').each(function(){ this.defaultSelected = this.selected; });\r\n");
       $nm_saida->saida("             if($('#ul_dynamicSearchStart').length)\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 backup_html = $('#ul_dynamicSearchStart').html();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 backup_html = $('#table_dyn_search').html();\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             backup_desc = $('#id_dyn_descr_fly').html();\r\n");
       $nm_saida->saida("             nm_dynamicsearch_setbackup()\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_dynamicsearch_restore()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(nm_dynamicsearch_getChange())\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             nm_dynamicsearch_setbackup()\r\n");
       $nm_saida->saida("             Tot_obj_dyn_search = backup_tot;\r\n");
       $nm_saida->saida("             Tab_obj_dyn_search = backup_tab;\r\n");
       $nm_saida->saida("             if($('#ul_dynamicSearchStart').length)\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 $('#ul_dynamicSearchStart').html(backup_html);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 $('#table_dyn_search').html(backup_html);\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             $('#id_dyn_descr_fly').html(backup_desc);\r\n");
       $nm_saida->saida("             nm_dynamicsearch_reset();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_dynamicsearch_reset()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         bol_backup = false;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_dynamicsearch_setbackup()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         bol_backup = true;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_dynamicsearch_getChange()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         return bol_backup;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_show_dynamicsearch_fields_2(objFilter)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if ($(\"#id_dyn_search_fields\").prop(\"disabled\") == true) {\r\n");
       $nm_saida->saida("             return;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if(objFilter)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             var_str_id_tb = $(objFilter).parent().prop('id');\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         ajax_add_dyn_search_js('log_credito', 'grid')\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     var dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("     var var_str_id_tb = '';\r\n");
       $nm_saida->saida("     function nm_show_dynamicsearch_fields(objFilter)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("       if ($(\"#id_dyn_search_fields\").prop(\"disabled\") == true) {\r\n");
       $nm_saida->saida("           return;\r\n");
       $nm_saida->saida("       }\r\n");
       $nm_saida->saida("       if(objFilter)\r\n");
       $nm_saida->saida("       {\r\n");
       $nm_saida->saida("           var_str_id_tb = $(objFilter).parent().prop('id');\r\n");
       $nm_saida->saida("       }\r\n");
       $nm_saida->saida("       if (typeof(nm_show_dynamicsearch_fields_mobile) === typeof(function(){})) { return nm_show_dynamicsearch_fields_mobile(); };\r\n");
       $nm_saida->saida("       var btn_id = 'id_dyn_search_fields';\r\n");
       $nm_saida->saida("       var obj_id = 'id_dynamic_search_fields';\r\n");
       $nm_saida->saida("       dynamicsearch_status = 'open';\r\n");
       $nm_saida->saida("       $('#' + btn_id).mouseout(function() {\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_dynamicsearch_fields(obj_id, false);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id + ' li').click(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("         nm_hide_dynamicsearch_fields(obj_id, false);\r\n");
       $nm_saida->saida("       });\r\n");
       $nm_saida->saida("       $('#' + obj_id).css({\r\n");
       $nm_saida->saida("         'left': $('#' + btn_id).left,\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseover(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'over';\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .mouseleave(function() {\r\n");
       $nm_saida->saida("         dynamicsearch_status = 'out';\r\n");
       $nm_saida->saida("         setTimeout(function() {\r\n");
       $nm_saida->saida("           nm_hide_dynamicsearch_fields(obj_id, false);\r\n");
       $nm_saida->saida("         }, 1000);\r\n");
       $nm_saida->saida("       })\r\n");
       $nm_saida->saida("       .show('fast');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   function nm_hide_dynamicsearch_fields(obj_id, bol_force) {\r\n");
       $nm_saida->saida("     if (bol_force || 'over' != dynamicsearch_status) {\r\n");
       $nm_saida->saida("       $('#' + obj_id).hide('fast');\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function proc_btn_dyn(btn, proc) {\r\n");
       $nm_saida->saida("       if ($(\"#\" + btn).prop(\"disabled\") == true) {\r\n");
       $nm_saida->saida("           return;\r\n");
       $nm_saida->saida("       }\r\n");
       $nm_saida->saida("       eval (proc);\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function buttonDisable_dyn(buttonId) {\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).prop(\"disabled\", true).addClass(\"disabled\");\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).attr('disabled','disabled');\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   function buttonEnable_dyn(buttonId) {\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).prop(\"disabled\", false).removeClass(\"disabled\");\r\n");
       $nm_saida->saida("      $(\"#\" + buttonId).removeAttr('disabled');\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   $(document).ready(function() {\r\n");
       $nm_saida->saida("      Tot_obj_dyn_search_or = Tot_obj_dyn_search;\r\n");
       $nm_saida->saida("      Tab_obj_dyn_search_or = new Array();\r\n");
       $nm_saida->saida("      for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("          Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("      if (Tot_obj_dyn_search < 1) {\r\n");
       $nm_saida->saida("          buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("      buttonDisable_dyn('dyn_search');\r\n");
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['dyn_search']))
       {
       $nm_saida->saida("              buttonEnable_dyn('Save_frm_dyn');\r\n");
       $nm_saida->saida("              buttonEnable_dyn('SC_nmgp_save_name_dyn');\r\n");
       }
       else
       {
       $nm_saida->saida("              buttonDisable_dyn('Save_frm_dyn');\r\n");
       $nm_saida->saida("              buttonDisable_dyn('SC_nmgp_save_name_dyn');\r\n");
       }
       $nm_saida->saida("   });\r\n");
       $nm_saida->saida("     function buttonSelectedDS() {\r\n");
       $nm_saida->saida("        $(\"#dynamic_search_top\").addClass(\"selected\");\r\n");
       $nm_saida->saida("        $(\"#dynamic_search_bottom\").addClass(\"selected\");\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function buttonunselectedDS() {\r\n");
       $nm_saida->saida("        $(\"#dynamic_search_top\").removeClass(\"selected\");\r\n");
       $nm_saida->saida("        $(\"#dynamic_search_bottom\").removeClass(\"selected\");\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function scAddTippyDynSearch()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     Dyn_Have_Clear = false;\r\n");
       $nm_saida->saida("     function nm_clear_dyn_search()\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         nm_dynamicsearch_backup();\r\n");
       $nm_saida->saida("         del_all = true;\r\n");
       $nm_saida->saida("         $('#ul_dynamicSearchStart .dyn_search_close, #table_dyn_search .dyn_search_field_close').each(function( index ) {\r\n");
       $nm_saida->saida("             $( this ).click();\r\n");
       $nm_saida->saida("         });\r\n");
       $nm_saida->saida("         del_all = false;\r\n");
       $nm_saida->saida("         Dyn_Have_Clear = true;\r\n");
       $nm_saida->saida("         buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         buttonEnable_dyn('dyn_search');\r\n");
       $nm_saida->saida("         buttonDisable_dyn('Save_frm_dyn');\r\n");
       $nm_saida->saida("         buttonDisable_dyn('SC_nmgp_save_name_dyn');\r\n");
       $nm_saida->saida("         buttonunselectedDS();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_cancel_dyn_search(msg=\"N\", event=null)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if(nm_dynamicsearch_getChange() && msg == \"N\")\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             scJs_confirm('" . $this->Ini->Nm_lang['lang_reload_confirm'] . "', function() { nm_cancel_dyn_search('S'); }, function() { if (event !== null) { nm_avoid_modal_close(event); } });\r\n");
       $nm_saida->saida("             return false;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         nm_dynamicsearch_restore();\r\n");
       $nm_saida->saida("         if (Tot_obj_dyn_search > 0) {\r\n");
       $nm_saida->saida("             buttonEnable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("         }\r\n");
       if ($_SESSION['scriptcase']['proc_mobile']) {
           $nm_saida->saida("             closeAllModalPanes();\r\n");
       } else {
           $nm_saida->saida("         $('#nm_close_dyn').click();\r\n");
       }
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function get_json_dyn_search_and_or_horizontal(formId, Tp_Proc)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         json_dyn_search_horizontal = [];\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search.forEach(function(nome, i) {\r\n");
       $nm_saida->saida("             json_dyn_search_horizontal.push(i);\r\n");
       $nm_saida->saida("         });\r\n");
       $nm_saida->saida("         return json_dyn_search_horizontal;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_proc_dyn_search(formId, Tp_Proc)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("         if($('#dyn_search').hasClass('disabled')) return false;\r\n");
       $nm_saida->saida("         var out_dyn      = \"\";\r\n");
       $nm_saida->saida("         var empty_dyn    = true;\r\n");
       $nm_saida->saida("         var tem_dyn_null = false;\r\n");
       $nm_saida->saida("         var arr_exclude = new Array();\r\n");
       $nm_saida->saida("         Tab_obj_dyn_search_rec = get_json_dyn_search_and_or_horizontal(Tab_obj_dyn_search);\r\n");
       $nm_saida->saida("         if(Tab_obj_dyn_search_rec.length < 1) Dyn_Have_Clear = true; \r\n");
       $nm_saida->saida("         for (ii = 0; ii < Tab_obj_dyn_search_rec.length; ii++)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             i = Tab_obj_dyn_search_rec[ii];\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] == 'NMSC_Dyn_Null' || $('#dyn_search_enabled_'+ Tab_obj_dyn_search[i] +'_' + i).val()=='N')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 tem_dyn_null = true;\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_cond_' + i;\r\n");
       $nm_saida->saida("                 out_cond = dyn_search_get_sel_cond(obj_dyn);\r\n");
       $nm_saida->saida("                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_val_';\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'log_credito')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_select(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'fornecedor_id')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_text(obj_dyn + i, '');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'dt_autorizacao')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     obj_dyn = 'dyn_search_' + Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_dt_h(obj_dyn, i, 'DT');\r\n");
       $nm_saida->saida("                     if(out_cond=='bw')\r\n");
       $nm_saida->saida("                         result += \"_VLS2_\" + dyn_search_get_dt_h(obj_dyn + \"_v2_\", i, 'DT');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (Tab_obj_dyn_search[i] == 'motivo_desconto_id')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     result  = dyn_search_get_Dselelect(obj_dyn + i + '_dest');\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 if (result == '' && out_cond != 'ep' && out_cond != 'ne' && out_cond != 'nu' && out_cond != 'nn' && out_cond.substring(0, 3) != 'bi_')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     arr_exclude.push(i);\r\n");
       $nm_saida->saida("                     continue;\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("                 out_dyn += (out_dyn != \"\") ? \"_FDYN_\" : \"\";\r\n");
       $nm_saida->saida("                 out_dyn += Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + out_cond;\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + result;\r\n");
       $nm_saida->saida("                 out_dyn += \"_DYN_\" + i;\r\n");
       $nm_saida->saida("                 if (result != '' || out_cond == 'ep' || out_cond == 'ne' || out_cond == 'nu' || out_cond == 'nn' || out_cond.substring(0, 3) == 'bi_')\r\n");
       $nm_saida->saida("                 {\r\n");
       $nm_saida->saida("                     empty_dyn = false;\r\n");
       $nm_saida->saida("                 }\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (empty_dyn && (Dyn_Have_Clear || tem_dyn_null) && Tp_Proc != \"dyn_search_descr\")\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             Tp_Proc = \"dyn_search_clear\";\r\n");
       $nm_saida->saida("             Dyn_Have_Clear = false;\r\n");
       $nm_saida->saida("             buttonDisable_dyn(\"dyn_search_clear\");\r\n");
       $nm_saida->saida("             Tot_obj_dyn_search = 0;\r\n");
       $nm_saida->saida("             Tab_obj_dyn_searchr = new Array();\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (empty_dyn && Tp_Proc != \"dyn_search_clear\")\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             scJs_alert(\"" . $this->Ini->Nm_lang['lang_srch_req_field'] . "\");\r\n");
       $nm_saida->saida("             return false;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         if (Tp_Proc != \"dyn_search_descr\") {\r\n");
       $nm_saida->saida("             Tot_obj_dyn_search_or = Tot_obj_dyn_search;\r\n");
       $nm_saida->saida("             Tab_obj_dyn_search_or = new Array();\r\n");
       $nm_saida->saida("             for (i = 1; i <= Tot_obj_dyn_search; i++) {\r\n");
       $nm_saida->saida("                 Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             buttonDisable_dyn('dyn_search');\r\n");
       $nm_saida->saida("             buttonEnable_dyn('Save_frm_dyn');\r\n");
       $nm_saida->saida("             buttonEnable_dyn('SC_nmgp_save_name_dyn');\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("             hasModal = 'S';\r\n");
       $nm_saida->saida("             if(Tp_Proc == 'dyn_search_descr')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 hasModal = 'N';\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("             else if(Tp_Proc == 'dyn_search' || Tp_Proc == 'dyn_search_clear' || Tp_Proc == 'dyn_search_res' || Tp_Proc == 'dyn_search_clear_res')\r\n");
       $nm_saida->saida("             {\r\n");
       $nm_saida->saida("                 nm_dynamicsearch_reset();\r\n");
       $nm_saida->saida("                 hasModal = 'S';\r\n");
       $nm_saida->saida("             }\r\n");
       $nm_saida->saida("         ajax_navigate(Tp_Proc, out_dyn, hasModal);\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida(" var nm_quant_pack;\r\n");
       $nm_saida->saida(" // Adiciona um elemento\r\n");
       $nm_saida->saida(" //----------------------\r\n");
       $nm_saida->saida(" function nm_add_sel_Dyn(event, sOrig, sDest, Saida)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("  // Recupera objetos\r\n");
       $nm_saida->saida("  oOrig = document.getElementById(sOrig);\r\n");
       $nm_saida->saida("  oDest = document.getElementById(sDest);\r\n");
       $nm_saida->saida("  // Varre itens do destino\r\n");
       $nm_saida->saida("  Psel  = false;\r\n");
       $nm_saida->saida("  iDest = 0;\r\n");
       $nm_saida->saida("  iInit = oDest.length;\r\n");
       $nm_saida->saida("  arr_sel = new Array();\r\n");
       $nm_saida->saida("  for (i = 0; i < oDest.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (oDest.options[i].selected && !Psel)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("       Psel  = true;\r\n");
       $nm_saida->saida("       iInit = i + 1;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   else\r\n");
       $nm_saida->saida("   if (Psel)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("     arr_sel[iDest] = new Array(oDest.options[i].value, oDest.options[i].text);\r\n");
       $nm_saida->saida("     iDest++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Varre itens da origem\r\n");
       $nm_saida->saida("  for (i = 0; i < oOrig.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   // Item na origem selecionado e valido\r\n");
       $nm_saida->saida("   if ((event == 'Click' && oOrig.options[i].selected && !oOrig.options[i].disabled) || (event != 'Click' && oOrig.options[i] == event.target && !oOrig.options[i].disabled))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    // Recupera valores da origem\r\n");
       $nm_saida->saida("    sText  = oOrig.options[i].text;\r\n");
       $nm_saida->saida("    sValue = oOrig.options[i].value;\r\n");
       $nm_saida->saida("    // Cria item no destino\r\n");
       $nm_saida->saida("    oDest.options[iInit] = new Option(sText, sValue);\r\n");
       $nm_saida->saida("    // Desabilita item na origem\r\n");
       $nm_saida->saida("    oOrig.options[i].style.color = \"#A0A0A0\";\r\n");
       $nm_saida->saida("    oOrig.options[i].disabled    = true;\r\n");
       $nm_saida->saida("    oOrig.options[i].selected    = false;\r\n");
       $nm_saida->saida("    iInit++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Completa itens do destino\r\n");
       $nm_saida->saida("  if (iDest > 0)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   for (i = 0; i < iDest; i++)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("     oDest.options[iInit] = new Option();\r\n");
       $nm_saida->saida("     oDest.options[iInit].value = arr_sel[i][0];\r\n");
       $nm_saida->saida("     oDest.options[iInit].text  = arr_sel[i][1];\r\n");
       $nm_saida->saida("     iInit++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  if (Saida == \"S\")\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("      document.Fdyn_search.submit();\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" // Adiciona todos os elementos\r\n");
       $nm_saida->saida(" //-----------------------------\r\n");
       $nm_saida->saida(" function nm_add_all_Dyn(sOrig, sDest, Saida)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("  // Recupera objetos\r\n");
       $nm_saida->saida("  oOrig = document.getElementById(sOrig);\r\n");
       $nm_saida->saida("  oDest = document.getElementById(sDest);\r\n");
       $nm_saida->saida("  // Varre itens do destino\r\n");
       $nm_saida->saida("  Psel  = false;\r\n");
       $nm_saida->saida("  iDest = 0;\r\n");
       $nm_saida->saida("  iInit = oDest.length;\r\n");
       $nm_saida->saida("  arr_sel = new Array();\r\n");
       $nm_saida->saida("  for (i = 0; i < oDest.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (oDest.options[i].selected && !Psel)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("       Psel  = true;\r\n");
       $nm_saida->saida("       iInit = i + 1;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("   else\r\n");
       $nm_saida->saida("   if (Psel)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("     arr_sel[iDest] = new Array(oDest.options[i].value, oDest.options[i].text);\r\n");
       $nm_saida->saida("     iDest++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Varre itens da origem\r\n");
       $nm_saida->saida("  for (i = 0; i < oOrig.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   // Item na origem valido\r\n");
       $nm_saida->saida("   if (!oOrig.options[i].disabled)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    // Recupera valores da origem\r\n");
       $nm_saida->saida("    sText  = oOrig.options[i].text;\r\n");
       $nm_saida->saida("    sValue = oOrig.options[i].value;\r\n");
       $nm_saida->saida("    // Cria item no destino\r\n");
       $nm_saida->saida("    oDest.options[iInit] = new Option(sText, sValue);\r\n");
       $nm_saida->saida("    // Desabilita item na origem\r\n");
       $nm_saida->saida("    oOrig.options[i].style.color = \"#A0A0A0\";\r\n");
       $nm_saida->saida("    oOrig.options[i].disabled    = true;\r\n");
       $nm_saida->saida("    oOrig.options[i].selected    = false;\r\n");
       $nm_saida->saida("    iInit++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Completa itens do destino\r\n");
       $nm_saida->saida("  if (iDest > 0)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   for (i = 0; i < iDest; i++)\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("     oDest.options[iInit] = new Option();\r\n");
       $nm_saida->saida("     oDest.options[iInit].value = arr_sel[i][0];\r\n");
       $nm_saida->saida("     oDest.options[iInit].text  = arr_sel[i][1];\r\n");
       $nm_saida->saida("     iInit++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Reset combos\r\n");
       $nm_saida->saida("  oOrig.selectedIndex = -1;\r\n");
       $nm_saida->saida("  oDest.selectedIndex = -1;\r\n");
       $nm_saida->saida("  if (Saida == \"S\")\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("      document.Fdyn_search.submit();\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" // Remove um elemento\r\n");
       $nm_saida->saida(" //--------------------\r\n");
       $nm_saida->saida(" function nm_del_sel_Dyn(event, sOrig, sDest, Saida)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("  // Recupera objetos\r\n");
       $nm_saida->saida("  oOrig = document.getElementById(sOrig);\r\n");
       $nm_saida->saida("  oDest = document.getElementById(sDest);\r\n");
       $nm_saida->saida("  aSel  = new Array();\r\n");
       $nm_saida->saida("  atxt  = new Array();\r\n");
       $nm_saida->saida("  solt  = new Array();\r\n");
       $nm_saida->saida("  j     = 0;\r\n");
       $nm_saida->saida("  z     = 0;\r\n");
       $nm_saida->saida("  // Remove itens selecionados na origem\r\n");
       $nm_saida->saida("  for (i = oOrig.length - 1; i >= 0; i--)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   // Item na origem selecionado\r\n");
       $nm_saida->saida("   if ((event == 'Click' && oOrig.options[i].selected) || (event != 'Click' && oOrig.options[i] == event.target))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    aSel[j] = oOrig.options[i].value;\r\n");
       $nm_saida->saida("    atxt[j] = oOrig.options[i].text;\r\n");
       $nm_saida->saida("    j++;\r\n");
       $nm_saida->saida("    oOrig.options[i] = null;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Habilita itens no destino\r\n");
       $nm_saida->saida("  for (i = 0; i < oDest.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (oDest.options[i].disabled && in_array_Dyn(aSel, oDest.options[i].value))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    oDest.options[i].disabled    = false;\r\n");
       $nm_saida->saida("    oDest.options[i].style.color = \"\";\r\n");
       $nm_saida->saida("    solt[z] = oDest.options[i].value;\r\n");
       $nm_saida->saida("    z++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  for (i = 0; i < aSel.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (!in_array_Dyn(solt, aSel[i]))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  if (Saida == \"S\")\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("      document.Fdyn_search.submit();\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" // Remove todos os elementos\r\n");
       $nm_saida->saida(" //---------------------------\r\n");
       $nm_saida->saida(" function nm_del_all_Dyn(sOrig, sDest, Saida)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("  // Recupera objetos\r\n");
       $nm_saida->saida("  oOrig = document.getElementById(sOrig);\r\n");
       $nm_saida->saida("  oDest = document.getElementById(sDest);\r\n");
       $nm_saida->saida("  aSel  = new Array();\r\n");
       $nm_saida->saida("  atxt  = new Array();\r\n");
       $nm_saida->saida("  solt  = new Array();\r\n");
       $nm_saida->saida("  j     = 0;\r\n");
       $nm_saida->saida("  z     = 0;\r\n");
       $nm_saida->saida("  // Remove todos os itens na origem\r\n");
       $nm_saida->saida("  while (0 < oOrig.length)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   i       = oOrig.length - 1;\r\n");
       $nm_saida->saida("   aSel[j] = oOrig.options[i].value;\r\n");
       $nm_saida->saida("   atxt[j] = oOrig.options[i].text;\r\n");
       $nm_saida->saida("   j++;\r\n");
       $nm_saida->saida("   oOrig.options[i] = null;\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Habilita itens no destino\r\n");
       $nm_saida->saida("  for (i = 0; i < oDest.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (oDest.options[i].disabled && in_array_Dyn(aSel, oDest.options[i].value))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    oDest.options[i].disabled    = false;\r\n");
       $nm_saida->saida("    oDest.options[i].style.color = \"\";\r\n");
       $nm_saida->saida("    solt[z] = oDest.options[i].value;\r\n");
       $nm_saida->saida("    z++;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  for (i = 0; i < aSel.length; i++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (!in_array_Dyn(solt, aSel[i]))\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    oDest.options[oDest.length] = new Option(atxt[i], aSel[i]);\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  // Reset combos\r\n");
       $nm_saida->saida("  oOrig.selectedIndex = -1;\r\n");
       $nm_saida->saida("  oDest.selectedIndex = -1;\r\n");
       $nm_saida->saida("  if (Saida == \"S\")\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("      document.Fdyn_search.submit();\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" // empacota elementos selecionados\r\n");
       $nm_saida->saida(" //--------------------------------\r\n");
       $nm_saida->saida(" function nm_pack_Dyn(sOrig, sDest)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("    obj_sel = document.getElementById(sOrig);\r\n");
       $nm_saida->saida("    str_val = \"\";\r\n");
       $nm_saida->saida("    nm_quant_pack = 0;\r\n");
       $nm_saida->saida("    for (i = 0; i < obj_sel.length; i++)\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("         if (\"\" != str_val)\r\n");
       $nm_saida->saida("         {\r\n");
       $nm_saida->saida("             str_val += \"@?@\";\r\n");
       $nm_saida->saida("             nm_quant_pack++;\r\n");
       $nm_saida->saida("         }\r\n");
       $nm_saida->saida("         str_val += obj_sel.options[i].value;\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    document.getElementById(sDest).value = str_val;\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida(" // Teste se elemento pertence ao array\r\n");
       $nm_saida->saida(" //-------------------------------------\r\n");
       $nm_saida->saida(" function in_array_Dyn(aArray, sElem)\r\n");
       $nm_saida->saida(" {\r\n");
       $nm_saida->saida("  for (iCount = 0; iCount < aArray.length; iCount++)\r\n");
       $nm_saida->saida("  {\r\n");
       $nm_saida->saida("   if (sElem == aArray[iCount])\r\n");
       $nm_saida->saida("   {\r\n");
       $nm_saida->saida("    return true;\r\n");
       $nm_saida->saida("   }\r\n");
       $nm_saida->saida("  }\r\n");
       $nm_saida->saida("  return false;\r\n");
       $nm_saida->saida(" }\r\n");
       $nm_saida->saida("     function dyn_search_get_sel_cond(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        return $('#' + obj_id).val();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_select(obj_id, str_type)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        if(str_type == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            var obj = $('#' + obj_id).multipleSelect('getSelects');\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if ((str_type == '' && obj[iSelect].selected) || (str_type=='RADIO' || str_type=='CHECKBOX'))\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if(str_type == '' && obj[iSelect].selected)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    new_val = obj[iSelect];\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += new_val;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_Dselelect(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        for (iSelect = 0; iSelect < obj.length; iSelect++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            val += obj[iSelect].value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_radio(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        for (iRadio = 0; iRadio < obj.length; iRadio++)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj[iRadio].checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                val += obj[iRadio].value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_checkbox(obj_id)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var Nobj = document.getElementById(obj_id).name;\r\n");
       $nm_saida->saida("        var obj  = document.getElementsByName(Nobj);\r\n");
       $nm_saida->saida("        var val  = \"\";\r\n");
       $nm_saida->saida("        if (!obj.length)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            if (obj.checked)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            return val;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        else\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            for (iCheck = 0; iCheck < obj.length; iCheck++)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                if (obj[iCheck].checked)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("                    val += obj[iCheck].value;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_text(obj_id, obj_ac)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var obj = document.getElementById(obj_id);\r\n");
       $nm_saida->saida("        var val = \"\";\r\n");
       $nm_saida->saida("        if (obj)\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val = obj.value;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (obj_ac != '' && val == '')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj = document.getElementById(obj_ac);\r\n");
       $nm_saida->saida("            if (obj)\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val = obj.value;\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function dyn_search_get_dt_h(obj_id, ind, TP)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        var val = new Array();\r\n");
       $nm_saida->saida("        var val_empty = true;\r\n");
       $nm_saida->saida("        if (TP == 'DT' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"Y:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_ano_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("                if(Tval != -1)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("                if(obj_part && obj_part.value != '')\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_M:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_mes_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("                if(Tval != -1)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("                if(obj_part && obj_part.value != '')\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            obj_part  = document.getElementById(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("            val      += \"_VLS_D:\";\r\n");
       $nm_saida->saida("            if (obj_part && obj_part.type.substr(0, 6) == 'select')\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                Tval = dyn_search_get_sel_cond(obj_id + '_dia_val_' + ind);\r\n");
       $nm_saida->saida("                val += (Tval != -1) ? Tval : '';\r\n");
       $nm_saida->saida("                if(Tval != -1)\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("            else\r\n");
       $nm_saida->saida("            {\r\n");
       $nm_saida->saida("                val += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("                if(obj_part && obj_part.value != '')\r\n");
       $nm_saida->saida("                {\r\n");
       $nm_saida->saida("                    val_empty = false;\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("            }\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if (TP == 'HH' || TP == 'DH')\r\n");
       $nm_saida->saida("        {\r\n");
       $nm_saida->saida("            val            += (val != \"\") ? \"_VLS_\" : \"\";\r\n");
       $nm_saida->saida("            if(val != \"\") val_empty = false;\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_hor_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"H:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            if(obj_part && obj_part.value!= '') val_empty = false;\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_min_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_I:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            if(obj_part && obj_part.value!= '') val_empty = false;\r\n");
       $nm_saida->saida("            obj_part        = document.getElementById(obj_id + '_seg_val_' + ind);\r\n");
       $nm_saida->saida("            val            += \"_VLS_S:\";\r\n");
       $nm_saida->saida("            val            += (obj_part) ? obj_part.value : '';\r\n");
       $nm_saida->saida("            if(obj_part && obj_part.value!= '') val_empty = false;\r\n");
       $nm_saida->saida("        }\r\n");
       $nm_saida->saida("        if(val_empty) val='';\r\n");
       $nm_saida->saida("        return val;\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("     function nm_submit_cap_dyn(apl_dest, parms)\r\n");
       $nm_saida->saida("     {\r\n");
       $nm_saida->saida("        document.FCAP_dyn.action = apl_dest;\r\n");
       $nm_saida->saida("        document.FCAP_dyn.nmgp_parms.value = parms;\r\n");
       $nm_saida->saida("        window.open('','jan_cap','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
       $nm_saida->saida("        document.FCAP_dyn.target = \"jan_cap\"; \r\n");
       $nm_saida->saida("        document.FCAP_dyn.submit();\r\n");
       $nm_saida->saida("     }\r\n");
       $nm_saida->saida("function nm_save_grid_search_dyn()\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    if ($(\"#Save_frm_dyn\").hasClass(\"disabled\")) {\r\n");
       $nm_saida->saida("        return;\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    if ($('#SC_nmgp_save_name_dyn').val() == '')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $('#SC_nmgp_save_name_dyn').focus();\r\n");
       $nm_saida->saida("        return false;\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    save_name = $('#SC_nmgp_save_name_dyn').val();\r\n");
       $nm_saida->saida("    save_opt = $('#SC_nmgp_save_option_dyn').val();\r\n");
       $nm_saida->saida("    //str_out = get_json_dyn_search_and_or();\r\n");
       $nm_saida->saida("    str_out = '';\r\n");
       $nm_saida->saida("    if (typeof embed !== 'undefined' && embed) {\r\n");
       $nm_saida->saida("        parent.ajax_navigate('dyn_search_save', 'save_name='+ save_name +'&save_opt='+ save_opt +'&str_out=&' + str_out);\r\n");
       $nm_saida->saida("        $('#dyn_cancel').click();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    else\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        ajax_navigate('dyn_search_save', 'save_name='+ save_name +'&save_opt='+ save_opt +'&str_out=&' + str_out);\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("        buttonEnable_dyn('dyn_search_clear');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function nm_change_grid_search_dyn(obj_sel)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    index = obj_sel.selectedIndex;\r\n");
       $nm_saida->saida("    if (index == -1 || obj_sel.options[index].value == \"\")\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        return false;\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    nm_dynamicsearch_reset();\r\n");
       $nm_saida->saida("    if (typeof embed !== 'undefined' && embed) {\r\n");
       $nm_saida->saida("        parent.ajax_navigate('dyn_search_select', 'save_name='+ obj_sel.options[index].value);\r\n");
       $nm_saida->saida("        $('#dyn_cancel').click();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    else\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        ajax_navigate('dyn_search_select', 'save_name='+ obj_sel.options[index].value);\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("        buttonEnable_dyn('dyn_search_clear');\r\n");
       $nm_saida->saida("    obj_sel.selectedIndex = 0;\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function nm_del_grid_search_dyn(obj_sel)\r\n");
       $nm_saida->saida("{\r\n");
       $nm_saida->saida("    if ($('#sel_filters_del_dyn').val() == '')\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        return false;\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("     if (typeof embed !== 'undefined' && embed) {\r\n");
       $nm_saida->saida("        parent.ajax_navigate('dyn_search_delete', 'save_name='+ $('#sel_filters_del_dyn').val());\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    else\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        ajax_navigate('dyn_search_delete', 'save_name='+ $('#sel_filters_del_dyn').val());\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    //$('#Cancel_frm_dyn').click();\r\n");
       $nm_saida->saida("    $('#id_sel_recup_filters_dyn option[value=\"'+ $('#sel_filters_del_dyn').val() +'\"]').remove();\r\n");
       $nm_saida->saida("    $('#id_sel_recup_filters_dyn').val('');\r\n");
       $nm_saida->saida("    if($(\"#id_sel_recup_filters_dyn option[value!='']\").length < 1)\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $('#id_tr_filters_save_dyn').hide();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("    $('#sel_filters_del_dyn option:selected').remove();\r\n");
       $nm_saida->saida("    $('#sel_filters_del_dyn').val('');\r\n");
       $nm_saida->saida("    if($(\"#sel_filters_del_dyn option[value!='']\").length < 1)\r\n");
       $nm_saida->saida("    {\r\n");
       $nm_saida->saida("        $('#id_tr_filters_del_dyn').hide();\r\n");
       $nm_saida->saida("    }\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("   </script>\r\n");
       $nm_saida->saida("   <form name=\"FCAP_dyn\" action=\"\" method=\"post\" target=\"_blank\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"grid_descontos_importacao\"/>\r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"true\"> \r\n");
       $nm_saida->saida("     <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"> \r\n");
       $nm_saida->saida("   </form> \r\n");
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
       if (!$_SESSION['scriptcase']['proc_mobile']) {
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_grid_descontos_importacao\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" style=\"display: block;\" name=\"nm_iframe_liga_B_grid_descontos_importacao\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   if (typeof(scSetFixedHeaders) === typeof(function(){})) scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca']['image']);
                   }
               } 
           } 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final']['style'] . " disabled\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final']['style'] . ' disabled');
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final']['image']);
                   }
               } 
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_descontos_importacao', $(document).innerHeight())\",50);\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"grid_descontos_importacao\"/>\r\n");
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
   $nm_saida->saida("                     action=\"grid_descontos_importacao_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"grid_descontos_importacao_iframe_prt.php\" \r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['ajax_nav'])
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
   $nm_saida->saida("          par_modal = '?&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=grid_descontos_importacao';\r\n");
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
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_grid_descontos_importacao');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_grid_descontos_importacao');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_grid_descontos_importacao');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_grid_descontos_importacao');} \r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['grid_descontos_importacao_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_descontos_importacao@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"grid_descontos_importacao_iframe.php\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("               document.Fprint.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
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
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
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
   $nm_saida->saida("           document.Fexport.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_descontos_importacao/grid_descontos_importacao_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"grid_descontos_importacao_export_ctrl.php\";\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['grid_descontos_importacao']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"grid_descontos_importacao_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_descontos_importacao']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('grid_descontos_importacao')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('grid_descontos_importacao', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
