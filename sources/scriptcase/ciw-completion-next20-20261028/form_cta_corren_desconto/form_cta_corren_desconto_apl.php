<?php
//
class form_cta_corren_desconto_apl
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
   var $cta_corren_desconto_id;
   var $desconto_importacao_id;
   var $container_id;
   var $valor_utilizado;
   var $data;
   var $cod_usuario;
   var $valor_a_utilizar;
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
          if (isset($this->NM_ajax_info['param']['cta_corren_desconto_id']))
          {
              $this->cta_corren_desconto_id = $this->NM_ajax_info['param']['cta_corren_desconto_id'];
          }
          if (isset($this->NM_ajax_info['param']['data']))
          {
              $this->data = $this->NM_ajax_info['param']['data'];
          }
          if (isset($this->NM_ajax_info['param']['desconto_importacao_id']))
          {
              $this->desconto_importacao_id = $this->NM_ajax_info['param']['desconto_importacao_id'];
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
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['valor_a_utilizar']))
          {
              $this->valor_a_utilizar = $this->NM_ajax_info['param']['valor_a_utilizar'];
          }
          if (isset($this->NM_ajax_info['param']['valor_utilizado']))
          {
              $this->valor_utilizado = $this->NM_ajax_info['param']['valor_utilizado'];
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
      if (isset($this->desconto_importacao_id_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['desconto_importacao_id_corrente'] = $this->desconto_importacao_id_corrente;
      }
      if (isset($this->container_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->vl_a_utilizar) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vl_a_utilizar'] = $this->vl_a_utilizar;
      }
      if (isset($_POST["desconto_importacao_id_corrente"]) && isset($this->desconto_importacao_id_corrente)) 
      {
          $_SESSION['desconto_importacao_id_corrente'] = $this->desconto_importacao_id_corrente;
      }
      if (isset($_POST["container_corrente"]) && isset($this->container_corrente)) 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($_GET["desconto_importacao_id_corrente"]) && isset($this->desconto_importacao_id_corrente)) 
      {
          $_SESSION['desconto_importacao_id_corrente'] = $this->desconto_importacao_id_corrente;
      }
      if (isset($_GET["container_corrente"]) && isset($this->container_corrente)) 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['embutida_parms']);
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
                 nm_limpa_str_form_cta_corren_desconto($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->desconto_importacao_id_corrente)) 
          {
              $_SESSION['desconto_importacao_id_corrente'] = $this->desconto_importacao_id_corrente;
          }
          if (isset($this->container_corrente)) 
          {
              $_SESSION['container_corrente'] = $this->container_corrente;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['opc_ant']);
          }
          if (isset($this->desconto_importacao_id_corrente)) 
          {
              $_SESSION['desconto_importacao_id_corrente'] = $this->desconto_importacao_id_corrente;
          }
          if (isset($this->container_corrente)) 
          {
              $_SESSION['container_corrente'] = $this->container_corrente;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_cta_corren_desconto_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_cta_corren_desconto']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_cta_corren_desconto']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_cta_corren_desconto'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cta_corren_desconto']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cta_corren_desconto']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_cta_corren_desconto') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cta_corren_desconto']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Utilização do Desconto";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_cta_corren_desconto")
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
      $this->nm_new_label['cta_corren_desconto_id'] = '' . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cta_corren_desconto_id'] . '';
      $this->nm_new_label['desconto_importacao_id'] = '' . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_desconto_importacao_id'] . '';
      $this->nm_new_label['container_id'] = '' . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_container_id'] . '';
      $this->nm_new_label['data'] = '' . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_data'] . '';
      $this->nm_new_label['cod_usuario'] = '' . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cod_usuario'] . '';

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


      $_SESSION['scriptcase']['error_icon']['form_cta_corren_desconto']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_cta_corren_desconto'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto']      = 'on';
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cta_corren_desconto']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_cta_corren_desconto'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_cta_corren_desconto'];

              if (!$tmpDashboardButtons['form_navigate']) { 
                  $this->nmgp_botoes['first']   = 'off';
                  $this->nmgp_botoes['back']    = 'off';
                  $this->nmgp_botoes['last']    = 'off';
                  $this->nmgp_botoes['forward'] = 'off';
              }
              if (!$tmpDashboardButtons['form_update'])    { $this->nmgp_botoes['update']    = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['new']       = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['insert']    = 'off';}
              if (!$tmpDashboardButtons['form_delete'])    { $this->nmgp_botoes['delete']    = 'off';}
              if (!$tmpDashboardButtons['form_copy'])      { $this->nmgp_botoes['copy']      = 'off';}
              if (!$tmpDashboardButtons['form_navpage'])   { $this->nmgp_botoes['navpage']   = 'off';}
              if (!$tmpDashboardButtons['form_goto'])      { $this->nmgp_botoes['goto']      = 'off';}
              if (!$tmpDashboardButtons['form_lineqty'])   { $this->nmgp_botoes['qtline']    = 'off';}
              if (!$tmpDashboardButtons['form_summary'])   { $this->nmgp_botoes['summary']   = 'off';}
              if (!$tmpDashboardButtons['form_qsearch'])   { $this->nmgp_botoes['qsearch']   = 'off';}
              if (!$tmpDashboardButtons['form_dynsearch']) { $this->nmgp_botoes['dynsearch'] = 'off';}
              if (!$tmpDashboardButtons['form_reload'])    { $this->nmgp_botoes['reload']    = 'off';}
          }
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form'];
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['valor_a_utilizar'] != "null"){$this->valor_a_utilizar = $this->nmgp_dados_form['valor_a_utilizar'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_cta_corren_desconto", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'form_cta_corren_desconto/form_cta_corren_desconto_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_cta_corren_desconto_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_cta_corren_desconto_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_cta_corren_desconto_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_cta_corren_desconto/form_cta_corren_desconto_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_cta_corren_desconto_erro.class.php"); 
      }
      $this->Erro      = new form_cta_corren_desconto_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao']))
         { 
             if ($this->cta_corren_desconto_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_cta_corren_desconto']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['bt_log'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['bt_log'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['botoes']['bt_log'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form'];
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
      
/*----- Scriptcase Locale: Event onScriptinit ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  $this->sc_temp_usr_login = $this->getLoginCorrente();
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onScriptinit ------*/
 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_cta_corren_desconto']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_cta_corren_desconto']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_cta_corren_desconto']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_cta_corren_desconto']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->cta_corren_desconto_id)) { $this->nm_limpa_alfa($this->cta_corren_desconto_id); }
      if (isset($this->desconto_importacao_id)) { $this->nm_limpa_alfa($this->desconto_importacao_id); }
      if (isset($this->container_id)) { $this->nm_limpa_alfa($this->container_id); }
      if (isset($this->valor_utilizado)) { $this->nm_limpa_alfa($this->valor_utilizado); }
      if (isset($nm_opc_lookup) && $nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "container_id")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->container_id = $array_vars[0];
              $container_id       = $this->container_id;
              nm_limpa_numero($container_id, $this->field_config['container_id']['symbol_grp']); 
              $this->container_id       = $container_id;
              $this->lookup_container_id($conteudo);
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- cta_corren_desconto_id
      $this->field_config['cta_corren_desconto_id']               = array();
      $this->field_config['cta_corren_desconto_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cta_corren_desconto_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cta_corren_desconto_id']['symbol_dec'] = '';
      $this->field_config['cta_corren_desconto_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cta_corren_desconto_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- desconto_importacao_id
      $this->field_config['desconto_importacao_id']               = array();
      $this->field_config['desconto_importacao_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['desconto_importacao_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['desconto_importacao_id']['symbol_dec'] = '';
      $this->field_config['desconto_importacao_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['desconto_importacao_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- container_id
      $this->field_config['container_id']               = array();
      $this->field_config['container_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['container_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['container_id']['symbol_dec'] = '';
      $this->field_config['container_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['container_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valor_utilizado
      $this->field_config['valor_utilizado']               = array();
      $this->field_config['valor_utilizado']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valor_utilizado']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valor_utilizado']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valor_utilizado']['symbol_mon'] = '';
      $this->field_config['valor_utilizado']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valor_utilizado']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valor_a_utilizar
      $this->field_config['valor_a_utilizar']               = array();
      $this->field_config['valor_a_utilizar']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['valor_a_utilizar']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['valor_a_utilizar']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['valor_a_utilizar']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['valor_a_utilizar']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- data
      $this->field_config['data']                 = array();
      $this->field_config['data']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['data']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['data']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'data');
      //-- cod_usuario
      $this->field_config['cod_usuario']                 = array();
      $this->field_config['cod_usuario']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['cod_usuario']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['cod_usuario']['date_display'] = "";
      $this->new_date_format('DT', 'cod_usuario');
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['Gera_log_access'] = false;
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
          $this->valor_a_utilizar = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['valor_a_utilizar'];
      if ('' !== $this->valor_a_utilizar || (!empty($format_fields) && isset($format_fields['valor_a_utilizar'])))
      {
          nmgp_Form_Num_Val($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_grp'], $this->field_config['valor_a_utilizar']['symbol_dec'], "2", "S", $this->field_config['valor_a_utilizar']['format_neg'], "", "", "-", $this->field_config['valor_a_utilizar']['symbol_fmt']) ; 
      }
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->container_id = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['container_id'];
      if ('' !== $this->container_id || (!empty($format_fields) && isset($format_fields['container_id'])))
      {
          nmgp_Form_Num_Val($this->container_id, $this->field_config['container_id']['symbol_grp'], $this->field_config['container_id']['symbol_dec'], "0", "S", $this->field_config['container_id']['format_neg'], "", "", "-", $this->field_config['container_id']['symbol_fmt']) ; 
      }
          $this->valor_utilizado = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['valor_utilizado'];
      if ('' !== $this->valor_utilizado || (!empty($format_fields) && isset($format_fields['valor_utilizado'])))
      {
          nmgp_Form_Num_Val($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_dec'], "2", "S", $this->field_config['valor_utilizado']['format_neg'], "", "", "-", $this->field_config['valor_utilizado']['symbol_fmt']) ; 
      }
          $this->valor_a_utilizar = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['valor_a_utilizar'];
      if ('' !== $this->valor_a_utilizar || (!empty($format_fields) && isset($format_fields['valor_a_utilizar'])))
      {
          nmgp_Form_Num_Val($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_grp'], $this->field_config['valor_a_utilizar']['symbol_dec'], "2", "S", $this->field_config['valor_a_utilizar']['format_neg'], "", "", "-", $this->field_config['valor_a_utilizar']['symbol_fmt']) ; 
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
          if ('validate_cta_corren_desconto_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cta_corren_desconto_id');
          }
          if ('validate_desconto_importacao_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'desconto_importacao_id');
          }
          if ('validate_container_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'container_id');
          }
          if ('validate_valor_utilizado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valor_utilizado');
          }
          if ('validate_valor_a_utilizar' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valor_a_utilizar');
          }
          if ('validate_data' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'data');
          }
          if ('validate_cod_usuario' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_usuario');
          }
          form_cta_corren_desconto_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['container_id']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->container_id = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['container_id'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['valor_utilizado']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->valor_utilizado = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['valor_utilizado'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['valor_a_utilizar']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->valor_a_utilizar = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']['valor_a_utilizar'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_cta_corren_desconto_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_cta_corren_desconto_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_atualiz'] == "ok")
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
          form_cta_corren_desconto_pack_ajax_response();
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
          form_cta_corren_desconto_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_cta_corren_desconto.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Utilização do Desconto") ?></TITLE>
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
<form name="Fdown" method="get" action="form_cta_corren_desconto_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_cta_corren_desconto"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cta_corren_desconto', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cta_corren_desconto', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cta_corren_desconto', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_cta_corren_desconto_pack_ajax_response();
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
           $this->Ini->nm_db_log_imp_mysql->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function lookup_container_id(&$conteudo, $validate=false)
   {
      global  $container_id;
      $guarda_formatado = $this->formatado;
      if (!$validate)
      {
          $this->nm_tira_formatacao();
      }
      if (!$validate)
      {
          $Salva_opc = $this->nmgp_opcao;
          $this->nmgp_opcao = "lookup_rpc";
          $this->nm_converte_datas();
          $this->nmgp_opcao = $Salva_opc;
      }
      if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT \"nome-ab-forn\" 
FROM PUB.\"pp-container\" 
WHERE \"nr-container\" = $this->container_id 
ORDER BY \"nome-ab-forn\""; 
      if ($this->container_id == "")
      { 
          $conteudo = ""; 
          if (!$validate)
          {
              $this->nm_formatar_campos();
          }
          return; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Ini->nm_db_espec->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : "Container Não Existe ou não pertence ao fornecedor do desconto"; 
          $this->Erro_look_container_id = (isset($rs->fields[0])) ? "" : "Container Não Existe ou não pertence ao fornecedor do desconto"; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_espec->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      if (!$validate)
      {
          foreach ($this->Before_unformat as $Cmp => $Val)
          {
              $this->$Cmp = $Val;
              $this->formatado = $guarda_formatado;
          }
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
include_once("form_cta_corren_desconto_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->cta_corren_desconto_id) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['cta_corren_desconto_id']))
          {
              $varloc_btn_php['cta_corren_desconto_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form']['cta_corren_desconto_id'];
          }
      }
      $nm_f_saida = "./";
      nm_limpa_numero($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp']) ; 
      nm_limpa_numero($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp']) ; 
      nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      if (!empty($this->field_config['valor_utilizado']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_mon']); 
          nm_limpa_valor($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valor_a_utilizar']['symbol_dec']))
      {
          nm_limpa_valor($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_dec'], $this->field_config['valor_a_utilizar']['symbol_grp']) ; 
      }
      nm_limpa_data($this->data, $this->field_config['data']['date_sep']) ; 
      nm_limpa_data($this->cod_usuario, $this->field_config['cod_usuario']['date_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button bt_log ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  $aplCorrente = $this->Ini->nm_cod_apl;
header("Location:..\ctrl_tipo_log\ctrl_tipo_log.php?apl_corrente=$aplCorrente&id_chave=$this->cta_corren_desconto_id ");
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button bt_log ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="cta_corren_desconto_id" value="<?php echo $this->form_encode_input($this->cta_corren_desconto_id) ?>"/>
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
           case 'cta_corren_desconto_id':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cta_corren_desconto_id'] . "";
               break;
           case 'desconto_importacao_id':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_desconto_importacao_id'] . "";
               break;
           case 'container_id':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_container_id'] . "";
               break;
           case 'valor_utilizado':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_valor_utilizado'] . "(Dólar)";
               break;
           case 'valor_a_utilizar':
               return "Vl. a Utilizar(Dólar)";
               break;
           case 'data':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_data'] . "";
               break;
           case 'cod_usuario':
               return "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cod_usuario'] . "";
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
      if ((!is_array($filtro) && ('' == $filtro || 'cta_corren_desconto_id' == $filtro)) || (is_array($filtro) && in_array('cta_corren_desconto_id', $filtro)))
        $this->ValidateField_cta_corren_desconto_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cta_corren_desconto_id";

      if ((!is_array($filtro) && ('' == $filtro || 'desconto_importacao_id' == $filtro)) || (is_array($filtro) && in_array('desconto_importacao_id', $filtro)))
        $this->ValidateField_desconto_importacao_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "desconto_importacao_id";

      if ((!is_array($filtro) && ('' == $filtro || 'container_id' == $filtro)) || (is_array($filtro) && in_array('container_id', $filtro)))
        $this->ValidateField_container_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "container_id";

      if ((!is_array($filtro) && ('' == $filtro || 'valor_utilizado' == $filtro)) || (is_array($filtro) && in_array('valor_utilizado', $filtro)))
        $this->ValidateField_valor_utilizado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valor_utilizado";

      if ((!is_array($filtro) && ('' == $filtro || 'valor_a_utilizar' == $filtro)) || (is_array($filtro) && in_array('valor_a_utilizar', $filtro)))
        $this->ValidateField_valor_a_utilizar($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valor_a_utilizar";

      if ((!is_array($filtro) && ('' == $filtro || 'data' == $filtro)) || (is_array($filtro) && in_array('data', $filtro)))
        $this->ValidateField_data($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "data";

      if ((!is_array($filtro) && ('' == $filtro || 'cod_usuario' == $filtro)) || (is_array($filtro) && in_array('cod_usuario', $filtro)))
        $this->ValidateField_cod_usuario($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_usuario";

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

    function ValidateField_cta_corren_desconto_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cta_corren_desconto_id'])) {
          nm_limpa_numero($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp']) ; 
          return;
      }
      if ($this->cta_corren_desconto_id === "" || is_null($this->cta_corren_desconto_id))  
      { 
          $this->cta_corren_desconto_id = 0;
      } 
      nm_limpa_numero($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_cta_corren_desconto_id' == $this->NM_ajax_opcao)
      { 
          if ($this->cta_corren_desconto_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->cta_corren_desconto_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cta_corren_desconto_id'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['cta_corren_desconto_id']))
                  {
                      $Campos_Erros['cta_corren_desconto_id'] = array();
                  }
                  $Campos_Erros['cta_corren_desconto_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['cta_corren_desconto_id']) || !is_array($this->NM_ajax_info['errList']['cta_corren_desconto_id']))
                  {
                      $this->NM_ajax_info['errList']['cta_corren_desconto_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['cta_corren_desconto_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->cta_corren_desconto_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cta_corren_desconto_id'] . "; " ; 
                  if (!isset($Campos_Erros['cta_corren_desconto_id']))
                  {
                      $Campos_Erros['cta_corren_desconto_id'] = array();
                  }
                  $Campos_Erros['cta_corren_desconto_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['cta_corren_desconto_id']) || !is_array($this->NM_ajax_info['errList']['cta_corren_desconto_id']))
                  {
                      $this->NM_ajax_info['errList']['cta_corren_desconto_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['cta_corren_desconto_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cta_corren_desconto_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cta_corren_desconto_id

    function ValidateField_desconto_importacao_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['desconto_importacao_id'])) {
          nm_limpa_numero($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp']) ; 
          return;
      }
      if ($this->desconto_importacao_id === "" || is_null($this->desconto_importacao_id))  
      { 
          $this->desconto_importacao_id = 0;
          $this->sc_force_zero[] = 'desconto_importacao_id';
      } 
      nm_limpa_numero($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->desconto_importacao_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->desconto_importacao_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_desconto_importacao_id'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['desconto_importacao_id']))
                  {
                      $Campos_Erros['desconto_importacao_id'] = array();
                  }
                  $Campos_Erros['desconto_importacao_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['desconto_importacao_id']) || !is_array($this->NM_ajax_info['errList']['desconto_importacao_id']))
                  {
                      $this->NM_ajax_info['errList']['desconto_importacao_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['desconto_importacao_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->desconto_importacao_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_desconto_importacao_id'] . "; " ; 
                  if (!isset($Campos_Erros['desconto_importacao_id']))
                  {
                      $Campos_Erros['desconto_importacao_id'] = array();
                  }
                  $Campos_Erros['desconto_importacao_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['desconto_importacao_id']) || !is_array($this->NM_ajax_info['errList']['desconto_importacao_id']))
                  {
                      $this->NM_ajax_info['errList']['desconto_importacao_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['desconto_importacao_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'desconto_importacao_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_desconto_importacao_id

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
              $iTestSize = 9;
              if (strlen($this->container_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_container_id'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
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
              if ($teste_validade->Valor($this->container_id, 9, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_container_id'] . "; " ; 
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
          $this->lookup_container_id($None, true);
          if (!empty($this->Erro_look_container_id))
          { 
              $hasError = true;
              $Campos_Crit .= $this->Erro_look_container_id . "; ";
              if (!isset($Campos_Erros['container_id']))
              {
                  $Campos_Erros['container_id'] = array();
              }
              $Campos_Erros['container_id'][] = $this->Erro_look_container_id;
              if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir")
              { 
                  if (!isset($this->NM_ajax_info['errList']['container_id']) || !is_array($this->NM_ajax_info['errList']['container_id']))
                  {
                      $this->NM_ajax_info['errList']['container_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['container_id'][] = $this->Erro_look_container_id;
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

    function ValidateField_valor_utilizado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valor_utilizado'])) {
          if (!empty($this->field_config['valor_utilizado']['symbol_dec'])) {
              $this->sc_remove_currency($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_mon']); 
              nm_limpa_valor($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valor_utilizado === "" || is_null($this->valor_utilizado))  
      { 
          $this->valor_utilizado = 0;
          $this->sc_force_zero[] = 'valor_utilizado';
      } 
      if (!empty($this->field_config['valor_utilizado']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_mon']); 
          nm_limpa_valor($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp']) ; 
          if ('.' == substr($this->valor_utilizado, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valor_utilizado, 1)))
              {
                  $this->valor_utilizado = '';
              }
              else
              {
                  $this->valor_utilizado = '0' . $this->valor_utilizado;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valor_utilizado != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valor_utilizado) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_valor_utilizado'] . "(Dólar): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valor_utilizado']))
                  {
                      $Campos_Erros['valor_utilizado'] = array();
                  }
                  $Campos_Erros['valor_utilizado'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valor_utilizado']) || !is_array($this->NM_ajax_info['errList']['valor_utilizado']))
                  {
                      $this->NM_ajax_info['errList']['valor_utilizado'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_utilizado'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valor_utilizado, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_valor_utilizado'] . "(Dólar); " ; 
                  if (!isset($Campos_Erros['valor_utilizado']))
                  {
                      $Campos_Erros['valor_utilizado'] = array();
                  }
                  $Campos_Erros['valor_utilizado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valor_utilizado']) || !is_array($this->NM_ajax_info['errList']['valor_utilizado']))
                  {
                      $this->NM_ajax_info['errList']['valor_utilizado'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_utilizado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valor_utilizado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valor_utilizado

    function ValidateField_valor_a_utilizar(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valor_a_utilizar'])) {
          if (!empty($this->field_config['valor_a_utilizar']['symbol_dec'])) {
              nm_limpa_valor($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_dec'], $this->field_config['valor_a_utilizar']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valor_a_utilizar === "" || is_null($this->valor_a_utilizar))  
      { 
          $this->valor_a_utilizar = 0;
          $this->sc_force_zero[] = 'valor_a_utilizar';
      } 
      if (!empty($this->field_config['valor_a_utilizar']['symbol_dec']))
      {
          nm_limpa_valor($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_dec'], $this->field_config['valor_a_utilizar']['symbol_grp']) ; 
          if ('.' == substr($this->valor_a_utilizar, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valor_a_utilizar, 1)))
              {
                  $this->valor_a_utilizar = '';
              }
              else
              {
                  $this->valor_a_utilizar = '0' . $this->valor_a_utilizar;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valor_a_utilizar != '')  
          { 
              $iTestSize = 21;
              if (strlen($this->valor_a_utilizar) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl. a Utilizar(Dólar): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valor_a_utilizar']))
                  {
                      $Campos_Erros['valor_a_utilizar'] = array();
                  }
                  $Campos_Erros['valor_a_utilizar'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valor_a_utilizar']) || !is_array($this->NM_ajax_info['errList']['valor_a_utilizar']))
                  {
                      $this->NM_ajax_info['errList']['valor_a_utilizar'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_a_utilizar'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valor_a_utilizar, 18, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl. a Utilizar(Dólar); " ; 
                  if (!isset($Campos_Erros['valor_a_utilizar']))
                  {
                      $Campos_Erros['valor_a_utilizar'] = array();
                  }
                  $Campos_Erros['valor_a_utilizar'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valor_a_utilizar']) || !is_array($this->NM_ajax_info['errList']['valor_a_utilizar']))
                  {
                      $this->NM_ajax_info['errList']['valor_a_utilizar'] = array();
                  }
                  $this->NM_ajax_info['errList']['valor_a_utilizar'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valor_a_utilizar';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valor_a_utilizar

    function ValidateField_data(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->data, $this->field_config['data']['date_sep']) ; 
      if (isset($this->Field_no_validate['data'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['data']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['data']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['data']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['data']['date_sep']) ; 
          if (trim($this->data) != "")  
          { 
              $validateTest = $teste_validade->Data($this->data, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_data'] . "; " ; 
                  if (!isset($Campos_Erros['data']))
                  {
                      $Campos_Erros['data'] = array();
                  }
                  $Campos_Erros['data'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['data']) || !is_array($this->NM_ajax_info['errList']['data']))
                  {
                      $this->NM_ajax_info['errList']['data'] = array();
                  }
                  $this->NM_ajax_info['errList']['data'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['data']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'data';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_data

    function ValidateField_cod_usuario(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
        if (isset($this->Field_no_validate['cod_usuario'])) {
            nm_limpa_data($this->cod_usuario, $this->field_config['cod_usuario']['date_sep']) ; 
        }
      if (isset($this->Field_no_validate['cod_usuario'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->cod_usuario) > 40) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_PUB_cta_corren_desconto_fld_cod_usuario'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cod_usuario']))
              {
                  $Campos_Erros['cod_usuario'] = array();
              }
              $Campos_Erros['cod_usuario'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cod_usuario']) || !is_array($this->NM_ajax_info['errList']['cod_usuario']))
              {
                  $this->NM_ajax_info['errList']['cod_usuario'] = array();
              }
              $this->NM_ajax_info['errList']['cod_usuario'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
 nm_limpa_data($this->cod_usuario, $this->field_config['cod_usuario']['date_sep']) ; 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_usuario';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_usuario

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
    $this->nmgp_dados_form['cta_corren_desconto_id'] = $this->cta_corren_desconto_id;
    $this->nmgp_dados_form['desconto_importacao_id'] = $this->desconto_importacao_id;
    $this->nmgp_dados_form['container_id'] = $this->container_id;
    $this->nmgp_dados_form['valor_utilizado'] = $this->valor_utilizado;
    $this->nmgp_dados_form['valor_a_utilizar'] = $this->valor_a_utilizar;
    $this->nmgp_dados_form['data'] = (strlen(trim($this->data)) > 19) ? str_replace(".", ":", $this->data) : trim($this->data);
    $this->nmgp_dados_form['cod_usuario'] = (strlen(trim($this->cod_usuario)) > 19) ? str_replace(".", ":", $this->cod_usuario) : trim($this->cod_usuario);
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['cta_corren_desconto_id'] = $this->cta_corren_desconto_id;
      nm_limpa_numero($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp']) ; 
      $this->Before_unformat['desconto_importacao_id'] = $this->desconto_importacao_id;
      nm_limpa_numero($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp']) ; 
      $this->Before_unformat['container_id'] = $this->container_id;
      nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      $this->Before_unformat['valor_utilizado'] = $this->valor_utilizado;
      if (!empty($this->field_config['valor_utilizado']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_mon']);
         nm_limpa_valor($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp']);
      }
      $this->Before_unformat['valor_a_utilizar'] = $this->valor_a_utilizar;
      if (!empty($this->field_config['valor_a_utilizar']['symbol_dec']))
      {
         nm_limpa_valor($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_dec'], $this->field_config['valor_a_utilizar']['symbol_grp']);
      }
      $this->Before_unformat['data'] = $this->data;
      nm_limpa_data($this->data, $this->field_config['data']['date_sep']) ; 
      $this->Before_unformat['cod_usuario'] = $this->cod_usuario;
      nm_limpa_data($this->cod_usuario, $this->field_config['cod_usuario']['date_sep']) ; 
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
      if ($Nome_Campo == "cta_corren_desconto_id")
      {
          nm_limpa_numero($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "desconto_importacao_id")
      {
          nm_limpa_numero($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "container_id")
      {
          nm_limpa_numero($this->container_id, $this->field_config['container_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valor_utilizado")
      {
          if (!empty($this->field_config['valor_utilizado']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_mon']);
             nm_limpa_valor($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_dec'], $this->field_config['valor_utilizado']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valor_a_utilizar")
      {
          if (!empty($this->field_config['valor_a_utilizar']['symbol_dec']))
          {
             nm_limpa_valor($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_dec'], $this->field_config['valor_a_utilizar']['symbol_grp']);
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
      if ('' !== $this->cta_corren_desconto_id || (!empty($format_fields) && isset($format_fields['cta_corren_desconto_id'])))
      {
          nmgp_Form_Num_Val($this->cta_corren_desconto_id, $this->field_config['cta_corren_desconto_id']['symbol_grp'], $this->field_config['cta_corren_desconto_id']['symbol_dec'], "0", "S", $this->field_config['cta_corren_desconto_id']['format_neg'], "", "", "-", $this->field_config['cta_corren_desconto_id']['symbol_fmt']) ; 
      }
      if ('' !== $this->desconto_importacao_id || (!empty($format_fields) && isset($format_fields['desconto_importacao_id'])))
      {
          nmgp_Form_Num_Val($this->desconto_importacao_id, $this->field_config['desconto_importacao_id']['symbol_grp'], $this->field_config['desconto_importacao_id']['symbol_dec'], "0", "S", $this->field_config['desconto_importacao_id']['format_neg'], "", "", "-", $this->field_config['desconto_importacao_id']['symbol_fmt']) ; 
      }
      if ('' !== $this->container_id || (!empty($format_fields) && isset($format_fields['container_id'])))
      {
          nmgp_Form_Num_Val($this->container_id, $this->field_config['container_id']['symbol_grp'], $this->field_config['container_id']['symbol_dec'], "0", "S", $this->field_config['container_id']['format_neg'], "", "", "-", $this->field_config['container_id']['symbol_fmt']) ; 
      }
      if ('' !== $this->valor_utilizado || (!empty($format_fields) && isset($format_fields['valor_utilizado'])))
      {
          nmgp_Form_Num_Val($this->valor_utilizado, $this->field_config['valor_utilizado']['symbol_grp'], $this->field_config['valor_utilizado']['symbol_dec'], "2", "S", $this->field_config['valor_utilizado']['format_neg'], "", "", "-", $this->field_config['valor_utilizado']['symbol_fmt']) ; 
      }
      if ('' !== $this->valor_a_utilizar || (!empty($format_fields) && isset($format_fields['valor_a_utilizar'])))
      {
          nmgp_Form_Num_Val($this->valor_a_utilizar, $this->field_config['valor_a_utilizar']['symbol_grp'], $this->field_config['valor_a_utilizar']['symbol_dec'], "2", "S", $this->field_config['valor_a_utilizar']['format_neg'], "", "", "-", $this->field_config['valor_a_utilizar']['symbol_fmt']) ; 
      }
      if ((!empty($this->data) && 'null' != $this->data) || (!empty($format_fields) && isset($format_fields['data'])))
      {
          nm_volta_data($this->data, $this->field_config['data']['date_format']) ; 
          nmgp_Form_Datas($this->data, $this->field_config['data']['date_format'], $this->field_config['data']['date_sep']) ;  
      }
      elseif ('null' == $this->data || '' == $this->data)
      {
          $this->data = '';
      }
      if ((!empty($this->cod_usuario) && 'null' != $this->cod_usuario) || (!empty($format_fields) && isset($format_fields['cod_usuario'])))
      {
      }
      elseif ('null' == $this->cod_usuario || '' == $this->cod_usuario)
      {
          $this->cod_usuario = '';
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
      $guarda_format_hora = $this->field_config['data']['date_format'];
      if ($this->data != "")  
      { 
          nm_conv_data($this->data, $this->field_config['data']['date_format']) ; 
          $this->data_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->data_hora = substr($this->data_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->data_hora = substr($this->data_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->data_hora = substr($this->data_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->data_hora = substr($this->data_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->data_hora = substr($this->data_hora, 0, -4);
          }
      } 
      if ($this->data == "" && $use_null)  
      { 
          $this->data = "null" ; 
      } 
      $this->field_config['data']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['cod_usuario']['date_format'];
      if ($this->cod_usuario != "")  
      { 
          nm_conv_data($this->cod_usuario, $this->field_config['cod_usuario']['date_format']) ; 
          $this->cod_usuario_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->cod_usuario_hora = substr($this->cod_usuario_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->cod_usuario_hora = substr($this->cod_usuario_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->cod_usuario_hora = substr($this->cod_usuario_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->cod_usuario_hora = substr($this->cod_usuario_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->cod_usuario_hora = substr($this->cod_usuario_hora, 0, -4);
          }
      } 
      if ($this->cod_usuario == "" && $use_null)  
      { 
          $this->cod_usuario = "null" ; 
      } 
      $this->field_config['cod_usuario']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_cta_corren_desconto_id();
          $this->ajax_return_values_desconto_importacao_id();
          $this->ajax_return_values_container_id();
          $this->ajax_return_values_valor_utilizado();
          $this->ajax_return_values_valor_a_utilizar();
          $this->ajax_return_values_data();
          $this->ajax_return_values_cod_usuario();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['cta_corren_desconto_id']['keyVal'] = form_cta_corren_desconto_pack_protect_string($this->nmgp_dados_form['cta_corren_desconto_id']);
          }
   } // ajax_return_values

          //----- cta_corren_desconto_id
   function ajax_return_values_cta_corren_desconto_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cta_corren_desconto_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cta_corren_desconto_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cta_corren_desconto_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("cta_corren_desconto_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- desconto_importacao_id
   function ajax_return_values_desconto_importacao_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("desconto_importacao_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->desconto_importacao_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['desconto_importacao_id'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
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
              $orig_container_id = $this->container_id;
              $container_id      = $this->container_id;
              nm_limpa_numero($container_id, $this->field_config['container_id']['symbol_grp']); 
              $this->container_id = $container_id;
              $this->lookup_container_id($conteudo);
              $this->container_id = $orig_container_id;
              $this->NM_ajax_info['fldList']['container_id']['lookupCons'] = form_cta_corren_desconto_pack_protect_string(NM_charset_to_utf8($conteudo));
          }
   }

          //----- valor_utilizado
   function ajax_return_values_valor_utilizado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valor_utilizado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valor_utilizado);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valor_utilizado'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valor_a_utilizar
   function ajax_return_values_valor_a_utilizar($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valor_a_utilizar", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valor_a_utilizar);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valor_a_utilizar'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- data
   function ajax_return_values_data($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("data", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->data);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['data'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_valor_a_utilizar = $this->valor_a_utilizar;
}
if (!isset($this->sc_temp_desconto_importacao_id_corrente)) {$this->sc_temp_desconto_importacao_id_corrente = (isset($_SESSION['desconto_importacao_id_corrente'])) ? $_SESSION['desconto_importacao_id_corrente'] : "";}
if (!isset($this->sc_temp_fornec_desconto_corrente)) {$this->sc_temp_fornec_desconto_corrente = (isset($_SESSION['fornec_desconto_corrente'])) ? $_SESSION['fornec_desconto_corrente'] : "";}
if (!isset($this->sc_temp_vl_a_utilizar)) {$this->sc_temp_vl_a_utilizar = (isset($_SESSION['vl_a_utilizar'])) ? $_SESSION['vl_a_utilizar'] : "";}
  $this->valor_a_utilizar  = $this->buscarVlSaldoUtilizar($this->sc_temp_desconto_importacao_id_corrente);
$vl_a_utilizar = $this->valor_a_utilizar ;
 if (isset($vl_a_utilizar)) {$this->sc_temp_vl_a_utilizar = $vl_a_utilizar;}
;
$fornec_desconto_corrente = $this->buscarFornecDesconto($this->sc_temp_desconto_importacao_id_corrente);
 if (isset($fornec_desconto_corrente)) {$this->sc_temp_fornec_desconto_corrente = $fornec_desconto_corrente;}
;
if (isset($this->sc_temp_vl_a_utilizar)) { $_SESSION['vl_a_utilizar'] = $this->sc_temp_vl_a_utilizar;}
if (isset($this->sc_temp_fornec_desconto_corrente)) { $_SESSION['fornec_desconto_corrente'] = $this->sc_temp_fornec_desconto_corrente;}
if (isset($this->sc_temp_desconto_importacao_id_corrente)) { $_SESSION['desconto_importacao_id_corrente'] = $this->sc_temp_desconto_importacao_id_corrente;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_valor_a_utilizar != $this->valor_a_utilizar || (isset($bFlagRead_valor_a_utilizar) && $bFlagRead_valor_a_utilizar)))
    {
        $this->ajax_return_values_valor_a_utilizar(true);
    }
}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
      }
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
      $this->valor_utilizado = str_replace($sc_parm1, $sc_parm2, $this->valor_utilizado); 
      $this->valor_a_utilizar = str_replace($sc_parm1, $sc_parm2, $this->valor_a_utilizar); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->valor_utilizado = "'" . $this->valor_utilizado . "'";
      $this->valor_a_utilizar = "'" . $this->valor_a_utilizar . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->valor_utilizado = str_replace("'", "", $this->valor_utilizado); 
      $this->valor_a_utilizar = str_replace("'", "", $this->valor_a_utilizar); 
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
    if ("incluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeInsert ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_cod_usuario = $this->cod_usuario;
    $original_container_id = $this->container_id;
    $original_valor_utilizado = $this->valor_utilizado;
}
if (!isset($this->sc_temp_vl_a_utilizar)) {$this->sc_temp_vl_a_utilizar = (isset($_SESSION['vl_a_utilizar'])) ? $_SESSION['vl_a_utilizar'] : "";}
  if($this->valor_utilizado  > $this->sc_temp_vl_a_utilizar){
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'O valor Utilizado não pode ser maior que o valor a Utilizar';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_cta_corren_desconto';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_cta_corren_desconto';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'O valor Utilizado não pode ser maior que o valor a Utilizar';
 }
;
}
$this->setCustoContainerDesatualiz($this->container_id ,1);
if($this->cod_usuario  == ''){
	$this->cod_usuario  = $this->getLoginCorrente();	
}
if (isset($this->sc_temp_vl_a_utilizar)) { $_SESSION['vl_a_utilizar'] = $this->sc_temp_vl_a_utilizar;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_cod_usuario != $this->cod_usuario || (isset($bFlagRead_cod_usuario) && $bFlagRead_cod_usuario)))
    {
        $this->ajax_return_values_cod_usuario(true);
    }
    if (($original_container_id != $this->container_id || (isset($bFlagRead_container_id) && $bFlagRead_container_id)))
    {
        $this->ajax_return_values_container_id(true);
    }
    if (($original_valor_utilizado != $this->valor_utilizado || (isset($bFlagRead_valor_utilizado) && $bFlagRead_valor_utilizado)))
    {
        $this->ajax_return_values_valor_utilizado(true);
    }
}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeUpdate ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_container_id = $this->container_id;
    $original_valor_utilizado = $this->valor_utilizado;
}
  if($this->nmgp_dados_form['valor_utilizado'] != $this->valor_utilizado ){
	$this->setCustoContainerDesatualiz($this->container_id ,1);
	
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_container_id != $this->container_id || (isset($bFlagRead_container_id) && $bFlagRead_container_id)))
    {
        $this->ajax_return_values_container_id(true);
    }
    if (($original_valor_utilizado != $this->valor_utilizado || (isset($bFlagRead_valor_utilizado) && $bFlagRead_valor_utilizado)))
    {
        $this->ajax_return_values_valor_utilizado(true);
    }
}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeUpdate ------*/
 
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
      if ('incluir' == $this->nmgp_opcao && empty($this->desconto_importacao_id)) {$this->desconto_importacao_id = "" . $_SESSION['desconto_importacao_id_corrente'] . ""; $this->sc_force_zero[] = "desconto_importacao_id";}  
      if ('incluir' == $this->nmgp_opcao && empty($this->container_id)) {$this->container_id = "" . $_SESSION['container_corrente'] . ""; $this->sc_force_zero[] = "container_id";}  
      if ('incluir' == $this->nmgp_opcao && empty($this->cod_usuario)) {$this->cod_usuario = "" . $_SESSION['usr_login'] . ""; $this->NM_val_null[] = "cod_usuario";}  
      $NM_val_form['cta_corren_desconto_id'] = $this->cta_corren_desconto_id;
      $NM_val_form['desconto_importacao_id'] = $this->desconto_importacao_id;
      $NM_val_form['container_id'] = $this->container_id;
      $NM_val_form['valor_utilizado'] = $this->valor_utilizado;
      $NM_val_form['valor_a_utilizar'] = $this->valor_a_utilizar;
      $NM_val_form['data'] = $this->data;
      $NM_val_form['cod_usuario'] = $this->cod_usuario;
      if ($this->cta_corren_desconto_id === "" || is_null($this->cta_corren_desconto_id))  
      { 
          $this->cta_corren_desconto_id = 0;
      } 
      if ($this->desconto_importacao_id === "" || is_null($this->desconto_importacao_id))  
      { 
          $this->desconto_importacao_id = 0;
          $this->sc_force_zero[] = 'desconto_importacao_id';
      } 
      if ($this->container_id === "" || is_null($this->container_id))  
      { 
          $this->container_id = 0;
          $this->sc_force_zero[] = 'container_id';
      } 
      if ($this->valor_utilizado === "" || is_null($this->valor_utilizado))  
      { 
          $this->valor_utilizado = 0;
          $this->sc_force_zero[] = 'valor_utilizado';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->data == "")  
          { 
              $this->data = "null"; 
              $this->NM_val_null[] = "data";
          } 
          if ($this->cod_usuario == "")  
          { 
              $this->cod_usuario = "null"; 
              $this->NM_val_null[] = "cod_usuario";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_cta_corren_desconto_pack_ajax_response();
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
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = #$this->data#, cod_usuario = #$this->cod_usuario#"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", cod_usuario = " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", cod_usuario = " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = EXTEND('$this->data', YEAR TO DAY), cod_usuario = EXTEND('$this->cod_usuario', YEAR TO DAY)"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", cod_usuario = " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", cod_usuario = " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ""; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "desconto_importacao_id = $this->desconto_importacao_id, container_id = $this->container_id, valor_utilizado = $this->valor_utilizado, data = " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", cod_usuario = " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ""; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE cta_corren_desconto_id = $this->cta_corren_desconto_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE cta_corren_desconto_id = $this->cta_corren_desconto_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE cta_corren_desconto_id = $this->cta_corren_desconto_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE cta_corren_desconto_id = $this->cta_corren_desconto_id ";  
              }  
              else  
              {
                  $comando .= " WHERE cta_corren_desconto_id = $this->cta_corren_desconto_id ";  
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
                                  form_cta_corren_desconto_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['cta_corren_desconto_id'])) { $this->cta_corren_desconto_id = $NM_val_form['cta_corren_desconto_id']; }
              elseif (isset($this->cta_corren_desconto_id)) { $this->nm_limpa_alfa($this->cta_corren_desconto_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['desconto_importacao_id'])) { $this->desconto_importacao_id = $NM_val_form['desconto_importacao_id']; }
              elseif (isset($this->desconto_importacao_id)) { $this->nm_limpa_alfa($this->desconto_importacao_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['container_id'])) { $this->container_id = $NM_val_form['container_id']; }
              elseif (isset($this->container_id)) { $this->nm_limpa_alfa($this->container_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['valor_utilizado'])) { $this->valor_utilizado = $NM_val_form['valor_utilizado']; }
              elseif (isset($this->valor_utilizado)) { $this->nm_limpa_alfa($this->valor_utilizado); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('cta_corren_desconto_id', 'desconto_importacao_id', 'container_id', 'valor_utilizado', 'valor_a_utilizar', 'data', 'cod_usuario'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_cta_corren_desconto_pack_ajax_response();
              }
              exit; 
          }  
          $this->cta_corren_desconto_id_before_qstr = $this->cta_corren_desconto_id = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
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
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_cta_corren_desconto_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES ($this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, #$this->data#, #$this->cod_usuario#)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, EXTEND('$this->data', YEAR TO DAY), EXTEND('$this->cod_usuario', YEAR TO DAY))"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario) VALUES (" . $NM_seq_auto . "$this->cta_corren_desconto_id, $this->desconto_importacao_id, $this->container_id, $this->valor_utilizado, " . $this->Ini->date_delim . $this->data . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->cod_usuario . $this->Ini->date_delim1 . ")"; 
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
                              form_cta_corren_desconto_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
              $_SESSION["gl_vl_a_utilizar"] = $this->valor_a_utilizar;  
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->cta_corren_desconto_id = substr($this->Db->qstr($this->cta_corren_desconto_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where cta_corren_desconto_id = $this->cta_corren_desconto_id "); 
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
                          form_cta_corren_desconto_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']);
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        
/*----- Scriptcase Locale: Event onAfterInsert ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterInsert ------*/
 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        
/*----- Scriptcase Locale: Event onAfterUpdate ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterUpdate ------*/
 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      
/*----- Scriptcase Locale: Event onAfterDelete ------*/
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_container_id = $this->container_id;
}
  $this->preencherIDLog($this->Ini->nm_cod_apl);
$this->setCustoContainerDesatualiz($this->container_id ,1);
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_container_id != $this->container_id || (isset($bFlagRead_container_id) && $bFlagRead_container_id)))
    {
        $this->ajax_return_values_container_id(true);
    }
}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterDelete ------*/
 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['parms'] = "cta_corren_desconto_id?#?$this->cta_corren_desconto_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->cta_corren_desconto_id = null === $this->cta_corren_desconto_id ? null : substr($this->Db->qstr($this->cta_corren_desconto_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->cta_corren_desconto_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->cta_corren_desconto_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" && $this->sc_evento == "insert")
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_cta_corren_desconto = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] = $qt_geral_reg_form_cta_corren_desconto;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->cta_corren_desconto_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "cta_corren_desconto_id < $this->cta_corren_desconto_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "cta_corren_desconto_id < $this->cta_corren_desconto_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "cta_corren_desconto_id < $this->cta_corren_desconto_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "cta_corren_desconto_id < $this->cta_corren_desconto_id "; 
              }
              else  
              {
                  $Key_Where = "cta_corren_desconto_id < $this->cta_corren_desconto_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_cta_corren_desconto = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] > $qt_geral_reg_form_cta_corren_desconto)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = $qt_geral_reg_form_cta_corren_desconto; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = $qt_geral_reg_form_cta_corren_desconto; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_cta_corren_desconto) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, str_replace (convert(char(10),data,102), '.', '-') + ' ' + convert(char(8),data,20), str_replace (convert(char(10),cod_usuario,102), '.', '-') + ' ' + convert(char(8),cod_usuario,20) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, convert(char(23),data,121), convert(char(23),cod_usuario,121) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, EXTEND(data, YEAR TO DAY), EXTEND(cod_usuario, YEAR TO DAY) from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT cta_corren_desconto_id, desconto_importacao_id, container_id, valor_utilizado, data, cod_usuario from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
              }  
              else  
              {
                  $aWhere[] = "cta_corren_desconto_id = $this->cta_corren_desconto_id"; 
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
          $sc_order_by = "cta_corren_desconto_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter']))
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
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['bt_log'] = $this->nmgp_botoes['bt_log'] = "off";
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
              $this->cta_corren_desconto_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['cta_corren_desconto_id'] = $this->cta_corren_desconto_id;
              $this->desconto_importacao_id = $rs->fields[1] ; 
              $this->nmgp_dados_select['desconto_importacao_id'] = $this->desconto_importacao_id;
              $this->container_id = $rs->fields[2] ; 
              $this->nmgp_dados_select['container_id'] = $this->container_id;
              $this->valor_utilizado = $rs->fields[3] ; 
              $this->nmgp_dados_select['valor_utilizado'] = $this->valor_utilizado;
              $this->data = $rs->fields[4] ; 
              $this->nmgp_dados_select['data'] = $this->data;
              $this->cod_usuario = $rs->fields[5] ; 
              $this->nmgp_dados_select['cod_usuario'] = $this->cod_usuario;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->cta_corren_desconto_id = (string)$this->cta_corren_desconto_id; 
              $this->desconto_importacao_id = (string)$this->desconto_importacao_id; 
              $this->container_id = (string)$this->container_id; 
              $this->valor_utilizado = (string)$this->valor_utilizado; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['parms'] = "cta_corren_desconto_id?#?$this->cta_corren_desconto_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] < $qt_geral_reg_form_cta_corren_desconto;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opcao']   = '';
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
              $this->cta_corren_desconto_id = "";  
              $this->nmgp_dados_form["cta_corren_desconto_id"] = $this->cta_corren_desconto_id;
              $this->desconto_importacao_id = "";  
              $this->nmgp_dados_form["desconto_importacao_id"] = $this->desconto_importacao_id;
              $this->container_id = "";  
              $this->nmgp_dados_form["container_id"] = $this->container_id;
              $this->valor_utilizado = "";  
              $this->nmgp_dados_form["valor_utilizado"] = $this->valor_utilizado;
              $this->data = "";  
              $this->data_hora = "" ;  
              $this->nmgp_dados_form["data"] = $this->data;
              $this->cod_usuario = "";  
              $this->cod_usuario_hora = "" ;  
              $this->nmgp_dados_form["cod_usuario"] = $this->cod_usuario;
              $this->valor_a_utilizar = "";  
              $this->nmgp_dados_form["valor_a_utilizar"] = $this->valor_a_utilizar;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['foreign_key'] as $sFKName => $sFKValue)
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
          $_SESSION["gl_vl_a_utilizar"] = $this->valor_a_utilizar;  
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id < $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->cta_corren_desconto_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " where cta_corren_desconto_id > $this->cta_corren_desconto_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->cta_corren_desconto_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter']))
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
     $this->cta_corren_desconto_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(cta_corren_desconto_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
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
     $this->cta_corren_desconto_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
       $this->SC_log_arr['keys']['cta_corren_desconto_id'] =  $this->cta_corren_desconto_id;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dados_select'];
           $this->SC_log_arr['fields']['desconto_importacao_id']['0'] =  $nmgp_dados_select['desconto_importacao_id'];
           $this->SC_log_arr['fields']['container_id']['0'] =  $nmgp_dados_select['container_id'];
           $this->SC_log_arr['fields']['valor_utilizado']['0'] =  $nmgp_dados_select['valor_utilizado'];
           $this->SC_log_arr['fields']['data']['0'] =  $nmgp_dados_select['data'];
           $this->SC_log_arr['fields']['cod_usuario']['0'] =  $nmgp_dados_select['cod_usuario'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['desconto_importacao_id']['1'] =  $this->desconto_importacao_id;
       $this->SC_log_arr['fields']['container_id']['1'] =  $this->container_id;
       $this->SC_log_arr['fields']['valor_utilizado']['1'] =  $this->valor_utilizado;
       $this->SC_log_arr['fields']['data']['1'] =  $this->data;
       $this->SC_log_arr['fields']['cod_usuario']['1'] =  $this->cod_usuario;
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
       $Log_labels['desconto_importacao_id'] =  "{lang_PUB_cta_corren_desconto_fld_desconto_importacao_id}";
       $Log_labels['container_id'] =  "{lang_PUB_cta_corren_desconto_fld_container_id}";
       $Log_labels['valor_utilizado'] =  "{lang_PUB_cta_corren_desconto_fld_valor_utilizado}(Dólar)";
       $Log_labels['data'] =  "{lang_PUB_cta_corren_desconto_fld_data}";
       $Log_labels['cod_usuario'] =  "{lang_PUB_cta_corren_desconto_fld_cod_usuario}";
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: sql.php ------*/

function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: sql.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function dataAtual()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function retirarAcento($palavra)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function convLogEmString($valor)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function convArrayToString($array)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function tratarNumero($num)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
   $sErrorIndex = 'geral_form_cta_corren_desconto';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_cta_corren_desconto';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
    }
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function convArrayParaLista($array,$logEntreAspas=false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $lista = '';
    $tot = count($array);
    for($i=0;$i<$tot;$i++){
        if($logEntreAspas == true){
            $incr = "'{$array[$i]}'";
        }else{
            $incr = $array[$i];
        }
        $lista = $this->util_incr_valor($lista,$incr,",",true);
    }
    return $lista;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: util.php ------*/

function convArrayMultParaLista($array,$indice,$logEntreAspas=false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $lista = '';
    if(is_array($array)){
        foreach($array as $reg){
            if($logEntreAspas == true){
                $incr = "'{$reg[$indice]}'";
            }else{
                $incr = $reg[$indice];
            }
            $lista = $this->util_incr_valor($lista,$incr,",",true);
        }
    }

    return $lista;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: util.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
        $this->data = $this->dadoslog->fields[2];
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
                form_cta_corren_desconto_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            }else{
                echo "<h1>id não numerico: $idChave <br> id: $idReg <br> descrição: $desc <br> $this->data </h1>";
            }
        }


        $this->dadoslog->MoveNext();
    }
    $this->dadoslog->Close();
}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function getArqTransLog($programa)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function linkLogAtual()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: logs.php ------*/

function getDirArqsLog()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: logs.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $valor= 1;
    $dataCotacao = '';
    $campoRetorno = '"vl-dolar-venda"';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno,
        "\"nr-container\" = $this->container_id ",'espec');
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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
                        $this->data    = $aCotacao['data'];
                        $this->data    = $this->nm_conv_data_db($this->data,'aaaa-mm-dd','dd/mm/aaaa');
                    }else{
                        $cotacao = 0;
                        $this->data = '';
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

                    $histOrigem = "<h2>Última Cotação Em $this->data - Prioridade $i - Projeção:$descProjDolar - Acrescimo: $vlProjDolar $sinal ";
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    
    $this->data = '2015-01-01';
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ic, pub.itens_proc_compra ip ,pub.procs_compra p ',
        'min(p.dt_registro) as data',
        " ic.item_proc_compra_id = ip.item_proc_compra_id and ip.proc_compra_id = p.proc_compra_id 
								  and ic.container_id = $containerId",'espec');
    if(is_array($aRetorno))	{
        $this->data = $aRetorno[0]['data'];
    }
    else{
    }
    if($this->data ==''){
        $this->data = '2005-01-01';
    }

    return $this->data;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
$dolarMedio = 0;
$log = '';
$aDolar = $this->buscarDolar($container,'compra',true);
$vlCotacaoSaldo = $aDolar['cotacao'];
$histDolar      = $aDolar['hist_origem'];
$log     = "<h1>Inicio</h1>";
$log    .= "<h1>Container:$container - Cotacao Saldo:" . $this->formatarNumero($vlCotacaoSaldo,5);
    $log    .= "<h2>Hist: $histDolar</h2>";

    $totCustoPrevDolar = buscarTotCustoPrevDolarContainer($container);

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
        $vlProforma   =	buscarTotCustoPrevDolarContainer($container,'proforma');
        $vlNegociado  =	buscarTotCustoPrevDolarContainer($container,'negociado');
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
        $retorno = array('dolar_medio'                  => $dolarMedio,
                        'cotacao_saldo'                 => $vlCotacaoSaldo,
                        'hist_dolar'                    => $histDolar,
                        'log'                           => $log,
                        'vl_desconto_cred_utilizado_dolar'   => $vlDescontoCredUtilizDOLAR,
                        'vl_desconto_cred_utilizado_real'    => $vlDescontoCredUtilizREAL,
                        'vl_saldo_dolar'                     => $vlSaldoDOLAR,
                        'vl_desconto_utilizado_real'         => $vlDescontoUtilizREAL,
                        'vl_desconto_utilizado_dolar'        => $vlDescontoUtilizDOLAR,
        );
        return $retorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
                form_cta_corren_desconto_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
                form_cta_corren_desconto_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $this->data = getDataUltVersaoCustoContainer($containerParam);
    if($this->data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $this->data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function dependenciasContainer($container)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: container.php ------*/

function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: container.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarDadosDescontos($descontoId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

    $tabela   = "pub.descontos_importacao";
    $campos   = 'motivo_desconto_id, descricao, log_credito, cod_tipo, dt_autorizacao, fornecedor_id';
    $condicao = " desconto_importacao_id = $descontoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarVlsDescontosPorFornecedor($fornecedor=0 )
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarDescontosUtiliz($container,$itemContainerId='')
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarDescontosCreditosUtiliz($container){
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function validarVlAprovadoEmReal($vlReal,$vlRealAutoriz)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlRealAutoriz > $vlReal){
        $erro = 'ERRO.O Valor Aprovado em Real não pode ser maior que o Valor Solicitado em Real';
    }
    return $erro;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function validarVlAprovadoEmDolar($vlDolar,$vlDolarAutoriz)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlDolarAutoriz > $vlDolar){
        $erro = 'ERRO. O Valor Aprovado em Dólar não pode ser maior que o Valor Solicitado em Dólar';
    }
    return $erro;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function validarVlsAutorizacao($vlDolarAutoriz, $vlRealAutoriz, $dtAutoriz)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarVlSaldoUtilizar($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $retorno = 0;
    $vlDolar = $this->buscarVlDolarAutorizDesconto($descontoImportacaoId);
    $vlUtilizado = $this->buscarDescontoTotalUtilizado($descontoImportacaoId);
    $retorno = $vlDolar - $vlUtilizado;

    return $retorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarDescontoTotalUtilizado($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
     $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.cta_corren_desconto ',
                                   ' sum(valor_utilizado) as valor ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["valor"];
    return $retorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarVlDolarAutorizDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
                                   ' vl_dolar_autorizado ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["vl_dolar_autorizado"];

    return $retorno;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function buscarFornecDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
        ' fornecedor_id ',
        " desconto_importacao_id = $descontoImportacaoId ", 'espec');
    if (is_array($aRetorno))
        $retorno = $aRetorno[0]["fornecedor_id"];

    return $retorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/

function getVlDescAutorizado($fornecedor)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: descontos_importacao.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getNomeVarLoginSessao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return "glo_usr_login";

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getNomeVarPercParComis()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return "perc_participacao_comis";

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getNomeVarTodosCliente()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return "log_todos_cliente";

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getCamposUsuario()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return  'priv_admin,ativo,nome,email,"tp-usuario" as tp_usuario,usuario,
		"nome-ab-cli" as nome_ab_cli,login,usuario,log_pedido_on_line,
                 log_aprovador,id,perc_participacao_comis,log_todos_clientes';

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function validarLogin($login,$pswd)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getVarSessao($varParam,$logEscopoApl=false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = getNomeVarSessaoComApl($varParam);
    }

    if(isset($_SESSION[$varParam])){
        $retParam =  $_SESSION[$varParam];
    }else{
        $retParam = '';
    }
    return $retParam;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function setarVarsLogin($aUsuario)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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




$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function logar($login,$pswd)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLogin($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
      $this->setarVarsLogin($aUsuario);
      atualizarParametros();
    }

	return $erro;


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getNomeRepresSessao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $nomeRepresIni = $this->getVarSessao('glo_nomeRepresIni');
    if($nomeRepresIni == ''){
        $nomeRepresFim = 'zzzzzzzzzzzzzzzz';
    }else{
        $nomeRepresFim = $nomeRepresIni;
    }
    $aRetorno = array('nome_repres_ini' => $nomeRepresIni, 'nome_repres_fim' => $nomeRepresFim);
    return  $aRetorno;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function aplicarPermissoesSC($login)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  



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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function has_priv($param)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return ($param == 'Y' ? 'on' : 'off');


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function limparLogin($logLimparPerfilPai=false)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
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
    $listaVar = $this->util_incr_valor($listaVar,getParamVendLoja()) ;
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function inicioAplicacao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getLoginCorrente()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarLoginSessao());


$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getPercPartComisCorrente()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarPercParComis());

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function getTodosClienteCorrente()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTodosCliente());

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function limparListaCpsSessao()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $aLista =$this->getVarSessao('lista_cps_definida');
    if(is_array($aLista)){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $variavel = $aLista[$i];
            unset($_SESSION[$variavel]);
        }
    }

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function verifUsuarioCorrenteAdmin()
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $log= 0;

    $tipo = getTipoUsuarioCorrente();
    if($tipo <> 2 and $tipo <> 5){
        $log = 1;
    }
    return $log;

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/


/*----- Scriptcase Locale: Internal Lib: login.php ------*/

function logarLDAP($usuario,$senha,$servidor='__OMITIDO_NA_COPIA_DE_ANALISE__',$dominio='IMA',$porta=389)
{
$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'on';
  
    $ldapconn = ldap_connect("ldap://{$servidor}:{$porta}") ;

    if ($ldapconn) {
        $ldapbind = ldap_bind($ldapconn, "{$dominio}\\{$usuario}", $senha);
        if ($ldapbind) {
            return 'logado';
        }
        ldap_close($ldapconn);

    }
    return '';

$_SESSION['scriptcase']['form_cta_corren_desconto']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: login.php ------*/

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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_cta_corren_desconto_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_cta_corren_desconto_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("cta_corren_desconto_id", "desconto_importacao_id", "container_id", "valor_utilizado", "data", "cod_usuario"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['table_refresh'])
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_cta_corren_desconto_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "cta_corren_desconto_id") 
          {
              $this->SC_monta_condicao($comando, "cta_corren_desconto_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "desconto_importacao_id") 
          {
              $this->SC_monta_condicao($comando, "desconto_importacao_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "container_id") 
          {
              $this->SC_monta_condicao($comando, "container_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "valor_utilizado") 
          {
              $this->SC_monta_condicao($comando, "valor_utilizado", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data") 
          {
              $this->SC_monta_condicao($comando, "data", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cod_usuario") 
          {
              $this->SC_monta_condicao($comando, "cod_usuario", $arg_search, $data_search, "DATE", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_cta_corren_desconto = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] = $qt_geral_reg_form_cta_corren_desconto;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_cta_corren_desconto_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_cta_corren_desconto_pack_ajax_response();
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
      $nm_numeric[] = "cta_corren_desconto_id";$nm_numeric[] = "desconto_importacao_id";$nm_numeric[] = "container_id";$nm_numeric[] = "valor_utilizado";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['decimal_db'] == ".")
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
      $Nm_datas["data"] = "date";$Nm_datas["cod_usuario"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['SC_sep_date1'];
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
       $nmgp_saida_form = "form_cta_corren_desconto_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_cta_corren_desconto_fim.php";
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
       form_cta_corren_desconto_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['masterValue']);
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Utilização do Desconto"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Utilização do Desconto"; } ?> - 
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cta_corren_desconto']['ordem_ord'] == " desc") {
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
            case "cta_corren_desconto_id":
                return true;
            case "desconto_importacao_id":
                return true;
            case "container_id":
                return true;
            case "valor_utilizado":
                return true;
            case "":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "cta_corren_desconto_id":
                return 'desc';
            case "desconto_importacao_id":
                return 'desc';
            case "container_id":
                return 'desc';
            case "valor_utilizado":
                return 'desc';
            case "data":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
