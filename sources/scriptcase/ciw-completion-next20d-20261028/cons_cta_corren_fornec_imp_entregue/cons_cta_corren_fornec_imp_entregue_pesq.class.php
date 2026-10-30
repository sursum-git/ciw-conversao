<?php

class cons_cta_corren_fornec_imp_entregue_pesq
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $cmp_formatado;
   var $nm_data;
   var $Campos_Mens_erro;

   var $comando;
   var $comando_sum;
   var $comando_filtro;
   var $comando_ini;
   var $comando_fim;
   var $NM_operador;
   var $NM_data_qp;
   var $NM_path_filter;
   var $NM_curr_fil;
   var $nm_location;
   var $NM_ajax_opcao;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_procs_compra']['opc_psq'] = false; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_pp_container']['opc_psq'] = false; 
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
    function scGetTippyCssTheme(&$themeList, $themeName)
    {
        if (isset($themeList[$themeName])) {
            return;
        }

        $themeNameParts = explode('__NM__', $themeName);

        $themeList[$themeName] = [
            'tippy' => $themeNameParts[1],
            'file' => '../_lib/freecss/' . $themeName . '.css'
        ];
    }

   function monta_busca()
   {
      global $bprocessa;
      include("../_lib/css/" . $this->Ini->str_schema_filter . "_filter.php");
      $this->Ini->Str_btn_filter = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_filter_css  = trim($str_button) . "/" . trim($str_button) . ".css";
      $this->Ini->str_google_fonts = (isset($str_google_fonts) && !empty($str_google_fonts))?$str_google_fonts:'';
      include($this->Ini->path_btn . $this->Ini->Str_btn_filter);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['path_libs_php'] = $this->Ini->path_lib_php;
      $this->Img_sep_filter = "/" . trim($str_toolbar_separator);
      $this->Block_img_col  = trim($str_block_col);
      $this->Block_img_exp  = trim($str_block_exp);
      $this->Bubble_tail    = trim($str_bubble_tail);
      $this->css_help_tooltip_faicon = isset($css_help_tooltip_faicon) && '' != trim($css_help_tooltip_faicon) ? trim($css_help_tooltip_faicon) : "fa fa-question-circle";
      $this->css_schema_info_tooltiptheme = isset($css_schema_info_tooltiptheme) && '' != trim($css_schema_info_tooltiptheme)  ? trim($css_schema_info_tooltiptheme) : "";
      $this->Ini->tippy_themes = [];
      $this->Ini->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->Ini->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->Ini->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput"); 
      $this->NM_case_insensitive = false;
      $this->init();
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search_change_fil")
      {
          $arr_new_fil = $this->recupera_filtro($this->NM_ajax_grid_fil, "grid");
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = array(); 
          foreach ($arr_new_fil as $tp)
          {
              foreach ($tp as $ind => $cada_dado)
              {
                  $field = $cada_dado['field'];
                  if (substr($cada_dado['field'], 0, 3) == "SC_")
                  {
                      $field = substr($cada_dado['field'], 3);
                  }
                  if (substr($cada_dado['field'], 0, 6) == "id_ac_")
                  {
                      $field = substr($cada_dado['field'], 6);
                  }
                  if (is_array($cada_dado['value']))
                  {
                      $arr_tmp = array();
                      foreach($cada_dado['value'] as $ix => $dados)
                      {
                          if (isset($dados['opt']))
                          {
                              $arr_tmp[] = $dados['opt'];
                          }
                          else
                          {
                              $arr_tmp[] = $dados;
                          }
                      }
                      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->processa_busca();
          if (!empty($this->Campos_Mens_erro)) 
          {
              scriptcase_error_display($this->Campos_Mens_erro, ""); 
              return false;
          }
          return true;
      }
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
         $this->processa_busca();
         return;
      }
      if ($this->NM_ajax_flag)
      {
          ob_start();
          $this->Arr_result = array();
          $this->processa_ajax();
          $Temp = ob_get_clean();
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          if ($this->Db)
          {
              $this->Db->Close(); 
          }
          exit;
      }
      if (isset($bprocessa) && "pesq" == $bprocessa)
      {
         $this->processa_busca();
      }
      else
      {
         $this->monta_formulario();
      }
   }

   /**
    * @access  public
    */
   function monta_formulario()
   {
      $this->monta_html_ini();
      $this->monta_cabecalho();
      $this->monta_form();
      $this->monta_html_fim();
   }

   /**
    * @access  public
    */
   function init()
   {
      global $bprocessa;
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_api.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("pt_br");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
      $this->NM_path_filter_dyn = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters_dyn/";
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['opcao'] = "igual";
   }

   function processa_ajax()
   {
      global $NM_filters, $NM_filters_del, $nmgp_save_name, $nmgp_save_option, $NM_fields_refresh, $NM_parms_refresh, $Campo_bi, $Opc_bi, $NM_operador, $nmgp_save_origem;
//-- ajax metodos ---
      if ($this->NM_ajax_opcao == "ajax_filter_save")
      {
          ob_end_clean();
          ob_end_clean();
          $this->salva_filtro($nmgp_save_origem);
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" . cons_cta_corren_fornec_imp_entregue_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . cons_cta_corren_fornec_imp_entregue_pack_protect_string($Tipo_filter[0]) . "\">.." . cons_cta_corren_fornec_imp_entregue_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }

      if ($this->NM_ajax_opcao == "ajax_filter_delete")
      {
          ob_end_clean();
          ob_end_clean();
          $this->apaga_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter  = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" .  cons_cta_corren_fornec_imp_entregue_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . cons_cta_corren_fornec_imp_entregue_pack_protect_string($Tipo_filter[0]) . "\">.." . cons_cta_corren_fornec_imp_entregue_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" class=\"scFilterToolbar_obj\" style=\"display:". (count($this->NM_fil_ant)>0?'':'none') .";\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }
      if ($this->NM_ajax_opcao == "ajax_filter_select")
      {
          ob_end_clean();
          ob_end_clean();
          $this->Arr_result = $this->recupera_filtro($NM_filters, "pesq");
      }

      if ($this->NM_ajax_opcao == 'autocomp_data_hora')
      {
          $data_hora = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_data_hora($data_hora);
          ob_end_clean();
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
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_historico')
      {
          $historico = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_historico($historico);
          ob_end_clean();
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
          $this->Db->Close(); 
          exit;
      }
   }
   function lookup_ajax_data_hora($data_hora)
   {
      $data_hora = substr($this->Db->qstr($data_hora), 1, -1);
            $data_hora_look = (is_string($data_hora) ? substr($this->Db->qstr($data_hora), 1, -1) : $data_hora); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct data_hora from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where  data_hora like '%" . $data_hora . "%'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_historico($historico)
   {
      $historico = substr($this->Db->qstr($historico), 1, -1);
            $historico_look = (is_string($historico) ? substr($this->Db->qstr($historico), 1, -1) : $historico); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct historico from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where  historico like '%" . $historico . "%'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   

   /**
    * @access  public
    */
   function processa_busca()
   {
      $this->inicializa_vars();
      $this->trata_campos();
      $this->processa_campos();
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->finaliza_resultado_ajax();
          return;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->monta_formulario();
      }
      else
      {
          $this->finaliza_resultado();
      }
   }

   /**
    * @access  public
    */
   function and_or()
   {
      $posWhere = strpos(strtolower($this->comando), "where");
      if (FALSE === $posWhere)
      {
         $this->comando     .= " where (";
         $this->comando_sum .= " and (";
         $this->comando_fim  = " ) ";
      }
      if ($this->comando_ini == "ini")
      {
          if (FALSE !== $posWhere)
          {
              $this->comando     .= " and ( ";
              $this->comando_sum .= " and ( ";
              $this->comando_fim  = " ) ";
          }
         $this->comando_ini  = "";
      }
      elseif ("or" == $this->NM_operador)
      {
         $this->comando        .= " or ";
         $this->comando_sum    .= " or ";
         $this->comando_filtro .= " or ";
      }
      else
      {
         $this->comando        .= " and ";
         $this->comando_sum    .= " and ";
         $this->comando_filtro .= " and ";
      }
   }

   /**
    * @access  public
    * @param  string  $nome  
    * @param  string  $condicao  
    * @param  mixed  $campo  
    * @param  mixed  $campo2  
    * @param  string  $nome_campo  
    * @param  string  $tp_campo  
    * @global  array  $nmgp_tab_label  
    */
   function monta_condicao($nome, $condicao, $campo, $campo2 = "", $nome_campo="", $tp_campo="", $tp_unaccent=false)
   {
      global $nmgp_tab_label;
      $condicao   = strtoupper($condicao);
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $Nm_numeric = array();
      $nm_esp_postgres = array();
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $Nm_numeric[] = "cta_corren_fornec_imp_id";$Nm_numeric[] = "fornecedor_id";$Nm_numeric[] = "item_proc_compra_id";$Nm_numeric[] = "cod_tipo_movto";$Nm_numeric[] = "vl_lancto";$Nm_numeric[] = "vl_lancto_proporc";$Nm_numeric[] = "cod_acao";$Nm_numeric[] = "num_id_tit_ap";$Nm_numeric[] = "situacao_container_id";$Nm_numeric[] = "proc_compra_id";$Nm_numeric[] = "container";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$campo_join]);
              return;
          }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'data';
      if (in_array($campo_join, $Nm_datas))
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['SC_sep_date1'];
          }
      }
      if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
      {
         return;
      }
      else
      {
         $tmp_pos = (is_string($campo)) ? strpos($campo, "##@@") : false;
         if ($tmp_pos === false)
         {
             $res_lookup = $campo;
         }
         else
         {
             $res_lookup = substr($campo, $tmp_pos + 4);
             $campo = substr($campo, 0, $tmp_pos);
             if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
             {
                 return;
             }
         }
         $tmp_pos = (is_string($this->cmp_formatado[$nome_campo])) ? strpos($this->cmp_formatado[$nome_campo], "##@@") : false;
         if ($tmp_pos !== false)
         {
             $this->cmp_formatado[$nome_campo] = substr($this->cmp_formatado[$nome_campo], $tmp_pos + 4);
         }
         $this->and_or();
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $campo2 = substr($this->Db->qstr($campo2), 1, -1);
         $nome_sum = ".$nome";
         if ($tp_campo == "TIMESTAMP")
         {
             $tp_campo = "DATETIME";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "TIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'hh24:mi:ss')";
             }
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR)";
             $nome_sum = "CAST ($nome_sum AS VARCHAR)";
         }
         if ($tp_campo == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(10),$nome,121)";
                 $nome_sum = "convert(char(10),$nome_sum,121)";
             }
         }
         if ($tp_campo == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(19),$nome,121)";
                 $nome_sum = "convert(char(19),$nome_sum,121)";
             }
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) && !$this->Date_part)
         {
             $nome     = "TO_DATE(TO_CHAR($nome, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $nome_sum = "TO_DATE(TO_CHAR($nome_sum, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $tp_campo = "DATETIME";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO FRACTION)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO FRACTION)";
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO DAY)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO DAY)";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR(255))";
             $nome_sum = "CAST ($nome_sum AS VARCHAR(255))";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         if (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         switch ($condicao)
         {
            case "EQ":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower. " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "II":     // 
               if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
               {
                   $op_all       = " ilike ";
                   $nm_ini_lower = "";
                   $nm_fim_lower = "";
               }
               else
               {
                   $op_all = " like ";
               }
               $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
            break;
             case "QP";     // 
             case "NP";     // 
                $concat = " " . $this->NM_operador . " ";
                if ($condicao == "QP")
                {
                    $op_all    = " #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                }
                else
                {
                    $op_all    = " not #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                }
               $NM_cond    = "";
               $NM_cmd     = "";
               $NM_cmd_sum = "";
               if (substr($tp_campo, 0, 4) == "DATE" && $this->Date_part)
               {
                   if ($this->NM_data_qp['ano'] != "____")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['ano'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%Y', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%Y', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('year' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('year' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(year, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(year, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "year (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "year (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "year(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "year(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['mes'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['mes'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%m', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%m', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('month' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('month' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(month, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(month, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "month (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "month (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "month(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "month(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['dia'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['dia'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%d', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%d', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('day' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('day' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(day, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(day, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "DAYOFMONTH(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "DAYOFMONTH(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "day(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "day(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                   }
               }
               if (strpos($tp_campo, "TIME") !== false && $this->Date_part)
               {
                   if ($this->NM_data_qp['hor'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['hor'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%H', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%H', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('hour' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('hour' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(hour, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(hour, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['min'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['min'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%M', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%M', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('minute' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('minute' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(minute, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(minute, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['seg'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['seg'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%S', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%S', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('second' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('second' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(second, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(second, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                   }
               }
               if ($this->Date_part)
               {
                   if (!empty($NM_cmd))
                   {
                       $NM_cmd     = " (" . $NM_cmd . ")";
                       $NM_cmd_sum = " (" . $NM_cmd_sum . ")";
                       $this->comando        .= $NM_cmd;
                       $this->comando_sum    .= $NM_cmd_sum;
                       $this->comando_filtro .= $NM_cmd;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                   }
               }
               else
               {
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
                   {
                       $op_all       = str_replace("#sc_like_#", "ilike", $op_all);
                       $nm_ini_lower = "";
                       $nm_fim_lower = "";
                   }
                   else
                   {
                       $op_all = str_replace("#sc_like_#", "like", $op_all);
                   }
                   $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str  = "";
               $nm_cond   = "";
               $cond_descr  = "";
               $count_descr = 0;
               $end_descr   = false;
               $lim_descr   = 15;
               $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
               if (!empty($nm_sc_valores))
               {
                   foreach ($nm_sc_valores as $nm_sc_valor)
                   {
                      if (in_array($campo_join, $Nm_numeric) && substr_count($nm_sc_valor, ".") > 1)
                      {
                         $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                      }
                      if ("" != $cond_str)
                      {
                         $cond_str .= ",";
                         $nm_cond  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                      }
                      $cond_str .= $nm_ini_lower . $nm_aspas . $nm_sc_valor . $nm_aspas1 . $nm_fim_lower;
                      $nm_cond  .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                      if (((strlen($cond_descr) + strlen($nm_sc_valor) + $lang_descr) < $lim_descr) || empty($cond_descr))
                      {
                          $cond_descr .= (empty($cond_descr)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                          $cond_descr .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                          $count_descr++;
                      }
                      elseif (!$end_descr)
                      {
                          $cond_descr .= " +" . (count($nm_sc_valores) - $count_descr);
                          $end_descr = true;
                      };
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
            break;
         }
      }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd, $tp_nd)
   {
       $fill_dt = false;
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
       }
       if ($cond != "II" && $cond != "QP" && $cond != "NP")
       {
           $fill_dt = true;
       }
       if ($fill_dt)
       {
           $val[0]['dia'] = (!empty($val[0]['dia']) && strlen($val[0]['dia']) == 1) ? "0" . $val[0]['dia'] : $val[0]['dia'];
           $val[0]['mes'] = (!empty($val[0]['mes']) && strlen($val[0]['mes']) == 1) ? "0" . $val[0]['mes'] : $val[0]['mes'];
           if ($tp == "DH")
           {
               $val[0]['hor'] = (!empty($val[0]['hor']) && strlen($val[0]['hor']) == 1) ? "0" . $val[0]['hor'] : $val[0]['hor'];
               $val[0]['min'] = (!empty($val[0]['min']) && strlen($val[0]['min']) == 1) ? "0" . $val[0]['min'] : $val[0]['min'];
               $val[0]['seg'] = (!empty($val[0]['seg']) && strlen($val[0]['seg']) == 1) ? "0" . $val[0]['seg'] : $val[0]['seg'];
           }
           if ($cond == "BW")
           {
               $val[1]['dia'] = (!empty($val[1]['dia']) && strlen($val[1]['dia']) == 1) ? "0" . $val[1]['dia'] : $val[1]['dia'];
               $val[1]['mes'] = (!empty($val[1]['mes']) && strlen($val[1]['mes']) == 1) ? "0" . $val[1]['mes'] : $val[1]['mes'];
               if ($tp == "DH")
               {
                   $val[1]['hor'] = (!empty($val[1]['hor']) && strlen($val[1]['hor']) == 1) ? "0" . $val[1]['hor'] : $val[1]['hor'];
                   $val[1]['min'] = (!empty($val[1]['min']) && strlen($val[1]['min']) == 1) ? "0" . $val[1]['min'] : $val[1]['min'];
                   $val[1]['seg'] = (!empty($val[1]['seg']) && strlen($val[1]['seg']) == 1) ? "0" . $val[1]['seg'] : $val[1]['seg'];
               }
           }
       }
       if ($cond == "BW")
       {
           $this->NM_data_1 = array();
           $this->NM_data_1['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
           $this->NM_data_1['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
           $this->NM_data_1['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
           $this->NM_data_1['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
           $this->NM_data_1['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
           $this->NM_data_1['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
           $this->data_menor($this->NM_data_1);
           $this->NM_data_2 = array();
           $this->NM_data_2['ano'] = (isset($val[1]['ano']) && !empty($val[1]['ano'])) ? $val[1]['ano'] : "____";
           $this->NM_data_2['mes'] = (isset($val[1]['mes']) && !empty($val[1]['mes'])) ? $val[1]['mes'] : "__";
           $this->NM_data_2['dia'] = (isset($val[1]['dia']) && !empty($val[1]['dia'])) ? $val[1]['dia'] : "__";
           $this->NM_data_2['hor'] = (isset($val[1]['hor']) && !empty($val[1]['hor'])) ? $val[1]['hor'] : "__";
           $this->NM_data_2['min'] = (isset($val[1]['min']) && !empty($val[1]['min'])) ? $val[1]['min'] : "__";
           $this->NM_data_2['seg'] = (isset($val[1]['seg']) && !empty($val[1]['seg'])) ? $val[1]['seg'] : "__";
           $this->data_maior($this->NM_data_2);
           $val = array();
           if ($tp == "ND")
           {
               $out_dt1 = $format_nd;
               $out_dt1 = str_replace("yyyy", $this->NM_data_1['ano'], $out_dt1);
               $out_dt1 = str_replace("mm",   $this->NM_data_1['mes'], $out_dt1);
               $out_dt1 = str_replace("dd",   $this->NM_data_1['dia'], $out_dt1);
               $out_dt1 = str_replace("hh",   "", $out_dt1);
               $out_dt1 = str_replace("ii",   "", $out_dt1);
               $out_dt1 = str_replace("ss",   "", $out_dt1);
               $out_dt2 = $format_nd;
               $out_dt2 = str_replace("yyyy", $this->NM_data_2['ano'], $out_dt2);
               $out_dt2 = str_replace("mm",   $this->NM_data_2['mes'], $out_dt2);
               $out_dt2 = str_replace("dd",   $this->NM_data_2['dia'], $out_dt2);
               $out_dt2 = str_replace("hh",   "", $out_dt2);
               $out_dt2 = str_replace("ii",   "", $out_dt2);
               $out_dt2 = str_replace("ss",   "", $out_dt2);
               $val[0] = $out_dt1;
               $val[1] = $out_dt2;
               return;
           }
           if ($tsql == "TIME")
           {
               $val[0] = $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
               $val[1] = $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
           }
           elseif (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] = $this->NM_data_1['ano'] . "-" . $this->NM_data_1['mes'] . "-" . $this->NM_data_1['dia'];
               $val[1] = $this->NM_data_2['ano'] . "-" . $this->NM_data_2['mes'] . "-" . $this->NM_data_2['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " " . $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
                   $val[1] .= " " . $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
               }
           }
           return;
       }
       $this->NM_data_qp = array();
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && $val[0]['ano'] != "") ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && $val[0]['mes'] != "") ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && $val[0]['dia'] != "") ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && $val[0]['hor'] != "") ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && $val[0]['min'] != "") ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && $val[0]['seg'] != "") ? $val[0]['seg'] : "__";
       if ($tp != "ND" && ($cond == "LE" || $cond == "LT" || $cond == "GE" || $cond == "GT"))
       {
           $count_fill = 0;
           foreach ($this->NM_data_qp as $x => $tx)
           {
               if (substr($tx, 0, 2) != "__")
               {
                   $count_fill++;
               }
           }
           if ($count_fill > 1)
           {
               if ($cond == "LE" || $cond == "GT")
               {
                   $this->data_maior($this->NM_data_qp);
               }
               else
               {
                   $this->data_menor($this->NM_data_qp);
               }
               if ($tsql == "TIME")
               {
                   $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
               }
               elseif (substr($tsql, 0, 4) == "DATE")
               {
                   $val[0] = $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
                   if (strpos($tsql, "TIME") !== false)
                   {
                       $val[0] .= " " . $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
                   }
               }
               return;
           }
       }
       foreach ($this->NM_data_qp as $x => $tx)
       {
           if (substr($tx, 0, 2) == "__" && ($x == "dia" || $x == "mes" || $x == "ano"))
           {
               if (substr($tsql, 0, 4) == "DATE")
               {
                   $this->Date_part = true;
                   break;
               }
           }
           if (substr($tx, 0, 2) == "__" && ($x == "hor" || $x == "min" || $x == "seg"))
           {
               if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
               {
                   $this->Date_part = true;
                   break;
               }
           }
       }
       if ($this->Date_part)
       {
           $this->Ini_date_part = "";
           $this->End_date_part = "";
           $this->Ini_date_char = "";
           $this->End_date_char = "";
           if (isset($this->Ini->nm_bases_sqlite) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $this->Ini_date_part = "'";
               $this->End_date_part = "'";
           }
           if ($tp != "ND")
           {
               if ($cond == "EQ")
               {
                   $this->Operador_date_part = " = ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
               }
               elseif ($cond == "II")
               {
                   $this->Operador_date_part = " like ";
                   $this->Ini_date_part = "'";
                   $this->End_date_part = "%'";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_strt'];
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               elseif ($cond == "DF")
               {
                   $this->Operador_date_part = " <> ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
               }
               elseif ($cond == "GT")
               {
                   $this->Operador_date_part = " > ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr'];
               }
               elseif ($cond == "GE")
               {
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr_equl'];
                   $this->Operador_date_part = " >= ";
               }
               elseif ($cond == "LT")
               {
                   $this->Operador_date_part = " < ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less'];
               }
               elseif ($cond == "LE")
               {
                   $this->Operador_date_part = " <= ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less_equl'];
               }
               elseif ($cond == "NP")
               {
                   $this->Operador_date_part = " not like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               else
               {
                   $this->Operador_date_part = " like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
           }
           if ($cond == "DF")
           {
               $cond = "NP";
           }
           if ($cond != "NP")
           {
               $cond = "QP";
           }
       }
       $val = array();
       if ($tp != "ND" && ($cond == "QP" || $cond == "NP"))
       {
           $val[0] = "";
           if (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " ";
               }
           }
           if (strpos($tsql, "TIME") !== false)
           {
               $val[0] .= $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           }
           return;
       }
       if ($cond == "II" || $cond == "DF" || $cond == "EQ" || $cond == "LT" || $cond == "GE")
       {
           $this->data_menor($this->NM_data_qp);
       }
       else
       {
           $this->data_maior($this->NM_data_qp);
       }
       if ($tsql == "TIME")
       {
           $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           return;
       }
       $format_sql = "";
       if (substr($tsql, 0, 4) == "DATE")
       {
           $format_sql .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
           if (strpos($tsql, "TIME") !== false)
           {
               $format_sql .= " ";
           }
       }
       if (strpos($tsql, "TIME") !== false)
       {
           $format_sql .=  $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
       }
       if ($tp != "ND")
       {
           $val[0] = $format_sql;
           return;
       }
       if ($tp == "ND")
       {
           $format_nd = str_replace("yyyy", $this->NM_data_qp['ano'], $format_nd);
           $format_nd = str_replace("mm",   $this->NM_data_qp['mes'], $format_nd);
           $format_nd = str_replace("dd",   $this->NM_data_qp['dia'], $format_nd);
           $format_nd = str_replace("hh",   $this->NM_data_qp['hor'], $format_nd);
           $format_nd = str_replace("ii",   $this->NM_data_qp['min'], $format_nd);
           $format_nd = str_replace("ss",   $this->NM_data_qp['seg'], $format_nd);
           $val[0] = $format_nd;
           return;
       }
   }
   function data_menor(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "0001" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "01" : $data_arr["mes"];
       $data_arr["dia"] = ("__" == $data_arr["dia"])   ? "01" : $data_arr["dia"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "00" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "00" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "00" : $data_arr["seg"];
   }

   function data_maior(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "9999" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "12" : $data_arr["mes"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "23" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "59" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "59" : $data_arr["seg"];
       if ("__" == $data_arr["dia"])
       {
           $data_arr["dia"] = "31";
           if ($data_arr["mes"] == "04" || $data_arr["mes"] == "06" || $data_arr["mes"] == "09" || $data_arr["mes"] == "11")
           {
               $data_arr["dia"] = 30;
           }
           elseif ($data_arr["mes"] == "02")
           { 
                if  ($data_arr["ano"] % 4 == 0)
                {
                     $data_arr["dia"] = 29;
                }
                else 
                {
                     $data_arr["dia"] = 28;
                }
           }
       }
   }

   /**
    * @access  public
    * @param  string  $nm_data_hora  
    */
   function limpa_dt_hor_pesq(&$nm_data_hora)
   {
      $nm_data_hora = str_replace("Y", "", $nm_data_hora); 
      $nm_data_hora = str_replace("M", "", $nm_data_hora); 
      $nm_data_hora = str_replace("D", "", $nm_data_hora); 
      $nm_data_hora = str_replace("H", "", $nm_data_hora); 
      $nm_data_hora = str_replace("I", "", $nm_data_hora); 
      $nm_data_hora = str_replace("S", "", $nm_data_hora); 
      $tmp_pos = strpos($nm_data_hora, "--");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("--", "-", $nm_data_hora); 
      }
      $tmp_pos = strpos($nm_data_hora, "::");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("::", ":", $nm_data_hora); 
      }
   }

   /**
    * @access  public
    */
   function retorna_pesq()
   {
      global $nm_apl_dependente;
   $NM_retorno = "./";
?>
<!DOCTYPE html>
<HTML>
<HEAD>
 <TITLE>Entregue - Em Dólar - Fornecedor: <?php echo $_SESSION['fornecedor_corrente'] ?> </TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY id="grid_search" class="scGridPage">
<FORM style="display:none;" name="form_ok" method="POST" action="<?php echo $NM_retorno; ?>" target="_self">
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="pesq"> 
</FORM>
<SCRIPT type="text/javascript">
 document.form_ok.submit();
</SCRIPT>
</BODY>
</HTML>
<?php
}

   /**
    * @access  public
    */
   function monta_html_ini()
   {
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Entregue - Em Dólar - Fornecedor: <?php echo $_SESSION['fornecedor_corrente'] ?> </TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery/js/jquery.js"></script>
          <?php 
           if ($_SESSION['scriptcase']['proc_mobile']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'search', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => false, 
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
    <script>
        $(document).ready(function(){
            bootstrapMobile();
        });
    </script>          <?php } ?>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput2.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Str_btn_filter_css ?>" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>cons_cta_corren_fornec_imp_entregue/cons_cta_corren_fornec_imp_entregue_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = '';
?>
<BODY id="grid_search" class="scFilterPage" style="<?php echo $vertical_center ?>">
<?php echo $this->Ini->Ajax_result_set ?>
   <script type="text/javascript">
     var applicationKeys = '';
     var hotkeyList = '';
     function execHotKey(e, h) {
         var hotkey_fired = false
         switch (true) {
         }
         if (hotkey_fired) {
             e.preventDefault();
             return false;
         } else {
             return true;
         }
     }
   </script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys.inc.js"></script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys_setup.js"></script>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="cons_cta_corren_fornec_imp_entregue_ajax_search.js"></script>
 <script type="text/javascript" src="cons_cta_corren_fornec_imp_entregue_ajax.js"></script>
 <script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
   var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax ?>';
   var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax ?>';
   var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax ?>';
   var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax ?>';
 </script>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<script type="text/javascript" src="cons_cta_corren_fornec_imp_entregue_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<?php
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
?>
<script type="text/javascript">
  var scSweetAlertConfirmButton = "<?php echo $confirmButtonClass ?>";
  var scSweetAlertCancelButton = "<?php echo $cancelButtonClass ?>";
  var scSweetAlertConfirmButtonText = "<?php echo $confirmButtonText ?>";
  var scSweetAlertCancelButtonText = "<?php echo $cancelButtonText ?>";
  var scSweetAlertConfirmButtonFA = "<?php echo $confirmButtonFA ?>";
  var scSweetAlertCancelButtonFA = "<?php echo $cancelButtonFA ?>";
  var scSweetAlertConfirmButtonFAPos = "<?php echo $confirmButtonFAPos ?>";
  var scSweetAlertCancelButtonFAPos = "<?php echo $cancelButtonFAPos ?>";
</script>
<script type="text/javascript">
$(function() {
<?php
if ((isset($this->nm_mens_alert) && count($this->nm_mens_alert)) || (isset($this->Ini->nm_mens_alert) && count($this->Ini->nm_mens_alert))) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
           } 
       }
   }
}
?>
});
</script>
<?php
if ('' != $this->Campos_Mens_erro) {
?>
<script type="text/javascript">
$(function() {
        _nmAjaxShowMessage({title: "<?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?>", message: "<?php echo $this->Campos_Mens_erro ?>", isModal: false, timeout: "", showButton: true, buttonLabel: "", topPos: "", leftPos: "", width: "", height: "", redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: false, isToast: false, toastPos: "", type: "error"});
});
</script>
<?php
}
?>
<script type="text/javascript" src="cons_cta_corren_fornec_imp_entregue_message.js"></script>
 <SCRIPT type="text/javascript">

<?php
if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
{
    $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
    foreach ($Tb_err_js as $Lines)
    {
        if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        echo $Lines;
    }
}
 $Msg_Inval = "Inv�lido";
 if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
 {
    $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
var SC_crit_inv = "<?php echo $Msg_Inval ?>";
var nmdg_Form = "F1";

function scJQCalendarAdd() {
  $("#sc_data_jq").datepicker({
    beforeShow: function(input, inst) {
          var_dt_ini  = document.getElementById('SC_data_dia').value + '/';
          var_dt_ini += document.getElementById('SC_data_mes').value + '/';
          var_dt_ini += document.getElementById('SC_data_ano').value;
          document.getElementById('sc_data_jq').value = var_dt_ini;
    },
    onClose: function(dateText, inst) {
          aParts  = dateText.split("/");
          document.getElementById('SC_data_dia').value = aParts[0];
          document.getElementById('SC_data_mes').value = aParts[1];
          document.getElementById('SC_data_ano').value = aParts[2];
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    monthNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/"); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image']; ?>",
    buttonImageOnly: true,
    currentText: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>"
  });

  $("#sc_data_jq2").datepicker({
    beforeShow: function(input, inst) {
          var_dt_ini  = document.getElementById('SC_data_input_2_dia').value + '/';
          var_dt_ini += document.getElementById('SC_data_input_2_mes').value + '/';
          var_dt_ini += document.getElementById('SC_data_input_2_ano').value;
          document.getElementById('sc_data_jq2').value = var_dt_ini;
    },
    onClose: function(dateText, inst) {
          aParts  = dateText.split("/");
          document.getElementById('SC_data_input_2_dia').value = aParts[0];
          document.getElementById('SC_data_input_2_mes').value = aParts[1];
          document.getElementById('SC_data_input_2_ano').value = aParts[2];
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    monthNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/"); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->Ini->path_botoes . "/" . $this->arr_buttons['bcalendario']['image']; ?>",
    buttonImageOnly: true,
    currentText: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>"
  });

} // scJQCalendarAdd


 $(function() {

   SC_carga_evt_jquery();
   scLoadScInput('input:text.sc-js-input');
   scJQCalendarAdd('');
 });
 function nm_campos_between(nm_campo, nm_cond, nm_nome_obj)
 {
  if (nm_cond.value == "bw") {
      nm_campo.style.display = "";
  }
  else {
      if (nm_campo) {
          nm_campo.style.display = "none";
      }
  }
  if (document.getElementById('id_hide_' + nm_nome_obj)) {
      if (nm_cond.value == "nu" || nm_cond.value == "nn" || nm_cond.value == "ep" || nm_cond.value == "ne") {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = 'none';
      }
      else {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = '';
      }
  }
 }
 function nm_save_form(pos)
 {
  if (pos == 'top' && document.F1.nmgp_save_name_top.value == '')
  {
      return;
  }
  if (pos == 'bot' && document.F1.nmgp_save_name_bot.value == '')
  {
      return;
  }
  if (pos == 'fields' && document.F1.nmgp_save_name_fields.value == '')
  {
      return;
  }
  var str_out = "";
  str_out += 'SC_data_cond#NMF#' + search_get_sel_txt('SC_data_cond') + '@NMF@';
  str_out += 'SC_data_dia#NMF#' + search_get_sel_txt('SC_data_dia') + '@NMF@';
  str_out += 'SC_data_mes#NMF#' + search_get_sel_txt('SC_data_mes') + '@NMF@';
  str_out += 'SC_data_ano#NMF#' + search_get_sel_txt('SC_data_ano') + '@NMF@';
  str_out += 'SC_data_input_2_dia#NMF#' + search_get_sel_txt('SC_data_input_2_dia') + '@NMF@';
  str_out += 'SC_data_input_2_mes#NMF#' + search_get_sel_txt('SC_data_input_2_mes') + '@NMF@';
  str_out += 'SC_data_input_2_ano#NMF#' + search_get_sel_txt('SC_data_input_2_ano') + '@NMF@';
  str_out += 'SC_vl_lancto_proporc_cond#NMF#' + search_get_sel_txt('SC_vl_lancto_proporc_cond') + '@NMF@';
  str_out += 'SC_vl_lancto_proporc#NMF#' + search_get_text('SC_vl_lancto_proporc') + '@NMF@';
  str_out += 'SC_item_proc_compra_id_cond#NMF#' + search_get_sel_txt('SC_item_proc_compra_id_cond') + '@NMF@';
  str_out += 'SC_item_proc_compra_id#NMF#' + search_get_text('SC_item_proc_compra_id') + '@NMF@';
  str_out += 'SC_data_hora_cond#NMF#' + search_get_sel_txt('SC_data_hora_cond') + '@NMF@';
  str_out += 'SC_data_hora#NMF#' + search_get_text('SC_data_hora') + '@NMF@';
  str_out += 'id_ac_data_hora#NMF#' + search_get_text('id_ac_data_hora') + '@NMF@';
  str_out += 'SC_historico_cond#NMF#' + search_get_sel_txt('SC_historico_cond') + '@NMF@';
  str_out += 'SC_historico#NMF#' + search_get_text('SC_historico') + '@NMF@';
  str_out += 'id_ac_historico#NMF#' + search_get_text('id_ac_historico') + '@NMF@';
  str_out += 'SC_cod_acao_cond#NMF#' + search_get_sel_txt('SC_cod_acao_cond') + '@NMF@';
  str_out += 'SC_cod_acao#NMF#' + search_get_checkbox('SC_cod_acao') + '@NMF@';
  str_out += 'SC_num_id_tit_ap_cond#NMF#' + search_get_sel_txt('SC_num_id_tit_ap_cond') + '@NMF@';
  str_out += 'SC_num_id_tit_ap#NMF#' + search_get_text('SC_num_id_tit_ap') + '@NMF@';
  str_out += 'SC_situacao_container_id_cond#NMF#' + search_get_sel_txt('SC_situacao_container_id_cond') + '@NMF@';
  str_out += 'SC_situacao_container_id#NMF#' + search_get_checkbox('SC_situacao_container_id') + '@NMF@';
  str_out += 'SC_proc_compra_id_cond#NMF#' + search_get_sel_txt('SC_proc_compra_id_cond') + '@NMF@';
  str_out += 'SC_proc_compra_id#NMF#' + search_get_text('SC_proc_compra_id') + '@NMF@';
  str_out += 'SC_container_cond#NMF#' + search_get_sel_txt('SC_container_cond') + '@NMF@';
  str_out += 'SC_container#NMF#' + search_get_text('SC_container') + '@NMF@';
  str_out += 'SC_cod_tipo_movto_cond#NMF#' + search_get_sel_txt('SC_cod_tipo_movto_cond') + '@NMF@';
  str_out += 'SC_cod_tipo_movto#NMF#' + search_get_checkbox('SC_cod_tipo_movto') + '@NMF@';
  str_out += 'SC_NM_operador#NMF#' + search_get_text('SC_NM_operador');
  str_out  = str_out.replace(/[+]/g, "__NM_PLUS__");
  str_out  = str_out.replace(/[&]/g, "__NM_AMP__");
  str_out  = str_out.replace(/[%]/g, "__NM_PRC__");
  var save_name = search_get_text('SC_nmgp_save_name_' + pos);
  var save_opt  = search_get_sel_txt('SC_nmgp_save_option_' + pos);
  ajax_save_filter(save_name, save_opt, str_out, pos);
 }
 function nm_submit_filter(obj_sel, pos)
 {
  index = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  ajax_select_filter(obj_sel.options[index].value);
 }
 function nm_submit_filter_del(pos)
 {
  obj_sel = document.F1.elements['NM_filters_del_' + pos];
  index   = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  parm = obj_sel.options[index].value;
  ajax_delete_filter(parm, pos);
 }
 function search_get_select(obj_id)
 {
    var index = document.getElementById(obj_id).selectedIndex;
    if (index != -1) {
        return document.getElementById(obj_id).options[index].value;
    }
    else {
        return '';
    }
 }
 function search_get_selmult(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
        if (obj[iSelect].selected)
        {
            val += "#NMARR#" + obj[iSelect].value;
        }
    }
    return val;
 }
 function search_get_Dselelect(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
         val += "#NMARR#" + obj[iSelect].value;
    }
    return val;
 }
 function search_get_radio(obj_id)
 {
    var val  = "";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       for (iRadio = 0; iRadio < obj.length; iRadio++) {
           if (obj[iRadio].checked) {
               val = obj[iRadio].value;
           }
       }
    }
    return val;
 }
 function search_get_checkbox(obj_id)
 {
    var val  = "_NM_array_";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       if (!obj.length) {
           if (obj.checked) {
               val += "#NMARR#" + obj.value;
           }
       }
       else {
           for (iCheck = 0; iCheck < obj.length; iCheck++) {
               if (obj[iCheck].checked) {
                   val += "#NMARR#" + obj[iCheck].value;
               }
           }
       }
    }
    return val;
 }
 function search_get_text(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.value : '';
 }
 function search_get_title(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.title : '';
 }
 function search_get_sel_txt(obj_id)
 {
    var val = "";
    obj_part  = document.getElementById(obj_id);
    if (obj_part && obj_part.type.substr(0, 6) == 'select')
    {
        val = search_get_select(obj_id);
    }
    else
    {
        val = (obj_part) ? obj_part.value : '';
    }
    return val;
 }
 function search_get_html(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return obj.innerHTML;
 }
function nm_open_popup(parms)
{
    NovaJanela = window.open (parms, '', 'resizable, scrollbars');
}
 </SCRIPT>
<script type="text/javascript">
 $(function() {
   scClass = $("#id_ac_historico").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_historico").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_historico",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_historico").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_historico").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_data_hora").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_data_hora").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_data_hora",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_data_hora").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_data_hora").val( $(this).val() );
       }
     }
   });
 });
</script>
 <FORM name="F1" action="./" method="post" target="_self"> 
 <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 <INPUT type="hidden" name="nmgp_opcao" value="busca"> 
 <div id="idJSSpecChar" style="display:none;"></div>
 <div id="id_div_process" style="display: none; position: absolute"><table class="scFilterTable"><tr><td class="scFilterLabelOdd"><?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</td></tr></table></div>
 <div id="id_fatal_error" class="scFilterFieldOdd" style="display:none; position: absolute"></div>
<TABLE id="main_table" align="center" valign="top" >
<tr>
<td>
<div class="scFilterBorder">
  <div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs'] ?>...</span></div>
<table cellspacing=0 cellpadding=0 width='100%'>
<?php
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   /**
    * @access  public
    */
   function monta_cabecalho()
   {
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['dashboard_info']['compact_mode'])
      {
          return;
      }
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
?>
 <TR align="center">
  <TD class="scFilterTableTd scGridPage">
<style>
#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 
#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}
</style>

<div style="width: 100%">
 <div class="scFilterHeader" style="height:11px; display: block; border-width:0px; "></div>
 <div style="height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block">
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFilterHeaderFont"><span>Entregue - Em Dólar - Fornecedor: <?php echo $_SESSION['fornecedor_corrente'] ?> </span></td>
            <td id="lin1_col2" class="scFilterHeaderFont"><span><?php echo $nm_data_fixa; ?></span></td>
        </tr>
    </table>		 
 </div>
</div>
  </TD>
 </TR>
<?php
   }

   /**
    * @access  public
    * @global  string  $nm_url_saida  $this->Ini->Nm_lang['pesq_global_nm_url_saida']
    * @global  integer  $nm_apl_dependente  $this->Ini->Nm_lang['pesq_global_nm_apl_dependente']
    * @global  string  $nmgp_parms  
    * @global  string  $bprocessa  $this->Ini->Nm_lang['pesq_global_bprocessa']
    */
   function monta_form()
   {
      global 
             $data_cond, $data, $data_dia, $data_mes, $data_ano, $data_input_2_dia, $data_input_2_mes, $data_input_2_ano,
             $vl_lancto_proporc_cond, $vl_lancto_proporc,
             $item_proc_compra_id_cond, $item_proc_compra_id,
             $data_hora_cond, $data_hora, $data_hora_autocomp,
             $historico_cond, $historico, $historico_autocomp,
             $cod_acao_cond, $cod_acao,
             $num_id_tit_ap_cond, $num_id_tit_ap,
             $situacao_container_id_cond, $situacao_container_id,
             $proc_compra_id_cond, $proc_compra_id,
             $container_cond, $container,
             $cod_tipo_movto_cond, $cod_tipo_movto,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("cons_cta_corren_fornec_imp_entregue", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $data_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_dia']; 
          $data_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_mes']; 
          $data_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_ano']; 
          $data_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_dia']; 
          $data_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_mes']; 
          $data_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_ano']; 
          $data_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_cond']; 
          $vl_lancto_proporc = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['vl_lancto_proporc']; 
          $vl_lancto_proporc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['vl_lancto_proporc_cond']; 
          $item_proc_compra_id = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['item_proc_compra_id']; 
          $item_proc_compra_id_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['item_proc_compra_id_cond']; 
          $data_hora = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_hora']; 
          $data_hora_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_hora_cond']; 
          $historico = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['historico']; 
          $historico_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['historico_cond']; 
          $cod_acao = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_acao']; 
          $cod_acao_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_acao_cond']; 
          $num_id_tit_ap = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['num_id_tit_ap']; 
          $num_id_tit_ap_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['num_id_tit_ap_cond']; 
          $situacao_container_id = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['situacao_container_id']; 
          $situacao_container_id_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['situacao_container_id_cond']; 
          $proc_compra_id = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['proc_compra_id']; 
          $proc_compra_id_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['proc_compra_id_cond']; 
          $container = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['container']; 
          $container_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['container_cond']; 
          $cod_tipo_movto = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_tipo_movto']; 
          $cod_tipo_movto_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_tipo_movto_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['NM_operador']; 
          if (strtoupper($vl_lancto_proporc_cond) != "II" && strtoupper($vl_lancto_proporc_cond) != "QP" && strtoupper($vl_lancto_proporc_cond) != "NP" && strtoupper($vl_lancto_proporc_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($vl_lancto_proporc, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($item_proc_compra_id_cond) != "II" && strtoupper($item_proc_compra_id_cond) != "QP" && strtoupper($item_proc_compra_id_cond) != "NP" && strtoupper($item_proc_compra_id_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($item_proc_compra_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($num_id_tit_ap_cond) != "II" && strtoupper($num_id_tit_ap_cond) != "QP" && strtoupper($num_id_tit_ap_cond) != "NP" && strtoupper($num_id_tit_ap_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($num_id_tit_ap, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($proc_compra_id_cond) != "II" && strtoupper($proc_compra_id_cond) != "QP" && strtoupper($proc_compra_id_cond) != "NP" && strtoupper($proc_compra_id_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($proc_compra_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($container_cond) != "II" && strtoupper($container_cond) != "QP" && strtoupper($container_cond) != "NP" && strtoupper($container_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($container, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
      } 
      if (!isset($data_cond) || empty($data_cond))
      {
         $data_cond = "eq";
      }
      if (!isset($vl_lancto_proporc_cond) || empty($vl_lancto_proporc_cond))
      {
         $vl_lancto_proporc_cond = "gt";
      }
      if (!isset($item_proc_compra_id_cond) || empty($item_proc_compra_id_cond))
      {
         $item_proc_compra_id_cond = "gt";
      }
      if (!isset($data_hora_cond) || empty($data_hora_cond))
      {
         $data_hora_cond = "qp";
      }
      if (!isset($historico_cond) || empty($historico_cond))
      {
         $historico_cond = "qp";
      }
      if (!isset($cod_acao_cond) || empty($cod_acao_cond))
      {
         $cod_acao_cond = "gt";
      }
      if (!isset($num_id_tit_ap_cond) || empty($num_id_tit_ap_cond))
      {
         $num_id_tit_ap_cond = "gt";
      }
      if (!isset($situacao_container_id_cond) || empty($situacao_container_id_cond))
      {
         $situacao_container_id_cond = "gt";
      }
      if (!isset($proc_compra_id_cond) || empty($proc_compra_id_cond))
      {
         $proc_compra_id_cond = "gt";
      }
      if (!isset($container_cond) || empty($container_cond))
      {
         $container_cond = "gt";
      }
      if (!isset($cod_tipo_movto_cond) || empty($cod_tipo_movto_cond))
      {
         $cod_tipo_movto_cond = "gt";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_data = (in_array($data_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_vl_lancto_proporc = (in_array($vl_lancto_proporc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_item_proc_compra_id = (in_array($item_proc_compra_id_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_data_hora = (in_array($data_hora_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_historico = (in_array($historico_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_acao = (in_array($cod_acao_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_num_id_tit_ap = (in_array($num_id_tit_ap_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_situacao_container_id = (in_array($situacao_container_id_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_proc_compra_id = (in_array($proc_compra_id_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_container = (in_array($container_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_tipo_movto = (in_array($cod_tipo_movto_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_data = ('bw' == $data_cond) ? $display_aberto : $display_fechado;
      $str_display_vl_lancto_proporc = ('bw' == $vl_lancto_proporc_cond) ? $display_aberto : $display_fechado;
      $str_display_item_proc_compra_id = ('bw' == $item_proc_compra_id_cond) ? $display_aberto : $display_fechado;
      $str_display_data_hora = ('bw' == $data_hora_cond) ? $display_aberto : $display_fechado;
      $str_display_historico = ('bw' == $historico_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_acao = ('bw' == $cod_acao_cond) ? $display_aberto : $display_fechado;
      $str_display_num_id_tit_ap = ('bw' == $num_id_tit_ap_cond) ? $display_aberto : $display_fechado;
      $str_display_situacao_container_id = ('bw' == $situacao_container_id_cond) ? $display_aberto : $display_fechado;
      $str_display_proc_compra_id = ('bw' == $proc_compra_id_cond) ? $display_aberto : $display_fechado;
      $str_display_container = ('bw' == $container_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_tipo_movto = ('bw' == $cod_tipo_movto_cond) ? $display_aberto : $display_fechado;

      // cod_acao
      if (is_array($cod_acao) && !empty($cod_acao))
      {
         $tmp_array = array();
         $cod_acao_val_str = "";
         foreach ($cod_acao as $tmp_val_cmp)
         {
            if ("" != $cod_acao_val_str)
            {
               $cod_acao_val_str .= ",";
            }
            $tmp_pos = (is_string($tmp_val_cmp)) ? strpos($tmp_val_cmp, "##@@") : false;
            if ($tmp_pos === false)
            {
                $tmp_array[] = $tmp_val_cmp;
            }
            else
            {
                $tmp_val_cmp = substr($tmp_val_cmp, 0, $tmp_pos);
                $tmp_array[] = $tmp_val_cmp;
            }
            $cod_acao_val_str .= "'$tmp_val_cmp'";
         }
         $cod_acao = $tmp_array;
      }
      else
      {
         $cod_acao_val_str = "";
      }
      // situacao_container_id
      if (is_array($situacao_container_id) && !empty($situacao_container_id))
      {
         $tmp_array = array();
         $situacao_container_id_val_str = "";
         foreach ($situacao_container_id as $tmp_val_cmp)
         {
            if ("" != $situacao_container_id_val_str)
            {
               $situacao_container_id_val_str .= ",";
            }
            $tmp_pos = (is_string($tmp_val_cmp)) ? strpos($tmp_val_cmp, "##@@") : false;
            if ($tmp_pos === false)
            {
                $tmp_array[] = $tmp_val_cmp;
            }
            else
            {
                $tmp_val_cmp = substr($tmp_val_cmp, 0, $tmp_pos);
                $tmp_array[] = $tmp_val_cmp;
            }
            $situacao_container_id_val_str .= "'$tmp_val_cmp'";
         }
         $situacao_container_id = $tmp_array;
      }
      else
      {
         $situacao_container_id_val_str = "";
      }
      // cod_tipo_movto
      if (is_array($cod_tipo_movto) && !empty($cod_tipo_movto))
      {
         $tmp_array = array();
         $cod_tipo_movto_val_str = "";
         foreach ($cod_tipo_movto as $tmp_val_cmp)
         {
            if ("" != $cod_tipo_movto_val_str)
            {
               $cod_tipo_movto_val_str .= ",";
            }
            $tmp_pos = (is_string($tmp_val_cmp)) ? strpos($tmp_val_cmp, "##@@") : false;
            if ($tmp_pos === false)
            {
                $tmp_array[] = $tmp_val_cmp;
            }
            else
            {
                $tmp_val_cmp = substr($tmp_val_cmp, 0, $tmp_pos);
                $tmp_array[] = $tmp_val_cmp;
            }
            $cod_tipo_movto_val_str .= "'$tmp_val_cmp'";
         }
         $cod_tipo_movto = $tmp_array;
      }
      else
      {
         $cod_tipo_movto_val_str = "";
      }
      if (!isset($data) || $data == "")
      {
          $data = "";
      }
      if (isset($data) && !empty($data))
      {
         $tmp_pos = (is_string($data)) ? strpos($data, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $data = substr($data, 0, $tmp_pos);
         }
      }
      if (!isset($vl_lancto_proporc) || $vl_lancto_proporc == "")
      {
          $vl_lancto_proporc = "";
      }
      if (isset($vl_lancto_proporc) && !empty($vl_lancto_proporc))
      {
         $tmp_pos = (is_string($vl_lancto_proporc)) ? strpos($vl_lancto_proporc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $vl_lancto_proporc = substr($vl_lancto_proporc, 0, $tmp_pos);
         }
      }
      if (!isset($item_proc_compra_id) || $item_proc_compra_id == "")
      {
          $item_proc_compra_id = "";
      }
      if (isset($item_proc_compra_id) && !empty($item_proc_compra_id))
      {
         $tmp_pos = (is_string($item_proc_compra_id)) ? strpos($item_proc_compra_id, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $item_proc_compra_id = substr($item_proc_compra_id, 0, $tmp_pos);
         }
      }
      if (!isset($data_hora) || $data_hora == "")
      {
          $data_hora = "";
      }
      if (isset($data_hora) && !empty($data_hora))
      {
         $tmp_pos = (is_string($data_hora)) ? strpos($data_hora, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $data_hora = substr($data_hora, 0, $tmp_pos);
         }
      }
      if (!isset($historico) || $historico == "")
      {
          $historico = "";
      }
      if (isset($historico) && !empty($historico))
      {
         $tmp_pos = (is_string($historico)) ? strpos($historico, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $historico = substr($historico, 0, $tmp_pos);
         }
      }
      if (!isset($cod_acao) || $cod_acao == "")
      {
          $cod_acao = array();
      }
      if (!isset($num_id_tit_ap) || $num_id_tit_ap == "")
      {
          $num_id_tit_ap = "";
      }
      if (isset($num_id_tit_ap) && !empty($num_id_tit_ap))
      {
         $tmp_pos = (is_string($num_id_tit_ap)) ? strpos($num_id_tit_ap, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $num_id_tit_ap = substr($num_id_tit_ap, 0, $tmp_pos);
         }
      }
      if (!isset($situacao_container_id) || $situacao_container_id == "")
      {
          $situacao_container_id = array();
      }
      if (!isset($proc_compra_id) || $proc_compra_id == "")
      {
          $proc_compra_id = "";
      }
      if (isset($proc_compra_id) && !empty($proc_compra_id))
      {
         $tmp_pos = (is_string($proc_compra_id)) ? strpos($proc_compra_id, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $proc_compra_id = substr($proc_compra_id, 0, $tmp_pos);
         }
      }
      if (!isset($container) || $container == "")
      {
          $container = "";
      }
      if (isset($container) && !empty($container))
      {
         $tmp_pos = (is_string($container)) ? strpos($container, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $container = substr($container, 0, $tmp_pos);
         }
      }
      if (!isset($cod_tipo_movto) || $cod_tipo_movto == "")
      {
          $cod_tipo_movto = array();
      }
?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="70%" height="">
   <DIV class="scBlockFrame">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
   <tr valign="top">





      <TD id='SC_data_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_data_cond" name="data_cond" onChange="nm_campos_between(document.getElementById('id_vis_data'), this, 'data')">
       <OPTION value="eq" <?php if ("eq" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data" <?php echo $str_hide_data?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data";
 $nmgp_tab_label .= "data?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "ddmmyyyy";
  $date_format_show = "";
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
  $Arr_format = $Arr_D;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_dia" name="data_dia" value="<?php echo NM_encode_input($data_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq">
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_mes" name="data_mes" value="<?php echo NM_encode_input($data_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq">
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_ano" name="data_ano" value="<?php echo NM_encode_input($data_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq">
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_data"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_data"  <?php echo $str_display_data; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_input_2_dia" name="data_input_2_dia" value="<?php echo NM_encode_input($data_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq2">
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_input_2_mes" name="data_input_2_mes" value="<?php echo NM_encode_input($data_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq2">
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_data_input_2_ano" name="data_input_2_ano" value="<?php echo NM_encode_input($data_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<INPUT type="hidden" id="sc_data_jq2">
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_vl_lancto_proporc_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['vl_lancto_proporc'])) ? $this->New_label['vl_lancto_proporc'] : "Vl.Lancto"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_vl_lancto_proporc_cond" name="vl_lancto_proporc_cond" onChange="nm_campos_between(document.getElementById('id_vis_vl_lancto_proporc'), this, 'vl_lancto_proporc')">
       <OPTION value="gt" <?php if ("gt" == $vl_lancto_proporc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $vl_lancto_proporc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $vl_lancto_proporc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_vl_lancto_proporc" <?php echo $str_hide_vl_lancto_proporc?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['vl_lancto_proporc'])) ? $this->New_label['vl_lancto_proporc'] : "Vl.Lancto";
 $nmgp_tab_label .= "vl_lancto_proporc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_vl_lancto_proporc" name="vl_lancto_proporc" value="<?php echo NM_encode_input($vl_lancto_proporc) ?>" size=41 alt="{datatype: 'decimal', maxLength: 41, precision: 2, decimalSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['dec_num'] ?>', thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_item_proc_compra_id_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['item_proc_compra_id'])) ? $this->New_label['item_proc_compra_id'] : "Item Ped.Imp."; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_item_proc_compra_id_cond" name="item_proc_compra_id_cond" onChange="nm_campos_between(document.getElementById('id_vis_item_proc_compra_id'), this, 'item_proc_compra_id')">
       <OPTION value="gt" <?php if ("gt" == $item_proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $item_proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $item_proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_item_proc_compra_id" <?php echo $str_hide_item_proc_compra_id?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['item_proc_compra_id'])) ? $this->New_label['item_proc_compra_id'] : "Item Ped.Imp.";
 $nmgp_tab_label .= "item_proc_compra_id?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_item_proc_compra_id" name="item_proc_compra_id" value="<?php echo NM_encode_input($item_proc_compra_id) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_data_hora_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['data_hora'])) ? $this->New_label['data_hora'] : "Data Hora"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_data_hora_cond" name="data_hora_cond" onChange="nm_campos_between(document.getElementById('id_vis_data_hora'), this, 'data_hora')">
       <OPTION value="qp" <?php if ("qp" == $data_hora_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $data_hora_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $data_hora_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $data_hora_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data_hora" <?php echo $str_hide_data_hora?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['data_hora'])) ? $this->New_label['data_hora'] : "Data Hora";
 $nmgp_tab_label .= "data_hora?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($data_hora != "")
      {
      $data_hora_look = (is_string($data_hora) ? substr($this->Db->qstr($data_hora), 1, -1) : $data_hora); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct data_hora from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where data_hora = '$data_hora_look'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$data_hora]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$data_hora];
      }
      else
      {
          $sAutocompValue = $data_hora;
      }
?>
<INPUT  type="text" id="SC_data_hora" name="data_hora" value="<?php echo NM_encode_input($data_hora) ?>"  size=23 alt="{datatype: 'text', maxLength: 23, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_data_hora" name="data_hora_autocomp" size="23"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 23, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_historico_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_historico_cond" name="historico_cond" onChange="nm_campos_between(document.getElementById('id_vis_historico'), this, 'historico')">
       <OPTION value="qp" <?php if ("qp" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_historico" <?php echo $str_hide_historico?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico";
 $nmgp_tab_label .= "historico?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($historico != "")
      {
      $historico_look = (is_string($historico) ? substr($this->Db->qstr($historico), 1, -1) : $historico); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct historico from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where historico = '$historico_look'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$historico]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$historico];
      }
      else
      {
          $sAutocompValue = $historico;
      }
?>
<INPUT  type="text" id="SC_historico" name="historico" value="<?php echo NM_encode_input($historico) ?>"  size=50 alt="{datatype: 'text', maxLength: 4000, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_historico" name="historico_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 4000, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_cod_acao_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['cod_acao'])) ? $this->New_label['cod_acao'] : "Ação"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_cod_acao_cond" name="cod_acao_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_acao'), this, 'cod_acao')">
       <OPTION value="eq" <?php if ("eq" == $cod_acao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cod_acao" <?php echo $str_hide_cod_acao?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['cod_acao'])) ? $this->New_label['cod_acao'] : "Ação";
 $nmgp_tab_label .= "cod_acao?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
 
<?php
  if (!isset($cod_acao)) {$cod_acao = explode(";", $cod_acao);}
 ?>
 
<?php
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_acao'] = array();
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_acao'][] = "1";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_acao'][] = "2";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_acao'][] = "3";
 ?>

<TABLE style="padding: 0px; spacing: 0px; border-width: 0px; border-spacing: 0px;"><TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_cod_acao" name="cod_acao[]" value="1##@@Inclusão"  <?php if (in_array("1", $cod_acao))  { echo " checked" ;} ?>>Inclusão</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_cod_acao" name="cod_acao[]" value="2##@@Alteração"  <?php if (in_array("2", $cod_acao))  { echo " checked" ;} ?>>Alteração</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_cod_acao" name="cod_acao[]" value="3##@@Exclusão"  <?php if (in_array("3", $cod_acao))  { echo " checked" ;} ?>>Exclusão</TD>
</TR></TABLE>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_num_id_tit_ap_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['num_id_tit_ap'])) ? $this->New_label['num_id_tit_ap'] : "Título AP"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_num_id_tit_ap_cond" name="num_id_tit_ap_cond" onChange="nm_campos_between(document.getElementById('id_vis_num_id_tit_ap'), this, 'num_id_tit_ap')">
       <OPTION value="gt" <?php if ("gt" == $num_id_tit_ap_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $num_id_tit_ap_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $num_id_tit_ap_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_num_id_tit_ap" <?php echo $str_hide_num_id_tit_ap?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['num_id_tit_ap'])) ? $this->New_label['num_id_tit_ap'] : "Título AP";
 $nmgp_tab_label .= "num_id_tit_ap?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_num_id_tit_ap" name="num_id_tit_ap" value="<?php echo NM_encode_input($num_id_tit_ap) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_situacao_container_id_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['situacao_container_id'])) ? $this->New_label['situacao_container_id'] : "Situação Container"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_situacao_container_id_cond" name="situacao_container_id_cond" onChange="nm_campos_between(document.getElementById('id_vis_situacao_container_id'), this, 'situacao_container_id')">
       <OPTION value="eq" <?php if ("eq" == $situacao_container_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_situacao_container_id" <?php echo $str_hide_situacao_container_id?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['situacao_container_id'])) ? $this->New_label['situacao_container_id'] : "Situação Container";
 $nmgp_tab_label .= "situacao_container_id?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
      $situacao_container_id_look = (is_string($situacao_container_id) ? substr($this->Db->qstr($situacao_container_id), 1, -1) : $situacao_container_id); 
      $nmgp_def_dados = "" ; 
      $nm_comando = "SELECT descricao, log_gerar_distr_custo  FROM PUB.situacoes_container  ORDER BY log_gerar_distr_custo"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['situacao_container_id'] = array();
         while (!$rs->EOF) 
         { 
            $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['situacao_container_id'][] = trim($rs->fields[0]);
            $nmgp_def_dados .= trim($rs->fields[1]) . "?#?" ; 
            $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?" ; 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      $i = 0;
      $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
      $nm_opcoes  = explode("?@?", $nm_opcoesx);
      echo "<span id=\"idAjaxCheckbox_situacao_container_id\">\r\n";
      echo "        <TABLE border=\"0px\" cellpadding=\"0px\">\r\n";
      echo "         <TR>\r\n";
      if (!isset($situacao_container_id) || !is_array($situacao_container_id))
      {
         $situacao_container_id = array();
      }
      for ($j = 0; $j < sizeof($nm_opcoes); $j++)
      {
         if (!empty($nm_opcoes[$j]))
         {
            $temp_bug_list = explode("?#?", $nm_opcoes[$j]);
            list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
            if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
            $tmp_cmp_click = "";
            $tmp_cmp_sel = "";
            foreach ($situacao_container_id as $Dados)
            {
                if ($Dados === $nm_opc_cod)
                {
                    $tmp_cmp_sel = "checked";
                    break;
                }
            }
            echo "          <TD class=\"scFilterFieldFontEven\">\r\n";
            echo "           <INPUT class=\"scFilterObjectEven\" type=\"checkbox\" id=\"SC_situacao_container_id\" name=\"situacao_container_id[]\" value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\" $tmp_cmp_sel $tmp_cmp_click>$nm_opc_val\r\n";
            echo "          </TD>\r\n";
            $i++;
            if (1 == $i && $j < sizeof($nm_opcoes) - 1)
            {
               echo "         </TR>\r\n";
               echo "         <TR>\r\n";
               $i = 0;
            }
         }
      }
      echo "         </TR>\r\n";
      echo "        </TABLE>\r\n";
      echo "</span>\r\n";
?>
        
        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_proc_compra_id_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['proc_compra_id'])) ? $this->New_label['proc_compra_id'] : "Ped. Importação"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_proc_compra_id_cond" name="proc_compra_id_cond" onChange="nm_campos_between(document.getElementById('id_vis_proc_compra_id'), this, 'proc_compra_id')">
       <OPTION value="gt" <?php if ("gt" == $proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $proc_compra_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_proc_compra_id" <?php echo $str_hide_proc_compra_id?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['proc_compra_id'])) ? $this->New_label['proc_compra_id'] : "Ped. Importação";
 $nmgp_tab_label .= "proc_compra_id?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_proc_compra_id" name="proc_compra_id" value="<?php echo NM_encode_input($proc_compra_id) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">
<?php
  if (isset($this->Ini->sc_lig_md5["cons_procs_compra"]) && $this->Ini->sc_lig_md5["cons_procs_compra"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,proc_compra_id,proc_compra_id*scoutnmgp_perm_edit*scinN*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_fornec_imp_entregue@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,proc_compra_id,proc_compra_id*scoutnmgp_perm_edit*scinN*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_procs_compra_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_procs_compra_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>


        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_container_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_container_cond" name="container_cond" onChange="nm_campos_between(document.getElementById('id_vis_container'), this, 'container')">
       <OPTION value="gt" <?php if ("gt" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_container" <?php echo $str_hide_container?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container";
 $nmgp_tab_label .= "container?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_container" name="container" value="<?php echo NM_encode_input($container) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
<?php
  if (isset($this->Ini->sc_lig_md5["grid_pp_container"]) && $this->Ini->sc_lig_md5["grid_pp_container"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,container,nr-container*scoutnmgp_perm_edit*scinN*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_fornec_imp_entregue@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,container,nr-container*scoutnmgp_perm_edit*scinN*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_grid_pp_container_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_grid_pp_container_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>


        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr>
   </TABLE>
   </DIV>
  </TD>
  <TD width="30%" height="">
   <DIV class="scBlockFrame">
   <TABLE class="scFilterTable" id="hidden_bloco_1" valign="top" width="100%" style="height: 100%;">
<?php
     $Img_tit_blk_i = "";
     $Img_tit_blk_f = "";
?>

    <TR>
     <TD colspan="3" height="20" class="scFilterBlockBack">
      <TABLE border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
       <TR>
        <TD class="scFilterBlockFont css_blk_1"><?php echo $Img_tit_blk_i ?>Tipo Movto.<?php echo $Img_tit_blk_f ?></TD>
         
       </TR>
      </TABLE>
     </TD>
    </TR>
   <tr valign="top">





     
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cod_tipo_movto_cond" name="cod_tipo_movto_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_tipo_movto'), this, 'cod_tipo_movto')">
       <OPTION value="eq" <?php if ("eq" == $cod_tipo_movto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cod_tipo_movto" <?php echo $str_hide_cod_tipo_movto?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cod_tipo_movto'])) ? $this->New_label['cod_tipo_movto'] : "Tp.Movto";
 $nmgp_tab_label .= "cod_tipo_movto?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
 
<?php
  if (!isset($cod_tipo_movto)) {$cod_tipo_movto = explode(";", $cod_tipo_movto);}
 ?>
 
<?php
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'] = array();
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "1";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "2";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "3";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "4";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "5";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "6";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "7";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "8";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "9";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'][] = "10";
 ?>

<TABLE style="padding: 0px; spacing: 0px; border-width: 0px; border-spacing: 0px;"><TR>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="1##@@Saldo Anterior"  <?php if (in_array("1", $cod_tipo_movto))  { echo " checked" ;} ?>>Saldo Anterior</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="2##@@Ajuste Manual"  <?php if (in_array("2", $cod_tipo_movto))  { echo " checked" ;} ?>>Ajuste Manual</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="3##@@Itens Pedido"  <?php if (in_array("3", $cod_tipo_movto))  { echo " checked" ;} ?>>Itens Pedido</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="4##@@Pgtos Pedido"  <?php if (in_array("4", $cod_tipo_movto))  { echo " checked" ;} ?>>Pgtos Pedido</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="5##@@Pgtos Container"  <?php if (in_array("5", $cod_tipo_movto))  { echo " checked" ;} ?>>Pgtos Container</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="6##@@Desc.Solicitado"  <?php if (in_array("6", $cod_tipo_movto))  { echo " checked" ;} ?>>Desc.Solicitado</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="7##@@Desconto Autorizado"  <?php if (in_array("7", $cod_tipo_movto))  { echo " checked" ;} ?>>Desconto Autorizado</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="8##@@Desconto Utilizado"  <?php if (in_array("8", $cod_tipo_movto))  { echo " checked" ;} ?>>Desconto Utilizado</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="9##@@Rateio Entre Fornecedores"  <?php if (in_array("9", $cod_tipo_movto))  { echo " checked" ;} ?>>Rateio Entre Fornecedores</TD>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_cod_tipo_movto" name="cod_tipo_movto[]" value="10##@@Confirmação Qt. Embarcada"  <?php if (in_array("10", $cod_tipo_movto))  { echo " checked" ;} ?>>Confirmação Qt. Embarcada</TD>
</TR></TABLE>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr>
   </TABLE>
   </DIV>
  </TD>
 </TR>
 </TABLE>
 </TD>
 </TR>
 <TR>
  <TD class="scFilterTableTd" align="center">
<INPUT type="hidden" id="SC_NM_operador" name="NM_operador" value="and">  </TD>
 </TR>
   <INPUT type="hidden" name="nmgp_tab_label" value="<?php echo NM_encode_input($nmgp_tab_label); ?>"> 
   <INPUT type="hidden" name="bprocessa" value="pesq"> 
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['pesq_tab_label'] = $nmgp_tab_label;
?>
 <?php
     if ($_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select      = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("cons_cta_corren_fornec_imp_entregue_help.txt"))
   {
      $Arq_WebHelp = file("cons_cta_corren_fornec_imp_entregue_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
     if (!$_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select      = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("cons_cta_corren_fornec_imp_entregue_help.txt"))
   {
      $Arq_WebHelp = file("cons_cta_corren_fornec_imp_entregue_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
<?php
   }

   function monta_html_fim()
   {
       global $bprocessa, $nm_url_saida, $Script_BI;
?>

</TABLE>
   <INPUT type="hidden" name="form_condicao" value="3">
</FORM> 
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_fornec_imp_entregue']['start'] == 'filter')
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
<?php
   }
   else
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="./" target="_self"> 
<?php
   }
?>
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['orig_pesq'] == "grid")
   {
       $Ret_cancel_pesq = "volta_grid";
   }
   else
   {
       $Ret_cancel_pesq = "resumo";
   }
?>
   <INPUT type="hidden" name="nmgp_opcao" value="<?php echo $Ret_cancel_pesq; ?>"> 
   </FORM> 
 <form name="FCAP" action="" method="post" target="_blank"> 
   <input type="hidden" name="SC_lig_apl_orig" value="cons_cta_corren_fornec_imp_entregue"/>
   <input type="hidden" name="nmgp_url_saida" value=""> 
   <input type="hidden" name="nmgp_parms" value=""> 
   <input type="hidden" name="nmgp_outra_jan" value="true"> 
   <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 </form> 
<SCRIPT type="text/javascript">
 function nm_submit_cap(apl_dest, parms)
 {
    document.FCAP.action = apl_dest;
    document.FCAP.nmgp_parms.value = parms;
    window.open('','jan_cap','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
    document.FCAP.target = "jan_cap"; 
    document.FCAP.submit();
 }
<?php
   if (empty($this->NM_fil_ant))
   {
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
       }
       else
       {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
       }
   }
?>
 function nm_move()
 {
     document.form_cancel.target = "_self"; 
     document.form_cancel.action = "./"; 
     document.form_cancel.submit(); 
 }
 function nm_submit_form()
 {
    document.F1.submit();
 }
 function limpa_form()
 {
   document.F1.reset();
   if (document.F1.NM_filters)
   {
       document.F1.NM_filters.selectedIndex = -1;
   }
   document.getElementById('Salvar_filters_bot').style.display = 'none';
   document.F1.data_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_data'), document.F1.data_cond, 'data');
   document.F1.data_dia.value = "";
   document.F1.data_mes.value = "";
   document.F1.data_ano.value = "";
   document.F1.data_input_2_dia.value = "";
   document.F1.data_input_2_mes.value = "";
   document.F1.data_input_2_ano.value = "";
   document.F1.vl_lancto_proporc_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_vl_lancto_proporc'), document.F1.vl_lancto_proporc_cond, 'vl_lancto_proporc');
   document.F1.vl_lancto_proporc.value = "";
   document.F1.item_proc_compra_id_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_item_proc_compra_id'), document.F1.item_proc_compra_id_cond, 'item_proc_compra_id');
   document.F1.item_proc_compra_id.value = "";
   document.F1.data_hora_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_data_hora'), document.F1.data_hora_cond, 'data_hora');
   document.F1.data_hora.value = "";
   document.F1.data_hora_autocomp.value = "";
   document.F1.historico_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_historico'), document.F1.historico_cond, 'historico');
   document.F1.historico.value = "";
   document.F1.historico_autocomp.value = "";
   document.F1.cod_acao_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_acao'), document.F1.cod_acao_cond, 'cod_acao');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'cod_acao[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
   document.F1.num_id_tit_ap_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_num_id_tit_ap'), document.F1.num_id_tit_ap_cond, 'num_id_tit_ap');
   document.F1.num_id_tit_ap.value = "";
   document.F1.situacao_container_id_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_situacao_container_id'), document.F1.situacao_container_id_cond, 'situacao_container_id');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'situacao_container_id[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
   document.F1.proc_compra_id_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_proc_compra_id'), document.F1.proc_compra_id_cond, 'proc_compra_id');
   document.F1.proc_compra_id.value = "";
   document.F1.container_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_container'), document.F1.container_cond, 'container');
   document.F1.container.value = "";
   document.F1.cod_tipo_movto_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_tipo_movto'), document.F1.cod_tipo_movto_cond, 'cod_tipo_movto');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'cod_tipo_movto[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_data_dia').bind('change', function() {sc_cons_cta_corren_fornec_imp_entregue_valida_dia(this)});
    $('#SC_data_input_2_dia').bind('change', function() {sc_cons_cta_corren_fornec_imp_entregue_valida_dia(this)});
    $('#SC_data_input_2_mes').bind('change', function() {sc_cons_cta_corren_fornec_imp_entregue_valida_mes(this)});
    $('#SC_data_mes').bind('change', function() {sc_cons_cta_corren_fornec_imp_entregue_valida_mes(this)});
 }
 function sc_cons_cta_corren_fornec_imp_entregue_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_cons_cta_corren_fornec_imp_entregue_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
   function process_hotkeys(hotkey)
   {
   return false;
   }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "Importacao/cons_cta_corren_fornec_imp_entregue";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                         $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                 }
                 $this->NM_fil_ant[$NM_arq][2] = $Name_filter;
             }
           }
       }
       return $this->NM_fil_ant;
   }
   /**
    * @access  public
    * @param  string  $NM_operador  $this->Ini->Nm_lang['pesq_global_NM_operador']
    * @param  array  $nmgp_tab_label  
    */
   function inicializa_vars()
   {
      global $NM_operador, $nmgp_tab_label;

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/");  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1);  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz;
      $this->Campos_Mens_erro = ""; 
      $this->nm_data = new nm_data("pt_br");
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['pesq_tab_label'];
      }
      if (!empty($nmgp_tab_label))
      {
         $nm_tab_campos = explode("?@?", $nmgp_tab_label);
         $nmgp_tab_label = array();
         foreach ($nm_tab_campos as $cada_campo)
         {
             $parte_campo = explode("?#?", $cada_campo);
             $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
         }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'];
      }
      $this->comando_sum     = "";
      $this->comando_filtro  = "";
      $this->comando_ini     = "ini";
      $this->comando_fim     = "";
   }
   function salva_filtro($nmgp_save_origem)
   {
      global $NM_filters_save, $nmgp_save_name, $nmgp_save_option, $script_case_init;
          $NM_filters_save = str_replace("__NM_PLUS__", "+", $NM_filters_save);
          $nmgp_save_name = trim($nmgp_save_name);
          $NM_str_filter  = "SC_V8_" . $nmgp_save_name . "@NMF@";
          if (!NM_is_utf8($nmgp_save_name))
          {
              $nmgp_save_name = sc_convert_encoding($nmgp_save_name, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $NM_str_filter  .= $NM_filters_save;
          $NM_patch = $this->NM_path_filter;
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "Importacao/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "cons_cta_corren_fornec_imp_entregue/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $Parms_usr  = "";
          $NM_filter = fopen ($NM_patch . md5($nmgp_save_name), 'w');
          if (!NM_is_utf8($NM_str_filter))
          {
              $NM_str_filter = sc_convert_encoding($NM_str_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          fwrite($NM_filter, $NM_str_filter);
          fclose($NM_filter);
   }
   function recupera_filtro($NM_filters, $Orig_Fil)
   {
      global $NM_operador, $script_case_init;
      $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      if (!is_file($NM_patch))
      {
          $NM_filters = sc_convert_encoding($NM_filters, "UTF-8", $_SESSION['scriptcase']['charset']);
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      }
      $return_fields = array();
      $tp_fields     = array();
      $tb_fields_esp = array();
      $old_bi_opcs   = array("TP","HJ","OT","U7","SP","US","MM","UM","AM","PS","SS","P3","PM","P7","CY","LY","YY","M6","M3","M18","M24");
      $tp_fields['SC_data_cond'] = 'cond';
      $tp_fields['SC_data_dia'] = 'text';
      $tp_fields['SC_data_mes'] = 'text';
      $tp_fields['SC_data_ano'] = 'text';
      $tp_fields['SC_data_input_2_dia'] = 'text';
      $tp_fields['SC_data_input_2_mes'] = 'text';
      $tp_fields['SC_data_input_2_ano'] = 'text';
      $tp_fields['SC_vl_lancto_proporc_cond'] = 'cond';
      $tp_fields['SC_vl_lancto_proporc'] = 'text';
      $tp_fields['SC_item_proc_compra_id_cond'] = 'cond';
      $tp_fields['SC_item_proc_compra_id'] = 'text';
      $tp_fields['SC_data_hora_cond'] = 'cond';
      $tp_fields['SC_data_hora'] = 'text_aut';
      $tp_fields['id_ac_data_hora'] = 'text_aut';
      $tp_fields['SC_historico_cond'] = 'cond';
      $tp_fields['SC_historico'] = 'text_aut';
      $tp_fields['id_ac_historico'] = 'text_aut';
      $tp_fields['SC_cod_acao_cond'] = 'cond';
      $tp_fields['SC_cod_acao'] = 'checkbox';
      $tp_fields['SC_num_id_tit_ap_cond'] = 'cond';
      $tp_fields['SC_num_id_tit_ap'] = 'text';
      $tp_fields['SC_situacao_container_id_cond'] = 'cond';
      $tp_fields['SC_situacao_container_id'] = 'checkbox';
      $tp_fields['SC_proc_compra_id_cond'] = 'cond';
      $tp_fields['SC_proc_compra_id'] = 'text';
      $tp_fields['SC_container_cond'] = 'cond';
      $tp_fields['SC_container'] = 'text';
      $tp_fields['SC_cod_tipo_movto_cond'] = 'cond';
      $tp_fields['SC_cod_tipo_movto'] = 'checkbox';
      $tp_fields['SC_NM_operador'] = 'text';
      if (is_file($NM_patch))
      {
          $SC_V8    = false;
          $NMfilter = file($NM_patch);
          $NMcmp_filter = explode("@NMF@", $NMfilter[0]);
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              $SC_V8 = true;
          }
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V6" || substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              unset($NMcmp_filter[0]);
          }
          foreach ($NMcmp_filter as $Cada_cmp)
          {
              $Cada_cmp = explode("#NMF#", $Cada_cmp);
              if (isset($tb_fields_esp[$Cada_cmp[0]]))
              {
                  $Cada_cmp[0] = $tb_fields_esp[$Cada_cmp[0]];
              }
              if (!$SC_V8 && substr($Cada_cmp[0], 0, 11) != "div_ac_lab_" && substr($Cada_cmp[0], 0, 6) != "id_ac_")
              {
                  $Cada_cmp[0] = "SC_" . $Cada_cmp[0];
              }
              if (!isset($tp_fields[$Cada_cmp[0]]))
              {
                  continue;
              }
              $list   = array();
              $list_a = array();
              if (substr($Cada_cmp[1], 0, 10) == "_NM_array_")
              {
                  if (substr($Cada_cmp[1], 0, 17) == "_NM_array_#NMARR#")
                  {
                      $Sc_temp = explode("#NMARR#", substr($Cada_cmp[1], 17));
                      foreach ($Sc_temp as $Cada_val)
                      {
                          $list[]   = $Cada_val;
                          $tmp_pos  = (is_string($Cada_val)) ? strpos($Cada_val, "##@@") : false;
                          $val_a    = ($tmp_pos !== false) ?  substr($Cada_val, $tmp_pos + 4) : $Cada_val;
                          $list_a[] = array('opt' => $Cada_val, 'value' => $val_a);
                      }
                  }
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $list[]   = $Cada_cmp[1];
                  $tmp_pos  = (is_string($Cada_cmp[1])) ? strpos($Cada_cmp[1], "##@@") : false;
                  $val_a    = ($tmp_pos !== false) ?  substr($Cada_cmp[1], $tmp_pos + 4) : $Cada_cmp[1];
                  $list_a[] = array('opt' => $Cada_cmp[1], 'value' => $val_a);
              }
              else
              {
                  $list[0] = $Cada_cmp[1];
              }
              if ($tp_fields[$Cada_cmp[0]] == 'select2_aut')
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  $return_fields['set_select2_aut'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $return_fields['set_dselect'][] = array('field' => $Cada_cmp[0], 'value' => $list_a);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'fil_order')
              {
                  $return_fields['set_fil_order'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'selmult')
              {
                  if (count($list) == 1 && $list[0] == "")
                  {
                      continue;
                  }
                  $return_fields['set_selmult'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'ddcheckbox')
              {
                  $return_fields['set_ddcheckbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox_single')
              {
                  $return_fields['set_checkbox_single'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox')
              {
                  $return_fields['set_checkbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              else
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  if ($tp_fields[$Cada_cmp[0]] == 'html')
                  {
                      $return_fields['set_html'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'radio')
                  {
                      $return_fields['set_radio'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'cond' && in_array($list[0], $old_bi_opcs))
                  {
                      $Cada_cmp[1] = "bi_" . $list[0];
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $Cada_cmp[1]);
                  }
                  else
                  {
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
              }
          }
          $this->NM_curr_fil = $NM_filters;
      }
      return $return_fields;
   }
   function apaga_filtro()
   {
      global $NM_filters_del;
      if (isset($NM_filters_del) && !empty($NM_filters_del))
      { 
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          if (!is_file($NM_patch))
          {
              $NM_filters_del = sc_convert_encoding($NM_filters_del, "UTF-8", $_SESSION['scriptcase']['charset']);
              $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          }
          if (is_file($NM_patch))
          {
              @unlink($NM_patch);
          }
          if ($NM_filters_del == $this->NM_curr_fil)
          {
              $this->NM_curr_fil = "";
          }
      }
   }
   /**
    * @access  public
    */
   function trata_campos()
   {
      global $data_cond, $data, $data_dia, $data_mes, $data_ano, $data_input_2_dia, $data_input_2_mes, $data_input_2_ano,
             $vl_lancto_proporc_cond, $vl_lancto_proporc,
             $item_proc_compra_id_cond, $item_proc_compra_id,
             $data_hora_cond, $data_hora, $data_hora_autocomp,
             $historico_cond, $historico, $historico_autocomp,
             $cod_acao_cond, $cod_acao,
             $num_id_tit_ap_cond, $num_id_tit_ap,
             $situacao_container_id_cond, $situacao_container_id,
             $proc_compra_id_cond, $proc_compra_id,
             $container_cond, $container,
             $cod_tipo_movto_cond, $cod_tipo_movto, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($data_hora_autocomp) && empty($data_hora))
      {
          $data_hora = $data_hora_autocomp;
      }
      if (!empty($historico_autocomp) && empty($historico))
      {
          $historico = $historico_autocomp;
      }
      $data_cond_salva = $data_cond; 
      if (!isset($data_input_2_dia) || $data_input_2_dia == "") {
          $data_input_2_dia = $data_dia;
      }
      if (!isset($data_input_2_mes) || $data_input_2_mes == "") {
          $data_input_2_mes = $data_mes;
      }
      if (!isset($data_input_2_ano) || $data_input_2_ano == "") {
          $data_input_2_ano = $data_ano;
      }
      $vl_lancto_proporc_cond_salva = $vl_lancto_proporc_cond; 
      if (!isset($vl_lancto_proporc_input_2) || $vl_lancto_proporc_input_2 == "")
      {
          $vl_lancto_proporc_input_2 = $vl_lancto_proporc;
      }
      $item_proc_compra_id_cond_salva = $item_proc_compra_id_cond; 
      if (!isset($item_proc_compra_id_input_2) || $item_proc_compra_id_input_2 == "")
      {
          $item_proc_compra_id_input_2 = $item_proc_compra_id;
      }
      $data_hora_cond_salva = $data_hora_cond; 
      if (!isset($data_hora_input_2) || $data_hora_input_2 == "")
      {
          $data_hora_input_2 = $data_hora;
      }
      $historico_cond_salva = $historico_cond; 
      if (!isset($historico_input_2) || $historico_input_2 == "")
      {
          $historico_input_2 = $historico;
      }
      $cod_acao_cond_salva = $cod_acao_cond; 
      if (!isset($cod_acao_input_2) || $cod_acao_input_2 == "")
      {
          $cod_acao_input_2 = $cod_acao;
      }
      $num_id_tit_ap_cond_salva = $num_id_tit_ap_cond; 
      if (!isset($num_id_tit_ap_input_2) || $num_id_tit_ap_input_2 == "")
      {
          $num_id_tit_ap_input_2 = $num_id_tit_ap;
      }
      $situacao_container_id_cond_salva = $situacao_container_id_cond; 
      if (!isset($situacao_container_id_input_2) || $situacao_container_id_input_2 == "")
      {
          $situacao_container_id_input_2 = $situacao_container_id;
      }
      $proc_compra_id_cond_salva = $proc_compra_id_cond; 
      if (!isset($proc_compra_id_input_2) || $proc_compra_id_input_2 == "")
      {
          $proc_compra_id_input_2 = $proc_compra_id;
      }
      $container_cond_salva = $container_cond; 
      if (!isset($container_input_2) || $container_input_2 == "")
      {
          $container_input_2 = $container;
      }
      $cod_tipo_movto_cond_salva = $cod_tipo_movto_cond; 
      if (!isset($cod_tipo_movto_input_2) || $cod_tipo_movto_input_2 == "")
      {
          $cod_tipo_movto_input_2 = $cod_tipo_movto;
      }
      if ($vl_lancto_proporc_cond != "in")
      {
          if ($C_formatado)
          {
              nm_limpa_valor($vl_lancto_proporc, $_SESSION['scriptcase']['reg_conf']['dec_num'], $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
          }
      }
      if ($item_proc_compra_id_cond != "in")
      {
          nm_limpa_numero($item_proc_compra_id, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if (is_array($cod_acao)) {
          foreach ($cod_acao as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_acao'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Ação : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      if ($num_id_tit_ap_cond != "in")
      {
          nm_limpa_numero($num_id_tit_ap, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if (is_array($situacao_container_id)) {
          foreach ($situacao_container_id as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['situacao_container_id'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Situação Container : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      if ($proc_compra_id_cond != "in")
      {
          nm_limpa_numero($proc_compra_id, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($container_cond != "in")
      {
          nm_limpa_numero($container, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if (is_array($cod_tipo_movto)) {
          foreach ($cod_tipo_movto as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['psq_check_ret']['cod_tipo_movto'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Tp.Movto : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_dia'] = $data_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_mes'] = $data_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_ano'] = $data_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_dia'] = $data_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_mes'] = $data_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2_ano'] = $data_input_2_ano; 
      if (!empty($data_dia) || !empty($data_mes) || !empty($data_ano) || $data_cond_salva == "nu" || $data_cond_salva == "nn" || $data_cond_salva == "ep" || $data_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $data_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $data_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $data_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $data_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $data_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $data_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_cond'] = $data_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "data"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $data_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['data'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['vl_lancto_proporc'] = $vl_lancto_proporc; 
      if (is_array($vl_lancto_proporc) && !empty($vl_lancto_proporc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $vl_lancto_proporc;
      }
      elseif ($vl_lancto_proporc_cond_salva == "nu" || $vl_lancto_proporc_cond_salva == "nn" || $vl_lancto_proporc_cond_salva == "ep" || $vl_lancto_proporc_cond_salva == "ne" || !empty($vl_lancto_proporc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $vl_lancto_proporc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['vl_lancto_proporc_cond'] = $vl_lancto_proporc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "vl_lancto_proporc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $vl_lancto_proporc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['vl_lancto_proporc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['item_proc_compra_id'] = $item_proc_compra_id; 
      if (is_array($item_proc_compra_id) && !empty($item_proc_compra_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $item_proc_compra_id;
      }
      elseif ($item_proc_compra_id_cond_salva == "nu" || $item_proc_compra_id_cond_salva == "nn" || $item_proc_compra_id_cond_salva == "ep" || $item_proc_compra_id_cond_salva == "ne" || !empty($item_proc_compra_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $item_proc_compra_id;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['item_proc_compra_id_cond'] = $item_proc_compra_id_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "item_proc_compra_id"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $item_proc_compra_id_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['item_proc_compra_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_hora'] = $data_hora; 
      if (is_array($data_hora) && !empty($data_hora))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $data_hora;
      }
      elseif ($data_hora_cond_salva == "nu" || $data_hora_cond_salva == "nn" || $data_hora_cond_salva == "ep" || $data_hora_cond_salva == "ne" || !empty($data_hora))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $data_hora;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_hora_cond'] = $data_hora_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "data_hora"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $data_hora_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['data_hora'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['historico'] = $historico; 
      if (is_array($historico) && !empty($historico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $historico;
      }
      elseif ($historico_cond_salva == "nu" || $historico_cond_salva == "nn" || $historico_cond_salva == "ep" || $historico_cond_salva == "ne" || !empty($historico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $historico;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['historico_cond'] = $historico_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "historico"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $historico_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['historico'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_acao'] = $cod_acao; 
      if (is_array($cod_acao) && !empty($cod_acao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $cod_acao;
      }
      elseif ($cod_acao_cond_salva == "nu" || $cod_acao_cond_salva == "nn" || $cod_acao_cond_salva == "ep" || $cod_acao_cond_salva == "ne" || !empty($cod_acao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $cod_acao;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_acao_cond'] = $cod_acao_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "cod_acao"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $cod_acao_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_acao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['num_id_tit_ap'] = $num_id_tit_ap; 
      if (is_array($num_id_tit_ap) && !empty($num_id_tit_ap))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $num_id_tit_ap;
      }
      elseif ($num_id_tit_ap_cond_salva == "nu" || $num_id_tit_ap_cond_salva == "nn" || $num_id_tit_ap_cond_salva == "ep" || $num_id_tit_ap_cond_salva == "ne" || !empty($num_id_tit_ap))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $num_id_tit_ap;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['num_id_tit_ap_cond'] = $num_id_tit_ap_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "num_id_tit_ap"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $num_id_tit_ap_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['num_id_tit_ap'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['situacao_container_id'] = $situacao_container_id; 
      if (is_array($situacao_container_id) && !empty($situacao_container_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $situacao_container_id;
      }
      elseif ($situacao_container_id_cond_salva == "nu" || $situacao_container_id_cond_salva == "nn" || $situacao_container_id_cond_salva == "ep" || $situacao_container_id_cond_salva == "ne" || !empty($situacao_container_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $situacao_container_id;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['situacao_container_id_cond'] = $situacao_container_id_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "situacao_container_id"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $situacao_container_id_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['situacao_container_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['proc_compra_id'] = $proc_compra_id; 
      if (is_array($proc_compra_id) && !empty($proc_compra_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $proc_compra_id;
      }
      elseif ($proc_compra_id_cond_salva == "nu" || $proc_compra_id_cond_salva == "nn" || $proc_compra_id_cond_salva == "ep" || $proc_compra_id_cond_salva == "ne" || !empty($proc_compra_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $proc_compra_id;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['proc_compra_id_cond'] = $proc_compra_id_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "proc_compra_id"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $proc_compra_id_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['proc_compra_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['container'] = $container; 
      if (is_array($container) && !empty($container))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $container;
      }
      elseif ($container_cond_salva == "nu" || $container_cond_salva == "nn" || $container_cond_salva == "ep" || $container_cond_salva == "ne" || !empty($container))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $container;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['container_cond'] = $container_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "container"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $container_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['container'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_tipo_movto'] = $cod_tipo_movto; 
      if (is_array($cod_tipo_movto) && !empty($cod_tipo_movto))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0] = $cod_tipo_movto;
      }
      elseif ($cod_tipo_movto_cond_salva == "nu" || $cod_tipo_movto_cond_salva == "nn" || $cod_tipo_movto_cond_salva == "ep" || $cod_tipo_movto_cond_salva == "ne" || !empty($cod_tipo_movto))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['val'][0][0] = $cod_tipo_movto;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_tipo_movto_cond'] = $cod_tipo_movto_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['cmp'] = "cod_tipo_movto"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid]['opc'] = $cod_tipo_movto_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_tipo_movto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = $Temp_Busca;
      }
      if ($vl_lancto_proporc_cond != "in" && $vl_lancto_proporc_cond != "bw" && !empty($vl_lancto_proporc) && !is_numeric($vl_lancto_proporc))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Vl.Lancto";
      }
      if ($vl_lancto_proporc_cond == "bw" && ((!empty($vl_lancto_proporc) && !is_numeric($vl_lancto_proporc)) || (!empty($vl_lancto_proporc_input_2) && !is_numeric($vl_lancto_proporc_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Vl.Lancto";
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $this->cmp_formatado['data'] = "'" . $this->cmp_formatado['data'] . "'";
      if (isset($this->cmp_formatado['data_input_2'])  && !empty($this->cmp_formatado['data_input_2'])) {
          $this->cmp_formatado['data_input_2'] = "'" . $this->cmp_formatado['data_input_2'] . "'";
      }
      $Conteudo = $vl_lancto_proporc;
      if (strtoupper($vl_lancto_proporc_cond) != "II" && strtoupper($vl_lancto_proporc_cond) != "QP" && strtoupper($vl_lancto_proporc_cond) != "NP" && strtoupper($vl_lancto_proporc_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['vl_lancto_proporc'] = $Conteudo;
      $this->cmp_formatado['vl_lancto_proporc'] = "'" . $this->cmp_formatado['vl_lancto_proporc'] . "'";
      if (isset($this->cmp_formatado['vl_lancto_proporc_input_2'])  && !empty($this->cmp_formatado['vl_lancto_proporc_input_2'])) {
          $this->cmp_formatado['vl_lancto_proporc_input_2'] = "'" . $this->cmp_formatado['vl_lancto_proporc_input_2'] . "'";
      }
      $Conteudo = $item_proc_compra_id;
      if (strtoupper($item_proc_compra_id_cond) != "II" && strtoupper($item_proc_compra_id_cond) != "QP" && strtoupper($item_proc_compra_id_cond) != "NP" && strtoupper($item_proc_compra_id_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['item_proc_compra_id'] = $Conteudo;
      $this->cmp_formatado['item_proc_compra_id'] = "'" . $this->cmp_formatado['item_proc_compra_id'] . "'";
      if (isset($this->cmp_formatado['item_proc_compra_id_input_2'])  && !empty($this->cmp_formatado['item_proc_compra_id_input_2'])) {
          $this->cmp_formatado['item_proc_compra_id_input_2'] = "'" . $this->cmp_formatado['item_proc_compra_id_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($data_hora != '') {
      $data_hora_look = (is_string($data_hora) ? substr($this->Db->qstr($data_hora), 1, -1) : $data_hora); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct data_hora from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where data_hora = '$data_hora_look'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['data_hora'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['data_hora'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['data_hora'] = $data_hora;
      }
      $this->cmp_formatado['data_hora'] = "'" . $this->cmp_formatado['data_hora'] . "'";
      if (isset($this->cmp_formatado['data_hora_input_2'])  && !empty($this->cmp_formatado['data_hora_input_2'])) {
          $this->cmp_formatado['data_hora_input_2'] = "'" . $this->cmp_formatado['data_hora_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($historico != '') {
      $historico_look = (is_string($historico) ? substr($this->Db->qstr($historico), 1, -1) : $historico); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct historico from (SELECT      cta_corren_fornec_imp_id,     fornecedor_id,     data,     cta.item_proc_compra_id as item_proc_compra_id,     historico,     cod_tipo_movto,     vl_lancto, case cod_tipo_movto     when 3 then vl_lancto *      	 (itens.qt_alocada  / itens_ped.qt_comprada)    		   	     else vl_lancto     end as vl_lancto_proporc,     cod_acao,     login,     data_hora,     num_id_tit_ap,     situacao_container_id,     proc_compra_id,    \"nr-container\" as container     FROM      PUB.cta_corren_fornec_imp cta,  pub.\"pp-container\" container,  pub.itens_container itens, pub.itens_proc_compra itens_ped where itens.item_proc_compra_id = cta.item_proc_compra_id and itens.item_proc_compra_id = itens_ped.item_proc_compra_id and itens.container_id = container.\"nr-container\" and container.situacao_container_id  in(" . $_SESSION['sits_entregue'] . ") and fornecedor_id = " . $_SESSION['fornecedor_corrente'] . " and cod_tipo_movto > 2  and  (itens.item_container_id = cta.item_container_id or cta.item_container_id  = 0) and ( num_id_tit_ap = 0 or num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos  where pgtos.container_id = container.\"nr-container\") ) ) nm_sel_esp where historico = '$historico_look'"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['historico'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['historico'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['historico'] = $historico;
      }
      $this->cmp_formatado['historico'] = "'" . $this->cmp_formatado['historico'] . "'";
      if (isset($this->cmp_formatado['historico_input_2'])  && !empty($this->cmp_formatado['historico_input_2'])) {
          $this->cmp_formatado['historico_input_2'] = "'" . $this->cmp_formatado['historico_input_2'] . "'";
      }
      $this->cmp_formatado['cod_acao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_acao'];
      $this->cmp_formatado['cod_acao_input_2'] = $cod_acao_input_2;
      $this->cmp_formatado['cod_acao'] = "'" . $this->cmp_formatado['cod_acao'] . "'";
      if (isset($this->cmp_formatado['cod_acao_input_2'])  && !empty($this->cmp_formatado['cod_acao_input_2'])) {
          $this->cmp_formatado['cod_acao_input_2'] = "'" . $this->cmp_formatado['cod_acao_input_2'] . "'";
      }
      $Conteudo = $num_id_tit_ap;
      if (strtoupper($num_id_tit_ap_cond) != "II" && strtoupper($num_id_tit_ap_cond) != "QP" && strtoupper($num_id_tit_ap_cond) != "NP" && strtoupper($num_id_tit_ap_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['num_id_tit_ap'] = $Conteudo;
      $this->cmp_formatado['num_id_tit_ap'] = "'" . $this->cmp_formatado['num_id_tit_ap'] . "'";
      if (isset($this->cmp_formatado['num_id_tit_ap_input_2'])  && !empty($this->cmp_formatado['num_id_tit_ap_input_2'])) {
          $this->cmp_formatado['num_id_tit_ap_input_2'] = "'" . $this->cmp_formatado['num_id_tit_ap_input_2'] . "'";
      }
      $this->cmp_formatado['situacao_container_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['situacao_container_id'];
      $this->cmp_formatado['situacao_container_id_input_2'] = $situacao_container_id_input_2;
      $this->cmp_formatado['situacao_container_id'] = "'" . $this->cmp_formatado['situacao_container_id'] . "'";
      if (isset($this->cmp_formatado['situacao_container_id_input_2'])  && !empty($this->cmp_formatado['situacao_container_id_input_2'])) {
          $this->cmp_formatado['situacao_container_id_input_2'] = "'" . $this->cmp_formatado['situacao_container_id_input_2'] . "'";
      }
      $Conteudo = $proc_compra_id;
      if (strtoupper($proc_compra_id_cond) != "II" && strtoupper($proc_compra_id_cond) != "QP" && strtoupper($proc_compra_id_cond) != "NP" && strtoupper($proc_compra_id_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['proc_compra_id'] = $Conteudo;
      $this->cmp_formatado['proc_compra_id'] = "'" . $this->cmp_formatado['proc_compra_id'] . "'";
      if (isset($this->cmp_formatado['proc_compra_id_input_2'])  && !empty($this->cmp_formatado['proc_compra_id_input_2'])) {
          $this->cmp_formatado['proc_compra_id_input_2'] = "'" . $this->cmp_formatado['proc_compra_id_input_2'] . "'";
      }
      $Conteudo = $container;
      if (strtoupper($container_cond) != "II" && strtoupper($container_cond) != "QP" && strtoupper($container_cond) != "NP" && strtoupper($container_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['container'] = $Conteudo;
      $this->cmp_formatado['container'] = "'" . $this->cmp_formatado['container'] . "'";
      if (isset($this->cmp_formatado['container_input_2'])  && !empty($this->cmp_formatado['container_input_2'])) {
          $this->cmp_formatado['container_input_2'] = "'" . $this->cmp_formatado['container_input_2'] . "'";
      }
      $this->cmp_formatado['cod_tipo_movto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['cod_tipo_movto'];
      $this->cmp_formatado['cod_tipo_movto_input_2'] = $cod_tipo_movto_input_2;
      $this->cmp_formatado['cod_tipo_movto'] = "'" . $this->cmp_formatado['cod_tipo_movto'] . "'";
      if (isset($this->cmp_formatado['cod_tipo_movto_input_2'])  && !empty($this->cmp_formatado['cod_tipo_movto_input_2'])) {
          $this->cmp_formatado['cod_tipo_movto_input_2'] = "'" . $this->cmp_formatado['cod_tipo_movto_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $data_cond, $data, $data_dia, $data_mes, $data_ano, $data_input_2_dia, $data_input_2_mes, $data_input_2_ano,
             $vl_lancto_proporc_cond, $vl_lancto_proporc,
             $item_proc_compra_id_cond, $item_proc_compra_id,
             $data_hora_cond, $data_hora, $data_hora_autocomp,
             $historico_cond, $historico, $historico_autocomp,
             $cod_acao_cond, $cod_acao,
             $num_id_tit_ap_cond, $num_id_tit_ap,
             $situacao_container_id_cond, $situacao_container_id,
             $proc_compra_id_cond, $proc_compra_id,
             $container_cond, $container,
             $cod_tipo_movto_cond, $cod_tipo_movto, $nmgp_tab_label;


      //----- $data
      $this->Date_part = false;
      if ($data_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $data_cond = strtoupper($data_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $data_ano;
          $Dtxt .= $data_mes;
          $Dtxt .= $data_dia;
          $val[0]['ano'] = $data_ano;
          $val[0]['mes'] = $data_mes;
          $val[0]['dia'] = $data_dia;
          if ($data_cond == "BW")
          {
              $val[1]['ano'] = $data_input_2_ano;
              $val[1]['mes'] = $data_input_2_mes;
              $val[1]['dia'] = $data_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $data_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $data_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $data = $val[0];
          $this->cmp_formatado['data'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['data'], "YYYY-MM-DD");
          $this->cmp_formatado['data'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data'] = "'" . $this->cmp_formatado['data'] . "'";
          if ($data_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $data_input_2     = $val[1];
              $this->cmp_formatado['data_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']['data_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['data_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['data_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_input_2'] = "'" . $this->cmp_formatado['data_input_2'] . "'";
          }
          if (!empty($Dtxt) || $data_cond == "NU" || $data_cond == "NN"|| $data_cond == "EP"|| $data_cond == "NE")
          {
              $this->monta_condicao("data", $data_cond, $data, $data_input_2, 'data', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['data']['label'] = $nmgp_tab_label['data'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['data']['descr'] = $nmgp_tab_label['data'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['data']['hint']  = $nmgp_tab_label['data'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $vl_lancto_proporc
      $this->Date_part = false;
      if (isset($vl_lancto_proporc) || $vl_lancto_proporc_cond == "nu" || $vl_lancto_proporc_cond == "nn" || $vl_lancto_proporc_cond == "ep" || $vl_lancto_proporc_cond == "ne")
      {
         $this->monta_condicao("VL_LANCTO_PROPORC", $vl_lancto_proporc_cond, $vl_lancto_proporc, "", "vl_lancto_proporc", "NUMERIC", false);
      }

      //----- $item_proc_compra_id
      $this->Date_part = false;
      if (isset($item_proc_compra_id) || $item_proc_compra_id_cond == "nu" || $item_proc_compra_id_cond == "nn" || $item_proc_compra_id_cond == "ep" || $item_proc_compra_id_cond == "ne")
      {
         $this->monta_condicao("ITEM_PROC_COMPRA_ID", $item_proc_compra_id_cond, $item_proc_compra_id, "", "item_proc_compra_id", "INTEGER", false);
      }

      //----- $data_hora
      $this->Date_part = false;
      if (isset($data_hora) || $data_hora_cond == "nu" || $data_hora_cond == "nn" || $data_hora_cond == "ep" || $data_hora_cond == "ne")
      {
         $this->monta_condicao("data_hora", $data_hora_cond, $data_hora, "", "data_hora", "TIMESTAMP", false);
      }

      //----- $historico
      $this->Date_part = false;
      if (isset($historico) || $historico_cond == "nu" || $historico_cond == "nn" || $historico_cond == "ep" || $historico_cond == "ne")
      {
         $this->monta_condicao("historico", $historico_cond, $historico, "", "historico", "VARCHAR", false);
      }

      //----- $cod_acao
      $this->Date_part = false;
      $cod_acao = $cod_acao; 
      $nm_aspas = "";
      if ($cod_acao_cond == "nu" || $cod_acao_cond == "nn" || $cod_acao_cond == "ep" || $cod_acao_cond == "ne")
      {
          $cod_acao = array();
      }
      if (is_array($cod_acao) && count($cod_acao) != 0)
      {
         foreach ($cod_acao as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($cod_acao[$i]);
            }
         }
      }
      if (is_array($cod_acao) && count($cod_acao) != 0)
      {
         $this->and_or();
         $cond_descr  = "";
         $count_descr = 0;
         $end_descr   = false;
         $lim_descr   = 15;
         $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
         if ($cod_acao_cond == "df" || $cod_acao_cond == "np")
         {
             $this->comando        .= " cod_acao not in (";
             $this->comando_sum    .= " .cod_acao not in (";
             $this->comando_filtro .= " cod_acao not in (";
         }
         else
         {
             $this->comando        .= " cod_acao in (";
             $this->comando_sum    .= " .cod_acao in (";
             $this->comando_filtro .= " cod_acao in (";
         }
         $x                     = count($cod_acao);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($cod_acao_cond == "df" || $cod_acao_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($cod_acao as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if ($tmp_pos === false)
            {
               $res_lookup = $dados;
            }
            else
            {
                $res_lookup = substr($dados, $tmp_pos + 4);
                $dados = substr($dados, 0, $tmp_pos);
            }
            $dados  = substr($this->Db->qstr($dados), 1, -1);
            $this->comando        .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_sum    .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_filtro .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $nm_cond              .= $res_lookup;
            if (((strlen($cond_descr) + strlen($res_lookup) + $lang_descr) < $lim_descr) || empty($cond_descr))
            {
                 $cond_descr .= (empty($cond_descr)) ? "" : " " . $Lang_concat . " ";
                 $cond_descr .= $res_lookup;
                 $count_descr++;
            }
            elseif (!$end_descr)
            {
                 $cond_descr .= " +" . (count($cod_acao) - $count_descr);
                 $end_descr = true;
            };
            if ($xx != ($x - 1))
            {
               $this->comando        .= ",";
               $this->comando_sum    .= ",";
               $this->comando_filtro .= ",";
               $nm_cond              .= " " . $Lang_concat . " ";
            }
            $xx++;
         }
         $this->comando        .= ")";
         $this->comando_sum    .= ")";
         $this->comando_filtro .= ")";
         $Lang_descr = array();
         $Lang_descr['eq'] = $this->Ini->Nm_lang['lang_srch_equl'];
         $Lang_descr['df'] = $this->Ini->Nm_lang['lang_srch_diff'];
         $Lang_descr['np'] = $this->Ini->Nm_lang['lang_srch_not_like'];
         $Lang_descr_final = isset($Lang_descr[$cod_acao_cond]) ? $Lang_descr[$cod_acao_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= $nmgp_tab_label['cod_acao'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_acao']['label'] = $nmgp_tab_label['cod_acao'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_acao']['descr'] = $nmgp_tab_label['cod_acao'] . ": " . $Lang_descr_final . " " . $cond_descr;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_acao']['hint'] = $nmgp_tab_label['cod_acao'] . ": " . $Lang_descr_final . " " . $nm_cond;
      }
      elseif (isset($cod_acao) && ($cod_acao_cond == "nu" || $cod_acao_cond == "nn" || $cod_acao_cond == "ep" || $cod_acao_cond == "ne"))
      {
         $this->monta_condicao("cod_acao", $cod_acao_cond, "", "", "cod_acao", "INTEGER", false);
      }

      //----- $num_id_tit_ap
      $this->Date_part = false;
      if (isset($num_id_tit_ap) || $num_id_tit_ap_cond == "nu" || $num_id_tit_ap_cond == "nn" || $num_id_tit_ap_cond == "ep" || $num_id_tit_ap_cond == "ne")
      {
         $this->monta_condicao("num_id_tit_ap", $num_id_tit_ap_cond, $num_id_tit_ap, "", "num_id_tit_ap", "INTEGER", false);
      }

      //----- $situacao_container_id
      $this->Date_part = false;
      $situacao_container_id = $situacao_container_id; 
      $nm_aspas = "";
      if ($situacao_container_id_cond == "nu" || $situacao_container_id_cond == "nn" || $situacao_container_id_cond == "ep" || $situacao_container_id_cond == "ne")
      {
          $situacao_container_id = array();
      }
      if (is_array($situacao_container_id) && count($situacao_container_id) != 0)
      {
         foreach ($situacao_container_id as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($situacao_container_id[$i]);
            }
         }
      }
      if (is_array($situacao_container_id) && count($situacao_container_id) != 0)
      {
         $this->and_or();
         $cond_descr  = "";
         $count_descr = 0;
         $end_descr   = false;
         $lim_descr   = 15;
         $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
         if ($situacao_container_id_cond == "df" || $situacao_container_id_cond == "np")
         {
             $this->comando        .= " situacao_container_id not in (";
             $this->comando_sum    .= " .situacao_container_id not in (";
             $this->comando_filtro .= " situacao_container_id not in (";
         }
         else
         {
             $this->comando        .= " situacao_container_id in (";
             $this->comando_sum    .= " .situacao_container_id in (";
             $this->comando_filtro .= " situacao_container_id in (";
         }
         $x                     = count($situacao_container_id);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($situacao_container_id_cond == "df" || $situacao_container_id_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($situacao_container_id as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if ($tmp_pos === false)
            {
               $res_lookup = $dados;
            }
            else
            {
                $res_lookup = substr($dados, $tmp_pos + 4);
                $dados = substr($dados, 0, $tmp_pos);
            }
            $dados  = substr($this->Db->qstr($dados), 1, -1);
            $this->comando        .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_sum    .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_filtro .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $nm_cond              .= $res_lookup;
            if (((strlen($cond_descr) + strlen($res_lookup) + $lang_descr) < $lim_descr) || empty($cond_descr))
            {
                 $cond_descr .= (empty($cond_descr)) ? "" : " " . $Lang_concat . " ";
                 $cond_descr .= $res_lookup;
                 $count_descr++;
            }
            elseif (!$end_descr)
            {
                 $cond_descr .= " +" . (count($situacao_container_id) - $count_descr);
                 $end_descr = true;
            };
            if ($xx != ($x - 1))
            {
               $this->comando        .= ",";
               $this->comando_sum    .= ",";
               $this->comando_filtro .= ",";
               $nm_cond              .= " " . $Lang_concat . " ";
            }
            $xx++;
         }
         $this->comando        .= ")";
         $this->comando_sum    .= ")";
         $this->comando_filtro .= ")";
         $Lang_descr = array();
         $Lang_descr['eq'] = $this->Ini->Nm_lang['lang_srch_equl'];
         $Lang_descr['df'] = $this->Ini->Nm_lang['lang_srch_diff'];
         $Lang_descr['np'] = $this->Ini->Nm_lang['lang_srch_not_like'];
         $Lang_descr_final = isset($Lang_descr[$situacao_container_id_cond]) ? $Lang_descr[$situacao_container_id_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= $nmgp_tab_label['situacao_container_id'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['situacao_container_id']['label'] = $nmgp_tab_label['situacao_container_id'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['situacao_container_id']['descr'] = $nmgp_tab_label['situacao_container_id'] . ": " . $Lang_descr_final . " " . $cond_descr;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['situacao_container_id']['hint'] = $nmgp_tab_label['situacao_container_id'] . ": " . $Lang_descr_final . " " . $nm_cond;
      }
      elseif (isset($situacao_container_id) && ($situacao_container_id_cond == "nu" || $situacao_container_id_cond == "nn" || $situacao_container_id_cond == "ep" || $situacao_container_id_cond == "ne"))
      {
         $this->monta_condicao("situacao_container_id", $situacao_container_id_cond, "", "", "situacao_container_id", "INTEGER", false);
      }

      //----- $proc_compra_id
      $this->Date_part = false;
      if (isset($proc_compra_id) || $proc_compra_id_cond == "nu" || $proc_compra_id_cond == "nn" || $proc_compra_id_cond == "ep" || $proc_compra_id_cond == "ne")
      {
         $this->monta_condicao("proc_compra_id", $proc_compra_id_cond, $proc_compra_id, "", "proc_compra_id", "INTEGER", false);
      }

      //----- $container
      $this->Date_part = false;
      if (isset($container) || $container_cond == "nu" || $container_cond == "nn" || $container_cond == "ep" || $container_cond == "ne")
      {
         $this->monta_condicao("CONTAINER", $container_cond, $container, "", "container", "INTEGER", false);
      }

      //----- $cod_tipo_movto
      $this->Date_part = false;
      $cod_tipo_movto = $cod_tipo_movto; 
      $nm_aspas = "";
      if ($cod_tipo_movto_cond == "nu" || $cod_tipo_movto_cond == "nn" || $cod_tipo_movto_cond == "ep" || $cod_tipo_movto_cond == "ne")
      {
          $cod_tipo_movto = array();
      }
      if (is_array($cod_tipo_movto) && count($cod_tipo_movto) != 0)
      {
         foreach ($cod_tipo_movto as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($cod_tipo_movto[$i]);
            }
         }
      }
      if (is_array($cod_tipo_movto) && count($cod_tipo_movto) != 0)
      {
         $this->and_or();
         $cond_descr  = "";
         $count_descr = 0;
         $end_descr   = false;
         $lim_descr   = 15;
         $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
         if ($cod_tipo_movto_cond == "df" || $cod_tipo_movto_cond == "np")
         {
             $this->comando        .= " cod_tipo_movto not in (";
             $this->comando_sum    .= " .cod_tipo_movto not in (";
             $this->comando_filtro .= " cod_tipo_movto not in (";
         }
         else
         {
             $this->comando        .= " cod_tipo_movto in (";
             $this->comando_sum    .= " .cod_tipo_movto in (";
             $this->comando_filtro .= " cod_tipo_movto in (";
         }
         $x                     = count($cod_tipo_movto);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($cod_tipo_movto_cond == "df" || $cod_tipo_movto_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($cod_tipo_movto as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if ($tmp_pos === false)
            {
               $res_lookup = $dados;
            }
            else
            {
                $res_lookup = substr($dados, $tmp_pos + 4);
                $dados = substr($dados, 0, $tmp_pos);
            }
            $dados  = substr($this->Db->qstr($dados), 1, -1);
            $this->comando        .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_sum    .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $this->comando_filtro .= "" . $nm_aspas . $dados . $nm_aspas . "";
            $nm_cond              .= $res_lookup;
            if (((strlen($cond_descr) + strlen($res_lookup) + $lang_descr) < $lim_descr) || empty($cond_descr))
            {
                 $cond_descr .= (empty($cond_descr)) ? "" : " " . $Lang_concat . " ";
                 $cond_descr .= $res_lookup;
                 $count_descr++;
            }
            elseif (!$end_descr)
            {
                 $cond_descr .= " +" . (count($cod_tipo_movto) - $count_descr);
                 $end_descr = true;
            };
            if ($xx != ($x - 1))
            {
               $this->comando        .= ",";
               $this->comando_sum    .= ",";
               $this->comando_filtro .= ",";
               $nm_cond              .= " " . $Lang_concat . " ";
            }
            $xx++;
         }
         $this->comando        .= ")";
         $this->comando_sum    .= ")";
         $this->comando_filtro .= ")";
         $Lang_descr = array();
         $Lang_descr['eq'] = $this->Ini->Nm_lang['lang_srch_equl'];
         $Lang_descr['df'] = $this->Ini->Nm_lang['lang_srch_diff'];
         $Lang_descr['np'] = $this->Ini->Nm_lang['lang_srch_not_like'];
         $Lang_descr_final = isset($Lang_descr[$cod_tipo_movto_cond]) ? $Lang_descr[$cod_tipo_movto_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= $nmgp_tab_label['cod_tipo_movto'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_tipo_movto']['label'] = $nmgp_tab_label['cod_tipo_movto'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_tipo_movto']['descr'] = $nmgp_tab_label['cod_tipo_movto'] . ": " . $Lang_descr_final . " " . $cond_descr;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['grid_pesq']['cod_tipo_movto']['hint'] = $nmgp_tab_label['cod_tipo_movto'] . ": " . $Lang_descr_final . " " . $nm_cond;
      }
      elseif (isset($cod_tipo_movto) && ($cod_tipo_movto_cond == "nu" || $cod_tipo_movto_cond == "nn" || $cod_tipo_movto_cond == "ep" || $cod_tipo_movto_cond == "ne"))
      {
         $this->monta_condicao("cod_tipo_movto", $cod_tipo_movto_cond, "", "", "cod_tipo_movto", "INTEGER", false);
      }
   }

   /**
    * @access  public
    */
   function finaliza_resultado_ajax()
   {
       $this->comando = substr($this->comando, 8);
       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_fast'] . ")";
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['fast_search']);
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_pesq'];

      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
         return;
      }
      $this->retorna_pesq();
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
function criarRegCtaCorrenFornec($fornecedorId,$data,$itemProcCompraId,$historico,$codTipoMovto,$vlLancto,
                                 $codAcao,$numIdTitAp=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
if (!isset($_SESSION['transacao_universal'])) {$_SESSION['transacao_universal'] = "";}
if (!isset($this->sc_temp_transacao_universal)) {$this->sc_temp_transacao_universal = (isset($_SESSION['transacao_universal'])) ? $_SESSION['transacao_universal'] : "";}
  
    $logCriar = true; 
    
    if(isset($this->sc_temp_transacao_universal)){
        $transacaoUniversal = $this->sc_temp_transacao_universal;
    }else{
        $transacaoUniversal = 0;
    }
    if($transacaoUniversal == ''){
        $transacaoUniversal = 0;
    }

    if($vlLancto  == 0){
        $logCriar = false;
    }

    if($logCriar == true){
        $cmd = "insert into pub.cta_corren_fornec_Imp(cta_corren_fornec_imp_id,fornecedor_id,data,item_proc_compra_id,historico,cod_tipo_movto,vl_lancto,
              cod_acao,login,data_hora,num_id_tit_ap, item_container_id, transacao_id)
            values(pub.seq_cta_corren_fornec_imp.NEXTVAL, $fornecedorId,'$data',$itemProcCompraId,
            '$historico','$codTipoMovto','$vlLancto',$codAcao,'$this->sc_temp_usr_login',systimestamp(),$numIdTitAp,
            $itemContainerId, $transacaoUniversal )";
        inserirLogDb('Comando',$cmd,__FUNCTION__);
        
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
    return $logCriar;
if (isset($this->sc_temp_transacao_universal)) {$_SESSION['transacao_universal'] = $this->sc_temp_transacao_universal;}
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function alterarFornecItensPed($pedido,$fornec)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aItens =  getIDItensProcCompra($pedido);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompra = $aItens[$i]['item_proc_compra_id'];
            $cmd = "update pub.cta_corren_fornec_imp set fornecedor_id = $fornec 
            where item_proc_compra_id = $itemProcCompra ";
        }
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function verifTitPedImp($numIdTitulo)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $logExiste = false;
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " cta_corren_fornec_imp_id ";
    $condicao = "  num_id_tit_ap = $numIdTitulo and cod_tipo_movto = 4 ";
    $aResult = $this->getDados($tipo,$tabela,$campos,$condicao,"espec");
    if(is_array($aResult)){
        $logExiste = true;
    }
    return $logExiste;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarPgtosContainerPedImp($containerParam,$descOrigem='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
    setTransacaoUniversal($transacaoId);
    $listaTitulos = buscarTitAssociadosContainer($containerParam);
    inserirLogDb('inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    inserirLogDb('Lista de Titulos a estornar os lancamentos ',$listaTitulos,__FUNCTION__);
    if($listaTitulos <> ''){
        $aTitulos = explode(',',$listaTitulos);
        if(is_array($aTitulos)){
            $tam = count($aTitulos);
            incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $titulo = $aTitulos[$i];
                $this->estornarTitAssocPedImp($titulo,$descOrigem);
            }
            decrNivelCorrenteLogDb();
        }
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoId);


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarPagtosContainerSemItens($containerParam,$histCompl,$itemContainerParam=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $logExiste = existItensContainer($containerParam);
    $descLogExiste = $this->convLogEmString($logExiste);
    inserirLogDb('Inicio Log funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Existem Itens associados ao container?',$descLogExiste,__FUNCTION__);
    $data      = date('Y-m-d');
    if($logExiste == false){
        $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
        setTransacaoUniversal($transacaoId);
        inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $listaTitulos = buscarTitAssociadosContainer($containerParam);
        inserirLogDb('Lista de Titulos Associados ao container sem itens',$listaTitulos,__FUNCTION__);
        if($listaTitulos <> ''){
            $aTitulos = explode(',',$listaTitulos);
            if(is_array($aTitulos)){
                $tam = count($aTitulos);
                inserirLogDb('inicio laco do for $aTitulos - tamanho',$tam,__FUNCTION__);
                incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    inserirLogDb('array - posicao',$i,__FUNCTION__);
                    $titulo = $aTitulos[$i];
                    $aReg = $this->getSomasCtaCorrenFornec('6',
                        true,
                        $titulo);
                    if(is_array($aReg)){
                        $tam2 = count($aReg);
                        for($j=0;$j<$tam2;$j++){
                            incrNivelCorrenteLogDb();
                            $fornec             = $aReg[$j]['fornecedor_id'];
                            $itemPedidoId       = $aReg[$j]['item_proc_compra_id'];
                            $valor              = $aReg[$j]['valor'] * -1 ;
                            $itemContainerId    = $aReg[$j]['item_container_id'];
                            if($itemContainerParam <> 0 and $itemContainerParam <> $itemContainerId){
                                continue;
                            }
                            inserirLogDb('fornecedor',$fornec,__FUNCTION__);
                            inserirLogDb('itemPedidoId',$itemPedidoId,__FUNCTION__);
                            inserirLogDb('valor',$valor,__FUNCTION__);
                            inserirLogDb('itemContainerId',$itemContainerId,__FUNCTION__);
                            decrNivelCorrenteLogDb();
                            $retCriacao = $this->criarRegCtaCorrenFornec($fornec,
                                $data,
                                $itemPedidoId,
                                $histCompl,
                                6,  
                                $valor,
                                3, 
                                $titulo,
                                $itemContainerId
                            );
                            $descRetCriacao = $this->convLogEmString($retCriacao);
                            inserirLogDb('Apos Criar o registro do tipo de movto 6 , acao 3',"Movto Criado? $descRetCriacao",__FUNCTION__);
                        }
                    }
                }
                decrNivelCorrenteLogDb();
            }
        }
        finalizarTransacao($transacaoId);
        inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarPagtosItemContainer($itemContainerId,$histCompl)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPagtosItemContainer');
    setTransacaoUniversal($transacaoId);
    $data      = date('Y-m-d');
    inserirLogDb("transacao",$transacaoId,__FUNCTION__);
    $aReg = $this->getSomasCtaCorrenFornec(5,true,0,0,$itemContainerId);
    $descAReg = $this->convArrayToString($aReg);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb("Array de retorno da funcao getSomaCtaCorrenFornec informado o tipo movto 5 e o item container: $itemContainerId",
                   $descAReg,__FUNCTION__);
    if(is_array($aReg)){
        $tam = count($aReg);
        incrNivelCorrenteLogDb();
        for($i=0;$i<$tam;$i++){
            inserirLogDb(" For do Array - registro",$i,__FUNCTION__);
            incrNivelCorrenteLogDb();

            $fornec             = $aReg[$i]['fornecedor_id'];
            $itemPedidoId       = $aReg[$i]['item_proc_compra_id'];
            $valor              = $aReg[$i]['valor'] * -1 ;
            $numIdTitulo        = $aReg[$i]['num_id_tit_ap'];

            inserirLogDb('fornecedor',$fornec,__FUNCTION__);
            inserirLogDb('itemPedidoId',$itemPedidoId,__FUNCTION__);
            inserirLogDb('valor',$valor,__FUNCTION__);
            inserirLogDb('numIdTitulo',$numIdTitulo,__FUNCTION__);

            decrNivelCorrenteLogDb();
            $retCriacao = $this->criarRegCtaCorrenFornec($fornec,
                $data,
                $itemPedidoId,
                $histCompl,
                6,  
                $valor,
                3, 
                $numIdTitulo,
                $itemContainerId
            );
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 6 e acao 3',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
        decrNivelCorrenteLogDb();
    }
    finalizarTransacao($transacaoId);
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarTitAssocPedImp($numIdTitulo,$descOrigem='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $logAssociado = $this->verifTitPedImp($numIdTitulo);
    $descrLogAssociado = $this->convLogEmString($logAssociado);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Titulo associado a algum Pedido de Compra e que tenha gerado movto cta corrente fornecedor?',
        $descrLogAssociado,__FUNCTION__);
    if($logAssociado == true){
        $aRet =  $this->getSomasCtaCorrenFornec('4', 
            true,$numIdTitulo);
        $descARet = $this->convArrayToString($aRet);
        inserirLogDb("Array resultante da funcao getSomaCtaCorrenFornec com os parametros: Tipo Movto=4,Quebra=true 
                            e NumIdTitulo=$numIdTitulo ",$descARet,__FUNCTION__);
        if(is_array($aRet)){
            $tam = count($aRet);
            $data = date('Y-m-d');
            incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $fornec         = $aRet[$i]['fornecedor_id'];
                $itemPedidoId   = $aRet[$i]['item_proc_compra_id'];
                $valor          = $aRet[$i]['valor'];
                inserirLogDb('fornecedor:',$fornec,__FUNCTION__);
                inserirLogDb('ID item Pedido:',$itemPedidoId,__FUNCTION__);
                inserirLogDb('valor:',$valor,__FUNCTION__);
                $historico      = "Estorno de Geracao de Lancamento automatico do item do pedido x pagtos do pedido
                                  $descOrigem  ";
                $retCriacao = $this->criarRegCtaCorrenFornec($fornec,
                    $data,
                    $itemPedidoId,
                    $historico,
                    4,  
                    $valor * -1,
                    1, 
                    $numIdTitulo
                );
                $descrRetCriacao = $this->convLogEmString($retCriacao);
                inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 1 - movto negativo',
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);
            }


            decrNivelCorrenteLogDb();
        }
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarPagtosContainer($nivel, $id,$histCompl='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $data     = date('Y-m-d');
    switch($nivel){
        case 1:
            inserirLogDb("Nivel:","1",__FUNCTION__);
            $tipo     = "multi"; 
            $tabela   = " pub.pagtos_container ";
            $campos   = " num_id_tit_ap ";
            $condicao = "  container_id = $id ";
            $conexao  = "espec";
            $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
            $arrayTxt = $this->convArrayToString($aReg);
            inserirLogDb("Array Titulos do container:$id",$arrayTxt,__FUNCTION__);

            if(is_array($aReg)){
                $tam = count($aReg);
                incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    $titulo = $aReg[$i]['num_id_tit_ap'];
                    inserirLogDb('titulo encontrado?',$titulo,__FUNCTION__);
                    $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$titulo);
                    $arrayTxt = $this->convArrayToString($aSaldo);
                    inserirLogDb("Array do retorno da funcao getsomasCtaCorrenFornec - tipo movto:5,6 - quebra:sim - titulo:$titulo",$arrayTxt,
                        __FUNCTION__);
                    if(is_array($aSaldo)){
                        $tam2 = count($aSaldo);
                        incrNivelCorrenteLogDb();
                        for($j=0;$j<$tam2;$j++){
                            $fornec         = $aSaldo[$j]['fornecedor_id'];
                            inserirLogDb("fornecedor:",$fornec,__FUNCTION__);
                            $itemPedidoId   = $aSaldo[$j]['item_proc_compra_id'];
                            inserirLogDb("item Pedido:",$itemPedidoId,__FUNCTION__);
                            $valor          = $aSaldo[$j]['valor'];
                            inserirLogDb('valor',$valor,__FUNCTION__);
                            $itemContainerId = $aSaldo[$j]['item_container_id'];
                            inserirLogDb('item container:',$itemContainerId,__FUNCTION__);
                            $retCriacao = $this->criarRegCtaCorrenFornec($fornec,
                                $data,
                                $itemPedidoId,
                                $histCompl,
                                5,  
                                $valor * -1,
                                3, 
                                $titulo,
                                $itemContainerId
                            );
                            $descrRetCriacao = $this->convLogEmString($retCriacao);
                            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        }
                        decrNivelCorrenteLogDb();
                    }
                }
                decrNivelCorrenteLogDb();
            }
            break;
        case 2:
            inserirLogDb("Nivel:","2",__FUNCTION__);
            $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$id);
            $arrayTxt = $this->convArrayToString($aSaldo);
            inserirLogDb("Array retorno getSomasCtaCorrenFornec - tipo movto:5  - quebra:sim - titulo $id",
                $arrayTxt,__FUNCTION__);
            if(is_array($aSaldo)){
                $tam2 = count($aSaldo);
                for($j=0;$j<$tam2;$j++){
                    $fornec         = $aSaldo[$j]['fornecedor_id'];
                    inserirLogDb("fornecedor:",$fornec,__FUNCTION__);
                    $itemPedidoId   = $aSaldo[$j]['item_proc_compra_id'];
                    inserirLogDb("item Pedido:",$itemPedidoId,__FUNCTION__);
                    $valor          = $aSaldo[$j]['valor'];
                    inserirLogDb('valor',$valor,__FUNCTION__);
                    $itemContainerId = $aSaldo[$j]['item_container_id'];
                    inserirLogDb('item container:',$itemContainerId,__FUNCTION__);
                    $retCriacao = $this->criarRegCtaCorrenFornec($fornec,
                        $data,
                        $itemPedidoId,
                        $histCompl,
                        5,  
                        $valor * -1,
                        3, 
                        $id,
                        $itemContainerId
                    );
                    $descrRetCriacao = $this->convLogEmString($retCriacao);
                    inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                        "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                }
            }
            break;
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSomasCtaCorrenFornec($tipoMovto,
                                 $logQuebra,
                                 $numIdTitulo=0,
                                 $itemPedId=0,
                                 $itemContainerId=0,
                                 $fornecId=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $quebraCampos  = '';
    $quebraGroup   = '';
    $condTitulo    = '';
    $condItemPed   = '';
    $condContainer = '';
    $condFornec    = '';

    if($logQuebra == true){
        if($numIdTitulo == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'num_id_tit_ap',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'num_id_tit_ap',",");
        }
        if($itemPedId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'item_proc_compra_id',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'item_proc_compra_id',",");
        }
        if($itemContainerId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'item_container_id',",");
            $quebraGroup  = $this->util_incr_valor($quebraGroup,'item_container_id',",");
        }
        if($fornecId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'fornecedor_id',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'fornecedor_id',",");
        }

    }
    if($quebraGroup){
        $quebraGroup = " group by $quebraGroup ";
    }
    if($numIdTitulo <>0){
        $condTitulo = " AND num_id_tit_ap = $numIdTitulo ";
    }
    if($itemPedId <>0){
        $condItemPed = " AND  item_proc_compra_id = $itemPedId ";
    }

    if($itemContainerId <> 0){
        $condContainer = " AND  item_container_id = $itemContainerId ";
    }

    if($fornecId <> 0){
        $condFornec = " AND  fornec_id = $fornecId ";
    }
    if($quebraCampos <> ''){
        $quebraCampos = " , $quebraCampos ";
    }

    $tipo     = "multi"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as valor $quebraCampos";
    $condicao = "  cod_tipo_movto in ($tipoMovto) $condTitulo $condItemPed $condContainer $condFornec
                 $quebraGroup ";
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aRet;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function estornarSaldoPgtosItemPed($itemPedido,$historico='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aItens = $this->getSomasCtaCorrenFornec(4,true,0,$itemPedido);
    $data = date('Y-m-d');
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $numIdTitAp     = $aItens[$i]['num_id_tit_ap'];
            $fornecedorId   = $aItens[$i]['fornecedor_id'];
            $itemContainer  = $aItens[$i]['item_container_id'];
            $valor          = $aItens[$i]['valor'] * -1;

            $retCriacao = $this->criarRegCtaCorrenFornec($fornecedorId,$data,$itemPedido,$historico,4,$valor,3,
                $numIdTitAp,$itemContainer);
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 3 - movto negativo',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function verificarSaldoInicialFornec($fornec)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $retorno = false;
    $tabela = " pub.cta_corren_fornec_imp  ";
    $campo  = "fornecedor_id";
    $condicao = " fornecedor_id = $fornec and cod_tipo_movto = 1 ";
    $aResultado = $this->retornoSimplesTb01($tabela,$campo	,$condicao,"espec");
    if(is_array($aResultado)){
        $retorno = true ;
    }
    return $retorno;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarVlPagarItemPedido($itemProcCompra,$vlLancto,$acao)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

    $data = date('Y-m-d');
    $procCompraID = buscarProcCompraItem($itemProcCompra);
    $aPedido = getDadosPedidoImp($procCompraID);
    $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    $descLogGerarPrevisao = $this->convLogEmString($logGerarPrevisao);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb("Pedido de Compra $procCompraID integra cta.corrente fornecedor? ",$descLogGerarPrevisao,__FUNCTION__);
    if($logGerarPrevisao == 1) {
        $transacaoId = iniciarTransacao('gerarVlPagarItemPedido');
        setTransacaoUniversal($transacaoId);
        inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $vlSaldo = $this->getSaldoVlPagarItemPedido($itemProcCompra);
        $fornecedor = buscarFornecItemProcCompra($itemProcCompra);
        inserirLogDb("Fornecedor Item do Pedido", $fornecedor,__FUNCTION__);
        $descItem   = buscarDescItemProcCompra($itemProcCompra);
        $descItem   = str_replace("'"," ",$descItem);
        switch($acao){
            case 1:
                $descAcao = 'Inclusao ';
                break;
            case 2:
                $descAcao = 'Alteracao';
                break;
            case 3:
                $descAcao = 'Exclusao';
                break;
        }
        inserirLogDb('Descricao da Acao:',$descAcao,__FUNCTION__);
        $vlDif  = $vlLancto - $vlSaldo;
        inserirLogDb("Vl.Lancto passado por parametro", $vlLancto,__FUNCTION__);
        inserirLogDb("vl.saldo(item do pedido:$itemProcCompra)", $vlSaldo,__FUNCTION__);
        inserirLogDb("Vl. Diferenca", $vlDif,__FUNCTION__);
        if($vlDif <> 0  ){
            if($vlDif > 0){
                $historico = "Geracao de Lancamento automatico na $descAcao do item do pedido de importacao - $descItem";
                inserirLogDb('historico para diferenca maior que zero',$historico);

            }else{
                $historico = "Estorno de Geracao de Lancamento automatico na $descAcao do item do 
                            pedido de importacao - $descItem";
                inserirLogDb('historico para diferenca menor que zero',$historico);
            }
            inserirLogDb("chamada da funcao para criacao do movimento do conta corrente do fornecedor",
                'criaRegCtaCorrenFornec',__FUNCTION__);
            $retCriacao = $this->criarRegCtaCorrenFornec($fornecedor,$data,$itemProcCompra,$historico,3,$vlDif ,$acao);
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $acao",
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
        }
        finalizarTransacao($transacaoId);
    }else{
        inserirLogDb('Lancamento nao gerado',
            'pedido de compra configurado para nao integrar conta corrente fornecedor ',__FUNCTION__);
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoVlPagarItemPedido($itemProcCompra)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as vl_total ";
    $condicao = "  item_proc_compra_id = $itemProcCompra and cod_tipo_movto = 3 ";
    $aDados = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aDados)){
        $vlSaldo = $aDados[0]['vl_total'];
    }else{
        $vlSaldo = 0;
    }
    inserirLogDb("Total dos lancamentos para o item do pedido de compra = $itemProcCompra com tipo movto = 3(itens pedido)",
        $vlSaldo,__FUNCTION__);
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    return $vlSaldo;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function sincrRateioAntecipPedImp($procCompra,$histCompl,$logForcarRateio = false)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $retorno = 0;
    $prog = 'sincrRateioAntecipPedImp';
    $transacaoId = iniciarTransacao($prog);
    setTransacaoUniversal($transacaoId);
    $aPedido = getDadosPedidoImp($procCompra);
    if(is_array($aPedido)){
        $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    }else{
        $logGerarPrevisao = 0;
    }

    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    if($logGerarPrevisao == 0){
        $titulo = "Sincronizacao de Rateio de Pagtos - Ped.Importacao";
        inserirLogDb($titulo, "Pedido de compra configurado para nao integrar com cta.corrente fornecedor",
            __FUNCTION__
        );
    }else{
        $titulo = "Sincronizacao de Rateio de Pagtos - Ped.Importacao";
        inserirLogDb($titulo, "Busquei a lista de titulos a partir da funcao buscarTitAssociadosProcCompra -> $procCompra",
            __FUNCTION__
        );
        $listaTitulos = buscarTitAssociadosProcCompra($procCompra);
        inserirLogDb($titulo,"Lista de titulos: $listaTitulos",__FUNCTION__);
        if($listaTitulos <> ''){
            $aTitulos = explode(',',$listaTitulos);
            if(is_array($aTitulos)){
                $tam = count($aTitulos);
                for($i=0;$i<$tam;$i++){
                    $numIdTitAp = $aTitulos[$i];
                    $logRateio = verificarNecesAtualizPgtoPedido($numIdTitAp);
                    if($logForcarRateio == true){
                        $logRateio = $logForcarRateio;
                        inserirLogDb('Forcar Rateio','Sim',__FUNCTION__);
                    } else{
                        inserirLogDb('Forcar Rateio','Nao',__FUNCTION__);
                    }
                    if($logRateio == true){
                        $descrLogRateio = 'sim';
                    }else{
                        $descrLogRateio = 'nao';
                    }
                    inserirLogDb($titulo,"Eh necessario o rateio  $descrLogRateio",__FUNCTION__);
                    incrNivelCorrenteLogDb();
                    if($logRateio == true){
                        $this->gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl);
                        $retorno = 1;
                    }
                    decrNivelCorrenteLogDb();
                }
            }
        }
        finalizarTransacao($transacaoId);
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    return $retorno;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl='',$logEstorno=false)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $titLog = "Geracao de Rateio Pgtos - Ped.Imp";
    $data   = date('Y-m-d');
    $empImp = buscarEmpProcCompra($procCompra);
    $codEmp  = buscarcodEmpresa($empImp,'importacao','ems5');
    $codEstab = getEstabEms5($codEmp) ;
    $vlAdiantDolar  =   buscarVlMoeda($numIdTitAp,'','dolar' );
    $vlNegEmDolar   = buscarPonderacaoItensProcCompra($procCompra);
    $aItens = getIDItensProcCompra($procCompra);
    $fornecedor         = buscarFornecedorProcCompra($procCompra);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb("Fornecedor do pedido de compra",$fornecedor,__FUNCTION__);
    incrNivelCorrenteLogDb();
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId   = $aItens[$i]['item_proc_compra_id'];
            $vlItem             = buscarPonderacaoItensProcCompra($procCompra,'negociado',$itemProcCompraId);
            $pondItem           = $vlItem / $vlNegEmDolar;
            $vlPagtoItem        = $vlAdiantDolar * $pondItem;
            inserirLogDb('Composicao de Valores ',"item pedido:{$itemProcCompraId}",__FUNCTION__);
            incrNivelCorrenteLogDb();
            inserirLogDb('Vl.negociado do item ',$vlItem,__FUNCTION__);
            inserirLogDb('Vl.total ',$vlNegEmDolar,__FUNCTION__);
            inserirLogDb('Ponderacao Item ',$pondItem,__FUNCTION__);
            inserirLogDb('Vl.pagto item ',$vlPagtoItem,__FUNCTION__);
            decrNivelCorrenteLogDb();

            $vlSaldoRatItem     = $this->getSaldoFornecAntItem($fornecedor,$numIdTitAp,$itemProcCompraId);
            inserirLogDb("Saldo anterior do fornecedor do pedido de compra para o item e o adiantamento",
                            $vlSaldoRatItem,__FUNCTION__);
            $vlDif              = $vlPagtoItem + $vlSaldoRatItem;
            $vlDif              = round($vlDif,2);
            inserirLogDb("Vl.dif($vlDif) ","Vl.pagto item: {$vlPagtoItem} + vl. saldo rat.item: {$vlSaldoRatItem}",__FUNCTION__);
            if($logEstorno == true){
                inserirLogDb("Parametro para estornar igual a sim","Vl.dif = vl.saldo rat.item({$vlSaldoRatItem})",__FUNCTION__);
                $vlDif = $vlSaldoRatItem ;
            }
            if( $vlDif <> 0){
                if($vlDif > 0){
                    $sinal = -1;
                    $codAcao = 1;
                    $historico = " Rateio de Pagto - Pedido de Importacao $histCompl ";
                }else{
                    $sinal = -1;
                    $codAcao = 3;
                    $historico = " Estorno de Rateio de Pagto - Pedido de Importacao $histCompl ";
                }
                $retCriacao = $this->criarRegCtaCorrenFornec($fornecedor,$data,$itemProcCompraId,$historico,4,
                    $vlDif * $sinal,$codAcao,$numIdTitAp );
                $descrRetCriacao = $this->convLogEmString($retCriacao);

                inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $codAcao",
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);

            }
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function atuRatPagtoPedTitContainer($numIdTitAp, $histCompl='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb(' param titulo:',$numIdTitAp,__FUNCTION__);
    inserirLogDb(' param histCompl:',$histCompl,__FUNCTION__);
    inserirLogDb('antes da funcao getProcCompraPgto - param titulo:',$numIdTitAp,__FUNCTION__);
    $procCompraId = getProcCompraPgto($numIdTitAp);
    inserirLogDb('pedido de compra',$procCompraId,__FUNCTION__);
    if($procCompraId <> 0){
        inserirLogDb('pedido de compra zerado?','nao',__FUNCTION__);
        inserirLogDb('vou chamar a funcaFo sincrRateioAntecipPedImp - param titulo|hist',"$numIdTitAp | $histCompl",__FUNCTION__);
        incrNivelCorrenteLogDb();
        $this->sincrRateioAntecipPedImp($procCompraId,$histCompl, true);
        decrNivelCorrenteLogDb();
    }else{
        inserirLogDb('pedido de compra zerado?','sim',__FUNCTION__);
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function atuRatPagtoPedItemContainer($itemPedido,$histCompl)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $procCompraId = buscarProcCompraItem($itemPedido) ;
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Pedido de Compra(ID) do item do container',$procCompraId,__FUNCTION__);
    if($procCompraId <> 0){
        incrNivelCorrenteLogDb();
        $this->sincrRateioAntecipPedImp($procCompraId,$histCompl);
        decrNivelCorrenteLogDb();
    }else{
        inserirLogDb('Item do Container sem item do Pedido de Compra Associado');
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoFornecAntItem($fornec, $numIdTitAp,$itemProcCompra )
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as vl_total ";
    $condicao = "  fornecedor_id = $fornec and item_proc_compra_id = $itemProcCompra 
                 and num_id_tit_ap = $numIdTitAp and cod_tipo_movto = 4";
    $aDados = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aDados)){
        $vlSaldo = $aDados[0]['vl_total'];
    }else{
        $vlSaldo = 0;
    }
    return $vlSaldo;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoFornecTituloItemRatContainer($fornec, $numIdTitAp,$itemProcCompra,$itemContainerId )
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as vl_total ";
    $condicao = "  fornecedor_id = $fornec and item_proc_compra_id = $itemProcCompra 
                 and num_id_tit_ap = $numIdTitAp 
                 and item_container_id = $itemContainerId and cod_tipo_movto = 5";
    $aDados = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aDados)){
        $vlSaldo = $aDados[0]['vl_total'];
    }else{
        $vlSaldo = 0;
    }
    return $vlSaldo;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarRateioFornecAntecipsContainer($container,$histCompl='',$logEstorno=false,$titulo=0,$itemContainer=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $data = date('Y-m-d');
    $vlProformaEmDolar  = buscarTotCustoPrevDolarContainer($container, 'proforma');
    $codFornecContainer = buscarFornecedorContainer($container);
    $estab         = buscarEstabContainer($container);
    $estab          = getEstabEms5($estab);
    $listaTitulos     = buscarTitAssociadosContainer($container);
    $transacaoId      = iniciarTransacao(__FUNCTION__);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('container passado por parametro',$container,__FUNCTION__);
    inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    inserirLogDb('Lista de Titulos Associados ao Container',$listaTitulos,__FUNCTION__);

    if($listaTitulos <> ''){
        $aTitulos = explode(',',$listaTitulos);
        if(is_array($aTitulos)){
            $tam = count($aTitulos);
            incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $numIdTitAp = $aTitulos[$i];
                if($numIdTitAp == '' or $numIdTitAp == 0){
                    continue;
                }
                inserirLogDb('Num.Tit.AP.',$numIdTitAp,__FUNCTION__);
                if($titulo<> 0){
                    if($titulo <> $numIdTitAp){
                        continue;
                    }
                }
                $vlTitDolar = buscarVlMoeda($numIdTitAp,'','dolar');
                inserirLogDb('Vl.Tit.Dolar',$vlTitDolar,__FUNCTION__);
                $aItens     = buscarIDItensContainer($container);
                $descAItens = $this->convArrayToString($aItens);
                inserirLogDb('Array Itens do container',$descAItens,__FUNCTION__);
                if(is_array($aItens)){
                    $tam2 = count($aItens);
                    incrNivelCorrenteLogDb();
                    for($j=0;$j<$tam2;$j++){
                        $itemContainerId  = $aItens[$j]['item_container_id'];
                        inserirLogDb('Id Item do Container',$itemContainerId,__FUNCTION__);
                        if($itemContainer <> 0){
                            if($itemContainer <> $itemContainerId){
                                continue;
                            }
                        }
                        $vlProformaItem        = buscarTotCustoPrevDolarContainer($container,'proforma',$itemContainerId);
                        $itemProcCompraId = $aItens[$j]['item_proc_compra_id'];
                        inserirLogDb('Id  item ped.imp.',$itemProcCompraId,__FUNCTION__);
                        $descItem         = buscarDescItemProcCompra($itemProcCompraId);
                        $codFornecPedImp  = buscarFornecItemProcCompra($itemProcCompraId);
                        if($vlProformaEmDolar * $vlTitDolar <> 0){
                            $vlLancto         = $vlProformaItem / $vlProformaEmDolar * $vlTitDolar;
                        }else{
                            $vlLancto = 0;
                        }

                        inserirLogDb('Valores da Formula de calculo do vl.lancto',$vlLancto,__FUNCTION__);
                        incrNivelCorrenteLogDb();
                        inserirLogDb('vl.proforma Item',$vlProformaItem,__FUNCTION__);
                        inserirLogDb('vl.proforma em dolar',$vlProformaEmDolar,__FUNCTION__);
                        inserirLogDb('vl.tit.dolar',$vlTitDolar,__FUNCTION__);
                        decrNivelCorrenteLogDb();
                        
                        $vlSaldoCtaFornecPedImp      = round($this->getSaldoFornecTituloItemRatContainer ($codFornecPedImp,
                            $numIdTitAp,$itemProcCompraId,$itemContainerId),2);
                        inserirLogDb('saldo ja lancado no conta corrente para o item 
                                   proc compra e para o titulo',$vlSaldoCtaFornecPedImp,__FUNCTION__);
                        $vlDifPedImp                 = round($vlLancto + $vlSaldoCtaFornecPedImp,2) ;
                        inserirLogDb('Valores que compoem o Dif.Ped.Imp',$vlDifPedImp,__FUNCTION__);
                        incrNivelCorrenteLogDb();
                        inserirLogDb('vl.lancto',$vlLancto,__FUNCTION__);
                        inserirLogDb('vl.saldo Cta Corren fornec ped imp',$vlSaldoCtaFornecPedImp,__FUNCTION__);
                        decrNivelCorrenteLogDb();
                        $descLogEstorno = $this->convLogEmString($logEstorno);
                        inserirLogDb('Estorno?',$descLogEstorno,__FUNCTION__);
                        if($logEstorno == true){
                            $vlDifPedImp = $vlSaldoCtaFornecPedImp;
                        }
                        

                        if($vlDifPedImp <> 0){
                            inserirLogDb('Valor da Diferenca Ped.Imp. Diferente de zero?','sim',__FUNCTION__);
                            if($codFornecContainer <> $codFornecPedImp){
                                inserirLogDb('fornecedor do container diferente do fornecedor do pedido?','sim',__FUNCTION__);
                                $histFornec = " para o fornecedor $codFornecPedImp ";
                            } else{
                                $histFornec = " ";
                                inserirLogDb('fornecedor do container diferente do fornecedor do pedido?','nao',__FUNCTION__);
                            }
                            if($vlDifPedImp > 0){ 
                                inserirLogDb('Diferenca do Pedido Imp. maior quero?','sim. Rateio',__FUNCTION__);
                                $codAcao   = 1;
                                $sinal     = -1;
                                $historico = "Rateio de valor pago ao fornecedor $codFornecContainer 
                                    $histFornec , referente ao item $descItem alocado ao container $container $histCompl";
                            }else{ 
                                inserirLogDb('Diferenca do Pedido Imp. maior quero?','nao. Estorno.',__FUNCTION__);
                                $codAcao   = 3;
                                $sinal     = -1;
                                $historico = "ESTORNO da Rateio de valor pago ao fornecedor $codFornecContainer  
                                $histFornec , referente ao item $descItem alocado ao container $container $histCompl";
                            }
                            $retCriacao = $this->criarRegCtaCorrenFornec(
                                $codFornecPedImp,
                                $data,
                                $itemProcCompraId,
                                $historico,
                                5,
                                $vlDifPedImp * $sinal,
                                $codAcao,
                                $numIdTitAp,
                            $itemContainerId);
                            $descrRetCriacao = $this->convLogEmString($retCriacao);
                            inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao $codAcao",
                                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        }else{
                            inserirLogDb('Valor da Diferenca Ped.Imp. Diferente de zero?','nao',__FUNCTION__);
                        }
                    }
                    decrNivelCorrenteLogDb();
                }
            }
            decrNivelCorrenteLogDb();
        }
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoId);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarRateioFornecContainer($container, $tipoMovto)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $vlNegEmDolar  = buscarTotCustoPrevDolarContainer($container, 'negociado');
    $vlPagoEmDolar = buscarTotPagoContainer($container,'dolar');
    $codFornecContainer = buscarFornecedorContainer($container);
    $data = date('Y-m-d');
    $aItens = buscarIDItensContainer($container);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemContainerId  = $aItens[$i]['item_container_id'];
            $vlNegItem        = buscarTotCustoPrevDolarContainer($container, 'negociado',$itemContainerId);
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $descItem         = buscarDescItemProcCompra($itemProcCompraId);
            $codFornecPedImp  = buscarFornecItemProcCompra($itemProcCompraId);
            $vlLancto         = $vlNegItem / $vlNegEmDolar * $vlPagoEmDolar;
            if($codFornecContainer <> $codFornecPedImp){
                switch($tipoMovto){
                    case 1: 
                        $historico = "Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 - negativo ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto,0 );
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        break;
                    case 2: 
                        $historico = "ESTORNO da Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                         $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto ,0);
                         $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        break;
                }
            }
        }
    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoAntCtaCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aDados = $this->getDadosCtaCorrenFornecImp($fornecedor,'vl_lancto','cod_tipo_movto = 1' );
    if(is_array($aDados)){
        $vlSaldoAnterior = $aDados[0]['vl_lancto'];
    }else{
        $vlSaldoAnterior = 0;
    }
    return $vlSaldoAnterior;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getTotLancManualFornecImp($fornecedor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $vlSoma = 0;
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as tot ";
    $condicao = "  cod_tipo_movto = 2  and fornecedor_id = $fornecedor ";
    $aTot = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTot)){
        $vlSoma = $aTot[0]['tot'];
    }
    return $vlSoma;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCpSomaSaldoPorSitContainer()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $cp = "coalesce(sum( case cod_tipo_movto
    when 3 then    	
    	vl_lancto * itens.qt_alocada /
    	case when itens_ped.qt_comprada > 0 then itens_ped.qt_comprada 
    	else 1 end    	
    when 10 then 
    	vl_lancto * itens.qt_alocada /
    		case when itens_ped.qt_comprada > 0 then itens_ped.qt_comprada 
    		else 1 end    	
    else vl_lancto
    end )|0) as tot     ";
    return $cp;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoNaoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $vlSoma = 0;
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    $campos   = " coalesce(sum(vl_lancto)|0) as tot ";
    $condicao = "  item_proc_compra_id not in (select item_proc_compra_id from pub.itens_container)
     and fornecedor_id = $fornecedor
     and cod_tipo_movto > 2 ";
    $aTot = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTot)){
        $vlSoma += $aTot[0]['tot'];
    }
    $tipo     = "unico"; 
    $tabela   = " PUB.cta_corren_fornec_imp cta, 
    pub.\"pp-container\" container, 
    pub.itens_container itens, pub.itens_proc_compra itens_ped  ";
    $campos   = $this->getCpSomaSaldoPorSitContainer();
    $condicao = "  itens.item_proc_compra_id = cta.item_proc_compra_id
                and itens.container_id = container.\"nr-container\"
                and container.situacao_container_id <= 2
                and fornecedor_id = $fornecedor
                and cod_tipo_movto > 2 
                and (
                    num_id_tit_ap = 0 or
                    num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos
                    where pgtos.container_id = container.\"nr-container\")
                 )and itens_ped.item_proc_compra_id = itens.item_proc_compra_id"
    ;
    $aTot2 = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTot2)){
        $vlSoma += $aTot2[0]['tot'];
    }
    return $vlSoma;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $sit = $this->getDeParaSitCta('embarcado');
    $vlSoma = 0;
    $tipo     = "unico"; 
    $tabela   = " PUB.cta_corren_fornec_imp cta, pub.\"pp-container\" container, 
    pub.itens_container itens, pub.itens_proc_compra itens_ped  ";
    $campos   = $this->getCpSomaSaldoPorSitContainer();
    $condicao = "  itens.item_proc_compra_id = cta.item_proc_compra_id
                and itens.container_id = container.\"nr-container\"
                and container.situacao_container_id in ($sit)
                and fornecedor_id = $fornecedor
                and cod_tipo_movto > 2 
                and (
num_id_tit_ap = 0 or
num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos
 where pgtos.container_id = container.\"nr-container\")
                 ) and itens_ped.item_proc_compra_id = itens.item_proc_compra_id ";
    $aTot = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTot)){
        $vlSoma += $aTot[0]['tot'];
    }
    return $vlSoma;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSaldoEntreguePortoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $sit = $this->getDeParaSitCta('entregue');
    $vlSoma = 0;
    $tipo     = "unico"; 
    $tabela   = " PUB.cta_corren_fornec_imp cta, pub.\"pp-container\" container, 
    pub.itens_container itens, pub.itens_proc_compra itens_ped ";
    $campos   = $this->getCpSomaSaldoPorSitContainer();
    $condicao = "  itens.item_proc_compra_id = cta.item_proc_compra_id
                and itens.container_id = container.\"nr-container\"
                and container.situacao_container_id in($sit) 
                and fornecedor_id = $fornecedor
                and cod_tipo_movto > 2 
                 and (
                        num_id_tit_ap = 0 or
                        num_id_tit_ap in (select num_id_tit_ap from pub.pagtos_container pgtos
                        where pgtos.container_id = container.\"nr-container\")
                 ) and itens_ped.item_proc_compra_id = itens.item_proc_compra_id ";
    $aTot = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTot)){
        $vlSoma += $aTot[0]['tot'];
    }
    return $vlSoma;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getDadosCtaCorrenFornecImp($fornecedor,$campos='',$cond='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','cta_corren_fornec_imp');
        $campos = $aCampos['campos'];
    }
    $condicao = '';
    $condicao =  $this->util_incr_valor($condicao, " fornecedor_id = $fornecedor ", " AND ",
            true) ;

    if($cond <> ''){
        $condicao =  $this->util_incr_valor($condicao, $cond, " AND ",true) ;
    }
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    return $aReg;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function eliminarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    inserirLogDb('Inicio',__FUNCTION__,__FUNCTION__);
    $aItens = getIDItensProcCompra($pedImp);
    if(is_array($aItens)){
        incrNivelCorrenteLogDb();
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $id = $aItens[$i]['item_proc_compra_id'];
            inserirLogDb('ID Item do Container - Registros serao deletados',$id,__FUNCTION__);
            $cmd = "delete from pub.cta_corren_fornec_imp where item_proc_compra_id = $id
            and cod_tipo_movto > 2";
            
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
      
            inserirLogDb('Registros deletados',"SIM-Comando:$cmd",__FUNCTION__);

        }
        decrNivelCorrenteLogDb();
    }else{
        inserirLogDb('Nao foram encontrados itens','SIM',__FUNCTION__);
    }
    inserirLogDb('Final',__FUNCTION__,__FUNCTION__);
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function ajustarCtaCorrenFornec()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    inserirLogDb('Inicio Bloco 0 - exclusao dos lancamentos dos pedidos de compra que nao integram com o cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    incrNivelCorrenteLogDb();
    $this->eliminarLanctosPedidosNaoIntegrCtaCorrente();
    decrNivelCorrenteLogDb();
    inserirLogDb('FIM Bloco 0 - exclusao dos lancamentos dos pedidos de compra que nao integram com o cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Inicio Bloco 1 - GERACAO DE LANCAMENTOS PEDIDOS INTEGR.CTA.CORREN. ',__FUNCTION__,__FUNCTION__);
    incrNivelCorrenteLogDb();
    $this->gerarLanctosPedidosIntegrCtaCorrente();
    decrNivelCorrenteLogDb();
    inserirLogDb('Fim Bloco 1 - GERACAO DE LANCAMENTOS PEDIDOS INTEGR.CTA.CORREN. ',__FUNCTION__,__FUNCTION__);
    $this->eliminarLanctosPedidosNaoIntegrCtaCorrente();


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $listaItensPedido = '';
    $listaContainersGeral = '';
    $transacaoID = iniciarTransacao(__FUNCTION__);
    setTransacaoUniversal($transacaoID);
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('transacao',$transacaoID,__FUNCTION__);

    inserirLogDb('inicio Bloco 0 - exclusao dos lancamentos do pedido de compra no cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    incrNivelCorrenteLogDb();
    $this->eliminarLanctosCtaCorrenPedImp($pedImp);
    decrNivelCorrenteLogDb();
    inserirLogDb('Fim Bloco 0 - exclusao dos lancamentos do pedido de compra no cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Inicio Bloco 1 - geracao dos lancamentos de valores a pagar a partir dos itens do pedido de compra',
        __FUNCTION__,__FUNCTION__);
    $aItens = getIDItensProcCompra($pedImp);
    inserirLogDb('chamei a getIDItensProcCompra -> pedido',$pedImp,__FUNCTION__);
    if(is_array($aItens)){
        incrNivelCorrenteLogDb();
        inserirLogDb('ACHEI itens no pedido de compra ',$pedImp,__FUNCTION__);
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            inserirLogDb('item proc compra',$itemProcCompraId,__FUNCTION__);
            $listaItensPedido = $this->util_incr_valor($listaItensPedido,$itemProcCompraId);
            inserirLogDb('chamei a retornarCampoItemProcCompra -> pedido',$itemProcCompraId);
            $aDadosItem =  retornarCampoItemProcCompra($itemProcCompraId,'qt_comprada,vl_negociado');
            if(is_array($aDadosItem)){
                $qtComprada  = $aDadosItem[0]['qt_comprada'];
                inserirLogDb('qt.comprada',$qtComprada,__FUNCTION__);
                $vlNegociado = $aDadosItem[0]['vl_negociado'];
                inserirLogDb('vl.negociado',$vlNegociado,__FUNCTION__);
                $valor = $qtComprada * $vlNegociado;
                inserirLogDb('valor',$valor);
                $this->gerarVlPagarItemPedido($itemProcCompraId,$valor,1);
                inserirLogDb('apos chamar a funcao gerarVlPagarItemPedido','acao 1',__FUNCTION__);
            }else{
                $valor = 0;
                inserirLogDb('nao achei o registro do item',$itemProcCompraId,__FUNCTION__);
            }
        }
        decrNivelCorrenteLogDb();
    }else{
        inserirLogDb('Nao achei itens no pedido de compra ',$pedImp,__FUNCTION__);
    }
    inserirLogDb('Final Bloco 1 - geracao dos lancamentos de valores a pagar a partir dos itens do pedido de compra', __FUNCTION__,__FUNCTION__);

    inserirLogDb('Inicio Bloco 2 - geracao dos lancamentos de adiantamento',
        __FUNCTION__,__FUNCTION__);
    inserirLogDb('vou chamar a funcao buscarTitAssociadosProcCompra -> pedido',$pedImp,__FUNCTION__);
    $listaPagtosPedido = buscarTitAssociadosProcCompra($pedImp);
    inserirLogDb('Lista de Pagtos Pedido',$listaPagtosPedido,__FUNCTION__);
    $aPagtosPedido = explode(',',$listaPagtosPedido);
    if(is_array($aPagtosPedido) and $listaPagtosPedido <> '' ){
        incrNivelCorrenteLogDb();
        $tam = count($aPagtosPedido);
        for($i=0;$i< $tam; $i++){
            $idPgto = $aPagtosPedido[$i];
            inserirLogDb('numero do ID do adiantamento',$idPgto,__FUNCTION__);
            $historico = "Geracao automatica na associacao de antecipacao de pagto ao 
            Pedido de Importacao:$pedImp - Titulo:$idPgto";
            $this->gerarRateioAntecipPedImp($pedImp,$idPgto,$historico);
            inserirLogDb('Apos chamar a funcao $this->gerarRateioAntecipPedImp(pedImp,idPgto,historico)',"($pedImp,$idPgto,$historico)",__FUNCTION__);

        }
    }
    inserirLogDb('Final Bloco 2 - geracao dos lancamentos de adiantamento',  __FUNCTION__,__FUNCTION__);
    inserirLogDb('Inicio Bloco 3 - geracao dos lancamentos de adiantamento associados ao container',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Lista de Itens do Pedido gerada no bloco 1 ',$listaItensPedido);
    $aItensPedido = explode(',',$listaItensPedido);
    if(is_array($aItensPedido)){
        incrNivelCorrenteLogDb();
        $tam = count($aItensPedido);
        inserirLogDb('Lista de itens Vazia?','Nao(qt.$tam)',__FUNCTION__);
        for($i=0;$i< $tam; $i++){
            $itemPedido = $aItensPedido[$i];
            if($itemPedido == ''){
                continue;
            }
            inserirLogDb('item pedido', $itemPedido,__FUNCTION__);
            inserirLogDb('vou chamar a funcao getIdContainersAlocItemPedImp(itemPedido)',"($itemPedido)",__FUNCTION__);
            $listaContainers = getIdContainersAlocItemPedImp($itemPedido);
            inserirLogDb('Lista de Containers - retorno getIdContainerAlocItemPedImp',$listaContainers);
            $aContainers = explode(',',$listaContainers);
            if($listaContainers <> ''){
                $listaContainersGeral = $this->util_incr_valor($listaContainersGeral,$listaContainers,',');
            }
            if(is_array($aContainers) and $listaContainers <> ''){
                incrNivelCorrenteLogDb();
                $tam2 = count($aContainers);
                for($j=0;$j< $tam2; $j++){
                    $container = $aContainers[$j];
                    inserirLogDb('CONTAINER',$container,__FUNCTION__);
                    inserirLogDb('vou chamar a funcao estornarPagtoscontainerPedImp(container)',"($container)",__FUNCTION__);
                    incrNivelCorrenteLogDb();
                    $this->estornarPgtosContainerPedImp($container,'ASSOCIAcaO DE TITULO');
                    decrNivelCorrenteLogDb();
                    inserirLogDb('vou chamar a funcao $this->gerarRateioFornecAntecipsContainer(container)',"($container)",__FUNCTION__);
                    incrNivelCorrenteLogDb();
                    $this->gerarRateioFornecAntecipsContainer($container,'ASSOCIAcaO DE TITULO ');
                    decrNivelCorrenteLogDb();
                    
                }
                decrNivelCorrenteLogDb();
            }
        }
        decrNivelCorrenteLogDb();
    }else{
        inserirLogDb('Lista de itens Vazia?','SIM',__FUNCTION__);
    }
    inserirLogDb('Fim Bloco 3 - geracao dos lancamentos de adiantamento associados ao container',__FUNCTION__,__FUNCTION__);

    inserirLogDb('Inicio Bloco 4 - geracao dos lancamentos de confirmacao da qt. embarcada ',__FUNCTION__,__FUNCTION__);
    inserirLogDb('lista de containers - qt.emb',$listaContainersGeral,__FUNCTION__);
    $aContainersGeral = explode(',',$listaContainersGeral);
    if(is_array($aContainersGeral) and $listaContainersGeral <> '') {
          $tam = count($aContainersGeral);
          incrNivelCorrenteLogDb();
          for($i=0;$i< $tam; $i++){
              $containerEmb = $aContainersGeral[$i];
              if($containerEmb == ''){
                  continue;
              }
              inserirLogDb('CONTAINER EMB.',$containerEmb,__FUNCTION__);
              inserirLogDb('vou buscar itens do container',$containerEmb,__FUNCTION__);
              $aItensContainer = buscarIDItensContainer($containerEmb);
              if(is_array($aItensContainer)){
                  inserirLogDb('Itens Encontrados?','SIM',__FUNCTION__);
                  $tam3 = count($aItensContainer);
                  incrNivelCorrenteLogDb();
                  for($j=0;$j< $tam3; $j++){
                      $itemContainerId = $aItensContainer[$j]['item_container_id'];
                      inserirLogDb('item do container - vou chamar a funcao sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
                      sincrQtEmbarcadaCtaCorrenFornec($itemContainerId);
                      inserirLogDb('item do container - apos chamar a funcao sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
                  }
                  decrNivelCorrenteLogDb();
              }else{
                  inserirLogDb('Itens Encontrados?','NAO',__FUNCTION__);
              }
          }
          decrNivelCorrenteLogDb();

    }
    inserirLogDb('FIM Bloco 4 - geracao dos lancamentos de confirmacao da qt. embarcada ',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoID);
    inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function gerarLanctosPedidosIntegrCtaCorrente()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('vou chamar a funcao getProcsCompraIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = getProcsCompraIntegrCtaFornec();
    inserirLogDb('Apos chamar a funcao getProcsCompraIntegrCtaFornec - lista de pedidos',$listaPedidos,__FUNCTION__);
    $aPedidos = explode(',',$listaPedidos);

    if(is_array($aPedidos)){
        incrNivelCorrenteLogDb();
        $tam = count($aPedidos);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPedidos[$i];
            inserirLogDb('Pedido de Compra - vou chamar a funcao - gerarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            incrNivelCorrenteLogDb();
            $this->gerarLanctosCtaCorrenPedImp($pedido);
            inserirLogDb('Pedido de Compra - Apos a funcao - gerarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            decrNivelCorrenteLogDb();
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function eliminarLanctosPedidosNaoIntegrCtaCorrente()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('vou chamar a funcao getProcsCompraNaoIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = getProcsCompraNaoIntegrCtaFornec();
    inserirLogDb('Apos chamar a funcao getProcsCompraNaoIntegrCtaFornec - lista de pedidos',$listaPedidos,__FUNCTION__);
    $aPedidos = explode(',',$listaPedidos);

    if(is_array($aPedidos) and $listaPedidos <> ''){
        incrNivelCorrenteLogDb();
        $tam = count($aPedidos);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPedidos[$i];
            inserirLogDb('Pedido de Compra - vou chamar a funcao - eliminarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            incrNivelCorrenteLogDb();
            $this->eliminarLanctosCtaCorrenPedImp($pedido);
            inserirLogDb('Pedido de Compra - Apos a funcao - eliminarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            decrNivelCorrenteLogDb();
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getDeParaSitCta($sitCta)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    switch ($sitCta){
        case 'nao_embarcado':
            $vlPadrao ='1,2' ;
            break;
        case 'embarcado':
            $vlPadrao = '3,4,5';
            break;
        case 'entregue':
            $vlPadrao = '6,7,8,9';
            break;
    }
    $param = "cods_sit_$sitCta";
    $vlParam =  $this->buscarParametroIma($param,$vlPadrao);
    return $vlParam;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

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
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 

            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Db->ErrorMsg();
      } 

            break;
        case 'ems2ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems2ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_ems2ima->ErrorMsg();
      } 

            break;
        case 'ems2med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ems2med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_ems2med->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ticontrole2->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Ini->nm_db_ticontrole2->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $meus_dados = false;
          $meus_dados_erro = $this->Db->ErrorMsg();
      } 

    }

    if ($meus_dados  === false)
  {
      $erro ="Erro de acesso retornoSimplesTB01.Conexão $conexao  Mensagem = " . $meus_dados_erro ;

  }
  elseif (empty($meus_dados ))
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

          
          $aRetorno[0][$nomeCampo] = $meus_dados[0][$i];
          $lAchou = 1;

	  }

      
  }
   if($lAchou == 0){
       $aRetorno = '';
   }
   return $aRetorno;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

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
      if ($dados = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 


            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Db->ErrorMsg();
      } 


            break;
        case 'ems2ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ems2ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ems2ima->ErrorMsg();
      } 

            break;
        case 'ems2med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ems2med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ems2med->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ticontrole2->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ticontrole2->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Db->ErrorMsg();
      } 

    }


    if ($dados  === false){
    $erro =  "Erro de acesso. Mensagem = " . $dados_erro ;
    }
    else{
    while (!$dados->EOF){
        for($i = 0; $i < count($aCampos);$i++){
            $aApelido = explode(' as ', $aCampos[$i]);
            if(count($aApelido) > 1 ){
                $nomeCampo = ltrim(rtrim($aApelido[1]));
            }
            else{
                $nomeCampo = ltrim(rtrim($aApelido[0]));
            }
            
            $aRetorno[$iCont][$nomeCampo] =  $dados->fields[$i];
            $lAchou = 1;
        }
        $iCont++;
        
        $dados->MoveNext();
    }
    $dados->Close();
}
    if($lAchou == 0){
        $aRetorno = '';
    }
    $this->inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,__FUNCTION__);
    return $aRetorno;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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
      $id = array();
      if ($SCrx = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $id[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $id = false;
          $id_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $id = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $id[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $id = false;
          $id_erro = $this->Db->ErrorMsg();
      } 

    }

    if ($id  === false)
    {
        echo "Erro de acesso. Mensagem = " . $id_erro ;
        $id = 0;
    }
    elseif (empty($id ))
    {
        $id = 0;
    }
    else
    {
        $id = $id[0][0];
    }
    return $id;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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
      if ($dados = $this->Ini->nm_db_ems5->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ems5->ErrorMsg();
      } 


            break;
        case 'espec':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Db->ErrorMsg();
      } 

            break;
        case 'comum':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_comum->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_comum->ErrorMsg();
      } 

            break;
        case 'ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case 'med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
        case 'multi':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

            break;
        case 'cfsc':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_cfsc->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_cfsc->ErrorMsg();
      } 

            break;
        case 'log_db':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_log_db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_log_db->ErrorMsg();
      } 

            break;
        case 'geral':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_geral->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_geral->ErrorMsg();
      } 

            break;
        case 'dinamico':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_dinamico->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_dinamico->ErrorMsg();
      } 

            break;
        default:
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Db->ErrorMsg();
      } 

    }
    if(getLogSql() == 1){
        inserirLogDb('comando SQL - sql livre',$sql,__FUNCTION__);
    }
    if ($dados   === false){
    if(getLogSql() == 1){
        inserirLogDb('erro comando SQL - conexao:'.$conexao,$dados_erro ,__FUNCTION__);
        }
    echo "Erro de acesso. Mensagem = " . $dados_erro ;
    }else{
    while (!$dados->EOF) {
        for ($i = 0; $i < count($aCampos); $i++) {
            $aApelido = explode(' as ', $aCampos[$i]);
            if (count($aApelido) > 1) {
                $nomeCampo = ltrim(rtrim($aApelido[1]));
            } else {
                $nomeCampo = ltrim(rtrim($aApelido[0]));
            }
            if($logUTF8 == 1){
                $cp = utf8_encode($dados->fields[$i]);
            }
            else{
                $cp =$dados->fields[$i];
            }
            $aRetorno[$iCont][$nomeCampo] = $cp ;
            $lAchou = true;
        }
        $iCont++;
        
        $dados->MoveNext();
    }
    $dados->Close();
}
    if ($lAchou == false) {
        $aRetorno = '';
    }
	return $aRetorno;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_fornec_imp_entregue']['inicio']);
}

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.CURRVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $seq = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $seq[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $seq = false;
          $seq_erro = $this->Db->ErrorMsg();
      } 

    if ($seq  === false){
    echo "Erro de Acesso função buscarvlSequenciaEspec. Messagem=". $seq_erro  ;
	}
	elseif (empty($seq )){
}
	else{
    $valor = $seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.NEXTVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $seq = array();
      if ($SCrx = $this->Ini->nm_db_especw->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $seq[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $seq = false;
          $seq_erro = $this->Ini->nm_db_especw->ErrorMsg();
      } 

    if ($seq  === false){
    echo "Erro de Acesso função buscarvlSequenciaEspec. Messagem=". $seq_erro  ;
	}
	elseif (empty($seq )){
}
	else{
    $valor = $seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['cons_cta_corren_fornec_imp_entregue']['contr_erro'] = 'off';
}
}

?>
