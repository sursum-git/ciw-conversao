<?php
//
class form_proc_compra_apl
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
   var $proc_compra_id;
   var $empresa_id;
   var $empresa_id_1;
   var $qt_container;
   var $cod_situacao;
   var $cod_situacao_1;
   var $cod_proc_fornec;
   var $qt_dias_translado;
   var $cotacao_prevista;
   var $observacao;
   var $dt_registro;
   var $fornecedor_id;
   var $dt_limite;
   var $log_facilid_contato_fornec;
   var $log_facilid_contato_fornec_1;
   var $log_considerar_previsao;
   var $log_considerar_previsao_1;
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
          if (isset($this->NM_ajax_info['param']['cod_proc_fornec']))
          {
              $this->cod_proc_fornec = $this->NM_ajax_info['param']['cod_proc_fornec'];
          }
          if (isset($this->NM_ajax_info['param']['cod_situacao']))
          {
              $this->cod_situacao = $this->NM_ajax_info['param']['cod_situacao'];
          }
          if (isset($this->NM_ajax_info['param']['dt_limite']))
          {
              $this->dt_limite = $this->NM_ajax_info['param']['dt_limite'];
          }
          if (isset($this->NM_ajax_info['param']['dt_registro']))
          {
              $this->dt_registro = $this->NM_ajax_info['param']['dt_registro'];
          }
          if (isset($this->NM_ajax_info['param']['empresa_id']))
          {
              $this->empresa_id = $this->NM_ajax_info['param']['empresa_id'];
          }
          if (isset($this->NM_ajax_info['param']['fornecedor_id']))
          {
              $this->fornecedor_id = $this->NM_ajax_info['param']['fornecedor_id'];
          }
          if (isset($this->NM_ajax_info['param']['log_considerar_previsao']))
          {
              $this->log_considerar_previsao = $this->NM_ajax_info['param']['log_considerar_previsao'];
          }
          if (isset($this->NM_ajax_info['param']['log_facilid_contato_fornec']))
          {
              $this->log_facilid_contato_fornec = $this->NM_ajax_info['param']['log_facilid_contato_fornec'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_arg_fast_search']))
          {
              $this->nmgp_arg_fast_search = $this->NM_ajax_info['param']['nmgp_arg_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_cond_fast_search']))
          {
              $this->nmgp_cond_fast_search = $this->NM_ajax_info['param']['nmgp_cond_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_fast_search']))
          {
              $this->nmgp_fast_search = $this->NM_ajax_info['param']['nmgp_fast_search'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['observacao']))
          {
              $this->observacao = $this->NM_ajax_info['param']['observacao'];
          }
          if (isset($this->NM_ajax_info['param']['proc_compra_id']))
          {
              $this->proc_compra_id = $this->NM_ajax_info['param']['proc_compra_id'];
          }
          if (isset($this->NM_ajax_info['param']['qt_dias_translado']))
          {
              $this->qt_dias_translado = $this->NM_ajax_info['param']['qt_dias_translado'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
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
      if (isset($this->reg_ant_procs_compra) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['reg_ant_procs_compra'] = $this->reg_ant_procs_compra;
      }
      if (isset($_POST["reg_ant_procs_compra"]) && isset($this->reg_ant_procs_compra)) 
      {
          $_SESSION['reg_ant_procs_compra'] = $this->reg_ant_procs_compra;
      }
      if (isset($_GET["reg_ant_procs_compra"]) && isset($this->reg_ant_procs_compra)) 
      {
          $_SESSION['reg_ant_procs_compra'] = $this->reg_ant_procs_compra;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['embutida_parms']);
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
                 nm_limpa_str_form_proc_compra($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->reg_ant_procs_compra)) 
          {
              $_SESSION['reg_ant_procs_compra'] = $this->reg_ant_procs_compra;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['opc_ant']);
          }
          if (isset($this->reg_ant_procs_compra)) 
          {
              $_SESSION['reg_ant_procs_compra'] = $this->reg_ant_procs_compra;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_proc_compra_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_proc_compra']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_proc_compra']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_proc_compra'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_proc_compra']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_proc_compra']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_proc_compra') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_proc_compra']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Pedido de Compras";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_proc_compra")
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
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
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


      $this->arr_buttons['bt_log']['hint']             = "";
      $this->arr_buttons['bt_log']['type']             = "button";
      $this->arr_buttons['bt_log']['value']            = "Log's";
      $this->arr_buttons['bt_log']['display']          = "only_text";
      $this->arr_buttons['bt_log']['display_position'] = "text_right";
      $this->arr_buttons['bt_log']['style']            = "default";
      $this->arr_buttons['bt_log']['image']            = "";


      $_SESSION['scriptcase']['error_icon']['form_proc_compra']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_proc_compra'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      $this->nmgp_botoes['bt_log'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_proc_compra']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_proc_compra'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_proc_compra'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form'];
          if (!isset($this->qt_container)){$this->qt_container = $this->nmgp_dados_form['qt_container'];} 
          if (!isset($this->cotacao_prevista)){$this->cotacao_prevista = $this->nmgp_dados_form['cotacao_prevista'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['log_considerar_previsao'] != "null"){$this->log_considerar_previsao = $this->nmgp_dados_form['log_considerar_previsao'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_proc_compra", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'form_proc_compra/form_proc_compra_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_proc_compra_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_proc_compra_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_proc_compra_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_proc_compra/form_proc_compra_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_proc_compra_erro.class.php"); 
      }
      $this->Erro      = new form_proc_compra_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao']))
         { 
             if ($this->proc_compra_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_proc_compra']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['bt_log'] = "on";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['bt_log'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['botoes']['bt_log'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form'];
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
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_proc_compra']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_proc_compra']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->proc_compra_id)) { $this->nm_limpa_alfa($this->proc_compra_id); }
      if (isset($this->empresa_id)) { $this->nm_limpa_alfa($this->empresa_id); }
      if (isset($this->cod_situacao)) { $this->nm_limpa_alfa($this->cod_situacao); }
      if (isset($this->cod_proc_fornec)) { $this->nm_limpa_alfa($this->cod_proc_fornec); }
      if (isset($this->qt_dias_translado)) { $this->nm_limpa_alfa($this->qt_dias_translado); }
      if (isset($this->observacao)) { $this->nm_limpa_alfa($this->observacao); }
      if (isset($this->fornecedor_id)) { $this->nm_limpa_alfa($this->fornecedor_id); }
      if (isset($this->log_facilid_contato_fornec)) { $this->nm_limpa_alfa($this->log_facilid_contato_fornec); }
      if (isset($this->log_considerar_previsao)) { $this->nm_limpa_alfa($this->log_considerar_previsao); }
      if (isset($nm_opc_lookup) && $nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "fornecedor_id")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->fornecedor_id = $array_vars[0];
              $fornecedor_id       = $this->fornecedor_id;
              nm_limpa_numero($fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']); 
              $this->fornecedor_id       = $fornecedor_id;
              $this->lookup_fornecedor_id($conteudo);
              $conteudo = str_replace("&", "&amp;", $conteudo); 
              $conteudo = str_replace("\/" , "\/", $conteudo); 
              echo "<!DOCTYPE html><html><head></head>";
              echo " <body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" . $GLOBALS['C'] . "');\">";
              echo "  jsrsPayload:";
              echo "  <br>";
              echo "  <form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\">";
              echo "$conteudo";
              echo " </textarea></form></body></html>";
          } 
          $this->NM_close_db(); 
          exit;
      } 
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "bt_log")
          { 
              $this->sc_btn_bt_log();
          } 
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- proc_compra_id
      $this->field_config['proc_compra_id']               = array();
      $this->field_config['proc_compra_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['proc_compra_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['proc_compra_id']['symbol_dec'] = '';
      $this->field_config['proc_compra_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['proc_compra_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dt_registro
      $this->field_config['dt_registro']                 = array();
      $this->field_config['dt_registro']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['dt_registro']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_registro']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'dt_registro');
      //-- qt_dias_translado
      $this->field_config['qt_dias_translado']               = array();
      $this->field_config['qt_dias_translado']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qt_dias_translado']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qt_dias_translado']['symbol_dec'] = '';
      $this->field_config['qt_dias_translado']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qt_dias_translado']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- fornecedor_id
      $this->field_config['fornecedor_id']               = array();
      $this->field_config['fornecedor_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['fornecedor_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['fornecedor_id']['symbol_dec'] = '';
      $this->field_config['fornecedor_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['fornecedor_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dt_limite
      $this->field_config['dt_limite']                 = array();
      $this->field_config['dt_limite']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['dt_limite']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_limite']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'dt_limite');
      //-- qt_container
      $this->field_config['qt_container']               = array();
      $this->field_config['qt_container']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qt_container']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qt_container']['symbol_dec'] = '';
      $this->field_config['qt_container']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qt_container']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- cotacao_prevista
      $this->field_config['cotacao_prevista']               = array();
      $this->field_config['cotacao_prevista']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['cotacao_prevista']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['cotacao_prevista']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['cotacao_prevista']['symbol_mon'] = '';
      $this->field_config['cotacao_prevista']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['cotacao_prevista']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Gera_log_access'] = false;
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
          $this->log_considerar_previsao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form']['log_considerar_previsao'];
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->log_considerar_previsao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form']['log_considerar_previsao'];
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_proc_compra_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'proc_compra_id');
          }
          if ('validate_cod_situacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_situacao');
          }
          if ('validate_empresa_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'empresa_id');
          }
          if ('validate_dt_registro' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dt_registro');
          }
          if ('validate_cod_proc_fornec' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_proc_fornec');
          }
          if ('validate_qt_dias_translado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qt_dias_translado');
          }
          if ('validate_fornecedor_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'fornecedor_id');
          }
          if ('validate_dt_limite' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dt_limite');
          }
          if ('validate_log_facilid_contato_fornec' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'log_facilid_contato_fornec');
          }
          if ('validate_log_considerar_previsao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'log_considerar_previsao');
          }
          if ('validate_observacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observacao');
          }
          form_proc_compra_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_fornecedor_id_onchange' == $this->NM_ajax_opcao)
          {
              $this->fornecedor_id_onChange();
          }
          form_proc_compra_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select']['log_considerar_previsao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->log_considerar_previsao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select']['log_considerar_previsao'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_proc_compra_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_proc_compra_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_atualiz'] == "ok")
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
          if ($this->sc_evento == "update")
          {
              $this->NM_close_db(); 
              $this->nmgp_redireciona(2); 
          }
          if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
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
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_proc_compra_pack_ajax_response();
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
          form_proc_compra_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_proc_compra.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Pedido de Compras") ?></TITLE>
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
<form name="Fdown" method="get" action="form_proc_compra_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_proc_compra"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_proc_compra_pack_ajax_response();
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
           $this->Ini->nm_db_log_imp_mysql->Close(); 
           $this->Ini->nm_db_log_db->Close(); 
           $this->Ini->nm_db_ems5->Close(); 
           $this->Ini->nm_db_espec->Close(); 
           $this->Ini->nm_db_ems2ima->Close(); 
           $this->Ini->nm_db_ems2med->Close(); 
           $this->Ini->nm_db_comum->Close(); 
           $this->Ini->nm_db_multi->Close(); 
           $this->Ini->nm_db_cfsc->Close(); 
           $this->Ini->nm_db_ticontrole2->Close(); 
           $this->Ini->nm_db_ima->Close(); 
           $this->Ini->nm_db_med->Close(); 
           $this->Ini->nm_db_geral->Close(); 
           $this->Ini->nm_db_dinamico->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function lookup_fornecedor_id(&$conteudo)
   {
      global  $fornecedor_id;
      $guarda_formatado = $this->formatado;
      $this->nm_tira_formatacao();
      $Salva_opc = $this->nmgp_opcao;
      $this->nmgp_opcao = "lookup_rpc";
      $this->nm_converte_datas();
      $this->nmgp_opcao = $Salva_opc;
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT \"nome-emit\" 
FROM PUB.emitente 
WHERE \"cod-emitente\" = $this->fornecedor_id 
ORDER BY \"nome-emit\""; 
      if ($this->fornecedor_id == "")
      { 
          $conteudo = ""; 
          $this->nm_formatar_campos();
          return; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Ini->nm_db_comum->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : ""; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comum->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      foreach ($this->Before_unformat as $Cmp => $Val)
      {
          $this->$Cmp = $Val;
          $this->formatado = $guarda_formatado;
      }
   }
   function sc_btn_bt_log() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_proc_compra_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $varloc_btn_php = array();
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->proc_compra_id) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form']['proc_compra_id']))
          {
              $varloc_btn_php['proc_compra_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form']['proc_compra_id'];
          }
      }
      $nm_f_saida = "./";
      nm_limpa_numero($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp']) ; 
      nm_limpa_data($this->dt_registro, $this->field_config['dt_registro']['date_sep']) ; 
      nm_limpa_numero($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp']) ; 
      nm_limpa_numero($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']) ; 
      nm_limpa_data($this->dt_limite, $this->field_config['dt_limite']['date_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  $aplCorrente = $this->Ini->nm_cod_apl;
header("Location:..\ctrl_tipo_log\ctrl_tipo_log.php?apl_corrente=$aplCorrente&id_chave=$this->proc_compra_id ");
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="proc_compra_id" value="<?php echo $this->form_encode_input($this->proc_compra_id) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>" onclick="window.close()"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
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
           case 'proc_compra_id':
               return "ID";
               break;
           case 'cod_situacao':
               return "Situação";
               break;
           case 'empresa_id':
               return "Empresa";
               break;
           case 'dt_registro':
               return "Dt Registro";
               break;
           case 'cod_proc_fornec':
               return "Cod Proc Fornec";
               break;
           case 'qt_dias_translado':
               return "Qt Dias Translado";
               break;
           case 'fornecedor_id':
               return "Fornecedor";
               break;
           case 'dt_limite':
               return "Dt Limite";
               break;
           case 'log_facilid_contato_fornec':
               return "Facilidade de Contato com Fornecedor?";
               break;
           case 'log_considerar_previsao':
               return "Integra  Cta.Corrente Fornecedor?";
               break;
           case 'observacao':
               return "Observação";
               break;
           case 'qt_container':
               return "Qt Container";
               break;
           case 'cotacao_prevista':
               return "Cotacao Prevista";
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
      if ((!is_array($filtro) && ('' == $filtro || 'proc_compra_id' == $filtro)) || (is_array($filtro) && in_array('proc_compra_id', $filtro)))
        $this->ValidateField_proc_compra_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "proc_compra_id";

      if ((!is_array($filtro) && ('' == $filtro || 'cod_situacao' == $filtro)) || (is_array($filtro) && in_array('cod_situacao', $filtro)))
        $this->ValidateField_cod_situacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_situacao";

      if ((!is_array($filtro) && ('' == $filtro || 'empresa_id' == $filtro)) || (is_array($filtro) && in_array('empresa_id', $filtro)))
        $this->ValidateField_empresa_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "empresa_id";

      if ((!is_array($filtro) && ('' == $filtro || 'dt_registro' == $filtro)) || (is_array($filtro) && in_array('dt_registro', $filtro)))
        $this->ValidateField_dt_registro($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "dt_registro";

      if ((!is_array($filtro) && ('' == $filtro || 'cod_proc_fornec' == $filtro)) || (is_array($filtro) && in_array('cod_proc_fornec', $filtro)))
        $this->ValidateField_cod_proc_fornec($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_proc_fornec";

      if ((!is_array($filtro) && ('' == $filtro || 'qt_dias_translado' == $filtro)) || (is_array($filtro) && in_array('qt_dias_translado', $filtro)))
        $this->ValidateField_qt_dias_translado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qt_dias_translado";

      if ((!is_array($filtro) && ('' == $filtro || 'fornecedor_id' == $filtro)) || (is_array($filtro) && in_array('fornecedor_id', $filtro)))
        $this->ValidateField_fornecedor_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "fornecedor_id";

      if ((!is_array($filtro) && ('' == $filtro || 'dt_limite' == $filtro)) || (is_array($filtro) && in_array('dt_limite', $filtro)))
        $this->ValidateField_dt_limite($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "dt_limite";

      if ((!is_array($filtro) && ('' == $filtro || 'log_facilid_contato_fornec' == $filtro)) || (is_array($filtro) && in_array('log_facilid_contato_fornec', $filtro)))
        $this->ValidateField_log_facilid_contato_fornec($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "log_facilid_contato_fornec";

      if ((!is_array($filtro) && ('' == $filtro || 'log_considerar_previsao' == $filtro)) || (is_array($filtro) && in_array('log_considerar_previsao', $filtro)))
        $this->ValidateField_log_considerar_previsao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "log_considerar_previsao";

      if ((!is_array($filtro) && ('' == $filtro || 'observacao' == $filtro)) || (is_array($filtro) && in_array('observacao', $filtro)))
        $this->ValidateField_observacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "observacao";

//-- converter datas   
          $this->nm_converte_datas();
//---
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

    function ValidateField_proc_compra_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['proc_compra_id'])) {
          nm_limpa_numero($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp']) ; 
          return;
      }
      if ($this->proc_compra_id === "" || is_null($this->proc_compra_id))  
      { 
          $this->proc_compra_id = 0;
      } 
      nm_limpa_numero($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_proc_compra_id' == $this->NM_ajax_opcao)
      { 
          if ($this->proc_compra_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->proc_compra_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['proc_compra_id']))
                  {
                      $Campos_Erros['proc_compra_id'] = array();
                  }
                  $Campos_Erros['proc_compra_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['proc_compra_id']) || !is_array($this->NM_ajax_info['errList']['proc_compra_id']))
                  {
                      $this->NM_ajax_info['errList']['proc_compra_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['proc_compra_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->proc_compra_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID; " ; 
                  if (!isset($Campos_Erros['proc_compra_id']))
                  {
                      $Campos_Erros['proc_compra_id'] = array();
                  }
                  $Campos_Erros['proc_compra_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['proc_compra_id']) || !is_array($this->NM_ajax_info['errList']['proc_compra_id']))
                  {
                      $this->NM_ajax_info['errList']['proc_compra_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['proc_compra_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'proc_compra_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_proc_compra_id

    function ValidateField_cod_situacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['cod_situacao'])) {
       return;
   }
      if ($this->cod_situacao == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->cod_situacao === "" || is_null($this->cod_situacao))  
      { 
          $this->cod_situacao = 0;
          $this->sc_force_zero[] = 'cod_situacao';
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_situacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_situacao

    function ValidateField_empresa_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['empresa_id'])) {
       return;
   }
               if (!empty($this->empresa_id) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']) && !in_array($this->empresa_id, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['empresa_id']))
                   {
                       $Campos_Erros['empresa_id'] = array();
                   }
                   $Campos_Erros['empresa_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['empresa_id']) || !is_array($this->NM_ajax_info['errList']['empresa_id']))
                   {
                       $this->NM_ajax_info['errList']['empresa_id'] = array();
                   }
                   $this->NM_ajax_info['errList']['empresa_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'empresa_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_empresa_id

    function ValidateField_dt_registro(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dt_registro, $this->field_config['dt_registro']['date_sep']) ; 
      if (isset($this->Field_no_validate['dt_registro'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dt_registro']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dt_registro']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dt_registro']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dt_registro']['date_sep']) ; 
          if (trim($this->dt_registro) != "")  
          { 
              $validateTest = $teste_validade->Data($this->dt_registro, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt Registro; " ; 
                  if (!isset($Campos_Erros['dt_registro']))
                  {
                      $Campos_Erros['dt_registro'] = array();
                  }
                  $Campos_Erros['dt_registro'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dt_registro']) || !is_array($this->NM_ajax_info['errList']['dt_registro']))
                  {
                      $this->NM_ajax_info['errList']['dt_registro'] = array();
                  }
                  $this->NM_ajax_info['errList']['dt_registro'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dt_registro']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dt_registro';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dt_registro

    function ValidateField_cod_proc_fornec(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cod_proc_fornec'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->cod_proc_fornec) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Cod Proc Fornec " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cod_proc_fornec']))
              {
                  $Campos_Erros['cod_proc_fornec'] = array();
              }
              $Campos_Erros['cod_proc_fornec'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cod_proc_fornec']) || !is_array($this->NM_ajax_info['errList']['cod_proc_fornec']))
              {
                  $this->NM_ajax_info['errList']['cod_proc_fornec'] = array();
              }
              $this->NM_ajax_info['errList']['cod_proc_fornec'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_proc_fornec';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_proc_fornec

    function ValidateField_qt_dias_translado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qt_dias_translado'])) {
          nm_limpa_numero($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp']) ; 
          return;
      }
      if ($this->qt_dias_translado === "" || is_null($this->qt_dias_translado))  
      { 
          $this->qt_dias_translado = 0;
          $this->sc_force_zero[] = 'qt_dias_translado';
      } 
      nm_limpa_numero($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->qt_dias_translado != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->qt_dias_translado) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt Dias Translado: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qt_dias_translado']))
                  {
                      $Campos_Erros['qt_dias_translado'] = array();
                  }
                  $Campos_Erros['qt_dias_translado'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qt_dias_translado']) || !is_array($this->NM_ajax_info['errList']['qt_dias_translado']))
                  {
                      $this->NM_ajax_info['errList']['qt_dias_translado'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_dias_translado'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qt_dias_translado, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt Dias Translado; " ; 
                  if (!isset($Campos_Erros['qt_dias_translado']))
                  {
                      $Campos_Erros['qt_dias_translado'] = array();
                  }
                  $Campos_Erros['qt_dias_translado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qt_dias_translado']) || !is_array($this->NM_ajax_info['errList']['qt_dias_translado']))
                  {
                      $this->NM_ajax_info['errList']['qt_dias_translado'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_dias_translado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qt_dias_translado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qt_dias_translado

    function ValidateField_fornecedor_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['fornecedor_id'])) {
          nm_limpa_numero($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']) ; 
          return;
      }
      if ($this->fornecedor_id === "" || is_null($this->fornecedor_id))  
      { 
          $this->fornecedor_id = 0;
          $this->sc_force_zero[] = 'fornecedor_id';
      } 
      nm_limpa_numero($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->fornecedor_id != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->fornecedor_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['fornecedor_id']))
                  {
                      $Campos_Erros['fornecedor_id'] = array();
                  }
                  $Campos_Erros['fornecedor_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['fornecedor_id']) || !is_array($this->NM_ajax_info['errList']['fornecedor_id']))
                  {
                      $this->NM_ajax_info['errList']['fornecedor_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['fornecedor_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->fornecedor_id, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor; " ; 
                  if (!isset($Campos_Erros['fornecedor_id']))
                  {
                      $Campos_Erros['fornecedor_id'] = array();
                  }
                  $Campos_Erros['fornecedor_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['fornecedor_id']) || !is_array($this->NM_ajax_info['errList']['fornecedor_id']))
                  {
                      $this->NM_ajax_info['errList']['fornecedor_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['fornecedor_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'fornecedor_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_fornecedor_id

    function ValidateField_dt_limite(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dt_limite, $this->field_config['dt_limite']['date_sep']) ; 
      if (isset($this->Field_no_validate['dt_limite'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dt_limite']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dt_limite']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dt_limite']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dt_limite']['date_sep']) ; 
          if (trim($this->dt_limite) != "")  
          { 
              $validateTest = $teste_validade->Data($this->dt_limite, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt Limite; " ; 
                  if (!isset($Campos_Erros['dt_limite']))
                  {
                      $Campos_Erros['dt_limite'] = array();
                  }
                  $Campos_Erros['dt_limite'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dt_limite']) || !is_array($this->NM_ajax_info['errList']['dt_limite']))
                  {
                      $this->NM_ajax_info['errList']['dt_limite'] = array();
                  }
                  $this->NM_ajax_info['errList']['dt_limite'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dt_limite']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dt_limite';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dt_limite

    function ValidateField_log_facilid_contato_fornec(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['log_facilid_contato_fornec'])) {
       return;
   }
      if ($this->log_facilid_contato_fornec == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->log_facilid_contato_fornec === "" || is_null($this->log_facilid_contato_fornec))  
      { 
          $this->log_facilid_contato_fornec = 0;
          $this->sc_force_zero[] = 'log_facilid_contato_fornec';
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'log_facilid_contato_fornec';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_log_facilid_contato_fornec

    function ValidateField_log_considerar_previsao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['log_considerar_previsao'])) {
       return;
   }
      if ($this->log_considerar_previsao == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->log_considerar_previsao === "" || is_null($this->log_considerar_previsao))  
      { 
          $this->log_considerar_previsao = 0;
          $this->sc_force_zero[] = 'log_considerar_previsao';
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'log_considerar_previsao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_log_considerar_previsao

    function ValidateField_observacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['observacao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->observacao) > 16000) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['observacao']))
              {
                  $Campos_Erros['observacao'] = array();
              }
              $Campos_Erros['observacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['observacao']) || !is_array($this->NM_ajax_info['errList']['observacao']))
              {
                  $this->NM_ajax_info['errList']['observacao'] = array();
              }
              $this->NM_ajax_info['errList']['observacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'observacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_observacao

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
    $this->nmgp_dados_form['proc_compra_id'] = $this->proc_compra_id;
    $this->nmgp_dados_form['cod_situacao'] = $this->cod_situacao;
    $this->nmgp_dados_form['empresa_id'] = $this->empresa_id;
    $this->nmgp_dados_form['dt_registro'] = (strlen(trim($this->dt_registro)) > 19) ? str_replace(".", ":", $this->dt_registro) : trim($this->dt_registro);
    $this->nmgp_dados_form['cod_proc_fornec'] = $this->cod_proc_fornec;
    $this->nmgp_dados_form['qt_dias_translado'] = $this->qt_dias_translado;
    $this->nmgp_dados_form['fornecedor_id'] = $this->fornecedor_id;
    $this->nmgp_dados_form['dt_limite'] = (strlen(trim($this->dt_limite)) > 19) ? str_replace(".", ":", $this->dt_limite) : trim($this->dt_limite);
    $this->nmgp_dados_form['log_facilid_contato_fornec'] = $this->log_facilid_contato_fornec;
    $this->nmgp_dados_form['log_considerar_previsao'] = $this->log_considerar_previsao;
    $this->nmgp_dados_form['observacao'] = $this->observacao;
    $this->nmgp_dados_form['qt_container'] = $this->qt_container;
    $this->nmgp_dados_form['cotacao_prevista'] = $this->cotacao_prevista;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['proc_compra_id'] = $this->proc_compra_id;
      nm_limpa_numero($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp']) ; 
      $this->Before_unformat['dt_registro'] = $this->dt_registro;
      nm_limpa_data($this->dt_registro, $this->field_config['dt_registro']['date_sep']) ; 
      $this->Before_unformat['qt_dias_translado'] = $this->qt_dias_translado;
      nm_limpa_numero($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp']) ; 
      $this->Before_unformat['fornecedor_id'] = $this->fornecedor_id;
      nm_limpa_numero($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']) ; 
      $this->Before_unformat['dt_limite'] = $this->dt_limite;
      nm_limpa_data($this->dt_limite, $this->field_config['dt_limite']['date_sep']) ; 
      $this->Before_unformat['qt_container'] = $this->qt_container;
      nm_limpa_numero($this->qt_container, $this->field_config['qt_container']['symbol_grp']) ; 
      $this->Before_unformat['cotacao_prevista'] = $this->cotacao_prevista;
      if (!empty($this->field_config['cotacao_prevista']['symbol_dec']))
      {
         $this->sc_remove_currency($this->cotacao_prevista, $this->field_config['cotacao_prevista']['symbol_dec'], $this->field_config['cotacao_prevista']['symbol_grp'], $this->field_config['cotacao_prevista']['symbol_mon']);
         nm_limpa_valor($this->cotacao_prevista, $this->field_config['cotacao_prevista']['symbol_dec'], $this->field_config['cotacao_prevista']['symbol_grp']);
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
      if ($Nome_Campo == "proc_compra_id")
      {
          nm_limpa_numero($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qt_dias_translado")
      {
          nm_limpa_numero($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "fornecedor_id")
      {
          nm_limpa_numero($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qt_container")
      {
          nm_limpa_numero($this->qt_container, $this->field_config['qt_container']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "cotacao_prevista")
      {
          if (!empty($this->field_config['cotacao_prevista']['symbol_dec']))
          {
             $this->sc_remove_currency($this->cotacao_prevista, $this->field_config['cotacao_prevista']['symbol_dec'], $this->field_config['cotacao_prevista']['symbol_grp'], $this->field_config['cotacao_prevista']['symbol_mon']);
             nm_limpa_valor($this->cotacao_prevista, $this->field_config['cotacao_prevista']['symbol_dec'], $this->field_config['cotacao_prevista']['symbol_grp']);
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
      if ('' !== $this->proc_compra_id || (!empty($format_fields) && isset($format_fields['proc_compra_id'])))
      {
          nmgp_Form_Num_Val($this->proc_compra_id, $this->field_config['proc_compra_id']['symbol_grp'], $this->field_config['proc_compra_id']['symbol_dec'], "0", "S", $this->field_config['proc_compra_id']['format_neg'], "", "", "-", $this->field_config['proc_compra_id']['symbol_fmt']) ; 
      }
      if ((!empty($this->dt_registro) && 'null' != $this->dt_registro) || (!empty($format_fields) && isset($format_fields['dt_registro'])))
      {
          nm_volta_data($this->dt_registro, $this->field_config['dt_registro']['date_format']) ; 
          nmgp_Form_Datas($this->dt_registro, $this->field_config['dt_registro']['date_format'], $this->field_config['dt_registro']['date_sep']) ;  
      }
      elseif ('null' == $this->dt_registro || '' == $this->dt_registro)
      {
          $this->dt_registro = '';
      }
      if ('' !== $this->qt_dias_translado || (!empty($format_fields) && isset($format_fields['qt_dias_translado'])))
      {
          nmgp_Form_Num_Val($this->qt_dias_translado, $this->field_config['qt_dias_translado']['symbol_grp'], $this->field_config['qt_dias_translado']['symbol_dec'], "0", "S", $this->field_config['qt_dias_translado']['format_neg'], "", "", "-", $this->field_config['qt_dias_translado']['symbol_fmt']) ; 
      }
      if ('' !== $this->fornecedor_id || (!empty($format_fields) && isset($format_fields['fornecedor_id'])))
      {
          nmgp_Form_Num_Val($this->fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp'], $this->field_config['fornecedor_id']['symbol_dec'], "0", "S", $this->field_config['fornecedor_id']['format_neg'], "", "", "-", $this->field_config['fornecedor_id']['symbol_fmt']) ; 
      }
      if ((!empty($this->dt_limite) && 'null' != $this->dt_limite) || (!empty($format_fields) && isset($format_fields['dt_limite'])))
      {
          nm_volta_data($this->dt_limite, $this->field_config['dt_limite']['date_format']) ; 
          nmgp_Form_Datas($this->dt_limite, $this->field_config['dt_limite']['date_format'], $this->field_config['dt_limite']['date_sep']) ;  
      }
      elseif ('null' == $this->dt_limite || '' == $this->dt_limite)
      {
          $this->dt_limite = '';
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
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['dt_registro']['date_format'];
      if ($this->dt_registro != "")  
      { 
          nm_conv_data($this->dt_registro, $this->field_config['dt_registro']['date_format']) ; 
          $this->dt_registro_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->dt_registro_hora = substr($this->dt_registro_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dt_registro_hora = substr($this->dt_registro_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->dt_registro_hora = substr($this->dt_registro_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->dt_registro_hora = substr($this->dt_registro_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->dt_registro_hora = substr($this->dt_registro_hora, 0, -4);
          }
      } 
      if ($this->dt_registro == "" && $use_null)  
      { 
          $this->dt_registro = "null" ; 
      } 
      $this->field_config['dt_registro']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['dt_limite']['date_format'];
      if ($this->dt_limite != "")  
      { 
          nm_conv_data($this->dt_limite, $this->field_config['dt_limite']['date_format']) ; 
          $this->dt_limite_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->dt_limite_hora = substr($this->dt_limite_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dt_limite_hora = substr($this->dt_limite_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->dt_limite_hora = substr($this->dt_limite_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->dt_limite_hora = substr($this->dt_limite_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->dt_limite_hora = substr($this->dt_limite_hora, 0, -4);
          }
      } 
      if ($this->dt_limite == "" && $use_null)  
      { 
          $this->dt_limite = "null" ; 
      } 
      $this->field_config['dt_limite']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
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
          $this->ajax_return_values_proc_compra_id();
          $this->ajax_return_values_cod_situacao();
          $this->ajax_return_values_empresa_id();
          $this->ajax_return_values_dt_registro();
          $this->ajax_return_values_cod_proc_fornec();
          $this->ajax_return_values_qt_dias_translado();
          $this->ajax_return_values_fornecedor_id();
          $this->ajax_return_values_dt_limite();
          $this->ajax_return_values_log_facilid_contato_fornec();
          $this->ajax_return_values_log_considerar_previsao();
          $this->ajax_return_values_observacao();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['proc_compra_id']['keyVal'] = form_proc_compra_pack_protect_string($this->nmgp_dados_form['proc_compra_id']);
          }
   } // ajax_return_values

          //----- proc_compra_id
   function ajax_return_values_proc_compra_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("proc_compra_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->proc_compra_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['proc_compra_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("proc_compra_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- cod_situacao
   function ajax_return_values_cod_situacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cod_situacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cod_situacao);
              $aLookup = array();
              $this->_tmp_lookup_cod_situacao = $this->cod_situacao;

$aLookup[] = array(form_proc_compra_pack_protect_string('1') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Aberto")));
$aLookup[] = array(form_proc_compra_pack_protect_string('2') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Fechado")));
$aLookup[] = array(form_proc_compra_pack_protect_string('3') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Cancelado")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_cod_situacao'][] = '1';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_cod_situacao'][] = '2';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_cod_situacao'][] = '3';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"cod_situacao\"";
          if (isset($this->NM_ajax_info['select_html']['cod_situacao']) && !empty($this->NM_ajax_info['select_html']['cod_situacao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['cod_situacao']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->cod_situacao == $sValue)
                  {
                      $this->_tmp_lookup_cod_situacao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['cod_situacao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['cod_situacao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['cod_situacao']['valList'][$i] = form_proc_compra_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['cod_situacao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['cod_situacao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['cod_situacao']['labList'] = $aLabel;
          }
   }

          //----- empresa_id
   function ajax_return_values_empresa_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("empresa_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->empresa_id);
              $aLookup = array();
              $this->_tmp_lookup_empresa_id = $this->empresa_id;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_proc_compra_id = $this->proc_compra_id;
   $old_value_dt_registro = $this->dt_registro;
   $old_value_qt_dias_translado = $this->qt_dias_translado;
   $old_value_fornecedor_id = $this->fornecedor_id;
   $old_value_dt_limite = $this->dt_limite;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_proc_compra_id = $this->proc_compra_id;
   $unformatted_value_dt_registro = $this->dt_registro;
   $unformatted_value_qt_dias_translado = $this->qt_dias_translado;
   $unformatted_value_fornecedor_id = $this->fornecedor_id;
   $unformatted_value_dt_limite = $this->dt_limite;

   $nm_comando = "SELECT empresa_id, nome  FROM pub.empresas  ORDER BY nome";

   $this->proc_compra_id = $old_value_proc_compra_id;
   $this->dt_registro = $old_value_dt_registro;
   $this->qt_dias_translado = $old_value_qt_dias_translado;
   $this->fornecedor_id = $old_value_fornecedor_id;
   $this->dt_limite = $old_value_dt_limite;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_proc_compra_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_proc_compra_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"empresa_id\"";
          if (isset($this->NM_ajax_info['select_html']['empresa_id']) && !empty($this->NM_ajax_info['select_html']['empresa_id']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['empresa_id']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->empresa_id == $sValue)
                  {
                      $this->_tmp_lookup_empresa_id = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['empresa_id'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['empresa_id']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['empresa_id']['valList'][$i] = form_proc_compra_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['empresa_id']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['empresa_id']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['empresa_id']['labList'] = $aLabel;
          }
   }

          //----- dt_registro
   function ajax_return_values_dt_registro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dt_registro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dt_registro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dt_registro'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cod_proc_fornec
   function ajax_return_values_cod_proc_fornec($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cod_proc_fornec", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cod_proc_fornec);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cod_proc_fornec'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- qt_dias_translado
   function ajax_return_values_qt_dias_translado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qt_dias_translado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qt_dias_translado);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qt_dias_translado'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- fornecedor_id
   function ajax_return_values_fornecedor_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("fornecedor_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->fornecedor_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['fornecedor_id'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
              $orig_fornecedor_id = $this->fornecedor_id;
              $fornecedor_id      = $this->fornecedor_id;
              nm_limpa_numero($fornecedor_id, $this->field_config['fornecedor_id']['symbol_grp']); 
              $this->fornecedor_id = $fornecedor_id;
              $this->lookup_fornecedor_id($conteudo);
              $this->fornecedor_id = $orig_fornecedor_id;
              $this->NM_ajax_info['fldList']['fornecedor_id']['lookupCons'] = form_proc_compra_pack_protect_string(NM_charset_to_utf8($conteudo));
          }
   }

          //----- dt_limite
   function ajax_return_values_dt_limite($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dt_limite", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dt_limite);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dt_limite'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- log_facilid_contato_fornec
   function ajax_return_values_log_facilid_contato_fornec($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("log_facilid_contato_fornec", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->log_facilid_contato_fornec);
              $aLookup = array();
              $this->_tmp_lookup_log_facilid_contato_fornec = $this->log_facilid_contato_fornec;

$aLookup[] = array(form_proc_compra_pack_protect_string('1') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Sim")));
$aLookup[] = array(form_proc_compra_pack_protect_string('0') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_log_facilid_contato_fornec'][] = '1';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_log_facilid_contato_fornec'][] = '0';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"log_facilid_contato_fornec\"";
          if (isset($this->NM_ajax_info['select_html']['log_facilid_contato_fornec']) && !empty($this->NM_ajax_info['select_html']['log_facilid_contato_fornec']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['log_facilid_contato_fornec']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->log_facilid_contato_fornec == $sValue)
                  {
                      $this->_tmp_lookup_log_facilid_contato_fornec = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['log_facilid_contato_fornec'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['log_facilid_contato_fornec']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['log_facilid_contato_fornec']['valList'][$i] = form_proc_compra_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['log_facilid_contato_fornec']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['log_facilid_contato_fornec']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['log_facilid_contato_fornec']['labList'] = $aLabel;
          }
   }

          //----- log_considerar_previsao
   function ajax_return_values_log_considerar_previsao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("log_considerar_previsao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->log_considerar_previsao);
              $aLookup = array();
              $this->_tmp_lookup_log_considerar_previsao = $this->log_considerar_previsao;

$aLookup[] = array(form_proc_compra_pack_protect_string('1') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Sim")));
$aLookup[] = array(form_proc_compra_pack_protect_string('0') => str_replace('<', '&lt;',form_proc_compra_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_log_considerar_previsao'][] = '1';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_log_considerar_previsao'][] = '0';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"log_considerar_previsao\"";
          if (isset($this->NM_ajax_info['select_html']['log_considerar_previsao']) && !empty($this->NM_ajax_info['select_html']['log_considerar_previsao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['log_considerar_previsao']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->log_considerar_previsao == $sValue)
                  {
                      $this->_tmp_lookup_log_considerar_previsao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['log_considerar_previsao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['log_considerar_previsao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['log_considerar_previsao']['valList'][$i] = form_proc_compra_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['log_considerar_previsao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['log_considerar_previsao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['log_considerar_previsao']['labList'] = $aLabel;
          }
   }

          //----- observacao
   function ajax_return_values_observacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("observacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->observacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['observacao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_proc_compra_id = $this->proc_compra_id;
}
if (!isset($this->sc_temp_reg_ant_procs_compra)) {$this->sc_temp_reg_ant_procs_compra = (isset($_SESSION['reg_ant_procs_compra'])) ? $_SESSION['reg_ant_procs_compra'] : "";}
  if($this->proc_compra_id  <> ''){
	$aReg = $this->getDadosPedidoImp($this->proc_compra_id ); 
	$this->sc_temp_reg_ant_procs_compra  = $aReg[0];	
	
}
if (isset($this->sc_temp_reg_ant_procs_compra)) { $_SESSION['reg_ant_procs_compra'] = $this->sc_temp_reg_ant_procs_compra;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_proc_compra_id != $this->proc_compra_id || (isset($bFlagRead_proc_compra_id) && $bFlagRead_proc_compra_id)))
    {
        $this->ajax_return_values_proc_compra_id(true);
    }
}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
      }
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
      $this->cotacao_prevista = str_replace($sc_parm1, $sc_parm2, $this->cotacao_prevista); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->cotacao_prevista = "'" . $this->cotacao_prevista . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->cotacao_prevista = str_replace("'", "", $this->cotacao_prevista); 
   } 
//----------- 

   function return_after_insert()
   {
      global $sc_where;
      $this->restore_zeros_null();
      $sc_where_pos = " WHERE ((proc_compra_id < $this->proc_compra_id))";
      if ('' != $sc_where)
      {
          if ('where ' == strtolower(substr(trim($sc_where), 0, 6)))
          {
              $sc_where = substr(trim($sc_where), 6);
          }
          if ('and ' == strtolower(substr(trim($sc_where), 0, 4)))
          {
              $sc_where = substr(trim($sc_where), 4);
          }
          $sc_where_pos .= ' AND (' . $sc_where . ')';
          $sc_where = ' WHERE ' . $sc_where;
      }
      if ('' != $this->proc_compra_id)
      {
          $sc_where_pos = str_replace("'null'", "null", $sc_where_pos);
          $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count;
          $rsc = $this->Db->Execute($nmgp_sel_count);
          if ($rsc === false && !$rsc->EOF)
          {
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
              exit;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = $rsc->fields[0];
          $rsc->Close();
      }
   }

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
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_fornecedor_id = $this->fornecedor_id;
    $original_proc_compra_id = $this->proc_compra_id;
}
if (!isset($this->sc_temp_reg_ant_procs_compra)) {$this->sc_temp_reg_ant_procs_compra = (isset($_SESSION['reg_ant_procs_compra'])) ? $_SESSION['reg_ant_procs_compra'] : "";}
  if(is_array($this->sc_temp_reg_ant_procs_compra)){
	if($this->fornecedor_id  <> $this->sc_temp_reg_ant_procs_compra['fornecedor_id']){
		$this->local_validar_alt_fornec();	
	}		
}
if (isset($this->sc_temp_reg_ant_procs_compra)) { $_SESSION['reg_ant_procs_compra'] = $this->sc_temp_reg_ant_procs_compra;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_fornecedor_id != $this->fornecedor_id || (isset($bFlagRead_fornecedor_id) && $bFlagRead_fornecedor_id)))
    {
        $this->ajax_return_values_fornecedor_id(true);
    }
    if (($original_proc_compra_id != $this->proc_compra_id || (isset($bFlagRead_proc_compra_id) && $bFlagRead_proc_compra_id)))
    {
        $this->ajax_return_values_proc_compra_id(true);
    }
}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
    }
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_proc_compra_id = $this->proc_compra_id;
}
              /* PUB.itens_proc_compra */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = " . $this->proc_compra_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.itens_proc_compra WHERE item_proc_compra_id = " . $this->proc_compra_id ;
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.anexos_proc_compra */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.anexos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.pagtos_proc_compra */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pagtos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pagtos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pagtos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pagtos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.pagtos_proc_compra WHERE proc_compra_id = " . $this->proc_compra_id ;
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_proc_compra_id != $this->proc_compra_id || (isset($bFlagRead_proc_compra_id) && $bFlagRead_proc_compra_id)))
    {
        $this->ajax_return_values_proc_compra_id(true);
    }
}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
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
      if ('incluir' == $this->nmgp_opcao && empty($this->log_considerar_previsao)) {$this->log_considerar_previsao = "1"; $this->NM_val_null[] = "log_considerar_previsao";}  
      $NM_val_form['proc_compra_id'] = $this->proc_compra_id;
      $NM_val_form['cod_situacao'] = $this->cod_situacao;
      $NM_val_form['empresa_id'] = $this->empresa_id;
      $NM_val_form['dt_registro'] = $this->dt_registro;
      $NM_val_form['cod_proc_fornec'] = $this->cod_proc_fornec;
      $NM_val_form['qt_dias_translado'] = $this->qt_dias_translado;
      $NM_val_form['fornecedor_id'] = $this->fornecedor_id;
      $NM_val_form['dt_limite'] = $this->dt_limite;
      $NM_val_form['log_facilid_contato_fornec'] = $this->log_facilid_contato_fornec;
      $NM_val_form['log_considerar_previsao'] = $this->log_considerar_previsao;
      $NM_val_form['observacao'] = $this->observacao;
      $NM_val_form['qt_container'] = $this->qt_container;
      $NM_val_form['cotacao_prevista'] = $this->cotacao_prevista;
      if ($this->proc_compra_id === "" || is_null($this->proc_compra_id))  
      { 
          $this->proc_compra_id = 0;
      } 
      if ($this->empresa_id === "" || is_null($this->empresa_id))  
      { 
          $this->empresa_id = 0;
          $this->sc_force_zero[] = 'empresa_id';
      } 
      if ($this->qt_container === "" || is_null($this->qt_container))  
      { 
          $this->qt_container = 0;
          $this->sc_force_zero[] = 'qt_container';
      } 
      if ($this->cod_situacao === "" || is_null($this->cod_situacao))  
      { 
          $this->cod_situacao = 0;
          $this->sc_force_zero[] = 'cod_situacao';
      } 
      if ($this->qt_dias_translado === "" || is_null($this->qt_dias_translado))  
      { 
          $this->qt_dias_translado = 0;
          $this->sc_force_zero[] = 'qt_dias_translado';
      } 
      if ($this->cotacao_prevista === "" || is_null($this->cotacao_prevista))  
      { 
          $this->cotacao_prevista = 0;
          $this->sc_force_zero[] = 'cotacao_prevista';
      } 
      if ($this->fornecedor_id === "" || is_null($this->fornecedor_id))  
      { 
          $this->fornecedor_id = 0;
          $this->sc_force_zero[] = 'fornecedor_id';
      } 
      if ($this->log_facilid_contato_fornec === "" || is_null($this->log_facilid_contato_fornec))  
      { 
          $this->log_facilid_contato_fornec = 0;
          $this->sc_force_zero[] = 'log_facilid_contato_fornec';
      } 
      if ($this->log_considerar_previsao === "" || is_null($this->log_considerar_previsao))  
      { 
          $this->log_considerar_previsao = 0;
          $this->sc_force_zero[] = 'log_considerar_previsao';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->cod_proc_fornec_before_qstr = $this->cod_proc_fornec;
          $this->cod_proc_fornec = substr($this->Db->qstr($this->cod_proc_fornec), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->cod_proc_fornec = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->cod_proc_fornec);
          }
          if ($this->cod_proc_fornec == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->cod_proc_fornec = "null"; 
              $this->NM_val_null[] = "cod_proc_fornec";
          } 
          $this->observacao_before_qstr = $this->observacao;
          $this->observacao = substr($this->Db->qstr($this->observacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->observacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->observacao);
          }
          if ($this->observacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->observacao = "null"; 
              $this->NM_val_null[] = "observacao";
          } 
          if ($this->dt_registro == "")  
          { 
              $this->dt_registro = "null"; 
              $this->NM_val_null[] = "dt_registro";
          } 
          if ($this->dt_limite == "")  
          { 
              $this->dt_limite = "null"; 
              $this->NM_val_null[] = "dt_limite";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_proc_compra_pack_ajax_response();
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
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = #$this->dt_registro#, fornecedor_id = $this->fornecedor_id, dt_limite = #$this->dt_limite#, log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", fornecedor_id = $this->fornecedor_id, dt_limite = " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", fornecedor_id = $this->fornecedor_id, dt_limite = " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = EXTEND('$this->dt_registro', YEAR TO DAY), fornecedor_id = $this->fornecedor_id, dt_limite = EXTEND('$this->dt_limite', YEAR TO DAY), log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", fornecedor_id = $this->fornecedor_id, dt_limite = " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", fornecedor_id = $this->fornecedor_id, dt_limite = " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "empresa_id = $this->empresa_id, cod_situacao = $this->cod_situacao, cod_proc_fornec = '$this->cod_proc_fornec', qt_dias_translado = $this->qt_dias_translado, observacao = '$this->observacao', dt_registro = " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", fornecedor_id = $this->fornecedor_id, dt_limite = " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", log_facilid_contato_fornec = $this->log_facilid_contato_fornec, log_considerar_previsao = $this->log_considerar_previsao"; 
              } 
              if (isset($NM_val_form['qt_container']) && $NM_val_form['qt_container'] != $this->nmgp_dados_select['qt_container']) 
              { 
                  $SC_fields_update[] = "qt_container = $this->qt_container"; 
              } 
              if (isset($NM_val_form['cotacao_prevista']) && $NM_val_form['cotacao_prevista'] != $this->nmgp_dados_select['cotacao_prevista']) 
              { 
                  $SC_fields_update[] = "cotacao_prevista = $this->cotacao_prevista"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE proc_compra_id = $this->proc_compra_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE proc_compra_id = $this->proc_compra_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE proc_compra_id = $this->proc_compra_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE proc_compra_id = $this->proc_compra_id ";  
              }  
              else  
              {
                  $comando .= " WHERE proc_compra_id = $this->proc_compra_id ";  
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
                                  form_proc_compra_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->cod_proc_fornec = $this->cod_proc_fornec_before_qstr;
              $this->observacao = $this->observacao_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['proc_compra_id'])) { $this->proc_compra_id = $NM_val_form['proc_compra_id']; }
              elseif (isset($this->proc_compra_id)) { $this->nm_limpa_alfa($this->proc_compra_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['empresa_id'])) { $this->empresa_id = $NM_val_form['empresa_id']; }
              elseif (isset($this->empresa_id)) { $this->nm_limpa_alfa($this->empresa_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['cod_situacao'])) { $this->cod_situacao = $NM_val_form['cod_situacao']; }
              elseif (isset($this->cod_situacao)) { $this->nm_limpa_alfa($this->cod_situacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['cod_proc_fornec'])) { $this->cod_proc_fornec = $NM_val_form['cod_proc_fornec']; }
              elseif (isset($this->cod_proc_fornec)) { $this->nm_limpa_alfa($this->cod_proc_fornec); }
              if     (isset($NM_val_form) && isset($NM_val_form['qt_dias_translado'])) { $this->qt_dias_translado = $NM_val_form['qt_dias_translado']; }
              elseif (isset($this->qt_dias_translado)) { $this->nm_limpa_alfa($this->qt_dias_translado); }
              if     (isset($NM_val_form) && isset($NM_val_form['observacao'])) { $this->observacao = $NM_val_form['observacao']; }
              elseif (isset($this->observacao)) { $this->nm_limpa_alfa($this->observacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['fornecedor_id'])) { $this->fornecedor_id = $NM_val_form['fornecedor_id']; }
              elseif (isset($this->fornecedor_id)) { $this->nm_limpa_alfa($this->fornecedor_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['log_facilid_contato_fornec'])) { $this->log_facilid_contato_fornec = $NM_val_form['log_facilid_contato_fornec']; }
              elseif (isset($this->log_facilid_contato_fornec)) { $this->nm_limpa_alfa($this->log_facilid_contato_fornec); }
              if     (isset($NM_val_form) && isset($NM_val_form['log_considerar_previsao'])) { $this->log_considerar_previsao = $NM_val_form['log_considerar_previsao']; }
              elseif (isset($this->log_considerar_previsao)) { $this->nm_limpa_alfa($this->log_considerar_previsao); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('proc_compra_id', 'cod_situacao', 'empresa_id', 'dt_registro', 'cod_proc_fornec', 'qt_dias_translado', 'fornecedor_id', 'dt_limite', 'log_facilid_contato_fornec', 'log_considerar_previsao', 'observacao'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(proc_compra_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_proc_compra_pack_ajax_response();
              }
              exit; 
          }  
          $this->proc_compra_id_before_qstr = $this->proc_compra_id = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
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
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_proc_compra_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES ($this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', #$this->dt_registro#, $this->fornecedor_id, #$this->dt_limite#, $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', EXTEND('$this->dt_registro', YEAR TO DAY), $this->fornecedor_id, EXTEND('$this->dt_limite', YEAR TO DAY), $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao) VALUES (" . $NM_seq_auto . "$this->proc_compra_id, $this->empresa_id, $this->qt_container, $this->cod_situacao, '$this->cod_proc_fornec', $this->qt_dias_translado, $this->cotacao_prevista, '$this->observacao', " . $this->Ini->date_delim . $this->dt_registro . $this->Ini->date_delim1 . ", $this->fornecedor_id, " . $this->Ini->date_delim . $this->dt_limite . $this->Ini->date_delim1 . ", $this->log_facilid_contato_fornec, $this->log_considerar_previsao)"; 
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
                              form_proc_compra_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->cod_proc_fornec = $this->cod_proc_fornec_before_qstr;
              $this->observacao = $this->observacao_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->cod_proc_fornec = $this->cod_proc_fornec_before_qstr;
              $this->observacao = $this->observacao_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['bt_log'] = "on";
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->proc_compra_id = substr($this->Db->qstr($this->proc_compra_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where proc_compra_id = $this->proc_compra_id "); 
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
                          form_proc_compra_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']);
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_fornecedor_id = $this->fornecedor_id;
    $original_proc_compra_id = $this->proc_compra_id;
}
if (!isset($this->sc_temp_reg_ant_procs_compra)) {$this->sc_temp_reg_ant_procs_compra = (isset($_SESSION['reg_ant_procs_compra'])) ? $_SESSION['reg_ant_procs_compra'] : "";}
  $fornecedorAnterior = $this->sc_temp_reg_ant_procs_compra ['fornecedor_id'];
if($fornecedorAnterior <> $this->fornecedor_id ){
	$this->alterarFornecItensPed($this->proc_compra_id ,$this->fornecedor_id );		
}
$this->preencherIDLog($this->Ini->nm_cod_apl);
if (isset($this->sc_temp_reg_ant_procs_compra)) { $_SESSION['reg_ant_procs_compra'] = $this->sc_temp_reg_ant_procs_compra;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_fornecedor_id != $this->fornecedor_id || (isset($bFlagRead_fornecedor_id) && $bFlagRead_fornecedor_id)))
    {
        $this->ajax_return_values_fornecedor_id(true);
    }
    if (($original_proc_compra_id != $this->proc_compra_id || (isset($bFlagRead_proc_compra_id) && $bFlagRead_proc_compra_id)))
    {
        $this->ajax_return_values_proc_compra_id(true);
    }
}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off'; 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['parms'] = "proc_compra_id?#?$this->proc_compra_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->proc_compra_id = null === $this->proc_compra_id ? null : substr($this->Db->qstr($this->proc_compra_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "R")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->proc_compra_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->proc_compra_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("");
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_proc_compra = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] = $qt_geral_reg_form_proc_compra;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->proc_compra_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "proc_compra_id < $this->proc_compra_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "proc_compra_id < $this->proc_compra_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "proc_compra_id < $this->proc_compra_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "proc_compra_id < $this->proc_compra_id "; 
              }
              else  
              {
                  $Key_Where = "proc_compra_id < $this->proc_compra_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_proc_compra = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] > $qt_geral_reg_form_proc_compra)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = $qt_geral_reg_form_proc_compra; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = $qt_geral_reg_form_proc_compra; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_proc_compra) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, str_replace (convert(char(10),dt_registro,102), '.', '-') + ' ' + convert(char(8),dt_registro,20), fornecedor_id, str_replace (convert(char(10),dt_limite,102), '.', '-') + ' ' + convert(char(8),dt_limite,20), log_facilid_contato_fornec, log_considerar_previsao from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, convert(char(23),dt_registro,121), fornecedor_id, convert(char(23),dt_limite,121), log_facilid_contato_fornec, log_considerar_previsao from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, EXTEND(dt_registro, YEAR TO DAY), fornecedor_id, EXTEND(dt_limite, YEAR TO DAY), log_facilid_contato_fornec, log_considerar_previsao from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT proc_compra_id, empresa_id, qt_container, cod_situacao, cod_proc_fornec, qt_dias_translado, cotacao_prevista, observacao, dt_registro, fornecedor_id, dt_limite, log_facilid_contato_fornec, log_considerar_previsao from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "proc_compra_id = $this->proc_compra_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "proc_compra_id = $this->proc_compra_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "proc_compra_id = $this->proc_compra_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "proc_compra_id = $this->proc_compra_id"; 
              }  
              else  
              {
                  $aWhere[] = "proc_compra_id = $this->proc_compra_id"; 
              }  
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "proc_compra_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['bt_log'] = $this->nmgp_botoes['bt_log'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter'] = true;
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
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              $this->NM_ajax_info['buttonDisplay']['bt_log'] = $this->nmgp_botoes['bt_log'] = "on";
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->proc_compra_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['proc_compra_id'] = $this->proc_compra_id;
              $this->empresa_id = $rs->fields[1] ; 
              $this->nmgp_dados_select['empresa_id'] = $this->empresa_id;
              $this->qt_container = $rs->fields[2] ; 
              $this->nmgp_dados_select['qt_container'] = $this->qt_container;
              $this->cod_situacao = $rs->fields[3] ; 
              $this->nmgp_dados_select['cod_situacao'] = $this->cod_situacao;
              $this->cod_proc_fornec = $rs->fields[4] ; 
              $this->nmgp_dados_select['cod_proc_fornec'] = $this->cod_proc_fornec;
              $this->qt_dias_translado = $rs->fields[5] ; 
              $this->nmgp_dados_select['qt_dias_translado'] = $this->qt_dias_translado;
              $this->cotacao_prevista = $rs->fields[6] ; 
              $this->nmgp_dados_select['cotacao_prevista'] = $this->cotacao_prevista;
              $this->observacao = $rs->fields[7] ; 
              $this->nmgp_dados_select['observacao'] = $this->observacao;
              $this->dt_registro = $rs->fields[8] ; 
              $this->nmgp_dados_select['dt_registro'] = $this->dt_registro;
              $this->fornecedor_id = $rs->fields[9] ; 
              $this->nmgp_dados_select['fornecedor_id'] = $this->fornecedor_id;
              $this->dt_limite = $rs->fields[10] ; 
              $this->nmgp_dados_select['dt_limite'] = $this->dt_limite;
              $this->log_facilid_contato_fornec = $rs->fields[11] ; 
              $this->nmgp_dados_select['log_facilid_contato_fornec'] = $this->log_facilid_contato_fornec;
              $this->log_considerar_previsao = $rs->fields[12] ; 
              $this->nmgp_dados_select['log_considerar_previsao'] = $this->log_considerar_previsao;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->proc_compra_id = (string)$this->proc_compra_id; 
              $this->empresa_id = (string)$this->empresa_id; 
              $this->qt_container = (string)$this->qt_container; 
              $this->cod_situacao = (string)$this->cod_situacao; 
              $this->qt_dias_translado = (string)$this->qt_dias_translado; 
              $this->cotacao_prevista = (string)$this->cotacao_prevista; 
              $this->fornecedor_id = (string)$this->fornecedor_id; 
              $this->log_facilid_contato_fornec = (string)$this->log_facilid_contato_fornec; 
              $this->log_considerar_previsao = (string)$this->log_considerar_previsao; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['parms'] = "proc_compra_id?#?$this->proc_compra_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] < $qt_geral_reg_form_proc_compra;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opcao']   = '';
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
              $this->proc_compra_id = "";  
              $this->nmgp_dados_form["proc_compra_id"] = $this->proc_compra_id;
              $this->empresa_id = "2";  
              $this->nmgp_dados_form["empresa_id"] = $this->empresa_id;
              $this->qt_container = "";  
              $this->nmgp_dados_form["qt_container"] = $this->qt_container;
              $this->cod_situacao = "";  
              $this->nmgp_dados_form["cod_situacao"] = $this->cod_situacao;
              $this->cod_proc_fornec = "";  
              $this->nmgp_dados_form["cod_proc_fornec"] = $this->cod_proc_fornec;
              $this->qt_dias_translado = "";  
              $this->nmgp_dados_form["qt_dias_translado"] = $this->qt_dias_translado;
              $this->cotacao_prevista = "";  
              $this->nmgp_dados_form["cotacao_prevista"] = $this->cotacao_prevista;
              $this->observacao = "";  
              $this->nmgp_dados_form["observacao"] = $this->observacao;
              $this->dt_registro = "";  
              $this->dt_registro_hora = "" ;  
              $this->nmgp_dados_form["dt_registro"] = $this->dt_registro;
              $this->fornecedor_id = "";  
              $this->nmgp_dados_form["fornecedor_id"] = $this->fornecedor_id;
              $this->dt_limite = "";  
              $this->dt_limite_hora = "" ;  
              $this->nmgp_dados_form["dt_limite"] = $this->dt_limite;
              $this->log_facilid_contato_fornec = "";  
              $this->nmgp_dados_form["log_facilid_contato_fornec"] = $this->log_facilid_contato_fornec;
              $this->log_considerar_previsao = "";  
              $this->nmgp_dados_form["log_considerar_previsao"] = $this->log_considerar_previsao;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['foreign_key'] as $sFKName => $sFKValue)
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
//-- 
   function nm_db_retorna($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id < $this->proc_compra_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->proc_compra_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "inicio";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_avanca($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " where proc_compra_id > $this->proc_compra_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->proc_compra_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "final";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_inicio($str_where_param = '') 
   {   
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela; 
     $rs = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela);
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if ($rs->fields[0] == 0) 
     { 
         $this->nmgp_opcao = "novo"; 
         $this->nm_flag_saida_novo = "S"; 
         $rs->Close(); 
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return;
     }
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter']))
         { 
             $rs->Close();  
             return ; 
         } 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->proc_compra_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_final($str_where_param = '') 
   { 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(proc_compra_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->proc_compra_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
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
       $this->SC_log_arr['keys']['proc_compra_id'] =  $this->proc_compra_id;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dados_select'];
           $this->SC_log_arr['fields']['empresa_id']['0'] =  $nmgp_dados_select['empresa_id'];
           $this->SC_log_arr['fields']['qt_container']['0'] =  $nmgp_dados_select['qt_container'];
           $this->SC_log_arr['fields']['cod_situacao']['0'] =  $nmgp_dados_select['cod_situacao'];
           $this->SC_log_arr['fields']['cod_proc_fornec']['0'] =  $nmgp_dados_select['cod_proc_fornec'];
           $this->SC_log_arr['fields']['qt_dias_translado']['0'] =  $nmgp_dados_select['qt_dias_translado'];
           $this->SC_log_arr['fields']['cotacao_prevista']['0'] =  $nmgp_dados_select['cotacao_prevista'];
           $this->SC_log_arr['fields']['observacao']['0'] =  $nmgp_dados_select['observacao'];
           $this->SC_log_arr['fields']['dt_registro']['0'] =  $nmgp_dados_select['dt_registro'];
           $this->SC_log_arr['fields']['fornecedor_id']['0'] =  $nmgp_dados_select['fornecedor_id'];
           $this->SC_log_arr['fields']['dt_limite']['0'] =  $nmgp_dados_select['dt_limite'];
           $this->SC_log_arr['fields']['log_facilid_contato_fornec']['0'] =  $nmgp_dados_select['log_facilid_contato_fornec'];
           $this->SC_log_arr['fields']['log_considerar_previsao']['0'] =  $nmgp_dados_select['log_considerar_previsao'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['empresa_id']['1'] =  $this->empresa_id;
       $this->SC_log_arr['fields']['qt_container']['1'] =  $this->qt_container;
       $this->SC_log_arr['fields']['cod_situacao']['1'] =  $this->cod_situacao;
       $this->SC_log_arr['fields']['cod_proc_fornec']['1'] =  $this->cod_proc_fornec;
       $this->SC_log_arr['fields']['qt_dias_translado']['1'] =  $this->qt_dias_translado;
       $this->SC_log_arr['fields']['cotacao_prevista']['1'] =  $this->cotacao_prevista;
       $this->SC_log_arr['fields']['observacao']['1'] =  $this->observacao;
       $this->SC_log_arr['fields']['dt_registro']['1'] =  $this->dt_registro;
       $this->SC_log_arr['fields']['fornecedor_id']['1'] =  $this->fornecedor_id;
       $this->SC_log_arr['fields']['dt_limite']['1'] =  $this->dt_limite;
       $this->SC_log_arr['fields']['log_facilid_contato_fornec']['1'] =  $this->log_facilid_contato_fornec;
       $this->SC_log_arr['fields']['log_considerar_previsao']['1'] =  $this->log_considerar_previsao;
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
       $Log_labels['empresa_id'] =  "Empresa";
       $Log_labels['qt_container'] =  "Qt Container";
       $Log_labels['cod_situacao'] =  "Situação";
       $Log_labels['cod_proc_fornec'] =  "Cod Proc Fornec";
       $Log_labels['qt_dias_translado'] =  "Qt Dias Translado";
       $Log_labels['cotacao_prevista'] =  "Cotacao Prevista";
       $Log_labels['observacao'] =  "Observação";
       $Log_labels['dt_registro'] =  "Dt Registro";
       $Log_labels['fornecedor_id'] =  "Fornecedor";
       $Log_labels['dt_limite'] =  "Dt Limite";
       $Log_labels['log_facilid_contato_fornec'] =  "Facilidade de Contato com Fornecedor?";
       $Log_labels['log_considerar_previsao'] =  "Integra  Cta.Corrente Fornecedor?";
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function fornecedor_id_onChange()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
$original_proc_compra_id = $this->proc_compra_id;
$original_fornecedor_id = $this->fornecedor_id;

$this->local_validar_alt_fornec();


$modificado_proc_compra_id = $this->proc_compra_id;
$modificado_fornecedor_id = $this->fornecedor_id;
$this->nm_formatar_campos('proc_compra_id', 'fornecedor_id');
if ($original_proc_compra_id !== $modificado_proc_compra_id || isset($this->nmgp_cmp_readonly['proc_compra_id']) || (isset($bFlagRead_proc_compra_id) && $bFlagRead_proc_compra_id))
{
    $this->ajax_return_values_proc_compra_id(true);
}
if ($original_fornecedor_id !== $modificado_fornecedor_id || isset($this->nmgp_cmp_readonly['fornecedor_id']) || (isset($bFlagRead_fornecedor_id) && $bFlagRead_fornecedor_id))
{
    $this->ajax_return_values_fornecedor_id(true);
}
$this->NM_ajax_info['event_field'] = 'fornecedor';
form_proc_compra_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function local_validar_alt_fornec()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (!isset($this->sc_temp_reg_ant_procs_compra)) {$this->sc_temp_reg_ant_procs_compra = (isset($_SESSION['reg_ant_procs_compra'])) ? $_SESSION['reg_ant_procs_compra'] : "";}
  
$erro = $this->validarAltPedCompra($this->proc_compra_id );
if($erro <> ''){
	$this->fornecedor_id  = $this->sc_temp_reg_ant_procs_compra['fornecedor_id'];
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $erro;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_proc_compra';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_proc_compra';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $erro;
 }
;	
	
}
if (isset($this->sc_temp_reg_ant_procs_compra)) { $_SESSION['reg_ant_procs_compra'] = $this->sc_temp_reg_ant_procs_compra;}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function criarRegCtaCorrenFornec($fornecedorId,$data,$itemProcCompraId,$historico,$codTipoMovto,$vlLancto,
                                 $codAcao,$numIdTitAp=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
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
        $this->inserirLogDb('Comando',$cmd,__FUNCTION__);
        
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $logCriar;
if (isset($this->sc_temp_transacao_universal)) { $_SESSION['transacao_universal'] = $this->sc_temp_transacao_universal;}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function alterarFornecItensPed($pedido,$fornec)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aItens =  $this->getIDItensProcCompra($pedido);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompra = $aItens[$i]['item_proc_compra_id'];
            $cmd = "update pub.cta_corren_fornec_imp set fornecedor_id = $fornec 
            where item_proc_compra_id = $itemProcCompra ";
        }
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function verifTitPedImp($numIdTitulo)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarPgtosContainerPedImp($containerParam,$descOrigem='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
    setTransacaoUniversal($transacaoId);
    $listaTitulos = $this->buscarTitAssociadosContainer($containerParam);
    $this->inserirLogDb('inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    $this->inserirLogDb('Lista de Titulos a estornar os lancamentos ',$listaTitulos,__FUNCTION__);
    if($listaTitulos <> ''){
        $aTitulos = explode(',',$listaTitulos);
        if(is_array($aTitulos)){
            $tam = count($aTitulos);
            $this->incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $titulo = $aTitulos[$i];
                $this->estornarTitAssocPedImp($titulo,$descOrigem);
            }
            $this->decrNivelCorrenteLogDb();
        }
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoId);


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarPagtosContainerSemItens($containerParam,$histCompl,$itemContainerParam=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $logExiste = existItensContainer($containerParam);
    $descLogExiste = $this->convLogEmString($logExiste);
    $this->inserirLogDb('Inicio Log funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Existem Itens associados ao container?',$descLogExiste,__FUNCTION__);
    $data      = date('Y-m-d');
    if($logExiste == false){
        $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
        setTransacaoUniversal($transacaoId);
        $this->inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $listaTitulos = $this->buscarTitAssociadosContainer($containerParam);
        $this->inserirLogDb('Lista de Titulos Associados ao container sem itens',$listaTitulos,__FUNCTION__);
        if($listaTitulos <> ''){
            $aTitulos = explode(',',$listaTitulos);
            if(is_array($aTitulos)){
                $tam = count($aTitulos);
                $this->inserirLogDb('inicio laco do for $aTitulos - tamanho',$tam,__FUNCTION__);
                $this->incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    $this->inserirLogDb('array - posicao',$i,__FUNCTION__);
                    $titulo = $aTitulos[$i];
                    $aReg = $this->getSomasCtaCorrenFornec('6',
                        true,
                        $titulo);
                    if(is_array($aReg)){
                        $tam2 = count($aReg);
                        for($j=0;$j<$tam2;$j++){
                            $this->incrNivelCorrenteLogDb();
                            $fornec             = $aReg[$j]['fornecedor_id'];
                            $itemPedidoId       = $aReg[$j]['item_proc_compra_id'];
                            $valor              = $aReg[$j]['valor'] * -1 ;
                            $itemContainerId    = $aReg[$j]['item_container_id'];
                            if($itemContainerParam <> 0 and $itemContainerParam <> $itemContainerId){
                                continue;
                            }
                            $this->inserirLogDb('fornecedor',$fornec,__FUNCTION__);
                            $this->inserirLogDb('itemPedidoId',$itemPedidoId,__FUNCTION__);
                            $this->inserirLogDb('valor',$valor,__FUNCTION__);
                            $this->inserirLogDb('itemContainerId',$itemContainerId,__FUNCTION__);
                            $this->decrNivelCorrenteLogDb();
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
                            $this->inserirLogDb('Apos Criar o registro do tipo de movto 6 , acao 3',"Movto Criado? $descRetCriacao",__FUNCTION__);
                        }
                    }
                }
                $this->decrNivelCorrenteLogDb();
            }
        }
        finalizarTransacao($transacaoId);
        $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarPagtosItemContainer($itemContainerId,$histCompl)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPagtosItemContainer');
    setTransacaoUniversal($transacaoId);
    $data      = date('Y-m-d');
    $this->inserirLogDb("transacao",$transacaoId,__FUNCTION__);
    $aReg = $this->getSomasCtaCorrenFornec(5,true,0,0,$itemContainerId);
    $descAReg = $this->convArrayToString($aReg);
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb("Array de retorno da funcao getSomaCtaCorrenFornec informado o tipo movto 5 e o item container: $itemContainerId",
                   $descAReg,__FUNCTION__);
    if(is_array($aReg)){
        $tam = count($aReg);
        $this->incrNivelCorrenteLogDb();
        for($i=0;$i<$tam;$i++){
            $this->inserirLogDb(" For do Array - registro",$i,__FUNCTION__);
            $this->incrNivelCorrenteLogDb();

            $fornec             = $aReg[$i]['fornecedor_id'];
            $itemPedidoId       = $aReg[$i]['item_proc_compra_id'];
            $valor              = $aReg[$i]['valor'] * -1 ;
            $numIdTitulo        = $aReg[$i]['num_id_tit_ap'];

            $this->inserirLogDb('fornecedor',$fornec,__FUNCTION__);
            $this->inserirLogDb('itemPedidoId',$itemPedidoId,__FUNCTION__);
            $this->inserirLogDb('valor',$valor,__FUNCTION__);
            $this->inserirLogDb('numIdTitulo',$numIdTitulo,__FUNCTION__);

            $this->decrNivelCorrenteLogDb();
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
            $this->inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 6 e acao 3',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
        $this->decrNivelCorrenteLogDb();
    }
    finalizarTransacao($transacaoId);
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarTitAssocPedImp($numIdTitulo,$descOrigem='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $logAssociado = $this->verifTitPedImp($numIdTitulo);
    $descrLogAssociado = $this->convLogEmString($logAssociado);
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Titulo associado a algum Pedido de Compra e que tenha gerado movto cta corrente fornecedor?',
        $descrLogAssociado,__FUNCTION__);
    if($logAssociado == true){
        $aRet =  $this->getSomasCtaCorrenFornec('4', 
            true,$numIdTitulo);
        $descARet = $this->convArrayToString($aRet);
        $this->inserirLogDb("Array resultante da funcao getSomaCtaCorrenFornec com os parametros: Tipo Movto=4,Quebra=true 
                            e NumIdTitulo=$numIdTitulo ",$descARet,__FUNCTION__);
        if(is_array($aRet)){
            $tam = count($aRet);
            $data = date('Y-m-d');
            $this->incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $fornec         = $aRet[$i]['fornecedor_id'];
                $itemPedidoId   = $aRet[$i]['item_proc_compra_id'];
                $valor          = $aRet[$i]['valor'];
                $this->inserirLogDb('fornecedor:',$fornec,__FUNCTION__);
                $this->inserirLogDb('ID item Pedido:',$itemPedidoId,__FUNCTION__);
                $this->inserirLogDb('valor:',$valor,__FUNCTION__);
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
                $this->inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 1 - movto negativo',
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);
            }


            $this->decrNivelCorrenteLogDb();
        }
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarPagtosContainer($nivel, $id,$histCompl='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $data     = date('Y-m-d');
    switch($nivel){
        case 1:
            $this->inserirLogDb("Nivel:","1",__FUNCTION__);
            $tipo     = "multi"; 
            $tabela   = " pub.pagtos_container ";
            $campos   = " num_id_tit_ap ";
            $condicao = "  container_id = $id ";
            $conexao  = "espec";
            $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
            $arrayTxt = $this->convArrayToString($aReg);
            $this->inserirLogDb("Array Titulos do container:$id",$arrayTxt,__FUNCTION__);

            if(is_array($aReg)){
                $tam = count($aReg);
                $this->incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    $titulo = $aReg[$i]['num_id_tit_ap'];
                    $this->inserirLogDb('titulo encontrado?',$titulo,__FUNCTION__);
                    $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$titulo);
                    $arrayTxt = $this->convArrayToString($aSaldo);
                    $this->inserirLogDb("Array do retorno da funcao getsomasCtaCorrenFornec - tipo movto:5,6 - quebra:sim - titulo:$titulo",$arrayTxt,
                        __FUNCTION__);
                    if(is_array($aSaldo)){
                        $tam2 = count($aSaldo);
                        $this->incrNivelCorrenteLogDb();
                        for($j=0;$j<$tam2;$j++){
                            $fornec         = $aSaldo[$j]['fornecedor_id'];
                            $this->inserirLogDb("fornecedor:",$fornec,__FUNCTION__);
                            $itemPedidoId   = $aSaldo[$j]['item_proc_compra_id'];
                            $this->inserirLogDb("item Pedido:",$itemPedidoId,__FUNCTION__);
                            $valor          = $aSaldo[$j]['valor'];
                            $this->inserirLogDb('valor',$valor,__FUNCTION__);
                            $itemContainerId = $aSaldo[$j]['item_container_id'];
                            $this->inserirLogDb('item container:',$itemContainerId,__FUNCTION__);
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
                            $this->inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        }
                        $this->decrNivelCorrenteLogDb();
                    }
                }
                $this->decrNivelCorrenteLogDb();
            }
            break;
        case 2:
            $this->inserirLogDb("Nivel:","2",__FUNCTION__);
            $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$id);
            $arrayTxt = $this->convArrayToString($aSaldo);
            $this->inserirLogDb("Array retorno getSomasCtaCorrenFornec - tipo movto:5  - quebra:sim - titulo $id",
                $arrayTxt,__FUNCTION__);
            if(is_array($aSaldo)){
                $tam2 = count($aSaldo);
                for($j=0;$j<$tam2;$j++){
                    $fornec         = $aSaldo[$j]['fornecedor_id'];
                    $this->inserirLogDb("fornecedor:",$fornec,__FUNCTION__);
                    $itemPedidoId   = $aSaldo[$j]['item_proc_compra_id'];
                    $this->inserirLogDb("item Pedido:",$itemPedidoId,__FUNCTION__);
                    $valor          = $aSaldo[$j]['valor'];
                    $this->inserirLogDb('valor',$valor,__FUNCTION__);
                    $itemContainerId = $aSaldo[$j]['item_container_id'];
                    $this->inserirLogDb('item container:',$itemContainerId,__FUNCTION__);
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
                    $this->inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                        "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                }
            }
            break;
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSomasCtaCorrenFornec($tipoMovto,
                                 $logQuebra,
                                 $numIdTitulo=0,
                                 $itemPedId=0,
                                 $itemContainerId=0,
                                 $fornecId=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function estornarSaldoPgtosItemPed($itemPedido,$historico='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
            $this->inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 3 - movto negativo',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function verificarSaldoInicialFornec($fornec)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $retorno = false;
    $tabela = " pub.cta_corren_fornec_imp  ";
    $campo  = "fornecedor_id";
    $condicao = " fornecedor_id = $fornec and cod_tipo_movto = 1 ";
    $aResultado = $this->retornoSimplesTb01($tabela,$campo	,$condicao,"espec");
    if(is_array($aResultado)){
        $retorno = true ;
    }
    return $retorno;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarVlPagarItemPedido($itemProcCompra,$vlLancto,$acao)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $data = date('Y-m-d');
    $procCompraID = $this->buscarProcCompraItem($itemProcCompra);
    $aPedido = $this->getDadosPedidoImp($procCompraID);
    $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    $descLogGerarPrevisao = $this->convLogEmString($logGerarPrevisao);
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb("Pedido de Compra $procCompraID integra cta.corrente fornecedor? ",$descLogGerarPrevisao,__FUNCTION__);
    if($logGerarPrevisao == 1) {
        $transacaoId = iniciarTransacao('gerarVlPagarItemPedido');
        setTransacaoUniversal($transacaoId);
        $this->inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $vlSaldo = $this->getSaldoVlPagarItemPedido($itemProcCompra);
        $fornecedor = $this->buscarFornecItemProcCompra($itemProcCompra);
        $this->inserirLogDb("Fornecedor Item do Pedido", $fornecedor,__FUNCTION__);
        $descItem   = $this->buscarDescItemProcCompra($itemProcCompra);
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
        $this->inserirLogDb('Descricao da Acao:',$descAcao,__FUNCTION__);
        $vlDif  = $vlLancto - $vlSaldo;
        $this->inserirLogDb("Vl.Lancto passado por parametro", $vlLancto,__FUNCTION__);
        $this->inserirLogDb("vl.saldo(item do pedido:$itemProcCompra)", $vlSaldo,__FUNCTION__);
        $this->inserirLogDb("Vl. Diferenca", $vlDif,__FUNCTION__);
        if($vlDif <> 0  ){
            if($vlDif > 0){
                $historico = "Geracao de Lancamento automatico na $descAcao do item do pedido de importacao - $descItem";
                $this->inserirLogDb('historico para diferenca maior que zero',$historico);

            }else{
                $historico = "Estorno de Geracao de Lancamento automatico na $descAcao do item do 
                            pedido de importacao - $descItem";
                $this->inserirLogDb('historico para diferenca menor que zero',$historico);
            }
            $this->inserirLogDb("chamada da funcao para criacao do movimento do conta corrente do fornecedor",
                'criaRegCtaCorrenFornec',__FUNCTION__);
            $retCriacao = $this->criarRegCtaCorrenFornec($fornecedor,$data,$itemProcCompra,$historico,3,$vlDif ,$acao);
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $acao",
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
        }
        finalizarTransacao($transacaoId);
    }else{
        $this->inserirLogDb('Lancamento nao gerado',
            'pedido de compra configurado para nao integrar conta corrente fornecedor ',__FUNCTION__);
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoVlPagarItemPedido($itemProcCompra)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
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
    $this->inserirLogDb("Total dos lancamentos para o item do pedido de compra = $itemProcCompra com tipo movto = 3(itens pedido)",
        $vlSaldo,__FUNCTION__);
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    return $vlSaldo;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function sincrRateioAntecipPedImp($procCompra,$histCompl,$logForcarRateio = false)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $retorno = 0;
    $prog = 'sincrRateioAntecipPedImp';
    $transacaoId = iniciarTransacao($prog);
    setTransacaoUniversal($transacaoId);
    $aPedido = $this->getDadosPedidoImp($procCompra);
    if(is_array($aPedido)){
        $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    }else{
        $logGerarPrevisao = 0;
    }

    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    if($logGerarPrevisao == 0){
        $titulo = "Sincronizacao de Rateio de Pagtos - Ped.Importacao";
        $this->inserirLogDb($titulo, "Pedido de compra configurado para nao integrar com cta.corrente fornecedor",
            __FUNCTION__
        );
    }else{
        $titulo = "Sincronizacao de Rateio de Pagtos - Ped.Importacao";
        $this->inserirLogDb($titulo, "Busquei a lista de titulos a partir da funcao buscarTitAssociadosProcCompra -> $procCompra",
            __FUNCTION__
        );
        $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompra);
        $this->inserirLogDb($titulo,"Lista de titulos: $listaTitulos",__FUNCTION__);
        if($listaTitulos <> ''){
            $aTitulos = explode(',',$listaTitulos);
            if(is_array($aTitulos)){
                $tam = count($aTitulos);
                for($i=0;$i<$tam;$i++){
                    $numIdTitAp = $aTitulos[$i];
                    $logRateio = $this->verificarNecesAtualizPgtoPedido($numIdTitAp);
                    if($logForcarRateio == true){
                        $logRateio = $logForcarRateio;
                        $this->inserirLogDb('Forcar Rateio','Sim',__FUNCTION__);
                    } else{
                        $this->inserirLogDb('Forcar Rateio','Nao',__FUNCTION__);
                    }
                    if($logRateio == true){
                        $descrLogRateio = 'sim';
                    }else{
                        $descrLogRateio = 'nao';
                    }
                    $this->inserirLogDb($titulo,"Eh necessario o rateio  $descrLogRateio",__FUNCTION__);
                    $this->incrNivelCorrenteLogDb();
                    if($logRateio == true){
                        $this->gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl);
                        $retorno = 1;
                    }
                    $this->decrNivelCorrenteLogDb();
                }
            }
        }
        finalizarTransacao($transacaoId);
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    return $retorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl='',$logEstorno=false)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $titLog = "Geracao de Rateio Pgtos - Ped.Imp";
    $data   = date('Y-m-d');
    $empImp = $this->buscarEmpProcCompra($procCompra);
    $codEmp  = buscarcodEmpresa($empImp,'importacao','ems5');
    $codEstab = getEstabEms5($codEmp) ;
    $vlAdiantDolar  =   $this->buscarVlMoeda($numIdTitAp,'','dolar' );
    $vlNegEmDolar   = $this->buscarPonderacaoItensProcCompra($procCompra);
    $aItens = $this->getIDItensProcCompra($procCompra);
    $fornecedor         = $this->buscarFornecedorProcCompra($procCompra);
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb("Fornecedor do pedido de compra",$fornecedor,__FUNCTION__);
    $this->incrNivelCorrenteLogDb();
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId   = $aItens[$i]['item_proc_compra_id'];
            $vlItem             = $this->buscarPonderacaoItensProcCompra($procCompra,'negociado',$itemProcCompraId);
            $pondItem           = $vlItem / $vlNegEmDolar;
            $vlPagtoItem        = $vlAdiantDolar * $pondItem;
            $this->inserirLogDb('Composicao de Valores ',"item pedido:{$itemProcCompraId}",__FUNCTION__);
            $this->incrNivelCorrenteLogDb();
            $this->inserirLogDb('Vl.negociado do item ',$vlItem,__FUNCTION__);
            $this->inserirLogDb('Vl.total ',$vlNegEmDolar,__FUNCTION__);
            $this->inserirLogDb('Ponderacao Item ',$pondItem,__FUNCTION__);
            $this->inserirLogDb('Vl.pagto item ',$vlPagtoItem,__FUNCTION__);
            $this->decrNivelCorrenteLogDb();

            $vlSaldoRatItem     = $this->getSaldoFornecAntItem($fornecedor,$numIdTitAp,$itemProcCompraId);
            $this->inserirLogDb("Saldo anterior do fornecedor do pedido de compra para o item e o adiantamento",
                            $vlSaldoRatItem,__FUNCTION__);
            $vlDif              = $vlPagtoItem + $vlSaldoRatItem;
            $vlDif              = round($vlDif,2);
            $this->inserirLogDb("Vl.dif($vlDif) ","Vl.pagto item: {$vlPagtoItem} + vl. saldo rat.item: {$vlSaldoRatItem}",__FUNCTION__);
            if($logEstorno == true){
                $this->inserirLogDb("Parametro para estornar igual a sim","Vl.dif = vl.saldo rat.item({$vlSaldoRatItem})",__FUNCTION__);
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

                $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $codAcao",
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);

            }
        }
        $this->decrNivelCorrenteLogDb();
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function atuRatPagtoPedTitContainer($numIdTitAp, $histCompl='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $this->inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb(' param titulo:',$numIdTitAp,__FUNCTION__);
    $this->inserirLogDb(' param histCompl:',$histCompl,__FUNCTION__);
    $this->inserirLogDb('antes da funcao getProcCompraPgto - param titulo:',$numIdTitAp,__FUNCTION__);
    $procCompraId = $this->getProcCompraPgto($numIdTitAp);
    $this->inserirLogDb('pedido de compra',$procCompraId,__FUNCTION__);
    if($procCompraId <> 0){
        $this->inserirLogDb('pedido de compra zerado?','nao',__FUNCTION__);
        $this->inserirLogDb('vou chamar a funcaFo sincrRateioAntecipPedImp - param titulo|hist',"$numIdTitAp | $histCompl",__FUNCTION__);
        $this->incrNivelCorrenteLogDb();
        $this->sincrRateioAntecipPedImp($procCompraId,$histCompl, true);
        $this->decrNivelCorrenteLogDb();
    }else{
        $this->inserirLogDb('pedido de compra zerado?','sim',__FUNCTION__);
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function atuRatPagtoPedItemContainer($itemPedido,$histCompl)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $procCompraId = $this->buscarProcCompraItem($itemPedido) ;
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Pedido de Compra(ID) do item do container',$procCompraId,__FUNCTION__);
    if($procCompraId <> 0){
        $this->incrNivelCorrenteLogDb();
        $this->sincrRateioAntecipPedImp($procCompraId,$histCompl);
        $this->decrNivelCorrenteLogDb();
    }else{
        $this->inserirLogDb('Item do Container sem item do Pedido de Compra Associado');
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoFornecAntItem($fornec, $numIdTitAp,$itemProcCompra )
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoFornecTituloItemRatContainer($fornec, $numIdTitAp,$itemProcCompra,$itemContainerId )
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarRateioFornecAntecipsContainer($container,$histCompl='',$logEstorno=false,$titulo=0,$itemContainer=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $data = date('Y-m-d');
    $vlProformaEmDolar  = buscarTotCustoPrevDolarContainer($container, 'proforma');
    $codFornecContainer = buscarFornecedorContainer($container);
    $estab         = buscarEstabContainer($container);
    $estab          = getEstabEms5($estab);
    $listaTitulos     = $this->buscarTitAssociadosContainer($container);
    $transacaoId      = iniciarTransacao(__FUNCTION__);
    $this->inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('container passado por parametro',$container,__FUNCTION__);
    $this->inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
    $this->inserirLogDb('Lista de Titulos Associados ao Container',$listaTitulos,__FUNCTION__);

    if($listaTitulos <> ''){
        $aTitulos = explode(',',$listaTitulos);
        if(is_array($aTitulos)){
            $tam = count($aTitulos);
            $this->incrNivelCorrenteLogDb();
            for($i=0;$i<$tam;$i++){
                $numIdTitAp = $aTitulos[$i];
                if($numIdTitAp == '' or $numIdTitAp == 0){
                    continue;
                }
                $this->inserirLogDb('Num.Tit.AP.',$numIdTitAp,__FUNCTION__);
                if($titulo<> 0){
                    if($titulo <> $numIdTitAp){
                        continue;
                    }
                }
                $vlTitDolar = $this->buscarVlMoeda($numIdTitAp,'','dolar');
                $this->inserirLogDb('Vl.Tit.Dolar',$vlTitDolar,__FUNCTION__);
                $aItens     = buscarIDItensContainer($container);
                $descAItens = $this->convArrayToString($aItens);
                $this->inserirLogDb('Array Itens do container',$descAItens,__FUNCTION__);
                if(is_array($aItens)){
                    $tam2 = count($aItens);
                    $this->incrNivelCorrenteLogDb();
                    for($j=0;$j<$tam2;$j++){
                        $itemContainerId  = $aItens[$j]['item_container_id'];
                        $this->inserirLogDb('Id Item do Container',$itemContainerId,__FUNCTION__);
                        if($itemContainer <> 0){
                            if($itemContainer <> $itemContainerId){
                                continue;
                            }
                        }
                        $vlProformaItem        = buscarTotCustoPrevDolarContainer($container,'proforma',$itemContainerId);
                        $itemProcCompraId = $aItens[$j]['item_proc_compra_id'];
                        $this->inserirLogDb('Id  item ped.imp.',$itemProcCompraId,__FUNCTION__);
                        $descItem         = $this->buscarDescItemProcCompra($itemProcCompraId);
                        $codFornecPedImp  = $this->buscarFornecItemProcCompra($itemProcCompraId);
                        if($vlProformaEmDolar * $vlTitDolar <> 0){
                            $vlLancto         = $vlProformaItem / $vlProformaEmDolar * $vlTitDolar;
                        }else{
                            $vlLancto = 0;
                        }

                        $this->inserirLogDb('Valores da Formula de calculo do vl.lancto',$vlLancto,__FUNCTION__);
                        $this->incrNivelCorrenteLogDb();
                        $this->inserirLogDb('vl.proforma Item',$vlProformaItem,__FUNCTION__);
                        $this->inserirLogDb('vl.proforma em dolar',$vlProformaEmDolar,__FUNCTION__);
                        $this->inserirLogDb('vl.tit.dolar',$vlTitDolar,__FUNCTION__);
                        $this->decrNivelCorrenteLogDb();
                        
                        $vlSaldoCtaFornecPedImp      = round($this->getSaldoFornecTituloItemRatContainer ($codFornecPedImp,
                            $numIdTitAp,$itemProcCompraId,$itemContainerId),2);
                        $this->inserirLogDb('saldo ja lancado no conta corrente para o item 
                                   proc compra e para o titulo',$vlSaldoCtaFornecPedImp,__FUNCTION__);
                        $vlDifPedImp                 = round($vlLancto + $vlSaldoCtaFornecPedImp,2) ;
                        $this->inserirLogDb('Valores que compoem o Dif.Ped.Imp',$vlDifPedImp,__FUNCTION__);
                        $this->incrNivelCorrenteLogDb();
                        $this->inserirLogDb('vl.lancto',$vlLancto,__FUNCTION__);
                        $this->inserirLogDb('vl.saldo Cta Corren fornec ped imp',$vlSaldoCtaFornecPedImp,__FUNCTION__);
                        $this->decrNivelCorrenteLogDb();
                        $descLogEstorno = $this->convLogEmString($logEstorno);
                        $this->inserirLogDb('Estorno?',$descLogEstorno,__FUNCTION__);
                        if($logEstorno == true){
                            $vlDifPedImp = $vlSaldoCtaFornecPedImp;
                        }
                        

                        if($vlDifPedImp <> 0){
                            $this->inserirLogDb('Valor da Diferenca Ped.Imp. Diferente de zero?','sim',__FUNCTION__);
                            if($codFornecContainer <> $codFornecPedImp){
                                $this->inserirLogDb('fornecedor do container diferente do fornecedor do pedido?','sim',__FUNCTION__);
                                $histFornec = " para o fornecedor $codFornecPedImp ";
                            } else{
                                $histFornec = " ";
                                $this->inserirLogDb('fornecedor do container diferente do fornecedor do pedido?','nao',__FUNCTION__);
                            }
                            if($vlDifPedImp > 0){ 
                                $this->inserirLogDb('Diferenca do Pedido Imp. maior quero?','sim. Rateio',__FUNCTION__);
                                $codAcao   = 1;
                                $sinal     = -1;
                                $historico = "Rateio de valor pago ao fornecedor $codFornecContainer 
                                    $histFornec , referente ao item $descItem alocado ao container $container $histCompl";
                            }else{ 
                                $this->inserirLogDb('Diferenca do Pedido Imp. maior quero?','nao. Estorno.',__FUNCTION__);
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
                            $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao $codAcao",
                                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        }else{
                            $this->inserirLogDb('Valor da Diferenca Ped.Imp. Diferente de zero?','nao',__FUNCTION__);
                        }
                    }
                    $this->decrNivelCorrenteLogDb();
                }
            }
            $this->decrNivelCorrenteLogDb();
        }
    }
    $this->inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoId);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarRateioFornecContainer($container, $tipoMovto)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $vlNegEmDolar  = buscarTotCustoPrevDolarContainer($container, 'negociado');
    $vlPagoEmDolar = $this->buscarTotPagoContainer($container,'dolar');
    $codFornecContainer = buscarFornecedorContainer($container);
    $data = date('Y-m-d');
    $aItens = buscarIDItensContainer($container);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemContainerId  = $aItens[$i]['item_container_id'];
            $vlNegItem        = buscarTotCustoPrevDolarContainer($container, 'negociado',$itemContainerId);
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $descItem         = $this->buscarDescItemProcCompra($itemProcCompraId);
            $codFornecPedImp  = $this->buscarFornecItemProcCompra($itemProcCompraId);
            $vlLancto         = $vlNegItem / $vlNegEmDolar * $vlPagoEmDolar;
            if($codFornecContainer <> $codFornecPedImp){
                switch($tipoMovto){
                    case 1: 
                        $historico = "Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 - negativo ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto,0 );
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        break;
                    case 2: 
                        $historico = "ESTORNO da Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                         $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto ,0);
                         $descrRetCriacao = $this->convLogEmString($retCriacao);
                        $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        $this->inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        break;
                }
            }
        }
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoAntCtaCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aDados = $this->getDadosCtaCorrenFornecImp($fornecedor,'vl_lancto','cod_tipo_movto = 1' );
    if(is_array($aDados)){
        $vlSaldoAnterior = $aDados[0]['vl_lancto'];
    }else{
        $vlSaldoAnterior = 0;
    }
    return $vlSaldoAnterior;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getTotLancManualFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getCpSomaSaldoPorSitContainer()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoNaoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getSaldoEntreguePortoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDadosCtaCorrenFornecImp($fornecedor,$campos='',$cond='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function eliminarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $this->inserirLogDb('Inicio',__FUNCTION__,__FUNCTION__);
    $aItens = $this->getIDItensProcCompra($pedImp);
    if(is_array($aItens)){
        $this->incrNivelCorrenteLogDb();
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $id = $aItens[$i]['item_proc_compra_id'];
            $this->inserirLogDb('ID Item do Container - Registros serao deletados',$id,__FUNCTION__);
            $cmd = "delete from pub.cta_corren_fornec_imp where item_proc_compra_id = $id
            and cod_tipo_movto > 2";
            
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            $this->inserirLogDb('Registros deletados',"SIM-Comando:$cmd",__FUNCTION__);

        }
        $this->decrNivelCorrenteLogDb();
    }else{
        $this->inserirLogDb('Nao foram encontrados itens','SIM',__FUNCTION__);
    }
    $this->inserirLogDb('Final',__FUNCTION__,__FUNCTION__);
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function ajustarCtaCorrenFornec()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $this->inserirLogDb('Inicio Bloco 0 - exclusao dos lancamentos dos pedidos de compra que nao integram com o cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    $this->incrNivelCorrenteLogDb();
    $this->eliminarLanctosPedidosNaoIntegrCtaCorrente();
    $this->decrNivelCorrenteLogDb();
    $this->inserirLogDb('FIM Bloco 0 - exclusao dos lancamentos dos pedidos de compra que nao integram com o cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Inicio Bloco 1 - GERACAO DE LANCAMENTOS PEDIDOS INTEGR.CTA.CORREN. ',__FUNCTION__,__FUNCTION__);
    $this->incrNivelCorrenteLogDb();
    $this->gerarLanctosPedidosIntegrCtaCorrente();
    $this->decrNivelCorrenteLogDb();
    $this->inserirLogDb('Fim Bloco 1 - GERACAO DE LANCAMENTOS PEDIDOS INTEGR.CTA.CORREN. ',__FUNCTION__,__FUNCTION__);
    $this->eliminarLanctosPedidosNaoIntegrCtaCorrente();


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $listaItensPedido = '';
    $listaContainersGeral = '';
    $transacaoID = iniciarTransacao(__FUNCTION__);
    setTransacaoUniversal($transacaoID);
    $this->inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('transacao',$transacaoID,__FUNCTION__);

    $this->inserirLogDb('inicio Bloco 0 - exclusao dos lancamentos do pedido de compra no cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    $this->incrNivelCorrenteLogDb();
    $this->eliminarLanctosCtaCorrenPedImp($pedImp);
    $this->decrNivelCorrenteLogDb();
    $this->inserirLogDb('Fim Bloco 0 - exclusao dos lancamentos do pedido de compra no cta.corrente fornecedor',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Inicio Bloco 1 - geracao dos lancamentos de valores a pagar a partir dos itens do pedido de compra',
        __FUNCTION__,__FUNCTION__);
    $aItens = $this->getIDItensProcCompra($pedImp);
    $this->inserirLogDb('chamei a getIDItensProcCompra -> pedido',$pedImp,__FUNCTION__);
    if(is_array($aItens)){
        $this->incrNivelCorrenteLogDb();
        $this->inserirLogDb('ACHEI itens no pedido de compra ',$pedImp,__FUNCTION__);
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $this->inserirLogDb('item proc compra',$itemProcCompraId,__FUNCTION__);
            $listaItensPedido = $this->util_incr_valor($listaItensPedido,$itemProcCompraId);
            $this->inserirLogDb('chamei a retornarCampoItemProcCompra -> pedido',$itemProcCompraId);
            $aDadosItem =  $this->retornarCampoItemProcCompra($itemProcCompraId,'qt_comprada,vl_negociado');
            if(is_array($aDadosItem)){
                $qtComprada  = $aDadosItem[0]['qt_comprada'];
                $this->inserirLogDb('qt.comprada',$qtComprada,__FUNCTION__);
                $vlNegociado = $aDadosItem[0]['vl_negociado'];
                $this->inserirLogDb('vl.negociado',$vlNegociado,__FUNCTION__);
                $valor = $qtComprada * $vlNegociado;
                $this->inserirLogDb('valor',$valor);
                $this->gerarVlPagarItemPedido($itemProcCompraId,$valor,1);
                $this->inserirLogDb('apos chamar a funcao gerarVlPagarItemPedido','acao 1',__FUNCTION__);
            }else{
                $valor = 0;
                $this->inserirLogDb('nao achei o registro do item',$itemProcCompraId,__FUNCTION__);
            }
        }
        $this->decrNivelCorrenteLogDb();
    }else{
        $this->inserirLogDb('Nao achei itens no pedido de compra ',$pedImp,__FUNCTION__);
    }
    $this->inserirLogDb('Final Bloco 1 - geracao dos lancamentos de valores a pagar a partir dos itens do pedido de compra', __FUNCTION__,__FUNCTION__);

    $this->inserirLogDb('Inicio Bloco 2 - geracao dos lancamentos de adiantamento',
        __FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('vou chamar a funcao buscarTitAssociadosProcCompra -> pedido',$pedImp,__FUNCTION__);
    $listaPagtosPedido = $this->buscarTitAssociadosProcCompra($pedImp);
    $this->inserirLogDb('Lista de Pagtos Pedido',$listaPagtosPedido,__FUNCTION__);
    $aPagtosPedido = explode(',',$listaPagtosPedido);
    if(is_array($aPagtosPedido) and $listaPagtosPedido <> '' ){
        $this->incrNivelCorrenteLogDb();
        $tam = count($aPagtosPedido);
        for($i=0;$i< $tam; $i++){
            $idPgto = $aPagtosPedido[$i];
            $this->inserirLogDb('numero do ID do adiantamento',$idPgto,__FUNCTION__);
            $historico = "Geracao automatica na associacao de antecipacao de pagto ao 
            Pedido de Importacao:$pedImp - Titulo:$idPgto";
            $this->gerarRateioAntecipPedImp($pedImp,$idPgto,$historico);
            $this->inserirLogDb('Apos chamar a funcao $this->gerarRateioAntecipPedImp(pedImp,idPgto,historico)',"($pedImp,$idPgto,$historico)",__FUNCTION__);

        }
    }
    $this->inserirLogDb('Final Bloco 2 - geracao dos lancamentos de adiantamento',  __FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Inicio Bloco 3 - geracao dos lancamentos de adiantamento associados ao container',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('Lista de Itens do Pedido gerada no bloco 1 ',$listaItensPedido);
    $aItensPedido = explode(',',$listaItensPedido);
    if(is_array($aItensPedido)){
        $this->incrNivelCorrenteLogDb();
        $tam = count($aItensPedido);
        $this->inserirLogDb('Lista de itens Vazia?','Nao(qt.$tam)',__FUNCTION__);
        for($i=0;$i< $tam; $i++){
            $itemPedido = $aItensPedido[$i];
            if($itemPedido == ''){
                continue;
            }
            $this->inserirLogDb('item pedido', $itemPedido,__FUNCTION__);
            $this->inserirLogDb('vou chamar a funcao getIdContainersAlocItemPedImp(itemPedido)',"($itemPedido)",__FUNCTION__);
            $listaContainers = getIdContainersAlocItemPedImp($itemPedido);
            $this->inserirLogDb('Lista de Containers - retorno getIdContainerAlocItemPedImp',$listaContainers);
            $aContainers = explode(',',$listaContainers);
            if($listaContainers <> ''){
                $listaContainersGeral = $this->util_incr_valor($listaContainersGeral,$listaContainers,',');
            }
            if(is_array($aContainers) and $listaContainers <> ''){
                $this->incrNivelCorrenteLogDb();
                $tam2 = count($aContainers);
                for($j=0;$j< $tam2; $j++){
                    $container = $aContainers[$j];
                    $this->inserirLogDb('CONTAINER',$container,__FUNCTION__);
                    $this->inserirLogDb('vou chamar a funcao estornarPagtoscontainerPedImp(container)',"($container)",__FUNCTION__);
                    $this->incrNivelCorrenteLogDb();
                    $this->estornarPgtosContainerPedImp($container,'ASSOCIAcaO DE TITULO');
                    $this->decrNivelCorrenteLogDb();
                    $this->inserirLogDb('vou chamar a funcao $this->gerarRateioFornecAntecipsContainer(container)',"($container)",__FUNCTION__);
                    $this->incrNivelCorrenteLogDb();
                    $this->gerarRateioFornecAntecipsContainer($container,'ASSOCIAcaO DE TITULO ');
                    $this->decrNivelCorrenteLogDb();
                    
                }
                $this->decrNivelCorrenteLogDb();
            }
        }
        $this->decrNivelCorrenteLogDb();
    }else{
        $this->inserirLogDb('Lista de itens Vazia?','SIM',__FUNCTION__);
    }
    $this->inserirLogDb('Fim Bloco 3 - geracao dos lancamentos de adiantamento associados ao container',__FUNCTION__,__FUNCTION__);

    $this->inserirLogDb('Inicio Bloco 4 - geracao dos lancamentos de confirmacao da qt. embarcada ',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('lista de containers - qt.emb',$listaContainersGeral,__FUNCTION__);
    $aContainersGeral = explode(',',$listaContainersGeral);
    if(is_array($aContainersGeral) and $listaContainersGeral <> '') {
          $tam = count($aContainersGeral);
          $this->incrNivelCorrenteLogDb();
          for($i=0;$i< $tam; $i++){
              $containerEmb = $aContainersGeral[$i];
              if($containerEmb == ''){
                  continue;
              }
              $this->inserirLogDb('CONTAINER EMB.',$containerEmb,__FUNCTION__);
              $this->inserirLogDb('vou buscar itens do container',$containerEmb,__FUNCTION__);
              $aItensContainer = buscarIDItensContainer($containerEmb);
              if(is_array($aItensContainer)){
                  $this->inserirLogDb('Itens Encontrados?','SIM',__FUNCTION__);
                  $tam3 = count($aItensContainer);
                  $this->incrNivelCorrenteLogDb();
                  for($j=0;$j< $tam3; $j++){
                      $itemContainerId = $aItensContainer[$j]['item_container_id'];
                      $this->inserirLogDb('item do container - vou chamar a funcao sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
                      sincrQtEmbarcadaCtaCorrenFornec($itemContainerId);
                      $this->inserirLogDb('item do container - apos chamar a funcao sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
                  }
                  $this->decrNivelCorrenteLogDb();
              }else{
                  $this->inserirLogDb('Itens Encontrados?','NAO',__FUNCTION__);
              }
          }
          $this->decrNivelCorrenteLogDb();

    }
    $this->inserirLogDb('FIM Bloco 4 - geracao dos lancamentos de confirmacao da qt. embarcada ',__FUNCTION__,__FUNCTION__);
    finalizarTransacao($transacaoID);
    $this->inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarLanctosPedidosIntegrCtaCorrente()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    
    $this->inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('vou chamar a funcao $this->getProcsCompraIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = $this->getProcsCompraIntegrCtaFornec();
    $this->inserirLogDb('Apos chamar a funcao getProcsCompraIntegrCtaFornec - lista de pedidos',$listaPedidos,__FUNCTION__);
    $aPedidos = explode(',',$listaPedidos);

    if(is_array($aPedidos)){
        $this->incrNivelCorrenteLogDb();
        $tam = count($aPedidos);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPedidos[$i];
            $this->inserirLogDb('Pedido de Compra - vou chamar a funcao - gerarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            $this->incrNivelCorrenteLogDb();
            $this->gerarLanctosCtaCorrenPedImp($pedido);
            $this->inserirLogDb('Pedido de Compra - Apos a funcao - gerarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            $this->decrNivelCorrenteLogDb();
        }
        $this->decrNivelCorrenteLogDb();
    }
    $this->inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function eliminarLanctosPedidosNaoIntegrCtaCorrente()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    
    $this->inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    $this->inserirLogDb('vou chamar a funcao $this->getProcsCompraNaoIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = $this->getProcsCompraNaoIntegrCtaFornec();
    $this->inserirLogDb('Apos chamar a funcao getProcsCompraNaoIntegrCtaFornec - lista de pedidos',$listaPedidos,__FUNCTION__);
    $aPedidos = explode(',',$listaPedidos);

    if(is_array($aPedidos) and $listaPedidos <> ''){
        $this->incrNivelCorrenteLogDb();
        $tam = count($aPedidos);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPedidos[$i];
            $this->inserirLogDb('Pedido de Compra - vou chamar a funcao - eliminarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            $this->incrNivelCorrenteLogDb();
            $this->eliminarLanctosCtaCorrenPedImp($pedido);
            $this->inserirLogDb('Pedido de Compra - Apos a funcao - eliminarLanctosCtaCorrenPedImp ',$pedido,__FUNCTION__);
            $this->decrNivelCorrenteLogDb();
        }
        $this->decrNivelCorrenteLogDb();
    }
    $this->inserirLogDb('fim',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDeParaSitCta($sitCta)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
    $vlParam =  buscarParametroIma($param,$vlPadrao);
    return $vlParam;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $this->proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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
                form_proc_compra_pack_ajax_response();
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function iniciarLogDb($apl,$usuarioLogId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $usuario = $this->getUsuarioCorrente();
    $cmd = "insert into logs(aplicacao,login,dt_hr_inicio,usuario_log_id)
            values('$apl','$usuario',current_timestamp, '$usuarioLogId' ) ";
    $conBase = $this->conectarBase('log_db',getUserLogDb(),getAutLogDb());
    $aRet = $this->execAcaoPDO($cmd,$conBase,'cmd');
    if(isset($aRet['erro'])){
        if($aRet['erro'] <> ''){
            echo "<h1>{$aRet['erro']}</h1>";
        }
    }
    $id = $this->getUltIdTabela('logs');
    $this->setIdCorrenteLogDb($id);
    return $id;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getUsuarioCorrente()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
        return getLoginCorrente();

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setIdCorrenteLogDb($id)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $_SESSION['log_db']['id_corrente'] = $id;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getIdCorrenteLogDb()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['id_corrente'])){
        $retorno = $_SESSION['log_db']['id_corrente'];
    }else{
        $retorno = -1;
    }
     return $retorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function habilitarLogSql($log)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    setVarSessao('log_db_sql',$log);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getLogSql()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    return getVarSessao('log_db_sql');

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function inserirLogDb($titulo,$descricaoParam='',$funcao='',$id=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
        $aConBase = $this->conectarBase('log_db',getUserLogDb(),getAutLogDb());
        $erroConexao = $aConBase['erro'];
        if($erroConexao <> ''){
            echo "<h1>{$erroConexao}</h1>";
        }else{
            $aRet = $this->execAcaoPDO($cmd,$aConBase,'cmd');

            if(isset($aRet['erro'])){
                if($aRet['erro'] <> ''){
                    echo "<h1>{$aRet['erro']} - Comando: $cmd</h1>";
                    $cmd = $this->acertarAspasSimplesInsert($cmd);
                    echo "<h2>após tratamento: $cmd</h2>";

                }
            }
        }
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getGerarLogUsuarioCorrente($apl='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $usuario = strtolower(getLoginCorrente()) ;
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function incrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] += 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function decrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] -= 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    if($_SESSION['log_db']['nivel_corrente'] < 1){
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $nivel = $_SESSION['log_db']['nivel_corrente'];
    }else{
        $nivel = 1;
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $nivel;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function zerarLogDb()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->setIdCorrenteLogDb(-1);
    $idUsuarioLog = $this->getGerarLogUsuarioCorrente($aplCorrente);
    if($idUsuarioLog >= 1){
        $this->iniciarLogDb($aplCorrente,$idUsuarioLog);
    }

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function excluirLogDb($idLog = 0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                form_proc_compra_pack_ajax_response();
             }
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
             if ($this->NM_ajax_flag)
             {
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function validarAltUsuarioLog($usuarioLog,$dtHrIni,$dtHrFim)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
            $msg = "<h3>A data/hora final não pode ser menor que o horário atual</h3>";
        }


        if(! compararDtHoraForm($dtHrIni,$dtHrIniAtual)){
            $msg .= "<h3>A data/hora inicial não pode ser alterada, pois existem registros de log associados</h3>";
        }
    }
    return $msg;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getQtItensLog($log)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
                   'itens_log',
    'log_id',$log,
    'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getQtLogsUsuarioLg($usuarioLog)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'logs',
        'usuario_log_id',$usuarioLog,
        'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getRegUsuarioLog($log)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'usuario_log',
        'id',$log,
        'id,dt_hr_inicial,dt_hr_final');
    return $aReg;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
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
        $dtEmisDocto = buscarDtRegContainer($this->sc_temp_container_corrente);
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarTitAssociadosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlTotPagtoProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompraId);
    $codEstab     = $this->buscarEmpERPProcCompra($procCompraId,'ems5');
    $codEstab     += 1 ;
    $valor = $this->buscarTotPagoLista($codEstab,$listaTitulos,'dolar');
    return $valor;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlPgtoAssocContainer($procCompra,$container)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $valor = 0;
    $listaTitulosASomar = '';
    $listaTitulosAssocProcCompra = $this->buscarTitAssociadosProcCompra($procCompra);
    $aTitulosProcCompra = explode(",",$listaTitulosAssocProcCompra);
    $listaTitulosAssocContainer = $this->buscarTitAssociadosContainer($container);
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
    $codEmpresa = $this->buscarEmpERPProcCompra($procCompra,'ems5');
    $codEstab = $codEmpresa + 1;
    $valor = $this->buscarTotPagoLista($codEstab,$listaTitulosASomar,'dolar');
    return $valor;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function preencherCondPgtoProcCompra($condicaoTitAP)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
if (!isset($this->sc_temp_dt_reg_proc_compra_corrente)) {$this->sc_temp_dt_reg_proc_compra_corrente = (isset($_SESSION['dt_reg_proc_compra_corrente'])) ? $_SESSION['dt_reg_proc_compra_corrente'] : "";}
if (!isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) {$this->sc_temp_empresa_proc_compra_corrente_ems5 = (isset($_SESSION['empresa_proc_compra_corrente_ems5'])) ? $_SESSION['empresa_proc_compra_corrente_ems5'] : "";}
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

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) { $_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
if (isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) { $_SESSION['empresa_proc_compra_corrente_ems5'] = $this->sc_temp_empresa_proc_compra_corrente_ems5;}
if (isset($this->sc_temp_dt_reg_proc_compra_corrente)) { $_SESSION['dt_reg_proc_compra_corrente'] = $this->sc_temp_dt_reg_proc_compra_corrente;}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function existTitProcCompra($numIdTitAp,$procCompraId=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function verificarNecesAtualizPgtoPedido($numIdTitAp)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $logAtualizar = true;
    $container = $this->getcontainerPagto($numIdTitAp);
    if($container <> 0){
        $logExisteItens = existItensContainer($container);
        if($logExisteItens == true){
            $logAtualizar = false;
        }
    }
    return $logAtualizar;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getProcCompraPgto($numIdTitAp)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function desassociarTituloPedido($numIdTitAp,$procCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_proc_compra where num_id_tit_ap = $numIdTitAp 
            and  proc_compra_id = $procCompraId ";
    
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function associarTituloPedido($numIdTitAp,$proCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_proc_compra(num_id_tit_ap,proc_compra_id) 
            values($numIdTitAp, $proCompraId ) ";
    
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
                form_proc_compra_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getTitAssocSoPedido($fornecedor,$tipoReg)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getListaTitAssocPedido()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
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

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) { $_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarEmpProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " empresa_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){
        $empresa = $aRetorno[0]['empresa_id'];
    }
    return $empresa;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarDescProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $processo = '';

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " cod_proc_fornec, fornecedor_id ",
        " proc_compra_id = $procCompraId ","espec");
    if(is_array($aRetorno)){
        $processo = $aRetorno[0]['cod_proc_fornec'];
        $fornecedor = buscarDescFornecedor($aRetorno[0]['fornecedor_id']);
        $processo .= ' '. $fornecedor;
    }
    return $processo;



$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarFornecedorProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $fornecedor = 0;

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " fornecedor_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $fornecedor =$aRetorno[0]['fornecedor_id'];
    }
    return $fornecedor;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarDtRegProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $data = '2001-01-01';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " dt_registro ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $data =$aRetorno[0]['dt_registro'];
    }
    return $data;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarEmpERPProcCompra($procCompraIdParam,$sistema)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra, pub.empresas", " pub.empresas.cod_emp_ems2 , pub.empresas.cod_emp_ems5 ",
        " pub.procs_compra.proc_compra_id = $procCompraIdParam
                                    and pub.procs_compra.empresa_id = pub.empresas.empresa_id", 'espec');
    if(is_array($aRetorno)){
        switch($sistema){
            case 'ems2':
                $retorno = $aRetorno[0]['pub.empresas.cod_emp_ems2'];
                break;
            case 'ems5':
                $retorno = $aRetorno[0]['pub.empresas.cod_emp_ems5'];
                break;
        }
    }
    return $retorno;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarCotPrevProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'cotacao_prevista';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarQtContainerProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'qt_container';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function verificarADProcCompra($procCompraID)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    
    $tabela = " pub.pagtos_proc_compra";
    $campos = " top 1 num_id_tit_ap";
    $condicao = " proc_compra_id = $procCompraID";
    $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aResult)){
        $logAchou = true;
    }
    else{
        $logAchou = false;
    }
    return $logAchou;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDadosPedidoImp($id,$campos='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','procs_compra');
        $campos = $aCampos['campos'];
    }

    $tabela   = " pub.procs_compra ";
    $condicao = "  proc_compra_id = $id ";
    $aResult = $this->getDados('unico',$tabela,$campos,$condicao,"espec");
    return $aResult;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getProcsCompraCtaPorFornec($fornecedor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','procs_compra','proc_compra_id',
        "fornecedor_id = $fornecedor and log_considerar_previsao = 1",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = $this->util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getProcsCompraIntegrCtaFornec()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra','proc_compra_id',
        " log_considerar_previsao = 1",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = $this->util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getProcsCompraNaoIntegrCtaFornec()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra','proc_compra_id',
        " log_considerar_previsao = 0",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = $this->util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function validarAltPedCompra($pedido)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $erro = '';
    $vl = $this->buscarVlTotPagtoProcCompra($pedido);
    if($vl > 0 ){
        $erro = "Para alterar o fornecedor não pode existir nenhum pagamento associado";
    }
    return $erro;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function validacoesPedCompra($pedido)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $erro = $this->validarAltPedCompra($pedido);
    return $erro;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getFornecsPedImpGeraPrev()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra pedido',
        'distinct fornecedor_id as fornecedor_id',
        " log_considerar_previsao = 1",'multi',
    'comum.pub.emitente emit on pedido.fornecedor_id = emit."cod-emitente" ');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['fornecedor_id'];
            $lista = $this->util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlMoeda($numIdTitAp,$codEstab='',$moeda='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getEspecsAdiant()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $param = buscarParametroIma("especs_adiant_importacao");
    if ($param == '') {
        $especs = "'AF'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function getEspecsTit()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $param = buscarParametroIma("especs_tit_importacao");
    if ($param == '') {
        $especs = "'DI'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarDadosTitulo($numTitAp,$codEstab='')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

    $condicao = " num_id_tit_ap = $numTitAp  ";
    if($codEstab <> ''){
        $condicao .= " and cod_estab = '$codEstab'";
    }
    $tabela = 'pub.tit_ap';
    $campo  = 'cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela,dat_emis_docto,
	dat_vencto_tit_ap,dat_liquidac_tit_ap,cod_estab';

    return $this->retornoSimplesTb01($tabela,$campo,$condicao,"ems5");


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
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
   $sErrorIndex = 'geral_form_proc_compra';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_proc_compra';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
    }
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['form_proc_compra']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_proc_compra_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_proc_compra_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("proc_compra_id", "empresa_id", "qt_container", "cod_situacao", "cod_proc_fornec", "qt_dias_translado", "cotacao_prevista", "observacao", "dt_registro", "fornecedor_id", "dt_limite", "log_facilid_contato_fornec"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['table_refresh'])
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

   function Form_lookup_cod_situacao()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Aberto?#?1?#??@?";
       $nmgp_def_dados .= "Fechado?#?2?#??@?";
       $nmgp_def_dados .= "Cancelado?#?3?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_empresa_id()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'] = array(); 
    }

   $old_value_proc_compra_id = $this->proc_compra_id;
   $old_value_dt_registro = $this->dt_registro;
   $old_value_qt_dias_translado = $this->qt_dias_translado;
   $old_value_fornecedor_id = $this->fornecedor_id;
   $old_value_dt_limite = $this->dt_limite;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_proc_compra_id = $this->proc_compra_id;
   $unformatted_value_dt_registro = $this->dt_registro;
   $unformatted_value_qt_dias_translado = $this->qt_dias_translado;
   $unformatted_value_fornecedor_id = $this->fornecedor_id;
   $unformatted_value_dt_limite = $this->dt_limite;

   $nm_comando = "SELECT empresa_id, nome  FROM pub.empresas  ORDER BY nome";

   $this->proc_compra_id = $old_value_proc_compra_id;
   $this->dt_registro = $old_value_dt_registro;
   $this->qt_dias_translado = $old_value_qt_dias_translado;
   $this->fornecedor_id = $old_value_fornecedor_id;
   $this->dt_limite = $old_value_dt_limite;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['Lookup_empresa_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_log_facilid_contato_fornec()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?1?#??@?";
       $nmgp_def_dados .= "Não?#?0?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_log_considerar_previsao()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?1?#?S?@?";
       $nmgp_def_dados .= "Não?#?0?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_proc_compra_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "proc_compra_id") 
          {
              $this->SC_monta_condicao($comando, "proc_compra_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "empresa_id") 
          {
              $data_lookup = $this->SC_lookup_empresa_id($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "empresa_id", $arg_search, $data_lookup, "INTEGER", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "qt_container") 
          {
              $this->SC_monta_condicao($comando, "qt_container", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cod_situacao") 
          {
              $data_lookup = $this->SC_lookup_cod_situacao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "cod_situacao", $arg_search, $data_lookup, "INTEGER", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "cod_proc_fornec") 
          {
              $this->SC_monta_condicao($comando, "cod_proc_fornec", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "qt_dias_translado") 
          {
              $this->SC_monta_condicao($comando, "qt_dias_translado", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cotacao_prevista") 
          {
              $this->SC_monta_condicao($comando, "cotacao_prevista", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "observacao") 
          {
              $this->SC_monta_condicao($comando, "observacao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_registro") 
          {
              $this->SC_monta_condicao($comando, "dt_registro", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "fornecedor_id") 
          {
              $this->SC_monta_condicao($comando, "fornecedor_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_limite") 
          {
              $this->SC_monta_condicao($comando, "dt_limite", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "log_facilid_contato_fornec") 
          {
              $data_lookup = $this->SC_lookup_log_facilid_contato_fornec($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "log_facilid_contato_fornec", $arg_search, $data_lookup, "BIT", false);
              }
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_proc_compra = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] = $qt_geral_reg_form_proc_compra;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_proc_compra_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_proc_compra_pack_ajax_response();
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
      $nm_numeric[] = "proc_compra_id";$nm_numeric[] = "empresa_id";$nm_numeric[] = "qt_container";$nm_numeric[] = "cod_situacao";$nm_numeric[] = "qt_dias_translado";$nm_numeric[] = "cotacao_prevista";$nm_numeric[] = "fornecedor_id";$nm_numeric[] = "log_facilid_contato_fornec";$nm_numeric[] = "log_considerar_previsao";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['decimal_db'] == ".")
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
      $Nm_datas["dt_registro"] = "date";$Nm_datas["dt_limite"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['SC_sep_date1'];
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
   function SC_lookup_empresa_id($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT nome, empresa_id FROM pub.empresas WHERE (#lowerI##cmp_inome#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
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
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_cod_situacao($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['1'] = "Aberto";
       $data_look['2'] = "Fechado";
       $data_look['3'] = "Cancelado";
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
   function SC_lookup_log_facilid_contato_fornec($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['1'] = "Sim";
       $data_look['0'] = "Não";
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
       $nmgp_saida_form = "form_proc_compra_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_proc_compra_fim.php";
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
       form_proc_compra_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['masterValue']);
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
            case "new":
                return array("sc_b_new_t.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-2");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-3");
                break;
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-4");
                break;
            case "delete":
                return array("sc_b_del_t.sc-unique-btn-5");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-6", "sc_b_sai_t.sc-unique-btn-7", "sc_b_sai_t.sc-unique-btn-9", "sc_b_sai_t.sc-unique-btn-8", "sc_b_sai_t.sc-unique-btn-10");
                break;
            case "bt_log":
                return array("sc_bt_log_top", "sc_bt_log_top");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-11");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-12");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-13");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-14");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Pedido de Compras"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Pedido de Compras"; } ?> - 
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_proc_compra']['ordem_ord'] == " desc") {
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
            case "proc_compra_id":
                return true;
            case "qt_dias_translado":
                return true;
            case "fornecedor_id":
                return true;
            case "qt_container":
                return true;
            case "cotacao_prevista":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "proc_compra_id":
                return 'desc';
            case "cod_situacao":
                return 'desc';
            case "empresa_id":
                return 'desc';
            case "dt_registro":
                return 'desc';
            case "qt_dias_translado":
                return 'desc';
            case "fornecedor_id":
                return 'desc';
            case "dt_limite":
                return 'desc';
            case "qt_container":
                return 'desc';
            case "cotacao_prevista":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
