<?php
//
class form_cons_fornec_imp_apl
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
   var $id;
   var $cod_fornec_ini;
   var $cod_fornec_fim;
   var $data_ini;
   var $data_fim;
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
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['cod_fornec_fim']))
          {
              $this->cod_fornec_fim = $this->NM_ajax_info['param']['cod_fornec_fim'];
          }
          if (isset($this->NM_ajax_info['param']['cod_fornec_ini']))
          {
              $this->cod_fornec_ini = $this->NM_ajax_info['param']['cod_fornec_ini'];
          }
          if (isset($this->NM_ajax_info['param']['data_fim']))
          {
              $this->data_fim = $this->NM_ajax_info['param']['data_fim'];
          }
          if (isset($this->NM_ajax_info['param']['data_ini']))
          {
              $this->data_ini = $this->NM_ajax_info['param']['data_ini'];
          }
          if (isset($this->NM_ajax_info['param']['id']))
          {
              $this->id = $this->NM_ajax_info['param']['id'];
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
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['embutida_parms']);
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
                 nm_limpa_str_form_cons_fornec_imp($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['opc_ant']);
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_cons_fornec_imp_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_cons_fornec_imp']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_cons_fornec_imp']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_cons_fornec_imp'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cons_fornec_imp']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cons_fornec_imp']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_cons_fornec_imp') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_cons_fornec_imp']['label'] = "Consulta Fornecedores Importação";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_cons_fornec_imp")
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



      $_SESSION['scriptcase']['error_icon']['form_cons_fornec_imp']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_cons_fornec_imp'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "off";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "off";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_cons_fornec_imp']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_cons_fornec_imp'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_cons_fornec_imp'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form'];
          if (!isset($this->id)){$this->id = $this->nmgp_dados_form['id'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_cons_fornec_imp", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'form_cons_fornec_imp/form_cons_fornec_imp_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_cons_fornec_imp_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_cons_fornec_imp_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_cons_fornec_imp_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_cons_fornec_imp/form_cons_fornec_imp_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_cons_fornec_imp_erro.class.php"); 
      }
      $this->Erro      = new form_cons_fornec_imp_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao']))
         { 
             if ($this->id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_cons_fornec_imp']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_cons_fornec_imp']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_cons_fornec_imp']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->cod_fornec_ini)) { $this->nm_limpa_alfa($this->cod_fornec_ini); }
      if (isset($this->cod_fornec_fim)) { $this->nm_limpa_alfa($this->cod_fornec_fim); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- cod_fornec_ini
      $this->field_config['cod_fornec_ini']               = array();
      $this->field_config['cod_fornec_ini']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cod_fornec_ini']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cod_fornec_ini']['symbol_dec'] = '';
      $this->field_config['cod_fornec_ini']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cod_fornec_ini']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- cod_fornec_fim
      $this->field_config['cod_fornec_fim']               = array();
      $this->field_config['cod_fornec_fim']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['cod_fornec_fim']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['cod_fornec_fim']['symbol_dec'] = '';
      $this->field_config['cod_fornec_fim']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['cod_fornec_fim']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- data_ini
      $this->field_config['data_ini']                 = array();
      $this->field_config['data_ini']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['data_ini']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['data_ini']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'data_ini');
      //-- data_fim
      $this->field_config['data_fim']                 = array();
      $this->field_config['data_fim']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['data_fim']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['data_fim']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'data_fim');
      //-- id
      $this->field_config['id']               = array();
      $this->field_config['id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id']['symbol_dec'] = '';
      $this->field_config['id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['Gera_log_access'] = false;
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
          if ('validate_cod_fornec_ini' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_fornec_ini');
          }
          if ('validate_cod_fornec_fim' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cod_fornec_fim');
          }
          if ('validate_data_ini' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'data_ini');
          }
          if ('validate_data_fim' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'data_fim');
          }
          form_cons_fornec_imp_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_cod_fornec_ini_onblur' == $this->NM_ajax_opcao)
          {
              $this->cod_fornec_ini_onBlur();
          }
          if ('event_cod_fornec_ini_onclick' == $this->NM_ajax_opcao)
          {
              $this->cod_fornec_ini_onClick();
          }
          form_cons_fornec_imp_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_cons_fornec_imp_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_cons_fornec_imp_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_atualiz'] == "ok")
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
          form_cons_fornec_imp_pack_ajax_response();
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
          form_cons_fornec_imp_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_cons_fornec_imp.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Consulta Fornecedores Importação") ?></TITLE>
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
<form name="Fdown" method="get" action="form_cons_fornec_imp_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_cons_fornec_imp"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cons_fornec_imp', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cons_fornec_imp', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_cons_fornec_imp', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_cons_fornec_imp_pack_ajax_response();
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
           $this->Ini->nm_db_ticontrole->Close(); 
           $this->Ini->nm_db_especw->Close(); 
           $this->Ini->nm_db_ems5->Close(); 
           $this->Ini->nm_db_espec->Close(); 
           $this->Ini->nm_db_ems2ima->Close(); 
           $this->Ini->nm_db_ems2med->Close(); 
           $this->Ini->nm_db_comum->Close(); 
           $this->Ini->nm_db_multi->Close(); 
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
           case 'cod_fornec_ini':
               return "Fornecedor Inicial";
               break;
           case 'cod_fornec_fim':
               return "Fornecedor Final";
               break;
           case 'data_ini':
               return "Dt.Inicial";
               break;
           case 'data_fim':
               return "Dt.Final";
               break;
           case 'id':
               return "ID";
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
      if ((!is_array($filtro) && ('' == $filtro || 'cod_fornec_ini' == $filtro)) || (is_array($filtro) && in_array('cod_fornec_ini', $filtro)))
        $this->ValidateField_cod_fornec_ini($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_fornec_ini";

      if ((!is_array($filtro) && ('' == $filtro || 'cod_fornec_fim' == $filtro)) || (is_array($filtro) && in_array('cod_fornec_fim', $filtro)))
        $this->ValidateField_cod_fornec_fim($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cod_fornec_fim";

      if ((!is_array($filtro) && ('' == $filtro || 'data_ini' == $filtro)) || (is_array($filtro) && in_array('data_ini', $filtro)))
        $this->ValidateField_data_ini($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "data_ini";

      if ((!is_array($filtro) && ('' == $filtro || 'data_fim' == $filtro)) || (is_array($filtro) && in_array('data_fim', $filtro)))
        $this->ValidateField_data_fim($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "data_fim";

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

    function ValidateField_cod_fornec_ini(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cod_fornec_ini'])) {
          nm_limpa_numero($this->cod_fornec_ini, $this->field_config['cod_fornec_ini']['symbol_grp']) ; 
          return;
      }
      if ($this->cod_fornec_ini === "" || is_null($this->cod_fornec_ini))  
      { 
          $this->cod_fornec_ini = 0;
          $this->sc_force_zero[] = 'cod_fornec_ini';
      } 
      nm_limpa_numero($this->cod_fornec_ini, $this->field_config['cod_fornec_ini']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->cod_fornec_ini != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->cod_fornec_ini) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor Inicial: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['cod_fornec_ini']))
                  {
                      $Campos_Erros['cod_fornec_ini'] = array();
                  }
                  $Campos_Erros['cod_fornec_ini'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['cod_fornec_ini']) || !is_array($this->NM_ajax_info['errList']['cod_fornec_ini']))
                  {
                      $this->NM_ajax_info['errList']['cod_fornec_ini'] = array();
                  }
                  $this->NM_ajax_info['errList']['cod_fornec_ini'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->cod_fornec_ini, 10, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor Inicial; " ; 
                  if (!isset($Campos_Erros['cod_fornec_ini']))
                  {
                      $Campos_Erros['cod_fornec_ini'] = array();
                  }
                  $Campos_Erros['cod_fornec_ini'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['cod_fornec_ini']) || !is_array($this->NM_ajax_info['errList']['cod_fornec_ini']))
                  {
                      $this->NM_ajax_info['errList']['cod_fornec_ini'] = array();
                  }
                  $this->NM_ajax_info['errList']['cod_fornec_ini'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_fornec_ini';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_fornec_ini

    function ValidateField_cod_fornec_fim(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cod_fornec_fim'])) {
          nm_limpa_numero($this->cod_fornec_fim, $this->field_config['cod_fornec_fim']['symbol_grp']) ; 
          return;
      }
      if ($this->cod_fornec_fim === "" || is_null($this->cod_fornec_fim))  
      { 
          $this->cod_fornec_fim = 0;
          $this->sc_force_zero[] = 'cod_fornec_fim';
      } 
      nm_limpa_numero($this->cod_fornec_fim, $this->field_config['cod_fornec_fim']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->cod_fornec_fim != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->cod_fornec_fim) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor Final: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['cod_fornec_fim']))
                  {
                      $Campos_Erros['cod_fornec_fim'] = array();
                  }
                  $Campos_Erros['cod_fornec_fim'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['cod_fornec_fim']) || !is_array($this->NM_ajax_info['errList']['cod_fornec_fim']))
                  {
                      $this->NM_ajax_info['errList']['cod_fornec_fim'] = array();
                  }
                  $this->NM_ajax_info['errList']['cod_fornec_fim'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->cod_fornec_fim, 10, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor Final; " ; 
                  if (!isset($Campos_Erros['cod_fornec_fim']))
                  {
                      $Campos_Erros['cod_fornec_fim'] = array();
                  }
                  $Campos_Erros['cod_fornec_fim'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['cod_fornec_fim']) || !is_array($this->NM_ajax_info['errList']['cod_fornec_fim']))
                  {
                      $this->NM_ajax_info['errList']['cod_fornec_fim'] = array();
                  }
                  $this->NM_ajax_info['errList']['cod_fornec_fim'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cod_fornec_fim';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cod_fornec_fim

    function ValidateField_data_ini(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->data_ini, $this->field_config['data_ini']['date_sep']) ; 
      if (isset($this->Field_no_validate['data_ini'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['data_ini']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['data_ini']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['data_ini']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['data_ini']['date_sep']) ; 
          if (trim($this->data_ini) != "")  
          { 
              $validateTest = $teste_validade->Data($this->data_ini, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt.Inicial; " ; 
                  if (!isset($Campos_Erros['data_ini']))
                  {
                      $Campos_Erros['data_ini'] = array();
                  }
                  $Campos_Erros['data_ini'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['data_ini']) || !is_array($this->NM_ajax_info['errList']['data_ini']))
                  {
                      $this->NM_ajax_info['errList']['data_ini'] = array();
                  }
                  $this->NM_ajax_info['errList']['data_ini'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['data_ini']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'data_ini';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_data_ini

    function ValidateField_data_fim(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->data_fim, $this->field_config['data_fim']['date_sep']) ; 
      if (isset($this->Field_no_validate['data_fim'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['data_fim']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['data_fim']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['data_fim']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['data_fim']['date_sep']) ; 
          if (trim($this->data_fim) != "")  
          { 
              $validateTest = $teste_validade->Data($this->data_fim, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt.Final; " ; 
                  if (!isset($Campos_Erros['data_fim']))
                  {
                      $Campos_Erros['data_fim'] = array();
                  }
                  $Campos_Erros['data_fim'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['data_fim']) || !is_array($this->NM_ajax_info['errList']['data_fim']))
                  {
                      $this->NM_ajax_info['errList']['data_fim'] = array();
                  }
                  $this->NM_ajax_info['errList']['data_fim'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['data_fim']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'data_fim';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_data_fim

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
    $this->nmgp_dados_form['cod_fornec_ini'] = $this->cod_fornec_ini;
    $this->nmgp_dados_form['cod_fornec_fim'] = $this->cod_fornec_fim;
    $this->nmgp_dados_form['data_ini'] = (strlen(trim($this->data_ini)) > 19) ? str_replace(".", ":", $this->data_ini) : trim($this->data_ini);
    $this->nmgp_dados_form['data_fim'] = (strlen(trim($this->data_fim)) > 19) ? str_replace(".", ":", $this->data_fim) : trim($this->data_fim);
    $this->nmgp_dados_form['id'] = $this->id;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['cod_fornec_ini'] = $this->cod_fornec_ini;
      nm_limpa_numero($this->cod_fornec_ini, $this->field_config['cod_fornec_ini']['symbol_grp']) ; 
      $this->Before_unformat['cod_fornec_fim'] = $this->cod_fornec_fim;
      nm_limpa_numero($this->cod_fornec_fim, $this->field_config['cod_fornec_fim']['symbol_grp']) ; 
      $this->Before_unformat['data_ini'] = $this->data_ini;
      nm_limpa_data($this->data_ini, $this->field_config['data_ini']['date_sep']) ; 
      $this->Before_unformat['data_fim'] = $this->data_fim;
      nm_limpa_data($this->data_fim, $this->field_config['data_fim']['date_sep']) ; 
      $this->Before_unformat['id'] = $this->id;
      nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
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
      if ($Nome_Campo == "cod_fornec_ini")
      {
          nm_limpa_numero($this->cod_fornec_ini, $this->field_config['cod_fornec_ini']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "cod_fornec_fim")
      {
          nm_limpa_numero($this->cod_fornec_fim, $this->field_config['cod_fornec_fim']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "id")
      {
          nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
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
      if ('' !== $this->cod_fornec_ini || (!empty($format_fields) && isset($format_fields['cod_fornec_ini'])))
      {
          nmgp_Form_Num_Val($this->cod_fornec_ini, $this->field_config['cod_fornec_ini']['symbol_grp'], $this->field_config['cod_fornec_ini']['symbol_dec'], "0", "S", $this->field_config['cod_fornec_ini']['format_neg'], "", "", "-", $this->field_config['cod_fornec_ini']['symbol_fmt']) ; 
      }
      if ('' !== $this->cod_fornec_fim || (!empty($format_fields) && isset($format_fields['cod_fornec_fim'])))
      {
          nmgp_Form_Num_Val($this->cod_fornec_fim, $this->field_config['cod_fornec_fim']['symbol_grp'], $this->field_config['cod_fornec_fim']['symbol_dec'], "0", "S", $this->field_config['cod_fornec_fim']['format_neg'], "", "", "-", $this->field_config['cod_fornec_fim']['symbol_fmt']) ; 
      }
      if ((!empty($this->data_ini) && 'null' != $this->data_ini) || (!empty($format_fields) && isset($format_fields['data_ini'])))
      {
          nm_volta_data($this->data_ini, $this->field_config['data_ini']['date_format']) ; 
          nmgp_Form_Datas($this->data_ini, $this->field_config['data_ini']['date_format'], $this->field_config['data_ini']['date_sep']) ;  
      }
      elseif ('null' == $this->data_ini || '' == $this->data_ini)
      {
          $this->data_ini = '';
      }
      if ((!empty($this->data_fim) && 'null' != $this->data_fim) || (!empty($format_fields) && isset($format_fields['data_fim'])))
      {
          nm_volta_data($this->data_fim, $this->field_config['data_fim']['date_format']) ; 
          nmgp_Form_Datas($this->data_fim, $this->field_config['data_fim']['date_format'], $this->field_config['data_fim']['date_sep']) ;  
      }
      elseif ('null' == $this->data_fim || '' == $this->data_fim)
      {
          $this->data_fim = '';
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
      $guarda_format_hora = $this->field_config['data_ini']['date_format'];
      if ($this->data_ini != "")  
      { 
          nm_conv_data($this->data_ini, $this->field_config['data_ini']['date_format']) ; 
          $this->data_ini_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->data_ini_hora = substr($this->data_ini_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->data_ini_hora = substr($this->data_ini_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->data_ini_hora = substr($this->data_ini_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->data_ini_hora = substr($this->data_ini_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->data_ini_hora = substr($this->data_ini_hora, 0, -4);
          }
      } 
      if ($this->data_ini == "" && $use_null)  
      { 
          $this->data_ini = "null" ; 
      } 
      $this->field_config['data_ini']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['data_fim']['date_format'];
      if ($this->data_fim != "")  
      { 
          nm_conv_data($this->data_fim, $this->field_config['data_fim']['date_format']) ; 
          $this->data_fim_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->data_fim_hora = substr($this->data_fim_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->data_fim_hora = substr($this->data_fim_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->data_fim_hora = substr($this->data_fim_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->data_fim_hora = substr($this->data_fim_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->data_fim_hora = substr($this->data_fim_hora, 0, -4);
          }
      } 
      if ($this->data_fim == "" && $use_null)  
      { 
          $this->data_fim = "null" ; 
      } 
      $this->field_config['data_fim']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_cod_fornec_ini();
          $this->ajax_return_values_cod_fornec_fim();
          $this->ajax_return_values_data_ini();
          $this->ajax_return_values_data_fim();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['id']['keyVal'] = form_cons_fornec_imp_pack_protect_string($this->nmgp_dados_form['id']);
          }
   } // ajax_return_values

          //----- cod_fornec_ini
   function ajax_return_values_cod_fornec_ini($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cod_fornec_ini", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cod_fornec_ini);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cod_fornec_ini'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cod_fornec_fim
   function ajax_return_values_cod_fornec_fim($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cod_fornec_fim", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cod_fornec_fim);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cod_fornec_fim'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- data_ini
   function ajax_return_values_data_ini($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("data_ini", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->data_ini);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['data_ini'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- data_fim
   function ajax_return_values_data_fim($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("data_fim", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->data_fim);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['data_fim'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_data_ini = $this->data_ini;
}
  $dataInicial = buscarDataPrimeiroSaldoInicial();
$this->data_ini  = $dataInicial;
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_data_ini != $this->data_ini || (isset($bFlagRead_data_ini) && $bFlagRead_data_ini)))
    {
        $this->ajax_return_values_data_ini(true);
    }
}
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off'; 
      }
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']))
          {
               $sc_where_pos = " WHERE ((id < $this->id))";
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
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->id)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opcao'] = '';

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
      $NM_val_form['cod_fornec_ini'] = $this->cod_fornec_ini;
      $NM_val_form['cod_fornec_fim'] = $this->cod_fornec_fim;
      $NM_val_form['data_ini'] = $this->data_ini;
      $NM_val_form['data_fim'] = $this->data_fim;
      $NM_val_form['id'] = $this->id;
      if ($this->id === "" || is_null($this->id))  
      { 
          $this->id = 0;
      } 
      if ($this->cod_fornec_ini === "" || is_null($this->cod_fornec_ini))  
      { 
          $this->cod_fornec_ini = 0;
          $this->sc_force_zero[] = 'cod_fornec_ini';
      } 
      if ($this->cod_fornec_fim === "" || is_null($this->cod_fornec_fim))  
      { 
          $this->cod_fornec_fim = 0;
          $this->sc_force_zero[] = 'cod_fornec_fim';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->data_ini == "")  
          { 
              $this->data_ini = "null"; 
              $this->NM_val_null[] = "data_ini";
          } 
          if ($this->data_fim == "")  
          { 
              $this->data_fim = "null"; 
              $this->NM_val_null[] = "data_fim";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_cons_fornec_imp_pack_ajax_response();
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
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = #$this->data_ini#, data_fim = #$this->data_fim#"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", data_fim = " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", data_fim = " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = EXTEND('$this->data_ini', YEAR TO DAY), data_fim = EXTEND('$this->data_fim', YEAR TO DAY)"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", data_fim = " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", data_fim = " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ""; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "cod_fornec_ini = $this->cod_fornec_ini, cod_fornec_fim = $this->cod_fornec_fim, data_ini = " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", data_fim = " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ""; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE id = $this->id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE id = $this->id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE id = $this->id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE id = $this->id ";  
              }  
              else  
              {
                  $comando .= " WHERE id = $this->id ";  
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
                                  form_cons_fornec_imp_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['cod_fornec_ini'])) { $this->cod_fornec_ini = $NM_val_form['cod_fornec_ini']; }
              elseif (isset($this->cod_fornec_ini)) { $this->nm_limpa_alfa($this->cod_fornec_ini); }
              if     (isset($NM_val_form) && isset($NM_val_form['cod_fornec_fim'])) { $this->cod_fornec_fim = $NM_val_form['cod_fornec_fim']; }
              elseif (isset($this->cod_fornec_fim)) { $this->nm_limpa_alfa($this->cod_fornec_fim); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('cod_fornec_ini', 'cod_fornec_fim', 'data_ini', 'data_fim'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "id, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_cons_fornec_imp_pack_ajax_response();
              }
              exit; 
          }  
          $this->id_before_qstr = $this->id = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_cons_fornec_imp_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES ($this->cod_fornec_ini, $this->cod_fornec_fim, #$this->data_ini#, #$this->data_fim#)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, EXTEND('$this->data_ini', YEAR TO DAY), EXTEND('$this->data_fim', YEAR TO DAY))"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "cod_fornec_ini, cod_fornec_fim, data_ini, data_fim) VALUES (" . $NM_seq_auto . "$this->cod_fornec_ini, $this->cod_fornec_fim, " . $this->Ini->date_delim . $this->data_ini . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->data_fim . $this->Ini->date_delim1 . ")"; 
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
                              form_cons_fornec_imp_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select @@identity"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_cons_fornec_imp_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->id =  $rsy->fields[0];
                 $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  {
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  }
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT dbinfo('sqlca.sqlerrd1') FROM " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select .currval from dual"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $str_tabela = "SYSIBM.SYSDUMMY1"; 
                  if($this->Ini->nm_con_use_schema == "N") 
                  { 
                          $str_tabela = "SYSDUMMY1"; 
                  } 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT IDENTITY_VAL_LOCAL() FROM " . $str_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select CURRVAL('')"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']);
              }

              $this->sc_evento = "insert"; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->id = substr($this->Db->qstr($this->id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
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
                          form_cons_fornec_imp_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']);
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
        $_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  $this->criarTabela('resumo_cons_fornec_imp_00000',$this->id );
$this->criarTabela('itens_resumo_cons_fornec_imp_00000',$this->id );
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off'; 
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
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['parms'] = "id?#?$this->id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id = null === $this->id ? null : substr($this->Db->qstr($this->id), 1, -1); 
      } 
      if ($this->nmgp_opcao != "nada") 
      {
          $this->nmgp_opcao = "novo"; 
      }
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'] . ")";
          }
      }
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "inicio")
      { 
          $this->nmgp_opcao = "igual"; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT id, cod_fornec_ini, cod_fornec_fim, str_replace (convert(char(10),data_ini,102), '.', '-') + ' ' + convert(char(8),data_ini,20), str_replace (convert(char(10),data_fim,102), '.', '-') + ' ' + convert(char(8),data_fim,20) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT id, cod_fornec_ini, cod_fornec_fim, convert(char(23),data_ini,121), convert(char(23),data_fim,121) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT id, cod_fornec_ini, cod_fornec_fim, data_ini, data_fim from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT id, cod_fornec_ini, cod_fornec_fim, EXTEND(data_ini, YEAR TO DAY), EXTEND(data_fim, YEAR TO DAY) from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT id, cod_fornec_ini, cod_fornec_fim, data_ini, data_fim from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "id = $this->id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "id = $this->id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "id = $this->id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "id = $this->id"; 
              }  
              else  
              {
                  $aWhere[] = "id = $this->id"; 
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
          $sc_order_by = "id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['select'] = ""; 
              } 
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rs = $this->Db->Execute($nmgp_select) ; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter'] = true;
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
              $this->id = $rs->fields[0] ; 
              $this->nmgp_dados_select['id'] = $this->id;
              $this->cod_fornec_ini = $rs->fields[1] ; 
              $this->nmgp_dados_select['cod_fornec_ini'] = $this->cod_fornec_ini;
              $this->cod_fornec_fim = $rs->fields[2] ; 
              $this->nmgp_dados_select['cod_fornec_fim'] = $this->cod_fornec_fim;
              $this->data_ini = $rs->fields[3] ; 
              $this->nmgp_dados_select['data_ini'] = $this->data_ini;
              $this->data_fim = $rs->fields[4] ; 
              $this->nmgp_dados_select['data_fim'] = $this->data_fim;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->id = (string)$this->id; 
              $this->cod_fornec_ini = (string)$this->cod_fornec_ini; 
              $this->cod_fornec_fim = (string)$this->cod_fornec_fim; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['parms'] = "id?#?$this->id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->controle_navegacao();
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
              $this->id = "";  
              $this->nmgp_dados_form["id"] = $this->id;
              $this->cod_fornec_ini = "0";  
              $this->nmgp_dados_form["cod_fornec_ini"] = $this->cod_fornec_ini;
              $this->cod_fornec_fim = "999999";  
              $this->nmgp_dados_form["cod_fornec_fim"] = $this->cod_fornec_fim;
              $this->data_ini = "";  
              $this->data_ini_hora = "" ;  
              $this->nmgp_dados_form["data_ini"] = $this->data_ini;
              $this->data_fim = "9999-12-31";  
              $this->data_fim_hora = "" ;  
              $this->nmgp_dados_form["data_fim"] = $this->data_fim;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['foreign_key'] as $sFKName => $sFKValue)
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
       $this->SC_log_arr['keys']['id'] =  $this->id;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dados_select'];
           $this->SC_log_arr['fields']['cod_fornec_ini']['0'] =  $nmgp_dados_select['cod_fornec_ini'];
           $this->SC_log_arr['fields']['cod_fornec_fim']['0'] =  $nmgp_dados_select['cod_fornec_fim'];
           $this->SC_log_arr['fields']['data_ini']['0'] =  $nmgp_dados_select['data_ini'];
           $this->SC_log_arr['fields']['data_fim']['0'] =  $nmgp_dados_select['data_fim'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['cod_fornec_ini']['1'] =  $this->cod_fornec_ini;
       $this->SC_log_arr['fields']['cod_fornec_fim']['1'] =  $this->cod_fornec_fim;
       $this->SC_log_arr['fields']['data_ini']['1'] =  $this->data_ini;
       $this->SC_log_arr['fields']['data_fim']['1'] =  $this->data_fim;
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
       $Log_labels['cod_fornec_ini'] =  "Fornecedor Inicial";
       $Log_labels['cod_fornec_fim'] =  "Fornecedor Final";
       $Log_labels['data_ini'] =  "Dt.Inicial";
       $Log_labels['data_fim'] =  "Dt.Final";
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
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function cod_fornec_ini_onBlur()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
$original_cod_fornec_ini = $this->cod_fornec_ini;
$original_cod_fornec_fim = $this->cod_fornec_fim;

if($this->cod_fornec_ini  <> 0){
   	$this->cod_fornec_fim  = $this->cod_fornec_ini ;
}

$modificado_cod_fornec_ini = $this->cod_fornec_ini;
$modificado_cod_fornec_fim = $this->cod_fornec_fim;
$this->nm_formatar_campos('cod_fornec_ini', 'cod_fornec_fim');
if ($original_cod_fornec_ini !== $modificado_cod_fornec_ini || isset($this->nmgp_cmp_readonly['cod_fornec_ini']) || (isset($bFlagRead_cod_fornec_ini) && $bFlagRead_cod_fornec_ini))
{
    $this->ajax_return_values_cod_fornec_ini(true);
}
if ($original_cod_fornec_fim !== $modificado_cod_fornec_fim || isset($this->nmgp_cmp_readonly['cod_fornec_fim']) || (isset($bFlagRead_cod_fornec_fim) && $bFlagRead_cod_fornec_fim))
{
    $this->ajax_return_values_cod_fornec_fim(true);
}
$this->NM_ajax_info['event_field'] = 'cod';
form_cons_fornec_imp_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function cod_fornec_ini_onClick()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
$original_cod_fornec_ini = $this->cod_fornec_ini;
$original_cod_fornec_fim = $this->cod_fornec_fim;

if($this->cod_fornec_ini  <> 0){
   	$this->cod_fornec_fim  = $this->cod_fornec_ini ;
}

$modificado_cod_fornec_ini = $this->cod_fornec_ini;
$modificado_cod_fornec_fim = $this->cod_fornec_fim;
$this->nm_formatar_campos('cod_fornec_ini', 'cod_fornec_fim');
if ($original_cod_fornec_ini !== $modificado_cod_fornec_ini || isset($this->nmgp_cmp_readonly['cod_fornec_ini']) || (isset($bFlagRead_cod_fornec_ini) && $bFlagRead_cod_fornec_ini))
{
    $this->ajax_return_values_cod_fornec_ini(true);
}
if ($original_cod_fornec_fim !== $modificado_cod_fornec_fim || isset($this->nmgp_cmp_readonly['cod_fornec_fim']) || (isset($bFlagRead_cod_fornec_fim) && $bFlagRead_cod_fornec_fim))
{
    $this->ajax_return_values_cod_fornec_fim(true);
}
$this->NM_ajax_info['event_field'] = 'cod';
form_cons_fornec_imp_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function diaDaSemana($data,$retorno=0,$formato='aaaa-mm-dd')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
     
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function converterDataBra($data)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $aData = explode("-",$data);
    return $aData[2]."/".$aData[1]."/".$aData[0];



$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function converterHoraEmMinutos($hora)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

    $aQtMinutos = explode(':',$hora);
    if(is_array($aQtMinutos) and count($aQtMinutos) == 3){
        $qtMinutos = $aQtMinutos[0] * 60 + $aQtMinutos[1] + $aQtMinutos[2] / 60;
    }
    else{
        $qtMinutos = 0;
    }
    return $qtMinutos;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function converterMinutosEmHoras($minutos)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $hora = round($minutos / 60,0);
    if($hora < 1){
        $hora = 0;
    }
    $hora = preencherZerosAEsquerda ($hora,2);
    $min =  round($minutos % 60,0);
    $min = preencherZerosAEsquerda ($min,2);
    $formato_hora = "$hora:$min:00";
    return $formato_hora;

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getParteDataAMD($data,$parte)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function criarTabela($tabela,$id)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $aTabela  = explode('_00000',$tabela);
    $novaTabela = $aTabela[0].'_'.$this->id;
    $cmd = " iF (not EXISTS (SELECT * 
                 FROM INFORMATION_SCHEMA.TABLES 
                 WHERE TABLE_SCHEMA = 'dbo' 
                 AND  TABLE_NAME = '$novaTabela')) begin 
		SELECT * INTO $novaTabela FROM $tabela where 1 = 0 end";
    
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
                form_cons_fornec_imp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

    $cmd = "ALTER TABLE $novaTabela DROP COLUMN id";
    
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
                form_cons_fornec_imp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $cmd = " alter table $novaTabela add id int IDENTITY(1,1)";
    
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
                form_cons_fornec_imp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $cmd = "ALTER TABLE $novaTabela ADD CONSTRAINT pri$tabela$this->id PRIMARY KEY (id)";
    
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
                form_cons_fornec_imp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function retornarCamposTb($tabela)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $campos = '';
    $sql = "Select a.name From sys.columns a Inner Join sys.objects b On (a.object_id = b.object_id)
				Where a.object_id = object_id('$tabela')";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->metadados = $this->Ini->nm_db_ticontrole->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->metadados = false;
          $this->metadados_erro = $this->Ini->nm_db_ticontrole->ErrorMsg();
      } 

    if ($this->metadados  === false){
    echo "Erro de acesso. retornarCamposTb - arquivo metadados - Mensagem  = " . $this->metadados_erro ;
		}
		else{
    $i = 0;
    while (!$this->metadados->EOF){

        $campos = util_incr_valor($campos,$this->metadados->fields[0]);


				$this->metadados->MoveNext();
			}
			$this->metadados->Close();
		}
		return $campos;
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function criarRegCtaCorrenFornec($fornecedorId,$data,$itemProcCompraId,$historico,$codTipoMovto,$vlLancto,
                                 $codAcao,$numIdTitAp=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
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
                form_cons_fornec_imp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    }
    return $logCriar;
if (isset($this->sc_temp_transacao_universal)) { $_SESSION['transacao_universal'] = $this->sc_temp_transacao_universal;}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function alterarFornecItensPed($pedido,$fornec)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $aItens =  getIDItensProcCompra($pedido);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompra = $aItens[$i]['item_proc_compra_id'];
            $cmd = "update pub.cta_corren_fornec_imp set fornecedor_id = $fornec 
            where item_proc_compra_id = $itemProcCompra ";
        }
    }

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function verifTitPedImp($numIdTitulo)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarPgtosContainerPedImp($containerParam,$descOrigem='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarPagtosContainerSemItens($containerParam,$histCompl,$itemContainerParam=0)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $logExiste = existItensContainer($containerParam);
    $descLogExiste = convLogEmString($logExiste);
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarPagtosItemContainer($itemContainerId,$histCompl)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarTitAssocPedImp($numIdTitulo,$descOrigem='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarPagtosContainer($nivel, $id,$histCompl='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $data     = date('Y-m-d');
    switch($nivel){
        case 1:
            inserirLogDb("Nivel:","1",__FUNCTION__);
            $tipo     = "multi"; 
            $tabela   = " pub.pagtos_container ";
            $campos   = " num_id_tit_ap ";
            $condicao = "  container_id = $this->id ";
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
            $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$this->id);
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
                        $this->id,
                        $itemContainerId
                    );
                    $descrRetCriacao = convLogEmString($retCriacao);
                    inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                        "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                }
            }
            break;
    }

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSomasCtaCorrenFornec($tipoMovto,
                                 $logQuebra,
                                 $numIdTitulo=0,
                                 $itemPedId=0,
                                 $itemContainerId=0,
                                 $fornecId=0)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function estornarSaldoPgtosItemPed($itemPedido,$historico='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function verificarSaldoInicialFornec($fornec)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $retorno = false;
    $tabela = " pub.cta_corren_fornec_imp  ";
    $campo  = "fornecedor_id";
    $condicao = " fornecedor_id = $fornec and cod_tipo_movto = 1 ";
    $aResultado = $this->retornoSimplesTb01($tabela,$campo	,$condicao,"espec");
    if(is_array($aResultado)){
        $retorno = true ;
    }
    return $retorno;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarVlPagarItemPedido($itemProcCompra,$vlLancto,$acao)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

    $data = date('Y-m-d');
    $procCompraID = buscarProcCompraItem($itemProcCompra);
    $aPedido = getDadosPedidoImp($procCompraID);
    $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    $descLogGerarPrevisao = convLogEmString($logGerarPrevisao);
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoVlPagarItemPedido($itemProcCompra)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function sincrRateioAntecipPedImp($procCompra,$histCompl,$logForcarRateio = false)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl='',$logEstorno=false)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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
                $descrRetCriacao = convLogEmString($retCriacao);

                inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $codAcao",
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);

            }
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function atuRatPagtoPedTitContainer($numIdTitAp, $histCompl='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function atuRatPagtoPedItemContainer($itemPedido,$histCompl)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoFornecAntItem($fornec, $numIdTitAp,$itemProcCompra )
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoFornecTituloItemRatContainer($fornec, $numIdTitAp,$itemProcCompra,$itemContainerId )
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarRateioFornecAntecipsContainer($container,$histCompl='',$logEstorno=false,$titulo=0,$itemContainer=0)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarRateioFornecContainer($container, $tipoMovto)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoAntCtaCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $aDados = $this->getDadosCtaCorrenFornecImp($fornecedor,'vl_lancto','cod_tipo_movto = 1' );
    if(is_array($aDados)){
        $vlSaldoAnterior = $aDados[0]['vl_lancto'];
    }else{
        $vlSaldoAnterior = 0;
    }
    return $vlSaldoAnterior;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getTotLancManualFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getCpSomaSaldoPorSitContainer()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoNaoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getSaldoEntreguePortoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getDadosCtaCorrenFornecImp($fornecedor,$campos='',$cond='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function eliminarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    inserirLogDb('Inicio',__FUNCTION__,__FUNCTION__);
    $aItens = getIDItensProcCompra($pedImp);
    if(is_array($aItens)){
        incrNivelCorrenteLogDb();
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $this->id = $aItens[$i]['item_proc_compra_id'];
            inserirLogDb('ID Item do Container - Registros serao deletados',$this->id,__FUNCTION__);
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
                form_cons_fornec_imp_pack_ajax_response();
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
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function ajustarCtaCorrenFornec()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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
            $listaItensPedido = util_incr_valor($listaItensPedido,$itemProcCompraId);
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function gerarLanctosPedidosIntegrCtaCorrente()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function eliminarLanctosPedidosNaoIntegrCtaCorrente()
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getDeParaSitCta($sitCta)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

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
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
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
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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
      if ($this->dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dados = false;
          $this->dados_erro = $this->Db->ErrorMsg();
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
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_cons_fornec_imp']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_cons_fornec_imp_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_cons_fornec_imp_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("id", "cod_fornec_ini", "cod_fornec_fim", "data_ini", "data_fim"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['table_refresh'])
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_cons_fornec_imp_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "id") 
          {
              $this->SC_monta_condicao($comando, "id", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cod_fornec_ini") 
          {
              $this->SC_monta_condicao($comando, "cod_fornec_ini", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cod_fornec_fim") 
          {
              $this->SC_monta_condicao($comando, "cod_fornec_fim", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_ini") 
          {
              $this->SC_monta_condicao($comando, "data_ini", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_fim") 
          {
              $this->SC_monta_condicao($comando, "data_fim", $arg_search, $data_search, "DATE", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_cons_fornec_imp = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] = $qt_geral_reg_form_cons_fornec_imp;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_cons_fornec_imp_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_cons_fornec_imp_pack_ajax_response();
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
      $nm_numeric[] = "id";$nm_numeric[] = "cod_fornec_ini";$nm_numeric[] = "cod_fornec_fim";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['decimal_db'] == ".")
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
      $Nm_datas["data_ini"] = "date";$Nm_datas["data_fim"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['SC_sep_date1'];
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
       $nmgp_saida_form = "form_cons_fornec_imp_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_cons_fornec_imp_fim.php";
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
       form_cons_fornec_imp_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['masterValue']);
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
                return array("sc_b_new_b.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_b.sc-unique-btn-2");
                break;
            case "exit":
                return array("sc_b_sai_b.sc-unique-btn-3");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "Consulta Fornecedores Importação"; } else { echo "Consulta Fornecedores Importação"; } ?> - 
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_cons_fornec_imp']['ordem_ord'] == " desc") {
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
            case "cod_fornec_ini":
                return true;
            case "cod_fornec_fim":
                return true;
            case "id":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "cod_fornec_ini":
                return 'desc';
            case "cod_fornec_fim":
                return 'desc';
            case "data_ini":
                return 'desc';
            case "data_fim":
                return 'desc';
            case "id":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
