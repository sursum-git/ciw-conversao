<?php
//
class form_itens_media_custo_apl
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
   var $item_media_custo_id;
   var $media_custo_id;
   var $dt_hr_estoque;
   var $dt_hr_estoque_hora;
   var $qt_estoque;
   var $vl_custo;
   var $item_custo_id_orig;
   var $it_codigo;
   var $qt_estoque_informado;
   var $label_vl_custo;
   var $busca_estoque;
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
          if (isset($this->NM_ajax_info['param']['busca_estoque']))
          {
              $this->busca_estoque = $this->NM_ajax_info['param']['busca_estoque'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['it_codigo']))
          {
              $this->it_codigo = $this->NM_ajax_info['param']['it_codigo'];
          }
          if (isset($this->NM_ajax_info['param']['item_custo_id_orig']))
          {
              $this->item_custo_id_orig = $this->NM_ajax_info['param']['item_custo_id_orig'];
          }
          if (isset($this->NM_ajax_info['param']['item_media_custo_id']))
          {
              $this->item_media_custo_id = $this->NM_ajax_info['param']['item_media_custo_id'];
          }
          if (isset($this->NM_ajax_info['param']['label_vl_custo']))
          {
              $this->label_vl_custo = $this->NM_ajax_info['param']['label_vl_custo'];
          }
          if (isset($this->NM_ajax_info['param']['media_custo_id']))
          {
              $this->media_custo_id = $this->NM_ajax_info['param']['media_custo_id'];
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
          if (isset($this->NM_ajax_info['param']['qt_estoque']))
          {
              $this->qt_estoque = $this->NM_ajax_info['param']['qt_estoque'];
          }
          if (isset($this->NM_ajax_info['param']['qt_estoque_informado']))
          {
              $this->qt_estoque_informado = $this->NM_ajax_info['param']['qt_estoque_informado'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['vl_custo']))
          {
              $this->vl_custo = $this->NM_ajax_info['param']['vl_custo'];
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
      if (isset($this->medias_custo_corrente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['medias_custo_corrente'] = $this->medias_custo_corrente;
      }
      if (isset($_POST["medias_custo_corrente"]) && isset($this->medias_custo_corrente)) 
      {
          $_SESSION['medias_custo_corrente'] = $this->medias_custo_corrente;
      }
      if (isset($_GET["medias_custo_corrente"]) && isset($this->medias_custo_corrente)) 
      {
          $_SESSION['medias_custo_corrente'] = $this->medias_custo_corrente;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['embutida_parms']);
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
                 nm_limpa_str_form_itens_media_custo($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->medias_custo_corrente)) 
          {
              $_SESSION['medias_custo_corrente'] = $this->medias_custo_corrente;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['opc_ant']);
          }
          if (isset($this->medias_custo_corrente)) 
          {
              $_SESSION['medias_custo_corrente'] = $this->medias_custo_corrente;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_itens_media_custo_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['initialize'];
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_itens_media_custo']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_itens_media_custo']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_itens_media_custo'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_itens_media_custo']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_itens_media_custo']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_itens_media_custo') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_itens_media_custo']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Itens Média Custo";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_itens_media_custo")
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


      $this->arr_buttons['bt_get_est_ajax']['hint']             = "";
      $this->arr_buttons['bt_get_est_ajax']['type']             = "button";
      $this->arr_buttons['bt_get_est_ajax']['value']            = "Forçar Busca do Estoque";
      $this->arr_buttons['bt_get_est_ajax']['display']          = "only_text";
      $this->arr_buttons['bt_get_est_ajax']['display_position'] = "text_right";
      $this->arr_buttons['bt_get_est_ajax']['style']            = "default";
      $this->arr_buttons['bt_get_est_ajax']['image']            = "";


      $_SESSION['scriptcase']['error_icon']['form_itens_media_custo']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_itens_media_custo'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto']      = 'on';
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
      $this->nmgp_botoes['bt_get_est_ajax'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_itens_media_custo']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_itens_media_custo'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_itens_media_custo'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form'];
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['item_media_custo_id'] != "null"){$this->item_media_custo_id = $this->nmgp_dados_form['item_media_custo_id'];} 
          if (!isset($this->dt_hr_estoque)){$this->dt_hr_estoque = $this->nmgp_dados_form['dt_hr_estoque'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_itens_media_custo", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_itens_media_custo_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_itens_media_custo_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_itens_media_custo/form_itens_media_custo_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_itens_media_custo_erro.class.php"); 
      }
      $this->Erro      = new form_itens_media_custo_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao']))
         { 
             if ($this->item_media_custo_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_itens_media_custo']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['bt_get_est_ajax'] = "on";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['bt_get_est_ajax'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['botoes']['bt_get_est_ajax'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form'];
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

            $out1_img_cache = $_SESSION['scriptcase']['form_itens_media_custo']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_itens_media_custo']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->item_media_custo_id)) { $this->nm_limpa_alfa($this->item_media_custo_id); }
      if (isset($this->media_custo_id)) { $this->nm_limpa_alfa($this->media_custo_id); }
      if (isset($this->qt_estoque)) { $this->nm_limpa_alfa($this->qt_estoque); }
      if (isset($this->vl_custo)) { $this->nm_limpa_alfa($this->vl_custo); }
      if (isset($this->item_custo_id_orig)) { $this->nm_limpa_alfa($this->item_custo_id_orig); }
      if (isset($this->it_codigo)) { $this->nm_limpa_alfa($this->it_codigo); }
      if (isset($this->qt_estoque_informado)) { $this->nm_limpa_alfa($this->qt_estoque_informado); }
      if (isset($nm_opc_lookup) && $nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "it_codigo")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->it_codigo = $array_vars[0];
              $it_codigo       = $this->it_codigo;
              $this->it_codigo       = $it_codigo;
              $this->lookup_it_codigo($conteudo);
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
          if ($nm_call_php == "bt_get_est_ajax")
          { 
              $this->sc_btn_bt_get_est_ajax();
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- item_media_custo_id
      $this->field_config['item_media_custo_id']               = array();
      $this->field_config['item_media_custo_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['item_media_custo_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['item_media_custo_id']['symbol_dec'] = '';
      $this->field_config['item_media_custo_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['item_media_custo_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- media_custo_id
      $this->field_config['media_custo_id']               = array();
      $this->field_config['media_custo_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['media_custo_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['media_custo_id']['symbol_dec'] = '';
      $this->field_config['media_custo_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['media_custo_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- qt_estoque
      $this->field_config['qt_estoque']               = array();
      $this->field_config['qt_estoque']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qt_estoque']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qt_estoque']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['qt_estoque']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qt_estoque']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- qt_estoque_informado
      $this->field_config['qt_estoque_informado']               = array();
      $this->field_config['qt_estoque_informado']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qt_estoque_informado']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qt_estoque_informado']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['qt_estoque_informado']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qt_estoque_informado']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- vl_custo
      $this->field_config['vl_custo']               = array();
      $this->field_config['vl_custo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['vl_custo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['vl_custo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['vl_custo']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['vl_custo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- item_custo_id_orig
      $this->field_config['item_custo_id_orig']               = array();
      $this->field_config['item_custo_id_orig']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['item_custo_id_orig']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['item_custo_id_orig']['symbol_dec'] = '';
      $this->field_config['item_custo_id_orig']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['item_custo_id_orig']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dt_hr_estoque
      $this->field_config['dt_hr_estoque']                 = array();
      $this->field_config['dt_hr_estoque']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dt_hr_estoque']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dt_hr_estoque']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dt_hr_estoque']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'dt_hr_estoque');
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['Gera_log_access'])
      {
          $this->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['Gera_log_access'] = false;
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
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->it_codigo = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']['it_codigo'];
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
         $this->label_vl_custo = "";
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_item_media_custo_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'item_media_custo_id');
          }
          if ('validate_it_codigo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'it_codigo');
          }
          if ('validate_media_custo_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'media_custo_id');
          }
          if ('validate_qt_estoque' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qt_estoque');
          }
          if ('validate_qt_estoque_informado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qt_estoque_informado');
          }
          if ('validate_vl_custo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'vl_custo');
          }
          if ('validate_item_custo_id_orig' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'item_custo_id_orig');
          }
          if ('validate_busca_estoque' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'busca_estoque');
          }
          form_itens_media_custo_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_it_codigo_onblur' == $this->NM_ajax_opcao)
          {
              $this->it_codigo_onBlur();
          }
          if ('event_scajaxbutton_bt_get_est_ajax_onclick' == $this->NM_ajax_opcao)
          {
              $this->scajaxbutton_bt_get_est_ajax_onClick();
          }
          form_itens_media_custo_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select']['it_codigo']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->it_codigo = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select']['it_codigo'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_itens_media_custo_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_itens_media_custo_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_atualiz'] == "ok")
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
          form_itens_media_custo_pack_ajax_response();
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
          form_itens_media_custo_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_itens_media_custo.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Itens Média Custo") ?></TITLE>
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
<form name="Fdown" method="get" action="form_itens_media_custo_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_itens_media_custo"> 
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_itens_media_custo', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->Ini->nm_con_ticontrole2['tpbanco']), $this->Ini->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_itens_media_custo', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->Ini->nm_db_ticontrole2->qstr($usr) . ", 'form_itens_media_custo', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->Ini->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->Ini->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Ini->nm_db_ticontrole2->ErrorMsg()); 
           if ($this->NM_ajax_flag)
           {
               form_itens_media_custo_pack_ajax_response();
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
       } 
   }
//
//--------------------------------------------------------------------------------------
   function lookup_it_codigo(&$conteudo)
   {
      global  $it_codigo;
      $guarda_formatado = $this->formatado;
      $this->nm_tira_formatacao();
      if (in_array(strtolower($this->Ini->nm_con_ems2med['tpbanco']), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT \"desc-item\"
FROM PUB.item 
WHERE \"it-codigo\" = '$this->it_codigo' 
ORDER BY \"desc-item\""; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Ini->nm_db_ems2med->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : ""; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems2med->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      foreach ($this->Before_unformat as $Cmp => $Val)
      {
          $this->$Cmp = $Val;
          $this->formatado = $guarda_formatado;
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
           case 'item_media_custo_id':
               return "ID";
               break;
           case 'it_codigo':
               return "Item";
               break;
           case 'media_custo_id':
               return "Média Custo ID";
               break;
           case 'qt_estoque':
               return "Qt. Estoque";
               break;
           case 'qt_estoque_informado':
               return "Qt. Estoque Informado";
               break;
           case 'vl_custo':
               return "Vl. Custo";
               break;
           case 'item_custo_id_orig':
               return "Item Custo Id Orig";
               break;
           case 'label_vl_custo':
               return "Vl.Custo";
               break;
           case 'busca_estoque':
               return "Sit. Busca Estoque";
               break;
           case 'dt_hr_estoque':
               return "Dt.Hr. Estoque";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_itens_media_custo']) || !is_array($this->NM_ajax_info['errList']['geral_form_itens_media_custo']))
              {
                  $this->NM_ajax_info['errList']['geral_form_itens_media_custo'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_itens_media_custo'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'item_media_custo_id' == $filtro)) || (is_array($filtro) && in_array('item_media_custo_id', $filtro)))
        $this->ValidateField_item_media_custo_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "item_media_custo_id";

      if ((!is_array($filtro) && ('' == $filtro || 'it_codigo' == $filtro)) || (is_array($filtro) && in_array('it_codigo', $filtro)))
        $this->ValidateField_it_codigo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "it_codigo";

      if ((!is_array($filtro) && ('' == $filtro || 'media_custo_id' == $filtro)) || (is_array($filtro) && in_array('media_custo_id', $filtro)))
        $this->ValidateField_media_custo_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "media_custo_id";

      if ((!is_array($filtro) && ('' == $filtro || 'qt_estoque' == $filtro)) || (is_array($filtro) && in_array('qt_estoque', $filtro)))
        $this->ValidateField_qt_estoque($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qt_estoque";

      if ((!is_array($filtro) && ('' == $filtro || 'qt_estoque_informado' == $filtro)) || (is_array($filtro) && in_array('qt_estoque_informado', $filtro)))
        $this->ValidateField_qt_estoque_informado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qt_estoque_informado";

      if ((!is_array($filtro) && ('' == $filtro || 'vl_custo' == $filtro)) || (is_array($filtro) && in_array('vl_custo', $filtro)))
        $this->ValidateField_vl_custo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "vl_custo";

      if ((!is_array($filtro) && ('' == $filtro || 'item_custo_id_orig' == $filtro)) || (is_array($filtro) && in_array('item_custo_id_orig', $filtro)))
        $this->ValidateField_item_custo_id_orig($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "item_custo_id_orig";

      if ((!is_array($filtro) && ('' == $filtro || 'busca_estoque' == $filtro)) || (is_array($filtro) && in_array('busca_estoque', $filtro)))
        $this->ValidateField_busca_estoque($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "busca_estoque";


      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
if (!isset($this->sc_temp_medias_custo_corrente)) {$this->sc_temp_medias_custo_corrente = (isset($_SESSION['medias_custo_corrente'])) ? $_SESSION['medias_custo_corrente'] : "";}
  $qt = $this->getQtItensMediaId($this->sc_temp_medias_custo_corrente);
if($qt > 0){
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Não é possível incluir um novo item na média, devido a mesma já possuir lançamentos gerados.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_itens_media_custo';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_itens_media_custo';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Não é possível incluir um novo item na média, devido a mesma já possuir lançamentos gerados.';
 }
;
}
if (isset($this->sc_temp_medias_custo_corrente)) { $_SESSION['medias_custo_corrente'] = $this->sc_temp_medias_custo_corrente;}
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off'; 
      }
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

    function ValidateField_item_media_custo_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['item_media_custo_id'])) {
          nm_limpa_numero($this->item_media_custo_id, $this->field_config['item_media_custo_id']['symbol_grp']) ; 
          return;
      }
      if ($this->item_media_custo_id === "" || is_null($this->item_media_custo_id))  
      { 
          $this->item_media_custo_id = 0;
      } 
      nm_limpa_numero($this->item_media_custo_id, $this->field_config['item_media_custo_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_item_media_custo_id' == $this->NM_ajax_opcao)
      { 
          if ($this->item_media_custo_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->item_media_custo_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['item_media_custo_id']))
                  {
                      $Campos_Erros['item_media_custo_id'] = array();
                  }
                  $Campos_Erros['item_media_custo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['item_media_custo_id']) || !is_array($this->NM_ajax_info['errList']['item_media_custo_id']))
                  {
                      $this->NM_ajax_info['errList']['item_media_custo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['item_media_custo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->item_media_custo_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID; " ; 
                  if (!isset($Campos_Erros['item_media_custo_id']))
                  {
                      $Campos_Erros['item_media_custo_id'] = array();
                  }
                  $Campos_Erros['item_media_custo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['item_media_custo_id']) || !is_array($this->NM_ajax_info['errList']['item_media_custo_id']))
                  {
                      $this->NM_ajax_info['errList']['item_media_custo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['item_media_custo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'item_media_custo_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_item_media_custo_id

    function ValidateField_it_codigo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['it_codigo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->it_codigo) > 40) 
          { 
              $hasError = true;
              $Campos_Crit .= "Item " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['it_codigo']))
              {
                  $Campos_Erros['it_codigo'] = array();
              }
              $Campos_Erros['it_codigo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['it_codigo']) || !is_array($this->NM_ajax_info['errList']['it_codigo']))
              {
                  $this->NM_ajax_info['errList']['it_codigo'] = array();
              }
              $this->NM_ajax_info['errList']['it_codigo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'it_codigo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_it_codigo

    function ValidateField_media_custo_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['media_custo_id'])) {
          nm_limpa_numero($this->media_custo_id, $this->field_config['media_custo_id']['symbol_grp']) ; 
          return;
      }
      if ($this->media_custo_id === "" || is_null($this->media_custo_id))  
      { 
          $this->media_custo_id = 0;
          $this->sc_force_zero[] = 'media_custo_id';
      } 
      nm_limpa_numero($this->media_custo_id, $this->field_config['media_custo_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->media_custo_id != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->media_custo_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Média Custo ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['media_custo_id']))
                  {
                      $Campos_Erros['media_custo_id'] = array();
                  }
                  $Campos_Erros['media_custo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['media_custo_id']) || !is_array($this->NM_ajax_info['errList']['media_custo_id']))
                  {
                      $this->NM_ajax_info['errList']['media_custo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['media_custo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->media_custo_id, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Média Custo ID; " ; 
                  if (!isset($Campos_Erros['media_custo_id']))
                  {
                      $Campos_Erros['media_custo_id'] = array();
                  }
                  $Campos_Erros['media_custo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['media_custo_id']) || !is_array($this->NM_ajax_info['errList']['media_custo_id']))
                  {
                      $this->NM_ajax_info['errList']['media_custo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['media_custo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'media_custo_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_media_custo_id

    function ValidateField_qt_estoque(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qt_estoque'])) {
          if (!empty($this->field_config['qt_estoque']['symbol_dec'])) {
              nm_limpa_valor($this->qt_estoque, $this->field_config['qt_estoque']['symbol_dec'], $this->field_config['qt_estoque']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->qt_estoque === "" || is_null($this->qt_estoque))  
      { 
          $this->qt_estoque = 0;
          $this->sc_force_zero[] = 'qt_estoque';
      } 
      if (!empty($this->field_config['qt_estoque']['symbol_dec']))
      {
          nm_limpa_valor($this->qt_estoque, $this->field_config['qt_estoque']['symbol_dec'], $this->field_config['qt_estoque']['symbol_grp']) ; 
          if ('.' == substr($this->qt_estoque, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->qt_estoque, 1)))
              {
                  $this->qt_estoque = '';
              }
              else
              {
                  $this->qt_estoque = '0' . $this->qt_estoque;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->qt_estoque != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->qt_estoque) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt. Estoque: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qt_estoque']))
                  {
                      $Campos_Erros['qt_estoque'] = array();
                  }
                  $Campos_Erros['qt_estoque'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qt_estoque']) || !is_array($this->NM_ajax_info['errList']['qt_estoque']))
                  {
                      $this->NM_ajax_info['errList']['qt_estoque'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_estoque'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qt_estoque, 17, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt. Estoque; " ; 
                  if (!isset($Campos_Erros['qt_estoque']))
                  {
                      $Campos_Erros['qt_estoque'] = array();
                  }
                  $Campos_Erros['qt_estoque'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qt_estoque']) || !is_array($this->NM_ajax_info['errList']['qt_estoque']))
                  {
                      $this->NM_ajax_info['errList']['qt_estoque'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_estoque'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qt_estoque';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qt_estoque

    function ValidateField_qt_estoque_informado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qt_estoque_informado'])) {
          if (!empty($this->field_config['qt_estoque_informado']['symbol_dec'])) {
              nm_limpa_valor($this->qt_estoque_informado, $this->field_config['qt_estoque_informado']['symbol_dec'], $this->field_config['qt_estoque_informado']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->qt_estoque_informado === "" || is_null($this->qt_estoque_informado))  
      { 
          $this->qt_estoque_informado = 0;
          $this->sc_force_zero[] = 'qt_estoque_informado';
      } 
      if (!empty($this->field_config['qt_estoque_informado']['symbol_dec']))
      {
          nm_limpa_valor($this->qt_estoque_informado, $this->field_config['qt_estoque_informado']['symbol_dec'], $this->field_config['qt_estoque_informado']['symbol_grp']) ; 
          if ('.' == substr($this->qt_estoque_informado, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->qt_estoque_informado, 1)))
              {
                  $this->qt_estoque_informado = '';
              }
              else
              {
                  $this->qt_estoque_informado = '0' . $this->qt_estoque_informado;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->qt_estoque_informado != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->qt_estoque_informado) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt. Estoque Informado: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qt_estoque_informado']))
                  {
                      $Campos_Erros['qt_estoque_informado'] = array();
                  }
                  $Campos_Erros['qt_estoque_informado'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qt_estoque_informado']) || !is_array($this->NM_ajax_info['errList']['qt_estoque_informado']))
                  {
                      $this->NM_ajax_info['errList']['qt_estoque_informado'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_estoque_informado'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qt_estoque_informado, 17, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qt. Estoque Informado; " ; 
                  if (!isset($Campos_Erros['qt_estoque_informado']))
                  {
                      $Campos_Erros['qt_estoque_informado'] = array();
                  }
                  $Campos_Erros['qt_estoque_informado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qt_estoque_informado']) || !is_array($this->NM_ajax_info['errList']['qt_estoque_informado']))
                  {
                      $this->NM_ajax_info['errList']['qt_estoque_informado'] = array();
                  }
                  $this->NM_ajax_info['errList']['qt_estoque_informado'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qt_estoque_informado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qt_estoque_informado

    function ValidateField_vl_custo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['vl_custo'])) {
          if (!empty($this->field_config['vl_custo']['symbol_dec'])) {
              nm_limpa_valor($this->vl_custo, $this->field_config['vl_custo']['symbol_dec'], $this->field_config['vl_custo']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->vl_custo === "" || is_null($this->vl_custo))  
      { 
          $this->vl_custo = 0;
          $this->sc_force_zero[] = 'vl_custo';
      } 
      if (!empty($this->field_config['vl_custo']['symbol_dec']))
      {
          nm_limpa_valor($this->vl_custo, $this->field_config['vl_custo']['symbol_dec'], $this->field_config['vl_custo']['symbol_grp']) ; 
          if ('.' == substr($this->vl_custo, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->vl_custo, 1)))
              {
                  $this->vl_custo = '';
              }
              else
              {
                  $this->vl_custo = '0' . $this->vl_custo;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->vl_custo != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->vl_custo) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl. Custo: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['vl_custo']))
                  {
                      $Campos_Erros['vl_custo'] = array();
                  }
                  $Campos_Erros['vl_custo'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['vl_custo']) || !is_array($this->NM_ajax_info['errList']['vl_custo']))
                  {
                      $this->NM_ajax_info['errList']['vl_custo'] = array();
                  }
                  $this->NM_ajax_info['errList']['vl_custo'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->vl_custo, 17, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vl. Custo; " ; 
                  if (!isset($Campos_Erros['vl_custo']))
                  {
                      $Campos_Erros['vl_custo'] = array();
                  }
                  $Campos_Erros['vl_custo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['vl_custo']) || !is_array($this->NM_ajax_info['errList']['vl_custo']))
                  {
                      $this->NM_ajax_info['errList']['vl_custo'] = array();
                  }
                  $this->NM_ajax_info['errList']['vl_custo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'vl_custo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_vl_custo

    function ValidateField_item_custo_id_orig(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['item_custo_id_orig'])) {
          nm_limpa_numero($this->item_custo_id_orig, $this->field_config['item_custo_id_orig']['symbol_grp']) ; 
          return;
      }
      if ($this->item_custo_id_orig === "" || is_null($this->item_custo_id_orig))  
      { 
          $this->item_custo_id_orig = 0;
          $this->sc_force_zero[] = 'item_custo_id_orig';
      } 
      nm_limpa_numero($this->item_custo_id_orig, $this->field_config['item_custo_id_orig']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->item_custo_id_orig != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->item_custo_id_orig) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Item Custo Id Orig: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['item_custo_id_orig']))
                  {
                      $Campos_Erros['item_custo_id_orig'] = array();
                  }
                  $Campos_Erros['item_custo_id_orig'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['item_custo_id_orig']) || !is_array($this->NM_ajax_info['errList']['item_custo_id_orig']))
                  {
                      $this->NM_ajax_info['errList']['item_custo_id_orig'] = array();
                  }
                  $this->NM_ajax_info['errList']['item_custo_id_orig'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->item_custo_id_orig, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Item Custo Id Orig; " ; 
                  if (!isset($Campos_Erros['item_custo_id_orig']))
                  {
                      $Campos_Erros['item_custo_id_orig'] = array();
                  }
                  $Campos_Erros['item_custo_id_orig'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['item_custo_id_orig']) || !is_array($this->NM_ajax_info['errList']['item_custo_id_orig']))
                  {
                      $this->NM_ajax_info['errList']['item_custo_id_orig'] = array();
                  }
                  $this->NM_ajax_info['errList']['item_custo_id_orig'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'item_custo_id_orig';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_item_custo_id_orig

    function ValidateField_busca_estoque(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['busca_estoque'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->busca_estoque) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'busca_estoque';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_busca_estoque

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
    $this->nmgp_dados_form['item_media_custo_id'] = $this->item_media_custo_id;
    $this->nmgp_dados_form['it_codigo'] = $this->it_codigo;
    $this->nmgp_dados_form['media_custo_id'] = $this->media_custo_id;
    $this->nmgp_dados_form['qt_estoque'] = $this->qt_estoque;
    $this->nmgp_dados_form['qt_estoque_informado'] = $this->qt_estoque_informado;
    $this->nmgp_dados_form['vl_custo'] = $this->vl_custo;
    $this->nmgp_dados_form['item_custo_id_orig'] = $this->item_custo_id_orig;
    $this->nmgp_dados_form['label_vl_custo'] = $this->label_vl_custo;
    $this->nmgp_dados_form['busca_estoque'] = $this->busca_estoque;
    $this->nmgp_dados_form['dt_hr_estoque'] = $this->dt_hr_estoque;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['item_media_custo_id'] = $this->item_media_custo_id;
      nm_limpa_numero($this->item_media_custo_id, $this->field_config['item_media_custo_id']['symbol_grp']) ; 
      $this->Before_unformat['media_custo_id'] = $this->media_custo_id;
      nm_limpa_numero($this->media_custo_id, $this->field_config['media_custo_id']['symbol_grp']) ; 
      $this->Before_unformat['qt_estoque'] = $this->qt_estoque;
      if (!empty($this->field_config['qt_estoque']['symbol_dec']))
      {
         nm_limpa_valor($this->qt_estoque, $this->field_config['qt_estoque']['symbol_dec'], $this->field_config['qt_estoque']['symbol_grp']);
      }
      $this->Before_unformat['qt_estoque_informado'] = $this->qt_estoque_informado;
      if (!empty($this->field_config['qt_estoque_informado']['symbol_dec']))
      {
         nm_limpa_valor($this->qt_estoque_informado, $this->field_config['qt_estoque_informado']['symbol_dec'], $this->field_config['qt_estoque_informado']['symbol_grp']);
      }
      $this->Before_unformat['vl_custo'] = $this->vl_custo;
      if (!empty($this->field_config['vl_custo']['symbol_dec']))
      {
         nm_limpa_valor($this->vl_custo, $this->field_config['vl_custo']['symbol_dec'], $this->field_config['vl_custo']['symbol_grp']);
      }
      $this->Before_unformat['item_custo_id_orig'] = $this->item_custo_id_orig;
      nm_limpa_numero($this->item_custo_id_orig, $this->field_config['item_custo_id_orig']['symbol_grp']) ; 
      $this->Before_unformat['dt_hr_estoque'] = $this->dt_hr_estoque;
      $this->Before_unformat['dt_hr_estoque_hora'] = $this->dt_hr_estoque_hora;
      nm_limpa_data($this->dt_hr_estoque, $this->field_config['dt_hr_estoque']['date_sep']) ; 
      nm_limpa_hora($this->dt_hr_estoque_hora, $this->field_config['dt_hr_estoque']['time_sep']) ; 
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
      if ($Nome_Campo == "item_media_custo_id")
      {
          nm_limpa_numero($this->item_media_custo_id, $this->field_config['item_media_custo_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "media_custo_id")
      {
          nm_limpa_numero($this->media_custo_id, $this->field_config['media_custo_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qt_estoque")
      {
          if (!empty($this->field_config['qt_estoque']['symbol_dec']))
          {
             nm_limpa_valor($this->qt_estoque, $this->field_config['qt_estoque']['symbol_dec'], $this->field_config['qt_estoque']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "qt_estoque_informado")
      {
          if (!empty($this->field_config['qt_estoque_informado']['symbol_dec']))
          {
             nm_limpa_valor($this->qt_estoque_informado, $this->field_config['qt_estoque_informado']['symbol_dec'], $this->field_config['qt_estoque_informado']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "vl_custo")
      {
          if (!empty($this->field_config['vl_custo']['symbol_dec']))
          {
             nm_limpa_valor($this->vl_custo, $this->field_config['vl_custo']['symbol_dec'], $this->field_config['vl_custo']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "item_custo_id_orig")
      {
          nm_limpa_numero($this->item_custo_id_orig, $this->field_config['item_custo_id_orig']['symbol_grp']) ; 
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
      if ('' !== $this->item_media_custo_id || (!empty($format_fields) && isset($format_fields['item_media_custo_id'])))
      {
          nmgp_Form_Num_Val($this->item_media_custo_id, $this->field_config['item_media_custo_id']['symbol_grp'], $this->field_config['item_media_custo_id']['symbol_dec'], "0", "S", $this->field_config['item_media_custo_id']['format_neg'], "", "", "-", $this->field_config['item_media_custo_id']['symbol_fmt']) ; 
      }
      if ('' !== $this->media_custo_id || (!empty($format_fields) && isset($format_fields['media_custo_id'])))
      {
          nmgp_Form_Num_Val($this->media_custo_id, $this->field_config['media_custo_id']['symbol_grp'], $this->field_config['media_custo_id']['symbol_dec'], "0", "S", $this->field_config['media_custo_id']['format_neg'], "", "", "-", $this->field_config['media_custo_id']['symbol_fmt']) ; 
      }
      if ('' !== $this->qt_estoque || (!empty($format_fields) && isset($format_fields['qt_estoque'])))
      {
          nmgp_Form_Num_Val($this->qt_estoque, $this->field_config['qt_estoque']['symbol_grp'], $this->field_config['qt_estoque']['symbol_dec'], "2", "S", $this->field_config['qt_estoque']['format_neg'], "", "", "-", $this->field_config['qt_estoque']['symbol_fmt']) ; 
      }
      if ('' !== $this->qt_estoque_informado || (!empty($format_fields) && isset($format_fields['qt_estoque_informado'])))
      {
          nmgp_Form_Num_Val($this->qt_estoque_informado, $this->field_config['qt_estoque_informado']['symbol_grp'], $this->field_config['qt_estoque_informado']['symbol_dec'], "2", "S", $this->field_config['qt_estoque_informado']['format_neg'], "", "", "-", $this->field_config['qt_estoque_informado']['symbol_fmt']) ; 
      }
      if ('' !== $this->vl_custo || (!empty($format_fields) && isset($format_fields['vl_custo'])))
      {
          nmgp_Form_Num_Val($this->vl_custo, $this->field_config['vl_custo']['symbol_grp'], $this->field_config['vl_custo']['symbol_dec'], "2", "S", $this->field_config['vl_custo']['format_neg'], "", "", "-", $this->field_config['vl_custo']['symbol_fmt']) ; 
      }
      if ('' !== $this->item_custo_id_orig || (!empty($format_fields) && isset($format_fields['item_custo_id_orig'])))
      {
          nmgp_Form_Num_Val($this->item_custo_id_orig, $this->field_config['item_custo_id_orig']['symbol_grp'], $this->field_config['item_custo_id_orig']['symbol_dec'], "0", "S", $this->field_config['item_custo_id_orig']['format_neg'], "", "", "-", $this->field_config['item_custo_id_orig']['symbol_fmt']) ; 
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
          $this->ajax_return_values_item_media_custo_id();
          $this->ajax_return_values_it_codigo();
          $this->ajax_return_values_media_custo_id();
          $this->ajax_return_values_qt_estoque();
          $this->ajax_return_values_qt_estoque_informado();
          $this->ajax_return_values_vl_custo();
          $this->ajax_return_values_item_custo_id_orig();
          $this->ajax_return_values_label_vl_custo();
          $this->ajax_return_values_busca_estoque();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['item_media_custo_id']['keyVal'] = form_itens_media_custo_pack_protect_string($this->nmgp_dados_form['item_media_custo_id']);
          }
   } // ajax_return_values

          //----- item_media_custo_id
   function ajax_return_values_item_media_custo_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("item_media_custo_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->item_media_custo_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['item_media_custo_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("item_media_custo_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- it_codigo
   function ajax_return_values_it_codigo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("it_codigo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->it_codigo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['it_codigo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
              $orig_it_codigo = $this->it_codigo;
              $it_codigo      = $this->it_codigo;
              $this->it_codigo = $it_codigo;
              $this->lookup_it_codigo($conteudo);
              $this->it_codigo = $orig_it_codigo;
              $this->NM_ajax_info['fldList']['it_codigo']['lookupCons'] = form_itens_media_custo_pack_protect_string(NM_charset_to_utf8($conteudo));
          }
   }

          //----- media_custo_id
   function ajax_return_values_media_custo_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("media_custo_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->media_custo_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['media_custo_id'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- qt_estoque
   function ajax_return_values_qt_estoque($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qt_estoque", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qt_estoque);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qt_estoque'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- qt_estoque_informado
   function ajax_return_values_qt_estoque_informado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qt_estoque_informado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qt_estoque_informado);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qt_estoque_informado'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- vl_custo
   function ajax_return_values_vl_custo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("vl_custo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->vl_custo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['vl_custo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- item_custo_id_orig
   function ajax_return_values_item_custo_id_orig($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("item_custo_id_orig", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->item_custo_id_orig);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['item_custo_id_orig'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- label_vl_custo
   function ajax_return_values_label_vl_custo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("label_vl_custo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->label_vl_custo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['label_vl_custo'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- busca_estoque
   function ajax_return_values_busca_estoque($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("busca_estoque", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->busca_estoque);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['busca_estoque'] = array(
                       'row'    => '',
               'type'    => 'label',
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_label_vl_custo = $this->label_vl_custo;
    $original_vl_custo = $this->vl_custo;
}
  $this->label_vl_custo  = $this->vl_custo ;
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_label_vl_custo != $this->label_vl_custo || (isset($bFlagRead_label_vl_custo) && $bFlagRead_label_vl_custo)))
    {
        $this->ajax_return_values_label_vl_custo(true);
    }
    if (($original_vl_custo != $this->vl_custo || (isset($bFlagRead_vl_custo) && $bFlagRead_vl_custo)))
    {
        $this->ajax_return_values_vl_custo(true);
    }
}
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off'; 
      }
      if (empty($this->dt_hr_estoque))
      {
          $this->dt_hr_estoque_hora = $this->dt_hr_estoque;
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
      $this->qt_estoque = str_replace($sc_parm1, $sc_parm2, $this->qt_estoque); 
      $this->qt_estoque_informado = str_replace($sc_parm1, $sc_parm2, $this->qt_estoque_informado); 
      $this->vl_custo = str_replace($sc_parm1, $sc_parm2, $this->vl_custo); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->qt_estoque = "'" . $this->qt_estoque . "'";
      $this->qt_estoque_informado = "'" . $this->qt_estoque_informado . "'";
      $this->vl_custo = "'" . $this->vl_custo . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->qt_estoque = str_replace("'", "", $this->qt_estoque); 
      $this->qt_estoque_informado = str_replace("'", "", $this->qt_estoque_informado); 
      $this->vl_custo = str_replace("'", "", $this->vl_custo); 
   } 
//----------- 

   function return_after_insert()
   {
      global $sc_where;
      $this->restore_zeros_null();
      $sc_where_pos = " WHERE ((item_media_custo_id < $this->item_media_custo_id))";
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
      if ('' != $this->item_media_custo_id)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = $rsc->fields[0];
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
      if ('incluir' == $this->nmgp_opcao && empty($this->media_custo_id)) {$this->media_custo_id = "" . $_SESSION['medias_custo_corrente'] . ""; $this->sc_force_zero[] = "media_custo_id";}  
      $NM_val_form['item_media_custo_id'] = $this->item_media_custo_id;
      $NM_val_form['it_codigo'] = $this->it_codigo;
      $NM_val_form['media_custo_id'] = $this->media_custo_id;
      $NM_val_form['qt_estoque'] = $this->qt_estoque;
      $NM_val_form['qt_estoque_informado'] = $this->qt_estoque_informado;
      $NM_val_form['vl_custo'] = $this->vl_custo;
      $NM_val_form['item_custo_id_orig'] = $this->item_custo_id_orig;
      $NM_val_form['label_vl_custo'] = $this->label_vl_custo;
      $NM_val_form['busca_estoque'] = $this->busca_estoque;
      $NM_val_form['dt_hr_estoque'] = $this->dt_hr_estoque;
      if ($this->item_media_custo_id === "" || is_null($this->item_media_custo_id))  
      { 
          $this->item_media_custo_id = 0;
      } 
      if ($this->media_custo_id === "" || is_null($this->media_custo_id))  
      { 
          $this->media_custo_id = 0;
          $this->sc_force_zero[] = 'media_custo_id';
      } 
      if ($this->qt_estoque === "" || is_null($this->qt_estoque))  
      { 
          $this->qt_estoque = 0;
          $this->sc_force_zero[] = 'qt_estoque';
      } 
      if ($this->vl_custo === "" || is_null($this->vl_custo))  
      { 
          $this->vl_custo = 0;
          $this->sc_force_zero[] = 'vl_custo';
      } 
      if ($this->item_custo_id_orig === "" || is_null($this->item_custo_id_orig))  
      { 
          $this->item_custo_id_orig = 0;
          $this->sc_force_zero[] = 'item_custo_id_orig';
      } 
      if ($this->qt_estoque_informado === "" || is_null($this->qt_estoque_informado))  
      { 
          $this->qt_estoque_informado = 0;
          $this->sc_force_zero[] = 'qt_estoque_informado';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->dt_hr_estoque == "")  
          { 
              $this->dt_hr_estoque = "null"; 
              $this->NM_val_null[] = "dt_hr_estoque";
          } 
          $this->it_codigo_before_qstr = $this->it_codigo;
          $this->it_codigo = substr($this->Db->qstr($this->it_codigo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->it_codigo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->it_codigo);
          }
          if ($this->it_codigo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->it_codigo = "null"; 
              $this->NM_val_null[] = "it_codigo";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_itens_media_custo_pack_ajax_response();
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
              $Cmd_Unique = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where (media_custo_id = " . $this->media_custo_id . " AND it_codigo = '" . $this->it_codigo . "') AND (item_media_custo_id <> $this->item_media_custo_id)";
              $Cmd_Unique = str_replace("'null'", "null", $Cmd_Unique) ; 
              $Cmd_Unique = str_replace("#null#", "null", $Cmd_Unique) ; 
              $Cmd_Unique = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $Cmd_Unique) ; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $Cmd_Unique;
              $rsUni = $this->Db->Execute($Cmd_Unique);
              if (false === $rsUni)
              {
                  $dbErrorMessage = $this->Db->ErrorMsg();
                  $dbErrorCode = $this->Db->ErrorNo();
                  $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) {
                      $this->sc_erro_update = $dbErrorMessage;
                      $this->NM_rollback_db();
                      if ($this->NM_ajax_flag) {
                          form_itens_media_custo_pack_ajax_response();
                      }
                      exit;
                  }
              }
              elseif (0 < $rsUni->fields[0])
              {
                  $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_ukey'] . " Média Custo ID, Item"); 
                  $this->nmgp_opcao = "nada"; 
                  $aUpdateOk[] = 'media_custo_id+it_codigo';
                  $rsUni->Close();
              }
              else
              {
                  $rsUni->Close();
              }
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "media_custo_id = $this->media_custo_id, qt_estoque = $this->qt_estoque, vl_custo = $this->vl_custo, item_custo_id_orig = $this->item_custo_id_orig, it_codigo = '$this->it_codigo', qt_estoque_informado = $this->qt_estoque_informado"; 
              } 
              if (isset($NM_val_form['dt_hr_estoque']) && $NM_val_form['dt_hr_estoque'] != $this->nmgp_dados_select['dt_hr_estoque']) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "dt_hr_estoque = TO_DATE('$this->dt_hr_estoque', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "dt_hr_estoque = '$this->dt_hr_estoque'"; 
                  } 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE item_media_custo_id = $this->item_media_custo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE item_media_custo_id = $this->item_media_custo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE item_media_custo_id = $this->item_media_custo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE item_media_custo_id = $this->item_media_custo_id ";  
              }  
              else  
              {
                  $comando .= " WHERE item_media_custo_id = $this->item_media_custo_id ";  
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
                                  form_itens_media_custo_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->it_codigo = $this->it_codigo_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['item_media_custo_id'])) { $this->item_media_custo_id = $NM_val_form['item_media_custo_id']; }
              elseif (isset($this->item_media_custo_id)) { $this->nm_limpa_alfa($this->item_media_custo_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['media_custo_id'])) { $this->media_custo_id = $NM_val_form['media_custo_id']; }
              elseif (isset($this->media_custo_id)) { $this->nm_limpa_alfa($this->media_custo_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['qt_estoque'])) { $this->qt_estoque = $NM_val_form['qt_estoque']; }
              elseif (isset($this->qt_estoque)) { $this->nm_limpa_alfa($this->qt_estoque); }
              if     (isset($NM_val_form) && isset($NM_val_form['vl_custo'])) { $this->vl_custo = $NM_val_form['vl_custo']; }
              elseif (isset($this->vl_custo)) { $this->nm_limpa_alfa($this->vl_custo); }
              if     (isset($NM_val_form) && isset($NM_val_form['item_custo_id_orig'])) { $this->item_custo_id_orig = $NM_val_form['item_custo_id_orig']; }
              elseif (isset($this->item_custo_id_orig)) { $this->nm_limpa_alfa($this->item_custo_id_orig); }
              if     (isset($NM_val_form) && isset($NM_val_form['it_codigo'])) { $this->it_codigo = $NM_val_form['it_codigo']; }
              elseif (isset($this->it_codigo)) { $this->nm_limpa_alfa($this->it_codigo); }
              if     (isset($NM_val_form) && isset($NM_val_form['qt_estoque_informado'])) { $this->qt_estoque_informado = $NM_val_form['qt_estoque_informado']; }
              elseif (isset($this->qt_estoque_informado)) { $this->nm_limpa_alfa($this->qt_estoque_informado); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('item_media_custo_id', 'it_codigo', 'media_custo_id', 'qt_estoque', 'qt_estoque_informado', 'vl_custo', 'item_custo_id_orig', 'label_vl_custo', 'busca_estoque'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_itens_media_custo_pack_ajax_response();
              }
              exit; 
          }  
          $this->item_media_custo_id_before_qstr = $this->item_media_custo_id = $rs->fields[0] + 1;
          $rs->Close(); 
              $this->dt_hr_estoque =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->dt_hr_estoque_hora =  date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
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
              $Cmd_Unique = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where media_custo_id = " . $this->media_custo_id . " AND it_codigo = '" . $this->it_codigo . "'";
              $Cmd_Unique = str_replace("'null'", "null", $Cmd_Unique) ; 
              $Cmd_Unique = str_replace("#null#", "null", $Cmd_Unique) ; 
              $Cmd_Unique = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $Cmd_Unique) ; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $Cmd_Unique;
              $rsUni = $this->Db->Execute($Cmd_Unique);
              if (false === $rsUni)
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
                          form_itens_media_custo_pack_ajax_response();
                          exit;
                      }
                  }
              }
              elseif (0 < $rsUni->fields[0])
              {
                  $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_inst_uniq'] . " Média Custo ID, Item"); 
                  $this->nmgp_opcao = "nada"; 
                  $GLOBALS["erro_incl"] = 1; 
                  $aInsertOk[] = 'media_custo_id+it_codigo';
                  $rsUni->Close();
              }
              else
              {
                  $rsUni->Close();
              }
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_itens_media_custo_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES ($this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, TO_DATE('$this->dt_hr_estoque', 'yyyy-mm-dd hh24:mi:ss'), $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, TO_DATE('$this->dt_hr_estoque', 'yyyy-mm-dd hh24:mi:ss'), $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado) VALUES (" . $NM_seq_auto . "$this->item_media_custo_id, $this->media_custo_id, '$this->dt_hr_estoque', $this->qt_estoque, $this->vl_custo, $this->item_custo_id_orig, '$this->it_codigo', $this->qt_estoque_informado)"; 
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
                              form_itens_media_custo_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->it_codigo = $this->it_codigo_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->it_codigo = $this->it_codigo_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              $this->NM_gera_log_key("incluir");
              $this->NM_gera_log_new();
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['bt_get_est_ajax'] = "on";
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->item_media_custo_id = substr($this->Db->qstr($this->item_media_custo_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where item_media_custo_id = $this->item_media_custo_id "); 
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
                          form_itens_media_custo_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']);
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
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['parms'] = "item_media_custo_id?#?$this->item_media_custo_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->item_media_custo_id = null === $this->item_media_custo_id ? null : substr($this->Db->qstr($this->item_media_custo_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "R")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->item_media_custo_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->item_media_custo_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" && $this->sc_evento == "insert")
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_itens_media_custo = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] = $qt_geral_reg_form_itens_media_custo;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->item_media_custo_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "item_media_custo_id < $this->item_media_custo_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "item_media_custo_id < $this->item_media_custo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "item_media_custo_id < $this->item_media_custo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "item_media_custo_id < $this->item_media_custo_id "; 
              }
              else  
              {
                  $Key_Where = "item_media_custo_id < $this->item_media_custo_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_itens_media_custo = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] > $qt_geral_reg_form_itens_media_custo)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = $qt_geral_reg_form_itens_media_custo; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = $qt_geral_reg_form_itens_media_custo; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_itens_media_custo) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT item_media_custo_id, media_custo_id, TO_DATE(TO_CHAR(dt_hr_estoque, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT item_media_custo_id, media_custo_id, dt_hr_estoque, qt_estoque, vl_custo, item_custo_id_orig, it_codigo, qt_estoque_informado from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "item_media_custo_id = $this->item_media_custo_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "item_media_custo_id = $this->item_media_custo_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "item_media_custo_id = $this->item_media_custo_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "item_media_custo_id = $this->item_media_custo_id"; 
              }  
              else  
              {
                  $aWhere[] = "item_media_custo_id = $this->item_media_custo_id"; 
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
          $sc_order_by = "item_media_custo_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['bt_get_est_ajax'] = $this->nmgp_botoes['bt_get_est_ajax'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['bt_get_est_ajax'] = $this->nmgp_botoes['bt_get_est_ajax'] = "on";
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
              $this->item_media_custo_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['item_media_custo_id'] = $this->item_media_custo_id;
              $this->media_custo_id = $rs->fields[1] ; 
              $this->nmgp_dados_select['media_custo_id'] = $this->media_custo_id;
              $this->dt_hr_estoque = $rs->fields[2] ; 
              if (substr($this->dt_hr_estoque, 10, 1) == "-") 
              { 
                 $this->dt_hr_estoque = substr($this->dt_hr_estoque, 0, 10) . " " . substr($this->dt_hr_estoque, 11);
              } 
              if (substr($this->dt_hr_estoque, 13, 1) == ".") 
              { 
                 $this->dt_hr_estoque = substr($this->dt_hr_estoque, 0, 13) . ":" . substr($this->dt_hr_estoque, 14, 2) . ":" . substr($this->dt_hr_estoque, 17);
              } 
              $this->nmgp_dados_select['dt_hr_estoque'] = $this->dt_hr_estoque;
              $this->qt_estoque = $rs->fields[3] ; 
              $this->nmgp_dados_select['qt_estoque'] = $this->qt_estoque;
              $this->vl_custo = $rs->fields[4] ; 
              $this->nmgp_dados_select['vl_custo'] = $this->vl_custo;
              $this->item_custo_id_orig = $rs->fields[5] ; 
              $this->nmgp_dados_select['item_custo_id_orig'] = $this->item_custo_id_orig;
              $this->it_codigo = $rs->fields[6] ; 
              $this->nmgp_dados_select['it_codigo'] = $this->it_codigo;
              $this->qt_estoque_informado = $rs->fields[7] ; 
              $this->nmgp_dados_select['qt_estoque_informado'] = $this->qt_estoque_informado;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->item_media_custo_id = (string)$this->item_media_custo_id; 
              $this->media_custo_id = (string)$this->media_custo_id; 
              $this->qt_estoque = (string)$this->qt_estoque; 
              $this->vl_custo = (string)$this->vl_custo; 
              $this->item_custo_id_orig = (string)$this->item_custo_id_orig; 
              $this->qt_estoque_informado = (string)$this->qt_estoque_informado; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['parms'] = "item_media_custo_id?#?$this->item_media_custo_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] < $qt_geral_reg_form_itens_media_custo;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opcao']   = '';
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
              $this->item_media_custo_id = "";  
              $this->nmgp_dados_form["item_media_custo_id"] = $this->item_media_custo_id;
              $this->media_custo_id = "";  
              $this->nmgp_dados_form["media_custo_id"] = $this->media_custo_id;
              $this->dt_hr_estoque =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->dt_hr_estoque_hora =  date('H') . ":" . date('i') . ":" . date('s');
              $this->nmgp_dados_form["dt_hr_estoque"] = $this->dt_hr_estoque;
              $this->qt_estoque = "";  
              $this->nmgp_dados_form["qt_estoque"] = $this->qt_estoque;
              $this->vl_custo = "";  
              $this->nmgp_dados_form["vl_custo"] = $this->vl_custo;
              $this->item_custo_id_orig = "";  
              $this->nmgp_dados_form["item_custo_id_orig"] = $this->item_custo_id_orig;
              $this->it_codigo = "";  
              $this->nmgp_dados_form["it_codigo"] = $this->it_codigo;
              $this->qt_estoque_informado = "";  
              $this->nmgp_dados_form["qt_estoque_informado"] = $this->qt_estoque_informado;
              $this->nmgp_dados_form["label_vl_custo"] = $this->label_vl_custo;
              $this->busca_estoque = "Não Buscado";  
              $this->nmgp_dados_form["busca_estoque"] = $this->busca_estoque;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['foreign_key'] as $sFKName => $sFKValue)
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id < $this->item_media_custo_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->item_media_custo_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " where item_media_custo_id > $this->item_media_custo_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->item_media_custo_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter']))
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
     $this->item_media_custo_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(item_media_custo_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
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
     $this->item_media_custo_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
       $this->SC_log_arr['keys']['item_media_custo_id'] =  $this->item_media_custo_id;
   }
// 
   function NM_gera_log_old() 
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select']))
       {
           $nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_select'];
           $this->SC_log_arr['fields']['media_custo_id']['0'] =  $nmgp_dados_select['media_custo_id'];
           $this->SC_log_arr['fields']['dt_hr_estoque']['0'] =  $nmgp_dados_select['dt_hr_estoque'];
           $this->SC_log_arr['fields']['qt_estoque']['0'] =  $nmgp_dados_select['qt_estoque'];
           $this->SC_log_arr['fields']['vl_custo']['0'] =  $nmgp_dados_select['vl_custo'];
           $this->SC_log_arr['fields']['item_custo_id_orig']['0'] =  $nmgp_dados_select['item_custo_id_orig'];
           $this->SC_log_arr['fields']['it_codigo']['0'] =  $nmgp_dados_select['it_codigo'];
           $this->SC_log_arr['fields']['qt_estoque_informado']['0'] =  $nmgp_dados_select['qt_estoque_informado'];
       }
   }
// 
   function NM_gera_log_new() 
   {
       $this->SC_log_arr['fields']['media_custo_id']['1'] =  $this->media_custo_id;
       $this->SC_log_arr['fields']['dt_hr_estoque']['1'] =  $this->dt_hr_estoque;
       $this->SC_log_arr['fields']['qt_estoque']['1'] =  $this->qt_estoque;
       $this->SC_log_arr['fields']['vl_custo']['1'] =  $this->vl_custo;
       $this->SC_log_arr['fields']['item_custo_id_orig']['1'] =  $this->item_custo_id_orig;
       $this->SC_log_arr['fields']['it_codigo']['1'] =  $this->it_codigo;
       $this->SC_log_arr['fields']['qt_estoque_informado']['1'] =  $this->qt_estoque_informado;
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
       $Log_labels['media_custo_id'] =  "Média Custo ID";
       $Log_labels['dt_hr_estoque'] =  "Dt.Hr. Estoque";
       $Log_labels['qt_estoque'] =  "Qt. Estoque";
       $Log_labels['vl_custo'] =  "Vl. Custo";
       $Log_labels['item_custo_id_orig'] =  "Item Custo Id Orig";
       $Log_labels['it_codigo'] =  "Item";
       $Log_labels['qt_estoque_informado'] =  "Qt. Estoque Informado";
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function it_codigo_onBlur()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
$original_qt_estoque = $this->qt_estoque;
$original_qt_estoque_informado = $this->qt_estoque_informado;
$original_vl_custo = $this->vl_custo;
$original_label_vl_custo = $this->label_vl_custo;
$original_it_codigo = $this->it_codigo;
$original_busca_estoque = $this->busca_estoque;
$original_it_codigo = $this->it_codigo;
$original_item_custo_id_orig = $this->item_custo_id_orig;

$this->localGetEst();

$modificado_qt_estoque = $this->qt_estoque;
$modificado_qt_estoque_informado = $this->qt_estoque_informado;
$modificado_vl_custo = $this->vl_custo;
$modificado_label_vl_custo = $this->label_vl_custo;
$modificado_it_codigo = $this->it_codigo;
$modificado_busca_estoque = $this->busca_estoque;
$modificado_it_codigo = $this->it_codigo;
$modificado_item_custo_id_orig = $this->item_custo_id_orig;
$this->nm_formatar_campos('qt_estoque', 'qt_estoque_informado', 'vl_custo', 'label_vl_custo', 'it_codigo', 'busca_estoque', 'it_codigo', 'item_custo_id_orig');
if ($original_qt_estoque !== $modificado_qt_estoque || isset($this->nmgp_cmp_readonly['qt_estoque']) || (isset($bFlagRead_qt_estoque) && $bFlagRead_qt_estoque))
{
    $this->ajax_return_values_qt_estoque(true);
}
if ($original_qt_estoque_informado !== $modificado_qt_estoque_informado || isset($this->nmgp_cmp_readonly['qt_estoque_informado']) || (isset($bFlagRead_qt_estoque_informado) && $bFlagRead_qt_estoque_informado))
{
    $this->ajax_return_values_qt_estoque_informado(true);
}
if ($original_vl_custo !== $modificado_vl_custo || isset($this->nmgp_cmp_readonly['vl_custo']) || (isset($bFlagRead_vl_custo) && $bFlagRead_vl_custo))
{
    $this->ajax_return_values_vl_custo(true);
}
if ($original_label_vl_custo !== $modificado_label_vl_custo || isset($this->nmgp_cmp_readonly['label_vl_custo']) || (isset($bFlagRead_label_vl_custo) && $bFlagRead_label_vl_custo))
{
    $this->ajax_return_values_label_vl_custo(true);
}
if ($original_it_codigo !== $modificado_it_codigo || isset($this->nmgp_cmp_readonly['it_codigo']) || (isset($bFlagRead_it_codigo) && $bFlagRead_it_codigo))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']['it_codigo'] = $this->it_codigo;
    $this->ajax_return_values_it_codigo(true);
}
if ($original_busca_estoque !== $modificado_busca_estoque || isset($this->nmgp_cmp_readonly['busca_estoque']) || (isset($bFlagRead_busca_estoque) && $bFlagRead_busca_estoque))
{
    $this->ajax_return_values_busca_estoque(true);
}
if ($original_it_codigo !== $modificado_it_codigo || isset($this->nmgp_cmp_readonly['it_codigo']) || (isset($bFlagRead_it_codigo) && $bFlagRead_it_codigo))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']['it_codigo'] = $this->it_codigo;
    $this->ajax_return_values_it_codigo(true);
}
if ($original_item_custo_id_orig !== $modificado_item_custo_id_orig || isset($this->nmgp_cmp_readonly['item_custo_id_orig']) || (isset($bFlagRead_item_custo_id_orig) && $bFlagRead_item_custo_id_orig))
{
    $this->ajax_return_values_item_custo_id_orig(true);
}
$this->NM_ajax_info['event_field'] = 'it';
form_itens_media_custo_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function localGetEst()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
$this->qt_estoque  = 0;
$this->qt_estoque_informado  = 0;
$this->vl_custo  = 0;
$this->label_vl_custo  = "";
$agora = date("Y-m-d H:i:s");
$this->dt_hr_estoque  = $agora;
$aSaldo = $this->buscarSaldoEstoque($this->it_codigo );
if(is_array($aSaldo)){
		$this->qt_estoque  = $aSaldo[0]['ima'] + $aSaldo[0]['med'];	
		$this->qt_estoque_informado  = $this->qt_estoque ;
	$this->busca_estoque  = 'Encontrado';
}
else{
		$this->qt_estoque  = 0;	
		$this->qt_estoque_informado  = 0;
		$this->busca_estoque  = 'Não Encontrado';
}	

$aVlCusto = $this->buscarUltItemCusto($this->it_codigo );
if(is_array($aVlCusto)){
   $this->vl_custo  = $aVlCusto[0]['vl_unit_novo'];
   $this->label_vl_custo  = $this->vl_custo ;
   $this->item_custo_id_orig  = $aVlCusto[0]['item_custo_id'];		
}
else{
	$this->vl_custo  = 0;
   $this->label_vl_custo  = '';
   $this->item_custo_id_orig  = 0;		
	$msg = "<h3 style='color:red;'>Não foi encontrado custo para o item informado.</h3>";
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $msg;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_itens_media_custo';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_itens_media_custo';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;	
	
}
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function scajaxbutton_bt_get_est_ajax_onClick()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
$original_qt_estoque = $this->qt_estoque;
$original_qt_estoque_informado = $this->qt_estoque_informado;
$original_vl_custo = $this->vl_custo;
$original_label_vl_custo = $this->label_vl_custo;
$original_it_codigo = $this->it_codigo;
$original_busca_estoque = $this->busca_estoque;
$original_it_codigo = $this->it_codigo;
$original_item_custo_id_orig = $this->item_custo_id_orig;

$this->localGetEst();

$modificado_qt_estoque = $this->qt_estoque;
$modificado_qt_estoque_informado = $this->qt_estoque_informado;
$modificado_vl_custo = $this->vl_custo;
$modificado_label_vl_custo = $this->label_vl_custo;
$modificado_it_codigo = $this->it_codigo;
$modificado_busca_estoque = $this->busca_estoque;
$modificado_it_codigo = $this->it_codigo;
$modificado_item_custo_id_orig = $this->item_custo_id_orig;
$this->nm_formatar_campos('qt_estoque', 'qt_estoque_informado', 'vl_custo', 'label_vl_custo', 'it_codigo', 'busca_estoque', 'it_codigo', 'item_custo_id_orig');
if ($original_qt_estoque !== $modificado_qt_estoque || isset($this->nmgp_cmp_readonly['qt_estoque']) || (isset($bFlagRead_qt_estoque) && $bFlagRead_qt_estoque))
{
    $this->ajax_return_values_qt_estoque(true);
}
if ($original_qt_estoque_informado !== $modificado_qt_estoque_informado || isset($this->nmgp_cmp_readonly['qt_estoque_informado']) || (isset($bFlagRead_qt_estoque_informado) && $bFlagRead_qt_estoque_informado))
{
    $this->ajax_return_values_qt_estoque_informado(true);
}
if ($original_vl_custo !== $modificado_vl_custo || isset($this->nmgp_cmp_readonly['vl_custo']) || (isset($bFlagRead_vl_custo) && $bFlagRead_vl_custo))
{
    $this->ajax_return_values_vl_custo(true);
}
if ($original_label_vl_custo !== $modificado_label_vl_custo || isset($this->nmgp_cmp_readonly['label_vl_custo']) || (isset($bFlagRead_label_vl_custo) && $bFlagRead_label_vl_custo))
{
    $this->ajax_return_values_label_vl_custo(true);
}
if ($original_it_codigo !== $modificado_it_codigo || isset($this->nmgp_cmp_readonly['it_codigo']) || (isset($bFlagRead_it_codigo) && $bFlagRead_it_codigo))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']['it_codigo'] = $this->it_codigo;
    $this->ajax_return_values_it_codigo(true);
}
if ($original_busca_estoque !== $modificado_busca_estoque || isset($this->nmgp_cmp_readonly['busca_estoque']) || (isset($bFlagRead_busca_estoque) && $bFlagRead_busca_estoque))
{
    $this->ajax_return_values_busca_estoque(true);
}
if ($original_it_codigo !== $modificado_it_codigo || isset($this->nmgp_cmp_readonly['it_codigo']) || (isset($bFlagRead_it_codigo) && $bFlagRead_it_codigo))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dados_form']['it_codigo'] = $this->it_codigo;
    $this->ajax_return_values_it_codigo(true);
}
if ($original_item_custo_id_orig !== $modificado_item_custo_id_orig || isset($this->nmgp_cmp_readonly['item_custo_id_orig']) || (isset($bFlagRead_item_custo_id_orig) && $bFlagRead_item_custo_id_orig))
{
    $this->ajax_return_values_item_custo_id_orig(true);
}
$this->NM_ajax_info['event_field'] = 'scajaxbutton';
form_itens_media_custo_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function buscarSaldoEstoque($itCodigo)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $qtIma 		 = 0;
    $qtMed		 = 0;
    $tabela 	 = 'pub."saldo-estoq"';
    $campos 	 = 'sum("qtidade-atu") as qt';
    $estab	 	 = " and \"cod-estabel\" = '1'";
    $condicao 	 = "\"it-codigo\" = '$itCodigo' ";
    $aEstoqueIma = $this->retornoSimplesTb01($tabela,$campos,$condicao.$estab,"ems2ima");
    if(is_array($aEstoqueIma)){
        $qtIma = $aEstoqueIma[0]['qt'];
    }

   
   $condicao = $this->util_incr_valor($condicao,$this->getFiltroLocaisEstoque('5'), " AND ");


    $estab	 	 = " substring(\"cod-estabel\",1,1) = '5'";
    $aEstoqueMed = $this->retornoSimplesTb01($tabela,
                    $campos,
                    $condicao,
            "ems2med");
    if(is_array($aEstoqueMed)){
        $qtMed = $aEstoqueMed[0]['qt'];
    }
    $aRetorno[] = array('ima' => $qtIma , 'med' => $qtMed);
    return $aRetorno;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getMovtoEstoqPorData($itCodigo,$data)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $log =false;
     $aReg = $this->getReg('ems2med','movto-estoq','"it-codigo"',"'$itCodigo'",
        '"dt-trans"',"\"dt-trans\" <  '$data' ");
     if(is_array($aReg)){
         $log = true;
     }
     return $log;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function calcSaldoPorItemData($itCodigo,$data)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
     $saldo = 0;
    $aResult = $this->getDados('multi','pub."movto-estoq"',
                'sum(quantidade) as quantidade,"tipo-trans" as tipo_trans',
                "\"it-codigo\" ='$itCodigo' and \"dt-trans\" < '$data'
                 group by \"tipo_trans\" ","ems2med");
    if(is_array($aResult)){
        foreach($aResult as $reg){
            $tipo = $reg['tipo_trans'];
            $qte  = $reg['quantidade'];
            if($tipo == '1'){ 
                $saldo += $qte;
            }else{
                $saldo -= $qte;
            }
        }
    }
    return $saldo;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getFiltroLocaisEstoque($empresa,$apelido='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

    
    $aRegs = $this->getRegsLocaisPorEmpresa($empresa);
    $filtro = "";
    if($apelido <> ''){
        $apelido .=".";
    }
    if(is_array($aRegs)){
        foreach($aRegs as $reg){
            $codEstab = $reg['cod_estab'];
            $codDepos = $reg['cod_depos'];
            $termo = <<<TERMO
                ( $apelido"cod-estabel" = '$codEstab' and $apelido"cod-depos"  = '$codDepos' ) 
TERMO;
            $filtro = $this->util_incr_valor($filtro,$termo," OR ");
        }
        $filtro = "($filtro)";
    }
    return $filtro;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($sc_where_atual )){
            $nm_where_dinamico = "where $cond ";
        }else{
            $nm_where_dinamico = "AND $cond ";
        }
    }
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function buscarUltItemCusto($itCodigo,$container='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function calcularNovoCustoItem($container,$itemContainerId,$logPriorizarCustoPrevisto=0,$aDadosItemContainer='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $msgErro = '';
    $vlUnitAtual = 0;
    $itemCustoIdVlUnitAtual = 0;
    $logMovtoAnterior = false;
    $qtSaldoEstoqAtu = 0;

    if($aDadosItemContainer ==''){
        $aDadosItemContainer = buscarDadositemContainer($itemContainerId);
    }
    if(is_array($aDadosItemContainer)){
        $itemProcCompraId 		= $aDadosItemContainer[0]['item_proc_compra_id'];
        $itemContainerId	 	= $aDadosItemContainer[0]['item_container_id'];
        $itCodigo 		  		= buscarCodItemERP($itemProcCompraId);
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
    $logMovtoAnterior = $this->getMovtoEstoqPorData($itCodigo,$dtEmisNotaMae);
    $saldoAnteriorNfMae = $this->calcSaldoPorItemData($itCodigo,$dtEmisNotaMae);
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

    $aVersao = getVersaoCustoDesatu($container);
    if(is_array($aVersao)){
        $logVersaoCustoDesatualizado = $aVersao[0]['log_versao_custo_desatualizada'];
    }else{
        $logVersaoCustoDesatualizado = 1;
    }
    if($logVersaoCustoDesatualizado == 1){
        $msgErro .= "<h1>O calculo do custo está desatualizado, sendo necessário fazer uma nova versão do custo para que este programa exiba os valores para comparação corretamente.</h1>";

    }


    $aSaldoEstoq   = $this->buscarSaldoEstoque($itCodigo);
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
    


    $logCustoRealCompleto =	verificarLiberCustoContainer($container);

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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function inserirItemCustosTipoContainer($dtHrCusto, $vlUnitNovo, $itCodigo, $qtEstoque, $qtNfMae,
                                        $qtEtiqContainer, $vlUnitAnterior,$vlUnitContainer,
                                        $qtContainer )
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
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
                form_itens_media_custo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    $seq = $this->buscarVlSequenciaEspec('seq_item_custos','item_custos');
    return $seq;
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function inserirItemCustosTipoMedia($vlUnitNovo,$itCodigo,$qtEstoque,$vlUnitAnterior,
                                    $itCodigoMedia, $qtEstoqueMedia, $vlUnitMedia,
                                    $mediaCustoId=0,$memoriaCalculo='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
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
                form_itens_media_custo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getContainerItemCusto($itemCustoId)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getItensCustoContainer($container)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getListaIdsUltCusto()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getQtItensMediaId($mediaId)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $qt = 0;
    $aReg = $this->getReg('espec','item_custos','media_custo_id',
        $mediaId,'count(item_custo_id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getRegLocaisEstoquePortal($id,$campos)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('espec',
        'pub.locais_estoq_portal',
                'local_estoq_portal_id',
    $id,$campos);


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getRegsLocaisPorEmpresa($empresa)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $this->getDados('multi','pub.locais_estoq_portal','cod_estab,cod_depos',"cod_empresa = '$empresa' ",'espec');

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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
   $sErrorIndex = 'geral_form_itens_media_custo';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_itens_media_custo';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
    }
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function calcularMediaCusto($mediaCustoId)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $qtTotal = 0;
    $vlTotal = 0;
    $media   = 0;

    $aDados = $this->getDados('multi','pub.itens_media_custo',
        'qt_estoque_informado,vl_custo',"media_custo_id = $mediaCustoId",'espec');
    foreach($aDados as $reg){
        $qtEstInf = $reg['qt_estoque_informado'];
        $vlCusto  = $reg['vl_custo'];
        $vlTotal  += $vlCusto * $qtEstInf;
        $qtTotal += $qtEstInf;
    }
    $media = $vlTotal / $qtTotal;
    return $media;



$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function cancelarMediaCusto($mediaCustoId,$descMotivo)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $this->cancelarItensMediaCusto($mediaCustoId);
    $cmd="update pub.medias_custo set num_situacao = 3, 
        motivo_cancelamento='$descMotivo' where media_custo_id = $mediaCustoId";
    
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
                form_itens_media_custo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function cancelarItensMediaCusto($mediaCustoId,$descMotivo='')
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aDados = $this->getDados('multi',
        'pub.itens_media_custo',
        'vl_custo,it_codigo',
        "media_custo_id = $mediaCustoId",
        'espec');

    foreach($aDados as $reg){
        $vlCusto  = $reg['vl_custo'];
        $itCodigo = $reg['it_codigo'];
        $desc = " $descMotivo - Cancelamento de Média";

        $this->inserirItemCustosTipoMedia($vlCusto,'',0,
            0,$itCodigo,0,0,
        $mediaCustoId,$desc);

    }



$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function setMedia($mediaCustoId,$vlMedia)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $cmd= "update pub.medias_custo set vl_media = '$vlMedia', num_situacao = 2
            where media_custo_id = $mediaCustoId";
    
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
                form_itens_media_custo_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function gerarCustoItemMedia($mediaCustoId,$vlMedia)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $aDados = $this->getDados('multi',
        'pub.itens_media_custo',
        'it_codigo',
        "media_custo_id = $mediaCustoId",
        'espec');

    foreach($aDados as $reg){
        $itCodigo = $reg['it_codigo'];
        $descMotivo = "Média calculada pelo sistema";

        $this->inserirItemCustosTipoMedia($vlMedia,'',0,
            0,$itCodigo,0,0,
            $mediaCustoId,$descMotivo);

    }

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
}
function existItemMediaCusto($mediaCustoId,$itCodigo)
{
$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'on';
  
    $lAchou = false;
    $aReg = $this->getReg('espec','itens_media_custo','media_custo_id,it_codigo',
    "$mediaCustoId,'$itCodigo'");
    if(is_array($aReg)){
        $lAchou = true;
    }
    return $lAchou;

$_SESSION['scriptcase']['form_itens_media_custo']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_itens_media_custo_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_itens_media_custo_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("item_media_custo_id", "media_custo_id", "dt_hr_estoque", "qt_estoque", "vl_custo", "item_custo_id_orig"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_itens_media_custo_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "item_media_custo_id") 
          {
              $this->SC_monta_condicao($comando, "item_media_custo_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "media_custo_id") 
          {
              $this->SC_monta_condicao($comando, "media_custo_id", $arg_search, str_replace(",", ".", $data_search), "INTEGER", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_hr_estoque") 
          {
              $this->SC_monta_condicao($comando, "dt_hr_estoque", $arg_search, $data_search, "TIMESTAMP", false);
          }
          if ($field == "SC_all_Cmp" || $field == "qt_estoque") 
          {
              $this->SC_monta_condicao($comando, "qt_estoque", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "vl_custo") 
          {
              $this->SC_monta_condicao($comando, "vl_custo", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
          }
          if ($field == "SC_all_Cmp" || $field == "item_custo_id_orig") 
          {
              $this->SC_monta_condicao($comando, "item_custo_id_orig", $arg_search, str_replace(",", ".", $data_search), "NUMERIC", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_itens_media_custo = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] = $qt_geral_reg_form_itens_media_custo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_itens_media_custo_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_itens_media_custo_pack_ajax_response();
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
      $nm_numeric[] = "item_media_custo_id";$nm_numeric[] = "media_custo_id";$nm_numeric[] = "qt_estoque";$nm_numeric[] = "vl_custo";$nm_numeric[] = "item_custo_id_orig";$nm_numeric[] = "qt_estoque_informado";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['decimal_db'] == ".")
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
      $Nm_datas["dt_hr_estoque"] = "timestamp";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['SC_sep_date1'];
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
       $nmgp_saida_form = "form_itens_media_custo_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_itens_media_custo_fim.php";
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
       form_itens_media_custo_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['masterValue']);
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
            case "bt_get_est_ajax":
                return array("sc_bt_get_est_ajax_top", "sc_bt_get_est_ajax_top");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Itens Média Custo"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Itens Média Custo"; } ?> - 
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_media_custo']['ordem_ord'] == " desc") {
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
            case "item_media_custo_id":
                return true;
            case "media_custo_id":
                return true;
            case "qt_estoque":
                return true;
            case "qt_estoque_informado":
                return true;
            case "vl_custo":
                return true;
            case "item_custo_id_orig":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "item_media_custo_id":
                return 'desc';
            case "media_custo_id":
                return 'desc';
            case "qt_estoque":
                return 'desc';
            case "qt_estoque_informado":
                return 'desc';
            case "vl_custo":
                return 'desc';
            case "item_custo_id_orig":
                return 'desc';
            case "dt_hr_estoque":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
