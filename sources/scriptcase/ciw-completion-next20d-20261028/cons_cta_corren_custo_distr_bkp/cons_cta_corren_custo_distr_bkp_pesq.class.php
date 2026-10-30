<?php

class cons_cta_corren_custo_distr_bkp_pesq
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
   var $NM_case_insensitive;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_fornecedor_estrangeiro']['opc_psq'] = false; 
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['path_libs_php'] = $this->Ini->path_lib_php;
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
      $this->NM_case_insensitive = true;
      $this->init();
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao'] = "igual";
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
                  $Opt_filter .= "<option value=\"\">" . cons_cta_corren_custo_distr_bkp_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . cons_cta_corren_custo_distr_bkp_pack_protect_string($Tipo_filter[0]) . "\">.." . cons_cta_corren_custo_distr_bkp_pack_protect_string($Cada_filter) .  "</option>\r\n";
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
                  $Opt_filter .= "<option value=\"\">" .  cons_cta_corren_custo_distr_bkp_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . cons_cta_corren_custo_distr_bkp_pack_protect_string($Tipo_filter[0]) . "\">.." . cons_cta_corren_custo_distr_bkp_pack_protect_string($Cada_filter) .  "</option>\r\n";
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
      if ($this->NM_ajax_opcao == 'autocomp_valor')
      {
          $valor = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_valor($valor);
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
      if ($this->NM_ajax_opcao == 'autocomp_descricao_item')
      {
          $descricao_item = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_descricao_item($descricao_item);
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
      if ($this->NM_ajax_opcao == 'autocomp_codigo_erp')
      {
          $codigo_erp = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_codigo_erp($codigo_erp);
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
      if ($this->NM_ajax_opcao == 'autocomp_container')
      {
          $container = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_container($container);
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
      if ($this->NM_ajax_opcao == 'autocomp_cod_emit_forn')
      {
          $cod_emit_forn = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_cod_emit_forn($cod_emit_forn);
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
      if ($this->NM_ajax_opcao == 'autocomp_fornec_pi')
      {
          $fornec_pi = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_fornec_pi($fornec_pi);
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
      if ($this->NM_ajax_opcao == 'autocomp_cod_proc_fornec_pedido')
      {
          $cod_proc_fornec_pedido = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_cod_proc_fornec_pedido($cod_proc_fornec_pedido);
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
   function lookup_ajax_historico($historico)
   {
      $historico = substr($this->Db->qstr($historico), 1, -1);
            $historico_look = (is_string($historico) ? substr($this->Db->qstr($historico), 1, -1) : $historico); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct HISTORICO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  #lowerI#HISTORICO#lowerF# like #lowerI#'%" . $historico . "%'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
   
   function lookup_ajax_valor($valor)
   {
      $valor = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $valor);
      $valor = str_replace($_SESSION['scriptcase']['reg_conf']['dec_num'], ".", $valor);
      $valor = substr($this->Db->qstr($valor), 1, -1);
            $valor_look = (is_string($valor) ? substr($this->Db->qstr($valor), 1, -1) : $valor); 
      $nmgp_def_dados = array(); 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (VALOR AS TEXT)  like '%" . $valor . "%'"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (VALOR AS VARCHAR)  like '%" . $valor . "%'"; 
      }
      else
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  VALOR like '%" . $valor . "%'"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
              nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
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
   
   function lookup_ajax_descricao_item($descricao_item)
   {
      $descricao_item = substr($this->Db->qstr($descricao_item), 1, -1);
            $descricao_item_look = (is_string($descricao_item) ? substr($this->Db->qstr($descricao_item), 1, -1) : $descricao_item); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct DESCRICAO_ITEM from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  #lowerI#DESCRICAO_ITEM#lowerF# like #lowerI#'%" . $descricao_item . "%'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
   
   function lookup_ajax_codigo_erp($codigo_erp)
   {
      $codigo_erp = substr($this->Db->qstr($codigo_erp), 1, -1);
            $codigo_erp_look = (is_string($codigo_erp) ? substr($this->Db->qstr($codigo_erp), 1, -1) : $codigo_erp); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CODIGO_ERP from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  #lowerI#CODIGO_ERP#lowerF# like #lowerI#'%" . $codigo_erp . "%'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
   
   function lookup_ajax_container($container)
   {
      $container = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $container);
      $container = substr($this->Db->qstr($container), 1, -1);
            $container_look = (is_string($container) ? substr($this->Db->qstr($container), 1, -1) : $container); 
      $nmgp_def_dados = array(); 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (CONTAINER AS TEXT)  like '%" . $container . "%'"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (CONTAINER AS VARCHAR)  like '%" . $container . "%'"; 
      }
      else
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  CONTAINER like '%" . $container . "%'"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
   
   function lookup_ajax_cod_emit_forn($cod_emit_forn)
   {
      $cod_emit_forn = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $cod_emit_forn);
      $cod_emit_forn = substr($this->Db->qstr($cod_emit_forn), 1, -1);
            $cod_emit_forn_look = (is_string($cod_emit_forn) ? substr($this->Db->qstr($cod_emit_forn), 1, -1) : $cod_emit_forn); 
      $nmgp_def_dados = array(); 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (COD_EMIT_FORN AS TEXT)  like '%" . $cod_emit_forn . "%'"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (COD_EMIT_FORN AS VARCHAR)  like '%" . $cod_emit_forn . "%'"; 
      }
      else
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  COD_EMIT_FORN like '%" . $cod_emit_forn . "%'"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
   
   function lookup_ajax_fornec_pi($fornec_pi)
   {
      $fornec_pi = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $fornec_pi);
      $fornec_pi = substr($this->Db->qstr($fornec_pi), 1, -1);
            $fornec_pi_look = (is_string($fornec_pi) ? substr($this->Db->qstr($fornec_pi), 1, -1) : $fornec_pi); 
      $nmgp_def_dados = array(); 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (FORNEC_PI AS TEXT)  like '%" . $fornec_pi . "%'"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where   CAST (FORNEC_PI AS VARCHAR)  like '%" . $fornec_pi . "%'"; 
      }
      else
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  FORNEC_PI like '%" . $fornec_pi . "%'"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
   
   function lookup_ajax_cod_proc_fornec_pedido($cod_proc_fornec_pedido)
   {
      $cod_proc_fornec_pedido = substr($this->Db->qstr($cod_proc_fornec_pedido), 1, -1);
            $cod_proc_fornec_pedido_look = (is_string($cod_proc_fornec_pedido) ? substr($this->Db->qstr($cod_proc_fornec_pedido), 1, -1) : $cod_proc_fornec_pedido); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct COD_PROC_FORNEC_PEDIDO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where  #lowerI#COD_PROC_FORNEC_PEDIDO#lowerF# like #lowerI#'%" . $cod_proc_fornec_pedido . "%'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $Nm_numeric[] = "id";$Nm_numeric[] = "id_origem";$Nm_numeric[] = "tipo_movto";$Nm_numeric[] = "valor";$Nm_numeric[] = "container";$Nm_numeric[] = "sit_acomp_container";$Nm_numeric[] = "situacao_container";$Nm_numeric[] = "cod_emit_forn";$Nm_numeric[] = "fornec_pi";$Nm_numeric[] = "";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'data';
      if (in_array($nome, $Nm_datas))
      {
         $nm_ini_lower = "";
         $nm_fim_lower = "";
      }
      if (in_array($campo_join, $Nm_datas))
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['SC_sep_date1'];
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
         $nome_sum = "PUB.cta_corren_custo_distr.$nome";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
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
                       $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
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
                   $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . "</span>##*@@";
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str  = "";
               $nm_cond   = "";
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
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
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
 <TITLE>Conta Corrente  - Distribuição de Custo - Saldo Anterior:<?php echo $_SESSION['sd_anterior'] ?></TITLE>
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
 <TITLE>Conta Corrente  - Distribuição de Custo - Saldo Anterior:<?php echo $_SESSION['sd_anterior'] ?></TITLE>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>cons_cta_corren_custo_distr_bkp/cons_cta_corren_custo_distr_bkp_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = '';
?>
<BODY id="grid_search" class="scFilterPage" style="<?php echo $vertical_center ?>">
<?php echo $this->Ini->Ajax_result_set ?>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="cons_cta_corren_custo_distr_bkp_ajax_search.js"></script>
 <script type="text/javascript" src="cons_cta_corren_custo_distr_bkp_ajax.js"></script>
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
<script type="text/javascript" src="cons_cta_corren_custo_distr_bkp_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['ajax_nav'])
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
<script type="text/javascript" src="cons_cta_corren_custo_distr_bkp_message.js"></script>
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
  str_out += 'SC_historico_cond#NMF#' + search_get_sel_txt('SC_historico_cond') + '@NMF@';
  str_out += 'SC_historico#NMF#' + search_get_text('SC_historico') + '@NMF@';
  str_out += 'id_ac_historico#NMF#' + search_get_text('id_ac_historico') + '@NMF@';
  str_out += 'SC_historico_input_2#NMF#' + search_get_text('SC_historico_input_2') + '@NMF@';
  str_out += 'SC_valor_cond#NMF#' + search_get_sel_txt('SC_valor_cond') + '@NMF@';
  str_out += 'SC_valor#NMF#' + search_get_text('SC_valor') + '@NMF@';
  str_out += 'id_ac_valor#NMF#' + search_get_text('id_ac_valor') + '@NMF@';
  str_out += 'SC_valor_input_2#NMF#' + search_get_text('SC_valor_input_2') + '@NMF@';
  str_out += 'SC_descricao_item_cond#NMF#' + search_get_sel_txt('SC_descricao_item_cond') + '@NMF@';
  str_out += 'SC_descricao_item#NMF#' + search_get_text('SC_descricao_item') + '@NMF@';
  str_out += 'id_ac_descricao_item#NMF#' + search_get_text('id_ac_descricao_item') + '@NMF@';
  str_out += 'SC_codigo_erp_cond#NMF#' + search_get_sel_txt('SC_codigo_erp_cond') + '@NMF@';
  str_out += 'SC_codigo_erp#NMF#' + search_get_text('SC_codigo_erp') + '@NMF@';
  str_out += 'id_ac_codigo_erp#NMF#' + search_get_text('id_ac_codigo_erp') + '@NMF@';
  str_out += 'SC_codigo_erp_input_2#NMF#' + search_get_text('SC_codigo_erp_input_2') + '@NMF@';
  str_out += 'SC_container_cond#NMF#' + search_get_sel_txt('SC_container_cond') + '@NMF@';
  str_out += 'SC_container#NMF#' + search_get_text('SC_container') + '@NMF@';
  str_out += 'id_ac_container#NMF#' + search_get_text('id_ac_container') + '@NMF@';
  str_out += 'SC_container_input_2#NMF#' + search_get_text('SC_container_input_2') + '@NMF@';
  str_out += 'SC_cod_emit_forn_cond#NMF#' + search_get_sel_txt('SC_cod_emit_forn_cond') + '@NMF@';
  str_out += 'SC_cod_emit_forn#NMF#' + search_get_text('SC_cod_emit_forn') + '@NMF@';
  str_out += 'id_ac_cod_emit_forn#NMF#' + search_get_text('id_ac_cod_emit_forn') + '@NMF@';
  str_out += 'SC_cod_emit_forn_input_2#NMF#' + search_get_text('SC_cod_emit_forn_input_2') + '@NMF@';
  str_out += 'SC_fornec_pi_cond#NMF#' + search_get_sel_txt('SC_fornec_pi_cond') + '@NMF@';
  str_out += 'SC_fornec_pi#NMF#' + search_get_text('SC_fornec_pi') + '@NMF@';
  str_out += 'id_ac_fornec_pi#NMF#' + search_get_text('id_ac_fornec_pi') + '@NMF@';
  str_out += 'SC_fornec_pi_input_2#NMF#' + search_get_text('SC_fornec_pi_input_2') + '@NMF@';
  str_out += 'SC_cod_proc_fornec_pedido_cond#NMF#' + search_get_sel_txt('SC_cod_proc_fornec_pedido_cond') + '@NMF@';
  str_out += 'SC_cod_proc_fornec_pedido#NMF#' + search_get_text('SC_cod_proc_fornec_pedido') + '@NMF@';
  str_out += 'id_ac_cod_proc_fornec_pedido#NMF#' + search_get_text('id_ac_cod_proc_fornec_pedido') + '@NMF@';
  str_out += 'SC_cod_proc_fornec_pedido_input_2#NMF#' + search_get_text('SC_cod_proc_fornec_pedido_input_2') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_cond#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_cond') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_dia#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_dia') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_mes#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_mes') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_ano#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_ano') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_input_2_dia#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_input_2_dia') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_input_2_mes#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_input_2_mes') + '@NMF@';
  str_out += 'SC_dt_prev_chegada_input_2_ano#NMF#' + search_get_sel_txt('SC_dt_prev_chegada_input_2_ano') + '@NMF@';
  str_out += 'SC_dt_recebto_cond#NMF#' + search_get_sel_txt('SC_dt_recebto_cond') + '@NMF@';
  str_out += 'SC_dt_recebto_dia#NMF#' + search_get_sel_txt('SC_dt_recebto_dia') + '@NMF@';
  str_out += 'SC_dt_recebto_mes#NMF#' + search_get_sel_txt('SC_dt_recebto_mes') + '@NMF@';
  str_out += 'SC_dt_recebto_ano#NMF#' + search_get_sel_txt('SC_dt_recebto_ano') + '@NMF@';
  str_out += 'SC_dt_recebto_input_2_dia#NMF#' + search_get_sel_txt('SC_dt_recebto_input_2_dia') + '@NMF@';
  str_out += 'SC_dt_recebto_input_2_mes#NMF#' + search_get_sel_txt('SC_dt_recebto_input_2_mes') + '@NMF@';
  str_out += 'SC_dt_recebto_input_2_ano#NMF#' + search_get_sel_txt('SC_dt_recebto_input_2_ano') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_cond#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_cond') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_dia#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_dia') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_mes#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_mes') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_ano#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_ano') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_input_2_dia#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_input_2_dia') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_input_2_mes#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_input_2_mes') + '@NMF@';
  str_out += 'SC_dt_registro_pedido_input_2_ano#NMF#' + search_get_sel_txt('SC_dt_registro_pedido_input_2_ano') + '@NMF@';
  str_out += 'SC_tipo_movto_cond#NMF#' + search_get_sel_txt('SC_tipo_movto_cond') + '@NMF@';
  str_out += 'SC_tipo_movto#NMF#' + search_get_checkbox('SC_tipo_movto') + '@NMF@';
  str_out += 'SC_situacao_container_cond#NMF#' + search_get_sel_txt('SC_situacao_container_cond') + '@NMF@';
  str_out += 'SC_situacao_container#NMF#' + search_get_checkbox('SC_situacao_container') + '@NMF@';
  str_out += 'SC_sit_acomp_container_cond#NMF#' + search_get_sel_txt('SC_sit_acomp_container_cond') + '@NMF@';
  str_out += 'SC_sit_acomp_container#NMF#' + search_get_checkbox('SC_sit_acomp_container') + '@NMF@';
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
   scClass = $("#id_ac_valor").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_valor").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_valor",
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
       $("#SC_valor").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_valor").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_cod_proc_fornec_pedido").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_cod_proc_fornec_pedido").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_cod_proc_fornec_pedido",
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
       $("#SC_cod_proc_fornec_pedido").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_cod_proc_fornec_pedido").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_codigo_erp").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_codigo_erp").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_codigo_erp",
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
       $("#SC_codigo_erp").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_codigo_erp").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_descricao_item").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_descricao_item").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_descricao_item",
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
       $("#SC_descricao_item").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_descricao_item").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_container").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_container").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_container",
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
       $("#SC_container").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_container").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_cod_emit_forn").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_cod_emit_forn").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_cod_emit_forn",
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
       $("#SC_cod_emit_forn").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_cod_emit_forn").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_fornec_pi").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_fornec_pi").autocomplete({
     minLength: 1,
     classes: { 'ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_fornec_pi",
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
       $("#SC_fornec_pi").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_fornec_pi").val( $(this).val() );
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
<TABLE id="main_table" align="center" valign="top" width="100%">
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
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['compact_mode'])
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
#lin1_col1 { padding-left:1px; padding-top:0px;  height:9px; overflow:hidden; text-align:left;color:black;}			 
#lin1_col2 { padding-right:1px; padding-top:0px; height:9px; text-align:left; overflow:hidden;   font-size:12px; font-weight:normal;color:black;}
</style>

<div width="100%" >	
 <div class="scFilterHeader" style="height:11px; display: block; border-width:0px; "></div>
 <!--<div style="height:15px; border-width:0px 0px 1px 0px;  border-style: solid; border-color:#ddd; display: block">-->
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFilterHeaderFont"><span>Conta Corrente  - Distribuição de Custo - Saldo Anterior:<?php echo $_SESSION['sd_anterior'] ?> - 
<?php
      $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
      echo $this->nm_data->FormataSaida("j/n/Y @?#?@à@?#?@s G:i:s");
?>
</span></td>            
        </tr>
    </table>		 
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
             $historico_cond, $historico, $historico_input_2, $historico_autocomp,
             $valor_cond, $valor, $valor_input_2, $valor_autocomp,
             $descricao_item_cond, $descricao_item, $descricao_item_autocomp,
             $codigo_erp_cond, $codigo_erp, $codigo_erp_input_2, $codigo_erp_autocomp,
             $container_cond, $container, $container_input_2, $container_autocomp,
             $cod_emit_forn_cond, $cod_emit_forn, $cod_emit_forn_input_2, $cod_emit_forn_autocomp,
             $fornec_pi_cond, $fornec_pi, $fornec_pi_input_2, $fornec_pi_autocomp,
             $cod_proc_fornec_pedido_cond, $cod_proc_fornec_pedido, $cod_proc_fornec_pedido_input_2, $cod_proc_fornec_pedido_autocomp,
             $dt_prev_chegada_cond, $dt_prev_chegada, $dt_prev_chegada_dia, $dt_prev_chegada_mes, $dt_prev_chegada_ano, $dt_prev_chegada_input_2_dia, $dt_prev_chegada_input_2_mes, $dt_prev_chegada_input_2_ano,
             $dt_recebto_cond, $dt_recebto, $dt_recebto_dia, $dt_recebto_mes, $dt_recebto_ano, $dt_recebto_input_2_dia, $dt_recebto_input_2_mes, $dt_recebto_input_2_ano,
             $dt_registro_pedido_cond, $dt_registro_pedido, $dt_registro_pedido_dia, $dt_registro_pedido_mes, $dt_registro_pedido_ano, $dt_registro_pedido_input_2_dia, $dt_registro_pedido_input_2_mes, $dt_registro_pedido_input_2_ano,
             $tipo_movto_cond, $tipo_movto,
             $situacao_container_cond, $situacao_container,
             $sit_acomp_container_cond, $sit_acomp_container,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['cons_cta_corren_custo_distr_bkp']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
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
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $data_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_dia']; 
          $data_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_mes']; 
          $data_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_ano']; 
          $data_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_dia']; 
          $data_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_mes']; 
          $data_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_ano']; 
          $data_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_cond']; 
          $historico = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico']; 
          $historico_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico_input_2']; 
          $historico_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico_cond']; 
          $valor = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor']; 
          $valor_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor_input_2']; 
          $valor_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor_cond']; 
          $descricao_item = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['descricao_item']; 
          $descricao_item_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['descricao_item_cond']; 
          $codigo_erp = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp']; 
          $codigo_erp_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp_input_2']; 
          $codigo_erp_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp_cond']; 
          $container = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container']; 
          $container_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container_input_2']; 
          $container_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container_cond']; 
          $cod_emit_forn = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn']; 
          $cod_emit_forn_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn_input_2']; 
          $cod_emit_forn_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn_cond']; 
          $fornec_pi = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi']; 
          $fornec_pi_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi_input_2']; 
          $fornec_pi_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi_cond']; 
          $cod_proc_fornec_pedido = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido']; 
          $cod_proc_fornec_pedido_input_2 = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido_input_2']; 
          $cod_proc_fornec_pedido_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido_cond']; 
          $dt_prev_chegada_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_dia']; 
          $dt_prev_chegada_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_mes']; 
          $dt_prev_chegada_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_ano']; 
          $dt_prev_chegada_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_dia']; 
          $dt_prev_chegada_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_mes']; 
          $dt_prev_chegada_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_ano']; 
          $dt_prev_chegada_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_cond']; 
          $dt_recebto_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_dia']; 
          $dt_recebto_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_mes']; 
          $dt_recebto_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_ano']; 
          $dt_recebto_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_dia']; 
          $dt_recebto_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_mes']; 
          $dt_recebto_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_ano']; 
          $dt_recebto_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_cond']; 
          $dt_registro_pedido_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_dia']; 
          $dt_registro_pedido_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_mes']; 
          $dt_registro_pedido_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_ano']; 
          $dt_registro_pedido_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_dia']; 
          $dt_registro_pedido_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_mes']; 
          $dt_registro_pedido_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_ano']; 
          $dt_registro_pedido_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_cond']; 
          $tipo_movto = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['tipo_movto']; 
          $tipo_movto_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['tipo_movto_cond']; 
          $situacao_container = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['situacao_container']; 
          $situacao_container_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['situacao_container_cond']; 
          $sit_acomp_container = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['sit_acomp_container']; 
          $sit_acomp_container_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['sit_acomp_container_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['NM_operador']; 
      } 
      if (!isset($data_cond) || empty($data_cond))
      {
         $data_cond = "bw";
      }
      if (!isset($historico_cond) || empty($historico_cond))
      {
         $historico_cond = "qp";
      }
      if (!isset($valor_cond) || empty($valor_cond))
      {
         $valor_cond = "gt";
      }
      if (!isset($descricao_item_cond) || empty($descricao_item_cond))
      {
         $descricao_item_cond = "qp";
      }
      if (!isset($codigo_erp_cond) || empty($codigo_erp_cond))
      {
         $codigo_erp_cond = "qp";
      }
      if (!isset($container_cond) || empty($container_cond))
      {
         $container_cond = "eq";
      }
      if (!isset($cod_emit_forn_cond) || empty($cod_emit_forn_cond))
      {
         $cod_emit_forn_cond = "eq";
      }
      if (!isset($fornec_pi_cond) || empty($fornec_pi_cond))
      {
         $fornec_pi_cond = "eq";
      }
      if (!isset($cod_proc_fornec_pedido_cond) || empty($cod_proc_fornec_pedido_cond))
      {
         $cod_proc_fornec_pedido_cond = "qp";
      }
      if (!isset($dt_prev_chegada_cond) || empty($dt_prev_chegada_cond))
      {
         $dt_prev_chegada_cond = "bw";
      }
      if (!isset($dt_recebto_cond) || empty($dt_recebto_cond))
      {
         $dt_recebto_cond = "bw";
      }
      if (!isset($dt_registro_pedido_cond) || empty($dt_registro_pedido_cond))
      {
         $dt_registro_pedido_cond = "eq";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_data = (in_array($data_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_historico = (in_array($historico_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_valor = (in_array($valor_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_descricao_item = (in_array($descricao_item_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_codigo_erp = (in_array($codigo_erp_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_container = (in_array($container_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_emit_forn = (in_array($cod_emit_forn_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_fornec_pi = (in_array($fornec_pi_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_proc_fornec_pedido = (in_array($cod_proc_fornec_pedido_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_dt_prev_chegada = (in_array($dt_prev_chegada_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_dt_recebto = (in_array($dt_recebto_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_dt_registro_pedido = (in_array($dt_registro_pedido_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tipo_movto = (in_array($tipo_movto_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_situacao_container = (in_array($situacao_container_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_sit_acomp_container = (in_array($sit_acomp_container_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_data = ('bw' == $data_cond) ? $display_aberto : $display_fechado;
      $str_display_historico = ('bw' == $historico_cond) ? $display_aberto : $display_fechado;
      $str_display_valor = ('bw' == $valor_cond) ? $display_aberto : $display_fechado;
      $str_display_descricao_item = ('bw' == $descricao_item_cond) ? $display_aberto : $display_fechado;
      $str_display_codigo_erp = ('bw' == $codigo_erp_cond) ? $display_aberto : $display_fechado;
      $str_display_container = ('bw' == $container_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_emit_forn = ('bw' == $cod_emit_forn_cond) ? $display_aberto : $display_fechado;
      $str_display_fornec_pi = ('bw' == $fornec_pi_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_proc_fornec_pedido = ('bw' == $cod_proc_fornec_pedido_cond) ? $display_aberto : $display_fechado;
      $str_display_dt_prev_chegada = ('bw' == $dt_prev_chegada_cond) ? $display_aberto : $display_fechado;
      $str_display_dt_recebto = ('bw' == $dt_recebto_cond) ? $display_aberto : $display_fechado;
      $str_display_dt_registro_pedido = ('bw' == $dt_registro_pedido_cond) ? $display_aberto : $display_fechado;
      $str_display_tipo_movto = ('bw' == $tipo_movto_cond) ? $display_aberto : $display_fechado;
      $str_display_situacao_container = ('bw' == $situacao_container_cond) ? $display_aberto : $display_fechado;
      $str_display_sit_acomp_container = ('bw' == $sit_acomp_container_cond) ? $display_aberto : $display_fechado;

      // tipo_movto
      if (is_array($tipo_movto) && !empty($tipo_movto))
      {
         $tmp_array = array();
         $tipo_movto_val_str = "";
         foreach ($tipo_movto as $tmp_val_cmp)
         {
            if ("" != $tipo_movto_val_str)
            {
               $tipo_movto_val_str .= ",";
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
            $tipo_movto_val_str .= "'$tmp_val_cmp'";
         }
         $tipo_movto = $tmp_array;
      }
      else
      {
         $tipo_movto_val_str = "";
      }
      // situacao_container
      if (is_array($situacao_container) && !empty($situacao_container))
      {
         $tmp_array = array();
         $situacao_container_val_str = "";
         foreach ($situacao_container as $tmp_val_cmp)
         {
            if ("" != $situacao_container_val_str)
            {
               $situacao_container_val_str .= ",";
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
            $situacao_container_val_str .= "'$tmp_val_cmp'";
         }
         $situacao_container = $tmp_array;
      }
      else
      {
         $situacao_container_val_str = "";
      }
      // sit_acomp_container
      if (is_array($sit_acomp_container) && !empty($sit_acomp_container))
      {
         $tmp_array = array();
         $sit_acomp_container_val_str = "";
         foreach ($sit_acomp_container as $tmp_val_cmp)
         {
            if ("" != $sit_acomp_container_val_str)
            {
               $sit_acomp_container_val_str .= ",";
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
            $sit_acomp_container_val_str .= "'$tmp_val_cmp'";
         }
         $sit_acomp_container = $tmp_array;
      }
      else
      {
         $sit_acomp_container_val_str = "";
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
      if (!isset($valor) || $valor == "")
      {
          $valor = "";
      }
      if (isset($valor) && !empty($valor))
      {
         $tmp_pos = (is_string($valor)) ? strpos($valor, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $valor = substr($valor, 0, $tmp_pos);
         }
      }
      if (!isset($descricao_item) || $descricao_item == "")
      {
          $descricao_item = "";
      }
      if (isset($descricao_item) && !empty($descricao_item))
      {
         $tmp_pos = (is_string($descricao_item)) ? strpos($descricao_item, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $descricao_item = substr($descricao_item, 0, $tmp_pos);
         }
      }
      if (!isset($codigo_erp) || $codigo_erp == "")
      {
          $codigo_erp = "";
      }
      if (isset($codigo_erp) && !empty($codigo_erp))
      {
         $tmp_pos = (is_string($codigo_erp)) ? strpos($codigo_erp, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $codigo_erp = substr($codigo_erp, 0, $tmp_pos);
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
      if (!isset($cod_emit_forn) || $cod_emit_forn == "")
      {
          $cod_emit_forn = "";
      }
      if (isset($cod_emit_forn) && !empty($cod_emit_forn))
      {
         $tmp_pos = (is_string($cod_emit_forn)) ? strpos($cod_emit_forn, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_emit_forn = substr($cod_emit_forn, 0, $tmp_pos);
         }
      }
      if (!isset($fornec_pi) || $fornec_pi == "")
      {
          $fornec_pi = "";
      }
      if (isset($fornec_pi) && !empty($fornec_pi))
      {
         $tmp_pos = (is_string($fornec_pi)) ? strpos($fornec_pi, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $fornec_pi = substr($fornec_pi, 0, $tmp_pos);
         }
      }
      if (!isset($cod_proc_fornec_pedido) || $cod_proc_fornec_pedido == "")
      {
          $cod_proc_fornec_pedido = "";
      }
      if (isset($cod_proc_fornec_pedido) && !empty($cod_proc_fornec_pedido))
      {
         $tmp_pos = (is_string($cod_proc_fornec_pedido)) ? strpos($cod_proc_fornec_pedido, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_proc_fornec_pedido = substr($cod_proc_fornec_pedido, 0, $tmp_pos);
         }
      }
      if (!isset($dt_prev_chegada) || $dt_prev_chegada == "")
      {
          $dt_prev_chegada = "";
      }
      if (isset($dt_prev_chegada) && !empty($dt_prev_chegada))
      {
         $tmp_pos = (is_string($dt_prev_chegada)) ? strpos($dt_prev_chegada, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $dt_prev_chegada = substr($dt_prev_chegada, 0, $tmp_pos);
         }
      }
      if (!isset($dt_recebto) || $dt_recebto == "")
      {
          $dt_recebto = "";
      }
      if (isset($dt_recebto) && !empty($dt_recebto))
      {
         $tmp_pos = (is_string($dt_recebto)) ? strpos($dt_recebto, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $dt_recebto = substr($dt_recebto, 0, $tmp_pos);
         }
      }
      if (!isset($dt_registro_pedido) || $dt_registro_pedido == "")
      {
          $dt_registro_pedido = "";
      }
      if (isset($dt_registro_pedido) && !empty($dt_registro_pedido))
      {
         $tmp_pos = (is_string($dt_registro_pedido)) ? strpos($dt_registro_pedido, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $dt_registro_pedido = substr($dt_registro_pedido, 0, $tmp_pos);
         }
      }
      if (!isset($tipo_movto) || $tipo_movto == "")
      {
          $tipo_movto = array();
      }
      if (!isset($situacao_container) || $situacao_container == "")
      {
          $situacao_container = array();
      }
      if (!isset($sit_acomp_container) || $sit_acomp_container == "")
      {
          $sit_acomp_container = array();
      }
?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="70%" height="">
   <DIV class="scBlockFrame">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
<?php
     $Img_tit_blk_i = "";
     $Img_tit_blk_f = "";
?>

    <TR>
     <TD colspan="3" height="20" class="scFilterBlockBack">
      <TABLE border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
       <TR>
        <TD class="scFilterBlockFont css_blk_0"><?php echo $Img_tit_blk_i ?>Principal<?php echo $Img_tit_blk_f ?></TD>
         
       </TR>
      </TABLE>
     </TD>
    </TR>
   <tr valign="top">





      <TD id='SC_data_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_data_cond" name="data_cond" onChange="nm_campos_between(document.getElementById('id_vis_data'), this, 'data')">
       <OPTION value="bw" <?php if ("bw" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="ge" <?php if ("ge" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr_equl'] ?></OPTION>
       <OPTION value="le" <?php if ("le" == $data_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less_equl'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data" <?php echo $str_hide_data?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['data'])) ? $this->New_label['data'] : "Data";
 $nmgp_tab_label .= "data?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
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
        <SPAN id="id_vis_data"  <?php echo $str_display_data; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         
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
        </SPAN>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_historico_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_historico_cond" name="historico_cond" onChange="nm_campos_between(document.getElementById('id_vis_historico'), this, 'historico')">
       <OPTION value="qp" <?php if ("qp" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $historico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_historico" <?php echo $str_hide_historico?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['historico'])) ? $this->New_label['historico'] : "Histórico";
 $nmgp_tab_label .= "historico?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
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
      $nm_comando = "select distinct HISTORICO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#HISTORICO#lowerF# = #lowerI#'$historico_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_historico" name="historico_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 4000, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">
        <SPAN id="id_vis_historico"  <?php echo $str_display_historico; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_historico_input_2" name="historico_input_2" value="<?php echo NM_encode_input($historico_input_2) ?>"    size="50" class="sc-js-input sc-js-input scFilterObjectEven">         </SPAN>
         

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_valor_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['valor'])) ? $this->New_label['valor'] : "Valor"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_valor_cond" name="valor_cond" onChange="nm_campos_between(document.getElementById('id_vis_valor'), this, 'valor')">
       <OPTION value="gt" <?php if ("gt" == $valor_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $valor_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $valor_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $valor_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_valor" <?php echo $str_hide_valor?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['valor'])) ? $this->New_label['valor'] : "Valor";
 $nmgp_tab_label .= "valor?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($valor != "")
      {
      $valor_look = (is_string($valor) ? substr($this->Db->qstr($valor), 1, -1) : $valor); 
      $nmgp_def_dados = array(); 
   if (is_numeric($valor))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      else
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
              nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
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
      }
      if (isset($nmgp_def_dados[0][$valor]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$valor];
      }
      else
      {
              nmgp_Form_Num_Val($valor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $valor;
      }
?>
<INPUT  type="text" id="SC_valor" name="valor" value="<?php echo NM_encode_input($valor) ?>" size=17 alt="{datatype: 'text', maxLength: 17, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_valor" name="valor_autocomp" size="17"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 17, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">
        </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_valor"  <?php echo $str_display_valor; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         <BR>
         <INPUT type="text" id="SC_valor_input_2" name="valor_input_2" value="<?php echo NM_encode_input($valor_input_2) ?>"  size=17 alt="{datatype: 'text', maxLength: 17, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" class="sc-js-input sc-js-input sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_descricao_item_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['descricao_item'])) ? $this->New_label['descricao_item'] : "Descrição Item"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_descricao_item_cond" name="descricao_item_cond" onChange="nm_campos_between(document.getElementById('id_vis_descricao_item'), this, 'descricao_item')">
       <OPTION value="qp" <?php if ("qp" == $descricao_item_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $descricao_item_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $descricao_item_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $descricao_item_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $descricao_item_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_descricao_item" <?php echo $str_hide_descricao_item?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['descricao_item'])) ? $this->New_label['descricao_item'] : "Descrição Item";
 $nmgp_tab_label .= "descricao_item?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($descricao_item != "")
      {
      $descricao_item_look = (is_string($descricao_item) ? substr($this->Db->qstr($descricao_item), 1, -1) : $descricao_item); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct DESCRICAO_ITEM from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#DESCRICAO_ITEM#lowerF# = #lowerI#'$descricao_item_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
      if (isset($nmgp_def_dados[0][$descricao_item]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$descricao_item];
      }
      else
      {
          $sAutocompValue = $descricao_item;
      }
?>
<INPUT  type="text" id="SC_descricao_item" name="descricao_item" value="<?php echo NM_encode_input($descricao_item) ?>"  size=50 alt="{datatype: 'text', maxLength: 300, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_descricao_item" name="descricao_item_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 300, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_codigo_erp_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['codigo_erp'])) ? $this->New_label['codigo_erp'] : "Código ERP"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_codigo_erp_cond" name="codigo_erp_cond" onChange="nm_campos_between(document.getElementById('id_vis_codigo_erp'), this, 'codigo_erp')">
       <OPTION value="qp" <?php if ("qp" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $codigo_erp_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_codigo_erp" <?php echo $str_hide_codigo_erp?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['codigo_erp'])) ? $this->New_label['codigo_erp'] : "Código ERP";
 $nmgp_tab_label .= "codigo_erp?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($codigo_erp != "")
      {
      $codigo_erp_look = (is_string($codigo_erp) ? substr($this->Db->qstr($codigo_erp), 1, -1) : $codigo_erp); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CODIGO_ERP from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#CODIGO_ERP#lowerF# = #lowerI#'$codigo_erp_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
      if (isset($nmgp_def_dados[0][$codigo_erp]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$codigo_erp];
      }
      else
      {
          $sAutocompValue = $codigo_erp;
      }
?>
<INPUT  type="text" id="SC_codigo_erp" name="codigo_erp" value="<?php echo NM_encode_input($codigo_erp) ?>"  size=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_codigo_erp" name="codigo_erp_autocomp" size="40"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 40, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">
        <SPAN id="id_vis_codigo_erp"  <?php echo $str_display_codigo_erp; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_codigo_erp_input_2" name="codigo_erp_input_2" value="<?php echo NM_encode_input($codigo_erp_input_2) ?>"    size="40" class="sc-js-input sc-js-input scFilterObjectOdd">         </SPAN>
         

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_container_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_container_cond" name="container_cond" onChange="nm_campos_between(document.getElementById('id_vis_container'), this, 'container')">
       <OPTION value="eq" <?php if ("eq" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $container_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_container" <?php echo $str_hide_container?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['container'])) ? $this->New_label['container'] : "Container";
 $nmgp_tab_label .= "container?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($container != "")
      {
      $container_look = (is_string($container) ? substr($this->Db->qstr($container), 1, -1) : $container); 
      $nmgp_def_dados = array(); 
   if (is_numeric($container))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      else
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
      }
      if (isset($nmgp_def_dados[0][$container]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$container];
      }
      else
      {
            nmgp_Form_Num_Val($container, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $container;
      }
?>
<INPUT  type="text" id="SC_container" name="container" value="<?php echo NM_encode_input($container) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_container" name="container_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">
        <SPAN id="id_vis_container"  <?php echo $str_display_container; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_container_input_2" name="container_input_2" value="<?php echo NM_encode_input($container_input_2) ?>"  size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input sc-js-input sc-js-input scFilterObjectEven">         </SPAN>
         

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_cod_emit_forn_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['cod_emit_forn'])) ? $this->New_label['cod_emit_forn'] : "Fornecedor Container"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cod_emit_forn_cond" name="cod_emit_forn_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_emit_forn'), this, 'cod_emit_forn')">
       <OPTION value="eq" <?php if ("eq" == $cod_emit_forn_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $cod_emit_forn_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cod_emit_forn" <?php echo $str_hide_cod_emit_forn?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cod_emit_forn'])) ? $this->New_label['cod_emit_forn'] : "Fornecedor Container";
 $nmgp_tab_label .= "cod_emit_forn?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($cod_emit_forn != "")
      {
      $cod_emit_forn_look = (is_string($cod_emit_forn) ? substr($this->Db->qstr($cod_emit_forn), 1, -1) : $cod_emit_forn); 
      $nmgp_def_dados = array(); 
   if (is_numeric($cod_emit_forn))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      else
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
      }
      if (isset($nmgp_def_dados[0][$cod_emit_forn]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$cod_emit_forn];
      }
      else
      {
            nmgp_Form_Num_Val($cod_emit_forn, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $cod_emit_forn;
      }
?>
<INPUT  type="text" id="SC_cod_emit_forn" name="cod_emit_forn" value="<?php echo NM_encode_input($cod_emit_forn) ?>" size=12 alt="{datatype: 'integer', maxLength: 12, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_cod_emit_forn" name="cod_emit_forn_autocomp" size="12"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 12, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">

<?php
  if (isset($this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"]) && $this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,cod_emit_forn_autocomp,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,cod_emit_forn_autocomp,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>
        <SPAN id="id_vis_cod_emit_forn"  <?php echo $str_display_cod_emit_forn; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_cod_emit_forn_input_2" name="cod_emit_forn_input_2" value="<?php echo NM_encode_input($cod_emit_forn_input_2) ?>"  size=12 alt="{datatype: 'integer', maxLength: 12, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input sc-js-input sc-js-input scFilterObjectOdd">         </SPAN>
         

<?php
  if (isset($this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"]) && $this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,cod_emit_forn_input_2,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,cod_emit_forn_input_2,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_fornec_pi_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['fornec_pi'])) ? $this->New_label['fornec_pi'] : "Fornecedor PI"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_fornec_pi_cond" name="fornec_pi_cond" onChange="nm_campos_between(document.getElementById('id_vis_fornec_pi'), this, 'fornec_pi')">
       <OPTION value="eq" <?php if ("eq" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
       <OPTION value="ge" <?php if ("ge" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr_equl'] ?></OPTION>
       <OPTION value="le" <?php if ("le" == $fornec_pi_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less_equl'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_fornec_pi" <?php echo $str_hide_fornec_pi?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['fornec_pi'])) ? $this->New_label['fornec_pi'] : "Fornecedor PI";
 $nmgp_tab_label .= "fornec_pi?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($fornec_pi != "")
      {
      $fornec_pi_look = (is_string($fornec_pi) ? substr($this->Db->qstr($fornec_pi), 1, -1) : $fornec_pi); 
      $nmgp_def_dados = array(); 
   if (is_numeric($fornec_pi))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      else
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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
      }
      if (isset($nmgp_def_dados[0][$fornec_pi]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$fornec_pi];
      }
      else
      {
            nmgp_Form_Num_Val($fornec_pi, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $fornec_pi;
      }
?>
<INPUT  type="text" id="SC_fornec_pi" name="fornec_pi" value="<?php echo NM_encode_input($fornec_pi) ?>" size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_fornec_pi" name="fornec_pi_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">

<?php
  if (isset($this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"]) && $this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,fornec_pi_autocomp,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,fornec_pi_autocomp,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>
        <SPAN id="id_vis_fornec_pi"  <?php echo $str_display_fornec_pi; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_fornec_pi_input_2" name="fornec_pi_input_2" value="<?php echo NM_encode_input($fornec_pi_input_2) ?>"  size=10 alt="{datatype: 'integer', maxLength: 10, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input sc-js-input sc-js-input scFilterObjectEven">         </SPAN>
         

<?php
  if (isset($this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"]) && $this->Ini->sc_lig_md5["cons_fornecedor_estrangeiro"] == "S") {
      $Parms_Lig  = "nmgp_parms_ret*scinF1,fornec_pi_input_2,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@cons_cta_corren_custo_distr_bkp@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = "nmgp_parms_ret*scinF1,fornec_pi_input_2,cod-emitente*scoutnmgp_perm_edit*scinS*scout";
  }
  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_estrangeiro_cons_psq . "', '" . $Md5_Lig . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");

?>
&nbsp;<?php echo $Cod_Btn ?>

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_cod_proc_fornec_pedido_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['cod_proc_fornec_pedido'])) ? $this->New_label['cod_proc_fornec_pedido'] : "Código Item Pedido Importação"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cod_proc_fornec_pedido_cond" name="cod_proc_fornec_pedido_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_proc_fornec_pedido'), this, 'cod_proc_fornec_pedido')">
       <OPTION value="qp" <?php if ("qp" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $cod_proc_fornec_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cod_proc_fornec_pedido" <?php echo $str_hide_cod_proc_fornec_pedido?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cod_proc_fornec_pedido'])) ? $this->New_label['cod_proc_fornec_pedido'] : "Código Item Pedido Importação";
 $nmgp_tab_label .= "cod_proc_fornec_pedido?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($cod_proc_fornec_pedido != "")
      {
      $cod_proc_fornec_pedido_look = (is_string($cod_proc_fornec_pedido) ? substr($this->Db->qstr($cod_proc_fornec_pedido), 1, -1) : $cod_proc_fornec_pedido); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct COD_PROC_FORNEC_PEDIDO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#COD_PROC_FORNEC_PEDIDO#lowerF# = #lowerI#'$cod_proc_fornec_pedido_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
      if (isset($nmgp_def_dados[0][$cod_proc_fornec_pedido]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$cod_proc_fornec_pedido];
      }
      else
      {
          $sAutocompValue = $cod_proc_fornec_pedido;
      }
?>
<INPUT  type="text" id="SC_cod_proc_fornec_pedido" name="cod_proc_fornec_pedido" value="<?php echo NM_encode_input($cod_proc_fornec_pedido) ?>"  size=50 alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_cod_proc_fornec_pedido" name="cod_proc_fornec_pedido_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">
        <SPAN id="id_vis_cod_proc_fornec_pedido"  <?php echo $str_display_cod_proc_fornec_pedido; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         <INPUT type="text" id="SC_cod_proc_fornec_pedido_input_2" name="cod_proc_fornec_pedido_input_2" value="<?php echo NM_encode_input($cod_proc_fornec_pedido_input_2) ?>"    size="50" class="sc-js-input sc-js-input scFilterObjectOdd">         </SPAN>
         

        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_dt_prev_chegada_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt.Prev.Chegada"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_dt_prev_chegada_cond" name="dt_prev_chegada_cond" onChange="nm_campos_between(document.getElementById('id_vis_dt_prev_chegada'), this, 'dt_prev_chegada')">
       <OPTION value="bw" <?php if ("bw" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ge" <?php if ("ge" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr_equl'] ?></OPTION>
       <OPTION value="le" <?php if ("le" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less_equl'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ne" <?php if ("ne" == $dt_prev_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_nempty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_dt_prev_chegada" <?php echo $str_hide_dt_prev_chegada?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['dt_prev_chegada'])) ? $this->New_label['dt_prev_chegada'] : "Dt.Prev.Chegada";
 $nmgp_tab_label .= "dt_prev_chegada?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
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
<span id='id_date_part_dt_prev_chegada_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_dia" name="dt_prev_chegada_dia" value="<?php echo NM_encode_input($dt_prev_chegada_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_prev_chegada_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_mes" name="dt_prev_chegada_mes" value="<?php echo NM_encode_input($dt_prev_chegada_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_prev_chegada_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_ano" name="dt_prev_chegada_ano" value="<?php echo NM_encode_input($dt_prev_chegada_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        <SPAN id="id_vis_dt_prev_chegada"  <?php echo $str_display_dt_prev_chegada; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>&nbsp;
         
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
<span id='id_date_part_dt_prev_chegada_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_input_2_dia" name="dt_prev_chegada_input_2_dia" value="<?php echo NM_encode_input($dt_prev_chegada_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_prev_chegada_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_input_2_mes" name="dt_prev_chegada_input_2_mes" value="<?php echo NM_encode_input($dt_prev_chegada_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_prev_chegada_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_prev_chegada_input_2_ano" name="dt_prev_chegada_input_2_ano" value="<?php echo NM_encode_input($dt_prev_chegada_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        </SPAN>
        <SPAN id="id_css_dt_prev_chegada" class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_dt_recebto_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['dt_recebto'])) ? $this->New_label['dt_recebto'] : "Dt.Recbto"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_dt_recebto_cond" name="dt_recebto_cond" onChange="nm_campos_between(document.getElementById('id_vis_dt_recebto'), this, 'dt_recebto')">
       <OPTION value="bw" <?php if ("bw" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ge" <?php if ("ge" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr_equl'] ?></OPTION>
       <OPTION value="le" <?php if ("le" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less_equl'] ?></OPTION>
       <OPTION value="ne" <?php if ("ne" == $dt_recebto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_nempty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_dt_recebto" <?php echo $str_hide_dt_recebto?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['dt_recebto'])) ? $this->New_label['dt_recebto'] : "Dt.Recbto";
 $nmgp_tab_label .= "dt_recebto?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
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
<span id='id_date_part_dt_recebto_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_dia" name="dt_recebto_dia" value="<?php echo NM_encode_input($dt_recebto_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_recebto_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_mes" name="dt_recebto_mes" value="<?php echo NM_encode_input($dt_recebto_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_recebto_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_ano" name="dt_recebto_ano" value="<?php echo NM_encode_input($dt_recebto_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        <SPAN id="id_vis_dt_recebto"  <?php echo $str_display_dt_recebto; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>&nbsp;
         
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
<span id='id_date_part_dt_recebto_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_input_2_dia" name="dt_recebto_input_2_dia" value="<?php echo NM_encode_input($dt_recebto_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_recebto_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_input_2_mes" name="dt_recebto_input_2_mes" value="<?php echo NM_encode_input($dt_recebto_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_recebto_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_recebto_input_2_ano" name="dt_recebto_input_2_ano" value="<?php echo NM_encode_input($dt_recebto_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        </SPAN>
        <SPAN id="id_css_dt_recebto" class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>


   </tr><tr valign="top">





      <TD id='SC_dt_registro_pedido_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['dt_registro_pedido'])) ? $this->New_label['dt_registro_pedido'] : "Dt.Registro Ped. Importação"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_dt_registro_pedido_cond" name="dt_registro_pedido_cond" onChange="nm_campos_between(document.getElementById('id_vis_dt_registro_pedido'), this, 'dt_registro_pedido')">
       <OPTION value="eq" <?php if ("eq" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ge" <?php if ("ge" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr_equl'] ?></OPTION>
       <OPTION value="le" <?php if ("le" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less_equl'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
       <OPTION value="ne" <?php if ("ne" == $dt_registro_pedido_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_nempty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_dt_registro_pedido" <?php echo $str_hide_dt_registro_pedido?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['dt_registro_pedido'])) ? $this->New_label['dt_registro_pedido'] : "Dt.Registro Ped. Importação";
 $nmgp_tab_label .= "dt_registro_pedido?#?" . $SC_Label . "?@?";
 $date_sep_bw = " Até ";
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
<span id='id_date_part_dt_registro_pedido_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_dia" name="dt_registro_pedido_dia" value="<?php echo NM_encode_input($dt_registro_pedido_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_registro_pedido_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_mes" name="dt_registro_pedido_mes" value="<?php echo NM_encode_input($dt_registro_pedido_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_registro_pedido_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_ano" name="dt_registro_pedido_ano" value="<?php echo NM_encode_input($dt_registro_pedido_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        <SPAN id="id_vis_dt_registro_pedido"  <?php echo $str_display_dt_registro_pedido; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>&nbsp;
         
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
<span id='id_date_part_dt_registro_pedido_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_input_2_dia" name="dt_registro_pedido_input_2_dia" value="<?php echo NM_encode_input($dt_registro_pedido_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_registro_pedido_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_input_2_mes" name="dt_registro_pedido_input_2_mes" value="<?php echo NM_encode_input($dt_registro_pedido_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
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
<span id='id_date_part_dt_registro_pedido_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_registro_pedido_input_2_ano" name="dt_registro_pedido_input_2_ano" value="<?php echo NM_encode_input($dt_registro_pedido_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
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
        </SPAN>
        <SPAN id="id_css_dt_registro_pedido" class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
         
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
     <TD colspan="1" height="20" class="scFilterBlockBack">
      <TABLE border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
       <TR>
        <TD class="scFilterBlockFont css_blk_1"><?php echo $Img_tit_blk_i ?>Filtros Múltiplas Seleção<?php echo $Img_tit_blk_f ?></TD>
         
       </TR>
      </TABLE>
     </TD>
    </TR>
   <tr valign="top">



   
      <INPUT type="hidden" id="SC_tipo_movto_cond" name="tipo_movto_cond" value="eq">

    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tipo_movto'])) ? $this->New_label['tipo_movto'] : "Tipo Movto";
 $nmgp_tab_label .= "tipo_movto?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><?php echo $SC_Label ?></span><br><span id="id_hide_tipo_movto"  <?php echo $str_hide_tipo_movto?>> 
<?php
  if (!isset($tipo_movto)) {$tipo_movto = explode(";", $tipo_movto);}
 ?>
 
<?php
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['tipo_movto'] = array();
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['tipo_movto'][] = "2";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['tipo_movto'][] = "3";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['tipo_movto'][] = "4";
 ?>

<TABLE style="padding: 0px; spacing: 0px; border-width: 0px; border-spacing: 0px;"><TR>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_tipo_movto" name="tipo_movto[]" value="2##@@Ajuste Manual"  <?php if (in_array("2", $tipo_movto))  { echo " checked" ;} ?>>Ajuste Manual</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_tipo_movto" name="tipo_movto[]" value="3##@@Saldo Versão do Custo"  <?php if (in_array("3", $tipo_movto))  { echo " checked" ;} ?>>Saldo Versão do Custo</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontOdd"><INPUT class="scFilterObjectOdd" type="checkbox" id="SC_tipo_movto" name="tipo_movto[]" value="4##@@Distribuição de Custo"  <?php if (in_array("4", $tipo_movto))  { echo " checked" ;} ?>>Distribuição de Custo</TD>
</TR></TABLE>
 </TD>
   




   </tr><tr valign="top">



   
      <INPUT type="hidden" id="SC_situacao_container_cond" name="situacao_container_cond" value="eq">

    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['situacao_container'])) ? $this->New_label['situacao_container'] : "Situação Container";
 $nmgp_tab_label .= "situacao_container?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><?php echo $SC_Label ?></span><br><span id="id_hide_situacao_container"  <?php echo $str_hide_situacao_container?>> 
<?php
  if (!isset($situacao_container)) {$situacao_container = explode(";", $situacao_container);}
 ?>
 
<?php
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['situacao_container'] = array();
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['situacao_container'][] = "1";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['situacao_container'][] = "2";
  $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['situacao_container'][] = "3";
 ?>

<TABLE style="padding: 0px; spacing: 0px; border-width: 0px; border-spacing: 0px;"><TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_situacao_container" name="situacao_container[]" value="1##@@Aberto"  <?php if (in_array("1", $situacao_container))  { echo " checked" ;} ?>>Aberto</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_situacao_container" name="situacao_container[]" value="2##@@Suspenso"  <?php if (in_array("2", $situacao_container))  { echo " checked" ;} ?>>Suspenso</TD>
</TR>
<TR>
  <TD class="scFilterFieldFontEven"><INPUT class="scFilterObjectEven" type="checkbox" id="SC_situacao_container" name="situacao_container[]" value="3##@@Fechado"  <?php if (in_array("3", $situacao_container))  { echo " checked" ;} ?>>Fechado</TD>
</TR></TABLE>
 </TD>
   




   </tr><tr valign="top">



   
      <INPUT type="hidden" id="SC_sit_acomp_container_cond" name="sit_acomp_container_cond" value="eq">

    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['sit_acomp_container'])) ? $this->New_label['sit_acomp_container'] : "Sit.Acomp. Container";
 $nmgp_tab_label .= "sit_acomp_container?#?" . $SC_Label . "?@?";
 $date_sep_bw = " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><?php echo $SC_Label ?></span><br><span id="id_hide_sit_acomp_container"  <?php echo $str_hide_sit_acomp_container?>>
<?php
      $sit_acomp_container_look = (is_string($sit_acomp_container) ? substr($this->Db->qstr($sit_acomp_container), 1, -1) : $sit_acomp_container); 
      $nmgp_def_dados = "" ; 
      $nm_comando = "SELECT situacao_container_id, descricao  FROM PUB.situacoes_container  ORDER BY num_ordem"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['sit_acomp_container'] = array();
         while (!$rs->EOF) 
         { 
            $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['sit_acomp_container'][] = trim($rs->fields[0]);
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
      echo "<span id=\"idAjaxCheckbox_sit_acomp_container\">\r\n";
      echo "        <TABLE border=\"0px\" cellpadding=\"0px\">\r\n";
      echo "         <TR>\r\n";
      if (!isset($sit_acomp_container) || !is_array($sit_acomp_container))
      {
         $sit_acomp_container = array();
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
            foreach ($sit_acomp_container as $Dados)
            {
                if ($Dados === $nm_opc_cod)
                {
                    $tmp_cmp_sel = "checked";
                    break;
                }
            }
            echo "          <TD class=\"scFilterFieldFontOdd\">\r\n";
            echo "           <INPUT class=\"scFilterObjectOdd\" type=\"checkbox\" id=\"SC_sit_acomp_container\" name=\"sit_acomp_container[]\" value=\"" . NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val) . "\" $tmp_cmp_sel $tmp_cmp_click>$nm_opc_val\r\n";
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
   if (is_file("cons_cta_corren_custo_distr_bkp_help.txt"))
   {
      $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
   if ($nm_apl_dependente == 1 || (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && !$this->aba_iframe))
   {
       if ($nm_apl_dependente == 1) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'])
       { }
       elseif (!$this->Ini->Embutida_iframe) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal'])
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove();", "self.parent.tb_remove();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
       else
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
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
   if (is_file("cons_cta_corren_custo_distr_bkp_help.txt"))
   {
      $Arq_WebHelp = file("cons_cta_corren_custo_distr_bkp_help.txt"); 
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
   if ($nm_apl_dependente == 1 || (!$_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'] && !$this->aba_iframe))
   {
       if ($nm_apl_dependente == 1) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dashboard_info']['under_dashboard'])
       { }
       elseif (!$this->Ini->Embutida_iframe) 
       { 
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       } 
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opc_psq'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['sc_modal'])
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove();", "self.parent.tb_remove();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
       else
       {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
       }
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
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['orig_pesq'] == "grid")
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
   <input type="hidden" name="SC_lig_apl_orig" value="cons_cta_corren_custo_distr_bkp"/>
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
    document.F1.fornec_pi.value = document.F1.fornec_pi_autocomp.value;
    document.F1.cod_emit_forn.value = document.F1.cod_emit_forn_autocomp.value;
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
   document.F1.data_cond.value = 'bw';
   nm_campos_between(document.getElementById('id_vis_data'), document.F1.data_cond, 'data');
   document.F1.data_dia.value = "";
   document.F1.data_mes.value = "";
   document.F1.data_ano.value = "";
   document.F1.data_input_2_dia.value = "";
   document.F1.data_input_2_mes.value = "";
   document.F1.data_input_2_ano.value = "";
   document.F1.historico_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_historico'), document.F1.historico_cond, 'historico');
   document.F1.historico.value = "";
   document.F1.historico_autocomp.value = "";
   document.F1.historico_input_2.value = "";
   document.F1.valor_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_valor'), document.F1.valor_cond, 'valor');
   document.F1.valor.value = "";
   document.F1.valor_autocomp.value = "";
   document.F1.valor_input_2.value = "";
   document.F1.descricao_item_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_descricao_item'), document.F1.descricao_item_cond, 'descricao_item');
   document.F1.descricao_item.value = "";
   document.F1.descricao_item_autocomp.value = "";
   document.F1.codigo_erp_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_codigo_erp'), document.F1.codigo_erp_cond, 'codigo_erp');
   document.F1.codigo_erp.value = "";
   document.F1.codigo_erp_autocomp.value = "";
   document.F1.codigo_erp_input_2.value = "";
   document.F1.container_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_container'), document.F1.container_cond, 'container');
   document.F1.container.value = "";
   document.F1.container_autocomp.value = "";
   document.F1.container_input_2.value = "";
   document.F1.cod_emit_forn_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_cod_emit_forn'), document.F1.cod_emit_forn_cond, 'cod_emit_forn');
   document.F1.cod_emit_forn.value = "";
   document.F1.cod_emit_forn_autocomp.value = "";
   document.F1.cod_emit_forn_input_2.value = "";
   document.F1.fornec_pi_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_fornec_pi'), document.F1.fornec_pi_cond, 'fornec_pi');
   document.F1.fornec_pi.value = "";
   document.F1.fornec_pi_autocomp.value = "";
   document.F1.fornec_pi_input_2.value = "";
   document.F1.cod_proc_fornec_pedido_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_cod_proc_fornec_pedido'), document.F1.cod_proc_fornec_pedido_cond, 'cod_proc_fornec_pedido');
   document.F1.cod_proc_fornec_pedido.value = "";
   document.F1.cod_proc_fornec_pedido_autocomp.value = "";
   document.F1.cod_proc_fornec_pedido_input_2.value = "";
   document.F1.dt_prev_chegada_cond.value = 'bw';
   nm_campos_between(document.getElementById('id_vis_dt_prev_chegada'), document.F1.dt_prev_chegada_cond, 'dt_prev_chegada');
   document.F1.dt_prev_chegada_dia.value = "";
   document.F1.dt_prev_chegada_mes.value = "";
   document.F1.dt_prev_chegada_ano.value = "";
   document.F1.dt_prev_chegada_input_2_dia.value = "";
   document.F1.dt_prev_chegada_input_2_mes.value = "";
   document.F1.dt_prev_chegada_input_2_ano.value = "";
   document.F1.dt_recebto_cond.value = 'bw';
   nm_campos_between(document.getElementById('id_vis_dt_recebto'), document.F1.dt_recebto_cond, 'dt_recebto');
   document.F1.dt_recebto_dia.value = "";
   document.F1.dt_recebto_mes.value = "";
   document.F1.dt_recebto_ano.value = "";
   document.F1.dt_recebto_input_2_dia.value = "";
   document.F1.dt_recebto_input_2_mes.value = "";
   document.F1.dt_recebto_input_2_ano.value = "";
   document.F1.dt_registro_pedido_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_dt_registro_pedido'), document.F1.dt_registro_pedido_cond, 'dt_registro_pedido');
   document.F1.dt_registro_pedido_dia.value = "";
   document.F1.dt_registro_pedido_mes.value = "";
   document.F1.dt_registro_pedido_ano.value = "";
   document.F1.dt_registro_pedido_input_2_dia.value = "";
   document.F1.dt_registro_pedido_input_2_mes.value = "";
   document.F1.dt_registro_pedido_input_2_ano.value = "";
   nm_campos_between(document.getElementById('id_vis_tipo_movto'), document.F1.tipo_movto_cond, 'tipo_movto');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'tipo_movto[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
   nm_campos_between(document.getElementById('id_vis_situacao_container'), document.F1.situacao_container_cond, 'situacao_container');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'situacao_container[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
   nm_campos_between(document.getElementById('id_vis_sit_acomp_container'), document.F1.sit_acomp_container_cond, 'sit_acomp_container');
   for (i = 0; i < document.F1.elements.length; i++)
   {
      if (document.F1.elements[i].name == 'sit_acomp_container[]' && document.F1.elements[i].checked)
      {
          document.F1.elements[i].checked = false;
      }
   }
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_data_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_data_input_2_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_data_input_2_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_data_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_prev_chegada_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_prev_chegada_input_2_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_prev_chegada_input_2_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_prev_chegada_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_recebto_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_recebto_input_2_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_recebto_input_2_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_recebto_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_registro_pedido_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_registro_pedido_input_2_dia').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_dia(this)});
    $('#SC_dt_registro_pedido_input_2_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
    $('#SC_dt_registro_pedido_mes').bind('change', function() {sc_cons_cta_corren_custo_distr_bkp_valida_mes(this)});
 }
 function sc_cons_cta_corren_custo_distr_bkp_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_cons_cta_corren_custo_distr_bkp_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "Importacao/cons_cta_corren_custo_distr_bkp";
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] = "";
      $this->comando         = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
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
          $NM_patch .= "cons_cta_corren_custo_distr_bkp/";
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
      $tp_fields['SC_historico_cond'] = 'cond';
      $tp_fields['SC_historico'] = 'text_aut';
      $tp_fields['id_ac_historico'] = 'text_aut';
      $tp_fields['SC_historico_input_2'] = 'text';
      $tp_fields['SC_valor_cond'] = 'cond';
      $tp_fields['SC_valor'] = 'text_aut';
      $tp_fields['id_ac_valor'] = 'text_aut';
      $tp_fields['SC_valor_input_2'] = 'text';
      $tp_fields['SC_descricao_item_cond'] = 'cond';
      $tp_fields['SC_descricao_item'] = 'text_aut';
      $tp_fields['id_ac_descricao_item'] = 'text_aut';
      $tp_fields['SC_codigo_erp_cond'] = 'cond';
      $tp_fields['SC_codigo_erp'] = 'text_aut';
      $tp_fields['id_ac_codigo_erp'] = 'text_aut';
      $tp_fields['SC_codigo_erp_input_2'] = 'text';
      $tp_fields['SC_container_cond'] = 'cond';
      $tp_fields['SC_container'] = 'text_aut';
      $tp_fields['id_ac_container'] = 'text_aut';
      $tp_fields['SC_container_input_2'] = 'text';
      $tp_fields['SC_cod_emit_forn_cond'] = 'cond';
      $tp_fields['SC_cod_emit_forn'] = 'text_aut';
      $tp_fields['id_ac_cod_emit_forn'] = 'text_aut';
      $tp_fields['SC_cod_emit_forn_input_2'] = 'text';
      $tp_fields['SC_fornec_pi_cond'] = 'cond';
      $tp_fields['SC_fornec_pi'] = 'text_aut';
      $tp_fields['id_ac_fornec_pi'] = 'text_aut';
      $tp_fields['SC_fornec_pi_input_2'] = 'text';
      $tp_fields['SC_cod_proc_fornec_pedido_cond'] = 'cond';
      $tp_fields['SC_cod_proc_fornec_pedido'] = 'text_aut';
      $tp_fields['id_ac_cod_proc_fornec_pedido'] = 'text_aut';
      $tp_fields['SC_cod_proc_fornec_pedido_input_2'] = 'text';
      $tp_fields['SC_dt_prev_chegada_cond'] = 'cond';
      $tp_fields['SC_dt_prev_chegada_dia'] = 'text';
      $tp_fields['SC_dt_prev_chegada_mes'] = 'text';
      $tp_fields['SC_dt_prev_chegada_ano'] = 'text';
      $tp_fields['SC_dt_prev_chegada_input_2_dia'] = 'text';
      $tp_fields['SC_dt_prev_chegada_input_2_mes'] = 'text';
      $tp_fields['SC_dt_prev_chegada_input_2_ano'] = 'text';
      $tp_fields['SC_dt_recebto_cond'] = 'cond';
      $tp_fields['SC_dt_recebto_dia'] = 'text';
      $tp_fields['SC_dt_recebto_mes'] = 'text';
      $tp_fields['SC_dt_recebto_ano'] = 'text';
      $tp_fields['SC_dt_recebto_input_2_dia'] = 'text';
      $tp_fields['SC_dt_recebto_input_2_mes'] = 'text';
      $tp_fields['SC_dt_recebto_input_2_ano'] = 'text';
      $tp_fields['SC_dt_registro_pedido_cond'] = 'cond';
      $tp_fields['SC_dt_registro_pedido_dia'] = 'text';
      $tp_fields['SC_dt_registro_pedido_mes'] = 'text';
      $tp_fields['SC_dt_registro_pedido_ano'] = 'text';
      $tp_fields['SC_dt_registro_pedido_input_2_dia'] = 'text';
      $tp_fields['SC_dt_registro_pedido_input_2_mes'] = 'text';
      $tp_fields['SC_dt_registro_pedido_input_2_ano'] = 'text';
      $tp_fields['SC_tipo_movto_cond'] = 'cond';
      $tp_fields['SC_tipo_movto'] = 'checkbox';
      $tp_fields['SC_situacao_container_cond'] = 'cond';
      $tp_fields['SC_situacao_container'] = 'checkbox';
      $tp_fields['SC_sit_acomp_container_cond'] = 'cond';
      $tp_fields['SC_sit_acomp_container'] = 'checkbox';
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
             $historico_cond, $historico, $historico_input_2, $historico_autocomp,
             $valor_cond, $valor, $valor_input_2, $valor_autocomp,
             $descricao_item_cond, $descricao_item, $descricao_item_autocomp,
             $codigo_erp_cond, $codigo_erp, $codigo_erp_input_2, $codigo_erp_autocomp,
             $container_cond, $container, $container_input_2, $container_autocomp,
             $cod_emit_forn_cond, $cod_emit_forn, $cod_emit_forn_input_2, $cod_emit_forn_autocomp,
             $fornec_pi_cond, $fornec_pi, $fornec_pi_input_2, $fornec_pi_autocomp,
             $cod_proc_fornec_pedido_cond, $cod_proc_fornec_pedido, $cod_proc_fornec_pedido_input_2, $cod_proc_fornec_pedido_autocomp,
             $dt_prev_chegada_cond, $dt_prev_chegada, $dt_prev_chegada_dia, $dt_prev_chegada_mes, $dt_prev_chegada_ano, $dt_prev_chegada_input_2_dia, $dt_prev_chegada_input_2_mes, $dt_prev_chegada_input_2_ano,
             $dt_recebto_cond, $dt_recebto, $dt_recebto_dia, $dt_recebto_mes, $dt_recebto_ano, $dt_recebto_input_2_dia, $dt_recebto_input_2_mes, $dt_recebto_input_2_ano,
             $dt_registro_pedido_cond, $dt_registro_pedido, $dt_registro_pedido_dia, $dt_registro_pedido_mes, $dt_registro_pedido_ano, $dt_registro_pedido_input_2_dia, $dt_registro_pedido_input_2_mes, $dt_registro_pedido_input_2_ano,
             $tipo_movto_cond, $tipo_movto,
             $situacao_container_cond, $situacao_container,
             $sit_acomp_container_cond, $sit_acomp_container, $nmgp_tab_label;

      $C_formatado = true;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($historico_autocomp) && empty($historico))
      {
          $historico = $historico_autocomp;
      }
      if (!empty($valor_autocomp) && empty($valor))
      {
          $valor = $valor_autocomp;
      }
      if (!empty($descricao_item_autocomp) && empty($descricao_item))
      {
          $descricao_item = $descricao_item_autocomp;
      }
      if (!empty($codigo_erp_autocomp) && empty($codigo_erp))
      {
          $codigo_erp = $codigo_erp_autocomp;
      }
      if (!empty($container_autocomp) && empty($container))
      {
          $container = $container_autocomp;
      }
      if (!empty($cod_emit_forn_autocomp) && empty($cod_emit_forn))
      {
          $cod_emit_forn = $cod_emit_forn_autocomp;
      }
      if (!empty($fornec_pi_autocomp) && empty($fornec_pi))
      {
          $fornec_pi = $fornec_pi_autocomp;
      }
      if (!empty($cod_proc_fornec_pedido_autocomp) && empty($cod_proc_fornec_pedido))
      {
          $cod_proc_fornec_pedido = $cod_proc_fornec_pedido_autocomp;
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
      $historico_cond_salva = $historico_cond; 
      if (!isset($historico_input_2) || $historico_input_2 == "")
      {
          $historico_input_2 = $historico;
      }
      $valor_cond_salva = $valor_cond; 
      if (!isset($valor_input_2) || $valor_input_2 == "")
      {
          $valor_input_2 = $valor;
      }
      $descricao_item_cond_salva = $descricao_item_cond; 
      if (!isset($descricao_item_input_2) || $descricao_item_input_2 == "")
      {
          $descricao_item_input_2 = $descricao_item;
      }
      $codigo_erp_cond_salva = $codigo_erp_cond; 
      if (!isset($codigo_erp_input_2) || $codigo_erp_input_2 == "")
      {
          $codigo_erp_input_2 = $codigo_erp;
      }
      $container_cond_salva = $container_cond; 
      if (!isset($container_input_2) || $container_input_2 == "")
      {
          $container_input_2 = $container;
      }
      $cod_emit_forn_cond_salva = $cod_emit_forn_cond; 
      if (!isset($cod_emit_forn_input_2) || $cod_emit_forn_input_2 == "")
      {
          $cod_emit_forn_input_2 = $cod_emit_forn;
      }
      $fornec_pi_cond_salva = $fornec_pi_cond; 
      if (!isset($fornec_pi_input_2) || $fornec_pi_input_2 == "")
      {
          $fornec_pi_input_2 = $fornec_pi;
      }
      $cod_proc_fornec_pedido_cond_salva = $cod_proc_fornec_pedido_cond; 
      if (!isset($cod_proc_fornec_pedido_input_2) || $cod_proc_fornec_pedido_input_2 == "")
      {
          $cod_proc_fornec_pedido_input_2 = $cod_proc_fornec_pedido;
      }
      $dt_prev_chegada_cond_salva = $dt_prev_chegada_cond; 
      if (!isset($dt_prev_chegada_input_2_dia) || $dt_prev_chegada_input_2_dia == "") {
          $dt_prev_chegada_input_2_dia = $dt_prev_chegada_dia;
      }
      if (!isset($dt_prev_chegada_input_2_mes) || $dt_prev_chegada_input_2_mes == "") {
          $dt_prev_chegada_input_2_mes = $dt_prev_chegada_mes;
      }
      if (!isset($dt_prev_chegada_input_2_ano) || $dt_prev_chegada_input_2_ano == "") {
          $dt_prev_chegada_input_2_ano = $dt_prev_chegada_ano;
      }
      $dt_recebto_cond_salva = $dt_recebto_cond; 
      if (!isset($dt_recebto_input_2_dia) || $dt_recebto_input_2_dia == "") {
          $dt_recebto_input_2_dia = $dt_recebto_dia;
      }
      if (!isset($dt_recebto_input_2_mes) || $dt_recebto_input_2_mes == "") {
          $dt_recebto_input_2_mes = $dt_recebto_mes;
      }
      if (!isset($dt_recebto_input_2_ano) || $dt_recebto_input_2_ano == "") {
          $dt_recebto_input_2_ano = $dt_recebto_ano;
      }
      $dt_registro_pedido_cond_salva = $dt_registro_pedido_cond; 
      if (!isset($dt_registro_pedido_input_2_dia) || $dt_registro_pedido_input_2_dia == "") {
          $dt_registro_pedido_input_2_dia = $dt_registro_pedido_dia;
      }
      if (!isset($dt_registro_pedido_input_2_mes) || $dt_registro_pedido_input_2_mes == "") {
          $dt_registro_pedido_input_2_mes = $dt_registro_pedido_mes;
      }
      if (!isset($dt_registro_pedido_input_2_ano) || $dt_registro_pedido_input_2_ano == "") {
          $dt_registro_pedido_input_2_ano = $dt_registro_pedido_ano;
      }
      $tipo_movto_cond_salva = $tipo_movto_cond; 
      if (!isset($tipo_movto_input_2) || $tipo_movto_input_2 == "")
      {
          $tipo_movto_input_2 = $tipo_movto;
      }
      $situacao_container_cond_salva = $situacao_container_cond; 
      if (!isset($situacao_container_input_2) || $situacao_container_input_2 == "")
      {
          $situacao_container_input_2 = $situacao_container;
      }
      $sit_acomp_container_cond_salva = $sit_acomp_container_cond; 
      if (!isset($sit_acomp_container_input_2) || $sit_acomp_container_input_2 == "")
      {
          $sit_acomp_container_input_2 = $sit_acomp_container;
      }
      if ($valor_cond != "in")
      {
          if ($C_formatado)
          {
              nm_limpa_valor($valor, $_SESSION['scriptcase']['reg_conf']['dec_num'], $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
          }
      }
      if ($valor_cond != "in")
      {
          if ($C_formatado)
          {
              nm_limpa_valor($valor_input_2, $_SESSION['scriptcase']['reg_conf']['dec_num'], $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
          }
      }
      if ($container_cond != "in")
      {
          nm_limpa_numero($container, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($container_cond != "in")
      {
          nm_limpa_numero($container_input_2, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_emit_forn_cond != "in")
      {
          nm_limpa_numero($cod_emit_forn, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_emit_forn_cond != "in")
      {
          nm_limpa_numero($cod_emit_forn_input_2, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($fornec_pi_cond != "in")
      {
          nm_limpa_numero($fornec_pi, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($fornec_pi_cond != "in")
      {
          nm_limpa_numero($fornec_pi_input_2, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if (is_array($tipo_movto)) {
          foreach ($tipo_movto as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['tipo_movto'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Tipo Movto : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      if (is_array($situacao_container)) {
          foreach ($situacao_container as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['situacao_container'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Situação Container : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      if (is_array($sit_acomp_container)) {
          foreach ($sit_acomp_container as $I => $Val) {
              $tmp_pos = (is_string($Val)) ? strpos($Val, "##@@") : false;
              if ($tmp_pos === false) {
                  $L_lookup = $Val;
              }
              else {
                  $L_lookup = substr($Val, 0, $tmp_pos);
              }
              if ($this->NM_ajax_opcao != "ajax_grid_search_change_fil" && trim($L_lookup) != '' && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['psq_check_ret']['sit_acomp_container'])) {
                  if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Sit.Acomp. Container : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_dia'] = $data_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_mes'] = $data_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_ano'] = $data_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_dia'] = $data_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_mes'] = $data_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2_ano'] = $data_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_cond'] = $data_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico'] = $historico; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico_input_2'] = $historico_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['historico_cond'] = $historico_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor'] = $valor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor_input_2'] = $valor_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['valor_cond'] = $valor_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['descricao_item'] = $descricao_item; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['descricao_item_cond'] = $descricao_item_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp'] = $codigo_erp; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp_input_2'] = $codigo_erp_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['codigo_erp_cond'] = $codigo_erp_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container'] = $container; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container_input_2'] = $container_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['container_cond'] = $container_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn'] = $cod_emit_forn; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn_input_2'] = $cod_emit_forn_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_emit_forn_cond'] = $cod_emit_forn_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi'] = $fornec_pi; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi_input_2'] = $fornec_pi_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['fornec_pi_cond'] = $fornec_pi_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido'] = $cod_proc_fornec_pedido; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido_input_2'] = $cod_proc_fornec_pedido_input_2; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['cod_proc_fornec_pedido_cond'] = $cod_proc_fornec_pedido_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_dia'] = $dt_prev_chegada_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_mes'] = $dt_prev_chegada_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_ano'] = $dt_prev_chegada_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_dia'] = $dt_prev_chegada_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_mes'] = $dt_prev_chegada_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2_ano'] = $dt_prev_chegada_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_cond'] = $dt_prev_chegada_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_dia'] = $dt_recebto_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_mes'] = $dt_recebto_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_ano'] = $dt_recebto_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_dia'] = $dt_recebto_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_mes'] = $dt_recebto_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2_ano'] = $dt_recebto_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_cond'] = $dt_recebto_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_dia'] = $dt_registro_pedido_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_mes'] = $dt_registro_pedido_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_ano'] = $dt_registro_pedido_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_dia'] = $dt_registro_pedido_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_mes'] = $dt_registro_pedido_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2_ano'] = $dt_registro_pedido_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_cond'] = $dt_registro_pedido_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['tipo_movto'] = $tipo_movto; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['tipo_movto_cond'] = $tipo_movto_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['situacao_container'] = $situacao_container; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['situacao_container_cond'] = $situacao_container_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['sit_acomp_container'] = $sit_acomp_container; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['sit_acomp_container_cond'] = $sit_acomp_container_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['dyn_search']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'] = $Temp_Busca;
      }
      if ($valor_cond != "in" && $valor_cond != "bw" && !empty($valor) && !is_numeric($valor))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Valor";
      }
      if ($valor_cond == "bw" && ((!empty($valor) && !is_numeric($valor)) || (!empty($valor_input_2) && !is_numeric($valor_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Valor";
      }
      if ($container_cond != "in" && $container_cond != "bw" && !empty($container) && !is_numeric($container))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Container";
      }
      if ($container_cond == "bw" && ((!empty($container) && !is_numeric($container)) || (!empty($container_input_2) && !is_numeric($container_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Container";
      }
      if ($cod_emit_forn_cond != "in" && $cod_emit_forn_cond != "bw" && !empty($cod_emit_forn) && !is_numeric($cod_emit_forn))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Fornecedor Container";
      }
      if ($cod_emit_forn_cond == "bw" && ((!empty($cod_emit_forn) && !is_numeric($cod_emit_forn)) || (!empty($cod_emit_forn_input_2) && !is_numeric($cod_emit_forn_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Fornecedor Container";
      }
      if ($fornec_pi_cond != "in" && $fornec_pi_cond != "bw" && !empty($fornec_pi) && !is_numeric($fornec_pi))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Fornecedor PI";
      }
      if ($fornec_pi_cond == "bw" && ((!empty($fornec_pi) && !is_numeric($fornec_pi)) || (!empty($fornec_pi_input_2) && !is_numeric($fornec_pi_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Fornecedor PI";
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $this->cmp_formatado['data'] = "'" . $this->cmp_formatado['data'] . "'";
      if (isset($this->cmp_formatado['data_input_2'])  && !empty($this->cmp_formatado['data_input_2'])) {
          $this->cmp_formatado['data_input_2'] = "'" . $this->cmp_formatado['data_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($historico != '') {
      $historico_look = (is_string($historico) ? substr($this->Db->qstr($historico), 1, -1) : $historico); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct HISTORICO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#HISTORICO#lowerF# = #lowerI#'$historico_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
      $Conteudo = $historico_input_2;
      $this->cmp_formatado['historico_input_2'] = $Conteudo;
      $this->cmp_formatado['historico'] = "'" . $this->cmp_formatado['historico'] . "'";
      if (isset($this->cmp_formatado['historico_input_2'])  && !empty($this->cmp_formatado['historico_input_2'])) {
          $this->cmp_formatado['historico_input_2'] = "'" . $this->cmp_formatado['historico_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($valor != '') {
      $valor_look = (is_string($valor) ? substr($this->Db->qstr($valor), 1, -1) : $valor); 
      $nmgp_def_dados = array(); 
   if (is_numeric($valor))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      else
      {
          $nm_comando = "select distinct VALOR from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where VALOR = $valor_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
              nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
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

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['valor'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['valor'] = $cmp1;
      }
      else
      {
          $cmp1 = $valor;
          nmgp_Form_Num_Val($cmp1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          $this->cmp_formatado['valor'] = $cmp1;
      }
      $Conteudo = $valor_input_2;
      if (strtoupper($valor_cond) != "II" && strtoupper($valor_cond) != "QP" && strtoupper($valor_cond) != "NP" && strtoupper($valor_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['valor_input_2'] = $Conteudo;
      $this->cmp_formatado['valor'] = "'" . $this->cmp_formatado['valor'] . "'";
      if (isset($this->cmp_formatado['valor_input_2'])  && !empty($this->cmp_formatado['valor_input_2'])) {
          $this->cmp_formatado['valor_input_2'] = "'" . $this->cmp_formatado['valor_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($descricao_item != '') {
      $descricao_item_look = (is_string($descricao_item) ? substr($this->Db->qstr($descricao_item), 1, -1) : $descricao_item); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct DESCRICAO_ITEM from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#DESCRICAO_ITEM#lowerF# = #lowerI#'$descricao_item_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
          $this->cmp_formatado['descricao_item'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['descricao_item'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['descricao_item'] = $descricao_item;
      }
      $this->cmp_formatado['descricao_item'] = "'" . $this->cmp_formatado['descricao_item'] . "'";
      if (isset($this->cmp_formatado['descricao_item_input_2'])  && !empty($this->cmp_formatado['descricao_item_input_2'])) {
          $this->cmp_formatado['descricao_item_input_2'] = "'" . $this->cmp_formatado['descricao_item_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($codigo_erp != '') {
      $codigo_erp_look = (is_string($codigo_erp) ? substr($this->Db->qstr($codigo_erp), 1, -1) : $codigo_erp); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct CODIGO_ERP from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#CODIGO_ERP#lowerF# = #lowerI#'$codigo_erp_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
          $this->cmp_formatado['codigo_erp'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['codigo_erp'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['codigo_erp'] = $codigo_erp;
      }
      $Conteudo = $codigo_erp_input_2;
      $this->cmp_formatado['codigo_erp_input_2'] = $Conteudo;
      $this->cmp_formatado['codigo_erp'] = "'" . $this->cmp_formatado['codigo_erp'] . "'";
      if (isset($this->cmp_formatado['codigo_erp_input_2'])  && !empty($this->cmp_formatado['codigo_erp_input_2'])) {
          $this->cmp_formatado['codigo_erp_input_2'] = "'" . $this->cmp_formatado['codigo_erp_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($container != '') {
      $container_look = (is_string($container) ? substr($this->Db->qstr($container), 1, -1) : $container); 
      $nmgp_def_dados = array(); 
   if (is_numeric($container))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      else
      {
          $nm_comando = "select distinct CONTAINER from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where CONTAINER = $container_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['container'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['container'] = $cmp1;
      }
      else
      {
          $cmp1 = $container;
          nmgp_Form_Num_Val($cmp1, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $this->cmp_formatado['container'] = $cmp1;
      }
      $Conteudo = $container_input_2;
      if (strtoupper($container_cond) != "II" && strtoupper($container_cond) != "QP" && strtoupper($container_cond) != "NP" && strtoupper($container_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['container_input_2'] = $Conteudo;
      $this->cmp_formatado['container'] = "'" . $this->cmp_formatado['container'] . "'";
      if (isset($this->cmp_formatado['container_input_2'])  && !empty($this->cmp_formatado['container_input_2'])) {
          $this->cmp_formatado['container_input_2'] = "'" . $this->cmp_formatado['container_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cod_emit_forn != '') {
      $cod_emit_forn_look = (is_string($cod_emit_forn) ? substr($this->Db->qstr($cod_emit_forn), 1, -1) : $cod_emit_forn); 
      $nmgp_def_dados = array(); 
   if (is_numeric($cod_emit_forn))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      else
      {
          $nm_comando = "select distinct COD_EMIT_FORN from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where COD_EMIT_FORN = $cod_emit_forn_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cod_emit_forn'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cod_emit_forn'] = $cmp1;
      }
      else
      {
          $cmp1 = $cod_emit_forn;
          nmgp_Form_Num_Val($cmp1, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $this->cmp_formatado['cod_emit_forn'] = $cmp1;
      }
      $Conteudo = $cod_emit_forn_input_2;
      if (strtoupper($cod_emit_forn_cond) != "II" && strtoupper($cod_emit_forn_cond) != "QP" && strtoupper($cod_emit_forn_cond) != "NP" && strtoupper($cod_emit_forn_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_emit_forn_input_2'] = $Conteudo;
      $this->cmp_formatado['cod_emit_forn'] = "'" . $this->cmp_formatado['cod_emit_forn'] . "'";
      if (isset($this->cmp_formatado['cod_emit_forn_input_2'])  && !empty($this->cmp_formatado['cod_emit_forn_input_2'])) {
          $this->cmp_formatado['cod_emit_forn_input_2'] = "'" . $this->cmp_formatado['cod_emit_forn_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($fornec_pi != '') {
      $fornec_pi_look = (is_string($fornec_pi) ? substr($this->Db->qstr($fornec_pi), 1, -1) : $fornec_pi); 
      $nmgp_def_dados = array(); 
   if (is_numeric($fornec_pi))
   { 
      if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      elseif (isset($this->Ini->nm_bases_sybase) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      else
      {
          $nm_comando = "select distinct FORNEC_PI from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where FORNEC_PI = $fornec_pi_look"; 
      }
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
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

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['fornec_pi'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['fornec_pi'] = $cmp1;
      }
      else
      {
          $cmp1 = $fornec_pi;
          nmgp_Form_Num_Val($cmp1, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $this->cmp_formatado['fornec_pi'] = $cmp1;
      }
      $Conteudo = $fornec_pi_input_2;
      if (strtoupper($fornec_pi_cond) != "II" && strtoupper($fornec_pi_cond) != "QP" && strtoupper($fornec_pi_cond) != "NP" && strtoupper($fornec_pi_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['fornec_pi_input_2'] = $Conteudo;
      $this->cmp_formatado['fornec_pi'] = "'" . $this->cmp_formatado['fornec_pi'] . "'";
      if (isset($this->cmp_formatado['fornec_pi_input_2'])  && !empty($this->cmp_formatado['fornec_pi_input_2'])) {
          $this->cmp_formatado['fornec_pi_input_2'] = "'" . $this->cmp_formatado['fornec_pi_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cod_proc_fornec_pedido != '') {
      $cod_proc_fornec_pedido_look = (is_string($cod_proc_fornec_pedido) ? substr($this->Db->qstr($cod_proc_fornec_pedido), 1, -1) : $cod_proc_fornec_pedido); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct COD_PROC_FORNEC_PEDIDO from (SELECT     'versao_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.item_container_custos icc     on custo_distr.item_container_custo_id = icc.item_container_custo_id     inner join pub.itens_container ic     on ic.item_container_id = icc.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 3 union SELECT     'distr_custo' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       ipc.descricao as descricao_item,    ipc.codigo_erp as codigo_erp,    ic.container_id as container,    container.situacao_container_id as sit_acomp_container,    container.situacao  as situacao_container,    container.\"dt-prev-chegada\" as dt_prev_chegada,    container.\"dt-recebimento\" as dt_recebto,    container.\"cod-emit-forn\" as cod_emit_forn,    pc.cod_proc_fornec as cod_proc_fornec_pedido,    pc.dt_registro as dt_registro_pedido,    pc.fornecedor_id as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr     inner join pub.itens_container ic     on ic.item_container_id = custo_distr.item_container_id	     inner join pub.itens_proc_compra ipc     on ipc.item_proc_compra_id = ic.item_proc_compra_id     inner join pub.\"pp-container\" as container 	on container.\"nr-container\" = ic.container_id     inner join pub.procs_compra pc     on pc.proc_compra_id = ipc.proc_compra_id     where custo_distr.cod_tipo_movto = 4 union SELECT     'manual' as origem ,    custo_distr.cta_corren_custo_distr_id as id,    custo_distr.data as data,       custo_distr.item_container_custo_id as id_origem,       custo_distr.historico as historico,    custo_distr.cod_tipo_movto as tipo_movto,    custo_distr.vl_lancto as valor,       '' as descricao_item,    '' as codigo_erp,    0  as container,    0  as sit_acomp_container,    0  as situacao_container,    '' as dt_prev_chegada,    '' as dt_recebto,    0 as cod_emit_forn,    '' as cod_proc_fornec_pedido,    '' as dt_registro_pedido,    0 as fornec_pi FROM      PUB.cta_corren_custo_distr custo_distr where custo_distr.cod_tipo_movto = 2     order by data) nm_sel_esp where #lowerI#COD_PROC_FORNEC_PEDIDO#lowerF# = #lowerI#'$cod_proc_fornec_pedido_look'#lowerF#"; 
      foreach ($this->Ini->nm_col_dinamica as $nm_cada_col => $nm_nova_col)
      {
          $nm_comando = str_replace($nm_cada_col, $nm_nova_col, $nm_comando); 
      }
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
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
          $this->cmp_formatado['cod_proc_fornec_pedido'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cod_proc_fornec_pedido'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['cod_proc_fornec_pedido'] = $cod_proc_fornec_pedido;
      }
      $Conteudo = $cod_proc_fornec_pedido_input_2;
      $this->cmp_formatado['cod_proc_fornec_pedido_input_2'] = $Conteudo;
      $this->cmp_formatado['cod_proc_fornec_pedido'] = "'" . $this->cmp_formatado['cod_proc_fornec_pedido'] . "'";
      if (isset($this->cmp_formatado['cod_proc_fornec_pedido_input_2'])  && !empty($this->cmp_formatado['cod_proc_fornec_pedido_input_2'])) {
          $this->cmp_formatado['cod_proc_fornec_pedido_input_2'] = "'" . $this->cmp_formatado['cod_proc_fornec_pedido_input_2'] . "'";
      }
      $this->cmp_formatado['dt_prev_chegada'] = "'" . $this->cmp_formatado['dt_prev_chegada'] . "'";
      if (isset($this->cmp_formatado['dt_prev_chegada_input_2'])  && !empty($this->cmp_formatado['dt_prev_chegada_input_2'])) {
          $this->cmp_formatado['dt_prev_chegada_input_2'] = "'" . $this->cmp_formatado['dt_prev_chegada_input_2'] . "'";
      }
      $this->cmp_formatado['dt_recebto'] = "'" . $this->cmp_formatado['dt_recebto'] . "'";
      if (isset($this->cmp_formatado['dt_recebto_input_2'])  && !empty($this->cmp_formatado['dt_recebto_input_2'])) {
          $this->cmp_formatado['dt_recebto_input_2'] = "'" . $this->cmp_formatado['dt_recebto_input_2'] . "'";
      }
      $this->cmp_formatado['dt_registro_pedido'] = "'" . $this->cmp_formatado['dt_registro_pedido'] . "'";
      if (isset($this->cmp_formatado['dt_registro_pedido_input_2'])  && !empty($this->cmp_formatado['dt_registro_pedido_input_2'])) {
          $this->cmp_formatado['dt_registro_pedido_input_2'] = "'" . $this->cmp_formatado['dt_registro_pedido_input_2'] . "'";
      }
      $this->cmp_formatado['tipo_movto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['tipo_movto'];
      $this->cmp_formatado['tipo_movto_input_2'] = $tipo_movto_input_2;
      $this->cmp_formatado['tipo_movto'] = "'" . $this->cmp_formatado['tipo_movto'] . "'";
      if (isset($this->cmp_formatado['tipo_movto_input_2'])  && !empty($this->cmp_formatado['tipo_movto_input_2'])) {
          $this->cmp_formatado['tipo_movto_input_2'] = "'" . $this->cmp_formatado['tipo_movto_input_2'] . "'";
      }
      $this->cmp_formatado['situacao_container'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['situacao_container'];
      $this->cmp_formatado['situacao_container_input_2'] = $situacao_container_input_2;
      $this->cmp_formatado['situacao_container'] = "'" . $this->cmp_formatado['situacao_container'] . "'";
      if (isset($this->cmp_formatado['situacao_container_input_2'])  && !empty($this->cmp_formatado['situacao_container_input_2'])) {
          $this->cmp_formatado['situacao_container_input_2'] = "'" . $this->cmp_formatado['situacao_container_input_2'] . "'";
      }
      $this->cmp_formatado['sit_acomp_container'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['sit_acomp_container'];
      $this->cmp_formatado['sit_acomp_container_input_2'] = $sit_acomp_container_input_2;
      $this->cmp_formatado['sit_acomp_container'] = "'" . $this->cmp_formatado['sit_acomp_container'] . "'";
      if (isset($this->cmp_formatado['sit_acomp_container_input_2'])  && !empty($this->cmp_formatado['sit_acomp_container_input_2'])) {
          $this->cmp_formatado['sit_acomp_container_input_2'] = "'" . $this->cmp_formatado['sit_acomp_container_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $data_cond, $data, $data_dia, $data_mes, $data_ano, $data_input_2_dia, $data_input_2_mes, $data_input_2_ano,
             $historico_cond, $historico, $historico_input_2, $historico_autocomp,
             $valor_cond, $valor, $valor_input_2, $valor_autocomp,
             $descricao_item_cond, $descricao_item, $descricao_item_autocomp,
             $codigo_erp_cond, $codigo_erp, $codigo_erp_input_2, $codigo_erp_autocomp,
             $container_cond, $container, $container_input_2, $container_autocomp,
             $cod_emit_forn_cond, $cod_emit_forn, $cod_emit_forn_input_2, $cod_emit_forn_autocomp,
             $fornec_pi_cond, $fornec_pi, $fornec_pi_input_2, $fornec_pi_autocomp,
             $cod_proc_fornec_pedido_cond, $cod_proc_fornec_pedido, $cod_proc_fornec_pedido_input_2, $cod_proc_fornec_pedido_autocomp,
             $dt_prev_chegada_cond, $dt_prev_chegada, $dt_prev_chegada_dia, $dt_prev_chegada_mes, $dt_prev_chegada_ano, $dt_prev_chegada_input_2_dia, $dt_prev_chegada_input_2_mes, $dt_prev_chegada_input_2_ano,
             $dt_recebto_cond, $dt_recebto, $dt_recebto_dia, $dt_recebto_mes, $dt_recebto_ano, $dt_recebto_input_2_dia, $dt_recebto_input_2_mes, $dt_recebto_input_2_ano,
             $dt_registro_pedido_cond, $dt_registro_pedido, $dt_registro_pedido_dia, $dt_registro_pedido_mes, $dt_registro_pedido_ano, $dt_registro_pedido_input_2_dia, $dt_registro_pedido_input_2_mes, $dt_registro_pedido_input_2_ano,
             $tipo_movto_cond, $tipo_movto,
             $situacao_container_cond, $situacao_container,
             $sit_acomp_container_cond, $sit_acomp_container, $nmgp_tab_label;


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
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data'] = $val[0];
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['data_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['data_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['data_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_input_2'] = "'" . $this->cmp_formatado['data_input_2'] . "'";
          }
          if (!empty($Dtxt) || $data_cond == "NU" || $data_cond == "NN"|| $data_cond == "EP"|| $data_cond == "NE")
          {
              $this->monta_condicao("DATA", $data_cond, $data, $data_input_2, 'data', 'DATE');
          }
      }

      //----- $historico
      $this->Date_part = false;
      if (isset($historico) || $historico_cond == "nu" || $historico_cond == "nn" || $historico_cond == "ep" || $historico_cond == "ne")
      {
         $this->monta_condicao("HISTORICO", $historico_cond, $historico, $historico_input_2, "historico", "VARCHAR", false);
      }

      //----- $valor
      $this->Date_part = false;
      if (isset($valor) || $valor_cond == "nu" || $valor_cond == "nn" || $valor_cond == "ep" || $valor_cond == "ne")
      {
         $this->monta_condicao("VALOR", $valor_cond, $valor, $valor_input_2, "valor", "NUMERIC", false);
      }

      //----- $descricao_item
      $this->Date_part = false;
      if (isset($descricao_item) || $descricao_item_cond == "nu" || $descricao_item_cond == "nn" || $descricao_item_cond == "ep" || $descricao_item_cond == "ne")
      {
         $this->monta_condicao("DESCRICAO_ITEM", $descricao_item_cond, $descricao_item, "", "descricao_item", "VARCHAR", false);
      }

      //----- $codigo_erp
      $this->Date_part = false;
      if (isset($codigo_erp) || $codigo_erp_cond == "nu" || $codigo_erp_cond == "nn" || $codigo_erp_cond == "ep" || $codigo_erp_cond == "ne")
      {
         $this->monta_condicao("CODIGO_ERP", $codigo_erp_cond, $codigo_erp, $codigo_erp_input_2, "codigo_erp", "VARCHAR", false);
      }

      //----- $container
      $this->Date_part = false;
      if (isset($container) || $container_cond == "nu" || $container_cond == "nn" || $container_cond == "ep" || $container_cond == "ne")
      {
         $this->monta_condicao("CONTAINER", $container_cond, $container, $container_input_2, "container", "INTEGER", false);
      }

      //----- $cod_emit_forn
      $this->Date_part = false;
      if (isset($cod_emit_forn) || $cod_emit_forn_cond == "nu" || $cod_emit_forn_cond == "nn" || $cod_emit_forn_cond == "ep" || $cod_emit_forn_cond == "ne")
      {
         $this->monta_condicao("COD_EMIT_FORN", $cod_emit_forn_cond, $cod_emit_forn, $cod_emit_forn_input_2, "cod_emit_forn", "INTEGER", false);
      }

      //----- $fornec_pi
      $this->Date_part = false;
      if (isset($fornec_pi) || $fornec_pi_cond == "nu" || $fornec_pi_cond == "nn" || $fornec_pi_cond == "ep" || $fornec_pi_cond == "ne")
      {
         $this->monta_condicao("FORNEC_PI", $fornec_pi_cond, $fornec_pi, $fornec_pi_input_2, "fornec_pi", "INTEGER", false);
      }

      //----- $cod_proc_fornec_pedido
      $this->Date_part = false;
      if (isset($cod_proc_fornec_pedido) || $cod_proc_fornec_pedido_cond == "nu" || $cod_proc_fornec_pedido_cond == "nn" || $cod_proc_fornec_pedido_cond == "ep" || $cod_proc_fornec_pedido_cond == "ne")
      {
         $this->monta_condicao("COD_PROC_FORNEC_PEDIDO", $cod_proc_fornec_pedido_cond, $cod_proc_fornec_pedido, $cod_proc_fornec_pedido_input_2, "cod_proc_fornec_pedido", "VARCHAR", false);
      }

      //----- $dt_prev_chegada
      $this->Date_part = false;
      if ($dt_prev_chegada_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $dt_prev_chegada_cond = strtoupper($dt_prev_chegada_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $dt_prev_chegada_ano;
          $Dtxt .= $dt_prev_chegada_mes;
          $Dtxt .= $dt_prev_chegada_dia;
          $val[0]['ano'] = $dt_prev_chegada_ano;
          $val[0]['mes'] = $dt_prev_chegada_mes;
          $val[0]['dia'] = $dt_prev_chegada_dia;
          if ($dt_prev_chegada_cond == "BW")
          {
              $val[1]['ano'] = $dt_prev_chegada_input_2_ano;
              $val[1]['mes'] = $dt_prev_chegada_input_2_mes;
              $val[1]['dia'] = $dt_prev_chegada_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "ND", "CHARACTER", $dt_prev_chegada_cond, "yyyy-mm-dd", "data");
          $dt_prev_chegada = $val[0];
          $this->cmp_formatado['dt_prev_chegada'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['dt_prev_chegada'], "AAAA-MM-DD");
          $this->cmp_formatado['dt_prev_chegada'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_prev_chegada'] = "'" . $this->cmp_formatado['dt_prev_chegada'] . "'";
          if ($dt_prev_chegada_cond == "BW")
          {
              $dt_prev_chegada_input_2     = $val[1];
              $this->cmp_formatado['dt_prev_chegada_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_prev_chegada_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['dt_prev_chegada_input_2'], "AAAA-MM-DD");
              $this->cmp_formatado['dt_prev_chegada_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_prev_chegada_input_2'] = "'" . $this->cmp_formatado['dt_prev_chegada_input_2'] . "'";
          }
          if (!empty($Dtxt) || $dt_prev_chegada_cond == "NU" || $dt_prev_chegada_cond == "NN"|| $dt_prev_chegada_cond == "EP"|| $dt_prev_chegada_cond == "NE")
          {
              $this->monta_condicao("DT_PREV_CHEGADA", $dt_prev_chegada_cond, $dt_prev_chegada, $dt_prev_chegada_input_2, 'dt_prev_chegada', 'CHARACTER');
          }
      }

      //----- $dt_recebto
      $this->Date_part = false;
      if ($dt_recebto_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $dt_recebto_cond = strtoupper($dt_recebto_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $dt_recebto_ano;
          $Dtxt .= $dt_recebto_mes;
          $Dtxt .= $dt_recebto_dia;
          $val[0]['ano'] = $dt_recebto_ano;
          $val[0]['mes'] = $dt_recebto_mes;
          $val[0]['dia'] = $dt_recebto_dia;
          if ($dt_recebto_cond == "BW")
          {
              $val[1]['ano'] = $dt_recebto_input_2_ano;
              $val[1]['mes'] = $dt_recebto_input_2_mes;
              $val[1]['dia'] = $dt_recebto_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "ND", "CHARACTER", $dt_recebto_cond, "yyyy-mm-dd", "data");
          $dt_recebto = $val[0];
          $this->cmp_formatado['dt_recebto'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['dt_recebto'], "AAAA-MM-DD");
          $this->cmp_formatado['dt_recebto'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_recebto'] = "'" . $this->cmp_formatado['dt_recebto'] . "'";
          if ($dt_recebto_cond == "BW")
          {
              $dt_recebto_input_2     = $val[1];
              $this->cmp_formatado['dt_recebto_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_recebto_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['dt_recebto_input_2'], "AAAA-MM-DD");
              $this->cmp_formatado['dt_recebto_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_recebto_input_2'] = "'" . $this->cmp_formatado['dt_recebto_input_2'] . "'";
          }
          if (!empty($Dtxt) || $dt_recebto_cond == "NU" || $dt_recebto_cond == "NN"|| $dt_recebto_cond == "EP"|| $dt_recebto_cond == "NE")
          {
              $this->monta_condicao("DT_RECEBTO", $dt_recebto_cond, $dt_recebto, $dt_recebto_input_2, 'dt_recebto', 'CHARACTER');
          }
      }

      //----- $dt_registro_pedido
      $this->Date_part = false;
      if ($dt_registro_pedido_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $dt_registro_pedido_cond = strtoupper($dt_registro_pedido_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $dt_registro_pedido_ano;
          $Dtxt .= $dt_registro_pedido_mes;
          $Dtxt .= $dt_registro_pedido_dia;
          $val[0]['ano'] = $dt_registro_pedido_ano;
          $val[0]['mes'] = $dt_registro_pedido_mes;
          $val[0]['dia'] = $dt_registro_pedido_dia;
          if ($dt_registro_pedido_cond == "BW")
          {
              $val[1]['ano'] = $dt_registro_pedido_input_2_ano;
              $val[1]['mes'] = $dt_registro_pedido_input_2_mes;
              $val[1]['dia'] = $dt_registro_pedido_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "ND", "CHARACTER", $dt_registro_pedido_cond, "yyyy-mm-dd", "data");
          $dt_registro_pedido = $val[0];
          $this->cmp_formatado['dt_registro_pedido'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['dt_registro_pedido'], "AAAA-MM-DD");
          $this->cmp_formatado['dt_registro_pedido'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_registro_pedido'] = "'" . $this->cmp_formatado['dt_registro_pedido'] . "'";
          if ($dt_registro_pedido_cond == "BW")
          {
              $dt_registro_pedido_input_2     = $val[1];
              $this->cmp_formatado['dt_registro_pedido_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']['dt_registro_pedido_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['dt_registro_pedido_input_2'], "AAAA-MM-DD");
              $this->cmp_formatado['dt_registro_pedido_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_registro_pedido_input_2'] = "'" . $this->cmp_formatado['dt_registro_pedido_input_2'] . "'";
          }
          if (!empty($Dtxt) || $dt_registro_pedido_cond == "NU" || $dt_registro_pedido_cond == "NN"|| $dt_registro_pedido_cond == "EP"|| $dt_registro_pedido_cond == "NE")
          {
              $this->monta_condicao("DT_REGISTRO_PEDIDO", $dt_registro_pedido_cond, $dt_registro_pedido, $dt_registro_pedido_input_2, 'dt_registro_pedido', 'CHARACTER');
          }
      }

      //----- $tipo_movto
      $this->Date_part = false;
      $tipo_movto = $tipo_movto; 
      $nm_aspas = "";
      if ($tipo_movto_cond == "nu" || $tipo_movto_cond == "nn" || $tipo_movto_cond == "ep" || $tipo_movto_cond == "ne")
      {
          $tipo_movto = array();
      }
      if (is_array($tipo_movto) && count($tipo_movto) != 0)
      {
         foreach ($tipo_movto as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($tipo_movto[$i]);
            }
         }
      }
      if (is_array($tipo_movto) && count($tipo_movto) != 0)
      {
         $this->and_or();
         if ($tipo_movto_cond == "df" || $tipo_movto_cond == "np")
         {
             $this->comando        .= " TIPO_MOVTO not in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.TIPO_MOVTO not in (";
             $this->comando_filtro .= " TIPO_MOVTO not in (";
         }
         else
         {
             $this->comando        .= " TIPO_MOVTO in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.TIPO_MOVTO in (";
             $this->comando_filtro .= " TIPO_MOVTO in (";
         }
         $x                     = count($tipo_movto);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($tipo_movto_cond == "df" || $tipo_movto_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($tipo_movto as $i => $dados)
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
         $Lang_descr_final = isset($Lang_descr[$tipo_movto_cond]) ? $Lang_descr[$tipo_movto_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= $nmgp_tab_label['tipo_movto'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
      }
      elseif (isset($tipo_movto) && ($tipo_movto_cond == "nu" || $tipo_movto_cond == "nn" || $tipo_movto_cond == "ep" || $tipo_movto_cond == "ne"))
      {
         $this->monta_condicao("TIPO_MOVTO", $tipo_movto_cond, "", "", "tipo_movto", "INTEGER", false);
      }

      //----- $situacao_container
      $this->Date_part = false;
      $situacao_container = $situacao_container; 
      $nm_aspas = "";
      if ($situacao_container_cond == "nu" || $situacao_container_cond == "nn" || $situacao_container_cond == "ep" || $situacao_container_cond == "ne")
      {
          $situacao_container = array();
      }
      if (is_array($situacao_container) && count($situacao_container) != 0)
      {
         foreach ($situacao_container as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($situacao_container[$i]);
            }
         }
      }
      if (is_array($situacao_container) && count($situacao_container) != 0)
      {
         $this->and_or();
         if ($situacao_container_cond == "df" || $situacao_container_cond == "np")
         {
             $this->comando        .= " SITUACAO_CONTAINER not in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.SITUACAO_CONTAINER not in (";
             $this->comando_filtro .= " SITUACAO_CONTAINER not in (";
         }
         else
         {
             $this->comando        .= " SITUACAO_CONTAINER in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.SITUACAO_CONTAINER in (";
             $this->comando_filtro .= " SITUACAO_CONTAINER in (";
         }
         $x                     = count($situacao_container);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($situacao_container_cond == "df" || $situacao_container_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($situacao_container as $i => $dados)
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
         $Lang_descr_final = isset($Lang_descr[$situacao_container_cond]) ? $Lang_descr[$situacao_container_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= $nmgp_tab_label['situacao_container'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
      }
      elseif (isset($situacao_container) && ($situacao_container_cond == "nu" || $situacao_container_cond == "nn" || $situacao_container_cond == "ep" || $situacao_container_cond == "ne"))
      {
         $this->monta_condicao("SITUACAO_CONTAINER", $situacao_container_cond, "", "", "situacao_container", "INTEGER", false);
      }

      //----- $sit_acomp_container
      $this->Date_part = false;
      $sit_acomp_container = $sit_acomp_container; 
      $nm_aspas = "";
      if ($sit_acomp_container_cond == "nu" || $sit_acomp_container_cond == "nn" || $sit_acomp_container_cond == "ep" || $sit_acomp_container_cond == "ne")
      {
          $sit_acomp_container = array();
      }
      if (is_array($sit_acomp_container) && count($sit_acomp_container) != 0)
      {
         foreach ($sit_acomp_container as $i => $dados)
         {
            $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
            if (($tmp_pos === false && $dados == "") || $tmp_pos == 0)
            {
                unset($sit_acomp_container[$i]);
            }
         }
      }
      if (is_array($sit_acomp_container) && count($sit_acomp_container) != 0)
      {
         $this->and_or();
         if ($sit_acomp_container_cond == "df" || $sit_acomp_container_cond == "np")
         {
             $this->comando        .= " SIT_ACOMP_CONTAINER not in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.SIT_ACOMP_CONTAINER not in (";
             $this->comando_filtro .= " SIT_ACOMP_CONTAINER not in (";
         }
         else
         {
             $this->comando        .= " SIT_ACOMP_CONTAINER in (";
             $this->comando_sum    .= " PUB.cta_corren_custo_distr.SIT_ACOMP_CONTAINER in (";
             $this->comando_filtro .= " SIT_ACOMP_CONTAINER in (";
         }
         $x                     = count($sit_acomp_container);
         $xx                    = 0;
         $nm_cond               = "";
         $Lang_concat = ($sit_acomp_container_cond == "df" || $sit_acomp_container_cond == "np") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
         foreach ($sit_acomp_container as $i => $dados)
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
         $Lang_descr_final = isset($Lang_descr[$sit_acomp_container_cond]) ? $Lang_descr[$sit_acomp_container_cond] : $this->Ini->Nm_lang['lang_srch_like'];
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= $nmgp_tab_label['sit_acomp_container'] . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
      }
      elseif (isset($sit_acomp_container) && ($sit_acomp_container_cond == "nu" || $sit_acomp_container_cond == "nn" || $sit_acomp_container_cond == "ep" || $sit_acomp_container_cond == "ne"))
      {
         $this->monta_condicao("SIT_ACOMP_CONTAINER", $sit_acomp_container_cond, "", "", "sit_acomp_container", "INTEGER", false);
      }
   }

   /**
    * @access  public
    */
   function Sel_case_sensitive(&$comando_sel)
   {
      if ($this->NM_case_insensitive)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $comando_sel = str_replace("#lowerI#", "UCase(", $comando_sel);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              if (strpos($comando_sel, " like ") !== false)
              {
                  $comando_sel = str_replace("#lowerI#", "", $comando_sel);
                  $comando_sel = str_replace("#lowerF#", "", $comando_sel);
                  $comando_sel = str_replace(" like ", " ilike ", $comando_sel);
              }
              else
              {
                  $comando_sel = str_replace("#lowerI#", "Upper(", $comando_sel);
              }
          }
          else
          {
              $comando_sel = str_replace("#lowerI#", "Upper(", $comando_sel);
          }
          $comando_sel = str_replace("#lowerF#", ")", $comando_sel);
      }
      else
      {
          $comando_sel = str_replace("#lowerI#", "", $comando_sel);
          $comando_sel = str_replace("#lowerF#", "", $comando_sel);
      }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['fast_search']);
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['cons_cta_corren_custo_distr_bkp']['where_pesq'];

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
function criarRegDistrCusto($item_container_custo_id,$item_container_id,$historico,$cod_tipo_movto,$vl_lancto)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    if(!getParamDistrCusto()){
        $vl_lancto = 0;
        $historico .=" - Lançamento zerado devido a distribuição de custo estar desligada";
    }
    $login = getLoginCorrente();
    $cmd = "insert into pub.cta_corren_custo_distr(cta_corren_custo_distr_id,data,item_container_custo_id,item_container_id,historico,
            cod_tipo_movto,vl_lancto,login)
            values(pub.seq_cta_corren_custo_distr.NEXTVAL,CURDATE(),$item_container_custo_id,$item_container_id,'$historico',$cod_tipo_movto,$vl_lancto,'$login')";
    
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
  
    $container = 0;
    $aDados = $this->buscarDadosCtaCorrenCustoDistr ($id);
    if(is_array ($aDados)){
        $itemContainerId = $aDados[0]['item_container_id'];
        $aDadosItemContainer = buscarDadositemContainer ($itemContainerId);
        if(is_array ($aDadosItemContainer)){
            $container = $aDadosItemContainer[0]['container_id'];
        }
    }
    return $container;


$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function criarDespesaDistrCusto($idCtaCorrenCustoDistr,$valor,$itemContainerId=0,$container=0)
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $memoriaCalculo = '';

    $idDespesa = buscarDespesaDistrCusto();
    if($container == 0){
        $container = $this->buscarContainerCtaCorrenCustoDistr($idCtaCorrenCustoDistr);
    }
    if(!getParamDistrCusto()){
        $valor = 0;
        $memoriaCalculo = 'Valor do lançamento zerado devido a distr. custo estar desligada por parametro';
    }
    criarDespesaContainer(
        $container,
        $idDespesa,
        $valor,
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
    $id = buscarDespesaContainerDistrCusto($idCtaCorrenCustoDistr);
    if($id <> 0){
        $logAtualizado = 1;
        atualizarVlDespesaContainerPorId($id,$valor);
    }
    return $logAtualizado;

$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'off';
}
function buscarSaldoAtualDistrCusto()
{
$_SESSION['scriptcase']['cons_cta_corren_custo_distr_bkp']['contr_erro'] = 'on';
  
    $valor = 0;
    $tabela = "pub.cta_corren_custo_distr";
    $campo = "sum(vl_lancto) as saldo";
    $condicao = " 1=1 ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['saldo'];
    }
    return $valor;

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
      if ($distr = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $distr = false;
          $distr_erro = $this->Db->ErrorMsg();
      } 

    if ($distr  === false){
    echo "Access error. Message =". $distr_erro ;
    $aRetorno = '';
    }
    else
    {
        while (!$distr->EOF) {
            $data = $distr->fields[ 0 ];
            $valorSaldo = $distr->fields[ 1 ];
            if ( $iCont == 0 ) {
                $dataInicio = $data ;
            }
            $total += $valorSaldo;
            $iCont++;
            $distr->MoveNext ();
        }
        $distr->Close ();

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
            $container          = $aDados[$i]['container_id'];
            $indDistrCusto      = $aDados[$i]['ind_distr_custo'];
            $itemContainerId    = $aDados[$i]['item_container_id'];
            $itemProcVendaId    = $aDados[$i]['item_proc_compra_id'];
            $vlTribAlocado      = $aDados[$i]['vl_trib_alocado'];
            $vlTribConfirm      = $aDados[$i]['vl_trib_confirm'];
            $vlNegAlocado       = $aDados[$i]['vl_neg_alocado'];
            $vlNegConfirm       = $aDados[$i]['vl_neg_confirm'];
            $logGeracaoCusto    = verificarGeracaoDistrCusto($container);
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
