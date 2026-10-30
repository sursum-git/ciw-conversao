<?php
//
class form_versoes_item_custo_container_apl
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
   var $versao_id;
   var $dt_hr_versao;
   var $dt_hr_versao_hora;
   var $cod_usuario;
   var $descricao;
   var $ind_sit_versao;
   var $ind_sit_versao_1;
   var $vl_dolar_compra;
   var $vl_desconto_utiliz_dolar;
   var $vl_desconto_utiliz_real;
   var $tipo_versao_id;
   var $tipo_versao_id_1;
   var $container_id;
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
          if (isset($this->NM_ajax_info['param']['cod_usuario']))
          {
              $this->cod_usuario = $this->NM_ajax_info['param']['cod_usuario'];
          }
          if (isset($this->NM_ajax_info['param']['container_id']))
          {
              $this->container_id = $this->NM_ajax_info['param']['container_id'];
          }
          if (isset($this->NM_ajax_info['param']['descricao']))
          {
              $this->descricao = $this->NM_ajax_info['param']['descricao'];
          }
          if (isset($this->NM_ajax_info['param']['dt_hr_versao']))
          {
              $this->dt_hr_versao = $this->NM_ajax_info['param']['dt_hr_versao'];
          }
          if (isset($this->NM_ajax_info['param']['dt_hr_versao_hora']))
          {
              $this->dt_hr_versao_hora = $this->NM_ajax_info['param']['dt_hr_versao_hora'];
          }
          if (isset($this->NM_ajax_info['param']['ind_sit_versao']))
          {
              $this->ind_sit_versao = $this->NM_ajax_info['param']['ind_sit_versao'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_fields']))
          {
              $this->nmgp_refresh_fields = $this->NM_ajax_info['param']['nmgp_refresh_fields'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tipo_versao_id']))
          {
              $this->tipo_versao_id = $this->NM_ajax_info['param']['tipo_versao_id'];
          }
          if (isset($this->NM_ajax_info['param']['versao_id']))
          {
              $this->versao_id = $this->NM_ajax_info['param']['versao_id'];
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
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->container_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['embutida_parms']);
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
                 nm_limpa_str_form_versoes_item_custo_container($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['opc_ant']);
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_versoes_item_custo_container_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_versoes_item_custo_container']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_versoes_item_custo_container']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_versoes_item_custo_container'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_versoes_item_custo_container']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_versoes_item_custo_container']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_versoes_item_custo_container') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_versoes_item_custo_container']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Versões de Custo Container";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_versoes_item_custo_container")
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



      $_SESSION['scriptcase']['error_icon']['form_versoes_item_custo_container']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_versoes_item_custo_container'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto']      = 'on';
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
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_versoes_item_custo_container']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_versoes_item_custo_container'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_versoes_item_custo_container'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form'];
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['ind_sit_versao'] != "null"){$this->ind_sit_versao = $this->nmgp_dados_form['ind_sit_versao'];} 
          if (!isset($this->vl_dolar_compra)){$this->vl_dolar_compra = $this->nmgp_dados_form['vl_dolar_compra'];} 
          if (!isset($this->vl_desconto_utiliz_dolar)){$this->vl_desconto_utiliz_dolar = $this->nmgp_dados_form['vl_desconto_utiliz_dolar'];} 
          if (!isset($this->vl_desconto_utiliz_real)){$this->vl_desconto_utiliz_real = $this->nmgp_dados_form['vl_desconto_utiliz_real'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_versoes_item_custo_container", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_versoes_item_custo_container_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_versoes_item_custo_container_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_versoes_item_custo_container/form_versoes_item_custo_container_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_versoes_item_custo_container_erro.class.php"); 
      }
      $this->Erro      = new form_versoes_item_custo_container_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao']))
         { 
             if ($this->versao_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_versoes_item_custo_container']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form'];
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
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_versoes_item_custo_container']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_versoes_item_custo_container']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_versoes_item_custo_container']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_versoes_item_custo_container']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->versao_id)) { $this->nm_limpa_alfa($this->versao_id); }
      if (isset($this->dt_hr_versao)) { $this->nm_limpa_alfa($this->dt_hr_versao); }
      if (isset($this->cod_usuario)) { $this->nm_limpa_alfa($this->cod_usuario); }
      if (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
      if (isset($this->ind_sit_versao)) { $this->nm_limpa_alfa($this->ind_sit_versao); }
      if (isset($this->tipo_versao_id)) { $this->nm_limpa_alfa($this->tipo_versao_id); }
      if (isset($this->container_id)) { $this->nm_limpa_alfa($this->container_id); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- versao_id
      $this->field_config['versao_id']               = array();
      $this->field_config['versao_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['versao_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['versao_id']['symbol_dec'] = '';
      $this->field_config['versao_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['versao_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dt_hr_versao
      $this->field_config['dt_hr_versao']                 = array();
      $this->field_config['dt_hr_versao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dt_hr_versao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_hr_versao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dt_hr_versao']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'dt_hr_versao');
      //-- container_id
      $this->field_config['container_id']               = array();
      $this->field_config['container_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['container_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['container_id']['symbol_dec'] = '';
      $this->field_config['container_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['container_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- vl_dolar_compra
      $this->field_config['vl_dolar_compra']               = array();
      $this->field_config['vl_dolar_compra']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['vl_dolar_compra']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['vl_dolar_compra']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['vl_dolar_compra']['symbol_mon'] = '';
      $this->field_config['vl_dolar_compra']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['vl_dolar_compra']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- vl_desconto_utiliz_dolar
      $this->field_config['vl_desconto_utiliz_dolar']               = array();
      $this->field_config['vl_desconto_utiliz_dolar']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['vl_desconto_utiliz_dolar']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['vl_desconto_utiliz_dolar']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['vl_desconto_utiliz_dolar']['symbol_mon'] = '';
      $this->field_config['vl_desconto_utiliz_dolar']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['vl_desconto_utiliz_dolar']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- vl_desconto_utiliz_real
      $this->field_config['vl_desconto_utiliz_real']               = array();
      $this->field_config['vl_desconto_utiliz_real']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['vl_desconto_utiliz_real']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['vl_desconto_utiliz_real']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['vl_desconto_utiliz_real']['symbol_mon'] = '';
      $this->field_config['vl_desconto_utiliz_real']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['vl_desconto_utiliz_real']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Gera_log_access'] = false;
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
          $this->ind_sit_versao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form']['ind_sit_versao'];
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->tipo_versao_id = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form']['tipo_versao_id'];
          $this->ind_sit_versao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form']['ind_sit_versao'];
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_versao_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'versao_id');
          }
          if ('validate_tipo_versao_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tipo_versao_id');
          }
          if ('validate_dt_hr_versao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dt_hr_versao');
          }
          if ('validate_cod_usuario' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_usuario');
          }
          if ('validate_descricao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'descricao');
          }
          if ('validate_ind_sit_versao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ind_sit_versao');
          }
          if ('validate_container_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'container_id');
          }
          form_versoes_item_custo_container_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select']['tipo_versao_id']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tipo_versao_id = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select']['tipo_versao_id'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select']['ind_sit_versao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->ind_sit_versao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select']['ind_sit_versao'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_versoes_item_custo_container_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_versoes_item_custo_container_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_atualiz'] == "ok")
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
          form_versoes_item_custo_container_pack_ajax_response();
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
          form_versoes_item_custo_container_pack_ajax_response();
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
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_versoes_item_custo_container.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Versões de Custo Container") ?></TITLE>
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
<form name="Fdown" method="get" action="form_versoes_item_custo_container_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_versoes_item_custo_container"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_versoes_item_custo_container', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_versoes_item_custo_container', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_versoes_item_custo_container', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_versoes_item_custo_container_pack_ajax_response();
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
           $this->Ini->nm_db_espec->Close(); 
           $this->Ini->nm_db_multi->Close(); 
           $this->Ini->nm_db_ems5->Close(); 
           $this->Ini->nm_db_ems2ima->Close(); 
           $this->Ini->nm_db_ems2med->Close(); 
           $this->Ini->nm_db_comum->Close(); 
           $this->Ini->nm_db_cfsc->Close(); 
           $this->Ini->nm_db_log_db->Close(); 
           $this->Ini->nm_db_ticontrole2->Close(); 
           $this->Ini->nm_db_ima->Close(); 
           $this->Ini->nm_db_med->Close(); 
           $this->Ini->nm_db_geral->Close(); 
           $this->Ini->nm_db_dinamico->Close(); 
           $this->Ini->nm_db_log_imp_mysql->Close(); 
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
           case 'versao_id':
               return "ID";
               break;
           case 'tipo_versao_id':
               return "Tipo Versão";
               break;
           case 'dt_hr_versao':
               return "Dt.Hr.Versão";
               break;
           case 'cod_usuario':
               return "Usuário";
               break;
           case 'descricao':
               return "Descrição";
               break;
           case 'ind_sit_versao':
               return "Situação";
               break;
           case 'container_id':
               return "Container Id";
               break;
           case 'vl_dolar_compra':
               return "Vl Dolar Compra";
               break;
           case 'vl_desconto_utiliz_dolar':
               return "Vl Desconto Utiliz Dolar";
               break;
           case 'vl_desconto_utiliz_real':
               return "Vl Desconto Utiliz Real";
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
      if ((!is_array($filtro) && ('' == $filtro || 'versao_id' == $filtro)) || (is_array($filtro) && in_array('versao_id', $filtro)))
        $this->ValidateField_versao_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "versao_id";

      if ((!is_array($filtro) && ('' == $filtro || 'tipo_versao_id' == $filtro)) || (is_array($filtro) && in_array('tipo_versao_id', $filtro)))
        $this->ValidateField_tipo_versao_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tipo_versao_id";

      if ((!is_array($filtro) && ('' == $filtro || 'dt_hr_versao' == $filtro)) || (is_array($filtro) && in_array('dt_hr_versao', $filtro)))
        $this->ValidateField_dt_hr_versao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "dt_hr_versao";

      if ((!is_array($filtro) && ('' == $filtro || 'cod_usuario' == $filtro)) || (is_array($filtro) && in_array('cod_usuario', $filtro)))
        $this->ValidateField_cod_usuario($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_usuario";

      if ((!is_array($filtro) && ('' == $filtro || 'descricao' == $filtro)) || (is_array($filtro) && in_array('descricao', $filtro)))
        $this->ValidateField_descricao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "descricao";

      if ((!is_array($filtro) && ('' == $filtro || 'ind_sit_versao' == $filtro)) || (is_array($filtro) && in_array('ind_sit_versao', $filtro)))
        $this->ValidateField_ind_sit_versao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "ind_sit_versao";

      if ((!is_array($filtro) && ('' == $filtro || 'container_id' == $filtro)) || (is_array($filtro) && in_array('container_id', $filtro)))
        $this->ValidateField_container_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "container_id";

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

    function ValidateField_versao_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['versao_id'])) {
          nm_limpa_numero($this->versao_id, $this->field_config['versao_id']['symbol_grp']) ; 
          return;
      }
      if ($this->versao_id === "" || is_null($this->versao_id))  
      { 
          $this->versao_id = 0;
      } 
      nm_limpa_numero($this->versao_id, $this->field_config['versao_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_versao_id' == $this->NM_ajax_opcao)
      { 
          if ($this->versao_id != '')  
          { 
              $iTestSize = 8;
              if (strlen($this->versao_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['versao_id']))
                  {
                      $Campos_Erros['versao_id'] = array();
                  }
                  $Campos_Erros['versao_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['versao_id']) || !is_array($this->NM_ajax_info['errList']['versao_id']))
                  {
                      $this->NM_ajax_info['errList']['versao_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['versao_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->versao_id, 8, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID; " ; 
                  if (!isset($Campos_Erros['versao_id']))
                  {
                      $Campos_Erros['versao_id'] = array();
                  }
                  $Campos_Erros['versao_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['versao_id']) || !is_array($this->NM_ajax_info['errList']['versao_id']))
                  {
                      $this->NM_ajax_info['errList']['versao_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['versao_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'versao_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_versao_id

    function ValidateField_tipo_versao_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['tipo_versao_id'])) {
       return;
   }
               if (!empty($this->tipo_versao_id) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']) && !in_array($this->tipo_versao_id, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['tipo_versao_id']))
                   {
                       $Campos_Erros['tipo_versao_id'] = array();
                   }
                   $Campos_Erros['tipo_versao_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['tipo_versao_id']) || !is_array($this->NM_ajax_info['errList']['tipo_versao_id']))
                   {
                       $this->NM_ajax_info['errList']['tipo_versao_id'] = array();
                   }
                   $this->NM_ajax_info['errList']['tipo_versao_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tipo_versao_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tipo_versao_id

    function ValidateField_dt_hr_versao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dt_hr_versao, $this->field_config['dt_hr_versao']['date_sep']) ; 
      nm_limpa_hora($this->dt_hr_versao_hora, $this->field_config['dt_hr_versao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dt_hr_versao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dt_hr_versao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dt_hr_versao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dt_hr_versao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dt_hr_versao']['date_sep']) ; 
          $Format_Hora = $this->field_config['dt_hr_versao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dt_hr_versao_hora']['time_sep']) ; 
          if (trim($this->dt_hr_versao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->dt_hr_versao, $Format_Data, $this->dt_hr_versao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->dt_hr_versao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->dt_hr_versao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->dt_hr_versao, $Format_Data, $this->dt_hr_versao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->dt_hr_versao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->dt_hr_versao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt.Hr.Versão; " ; 
                  if (!isset($Campos_Erros['dt_hr_versao']))
                  {
                      $Campos_Erros['dt_hr_versao'] = array();
                  }
                  $Campos_Erros['dt_hr_versao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dt_hr_versao']) || !is_array($this->NM_ajax_info['errList']['dt_hr_versao']))
                  {
                      $this->NM_ajax_info['errList']['dt_hr_versao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dt_hr_versao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dt_hr_versao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dt_hr_versao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->dt_hr_versao_hora, $this->field_config['dt_hr_versao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dt_hr_versao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['dt_hr_versao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dt_hr_versao_hora']['time_sep']) ; 
          if (trim($this->dt_hr_versao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->dt_hr_versao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt.Hr.Versão; " ; 
                  if (!isset($Campos_Erros['dt_hr_versao_hora']))
                  {
                      $Campos_Erros['dt_hr_versao_hora'] = array();
                  }
                  $Campos_Erros['dt_hr_versao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dt_hr_versao']) || !is_array($this->NM_ajax_info['errList']['dt_hr_versao']))
                  {
                      $this->NM_ajax_info['errList']['dt_hr_versao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dt_hr_versao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dt_hr_versao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dt_hr_versao_hora

    function ValidateField_cod_usuario(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cod_usuario'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->cod_usuario) > 24) 
          { 
              $hasError = true;
              $Campos_Crit .= "Usuário " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 24 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cod_usuario']))
              {
                  $Campos_Erros['cod_usuario'] = array();
              }
              $Campos_Erros['cod_usuario'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 24 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cod_usuario']) || !is_array($this->NM_ajax_info['errList']['cod_usuario']))
              {
                  $this->NM_ajax_info['errList']['cod_usuario'] = array();
              }
              $this->NM_ajax_info['errList']['cod_usuario'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 24 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_usuario';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_usuario

    function ValidateField_descricao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['descricao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->descricao) > 16000) 
          { 
              $hasError = true;
              $Campos_Crit .= "Descrição " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['descricao']))
              {
                  $Campos_Erros['descricao'] = array();
              }
              $Campos_Erros['descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['descricao']) || !is_array($this->NM_ajax_info['errList']['descricao']))
              {
                  $this->NM_ajax_info['errList']['descricao'] = array();
              }
              $this->NM_ajax_info['errList']['descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 16000 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'descricao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_descricao

    function ValidateField_ind_sit_versao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['ind_sit_versao'])) {
       return;
   }
      if ($this->ind_sit_versao == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->ind_sit_versao === "" || is_null($this->ind_sit_versao))  
      { 
          $this->ind_sit_versao = 0;
          $this->sc_force_zero[] = 'ind_sit_versao';
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ind_sit_versao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ind_sit_versao

    function ValidateField_container_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['container_id'])) {
          nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
          return;
      }
      if ($this->container_id === "" || is_null($this->container_id))  
      { 
          $this->container_id = 0;
          $this->sc_force_zero[] = 'container_id';
      } 
      nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->container_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->container_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Container Id: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['container_id']))
                  {
                      $Campos_Erros['container_id'] = array();
                  }
                  $Campos_Erros['container_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['container_id']) || !is_array($this->NM_ajax_info['errList']['container_id']))
                  {
                      $this->NM_ajax_info['errList']['container_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['container_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->container_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Container Id; " ; 
                  if (!isset($Campos_Erros['container_id']))
                  {
                      $Campos_Erros['container_id'] = array();
                  }
                  $Campos_Erros['container_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['container_id']) || !is_array($this->NM_ajax_info['errList']['container_id']))
                  {
                      $this->NM_ajax_info['errList']['container_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['container_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'container_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_container_id

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
    $this->nmgp_dados_form['versao_id'] = $this->versao_id;
    $this->nmgp_dados_form['tipo_versao_id'] = $this->tipo_versao_id;
    $this->nmgp_dados_form['dt_hr_versao'] = $this->dt_hr_versao;
    $this->nmgp_dados_form['cod_usuario'] = $this->cod_usuario;
    $this->nmgp_dados_form['descricao'] = $this->descricao;
    $this->nmgp_dados_form['ind_sit_versao'] = $this->ind_sit_versao;
    $this->nmgp_dados_form['container_id'] = $this->container_id;
    $this->nmgp_dados_form['vl_dolar_compra'] = $this->vl_dolar_compra;
    $this->nmgp_dados_form['vl_desconto_utiliz_dolar'] = $this->vl_desconto_utiliz_dolar;
    $this->nmgp_dados_form['vl_desconto_utiliz_real'] = $this->vl_desconto_utiliz_real;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['versao_id'] = $this->versao_id;
      nm_limpa_numero($this->versao_id, $this->field_config['versao_id']['symbol_grp']) ; 
      $this->Before_unformat['dt_hr_versao'] = $this->dt_hr_versao;
      $this->Before_unformat['dt_hr_versao_hora'] = $this->dt_hr_versao_hora;
      nm_limpa_data($this->dt_hr_versao, $this->field_config['dt_hr_versao']['date_sep']) ; 
      nm_limpa_hora($this->dt_hr_versao_hora, $this->field_config['dt_hr_versao']['time_sep']) ; 
      $this->Before_unformat['container_id'] = $this->container_id;
      nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      $this->Before_unformat['vl_dolar_compra'] = $this->vl_dolar_compra;
      if (!empty($this->field_config['vl_dolar_compra']['symbol_dec']))
      {
         $this->sc_remove_currency($this->vl_dolar_compra, $this->field_config['vl_dolar_compra']['symbol_dec'], $this->field_config['vl_dolar_compra']['symbol_grp'], $this->field_config['vl_dolar_compra']['symbol_mon']);
         nm_limpa_valor($this->vl_dolar_compra, $this->field_config['vl_dolar_compra']['symbol_dec'], $this->field_config['vl_dolar_compra']['symbol_grp']);
      }
      $this->Before_unformat['vl_desconto_utiliz_dolar'] = $this->vl_desconto_utiliz_dolar;
      if (!empty($this->field_config['vl_desconto_utiliz_dolar']['symbol_dec']))
      {
         $this->sc_remove_currency($this->vl_desconto_utiliz_dolar, $this->field_config['vl_desconto_utiliz_dolar']['symbol_dec'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_grp'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_mon']);
         nm_limpa_valor($this->vl_desconto_utiliz_dolar, $this->field_config['vl_desconto_utiliz_dolar']['symbol_dec'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_grp']);
      }
      $this->Before_unformat['vl_desconto_utiliz_real'] = $this->vl_desconto_utiliz_real;
      if (!empty($this->field_config['vl_desconto_utiliz_real']['symbol_dec']))
      {
         $this->sc_remove_currency($this->vl_desconto_utiliz_real, $this->field_config['vl_desconto_utiliz_real']['symbol_dec'], $this->field_config['vl_desconto_utiliz_real']['symbol_grp'], $this->field_config['vl_desconto_utiliz_real']['symbol_mon']);
         nm_limpa_valor($this->vl_desconto_utiliz_real, $this->field_config['vl_desconto_utiliz_real']['symbol_dec'], $this->field_config['vl_desconto_utiliz_real']['symbol_grp']);
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
      if ($Nome_Campo == "versao_id")
      {
          nm_limpa_numero($this->versao_id, $this->field_config['versao_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "container_id")
      {
          nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "vl_dolar_compra")
      {
          if (!empty($this->field_config['vl_dolar_compra']['symbol_dec']))
          {
             $this->sc_remove_currency($this->vl_dolar_compra, $this->field_config['vl_dolar_compra']['symbol_dec'], $this->field_config['vl_dolar_compra']['symbol_grp'], $this->field_config['vl_dolar_compra']['symbol_mon']);
             nm_limpa_valor($this->vl_dolar_compra, $this->field_config['vl_dolar_compra']['symbol_dec'], $this->field_config['vl_dolar_compra']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "vl_desconto_utiliz_dolar")
      {
          if (!empty($this->field_config['vl_desconto_utiliz_dolar']['symbol_dec']))
          {
             $this->sc_remove_currency($this->vl_desconto_utiliz_dolar, $this->field_config['vl_desconto_utiliz_dolar']['symbol_dec'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_grp'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_mon']);
             nm_limpa_valor($this->vl_desconto_utiliz_dolar, $this->field_config['vl_desconto_utiliz_dolar']['symbol_dec'], $this->field_config['vl_desconto_utiliz_dolar']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "vl_desconto_utiliz_real")
      {
          if (!empty($this->field_config['vl_desconto_utiliz_real']['symbol_dec']))
          {
             $this->sc_remove_currency($this->vl_desconto_utiliz_real, $this->field_config['vl_desconto_utiliz_real']['symbol_dec'], $this->field_config['vl_desconto_utiliz_real']['symbol_grp'], $this->field_config['vl_desconto_utiliz_real']['symbol_mon']);
             nm_limpa_valor($this->vl_desconto_utiliz_real, $this->field_config['vl_desconto_utiliz_real']['symbol_dec'], $this->field_config['vl_desconto_utiliz_real']['symbol_grp']);
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
      if ('' !== $this->versao_id || (!empty($format_fields) && isset($format_fields['versao_id'])))
      {
          nmgp_Form_Num_Val($this->versao_id, $this->field_config['versao_id']['symbol_grp'], $this->field_config['versao_id']['symbol_dec'], "0", "S", $this->field_config['versao_id']['format_neg'], "", "", "-", $this->field_config['versao_id']['symbol_fmt']) ; 
      }
      if (!empty($this->dt_hr_versao) || (!empty($format_fields) && isset($format_fields['dt_hr_versao'])))
      {
          $nm_separa_data = strpos($this->field_config['dt_hr_versao']['date_format'], ";") ;
          $form_data = substr($this->field_config['dt_hr_versao']['date_format'], 0, $nm_separa_data);
          $form_hora = substr($this->field_config['dt_hr_versao']['date_format'], $nm_separa_data + 1);
          $temp      = trim(strtolower(""));
          $pos_hora  = strpos($temp, "h");
          $pos_min   = strpos($temp, "i");
          $pos_seg   = strpos($temp, "s");
          $pos_hora  = min($pos_hora, $pos_min, $pos_seg);
          $out_data  = trim(substr($temp, 0, $pos_hora));
          $out_hora  = trim(substr($temp, $pos_hora));
          $separador = strpos($this->dt_hr_versao, " ") ; 
          $this->dt_hr_versao_hora = substr($this->dt_hr_versao, $separador + 1) ; 
          $this->dt_hr_versao = substr($this->dt_hr_versao, 0, $separador) ; 
          nm_conv_form_data($this->dt_hr_versao, $out_data, $form_data, array($this->field_config['dt_hr_versao']['date_sep'])) ;  
          nm_conv_form_hora($this->dt_hr_versao_hora, $out_hora, $form_hora, array($this->field_config['dt_hr_versao']['time_sep'])) ;  
      }
      if ('' !== $this->container_id || (!empty($format_fields) && isset($format_fields['container_id'])))
      {
          nmgp_Form_Num_Val($this->container_id, $this->field_config['container_id']['symbol_grp'], $this->field_config['container_id']['symbol_dec'], "0", "S", $this->field_config['container_id']['format_neg'], "", "", "-", $this->field_config['container_id']['symbol_fmt']) ; 
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
          $this->ajax_return_values_versao_id();
          $this->ajax_return_values_tipo_versao_id();
          $this->ajax_return_values_dt_hr_versao();
          $this->ajax_return_values_cod_usuario();
          $this->ajax_return_values_descricao();
          $this->ajax_return_values_ind_sit_versao();
          $this->ajax_return_values_container_id();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['versao_id']['keyVal'] = form_versoes_item_custo_container_pack_protect_string($this->nmgp_dados_form['versao_id']);
          }
   } // ajax_return_values

          //----- versao_id
   function ajax_return_values_versao_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("versao_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->versao_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['versao_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("versao_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- tipo_versao_id
   function ajax_return_values_tipo_versao_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tipo_versao_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tipo_versao_id);
              $aLookup = array();
              $this->_tmp_lookup_tipo_versao_id = $this->tipo_versao_id;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array(); 
}
$aLookup[] = array(form_versoes_item_custo_container_pack_protect_string('') => str_replace('<', '&lt;',form_versoes_item_custo_container_pack_protect_string(' ')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_versao_id = $this->versao_id;
   $old_value_dt_hr_versao = $this->dt_hr_versao;
   $old_value_dt_hr_versao_hora = $this->dt_hr_versao_hora;
   $old_value_container_id = $this->container_id;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_versao_id = $this->versao_id;
   $unformatted_value_dt_hr_versao = $this->dt_hr_versao;
   $unformatted_value_dt_hr_versao_hora = $this->dt_hr_versao_hora;
   $unformatted_value_container_id = $this->container_id;

   $nm_comando = "SELECT tipo_versao_custo_id, descricao  FROM PUB.tipos_versao_custo  ORDER BY descricao";

   $this->versao_id = $old_value_versao_id;
   $this->dt_hr_versao = $old_value_dt_hr_versao;
   $this->dt_hr_versao_hora = $old_value_dt_hr_versao_hora;
   $this->container_id = $old_value_container_id;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_versoes_item_custo_container_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_versoes_item_custo_container_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tipo_versao_id\"";
          if (isset($this->NM_ajax_info['select_html']['tipo_versao_id']) && !empty($this->NM_ajax_info['select_html']['tipo_versao_id']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['tipo_versao_id']);
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

                  if ($this->tipo_versao_id == $sValue)
                  {
                      $this->_tmp_lookup_tipo_versao_id = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tipo_versao_id'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tipo_versao_id']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tipo_versao_id']['valList'][$i] = form_versoes_item_custo_container_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tipo_versao_id']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tipo_versao_id']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tipo_versao_id']['labList'] = $aLabel;
          }
   }

          //----- dt_hr_versao
   function ajax_return_values_dt_hr_versao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dt_hr_versao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dt_hr_versao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dt_hr_versao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          $this->NM_ajax_info['fldList']['dt_hr_versao_hora'] = array(
               'type'    => 'text',
               'valList' => array($this->dt_hr_versao_hora),
              );
          }
   }

          //----- cod_usuario
   function ajax_return_values_cod_usuario($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cod_usuario", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cod_usuario);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cod_usuario'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- descricao
   function ajax_return_values_descricao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("descricao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->descricao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['descricao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ind_sit_versao
   function ajax_return_values_ind_sit_versao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ind_sit_versao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ind_sit_versao);
              $aLookup = array();
              $this->_tmp_lookup_ind_sit_versao = $this->ind_sit_versao;

$aLookup[] = array(form_versoes_item_custo_container_pack_protect_string('1') => str_replace('<', '&lt;',form_versoes_item_custo_container_pack_protect_string("Incompleto")));
$aLookup[] = array(form_versoes_item_custo_container_pack_protect_string('2') => str_replace('<', '&lt;',form_versoes_item_custo_container_pack_protect_string("Completo")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_ind_sit_versao'][] = '1';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_ind_sit_versao'][] = '2';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"ind_sit_versao\"";
          if (isset($this->NM_ajax_info['select_html']['ind_sit_versao']) && !empty($this->NM_ajax_info['select_html']['ind_sit_versao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['ind_sit_versao']);
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

                  if ($this->ind_sit_versao == $sValue)
                  {
                      $this->_tmp_lookup_ind_sit_versao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['ind_sit_versao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['ind_sit_versao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['ind_sit_versao']['valList'][$i] = form_versoes_item_custo_container_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['ind_sit_versao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['ind_sit_versao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['ind_sit_versao']['labList'] = $aLabel;
          }
   }

          //----- container_id
   function ajax_return_values_container_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("container_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->container_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['container_id'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['upload_dir'][$fieldName][] = $newName;
            $this->Upload_refresh_fields[] = $fieldName;
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
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Field_no_validate'] = array();
      if (!isset($Ctrl_Format) || !$Ctrl_Format) {
          $this->nm_guardar_campos();
          if ($bFormat) $this->nm_formatar_campos();
      }
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->vl_dolar_compra = str_replace($sc_parm1, $sc_parm2, $this->vl_dolar_compra); 
      $this->vl_desconto_utiliz_dolar = str_replace($sc_parm1, $sc_parm2, $this->vl_desconto_utiliz_dolar); 
      $this->vl_desconto_utiliz_real = str_replace($sc_parm1, $sc_parm2, $this->vl_desconto_utiliz_real); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->vl_dolar_compra = "'" . $this->vl_dolar_compra . "'";
      $this->vl_desconto_utiliz_dolar = "'" . $this->vl_desconto_utiliz_dolar . "'";
      $this->vl_desconto_utiliz_real = "'" . $this->vl_desconto_utiliz_real . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->vl_dolar_compra = str_replace("'", "", $this->vl_dolar_compra); 
      $this->vl_desconto_utiliz_dolar = str_replace("'", "", $this->vl_desconto_utiliz_dolar); 
      $this->vl_desconto_utiliz_real = str_replace("'", "", $this->vl_desconto_utiliz_real); 
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
      $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_ind_sit_versao = $this->ind_sit_versao;
}
  if($this->ind_sit_versao  <> 1){
  
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Apenas Versões de Custo Incompletas Podem ser Deletadas !!!";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Apenas Versões de Custo Incompletas Podem ser Deletadas !!!";
 }
;	
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_ind_sit_versao != $this->ind_sit_versao || (isset($bFlagRead_ind_sit_versao) && $bFlagRead_ind_sit_versao)))
    {
        $this->ajax_return_values_ind_sit_versao(true);
    }
}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off'; 
      $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_versao_id = $this->versao_id;
}
              /* PUB.item_container_custo_descontos */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_descontos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_descontos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_descontos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_descontos WHERE versao_id = " . $this->versao_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_descontos WHERE versao_id = " . $this->versao_id ;
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.item_container_custo_despesas */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_despesas WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_despesas WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_despesas WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_despesas WHERE versao_id = " . $this->versao_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_despesas WHERE versao_id = " . $this->versao_id ;
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.item_container_custo_nfs */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_nfs WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_nfs WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_nfs WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_nfs WHERE versao_id = " . $this->versao_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_nfs WHERE versao_id = " . $this->versao_id ;
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.item_container_custo_pgtos */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_pgtos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_pgtos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_pgtos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_pgtos WHERE versao_id = " . $this->versao_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custo_pgtos WHERE versao_id = " . $this->versao_id ;
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            /* PUB.item_container_custos */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custos WHERE versao_id = " . $this->versao_id ;
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custos WHERE versao_id = " . $this->versao_id ;
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM PUB.item_container_custos WHERE versao_id = " . $this->versao_id ;
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_versao_id != $this->versao_id || (isset($bFlagRead_versao_id) && $bFlagRead_versao_id)))
    {
        $this->ajax_return_values_versao_id(true);
    }
}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off'; 
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
      if ('incluir' == $this->nmgp_opcao && empty($this->cod_usuario)) {$this->cod_usuario = "" . $_SESSION['usr_login'] . ""; $this->NM_val_null[] = "cod_usuario";}  
      if ('incluir' == $this->nmgp_opcao && empty($this->ind_sit_versao)) {$this->ind_sit_versao = "1"; $this->NM_val_null[] = "ind_sit_versao";}  
      if ('incluir' == $this->nmgp_opcao && empty($this->container_id)) {$this->container_id = "" . $_SESSION['container_corrente'] . ""; $this->sc_force_zero[] = "container_id";}  
      $NM_val_form['versao_id'] = $this->versao_id;
      $NM_val_form['tipo_versao_id'] = $this->tipo_versao_id;
      $NM_val_form['dt_hr_versao'] = $this->dt_hr_versao;
      $NM_val_form['cod_usuario'] = $this->cod_usuario;
      $NM_val_form['descricao'] = $this->descricao;
      $NM_val_form['ind_sit_versao'] = $this->ind_sit_versao;
      $NM_val_form['container_id'] = $this->container_id;
      $NM_val_form['vl_dolar_compra'] = $this->vl_dolar_compra;
      $NM_val_form['vl_desconto_utiliz_dolar'] = $this->vl_desconto_utiliz_dolar;
      $NM_val_form['vl_desconto_utiliz_real'] = $this->vl_desconto_utiliz_real;
      if ($this->versao_id === "" || is_null($this->versao_id))  
      { 
          $this->versao_id = 0;
      } 
      if ($this->ind_sit_versao === "" || is_null($this->ind_sit_versao))  
      { 
          $this->ind_sit_versao = 0;
          $this->sc_force_zero[] = 'ind_sit_versao';
      } 
      if ($this->vl_dolar_compra === "" || is_null($this->vl_dolar_compra))  
      { 
          $this->vl_dolar_compra = 0;
          $this->sc_force_zero[] = 'vl_dolar_compra';
      } 
      if ($this->vl_desconto_utiliz_dolar === "" || is_null($this->vl_desconto_utiliz_dolar))  
      { 
          $this->vl_desconto_utiliz_dolar = 0;
          $this->sc_force_zero[] = 'vl_desconto_utiliz_dolar';
      } 
      if ($this->vl_desconto_utiliz_real === "" || is_null($this->vl_desconto_utiliz_real))  
      { 
          $this->vl_desconto_utiliz_real = 0;
          $this->sc_force_zero[] = 'vl_desconto_utiliz_real';
      } 
      if ($this->tipo_versao_id === "" || is_null($this->tipo_versao_id))  
      { 
          $this->tipo_versao_id = 0;
          $this->sc_force_zero[] = 'tipo_versao_id';
      } 
      if ($this->container_id === "" || is_null($this->container_id))  
      { 
          $this->container_id = 0;
          $this->sc_force_zero[] = 'container_id';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->dt_hr_versao_before_qstr = $this->dt_hr_versao;
          $this->dt_hr_versao = substr($this->Db->qstr($this->dt_hr_versao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dt_hr_versao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->dt_hr_versao);
          }
          if ($this->dt_hr_versao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->dt_hr_versao = "null"; 
              $this->NM_val_null[] = "dt_hr_versao";
          } 
          $this->cod_usuario_before_qstr = $this->cod_usuario;
          $this->cod_usuario = substr($this->Db->qstr($this->cod_usuario), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->cod_usuario = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->cod_usuario);
          }
          if ($this->cod_usuario == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->cod_usuario = "null"; 
              $this->NM_val_null[] = "cod_usuario";
          } 
          $this->descricao_before_qstr = $this->descricao;
          $this->descricao = substr($this->Db->qstr($this->descricao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->descricao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->descricao);
          }
          if ($this->descricao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->descricao = "null"; 
              $this->NM_val_null[] = "descricao";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_versoes_item_custo_container_pack_ajax_response();
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
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "dt_hr_versao = '$this->dt_hr_versao', cod_usuario = '$this->cod_usuario', descricao = '$this->descricao', ind_sit_versao = $this->ind_sit_versao, tipo_versao_id = $this->tipo_versao_id, container_id = $this->container_id"; 
              } 
              $Prep_Tst = (isset($NM_val_form['vl_dolar_compra']) && $NM_val_form['vl_dolar_compra'] == "null"  && $this->nmgp_dados_select['vl_dolar_compra'] == "") ? "null" : $this->nmgp_dados_select['vl_dolar_compra'];
              if (isset($NM_val_form['vl_dolar_compra']) && $NM_val_form['vl_dolar_compra'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "vl_dolar_compra = $this->vl_dolar_compra"; 
              } 
              $Prep_Tst = (isset($NM_val_form['vl_desconto_utiliz_dolar']) && $NM_val_form['vl_desconto_utiliz_dolar'] == "null"  && $this->nmgp_dados_select['vl_desconto_utiliz_dolar'] == "") ? "null" : $this->nmgp_dados_select['vl_desconto_utiliz_dolar'];
              if (isset($NM_val_form['vl_desconto_utiliz_dolar']) && $NM_val_form['vl_desconto_utiliz_dolar'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "vl_desconto_utiliz_dolar = $this->vl_desconto_utiliz_dolar"; 
              } 
              $Prep_Tst = (isset($NM_val_form['vl_desconto_utiliz_real']) && $NM_val_form['vl_desconto_utiliz_real'] == "null"  && $this->nmgp_dados_select['vl_desconto_utiliz_real'] == "") ? "null" : $this->nmgp_dados_select['vl_desconto_utiliz_real'];
              if (isset($NM_val_form['vl_desconto_utiliz_real']) && $NM_val_form['vl_desconto_utiliz_real'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "vl_desconto_utiliz_real = $this->vl_desconto_utiliz_real"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE versao_id = $this->versao_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE versao_id = $this->versao_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE versao_id = $this->versao_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE versao_id = $this->versao_id ";  
              }  
              else  
              {
                  $comando .= " WHERE versao_id = $this->versao_id ";  
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
                                  form_versoes_item_custo_container_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->dt_hr_versao = $this->dt_hr_versao_before_qstr;
              $this->cod_usuario = $this->cod_usuario_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['versao_id'])) { $this->versao_id = $NM_val_form['versao_id']; }
              elseif (isset($this->versao_id)) { $this->nm_limpa_alfa($this->versao_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['dt_hr_versao'])) { $this->dt_hr_versao = $NM_val_form['dt_hr_versao']; }
              elseif (isset($this->dt_hr_versao)) { $this->nm_limpa_alfa($this->dt_hr_versao); }
              if     (isset($NM_val_form) && isset($NM_val_form['cod_usuario'])) { $this->cod_usuario = $NM_val_form['cod_usuario']; }
              elseif (isset($this->cod_usuario)) { $this->nm_limpa_alfa($this->cod_usuario); }
              if     (isset($NM_val_form) && isset($NM_val_form['descricao'])) { $this->descricao = $NM_val_form['descricao']; }
              elseif (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
              if     (isset($NM_val_form) && isset($NM_val_form['ind_sit_versao'])) { $this->ind_sit_versao = $NM_val_form['ind_sit_versao']; }
              elseif (isset($this->ind_sit_versao)) { $this->nm_limpa_alfa($this->ind_sit_versao); }
              if     (isset($NM_val_form) && isset($NM_val_form['tipo_versao_id'])) { $this->tipo_versao_id = $NM_val_form['tipo_versao_id']; }
              elseif (isset($this->tipo_versao_id)) { $this->nm_limpa_alfa($this->tipo_versao_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['container_id'])) { $this->container_id = $NM_val_form['container_id']; }
              elseif (isset($this->container_id)) { $this->nm_limpa_alfa($this->container_id); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('versao_id', 'tipo_versao_id', 'dt_hr_versao', 'cod_usuario', 'descricao', 'ind_sit_versao', 'container_id'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(versao_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_versoes_item_custo_container_pack_ajax_response();
              }
              exit; 
          }  
          $this->versao_id_before_qstr = $this->versao_id = $rs->fields[0] + 1;
          $rs->Close(); 
              $this->dt_hr_versao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->dt_hr_versao_hora =  date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
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
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_versoes_item_custo_container_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES ($this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id) VALUES (" . $NM_seq_auto . "$this->versao_id, '$this->dt_hr_versao', '$this->cod_usuario', '$this->descricao', $this->ind_sit_versao, $this->vl_dolar_compra, $this->vl_desconto_utiliz_dolar, $this->vl_desconto_utiliz_real, $this->tipo_versao_id, $this->container_id)"; 
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
                              form_versoes_item_custo_container_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->dt_hr_versao = $this->dt_hr_versao_before_qstr;
              $this->cod_usuario = $this->cod_usuario_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->dt_hr_versao = $this->dt_hr_versao_before_qstr;
              $this->cod_usuario = $this->cod_usuario_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->versao_id = substr($this->Db->qstr($this->versao_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where versao_id = $this->versao_id "); 
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
                          form_versoes_item_custo_container_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']);
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
        if ($this->SC_log_atv)
        {
            $this->NM_gera_log_output();
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_versao_id = $this->versao_id;
}
  $this->incrementarVlSequenciaEspec('seq_versao_item_container_custo','versoes_item_custo_container');
echo "<h2>Processando...</h2>";
$this->gravarVersaoCusto($this->versao_id );
$this->preencherIDLog($this->Ini->nm_cod_apl);
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('cons_versoes_item_custo_container') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_versao_id != $this->versao_id || (isset($bFlagRead_versao_id) && $bFlagRead_versao_id)))
    {
        $this->ajax_return_values_versao_id(true);
    }
}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off'; 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off'; 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['parms'] = "versao_id?#?$this->versao_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->versao_id = null === $this->versao_id ? null : substr($this->Db->qstr($this->versao_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->versao_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->versao_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" && $this->sc_evento == "insert")
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_versoes_item_custo_container = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] = $qt_geral_reg_form_versoes_item_custo_container;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->versao_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "versao_id < $this->versao_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "versao_id < $this->versao_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "versao_id < $this->versao_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "versao_id < $this->versao_id "; 
              }
              else  
              {
                  $Key_Where = "versao_id < $this->versao_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_versoes_item_custo_container = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] > $qt_geral_reg_form_versoes_item_custo_container)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = $qt_geral_reg_form_versoes_item_custo_container; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = $qt_geral_reg_form_versoes_item_custo_container; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_versoes_item_custo_container) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT versao_id, dt_hr_versao, cod_usuario, descricao, ind_sit_versao, vl_dolar_compra, vl_desconto_utiliz_dolar, vl_desconto_utiliz_real, tipo_versao_id, container_id from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "versao_id = $this->versao_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "versao_id = $this->versao_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "versao_id = $this->versao_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "versao_id = $this->versao_id"; 
              }  
              else  
              {
                  $aWhere[] = "versao_id = $this->versao_id"; 
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
          $sc_order_by = "versao_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter'] = true;
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
              $this->versao_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['versao_id'] = $this->versao_id;
              $this->dt_hr_versao = $rs->fields[1] ; 
              $this->nmgp_dados_select['dt_hr_versao'] = $this->dt_hr_versao;
              $this->cod_usuario = $rs->fields[2] ; 
              $this->nmgp_dados_select['cod_usuario'] = $this->cod_usuario;
              $this->descricao = $rs->fields[3] ; 
              $this->nmgp_dados_select['descricao'] = $this->descricao;
              $this->ind_sit_versao = $rs->fields[4] ; 
              $this->nmgp_dados_select['ind_sit_versao'] = $this->ind_sit_versao;
              $this->vl_dolar_compra = $rs->fields[5] ; 
              $this->nmgp_dados_select['vl_dolar_compra'] = $this->vl_dolar_compra;
              $this->vl_desconto_utiliz_dolar = $rs->fields[6] ; 
              $this->nmgp_dados_select['vl_desconto_utiliz_dolar'] = $this->vl_desconto_utiliz_dolar;
              $this->vl_desconto_utiliz_real = $rs->fields[7] ; 
              $this->nmgp_dados_select['vl_desconto_utiliz_real'] = $this->vl_desconto_utiliz_real;
              $this->tipo_versao_id = $rs->fields[8] ; 
              $this->nmgp_dados_select['tipo_versao_id'] = $this->tipo_versao_id;
              $this->container_id = $rs->fields[9] ; 
              $this->nmgp_dados_select['container_id'] = $this->container_id;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->versao_id = (string)$this->versao_id; 
              $this->ind_sit_versao = (string)$this->ind_sit_versao; 
              $this->vl_dolar_compra = (string)$this->vl_dolar_compra; 
              $this->vl_desconto_utiliz_dolar = (string)$this->vl_desconto_utiliz_dolar; 
              $this->vl_desconto_utiliz_real = (string)$this->vl_desconto_utiliz_real; 
              $this->tipo_versao_id = (string)$this->tipo_versao_id; 
              $this->container_id = (string)$this->container_id; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['parms'] = "versao_id?#?$this->versao_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] < $qt_geral_reg_form_versoes_item_custo_container;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao']   = '';
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
              $this->versao_id = "";  
              $this->nmgp_dados_form["versao_id"] = $this->versao_id;
              $this->dt_hr_versao = "";  
              $this->dt_hr_versao_hora = "" ;  
              $this->nmgp_dados_form["dt_hr_versao"] = $this->dt_hr_versao;
              $this->cod_usuario = "";  
              $this->nmgp_dados_form["cod_usuario"] = $this->cod_usuario;
              $this->descricao = "";  
              $this->nmgp_dados_form["descricao"] = $this->descricao;
              $this->ind_sit_versao = "";  
              $this->nmgp_dados_form["ind_sit_versao"] = $this->ind_sit_versao;
              $this->vl_dolar_compra = "";  
              $this->nmgp_dados_form["vl_dolar_compra"] = $this->vl_dolar_compra;
              $this->vl_desconto_utiliz_dolar = "";  
              $this->nmgp_dados_form["vl_desconto_utiliz_dolar"] = $this->vl_desconto_utiliz_dolar;
              $this->vl_desconto_utiliz_real = "";  
              $this->nmgp_dados_form["vl_desconto_utiliz_real"] = $this->vl_desconto_utiliz_real;
              $this->tipo_versao_id = "";  
              $this->nmgp_dados_form["tipo_versao_id"] = $this->tipo_versao_id;
              $this->container_id = "";  
              $this->nmgp_dados_form["container_id"] = $this->container_id;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['foreign_key'] as $sFKName => $sFKValue)
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " where versao_id < $this->versao_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->versao_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " where versao_id > $this->versao_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->versao_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter']))
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
     $this->versao_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(versao_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
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
     $this->versao_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
       $this->SC_log_arr['keys']['versao_id'] =  $this->versao_id;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dados_select'];
           $this->SC_log_arr['fields']['dt_hr_versao']['0'] =  $nmgp_dados_select['dt_hr_versao'];
           $this->SC_log_arr['fields']['cod_usuario']['0'] =  $nmgp_dados_select['cod_usuario'];
           $this->SC_log_arr['fields']['descricao']['0'] =  $nmgp_dados_select['descricao'];
           $this->SC_log_arr['fields']['ind_sit_versao']['0'] =  $nmgp_dados_select['ind_sit_versao'];
           $this->SC_log_arr['fields']['vl_dolar_compra']['0'] =  $nmgp_dados_select['vl_dolar_compra'];
           $this->SC_log_arr['fields']['vl_desconto_utiliz_dolar']['0'] =  $nmgp_dados_select['vl_desconto_utiliz_dolar'];
           $this->SC_log_arr['fields']['vl_desconto_utiliz_real']['0'] =  $nmgp_dados_select['vl_desconto_utiliz_real'];
           $this->SC_log_arr['fields']['tipo_versao_id']['0'] =  $nmgp_dados_select['tipo_versao_id'];
           $this->SC_log_arr['fields']['container_id']['0'] =  $nmgp_dados_select['container_id'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['dt_hr_versao']['1'] =  $this->dt_hr_versao;
       $this->SC_log_arr['fields']['cod_usuario']['1'] =  $this->cod_usuario;
       $this->SC_log_arr['fields']['descricao']['1'] =  $this->descricao;
       $this->SC_log_arr['fields']['ind_sit_versao']['1'] =  $this->ind_sit_versao;
       $this->SC_log_arr['fields']['vl_dolar_compra']['1'] =  $this->vl_dolar_compra;
       $this->SC_log_arr['fields']['vl_desconto_utiliz_dolar']['1'] =  $this->vl_desconto_utiliz_dolar;
       $this->SC_log_arr['fields']['vl_desconto_utiliz_real']['1'] =  $this->vl_desconto_utiliz_real;
       $this->SC_log_arr['fields']['tipo_versao_id']['1'] =  $this->tipo_versao_id;
       $this->SC_log_arr['fields']['container_id']['1'] =  $this->container_id;
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
       $Log_labels['dt_hr_versao'] =  "Dt.Hr.Versão";
       $Log_labels['cod_usuario'] =  "Usuário";
       $Log_labels['descricao'] =  "Descrição";
       $Log_labels['ind_sit_versao'] =  "Situação";
       $Log_labels['vl_dolar_compra'] =  "Vl Dolar Compra";
       $Log_labels['vl_desconto_utiliz_dolar'] =  "Vl Desconto Utiliz Dolar";
       $Log_labels['vl_desconto_utiliz_real'] =  "Vl Desconto Utiliz Real";
       $Log_labels['tipo_versao_id'] =  "Tipo Versão";
       $Log_labels['container_id'] =  "Container Id";
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function buscarCotacaoDolarVendaBC($serieParam = 1, $tempo = 3, $tipoRetorno = 'valor', $logHist = true, $logForcarBusca = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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
    
    
    
    $diaSemana = diaDaSemana($data, 1, 'dd/mm/aaaa');
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirHistCotacaoBc($serie, $data, $valor, $nome, $logOk)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosCotacaoHoje($serieParam = 1)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $data = date('Y-m-d');
    $aRet = $this->getDadosHistCotacoesBc(0,
        'top 1 valor  as valor,nome_serie,data',
        " serie = $serieParam and data = '$data' and (log_ok = 1 or log_manual = 1) order by hist_cotacao_bc_id desc");
    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlCotacaoHoje($serie = 1)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor = 0;
    $aDados = $this->getDadosCotacaoHoje($serie);
    if (is_array($aDados)) {
        $valor = $aDados['valor'];
    }
    return $valor;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosUltCotacao($serie = 1)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosHistCotacoesBc($id, $campos = '', $filtro = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrCotacaoDia($serie = 1)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logAtu = false;
    $vl = $this->getVlCotacaoHoje($serie);
    if ($vl == 0) {
        $vl = $this->atualizarCotacaoDia($serie);
        $logAtu = true;
    }
    $aRetorno = array('valor' => $vl, 'log_atu' => $logAtu);
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCotacaoDia($serie, $valor = 0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aCotacao = $this->getCotacaoEms5($indicador, $data);
    $logAchou = $aCotacao['log_achou'];
    if ($logAchou == 0) {
        $this->inserirCotacaoEms5($indicador, $data, $valor);
    } else {
        $this->atualizarCotacaoEms5($indicador, $data, $valor);
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCotacaoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCotacoesPeriodoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCotacaoEms5($serie, $data)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirCotacaoEms5($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirCotacaoEms2($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCotacaoEms($serie, $data, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $indicador = $this->convSerieEmIndicador($serie, 'ems2');
    $this->sincrCotacaoEms2($indicador, $data, $valor);
    $indicador = $this->convSerieEmIndicador($serie, 'ems5');
    $this->sincrCotacaoEms5($indicador, $data, $valor);


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convSerieEmIndicador($serie, $destino)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCodSistCtrlImportacao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return 18; 

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarProgsSistema($sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tabelas = 'modulos m, programas s';
    $campos = 'p.codigo as codigo, p.cod_tipo_programa as cod_tipo_programa';
    $condicao = " m.cod_sistema = $sistema and m.cod_modulo = p.cod_modulo";
    $aRetorno = $this->retornoMultReg($tabelas, $campos, $condicao,"ticontrole");
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarProgsUsuario($login, $sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProgUsuario($login,$sistema,$codPrograma)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarPermProg($login, $prog)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
            inserirLogDb("registro $i",$aRetorno[$i],__FUNCTION__);
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
                            $this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
                            $this->NM_ajax_info['buttonDisplay']['insert'] = $this->nmgp_botoes["insert"] = 'off';;
                            $this->NM_ajax_info['buttonDisplay']['copy'] = $this->nmgp_botoes["copy"] = 'off';;
                        } else {
                            $this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'on';;
                            $this->NM_ajax_info['buttonDisplay']['insert'] = $this->nmgp_botoes["insert"] = 'on';;
                            $this->NM_ajax_info['buttonDisplay']['copy'] = $this->nmgp_botoes["copy"] = 'on';;
                        }
                        if ($alterar != 'Y') {
                            $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = 'off';;
                        } else {
                            $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = 'on';;
                        }
                        if ($excluir != 'Y') {
                            $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
                        } else {
                            $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'on';;
                        }
                        if ($exportar != 'Y') {
                            $this->NM_ajax_info['buttonDisplay']['pdf'] = $this->nmgp_botoes["pdf"] = 'off';;
                        } else {
                            $this->NM_ajax_info['buttonDisplay']['pdf'] = $this->nmgp_botoes["pdf"] = 'on';;
                        }
                        if ($imprimir != 'Y') {
                            $this->NM_ajax_info['buttonDisplay']['print'] = $this->nmgp_botoes["print"] = 'off';;
                        } else {
                            $this->NM_ajax_info['buttonDisplay']['print'] = $this->nmgp_botoes["print"] = 'on';;
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
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('acesso_bloqueado') . "/", $this->nm_location, "nome_prog?#?" . NM_encode_input($prog) . "?@?", "_self", "ret_self", 440, 630);
 };
            }
        }


    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function aplicarPermissaoUsuario($login, $sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $this->aplicarPermissaoUsuarioSC($login, $sistema);

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function aplicarPermissaoUsuarioSC($login, $sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function has_priv($valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return ($valor == 'Y' ? 'on' : 'off');

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getGruposUsuario($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaGrupos = '';
    $tabela   = " pub.usuarios_grupos ";
    $campos   = "cod_grupo";
    $condicao = "login_usuario = '$login' ";
    $aRet = $this->getDados('multi',$tabela,$campos,$condicao,"espec");
    if(is_array($aRet)){
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $listaGrupos = $this->util_incr_valor($listaGrupos,$aRet[$i]['cod_grupo'])  ;
        }

    }
    return $listaGrupos;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTipoUsuario($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tipo = 0;
    $aReg = $this->getDadosUserWeb($login,'"tp-usuario"');
    
    if(is_array($aReg)){
        $tipo = $aReg[0]['"tp-usuario"'];
    }
    return $tipo;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTipoUsuarioCorrente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTipoUsuario());

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getLinkCarrinho()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $link = '';
    $tpUsuario = $this->getTipoUsuarioCorrente();
    switch ($tpUsuario){
        case '2':
        case '5':
            $link = "cons_ped_web_carrinho";
            break;
        default:
            $link = "cons_ped_web_carrinho_admin";
    }
    if($this->sc_temp_usr_login == 'tasilpar'){
        echo "<h1>tp.usuario: $tpUsuario</h1>";
    }
    return $link;

if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getRegUsuario($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
	$aReg = $this->getReg('espec','user-web', 'login',
        "'$login'", $campos,$filtroCompl);
	return $aReg;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificGrupoLogin($codGrupo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());

    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarPermissaoAlocacao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log =false;
    if(strstr('2,3,5',$this->getTipoUsuarioCorrente()) <> false){
        if($this->getTipoUsuarioCorrente() == '3'){ 
            $log = $this->verificGrupoLogin('5'); 
        }else{
            $aReg = $this->getDadosUserWeb($this->getLoginCorrente(),'log_pedido_on_line');
            if(is_array($aReg)){
                $logPedidoOnLine = $aReg[0]['log_pedido_on_line'];
                if($logPedidoOnLine == 1){
                    $log =true;
                }
            }
        }
    }

    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosUserWeb($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $aReg = $this->getReg('espec','user-web',
        'login',"'$login'",$campos,
        $filtroCompl,'');

    return $aReg;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUsuarioERP($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $usuario = '';
    $aRet = $this->getDadosUserWeb($login,'usuario');
   if(is_array($aRet)){
       $usuario = $aRet[0]['usuario'];
   }
   return $usuario;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPermPagtoViaCaixa($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logCaixa = $aReg[0]['log_caixa'];
    }else{
        $logCaixa = 0;
    }
    return $logCaixa == 1;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPermissoesPedWeb($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logCaixa = $aReg[0]['log_caixa'];
        $logPrioridade = $aReg[0]['log_prioridade'];
    }else{
        $logCaixa = 0;
        $logPrioridade = 0;
    }
    $aRetorno = array('log_caixa' => $logCaixa == 1 ,'log_prioridade' => $logPrioridade == 1);
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verifVendLoja()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getParamVendLoja());

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getParamVendLoja()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return 'vend_loja';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPermPrioridade($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logPrioridade = $aReg[0]['log_prioridade'];
    }else{
        $logPrioridade = 0;
    }
    return $logPrioridade == 1;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getGruposRepresGeral()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return "2,3";

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCpsEsconderPedido($tipo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaCps = '';
    switch($tipo){
        case '2':
            $listaCps = 'dt-useralt,user-alte,user-canc';
            break;
    }
    return $listaCps;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function trocarPerfil($logVoltar,$novoPerfil='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    if($logVoltar){
        $novoPerfil = $this->getVarSessao('perfil_pai');
    }else{
        setVarSessao('perfil_pai',$this->getLoginCorrente()) ;
    }
    $this->limparLogin();
    $aUsuario = $this->getDadosUserWeb($novoPerfil,$this->getCamposUsuario());
    $this->setarVarsLogin($aUsuario);
    

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getFoto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $caminho = "#";
    $aReg = $this->getDadosUserWeb($this->getLoginCorrente(),'foto,sexo');

       if(is_array($aReg)){
        $foto = $aReg[0]['foto'];
        $sexo = $aReg[0]['sexo'];
        if($foto <> ''){
            $caminho = "../_lib/file/imgfotos/$foto";
        }else if($foto == '' and $sexo == 1 ) {
            $caminho = "../_lib/file/imgfotos/male.png";
        }else if($foto == '' and $sexo == 2 ) {
            $caminho = "../_lib/file/imgfotos/female.png";
        }
    }
    return $caminho;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarFoto($login,$foto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = "update pub.\"user-web\" set foto ='$foto'
            where login = '$login' ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verGrpAvalAdm()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = $this->verificGrupoLogin($this->getParamGrupoAvalAdm());
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaRepresGer($indiceRep='nome'){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    if($indiceRep == 'nome'){
        $varSessao = 'lista_nom_repres_ger';
    }else{
        $varSessao = 'lista_cod_repres_ger';
    }
    $lista = '';
    $listaSessao = $this->getVarSessao($varSessao);
    if($listaSessao == ''){
        $aDados = $this->getDados('multi','comum.pub.repres repres','hierarq."cod-depend" as rep',
            " \"nome-abrev\" = '".$this->getLoginCorrente()."'",'multi',
            " inner join pub.\"cm-hierarquia\" hierarq on hierarq.\"cod-rep\" = repres.\"cod-rep\" ");
        if(is_array($aDados)){
            foreach($aDados as $reg){
                if($indiceRep == "nome"){
                    $aRepres = getDadosRepresEms2($reg['rep'],'"nome-abrev" as nome');
                    if(is_array($aRepres)){
                        $nomeRepres = $aRepres[0]['nome'];
                    }else{
                        $nomeRepres = '';
                    }
                }else{
                    $aRepres = getDadosRepresEms2($reg['rep'],'"cod-rep" as cod_rep');
                    if(is_array($aRepres)){
                        $nomeRepres = $aRepres[0]['cod_rep'];
                    }else{
                        $nomeRepres = '';
                    }
                }

                $lista = $this->util_incr_valor($lista,"'$nomeRepres'");


            }
        }
        if($lista == ''){

            $lista = "''";
        }
        setVarSessao($varSessao,$lista);
    }else{
        $lista = $listaSessao;
    }
    return $lista;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeVarTipoUsuario()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return 'glo_tipoUsuario';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNumTpUsuarioRepres()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return '2';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNumTpUsuarioPreposto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return '5';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNumTpUsuarioAdmVendas()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return '3';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNumTpUsuarioAdm()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return '4';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verifPermisAprovGerencial($codGrupo,$usuario)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario("$usuario");
    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeGerPorUsuarErp($usuarioErp){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $nomeGer = '';
    switch($usuarioErp){
        case "CJESUS":
            $nomeGer = 'Celeno Jesus';
            break;

        case "jmarcelo":
            $nomeGer = 'Marcelo';
            break;

        case "gantunes":
            $nomeGer = 'Guilherme';
            break;

        case "Gessica":
            $nomeGer = 'Gessica';
            break;

        case "aviana":
            $nomeGer = 'Alan Viana';
            break;

    }
    return $nomeGer;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarRegDistrCusto($item_container_custo_id,$item_container_id,$historico,$cod_tipo_movto,$vl_lancto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if(!$this->getParamDistrCusto()){
        $vl_lancto = 0;
        $historico .=" - Lançamento zerado devido a distribuição de custo estar desligada";
    }
    $login = $this->getLoginCorrente();
    $cmd = "insert into pub.cta_corren_custo_distr(cta_corren_custo_distr_id,data,item_container_custo_id,item_container_id,historico,
            cod_tipo_movto,vl_lancto,login)
            values(pub.seq_cta_corren_custo_distr.NEXTVAL,CURDATE(),$item_container_custo_id,$item_container_id,'$historico',$cod_tipo_movto,$vl_lancto,'$login')";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $novoId = $this->buscarVlSequenciaEspec('seq_cta_corren_custo_distr','cta_corren_custo_distr');
    return $novoId;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDadosCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tabela = "pub.cta_corren_custo_distr";
    $campos = "data,item_container_custo_id,item_container_id,historico,cod_tipo_movto,vl_lancto";
    $condicao = "cta_corren_custo_distr_id = $id";
    $aRetorno = $this->retornoSimplesTb01 ($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarContainerCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = 0;
    $aDados = $this->buscarDadosCtaCorrenCustoDistr ($id);
    if(is_array ($aDados)){
        $itemContainerId = $aDados[0]['item_container_id'];
        $aDadosItemContainer = $this->buscarDadositemContainer ($itemContainerId);
        if(is_array ($aDadosItemContainer)){
            $container = $aDadosItemContainer[0]['container_id'];
        }
    }
    return $container;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarDespesaDistrCusto($idCtaCorrenCustoDistr,$valor,$itemContainerId=0,$container=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $memoriaCalculo = '';

    $idDespesa = $this->buscarDespesaDistrCusto();
    if($container == 0){
        $container = $this->buscarContainerCtaCorrenCustoDistr($idCtaCorrenCustoDistr);
    }
    if(!$this->getParamDistrCusto()){
        $valor = 0;
        $memoriaCalculo = 'Valor do lançamento zerado devido a distr. custo estar desligada por parametro';
    }
    $this->criarDespesaContainer(
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarVlDespesaDistrCusto($idCtaCorrenCustoDistr, $valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logAtualizado = 0;
    $id = $this->buscarDespesaContainerDistrCusto($idCtaCorrenCustoDistr);
    if($id <> 0){
        $logAtualizado = 1;
        $this->atualizarVlDespesaContainerPorId($id,$valor);
    }
    return $logAtualizado;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarSaldoAtualDistrCusto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor = 0;
    $tabela = "pub.cta_corren_custo_distr";
    $campo = "sum(vl_lancto) as saldo";
    $condicao = " 1=1 ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['saldo'];
    }
    return $valor;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularSaldoAnteriorDistrCusto($condicao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
      if ($this->distr = $this->Ini->nm_db_espec->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->distr = false;
          $this->distr_erro = $this->Ini->nm_db_espec->ErrorMsg();
      } 

    if ($this->distr  === false){
    echo "Access error. Message =". $this->distr_erro ;
    $aRetorno = '';
    }
    else
    {
        while (!$this->distr->EOF) {
            $data = $this->distr->fields[ 0 ];
            $valorSaldo = $this->distr->fields[ 1 ];
            if ( $iCont == 0 ) {
                $dataInicio = $data ;
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTotalDistrParaItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vlTotal = 0;
    $tabela   = " pub.cta_corren_custo_distr ";
    $campos   = " sum(vl_lancto) as tot ";
    $condicao = "  item_container_id = $itemContainerId and cod_tipo_movto = 4";
    $aDados = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aDados)){
        $vlTotal = $aDados[0]['tot'];
    }
    return $vlTotal;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTotalDistrPorItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlDistrContainer($containerParam, $itemContainerParam='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
            $logGeracaoCusto    = $this->verificarGeracaoDistrCusto($container);
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $this->container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $this->descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $this->descricao = $aRetorno[0][$campo];
    }
    return $this->descricao;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = $this->buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTitAssociadosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlTotPagtoProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompraId);
    $codEstab     = $this->buscarEmpERPProcCompra($procCompraId,'ems5');
    $codEstab     += 1 ;
    $valor = $this->buscarTotPagoLista($codEstab,$listaTitulos,'dolar');
    return $valor;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlPgtoAssocContainer($procCompra,$container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function preencherCondPgtoProcCompra($condicaoTitAP)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function existTitProcCompra($numIdTitAp,$procCompraId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarNecesAtualizPgtoPedido($numIdTitAp)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logAtualizar = true;
    $container = $this->getcontainerPagto($numIdTitAp);
    if($container <> 0){
        $logExisteItens = $this->existItensContainer($container);
        if($logExisteItens == true){
            $logAtualizar = false;
        }
    }
    return $logAtualizar;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProcCompraPgto($numIdTitAp)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function desassociarTituloPedido($numIdTitAp,$procCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function associarTituloPedido($numIdTitAp,$proCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTitAssocSoPedido($fornecedor,$tipoReg)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaTitAssocPedido()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescItem($itCodigo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = '';
    $sql = " select \"desc-item\" from med.pub.\"item\" item_med
			where \"it-codigo\" = '$itCodigo'
			union 
			select \"desc-item\" from ima.pub.\"item\" item_ima
			where \"it-codigo\" = '$itCodigo'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->desc_item = array();
      if ($SCrx = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->desc_item[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->desc_item = false;
          $this->desc_item_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

    if ($this->desc_item  === false){
    echo "Erro ao acessar função buscarDescitem. Messagem=". $this->desc_item_erro  ;
	}
	elseif (empty($this->desc_item )){
}
	else{
    $retorno = $this->desc_item[0][0];
	}
	if($retorno == ''){
        $retorno = 'Item Não Encontrado';
    }
	return $retorno;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDescItem($itCodigo){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('ems2med','item','"it-codigo"',
        "$itCodigo",'"desc-item" as desc_it');
    return $aReg;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaItCodigoPorDescricao($descricao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaItens = '';
    $aDados = $this->getDados('multi','pub.item','"it-codigo" as it_codigo',
             " \"desc-item\" like '%$descricao%' ",'ems2med');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $itCodigo = $aDados[$i]['it_codigo'];
            $listaItens = $this->util_incr_valor($listaItens,"'$itCodigo'");
        }
    }
    return $listaItens;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarEmpProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " empresa_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){
        $empresa = $aRetorno[0]['empresa_id'];
    }
    return $empresa;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $processo = '';

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " cod_proc_fornec, fornecedor_id ",
        " proc_compra_id = $procCompraId ","espec");
    if(is_array($aRetorno)){
        $processo = $aRetorno[0]['cod_proc_fornec'];
        $fornecedor = $this->buscarDescFornecedor($aRetorno[0]['fornecedor_id']);
        $processo .= ' '. $fornecedor;
    }
    return $processo;



$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarFornecedorProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $fornecedor = 0;

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " fornecedor_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $fornecedor =$aRetorno[0]['fornecedor_id'];
    }
    return $fornecedor;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDtRegProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $data = '2001-01-01';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " dt_registro ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $data =$aRetorno[0]['dt_registro'];
    }
    return $data;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarEmpERPProcCompra($procCompraIdParam,$sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCotPrevProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'cotacao_prevista';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtContainerProcCompra($procCompraId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'qt_container';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarADProcCompra($procCompraID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosPedidoImp($id,$campos='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','procs_compra');
        $campos = $aCampos['campos'];
    }

    $tabela   = " pub.procs_compra ";
    $condicao = "  proc_compra_id = $id ";
    $aResult = $this->getDados('unico',$tabela,$campos,$condicao,"espec");
    return $aResult;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProcsCompraCtaPorFornec($fornecedor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProcsCompraIntegrCtaFornec()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProcsCompraNaoIntegrCtaFornec()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarAltPedCompra($pedido)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $erro = '';
    $vl = $this->buscarVlTotPagtoProcCompra($pedido);
    if($vl > 0 ){
        $erro = "Para alterar o fornecedor não pode existir nenhum pagamento associado";
    }
    return $erro;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validacoesPedCompra($pedido)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $erro = $this->validarAltPedCompra($pedido);
    return $erro;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getFornecsPedImpGeraPrev()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlMoeda($numIdTitAp,$codEstab='',$moeda='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getEspecsAdiant()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_adiant_importacao");
    if ($param == '') {
        $especs = "'AF'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getEspecsTit()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_tit_importacao");
    if ($param == '') {
        $especs = "'DI'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDadosTitulo($numTitAp,$codEstab='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $condicao = " num_id_tit_ap = $numTitAp  ";
    if($codEstab <> ''){
        $condicao .= " and cod_estab = '$codEstab'";
    }
    $tabela = 'pub.tit_ap';
    $campo  = 'cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela,dat_emis_docto,
	dat_vencto_tit_ap,dat_liquidac_tit_ap,cod_estab';

    return $this->retornoSimplesTb01($tabela,$campo,$condicao,"ems5");


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='sysprogress',$logOdbc=true)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $contAloc = 0;
    $logItensExistente = false;
    if(is_array($aItens)){
        $tot = count($aItens);
        for($x = 0; $x < $tot; $x++){
            $itemID           = $aItens[$x]['ID'];
            $qtAlocada        = $this->buscarQtAlocItemProc($itemID);
            $logJaSelecionado = $this->buscarItemAlocado($this->container_id,$itemID);
            $qtComprada       = $aItens[$x]['qt_comprada'];
            $qtDisponivel     = $qtComprada - $qtAlocada;
            if($logJaSelecionado == false){
                $cmd = "insert into pub.itens_container(item_container_id,container_id,item_proc_compra_id,qt_alocada)
                     values(pub.seq_itens_container.NEXTVAL, $this->container_id,$itemID,$qtDisponivel) ";
                
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
                form_versoes_item_custo_container_pack_ajax_response();
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aCustoItens                    	 = array();
    $lAchou                              = false;
    $vlPagoItens                	     = $this->buscarTotPagoContainer($containerId);
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
                $vlDistrParaItem  = $this->getTotalDistrParaItemContainer($itemContainerID);
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $this->descricao = '';
    $tipo     = "unico"; 
    $tabela   = " pub.itens_container item_container, pub.itens_proc_compra item_pedido ";
    $campos   = " descricao, codigo_erp ";
    $condicao = "  item_container_id = $itemContainerId 
    and item_container.item_proc_compra_id = item_pedido.item_proc_compra_id ";
    $conexao  = "espec";
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aReg)){
        $this->descricao = $aReg[0]['descricao']  ;
        $codErp    = $aReg[0]['codigo_erp']   ;
        if($codErp <> ''){
            $this->descricao .= " ($codErp)";
        }
    }
    return $this->descricao;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarUltItemCusto($itCodigo,$container='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
    $tabela = 'pub.item_custos item';
    $campos = 'item_custo_id,dt_hr_custo,vl_unit_novo,dt_referencia,vl_unit_anterior,
				cod_tipo_custo,it_codigo,qt_estoque,qt_nf_mae,qt_etiq_container,qt_etiq_branco,
				qt_etiq_outros_container,cod_situacao';
    $condicao = "item.item_custo_id in(
				select max(item_sub.item_custo_id) from pub.item_custos item_sub
				where it_codigo = '$itCodigo')";
    if ($container <> '') {
        $condicao = "item.item_custo_id in(
				select max(item_sub.item_custo_id) from pub.item_custos item_sub 
				inner join pub.item_container_custos icc on icc.item_custo_id = item_sub.item_custo_id
                inner join pub.versoes_item_custo_container versoes  on icc.versao_id = versoes.versao_id
				where item_sub.it_codigo = '$itCodigo'				
				and (versoes.container_id <> $container ) and item_sub.cod_tipo_custo = 2)
				or                
				item.item_custo_id in(
				select max(item_sub.item_custo_id) from pub.item_custos item_sub
				where item_sub.it_codigo = '$itCodigo' and  item_sub.cod_tipo_custo <> 2)
				order by item_custo_id desc
				";


    }
    $aRetorno = $this->retornoSimplesTb01($tabela, $campos, $condicao);
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularNovoCustoItem($container,$itemContainerId,$logPriorizarCustoPrevisto=0,$aDadosItemContainer='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $msgErro = '';
    $vlUnitAtual = 0;
    $itemCustoIdVlUnitAtual = 0;
    $logMovtoAnterior = false;
    $qtSaldoEstoqAtu = 0;

    if($aDadosItemContainer ==''){
        $aDadosItemContainer = $this->buscarDadositemContainer($itemContainerId);
    }
    if(is_array($aDadosItemContainer)){
        $itemProcCompraId 		= $aDadosItemContainer[0]['item_proc_compra_id'];
        $itemContainerId	 	= $aDadosItemContainer[0]['item_container_id'];
        $itCodigo 		  		= $this->buscarCodItemERP($itemProcCompraId);
    }
    else{
        $itemProcCompraId = 0;
        $qtAlocada		  = 0;
        $qtConfirmEmb	  = 0;
        $qtRecbtoFisico	  = 0;
        $itemContainerId  = 0;
        $itCodigo 		  = '';

    }

    if($itCodigo == ""){
        $msgErro .= "<h2>ATENÇÃO! O item  $itemProcCompraId  do Pedido de Importação não tem o 	
		item do ERP informado, não sendo possível desta forma calcular o custo do item !!!</h2>
		<h2>SOLUÇÃO:Informe o código ERP do item através do menu do Pedido de Importação, 
		opção 'Itens' e gere uma nova versão do custo do Container após esta alteração </h2>";
    }
    $aCustoItem = $this->buscarUltItemCusto($itCodigo,$container);
    $dtEmisNotaMae = $this->buscarDtEmisNotaMaeContainer($container);
    $logMovtoAnterior = getMovtoEstoqPorData($itCodigo,$dtEmisNotaMae);
    $saldoAnteriorNfMae = calcSaldoPorItemData($itCodigo,$dtEmisNotaMae);
    if(!is_array($aCustoItem)){
        if($logMovtoAnterior == true and $saldoAnteriorNfMae > 0){
            $msgErro .= "<h2>ATENÇÃO:Não Existe custo anterior para este item com saldo anterior de $saldoAnteriorNfMae !!!</h2><h2>SOLUÇÃO:Incluir um custo manual para o item</h2>";
            $vlUnitAtual = 0;
            $itemCustoIdVlUnitAtual = 0;
        }
    }
    else{
        $vlUnitAtual = $aCustoItem[0]['vl_unit_novo'];
        $itemCustoIdVlUnitAtual = $aCustoItem[0]['item_custo_id'];
    }
    $aCustoItemContainer  = $this->buscarDadosUltVersaoCustoContainer($container,$itemContainerId);

    if(is_array($aCustoItemContainer)){
        $vlUnitPrev    			= $aCustoItemContainer[0]['vl_unit_prev'];
        $vlUnitRealiz 			= $aCustoItemContainer[0]['vl_unit_realiz'];
        $qtAlocadaCusto  		= $aCustoItemContainer[0]['qt_alocada'];
        $qtConfirmEmbCusto	  	= $aCustoItemContainer[0]['qt_confirm_emb'];
        $qtRecbtoFisicoCusto	= $aCustoItemContainer[0]['qt_recebto_fisico'];
        $itemContainerCustoId   = $aCustoItemContainer[0]['item_container_custo_id'];


    }
    else{
        $vlUnitPrev    			= 0;
        $vlUnitRealiz 			= 0;
        $qtAlocadaCusto  		= 0;
        $qtConfirmEmbCusto	  	= 0;
        $qtRecbtoFisicoCusto	= 0;
        $itemContainerCustoId   = 0;

        $msgErro .= "<h1>ATENÇÃO:Não Existe custo do container calculado para o item $itemProcCompraId 
		do Pedido de Importação!!!</h1>
		<h1>SOLUÇÃO:É necessário gerar pelo menos um custo para o container. Faça isto através do
		menu do container,na opção 'Versões de Custo'</h1>";
    }

    $aVersao = $this->getVersaoCustoDesatu($container);
    if(is_array($aVersao)){
        $logVersaoCustoDesatualizado = $aVersao[0]['log_versao_custo_desatualizada'];
    }else{
        $logVersaoCustoDesatualizado = 1;
    }
    if($logVersaoCustoDesatualizado == 1){
        $msgErro .= "<h1>O calculo do custo está desatualizado, sendo necessário fazer uma nova versão do custo para que este programa exiba os valores para comparação corretamente.</h1>";

    }


    $aSaldoEstoq   = buscarSaldoEstoque($itCodigo);
    $qtSaldoEstoq  = $aSaldoEstoq[0]['ima'] + $aSaldoEstoq[0]['med'];
    $qtSaldoEstoqAtu = $qtSaldoEstoq;
    $aNotaMae = $this->buscarNotaMaeContainer($container);
    if($qtConfirmEmbCusto <> 0){
        $qtContainer = $qtConfirmEmbCusto;
        $qtNotaMae   = $qtConfirmEmbCusto;
        
    }
    else{
        $qtContainer = $qtAlocadaCusto;
        $qtNotaMae   = 0; 
        


    }

    if(!is_array($aNotaMae)){

        $aVersao = $this->getDadosVersaoCorrenteContainer($container);
        if(is_array($aVersao)){
            $tipoVersao = $aVersao[0]['tipo_versao_id'];
            $listaTpVersoesValidNf = $this->getTiposVersaoValidNFMae();
            if(strpos($listaTpVersoesValidNf,$tipoVersao) <> false){ 
                $msgErro.="<h1>A nota fiscal mãe deve ser informada para os tipos de custo:$listaTpVersoesValidNf</h1>";
            }
        }else{

        }
        
        $qtFaturada 	 = 0;
        $qtDiferenca 	 = 0;
        $qtContainerEtq  = 0;
        $qtRestante  	 = 0;
        $qtTotal	  	 = 0;
    }
    else{


        $aSaldoAnalise 		= buscarAnaliseSaldo($itCodigo,$qtSaldoEstoq,$container);
        if(is_array($aSaldoAnalise)){
            $qtDiferenca 	 = $aSaldoAnalise[0]['qt_diferenca'];
            $qtContainerEtq = $aSaldoAnalise[0]['qt_container'];
            $qtRestante  	 =	$aSaldoAnalise[0]['qt_restante'];


            $qtTotal	  	 = $qtDiferenca + $qtContainerEtq + $qtRestante;
        }
        else{
            $qtDiferenca 		= 0;
            $qtContainerEtq 	= 0;
            $qtRestante  		= 0;
            $qtTotal	  		= 0;
        }

        

        

        $qtSaldoEstoq -= $qtContainerEtq;

        if($qtSaldoEstoq < 0){
            $qtSaldoEstoq = 0;
        }

    }
    


    $logCustoRealCompleto =	$this->verificarLiberCustoContainer($container);

    if($logPriorizarCustoPrevisto == 1){ 
        $vlUnitContainer = $vlUnitPrev;
    }
    else{ 
        $vlUnitContainer = $vlUnitRealiz;
        if($vlUnitContainer == 0){
            $vlUnitContainer = $vlUnitPrev;
        }
    }
    if($logCustoRealCompleto == false){
        $vlUnitContainer = $vlUnitPrev;
    }


    

    $vlContainer  = $qtContainer  *  $vlUnitContainer;
    $vlEstoque    = $qtSaldoEstoq *  $vlUnitAtual;
    $vlTotal 	  = $vlContainer  +  $vlEstoque;
    $qtPond       = $qtContainer  +  $qtSaldoEstoq;
    if($vlTotal > 0 and $qtPond > 0){
        $vlUnit		  = round($vlTotal / $qtPond,2) ;
    }
    else{
        $vlUnit  = 0;
    }
    if($logMovtoAnterior == false){
        $vlUnit = $vlUnitContainer;
    }
    $aRetorno[] = array("erros"=> $msgErro,
        "it_codigo" => $itCodigo,
        "qt_saldo_estoq" => $qtSaldoEstoq,
        "qt_diferenca" =>$qtDiferenca,
        "qt_etiquetas_container" => $qtContainerEtq,
        "qt_restante" => $qtRestante ,
        "qt_container" => $qtContainer,
        "vl_unit_container" =>$vlUnitContainer,
        "vl_tot_container" => $vlContainer,
        "vl_unit_atual" => $vlUnitAtual,
        "vl_total" => $vlTotal ,
        "qt_total" => $qtPond,
        "vl_unit_novo" => $vlUnit ,
        "item_custo_id_orig" => $itemCustoIdVlUnitAtual,
        "item_container_custo_id" => $itemContainerCustoId,
        "qt_nota_mae" => $qtNotaMae,
        "qt_saldo_estoq_atu" =>$qtSaldoEstoqAtu);
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirItemCustosTipoContainer($dtHrCusto, $vlUnitNovo, $itCodigo, $qtEstoque, $qtNfMae,
                                        $qtEtiqContainer, $vlUnitAnterior,$vlUnitContainer,
                                        $qtContainer )
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $hoje = date('Y-m-d');
    $dtReferencia 	= $hoje;
    $seq = 0;
    $codTipoCusto 	= 2;
    $cmd = "insert into pub.item_custos(item_custo_id,
									  dt_hr_custo,
									  vl_unit_novo,
									  dt_referencia,
									  cod_tipo_custo,
									  it_codigo,
									  qt_estoque,
									  qt_estoque_selecionado,
									  qt_nf_mae,
									  qt_etiq_container,										  
									  vl_unit_anterior,
									  cod_situacao,
									  vl_unit_container,
									  qt_container,
                                      cod_usuario)values
									  (pub.seq_item_custos.NEXTVAL,
									 '$dtHrCusto',
									 $vlUnitNovo,
									 '$dtReferencia',
									 $codTipoCusto,
									 '$itCodigo',
									 $qtEstoque,
									 $qtEstoque,
									 $qtNfMae,
									 $qtEtiqContainer,
									 $vlUnitAnterior,
									 2,
									 $vlUnitContainer,
									 $qtContainer,
									'$this->sc_temp_usr_login')
									 ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $seq = $this->buscarVlSequenciaEspec('seq_item_custos','item_custos');
    return $seq;
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirItemCustosTipoMedia($vlUnitNovo,$itCodigo,$qtEstoque,$vlUnitAnterior,
                                    $itCodigoMedia, $qtEstoqueMedia, $vlUnitMedia,
                                    $mediaCustoId=0,$memoriaCalculo='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $hoje = date('Y-m-d');
    $agora = date('Y-m-d H:i:s');
    $dtHrCusto = $agora;
    $dtReferencia = $hoje;
    $codTipoCusto = 3;

    $cmd = "insert into pub.item_custos( item_custo_id,
										 dt_hr_custo,
										 vl_unit_novo,
										 dt_referencia,
										 cod_tipo_custo,
										 it_codigo_media,
										 qt_estoque_media,	
										 vl_unit_media,
										 it_codigo,
										 qt_estoque,
										 vl_unit_anterior,
										 cod_situacao,
                                         cod_usuario,
                                         media_custo_id, 
                                         memoria_calculo                            
											)
										 values
										 (pub.seq_item_custos.NEXTVAL,
										 '$dtHrCusto',
										 '$vlUnitNovo',
										 '$dtReferencia',
										 '$codTipoCusto',
										 '$itCodigo',
										 '$qtEstoque',								 
										 '$vlUnitMedia',
										 '$itCodigoMedia',
										 '$qtEstoqueMedia',
										 '$vlUnitAnterior',
										 '2',
										  '$this->sc_temp_usr_login',
										  $mediaCustoId,
										  '$memoriaCalculo')";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getContainerItemCusto($itemCustoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = 0;
    $aDados = $this->getDados('unico','pub.item_custos item_custo','versao.container_id as container',
        "item_custo.item_custo_id = $itemCustoId ",'espec',
        ' inner join pub.item_container_custos it_container_custos 
                 on it_container_custos.item_custo_id = item_custo.item_custo_id
                inner join pub.versoes_item_custo_container versao on versao.versao_id = it_container_custos.versao_id');
    if(is_array($aDados)){
        $container = $aDados[0]['container'];
    }
    return $container;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getItensCustoContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $lista = '';
    $aDados = $this->getDados('unico','pub.item_custos item_custo',
        'item_custo.item_custo_id  as id',
        "versao.container_id = $container ",'espec',
        ' inner join pub.item_container_custos it_container_custos 
                 on it_container_custos.item_custo_id = item_custo.item_custo_id
                inner join pub.versoes_item_custo_container versao on versao.versao_id = it_container_custos.versao_id');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i<$tam;$i++){
            $idCusto = $aDados[$i]['id'];
            $lista = $this->util_incr_valor($lista,$idCusto);
        }
    }
    return $lista;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaIdsUltCusto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaIds = '';
    $aDados = $this->getDados('multi','pub.item_custos',
        'max(item_custo_id) as item_custo_id,it_codigo',
        "1=1 group by it_codigo","espec");
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $itemCustoId = $aDados[$i]['item_custo_id'];
            $listaIds = $this->util_incr_valor($listaIds,$itemCustoId,",","true");
        }
    }
    return $listaIds;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getQtItensMediaId($mediaId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $qt = 0;
    $aReg = $this->getReg('espec','item_custos','media_custo_id',
        $mediaId,'count(item_custo_id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesaLogImpostoOuCalc($despesaId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesaDescr($despesaId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = '';
    $aRetorno = $this->retornoSimplesTb01('pub.despesas','descricao'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["descricao"];
    return $retorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesasImposto($imposto_id,$empresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.despesas_impostos", "despesa_id", " empresa_id = $empresa and imposto_id = $imposto_id","espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIdsRelacDespCalculadas($despesa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescMotivosDesconto($motivo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $this->descricao = '';
    $tabela   = "pub.motivos_desconto";
    $campos   = 'descricao';
    $condicao = " motivo_desconto_id = $motivo";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $this->descricao = $aRetorno[0]['descricao'];
    }
    return $this->descricao;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarDespesaProcCompra($proc_compra_id, $despesa_id, $valor, $calc_id = 0 )
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.despesas_proc_compra(despesa_proc_compra_id,proc_compra_id, despesa_id,vl_prev,calc_imp_proc_compra_id) 
	        values(pub.seq_despesas_proc_compra.NEXTVAL, 
			       $proc_compra_id,
			       $despesa_id,
				   $valor,
				   $calc_id)";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarDespesasProcCompra($proc_compra_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $empresa  = $this->buscarEmpProcCompra($proc_compra_id);
    $aRetorno = $this->buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId = $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao = $aRetorno[$i]['emp_desp.vl_padrao'];
            $this->criarDespesaProcCompra($proc_compra_id, $despesaId, $valorPadrao);
        }
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularImpostosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $novoCalculo = $this->criarCalculoImpProcCompra();

    $empresa     = $this->buscarEmpProcCompra($procCompraIdParam);
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularImposto($proc_compra_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = $this->buscarEmpProcCompra($proc_compra_id);
    }

    $vlTribItens = $this->buscarVlTribItens($proc_compra_id);
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarCalculoImpProcCompra($usuario_id = 0 )
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_proc_compra ", " max(calc_imp_proc_compra_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) { $_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarCalcImpProcCompra($proc_compra_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra','despesa_proc_compra_id',
                                   " proc_compra_id = $proc_compra_id and despesa_id = $despesa and
								     calc_imp_proc_compra_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;



$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCalculoImposto($novoCalculo,$proc_compra_id,	$imposto,$vlImposto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    else{
        $this->criarDespesaProcCompra($proc_compra_id,$imposto, $vlImposto, $novoCalculo );
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotDespesasProcCompra($procCompraID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $vlTot = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra', 'sum(vl_prev) as tot'," proc_compra_id = $procCompraID ","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesasEmp($empresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = array();

    $aRetorno = $this->retornoMultReg('pub.empresas_despesa emp_desp INNER JOIN pub.despesas desp
                               ON emp_desp.despesa_id = desp.despesa_id',
        'emp_desp.despesa_id, emp_desp.vl_padrao, desp.perc_calculo',
        " emp_desp.log_ativo = 1 and desp.log_imposto = 0
							  and emp_desp.empresa_id = $empresa","espec");

    return $aRetorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarImpostosEmpresa($empresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id, pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 
        and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 
        and pub.empresas_despesa.empresa_id = $empresa and pub.despesas.log_calc_por_item = 0","espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarImpostoPerc($despesa,$empresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarImpostoPercCusto($despesaID,$empresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosEmpresaDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarcodEmpresa($codigo,$sistOrigem,$sistDestino)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getEstabEms5($estab)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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



$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($percCalc <> 0){
        $logManual = 0;
    }else{
        $logManual = 1;
    }
    $cmd = " insert into pub.despesas_container
     (despesa_container_id,despesa_id,container_id,vl_prev,calc_imp_container_id,vl_negociado,vl_proforma,
     cta_corren_custo_distr_id,memoria_calculo,perc_calc,log_manual,item_container_id) 
     values(pub.seq_despesas_container.NEXTVAL,$despId,$this->container_id,'$vl_prev',$calc_imp_container_id,$vl_negociado,
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }else{
        $retorno = 'Campos não informados';
    }
    return $retorno;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $id;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_cod_usuario_corrente)) {$this->sc_temp_cod_usuario_corrente = (isset($_SESSION['cod_usuario_corrente'])) ? $_SESSION['cod_usuario_corrente'] : "";}
  
    if($usuario_id == 0){
        if(isset($this->sc_temp_cod_usuario_corrente) && $this->sc_temp_cod_usuario_corrente != ''){
            $usuario_id = $this->sc_temp_cod_usuario_corrente;
        }
    }

    $cmd = "insert into pub.calcs_imp_container(calc_imp_container_id,dt_hr_calculo,usuario_id,desc_memoria_calc, container_id) values(pub.seq_calcs_imp_container.NEXTVAL,now(),$usuario_id,'',$this->container_id)";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_container ", " max(calc_imp_container_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) { $_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $this->container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
     
    $condicao = "container_id = $this->container_id and despesa_id = $imposto";

    
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

    $this->sincrDespesaContainer($this->container_id,$imposto,$vlImposto,$novoCalculo,$vlImpostoNegociado,$vlImpostoProforma);
    

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $despesaId = $this->buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $vlDespesa= 0;
    $dolarImp = 0;
    $vlPrev   = 0;
    $vlImp    = 0;
    $descrImposto = $this->buscarDespesaDescr($imposto);
    $mem_calc = "<h1>Cálculo Imposto: $descrImposto <h1>";

    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = $this->buscarEmpContainer($this->container_id);
    }

    $vlTribItens = $this->buscarTotCustoPrevDolarContainer($this->container_id,'tributado');
    $vlTribItensProforma  =	$this->buscarTotCustoPrevDolarContainer($this->container_id,'proforma');
    $vlTribItensNegociado =	$this->buscarTotCustoPrevDolarContainer($this->container_id,'negociado');
    $vlTribNegItens = $this->buscarTotCustoPrevDolarContainer($this->container_id,'trib_neg');

    $vlTribItensNegociado += $vlTribNegItens;

    $aDolar = $this->buscarDolar($this->container_id,'di');

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
                " container_id = $this->container_id and despesa_id = ".$despesaImp,
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    if($idCalculo == ''){
        $novoCalculo = $this->criarCalculoImpContainer($this->container_id);
    }
    else{
        $novoCalculo = 	$idCalculo;
    }


    $empresa     = $this->buscarEmpContainer($this->container_id);
    $aImpostos    = $this->buscarImpostosEmpresa($empresa);
    if(is_array($aImpostos)){
        for($i=0;$i < count($aImpostos);$i++){
            $imposto = $aImpostos[$i]['pub.despesas.despesa_id'];
            $percentual = $aImpostos[$i]['pub.empresas_despesa.percentual'];
            $logCalcImposto = $this->verificarCalcImpContainer($this->container_id,$novoCalculo,$imposto);
            if($logCalcImposto != 1){
                $aVlImposto = $this->calcularImpostoContainer($this->container_id,
                    $imposto,
                    $percentual,
                    $novoCalculo,
                    $empresa);

                $this->atualizarCalculoImpContainer($novoCalculo,$this->container_id,$imposto,$aVlImposto);
            }
        }
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = $this->getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
	echo "<h1>idVal = $valor</h1>";
	return $valor;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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
                form_versoes_item_custo_container_pack_ajax_response();
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescFornecedor($fornecedor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarNomeAbrevFornecedor($fornecedor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $this->descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $this->descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $this->descricao;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor= 1;
    $dataCotacao = '';
    $campoRetorno = '"vl-dolar-venda"';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno,
        "\"nr-container\" = $this->container_id ",'espec');
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ', " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
        $estab = substr($estab,0,1);
        $aRetornoEmpresa  = $this->retornoSimplesTb01('pub.empresas','empresa_id',"cod_emp_ems2 = $estab",'espec');
        if(is_array($aRetornoEmpresa)){
            $empresa = $aRetornoEmpresa[0]['empresa_id'];
        }
    }
    return $empresa;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = $this->getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirVersaoCusto($containerParam,$tipoVersao,$descricao)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    if(isset($this->sc_temp_usr_login)){
        $login = $this->sc_temp_usr_login;
    }else{
        $login = ''; 
    }
    $cmd = "insert into pub.versoes_item_custo_container(versao_id,ind_sit_versao,tipo_versao_id,descricao,
          container_id,dt_hr_versao,cod_usuario)
           values(pub.seq_versao_item_container_custo.NEXTVAL,2,$tipoVersao,'$this->descricao',$containerParam,now(),'$login')";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $id = $this->buscarVlSequenciaEspec('seq_versao_item_container_custo',
        'versoes_item_custo_container');
    $this->gravarVersaoCusto($id);
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gerarAutVersaoCusto($containerParam,$descComplementar)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aReg = $this->getUltVersao();
    if(is_array($aReg)){
        $tipoVersao  =  $aReg[0]['tipo_versao_id'];
        $versaoId    =  $aReg[0]['versao_id'];
        $this->descricao   =  "Versão gerada automaticamente a partir da versão $versaoId $descComplementar";
        $this->inserirVersaoCusto($containerParam,$tipoVersao,$this->descricao);
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getUltVersao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container) ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosVersaoCusto($id,$campos='',$filtroCompl)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoCusto($versaoId,$logSincrImpostos=1,$logDespCalc=1)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = $this->buscarContainerVersaoCusto($versaoId);
    $versaoIncompleta = $this->verificarVersaoCustoIncompleta();
    if($versaoIncompleta <> $versaoId and $versaoIncompleta <> 0){
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Problema:Já existe um outro processo de custo incompleto.<br>
						  É necessário excluir ou reprocessar a versão de Custo: $versaoIncompleta";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Problema:Já existe um outro processo de custo incompleto.<br>
						  É necessário excluir ou reprocessar a versão de Custo: $versaoIncompleta";
 }
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function completarVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = "update pub.versoes_item_custo_container set ind_sit_versao = 2
			where versao_id = $versaoId";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoCustoDadosContainer($versaoId,$container='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
            $this->descricao = $aSituacao[0]['descricao'];
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

    $aValores      		= $this->buscarDescontosCreditosUtiliz($container);
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarContainerVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'container_id';
    $condicao = "versao_id = $versaoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $container;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarVersaoCustoIncompleta()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $versaoId = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'versao_id';
    $condicao = " ind_sit_versao = 1";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $versaoId;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDespesas($versaoId,$container='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDespesas($versaoId,$despesaId,$vlPrev,$vlNegociado,$vlProforma,$vlBaseImp,$calcImpContainerId,$logCusto)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_despesas(versao_id, 
			despesa_id, vl_prev, calc_imp_container_id,log_custo,vl_negociado,vl_proforma,vl_base_imp)
			values($versaoId,$despesaId,$vlPrev,$calcImpContainerId,$logCusto,$vlNegociado,$vlProforma,$vlBaseImp) ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCusto($versaoId,$container='',$logGerarDistrCusto=false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

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


        $aContainerDistr = $this->getVlDistrContainer($container);
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
                $itCodigo 	= $this->buscarCodItemERP($itemProcCompraId);
            }
            else{
                $qtAlocada 		= 0;
                $qtEmb			= 0;
                $qtRecboFisico  = 0;
                $itCodigo		= '';
                $itemProcCompraId = 0;
            }
            $aRetorno = $this->retornarCampoItemProcCompra ( $itemProcCompraId , 'vl_negociado' );
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
                    $aItem = $this->getVlDistrContainer('',$itemContainerId);
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
                $distrCustoID = $this->criarRegDistrCusto($id,0,'Vl.Distribuição de Custo Automático',
                    3,$vlDistrItem);
                $this->criarDespesaDistrCusto($distrCustoID,$vlDistrItem,$itemContainerId);
                
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $id = $this->buscarVlSequenciaEspec('seq_item_container_custos','item_container_custos');
    return $id;
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoCustoNfs($versaoId,$container='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirVersaoCustoNfs($versao,$documento,$serie,$natOperacao,$codEmitente,$vlMercadoria,$vlDespesa)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_nfs(versao_id, documento, serie, nat_operacao,cod_emitente,vl_mercadoria,
			vl_despesa)
			values($versao,'$documento','$serie','$natOperacao',$codEmitente,'$vlMercadoria','$vlDespesa') ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoPagtos($versaoId,$container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirVersaoCustoPagtos($versao,$numIdTitAp,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_pgtos(versao_id,num_id_tit_ap,vl_real,vl_dolar)
			values($versao,$numIdTitAp,'$vlReal','$vlDolar') ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarContainerVersao($versaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela 	= 'pub.versoes_item_custo_container';
    $campo  	= 'container_id';
    $condicao	= "versao_id = $versaoId";
    $aRetorno   = $this->retornoSimplesTb01($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $container = $aRetorno[0][$campo];
    }
    return $container;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDadosUltVersaoCustoContainer($container,$itemContainerId='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDataUltVersaoCustoContainer($containerParam)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarUltVersaoCustoContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $versao = 0;
    $tabela = 'pub.versoes_item_custo_container';
    $campos =  'select max(versao.versao_id) as ult';
    $condicao = " versao.container_id = $container ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $versao = $aRetorno[0]['ult'];
    }
    return $versao;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getDadosVersaoCorrenteContainer($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container
                where container_id = $container)
                ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotDistrItemCustoContainer($itemContainer)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $tot = 0;
    $tabela = 'pub.item_container_custos';
    $campos =  'sum(vl_custo_distribuido) as tot';
    $condicao = " item_container_id = $itemContainer ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $tot = $aRetorno[0]['tot'];
    }
    return $tot;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDescontos($versaoId,$container='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_descontos(versao_id, 
			desconto_importacao_id, vl_autoriz_real,vl_autoriz_dolar)values($versaoId,$descontoId,$vlReal,$vlDolar) ";
    
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDadosDescontos($descontoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $tabela   = "pub.descontos_importacao";
    $campos   = 'motivo_desconto_id, descricao, log_credito, cod_tipo, dt_autorizacao, fornecedor_id';
    $condicao = " desconto_importacao_id = $descontoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlsDescontosPorFornecedor($fornecedor=0 )
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescontosUtiliz($container,$itemContainerId='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescontosCreditosUtiliz($container){
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarVlAprovadoEmReal($vlReal,$vlRealAutoriz)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlRealAutoriz > $vlReal){
        $erro = 'ERRO.O Valor Aprovado em Real não pode ser maior que o Valor Solicitado em Real';
    }
    return $erro;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarVlAprovadoEmDolar($vlDolar,$vlDolarAutoriz)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlDolarAutoriz > $vlDolar){
        $erro = 'ERRO. O Valor Aprovado em Dólar não pode ser maior que o Valor Solicitado em Dólar';
    }
    return $erro;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarVlsAutorizacao($vlDolarAutoriz, $vlRealAutoriz, $dtAutoriz)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlSaldoUtilizar($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = 0;
    $vlDolar = $this->buscarVlDolarAutorizDesconto($descontoImportacaoId);
    $vlUtilizado = $this->buscarDescontoTotalUtilizado($descontoImportacaoId);
    $retorno = $vlDolar - $vlUtilizado;

    return $retorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDescontoTotalUtilizado($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
     $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.cta_corren_desconto ',
                                   ' sum(valor_utilizado) as valor ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["valor"];
    return $retorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarVlDolarAutorizDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
                                   ' vl_dolar_autorizado ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["vl_dolar_autorizado"];

    return $retorno;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarFornecDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
        ' fornecedor_id ',
        " desconto_importacao_id = $descontoImportacaoId ", 'espec');
    if (is_array($aRetorno))
        $retorno = $aRetorno[0]["fornecedor_id"];

    return $retorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVlDescAutorizado($fornecedor)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarValoresNFs($estab,$documento,$serie,$natOperacao,$codEmitente)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarNfAssociadasContainer($nrContainer)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.nfs_container","documento, serie, estab, nat_operacao, cod_emitente", "container_id = $nrContainer",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01("pub.nfs_container",
        "documento, serie, estab, nat_operacao, cod_emitente",
        "container_id = $nrContainer and substring(nat_operacao,1,1) ='3'",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDtEmisNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarQtRecContainer($containerId,$item)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarNfsPorEmbarque($nrEmbarque)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    




$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespesasRealizadas($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    

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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarValoresItensNFImp($containerId,$item = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarDespRealizadasItens($containerId,$item='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCustoCOFINSNFMae($container,$item='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarCustoPISNFMae($container, $item = '')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotTribContainer($container,$tipo='tributado')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotDifImp($container, $tipo,$tipoComp)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $vlTipo = $this->buscarTotTribContainer($container,$tipo);
    $vlTipoComp = $this->buscarTotTribContainer($container,$tipoComp);
    $vlSaldoDistr = $vlTipo - $vlTipoComp;
    return $vlSaldoDistr;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeVarLoginSessao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return "glo_usr_login";

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeVarPercParComis()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return "perc_participacao_comis";

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeVarTodosCliente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return "log_todos_cliente";

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCamposUsuario()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return  'priv_admin,ativo,nome,email,"tp-usuario" as tp_usuario,usuario,
		"nome-ab-cli" as nome_ab_cli,login,usuario,log_pedido_on_line,
                 log_aprovador,id,perc_participacao_comis,log_todos_clientes';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function validarLogin($login,$pswd)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $login = $this->retirarAcentoSimples($login);
    $erro = '';
    $slogin = $this->Db->qstr($login);
    $spswd  = $this->Db->qstr($pswd);
    $logSetarVariaveis = false;
    $campos = $this->getCamposUsuario();
    $slogin = str_replace("'","",$slogin);
    $spswd  = str_replace("'","",$spswd);

    $aUsuario = $this->getDadosUserWeb($slogin,$campos," senha = '$spswd' ");
    $vendLoja = 0;
    if(! is_array($aUsuario)){
        $this->NM_gera_log_insert("User", 'login Falhou', "Falhou a tentativa de logar com o login:$login");
        $erro = 'Informe um usuário e uma senha válida ';
    }else{
        $reg = $aUsuario[0];
        $ativo              = $reg['ativo'];
        if($ativo <> 1){
            $erro = "Usuário Inativo";
        }
    }
    return array('array'=>$aUsuario,'erro'=>$erro);
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getVarSessao($varParam,$logEscopoApl=false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = getNomeVarSessaoComApl($varParam);
    }

    if(isset($_SESSION[$varParam])){
        $retParam =  $_SESSION[$varParam];
    }else{
        $retParam = '';
    }
    return $retParam;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function setarVarsLogin($aUsuario)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

    setVarSessao($this->getParamVendLoja(),$vendLoja);
    setVarSessao('id_usuario',$idUsuario);
    setVarSessao($this->getNomeVarPercParComis(),$percPartComis);
    setVarSessao($this->getNomeVarTodosCliente(),$logTodosCliente);




$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function logar($login,$pswd)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLogin($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
      $this->setarVarsLogin($aUsuario);
      $this->atualizarParametros();
    }

	return $erro;


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getNomeRepresSessao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $nomeRepresIni = $this->getVarSessao('glo_nomeRepresIni');
    if($nomeRepresIni == ''){
        $nomeRepresFim = 'zzzzzzzzzzzzzzzz';
    }else{
        $nomeRepresFim = $nomeRepresIni;
    }
    $aRetorno = array('nome_repres_ini' => $nomeRepresIni, 'nome_repres_fim' => $nomeRepresFim);
    return  $aRetorno;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function aplicarPermissoesSC($login)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  



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
        $this->NM_gera_log_insert("User", 'login', "Login OK");
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function limparLogin($logLimparPerfilPai=false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
if (!isset($this->sc_temp_inicio_sessao)) {$this->sc_temp_inicio_sessao = (isset($_SESSION['inicio_sessao'])) ? $_SESSION['inicio_sessao'] : "";}
if (!isset($this->sc_temp_aplicacaoPrincipal)) {$this->sc_temp_aplicacaoPrincipal = (isset($_SESSION['aplicacaoPrincipal'])) ? $_SESSION['aplicacaoPrincipal'] : "";}
if (!isset($this->sc_temp_tipoUsuario)) {$this->sc_temp_tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";}
if (!isset($this->sc_temp_prepostoFim)) {$this->sc_temp_prepostoFim = (isset($_SESSION['prepostoFim'])) ? $_SESSION['prepostoFim'] : "";}
if (!isset($this->sc_temp_prepostoIni)) {$this->sc_temp_prepostoIni = (isset($_SESSION['prepostoIni'])) ? $_SESSION['prepostoIni'] : "";}
if (!isset($this->sc_temp_codRepFim)) {$this->sc_temp_codRepFim = (isset($_SESSION['codRepFim'])) ? $_SESSION['codRepFim'] : "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
if (!isset($this->sc_temp_nomeRepresFim)) {$this->sc_temp_nomeRepresFim = (isset($_SESSION['nomeRepresFim'])) ? $_SESSION['nomeRepresFim'] : "";}
if (!isset($this->sc_temp_nomeRepresIni)) {$this->sc_temp_nomeRepresIni = (isset($_SESSION['nomeRepresIni'])) ? $_SESSION['nomeRepresIni'] : "";}
if (!isset($this->sc_temp_nomeClienteFim)) {$this->sc_temp_nomeClienteFim = (isset($_SESSION['nomeClienteFim'])) ? $_SESSION['nomeClienteFim'] : "";}
if (!isset($this->sc_temp_nomeClienteIni)) {$this->sc_temp_nomeClienteIni = (isset($_SESSION['nomeClienteIni'])) ? $_SESSION['nomeClienteIni'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
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
    $listaVar = $this->util_incr_valor($listaVar,$this->getParamVendLoja()) ;
    $listaVar = $this->util_incr_valor($listaVar,getNomeVarIndFinan()) ;
    $listaVar = $this->util_incr_valor($listaVar,'lista_cps_definida') ;
    $this->limparListaCpsSessao();
    limparVarSessao($listaVar);
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_nomeClienteIni)) { $_SESSION['nomeClienteIni'] = $this->sc_temp_nomeClienteIni;}
if (isset($this->sc_temp_nomeClienteFim)) { $_SESSION['nomeClienteFim'] = $this->sc_temp_nomeClienteFim;}
if (isset($this->sc_temp_nomeRepresIni)) { $_SESSION['nomeRepresIni'] = $this->sc_temp_nomeRepresIni;}
if (isset($this->sc_temp_nomeRepresFim)) { $_SESSION['nomeRepresFim'] = $this->sc_temp_nomeRepresFim;}
if (isset($this->sc_temp_codRepIni)) { $_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
if (isset($this->sc_temp_codRepFim)) { $_SESSION['codRepFim'] = $this->sc_temp_codRepFim;}
if (isset($this->sc_temp_prepostoIni)) { $_SESSION['prepostoIni'] = $this->sc_temp_prepostoIni;}
if (isset($this->sc_temp_prepostoFim)) { $_SESSION['prepostoFim'] = $this->sc_temp_prepostoFim;}
if (isset($this->sc_temp_tipoUsuario)) { $_SESSION['tipoUsuario'] = $this->sc_temp_tipoUsuario;}
if (isset($this->sc_temp_aplicacaoPrincipal)) { $_SESSION['aplicacaoPrincipal'] = $this->sc_temp_aplicacaoPrincipal;}
if (isset($this->sc_temp_inicio_sessao)) { $_SESSION['inicio_sessao'] = $this->sc_temp_inicio_sessao;}
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function inicioAplicacao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getLoginCorrente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarLoginSessao());


$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getPercPartComisCorrente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarPercParComis());

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getTodosClienteCorrente()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTodosCliente());

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function limparListaCpsSessao()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $aLista =$this->getVarSessao('lista_cps_definida');
    if(is_array($aLista)){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $variavel = $aLista[$i];
            unset($_SESSION[$variavel]);
        }
    }

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verifUsuarioCorrenteAdmin()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $log= 0;

    $tipo = $this->getTipoUsuarioCorrente();
    if($tipo <> 2 and $tipo <> 5){
        $log = 1;
    }
    return $log;

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function logarLDAP($usuario,$senha,$servidor='192.168.0.61',$dominio='IMA',$porta=389)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $ldapconn = ldap_connect("ldap://{$servidor}:{$porta}") ;

    if ($ldapconn) {
        $ldapbind = ldap_bind($ldapconn, "{$dominio}\\{$usuario}", $senha);
        if ($ldapbind) {
            return 'logado';
        }
        ldap_close($ldapconn);

    }
    return '';

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function verificarParamProForma($param)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    $valorParam = $this->buscarParametroIma($param);
    if($param = $valorParam){
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Este Tipo de Anexo está informado no parametro(tabela im-param) de Pró-Forma 
						e por isto não pode ser excluido';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_versoes_item_custo_container';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Este Tipo de Anexo está informado no parametro(tabela im-param) de Pró-Forma 
						e por isto não pode ser excluido';
 }
;
    }
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
        $dtEmisDocto = $this->buscarDtEmisNotaMaeContainer($this->sc_temp_container_corrente);
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
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
                form_versoes_item_custo_container_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_versoes_item_custo_container']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_versoes_item_custo_container_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_versoes_item_custo_container_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("versao_id", "dt_hr_versao", "cod_usuario", "tipo_versao_custo_id", "descricao", "ind_sit_versao", "vl_dolar_compra", "vl_desconto_utiliz_dolar", "vl_desconto_utiliz_real"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


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

   function Form_lookup_tipo_versao_id()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'] = array(); 
    }

   $old_value_versao_id = $this->versao_id;
   $old_value_dt_hr_versao = $this->dt_hr_versao;
   $old_value_dt_hr_versao_hora = $this->dt_hr_versao_hora;
   $old_value_container_id = $this->container_id;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_versao_id = $this->versao_id;
   $unformatted_value_dt_hr_versao = $this->dt_hr_versao;
   $unformatted_value_dt_hr_versao_hora = $this->dt_hr_versao_hora;
   $unformatted_value_container_id = $this->container_id;

   $nm_comando = "SELECT tipo_versao_custo_id, descricao  FROM PUB.tipos_versao_custo  ORDER BY descricao";

   $this->versao_id = $old_value_versao_id;
   $this->dt_hr_versao = $old_value_dt_hr_versao;
   $this->dt_hr_versao_hora = $old_value_dt_hr_versao_hora;
   $this->container_id = $old_value_container_id;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['Lookup_tipo_versao_id'][] = $rs->fields[0];
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
   function Form_lookup_ind_sit_versao()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Incompleto?#?1?#?S?@?";
       $nmgp_def_dados .= "Completo?#?2?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_versoes_item_custo_container_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "versao_id") 
          {
              $this->SC_monta_condicao($comando, "versao_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_hr_versao") 
          {
              $this->SC_monta_condicao($comando, "dt_hr_versao", $arg_search, $data_search, "CHARACTER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cod_usuario") 
          {
              $this->SC_monta_condicao($comando, "cod_usuario", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "descricao") 
          {
              $this->SC_monta_condicao($comando, "descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "ind_sit_versao") 
          {
              $data_lookup = $this->SC_lookup_ind_sit_versao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "ind_sit_versao", $arg_search, $data_lookup, "INTEGER", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "vl_dolar_compra") 
          {
              $this->SC_monta_condicao($comando, "vl_dolar_compra", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "vl_desconto_utiliz_dolar") 
          {
              $this->SC_monta_condicao($comando, "vl_desconto_utiliz_dolar", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "vl_desconto_utiliz_real") 
          {
              $this->SC_monta_condicao($comando, "vl_desconto_utiliz_real", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_versoes_item_custo_container = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] = $qt_geral_reg_form_versoes_item_custo_container;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_versoes_item_custo_container_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_versoes_item_custo_container_pack_ajax_response();
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
      $nm_numeric[] = "versao_id";$nm_numeric[] = "ind_sit_versao";$nm_numeric[] = "vl_dolar_compra";$nm_numeric[] = "vl_desconto_utiliz_dolar";$nm_numeric[] = "vl_desconto_utiliz_real";$nm_numeric[] = "tipo_versao_id";$nm_numeric[] = "container_id";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['decimal_db'] == ".")
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
   function SC_lookup_ind_sit_versao($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['1'] = "Incompleto";
       $data_look['2'] = "Completo";
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
       $nmgp_saida_form = "form_versoes_item_custo_container_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_versoes_item_custo_container_fim.php";
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
       form_versoes_item_custo_container_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['masterValue']);
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
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           form_versoes_item_custo_container_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       form_versoes_item_custo_container_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
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
    <META http-equiv="Pragma" content="no-cache"/>
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       if ($this->Ini->nm_db_ems5w)
       {
           $this->Ini->nm_db_ems5w->Close();
       }
       if ($this->Ini->nm_db_comumw)
       {
           $this->Ini->nm_db_comumw->Close();
       }
       if ($this->Ini->nm_db_espec)
       {
           $this->Ini->nm_db_espec->Close();
       }
       if ($this->Ini->nm_db_multi)
       {
           $this->Ini->nm_db_multi->Close();
       }
       if ($this->Ini->nm_db_ems5)
       {
           $this->Ini->nm_db_ems5->Close();
       }
       if ($this->Ini->nm_db_ems2ima)
       {
           $this->Ini->nm_db_ems2ima->Close();
       }
       if ($this->Ini->nm_db_ems2med)
       {
           $this->Ini->nm_db_ems2med->Close();
       }
       if ($this->Ini->nm_db_comum)
       {
           $this->Ini->nm_db_comum->Close();
       }
       if ($this->Ini->nm_db_cfsc)
       {
           $this->Ini->nm_db_cfsc->Close();
       }
       if ($this->Ini->nm_db_log_db)
       {
           $this->Ini->nm_db_log_db->Close();
       }
       if ($this->Ini->nm_db_ticontrole2)
       {
           $this->Ini->nm_db_ticontrole2->Close();
       }
       if ($this->Ini->nm_db_ima)
       {
           $this->Ini->nm_db_ima->Close();
       }
       if ($this->Ini->nm_db_med)
       {
           $this->Ini->nm_db_med->Close();
       }
       if ($this->Ini->nm_db_geral)
       {
           $this->Ini->nm_db_geral->Close();
       }
       if ($this->Ini->nm_db_dinamico)
       {
           $this->Ini->nm_db_dinamico->Close();
       }
       if ($this->Ini->nm_db_log_imp_mysql)
       {
           $this->Ini->nm_db_log_imp_mysql->Close();
       }
       exit;
   }
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Versões de Custo Container"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Versões de Custo Container"; } ?> - 
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_versoes_item_custo_container']['ordem_ord'] == " desc") {
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
            case "versao_id":
                return true;
            case "container_id":
                return true;
            case "vl_dolar_compra":
                return true;
            case "vl_desconto_utiliz_dolar":
                return true;
            case "vl_desconto_utiliz_real":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "versao_id":
                return 'desc';
            case "tipo_versao_id":
                return 'desc';
            case "ind_sit_versao":
                return 'desc';
            case "container_id":
                return 'desc';
            case "vl_dolar_compra":
                return 'desc';
            case "vl_desconto_utiliz_dolar":
                return 'desc';
            case "vl_desconto_utiliz_real":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
