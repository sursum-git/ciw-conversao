<?php
//
class form_pp_container_cotacoes_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $captcha_code;
   var $captcha_sent;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $sc_field_0;
   var $sc_field_1;
   var $sc_field_1_1;
   var $sc_field_2;
   var $sc_field_3;
   var $narrativa;
   var $usuario;
   var $sc_field_4;
   var $sc_field_5;
   var $sc_field_6;
   var $sc_field_7;
   var $sc_field_8;
   var $sc_field_9;
   var $sc_field_10;
   var $comprador;
   var $sc_field_11;
   var $sc_field_12;
   var $situacao;
   var $sc_field_13;
   var $sc_field_14;
   var $sc_field_15;
   var $exclusivo;
   var $sc_field_16;
   var $sc_field_17;
   var $log_liberar_custo_realizado;
   var $log_liberar_custo_realizado_1;
   var $medidas_container;
   var $dt_prev_embarque;
   var $dt_real_embarque;
   var $situacao_container_id;
   var $situacao_container_id_1;
   var $ind_dt_embarque;
   var $ind_dt_embarque_1;
   var $ind_dt_prev_chegada;
   var $ind_dt_prev_chegada_1;
   var $log_pagto_final;
   var $log_pagto_final_1;
   var $cod_agente_cargas;
   var $cod_armador;
   var $cod_tipo_calculo;
   var $cod_tipo_calculo_1;
   var $perc_custo;
   var $vl_dolar_di;
   var $log_gerar_saldo_a_pagar;
   var $log_gerar_saldo_a_pagar_1;
   var $log_gerar_distr_custo;
   var $log_gerar_distr_custo_1;
   var $cotacao_bc;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden   = array();
   var $Field_no_validate  = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['cotacao_bc']))
          {
              $this->cotacao_bc = $this->NM_ajax_info['param']['cotacao_bc'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_fields']))
          {
              $this->nmgp_refresh_fields = $this->NM_ajax_info['param']['nmgp_refresh_fields'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['sc_field_10']))
          {
              $this->sc_field_10 = $this->NM_ajax_info['param']['sc_field_10'];
          }
          if (isset($this->NM_ajax_info['param']['sc_field_16']))
          {
              $this->sc_field_16 = $this->NM_ajax_info['param']['sc_field_16'];
          }
          if (isset($this->NM_ajax_info['param']['sc_field_17']))
          {
              $this->sc_field_17 = $this->NM_ajax_info['param']['sc_field_17'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['situacao_container_id']))
          {
              $this->situacao_container_id = $this->NM_ajax_info['param']['situacao_container_id'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      $this->sc_conv_var['num-pedido'] = "sc_field_0";
      $this->sc_conv_var['cod-estabel'] = "sc_field_1";
      $this->sc_conv_var['nome-ab-forn'] = "sc_field_2";
      $this->sc_conv_var['cod-emit-forn'] = "sc_field_3";
      $this->sc_conv_var['dt-compra'] = "sc_field_4";
      $this->sc_conv_var['char-1'] = "sc_field_5";
      $this->sc_conv_var['dec-1'] = "sc_field_6";
      $this->sc_conv_var['int-1'] = "sc_field_7";
      $this->sc_conv_var['log-1'] = "sc_field_8";
      $this->sc_conv_var['data-1'] = "sc_field_9";
      $this->sc_conv_var['nr-container'] = "sc_field_10";
      $this->sc_conv_var['dt-recebimento'] = "sc_field_11";
      $this->sc_conv_var['dt-prev-chegada'] = "sc_field_12";
      $this->sc_conv_var['vlr-frete'] = "sc_field_13";
      $this->sc_conv_var['vlr-seguro'] = "sc_field_14";
      $this->sc_conv_var['vlr-despesas'] = "sc_field_15";
      $this->sc_conv_var['vl-dolar-venda'] = "sc_field_16";
      $this->sc_conv_var['vl-dolar-compra'] = "sc_field_17";
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->container_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_form_pp_container_cotacoes($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['opc_ant']);
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_pp_container_cotacoes_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_pp_container_cotacoes']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_pp_container_cotacoes']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_pp_container_cotacoes'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_pp_container_cotacoes']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_pp_container_cotacoes']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_pp_container_cotacoes') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_pp_container_cotacoes']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Container\'s";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_pp_container_cotacoes")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->Db = $this->Ini->Db; 
      $this->Ini->str_google_fonts = isset($str_google_fonts)?$str_google_fonts:'';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = '__OMITIDO_NA_COPIA_DE_ANALISE__';
      $this->Ini->Css_status_pwd_text = '__OMITIDO_NA_COPIA_DE_ANALISE__';
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';
      $this->Ini->Bubble_tail          = trim($str_bubble_tail);

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;



      $_SESSION['scriptcase']['error_icon']['form_pp_container_cotacoes']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_pp_container_cotacoes'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_orig'] = " where (\"nr-container\" = " . $_SESSION['container_corrente'] . ")";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_pesq'] = " where (\"nr-container\" = " . $_SESSION['container_corrente'] . ")";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_pp_container_cotacoes']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_pp_container_cotacoes'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_pp_container_cotacoes'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['reload']     = $tmpDashboardButtons['form_reload']    ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form'];
          if (!isset($this->sc_field_0)){$this->sc_field_0 = $this->nmgp_dados_form['sc_field_0'];} 
          if (!isset($this->sc_field_1)){$this->sc_field_1 = $this->nmgp_dados_form['sc_field_1'];} 
          if (!isset($this->sc_field_2)){$this->sc_field_2 = $this->nmgp_dados_form['sc_field_2'];} 
          if (!isset($this->sc_field_3)){$this->sc_field_3 = $this->nmgp_dados_form['sc_field_3'];} 
          if (!isset($this->narrativa)){$this->narrativa = $this->nmgp_dados_form['narrativa'];} 
          if (!isset($this->usuario)){$this->usuario = $this->nmgp_dados_form['usuario'];} 
          if (!isset($this->sc_field_4)){$this->sc_field_4 = $this->nmgp_dados_form['sc_field_4'];} 
          if (!isset($this->sc_field_5)){$this->sc_field_5 = $this->nmgp_dados_form['sc_field_5'];} 
          if (!isset($this->sc_field_6)){$this->sc_field_6 = $this->nmgp_dados_form['sc_field_6'];} 
          if (!isset($this->sc_field_7)){$this->sc_field_7 = $this->nmgp_dados_form['sc_field_7'];} 
          if (!isset($this->sc_field_8)){$this->sc_field_8 = $this->nmgp_dados_form['sc_field_8'];} 
          if (!isset($this->sc_field_9)){$this->sc_field_9 = $this->nmgp_dados_form['sc_field_9'];} 
          if (!isset($this->comprador)){$this->comprador = $this->nmgp_dados_form['comprador'];} 
          if (!isset($this->sc_field_11)){$this->sc_field_11 = $this->nmgp_dados_form['sc_field_11'];} 
          if (!isset($this->sc_field_12)){$this->sc_field_12 = $this->nmgp_dados_form['sc_field_12'];} 
          if (!isset($this->situacao)){$this->situacao = $this->nmgp_dados_form['situacao'];} 
          if (!isset($this->sc_field_13)){$this->sc_field_13 = $this->nmgp_dados_form['sc_field_13'];} 
          if (!isset($this->sc_field_14)){$this->sc_field_14 = $this->nmgp_dados_form['sc_field_14'];} 
          if (!isset($this->sc_field_15)){$this->sc_field_15 = $this->nmgp_dados_form['sc_field_15'];} 
          if (!isset($this->exclusivo)){$this->exclusivo = $this->nmgp_dados_form['exclusivo'];} 
          if (!isset($this->log_liberar_custo_realizado)){$this->log_liberar_custo_realizado = $this->nmgp_dados_form['log_liberar_custo_realizado'];} 
          if (!isset($this->medidas_container)){$this->medidas_container = $this->nmgp_dados_form['medidas_container'];} 
          if (!isset($this->dt_prev_embarque)){$this->dt_prev_embarque = $this->nmgp_dados_form['dt_prev_embarque'];} 
          if (!isset($this->dt_real_embarque)){$this->dt_real_embarque = $this->nmgp_dados_form['dt_real_embarque'];} 
          if (!isset($this->situacao_container_id)){$this->situacao_container_id = $this->nmgp_dados_form['situacao_container_id'];} 
          if (!isset($this->ind_dt_embarque)){$this->ind_dt_embarque = $this->nmgp_dados_form['ind_dt_embarque'];} 
          if (!isset($this->ind_dt_prev_chegada)){$this->ind_dt_prev_chegada = $this->nmgp_dados_form['ind_dt_prev_chegada'];} 
          if (!isset($this->log_pagto_final)){$this->log_pagto_final = $this->nmgp_dados_form['log_pagto_final'];} 
          if (!isset($this->cod_agente_cargas)){$this->cod_agente_cargas = $this->nmgp_dados_form['cod_agente_cargas'];} 
          if (!isset($this->cod_armador)){$this->cod_armador = $this->nmgp_dados_form['cod_armador'];} 
          if (!isset($this->cod_tipo_calculo)){$this->cod_tipo_calculo = $this->nmgp_dados_form['cod_tipo_calculo'];} 
          if (!isset($this->perc_custo)){$this->perc_custo = $this->nmgp_dados_form['perc_custo'];} 
          if (!isset($this->vl_dolar_di)){$this->vl_dolar_di = $this->nmgp_dados_form['vl_dolar_di'];} 
          if (!isset($this->log_gerar_saldo_a_pagar)){$this->log_gerar_saldo_a_pagar = $this->nmgp_dados_form['log_gerar_saldo_a_pagar'];} 
          if (!isset($this->log_gerar_distr_custo)){$this->log_gerar_distr_custo = $this->nmgp_dados_form['log_gerar_distr_custo'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['cotacao_bc'] != "null"){$this->cotacao_bc = $this->nmgp_dados_form['cotacao_bc'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_pp_container_cotacoes", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
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
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 

      if (is_file($this->Ini->path_aplicacao . 'form_pp_container_cotacoes_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_pp_container_cotacoes_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'form_pp_container_cotacoes/form_pp_container_cotacoes_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_pp_container_cotacoes_erro.class.php"); 
      }
      $this->Erro      = new form_pp_container_cotacoes_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao']))
         { 
             if ($this->sc_field_10 != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_pp_container_cotacoes']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_cotacao_bc = $this->cotacao_bc;
}
  $this->cotacao_bc  = $this->buscarCotacaoDolarVendaBC();
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_cotacao_bc != $this->cotacao_bc || (isset($bFlagRead_cotacao_bc) && $bFlagRead_cotacao_bc)))
    {
        $this->ajax_return_values_cotacao_bc(true);
    }
}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_pp_container_cotacoes']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_pp_container_cotacoes']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }
                $sc_obj_img->setManterAspecto(true);
            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->sc_field_10)) { $this->nm_limpa_alfa($this->sc_field_10); }
      if (isset($this->sc_field_16)) { $this->nm_limpa_alfa($this->sc_field_16); }
      if (isset($this->sc_field_17)) { $this->nm_limpa_alfa($this->sc_field_17); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- sc_field_10
      $this->field_config['sc_field_10']               = array();
      $this->field_config['sc_field_10']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sc_field_10']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sc_field_10']['symbol_dec'] = '';
      $this->field_config['sc_field_10']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sc_field_10']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_16
      $this->field_config['sc_field_16']               = array();
      $this->field_config['sc_field_16']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['sc_field_16']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['sc_field_16']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['sc_field_16']['symbol_mon'] = '';
      $this->field_config['sc_field_16']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['sc_field_16']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- sc_field_17
      $this->field_config['sc_field_17']               = array();
      $this->field_config['sc_field_17']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['sc_field_17']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['sc_field_17']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['sc_field_17']['symbol_mon'] = '';
      $this->field_config['sc_field_17']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['sc_field_17']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- cotacao_bc
      $this->field_config['cotacao_bc']               = array();
      $this->field_config['cotacao_bc']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cotacao_bc']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cotacao_bc']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['cotacao_bc']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cotacao_bc']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_0
      $this->field_config['sc_field_0']               = array();
      $this->field_config['sc_field_0']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sc_field_0']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sc_field_0']['symbol_dec'] = '';
      $this->field_config['sc_field_0']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sc_field_0']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_3
      $this->field_config['sc_field_3']               = array();
      $this->field_config['sc_field_3']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sc_field_3']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sc_field_3']['symbol_dec'] = '';
      $this->field_config['sc_field_3']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sc_field_3']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_4
      $this->field_config['sc_field_4']                 = array();
      $this->field_config['sc_field_4']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['sc_field_4']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['sc_field_4']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'sc_field_4');
      //-- sc_field_6
      $this->field_config['sc_field_6']               = array();
      $this->field_config['sc_field_6']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sc_field_6']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sc_field_6']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['sc_field_6']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sc_field_6']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_7
      $this->field_config['sc_field_7']               = array();
      $this->field_config['sc_field_7']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sc_field_7']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sc_field_7']['symbol_dec'] = '';
      $this->field_config['sc_field_7']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sc_field_7']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_9
      $this->field_config['sc_field_9']                 = array();
      $this->field_config['sc_field_9']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['sc_field_9']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['sc_field_9']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'sc_field_9');
      //-- sc_field_11
      $this->field_config['sc_field_11']                 = array();
      $this->field_config['sc_field_11']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['sc_field_11']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['sc_field_11']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'sc_field_11');
      //-- sc_field_12
      $this->field_config['sc_field_12']                 = array();
      $this->field_config['sc_field_12']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['sc_field_12']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['sc_field_12']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'sc_field_12');
      //-- situacao
      $this->field_config['situacao']               = array();
      $this->field_config['situacao']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['situacao']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['situacao']['symbol_dec'] = '';
      $this->field_config['situacao']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['situacao']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sc_field_13
      $this->field_config['sc_field_13']               = array();
      $this->field_config['sc_field_13']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['sc_field_13']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['sc_field_13']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['sc_field_13']['symbol_mon'] = '';
      $this->field_config['sc_field_13']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['sc_field_13']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- sc_field_14
      $this->field_config['sc_field_14']               = array();
      $this->field_config['sc_field_14']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['sc_field_14']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['sc_field_14']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['sc_field_14']['symbol_mon'] = '';
      $this->field_config['sc_field_14']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['sc_field_14']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- sc_field_15
      $this->field_config['sc_field_15']               = array();
      $this->field_config['sc_field_15']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['sc_field_15']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['sc_field_15']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['sc_field_15']['symbol_mon'] = '';
      $this->field_config['sc_field_15']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['sc_field_15']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- dt_prev_embarque
      $this->field_config['dt_prev_embarque']                 = array();
      $this->field_config['dt_prev_embarque']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['dt_prev_embarque']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_prev_embarque']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'dt_prev_embarque');
      //-- dt_real_embarque
      $this->field_config['dt_real_embarque']                 = array();
      $this->field_config['dt_real_embarque']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['dt_real_embarque']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_real_embarque']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'dt_real_embarque');
      //-- cod_agente_cargas
      $this->field_config['cod_agente_cargas']               = array();
      $this->field_config['cod_agente_cargas']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cod_agente_cargas']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cod_agente_cargas']['symbol_dec'] = '';
      $this->field_config['cod_agente_cargas']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cod_agente_cargas']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- cod_armador
      $this->field_config['cod_armador']               = array();
      $this->field_config['cod_armador']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cod_armador']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cod_armador']['symbol_dec'] = '';
      $this->field_config['cod_armador']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cod_armador']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- perc_custo
      $this->field_config['perc_custo']               = array();
      $this->field_config['perc_custo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['perc_custo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['perc_custo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['perc_custo']['symbol_mon'] = '';
      $this->field_config['perc_custo']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['perc_custo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- vl_dolar_di
      $this->field_config['vl_dolar_di']               = array();
      $this->field_config['vl_dolar_di']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['vl_dolar_di']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['vl_dolar_di']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['vl_dolar_di']['symbol_mon'] = '';
      $this->field_config['vl_dolar_di']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['vl_dolar_di']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['Gera_log_access'] = false;
      }

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "incluir") {
          $this->cotacao_bc = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form']['cotacao_bc'];
      if ('' !== $this->cotacao_bc || (!empty($format_fields) && isset($format_fields['cotacao_bc'])))
      {
          nmgp_Form_Num_Val($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_grp'], $this->field_config['cotacao_bc']['symbol_dec'], "5", "S", $this->field_config['cotacao_bc']['format_neg'], "", "", "-", $this->field_config['cotacao_bc']['symbol_fmt']) ; 
      }
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->cotacao_bc = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form']['cotacao_bc'];
      if ('' !== $this->cotacao_bc || (!empty($format_fields) && isset($format_fields['cotacao_bc'])))
      {
          nmgp_Form_Num_Val($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_grp'], $this->field_config['cotacao_bc']['symbol_dec'], "5", "S", $this->field_config['cotacao_bc']['format_neg'], "", "", "-", $this->field_config['cotacao_bc']['symbol_fmt']) ; 
      }
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_sc_field_10' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'sc_field_10');
          }
          if ('validate_sc_field_16' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'sc_field_16');
          }
          if ('validate_sc_field_17' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'sc_field_17');
          }
          if ('validate_cotacao_bc' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cotacao_bc');
          }
          form_pp_container_cotacoes_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select']['cotacao_bc']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->cotacao_bc = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select']['cotacao_bc'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_pp_container_cotacoes_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          if ($this->nmgp_opcao != "incluir")
          {
              $this->scFormFocusErrorName = '';
          }
          $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_pp_container_cotacoes_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, 4);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_pp_container_cotacoes_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          form_pp_container_cotacoes_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     if (parent.writeFastMenu)
     {
         parent.writeFastMenu(link_atual);
     }
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     if (parent.clearFastMenu)
     {
        parent.clearFastMenu();
     }
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != '__OMITIDO_NA_COPIA_DE_ANALISE__') ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_pp_container_cotacoes.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
           {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                }
                else
                {
                    chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                }
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           if (!empty($str_zip)) {
               exec($str_zip);
           }
           // ----- ZIP log
           $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
           if ($fp)
           {
               @fwrite($fp, $str_zip . "\r\n\r\n");
               @fclose($fp);
           }
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               if (!empty($str_zip)) {
                   exec($str_zip);
               }
               // ----- ZIP log
               $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
               if ($fp)
               {
                   @fwrite($fp, $str_zip . "\r\n\r\n");
                   @fclose($fp);
               }
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Container's") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" /> 
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="form_pp_container_cotacoes_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_pp_container_cotacoes"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="./" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
       if ($this->SC_log_atv)
       {
           $this->NM_gera_log_output();
       }
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_gera_log_insert($orig="Scriptcase", $evento="", $texto="")
   {
       $delim  = "'";
       $delim1 = "'";
       if (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_access))
       { 
           $delim  = "#";
           $delim1 = "#";
       } 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date1'];
       }
       $dt  = $delim . date('Y-m-d H:i:s') . $delim1;
       $usr = isset($_SESSION['usr_login']) ? $_SESSION['usr_login'] : "";
       if (strtolower($this->Ini->nm_con_ticontrole2['tpbanco']) == 'pdo_sqlsrv' || strtolower($this->Ini->nm_con_ticontrole2['tpbanco']) == 'pdo_dblib')
       { 
           $dt  = $delim . date('Ymd H:i:s') . $delim1;
       } 
       if (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_access))
       { 
           $dt  = $delim . date('Y-m-d H:i:s') . $delim1;
       } 
       if (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_informix))
       { 
           $dt  = "EXTEND(" . $dt . ", YEAR TO FRACTION)";
       } 
       if (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_access))
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_pp_container_cotacoes', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_pp_container_cotacoes', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_pp_container_cotacoes', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_pp_container_cotacoes_pack_ajax_response();
               exit; 
           }
       }
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
           $this->Ini->nm_db_ems5w->Close(); 
           $this->Ini->nm_db_comumw->Close(); 
           $this->Ini->nm_db_log_imp_mysql->Close(); 
           $this->Ini->nm_db_ems5->Close(); 
           $this->Ini->nm_db_espec->Close(); 
           $this->Ini->nm_db_ems2ima->Close(); 
           $this->Ini->nm_db_ems2med->Close(); 
           $this->Ini->nm_db_comum->Close(); 
           $this->Ini->nm_db_multi->Close(); 
           $this->Ini->nm_db_cfsc->Close(); 
           $this->Ini->nm_db_log_db->Close(); 
           $this->Ini->nm_db_ticontrole2->Close(); 
           $this->Ini->nm_db_ima->Close(); 
           $this->Ini->nm_db_med->Close(); 
           $this->Ini->nm_db_geral->Close(); 
           $this->Ini->nm_db_dinamico->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'sc_field_10':
               return "Nr.Container";
               break;
           case 'sc_field_16':
               return "Vl Dolar Venda";
               break;
           case 'sc_field_17':
               return "Vl Dolar Compra";
               break;
           case 'cotacao_bc':
               return "Cotação Dólar  BC";
               break;
           case 'sc_field_0':
               return "Num Pedido";
               break;
           case 'sc_field_1':
               return "Estab.";
               break;
           case 'sc_field_2':
               return "Nome Ab Forn";
               break;
           case 'sc_field_3':
               return "Fornecedor";
               break;
           case 'narrativa':
               return "Narrativa";
               break;
           case 'usuario':
               return "Usuario";
               break;
           case 'sc_field_4':
               return "Dt Compra";
               break;
           case 'sc_field_5':
               return "Char 1";
               break;
           case 'sc_field_6':
               return "Vl.Dolar Venda";
               break;
           case 'sc_field_7':
               return "Int 1";
               break;
           case 'sc_field_8':
               return "Log 1";
               break;
           case 'sc_field_9':
               return "Data 1";
               break;
           case 'comprador':
               return "Comprador";
               break;
           case 'sc_field_11':
               return "Dt Recebimento";
               break;
           case 'sc_field_12':
               return "Dt Prev Chegada";
               break;
           case 'situacao':
               return "Situação ERP";
               break;
           case 'sc_field_13':
               return "Vlr Frete";
               break;
           case 'sc_field_14':
               return "Vlr Seguro";
               break;
           case 'sc_field_15':
               return "Vlr Despesas";
               break;
           case 'exclusivo':
               return "Exclusivo";
               break;
           case 'log_liberar_custo_realizado':
               return "Liberar Custo Realizado?";
               break;
           case 'medidas_container':
               return "Medidas Container";
               break;
           case 'dt_prev_embarque':
               return "Dt. Prev. Embarque";
               break;
           case 'dt_real_embarque':
               return "Dt Real Embarque";
               break;
           case 'situacao_container_id':
               return "Situação Acompanhamento";
               break;
           case 'ind_dt_embarque':
               return "SIt.Dt.Embarque";
               break;
           case 'ind_dt_prev_chegada':
               return "Sit.Dt.Prev.Chegada";
               break;
           case 'log_pagto_final':
               return "Pagto Final Realizado?";
               break;
           case 'cod_agente_cargas':
               return "Agente Cargas";
               break;
           case 'cod_armador':
               return "Armador";
               break;
           case 'cod_tipo_calculo':
               return "Tipo Cálculo";
               break;
           case 'perc_custo':
               return "% Custo";
               break;
           case 'vl_dolar_di':
               return "Vl.Dolar DI";
               break;
           case 'log_gerar_saldo_a_pagar':
               return "Gerar Saldo A Pagar?";
               break;
           case 'log_gerar_distr_custo':
               return "Gerar Distr. Custo?";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->scFormFocusErrorName = '';
     $this->sc_force_zero = array();
      if ((!is_array($filtro) && ('' == $filtro || 'sc_field_10' == $filtro)) || (is_array($filtro) && in_array('sc_field_10', $filtro)))
        $this->ValidateField_sc_field_10($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "sc_field_10";

      if ((!is_array($filtro) && ('' == $filtro || 'sc_field_16' == $filtro)) || (is_array($filtro) && in_array('sc_field_16', $filtro)))
        $this->ValidateField_sc_field_16($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "sc_field_16";

      if ((!is_array($filtro) && ('' == $filtro || 'sc_field_17' == $filtro)) || (is_array($filtro) && in_array('sc_field_17', $filtro)))
        $this->ValidateField_sc_field_17($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "sc_field_17";

      if ((!is_array($filtro) && ('' == $filtro || 'cotacao_bc' == $filtro)) || (is_array($filtro) && in_array('cotacao_bc', $filtro)))
        $this->ValidateField_cotacao_bc($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cotacao_bc";

      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_sc_field_10(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['sc_field_10'])) {
          nm_limpa_numero($this->sc_field_10, $this->field_config['sc_field_10']['symbol_grp']) ; 
          return;
      }
      nm_limpa_numero($this->sc_field_10, $this->field_config['sc_field_10']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_sc_field_10' == $this->NM_ajax_opcao)
      { 
          if ($this->sc_field_10 != '')  
          { 
              $iTestSize = 6;
              if (strlen($this->sc_field_10) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nr.Container: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['sc_field_10']))
                  {
                      $Campos_Erros['sc_field_10'] = array();
                  }
                  $Campos_Erros['sc_field_10'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['sc_field_10']) || !is_array($this->NM_ajax_info['errList']['sc_field_10']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_10'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_10'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->sc_field_10, 6, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nr.Container; " ; 
                  if (!isset($Campos_Erros['sc_field_10']))
                  {
                      $Campos_Erros['sc_field_10'] = array();
                  }
                  $Campos_Erros['sc_field_10'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['sc_field_10']) || !is_array($this->NM_ajax_info['errList']['sc_field_10']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_10'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_10'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['php_cmp_required']['sc_field_10']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['php_cmp_required']['sc_field_10'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Nr.Container" ; 
              if (!isset($Campos_Erros['sc_field_10']))
              {
                  $Campos_Erros['sc_field_10'] = array();
              }
              $Campos_Erros['sc_field_10'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['sc_field_10']) || !is_array($this->NM_ajax_info['errList']['sc_field_10']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_10'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_10'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'sc_field_10';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_sc_field_10

    function ValidateField_sc_field_16(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['sc_field_16'])) {
          if (!empty($this->field_config['sc_field_16']['symbol_dec'])) {
              $this->sc_remove_currency($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp'], $this->field_config['sc_field_16']['symbol_mon']); 
              nm_limpa_valor($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->sc_field_16 === "" || is_null($this->sc_field_16))  
      { 
          $this->sc_field_16 = 0;
          $this->sc_force_zero[] = 'sc_field_16';
      } 
      if (!empty($this->field_config['sc_field_16']['symbol_dec']))
      {
          $this->sc_remove_currency($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp'], $this->field_config['sc_field_16']['symbol_mon']); 
          nm_limpa_valor($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp']) ; 
          if ('.' == substr($this->sc_field_16, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->sc_field_16, 1)))
              {
                  $this->sc_field_16 = '';
              }
              else
              {
                  $this->sc_field_16 = '0' . $this->sc_field_16;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->sc_field_16 != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->sc_field_16) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl Dolar Venda: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['sc_field_16']))
                  {
                      $Campos_Erros['sc_field_16'] = array();
                  }
                  $Campos_Erros['sc_field_16'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['sc_field_16']) || !is_array($this->NM_ajax_info['errList']['sc_field_16']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_16'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_16'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->sc_field_16, 14, 5, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl Dolar Venda; " ; 
                  if (!isset($Campos_Erros['sc_field_16']))
                  {
                      $Campos_Erros['sc_field_16'] = array();
                  }
                  $Campos_Erros['sc_field_16'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['sc_field_16']) || !is_array($this->NM_ajax_info['errList']['sc_field_16']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_16'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_16'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'sc_field_16';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_sc_field_16

    function ValidateField_sc_field_17(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['sc_field_17'])) {
          if (!empty($this->field_config['sc_field_17']['symbol_dec'])) {
              $this->sc_remove_currency($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp'], $this->field_config['sc_field_17']['symbol_mon']); 
              nm_limpa_valor($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->sc_field_17 === "" || is_null($this->sc_field_17))  
      { 
          $this->sc_field_17 = 0;
          $this->sc_force_zero[] = 'sc_field_17';
      } 
      if (!empty($this->field_config['sc_field_17']['symbol_dec']))
      {
          $this->sc_remove_currency($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp'], $this->field_config['sc_field_17']['symbol_mon']); 
          nm_limpa_valor($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp']) ; 
          if ('.' == substr($this->sc_field_17, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->sc_field_17, 1)))
              {
                  $this->sc_field_17 = '';
              }
              else
              {
                  $this->sc_field_17 = '0' . $this->sc_field_17;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->sc_field_17 != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->sc_field_17) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl Dolar Compra: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['sc_field_17']))
                  {
                      $Campos_Erros['sc_field_17'] = array();
                  }
                  $Campos_Erros['sc_field_17'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['sc_field_17']) || !is_array($this->NM_ajax_info['errList']['sc_field_17']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_17'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_17'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->sc_field_17, 14, 5, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl Dolar Compra; " ; 
                  if (!isset($Campos_Erros['sc_field_17']))
                  {
                      $Campos_Erros['sc_field_17'] = array();
                  }
                  $Campos_Erros['sc_field_17'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['sc_field_17']) || !is_array($this->NM_ajax_info['errList']['sc_field_17']))
                  {
                      $this->NM_ajax_info['errList']['sc_field_17'] = array();
                  }
                  $this->NM_ajax_info['errList']['sc_field_17'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'sc_field_17';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_sc_field_17

    function ValidateField_cotacao_bc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cotacao_bc'])) {
          if (!empty($this->field_config['cotacao_bc']['symbol_dec'])) {
              nm_limpa_valor($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_dec'], $this->field_config['cotacao_bc']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->cotacao_bc === "" || is_null($this->cotacao_bc))  
      { 
          $this->cotacao_bc = 0;
          $this->sc_force_zero[] = 'cotacao_bc';
      } 
      if (!empty($this->field_config['cotacao_bc']['symbol_dec']))
      {
          nm_limpa_valor($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_dec'], $this->field_config['cotacao_bc']['symbol_grp']) ; 
          if ('.' == substr($this->cotacao_bc, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->cotacao_bc, 1)))
              {
                  $this->cotacao_bc = '';
              }
              else
              {
                  $this->cotacao_bc = '0' . $this->cotacao_bc;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->cotacao_bc != '')  
          { 
              $iTestSize = 21;
              if (strlen($this->cotacao_bc) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cotação Dólar  BC: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['cotacao_bc']))
                  {
                      $Campos_Erros['cotacao_bc'] = array();
                  }
                  $Campos_Erros['cotacao_bc'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['cotacao_bc']) || !is_array($this->NM_ajax_info['errList']['cotacao_bc']))
                  {
                      $this->NM_ajax_info['errList']['cotacao_bc'] = array();
                  }
                  $this->NM_ajax_info['errList']['cotacao_bc'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->cotacao_bc, 15, 5, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cotação Dólar  BC; " ; 
                  if (!isset($Campos_Erros['cotacao_bc']))
                  {
                      $Campos_Erros['cotacao_bc'] = array();
                  }
                  $Campos_Erros['cotacao_bc'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['cotacao_bc']) || !is_array($this->NM_ajax_info['errList']['cotacao_bc']))
                  {
                      $this->NM_ajax_info['errList']['cotacao_bc'] = array();
                  }
                  $this->NM_ajax_info['errList']['cotacao_bc'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cotacao_bc';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cotacao_bc

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['sc_field_10'] = $this->sc_field_10;
    $this->nmgp_dados_form['sc_field_16'] = $this->sc_field_16;
    $this->nmgp_dados_form['sc_field_17'] = $this->sc_field_17;
    $this->nmgp_dados_form['cotacao_bc'] = $this->cotacao_bc;
    $this->nmgp_dados_form['sc_field_0'] = $this->sc_field_0;
    $this->nmgp_dados_form['sc_field_1'] = $this->sc_field_1;
    $this->nmgp_dados_form['sc_field_2'] = $this->sc_field_2;
    $this->nmgp_dados_form['sc_field_3'] = $this->sc_field_3;
    $this->nmgp_dados_form['narrativa'] = $this->narrativa;
    $this->nmgp_dados_form['usuario'] = $this->usuario;
    $this->nmgp_dados_form['sc_field_4'] = $this->sc_field_4;
    $this->nmgp_dados_form['sc_field_5'] = $this->sc_field_5;
    $this->nmgp_dados_form['sc_field_6'] = $this->sc_field_6;
    $this->nmgp_dados_form['sc_field_7'] = $this->sc_field_7;
    $this->nmgp_dados_form['sc_field_8'] = $this->sc_field_8;
    $this->nmgp_dados_form['sc_field_9'] = $this->sc_field_9;
    $this->nmgp_dados_form['comprador'] = $this->comprador;
    $this->nmgp_dados_form['sc_field_11'] = $this->sc_field_11;
    $this->nmgp_dados_form['sc_field_12'] = $this->sc_field_12;
    $this->nmgp_dados_form['situacao'] = $this->situacao;
    $this->nmgp_dados_form['sc_field_13'] = $this->sc_field_13;
    $this->nmgp_dados_form['sc_field_14'] = $this->sc_field_14;
    $this->nmgp_dados_form['sc_field_15'] = $this->sc_field_15;
    $this->nmgp_dados_form['exclusivo'] = $this->exclusivo;
    $this->nmgp_dados_form['log_liberar_custo_realizado'] = $this->log_liberar_custo_realizado;
    $this->nmgp_dados_form['medidas_container'] = $this->medidas_container;
    $this->nmgp_dados_form['dt_prev_embarque'] = $this->dt_prev_embarque;
    $this->nmgp_dados_form['dt_real_embarque'] = $this->dt_real_embarque;
    $this->nmgp_dados_form['situacao_container_id'] = $this->situacao_container_id;
    $this->nmgp_dados_form['ind_dt_embarque'] = $this->ind_dt_embarque;
    $this->nmgp_dados_form['ind_dt_prev_chegada'] = $this->ind_dt_prev_chegada;
    $this->nmgp_dados_form['log_pagto_final'] = $this->log_pagto_final;
    $this->nmgp_dados_form['cod_agente_cargas'] = $this->cod_agente_cargas;
    $this->nmgp_dados_form['cod_armador'] = $this->cod_armador;
    $this->nmgp_dados_form['cod_tipo_calculo'] = $this->cod_tipo_calculo;
    $this->nmgp_dados_form['perc_custo'] = $this->perc_custo;
    $this->nmgp_dados_form['vl_dolar_di'] = $this->vl_dolar_di;
    $this->nmgp_dados_form['log_gerar_saldo_a_pagar'] = $this->log_gerar_saldo_a_pagar;
    $this->nmgp_dados_form['log_gerar_distr_custo'] = $this->log_gerar_distr_custo;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['sc_field_10'] = $this->sc_field_10;
      nm_limpa_numero($this->sc_field_10, $this->field_config['sc_field_10']['symbol_grp']) ; 
      $this->Before_unformat['sc_field_16'] = $this->sc_field_16;
      if (!empty($this->field_config['sc_field_16']['symbol_dec']))
      {
         $this->sc_remove_currency($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp'], $this->field_config['sc_field_16']['symbol_mon']);
         nm_limpa_valor($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp']);
      }
      $this->Before_unformat['sc_field_17'] = $this->sc_field_17;
      if (!empty($this->field_config['sc_field_17']['symbol_dec']))
      {
         $this->sc_remove_currency($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp'], $this->field_config['sc_field_17']['symbol_mon']);
         nm_limpa_valor($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp']);
      }
      $this->Before_unformat['cotacao_bc'] = $this->cotacao_bc;
      if (!empty($this->field_config['cotacao_bc']['symbol_dec']))
      {
         nm_limpa_valor($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_dec'], $this->field_config['cotacao_bc']['symbol_grp']);
      }
      $this->Before_unformat['sc_field_0'] = $this->sc_field_0;
      nm_limpa_numero($this->sc_field_0, $this->field_config['sc_field_0']['symbol_grp']) ; 
      $this->Before_unformat['sc_field_3'] = $this->sc_field_3;
      nm_limpa_numero($this->sc_field_3, $this->field_config['sc_field_3']['symbol_grp']) ; 
      $this->Before_unformat['sc_field_4'] = $this->sc_field_4;
      nm_limpa_data($this->sc_field_4, $this->field_config['sc_field_4']['date_sep']) ; 
      $this->Before_unformat['sc_field_6'] = $this->sc_field_6;
      if (!empty($this->field_config['sc_field_6']['symbol_dec']))
      {
         nm_limpa_valor($this->sc_field_6, $this->field_config['sc_field_6']['symbol_dec'], $this->field_config['sc_field_6']['symbol_grp']);
      }
      $this->Before_unformat['sc_field_7'] = $this->sc_field_7;
      nm_limpa_numero($this->sc_field_7, $this->field_config['sc_field_7']['symbol_grp']) ; 
      $this->Before_unformat['sc_field_9'] = $this->sc_field_9;
      nm_limpa_data($this->sc_field_9, $this->field_config['sc_field_9']['date_sep']) ; 
      $this->Before_unformat['sc_field_11'] = $this->sc_field_11;
      nm_limpa_data($this->sc_field_11, $this->field_config['sc_field_11']['date_sep']) ; 
      $this->Before_unformat['sc_field_12'] = $this->sc_field_12;
      nm_limpa_data($this->sc_field_12, $this->field_config['sc_field_12']['date_sep']) ; 
      $this->Before_unformat['situacao'] = $this->situacao;
      nm_limpa_numero($this->situacao, $this->field_config['situacao']['symbol_grp']) ; 
      $this->Before_unformat['sc_field_13'] = $this->sc_field_13;
      if (!empty($this->field_config['sc_field_13']['symbol_dec']))
      {
         $this->sc_remove_currency($this->sc_field_13, $this->field_config['sc_field_13']['symbol_dec'], $this->field_config['sc_field_13']['symbol_grp'], $this->field_config['sc_field_13']['symbol_mon']);
         nm_limpa_valor($this->sc_field_13, $this->field_config['sc_field_13']['symbol_dec'], $this->field_config['sc_field_13']['symbol_grp']);
      }
      $this->Before_unformat['sc_field_14'] = $this->sc_field_14;
      if (!empty($this->field_config['sc_field_14']['symbol_dec']))
      {
         $this->sc_remove_currency($this->sc_field_14, $this->field_config['sc_field_14']['symbol_dec'], $this->field_config['sc_field_14']['symbol_grp'], $this->field_config['sc_field_14']['symbol_mon']);
         nm_limpa_valor($this->sc_field_14, $this->field_config['sc_field_14']['symbol_dec'], $this->field_config['sc_field_14']['symbol_grp']);
      }
      $this->Before_unformat['sc_field_15'] = $this->sc_field_15;
      if (!empty($this->field_config['sc_field_15']['symbol_dec']))
      {
         $this->sc_remove_currency($this->sc_field_15, $this->field_config['sc_field_15']['symbol_dec'], $this->field_config['sc_field_15']['symbol_grp'], $this->field_config['sc_field_15']['symbol_mon']);
         nm_limpa_valor($this->sc_field_15, $this->field_config['sc_field_15']['symbol_dec'], $this->field_config['sc_field_15']['symbol_grp']);
      }
      $this->Before_unformat['dt_prev_embarque'] = $this->dt_prev_embarque;
      nm_limpa_data($this->dt_prev_embarque, $this->field_config['dt_prev_embarque']['date_sep']) ; 
      $this->Before_unformat['dt_real_embarque'] = $this->dt_real_embarque;
      nm_limpa_data($this->dt_real_embarque, $this->field_config['dt_real_embarque']['date_sep']) ; 
      $this->Before_unformat['cod_agente_cargas'] = $this->cod_agente_cargas;
      nm_limpa_numero($this->cod_agente_cargas, $this->field_config['cod_agente_cargas']['symbol_grp']) ; 
      $this->Before_unformat['cod_armador'] = $this->cod_armador;
      nm_limpa_numero($this->cod_armador, $this->field_config['cod_armador']['symbol_grp']) ; 
      $this->Before_unformat['perc_custo'] = $this->perc_custo;
      if (!empty($this->field_config['perc_custo']['symbol_dec']))
      {
         $this->sc_remove_currency($this->perc_custo, $this->field_config['perc_custo']['symbol_dec'], $this->field_config['perc_custo']['symbol_grp'], $this->field_config['perc_custo']['symbol_mon']);
         nm_limpa_valor($this->perc_custo, $this->field_config['perc_custo']['symbol_dec'], $this->field_config['perc_custo']['symbol_grp']);
      }
      $this->Before_unformat['vl_dolar_di'] = $this->vl_dolar_di;
      if (!empty($this->field_config['vl_dolar_di']['symbol_dec']))
      {
         $this->sc_remove_currency($this->vl_dolar_di, $this->field_config['vl_dolar_di']['symbol_dec'], $this->field_config['vl_dolar_di']['symbol_grp'], $this->field_config['vl_dolar_di']['symbol_mon']);
         nm_limpa_valor($this->vl_dolar_di, $this->field_config['vl_dolar_di']['symbol_dec'], $this->field_config['vl_dolar_di']['symbol_grp']);
      }
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "sc_field_10")
      {
          nm_limpa_numero($this->sc_field_10, $this->field_config['sc_field_10']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "sc_field_16")
      {
          if (!empty($this->field_config['sc_field_16']['symbol_dec']))
          {
             $this->sc_remove_currency($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp'], $this->field_config['sc_field_16']['symbol_mon']);
             nm_limpa_valor($this->sc_field_16, $this->field_config['sc_field_16']['symbol_dec'], $this->field_config['sc_field_16']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "sc_field_17")
      {
          if (!empty($this->field_config['sc_field_17']['symbol_dec']))
          {
             $this->sc_remove_currency($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp'], $this->field_config['sc_field_17']['symbol_mon']);
             nm_limpa_valor($this->sc_field_17, $this->field_config['sc_field_17']['symbol_dec'], $this->field_config['sc_field_17']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "cotacao_bc")
      {
          if (!empty($this->field_config['cotacao_bc']['symbol_dec']))
          {
             nm_limpa_valor($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_dec'], $this->field_config['cotacao_bc']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "sc_field_0")
      {
          nm_limpa_numero($this->sc_field_0, $this->field_config['sc_field_0']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "sc_field_3")
      {
          nm_limpa_numero($this->sc_field_3, $this->field_config['sc_field_3']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "sc_field_6")
      {
          if (!empty($this->field_config['sc_field_6']['symbol_dec']))
          {
             nm_limpa_valor($this->sc_field_6, $this->field_config['sc_field_6']['symbol_dec'], $this->field_config['sc_field_6']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "sc_field_7")
      {
          nm_limpa_numero($this->sc_field_7, $this->field_config['sc_field_7']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "situacao")
      {
          nm_limpa_numero($this->situacao, $this->field_config['situacao']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "sc_field_13")
      {
          if (!empty($this->field_config['sc_field_13']['symbol_dec']))
          {
             $this->sc_remove_currency($this->sc_field_13, $this->field_config['sc_field_13']['symbol_dec'], $this->field_config['sc_field_13']['symbol_grp'], $this->field_config['sc_field_13']['symbol_mon']);
             nm_limpa_valor($this->sc_field_13, $this->field_config['sc_field_13']['symbol_dec'], $this->field_config['sc_field_13']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "sc_field_14")
      {
          if (!empty($this->field_config['sc_field_14']['symbol_dec']))
          {
             $this->sc_remove_currency($this->sc_field_14, $this->field_config['sc_field_14']['symbol_dec'], $this->field_config['sc_field_14']['symbol_grp'], $this->field_config['sc_field_14']['symbol_mon']);
             nm_limpa_valor($this->sc_field_14, $this->field_config['sc_field_14']['symbol_dec'], $this->field_config['sc_field_14']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "sc_field_15")
      {
          if (!empty($this->field_config['sc_field_15']['symbol_dec']))
          {
             $this->sc_remove_currency($this->sc_field_15, $this->field_config['sc_field_15']['symbol_dec'], $this->field_config['sc_field_15']['symbol_grp'], $this->field_config['sc_field_15']['symbol_mon']);
             nm_limpa_valor($this->sc_field_15, $this->field_config['sc_field_15']['symbol_dec'], $this->field_config['sc_field_15']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "cod_agente_cargas")
      {
          nm_limpa_numero($this->cod_agente_cargas, $this->field_config['cod_agente_cargas']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "cod_armador")
      {
          nm_limpa_numero($this->cod_armador, $this->field_config['cod_armador']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "perc_custo")
      {
          if (!empty($this->field_config['perc_custo']['symbol_dec']))
          {
             $this->sc_remove_currency($this->perc_custo, $this->field_config['perc_custo']['symbol_dec'], $this->field_config['perc_custo']['symbol_grp'], $this->field_config['perc_custo']['symbol_mon']);
             nm_limpa_valor($this->perc_custo, $this->field_config['perc_custo']['symbol_dec'], $this->field_config['perc_custo']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "vl_dolar_di")
      {
          if (!empty($this->field_config['vl_dolar_di']['symbol_dec']))
          {
             $this->sc_remove_currency($this->vl_dolar_di, $this->field_config['vl_dolar_di']['symbol_dec'], $this->field_config['vl_dolar_di']['symbol_grp'], $this->field_config['vl_dolar_di']['symbol_mon']);
             nm_limpa_valor($this->vl_dolar_di, $this->field_config['vl_dolar_di']['symbol_dec'], $this->field_config['vl_dolar_di']['symbol_grp']);
          }
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ('' !== $this->sc_field_10 || (!empty($format_fields) && isset($format_fields['sc_field_10'])))
      {
          nmgp_Form_Num_Val($this->sc_field_10, $this->field_config['sc_field_10']['symbol_grp'], $this->field_config['sc_field_10']['symbol_dec'], "0", "S", $this->field_config['sc_field_10']['format_neg'], "", "", "-", $this->field_config['sc_field_10']['symbol_fmt']) ; 
      }
      if ('' !== $this->sc_field_16 || (!empty($format_fields) && isset($format_fields['sc_field_16'])))
      {
          nmgp_Form_Num_Val($this->sc_field_16, $this->field_config['sc_field_16']['symbol_grp'], $this->field_config['sc_field_16']['symbol_dec'], "5", "S", $this->field_config['sc_field_16']['format_neg'], "", "", "-", $this->field_config['sc_field_16']['symbol_fmt']) ; 
      }
      if ('' !== $this->sc_field_17 || (!empty($format_fields) && isset($format_fields['sc_field_17'])))
      {
          nmgp_Form_Num_Val($this->sc_field_17, $this->field_config['sc_field_17']['symbol_grp'], $this->field_config['sc_field_17']['symbol_dec'], "5", "S", $this->field_config['sc_field_17']['format_neg'], "", "", "-", $this->field_config['sc_field_17']['symbol_fmt']) ; 
      }
      if ('' !== $this->cotacao_bc || (!empty($format_fields) && isset($format_fields['cotacao_bc'])))
      {
          nmgp_Form_Num_Val($this->cotacao_bc, $this->field_config['cotacao_bc']['symbol_grp'], $this->field_config['cotacao_bc']['symbol_dec'], "5", "S", $this->field_config['cotacao_bc']['format_neg'], "", "", "-", $this->field_config['cotacao_bc']['symbol_fmt']) ; 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
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
          $nm_campo = $trab_saida;
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
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
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
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_sc_field_10();
          $this->ajax_return_values_sc_field_16();
          $this->ajax_return_values_sc_field_17();
          $this->ajax_return_values_cotacao_bc();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['sc_field_10']['keyVal'] = form_pp_container_cotacoes_pack_protect_string($this->nmgp_dados_form['sc_field_10']);
          }
   } // ajax_return_values

          //----- sc_field_10
   function ajax_return_values_sc_field_10($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("sc_field_10", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->sc_field_10);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['sc_field_10'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("sc_field_10", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- sc_field_16
   function ajax_return_values_sc_field_16($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("sc_field_16", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->sc_field_16);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['sc_field_16'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- sc_field_17
   function ajax_return_values_sc_field_17($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("sc_field_17", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->sc_field_17);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['sc_field_17'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cotacao_bc
   function ajax_return_values_cotacao_bc($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cotacao_bc", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cotacao_bc);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cotacao_bc'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['upload_dir'][$fieldName][] = $newName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['Field_no_validate'] = array();
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->sc_field_16 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_16); 
      $this->sc_field_17 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_17); 
      $this->cotacao_bc = str_replace($sc_parm1, $sc_parm2, $this->cotacao_bc); 
      $this->sc_field_6 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_6); 
      $this->sc_field_13 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_13); 
      $this->sc_field_14 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_14); 
      $this->sc_field_15 = str_replace($sc_parm1, $sc_parm2, $this->sc_field_15); 
      $this->perc_custo = str_replace($sc_parm1, $sc_parm2, $this->perc_custo); 
      $this->vl_dolar_di = str_replace($sc_parm1, $sc_parm2, $this->vl_dolar_di); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->sc_field_16 = "'" . $this->sc_field_16 . "'";
      $this->sc_field_17 = "'" . $this->sc_field_17 . "'";
      $this->cotacao_bc = "'" . $this->cotacao_bc . "'";
      $this->sc_field_6 = "'" . $this->sc_field_6 . "'";
      $this->sc_field_13 = "'" . $this->sc_field_13 . "'";
      $this->sc_field_14 = "'" . $this->sc_field_14 . "'";
      $this->sc_field_15 = "'" . $this->sc_field_15 . "'";
      $this->perc_custo = "'" . $this->perc_custo . "'";
      $this->vl_dolar_di = "'" . $this->vl_dolar_di . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->sc_field_16 = str_replace("'", "", $this->sc_field_16); 
      $this->sc_field_17 = str_replace("'", "", $this->sc_field_17); 
      $this->cotacao_bc = str_replace("'", "", $this->cotacao_bc); 
      $this->sc_field_6 = str_replace("'", "", $this->sc_field_6); 
      $this->sc_field_13 = str_replace("'", "", $this->sc_field_13); 
      $this->sc_field_14 = str_replace("'", "", $this->sc_field_14); 
      $this->sc_field_15 = str_replace("'", "", $this->sc_field_15); 
      $this->perc_custo = str_replace("'", "", $this->perc_custo); 
      $this->vl_dolar_di = str_replace("'", "", $this->vl_dolar_di); 
   } 
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }

   function restore_zeros_null()
   {
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($this->NM_val_null))
      {
          foreach ($this->NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
      $this->NM_val_null = array();
   }

   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->SC_log_atv = false;
      if ("alterar" == $this->nmgp_opcao || "excluir" == $this->nmgp_opcao)
      {
          $this->NM_gera_log_key($this->nmgp_opcao);
      }
      if ("alterar" == $this->nmgp_opcao || "excluir" == $this->nmgp_opcao)
      {
          $this->NM_gera_log_old();
      }
      $this->restore_zeros_null();
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_sc_field_10 = $this->sc_field_10;
}
              /* PUB."pp-it-container" */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.\"pp-it-container\" WHERE \"nr-container\" = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.\"pp-it-container\" WHERE \"nr-container\" = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.\"pp-it-container\" WHERE \"nr-container\" = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.\"pp-it-container\" WHERE \"nr-container\" = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.\"pp-it-container\" WHERE \"nr-container\" = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.pp_container_permissao */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_permissao WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_permissao WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_permissao WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_permissao WHERE nr_container = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_permissao WHERE nr_container = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.pp_container_saldo_repres */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_saldo_repres WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_saldo_repres WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_saldo_repres WHERE nr_container = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_saldo_repres WHERE nr_container = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pp_container_saldo_repres WHERE nr_container = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.itens_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.despesas_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.despesas_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.despesas_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.despesas_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.despesas_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.despesas_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.nfs_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.nfs_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.nfs_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.nfs_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.nfs_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.nfs_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.cta_corren_desconto */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.cta_corren_desconto WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.cta_corren_desconto WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.cta_corren_desconto WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.cta_corren_desconto WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.cta_corren_desconto WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.anexos_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.calcs_imp_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.calcs_imp_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.calcs_imp_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.calcs_imp_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.calcs_imp_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.calcs_imp_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.versoes_item_custo_container */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.versoes_item_custo_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.versoes_item_custo_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.versoes_item_custo_container WHERE container_id = " . $this->sc_field_10 ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.versoes_item_custo_container WHERE container_id = " . $this->sc_field_10 ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.versoes_item_custo_container WHERE container_id = " . $this->sc_field_10 ;
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_sc_field_10 != $this->sc_field_10 || (isset($bFlagRead_sc_field_10) && $bFlagRead_sc_field_10)))
    {
        $this->ajax_return_values_sc_field_10(true);
    }
}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      if ('incluir' == $this->nmgp_opcao && empty($this->situacao)) {$this->situacao = "1"; $this->sc_force_zero[] = "situacao";}  
      $NM_val_form['sc_field_10'] = $this->sc_field_10;
      $NM_val_form['sc_field_16'] = $this->sc_field_16;
      $NM_val_form['sc_field_17'] = $this->sc_field_17;
      $NM_val_form['cotacao_bc'] = $this->cotacao_bc;
      $NM_val_form['sc_field_0'] = $this->sc_field_0;
      $NM_val_form['sc_field_1'] = $this->sc_field_1;
      $NM_val_form['sc_field_2'] = $this->sc_field_2;
      $NM_val_form['sc_field_3'] = $this->sc_field_3;
      $NM_val_form['narrativa'] = $this->narrativa;
      $NM_val_form['usuario'] = $this->usuario;
      $NM_val_form['sc_field_4'] = $this->sc_field_4;
      $NM_val_form['sc_field_5'] = $this->sc_field_5;
      $NM_val_form['sc_field_6'] = $this->sc_field_6;
      $NM_val_form['sc_field_7'] = $this->sc_field_7;
      $NM_val_form['sc_field_8'] = $this->sc_field_8;
      $NM_val_form['sc_field_9'] = $this->sc_field_9;
      $NM_val_form['comprador'] = $this->comprador;
      $NM_val_form['sc_field_11'] = $this->sc_field_11;
      $NM_val_form['sc_field_12'] = $this->sc_field_12;
      $NM_val_form['situacao'] = $this->situacao;
      $NM_val_form['sc_field_13'] = $this->sc_field_13;
      $NM_val_form['sc_field_14'] = $this->sc_field_14;
      $NM_val_form['sc_field_15'] = $this->sc_field_15;
      $NM_val_form['exclusivo'] = $this->exclusivo;
      $NM_val_form['log_liberar_custo_realizado'] = $this->log_liberar_custo_realizado;
      $NM_val_form['medidas_container'] = $this->medidas_container;
      $NM_val_form['dt_prev_embarque'] = $this->dt_prev_embarque;
      $NM_val_form['dt_real_embarque'] = $this->dt_real_embarque;
      $NM_val_form['situacao_container_id'] = $this->situacao_container_id;
      $NM_val_form['ind_dt_embarque'] = $this->ind_dt_embarque;
      $NM_val_form['ind_dt_prev_chegada'] = $this->ind_dt_prev_chegada;
      $NM_val_form['log_pagto_final'] = $this->log_pagto_final;
      $NM_val_form['cod_agente_cargas'] = $this->cod_agente_cargas;
      $NM_val_form['cod_armador'] = $this->cod_armador;
      $NM_val_form['cod_tipo_calculo'] = $this->cod_tipo_calculo;
      $NM_val_form['perc_custo'] = $this->perc_custo;
      $NM_val_form['vl_dolar_di'] = $this->vl_dolar_di;
      $NM_val_form['log_gerar_saldo_a_pagar'] = $this->log_gerar_saldo_a_pagar;
      $NM_val_form['log_gerar_distr_custo'] = $this->log_gerar_distr_custo;
      if ($this->sc_field_0 === "" || is_null($this->sc_field_0))  
      { 
          $this->sc_field_0 = 0;
          $this->sc_force_zero[] = 'sc_field_0';
      } 
      if ($this->sc_field_3 === "" || is_null($this->sc_field_3))  
      { 
          $this->sc_field_3 = 0;
          $this->sc_force_zero[] = 'sc_field_3';
      } 
      if ($this->sc_field_6 === "" || is_null($this->sc_field_6))  
      { 
          $this->sc_field_6 = 0;
          $this->sc_force_zero[] = 'sc_field_6';
      } 
      if ($this->sc_field_7 === "" || is_null($this->sc_field_7))  
      { 
          $this->sc_field_7 = 0;
          $this->sc_force_zero[] = 'sc_field_7';
      } 
      if ($this->sc_field_8 === "" || is_null($this->sc_field_8))  
      { 
          $this->sc_field_8 = 0;
          $this->sc_force_zero[] = 'sc_field_8';
      } 
      if ($this->sc_field_10 === "" || is_null($this->sc_field_10))  
      { 
          $this->sc_field_10 = 0;
      } 
      if ($this->situacao === "" || is_null($this->situacao))  
      { 
          $this->situacao = 0;
          $this->sc_force_zero[] = 'situacao';
      } 
      if ($this->sc_field_13 === "" || is_null($this->sc_field_13))  
      { 
          $this->sc_field_13 = 0;
          $this->sc_force_zero[] = 'sc_field_13';
      } 
      if ($this->sc_field_14 === "" || is_null($this->sc_field_14))  
      { 
          $this->sc_field_14 = 0;
          $this->sc_force_zero[] = 'sc_field_14';
      } 
      if ($this->sc_field_15 === "" || is_null($this->sc_field_15))  
      { 
          $this->sc_field_15 = 0;
          $this->sc_force_zero[] = 'sc_field_15';
      } 
      if ($this->exclusivo === "" || is_null($this->exclusivo))  
      { 
          $this->exclusivo = 0;
          $this->sc_force_zero[] = 'exclusivo';
      } 
      if ($this->sc_field_16 === "" || is_null($this->sc_field_16))  
      { 
          $this->sc_field_16 = 0;
          $this->sc_force_zero[] = 'sc_field_16';
      } 
      if ($this->sc_field_17 === "" || is_null($this->sc_field_17))  
      { 
          $this->sc_field_17 = 0;
          $this->sc_force_zero[] = 'sc_field_17';
      } 
      if ($this->log_liberar_custo_realizado === "" || is_null($this->log_liberar_custo_realizado))  
      { 
          $this->log_liberar_custo_realizado = 0;
          $this->sc_force_zero[] = 'log_liberar_custo_realizado';
      } 
      if ($this->situacao_container_id === "" || is_null($this->situacao_container_id))  
      { 
          $this->situacao_container_id = 0;
          $this->sc_force_zero[] = 'situacao_container_id';
      } 
      if ($this->ind_dt_embarque === "" || is_null($this->ind_dt_embarque))  
      { 
          $this->ind_dt_embarque = 0;
          $this->sc_force_zero[] = 'ind_dt_embarque';
      } 
      if ($this->ind_dt_prev_chegada === "" || is_null($this->ind_dt_prev_chegada))  
      { 
          $this->ind_dt_prev_chegada = 0;
          $this->sc_force_zero[] = 'ind_dt_prev_chegada';
      } 
      if ($this->log_pagto_final === "" || is_null($this->log_pagto_final))  
      { 
          $this->log_pagto_final = 0;
          $this->sc_force_zero[] = 'log_pagto_final';
      } 
      if ($this->cod_agente_cargas === "" || is_null($this->cod_agente_cargas))  
      { 
          $this->cod_agente_cargas = 0;
          $this->sc_force_zero[] = 'cod_agente_cargas';
      } 
      if ($this->cod_armador === "" || is_null($this->cod_armador))  
      { 
          $this->cod_armador = 0;
          $this->sc_force_zero[] = 'cod_armador';
      } 
      if ($this->cod_tipo_calculo === "" || is_null($this->cod_tipo_calculo))  
      { 
          $this->cod_tipo_calculo = 0;
          $this->sc_force_zero[] = 'cod_tipo_calculo';
      } 
      if ($this->perc_custo === "" || is_null($this->perc_custo))  
      { 
          $this->perc_custo = 0;
          $this->sc_force_zero[] = 'perc_custo';
      } 
      if ($this->vl_dolar_di === "" || is_null($this->vl_dolar_di))  
      { 
          $this->vl_dolar_di = 0;
          $this->sc_force_zero[] = 'vl_dolar_di';
      } 
      if ($this->log_gerar_saldo_a_pagar === "" || is_null($this->log_gerar_saldo_a_pagar))  
      { 
          $this->log_gerar_saldo_a_pagar = 0;
          $this->sc_force_zero[] = 'log_gerar_saldo_a_pagar';
      } 
      if ($this->log_gerar_distr_custo === "" || is_null($this->log_gerar_distr_custo))  
      { 
          $this->log_gerar_distr_custo = 0;
          $this->sc_force_zero[] = 'log_gerar_distr_custo';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->sc_field_1_before_qstr = $this->sc_field_1;
          $this->sc_field_1 = substr($this->Db->qstr($this->sc_field_1), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->sc_field_1 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->sc_field_1);
          }
          if ($this->sc_field_1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->sc_field_1 = "null"; 
              $this->NM_val_null[] = "sc_field_1";
          } 
          $this->sc_field_2_before_qstr = $this->sc_field_2;
          $this->sc_field_2 = substr($this->Db->qstr($this->sc_field_2), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->sc_field_2 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->sc_field_2);
          }
          if ($this->sc_field_2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->sc_field_2 = "null"; 
              $this->NM_val_null[] = "sc_field_2";
          } 
          $this->narrativa_before_qstr = $this->narrativa;
          $this->narrativa = substr($this->Db->qstr($this->narrativa), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->narrativa = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->narrativa);
          }
          if ($this->narrativa == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->narrativa = "null"; 
              $this->NM_val_null[] = "narrativa";
          } 
          $this->usuario_before_qstr = $this->usuario;
          $this->usuario = substr($this->Db->qstr($this->usuario), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->usuario = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->usuario);
          }
          if ($this->usuario == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->usuario = "null"; 
              $this->NM_val_null[] = "usuario";
          } 
          if ($this->sc_field_4 == "")  
          { 
              $this->sc_field_4 = "null"; 
              $this->NM_val_null[] = "sc_field_4";
          } 
          $this->sc_field_5_before_qstr = $this->sc_field_5;
          $this->sc_field_5 = substr($this->Db->qstr($this->sc_field_5), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->sc_field_5 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->sc_field_5);
          }
          if ($this->sc_field_5 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->sc_field_5 = "null"; 
              $this->NM_val_null[] = "sc_field_5";
          } 
          if ($this->sc_field_9 == "")  
          { 
              $this->sc_field_9 = "null"; 
              $this->NM_val_null[] = "sc_field_9";
          } 
          $this->comprador_before_qstr = $this->comprador;
          $this->comprador = substr($this->Db->qstr($this->comprador), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->comprador = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->comprador);
          }
          if ($this->comprador == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->comprador = "null"; 
              $this->NM_val_null[] = "comprador";
          } 
          if ($this->sc_field_11 == "")  
          { 
              $this->sc_field_11 = "null"; 
              $this->NM_val_null[] = "sc_field_11";
          } 
          if ($this->sc_field_12 == "")  
          { 
              $this->sc_field_12 = "null"; 
              $this->NM_val_null[] = "sc_field_12";
          } 
          $this->medidas_container_before_qstr = $this->medidas_container;
          $this->medidas_container = substr($this->Db->qstr($this->medidas_container), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->medidas_container = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->medidas_container);
          }
          if ($this->medidas_container == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->medidas_container = "null"; 
              $this->NM_val_null[] = "medidas_container";
          } 
          if ($this->dt_prev_embarque == "")  
          { 
              $this->dt_prev_embarque = "null"; 
              $this->NM_val_null[] = "dt_prev_embarque";
          } 
          if ($this->dt_real_embarque == "")  
          { 
              $this->dt_real_embarque = "null"; 
              $this->NM_val_null[] = "dt_real_embarque";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_pp_container_cotacoes_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "\"vl-dolar-venda\" = $this->sc_field_16, \"vl-dolar-compra\" = $this->sc_field_17"; 
              } 
              if (isset($NM_val_form['sc_field_0']) && $NM_val_form['sc_field_0'] != $this->nmgp_dados_select['sc_field_0']) 
              { 
                  $SC_fields_update[] = "\"num-pedido\" = $this->sc_field_0"; 
              } 
              if (isset($NM_val_form['sc_field_1']) && $NM_val_form['sc_field_1'] != $this->nmgp_dados_select['sc_field_1']) 
              { 
                  $SC_fields_update[] = "\"cod-estabel\" = '$this->sc_field_1'"; 
              } 
              if (isset($NM_val_form['sc_field_2']) && $NM_val_form['sc_field_2'] != $this->nmgp_dados_select['sc_field_2']) 
              { 
                  $SC_fields_update[] = "\"nome-ab-forn\" = '$this->sc_field_2'"; 
              } 
              if (isset($NM_val_form['sc_field_3']) && $NM_val_form['sc_field_3'] != $this->nmgp_dados_select['sc_field_3']) 
              { 
                  $SC_fields_update[] = "\"cod-emit-forn\" = $this->sc_field_3"; 
              } 
              if (isset($NM_val_form['narrativa']) && $NM_val_form['narrativa'] != $this->nmgp_dados_select['narrativa']) 
              { 
                  $SC_fields_update[] = "narrativa = '$this->narrativa'"; 
              } 
              if (isset($NM_val_form['usuario']) && $NM_val_form['usuario'] != $this->nmgp_dados_select['usuario']) 
              { 
                  $SC_fields_update[] = "usuario = '$this->usuario'"; 
              } 
              if (isset($NM_val_form['sc_field_4']) && $NM_val_form['sc_field_4'] != $this->nmgp_dados_select['sc_field_4']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "\"dt-compra\" = #$this->sc_field_4#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "\"dt-compra\" = EXTEND('" . $this->sc_field_4 . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "\"dt-compra\" = " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['sc_field_5']) && $NM_val_form['sc_field_5'] != $this->nmgp_dados_select['sc_field_5']) 
              { 
                  $SC_fields_update[] = "\"char-1\" = '$this->sc_field_5'"; 
              } 
              if (isset($NM_val_form['sc_field_6']) && $NM_val_form['sc_field_6'] != $this->nmgp_dados_select['sc_field_6']) 
              { 
                  $SC_fields_update[] = "\"dec-1\" = $this->sc_field_6"; 
              } 
              if (isset($NM_val_form['sc_field_7']) && $NM_val_form['sc_field_7'] != $this->nmgp_dados_select['sc_field_7']) 
              { 
                  $SC_fields_update[] = "\"int-1\" = $this->sc_field_7"; 
              } 
              if (isset($NM_val_form['sc_field_8']) && $NM_val_form['sc_field_8'] != $this->nmgp_dados_select['sc_field_8']) 
              { 
                  $SC_fields_update[] = "\"log-1\" = $this->sc_field_8"; 
              } 
              if (isset($NM_val_form['sc_field_9']) && $NM_val_form['sc_field_9'] != $this->nmgp_dados_select['sc_field_9']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "\"data-1\" = #$this->sc_field_9#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "\"data-1\" = EXTEND('" . $this->sc_field_9 . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "\"data-1\" = " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['comprador']) && $NM_val_form['comprador'] != $this->nmgp_dados_select['comprador']) 
              { 
                  $SC_fields_update[] = "comprador = '$this->comprador'"; 
              } 
              if (isset($NM_val_form['sc_field_11']) && $NM_val_form['sc_field_11'] != $this->nmgp_dados_select['sc_field_11']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "\"dt-recebimento\" = #$this->sc_field_11#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "\"dt-recebimento\" = EXTEND('" . $this->sc_field_11 . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "\"dt-recebimento\" = " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['sc_field_12']) && $NM_val_form['sc_field_12'] != $this->nmgp_dados_select['sc_field_12']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "\"dt-prev-chegada\" = #$this->sc_field_12#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "\"dt-prev-chegada\" = EXTEND('" . $this->sc_field_12 . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "\"dt-prev-chegada\" = " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['situacao']) && $NM_val_form['situacao'] != $this->nmgp_dados_select['situacao']) 
              { 
                  $SC_fields_update[] = "situacao = $this->situacao"; 
              } 
              if (isset($NM_val_form['sc_field_13']) && $NM_val_form['sc_field_13'] != $this->nmgp_dados_select['sc_field_13']) 
              { 
                  $SC_fields_update[] = "\"vlr-frete\" = $this->sc_field_13"; 
              } 
              if (isset($NM_val_form['sc_field_14']) && $NM_val_form['sc_field_14'] != $this->nmgp_dados_select['sc_field_14']) 
              { 
                  $SC_fields_update[] = "\"vlr-seguro\" = $this->sc_field_14"; 
              } 
              if (isset($NM_val_form['sc_field_15']) && $NM_val_form['sc_field_15'] != $this->nmgp_dados_select['sc_field_15']) 
              { 
                  $SC_fields_update[] = "\"vlr-despesas\" = $this->sc_field_15"; 
              } 
              if (isset($NM_val_form['exclusivo']) && $NM_val_form['exclusivo'] != $this->nmgp_dados_select['exclusivo']) 
              { 
                  $SC_fields_update[] = "exclusivo = $this->exclusivo"; 
              } 
              if (isset($NM_val_form['log_liberar_custo_realizado']) && $NM_val_form['log_liberar_custo_realizado'] != $this->nmgp_dados_select['log_liberar_custo_realizado']) 
              { 
                  $SC_fields_update[] = "log_liberar_custo_realizado = $this->log_liberar_custo_realizado"; 
              } 
              if (isset($NM_val_form['medidas_container']) && $NM_val_form['medidas_container'] != $this->nmgp_dados_select['medidas_container']) 
              { 
                  $SC_fields_update[] = "medidas_container = '$this->medidas_container'"; 
              } 
              if (isset($NM_val_form['dt_prev_embarque']) && $NM_val_form['dt_prev_embarque'] != $this->nmgp_dados_select['dt_prev_embarque']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "dt_prev_embarque = #$this->dt_prev_embarque#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "dt_prev_embarque = EXTEND('" . $this->dt_prev_embarque . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "dt_prev_embarque = " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['dt_real_embarque']) && $NM_val_form['dt_real_embarque'] != $this->nmgp_dados_select['dt_real_embarque']) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "dt_real_embarque = #$this->dt_real_embarque#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "dt_real_embarque = EXTEND('" . $this->dt_real_embarque . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "dt_real_embarque = " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              if (isset($NM_val_form['situacao_container_id']) && $NM_val_form['situacao_container_id'] != $this->nmgp_dados_select['situacao_container_id']) 
              { 
                  $SC_fields_update[] = "situacao_container_id = $this->situacao_container_id"; 
              } 
              if (isset($NM_val_form['ind_dt_embarque']) && $NM_val_form['ind_dt_embarque'] != $this->nmgp_dados_select['ind_dt_embarque']) 
              { 
                  $SC_fields_update[] = "ind_dt_embarque = $this->ind_dt_embarque"; 
              } 
              if (isset($NM_val_form['ind_dt_prev_chegada']) && $NM_val_form['ind_dt_prev_chegada'] != $this->nmgp_dados_select['ind_dt_prev_chegada']) 
              { 
                  $SC_fields_update[] = "ind_dt_prev_chegada = $this->ind_dt_prev_chegada"; 
              } 
              if (isset($NM_val_form['log_pagto_final']) && $NM_val_form['log_pagto_final'] != $this->nmgp_dados_select['log_pagto_final']) 
              { 
                  $SC_fields_update[] = "log_pagto_final = $this->log_pagto_final"; 
              } 
              if (isset($NM_val_form['cod_agente_cargas']) && $NM_val_form['cod_agente_cargas'] != $this->nmgp_dados_select['cod_agente_cargas']) 
              { 
                  $SC_fields_update[] = "cod_agente_cargas = $this->cod_agente_cargas"; 
              } 
              if (isset($NM_val_form['cod_armador']) && $NM_val_form['cod_armador'] != $this->nmgp_dados_select['cod_armador']) 
              { 
                  $SC_fields_update[] = "cod_armador = $this->cod_armador"; 
              } 
              if (isset($NM_val_form['cod_tipo_calculo']) && $NM_val_form['cod_tipo_calculo'] != $this->nmgp_dados_select['cod_tipo_calculo']) 
              { 
                  $SC_fields_update[] = "cod_tipo_calculo = $this->cod_tipo_calculo"; 
              } 
              if (isset($NM_val_form['perc_custo']) && $NM_val_form['perc_custo'] != $this->nmgp_dados_select['perc_custo']) 
              { 
                  $SC_fields_update[] = "perc_custo = $this->perc_custo"; 
              } 
              if (isset($NM_val_form['vl_dolar_di']) && $NM_val_form['vl_dolar_di'] != $this->nmgp_dados_select['vl_dolar_di']) 
              { 
                  $SC_fields_update[] = "vl_dolar_di = $this->vl_dolar_di"; 
              } 
              if (isset($NM_val_form['log_gerar_saldo_a_pagar']) && $NM_val_form['log_gerar_saldo_a_pagar'] != $this->nmgp_dados_select['log_gerar_saldo_a_pagar']) 
              { 
                  $SC_fields_update[] = "log_gerar_saldo_a_pagar = $this->log_gerar_saldo_a_pagar"; 
              } 
              if (isset($NM_val_form['log_gerar_distr_custo']) && $NM_val_form['log_gerar_distr_custo'] != $this->nmgp_dados_select['log_gerar_distr_custo']) 
              { 
                  $SC_fields_update[] = "log_gerar_distr_custo = $this->log_gerar_distr_custo"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE \"nr-container\" = $this->sc_field_10 ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE \"nr-container\" = $this->sc_field_10 ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE \"nr-container\" = $this->sc_field_10 ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE \"nr-container\" = $this->sc_field_10 ";  
              }  
              else  
              {
                  $comando .= " WHERE \"nr-container\" = $this->sc_field_10 ";  
              }  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_pp_container_cotacoes_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->sc_field_1 = $this->sc_field_1_before_qstr;
              $this->sc_field_2 = $this->sc_field_2_before_qstr;
              $this->narrativa = $this->narrativa_before_qstr;
              $this->usuario = $this->usuario_before_qstr;
              $this->sc_field_5 = $this->sc_field_5_before_qstr;
              $this->comprador = $this->comprador_before_qstr;
              $this->medidas_container = $this->medidas_container_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
              $this->NM_gera_log_new();
              $this->NM_gera_log_compress();

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['sc_field_10'])) { $this->sc_field_10 = $NM_val_form['sc_field_10']; }
              elseif (isset($this->sc_field_10)) { $this->nm_limpa_alfa($this->sc_field_10); }
              if     (isset($NM_val_form) && isset($NM_val_form['sc_field_16'])) { $this->sc_field_16 = $NM_val_form['sc_field_16']; }
              elseif (isset($this->sc_field_16)) { $this->nm_limpa_alfa($this->sc_field_16); }
              if     (isset($NM_val_form) && isset($NM_val_form['sc_field_17'])) { $this->sc_field_17 = $NM_val_form['sc_field_17']; }
              elseif (isset($this->sc_field_17)) { $this->nm_limpa_alfa($this->sc_field_17); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('sc_field_10', 'sc_field_16', 'sc_field_17', 'cotacao_bc'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 0) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_pkey']); 
              $this->nmgp_opcao = "nada"; 
              $GLOBALS["erro_incl"] = 1; 
              $bInsertOk = false;
              $this->sc_evento = 'insert';
          } 
          $rs1->Close(); 
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_pp_container_cotacoes_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES ($this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', #$this->sc_field_4#, '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, #$this->sc_field_9#, $this->sc_field_10, '$this->comprador', #$this->sc_field_11#, #$this->sc_field_12#, $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', #$this->dt_prev_embarque#, #$this->dt_real_embarque#, $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', EXTEND('$this->sc_field_4', YEAR TO DAY), '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, EXTEND('$this->sc_field_9', YEAR TO DAY), $this->sc_field_10, '$this->comprador', EXTEND('$this->sc_field_11', YEAR TO DAY), EXTEND('$this->sc_field_12', YEAR TO DAY), $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', EXTEND('$this->dt_prev_embarque', YEAR TO DAY), EXTEND('$this->dt_real_embarque', YEAR TO DAY), $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "\"num-pedido\", \"cod-estabel\", \"nome-ab-forn\", \"cod-emit-forn\", narrativa, usuario, \"dt-compra\", \"char-1\", \"dec-1\", \"int-1\", \"log-1\", \"data-1\", \"nr-container\", comprador, \"dt-recebimento\", \"dt-prev-chegada\", situacao, \"vlr-frete\", \"vlr-seguro\", \"vlr-despesas\", exclusivo, \"vl-dolar-venda\", \"vl-dolar-compra\", log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo) VALUES (" . $NM_seq_auto . "$this->sc_field_0, '$this->sc_field_1', '$this->sc_field_2', $this->sc_field_3, '$this->narrativa', '$this->usuario', " . $this->Ini->date_delim . $this->sc_field_4 . $this->Ini->date_delim1 . ", '$this->sc_field_5', $this->sc_field_6, $this->sc_field_7, $this->sc_field_8, " . $this->Ini->date_delim . $this->sc_field_9 . $this->Ini->date_delim1 . ", $this->sc_field_10, '$this->comprador', " . $this->Ini->date_delim . $this->sc_field_11 . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->sc_field_12 . $this->Ini->date_delim1 . ", $this->situacao, $this->sc_field_13, $this->sc_field_14, $this->sc_field_15, $this->exclusivo, $this->sc_field_16, $this->sc_field_17, $this->log_liberar_custo_realizado, '$this->medidas_container', " . $this->Ini->date_delim . $this->dt_prev_embarque . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dt_real_embarque . $this->Ini->date_delim1 . ", $this->situacao_container_id, $this->ind_dt_embarque, $this->ind_dt_prev_chegada, $this->log_pagto_final, $this->cod_agente_cargas, $this->cod_armador, $this->cod_tipo_calculo, $this->perc_custo, $this->vl_dolar_di, $this->log_gerar_saldo_a_pagar, $this->log_gerar_distr_custo)"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_pp_container_cotacoes_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->sc_field_1 = $this->sc_field_1_before_qstr;
              $this->sc_field_2 = $this->sc_field_2_before_qstr;
              $this->narrativa = $this->narrativa_before_qstr;
              $this->usuario = $this->usuario_before_qstr;
              $this->sc_field_5 = $this->sc_field_5_before_qstr;
              $this->comprador = $this->comprador_before_qstr;
              $this->medidas_container = $this->medidas_container_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->sc_field_1 = $this->sc_field_1_before_qstr;
              $this->sc_field_2 = $this->sc_field_2_before_qstr;
              $this->narrativa = $this->narrativa_before_qstr;
              $this->usuario = $this->usuario_before_qstr;
              $this->sc_field_5 = $this->sc_field_5_before_qstr;
              $this->comprador = $this->comprador_before_qstr;
              $this->medidas_container = $this->medidas_container_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->sc_field_10 = substr($this->Db->qstr($this->sc_field_10), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where \"nr-container\" = $this->sc_field_10 "); 
              }  
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_pp_container_cotacoes_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      $this->restore_zeros_null();
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off'; 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_sc_field_10 = $this->sc_field_10;
}
  $this->sincronizarImpostos($this->sc_field_10 ,'onAfterUpdate->form_pp_container');
$this->atuDespsCalcContainer($this->sc_field_10 );
$this->preencherIDLog($this->Ini->nm_cod_apl);
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_sc_field_10 != $this->sc_field_10 || (isset($bFlagRead_sc_field_10) && $bFlagRead_sc_field_10)))
    {
        $this->ajax_return_values_sc_field_10(true);
    }
}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['parms'] = "sc_field_10?#?$this->sc_field_10?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->sc_field_10 = null === $this->sc_field_10 ? null : substr($this->Db->qstr($this->sc_field_10), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->sc_field_10)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->sc_field_10) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("(\"nr-container\" = " . $_SESSION['container_corrente'] . ")");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_pp_container_cotacoes = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] = $qt_geral_reg_form_pp_container_cotacoes;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->sc_field_10))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "\"nr-container\" < $this->sc_field_10 "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "\"nr-container\" < $this->sc_field_10 "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "\"nr-container\" < $this->sc_field_10 "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "\"nr-container\" < $this->sc_field_10 "; 
              }
              else  
              {
                  $Key_Where = "\"nr-container\" < $this->sc_field_10 "; 
              }
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_pp_container_cotacoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] > $qt_geral_reg_form_pp_container_cotacoes)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = $qt_geral_reg_form_pp_container_cotacoes; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = $qt_geral_reg_form_pp_container_cotacoes; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_pp_container_cotacoes) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT \"num-pedido\" as sc_field_0, \"cod-estabel\" as sc_field_1, \"nome-ab-forn\" as sc_field_2, \"cod-emit-forn\" as sc_field_3, narrativa, usuario, str_replace (convert(char(10),\"dt-compra\",102), '.', '-') + ' ' + convert(char(8),\"dt-compra\",20), \"char-1\" as sc_field_5, \"dec-1\" as sc_field_6, \"int-1\" as sc_field_7, \"log-1\" as sc_field_8, str_replace (convert(char(10),\"data-1\",102), '.', '-') + ' ' + convert(char(8),\"data-1\",20), \"nr-container\" as sc_field_10, comprador, str_replace (convert(char(10),\"dt-recebimento\",102), '.', '-') + ' ' + convert(char(8),\"dt-recebimento\",20), str_replace (convert(char(10),\"dt-prev-chegada\",102), '.', '-') + ' ' + convert(char(8),\"dt-prev-chegada\",20), situacao, \"vlr-frete\" as sc_field_13, \"vlr-seguro\" as sc_field_14, \"vlr-despesas\" as sc_field_15, exclusivo, \"vl-dolar-venda\" as sc_field_16, \"vl-dolar-compra\" as sc_field_17, log_liberar_custo_realizado, medidas_container, str_replace (convert(char(10),dt_prev_embarque,102), '.', '-') + ' ' + convert(char(8),dt_prev_embarque,20), str_replace (convert(char(10),dt_real_embarque,102), '.', '-') + ' ' + convert(char(8),dt_real_embarque,20), situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT \"num-pedido\" as sc_field_0, \"cod-estabel\" as sc_field_1, \"nome-ab-forn\" as sc_field_2, \"cod-emit-forn\" as sc_field_3, narrativa, usuario, convert(char(23),\"dt-compra\",121), \"char-1\" as sc_field_5, \"dec-1\" as sc_field_6, \"int-1\" as sc_field_7, \"log-1\" as sc_field_8, convert(char(23),\"data-1\",121), \"nr-container\" as sc_field_10, comprador, convert(char(23),\"dt-recebimento\",121), convert(char(23),\"dt-prev-chegada\",121), situacao, \"vlr-frete\" as sc_field_13, \"vlr-seguro\" as sc_field_14, \"vlr-despesas\" as sc_field_15, exclusivo, \"vl-dolar-venda\" as sc_field_16, \"vl-dolar-compra\" as sc_field_17, log_liberar_custo_realizado, medidas_container, convert(char(23),dt_prev_embarque,121), convert(char(23),dt_real_embarque,121), situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT \"num-pedido\" as sc_field_0, \"cod-estabel\" as sc_field_1, \"nome-ab-forn\" as sc_field_2, \"cod-emit-forn\" as sc_field_3, narrativa, usuario, \"dt-compra\" as sc_field_4, \"char-1\" as sc_field_5, \"dec-1\" as sc_field_6, \"int-1\" as sc_field_7, \"log-1\" as sc_field_8, \"data-1\" as sc_field_9, \"nr-container\" as sc_field_10, comprador, \"dt-recebimento\" as sc_field_11, \"dt-prev-chegada\" as sc_field_12, situacao, \"vlr-frete\" as sc_field_13, \"vlr-seguro\" as sc_field_14, \"vlr-despesas\" as sc_field_15, exclusivo, \"vl-dolar-venda\" as sc_field_16, \"vl-dolar-compra\" as sc_field_17, log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT \"num-pedido\" as sc_field_0, \"cod-estabel\" as sc_field_1, \"nome-ab-forn\" as sc_field_2, \"cod-emit-forn\" as sc_field_3, narrativa, usuario, EXTEND(\"dt-compra\", YEAR TO DAY), \"char-1\" as sc_field_5, \"dec-1\" as sc_field_6, \"int-1\" as sc_field_7, \"log-1\" as sc_field_8, EXTEND(\"data-1\", YEAR TO DAY), \"nr-container\" as sc_field_10, comprador, EXTEND(\"dt-recebimento\", YEAR TO DAY), EXTEND(\"dt-prev-chegada\", YEAR TO DAY), situacao, \"vlr-frete\" as sc_field_13, \"vlr-seguro\" as sc_field_14, \"vlr-despesas\" as sc_field_15, exclusivo, \"vl-dolar-venda\" as sc_field_16, \"vl-dolar-compra\" as sc_field_17, log_liberar_custo_realizado, medidas_container, EXTEND(dt_prev_embarque, YEAR TO DAY), EXTEND(dt_real_embarque, YEAR TO DAY), situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT \"num-pedido\" as sc_field_0, \"cod-estabel\" as sc_field_1, \"nome-ab-forn\" as sc_field_2, \"cod-emit-forn\" as sc_field_3, narrativa, usuario, \"dt-compra\" as sc_field_4, \"char-1\" as sc_field_5, \"dec-1\" as sc_field_6, \"int-1\" as sc_field_7, \"log-1\" as sc_field_8, \"data-1\" as sc_field_9, \"nr-container\" as sc_field_10, comprador, \"dt-recebimento\" as sc_field_11, \"dt-prev-chegada\" as sc_field_12, situacao, \"vlr-frete\" as sc_field_13, \"vlr-seguro\" as sc_field_14, \"vlr-despesas\" as sc_field_15, exclusivo, \"vl-dolar-venda\" as sc_field_16, \"vl-dolar-compra\" as sc_field_17, log_liberar_custo_realizado, medidas_container, dt_prev_embarque, dt_real_embarque, situacao_container_id, ind_dt_embarque, ind_dt_prev_chegada, log_pagto_final, cod_agente_cargas, cod_armador, cod_tipo_calculo, perc_custo, vl_dolar_di, log_gerar_saldo_a_pagar, log_gerar_distr_custo from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = "(\"nr-container\" = " . $_SESSION['container_corrente'] . ")";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                     $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                     $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                     $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  else  
                  {
                     $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }
              } 
              else
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                      $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                      $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                      $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                      $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }  
                  else  
                  {
                      $aWhere[] = "\"nr-container\" = $this->sc_field_10"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "\"nr-container\"";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes['update'] = "off";
              $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes['delete'] = "off";
              return; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->sc_field_0 = $rs->fields[0] ; 
              $this->nmgp_dados_select['sc_field_0'] = $this->sc_field_0;
              $this->sc_field_1 = $rs->fields[1] ; 
              $this->nmgp_dados_select['sc_field_1'] = $this->sc_field_1;
              $this->sc_field_2 = $rs->fields[2] ; 
              $this->nmgp_dados_select['sc_field_2'] = $this->sc_field_2;
              $this->sc_field_3 = $rs->fields[3] ; 
              $this->nmgp_dados_select['sc_field_3'] = $this->sc_field_3;
              $this->narrativa = $rs->fields[4] ; 
              $this->nmgp_dados_select['narrativa'] = $this->narrativa;
              $this->usuario = $rs->fields[5] ; 
              $this->nmgp_dados_select['usuario'] = $this->usuario;
              $this->sc_field_4 = $rs->fields[6] ; 
              $this->nmgp_dados_select['sc_field_4'] = $this->sc_field_4;
              $this->sc_field_5 = $rs->fields[7] ; 
              $this->nmgp_dados_select['sc_field_5'] = $this->sc_field_5;
              $this->sc_field_6 = $rs->fields[8] ; 
              $this->nmgp_dados_select['sc_field_6'] = $this->sc_field_6;
              $this->sc_field_7 = $rs->fields[9] ; 
              $this->nmgp_dados_select['sc_field_7'] = $this->sc_field_7;
              $this->sc_field_8 = $rs->fields[10] ; 
              $this->nmgp_dados_select['sc_field_8'] = $this->sc_field_8;
              $this->sc_field_9 = $rs->fields[11] ; 
              $this->nmgp_dados_select['sc_field_9'] = $this->sc_field_9;
              $this->sc_field_10 = $rs->fields[12] ; 
              $this->nmgp_dados_select['sc_field_10'] = $this->sc_field_10;
              $this->comprador = $rs->fields[13] ; 
              $this->nmgp_dados_select['comprador'] = $this->comprador;
              $this->sc_field_11 = $rs->fields[14] ; 
              $this->nmgp_dados_select['sc_field_11'] = $this->sc_field_11;
              $this->sc_field_12 = $rs->fields[15] ; 
              $this->nmgp_dados_select['sc_field_12'] = $this->sc_field_12;
              $this->situacao = $rs->fields[16] ; 
              $this->nmgp_dados_select['situacao'] = $this->situacao;
              $this->sc_field_13 = $rs->fields[17] ; 
              $this->nmgp_dados_select['sc_field_13'] = $this->sc_field_13;
              $this->sc_field_14 = $rs->fields[18] ; 
              $this->nmgp_dados_select['sc_field_14'] = $this->sc_field_14;
              $this->sc_field_15 = $rs->fields[19] ; 
              $this->nmgp_dados_select['sc_field_15'] = $this->sc_field_15;
              $this->exclusivo = $rs->fields[20] ; 
              $this->nmgp_dados_select['exclusivo'] = $this->exclusivo;
              $this->sc_field_16 = $rs->fields[21] ; 
              $this->nmgp_dados_select['sc_field_16'] = $this->sc_field_16;
              $this->sc_field_17 = $rs->fields[22] ; 
              $this->nmgp_dados_select['sc_field_17'] = $this->sc_field_17;
              $this->log_liberar_custo_realizado = $rs->fields[23] ; 
              $this->nmgp_dados_select['log_liberar_custo_realizado'] = $this->log_liberar_custo_realizado;
              $this->medidas_container = $rs->fields[24] ; 
              $this->nmgp_dados_select['medidas_container'] = $this->medidas_container;
              $this->dt_prev_embarque = $rs->fields[25] ; 
              $this->nmgp_dados_select['dt_prev_embarque'] = $this->dt_prev_embarque;
              $this->dt_real_embarque = $rs->fields[26] ; 
              $this->nmgp_dados_select['dt_real_embarque'] = $this->dt_real_embarque;
              $this->situacao_container_id = $rs->fields[27] ; 
              $this->nmgp_dados_select['situacao_container_id'] = $this->situacao_container_id;
              $this->ind_dt_embarque = $rs->fields[28] ; 
              $this->nmgp_dados_select['ind_dt_embarque'] = $this->ind_dt_embarque;
              $this->ind_dt_prev_chegada = $rs->fields[29] ; 
              $this->nmgp_dados_select['ind_dt_prev_chegada'] = $this->ind_dt_prev_chegada;
              $this->log_pagto_final = $rs->fields[30] ; 
              $this->nmgp_dados_select['log_pagto_final'] = $this->log_pagto_final;
              $this->cod_agente_cargas = $rs->fields[31] ; 
              $this->nmgp_dados_select['cod_agente_cargas'] = $this->cod_agente_cargas;
              $this->cod_armador = $rs->fields[32] ; 
              $this->nmgp_dados_select['cod_armador'] = $this->cod_armador;
              $this->cod_tipo_calculo = $rs->fields[33] ; 
              $this->nmgp_dados_select['cod_tipo_calculo'] = $this->cod_tipo_calculo;
              $this->perc_custo = $rs->fields[34] ; 
              $this->nmgp_dados_select['perc_custo'] = $this->perc_custo;
              $this->vl_dolar_di = $rs->fields[35] ; 
              $this->nmgp_dados_select['vl_dolar_di'] = $this->vl_dolar_di;
              $this->log_gerar_saldo_a_pagar = $rs->fields[36] ; 
              $this->nmgp_dados_select['log_gerar_saldo_a_pagar'] = $this->log_gerar_saldo_a_pagar;
              $this->log_gerar_distr_custo = $rs->fields[37] ; 
              $this->nmgp_dados_select['log_gerar_distr_custo'] = $this->log_gerar_distr_custo;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->sc_field_0 = (string)$this->sc_field_0; 
              $this->sc_field_3 = (string)$this->sc_field_3; 
              $this->sc_field_6 = (string)$this->sc_field_6; 
              $this->sc_field_7 = (string)$this->sc_field_7; 
              $this->sc_field_8 = (string)$this->sc_field_8; 
              $this->sc_field_10 = (string)$this->sc_field_10; 
              $this->situacao = (string)$this->situacao; 
              $this->sc_field_13 = (string)$this->sc_field_13; 
              $this->sc_field_14 = (string)$this->sc_field_14; 
              $this->sc_field_15 = (string)$this->sc_field_15; 
              $this->exclusivo = (string)$this->exclusivo; 
              $this->sc_field_16 = (string)$this->sc_field_16; 
              $this->sc_field_17 = (string)$this->sc_field_17; 
              $this->log_liberar_custo_realizado = (string)$this->log_liberar_custo_realizado; 
              $this->situacao_container_id = (string)$this->situacao_container_id; 
              $this->ind_dt_embarque = (string)$this->ind_dt_embarque; 
              $this->ind_dt_prev_chegada = (string)$this->ind_dt_prev_chegada; 
              $this->log_pagto_final = (string)$this->log_pagto_final; 
              $this->cod_agente_cargas = (string)$this->cod_agente_cargas; 
              $this->cod_armador = (string)$this->cod_armador; 
              $this->cod_tipo_calculo = (string)$this->cod_tipo_calculo; 
              $this->perc_custo = (string)$this->perc_custo; 
              $this->vl_dolar_di = (string)$this->vl_dolar_di; 
              $this->log_gerar_saldo_a_pagar = (string)$this->log_gerar_saldo_a_pagar; 
              $this->log_gerar_distr_custo = (string)$this->log_gerar_distr_custo; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['parms'] = "sc_field_10?#?$this->sc_field_10?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] < $qt_geral_reg_form_pp_container_cotacoes;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->sc_field_0 = "";  
              $this->nmgp_dados_form["sc_field_0"] = $this->sc_field_0;
              $this->sc_field_1 = "";  
              $this->nmgp_dados_form["sc_field_1"] = $this->sc_field_1;
              $this->sc_field_2 = "";  
              $this->nmgp_dados_form["sc_field_2"] = $this->sc_field_2;
              $this->sc_field_3 = "";  
              $this->nmgp_dados_form["sc_field_3"] = $this->sc_field_3;
              $this->narrativa = "";  
              $this->nmgp_dados_form["narrativa"] = $this->narrativa;
              $this->usuario = "";  
              $this->nmgp_dados_form["usuario"] = $this->usuario;
              $this->sc_field_4 = "";  
              $this->sc_field_4_hora = "" ;  
              $this->nmgp_dados_form["sc_field_4"] = $this->sc_field_4;
              $this->sc_field_5 = "";  
              $this->nmgp_dados_form["sc_field_5"] = $this->sc_field_5;
              $this->sc_field_6 = "";  
              $this->nmgp_dados_form["sc_field_6"] = $this->sc_field_6;
              $this->sc_field_7 = "";  
              $this->nmgp_dados_form["sc_field_7"] = $this->sc_field_7;
              $this->sc_field_8 = "";  
              $this->nmgp_dados_form["sc_field_8"] = $this->sc_field_8;
              $this->sc_field_9 = "";  
              $this->sc_field_9_hora = "" ;  
              $this->nmgp_dados_form["sc_field_9"] = $this->sc_field_9;
              $this->sc_field_10 = "";  
              $this->nmgp_dados_form["sc_field_10"] = $this->sc_field_10;
              $this->comprador = "";  
              $this->nmgp_dados_form["comprador"] = $this->comprador;
              $this->sc_field_11 = "";  
              $this->sc_field_11_hora = "" ;  
              $this->nmgp_dados_form["sc_field_11"] = $this->sc_field_11;
              $this->sc_field_12 = "";  
              $this->sc_field_12_hora = "" ;  
              $this->nmgp_dados_form["sc_field_12"] = $this->sc_field_12;
              $this->situacao = "";  
              $this->nmgp_dados_form["situacao"] = $this->situacao;
              $this->sc_field_13 = "";  
              $this->nmgp_dados_form["sc_field_13"] = $this->sc_field_13;
              $this->sc_field_14 = "";  
              $this->nmgp_dados_form["sc_field_14"] = $this->sc_field_14;
              $this->sc_field_15 = "";  
              $this->nmgp_dados_form["sc_field_15"] = $this->sc_field_15;
              $this->exclusivo = "";  
              $this->nmgp_dados_form["exclusivo"] = $this->exclusivo;
              $this->sc_field_16 = "";  
              $this->nmgp_dados_form["sc_field_16"] = $this->sc_field_16;
              $this->sc_field_17 = "";  
              $this->nmgp_dados_form["sc_field_17"] = $this->sc_field_17;
              $this->log_liberar_custo_realizado = "";  
              $this->nmgp_dados_form["log_liberar_custo_realizado"] = $this->log_liberar_custo_realizado;
              $this->medidas_container = "";  
              $this->nmgp_dados_form["medidas_container"] = $this->medidas_container;
              $this->dt_prev_embarque = "";  
              $this->dt_prev_embarque_hora = "" ;  
              $this->nmgp_dados_form["dt_prev_embarque"] = $this->dt_prev_embarque;
              $this->dt_real_embarque = "";  
              $this->dt_real_embarque_hora = "" ;  
              $this->nmgp_dados_form["dt_real_embarque"] = $this->dt_real_embarque;
              $this->situacao_container_id = "";  
              $this->nmgp_dados_form["situacao_container_id"] = $this->situacao_container_id;
              $this->ind_dt_embarque = "";  
              $this->nmgp_dados_form["ind_dt_embarque"] = $this->ind_dt_embarque;
              $this->ind_dt_prev_chegada = "";  
              $this->nmgp_dados_form["ind_dt_prev_chegada"] = $this->ind_dt_prev_chegada;
              $this->log_pagto_final = "";  
              $this->nmgp_dados_form["log_pagto_final"] = $this->log_pagto_final;
              $this->cod_agente_cargas = "";  
              $this->nmgp_dados_form["cod_agente_cargas"] = $this->cod_agente_cargas;
              $this->cod_armador = "";  
              $this->nmgp_dados_form["cod_armador"] = $this->cod_armador;
              $this->cod_tipo_calculo = "";  
              $this->nmgp_dados_form["cod_tipo_calculo"] = $this->cod_tipo_calculo;
              $this->perc_custo = "";  
              $this->nmgp_dados_form["perc_custo"] = $this->perc_custo;
              $this->vl_dolar_di = "";  
              $this->nmgp_dados_form["vl_dolar_di"] = $this->vl_dolar_di;
              $this->log_gerar_saldo_a_pagar = "";  
              $this->nmgp_dados_form["log_gerar_saldo_a_pagar"] = $this->log_gerar_saldo_a_pagar;
              $this->log_gerar_distr_custo = "";  
              $this->nmgp_dados_form["log_gerar_distr_custo"] = $this->log_gerar_distr_custo;
              $this->cotacao_bc = "";  
              $this->nmgp_dados_form["cotacao_bc"] = $this->cotacao_bc;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
  }
// 
   function NM_gera_log_key($evt) 
   {
       $this->SC_log_arr = array();
       $this->SC_log_atv = true;
       if ($evt == "incluir")
       {
           $this->SC_log_evt = "insert";
       }
       if ($evt == "alterar")
       {
           $this->SC_log_evt = "update";
       }
       if ($evt == "excluir")
       {
           $this->SC_log_evt = "delete";
       }
       $this->SC_log_arr['keys']['nr-container'] =  $this->sc_field_10;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dados_select'];
           $this->SC_log_arr['fields']['num-pedido']['0'] =  $nmgp_dados_select['sc_field_0'];
           $this->SC_log_arr['fields']['cod-estabel']['0'] =  $nmgp_dados_select['sc_field_1'];
           $this->SC_log_arr['fields']['nome-ab-forn']['0'] =  $nmgp_dados_select['sc_field_2'];
           $this->SC_log_arr['fields']['cod-emit-forn']['0'] =  $nmgp_dados_select['sc_field_3'];
           $this->SC_log_arr['fields']['narrativa']['0'] =  $nmgp_dados_select['narrativa'];
           $this->SC_log_arr['fields']['usuario']['0'] =  $nmgp_dados_select['usuario'];
           $this->SC_log_arr['fields']['dt-compra']['0'] =  $nmgp_dados_select['sc_field_4'];
           $this->SC_log_arr['fields']['char-1']['0'] =  $nmgp_dados_select['sc_field_5'];
           $this->SC_log_arr['fields']['dec-1']['0'] =  $nmgp_dados_select['sc_field_6'];
           $this->SC_log_arr['fields']['int-1']['0'] =  $nmgp_dados_select['sc_field_7'];
           $this->SC_log_arr['fields']['log-1']['0'] =  $nmgp_dados_select['sc_field_8'];
           $this->SC_log_arr['fields']['data-1']['0'] =  $nmgp_dados_select['sc_field_9'];
           $this->SC_log_arr['fields']['comprador']['0'] =  $nmgp_dados_select['comprador'];
           $this->SC_log_arr['fields']['dt-recebimento']['0'] =  $nmgp_dados_select['sc_field_11'];
           $this->SC_log_arr['fields']['dt-prev-chegada']['0'] =  $nmgp_dados_select['sc_field_12'];
           $this->SC_log_arr['fields']['situacao']['0'] =  $nmgp_dados_select['situacao'];
           $this->SC_log_arr['fields']['vlr-frete']['0'] =  $nmgp_dados_select['sc_field_13'];
           $this->SC_log_arr['fields']['vlr-seguro']['0'] =  $nmgp_dados_select['sc_field_14'];
           $this->SC_log_arr['fields']['vlr-despesas']['0'] =  $nmgp_dados_select['sc_field_15'];
           $this->SC_log_arr['fields']['exclusivo']['0'] =  $nmgp_dados_select['exclusivo'];
           $this->SC_log_arr['fields']['vl-dolar-venda']['0'] =  $nmgp_dados_select['sc_field_16'];
           $this->SC_log_arr['fields']['vl-dolar-compra']['0'] =  $nmgp_dados_select['sc_field_17'];
           $this->SC_log_arr['fields']['log_liberar_custo_realizado']['0'] =  $nmgp_dados_select['log_liberar_custo_realizado'];
           $this->SC_log_arr['fields']['medidas_container']['0'] =  $nmgp_dados_select['medidas_container'];
           $this->SC_log_arr['fields']['dt_prev_embarque']['0'] =  $nmgp_dados_select['dt_prev_embarque'];
           $this->SC_log_arr['fields']['dt_real_embarque']['0'] =  $nmgp_dados_select['dt_real_embarque'];
           $this->SC_log_arr['fields']['situacao_container_id']['0'] =  $nmgp_dados_select['situacao_container_id'];
           $this->SC_log_arr['fields']['ind_dt_embarque']['0'] =  $nmgp_dados_select['ind_dt_embarque'];
           $this->SC_log_arr['fields']['ind_dt_prev_chegada']['0'] =  $nmgp_dados_select['ind_dt_prev_chegada'];
           $this->SC_log_arr['fields']['log_pagto_final']['0'] =  $nmgp_dados_select['log_pagto_final'];
           $this->SC_log_arr['fields']['cod_agente_cargas']['0'] =  $nmgp_dados_select['cod_agente_cargas'];
           $this->SC_log_arr['fields']['cod_armador']['0'] =  $nmgp_dados_select['cod_armador'];
           $this->SC_log_arr['fields']['cod_tipo_calculo']['0'] =  $nmgp_dados_select['cod_tipo_calculo'];
           $this->SC_log_arr['fields']['perc_custo']['0'] =  $nmgp_dados_select['perc_custo'];
           $this->SC_log_arr['fields']['vl_dolar_di']['0'] =  $nmgp_dados_select['vl_dolar_di'];
           $this->SC_log_arr['fields']['log_gerar_saldo_a_pagar']['0'] =  $nmgp_dados_select['log_gerar_saldo_a_pagar'];
           $this->SC_log_arr['fields']['log_gerar_distr_custo']['0'] =  $nmgp_dados_select['log_gerar_distr_custo'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['num-pedido']['1'] =  $this->sc_field_0;
       $this->SC_log_arr['fields']['cod-estabel']['1'] =  $this->sc_field_1;
       $this->SC_log_arr['fields']['nome-ab-forn']['1'] =  $this->sc_field_2;
       $this->SC_log_arr['fields']['cod-emit-forn']['1'] =  $this->sc_field_3;
       $this->SC_log_arr['fields']['narrativa']['1'] =  $this->narrativa;
       $this->SC_log_arr['fields']['usuario']['1'] =  $this->usuario;
       $this->SC_log_arr['fields']['dt-compra']['1'] =  $this->sc_field_4;
       $this->SC_log_arr['fields']['char-1']['1'] =  $this->sc_field_5;
       $this->SC_log_arr['fields']['dec-1']['1'] =  $this->sc_field_6;
       $this->SC_log_arr['fields']['int-1']['1'] =  $this->sc_field_7;
       $this->SC_log_arr['fields']['log-1']['1'] =  $this->sc_field_8;
       $this->SC_log_arr['fields']['data-1']['1'] =  $this->sc_field_9;
       $this->SC_log_arr['fields']['comprador']['1'] =  $this->comprador;
       $this->SC_log_arr['fields']['dt-recebimento']['1'] =  $this->sc_field_11;
       $this->SC_log_arr['fields']['dt-prev-chegada']['1'] =  $this->sc_field_12;
       $this->SC_log_arr['fields']['situacao']['1'] =  $this->situacao;
       $this->SC_log_arr['fields']['vlr-frete']['1'] =  $this->sc_field_13;
       $this->SC_log_arr['fields']['vlr-seguro']['1'] =  $this->sc_field_14;
       $this->SC_log_arr['fields']['vlr-despesas']['1'] =  $this->sc_field_15;
       $this->SC_log_arr['fields']['exclusivo']['1'] =  $this->exclusivo;
       $this->SC_log_arr['fields']['vl-dolar-venda']['1'] =  $this->sc_field_16;
       $this->SC_log_arr['fields']['vl-dolar-compra']['1'] =  $this->sc_field_17;
       $this->SC_log_arr['fields']['log_liberar_custo_realizado']['1'] =  $this->log_liberar_custo_realizado;
       $this->SC_log_arr['fields']['medidas_container']['1'] =  $this->medidas_container;
       $this->SC_log_arr['fields']['dt_prev_embarque']['1'] =  $this->dt_prev_embarque;
       $this->SC_log_arr['fields']['dt_real_embarque']['1'] =  $this->dt_real_embarque;
       $this->SC_log_arr['fields']['situacao_container_id']['1'] =  $this->situacao_container_id;
       $this->SC_log_arr['fields']['ind_dt_embarque']['1'] =  $this->ind_dt_embarque;
       $this->SC_log_arr['fields']['ind_dt_prev_chegada']['1'] =  $this->ind_dt_prev_chegada;
       $this->SC_log_arr['fields']['log_pagto_final']['1'] =  $this->log_pagto_final;
       $this->SC_log_arr['fields']['cod_agente_cargas']['1'] =  $this->cod_agente_cargas;
       $this->SC_log_arr['fields']['cod_armador']['1'] =  $this->cod_armador;
       $this->SC_log_arr['fields']['cod_tipo_calculo']['1'] =  $this->cod_tipo_calculo;
       $this->SC_log_arr['fields']['perc_custo']['1'] =  $this->perc_custo;
       $this->SC_log_arr['fields']['vl_dolar_di']['1'] =  $this->vl_dolar_di;
       $this->SC_log_arr['fields']['log_gerar_saldo_a_pagar']['1'] =  $this->log_gerar_saldo_a_pagar;
       $this->SC_log_arr['fields']['log_gerar_distr_custo']['1'] =  $this->log_gerar_distr_custo;
   }
// 
   function NM_gera_log_compress() 
   {
       foreach ($this->SC_log_arr['fields'] as $fild => $data_f)
       {
           if ($data_f[0] == $data_f[1] || ($data_f[0] == "" && $data_f[1] == "null"))
           {
               unset($this->SC_log_arr['fields'][$fild]);
           }
       }
   }
// 
   function NM_gera_log_output() 
   {
       $Log_output = "";
       $prim_delim = "";
       $Log_labels = array();
       $Log_labels['num-pedido'] =  "Num Pedido";
       $Log_labels['cod-estabel'] =  "Estab.";
       $Log_labels['nome-ab-forn'] =  "Nome Ab Forn";
       $Log_labels['cod-emit-forn'] =  "Fornecedor";
       $Log_labels['narrativa'] =  "Narrativa";
       $Log_labels['usuario'] =  "Usuario";
       $Log_labels['dt-compra'] =  "Dt Compra";
       $Log_labels['char-1'] =  "Char 1";
       $Log_labels['dec-1'] =  "Vl.Dolar Venda";
       $Log_labels['int-1'] =  "Int 1";
       $Log_labels['log-1'] =  "Log 1";
       $Log_labels['data-1'] =  "Data 1";
       $Log_labels['comprador'] =  "Comprador";
       $Log_labels['dt-recebimento'] =  "Dt Recebimento";
       $Log_labels['dt-prev-chegada'] =  "Dt Prev Chegada";
       $Log_labels['situacao'] =  "Situação ERP";
       $Log_labels['vlr-frete'] =  "Vlr Frete";
       $Log_labels['vlr-seguro'] =  "Vlr Seguro";
       $Log_labels['vlr-despesas'] =  "Vlr Despesas";
       $Log_labels['exclusivo'] =  "Exclusivo";
       $Log_labels['vl-dolar-venda'] =  "Vl Dolar Venda";
       $Log_labels['vl-dolar-compra'] =  "Vl Dolar Compra";
       $Log_labels['log_liberar_custo_realizado'] =  "Liberar Custo Realizado?";
       $Log_labels['medidas_container'] =  "Medidas Container";
       $Log_labels['dt_prev_embarque'] =  "Dt. Prev. Embarque";
       $Log_labels['dt_real_embarque'] =  "Dt Real Embarque";
       $Log_labels['situacao_container_id'] =  "Situação Acompanhamento";
       $Log_labels['ind_dt_embarque'] =  "SIt.Dt.Embarque";
       $Log_labels['ind_dt_prev_chegada'] =  "Sit.Dt.Prev.Chegada";
       $Log_labels['log_pagto_final'] =  "Pagto Final Realizado?";
       $Log_labels['cod_agente_cargas'] =  "Agente Cargas";
       $Log_labels['cod_armador'] =  "Armador";
       $Log_labels['cod_tipo_calculo'] =  "Tipo Cálculo";
       $Log_labels['perc_custo'] =  "% Custo";
       $Log_labels['vl_dolar_di'] =  "Vl.Dolar DI";
       $Log_labels['log_gerar_saldo_a_pagar'] =  "Gerar Saldo A Pagar?";
       $Log_labels['log_gerar_distr_custo'] =  "Gerar Distr. Custo?";
       foreach ($this->SC_log_arr as $type => $dats)
       {
           if ($type == "keys")
           {
               $Log_output .= "--> keys <-- ";
               foreach ($dats as $key => $data)
               {
                   $Log_output .=  $prim_delim . $key . " : " . $data;
                   $prim_delim  = "||";
               }
           }
           if ($type == "fields")
           {
               $Log_output .= $prim_delim . "--> fields <-- ";
               $prim_delim = "";
               if (empty($dats) && $this->SC_log_evt == "update")
               {
                   return;
               }
               foreach ($dats as $key => $data)
               {
                   foreach ($data as $tp => $val)
                   {
                      $tpok = ($tp == 0) ? " (old) " : " (new) ";
                      $Log_output .= $prim_delim . $key . $tpok . " : " . $val;
                      $prim_delim  = "||";
                   }
                   $Log_output .= $prim_delim . $key . " (label) " . " : " . $Log_labels[$key];
               }
           }
       }
       $this->NM_gera_log_insert("Scriptcase", $this->SC_log_evt, $Log_output);
   }
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = 1;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] + 1;
       $rec_fim    = ($rec_fim > $rec_tot) ? $rec_tot : $rec_fim;
       if ($rec_tot == 0)
       {
           return;
       }
       $Qtd_Pages  = ceil($rec_tot / $Reg_Page);
       $Page_Atu   = ceil($rec_fim / $Reg_Page);
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
               $Arr_result[$Ind_result] = '<span class="scFormToolbarNavOpen" style="vertical-align: middle;">' . $Link_ini . '</span>';
           }
           else
           {
               $Arr_result[$Ind_result] = '<a class="scFormToolbarNav" style="vertical-align: middle;" href="javascript: nm_navpage(' . $rec . ')">' . $Link_ini . '</a>';
           }
           $Link_ini++;
           $Ind_result++;
           if (!isset($this->Ini->Str_toolbarnav_separator))
           {
               $this->Ini->Str_toolbarnav_separator = "";
           }
           if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
           {
               $Arr_result[$Ind_result] = '<img src="' . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . '" align="absmiddle" style="vertical-align: middle;">';
               $Ind_result++;
           }
       }
       if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
       {
           krsort($Arr_result);
       }
       foreach ($Arr_result as $Ind_result => $Lin_result)
       {
           $this->SC_nav_page .= $Lin_result;
       }
   }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function local_atribuir_nome_abrev()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
$this->sc_field_2  = $this->buscarNomeAbrevFornecedor($this->sc_field_3 );


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCotacaoDolarVendaBC($serieParam = 1, $tempo = 3, $tipoRetorno = 'valor', $logHist = true, $logForcarBusca = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
    $logJaExisteCotacao = false;
    date_default_timezone_set('America/Sao_Paulo');
    $agora = date('G:i:s');
    $valorMoeda = 0;
    $data = date('d/m/Y');
    $ParametroPesquisa = "getUltimoValorXML";
    $nomeMoeda = '';
    $logPesquisar = true;
    $retorno = '';
    $logOk = 0;
    
    
    
    $diaSemana = $this->diaDaSemana($data, 1, 'dd/mm/aaaa');
    if ($diaSemana == 0 or $diaSemana == 6) { 
        $logPesquisar = false;
    }
    $aHistCotacao = $this->getDadosCotacaoHoje($serieParam);
    if (is_array($aHistCotacao) and $logForcarBusca == false) { 
        $logPesquisar = false;
        $logJaExisteCotacao = true;
    }

    ob_start();
    try {
        if ($logPesquisar == true) {
            ini_set("soap.wsdl_cache_enabled", "0");
            ini_set('default_socket_timeout', $tempo);
            $WsSOAP = new SoapClient("https://www3.bcb.gov.br/sgspub/JSP/sgsgeral/FachadaWSSGS.wsdl", array('connection_timeout' => $tempo));
            $DadosParaPesquisa = array("in0" => "$serieParam");
            $ResultadoPesquisaWS = $WsSOAP->$ParametroPesquisa($DadosParaPesquisa);

            if (isset($ResultadoPesquisaWS)) {
                $CotacaoMoedaWS = simplexml_load_string($ResultadoPesquisaWS);
                $nomeMoeda = $CotacaoMoedaWS->SERIE->NOME;
                $valorMoeda = $CotacaoMoedaWS->SERIE->VALOR;
                $diaCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->DIA;
                $mesCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->MES;
                $anoCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->ANO;
                switch ($tipoRetorno) {
                    case 'valor':
                        $retorno = $valorMoeda;
                        break;
                    case 'completo':
                        $retorno = array('tipo' => 'online', 'serie' => $serieParam, 'nome_serie' => $nomeMoeda, 'valor' => $valorMoeda, 'data' => $data);
                        break;
                }
                $logOk = 1;
            } else {

                $retorno = 0;
            }
        }

    } catch (Exception $Exception) {

        $retorno = 0;
    }
    ob_end_clean();
    if ($logOk == 0) {
        $aHistCotacao = $this->getDadosCotacaoHoje();
        if (is_array($aHistCotacao)) {
            if ($tipoRetorno == 'valor') {
                $retorno = $aHistCotacao['valor'];
            } else {
                $retorno = $aHistCotacao;
            }
        }
    }
    if ($logHist == true and $logJaExisteCotacao == false) {
        $this->inserirHistCotacaoBc($serieParam, $data, $valorMoeda, $nomeMoeda, $logOk);
    }
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function inserirHistCotacaoBc($serie, $data, $valor, $nome, $logOk)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    if (strstr($data, '/') <> false) {
        $data = $this->nm_conv_data_db($data, 'dd/mm/aaaa', 'aaaa-mm-dd');
    }
    $nome = $this->retirarAcento($nome);
    $valor = str_replace(',', '.', $valor);
    $cmd = " insert into pub.hist_cotacoes_bc(hist_cotacao_bc_id,serie,data,valor,dt_hr_busca,nome_serie,log_ok)
            values(pub.seq_hist_cotacao_bc.NEXTVAL,$serie,'$data','$valor',NOW(),'$nome',$logOk)";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosCotacaoHoje($serieParam = 1)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $data = date('Y-m-d');
    $aRet = $this->getDadosHistCotacoesBc(0,
        'top 1 valor  as valor,nome_serie,data',
        " serie = $serieParam and data = '$data' and (log_ok = 1 or log_manual = 1) order by hist_cotacao_bc_id desc");
    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getVlCotacaoHoje($serie = 1)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor = 0;
    $aDados = $this->getDadosCotacaoHoje($serie);
    if (is_array($aDados)) {
        $valor = $aDados['valor'];
    }
    return $valor;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosUltCotacao($serie = 1)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $aRetorno = '';

    $aRet = $this->getDadosHistCotacoesBc(0,
        ' data, valor,nome_serie',
        " serie = $serie and  (log_ok = 1 or log_manual = 1)
              and  data in (select max(data) from pub.hist_cotacoes_bc h2 
              where serie = h2.serie and valor <> 0 ) and valor <> 0 "
    );

    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosHistCotacoesBc($id, $campos = '', $filtro = '')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if ($campos == '') {
        $campos = $this->getCpsTbSessao('espec', 'hist_cotacoes_bc');
    }

    $tabela = " pub.hist_cotacoes_bc ";
    if ($id == 0) {
        $condicao = " $filtro ";
    } else {
        $condicao = "  hist_cotacao_bc_id = $id ";
    }

    $aRet = $this->getDados('unico', $tabela, $campos, $condicao, "espec");
    return $aRet;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrCotacaoDia($serie = 1)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $logAtu = false;
    $vl = $this->getVlCotacaoHoje($serie);
    if ($vl == 0) {
        $vl = $this->atualizarCotacaoDia($serie);
        $logAtu = true;
    }
    $aRetorno = array('valor' => $vl, 'log_atu' => $logAtu);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarCotacaoDia($serie, $valor = 0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $data = date('Y-m-d');
    if ($valor == 0) {
        $vlOnLine = $this->buscarCotacaoDolarVendaBC('1', '3', 'valor', false, true);
    } else {
        $vlOnLine = $valor;
    }
    $vlOnLine = str_replace(',', '.', $vlOnLine);
    if ($vlOnLine <> 0) {
        $this->inserirHistCotacaoBc($serie, $data, $vlOnLine, '', 1);
        $this->atualizarCotacaoEms($serie, $data, $vlOnLine);
    }
    return $vlOnLine;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aCotacao = $this->getCotacaoEms5($indicador, $data);
    $logAchou = $aCotacao['log_achou'];
    if ($logAchou == 0) {
        $this->inserirCotacaoEms5($indicador, $data, $valor);
    } else {
        $this->atualizarCotacaoEms5($indicador, $data, $valor);
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = "update pub.cotac_parid set val_cotac_indic_econ = $valor
             where cod_indic_econ_base = 'real' and cod_indic_econ_idx = '$indicador'
             and  dat_cotac_indic_econ = '$data' ";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_ems5w->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5w->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor = str_replace(',', '.', $valor);
    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);
    $anoMes = $ano . $mes;
    $aPerCot = $this->getCotacoesPeriodoEms2($indicador, $data);
    $cotacaoPeriodo = $aPerCot['cotacao_periodo'];
    $cotacaoPeriodoAtu = '';
    $aCotacaoPeriodo = explode(';', $cotacaoPeriodo);
    var_dump($cotacaoPeriodo);
    echo "<h1>valor: $valor</h1>";
    if (is_array($aCotacaoPeriodo)) {
        $tam = count($aCotacaoPeriodo);
        for ($i = 1; $i <= $tam; $i++) {
            if ($i < $dia) {
                $vlCotacao = $aCotacaoPeriodo[$i - 1];
            } else {
                $vlCotacao = $valor;
            }
            $cotacaoPeriodoAtu = $this->util_incr_valor($cotacaoPeriodoAtu, $vlCotacao, ";");
        }

        $cmd = " update pub.cotacao set cotacao = '$cotacaoPeriodoAtu' where
                 \"ano-periodo\" = '$anoMes' and \"mo-codigo\" = '$indicador' ";
        
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_comumw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comumw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $acao = '';
    $aCotEms2 = $this->getCotacaoEms2($indicador, $data);
    $logAchou = $aCotEms2['log_achou'];
    if ($logAchou == 1) {
        $this->atualizarCotacaoEms2($indicador, $data, $valor);
        $acao = 'atualizar';
    } else {
        $this->inserirCotacaoEms2($indicador, $data, $valor);
        $acao = 'inserir';
    }
    return $acao;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCotacaoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $logAchou = 0;
    $vlCotacao = 0;
    if ($logConvSerie == true) {
        $serie = $this->convSerieEmIndicador($serie, 'ems2');
    }
    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);
    $anoPeriodo = $ano . $mes;
    $aReg = $this->getReg('comum', 'cotacao', '"mo-codigo","ano-periodo"',
        "$serie,'$anoPeriodo'");
    if (is_array($aReg)) {
        $logAchou = 1;
        $vlCotacao = $aReg[0]["cotacao_$dia"];
    }
    $aRetorno = array('vl_cotacao' => $vlCotacao, 'log_achou' => $logAchou);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCotacoesPeriodoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $logAchou = 0;
    $vlCotacao = 0;
    $cotacaoPeriodo = '';
    if ($logConvSerie == true) {
        $serie = $this->convSerieEmIndicador($serie, 'ems2');
    }

    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);
    $anoPeriodo = $ano . $mes;
    $aReg = $this->getReg('comum', 'cotacao', '"mo-codigo","ano-periodo"', "$serie,'$anoPeriodo'");
    if (is_array($aReg)) {
        $logAchou = 1;
        for ($i = 1; $i <= 31; $i++) {
            $vlCotacao = $aReg[0]["cotacao_$i"];
            $cotacaoPeriodo = $this->util_incr_valor($cotacaoPeriodo, $vlCotacao, ";");
        }
    }
    $aRetorno = array('cotacao_periodo' => $cotacaoPeriodo, 'log_achou' => $logAchou);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCotacaoEms5($serie, $data)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cotacao = 0;
    $logAchou = 0;
    $aReg = $this->getReg('ems5', 'cotac_parid', 'cod_indic_econ_base,cod_indic_econ_idx',
        "'real','$serie'", 'val_cotac_indic_econ', "dat_cotac_indic_econ = '$data'");
    if (is_array($aReg)) {
        $aReg = $aReg[0];
        $cotacao = $aReg['val_cotac_indic_econ'];
        $logAchou = 1;
    }

    $aRetorno = array('vl_cotacao' => $cotacao, 'log_achou' => $logAchou);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function inserirCotacaoEms5($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $hoje = date('Y-m-d');
    $agora = date('H:i:s');
    $usuarioEms = getUsuarioCorrenteEms();
    $cmd = "insert into pub.cotac_parid(cod_indic_econ_base,cod_indic_econ_idx,dat_cotac_indic_econ,val_cotac_indic_econ,
            ind_tip_cotac_parid,cod_usuar_ult_atualiz,dat_ult_atualiz,hra_ult_atualiz)values('real','$serie','$data', $valor,
            'venda','$usuarioEms','$hoje','$agora') ";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_ems5w->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5w->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function inserirCotacaoEms2($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);
    $anoMes = $ano . $mes;
    $cotacao = '';
    $repet = $dia - 1;
    if ($repet > 0) {
        $cotacao = str_repeat('0;', $repet);
    }
    $repet = 31 - $dia;
    $vlRepet = str_repeat("$valor;", $repet);
    $vlRepet = substr($vlRepet, 0, strlen($vlRepet) - 1);
    $cotacao = $this->util_incr_valor($cotacao, $vlRepet,'');
    $cmd = "insert into pub.cotacao(\"ano-periodo\",\"mo-codigo\",cotacao)values($anoMes,$serie,'$cotacao')";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_comumw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comumw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarCotacaoEms($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $indicador = $this->convSerieEmIndicador($serie, 'ems2');
    $this->sincrCotacaoEms2($indicador, $data, $valor);
    $indicador = $this->convSerieEmIndicador($serie, 'ems5');
    $this->sincrCotacaoEms5($indicador, $data, $valor);


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convSerieEmIndicador($serie, $destino)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $indicador = '';
    switch ($destino) {
        case 'ems2':
            switch ($serie) {
                case 1:
                    $indicador = '3';
                    break;
            }
            break;
        case 'ems5':
            switch ($serie) {
                case 1:
                    $indicador = 'dolar';
                    break;
            }
            break;

    }
    return $indicador;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function diaDaSemana($data,$retorno=0,$formato='aaaa-mm-dd')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
     
    $data = $this->nm_conv_data_db($data,$formato,'aaaa-mm-dd');
    $dia =  substr($data,8,2);
    $mes =  substr($data,5,2);
    $ano =  substr($data,0,4);
    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano));
    switch($diasemana){
        case"0":
            $nDiasemana = "Domingo";
            $diaSemanaAbrev = "Dom";
            break;
        case"1":
            $nDiasemana = "Segunda-Feira";
            $diaSemanaAbrev = "Seg";
            break;
        case"2":
            $nDiasemana = "Terça-Feira";
            $diaSemanaAbrev = "Ter";
            break;
        case"3":
            $nDiasemana = "Quarta-Feira";
            $diaSemanaAbrev = "Qua";
            break;
        case"4":
            $nDiasemana = "Quinta-Feira";
            $diaSemanaAbrev = "Qui";
            break;
        case"5":
            $nDiasemana = "Sexta-Feira";
            $diaSemanaAbrev = "Sex";
            break;
        case"6":
            $nDiasemana= "Sábado";
            $diaSemanaAbrev = "Sab";
            break;
    }
    switch($retorno){
        case 0:
            return $nDiasemana;
            break;
        case 1:
            return $diasemana;
            break;
        case 2:
            return $diaSemanaAbrev;
            break;
        default:
            return $nDiasemana;
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function converterDataBra($data)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aData = explode("-",$data);
    return $aData[2]."/".$aData[1]."/".$aData[0];



$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function converterHoraEmMinutos($hora)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $aQtMinutos = explode(':',$hora);
    if(is_array($aQtMinutos) and count($aQtMinutos) == 3){
        $qtMinutos = $aQtMinutos[0] * 60 + $aQtMinutos[1] + $aQtMinutos[2] / 60;
    }
    else{
        $qtMinutos = 0;
    }
    return $qtMinutos;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function converterMinutosEmHoras($minutos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $hora = round($minutos / 60,0);
    if($hora < 1){
        $hora = 0;
    }
    $hora = preencherZerosAEsquerda ($hora,2);
    $min =  round($minutos % 60,0);
    $min = preencherZerosAEsquerda ($min,2);
    $formato_hora = "$hora:$min:00";
    return $formato_hora;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $dia = substr($data,8,2);
    $mes = substr($data,5,2);
    $ano = substr($data,0,4);
    if($dia <= 15){
        $quinzena = "1ª Quinzena";
    }else{
        $quinzena = "2ª Quinzena";
    }
    $mes = $this->convMes($mes);
    $retorno = "$quinzena/$mes";
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retAbrev = '';
    $retCompl = '';
    $retorno  = '';
    switch ($mes){
        case '01':
            $retAbrev = "Jan";
            $retCompl = "Janeiro";
            break;
        case '02':
            $retAbrev = "Fev";
            $retCompl = "Fevereiro";
            break;
        case '03':
            $retAbrev = "Mar";
            $retCompl = "Março";
            break;
        case '04':
            $retAbrev = "Abr";
            $retCompl = "Abril";
            break;
        case '05':
            $retAbrev = "Mai";
            $retCompl = "Maio";
            break;
        case '06':
            $retAbrev = "Jun";
            $retCompl = "Junho";
            break;
        case '07':
            $retAbrev = "Jul";
            $retCompl = "Julho";
            break;
        case '08':
            $retAbrev = "Ago";
            $retCompl = "Agosto";
            break;
        case '09':
            $retAbrev = "Set";
            $retCompl = "Setembro";
            break;
        case '10':
            $retAbrev = "Out";
            $retCompl = "Outubro";
            break;
        case '11':
            $retAbrev = "Nov";
            $retCompl = "Novembro";
            break;
        case '12':
            $retAbrev = "Dez";
            $retCompl = "Dezembro";
            break;
    }
    switch($tipo)
    {
        case 'abrev':
            $retorno = $retAbrev;
            break;
        case 'completo':
            $retorno = $retCompl;
            break;

    }
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getParteDataAMD($data,$parte)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = '';
    switch ($parte){
        case 'dia':
            $retorno = substr($data,8,2);
            break;
        case 'mes':
            $retorno = substr($data,5,2);
            break;
        case 'ano':
            $retorno = substr($data,0,4);
            break;
    }
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor= 1;
    $dataCotacao = '';
    $campoRetorno = '"vl-dolar-venda"';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno,
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){
        $aUltCotacao = $this->getDadosUltCotacao();
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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
                    $aCotacao = $this->getDadosUltCotacao();
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $this->situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $this->situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


    $vlTotPagoDolar     = $this->buscarTotPagoContainer($container,'dolar');
    $vlTotPagoReal      = $this->buscarTotPagoContainer($container);
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
    
    
    $aTotDescontoCreditosUtiliz      = $this->buscarDescontosCreditosUtiliz($container);
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
    $aTotDescontoUtiliz 				  = $this->buscarDescontosUtiliz($container);
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = " update \"pp-container\" set dt_prev_embarque = '$dtPrevEmbarque' 
			where \"nr-container\" = $containerID ";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDadosDescontos($descontoId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $tabela   = "pub.descontos_importacao";
    $campos   = 'motivo_desconto_id, descricao, log_credito, cod_tipo, dt_autorizacao, fornecedor_id';
    $condicao = " desconto_importacao_id = $descontoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlsDescontosPorFornecedor($fornecedor=0 )
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $condicaoFornec = '';
    if($fornecedor <> 0){
        $condicaoFornec = "fornecedor_id = $fornecedor";
    }
    $tabela = "pub.descontos_importacao";
    $campos = "desconto.fornecedor_id as fornecedor_id , coalesce(sum(desconto.vl_dolar),0) as vl_desconto,
              coalesce(sum(desconto.vl_dolar_autorizado),0) as vl_autorizado, 
              coalesce(sum(cta_corren.valor_utilizado),0) as vl_utiliz ";
    $condicao = " $condicaoFornec group by desconto.fornecedor_id";
    $inner = "left outer join pub.cta_corren_desconto cta_corren
              on cta_corren.desconto_importacao_id = desconto.desconto_importacao_id";
    $aRetorno = $this->retornoMultReg($tabela,$campos,$condicao,'espec',$inner);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescontosUtiliz($container,$itemContainerId='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
    $aValores = array();
    $lAchou = 0;
    $tabelas = 'pub.descontos_importacao d,pub.itens_container i, pub.motivos_desconto m';
    $campos  = 'sum(d.vl_dolar) as tot_dolar,sum(d.vl_real) as tot_real';
    $condicao = "i.container_id = '$container'  and log_credito = 0
                 and d.item_container_id = i.item_container_id
				 and d.motivo_desconto_id = m.motivo_desconto_id
				 and m.log_considerar_custo = 1";
    if($itemContainerId != ''){
        $condicao .= " and d.item_container_id = '$itemContainerId'";
    }
    $aDadosDesconto = $this->retornoSimplesTb01($tabelas,$campos,$condicao,"espec");
    if(is_array($aDadosDesconto)){
        $totDolar = $aDadosDesconto[0]['tot_dolar'];
        $totReal = $aDadosDesconto[0]['tot_real'];
        if($totDolar == ''){
            $totDolar = 0;
        }
        if($totReal == ''){
            $totReal = 0;
        }
        $aValores[] = array('tot_dolar'=> $totDolar,'tot_real'=>$totReal);
        $lAchou = 1;
    }
    if($lAchou == 0){
        $aValores = '';
    }
    return $aValores;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescontosCreditosUtiliz($container){
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aValores = array();
    $lAchou = 0;
    $tabelas = 'pub.cta_corren_desconto c, pub.descontos_importacao d';
    $campos  = 'sum(c.valor_utilizado) as tot_dolar_utiliz,
                sum(c.valor_utilizado * d.vl_cotacao_dolar) as tot_real_utiliz';
    $condicao = "
                log_credito              = 1                
                and c.desconto_importacao_id = d.desconto_importacao_id
                and c.container_id           = $container   
                ";
    $aDadosDesconto = $this->retornoSimplesTb01($tabelas,$campos,$condicao,"espec");
    if(is_array($aDadosDesconto)){
        $totDolar = $aDadosDesconto[0]['tot_dolar_utiliz'];
        $totReal =  $aDadosDesconto[0]['tot_real_utiliz'];
        $aValores[] = array('tot_dolar_utiliz'=>$totDolar,'tot_real_utiliz'=>$totReal);
        $lAchou = 1;
    }
    if($lAchou == 0){
        $aValores = '';
    }
    return $aValores;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function validarVlAprovadoEmReal($vlReal,$vlRealAutoriz)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlRealAutoriz > $vlReal){
        $erro = 'ERRO.O Valor Aprovado em Real não pode ser maior que o Valor Solicitado em Real';
    }
    return $erro;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function validarVlAprovadoEmDolar($vlDolar,$vlDolarAutoriz)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlDolarAutoriz > $vlDolar){
        $erro = 'ERRO. O Valor Aprovado em Dólar não pode ser maior que o Valor Solicitado em Dólar';
    }
    return $erro;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function validarVlsAutorizacao($vlDolarAutoriz, $vlRealAutoriz, $dtAutoriz)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if(($vlDolarAutoriz <> 0 and $vlDolarAutoriz <> '')
        or ($vlRealAutoriz <> 0 or $vlRealAutoriz <> '')
        and $dtAutoriz == ''){
        $erro = 'É necessário informar a data de autorização quanto o valor de autorização for
				preenchido';
    }
    if(
        (
            ($vlDolarAutoriz <> 0 and $vlDolarAutoriz <> '') and
            ($vlRealAutoriz == 0 or $vlRealAutoriz == '')
        ) or
        (
            ($vlDolarAutoriz == 0 and $vlDolarAutoriz == '') and
            ($vlRealAutoriz <> 0 or $vlRealAutoriz <> '')
        )
    ){
        $erro = 'É necessário informar o valor autorizado em Dólar e Real';
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlSaldoUtilizar($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = 0;
    $vlDolar = $this->buscarVlDolarAutorizDesconto($descontoImportacaoId);
    $vlUtilizado = $this->buscarDescontoTotalUtilizado($descontoImportacaoId);
    $retorno = $vlDolar - $vlUtilizado;

    return $retorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescontoTotalUtilizado($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
     $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.cta_corren_desconto ',
                                   ' sum(valor_utilizado) as valor ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["valor"];
    return $retorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlDolarAutorizDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
                                   ' vl_dolar_autorizado ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["vl_dolar_autorizado"];

    return $retorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarFornecDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
        ' fornecedor_id ',
        " desconto_importacao_id = $descontoImportacaoId ", 'espec');
    if (is_array($aRetorno))
        $retorno = $aRetorno[0]["fornecedor_id"];

    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getVlDescAutorizado($fornecedor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vlSoma   = 0;
    $tipo     = "unico"; 
    $tabela   = " pub.descontos_importacao d  ";
    $inner    = "  left outer join pub.cta_corren_desconto c on d.desconto_importacao_id = c.desconto_importacao_id";
    $campos   = " coalesce(sum(d.vl_dolar_autorizado)|0) as vl_autoriz, coalesce(sum(valor_utilizado)|0) as vl_utiliz ";
    $condicao = " fornecedor_id = $fornecedor  ";
    $aTot = $this->getDados($tipo,$tabela,$campos,$condicao,'espec',$inner);
    if(is_array($aTot)){
        $vlSoma += $aTot[0]['vl_autoriz'] - $aTot[0]['vl_utiliz'];
    }
    return $vlSoma;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesaLogImpostoOuCalc($despesaId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesaDescr($despesaId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = '';
    $aRetorno = $this->retornoSimplesTb01('pub.despesas','descricao'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["descricao"];
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesasImposto($imposto_id,$empresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.despesas_impostos", "despesa_id", " empresa_id = $empresa and imposto_id = $imposto_id","espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getIdsRelacDespCalculadas($despesa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = "update pub.despesas_container set vl_prev = '$vlPrev', vl_negociado = $vlNegociado,
             vl_proforma = $vlProforma
            where despesa_container_id = $despesaContainerId";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = '';
    if($campos <> ''){
        $cmd = "update pub.despesas_container set $campos where despesa_id = $despesaId and container_id = $containerId";
        
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }else{
        $retorno = 'Campos não informados';
    }
    return $retorno;
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $id = $this->buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId);
    if($id <> 0) {
        $cmd = "delete from pub.despesas_container where  despesa_container_id = $id ";
        
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $id;
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_container ", " max(calc_imp_container_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) { $_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.calcs_imp_container', 'desc_memoria_calc',"calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $mem_calc = $aRetorno[0]['desc_memoria_calc'].$mem_calc;
    }

    $cmd = "update pub.calcs_imp_container set desc_memoria_calc = '$mem_calc'  where calc_imp_container_id = $calc_id ";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
     
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
    

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $despesaId = buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = $this->getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDespesasEmp($empresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = array();

    $aRetorno = $this->retornoMultReg('pub.empresas_despesa emp_desp INNER JOIN pub.despesas desp
                               ON emp_desp.despesa_id = desp.despesa_id',
        'emp_desp.despesa_id, emp_desp.vl_padrao, desp.perc_calculo',
        " emp_desp.log_ativo = 1 and desp.log_imposto = 0
							  and emp_desp.empresa_id = $empresa","espec");

    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarImpostosEmpresa($empresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id, pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 
        and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 
        and pub.empresas_despesa.empresa_id = $empresa and pub.despesas.log_calc_por_item = 0","espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarImpostoPerc($despesa,$empresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarImpostoPercCusto($despesaID,$empresa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDadosEmpresaDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescFornecedor($fornecedor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarNomeAbrevFornecedor($fornecedor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
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
    $fornec = $this->buscarFornecItemProcCompra($itemProcCompra);
    return $fornec;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $procCompraId = 0;
    $tabela = "pub.itens_container";
    $campos = "item_proc_compra_id";
    $condicao = "item_container_id = $itemContainerID";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aValores)){
        $itemProcCompra = $aValores[0]['item_proc_compra_id'];
        $procCompraId = $this->buscarProcCompraItem($itemProcCompra);
    }
    return $procCompraId;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $contAloc = 0;
    $logItensExistente = false;
    if(is_array($aItens)){
        $tot = count($aItens);
        for($x = 0; $x < $tot; $x++){
            $itemID           = $aItens[$x]['ID'];
            $qtAlocada        = $this->buscarQtAlocItemProc($itemID);
            $logJaSelecionado = $this->buscarItemAlocado($container_id,$itemID);
            $qtComprada       = $aItens[$x]['qt_comprada'];
            $qtDisponivel     = $qtComprada - $qtAlocada;
            if($logJaSelecionado == false){
                $cmd = "insert into pub.itens_container(item_container_id,container_id,item_proc_compra_id,qt_alocada)
                     values(pub.seq_itens_container.NEXTVAL, $container_id,$itemID,$qtDisponivel) ";
                
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aCustoItens                    	 = array();
    $lAchou                              = false;
    $vlPagoItens                	     = $this->buscarTotPagoContainer($containerId);
    $aPondItens             	         = buscarValoresItensNFImp($containerId);
    $listaNatOperNfMae                   = getListaNatOperNotaMae();
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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
    


    $aTotDescontoCreditosUtiliz      = $this->buscarDescontosCreditosUtiliz($container);
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

            $aTotDescontoUtiliz 		= $this->buscarDescontosUtiliz($container,$itemContainerID);
            $vlDescontoUtilizDOLAR      = $aTotDescontoUtiliz[0]['tot_dolar'];
            $vlDescontoUtilizREAL       = $aTotDescontoUtiliz[0]['tot_real'];


            $itemProcCompraID 			= $aItens[$j]['item_proc_compra_id'];
            $qtAlocada        			= $aItens[$j]['qt_alocada'];
            $qtConfirmEmb      			= $aItens[$j]['qt_confirm_emb'];
            $qtRecbtoFisico      		= $aItens[$j]['qt_recbto_fisico'];
            $vlItemProcCompra 			= $this->buscarVlItemProcCompra($itemProcCompraID,$tipoCusto);

            
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


            


            $codItem                = $this->buscarCodItemERP($itemProcCompraID);

            

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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = " update pub.item_container_custos set item_custo_id = $item_custo_id
			where item_container_custo_id = $item_container_custos_id";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = false;
    $aItens = $this->buscarIDItensContainer($container);
    $tam = count($aItens);
    if(is_array($aItens) and $tam > 0){
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $codErp = $this->buscarCodItemERP($itemProcCompraId);
            if($codErp == ''){
                $retorno = true;
                break;
            }
        }
    }
    return $retorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
        $vlNegociado = $this->buscarVlItemProcCompra($itemProcCompraId,'negociado');
        inserirLogDb('vl.negociado - funcao $this->buscarVlItemProcCompra(item do pedido,tipo=negociado) ',
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
                    $fornec = $this->buscarFornecItemProcCompra($itemProcCompraId);

                    inserirLogDb('fornecedor do container - funcao $this->buscarFornecItemProcCompra(itemProccompraId)',"$fornec(itemProcCompra:$itemProcCompraId)",__FUNCTION__);
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vl = 0;
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_real';
            break;
        case 'tributado':
            $campo = 'pub.itens_proc_compra.vl_base_tributacao';
            break;
    }
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', $campo ,
                                   " item_proc_compra_id = $itemProcCompraId","espec");
    if(is_array($aRetorno)){
        $vl =  $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $fornec = 0;
    $tabelas = "pub.itens_proc_compra, pub.procs_compra";
    $campos  = "fornecedor_id";
    $condicao = "pub.itens_proc_compra.item_proc_compra_id = $itemProcCompra and pub.itens_proc_compra.proc_compra_id = procs_compra.proc_compra_id ";
    $aRetorno = $this->retornoSimplesTb01($tabelas,$campos, $condicao,"espec");
    if(is_array($aRetorno)){
        $fornec = $aRetorno[0]['fornecedor_id'];
    }
    if($fornec == ''){
        $fornec = 0;
    }
    return $fornec;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'pub.itens_proc_compra.vl_negociado';
            break;
        case 'proforma':
            $campo = 'pub.itens_proc_compra.vl_custo_real';
            break;
        case 'tributado':
            $campo = 'pub.itens_proc_compra.vl_base_tributacao';
            break;

    }
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra, pub.procs_compra",
                                   "sum(pub.procs_compra.cotacao_prevista * pub.itens_proc_compra.qt_comprada 
	  * $campo) as tot " , "  pub.procs_compra.proc_compra_id = pub.itens_proc_compra.proc_compra_id
	  and pub.procs_compra.proc_compra_id = $proc_compra_id","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    if($valor == ''){
        $valor = 0;
    }
    return $valor;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'sum(qt_alocada) as qt', " item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
        if($qt == ''){
            $qt = 0;
        }

    }
    else{
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vlTot = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_dolar';
            break;
    }
    if($itemProcCompraId <> 0){
       $condItem = " and item_proc_compra_id = $itemProcCompraId ";
    }else{
        $condItem = '';
    }
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra',
        "sum($campo * qt_comprada) as tot",
        " proc_compra_id = $procCompraID $condItem","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vlTot = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_dolar';
            break;
    }
    $aRetorno = $this->retornoMultReg('pub.itens_proc_compra ipc',
                               "ipc.item_proc_compra_id, ipc.vl_negociado * ipc.qt_comprada as vl_comprada, 
                  ipc.vl_negociado * coalesce(ic.qt_confirm_emb,0) as vl_embarcada ",
                               " proc_compra_id = $procCompraID ",
                               "espec",
                               "left outer join pub.itens_container ic on ic.item_proc_compra_id = ipc.item_proc_compra_id ");
    if(is_array($aRetorno)){
        $qt = count($aRetorno);
        $vlTot = 0;
        for($i=0;$i < $qt; $i++){
            $vlComprada  = $aRetorno[$i]['vl_comprada'];
            $vlEmbarcada = $aRetorno[$i]['vl_embarcada'];
            if($vlEmbarcada <> 0){
                $vlTot += $vlEmbarcada;
            }else{
                $vlTot += $vlComprada;
            }
        }
    }
    return $vlTot;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $msg = '';
    $aRet = $this->getDados('unico','pub.itens_proc_compra',
        'top 1 item_proc_compra_id as item_proc_compra_id,vl_custo_dolar,vl_base_tributacao,vl_negociado',
    "proc_compra_id =$procCompraId and codigo_erp = '$itCodigo' and item_proc_compra_id <> $idCorrente and codigo_erp <> ''
    ");
    if(is_array($aRet)){
        $aRet = $aRet[0];
        $idItemProcCompra = $aRet['item_proc_compra_id'];
        if($aRet['vl_custo_dolar'] <> $vlCustoDolar and $aRet['vl_custo_dolar'] <> 0 ){
            $msg = $this->util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de custo de dolar diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_base_tributacao'] <> $vlBaseTributacao and $aRet['vl_base_tributacao'] <> 0){

            $msg = $this->util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de base de tributação diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_negociado'] <> $vlNegociado and $aRet['vl_negociado'] <> 0){

            $msg = $this->util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor negociado diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");
        }

    }
    return $msg;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
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
if (isset($this->sc_temp_link_log)) { $_SESSION['link_log'] = $this->sc_temp_link_log;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $listaIdTitulos = ''; 
    $aRetorno = $this->retornoMultReg('pub.pagtos_container','num_id_tit_ap', " container_id = $containerId order by num_id_tit_ap ","espec" );
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vl = 0;
    $listaIDTitulos     = $this->buscarTitAssociadosContainer($containerId);
    
    $aTitulos 			  = explode(",",$listaIDTitulos);
    if(is_array($aTitulos)){
        for($i=0;$i < count($aTitulos);$i++){
            $titID = $aTitulos[$i];
            if($titID == ''){$titID = 0;}
            switch($moeda){
                case 'dolar':
                    $vl_tit_corrente = $this->buscarVlMoeda($titID,'','dolar');
                    break;
                default:
                    $vl_tit_corrente = $this->buscarVlMoeda($titID);
            }
            $vl += $vl_tit_corrente;
        }
    }
    return $vl;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $vl = 0;
    $aTitulos = explode(",",$lista);
    if(is_array($aTitulos)){
        for($i=0;$i < count($aTitulos);$i++){
            $titID = $aTitulos[$i];
            if($titID == ''){$titID = 0;}
            switch($moeda){
                case 'dolar':
                    $vl_tit_corrente = $this->buscarVlMoeda($titID,'','dolar');
                    break;
                default:
                    $vl_tit_corrente = $this->buscarVlMoeda($titID);
            }
            $vl += $vl_tit_corrente;
        }
    }
    return $vl;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (!isset($this->sc_temp_container_corrente)) {$this->sc_temp_container_corrente = (isset($_SESSION['container_corrente'])) ? $_SESSION['container_corrente'] : "";}
if (!isset($this->sc_temp_empresa_container_corrente_ems5)) {$this->sc_temp_empresa_container_corrente_ems5 = (isset($_SESSION['empresa_container_corrente_ems5'])) ? $_SESSION['empresa_container_corrente_ems5'] : "";}
if (!isset($this->sc_temp_fornecedor_container_corrente)) {$this->sc_temp_fornecedor_container_corrente = (isset($_SESSION['fornecedor_container_corrente'])) ? $_SESSION['fornecedor_container_corrente'] : "";}
  
    
    if($this->sc_temp_fornecedor_container_corrente != ''){
        if($condicaoTitAP != '')$operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador." cdn_fornecedor =". $this->sc_temp_fornecedor_container_corrente;

    }

    if($this->sc_temp_empresa_container_corrente_ems5 != ''){
        if($condicaoTitAP != '') 	  $operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador."  cod_empresa =". $this->sc_temp_empresa_container_corrente_ems5;

    }

    if($logPgtoPosDI){
        $dtEmisDocto = buscarDtEmisNotaMaeContainer($this->sc_temp_container_corrente);
    }else{
        $dtEmisDocto = $this->buscarDtRegContainer($this->sc_temp_container_corrente);
    }
    if( $dtEmisDocto != ''){
        if($condicaoTitAP != '') 	  $operador = " and ";
        else $operador = " ";
        $condicaoTitAP .=  $operador."   dat_emis_docto >= '$dtEmisDocto'" ;
    }


    return $condicaoTitAP;

if (isset($this->sc_temp_fornecedor_container_corrente)) { $_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
if (isset($this->sc_temp_empresa_container_corrente_ems5)) { $_SESSION['empresa_container_corrente_ems5'] = $this->sc_temp_empresa_container_corrente_ems5;}
if (isset($this->sc_temp_container_corrente)) { $_SESSION['container_corrente'] = $this->sc_temp_container_corrente;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($containerId <> 0){
        $condContainer = " and container_id = $containerId ";
    }else{
        $condContainer = "";
    }

    $tipo     = "unico"; 
    $tabela   = " pub.pagtos_container ";
    $campos   = " num_id_tit_ap ";
    $condicao = "  num_id_tit_ap = $numIdTitAp $condContainer";
    $aTit = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTit)){
        $logExiste = true;
    } else{
        $logExiste = false;
    }
    return $logExiste;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $container = 0;
    $tipo     = "unico"; 
    $tabela   = " pub.pagtos_container ";
    $campos   = " container_id ";
    $condicao = "  num_id_tit_ap = $numIdTitAp";
    $aTit = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    if(is_array($aTit)){
        $container = $aTit[0]['container_id'];
    }
    return $container;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_container(num_id_tit_ap,container_id) values($numIdTitAp,$container)";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_container where num_id_tit_ap = $numIdTitAp and  container_id = $container" ;
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_pp_container_cotacoes_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    
    $cotacao = 0;
    $idUltTitulo = 0;
    $listaTitulos   = $this->buscarTitAssociadosContainer($container);
    $aTitulos       = explode(',',$listaTitulos);
    if(is_array($aTitulos) and $listaTitulos <> ''){
        $tam = count($aTitulos);
        $idUltTitulo = $aTitulos[$tam - 1];
        $vlTitDolar = $this->buscarVlMoeda($idUltTitulo,'','dolar');
        $vlTitReal  = $this->buscarVlMoeda($idUltTitulo,'','real');
        $cotacao = $vlTitReal / $vlTitDolar;

    }
    return $cotacao;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
if (!isset($this->sc_temp_fornecedor_container_corrente)) {$this->sc_temp_fornecedor_container_corrente = (isset($_SESSION['fornecedor_container_corrente'])) ? $_SESSION['fornecedor_container_corrente'] : "";}
   
    $filtroCompl = '';
    $lista = '';
    if(isset($this->sc_temp_fornecedor_container_corrente) and $this->sc_temp_fornecedor_container_corrente <> '' ){
        $filtroCompl = $this->util_incr_valor($filtroCompl," \"cod-emit-forn\" = $this->sc_temp_fornecedor_container_corrente ",
            " AND");
    }


    $condicao = "pagtos_container.container_id = container.\"nr-container\" ";
    $condicao = $this->util_incr_valor($condicao,$filtroCompl," AND ") ;

    $aDados = $this->getDados('multi','pub.pagtos_container pagtos_container, pub."pp-container" container',
        'num_id_tit_ap',$condicao,'espec');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $titulo = $aDados[$i]['num_id_tit_ap'];
            $lista = $this->util_incr_valor($lista,$titulo);
        }
    }
    return $lista;

if (isset($this->sc_temp_fornecedor_container_corrente)) { $_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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
      if ($SCrx = $this->Ini->nm_db_espec->Execute($nm_select)) 
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
          $this->meus_dados_erro = $this->Ini->nm_db_espec->ErrorMsg();
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

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
      if ($this->dados = $this->Ini->nm_db_espec->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_espec->ErrorMsg();
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $erro = '';
    $con  = '';
    $odbc = $this->getODBCDireto($conexaoSC);
    if($logOdbc){
        $odbc = "odbc:".$odbc;
    }
    try {
        $con = new PDO($odbc, $this->usuario, $senha);
    }catch(PDOException $exception){
        $erro = strtolower($exception->getMessage()) ;
    }
    return array('conexao'=> $con,'erro'=>$erro);


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
      if ($this->dados = $this->Ini->nm_db_espec->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Ini->nm_db_espec->ErrorMsg();
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $this->usuario = '';
    $aCon =$this->conectarBase($conexaoSC);
    $cmd = $this->convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas);
    $ret = $this->execAcaoPDO($cmd,$aCon,'cmd');
    $erro = $ret['erro'];
    $lock = strstr($erro,'failure getting record lock')? 1 : 0;
    if($lock == 1){
        $this->usuario = $this->getUsuarioLock($tabela,$conexaoSC);
        
    }
    return array('resultado'=> $ret,'erro'=>$erro,'lock'=>$lock,'usuario_lock'=>$this->usuario);

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aCon       = getDadosConexao($nomeBanco);
    $servidor   = $aCon['server'];
    $this->usuario    = $aCon['user'];
    $senha      = $aCon['password'];
    $conexao    = $this->conectarBase(
        "mysql:host=$servidor;dbname=$nomeBanco",
        $this->usuario,
        $senha,
        false);
    return $conexao;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
        $this->usuario = $reg['USUARIO'];
    }else{
        $this->usuario = '';
    }
    return $this->usuario;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlMoeda($numIdTitAp,$codEstab='',$moeda='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getEspecsAdiant()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $param = buscarParametroIma("especs_adiant_importacao");
    if ($param == '') {
        $especs = "'AF'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function getEspecsTit()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $param = buscarParametroIma("especs_tit_importacao");
    if ($param == '') {
        $especs = "'DI'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarDadosTitulo($numTitAp,$codEstab='')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $condicao = " num_id_tit_ap = $numTitAp  ";
    if($codEstab <> ''){
        $condicao .= " and cod_estab = '$codEstab'";
    }
    $tabela = 'pub.tit_ap';
    $campo  = 'cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela,dat_emis_docto,
	dat_vencto_tit_ap,dat_liquidac_tit_ap,cod_estab';

    return $this->retornoSimplesTb01($tabela,$campo,$condicao,"ems5");


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.CURRVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->seq = array();
      if ($SCrx = $this->Ini->nm_db_espec->Execute($nm_select)) 
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
          $this->seq_erro = $this->Ini->nm_db_espec->ErrorMsg();
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.NEXTVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
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
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
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
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_pp_container_cotacoes';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_pp_container_cotacoes';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
    }
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['form_pp_container_cotacoes']['contr_erro'] = 'off';
}
//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_pp_container_cotacoes_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_pp_container_cotacoes_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("sc_field_0", "sc_field_1", "sc_field_2", "sc_field_3", "narrativa", "usuario", "sc_field_4", "sc_field_5", "sc_field_6", "sc_field_7", "sc_field_8", "sc_field_9", "sc_field_10", "comprador", "sc_field_11", "sc_field_12", "situacao", "sc_field_13", "sc_field_14", "sc_field_15", "exclusivo"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat, $value)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       if ('now' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array(date('H'), date('i'), date('i'), date('s')), $sTime);
       } elseif ('end' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array('23', '59', '59', '59'), $sTime);
       } else {
           return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
       }
   } // jqueryCalendarTimeStart

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

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_pp_container_cotacoes_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "sc_field_0") 
          {
              $this->SC_monta_condicao($comando, "\"num-pedido\"", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_1") 
          {
              $data_lookup = $this->SC_lookup_sc_field_1($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "\"cod-estabel\"", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_2") 
          {
              $this->SC_monta_condicao($comando, "\"nome-ab-forn\"", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_3") 
          {
              $this->SC_monta_condicao($comando, "\"cod-emit-forn\"", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "narrativa") 
          {
              $this->SC_monta_condicao($comando, "narrativa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "usuario") 
          {
              $this->SC_monta_condicao($comando, "usuario", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_4") 
          {
              $this->SC_monta_condicao($comando, "\"dt-compra\"", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_5") 
          {
              $this->SC_monta_condicao($comando, "\"char-1\"", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_6") 
          {
              $this->SC_monta_condicao($comando, "\"dec-1\"", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_7") 
          {
              $this->SC_monta_condicao($comando, "\"int-1\"", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_8") 
          {
              $this->SC_monta_condicao($comando, "\"log-1\"", $arg_search, str_replace(",", ".", $data_search), "BIT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_9") 
          {
              $this->SC_monta_condicao($comando, "\"data-1\"", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_10") 
          {
              $this->SC_monta_condicao($comando, "\"nr-container\"", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "comprador") 
          {
              $this->SC_monta_condicao($comando, "comprador", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_11") 
          {
              $this->SC_monta_condicao($comando, "\"dt-recebimento\"", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_12") 
          {
              $this->SC_monta_condicao($comando, "\"dt-prev-chegada\"", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "situacao") 
          {
              $this->SC_monta_condicao($comando, "situacao", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_13") 
          {
              $this->SC_monta_condicao($comando, "\"vlr-frete\"", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_14") 
          {
              $this->SC_monta_condicao($comando, "\"vlr-seguro\"", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "sc_field_15") 
          {
              $this->SC_monta_condicao($comando, "\"vlr-despesas\"", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "exclusivo") 
          {
              $this->SC_monta_condicao($comando, "exclusivo", $arg_search, str_replace(",", ".", $data_search), "BIT", false);
          }
      }
      if ($this->NM_case_insensitive)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $comando = str_replace("#lowerI#", "UCase(", $comando);
          }
          else
          {
              $comando = str_replace("#lowerI#", "Upper(", $comando);
           }
          $comando = str_replace("#lowerF#", ")", $comando);
      }
      else
      {
          $comando = str_replace("#lowerI#", "", $comando);
          $comando = str_replace("#lowerF#", "", $comando);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter_form'] . " and ((\"nr-container\" = " . $_SESSION['container_corrente'] . ")) and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where (\"nr-container\" = " . $_SESSION['container_corrente'] . ") and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_pp_container_cotacoes = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] = $qt_geral_reg_form_pp_container_cotacoes;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_pp_container_cotacoes_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_pp_container_cotacoes_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $nm_esp_postgres = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "\"num-pedido\"";$nm_numeric[] = "\"cod-emit-forn\"";$nm_numeric[] = "\"dec-1\"";$nm_numeric[] = "\"int-1\"";$nm_numeric[] = "\"log-1\"";$nm_numeric[] = "\"nr-container\"";$nm_numeric[] = "situacao";$nm_numeric[] = "\"vlr-frete\"";$nm_numeric[] = "\"vlr-seguro\"";$nm_numeric[] = "\"vlr-despesas\"";$nm_numeric[] = "exclusivo";$nm_numeric[] = "\"vl-dolar-venda\"";$nm_numeric[] = "\"vl-dolar-compra\"";$nm_numeric[] = "log_liberar_custo_realizado";$nm_numeric[] = "situacao_container_id";$nm_numeric[] = "ind_dt_embarque";$nm_numeric[] = "ind_dt_prev_chegada";$nm_numeric[] = "log_pagto_final";$nm_numeric[] = "cod_agente_cargas";$nm_numeric[] = "cod_armador";$nm_numeric[] = "cod_tipo_calculo";$nm_numeric[] = "perc_custo";$nm_numeric[] = "vl_dolar_di";$nm_numeric[] = "log_gerar_saldo_a_pagar";$nm_numeric[] = "log_gerar_distr_custo";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
      }
      if (is_array($campo)) {
          foreach ($campo as $Ind => $Cmp) {
             if ($Cmp != null) {
                 $campo[$Ind] = substr($this->Ini->Db->qstr($Cmp), 1, -1);
             }
          }
      }
      else {
          $campo = substr($this->Ini->Db->qstr($campo), 1, -1);
      }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR(255))";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
      $Nm_datas["\"dt-compra\""] = "date";$Nm_datas["\"data-1\""] = "date";$Nm_datas["\"dt-recebimento\""] = "date";$Nm_datas["\"dt-prev-chegada\""] = "date";$Nm_datas["dt_prev_embarque"] = "date";$Nm_datas["dt_real_embarque"] = "date";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
         if (isset($Nm_datas[$campo_join]))
          {
            $nm_ini_lower = "";
             $nm_fim_lower = "";
          }
          if (isset($Nm_datas[$campo_join]))
          {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
          if (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif ($Nm_datas[$campo_join] == "time" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(10)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(19)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "times" || $Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $nome  = "TO_DATE(TO_CHAR(" . $nome . ", 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO FRACTION)";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO DAY)";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
             {
                 $op_like      = " ilike ";
                 $nm_ini_lower = "";
                 $nm_fim_lower = "";
             }
             else
             {
                 $op_like = " like ";
             }
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_sc_field_1($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['1'] = "IMA";
       $data_look['5'] = "MED";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "form_pp_container_cotacoes_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_pp_container_cotacoes_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       form_pp_container_cotacoes_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-1");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-2", "sc_b_sai_t.sc-unique-btn-4", "sc_b_sai_t.sc-unique-btn-3");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-5");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-6");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-7");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-8");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
#lin1_col1 { padding-left:1px; padding-top:0px;  height:9px; overflow:hidden; text-align:left;color:black;}			 
#lin1_col2 { padding-right:1px; padding-top:0px; height:9px; text-align:left; overflow:hidden;   font-size:12px; font-weight:normal;color:black;}
</style>

<div width="100%" >	
 <div class="scFormHeader" style="height:11px; display: block; border-width:0px; "></div>
 <!--<div style="height:15px; border-width:0px 0px 1px 0px;  border-style: solid; border-color:#ddd; display: block">-->
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Container's"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Container's"; } ?> - 
<?php
$this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
echo $this->nm_data->FormataSaida("j/n/Y @?#?@à@?#?@s G:i:s");
?>
</span></td>            
        </tr>
    </table>		 
 </div>


    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function getSummaryLine()
    {
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info_simp'] . "]";
        $summaryLine = str_replace(
            [
                '?final?',
                '?total?',
            ],
            [
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container_cotacoes']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "\"nr-container\"":
                return true;
            case "\"vl-dolar-venda\"":
                return true;
            case "\"vl-dolar-compra\"":
                return true;
            case "":
                return true;
            case "\"num-pedido\"":
                return true;
            case "\"cod-emit-forn\"":
                return true;
            case "\"dec-1\"":
                return true;
            case "\"int-1\"":
                return true;
            case "situacao":
                return true;
            case "\"vlr-frete\"":
                return true;
            case "\"vlr-seguro\"":
                return true;
            case "\"vlr-despesas\"":
                return true;
            case "cod_agente_cargas":
                return true;
            case "cod_armador":
                return true;
            case "perc_custo":
                return true;
            case "vl_dolar_di":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "\"nr-container\"":
                return 'desc';
            case "\"vl-dolar-venda\"":
                return 'desc';
            case "\"vl-dolar-compra\"":
                return 'desc';
            case "\"num-pedido\"":
                return 'desc';
            case "\"cod-emit-forn\"":
                return 'desc';
            case "\"dt-compra\"":
                return 'desc';
            case "\"dec-1\"":
                return 'desc';
            case "\"int-1\"":
                return 'desc';
            case "\"data-1\"":
                return 'desc';
            case "\"dt-recebimento\"":
                return 'desc';
            case "\"dt-prev-chegada\"":
                return 'desc';
            case "situacao":
                return 'desc';
            case "\"vlr-frete\"":
                return 'desc';
            case "\"vlr-seguro\"":
                return 'desc';
            case "\"vlr-despesas\"":
                return 'desc';
            case "dt_prev_embarque":
                return 'desc';
            case "dt_real_embarque":
                return 'desc';
            case "situacao_container_id":
                return 'desc';
            case "ind_dt_embarque":
                return 'desc';
            case "ind_dt_prev_chegada":
                return 'desc';
            case "cod_agente_cargas":
                return 'desc';
            case "cod_armador":
                return 'desc';
            case "cod_tipo_calculo":
                return 'desc';
            case "perc_custo":
                return 'desc';
            case "vl_dolar_di":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
