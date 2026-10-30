<?php
//
class contr_item_custos_apl
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
   var $cp_priorizar_previsto;
   var $cp_priorizar_previsto_1;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
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
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['cp_priorizar_previsto']))
          {
              $this->cp_priorizar_previsto = $this->NM_ajax_info['param']['cp_priorizar_previsto'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
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
      if (isset($this->container_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($_POST["container_corrente"]) && isset($this->container_corrente)) 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($_GET["container_corrente"]) && isset($this->container_corrente)) 
      {
          $_SESSION['container_corrente'] = $this->container_corrente;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['embutida_parms']);
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
                 nm_limpa_str_contr_item_custos($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->container_corrente)) 
          {
              $_SESSION['container_corrente'] = $this->container_corrente;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['opc_ant']);
          }
          if (isset($this->container_corrente)) 
          {
              $_SESSION['container_corrente'] = $this->container_corrente;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new contr_item_custos_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['contr_item_custos']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['contr_item_custos']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['contr_item_custos'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['contr_item_custos']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['contr_item_custos']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('contr_item_custos') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['contr_item_custos']['label'] = "Cálculo de Custo do Item - Seleção do P Unitário";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "contr_item_custos")
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


      $this->arr_buttons['voltar']['hint']             = "";
      $this->arr_buttons['voltar']['type']             = "button";
      $this->arr_buttons['voltar']['value']            = "Voltar";
      $this->arr_buttons['voltar']['display']          = "only_text";
      $this->arr_buttons['voltar']['display_position'] = "text_right";
      $this->arr_buttons['voltar']['style']            = "default";
      $this->arr_buttons['voltar']['image']            = "";


      $_SESSION['scriptcase']['error_icon']['contr_item_custos']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['contr_item_custos'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "off";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      $this->nmgp_botoes['Voltar'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['contr_item_custos']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['contr_item_custos'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['contr_item_custos'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("contr_item_custos", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'contr_item_custos_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'contr_item_custos_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('contr:' == substr($str_link_webhelp, 0, 6))
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
          require_once($this->Ini->path_embutida . 'contr_item_custos/contr_item_custos_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "contr_item_custos_erro.class.php"); 
      }
      $this->Erro      = new contr_item_custos_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['contr_item_custos']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Voltar'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Voltar'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['botoes']['Voltar'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_cp_priorizar_previsto = $this->cp_priorizar_previsto;
}
if (!isset($this->sc_temp_container_corrente)) {$this->sc_temp_container_corrente = (isset($_SESSION['container_corrente'])) ? $_SESSION['container_corrente'] : "";}
  $logLibCusto = $this->verificarLiberCustoContainer($this->sc_temp_container_corrente);
if($logLibCusto == 1){
	$this->nmgp_cmp_hidden["cp_priorizar_previsto"] = 'on'; $this->NM_ajax_info['fieldDisplay']['cp_priorizar_previsto'] = 'on';	
}
else{
	$this->nmgp_cmp_hidden["cp_priorizar_previsto"] = 'off'; $this->NM_ajax_info['fieldDisplay']['cp_priorizar_previsto'] = 'off';	 		
	 if (isset($this->sc_temp_container_corrente)) { $_SESSION['container_corrente'] = $this->sc_temp_container_corrente;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('cons_itens_container_simul_calc') . "/", $this->nm_location, "log_priorizar_custo_previsto?#?" . NM_encode_input("0") . "?@?", "_self", "ret_self", 440, 630);
 };
}
if (isset($this->sc_temp_container_corrente)) { $_SESSION['container_corrente'] = $this->sc_temp_container_corrente;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_cp_priorizar_previsto != $this->cp_priorizar_previsto || (isset($bFlagRead_cp_priorizar_previsto) && $bFlagRead_cp_priorizar_previsto)))
    {
        $this->ajax_return_values_cp_priorizar_previsto(true);
    }
}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['contr_item_custos']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['contr_item_custos']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['Gera_log_access'] = false;
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
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_cp_priorizar_previsto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cp_priorizar_previsto');
          }
          contr_item_custos_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (is_array($this->cp_priorizar_previsto))
          {
              $x = 0; 
              $this->cp_priorizar_previsto_1 = $this->cp_priorizar_previsto;
              $this->cp_priorizar_previsto = ""; 
              if ($this->cp_priorizar_previsto_1 != "") 
              { 
                  foreach ($this->cp_priorizar_previsto_1 as $dados_cp_priorizar_previsto_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->cp_priorizar_previsto .= ";";
                      } 
                      $this->cp_priorizar_previsto .= $dados_cp_priorizar_previsto_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              contr_item_custos_pack_ajax_response();
              exit;
          }
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
          $_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  contr_item_custos_pack_ajax_response();
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
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  contr_item_custos_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
//
      if (!isset($nm_form_submit) && $this->nmgp_opcao != "nada")
      {
          $this->cp_priorizar_previsto = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form'] as $NM_campo => $NM_valor)
              {
                  $$NM_campo = $NM_valor;
              }
          }
      }
      else
      {
           if ($this->nmgp_opcao != "nada")
           {
           }
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['campos']))
              { 
                  $cp_priorizar_previsto = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['campos'][0]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['campos'][0] = $this->cp_priorizar_previsto; 
          $contr_menu = "";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['iframe_menu'])
          {
              $contr_menu = "glo_menu";
          }
          if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("contr_item_custos", $_SESSION['scriptcase']['sc_ult_apl_menu']))
          {
              $this->nmgp_redireciona_form("contr_item_custos_fim.php", $this->nm_location, $contr_menu); 
          }
          else
          {
              $SC_parm_lig = "tipo_vl_custo*scin" . $this->radio_vl_custo . "*scout";
              $this->nmgp_redireciona_form($this->Ini->link_bl_item_custos, $this->nm_location, $SC_parm_lig, "_self", '', '430', '630'); 
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              contr_item_custos_pack_ajax_response();
              exit;
          }
      }
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "contr_item_custos.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Cálculo de Custo do Item - Seleção do P Unitário") ?></TITLE>
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
<form name="Fdown" method="get" action="contr_item_custos_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="contr_item_custos"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'contr_item_custos', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'contr_item_custos', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'contr_item_custos', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               contr_item_custos_pack_ajax_response();
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
           $this->Ini->nm_db_especw->Close(); 
           $this->Ini->nm_db_ems5w->Close(); 
           $this->Ini->nm_db_comumw->Close(); 
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
           case 'cp_priorizar_previsto':
               return "Priorizar valor Previsto?";
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
      if ((!is_array($filtro) && ('' == $filtro || 'cp_priorizar_previsto' == $filtro)) || (is_array($filtro) && in_array('cp_priorizar_previsto', $filtro)))
        $this->ValidateField_cp_priorizar_previsto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cp_priorizar_previsto";

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

      if (empty($Campos_Crit) && empty($Campos_Falta) && empty($this->Campos_Mens_erro))
      {
          if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
          {
              $_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_cp_priorizar_previsto = $this->cp_priorizar_previsto;
}
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('cons_itens_container_simul_calc') . "/", $this->nm_location, "log_priorizar_custo_previsto?#?" . NM_encode_input($this->cp_priorizar_previsto ) . "?@?", "_self", "ret_self", 440, 630);
 };
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_cp_priorizar_previsto != $this->cp_priorizar_previsto || (isset($bFlagRead_cp_priorizar_previsto) && $bFlagRead_cp_priorizar_previsto)))
    {
        $this->ajax_return_values_cp_priorizar_previsto(true);
    }
}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off'; 
          }
      }
   }

    function ValidateField_cp_priorizar_previsto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['cp_priorizar_previsto'])) {
       return;
   }
      if ($this->cp_priorizar_previsto == "" && $this->nmgp_opcao != "excluir")
      { 
          $this->cp_priorizar_previsto = "0";
      } 
      else 
      { 
          if (is_array($this->cp_priorizar_previsto))
          {
              $x = 0; 
              $this->cp_priorizar_previsto_1 = array(); 
              foreach ($this->cp_priorizar_previsto as $ind => $dados_cp_priorizar_previsto_1 ) 
              {
                  if ($dados_cp_priorizar_previsto_1 != "") 
                  {
                      $this->cp_priorizar_previsto_1[] = $dados_cp_priorizar_previsto_1;
                  } 
              } 
              $this->cp_priorizar_previsto = ""; 
              foreach ($this->cp_priorizar_previsto_1 as $dados_cp_priorizar_previsto_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->cp_priorizar_previsto .= ";";
                   } 
                   $this->cp_priorizar_previsto .= $dados_cp_priorizar_previsto_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cp_priorizar_previsto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cp_priorizar_previsto

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
    $this->nmgp_dados_form['cp_priorizar_previsto'] = $this->cp_priorizar_previsto;
    $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
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

   function ajax_return_values()
   {
          $this->ajax_return_values_cp_priorizar_previsto();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- cp_priorizar_previsto
   function ajax_return_values_cp_priorizar_previsto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cp_priorizar_previsto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cp_priorizar_previsto);
              $aLookup = array();
              $this->_tmp_lookup_cp_priorizar_previsto = $this->cp_priorizar_previsto;

$aLookup[] = array(contr_item_custos_pack_protect_string('1') => str_replace('<', '&lt;',contr_item_custos_pack_protect_string("")));
$_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['Lookup_cp_priorizar_previsto'][] = '1';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['cp_priorizar_previsto']) && !empty($this->NM_ajax_info['select_html']['cp_priorizar_previsto']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['cp_priorizar_previsto']);
          }
          $this->NM_ajax_info['fldList']['cp_priorizar_previsto'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => false,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-cp_priorizar_previsto',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['cp_priorizar_previsto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['cp_priorizar_previsto']['valList'][$i] = contr_item_custos_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['cp_priorizar_previsto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['cp_priorizar_previsto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['cp_priorizar_previsto']['labList'] = $aLabel;
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['upload_dir'][$fieldName][] = $newName;
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
//
function buscarCotacaoDolarVendaBC($serieParam = 1, $tempo = 3, $tipoRetorno = 'valor', $logHist = true, $logForcarBusca = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirHistCotacaoBc($serie, $data, $valor, $nome, $logOk)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    if (strstr($data, '/') <> false) {
        $data = $this->nm_conv_data_db($data, 'dd/mm/aaaa', 'aaaa-mm-dd');
    }
    $nome = retirarAcento($nome);
    $valor = str_replace(',', '.', $valor);
    $cmd = " insert into pub.hist_cotacoes_bc(hist_cotacao_bc_id,serie,data,valor,dt_hr_busca,nome_serie,log_ok)
            values(pub.seq_hist_cotacao_bc.NEXTVAL,$serie,'$data','$valor',NOW(),'$nome',$logOk)";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosCotacaoHoje($serieParam = 1)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $data = date('Y-m-d');
    $aRet = $this->getDadosHistCotacoesBc(0,
        'top 1 valor  as valor,nome_serie,data',
        " serie = $serieParam and data = '$data' and (log_ok = 1 or log_manual = 1) order by hist_cotacao_bc_id desc");
    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVlCotacaoHoje($serie = 1)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $valor = 0;
    $aDados = $this->getDadosCotacaoHoje($serie);
    if (is_array($aDados)) {
        $valor = $aDados['valor'];
    }
    return $valor;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosUltCotacao($serie = 1)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosHistCotacoesBc($id, $campos = '', $filtro = '')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrCotacaoDia($serie = 1)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logAtu = false;
    $vl = $this->getVlCotacaoHoje($serie);
    if ($vl == 0) {
        $vl = $this->atualizarCotacaoDia($serie);
        $logAtu = true;
    }
    $aRetorno = array('valor' => $vl, 'log_atu' => $logAtu);
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarCotacaoDia($serie, $valor = 0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aCotacao = $this->getCotacaoEms5($indicador, $data);
    $logAchou = $aCotacao['log_achou'];
    if ($logAchou == 0) {
        $this->inserirCotacaoEms5($indicador, $data, $valor);
    } else {
        $this->atualizarCotacaoEms5($indicador, $data, $valor);
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $cotacaoPeriodoAtu = util_incr_valor($cotacaoPeriodoAtu, $vlCotacao, ";");
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
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCotacaoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCotacoesPeriodoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $cotacaoPeriodo = util_incr_valor($cotacaoPeriodo, $vlCotacao, ";");
        }
    }
    $aRetorno = array('cotacao_periodo' => $cotacaoPeriodo, 'log_achou' => $logAchou);
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCotacaoEms5($serie, $data)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirCotacaoEms5($serie, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirCotacaoEms2($serie, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
    $cotacao = util_incr_valor($cotacao, $vlRepet,'');
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
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarCotacaoEms($serie, $data, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $indicador = $this->convSerieEmIndicador($serie, 'ems2');
    $this->sincrCotacaoEms2($indicador, $data, $valor);
    $indicador = $this->convSerieEmIndicador($serie, 'ems5');
    $this->sincrCotacaoEms5($indicador, $data, $valor);


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convSerieEmIndicador($serie, $destino)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function diaDaSemana($data,$retorno=0,$formato='aaaa-mm-dd')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
     
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function converterDataBra($data)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aData = explode("-",$data);
    return $aData[2]."/".$aData[1]."/".$aData[0];



$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function converterHoraEmMinutos($hora)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $aQtMinutos = explode(':',$hora);
    if(is_array($aQtMinutos) and count($aQtMinutos) == 3){
        $qtMinutos = $aQtMinutos[0] * 60 + $aQtMinutos[1] + $aQtMinutos[2] / 60;
    }
    else{
        $qtMinutos = 0;
    }
    return $qtMinutos;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function converterMinutosEmHoras($minutos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $hora = round($minutos / 60,0);
    if($hora < 1){
        $hora = 0;
    }
    $hora = preencherZerosAEsquerda ($hora,2);
    $min =  round($minutos % 60,0);
    $min = preencherZerosAEsquerda ($min,2);
    $formato_hora = "$hora:$min:00";
    return $formato_hora;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getParteDataAMD($data,$parte)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
$dolarMedio = 0;
$log = '';
$aDolar = $this->buscarDolar($container,'compra',true);
$vlCotacaoSaldo = $aDolar['cotacao'];
$histDolar      = $aDolar['hist_origem'];
$log     = "<h1>Inicio</h1>";
$log    .= "<h1>Container:$container - Cotacao Saldo:" . formatarNumero($vlCotacaoSaldo,5);
    $log    .= "<h2>Hist: $histDolar</h2>";

    $totCustoPrevDolar = $this->buscarTotCustoPrevDolarContainer($container);

    $log .= "<h1>Total Previsto em Dolar ->". formatarNumero($totCustoPrevDolar)." </h1>";


    $vlTotPagoDolar     = $this->buscarTotPagoContainer($container,'dolar');
    $vlTotPagoReal      = $this->buscarTotPagoContainer($container);
    $log.= "<h1>Dólar Pago:". formatarNumero($vlTotPagoDolar) ."</h1>";
    if($vlTotPagoDolar > 0 and $vlTotPagoReal > 0){
    $vlMediaPgtos			= $vlTotPagoReal / $vlTotPagoDolar;
    $log.="<h1>Media Pagtos: vl.tot.pago em real(".formatarNumero($vlTotPagoReal)
        ."  ) / vl.tot.pago em dolar(". formatarNumero($vlTotPagoDolar)  .")  -> ".
        formatarNumero($vlMediaPgtos,5)  ."</h1>";
    }
    else{
    $vlMediaPgtos = 0;
    $log .="<h1>Media Pagtos: Valor pago em Real Ou em Dolar zerado  ->0</h1>";
    }
    
    
    $aTotDescontoCreditosUtiliz      = buscarDescontosCreditosUtiliz($container);
    $vlDescontoCredUtilizREAL        = $aTotDescontoCreditosUtiliz[0]['tot_real_utiliz'];
    $vlDescontoCredUtilizDOLAR       = $aTotDescontoCreditosUtiliz[0]['tot_dolar_utiliz'];
    $log .= "<h1>Valor Desconto Cred. Utilizado em REAL:". formatarNumero($vlDescontoCredUtilizREAL) ."</h1>";
    $log .= "<h1>Valor Desconto Cred. Utilizado em DOLAR:". formatarNumero($vlDescontoCredUtilizDOLAR) ."</h1>";

    


    if($vlDescontoCredUtilizREAL == 0){
		$log .= "<h1>Valor Desconto Cred. Utilizado em REAL igual a zero</h1>";
		if($vlMediaPgtos > 0){
		$log.="<h1>Valor Desconcto Cred. Utilizado em REAL maior que zero</h1>";
		$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * $vlMediaPgtos;
		$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
			formatarNumero($vlDescontoCredUtilizDOLAR)  .") * Vl.media Pagtos(".
			formatarNumero($vlMediaPgtos,5) .") -> ".
			formatarNumero($vlDescontoCredUtilizREAL)  ."</h1>";
		}
		else{
			if($vlCotacaoSaldo > 0){
			$log.="<h1>Valor cotacao saldo maior que zero e media de pagamento igual a zero</h1>";
			$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * $vlCotacaoSaldo;
			$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
				formatarNumero($vlDescontoCredUtilizDOLAR) .") * Vl.cotacao Saldo(".
				formatarNumero($vlCotacaoSaldo,5).") ->". formatarNumero($vlDescontoCredUtilizREAL)." </h1>";
			}
			else{
			$log.="<h1>Valor cotacao igual a zero e media de pagamento igual a zero</h1>";
			$vlDescontoCredUtilizREAL = $vlDescontoCredUtilizDOLAR * 1;
			$log.="<h1>Valor Desconto Cred. Utilizado em REAL = vl.desconto Cred. Utiliz.Dolar(".
				formatarNumero($vlDescontoCredUtilizDOLAR)
				.") * 1 -> ".
				formatarNumero($vlDescontoCredUtilizREAL)
				."</h1>";
			}
		}
    }
    $aTotDescontoUtiliz 				  = buscarDescontosUtiliz($container);
    $vlDescontoUtilizDOLAR 		 	  	  = $aTotDescontoUtiliz[0]['tot_dolar'];
    $vlDescontoUtilizREAL   			  = $aTotDescontoUtiliz[0]['tot_real'];
    $log.="<h1>Desconto Utilizado em DOLAR(".
        formatarNumero($vlDescontoUtilizDOLAR)."</h1>";
    $log.="<h1>Desconto Utilizado em REAL(".formatarNumero($vlDescontoUtilizREAL)."</h1>";

    

    if($vlDescontoUtilizREAL == 0){
    $log.="<h1>Desconto Utilizado em REAL igual a zero</h1>";
        if($vlMediaPgtos > 0){
        $log.="<h1>Vl. Media de Pagtos maior que zero</h1>";
        $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * $vlMediaPgtos;
        $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR(".
            formatarNumero($vlDescontoUtilizDOLAR) .") * vl.Media Pagtos( ".
            formatarNumero($vlMediaPgtos,5) .") -> ".
            formatarNumero($vlDescontoUtilizREAL)  ."</h1>";
        }
        else{
        $log.="<h1>Vl.Média de Pagtos igual a zero</h1>";
            if($vlCotacaoSaldo > 0){
            $log.="<h1>Vl.Cotacao de saldo Maior que zero</h1>";
            $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * $vlCotacaoSaldo;
            $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR( ".
                formatarNumero($vlDescontoUtilizDOLAR) .") * vl.Cotacao Saldo(". formatarNumero($vlCotacaoSaldo)  .") ->".
                formatarNumero($vlDescontoUtilizREAL)  ."</h1>";
            }
            else{
            $log .= "<h1>Vl.Cotacao igual a zero</h1>" ;
            $vlDescontoUtilizREAL = $vlDescontoUtilizDOLAR * 1;
            $log.="<h1>Desconto Utilizado em REAL = vl.desconto utiliz. DOLAR(".
                formatarNumero($vlDescontoUtilizDOLAR) .") * 1 -> ".formatarNumero($vlDescontoUtilizREAL) ."</h1>";

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
        formatarNumero($totCustoPrevDolar)." - Vl.Desconto Cred.Utiliz.Dolar(".formatarNumero($vlDescontoCredUtilizDOLAR)."(
        - Vl.Desconto Utiliz.Dolar(".formatarNumero($vlDescontoUtilizDOLAR).") - Vl.Tot.Pago.Dolar(". formatarNumero($vlTotPagoDolar).") ->".
        formatarNumero($vlSaldoDOLAR)."</h1>";


    if($vlSaldoDOLAR > 0){
    $log .= "<h1>Vl.Saldo Em Dolar maior que zero</h1>";
    $vlSaldoREAL  =  $vlSaldoDOLAR * $vlCotacaoSaldo;

    $log .= "<h1>Vl.Saldo Em Real = vl. Saldo em Dolar(".
        formatarNumero($vlSaldoDOLAR) .") * vl.cotacao saldo(".
        formatarNumero($vlCotacaoSaldo) .") -> ".formatarNumero($vlSaldoREAL)." </h1>";
    $vlTotalREAL  =  $vlTotPagoReal + $vlDescontoCredUtilizREAL  + $vlDescontoUtilizREAL +   $vlSaldoREAL;
    $log.="<h1>vl.total real = vl.tot.pago real(".
        formatarNumero($vlTotPagoReal). ") + vl.desc.cred.utiliz. em Real(".
        formatarNumero($vlDescontoCredUtilizREAL).")
        + vl.desc.utiliz. em Real(".
        formatarNumero($vlDescontoUtilizREAL).") ->". formatarNumero($vlTotalREAL)."</h1>";
    }
    else{
    $log .= "<h1>O Saldo em dolar está zerado</h1>";
    $vlTotalREAL  =  $vlTotPagoReal + $vlDescontoCredUtilizREAL  + $vlDescontoUtilizREAL;
    $log.="<h1> vl.Total em Real = vl.tot.pago real(".
        formatarNumero($vlTotPagoReal)." ) + vl.desconto Cred. Utiliz. em Real(".
        formatarNumero($vlDescontoCredUtilizREAL).") +
        vl.desconto utiliz. em REAL(".
        formatarNumero($vlDescontoUtilizREAL) .") ->". formatarNumero($vlTotalREAL)."</h1>";
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
            formatarNumero($vlTotalREAL) .") / tot.custo.previsto dolar(".
            formatarNumero($totCustoPrevDolar) .")->".formatarNumero($dolarMedio,5)."</h1>";
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $cmd = " update \"pp-container\" set dt_prev_embarque = '$dtPrevEmbarque' 
			where \"nr-container\" = $containerID ";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $listaContainer = util_incr_valor($listaContainer,$container);
        }
    }
    return $listaContainer;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarRegCtaCorrenFornec($fornecedorId,$data,$itemProcCompraId,$historico,$codTipoMovto,$vlLancto,
                                 $codAcao,$numIdTitAp=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
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
        inserirLogDb('Comando',$cmd,__FUNCTION__);
        
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $logCriar;
if (isset($this->sc_temp_transacao_universal)) { $_SESSION['transacao_universal'] = $this->sc_temp_transacao_universal;}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function alterarFornecItensPed($pedido,$fornec)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aItens =  $this->getIDItensProcCompra($pedido);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompra = $aItens[$i]['item_proc_compra_id'];
            $cmd = "update pub.cta_corren_fornec_imp set fornecedor_id = $fornec 
            where item_proc_compra_id = $itemProcCompra ";
        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verifTitPedImp($numIdTitulo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarPgtosContainerPedImp($containerParam,$descOrigem='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
    setTransacaoUniversal($transacaoId);
    $listaTitulos = $this->buscarTitAssociadosContainer($containerParam);
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarPagtosContainerSemItens($containerParam,$histCompl,$itemContainerParam=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logExiste = $this->existItensContainer($containerParam);
    $descLogExiste = convLogEmString($logExiste);
    inserirLogDb('Inicio Log funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Existem Itens associados ao container?',$descLogExiste,__FUNCTION__);
    $data      = date('Y-m-d');
    if($logExiste == false){
        $transacaoId = iniciarTransacao('estornarPgtosContainerPedImp');
        setTransacaoUniversal($transacaoId);
        inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $listaTitulos = $this->buscarTitAssociadosContainer($containerParam);
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
                            $descRetCriacao = convLogEmString($retCriacao);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarPagtosItemContainer($itemContainerId,$histCompl)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPagtosItemContainer');
    setTransacaoUniversal($transacaoId);
    $data      = date('Y-m-d');
    inserirLogDb("transacao",$transacaoId,__FUNCTION__);
    $aReg = $this->getSomasCtaCorrenFornec(5,true,0,0,$itemContainerId);
    $descAReg = convArrayToString($aReg);
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
            $descrRetCriacao = convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 6 e acao 3',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
        decrNivelCorrenteLogDb();
    }
    finalizarTransacao($transacaoId);
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarTitAssocPedImp($numIdTitulo,$descOrigem='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logAssociado = $this->verifTitPedImp($numIdTitulo);
    $descrLogAssociado = convLogEmString($logAssociado);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Titulo associado a algum Pedido de Compra e que tenha gerado movto cta corrente fornecedor?',
        $descrLogAssociado,__FUNCTION__);
    if($logAssociado == true){
        $aRet =  $this->getSomasCtaCorrenFornec('4', 
            true,$numIdTitulo);
        $descARet = convArrayToString($aRet);
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
                $descrRetCriacao = convLogEmString($retCriacao);
                inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 1 - movto negativo',
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);
            }


            decrNivelCorrenteLogDb();
        }
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarPagtosContainer($nivel, $id,$histCompl='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $arrayTxt = convArrayToString($aReg);
            inserirLogDb("Array Titulos do container:$id",$arrayTxt,__FUNCTION__);

            if(is_array($aReg)){
                $tam = count($aReg);
                incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    $titulo = $aReg[$i]['num_id_tit_ap'];
                    inserirLogDb('titulo encontrado?',$titulo,__FUNCTION__);
                    $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$titulo);
                    $arrayTxt = convArrayToString($aSaldo);
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
                            $descrRetCriacao = convLogEmString($retCriacao);
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
            $arrayTxt = convArrayToString($aSaldo);
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
                    $descrRetCriacao = convLogEmString($retCriacao);
                    inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                        "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                }
            }
            break;
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSomasCtaCorrenFornec($tipoMovto,
                                 $logQuebra,
                                 $numIdTitulo=0,
                                 $itemPedId=0,
                                 $itemContainerId=0,
                                 $fornecId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $quebraCampos  = '';
    $quebraGroup   = '';
    $condTitulo    = '';
    $condItemPed   = '';
    $condContainer = '';
    $condFornec    = '';

    if($logQuebra == true){
        if($numIdTitulo == 0){
            $quebraCampos = util_incr_valor($quebraCampos,'num_id_tit_ap',",");
            $quebraGroup = util_incr_valor($quebraGroup,'num_id_tit_ap',",");
        }
        if($itemPedId == 0){
            $quebraCampos = util_incr_valor($quebraCampos,'item_proc_compra_id',",");
            $quebraGroup = util_incr_valor($quebraGroup,'item_proc_compra_id',",");
        }
        if($itemContainerId == 0){
            $quebraCampos = util_incr_valor($quebraCampos,'item_container_id',",");
            $quebraGroup  = util_incr_valor($quebraGroup,'item_container_id',",");
        }
        if($fornecId == 0){
            $quebraCampos = util_incr_valor($quebraCampos,'fornecedor_id',",");
            $quebraGroup = util_incr_valor($quebraGroup,'fornecedor_id',",");
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function estornarSaldoPgtosItemPed($itemPedido,$historico='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $descrRetCriacao = convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 3 - movto negativo',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarSaldoInicialFornec($fornec)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $retorno = false;
    $tabela = " pub.cta_corren_fornec_imp  ";
    $campo  = "fornecedor_id";
    $condicao = " fornecedor_id = $fornec and cod_tipo_movto = 1 ";
    $aResultado = $this->retornoSimplesTb01($tabela,$campo	,$condicao,"espec");
    if(is_array($aResultado)){
        $retorno = true ;
    }
    return $retorno;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarVlPagarItemPedido($itemProcCompra,$vlLancto,$acao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $data = date('Y-m-d');
    $procCompraID = $this->buscarProcCompraItem($itemProcCompra);
    $aPedido = $this->getDadosPedidoImp($procCompraID);
    $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    $descLogGerarPrevisao = convLogEmString($logGerarPrevisao);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb("Pedido de Compra $procCompraID integra cta.corrente fornecedor? ",$descLogGerarPrevisao,__FUNCTION__);
    if($logGerarPrevisao == 1) {
        $transacaoId = iniciarTransacao('gerarVlPagarItemPedido');
        setTransacaoUniversal($transacaoId);
        inserirLogDb('Transacao',$transacaoId,__FUNCTION__);
        $vlSaldo = $this->getSaldoVlPagarItemPedido($itemProcCompra);
        $fornecedor = $this->buscarFornecItemProcCompra($itemProcCompra);
        inserirLogDb("Fornecedor Item do Pedido", $fornecedor,__FUNCTION__);
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
            $descrRetCriacao = convLogEmString($retCriacao);
            inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $acao",
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
        }
        finalizarTransacao($transacaoId);
    }else{
        inserirLogDb('Lancamento nao gerado',
            'pedido de compra configurado para nao integrar conta corrente fornecedor ',__FUNCTION__);
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoVlPagarItemPedido($itemProcCompra)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrRateioAntecipPedImp($procCompra,$histCompl,$logForcarRateio = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl='',$logEstorno=false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $titLog = "Geracao de Rateio Pgtos - Ped.Imp";
    $data   = date('Y-m-d');
    $empImp = $this->buscarEmpProcCompra($procCompra);
    $codEmp  = $this->buscarcodEmpresa($empImp,'importacao','ems5');
    $codEstab = $this->getEstabEms5($codEmp) ;
    $vlAdiantDolar  =   buscarVlMoeda($numIdTitAp,'','dolar' );
    $vlNegEmDolar   = $this->buscarPonderacaoItensProcCompra($procCompra);
    $aItens = $this->getIDItensProcCompra($procCompra);
    $fornecedor         = $this->buscarFornecedorProcCompra($procCompra);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb("Fornecedor do pedido de compra",$fornecedor,__FUNCTION__);
    incrNivelCorrenteLogDb();
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId   = $aItens[$i]['item_proc_compra_id'];
            $vlItem             = $this->buscarPonderacaoItensProcCompra($procCompra,'negociado',$itemProcCompraId);
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
                $descrRetCriacao = convLogEmString($retCriacao);

                inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $codAcao",
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);

            }
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atuRatPagtoPedTitContainer($numIdTitAp, $histCompl='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atuRatPagtoPedItemContainer($itemPedido,$histCompl)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $procCompraId = $this->buscarProcCompraItem($itemPedido) ;
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoFornecAntItem($fornec, $numIdTitAp,$itemProcCompra )
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoFornecTituloItemRatContainer($fornec, $numIdTitAp,$itemProcCompra,$itemContainerId )
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarRateioFornecAntecipsContainer($container,$histCompl='',$logEstorno=false,$titulo=0,$itemContainer=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $data = date('Y-m-d');
    $vlProformaEmDolar  = $this->buscarTotCustoPrevDolarContainer($container, 'proforma');
    $codFornecContainer = $this->buscarFornecedorContainer($container);
    $estab         = $this->buscarEstabContainer($container);
    $estab          = $this->getEstabEms5($estab);
    $listaTitulos     = $this->buscarTitAssociadosContainer($container);
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
                $aItens     = $this->buscarIDItensContainer($container);
                $descAItens = convArrayToString($aItens);
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
                        $vlProformaItem        = $this->buscarTotCustoPrevDolarContainer($container,'proforma',$itemContainerId);
                        $itemProcCompraId = $aItens[$j]['item_proc_compra_id'];
                        inserirLogDb('Id  item ped.imp.',$itemProcCompraId,__FUNCTION__);
                        $descItem         = $this->buscarDescItemProcCompra($itemProcCompraId);
                        $codFornecPedImp  = $this->buscarFornecItemProcCompra($itemProcCompraId);
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
                        $descLogEstorno = convLogEmString($logEstorno);
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
                            $descrRetCriacao = convLogEmString($retCriacao);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarRateioFornecContainer($container, $tipoMovto)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vlNegEmDolar  = $this->buscarTotCustoPrevDolarContainer($container, 'negociado');
    $vlPagoEmDolar = $this->buscarTotPagoContainer($container,'dolar');
    $codFornecContainer = $this->buscarFornecedorContainer($container);
    $data = date('Y-m-d');
    $aItens = $this->buscarIDItensContainer($container);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i<$tam;$i++){
            $itemContainerId  = $aItens[$i]['item_container_id'];
            $vlNegItem        = $this->buscarTotCustoPrevDolarContainer($container, 'negociado',$itemContainerId);
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
                        $descrRetCriacao = convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 - negativo ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto,0 );
                        $descrRetCriacao = convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        break;
                    case 2: 
                        $historico = "ESTORNO da Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                         $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto ,0);
                         $descrRetCriacao = convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        break;
                }
            }
        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoAntCtaCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aDados = $this->getDadosCtaCorrenFornecImp($fornecedor,'vl_lancto','cod_tipo_movto = 1' );
    if(is_array($aDados)){
        $vlSaldoAnterior = $aDados[0]['vl_lancto'];
    }else{
        $vlSaldoAnterior = 0;
    }
    return $vlSaldoAnterior;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTotLancManualFornecImp($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCpSomaSaldoPorSitContainer()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoNaoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSaldoEntreguePortoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosCtaCorrenFornecImp($fornecedor,$campos='',$cond='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','cta_corren_fornec_imp');
        $campos = $aCampos['campos'];
    }
    $condicao = '';
    $condicao =  util_incr_valor($condicao, " fornecedor_id = $fornecedor ", " AND ",
            true) ;

    if($cond <> ''){
        $condicao =  util_incr_valor($condicao, $cond, " AND ",true) ;
    }
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    return $aReg;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function eliminarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    inserirLogDb('Inicio',__FUNCTION__,__FUNCTION__);
    $aItens = $this->getIDItensProcCompra($pedImp);
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function ajustarCtaCorrenFornec()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
    $aItens = $this->getIDItensProcCompra($pedImp);
    inserirLogDb('chamei a getIDItensProcCompra -> pedido',$pedImp,__FUNCTION__);
    if(is_array($aItens)){
        incrNivelCorrenteLogDb();
        inserirLogDb('ACHEI itens no pedido de compra ',$pedImp,__FUNCTION__);
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            inserirLogDb('item proc compra',$itemProcCompraId,__FUNCTION__);
            $listaItensPedido = util_incr_valor($listaItensPedido,$itemProcCompraId);
            inserirLogDb('chamei a retornarCampoItemProcCompra -> pedido',$itemProcCompraId);
            $aDadosItem =  $this->retornarCampoItemProcCompra($itemProcCompraId,'qt_comprada,vl_negociado');
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
            inserirLogDb('vou chamar a funcao $this->getIdContainersAlocItemPedImp(itemPedido)',"($itemPedido)",__FUNCTION__);
            $listaContainers = $this->getIdContainersAlocItemPedImp($itemPedido);
            inserirLogDb('Lista de Containers - retorno getIdContainerAlocItemPedImp',$listaContainers);
            $aContainers = explode(',',$listaContainers);
            if($listaContainers <> ''){
                $listaContainersGeral = util_incr_valor($listaContainersGeral,$listaContainers,',');
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
              $aItensContainer = $this->buscarIDItensContainer($containerEmb);
              if(is_array($aItensContainer)){
                  inserirLogDb('Itens Encontrados?','SIM',__FUNCTION__);
                  $tam3 = count($aItensContainer);
                  incrNivelCorrenteLogDb();
                  for($j=0;$j< $tam3; $j++){
                      $itemContainerId = $aItensContainer[$j]['item_container_id'];
                      inserirLogDb('item do container - vou chamar a funcao $this->sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
                      $this->sincrQtEmbarcadaCtaCorrenFornec($itemContainerId);
                      inserirLogDb('item do container - apos chamar a funcao $this->sincrQtEmbarcadaCtaCorrenFornec(itemContainer)',$itemContainerId,__FUNCTION__);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarLanctosPedidosIntegrCtaCorrente()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('vou chamar a funcao $this->getProcsCompraIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = $this->getProcsCompraIntegrCtaFornec();
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function eliminarLanctosPedidosNaoIntegrCtaCorrente()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb('vou chamar a funcao $this->getProcsCompraNaoIntegrCtaFornec()','SIM',__FUNCTION__);
    $listaPedidos = $this->getProcsCompraNaoIntegrCtaFornec();
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDeParaSitCta($sitCta)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRetorno = array();
    $lAchou = 0;
    $aDesp = buscarDespesaLogImpostoOuCalc($despesaId);
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


            $memoriaCalculo   = util_incr_valor($memoriaCalculo,$memVls,"<br>") ;
            $memoriaCalculo   = util_incr_valor($memoriaCalculo,$histOrigemDolar,"<br>") ;
            $memoriaCalculo   = util_incr_valor($memoriaCalculo,$aValsDesp['memoria_calculo'],"<br>") ;
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $lista    = '';
    $tabela   = " pub.despesas_container ";
    $campos   = " despesa_id ";
    $condicao = " log_manual = 0 and container_id = $container";
    $aRet     = $this->getDados('multi',$tabela,$campos,$condicao,"espec");
    if(is_array($aRet)){
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aRet[$i]['despesa_id'];
            $lista = util_incr_valor($lista,$despesaId,',');
        }
    }
    return $lista;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaId = getIdsRelacDespCalculadas($despesaId);
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
            $descrDesp = buscarDespesaDescr($despesaIDRelac);
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
            $html = util_incr_valor($html,$linha,'');
        }
    }
    $linha = "<tr><td></td><td>TOTAL</td><td>$totPrev</td><td>$totProforma</td><td>$totNegociado</td></tr>";

    $html = util_incr_valor($html,$linha,'');

    $html = util_incr_valor($html,'</table>','');

    $aRetorno = array('vl_prev' => $totPrev,'vl_proforma' => $totProforma,'vl_negociado' => $totNegociado,
        'memoria_calculo' => $html);
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $empresa  = $this->buscarEmpContainer($containerId);
    $aRetorno = buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId 	= $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao 	= $aRetorno[$i]['emp_desp.vl_padrao'];
            $percCalculo    = $aRetorno[$i]['desp.perc_calculo'];
            $this->sincrDespesaContainer($containerId,$despesaId,$valorPadrao,0,0,
                0,0,'',$percCalculo);
            
        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }else{
        $retorno = 'Campos não informados';
    }
    return $retorno;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $id;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_container ", " max(calc_imp_container_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) { $_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
     
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
    

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $despesaId = $this->buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $vlDespesa= 0;
    $dolarImp = 0;
    $vlPrev   = 0;
    $vlImp    = 0;
    $descrImposto = buscarDespesaDescr($imposto);
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


    $aDespesas   =  buscarDespesasImposto($imposto,$empresa);
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

            $logImposto = buscarDespesaLogImpostoOuCalc($despesaImp);
            
            if($lSemCalcImposto == false){
                $vlDespesa += $valor;
            }
            else{
                $vlDespesa += $vlImp;
            }
            $descrDespesa = buscarDespesaDescr($despesaImp);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $descDespesaImposto = buscarDespesaDescr($despesaId);
            $descDespesa = buscarDespesaDescr($despesaId);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    if($idCalculo == ''){
        $novoCalculo = $this->criarCalculoImpContainer($container_id);
    }
    else{
        $novoCalculo = 	$idCalculo;
    }


    $empresa     = $this->buscarEmpContainer($container_id);
    $aImpostos    = buscarImpostosEmpresa($empresa);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
            $memoria = util_incr_valor($memoria,
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
                $memoria    = util_incr_valor($memoria,$aVlImposto['memoria'],'',true);
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
            $memoria = util_incr_valor($memoria,
                '<h1>2-Itens NÃO Encontrados para o Container</h1>','');
            $aRetorno = array('log_calc_imp'=> false,'memoria'=>$memoria,'itens_ipi' =>'');

        }
    }else{

        $memoria = "<h1>1-Despesa de IPI Não cadastrada para o estabelecimento do Container </h1>";
        $aRetorno = array('log_calc_imp'=> false,'memoria'=>$memoria,'itens_ipi' =>'');

    }
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


            $memoria     = util_incr_valor($memoria,"<h1>% IPI: $percIpi </h1>",'');
            $memoria     = util_incr_valor($memoria,
                "<h1>vl.Item $itemContainerId -> Trib.: $vlItemTrib - Prof.:$vlItemPro - Neg.:$vlItemNeg  </h1>",
                '');
            $memoria     = util_incr_valor($memoria,
                "<h1>Vl.IPI Trib: $vlIpiTrib -> Base: $vlDespTrib - Fator:$fatorTrib  </h1>",
                '');
            $memoria     = util_incr_valor($memoria,
                "<h1>Vl.IPI Proforma: $vlIpiPro -> Base: $vlDespPro - Fator:$fatorPro  </h1>",
                '');
            $memoria     = util_incr_valor($memoria,
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $memoriaBaseCalc = '<h1>Despesas da Base De calculo:</h1><table border="1"><tr><td>Imposto</td>
<td>Vl.Trib</td><td>Vl.Proforma</td><td>Vl.Neg</td></tr>';
    if($empresa ==0){
        $empresa    = $this->buscarEmpERPContainer($container,'importacao');
    }
    $aDespesas = buscarDespesasImposto($despesaId,$empresa);
    $totVlTrib = 0;
    $totVlNeg  = 0;
    $totVlPro  = 0;

    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despBaseCalc =$aDespesas[$i]['despesa_id'];
            $descrDesp    = buscarDespesaDescr($despBaseCalc);
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
            $memoriaBaseCalc = util_incr_valor($memoriaBaseCalc,$incremento,'');
        }
    }
    $memoriaBaseCalc .= "<tr><td>TOTAL</td><td>$totVlTrib</td><td>$totVlPro</td><td>$totVlNeg</td></tr>";
    $memoriaBaseCalc .= "</table>";
    $aRetorno = array('vl_tributado' => $totVlTrib,'vl_proforma' => $totVlPro,
                      'vl_negociado' => $totVlNeg, 'memoria'=>$memoriaBaseCalc);
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aReg = getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarRegDistrCusto($item_container_custo_id,$item_container_id,$historico,$cod_tipo_movto,$vl_lancto)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if(!$this->getParamDistrCusto()){
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
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $novoId = buscarVlSequenciaEspec('seq_cta_corren_custo_distr','cta_corren_custo_distr');
    return $novoId;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDadosCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $tabela = "pub.cta_corren_custo_distr";
    $campos = "data,item_container_custo_id,item_container_id,historico,cod_tipo_movto,vl_lancto";
    $condicao = "cta_corren_custo_distr_id = $id";
    $aRetorno = $this->retornoSimplesTb01 ($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarContainerCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarDespesaDistrCusto($idCtaCorrenCustoDistr,$valor,$itemContainerId=0,$container=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarVlDespesaDistrCusto($idCtaCorrenCustoDistr, $valor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logAtualizado = 0;
    $id = $this->buscarDespesaContainerDistrCusto($idCtaCorrenCustoDistr);
    if($id <> 0){
        $logAtualizado = 1;
        $this->atualizarVlDespesaContainerPorId($id,$valor);
    }
    return $logAtualizado;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarSaldoAtualDistrCusto()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $valor = 0;
    $tabela = "pub.cta_corren_custo_distr";
    $campo = "sum(vl_lancto) as saldo";
    $condicao = " 1=1 ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['saldo'];
    }
    return $valor;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularSaldoAnteriorDistrCusto($condicao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTotalDistrParaItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vlTotal = 0;
    $tabela   = " pub.cta_corren_custo_distr ";
    $campos   = " sum(vl_lancto) as tot ";
    $condicao = "  item_container_id = $itemContainerId and cod_tipo_movto = 4";
    $aDados = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aDados)){
        $vlTotal = $aDados[0]['tot'];
    }
    return $vlTotal;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTotalDistrPorItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVlDistrContainer($containerParam, $itemContainerParam='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarcodEmpresa($codigo,$sistOrigem,$sistDestino)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getEstabEms5($estab)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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



$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDescItem($itCodigo)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDescItem($itCodigo){
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('ems2med','item','"it-codigo"',
        "$itCodigo",'"desc-item" as desc_it');
    return $aReg;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaItCodigoPorDescricao($descricao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaItens = '';
    $aDados = $this->getDados('multi','pub.item','"it-codigo" as it_codigo',
             " \"desc-item\" like '%$descricao%' ",'ems2med');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $itCodigo = $aDados[$i]['it_codigo'];
            $listaItens = util_incr_valor($listaItens,"'$itCodigo'");
        }
    }
    return $listaItens;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
        $condicao = util_incr_valor($condFiltroCompl,$filtroCompl,' AND ',true);
    }

    $tabela   = "pub.$tabela";
    $tipo     = "unico"; 
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aRet[0];


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aCustoItens                    	 = array();
    $lAchou                              = false;
    $vlPagoItens                	     = $this->buscarTotPagoContainer($containerId);
    $aPondItens             	         = buscarValoresItensNFImp($containerId);
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
                $vlDistrParaItem  = $this->getTotalDistrParaItemContainer($itemContainerID);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $cmd = " update pub.item_container_custos set item_custo_id = $item_custo_id
			where item_container_custo_id = $item_container_custos_id";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaContainers = '';
    $aDados = $this->getDados('multi','pub.itens_container item','distinct container_id as container_id ',
                        "item_proc_compra_id = $itemPedImp","espec",
                        " pub.container  container on  container.container_id = item.container_id ");
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $container = $aDados[$i]['container_id'];
            $listaContainers = util_incr_valor($listaContainers,$container,',');
        }
    }
    return $listaContainers;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
                inserirLogDb('vou chamar a funcao $this->getSomasCtaCorrenFornec(tipoMovto,tem quebra?,num.titulo,item pedido,item container',
                    "sim (10,sim,0,0,$itemContainerParam)",__FUNCTION__);
                $aRealCtaCorrenFornec10 = $this->getSomasCtaCorrenFornec(10,true,
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
                    $this->criarRegCtaCorrenFornec($fornec,$data,$itemProcCompraId,
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarUltItemCusto($itCodigo,$container='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function calcularNovoCustoItem($container,$itemContainerId,$logPriorizarCustoPrevisto=0,$aDadosItemContainer='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
    $dtEmisNotaMae = buscarDtEmisNotaMaeContainer($container);
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
    $aCustoItemContainer  = buscarDadosUltVersaoCustoContainer($container,$itemContainerId);

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
    $aNotaMae = buscarNotaMaeContainer($container);
    if($qtConfirmEmbCusto <> 0){
        $qtContainer = $qtConfirmEmbCusto;
        $qtNotaMae   = $qtConfirmEmbCusto;
        
    }
    else{
        $qtContainer = $qtAlocadaCusto;
        $qtNotaMae   = 0; 
        


    }

    if(!is_array($aNotaMae)){

        $aVersao = getDadosVersaoCorrenteContainer($container);
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirItemCustosTipoContainer($dtHrCusto, $vlUnitNovo, $itCodigo, $qtEstoque, $qtNfMae,
                                        $qtEtiqContainer, $vlUnitAnterior,$vlUnitContainer,
                                        $qtContainer )
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $seq = buscarVlSequenciaEspec('seq_item_custos','item_custos');
    return $seq;
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirItemCustosTipoMedia($vlUnitNovo,$itCodigo,$qtEstoque,$vlUnitAnterior,
                                    $itCodigoMedia, $qtEstoqueMedia, $vlUnitMedia,
                                    $mediaCustoId=0,$memoriaCalculo='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getContainerItemCusto($itemCustoId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getItensCustoContainer($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
            $lista = util_incr_valor($lista,$idCusto);
        }
    }
    return $lista;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaIdsUltCusto()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaIds = '';
    $aDados = $this->getDados('multi','pub.item_custos',
        'max(item_custo_id) as item_custo_id,it_codigo',
        "1=1 group by it_codigo","espec");
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $itemCustoId = $aDados[$i]['item_custo_id'];
            $listaIds = util_incr_valor($listaIds,$itemCustoId,",","true");
        }
    }
    return $listaIds;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getQtItensMediaId($mediaId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $qt = 0;
    $aReg = $this->getReg('espec','item_custos','media_custo_id',
        $mediaId,'count(item_custo_id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = $this->buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $msg = '';
    $aRet = $this->getDados('unico','pub.itens_proc_compra',
        'top 1 item_proc_compra_id as item_proc_compra_id,vl_custo_dolar,vl_base_tributacao,vl_negociado',
    "proc_compra_id =$procCompraId and codigo_erp = '$itCodigo' and item_proc_compra_id <> $idCorrente and codigo_erp <> ''
    ");
    if(is_array($aRet)){
        $aRet = $aRet[0];
        $idItemProcCompra = $aRet['item_proc_compra_id'];
        if($aRet['vl_custo_dolar'] <> $vlCustoDolar and $aRet['vl_custo_dolar'] <> 0 ){
            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de custo de dolar diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_base_tributacao'] <> $vlBaseTributacao and $aRet['vl_base_tributacao'] <> 0){

            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de base de tributação diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_negociado'] <> $vlNegociado and $aRet['vl_negociado'] <> 0){

            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor negociado diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");
        }

    }
    return $msg;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vl = 0;
    $listaIDTitulos     = $this->buscarTitAssociadosContainer($containerId);
    
    $aTitulos 			  = explode(",",$listaIDTitulos);
    if(is_array($aTitulos)){
        for($i=0;$i < count($aTitulos);$i++){
            $titID = $aTitulos[$i];
            if($titID == ''){$titID = 0;}
            switch($moeda){
                case 'dolar':
                    $vl_tit_corrente = buscarVlMoeda($titID,'','dolar');
                    break;
                default:
                    $vl_tit_corrente = buscarVlMoeda($titID);
            }
            $vl += $vl_tit_corrente;
        }
    }
    return $vl;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vl = 0;
    $aTitulos = explode(",",$lista);
    if(is_array($aTitulos)){
        for($i=0;$i < count($aTitulos);$i++){
            $titID = $aTitulos[$i];
            if($titID == ''){$titID = 0;}
            switch($moeda){
                case 'dolar':
                    $vl_tit_corrente = buscarVlMoeda($titID,'','dolar');
                    break;
                default:
                    $vl_tit_corrente = buscarVlMoeda($titID);
            }
            $vl += $vl_tit_corrente;
        }
    }
    return $vl;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_container(num_id_tit_ap,container_id) values($numIdTitAp,$container)";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_container where num_id_tit_ap = $numIdTitAp and  container_id = $container" ;
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             if ($this->NM_ajax_flag)
             {
                contr_item_custos_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
    $cotacao = 0;
    $idUltTitulo = 0;
    $listaTitulos   = $this->buscarTitAssociadosContainer($container);
    $aTitulos       = explode(',',$listaTitulos);
    if(is_array($aTitulos) and $listaTitulos <> ''){
        $tam = count($aTitulos);
        $idUltTitulo = $aTitulos[$tam - 1];
        $vlTitDolar = buscarVlMoeda($idUltTitulo,'','dolar');
        $vlTitReal  = buscarVlMoeda($idUltTitulo,'','real');
        $cotacao = $vlTitReal / $vlTitDolar;

    }
    return $cotacao;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
if (!isset($this->sc_temp_fornecedor_container_corrente)) {$this->sc_temp_fornecedor_container_corrente = (isset($_SESSION['fornecedor_container_corrente'])) ? $_SESSION['fornecedor_container_corrente'] : "";}
   
    $filtroCompl = '';
    $lista = '';
    if(isset($this->sc_temp_fornecedor_container_corrente) and $this->sc_temp_fornecedor_container_corrente <> '' ){
        $filtroCompl = util_incr_valor($filtroCompl," \"cod-emit-forn\" = $this->sc_temp_fornecedor_container_corrente ",
            " AND");
    }


    $condicao = "pagtos_container.container_id = container.\"nr-container\" ";
    $condicao = util_incr_valor($condicao,$filtroCompl," AND ") ;

    $aDados = $this->getDados('multi','pub.pagtos_container pagtos_container, pub."pp-container" container',
        'num_id_tit_ap',$condicao,'espec');
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i< $tam; $i++){
            $titulo = $aDados[$i]['num_id_tit_ap'];
            $lista = util_incr_valor($lista,$titulo);
        }
    }
    return $lista;

if (isset($this->sc_temp_fornecedor_container_corrente)) { $_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarEmpProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " empresa_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){
        $empresa = $aRetorno[0]['empresa_id'];
    }
    return $empresa;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDescProcCompra($procCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $processo = '';

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " cod_proc_fornec, fornecedor_id ",
        " proc_compra_id = $procCompraId ","espec");
    if(is_array($aRetorno)){
        $processo = $aRetorno[0]['cod_proc_fornec'];
        $fornecedor = buscarDescFornecedor($aRetorno[0]['fornecedor_id']);
        $processo .= ' '. $fornecedor;
    }
    return $processo;



$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarFornecedorProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $fornecedor = 0;

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " fornecedor_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $fornecedor =$aRetorno[0]['fornecedor_id'];
    }
    return $fornecedor;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarDtRegProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $data = '2001-01-01';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " dt_registro ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $data =$aRetorno[0]['dt_registro'];
    }
    return $data;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarEmpERPProcCompra($procCompraIdParam,$sistema)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarCotPrevProcCompra($procCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'cotacao_prevista';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function buscarQtContainerProcCompra($procCompraId)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'qt_container';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function verificarADProcCompra($procCompraID)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDadosPedidoImp($id,$campos='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','procs_compra');
        $campos = $aCampos['campos'];
    }

    $tabela   = " pub.procs_compra ";
    $condicao = "  proc_compra_id = $id ";
    $aResult = $this->getDados('unico',$tabela,$campos,$condicao,"espec");
    return $aResult;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getProcsCompraCtaPorFornec($fornecedor)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','procs_compra','proc_compra_id',
        "fornecedor_id = $fornecedor and log_considerar_previsao = 1",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getProcsCompraIntegrCtaFornec()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra','proc_compra_id',
        " log_considerar_previsao = 1",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getProcsCompraNaoIntegrCtaFornec()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra','proc_compra_id',
        " log_considerar_previsao = 0",'espec');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['proc_compra_id'];
            $lista = util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function validarAltPedCompra($pedido)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $erro = '';
    $vl = buscarVlTotPagtoProcCompra($pedido);
    if($vl > 0 ){
        $erro = "Para alterar o fornecedor não pode existir nenhum pagamento associado";
    }
    return $erro;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function validacoesPedCompra($pedido)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $erro = $this->validarAltPedCompra($pedido);
    return $erro;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getFornecsPedImpGeraPrev()
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $lista = '';
    $aPeds = $this->getDados('multi','pub.procs_compra pedido',
        'distinct fornecedor_id as fornecedor_id',
        " log_considerar_previsao = 1",'multi',
    'comum.pub.emitente emit on pedido.fornecedor_id = emit."cod-emitente" ');
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam; $i++){
            $pedido = $aPeds[$i]['fornecedor_id'];
            $lista = util_incr_valor($lista,$pedido);
        }
    }
    return $lista;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='sysprogress',$logOdbc=true)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['contr_item_custos']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              contr_item_custos_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("contr_item_custos_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array(""))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['table_refresh'])
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

   function Form_lookup_cp_priorizar_previsto()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "?#?1?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

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
       $nmgp_saida_form = "contr_item_custos_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['nm_run_menu'] = 2;
       $nmgp_saida_form = "contr_item_custos_fim.php";
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
       contr_item_custos_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           contr_item_custos_pack_ajax_response();
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
       contr_item_custos_pack_ajax_response();
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
    <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
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
       if ($this->Ini->nm_db_especw)
       {
           $this->Ini->nm_db_especw->Close();
       }
       if ($this->Ini->nm_db_ems5w)
       {
           $this->Ini->nm_db_ems5w->Close();
       }
       if ($this->Ini->nm_db_comumw)
       {
           $this->Ini->nm_db_comumw->Close();
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
       exit;
   }
}
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "ok":
                return array("sub_form_b.sc-unique-btn-1");
                break;
            case "voltar":
                return array("sc_Voltar_bot");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . ""; } else { echo "Cálculo de Custo do Item - Seleção do P Unitário"; } ?> - 
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['contr_item_custos']['ordem_ord'] == " desc") {
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
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
